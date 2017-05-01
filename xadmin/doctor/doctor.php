<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Doctor | Lady like</title>

</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <?php
        include "../include/layout.php";
        ?>

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="row">
                <div class="col-md-12 col-xs-12 col-lg-12 no-padding">
                    <div class="col-md-9 col-xs-12 col-lg-9 no-padding">
                        <nav class="breadcrumb">
                            <a class="breadcrumb-item" href="#">Home</a>
                            <a class="breadcrumb-item" href="#">Master</a>
                            <span class="breadcrumb-item active">Doctor</span>
                        </nav>
                    </div>
                    <div class="col-md-3 col-xs-12 col-lg-3">
                        <button class="btn btn-block btn-info waves-effect pull-right btnAddDoctor m-r-0" type="button"
                                id="btnAddDoctor">
                            <i class="fa fa-plus"></i> Add Doctor
                        </button>
                    </div>
                </div>

            </div>
            <div class="clearfix"></div>

            <!--Start Target Div-->
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                    <div class="divTargetDoctor" id="divTargetDoctor">
                    </div>
                </div>
            </div>
            <!--End Target Div-->
            <div class="row divDoctorDataTableContainer" id="divDoctorDataTableContainer">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Doctor List</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            <table id="datatablemasters" class="table table-bordered hover order-column"
                                   width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Doctor Sno</th>
                                    <th>Avtar</th>
                                    <th>Doctor Name</th>
                                    <th>Resident City</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                 </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->

        <?php
        include "../include/footer.php";
        ?>
    </div>
</div>
<!-- Datatables -->
<script type="text/javascript">
    var table;
     $(document).ready(function () {

         table = $('#datatablemasters').dataTable({
            "bProcessing": true,
            "sAjaxSource": "ctl_doctor.php?action=getdatatable", // call function to get json format data
            dom: 'Bfrtip'
            , buttons: [ // for export bbutton
                'csv', 'excel', 'pdf'
            ],
            responsive: true,
            "columnDefs": [
                {
                    // Hide first column
                    "targets": [0],
                    "visible": false,
                    "searchable": false
                },
                {width: "6%", targets: 1},
                {width: "30%", targets: 2},
                {width: "22%", targets: 3},
                {width: "15%", targets: 4},
                {width: "22%", targets: 5},
                {width: "5%", targets: 6},
                { targets: 1, orderable: false },
                { targets: 6, orderable: false }
            ],
             "language": { // Display message when no data found for city module
                 "emptyTable":"No data available."
             }

        });

         // Open edit mode by clicking data table column
        $('#datatablemasters tbody').on('click', 'td', function ()
        {
           var table = $(this).closest('table').DataTable();
           var data = table.row(this).data();

           // If there are no data in data table
           if(data == "" || data == 'undefined' || data == undefined)
           {
               return false;
           }
           else
           {
               var doctorsno = data[0]; // Get the Sno
               var columnindex = $(this).index(); // Get index in which click occur

               // IF click occur on Action column then stop it
               if (columnindex == 5)
               { // provide index of your column in which you prevent row click here is column of 4 index
                   return false;
               }
               else
               {
                   var actionrequest = "edit&doctorsno=" + doctorsno;
                   GetSetContent("ctl_doctor.php", actionrequest, "divDoctorDataTableContainer", "divTargetDoctor", "btnAddDoctor");
               }
           }

        });

        // Show focus on data table
         /*$('#datatablemasters tbody').on('mouseenter', 'td', function ()
         {
            var checkdatatablecontent = $(this).text().trim();
            if(checkdatatablecontent != "No data available.")
            {
                var table = $(this).closest('table').DataTable();
                var colIdx = table.cell(this).index().column;
                $(table.cells().nodes()).removeClass('highlight');
                $(table.column(colIdx).nodes()).addClass('highlight');
            }

         });*/
     });



    /* @use : Add mode of city*/
    $("#btnAddDoctor").on("click", function () {
        //Call Function to show add mode of city

        /* @use : for show add mode of city
        *  @param : 1) ctl_doctor.php : page name
        *  @param : 2) add : Mode
        *  @param : 3) divDoctorDataTableContainer : Hide div ,during add mode
        *  @param : 4) divTargetDoctor : Target div,where add mode will disapay
        *  @param : 5) btnAddDoctor : Button need to disable
        * */
        GetSetContent("ctl_doctor.php", "add", "divDoctorDataTableContainer", "divTargetDoctor", "btnAddDoctor");
    });

</script>
<!-- /Datatables -->
</body>
</html>
<Style>

</Style>