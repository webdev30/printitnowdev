<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	function __construct()
	{
 		parent::__construct();
		session_start();
		$this->load->database();
		$this->load->library(array('general_functions', 'encrypt', 'session'));
		$this->load->helper('url');

		#Models
		$this->load->model("order_model", "orders");
		$this->load->model("user_model", "user");
		
	}


	#check login session
	public function checkLoginSession()
	{
		if( !isset($_SESSION['vendorid']) || $_SESSION['vendorid']=="" )
		{
			redirect("login");
		}
	}	


	# Check login session -----------------------------------------------------------
	public function vendordashboard()
	{
		$this->checkLoginSession();
		$vid = $_SESSION['vendorid'];

		$curOrders = $this->orders->getCurOrders($vid);
		if( $this->input->post("filteropt") && $this->input->post("filterval") )
		{
			$filterby = ( $this->input->post("filteropt") && $this->input->post("filteropt")!="" )?$this->input->post("filteropt"):"";
			$filterval = ( $this->input->post("filterval") && $this->input->post("filterval")!="" )?$this->input->post("filterval"):"";
			if( $filterby!="" && $filterval!="" )
			{
				$curOrders = $this->orders->searchOrders($filterby, $filterval, $vid);
			}
		}
		
		if( !empty($curOrders) )
		{
			$data['curOrdResults'] = $curOrders;
		}

		# Get time slot listing
		$timeslots = $this->orders->getTimeslots();
		if( !empty($timeslots) )
		{
			$data['timeslots'] = $timeslots;
		}
		
		$this->load->view('vendor/index', $data);
	}
	

	# Get Order details ------------------------------------------------------------
	public function getOrderDetails()
	{
		if( $this->input->post("ordId") )
		{
			$ordId = $this->input->post("ordId");
			$pgnam = $this->input->post("pgnam");
			$getPrintDetails = $this->orders->getPrintDetails($ordId);
			$getPrintCustomer = $this->orders->getCustomer($ordId);
			$getVendorDetails = $this->user->getVendorById($_SESSION['vendorid']);

			#Get current url basename
			$url_parts = parse_url(current_url());
			$urlbase = pathinfo($url_parts['path'],PATHINFO_BASENAME);

			# Get all downloaded files id
			$getPrintId = $this->orders->getPrintIdFromTrackdownload();
			$getPrintIdArr = array();
			foreach ($getPrintId as $key => $value)
			{
				if( is_array($value) )
				{
					$getPrintIdArr = $value;
				}
			}

			if( !empty($getPrintDetails) && !empty($getPrintCustomer) )
			{
				/*echo "<pre>";
				print_r($getPrintDetails);*/
				$data['printData'] = $getPrintDetails;
				$data['printCust'] = $getPrintCustomer;
				$data['printTrackIds'] = $getPrintIdArr;
				$data['vendorData'] = $getVendorDetails;
				$data['urlbase'] = $pgnam;
				echo $this->load->view("vendor/show-print", $data);
			}
			else
			{
				echo 0;
			}
		}
	}


	# Update order status -----------------------------------------------------------------
	public function updateOrderStatus()
	{
		if( $this->input->post("oid") && $this->input->post("statval") )
		{
			$oid = $this->input->post("oid");
			$statval = $this->input->post("statval");
			if( $oid!="" && $oid!=0 && $statval!="" )
			{
				$res = $this->orders->updateOrdStat($oid, $statval);

				if( $res )
				{
					$getCustomer = $this->orders->getCustomer($oid);
					$getVendor = $this->user->getVendorById($_SESSION['vendorid']);
					$toeamil = $getCustomer[0]['email'];
					$toname = ucwords($getCustomer[0]['name']);
					$cusordnum = $getCustomer[0]['order_reference_no'];
					$vendor = $getVendor[0]['shop_name'];

					#Mails/SMS to Admin/User
					switch( $statval )
					{
					case 1: # Received -----------------------------------------------
						#To customer
						$msgc = "<p>Dear ".$toname.",<p><p>We have received your order. Your order reference number is ".$cusordnum.".<br />We will get back to you with an updated status at earliest possible time.</p><p>".MAILREGARDS."</p>";
						$this->general_functions->send_emailer(ADMINMAIL, ADMINNAME, $toeamil, PROJECT.": Your Order is confirmed", $msgc);

						#To admin
						$msga = "<p>Dear Admin,<p><p>".$vendor." has confirmed the order for order ref no. ".$cusordnum.".</p><p>".MAILREGARDS."</p>";
						$this->general_functions->send_emailer(ADMINMAIL, ADMINNAME, ADMINMAIL, PROJECT.": Order is confirmed", $msga);
					break;
					case 2: # Work In Progress -------------------------------------------
						#To customer
						$msgc = "<p>Dear ".$toname.",<p><p>Your order with order ref no. ".$cusordnum." is now being processed.<br />We will get back to you with an updated status at earliest possible time.</p><p>".MAILREGARDS."</p>";
						$this->general_functions->send_emailer(ADMINMAIL, ADMINNAME, $toeamil, PROJECT.": Your is Order in process", $msgc);
					break;
					case 3: # Complete ----------------------------------------------------
						#To customer
						$msgc = "<p>Dear ".$toname.",<p><p>We are ready with your order with order reference number ".$cusordnum.".<br />Request you to pick up from the selected vendor.</p><p>".MAILREGARDS."</p>";
						$this->general_functions->send_emailer(ADMINMAIL, ADMINNAME, $toeamil, PROJECT.": Your Order is ready", $msgc);
					break;
					case 4: # Delivered --------------------------------------------------
						#To customer
						$msgc = "<p>Dear ".$toname.",<p><p>Your order with order reference number ".$cusordnum." has been delivered.<br />It was pleasure to serve you.</p><p>".MAILREGARDS."</p>";
						$this->general_functions->send_emailer(ADMINMAIL, ADMINNAME, $toeamil, PROJECT.": Your Order delivered", $msgc);

						#To admin
						$msga = "<p>Dear Admin,<p><p>".$vendor." has delivered order ".$cusordnum.".</p><p>".MAILREGARDS."</p>";
						$this->general_functions->send_emailer(ADMINMAIL, ADMINNAME, ADMINMAIL, PROJECT.": Order delivered", $msga);
					break;
					}

				}

				# return update query status
				echo $res;
			}
		}
	}


	# Track download files -----------------------------------------------------------------
	public function trackFiles()
	{
		if( $this->input->post("filename") && $this->input->post("opid") )
		{
			$filename = $this->input->post("filename");
			$opid = $this->input->post("opid");
			if( $filename!="" && $opid!=0 && $opid!="" )
			{
				echo $res = $this->orders->trackDownload($opid, $filename);

				#Mails/SMS to Admin/User
			}
		}
	}


	# Get orders history listing ---------------------------------------------------------
	public function orderHistory()
	{
		$this->checkLoginSession();
		$vid = $_SESSION['vendorid'];

		#Get current url basename
		$url_parts = parse_url(current_url());
		$urlbase = pathinfo($url_parts['path'],PATHINFO_BASENAME);

		$ordHistory = $this->orders->getOrdersHistory($vid);
		if( !empty($ordHistory) )
		{
			$data['ordHisResults'] = $ordHistory;
		}
		
		$this->load->view('vendor/order-history', $data);
	}


	# Vendor profile --------------------------------------------------------------------
	public function profile()
	{
		$this->checkLoginSession();
		$vid = $_SESSION['vendorid'];

		$getVendor = $this->user->getVendorById($vid);
		if( !empty($getVendor) )
		{
			$data['getVendor'] = $getVendor;
		}
		
		$this->load->view('vendor/profile', $data);
	}


	# Vendor update password --------------------------------------------------------------------
	public function updatePassword()
	{
		$this->checkLoginSession();
		$vid = $_SESSION['vendorid'];

		if( $this->input->post("oldpass") && $this->input->post("newpass") )
		{
			$oldpass = $this->input->post("oldpass");
			$newpass = $this->input->post("newpass");
			$conpass = $this->input->post("conpass");

			if( $oldpass!="" && $newpass!="" && $conpass!="" )
			{
				if( $conpass==$newpass )
				{
					$getVendor = $this->user->getVendorById($vid);
					echo $res = $this->user->updatePassByEmail($newpass, $getVendor[0]['email']);
				}
				else
				{
					echo "Confirm password does not match";
				}
			}
			else
			{
				echo "Please fill all required fields";
			}
		}
	}
	
}
