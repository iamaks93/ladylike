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
require_once "../../constants.php";

class mdl_Doctor
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
     * @param : $_POSTs Request of edit mode (action=submit) and other form controls
     */
    function SubmitDoctor()
    {
/*        echo "<pre>";
        print_r($_REQUEST);
        exit;*/
       /* echo "<pre>";
        print_r($_FILES);
        exit;*/

      /* echo "<pre>";
       print_R($_POST);
       exit;*/
        //
       // if(isset($_FILES['fiFileAvtar']))
        //{
            if($_FILES['fiFileAvtar']['name'] != "")
            {
                $GetUploadedFileDetail = $this->ObjBase->UploadFileInFolder($_FILES['fiFileAvtar'], "image", 2097152, "xadmin/upload/doctor");
                if ($GetUploadedFileDetail[0] === "Sucess")
                {
                    $UploadedAvtarName = $GetUploadedFileDetail[2];
                    //$this->ObjBase->UnLinkFileFromFolder($UploadedFileName,"xadmin/upload/doctor");
                }
            }
            else
            {
                $UploadedAvtarName = $this->ObjSession->DocAvtar;
            }
        //}


                $DoctorSno = $this->ObjBase->sanitize_input(intval($_POST['hiddenDoctorSno']));
               /* echo $DoctorSno;
                exit;*/
                $DoctorName = $this->ObjBase->sanitize_input($_POST['txtDoctorName']);
                $HospitalSno = $this->ObjBase->sanitize_input(intval($_POST['ddlbHospitalName']));
                $DOB = $this->ObjBase->SetDatabaseDateFormat($this->ObjBase->sanitize_input($_POST['dateDOB']),'d/m/Y','Y-m-d');
                $Gender = $_POST['gender'] ? $this->ObjBase->sanitize_input($_POST['gender']) : 0;
                $MaritialStatus = $_POST['maritial'] ? $this->ObjBase->sanitize_input($_POST['maritial']) : 0;
                $DocEmail = $this->ObjBase->sanitize_input($_POST['txtDoctorEmail']);
                $DocMobile = $this->ObjBase->sanitize_input($_POST['txtMobileNo']);
                $PanNo = $this->ObjBase->sanitize_input($_POST['txtPanNo']);
                $DocRegNo = $this->ObjBase->sanitize_input($_POST['txtDocRegNo']);
                $Remark = $this->ObjBase->sanitize_input($_POST['txaAbout']);
                $ResidentAddress = $this->ObjBase->sanitize_input($_POST['txaResidentAddress']);
                $ResidentCitySno = $this->ObjBase->sanitize_input($_POST['ddlbResidentCity']);
                $ResidentTalukaSno = isset($_POST['ddlbResidentTaluka']) ? $_POST['ddlbResidentTaluka'] : 0;
                $ResidentStateSno = isset($_POST['ddlbResidentState']) ? $_POST['ddlbResidentState'] : 0;
                $ResidentCountrySno = isset($_POST['ddlbResidentCountry']) ? $_POST['ddlbResidentCountry'] : 0;
                $ResidentStdCode = $this->ObjBase->sanitize_input($_POST['txtResidentStdCode']);
                $ResidentPhone = $this->ObjBase->sanitize_input($_POST['txtResidentPhoneNo']);

                $CurrentDateTime = date('Y-m-d H:i:s');
                $Machine_Ip = $this->ObjSession->Machine_Ip;
                $UpdateBy = $this->ObjSession->UserSno;
                $MachineName = $this->ObjSession->UserSystemName;


               /* echo $DoctorSno;
                exit;*/
                $this->ObjPdo->beginTransaction();
                try
                {

                    if(intval($DoctorSno) === 0)
                    {
                        $Query = "INSERT INTO doctor(InDateTime, UpdateOn, UpdatedBy, InUID, MachineIP, MachineName, Active, DoctorName, Gender, DOB, MaritalStatus, Avtar, Address, HospitalSno, CitySno, TalukaSno, StateSno, CountrySno, StdCode, PhoneNo, MobileNo, DocEmail,PanNo, DoctorRegistrationNo, About) VALUES (:InDateTime,:UpdateOn,:UpdatedBy,:InUID,:MachineIP,:MachineName,1,:DoctorName,:Gender,:DOB,:MaritalStatus,:Avtar,:Address,:HospitalSno,:CitySno,:TalukaSno,:StateSno,:CountrySno,:StdCode,:PhoneNo,:MobileNo,:DocEmail,:PanNo,:DoctorRegistrationNo,:About)";

                    }
                    else if(intval($DoctorSno) > 0)
                    {
                        $Query = "UPDATE doctor SET UpdateOn = :UpdateOn, UpdatedBy = :UpdatedBy, InUID = :InUID, MachineIP = :MachineIP, MachineName = :MachineName, Active = 1, DoctorName = :DoctorName, Gender = :Gender, DOB = :DOB, MaritalStatus = :MaritalStatus, Avtar = :Avtar, Address = :Address, HospitalSno = :HospitalSno, CitySno = :CitySno, TalukaSno = :TalukaSno, StateSno = :StateSno, CountrySno = :CountrySno, StdCode = :StdCode, PhoneNo = :PhoneNo, MobileNo = :MobileNo, DocEmail = :DocEmail,PanNo = :PanNo, DoctorRegistrationNo = :DoctorRegistrationNo , About = :About WHERE DoctorSno = :DoctorSno";

                     }


                    $stmt = $this->ObjPdo->prepare($Query);

                    if(intval($DoctorSno) == 0)
                    {
                        $stmt->bindParam(':InDateTime',$CurrentDateTime,PDO::PARAM_STR);
                    }

                    $stmt->bindParam(':UpdateOn',$CurrentDateTime,PDO::PARAM_STR);
                    $stmt->bindParam(':UpdatedBy',$UpdateBy,PDO::PARAM_INT);
                    $stmt->bindParam(':InUID',$UpdateBy,PDO::PARAM_INT);
                    $stmt->bindParam(':MachineIP',$Machine_Ip,PDO::PARAM_STR);
                    $stmt->bindParam(':MachineName',$MachineName,PDO::PARAM_STR);
                    $stmt->bindParam(':DoctorName',$DoctorName,PDO::PARAM_STR);
                    $stmt->bindParam(':Gender',$Gender,PDO::PARAM_INT);
                    $stmt->bindParam(':DOB',$DOB,PDO::PARAM_STR);
                    $stmt->bindParam(':MaritalStatus',$MaritialStatus,PDO::PARAM_INT);
                    $stmt->bindParam(':Avtar',$UploadedAvtarName,PDO::PARAM_STR);
                    $stmt->bindParam(':Address',$ResidentAddress,PDO::PARAM_STR);
                    $stmt->bindParam(':HospitalSno',$HospitalSno,PDO::PARAM_INT);
                    $stmt->bindParam(':CitySno',$ResidentCitySno,PDO::PARAM_INT);
                    $stmt->bindParam(':TalukaSno',$ResidentTalukaSno,PDO::PARAM_INT);
                    $stmt->bindParam(':StateSno',$ResidentStateSno,PDO::PARAM_INT);
                    $stmt->bindParam(':CountrySno',$ResidentCitySno,PDO::PARAM_INT);
                    $stmt->bindParam(':StdCode',$ResidentStdCode,PDO::PARAM_STR);
                    $stmt->bindParam(':PhoneNo',$ResidentPhone,PDO::PARAM_STR);
                    $stmt->bindParam(':MobileNo',$DocMobile,PDO::PARAM_STR);
                    $stmt->bindParam(':DocEmail',$DocEmail,PDO::PARAM_STR);
                    $stmt->bindParam(':PanNo',$PanNo,PDO::PARAM_STR);
                    $stmt->bindParam(':DoctorRegistrationNo',$DocRegNo,PDO::PARAM_STR);
                    $stmt->bindParam(':About',$Remark,PDO::PARAM_STR);

                    if(intval($DoctorSno) > 0)
                    {
                        $stmt->bindParam(':DoctorSno',$DoctorSno,PDO::PARAM_INT);
                    }


                    if($stmt->execute())
                    {
                        $LastSno = $this->ObjPdo->lastInsertId();
                        $this->ObjPdo->commit();
                        // get the row id of the first query performed.  This will be added as the foreign key of all child tables
                        //echo $LastSno;
                        //exit;
                       // if($LastSno > 0)
                        //{
                            //echo $DoctorSno;
                            //exit;
                             $this->ObjSession->__unset("HiddenDoctorSno");
                            $this->ObjSession->__unset("DocAvtar");
                            if(intval($DoctorSno) == 0)
                            {
                                echo "Data Inserted";
                                die();
                            }
                            else if(intval($DoctorSno) > 0)
                            {
                                echo "Data Updated";
                                die();
                            }


                       // }
                    }

                }
                catch (PDOException $e)
                {
                    //Rollback if any error occured
                    $this->ObjPdo->rollBack();
                    $this->ObjBase->UnLinkFileFromFolder($UploadedAvtarName,"xadmin/upload/doctor");
                    echo "Error  ". $e->getMessage();
                    $this->ObjSession->__unset("HiddenDoctorSno");
                    $this->ObjSession->__unset("DocAvtar");
                    die();
                }


    }
    /* @uses : Get datatable data in json format when page load
     *@return : Return all state table data
     */
    function GetDoctor()
    {
       /* $imgsrc = UPLOAD;
        echo $imgsrc.'/doctor/img.jpg';
        exit;*/
        // Datatable header field
        $aColumns = array('DoctorSno','Avtar','DoctorName','CitySno','MobileNo','DocEmail','Action');
        $output = array(
            "sEcho" => 1,
            "iTotalRecords" => 10,
            "iTotalDisplayRecords" => 10,
            "aaData" => array()
        );

        //Get number of rows City table have
        $sql = " Select DoctorSno,Avtar,DoctorName,(SELECT CityName FROM  city WHERE city.Active=1 AND doctor.CitySno = city.CitySno)As CitySno,MobileNo,DocEmail,'Action' As Action FROM doctor WHERE Active=1";
        $stmt = $this->ObjPdo->prepare($sql);
        $stmt->execute();
        $aRow = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //Create json array
        foreach($aRow As $aRowkey=>$aRowvalue)
        {
            $row = array();
            foreach($aRowvalue As $key=>$val)
            {
                if($key == "Avtar")
                {
                    $TempDocAvtar = UPLOAD."default/default-img-1.jpg";
                    $DocAvtarTemp = UPLOADPATHXADMIN."doctor/".$aRowvalue['Avtar'];
                    $DocAvtar = UPLOAD."doctor/".$aRowvalue['Avtar'];

                    //$imgsrc = file_exists(str_replace('/',"\\",$DocAvtarTemp)) ? $DocAvtar : $TempDocAvtar;
                    $imgsrc = file_exists($DocAvtarTemp) ? $DocAvtar : $TempDocAvtar;
                    //echo str_replace('/',"\\",$DocAvtar);Exit;
                    $row[] = "<img src='$imgsrc' alt='$aRowvalue[DoctorName]. Profile Picture' class='img-circle' TITLE='$aRowvalue[DoctorName]'>";
                }
                else if($key == "Action")
                {

                    $PKeyRequestName = "'doctorsno'";
                    $DoctorSno = $aRowvalue['DoctorSno'];
                    $_POSTPageName = "'ctl_doctor.php'";
                    $HideDiv = "'divDoctorDataTableContainer'";
                    $ShowDiv = "'divTargetDoctor'";
                    $ButtonDisable = "'btnAddDoctor'";
                    $DeleteFunctionName = "'deletedoctorrecord'";

                    $row[] = "<i class=\"fa fa-pencil m-r-5\" onclick=\"EditCommonRecords($PKeyRequestName,$DoctorSno,$_POSTPageName,$HideDiv,$ShowDiv,$ButtonDisable);\" data-toggle=\"tooltip\" title=\"Edit Record!\"></i> 
                            
                              <i class=\"fa fa-trash-o\" onclick=\"DeleteCommonRecords($_POSTPageName,$DeleteFunctionName,$PKeyRequestName,$DoctorSno);\" data-toggle=\"tooltip\" title=\"Delete Record!\"></i> 
                              ";
                }
                else
                {
                    $row[] = $val;
                }

            }

            $output['aaData'][] = $row;
        }
       /* echo "<pre>";
        print_R($output);
        exit;*/
        // Return json array
        echo json_encode($output);
    }

    /* @uses : To show edit mode in screen layout
     * @param : $Citysno primary key of selected record
     */
    function EditDoctor($DoctorSno)
    {
        $editrecord = " Select DoctorSno,Active,DoctorName,Gender,DOB,MaritalStatus,Avtar,Address,HospitalSno,CitySno,TalukaSno,StateSno,CountrySno,StdCode,PhoneNo,MobileNo,DocEmail,PanNo,DoctorRegistrationNo,About FROM doctor WHERE Active=1 AND DoctorSno= ?";
        $stmt = $this->ObjPdo->prepare($editrecord);
        $stmt->execute([$DoctorSno]);
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
    function GetCityName()
    {
        $sql = "SELECT CitySno,CityName FROM city WHERE Active=1 ORDER BY CityName ASC";
        return $this->ObjPdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    function GetHospitalName()
    {
        $sql = "SELECT HospitalSno,HospitalName FROM hospital WHERE Active=1 ORDER BY HospitalName ASC";
        return $this->ObjPdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    function LoadStateDrodpdown($CitySno)
    {
        $statedata = "";
        $Result = "";
        $sql = "SELECT state.StateSno, state.StateName FROM city LEFT JOIN state ON state.StateSno = city.StateSno   WHERE city.Active = 1 AND state.Active = 1 AND city.CitySno= ? ORDER BY  state.StateName ASC ";
        $statedata = $this->ObjPdo->prepare($sql);
        $statedata->execute([$CitySno]);
        $Result = $statedata->fetch(PDO::FETCH_OBJ);

        $statearray = array();
        if(!empty($Result))
        {
            $statearray[] = array('id'=> $Result->StateSno,'text'=>$Result->StateName);

            header('Content-type:application/json');
            echo json_encode($statearray);
        }
        else
        {
            echo json_encode($statearray);
        }
    }
    function LoadTalukaDrodpdown($CitySno)
    {
        $talukadata = "";
        $Result = "";
        $sql = "SELECT taluka.TalukaSno,taluka.TalukaName FROM taluka LEFT JOIN city ON taluka.TalukaSno = city.TalukaSno WHERE city.Active = 1 AND taluka.Active = 1 AND city.CitySno= ? ORDER BY  taluka.TalukaName ASC ";

        $talukadata = $this->ObjPdo->prepare($sql);
        $talukadata->execute([$CitySno]);
        $Result = $talukadata->fetch(PDO::FETCH_OBJ);


        $talukaarray = array();
        if(!empty($Result))
        {
            $talukaarray[] = array('id'=> $Result->TalukaSno,'text'=>$Result->TalukaName);
            header('Content-type:application/json');
            echo json_encode($talukaarray);
        }
        else
        {
            echo json_encode($talukaarray);
        }
    }
    function LoadCountryDrodpdown($CitySno)
    {
        $countrydata = "";
        $Result = "";
        $sql = "SELECT country.CountrySno,country.CountryName FROM country LEFT JOIN city ON  country.CountrySno = city.CountrySno  WHERE country.Active = 1 AND city.Active = 1 AND city.CitySno= ? ORDER BY  country.CountryName ASC ";
        $countrydata = $this->ObjPdo->prepare($sql);
        $countrydata->execute([$CitySno]);
        $Result = $countrydata->fetch(PDO::FETCH_OBJ);

        $countryarray = array();
        if(!empty($Result))
        {
            $countryarray[] = array('id'=> $Result->CountrySno,'text'=>$Result->CountryName);
            header('Content-type:application/json');
            echo json_encode($countryarray);

        }
        else
        {
            echo json_encode($countryarray);
        }
    }

}