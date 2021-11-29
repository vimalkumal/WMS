<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RequestCartController extends CI_Controller {

	public function __counstruct(){
		parent::__counstruct();
		$this->load->model('Admin/RequestCartModel');
	}
	
	// public function index()
	// {
	// 	$this->load->view('User/Request');	
	// }

	// public function addCartData($value='')
	// {
	// 	pr($_POST,1);
	// 	$process_task		= false;
	// 	$valid_message		= "";
	// 	if(RequestCartController::isAddressExist()){
	// 		$process_task=true;

	// 	}
	// 	else{
	// 		$process_task=false;
	// 		$valid_message.="Address is not Exist";
	// 	}	

	// 	if($process_task){

	// 		$valid_message.="";
	// 		$this->session->set_flashdata('login_message',$valid_message);
	// 		// $data['Address']
	// 		$this->load->view('User/OrderSummary',$data);
	// 	}
	// 	else{
	// 		$valid_message.="|alert-danger";
	// 		$this->session->set_flashdata('login_message',$valid_message);
	// 		redirect("User/UserController");
			
	// 	}
		

		
	// }
	// public function isAddressExist()
	// {
	// 	$result=$this->GeneralModel->getWhereTableData('address',array('iUserId'=>$this->session->userdata('session_user_id')));
	// 	if(sizeof($result)>0){
	// 		return true;
	// 	}
	// 	else{
	// 		return false;
	// 	}
		
	// }


}