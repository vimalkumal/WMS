<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$this->load->view('login');
	}

	public function chechUserDetail()
	{
		$valide_message	= "";
		$process		= false;
		$userId 		= $this->input->post('eUserEmail');
		$userPassword 	= $this->input->post('pUserPassword');
		$result			= array();

		$this->form_validation->set_rules('eUserEmail','Email Id','required|valid_email');
		$this->form_validation->set_rules('pUserPassword','Password','required');

		$this->form_validation->set_message('required','This %s field is required.');
		$this->form_validation->set_message('valid_email','Enter Valide Email Id.');
		$this->load->model('LoginModel');
		if($this->form_validation->run()){
			
			$paramArray=[
				'id'		=> $userId,
				'password'	=> md5($userPassword)
			];
			$result=$this->LoginModel->isValideUser($paramArray);

			if($result['value']){
				if(isset($_POST['cRemember'])){
					setcookie('UserId',$userId,time()+3600);
					setcookie('UserPassword',$userPassword,time()+3600);
				}
				$valid_message=$result['message'];
				$process		= true;
				//Login success
			}
			else{
				//Login Failed

				$process		= false;
				$valid_message  = $result['message'];
			}
		}
		else{

			$process		= 	false;
			$valid_message 	=	validation_errors();
		
		}

		if($process){
			$valid_message.="|alert-success";
			$this->session->set_flashdata('login_message',$valid_message);
			// redirect("Login");
			switch ($result['role_type']) {
				case 'Admin':
					redirect("Admin/AdminController");
					break;
				case 'Agency':
				
					$user_id=$this->session->userdata("session_user_id");
					$paramArray['id']=$user_id;
					
					if($this->LoginModel->isAgencyExist($paramArray)){
						redirect("Agency/AgencyController");
					}
					else{
						redirect("Agency/AgencyController/addAgency");
					}
					break;
				case 'User':
					redirect("User/UserController");
					break;
			}

			
		}
		else{
			$valid_message.="|alert-danger";
			$this->session->set_flashdata('login_message',$valid_message);
			redirect("Login");
		}

	}
}
