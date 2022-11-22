<?php  
       $src_cost_code                   = '';
       $src_reason_name_en                = '';
       if (!empty($_POST['src_cost_code']) && !empty($_POST['src_reason_name_en'])) {
              $src_cost_code            = $_POST['src_cost_code'];
              $src_reason_name_en         = $_POST['src_reason_name_en'];
              $frameworks                 = "?src_cost_code="."".$src_cost_code." &&src_reason_name_en="."".$src_reason_name_en."";
       } else if (empty($_POST['src_cost_code']) && !empty($_POST['src_reason_name_en'])) {
              $src_cost_code            = $_POST['src_cost_code'];
              $src_reason_name_en         = $_POST['src_reason_name_en'];
              $frameworks                 = "?src_reason_name_en="."".$src_reason_name_en."";
       } else if (!empty($_POST['src_cost_code']) && empty($_POST['src_reason_name_en'])) {
              $src_cost_code            = $_POST['src_cost_code'];
              $src_reason_name_en         = $_POST['src_reason_name_en'];
              $frameworks                 = "?src_cost_code="."".$src_cost_code."";
       }
?>
<!-- Modal -->
<div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2"
       data-backdrop="false">
       <div class="modal-dialog" role="document">
              <div class="modal-content">
                     <div class="modal-body">

                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                            <form>
                                   <fieldset id="fset_1"
                                          style="margin-top: 25px;border-radius: 5px;border: 1px solid #e4e8ea;">
                                          <legend>Searching</legend>
                                          <div class="form-row">
                                                 <div class="col-4 name">Cost code</div>
                                                 <div class="col-sm-8">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off"
                                                                      autofocus="on" id="src_cost_code"
                                                                      name="src_cost_code" id="src_cost_code"
                                                                      type="Text" value="GAP" onfocus="hlentry(this)"
                                                                      size="30" maxlength="50" 
                                                                      validate="NotNull:Invalid Form Entry"
                                                                      onchange="formodified(this);" title="">
                                                        </div>
                                                 </div>
                                          </div>

                                            
                                   </fieldset>
                                   <button type="submit" data-dismiss="modal" aria-label="Close" name="submit_filter"
                                          id="submit_filter" type="button" class="btn btn-warning button_bot">
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
<script type="text/javascript"
       src="../../asset/sdk_datatables_core/datatables/bedanihbuatjson/bootstrap/js/bootstrap.min.js"></script>
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
              searching: false,
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
              "ajax": "php_action/FuncDataRead.php<?php echo $frameworks; ?>"
       });
});
</script>


<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>




<!-- Modal -->
<div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2"
       data-backdrop="false">
       <div class="modal-dialog" role="document">
              <div class="modal-content">
                     <div class="modal-body">

                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                            <form>
                                   <fieldset id="fset_1"
                                          style="margin-top: 25px;border-radius: 5px;border: 1px solid #e4e8ea;">
                                          <legend>Searching</legend>
                                          <div class="form-row">
                                                 <div class="col-4 name">Cost code</div>
                                                 <div class="col-sm-8">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off"
                                                                      autofocus="on" id="src_cost_code"
                                                                      name="src_cost_code" id="src_cost_code"
                                                                      type="Text" value="GAP" onfocus="hlentry(this)"
                                                                      size="30" maxlength="50" 
                                                                      validate="NotNull:Invalid Form Entry"
                                                                      onchange="formodified(this);" title="">
                                                        </div>
                                                 </div>
                                          </div>
                                   </fieldset>
                                   <button type="submit" data-dismiss="modal" aria-label="Close" name="submit_filter"
                                          id="submit_filter" type="button" class="btn btn-warning button_bot">
                                          Filter
                                   </button>
                            </form>
                     </div>
              </div><!-- modal-content -->
       </div><!-- modal-dialog -->
</div><!-- modal -->

