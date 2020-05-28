<?php
include_once "PublicFunction.php";
//可以调用的函数

class webnerveMssqlDB extends PublicFunction{
	//获取所有的Z币任务
	function getAllProcess($request, &$retArray){
		$storeName = 'P_Person_ControlCenter_Mission_All_get';
		$paraList = array(
			"Opid"      => array($request['personid'],SQLINT4,16),
			"ActId"	=> array($request['actid'],SQLINT4,16),
			"Source"	=> array($request['source'],SQLVARCHAR,100),
			"Sdate"	=> array($request['sdate'],SQLINT4,16),
			"Edate"	=> array($request['edate'],SQLINT4,16),
			"Start"     => array($request['start'],SQLINT4,16),
			"End"       => array($request['end'],SQLINT4,16),
			"Sort"      => array($request['sort'],SQLVARCHAR,100),
			"Direct"    => array($request['order'],SQLVARCHAR,100),
			"Total"    => array('',SQLINT4,16,true ),
			"ErrMsg"    => array('',SQLVARCHAR,1000,true )
		);
		$ret = $this->procCall_Ext($storeName, $paraList, true, $items, MSSQL_ASSOC);
		if($paraList['Total'][0] == 0){
		$items[0] = array();
	};
		$retArray = array(
			'Total' =>$paraList['Total'][0],
			'data'  =>$items[0],
		);
		$errmsg=$paraList['ErrMsg'][0];
		if($ret!='OK' || $errmsg!='OK'){
			return $errmsg;
		}
		return 'OK';
	}

	function addProcess($request,&$retArray){
		$storeName = 'P_Person_ControlCenter_Mission_add';
		$paraList = array(
			"Opid"      => array($request['personid'],SQLINT4,16),
			"Source"	=> array($request['source'],SQLVARCHAR,100),
			"StartDate"	=> array($request['sdate'],SQLINT4,16),
			"EndDate"	=> array($request['edate'],SQLINT4,16),
			"Value"	=> array($request['value'],SQLINT4,16),
			"Money"	=> array($request['money'],SQLINT4,16),
			"MissionName"	=> array($request['missionname'],SQLVARCHAR,1024),
			"ActId"	=> array($request['actid'],SQLINT4,16),
			"DisplayStartDate"	=> array($request['display_sdate'],SQLINT4,16),
			"DisplayEndDate"	=> array($request['display_edate'],SQLINT4,16),
			"ErrMsg"    => array('',SQLVARCHAR,1000,true )
		);
		$ret = $this->procCall_Ext($storeName, $paraList, true, $items, MSSQL_ASSOC);
		$errmsg=$paraList['ErrMsg'][0];
		if($ret!='OK' || $errmsg!='OK'){
			return $errmsg;
		}
		return 'OK';
	}

	function updateProcess($request,&$retArray){
		$storeName = 'P_Person_ControlCenter_Mission_update';
		$paraList = array(
			"Opid"      => array($request['personid'],SQLINT4,16),
			"MissionId"      => array($request['missionid'],SQLINT4,16),
			"Source"	=> array($request['source'],SQLVARCHAR,100),
			"StartDate"	=> array($request['sdate'],SQLINT4,16),
			"EndDate"	=> array($request['edate'],SQLINT4,16),
			"Value"	=> array($request['value'],SQLINT4,16),
			"Money"	=> array($request['money'],SQLINT4,16),
			"MissionName"	=> array($request['missionname'],SQLVARCHAR,1024),
			"ActId"	=> array($request['actid'],SQLINT4,16),
			"DisplayStartDate"	=> array($request['display_sdate'],SQLINT4,16),
			"DisplayEndDate"	=> array($request['display_edate'],SQLINT4,16),
			"ErrMsg"    => array('',SQLVARCHAR,1000,true )
		);
		$ret = $this->procCall_Ext($storeName, $paraList, true, $items, MSSQL_ASSOC);
		$errmsg=$paraList['ErrMsg'][0];
		if($ret!='OK' || $errmsg!='OK'){
			return $errmsg;
		}
		return 'OK';
	}

	function deleteProcess($request,&$retArray){
		$storeName = 'P_Person_ControlCenter_Mission_delete';
		$paraList = array(
			"Opid"      => array($request['personid'],SQLINT4,16),
			"MissionId"      => array($request['missionid'],SQLINT4,16),
			"ErrMsg"    => array('',SQLVARCHAR,1000,true )
		);
		$ret = $this->procCall_Ext($storeName, $paraList, true, $items, MSSQL_ASSOC);
		$errmsg=$paraList['ErrMsg'][0];
		if($ret!='OK' || $errmsg!='OK'){
			return $errmsg;
		}
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


	function getActType($request,&$retArray){
		$retArray = array();
		$actTypeInfo = array();
		$actTypeInfo['ActType'] = -1;
		$actTypeInfo['ActTypeName'] = '所有';
		$actTypeInfo['select'] = true;

		$retArray[] = $actTypeInfo;
		$actTypeInfo = array();
		$actTypeInfo['ActType'] = 1;
		$actTypeInfo['ActTypeName'] = 360;
		$retArray[] = $actTypeInfo;
		$actTypeInfo['ActType'] = 2;
		$actTypeInfo['ActTypeName'] = 3600;
		$retArray[] = $actTypeInfo;
		$actTypeInfo['ActType'] = 3;
		$actTypeInfo['ActTypeName'] = 18000;
		$retArray[] = $actTypeInfo;
	}
}  
		
   
?>
