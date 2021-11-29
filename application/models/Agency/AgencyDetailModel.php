<?php

class AgencyDetailModel extends CI_Model{

	public function fetch_agency_detail()
	{
		$userId=$this->session->userdata('session_user_id');
		$agencyQueary=$this->db->get_where('agencies',array('iOwnerId'=>$userId));
		
		$return_array=$agencyQueary->result_array();

		// pr($return_array[$key]['iCountryId'],1);
		foreach ($return_array as $key => $value) {
			$return_array[$key]['city']		= $this->GeneralModel->getWhereTableData('city',array('iCityId'=>$return_array[$key]['iCityId']));

			$return_array[$key]['state']	= $this->GeneralModel->getWhereTableData('state',array('iStateId'=>$return_array[$key]['iStateId']));
			
			$return_array[$key]['country']	= $this->GeneralModel->getWhereTableData('country',array('iCountryId'=>$return_array[$key]['iCountryId']));
			
			$return_array[$key]['user']		= $this->GeneralModel->getWhereTableData('user',array('iUserId'=>$return_array[$key]['iOwnerId']));
		}
		
		// pr(sizeof($return_array[$key]['country']),1);
		$return_array[$key]['city']			= sizeof($return_array[$key]['city'])<=0?na_value():$return_array[$key]['city'][0]['vCityName'];
		$return_array[$key]['state']		= sizeof($return_array[$key]['state'])<=0?na_value():$return_array[$key]['state'][0]['vStateName'];
		$return_array[$key]['country']		= sizeof($return_array[$key]['country'])<=0?na_value():$return_array[$key]['country'][0]['vCountryName'];
		$return_array[$key]['user']			= sizeof($return_array[$key]['user'])<=0?na_value():$return_array[$key]['user'][0];
		// pr($return_array);
		// pr($return_array,1);
		return $return_array;
	}
}