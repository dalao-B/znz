<?php 
/* asynread.php - web read interface */

/* Copyright (c) 2012 by Compass.cn, P.R.China */

/*
modification history
--------------------
2012/07/19, Zhou Ke, create
*/
//error_reporting(0); 
include_once "../interface/include/actAnalysisWebMssqlDB.php";
include_once "../interface/config/config.php";
include_once "../interface/include/log.php";
require_once 'webNerve/wnPassport/wnPassport.php';
require_once 'webNerve/positionRight/positionRight.php';

global $request;

$cmd=$_GET["cmd"];

error_reporting(E_ALL & ~E_NOTICE);
ini_set("display_errors","On");

if($cmd=='help'){
	$ret = file_get_contents(dirname(__FILE__) .'/../readme');
	if (!$ret) {
		echo json_encode(array(
			'result'	=> 'ERROR',
			'data'		=> '帮助文件出错'
		));
	} else {
		echo json_encode(array(
			'result'	=> 'OK',
			'data'		=> $ret
		));
	}
	exit();
}

if($cmd==null){
    echo returnData("没有命令参数","");    
}


checkLogin();
//$personId=$_COOKIE["wnPersonId"];



$mssqlDB=new webnerveMssqlDB($webnerveMssqlDBInfo);
/*
if($mssqlDB->open($webnerveMssqlDBInfo)==false){

	logMsg("ERROR", "连接数据库失败");
	exit();
}
*/


$retArray=array();
$message='';




