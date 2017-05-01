<?php
/**
 * Created by PhpStorm.
 * User: Maa
 * Date: 1/12/2017
 * Time: 10:34 PM
 */
class Connection
{
  public $pdo;
  function __construct()
  {
      $this->pdo;
  }

  function GetConnect()
  {

       $servername = "localhost";
       $dbname = "ladylike";
       $username = "root";
       $password = "";

       try
       {
          $this->pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
           //$DB->set_charset('utf8');
            // set the PDO error mode to exception
         $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         return $this->pdo;
            //echo "Connected successfully";
       }
       catch(PDOException $e)
       {
            echo "Connection failed: " . $e->getMessage();
       }
  }
}