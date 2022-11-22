

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/histogram-bellcurve.js"></script>
<?php
$src_perf                        = '';
$src_perf_grade                 = '';
if (!empty($_POST['src_perf']) && !empty($_POST['src_perf_grade'])) {
       $src_perf                   = $_POST['src_perf'];
       $src_perf_grade             = $_POST['src_perf_grade'];
       $frameworks                 = "src_perf=" . "" . $src_perf . "&src_perf_grade=" . "" . $src_perf_grade . "";
} else if (empty($_POST['src_perf']) && !empty($_POST['src_perf_grade'])) {
       $src_perf                   = $_POST['src_perf'];
       $src_perf_grade             = $_POST['src_perf_grade'];
       $frameworks                 = "src_perf_grade=" . "" . $src_perf_grade . "";
} else if (!empty($_POST['src_perf']) && empty($_POST['src_perf_grade'])) {
       $src_perf                   = $_POST['src_perf'];
       $src_perf_grade             = $_POST['src_perf_grade'];
       $frameworks                 = "src_perf=" . "" . $src_perf . "";
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
                                                 <div class="col-sm-4 name">Performance Grade</div>
                                                 <div class="col-sm-8">
                                                        <div class="input-group">
                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="src_perf" name="src_perf" type="Text" value="<?php echo $src_perf; ?>" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                                        </div>
                                                 </div>
                                          </div>
                                          
                                          <div class="form-row">
                                                 <div class="col-sm-4 name">Performance Grade Adjust</div>
                                                 <div class="col-sm-8">
                                                        <div class="input-group">
                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="src_perf_grade" name="src_perf_grade" type="Text" value="<?php echo $src_perf_grade; ?>" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
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
                     order: [
                            [0, "asc"]
                     ],
                     pagingType: "simple",
                     bPaginate: true,
                     bLengthChange: true,
                     bFilter: true,
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


<div id="suggestion" style="width: 100%;">
</div>


<link rel="stylesheet" href="others/css/demo.css">
<link rel="stylesheet" href="others/src/topper.css">
<script src="others/src/topper.js"></script>

<div class="col-md-12">
       <div class="row">
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

                            <div class="card-body table-responsive p-0" style="width: 100vw;height: 78vh; width: 98.8%; margin: 5px;overflow: scroll;">
                                   <table id="datatable" width="100%" border="1" align="left" class="table table-bordered table-striped table-hover table-head-fixed">
                                          <thead>
                                                 <tr>
                                                        <th class="fontCustom" style="z-index: 1; width: 407.867px;background-color: #4285c5;color: white;height: 24px;" nowrap="nowrap">No.</th>
                                                        <th class="fontCustom" style="z-index: 1; width: 407.867px;background-color: #4285c5;color: white;height: 24px;">Emp No.</th>
                                                        <th class="fontCustom" style="z-index: 1; width: 407.867px;background-color: #4285c5;color: white;height: 24px;">Full Name</th>
                                                        <th class="fontCustom" style="z-index: 1; width: 407.867px;background-color: #4285c5;color: white;height: 24px;">Performance Grade</th>
                                                        <th class="fontCustom" style="z-index: 1; width: 407.867px;background-color: #4285c5;color: white;height: 24px;">Performance Grade Adjust</th>
                                                        <th class="fontCustom" style="z-index: 1; width: 407.867px;background-color: #4285c5;color: white;height: 24px;">Performance Result Adjust</th>
                                                        <th class="fontCustom" style="z-index: 1; width: 407.867px;background-color: #4285c5;color: white;height: 24px;">Status</th>
                                                        <th class="fontCustom" style="z-index: 1; width: 407.867px;background-color: #4285c5;color: white;height: 24px;">Action</th>
                                                 </tr>
                                          </thead>
                                   </table>

                            </div>

                            <div class='card-footer' style='background-color: #eee;height: 37px;padding-top: 5px;'>



                            </div>

                     </div>
              </div>

              <!-- <div class="col-lg-4 col-md-12">
                     <div class="card">
                            <div class="card-header d-flex align-items-center">
                                   <h4 class="card-title mb-0">Probability Density </h4>
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
                            <div style="width: 90%;margin: 5px;overflow: scroll;">
                            <div id="charting"></div>
                            </div>
                     </div>
              </div> -->




              <div class="col-lg-4 col-md-12">

                     <div class="card " style="background: linear-gradient(229deg, #e8eae9, #d3d3d3);">
                            <div class="card-body">
                                   <div class="d-flex">

                                   </div>
                                   <div class="row mt-1">
                                          <div style="width: 100%;margin: 5px;overflow: scroll;">
                                                 <div id="charting"></div>
                                          </div>
                                   </div>
                            </div>
                     </div>


                     <div class="card " style="background: linear-gradient(229deg, #e8eae9, #d3d3d3);">
                            <div class="card-body">
                                   <div class="d-flex">

                                   </div>
                                   <div class="row mt-1">
                                          <div style="width: 100%;margin: 5px;overflow: scroll;">
                                                 <div id="charting_before"></div>
                                          </div>
                                   </div>
                            </div>
                     </div>

                     <div class="card " style="background: linear-gradient(229deg, #e8eae9, #d3d3d3);">
                            <div class="card-body">
                                   <div class="d-flex">

                                   </div>
                                   <div class="row mt-1">
                                          <div style="width: 100%;margin: 5px;overflow: scroll;">
                                                 <div id="charting_company_expectation"></div>
                                          </div>
                                   </div>
                            </div>
                     </div>
              </div>

       </div>
</div>






































<!-- add modal -->
<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="UpdateForm">
       <div class="modal-dialog modal-belakang modal-med" role="document">
              <div class="modal-content">
                     <div class="modal-header">
                            <h4 class="modal-title">Set Grade</h4>
                            <a type="button" class="close" onclick="RefreshTable();" data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>


                     <form class="form-horizontal" action="php_action/FuncDataUpdate.php" method="POST" id="FormDisplayUpdate">

                            <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

                                   <fieldset id="fset_1">
                                          <legend>Calibration Form</legend>

                                          <div class="messages_create"></div>

                                          <div class="form-row">
                                                 <div class="col-sm-3 name">Employee </div>
                                                 <div class="col-sm-8">
                                                        <div class="input-group">
                                                               <div id="employee" style="margin-top: 11px;"></div>
                                                               <input class="input--style-6 sel_emp_no" type="hidden" name="sel_emp_no" style="width: 100%;height: 30px;" id="sel_emp_no" value="">
                                                               <input class="input--style-6 sel_request_no" type="hidden" name="sel_request_no" style="width: 100%;height: 30px;" id="sel_request_no" value="">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row" style="display: none;">
                                                 <div class="col-sm-3 name">Select Grade</div>
                                                 <div class="col-sm-6">
                                                        <div class="input-group">

                                                               <select class="input--style-6 sel_grade" name="sel_grade" style="width: 50%;height: 30px;" id="sel_grade">
                                                                      <option value="">--Select One--</option>
                                                                      <?php
                                                                      $sql = mysqli_query($connect, "SELECT 
                                                                                                  a.`id_range`AS `id_range`
                                                                                                  FROM 
                                                                                                  hrmperf_range a");
                                                                      while ($row = mysqli_fetch_array($sql)) {
                                                                             echo '<option value="' . $row['id_range'] . '">' . $row['id_range'] . '</option>';
                                                                      }
                                                                      ?>
                                                               </select>
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-3 name">Index Performance </div>
                                                 <div class="col-sm-5">
                                                        <div class="input-group">
                                                               <div id="sel_performance_before" style="margin-top: 11px;"></div>
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-3 name">Index Performance Value </div>
                                                 <div class="col-sm-5">
                                                        <div class="input-group">
                                                               <input class="input--style-6 sel_performance" type="text" name="sel_performance" style="width: 100%;height: 30px;" id="sel_performance" value="" autocomplete="off">
                                                        </div>
                                                 </div>
                                                 <div class="col-sm-2">
                                                        <div class="input-group">
                                                               <div id="performance_list"></div>
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-3 name"> </div>
                                                 <div class="col-sm-9">
                                                        <div class="input-group">
                                                               <div id="range_table" style="width: 100%;"></div>
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
                                   <button class="btn-sdk btn-primary-right" type="button" name="submit_update2" id="submit_update2" style='display:none;' disabled>
                                          <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                          &nbsp;&nbsp;Processing..
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

       // function RefreshTable() {
       //        datatable.ajax.reload(null, true);
       // }
</script>






<!-- isi JSON -->
<script type="text/javascript">
       // global the manage memeber table 
       $(document).ready(function() {

              $("#suggestion").load("pages_relation/_pages_suggestion.php",
                     function(responseTxt, statusTxt, jqXHR) {
                            if (statusTxt == "success") {
                                   $("#suggestion").show();
                            }
                            if (statusTxt == "error") {
                                   alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                            }
                     }
              );


              $("#charting").load("pages_relation/_pages_chart.php",
                     function(responseTxt, statusTxt, jqXHR) {
                            if (statusTxt == "success") {
                                   $("#charting").show();
                            }
                            if (statusTxt == "error") {
                                   alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                            }
                     }
              );

              $("#charting_before").load("pages_relation/_pages_chartbefore.php",
                     function(responseTxt, statusTxt, jqXHR) {
                            if (statusTxt == "success") {
                                   $("#charting_before").show();
                            }
                            if (statusTxt == "error") {
                                   alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                            }
                     }
              );

              $("#charting_company_expectation").load("pages_relation/_pages_chartcompany.php",
                     function(responseTxt, statusTxt, jqXHR) {
                            if (statusTxt == "success") {
                                   $("#charting_company_expectation").show();
                            }
                            if (statusTxt == "error") {
                                   alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                            }
                     }
              );
       });

       function UpdateForm(id = null) {

              if (id) {
                     // remove the error 
                     $(".form-group").removeClass('has-error').removeClass('has-success');
                     $(".text-danger").remove();
                     // empty the message div
                     $(".messages_update").html("");

                     // remove the id
                     $("#member_id").remove();

                     $("#range_table").load("pages_relation/_pages_table.php",
                            function(responseTxt, statusTxt, jqXHR) {
                                   if (statusTxt == "success") {
                                          $("#range_table").show();
                                   }
                                   if (statusTxt == "error") {
                                          alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                   }
                            }
                     );

                     // fetch the member data
                     $.ajax({
                            url: 'php_action/getSelectedRequest.php',
                            type: 'post',
                            data: {
                                   key: id
                            },
                            dataType: 'json',


                            success: function(response) {
                                   mymodalss.style.display = "none";

                                   document.getElementById("employee").innerHTML = response.Full_Name + " (" + response.request_for + ")";
                                   document.getElementById("sel_performance_before").innerHTML = response.pa_grade + " (" + response.pa_result + ")";


                                   $("#sel_emp_no").val(response.request_for);
                                   $("#sel_request_no").val(response.ipp_reqno);
                                   $("#sel_grade").val(response.pa_grade_adjust);
                                   $("#sel_performance").val(response.pa_result_adjust);

                                   var query = response.pa_result_adjust;



                                   $.ajax({
                                          url: "search_performance.php",
                                          method: "POST",
                                          data: {
                                                 query: query
                                          },
                                          success: function(data) {
                                                 $('#performance_list').html(data);
                                          }
                                   });



                                   // here update the member data
                                   $("#FormDisplayUpdate").unbind('submit').bind('submit', function() {
                                          // remove error messages
                                          $(".text-danger").remove();

                                          var form = $(this);

                                          var sel_request_no = $("#sel_request_no").val();
                                          // var sel_grade = $("#sel_grade").val();

                                          var regex = /^[a-zA-Z]+$/;



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

                                                               // reload the datatables
                                                               datatable.ajax.reload(null, false);
                                                               // reload the datatables

                                                               $("#suggestion").load("pages_relation/_pages_suggestion.php",
                                                                      function(responseTxt, statusTxt, jqXHR) {
                                                                             if (statusTxt == "success") {
                                                                                    $("#suggestion").show();
                                                                             }
                                                                             if (statusTxt == "error") {
                                                                                    alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                                                             }
                                                                      }
                                                               );


                                                               $("#charting").load("pages_relation/_pages_chart.php",
                                                                      function(responseTxt, statusTxt, jqXHR) {
                                                                             if (statusTxt == "success") {
                                                                                    $("#charting").show();
                                                                             }
                                                                             if (statusTxt == "error") {
                                                                                    alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                                                             }
                                                                      }
                                                               );

                                                               $("#charting_before").load("pages_relation/_pages_chartbefore.php",
                                                                      function(responseTxt, statusTxt, jqXHR) {
                                                                             if (statusTxt == "success") {
                                                                                    $("#charting_before").show();
                                                                             }
                                                                             if (statusTxt == "error") {
                                                                                    alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                                                             }
                                                                      }
                                                               );

                                                               $("#charting_company_expectation").load("pages_relation/_pages_chartcompany.php",
                                                                      function(responseTxt, statusTxt, jqXHR) {
                                                                             if (statusTxt == "success") {
                                                                                    $("#charting_company_expectation").show();
                                                                             }
                                                                             if (statusTxt == "error") {
                                                                                    alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                                                             }
                                                                      }
                                                               );

                                                               modals.style.display = "block";
                                                               document.getElementById("msg").innerHTML = response.messages;

                                                               $('#FormDisplayUpdate').modal('hide');
                                                               $("[data-dismiss=modal]").trigger({
                                                                      type: "click"
                                                               });





                                                        } else {
                                                               $('#submit_update').show();
                                                               $('#submit_update2').hide();

                                                               modals.style.display = "block";
                                                               document.getElementById("msg").innerHTML = response.messages;
                                                        }
                                                 } // /success
                                          }); // /ajax




                                          return false;
                                   });
                            } // /success
                     }); // /fetch selected member info
              } else {
                     alert("Error : Refresh the page again");
              }
       }






















       function AdjustTable(id = null) {

   

              if (id) {


                     var x = document.getElementById("pa_grading_adj" + id).value;

                     $.ajax({

                            url: 'php_action/FuncDataUpdateRows.php?key0=' + id + '&key1=' + x,
                            type: 'GET',
                            dataType: 'json',
                            processData: false,
                            contentType: false,

                            dataType: 'json',
                            success: function(response) {

                                   if (response.code == 'success_message') {

                                          // reload the datatables
                                          datatable.ajax.reload(null, false);
                                          // reload the datatables

                                          Topper({
                                                 title: 'Successfully Adjust Performance',
                                                 text: '',
                                                 style: 'danger',
                                                 type: 'top',
                                                 autoclose: true,
                                                 autocloseAfter: 2000
                                          });

                                      

                                          $("#suggestion").load("pages_relation/_pages_suggestion.php",
                                                 function(responseTxt, statusTxt, jqXHR) {
                                                        if (statusTxt == "success") {
                                                               $("#suggestion").show();
                                                        }
                                                        if (statusTxt == "error") {
                                                               alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                                        }
                                                 }
                                          );


                                          $("#charting").load("pages_relation/_pages_chart.php",
                                                 function(responseTxt, statusTxt, jqXHR) {
                                                        if (statusTxt == "success") {
                                                               $("#charting").show();
                                                        }
                                                        if (statusTxt == "error") {
                                                               alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                                        }
                                                 }
                                          );

                                          $("#charting_before").load("pages_relation/_pages_chartbefore.php",
                                                 function(responseTxt, statusTxt, jqXHR) {
                                                        if (statusTxt == "success") {
                                                               $("#charting_before").show();
                                                        }
                                                        if (statusTxt == "error") {
                                                               alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                                        }
                                                 }
                                          );

                                          $("#charting_company_expectation").load("pages_relation/_pages_chartcompany.php",
                                                 function(responseTxt, statusTxt, jqXHR) {
                                                        if (statusTxt == "success") {
                                                               $("#charting_company_expectation").show();
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
                     return false;

              } else {
                     alert("Error : Refresh the page again");
              }
       }










       $(document).ready(function() {
              $('#sel_performance').focus(function() {
                     var query = $(this).val();
                     if (query != '') {
                            $.ajax({
                                   url: "search_performance.php<?php echo $getPackage; ?>userid=<?php echo $username; ?>",
                                   method: "POST",
                                   data: {
                                          query: query
                                   },
                                   success: function(data) {
                                          // $('#performance_list').fadeIn();
                                          $('#performance_list').html(data);
                                   }
                            });
                     }
              });
              $('#sel_performance').keyup(function() {
                     var query = $(this).val();
                     if (query != '') {
                            $.ajax({
                                   url: "search_performance.php<?php echo $getPackage; ?>userid=<?php echo $username; ?>",
                                   method: "POST",
                                   data: {
                                          query: query
                                   },
                                   success: function(data) {
                                          // $('#performance_list').fadeIn();
                                          $('#performance_list').html(data);

                                   }
                            });
                     }
              });




       });
</script>
<!-- isi JSONs -->
</body>

</html>