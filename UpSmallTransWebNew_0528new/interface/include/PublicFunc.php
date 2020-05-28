<?php

include_once "db/GenericMssqlDB.php";


class PublicFunc extends GenericMssqlDB{
    function workDayNum($startDate,$endDate){
        $j=0;
        for($i=strtotime($startDate);$i<=strtotime($endDate);$i=$i+3600*24){
            if(date('w',$i)==0 || date('w',$i)==6){
                continue;
            }else{
                $j++;
            }           
        }
    
        return $j;
        

    }


    function formatValueToMillion($input,$dec=10000){
        if(strlen($input)<=4){
            $value=number_format($input);    
        }else{
            $value=$input/$dec;
            $value=number_format(round($value,2),2)."万元";    
        }
        return $value;
    
    }

    function activeGet(){
        $storeName='[db_companyData].[dbo].[P_WebNerve_InterService__SalesAnalysis_WeedOut_ActiveConfig_Get]';
        $paraList=array(
            "OpId"          => array(2009864,SQLINT4,16),           
            "ErrMsg"        => array('',SQLVARCHAR,1000,TRUE) 
        );
        
        $ret=$this->procCall_ext($storeName,$paraList,true,$items,MSSQL_ASSOC);
        
        return $items;

                                
    }   
    
    function menuGet($request,&$retArray){        
        $storeName='[dbnerve].[dbo].[P_WebNerve_MenuGet]';
//        $storeName='[DB_WebNerveData].[dbo].[P_WebNerve_MenuGet_zzh]';
        $paraList=array(
            "OpId"          => array(iconv('utf-8','GBK',$request['personid']),SQLINT4,16),
            "ErrMsg"        => array('',SQLVARCHAR,1000,TRUE)
        );  
        
        $ret=$this->procCall_ext($storeName,$paraList,true,$items,MSSQL_ASSOC); 
/*        
        echo '<pre>';
            print_r($items);
        echo '</pre>';
        
        die();
*/
        //取部门活动信息
        $rcArray=array();
        $fcArray=array();
        $nowDate=strtotime(date('Ymd'));
    
        for($i=0 ;$i<count($items);$i++){
            if(count($items[$i])>0){            
                foreach ($items[$i] as &$tmp) {
                    foreach ($tmp as $key=>$value) {
                        $tmp[$key]=iconv('GBK','utf-8',$tmp[$key]);
                    }
                }           
            }           
        }

        //部门数组
        $deptArrayTemp=$this->array_sort($items[1],'NickName','营');
    
        
        
        //die();
        //小组数组 
        $groupArrayTemp=$this->array_sort($items[2],'GroupName','部');
        

        ///*
        //如果是现货菜单只要现货部。
        $actRb=$request['actRb'];

        foreach ($deptArrayTemp as $value) {

            if($value['DeptId']!=8458 &&
                $value['DeptId']!=8459
            ){
                $deptArray[]=$value;
            }               
            
        }
        unset($value);
        
    //*/    
        
/*  
    echo '<pre>';
        print_r($deptArray);
    echo '</pre>';
    
    die();  
//*/
        
        foreach ($groupArrayTemp as $value) {
            if($value['GroupId']!=8460 &&
                $value['GroupId']!=8463 &&
                $value['GroupId']!=8461
            ){
                $groupArray[]=$value;
            }               
        
        }
        
            /*  
        echo '<pre>';
            print_r($groupArray);
        echo '</pre>';
        die();
    //*/    
        
        unset($value);//*/
        $date=date('Ymd');

        //生成部门数组
        for($i=0;$i<count($deptArray);$i++){
            
            //现货两个部门暂时不要
            if($deptArray[$i]['DeptId']==8458 ||
                $deptArray[$i]['DeptId']==8459 ||
                $deptArray[$i]['DeptId']==8460
            ){
                continue;
            }
            switch ($deptArray[$i]['RegionType']) {
                case '1':
                    $tempMenu[1][$deptArray[$i]['DeptId']]=array('id'=>$deptArray[$i]['DeptId'],'text'=>$deptArray[$i]['NickName'],'metype'=>'department','region'=>1,'expanded'=>false,'leaf'=>false);                
                    break;                
                case '11':
                    $tempMenu[11][$deptArray[$i]['DeptId']]=array('id'=>$deptArray[$i]['DeptId'],'text'=>$deptArray[$i]['NickName'],'metype'=>'department','region'=>1,'expanded'=>false,'leaf'=>false);                
                    break;
                case '12':
                    $tempMenu[12][$deptArray[$i]['DeptId']]=array('id'=>$deptArray[$i]['DeptId'],'text'=>$deptArray[$i]['NickName'],'metype'=>'department','region'=>1,'expanded'=>false,'leaf'=>false);                
                    break;
                case '13':
                    $tempMenu[13][$deptArray[$i]['DeptId']]=array('id'=>$deptArray[$i]['DeptId'],'text'=>$deptArray[$i]['NickName'],'metype'=>'department','region'=>1,'expanded'=>false,'leaf'=>false);                
                    break;
                case '15':
                    $tempMenu[15][$deptArray[$i]['DeptId']]=array('id'=>$deptArray[$i]['DeptId'],'text'=>$deptArray[$i]['NickName'],'metype'=>'department','region'=>1,'expanded'=>false,'leaf'=>false);                
                    break;
                case '18':
                    $tempMenu[18][$deptArray[$i]['DeptId']]=array('id'=>$deptArray[$i]['DeptId'],'text'=>$deptArray[$i]['NickName'],'metype'=>'department','region'=>1,'expanded'=>false,'leaf'=>false);                
                    break;                                        
                case '19':
                    $tempMenu[19][$deptArray[$i]['DeptId']]=array('id'=>$deptArray[$i]['DeptId'],'text'=>$deptArray[$i]['NickName'],'metype'=>'department','region'=>1,'expanded'=>false,'leaf'=>false);
                    break;
                case '4':
                    $tempMenu[4][$deptArray[$i]['DeptId']]=array('id'=>$deptArray[$i]['DeptId'],'text'=>$deptArray[$i]['NickName'],'metype'=>'department','region'=>1,'expanded'=>false,'leaf'=>false);             
                    break;                  
                case '41':
                    $tempMenu[41][$deptArray[$i]['DeptId']]=array('id'=>$deptArray[$i]['DeptId'],'text'=>$deptArray[$i]['NickName'],'metype'=>'department','region'=>1,'expanded'=>false,'leaf'=>false);             
                    break;                  
                case '48':
                    $tempMenu[48][$deptArray[$i]['DeptId']]=array('id'=>$deptArray[$i]['DeptId'],'text'=>$deptArray[$i]['NickName'],'metype'=>'department','region'=>1,'expanded'=>false,    'leaf'=>false);
                    break;
                case '49':
                    $tempMenu[49][$deptArray[$i]['DeptId']]=array('id'=>$deptArray[$i]['DeptId'],'text'=>$deptArray[$i]['NickName'],'metype'=>'department','region'=>1,'expanded'=>false,'leaf'=>false);    
                    break;
                case '6':
                    $tempMenu[6][$deptArray[$i]['DeptId']]=array('id'=>$deptArray[$i]['DeptId'],'text'=>$deptArray[$i]['NickName'],'metype'=>'department','region'=>1,'expanded'=>false,'leaf'=>false);             
                    break;
                /*20200227迁移到了云集下面                      
                case '61':
                    $tempMenu[61][$deptArray[$i]['DeptId']]=array('id'=>$deptArray[$i]['DeptId'],'text'=>$deptArray[$i]['NickName'],'metype'=>'department','region'=>1,'expanded'=>false,'leaf'=>false);             
                    break;  
                case '68':
                 */ 
                    $tempMenu[68][$deptArray[$i]['DeptId']]=array('id'=>$deptArray[$i]['DeptId'],'text'=>$deptArray[$i]['NickName'],'metype'=>'department','region'=>1,'expanded'=>false,    'leaf'=>false);
                    break;
                case '69':
                    $tempMenu[69][$deptArray[$i]['DeptId']]=array('id'=>$deptArray[$i]['DeptId'],'text'=>$deptArray[$i]['NickName'],'metype'=>'department','region'=>1,'expanded'=>false,'leaf'=>false);    
                    break;    
            }           
        }

  


        //将小组放入部门数组
        for($j=0;$j<count($groupArray);$j++){
            //现货两个组暂时不要
            if(
                $groupArray[$j]['GroupId']==8460 ||
                $groupArray[$j]['GroupId']==8463
            ){
                continue;
            }       
            $tempMenu[$groupArray[$j]['RegionType']][$groupArray[$j]['DeptId']]['children'][]
                    =array('id'=>$groupArray[$j]['GroupId'],'text'=>$groupArray[$j]['GroupName'],'metype'=>'group','region'=>$groupArray[$j]['RegionType'],'leaf'=>true);
            
        }



        //整理成ExtJS的树结构
        foreach ($tempMenu as $n => $value) {
            for($i=0;$i<count($deptArray);$i++){
                if($tempMenu[$n][$deptArray[$i]['DeptId']]!=null || $tempMenu[$n][$deptArray[$i]['DeptId']]!=''){
                    //判断部门下是否有小组，如果没有将节点变为叶子
                    if(count($tempMenu[$n][$deptArray[$i]['DeptId']]['children'])<=0){
                        $tempMenu[$n][$deptArray[$i]['DeptId']]['leaf']=true;
                    }   
                    $deptMenu[$n][]=$tempMenu[$n][$deptArray[$i]['DeptId']];        
                }   
            }
        }
    

        $menuRCCenterArray_rc[]=array('id'=>'11','text'=>'云集王江勇营销一中心','metype'=>'company','expanded'=>false,'children'=>$deptMenu[11]);
        $menuRCCenterArray_rc[]=array('id'=>'12','text'=>'云集李月明营销二中心','metype'=>'company','expanded'=>false,'children'=>$deptMenu[12]);
        $menuRCCenterArray_rc[]=array('id'=>'13','text'=>'云集刘艳萍营销三中心','metype'=>'company','expanded'=>false,'children'=>$deptMenu[13]);
        $menuRCCenterArray_rc[]=array('id'=>'15','text'=>'云集段长华营销五中心','metype'=>'company','expanded'=>false,'children'=>$deptMenu[15]);
        $menuRCCenterArray_rc[]=array('id'=>'18','text'=>'云集电商中心','metype'=>'company','expanded'=>false,'children'=>$deptMenu[18]);
       
        $menuRCCenterArray_rc[]=array('id'=>'19','text'=>'云集招聘培训中心','metype'=>'company','expanded'=>false,'children'=>$deptMenu[19]);
        $menuRCCenterArray_fc[]=array('id'=>'41','text'=>'智富中心一','metype'=>'company','expanded'=>false,'children'=>$deptMenu[41]);
        $menuRCCenterArray_fc[]=array('id'=>'48','text'=>'智富电商中心','metype'=>'company','expanded'=>false,'children'=>$deptMenu[48]);
        $menuRCCenterArray_fc[]=array('id'=>'49','text'=>'智富招聘培训中心','metype'=>'company','expanded'=>false,'children'=>$deptMenu[49]);
        //$menuRCCenterArray_bs[]=array('id'=>'61','text'=>'宝盛中心一','metype'=>'company','expanded'=>false,'children'=>$deptMenu[61]);
        //$menuRCCenterArray_bs[]=array('id'=>'68','text'=>'宝盛电商中心','metype'=>'company','expanded'=>false,'children'=>$deptMenu[68]);
        $menuRCCenterArray_bs[]=array('id'=>'69','text'=>'宝盛招聘培训中心','metype'=>'company','expanded'=>false,'children'=>$deptMenu[69]);
        
        if(is_array($tempMenu[1]) && !emptyempty($tempMenu[1])){  
            foreach ($tempMenu[1] as $value) {  
                $menuRCCenterArray_rc[]=array('id'=>$value['id'],'text'=>$value['text'],'metype'=>$value['metype'],'expanded'=>false,'children'=>$value['children']);
            }
        }
        if(is_array($tempMenu[4]) && !emptyempty($tempMenu[4])){
            foreach ($tempMenu[4] as $value) {  
                $menuRCCenterArray_fc[]=array('id'=>$value['id'],'text'=>$value['text'],'metype'=>$value['metype'],'expanded'=>false,'children'=>$value['children']);
            }
        }
        if(is_array($tempMenu[6]) && !emptyempty($tempMenu[6])){
            foreach ($tempMenu[6] as $value) {  
                $menuRCCenterArray_bs[]=array('id'=>$value['id'],'text'=>$value['text'],'metype'=>$value['metype'],'expanded'=>false,'children'=>$value['children']);
            }
        }
       /* 
        echo '<pre>';
            print_r($tempMenu[4]);
        echo '</pre>';
        die();
        */
        $menuSecondArray[]=array('id'=>'1','text'=>'云集','metype'=>'company','expanded'=>TRUE,'children'=>$menuRCCenterArray_rc);




        $menuSecondArray[]=array('id'=>'4','text'=>'智富','metype'=>'company','expanded'=>TRUE,'children'=>$menuRCCenterArray_fc);
        $menuSecondArray[]=array('id'=>'6','text'=>'宝盛','metype'=>'company','expanded'=>TRUE,'children'=>$menuRCCenterArray_bs);
        
        $menuFirstArray[]=array('id'=>'0','text'=>'所有','metype'=>'All','expanded'=>TRUE,'children'=>$menuSecondArray);
        $rootArray=array('children'=>$menuFirstArray);
        
        
        $retArray=$rootArray;

       /*
        echo '<pre>';
            print_r($retArray);
        echo '</pre>';
        
        die();        
//*/



        $errmsg=iconv('GBK','utf-8',$paraList['ErrMsg'][0]);
        if($ret!='OK' || $errmsg!='OK'){
            return $errmsg;
        }
                                
        return 'OK';

    }
    
