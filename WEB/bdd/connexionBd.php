<?php
require_once "informationBd.php";
class BDD
{
  private static $objInstance = null;
  private function __construct(){}
  private function _clone(){}

  public static function UserDbConnection()
{

  if (!self::$objInstance) 
  {
      try 
      {
          self::$objInstance = new PDO("mysql:host=".SERVER.";dbname=".DATABASE_NAME, PSEUDO, PWD);
          self::$objInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } 
      catch (PDOException $e) 
      {
          die('Erreur : ' . $e->getMessage());
      }
  }

  return self::$objInstance;
}

final public static function __callStatic( $chrMethod, $arrArguments ) {
    $objInstance = self::UserDbConnection();
    return call_user_func_array(array($objInstance, $chrMethod), $arrArguments);
    }
}