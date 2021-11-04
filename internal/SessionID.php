<?php

function getNewSessionID(){
    $_SESSION["COUNTER"] = $_SESSION["COUNTER"] + 1;
    return $_SESSION["COUNTER"];
}

session_start();
if(!isset($_SESSION["COUNTER"])){
    $_SESSION["COUNTER"] = 0;
}
$_SESSION["COUNTER"] = $_SESSION["COUNTER"] + 1;

?>