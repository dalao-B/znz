<?php
/* wnMssqlDB.php - mssql database interface */

/* Copyright (c) 2008 by Compass.cn, P.R.China */

/*
modification history
--------------------
2008/9/3, Zhou Haijian, Create
*/

require_once "db/GenericMssqlDB.php";
require_once "webNerve/wnMssqlDBInfo.php";

/* class for mssqlcle database interface */
class wnMssqlDB extends GenericMssqlDB
{
    /* open database */
    function open()
    {
        global $wnMssqlDBInfo; /* 修改 mssql 连接信息 */
        return parent::open($wnMssqlDBInfo);
    }
}

?>