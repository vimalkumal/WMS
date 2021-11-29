<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AddressController extends CI_Controller {

	public function __counstruct(){
		parent::__counstruct();
		$this->load->model('Admin/AddressModel');
	}
	public function is_valid_location($field){
		
		if(preg_match('/^[a-zA-Z\s]+$/', $field)){
			$this->form_validation->set_message('is_valid_loacation', '{field} does not contain charecter and space.');
			return false;
		}
		else{
			return true;
		}
	}

	public function index()
	{
		is_userLogin('User');
		$uId=$this->session->userdata('session_user_id');
		$this->load->model('Admin/AddressModel');
		$data['address'] = $this->AddressModel->fetch_address_list($uId);
		$this->load->view('User/Address',$data);
	}
	public function get_state_data(){

		$this->load->model('Admin/AddressModel');
		if($this->input->post('selectedCountryId'))
		{
			echo $this->AddressModel->fetch_state_list($this->input->post('selectedCountryId'));
		}
	}

	public function get_city_data(){
		$this->load->model('Admin/AddressModel');
		if($this->input->post('selectedStateId'))
		{
			echo $this->AddressModel->fetch_city_list($this->input->post('selectedStateId'));
		}
	}

	public function addAddress(){
		is_userLogin('User');
		$this->load->model('Admin/AddressModel');
		$data['country'] = $this->AddressModel->fetch_country_list();
		$this->load->view('User/AddressForm',$data);
	}

	public function editAddress(){	
		is_userLogin('User');
		$this->load->model('Admin/AddressModel');

		$data['addressId']=isset($_REQUEST['addressId'])?$_REQUEST['addressId']:-1;
		
		if($data['addressId']>0){
			$uId=$this->session->userdata('session_user_id');
			$address_id=$data['addressId'];
			$check_is_valid_user=$this->GeneralModel->getWhereTableData('address',array('iAddressId'=>$address_id,'iUserId'=>$uId));
			// pr($check_is_valid_user,1);
			if(empty($check_is_valid_user)){
				$data['address_data']=array();	
			}
			else{
				$data['address_data']=$this->AddressModel->getAddressDetails($data['addressId']);
				$data['state_list']	= $this->GeneralModel->getWhereTableData('state',array('iCountryId'=>$data['address_data'][0]['iCountryId']));	
				$data['city_list']	= $this->GeneralModel->getWhereTableData('city',array('iStateId'=>$data['address_data'][0]['iStateId']));
			}
		}else{
			$data['address_data']=array();	
		}
		//
		$data['country'] = $this->AddressModel->fetch_country_list();
		$this->load->view("User/AddressForm",$data);
	}

	public function unsetAddress(){

		$address_id 		= isset($_REQUEST['addressId'])?$_REQUEST['addressId']:-1;
		$process_task		= false;
		$valid_message		= "";
		
		if($address_id===-1){
			$valid_message="Try Again !!";
		}else{
			$this->load->model('Admin/AddressModel');
			$result				= $this->AddressModel->deleteAddress($address_id);
			if($result['value']){

				//registration success.
				$process_task	= true;
				$valid_message .= $result['message'];
				
			}
			else{
				//failed registration.
				$process_task	= false;
				$valid_message 	.= $result['message'];
				
			}
		}
		
		if($process_task){

			$valid_message.="|alert-warning";
			$this->session->set_flashdata('address_message',$valid_message);
		}
		else{
			$valid_message.="|alert-danger";
			$this->session->set_flashdata('address_message',$valid_message);
			
		}
		redirect("User/AddressController");
	}
	public function is_valid_name($field){
		
		if(preg_match('/^[a-zA-z\s0-9]{5,}$/', $field)){
			return true;
		}
		else{
			$this->form_validation->set_message('is_valid_name', '{field} contain alpha numeric charecter and space only.');
			return false;
		}
	}
	public function setAddress(){

		$process_task		= false;
		$valid_message		= "";
		
		// all from input
		$address_id			= $this->input->post('hAddressId');
		$address_mode		= $this->input->post('hMode');

		$address_title 		= $this->input->post('tAddressTitle');
		$address_line1 		= $this->input->post('tAddressLine1');
		$address_line2 		= $this->input->post('tAddressLine2');
		$address_country 	= $this->input->post('seAddressCountry');
		$address_state	 	= $this->input->post('seAddressState');
		$address_city	 	= $this->input->post('seAddressCity');
		$pincode 			= $this->input->post('tPincode');
		$latitude	 		= $this->input->post('tLatitude');
		$longitude		 	= $this->input->post('tLongitude');
		$status			 	= $this->input->post('seStatus');

		// all from input rules
		$this->form_validation->set_rules('tAddressTitle',		'Address Title',	'required|callback_is_valid_name');
		$this->form_validation->set_rules('tAddressLine1',		'Address Line1',	'required');
		$this->form_validation->set_rules('tAddressLine2',		'Address Line2', 	'required');
		$this->form_validation->set_rules('seAddressCountry',	'Country', 			'required');
		$this->form_validation->set_rules('seAddressState',		'State', 			'required');
		$this->form_validation->set_rules('seAddressCity',		'City', 			'required');
		$this->form_validation->set_rules('tPincode',			'Pincode', 			'required');
		$this->form_validation->set_rules('tLatitude',			'Latitude', 		'required|callback_is_valid_location');
		$this->form_validation->set_rules('tLongitude',			'Longitude', 		'required|callback_is_valid_location');
		$this->form_validation->set_rules('seStatus',			'Status', 			'required');
		
		//set rules
		$this->form_validation->set_message('required',		'%s field is required.');
		
		if($this->form_validation->run()){
			$paramArray=[
				
				'mode'				=>  $address_mode,
				'address_id'		=>  $address_id,
				'address_title'		=>  $address_title,
				'address_line1'		=>	$address_line1,
				'address_line2'		=>	$address_line2,
				'address_country'	=>	$address_country,
				'address_state'		=>	$address_state,
				'address_city'		=>	$address_city,
				'pincode'			=>	$pincode,
				'latitude'			=>	$latitude,
				'longitude'			=>	$longitude,
				'status'			=>	$status
			];

			$this->load->model('Admin/AddressModel');

			$result=$this->AddressModel->setAddressDetails($paramArray);
			
			if($result['value']){

				//registration success.
				$process_task	= true;
				$valid_message = $result['message'];
			}
			else{
				//failed registration.
				$process_task	= false;
				$valid_message 	= $result['message'];
			}

		}
		else{
				//form validation message.
				$process_task	= false;
				$valid_message 	= validation_errors();
		}

		if($process_task){

			$valid_message.="|alert-success";
			$this->session->set_flashdata('address_message',$valid_message);
			redirect("User/AddressController");
		}
		else{
			$valid_message.="|alert-danger";
			$this->session->set_flashdata('address_form_message',$valid_message);
			redirect("User/AddressController/editAddress");
		}
		
	}
}
