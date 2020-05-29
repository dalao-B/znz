<?php
// 写日志文件的功能函数
function writeLog($funname, $str){
	$file = GLOBAL_LOG_DIRECTORY."/log/$funname.log";
	$fh = fopen($file, 'a');
	if ($fh)
	{
		fwrite($fh, "".date('Y-m-d H:i:s(D): ')."$str\n");
		fclose($fh);
	}
}

// 写入用户alive的log记录
function writeAliveLog($op){
	$para = array(
		'topgid' => $op->topgid,
		'gid'    => $op->gid,
		'id'     => $op->id,
		'name'   => $op->name
	);
	writeLog('action.'.date('Y-m-d'), json_encode($para));
}


// 读配置文件的功能函数
function readConf($fname, $nullfile, $date=0){
	if ($date) $datestr = '.'.date('Y-m-d');
	$confname = GLOBAL_LOG_DIRECTORY.$fname.$datestr.".conf";
	//Debug($confname);
	if (!file_exists($confname))
		file_put_contents($confname, $nullfile);	//文件不存在时默认的文件内容
	$ret = file_get_contents($confname);
	return $ret;
}
// 更新配置文件的功能函数
function writeConf($fname, $text, $date=0){
	if ($date) $datestr = '.'.date('Y-m-d');
	$confname = GLOBAL_LOG_DIRECTORY.$fname.$datestr.".conf";
	//Debug($confname);
	file_put_contents($confname, $text);
}



// show failed webpage
function errPage($errmsg){
	print "<br/>$errmsg<br/>";
	print '<br/><a href="javascript:history.back();" >返回</a><br/>';
	return;
}
// 打印一个错误信息并返回一个值
function errReturn($errmsg, $ret){
	//echo "<div><font class='red'>".$errmsg."</font></div>";
	echo $errmsg;
	return $ret;
}

// 获得本文件的文件名
function getFileName(){
	$thisFile = $_SERVER['SCRIPT_FILENAME'];
	$pos = (int)strrpos($thisFile, '/') + 1;
	return substr($thisFile, $pos);
}

// 获得本文件的URL中的路径部分，包含最后的“/”
function getUrlPath(){
	$script_url = $_SERVER['SCRIPT_URI'];
	$pos = strrpos($script_url, '/')+1;
	//Debug($_SERVER['SCRIPT_URI']);
	$file_url_path = substr($script_url, 0, $pos);
	//Debug($file_url_path);
	return $file_url_path;
}






function gbk2utf8(&$text){
	//echo "$text -->  ".is_string($text).' - '.is_array($text)."<br/>";
	if (is_string($text))
		return iconv('GBK', 'UTF-8', $text);
	if (is_array($text))
	{
		foreach($text as $key => $value)
		{
			$text[$key] = gbk2utf8($value);
		}
	}
	return $text;
}
function utf82gbk(&$text){
	//echo "$text -->  ".is_string($text).' - '.is_array($text)."<br/>";
	if (is_string($text))
		return iconv('UTF-8', 'GBK', $text);
	if (is_array($text))
	{
		foreach($text as $key => $value)
		{
			$text[$key] = utf82gbk($value);
		}
	}
	return $text;
}
function getUTF8($text){
	return iconv('GBK', 'UTF-8', $text);
}
function getGBK($text){
	return iconv('UTF-8', 'GBK', $text);
}
function utf8($text){
	return iconv('GBK', 'UTF-8', $text);
}
function gbk($text){
	return iconv('UTF-8', 'GBK', $text);
}




// 数组的并集
function array_union($Array1, $Array2){
	$Res = array();   //结果数组
	$Res=$Array1;   //直接将数组1赋值给结果数组

	//将数组2的元素逐个对比看看在数组1中是否存在,若不存放,将它存放结果数组中去
	for($i=0;$i<count($Array2);$i++)
	{
		$IsEqual = 0;
		for($j=0;$j<count($Array1);$j++)
		{
		if($Array1[$j]==$Array2[$i])
			$IsEqual ++;
		}
		if($IsEqual==0)   //如果数组2中的当前元素在数组1中没有找到
		{
			$Length = count($Res);
			$Res[$Length] = $Array2[$i];   ////将数组2的元素逐个对比看看在数组1中是否存在,若不存放,将它存放结果数组中去
		}
	}
	return $Res;
}




// 数学操作
// 显示$a/$b，保留小数点后$n位，可以显示百分数，可指定是否显示千位分隔符
function showDivide($a, $b, $n, $percent, $splt){
	$a = intval($a);
	$b = intval($b);
	$n = intval($n);								//最终的小数点取几位数
	$percent = ($percent=='') ? 1.0 : 100.0;		//是否得到百分数，即是否乘100
	$splt = ($splt=='') ? '' : ',';

	$c = ($b == 0) ? 0 : ($percent * $a / $b);
	$rslt = number_format($c, $n, '.', $splt);
	return $rslt;
}
?>