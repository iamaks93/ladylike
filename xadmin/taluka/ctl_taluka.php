<?php
/**
 * Created by PhpStorm.
 * User: Maa
 * Date: 2/10/2017
 * Time: 10:32 PM
 */

require_once "mdl_taluka.php";

/*
 * @Obj : $objTaluka of State Class
*/
$objTaluka  = new Taluka();
$RequestHandlerAction = "";
$talukano = "";

/*
 * @Var : $RequestHandlerAction is Request handler variable
 * @example : action=add.
*/
$RequestHandlerAction = $_REQUEST['action'];


/*StateSno  request only set in edit mode (in other mode it will give error undefined index)
 thats why this condition is set
 */
if($RequestHandlerAction == "edit")
{
    $talukano = $_REQUEST['talukasno'];
}

//switch(!empty(strtolower($RequestHandlerAction)))
switch(trim($RequestHandlerAction))
{
    /*@uses : To show default view mode pade*/
    case "view":
    {
        $objTaluka->GetTaluka($RequestHandlerAction);
        break;
    }
    /*@uses : To show add mode in screen layout*/
    case "add":
    {
        $objTaluka->AddTaluka($RequestHandlerAction);
        break;
    }
    /*@uses : To show edit mode in screen layout*/
    case "edit":
    {
        $objTaluka->EditTaluka($RequestHandlerAction,$talukano);
        break;
    }
    /*@uses : To Submit the form in db*/
    case "submit":
    {
        $objTaluka->SubmitTaluka($_REQUEST);
        break;
    }
    /*@uses : Get datatable data in json format when page load*/
    case "getdatatable":
    {
        $objTaluka->GetDatatable($_REQUEST);
        break;
    }
    /*@uses : Delete datatable column data*/
    case "deletetalukarecord":
    {
        $objTaluka->DeleteTalukaRecord($_REQUEST);
        break;
    }
    case "loadStateDrodpdown":
    {
        $objTaluka->LoadStateDrodpdown($_REQUEST);
        break;
    }

}

class Taluka
{
    /* @Obj : Object variable for further use */
    public $mdl_Taluka;
    public $ObjConn;
    public $ObjBase;
    public $ObjPdo;
    public $ObjSession;

    function __construct()
    {
        $this->mdl_Taluka = new mdl_Taluka();
        $this->ObjConn = $this->mdl_Taluka->ObjConn;
        $this->ObjBase = $this->mdl_Taluka->ObjBase;
        $this->ObjPdo = $this->mdl_Taluka->ObjPdo;
        $this->ObjSession = $this->mdl_Taluka->ObjSession;
    }

    /* @uses : To show default view mode pade
     * @param : $RequestHandlerAction Request of default mode (action=view)
     */
    function GetTaluka($RequestHandlerAction)
    {
        include "taluka.php";
    }

    /* @uses : To show add mode in screen layout
     * @param : $RequestHandlerAction Request of add mode (action=add)
     */
    function AddTaluka($RequestHandlerAction)
    {
        $this->ObjSession->HiddenTalukaSno = 0;
        $GetCityData = "";
        $GetCountryName = $this->mdl_Taluka->GetCountryName();
        $this->ObjBase->UpdateUserActivityTime();
        include "aetaluka.php";
    }

    /* @uses : To show edit mode in screen layout
     * @param : $RequestHandlerAction Request of edit mode (action=edit)
     * @param : $CitySno primary key of selected record
     */
    function EditTaluka($RequestHandlerAction, $TalukaSno)
    {
        $this->ObjSession->HiddenTalukaSno = intval($TalukaSno);

        $TalukaData = "";
        $this->ObjBase->UpdateUserActivityTime();
        //Call model function to get Edit mode data
        $GetCountryName = $this->mdl_Taluka->GetCountryName();

        $TalukaData = $this->mdl_Taluka->EditTaluka(intval($TalukaSno));

        include "aetaluka.php";
    }

    /* @uses : To Submit the form in db
     * @param : $Requests Request of edit mode (action=submit) and other form controls
     */
    function SubmitTaluka($Requests)
    {
        $Talukasno = intval($Requests['hiddenTalukaSno']);
        if($this->ObjSession->HiddenTalukaSno === $Talukasno)
        {
            $this->ObjBase->UpdateUserActivityTime();
            $this->mdl_Taluka->SubmitTaluka($Requests);
        }
        else
        {
            echo "SRR403";
            die();
        }
    }

    /* @uses : Get datatable data in json format when page load
     * @param : $Requests Request of data table(action=getdatatable)
     * @return : Return all taluka table data
     */
    function GetDatatable($Requests)
    {
        $this->mdl_Taluka->GetTaluka();
    }

    /* @uses : Delete datatable column data
     * @param : $Requests (action=delete) and selected row primary key
     */
    function DeleteTalukaRecord($Requests)
    {
        $this->ObjBase->UpdateUserActivityTime();
        $TalukaSno = $_POST['talukasno'];
        $this->mdl_Taluka->DeleteTalukaRecord(intval($TalukaSno));
    }

    function LoadStateDrodpdown()
    {
        $CountrySno = $_GET['countrysno'];
        return $this->mdl_Taluka->LoadStateDrodpdown(intval($CountrySno));
    }
}
