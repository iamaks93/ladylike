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
 * Date: 11/03/2017
 * Time: 10:37 PM
 */
if($RequestHandlerAction == "add")
{
    $specialitySno = 0;
}
else
{
    $specialitySno = $SpecialityData->SpecialitySno;
}
?>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?=ucfirst($RequestHandlerAction)?> Speciality</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li class="pull-right">
                         <a class="collapse-link">
                                <i class="fa fa-close" onclick="closediv('divTargetSpeciality','divdatatablecontainer','','btnAddSpeciality');" title="Close"></i>
                         </a>
                    </li>
                 </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form id="formSubmitSpeciality"  class="form-horizontal form-label-left">
                    <input type="hidden" name="hiddenSpecialitySno" id="hiddenSpecialitySno" class="hiddenSpecialitySno" value="<?=$specialitySno?>">
                  <div class="row">
                      <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12"></div>
                      <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12">
                            <div class="ErrorSpecialityDiv pull-right height15 errorClass" id="ErrorSpecialityDiv"></div>
                      </div>
                  </div>
                  <div class="row m-t-10">
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="txtSpecialityCode">Speciality Code : <span class="required">*</span>
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input type="text" name="txtSpecialityCode" id="txtSpecialityCode" required="required" class="form-control col-md-4 col-xs-12 txtSpecialityCode" value="<?php if(isset($SpecialityData->SpecialityCode)) { echo $SpecialityData->SpecialityCode; }  ?>" maxlength="20" placeholder="Enter speciality code">
                            </div>
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="txtSpecialityName">Speciality Name : <span class="required">*</span>
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input type="text" name="txtSpecialityName" id="txtSpecialityName" required="required" class="form-control col-md-4 col-xs-12 txtSpecialityName" value="<?php if(isset($SpecialityData->SpecialityName)) { echo $SpecialityData->SpecialityName; }  ?>" maxlength="255" placeholder="Enter speciality name">
                            </div>
                       </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                             <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12 p-t-0" for="txaDescription">Description :
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">

                            <textarea name="txaDescription" id="txaDescription" required="required" class="form-control col-md-4 col-xs-12 txaDescription" cols="8" maxlength="500"><?php if(isset($SpecialityData->Description)) { echo $SpecialityData->Description;  } ?></textarea>
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
                                <button type="button" class="btn btn-success btnSubmitSpeciality" id="btnSubmitSpeciality">Submit</button>
                                 <button type="button" class="btn btn-primary" onclick="closediv('divTargetSpeciality','divdatatablecontainer','','btnAddSpeciality');">Cancel</button>
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

    /* @use : Submit Speciality form data
    * */
      $("#btnSubmitSpeciality").on("click",function(e)
      {
            e.preventDefault();
            
            var formid = $("form").attr('id');
            // Validate Speciality form control
            if(ValidateSpeciality(formid) == true)
            {
                var formdata = $("form").serialize();
                //alert(formdata);
                //return false;
                var data = "action=submit&"+formdata;
                var ajaxsubmit = callajaxreturn("ctl_speciality.php",data,"","POST","","","");
                    $("#ErrorSpecialityDiv").html("");
                    if(ajaxsubmit.trim() == "Speciality Data Submitted." || ajaxsubmit.trim() == "Speciality Data Updated.")
                    {
                        // Reload data table
                        ReloadDataTable('datatablemasters');
                        //close div on success
                        closediv('divTargetSpeciality','divdatatablecontainer','','btnAddSpeciality');
                        showNotificationMsg(ajaxsubmit,true,'success');
                    }
                    else
                    {
                        showNotificationMsg(ajaxsubmit,true,'error');
                        $("#ErrorSpecialityDiv").html("<b>" + ajaxsubmit + "</b>");
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