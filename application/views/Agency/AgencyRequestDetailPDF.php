<?php
	// pr($user_Info);
	// pr($request_item_data);
	// pr($agency_Info,1);
	// pr($action,1);
?>
<html>
<head>
	<!-- CSS -->
	

	<style type="text/css">
		.title-strip > a{
			text-decoration: none;
		}
		.title-strip > a:hover{
			color: #388E3C;
		}
		.contant{
			padding: 5px;
			padding-bottom: 20px;
			/*background-color: #fff;*/
		}
		.contant-request{
			padding: 4px;
			border: 1px solid black;
		}
		.contant-request-item{
			margin-top: 5px;
			background-color: #fff;	
		}
		.data-item-label-title,.label-data-title {
		    font-size: 13px;
		    font-weight: bold;
		}
		.data-item-label-value,.label-data-value {
		    font-size: 17px;
		    margin-bottom: 9px;
		    display: block;
		}
		.request-item {
		    padding: 5px;
		    border-bottom: 1px solid;
		    margin-bottom: 8px;
		}
		.title-req-item {
			font-size: 18px;
			display: inline-block;
			margin-bottom: 34px;
			margin-top: 10px;
			border-bottom: 4px solid #388E3C;
			font-weight: bold;
		}
		.sr_no{
			text-align: center;
			width: 80px;
		}
		.action{
			float: right;
    		margin-bottom: 10px;
		}
		.user-detail{
			background: #fff;
			padding-bottom:15px; 
		}
		.title-style-h4{
			border-bottom: 2px solid #388E3C;
		}
		.item-info{
    		max-width: 14.666667%;
		}
		.data-total-point{
			padding-left: 0px;
			font-size: 13px;
		    font-weight: bold;
		}

		.row{
			display: inline-block;
		}
		.image-logo{
			width: 50px;
			height: 50px;
		}
		.request_item_table{
			width: 100%;
		}

		.request_item_th,.request_item_td{
			border: 1px solid black;
			padding: 5px;
		}
		.request_item_table{
			border-collapse: collapse;	
		}
		.request_td_1{
			width: 370px;
		}

		.ri_code{
			width: <?= $action=="Request"?'230px':'200px'?>;
		}
		.ri_p_name{
			width: <?= $action=="Request"?'220px':'170px'?>;
		}
		.ri_p_cat{
			width: <?= $action=="Request"?'220px':'170px'?>;	
		}
		.request_data_table{
			width: 100%
		}

		.user_title {	
			font-size: 14px;
			padding: 3px;
			font-weight: bold;
			width: 170px;
		}
		.user_title_value{
			
			font-size: 14px;
			padding: 3px;
		}

		.agency_title {	
			font-size: 14px;
			padding: 3px;
			font-weight: bold;
			width: 170px;
		}
		.agency_title_value{
			
			font-size: 14px;
			padding: 3px;
		}
		.sign_table{
			width: 1000px;
		}
	</style>

