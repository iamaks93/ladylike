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


class mdl_City
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
    function SubmitCity()
    {
        // Sanitize user input(never trust on user input)
      $CityName = isset($_POST['txtCityName']) ? $this->ObjBase->sanitize_input($_POST['txtCityName']) : "";
      $CityCode = isset($_POST['txtCityCode']) ? $this->ObjBase->sanitize_input($_POST['txtCityCode']) : "";
      $ddlbCountry = isset($_POST['ddlbCountry']) ? intval($_POST['ddlbCountry']) : 0;
      $ddlbState = isset($_POST['ddlbState']) ? intval($_POST['ddlbState']) : 0;
      $ddlbTaluka =  isset($_POST['ddlbTaluka']) ? intval($_POST['ddlbTaluka']) : 0;

      $CitySno = isset($_POST['hiddenCitySno']) ? $this->ObjBase->sanitize_input(intval($_POST['hiddenCitySno'])) : 0;

      $Desc = isset($_POST['txaDescription']) ? $this->ObjBase->sanitize_input($_POST['txaDescription']) : "";

        //Check if state code is not blank
        if(!empty($CityCode))
        {
            // Check duplication of state code,don't allow for duplication
            $getcount = $this->ObjBase->getcount("city","CitySno","CityCode='".$CityCode."' AND CitySno !=".intval($CitySno)." AND Active=1",$this->ObjPdo);

            // If count is greater(Count will greater than 0,only when it already stored in db),show error message
            if($getcount > 0)
            {
                echo "City code already exists.";
                die();
            }
         }
        else // If city code is blank, throw validation error message
        {
            echo "Please enter city code.";
            die();
        }

        //Check if city name already exist or not in selected state
        if(!empty($ddlbState))
        {
              // Check duplication of state name,don't allow for duplication
              $getcount1 = $this->ObjBase->getcount("city","CitySno","CityName='$CityName' AND StateSno=$ddlbState AND CitySno !=".intval($CitySno)." AND Active=1",$this->ObjPdo);

            // If count is greater(Count will greater than 0,only when it already stored in db),show error message
              if($getcount1 > 0)
              {
                  echo "City name already exists for selected state.";
                  die();
              }
        }
        else  // If coutry code is blank, throw validation error message
        {
              echo "Please enter city name.";
              die();
        }

               // Add mode
                if($CitySno == 0)
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
                        *  @table : city
                        *  @primarykey : CitySno
                        */
                        $Insert = " Insert into city(InDateTime,UpdateOn,UpdatedBy,InUID,MachineIP,MachineName,Active,CityCode,CityName,TalukaSno,StateSno,CountrySno,Description) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
                        $stmt  = $this->ObjPdo->prepare($Insert);

                        //Begin transaction
                        $this->ObjPdo->beginTransaction();
                        $submit =  $stmt->execute(array($CurrentDateTime,$CurrentDateTime,$UpdateBy,$UpdateBy,$Machine_Ip,$MachineName,1,$CityCode,$CityName,$ddlbTaluka,$ddlbState,$ddlbCountry,$Desc)); // Add ddlb taluka here

                        // If  submit successfully give success message
                        if($submit)
                        {
                            //Commit trnasaction
                            $this->ObjPdo->commit();
                            $this->ObjSession->__unset("HiddenCitySno");
                            echo "City Data Submitted.";
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
                else if($CitySno > 0) // Edit Mode
                {

                    try
                    {
                        $UpDateOnDateTime = "";
                        $UpDateOnDateTime = date('Y-m-d H:i:s');

                        /*  @use : Update data in db
                         *  @table : state
                         *  @primarykey : CitySno
                         */

                        $sql = " UPDATE city SET UpdateOn = :updateon,CityCode = :CityCode,CityName = :CityName,StateSno = :StateSno,CountrySno = :CountrySno,TalukaSno= :TalukaSno,Description = :description WHERE Active=1 AND CitySno = :CitySno";


                        // Bind Variable for prepare statement to avoid sql injection
                        $stmt = $this->ObjPdo->prepare($sql);
                        $stmt->bindParam(':updateon',$UpDateOnDateTime);
                        $stmt->bindParam(':CityCode',$CityCode);
                        $stmt->bindParam(':CityName',$CityName);
                        $stmt->bindParam(':StateSno',$ddlbState);
                        $stmt->bindParam(':CountrySno',$ddlbCountry);

                        $stmt->bindParam(':TalukaSno',$ddlbTaluka); // Change value here
                        $stmt->bindParam(':description',$Desc);
                        $stmt->bindParam(':CitySno',$CitySno);

                        //Begin Transaction
                        $this->ObjPdo->beginTransaction();

                        // If  update successfully give success message
                        if ($stmt->execute())
                        {
                            // Commit transaction
                            $this->ObjPdo->commit();
                            $this->ObjSession->__unset("HiddenCitySno");
                            echo "City Data Updated.";
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
        $aColumns = array('CitySno','CityCode','CityName','StateSno','CountrySno','Action');
        $output = array(
            "sEcho" => 1,
            "iTotalRecords" => 1,
            "iTotalDisplayRecords" => 4,
            "aaData" => array()
        );

        //Get number of rows City table have
        $sql = " Select CitySno,CityCode,CityName,(SELECT StateName FROM state WHERE state.Active=1 AND city.StateSno = state.StateSno)AS StateSno,(SELECT CountryName FROM country WHERE country.Active=1 AND city.CountrySno = country.CountrySno)AS CountrySno,'Action' FROM city WHERE Active=1";
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
                    $PKeyRequestName = "'citysno'";
                    $DoctorSno = $aRowvalue['CitySno'];
                    $RequestPageName = "'ctl_city.php'";
                    $HideDiv = "'divcitydatatablecontainer'";
                    $ShowDiv = "'divTargetCity'";
                    $ButtonDisable = "'btnAddCity'";
                    $DeleteFunctionName = "'deletecityrecord'";

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
     * @param : $Citysno primary key of selected record
     */
    function EditCity($Citysno)
    {
        $editrecord = " Select CitySno,Active,CityName,CityCode,CountrySno,StateSno,TalukaSno,Description FROM city WHERE Active=1 AND CitySno = ?";
        $stmt = $this->ObjPdo->prepare($editrecord);
        $stmt->execute([$Citysno]);
        $Result = $stmt->fetch(PDO::FETCH_OBJ);
        return $Result;
    }

    /* @uses : Delete datatable column data from state
     * @param : $StateSno, selected row primary key
     */
    function DeleteCityRecord($CitySno)
    {
        //Check selected record used in another table or not
       /* $GetCountState = $this->ObjBase->getcount("city","CitySno","StateSno=".intval($StateSno)." AND Active=1",$this->ObjPdo);
        if($GetCountState > 0)
        {
            echo "Record already in use.";
            die();

        }
        else
        {
            try
            {*/
                $deleterecord = " Update city SET Active=0 WHERE CitySno = ?";
                $stmt = $this->ObjPdo->prepare($deleterecord);
                $stmt->execute([$CitySno]);
                $affectedrow = $stmt->rowCount();
                if($affectedrow > 0)
                {
                    echo "Deleted";
                    die();
                }
           /* }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }*/
        //}
    }
    function GetCountryName()
    {
        $sql = "SELECT CountrySno,CountryName FROM country WHERE Active=1 ORDER BY CountryName ASC";
        return $this->ObjPdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    function LoadStateDrodpdown($CountrySno)
    {
        $statedata = "";
        $sql = "SELECT StateSno,StateName FROM state WHERE Active=1 AND CountrySno= ? ORDER BY StateName ASC ";
        $statedata = $this->ObjPdo->prepare($sql);
        $statedata->execute([$CountrySno]);
        $Result = $statedata->fetchAll(PDO::FETCH_ASSOC);

        $statearray = array();
        foreach ($Result As $key)
        {
            $statearray[] = array('id'=> $key['StateSno'],'text'=>$key['StateName']);

        }
        header('Content-type:application/json');
        echo json_encode($statearray);
    }
    function LoadTalukaDrodpdown($StateSno)
    {
        $statedata = "";
        $sql = "SELECT TalukaSno,TalukaName FROM taluka WHERE Active=1 AND TalukaSno= ? ORDER BY TalukaName ASC ";
        $statedata = $this->ObjPdo->prepare($sql);
        $statedata->execute([$StateSno]);
        $Result = $statedata->fetchAll(PDO::FETCH_ASSOC);

        $statearray = array();
        foreach ($Result As $key)
        {
            $statearray[] = array('id'=> $key['TalukaSno'],'text'=>$key['TalukaName']);

        }
        header('Content-type:application/json');
        echo json_encode($statearray);
    }
}