switch($cmd){   
	case 'menuGet':
		getParamToRequest('actRb','actRb',1); 
		$message=$mssqlDB->menuGet($request,$retArray);
        
        echo(json_encode($retArray));
		die();
		break;
		
	case 'getBadMan': //获取淘汰员工数据
		if(file_exists('../js/dataJson/specialData.json')){
			$retArray=json_decode(file_get_contents('../js/dataJson/specialData.json'),true);			
		}else{

			$retArray='文件不存在！';
		}

		break;
	case 'getData'://跨域访问 
		getParamToRequest('command','command',''); 
		getParamToRequest('type','type','all');
	    getParamToRequest('id','id',-1);
	    getParamToRequest('region','region','');
	    getParamToRequest('startDate','startDate','20130408');
    	getParamToRequest('endDate','endDate','20130408');
		getParamToRequest('cs','cs','-1');
		getParamToRequest('sourceType','sourceType','-1');
		getParamToRequest('serviceLevelId','serviceLevelId','-1');
		getParamToRequest('sourceType2','sourceType2','-1');
		//淘汰人员参数
		getParamToRequest('personlist','personlist','');
		getParamToRequest('deptList','deptList','');
		getParamToRequest('positionList','positionList','');
		getParamToRequest('zbList','zbList','');
		getParamToRequest('ClassName','ClassName',1);
        
        		
        if($_GET['command']=='get360ClassInfo' || 
           $_GET['command']=='get360GuoChengInfo' ||
           $_GET['command']=='get360ClassCallInfo' ||
           $_GET['command']=='get360LaoDongInfo'
           
        ){
            if($_GET['isHistory']==1){
                $request['url']=json_decode($url_360_History);  
            }else{
                $request['url']=json_decode($url_360);  
            }    
                    
        }else if(
            $_GET['command']=='get3600ClassInfo' || 
            $_GET['command']=='get3600GuoChengInfo' ||
            $_GET['command']=='get3600ClassCallInfo' ||
            $_GET['command']=='get3600LaoDongInfo'
        ){


            if($_GET['isHistory']==1){
                $request['url']=json_decode($url_3600_History);    
            }else{
                $request['url']=json_decode($url_3600);   
            }
                         
        }else if(
            $_GET['command']=='get18000ClassInfo' || 
            $_GET['command']=='get18000GuoChengInfo' ||
            $_GET['command']=='get18000LaoDongInfo' ||
            $_GET['command']=='get18000ClassCallInfo'
        ){
            if($_GET['isHistory']==1){
                $request['url']=json_decode($url_18000_History);    
            }else{
                $request['url']=json_decode($url_18000);   
            }                 
        }else if (
            $_GET['command']=='getOrganizationClassInfo' || 
            $_GET['command']=='getOrganizationGuoChengInfo' 
        ){
            $request['url']=json_decode($url_Organization);     
        }else if (
            $_GET['command']=='getOrganizationCourseClassInfo' || 
            $_GET['command']=='getOrganizationCourseGuoChengInfo' 
        ){
            $request['url']=json_decode($url_OrganizationCourse);     
        }
        
        

		$message=$mssqlDB->getData($request,$retArray);  
		break;
    //获取销售成本信息 CaoJun add 2013-06-05
    case 'getSaleCost':
        getParamToRequest('id','id',2015797);
        $message=$mssqlDB->getSaleCost($request,$retArray);
		break;
    //获取售前成熟度信息 CaoJun add 2013-09-26 
    case 'getPreMatureDataInfo':
        getParamToRequest('startDate','startDate',20130501);
        getParamToRequest('endDate','endDate',date('Ymd'));
        getParamToRequest('sourceType2','sourceType',-1);
        getParamToRequest('cs','selectType',3);
        getParamToRequest('id','Unitid',1);
        if ($request['Unitid'] == 0){
            $request['Unitid'] = 1;
        }
        $message=$mssqlDB->getPreMatureDataInfo($request,$retArray);
		break;	
	//获取售后成熟度信息 CaoJun add 2013-09-26
    case 'getAftMatureDataInfo':
        getParamToRequest('startDate','startDate',20130501);
        getParamToRequest('endDate','endDate',date('Ymd'));
        getParamToRequest('serviceLevelId','sourceType',-1);
        getParamToRequest('cs','selectType',3);
        getParamToRequest('id','Unitid',1);
        if ($request['Unitid'] == 0){
            $request['Unitid'] = 1;
        }
        $message=$mssqlDB->getAftMatureDataInfo($request,$retArray);
		break;

    //获取18000售后成熟度信息 CaoJun add 2013-10-12
    case 'getAft18000MatureDataInfo':
        getParamToRequest('startDate','startDate',20130901);
        getParamToRequest('endDate','endDate',date('Ymd'));
        getParamToRequest('serviceLevelId','sourceType',-1);
        getParamToRequest('cs','selectType',3);
        getParamToRequest('id','Unitid',1);
        if ($request['Unitid'] == 0){
            $request['Unitid'] = 1;
        }
        $message=$mssqlDB->getAft18000MatureDataInfo($request,$retArray);
		break;		
			
    //获取现货成熟度信息 CaoJun add 2013-12-26
    case 'getSpotMatureDataInfo':
        getParamToRequest('startDate','startDate',20131201);
        getParamToRequest('endDate','endDate',date('Ymd'));
        getParamToRequest('serviceLevelId','sourceType',-1);
        getParamToRequest('cs','selectType',3);
        getParamToRequest('id','Unitid',1);
        if ($request['Unitid'] == 0){
            $request['Unitid'] = 1;
        }
        $message=$mssqlDB->getSpotMatureDataInfo($request,$retArray);
		break;
		
	//获取现货游戏成熟度信息 周克 add 2014-03-18
    case 'getSpotGameMatureDataInfo':
        getParamToRequest('startDate','startDate',20140307);
        getParamToRequest('endDate','endDate',date('Ymd'));
        getParamToRequest('serviceLevelId','sourceType',-1);
        getParamToRequest('cs','selectType',3);
        getParamToRequest('id','Unitid',1);
        if ($request['Unitid'] == 0){
            $request['Unitid'] = 1;
        }
        $message=$mssqlDB->getSpotGameMatureDataInfo($request,$retArray);
		break;
	case 'getPersonHistoryData':
        getParamToRequest('ActType','ActType','');
        getParamToRequest('PersonId','PersonId',-1);
        $message=$mssqlDB->getPersonHistoryData($request,$retArray);
		break;					

	case 'getDeptHistoryData':
        getParamToRequest('ActType','ActType','');
        getParamToRequest('DeptId','DeptId',-1);
        getParamToRequest('DeptType','DeptType',-1);
        $message=$mssqlDB->getDeptHistoryData($request,$retArray);
		break;

	case 'getPersonSynRankingData':
        getParamToRequest('ActType','ActType','');
        getParamToRequest('PersonId','PersonId',-1);
        getParamToRequest('sdate','sdate',-1);
		getParamToRequest('Key','Key',-1);
		getParamToRequest('UnifSynRankingAvgScore','UnifSynRankingAvgScore',-1);
        $message=$mssqlDB->getPersonSynRankingData($request,$retArray);
		break;

	case 'getDeptSynRankingData':
        getParamToRequest('ActType','ActType','');
        getParamToRequest('DeptId','DeptId',-1);
        getParamToRequest('sdate','sdate',-1);
		getParamToRequest('Key','Key',-1);
		getParamToRequest('UnifSynRankingAvgScore','UnifSynRankingAvgScore',-1);	
        $message=$mssqlDB->getDeptSynRankingData($request,$retArray);
		break;
	
	case 'getObsoleteData':
		getParamToRequest('actType','actType','');
        getParamToRequest('personlist','personlist','');
        getParamToRequest('deptList','deptList',-1);
        getParamToRequest('positionList','positionList',-1);
		getParamToRequest('zbList','zbList',-1);
		getParamToRequest('ActId','ActId',-1);
        $message=$mssqlDB->getObsoleteData($request,$retArray);
		break;		
	
	case 'getActInfo':
		getParamToRequest('ActType','ActType',-1);
        $message=$mssqlDB->getActInfo($request,$retArray);
		break;	
	case 'getUpdateClassBScoreData':
		$mssqlDB->close();
		if($mssqlDB->open($UsersMssqlDBInfo)==false){		
			logMsg("ERROR", "连接数据库失败");	
			exit();		
		}else{
			getParamToRequest('UnitId','UnitId',-1);
			getParamToRequest('UnitType','UnitType',-1);
			getParamToRequest('NodeType','NodeType','');
			getParamToRequest('start','start',1);
			getParamToRequest('end','end',400);
			getParamToRequest('sort','sort','Total');
			getParamToRequest('order','order','DESC');
	        $message=$mssqlDB->getUpdateClassBScoreData($request,$retArray);
			$mssqlDB->close();			
			returnData($message, $retArray);
		}		
		break;
    case 'getClass_B_Chart':
        getParamToRequest('startDate','startDate','');
        getParamToRequest('endDate','endDate','');
        getParamToRequest('unitId','unitId',-1);
        getParamToRequest('unitType','unitType',1);
        getParamToRequest('sourceId','sourceId',-1);
        $message=$mssqlDB->getClass_B_Chart($request,$retArray);
        break;     
        
    case 'getClass_B_Chart18000':
        getParamToRequest('startDate','startDate','');
        getParamToRequest('endDate','endDate','');
        getParamToRequest('unitId','unitId',-1);
        getParamToRequest('unitType','unitType',1);
        getParamToRequest('sourceId','sourceId',-1);
        $message=$mssqlDB->getClass_B_Chart18000($request,$retArray);
        break;   
        
    case 'UpdateTransStageHistoryInfoGet':
        $message=$mssqlDB->UpdateTransStageHistoryInfoGet($request,$retArray);
        break;

    case "getActList":
        $mssqlDB=new webnerveMssqlDB($webnerveMssqlDBInfo_1);
        getParamToRequest('ActType','ActType',$_REQUEST["ActType"]);
        getParamToRequest('GameType','GameType',-1);
        $message=$mssqlDB->getActList($request, $retArray);
        $mssqlDB->close();
        echo json_encode($retArray);
        exit();
        break;
}



 
$mssqlDB->close();

