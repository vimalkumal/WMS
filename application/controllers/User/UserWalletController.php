<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserWalletController extends CI_Controller {

	public function __counstruct(){
		parent :: __counstruct();
		
	}

	public function index()
	{
		is_userLogin('User');
		$data['wallet_amount']=number_format($this->GeneralModel->getWhereTableData('user',$arrayName = array('iUserId' =>$this->session->userdata('session_user_id')))[0]['dWalletAmount'],2);

		$this->load->model("User/UserWalletModel");
		$data['wallet_transection']=$this->UserWalletModel->get_user_wallet_details($this->session->userdata('session_user_id'));

		$this->load->view('User/Wallet',$data);
	}

	public function redeemRewarded()
	{
		is_userLogin('User');
		$wallet_amount=$this->GeneralModel->getWhereTableData('user',$arrayName = array('iUserId' =>$this->session->userdata('session_user_id')))[0]['dWalletAmount'];

		if($wallet_amount>configValue('min_point_value')){

			$this->load->model("User/UserWalletModel");
			$params_array=[
				"wallet_amount"=>$wallet_amount
			];

			$data['wallet_amount']=$wallet_amount;
			$data['voucher_info']=$this->UserWalletModel->getVoucherData($params_array);
			$this->load->view("User/Voucher",$data);
		
		}else{
			$valid_message="Wallet Point should be greater than".configValue('min_point_value').".";
			$valid_message.="|alert-danger";
			$this->session->set_flashdata('wallet_message',$valid_message);
			redirect("User/UserWalletController");
		}
	}

	public function redeemVoucher()
	{
		is_userLogin('User');
		$process_task		= false;
		$valid_message		= "";
		// pr($_POST,1);

		$user_wallet_amount=$this->GeneralModel->getWhereTableData('user',$arrayName = array('iUserId' =>$this->session->userdata('session_user_id')))[0]['dWalletAmount'];
		$voucher_data=$this->GeneralModel->getWhereTableData('voucher',array('iVoucherId'=>$_POST['hVoucherId']));
		
		if (!empty($voucher_data))
		{
			$voucher_data=$voucher_data[0];

			if(($voucher_data['dVoucherPrice']*configValue("one_RS_value")) <= $user_wallet_amount){
				
				
				//preped message for the email
				$email_message=array();

				$email_message['user_name']			= ucfirst($this->session->userdata('user_name'));
				$email_message['voucher_type']		= $voucher_data['vVoucherName'];
				$email_message['voucher_code']		= $voucher_data['vVoucherCode'];
				$email_message['voucher_value']		= number_format($voucher_data['dVoucherPrice'],2);
				

				$message_of_email=$this->EmailTemplateModel->voucherTemp($email_message);

				$email_params=[
				"user_email"	=>	$this->session->userdata('user_email'),
				"subject"		=>	"Your Redeem Voucher Code ",
				"message"		=>	$message_of_email
				];

				//update voucher status
				$is_update_voucher_data=$this->GeneralModel->editWhereTableData('voucher',"iVoucherId",$voucher_data['iVoucherId'],array('eStatus'=>'read'));

				//check the mail send or not AND status update or not 
				if($this->GeneralModel->sendMail($email_params) && $is_update_voucher_data){
					//after mail send insert data into wallate transection table
					$voucher_point_value=($voucher_data['dVoucherPrice']*configValue("one_RS_value"));
					$params_array=[
						"voucher_name"			=>	$voucher_data['vVoucherName'],
						"voucher_code"			=>	$voucher_data['vVoucherCode'],
						"voucher_amount"		=>	$voucher_data['dVoucherPrice'],
						"voucher_amount_point"	=>	$voucher_point_value,
						"transection_type"		=>	'Debit',
						"requestById"			=>	$this->session->userdata('session_user_id')
					];
					$this->load->model("User/UserWalletModel");
					$result=$this->UserWalletModel->userRedeemVoucher($params_array);
					// pr($result,1);
					if($result['value']){
						$process_task   = true;
						$valid_message .= $result['message'];
					}
					else{
						$process_task   = false;
						$valid_message .= $result['message'];
					}


				}else{
					$process_task=false;
					$valid_message.="Process failed Please try after some time.";
				}
			}else{
				$process_task   = false;
				$valid_message .= "Unable to redeem this voucher.";
			}

		}
		else{
			$process_task 	=  false;
			$valid_message 	.= "Not Voucher Information found";
		}
		if($process_task){
			$valid_message.="|alert-success";
			$this->session->set_flashdata('wallet_message',$valid_message);
			redirect("User/UserWalletController/");
		}
		else{
			$valid_message.="|alert-danger";
			$this->session->set_flashdata('voucher_message',$valid_message);
			redirect("User/UserWalletController/redeemRewarded");
		}
		
	}
	

	
}
