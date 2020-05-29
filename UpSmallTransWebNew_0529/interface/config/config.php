<?php		
    //确定用哪个数据接口：1为线上接口；2为测试平台接口
    $whichInterface=1;
      
    //url服务器地址         
    $url=$whichInterface==2? json_encode('http://172.17.161.41/webNerve/test/dataServer.py/asynRead') 
                                  //json_encode('http://172.17.161.41/webNerve/test/dataServer.py/asynRead')  
                                  :json_encode('http://192.168.76.139/test/dataServer360.py/asynRead');
                               
                              //json_encode('http://172.17.161.41/webNerve/test/dataServer.py/asynRead') 
                                
                             //:json_encode('http://192.168.76.139/webNerve/modules/itservice/CostsAnalytics/salesAnalysis/test_fanmingyu/dataServer_new/dataServer.py/asynRead');
                             
                             //json_encode('http://192.168.76.139/test/dataServer.py/asynRead');
                        
    $url_360=$whichInterface==1 ? json_encode('http://172.17.161.75/test/dataServer_360.py/asynRead') 
                                  //json_encode('http://172.17.161.41/webNerve/test/dataServer.py/asynRead')  
                                  :json_encode('http://192.168.76.139/test/dataServer_360.py/asynRead'); 
                              //json_encode('http://172.17.161.41/webNerve/test/dataServer.py/asynRead') 
                                
                             //:json_encode('http://192.168.76.139/webNerve/modules/itservice/CostsAnalytics/salesAnalysis/test_fanmingyu/dataServer_new/dataServer.py/asynRead');
                             
                             //json_encode('http://192.168.76.139/test/dataServer.py/asynRead');
  
    $url_360_History=$whichInterface==1 ? json_encode('http://172.17.161.75/test/dataServer_360_History.py/asynRead') 
                                  //json_encode('http://172.17.161.41/webNerve/test/dataServer.py/asynRead')  
                                 :json_encode('http://192.168.76.139/test/dataServer_360_History.py/asynRead');


    $url_3600=$whichInterface==1 ? json_encode('http://172.17.161.75/test/dataServer_3600.py/asynRead') 
                              //json_encode('http://172.17.161.41/webNerve/test/dataServer.py/asynRead')  
                             :json_encode('http://192.168.76.139/test/dataServer_3600.py/asynRead');
    
    $url_3600_History=$whichInterface==1 ? json_encode('http://172.17.161.75/test/dataServer_3600_History.py/asynRead') 
                                  //json_encode('http://172.17.161.41/webNerve/test/dataServer.py/asynRead')  
                                 :json_encode('http://192.168.76.139/test/dataServer_3600_History.py/asynRead');



    $url_18000=$whichInterface==1 ? json_encode('http://172.17.161.75/test/dataServer_18000.py/asynRead')
                              //json_encode('http://172.17.161.41/webNerve/test/dataServer.py/asynRead')  
                             //:json_encode('http://192.168.76.139/test/dataServer_18000.py/asynRead');
                             :json_encode('http://192.168.76.139/test/dataServer_18000.py/asynRead');


    $url_18000_History=$whichInterface==1 ? json_encode('http://172.17.161.75/test/dataServer_18000_History.py/asynRead') 
                              //json_encode('http://172.17.161.41/webNerve/test/dataServer.py/asynRead')  
                             :json_encode('http://192.168.76.139/test/dataServer_18000_History.py/asynRead');

    $url_OrganizationCourse=$whichInterface==1 ? json_encode('http://172.17.161.75/test/dataServer_Organization_Course.py/asynRead')
                            //json_encode('http://172.17.161.41/webNerve/test/dataServer.py/asynRead')
                            //:json_encode('http://192.168.76.139/test/dataServer_18000.py/asynRead');
                            :json_encode('http://192.168.76.139/test/dataServer_Organization_Course.py/asynRead');

    $url_Organization=$whichInterface==1 ? json_encode('http://172.17.161.75/test/dataServer_Organization.py/asynRead')
                            //json_encode('http://172.17.161.41/webNerve/test/dataServer.py/asynRead')
                            //:json_encode('http://192.168.76.139/test/dataServer_18000.py/asynRead');
                            :json_encode('http://192.168.76.139/test/dataServer_Organization.py/asynRead');

    //各页面日期
    $dateConfig=array(
        'get360ClassInfo'           => array('minValue'=>'2018-10-08','startDate'=>'2018-10-08'),
        'get3600ClassInfo'          => array('minValue'=>'2018-08-18','startDate'=>'2018-08-18'),
        'get18000ClassInfo'         => array('minValue'=>'2018-11-12','startDate'=>'2018-11-12'),
        'getSpotClassInfo'          => array('minValue'=>'2013-12-10','startDate'=>'2013-12-10'),
        
        'get360GuoChengInfo'        =>array('minValue'=>'2018-10-08','startDate'=>'2018-10-08'),
        'get3600GuoChengInfo'       =>array('minValue'=>'2018-08-18','startDate'=>'2018-08-18'),
        'get3600HistoryGuoChengInfo'=>array('minValue'=>'2018-01-01','startDate'=>'2018-01-01'),
        'get18000GuoChengInfo'      =>array('minValue'=>'2018-11-12','startDate'=>'2018-11-12'),
        'getSpotInfo'               =>array('minValue'=>'2013-12-10','startDate'=>'2013-12-10'),
        'getSpotDetailInfo'         =>array('minValue'=>'2013-12-10','startDate'=>'2013-12-10'),
        'getSpotAftInfo'            =>array('minValue'=>'2014-02-01','startDate'=>'2014-02-01'),
        'getSpotPreInfo'            =>array('minValue'=>'2014-02-01','startDate'=>'2014-02-01')
    );
     


    //保存特殊员工数据配置文件
    $specialDataConfig=array(
        'fileDataPath'  =>'../js/dataJson/',
        'fileName'      =>'specialData.json'
    );

    //不显示的部门或组
    $filterConfig=array(
        'get360'        => array(
           8458,8459,19,49,69,9091,9090,9056,8510,8474,
           6,61,8458,8459,8399,8368,8233,8440,8442,8443,
           8563,8565,8558,8562,8561,8556,8560,8564,8557,8559,8664,8739,
           8912,8901,8862, //宝盛部门
           /*宝盛小组*/
          
           8567,8568,8569,8573,8574,8575,8579,8580,8581,8582,8585,8586,8587,
           8588,8591,8592,8593,8594,8597,8598,8599,8600,8601,8603,8604,8605,
           8606,8609,8610,8611,8612,8615,8616,8617,8618,8621,8622,8623,8624,
           8665,8589,8590,8607,8608,8595,8583,8619,8577,8613,8576,
           8570,8625,8746,
           8704,8571,8614,8869,8700,8913,8914,8707,8620,8709,8903,8814,8905,
           8864,8699,8782,8602,8829,8572,8877,8578,8584,8902,8900,8868,8818,
           8817,8816,8815,8762,8740,9049,8950,8940,8944,8943,8947,9101,9148,
           8949,9145,8881,8960,9100,9146,9053,8956,8955,8954,8953,8952, 
        
           /*智富*/
           8514,8481,
        
           /*云集*/
           9044,9150,9088,9052,9048,9047,9046,9045,9195,9156,9157,9158,
           9159,9160,9162,9163,9164,9151,
           
           //8432,8198,8436,8926,8441,8638,8637,8741,8400,8366
        ),
        'get3600'       => array(
            //云集
            19,49,69,8198,8432,9044,8368,
            9091,9046,8233,9047,8400,9048,8510,8638,9090,9088,9056,9052,
            8741,8637,8474,8366,9045, 

           ///*2018-05-15宝盛上拽暂时关掉
            19,49,69,8198,8432,9044,
            6,8458,8459,8366,8399,8368,8233,8440,8442,8443,8436,
            8563,8565,8558,8562,8561,8556,8560,8564,8557,8559,8566,8664,8739,8862, //宝盛部门
            8901,8912,
            //宝盛小组
            8706,8829,8708,8571,8709,8584,8740,8620,8780,8699,8782,8703,8814,
            8567,8568,8569,8573,8574,8575,8579,8580,8581,8582,8585,8586,8587,
            8588,8591,8592,8593,8594,8597,8598,8599,8600,8601,8603,8604,8605,
            8606,8609,8610,8611,8612,8615,8616,8617,8618,8621,8622,8623,8624,
            8665,8639,8637,8589,8590,8607,8608,8595,8583,8619,8577,8613,8576,
            8570,8625,8638,8746,8869,8868,8867,8864,8705,8602,8818,8817,8816,
            8815,8626,8572,8704,8700,8949,8867,8960,8869,8868,8864,8902,8903,
            9144,8943,8914,8881,9100,8950,9053,8940,8880,8877,8596,9064,9049,
            8947,9101,8905,8913,8944,
          //*/  
            61,69,9074,9075,9076,9087,9107,
            9095,9096,9097,9098,
            //招聘培训
            8740,8746,8815,8816,8817,8818,8952,8953,8954,8955,8956,8665,8566,8664,8739,


            /*
            //二十部小组，暂时去掉
            //8773,8772,8771,8770,
            //锐创十三部，哲时去掉
           // 8532,8395,8393,8236,

            //芳村一部,暂时去掉
            //8302,8634,8415,8308,8306,8305,

            //芳村十一部，暂时去掉
            //8819,8824,8823,8822,8821,

            8400,8510,8698,8474,8461,8514,8490,8460,8462,8614,8578,8441,8739,
            9045,9046,9047,9048
            */
            //去掉智富
            
            49,
            8432,8442,8514,8441,8436,8481,8443

            /*
            4,41,49,

            9029,8484,8302,8540,8314,8320,8871,8820,8819,8541,
            8321,8319,8303,8432,8442,9109,9102,
            

            9127,8552,8305,8553,8308,8629,8310,8635,8312,8684,8325,8686,
            8331,8687,8333,8765,8343,8821,8417,8822,8419,8823,8430,8824,
            8441,8826,8481,8827,8487,8872,8512,8873,8526,8874,8549,8875,
            8309,8884,8324,8885,8332,8919,8415,8934,8425,8935,8443,8946,
            8511,8973,8548,8974,8311,8976,8335,9032,8436,8514,9081,9040,
            9039,9033,8306,8486,8418,8330,8551,9125,9117,9103,9118,9105,
            9119,9110,9120,9112,9114,9124,9123,9122,9121,9113,9111,9106,
            9104,9115,9116
            */
         ),
        'get18000'      => array(
            //云集
            19,49,69,8198,8432,9044,8368,
            9091,9046,8233,9047,8400,9048,8510,8638,9090,9088,9056,9052,
            8741,8637,8474,8366,9045,9151,9150, 

           /*2018-05-15宝盛上拽暂时关掉
            6,61,8458,8459,8366,8399,8368,8233,8440,8442,8443,8436,
            8563,8565,8558,8562,8561,8556,8560,8564,8557,8559,8566,8664,8739,8862, //宝盛部门
            8901,8912,
            //宝盛小组
            8706,8829,8708,8571,8709,8584,8740,8620,8780,8699,8782,8703,8814,
            8567,8568,8569,8573,8574,8575,8579,8580,8581,8582,8585,8586,8587,
            8588,8591,8592,8593,8594,8597,8598,8599,8600,8601,8603,8604,8605,
            8606,8609,8610,8611,8612,8615,8616,8617,8618,8621,8622,8623,8624,
            8665,8639,8637,8589,8590,8607,8608,8595,8583,8619,8577,8613,8576,
            8570,8625,8638,8746,8869,8868,8867,8864,8705,8602,8818,8817,8816,
            8815,8626,8572,8704,8700,8949,8867,8960,8869,8868,8864,8902,8903,
            9144,8943,8914,8881,9100,8950,9053,8940,8880,8877,8596,9064,9049,
            8947,9101,8905,8913,8944,
          //*/  
     
            //电商
            9074,9095,
            
            //电商小组
            9075,9087,9076,9107,9097,9096 ,           
            //招聘培训
            8740,8746,8815,8816,8817,8818,8952,8953,8954,8955,8956,8665,8566,8664,8739, 
           

            //去掉智富
            
            49,
            8432,8442,8514,8441,8436,8926,8481,8443

            /*
            4,41,49,

            9029,8484,8302,8540,8314,8320,8871,8820,8819,8541,
            8321,8319,8303,8432,8442,9109,9102,
            

            9127,8552,8305,8553,8308,8629,8310,8635,8312,8684,8325,8686,
            8331,8687,8333,8765,8343,8821,8417,8822,8419,8823,8430,8824,
            8441,8826,8481,8827,8487,8872,8512,8873,8526,8874,8549,8875,
            8309,8884,8324,8885,8332,8919,8415,8934,8425,8935,8443,8946,
            8511,8973,8548,8974,8311,8976,8335,9032,8436,8514,9081,9040,
            9039,9033,8306,8486,8418,8330,8551,9125,9117,9103,9118,9105,
            9119,9110,9120,9112,9114,9124,9123,9122,9121,9113,9111,9106,
            9104,9115,9116
            */
         
         ),
        'getSpot'       => array(8198,8366,8399,8368,8233,8440,8442,8443,8432,8436)
    );
    
    //创建哪些报告
    $createReportConfig=array(
        'result'    => array(
            'get360ClassInfo'=>array(
                'compile_dir'       =>'templates_c/',
                'cache_dir'         =>'cache/result/360/',
                'template_dir'      =>'templates/result/360/',
                'config_dir'        =>'../interface/config/',
                'startDate'         =>'20130609',
                'endDate'           =>'20130630',
                'smallOrderMainKPI' =>'小额订单'        
            )/*,
            'resultKPIDataGet'=>array(
                'compile_dir'       =>'templates_c/',
                'cache_dir'         =>'cache/result/3600/',
                'template_dir'      =>'templates/result/3600/',
                'config_dir'        =>'../interface/config/',
                'startDate'         =>'20130401',
                'endDate'           =>'20130430',
                'smallOrderMainKPI' =>'3600上拽订单'                
            )*/,
            'get18000ClassInfo'=>array(
                'compile_dir'       =>'templates_c/',
                'cache_dir'         =>'cache/result/18000/',
                'template_dir'      =>'templates/result/18000/',
                'config_dir'        =>'../interface/config/',
                'startDate'         =>'20130311',
                'endDate'           =>'20130430',
                'smallOrderMainKPI' =>'18000上拽订单'                                 
            )
        ),
        'process'   => array(),
        'labor'     => array()
    );
    

    //连接数据库
  /*    
    $webnerveMssqlDBInfo = Array(
        "host" => "webSale",
        "user" => "U_Linux_Php_SalerIndexes",   
        "passwd" => "3f3dlfs833ddk",          
        'database' => 'db_companyData'
    );
  //*/
    
    
///*
            //连接数据库
    $webnerveMssqlDBInfo = Array(
        "host" => "stdb",
        "user" => "U_Linux_Php_SalerIndexes",
        "passwd" => "3f3dlfs833ddk",
        'database' => 'db_companyData'
    );
    $webnerveMssqlDBInfo_1 = Array(
        "host" => "stdb",
        "user" => "U_Linux_Php_SalerIndexes",
        "passwd" => '3f3dlfs833ddk',
        'database' => 'DB_WebNerveData'
    );
//*/

    
/*         
    $webnerveMssqlDBInfo = Array(
                "host" => "webSale1",
                "user" => "sa",   
                "passwd" => "sql2005",          
                'database' => 'db_companyData'
                ); 
*/
       
       
?>
