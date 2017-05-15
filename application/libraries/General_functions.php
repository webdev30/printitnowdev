<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class General_functions {

   	var $CI;
	 var $status_arr = array("0"=>"In Active", "1"=>"Active");
	public function __construct()
    {
		$this->CI = & get_instance();
    }
	
/*function getStatusVal($status_id="")
	{
		return $this->status_arr[$status_id];
	}
	function is_system_admin()
	{
		$system_admin = $this->CI->session->userdata('LoggedIn');
		$groups_id = $this->CI->session->userdata('groups_id');
		if(!(!empty($system_admin) && $system_admin === TRUE && $groups_id == '1'))
		{
			redirect(site_url('myadmin/login'));
			exit;
		} 
	}  
	function getgalleryImg($id="",$table_id="",$order_by="ASC")
	 {
		$CI =& get_instance(); 
		  $where = "";
		  if($id!="")
		  {
			$where .= " AND `gallery_id` = '".$id."'";
		  }
		  
		  if($table_id!="")
		  {
			$where .= " AND `table_id` = '".$table_id."'";
		  }
		  
		  $where .= " order by sort_order $order_by";
		 $sql = "select * from `tbl_gallery` where 1 ".$where;
		 
		 $query = $CI->db->query($sql);
		 $data=array();
		  if($query->num_rows()>0)
		  {
	  // print_r($query->result_array());
	  // exit;
			foreach ($query->result_array() as $row) 
			 {
				 $data[] = $row;
			 }
		  }
		  // print_r($data);
		  // exit;
		  return $data;
	 
	 }
	 */
public function reArrayData(&$data_post){
	
    $data_ary = array();
    $data_count = count($data_post['paper_size']);
     $data_keys = array_keys($data_post);
    for ($i=0; $i<$data_count; $i++){
        foreach ($data_keys as $key){
            $data_ary[$i][$key] = $data_post[$key][$i];
        }
    }
    return $data_ary;
}
public function fun_db_output($string){
		//return stripslashes($string);
		$string = $this->fun_remove_slashes($string);
		$string = stripcslashes($string);
		
		$string=str_replace( "\\", '', $string);
		$string = html_entity_decode($string);
		$string = htmlspecialchars($string);
		$string = htmlspecialchars_decode($string);
		//$string = nl2br($string);
		return $string;
	}
	public function fun_remove_slashes($string){
		if(get_magic_quotes_gpc()){
			return $string=ereg_replace("\\\\","",$string);
		}else{
			return $string;
		}
	}
	function createStatusList($status_id="")
	{

		$this_list = '';
		foreach($this->status_arr as $s_id => $s_name)
		{
			if($status_id == $s_id)
			{
				$this_list .= "<OPTION value=\"" . $s_id . "\"  selected >" . $s_name . "</OPTION>";
			}
			else
			{
				$this_list .= "<OPTION value=\"" . $s_id . "\" >" . $s_name . "</OPTION>";
			}	
		}
			
		return $this_list;
	}

	
	function date_to_display($datetime)
	{
		if(!empty($datetime))
		{
			$data_arr = explode(" ",$datetime);
			$date = $data_arr[0];
			$date_format = $this->CI->config->item('date_format');
			return date($date_format,strtotime($date));
		}else{
			return '';
		}
	}

	function datetime_to_display($datetime)
	{
		if(!empty($datetime))
		{
			$date_time_format = $this->CI->config->item('date_time_format');
			return date($date_time_format,strtotime($datetime));		
		}else{
			return '';
		}		
	}
// function date_to_display($date)
// {
	
	// list($year, $month, $day) = preg_split("/[\/.-]/", $date);

	// return $day."/".$month."/".$year;
// }
	function date_to_store($date)
	{
		list($day, $month, $year) = preg_split("/[\/.-]/", $date);
		return $year."/".$month."/".$day;
	}
   function make_drop_down_1($table_name,$value_field,$display_field,$default_options='')
	{
		$this->CI->db->from($table_name);
		$this->CI->db->where('parent_id',0);
		$result = $this->CI->db->get()->result();
		if($default_options != '')
		{
			if(is_array($default_options))
			{
				foreach ($default_options as $key => $value) {
					$options[$key] = $value;
				}
			}else{
				$options[''] = $default_options;
			}
		}	
		foreach($result as $row)
		{
			$options[$row->$value_field] = $row->$display_field;
		}
		return $options;		
	}
	
	
	function make_drop_down($table_name,$value_field,$display_field,$default_options='')
	{
		$this->CI->db->from($table_name);
		$result = $this->CI->db->get()->result();
		if($default_options != '')
		{
			if(is_array($default_options))
			{
				foreach ($default_options as $key => $value) {
					$options[$key] = $value;
				}
			}else{
				$options[''] = $default_options;
			}
		}	
		foreach($result as $row)
		{
			$options[$row->$value_field] = $row->$display_field;
		}
		return $options;		
	}

	function show_val_from_table($id,$table_name,$id_field,$value_field)
	{
		if(!empty($id) && $id != '')
		{
			$this->CI->db->from($table_name);
			$this->CI->db->where($id_field,$id);
			$res = $this->CI->db->get()->row()->$value_field;
			return $res;
		}
	}

	public function getTableData($table_name="",$data_field="",$data_id="",$result_field="")
	{	$field_result = '';
		if(!empty($table_name) && !empty($data_field) && !empty($data_id) && !empty($result_field))
		{
		
			$sql= "select $result_field from $table_name where $data_field='$data_id'";

//if($table_name=="tbl_articles" && $result_field=='title'){echo'<br>'.$sql;exit;}		

			$query = $this->CI->db->query($sql);
//echo'<br>'.$this->CI->db->last_query();			
			//return $query->num_rows();
			foreach($query->result() as $row)
			{
				$field_result = $row->$result_field;	
			}
		}
		return	$field_result;
	}

	function show_val_from_array($id,$array)
	{
		foreach($array as $key => $value)
		{
			if($key == $id)
			{
				return $value;
			}
		}
	}

	function show_group_name($id)
	{
		if(!empty($id) && $id > 0 )
		{
			$this->CI->load->model('group_model');
			$row = $this->CI->group_model->get_list($id);
			return $row[0]->name;
		}
	}
public function trim_text($text, $count)
	{	$trimed='';
		$ar_string = explode("-", $text);
		if(sizeof($ar_string) < $count)
		{
			$count=sizeof($ar_string);
		}
		for($wordCounter=0; $wordCounter < $count ; $wordCounter++ )
		{ 
			$trimed .= $ar_string[$wordCounter];
			if ( $wordCounter < $count-1 )
				{$trimed .= "-"; }
		}
		return $trimed;
	}


	#Email Function
	public function send_emailer($from_email="", $from_name="", $to_email="", $subject="",$message="", $cc_email="", $bcc_email="",$protocol="",$smtp_host="",$smtp_port="",$smtp_user="",$smtp_pass="") 
	{
    	if($protocol=='smtp')
        {
        	$config = Array(
              	'protocol' => $protocol,
              	'smtp_host' => $smtp_host,
              	'smtp_port' => $smtp_port,
              	'smtp_user' => $smtp_user, // change it to yours
              	'smtp_pass' => $smtp_pass, // change it to yours
              	'mailtype' => 'html',
              	'charset' => 'iso-8859-1',
              	'wordwrap' => TRUE
			);
        }
        else
        {
            $config = Array(
	            'mailtype' => 'html',
	            'charset' => 'iso-8859-1',
	            'wordwrap' => TRUE
            );
        }
                
        $this->CI->load->library('email',$config);
        $this->CI->email->set_mailtype("html");
        //$this->CI->email->from($from_email, $from_name);
        $this->CI->email->from($from_email, $from_name);
		//$this->CI->email->reply_to($from_email, $from_name); //reply_to($replyto, $name = '')
        $this->CI->email->to($to_email);
        
        if(!empty($cc_email))
        {
            $this->CI->email->cc($cc_email);
        }
        
        if(!empty($bcc_email))
        {
            $this->CI->email->bcc($bcc_email);
        }

        $this->CI->email->subject($subject);
        $this->CI->email->message($message);

        return $this->CI->email->send();

        //return $this->CI->email->print_debugger();
	}


	# Check desired image format
	public function checkImage($imagetype='')
	{
		$imgExt = array("jpg", "jpeg", "png", "doc", "docx", "pdf", "ppt");
		if( $imagetype!='' )
		{
			foreach ($imgExt as $value)
			{
				if( $imagetype==$value )
				{
					return 1;
				}
			}
			return 0;
		}
		else
		{
			return 0;
		}
	}


	/*function PermissionAuthentication($controller="",$function="")
	{ 
		$url = "";
		$login_person_info = $this->CI->session->userdata('system_admin');
		$user_id = $login_person_info->id;	
		$group_id = $login_person_info->groups_id;
		$result = $this->checkpermission($group_id,$user_id);
		if($controller !="")
		{
			$url .= $controller."/";
		}
		if($function !="" && $function !="page" && $function !="index")
		{
			$url .= $function."/";
		}
		$system_permission = $this->CI->session->userdata('system_permission');
		if(is_array($result))
		{
			if (!in_array($url, $result))
			{
				$this->CI->session->set_flashdata('msg', '<font color=Red>Unauthorized Access !</font><br />');
				redirect(site_url('myadmin/dashboard'),'refresh');
			}
			else
			{
				return true;
			}
		}
		else
		{
			redirect(site_url('myadmin/dashboard'),'refresh');
		}
	}	
	*/

//<!-- Course level Box --> 


//<!-- Course level Box --> 	


//<!-- Stream Box --> 

//<!-- Stream Box --> 

//<!-- Country Box --> 

//<!-- Country Box --> 

//<!-- Course Type Box --> 

//<!-- Course Type Box --> 


//<!-- Duration Box --> 

//<!-- Duration Box --> 

////////////////	Title URL	/////////////

	
}##end of class
?>
