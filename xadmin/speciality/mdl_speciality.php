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


class mdl_Speciality
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
    function SubmitSpeciality($Request)
    {
        // Sanitize user input(never trust on user input)
        $specialityname = $this->ObjBase->sanitize_input($Request['txtSpecialityName']);
        $specialitycode = $this->ObjBase->sanitize_input($Request['txtSpecialityCode']);
        $specialitysno = $this->ObjBase->sanitize_input(intval($Request['hiddenSpecialitySno']));
        $desc = $this->ObjBase->sanitize_input($Request['txaDescription']);

        //Check if speciality code is not blank
        if(!empty($specialitycode))
        {
            // Check duplication of speciality code,don't allow for duplication
            $getcount = $this->ObjBase->getcount("speciality","SpecialitySno","SpecialityCode='".$specialitycode."' AND SpecialitySno !=".intval($specialitysno)." AND Active=1",$this->ObjPdo);

            // If count is greater(Count will greater than 0,only when it already stored in db),show error message
            if($getcount > 0)
            {
                echo "Speciality code already exists.";
                die();
            }
        }
        else // If coutry code is blank, throw validation error message
        {
            echo "Please enter speciality code.";
            die();
        }

        //Check if speciality name is not blank
        if(!empty($specialityname))
        {
            // Check duplication of speciality name,don't allow for duplication
            $getcount1 = $this->ObjBase->getcount("speciality","SpecialitySno","SpecialityName='$specialityname' AND SpecialitySno !=".intval($specialitysno)." AND Active=1",$this->ObjPdo);

            // If count is greater(Count will greater than 0,only when it already stored in db),show error message
            if($getcount1 > 0)
            {
                echo "Speciality name already exists.";
                die();
            }
        }
        else  // If coutry code is blank, throw validation error message
        {
            echo "Please enter speciality name.";
            die();
        }
        // Add mode
        if($specialitysno == 0)
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
                 *  @table : speciality
                 *  @primarykey : SpecialitySno
                 */
                $Insert = " Insert into speciality(InDateTime,UpdateOn,UpdatedBy,InUID,MachineIP,MachineName,Active,SpecialityCode,SpecialityName,Description) VALUES (?,?,?,?,?,?,?,?,?,?)";
                $stmt  = $this->ObjPdo->prepare($Insert);

                // Begin Transaction
                $this->ObjPdo->beginTransaction();
                $submit =  $stmt->execute(array($CurrentDateTime,$CurrentDateTime,$UpdateBy,$UpdateBy,$Machine_Ip,$MachineName,1,$specialitycode,$specialityname,$desc));


                // If  submit successfully give success message
                if($submit)
                {
                    //Commit trnasaction
                    $this->ObjPdo->commit();
                    //Unset Primary key from sesion
                    $this->ObjSession->__unset("HiddenSpecialitySno");
                    echo "Speciality Data Submitted.";
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
        else if($specialitysno > 0) // Edit Mode
        {
            try
            {

                $UpDateOnDateTime = "";
                $UpDateOnDateTime = date('Y-m-d H:i:s');

                /*  @use : Update data in db
                 * @table : speciality
                 * @primarykey : SpecialitySno
                 */
                $sql = " UPDATE speciality SET UpdateOn = :updateon,SpecialityCode = :specialitycode,SpecialityName = :specialityname,Description = :description WHERE Active=1 AND SpecialitySno = :specialitysno";

                // Bind Variable for prepare statement to avoid sql injection
                $stmt = $this->ObjPdo->prepare($sql);
                $stmt->bindParam(':updateon', $UpDateOnDateTime);
                $stmt->bindParam(':specialitycode', $specialitycode);
                $stmt->bindParam(':specialityname', $specialityname);
                $stmt->bindParam(':description', $desc);
                $stmt->bindParam(':specialitysno', $specialitysno);

                //Begin Transaction
                $this->ObjPdo->beginTransaction();
                // If  update successfully give success message
                if ($stmt->execute())
                {
                    // Commit transaction
                    $this->ObjPdo->commit();
                    //Unset Primary key from sesion
                    $this->ObjSession->__unset("HiddenSpecialitySno");
                    echo "Speciality Data Updated.";
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
     *@return : Return all speciality table data
     */
    function GetSpeciality()
    {

        // Datatable header field
        $aColumns = array('SpecialitySno','SpecialityCode','SpecialityName','Description','Action');
        $output = array(
            "sEcho" => 1,
            "iTotalRecords" => 1,
            "iTotalDisplayRecords" => 4,
            "aaData" => array()
        );

        //Get number of rows speciality table have
        $sql = " Select SpecialitySno,SpecialityCode,SpecialityName,Description,'Action' FROM speciality WHERE Active=1";
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
                    $PKeyRequestName = "'specialitysno'";
                    $DoctorSno = $aRowvalue['SpecialitySno'];
                    $RequestPageName = "'ctl_speciality.php'";
                    $HideDiv = "'divdatatablecontainer'";
                    $ShowDiv = "'divTargetSpeciality'";
                    $ButtonDisable = "'btnAddSpeciality'";
                    $DeleteFunctionName = "'deletespecialityrecord'";

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
     * @param : $SpecialitySno primary key of selected record
     */
    function EditSpeciality($SpecialitySno)
    {
        $editrecord = " Select SpecialitySno,Active,SpecialityCode,SpecialityName,Description FROM speciality WHERE Active=1 AND SpecialitySno = ?";
        $stmt = $this->ObjPdo->prepare($editrecord);
        $stmt->execute([$SpecialitySno]);
        $Result = $stmt->fetch(PDO::FETCH_OBJ);
        return $Result;
    }

    /* @uses : Delete datatable column data
     * @param : $SpecialitySno, selected row primary key
     */
    function DeleteSpecialityRecord($SpecialitySno)
    {
        //Check selected record used in another table or not
       /* $GetCountCountry = $this->ObjBase->getcount("state","StateSno","CountrySno=".intval($SpecialitySno)." AND Active=1",$this->ObjPdo);
        if($GetCountCountry > 0)
        {
            echo "Record already in use.";
            die();

        }
        else
        {*/
            try
            {
                $deleterecord = " Update speciality SET Active=0 WHERE SpecialitySno= ?";
                $stmt = $this->ObjPdo->prepare($deleterecord);
                $stmt->execute([$SpecialitySno]);
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
       /* }*/
    }
}