<div class="col-md-12">
       <div class="card">
              <div class="card-header d-flex align-items-center">
                     <h4 class="card-title mb-0">Shift Daily Upload </h4>


                     <div class="card-actions ml-auto">
                            <table>
                                   <td>
                                          <a href='#'>
                                                 <div class="toolbar sprite-toolbar-reload" id="RELOAD" title="Reload"
                                                        onclick="RefreshPage();">
                                                 </div>
                                          </a>
                                   </td>
                                   <!-- AgusPrass 02/03/2021 -->
                            </table>
                     </div>
              </div>


              <div class="card-body table-responsive p-0"
                     style="width: 100vw;height: 78vh; width: 98%; margin: 5px;overflow: scroll;">
                     <script type="text/javascript">
                     function validateForm() {
                            function hasExtension(inputID, exts) {
                                   var fileName = document.getElementById(inputID).value;
                                   return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(
                                   fileName);
                            }
                          
                     }
                     </script>

                     <form name="myForm" id="myForm" enctype="multipart/form-data"
                            action="php_action/FuncDataUpload.php" method="post" target="popupwindow"
                            onsubmit=" return validateForm(), window.open('php_action/FuncDataUpload.php', 'popupwindow', 'scrollbars=yes,toolbar=no,width=800,height=400');">

                            <fieldset id="fset_1">
                                   <legend>Attendance Upload</legend>

                                   <div class="form-row">
                                          <div class="col-sm-4 name">Machine Code <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <select readonly id="inp_machine_code" name="inp_machine_code"
                                                               onfocus="hlentry(this)" onchange="formodified(this);"
                                                               style="width:undefined;width: 160px;border: 1px solid #cac2c2;text-align: left;color: #484545;padding: 5px;">
                                                               <?php
                                                                      $sql = mysqli_query($connect, "SELECT machine_code FROM hrmattmachine");
                                                                      $row = mysqli_num_rows($sql);
                                                                      while ($row = mysqli_fetch_array($sql)){
                                                                      echo "<option value='". $row['machine_code'] ."'>" .$row['machine_code'] ."</option>" ;
                                                               }
                                                               ?>
                                                        </select>
                                                 </div>
                                          </div>
                                   </div>


                                   <div class="form-row">
                                          <div class="col-sm-4 name">Upload Type </div>
                                          <div class="col-sm-8">
                                                 <div class="input-group" style="margin-left: -15px;">
                                                        <div class="form-check form-check-inline">
                                                               <div class="custom-control custom-radio">
                                                                      <input type="radio" name="inp_upload_type"
                                                                             value="SH" checked="checked"
                                                                             class="custom-control-input"
                                                                             id="customControlValidation2"
                                                                             name="radio-stacked">
                                                                      <label class="custom-control-label"
                                                                             for="customControlValidation2">Upload</label>
                                                               </div>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                               <div class="custom-control custom-radio">
                                                                      <input type="radio" name="inp_upload_type"
                                                                             value="RM" class="custom-control-input"
                                                                             id="customControlValidation3"
                                                                             name="radio-stacked">
                                                                      <label class="custom-control-label"
                                                                             for="customControlValidation3">Reprocess
                                                                      </label>
                                                               </div>
                                                        </div>

                                                 </div>
                                          </div>
                                   </div>


                                   <div class="form-row" id="start_form" style="display:none;">
                                          <div class="col-sm-4 name">Attend date</div>
                                          <div class="col-sm-3">
                                                 <div class="card-body table-responsive p-0"
                                                        style="overflow: scroll;overflow-x: hidden;">
                                                        <td>
                                                               <input type="text" 
                                                                      id="inp_startdate" 
                                                                      name="inp_startdate" 
                                                                      class="input--style-6"
                                                                      style="
                                                                      background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                      background-size: 17px;
                                                                      background-position:right;   
                                                                      background-repeat:no-repeat; 
                                                                      padding-right:10px;  
                                                                      " />
                                                        </td>
                                                 </div>
                                          </div>
                                          <div class="col-sm-3">
                                                 <div class="card-body table-responsive p-0"
                                                        style="overflow: scroll;overflow-x: hidden;">
                                                        <td>
                                                               <input type="text" 
                                                                      id="inp_enddate" 
                                                                      name="inp_enddate" 
                                                                      class="input--style-6"
                                                                      style="
                                                                      background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                      background-size: 17px;
                                                                      background-position:right;   
                                                                      background-repeat:no-repeat; 
                                                                      padding-right:10px;  
                                                                      " />
                                                        </td>
                                                 </div>
                                          </div>
                                   </div>

                              
                                  

                                   <div class="form-row" id="show_employee" style="display:none;">
                                          <div class="col-11 name">Employee</div>
                                          <div class="col-sm-1" style="padding-left: 55px;">
                                                 <div class="card-body table-responsive p-0"
                                                        style="overflow: scroll;overflow-x: hidden;">
                                                        <td>
                                                               <a href='#' class='open_modal_search'
                                                                      class="btn btn-demo" data-toggle="modal"
                                                                      data-target="#myModal2">
                                                                      <div class="toolbar sprite-toolbar-search"
                                                                             id="SEARCH" title="Search">
                                                                      </div>
                                                               </a>
                                                        </td>
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row" id="show_employees" style="display:none;">
                                          <div class="col-4 name"></div>
                                          <div class="col-sm-8">

                                                        <div class="card-body table-responsive p-0" style="width: 100vw;height: 30vh; width: 100%; overflow: scroll;overflow-x: hidden;border:1px solid #d2d2d2;border-radius: 4px;">
                                                               <div id="box"></div>
                                                               <div id="box_with"></div>
                                                        </div>
                                          </div>
                                   </div>

                                   <div class="form-row" id="upload_form">
                                          <div class="col-sm-4 name">Upload Excel File <span class="required">*</span>
                                          </div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">
                                                        <input type="file" id="attendanceuploadprocess"
                                                               name="attendanceuploadprocess" />
                                                        <input name="date" class="hidden" type="hidden"
                                                               value="<?php echo date('Y-m-d H:i:s') ?>">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name"> </div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">
                                                        <button type="submit" name="submit" style="width: 135px;"
                                                               value="Upload"
                                                               class="btn btn-rounded btn-warning btn-sm text-white d-inline-block">Process</button><br />
                                                 </div>
                                          </div>
                                   </div>
                            </fieldset>
                     </form>


                     <fieldset id="SHT">
                            <legend>Template</legend>

                            <table align="center" width="80%">
                                   <tbody>
                                          <tr>
                                                 <td>
                                                        <table align="center" class="darea listingTable"
                                                               style="height:58px;">
                                                               <tbody>
                                                                      <tr>
                                                                             <th
                                                                                    style="width: 100%; background-color: rgb(170, 170, 170);">
                                                                                    File Template for Upload</th>
                                                                      </tr>
                                                                      <tr>
                                                                             <td>File Extensions : .xls[Excel]</td>
                                                                      </tr>
                                                               </tbody>
                                                        </table>

                                                        <table align="center" class="darea listingTable"
                                                               style="width:100%">
                                                               <tbody>
                                                                      <tr>
                                                                             <th colspan="5"
                                                                                    style="background-color: rgb(170, 170, 170);">
                                                                                    File Template for Upload</th>
                                                                      </tr>
                                                                      <tr>
                                                                             <td>Columns</td>
                                                                             <td>EmpNo</td>
                                                                             <td>Attend_Date</td>
                                                                             <td>Attend_Time</td>
                                                                             <td>Attend_Status</td>
                                                                      </tr>
                                                                      <tr>
                                                                             <td>Field Type</td>
                                                                             <td>AttendanceId</td>
                                                                             <td>Date_Format</td>
                                                                             <td>Time_Format</td>
                                                                             <td>Status</td>
                                                                      </tr>
                                                                      <tr>
                                                                             <td>Column Description</td>
                                                                             <td>Employee_no</td>
                                                                             <td>Attendance_Date</td>
                                                                             <td>Attendance_Time</td>
                                                                             <td>Attendance_Status</td>
                                                                      </tr>
                                                                      <tr>
                                                                             <td>Length</td>
                                                                             <td>25 Character(s)</td>
                                                                             <td>10 Character(s)</td>
                                                                             <td>5 Character(s)</td>
                                                                             <td>1 Character(s)</td>
                                                                      </tr>
                                                               </tbody>
                                                        </table>

                                                        <table align="center" class="darea listingTable"
                                                               style="width:50%">
                                                               <tbody>
                                                                      <tr>
                                                                             <th colspan="2"
                                                                                    style="background-color: rgb(170, 170, 170);">
                                                                                    Attendance Status</th>
                                                                      </tr>
                                                                      <tr>
                                                                             <td>In</td>
                                                                             <td>: 1</td>
                                                                      </tr>
                                                                      <tr>
                                                                             <td>Out</td>
                                                                             <td>: 0</td>
                                                                      </tr>
                                                               </tbody>
                                                        </table>
                                                 </td>
                                          </tr>
                                   </tbody>
                            </table>
                     </fieldset>
              </div>
       </div>
