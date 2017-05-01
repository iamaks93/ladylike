<?php
/**
 * Created by PhpStorm.
 * User: Maa
 * Date: 2/10/2017
 * Time: 10:32 PM
 */

require_once "mdl_speciality.php";

/*
 * @Obj : $objSpeciality of Speciality Class
*/
$objSpeciality  = new Speciality();
$RequestHandlerAction = "";
$specialitysno = "";

/*
 * @Var : $RequestHandlerAction is Request handler variable
 * @example : action=add.
*/
$RequestHandlerAction = $_REQUEST['action'];

/*Specialitysno  request only set in edit mode (in other mode it will give error undefined index)
 thats why this condition is set
 */
if($RequestHandlerAction == "edit")
{
    $specialitysno = $_REQUEST['specialitysno'];
}

//switch(!empty(strtolower($RequestHandlerAction)))
switch(trim($RequestHandlerAction))
{
    /*@uses : To show default view mode pade*/
    case "view":
    {
        $objSpeciality->GetSpeciality($RequestHandlerAction);
        break;
    }
    /*@uses : To show add mode in screen layout*/
    case "add":
    {
        $objSpeciality->AddSpeciality($RequestHandlerAction);
        break;
    }
    /*@uses : To show edit mode in screen layout*/
    case "edit":
    {
        $objSpeciality->EditSpeciality($RequestHandlerAction,$specialitysno);
        break;
    }
    /*@uses : To Submit the form in db*/
    case "submit":
    {
        $objSpeciality->SubmitSpeciality($_REQUEST);
        break;
    }
    /*@uses : Get datatable data in json format when page load*/
    case "getdatatable":
    {
        $objSpeciality->GetDatatable($_REQUEST);
        break;
    }
    /*@uses : Delete datatable column data*/
    case "deletespecialityrecord":
    {
        $objSpeciality->DeleteSpecialityRecord($_REQUEST);
        break;
    }

}

class Speciality
{
    /* @Obj : Object variable for further use*/
    public $mdl_Speciality;
    public $ObjConn;
    public $ObjBase;
    public $ObjPdo;
    public $ObjSession;

    function __construct()
    {
        $this->mdl_Speciality = new mdl_Speciality();
        $this->ObjConn = $this->mdl_Speciality->ObjConn;
        $this->ObjBase = $this->mdl_Speciality->ObjBase;
        $this->ObjPdo= $this->mdl_Speciality->ObjPdo;
        $this->ObjSession = $this->mdl_Speciality->ObjSession;
    }

    /* @uses : To show default view mode pade
    * @param : $RequestHandlerAction Request of default mode (action=view)
    */
    function GetSpeciality($RequestHandlerAction)
    {
      include "speciality.php";
    }
    /* @uses : To show add mode in screen layout
    *  @param : $RequestHandlerAction Request of add mode (action=add)
    */
    function AddSpeciality($RequestHandlerAction)
    {
        $this->ObjSession->HiddenSpecialitySno = 0;
        $this->ObjBase->UpdateUserActivityTime();
        include "aespeciality.php";
    }
    /* @uses : To show edit mode in screen layout
    * @param : $RequestHandlerAction Request of edit mode (action=edit)
    * @param : $SpecialitySno primary key of selected record
    */
    function EditSpeciality($RequestHandlerAction,$SpecialitySno)
    {

        $this->ObjSession->HiddenSpecialitySno = intval($SpecialitySno);
        $SpecialityData = "";

        $this->ObjBase->UpdateUserActivityTime();
        //Call model function to get Edit mode data
        $SpecialityData = $this->mdl_Speciality->EditSpeciality(intval($SpecialitySno));
        include "aespeciality.php";
    }
    /* @uses : To Submit the form in db
     * @param : $Requests Request of edit mode (action=submit) and other form controls
     */
    function SubmitSpeciality($Requests)
    {
        $this->ObjBase->UpdateUserActivityTime();
        $SpecialitySno = intval($Requests['hiddenSpecialitySno']);
        //unset($_SESSION['HiddenSpecialitySno']);

        if($this->ObjSession->HiddenSpecialitySno === $SpecialitySno)
        {
            $this->mdl_Speciality->SubmitSpeciality($Requests);
        }
        else
        {
            echo "SRR403";
            die();
        }

    }
    /* @uses : Get datatable data in json format when page load
     * @param : $Requests Request of data table(action=getdatatable)
     * @return : Return all speciality table data
     */
    function GetDatatable($Requests)
    {
         $this->mdl_Speciality->GetSpeciality();
    }
    /* @uses : Delete datatable column data
     * @param : $Requests (action=delete) and selected row primary key
     */
    function DeleteSpecialityRecord($Requests)
    {
        $this->ObjBase->UpdateUserActivityTime();
        $SpecialitySno = $_REQUEST['specialitysno'];
        $this->mdl_Speciality->DeleteSpecialityRecord(intval($SpecialitySno));
    }
}
