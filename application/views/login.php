<?php
	$message="";
	$classValue="alert-warning";
	$reg_page=$this->session->flashdata('login_message');
	// $reg_page=$this->session->flashdata('login_message');
	// var_dump($reg_page)
	if($this->session->flashdata('login_message')!=Null){
		$reg_page_array	=	explode("|", $this->session->flashdata('login_message'));
		$message 		=	$reg_page_array[0];
		$classValue		=	$reg_page_array[1];
	}
	// if($this->session->flashdata('login_message')!=Null){
		
	// }
?>
<!DOCTYPE html>
<html>
<head>
	<title>WMS</title>

	<link rel="shortcut icon" href="<?= base_url()?>/assets/logo/logo.png">

	<!-- CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

	<link rel="stylesheet" href="<?= base_url()?>assets/css/style.css" >
	<!-- JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
	 <!-- for i-con view class -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<style type="text/css">
		.container {
			margin-top: 60px;
			width:800px;
			min-height: max-content;
			padding: 10px;
		}
		#cycle{
			height: inherit;
			width: inherit;
			padding-top: 40px;
			padding-bottom: 40px;

		}
		.login-title{
			font-family: emoji;
		    margin: 7px 0px 7px 0px;
		    font-weight: bold;
		    color: #1b5e20;
		    font-size: 25px;
		    margin-bottom: 20px;
		}
		.form-image {
			background-color: #8bc34a; 
		}
		.form-contant{
			background-color: #c5e1a5;
			padding-top: 15px;
		}
		.reg-title{
			margin-bottom: 10px;
			color: green;
		}
		.reg-title > a{
			text-decoration: none;
		}
		.form-group{
			margin-bottom: 30px;
		}
		.error{
			color: red;
		}
		#remember{
			padding-top: 6px;
		    color: green;
		    display:inline-block;
		}
		#eye:hover{
		cursor: pointer;
		}
		/*.input-group-text{
			background: #fff;
			border-color: #fff;
		}*/
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
	<?php
		}
	?>
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
				<h5 class="login-title">Login Details</h5>
			</div>
		</div>
		<form action="<?= base_url()?>index.php/Login/chechUserDetail" method="post" id="form_login"	name="form_login">
		  	<div class="form-group row">
		  		<label for="iUserEmail" class="col-sm-4 col-form-label">Email</label>
		  		<div class="col-sm-8">
		  			<input type="email"		name="eUserEmail"			name="eUserEmail"		
		  				   id="iUserEmail" 			placeholder="Email Id"
				   		   required=""			class="form-control input-lg"
				   		   value="<?= isset($_COOKIE['UserId'])?$_COOKIE['UserId']:''?>">
		  		</div>
		  	</div>
		  <div class="form-group row">
		  		<label for="iUserPassword" class="col-sm-4 col-form-label">Password</label>
		  		<div class="col-sm-8">
		  			
		  			<div class="input-group">
						<input type="password" 	name="pUserPassword"	id="iUserPassword" 		placeholder="Password"
				   			required=""			class="form-control input-lg"	
				   			value="<?= isset($_COOKIE['UserPassword'])?$_COOKIE['UserPassword']:''?>">
						 <div class="input-group-append">
						    <span class="input-group-text" id="basic-addon2"><i class="fas fa-eye-slash" id="eye"></i></span>
						  </div>
					</div>

					<label id="iUserPassword-error" class="error" for="iUserPassword"></label>
					<div id="remember"><input type="checkbox" name="cRemember"> Remember Me</div>
				   <a href="<?= base_url()?>index.php/ForgotPasswordController/" class="float-right">Forgot Password</a>
		  		</div>
	  		</div>
		  	<div class="form-group row">
		  		<!-- <label for="" class="col-sm-4 col-form-label"></label> -->
		  		<div class="col-sm-12">
		  			<input type="submit" 		name="userSingUp" class="form-control input-lg btn-success" value="LOGIN">
		  		</div>
		  	</div>
		  	<div class="row">
				<div class="col-12 text-right reg-title">
					<a href="<?= base_url()?>index.php/Registration/">Registration</a>
				</div>
			</div>
		</form>
		</div>
	</div>
	
	</div>

<script type="text/javascript">


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

  $("#form_login").validate({
    rules:{
      "eUserEmail":{
      	required:true
      },
      "pUserPassword": {
      	required: true
      }
    },
    messages:{
      "eUserEmail":{
      	required:"Emil Id is required.",
      },
      "pUserPassword": {
      	required: "Password is required."
      }
    }
  })
});

</script>

</body>
</html>