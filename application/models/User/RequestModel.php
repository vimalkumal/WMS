<?php

class RequestModel extends CI_Model{



	public function getProductInfo($p_id=0,$c_id=0){
		$message="";
		$result=[
			'value'		=>false,
			'message'	=>''
		];
		if($c_id!=0){
			if($c_id==1){
				$this->db->where('product.iCategoryId','1');
			}
			else{
				$this->db->where('product.iCategoryId!=','1');	
			}
		}

		if($p_id!=0){
			$this->db->where('iProductId',$p_id);
		}
		$this->db->select('*');
		$this->db->from('product');
		$this->db->join('category', "category.iCategoryId= product.iCategoryId");
		$queary=$this->db->get();


		$result_array=$queary->result_array();
		
		return $result_array;
	}

	public function setRequestDetails($params)
	{
		// var_dump($params);
		$message="";
		$result=[
			'value'		=>false,
			'message'	=>''
		];
		
		//-------- Insert into Request table ------------ //
		// pr($params['request_date'],1);
 		// pr(date('Y-m-d H:i:s', $params['request_date']),1);
		$requestData=array(
			'vRequestCode'			=> $params['request_code'],
			'iAddressId'			=> $params['request_address'],
			'dtAddedDate'			=> strval($params['request_date']),
			'iAddedBy'				=> $params['request_by'],	
			'eStatus'				=> $params['request_status'],
			"vServiceCollection"	=> $params['servic_collection_code']
		);
		if($this->db->insert('request',$requestData)){
			$request_id= $this->db->insert_id();
			//-------- Insert into Request Item  table ------------ //
			$request_item_data=array();
			$noOfItem=0;
			foreach ($params['request_product_array'] as $key => $value) {
				
				$noOfItem+=1;

				$request_item_code=$requestData['vRequestCode']."/I".$noOfItem;
				$item_data=[
					'vRequestItemCode'	=>	$request_item_code,
					'iRequestId'		=>	$request_id,
					'iProductId'		=>	$key,
					'dQuantity'			=>	$value
				];
				array_push($request_item_data, $item_data);
			
			}
			//batch insert in item Request
			if($this->db->insert_batch('request_item', $request_item_data)){
				$result['last_added_request']=$request_id;
				$result['value']	= true;
				$message			= "Order has been placed successfully";
			}
			else{
				$result['value']	= false;
				$message			= "Order Place proccess failed Try Again !!";	
			}
			// pr($request_item_data,1);
		}else{
			$result['value']	= false;
			$message			= "Order Placed Proccess Failed Try Again !!";
		}
		$result['message']=$message;
		
		return $result;
	}

