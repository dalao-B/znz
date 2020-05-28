<?php
/* valueFormat.php - format values, for example:123456789->123,456,789  */

/* Copyright (c) 2011 by Compass.cn, P.R.China */

/*
modification history
--------------------
2012/03/15, Zhou Ke, add getProductSuitId function
										 add newTransGetAll function
*/    
function formatValueToMillion($input,$dec=10000){
    if(strlen($input)<=4){
        $value=number_format($input);    
    }else{
        $value=$input/$dec;
        $value=number_format(round($value,2),2)."万元";    
    }
    return $value;

}

//formatValueToMillion(123456789);

?>