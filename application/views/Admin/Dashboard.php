<?php
	$pageName="Dashboard";
	$subMenuDashboard="Dashboard";
	$message="";
	$classValue="alert-warning";
	
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
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	
	<link rel="stylesheet" href="<?= base_url()?>assets/css/style.css" >
	<link rel="stylesheet" href="<?= base_url()?>assets/css/Admin/admin_style.css" >
	<!-- JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

	<!-- chart scripat -->
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
	<script src="https://cdnjs.com/libraries/Chart.js"></script> -->
	
	
	<!-- tabel list js -->
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	
	
	<!-- canvas script-->
	<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
	<script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>

	<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
	<!-- for i-con view class -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">



	<style type="text/css">
		
		.icon {
		    color: rgba(0,0,0,.15);
		    z-index: 0;
		}
		.small-box>.inner {
		    padding: 10px;
		}
		
		.card{
			color: #fff;
		}
		.card-footer {
			background: rgba(0,0,0,.1);
		    padding: 3px;
		    text-align: center;
		    text-decoration: none;
		}
		.card-footer:hover{
			color: #000000;
		}
		.card > a{
			text-decoration: none;
		}
		.card-footer{
			color: #fff;
		}
		#chart {
	    margin: 3px;
	    max-width: 49%;
	    height: 500px;
	    padding: 0px;
		}
		.chart-title{
			color: #000;
		}
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
	<?php
	require_once('HeaderAdmin.php');
	?>
	<script type="text/javascript">
		console.log($("#request_pending > tbody > tr > td").hasClass(".dataTables_empty"));
		$(".dataTables_empty").text('Test');

		console.log($("a").hasClass("canvasjs-chart-credit"));
		
		$(".canvasjs-chart-credit").text('hb');
		
		$(document).ready(function(){
		    $('#request_pending').DataTable( {
		    	"order": [[ 0, "desc" ]],
		        "scrollY":        "200px",
		        "scrollCollapse": true,
		        "paging":         false,
		        "searching": 	  false,
		        "numbering": 	 false
		    });
		} );
		
		$(document).ready(function() {
		    $('#request_approved').DataTable( {
		    	"order": [[ 0, "desc" ]],
		        "scrollY":        "200px",
		        "scrollCollapse": true,
		        "paging":         false,
		        "searching": 	  false,
		        "numbering": 	 false
		    });
		} );
		 
		window.onload = function () {
		var last_month = {
				animationEnabled: true,  
				title:{
					text: ""
				},
				axisX: {
					valueFormatString: "MMM",
					title: "Date of Request"
				},
				axisY: {
					title: "Number of Request"
				},
				data: [{
					type: "splineArea",
					dataPoints:<?php echo json_encode($last_month_data, JSON_NUMERIC_CHECK); ?>
				}]
			};
			$("#lastMonth").CanvasJSChart(last_month);

			var last_week = {
				animationEnabled: true,  
				title:{
					text: ""
				},
				axisX: {
					valueFormatString: "MMM",
					title: "Date of Request"
				},
				axisY: {
					title: "Number of Request"
				},
				data: [{
					type: "splineArea",
					dataPoints:<?php echo json_encode($last_seven_day, JSON_NUMERIC_CHECK); ?>
				}]
			};
			$("#lastWeek").CanvasJSChart(last_week);



			var populer_product = {
				title: {
					text: "Request per product"
				},
				data: [{
						type: "pie",
						startAngle: 45,
						showInLegend: "true",
						legendText: "{label}",
						indexLabel: "{label} ({y})",
						yValueFormatString:"#,##0.#"%"",
						dataPoints: <?php echo json_encode($populer_product, JSON_NUMERIC_CHECK); ?>
				}]
			};
			$("#populer_product").CanvasJSChart(populer_product);

			var options = {
				animationEnabled: true,
				title: {
					text: "Product Category Ratio"
				},
				data: [{
					type: "doughnut",
					innerRadius: "40%",
					showInLegend: true,
					legendText: "{label}",
					indexLabel: "{label}: #percent%",
					dataPoints:<?php echo json_encode($product_type, JSON_NUMERIC_CHECK); ?>

				}]
			};
			$("#type_product").CanvasJSChart(options);

		}
	</script>
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
	<?php }?>
	<div class="row">
		<div class="col-md-12">
			<div class="strip">
				<div class="title-strip">
					<i class="fas fa-tachometer-alt"></i> Dashboard</div>
			</div>
		</div>	
	</div>	
	<div class="container">
		<div class="row">
			<div class="col-md-3">
	            <div class="card" style="background-color: #17A2B8">
	            	<div class="card-body">
	            	<div class="row inner">
	            		<div class="col-md-8">
	            			<H3><?= isset($total_user)?$total_user:'0'?></H3>
	            			<h5>Users</h5>
	            		</div>
	            		<div class="col-md-4 icon">
	            			<i class="fas fa-user fa-4x"></i>			
	            		</div>
	            	</div>
	              	</div>
	              	<a href="<?= base_url()?>index.php/Admin/UsersController" class="card-footer">More info <i class="fas fa-arrow-circle-right"></i>

	              	</a>
	            </div>
          </div>
          <div class="col-md-3">
	            <div class="card" style="background-color: #28A745">
	            	<div class="card-body">
	            	<div class="row inner">
	            		<div class="col-md-8">
	            			<H3><?= isset($total_agency)?$total_agency:'0'?></H3>
	            			<h5>Agency</h5>
	            		</div>
	            		<div class="col-md-4 icon">
	            			<i class="fas fa-industry fa-4x"></i>
	            		</div>
	            	</div>
	              	</div>
	              	<a href="<?= base_url()?>index.php/Admin/AgenciesController" class="card-footer">More info <i class="fas 	fa-arrow-circle-right"></i></a>
	              	
	            </div>
          </div>
          <div class="col-md-3">
	            <div class="card" style="background-color: #FFD43B">
	            	<div class="card-body">
	            	<div class="row inner">
	            		<div class="col-md-8">
	            			<H3><?= isset($total_category)?$total_category:'0'?></H3>
	            			<h5>Category</h5>
	            		</div>
	            		<div class="col-md-4 icon">
	            			<i class="fas fa-recycle fa-4x"></i>			
	            		</div>
	            	</div>
	              	</div>
	              	<a href="<?= base_url()?>index.php/Admin/CategoryController" class="card-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
	            </div>
          </div>
          <div class="col-md-3">
	            <div class="card" style="background-color: #DB316F">
	            	<div class="card-body">
	            	<div class="row inner">
	            		<div class="col-md-8">
	            			<H3><?= isset($total_product)?$total_product:'0'?></H3>
	            			<h5>Product</h5>
	            		</div>
	            		<div class="col-md-4 icon">
	            			<i class="fas fa-dumpster fa-4x"></i>			
	            		</div>
	            	</div>
	              	</div>
	              	<a href="<?= base_url()?>index.php/Admin/ProductController" class="card-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
	            </div>
          </div>
		</div>
		<hr style="color: green; border: 1px solid">
		<div class="row " style="margin-left: 1px">
			<div class="col-md-6 small-table-info card" >
				<div class="card-header">
					Pending Request List
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
									<a href="<?=base_url()?>index.php/Admin/AdminRequestController/requestDetailPage?reqId=<?= $value['iRequestId']?>">
										<?= $value['vRequestCode']?>
											
									</a>
								</td>
								<td><?= $value['Number_Of_product'] ?></td>
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
									<a href="<?=base_url()?>index.php/Admin/AdminRequestController/requestDetailPage?reqId=<?= $value['iRequestId']?>">
										<?= $value['vRequestCode']?>
											
									</a>
								</td>
								<td ><?= $value['Number_Of_product'] ?></td>
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

		</div> <!-- @end cards  -->
		<hr style="color: green; border: 1px solid">
		<!-- @start Chart  -->
		<!-- line chart-->
		<div class="row chart-group">
			<div class="col-md-12">
				<div class="row" style="margin-left: 1px">
					<div class="col-6 card"  id="chart">
						<div class="card-header chart-title">
							Request In Last Month		
						</div>
						<div class="card-body">
								<div id="lastMonth" ></div>
						</div>
					</div>
					<div class="col-6 card" id="chart">
						<div class="card-header chart-title">
							Request In Last 7 Day		
						</div>
						<div class="card-body">
								<div id="lastWeek"></div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- pi chart -->
		<div class="row chart-group">
			<div class="col-md-12">
				<div class="row" style="margin-left: 1px">
					<div class="col-6 card"  id="chart">
						<div class="card-header chart-title">
							Request per product	
						</div>
						<div class="card-body">
								<div id="populer_product" ></div>
						</div>
					</div>
					<div class="col-6 card" id="chart">
						<div class="card-header chart-title">
							Product Category Ratio	
						</div>
						<div class="card-body">
								<div id="type_product"></div>
						</div>
					</div>
				</div>
			</div>
		</div>


	</div>

								

</body>
</html>