<?php

/* salesPerformanceWebMssqlDB.php - mssql database interface */

/* Copyright (c) 2011 by Compass.cn, P.R.China */

/*
modification history
--------------------
2012/08/03, Zhou Ke, create
*/
include_once "PublicFunction.php";
include_once "functions.php";
include_once "valueFormat.php";


class webnerveMssqlDB extends PublicFunction
{
	function getData($request,&$retArray){
		$rand=rand(1,100000000);		
		$toCrmIdUrl=$request['url'].'?cmd='.$request['command'].
					'&type='.$request['type'].
					'&id='.$request['id'].
					'&startDate='.$request['startDate'].
					'&endDate='.$request['endDate'].
					'&cs='.$request['cs'].
					'&sourceType='.$request['sourceType'].
					'&sourceType2='.$request['sourceType2'].
					'&serviceLevelId='.$request['serviceLevelId'].
				
					'&personlist='.$request['personlist'].
					'&deptList='.$request['deptList'].
					'&positionList='.$request['positionList'].
					'&zbList='.$request['zbList'].
					'&ClassName='.$request['ClassName'].
					'&rand='.$rand;



            
		$crmIdData=file(trim($toCrmIdUrl));
	
        
		//print_r(str_replace("red","pink",$arr,$i));
    
      

		
		$crmAttay=json_decode($crmIdData[0],true);

       /*
        echo '<pre>';
            print_r($crmIdData[0]);
        echo '</pre>';
        die();
//*/

      

		//20141211日因为权限系统修改，把组长和经理后面全加上了“（销售部）”,前台所有页面都用这个判断是不是变颜色，太多了！这里偷懒了。
		foreach ($crmAttay['data']['data']['data'] as &$value) {
			$value['PositionName']=str_replace("(销售部)","",$value['PositionName']);
		}
		

		$retArray=$crmAttay;
		

	}

	function resultKPIDataGet($request,&$retArray){
		$nowDate=date('Ymd');
		$startDate=$request['startDate'];
		$endDate=$request['endDate'];

		if($nowDate<$endDate){
			$dayNum=$this->workDayNum($startDate,$nowDate);
		}else{
			$dayNum=$this->workDayNum($startDate,$endDate);			
		}

		switch ($request['whichResult']) {
			case 0:
				$storeName='[dbo].[P_WebNerve_itservice__ActAnalysisWeb_ResultKPI_newTransStage_Data_Get]';				
				break;
			case 1:
				$storeName='[dbo].[P_WebNerve_itservice__ActAnalysisWeb_ResultKPI_updateTransStage_Data_Get]';
				break;			
			default:
				$storeName='[dbo].[P_WebNerve_itservice__ActAnalysisWeb_ResultKPI_newTransStage_Data_Get]';
				break;
		}

		$paraList=array(
			"OpId"        	=> array(iconv('utf-8','GBK',$request['personid']),SQLINT4,16),
			"id"			=> array($request['id'],SQLINT4,16),
			"type"			=> array($request['type'],SQLVARCHAR,8),
			"level"			=> array($request['level'],SQLINT4,16),
			"region"		=> array($request['region'],SQLINT4,16),
			"dfrom"			=> array($request['startDate'],SQLVARCHAR,8),
			"dto"			=> array($request['endDate'],SQLVARCHAR,8),
			"level"			=> array($request['level'],SQLINT4,16),
			"cs"			=> array($request['cs'],SQLINT4,16),
			"actId"			=> array($request['actId'],SQLINT4,16),
			"ErrMsg"		=> array('',SQLVARCHAR,1000,TRUE)
		);

		



	    $this->sqlExec("SET ANSI_NULLS ON; SET ANSI_WARNINGS ON");
				
		$ret=$this->procCall_ext($storeName, $paraList,true,$items,MSSQL_ASSOC);
		

        $this->sqlExec("SET ANSI_NULLS OFF; SET ANSI_WARNINGS OFF");
		
		
		$dataCount=count($items[1]);
		for($i=0;$i<$dataCount;$i++){
			$items[1][$i]['UnitName']=iconv('GBK','utf-8',$items[1][$i]['UnitName']);
			$items[1][$i]['DeptName']=iconv('GBK','utf-8',$items[1][$i]['DeptName']);
			$items[1][$i]['PositionName']=iconv('GBK','utf-8',$items[1][$i]['PositionName']);
			if($request['cs']!=1){
				$items[1][$i]['sumHold']=($items[1][$i]['PersonCnt']==0 ? 0 : $items[1][$i]['sumHold']/$items[1][$i]['PersonCnt']/$dayNum);	
			}else{
				$items[1][$i]['sumHold']=$items[1][$i]['sumHold']/$dayNum;					
			}
						
		}

		$stdata=$this->resultTotal($items[0],$dayNum);
		/*
		$dataCount=count($items[0]);
		for($j=0;$j<$dataCount;$j++){
			$items[0][$j]['UnitName']=iconv('GBK','utf-8',$items[0][$j]['UnitName']);
			$items[0][$j]['DeptName']=iconv('GBK','utf-8',$items[0][$j]['DeptName']);
			$items[0][$j]['PositionName']=iconv('GBK','utf-8',$items[0][$j]['PositionName']);
			$items[0][$j]['sumHold']=$items[0][$j]['sumHold']/$items[0][$j]['PersonCnt']/$dayNum;				
		}
		*/

		$retArray=array(
			'stdata'=>$stdata,
			'data'	=>array(
				'count'=>count($items[1]),
				'data' =>$items[1]
			)
		);


		$errmsg=iconv('GBK','utf-8',$paraList['ErrMsg'][0]);
        if($ret!='OK' || $errmsg!='OK'){
            return $errmsg;
        }
	   							
        return 'OK';
	}

