<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryController extends CI_Controller {
	 public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin/CategoryModel');
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
	public function index()
	{
		is_userLogin('Admin');
		$data['category_parent']	= $this->CategoryModel->getParentCategory();
		$data['category']			= $this->CategoryModel->getCategoryDetails();
		
		// pr($data['category'],1);
		$this->load->view('Admin/Category',$data);
	}


	public function setCategory(){
		$process_task		= false;
		$valid_message		= "";
		// pr($_FILES['fImage']);
		// pr($_REQUEST,1);
		//extra variable
		$imageName 			= "";
		$is_image_upload 	= true;

		// all from input
		$category_mode			= $this->input->post('hMode');
		if($category_mode=="Add"){
			$category_code		 	= $this->input->post('tCategoryCode');
		}else{
			$category_code		 	= $this->input->post('hCaregoryCode');	
		}
		$category_id 			= $this->input->post('hCategoryId');
		$category_name		 	= $this->input->post('tCategoryName');
		
		$pCategory_id		 	= $this->input->post('sParentCategory');
		$category_image		 	= $this->input->post('fImage');
		$category_status	 	= $this->input->post('sStatus');

		// all from input rules
		$this->form_validation->set_rules('tCategoryName',	'Category Name', 	'required|callback_is_valid_name');
		$this->form_validation->set_rules('sStatus',		'Status', 			'required');

		if($category_mode=="Add"){
			$this->form_validation->set_rules('tCategoryCode',	'Category Code', 'required|is_unique[category.vCategoryCode]');
			if (empty($_FILES['fImage']['name']))
			{
			    $this->form_validation->set_rules('fImage', 'Category Image', 'required');
			}
		}
		

		//set rules
		$this->form_validation->set_message('required',		'%s field is required.');
		$this->form_validation->set_message('is_unique',	'%s is exist with another category.');
		$this->form_validation->set_message('alpha',		'%s Contain Only Charecter.');	
		
		if($this->form_validation->run()){
			if(!empty($_FILES['fImage']['name'])){
				$config['upload_path']          = './assets/images/Admin/Category/';
		        $config['allowed_types']        = 'gif|jpg|png';
		        $config['max_size']             = 1000;
		        $config['max_width']            = 1024;
		        $config['max_height']           = 768;
		        $config['encrypt_name'] 		= TRUE;
		        $new_fname						= time()."_".$_FILES["fImage"]['name'];
		        $config['file_name'] 			= $new_fname;
		       
		        $this->load->library('upload', $config);
		        
		        if (!$this->upload->do_upload('fImage'))
		        {
	                $error 			= array('error' => $this->upload->display_errors());
	                $process_task	= false;
	                // $valid_message.=implode(" ", $error);
	                // pr($error,1);
	                $is_image_upload=false;
	                $valid_message.="Category image should be .png .jpg .gif, size < 1mb, max width= 1024, max heighr=768";
		        }
		        else{
		        	
		        	$process_task	= true;
		        	$is_image_upload=true;
		        	$data 		= array('upload_data' => $this->upload->data());
                	$imageName	= $data['upload_data']['file_name'];
		        }	
			}
			else{
				$process_task=true;
			}	

			if($process_task){

				$img_status=0;
				if(!empty($_FILES['fImage']['name'])){
					$img_status=1;
				}

				$paramArray=[
					'imageUplode'		=>  $img_status,
					'cat_id'			=>	$category_id,
					'cat_name'			=>	$category_name,
					'cat_code'			=>	$category_code,
					'cat_parent_id'		=>	$pCategory_id,
					'cat_image'			=>	$imageName,
					'cat_status'		=>	$category_status,
				];

				$result=$this->CategoryModel->setCategoryDetails($paramArray);
				
				if($result['value']){

					//category success.
					$process_task	= true;
					$valid_message .= $result['message'];
					
				}
				else{
					//failed category.
					$process_task	= false;
					$valid_message 	.= $result['message'];
					
				}
			}
	        else
	        {
                
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
			$this->session->set_flashdata('category_message',$valid_message);
			redirect("Admin/CategoryController");
		}
		else{

			if($category_mode="Update")
			{
				$valid_message.="|alert-danger";
				$this->session->set_flashdata('category_message',$valid_message);
				CategoryController::categoryForm($category_id);

			}else{
				$valid_message.="|alert-danger";
				$this->session->set_flashdata('category_message',$valid_message);
				redirect("Admin/CategoryController");
			}
		}
		
	}

	public function categoryForm($cat_id=0){
		
		is_userLogin('Admin');
		$data['category_parent']	= $this->CategoryModel->getParentCategory();
		$var_category_id=0;

		if (isset($_REQUEST['categoryId'])){
			$var_category_id=$_REQUEST['categoryId'];
			$data['category_info']=array();
		}
		elseif ($cat_id!=0) {
			$var_category_id=$cat_id;
		}
		else{
			$var_category_id=0;	
		}

		if($var_category_id!='' && $var_category_id>0)
		{
			// pr("CI_Controller");
			$data['category_id']=$var_category_id;
			$data['category_info']=$this->CategoryModel->getCategoryDetails($data['category_id']);
		}

		$this->load->view("Admin/CategoryForm",$data);
	}

	public function unsetCategory(){
		$category_id 		= isset($_REQUEST['categoryId'])?$_REQUEST['categoryId']:-1;
		$process_task		= false;
		$valid_message		= "";
		
		if($category_id<0){
			$valid_message="Try Again !!";
		}else{
			$result				= $this->CategoryModel->deleteCategory($category_id);
			if($result['value']){

				
				$process_task	= true;
				$valid_message .= $result['message'];
				
			}
			else{
				
				$process_task	= false;
				$valid_message 	.= $result['message'];
				
			}
		}
		
		if($process_task){
			$valid_message.="|alert-warning";
			$this->session->set_flashdata('category_message',$valid_message);
		}
		else{
			$valid_message.="|alert-danger";
			$this->session->set_flashdata('category_message',$valid_message);
		}
		redirect("Admin/CategoryController");
	}
}
