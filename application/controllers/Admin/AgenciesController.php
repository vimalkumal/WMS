<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AgenciesController extends CI_Controller {

	public function __counstruct(){
		parent :: __counstruct();
		
	}

	public function index()
	{
		is_userLogin('Admin');
		$this->load->model('Admin/AgenciesModel');
		$process_task		= false;
		$valid_message		= "";
		
		$data['agencies']	= $this->AgenciesModel->getAgenciesDetails();

		$this->load->view('Admin/agencies',$data);
	}
	
	public function getAgencyData()
	{
		is_userLogin('Admin');
		$this->load->model('Admin/AgenciesModel');
		$agencyId=isset($_REQUEST['agencyId'])?$_REQUEST['agencyId']:-1;
		if($agencyId!=-1){

			$data['agency_data']=$this->AgenciesModel->getAgencyDetail($agencyId);
			$this->load->view('Admin/AgencyDetail',$data);
		}
		else{
			echo "Back to page";
			exit();
		}
		
	}
}