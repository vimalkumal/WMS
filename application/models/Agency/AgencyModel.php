<?php

class AgencyModel extends CI_Model{

	public function setAgencyDetails($params)
	{
		$message="";
		$result=[
			'value'		=>false,
			'message'	=>''
		];
		$agencyData=array(
			'vAgencyCode'				=>	$params['agency_code'],
			'vAgencyName'				=>	$params['agency_name'],
			'vAgencyEmail'				=>	$params['agency_email'],
			'vAgencyRegistrationNo'		=>	$params['agency_reg_no'],
			'iPhoneNo'					=>	$params['agency_ph_no'],
			'vAddressLine1'				=>	$params['address_line1'],
			'vAddressLine2'				=>	$params['address_line2'],
			'iPincode'					=>	$params['pincode'],
			'iCityId'					=>	$params['address_city'],
			'iStateId'					=>	$params['address_state'],
			'iCountryId'				=>	$params['address_country'],
			'iOwnerId'					=>	$params['ownerID'],
			'vOwnerName'				=>	$params['ownerName'],
			'eStatus'					=>	$params['status']
		);
		if($params['imageUpload']){
			$agencyData['vAgencyImage']=$params['agency_image'];
		}
		
		
		if($params['mode']=='Add'){
			// pr("Insert",1);
			if($this->db->insert('agencies',$agencyData)){
				$result['value']	= true;
				$message			= "Agency has been added successfully.";
			}
			else{
				$result['value']	= false;
				$message			= "Agency insert proccess failed Try Again !!";
			
			}
		}
		else{
			// pr("Update",1);
			$this->db->where('iAgencyId',$params['agency_id']);
			if($this->db->update('agencies',$agencyData)){
				$result['value']	= true;
				$message			= "Agency has been updated successfully.";
			}
			else{
				$result['value']	= false;
				$message			= "Agency update proccess failed Try Again !!";
			
			}	
		}
		$result['message']=$message;
		
		return $result;
	}

	public function getAgencyRequestRecored($status='')
    {
        
    	

    	// pr($this->session->userdata('session_user_id'));

        $return_data=array();
        $this->db->select('r.iRequestId');
        $this->db->select('r.vRequestCode');
        $this->db->select('r.dtAddedDate');
        $this->db->select('count(ri.iRequestItemId) AS Number_Of_product');
        $this->db->select('r.eStatus');
        $this->db->from('request AS r, request_item AS ri,agencies AS a');
        $this->db->where('r.iRequestId=ri.iRequestId');
        $this->db->where('r.iForeID=a.iAgencyId');
        $this->db->where('a.iOwnerId',$this->session->userdata('session_user_id'));
        $this->db->where('r.eStatus',$status);
        $this->db->group_by('ri.iRequestId');
        $return_data=$this->db->get()->result_array();
        // pr($return_data,1);
        return $return_data;

    }
	
}