	<!-- <div class="alert <?= $classValue?>  alert-dismissible fade show" role="alert" >
		<?= $message?>
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	</div> -->
	<style type="text/css">
		.headerUserImage{
			display: table;
			width: 50px !important;
			height: 40px !important;
			border: 1px solid;
			border-radius: 50%;
			margin: auto;
		}
		.dropdown-item.active, .dropdown-item:active {
		color: #fff;
		text-decoration: none;
		background-color: #81c784;
		}
	</style>
	<?php
		$isHomeActive="";
		$isAgencyActive="";
		$isRequestActive="";
		if(!is_null($pageName) || $pageName=''){
			switch ($pageName) {
				case 'home':
					$isHomeActive='active';
					break;
				case 'Agency':
					$isAgencyActive='active';
					break;
				case 'Agency Request':
					$isRequestActive='active';
					break;
			}
		}
		
	?>
	<link rel="stylesheet" href="<?= base_url()?>assets/css/Admin/header_style.css" >
	<style type="text/css">
		.alert{
			z-index: 100;
		}
		.dropdown-menu{
			z-index: 1000;
		}
	</style>
	<nav class="navbar header-nav navbar-expand-lg">
	  <a class="navbar-brand" href="#">
	    <img src="<?= base_url()?>assets/logo/logo.png" width="50px" height="50px" alt="">
	  </a>

	  <div class="collapse navbar-collapse" id="navbarText">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item text-center menu-li <?= $isHomeActive?>">
	      	<a class="nav-link" href="<?= base_url()?>index.php/Agency/AgencyController">
	      		<i class="fas fa-home fa-2x menu-icon"></i>
	        	<span class="menu-item">Home</span>
	        </a>
	      </li>
	      <li class="nav-item text-center menu-li <?= $isAgencyActive?>">
	      	<a class="nav-link" href="<?= base_url()?>index.php/Agency/AgencyDetailController">
	      		<i class="fas fa-industry fa-2x menu-icon"></i>
	        	<span class="menu-item">Agency</span>
	        </a>
	      </li>
	       <li class="nav-item text-center menu-li <?= $isRequestActive?>">
	      	<a class="nav-link" href="<?= base_url()?>index.php/Agency/AgencyRequestController">
	      		<i class="fas fa-hand-holding fa-2x menu-icon"></i>
	        	<span class="menu-item">Request</span>
	        </a>
	      </li>
	    </ul>

	    <div class="nav-item dropdown">
	       <a class=" dropdown-toggle text-center user-link" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" a-expanded="false">
	         	<!-- <i class="fa fa-user-circle fa-2x menu-icon"></i> -->
	         	<img src="<?= base_url()?>assets/images/UserProfileImages/<?= $this->session->userdata('user_image')?>" class="headerUserImage">
	    		<span class="user-profile text-capitalize"><?= $this->session->userdata('user_name');?> </span>
		    </a>
		    <!-- ------------ ---------- profile Dropdown ------------ ------------>
		     <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="left: -60px;">
	           <a class="dropdown-item <?= isset($subMenuProfile)?"active":""?>" href="<?= base_url()?>index.php/Agency/AgencyProfileController">
	             <i class="fas fa-edit "></i>
	              Profile
	           </a>
	           <a class="dropdown-item" href="<?= base_url()?>index.php/Logout">
	             <i class="fas fa-sign-out-alt"></i>
	             Logout
	           </a>
	         </div>
	         <!-- ------------------- ------------ ---------- ----------- ------------ -->
     	</div>


     	
     	<!-- ------------ ---------- Master Dropdown ------------ ------------>

     	<!-- <div class="dropdown-menu" aria-labelledby="navbarDropdownMasterLink" style="left: -60px;">
           <a class="dropdown-item " href="index.php/Admin/AdminProfileController">
             <i class="fas fa-edit "></i>
              Profile
           </a>
           <a class="dropdown-item" href="#AdminLogout.php">
             <i class="fas fa-sign-out-alt"></i>
             Logout
           </a>
        </div> -->

     	
     	
	    <!-- <a class="text-center user-link" href="" >
			<i class="fa fa-user-circle fa-2x menu-icon"></i>
	    	<span class="user-profile text-capitalize">first name </span>
	    </a> -->
	  </div>
	</nav>
	
	<footer style="margin-top: 15px">
		<div class="custom-footer">
			Waste Management System
		</div>
	</footer>
