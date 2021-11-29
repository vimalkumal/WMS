<?php
	
	$pageName="Agency";
	$message="";
	$classValue="";
	// var_dump($reg_page)
	if($this->session->flashdata('login_message')!=Null){

		$login_page_array	=	explode("|", $this->session->flashdata('login_message'));
		$message 			=	$login_page_array[0]." ".ucfirst($this->session->userdata('user_name'));
		$classValue			=	$login_page_array[1];
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>:: <?= $pageName?> ::</title>
	<link rel="shortcut icon" href="<?= base_url()?>assets/logo/logo.png">
	<!-- CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	 <!-- for i-con view class -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<link rel="stylesheet" href="<?= base_url()?>assets/css/style.css" >
	<link rel="stylesheet" href="<?= base_url()?>assets/css/Admin/admin_style.css">
	<!-- JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

	<?php
		require_once('HeaderAdmin.php');
	?>
	<style type="text/css">
		.contant{
			margin: 5px;
		}
		.agency_img {
		    width: inherit;
		    height: 200px;
		    border: 1px solid;
    		padding: 2px;	
		}
		.title-label{
			margin-bottom: 1px; 
			margin-top: 5px; 
			font-size: 15px;

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
	<div class="alert <?= $classValue?>  alert-dismissible fade show" role="alert">
		<?= $message?>
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	</div>
	<?php }

	if(empty($agency_data)){
		echo "Recored not fount !!";exit();
	}
	else{
		$agency_data=$agency_data[0];}
		?>
	<div class="row">
		<div class="col-md-12">
			<div class="strip">
				<div class="title-strip"><i class="fas fa-industry"></i> Agency Detail</div>
			</div>
		</div>	
	</div>

	<div class="contant card agency-card">
		<div class="card-body">
			<div class="row">
				<div class="col-12">
					 <h4 class="title-style-h4 ">Agency Information</h4>
				</div>
			</div>
			<div class="row">
			
				<div class="col-md-4">
					<img src="<?= base_url()?>assets/images/Agency/AgencyImages/<?= $agency_data['vAgencyImage']?>" alt="No Image" class="agency_img">
				</div>
				<div class="col-md-8">
					<div class="row">
						<div class="col-md-4"><h5 class="title-label">Name</h5><?= $agency_data['vAgencyName']?></div>
						<div class="col-md-4"><h5 class="title-label">Code</h5><?= $agency_data['vAgencyCode']?></div>
						<div class="col-4"><h5 class="title-label">Status</h5><?= $agency_data['eStatus']?></div>
					</div>
					<div class="row">
						<div class="col-12"><h5 class="title-label">Registration Number</h5><?= $agency_data['vAgencyRegistrationNo']?></div>
						
					</div>
					<div class="row">
						<div class="col-md-6"><h5 class="title-label">Email</h5><?= $agency_data['vAgencyEmail']?></div>
						<div class="col-md-6"><h5 class="title-label">Phone No</h5><?= $agency_data['iPhoneNo']?></div>
					</div>	
				</div>

			</div>
			<hr>
			 <div class="row">

                  <div class="col-md-6">
                    <h4 class="title-style-h4">Agency Address</h4>
                    <div class="row">
                    	<div class="col-1">
                    		 <i class="fa fa-map-marked-alt fa-2x"></i>
                    	</div>
                    	<div class="col-11">
                    		<address style="line-height: 30px;">
		                      <?= $agency_data['vAddressLine1'] ?>,<br>
		                      <?= $agency_data['vAddressLine2'] ?>, <br>
		                      <?= $agency_data['city']['vCityName'] ?>  - <?= $agency_data['iPincode'] ?><br>
		                      <?= $agency_data['state']['vStateName'] ?>, <?= $agency_data['country']['vCountryName'] ?>,
		                     
		                    </address> 		
                    	</div>
                    </div>
                   
                    
                  </div>
                  <div class="col-md-5" style="padding: 5px 45px;">
                  	<h4 class="title-style-h4 ">Agency Owner</h4>
                    
                    <div class="card " style="border-radius: 12px; border: 1px solid rgba(0,0,0,.1);">
                      <div class="card-header" style="border-bottom: none;">
                        <div class="row">
                          <i class="fas fa-user-tie fa-4x"></i>
                          <span style="padding: 10px 0 0 30px;font-size: 25px;">
                           <?= $agency_data['user']['vName'] ?><!-- <h6><small> Premium User </small></h6> -->
                          </span>  
                        </div>
                      </div>

                      <div class="card-body">
                        
                        <div class="row">
                          <div class="col-md-2">
                            <i class="fas fa-envelope fa-1x"></i>
                          </div>
                          <div class="col-md-10 "><p class="lender-detail-text"><?= $agency_data['user']['vEmail'] ?></p></div>
                        </div>

                        <div class="row">
                          <div class="col-md-2">
                            <i class="fas fa-address-book fa-1x" aria-hidden="true"></i>
                          </div>
                          <div class="col-md-10"><p class="lender-detail-text"><?= $agency_data['user']['iMobileNo'] ?></p></div>
                        </div>


                      </div>
                    </div><!-- @card end -->
                  </div>

                </div>


		</div>

	
	</div>

</body>
</html>