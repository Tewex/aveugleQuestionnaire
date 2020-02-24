<?php

session_start();
$_SESSION = array();

if(ini_get("session.use_cookies")){
    setcookie(session_name(), '', 0);
}

session_destroy();
header("Location: index.php");