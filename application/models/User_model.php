<?php
class User_model extends CI_Model
{

    public function __construct()
    {
            parent::__construct();
            // Your own constructor code
    }

    # Get user by Email Id
    public function findDataByEmail($emailid='')
    {
        $this->db->where("email", $emailid);
        $query = $this->db->get("print_vendor");
        return $query->result_array();
    }

    # Get login details
    public function login($emailid='', $pass='')
    {
        $this->db->where( array("email"=>$emailid, "password"=>md5($pass)) );
        $query = $this->db->get("print_vendor");
        return $query->result_array();
    }

    # Update password based on email id
    public function updatePassByEmail( $pass='', $emailid='' )
    {
        $this->db->set("password", md5($pass));
        $this->db->where("email", $emailid);
        return $this->db->update("print_vendor");
    }

    # Get active vendors list
    public function getVendors()
    {
        $this->db->where("status", "1");
        $this->db->order_by("shop_name", "asc");
        $query = $this->db->get("print_vendor");
        return $query->result_array();
    }


}
?>