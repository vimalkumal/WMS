<?php

class AdminRequestModel extends CI_Model{



	public function getProductInfo($id=0){
		$message="";
		$result=[
			'value'		=>false,
			'message'	=>''
		];
		
		if($id!=0){
			$this->db->where('iProductId',$id);
		}
		$this->db->select('*');
		$this->db->from('product');
		$this->db->join('category', "category.iCategoryId= product.iCategoryId");
		$queary=$this->db->get();


		$result_array=$queary->result_array();
		
		return $result_array;
	}


	public function getRequestData()
	{
		$return_array=array();
		$this->db->order_by('vRequestCode','DESC');
		$req_qeary=$this->db->get('request');
		$return_array=$req_qeary->result_array();
		// pr($return_array,1);
		foreach ($return_array as $key => $value) {
			
			// add agency information
			if($value['iForeID']==0){
				$return_array[$key]['agency_name']=tba_value();
			}
			elseif($value['iForeID']==-1) {
				$return_array[$key]['agency_name']=na_value();	
			}
			else{
				$agency_array=$this->GeneralModel->getWhereTableData('agencies',array("iAgencyId"=> $value['iForeID'] ));
				
				$return_array[$key]['agency_id']=$agency_array[0]['iAgencyId'];	
				$return_array[$key]['agency_name']=$agency_array[0]['vAgencyName'];
				$return_array[$key]['agency_info']=$agency_array[0];	
			}

			// add user information
			$usery_array=$this->GeneralModel->getWhereTableData('user',array("iUserId"=> $value['iAddedBy'] ));
			$return_array[$key]['user_id']=$usery_array[0]['iUserId'];	
			$return_array[$key]['user_name']=$usery_array[0]['vName'];	
			$return_array[$key]['user_info']=$usery_array[0];	
			
			//add number of product information
			$product_no=$this->GeneralModel->getWhereTableData('request_item',array("iRequestId"=>$value['iRequestId']));
			$return_array[$key]['total_product']=sizeof($product_no);

			//add ReceivedDate value
			$rec_date="";
			if($value['eStatus']=="Cancel"){
				$rec_date=na_value();
			}
			elseif(strval($value['dtReceivedDate'])=="0000-00-00 00:00:00" || strval($value['dtReceivedDate'])=="0000-00-00"){
				$rec_date=tba_value();
			}
			else{
				$rec_date=date("d/m/Y ",strtotime($value['dtReceivedDate']));
			}
			$return_array[$key]['dateOfReceived']=$rec_date;
			
		}
		// pr($return_array,1);
		return $return_array;
	}
	public function getProductRequestItemData($id_request)
	{
		$return_result_array=array();
		$return_result_array['requestData']=array();
		$return_result_array['requestItemData']=array();
		// request data 
		$request_array=AdminRequestModel::getRequestData($this->session->userdata('session_user_id'));
		foreach ($request_array as $key => $value) {
			if($value['iRequestId']==$id_request){
				
				$return_result_array['requestData']	=	$request_array[$key];
				
				$address_info_array					=	$this->GeneralModel->getWhereTableData('address',array('iAddressId'=>$request_array[$key]['iAddressId']));

				$return_result_array['requestData']['Address_info']=$address_info_array[0];
			}
		}
		
		// request item data
		$return_result_array['requestItemData']=$this->GeneralModel->getWhereTableData("request_item",array("iRequestId"=>$id_request));
		foreach ($return_result_array['requestItemData'] as $key => $value) {
			$product_data=$this->GeneralModel->getWhereTableData("product",array("iProductId"=>$value['iProductId']));

			$product_cat_data=$this->GeneralModel->getWhereTableData("category",array("iCategoryId"=>$product_data[0]['iCategoryId']));

			$return_result_array['requestItemData'][$key]['product_info']=$product_data[0];
			$return_result_array['requestItemData'][$key]['p_category_info']=$product_cat_data[0];

			$recQu="NA";
			if(!empty($return_result_array['requestData'])){

				switch ($return_result_array['requestData']['eStatus']) {
					case 'Pending':
					case 'Approved':
						$recQu=tba_value();
						break;
					case 'Cancel':
						$recQu=na_value();
						break;
					case 'Collected':
						$recQu=$return_result_array['requestItemData'][$key]['dReceivedQuantity']." ";
						$recQu.=$return_result_array['requestItemData'][$key]['product_info']['vProductUnit'];
						break;
				}
			}
			$return_result_array['requestItemData'][$key]['receivedQuantityFormat']	=$recQu;			
		}
		if(!empty( $return_result_array['requestData']))
		{
			if($return_result_array['requestData']['eStatus']=="Approved" || $return_result_array['requestData']['eStatus']=="Collected")
			{
				$ownerId 								= $return_result_array['requestData']['agency_info']['iOwnerId'];
				$return_result_array['agency_owner']	= $this->GeneralModel->getWhereTableData("user",array("iUserId"=>$ownerId))[0];	
			}
		}
		// pr($return_result_array,1);
		return $return_result_array;
	}

	public function updateAgencyStatus($params)
	{
		// $status_val='Pending';
		$result=[
		'value'=>false,
		'message'=>''
		];

		switch ($params['status']) {
			case 'Approved':
				$request_status=[
				'iForeID'=>$params['agencyId'],
				'eStatus'=>'Approved'
				];
				break;
			case 'Cancel':
				$request_status=[
				'iForeID'=>'-1',
				'eStatus'=>'Cancel'
				];
				break;
			case 'Accept':
				$request_status=[
				'eStatus'=>'Accept',
				'dtReceivedDate'=>$params['receivedDate']
				];
				break;
			case 'Denied':
				$request_status=[
				'iForeID'=>'0',
				'eStatus'=>'Pending'
				];
				break;
		}
		

		$this->db->where('iRequestId',$params['requestId']);
		if($this->db->update('request',$request_status)){
			$result['value']	= true;
			$message			= "Request has been ".$params['status']." successfully.";
		}
		else{
			$result['value']	= false;
			$message			= "Failed to Request ".$params['status']." Try Again !!";
		
		}
		
		$result['message']=$message;

		return $result;
	}
}