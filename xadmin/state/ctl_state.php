<?php
/**
 * Created by PhpStorm.
 * User: Maa
 * Date: 2/10/2017
 * Time: 10:32 PM
 */

require_once "mdl_state.php";

/*
 * @Obj : $objState of State Class
*/
$objState  = new State();
$RequestHandlerAction = "";
$statesno = "";

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
    $statesno = $_REQUEST['statesno'];
}

//switch(!empty(strtolower($RequestHandlerAction)))
switch(trim($RequestHandlerAction))
{
    /*@uses : To show default view mode pade*/
    case "view":
    {
        $objState->GetState($RequestHandlerAction);
        break;
    }
    /*@uses : To show add mode in screen layout*/
    case "add":
    {
        $objState->AddState($RequestHandlerAction);
        break;
    }
    /*@uses : To show edit mode in screen layout*/
    case "edit":
    {
        $objState->EditState($RequestHandlerAction,$statesno);
        break;
    }
    /*@uses : To Submit the form in db*/
    case "submit":
    {
        $objState->SubmitState($_REQUEST);
        break;
    }
    /*@uses : Get datatable data in json format when page load*/
    case "getdatatable":
    {
        $objState->GetDatatable($_REQUEST);
        break;
    }
    /*@uses : Delete datatable column data*/
    case "deletestaterecord":
    {
        $objState->DeleteStateRecord($_REQUEST);
        break;
    }

}

class State
{
    /* @Obj : Object variable for further use*/
    public $mdl_State;
    public $ObjConn;
    public $ObjBase;
    public $ObjPdo;
    public $ObjSession;

    function __construct()
    {
        $this->mdl_State = new mdl_State();
        $this->ObjConn = $this->mdl_State->ObjConn;
        $this->ObjBase = $this->mdl_State->ObjBase;
        $this->ObjPdo= $this->mdl_State->ObjPdo;
        $this->ObjSession = $this->mdl_State->ObjSession;
    }

    /* @uses : To show default view mode pade
    * @param : $RequestHandlerAction Request of default mode (action=view)
    */
    function GetState($RequestHandlerAction)
    {
        include "state.php";
    }
    /* @uses : To show add mode in screen layout
    *  @param : $RequestHandlerAction Request of add mode (action=add)
    */
    function AddState($RequestHandlerAction)
    {
        $GetStateData = "";

        $this->ObjSession->HiddenStateSno = 0;
        $GetCountryName = $this->mdl_State->GetCountryName();
        $this->ObjBase->UpdateUserActivityTime();
        include "aestate.php";
    }
    /* @uses : To show edit mode in screen layout
    * @param : $RequestHandlerAction Request of edit mode (action=edit)
    * @param : $CitySno primary key of selected record
    */
    function EditState($RequestHandlerAction,$Statesno)
    {
        $StateData = "";

        $this->ObjSession->HiddenStateSno = intval($Statesno);
        $this->ObjBase->UpdateUserActivityTime();
        //Call model function to get Edit mode data
        $GetCountryName = $this->mdl_State->GetCountryName();

        $StateData = $this->mdl_State->EditState(intval($Statesno));
        include "aestate.php";
    }
    /* @uses : To Submit the form in db
     * @param : $Requests Request of edit mode (action=submit) and other form controls
     */
    function SubmitState($Requests)
    {
        $Statesno = intval($Requests['hiddenStateSno']);
        if($this->ObjSession->HiddenStateSno === $Statesno)
        {
            $this->ObjBase->UpdateUserActivityTime();
            $this->mdl_State->SubmitState($Requests);
        }
        else
        {
            echo "SRR403";
            die();
        }
    }
    /* @uses : Get datatable data in json format when page load
     * @param : $Requests Request of data table(action=getdatatable)
     * @return : Return all state table data
     */
    function GetDatatable($Requests)
    {
         $this->mdl_State->GetState();
    }
    /* @uses : Delete datatable column data
     * @param : $Requests (action=delete) and selected row primary key
     */
    function DeleteStateRecord($Requests)
    {
        $this->ObjBase->UpdateUserActivityTime();
        $StateSno = $_POST['statesno'];
        $this->mdl_State->DeleteStateRecord(intval($StateSno));
    }
}