</div>













<!-- isi JSON -->
<script type="text/javascript">
// global the manage memeber table 
$(document).ready(function() {
       $("#customControlValidation3").on('click', function() {
              var src_cost_code = $("#src_cost_code").val();

              mymodalss.style.display = "block";
              //For empty multiselect
              $('#test-select-4s1').val(null).trigger("change");
              //For empty multiselect
              $("#box_with").hide();
              $("#box").load("pages_relation/_pages_setting.php?token=" + '0' + "&rfid2=" +
                     src_cost_code,
                     function(responseTxt, statusTxt, jqXHR) {
                            if (statusTxt == "success") {
                                   $("#show_employee").show();
                                   $("#show_employees").show();
                                   $("#start_form").show();

                                   $("#upload_form").hide();

                                   $("#box").show();
                                   if ($("#box").show()) {
                                          mymodalss.style.display = "none";
                                   }
                            }
                            if (statusTxt == "error") {
                                   alert("Error: " + jqXHR.status + " " + jqXHR
                                          .statusText);
                            }
                     }
              );

              $("#submit_filter").on('click', function() {
                     //For empty multiselect
                     $('#test-select-4s0').val(null).trigger("change")
                     //For empty multiselect
                     $("#box").hide();
                     mymodalss.style.display = "block";

                     var leave_status = $("#leave_status").val();
                     var list_ofleave = $("#list_ofleave").val();
                     var src_cost_code = $("#src_cost_code").val();

                     $("#box_with").load(
                            "pages_relation/_pages_setting.php?rfid=" +
                            leave_status + "&rfid1=" + list_ofleave +
                            "&token=" + '1' + "&rfid2=" +
                            src_cost_code,
                            function(responseTxt, statusTxt, jqXHR) {
                                   if (statusTxt == "success") {
                                          $("#show_employee").show();
                                          $("#show_employees").show();
                                          $("#start_form").show();

                                          $("#upload_form").hide();

                                          $("#box_with").show();
                                          if ($("#box_with").show()) {
                                                 mymodalss.style
                                                        .display =
                                                        "none";
                                          }
                                   }
                                   if (statusTxt == "error") {
                                          alert("Error: " + jqXHR
                                                 .status + " " +
                                                 jqXHR
                                                 .statusText);
                                   }
                            }
                     );
              });

       }); // /add modal
});



$(document).ready(function() {
       $("#customControlValidation2").on('click', function() {
              $("#show_employee").hide();
              $("#show_employees").hide();
              $("#start_form").hide();

              $("#upload_form").show();

              $("#box_with").hide();
              $("#box").hide();
       }); // /add modal
});
</script>
<!-- isi JSONs -->








































</body>

</html>

  <script type="text/javascript">
              $(document).ready(function() {
                     $('#inp_startdate').bootstrapMaterialDatePicker({
                            time: false,
                            clearButton: true
                     });

                     $('#inp_enddate').bootstrapMaterialDatePicker({
                            time: false,
                            clearButton: true
                     });

                     $('#inp_starttime').bootstrapMaterialDatePicker({
                            date: false,
                            format: 'HH:mm'
                     });

                     $('#inp_endtime').bootstrapMaterialDatePicker({
                            date: false,
                            format: 'HH:mm'
                     });
              });
</script>