	function resultTotal(&$data,$dayNum){
		$tempData[0]=array();
		$tempData[0]=array(
			'rowId'				=>1,
			'UnitId'			=>-1,
			'UnitName'  		=>'所有',
			'RegionType'		=>0,
			'IsLeave'			=>'',
			'HireDate'			=>'',
			'LeaveDate'			=>'',
			'practiceEndDate'	=>'',
			'PositionName'		=>'',
			'DeptName'			=>'',
			'sumHold'			=>0,
			'Class_All'			=>0,
			'Class_A0'			=>0,
			'Class_C'			=>0,//上拽用指标
			'Class_B'			=>0,//上拽用指标
			'Class_C_Change'	=>0,//0to360用指标
			'Class_B_Change'	=>0,//0to360用指标
			'smallOrder'		=>0,
			'middleOrder'		=>0,
			'advanceOrder'		=>0
		);
		$dataCount=count($data);
		for($i=0;$i<$dataCount;$i++){
			$data[$i]['UnitName']=iconv('GBK','utf-8',$data[$i]['UnitName']);
			$data[$i]['DeptName']=iconv('GBK','utf-8',$data[$i]['DeptName']);
			$data[$i]['PositionName']=iconv('GBK','utf-8',$data[$i]['PositionName']);
			

			$data[$i]['sumHold']=$data[$i]['sumHold']/$data[$i]['PersonCnt']/$dayNum;
			$tempData[0]['sumHold']+=$data[$i]['sumHold'];
			$tempData[0]['Class_All']+=$data[$i]['Class_All'];			
			$tempData[0]['Class_A0']+=$data[$i]['Class_A0'];
			$tempData[0]['Class_C']+=$data[$i]['Class_C'];
			$tempData[0]['Class_B']+=$data[$i]['Class_B'];
			$tempData[0]['Class_C_Change']+=$data[$i]['Class_C_Change'];
			$tempData[0]['Class_B_Change']+=$data[$i]['Class_B_Change'];
			$tempData[0]['smallOrder']+=$data[$i]['smallOrder'];
			$tempData[0]['middleOrder']+=$data[$i]['middleOrder'];
			$tempData[0]['advanceOrder']+=$data[$i]['advanceOrder'];
			$tempData[$i+1]=$data[$i];
		}
		
		$tempData[0]['sumHold']=$dataCount==0 ? 0 : $tempData[0]['sumHold']/$dataCount;
	
		return $tempData;		
	}

	function getNewbieClassRatioChange($request, &$retArray){
		$procName = '[DB_CompanyData].[dbo].[P_Itservice__NewbieClass_Interface_Change]';
		$aParam	= array(
			'opid'	=> array($request['WnPersonId'], SQLINT4),
			'errmsg'=> array('', SQLVARCHAR, 1024, true),
			'cmd'=> array($request['selectType'], SQLINT4, 16),
			'type'	=> array($request['Type'], SQLVARCHAR, 64),
			'id'	=> array($request['ID'], SQLINT4),
			'page'	=> array($request['page'], SQLINT4),
			'limit'	=> array($request['limit'], SQLINT4),
			'total'	=> array(0, SQLINT4, 0, true),
			'sort'	=> array($request['sort'], SQLVARCHAR, 512),
			'dir'	=> array($request['dir'], SQLVARCHAR, 4)
		);
		//$this->sqlExec('SET ANSI_NULLS ON; SET ANSI_WARNINGS ON'); 
		$retCode = $this->procCall_ext($procName, $aParam, true, $resultSet, MSSQL_ASSOC);
		//$this->sqlExec('SET ANSI_NULLS OFF; SET ANSI_WARNINGS OFF');  
		
		if ($retCode !== 'OK' || $aParam['errmsg'][0] !== 'OK') {
			return array(
				'result' => 'ERROR',
				'data'	 => iconv('GBK', 'UTF-8', $aParam['errmsg'][0])
			);
		}
		if (!$resultSet[0]) {
			$resultSet = array(
				array(),
				array()
			);
		}
		foreach ($resultSet[0] as &$row) {
			$row["UnitName"] = iconv('GBK', 'UTF-8', $row["UnitName"]);
			$row["PositionName"] = iconv('GBK', 'UTF-8', $row["PositionName"]);
			$row["DeptName"] = iconv('GBK', 'UTF-8', $row["DeptName"]);
		}
		unset($row);
		foreach ($resultSet[1] as &$row) {
			$row["UnitName"] = iconv('GBK', 'UTF-8', $row["UnitName"]);
		}
		unset($row);

		return array(
			'result' => 'OK',
			'data'	 => array(
				'count'	=> $aParam['total'][0],
				'data'	=> $resultSet[0]
			),
			'stdata' => $resultSet[1]
		);	
	}
	
