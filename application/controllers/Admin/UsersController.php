<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsersController extends CI_Controller {

	public function __counstruct(){
		parent :: __counstruct();
		
	}

	public function index()
	{
		is_userLogin('Admin');
		$this->load->model('Admin/UsersModel');
		$process_task		= false;
		$valid_message		= "";

		
		$data['user']				= $this->UsersModel->getUserDetail('USER');
		$data['agency_user']		= $this->UsersModel->getAgencyUserDetail('AGENCY');
		$this->load->view('Admin/users',$data);
	}
	
	
}