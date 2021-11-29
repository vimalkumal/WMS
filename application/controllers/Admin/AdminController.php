<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {

	public function __counstruct(){
		parent :: __counstruct();
		
	}

	public function index()
	{	
		is_userLogin('Admin');
		$data=array();
		$this->load->model('Admin/AdminModel');

		
		$noOfAdmin=sizeof($this->GeneralModel->getWhereTableData('user',array('iRoleId'=>1)));
		$data['total_user']		=	$this->AdminModel->getNumberOfRecordes('user')-$noOfAdmin;
		$data['total_agency']	=	$this->AdminModel->getNumberOfRecordes('agencies');
		$data['total_category']	=	$this->AdminModel->getNumberOfRecordes('category');
		$data['total_product']	=	$this->AdminModel->getNumberOfRecordes('product');
		$data['color']			=	$this->GeneralModel->getWhereTableData('color_master',array('eStatus'=>'Active'));
		
		//request data
		$data['request_pending']			=	$this->AdminModel->getRequestRecored("Pending");
		$data['request_approved']			=	$this->AdminModel->getRequestRecored("Approved");

		$data['last_month_data']			= 	$this->AdminModel->getLastMonthData();
		$data['last_seven_day']				= 	$this->AdminModel->getLastSevenData();

		$data['populer_product']			= 	$this->AdminModel->getPopulerProductData();
		$data['product_type']				= 	$this->AdminModel->getPoroductTypeData();

		// pr($last_month);
		// pr($last_seven_day);
		

		
		$this->load->view('Admin/Dashboard',$data);
	}
	public function sitemap()
	{
		is_userLogin('Admin');
		$this->load->view('Admin/sitemap');
	}
	
}