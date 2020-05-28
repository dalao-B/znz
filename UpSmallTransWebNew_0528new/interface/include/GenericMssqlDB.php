<?php
/* GenericMssqlDB.php - mssql database interface */

/* Copyright (c) 2008 by Compass.cn, P.R.China */

/*
modification history
--------------------
2008/3/27, Zhou Haijian, Create
*/

/* sql varable type mapping */
/* type => name, [has_length] */
$mssqlVars = Array (
    SQLINT4 => Array("int", false),
    SQLVARCHAR => Array("varchar", true),
    SQLFLT8 => Array("float", false),
);

/* get string for the variable type */
function mssqlVarGet($type, $length)
{
    global $mssqlVars;
    
    $var = $mssqlVars[$type];
    if (!$var)
        return "";
    
    $varStr = $var[0];
    if (isset($var[1]) && $var[1])
        $varStr .= "(".$length.")";
        
    return $varStr;
}

/* class for generic mssql database interface */
class GenericMssqlDB
{
    var $host = '';
    var $user = '';
    var $passwd = '';
    var $db = NULL;    

    /* open database connection */
    function open($dbInfo)
    {
        $this->host = $dbInfo['host'];
        $this->user = $dbInfo['user'];
        $this->passwd = $dbInfo['passwd'];
        $this->db = mssql_connect($this->host, $this->user, $this->passwd);
        if(!$this->db)
            return 'ERROR';
        
        return 'OK';
    }
    
    /* close database connection */
    function close()
    {
        mssql_close($this->db);
    }
    
    /* execute sql statement */
    function sqlExec($stmt)
    {
        if (!mssql_query($stmt, $this->db))
            return 'ERROR';
            
        return 'OK';
    }
    
    /* execute sql statement and fetch all results */
    function sqlFetchAll($stmt, $isFetchArray = false)
    {
        $res = mssql_query($stmt, $this->db);
        if (!$res)
            return null;

        $recordSet = Array();

        if ($isFetchArray)
        {
            /* fetch array with column names */
            while ($record = mssql_fetch_array($res, MSSQL_ASSOC))
                $recordSet[] = $record;
        }
        else
        {
            /* only fetch data */
            while ($record = mssql_fetch_row($res))
                $recordSet[] = $record;
        }
        
        return $recordSet;
    }
    
    /* execute sql statement and fetch one result */
    function sqlFetchOne($stmt, $isFetchArray = false)
    {
        $res = mssql_query($stmt, $this->db);
        if (!$res)
            return null;
        
        if ($isFetchArray)
            $record = mssql_fetch_array($res, MSSQL_ASSOC);
        else
            $record = mssql_fetch_row($res);
            
        if (!$record)
            return null;
            
        return $record;
    }
    
    /* transaction operations */
    /* begin/commit/rollback */
    function transaction($op = 'begin')
    {
        switch($op)
        {
            case 'begin':
                $sqlStr = 'BEGIN TRANSACTION';
                break;
            case 'commit':
                $sqlStr = 'COMMIT TRANSACTION';
                break;
            case 'rollback':
                $sqlStr = 'ROLLBACK TRANSACTION';
                break;
            default:
                return 'ERROR';
        }
        
        if (!mssql_query($sqlStr, $this->db))
            return 'ERROR';
            
        return 'OK';
    }
    
    /* check parameters */
    function parasCheck(&$paraList)
    {
        foreach ($paraList as $name => $info)
        {
            if (!isset($info[0]) || !$info[0]) /* set default values on null */
            {
                if ($info[1] == SQLVARCHAR)
                    $paraList[$name][0] = '';
                else
                    $paraList[$name][0] = 0;
            }
        }
    }
    