	//获取销售成本信息 CaoJun add 2013-06-05
	function getSaleCost($rq, &$retArray){		
		$storedName = "DB_CompanyData.dbo.[P_WebNerve_itservice__SaleCost_Get]";        
        $paraList = array(
            "OpId" => array(0, SQLINT4, 16),
            "ErrMsg" => array('', SQLVARCHAR, 1000, true),           
            "PersonId" => array($rq['id'], SQLINT4, 16)                                
   		);               
        $ret = $this->procCall_ext($storedName, $paraList, true, $retArray, MSSQL_ASSOC);                                     
        $errmsg = $paraList['ErrMsg'][0];
        if ($ret != 'OK' || $errmsg != 'OK'){
            return $errmsg;
        }
        for ($i = 0; $i< count($retArray[0]); $i++ ){
        	$retArray[0][$i]["PersonName"] = iconv('GBK', 'UTF-8', $retArray[0][$i]["PersonName"]);         	
        }
        $json = array(
            'result' => 'OK',
            'data' => $retArray[0]
        ); 
        $retArray = $json;                         
        return 'OK';	
	}
	
	//获取售前成熟度信息 CaoJun add 2013-09-26
	function getPreMatureDataInfo($rq, &$retArray){		
		$storedName = "DB_CompanyData.dbo.[P_Table_DataSystem_Pre_MatureData_Info_Get]";        
        $paraList = array(
            "OpId" => array(0, SQLINT4, 16),
            "ErrMsg" => array('', SQLVARCHAR, 1000, true),           
            "startDate" => array($rq['startDate'], SQLVARCHAR, 20), 
            "endDate" => array($rq['endDate'], SQLVARCHAR, 20),
            "sourceType" => array($rq['sourceType'], SQLINT4, 16),
            "selectType" => array($rq['selectType'], SQLINT4, 16),
            "Unitid" => array($rq['Unitid'],  SQLINT4, 16)                               
   		);               
        $ret = $this->procCall_ext($storedName, $paraList, true, $retArray, MSSQL_ASSOC);   
		/*
		echo '<pre>';
			print_r($paraList);
		echo '</pre>';
		die();
		  */                                
        $errmsg = $paraList['ErrMsg'][0];
        if ($ret != 'OK' || $errmsg != 'OK'){
            return $errmsg;
        }
        for ($i = 0; $i< count($retArray[0]); $i++ ){
        	$retArray[0][$i]["UnitName"] = iconv('GBK', 'UTF-8', $retArray[0][$i]["UnitName"]);         	
        }
        
        $ret = array();
        $ret['data'] = array(
            'count' => count($retArray[0]),
            'data' => $retArray[0]          
        );
        $json = array(
            'result' => 'OK',
            'data' => $ret
        ); 
        $retArray = $json;                          
        return 'OK';	
	}
	
	//获取售后成熟度信息 CaoJun add 2013-09-26
	function getAftMatureDataInfo($rq, &$retArray){		
		$storedName = "DB_CompanyData.dbo.[P_Table_DataSystem_Aft_MatureData_Info_Get]";        
        $paraList = array(
            "OpId" => array(0, SQLINT4, 16),
            "ErrMsg" => array('', SQLVARCHAR, 1000, true),           
            "startDate" => array($rq['startDate'], SQLVARCHAR, 20), 
            "endDate" => array($rq['endDate'], SQLVARCHAR, 20),
            "sourceType" => array($rq['sourceType'], SQLINT4, 16),
            "selectType" => array($rq['selectType'], SQLINT4, 16),
            "Unitid" => array($rq['Unitid'],  SQLINT4, 16)                               
   		);               
        $ret = $this->procCall_ext($storedName, $paraList, true, $retArray, MSSQL_ASSOC);                                     
        $errmsg = $paraList['ErrMsg'][0];
        if ($ret != 'OK' || $errmsg != 'OK'){
            return $errmsg;
        }
        for ($i = 0; $i< count($retArray[0]); $i++ ){
        	$retArray[0][$i]["UnitName"] = iconv('GBK', 'UTF-8', $retArray[0][$i]["UnitName"]);         	
        }
        
        $ret = array();
        $ret['data'] = array(
            'count' => count($retArray[0]),
            'data' => $retArray[0]          
        );
        $json = array(
            'result' => 'OK',
            'data' => $ret
        ); 
        $retArray = $json;                         
        return 'OK';	
	}
	
	//获取18000售后成熟度信息 CaoJun add 2013-10-12
	function getAft18000MatureDataInfo($rq, &$retArray){	
        $storedName = "DB_CompanyData.dbo.[P_Table_DataSystem_Aft18000_MatureData_Info_Get]";        
        $paraList = array(
            "OpId" => array(0, SQLINT4, 16),
            "ErrMsg" => array('', SQLVARCHAR, 1000, true),           
            "startDate" => array($rq['startDate'], SQLVARCHAR, 20), 
            "endDate" => array($rq['endDate'], SQLVARCHAR, 20),
            "sourceType" => array($rq['sourceType'], SQLINT4, 16),
            "selectType" => array($rq['selectType'], SQLINT4, 16),
            "Unitid" => array($rq['Unitid'],  SQLINT4, 16)                               
        );
        $ret = $this->procCall_ext($storedName, $paraList, true, $retArray, MSSQL_ASSOC);    
		/*
		echo '';
			print_r($retArray);
		
		echo '';
		die();
		  */                               
        $errmsg = $paraList['ErrMsg'][0];
        if ($ret != 'OK' || $errmsg != 'OK'){
            return $errmsg;
        }
        for ($i = 0; $i< count($retArray[0]); $i++ ){
        	$retArray[0][$i]["UnitName"] = iconv('GBK', 'UTF-8', $retArray[0][$i]["UnitName"]);         	
        }
        $ret = array();
        $ret['data'] = array(
            'count' => count($retArray[0]),
            'data' => $retArray[0]          
        );
        $json = array(
            'result' => 'OK',
            'data' => $ret
        );
        $retArray = $json;                         
        return 'OK';	
	}
    
