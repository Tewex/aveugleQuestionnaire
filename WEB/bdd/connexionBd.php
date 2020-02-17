<?php

require_once "informationBd.php";
  function connectDb()
  {

    static $db = null;

    if($db === null){
      try 
      {
          $dbb = new PDO("mysql:host=" . SERVER . ";dbname=" . DATABASE_NAME, PSEUDO, PWD, array('charset' => 'utf8'));
          $dbb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } 
      catch (PDOException $e) 
      {
          die('Erreur : ' . $e->getMessage());
      }
    }

    return $db;

  }