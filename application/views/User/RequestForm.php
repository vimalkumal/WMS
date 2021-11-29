<?php
	
	$pageName="Request"; 
	$message=  "";
	$classValue="alert-success";
	$reg_page=$this->session->flashdata('request_form_message');
	// var_dump($reg_page)
	if($this->session->flashdata('request_form_message')!=Null){
		$reg_page_array	=	explode("|", $this->session->flashdata('request_form_message'));
		$message 		=	$reg_page_array[0];
		$classValue		=	$reg_page_array[1];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?= $pageName?></title>
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

	<style type="text/css">
		
		
		.custom-width{
		    margin-left: 14px;
		    max-width: 31.33%;
		}
		em{
			color: #ff0000;
		}
		
		.form-radio{
			padding-top: 14px;
		    text-align: center;}
	</style>
	<link rel="stylesheet" href="<?= base_url()?>assets/css/style.css">
	

	
	<?php require_once('headder.php');?>
	
</head>
<body>
	<?php
		if($message!=null || $message!=''){
	?>
	<div class="alert <?= $classValue?>   alert-dismissible fade show" role="alert">
		<?= $message?>
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	</div>
	<?php } ?>
	<div class="row">
		<div class="col-md-12">
			<div class="strip">
				<div class="title-strip"><i class="fas fa-hand-holding"></i> 
					Product Request
				</div>
			</div>
		</div>	
	</div>
	<div class="container">
	<form action="<?= base_url()?>index.php/User/RequestController/setRequest" method="post" enctype="multipart/form-data">
		
		<input type="hidden" 	class="form-control input-lg"  name="hProductId" id="hProductId" value="<?= $productId?>">

		<div class="form-group row">
			<label for="tProductName" class="col-sm-4 col-form-label">Product Name</label>
			<div class="col-sm-4">
				<input type="text" 	class=" form-control input-lg"  name="tProductName" id="tProductName" value="<?= $productName?>" disabled="">	
			</div>
			
		</div>
		<div class="form-group row">
			<label for="sUnit" class="col-sm-4 col-form-label">Unit<em>*</em></label>
			<div class="col-sm-4">
				<select name="sUnit" id="sUnit" required="" class="form-control input-lg">
					<option>Select Unit</option>
					<option value="Kg">Kilogram</option>
					<option value="Piece">Piece</option>
				</select>
			</div>

		</div>

		<div class="form-group row">
			<label for="tProductQuantity" class="col-sm-4 col-form-label">Product Quantity<em>*</em></label>
			<div class="col-sm-4">
				<input type="text" 	class="form-control input-lg"  name="tProductQuantity" id="tProductQuantity" required="" > 
			</div>
		</div>

		<div class="form-group row">
			<label for="rAddress" class="col-sm-4 col-form-label">Addres<em>*</em></label>
			<div class="col-sm-4">
				<?php
					foreach ($address as $key => $value) {
					 
					  
				?>
				<div class="row">
					<div class="col-sm-2 form-radio">
						<input type="radio"	class=""  name="rAddress" id="rAddress" value="<?= $address[$key]['iAddressId']?>">
					</div>
					<div class="col-sm-10">
						<?= $address[$key]['vAddressLine1']?>,<br>
						<?= $address[$key]['vAddressLine2']?>-
						<?= $address[$key]['iPincode']?>

					</div>
				</div>
				<?php } ?>
			</div>
		</div>
		
		<div class="form-group row">
			<label for="customFileLang" class="col-sm-4 col-form-label">Image<em>*</em></label>
			<div class="col-sm-4 custom-width">
				<input type="file" 	class="custom-file-input" id="customFileLang" name="fProductImage" required="" value="<?= isset($product_info)?$product_info[0]['vImage']:''?>">
				 
  				<label class="custom-file-label" for="customFileLang">
			  		Select Only Image File Only 
			    </label>
			  	
			</div>
		</div>
		<div class="form-group row">
			<label for="teDescription" class="col-sm-4 col-form-label">Description<em>*</em></label>
			<div class="col-sm-4 ">
				<textarea  name="teDescription" id="teDescription" cols="58"><?= isset($product_info)?$product_info[0]['tDescription']:''?></textarea>
				
			</div>
		</div>

		<div class="form-group row">
			<label for="tOrderDate" class="col-sm-4 col-form-label">Order Date</label>
			<div class="col-sm-4">
				<input type="text" 	class="form-control input-lg"  name="tOrderDate" id="tOrderDate" disabled="" value="<?= date("Y/m/d")?>"> 
			</div>
		</div>

		
		<div class="form-group row">
			<div class="col-sm-12 text-center">
				<input 	type="submit" 	class="btn btn-primary"  name="Submit"   value="Submit">
				<input 	type="reset" 	class="btn btn-secondary"  name="Submit"  value="Clear">
				<a class="btn btn-danger" href="<?= base_url()?>index.php/User/UserController">Discard</a>
			</div>
		</div>
	</form>
	</div>	
<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
</body>
</html>