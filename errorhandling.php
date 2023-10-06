<?php

include_once "log.php";

function handleErrors($errno, $errMsg, $errFile, $errLine) {
    $log = new ErrorLog($errno, $errMsg, $errFile, $errLine);
    $log->WriteError();
    echo "An error occurred. Please consult the error log file for more information.";
    exit();
}

set_error_handler("handleErrors");

function handleUncaughtException($e){
    $log = new ErrorLog($e->getCode(), $e->getMessage(), 
                  $e->getFile(), $e->getLine());
    $log->WriteError();
    exit("An unexpected error occurred. Please contact the system 	  administrator!");
    }
    set_exception_handler('handleUncaughtException');
    

?>