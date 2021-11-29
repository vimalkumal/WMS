<?php

	$pageName="Master";
	$subMenuRequest="Request"; 
	$message="";
	$classValue="alert-success";
	$reg_page=$this->session->flashdata('request_message');
	
	// var_dump($reg_page)
	if($this->session->flashdata('request_message')!=Null){
		$reg_page_array	=	explode("|", $this->session->flashdata('request_message'));
		$message 		=	$reg_page_array[0];
		$classValue		=	$reg_page_array[1];
	}
	// pr($request_item_data,1);
	// pr($agency_info,1);
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>:: Request Detail ::</title>
	<link rel="shortcut icon" href="<?= base_url()?>/assets/logo/logo.png">

	<!-- CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<!--data tabde  css-->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">

	<link rel="stylesheet" href="<?= base_url()?>assets/css/style.css" >
	<link rel="stylesheet" href="<?= base_url()?>assets/css/agency/agency_style.css" >
	
	<!-- JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

	<!-- for i-con view class -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

	<!-- Ajax -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>

	<!-- data table js -->
	<script src="https:////cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
		    $('#requestTable').DataTable();
		});
	</script>

	<?php require_once('HeaderAdmin.php');?>
	<style type="text/css">
		.title-strip > a{
			text-decoration: none;
		}
		.title-strip > a:hover{
			color: #388E3C;
		}
		.contant{
			padding: 5px;
			padding-bottom: 20px;
			/*background-color: #fff;*/
		}
		.contant-request{
			padding: 4px;
			border: 1px solid black;
		}
		.contant-request-item{
			margin-top: 5px;
			background-color: #fff;	
		}
		.data-item-label-title,.label-data-title {
		    font-size: 13px;
		    font-weight: bold;
		}
		.data-item-label-value,.label-data-value {
		    font-size: 17px;
		    margin-bottom: 9px;
		    display: block;
		}
		.request-item {
		    padding: 5px;
		    border-bottom: 1px solid;
		    margin-bottom: 8px;
		}
		.title-req-item {
			font-size: 18px;
			display: inline-block;
			margin-bottom: 34px;
			margin-top: 10px;
			border-bottom: 4px solid #388E3C;
			font-weight: bold;
		}
		.product-image{
			width: 50px;
			height:  50px;
		}
		button.action-btn {
			float: right;
		  /*  margin-bottom: 10px;
		    background-color: #66bb6a;
		    color: #000;
		    padding: 4px;
		    font-size: 16px;
		    border: 1px solid green;
		    font-weight: bold;*/
		}
		
		.action{
			float: right;
    		margin-bottom: 10px;
		}
		.error{
			color: red;
		}
		.user-detail{
			background: #fff;
			padding-bottom:15px; 
		}
		.title-style-h4{
			border-bottom: 2px solid #388E3C;

		}
	</style>

