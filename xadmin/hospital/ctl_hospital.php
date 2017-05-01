<?php
/**
 * Created by PhpStorm.
 * User: Maa
 * Date: 2/10/2017
 * Time: 10:32 PM
 */

require_once "mdl_hospital.php";

/*
 * @Obj : $objDoctor of State Class
*/
$objDoctor  = new Hospital();
$RequestHandlerAction = "";
$HospitalSno = "";

/*
 * @Var : $RequestHandlerAction is Request handler variable
 * @example : action=add.
*/
$RequestHandlerAction = $_REQUEST['action'];


/*DoctorSno  request only set in edit mode (in other mode it will give error undefined index)
 thats why this condition is set
 */

if($RequestHandlerAction === "edit")
{
   $HospitalSno = $_REQUEST['hospitalsno'];
}

//switch(!empty(strtolower($RequestHandlerAction)))
switch(trim($RequestHandlerAction))
{
    /*@uses : To show default view mode pade*/
    case "view":
    {
        $objDoctor->GetDoctor($RequestHandlerAction);
        break;
    }
    /*@uses : To show add mode in screen layout*/
    case "add":
    {
        $objDoctor->AddHospital($RequestHandlerAction);
        break;
    }
    /*@uses : To show edit mode in screen layout*/
    case "edit":
    {
        $objDoctor->EditHospital($RequestHandlerAction,$HospitalSno);
        break;
    }
    /*@uses : To Submit the form in db*/
    case "submit":
    {
        $objDoctor->SubmitHospital($_REQUEST);
        break;
    }
    /*@uses : Get datatable data in json format when page load*/
    case "getdatatable":
    {
        $objDoctor->GetDatatable($_REQUEST);
        break;
    }
    /*@uses : Delete datatable column data*/
    case "deletehospitalrecord":
    {
        $objDoctor->DeleteHospitalRecord($_REQUEST);
        break;
    }
    case "loadStateDrodpdown":
    {
        $objDoctor->LoadStateDrodpdown($_REQUEST);
        break;
    }
    case "loadtalukadrodpdown":
    {

        $objDoctor->LoadTalukaDrodpdown($_REQUEST);
        break;
    }
    case "loadcountrydrodpdown":
    {
        $objDoctor->LoadCountryDrodpdown($_REQUEST);
        break;
    }

}

class Hospital
{
    /* @Obj : Object variable for further use */
    public $mdl_Hospital;
    public $ObjConn;
    public $ObjBase;
    public $ObjPdo;
    public $ObjSession;

    function __construct()
    {
        $this->mdl_Hospital = new mdl_Hospital();
        $this->ObjConn = $this->mdl_Hospital->ObjConn;
        $this->ObjBase = $this->mdl_Hospital->ObjBase;
        $this->ObjPdo = $this->mdl_Hospital->ObjPdo;
        $this->ObjSession = $this->mdl_Hospital->ObjSession;
    }

    /* @uses : To show default view mode pade
     * @param : $RequestHandlerAction Request of default mode (action=view)
     */
    function GetDoctor($RequestHandlerAction)
    {
        include "hospital.php";
    }

    /* @uses : To show add mode in screen layout
     * @param : $RequestHandlerAction Request of add mode (action=add)
     */
    function AddHospital($RequestHandlerAction)
    {
        $this->ObjSession->HiddenHospitalSno = 0;
        $GetCityName = "";
        //Call model function to get Edit mode data
        $GetCityName = $this->mdl_Hospital->GetCityName();

        $this->ObjBase->UpdateUserActivityTime();
        include "aehospital.php";
    }

    /* @uses : To show edit mode in screen layout
     * @param : $RequestHandlerAction Request of edit mode (action=edit)
     * @param : $DoctorSno primary key of selected record
     */
    function EditHospital($RequestHandlerAction,$HospitalSno)
    {
        $this->ObjSession->HiddenHospitalSno = intval($HospitalSno);
        $this->ObjBase->UpdateUserActivityTime();

        //Call model function to get Edit mode data
        $GetCityName = $this->mdl_Hospital->GetCityName();

        $HospitalData = "";
        $HospitalData = $this->mdl_Hospital->EditHospital(intval($HospitalSno));
        include "aehospital.php";
    }

    /* @uses : To Submit the form in db
     * @param : $Requests Request of edit mode (action=submit) and other form controls
     */
    function SubmitHospital($Requests)
    {
        $HospitalSno = intval($Requests['hiddenHospitalSno']);
        if($this->ObjSession->HiddenHospitalSno === $HospitalSno)
        {
            $this->ObjBase->UpdateUserActivityTime();
            $this->mdl_Hospital->SubmitHospital($Requests);
        }
        else
        {
            echo "SRR403";
            die();
        }

    }

    /* @uses : Get datatable data in json format when page load
     * @param : $Requests Request of data table(action=getdatatable)
     * @return : Return all hospital table data
     */
    function GetDatatable($Requests)
    {
        $this->mdl_Hospital->GetHospital();
    }

    /* @uses : Delete datatable column data
     * @param : $Requests (action=delete) and selected row primary key
     */
    function DeleteHospitalRecord($Requests)
    {
        $this->ObjBase->UpdateUserActivityTime();
        $HospitalSno = $_POST['hospitalsno'];
        $this->mdl_Hospital->DeleteHospitalRecord(intval($HospitalSno));
    }

    function LoadStateDrodpdown()
    {
        $CitySno = $_GET['citysno'];
        return $this->mdl_Hospital->LoadStateDrodpdown(intval($CitySno));
    }
    function LoadTalukaDrodpdown()
    {
        $CitySno = $_GET['citysno'];
        return $this->mdl_Hospital->LoadTalukaDrodpdown(intval($CitySno));
    }
    function LoadCountryDrodpdown()
    {
        $CitySno = $_GET['citysno'];
        return $this->mdl_Hospital->LoadCountryDrodpdown(intval($CitySno));
    }
}
