<?php
require_once "mdl_dashboard.php";
/**
 * Created by PhpStorm.
 * User: Maa
 * Date: 2/10/2017
 * Time: 10:32 PM
 */

//$url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
//$UrlGetter = parse_url($url);
//$args = explode("/",$UrlGetter['path']);

$objDash  = new Dashboard();
$RequestHandler = $_REQUEST['action'];
switch(!empty($RequestHandler))
{
    case "view" :
    {
        $objDash->GetDashBoard();
    }
}

if(!empty($args[5]) && $args[5] == "view")
{

    $objDash->GetDashBoard();
}


class Dashboard
{
    var $mdl_dashboard;
    function __construct()
    {
        $this->mdl_dashboard = new mdl_dashboard();
    }

    function GetDashBoard()
    {
        include "dashboard.php";
    }
}
