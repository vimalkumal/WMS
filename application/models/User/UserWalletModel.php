<?php

class UserWalletModel extends CI_Model{

	public function get_user_wallet_details($userId){
		$return_array=array();
		// pr("User Id ".$userId);
		// $this->db->order_by("iWalletTransactionId","DESC");
		$userQueary=$this->db->get_where('user_wallet_transaction',array('iUserId'=>$userId));
		$return_array=$userQueary->result_array();
		// pr($return_array,1);
		$amount=0;
		foreach ($return_array as $key => $value){
			// pr($value);
			$descript_val="";
			$credit_val="-";
			$debit_val="-";
			//get tempalet from the user_wallet_tempalte_master table
			$tempalet_array=$this->GeneralModel->getWhereTableData('user_wallet_tempalte_master',array("iWalletTemplateMasterId"=>$value['iWalletTemplateMasterId']));

			if(!empty($tempalet_array)){
				//if tempalet_array not empty then set the valye of description value

				$tempalet_val=$tempalet_array[0]['tTemplate'];//
				$val_params=json_decode($value['tParams'],true);
				
				$key_array=array();		// set value of params 
				$value_array=array();	// set value of params 
				
				foreach ($val_params as $key_params => $value_params) {
					//set number formate to the amount value
					if($key_params=="AMOUNT"){
						$value_params="<b>".number_format($value_params,2)."</b>";
					}
					array_push($key_array, "#".$key_params."#");
					array_push($value_array, $value_params);
				}
				$descript_val=str_replace($key_array,$value_array,$tempalet_val);
			}

			// credit and debit code
			if($val_params['TYPE']=="Credit"){
				$credit_val	=	number_format($val_params['AMOUNT'],2);
				$amount 	+=  $val_params['AMOUNT'];
			}

			if($val_params['TYPE']=="Debit"){
				$debit_val 	= 	number_format($val_params['AMOUNT'],2);
				$amount 	-=	$val_params['AMOUNT'];
			}


			$return_array[$key]['Description']	=	$descript_val;
			$return_array[$key]['Credit']		=	$credit_val;
			$return_array[$key]['Debit']		=	$debit_val;
			$return_array[$key]['Balance']		=	number_format($amount,2);	
		}
		// pr($return_array,1);
		return $return_array;

	}
	public function getVoucherData($params=array())
	{
		$return_array=array();
		$wallet_amount=$params['wallet_amount'];
		$return_array=$this->GeneralModel->getWhereTableData('voucher',array('eStatus'=>'unread'));
		foreach ($return_array as $key => $value) {
			$return_array[$key]['needPoint']=($value['dVoucherPrice']*configValue("one_RS_value"));
		}
		// pr($return_array,1);
		return $return_array;
	}
	
	public function userRedeemVoucher($params=array())
	{
		$message="";
		$result=[
			'value'		=>false,
			'message'	=>''
		];
		//add transection detail in user_wallet_request_reward
		$last_code_tra_value=$this->GeneralModel->getLastCodeValue('user_wallet_transaction','vWalletTransactionCode','DESC');
		$last_code_tra_value+=1;
		$new_code_tra_value=sprintf('%06d',$last_code_tra_value);

		$tParamsArray=array();//for the tParams value.
		$tParamsArray=[
			"AMOUNT"		=> $params['voucher_amount_point'],
			"TYPE"			=> "Debit", 
			"VOUCHER_NAME" 	=> $params['voucher_name'], 
			"VOUCHER_CODE" 	=> $params['voucher_code']
		];

		//get iWalletTemplateMasterId  from user_wallet_tempalte_master
		$wallet_tempalet_id=$this->GeneralModel->getWhereTableData('user_wallet_tempalte_master',array('vTempalteCode'=>'debit_by_voucher'))[0]['iWalletTemplateMasterId'];

		$insert_wallet_redeem_transaction=[
			"vWalletTransactionCode"	=> "WT/".date('Y/m')."/".$new_code_tra_value,
			"iWalletTemplateMasterId"	=> $wallet_tempalet_id,
			"iUserId"					=>	$params['requestById'],
			"tParams"					=> json_encode($tParamsArray),
			"fAmount"					=>	$params['voucher_amount_point'],
			"eStatus"					=> "Debit",
			"dAddedDate"				=> strval(date("Y-m-d h:i:s"))
		];


		if($this->db->insert('user_wallet_transaction',$insert_wallet_redeem_transaction)){
			$result['value']	= true;
			$message			= "Redeem Voucher Successfully. !!";

		}else{
			// pr($this->db->_error_message(),1);
			$result['value']	= false;
			$message			= "Something went wrong !!";
		}

		//add reward in user wallat Code //now trigger is awailabel
		$uId=$params['requestById'];
		$userData=$this->GeneralModel->getWhereTableData('user',array('iUserId'=>$uId));
		$pointValue=$userData[0]['dWalletAmount']-$params['voucher_amount_point'];
		$reward_add_data=$this->GeneralModel->editWhereTableData('user','iUserId',$uId,array('dWalletAmount'=>$pointValue));
		if($reward_add_data){
			$result['value']	= true;
			$message			= "Voucher Redeem Successfully. Check Your email for the Vouche Details.";
		}
		else{
			$result['value']	= false;
			$message			= "Something went wrong !!";
		}
		$result['message']=$message;
		return $result;
	}
}