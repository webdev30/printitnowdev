<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	function __construct()
	{
 		parent::__construct();
		session_start();
		//session_destroy();
 		//$this->load->library('session');
		$this->load->database();
		$this->load->library(array('general_functions', 'encrypt'));
		$this->load->helper('url');

		#Models
		$this->load->model("order_model", "orders");
		$this->load->model("user_model", "user");
		
	}	


	# Home Page -----------------------------------------
	public function index()
	{
		$this->load->view('index');
	}
	

	# Call print form ------------------------------------------------------
	public function printIt()
	{
		#Get vendor list
		$vendors = $this->user->getVendors();
		if( !empty($vendors) )
		{
			$data['vendors'] = $vendors;
		}
		$this->load->view('print-now', $data);
	}
	

	public function review()
	{
		//echo "<pre>";
		//print_r($_SESSION);
		$this->load->view('review');
	}
	

	# Order Validation and Review --------------------------------------------
	public function confirm_order()
	{
		if( $this->input->post('printorder') )
		{
			unset($_SESSION['file']);
			unset($_SESSION['user_info']);
			unset($_SESSION['data']);
    
    		$number_of_files = sizeof($_FILES['file']['tmp_name']);
    		$files = $_FILES['file'];
    		$errors = array();
    		
    		for($i=0;$i<count($files);$i++)
    		{
      			if($_FILES['file']['error'][$i] != 0) 
		  			$errors[$i] = 'Couldn\'t upload file '.$_FILES['file']['name'][$i];
    		}
    		
    		if(sizeof($errors)==0)
    		{
	  			$number_of_files = sizeof($_FILES['file']['tmp_name']);
	  			$files = $_FILES['file'];
	  			$errors = array();
      			$this->load->library('upload');
      			$config['upload_path'] = DIR_WS_UPLOAD_IMAGES;
      			$config['allowed_types'] = IMAGE_ALLOWED_TYPES;
      			$totalsize = 0;
      
      			for ($i = 0; $i < count($files); $i++)
      			{
        			$_FILES['file']['name'] = $files['name'][$i];
        			$_FILES['file']['type'] = $files['type'][$i];
        			$_FILES['file']['tmp_name'] = $files['tmp_name'][$i];
        			$_FILES['file']['error'] = $files['error'][$i];
        			$_FILES['file']['size'] = $files['size'][$i];
        			$fileext = explode(".", $_FILES['file']['name']);
        			$totalsize += $_FILES['file']['size'];

        			#Check file types
        			if( in_array($fileext[1], array("jpg", "jpeg", "png", "doc", "docx", "pdf", "ppt")) )
        			{
        				# check total file size
        				if( $totalsize <= (50*MB) )
        				{
		        			# Initialize the upload library
		        			$this->upload->initialize($config);
		        			# Retrieve the number of uploaded files
		        			if ($this->upload->do_upload('file'))
		        			{
		          				$data['uploads'][$i] = $this->upload->data();
		        			}
		        			else
		        			{
		          				$data['upload_errors'][$i] = $this->upload->display_errors();
		        			}
	        			}
	        			else
	        			{
	        				$errors[] = "File size exceeding 50MB";
	        				break;
	        			}
        			}
        			else
        			{
        				$errors[] = "Invalid file type";
        				break;
        			}
      			}
    		}
    		
       		# If there is no error
       		if( empty($errors) )
       		{
	       		if( !empty($data['uploads']) && isset($data['uploads']) )
	       		{
		    		foreach( $data['uploads'] as $fileArray )
		    		{
						$_SESSION['file'][]=$fileArray['file_name'];
					}
		   		}
			
				$_SESSION['user_info']['name']=$this->input->post('name');
				$_SESSION['user_info']['email']=$this->input->post('email');
				$_SESSION['user_info']['contact']=$this->input->post('contact');
				$_SESSION['user_info']['alternate_contact']=$this->input->post('alternate_contact');
				$_SESSION['user_info']['vendor']=$this->input->post('vendor');
				$_SESSION['user_info']['pickup']=$this->input->post('pick_up_date');
				$Mydata=array();
			
				foreach( $this->input->post('data') as $key=>$value )
				{
					foreach($value as $key1=>$value1){
						$Mydata['data'][$key][]=$value1;	
					}
				}
			
				$_SESSION['data']=$this->general_functions->reArrayData($Mydata['data']);
				
				if( !empty($_SESSION) )
				{
					redirect('review');
				}
			}
			else
			{
				$data['prErr'] = $errors;
    			$data['prPOST'] = $_POST;  
    			#Get vendor list
				$vendors = $this->user->getVendors();
				if( !empty($vendors) )
				{
					$data['vendors'] = $vendors;
				}  			
    			$this->load->view('print-now', $data);
    			/*echo "<pre>";
      			print_r($errors);
	  			exit;*/
			}
		}
	}


	public function thankyou()
	{
		//echo "<pre>";
		//print_r($_SESSION);
		
		if( isset($_SESSION['user_info']) )
		{
			$orderid = $this->orders->insOrder();
			if( $orderid!="" && !empty($_SESSION['data']) )
			{
				$this->orders->insOrderDetail($orderid);
			}
		}
		//echo CI_VERSION;
		$this->load->view('thanku-page');
	}


	# Vendor login ----------------------------------------------------------
	public function login($resetData='')
	{
		# Login action
		if( $this->input->post("log_usr") )
		{
			$vemail = $this->input->post("log_usr");
			$vpass = $this->input->post("log_pass");

			if( $vemail!="" && $vpass!="" )
			{
				$chkLogin = $this->user->login($vemail, $vpass);
				if( !empty($chkLogin) )
				{
					$_SESSION['vendorid'] = $chkLogin[0]['id'];
					redirect('vendor');
				}
				else
				{
					$data['logErr'] = "Invalid details";
				}
			}
			else
			{
				$data['logErr'] = "Please fill all fields";
			}
		}
		##Forget Pasword in ajax controller

		# Reset Password
		if( $resetData!="" )
		{
			$data['case'] = 'r';
			if( $this->input->post("res_pass") && $this->input->post("resc_pass") )
			{
				$rpass = $this->input->post("res_pass");
				$rcpass = $this->input->post("resc_pass");
				$remail = trim($resetData);

				if( $rpass!="" && $rcpass!="" && $remail!="" )
				{
					if( $rpass==$rcpass )
					{
						$checkEmailExist = $this->user->findDataByEmail(base64_decode($remail));
						if( !empty($checkEmailExist) )
						{
							$updatePass = $this->user->updatePassByEmail( $rpass, base64_decode($remail) );
							if( $updatePass==1 )
							{
								$data['logErr'] = "<span style=\"color:#009900\">Password has been reset successfully.<a href='".MAINSITE_URL_INDEX."login'>Click Here to Login</a></span>";
							}
						}
						else
						{
							$data['logErr'] = "Invalid link";
						}
					}
					else
					{
						$data['logErr'] = "Confirm password does not match";
					}
				}
				else
				{
					$data['logErr'] = "Please fill required fields";
				}
			}
		}

		$this->load->view('vendor-login', $data);
	}

}
