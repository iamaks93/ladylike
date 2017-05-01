<?php
require_once "../../core/base.php";
require_once "../../core/connection.php";
require_once "../../core/session.php";
/**
 * Created by PhpStorm.
 * User: Maa
 * Date: 2/12/2017
 * Time: 12:02 PM
 */
class mdl_Country
{
    var $ObjConn;
    var $ObjBase;
    var $ObjSession;
    function __construct()
    {
        $this->ObjConn = new Connection();
        $this->ObjBase = new Base();
        $this->ObjPdo = $this->ObjConn->GetConnect();
        $this->ObjSession = Session::getInstance();
    }

    function SubmitCountry($Request)
    {

      $countryname = $Request['txtCountryName'];
      $countrycode = $Request['txtCountryCode'];
      $countrysno = intval($Request['hiddenCountrySno']);
      $desc = $Request['txaDescription'];

        //Check if country code is not blank
        if(!empty($countrycode))
        {
           $getcount = $this->ObjBase->getcount("country","CountrySno","CountyCode='".$countrycode."' AND CountrySno !=".intval($countrysno)." AND Active=1",$this->ObjPdo);
            if($getcount > 0)
            {
                echo "Country code already exists.";
                die();
            }
         }
        else
        {
            echo "Please enter country code";
            die();
        }

        if(!empty($countryname))
        {
              $getcount1 = $this->ObjBase->getcount("country","CountrySno","CountryName='$countryname' AND CountrySno !=".intval($countrysno)." AND Active=1",$this->ObjPdo);
              if($getcount1 > 0)
              {
                  echo "Country name already exists.";
                  die();
              }
        }
        else
        {
              echo "Please enter country name";
              die();
        }
        try
        {
                if($countrysno == 0)
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

                    $Insert = " Insert into country(InDateTime,UpdateOn,UpdatedBy,InUID,MachineIP,MachineName,Active,CountyCode,CountryName,Description) VALUES (?,?,?,?,?,?,?,?,?,?)";
                    $stmt  = $this->ObjPdo->prepare($Insert);
                    $submit =  $stmt->execute(array($CurrentDateTime,$CurrentDateTime,$UpdateBy,$UpdateBy,$Machine_Ip,$MachineName,1,$countrycode,$countryname,$desc));

                    if($submit)
                    {
                        echo "Country Data Submitted.";
                        die();
                    }
                    else
                    {
                        echo "Something went wrong";
                        die();
                    }
                }
                else if($countrysno > 0)
                {
                    $UpDateOnDateTime = "";
                    $UpDateOnDateTime = date('Y-m-d H:i:s');
                    $sql = " UPDATE country SET UpdateOn = :updateon,CountyCode = :countrycode,CountryName = :countryname,Description = :description WHERE Active=1 AND CountrySno = :countrysno";


                    $stmt = $this->ObjPdo->prepare($sql);
                    $stmt->bindParam(':updateon',$UpDateOnDateTime);
                    $stmt->bindParam(':countrycode',$countrycode);
                    $stmt->bindParam(':countryname',$countryname);
                    $stmt->bindParam(':description',$desc);
                    $stmt->bindParam(':countrysno',$countrysno);

                    if ($stmt->execute())
                    {
                        echo "Country Data Updated.";
                        die();
                    }
                    else
                    {
                        echo "Something went wrong";
                        die();
                    }
                }
        }
        catch(ObjPdoException $e)
        {
            echo $e->getMessage();
        }
    }

    function GetCountry()
    {
        $sql = " Select CountrySno,CountyCode,CountryName,Description,'Action' FROM Country WHERE Active=1";
        $stmt = $this->ObjPdo->prepare($sql);
        $stmt->execute();
        $aColumns = array('CountrySno','CountyCode','CountryName','Description','Action');
        $output = array(
            "sEcho" => 1,
            "iTotalRecords" => 1,
            "iTotalDisplayRecords" => 4,
            "aaData" => array()
        );

        $aRow = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($aRow As $aRowkey=>$aRowvalue)
        {
            $row = array();
            foreach($aRowvalue As $key=>$val)
            {
                if($val == "Action")
                {

                    $row[] = "    <i class=\"fa fa-pencil m-r-5\" onclick=\"EditCountry($aRowvalue[CountrySno]);\" data-toggle=\"tooltip\" title=\"Edit Record!\"></i> 
                            
                                    <i class=\"fa fa-trash-o\" onclick=\"DeleteCountryData($aRowvalue[CountrySno]);\" data-toggle=\"tooltip\" title=\"Delete Record!\"></i> 
                              ";
                }
                else
                {
                    $row[] = $val;
                }

            }
            $output['aaData'][] = $row;
        }
        echo json_encode($output);
    }
    function EditCountry($CitySno)
    {
        $editrecord = " Select CountrySno,Active,CountyCode,CountryName,Description FROM Country WHERE Active=1 AND CountrySno = ?";
        $stmt = $this->ObjPdo->prepare($editrecord);
        $stmt->execute([$CitySno]);
        $Result = $stmt->fetch(PDO::FETCH_OBJ);
        return $Result;
    }

    function DeleteCountryRecord($CountrySno)
    {
        $GetCountCountry = $this->ObjBase->getcount("state","StateSno","CountrySno=".intval($CountrySno)." AND Active=1",$this->ObjPdo);
        if($GetCountCountry > 0)
        {
            echo "Record already in use.";
            die();

        }
        else
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
            else
            {
                echo "Something went wrong";
                die();
            }
        }
    }
}