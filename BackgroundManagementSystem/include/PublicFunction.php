<?php

include_once "znzglobal.mssql.php";
include_once "znzglobal.php";

class PublicFunction extends znzMsSql{
	function workDayNum($startDate,$endDate){
		$j=0;
		//strtotime() 函数将任何英文文本的日期时间描述解析为 Unix 时间戳。
		for($i=strtotime($startDate);$i<=strtotime($endDate);$i=$i+3600*24){
			if(date('w',$i)==0 || date('w',$i)==6){
				continue;
			}else{
				$j++;
			}			
		}	
		return $j;
		
	}


}

?>