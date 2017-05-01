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
 * Date: 2/12/2017
 * Time: 12:02 PM
 */
if($RequestHandlerAction == "add")
{
    $CitySno = 0;

}
else
{
    $CitySno = $CityData->CitySno;
}

?>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?=ucfirst($RequestHandlerAction)?> City</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li class="pull-right">
                         <a class="collapse-link">
                             <i class="fa fa-close" onclick="closediv('divTargetCity','divcitydatatablecontainer','','btnAddCity');" title="Close"></i>
                         </a>
                    </li>
                 </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <form id="formSubmitCity"  class="form-horizontal form-label-left formSubmitCity"  action="ctl_city.php?action=submit" method="post">
                    <input type="hidden" name="hiddenCitySno" id="hiddenCitySno" class="hiddenCitySno" value="<?=$CitySno?>">
                  <div class="row">
                      <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12"></div>
                      <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12">
                            <div class="ErrorCityDiv pull-right height15 errorClass" id="ErrorCityDiv"></div>
                      </div>
                  </div>
                  <div class="row m-t-10">
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="txtCityCode">City Code : <span class="required">*</span>
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input type="text" name="txtCityCode" id="txtCityCode" required="required" class="form-control col-md-4 col-xs-12 txtCityCode" value="<?php if(isset($CityData->CityCode)) { echo $CityData->CityCode; }  ?>" maxlength="20" placeholder="Enter city code" tabindex="1">
                            </div>
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="txtCityName">City Name : <span class="required">*</span>
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input type="text" name="txtCityName" id="txtCityName" required="required" class="form-control col-md-4 col-xs-12 txtCityName" value="<?php if(isset($CityData->CityName)) { echo $CityData->CityName; }  ?>" maxlength="255" placeholder="Enter city name" tabindex="2">
                            </div>
                       </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                        <div class="form-group">

                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="ddlbCountry">Country Name : <span class="required">*</span>
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <select name="ddlbCountry" id="ddlbCountry" class="ddlbCountry" style="min-width:100%;" onchange="LoadStateDropdown(this.value);" tabindex="3">
                                    <option value="0">SELECT</option>
                                     <?php

                                        foreach ($GetCountryName As $key)
                                        {

                                            $Selected = "";
                                            if($key['CountrySno'] == $CityData->CountrySno)
                                            {
                                                $Selected = "selected";
                                            }

                                     ?>
                                            <option value="<?=$key['CountrySno']?>" <?php echo $Selected;?>>
                                                    <?=$key['CountryName']?>
                                            </option>
                                     <?php
                                        }
                                     ?>
                                </select>
                            </div>
 <label class="control-label col-md-2 col-sm-2 col-xs-12" for="ddlbState">State Name : <span class="required">*</span>
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <select name="ddlbState" id="ddlbState" class="ddlbState" style="min-width:100%;" onchange="LoadTalukaDropdown(this.value);"  tabindex="4">

                                </select>
                            </div>
                        </div>
                    </div>
                  </div> <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                        <div class="form-group">

                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="ddlbTaluka">Taluka : <span class="required"></span>
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <select name="ddlbTaluka" id="ddlbTaluka" class="ddlbTaluka" style="min-width:100%;" tabindex="5">
                                </select>
                            </div>

                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="txaDescription">Description : <span></span>
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <textarea name="txaDescription" id="txaDescription" class="form-control" rows="3" maxlength="500" tabindex="6"><?php if(isset($CityData->Description)){ echo $CityData->Description;  } ?></textarea>
                           </div>

                       </div>
                    </div>
                  </div>

                    <!--<div class="ln_solid"></div>-->
                 <div class="row">
                        <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12"></div>
                         <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12">
                             <div class="pull-right m-r-5">
                                <button type="submit" class="btn btn-success btnSubmitCity" id="btnSubmitCity">Submit</button>
                                 <button type="button" class="btn btn-primary" onclick="closediv('divTargetCity','divcitydatatablecontainer','','btnAddCity');">Cancel</button>
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
$("document").ready(function(){

    $("#ddlbCountry").select2();
    $("#ddlbState").select2();
    $("#ddlbTaluka").select2();

    Sno = $("#hiddenCitySno").val();
    StateSno = '<?php if(!empty($CityData->StateSno)){ echo $CityData->StateSno;  }?>';
    TalukaSno = '<?php if(!empty($CityData->TalukaSno)){ echo $CityData->TalukaSno;  }?>';
    if(Sno > 0)
    {
        var CountrySno = '<?php if(isset($CityData->CountrySno)){ echo $CityData->CountrySno;  }?>';
        // Fill dropdown in edit mode
        LoadStateDropdown(CountrySno);
        LoadTalukaDropdown(TalukaSno);
    }

    //return false;


   });
/* @use : Submit state form data*/
$("#formSubmitCity").on("submit", function (e)
    {
        e.preventDefault();

        var formdata = new FormData(this);

        // Validate state form control
         var formid = $("#formSubmitCity");
        if(ValidateCity(formid) == true)
        {
            var ajaxsubmit = callajaxreturn("ctl_city.php?action=submit", formdata, "", "POST", "", "", "");

            $("#ErrorCityDiv").html("");
            if(ajaxsubmit.trim() == "City Data Submitted." || ajaxsubmit.trim() == "City Data Updated.")
            {
                // Reload data table
                ReloadDataTable('datatablemasters');
                //close div on success
                closediv('divTargetCity','divcitydatatablecontainer','','btnAddCity');
                showNotificationMsg(ajaxsubmit,true,'success');
            }
            else
            {
                showNotificationMsg(ajaxsubmit,true,'error');
                $("#ErrorCityDiv").html("<b>" + ajaxsubmit + "</b>");
                return false;
            }

        }
        else
        {
            return false;
        }
    });

function LoadStateDropdown(CountrySno)
{
    var url = "ctl_city.php";
    var data = "action=loadStateDrodpdown&countrysno="+CountrySno;
    FillDependentDropdown(url,data,"ddlbState",Sno,StateSno,true);
}
function LoadTalukaDropdown(StateSno)
{
    var url = "ctl_city.php";
    var data = "action=loadtalukadrodpdown&statesno="+StateSno;
    FillDependentDropdown(url,data,"ddlbTaluka",Sno,StateSno,true);
}

</script>