    //获取现货成熟度信息 CaoJun add 2013-12-26
	function getSpotMatureDataInfo($rq, &$retArray){		
        $storedName = "DB_CompanyData.dbo.[P_Table_DataSystem_Spot_MatureData_Info_Get]";        
        $paraList = array(
            "OpId" => array(0, SQLINT4, 16),
            "ErrMsg" => array('', SQLVARCHAR, 1000, true),           
            "startDate" => array($rq['startDate'], SQLVARCHAR, 20), 
            "endDate" => array($rq['endDate'], SQLVARCHAR, 20),
            "sourceType" => array($rq['sourceType'], SQLINT4, 16),
            "selectType" => array($rq['selectType'], SQLINT4, 16),
            "Unitid" => array($rq['Unitid'],  SQLINT4, 16)                               
        );
        $ret = $this->procCall_ext($storedName, $paraList, true, $retArray, MSSQL_ASSOC);                                     
        $errmsg = $paraList['ErrMsg'][0];
        if ($ret != 'OK' || $errmsg != 'OK'){
            return $errmsg;
        }
        for ($i = 0; $i< count($retArray[0]); $i++ ){
        	$retArray[0][$i]["UnitName"] = iconv('GBK', 'UTF-8', $retArray[0][$i]["UnitName"]);         	
        }
        $ret = array();
        $ret['data'] = array(
            'count' => count($retArray[0]),
            'data' => $retArray[0]          
        );
        $json = array(
            'result' => 'OK',
            'data' => $ret
        );
        $retArray = $json;                         
        return 'OK';	
	}
	
	
	//获取现货游戏成熟度信息 周克add 2014-03-18
	function getSpotGameMatureDataInfo($rq, &$retArray){		
        $storedName = "DB_CompanyData.dbo.[P_Table_DataSystem_SpotGame_MatureData_Info_Get]";        
        $paraList = array(
            "OpId" => array(0, SQLINT4, 16),
            "ErrMsg" => array('', SQLVARCHAR, 1000, true),           
            "startDate" => array($rq['startDate'], SQLVARCHAR, 20), 
            "endDate" => array($rq['endDate'], SQLVARCHAR, 20),
            "selectType" => array($rq['selectType'], SQLINT4, 16),
            "Unitid" => array($rq['Unitid'],  SQLINT4, 16)                               
        );
        $ret = $this->procCall_ext($storedName, $paraList, true, $retArray, MSSQL_ASSOC);                                     
        $errmsg = $paraList['ErrMsg'][0];
        if ($ret != 'OK' || $errmsg != 'OK'){
            return $errmsg;
        }
        for ($i = 0; $i< count($retArray[0]); $i++ ){
        	$retArray[0][$i]["UnitName"] = iconv('GBK', 'UTF-8', $retArray[0][$i]["UnitName"]);         	
        }
        $ret = array();
        $ret['data'] = array(
            'count' => count($retArray[0]),
            'data' => $retArray[0]          
        );
        $json = array(
            'result' => 'OK',
            'data' => $ret
        );
        $retArray = $json;                         
        return 'OK';	
	}


	function getPersonHistoryData($request, &$retArray){
		
        $storedName = "DB_webNerveData.dbo.[P_ActAnalysisWeb_Person_History_Data_Get]";        
        $paraList = array(
    		"OpId"   => array($request['personid'],SQLINT4,16),        
            "ActType" => array($request['ActType'], SQLINT4, 16), 
            "PersonId" => array($request['PersonId'], SQLINT4, 16),
         	"ErrMsg" => array('', SQLVARCHAR, 1000, true),                    
        );
        $ret = $this->procCall_ext($storedName, $paraList, true, $item, MSSQL_ASSOC);                                     

		
		if(count($item[0])){
			foreach ($item[0] as $key => &$value) {
				foreach ($value as &$v) {
					$v=iconv('GBK','UTF-8',$v);
				}
			}
		}
		
   		$retArray=array(
 			'result' => 'OK',
 			'data'	 => $item[0]
		);             
    		
		
        $errmsg = $paraList['ErrMsg'][0];
        if ($ret != 'OK' || $errmsg != 'OK'){
            return iconv('GBK', 'UTF-8',$errmsg );
        }
	
	    return 'OK';	
	}
	
