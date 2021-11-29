<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminRequestController extends CI_Controller {

	// protected $pro_id_array=array();
	public function __counstruct(){
		parent::__counstruct();
		$this->load->model('Admin/AdminRequestModel');
	}
	
	public function index()
	{
		is_userLogin('Admin');
		$this->load->model("Admin/AdminRequestModel");

		$data['request_data']=$this->AdminRequestModel->getRequestData();

		$this->load->view('Admin/AdminRequest',$data);
		
	}		
	
	public function requestDetailPage($reqId=0)
	{
		is_userLogin('Admin');
		// pr($reqId,1);
		if($reqId!=0){
			$request_id=$reqId;
		}
		elseif (isset($_REQUEST['reqId'])) {
			$request_id=$_REQUEST['reqId'];	
		}
		else
		{
			$request_id=0;
			alert_message("Request Details is not Exist with the Recored");
			$valid_message.="|alert-worning";
			$this->session->set_flashdata('request_message',$valid_message);
			redirect('Admin/AdminRequestController');
		}
		
		$this->load->model('Admin/AdminRequestModel');
		$data['request_item_data']=$this->AdminRequestModel->getProductRequestItemData($request_id);
		$data['agency_info']=$this->GeneralModel->getWhereTableData("agencies",array("eStatus"=>'Active'));
		$this->load->view('Admin/AdminRequestDetail',$data);
	}

	public function changeProductRequestStatus()
	{
		
		
		if(isset($_REQUEST['role']) || isset($_REQUEST['role']) ){
			$role=$_REQUEST['role'];
			$action=$_REQUEST['action'];
		}
		else{
			echo "Somthing is wrong Please try after some time";
			exit();
		}
		
		switch ($role) {
			case 'Admin':
				is_userLogin('Admin');
				break;
			case 'User':
				is_userLogin('User');
				break;
		}

		$process_task		= false;
		$valid_message		= "";
		
		
		// pr($action,1);
		if($action=="Approved"){
			if(empty($_POST)){
				$request_id=0;
			}
			$request_id			= $this->input->post('hRequestId');
			$agency_id		 	= $this->input->post('sAgencyId');

			$this->form_validation->set_rules('sAgencyId',		'Agency',	'required');

			$this->form_validation->set_message('required',		'Select Agency.');

			if($this->form_validation->run()){
					
				if (!AdminRequestController::isValidRequstSatus($request_id,"Approved")){
					$process_task	= false;
					$valid_message 	.= "Check Your Request Status";
				}
				else{
					$this->load->model('Admin/AdminRequestModel');
					$paramArray=[
						'status'=>'Approved',
						'agencyId'=>$agency_id,
						'requestId'=>$request_id
					];
					$result=$this->AdminRequestModel->updateAgencyStatus($paramArray);
					if($result['value']){
						$process_task	= true;
						$valid_message .= $result['message'];
					}
					else{
						$process_task	= false;
						$valid_message 	.= $result['message'];
					}
				}
			}
			else{
				$process_task	= false;
				$valid_message 	.= validation_errors();
			}

			if($process_task){
				$valid_message.="|alert-success";
				$this->session->set_flashdata('request_message',$valid_message);
			}
			else{
				$valid_message.="|alert-danger";
				$this->session->set_flashdata('request_message',$valid_message);
				
			}
			AdminRequestController::requestDetailPage($request_id);
		}
		else if($action=="Cancel"){
			$request_id=$_REQUEST['RequestId'];
			if($role=="User"){
				$uId=$this->session->userdata('session_user_id');
				$check_is_valid_user_request=$this->GeneralModel->getWhereTableData('request',array('iRequestId'=>$request_id,'iAddedBy'=>$uId));
				if(empty($check_is_valid_user_request)){
					echo "Unable to Cancel this request !!";
					echo "<br>Go Back !!";
					exit();
				}
			}
			if (!AdminRequestController::isValidRequstSatus($request_id,"Approved")){
				$process_task	= false;
				$valid_message 	.= "You Can not able to cancel this request.";

			}
			else{
				$this->load->model('Admin/AdminRequestModel');
				$paramArray=[
					'status'=>'Cancel',
					'requestId'=>$request_id
				];
				$result=$this->AdminRequestModel->updateAgencyStatus($paramArray);

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
				$this->session->set_flashdata('request_message',$valid_message);
			}
			else{
				$valid_message.="|alert-danger";
				$this->session->set_flashdata('request_message',$valid_message);
				
			}

			//redirect base on request user
			$callBy=isset($_REQUEST['role'])?$_REQUEST['role']:'';
			if($callBy=="User"){
				// $valid_message="Request Cancel.";
				// $valid_message.="|alert-warning";
				$this->session->set_flashdata('request_message',$valid_message);
				$this->load->model('User/RequestModel');
				$data['request_item_data']=$this->RequestModel->getProductRequestItemData($request_id);
				$this->load->view('User/RequestDetail',$data);

			}else{
				AdminRequestController::requestDetailPage($request_id);	
			}
			

		}
		else if($action=="Accept"){
			// pr('Call',1);
			$request_id				= $this->input->post('hRequestId');
			$received_date		 	= $this->input->post('tReceivedDate');

			
			$this->form_validation->set_rules('tReceivedDate',		'Received Date',	'required');

			$this->form_validation->set_message('required',		'Enter Received Date.');

			if($this->form_validation->run()){

				$this->load->model('Admin/AdminRequestModel');
				// $date=date_create("2013-03-15");
				// date_format($date,"Y/m/d H:i:s");
				$paramArray=[
					'status'=>'Accept',
					'requestId'=>$request_id,
					'receivedDate'=>strval(date("Y-m-d",strtotime($received_date)))
				];
				// pr($paramArray,1);
				$result=$this->AdminRequestModel->updateAgencyStatus($paramArray);
				if($result['value']){
					$process_task	= true;
					$valid_message .= $result['message'];
				}
				else{
					$process_task	= false;
					$valid_message 	.= $result['message'];
				}
			}
			else{
				$process_task	= false;
				$valid_message 	.= validation_errors();
			}

			if($process_task){
				$valid_message.="|alert-success";
				$this->session->set_flashdata('request_message',$valid_message);
			}
			else{
				$valid_message.="|alert-danger";
				$this->session->set_flashdata('request_message',$valid_message);
				
			}
			// redirect($request_id);
			$this->load->model('Agency/AgencyRequestModel');
			$data['request_item_data']=$this->AgencyRequestModel->getProductRequestItemData($request_id);
			$this->load->view('Agency/AgencyRequestDetail',$data);
		}
		else if($action=="Denied"){

			$request_id=$_REQUEST['RequestId'];

			$this->load->model('Admin/AdminRequestModel');
			$paramArray=[
				'status'=>'Denied',
				'requestId'=>$request_id
			];
			$result=$this->AdminRequestModel->updateAgencyStatus($paramArray);

			if($result['value']){
				$process_task	= true;
				$valid_message .= $result['message'];
			}
			else{
				$process_task	= false;
				$valid_message 	.= $result['message'];
			}

			if($process_task){
				$valid_message.="|alert-warning";
				$this->session->set_flashdata('request_message',$valid_message);
			}
			else{
				$valid_message.="|alert-danger";
				$this->session->set_flashdata('request_message',$valid_message);
				
			}
			redirect("Agency/AgencyRequestController");
			// $this->load->model('Agency/AgencyRequestModel');
			// $data['request_item_data']=$this->AgencyRequestModel->getProductRequestItemData($request_id);
			// $this->load->view('Agency/AgencyRequestDetail',$data);

		}
		else{
			echo "Check You Status ";
			echo "404";
			exit();
		}
		// pr($_POST,1);
	}

	public function collectedProductRequest($pc_req_id=0)
	{
		$request_id=0;
		is_userLogin('Admin');
		if($pc_req_id!=0)
		{
			$request_id=$pc_req_id;	
		}
		elseif (isset($_REQUEST['pReqId'])) {
			$request_id=$_REQUEST['pReqId'];
		}
		else{
				
		}
		
		if($request_id!=0 || $request_id!=''){
			$this->load->model('Admin/AdminRequestModel');
			$data['request_item_data']=$this->AdminRequestModel->getProductRequestItemData($request_id);
			// pr($data['request_item_data'],1);
			$this->load->view('Admin/AdminCollectProduct',$data);	
		}else{
				echo "404 Recored Not Found !!";
				echo "Go Back";exit();
		}
		
	}
	public function is_piece_valid($field){

		$this->form_validation->set_message('is_piece_valid', 'Enter valid quantity value  for the Piece.');
		return false;
	}
	public function setCollectedProductRequestData()
	{
		is_userLogin('Admin');
		$input_params 		= array();
		$process_task		= false;
		$isPieceExist		= false;
		$isIntValue			= true;
		$valid_message		= "";
		// pr($_POST,1);
		$req_id 					 	= $this->input->post('hRequestId');
		$req_by_id 					 	= $this->input->post('hRequestById');
		$req_agency_id				 	= $this->input->post('hRequestForId');
		$req_product_code_array		 	= $this->input->post('reqItemCode[]');
		$req_product_qty_array		 	= $this->input->post('p_received_qty[]');
		$req_product_id_array		 	= $this->input->post('hProductId[]');
		$req_product_point_array	 	= $this->input->post('hRewardPoint[]');
		$req_product_qty_type_array	 	= $this->input->post('hProductQtyType[]');

		
		// all from input rules
		// $this->form_validation->set_rules('p_received_qty[]',		'Product Received Quantity', 		'required|numeric');
		
		if (!empty($req_product_qty_array)) {
			# code...
			foreach ($req_product_qty_array as $key => $value){
				if($req_product_qty_type_array[$key]=="Piece"){
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
		}
		
		if($isPieceExist && (!$isIntValue)){
			$this->form_validation->set_rules('p_received_qty[]',	'Product Received Quantity', 		'callback_is_piece_valid');
		}else{
			$this->form_validation->set_rules('p_received_qty[]',		'Product Received Quantity', 		'required|numeric');	
		}

		
		//set rules
		$this->form_validation->set_message('required',		'%s field is required.');
		$this->form_validation->set_message('numeric',	' %s field is contain only numeric value.');

		if($this->form_validation->run()){

			
				$this->load->model('Agency/AgencyRequestModel');

				$input_params=[
					'requestId' 		=>	$req_id,
					'requestById'		=>	$req_by_id,
					'requestAgencyId'	=>	$req_agency_id,
					'req_product_id'	=> 	$req_product_id_array,
					'req_product_point'	=> 	$req_product_point_array,
					'req_item_cod' 		=>	$req_product_code_array,
					'req_item_qyt' 		=>	$req_product_qty_array
				];
				$result=$this->AgencyRequestModel->collectRequestDetails($input_params);
				// pr($result,1);
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
		else{
				//form validation message.
				$process_task	 = false;
				$valid_message 	.= validation_errors();
		}
		// pr($valid_message,1);
		
		if($process_task){
			$valid_message.="|alert-success";
			$this->session->set_flashdata('request_message',$valid_message);
			AdminRequestController::requestDetailPage($req_id);
		}
		else{
			$valid_message.="|alert-danger";
			$this->session->set_flashdata('collect_request_message',$valid_message);
			AdminRequestController::collectedProductRequest($req_id);
		}
		
	}

	public function isValidRequstSatus($idRequest,$status)
	{
		$returnValue=false;
		switch ($status) {
			case 'Cancel':
			case 'Approved':
				$result_array=$this->GeneralModel->getWhereTableData('request',array("iRequestId"=>$idRequest,"eStatus"=>"Pending"));
				$returnValue=empty($result_array)?false:true;
			break;
		}
		return  $returnValue;
	}
}	
