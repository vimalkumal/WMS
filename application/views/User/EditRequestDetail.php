<?php

	$pageName="Request";
	$message="";
	$classValue="alert-success";
	$reg_page=$this->session->flashdata('edit_request_message');
	
	// var_dump($reg_page)
	if($this->session->flashdata('edit_request_message')!=Null){
		$reg_page_array	=	explode("|", $this->session->flashdata('edit_request_message'));
		$message 		=	$reg_page_array[0];
		$classValue		=	$reg_page_array[1];
	}
	// pr($request_item_data,1);
	// pr("Edit Request Detail Page");
?>
<!DOCTYPE html>
<html>
<head>
	<title>:: <?= $pageName?> ::</title>
	<link rel="shortcut icon" href="<?= base_url()?>/assets/logo/logo.png">

	<!-- CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	
	<!--data tabde  css-->
	<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css"> -->

	<link rel="stylesheet" href="<?= base_url()?>assets/css/style.css" >
	<link rel="stylesheet" href="<?= base_url()?>assets/css/User/user_style.css" >

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
	<!-- <script src="https:////cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script> -->


	<?php require_once('headder.php');?>
	<style type="text/css">
		.title-strip > a{
			text-decoration: none;
		}
		.title-strip > a:hover{
			color: #388E3C;
		}
		.contant{
			padding: 5px;
			background-color: #fff;
		}
		.contant-request{
			padding: 4px;
			border: 1px solid black;
		}
		.contant-request-item{
			margin-top: 0px;
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
		}
		.action{
			float: right;
    		margin-bottom: 10px;
		}
		.error{
			color: red;
		}
	</style>

</head>
<body>
	<?php
		if($message!=null || $message!=''){
	?>
	<div class="alert <?= $classValue?>  alert-dismissible fade show" role="alert" >
		<?= $message?>
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	</div>
	<?php }
	if(empty($request_item_data['requestData']) || empty($request_item_data['requestItemData']) ){
		echo "Record does not match with your request.!!";exit();
	} 
	?>
	<div class="row">
		<div class="col-md-12">
			<div class="strip">
				<div class="title-strip">
					<i class="fas fa-hand-holding"></i> 
					Edit Request > <?= $request_item_data['requestData']['vRequestCode']?>
				</div>
			</div>
		</div>	
	</div>
	<div class="container contant">
	<form method="POST" action="<?=base_url()?>index.php/User/RequestController/updateOrderRequest" id="editRequest">
	<input type="hidden" name="hRequestId" value="<?=$request_item_data['requestData']['iRequestId']?>">

	<div class="row collection-site-data">
			<div class="col-md-12">
				<div class="row collection-title">
					<div class="col-md-12">
						<h5 class="title-req-item">Edit collection site</h5>		
					</div>
				</div>
				<!-- collection sites @start -->
				<div class="row custom-form1">
					<div class="col-3">
						Pick up address<em>*</em>
						<select name="sAddress" id="sAddress"  class="form-control input-lg">
							<option value="">Select Address</option>
							<?php
								foreach ($address_data as $key => $value) {
									// $idValue=isset($category_info)?$category_info[0]['iParentId']:'0';
									$selectedValue="";
									$selectedValue=$value['iAddressId']==$request_item_data['requestData']['iAddressId']?"selected='selected'":"";
									?>
									<option value="<?= $value['iAddressId'] ?>" <?= $selectedValue?>>
										<?= $value['vAddressTitle']?>
									</option>
									<?php
								}
							?>	
						</select>
					</div>
					<div class="col-2">
						Date Of Request
						<input type="text" 	class="form-control input-lg"  name="tOrderDate" id="tOrderDate" disabled="" value="<?= date("d/m/Y ")?>"> 
						<input type="hidden" name="hPlaceDate" value="<?= date("Y-m-d h:i:s")?>">
					</div>
				</div>
			<!-- collection sites @end -->			
			</div>
		</div>
		<hr>
	<div class="contant-request-item">
		<div class="title-req-item">
				Edit request item detail
		</div>
		<?php
			foreach ($request_item_data['requestItemData'] as $key => $value) {
			// pr($value);
		?>
		<div class="request-item">	
			<div class="row">
				<div class="col-md-1">
					<img class="product-image" src="<?= base_url()?>assets/images/Admin/Product/<?= $value['product_info']['vImage']?>">
				</div>
				<div class="col-md-2">
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
					<div class="data-item-label-title">Product Quantity<em>*</em></div>
					<div class="input-group">
						<input type="hidden" name="reqItemCode[<?=$value['iRequestItemId']?>]" value="<?=$value['vRequestItemCode']?>">
						<input type="hidden" name="productQtyType[<?=$value['iRequestItemId']?>]" value="<?=$value['product_info']['vProductUnit']?>">
						<input  class="form-control" type="text" placeholder="" name="reqItem[<?=$value['iRequestItemId']?>]" 	value="<?=$value['dQuantity']?>" required="">
						 <div class="input-group-append">
						    <span class="input-group-text" id="basic-addon2"><?= $value['product_info']['vProductUnit'] ?></span>
						  </div>
					</div>
					<label class="error" for="reqItem[<?=$value['iRequestItemId']?>]"></label>
				</div>
			</div>
		</div>
		<?php }?>

		<div class="form-group row">
			<div class="col-sm-12 text-center">
				<input 	type="submit" 	class="btn btn-success"  name="Update"   value="Submit" onclick=" return confirm('Are You Sure You Want Update Order Details?')" >
				<a class="btn btn-danger" href="<?=base_url()?>index.php/User/RequestController/requestDetailView?reqId=<?=$request_item_data['requestData']['iRequestId']?>">Discard</a>
			</div>
		</div>
		
	  </div>
	</form>
	</div>
<!-- <?php //require_once('footer.php');?>	 -->
	<script type="text/javascript">
		$.validator.addMethod(
		    "regex",
		    function(value, element, regexp) {
		        return this.optional(element) || regexp.test(value);
		    },
		    "Please check your input."
		);

		$(document).ready(function(){
			$("#editRequest").validate({
        	rules:{
        		"sAddress": {
		          	required: true
		        },
	        	"reqItem":{
	        			required:true,
	        			regex:/^[0-9]+$/
	        		}        		
        		},
        	message:{
	    		"sAddress":{
		          	required: "Select pick up address."
		        },
        		"reqItem":{
        			required:"Product Quantity is required.",
        			regex: "Enter only digit."
        		}
        	}

        	});
		});
	</script>
</body>

</html>