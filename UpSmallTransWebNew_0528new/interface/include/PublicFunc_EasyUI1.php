<?php
include_once "znzglobal.mssql.php";
include_once "znzglobal.php";

class PublicFunc extends znzMsSql{
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
    function menuGet($request, &$retArray){
                
        $storeName='[dbnerve].[dbo].[P_WebNerve_MenuGet]';
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
        $deptArray = $items[1];
        $groupArray = $this->array_sort($items[2],'GroupName','部','组');     
        
        //Type --1:公司  --2:部门  --3:小组
        
        //将小组放入部门       
        foreach($groupArray as $group){
            foreach($deptArray as $key=>$dept){
                if($group['DeptId'] == $dept['DeptId'] && $group['RegionType'] == $dept['RegionType']){
                    $deptArray[$key]['children'][]=array(
                        'id'=>$group['GroupId'],
                        'text'=>$group['GroupName'],
                        "attributes"=>array("Type"=>3)
                    );
                }
            }
        }
        
        
/*
        echo '<pre>';
            print_r($deptArray);
        echo '</pre>';
        
        die();
*/
        //生成公司
        $Menu = array();
        $Menu[0] = array(
            'id'=>1,
            'text'=>'云集',
            'state'=>'open',
            "attributes"=>array("Type"=>1)
        );
        $Menu[0]['children'][0]= array(
            'id'=>11,
            'text'=>'云集王江勇营销一中心',
            'state'=>'open',
            "attributes"=>array("Type"=>100)
        );

        $Menu[0]['children'][1]= array(
            'id'=>12,
            'text'=>'云集李月明营销二中心',
            'state'=>'open',
            "attributes"=>array("Type"=>100)
        );
        
        $Menu[0]['children'][2] = array(
            'id'=>13,
            'text'=>'云集刘艳萍营销三中心',
            'state'=>'open',
            "attributes"=>array("Type"=>100)
        );        

        $Menu[0]['children'][3] = array(
            'id'=>15,
            'text'=>'云集段长华营销五中心',
            'state'=>'open',
            "attributes"=>array("Type"=>100)
        ); 

        $Menu[0]['children'][4] = array(
            'id'=>18,
            'text'=>'云集电商中心',
            'state'=>'open',
            "attributes"=>array("Type"=>100)
        );        
                
        $Menu[1] = array(
            'id'=>4,
            'text'=>'智富',
            'state'=>'open',
            "attributes"=>array("Type"=>1)
        );

        $Menu[1]['children'][0] = array(
            'id'=>41,
            'text'=>'智富中心一',
            'state'=>'open',
            "attributes"=>array("Type"=>100)
        );
        
        $Menu[1]['children'][1] = array(
            'id'=>48,
            'text'=>'智富电商中心',
            'state'=>'open',
            "attributes"=>array("Type"=>100)
        );

/*
        $Menu[2] = array(
            'id'=>6,
            'text'=>'宝盛',
            'state'=>'open',
            "attributes"=>array("Type"=>1)
        );

        $Menu[2]['children'][0] = array(
            'id'=>61,
            'text'=>'宝盛中心一',
            'state'=>'open',
            "attributes"=>array("Type"=>100)
        );

        $Menu[2]['children'][1] = array(
            'id'=>68,
            'text'=>'宝盛电商中心',
            'state'=>'open',
            "attributes"=>array("Type"=>100)
        );
        
 */       
        foreach ($deptArray as $items){         
            //去掉相关部门
            if($items['DeptId']==8458||$items['DeptId']==8459 //现货部
                ||$items['DeptId']==8368||$items['DeptId']==8442||$items['DeptId']==8566//培训部
                ||$items['DeptId'] == 8198 || $items['DeptId']==8432 || $items['DeptId'] == 8664//新单部 
                ||$items['DeptId'] == 8198 || $items['DeptId']==8432 || $items['DeptId'] == 8664//新单部 
            ){
                continue;
            }
            
            $deptTmpArray = array(
                'id'=>$items['DeptId'],
                'text'=>$items['NickName'],
                "attributes"=>array("Type"=>2)              
            );
            //部门不存在小组变为叶子节点
            if(count($items['children']) > 0){
                $deptTmpArray['children']=$items['children'];   
                $deptTmpArray['state']= 'closed';       
            };
            //将部门放入公司
            switch ($items['RegionType']) {
                case 1:
                    $Menu[0]['children'][]=$deptTmpArray;
                    break;
                case 11:
                    $Menu[0]['children'][0]['children'][]=$deptTmpArray;
                    break;
                case 12:
                    $Menu[0]['children'][1]['children'][]=$deptTmpArray;
                    break;
                case 13:
                    $Menu[0]['children'][2]['children'][]=$deptTmpArray;
                    break;      
                case 15:
                    $Menu[0]['children'][3]['children'][]=$deptTmpArray;
                    break; 
                case 18:
                    $Menu[0]['children'][4]['children'][]=$deptTmpArray;
                    break; 
                                  
                case 4:
                    $Menu[1]['children'][]=$deptTmpArray;
                    break;
                case 41:
                    $Menu[1]['children'][0]['children'][]=$deptTmpArray;
                    break;
                case 48:
                    $Menu[1]['children'][1]['children'][]=$deptTmpArray;
                    break;
               /*
                case 6:
                    $Menu[2]['children'][]=$deptTmpArray;
                    break;
                case 61:
                    $Menu[2]['children'][0]['children'][]=$deptTmpArray;
                    break;
                case 68:
                    $Menu[2]['children'][1]['children'][]=$deptTmpArray;
                    break;
                */
            }
        }

/*
        echo '<pre>';
            print_r($Menu[0]);
        echo '</pre>';
        die();
*/
        
        $Menu[0]['children'] = $this->array_sort($Menu[0]['children'],'text','心','');   
        $Menu[0]['children'][0]['children'] = $this->array_sort($Menu[0]['children'][0]['children'],'text','集','部');  
        $Menu[0]['children'][1]['children'] = $this->array_sort($Menu[0]['children'][1]['children'],'text','集','部'); 
        $Menu[0]['children'][2]['children'] = $this->array_sort($Menu[0]['children'][2]['children'],'text','集','部'); 
        $Menu[0]['children'][3]['children'] = $this->array_sort($Menu[0]['children'][3]['children'],'text','集','部'); 
        $Menu[0]['children'][4]['children'] = $this->array_sort($Menu[0]['children'][4]['children'],'text','集','部'); 
        $Menu[1]['children'] = $this->array_sort($Menu[1]['children'],'text','心','');   
        $Menu[1]['children'][0]['children'] = $this->array_sort($Menu[1]['children'][0]['children'],'text','富','部');
        $Menu[1]['children'][1]['children'] = $this->array_sort($Menu[1]['children'][1]['children'],'text','富','部');
        /*
        $Menu[2]['children'] = $this->array_sort($Menu[2]['children'],'text','心','');   
        
        $Menu[2]['children'][0]['children'] = $this->array_sort($Menu[2]['children'][0]['children'],'text','盛','部');
        $Menu[2]['children'][1]['children'] = $this->array_sort($Menu[2]['children'][1]['children'],'text','盛','部');
        */
        $retArray[]=array(
            'id'=>-1,
            'text'=>'所有',
            'children'=>$Menu,
            "attributes"=>array("Type"=>1)
        );
        
        /*  
        $retArray[]=array(
            'id'=>-2,
            'text'=>'活动设置',
            "attributes"=>array("Type"=>-1)
        );  
        $retArray[]=array(
            'id'=>-3,
            'text'=>'对赌战报',
            "attributes"=>array("Type"=>-1)
        );

        */
        $errmsg=$paraList['ErrMsg'][0];
        if($ret!='OK' || $errmsg!='OK'){
            return $errmsg;
        }
                                
        return 'OK';
    }

