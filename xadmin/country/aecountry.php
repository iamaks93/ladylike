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
    $countrySno = 0;
}
else
{
    $countrySno = $CountryData->CountrySno;
}

?>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?=ucfirst($RequestHandlerAction)?> Country</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li class="pull-right">
                         <a class="collapse-link">
                                <i class="fa fa-close" onclick="closediv('divTargetCountry','divdatatablecontainer','','btnAddCountry');" title="Close"></i>
                         </a>
                    </li>
                 </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <form id="formSubmitCountry"  class="form-horizontal form-label-left">
                    <input type="hidden" name="hiddenCountrySno" id="hiddenCountrySno" class="hiddenCountrySno" value="<?=$countrySno?>">
                  <div class="row">
                      <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12"></div>
                      <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12">
                            <div class="ErrorCountryDiv pull-right height15 errorClass" id="ErrorCountryDiv"></div>
                      </div>
                  </div>
                  <div class="row m-t-10">
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="txtCountryCode">Country Code : <span class="required">*</span>
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input type="text" name="txtCountryCode" id="txtCountryCode" required="required" class="form-control col-md-4 col-xs-12 txtCountryCode" value="<?php if(isset($CountryData->CountyCode)) { echo $CountryData->CountyCode; }  ?>" maxlength="20" placeholder="Enter country code">
                            </div>
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="txtCountryName">Country Name : <span class="required">*</span>
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input type="text" name="txtCountryName" id="txtCountryName" required="required" class="form-control col-md-4 col-xs-12 txtCountryName" value="<?php if(isset($CountryData->CountryName)) { echo $CountryData->CountryName; }  ?>" maxlength="255" placeholder="Enter country name">
                            </div>
                       </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                             <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="txaDescription">Description : <span></span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">

                            <textarea name="txaDescription" id="txaDescription" required="required" class="form-control col-md-4 col-xs-12 txaDescription" cols="8" maxlength="500"><?php if(isset($CountryData->Description)) { echo $CountryData->Description;  } ?></textarea>
                        </div>

                    </div>
                    </div>
                  </div>

                    <!--<div class="ln_solid"></div>-->
                 <div class="row">
                    <div class="form-group">
                        <div class="col-md-6 col-col-sm-6 col-lg-6 col-xs-12"></div>
                         <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12">
                             <div class="pull-right">
                                <button type="button" class="btn btn-success btnSubmitCountry" id="btnSubmitCountry">Submit</button>
                                 <button type="button" class="btn btn-primary" onclick="closediv('divTargetCountry','divdatatablecontainer','','btnAddCountry');">Cancel</button>
                           </div>
                        </div>
                    </div>
                 </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
$("document").ready(function(){

    /* @use : Submit country form data
    * */
      $("#btnSubmitCountry").on("click",function(e)
      {
            e.preventDefault();


            var formid = $("form").attr('id');
            // Validate country form control
            if(ValidateCountry(formid) == true)
            {
                $("#" + formid + " #ErrorCountryDiv").html("");
                //Formdata
                var data = new FormData($('#' + formid)[0]);
                var ajaxsubmit = callajaxreturn("ctl_country.php?action=submit",data,"", "POST", "", "", "");
                if(ajaxsubmit.trim() == "Country Data Submitted." || ajaxsubmit.trim() == "Country Data Updated.")
                {
                    // Reload data table
                    ReloadDataTable('datatablemasters');
                    //close div on success
                    closediv('divTargetCountry','divdatatablecontainer','','btnAddCountry');
                    showNotificationMsg(ajaxsubmit,true,'success');
                }
                else
                {
                    showNotificationMsg(ajaxsubmit,true,'error');
                    $("#ErrorCountryDiv").html("<b>" + ajaxsubmit + "</b>");
                    return false;
                }
            }
            else
            {
                return false;
            }
      });
   });

</script>