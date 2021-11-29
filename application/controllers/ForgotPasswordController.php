<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ForgotPasswordController extends CI_Controller {

	public function index()
	{
		
		$this->load->view('ForgotPassword');
		// $this->session->set_flashdata('reg_message',"Check Session");
		
	}
	public function chechEmailExist()
	{
		$process_task		= false;
		$valid_message		= "";
		
		// all from input
		$email		 	= $this->input->post('eUserEmail');

		// all from input rules
		$this->form_validation->set_rules('eUserEmail',		'email Id', 	'required|valid_email');
		
		//set rules
		$this->form_validation->set_message('required',		'%s field is required.');
		$this->form_validation->set_message('valid_email',	'Enter Valide Email id.');
		
		if($this->form_validation->run()){
			$paramArray=[
				'email'		=>	$email
			];

			$this->load->model('ForgotPasswordModel');

			$result=$this->ForgotPasswordModel->isValidEmail($paramArray);
			
			if($result['value']){
				
				$user_details					=	$result['user_data'];
				$new_password					=	"MCA@hb".rand(10,99);
				$emali_message					=	array();
				$emali_message['new_password']	=	$new_password;
				$emali_message['user_name']		=	$user_details['vName'];

				$email_params['message']		=	$this->EmailTemplateModel->forgotePassword($emali_message);   


				$email_params['user_email']		=	$email;
				$email_params['subject']		=	"Forgote Password";
				$is_mail_send					=	$this->GeneralModel->sendMail($email_params);
				
				if($is_mail_send){
					$this->load->model('LoginModel');
					$paramArray=array();
					$paramArray['email']		=	$email;
					$paramArray['new_password'] =	$new_password;
					$result=$this->LoginModel->changePassword($paramArray);

					if($result['value']){
						$process_task	= true;
						$valid_message = $result['message'];
					}
					else{
						$process_task	= false;
						$valid_message 	= $result['message'];
					}

				}
				else{
					$process_task					=	false;
					$valid_message					= 	"Something went wrong please try again.!!";	
				}
			}
			else{
				$process_task	= false;
				$valid_message 	= $result['message'];
				
			}
		}
		else{
				
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
			$this->session->set_flashdata('forgot_password_message',$valid_message);
			redirect("ForgotPasswordController");
		}
	}
}
