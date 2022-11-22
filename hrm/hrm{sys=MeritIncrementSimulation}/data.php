<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/histogram-bellcurve.js"></script>
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
<script type="text/javascript">
       // global the manage memeber table 
       $(document).ready(function() {
              datatable = $("#datatable").DataTable({

                     dom: "B<'row'<'col-sm-12 col-md-9'l><'col-sm-12 col-md-9'f>>" +
                            "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-7'p>>",

                     processing: true,
                     // retrieve: true,
                     searching: true,
                     paging: true,
                     lengthMenu: [
                     [10, 25, 50, -1],
                     [10, 25, 50, 'All'],
                     ],
                     order: [
                            [0, "asc"]
                     ],
                     pagingType: "simple",
                     bPaginate: true,
                     bLengthChange: true,
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



<div class="col-md-4">
       <div class="card">
              <div class="card-header d-flex align-items-center">
                     <h4 class="card-title mb-0">Merit Salary Increment </h4>
                     <div class="card-actions ml-auto">
                            <table>
                       
                                   <td>
                                   <a href='#' class='open_modal_search' class="btn btn-demo">
                                          <div class="toolbar sprite-toolbar-reload" id="RELOAD" title="Reload" onclick="RefreshPage();">
                                          </div>
                                          </a>
                                   </td>
                            </table>
                     </div>
              </div>

              <div style="height: 48vh; margin: 5px;overflow: scroll;">
                <div id="charting"></div>
              </div>

              <div class='card-footer' style='background-color: #eee;height: 37px;padding-top: 5px;'>
              </div>
       </div>
</div>


<div class="col-md-8">
       <div class="card">
              <div class="card-header d-flex align-items-center">
                     <h4 class="card-title mb-0">List Employee </h4>
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
           
              <div id="adjustment_result" style="margin-top: 5px;"></div>
         
              <div class="card-body table-responsive p-0" style="width: 100vw;height: 78vh; width: 98.8%; margin: 5px;overflow: scroll;">
                     <table id="datatable" width="100%" border="1" align="left" class="table table-bordered table-striped table-hover table-head-fixed">
                            <thead>
                                   <tr>
                                          <th class="fontCustom" style="z-index: 1; width: 407.867px;background-color: #4285c5;color: white;height: 24px;" nowrap="nowrap">No.</th>
                                          <th class="fontCustom" style="z-index: 1; width: 407.867px;background-color: #4285c5;color: white;height: 24px;">Employee No</th>
                                          <th class="fontCustom" style="z-index: 1; width: 407.867px;background-color: #4285c5;color: white;height: 24px;">Employee Name</th>
                                          <th class="fontCustom" style="z-index: 1; width: 407.867px;background-color: #4285c5;color: white;height: 24px;">Performance Rating</th>
                                          <th class="fontCustom" style="z-index: 1; width: 407.867px;background-color: #4285c5;color: white;height: 24px;">Compa Ratio Grouping</th>
                                          <th class="fontCustom" style="z-index: 1; width: 407.867px;background-color: #4285c5;color: white;height: 24px;">Merit Increase Suggestion</th>
                                          <th class="fontCustom" style="z-index: 1; width: 407.867px;background-color: #4285c5;color: white;height: 24px;">Basic Salary</th>
                                          <th class="fontCustom" style="z-index: 1; width: 407.867px;background-color: #4285c5;color: white;height: 24px;">Merit Increase Spend</th>
                                          <th class="fontCustom" style="z-index: 1; width: 407.867px;background-color: #4285c5;color: white;height: 24px;">Action</th>
                                   </tr>
                            </thead>
                     </table>
              </div>

              <div class='card-footer' style='background-color: #eee;height: 37px;padding-top: 5px;'>
              </div>
       </div>
</div>














































<!-- add modal -->
<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="UpdateForm">
       <div class="modal-dialog modal-belakang modal-med" role="document">
              <div class="modal-content">
                     <div class="modal-header">
                            <h4 class="modal-title">Set Annual Salary Increment Budget </h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <form class="form-horizontal" action="php_action/FuncDataUpdateSIM.php" method="POST" id="FormDisplayUpdate">

                            <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

                                   <fieldset id="fset_1">
                                          <legend>Form Index</legend>

                                          <div class="messages_create"></div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Period </div>
                                                 <div class="col-sm-8">
                                                        <div class="input-group">
                                                               <div id="employee" style="margin-top: 11px;"></div>
                                                               <input class="input--style-6 sel_period" type="hidden" name="sel_period" style="width: 100%;height: 30px;" id="sel_period" value="" autocomplete="off">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Total Value</div>
                                                 <div class="col-sm-6">
                                                        <div class="input-group">
                                                               <input class="input--style-6 sel_total_value" type="text" name="sel_total_value" style="width: 25%;height: 30px;text-align: center;" id="sel_total_value" value="" autocomplete="off"> %
                                                        </div>
                                                 </div>
                                          </div>
                                   </fieldset>
                            </div>

                            <div class="modal-footer-sdk">
                                   <button type="reset" class="btn-sdk btn-primary-left" data-dismiss="modal" aria-hidden="true">
                                          &nbsp;Cancel&nbsp;
                                   </button>
                                   <button class="btn-sdk btn-primary-right" type="submit" name="submit_update" id="submit_update">
                                          Confirm
                                   </button>
                            </div>
                     </form>
              </div>
       </div>
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /edit modal -->













<!-- add modal -->
<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="VertAxis">
       <div class="modal-dialog modal-belakang modal-med" role="document">
              <div class="modal-content">
                     <div class="modal-header">
                            <h4 class="modal-title">Vertical Axis Adjustment </h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <form class="form-horizontal" action="php_action/FuncDataUpdateVertAxis" method="POST" id="VertAxisForm">

                            <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

                                   <fieldset id="fset_1">
                                          <legend>Form Index</legend>
                                          <div class="form-row" style="display: none;">
                                                 <div class="col-sm-2 name">Period </div>
                                                 <div class="col-sm-8">
                                                        <div class="input-group">
                                                               <div id="vert_value" style="margin-top: 11px;"></div>
                                                               <input type="hidden" name="last_vert_value" style="width: 100%;height: 30px;" id="last_vert_value" value="" autocomplete="off">
                                                               <input type="hidden" name="sel_period_vert" style="width: 100%;height: 30px;" id="sel_period_vert" value="" autocomplete="off">
                                                               <input type="hidden" name="sel_performance" style="width: 100%;height: 30px;" id="sel_performance" value="" autocomplete="off">
                                                            

                                                        </div>
                                                 </div>
                                          </div>


                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Total Value</div>
                                                 <div class="col-sm-6">
                                                        <div class="input-group">
                                                               <input class="input--style-6 new_vert_value" type="text" name="new_vert_value" style="width: 25%;height: 30px;text-align: center;" id="new_vert_value" value="" autocomplete="off"> %
                                                        </div>
                                                 </div>
                                          </div>
                                   </fieldset>
                            </div>

                            <div class="modal-footer-sdk">
                                   <button type="reset" class="btn-sdk btn-primary-left" data-dismiss="modal" aria-hidden="true">
                                          &nbsp;Cancel&nbsp;
                                   </button>
                                   <button class="btn-sdk btn-primary-right" type="submit" name="submit_update" id="submit_update">
                                          Confirm
                                   </button>
                            </div>
                     </form>
              </div>
       </div>
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /edit modal -->













<!-- add modal -->
<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="HoriAxis">
       <div class="modal-dialog modal-belakang modal-med" role="document">
              <div class="modal-content">
                     <div class="modal-header">
                            <h4 class="modal-title">Horizontal Axis Adjustment </h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <form class="form-horizontal" action="php_action/FuncDataUpdateHoriAxis" method="POST" id="HoriAxisForm">

                            <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

                                   <fieldset id="fset_1">
                                          <legend>Form Index</legend>
                                          <div class="form-row" style="display: none;">
                                                 <div class="col-sm-2 name">Period </div>
                                                 <div class="col-sm-8">
                                                        <div class="input-group">
                                                               <div id="hori_value" style="margin-top: 11px;"></div>
                                                               <input type="hidden" name="last_hori_value" style="width: 100%;height: 30px;" id="last_hori_value" value="" autocomplete="off">
                                                               <input type="hidden" name="sel_period_hori" style="width: 100%;height: 30px;" id="sel_period_hori" value="" autocomplete="off">
                                                               <input type="hidden" name="sel_comparatio" style="width: 100%;height: 30px;" id="sel_comparatio" value="" autocomplete="off">
                                                            

                                                        </div>
                                                 </div>
                                          </div>


                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Total Value</div>
                                                 <div class="col-sm-6">
                                                        <div class="input-group">
                                                               <input class="input--style-6 new_vert_value" type="text" name="new_hori_value" style="width: 25%;height: 30px;text-align: center;" id="new_hori_value" value="" autocomplete="off"> %
                                                        </div>
                                                 </div>
                                          </div>
                                   </fieldset>
                            </div>

                            <div class="modal-footer-sdk">
                                   <button type="reset" class="btn-sdk btn-primary-left" data-dismiss="modal" aria-hidden="true">
                                          &nbsp;Cancel&nbsp;
                                   </button>
                                   <button class="btn-sdk btn-primary-right" type="submit" name="submit_update" id="submit_update">
                                          Confirm
                                   </button>
                            </div>
                     </form>
              </div>
       </div>
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

           // global the manage memeber table 
           $(document).ready(function() {
         
              
              $("#charting").load("pages_relation/_pages_chart.php?ip_period=2022",
                     function(responseTxt, statusTxt, jqXHR) {
                            if (statusTxt == "success") {
                                   $("#charting").show();
                            }
                            if (statusTxt == "error") {
                                   alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                            }
                     }
                     );

                     $("#adjustment_result").load("pages_relation/_pages_adjustment_result.php?ip_period=2022",
                     function(responseTxt, statusTxt, jqXHR) {
                            if (statusTxt == "success") {
                                   $("#adjustment_result").show();
                            }
                            if (statusTxt == "error") {
                                   alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                            }
                     }
                     );
              });
              
              
            

              

       function UpdateForm(id = null) {
              mymodalss.style.display = "block";
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
                            url: 'php_action/getSelectedBudget.php',
                            type: 'post',
                            data: {
                                   key: id
                            },
                            dataType: 'json',


                            success: function(response) {
                                   mymodalss.style.display = "none";

                                   document.getElementById("employee").innerHTML = response.ip_period ;

                                   $("#sel_period").val(response.ip_period);
                                   $("#sel_total_value").val(response.total_value);



                                   // here update the member data
                                   $("#FormDisplayUpdate").unbind('submit').bind('submit', function() {
                                          // remove error messages
                                          $(".text-danger").remove();

                                          var form = $(this);

                                          var sel_total_value = $("#sel_total_value").val();

                                          var regex = /^[a-zA-Z]+$/;

                                          if (sel_total_value == "") {
                                                 modals.style.display = "block";
                                                 document.getElementById("msg").innerHTML = "work request";
                                                 return false;

                                          } else {

                                                 if (sel_total_value) {

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

                                                                      $('#FormDisplayUpdate').modal('hide');
                                                                      $("[data-dismiss=modal]").trigger({
                                                                             type: "click"
                                                                      });

                                                                      // reload the datatables
                                                                      datatable.ajax.reload(null, false);
                                                                      // reload the datatables
                                                                      
                                                                      $("#charting").load("pages_relation/_pages_chart.php?ip_period=2022",
                                                                             function(responseTxt, statusTxt, jqXHR) {
                                                                                    if (statusTxt == "success") {
                                                                                           $("#charting").show();
                                                                                    }
                                                                                    if (statusTxt == "error") {
                                                                                           alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                                                                    }
                                                                             }
                                                                      );

                                                                      $("#adjustment_result").load("pages_relation/_pages_adjustment_result.php?ip_period=2022",
                                                                             function(responseTxt, statusTxt, jqXHR) {
                                                                                    if (statusTxt == "success") {
                                                                                           $("#adjustment_result").show();
                                                                                    }
                                                                                    if (statusTxt == "error") {
                                                                                           alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                                                                    }
                                                                             }
                                                                      );
                                                               } else {
                                                                      modals.style.display = "block";
                                                                      document.getElementById("msg").innerHTML = response.messages;
                                                               }
                                                        } // /success
                                                 }); // /ajax
                                                 } // /if
                                          }

                                          
                                          return false;
                                   });
                            } // /success
                     }); // /fetch selected member info
              } else {
                     alert("Error : Refresh the page again");
              }
       }




       function VertAxis(id = null) {

              mymodalss.style.display = "block";
              if (id) {
                     // remove the error 
                     $(".form-group").removeClass('has-error').removeClass('has-success');
                     $(".text-danger").remove();
                     // empty the message div
                     $(".messages_update").html("");

                     // remove the id
                     $("#member_id").remove();

                     var myarr = id.split("#");
                     var myvar0 = myarr[0];
                     var myvar1 = myarr[1];
                     var myvar2 = myarr[2];

                     // fetch the member data
                     $.ajax({
                            url: 'php_action/getSelectedVertAxis.php',
                            type: 'post',
                            data: {
                                   key0: myvar0,
                                   key1: myvar1,
                                   key2: myvar2
                            },
                            dataType: 'json',


                            success: function(response) {
                                   mymodalss.style.display = "none";

                                   document.getElementById("vert_value").innerHTML = response.index_percentage_vertical ;

                                   $("#last_vert_value").val(response.index_percentage_vertical);
                                   $("#new_vert_value").val(response.index_percentage_vertical);
                                   $("#sel_period_vert").val(response.ip_period);
                                   $("#sel_performance").val(myvar2);
                                   
                  
                                   // here update the member data
                                   $("#VertAxisForm").unbind('submit').bind('submit', function() {
                                          // remove error messages
                                          $(".text-danger").remove();

                                          var form = $(this);

                                          var new_vert_value = $("#new_vert_value").val();

                                          var regex = /^[a-zA-Z]+$/;

                                          if (sel_total_value == "") {
                                                 modals.style.display = "block";
                                                 document.getElementById("msg").innerHTML = "work request";
                                                 return false;

                                          } else {

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

                                                                      $('#VertAxis').modal('hide');
                                                                      $("[data-dismiss=modal]").trigger({
                                                                             type: "click"
                                                                      });

                                                                      // reload the datatables
                                                                      datatable.ajax.reload(null, false);
                                                                      // reload the datatables

                                                                      $("#charting").load("pages_relation/_pages_chart.php?ip_period=2022",
                                                                             function(responseTxt, statusTxt, jqXHR) {
                                                                                    if (statusTxt == "success") {
                                                                                           $("#charting").show();
                                                                                    }
                                                                                    if (statusTxt == "error") {
                                                                                           alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                                                                    }
                                                                             }
                                                                      );

                                                                      $("#adjustment_result").load("pages_relation/_pages_adjustment_result.php?ip_period=2022",
                                                                             function(responseTxt, statusTxt, jqXHR) {
                                                                                    if (statusTxt == "success") {
                                                                                           $("#adjustment_result").show();
                                                                                    }
                                                                                    if (statusTxt == "error") {
                                                                                           alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                                                                    }
                                                                             }
                                                                      );
                                                               } else {
                                                                      modals.style.display = "block";
                                                                      document.getElementById("msg").innerHTML = response.messages;
                                                               }
                                                        } // /success
                                                 }); // /ajax
                                          
                                          }

                                          
                                          return false;
                                   });
                            } // /success
                     }); // /fetch selected member info
              } else {
                     alert("Error : Refresh the page again");
              }
       }


       function HoriAxis(id = null) {

       mymodalss.style.display = "block";
       if (id) {
              // remove the error 
              $(".form-group").removeClass('has-error').removeClass('has-success');
              $(".text-danger").remove();
              // empty the message div
              $(".messages_update").html("");

              // remove the id
              $("#member_id").remove();

              var myarr = id.split("#");
              var myvar0 = myarr[0];
              var myvar1 = myarr[1];
              var myvar2 = myarr[2];

              // fetch the member data
              $.ajax({
                     url: 'php_action/getSelectedHoriAxis.php',
                     type: 'post',
                     data: {
                            key0: myvar0,
                            key1: myvar1,
                            key2: myvar2
                     },
                     dataType: 'json',


                     success: function(response) {


                            mymodalss.style.display = "none";

                            document.getElementById("hori_value").innerHTML = response.index_percentage_horizontal ;

                            $("#last_hori_value").val(response.index_percentage_horizontal);
                            $("#new_hori_value").val(response.index_percentage_horizontal);
                            $("#sel_period_hori").val(response.ip_period);
                            $("#sel_comparatio").val(myvar2);
                            
       
                            // here update the member data
                            $("#HoriAxisForm").unbind('submit').bind('submit', function() {
                                   // remove error messages
                                   $(".text-danger").remove();

                                   var form = $(this);

                                   var new_vert_value = $("#new_vert_value").val();

                                   var regex = /^[a-zA-Z]+$/;

                                   if (sel_total_value == "") {
                                          modals.style.display = "block";
                                          document.getElementById("msg").innerHTML = "work request";
                                          return false;

                                   } else {

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

                                                               $('#HoriAxis').modal('hide');
                                                               $("[data-dismiss=modal]").trigger({
                                                                      type: "click"
                                                               });

                                                               // reload the datatables
                                                               datatable.ajax.reload(null, false);
                                                               // reload the datatables

                                                               $("#charting").load("pages_relation/_pages_chart.php?ip_period=2022",
                                                                      function(responseTxt, statusTxt, jqXHR) {
                                                                             if (statusTxt == "success") {
                                                                                    $("#charting").show();
                                                                             }
                                                                             if (statusTxt == "error") {
                                                                                    alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                                                             }
                                                                      }
                                                               );

                                                               $("#adjustment_result").load("pages_relation/_pages_adjustment_result.php?ip_period=2022",
                                                                      function(responseTxt, statusTxt, jqXHR) {
                                                                             if (statusTxt == "success") {
                                                                                    $("#adjustment_result").show();
                                                                             }
                                                                             if (statusTxt == "error") {
                                                                                    alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                                                             }
                                                                      }
                                                               );
                                                        } else {
                                                               modals.style.display = "block";
                                                               document.getElementById("msg").innerHTML = response.messages;
                                                        }
                                                 } // /success
                                          }); // /ajax
                                   
                                   }

                                   
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