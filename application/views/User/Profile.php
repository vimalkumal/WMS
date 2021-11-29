<?php
    $pageName="User Profile";
    $user_info=$user_info[0];
    $subMenuProfile="My Profile";
    $message="";
    $classValue="alert-success";
    $reg_page=$this->session->flashdata('change_profile_message');
    // var_dump($reg_page)
    if($this->session->flashdata('change_profile_message')!=Null){
        $reg_page_array =   explode("|", $this->session->flashdata('change_profile_message'));
        $message        =   $reg_page_array[0];
        $classValue     =   $reg_page_array[1];
    }
    // pr($user_info,1);
?>
<!DOCTYPE html>
<html>
<head>
    <title>:: <?= $pageName  ?> ::</title>
    <link rel="shortcut icon" href="<?= base_url()?>assets/logo/logo.png">
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <link rel="stylesheet" href="<?= base_url()?>assets/css/style.css" >
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <!-- ajax fore form validation -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    
    <!-- ajax after insert -->
    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
    <!-- <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script> -->

    <!-- for i-con view class -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">


    <style type="text/css">
        .pb-5, .py-5 {
            padding-bottom: 1rem!important;
        }
       .btn-custom {
            width: 100px;
            font-size: 15px;
            padding: 0px;
            margin-top: 0px;
            border-radius: 0px;
            color: #000;
            /*background: #424242; */
        }

        .error{
            color: red;
        }
        .container{
            padding: 0px;
        }

        .img-wrapper {
          position: relative;
          border:1px solid;
        }

       .img-responsive {
            width: 100px;
            height: 100px;
            border: 0px solid; 
            padding: 3px;
        }

        .img-overlay {
          position: absolute;
          top: 0;
          bottom: 0;
          left: 0;
          right: 0;
          text-align: center;
        }

        .img-overlay:before {
          content: ' ';
          display: block;
          /* adjust 'height' to position overlay content vertically */
          height: 50%;
        }
        /*.custom-file-label{
            margin: 10px;
        }*/
    </style>
    <?php
    require_once('headder.php');
    ?>
    
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
 <div class="container rounded bg-white mt-5">
    <div class="row" style="border: 2px #388e3c solid;margin-bottom: 15px;">
        <div class="col-md-4 border-right">

            <div class="d-flex flex-column align-items-center text-center p-3 py-5" style="margin-top: 50px;">
                <!-- <i class="fa fa-user-circle fa-7x "></i> -->
                <div class="img-wrapper">
                  <img class="img-responsive"
                       src="<?= base_url()?>assets/images/UserProfileImages/<?= $user_info['vUserImage']?>">
                  <div class="img-overlay">
                   <!--  <a class=" btn btn-custom" href="#">
                        <i class="fa fa-pen"></i>
                    </a> -->
                  </div>
                </div>
                <div>
                 <a class=" btn btn-custom" href="#" data-target="#Edit_Profile" data-toggle="modal">
                    <i class="fa fa-edit"></i>
                </a>
                </div>
               
                <span class="font-weight-bold text-capitalize" style="margin-top: 10px;"><?= $user_info['vName']?></span>
                <span class="text-black-50 "><?= $user_info['vEmail']?></span>
            </div>
        </div>
        <div class="col-md-8">
            <form method="post" action="<?= base_url()?>index.php/User/UserProfileController/changeUserDetails" id="userProfile">
            <input type="hidden" name="hUserId"     value="<?= $user_info['iUserId']?>">
            <input type="hidden" name="hUserEmail"  value="<?= $user_info['vEmail']?>">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3"> 
                    <h5 class="text-right" style="margin-left: 5px; margin-top: 7px;">My Profile</h5>
                </div>
                <div class="row mt-2">
                    <div class="form-group col-md-6">
                        <label for="fname">First Name</label>
                        <input type="text" name="tFirstName" class="form-control text-capitalize" id="fname" placeholder="Uaer First Name" value="<?= $user_info['vFirstName']?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lname">Last-Name</label>
                        <input type="text" name="tLastName" class="form-control text-capitalize" id="lname" placeholder="User Last Name" value="<?= $user_info['vLastName']?>">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="form-group col-md-6">
                        <label for="jdate">Email Id</label>
                        <input type="email" name="eUserEmail" class="form-control" id="jdate" placeholder="User Email " value="<?= $user_info['vEmail']?>" disabled="true">
                        <small class="form-text text-muted" style="padding-left: 10px;">You cannot change your Email.</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="mno">Mobile Number</label>
                        <input type="text" name="tMobileNumber" class="form-control" id="mno" placeholder="User Mobile No" value="<?= $user_info['iMobileNo']?>">
                    </div>

                </div>
                
                <div class="row mt-3">

                    <div class="form-group col-md-6">
                        <label for="pass">Old Password</label>
                        <input type="password" name="pOldPassword" class="form-control" id="pass" placeholder="Enter New Password">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="cfpass">New Password</label>
                        <input type="password" name="pNewPassword" class="form-control" id="cfpass" placeholder="Confirm Password">
                    </div>

                </div>
                <div class="mt-5 text-right">
                    <input class="btn btn-outline-success rounded-pill custbutton-class" type="submit" name="sUserProfile" value="Save Profile">
            </form>
                    <a href="<?= base_url()?>index.php/Logout" class="btn btn-outline-success rounded-pill custbutton-class" >Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal of Approve/ Cancel Request of The Product -->
    <div class="modal fade" id="Edit_Profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit User Profile</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?= base_url()?>index.php/User/UserProfileController/changeProfileImage" method="post" enctype="multipart/form-data" id="userImageForm" name="userImageForm" >
              <div class="modal-body"> 
                  <input type="hidden" name="hUserId" value="<?= $user_info['iUserId']?>" id="hUserId">

                    <div class="form-group row">
                      <label for="fUserImage" class="col-sm-4 col-form-label">User Image<em>*</em></label>
                      <div class="col-sm-8">
                        <input type="file"  class="custom-file-input form-control" id="fUserImage" name="fUserImage" >
                        <label class="custom-file-label" for="fUserImage">
                            Select Image File Only 
                        </label>
                      </div>
                    </div>

                    
                    
        
                    
                    <!-- <input type="file" name="fUserImage"> -->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" name="approve" value="Uplode Image" type="button" class="btn btn-primary">
              </div>
            </form>
        </div>
      </div>
    </div>
    <!-- Modal of Approve/ Cancel Request of The Product @end-->

<script type="text/javascript">
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

      $("#userProfile").validate({
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
          "pNewPassword": {
            required: false,
            regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/
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
          "pNewPassword": {
            required: "Password is required.",
            regex:"Password contains Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character"
          }
        }
      });

       $("#userImageForm").validate({
         rules:{
          "fUserImage": {
            required: true,
            extension: "jpg|png|jpeg",
            maxFileSize: {
                "unit": "KB",
                "size": 100
            },
            minFileSize: {
                "unit": "KB",
                "size": 1
            }
          }
        },
        messages:{
          "fUserImage": {
            required: "Image is required.",
            extension: "File should be .jpg .png .jpeg",
            maxFileSize:"100 KB",
            minFileSize: "Min"
          }  
        }
       });
    });

</script>
</body>
</html>
