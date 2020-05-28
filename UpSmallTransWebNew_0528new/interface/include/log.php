<?php

function logMsg($level, $msg)
{
    echo "[".date("Y-m-d H:i:s")."] [".$level."] [".$msg."]\n";
}

?>