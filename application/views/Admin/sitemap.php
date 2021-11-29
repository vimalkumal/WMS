<?php
	$pageName="Dashboard";
	$subMenuSitemap="sitemap";
	$message="";
	$classValue="alert-warning";
	
	if($this->session->flashdata('sitemap_message')!=Null){

		$login_page_array	=	explode("|", $this->session->flashdata('sitemap_message'));
		$message 			=	$login_page_array[0]." ".ucfirst($this->session->userdata('user_name'));
		$classValue			=	$login_page_array[1];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>:: Sitemap ::</title>
	<link rel="shortcut icon" href="<?= base_url()?>assets/logo/logo.png">

	<!-- CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	
	<link rel="stylesheet" href="<?= base_url()?>assets/css/style.css" >
	<link rel="stylesheet" href="<?= base_url()?>assets/css/sitemap.css" >
	
	<link rel="stylesheet" href="<?= base_url()?>assets/css/Admin/admin_style.css" >
	<!-- JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
	<!-- for i-con view class -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<style type="text/css">
		
		
	</style>
	<?php
	require_once('HeaderAdmin.php');
	?>
</head>
<body>
	<?php
		if($message!=null || $message!=''){
	?>
	<div class="alert <?= $classValue?>  alert-dismissible fade show" role="alert">
		<?= $message?>
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	</div>
	<?php }?>
	<div class="row">
		<div class="col-md-12">
			<div class="strip">
				<div class="title-strip">
					<i class="fa fa-sitemap"></i> Sitemap</div>
			</div>
		</div>	
	</div>	
	<div class="body-contant">
		<div class="box-menu">
			<div  class="box-menu-title">
				<i class="fas fa-home"></i> Dashboard Menus
			</div>
			<div class="box-menu-list">
				<ul>
					<li class="box-menu-list-item">
						<i class="fa fa-sitemap"></i>
						<a href="<?= base_url()?>index.php/Admin/AdminController/sitemap">&nbsp;Sitmap</a>
					</li>

					<li class="box-menu-list-item">
						<i class="fas fa-home"></i>
						<a href="<?= base_url()?>index.php/Admin/AdminController">&nbsp;Dashboard</a>
					</li>
				</ul>
				
			</div>
		</div>
	</div>

	<div class="body-contant">
		<div class="box-menu">
			<div  class="box-menu-title">
				<i class="fas fa-user"></i> Users Menus
			</div>
			<div class="box-menu-list">
				<ul>
					<li class="box-menu-list-item"><i class="fas fa-user"></i>
						<a href="<?= base_url()?>index.php/Admin/UsersController">&nbsp;Users</a>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<div class="body-contant">
		<div class="box-menu">
			<div  class="box-menu-title">
				<i class="fas fa-industry"></i> Agencies Menus
			</div>
			<div class="box-menu-list">
				<ul>
					<li class="box-menu-list-item"><i class="fas fa-industry"></i><a href="<?= base_url()?>index.php/Admin/AgenciesController">&nbsp;Agencies </a></li>
					
				</ul>
				
			</div>
		</div>
	</div>
	<div class="body-contant">
		<div class="box-menu">
			<div  class="box-menu-title">
				<i class="fas fa-cubes"></i> Master Menus
			</div>
			<div class="box-menu-list">
				<ul>
					<li class="box-menu-list-item">
						<i class="fas fa-recycle"></i>
						<a href="<?=base_url()?>index.php/Admin/CategoryController">&nbsp;Category </a>
					</li>
					<li class="box-menu-list-item">
						<i class="fas fa-dumpster"></i>
						<a href="<?=base_url()?>index.php/Admin/ProductController">&nbsp;Product </a>
					</li>
					<li class="box-menu-list-item">
						<i class="fas fa-hand-holding"></i>
						<a href="<?=base_url()?>index.php/Admin/AdminRequestController">&nbsp;Request</a>
					</li>
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
					<li class="box-menu-list-item"><i class="fas fa-edit"></i><a href="<?= base_url()?>index.php/Admin/AdminProfileController">&nbsp;Edit Profile</a></li>
					<li class="box-menu-list-item"><i class="fas fa-sign-out-alt"></i><a href="<?= base_url()?>index.php/Logout">&nbsp;Logout</a></li>
				</ul>
				
			</div>
		</div>
	</div>
</body>
</html>