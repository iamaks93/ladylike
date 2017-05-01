<?php
require_once '../core/connection.php';
include "../core/base.php";
/**
 * Created by PhpStorm.
 * User: Maa
 * Date: 1/10/2017
 * Time: 10:33 PM
 */

  $objlogin  = new Login(); // Object of login class

  $action  = $_REQUEST['action']; // Which function need to call
  $email  = $_REQUEST['email']; // User email
  $password  = $_REQUEST['password']; // User Passowrd

  switch($action) //Get Action
  {
     case "checklogin":
     {
         $objlogin->CheckLogin($email,$password); // Calling checklogin function
     }

  }

class Login
{
    public $objbase,$ConnObj;
    function __construct()
    {
       $this->objbase = new Base(); // Common function object
       $this->ConnObj = new Connection(); // Connection object
    }

    /*CheckLogin : Used for checklogin
      arguments :
                1)$email = user email
                2) $password = user passowrd
    */
    function CheckLogin($email, $password)
    {
        $this->objbase->Login($email,$password);
    }
}
