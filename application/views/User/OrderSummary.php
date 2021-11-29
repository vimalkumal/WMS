<?php
	$pageName="Product Summary";
	$message="";
	$classValue="alert-warning";
	// var_dump($reg_page)
	if($this->session->flashdata('order_summary_message')!=Null){

		$summary_page_array	=	explode("|", $this->session->flashdata('order_summary_message'));
		$message 			=	$summary_page_array[0];
		$classValue			=	$summary_page_array[1];
	}
	// pr($product);
?>
<!DOCTYPE html>
<html>
<head>
	<title>:: <?= $pageName  ?> ::</title>
	<link rel="shortcut icon" href="<?= base_url()?>assets/logo/logo.png">
	<!-- CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

	<link rel="stylesheet" href="<?= base_url()?>assets/css/style.css" >
	<link rel="stylesheet" href="<?= base_url()?>assets/css/User/user_style.css" >
	
	<!-- JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
	
	<!-- for i-con view class -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">



	<?php
	require_once('headder.php');
	?>
	<style type="text/css">
		.body-contant{
			background-color: #fff;
			margin: 2px;
			padding-top: 15px;
			
			
		}
		.list-title {
		    font-size: 20px;
		    display: inline-block;
		    border-bottom: 3px #81C784 solid;
		    padding-left: 5px;
		    padding-right: 5px;
		    margin-left: 5px;
		    font-weight: bold;
		}
		.productList{
			padding: 2px 10px;
		}
		.product-image{
			width: 80px;
			height: 80px;
			margin: 2px;
			padding: 2px;
			border:1px black solid;
			float: left;
		}
		.product-list-item{
			padding-left: 2px;
			padding-top: 5px;
			padding-bottom: 15px;
			border-bottom: 2px solid #2E7D32;
		}
		.product-val
		{
			font-size: 23px;
		    font-weight: 75%;
		    margin: 0px;
		    padding: 0px;}
	    .form-btn{
	    	margin-right: 10px;
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
	<?php } ?>

	<div class="row">
		<div class="col-md-12">
			<div class="strip">
				<div class="title-strip"><i class="fas fa-table"></i> Product Summary</div>
			</div>
		</div>	
	</div>	

	<div class="body-contant">
		<div class="row">
			<div class="col-md-12">
				<h5 class="list-title">Address</h5>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<h5 class="list-title">Order Summary List</h5>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
			<form method="post" action="">
			<div class="productList" id="productList">
			
				<div class="row product-list-item">

					<input type="hidden" name=""	value="">
					<input type="hidden" name="" value="">
					<div class="col-3">
						<img class="product-image" src="<?= base_url()?>assets/images/Admin/Product/82a8c7ea0bafb755d12c2029661edf7e.jpg">
						<div class="text-capitalize product-val">
							kitchen waste
						</div>
						<div class="text-capitalize product-cat-val">
							Biodegradable
						</div>
					</div>
					
					<div class="col-2">
						Product Quantity
						<div>15Kg</div>
					</div>
					<div class="col-2">
						Date<div>
						17/03/2021</div>
						<input type="hidden" name="" value="<?= date("Y/m/d")?>">
					</div>
				</div>
			
			</div>
			<div class="row form-btn">
				<div class="col-12">
					<input class="btn btn-primary float-right" type="submit" name="requestSubmit" value="Place">
				</div>
			</div>
			</form>
			</div>
		</div>
	</div>
</body>
</html>