<?php
	$pageName="Wallet";
	$message="";
	$classValue="alert-warning";
	// var_dump($reg_page)
	if($this->session->flashdata('wallet_message')!=Null){

		$login_page_array	=	explode("|", $this->session->flashdata('wallet_message'));
		$message 			=	$login_page_array[0];
		$classValue			=	$login_page_array[1];
	}
	// pr($wallet_transection,1);
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
	<!-- data table js -->
	<script src="https:////cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
		    $('#rewaredTable').DataTable({
		    	 "order": [[ 0, "desc" ]],
		    	"columnDefs": [
	            {
	                "targets": [ 0 ],
	                "visible": false,
	                "searchable": false
	            }]
		    });
		});
	</script>
	<?php
	require_once('headder.php');
	?>
	<style type="text/css">
		.contant{
			padding: 5px;
			background-color: #fff;
		}
		.list-title {
		    font-size: 20px;
		    display: inline-block;
		    border-bottom: 3px #81C784 solid;
		    padding-left: 5px;
		    padding-right: 5px;
		    margin-left: 5px;
		    margin-top: 10px;
		    margin-bottom: 15px;
		    font-weight: bold;
		}
		.totla-point-text {
		    font-size: 14px;
		    font-weight: bold;
		}
		.totla-point-value{
			font-size: 15px;
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
				<div class="title-strip"><i class="fas fa-wallet"></i> Wallet
					<span class="float-right totla-point-text">Total Rewarded Point : <span class="totla-point-value"><?= $wallet_amount?></span></span>
				</div>

			</div>
		</div>	
	</div>	

	<div class="contant">
		<?php
			if(empty($wallet_transection)){
				echo "Reward recored not found";exit();
			}
			else{
				// krsort($wallet_transection);
			}
		?>
		<div class="row">
			<div class="col-md-12">
				<h5 class="list-title">Rewarded List</h5>
				<a href="<?= base_url()?>/index.php/User/UserWalletController/redeemRewarded" class="btn-success btn float-right"><i class="fas fa-coins"></i>&nbsp;Redeem Rewarded</a>
			</div>
		</div>
		<table id="rewaredTable" class="display" style="width:100%">
	        <thead>
	            <tr>
	            	<th></th>
	                <th>Date</th>
	                <th>Description</th>
	                <th>Balance</th>
	                <th>Credit</th>
	                <th>Debit</th>
	                <!-- <th>Status</th> -->
	            </tr>
	        </thead>
	        <tbody>
	        	<?php
	        		foreach ($wallet_transection as $key => $value) {
	        			# code...
	        		
	        	?>
	        	<tr>
	        		<td><?= $value['iWalletTransactionId'] ?></td>
	        		<td><?= date("Y/m/d",strtotime($value['dAddedDate']))  ?></td>
	        		<td><?= $value['Description'] ?></td>
	        		<td><?= $value['Balance'] ?></td>
	        		<td><?= $value['Credit'] ?></td>
	        		<td><?= $value['Debit'] ?></td>
	        	</tr>
	        	<?php
	        	
	        		}
	        	?>
	        </tbody>
	    </table>
	</div>

</body>

</html>