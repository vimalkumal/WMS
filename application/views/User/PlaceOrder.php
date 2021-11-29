<?php
	$pageName="Request";
	$message="";
	$classValue="alert-warning";
	// var_dump($reg_page)
	if($this->session->flashdata('place_order_message')!=Null){

		$login_page_array	=	explode("|", $this->session->flashdata('place_order_message'));
		$message 			=	$login_page_array[0];
		$classValue			=	$login_page_array[1];
	}
	// pr($product,1);
?>
<!DOCTYPE html>
<html>
<head>
	<title>:: Place Order ::</title>
	<link rel="shortcut icon" href="<?= base_url()?>assets/logo/logo.png">
	<!-- CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

	<link rel="stylesheet" href="<?= base_url()?>assets/css/style.css" >
	<link rel="stylesheet" href="<?= base_url()?>assets/css/User/user_style.css" >
	
	<!-- JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<!-- ajax for form validation -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
	<!-- for i-con view class -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">



	<?php
	require_once('headder.php');
	?>
	<style type="text/css">
		.body-contant{
			background-color: #fff;
			margin: 2px;
			padding-top: 15px;
			padding-left: 10px;
			
		}
		.list-title {
		    font-size: 20px;
		    display: inline-block;
		    border-bottom: 3px #81C784 solid;
		    padding-left: 5px;
		    padding-right: 5px;
		    margin-left: 5px;
		    font-weight: bold;
		}
		.productList{
			padding: 2px 10px;
		}
		.product-image{
			width: 80px;
			height: 80px;
			margin: 2px;
			padding: 2px;
			border:1px black solid;
			float: left;
		}
		.product-list-item{
			padding-left: 2px;
			padding-top: 5px;
			padding-bottom: 15px;
			border-bottom: 2px solid #2E7D32;
		}
		.product-val
		{
			font-size: 23px;
		    font-weight: 75%;
		    margin: 0px;
		    padding: 0px;}
	    .form-btn{
	    	margin-right: 10px;
	    }
	    .custom-form1{
	    	padding-left: 2px;
			padding-top: 5px;
			padding-bottom: 15px;
			border-bottom: 2px solid #EEEEEE;
	    }
	    .form-btn-submit{
	    	position: fixed;
	    	bottom: 30px;
	    	right: 15px;
	    }
	    .error{
	    	color: red;
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
				<div class="title-strip"><i class="fas fa-cart-plus"></i> Place Order</div>
			</div>
		</div>	
	</div>	

	<div class="body-contant">
		<form method="post" action="<?=base_url()?>index.php/User/RequestController/setOrderRequest" id="placeOrder">
		<div class="row collection-site-data">
			<div class="col-md-12">
				<div class="row collection-title">
					<div class="col-md-12">
						<h5 class="list-title">Collection Site</h5>		
					</div>
				</div>
				<!-- collection sites @start -->
				<div class="row custom-form1">
					<div class="col-3">
						Pick up address<em>*</em>
						<select name="sAddress" id="sStatus"  class="form-control input-lg">
							<option value="">Select Address</option>	
							<?php
								foreach ($address as $key => $value) {
								?>
								<option value="<?= $value['iAddressId'] ?>">
									<?= $value['vAddressTitle']?>
								</option>	
								<?php
								}
							?>
						</select>
					</div>
					<div class="col-2">
						Date Of Request
						<input type="text" 	class="form-control input-lg"  name="tOrderDate" id="tOrderDate" disabled="" value="<?= date("d/m/Y ")?>"> 
						<input type="hidden" name="hPlaceDate" value="<?= date("Y-m-d h:i:s")?>">
					</div>

					<div class="col-md-3 float-right">
						Search Product
						<select id="sSearchProduct" class="form-control ">
							<option value="0">All Product</option>
							<option value="1">BioDegradable</option>
							<option value="2">Non-Biodegradable</option>
						</select>
					</div>

				</div>
			<!-- collection sites @end -->			
			</div>
		</div>


		<div class="row product-list-data">
			<div class="col-md-12">
			<div class="row">
				<div class="col-md-12">
					<h5 class="list-title">Product List</h5>
				</div>
			</div>
			<div class="productList" id="productList">
			<?php
				foreach ($product as $key => $value) {
			?>
				<div class="row product-list-item">

					<input type="hidden" name="productId[<?= $value['iProductId']?>]"	value="<?= $value['iProductId'] ?>">
					<input type="hidden" name="productQtyType[<?= $value['iProductId']?>]"	value="<?= $value['vProductUnit'] ?>">

					<div class="col-3">
						<img class="product-image" src="<?= base_url()?>assets/images/Admin/Product/<?= $product[$key]['vImage']?>">
						
						<div class="text-capitalize product-val">
							<?= $product[$key]['vProductName'] ?>
						</div>
						
						<div class="text-capitalize product-cat-val">
							<?= $product[$key]['vCategoryName'] ?>

						</div>
					
					</div>
					
					<div class="col-3">
						<div>Product Quantity</div>
						<div class="input-group">
							<input class="form-control" type="text" name="productqty[<?=$value['iProductId']?>]" >
							 <div class="input-group-append">
							    <span class="input-group-text" id="basic-addon2"><?= $value['vProductUnit'] ?></span>
							  </div>
						</div>
					</div>
					
				</div>
			
			<?php
				}
			?>
			</div>
	
			<div class=" form-btn-submit">
				<div class="col-12">
					<input class="btn btn-success float-right" type="submit" name="requestSubmit" value="Place Order" onclick=" return confirm('Are You Sure You Want Place Order ?')">
				</div>
			</div>
			</div>
		</div>
			</form>
			</div>
		

	<script type="text/javascript">
		$(document).ready(function(){
			$("#sSearchProduct").change(function(){
				
				var idCategoryProduct=$(this).val();
				var data="sProductId="+idCategoryProduct;
				$.ajax({url:"<?= base_url()?>index.php/User/RequestController/getProductList",
					method:"post",
					data:data,
					success:function(response){
						$("#productList").html(response);
					},
					error: function(e) {
						console.log('Error OK : ' + e);
					 	   
					}
				});
			});
			 $("#placeOrder").validate({
		        rules:{
		          "sAddress": {
		          	required: true
		          },
		          "productqty":{
		          	required: true
		          }
		      	},
		      	message:{
		      		"sAddress":{
		          	required: "Select pick up address."
		          },
		          "productqty":{
		          	required: "Product Quantity is required."
		          }
		      	}
		      });

		});
	</script>
</body>

</html>