	public function getProductRequestData($uId)
	{
		$return_array=array();
		$this->db->order_by('vRequestCode','DESC');
		$req_qeary=$this->db->get_where('request',array('iAddedBy'=>$uId));
		$return_array=$req_qeary->result_array();

		foreach ($return_array as $key => $value) {

			if($value['iForeID']==0){
				$return_array[$key]['agency_name']=tba_value();
			}
			elseif ($value['iForeID']==-1) {
				$return_array[$key]['agency_name']=na_value();
			}
			else{
				$agency_array=$this->GeneralModel->getWhereTableData('agencies',array("iAgencyId"=> $value['iForeID'] ));
				$return_array[$key]['agency_id']=$agency_array[0]['iAgencyId'];	
				$return_array[$key]['agency_name']=$agency_array[0]['vAgencyName'];
				$return_array[$key]['agency_info']=$agency_array[0];
			}

			$product_no=$this->GeneralModel->getWhereTableData('request_item',array("iRequestId"=>$value['iRequestId']));
			$return_array[$key]['total_product']=sizeof($product_no);	

			//add ReceivedDate value
			$rec_date="";
			if($value['eStatus']=="Cancel"){
				$rec_date=na_value();
			}
			elseif(strval($value['dtReceivedDate'])=="0000-00-00" || strval($value['dtReceivedDate'])=="0000-00-00 00:00:00"){
				$rec_date=tba_value();
			}	
			else{
				$rec_date=date("d/m/Y",strtotime($value['dtReceivedDate']));
			}
			$return_array[$key]['dateOfReceived']=$rec_date;
			
		}
		// pr($return_array,1);
		return $return_array;
	}
	public function getProductRequestItemData($id_request)
	{
		$return_result_array=array();
		$totla_rec_point=0;
		$totla_rec_point_format="";
		// request data 
		$return_result_array['requestData']=array();
		$request_array=RequestModel::getProductRequestData($this->session->userdata('session_user_id'));
		foreach ($request_array as $key => $value) {
			if($value['iRequestId']==$id_request){
				
				$return_result_array['requestData']	=	$request_array[$key];
				
				$address_info_array					=	$this->GeneralModel->getWhereTableData('address',array('iAddressId'=>$request_array[$key]['iAddressId']));
				$return_result_array['requestData']['Address_info']=$address_info_array[0];
			}
		}
		
		// request item data
		$return_result_array['requestItemData']=array();
		$return_result_array['requestItemData']=$this->GeneralModel->getWhereTableData("request_item",array("iRequestId"=>$id_request));
		foreach ($return_result_array['requestItemData'] as $key => $value) {

			$product_data=$this->GeneralModel->getWhereTableData("product",array("iProductId"=>$value['iProductId']));

			$product_cat_data=$this->GeneralModel->getWhereTableData("category",array("iCategoryId"=>$product_data[0]['iCategoryId']));

			$return_result_array['requestItemData'][$key]['product_info']=$product_data[0];
			$return_result_array['requestItemData'][$key]['p_category_info']=$product_cat_data[0];

			$recQu="NA";
			$recPoint=0;
			if(!empty($return_result_array['requestData'])){
				switch ($return_result_array['requestData']['eStatus']) {
					case 'Pending':
					case 'Approved':
						$recQu 						= tba_value();
						$recPoint 					= tba_value();
						$totla_rec_point_format		= tba_value();
						break;
					case 'Cancel':
						$recQu 						= na_value();
						$recPoint 					= na_value();
						$totla_rec_point_format		= na_value();
						break;
					case 'Collected':
						$recQu=$return_result_array['requestItemData'][$key]['dReceivedQuantity']." ";
						$recQu.=$return_result_array['requestItemData'][$key]['product_info']['vProductUnit'];
						$recPoint=$return_result_array['requestItemData'][$key]['dReceivedPoint'];
						$totla_rec_point+=$recPoint;
						$totla_rec_point_format		= number_format($totla_rec_point,2);
						break;
				}
			}
			$return_result_array['requestItemData'][$key]['receivedQuantityFormat']	=$recQu;
			$return_result_array['requestItemData'][$key]['receivedPoint']	=$recPoint;
			
		}
		
		// pr($return_result_array['requestData'],1);
		if (!empty($return_result_array['requestData'])) {
			$return_result_array['requestData']['totalReceivedPoint']	=$totla_rec_point_format;
			if($return_result_array['requestData']['eStatus']=="Approved" || $return_result_array['requestData']['eStatus']=="Collected")
			{
				$ownerId 								= $return_result_array['requestData']['agency_info']['iOwnerId'];
				$return_result_array['agency_owner']	= $this->GeneralModel->getWhereTableData("user",array("iUserId"=>$ownerId))[0];	
			}	
		}
		
		// pr('Model');
		// $return_result_array['requestData']['totalReceivedPoint']	=$totla_rec_point_format;
		// pr($return_result_array,1);

		return $return_result_array;
	}

	public function updateRequestDetails($params)
	{
		$message="";
		$result=[
			'value'		=>false,
			'message'	=>''
		];
		//Update request Detail
		$is_request_update=$this->GeneralModel->editWhereTableData('request','iRequestId',$params['requestId'],array('iAddressId'=>$params['addressId']));
		//Update request Item Detail
		$update_array=array();
		foreach ($params['reqItemArray'] as $key => $value) {
			$request_item=[
				'iRequestItemId'=>$key,
				'dQuantity'=>$value
			];
			array_push($update_array, $request_item);
		}
		// pr($is_request_update);
		try {

			if($this->db->update_batch('request_item',$update_array, 'iRequestItemId') && $is_request_update)
			{

				$result['value']	= true;
				$message			= "Order has been update successfully";
			}
			else{
				
				  if($this->db->error()['message']==""){
				  	$result['value']	= true;
					$message			= "Order has been update successfully";
				  }else{
					$result['value']	= false;
					$message			= "Order Update Proccess Failed Try Again !!";	  	
				  }
				
			}
			
		} catch (Exception $e) {
			pr($e,1);
		}
		
		$result['message']=$message;
		return $result;
	}
}