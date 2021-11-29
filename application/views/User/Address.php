<?php

	$pageName="Address";
	$message="";
	$classValue="alert-success";
	$reg_page=$this->session->flashdata('address_message');
	
	// var_dump($reg_page)
	if($this->session->flashdata('address_message')!=Null){
		$reg_page_array	=	explode("|", $this->session->flashdata('address_message'));
		$message 		=	$reg_page_array[0];
		if($message=="AddressMesssage"){
			$message_alt="Adrress Not Exist Plese Add Address First";
			echo "<script type='text/javascript' >alert('$message_alt');</script>";
			$message="";
		}
		$classValue		=	$reg_page_array[1];
	}

	// pr($address);
?>
<!DOCTYPE html>
<html>
<head>
	<title>:: <?= $pageName?> ::</title>
	<link rel="shortcut icon" href="<?= base_url()?>/assets/logo/logo.png">

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

	<!-- Ajax -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

	<?php require_once('headder.php');?>
	<style type="text/css">
		.contant{
			margin-left: 10px;

		}
		.card{
			border: 2px #388E3C solid;
			min-height: 200px;
		}
		
		.btn-add{
			margin-bottom: 8px;
		}
		.btn-action{
			margin-left: 5px;
		}
		.status-Inactive{
			color: red;
		}
		.status-Active{
			color: green;
		}
		footer{
	    position: fixed;}
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
				<div class="title-strip"><i class="fa fa-map-marked-alt"></i> Address</div>
			</div>
		</div>	
	</div>
	<div class="contant">
		
		<a class="btn btn-primary btn-add" href="<?= base_url()?>index.php/User/AddressController/addAddress">
			<i class="fa fa-plus"></i> Address
		</a>
		<div class="row">

			<?php
			if(empty($address)){
				// echo "Your Addess Data is not Available Please Add";
			?>
			<div class="col-12">
				<h6 class="text-center">No Records found !!</h6>
			</div>		
			<?php
				exit();
			}
			foreach ($address as $key => $value) {
				$address_info=$value;
			
			?>
			<div class="col-md-4">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
							</div>
						</div>
						<div class="row">
							<div class="col-md-2">
								<i class="fa fa-map-marked-alt fa-2x"></i>
							</div>
							<div class="col-md-10">
								<h6 style="font-weight: bold;" class="float-right status-<?= $address_info['eStatus']?>">
									<?= $address_info['eStatus'] ?>
										
								</h6>
								<h6 style="font-weight: bold;"><?= $address_info['vAddressTitle'] ?></h6>
								<div><?= $address_info['vAddressLine1'] ?></div>
								<div><?= $address_info['vAddressLine2']." - ".$address_info['iPincode'] ?></div>
								<div><?= $address_info['cityName'].' , '.$address_info['stateName'].' , '.$address_info['countryName']?></div>	
							</div>
							
						</div>
					</div>
				
					<div class="card-footer ">
						<a href="<?= base_url()?>index.php/User/AddressController/editAddress?addressId=<?= $address_info['iAddressId']?>" class="btn-success btn ">
                			<i class="fa fa-pen"></i>&nbsp;Edit
	                	</a>
	                	<a href="AddressController/unsetAddress?addressId=<?= $address_info['iAddressId']?>" class="btn-danger btn">
	                		<i class="fa fa-trash"></i>&nbsp;Delete
	                	</a>

						
					</div>
				</div>
			</div>
			<!-- col md-4 -->
		<?php } ?>
		</div>
	</div>
	

<!-- <?php //require_once('footer.php');?>	 -->
</body>

</html>