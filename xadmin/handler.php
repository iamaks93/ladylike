<?php
/**
 * Created by PhpStorm.
 * User: Maa
 * Date: 2/10/2017
 * Time: 11:31 PM
 */
$RequestHandler = $_REQUEST['action'];

switch($RequestHandler)
{
    case "view" :
    {

        include "dashboard/controller/ctl_dashboard.php";
        break;
        //$objDash->check();
    }
}