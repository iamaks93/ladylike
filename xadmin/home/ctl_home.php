<?php
require_once "mdl_home.php";
/**
 * Created by PhpStorm.
 * User: Maa
 * Date: 3/1/2017
 * Time: 10:49 PM
 */

$objHome  = new Home();
$RequestHandlerAction = "";
$homesno = "";
$RequestHandlerAction = $_REQUEST['action'];

// CountrySno  request only set in edit mode (in other mode it will give error undefined index)
if($RequestHandlerAction == "edit")
{
    $countrysno = $_REQUEST['countrysno'];
}

//switch(!empty(strtolower($RequestHandlerAction)))
switch(trim($RequestHandlerAction))
{
    case "view":
    {
        $objCountry->GetCountry($RequestHandlerAction);
        break;
    }
    case "add":
    {
        $objCountry->AddCountry($RequestHandlerAction);
        break;
    }
    case "edit":
    {
        $objCountry->EditCountry($RequestHandlerAction,$countrysno);
        break;
    }
    case "submit":
    {
        $objCountry->SubmitCountry($_REQUEST);
        break;
    }
    case "getdatatable":
    {
        $objCountry->GetDatatable($_REQUEST);
        break;
    }
    case "deletecountryrecord":
    {
        $objCountry->DeleteCountryRecord($_REQUEST);
        break;
    }

}
class Home
{
    var $mdl_Country;
    var $ObjConn;
    var $ObjBase;
    var $ObjPdo;
    var $ObjSession;
    function __construct()
    {
        $this->mdl_Country = new mdl_Country();
        $this->ObjConn = $this->mdl_Country->ObjConn;
        $this->ObjBase = $this->mdl_Country->ObjBase;
        $this->ObjPdo= $this->mdl_Country->ObjPdo;
        $this->ObjSession = $this->mdl_Country->ObjSession;
    }

    function GetCountry($RequestHandlerAction)
    {
        include "country.php";
    }
    function AddCountry($RequestHandlerAction)
    {
        $GetCountryData = "";
        include "aecountry.php";
    }
    function EditCountry($RequestHandlerAction,$CitySno)
    {
        $CountryData = "";
        $CountryData = $this->mdl_Country->EditCountry(intval($CitySno));
        include "aecountry.php";
    }
    function SubmitCountry($Requests)
    {
        $this->mdl_Country->SubmitCountry($Requests);
    }
    function GetDatatable($Requests)
    {
         $this->mdl_Country->GetCountry();
    }
    function DeleteCountryRecord($Requests)
    {
        $CountrySno = $_REQUEST['countrysno'];
       $this->mdl_Country->DeleteCountryRecord(intval($CountrySno));
    }
}
