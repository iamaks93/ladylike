/**
 * Created by Maa on 1/10/2017.
 */

var GlobalPreUrl = "localhost/ladylike/xadmin";
// ScrollTop
$("html, body").animate({ scrollTop: 0 }, "slow");

//callajaxreturn(url,data,hdnfunc,datatype,type,asynctype,args)

//callajaxreturn(GlobalPreURLFrontEnd + "candidate/" + "editresume/" + "getstatename/" + cityname, "", "loadStateAndCountryForPerAddressEditResumeOnSuccess", "json");

///contentType (default: 'application/x-www-form-urlencoded; charset=UTF-8')

/* Function : callajax
*      Parameters :
*                  1)url : url
*                  2)data : data
*                  3)datatype : (default: Intelligent Guess (xml, json, script, or html))
*                  4)method : GET,POST or PUT
*                  5)asynctype : true or false (//Synchronous ( async: false ) – Script stops and waits for the server to send back a reply before continuing.)
*                  6)hdnfunction: hide the function
*                  7) args : arguments for the functions
*
*/

/*
if(asynctype == undefined || asynctype == '') asynctype=false;
if(datatype == undefined || datatype == '') datatype='html';
if(type == undefined || type == '') type='GET';
var anshtml = "false";
*/

/*$.post("example.php", {
    name: "anonymous",
    email: "x@gmail.com",
    perform: "register"
}, function(data, status) {
    alert(data);
});*/

function callajaxreturn(url,data,datatype,method,asynctype,hdnfunction,args)
{

      args=args||[];
      if(datatype == undefined || datatype == '') datatype = 'html';
      if(method == undefined || method == '') method = 'GET';
      if(asynctype != undefined || asynctype != '')
      {
          asynctype = asynctype;
      }
      else
      {
          asynctype = true;
      }



    var returnresponse = false;
    //$(".ajaxloader").show();

    $.ajax({
        url: url,
        method: method,
        data: data,
        dataType: datatype,
        async: asynctype,
        processData: false,
        contentType: false,
       // beforeSend: function(){ $("#btnLogin").html('Connecting...');},
        success: function(responce)
        {

            if(responce.trim() === "SRR403")
            {
                window.location.href = "../page_404.html";
            }
            else
            {
                returnresponse = responce;
            }

            //alert(responce);
           /* args[args.length] = responcedata;

            if(hdnfunction == '' || hdnfunction == undefined)
            {
                valreturn = callfunction(hdnfunction,args);
            }*/
        },
        statusCode: {
            404: function() {
                alert("page not found");
            }
        }
       /* beforeSend:function()
        {
            $("#add_err").css('display', 'inline', 'important');
            $("#add_err").html("<img src='../assests/images/ajaxloader/loading_phylo.gif'> Loading...")
        }*/
    });



   /* beforeSend:function()
    {
        $("#add_err").css('display', 'inline', 'important');
        $("#add_err").html("<img src='images/ajax-loader.gif' /> Loading...")
    }*/

    return returnresponse;
}
function callfunction(fn, args)
{
    fn = (typeof fn == "function") ? fn : window[fn];  // Allow fn to be a function object or the name of a global function
    return fn.apply(this, args||[]);  // args is optional, use an empty array by default
}

/* Used for : Get And Set Div Content (Add and edit page with ajax)
 Parameter:
 1) pagename : Page name (eg.city.php),
 2) actionrequest : Which action to be performed (eg.add,edit),
 3) showdiv : Show target div,
 3) hidediv : Hide target div,
 4) enabledisablebtn : Which button need to disbale or enable,
 */