if ($_GET['excel'] == 1)
{
    include("makeExcel.php");
    global $request;
    makeExcel($retArray,$request);

}
else
{
    returnData($message, $retArray);
}



returnData($message,$retArray);

function getParamToRequest($tag,$savetag,$defaultValue){
    global $request;
    $request[$savetag]=$_GET[$tag];
    if($request[$savetag]==''||$request[$savetag]==NULL){  
        $request[$savetag]=$defaultValue;        
    }
}

function returnData($result,$data){

	//启用ob_gzip
	//ob_start('ob_gzip');
	//待压缩的内容
    echo(json_encode($data));
	//输出压缩结果
	//ob_end_flush();

    exit();   
}

//gzip压缩方法
function ob_gzip($content)
{
	  
    if(!headers_sent() &&
        extension_loaded("zlib") &&
        strstr($_SERVER["HTTP_ACCEPT_ENCODING"],"gzip"))
    {
        $content = gzencode($content,0); //0-9,0无压缩，9最高压缩
       
        header("Content-Encoding: gzip");
        header("Vary: Accept-Encoding");
        header("Content-Length: ".strlen($content));
    }
    return $content;
}

function checkLogin(){
    global $request;   
    $retVal=wnppAccreditCheck($wnPersonId,$wnPersonName);
    
    if($retVal!='OK'){  
        returnData("您还没有登录",null);
    }else{
        $request['personid']= $wnPersonId;
        $request['personname']= $wnPersonName; 
    }
	

}

function checkRight($wnPersonId,$functionDefine){
	$retVal = positionRightCheck($wnPersonId, $functionDefine, $haveRight, $wnIsAdmin, $errmsg);

	if($haveRight || $wnIsAdmin){
		return true;
	}else{
		return false;
	}
			
}



?>


