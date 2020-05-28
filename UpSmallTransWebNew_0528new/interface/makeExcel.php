<?php


/** Error reporting */
#error_reporting(E_ALL);
#ini_set('display_errors','On');

function _makeTitle($sheet,$keyList,$keyPosition = "1" ){


    for($i = 0;$i< count($keyList);$i ++  ){
        $sheet->setCellValue($keyList[$i]['index'].''.$keyPosition, $keyList[$i]['name']);
        if ($keyList[$i]["width"]){
           $sheet->getColumnDimension($keyList[$i]['index'])->setWidth($keyList[$i]["width"]);
        }
        if ($keyList[$i]["iStyle"]){
           $sheet->getStyle($keyList[$i]['index'].''.$keyPosition)->applyFromArray($keyList[$i]["iStyle"]);
        }
    }
}

function _makeLine($sheet,$keyList,$data,$linePosition ){
    for($i = 0;$i< count($keyList);$i ++  ){

    	//echo $keyList[$i]['key'].":".$data[$keyList[$i]['key']].'<br>';

        $sheet->setCellValue($keyList[$i]['index'].''.$linePosition, $data[$keyList[$i]['key']]);
        if ($keyList[$i]["NumberFormat"]){
            $sheet->getStyle($keyList[$i]['index'].''.$linePosition)->getNumberFormat()->setFormatCode($keyList[$i]["NumberFormat"]);
        }
       
        if ($keyList[$i]["styleArray"]){
            $sheet->getStyle($keyList[$i]['index'].''.$linePosition)->applyFromArray($keyList[$i]["styleArray"]);
        }
        
    }
}


