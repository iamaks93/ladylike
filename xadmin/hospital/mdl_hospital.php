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

class mdl_Hospital
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
    function SubmitHospital($Request)
    {
      // Sanitize user input(never trust on user input)
      $HospitalSno = $this->ObjBase->sanitize_input(intval($Request['hiddenHospitalSno']));
      $HospitalName = $this->ObjBase->sanitize_input($Request['txtHospitalName']);
      $StdCode = $this->ObjBase->sanitize_input($Request['txtStdCode']);
      $PhoneNo = $this->ObjBase->sanitize_input($Request['txtPhoneNo']);
      $MobileNo = $this->ObjBase->sanitize_input($Request['txtMobile']);
      $Email = $this->ObjBase->sanitize_input($Request['txtEmail']);
      $Website = $this->ObjBase->sanitize_input($Request['txtWebsite']);
      $PinCode = $this->ObjBase->sanitize_input($Request['txtPinCode']);
      $City = $this->ObjBase->sanitize_input($Request['ddlbCity']);
      $State = $this->ObjBase->sanitize_input($Request['ddlbState']);
      $Country = $this->ObjBase->sanitize_input($Request['ddlbCountry']);
      $Address = $this->ObjBase->sanitize_input($Request['txaAddress']);
      $Remark = $this->ObjBase->sanitize_input($Request['txaRemark']);

       if(!empty($Request['ddlbTaluka']))
       {
           $Taluka = $this->ObjBase->sanitize_input(intval($Request['ddlbTaluka']));
       }
       else
       {
           $Taluka = 0;
       }



        //Check if hospital name is not blank
        if(!empty($HospitalName))
        {
            // Check duplication of hospital name,don't allow for duplication
            $getcount = $this->ObjBase->getcount("hospital","HospitalSno","HospitalName='".$HospitalName."' AND HospitalSno !=".intval($HospitalSno)." AND Active=1",$this->ObjPdo);

            // If count is greater(Count will greater than 0,only when it already stored in db),show error message
            if($getcount > 0)
            {
                echo "Hospital name already exists.";
                die();
            }
         }
        else // If city code is blank, throw validation error message
        {
            echo "Please enter hospital name.";
            die();
        }

               // Add mode
                if($HospitalSno == 0)
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

                        $Active = 1;

                       /*  @use : Insert data in db
                        *  @table : hospital
                        *  @primarykey : HospitalSno
                        */
                        $Insert = " Insert into hospital(InDateTime,UpdateOn,UpdatedBy,InUID,MachineIP,MachineName,Active,HospitalName,StdCode,PhoneNo,MobileNo,Email,Website,PinCode,CitySno,TalukaSno,StateSno,CountrySno,Address,Remark) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

                        $stmt  = $this->ObjPdo->prepare($Insert);

                        // $sth->bindParam(1, $calories, PDO::PARAM_INT);
                        //$sth->bindParam(2, $colour, PDO::PARAM_STR, 12);
                        // Bind Variable for prepare statement to avoid sql injection
                        $stmt->bindParam(1,$UpDateOnDateTime,PDO::PARAM_STR);
                        $stmt->bindParam(2,$UpDateOnDateTime,PDO::PARAM_STR);
                        $stmt->bindParam(3,$UpdateBy,PDO::PARAM_INT);
                        $stmt->bindParam(4,$UpdateBy,PDO::PARAM_INT);
                        $stmt->bindParam(5,$Machine_Ip,PDO::PARAM_STR);
                        $stmt->bindParam(6,$MachineName,PDO::PARAM_STR);
                        $stmt->bindParam(7,$Active,PDO::PARAM_INT);
                        $stmt->bindParam(8,$HospitalName,PDO::PARAM_STR);
                        $stmt->bindParam(9,$StdCode,PDO::PARAM_STR);
                        $stmt->bindParam(10,$PhoneNo,PDO::PARAM_STR);
                        $stmt->bindParam(11,$MobileNo,PDO::PARAM_STR);
                        $stmt->bindParam(12,$Email,PDO::PARAM_STR);
                        $stmt->bindParam(13,$Website,PDO::PARAM_STR);
                        $stmt->bindParam(14,$PinCode,PDO::PARAM_STR);
                        $stmt->bindParam(15,$City,PDO::PARAM_INT);
                        $stmt->bindParam(16,$Taluka,PDO::PARAM_INT);
                        $stmt->bindParam(17,$State,PDO::PARAM_INT);
                        $stmt->bindParam(18,$Country,PDO::PARAM_INT);
                        $stmt->bindParam(19,$Address,PDO::PARAM_STR);
                        $stmt->bindParam(20,$Remark,PDO::PARAM_STR);


                        //Begin transaction
                        $this->ObjPdo->beginTransaction();
                        // If  submit successfully give success message
                        if($stmt->execute())
                        {
                            //Commit trnasaction
                            $this->ObjPdo->commit();
                            echo "Hospital Data Submitted.";
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
                else if($HospitalSno > 0) // Edit Mode
                {

                    try
                    {
                        $UpDateOnDateTime = "";
                        $UpDateOnDateTime = date('Y-m-d H:i:s');

                        /*  @use : Update data in db
                         *  @table : state
                         *  @primarykey : CitySno
                         */

                        $sql = " UPDATE hospital SET UpdateOn = ?,HospitalName = ?,StdCode = ?,PhoneNo = ?,MobileNo = ?,Email= ?,Website = ?,PinCode = ?,CitySno = ?,TalukaSno = ?,StateSno = ?,CountrySno = ?,Address = ?,Remark = ? WHERE Active=1 AND HospitalSno = ?";

                       // $Insert = " Insert into hospital(UpdateOn,HospitalName,StdCode,PhoneNo,MobileNo,Email,Website,PinCode,CitySno,TalukaSno,StateSno,CountrySno,Address,Remark) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

                        // Bind Variable for prepare statement to avoid sql injection
                        $stmt = $this->ObjPdo->prepare($sql);
                        $stmt->bindParam(1,$UpDateOnDateTime,PDO::PARAM_STR);
                        $stmt->bindParam(2,$HospitalName,PDO::PARAM_STR);
                        $stmt->bindParam(3,$StdCode,PDO::PARAM_STR);
                        $stmt->bindParam(4,$PhoneNo,PDO::PARAM_STR);
                        $stmt->bindParam(5,$MobileNo,PDO::PARAM_STR);
                        $stmt->bindParam(6,$Email,PDO::PARAM_STR);
                        $stmt->bindParam(7,$Website,PDO::PARAM_STR);
                        $stmt->bindParam(8,$PinCode,PDO::PARAM_STR);
                        $stmt->bindParam(9,$City,PDO::PARAM_INT);
                        $stmt->bindParam(10,$Taluka,PDO::PARAM_INT);
                        $stmt->bindParam(11,$State,PDO::PARAM_INT);
                        $stmt->bindParam(12,$Country,PDO::PARAM_INT);
                        $stmt->bindParam(13,$Address,PDO::PARAM_STR);
                        $stmt->bindParam(14,$Remark,PDO::PARAM_STR);
                        $stmt->bindParam(15,$HospitalSno,PDO::PARAM_INT);

                        $this->ObjPdo->beginTransaction();
                        // If  update successfully give success message
                        if ($stmt->execute())
                        {
                            // Commit transaction
                            $this->ObjPdo->commit();
                            echo "Hospital Data Updated.";
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
     *@return : Return all hospital table data
     */
    function GetHospital()
    {
        // Datatable header field
        $aColumns = array('HospitalSno','HospitalName','CitySno','StateSno','ContactNo','Action');
        $output = array(
            "sEcho" => 1,
            "iTotalRecords" => 10,
            "iTotalDisplayRecords" => 10,
            "aaData" => array()
        );

        //Get number of rows City table have
        $sql = " Select HospitalSno,HospitalName,(SELECT CityName FROM city WHERE city.Active=1 AND hospital.CitySno = city.CitySno)As CitySno,(SELECT StateName FROM  state WHERE state.Active=1 AND hospital.StateSno = state.StateSno)As StateSno,(CASE WHEN hospital.StdCode THEN CONCAT(hospital.StdCode,'-',hospital.PhoneNo) ELSE hospital.MobileNo  END) As ContactNo,'Action' As Action FROM hospital WHERE Active=1";
        $stmt = $this->ObjPdo->prepare($sql);
        $stmt->execute();
        $aRow = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //Create json array
        foreach($aRow As $aRowkey=>$aRowvalue)
        {
            $row = array();
            foreach($aRowvalue As $key=>$val)
            {
                if($key == "Action")
                {

                    $PKeyRequestName = "'hospitalsno'";
                    $DoctorSno = $aRowvalue['HospitalSno'];
                    $RequestPageName = "'ctl_hospital.php'";
                    $HideDiv = "'divHospitalDataTableContainer'";
                    $ShowDiv = "'divTargetHospital'";
                    $ButtonDisable = "'btnAddHospital'";
                    $DeleteFunctionName = "'deletehospitalrecord'";

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
       /* echo "<pre>";
        print_R($output);
        exit;*/
        // Return json array
        echo json_encode($output);
    }

    /* @uses : To show edit mode in screen layout
     * @param : $Citysno primary key of selected record
     */
    function EditHospital($HospitalSno)
    {
        $editrecord = " Select HospitalSno,Active,HospitalName,Address,CitySno,TalukaSno,StateSno,CountrySno,PinCode,StdCode,PhoneNo,MobileNo,Email,Website,Remark FROM hospital WHERE Active=1 AND HospitalSno = ?";
        $stmt = $this->ObjPdo->prepare($editrecord);
        $stmt->execute([$HospitalSno]);
        $Result = $stmt->fetch(PDO::FETCH_OBJ);
        return $Result;
    }

    /* @uses : Delete datatable column data from hospital
     * @param : $HospitalSno, selected row primary key
     */
    function DeleteHospitalRecord($HospitalSno)
    {
        //Check selected record used in another table or not
        $GetCountHospital = $this->ObjBase->getcount("doctor","DoctorSno","HospitalSno=".intval($HospitalSno)." AND Active=1",$this->ObjPdo);
        if($GetCountHospital > 0)
        {
            echo "Record already in use.";
            die();

        }
        else
        {
            try
            {
                $deleterecord = " Update hospital SET Active=0 WHERE HospitalSno = ?";
                $stmt = $this->ObjPdo->prepare($deleterecord);
                $stmt->execute([$HospitalSno]);
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
    function GetCityName()
    {
        $sql = "SELECT CitySno,CityName FROM city WHERE Active=1 ORDER BY CityName ASC";
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