<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

	function __construct()
	{
 		parent::__construct();
		session_start();
		//session_destroy();
 		//$this->load->library('session');
		$this->load->database();
		$this->load->library(array('general_functions', 'email', 'encrypt'));
		$this->load->helper('url');

		#Models
		$this->load->model("user_model", "user");
		
	}


	# Vendor Forget Password ----------------------------------------------------------
	public function forgetpass()
	{
		$vemail = ( $this->input->post("vemail") && $this->input->post("vemail")!="" )?$this->input->post("vemail"):"";
		if(  preg_match( '/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/', $vemail ) )
		{
			$vendor = $this->user->findDataByEmail($vemail);
			if( !empty($vendor) )
			{
				#Email
				$msg = "<p>Dear Customer,<br />Please click on below link to reset your password<br /><a href='".MAINSITE_URL_INDEX."reset/".base64_encode($vemail)."'>Reset Link</a>";
				/*
				$this->email->from(ADMINMAIL, ADMINNAME);
				$this->email->to($vemail);
				//$this->email->bcc(BCC);
				$this->email->subject(PROJECT);
				$this->email->message($msg);
				echo $this->email->send();*/
				echo $this->general_functions->send_emailer(ADMINMAIL, ADMINNAME, $vemail, PROJECT.": Reset Link", $msg);
				//echo 1;
			}
			else
			{
				echo "Email is invalid";
			}
		}
		else
		{
			echo "Please type valid email";
		}
	}

}
