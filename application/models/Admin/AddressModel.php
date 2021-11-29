<?php

class AddressModel extends CI_Model{

	public function getAddressDetails($addressId)
	{
		$ret_array=array();
		$address_get_query=$this->db->get_where('address',array('iAddressId'=>$addressId));

		
		$ret_array=$address_get_query->result_array();
		
		return $ret_array;
	}

	public function deleteAddress($params_id){
		$message="";
		$result=[
			'value'		=>false,
			'message'	=>''
		];
		$this->db->where('iAddressId',$params_id);
		if($this->db->update('address',array('eDelete'=>"Yes"))){
			$result['value']	= true;
			$message			= "Addess has been delete successfully.";
		}
		else{
			$result['value']	= false;
			$message			= "Addess delete proccess failed Try Again !!";	
		}
		$result['message']=$message;
		return $result;
	}
	public function getFieldValue($tableName='',$valCoumnName='',$matchId='',$conditionColumn=''){
		$result_array=array();
		$this->db->select($valCoumnName);
		$getQuery=$this->db->get_where($tableName,array($conditionColumn=>$matchId));

		$resultArray=$getQuery->result_array();
		return $resultArray[0][$valCoumnName];
	}

	public function fetch_address_list($userId){

		$addressQuery=$this->db->get_where("address",array("iUserId"=>$userId,"eDelete"=>'No'));
		$address_array=$addressQuery->result_array();
		foreach ($address_array as $key => $value){
			$address_array[$key]['countryName']=$this->getFieldValue('country','vCountryName',$address_array[$key]['iCountryId'],'iCountryId');
			$address_array[$key]['stateName']=$this->getFieldValue('state','vStateName',$address_array[$key]['iStateId'],'iStateId');
			$address_array[$key]['cityName']=$this->getFieldValue('city','vCityName',$address_array[$key]['iCityId'],'iCityId');
		}
		return $address_array;
	}
	public function fetch_country_list()
	{
		$this->db->order_by("vCountryName", "ASC");
		$query = $this->db->get("country");
		
		return $query->result();
	}

	public function fetch_state_list($countryId){

		/**
		* Fetch State List base on Country
		 *
		 * Accepts 1 parameters of countryId, 
		 * @param	int				the value of the CountryId for get country list
		 * @return	html 			option value of State Name
		 * @callBy 	CI_Controller	ZomatoSearchController
		 */
		
		$this->db->where('iCountryId', $countryId);
		$this->db->order_by('vStateName', 'ASC');
		
		$query = $this->db->get('state');
		$output = '<option value="">Select State</option>';

		foreach($query->result() as $row)
		{

		 $output .= '<option value="'.$row->iStateId.'">'.$row->vStateName.'</option>';
		
		}
		
		return $output;
	}

	public function fetch_city_list($stateId){

		/**
		* Fetch City List base on State
		 *
		 * Accepts 1 parameters of stateId, 
		 * @param	int				the value of the StateId for get city list
		 * @return	html		option value of City Name
		 * @callBy 	CI_Controller	ZomatoSearchController
		 
		 */
		$this->db->where('iStateId', $stateId);
		$this->db->order_by('vCityName', 'ASC');
		
		$query = $this->db->get('city');
		$output = '<option value="">Select City</option>';
		
		foreach($query->result() as $row)
		{
		
		 $output .= '<option value="'.$row->iCityId.'">'.$row->vCityName.'</option>';
		
		}
		
		return $output;
	}

	public function setAddressDetails($params){
		$message="";
		$result=[
			'value'		=>false,
			'message'	=>''
		];
		$dataArray=array(
			'iUserId'			=> $this->session->userdata('session_user_id'),
			'vAddressTitle'		=> $params['address_title'],
			'vAddressLine1'		=> $params['address_line1'],
			'vAddressLine2'		=> $params['address_line2'],
			'iCountryId'		=> $params['address_country'],
			'iStateId'			=> $params['address_state'],
			'iCityId'			=> $params['address_city'],
			'iPincode'			=> $params['pincode'],
			'vLatitude'			=> $params['latitude'],
			'vLongitude'		=> $params['longitude'],
			'eStatus'			=> $params['status'],
		);

		if($params['address_id']=='' || $params['address_id']==Null){
			if($this->db->insert('address',$dataArray)){
				$result['value']	= true;
				$message			= "Address has been added successfully";
			}
			else{
				$result['value']	= false;
				$message			= "Failed Add Address Process !!";
			
			}
		}
		else{
			// pr("Update",1);
			$this->db->where('iAddressId',$params['address_id']);
			if($this->db->update('address',$dataArray)){
				$result['value']	= true;
				$message			= "Address has been Updated successfully.";
			}
			else{
				$result['value']	= false;
				$message			= "Address update proccess Failed Try Again !!";
			
			}	
		}
		
		$result['message']=$message;
		
		return $result;
	}
}