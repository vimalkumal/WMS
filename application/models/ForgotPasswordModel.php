<?php

class ForgotPasswordModel extends CI_Model{

	public function isValidEmail($params){
		$result=[
			'value'=>false,
			'message'=>''
		];

		$query_login=$this->db->get_where('user',array('vEmail'		=> $params['email']));
		$nRow=$query_login->num_rows();
		if($nRow==1){
			$result['value']=true;
			
			$result['user_data']=$query_login->result_array()[0];
			
		}
		else{
			$result['message']="Email Id is Not Registered.";
		}

		return $result;
	}

	public function isAgencyExist($params)
	{
		
		$iRows=$this->db->get_where("agencies",array('iOwnerId'=>$params['id']))->num_rows();
		if($iRows===1){
			$this->session->set_userdata('agencyRegister',true);
			return true;
		}
		else{
			return false;
		}
	}
}