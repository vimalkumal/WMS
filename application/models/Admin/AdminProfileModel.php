<?php

class AdminProfileModel extends CI_Model{
	public function get_admin_details($userId){
		$userQueary=$this->db->get_where('user',array('iUserId'=>$userId));
		$return_array=$userQueary->result_array();
		return $return_array;

	}

	public function editAdminProfileDetails($params){
		$message="";
		$result=[
			'value'		=>false,
			'message'	=>''
		];
		$is_password_change	= false;
		$is_valid_password	= false;
		
		$userData=array(
			'vName'			=> $params['firstName']." ".$params['lastName'],
			'vFirstNAme'	=> $params['firstName'],		
			'vLastName'		=> $params['lastName'],		
			'vEmail'		=> $params['userEmail'],			
			'iMobileNo'		=> $params['mobileNumber']	
		);

		if($params['userOldPassword'] != md5('') || $params['userNewPassword'] != md5('')){
			$is_password_change=true;
			if(AdminProfileModel::isValidePassword($params['userId'],$params['userOldPassword'])){
				$is_valid_password=true;	
			}
			else{
				$result['value']	= false;
				$message			= "Old Password is not Valid / Check you Credential Information!!";
				$result['message']=$message;
				return $result;
			}
		}
	
		if($is_valid_password){
			$userData['vPassword']= $params['userNewPassword'];
		}
			

		$this->db->where('iUserId',$params['userId']);
		if($this->db->update('user',$userData)){
			$result['value']	= true;
			$message			= "Your Profile has been update successfully.";
		}
		else{
			$result['value']	= false;
			$message			= "Failed to your update profile  Try Again !!";
		
		}
		
		$result['message']=$message;
		
		return $result;
	}

	public function isValidePassword($id_user,$password_user){
		$getUserQuery=$this->db->get_where('user',array('iUserId'=>$id_user,'vPassword'=>$password_user));
		if($getUserQuery->num_rows()==1){
			return true;
		}
		else{
			return false;
		}
	}
}