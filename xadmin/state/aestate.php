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
    $StateSno = 0;
}
else
{
    $StateSno = $StateData->StateSno;
}

?>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?=ucfirst($RequestHandlerAction)?> State</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li class="pull-right">
                         <a class="collapse-link">
                             <i class="fa fa-close" onclick="closediv('divTargetState','divstatedatatablecontainer','','btnAddState');" title="Close"></i>
                         </a>
                    </li>
                 </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <form id="formSubmitState"  class="form-horizontal form-label-left">
                    <input type="hidden" name="hiddenStateSno" id="hiddenStateSno" class="hiddenStateSno" value="<?=$StateSno?>">
                  <div class="row">
                      <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12"></div>
                      <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12">
                            <div class="ErrorStateDiv pull-right height15 errorClass" id="ErrorStateDiv"></div>
                      </div>
                  </div>
                  <div class="row m-t-10">
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="txtStateCode">State Code : <span class="required">*</span>
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input type="text" name="txtStateCode" id="txtStateCode" required="required" class="form-control col-md-4 col-xs-12 txtStateCode" value="<?php if(isset($StateData->StateCode)) { echo $StateData->StateCode; }  ?>" maxlength="20" placeholder="Enter state code">
                            </div>
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="txtStateName">State Name : <span class="required">*</span>
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input type="text" name="txtStateName" id="txtStateName" required="required" class="form-control col-md-4 col-xs-12 txtStateName" value="<?php if(isset($StateData->StateName)) { echo $StateData->StateName; }  ?>" maxlength="255" placeholder="Enter state name">
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
                                <select name="ddlbCountry" id="ddlbCountry" class="ddlbCountry" style="min-width:100%;">

                                     <?php
                                        if(!empty($GetCountryName))
                                        {
                                           echo $SelectOption = "<option value='0'>SELECT</option>";

                                            foreach ($GetCountryName As $key)
                                            {

                                                $Selected = "";
                                                if ($key['CountrySno'] == $StateData->CountrySno)
                                                {
                                                    $Selected = "selected";
                                                }
                                     ?>
                                                <option value="<?= $key['CountrySno'] ?>" <?php echo $Selected; ?>>
                                                    <?= $key['CountryName'] ?>
                                                </option>
                                    <?php
                                            }
                                        }
                                     ?>
                                </select>
                            </div>

                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="txaDescription">Description : <span></span>
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <textarea name="txaDescription" id="txaDescription" class="form-control" rows="3" maxlength="500"><?php if(isset($StateData->Description)){ echo $StateData->Description;  } ?></textarea>
                           </div>

                       </div>
                    </div>
                  </div>

                    <!--<div class="ln_solid"></div>-->
                 <div class="row">
                        <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12"></div>
                         <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12">
                             <div class="pull-right m-r-5">
                                <button type="button" class="btn btn-success btnSubmitState" id="btnSubmitState">Submit</button>
                                 <button type="button" class="btn btn-primary" onclick="closediv('divTargetState','divstatedatatablecontainer','','btnAddState');">Cancel</button>
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

    $("#ddlbCountry").select2();
    /* @use : Submit state form data*/
      $("#btnSubmitState").on("click",function(e)
      {
            e.preventDefault();

            var formid = $("form").attr('id');
            // Validate state form control
            if(ValidateState(formid) == true)
            {
                var formdata = $("form").serialize();
                var data = "action=submit&"+formdata;
                var ajaxsubmit = callajaxreturn("ctl_state.php",data,"","POST","","","");

                $("#ErrorStateDiv").html("");
                if(ajaxsubmit.trim() == "State Data Submitted." || ajaxsubmit.trim() == "State Data Updated.")
                {
                    // Reload data table
                    ReloadDataTable('datatablemasters');
                    //close div on success
                    closediv('divTargetState','divstatedatatablecontainer','','btnAddState');
                    showNotificationMsg(ajaxsubmit,true,'success');
                }
                else
                {
                    showNotificationMsg(ajaxsubmit,true,'error');
                    $("#ErrorStateDiv").html("<b>" + ajaxsubmit + "</b>");
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