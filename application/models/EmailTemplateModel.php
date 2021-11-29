<?php

class EmailTemplateModel extends CI_Model{

	public function welcomeMail($params=array())
	{
		/*
			user_name
		*/
		$message="";
		if(!empty($params)){
			$message="<h3>Welcome To WMS Community</h3>
			Hello <b>".ucfirst($params['user_name'])."</b>,<br>
			Thank you for joining us.
			<br>
			<br>
			<br>
			<small>
			Regards<br>
			WMS. 
			</small>";
		}else{
			$message="WMS :)";
		}

		

		return $message;
	}

	public function forgotePassword($params=array())
	{
		/*
			user_name
			new_password
		*/
			$message="";
		if(!empty($params)){
			$message="Hello <b>".ucfirst($params['user_name'])."</b>,<br>
				Your Password is Change as your request. <br>
				Your new password is  : <u>".$params['new_password']."</u>
				<br>
				<br>
				<br>
				<small>
				Regards<br>
				WMS. 
				</small>";
			}else{
			$message="WMS :)";
		}

		return $message;
	}

	public function voucherTemp($params=array())
	{
		/*
			user_name
			voucher_type
			voucher_code
			voucher_value
		*/
			
			
		$message="";
		if(!empty($params)){
		$message="
		  Hello, <b>".$params['user_name']." </b><br>
		  You Redeem voucher Successfully From the WMS<br>

		  <table cellpadding='2px'>
		    <tr>
		      <th colspan='2'>Voucher Information</th>
		    </tr>
		    <tr>
		      <td>Voucher Type</td>
		      <td>: ".$params['voucher_type']."</td>
		    </tr>
		    <tr>
		      <td>Voucher Code</td>
		      <td>: <u>".$params['voucher_code']."</u></td>
		    </tr>
		    <tr>
		      <td>Voucher Value</td>
		      <td>: &#8377; ".$params['voucher_value']." </td>
		    </tr>
		  </table>

		   <center>
		  <div class='box' style='width: 240px;
		    height: 125px;
		    background: #0D5;
		    color: #fff;
		    border: 1px solid;
		    border-radius: 5px;
		    text-align: center;
		    padding: 3px;'>

		    <div class='box-content' style='padding: 3px;
		    border: 2px solid;
		    width: revert;
		    height: -webkit-fill-available;
		    margin: 4px;
		    border-radius: 4px;'>
		      <div class='voucher-type' style='color: black;
		    line-height: 21px;
		    font-size: 16px;
		    font-weight: bold;
		    font-family: arial;'>".$params['voucher_type']."</div>
		      <div class='voucher-code' style=' margin: 10px;    font-family: time new roman;
		    font-size: 30px;'>".$params['voucher_code']."</div>
		      <div class='voucher-rs' style='font-size: 20px;
		    margin: 3px;'>&#8377; ".$params['voucher_value']."</div>
		    </div>
		  </div>
		  </center>
		  	<br>
			<br>
			<br>
			<small>
			Regards<br>
			WMS. 
			</small>";
		}
		else{
			$message="WMS :)";
		}

		return $message;
	}
	public function productRequest($params=array())
	{
		/*
			user_name
			request_code
			servic_collection_code
		*/
		$message="";
		if(!empty($params)){
			$message="";
			// $message.="Hello, ".ucfirst($params['user_name'])."<br>";
			// $message.="Your product request has been generated successfully <br>";
			// $message.="You Request Code Is <u>: ".$params['request_code']."</u><br>";
			// $message.="You Product Collection Code is : <b>".$params['servic_collection_code']."</b><br>";
			// $message.="<div style='color:red'>* This code is mandatory when agency collect your product.</div>";

			$message.="Hello, ".ucfirst($params['user_name'])."<br>";
			$message.="Your product request has been generated successfully <br>";
			$message.="You Request Code Is : <u>REQ/2021/04/000021</u><br>";
			$message.="You Product Collection Code is : <b>720203</b><br>";
			$message.="<div style='color:red'>* This code is mandatory when agency collect your product.</div>";


			$message.="
			<br>
			<br>
			<br>
			<small>
			Regards<br>
			WMS. 
			</small>";
		}else{
			$message="WMS :)";
		}

		

		return $message;
	}
}