function makeExcel($data,$request){
	include 'PHPExcel.php';
	
	/** PHPExcel_Writer_Excel2007 */
	include 'PHPExcel/Writer/Excel5.php';
	
	
	$styleArrayBold = array(
		'font' => array(
			'bold' => true,
		)
	);   
	  
	
	switch ($_GET['command'])
	{
		//结果类小单开新
		case 'get360ClassInfo':
			
			$keyList = array(			
			    array( "iStyle"=>$styleArrayBold,"index"=>"A",    "key"=>"Unitid",       		"name"=>"ID"),
			    array( "iStyle"=>$styleArrayBold,"index"=>"B",    "key"=>"UnitName",     		"name"=>"名称",			"width" => 12),
			    array( "iStyle"=>$styleArrayBold,"index"=>"C",    "key"=>"DeptName",     		"name"=>"部门",			"width" => 12),
			    array( "iStyle"=>$styleArrayBold,"index"=>"D",    "key"=>"HireDate",     		"name"=>"入职时间",		"width" => 12),
			    array( "iStyle"=>$styleArrayBold,"index"=>"E",    "key"=>"IsLeave",     		"name"=>"人员状态",		"width" => 12),
			    array( "iStyle"=>$styleArrayBold,"index"=>"F",    "key"=>"PositionName",    	"name"=>"岗位",			"width" => 14),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"G",    "key"=>"PersonCountArg",      "name"=>"平均人数",		"width" => 14),
			    array( "iStyle"=>$styleArrayBold,"index"=>"H",    "key"=>"smallOrder",   		"name"=>"小额订单数",		"width" => 14),
			    array( "iStyle"=>$styleArrayBold,"index"=>"I",    "key"=>"SmallTransSelfBuyNum","name"=>"自助购买",    	 	"width" => 14),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"J",    "key"=>"sumHold",   			"name"=>"日人均通时",    	 	"width" => 14,"NumberFormat" => "#,##0.00"),
			    array( "iStyle"=>$styleArrayBold,"index"=>"K",    "key"=>"CallCountArg",    	"name"=>"日人昀通次",		"width" => 14),
	
				array( "iStyle"=>$styleArrayBold,"index"=>"L",    "key"=>"Class_All",    		"name"=>"总用户数",		"width" => 14,"NumberFormat" => "#,##0.00"),
			    array( "iStyle"=>$styleArrayBold,"index"=>"M",    "key"=>"Class_C_Change",    	"name"=>"C类新增用户数",		"width" => 14),
				array( "iStyle"=>$styleArrayBold,"index"=>"N",    "key"=>"Class_B_Change",    	"name"=>"B类新增用户数",		"width" => 14,"NumberFormat" => "#,##0.00"),
			    array( "iStyle"=>$styleArrayBold,"index"=>"O",    "key"=>"Class_A0",    	  	"name"=>"A0类用户总数",		"width" => 14),
				array( "iStyle"=>$styleArrayBold,"index"=>"P",    "key"=>"middleOrder",    	    "name"=>"3600上拽用户数",		"width" => 14,"NumberFormat" => "#,##0.00"),
			    				
	        );
	        $fileName = $_GET["fynameforexcel"] . "结果类指标_小单开新"."[". date("Y-m-d") ."].xls";
			$fileName = $tmp[20]=iconv('UTF-8','GBK',$fileName); 				
			break;
			
		//结果类1800上拽	
		case 'get18000ClassInfo':
		
			$keyList = array(			
			    array( "iStyle"=>$styleArrayBold,"index"=>"A",    "key"=>"Unitid",       		"name"=>"ID"),
			    array( "iStyle"=>$styleArrayBold,"index"=>"B",    "key"=>"UnitName",     		"name"=>"名称",			"width" => 12),
			    array( "iStyle"=>$styleArrayBold,"index"=>"C",    "key"=>"DeptName",     		"name"=>"部门",			"width" => 12),
			    array( "iStyle"=>$styleArrayBold,"index"=>"D",    "key"=>"HireDate",     		"name"=>"入职时间",		"width" => 12),
			    array( "iStyle"=>$styleArrayBold,"index"=>"E",    "key"=>"IsLeave",     		"name"=>"人员状态",		"width" => 12),
			    array( "iStyle"=>$styleArrayBold,"index"=>"F",    "key"=>"PositionName",    	"name"=>"岗位",			"width" => 14),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"G",    "key"=>"PersonCountArg",      "name"=>"平均人数",		"width" => 14),
				array( "iStyle"=>$styleArrayBold,"index"=>"H",    "key"=>"18000TransTotal",    	"name"=>"上拽订单数",		"width" => 14,"NumberFormat" => "#,##0.00"),
	
				array( "iStyle"=>$styleArrayBold,"index"=>"I",    "key"=>"360_0Up18000TransNum","name"=>"从360上拽订单数",		"width" => 14,"NumberFormat" => "#,##0.00"),
				array( "iStyle"=>$styleArrayBold,"index"=>"J",    "key"=>"3600Up18000TransNum", "name"=>"从3600上拽订单数",		"width" => 14,"NumberFormat" => "#,##0.00"),
				array( "iStyle"=>$styleArrayBold,"index"=>"K",    "key"=>"OtherUp18000TransNum",    	    "name"=>"从其他上拽订单数",		"width" => 14,"NumberFormat" => "#,##0.00"),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"L",    "key"=>"sumHold",   			"name"=>"日人均通时",    	 	"width" => 14,"NumberFormat" => "#,##0.00"),
			    array( "iStyle"=>$styleArrayBold,"index"=>"M",    "key"=>"CallCountArg",    	"name"=>"日人昀通次",		"width" => 14),
	
				array( "iStyle"=>$styleArrayBold,"index"=>"N",    "key"=>"Class_All_18000",    		"name"=>"总用户数",		"width" => 14,"NumberFormat" => "#,##0.00"),
	
				array( "iStyle"=>$styleArrayBold,"index"=>"O",    "key"=>"Class_D_18000",    	"name"=>"D类用户数",		"width" => 14,"NumberFormat" => "#,##0.00"),
			    array( "iStyle"=>$styleArrayBold,"index"=>"P",    "key"=>"Class_C_18000",    	"name"=>"C类用户数",		"width" => 14),
				array( "iStyle"=>$styleArrayBold,"index"=>"Q",    "key"=>"Class_B_18000",    	"name"=>"B类用户数",		"width" => 14,"NumberFormat" => "#,##0.00"),
			    array( "iStyle"=>$styleArrayBold,"index"=>"R",    "key"=>"Class_A0_18000",    	"name"=>"A0类用户总数",		"width" => 14),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"S",    "key"=>"smallOrder",   		"name"=>"小额订单数",		"width" => 14),
			    				
	        );
	        $fileName = $_GET["fynameforexcel"] . "结果类指标_18000上拽"."[". date("Y-m-d") ."].xls";
			$fileName = $tmp[20]=iconv('UTF-8','GBK',$fileName); 
					
			break;
		
		//过程类0-》360新单统计
		case 'get360GuoChengInfo':
			$keyList = array(			
			    array( "iStyle"=>$styleArrayBold,"index"=>"A",    "key"=>"Unitid",       	"name"=>"ID"),
			    array( "iStyle"=>$styleArrayBold,"index"=>"B",    "key"=>"UnitName",     	"name"=>"名称",			"width" => 12),
			    array( "iStyle"=>$styleArrayBold,"index"=>"C",    "key"=>"DeptName",     	"name"=>"部门",			"width" => 12),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"D",    "key"=>"HireDate",     	"name"=>"入职时间",		"width" => 12),
			    array( "iStyle"=>$styleArrayBold,"index"=>"E",    "key"=>"IsLeave",     	"name"=>"人员状态",		"width" => 12),
			    array( "iStyle"=>$styleArrayBold,"index"=>"F",    "key"=>"PositionName",    "name"=>"岗位",			"width" => 14),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"G",    "key"=>"PersonCountAvg",   "name"=>"日均销售员数",		"width" => 14,"NumberFormat" => "#,##0.00"),
			    array( "iStyle"=>$styleArrayBold,"index"=>"H",    "key"=>"sumHold",   		"name"=>"日人均通时",		"width" => 14,"NumberFormat" => "#,##0.00"),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"I",    "key"=>"CallCountArg",   		"name"=>"日人均通次",    	 	"width" => 14,"NumberFormat" => "#,##0.00"),
			    array( "iStyle"=>$styleArrayBold,"index"=>"J",    "key"=>"Class_All_360",   	"name"=>"总用户数",    	 	"width" => 14),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"K",    "key"=>"SmallTransNum",    	"name"=>"成交订单",		"width" => 14),
				array( "iStyle"=>$styleArrayBold,"index"=>"L",    "key"=>"SmallTransIsNew",    		    "name"=>"新单数",		"width" => 14),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"M",    "key"=>"SmallTransNumAvg",     "name"=>"人均订单",		"width" => 14,"NumberFormat" => "#,##0.00"),

				array( "iStyle"=>$styleArrayBold,"index"=>"N",    "key"=>"Class_A0_360",         "name"=>"A0类用户总数",		"width" => 14),
			    array( "iStyle"=>$styleArrayBold,"index"=>"O",    "key"=>"Ratio_A0_360",    	  	 "name"=>"A0类用户占比",		"width" => 14,"NumberFormat" => "#,##0.00"),

				array( "iStyle"=>$styleArrayBold,"index"=>"P",    "key"=>"Class_A_All_360",    	     "name"=>"A类用户总数",		"width" => 14),	
			    array( "iStyle"=>$styleArrayBold,"index"=>"Q",    "key"=>"Ratio_A_All_360",   		  "name"=>"A类用户占比",		    "width" => 14,"NumberFormat" => "#,##0.00"),
			    
			    array( "iStyle"=>$styleArrayBold,"index"=>"R",    "key"=>"Class_B_360",   	 	  "name"=>"B类用户总数",		    "width" => 14),
			    array( "iStyle"=>$styleArrayBold,"index"=>"S",    "key"=>"Ratio_B_360",    		    "name"=>"B类用户占比",		"width" => 14,"NumberFormat" => "#,##0.00"),

			    array( "iStyle"=>$styleArrayBold,"index"=>"T",    "key"=>"Class_B1_360",    		"name"=>"用户成熟度B1",    	 	"width" => 14  ),
			    array( "iStyle"=>$styleArrayBold,"index"=>"U",    "key"=>"Class_B2_360",    		"name"=>"用户成熟度B2",    	 	"width" => 14),
			    array( "iStyle"=>$styleArrayBold,"index"=>"V",    "key"=>"Class_B3_360",    		"name"=>"用户成熟度B3",    	 	"width" => 14  ),
			    array( "iStyle"=>$styleArrayBold,"index"=>"W",    "key"=>"Class_Bplus_360",    	"name"=>"用户成熟度B+",    	 	"width" => 14  ),
			    array( "iStyle"=>$styleArrayBold,"index"=>"X",    "key"=>"Class_B_All_360",        "name"=>"用户成熟度合计",    	 "width" => 14)
	
			    				
	        );
	        $fileName = $_GET["fynameforexcel"] . "过程类指标_18000上拽"."[". date("Y-m-d") ."].xls";
			$fileName = $tmp[20]=iconv('UTF-8','GBK',$fileName); 			
	        break;
			
		//过程类360中0-》360状态转换明细
		case 'getNewbieClassRatioChange':
	
			$keyList = array(			
			    array( "iStyle"=>$styleArrayBold,"index"=>"A",    "key"=>"UnitId",       	"name"=>"ID"),
			    array( "iStyle"=>$styleArrayBold,"index"=>"B",    "key"=>"UnitName",     	"name"=>"名称",			"width" => 12),
			    array( "iStyle"=>$styleArrayBold,"index"=>"C",    "key"=>"DeptName",     	"name"=>"部门",			"width" => 12),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"D",    "key"=>"HireDate",     	"name"=>"入职时间",		"width" => 12),
			    array( "iStyle"=>$styleArrayBold,"index"=>"E",    "key"=>"IsLeave",     	"name"=>"人员状态",		"width" => 12),
			    array( "iStyle"=>$styleArrayBold,"index"=>"F",    "key"=>"PositionName",    "name"=>"岗位",			"width" => 14),
	   
			    array( "iStyle"=>$styleArrayBold,"index"=>"G",    "key"=>"Class_E",    		 "name"=>"E类用户未转化总数",    	 "width" => 20),
			    array( "iStyle"=>$styleArrayBold,"index"=>"H",    "key"=>"Ratio_Class_E",    "name"=>"E类用户未转化占比",    	 "width" => 20 ,"NumberFormat" => "#,##0.00"),
			    array( "iStyle"=>$styleArrayBold,"index"=>"I",    "key"=>"Ratio_Hold_E",     "name"=>"E类用户未转化平均通时",    	 "width" => 24,"NumberFormat" => "#,##0.00"),
			    array( "iStyle"=>$styleArrayBold,"index"=>"J",    "key"=>"Ratio_Times_E",    "name"=>"E类用户未转化平均通次",    	 "width" => 24,"NumberFormat" => "#,##0.00"  ),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"K",    "key"=>"Class_UP_E",    		"name"=>"E类用户已转化总数",    	 "width" => 20),
			    array( "iStyle"=>$styleArrayBold,"index"=>"L",    "key"=>"Ratio_Class_UP_E",    "name"=>"E类用户已转化占比",    	 "width" => 20 ,"NumberFormat" => "#,##0.00" ),
			    array( "iStyle"=>$styleArrayBold,"index"=>"M",    "key"=>"Ratio_Hold_UP_E",     "name"=>"E类用户已转化平均通时",    	 "width" => 24,"NumberFormat" => "#,##0.00"),
			    array( "iStyle"=>$styleArrayBold,"index"=>"N",    "key"=>"Ratio_Times_UP_E",    "name"=>"E类用户已转化平均通次",    	 "width" => 24,"NumberFormat" => "#,##0.00"  ),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"O",    "key"=>"Class_D",    		 "name"=>"E类用户未转化总数",    	 "width" => 20),
			    array( "iStyle"=>$styleArrayBold,"index"=>"P",    "key"=>"Ratio_Class_D",    "name"=>"E类用户未转化占比",    	 "width" => 20  ,"NumberFormat" => "#,##0.00"),
			    array( "iStyle"=>$styleArrayBold,"index"=>"Q",    "key"=>"Ratio_Hold_D",     "name"=>"E类用户未转化平均通时",    	 "width" => 24,"NumberFormat" => "#,##0.00"),
			    array( "iStyle"=>$styleArrayBold,"index"=>"R",    "key"=>"Ratio_Times_D",    "name"=>"E类用户未转化平均通次",    	 "width" => 24  ,"NumberFormat" => "#,##0.00"),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"S",    "key"=>"Class_UP_D",    		"name"=>"D类用户已转化总数",    	 "width" => 20),
			    array( "iStyle"=>$styleArrayBold,"index"=>"T",    "key"=>"Ratio_Class_UP_D",    "name"=>"D类用户已转化占比",    	 "width" => 20  ,"NumberFormat" => "#,##0.00"),
			    array( "iStyle"=>$styleArrayBold,"index"=>"U",    "key"=>"Ratio_Hold_UP_D",     "name"=>"D类用户已转化平均通时",    	 "width" => 24,"NumberFormat" => "#,##0.00"),
			    array( "iStyle"=>$styleArrayBold,"index"=>"V",    "key"=>"Ratio_Times_UP_D",    "name"=>"D类用户已转化平均通次",    	 "width" => 24  ,"NumberFormat" => "#,##0.00"),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"W",    "key"=>"Class_C",    		 "name"=>"C类用户未转化总数",    	 "width" => 20),
			    array( "iStyle"=>$styleArrayBold,"index"=>"X",    "key"=>"Ratio_Class_C",    "name"=>"C类用户未转化占比",    	 "width" => 20  ,"NumberFormat" => "#,##0.00"),
			    array( "iStyle"=>$styleArrayBold,"index"=>"Y",    "key"=>"Ratio_Hold_C",     "name"=>"C类用户未转化平均通时",    	 "width" => 24,"NumberFormat" => "#,##0.00"),
			    array( "iStyle"=>$styleArrayBold,"index"=>"Z",    "key"=>"Ratio_Times_C",    "name"=>"C类用户未转化平均通次",    	 "width" => 24  ,"NumberFormat" => "#,##0.00"),
			    array( "iStyle"=>$styleArrayBold,"index"=>"AA",    "key"=>"Times_C_Change",    "name"=>"C类用户未转化接通率",    	 "width" => 24  ,"NumberFormat" => "#,##0.00"),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"AB",    "key"=>"Class_UP_C",    		"name"=>"C类用户已转化总数",    	 "width" => 20),
			    array( "iStyle"=>$styleArrayBold,"index"=>"AC",    "key"=>"Ratio_Class_UP_C",    "name"=>"C类用户已转化占比",    	 "width" => 20  ,"NumberFormat" => "#,##0.00"),
			    array( "iStyle"=>$styleArrayBold,"index"=>"AD",    "key"=>"Ratio_Hold_UP_C",     "name"=>"C类用户已转化平均通时",    	 "width" => 24,"NumberFormat" => "#,##0.00"),
			    array( "iStyle"=>$styleArrayBold,"index"=>"AE",    "key"=>"Ratio_Times_UP_C",    "name"=>"C类用户已转化平均通次",    	 "width" => 24  ,"NumberFormat" => "#,##0.00"),
			    array( "iStyle"=>$styleArrayBold,"index"=>"AF",      "key"=>"Times_UP_C_Change",     "name"=>"C类用户已转化接通率",    	 "width" => 24  ,"NumberFormat" => "#,##0.00"),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"AG",    "key"=>"Class_B",    		 "name"=>"B类用户未转化总数",    	 "width" => 20),
			    array( "iStyle"=>$styleArrayBold,"index"=>"AH",    "key"=>"Ratio_Class_B",    "name"=>"B类用户未转化占比",    	 "width" => 20  ,"NumberFormat" => "#,##0.00"),
			    array( "iStyle"=>$styleArrayBold,"index"=>"AI",    "key"=>"Ratio_Hold_B",     "name"=>"B类用户未转化平均通时",    	 "width" => 24,"NumberFormat" => "#,##0.00"),
			    array( "iStyle"=>$styleArrayBold,"index"=>"AJ",    "key"=>"Ratio_Times_B",    "name"=>"B类用户未转化平均通次",    	 "width" => 24  ,"NumberFormat" => "#,##0.00"),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"AK",    "key"=>"Class_UP_B",    		"name"=>"B类用户已转化总数",    	 "width" => 20),
			    array( "iStyle"=>$styleArrayBold,"index"=>"AL",    "key"=>"Ratio_Class_UP_B",    "name"=>"B类用户已转化占比",    	 "width" => 20 ,"NumberFormat" => "#,##0.00" ),
			    array( "iStyle"=>$styleArrayBold,"index"=>"AM",    "key"=>"Ratio_Hold_UP_B",     "name"=>"B类用户已转化平均通时",    	 "width" => 24,"NumberFormat" => "#,##0.00"),
			    array( "iStyle"=>$styleArrayBold,"index"=>"AN",    "key"=>"Ratio_Times_UP_B",    "name"=>"B类用户已转化平均通次",    	 "width" => 24  ,"NumberFormat" => "#,##0.00"),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"AO",    "key"=>"Class_A",   				"name"=>"A类用户总数",    	 	"width" => 14),
			    array( "iStyle"=>$styleArrayBold,"index"=>"AP",    "key"=>"Ratio_Hold_A",   		"name"=>"A类用户平均通时",    	"width" => 20,"NumberFormat" => "#,##0.00"),			    
			    array( "iStyle"=>$styleArrayBold,"index"=>"AQ",    "key"=>"Ratio_Times_A",    		"name"=>"A类用户平均通次",		"width" => 20,"NumberFormat" => "#,##0.00"),	    				
	        );
	        $fileName = $request["fynameforexcel"] . "". "0->360状态转化明细"."[". date("Y-m-d") ."]". ".xls";
			$fileName = $tmp[20]=iconv('UTF-8','GBK',$fileName); 			
	 
	  
			break;
	
		
		//过程类18000上拽	
	    case 'get18000GuoChengInfo':
	
			$keyList = array(			
			    array( "iStyle"=>$styleArrayBold,"index"=>"A",    "key"=>"Unitid",       	"name"=>"ID"),
			    array( "iStyle"=>$styleArrayBold,"index"=>"B",    "key"=>"UnitName",     	"name"=>"名称",			"width" => 12),
			    array( "iStyle"=>$styleArrayBold,"index"=>"C",    "key"=>"DeptName",     	"name"=>"部门",			"width" => 12),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"D",    "key"=>"HireDate",     	"name"=>"入职时间",		"width" => 12),
			    array( "iStyle"=>$styleArrayBold,"index"=>"E",    "key"=>"IsLeave",     	"name"=>"人员状态",		"width" => 12),
			    array( "iStyle"=>$styleArrayBold,"index"=>"F",    "key"=>"PositionName",    "name"=>"岗位",			"width" => 14),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"G",    "key"=>"Class_All_18000",   "name"=>"总用户数",		"width" => 14),
			    array( "iStyle"=>$styleArrayBold,"index"=>"H",    "key"=>"18000TransTotal",   "name"=>"成交订单",		"width" => 14),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"I",    "key"=>"Class_A_All_18000",   		"name"=>"A类合计总数",    	 	"width" => 14),
			    array( "iStyle"=>$styleArrayBold,"index"=>"J",    "key"=>"Ratio_A_All_18000",   		"name"=>"A类合计占比",    	 	"width" => 14,"NumberFormat" => "#,##0.00"),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"K",    "key"=>"Class_B_18000",    		    "name"=>"B类用户总数",		"width" => 14),
				array( "iStyle"=>$styleArrayBold,"index"=>"L",    "key"=>"Ratio_B_18000",    		    "name"=>"B类用户占比",		"width" => 14,"NumberFormat" => "#,##0.00"),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"M",    "key"=>"Class_AB_All_18000",    		    "name"=>"AB类合计总数",		"width" => 14),
				array( "iStyle"=>$styleArrayBold,"index"=>"N",    "key"=>"Ratio_AB_All_18000",    		    "name"=>"AB类合计占比",		"width" => 14,"NumberFormat" => "#,##0.00"),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"O",    "key"=>"Class_D_18000",    	  	 "name"=>"D类用户总数",		"width" => 14),
				array( "iStyle"=>$styleArrayBold,"index"=>"P",    "key"=>"Ratio_D_18000",    	     "name"=>"D类用户占比",		"width" => 14,"NumberFormat" => "#,##0.00"),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"Q",    "key"=>"Class_C_18000",   		  "name"=>"C类用户总数",		    "width" => 14),
			    array( "iStyle"=>$styleArrayBold,"index"=>"R",    "key"=>"Ratio_C_18000",   	 	  "name"=>"C类用户占比",		    "width" => 14,"NumberFormat" => "#,##0.00"),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"S",    "key"=>"Class_CD_All_18000",    		    "name"=>"CD类合计总数",		"width" => 14),
				array( "iStyle"=>$styleArrayBold,"index"=>"T",    "key"=>"Ratio_CD_All_18000",    		    "name"=>"CD类合计占比",		"width" => 14,"NumberFormat" => "#,##0.00"),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"U",    "key"=>"Class_E_18000",    		 "name"=>"E类用户总数",    	 "width" => 14),
			    array( "iStyle"=>$styleArrayBold,"index"=>"V",    "key"=>"Ratio_E_18000",    		 "name"=>"E类用户占比",    	 "width" => 14  ),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"W",    "key"=>"Class_A0_18000",    		"name"=>"A0类用户总数",		"width" => 14),
				array( "iStyle"=>$styleArrayBold,"index"=>"X",    "key"=>"Ratio_A0_18000",    		"name"=>"A0类用户占比",		"width" => 14,"NumberFormat" => "#,##0.00"),
	
			    
			    array( "iStyle"=>$styleArrayBold,"index"=>"Y",    "key"=>"Class_A1_18000",    		"name"=>"A1类用户总数",		"width" => 14),
				array( "iStyle"=>$styleArrayBold,"index"=>"Z",    "key"=>"Ratio_A1_18000",    		"name"=>"A1类用户占比",		"width" => 14,"NumberFormat" => "#,##0.00"),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"AA",    "key"=>"Class_A2_18000",    		"name"=>"A2类用户总数",		"width" => 14),
				array( "iStyle"=>$styleArrayBold,"index"=>"AB",    "key"=>"Ratio_A2_18000",    		"name"=>"A2类用户占比",		"width" => 14,"NumberFormat" => "#,##0.00"),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"AC",    "key"=>"Class_A3_18000",    		"name"=>"A3类用户总数",		"width" => 14),
				array( "iStyle"=>$styleArrayBold,"index"=>"AD",    "key"=>"Ratio_A3_18000",    		"name"=>"A3类用户占比",		"width" => 14,"NumberFormat" => "#,##0.00"),
	
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"AE",    "key"=>"Class_B1_18000",    		"name"=>"用户成熟度B1",    	 	"width" => 14  ),
			    array( "iStyle"=>$styleArrayBold,"index"=>"AF",    "key"=>"Class_B2_18000",    		"name"=>"用户成熟度B2",    	 	"width" => 14),
			    array( "iStyle"=>$styleArrayBold,"index"=>"AG",    "key"=>"Class_B3_18000",    		"name"=>"用户成熟度B3",    	 	"width" => 14  ),
			    array( "iStyle"=>$styleArrayBold,"index"=>"AH",    "key"=>"Class_Bplus_18000",    	"name"=>"用户成熟度B+",    	 	"width" => 14  ),
			    array( "iStyle"=>$styleArrayBold,"index"=>"AI",    "key"=>"Class_B1to3_All_18000",        "name"=>"用户成熟度合计",    	 "width" => 14)
			    				
	        );
	        $fileName = $_GET["fynameforexcel"] . "过程类指标_18000上拽"."[". date("Y-m-d") ."].xls";
			$fileName = $tmp[20]=iconv('UTF-8','GBK',$fileName); 			
	        break;	
	
		//结果类3600
		case 'get3600ClassInfo':	
			$keyList = array(			
			    array( "iStyle"=>$styleArrayBold,"index"=>"A",    "key"=>"Unitid",       	"name"=>"ID"),
			    array( "iStyle"=>$styleArrayBold,"index"=>"B",    "key"=>"UnitName",     	"name"=>"名称",			"width" => 12),
			    array( "iStyle"=>$styleArrayBold,"index"=>"C",    "key"=>"DeptName",     	"name"=>"部门",			"width" => 12),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"D",    "key"=>"HireDate",     	"name"=>"入职时间",		"width" => 12),
			    array( "iStyle"=>$styleArrayBold,"index"=>"E",    "key"=>"IsLeave",     	"name"=>"人员状态",		"width" => 12),
			    array( "iStyle"=>$styleArrayBold,"index"=>"F",    "key"=>"PositionName",    "name"=>"岗位",			"width" => 14),
			    array( "iStyle"=>$styleArrayBold,"index"=>"G",    "key"=>"GoodRatio",   	"name"=>"好评率(%)",			"width" => 14),
	
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"H",    "key"=>"PersonCountArg",   "name"=>"平均人数",		"width" => 14),
			    array( "iStyle"=>$styleArrayBold,"index"=>"I",    "key"=>"totalmoney"		,"name"=>"总销售额",		"width" => 14),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"J",    "key"=>"totalmoney_avg",   "name"=>"人均销售额",    	 	"width" => 14),
			    array( "iStyle"=>$styleArrayBold,"index"=>"K",    "key"=>"3600TransIsNewTotal",   "name"=>"新单数",    	 	"width" => 14,"NumberFormat" => "#,##0.00"),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"L",    "key"=>"sumHold",    "name"=>"日人均通时",		"width" => 14),
				array( "iStyle"=>$styleArrayBold,"index"=>"M",    "key"=>"CallCountArg", "name"=>"日人均通次",		"width" => 14,"NumberFormat" => "#,##0.00"),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"N",    "key"=>"CALLOUTNUM", 		"name"=>"分号(呼出)",		"width" => 14),
				array( "iStyle"=>$styleArrayBold,"index"=>"O",    "key"=>"CALLCOST",  			"name"=>"分号成本",		"width" => 14,"NumberFormat" => "#,##0.00"),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"P",    "key"=>"ProfitRatio",   	 "name"=>"投产比",		"width" => 14),
				array( "iStyle"=>$styleArrayBold,"index"=>"Q",    "key"=>"Class_All",    	 "name"=>"总用户数",		"width" => 14,"NumberFormat" => "#,##0.00"),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"R",    "key"=>"Class_A0",   	 "name"=>"A0类用户数",		    "width" => 14),
			    array( "iStyle"=>$styleArrayBold,"index"=>"S",    "key"=>"Class_B",   	  "name"=>"B类用户数",		    "width" => 14,"NumberFormat" => "#,##0.00"),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"T",    "key"=>"Class_C",    "name"=>"C类用户数",		"width" => 14),
				array( "iStyle"=>$styleArrayBold,"index"=>"U",    "key"=>"Ratio_D",    "name"=>"D类用户数",		"width" => 14,"NumberFormat" => "#,##0.00"),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"V",    "key"=>"smallOrder",    		 "name"=>"小额订单数",    	 "width" => 14),
			    				
	        );
	        $fileName = $_GET["fynameforexcel"] . "结果类指标_3600"."[". date("Y-m-d") ."].xls";
			$fileName = $tmp[20]=iconv('UTF-8','GBK',$fileName); 

			break;
		//过程类3600上拽	
	    case 'get3600GuoChengInfo':
	
			$keyList = array(			
			    array( "iStyle"=>$styleArrayBold,"index"=>"A",    "key"=>"Unitid",       	"name"=>"ID"),
			    array( "iStyle"=>$styleArrayBold,"index"=>"B",    "key"=>"UnitName",     	"name"=>"名称",			"width" => 12),
			    array( "iStyle"=>$styleArrayBold,"index"=>"C",    "key"=>"DeptName",     	"name"=>"部门",			"width" => 12),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"D",    "key"=>"HireDate",     	"name"=>"入职时间",		"width" => 12),
			    array( "iStyle"=>$styleArrayBold,"index"=>"E",    "key"=>"IsLeave",     	"name"=>"人员状态",		"width" => 12),
			    array( "iStyle"=>$styleArrayBold,"index"=>"F",    "key"=>"PositionName",    "name"=>"岗位",			"width" => 14),
			    array( "iStyle"=>$styleArrayBold,"index"=>"G",    "key"=>"GoodRatio",   	"name"=>"好评率(%)",			"width" => 14),
	
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"H",    "key"=>"Class_All_3600",   "name"=>"当前用户总数",		"width" => 14),
			    array( "iStyle"=>$styleArrayBold,"index"=>"I",    "key"=>"Class_Lock_All_3600","name"=>"锁定用户数",		"width" => 14),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"J",    "key"=>"Aft_Mature_Sum",   "name"=>"售后用户成熟度总数",    	 	"width" => 14),
			    array( "iStyle"=>$styleArrayBold,"index"=>"K",    "key"=>"Aft_Mature_Avg",   "name"=>"售后用户成熟度人均",    	 	"width" => 14,"NumberFormat" => "#,##0.00"),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"L",    "key"=>"PersonNum3600",    "name"=>"成单人数",		"width" => 14),
				array( "iStyle"=>$styleArrayBold,"index"=>"M",    "key"=>"PersonNum3600_Ratio", "name"=>"成单率(%)",		"width" => 14,"NumberFormat" => "#,##0.00"),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"N",    "key"=>"TransTotal3600", 		"name"=>"成交订单",		"width" => 14),
				array( "iStyle"=>$styleArrayBold,"index"=>"O",    "key"=>"Ratio_IO",  			"name"=>"上拽率(%)",		"width" => 14,"NumberFormat" => "#,##0.00"),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"P",    "key"=>"Class_A0_3600",   	 "name"=>"A0类用户总数",		"width" => 14),
				array( "iStyle"=>$styleArrayBold,"index"=>"Q",    "key"=>"Ratio_A0_3600",    	 "name"=>"A0类用户占比",		"width" => 14,"NumberFormat" => "#,##0.00"),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"R",    "key"=>"Class_A_All_3600",   	 "name"=>"A类合计用户总数",		    "width" => 14),
			    array( "iStyle"=>$styleArrayBold,"index"=>"S",    "key"=>"Ratio_A_All_3600",   	  "name"=>"A类合计用户占比",		    "width" => 14,"NumberFormat" => "#,##0.00"),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"T",    "key"=>"Class_A1_3600",    "name"=>"A1类用户总数",		"width" => 14),
				array( "iStyle"=>$styleArrayBold,"index"=>"U",    "key"=>"Ratio_A1_3600",    "name"=>"A1类用户占比",		"width" => 14,"NumberFormat" => "#,##0.00"),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"V",    "key"=>"Class_A2_3600",    		 "name"=>"A2类用户总数",    	 "width" => 14),
			    array( "iStyle"=>$styleArrayBold,"index"=>"W",    "key"=>"Ratio_A2_3600",    		 "name"=>"A2类用户总数",    	 "width" => 14  ),
	
			    array( "iStyle"=>$styleArrayBold,"index"=>"X",    "key"=>"Class_A3_3600",    		"name"=>"A3类用户总数",		"width" => 14),
				array( "iStyle"=>$styleArrayBold,"index"=>"Y",    "key"=>"Ratio_A3_3600",    		"name"=>"A3类用户占比",		"width" => 14,"NumberFormat" => "#,##0.00"),
	
			    
			    array( "iStyle"=>$styleArrayBold,"index"=>"Z",    "key"=>"Class_B_3600",    		"name"=>"B类用户总数",		"width" => 14),
				array( "iStyle"=>$styleArrayBold,"index"=>"AA",    "key"=>"Ratio_B_3600",    		"name"=>"B类用户占比",		"width" => 14,"NumberFormat" => "#,##0.00"),
	
		
			    array( "iStyle"=>$styleArrayBold,"index"=>"AB",    "key"=>"Class_B1_3600",    		"name"=>"用户成熟度B1",    	 	"width" => 14  ),
			    array( "iStyle"=>$styleArrayBold,"index"=>"AC",    "key"=>"Class_B2_3600",    		"name"=>"用户成熟度B2",    	 	"width" => 14),
			    array( "iStyle"=>$styleArrayBold,"index"=>"AD",    "key"=>"Class_B3_3600",    		"name"=>"用户成熟度B3",    	 	"width" => 14  ),
			    array( "iStyle"=>$styleArrayBold,"index"=>"AE",    "key"=>"Class_Bplus_3600",    	"name"=>"用户成熟度B+",    	 	"width" => 14  ),
			    array( "iStyle"=>$styleArrayBold,"index"=>"AF",    "key"=>"Class_B1to3_All_3600",        "name"=>"用户成熟度合计",    	 "width" => 14)
			    				
	        );
	        $fileName = $_GET["fynameforexcel"] . "过程类指标_3600上拽"."[". date("Y-m-d") ."].xls";
			$fileName = $tmp[20]=iconv('UTF-8','GBK',$fileName); 			
	        break;	
					
	    default:
	        echo "内部错误";
	        exit();
	        
	}
	$tmp1=$data['data']['stdata'];
	$tmp2=$data['data']['data']['data'];

	$groupData=array_merge($tmp1,$tmp2);		

	$data = $groupData;
	
	include_once ("download.php");
	 
	
	//    out_file('',"xls",$fileName);
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->setActiveSheetIndex(0);
	$sheet = $objPHPExcel->getActiveSheet();
	_makeTitle($sheet,$keyList);
	
	
	for ($i=1;$i<=count($data);$i++){
		foreach ($data[$i-1] as $key => $value) {
			switch ($key){
				case 'PersonId':
					if($data[$i-1]['PersonId']=='' || $data[$i-1]['PersonId']==null){
						if($i-1==0)
							$data[$i-1]['PersonId']='合计';
						else if($i-1==1)
							$data[$i-1]['PersonId']='平均';
					}
					break;
				case 'PersonName':
					if($data[$i-1]['PersonName']=='' || $data[$i-1]['PersonName']==null){
						$data[$i-1]['PersonName']='--';
					}
					break;					
				case 'HireDate' :
					if($data[$i-1]['HireDate']=='' || $data[$i-1]['HireDate']==null){
						$data[$i-1]['HireDate']='--';
					}
					break;				
				case 'PositionName' :
					if($data[$i-1]['PositionName']=='' || $data[$i-1]['PositionName']==null){
						$data[$i-1]['PositionName']='--';
					}
					break;								
				case 'DeptName' :
					if($data[$i-1]['DeptName']=='' || $data[$i-1]['DeptName']==null){
						$data[$i-1]['DeptName']='--';
					}
					break;					
	    	}			
		}
	
	
	    _makeLine($sheet,$keyList,$data[$i-1],$i+1);
	
	}
	
	
	
	$objPHPExcel->setActiveSheetIndex(0);
	
	$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
	
	$tempFilePath ="/tmp/".$fileName.".xls";
	$objWriter->save($tempFilePath);
	
	out_file($tempFilePath,"xls",$fileName);

}

?>
