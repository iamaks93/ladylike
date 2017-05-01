<?php
require_once "../../core/base.php";
require_once "../../core/connection.php";

/**
 * Created by PhpStorm.
 * User: Maa
 * Date: 2/12/2017
 * Time: 12:02 PM
 */


class mdl_dashboard
{
    var $objconn;
    var $objbase;
    function __construct()
    {
        $this->objconn = new Connection();
        $this->objbase = new Base();
    }
    function Test()
    {

    }
}