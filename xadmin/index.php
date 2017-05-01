<?php
include "../constants.php";
require_once '../core/session.php';

$ObjSession = Session::getInstance();
if(!empty($ObjSession->UserName))
{
    header("Location:dashboard/ctl_dashboard.php?action=view");
    die();
}
//include_once '';
/**
 * Created by PhpStorm.
 * User: Maa
 * Date: 1/8/2017
 * Time: 1:26 PM
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LadyLike Login</title>
    <!-- Bootstrap -->
    <link href="<?=ASSESTS?>/xadmin/js/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- PNotify -->
    <link href="<?=ASSESTS?>/xadmin/js/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="<?=ASSESTS?>/xadmin/js/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="<?=ASSESTS?>/xadmin/js/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">

    <!--Custom Login Css-->
    <link href="<?=ASSESTS?>/xadmin/css/login.css" rel="stylesheet">

    <!--Custom Login Css-->
    <link href="<?=ASSESTS?>/commoncss/commonclasses.css" rel="stylesheet">
    <link href="<?=ASSESTS?>/commoncss/animations.css" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Pacifico:400,700' rel='stylesheet' type='text/css'>

</head>
<body>
<img src="<?=ASSESTS?>/images/loginpagebackground/lightning_monochrome-wallpaper-1366x768.jpg" height="100%" width="100%" style="position: absolute;">
<div class="container ">
     <div class="row pullDown">
         <div id="add_err" class="add_err"></div>
        <div class="col-md-4 col-sm-2"></div>
        <div class="col-md-4 col-sm-8 col-xs-12">
            <div class="logo" style="font-weight:700;font-size:30px;font-family: Pacifico !important;">Lady Like HealthCare</div>
             <div class="login-block">
              <!--<form name="frmlogin" id="frmlogin" class="frmlogin" action="" method="post">-->
                    <h1>Login</h1>
                 <form name="formlogin" id="formlogin" class="formlogin" action="" method="post">
                    <input type="email" value="" placeholder="EmailId" id="txtEmailId" name="txtEmailId" required/>
                    <input type="password" value="" placeholder="Password" id="txtpassword" name="txtpassword" required/>
                    <button id="btnLogin" class="btnLogin">Login</button>
                    <img src="../assests/images/ajaxloader/ajax-loader-2.gif" id="ajaxloader" alt="ajaxloader" class="m-t-25 hide" style="position:absolute;margin-left: -25px;">
                 </form>
             <!-- </form>-->
            </div>
        </div>
        <div class="col-md-4 col-sm-2"></div>
     </div>
    <!-- footer content -->
    <footer>
        <div class="container">
            <div align="center" class="text-white">
                Copyright © <?php echo date('Y');?> Lady Like Healthcare.
            </div>
            <div class="clearfix"></div>
        </div>
    </footer>
    <!-- /footer content -->
</div>
<script src="<?=ASSESTS?>/xadmin/js/jquery/dist/jquery.js" type="text/javascript"></script>
<script src="<?=ASSESTS?>/xadmin/js/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script>

<!-- PNotify -->
<script src="<?=ASSESTS?>/xadmin/js/pnotify/dist/pnotify.js"></script>
<script src="<?=ASSESTS?>/xadmin/js/pnotify/dist/pnotify.buttons.js"></script>
<script src="<?=ASSESTS?>/xadmin/js/pnotify/dist/pnotify.nonblock.js"></script>


<script type="text/javascript" src="<?=JS?>/commonvalidation.js"></script>
<script type="text/javascript" src="<?=JS?>/commonfunction.js"></script>


<script>
  $("#document").ready(function()
  {
      //$("#ajaxloader").show();
      $('#formlogin')[0].reset();  //Clear form data when page reload
  /*    window.onbeforeunload = function() {
          return "Bye now!";
      };
*/
  });




  $("#formlogin").unbind().submit(function (e)
  {

      e.preventDefault();

      var emailid = $("#txtEmailId").val();
      var pass = $("#txtpassword").val();

      if (emailid == "")
      {
          showErrorMessage('Enter email',true);
          return false;
      }
      if (pass == "")
      {
          showErrorMessage('Enter password',true);
          return false;
      }

      $(e).prop("disabled",true);
      $("#btnLogin").html('Connecting...');
      var ajaxval = callajaxreturn("login.php","action=checklogin"+"&email="+emailid+"&password="+pass,'','',false);
      switch(ajaxval)
      {

          case "unvarified":
          {
              $(e).prop("disabled",true);
              $("#btnLogin").html('Login');
              showErrorMessage("Email Or Password wrong",true);
              break;
          }
          case "varified":
          {
              window.location.href = 'dashboard/ctl_dashboard.php?action=view';
              break;
          }
      }

  });

</script>
</body>
</html>
