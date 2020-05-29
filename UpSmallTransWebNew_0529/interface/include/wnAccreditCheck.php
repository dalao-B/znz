<?php
/* wnAccreditCheck.php - check accredit for the user */

/* Copyright (c) 2008 by Compass.cn, P.R.China */

/*
modification history
--------------------
2008/9/9, Zhou Haijian, Create

returns
    wnPersonId：当前登录的神经系统编号
    wnPersonName：用户姓名
    wnIsAdmin：是否是管理员
*/

require_once 'webNerve/wnPassport/wnPassport.php';
require_once 'interface/include/wnGlobalFunc.php';
require_once 'webNerve/positionRight/positionRight.php';

/* check accredit and get person id */

$retVal = wnppAccreditCheck($wnPersonId, $wnPersonName);
if ($retVal != 'OK')
{
    d_alert('您还没有登录');
	    
    if ($_REQUEST['newwin'] != 1 && $newwin != 1)
    {
        dscript("if(self!=top)window.top.location.href=window.top.location.href;");
        dscript("self.location.href='/';");
        dscript("window.close();"); /* 如果是新窗口，则直接关闭 */
    }
    else
    {
        dscript("window.close();"); /* 如果是新窗口，则直接关闭 */
        dscript("self.location.href='/';");
    }
	        
    exit();
}

/* check postion right for the person */

$haveOpenAuthAndConfirmRight=0;
										 
$haveRecheckRight=0;


$personlimits = "EMPLOYEE";

$functionDefine = 'New_WebNerve_Market_UnpaidTrans_OtherPayAuthOpenAndConfirm';
$retVal = positionRightCheck($wnPersonId, $functionDefine, $haveRight, $wnIsAdmin, $errmsg);
if ($haveRight || $wnIsAdmin)
{
    $haveOpenAuthAndConfirmRight = 1;
}

$functionDefine = 'New_WebNerve_Market_UnpaidTrans_OtherPayReCheck';
$retVal = positionRightCheck($wnPersonId, $functionDefine, $haveRight, $wnIsAdmin, $errmsg);
if ($haveRight || $wnIsAdmin)
{
	$haveRecheckRight = 1;
}

?>
