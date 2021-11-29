
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AgencyRequestController extends CI_Controller {

	// protected $pro_id_array=array();
	public function __counstruct(){
		parent::__counstruct();
		$this->load->model('Agency/AgencyRequestModel');
	}
	
	public function index()
	{
		is_userLogin('Agency');
		$this->load->model("Agency/AgencyRequestModel");

		$data['request_data']=$this->AgencyRequestModel->getRequestData();

		$this->load->view('Agency/AgencyRequest',$data);
		
	}		
	
	public function requestDetailPage($param_request_id=0)
	{
		is_userLogin('Agency');
		if($param_request_id!=0){
			$request_id=$param_request_id;
		}
		elseif (isset($_REQUEST['reqId'])) {
			$request_id=$_REQUEST['reqId'];	
		}
		else{
			$request_id=0;
		}
		
		$this->load->model('Agency/AgencyRequestModel');
		$data['request_item_data']=$this->AgencyRequestModel->getProductRequestItemData($request_id);
		// pr($data['request_item_data'],1);
		$this->load->view('Agency/AgencyRequestDetail',$data);
	}


	public function collectedProductRequest($pc_req_id=0)
	{
		is_userLogin('Agency');
		if($pc_req_id!=0)
		{
			$request_id=$pc_req_id;	
		}
		elseif (isset($_REQUEST['pReqId'])) {
			$request_id=$_REQUEST['pReqId'];
		}
		else{
				$request_id=0;
		}
		
		if($request_id>0 && $request_id!=''){
			$this->load->model('Agency/AgencyRequestModel');
			// get data 
			// $this->load->model('Agency/AgencyRequestModel');

			$data['request_item_data']=$this->AgencyRequestModel->getProductRequestItemData($request_id);

			// pr($data['request_item_data'],1);
			$this->load->view('Agency/CollectProduct',$data);		
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
		is_userLogin('Agency');
		// pr($_REQUEST,1);
		$input_params 		= array();
		$process_task		= false;
		$isPieceExist		= false;
		$isIntValue			= true;
		$valid_message		= "";

		$OTP_PIN						= $this->input->post('pPin');
		$req_id 					 	= $this->input->post('hRequestId');
		$req_by_id 					 	= $this->input->post('hRequestById');
		$req_agency_id				 	= $this->input->post('hRequestForId');
		$req_product_code_array		 	= $this->input->post('reqItemCode[]');
		$req_product_qty_array		 	= $this->input->post('p_received_qty[]');
		$req_product_id_array		 	= $this->input->post('hProductId[]');
		$req_product_point_array	 	= $this->input->post('hRewardPoint[]');
		$req_product_qty_type_array	 	= $this->input->post('hProductQtyType[]');
		
		//check the Piece type is exist and it's exist then it'value int or not
		// pr(empty($req_product_qty_array)."..");
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


		// all from input rules
		
		
		
		//set rules
		$this->form_validation->set_message('required',		'%s field is required.');
		$this->form_validation->set_message('numeric',	' %s field is contain only numeric value.');

		if($this->form_validation->run()){

				$otpData=$this->GeneralModel->getWhereTableData('request',array('vServiceCollection'=>$OTP_PIN,'iRequestId'=>$req_id));
				// pr("Run",1);
				if(!empty($otpData)){
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
				}else{
					$process_task	 = false;
					$valid_message 	.= "Wrong OTP code";
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
			AgencyRequestController::requestDetailPage($req_id);
		}
		else{
			$valid_message.="|alert-danger";
			$this->session->set_flashdata('collect_request_message',$valid_message);
			AgencyRequestController::collectedProductRequest($req_id);
		}
		
	}


	public function requestDetailPagePdf()
	{
		is_userLogin('Agency');
		$data=array();
		if(isset($_REQUEST['reqId']) && isset($_REQUEST['action'])) {

			switch ($_REQUEST['action']) {
				case 'Request':
					$data['action']="Request";
					break;
				case 'Receipt':
					$data['action']="Receipt";
					break;
				default:
					echo "Go Back";
					exit();
					break;
			}
			$action=$_REQUEST['action'];
			$request_id=$_REQUEST['reqId'];	
			$this->load->model('Agency/AgencyRequestModel');
			
			$data['request_item_data'] 	= $this->AgencyRequestModel->getProductRequestItemData($request_id);
			$data['user_Info'] 			= $this->GeneralModel->getWhereTableData("user",array('iUserId'=>$data['request_item_data']['requestData']['iAddedBy']))[0];
			$data['agency_Info'] 		= $this->GeneralModel->getWhereTableData("agencies",array('iAgencyId'=>$data['request_item_data']['requestData']['iForeID']))[0];
			// pr($data['agency_Info'],1);
			$data['agency_owner']		= $this->GeneralModel->getWhereTableData("user",array('iUserId'=>$data['agency_Info']['iOwnerId']))[0];
			// pr($data['request_item_data'],1);

			$file_name=$data['request_item_data']['requestData']['vRequestCode']."_".$action;
			$file_name=str_replace("/", "_", $file_name);
			// $this->load->view('Agency/AgencyRequestDetailPDF',$data);

			// uncomment below code after pdf view create
			$this->load->library('pdf');
			
			$html_content = $this->load->view('Agency/AgencyRequestDetailPDF',$data,TRUE);
			$this->pdf->createPDF($html_content,$file_name);
		}
		else{
			echo "Check Your  Request Details ";
			echo "Go Back ";
			exit();
		}
		
		
	}
	
}