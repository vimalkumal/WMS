<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminProfileController extends CI_Controller {

	public function __counstruct(){
		parent :: __counstruct();
		
	}

	public function index()
	{
		is_userLogin('Admin');
		$user_id=$this->session->userdata('session_user_id');
		$this->load->model('Admin/AdminProfileModel');
		$data['admin_info'] = $this->AdminProfileModel->get_admin_details($user_id);
		$this->load->view('Admin/AdminProfile',$data);
	}
	
	public function changeAdminDetails(){

		is_userLogin('Admin');
		$process_task		= false;
		$valid_message		= "";
		$userId		 		= $this->input->post('hUserId');
		$firstName		 	= $this->input->post('tFirstName');
		$lastName		 	= $this->input->post('tLastName');
		$mobileNumber		= $this->input->post('tMobileNumber');
		$userEmail		 	= $this->input->post('hUserEmail');
		$userPasswordOld	= $this->input->post('pOldPassword');
		$userPasswordNew	= $this->input->post('pNewPassword');
		

		$this->form_validation->set_rules('tFirstName',		'First Name', 	'required|alpha');
		$this->form_validation->set_rules('tLastName',		'Last Name',  	'required|alpha');
		$this->form_validation->set_rules('tMobileNumber',	'Mobile Number','required|numeric|exact_length[10]');
		
		$this->form_validation->set_rules('pOldPassword',	'Old Password', 	'min_length[8]');
		$this->form_validation->set_rules('pNewPassword',	'New Password', 	'min_length[8]');

		$this->form_validation->set_message('required',		'This %s field is required.');
		$this->form_validation->set_message('valid_email',	'Enter Valide Email Id.');
		$this->form_validation->set_message('alpha',		'Enter Valide %s.');
		$this->form_validation->set_message('numeric',		'Enter Valide %s.');
		$this->form_validation->set_message('min_length','%s should contain at least 8 characters.');
		$this->form_validation->set_message('exact_length','Enter valide mobile number digits.');
		

		if($this->form_validation->run()){
			$paramArray=[
				'userId'			=>	$userId,
				'firstName'			=>	$firstName,
				'lastName'			=>	$lastName,
				'mobileNumber'		=>	$mobileNumber,
				'userEmail'			=>	$userEmail,
				'userOldPassword'	=>	md5($userPasswordOld),
				'userNewPassword'	=>	md5($userPasswordNew),
			];

			$this->load->model('Admin/AdminProfileModel');
			$result=$this->AdminProfileModel->editAdminProfileDetails($paramArray);
			
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
			$this->session->set_flashdata('change_profile_message',$valid_message);
			
			
		}
		else{
			$valid_message.="|alert-danger";
			$this->session->set_flashdata('change_profile_message',$valid_message);
			
		}
		redirect("Admin/AdminProfileController");
	}

	public function changeProfileImage()
	{
		is_userLogin('Admin');
		$process_task		= false;
		$valid_message		= "";
		$is_input_valid		= true;
		//extra variable
		$imageName="";
		$user_id		 	= $this->input->post('hUserId');
		$user_image		 	= $this->input->post('fUserImage');
		
		if (empty($_FILES['fUserImage']['name']))
		{
			// pr("empty");
			$is_input_valid=false;
		    $this->form_validation->set_rules('fUserImage', 'User Image', 'required');
		}
		$this->form_validation->set_message('required',		'%s field is required.');
		// pr($this->form_validation->run())
		if($is_input_valid){

			// pr($_FILES["fUserImage"],1);

			$config['upload_path']          = './assets/images/UserProfileImages/';
	        $config['allowed_types']        = 'gif|jpg|png|jpeg';
	        $config['max_size']             = 100000;
	        $config['max_width']            = 1024;
	        $config['max_height']           = 1024;
	        $config['encrypt_name'] 		= TRUE;
	        $new_fname						= time()."_".$_FILES["fUserImage"]['name'];
	        $config['file_name'] 			= $new_fname;
	       
	        $this->load->library('upload', $config);
	        
	        if (!$this->upload->do_upload('fUserImage'))
	        {
	                $error 			= array('error' => $this->upload->display_errors());
	                $process_task	= false;
	                // pr($error,1);
	                // $valid_message.="User image should be .png .jpg .gif, size < 1mb, max width= 1024, max height=1024";
	                $valid_message.=$error['error'];
	        }
	        else{
				// pr($user_image,1);
	        	$data 		= array('upload_data' => $this->upload->data());
                $imageName	= $data['upload_data']['file_name'];

                $paramArray=[
					'user_image'			=>	$imageName
				];

				$result=$this->GeneralModel->editWhereTableData('user','iUserId',$user_id,array('vUserImage'=>$imageName));
				// pr($result,1);
				if($result){
					$process_task	= true;
					$valid_message .= "Profile Update successfully.";
					
				}
				else{
					$process_task	= false;
					$valid_message 	.= "Tray Again";	
				}
	        }
		}
		else{
				$process_task	= false;
				$valid_message 	.= validation_errors();
				$valid_message 	.= "Somthing want wrong";

		}
		if($process_task){

			$valid_message.="|alert-success";
			$this->session->set_flashdata('change_profile_message',$valid_message);
			
			
		}
		else{
			$valid_message.="|alert-danger";
			$this->session->set_flashdata('change_profile_message',$valid_message);
			
		}
		redirect("Admin/AdminProfileController");
	}
}