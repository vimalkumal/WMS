<?php
	$message="";
	$classValue="alert-success";
	$reg_page=$this->session->flashdata('agency_message');
	// var_dump($reg_page)
	if($this->session->flashdata('agency_message')!=Null){
		$reg_page_array	=	explode("|", $this->session->flashdata('agency_message'));
		$message 		=	$reg_page_array[0];
		$classValue		=	$reg_page_array[1];
	}
	$u_id=$this->session->userdata('session_user_id');
	$u_name=$this->session->userdata('user_name');
	$u_email=$this->session->userdata('user_email');
	$u_m_no=$this->session->userdata('user_mobileNumber');
	
	// pr($agency_info);

?>	
<!DOCTYPE html>
<html>
<head>
	<title>Agency</title>
	<link rel="shortcut icon" href="<?= base_url()?>/assets/logo/logo.png">

	<!-- CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

	<!--data tabde  css-->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">

	 <!-- for i-con view class -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

	

	<link rel="stylesheet" href="<?= base_url()?>assets/css/style.css" >
	<link rel="stylesheet" href="<?= base_url()?>assets/css/Agency/header_agency.css" >
	<link rel="stylesheet" href="<?= base_url()?>assets/css/Agency/agency_style.css" >
	
	
	
	<!-- JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

	
	

	<style type="text/css">
		.custom-width{
		    margin-left: 14px;
		    max-width: 63%;
		}
		.title-label {
		    font-size: 20px;
		    font-weight: bold;
		   
		    border-bottom: 5px #2e7d32 solid;
		}
		.tooltip-custom{
			position: absolute;
			top: 13px;
			right: 0px;
			color: green;
		}
		.error{
			color: red;
		}
		#agency_form_img{
			padding-top: 3px;
			width: 25px;
			height:25px;
		}
	</style>

	<!-- Ajax -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
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
		if (isset($agency_info)){
			$pageName="Agency";
			require_once('HeaderAgency.php');	
		}
		else{
		?>
		<nav class="navbar header-nav">
		  <a class="navbar-brand" href="#">
		    <img src="<?= base_url()?>assets/logo/logo.png" width="30" height="30" alt="">
		  </a>
		</nav>
		<?php

		}
	?>

	

	<div class="row">
	<div class="col-md-12">
		<div class="strip">
			<div class="title-strip">
				<i class="fas fa-industry">&nbsp;&nbsp;</i><?= isset($agency_info)?"Edit Agency":"Agency" ?>
				<?php
					if(isset($agency_info))
					{
				?>
				<span class="float-right edit-agencyBTN">
					<a href="<?= base_url()?>index.php/Agency/AgencyDetailController" >
						<i class="fa fa-arrow-circle-left" ></i>
					</a>
				</span>
				<?php
					}
				?>
			</div>
		</div>
	</div>	
	</div>

	<div class="container">	
	<form action="<?= base_url()?>index.php/Agency/AgencyController/setAgencyDetails" class="form-group" method="post" enctype="multipart/form-data" id="form_agency" name="form_agency">
		<input type="hidden" name="hUserID" value="<?= $u_id?>">
		<input type="hidden" name="hUserName" value="<?= $u_name?>">
		<input type="hidden" name="hMode" value="<?= isset($agency_info)?'Update':'Add' ?>">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group row " id="form-label">
					<label for="" class="col-sm-12 col-form-label "><span class="title-label">Agency Detail</span></label>
				</div>

				<div class="form-group row">
					<label for="tAgencyName" class="col-sm-4 col-form-label">Agency Name<em>*</em></label>
					<div class="col-sm-8">
						<input type="text" 	class=" form-control input-lg"  name="tAgencyName" id="tAgencyName" required="" value="<?= isset($agency_info)?$agency_info['vAgencyName']:''?>" >	
					</div>
				</div>

				<div class="form-group row">
					<?php
						if(isset($agency_info)){
					?>
					<input type="hidden" name="hAgencyId" value="<?= isset($agency_info)?$agency_info['iAgencyId']:''?>">
					<input type="hidden" name="hAgencyCode" value="<?= isset($agency_info)?$agency_info['vAgencyCode']:''?>">
					<input type="hidden" name="hAgencyRegNo" value="<?= isset($agency_info)?$agency_info['vAgencyRegistrationNo']:''?>">
					<?php
						}
					?>
					<label for="tAgencyCode" class="col-sm-4 col-form-label">Agency Code<em>*</em></label>
					<div class="col-sm-8">
						<input type="text" 	class=" form-control input-lg"  name="tAgencyCode" id="tAgencyCode" required="" value="<?= isset($agency_info)?$agency_info['vAgencyCode']:''?>" <?= isset($agency_info)?'disabled':'' ?> >	
					</div>
				</div>

				<div class="form-group row">
					<label for="tAgencyRegNo" class="col-sm-4 col-form-label">Agency Registration Number <em>*</em></label>
					<div class="col-sm-8">
						<input type="text" 	class=" form-control input-lg"  name="tAgencyRegNo" id="tAgencyRegNo" required="" value="<?= isset($agency_info)?$agency_info['vAgencyRegistrationNo']:''?>"  <?= isset($agency_info)?'disabled':'' ?> >	
					</div>
				</div>

				<div class="form-group row">
					<label for="tAgencyEmail" class="col-sm-4 col-form-label">Agency Email<em>*</em></label>
					<div class="col-sm-8">
						<input type="text" 	class=" form-control input-lg"  name="tAgencyEmail" id="tAgencyEmail" required="" value="<?= isset($agency_info)?$agency_info['vAgencyEmail']:''?>" >	
						
					</div>
				</div>

				<div class="form-group row">
					<label for="tAgencyPhone" class="col-sm-4 col-form-label">Agency Phone No<em>*</em></label>
					<div class="col-sm-8">
						<input type="text" 	class=" form-control input-lg"  name="tAgencyPhone" id="tAgencyPhone" required="" value="<?= isset($agency_info)?$agency_info['iPhoneNo']:''?>" >	
					</div>
				</div>

				<div class="form-group row">
					<label for="customFileLang" class="col-sm-4 col-form-label">Image
						<?= isset($agency_info)?"":"<em>*</em>"?>
					</label>
					<div class="col-sm-8 custom-width">
						<input type="file" 	class="custom-file-input" id="customFileLang" name="fAgencyImage"  value="<?= isset($agency_info)?:''?>">
						 
		  				<label class="custom-file-label" for="customFileLang">
					  		Select Only Image File Only 
					    </label>
					  	<?php
					  		if (isset($agency_info)){
					  			?>
					  			<img src="<?= base_url()?>assets/images/Agency/AgencyImages/<?= $agency_info['vAgencyImage']?>" id="agency_form_img">
					  			<?php
					  		}
					  	?>
					</div>
				</div>

				<div class="form-group row">
					<label for="seStatus" class="col-sm-4 col-form-label">Status<em>*</em></label>
					<div class="col-sm-8">
						<select name="seStatus" id="seStatus" required="" value="<?= isset($agency_info)?$agency_info['eStatus']:''?>" class="form-control input-lg">
							<option value="active">Active</option>	
							<option value="inactive">Inactive</option>	
						</select>
					</div>

				</div>

				<div class="form-group row">
					<label for="seAddressCountry" class="col-sm-12 col-form-label "><span class="title-label">Owner Detail</span></label>
				</div>

				<div class="form-group row">
					<label for="tOwnerName" class="col-sm-4 col-form-label">Owner Name</label>
					<div class="col-sm-8">
						<input type="text" 	class=" form-control input-lg"  name="tOwnerName" id="tOwnerName"  value="<?= $u_name?>" disabled="">	
					</div>
				</div>

				<div class="form-group row">
					<label for="tOwnerEmail" class="col-sm-4 col-form-label">Owner Email</label>
					<div class="col-sm-8">
						<input type="text" 	class=" form-control input-lg"  name="tOwnerEmail" id="tOwnerEmail"  value="<?= $u_email?>" disabled="">	
						 
					</div>
				</div>

				<div class="form-group row">
					<label for="tOwnerMobileNO" class="col-sm-4 col-form-label">Owner Mobile Number</label>
					<div class="col-sm-8">
						<input type="text" 	class=" form-control input-lg"  name="tOwnerMobileNO" id="tOwnerMobileNO"  value="<?= $u_m_no?>" disabled="">	
					</div>
				</div>

			

			</div>
			<div class="col-md-6">
				<div class="form-group row" id="form-label" id="form-label">
					<label for="seAddressCountry" class="col-sm-12 col-form-label "><span class="title-label">Agency Address Detail</span></label>
				</div>

				<div class="form-group row">
					<label for="tAddressLine1" class="col-sm-4 col-form-label">Address Line1<em>*</em></label>
					<div class="col-sm-8">
						<input type="text" 	class=" form-control input-lg"  name="tAddressLine1" id="tAddressLine1" required="" value="<?= isset($agency_info)?$agency_info['vAddressLine1']:''?>" >	
					</div>
				</div>

				<div class="form-group row">
					<label for="tAddressLine2" class="col-sm-4 col-form-label">Address Line2<em>*</em></label>
					<div class="col-sm-8">
						<input type="text" 	class=" form-control input-lg"  name="tAddressLine2" id="tAddressLine2" required="" value="<?= isset($agency_info)?$agency_info['vAddressLine2']:''?>" >	
					</div>
				</div>

				<div class="form-group row">
					<label for="seAddressCountry" class="col-sm-4 col-form-label">Country<em>*</em></label>
					<div class="col-sm-8">
						<select name="seAddressCountry" id="seAddressCountry" required="" value="" class="form-control input-lg">
							<option value="">Select Country</option>
							 <?php
							    foreach($country as $row)
							    {
							     $option	= 	"<option value='".$row->iCountryId."' ";
							     if(isset($agency_info) && $row->iCountryId == $agency_info['iCountryId'] ){
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
					<div class="col-sm-8">
						<select name="seAddressState" id="seAddressState" required="" value="<?= isset($agency_info)?$agency_info['iCountryId']:''?>" class="form-control input-lg">
							<option value="">Select State </option>
							<?php
								if(isset($agency_info) && !empty($state_list)){
									foreach ($state_list as $key => $value) {
										$selectedValue="";
										$selectedValue=$value['iStateId']==$agency_info['iStateId']?"selected='selected'":"";
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
					<div class="col-sm-8">
						<select name="seAddressCity" id="seAddressCity" required="" value="<?= isset($agency_info)?$agency_info['iCountryId']:''?>" class="form-control input-lg">
							<option value="">Select City </option>
							<?php
								if(isset($agency_info) && !empty($city_list)){
									foreach ($city_list as $key => $value) {
										$selectedValue="";
										$selectedValue=$value['iCityId']==$agency_info['iCityId']?"selected='selected'":"";
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
					<div class="col-sm-8">
						<input type="text" 	class=" form-control input-lg"  name="tPincode" id="tPincode" required="" value="<?= isset($agency_info)?$agency_info['iPincode']:''?>" >	
					</div>
				</div>

				

				
			</div>
		</div>
		
		
		
		<div class="form-group row">
			<div class="col-sm-12 text-center">
				<input 	type="submit" 	class="btn btn-primary"  name="Submit"   value="Submit">
				<input 	type="reset" 	class="btn btn-secondary"  name="Submit"  value="Clear">
				
			</div>
		</div>

	</form>
	</div>
	<script>
		



	</script>
</body>
<script type="text/javascript">

	
	// Add the following code if you want the name of the file appear on select
	$(".custom-file-input").on("change", function() {
	  var fileName = $(this).val().split("\\").pop();
	  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});

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
		//this for regex validation in form
		$.validator.addMethod(
		    "regex",
		    function(value, element, regexp) {
		        return this.optional(element) || regexp.test(value);
		    },
		    "Please check your input."
		);

		 $("#form_agency").validate({
	        rules:{
	        	// Agency Detail
	          "tAgencyName": {
	          	required: true,
	          	regex:/^[a-zA-Z\s]{3,}$/
	          } ,
	          "tAgencyCode": {
	          	required: true,
	          	regex:/^.{3,}$/
	          } ,
	          "tAgencyRegNo":{
	          	required: true,
	          	regex:/^.{5,}$/
	          },
	          "tAgencyEmail":{
	          	required:true,
	          	email: true,
	          	regex: /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/
	          },
	          "tAgencyPhone": {
	          	required: true,
	          	digits: true,
	          	minlength: 8,
    			maxlength: 8
	          } ,
	          "fAgencyImage":{
	          	required:<?= isset($agency_info)?'flase':'true' ?>
	          },
	          "seStatus": {
	            required:true
	            },


	            // Agency Address Detail

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
	            }
	        },
	        // 
	        messages:{
	          "tAgencyName": {
	          	required: "Agency Name is required.",
	          	regex:"Agency name must be character or at least 3 characters"
	          },
	          "tAgencyCode": {
	          	required: "Agency code is required.",
	          	regex:"Agency Code least 3 characters"
	          } ,
	          "tAgencyRegNo":{
	          	required: "Agency Registration Number is required.",
	          	regex:"Agency Registration Number at least 5 characters"

	          },
	          "tAgencyEmail":{
	          	required:"Agency Email Id is required.",
	          	email: "Enter Valide Agency Email Format.",
	          	regex: "Enter Valide Agency Email Format."
	          },
	          "tAgencyPhone": {
	          	required: "Agency Phone is required.",
	          	digits: "Agency Phone Contains only digits.",
	          	minlength: "Agency Phone Number should be 8 digits.",
	    		maxlength: "Agency Phone Number should be 8 digits."
	          },
	          "fAgencyImage":{
	          	required:"Agency Image is required."
	          },
	          "seStatus": {
	            required:"Select at least one."
	            },
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
	          }
	        }
	      });
	});

</script>
</html>