    //数组排续
    function array_sort($arr,$keys,$searchStr1,$searchStr2,$type='asc'){
        $keysvalue = $new_array = array();
        
        foreach ($arr as $k=>$v){

            $str = iconv('utf-8','GBK',$v[$keys]);
            $index = strpos(iconv('utf-8','GBK',$v[$keys]),iconv('utf-8','GBK',$searchStr1))+2;
            if ($searchStr2==''){
                $len=2;
            }else{
                $len = strpos(iconv('utf-8','GBK',$v[$keys]),iconv('utf-8','GBK',$searchStr2))
                        - strpos(iconv('utf-8','GBK',$v[$keys]),iconv('utf-8','GBK',$searchStr1))-2;
            }
            $deptNum=substr($str,$index,$len);
            //echo $v[$keys];
            //echo $len;
            //echo '<br>';
                                            
            //$deptNum=substr(iconv('utf-8','GBK',$v[$keys]),strpos(iconv('utf-8','GBK',$v[$keys]),iconv('utf-8','GBK',$searchStr))+2,2);
            
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
                    $keysvalue[$k]=16;
                    break;      
                case iconv('utf-8','GBK','十七'):
                    $keysvalue[$k]=17;
                    break;      
                case iconv('utf-8','GBK','十八'):
                    $keysvalue[$k]=18;
                    break;      
                case iconv('utf-8','GBK','十九'):
                    $keysvalue[$k]=19;
                    break;      
                case iconv('utf-8','GBK','二十'):
                    $keysvalue[$k]=20;
                    break;      
                case iconv('utf-8','GBK','二十一'):
                    $keysvalue[$k]=21;
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
}

?>