    //数组排续
    function array_sort($arr,$keys,$searchStr,$type='asc'){
        $keysvalue = $new_array = array();
        
        foreach ($arr as $k=>$v){
            if($v['RegionType']==1){
                $deptNum=substr(iconv('utf-8','GBK',$v[$keys]),strpos(iconv('utf-8','GBK',$v[$keys]),iconv('utf-8','GBK','创'))+2,4);
            }else if($v['RegionType']==4){
                $deptNum=substr(iconv('utf-8','GBK',$v[$keys]),strpos(iconv('utf-8','GBK',$v[$keys]),iconv('utf-8','GBK','村'))+2,4);
                    
            }else if($v['RegionType']==6){
                $deptNum=substr(iconv('utf-8','GBK',$v[$keys]),strpos(iconv('utf-8','GBK',$v[$keys]),iconv('utf-8','GBK','盛'))+2,4);
                    
            }
            
            if ($deptNum!=iconv('utf-8','GBK','十一') &&
                $deptNum!=iconv('utf-8','GBK','十二') &&
                $deptNum!=iconv('utf-8','GBK','十三') &&
                $deptNum!=iconv('utf-8','GBK','十四') &&
                $deptNum!=iconv('utf-8','GBK','十五') &&
                $deptNum!=iconv('utf-8','GBK','十六') &&
                $deptNum!=iconv('utf-8','GBK','十七') &&
                $deptNum!=iconv('utf-8','GBK','十八') &&
                $deptNum!=iconv('utf-8','GBK','十九') &&
                $deptNum!=iconv('utf-8','GBK','二十') 
            ){      
                if($v['RegionType']==1){
                    $deptNum=substr($deptNum,0,2);
                }else{
                    $deptNum=substr($deptNum,0,2);
                        
                }
            }

                                    
            switch ($deptNum) {
                case iconv('utf-8','GBK','一'):
                    $keysvalue[$k]=1;
                    break;
                case iconv('utf-8','GBK','二'):
                    $keysvalue[$k]=2;
                    break;  
                case iconv('utf-8','GBK','三'):
                    $keysvalue[$k]=3;
                    break;      
                case iconv('utf-8','GBK','四'):
                    $keysvalue[$k]=4;
                    break;
                case iconv('utf-8','GBK','五'):
                    $keysvalue[$k]=5;
                    break;          
                case iconv('utf-8','GBK','六'):
                    $keysvalue[$k]=6;
                    break;
                case iconv('utf-8','GBK','七'):
                    $keysvalue[$k]=7;
                    break;
                case iconv('utf-8','GBK','八'):
                    $keysvalue[$k]=8;
                    break;          
                case iconv('utf-8','GBK','九'):
                    $keysvalue[$k]=9;
                    break;      
                case iconv('utf-8','GBK','十'):
                    $keysvalue[$k]=10;
                    break;  
                case iconv('utf-8','GBK','十一'):
                    $keysvalue[$k]=11;
                    break;                      
                case iconv('utf-8','GBK','十二'):
                    $keysvalue[$k]=12;
                    break;  
                case iconv('utf-8','GBK','十三'):
                    $keysvalue[$k]=13;
                    break;  
                case iconv('utf-8','GBK','十四'):
                    $keysvalue[$k]=14;
                    break;  
                case iconv('utf-8','GBK','十五'):
                    $keysvalue[$k]=15;
                    break;      
                case iconv('utf-8','GBK','十六'):
                    $keysvalue[$k]=15;
                    break;      
                case iconv('utf-8','GBK','十七'):
                    $keysvalue[$k]=15;
                    break;      
                case iconv('utf-8','GBK','十八'):
                    $keysvalue[$k]=15;
                    break;      
                case iconv('utf-8','GBK','十九'):
                    $keysvalue[$k]=15;
                    break;                  
                case iconv('utf-8','GBK','二十'):
                    $keysvalue[$k]=15;
                    break;                                                                          
                default:
                    $keysvalue[$k]=100;
                    break;  
            }

        }


        if($type == 'asc'){
            asort($keysvalue);
        }else{
            arsort($keysvalue);
        }
        
        reset($keysvalue);
        
        $i=0;
        foreach ($keysvalue as $k=>$v){
            $new_array[$i++] = $arr[$k];
        }
        

        return $new_array;
    }

    
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
            file_put_contents($confname, $nullfile);    //文件不存在时默认的文件内容
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
        $n = intval($n);                                //最终的小数点取几位数
        $percent = ($percent=='') ? 1.0 : 100.0;        //是否得到百分数，即是否乘100
        $splt = ($splt=='') ? '' : ',';
    
        $c = ($b == 0) ? 0 : ($percent * $a / $b);
        $rslt = number_format($c, $n, '.', $splt);
        return $rslt;
    }
}

?>
