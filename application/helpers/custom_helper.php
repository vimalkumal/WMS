<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Array Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/helpers/array_helper.html
 */

// ------------------------------------------------------------------------

if ( ! function_exists('pr'))
{
	/**
	 *
	 * @param	array
	 * @param	int
	 * @return	null
	 */
	
	function pr($array_data=array(),$other='')
	{
		echo "<pre>";
		print_r($array_data);
		echo "</pre>";
		if($other===1){
			exit();
		}
	}
}
if ( ! function_exists('tba_value'))
{
	/**
	 *
	 * @param	array
	 * @param	int
	 * @return	null
	 */
	
	function tba_value()
	{
		return 'TBA';
	}
}
if ( ! function_exists('na_value'))
{
	/**
	 *
	 * @param	array
	 * @param	int
	 * @return	null
	 */
	
	function na_value()
	{
		return 'N/A';
	}
}
if ( ! function_exists('alert_message'))
{
	/**
	 *
	 * @param	array
	 * @param	int
	 * @return	null
	 */
	
	function alert_message($message)
	{
		echo "<script>";
		echo "alert('".$message."')";
		echo "</script>";
	}
}

if ( ! function_exists('is_userLogin'))
{
	/**
	 
	 *
	 * 
	 * @return	string
	 */
	function is_userLogin($roleValue="")
	{
		$CI =& get_instance();
		$bResult=false;
		
		if (!$CI->session->userdata('session_user_id')){
			// $bResult=false;
			$CI->session->set_flashdata('login_message',"You not login yet please log in now. | alert-warning");
    		redirect("Login");
		}
		if($CI->session->userdata('session_user_id')){

			$userRoleValue 	=	$CI->session->userdata('user_role_value');
			
			if($roleValue!=$userRoleValue){
				redirect($userRoleValue."/".$userRoleValue."Controller");
			}
			else{
				if($roleValue=='Agency'){
					$is_agency_exist=$CI->GeneralModel->getWhereTableData('agencies',array('iOwnerId'=>$CI->session->userdata('session_user_id')));
					// pr("custom",1);
					// pr($is_agency_exist,1);
					if(empty($is_agency_exist)){
						
						redirect("Agency/AgencyController/addAgency");
					}
				}
			}
		}
		// else{
		// 	$bResult=true;
		// }
		// return $bResult;
		
	}
}

if ( ! function_exists('configValue'))
{
	/**
	 *
	 * @param	array
	 * @param	int
	 * @return	null
	 */
	
	function configValue($code)
	{
		$CI =& get_instance();
		$bResult=false;
		
		$return_value=$CI->GeneralModel->getWhereTableData('configure',array('vConfigCode'=>$code))[0]['vConfigValue'];

		//vd:start @24-10-2021
		if(empty($return_value)){
			$return_value=$CI->GeneralModel->getWhereTableData('configure',array('vConfigCode'=>$code))[0]['vDefaultValue'];			
		}
		//vd:end


		return $return_value;
	}
}
if ( ! function_exists('get_otp'))
{
	/**
	 *
	 * @param	array
	 * @param	int
	 * @return	null
	 */
	
	function get_otp()
	{
		$pin_str="";

		for ($i=0; $i <6 ; $i++) { 
			$pin_str.=chr(rand(35,122));
		}

		return sprintf('%06d',rand(10000,1000000));
	}
}


if ( ! function_exists('get_voucher_code'))
{
	/**
	 *
	 * @param	array
	 * @param	int
	 * @return	null
	 */
	function get_voucher_code()
	{
		$str_array=['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','0','1','2','3','4','5','6','7','8','9'];
		$pin_str="";
		for ($i=0; $i <10 ; $i++){

			$pin_str.=$str_array[rand(0,62)];
		
		}
		return $pin_str;
	}
}