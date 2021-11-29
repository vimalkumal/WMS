<?php

class AgenciesModel extends CI_Model{
	public function getAgenciesDetails(){
		$message="";
		$result=[
			'value'		=>false,
			'message'	=>''
		];
		// $queary=$this->db->get('user');
		$this->db->select('*');
		$this->db->from('agencies');
		$queary=$this->db->get();
		$result_array=$queary->result_array();
		return $result_array;
	}

	public function getAgencyDetail($id)
	{
		$userId=$this->session->userdata('session_user_id');
		$agencyQueary=$this->db->get_where('agencies',array('iAgencyId'=>$id));
		
		$return_array=array();
		$return_array=$agencyQueary->result_array();
		// pr($return_array,1);
		if(!empty($return_array)){

			foreach ($return_array as $key => $value) {
				$return_array[$key]['city']		= $this->GeneralModel->getWhereTableData('city',array('iCityId'=>$value['iCityId']));
				$return_array[$key]['state']	= $this->GeneralModel->getWhereTableData('state',array('iStateId'=>$value['iStateId']));
				
				$return_array[$key]['country']	= $this->GeneralModel->getWhereTableData('country',array('iCountryId'=>$value['iCountryId']));
				
				$return_array[$key]['user']		= $this->GeneralModel->getWhereTableData('user',array('iUserId'=>$value['iOwnerId']));
			}
			// pr($return_array,1);

			$return_array[$key]['city']			= $return_array[$key]['city'][0];
			$return_array[$key]['state']		= $return_array[$key]['state'][0];
			$return_array[$key]['country']		= $return_array[$key]['country'][0];
			$return_array[$key]['user']			= $return_array[$key]['user'][0];
		}
		return $return_array;
	}

}