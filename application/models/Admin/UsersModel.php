<?php

class UsersModel extends CI_Model{
	public function getUserDetail($user_code){
		$message="";
		$result=[
			'value'		=>false,
			'message'	=>''
		];
		// $queary=$this->db->get('user');
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('roles', "roles.vRoleCode= '$user_code' AND user.iRoleId= roles.iRoleId");
		$queary=$this->db->get();
		$result_array=$queary->result_array();
		return $result_array;
	}
	public function getAgencyUserDetail($user_code){
		$message="";
		$result=[
			'value'		=>false,
			'message'	=>''
		];
		// $queary=$this->db->get('user');
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('roles', "roles.vRoleCode= '$user_code' AND user.iRoleId= roles.iRoleId");
		$queary=$this->db->get();
		$result_array=$queary->result_array();
		return $result_array;

	}

}