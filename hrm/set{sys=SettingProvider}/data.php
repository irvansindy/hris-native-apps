<?php
$src_emp_no                        = '';
$src_employee_name                 = '';
if (!empty($_POST['src_emp_no']) && !empty($_POST['src_employee_name'])) {
    $src_emp_no                 = $_POST['src_emp_no'];
    $src_employee_name          = $_POST['src_employee_name'];
    $frameworks                 = "src_emp_no=" . "" . $src_emp_no . "&src_employee_name=" . "" . $src_employee_name . "";
} else if (empty($_POST['src_emp_no']) && !empty($_POST['src_employee_name'])) {
    $src_emp_no                 = $_POST['src_emp_no'];
    $src_employee_name          = $_POST['src_employee_name'];
    $frameworks                 = "src_employee_name=" . "" . $src_employee_name . "";
} else if (!empty($_POST['src_emp_no']) && empty($_POST['src_employee_name'])) {
    $src_emp_no                 = $_POST['src_emp_no'];
    $src_employee_name          = $_POST['src_employee_name'];
    $frameworks                 = "src_emp_no=" . "" . $src_emp_no . "";
}

?>
<!-- Modal -->
<div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                        <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                </a>
                <form method="post" id="myform">
                    <fieldset id="fset_1" style="margin-top: 25px;border-radius: 5px;border: 1px solid #e4e8ea;">
                        <legend>Searching</legend>
                        <div class="form-row">
                            <div class="col-sm-4 name">Employee No.</div>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input class="input--style-6" autocomplete="off" autofocus="on" id="src_emp_no" name="src_emp_no" id="src_emp_no" type="Text" value="<?php echo $src_emp_no; ?>" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-4 name">Employee Name</div>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input class="input--style-6" autocomplete="off" autofocus="on" name="src_employee_name" id="src_employee_name" type="Text" value="<?php echo $src_employee_name; ?>" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <button type="submit" name="submit_add" id="submit_add" type="button" class="btn btn-warning button_bot">
                        Filter
                    </button>
                </form>
            </div>
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->

<!-- MAIN DATATABLE SERVERSIDE CSS -->
<!-- MAIN DATATABLE SERVERSIDE CSS -->
<script type="text/javascript" src="../../asset/sdk_datatables_core/gt_dist/jQuery-2.1.4.min.js"></script>
<script type="text/javascript" src="../../asset/sdk_datatables_core/datatables/bedanihbuatjson/bootstrap/js/bootstrap.min.js"></script>
<!-- MAIN DATATABLE SERVERSIDE CSS -->
<!-- MAIN DATATABLE SERVERSIDE CSS -->

<!-- isi JSON -->
<!-- fetch data setting provider -->
<script type="text/javascript">
    // global the manage member table 
    $(document).ready(function() {
        datatable = $("#datatable").DataTable({
            dom: "B<'row'<'col-sm-12 col-md-9'l><'col-sm-12 col-md-9'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-7'p>>",

            processing: true,
            // retrieve: true,
            searching: true,
            paging: true,
            order: [
                [0, "asc"]
            ],
            pagingType: "simple",
            bPaginate: true,
            bLengthChange: false,
            bFilter: false,
            bInfo: true,
            bAutoWidth: true,
            language: {
                "processing": "Please wait..",
            },
            destroy: true,
            "ajax": "php_action/FuncDataRead.php<?php echo $getPackage; ?><?php echo $frameworks; ?>"
        });
    });
</script>

