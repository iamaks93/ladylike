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


class mdl_Taluka
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
    function SubmitTaluka($Request)
    {
      // Sanitize user input(never trust on user input)
      $TalukaName = $this->ObjBase->sanitize_input($Request['txtTalukaName']);
      $TalukaCode = $this->ObjBase->sanitize_input($Request['txtTalukaCode']);
      $ddlbCountry = intval($Request['ddlbCountry']);
      $ddlbState = intval($Request['ddlbState']);
      $TalukaSno = $this->ObjBase->sanitize_input(intval($Request['hiddenTalukaSno']));
      $Desc = $this->ObjBase->sanitize_input($Request['txaDescription']);


        //Check if taluka code is not blank
        if(!empty($TalukaCode))
        {
            // Check duplication of taluka code,don't allow for duplication
            $getcount = $this->ObjBase->getcount("taluka","TalukaSno","TalukaCode='".$TalukaCode."' AND TalukaSno !=".intval($TalukaSno)." AND Active=1",$this->ObjPdo);

            // If count is greater(Count will greater than 0,only when it already stored in db),show error message
            if($getcount > 0)
            {
                echo "Taluka code already exists.";
                die();
            }
         }
        else // If taluka code is blank, throw validation error message
        {
            echo "Please enter taluka code.";
            die();
        }

        //Check if taluka name already exist or not in selected state
        if(!empty($ddlbState))
        {
              // Check duplication of taluka name,don't allow for duplication
              $getcount1 = $this->ObjBase->getcount("taluka","TalukaSno","TalukaName='$TalukaName' AND StateSno=$ddlbState AND TalukaSno !=".intval($TalukaSno)." AND Active=1",$this->ObjPdo);

            // If count is greater(Count will greater than 0,only when it already stored in db),show error message
              if($getcount1 > 0)
              {
                  echo "Taluka name already exists for selected state.";
                  die();
              }
        }
        else  // If coutry code is blank, throw validation error message
        {
              echo "Please enter taluka name.";
              die();
        }

               // Add mode
                if($TalukaSno == 0)
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
                        *  @table : taluka
                        *  @primarykey : TalukaSno
                        */
                        $Insert = " Insert into taluka(InDateTime,UpdateOn,UpdatedBy,InUID,MachineIP,MachineName,Active,TalukaCode,TalukaName,StateSno,CountrySno,Description) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
                        $stmt  = $this->ObjPdo->prepare($Insert);

                        //Begin transaction
                        $this->ObjPdo->beginTransaction();
                        $submit =  $stmt->execute(array($CurrentDateTime,$CurrentDateTime,$UpdateBy,$UpdateBy,$Machine_Ip,$MachineName,1,$TalukaCode,$TalukaName,$ddlbState,$ddlbCountry,$Desc));
                        // If  submit successfully give success message
                        if($submit)
                        {
                            //Commit trnasaction
                            $this->ObjPdo->commit();
                            $this->ObjSession->__unset("HiddenTalukaSno");
                            echo "Taluka Data Submitted.";
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
                else if($TalukaSno > 0) // Edit Mode
                {

                    try
                    {
                        $UpDateOnDateTime = "";
                        $UpDateOnDateTime = date('Y-m-d H:i:s');

                        /*  @use : Update data in db
                         *  @table : taluka
                         *  @primarykey : TalukaSno
                         */

                        $sql = " UPDATE taluka SET UpdateOn = :updateon,TalukaCode = :TalukaCode,TalukaName = :TalukaName,StateSno = :StateSno,CountrySno = :CountrySno,TalukaSno= :TalukaSno,Description = :description WHERE Active=1 AND TalukaSno = :TalukaSno";


                        // Bind Variable for prepare talukament to avoid sql injection
                        $stmt = $this->ObjPdo->prepare($sql);
                        $stmt->bindParam(':updateon',$UpDateOnDateTime);
                        $stmt->bindParam(':TalukaCode',$TalukaCode);
                        $stmt->bindParam(':TalukaName',$TalukaName);
                        $stmt->bindParam(':StateSno',$ddlbState);
                        $stmt->bindParam(':CountrySno',$ddlbCountry);

                        $stmt->bindParam(':TalukaSno',$ddlbTaluka); // Change value here
                        $stmt->bindParam(':description',$Desc);
                        $stmt->bindParam(':TalukaSno',$TalukaSno);

                        //Begin transaction
                        $this->ObjPdo->beginTransaction();
                        // If  update successfully give success message
                        if ($stmt->execute())
                        {
                            //Commit trnasaction
                            $this->ObjPdo->commit();
                            $this->ObjSession->__unset("HiddenTalukaSno");
                            echo "Taluka Data Updated.";
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
     *@return : Return all taluka table data
     */
    function GetTaluka()
    {

        // Datatable header field
        $aColumns = array('TalukaSno','TalukaCode','TalukaName','StateSno','CountrySno','Action');
        $output = array(
            "sEcho" => 1,
            "iTotalRecords" => 1,
            "iTotalDisplayRecords" => 5,
            "aaData" => array()
        );

        //Get number of rows Taluka table have
        $sql = " Select TalukaSno,TalukaCode,TalukaName,(SELECT StateName FROM state WHERE state.Active=1 AND taluka.StateSno = state.StateSno)AS StateSno,(SELECT CountryName FROM country WHERE country.Active=1 AND taluka.CountrySno = country.CountrySno)AS CountrySno,'Action' FROM taluka WHERE Active=1";
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

                    $PKeyRequestName = "'talukasno'";
                    $DoctorSno = $aRowvalue['TalukaSno'];
                    $RequestPageName = "'ctl_taluka.php'";
                    $HideDiv = "'divtalukadatatablecontainer'";
                    $ShowDiv = "'divTargetTaluka'";
                    $ButtonDisable = "'btnAddTaluka'";
                    $DeleteFunctionName = "'deletetalukarecord'";


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
     * @param : $Talukasno primary key of selected record
     */
    function EditTaluka($Talukasno)
    {
        $editrecord = " Select TalukaSno,Active,TalukaName,TalukaCode,CountrySno,StateSno,Description FROM taluka WHERE Active=1 AND TalukaSno = ?";
        $stmt = $this->ObjPdo->prepare($editrecord);
        $stmt->execute([$Talukasno]);
        $Result = $stmt->fetch(PDO::FETCH_OBJ);
        return $Result;
    }

    /* @uses : Delete datatable column data from taluka
     * @param : $TalukaSno, selected row primary key
     */
    function DeleteTalukaRecord($TalukaSno)
    {
        //Check selected record used in another table or not
        $GetCountState = $this->ObjBase->getcount("city","CitySno","TalukaSno=".intval($TalukaSno)." AND Active=1",$this->ObjPdo);
        if($GetCountState > 0)
        {
            echo "Record already in use.";
            die();

        }
        else
        {
            try
            {
                $deleterecord = " Update taluka SET Active=0 WHERE TalukaSno = ?";
                $stmt = $this->ObjPdo->prepare($deleterecord);
                $stmt->execute([$TalukaSno]);
                $affectedrow = $stmt->rowCount();
                if($affectedrow > 0)
                {
                    echo "Deleted";
                    die();
                }
           }
            catch(PDOException $e)
            {
                echo  $e->getMessage();
            }
        }
    }
    function GetCountryName()
    {
        $sql = "SELECT CountrySno,CountryName FROM country WHERE Active=1 ORDER BY CountryName ASC";
        return $this->ObjPdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    function LoadStateDrodpdown($CountrySno)
    {
        $talukadata = "";
        $sql = "SELECT StateSno,StateName FROM state WHERE Active=1 AND CountrySno= ? ORDER BY StateName ASC ";
        $talukadata = $this->ObjPdo->prepare($sql);
        $talukadata->execute([$CountrySno]);
        $Result = $talukadata->fetchAll(PDO::FETCH_ASSOC);

        $talukaarray = array();
        foreach ($Result As $key)
        {
            $talukaarray[] = array('id'=> $key['StateSno'],'text'=>$key['StateName']);

        }
        header('Content-type:application/json');
        echo json_encode($talukaarray);
    }
}