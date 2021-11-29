<?php
	$pageName="Master"; 
	$subMenuCategory="Category";
	$message="";
	$mode=isset($_REQUEST['categoryId'])?'Update':'Add';
	$classValue="alert-success";
	$reg_page=$this->session->flashdata('category_message');
	// var_dump($reg_page)
	if($this->session->flashdata('category_message')!=Null){
		$reg_page_array	=	explode("|", $this->session->flashdata('category_message'));
		$message 		=	$reg_page_array[0];
		$classValue		=	$reg_page_array[1];
	}

	if($this->session->flashdata('category_form_message')!=Null){
		$reg_page_array	=	explode("|", $this->session->flashdata('category_form_message'));
		$message 		=	$reg_page_array[0];
		$classValue		=	$reg_page_array[1];
	}


?>
<!DOCTYPE html>
<html>
<head>
	<title><?= $mode." ".$subMenuCategory?></title>
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

	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script> -->
	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
	
	<!-- data table js -->
	<script src="https:////cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
	<style type="text/css">
		
		
		.custom-width{
		    margin-left: 14px;
		    max-width: 31.33%;
		}
		.cat_form_image{
			width: 20px;
			height: 20px;
		}
		em{
			color: #ff0000;
		}
		.error{
			color: red;
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
	<?php } ?>
	<div class="row">
		<div class="col-md-12">
			<div class="strip">
				<div class="title-strip"><i class="fas fa-recycle"></i> 
					<?= isset($_REQUEST['categoryId'])?'Update':'Add'?> Category Detail
				</div>
			</div>
		</div>	
	</div>	
	<div class="container">
		<?php
		if (isset($category_info) && empty($category_info)) {
			// pr($category_info,1);
			echo "Data Not Found !!";exit();
		}
		else{
			
		}
		?>
	<form action="<?= base_url()?>index.php/Admin/CategoryController/setCategory"  method="post" enctype="multipart/form-data" id="form_category" name="form_category">
		<input type="hidden" name="hMode" value="<?= isset($category_info)?'Update':'Add'?>">
		<input type="hidden" 	class="form-control input-lg"  name="hCategoryId" id="hCategoryId" value="<?= isset($category_info)?$category_info[0]['iCategoryId']:''?>">

		<div class="form-group row">
			<label for="tCategoryName" class="col-sm-4 col-form-label">Category Name<em>*</em></label>
			<div class="col-sm-4">
				<input type="text" 	class=" form-control input-lg"  name="tCategoryName" id="tCategoryName" required="" value="<?= isset($category_info)?$category_info[0]['vCategoryName']:''?>" >	
			</div>
			
		</div>
		<div class="form-group row">
			<label for="tCategoryCode" class="col-sm-4 col-form-label">Category Code<em>*</em></label>
			<div class="col-sm-4">
				<?php
					if(isset($category_info)){
				?>
				<input type="hidden" name="hCaregoryCode" value="<?= isset($category_info)?$category_info[0]['vCategoryCode']:''?>">
				<?php
					}
				?>
				<input type="text" 	class="form-control input-lg"  name="tCategoryCode" id="tCategoryCode" required="" value="<?= isset($category_info)?$category_info[0]['vCategoryCode']:''?>" <?= isset($category_info)?'disabled':'' ?> > 
			</div>
		</div>
		<div class="form-group row">
			<label for="sParentCategory" class="col-sm-4 col-form-label">Parent Category<em>*</em></label>
			<div class="col-sm-4">
				<select name="sParentCategory" id="sParentCategory" required="" class="form-control input-lg">
					<option value="0">No Parent Category</option>
					<?php
					if(!empty($category_parent)){
						foreach ($category_parent as $key => $value) {
							// $idValue=isset($category_info)?$category_info[0]['iParentId']:'0';
							$selectedValue="";
							if(isset($category_info)){
								$selectedValue=$category_parent[$key]['iCategoryId']==$category_info[0]['iParentId']?"selected='selected'":"";
							}
							
							?>
							<option value="<?= $category_parent[$key]['iCategoryId']?>" <?= $selectedValue?>>
								<?= $category_parent[$key]['vCategoryName']?>		
							</option>
							<?php
						}
					}
					?>
				</select>
			</div>

		</div>
		<div class="form-group row">
			<label for="customFileLang" class="col-sm-4 col-form-label">Image 
				<?= isset($category_info)?"":"<em>*</em>" ?>
			</label>
			<div class="col-sm-4 custom-width">
				<input type="file" 	class="custom-file-input" id="customFileLang" name="fImage">
				 <?php
				 	if(isset($category_info)){
				 ?>
				 <img src="<?= base_url()?>/assets/images/Admin/Category/<?= $category_info[0]['vCategoryImage']?>?>" class="cat_form_image">
				<?php } ?>
  				<label class="custom-file-label" for="customFileLang">
			  		Select Image File Only 
			    </label>
			  	
			</div>

		</div>
		<div class="form-group row">
			<label for="sStatus" class="col-sm-4 col-form-label">Status<em>*</em></label>
			<div class="col-sm-4">
				<select name="sStatus" id="sStatus" required="" value="<?= isset($category_info)?$category_info[0]['eStatus']:''?>" class="form-control input-lg">
					<option value="active">Active</option>	
					<option value="inactive">Inactive</option>	
				</select>
			</div>

		</div>
		<div class="form-group row">
			<div class="col-sm-12 text-center">
				<input 	type="submit" 	class="btn btn-primary"  name="Submit"   value="Submit">
				<input 	type="reset" 	class="btn btn-secondary"  name="Submit"  value="Clear">
				<a class="btn btn-danger" href="<?= base_url()?>index.php/Admin/CategoryController">Discard</a>
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

      $("#form_category").validate({
        rules:{
          "tCategoryName": {
          	required: true,
          	regex:/^[a-zA-Z\s]{3,}$/
          } ,
          "tCategoryCode": {
          	required: true,
          	regex:/^.{3,}$/
          } ,
          "sParentCategory":{
          	required: true
          },
          "fImage":{
          	required: <?= isset($category_info)?"false":"true"?>,
            extension: "jpg|png|jpeg"
          },
          "sStatus": {
          	required: true
          	
          }
        },
        messages:{
          "tCategoryName": {
          	required: "Category name is required.",
          	regex:"Category name must be character or at least 3 characters."
          } ,
          "tCategoryCode": {
          	required: "Category Code is required.",
          	regex:"Category Code contains at least 3 characters."
          } ,
          "sParentCategory":{
          	required: "Parent Category is required."
          },
          "fImage":{
          	required: "Image is required.",
            extension: "File should be .jpg .png .jpeg"
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