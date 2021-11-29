<?php

class AgencyRequestModel extends CI_Model{



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
		$agency_data=$this->GeneralModel->getWhereTableData('agencies',array("iOwnerId"=> $this->session->userdata('session_user_id')));
		// pr($agency_data);

		$return_array=array();
		$this->db->order_by('vRequestCode','DESC');
		$req_qeary=$this->db->get_where('request',array('iForeID'=>$agency_data[0]['iAgencyId']));

		$return_array=$req_qeary->result_array();
		// pr($return_array,1);
		if(!empty($return_array)){
			
			foreach ($return_array as $key => $value) {
				
				
				$usery_array=$this->GeneralModel->getWhereTableData('user',array("iUserId"=> $value['iAddedBy']));
				
				$return_array[$key]['user_id']=$usery_array[0]['iUserId'];	
				$return_array[$key]['user_name']=$usery_array[0]['vName'];	
				$return_array[$key]['user_info']=$usery_array[0];	

				

				$product_no=$this->GeneralModel->getWhereTableData('request_item',array("iRequestId"=>$value['iRequestId']));
				$return_array[$key]['total_product']=sizeof($product_no);	
				//add ReceivedDate value
				$rec_date="";
				if(strval($value['dtReceivedDate'])=="0000-00-00" || strval($value['dtReceivedDate'])=="0000-00-00 00:00:00"){
					$rec_date=tba_value();
				}	
				elseif($value['eStatus']=="Cancel"){
					$rec_date=na_value();
				}
				else{
					$rec_date=date("d/m/Y",strtotime($value['dtReceivedDate']));
				}
				$return_array[$key]['dateOfReceived']=$rec_date;
			}
		}
		// pr($return_array,1);
		return $return_array;
	}
	public function getProductRequestItemData($id_request)
	{
		$return_result_array=array();
		$return_result_array['requestData']=array();
		$return_result_array['requestItemData']=array();
		$totla_rec_point=0;
		$totla_rec_point_format="";
		// request data 
		$request_array=AgencyRequestModel::getRequestData($this->session->userdata('session_user_id'));
		foreach ($request_array as $key => $value) {
			if($value['iRequestId']==$id_request){
				
				$return_result_array['requestData']	=	$request_array[$key];
				
				$address_info_array					=	$this->GeneralModel->getWhereTableData('address',array('iAddressId'=>$request_array[$key]['iAddressId']));

				$return_result_array['requestData']['Address_info']=$address_info_array[0];
			}
		}
		
		// request item data
		$return_result_array['requestItemData']=$this->GeneralModel->getWhereTableData("request_item",array("iRequestId"=>$id_request));
		// pr($return_result_array['requestData'],1);
		if(empty($return_result_array['requestItemData']) || empty($return_result_array['requestData'])){
			return $return_result_array;
		}
		foreach ($return_result_array['requestItemData'] as $key => $value) {
			$product_data=$this->GeneralModel->getWhereTableData("product",array("iProductId"=>$value['iProductId']));

			$product_cat_data=$this->GeneralModel->getWhereTableData("category",array("iCategoryId"=>$product_data[0]['iCategoryId']));

			$return_result_array['requestItemData'][$key]['product_info']=$product_data[0];
			$return_result_array['requestItemData'][$key]['p_category_info']=$product_cat_data[0];

			$recQu="NA";
			$recPoint=0;
			// pr($return_result_array['requestData'],1);
			if(!empty($return_result_array['requestData'])){
				switch ($return_result_array['requestData']['eStatus']) {
					case 'Pending':
					case 'Approved':
						$recQu 						= tba_value();
						$recPoint 					= tba_value();
						$totla_rec_point_format		= tba_value();
						break;
					case 'Cancel':
						$recQu 						=	na_value();
						$recPoint 					=	na_value();
						$totla_rec_point_format		= 	na_value();
						break;
					case 'Collected':
						$recQu=$return_result_array['requestItemData'][$key]['dReceivedQuantity']." ";
						$recQu.=$return_result_array['requestItemData'][$key]['product_info']['vProductUnit'];
						$recPoint=$return_result_array['requestItemData'][$key]['dReceivedPoint'];
						$totla_rec_point+=$recPoint;
						$totla_rec_point_format		= number_format($totla_rec_point,2);
						break;
				}
				$return_result_array['requestData']['totalReceivedPoint']	=$totla_rec_point_format;
			}
			$return_result_array['requestItemData'][$key]['receivedQuantityFormat']	=$recQu;
			$return_result_array['requestItemData'][$key]['receivedPoint']	=$recPoint;
			
		}
		
		
		// pr($return_result_array,1);

		return $return_result_array;
	}

	public function collectRequestDetails($params){
		// pr($params,1);
		$message="";
		$result=[
			'value'		=>false,
			'message'	=>''
		];
		//update Request
		$update_request_array = [
            'dtReceivedDate' 	=> strval(date("Y-m-d")),
            'eStatus' 			=> 'Collected',
        ];
        $request_data=$this->GeneralModel->getWhereTableData('request',array("iRequestId"=>$params['requestId']));
        if(empty($request_data)){
        	$result['message']="Not Valide Request";
        	return $result;
        }
        // pr($request_data,1);
        $this->db->where('iRequestId',$params['requestId']);
        if($this->db->update('request', $update_request_array)){
        	$total_received_point=0;
        	//update Request Item
			$update_request_item_array=array();
			foreach ($params['req_item_qyt'] as $key => $value) {
				$request_item=[
					'iRequestItemId'=>$key,
					'dReceivedQuantity'=>$value,
					'dReceivedPoint'=>$params['req_product_point'][$key]*$params['req_item_qyt'][$key]
				];
				$total_received_point+=($params['req_product_point'][$key]*$params['req_item_qyt'][$key]);
				array_push($update_request_item_array, $request_item);
			}
			if($this->db->update_batch('request_item',$update_request_item_array, 'iRequestItemId')){

				//add reward in request_reward
				$last_code_value=$this->GeneralModel->getLastCodeValue('request_reward','vRequestRewardCode','DESC');
				$last_code_value+=1;
				$new_code_value=sprintf('%06d',$last_code_value);

				$insert_req_reward_data=[
					"vRequestRewardCode"	=>"REQ/REW/".date('Y/m')."/".$new_code_value,
					"iRequestId"			=>$params['requestId'],
					"dTotalPoint"			=>$total_received_point,
					"iForeId"				=>$params['requestById'],
					"iAgencyId"				=>$params['requestAgencyId'],
					"eStatus"				=>'Active'
				];
				//add transection detail in user_wallet_request_reward
				$last_code_tra_value=$this->GeneralModel->getLastCodeValue('user_wallet_transaction','vWalletTransactionCode','DESC');
				$last_code_tra_value+=1;
				$new_code_tra_value=sprintf('%06d',$last_code_tra_value);

				$tParamsArray=array();//for the tParams value.
				$tParamsArray=[
					"AMOUNT"=>$total_received_point, 
					"TYPE"=>"Credit", 
					"REQ_ID"=>$params['requestId'], 
					"REQUEST_CODE"=>$request_data[0]['vRequestCode']
				];

				//get iWalletTemplateMasterId  from user_wallet_tempalte_master
				$wallet_tempalet_id=$this->GeneralModel->getWhereTableData('user_wallet_tempalte_master',array('vTempalteCode'=>'credit_by_request'))[0]['iWalletTemplateMasterId'];

				$insert_wallet_reward_transaction=[
					"vWalletTransactionCode"	=> "WT/".date('Y/m')."/".$new_code_tra_value,
					"iWalletTemplateMasterId"	=> $wallet_tempalet_id,
					"iUserId"					=>	$params['requestById'],
					"tParams"					=> json_encode($tParamsArray),
					"fAmount"					=>	$total_received_point,
					"eStatus"					=> "Credit",
					"dAddedDate"				=> strval(date("Y-m-d h:i:s"))
				];


				if($this->db->insert('request_reward',$insert_req_reward_data) && $this->db->insert('user_wallet_transaction',$insert_wallet_reward_transaction)){
					$result['value']	= true;
					$message			= "Order Collect Successfully !!";

				}else{
					pr($this->db->_error_message(),1);
					$result['value']	= false;
					$message			= "Something went wrong !!";
				}

				//add reward in user wallat Code //now trigger is awailabel
				/*$uId=$params['requestById'];
				$userData=$this->GeneralModel->getWhereTableData('user',array('iUserId'=>$uId));
				$pointValue=$userData[0]['dWalletAmount']+$total_received_point;
				$reward_add_data=$this->GeneralModel->editWhereTableData('user','iUserId',$uId,array('dWalletAmount'=>$pointValue));
				if($reward_add_data){
					$result['value']	= true;
					$message			= "Order Collection Successfully";
				}
				else{
					$result['value']	= false;
					$message			= "Something went wrong !!";
				}*/
				
			}
			else{
				$result['value']	= false;
				$message			= "Order Collection Proccess Failed Try Again !!";	
			}	
        }else{
        	$result['value']	= false;
			$message			= "Order Collection Proccess Failed Try Again !!";	
        }
		
		$result['message']=$message;
		return $result;
	}

	public function getUserRequestInfo($request_id)
	{
		$return_array=array();
		if($request_id>0 && $request_id!=''){
			$this->db->select('*');
			$this->db->from('request');
			$this->db->where('request.iRequestId',$request_id);
			$this->db->join('user', "user.iUserId= request.iAddedBy");
			$return_array=$this->db->get()->result_array()[0];
		}
		return $return_array;
	}

}