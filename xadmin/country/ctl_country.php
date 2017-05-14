<?php
/**
 * Created by PhpStorm.
 * User: Maa
 * Date: 2/10/2017
 * Time: 10:32 PM
 */
require_once "mdl_country.php";

/*$url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$UrlGetter = parse_url($url);
$urlpath = $UrlGetter['path'];
//print_r($urlpath);
echo "<pre>";
$args = explode("/",$urlpath);
print_r($args);
exit;*/
/*print_R($UrlGetter);
exit;*/
//$args = explode("/",$UrlGetter['path']);
/*$UrlGetter = parse_url($url);
$args = explode("/",$UrlGetter['path']);
echo "<pre>";
print_r($args);
exit;*/
/*var_dump($args);
var_dump(parse_url($url, PHP_URL_SCHEME));
var_dump(parse_url($url, PHP_URL_USER));
var_dump(parse_url($url, PHP_URL_PASS));
var_dump(parse_url($url, PHP_URL_HOST));
var_dump(parse_url($url, PHP_URL_PORT));
var_dump(parse_url($url, PHP_URL_PATH));
var_dump(parse_url($url, PHP_URL_QUERY));
var_dump(parse_url($url, PHP_URL_FRAGMENT));
exit;*/
/*
 * @Obj : $objCountry of Country Class
*/
$objCountry  = new Country();
$RequestHandlerAction = "";
$countrysno = "";
/*
 * @Var : $RequestHandlerAction is Request handler variable
 * @example : action=add.
*/

$RequestHandlerAction = $_REQUEST['action'];

/*CountrySno  request only set in edit mode (in other mode it will give error undefined index)
 thats why this condition is set
 */
if($RequestHandlerAction == "edit")
{
    $countrysno = $_REQUEST['countrysno'];
}

//switch(!empty(strtolower($RequestHandlerAction)))
switch(trim($RequestHandlerAction))
{
    /*@uses : To show default view mode pade*/
    case "view":
    {
        $objCountry->GetCountry($RequestHandlerAction);
        break;
    }
    /*@uses : To show add mode in screen layout*/
    case "add":
    {
        $objCountry->AddCountry($RequestHandlerAction);
        break;
    }
    /*@uses : To show edit mode in screen layout*/
    case "edit":
    {
        $objCountry->EditCountry($RequestHandlerAction,$countrysno);
        break;
    }
    /*@uses : To Submit the form in db*/
    case "submit":
    {
        $objCountry->SubmitCountry();
        break;
    }
    /*@uses : Get datatable data in json format when page load*/
    case "getdatatable":
    {
        $objCountry->GetDatatable();
        break;
    }
    /*@uses : Delete datatable column data*/
    case "deletecountryrecord":
    {
        $objCountry->DeleteCountryRecord($_REQUEST);
        break;
    }

}

class Country
{
    /* @Obj : Object variable for further use*/
    public $mdl_Country;
    public $ObjConn;
    public $ObjBase;
    public $ObjPdo;
    public $ObjSession;

    function __construct()
    {
        $this->mdl_Country = new mdl_Country();
        $this->ObjConn = $this->mdl_Country->ObjConn;
        $this->ObjBase = $this->mdl_Country->ObjBase;
        $this->ObjPdo= $this->mdl_Country->ObjPdo;
        $this->ObjSession = $this->mdl_Country->ObjSession;
    }

    /* @uses : To show default view mode pade
    * @param : $RequestHandlerAction Request of default mode (action=view)
    */
    function GetCountry($RequestHandlerAction)
    {
        include "country.php";
    }
    /* @uses : To show add mode in screen layout
    *  @param : $RequestHandlerAction Request of add mode (action=add)
    */
    function AddCountry($RequestHandlerAction)
    {
        $GetCountryData = "";
        $this->ObjSession->HiddenCountrySno = 0;
        $this->ObjBase->UpdateUserActivityTime();
        include "aecountry.php";
    }
    /* @uses : To show edit mode in screen layout
    * @param : $RequestHandlerAction Request of edit mode (action=edit)
    * @param : $StateSno primary key of selected record
    */
    function EditCountry($RequestHandlerAction,$CountrySno)
    {

        $this->ObjSession->HiddenCountrySno = intval($CountrySno);
        $this->ObjBase->UpdateUserActivityTime();

        $CountryData = "";
        //Call model function to get Edit mode data
        $CountryData = $this->mdl_Country->EditCountry(intval($CountrySno));
        include "aecountry.php";
    }
    /* @uses : To Submit the form in db
     * @param : $Requests Request of edit mode (action=submit) and other form controls
     */
    function SubmitCountry()
    {
        $Countrysno = intval($_POST['hiddenCountrySno']);
        if($this->ObjSession->HiddenCountrySno === $Countrysno)
        {
            $this->mdl_Country->SubmitCountry();
        }
        else
        {
            echo "SRR403";
            die();
        }
    }
    /* @uses : Get datatable data in json format when page load
     * @param : $Requests Request of data table(action=getdatatable)
     * @return : Return all country table data
     */
    function GetDatatable()
    {
         $this->mdl_Country->GetCountry();
    }
    /* @uses : Delete datatable column data
     * @param : $Requests (action=delete) and selected row primary key
     */
    function DeleteCountryRecord($Requests)
    {
        $this->ObjBase->UpdateUserActivityTime();
        $CountrySno = $_REQUEST['countrysno'];
        $this->mdl_Country->DeleteCountryRecord(intval($CountrySno));
    }
}
