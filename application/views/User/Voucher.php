<?php
	$pageName="Wallet";
	$message="";
	$classValue="alert-warning";
	// var_dump($reg_page)
	if($this->session->flashdata('voucher_message')!=Null){

		$login_page_array	=	explode("|", $this->session->flashdata('voucher_message'));
		$message 			=	$login_page_array[0];
		$classValue			=	$login_page_array[1];
	}
	// pr($voucher_info,1);
?>
<!DOCTYPE html>
<html>
<head>
	<title>:: <?= $pageName  ?> ::</title>
	<link rel="shortcut icon" href="<?= base_url()?>assets/logo/logo.png">
	<!-- CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<!--data tabde  css-->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">

	<link rel="stylesheet" href="<?= base_url()?>assets/css/style.css" >
	<link rel="stylesheet" href="<?= base_url()?>assets/css/User/user_style.css" >
	<link rel="stylesheet" href="<?= base_url()?>assets/css/sitemap.css" >
	
	<!-- JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
	
	<!-- for i-con view class -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<!-- Ajax -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

	<?php
	require_once('headder.php');
	?>
	<style type="text/css">
		.contant{
			padding: 5px;
			background-color: #fff;
		}
		
		.totla-point-text {
		    font-size: 14px;
		    font-weight: bold;
		}
		.totla-point-value{
			font-size: 15px;
		}

		.voucher_image{
			width:
		}
		.voucher_image{
			width: 250px;
		    height: 125px;
		    border: 0px solid black;
		    padding: 2px;
		    margin: 3px;
		}
		.voucher-card{
			margin-bottom: 12px;
		}
		.strip{
			margin-bottom: 0px;
		}
		.button-box{
			display: inline-block;
		    font-weight: 400;
		    text-align: center;
		    vertical-align: middle;
		    -webkit-user-select: none;
		    -moz-user-select: none;
		    -ms-user-select: none;
		    user-select: none;
		    background-color: transparent;
		    border: 1px solid transparent;
		    padding: .375rem .75rem;
		    font-size: 1rem;
		    line-height: 1.5;
		    border-radius: .25rem;
		    color: red;
		    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
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
	
	?>

	<div class="row">
		<div class="col-md-12">
			<div class="strip">
				<div class="title-strip"><i class="fas fa-coins"></i> Redeem Rewarded
					<span class="float-right totla-point-text">Total Rewarded Point : <span class="totla-point-value"><?= $wallet_amount?></span></span>
				</div>

			</div>
			<span  class="float-right text-danger">*1000 Point = 100 Rs.</span>
		</div>	
	</div>	
	
	<div class="container">
		
		<div class="row">
			<?php
				foreach ($voucher_info as $key => $value) {
					
			?>
			<div class="col-md-3">
				<div class="card voucher-card">
					<div class="card-body text-center voucher-body">
						<img src="<?= base_url()?>assets/images/Voucher/<?= $value['vVoucherImage'] ?>" class="voucher_image">
						<h5><?= $value['vVoucherName']?></h5>
						<h6>Rs. <b><?= number_format($value['dVoucherPrice'],2)?></b></h6>
						<h6>Point to need : <u><?= number_format($value['needPoint'],2)?></u></h6>
						<?php
							if($wallet_amount >= $value['needPoint']){
						?>
						<form action="<?= base_url()?>index.php/User/UserWalletController/redeemVoucher" method="post">
							<input type="hidden" name="hVoucherId" value="<?= $value['iVoucherId']?>">
							<input type="submit" name="voucherRead" value="Redeem Me" class="btn btn-secondary" onclick="return confirm('Are you sure you redeem this voucher?')">
							<!-- <button class="btn btn-secondary">Redeem Me</button> -->
						</form>
						<?php }else{ ?>
							<span class="button-box">
								Cant' Redeem Me
							</span>
						<?php } ?>
					</div>
				</div>
			</div>
			<?php
				}
			?>
		</div>
	</div>

</body>

</html>