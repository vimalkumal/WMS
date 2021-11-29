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
		$isDashboardActive="";
		$isMasterActive="";
		$isAddressActive="";
		$isUserActive="";
		$isAgencyActive="";


		// $isSubDashboardActive="";
		// $isSubSitemapActive="";
		// $isSubCategoryActive="";
		// $isSubProductActive="";
		// $isSubRequestActive="";
		// $isSubProfileActive="";

		if(!is_null($pageName) || $pageName=''){
			switch ($pageName) {
				case 'Dashboard':
					$isDashboardActive='active';
					break;
				case 'Master':
					$isMasterActive='active';
					break;
				case 'Wallet':
					$isWalletActive='active';
					break;
				case 'Users':
					$isUserActive='active';
					break;
				case 'Agency':
					$isAgencyActive='active';
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
	      
	     <li class="nav-item text-center menu-li <?= $isDashboardActive?> dropdown">
	      	<a class="nav-link dropdown-toggle" href="#" id="navbarSitemapLink" data-toggle="dropdown">

	        	<i class="fas fa-tachometer-alt fa-2x menu-icon"></i>
	        	<span class="menu-item">Dashboard</span>
	        </a>
	        <!-- ------------ ---------- Site Dropdown ------------ ------------>
		     <div class="dropdown-menu" aria-labelledby="navbarSitemapLink" >
	           <a class="dropdown-item <?= isset($subMenuSitemap)?"active":""?>" href="<?= base_url()?>index.php/Admin/AdminController/sitemap">
	            <i class="fa fa-sitemap"></i>
	              Sitmap
	           </a>
	           <a class="dropdown-item <?= isset($subMenuDashboard)?"active":""?>" href="<?= base_url()?>index.php/Admin/AdminController">
	             <i class="fas fa-tachometer-alt"></i>
	             Dashboard
	           </a>
	         </div>
	      </li>

	      <li class="nav-item text-center menu-li <?= $isUserActive?>">
	      	<a class="nav-link" href="<?= base_url()?>index.php/Admin/UsersController">
	      		<i class="fas fa-user fa-2x menu-icon"></i>
	        	
	        	<span class="menu-item">Users</span>
	        </a>
	      </li>
	        <li class="nav-item text-center menu-li <?= $isAgencyActive?>">
	      	<a class="nav-link" href="<?= base_url()?>index.php/Admin/AgenciesController">
	      		<i class="fas fa-industry fa-2x menu-icon"></i>
	        	<span class="menu-item">Agencies</span>
	        </a>
	      </li>

	      <li class="nav-item text-center menu-li <?= $isMasterActive?> dropdown">
	      	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMasterLink" data-toggle="dropdown">

	        	<i class="fas  fa-cubes fa-2x menu-icon"></i>
	        	<span class="menu-item">Master</span>
	        </a>
	        <!-- ------------ ---------- Master Dropdown ------------ ------------>
		     <div class="dropdown-menu" aria-labelledby="navbarDropdownMasterLink" >
	           <a class="dropdown-item <?= isset($subMenuCategory)?"active":""?>" href="<?=base_url()?>index.php/Admin/CategoryController">
	            <i class="fas fa-recycle"></i>
	              Category
	           </a>
	           <a class="dropdown-item <?= isset($subMenuProduct)?"active":""?>" href="<?= base_url()?>index.php/Admin/ProductController">
	             <i class="fas fa-dumpster"></i>

	             Product
	           </a>
	           <a class="dropdown-item <?= isset($subMenuRequest)?"active":""?>" href="<?= base_url()?>index.php/Admin/AdminRequestController">
	             <i class="fas fa-hand-holding"></i>
	             Request
	           </a>
	         </div>
	      </li>
	      
	    </ul>

	    <div class="nav-item dropdown">
	       <a class=" dropdown-toggle text-center user-link" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" a-expanded="false">
	       		<img src="<?= base_url()?>assets/images/UserProfileImages/<?= $this->session->userdata('user_image')?>" class="headerUserImage">
	         	<!-- <i class="fa fa-user-circle fa-2x menu-icon"></i> -->
	    		<span class="user-profile text-capitalize"><?= $this->session->userdata('user_name');?> </span>
		    </a>
		    <!-- ------------ ---------- profile Dropdown ------------ ------------>
		     <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="left: -60px;">
	           <a class="dropdown-item <?= isset($subMenuProfile)?"active":""?>" href="<?= base_url()?>index.php/Admin/AdminProfileController">
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
