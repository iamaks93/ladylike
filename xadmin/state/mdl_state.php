<?php
/**
 * Created by PhpStorm.
 * User: Maa
 * Date: 2/12/2017
 * Time: 12:02 PM
 */

/**
 * @filesource include required file
 *         1) PHP Common Function file
 *         2) Connection file
 *         3) Session file
 */
require_once "../../core/base.php";
require_once "../../core/connection.php";
require_once "../../core/session.php";


class mdl_State
{
    var $ObjConn; // Connection object
    var $ObjBase;  // Base Object
    var $ObjSession; // Session Object
    function __construct()
    {
        //Initialize all objcets
        $this->ObjConn = new Connection();
        $this->ObjBase = new Base();
        $this->ObjPdo = $this->ObjConn->GetConnect();
        $this->ObjSession = Session::getInstance(); // Initialize singleton session class
    }

    /* @uses : To Submit the form in db
     * @param : $Requests Request of edit mode (action=submit) and other form controls
     */
    function SubmitState($Request)
    {
      // Sanitize user input(never trust on user input)
      $StateName = $this->ObjBase->sanitize_input($Request['txtStateName']);
      $StateCode = $this->ObjBase->sanitize_input($Request['txtStateCode']);
      $ddlbCountry = $this->ObjBase->sanitize_input(intval($Request['ddlbCountry']));
      $StateSno = $this->ObjBase->sanitize_input(intval($Request['hiddenStateSno']));
      $Desc = $this->ObjBase->sanitize_input($Request['txaDescription']);


        //Check if state code is not blank
        if(!empty($StateCode))
        {
            // Check duplication of state code,don't allow for duplication
            $getcount = $this->ObjBase->getcount("state","StateSno","StateCode='".$StateCode."' AND StateSno !=".intval($StateSno)." AND Active=1",$this->ObjPdo);

            // If count is greater(Count will greater than 0,only when it already stored in db),show error message
            if($getcount > 0)
            {
                echo "State code already exists.";
                die();
            }
         }
        else // If state code is blank, throw validation error message
        {
            echo "Please enter state code.";
            die();
        }

        //Check if State name is not blank
        if(!empty($StateName))
        {
              // Check duplication of state name,don't allow for duplication
              $getcount1 = $this->ObjBase->getcount("state","StateSno","StateName='$StateName' AND StateSno !=".intval($StateSno)." AND Active=1",$this->ObjPdo);

            // If count is greater(Count will greater than 0,only when it already stored in db),show error message
              if($getcount1 > 0)
              {
                  echo "State name already exists.";
                  die();
              }
        }
        else  // If coutry code is blank, throw validation error message
        {
              echo "Please enter state name.";
              die();
        }
                // Add mode
                if($StateSno == 0)
                {

                    try
                    {
                        $CurrentDateTime = "";
                        $UpdateBy = "";
                        $InUID = "";
                        $Machine_Ip = "";
                        $MachineName = "";
                        $CurrentDateTime = date('Y-m-d H:i:s');
                        $Machine_Ip = $this->ObjSession->Machine_Ip;
                        $UpdateBy = $this->ObjSession->UserSno;
                        $MachineName = $this->ObjSession->UserSystemName;

                        /*  @use : Insert data in db
                         *  @table : state
                         *  @primarykey : StateSno
                         */
                        $Insert = " INSERT INTO state(InDateTime,UpdateOn,UpdatedBy,InUID,MachineIP,MachineName,Active,StateCode,StateName,CountrySno,Description) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
                        $stmt = $this->ObjPdo->prepare($Insert);

                        //Begin transaction
                        $this->ObjPdo->beginTransaction();
                        $submit = $stmt->execute(array($CurrentDateTime, $CurrentDateTime, $UpdateBy, $UpdateBy, $Machine_Ip, $MachineName, 1, $StateCode, $StateName, $ddlbCountry, $Desc));

                        // If  submit successfully give success message
                        if ($submit)
                        {
                            //Commit trnasaction
                            $this->ObjPdo->commit();
                            $this->ObjSession->__unset("HiddenStateSno");
                            echo "State Data Submitted.";
                            die();
                        }
                    }
                    catch(PDOException $e)
                    {
                        //Rollback if any error occured
                        $this->ObjPdo->rollBack();
                        echo "Error  ". $e->getMessage();
                    }
                }
                else if($StateSno > 0) // Edit Mode
                {

                     try
                     {
                        $UpDateOnDateTime = "";
                        $UpDateOnDateTime = date('Y-m-d H:i:s');

                        /*  @use : Update data in db
                         *  @table : state
                         *  @primarykey : StateSno
                         */
                        $sql = " UPDATE state SET UpdateOn = :updateon,StateCode = :StateCode,StateName = :StateName,CountrySno = :CountrySno,Description = :description WHERE Active=1 AND StateSno = :StateSno";

                        // Bind Variable for prepare statement to avoid sql injection
                        $stmt = $this->ObjPdo->prepare($sql);
                        $stmt->bindParam(':updateon',$UpDateOnDateTime);
                        $stmt->bindParam(':StateCode',$StateCode);
                        $stmt->bindParam(':StateName',$StateName);
                        $stmt->bindParam(':CountrySno',$ddlbCountry);
                        $stmt->bindParam(':description',$Desc);
                        $stmt->bindParam(':StateSno',$StateSno);

                         //Begin Transaction
                         $this->ObjPdo->beginTransaction();
                        // If  update successfully give success message
                        if ($stmt->execute())
                        {
                            // Commit transaction
                            $this->ObjPdo->commit();
                            $this->ObjSession->__unset("HiddenStateSno");
                            echo "State Data Updated.";
                            die();
                        }
                     }
                     catch(PDOException $e)
                     {
                         //Rollback if any error occured
                         $this->ObjPdo->rollBack();
                         echo "Error  ". $e->getMessage();
                     }
                }

    }
    /* @uses : Get datatable data in json format when page load
     *@return : Return all state table data
     */
    function GetState()
    {

        // Datatable header field
        $aColumns = array('StateSno','StateCode','StateName','CountrySno','Description','Action');
        $output = array(
            "sEcho" => 1,
            "iTotalRecords" => 1,
            "iTotalDisplayRecords" => 5,
            "aaData" => array()
        );

        //Get number of rows Country table have
        $sql = " Select StateSno,StateCode,StateName,(SELECT CountryName from country WHERE state.Active=1 AND state.CountrySno = country.CountrySno)AS CountrySno,Description,'Action' FROM state WHERE Active=1";
        $stmt = $this->ObjPdo->prepare($sql);
        $stmt->execute();
        $aRow = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //Create json array
        foreach($aRow As $aRowkey=>$aRowvalue)
        {
            $row = array();
            foreach($aRowvalue As $key=>$val)
            {
                if($val == "Action")
                {

                    $PKeyRequestName = "'statesno'";
                    $DoctorSno = $aRowvalue['StateSno'];
                    $RequestPageName = "'ctl_state.php'";
                    $HideDiv = "'divstatedatatablecontainer'";
                    $ShowDiv = "'divTargetState'";
                    $ButtonDisable = "'btnAddState'";
                    $DeleteFunctionName = "'deletestaterecord'";

                    $row[] = "<i class=\"fa fa-pencil m-r-5\" onclick=\"EditCommonRecords($PKeyRequestName,$DoctorSno,$RequestPageName,$HideDiv,$ShowDiv,$ButtonDisable);\" data-toggle=\"tooltip\" title=\"Edit Record!\"></i> 
                            
                                    <i class=\"fa fa-trash-o\" onclick=\"DeleteCommonRecords($RequestPageName,$DeleteFunctionName,$PKeyRequestName,$DoctorSno);\" data-toggle=\"tooltip\" title=\"Delete Record!\"></i> 
                              ";
                }
                else
                {
                    $row[] = $val;
                }

            }
            $output['aaData'][] = $row;
        }
        // Return json array
        echo json_encode($output);
    }