function GetSetContent(pagename,actionrequest,hidediv,showdiv,enabledisablebtn)
{
    //$('.preloader_img').show();

     // Empty the div so it,left over div data is not seen in it
     $("#" + showdiv).empty();

    var call = $.get(""+pagename+"?action="+actionrequest+"");
    call.done(function(data)
    {
        // Call closediv function
        closediv(hidediv,showdiv,data,enabledisablebtn);
        //UpdateUserActivityTime();

        //$('.preloader img').hide();
    });
}
function UpdateUserActivityTime() {
    alert("in");
    return false;
}
/* Used for : Show and hide div
 Parameter:
 1) closediv : Which div need to close,
 2) showdiv : Which div need to show,
 3) resultdata : if u want to put result in target div,
 4) disablebutton : Which button need to disbale or enable,
 */
function closediv(closediv,showdiv,resultdata,enabledisablebutton)
{
    // Close div
    $("#"+closediv+"").animate({height: 'hide', opacity: 'hide' },300);

    // ScrollTop
    $("html, body").animate({ scrollTop: 0 }, "slow");

    //Show div
    $("#"+showdiv+"").animate({
        height: ['show', 'swing']
    },100,function(){

        //Use for add mode when target div is not assigned
        if(resultdata != "")
        {
            // Put resultdatat in target
            $("#"+showdiv+"").html(resultdata);
            //Disable add button
            $("#"+enabledisablebutton+"").prop("disabled",true);
        }
        else // Used when cancle button clicked to close the form
        {
            //Enable add button
            $("#"+enabledisablebutton+"").prop("disabled",false);
        }
    });
}
function showDarkMessage(Msg,IconTrueFalse)
{
    new PNotify({
        title: Msg,
        /*text: Msg,*/
        type: 'info',
        styling: 'bootstrap3',
        icon:IconTrueFalse,
        addclass: 'dark'
    });
}
/*********** Positioned Stack ***********
 * This stack is initially positioned through code instead of CSS.
 * This is done through two extra variables. firstpos1 and firstpos2
 * are pixel values, relative to a viewport edge. dir1 and dir2,
 * respectively, determine which edge. It is calculated as follows:
 *
 * - dir = "up" - firstpos is relative to the bottom of viewport.
 * - dir = "down" - firstpos is relative to the top of viewport.
 * - dir = "right" - firstpos is relative to the left of viewport.
 * - dir = "left" - firstpos is relative to the right of viewport.
 */
var stack_bottomright = {"dir1": "up", "dir2": "left", "firstpos1": 25, "firstpos2": 25};

function showNotificationMsg(Msg,IconTrueFalse,type)
{
    var animate_in = 'rotateInDownRight';
    var animate_out = 'rotateOutDownLeft';

    var opts = {
        title: "",
        text: "",
        styling: 'bootstrap3',
        icon:IconTrueFalse,
        addclass: "stack-bottomright",
        stack: stack_bottomright,
        nonblock: {
            nonblock: true,
            nonblock_opacity: .2
        },
        buttons: {
            show_on_nonblock: true
        },
        /*animate: {
            animate: true,
            in_class: 'rotateInDownRight',
            out_class: 'rotateOutDownLeft'
        }*/
    };


    switch (type)
    {
        case 'error':
            opts.title = "Error";
            opts.text = Msg;
            opts.type = "error";
            break;
        case 'info':
            opts.title = "Info";
            opts.text = Msg;
            opts.type = "info";
            break;
        case 'success':
            opts.title = "Success";
            opts.text = Msg;
            opts.type = "success";
            break;
    }
    new PNotify(opts);
}
function showNoticeMessage(Msg,IconTrueFalse)
{
   new PNotify({
       title: 'Notice',
       text: Msg,
       styling: 'bootstrap3',
       icon:IconTrueFalse
    });
}
// Show preloader function
$(window).on("load",function() {
    $('.preloader img').fadeOut();
    $('.preloader').fadeOut(1000);
});


function setdatatable(datatableid)
{
    table = $('#'+datatableid).DataTable({
        dom: 'Bfrtip'
        , buttons: [
            'csv', 'excel', 'pdf'
        ],
        responsive: true,
        "columnDefs": [
            {
                "targets": [0],
                "visible": false,
                "searchable": false
            }
            ]
        });
}

