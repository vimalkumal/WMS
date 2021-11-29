<?php

class LoginModel extends CI_Model{

	public function setUserInformation($params){
		$message="";
		$result=[
			'value'		=>false,
			'message'	=>''
		];
		$userData=array(
			'vName'			=> $params['firstName']." ".$params['lastName'],
			'vFirstNAme'	=> $params['firstName'],		
			'vLastName'		=> $params['lastName'],		
			'vEmail'		=> $params['userEmail'],			
			'iMobileNo'		=> $params['mobileNumber'],		
			'vPassword'		=> $params['userPassword'],		
			'iRoleId'		=> $params['userType'],		
		);

		if($this->db->insert('user',$userData)){

			


			$result['value']	= true;
			$message			= "Registration successfully.";
		}
		else{
			$result['value']	= false;
			$message			= "Registration Failed Try Again !!";
		
		}
		
		$result['message']=$message;
		
		return $result;
	}

	public function isValideUser($params){
		$result=[
			'value'=>false,
			'message'=>''
		];

		$query_login=$this->db->get_where('user',array('vEmail'		=> $params['id'],
												 	   'vPassword'	=> $params['password'],
												 		'eStatus'	=> "Active") );
		$nRow=$query_login->num_rows();
		if($nRow==1){
			
			$queryResult=$query_login->result_array();
			$role_value='';
			$this->session->set_userdata("user_name"			,$queryResult[0]['vName']);
			$this->session->set_userdata("session_user_id"		,$queryResult[0]['iUserId']);
			$this->session->set_userdata("user_email"			,$queryResult[0]['vEmail']);
			$this->session->set_userdata("user_mobileNumber"	,$queryResult[0]['iMobileNo']);
			$this->session->set_userdata("user_role"			,$queryResult[0]['iRoleId']);
			$this->session->set_userdata("user_image"			,$queryResult[0]['vUserImage']);
			

			switch ($queryResult[0]['iRoleId']){
			
				case 1:
					$role_value="Admin";
					break;
			
				case 2:
					$role_value="Agency";
					break;
			
				case 3:
					$role_value="User";
					break;
			}
			$this->session->set_userdata("user_role_value"			,$role_value);
			
			$result['role_type']=$role_value;
			$result['value']=true;
			$result['message']='Welcome';
		}
		else{
			$result['message']="Invalid User id and Password";
		}
		
		return $result;
	}

	public function isAgencyExist($params)
	{
		// pr($params,1);
		$iRows=$this->db->get_where("agencies",array('iOwnerId'=>$params['id']))->num_rows();
		if($iRows===1){
			$this->session->set_userdata('agencyRegister',true);
			return true;
		}
		else{
			return false;
		}
	}

	public function changePassword($params)
	{
		$message="";
		$result=[
			'value'		=>false,
			'message'	=>''
		];
		$userData['vPassword']	= md5($params['new_password']);
		$this->db->where('vEmail',$params['email']);
		
		if($this->db->update('user',$userData)){
			$result['value']	= true;
			$message			= "New Password Send in your email address Login Now.";
		}
		else{
			$result['value']	= false;
			$message			= "Something went wrong please try again.";
		
		}
		$result['message']=$message;
		return $result;
	}
}