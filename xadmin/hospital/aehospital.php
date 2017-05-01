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
if ($RequestHandlerAction == "add")
{
   $HospitalSno = 0;
}
else
{
    $HospitalSno = $HospitalData->HospitalSno;
}

?>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?= ucfirst($RequestHandlerAction)?> Hospital</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li class="pull-right">
                        <a class="collapse-link">
                            <i class="fa fa-close"
                               onclick="closediv('divTargetHospital','divHospitalDataTableContainer','','btnAddHospital');"
                               title="Close"></i>
                        </a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content no-padding no-margin">

                <form id="formSubmitDoctor" class="form-horizontal form-label-left">
                    <input type="hidden" name="hiddenHospitalSno" id="hiddenHospitalSno" class="hiddenHospitalSno"
                           value="<?=$HospitalSno?>">

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                            <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12 no-padding">
                                <h4 class="pageBlockHeader"></h4>
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12">
                                <div class="ErrorHospitalDiv pull-right height15 errorClass" id="ErrorHospitalDiv"></div>
                            </div>
                        </div>
                    </div>
                    <div class="blockWrapperContainer blockBorder m-t-10">
                        <div class="row m-t-10">
                            <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                <div class="form-group">

                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="txtHospitalName">Hospital Name
                                        : <span class="required">*</span>
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <input type="text" name="txtHospitalName" id="txtHospitalName"
                                               class="form-control col-md-4 col-xs-12 txtHospitalName"
                                               maxlength="100" placeholder="Hospital name" tabindex="1"
                                               value="<?php if(isset($HospitalData->HospitalName)){ echo $HospitalData->HospitalName; }?>">
                                    </div>

                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="">Std/Phone
                                        : <span class="required"></span>
                                    </label>
                                    <div class="col-md-1 col-sm-1 col-xs-12">
                                        <input type="text" name="txtStdCode" id="txtStdCode"
                                               class="form-control col-md-4 col-xs-12 txtStdCode"
                                               maxlength="10" placeholder="Std code" tabindex="2" value="<?php if(isset($HospitalData->StdCode)){ echo $HospitalData->StdCode; }?>">
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <input type="text" name="txtPhoneNo" id="txtPhoneNo"
                                               class="form-control col-md-4 col-xs-12 txtPhoneNo"
                                               maxlength="20" placeholder="Enter phone no" tabindex="3" value="<?php if(isset($HospitalData->PhoneNo)){ echo $HospitalData->PhoneNo; }?>">
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                <div class="form-group">

                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="txtMobile">Mobile
                                        : <span class="required m-r-10"></span>
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <input type="text" name="txtMobile" id="txtMobile"
                                               class="form-control col-md-4 col-xs-12 txtMobile"
                                               maxlength="20" placeholder="Enter mobile no" tabindex="4" value="<?php if(isset($HospitalData->MobileNo)){ echo $HospitalData->MobileNo; }?>">
                                    </div>

                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="txtEmail">Email
                                        : <span class="required"></span>
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <input type="email" name="txtEmail" id="txtEmail"
                                               class="form-control col-md-4 col-xs-12 txtEmail"
                                               maxlength="30" placeholder="Hospital email" tabindex="5" value="<?php if(isset($HospitalData->Email)){ echo $HospitalData->Email; }?>">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                <div class="form-group">

                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="txtWebsite">Website
                                        : <span class="required m-r-10"></span>
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <input type="text" name="txtWebsite" id="txtWebsite"
                                               class="form-control col-md-4 col-xs-12 txtWebsite"
                                               maxlength="30" placeholder="Hospital website" tabindex="6" value="<?php if(isset($HospitalData->Website)){ echo $HospitalData->Website; }?>">
                                    </div>

                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="txtPinCode">PinCode
                                        : <span class="required"></span>
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <input type="text" name="txtPinCode" id="txtPinCode"
                                               class="form-control col-md-4 col-xs-12 txtPinCode"
                                               maxlength="10" placeholder="Pin code" tabindex="7" value="<?php if(isset($HospitalData->PinCode)){ echo $HospitalData->PinCode; }?>">
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="ddlbCity">City Name
                                        : <span class="required">*</span>
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <select name="ddlbCity" id="ddlbCity" class="ddlbCity"
                                                style="min-width:100%;" onchange="LoadCountryStateTalukaDropdown(this.value);"
                                                tabindex="8">
                                            <option value="0"  selected="selected">SELECT</option>
                                            <?php

                                                foreach ($GetCityName As $key)
                                                {

                                                    $Selected = "";
                                                    if ($key['CitySno'] == $HospitalData->CitySno)
                                                    {
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

                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="ddlbTaluka">Taluka :
                                        <span class="required"></span>
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <select name="ddlbTaluka" id="ddlbTaluka" class="ddlbTaluka" style="min-width:100%;"
                                                tabindex="9">
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="ddlbState">State Name :
                                        <span class="required m-r-10"></span>
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <select name="ddlbState" id="ddlbState" class="ddlbState" style="min-width:100%;"
                                                tabindex="10">

                                        </select>
                                    </div>

                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="ddlbCountry">Country Name
                                        : <span class="required"></span>
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <select name="ddlbCountry" id="ddlbCountry" class="ddlbCountry"
                                                style="min-width:100%;"
                                                tabindex="11">

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                <div class="form-group">

                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="txaAddress">Address
                                        : <span class="m-r-10"></span>
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <textarea name="txaAddress" id="txaAddress" class="form-control" rows="3"
                                                  maxlength="500" tabindex="12"><?php if(isset($HospitalData->Address)) {
                                                echo $HospitalData->Address;} ?></textarea>
                                    </div>

                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="txaRemark">Remark
                                        : <span></span>
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <textarea name="txaRemark" id="txaRemark" class="form-control txaRemark" rows="3"
                                                  maxlength="500" tabindex="13"><?php if(isset($HospitalData->Remark)) {
                                                echo $HospitalData->Remark;} ?></textarea>
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
                                <button type="button" class="btn btn-success btnSubmitHospital" id="btnSubmitHospital">Submit
                                </button>
                                <button type="button" class="btn btn-primary"
                                        onclick="closediv('divTargetHospital','divHospitalDataTableContainer','','btnAddHospital');">
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
<script type="text/javascript">
    var Sno;
    var StateSno;
    $("document").ready(function () {

        $('#dateDOB').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true
        });


        Sno = $("#hiddenHospitalSno").val();

        CitySno = '<?php if (isset($HospitalData->CitySno))
        {
            echo $HospitalData->CitySno;
        }?>';

        if (Sno > 0)
        {
            LoadCountryStateTalukaDropdown(CitySno);

        }

        $("#ddlbCity").select2();
        $("#ddlbCountry").select2();
        $("#ddlbState").select2();
        $("#ddlbTaluka").select2();

        /* @use : Submit state form data*/
        $("#btnSubmitHospital").on("click", function (e)
        {
            e.preventDefault();


            var formid = $("form").attr('id');
            // Validate hospital form control
            if (ValidateHospital(formid) == true)
            {
                var formdata = $("form").serialize();
                var data = "action=submit&" + formdata;
                var ajaxsubmit = callajaxreturn("ctl_hospital.php", data, "", "POST", "", "", "");

                $("#ErrorDoctorDiv").html("");
                if (ajaxsubmit.trim() == "Hospital Data Submitted." || ajaxsubmit.trim() == "Hospital Data Updated.") {
                    // Reload data table
                    ReloadDataTable('datatablemasters');
                    //close div on success
                    closediv('divTargetHospital', 'divHospitalDataTableContainer', '', 'btnAddHospital');
                    showNotificationMsg(ajaxsubmit,true,'success');
                }
                else
                {
                    showNotificationMsg(ajaxsubmit,true,'error');
                    $("#ErrorHospitalDiv").html("<b>" + ajaxsubmit + "</b>");
                    return false;
                }

            }
            else
            {
                return false;
            }
        });
    });

    function LoadCountryStateTalukaDropdown(CitySno)
    {
        var url = "ctl_hospital.php";
        var talukadata = "action=loadtalukadrodpdown&citysno=" + CitySno;
        FillDependentDropdown(url,talukadata, "ddlbTaluka", 0,'',false);

        var statedata = "action=loadStateDrodpdown&citysno=" + CitySno;
        FillDependentDropdown(url,statedata, "ddlbState", 0,'',false);

        var countrydata = "action=loadcountrydrodpdown&citysno=" + CitySno;
        FillDependentDropdown(url,countrydata, "ddlbCountry", 0,'',false);
    }

</script>