	function getDeptHistoryData($request, &$retArray){
		
        $storedName = "DB_webNerveData.dbo.[P_ActAnalysisWeb_Dept_History_Data_Get]";        
        $paraList = array(
    		"OpId"   => array($request['personid'],SQLINT4,16),        
            "ActType" => array($request['ActType'], SQLINT4, 16), 
            "DeptId" => array($request['DeptId'], SQLINT4, 16),
         	"DeptType" => array($request['DeptType'], SQLVARCHAR, 20),
         	"ErrMsg" => array('', SQLVARCHAR, 1000, true),                    
        );
        $ret = $this->procCall_ext($storedName, $paraList, true, $item, MSSQL_ASSOC);                                     


		
        $errmsg = $paraList['ErrMsg'][0];
        if ($ret != 'OK' || $errmsg != 'OK'){
            return iconv('GBK', 'UTF-8',$errmsg );
        }
		
		if(count($item[0])){
			foreach ($item[0] as $key => &$value) {
				foreach ($value as &$v) {
					$v=iconv('GBK','UTF-8',$v);
				}
			}
		}
		
   		$retArray=array(
 			'result' => 'OK',
 			'data'	 => $item[0]
		);             
        return 'OK';	
	}
	
	function getPersonSynRankingData($request, &$retArray){

	    $storedName = "DB_webNerveData.dbo.[P_ActAnalysisWeb_SynRanking_Person_DetailData_Get]";        
        $paraList = array(
    		"OpId"   => array($request['personid'],SQLINT4,16),        
            "ActType" => array($request['ActType'], SQLINT4, 16), 
            "PersonId" => array($request['PersonId'], SQLINT4, 16),
    		"sdate"	   => array($request['sdate'], SQLVARCHAR, 8),
	     	"ErrMsg" => array('', SQLVARCHAR, 1000, true),                    
        );
        $ret = $this->procCall_ext($storedName, $paraList, true, $item, MSSQL_ASSOC);                                     

		$history=$item[0];
		$today=$item[1];
		/*
			
		 * UnifSynRankingAvgScore:历史用来比较的列（一般为TotalMoney,要是没有历史成绩就有当期的列）
		 * UnifAvgScore:当前用哪个列(有totalmoney,Class_B等)
		    
		*/
		$historyCount=count($history);
		if($historyCount>0){
			foreach ($history as &$value) {
				if($value['IsSum']==1){
					$value['UnifSynRankingAvgScore']=round($value[$request['UnifSynRankingAvgScore']],2);
					$value['UnifAvgScore']=round($today[0][$request['Key']],2);
					$value['Diff']=round($today[0][$request['Key']]-$value[$request['UnifSynRankingAvgScore']],2);
					$value['ActId']='-';
				}else{
					$value['UnifSynRankingAvgScore']=round($value[$request['UnifSynRankingAvgScore']],2);
					$value['UnifAvgScore']='-';
					$value['Diff']='-';			
				}
			}			
		}else{
			//没有历史成绩的人，我就手工用当期造一条给他
			$history[]=array(
				'PersonId'=>$today[0]['PersonId'],
				'ActType' =>$today[0]['ActType'],
				'UnifSynRankingAvgScore' => round($today[0][$request['Key']],2),
				'ActId'=>'-',
				'UnifAvgScore'=>round($today[0][$request['Key']],2),
				'Diff'	=>'0.00',
				'IsSum' =>1,
				'IsHistory' =>1,
				'StartDate' =>'-',
				'EndDate' =>'-',
				'ActName' =>'-'
			);

			
		}

		unset($value);
		
		if($historyCount>0){
			foreach ($history as $key => &$value) {
				foreach ($value as &$v) {
					$v=iconv('GBK','UTF-8',$v);
				}
			}
		}
		
   		$retArray=array(
 			'result' => 'OK',
 			'data'	 => $history
		);      
		
		


        $errmsg = $paraList['ErrMsg'][0];
        if ($ret != 'OK' || $errmsg != 'OK'){
            return iconv('GBK', 'UTF-8',$errmsg );
        }
		

        return 'OK';	
	}
	
	
	function getDeptSynRankingData($request, &$retArray){
		
        $storedName = "DB_webNerveData.dbo.[P_ActAnalysisWeb_SynRanking_Dept_DetailData_Get]";        
        $paraList = array(
    		"OpId"   => array($request['personid'],SQLINT4,16),        
            "ActType" => array($request['ActType'], SQLINT4, 16), 
            "DeptId" => array($request['DeptId'], SQLINT4, 16),
    		"sdate"	   => array($request['sdate'], SQLVARCHAR, 8),
	     	"ErrMsg" => array('', SQLVARCHAR, 1000, true),               
        );
        $ret = $this->procCall_ext($storedName, $paraList, true, $item, MSSQL_ASSOC);                                     


		
		
		$history=$item[0];
		$today=$item[1];
		
		/*
			
		 * UnifSynRankingAvgScore:历史用来比较的列（一般为TotalMoney,要是没有历史成绩就有当期的列）
		 * UnifAvgScore:当前用哪个列(有totalmoney,Class_B等)
		    
		*/
		$historyCount=count($history);
		if($historyCount>0){
			foreach ($history as &$value) {
				if($value['IsSum']==1){
					
					$value['UnifSynRankingAvgScore']=round($value[$request['UnifSynRankingAvgScore']],2);
					$value['UnifAvgScore']=round($today[0][$request['Key']],2);
					$value['Diff']=round($today[0][$request['Key']]-$value[$request['UnifSynRankingAvgScore']],2);
					$value['ActId']='-';
				}else{
					$value['UnifSynRankingAvgScore']=round($value[$request['UnifSynRankingAvgScore']],2);
					$value['UnifAvgScore']='-';
					$value['Diff']='-';			
				}
			}			
		}else{
			//没有历史成绩的人，我就手工用当期造一条给他
			$history[]=array(
				'PersonId'=>$today[0]['PersonId'],
				'ActType' =>$today[0]['ActType'],
				'UnifSynRankingAvgScore' => round($today[0][$request['Key']],2),
				'ActId'=>'-',
				'UnifAvgScore'=>round($today[0][$request['Key']],2),
				'Diff'	=>'0.00',
				'IsSum' =>1,
				'IsHistory' =>1,
				'StartDate' =>'-',
				'EndDate' =>'-',
				'ActName' =>'-'
			);					
		}

		unset($value);
		
		if($historyCount>0){
			foreach ($history as $key => &$value) {
				foreach ($value as &$v) {
					$v=iconv('GBK','UTF-8',$v);
				}
			}
		}
		
   		$retArray=array(
 			'result' => 'OK',
 			'data'	 => $history
		);   

		

		$errmsg = $paraList['ErrMsg'][0];
        if ($ret != 'OK' || $errmsg != 'OK'){
            return iconv('GBK', 'UTF-8',$errmsg );
        }           
        return 'OK';	
	}	
	
