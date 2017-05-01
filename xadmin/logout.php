<?php
/**
 * Created by PhpStorm.
 * User: Maa
 * Date: 2/12/2017
 * Time: 1:08 PM
 */

require_once "../core/base.php"; // include base function file
require_once '../core/session.php'; // Include Connection File
$ObjBase = new Base(); // Create object to access Base Functions

$objlogout = new LogOut();
$RequestHandlerAction = $_REQUEST['action'];

switch(trim($RequestHandlerAction))
{
    case "logout":
    {
        $objlogout->Logout($RequestHandlerAction);
        break;
    }
    case "checkuserinactivity":
    {
        $objlogout->CheckUserInActivity($RequestHandlerAction);
        break;
    }
}

class LogOut
{
    var $ObjBase;
    var $ObjSession;
    function __construct()
    {
        $this->ObjBase = new Base();
        $this->ObjSession = Session::getInstance();
    }

    function Logout($Request)
    {
          $this->ObjBase->SubmitUserLogOutTime($this->ObjSession->UserSessionID);
          $this->ObjSession->destroy();
          header("location:index.php");

    }
    function CheckUserInActivity()
    {

        if(isset($this->ObjSession->LAST_ACTIVITY))
        {
           // Set return as array
            $return = array();
            //if(time() - $this->ObjSession->LAST_ACTIVITY > 60) // 1 Minute
            if(time() - $this->ObjSession->LAST_ACTIVITY > 900)
            {
                $return['loggedIn'] = false;
                //$this->ObjBase->SubmitUserLogOutTime($this->ObjSession->UserSessionID);
                //$this->ObjSession->destroy();
            }
            else
            {
                $this->ObjBase->LAST_ACTIVITY = time();
                $return['loggedIn'] = true;
            }
             echo json_encode($return);
        }
    }
}
?>
