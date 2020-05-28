<?php
$root = dirname(dirname(__FILE__));
//echo dirname(__FILE__);


include_once $root."/include/BackgroundManagementSystem.php";
include_once $root."/Config/Config.php";
require_once 'webNerve/positionRight/OpRightCheck.php';
require_once 'webNerve/wnPassport/wnPassport.php';


global $request;
//error_reporting("E_WARNING");  //滤掉警告


$cmd = $_GET['cmd'];

if(!$cmd){
	returnErrData("调试程序么？我们的数据不能被随便获取哦！",  false);
}
$retArray = array();
$total = 0;
$message = '';
switch($cmd) {
    case "getAllProcess":
    	$msDB = new webnerveMssqlDB($DBNerveInfo);
		getPara('personid','personid','2035669');
		getPara('actid','actid','');
		getPara('source','source','');
		getPara('sdate','sdate','');
		getPara('edate','edate','');
		getPara('sort','sort','MissionId');
		getPara('order','order','DESC');
		getPara('start','start',1);
		getPara('end','end',40);
    	$message = $msDB ->getAllProcess($request, $retArray);
    	$msDB -> close();
		returnGridPageData($retArray['Total'], $retArray['data'],$message);
		break;
	case "addProcess":
		$msDB = new webnerveMssqlDB($DBNerveInfo);
		getPostPara('personid','personid','2035669');
		getPostPara('source','source','');
		getPostPara('sdate','sdate','');
		getPostPara('edate','edate','');
		getPostPara('value','value','');
		getPostPara('money','money','');
		getPostPara('missionname','missionname','');
		getPostPara('actid','actid','');
		getPostPara('display_sdate','display_sdate','');
		getPostPara('display_edate','display_edate','');
		$message = $msDB ->addProcess($request, $retArray);
		$msDB -> close();
		if ($message != 'OK') {
			$json = array(
				'ret'   => $message,
			);
			echo json_encode($json);
			exit();
		}
		break;
	case "updateProcess":
		$msDB = new webnerveMssqlDB($DBNerveInfo);
		getPostPara('missionid','missionid','');
		getPostPara('personid','personid','2035669');
		getPostPara('source','source','');
		getPostPara('sdate','sdate','');
		getPostPara('edate','edate','');
		getPostPara('value','value','');
		getPostPara('money','money','');
		getPostPara('missionname','missionname','');
		getPostPara('actid','actid','');
		getPostPara('display_sdate','display_sdate','');
		getPostPara('display_edate','display_edate','');
		$message = $msDB ->updateProcess($request, $retArray);
		$msDB -> close();
		if ($message != 'OK') {
			$json = array(
				'ret'   => $message,
			);
			echo json_encode($json);
			exit();
		}
		break;
	case "deleteProcess":
		$msDB = new webnerveMssqlDB($DBNerveInfo);
		getPostPara('missionid','missionid','');
		getPostPara('personid','personid','2035669');
		$message = $msDB ->deleteProcess($request, $retArray);
		$msDB -> close();
		if ($message != 'OK') {
			$json = array(
				'ret'   => $message,
			);
			echo json_encode($json);
			exit();
		}
		break;
	case "getActList":
		$msDB = new webnerveMssqlDB($DBNerveInfo);
		getPara('ActType','ActType',$_REQUEST["ActType"]);
		getPara('GameType','GameType',-1);
		$message=$msDB->getActList($request, $retArray);
		$msDB->close();
		echo json_encode($retArray);
		exit();
		break;
	case "getActType":
		$msDB = new webnerveMssqlDB($DBNerveInfo);
		// getPara('ActType','ActType',$_POST["ActType"]);
		$message=$msDB->getActType($request, $retArray);
		$msDB->close();
		echo json_encode($retArray);
		exit();
		break;
}

function getPara($tag, $saveTag, $defaultValue){
	global $request;

	$request[$saveTag] = $_GET[$tag];
	if($request[$saveTag] == ""){
		$request[$saveTag] = $defaultValue;
	}
}


function getPostPara($tag, $saveTag, $defaultValue){
	global $request;

	$request[$saveTag] = $_POST[$tag];

	if($request[$saveTag] == ""){
		$request[$saveTag] = $defaultValue;
	}

}

function returnGridPageData($total, $data,$message=''){
	if ($message != 'OK') {
		returnErrData($message);
		exit();
	}

	$json = array(
		'ret' => $message,
		'total' => $total,
		'rows' => $data
	);
	echo json_encode($json);
	exit();
}

function returnErrData($message, $isConvert=false){
	if($isConvert == true)  {
		$message = iconv('GBK', 'UTF-8', $message);
	}

	$json = array(
		'ret'   => $message,
		'total' => 0,
		'rows'	=> array()
	);

	echo json_encode($json);
	exit();
}

?>
