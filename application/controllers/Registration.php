<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller {

	public function index()
	{
		// $this->session->set_flashdata('reg_message',"Check Session");
		$this->load->model('GeneralModel');
		$data['role']=$this->GeneralModel->getRoleList();
		$this->load->view('registration',$data);
	}
	public function is_valid_password($field){
		
		if(preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $field)){
			return true;
		}
		else{
			$this->form_validation->set_message('is_valid_password', '{field} contains Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character');
			return false;
		}
	}
	public function addUserInfo()
	{

		$process_task		= false;
		$valid_message		= "";
		$firstName		 	= $this->input->post('tFirstName');
		$lastName		 	= $this->input->post('tLastName');
		$mobileNumber		= $this->input->post('tMobileNumber');
		$userEmail		 	= $this->input->post('eUserEmail');
		$userPassword		= $this->input->post('pUserPassword');
		$userType		 	= $this->input->post('sUserType');

		$this->form_validation->set_rules('tFirstName',		'First Name', 	'required|alpha');
		$this->form_validation->set_rules('tLastName',		'Last Name',  	'required|alpha');
		$this->form_validation->set_rules('tMobileNumber',	'Mobile Number','required|numeric|exact_length[10]|is_unique[user.iMobileNo]');
		$this->form_validation->set_rules('eUserEmail',		'Email Id', 	'required|valid_email|is_unique[user.vEmail]');
		$this->form_validation->set_rules('pUserPassword',	'Password', 	'required|min_length[8]|callback_is_valid_password');
		$this->form_validation->set_rules('sUserType',		'User Type', 	'required');

		$this->form_validation->set_message('required',		'This %s field is required.');
		$this->form_validation->set_message('valid_email',	'Enter Valide Email Id.');
		$this->form_validation->set_message('alpha',		'Enter Valide %s.');
		$this->form_validation->set_message('numeric',		'Enter Valide %s.');
		$this->form_validation->set_message('min_length','Password should contain at least 8 characters.');
		$this->form_validation->set_message('exact_length','Enter valide mobile number digits.');
		$this->form_validation->set_message('is_unique','%s is exist with anothe user.');

		if($this->form_validation->run()){
			$paramArray=[
				'firstName'		=>	$firstName,
				'lastName'		=>	$lastName,
				'mobileNumber'	=>	$mobileNumber,
				'userEmail'		=>	$userEmail,
				'userPassword'	=>	md5($userPassword),
				'userType'		=>	$userType
			];

			$this->load->model('LoginModel');

			$result=$this->LoginModel->setUserInformation($paramArray);
			
			if($result['value']){

				//registration success.
				$emali_message					=	array();
				$emali_message['user_name']		=	$firstName." ".$lastName;

				$email_params['message']		=	$this->EmailTemplateModel->welcomeMail($emali_message);   


				$email_params['user_email']		=	$userEmail;
				$email_params['subject']		=	"Welcome To WMS Community";
				$is_mail_send					=	$this->GeneralModel->sendMail($email_params);

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
			$this->session->set_flashdata('login_message',$valid_message);
			$this->load->view("login");
			
		}
		else{
			$valid_message.="|alert-danger";
			$this->session->set_flashdata('reg_message',$valid_message);
			redirect("Registration/");
		}
	}
}
