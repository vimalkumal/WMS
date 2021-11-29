<?php
	$pageName="Home";
	$message="";
	$classValue="alert-warning";
	// var_dump($reg_page)
	if($this->session->flashdata('login_message')!=Null){

		$login_page_array	=	explode("|", $this->session->flashdata('login_message'));
		$message 			=	$login_page_array[0]." ".ucfirst($this->session->userdata('user_name'));
		$classValue			=	$login_page_array[1];
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
	<link rel="stylesheet" href="<?= base_url()?>assets/css/sitemap.css" >
	
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
				<div class="title-strip"><i class="fas fa-home"></i> Home</div>
			</div>
		</div>	
	</div>	

	<div class="body-contant">
		<div class="box-menu">
			<div  class="box-menu-title">
				<i class="fas fa-home"></i> Home Menus
			</div>
			<div class="box-menu-list">
				<ul>
					<li class="box-menu-list-item"><i class="fas fa-home"></i><a href="<?= base_url()?>index.php/User/UserController">&nbsp;Home</a></li>
				</ul>
				
			</div>
		</div>
	</div>

	<div class="body-contant">
		<div class="box-menu">
			<div  class="box-menu-title">
				<i class="fas fa-map-marked-alt"></i> Address Menus
			</div>
			<div class="box-menu-list">
				<ul>
					<li class="box-menu-list-item"><i class="fas fa-map-marked-alt"></i><a href="<?= base_url()?>index.php/User/AddressController">&nbsp;Address</a></li>
				</ul>
				
			</div>
		</div>
	</div>

	<div class="body-contant">
		<div class="box-menu">
			<div  class="box-menu-title">
				<i class="fa fa-wallet"></i> Wallet Menus
			</div>
			<div class="box-menu-list">
				<ul>
					<li class="box-menu-list-item"><i class="fa fa-wallet"></i><a href="<?= base_url()?>index.php/User/UserWalletController">&nbsp;Wallet</a></li>
					<li class="box-menu-list-item"><i class="fas fa-coins"></i><a href="<?= base_url()?>/index.php/User/UserWalletController/redeemRewarded">&nbsp;Redeem Rewarded</a></li>
				</ul>
				
			</div>
		</div>
	</div>

	<div class="body-contant">
		<div class="box-menu">
			<div  class="box-menu-title">
				<i class="fas fa-hand-holding"></i> Request Menus
			</div>
			<div class="box-menu-list">
				<ul>
					<li class="box-menu-list-item"><i class="fas fa-hand-holding"></i><a href="<?= base_url()?>index.php/User/RequestController">&nbsp;Request</a></li>
					<li class="box-menu-list-item"><i class="fas fa-cart-plus"></i><a href="<?=base_url()?>/index.php/User/RequestController/placeOrder">&nbsp;Place Order</a></li>
				</ul>
				
			</div>
		</div>
	</div>

	<div class="body-contant">
		<div class="box-menu">
			<div  class="box-menu-title">
				<i class="fas fa-user"></i> Profile Menus
			</div>
			<div class="box-menu-list">
				<ul>
					<li class="box-menu-list-item"><i class="fas fa-edit"></i><a href="<?= base_url()?>index.php/User/UserProfileController">&nbsp;Edit Profile</a></li>
					<li class="box-menu-list-item"><i class="fas fa-sign-out-alt"></i><a href="<?= base_url()?>index.php/Logout">&nbsp;Logout</a></li>
				</ul>
				
			</div>
		</div>
	</div>


</body>

</html>