</head>
<body>
	<?php
		if($message!=null || $message!=''){
	?>
	<div class="alert <?= $classValue?>  alert-dismissible fade show " role="alert" >
		<?= $message?>
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	</div>
	<?php } 
	if(empty($request_item_data['requestData']) || empty($request_item_data['requestItemData']) || empty($request_item_data))
	{
		echo "Recode not found !!";exit();
	}else{
		$userInfo=$request_item_data['requestData']['user_info'];
	}	
	?>
	<div class="row">
		<div class="col-md-12">
			<div class="strip">
				<div class="title-strip">
					<i class="fas fa-hand-holding"></i> 
					<a href="<?=base_url()?>index.php/Admin/AdminRequestController">Request</a> > <?= $request_item_data['requestData']['vRequestCode']?>
				</div>
			</div>
		</div>	
	</div>
	<div class="contant">
	
	<div class="row">
		<div class="col-md-12 action-group ">
			<div class="action">
				<?php
					if($request_item_data['requestData']['eStatus']=='Pending'){
				?>
				<button  data-target="#approve-Request" data-toggle="modal" class="btn btn-success">
					<i class="fas fa-check"></i>&nbsp;Approve
				</button>
				<a href="<?= base_url()?>index.php/Admin/AdminRequestController/changeProductRequestStatus?action=Cancel&role=Admin&RequestId=<?= $request_item_data['requestData']['iRequestId']?>" class="btn btn-danger ">
					<i class="fas fa-times"></i>&nbsp;Cancel
				</a>
				<?php }
					if($request_item_data['requestData']['eStatus']=='Approved'){
						?>
					<a href="<?= base_url()?>index.php/Admin/AdminRequestController/collectedProductRequest?action=Collect&pReqId=<?= $request_item_data['requestData']['iRequestId']?>" class="btn btn-success ">
						<i class="fas fa-check"></i>&nbsp;Collect
					</a>
						<?php
					}
				 ?>
			</div>
		</div>
	</div>

	<div class="contant-request">
		<div class="row">
			<div class="col-md-12">
				<!-- <div class="title-req-item">
					Request Information
				</div> -->
				
				<div class="row">
					<div class="col-md-3">
						<div class="label-data-title">Request Code</div>
						<span class="label-data-value"><?= $request_item_data['requestData']['vRequestCode']?></span>
					</div>
					<div class="col-md-3">
						<div class="label-data-title">Date of Request</div>
						<span class="label-data-value"><?= date("d/m/Y ",strtotime($request_item_data['requestData']['dtAddedDate']))?></span>
					</div>
					<div class="col-md-4">
						<div class="label-data-title">Address</div>
						<span class="label-data-value">
							<?= $request_item_data['requestData']['Address_info']['vAddressLine1']?><br>
							<?= $request_item_data['requestData']['Address_info']['vAddressLine2']?>-
							<?= $request_item_data['requestData']['Address_info']['iPincode']?>
						</span>
					</div>
					<div class="col-md-2">
						<div class="label-data-title">Status</div>
						<span class="label-data-value"><?= $request_item_data['requestData']['eStatus']?></span>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<div class="label-data-title">Agency Name</div>
						<span class="label-data-value text-capitalize"><?= $request_item_data['requestData']['agency_name']?></span>
					</div>
					<div class="col-md-3">
						<div class="label-data-title">User Name</div>
						<span class="label-data-value text-capitalize"><?= $request_item_data['requestData']['user_name']?></span>
					</div>
					<div class="col-md-3">
						<div class="label-data-title">Received  Date</div>
						<span class="label-data-value"><?= $request_item_data['requestData']['dateOfReceived']?></span>
					</div>
					<div class="col-md-3">
						<div class="label-data-title">Number Of Product</div>
						<span class="label-data-value"><?= $request_item_data['requestData']['total_product']?></span>
					</div>
					
				</div>
			</div>
		</div>
	</div>

	<div class="contant-request-item">
		<div class="title-req-item">
				Request Item Detail
		</div>

		<?php
			foreach ($request_item_data['requestItemData'] as $key => $value) {
				# code...
			
		?>
		<div class="request-item">	
			<div class="row">
				<div class="col-md-1">
					<img class="product-image" src="<?= base_url()?>assets/images/Admin/Product/<?= $value['product_info']['vImage']?>">
				</div>
				<div class="col-md-3">
					<div class="data-item-label-title">Request Item Code</div>
					<span class="data-item-label-value"><?= $value['vRequestItemCode'] ?></span>
				</div>
				<div class="col-md-2">
					<div class="data-item-label-title">Product</div>
					<span class="data-item-label-value"><?= $value['product_info']['vProductName'] ?></span>
				</div>
				<div class="col-md-2">
					<div class="data-item-label-title">Category</div>
					<span class="data-item-label-value"><?= $value['p_category_info']['vCategoryName'] ?></span>
				</div>
				<div class="col-md-2">
					<div class="data-item-label-title">Product Quantity</div>
					<span class="data-item-label-value">
						<?= $value['dQuantity']?>&nbsp;
						<?= $value['product_info']['vProductUnit'] ?>
					</span>
				</div>
				<div class="col-md-2">
					<div class="data-item-label-title">Received Quantity</div>
					<span class="data-item-label-value">
						<?= $value['receivedQuantityFormat']?>
					</span>
				</div>
			</div>
		</div>
		<?php }?>
		
	

	</div>
	<div class="row user-detail">
		<div class="col-md-12">
			<div class="title-req-item">
					Users Detail
			</div>
			<div class="row">	
				<div class="col-md-3">
					<h4 class="title-style-h4 ">Request By</h4>
					<div class="card " style="border-radius: 12px; border: 1px solid rgba(0,0,0,.1);">
                      <div class="card-header" style="border-bottom: none;">
                        <div class="row">
                          <i class="fas fa-user fa-4x"></i>
                          <span style="padding: 10px 0 0 30px;font-size: 25px;" class="text-capitalize">
                           <?= $userInfo['vName'];?>
                          </span>  
                        </div>
                      </div>

                      <div class="card-body">
                        
                        <div class="row">
                          <div class="col-md-1">
                            <i class="fas fa-envelope fa-1x"></i>
                          </div>
                          <div class="col-md-10 "><p class="lender-detail-text"><?= $userInfo['vEmail'] ?></p></div>
                        </div>

                        <div class="row">
                          <div class="col-md-1">
                            <i class="fas fa-address-book fa-1x" aria-hidden="true"></i>
                          </div>
                          <div class="col-md-10"><p class="lender-detail-text"><?= $userInfo['iMobileNo'] ?></p></div>
                        </div>
                      </div>
                    </div><!-- @card end -->
				</div>
				<?php
				if(!empty($request_item_data['agency_owner']))
				{
					$owner_info=$request_item_data['agency_owner'];
				?>
				<div class="col-md-3">
					<h4 class="title-style-h4 ">Accept  By</h4>
					<div class="card " style="border-radius: 12px; border: 1px solid rgba(0,0,0,.1);">
                      <div class="card-header" style="border-bottom: none;">
                        <div class="row">
                          <i class="fas fa-user-tie fa-4x"></i>
                          <span style="padding: 10px 0 0 30px;font-size: 25px;" class="text-capitalize">
                           <?= $owner_info['vName'];?>
                          </span>  
                        </div>
                      </div>

                      <div class="card-body">
                        
                        <div class="row">
                          <div class="col-md-1">
                            <i class="fas fa-envelope fa-1x"></i>
                          </div>
                          <div class="col-md-10 "><p class="lender-detail-text"><?= $owner_info['vEmail'] ?></p></div>
                        </div>

                        <div class="row">
                          <div class="col-md-1">
                            <i class="fas fa-address-book fa-1x" aria-hidden="true"></i>
                          </div>
                          <div class="col-md-10"><p class="lender-detail-text"><?= $owner_info['iMobileNo'] ?></p></div>
                        </div>
                      </div>
                    </div><!-- @card end -->
				</div>
				<?php } ?>
			</div>



		</div>
	</div>
	<span class="float-right" style="position: relative;bottom: 0px">*TBA: To Be Advised</span>
	</div>