<div class="col-md-12">
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h4 class="card-title mb-0">Management Setting Provider</h4>
            <div class="card-actions ml-auto">
                <table>
                    <td>
                        <a href='#' class='open_modal_search' class="btn btn-demo" data-toggle="modal" data-target="#myModal2">
                            <div class="toolbar sprite-toolbar-search" id="SEARCH" title="Search">
                            </div>
                        </a>
                    </td>
                    
                    <td>
                        <div class="toolbar sprite-toolbar-reload" id="RELOAD" title="Reload" onclick="RefreshPage();">
                        </div>
                    </td>
                </table>
            </div>
        </div>

        <div class="card-body table-responsive p-0" style="width: 100vw;height: 78vh; width: 99.3%; margin: 5px;overflow: scroll;">
            <table align="left" id="datatable" border="1" class="table table-bordered table-striped table-hover table-head-fixed">
                <thead>
                    <tr>
                        <th class="fontCustom" style="z-index: 1;vertical-align: ce;vertical-align: middle;" nowrap="nowrap">No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        <th class="fontCustom" style="z-index: 1;vertical-align: ce;vertical-align: middle;" nowrap="nowrap">
                                Username</th>
                        <th class="fontCustom" style="z-index:1;vertical-align: ce;vertical-align: middle;">Full Name
                        </th>
                        <th class="fontCustom" nowrap="nowrap" style="z-index:1;vertical-align: ce;vertical-align: middle;">User Type
                        </th>
                        <th class="fontCustom" nowrap="nowrap" style="z-index:1;vertical-align: ce;vertical-align: middle;">User Status
                        </th>
                        <th class="fontCustom" nowrap="nowrap" style="z-index:1;vertical-align: ce;vertical-align: middle;">Employee Status
                        </th>
                        <th class="fontCustom" nowrap="nowrap" style="z-index:1;vertical-align: ce;vertical-align: middle;">Position
                        </th>
                        <th class="fontCustom" nowrap="nowrap" style="z-index:1;vertical-align: ce;vertical-align: middle;">Work Location
                        </th>
                        <th class="fontCustom" nowrap="nowrap" style="z-index:1;vertical-align: ce;vertical-align: middle;">Company
                        </th>
                        <th class="fontCustom" nowrap="nowrap" style="z-index:1;vertical-align: ce;vertical-align: middle;">View Menu
                        </th>
                    </tr>
                </thead>
            </table>
        </div>

        <div class='card-footer' style='background-color: #eee;height: 37px;padding-top: 5px;'>
        </div>

    </div>
</div>

<!-- edit modal setting provider -->
<div class="modal  fade fade-custom" tabindex="-1" role="dialog" id="UpdateForm">
    <div class="modal-dialog modal-belakang modal-bg" role="document">

            <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Menu Access Tree</h4>
                        <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                        </a>
                    </div>

                    <!-- <form class="form-horizontal" action="php_action/FuncDataUpdate.php" method="POST" id="updateMemberForm"> -->
                    <form class="form-horizontal" action="php_action/FuncDataUpdate.php" method="POST" id="FormDisplayUpdate">

                        <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

                        <fieldset id="fset_1">
                                <legend>General</legend>

                                <div class="messages_update"></div>

                                <input id="sel_emp_no" name="sel_emp_no" type="hidden" value="<?php echo $username; ?>">
                                
                                <!--FROM SESSION -->
                                <input id="sel_token" name="sel_token" type="hidden" value="<?php echo $get_token; ?>">
                                <!--FROM CONFIGURATION -->


                                <input id="sel_employee" name="sel_employee" type="hidden">


                                <div class="form-row">
                                        <div class="col-sm-12">
                                                <div class="input-group" id="sel_identity">
                                                </div>
                                        </div>
                                </div>
                        
                                <div class="form-row">
                                        <div class="col-4 name">Menu Authorization </div>
                                </div>
                                
                                <div class="form-row">
                                        <div class="card-body table-responsive p-0" style="width: 100vw;height: 30vh; width: 100%; overflow: scroll;overflow-x: hidden;border:1px solid #d2d2d2;border-radius: 4px;">
                                                <div id="box"></div>
                                        </div>
                                </div>
                        </fieldset>

                        </div>

                        <div class="modal-footer-sdk">
                                        <button type="reset" class="btn-sdk btn-primary-left" data-dismiss="modal"
                                                aria-hidden="true">
                                                &nbsp;Cancel&nbsp;
                                        </button>
                                        <button class="btn-sdk btn-primary-right" type="submit" name="submit_update" id="submit_update">
                                                Confirm
                                        </button>
                                        <button class="btn-sdk btn-primary-right" type="button" name="submit_update2"
                                                id="submit_update2" style='display:none;' disabled>
                                                <span class="spinner-grow spinner-grow-sm" role="status"
                                                    aria-hidden="true"></span>
                                                &nbsp;&nbsp;Processing..
                                        </button>
                                </div>
                    </form>


            </div>

            </form>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /edit modal -->

































































