<?php
	
	$pageName="Master"; 
	$subMenuProduct="Product"; 
	$mode=isset($_REQUEST['productId'])?'Update':'Add';
	// $message=  $mode." Product List!!";
	$message=  "";
	$classValue="alert-success";
	$reg_page=$this->session->flashdata('product_message');
	// var_dump($reg_page)
	if($this->session->flashdata('product_message')!=Null){
		$reg_page_array	=	explode("|", $this->session->flashdata('product_message'));
		$message 		=	$reg_page_array[0];
		$classValue		=	$reg_page_array[1];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?= $mode." ".$pageName?></title>
	<link rel="shortcut icon" href="<?= base_url()?>/assets/logo/logo.png">

	<!-- CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

	<!--data tabde  css-->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">

	<!-- for i-con view class -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

	<link rel="stylesheet" href="<?= base_url()?>assets/css/style.css">
	<link rel="stylesheet" href="<?= base_url()?>assets/css/Admin/admin_style.css" >
	<!-- JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
	<!-- for i-con view class -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>

	<!-- data table js -->
	<script src="https:////cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
	<style type="text/css">
		
		
		.custom-width{
		    margin-left: 14px;
		    max-width: 31.33%;
		}
		em{
			color: #ff0000;
		}
		.error{
			color: #ff0000;
		}
		.product_form_image{
			width: 25px;
			height: 25px;
		}
	</style>
	<link rel="stylesheet" href="<?= base_url()?>assets/css/style.css">
	

	<?php
	require_once('HeaderAdmin.php');
	?>
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
	<?php }?>
	
	<div class="row">
		<div class="col-md-12">
			<div class="strip">
				<div class="title-strip"><i class="fas fa-dumpster"></i> 
					<?= isset($_REQUEST['productId'])?'Update':'Add'?> Product Detail
				</div>
			</div>
		</div>	
	</div>
	<div class="container">
		<?php
		if (isset($product_info) && empty($product_info)) {
			echo "Data Not Found";exit();
		}
		?>
	<form action="<?= base_url()?>index.php/Admin/ProductController/setProduct" method="post" enctype="multipart/form-data" id="form_product" name="form_product">
		<input type="hidden" name="hMode" value="<?= isset($product_info)?'Update':'Add'?>">
		<input type="hidden" 	class="form-control input-lg"  name="hProductId" id="hProductId" value="<?= isset($product_info)?$product_info[0]['iProductId']:''?>">

		<div class="form-group row">
			<label for="tProductName" class="col-sm-4 col-form-label">Product Name<em>*</em></label>
			<div class="col-sm-4">
				<input type="text" 	class=" form-control input-lg"  name="tProductName" id="tProductName" required="" value="<?= isset($product_info)?$product_info[0]['vProductName']:''?>" >	
			</div>
			
		</div>
		<div class="form-group row">
			<label for="tProductCode" class="col-sm-4 col-form-label">Product Code<em>*</em></label>
			<div class="col-sm-4">
				<?php
					if(isset($product_info)){
				?>
				<input type="hidden" name="hProductCode" value="<?= isset($product_info)?$product_info[0]['vProductCode']:''?>">
				<?php
					}
				?>
				<input type="text" 	class="form-control input-lg"  name="tProductCode" id="tProductCode" required="" value="<?= isset($product_info)?$product_info[0]['vProductCode']:''?>" <?= isset($product_info)?'disabled':'' ?> > 
			</div>
		</div>
		<div class="form-group row">
			<label for="tProductUnit" class="col-sm-4 col-form-label">Product Unit<em>*</em></label>
			<div class="col-sm-4">
				<input type="text" 	class=" form-control input-lg"  name="tProductUnit" id="tProductUnit" required="" value="<?= isset($product_info)?$product_info[0]['vProductUnit']:''?>" >	
			</div>	
		</div>
		<div class="form-group row">
			<label for="tProductRewardPoints" class="col-sm-4 col-form-label">Product Reward Point<em>*</em></label>
			<div class="col-sm-4">
				<input type="text" 	class=" form-control input-lg"  name="tProductRewardPoints" id="tProductRewardPoints" required="" value="<?= isset($product_info)?$product_info[0]['iRewardPoints']:''?>" >	
			</div>	
		</div>
		<div class="form-group row">
			<label for="sCategory" class="col-sm-4 col-form-label">Category<em>*</em></label>
			<div class="col-sm-4">
				<select name="sCategory" id="sCategory" required="" class="form-control input-lg">
					<option value="">Select Category</option>
					<?php
					if(!empty($category)){
						foreach ($category as $key => $value) {
							$selectedValue="";
							if(isset($product_info)){
								$selectedValue=$category[$key]['iCategoryId']==$product_info[0]['iCategoryId']?"selected='selected'":"";
							}
							?>
							<option value="<?= $category[$key]['iCategoryId']?>" <?= $selectedValue?> ><?= $category[$key]['vCategoryName']?></option>
							<?php
						}
					}
					?>
				</select>
			</div>

		</div>
		<div class="form-group row">
			<label for="customFileLang" class="col-sm-4 col-form-label">Image
				<?= isset($product_info)?"":"<em>*</em>" ?>
			</label>
			<div class="col-sm-4 custom-width">
				<input type="file" 	class="custom-file-input" id="customFileLang" name="fProductImage" required="" value="<?= isset($product_info)?$product_info[0]['vImage']:''?>">
				  <?php
				 	if(isset($product_info)){
				 ?>
				 <img src="<?= base_url()?>/assets/images/Admin/Product/<?= $product_info[0]['vImage']?>?>" class="product_form_image">
				<?php } ?>
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
			<label for="sStatus" class="col-sm-4 col-form-label">Status<em>*</em></label>
			<div class="col-sm-4">
				<select name="sStatus" id="sStatus" required="" value="<?= isset($product_info)?$product_info[0]['eStatus']:''?>" class="form-control input-lg">
					<option value="active">Active</option>	
					<option value="inactive">Inactive</option>	
				</select>
			</div>

		</div>
		<div class="form-group row">
			<div class="col-sm-12 text-center">
				<input 	type="submit" 	class="btn btn-primary"  name="Submit"   value="Submit">
				<input 	type="reset" 	class="btn btn-secondary"  name="Submit"  value="Clear">
				<a class="btn btn-danger" href="<?= base_url()?>index.php/Admin/ProductController">Discard</a>
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

