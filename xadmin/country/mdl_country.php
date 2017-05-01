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


class mdl_Country
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
    function SubmitCountry($Request)
    {
        //if ( strlen( $_POST[ ‘comment’ ] ) <= 256 )

        //$comment = htmlentities ( trim ( $_POST[ ‘comment’ ] ) , ENT_NOQUOTES );

        // Sanitize user input(never trust on user input)
        $countryname = $this->ObjBase->sanitize_input($Request['txtCountryName']);
        $countrycode = $this->ObjBase->sanitize_input($Request['txtCountryCode']);
        $countrysno = $this->ObjBase->sanitize_input(intval($Request['hiddenCountrySno']));
        $desc = $this->ObjBase->sanitize_input($Request['txaDescription']);

        //Check if country code is not blank
        if(!empty($countrycode))
        {
            // Check duplication of country code,don't allow for duplication
            $getcount = $this->ObjBase->getcount("country","CountrySno","CountyCode='".$countrycode."' AND CountrySno !=".intval($countrysno)." AND Active=1",$this->ObjPdo);

            // If count is greater(Count will greater than 0,only when it already stored in db),show error message
            if($getcount > 0)
            {
                echo "Country code already exists.";
                die();
            }
        }
        else // If coutry code is blank, throw validation error message
        {
            echo "Please enter country code.";
            die();
        }

        //Check if country name is not blank
        if(!empty($countryname))
        {
            // Check duplication of country name,don't allow for duplication
            $getcount1 = $this->ObjBase->getcount("country","CountrySno","CountryName='$countryname' AND CountrySno !=".intval($countrysno)." AND Active=1",$this->ObjPdo);

            // If count is greater(Count will greater than 0,only when it already stored in db),show error message
            if($getcount1 > 0)
            {
                echo "Country name already exists.";
                die();
            }
        }
        else  // If coutry code is blank, throw validation error message
        {
            echo "Please enter country name.";
            die();
        }
        // Add mode
        if($countrysno == 0)
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
                 *  @table : country
                 *  @primarykey : CountrySno
                 */
                $Insert = " Insert into country(InDateTime,UpdateOn,UpdatedBy,InUID,MachineIP,MachineName,Active,CountyCode,CountryName,Description) VALUES (?,?,?,?,?,?,?,?,?,?)";
                $stmt  = $this->ObjPdo->prepare($Insert);

                // Begin Transaction
                $this->ObjPdo->beginTransaction();
                $submit =  $stmt->execute(array($CurrentDateTime,$CurrentDateTime,$UpdateBy,$UpdateBy,$Machine_Ip,$MachineName,1,$countrycode,$countryname,$desc));

                // If  submit successfully give success message
                if($submit)
                {
                    //Commit trnasaction
                    $this->ObjPdo->commit();
                    $this->ObjSession->__unset("HiddenCountrySno");
                    echo "Country Data Submitted.";
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
        else if($countrysno > 0) // Edit Mode
        {
            try
            {

                $UpDateOnDateTime = "";
                $UpDateOnDateTime = date('Y-m-d H:i:s');

                /*  @use : Update data in db
                 * @table : country
                 * @primarykey : CountrySno
                 */
                $sql = " UPDATE country SET UpdateOn = :updateon,CountyCode = :countrycode,CountryName = :countryname,Description = :description WHERE Active=1 AND CountrySno = :countrysno";

                // Bind Variable for prepare statement to avoid sql injection
                $stmt = $this->ObjPdo->prepare($sql);
                $stmt->bindParam(':updateon', $UpDateOnDateTime);
                $stmt->bindParam(':countrycode', $countrycode);
                $stmt->bindParam(':countryname', $countryname);
                $stmt->bindParam(':description', $desc);
                $stmt->bindParam(':countrysno', $countrysno);

                //Begin Transaction
                $this->ObjPdo->beginTransaction();
                // If  update successfully give success message
                if ($stmt->execute())
                {
                    // Commit transaction
                    $this->ObjPdo->commit();
                    $this->ObjSession->__unset("HiddenCountrySno");
                    echo "Country Data Updated.";
                    die();
                }

            }
            catch(PDOException $e)
            {
                $this->ObjPdo->rollBack();
                echo "Error  ". $e->getMessage();
            }
        }

    }
    /* @uses : Get datatable data in json format when page load
     *@return : Return all country table data
     */
    function GetCountry()
    {

        // Datatable header field
        $aColumns = array('CountrySno','CountyCode','CountryName','Description','Action');
        $output = array(
            "sEcho" => 1,
            "iTotalRecords" => 1,
            "iTotalDisplayRecords" => 4,
            "aaData" => array()
        );

        //Get number of rows Country table have
        $sql = " Select CountrySno,CountyCode,CountryName,Description,'Action' FROM country WHERE Active=1";
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

                    $PKeyRequestName = "'countrysno'";
                    $DoctorSno = $aRowvalue['CountrySno'];
                    $RequestPageName = "'ctl_country.php'";
                    $HideDiv = "'divdatatablecontainer'";
                    $ShowDiv = "'divTargetCountry'";
                    $ButtonDisable = "'btnAddCountry'";
                    $DeleteFunctionName = "'deletecountryrecord'";


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
     * @param : $StateSno primary key of selected record
     */
    function EditCountry($CountrySno)
    {
        $editrecord = " Select CountrySno,Active,CountyCode,CountryName,Description FROM country WHERE Active=1 AND CountrySno = ?";
        $stmt = $this->ObjPdo->prepare($editrecord);
        $stmt->execute([$CountrySno]);
        $Result = $stmt->fetch(PDO::FETCH_OBJ);
        return $Result;
    }

    /* @uses : Delete datatable column data
     * @param : $CountrySno, selected row primary key
     */
    function DeleteCountryRecord($CountrySno)
    {
        //Check selected record used in another table or not
        $GetCountCountry = $this->ObjBase->getcount("state","StateSno","CountrySno=".intval($CountrySno)." AND Active=1",$this->ObjPdo);
        if($GetCountCountry > 0)
        {
            echo "Record already in use.";
            die();

        }
        else
        {
            try
            {
                $deleterecord = " Update country SET Active=0 WHERE CountrySno= ?";
                $stmt = $this->ObjPdo->prepare($deleterecord);
                $stmt->execute([$CountrySno]);
                $affectedrow = $stmt->rowCount();
                if($affectedrow > 0)
                {
                    echo "Deleted";
                    die();
                }
            }
            catch(PDOException $e)
            {
                echo "Error: ".$e->getMessage();
            }
        }
    }
}