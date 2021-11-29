<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AgencyDetailController extends CI_Controller {

	public function index()
	{
		is_userLogin('Agency');
		$this->load->model('Agency/AgencyDetailModel');
		$data['agency_data']=$this->AgencyDetailModel->fetch_agency_detail();
		$this->load->view('Agency/AgencyView',$data);
	}	
}