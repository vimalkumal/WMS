<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AgencyController extends CI_Controller {

	public function index()
	{
		is_userLogin('Agency');
		$this->load->model('Agency/AgencyModel');
		// $this->load->model('Admin/AddressModel');
		// $data['country'] = $this->AddressModel->fetch_country_list();
		
		
		//request data
		
		$data['request_approved']			=	$this->AgencyModel->getAgencyRequestRecored("Approved");
		$data['request_pending']			=	$this->AgencyModel->getAgencyRequestRecored("Collected");
		// echo "Agency View";exit();
		$this->load->view('Agency/sitemap',$data);
	}
	public function addAgency()
	{
		$agency_data=array();
		$this->load->model("LoginModel");
		if($this->LoginModel->isAgencyExist(array('id'=>$this->session->userdata('session_user_id')))){
			redirect("Agency/AgencyDetailController");
		}


		$uId=$this->session->userdata('session_user_id');
		$result=$this->db
        ->select("roles.vRoleCode")
        ->from('user')
        ->where('user.iUserId',$uId)
        ->join('roles','roles.iRoleId = user.iRoleId','left')
        ->group_by('user.iRoleId')
        ->get()
        ->result_array()[0];

        if($result['vRoleCode']=="AGENCY"){

			$this->load->model('Admin/AddressModel');
			$data['country'] = $this->AddressModel->fetch_country_list();
			$this->load->view('Agency/AgencyForm',$data);
        }
        else{
        	$this->session->set_flashdata('login_message',"You not login yet please log in now. | alert-warning");
    		redirect("Login");
        }

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
	public function is_valid_name($field){
		
		if(preg_match('/^[a-zA-Z\s]+$/', $field)){
			return true;
		}
		else{
			$this->form_validation->set_message('is_valid_name', '{field} contain charecter and space only.');
			return false;
		}
	}

	public function setAgencyDetails(){

		$process_task		= false;
		$valid_message		= "";
		$imageName			= "";
		// all from input
		//agency detail
		$agency_mode='';
	    $agency_id=0;
		
		$agency_mode 		= $this->input->post('hMode');
		

		$agency_name 		= $this->input->post('tAgencyName');
		if($agency_mode=="Add"){
			$agency_code 		= $this->input->post('tAgencyCode');
			$agency_reg_no	 	= $this->input->post('tAgencyRegNo');

		}else{
			$agency_reg_no 		= $this->input->post('hAgencyRegNo');
			$agency_code 		= $this->input->post('hAgencyCode');
			$agency_id 			= $this->input->post('hAgencyId');
		}

		
		
		
		$agency_email	 	= $this->input->post('tAgencyEmail');
		$agency_ph_no	 	= $this->input->post('tAgencyPhone');
		$status			 	= $this->input->post('seStatus');
		
		
		//address details
		$address_line1 		= $this->input->post('tAddressLine1');
		$address_line2 		= $this->input->post('tAddressLine2');
		$address_country 	= $this->input->post('seAddressCountry');
		$address_state	 	= $this->input->post('seAddressState');
		$address_city	 	= $this->input->post('seAddressCity');
		$pincode 			= $this->input->post('tPincode');
		

		//owner details
		$ownerID 			= $this->input->post('hUserID');
		$ownerName 			= $this->input->post('hUserName');

		// all from input rules

		//address
		$this->form_validation->set_rules('tAgencyName',		'Agency Name',	'required|callback_is_valid_name');

		if($agency_mode=='Add'){
			$this->form_validation->set_rules('tAgencyCode',		'Agency Code', 	'required|is_unique[agencies.vAgencyCode]');
			$this->form_validation->set_rules('tAgencyRegNo',		'Agency Registration Number', 			'required|is_unique[agencies.vAgencyRegistrationNo]');

			if (empty($_FILES['fAgencyImage']['name']))
			{
			    $this->form_validation->set_rules('fAgencyImage', 'Agency Image', 'required');
			}
		}
		
		

		$this->form_validation->set_rules('tAgencyEmail',		'Agency Email', 			'required|valid_email');
		$this->form_validation->set_rules('tAgencyPhone',		'Agency Phone Number', 			'required|numeric|exact_length[8]');
		$this->form_validation->set_rules('seStatus',			'Status', 			'required');

		$this->form_validation->set_rules('tAddressLine1',		'Address Line1',	'required');
		$this->form_validation->set_rules('tAddressLine2',		'Address Line2', 	'required');
		$this->form_validation->set_rules('seAddressCountry',	'Country', 			'required');
		$this->form_validation->set_rules('seAddressState',		'State', 			'required');
		$this->form_validation->set_rules('seAddressCity',		'City', 			'required');
		$this->form_validation->set_rules('tPincode',			'Pincode', 			'required');
		

		// $this->form_validation->set_rules('tLatitude',			'Latitude', 		'required|callback_is_valid_location');
		// $this->form_validation->set_rules('tLongitude',			'Longitude', 		'required|callback_is_valid_location');
		

		
		//set rules
		$this->form_validation->set_message('required',		'%s is required.');
		$this->form_validation->set_message('exact_length',		'%s is contain 8 digits .');
		$this->form_validation->set_message('valid_email',	'Enter Valide Email Id.');
		$this->form_validation->set_message('numeric',		'Enter Valide %s.');
		$this->form_validation->set_message('is_unique',	'%s is exist with another Agency.');

		if($this->form_validation->run()){

			if(!empty($_FILES['fAgencyImage']['name'])){

				$config['upload_path']          = './assets/images/Agency/AgencyImages/';
		        $config['allowed_types']        = 'gif|jpg|png';
		        $config['max_size']             = 100000;
		        $config['max_width']            = 1024;
		        $config['max_height']           = 1024;
		        $config['encrypt_name'] 		= TRUE;
		        $new_fname						= time()."_".$_FILES["fAgencyImage"]['name'];
		        $config['file_name'] 			= $new_fname;
		       
		        $this->load->library('upload', $config);
		        
		        if (!$this->upload->do_upload('fAgencyImage'))
		        {
		                $error 			= array('error' => $this->upload->display_errors());

		                $process_task	= false;
		                // pr($error,1);
		                // $valid_message.=implode(" ", $error);
		                // $valid_message.="Agency image should be .png .jpg .gif, size < 1mb, max width= 1024, max heighr=768";
		                $valid_message.=$error['error'];
		        }else{
		        	$process_task	= true;
		        	$data 		= array('upload_data' => $this->upload->data());
                	$imageName	= $data['upload_data']['file_name'];	
		        }
			}else{
				$process_task=true;
			}


	        if($process_task){
	        	$img_status=0;
				if(!empty($_FILES['fAgencyImage']['name'])){
					$img_status=1;
				}
	        	$paramArray=[
				'imageUpload'		=>	$img_status,
				'mode'				=>  $agency_mode,
				'agency_id'			=>  $agency_id,
				'agency_name'		=> 	$agency_name,
				'agency_code'		=> 	$agency_code,
				'agency_reg_no'		=> 	$agency_reg_no,
				'agency_image'		=> 	$imageName,
				'agency_email'		=> 	$agency_email,
				'agency_ph_no'		=> 	$agency_ph_no,
				'address_line1'		=>	$address_line1,
				'address_line2'		=>	$address_line2,
				'address_country'	=>	$address_country,
				'address_state'		=>	$address_state,
				'address_city'		=>	$address_city,
				'pincode'			=>	$pincode,
				'ownerID'			=> 	$ownerID,
				'ownerName'			=> 	$ownerName,
				'status'			=>	$status
				];

				$this->load->model('Agency/AgencyModel');

				$result=$this->AgencyModel->setAgencyDetails($paramArray);
				
				if($result['value']){

					//registration success.
					$process_task	= true;
					$valid_message  = $result['message'];
				}
				else{
					//failed registration.
					$process_task	= false;
					$valid_message 	= $result['message'];
				}
	        }
	        else{

				$process_task 	=	false;
				$valid_message 	.= 	"Image not acceptable.";
		  }
		}
		else{
				//form validation message.
				$process_task	= false;
				$valid_message 	.= validation_errors();
		}

		if($process_task){

			$valid_message.="|alert-success";
			$this->session->set_flashdata('agency_message',$valid_message);
			if($agency_mode=="Add"){
				redirect("Agency/AgencyController/");
			}
			else{
				redirect("Agency/AgencyController/editAgency");
			}
			
		}
		else{
			$valid_message.="|alert-danger";
			$this->session->set_flashdata('agency_message',$valid_message);
			if($agency_mode=="Add"){
				redirect("Agency/AgencyController/addAgency");
			}
			else{
				redirect("Agency/AgencyController/editAgency");
			}
			
		}
		
	}
	public function editAgency()
	{
		$agency_data=array();
		is_userLogin('Agency');
		$this->load->model('Admin/AddressModel');
		$uId=$this->session->userdata('session_user_id');
		$data['agency_info'] = $this->GeneralModel->getWhereTableData('agencies',array('iOwnerId'=>$uId))[0];
		// pr($data['agency_info'],1);
		$data['country'] 	 = $this->AddressModel->fetch_country_list();
		$data['state_list']	= $this->GeneralModel->getWhereTableData('state',array('iCountryId'=>$data['agency_info']['iCountryId']));	
		$data['city_list']	= $this->GeneralModel->getWhereTableData('city',array('iStateId'=>$data['agency_info']['iStateId']));
		$this->load->view('Agency/AgencyForm',$data);
	}
}
