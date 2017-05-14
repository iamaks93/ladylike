<?php
/*if($RequestHandlerAction == "add")
{
    $Mode = $RequestHandlerAction;
}
else
{
    $Mode = $RequestHandlerAction;
}*/
/**
 * Created by PhpStorm.
 * User: Maa
 * Date: 14/03/2017
 * Time: 10:02 PM
 */
$TempDocAvtar = UPLOAD."default/default-img-1.jpg";
$DocAvtar = "";
if ($RequestHandlerAction == "add") 
{
    $DoctorSno = 0;
    //$DoB = $this->ObjBase->SetDatabaseDateFormat(date("d/m/Y"));
    $DoB = date("m/d/Y");
    $DocAvtar = $TempDocAvtar;
} 
else 
{
    $DoctorSno = $DoctorData->DoctorSno;
    $DoB = $this->ObjBase->SetDatabaseDateFormat($DoctorData->DOB,'Y-m-d','d/m/Y');


    $DocAvtarTemp = UPLOADPATHXADMIN."doctor/".$DoctorData->Avtar;
    $DocAvtar = UPLOAD."doctor/".$DoctorData->Avtar;
    $DocAvtar = file_exists($DocAvtarTemp) ? $DocAvtar : $TempDocAvtar;
}

?>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?= ucfirst($RequestHandlerAction) ?> Doctor</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li class="pull-right">
                        <a class="collapse-link">
                            <i class="fa fa-close"
                               onclick="closediv('divTargetDoctor','divDoctorDataTableContainer','','btnAddDoctor');"
                               title="Close"></i>
                        </a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content no-padding no-margin">

                <form id="formSubmitDoctor" class="form-horizontal form-label-left" enctype="multipart/form-data" method="post" action="ctl_doctor.php?action=submit">
                    <input type="hidden" name="hiddenDoctorSno" id="hiddenDoctorSno" class="hiddenDoctorSno"
                           value="<?=intval($DoctorSno)?>">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                            <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12 no-padding">
                                <h4 class="pageBlockHeader">Basic Detail :</h4>
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12">
                                <div class="BasicDetailErrorDoctorDiv pull-right height15 errorClass"
                                     id="BasicDetailErrorDoctorDiv"></div>
                            </div>
                        </div>
                    </div>
                    <div class="blockWrapperContainer blockBorder">
                        <div class="row m-t-10">
                            <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="txtDoctorName">Doctor
                                        Name : <span class="required">*</span>
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <input type="text" name="txtDoctorName" id="txtDoctorName"
                                               class="form-control col-md-4 col-xs-12 txtDoctorName"
                                               value="<?php if (isset($DoctorData->DoctorName)) {
                                                   echo $DoctorData->DoctorName;
                                               } ?>" maxlength="100" placeholder="Enter doctor name" tabindex="1">
                                    </div>

                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="ddlbHospitalName">Hospital
                                        Name
                                        : <span class="required">*</span>
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <select name="ddlbHospitalName" id="ddlbHospitalName" class="ddlbHospitalName"
                                                style="min-width:100%;" tabindex="2">
                                            <option value="0">SELECT</option>
                                            <?php

                                            foreach ($GetHospitalName As $key)
                                            {
                                                $Selected = "";
                                                if ($key['HospitalSno'] == $DoctorData->HospitalSno)
                                                {
                                                    $Selected = "selected";
                                                }

                                                ?>
                                                <option value="<?= $key['HospitalSno'] ?>" <?php echo $Selected; ?>>
                                                    <?= $key['HospitalName'] ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="com-md-12 col-sm-12 col-lg-12 col-xs-12">
                                <div class="form-group">


                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="dateDOB">DOB : <span
                                                class="required">*</span>
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <input type="text" name="dateDOB" id="dateDOB"
                                               class="form-control col-md-4 col-xs-12 dateDOB"
                                               value="<?=$DoB?>" tabindex="3">
                                    </div>


                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Gender : <span
                                                class="required m-r-10"></span>
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <div id="gender" class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-default" data-toggle-class="btn-primary"
                                                   data-toggle-passive-class="btn-default">
                                                <input type="radio" name="gender" value="1" id="rdoMale" tabindex="4" <?php if(isset($DoctorData->Gender)) { if($DoctorData->Gender == 1) { echo "checked=\"checked\""; }  }else { echo "checked=\"checked\""; } ?>> &nbsp; Male
                                                &nbsp;
                                            </label>
                                            <label class="btn btn-primary" data-toggle-class="btn-primary"
                                                   data-toggle-passive-class="btn-default">
                                                <input type="radio" name="gender" value="0" id="rdoFemale" tabindex="4" <?php if(isset($DoctorData->Gender)) { if($DoctorData->Gender == 0) { echo "checked=\"checked\""; }  }?>> Female
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="com-md-12 col-sm-12 col-lg-12 col-xs-12">
                                <div class="form-group">

                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Maritial Status : <span
                                                class="required m-r-10"></span>
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <div id="gender" class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-default" data-toggle-class="btn-primary"
                                                   data-toggle-passive-class="btn-default">
                                                <input type="radio" name="maritial" value="1" id="rdoMarried" tabindex="5" checked="checked"> &nbsp;
                                                Married &nbsp;
                                            </label>
                                            <label class="btn btn-primary" data-toggle-class="btn-primary"
                                                   data-toggle-passive-class="btn-default">
                                                <input type="radio" name="maritial" value="0" id="rdoUnMarried" tabindex="5">
                                                Unmarried
                                            </label>
                                        </div>
                                    </div>

                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">
                                            Avtar:
                                        <span class="required m-r-10"></span>
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <!--suppress ProblematicWhitespace -->
                                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail img-circle img-raised">
                                                <img src="<?=$DocAvtar?>" alt="...">
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail img-circle img-raised"></div>
                                            <div>
                                                <span class="btn btn-raised btn-round btn-default btn-file">
                                                    <span class="fileinput-new">Add Photo</span>
                                                    <span class="fileinput-exists">Change</span>
                                                    <input type="file" name="fiFileAvtar" id="fiFileAvtar" class="fiFileAvtar"
                                                           value="" tabindex="6"/>
                                                </span>
                                                <br/>
                                                <a href="#" class="btn btn-danger btn-round fileinput-exists"
                                                   data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                            <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12 no-padding">
                                <h4 class="pageBlockHeader">Personal Detail :</h4>
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12">
                                <div class="PersonalDetailErrorDoctorDiv pull-right height15 errorClass"
                                     id="PersonalDetailErrorDoctorDiv"></div>
                            </div>
                        </div>
                    </div>
                    <div class="blockWrapperContainer blockBorder">
                        <div class="row m-t-10">
                            <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="txtDoctorEmail">Email
                                        : <span class="required"></span>
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <input type="text" name="txtDoctorEmail" id="txtDoctorEmail"
                                               class="form-control col-md-4 col-xs-12 txtDoctorEmail"
                                               maxlength="30" placeholder="Enter email address" tabindex="7" value="<?php if(isset($DoctorData->DocEmail)) { echo $DoctorData->DocEmail; } ?>">
                                    </div>
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="txtMobileNo">Mobile :
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <input type="text" name="txtMobileNo" id="txtMobileNo"
                                               class="form-control col-md-4 col-xs-12 txtMobileNo"
                                               maxlength="15" placeholder="Enter mobile no" tabindex="8" value="<?php if(isset($DoctorData->MobileNo)) { echo $DoctorData->MobileNo; } ?>">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="txtPanNo">PAN No :
                                        <span class="required m-r-10"></span>
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <input type="text" name="txtPanNo" id="txtPanNo"
                                               class="form-control col-md-4 col-xs-12 txtPanNo"
                                               maxlength="50" placeholder="Enter pan card no." tabindex="9" value="<?php if(isset($DoctorData->PanNo)) { echo $DoctorData->PanNo; } ?>">
                                    </div>
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="txtDocRegNo">Doc. Reg.
                                        No : <span class="required m-r-10"></span>
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <input type="text" name="txtDocRegNo" id="txtDocRegNo"
                                               class="form-control col-md-4 col-xs-12 txtDocRegNo"
                                               maxlength="50" placeholder="Enter doctor register no." tabindex="10" value="<?php if(isset($DoctorData->DoctorRegistrationNo)) { echo $DoctorData->DoctorRegistrationNo; } ?>">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row m-t-10">
                            <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                <div class="form-group">

                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="txaAbout">Remark
                                        : <span class="required m-r-10"></span>
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <textarea name="txaAbout" id="txaAbout" class="form-control" rows="3"
                                                  maxlength="500" tabindex="11"><?php if(isset($DoctorData->About)) { echo $DoctorData->About; } ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                            <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12 no-padding">
                                <h4 class="pageBlockHeader">Residance Detail :</h4>
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12">
                                <div class="ResidanceDetailErrorDoctorDiv pull-right height15 errorClass"
                                     id="ResidanceDetailErrorDoctorDiv"></div>
                            </div>
                        </div>
                    </div>
                    <div class="blockWrapperContainer blockBorder">
                        <div class="row m-t-10">
                            <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                <div class="form-group">

                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="txaResidentAddress">Address
                                        : <span></span>
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <textarea name="txaResidentAddress" id="txaResidentAddress" class="form-control"
                                                  rows="3"
                                                  maxlength="500" tabindex="12"><?php if (isset($DoctorData->Address)) {
                                                echo $DoctorData->Address;} ?></textarea>
                                    </div>

                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="ddlbResidentCity">City
                                        Name
                                        : <span class="required">*</span>
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <select name="ddlbResidentCity" id="ddlbResidentCity" class="ddlbResidentCity"
                                                style="min-width:100%;"  onchange="LoadCountryStateTalukaDropdown(this.value);" tabindex="13">
                                            <option value="0">SELECT</option>
                                            <?php

                                            foreach ($GetCityName As $key) {

                                                $Selected = "";
                                                if ($key['CitySno'] == $DoctorData->CitySno) {
                                                    $Selected = "selected";
                                                }

                                                ?>
                                                <option value="<?= $key['CitySno'] ?>" <?php echo $Selected; ?>>
                                                    <?= $key['CityName'] ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="ddlbResidentTaluka">Taluka
                                        : <span
                                                class="required"></span>
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <select name="ddlbResidentTaluka" id="ddlbResidentTaluka"
                                                class="ddlbResidentTaluka" style="min-width:100%;" tabindex="14">
                                        </select>
                                    </div>

                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="ddlbResidentState">State
                                        Name :
                                        <span class="required"></span>
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <select name="ddlbResidentState" id="ddlbResidentState"
                                                class="ddlbResidentState" style="min-width:100%;"
                                                tabindex="15">

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                <div class="form-group">

                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="ddlbResidentCountry">Country
                                        Name
                                        : <span class="required"></span>
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <select name="ddlbResidentCountry" id="ddlbResidentCountry"
                                                class="ddlbResidentCountry"
                                                style="min-width:100%;" tabindex="16">

                                        </select>
                                    </div>

                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="">Std/Phone
                                        : <span class="required m-r-10"></span>
                                    </label>
                                    <div class="col-md-1 col-sm-1 col-xs-12">
                                        <input type="text" name="txtResidentStdCode" id="txtResidentStdCode"
                                               class="form-control col-md-4 col-xs-12 txtResidentStdCode"
                                               maxlength="10" placeholder="Std code" tabindex="17" value="<?php if (isset($DoctorData->Address)) { echo $DoctorData->StdCode;} ?>">
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <input type="text" name="txtResidentPhoneNo" id="txtResidentPhoneNo"
                                               class="form-control col-md-4 col-xs-12 txtResidentPhoneNo"
                                               maxlength="10" placeholder="Enter phone no" tabindex="18" value="<?php if (isset($DoctorData->Address)) { echo $DoctorData->PhoneNo;} ?>">
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                    <!--<div class="ln_solid"></div>-->
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12"></div>
                        <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12">
                            <div class="pull-right m-r-5">
                                <button type="submit" class="btn btn-success btnSubmitDoctor" id="btnSubmitDoctor" tabindex="19">
                                    Submit
                                </button>
                                <button type="button" class="btn btn-primary"
                                        onclick="closediv('divTargetDoctor','divDoctorDataTableContainer','','btnAddDoctor');" tabindex="20">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    var Sno;
    var StateSno;



    $("document").ready(function () {

        $(".fileinput-exists").on('click',function () {
           // $(".fileinput-new").next().find(img).val();
            var val =   $(".fileinput-new").children('img').attr("src");
            $('.fileinput').fileinput('clear');
        });
        $('#dateDOB').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true
        });

        Sno = $("#hiddenDoctorSno").val();
        CitySno = '<?php if (!empty($DoctorData->CitySno))
        {
            echo $DoctorData->CitySno;
        }?>';
        if (CitySno > 0)
        {
            // Fill dropdown in edit mode
             LoadCountryStateTalukaDropdown(CitySno);
        }

        $("#ddlbHospitalName").select2();
        $("#ddlbResidentCity").select2();
        $("#ddlbResidentCountry").select2();
        $("#ddlbResidentState").select2();
        $("#ddlbResidentTaluka").select2();

        /* @use : Submit state form data*/
        $("#formSubmitDoctor").on("submit", function (e)
        {
            e.preventDefault();
            var formid = $("form").attr('id');
            // Validate state form control
            if (ValidateDoctor(formid) === true)
            {
                    var data = new FormData(this);
                    var ajaxsubmit = callajaxreturn("ctl_doctor.php?action=submit", data, "", "POST", "", "", "");

                    //alert(ajaxsubmit);
                    $("#ErrorDoctorDiv").html("");
                    if (ajaxsubmit.trim() == "Data Inserted" || ajaxsubmit.trim() == "Data Updated")
                    {
                        // Reload data table
                        ReloadDataTable('datatablemasters');
                        //close div on success
                        closediv('divTargetDoctor', 'divDoctorDataTableContainer', '', 'btnAddDoctor');
                    }
                    else
                    {
                        $("#ErrorDoctorDiv").html("<b>" + ajaxsubmit + "</b>");
                        return false;
                    }

            }
//            else
//                {
//                return false;
//            }
        });
    });

    function LoadCountryStateTalukaDropdown(CitySno)
    {
        var url = "ctl_doctor.php";
        var talukadata = "action=loadtalukadrodpdown&citysno=" + CitySno;
        FillDependentDropdown(url, talukadata, "ddlbResidentTaluka", 0, '', false);

        var statedata = "action=loadStateDrodpdown&citysno=" + CitySno;
        FillDependentDropdown(url, statedata, "ddlbResidentState", 0, '', false);

        var countrydata = "action=loadcountrydrodpdown&citysno=" + CitySno;
        FillDependentDropdown(url, countrydata, "ddlbResidentCountry", 0, '', false);
    }

</script>