<?php

$debug=0;

$ProDir="http://".$_SERVER['SERVER_NAME'].'/'.str_replace('/var/www/html/','/', dirname(_FILE_));
global $DBNerveInfo ;
$DBNerveInfo= Array(
   "host" => "db_cms",
    "user" => "u_dongzhibin",
    "passwd" => '123456',
    'database' => 'DB_WebNerveData'//数据库名称，方便后面的相对路径调用
);

?>