	function getObsoleteData($request, &$retArray){
		
        $storedName = "DB_webNerveData.dbo.[P_ActAnalysisWeb_Obsolete_Data_Get]";        
        $paraList = array(
    		"OpId"   => array($request['personid'],SQLINT4,16), 
    		"ActId"  => array($request['ActId'],SQLINT4,16),      
         	"errMsg" => array('', SQLVARCHAR, 1000, true),                    
        );
        $ret = $this->procCall_ext($storedName, $paraList, true, $item, MSSQL_ASSOC);                                     

/*
	echo '<pre>';
		print_r($item[0]);
	echo '</pre>';
	die();
		
//*/

		//判断数据是否要参与排序；
		#key就是取到数据的列名
		
		$list=array(
			'IsNewPerson'=>split(',',$request['personlist']),
			'DeptId'	 =>split(',',$request['deptList']),
			'PositionId'=>split(',',$request['positionList'])
		);
		
		
		$zbList=split(',',$request['zbList']);
		
		$stdata=array(              
			'SmallTrans'=>0  ,                   
			'Class_B_Change'=>0  ,      
			'sumHold'   =>0  ,                                
			'Class_A0'   =>0  ,          
			'NewTransNum'  =>0  ,              
			'callNum' =>0 ,
			'TransTotal3600' =>0 ,
			'SaleTransNum' =>0,    
			'ALLTYPE_Call_3_M'=>0,
			'ALLTYPE_ALL'=>0,         
			'Ratio_ALLTYPE_Call_3_M'=>0
		);

		//筛选数据
		foreach ($item[0] as $d) {
			if($this->isInclude($d,$list,$stdata)){			
				$tempData[]=$d;	
			}			
		}			
		unset($d);

	    $tempDataCount=count($tempData);

		$stdata['Unitid']=1;
		$stdata['UnitName']='-';
		$stdata['SmallTransRanking']='-';
		$stdata['Class_B_ChangeRanking']='-';
		$stdata['sumHoldRanking']='-';
		$stdata['PersonState']='-';
		$stdata['Class_A0Ranking']=='-';
		$stdata['NewTransNumRanking']='-';
		$stdata['callNumRanking']='-';
		$stdata['Ratio_ALLTYPE_Call_3_MRanking']='-';
		$stdata['DeptName']='-';
		$stdata['PositionName']='-';
		$stdata['HireDate']='-';
		$stdata['IsLeave']='-';
		$stdata['LeaveDate']='-';
		
		$stdata['sumHold']=round($stdata['sumHold']/$tempDataCount,2);
		$stdata['callNum']=round($stdata['callNum']/$tempDataCount,2);	
		$stdata['SmallTrans']=round($stdata['SmallTrans']/$tempDataCount,2);
		$stdata['Class_B_Change']=round($stdata['Class_B_Change']/$tempDataCount,2);
		$stdata['Class_A0']=round($stdata['Class_A0']/$tempDataCount,2);		
		$stdata['NewTransNum']=round($stdata['NewTransNum']/$tempDataCount,2);

		$stdata['TransTotal3600']=round($stdata['TransTotal3600']/$tempDataCount,2);		
		$stdata['SaleTransNum']=round($stdata['SaleTransNum']/$tempDataCount,2);
		$stdata['Ratio_ALLTYPE_Call_3_M']=$stdata['ALLTYPE_ALL']==0 ? 0 : round($stdata['ALLTYPE_Call_3_M']/$stdata['ALLTYPE_ALL']*100,2);
	
/*
	echo '<pre>';
		print_r($stdata);
	echo '</pre>';
	die();
		
//*/	
		//排序
		$this->colSort($tempData,$zbList);
		

        
	
        $errmsg = $paraList['errMsg'][0];
	    if ($ret != 'OK' || $errmsg != 'OK'){
            return iconv('GBK', 'UTF-8',$errmsg );
        }
        
   
		
		if($tempDataCount>0){
			foreach ($tempData as $key => &$value) {
				foreach ($value as &$v) {
					$v=iconv('GBK','UTF-8',$v);
				}
			}
		}
	
	/*	
		foreach ($tempData as $value) {
			$data[]=$value;
		}
	*/	
   		$retArray=array(
 			'result' => 'OK',
			'data'=>array(
				'stdata'=>array($stdata),
				'data'=>array(
					'count'=>count($tempData),
					'data'=>$tempData
				 )
			 ) 
		);     

        return 'OK';	
	}

