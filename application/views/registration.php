<?php
	$message="";
	$classValue="alert-success";
	$reg_page=$this->session->flashdata('reg_message');
	// var_dump($reg_page)
	if($this->session->flashdata('reg_message')!=Null){
		$reg_page_array	=	explode("|", $this->session->flashdata('reg_message'));
		$message 		=	$reg_page_array[0];
		$classValue		=	$reg_page_array[1];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>WMS</title>
	<link rel="shortcut icon" href="<?= base_url()?>assets/logo/logo.png">

	<!-- CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

	<link rel="stylesheet" href="<?= base_url()?>assets/css/style.css" >
	<link rel="stylesheet" href="<?= base_url()?>assets/css/registration_style.css" >

	<!-- JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

	<!-- ajax fore form validation -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
	
	 <!-- for i-con view class -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

	<style type="text/css">
		#eye:hover{
			cursor: pointer;
		}
		#iFirstName-error{
			font-size: 15px;
		}
		#iLastName-error{
			font-size: 15px;
		}
		#iUserPassword-error	{
			display: contents;
		}
	</style>
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

	<nav class="navbar header-nav">
	  <a class="navbar-brand" href="#">
	    <img src="<?= base_url()?>assets/logo/logo.png" width="30" height="30" alt="">
	  </a>
	</nav>
	<!-- Hello World! -->
	<div class="container">
	
	<div class="row content">
		<div class="col-4 form-image" >
			<img src="<?= base_url()?>assets/images/cycle.png" id="cycle">
		</div>
		<div class="col-8 form-contant">
		<div class="row">
			<div class="col-12">
				<h5 class="reg-title">Registration Details</h5>
			</div>
		</div>
		<form action="<?= base_url()?>index.php/Registration/addUserInfo" method="post" id="form_reg" name="form_reg">
		  	<div class="form-group row">
		  		<label for="" class="col-sm-4 col-form-label">Name<em>*</em></label>
		  		<div class="col-sm-4">
		  			<input type="text"			name="tFirstName"		id="iFirstName" 			placeholder="First Name"
				   required=""			class="form-control input-lg">
				   <!-- <label class="error" for="user">check</label>  -->
		  		</div>
		  		<div class="col-sm-4">
		  			<input type="text"			name="tLastName"		id="iLastName" 			placeholder="Last Name"
				   required=""			class="form-control input-lg">
				   <!-- <label class="error" for="user">check</label> 		 -->
		  		</div>

		  	</div>

		  	<div class="form-group row">
		  		<label for="iMobileNumber" class="col-sm-4 col-form-label">Mobile Number<em>*</em></label>
		  		<div class="col-sm-8">
		  			<input type="text"			name="tMobileNumber"	id="iMobileNumber"		placeholder="Mobile Number"
				   required=""			class="form-control input-lg">
		  		</div>
		  	</div>
			
		  	<div class="form-group row">
		  		<label for="iUserEmail" class="col-sm-4 col-form-label">Email<em>*</em></label>
		  		<div class="col-sm-8">
		  			<input type="email"			name="eUserEmail"		id="iUserEmail" 			placeholder="Email Id"
				   required=""			class="form-control input-lg">
				   <i class="fa fa-info-circle tooltip-custom" data-toggle="tooltip" data-html="true" title="<small>This email will be used for all communications</small>"></i>
		  		</div>
		  	</div>
			
			<div class="form-group row">
		  		<label for="iUserPassword" class="col-sm-4 col-form-label">Password<em>*</em></label>
		  		<div class="col-sm-8">
		  			<div class="input-group">
						<input type="password" 		name="pUserPassword"	id="iUserPassword" 		placeholder="Password"
				   required=""			class="form-control input-lg">
						 <div class="input-group-append">
						    <span class="input-group-text" id="basic-addon2"><i class="fas fa-eye-slash" id="eye"></i></span>
						  </div>
						 
					</div>
					<label id="iUserPassword-error" class="error" for="iUserPassword"></label>

				   <i class="fa fa-info-circle tooltip-custom" data-toggle="tooltip" data-html="true" title="<small>password should be strong</small>"></i>

		  		</div>
		  	</div>

		  	<div class="form-group row">
		  		<label for="pConfirmPassword" class="col-sm-4 col-form-label">Confirm Password<em>*</em></label>
		  		<div class="col-sm-8">
		  			<input type="password" 		name="pConfirmPassword"	id="pConfirmPassword" 		placeholder="Confirm Password"
				   required=""			class="form-control input-lg">
				   <i class="fa fa-info-circle tooltip-custom" data-toggle="tooltip" data-html="true" title="<small>Confirm password Match with the Password </small>"></i>
		  		</div>
		  	</div>

			
		  	<div class="form-group row">
		  		<label for="iUserType" class="col-sm-4 col-form-label">Register As<em>*</em></label>
		  		<div class="col-sm-8">
		  			<select name="sUserType"	id="iUserType"			class="form-control input-lg">
		  				<option value="">Select User</option>
					<?php
						foreach ($role as $key => $value) {
							# code...?>
						<option value="<?= $role[$key]['iRoleId']?>" class="form-control input-lg"><?= $role[$key]['vRoleName']?></option>	
					<?php
						}
					?>
							<!-- <option value="2">Agency</option> -->
					</select>
		  		</div>
		  	</div>
			

			<div class="form-group row">
		  		<!-- <label for="" class="col-sm-4 col-form-label"></label> -->
		  		<div class="col-sm-12">
		  			<input type="submit" 		name="userSingUp" class="form-control input-lg btn-success" value="SingUP">
		  		</div>
		  	</div>

			
			<div class="row">
				<div class="col-12 text-right login-title">
					<a href="<?= base_url()?>index.php/Login">Login</a>
				</div>
			</div>
		  
		</form>
		</div>
	</div>
	
	</div>

