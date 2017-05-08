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
		if( !empty($curOrders) )
		{
			$data['curOrdResults'] = $curOrders;
		}
		
		$this->load->view('vendor/index', $data);
	}
	

	# Get Order details ------------------------------------------------------------
	public function getOrderDetails()
	{
		if( $this->input->post("ordId") )
		{
			$ordId = $this->input->post("ordId");
			$getPrintDetails = $this->orders->getPrintDetails($ordId);
			$getPrintCustomer = $this->orders->getCustomer($ordId);
			if( !empty($getPrintDetails) && !empty($getPrintCustomer) )
			{
				/*echo "<pre>";
				print_r($getPrintDetails);*/
				$data['printData'] = $getPrintDetails;
				$data['printCust'] = $getPrintCustomer;
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
				echo $res = $this->orders->updateOrdStat($oid, $statval);

				#Mails/SMS to Admin/User
			}
		}
	}
	
}
