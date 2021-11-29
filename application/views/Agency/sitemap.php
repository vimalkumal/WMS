<?php
	$pageName="home";
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
	<title>:: Sitemap ::</title>
	<link rel="shortcut icon" href="<?= base_url()?>assets/logo/logo.png">
	<!-- CSS -->
	<!-- data tabel -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	 <!-- for i-con view class -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<link rel="stylesheet" href="<?= base_url()?>assets/css/style.css" >
	<link rel="stylesheet" href="<?= base_url()?>assets/css/agency/agency_style.css" >
	<link rel="stylesheet" href="<?= base_url()?>assets/css/sitemap.css" >
	
	<!-- JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
	
	<!-- data tabel -->
	<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
	
	<style type="text/css">
		td.dataTables_empty{
		    height: 200px;
		}
		.request_code_link > a{
			text-decoration: none;
		}
		.request_code_link > a:hover{
			color: #126815;
		}
		.col-md-6.small-table-info {
		    margin: 3px;
		    max-width: 49%;
		    color: #000;
		    padding: 0px;
		}
		/*css of the table content */
		.dataTables_wrapper,.dataTables_scrollHead,.dataTables_scrollHeadInner{
   			width: 100%;
		}
		#request_approved_info {
		{
			padding-top: 0px;
		}
	</style>
	
	<script type="text/javascript">
		$(document).ready(function(){
		    $('#request_pending').DataTable( {
		    	"order": [[ 0, "desc" ]],
		        "scrollY":        "200px",
		        "scrollCollapse": true,
		        "paging":         false,
		        "searching": 	  false,
		        "numbering": 	 false
		    });
		});
		
		$(document).ready(function() {
		    $('#request_approved').DataTable( {
		    	"order": [[ 0, "desc" ]],
		        "scrollY":        "200px",
		        "scrollCollapse": true,
		        "paging":         false,
		        "searching": 	  false,
		        "numbering": 	 false
		    });
		});

	</script>
	<?php
	require_once('HeaderAgency.php');
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
	<?php } ?>
	
	<div class="row">
		<div class="col-md-12">
			<div class="strip">
				<div class="title-strip"><i class="fas fa-home"></i> Home</div>
			</div>
		</div>	
	</div>	
	<div class="row">
	<div class="col-md-12">
		<div class="body-contant">
			<div class="box-menu">
				<div  class="box-menu-title">
					<i class="fas fa-home"></i> Home Menus
				</div>
				<div class="box-menu-list">
					<ul>
						<li class="box-menu-list-item"><i class="fas fa-home"></i><a href="<?= base_url()?>index.php/Agency/AgencyController">&nbsp;Sitemap</a></li>
					</ul>
					
				</div>
			</div>
		</div>

		<div class="body-contant">
			<div class="box-menu">
				<div  class="box-menu-title">
					<i class="fas fa-industry"></i> Agency Menus
				</div>
				<div class="box-menu-list">
					<ul>
						<li class="box-menu-list-item"><i class="fas fa-industry"></i><a href="<?= base_url()?>index.php/Agency/AgencyDetailController">&nbsp;Agency</a></li>
					</ul>
					
				</div>
			</div>
		</div>

		<div class="body-contant">
			<div class="box-menu">
				<div  class="box-menu-title">
					<i class="fas fa-hand-holding"></i> Request Menus
				</div>
				<div class="box-menu-list">
					<ul>
						<li class="box-menu-list-item"><i class="fas fa-hand-holding"></i><a href="<?= base_url()?>index.php/Agency/AgencyRequestController">&nbsp;Request</a></li>
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
						<li class="box-menu-list-item"><i class="fas fa-edit"></i><a href="<?= base_url()?>index.php/Agency/AgencyProfileController">&nbsp;Edit Profile</a></li>
						<li class="box-menu-list-item"><i class="fas fa-sign-out-alt"></i><a href="<?= base_url()?>index.php/Logout">&nbsp;Logout</a></li>
					</ul>
					
				</div>
			</div>
		</div>
	</div>
	</div>
	<!-- @start -->
	<hr style="color: green; border: 1px solid">
	<div class="row " style="margin-left: 1px">

		<div class="col-md-6 small-table-info card">
			<div class="card-header">
				
					Approved Request List
			</div>
			<div class="row card-body">
				<!-- <div class="col-md-12"> -->
					<table id="request_approved">
					<thead>
						<th>Request Code</th>
						<th>No. of Product</th>
						<th>Date of Request</th>
						<th>Status</th>
					</thead>
					<tbody>
						<?php
							foreach ($request_approved as $key => $value) {
								
						?>
						<tr>
							<td class="request_code_link">
								<a href="<?=base_url()?>index.php/Agency/AgencyRequestController/requestDetailPage?reqId=<?= $value['iRequestId']?>">
									<?= $value['vRequestCode']?>
										
								</a>
							</td>
							<td align="center"><?= $value['Number_Of_product'] ?></td>
							<td><?=	date("d/m/Y",strtotime($value['dtAddedDate'])) ?></td>
							<td><?= $value['eStatus'] ?></td>
						</tr>
						<?php
							}
						?>
					</tbody>
				</table>	
				<!-- </div> -->
			</div>		
		</div>

		
		<div class="col-md-6 small-table-info card" >
			<div class="card-header">
				Collected Request List
			</div>
			<div class="row card-body">
					<table id="request_pending">
					<thead>
						<tr>
						<th>Request Code</th>
						<th>No. of Product</th>
						<th>Date of Request</th>
						<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<?php
							foreach ($request_pending as $key => $value) {
								
						?>
						<tr>
							<td class="request_code_link">
								<a href="<?=base_url()?>index.php/Agency/AgencyRequestController/requestDetailPage?reqId=<?= $value['iRequestId']?>">
									<?= $value['vRequestCode']?>
										
								</a>
							</td>
							<td align="center"><?= $value['Number_Of_product'] ?></td>
							<td><?=	date("d/m/Y",strtotime($value['dtAddedDate'])) ?></td>
							<td><?= $value['eStatus'] ?></td>
						</tr>
						<?php
							}
						?>
					</tbody>
				</table>	
			</div>		
		</div>

		

	</div> <!-- @end cards  -->
	<!-- @end -->

</body>
</html>