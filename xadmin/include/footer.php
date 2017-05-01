<!-- footer content -->
<footer class="footer_fixed">
    <div class="pull-right">
        Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
    </div>
    <div class="clearfix"></div>
</footer>
<!-- /footer content -->
<?php
include 'requiredscripts.php';
?>
<script>
$(function() {

     //clearInterval(checkloginSession);
//     var SessionChecking = function()
//     {
//         //make ajax call
//         var call = $.get("../logout.php?action=checkuserinactivity");
//         call.done(function(data)
//         {
//           var json = JSON.parse(data);
//
//           if(json['loggedIn'] == false) // if session is timeout
//           {
//              //Redirect to index.php
//              window.location.href = "../index.php";
//           }
//           else
//           {
//               return false;
//           }
//         });
//     }
//
//    //Calling function in interval
//   var checkloginSession = setInterval(SessionChecking,900000); // 15 Minute
    //var checkloginSession = setInterval(SessionChecking,60000); // 1 Minute

});
</script>