<script type="text/javascript">
	
	$(function () {
	  $('[data-toggle="tooltip"]').tooltip()
	});

	 $(document).ready(function(){
	 	$('#eye').click(function(){
       
		    if($(this).hasClass('fa-eye-slash')){
		       
		      $(this).removeClass('fa-eye-slash');
		      
		      $(this).addClass('fa-eye');
		      
		      $('#iUserPassword').attr('type','text');
		        
		    }else{
		     
		      $(this).removeClass('fa-eye');
		      
		      $(this).addClass('fa-eye-slash');  
		      
		      $('#iUserPassword').attr('type','password');
		    }
	   });

	 	$.validator.addMethod(
		    "regex",
		    function(value, element, regexp) {
		        return this.optional(element) || regexp.test(value);
		    },
		    "Please check your input."
		);

      $("#form_reg").validate({
        rules:{
          "tFirstName": {
          	required: true,
          	regex:/^[a-zA-Z]{3,}$/
          } ,
          "tLastName": {
          	required: true,
          	regex:/^[a-zA-Z]{3,}$/
          } ,
          "tMobileNumber":{
          	required: true,
          	digits: true,
          	minlength: 10,
    		maxlength: 10
          },
          "eUserEmail":{
          	required:true,
          	email: true,
          	regex: /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/
          },
          "pUserPassword": {
          	required: true,
          	regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/
          } ,
          "pConfirmPassword":{
          	required: true,
          	regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/,
          	equalTo:"#iUserPassword"
          },
          "sUserType": {
            required:true
            }
        },
        messages:{
          "tFirstName": {
          	required: "First name is required.",
          	regex:"First name must be character or at least 3 characters"
          } ,
          "tLastName": {
          	required: "Last name is required.",
          	regex:"Last name must be character or at least 3 characters"
          } ,
          "tMobileNumber":{
          	required: "Mobile Number is required.",
          	digits: "Mobile Number Contains only digits.",
          	minlength: "Mobile should be 10 digits.",
    		maxlength: "Mobile should be 10 digits."
          },
          "eUserEmail":{
          	required:"Emil Id is required.",
          	email: "Enter Valide Email Format.",
          	regex: "Enter Valide Email Format."
          },
          "pUserPassword": {
          	required: "Password is required      .",
          	regex:"Password contains Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character"
          },
           "pConfirmPassword":{
          	required: "Confirm Password is required.",
          	regex:"Match with the Password.",
          	equalTo:"Match with the Password."
          },
          "sUserType": {
            required:"Select at least one."
            }
        }
      });


    });

</script>
</body>
</html>