    /* call procedure:
       this function is only supporting output parameters.
       to get record set, please refer to 'procCall' function
    */
    function procCall($procName, &$paraList)
    {
        $sqlStr = "";
        
        /* check paras */
        $this->parasCheck($paraList);
        
        /* para: para_name => value, type, [maxlen = 0], [is_output = false], [is_null = false], [is_inout = false] */
        foreach ($paraList as $name => $info)
        {
            /* declare output parameters */
            if (isset($info[3]) && $info[3])
            {
                $sqlStr .= "declare @".$name." ".mssqlVarGet($info[1], $info[2])."\n";
                
                if (isset($info[5]) && $info[5]) /* in and out parameter */
                {
                    if ($info[1] == SQLVARCHAR)
                        $sqlStr .= "set @".$name." = '".$info[0]."'\n";
                    else
                        $sqlStr .= "set @".$name." = ".$info[0]."\n";
                }
            }
        }
        
        /* main body for calling procedure */
        $sqlStr .= "exec ".$procName;
        $cnt = 0;
        $outputList = Array();
        foreach ($paraList as $name => $info)
        {
            if ($cnt > 0)
                $sqlStr .= ",";
            
            /* check output parameters */
            if (isset($info[3]) && $info[3])
            {
                $sqlStr .= " @".$name." output";
                $outputList[] = $name;
            }
            else
            {
                if ($info[1] == SQLVARCHAR)
                    $sqlStr .= " '".$info[0]."'"; /* append string value */
                else
                    $sqlStr .= " ".$info[0];
            }
            
            $cnt ++;
        }
        
        /* select results */
        if (count($outputList) > 0)
        {
            $sqlStr .= "\nselect";
            for ($i = 0; $i < count($outputList); $i ++)
            {
                if ($i > 0)
                    $sqlStr .= ",";
                
                $sqlStr .= " @".$outputList[$i]." ".$outputList[$i];
            }
        }
        
        /* execute the query */
        if (count($outputList) == 0)
            return $this->sqlExec($sqlStr);
        
        $record = $this->sqlFetchOne($sqlStr, true);
        if ($record == null)
            return 'ERROR';
                
        foreach ($outputList as $name)
            $paraList[$name][0] = $record[$name];
        
        return 'OK';
    }
    
    /* call procedure in transaction */
    function procCall_inTrans($procName, &$paraList)
    {
        if ($this->transaction('begin') != 'OK')
            return 'ERROR';
        
        if ('OK' != $this->procCall($procName, $paraList))
        {
            $this->transaction('rollback');
            return 'ERROR';
        }
       
        if ('OK' != $this->transaction('commit'))
            return 'ERROR';
            
        return 'OK';
    }
    
    /* call procedure (extended):
      note: this function is supporting both output parameters and record set.
            for some procedures, parameter checking may fail with this function. 
            in this case, function 'procCall' is preferred.
    */
    function procCall_ext($procName, &$paraList, $getRecords = false, &$recordSet = null)
    {
        /* check paras */
        $this->parasCheck($paraList);
        
        /* init */
        $stmt = mssql_init($procName, $this->db);
        if (!$stmt)
            return 'ERROR';
        
        /* para: para_name => value, type, [maxlen = 0], [is_output = false], [is_null = false] */
        foreach ($paraList as $name => $info)
        {
            $type = $info[1];
            $isOutput = false;
            $isNull = false;
            $maxLen = 0;
            
            if (isset($info[2]))
                $maxLen = $info[2];
            if (isset($info[3]))
                $isOutput = $info[3];
            if (isset($info[4]))
                $isNull = $info[4];
                
            if (!mssql_bind($stmt, "@".$name, $paraList[$name][0], 
                            $type, $isOutput, $isNull, $maxLen))
                return 'ERROR';
        }
        
        $res = mssql_execute($stmt);
        if (!$res)
            return 'ERROR';
        
        if ($getRecords)
        {
            $recordSet = Array();
            while ($record = mssql_fetch_array($res))
                $recordSet[] = $record;
        }
        
        return 'OK';
    }
}
?>
