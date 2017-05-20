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
    		'created_on' => date("Y-m-d H:i:s"),
            'pickup_date' => trim($_SESSION['user_info']['pickup']),
            'pickup_slot' => trim($_SESSION['user_info']['picktime'])
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
                'file_type' => $filetype[1],
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
    			'binding' => $value['binding']
    		);

    		$this->db->insert('print_paytm_order_detail', $data);
            //return $this->db->last_query();
    	}
    }


    # Get current orders list order by id desc
    public function getCurOrders($vid=0)
    {
        $this->db->select("ppo.*, count(ppod.order_reference_id) as filecount");
        $this->db->from("print_paytm_order ppo");
        $this->db->join("print_paytm_order_detail ppod", "ppod.order_reference_id = ppo.order_reference_id", "left");
        
        if( $vid==0 )
        {
            $this->db->where( array("ppo.order_status !="=>"4") );
        }
        else
        {
            $this->db->where( array("ppo.vendor"=>$vid, "ppo.order_status !="=>"4") );
        }
        
        $this->db->group_by( "ppo.order_reference_id" );
        $this->db->order_by( "ppo.order_reference_id", "desc" );
        $query = $this->db->get();
        return $query->result_array();
        //return $this->db->last_query();
    }


    # Get delivered orders list order by id desc
    public function getOrdersHistory($vid=0)
    {
        $this->db->select("ppo.*, count(ppod.order_reference_id) as filecount");
        $this->db->from("print_paytm_order ppo");
        $this->db->join("print_paytm_order_detail ppod", "ppod.order_reference_id = ppo.order_reference_id", "left");

        if( $vid==0 )
        {
            $this->db->where( array("ppo.order_status ="=>"4") );
        }
        else
        {
            $this->db->where( array("ppo.vendor"=>$vid, "ppo.order_status ="=>"4") );
        }

        $this->db->group_by( "ppo.order_reference_id" );
        $this->db->order_by( "ppo.order_reference_id", "desc" );
        $query = $this->db->get();
        return $query->result_array();
        //return $this->db->last_query();
    }


    # search current orders list 
    public function searchOrders($filterby='', $filterval='', $vid=0)
    {
        $this->db->select("ppo.*, count(ppod.order_reference_id) as filecount");
        $this->db->from("print_paytm_order ppo");
        $this->db->join("print_paytm_order_detail ppod", "ppod.order_reference_id = ppo.order_reference_id", "left");
        
        # CO for Admin
        if( $vid==0 )
        {
            switch($filterby)
            {
            case 'rn':
                $this->db->where( array("ppo.order_status !="=>"4", "ppo.order_reference_no"=>$filterval) );
                break;
            case 'pd':
                $this->db->where( array("ppo.order_status !="=>"4", "ppo.pickup_date"=>$filterval) );
                break;
            case 'od':
                $this->db->where( array("ppo.order_status !="=>"4", "DATE(ppo.created_on)"=>$filterval) );
                break;
            default:
                $this->db->where( array("ppo.order_status !="=>"4") );
                break;
            }
        }
        # CO for Vendor
        else
        {
            switch($filterby)
            {
            case 'rn':
                $this->db->where( array("ppo.vendor"=>$vid, "ppo.order_status !="=>"4", "ppo.order_reference_no"=>$filterval) );
                break;
            case 'pd':
                $this->db->where( array("ppo.vendor"=>$vid, "ppo.order_status !="=>"4", "ppo.pickup_date"=>$filterval) );
                break;
            case 'od':
                $this->db->where( array("ppo.vendor"=>$vid, "ppo.order_status !="=>"4", "DATE(ppo.created_on)"=>$filterval) );
                break;
            default:
                $this->db->where( array("ppo.vendor"=>$vid, "ppo.order_status !="=>"4") );
                break;
            }
        }
        
        $this->db->group_by( "ppo.order_reference_id" );
        $this->db->order_by( "ppo.order_reference_id", "desc" );
        $query = $this->db->get();
        return $query->result_array();
        //return $this->db->last_query();
    }


    # Get printing details based on particular orders
    public function getPrintDetails($cid=0)
    {
        $this->db->where( "order_reference_id", $cid );
        //$this->db->order_by( "pickup_date", "desc" );
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


    # Update order status
    public function updateOrdStat($orderid, $status)
    {
        $this->db->set( "order_status", $status );
        if( $status==4 )
        {
            $this->db->set( "deliver_date", date("Y-m-d H:i:s") );
        }
        $this->db->where( "order_reference_id", $orderid );
        return $this->db->update("print_paytm_order");
    }


    # Insert file download details
    public function trackDownload($opid, $filename)
    {
       $data = array(
        'vendor_id' => $_SESSION['vendorid'],
        'file_id' => $opid,
        'filename' => $filename,
        'd_time' => date("Y-m-d h:i:s")
        );
        return $this->db->insert("trackdownload", $data);
    }


    # Get distinct file id in trackdownload
    public function getPrintIdFromTrackdownload()
    {
        $this->db->select("file_id");
        $this->db->where("file_id !=","");
        $this->db->group_by("file_id");
        $query = $this->db->get("trackdownload");
        return $query->result_array();
    }


    #Get active time slots
    public function getTimeslots()
    {
        $this->db->where("status", "1");
        $query = $this->db->get("print_time_slot");
        return $query->result_array();
    }

}
?>