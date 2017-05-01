<?php
/**
 * Created by PhpStorm.
 * User: Maa
 * Date: 2/10/2017
 * Time: 10:32 PM
 */

require_once "mdl_doctor.php";

/*
 * @Obj : $objDoctor of State Class
*/
$objDoctor  = new Doctor();
$RequestHandlerAction = "";
$doctorsno = "";

/*
 * @Var : $RequestHandlerAction is Request handler variable
 * @example : action=add.
*/

$RequestHandlerAction = $_REQUEST['action'];


/*DoctorSno  request only set in edit mode (in other mode it will give error undefined index)
 thats why this condition is set
 */
if($RequestHandlerAction == "edit")
{
    $doctorsno = isset($_REQUEST['doctorsno']) ? $_REQUEST['doctorsno'] : 0;
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
        $objDoctor->AddDoctor($RequestHandlerAction);
        break;
    }
    /*@uses : To show edit mode in screen layout*/
    case "edit":
    {
        $objDoctor->EditDoctor($RequestHandlerAction,$doctorsno);
        break;
    }
    /*@uses : To Submit the form in db*/
    case "submit":
    {
        $objDoctor->SubmitDoctor($_REQUEST);
        break;
    }
    /*@uses : Get datatable data in json format when page load*/
    case "getdatatable":
    {
        $objDoctor->GetDatatable($_REQUEST);
        break;
    }
    /*@uses : Delete datatable column data*/
    case "deletedoctorrecord":
    {
        $objDoctor->DeleteDoctorRecord($_REQUEST);
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

class Doctor
{
    /* @Obj : Object variable for further use */
    public $mdl_Doctor;
    public $ObjConn;
    public $ObjBase;
    public $ObjPdo;
    public $ObjSession;

    function __construct()
    {
        $this->mdl_Doctor = new mdl_Doctor();
        $this->ObjConn = $this->mdl_Doctor->ObjConn;
        $this->ObjBase = $this->mdl_Doctor->ObjBase;
        $this->ObjPdo = $this->mdl_Doctor->ObjPdo;
        $this->ObjSession = $this->mdl_Doctor->ObjSession;
    }

    /* @uses : To show default view mode pade
     * @param : $RequestHandlerAction Request of default mode (action=view)
     */
    function GetDoctor($RequestHandlerAction)
    {
          //echo $this->ObjSession->DocAvtar;
          //exit;
        //echo realpath(basename(__FILE__,'/'));
        //exit;
        include "doctor.php";
    }

    /* @uses : To show add mode in screen layout
     * @param : $RequestHandlerAction Request of add mode (action=add)
     */
    function AddDoctor($RequestHandlerAction)
    {
        $GetDoctorData = "";
        $GetHospitalName = "";
        $this->ObjSession->HiddenDoctorSno = 0;
        $GetCityName = $this->mdl_Doctor->GetCityName();
        $GetHospitalName = $this->mdl_Doctor->GetHospitalName();
        $this->ObjBase->UpdateUserActivityTime();
        include "aedoctor.php";
    }

    /* @uses : To show edit mode in screen layout
     * @param : $RequestHandlerAction Request of edit mode (action=edit)
     * @param : $DoctorSno primary key of selected record
     */
    function EditDoctor($RequestHandlerAction, $DoctorSno)
    {
        $this->ObjSession->HiddenDoctorSno = intval($DoctorSno);
        $this->ObjBase->UpdateUserActivityTime();
        $DoctorData = "";
        //Call model function to get Edit mode data
        //$GetCountryName = $this->mdl_Doctor->GetCountryName();
        $GetHospitalName = $this->mdl_Doctor->GetHospitalName();
        $GetCityName = $this->mdl_Doctor->GetCityName();
        $DoctorData = $this->mdl_Doctor->EditDoctor(intval($DoctorSno));

        $this->ObjSession->DocAvtar = $DoctorData->Avtar;
        include "aedoctor.php";
    }

    /* @uses : To Submit the form in db
     * @param : $Requests Request of edit mode (action=submit) and other form controls
     */
    function SubmitDoctor()
    {
        $DoctorSno = intval($_POST['hiddenDoctorSno']);
        if($this->ObjSession->HiddenDoctorSno === $DoctorSno)
        {
            $this->ObjBase->UpdateUserActivityTime();
            $this->mdl_Doctor->SubmitDoctor();
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
        $this->mdl_Doctor->GetDoctor();
    }

    /* @uses : Delete datatable column data
     * @param : $Requests (action=delete) and selected row primary key
     */
    function DeleteDoctorRecord($Requests)
    {
        $this->ObjBase->UpdateUserActivityTime();
        $DoctorSno = $_POST['doctorsno'];
        $this->mdl_Doctor->DeleteDoctorRecord(intval($DoctorSno));
    }

    function LoadStateDrodpdown()
    {
        $CitySno = $_GET['citysno'];
        return $this->mdl_Doctor->LoadStateDrodpdown(intval($CitySno));
    }
    function LoadTalukaDrodpdown()
    {
        $CitySno = $_GET['citysno'];
        return $this->mdl_Doctor->LoadTalukaDrodpdown(intval($CitySno));
    }
    function LoadCountryDrodpdown()
    {
        $CitySno = $_GET['citysno'];
        return $this->mdl_Doctor->LoadCountryDrodpdown(intval($CitySno));
    }
}