function ReloadDataTable(datatableid)
{
    var table = $('#'+datatableid).DataTable();
    table.ajax.reload();
}
function FillDependentDropdown(url,data,dropdownid,sno,selecteddropvaluesno,selectoption)
{
    $.ajax({
        url: url,
        type: "GET",
        data : data,
        dataType: "json",
        async: true,
        success: function(dropdownvalueresponce)
        {
           CallBackDropDown(dropdownvalueresponce,dropdownid,sno,selecteddropvaluesno,selectoption);
        },
        statusCode: {
            404: function()
            {
                alert("Fill DropDown Failed.And Dropdown id is" + dropdownid);
            }
        }
    });

}
function CallBackDropDown(dropdownvalueresponce,dropdownid,sno,selecteddropvaluesno,selectoption)
{

    $("#" + dropdownid).empty();
    //If response json array is blank then disable dropdown
    if(!dropdownvalueresponce.length)
    {
        $("#" + dropdownid).attr("disabled", true);
    }
    else
    {
        $("#" + dropdownid).attr("disabled", false);

        if(selectoption === true)
        {
            $("#" + dropdownid).append('<option value="0">SELECT</option>');

        }

        $.each(dropdownvalueresponce, function (key, value)
        {
            $("#" + dropdownid).append('<option value=' + value.id + '>' + value.text + '</option>');
        });

        if(sno > 0)
        {
            $("#" + dropdownid).val(selecteddropvaluesno);
            //$("#ddlbState").val(StateSno).change();
        }
    }
}

/* @use : EditCommonRecords is used for edit the record (This is a common function to handle all the module edit)
 *  @param : 1) PKeyRequestName : Request name of the primary key (eg.doctorsno)
 *  @param : 2) Sno : Selected row's primary key
 *  @param : 3) CtlPageName : Controller name where function written
 *  @param : 4) HideDiv : Hide div ,during edit mode
 *  @param : 5) ShowDiv : Target div,where edit mode will disapay
 *  @param : 6) ButtonDisable : Button need to disable
 */
function EditCommonRecords(PKeyRequestName,Sno,CtlPageName,HideDiv,ShowDiv,ButtonDisable)
{
    //encodeURI is alternative of escape function which is deprecated
    var actionrequest = "edit&"+ encodeURI(PKeyRequestName) + "=" + encodeURI(Sno);

    CtlPageName = encodeURI(CtlPageName);
    HideDiv = encodeURI(HideDiv);
    ShowDiv = encodeURI(ShowDiv);
    ButtonDisable = encodeURI(ButtonDisable);

    // Call function to get data during edit mode
    GetSetContent(CtlPageName, actionrequest,HideDiv,ShowDiv,ButtonDisable);
}

/* @use : DeleteCommonRecords is used for delete the record (This is a common function to handle all the module delete)
 *  @param : 1) RequestPageName : Controller name where function written
 *  @param : 2) DeleteFunctionName : Delete function name
 *  @param : 3) PKeyRequestName : Request name of the primary key (eg.doctorsno)
 *  @param : 4) Sno : Primary key of selected record
 */
function DeleteCommonRecords(RequestPageName,DeleteFunctionName,PKeyRequestName,Sno)
{
    RequestPageName = encodeURI(RequestPageName);
    DeleteFunctionName = encodeURI(DeleteFunctionName);
    PKeyRequestName = encodeURI(PKeyRequestName);
    Sno = encodeURI(Sno);


    // During deletion show confirmation popup
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
            // Call ajax to delete selected row
            var data = "action=" + DeleteFunctionName + "&" + PKeyRequestName + "=" + Sno;
            var ajaxdelete = callajaxreturn(RequestPageName,data,"","POST","","","");
            if (ajaxdelete == "Deleted")
            {
                // Reload data after deletion
                ReloadDataTable('datatablemasters');
                swal("Deleted!","Record Deleted.","success");
            }
            else
            {
                swal("Failed!", ""+ajaxdelete+"", "error");
            }
        });
}

