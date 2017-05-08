<?php
class Order_model extends CI_Model
{

    public function __construct()
    {
            parent::__construct();
            // Your own constructor code
    }


    #Insert customer details
    public function insOrder()
    {
    	$refno = "PN".strtotime(date('Y-m-d H:i:s.u'));
    	$data = array(
    		'order_reference_no' => $refno,
    		'final_order_value' => '800',
    		'name' => trim($_SESSION['user_info']['name']),
    		'email' => trim($_SESSION['user_info']['email']),
    		'contact' => trim($_SESSION['user_info']['contact']),
    		'alternate_contact' => trim($_SESSION['user_info']['alternate_contact']),
    		'vendor' => trim($_SESSION['user_info']['vendor']),
    		'created_on' => date("Y-m-d H:i:s")
    		);
    	$this->db->insert('print_paytm_order', $data);
    	return $this->db->insert_id();

    }


    #Insert customer printing details
    public function insOrderDetail($orderid)
    {
    	foreach( $_SESSION['data'] as $key => $value )
    	{
    		$printPages = ($value['optradio']=="cus")?"Custom":"All";
            $filetype = explode(".", $_SESSION['file'][$key]);

    		$data = array(
    			'order_reference_id' => $orderid,
    			'file_name' => $_SESSION['file'][$key],
                'file_type' => $filetype,
    			'print_page' => $printPages,
    			'paper_size' => $value['paper_size'],
    			'print_option' => $value['print_option'],
    			'slides_per_page' => $value['pages'],
    			'orientation' => $value['orientation'],
    			'sides' => $value['print_sided'],
    			'copy_count' => trim($value['no_of_copy']),
    			'page_count' => trim($value['total_no_pages']),
    			'page_from' => trim($value['from']),
    			'page_to' => trim($value['to']),
    			'binding' => $value['binding'],
    			'pickup_date' => trim($value['pick_up_date'])
    		);

    		$this->db->insert('print_paytm_order_detail', $data);
    	}
    }


    # Get current orders list order by id desc
    public function getCurOrders($vid=0)
    {
        $this->db->where( array("vendor"=>$vid, "order_status !="=>"4") );
        $this->db->order_by( "order_reference_id", "desc" );
        $query = $this->db->get("print_paytm_order");
        return $query->result_array();
    }


    # Get printing details based on particular orders
    public function getPrintDetails($cid=0)
    {
        $this->db->where( "order_reference_id", $cid );
        $this->db->order_by( "pickup_date", "desc" );
        $query = $this->db->get("print_paytm_order_detail");
        return $query->result_array();
    }


    # Get customer details
    public function getCustomer($cid=0)
    {
        $this->db->where( "order_reference_id", $cid );
        $query = $this->db->get("print_paytm_order");
        return $query->result_array();
    }


    public function updateOrdStat($orderid, $status)
    {
        $this->db->set( "order_status", $status );
        $this->db->where( "order_reference_id", $orderid );
        return $this->db->update("print_paytm_order");
    }

}
?>