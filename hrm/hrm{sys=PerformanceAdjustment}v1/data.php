<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/histogram-bellcurve.js"></script>
<?php
$shiftregroup_year                 = '';
$shiftregroup_name                 = '';
if (!empty($_POST['shiftregroup_year']) && !empty($_POST['shiftregroup_name'])) {
       $shiftregroup_year          = $_POST['shiftregroup_year'];
       $shiftregroup_name          = $_POST['shiftregroup_name'];
       $frameworks                 = "shiftregroup_year=" . "" . $shiftregroup_year . " &&shiftregroup_name=" . "" . $shiftregroup_name . "";
} else if (empty($_POST['shiftregroup_year']) && !empty($_POST['shiftregroup_name'])) {
       $shiftregroup_year          = $_POST['shiftregroup_year'];
       $shiftregroup_name          = $_POST['shiftregroup_name'];
       $frameworks                 = "shiftregroup_name=" . "" . $shiftregroup_name . "";
} else if (!empty($_POST['shiftregroup_year']) && empty($_POST['shiftregroup_name'])) {
       $shiftregroup_year          = $_POST['shiftregroup_year'];
       $shiftregroup_name          = $_POST['shiftregroup_name'];
       $frameworks                 = "shiftregroup_year=" . "" . $shiftregroup_year . "";
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
                                                 <div class="col-4 name">Shift Group Name</div>
                                                 <div class="col-sm-8">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off" autofocus="on" name="shiftregroup_name" id="shiftregroup_name" type="Text" value="<?php echo $shiftregroup_name; ?>" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-4 name">Shift Year</div>
                                                 <div class="col-sm-8">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="shiftregroup_year" name="shiftregroup_year" id="shiftregroup_year" type="Text" value="<?php echo $shiftregroup_year; ?>" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
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



<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>


<script type="text/javascript">
       $(document).ready(function() {
              $('#modal_leave_start').bootstrapMaterialDatePicker({
                     time: false,
                     clearButton: true
              });

              $('#modal_leave_end').bootstrapMaterialDatePicker({
                     time: false,
                     clearButton: true
              });

              $('#inp_pdtype_starttime').bootstrapMaterialDatePicker({
                     date: false,
                     format: 'HH:mm'
              });

              $('#inp_pdtype_endtime').bootstrapMaterialDatePicker({
                     date: false,
                     format: 'HH:mm'
              });
       });
</script>

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


<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>


<div class="col-md-8">
       <div class="card">
              <div class="card-header d-flex align-items-center">
                     <h4 class="card-title mb-0">Calibration </h4>


                     <div class="card-actions ml-auto">
                            <table>
                                   <td>
                                          <a href='#' class='open_modal_search' class="btn btn-demo" data-toggle="modal" data-target="#myModal2">
                                                 <div class="toolbar sprite-toolbar-search" id="SEARCH" title="Search">
                                                 </div>
                                          </a>
                                   </td>
                                   <!-- AgusPrass 02/03/2021 Menghapus # pada href-->
                                   <td>
                                          <div class="toolbar sprite-toolbar-reload" id="RELOAD" title="Reload" onclick="RefreshPage();">
                                          </div>
                                   </td>
                                   <!-- AgusPrass 02/03/2021 -->
                            </table>



                     </div>
              </div>

              <div class="card-body table-responsive p-0" style="width: 100vw;height: 78vh; width: 98.8%; margin: 5px;overflow: scroll;">
                     <table id="datatable" width="100%" border="1" align="left" class="table table-bordered table-striped table-hover table-head-fixed">
                            <thead>
                                   <tr>
                                          <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No.</th>
                                          <th class="fontCustom" style="z-index: 1;">Emp No.</th>
                                          <th class="fontCustom" style="z-index: 1;">Full Name</th>
                                          <th class="fontCustom" style="z-index: 1;">Performance Grade</th>
                                          <th class="fontCustom" style="z-index: 1;">Action</th>
                                   </tr>
                            </thead>
                     </table>

              </div>
       </div>
</div>
<div class="col-4">
       <div class="card">
              <div class="card-header d-flex align-items-center">
                     <h4 class="card-title mb-0">Probability Desnsity </h4>


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

              <div style="width: 90%;height: 78vh; margin: 5px;overflow: scroll;">
                <div id="charting"></div>
              </div>
       </div>
</div>










<!-- add modal -->
<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="UpdateForm">
       <div class="modal-dialog modal-belakang modal-bg" role="document">
              <div class="modal-content">
                     <div class="modal-header">
                            <h4 class="modal-title">Edit Calendar Schedule </h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <form class="form-horizontal" action="php_action/FuncDataUpdate.php" method="POST" id="UpdateFormContent">

                            <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

                                   <fieldset id="fset_1">
                                          <legend>Calibration Form</legend>

                                          <div class="messages_create"></div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Shift Employee</div>
                                                 <div class="col-sm-8">
                                                        <div class="input-group">
                                                               <input class="input--style-6 sel_emp_no" name="sel_emp_no" style="width: 100%;height: 30px;" id="sel_emp_no" value="">
                                                               <input class="input--style-6 sel_request_no" type="hidden" name="sel_request_no" style="width: 100%;height: 30px;" id="sel_request_no" value="">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Select Grade</div>
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
</script>




<!-- isi JSON -->
<script type="text/javascript">
       // global the manage memeber table 
       $(document).ready(function() {

              $("#charting").load("php_action/dota.php",
                     function(responseTxt, statusTxt, jqXHR) {
                            if (statusTxt == "success") {
                                   $("#charting").show();
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
                     $.ajax({
                            url: 'php_action/getSelectedRequest.php<?php echo $getPackage; ?>',
                            type: 'post',
                            data: {
                                   key: id
                            },
                            dataType: 'json',
                            success: function(response) {

                                   mymodalss.style.display = "none";

                                   $("#sel_emp_no").val(response.request_for);
                                   $("#sel_request_no").val(response.ipp_reqno);
                                   $("#sel_grade").val(response.pa_grade);
                           
                                   $("#UpdateFormContent").unbind('submit').bind('submit', function() {
                                          
                                          var form = $(this);

                                          var sel_request_no = $("#sel_request_no").val();
                                          var sel_grade = $("#sel_grade").val();
                                       

                                          var regex = /^[a-zA-Z]+$/;

                                          if (sel_request_no == '') {
                                                 mymodalss.style.display = "none";
                                                 modals.style.display = "block";
                                                 document.getElementById("msg").innerHTML = "Requests no empty";
                                                 return false;

                                          } else if (sel_grade == '') {
                                                 mymodalss.style.display = "none";
                                                 modals.style.display = "block";
                                                 document.getElementById("msg").innerHTML = "Grade empty";
                                                 return false;

                                          } 

                                          if (sel_request_no && sel_grade) {

                                                 mymodalss.style.display = "block";

                                                 $.ajax({
                                                        url: form.attr('action'),
                                                        type: form.attr('method'),
                                                        data: form.serialize(),
                                                        dataType: 'json',
                                                        success: function(response) {
                                                               
                                                               if (response.code == 'success_message') {

                                                                      mymodalss.style.display = "none";
                                                                      mymodals.style.display = "block";
                                                                      document.getElementById("msg").innerHTML = response.messages;

                                                                      // reset the form
                                                                      $("#FormDisplayCreate")[0].reset();
                                                                      // reload the datatables
                                                                      datatable.ajax.reload(null, false);
                                                                      // this function is built in function of datatables;

                                                               } else {
                                                                      $('#submit_approval_spvdown').show();
                                                                      $('#submit_approval_spvdown2').hide();

                                                                      mymodalss.style.display = "none";

                                                                      modals.style.display = "block";
                                                                      document.getElementById("msg").innerHTML = response.messages;
                                                                      // reload the datatables      
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
       };









       function PatternForm(id = null) {
              mymodalss.style.display = "block";

              alert(id);

              if (id) {
                     $.ajax({
                            url: 'php_action/getSelectedRequest.php<?php echo $getPackage; ?>',
                            type: 'post',
                            data: {
                                   key: id
                            },
                            dataType: 'json',
                            success: function(response) {
                                   mymodalss.style.display = "none";
                                   $("#box_view_calendar").load("pages_relation/_fetch_data_calendar_view.php<?php echo $getPackage; ?>rfid=" + response.shiftregroup_name,
                                          function(responseTxt, statusTxt, jqXHR) {
                                                 if (statusTxt == "success") {
                                                        $("#box_view_calendar").show();
                                                 }
                                                 if (statusTxt == "error") {
                                                        alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                                 }
                                          }
                                   );
                            } // /success
                     }); // /fetch selected member info

              } else {
                     alert("Error : Refresh the page again");
              }
       };
</script>
<!-- isi JSONs -->
</body>

</html>