<?php

	$pageName="Master";
	$subMenuRequest="Request"; 
	$message="";
	$classValue="alert-success";
	$reg_page=$this->session->flashdata('collect_request_message');
	
	// var_dump($reg_page)
	if($this->session->flashdata('collect_request_message')!=Null){
		$reg_page_array	=	explode("|", $this->session->flashdata('collect_request_message'));
		$message 		=	$reg_page_array[0];
		$classValue		=	$reg_page_array[1];
	}
	// pr("view");
	// pr($request_item_data,1);
	// pr("Edit Request Detail Page");
?>
<!DOCTYPE html>
<html>
<head>
	<title>:: Request Collect ::</title>
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
	<!-- data table js -->
	<script src="https:////cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

	<script type="text/javascript">
		// $(document).ready(function() {
		//     $('#requestTable').DataTable();
		// });
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
			/*background-color: #fff;*/
		}
		.contant-request{
			padding: 4px;
			border: 1px solid black;
		}
		.contant-request-item{
			padding-top: 5px;
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

		.contant-request-authonticat {
		background: #fff;
		padding: 1px;
		}
		.valid-value{
			font-size: 18px;
		}
		.valid-title{
			font-size: 16px;
			font-weight: bold;
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
					Collect > <?= $request_item_data['requestData']['vRequestCode']?>
				</div>
			</div>
		</div>	
	</div>
	<div class="contant">
	<div class="contant-request-authonticat">
		<div class="title-req-item">
				Collect Request Authontication
		</div>
		<div class="row">
			<div class="col-md-4">
				<span  class="valid-title"> Product Collection PIN: </span>
				<span class="valid-value"><?= $request_item_data['requestData']['vServiceCollection']?></span>
			</div>
		</div>
		
	</div>
	<div class="contant-request-item">
		<div class="title-req-item">
				Collect Request Item Detail
		</div>
		<form method="POST" action="<?=base_url()?>index.php/Admin/AdminRequestController/setCollectedProductRequestData">
			<input type="hidden" name="hRequestId" value="<?=$request_item_data['requestData']['iRequestId']?>">
			<input type="hidden" name="hRequestById" value="<?=$request_item_data['requestData']['iAddedBy']?>">
			<input type="hidden" name="hRequestForId" value="<?=$request_item_data['requestData']['iForeID']?>">
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

					<input 	type="hidden" 
							name="hProductId[<?=$value['iRequestItemId']?>]"
							value="<?=$value['product_info']['iProductId']?>">

					<input 	type="hidden" 
							name="hRewardPoint[<?=$value['iRequestItemId']?>]"
							value="<?=$value['product_info']['iRewardPoints']?>">

					<span class="data-item-label-value"><?= $value['product_info']['vProductName'] ?></span>
				</div>
				<div class="col-md-2">
					<div class="data-item-label-title">Category</div>
					<span class="data-item-label-value"><?= $value['p_category_info']['vCategoryName'] ?></span>
				</div>
				<div class="col-md-2">
					<div class="data-item-label-title">Product Ordered Quantity</div>
					<span class="data-item-label-value" id="basic-addon2">
						<?= $value['dQuantity']?>		
						&nbsp;<?= $value['product_info']['vProductUnit'] ?>		
					</span>
				</div>
				<div class="col-md-2">
					<div class="data-item-label-title">Product Received Quantity<em>*</em>	</div>
					<div class="input-group">
						<input 	type="hidden" 
								name="reqItemCode[<?=$value['iRequestItemId']?>]" 
								value="<?=$value['vRequestItemCode']?>">

						<input  class="form-control" type="text" placeholder="" 
								name="p_received_qty[<?=$value['iRequestItemId']?>]" required="">

						<div class="input-group-append">
						    <span class="input-group-text" id="basic-addon2"><?= $value['product_info']['vProductUnit'] ?>
						    	<input type="hidden" name="hProductQtyType[<?= $value['iRequestItemId']?>]" value="<?= $value['product_info']['vProductUnit']?>">
						    </span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php }?>

		<div class="form-group row">
			<div class="col-sm-12 text-center">
				<input 	type="submit" 	class="btn btn-success"  name="collect"   value="Submit" onclick=" return confirm('Are You Sure You Collected Product ?')">
				<a class="btn btn-danger" href="<?=base_url()?>index.php/Agency/AgencyRequestController/requestDetailPage?reqId=<?=$request_item_data['requestData']['iRequestId']?>">Discard</a>
			</div>
		</div>
		</form>
	</div>
	</div>
<!-- <?php //require_once('footer.php');?>	 -->
</body>

</html>