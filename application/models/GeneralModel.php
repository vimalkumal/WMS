<?php

class GeneralModel extends CI_Model{

	public function getRoleList(){
		$this->db->where('eStatus','Active');
		$this->db->where('iRoleId !=','1');
		$this->db->order_by("vRoleName", "desc");
		$queary=$this->db->get('roles');
		return $queary->result_array();
	}

	public function getFieldValue($tableName='',$valCoumnName='',$matchId='',$conditionColumn=''){
		$result_array=array();
		$this->db->select($valCoumnName);
		$getQuery=$this->db->get_where($tableName,array($conditionColumn=>$matchId));

		$resultArray=$getQuery->result_array();
		return $resultArray[0][$valCoumnName];
	}
	
	public function getWhereTableData($table_name,$condition_array)
	{
		$queary=$this->db->get_where($table_name,$condition_array);
		return $queary->result_array();
	}
	public function editWhereTableData($table_name,$condition_key,$condition_value ,$update_array)
	{
		// $condition_key	: columan_name
		// $condition_value : columan value
		$this->db->where($condition_key,$condition_value);
        if($this->db->update($table_name, $update_array)){
        	return true;
        }
        else{
        	return false;
        }
	}
	public function getLastCodeValue($table_name,$order_by,$order_value='ASC')
	{
		$this->db->order_by($order_by,$order_value);
		$queary 	= $this->db->get($table_name);
		$result 	= $queary->result_array();
		if(!empty($result) or sizeof($result)>0){
			$val_array 	= explode('/', $result[0][$order_by]);
			$ret_val	= $val_array[sizeof($val_array)-1];	
			// $ret_val=sizeof($result);
		}
		else{
			$ret_val=0;
		}

		
		return $ret_val;
	}
	public function sendMail($email_params)
	{
		// email_params array contains .
			// user_email
			// subject
			// message

		// ---------------------------------------------------------------------
		// ---------------------------------------------------------------------
		$this->load->library('email');

		//SMTP & mail configuration
		$config = array(
		    'protocol'  => 'smtp',
		    'smtp_host' => 'ssl://smtp.googlemail.com',
		    'smtp_port' => 465,
		    'smtp_user' => 'vimaldhanani.glsica16@gmail.com',
		    'smtp_pass' => 'v8460505095',
		    'mailtype'  => 'html',
		    'charset'   => 'utf-8'
		);
		$this->email->initialize($config);
		$this->email->set_mailtype("html");
		$this->email->set_newline("\r\n");

		
 
		$this->email->to($email_params['user_email']);
		$this->email->from('vimaldhanani.glsica16@gmail.com','WMS : '.$email_params['subject']);
		$this->email->subject($email_params['subject']);
		$this->email->message($email_params['message']);

		// Send email
		if($this->email->send()){
			
			return true;
		}
		else
		{
			// show_error($this->email->print_debugger());exit();
			return false;

		}
	}
}