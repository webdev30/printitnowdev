<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminpanel extends CI_Controller {
	
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
		if( !isset($_SESSION['adminid']) || $_SESSION['adminid']=="" )
		{
			redirect("adminpanel");
		}
	}


	# Admin login ----------------------------------------------------------
	public function index($resetData='')
	{
		if( isset($_SESSION['adminid']) && $_SESSION['adminid']!="" )
		{
			redirect('admin-board');
		}

		# Login action
		if( $this->input->post("log_usr") )
		{
			$vemail = $this->input->post("log_usr");
			$vpass = $this->input->post("log_pass");

			if( $vemail!="" && $vpass!="" )
			{
				$chkLogin = $this->user->adminlogin($vemail, $vpass);
				if( !empty($chkLogin) )
				{
					$_SESSION['adminid'] = $chkLogin[0]['id'];
					$_SESSION['adminname'] = ucwords($chkLogin[0]['name']);
					redirect('admin-board');
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

		$data['admincase'] = 1;
		$this->load->view('vendor-login', $data);
	}	


	# Check login session -----------------------------------------------------------
	public function admindashboard()
	{
		$this->checkLoginSession();

		$vid = 0;
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
		
		$data['admincase'] = 1;
		$this->load->view('vendor/index', $data);
	}


	# Get orders history listing ---------------------------------------------------------
	public function orderHistory()
	{
		$this->checkLoginSession();
		$vid = 0;

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


	# Admin logout ----------------------------------------------------------
	public function logout()
	{
		if( isset($_SESSION) ){ session_destroy(); }
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
	
		redirect("/adminpanel");
	}

	
}
