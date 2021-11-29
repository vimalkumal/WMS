<?php

class AdminModel extends CI_Model{
    
	public function getNumberOfRecordes($tableName)
	{
		$queary=$this->db->get($tableName)->num_rows();
		return $queary;
	}
    
    //tabel list query


    
    public function getLastMonthData()
    {
        
        //  $dataPoints = array(
        //     array("y" => 6, "label" => "Apple"),
        //     array("y" => 4, "label" => "Mango"),
        //     array("y" => 5, "label" => "Orange"),
        //     array("y" => 7, "label" => "Banana"),
        //     array("y" => 4, "label" => "Pineapple"),
        //     array("y" => 6, "label" => "Pears"),
        //     array("y" => 7, "label" => "Grapes"),
        //     array("y" => 5, "label" => "Lychee"),
        //     array("y" => 4, "label" => "Jackfruit")
        // );
        //  pr($dataPoints,1);

        $returnArray=array();
        $currentDate=date("Y/m/d");
        $str                = "-1 month";
        $last_month         = date("m",strtotime($str));
        $last_month_year    = date("Y",strtotime($str));

        // pr($last_month_year);
        // pr($last_month);

        $total_day=cal_days_in_month(CAL_GREGORIAN, $last_month, $last_month_year);
        // pr($total_day,1);

        for ($i=1; $i <=$total_day; $i++) {
            $dayInfoData        = array();
            $date_string        = $last_month_year."-".$last_month."-".$i;
            $date               = date_format(date_create($date_string),"Y-m-d");
            // $dayInfoData['day'] = $date;
            
            $req_count      = $this->db->like("dtAddedDate",$date,"both")->get("request")->num_rows();
            // $dayInfoData['number_of_request']   = $req_count;
            if($req_count<=0){
                $req_count=0;
            }
            $returnArray[$i-1]=array(
                "label"     => $date,
                "y"         => $req_count
               
                
            );

            // array_push($returnArray,$dayInfoData);
        }
        // pr($returnArray,1);
        return $returnArray;
    }

    public function getLastSevenData()
    {

         $returnArray=array();
        $currentDate=date("Y/m/d");
        
        for ($i=1; $i <=7 ; $i++) {
            $dayInfoData            = array();
            $str                    = "-".$i." day";
            $date                   = date("Y-m-d",strtotime($str));
            $dayInfoData['label']   = $date;
            
            $req_count      = $this->db->like("dtAddedDate",$date,"both")->get("request")->num_rows();
            if($req_count<=0){
                $req_count=0;
            }
            $dayInfoData['y']   = intval($req_count);

            array_push($returnArray,$dayInfoData);
        }

        // pr($returnArray,1);
        return $returnArray;

    }

    public function getRequestRecored($status='')
    {
        // SELECT
        // r.iRequestId,
        // r.vRequestCode,
        // r.dtAddedDate,
        // COUNT(ri.iRequestItemId),
        // r.eStatus
        // FROM
        //     request as r,
        //     request_item as ri
        // WHERE
        //     r.iRequestId=ri.iRequestId AND
        //     r.eStatus='Collected'
        // GROUP BY
        //     ri.iRequestId
        $return_data=array();
        $this->db->select('r.iRequestId');
        $this->db->select('r.vRequestCode');
        $this->db->select('r.dtAddedDate');
        $this->db->select('count(ri.iRequestItemId) AS Number_Of_product');
        $this->db->select('r.eStatus');
        $this->db->from('request AS r, request_item AS ri');
        $this->db->where('r.iRequestId=ri.iRequestId');
        $this->db->where('r.eStatus',$status);
        $this->db->group_by('ri.iRequestId');
        $return_data=$this->db->get()->result_array();
        // pr($data,1);
        return $return_data;

    }
    public function getPopulerProductData()
    {           
        $returnArray=array();
        $this->db->select("p.vProductName AS label");
        $this->db->select("COUNT(p.iProductId) AS y");
        $this->db->from("request_item as ri,product as p");
        $this->db->where('ri.iProductId=p.iProductId');
        $this->db->group_by('p.iProductId');
        $returnArray=$this->db->get()->result_array();
        // pr($returnArray,1);
        return $returnArray;
    }

    public function getPoroductTypeData()
    {           
      
        // pr($returnArray,1);


        $total_product      = sizeof($this->GeneralModel->getWhereTableData("product",array("eDelete"=>"No")));
        $bio_product        = sizeof($this->GeneralModel->getWhereTableData("product",array("eDelete"=>"No","iCategoryId"=>"1")));
        $non_bio_product    = $total_product-$bio_product;

        $returnArray[0]['y']        = $bio_product;
        $returnArray[0]['label']    = "Biodegradable";
        $returnArray[1]['y']        = $non_bio_product;
        $returnArray[1]['label']   =  "Non BioDegradable";
        return $returnArray;
    }

    /* this function for the preapre code of user pie chart 
	public function getUserChartData()
	{
		$select =   array(
                'roles.vRoleName',
                'count(user.iUserId) as Total'
            );  
		$result=$this->db
        ->select($select)
        ->from('user')
        ->join('roles','roles.iRoleId = user.iRoleId','left')
        ->group_by('user.iRoleId')
        ->get()
        ->result_array();
        return $result;
        // pr($result,1);
	}*/

}