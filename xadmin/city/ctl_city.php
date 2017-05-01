<?php
/**
 * Created by PhpStorm.
 * User: Maa
 * Date: 2/10/2017
 * Time: 10:32 PM
 */

require_once "mdl_city.php";

/*
 * @Obj : $objCity of State Class
*/
$objCity  = new City();
$RequestHandlerAction = "";
$citysno = "";

/*
 * @Var : $RequestHandlerAction is Request handler variable
 * @example : action=add.
*/
$RequestHandlerAction = isset($_REQUEST['action']) ? $_REQUEST['action'] : "";


/*CitySno  request only set in edit mode (in other mode it will give error undefined index)
 thats why this condition is set
 */
if($RequestHandlerAction == "edit")
{
    $citysno = $_REQUEST['citysno'];
}

//switch(!empty(strtolower($RequestHandlerAction)))
switch(trim($RequestHandlerAction))
{
    /*@uses : To show default view mode pade*/
    case "view":
    {
        $objCity->GetState($RequestHandlerAction);
        break;
    }
    /*@uses : To show add mode in screen layout*/
    case "add":
    {
        $objCity->AddCity($RequestHandlerAction);
        break;
    }
    /*@uses : To show edit mode in screen layout*/
    case "edit":
    {
        $objCity->EditCity($RequestHandlerAction,$citysno);
        break;
    }
    /*@uses : To Submit the form in db*/
    case "submit":
    {
        $objCity->SubmitCity($_REQUEST);
        break;
    }
    /*@uses : Get datatable data in json format when page load*/
    case "getdatatable":
    {
        $objCity->GetDatatable($_REQUEST);
        break;
    }
    /*@uses : Delete datatable column data*/
    case "deletecityrecord":
    {
        $objCity->DeleteCityRecord($_REQUEST);
        break;
    }
    case "loadStateDrodpdown":
    {
        $objCity->LoadStateDrodpdown($_REQUEST);
        break;
    }
    case "loadtalukadrodpdown":
    {
        $objCity->LoadTalukaDrodpdown($_REQUEST);
        break;
    }

}

class City
{
    /* @Obj : Object variable for further use */
    public $mdl_City;
    public $ObjConn;
    public $ObjBase;
    public $ObjPdo;
    public $ObjSession;

    function __construct()
    {
        $this->mdl_City = new mdl_City();
        $this->ObjConn = $this->mdl_City->ObjConn;
        $this->ObjBase = $this->mdl_City->ObjBase;
        $this->ObjPdo = $this->mdl_City->ObjPdo;
        $this->ObjSession = $this->mdl_City->ObjSession;
    }

    /* @uses : To show default view mode pade
     * @param : $RequestHandlerAction Request of default mode (action=view)
     */
    function GetState($RequestHandlerAction)
    {
        include "city.php";
    }

    /* @uses : To show add mode in screen layout
     * @param : $RequestHandlerAction Request of add mode (action=add)
     */
    function AddCity($RequestHandlerAction)
    {
        $this->ObjSession->HiddenCitySno = 0;
        $GetCountryName = "";
        $GetCountryName = $this->mdl_City->GetCountryName();
        $this->ObjBase->UpdateUserActivityTime();
        include "aecity.php";
    }

    /* @uses : To show edit mode in screen layout
     * @param : $RequestHandlerAction Request of edit mode (action=edit)
     * @param : $CitySno primary key of selected record
     */
    function EditCity($RequestHandlerAction, $CitySno)
    {
        $this->ObjSession->HiddenCitySno = intval($CitySno);
        $this->ObjBase->UpdateUserActivityTime();

        $CityData = "";
        $GetCountryName = "";
       //Call model function to get Edit mode data
        $GetCountryName = $this->mdl_City->GetCountryName();

        $CityData = $this->mdl_City->EditCity(intval($CitySno));

        include "aecity.php";
    }

    /* @uses : To Submit the form in db */
    function SubmitCity()
    {
        $CitySno = intval($_POST['hiddenCitySno']);
        if($this->ObjSession->HiddenCitySno === $CitySno)
        {
            $this->ObjBase->UpdateUserActivityTime();
            $this->mdl_City->SubmitCity();
        }
        else
        {
            echo "SRR403";
            die();
        }
    }

    /* @uses : Get datatable data in json format when page load
     * @param : $Requests Request of data table(action=getdatatable)
     * @return : Return all city table data
     */
    function GetDatatable($Requests)
    {
        $this->mdl_City->GetState();
    }

    /* @uses : Delete datatable column data
     * @param : $Requests (action=delete) and selected row primary key
     */
    function DeleteCityRecord($Requests)
    {
        $this->ObjBase->UpdateUserActivityTime();
        $CitySno = $_POST['citysno'];
        $this->mdl_City->DeleteCityRecord(intval($CitySno));
    }

    function LoadStateDrodpdown()
    {
        $CountrySno = $_GET['countrysno'];
        return $this->mdl_City->LoadStateDrodpdown(intval($CountrySno));
    }
    function LoadTalukaDrodpdown()
    {
        $StateSno = $_GET['statesno'];
        return $this->mdl_City->LoadTalukaDrodpdown(intval($StateSno));
    }
}
