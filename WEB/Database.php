<?php
require_once "informationBd.php";
class Database
{
  private static $instance = null;
  private function _clone(){}
  private function __construct(){}

  public static function getInstance()
  {

    if(self::$instance === null){
      try 
    {
        self::$instance = new PDO("mysql:host=" . SERVER . ";dbname=" . DATABASE_NAME, PSEUDO, PWD);
        self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } 
    catch (PDOException $e) 
    {
        die('Erreur : ' . $e->getMessage());
    }
    }

    return self::$instance;

  }

  final public static function __callStatic( $chrMethod, $arrArguments ) {
    $objInstance = self::getInstance();
    return call_user_func_array(array($objInstance, $chrMethod), $arrArguments);
    }
}