	function isInclude($data,$list,&$stdata){		
		$isValid=true;
		foreach ($list as $key=>$value) {
			//这个条件没有选,不参与数据筛选	
			if(count($value)==0){
				continue;
			}
			$i=0; //记录是否包含在列表中。包含了变1，不包含则说明这条数据不应该参加排序
			foreach($value as $v){					
				if($data[$key]==$v){
					$i=1;	
					break;
				}
			}
			if($i==0){			
				$isValid=false;	
				return $isValid;
			}
		}
		
		unset($key);
		unset($value);
		unset($v);


		foreach ($stdata as $key => &$value) {
			$value+=$data[$key];
		}
		
/*
	echo '<pre>';
		print_r($stdata);
	echo '</pre>';
	die();
		
//*/		
		unset($key);
		unset($value);
				
		return $isValid;
	}
	
	function colSort(&$data,$list){
		$dataCount=count($data);	
		$goodNum=floor($dataCount*0.2);
		$badNum=floor($dataCount*0.8)+1;



		foreach ($list as $v2) {
			foreach ($data as $k1=>$v1) {
				$d[$v2][$k1]=$v1[$v2.'Ranking'];	
			}			
			asort($d[$v2]);
			//生成排序index
			$Rank=1;
			foreach ($d[$v2] as $k => $v3) {
				$f[$v2][]=$k;
				$data[$k][$v2.'Ranking']=$Rank;
				$Rank++;
			}			
		}		
		unset($v1);
		unset($v2);
		

		
		//优秀
		/*
		  第一个zblist：前20%为优秀，后20%为回炉，如果各项都是后20%则淘汰。
		  
		 */
		
		for($i=0;$i<$goodNum;$i++){
			$data[$f[$list[0]][$i]]['PersonState']=1;
		}	
		
		//回炉或淘汰
		$j=0;
		foreach ($f as $key => $value) {
			for($i=$badNum;$i<$dataCount;$i++){
				$Temptaotai[$j][]=$value[$i];
				//这个是回炉
				if($j==0){
					$data[$value[$i]]['PersonState']=3;
				}
			}			
			$j++;
		}
		unset($value);
	
		$TemptaotaiCount=count($Temptaotai);
		
		$taotai=$Temptaotai[0];
		for($i=1;$i<$TemptaotaiCount;$i++){
			$taotai=array_intersect($taotai,$Temptaotai[$i]);			
		}
		
		$taotaiCount=count($taotai);
		foreach ($taotai as  $value) {
			$data[$value]['PersonState']=4;
		}
		unset($value);

		        
	}

	function getActInfo($request, &$retArray){		
        $storedName = "DB_webNerveData.dbo.[P_Mission_Get_ActInfo]";        
        $paraList = array(
    		"OpId"   => array($request['personid'],SQLINT4,16),        
            "ActType" => array($request['ActType'], SQLINT4, 16), 
         	"ErrMsg" => array('', SQLVARCHAR, 1000, true),                    
        );
        $ret = $this->procCall_ext($storedName, $paraList, true, $item, MSSQL_ASSOC);                                     


		

		
		if(count($item[1])){
			foreach ($item[1] as $key => &$value) {
				foreach ($value as &$v) {
					$v=iconv('GBK','UTF-8',$v);
				}
			}
		}

	  
	    $errmsg=iconv('GBK','utf-8',$paraList['ErrMsg'][0]);
	    if($ret!='OK' || $errmsg!='OK'){
	        return $errmsg;    
	    }
		
   		$retArray=array(
 			'result' => 'OK',
 			'data'	 => $item[1]
		);             
        return 'OK';	
	}
	
