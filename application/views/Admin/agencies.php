<?php
	$pageName="Agency";
	$message="";
	$classValue="alert-warning";
	
	if($this->session->flashdata('users_message')!=Null){

		$login_page_array	=	explode("|", $this->session->flashdata('users_message'));
		$message 			=	$login_page_array[0]." ".ucfirst($this->session->userdata('user_name'));
		$classValue			=	$login_page_array[1];
	}
	// pr($agencies);
?>
<!DOCTYPE html>
<html>
<head>
	<title><?= $pageName?></title>
	<link rel="shortcut icon" href="<?= base_url()?>/assets/logo/logo.png">

	<!-- CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

	<!--data tabde  css-->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">

	<!-- for i-con view class -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

	<!-- for i-con view class -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

	<link rel="stylesheet" href="<?= base_url()?>assets/css/style.css" >
	<link rel="stylesheet" href="<?= base_url()?>assets/css/Admin/admin_style.css">
	
	<!-- JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>


	<!-- data table js -->
	<script src="https:////cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
	<!-- internal JS -->
	<script type="text/javascript">
		$(document).ready(function() {
		    $('#agencies_data').DataTable();
	
		});
	</script>

	<style type="text/css">
		#agency_link > a{
			text-decoration: none;
		}
		#agency_link > a:hover{
			color: #388E3C;
		}
	</style>
	
	<?php
		require_once('HeaderAdmin.php');
	?>
	<link rel="stylesheet" href="<?= base_url()?>assets/css/Admin/users_style.css">
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
	
	?>
	<div class="row">
		<div class="col-md-12">
			<div class="strip">
				<div class="title-strip"><i class="fas fa-industry"></i>Agencies</div>
			</div>
		</div>	
	</div>
	<div class="row card">
		<div class="col-12 card-body">
			<table id="agencies_data" class="display" style="width:100%">
	        <thead>
	            <tr>
	            	<th></th>
	                <th>Agency Name</th>
	                <th>Agency Code</th>
	                <th>Agency Email</th>
	                <th>Owner Name</th>
	                <th>Added Date</th>
	                <th>Status</th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php
	        	foreach ($agencies as $key => $value) {
	        		# code...
	        	
	        	?>
	            <tr>
	                <td><i class="fas fa-industry"></i></td>
	                <td class="text-capitalize" id="agency_link">
	   
	  				<a href="<?= base_url()?>index.php/Admin/AgenciesController/getAgencyData?agencyId=<?= $agencies[$key]['iAgencyId']?>">  	
	                	<?= $agencies[$key]['vAgencyName']?></td>
	                </a> 
	                <td class="text-uppercase"><?= $agencies[$key]['vAgencyCode']?></td>
	                <td ><?= $agencies[$key]['vAgencyEmail']?></td>
	                <td class="text-capitalize"><?= $agencies[$key]['vOwnerName']?></td>
	                <td><?= date_format(date_create($agencies[$key]['dAddedDate']),"d/m/Y")?></td>
	                <td><?= $agencies[$key]['eStatus']?></td>
	            </tr>
	            <?php
	        	}?>
	        </tbody>
	    </table>
		</div>
	</div>
	
	


</body>
</html>