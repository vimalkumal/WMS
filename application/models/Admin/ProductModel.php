<?php

class ProductModel extends CI_Model{

	public function getCategoryList(){
		$message="";
		$result=[
			'value'		=>false,
			'message'	=>'category list not found'
		];

		// $this->db->select('vCategoryName');
		$queary=$this->db->get_where('category',array("eDelete"=>"No"));
		$result_array=$queary->result_array();
		return $result_array;
	}
	
	public function getProductDetails($id=0){
		$message="";
		$result=[
			'value'		=>false,
			'message'	=>''
		];
		
		if($id!=0){
			$this->db->where('iProductId',$id);
		}
		$queary=$this->db->get('product');
		$result_array=$queary->result_array();

		foreach ($result_array as $key => $value) {
			$str_category="NA";
			$category_id=$result_array[$key]['iCategoryId'];
			$str_category=ProductModel::getCategoryName($category_id);
			$result_array[$key]['CategoryName']=$str_category;
		}

		
		return $result_array;
	}
	
	public function setProductDetails($params){
		$message="";
		$result=[
			'value'		=>false,
			'message'	=>''
		];
		$productData=array(
			'vProductName'			=> $params['pro_name'],
			'vProductUnit'			=> $params['pro_unit'],
			'vProductCode'			=> $params['pro_code'],
			'iCategoryId'			=> $params['pro_category'],				
			'iRewardPoints'			=> $params['pro_r_point'],		
			'tDescription'			=> $params['pro_description'],			
			'eStatus'				=> $params['pro_status'],		
		);

		//image uplode if exist
		if($params['imageUpload']){
			$productData['vImage']=$params['pro_image'];
		}

		// if($this->db->insert('product',$productData)){
		// 	$result['value']	= true;
		// 	$message			= "Product added successfully.";
		// }
		// else{
		// 	$result['value']	= false;
		// 	$message			= "Product insert Proccess Failed Try Again !!";
		
		// }
		
		if($params['pro_id']=='' || $params['pro_id']==Null){
			// pr("Insert",1);
			if($this->db->insert('product',$productData)){
				$result['value']	= true;
				$message			= "Product has been added successfully.";
			}
			else{
				$result['value']	= false;
				$message			= "Product insert proccess failed please Try Again !!";
			
			}
		}
		else{
			// pr("Update",1);
			$this->db->where('iProductId',$params['pro_id']);
			if($this->db->update('product',$productData)){
				$result['value']	= true;
				$message			= "Product has been update successfully.";
			}
			else{
				$result['value']	= false;
				$message			= "Product update proccess failed Try Again !!";
			
			}	
		}
		$result['message']=$message;
		
		return $result;
	}

	public function getParentCategory(){
		$message="";
		$result=[
			'value'		=>false,
			'message'	=>''
		];
		$queary=$this->db->get_where('category', array('eStatus'=>'Active'));
		$result_array=$queary->result_array();
		return $result_array;
	}

	public function getCategoryName($id){

		$ret_str="NA";
		$queary=$this->db->get_where('category',array('iCategoryId'=>$id,'eStatus'=>'Active'));
		$result_queary=$queary->result_array();
		$ret_str=$result_queary[0]['vCategoryName'];
		return $ret_str;
	}

	public function deleteProduct($params_id)
	{
		$message="";
		$result=[
			'value'		=>false,
			'message'	=>''
		];
		$this->db->where('iProductId',$params_id);
		if($this->db->update('product',array('eDelete'=>"Yes"))){
			$result['value']	= true;
			$message			= "Product has been delete successfully.";
		}
		else{
			$result['value']	= false;
			$message			= "Product delete proccess failed Try Again !!";	
		}
		$result['message']=$message;
		return $result;
	}

}