<!-- <?php //require_once('footer.php');?>	 -->
	
	<!-- Modal of Approve/ Cancel Request of The Product -->
	<div class="modal fade" id="approve-Request" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Approve Product Request</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form method="post" action="<?= base_url()?>index.php/Admin/AdminRequestController/changeProductRequestStatus" id="frmApprove">
	        	<input type="hidden" name="hRequestId" value="<?= $request_item_data['requestData']['iRequestId']?>">
	        	<input type="hidden" name="action" value="Approved">
	        	<input type="hidden" name="role" value="Admin">
	        	<label for="sAgencyId" class="col-sm-4 col-form-label">Agency<em>*</em></label>
	        	<select name="sAgencyId" class="form-control input-lg" id="sAgencyId">
	        		<option value="">Select Agency</option>
	        		<?php
	        			foreach ($agency_info as $key => $value) {
	        			?>
	        			<option value="<?= $value['iAgencyId']?>"><?= $value['vAgencyName'] ?></option>
	        			<?php
	        			}
	        		?>
	        	</select>
	       
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <input type="submit" name="approve" value="Approve Request" type="button" class="btn btn-primary">
	    	</form>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- Modal of Approve/ Cancel Request of The Product @end-->

</body>
<script type="text/javascript">
	
	$(document).ready(function(){
		 $("#frmApprove").validate({
        rules:{
          "sAgencyId": {
          	required: true
          	}
      	},
  	    messages:{
	      "sAgencyId": {
	      	required: "Select Agency."
	      }
	  	}
	});
		});
</script>
</html>