	function getUpdateClassBScoreData($request, &$retArray){
		$storedName = "P_DataSystem_UsersMature_Get";        
        $paraList = array(
    		"Opid"   => array($request['personid'],SQLINT4,16),
		 	"UnitId" => array($request['UnitId'], SQLINT4, 16),
		 	"UnitType" => array($request['UnitType'], SQLINT4, 16),        
            "NodeType" => array($request['NodeType'], SQLVARCHAR, 20),
            "Start" => array($request['start'], SQLINT4, 16),
            "End" => array($request['end'], SQLINT4, 16),
            "Sort" => array($request['sort'], SQLVARCHAR, 50),
            "Order" => array($request['order'], SQLVARCHAR, 20), 
            "Total" => array(0, SQLINT4, 16,true),
         	"ErrMsg" => array('', SQLVARCHAR, 1000, true),                    
        );
        $ret = $this->procCall_ext($storedName, $paraList, true, $item, MSSQL_ASSOC);
		$data = array();
		foreach($item[0] as $i=>$tmp){
			$data[] = array();
			foreach($tmp as $key=>$value){
				$data[$i][$key] = iconv('GBK','utf-8',$tmp[$key]);	
			}
		}
		/*echo '<pre>';
		print_r($data);
		echo '</pre>';
		die();*/
		$errmsg=iconv('GBK','utf-8',$paraList['ErrMsg'][0]);
	    if($ret!='OK' || $errmsg!='OK'){
	        $retArray=array(
	 			'result' =>$errmsg,
	 			'data'	 =>array(),
	 			'count' =>0
			);    
	    }else{
			$retArray=array(
	 			'result' => 'OK',
	 			'data'	 => $data,
	 			'count' =>$paraList['Total'][0]
			);
		}            
        return 'OK';
	}
    function getClass_B_Chart($request, &$retArray){
   
        $storedName = "DB_companyData.dbo.[P_DataSystem_Class_B_ChartData_Get]";        
        $paraList = array(
            "OpId"   => array($request['personid'],SQLINT4,16),        
            "startDate" => array($request['startDate'], SQLINT4, 16), 
            "endDate" => array($request['endDate'], SQLINT4, 16),
            "unitId" => array($request['unitId'], SQLINT4, 16),
            "unitType" => array($request['unitType'], SQLINT4, 16),
            "sourceId" => array($request['sourceId'], SQLINT4, 16),             
            "ErrMsg" => array('', SQLVARCHAR, 1000, true),                    
        );
        $ret = $this->procCall_ext($storedName, $paraList, true, $item, MSSQL_ASSOC);                                     
        
 

        
        if(count($item[0])){
            foreach ($item[0] as $key => &$value) {
                foreach ($value as &$v) {
                    $v=iconv('GBK','UTF-8',$v);
                }
            }
        }

      
        $errmsg=iconv('GBK','utf-8',$paraList['ErrMsg'][0]);
        if($ret!='OK' || $errmsg!='OK'){
            return $errmsg;    
        }
        
        $retArray=array(
            'result' => 'OK',
            'data'   => $item[0]
        );             
        return 'OK';    
    }


    function getClass_B_Chart18000($request, &$retArray){
   
        $storedName = "DB_companyData.dbo.[P_DataSystem_Class_B_ChartData_18000_Get]";        
        $paraList = array(
            "OpId"   => array($request['personid'],SQLINT4,16),        
            "startDate" => array($request['startDate'], SQLINT4, 16), 
            "endDate" => array($request['endDate'], SQLINT4, 16),
            "unitId" => array($request['unitId'], SQLINT4, 16),
            "unitType" => array($request['unitType'], SQLINT4, 16),
            "sourceId" => array($request['sourceId'], SQLINT4, 16),             
            "ErrMsg" => array('', SQLVARCHAR, 1000, true),                    
        );
        $ret = $this->procCall_ext($storedName, $paraList, true, $item, MSSQL_ASSOC);                                     
        
 

        
        if(count($item[0])){
            foreach ($item[0] as $key => &$value) {
                foreach ($value as &$v) {
                    $v=iconv('GBK','UTF-8',$v);
                }
            }
        }

      
        $errmsg=iconv('GBK','utf-8',$paraList['ErrMsg'][0]);
        if($ret!='OK' || $errmsg!='OK'){
            return $errmsg;    
        }
        
        $retArray=array(
            'result' => 'OK',
            'data'   => $item[0]
        );             
        return 'OK';    
    }

    function UpdateTransStageHistoryInfoGet($request, &$retArray){
        $storedName = "DB_companyData.[dbo].[P_DataSystem_All_UpdateTransStageHistory_Info_Get]";        
        $paraList = array(            
            "startDate" => array('', SQLVARCHAR, 1000, true),   
            "endDate" => array('', SQLVARCHAR, 1000, true)                 
        );
        $ret = $this->procCall_ext($storedName, $paraList, true, $item, MSSQL_ASSOC);                                     

        if(count($item[0])>0){
            foreach ($item[0] as &$value) {
                $value['name']=iconv('GBK','UTF-8',$value['name']);
               // $value['name'] = str_replace("\r",'',$value['name']);
                //$value['name'] = str_replace("\n",'',$value['name']);

            }            
        }
     
     
        
        $retArray=array(
            'result' => 'OK',
            'data'   => $item[0],
            'startDate'=>$paraList['startDate'][0],
            'endDate'=>$paraList['endDate'][0]
        );             
        return 'OK';          
    }

	function getActList($request,&$retArray){
		$storeName= 'P_WebNerveData_ActList_Get';

		$paraList=array(
			"Opid"      => array($request['personid'],SQLINT4,16),
			"ActType"      => array($request['ActType'],SQLINT4,16),
			"GameType"      => array($request['GameType'],SQLINT4,16),
			"ErrMsg"    => array('',SQLVARCHAR,1000,true)
		);
		$ret=$this->procCall_Ext($storeName,$paraList,true,$result,MSSQL_ASSOC);
		$errmsg=$paraList['ErrMsg'][0];
		if($ret!='OK' || $errmsg!='OK'){
			return $errmsg;
		}
		$retArray = $result[0];
	}
}     
     
?>
