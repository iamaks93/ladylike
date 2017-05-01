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
    $TalukaSno = 0;

}
else
{
    $TalukaSno = $TalukaData->TalukaSno;
}

?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?=ucfirst($RequestHandlerAction)?> Taluka</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li class="pull-right">
                         <a class="collapse-link">
                             <i class="fa fa-close" onclick="closediv('divTargetTaluka','divtalukadatatablecontainer','','btnAddTaluka');"></i>
                         </a>
                    </li>
                 </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <form id="formSubmitTaluka"  class="form-horizontal form-label-left">
                    <input type="hidden" name="hiddenTalukaSno" id="hiddenTalukaSno" class="hiddenTalukaSno" value="<?=$TalukaSno?>">
                  <div class="row">
                      <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12"></div>
                      <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12">
                            <div class="ErrorTalukaDiv pull-right height15 errorClass" id="ErrorTalukaDiv"></div>
                      </div>
                  </div>
                  <div class="row m-t-10">
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="txtTalukaCode">Taluka Code : <span class="required">*</span>
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input type="text" name="txtTalukaCode" id="txtTalukaCode" required="required" class="form-control col-md-4 col-xs-12 txtTalukaCode" value="<?php if(isset($TalukaData->TalukaCode)) { echo $TalukaData->TalukaCode; }  ?>" maxlength="20" placeholder="Enter taluka code" tabindex="1">
                            </div>
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="txtTalukaName">Taluka Name : <span class="required">*</span>
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input type="text" name="txtTalukaName" id="txtTalukaName" required="required" class="form-control col-md-4 col-xs-12 txtTalukaName" value="<?php if(isset($TalukaData->TalukaName)) { echo $TalukaData->TalukaName; }  ?>" maxlength="255" placeholder="Enter taluka name" tabindex="2">
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
                                            if($key['CountrySno'] == $TalukaData->CountrySno)
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
                                <select name="ddlbState" id="ddlbState" class="ddlbState" style="min-width:100%;" tabindex="4">

                                </select>
                            </div>
                        </div>
                    </div>
                  </div> <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                        <div class="form-group">

                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="txaDescription">Description : <span></span>
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <textarea name="txaDescription" id="txaDescription" class="form-control" rows="3" maxlength="500" tabindex="6"><?php if(isset($TalukaData->Description)){ echo $TalukaData->Description;  } ?></textarea>
                           </div>

                       </div>
                    </div>
                  </div>

                    <!--<div class="ln_solid"></div>-->
                 <div class="row">
                        <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12"></div>
                         <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12">
                             <div class="pull-right m-r-5">
                                <button type="button" class="btn btn-success btnSubmitTaluka" id="btnSubmitTaluka">Submit</button>
                                 <button type="button" class="btn btn-primary" onclick="closediv('divTargetTaluka','divtalukadatatablecontainer','','btnAddTaluka');">Cancel</button>
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

    Sno = $("#hiddenTalukaSno").val();
    StateSno = '<?php if(!empty($TalukaData->StateSno)){ echo $TalukaData->StateSno;  }?>';
    if(Sno > 0)
    {
        var CountrySno = '<?php if(isset($TalukaData->CountrySno)){ echo $TalukaData->CountrySno;  }?>';
        LoadStateDropdown(CountrySno);
    }

    //return false;
    $("#ddlbCountry").select2();
    $("#ddlbState").select2();
    /* @use : Submit taluka form data*/
      $("#btnSubmitTaluka").on("click",function(e)
      {
            e.preventDefault();
            var formid = $("form").attr('id');
            // Validate taluka form control
            if(ValidateTaluka(formid) == true)
            {
                var formdata = $("form").serialize();
                var data = "action=submit&"+formdata;
                var ajaxsubmit = callajaxreturn("ctl_taluka.php",data,"","POST","","","");

                $("#ErrorTalukaDiv").html("");
                if(ajaxsubmit.trim() == "Taluka Data Submitted." || ajaxsubmit.trim() == "Taluka Data Updated.")
                {
                    // Reload data table
                    ReloadDataTable('datatablemasters');
                    //close div on success
                    closediv('divTargetTaluka','divtalukadatatablecontainer','','btnAddTaluka');
                    showNotificationMsg(ajaxsubmit,true,'success');
                }
                else
                {
                    showNotificationMsg(ajaxsubmit,true,'error');
                    $("#ErrorTalukaDiv").html("<b>" + ajaxsubmit + "</b>");
                    return false;
                }

            }
            else
            {
                return false;
            }
      });
   });

function LoadStateDropdown(CountrySno)
{
    var url = "ctl_taluka.php";
    var data = "action=loadStateDrodpdown&countrysno="+CountrySno;
    FillDependentDropdown(url,data,"ddlbState",Sno,StateSno,true);
}
</script>