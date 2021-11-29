<?php
	$pageName="Address";
	$message="Address Detail Page!!";
	$classValue="alert-success";
	$reg_page=$this->session->flashdata('address_form_message');
	// var_dump($reg_page)
	if($this->session->flashdata('address_form_message')!=Null){
		$reg_page_array	=	explode("|", $this->session->flashdata('address_form_message'));
		$message 		=	$reg_page_array[0];
		$classValue		=	$reg_page_array[1];
	}
	// pr($address_data);
	// pr($state_list);
	// pr($city_list);
?>
<!DOCTYPE html>
<html>
<head>
	<title>:: <?= $pageName?> ::</title>
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

	<!-- Ajax -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>

		<?php
	require_once('headder.php');
	?>
	<style type="text/css">
		.error{
			color: red;


		}
	</style>
</head>
<body>
	<!-- <div class="alert <?= $classValue?>  alert-dismissible fade show" role="alert" >
		<?= $message?>
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	</div> -->
	
	<div class="row">
		<div class="col-md-12">
			<div class="strip">
				<div class="title-strip"><i class="fa fa-map-marked-alt"></i>
					<?= isset($address_data)?'Update':'Add'?> Address
				</div>
			</div>
		</div>	
	</div>
	<?php
		if(isset($address_data)){
			if(empty($address_data)){
		?>
		<div class="col-12">
			<h6 class="text-center">Address Records Not found !!</h6>
		</div>		
	<?php
			exit();
		}
	}
	?>
	<div class="container">	
	<form action="<?= base_url()?>index.php/User/AddressController/setAddress" class="form-group" method="post" id="form-user-address" name="form-user-address">
		<input type="hidden" name="hMode" value="<?= isset($address_data)?'Update':'Add'?>">
		<input type="hidden" 	class="form-control input-lg"  name="hAddressId" id="hAddressId" value="<?= isset($address_data)?$address_data[0]['iAddressId']:''?>">

		<div class="form-group row">
			<label for="tAddressTitle" class="col-sm-4 col-form-label">Address Title<em>*</em></label>
			<div class="col-sm-4">
				<input type="text" 	class=" form-control input-lg"  name="tAddressTitle" id="tAddressTitle" required="" value="<?= isset($address_data)?$address_data[0]['vAddressTitle']:''?>" >	
			</div>
		</div>

		<div class="form-group row">
			<label for="tAddressLine1" class="col-sm-4 col-form-label">Address Line1<em>*</em></label>
			<div class="col-sm-4">
				<input type="text" 	class=" form-control input-lg"  name="tAddressLine1" id="tAddressLine1" required="" value="<?= isset($address_data)?$address_data[0]['vAddressLine1']:''?>" >	
			</div>
		</div>

		<div class="form-group row">
			<label for="tAddressLine2" class="col-sm-4 col-form-label">Address Line2<em>*</em></label>
			<div class="col-sm-4">
				<input type="text" 	class=" form-control input-lg"  name="tAddressLine2" id="tAddressLine2" required="" value="<?= isset($address_data)?$address_data[0]['vAddressLine2']:''?>" >	
			</div>
		</div>

		<div class="form-group row">
			<label for="seAddressCountry" class="col-sm-4 col-form-label">Country<em>*</em></label>
			<div class="col-sm-4">
				<select name="seAddressCountry" id="seAddressCountry" required="" value="<?= isset($address_data)?$address_data[0]['iCountryId']:''?>" class="form-control input-lg">
					<option value="">Select Country</option>
					<?php
					    foreach($country as $row)
					    {
					     $option	= 	"<option value='".$row->iCountryId."' ";
					     if(isset($address_data) && $row->iCountryId == $address_data[0]['iCountryId'] ){
					     	$option	.= "selected='selected'";
					     }
					     $option   .=	">".$row->vCountryName."</option>";
					     echo $option;
					    }
					 ?>	
				</select>
			</div>
		</div>

		<div class="form-group row">
			<label for="seAddressState" class="col-sm-4 col-form-label">State<em>*</em></label>
			<div class="col-sm-4">
				<select name="seAddressState" id="seAddressState" required="" value="<?= isset($address_data)?$address_data[0]['iCountryId']:''?>" class="form-control input-lg">
					<option value="">Select State </option>
					<?php
					if(isset($address_data) && !empty($state_list)){
						foreach ($state_list as $key => $value) {
							$selectedValue="";
							$selectedValue=$value['iStateId']==$address_data[0]['iStateId']?"selected='selected'":"";
							?>
							<option value="<?= $value['iStateId']?>" <?= $selectedValue?>>
								<?= $value['vStateName']?>		
							</option>
							<?php
						}
					}
					?>
				</select>
			</div>
		</div>

		<div class="form-group row">
			<label for="seAddressCity" class="col-sm-4 col-form-label">City<em>*</em></label>
			<div class="col-sm-4">
				<select name="seAddressCity" id="seAddressCity" required="" value="<?= isset($address_data)?$address_data[0]['iCountryId']:''?>" class="form-control input-lg">
					<option value="">Select City </option>
					<?php
					if(isset($address_data) && !empty($city_list)){
						foreach ($city_list as $key => $value) {
							$selectedValue="";
							$selectedValue=$value['iCityId']==$address_data[0]['iCityId']?"selected='selected'":"";
							?>
							<option value="<?= $value['iCityId']?>" <?= $selectedValue?>>
								<?= $value['vCityName']?>		
							</option>
							<?php
						}
					}
					?>
				</select>
			</div>
		</div>

		<div class="form-group row">
			<label for="tPincode" class="col-sm-4 col-form-label">Pincode<em>*</em></label>
			<div class="col-sm-4">
				<input type="text" 	class=" form-control input-lg"  name="tPincode" id="tPincode" required="" value="<?= isset($address_data)?$address_data[0]['iPincode']:''?>" >	
			</div>
		</div>

		<div class="form-group row">
			<label for="tLatitude" class="col-sm-4 col-form-label">Latitude<em>*</em></label>
			<div class="col-sm-4">
				<input type="text" 	class=" form-control input-lg"  name="tLatitude" id="tLatitude" required="" value="<?= isset($address_data)?$address_data[0]['vLatitude']:''?>" >	
			</div>
		</div>

		<div class="form-group row">
			<label for="tLongitude" class="col-sm-4 col-form-label">Longitude<em>*</em></label>
			<div class="col-sm-4">
				<input type="text" 	class=" form-control input-lg"  name="tLongitude" id="tLongitude" required="" value="<?= isset($address_data)?$address_data[0]['vLongitude']:''?>" >	
			</div>
		</div>


		<div class="form-group row">
			<label for="seStatus" class="col-sm-4 col-form-label">Status<em>*</em></label>
			<div class="col-sm-4">
				<select name="seStatus" id="seStatus" required="" value="<?= isset($address_data)?$address_data[0]['eStatus']:''?>" class="form-control input-lg">
					<option value="active">Active</option>	
					<option value="inactive">Inactive</option>	
				</select>
			</div>

		</div>

		<div class="form-group row">
			<div class="col-sm-12 text-center">
				<input 	type="submit" 	class="btn btn-primary"  name="Submit"   value="Submit">
				<input 	type="reset" 	class="btn btn-secondary"  name="Submit"  value="Clear">
				<a class="btn btn-danger" href="<?= base_url()?>index.php/User/AddressController">Discard</a>
			</div>
		</div>


	</form>
	</div>
	<!-- <?php// require_once('footer.php');?> -->
