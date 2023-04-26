<?php
require_once('config.php');
class DataBase 
{
  public static function connect():PDO
  {
    try {
      $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
      ];
      return new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_MDP, $options);
    } catch (PDOException $e) {
      die("Erreur de connexion : " . $e->getMessage());
    }
  }
  
}
?>