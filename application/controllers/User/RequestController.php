<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RequestController extends CI_Controller {

	// protected $pro_id_array=array();
	public function __counstruct(){
		parent::__counstruct();
		$this->load->model('User/RequestModel');
	}
	
	public function index()
	{
		is_userLogin('User');
		$this->load->model('User/RequestModel');
		$data['request_data']=$this->RequestModel->getProductRequestData($this->session->userdata('session_user_id'));

		$this->load->view('User/Request',$data);
		
	}	
	public function placeOrder()
	{
		is_userLogin('User');
		$process_task		= false;
		$valid_message		= "";
		if(RequestController::isAddressExist()){
			$process_task=true;
		}
		else{
			// alert_message("");
			$process_task=false;
			// pr('',1);
			$valid_message.="AddressMesssage";
		}	

		if($process_task){

			$valid_message.="";
			$this->load->model('User/RequestModel');
			$data['product']=$this->RequestModel->getProductInfo();
			$data['address']=$this->GeneralModel->getWhereTableData('address',array('iUserId'=>$this->session->userdata('session_user_id'),'eStatus'=>'Active','eDelete'=>'NO'));
			$this->load->view('User/PlaceOrder',$data);
		}
		else{
			
			$valid_message.="|alert-danger";
			$this->session->set_flashdata('address_message',$valid_message);
			redirect("User/AddressController");
			
		}
		// ----------
		
	}
	public function getProductList()
	{
		$postArray=$_POST;
		// pr($postArray,1);
		$this->load->model('User/RequestModel');
		$categoryId=$postArray['sProductId'];
		$product=$this->RequestModel->getProductInfo(0,$categoryId);
		// pr($product,1);
		foreach ($product as $key => $value) {
			?>
			<div class="row product-list-item">

				<input type="hidden" name="productId[<?= $value['iProductId']?>]"	value="<?= $value['iProductId'] ?>">
				<input type="hidden" name="productQtyType[<?= $value['iProductId']?>]"	value="<?= $value['vProductUnit'] ?>">
				<div class="col-3">
					<img class="product-image" src="<?= base_url()?>assets/images/Admin/Product/<?= $product[$key]['vImage']?>">
					
					<div class="text-capitalize product-val">
						<?= $product[$key]['vProductName'] ?>
					</div>
					
					<div class="text-capitalize product-cat-val">
						<?= $product[$key]['vCategoryName'] ?>

					</div>
				
				</div>
				
				<div class="col-3">
					<div>Product Quantity</div>
					<div class="input-group">
						<input class="form-control" type="text" placeholder="" name="productqty[<?=$value['iProductId']?>]" 	>
						 <div class="input-group-append">
						    <span class="input-group-text" id="basic-addon2"><?= $value['vProductUnit'] ?></span>
						  </div>
					</div>
				</div>
				
			</div>
		<?php
		}
		// echo "Hello this is try";
	}

	// public function requestProductItem()
	// {
	// 	$data['productId']=$_REQUEST['productId'];

	// 	$result_product=$this->GeneralModel->getWhereTableData('product',array('iProductId'=>$data['productId']));
	// 	$data['productName']=$result_product[0]['vProductName'];
		
	// 	$data['address']=$this->GeneralModel->getWhereTableData('address',array(
	// 		'iUserId'=>$this->session->userdata('session_user_id'),
	// 		'eStatus'=>'Active'
	// 		));
	// 	// pr($data);

	// 	$this->load->view('User/RequestForm',$data);
	// }
	public function is_qty_exist($field){

		$this->form_validation->set_message('is_qty_exist', 'Enter at least one quantity value.');
		return false;
	}
	public function is_qty_zero($field){

		$this->form_validation->set_message('is_qty_zero', 'Quantity value should be greater than Zero.');
		return false;
	}
	public function is_piece_valid($field){

		$this->form_validation->set_message('is_piece_valid', 'Enter valid quantity value  for the Piece.');
		return false;
	}

	public function setOrderRequest()
	{
		$process_task		= false;
		$valid_message		= "";
	
		$product_id_qty_array=array();
		$post_array=$_POST;
		// pr($post_array,1);
		
		$isQtyEmpty 	= true;
		$isPieceExist	= false;
		$isValueZero 	= false;
		$isIntValue		= true;
		foreach ($post_array['productqty'] as $key => $value){
			if($value!='' or $value!=null){
				//check the pice value
				if($post_array['productQtyType'][$key]=="Piece"){
					$isPieceExist=true;
					if (strpos($value,'.') !== false) {
						// pr("float");
					    $isIntValue=false;
					}else {
						// pr("int");
					    $isIntValue=true;
					}
					
				}
				//check the 0 Queantity Value
				if($value<=0){
					$isValueZero=true;
				}
				//add recorder in array for get value
				$isQtyEmpty=false;
				$product_id_qty_array[$key]=$value;
			}
		}
		
		//set rules if any queantity value not exist
		if(!$isQtyEmpty){
		}
		else{
			$this->form_validation->set_rules('productqty[]',	'Product', 		'callback_is_qty_exist');
		}
		if($isValueZero){
			$this->form_validation->set_rules('productqty[]',	'Product', 		'callback_is_qty_zero');	
		}
		if($isPieceExist && (!$isIntValue)){
			$this->form_validation->set_rules('productqty[]',	'Product', 		'callback_is_piece_valid');
		}

		$req_product_Address 		 	= $this->input->post('sAddress');
		$req_product_date			 	= $this->input->post('hPlaceDate');
		
		// all from input rules
		$this->form_validation->set_rules('sAddress',		'Address', 		'required');
		$this->form_validation->set_rules('hPlaceDate',		'Place Date', 	'required');

		
		// $this->form_validation->set_rules('rAddress',			'Address', 		'required');
		
		//set rules
		$this->form_validation->set_message('required',		'%s field is required.');
		
		

		if($this->form_validation->run()){
			// $config['upload_path']          = './assets/images/User/ProductRequest/';
	  //       $config['allowed_types']        = 'gif|jpg|png';
	  //       $config['max_size']             = 1000;
	  //       $config['max_width']            = 1024;
	  //       $config['max_height']           = 768;
	  //       $config['encrypt_name'] 		= TRUE;
	  //       $new_fname						= time()."_".$_FILES["fProductImage"]['name'];
	  //       $config['file_name'] 			= $new_fname;
	       
	  //       $this->load->library('upload', $config);
	        
	        // if (!$this->upload->do_upload('fProductImage'))
	        // {
	        //         $error 			= array('error' => $this->upload->display_errors());

	        //         $process_task	= false;
	        //         // pr($error,1);
	        //         // $valid_message.=implode(" ", $error);
	        //         $valid_message.="Product image should be .png .jpg .gif, size < 1mb, max width= 1024, max heighr=768";
	        // }
	        // else
	        // {
                // $data 		= array('upload_data' => $this->upload->data());
                // $imageName	= $data['upload_data']['file_name'];

				// $request=[
				// 	'req_product_id'			=> 	$req_product_id,
				// 	'req_product_name'			=>	$req_product_name,
				// 	'req_product_unit'			=>	$req_product_unit,
				// 	'req_product_quantity'		=>	$req_product_quantity,
				// 	'req_user_address'			=>	$req_user_address,
				// 	'req_product_image'			=>	$req_product_image,
				// 	'req_description'			=>	$req_description,
				// 	'req_product_date'			=>	$req_product_date
				// ];

				$servic_collection_code=get_otp();
				$is_update_request_OTP 	= false;
				$requestCode="";
				//request code Generat
				$last_code_value=$this->GeneralModel->getLastCodeValue('request','vRequestCode','DESC');
				$last_code_value+=1;
				$new_code_value=sprintf('%06d',$last_code_value);
				$requestCode="REQ/".date('Y/m')."/".$new_code_value;

				$email_message="";
					

				$email_msg_array=array();
				$email_msg_array['user_name'] 				= $this->session->userdata('user_name');
				$email_msg_array['request_code'] 			= $requestCode;
				$email_msg_array['servic_collection_code'] 	= $servic_collection_code;

				$email_message=$this->EmailTemplateModel->productRequest($email_msg_array);
				$email_params=[
				"user_email"	=>	$this->session->userdata('user_email'),
				"subject"		=>	"Your Product Service Collection Code ",
				"message"		=>	$email_message
				];

				if($this->GeneralModel->sendMail($email_params)){

					$request_item=[
						'request_code' 				=> $requestCode,
						'request_address' 			=> $req_product_Address,
						'request_date'				=> $req_product_date,
						'request_by'				=> $this->session->userdata('session_user_id'),
						'request_status'			=> 'Pending',
						'request_product_array' 	=> $product_id_qty_array,
						'servic_collection_code'	=> $servic_collection_code
					];
					// pr($request_item,1);
					$this->load->model('User/RequestModel');
					$result=$this->RequestModel->setRequestDetails($request_item);
					
					if($result['value']){
						//email content
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
				else{
					$process_task=false;
					$valid_message.="Somthing Went Wrong Please Try After Some Time";
				}
				
			// }// end of image 

		}
		else{
				//form validation message.
				$process_task	 = false;
				$valid_message 	.= validation_errors();
		}

		if($process_task){
			$valid_message.="|alert-success";
			$this->session->set_flashdata('request_message',$valid_message);
			RequestController::requestDetailView($result['last_added_request']);
		}
		else{
			$valid_message.="|alert-danger";
			$this->session->set_flashdata('place_order_message',$valid_message);
			redirect("User/RequestController/placeOrder");
		}
		
	}
	
	public function requestDetailView($idRequest=0)
	{
		is_userLogin('User');
		// if(isset($_REQUEST['requestId'])){
		// 	$request_id
		// }
		

		if($idRequest!=0){
			$request_id=$idRequest;
		}
		elseif (isset($_REQUEST['reqId'])){
			$request_id=$_REQUEST['reqId'];
		}
		else{
			$request_id=0;		
		}

		$this->load->model('User/RequestModel');
		$data['request_item_data']=$this->RequestModel->getProductRequestItemData($request_id);
		// pr($data['request_item_data'],1);
		$this->load->view('User/RequestDetail',$data);
	}

	public function isAddressExist()
	{
		$result=$this->GeneralModel->getWhereTableData('address',array('iUserId'=>$this->session->userdata('session_user_id'),
			"eDelete"=>"No"));
		if(sizeof($result)>0){
			return true;
		}
		else{
			return false;
		}
		
	}

	public function editProductRequest($p_req_id=0)
	{


		if($p_req_id!=0){
			$request_id=$p_req_id;	
		}
		else{
			$request_id=$_REQUEST['RequestId'];	
		}
		
		$uId=$this->session->userdata('session_user_id');
		$check_is_valid_user_request=$this->GeneralModel->getWhereTableData('request',array('iRequestId'=>$request_id,'iAddedBy'=>$uId,'eStatus'=>'Pending'));
			
		
		if($request_id!=0 && $request_id!='' && !(empty($check_is_valid_user_request)))
		{
			$this->load->model('User/RequestModel');

			$data['address_data']=$this->GeneralModel->getWhereTableData('address',array('iUserId'=>$this->session->userdata('session_user_id')));
			// pr($data['address_data'],1);

			$data['request_item_data']=$this->RequestModel->getProductRequestItemData($request_id);	
			$this->load->view('User/EditRequestDetail',$data);
		}else{
			echo "Unable to edit this request !!";
			echo "<br>Go Back !!";
			exit();
		}
		
		
		// pr($data['request_item_data'],1);
	}
	// update order request -------------------------------------

	public function validate_value_qty ($field) {
    	if(preg_match('/^[0-9]+\.?[0-9]+$/', $field) || preg_match('/^[0-9]+$/', $field)){
        	return true;
	    } else {
	         $this->form_validation->set_message('Product Quantity','Please enter valid Product Quantity!');
	        return false;
	    }
	}

	public function updateOrderRequest()
	{
		//in this function form validation is custome use.
		$isPieceExist			= false;
		$isIntValue				= true;
		$isValueZero 			= false;
		$isFormValidate			= true;
		$process_task			= false;
		$valid_message			= "";
		$postArray 				= $_POST;
		$itemReqArray 			= array();
		// pr($postArray,1);
		$req_id			= $this->input->post('hRequestId');
		$address_id		= $this->input->post('sAddress');
		$itemReqArray	= $this->input->post('reqItem[]');

		foreach ($postArray['reqItem'] as $key => $value){
			
			//check value
			if(preg_match('/^[0-9]+\.?[0-9]+$/', $value) || preg_match('/^[0-9]+$/', $value)){		    	
				// break;
		    }
		    else{
		    	$isFormValidate	= false;
				$valid_message.="Quantity value should be Number only.";
				break;
		    }

			//check the 0 Queantity Value
			if($value<=0){
				// pr("Value Zero");
				$isValueZero=true;
				// break;
			}

			//check the Piece value
			if($postArray['productQtyType'][$key]=="Piece"){
				$isPieceExist=true;
				$pice_value = explode('.',$value);
				// pr($pice_value);
				if (sizeof($pice_value)>=2){
					if(intval($pice_value[1])>0){
						// pr("float");
				    	$isIntValue=false;
				    	// break;
					}
					else{
						$isIntValue=true;
					}
					
				}else {
					// pr("int");
				    $isIntValue=true;
				}
			}

			


		}
				
		if($isPieceExist && (!$isIntValue)){
			// pr("Piece validation",1);
			$isFormValidate	= false;
			$valid_message.="Enter valid quantity value  for the Piece.";
			//this not work
			$this->form_validation->set_rules('reqItem[]',	'Product Quantity', 		'callback_is_piece_valid');
		}
		if($isValueZero){
			$isFormValidate	= false;
			$valid_message.="Quantity value should be greater than Zero.";
			//this not work
			$this->form_validation->set_rules('reqItem[]',	'Product Quantity', 		'callback_is_qty_zero');	
		}
		
		$this->form_validation->set_rules('reqItem[]',	'Product Quantity', 		'required|numeric');
		$this->form_validation->set_rules('sAddress',	'Address', 					'required');

		$this->form_validation->set_message('required',		'This %s field is required.');
		$this->form_validation->set_message('numeric',	'This %s field is contain only numeric value.');
		
		
		

		// if($this->form_validation->run())
		if($isFormValidate)
		{
			// pr("validation run",1);
			$inputParams=array();
			$itemReqArray=$postArray['reqItem'];
			
			$this->load->model('User/RequestModel');

			$inputParams['reqItemArray']	=	$itemReqArray;
			$inputParams['requestId']		=	$req_id;
			$inputParams['addressId']		=	$address_id;

			$result=$this->RequestModel->updateRequestDetails($inputParams);
			if($result['value']){
				$process_task	= true;
				$valid_message .= $result['message'];
				
			}
			else{
				$process_task	 = false;
				$valid_message 	.= $result['message'];
			}
			
		}
		else{
				$process_task	 = false;
				$valid_message 	.= validation_errors();
				// pr($valid_message,1);
		}

		if($process_task){
			$valid_message.="|alert-success";
			$this->session->set_flashdata('request_detail_message',$valid_message);
			RequestController::requestDetailView($req_id);
		}
		else{
			$valid_message.="|alert-danger";
			$this->session->set_flashdata('edit_request_message',$valid_message);
			RequestController::editProductRequest($req_id);
			// redirect("User/RequestController/placeOrder");
		}

		
	}
}