</body>

<script type="text/javascript">

	$(document).ready(function(){
		//ajax fore the set state value
		$('#seAddressCountry').on('change',function(){
			var selectedCountryId=$('#seAddressCountry').val();
			
			if(selectedCountryId !=''){

				$.ajax({
					
					url:"<?= base_url()?>index.php/User/AddressController/get_state_data",
				    
				    method:"POST",
				    
				    data:{selectedCountryId:selectedCountryId},
				    
				    success:function(data)
				    {
						$('#seAddressState').html(data);
					    $('#seAddressCity').html('<option value="">Select City</option>');
				    }
				});
			}
			else{

				$('#seAddressState').html('<option value="">Select State</option>');
   				$('#seAddressCity').html('<option value="">Select City</option>');
			}
		});

		//ajax fore the set city value
		$('#seAddressState').on('change',function(){
			var selectedStateId=$('#seAddressState').val();
			
			if(selectedStateId !=''){

				$.ajax({
					
					url:"<?= base_url()?>index.php/User/AddressController/get_city_data",
				    
				    method:"POST",
				    
				    data:{selectedStateId:selectedStateId},
				    
				    success:function(data)
				    {
						$('#seAddressCity').html(data);
				    }
				});
			}
			else{
				$('#seAddressCity').html('<option value="">Select City</option>');
			}
		});

		// form validation ajex rules set
		//this for regex validation in form
		$.validator.addMethod(
		    "regex",
		    function(value, element, regexp) {
		        return this.optional(element) || regexp.test(value);
		    },
		    "Please check your input."
		);

		 $("#form-user-address").validate({
	        rules:{
	           "tAddressTitle": {
	          	required: true,
	          	regex:/^[a-zA-z\s0-9]{5,}$/
	          } ,
	           "tAddressLine1": {
	          	required: true,
	          	regex:/^.{3,}$/
	          } ,
	          "tAddressLine2": {
	          	required: true,
	          	regex:/^.{3,}$/
	          } ,
	          "seAddressCountry":{
	          	required: true
	          
	          },
	          "seAddressState":{
	          	required:true
	          },
	          "seAddressCity": {
	          	required: true
	          },
	          "tPincode": {
	            required:true,
	            digits: true,
    			maxlength: 8
	          },
	          "tLatitude":{
	           	required:true
	          },
			  "tLongitude":{
				required:true
			  }
	        },
	        // 
	        messages:{
	        	"tAddressTitle": {
	          	required: "Address Title is required.",
	          	regex:"Adress title contains only Alpha numeric characters or at lest 5 characters."
	          } ,
	           "tAddressLine1": {
	          	required: "Address Line1 is required.",
	          	regex:"Address Line1 contains al least 3 characters."
	          },
	          "tAddressLine2": {
	          	required: "Address Line2 is required.",
	          	regex:"Address Line2 contains al least 3 characters."
	          },
	          "seAddressCountry":{
	          	required: "Country is required."
	          },
	          "seAddressState":{
	          	required:"State is required."
	          },
	          "seAddressCity": {
	          	required: "City is required."
	          },
	          "tPincode": {
	            required:"Pincode is required.",
	            digits: "Pincode contains only digits.",
				maxlength: "Pincode contains maximum 8 digits"
	          },
	          "tLatitude":{
	           	required:"Latitude is required."
	          },
			  "tLongitude":{
				required:"Longitude is required."
			  }
	     	}
		 //@end ajax form validation.
		 });
	});
</script>

</html>