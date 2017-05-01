<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Country | Lady like</title>

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
                            <span class="breadcrumb-item active">Country</span>
                        </nav>
                    </div>
                    <div class="col-md-3 col-xs-12 col-lg-3">
                        <button class="btn btn-block btn-info waves-effect pull-right btnAddCountry m-r-0" type="button"
                                id="btnAddCountry">
                            <i class="fa fa-plus"></i> Add Country
                        </button>
                    </div>
                </div>

            </div>
            <div class="clearfix"></div>

            <!--Start Target Div-->
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                    <div class="divTargetCountry" id="divTargetCountry">
                    </div>
                </div>
            </div>
            <!--End Target Div-->
            <div class="row divdatatablecontainer" id="divdatatablecontainer">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Country Detail</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            <table id="datatablemasters" class="table table-striped table-bordered hover order-column"
                                   width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Country Sno</th>
                                    <th>Country Code</th>
                                    <th>Country Name</th>
                                    <th>Description</th>
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
            "sAjaxSource": "ctl_country.php?action=getdatatable",
            dom: 'Bfrtip'
            , buttons: [
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
                {width: 20, targets: 4},
                { targets: 4, orderable: false }
            ]

        });

        $('#datatablemasters tbody').on('click', 'td', function ()
        {
            var table = $(this).closest('table').DataTable();
            var data = table.row(this).data();
            var countrysno = data[0]; // Get the Sno
            var columnindex = $(this).index(); // Get index in which click occur

            // IF click occur on Action column then stop it
            if (columnindex == 3)
            { // provide index of your column in which you prevent row click here is column of 4 index
                return false;
            }
            else
            {
                var actionrequest = "edit&countrysno=" + countrysno;
                GetSetContent("ctl_country.php", actionrequest, "divdatatablecontainer", "divTargetCountry", "btnAddCountry");
            }
        });

         $('#datatablemasters tbody').on('mouseenter', 'td', function ()
         {
            var checkdatatablecontent = $(this).text().trim();
            if(checkdatatablecontent != "No data available in table")
            {
                var table = $(this).closest('table').DataTable();
                var colIdx = table.cell(this).index().column;
                $(table.cells().nodes()).removeClass('highlight');
                $(table.column(colIdx).nodes()).addClass('highlight');
            }

         });
     });


    $("#btnAddCountry").on("click", function () {
        //Call Function to show add mode of city
        GetSetContent("ctl_country.php", "add", "divdatatablecontainer", "divTargetCountry", "btnAddCountry");
    });

    function EditCountry(citysno)
    {
        //Call Function to show add mode of city
        var actionrequest = "edit&countrysno=" + citysno;
        GetSetContent("ctl_country.php", actionrequest, "divdatatablecontainer", "divTargetCountry", "btnAddCountry");
    }
    function DeleteCountryData(citysno)
    {
        swal({
                title: "Are you sure?",
                text: "You will not be able to get this record back!",
                type: "warning",
                customClass: 'sweet-alert-small',
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel please!",
                closeOnConfirm: false,
                closeOnCancel: true
            },
            function()
            {
                var data = "action=deletecountryrecord&countrysno="+citysno;
                var ajaxdelete = callajaxreturn("ctl_country.php",data,"","POST","","","");
                if (ajaxdelete == "Deleted")
                {
                    CallDataTable('datatablemasters');
                    swal("Deleted!","Record Deleted.","success");
                }
                else
                {
                    swal("Failed", ""+ajaxdelete+"", "error");
                }
            });
    }
    function isConfirm()
    {
      alert("dfg");
    }
</script>
<!-- /Datatables -->
</body>
</html>
<Style>

</Style>