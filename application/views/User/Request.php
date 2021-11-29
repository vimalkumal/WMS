<?php

	$pageName="Request";
	$message="";
	$classValue="alert-success";
	$reg_page=$this->session->flashdata('request_message');
	
	// var_dump($reg_page)
	if($this->session->flashdata('request_message')!=Null){
		$reg_page_array	=	explode("|", $this->session->flashdata('request_message'));
		$message 		=	$reg_page_array[0];
		$classValue		=	$reg_page_array[1];
	}
	// pr($request_data,1);
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>:: <?= $pageName?> ::</title>
	<link rel="shortcut icon" href="<?= base_url()?>/assets/logo/logo.png">

	<!-- CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<!--data tabde  css-->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">

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
	<!-- data table js -->
	<script src="https:////cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
		    $('#requestTable').DataTable({
		    	"order": [[ 0, "desc" ]]
		    });
		});
		
	</script>

	<?php require_once('headder.php');?>
	<style type="text/css">
		.contant{
			padding: 5px;
			padding-bottom: 20px;
			background-color: #fff;
		}
		.btn-place-order{
			margin: 5px;
		}
		.request_code_link > a{
			text-decoration: none;
		}
		.request_code_link > a:hover{
			color: #126815;
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
				<div class="title-strip"><i class="fas fa-hand-holding"></i> Request</div>
			</div>
		</div>	
	</div>
	<div class="contant">
		
		<div class="btn-place-order">
			<a href="<?=base_url()?>/index.php/User/RequestController/placeOrder" class="btn btn-success">
				<i class="fas fa-cart-plus"></i>&nbsp; Place Order
			</a>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h5 class="list-title">Request List</h5>
			</div>
		</div>
		<?php
			if(sizeof($request_data)<=0){

				echo "No Record Found !!";
				exit();
			}
		?>
		<table id="requestTable" class="display" style="width:100%">
	        <thead>
	            <tr>
	                <th>Request Code</th>
	                <th>Number of Product</th>
	                <th>Date of Request</th>
	                <th>Agency Name</th>
	                <th>Receved Date</th>
	                <th>Status</th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php
	        	foreach ($request_data as $key => $value){
	        		
	        	?>
	            <tr>
	            	<td class="request_code_link">
	            		<a href="<?=base_url()?>index.php/User/RequestController/requestDetailView?reqId=<?= $value['iRequestId']?>">
	            		<?= $value['vRequestCode'] ?>
	            		</a>
	            	</td>
	            	<td><?= $value['total_product'] ?></td>
	            	<td><?= date("d/m/Y",strtotime($value['dtAddedDate'])) ?></td>
	            	<td><?= $value['agency_name'] ?></td>
	            	<td><?= $value['dateOfReceived'] ?></td>
	            	<td><?= $value['eStatus'] ?></td>
	            </tr>
	        <?php } ?>
	            
	        </tbody>
	    </table>
	    <span class="float-right" style="position: relative;bottom: 0px">*TBA: To Be Advised</span>
	</div>
<!-- <?php //require_once('footer.php');?>	 -->
</body>

</html>