<?php
	$pageName="Master";
	$subMenuCategory="Category"; 
	
	$message="";
	$classValue="alert-success";
	$reg_page=$this->session->flashdata('category_message');
	// var_dump($reg_page)
	if($this->session->flashdata('category_message')!=Null){
		$reg_page_array	=	explode("|", $this->session->flashdata('category_message'));
		$message 		=	$reg_page_array[0];
		$classValue		=	$reg_page_array[1];
	}
	

?>
<!DOCTYPE html>
<html>
<head>
	<title>:: <?= $subMenuCategory ?> ::</title>
	<link rel="shortcut icon" href="<?= base_url()?>/assets/logo/logo.png">

	<!-- CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

	


	<!-- for i-con view class -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

	<!-- for i-con view class -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

	<!--data tabde  css-->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css"> -->

	<link rel="stylesheet" href="<?= base_url()?>assets/css/style.css" >
	<link rel="stylesheet" href="<?= base_url()?>assets/css/Admin/admin_style.css" >
	<!-- JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>


	<!-- data table js -->
	<script src="https:////cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
		    $('#categoryTable').DataTable({
		    	  "dom": '<"top"f>rt<"bottom"lp><"clear">'
		    });
		});
	</script>
	<?php
	require_once('HeaderAdmin.php');
	?>
	<style type="text/css">
		
		.btn-add{
			margin-bottom: 10px
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
	<?php }?>

	<div class="row">
		<div class="col-md-12">
			<div class="strip">
				<div class="title-strip"><i class="fas fa-recycle"></i> Category</div>
			</div>
		</div>	
	</div>	
	<div class="container">
	<a href="<?= base_url()?>index.php/Admin/CategoryController/categoryForm" class="btn btn-primary btn-add">
		<i class="fa fa-plus "></i>&nbsp;Add Category
	</a>
	
	
	<table id="categoryTable" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Image</th>
                <th>Category Name</th>
                <th>Category Code</th>
                <th>Parent Category</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        	<?php
        	foreach ($category as $key => $value) {
        		# code...
        	
        	?>
            <tr>
                <td><img src="<?= base_url()?>/assets/images/Admin/Category/<?= $category[$key]['vCategoryImage']?>" widh="15px" height="15px" alt="no image"></td>
                <td><?= $category[$key]['vCategoryName']?></td>
                <td><?= $category[$key]['vCategoryCode']?></td>
                <td><?= $category[$key]['ParenCategoryName']?></td>
                <td><?= $category[$key]['eStatus']?></td>
                <td>
                	<a href="<?= base_url()?>index.php/Admin/CategoryController/categoryForm?categoryId=<?= $category[$key]['iCategoryId']?>" class="btn-success btn ">
                		<i class="fa fa-pen"></i>&nbsp;Edit
                	</a>
                	<a href="CategoryController/unsetCategory?categoryId=<?= $category[$key]['iCategoryId']?>" class="btn-danger btn">
                		<i class="fa fa-trash"></i>&nbsp;Delete
                	</a>
                </td>
            </tr>
            <?php
        	}?>
        </tbody>
    </table>
	</div>	
</body>
</html>