<script>
    function RefreshPage() {
            datatable.ajax.reload(null, true);

            setTimeout(function() {
                    mymodalss.style.display = "none";
                    document.getElementById("msg").innerHTML = "Data refreshed";
                    return false;
            }, 2000);

            mymodalss.style.display = "block";
            document.getElementById("msg").innerHTML = "Data refreshed";
            return false;
    }
</script>




<!-- isi JSON -->
<script type="text/javascript">
    function editMember(id = null) {
            if (id) {
                    // remove the error 
                    $(".form-group").removeClass('has-error').removeClass('has-success');
                    $(".text-danger").remove();
                    // empty the message div
                    $(".messages_update").html("");

                    // remove the id
                    $("#member_id").remove();

                    // fetch the member data
                    $.ajax({
                        url: 'php_action/getSelectedEmployee.php',
                        type: 'post',
                        data: {
                                member_id: id
                        },
                        dataType: 'json',


                        success: function(response) {
                                document.getElementById("sel_identity").innerHTML = response.Full_Name;

                                $("#sel_employee").val(response.emp_no);

                                $("#box").load("pages_relation/_pages_setting?rfid=" + response.emp_no,
                                        function(responseTxt, statusTxt, jqXHR) {
                                                if (statusTxt == "success") {
                                                    $("#box").show();
                                                }
                                                if (statusTxt == "error") {
                                                    alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                                }
                                        }
                                );


                                // here update the member data
                                $("#FormDisplayUpdate").unbind('submit').bind('submit', function() {
                                        // remove error messages
                                        $(".text-danger").remove();

                                        var form = $(this);

                                        var sel_employee    = $("#sel_employee").val();

                                        var regex = /^[a-zA-Z]+$/;

                                        if (sel_employee == "") {
                                                modals.style.display = "block";
                                                document.getElementById("msg").innerHTML = "work request";

                                        } else {
                                                $('#submit_update').hide();
                                                $('#submit_update2').show();
                                        }


                                        if (sel_employee) {

                                                $.ajax({

                                                    url: form.attr('action'),
                                                    type: form.attr('method'),
                                                    // data: form.serialize(),

                                                    data: new FormData(this),
                                                    processData: false,
                                                    contentType: false,

                                                    dataType: 'json',
                                                    success: function(response) {

                                                            if (response.code == 'success_message') {
                                                                    modals.style.display = "block";
                                                                    document.getElementById("msg").innerHTML = response.messages;

                                                                    $('#submit_update').show();
                                                                    $('#submit_update2').hide();

                                                                    $('#FormDisplayUpdate').modal('hide');
                                                                    $("[data-dismiss=modal]").trigger({
                                                                            type: "click"
                                                                    });

                                                                    // reload the datatables
                                                                    datatable.ajax.reload(null, false);
                                                                    // reload the datatables

                                                            } else {
                                                                    $('#submit_update').show();
                                                                    $('#submit_update2').hide();

                                                                    modals.style.display = "block";
                                                                    document.getElementById("msg").innerHTML = response.messages;
                                                            }
                                                    } // /success
                                                }); // /ajax
                                        } // /if
                                        return false;
                                });
                        } // /success
                    }); // /fetch selected member info
            } else {
                    alert("Error : Refresh the page again");
            }
    }
</script>
<!-- isi JSONs -->
</body>

</html>


<script type="text/javascript">
    var tree4 = $("#test-select-4").treeMultiselect({
            allowBatchSelection: true,
            enableSelectAll: true,
            searchable: true,
            sortable: true,
            startCollapsed: false,
    });
</script>