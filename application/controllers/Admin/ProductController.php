<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductController extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Admin/ProductModel');
	}
	public function index()
	{
		is_userLogin('Admin');
		$data['product']=$this->ProductModel->getProductDetails();
		$this->load->view('Admin/Product',$data);
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
	public function is_value_valid($field)
	{
		if($field>0){
			return true;
		}
		else{
			$this->form_validation->set_message('is_value_valid', '{field} value should be greater than 0.');
			return false;
		}
	}
	public function setProduct(){

		$process_task		= false;
		$valid_message		= "";
		
		// all from input
		$product_mode			= $this->input->post('hMode');
		if($product_mode=="Add"){
			$product_code		 	= $this->input->post('tProductCode');
		}else{
			$product_code		 	= $this->input->post('hProductCode');	
		}
		
		$product_id 		 	= $this->input->post('hProductId');
		$product_name		 	= $this->input->post('tProductName');
		$product_r_point	 	= $this->input->post('tProductRewardPoints');
		$product_unit		 	= $this->input->post('tProductUnit');
		$product_category	 	= $this->input->post('sCategory');
		$product_image	 		= $this->input->post('fProductImage');
		$product_description 	= $this->input->post('teDescription');
		$product_status		 	= $this->input->post('sStatus');
		

		// all from input rules
		$this->form_validation->set_rules('tProductName',		'Product Name', 	'required|callback_is_valid_name');

		$this->form_validation->set_rules('tProductUnit',		'Product Unit', 	'required|callback_is_valid_name');
		$this->form_validation->set_rules('tProductRewardPoints',		'Product Reward Point', 	'required|numeric|callback_is_value_valid');

		if($product_mode=='Add'){
			$this->form_validation->set_rules('tProductCode',		'Product Code', 	'required|is_unique[product.vProductCode]');	
			if (empty($_FILES['fProductImage']['name']))
			{
			    $this->form_validation->set_rules('fProductImage', 'Product Image', 'required');
			}
		}
		
		$this->form_validation->set_rules('sCategory',		'Category', 	'required');
		$this->form_validation->set_rules('teDescription',	'Description', 	'required');
		$this->form_validation->set_rules('sStatus',		'Status', 	'required');
		//set rules
		$this->form_validation->set_message('required',		'%s field is required.');
		$this->form_validation->set_message('numeric',		'%s field is contains only numeric.');
		$this->form_validation->set_message('is_unique',	'%s is exist with another product.');
		$this->form_validation->set_message('alpha',		'%s Contain Only Charecter.');
		

		if($this->form_validation->run()){

			if(!empty($_FILES['fProductImage']['name'])){

				$config['upload_path']          = './assets/images/Admin/Product/';
		        $config['allowed_types']        = 'gif|jpg|png';
		        $config['max_size']             = 1000;
		        $config['max_width']            = 1024;
		        $config['max_height']           = 768;
		        $config['encrypt_name'] 		= TRUE;
		        $new_fname						= time()."_".$_FILES["fProductImage"]['name'];
		        $config['file_name'] 			= $new_fname;
		       
		        $this->load->library('upload', $config);
		        
		        if (!$this->upload->do_upload('fProductImage'))
		        {
	                $error 			= array('error' => $this->upload->display_errors());

	                $process_task	= false;
	                // pr($error,1);
	                // $valid_message.=implode(" ", $error);
	                $valid_message.="Product image should be .png .jpg .gif, size < 1mb, max width= 1024, max heighr=768";
		        }
		        else
		        {
		        	$process_task	= true;
		        	$data 			= array('upload_data' => $this->upload->data());
                	$imageName		= $data['upload_data']['file_name'];
		        }

			}
			else{
				$process_task=true;
			}

			if($process_task){
				$img_status=0;
				if(!empty($_FILES['fProductImage']['name'])){
					$img_status=1;
				}
				$paramArray=[
					'imageUpload'		=>  $img_status,
					'pro_id'			=> 	$product_id,
					'pro_name'			=>	$product_name,
					'pro_unit'			=>	$product_unit,
					'pro_r_point'		=>	$product_r_point,
					'pro_code'			=>	$product_code,
					'pro_category'		=>	$product_category,
					'pro_image'			=>	$imageName,
					'pro_description'	=>	$product_description,
					'pro_status'		=>	$product_status
				];

				$result=$this->ProductModel->setProductDetails($paramArray);
				
				if($result['value']){

					//add product success.
					$process_task	= true;
					$valid_message .= $result['message'];
				}
				else{
					//failed add product.
					$process_task	 = false;
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
				$process_task	 = false;
				// pr(validation_errors(),1);
				$valid_message 	.= validation_errors();
		}

		if($process_task){

			$valid_message.="|alert-success";
			$this->session->set_flashdata('product_message',$valid_message);
			redirect("Admin/ProductController/");
		}
		else{

			if($product_mode="Update")
			{
				$valid_message.="|alert-danger";
				$this->session->set_flashdata('product_message',$valid_message);
				ProductController::productForm($product_id);

			}else{
				$valid_message.="|alert-danger";
				$this->session->set_flashdata('product_message',$valid_message);
				redirect("Admin/ProductController");
			}


			
		}

		
	}

	public function productForm($pro_id=0){
		is_userLogin('Admin');
		$data['category']=$this->ProductModel->getCategoryList();
		$var_product_id=0;


		//NEW
		if (isset($_REQUEST['productId'])){
			$var_product_id=$_REQUEST['productId'];
			$data['product_info']=array();
		}
		elseif ($pro_id!=0) {
			$var_product_id=$pro_id;
		}
		else{
			$var_product_id=0;	
		}

		if($var_product_id!='' && $var_product_id>0)
		{
			// pr("CI_Controller");
			$data['product_id']=$var_product_id;
			$data['product_info']=$this->ProductModel->getProductDetails($data['product_id']);
		}

		// OLD
		// $data['product_id']=isset($_REQUEST['productId'])?$_REQUEST['productId']:-1;
		
		// if($data['product_id']!=-1){
		// 	$data['product_info']=$this->ProductModel->getProductDetails($data['product_id']);
		// }
		$this->load->view("Admin/ProductForm",$data);

	}
	public function unsetProduct(){
		$product_id 		= isset($_REQUEST['productId'])?$_REQUEST['productId']:-1;
		$process_task		= false;
		$valid_message		= "";
		
		if($product_id===-1){
			$valid_message="Try Again !!";
		}else{
			$result				= $this->ProductModel->deleteProduct($product_id);
			if($result['value']){

				//registration success.
				$process_task	= true;
				$valid_message .= $result['message'];
				
			}
			else{
				//failed registration.
				$process_task	= false;
				$valid_message 	.= $result['message'];
				
			}
		}
		if($process_task){

			$valid_message.="|alert-warning";
			$this->session->set_flashdata('product_message',$valid_message);
		}
		else{
			$valid_message.="|alert-danger";
			$this->session->set_flashdata('product_message',$valid_message);
			
		}
		redirect("Admin/ProductController");
	}

}
