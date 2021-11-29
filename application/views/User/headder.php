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
		$isWalletActive="";
		$isAddressActive="";
		$isRequestActive="";
		if(!is_null($pageName) || $pageName=''){
			switch ($pageName) {
				case 'Home':
					$isHomeActive='active';
					break;
				case 'Address':
					$isAddressActive='active';
					break;
				case 'Wallet':
					$isWalletActive='active';
					break;
				case 'Request':
					$isRequestActive='active';
					break;
			}
		}
		
	?>
	<link rel="stylesheet" href="<?= base_url()?>assets/css/User/header_style.css" >
	<nav class="navbar header-nav navbar-expand-lg">
	  <a class="navbar-brand" href="#">
	    <img src="<?= base_url()?>assets/logo/logo.png" width="50px" height="50px" alt="">
	  </a>

	  <div class="collapse navbar-collapse" id="navbarText">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item text-center menu-li <?= $isHomeActive?>">
	      	<a class="nav-link" href="<?= base_url()?>index.php/User/UserController">
	        	<i class="fa fa-home fa-2x menu-icon"></i>
	        	<span class="menu-item">Home</span>
	        </a>
	      </li>
	       <li class="nav-item text-center menu-li <?= $isAddressActive?>">
	      	<a class="nav-link" href="<?= base_url()?>index.php/User/AddressController">
	      		<i class="fa fa-map-marked-alt fa-2x menu-icon"></i>
				
	        	<span class="menu-item">Address</span>
	        </a>
	      </li>
	      <li class="nav-item text-center menu-li <?= $isWalletActive?> ">
	      	<a class="nav-link" href="<?= base_url()?>index.php/User/UserWalletController">
	        	<i class="fa fa-wallet fa-2x menu-icon"></i>
	        	<span class="menu-item">Wallet</span>
	        </a>
	      </li>
	      <li class="nav-item text-center menu-li <?= $isRequestActive?> ">
	      	<a class="nav-link" href="<?= base_url()?>index.php/User/RequestController">
	      		<!-- <i class="fas fa-hand-holding"></i> -->
	        	<i class="fas fa-hand-holding fa-2x menu-icon"></i>
	        	<span class="menu-item">Request</span>
	        </a>
	      </li>
	     
	      
	    </ul>
	 
	    <div class="nav-item dropdown">
	       <a class=" dropdown-toggle text-center user-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" a-expanded="false">
	         	<img src="<?= base_url()?>assets/images/UserProfileImages/<?= $this->session->userdata('user_image')?>" class="headerUserImage">
	    		<span class="user-profile text-capitalize"><?= $this->session->userdata('user_name');?> </span>
		    </a>
	        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="left: -60px;">
	           <a class="dropdown-item <?= isset($subMenuProfile)?"active":""?>" href="<?= base_url()?>index.php/User/UserProfileController">
	             <i class="fas fa-edit "></i>
	              Profile
	           </a>
	           <a class="dropdown-item" href="<?= base_url()?>index.php/Logout">
	             <i class="fas fa-sign-out-alt"></i>
	             Logout
	           </a>
	         </div>
     	</div>
	    <!-- <a class="text-center user-link" href="" >
			<i class="fa fa-user-circle fa-2x menu-icon"></i>
	    	<span class="user-profile text-capitalize">first name </span>
	    </a> -->
	  </div>
	</nav>

	<!-- <div class="set-space"></div> -->
	<footer style="margin-top: 15px">

		<div class="custom-footer">
			Waste Management System
		</div>
	</footer>