</head>
<body>
	<center>
		<div class="row">
			<div class="col-md-12">
				<div class="strip">
					<div class="title-strip">
						<img class="image-logo" src="<?= base_url()?>assets/logo/logo.png"><br>

						Collection <?= $action?><br>
						<b><?= $request_item_data['requestData']['vRequestCode']?></b>
					</div>
				</div>
			</div>	
		</div>
	</center>

	<div class="contant">
	<div class="contant-request">
		<table class="request_data_table">
			<thead>
				
			</thead>
			<tbody>
				<tr>
					<td class="request_td_1">
						<div class="label-data-title">User Name</div>
						<span class="label-data-value text-capitalize" style="text-transform: capitalize;"><?= $request_item_data['requestData']['user_name']?></span>
					</td>
					
					<td class="request_td_3">
						<div class="label-data-title">Agency Name</div>
						<span class="label-data-value"><?= $agency_Info['vAgencyName']?></span>						
					</td>
					<td class="request_td_4">
						<div class="label-data-title">Agency Owner Name</div>
						<span class="label-data-value" >
							<?= ucfirst($agency_owner['vName'])?>
						</span>
					</td>
				</tr>
				<tr>
						
					<td>
						<div class="label-data-title">Date of Request</div>
						<span class="label-data-value"><?= date("d/m/Y ",strtotime($request_item_data['requestData']['dtAddedDate']))?></span>
					</td>
					<td>
						<div class="label-data-title">Agency Owner Email</div>
						<span class="label-data-value"><?= $agency_owner['vEmail']?></span>
					</td>
					<td>
						<div class="label-data-title">Agency Owner Mobile Number</div>
						<span class="label-data-value"><?= $agency_owner['iMobileNo']?></span>
					</td>
					
					
				</tr>
			
			</tbody>
		</table>
		
	</div>

	<div class="contant-request-item">
		<div class="title-req-item">
				Request Item Detail
		</div>
		<table class="request_item_table">
			<tr class="table-head">
				<th class="request_item_th ri_no">Sr.No</th>
				<th class="request_item_th ri_code">Request Item Code</th>
				<th class="request_item_th ri_p_name">Product</th>
				<th class="request_item_th ri_p_cat">Category</th>
				<th class="request_item_th ri_p_Qty">Product Quantity</th>
				<?php
					if($action=="Receipt"){
				?>
				<th class="request_item_th ri_p_rQty">Received Quantity</th>
				<?php
					}
				?>
			</tr>
		
		<?php
			$i=0;
			foreach ($request_item_data['requestItemData'] as $key => $value) {
		?>
		<tr>
			<td class="request_item_td sr_no"><?= ++$i?></td>
			<td class="request_item_td"><?= $value['vRequestItemCode'] ?></td>
			<td class="request_item_td"><?= $value['product_info']['vProductName'] ?></td>
			<td class="request_item_td"><?= $value['p_category_info']['vCategoryName'] ?></td>
			<td class="request_item_td"><?= $value['dQuantity']?>&nbsp;<?= $value['product_info']['vProductUnit'] ?></td>
			<?php
				if($action=="Receipt"){
			?>
			<td class="request_item_td"><?= $value['receivedQuantityFormat']?></td>
			<?php
				}
			?>
		</tr>
		<?php }?>	
		
		</table>
	</div>
	<table class="other_info_table" style="width: 100%">
		<tr>
			<td>
				<div class="contant-request-user">
					<div class="title-req-item">
							User Detail
					</div>
					<div class="user_data">
					<table class="user_table">
						<tr>
							<td class="user_title" >Name</td>
							<td class="user_title_value" style="text-transform: capitalize;"><?= $user_Info['vName']?></td>
						</tr>
						<tr>
							<td class="user_title">Mobile Number</td>
							<td class="user_title_value"><?= $user_Info['iMobileNo']?></td>
						</tr>
						<tr>
							<td class="user_title">Email Id</td>
							<td class="user_title_value"><?= $user_Info['vEmail']?></td>
						</tr>
						<tr>
							<td class="user_title">Address</td>
							<td class="user_title_value">
									<?= $request_item_data['requestData']['Address_info']['vAddressLine1']?><br>
									<?= $request_item_data['requestData']['Address_info']['vAddressLine2']?>-
									<?= $request_item_data['requestData']['Address_info']['iPincode']?>
							</td>

							
						</tr>
					</table>
				</div>	
				</div>
			</td>
			<td>
				<div class="contant-request-user">
					<div class="title-req-item">
							Agency Detail
					</div>
					<div class="user_data">
					<table class="agency_table">
						<tr>
							<td class="agency_title" >Agency Name</td>
							<td class="agency_title_value" style="text-transform: capitalize;"><?= $agency_Info['vAgencyName']?></td>
						</tr>
						<tr>
							<td class="agency_title">Agency Phone Number</td>
							<td class="agency_title_value"><?= $agency_Info['iPhoneNo']?></td>
						</tr>
						<tr>
							<td class="agency_title">Agency Email Id</td>
							<td class="agency_title_value"><?= $agency_Info['vAgencyEmail']?></td>
						</tr>
						<tr>
							<td class="agency_title">Agency Address</td>
							<td class="agency_title_value">
									<?= $agency_Info['vAddressLine1']?><br>
									<?= $agency_Info['vAddressLine2']?>-
									<?= $agency_Info['iPincode']?>
							</td>

							
						</tr>
					</table>
				</div>	
				</div>
			</td>
		</tr>
	</table>

	
	</div>
	<?php
		if($action=="Receipt"){
	?>
	<table class="sign_table">
		<tr>
			<td>User :_ _ _ _ _ _ _ _ _ _</td>
			<td>Receiver : _ _ _ _ _ _ _ _ _ _</td>
			<td>Received Date : _ _ _ _ _ _ _ _ _ _</td>
		</tr>
	</table>
	
	<?php
	}
	?>
<!-- <?php //require_once('footer.php');?>	 -->
	
</body>

</html>