$(document).ready(function(){

	 	$.validator.addMethod(
		    "regex",
		    function(value, element, regexp) {
		        return this.optional(element) || regexp.test(value);
		    },
		    "Please check your input."
		);

		

      $("#form_product").validate({
        rules:{
          "tProductName": {
          	required: true,
          	regex:/^[a-zA-Z\s]{3,}$/
          } ,
          "tProductCode": {
          	required: true,
          	regex:/^.{3,}$/
          } ,
          "tProductUnit":{
          	required: true,
          	regex:/^[a-zA-Z]{2,}$/
          },
          "tProductRewardPoints":{
          	required:true,
          	regex:/^[1-9][0-9]*$/,
          	digits:true
          },
          "sCategory":{
          	required:true
          },
          "fProductImage": {
          	required: <?= isset($product_info)?"false":"true"?>,
            extension: "jpg|png|jpeg"
          	
          },
          "teDescription": {
          	required: true,
          	minlength:10,
          	
          },
          "sStatus": {
          	required: true
          	
          }
        },
        messages:{
          "tProductName": {
          	required: "Product name is required.",
          	regex:"Product name must be character or at least 3 characters."
          } ,
          "tProductCode": {
          	required: "Product Code is required.",
          	regex:"Product Code contains at least 3 characters."
          } ,
          "tProductUnit":{
          	required: "Product Unit is required.",
          	regex:"Product Unit must be character or contains at least 2 characters."
          },
            "tProductRewardPoints":{
          	required:"Produt Reward is required.",
          	regex:"Value should be greater than 0.",
          	digits:"Enter only Number."
          },
          "sCategory":{
          	required:"Category is required."
          },
          "fProductImage": {
          	required: "Image is required.",
            extension: "File should be .jpg .png .jpeg"
          },
          "teDescription": {
          	required: "Description is required.",
          	minlength: "Description contains at least 10 characters."
          	
          },
          "sStatus": {
          	required: "Status is required."
          	
          }
        }
      });


    });

</script>
</body>
</html>