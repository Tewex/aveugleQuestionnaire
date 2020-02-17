<?php

require "../connexionBd.php";

$db = connectDB();

if (session_status() == PHP_SESSION_NONE)
{
  session_start();
}

?>