    /* @uses : To show edit mode in screen layout
     * @param : $Statesno primary key of selected record
     */
    function EditState($Statesno)
    {
        $editrecord = " Select StateSno,Active,StateCode,StateName,CountrySno,Description FROM state WHERE Active=1 AND StateSno = ?";
        $stmt = $this->ObjPdo->prepare($editrecord);
        $stmt->execute([$Statesno]);
        $Result = $stmt->fetch(PDO::FETCH_OBJ);
        return $Result;
    }

    /* @uses : Delete datatable column data from state
     * @param : $StateSno, selected row primary key
     */
    function DeleteStateRecord($StateSno)
    {
        //Check selected record used in another table or not
        $GetCountState = $this->ObjBase->getcount("city","CitySno","StateSno=".intval($StateSno)." AND Active=1",$this->ObjPdo);
        if($GetCountState > 0)
        {
            echo "Record already in use.";
            die();

        }
        else
        {
            try
            {
                $deleterecord = " Update state SET Active=0 WHERE StateSno = ?";
                $stmt = $this->ObjPdo->prepare($deleterecord);
                $stmt->execute([$StateSno]);
                $affectedrow = $stmt->rowCount();
                if($affectedrow > 0)
                {
                    echo "Deleted";
                    die();
                }
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }
    }
    function GetCountryName()
    {
        $sql = "SELECT CountrySno,CountryName FROM country WHERE Active=1";
        return $this->ObjPdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}