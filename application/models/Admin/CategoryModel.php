<?php

class CategoryModel extends CI_Model{
	public function getCategoryDetails($id=0){
		$message="";
		$result=[
			'value'		=>false,
			'message'	=>''
		];
		if($id>0){
			$this->db->where('iCategoryId',$id);
		}else{
			$this->db->where('eDelete',"No");
		}
		$queary=$this->db->get('category');
		$result_array=$queary->result_array();
		foreach ($result_array as $key => $value) {
			$str_parent_category="NA";
			if($result_array[$key]['iParentId']!=0){
				$parant_id=$result_array[$key]['iParentId'];
				$str_parent_category=CategoryModel::getParentCategoryName($parant_id);
			}
			$result_array[$key]['ParenCategoryName']=$str_parent_category;
		}
		
		return $result_array;
	}
	public function setCategoryDetails($params){
		$message="";
		$result=[
			'value'		=>false,
			'message'	=>''
		];
		$categoryData=array(
			'vCategoryName'			=> $params['cat_name'],
			'vCategoryCode'			=> $params['cat_code'],		
			'iParentId'				=> $params['cat_parent_id'],
			'eStatus'				=> $params['cat_status'],		
		);
		
		//image uplode if exist
		if($params['imageUplode']){
			$categoryData['vCategoryImage']=$params['cat_image'];
		}

		if($params['cat_id']=='' || $params['cat_id']==Null){
			// pr("Insert",1);
			if($this->db->insert('category',$categoryData)){
				$result['value']	= true;
				$message			= "Category has been added successfully.";
			}
			else{
				$result['value']	= false;
				$message			= "Category insert proccess Failed Try Again !!";
			
			}
		}
		else{
			// pr("Update",1);
			$this->db->where('iCategoryId',$params['cat_id']);
			if($this->db->update('category',$categoryData)){
				$result['value']	= true;
				$message			= "Category has been updated successfully.";
			}
			else{
				$result['value']	= false;
				$message			= "Category update proccess failed Try Again !!";
			
			}	
		}
		$result['message']=$message;
		
		return $result;
	}

	public function deleteCategory($params_id)
	{
		$message="";
		$result=[
			'value'		=>false,
			'message'	=>''
		];
		$this->db->where('iCategoryId',$params_id);
		if($this->db->update('category',array('eDelete'=>"Yes"))){
			$result['value']	= true;
			$message			= "Category has been delete successfully.";
		}
		else{
			$result['value']	= false;
			$message			= "Category delete proccess failed Try Again !!";	
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

	public function getParentCategoryName($id){
		$ret_str="NA";
		$queary=$this->db->get_where('category',array('iCategoryId'=>$id,'eStatus'=>'Active'));
		
		
		if($queary->num_rows() != 0)
		{	
			$result_queary=$queary->result_array();
			$ret_str=$result_queary[0]['vCategoryName'];
		}
		
		return $ret_str;
	}

}