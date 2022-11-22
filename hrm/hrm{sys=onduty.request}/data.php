<?php
$src_training_request                     = '';
$src_training_request_cancel              = '';
if (!empty($_POST['src_training_request']) && !empty($_POST['src_training_request_cancel'])) {
       $src_training_request              = $_POST['src_training_request'];
       $src_training_request_cancel       = $_POST['src_training_request_cancel'];
       $frameworks                        = "src_training_request=" . "" . $src_training_request . " &&src_training_request_cancel=" . "" . $src_training_request_cancel . "";
} else if (empty($_POST['src_training_request']) && !empty($_POST['src_training_request_cancel'])) {
       $src_training_request              = $_POST['src_training_request'];
       $src_training_request_cancel       = $_POST['src_training_request_cancel'];
       $frameworks                        = "src_training_request_cancel=" . "" . $src_training_request_cancel . "";
} else if (!empty($_POST['src_training_request']) && empty($_POST['src_training_request_cancel'])) {
       $src_training_request              = $_POST['src_training_request'];
       $src_training_request_cancel       = $_POST['src_training_request_cancel'];
       $frameworks                        = "src_training_request=" . "" . $src_training_request . "";
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
                                                 <div class="col-4 name">Training Request</div>
                                                 <div class="col-lg-8">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="src_training_request" name="src_training_request" id="src_training_request" type="Text" value="<?php echo $src_training_request; ?>" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row" style="display:none;">
                                                 <div class="col-4 name">Leave Cancel Request</div>
                                                 <div class="col-lg-8">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off" autofocus="on" name="src_training_request_cancel" id="src_training_request_cancel" type="Text" value="<?php echo $src_training_request_cancel; ?>" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
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
              $('#inp_add_startdate').bootstrapMaterialDatePicker({
                     time: false,
                     clearButton: true
              });

              $('#inp_add_enddate').bootstrapMaterialDatePicker({
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
              datatable = $("#datatable<?php echo $platform; ?>").DataTable({

                     dom: "B<'row'<'col-lg-12 col-md-9'l><'col-lg-12 col-md-9'f>>" +
                            "<'row'<'col-lg-12'tr>>" +
                            "<'row'<'col-lg-12 col-md-6'i><'col-lg-12 col-md-7'p>>",

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
                     "ajax": "php_action/FuncDataRead<?php echo $platform; ?>.php<?php echo $getPackage; ?><?php echo $frameworks; ?>"
              });
       });
</script>



<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>


<?php
if ($platform != 'mobile') {
?>

       <div class="col-md-12">
              <div class="card">
                     <div class="card-header d-flex align-items-center">
                            <h4 class="card-title mb-0">Onduty Request </h4>

                     <?php } else if ($platform == 'mobile') { ?>

                            <div class="col-md-12">
                                   <div class="card" style="border-radius: 20px 20px 20px 20px;margin-bottom: 25px;">
                                          <div class="card-header d-flex align-items-center" style="border-bottom: 1px solid white;">
                                                 <h4 class="card-title mb-0">Onduty Request </h4>
                                          <?php } ?>


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

                                                        <td>
                                                               <div class="toolbar sprite-toolbar-add" title="Add" data-toggle="modal" data-target="#CreateForm" id="CreateButton" data-keyboard="false" data-backdrop="static">
                                                                      <!-- <a title="add" href="" class="toolbar sprite-toolbar-add" data-toggle="modal" data-target="#CreateForm" id="CreateButton" data-keyboard="false" data-backdrop="static">tambah</a> -->
                                                               </div>
                                                        </td>

                                                 </table>



                                          </div>
                                          </div>




                                          <?php
                                          if ($platform != 'mobile') {
                                          ?>
                                                 <div class="card-body table-responsive p-0" style="width: 100vw;height: 78vh; width: 98.8%; margin: 5px;overflow: scroll;">
                                                        <table id="datatable" width="100%" border="1" align="left" class="table table-bordered table-striped table-hover table-head-fixed">
                                                               <thead>
                                                                      <tr>
                                                                             <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No</th>
                                                                             <th class="fontCustom" style="z-index: 1;">Request Number</th>
                                                                             <th class="fontCustom" style="z-index: 1;">Request For</th>
                                                                             <th class="fontCustom" style="z-index: 1;">Purpose Type</th>
                                                                             <th class="fontCustom" style="z-index: 1;">Start Date</th>
                                                                             <th class="fontCustom" style="z-index: 1;">End Date</th>
                                                                             <th class="fontCustom" style="z-index: 1;">Total Destination</th>
                                                                             <th class="fontCustom" style="z-index: 1;">Request Status</th>
                                                                             <th class="fontCustom" style="z-index: 1;">Remark</th>
                                                                      </tr>
                                                               </thead>
                                                        </table>
                                                 </div>

                                                 <div class='card-footer' style='background-color: #eee;height: 37px;padding-top: 5px;'></div>

                                          <?php } else if ($platform == 'mobile') { ?>

                                                 <div class="col-sm-12 name">
                                                        <div class="progress-container progress-info">
                                                               <div class="col-sm-5 name">
                                                                      <span class="progress-badge" style="font-size: 10px;font-family: verdana;font-weight: bold;letter-spacing: -0.9px; color:#cacaca !important;">Leave Balance <br> Annual Leave&nbsp;&nbsp;&nbsp; <?php echo $leave['total']; ?> / <?php echo $leave['total_entitlement']; ?></span>
                                                               </div>
                                                               <div class="progress">
                                                                      <div class="progress-bar progress-bar-info1" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $leave['daty']; ?>%;cursor: pointer;" data-toggle="modal" data-target="#LeaveBalances" data-backdrop="static" onclick="BalancesDetail(`ANL`)">
                                                                      </div>
                                                               </div>
                                                        </div>
                                                 </div>

                                                 <br>

                                                 <div class="card-body table-responsive p-0" style="width: 90vw;height: 78vh; margin: 5px;overflow: hidden;border: 1px solid white;">
                                                        <table id="datatablemobile" width="100%" align="left">
                                                               <thead style="display:none;">
                                                                      <tr>
                                                                             <th class="fontCustom" style="z-index: 1;" nowrap="nowrap"></th>
                                                                      </tr>
                                                               </thead>
                                                        </table>
                                                 <?php } ?>
                                                 </div>
                                   </div>
                            </div>











                            <!-- add modal -->
                            <div class="modal  fade fade-custom" tabindex="-1" role="dialog" id="CreateForm">
                                   <div class="modal-dialog modal-belakang modal-bg" role="document">
                                          <div class="modal-content">
                                                 <div class="modal-header">
                                                        <h4 class="modal-title" id="revised_title">Add On Duty Request</h4>
                                                        <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                                               <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                                                        </a>
                                                 </div>

                                                 <form class="form-horizontal" method="POST" id="FormDisplayCreate" onkeydown="return event.key != 'Enter';">

                                                        <style>
                                                               body {
                                                                      font-family: Arial;
                                                               }

                                                               /* Style the tab */
                                                               .tab {
                                                                      overflow: hidden;
                                                                      border: 1px solid #ccc;
                                                                      background-color: #fff;
                                                                      border-bottom: 1px solid #ececec;
                                                               }

                                                               /* Style the buttons inside the tab */
                                                               .tab button {
                                                                      background-color: inherit;
                                                                      float: left;
                                                                      border: none;
                                                                      outline: none;
                                                                      cursor: pointer;
                                                                      padding: 14px 16px;
                                                                      transition: 0.3s;
                                                                      font-size: 12px;
                                                                      border-bottom: 3px solid #fff;
                                                               }

                                                               /* Change background color of buttons on hover */
                                                               .tab button:hover {
                                                                      background-color: #fff;
                                                                      border-bottom: 3px solid #fff;
                                                               }

                                                               /* Create an active/current tablink class */
                                                               .tab button.active {
                                                                      background-color: #fff;
                                                                      border-bottom: 3px solid #259dd4;
                                                               }

                                                               /* Style the tab content */
                                                               .tabcontent {
                                                                      display: none;
                                                                      padding: 6px 12px;
                                                                      border: 1px solid #ccc;
                                                                      border-top: none;
                                                               }
                                                        </style>

                                                        <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

                                                               <fieldset id="fset_1">
                                                                      <legend>On Duty Entry Form</legend>

                                                                      <div class="messages_create"></div>

                                                                      <div class="form-row" id="frm_employee_no">
                                                                             <div class="col-lg-3 name">On Duty Purpose Type <font color="red">*</font>
                                                                             </div>
                                                                             <div class="col-lg-4">
                                                                                    <div class="input-group">
                                                                                           <input type="hidden" name="inp_emp_no" value="<?php echo $username; ?>">
                                                                                           <select class="input--style-6 modal_leave" name="inp_purpose_type" style="width: 80%;height: 30px;" id="inp_purpose_type" onchange="isi_otomatis_leave()">
                                                                                                  <option value="">--Select One--</option>
                                                                                                  <?php
                                                                                                  $sql = mysqli_query($connect, "SELECT 
                                                                                                  a.purpose_code,
                                                                                                  a.purpose_name_en
                                                                                                  FROM 
                                                                                                  hrmondutypurposetype a
                                                                                                  ORDER BY a.purpose_code ASC");
                                                                                                  while ($row = mysqli_fetch_array($sql)) {
                                                                                                         echo '<option value="' . $row['purpose_code'] . '">' . $row['purpose_name_en'] . '</option>';
                                                                                                  }
                                                                                                  ?>
                                                                                           </select>
                                                                                    </div>
                                                                             </div>
                                                                      </div>

                                                                      <?php
                                                                      $emp = mysqli_fetch_array(mysqli_query($connect, "SELECT full_name, pos_name_en FROM view_employee WHERE emp_no='$username'"));
                                                                      ?>

                                                                      <div class="form-row" id="frm_employee_no">
                                                                             <div class="col-sm-3 name">Request For <font color="red">*</font>
                                                                             </div>
                                                                             <div class="col-sm-5">
                                                                                    <div class="input-group">
                                                                                           <input class="input--style-6 search-input" onkeyup="isi_otomatis(), isi_otomatis_leave()" onfocus="this.value=''" autocomplete="off" autofocus="on" id="modal_emp" name="modal_emp" type="Text" value=" <?php echo $username; ?> [ <?php echo $emp['full_name']; ?> ] <?php echo $emp['pos_name_en']; ?>" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                                                                           <div id="employeeList"></div>
                                                                                    </div>
                                                                             </div>
                                                                      </div>

                                                                      <div class="form-row" id="frm_employee_no">
                                                                             <div class="col-lg-3 name">remark <font color="red">*</font>
                                                                             </div>
                                                                             <div class="col-lg-8">
                                                                                    <div class="input-group">
                                                                                           <textarea class="input--style-6 search-input" onfocus="this.value=''" autocomplete="off" id="inp_topic" name="inp_topic" type="Text" value="" title=""></textarea>
                                                                                    </div>
                                                                             </div>
                                                                      </div>

                                                                      <div class="form-row" id="frm_employee_no">
                                                                             <div class="col-lg-3 name">File Attachment <font color="red">*</font>
                                                                             </div>
                                                                             <div class="col-lg-5">
                                                                                    <div class="input-group">
                                                                                           <input type="file" name="fileupload" id="fileupload" class="form-control">
                                                                                    </div>
                                                                             </div>
                                                                      </div>

                                                                      <div class="form-row" id="show_employees">
                                                                             <div class="col-3 name">File Extension</div>
                                                                             <div class="col-lg-8">
                                                                                    doc,jpg,ods,png,txt,doc,pdf
                                                                             </div>
                                                                      </div>
                                                               </fieldset>

                                                               <fieldset id="fset_1">
                                                                      <legend>Destination</legend>
                                                                      <table width="100%">
                                                                             <tbody>
                                                                                    <tr>
                                                                                           <td>
                                                                                                  <h3 class="multisteps-form__title"></h3>
                                                                                           </td>
                                                                                           <td>
                                                                                                  <button class="btn btn-primary ml-auto" data-toggle="modal" data-target="#DestinationForm" id="FamilyAddForms" data-keyboard="false" onclick="DestinationForm(`add`)" data-backdrop="static" style="width: 100%;border-radius: 103px;font-size: 10px;background: #74614a;border: 1px solid #74614a;" type="button">Add Destination
                                                                                                  </button>
                                                                                           </td>
                                                                                           <td text-align:="" right;="">
                                                                                           </td>
                                                                                    </tr>
                                                                             </tbody>
                                                                      </table>


                                                                      <div class="card-body table-responsive p-0" style="height: 50vh; width: 98.8%; margin: 5px;overflow-y: auto;overflow-x: hidden;border: 1px solid white;">

                                                                             <div class="multisteps-form__content">
                                                                                    <div class="form-row">
                                                                                           <div class="col-sm-12">
                                                                                                  <div id="destination_list"></div>
                                                                                           </div>
                                                                                    </div>
                                                                             </div>
                                                                      </div>
                                                               </fieldset>
                                                        </div>

                                                        <!-- //LOAD BUTTON APPROVER STATUS -->
                                                        <div class="modal-footer-sdk" id="modalcancelcondition_0" style="display:none">
                                                               <button type="reset" class="btn-sdk btn-primary-left" data-dismiss="modal" aria-hidden="true">
                                                                      &nbsp;Cancel&nbsp;
                                                               </button>
                                                               <button class="btn-sdk btn-primary-right" type="submit" name="submit_update" id="submit_update">
                                                                      Confirm
                                                               </button>
                                                        </div>
                                                        <div class="modal-footer-sdk" id="modalcancelcondition_1">
                                                               <div type="reset" class="shine btn-sdk btn-primary-center-only" data-dismiss="modal" style="padding-top: 8px;" aria-hidden="true">
                                                                      &nbsp;Close&nbsp;
                                                               </div>
                                                        </div>
                                                        <div class="modal-footer-sdk" id="modalcancelcondition_2" style="display:none">
                                                               <button type="reset" class="btn-sdk btn-primary-center-only" data-dismiss="modal" aria-hidden="true">
                                                                      &nbsp;Close&nbsp;
                                                               </button>
                                                        </div>
                                                        <div class="modal-footer-sdk" id="modalcancelcondition_3" style="display:none">
                                                               <button type="reset" class="btn-sdk btn-primary-not-only-left" data-dismiss="modal" aria-hidden="true">
                                                                      &nbsp;Cancel&nbsp;
                                                               </button>
                                                               <button class="btn-sdk btn-primary-center-not-only" type="submit" name="submit_update" id="submit_update">
                                                                      Confirm
                                                               </button>
                                                               <a id="cancellation_id" style="padding-top: 8px;" class="btn-sdk btn-primary-not-only-right delete" type="submit" name="submit_delete" id="submit_delete">
                                                                      Cancel
                                                               </a>
                                                        </div>


                                                        <!-- //LOAD BUTTON APPROVER STATUS -->

                                                        <!-- ==================================================================================================== -->
                                                        <!-- ==================================================================================================== -->
                                                        <input id="inp_emp_no" name="inp_emp_no" type="hidden" value="<?php echo $username; ?>">
                                                        <!--FROM SESSION -->
                                                        <input id="inp_token" name="inp_token" type="hidden" value="<?php echo $get_token; ?>">
                                                        <!--FROM CONFIGURATION -->
                                                        <input id="inp_requestfor" name="inp_requestfor" type="hidden">
                                                        <!--FROM CONFIGURATION -->
                                                        <input id="inp_leaverequestv" name="inp_leaverequestv" type="hidden">
                                                        <!--FROM CONFIGURATION -->
                                                        <input id="inp_daytype" name="inp_daytype" type="hidden">
                                                        <!--FROM CONFIGURATION -->
                                                        <input id="inp_summaryleavebalance" name="inp_summaryleavebalance" type="hidden">
                                                        <!--FROM CONFIGURATION -->
                                                        <input id="inp_deductedleave" name="inp_deductedleave" type="hidden">
                                                        <!--FROM CONFIGURATION -->
                                                        <!-- ==================================================================================================== -->
                                                        <!-- ==================================================================================================== -->

                                                 </form>
                                          </div>
                                   </div>
                            </div><!-- /.modal-dialog -->
                     </div><!-- /.modal -->
                     <!-- /edit modal -->












































                     <!-- add modal -->
                     <div class="modal  fade fade-custom" tabindex="-1" role="dialog" id="DestinationForm">
                            <div class="modal-dialog modal-belakang modal-bgkpi" role="document">
                                   <div class="modal-content" style="top: 10px;">
                                          <div class="modal-header">
                                                 <h4 class="modal-title">Add Destination</h4>
                                                 <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                                        <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                                                 </a>
                                          </div>

                                          <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

                                                 <form class="form-horizontal" action="php_action/FuncDataCreateAnswer.php" method="POST" id="FormAttendanceEdit" onkeydown="return event.key != 'Enter';">
                                                        <fieldset id="fset_1">
                                                               <legend>Detail Information</legend>
                                                               <div class="form-row">
                                                                      <div class="col-sm-2 name">Destination <span class="required">*</span></div>
                                                                      <div class="col-sm-3 name">
                                                                             <div class="input-group">
                                                                                    <input class="input--style-6 search-input" onfocus="this.value=''" autocomplete="off" id="inp_destination_code" name="inp_destination_code" type="Text" value="" title="" onchange="select_add_category()">

                                                                                    <div id="category_add_list"></div>

                                                                             </div>
                                                                      </div>
                                                               </div>

                                                               <div class="form-row" id="frm_employee_no">
                                                                      <div class="col-lg-2 name">Date Between <font color="red">*</font>
                                                                      </div>
                                                                      <div class="col-lg-2">
                                                                             <div class="input-group">
                                                                                    <input type="text" id="inp_add_startdate" name="inp_add_startdate" class="input--style-6" placeholder="Start Date" style="background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                             background-size: 17px;
                                                                             background-position:right;   
                                                                             background-repeat:no-repeat; 
                                                                             padding-right:10px;" autocomplete="off" />
                                                                             </div>
                                                                      </div>

                                                                      <div class="col-lg-2">
                                                                             <div class="input-group">
                                                                                    <input type="text" id="inp_add_enddate" name="inp_add_enddate" class="input--style-6" placeholder="End Date" style="background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                             background-size: 17px;
                                                                             background-position:right;   
                                                                             background-repeat:no-repeat;
                                                                             
                                                                             padding-right:10px;" autocomplete="off" />
                                                                             </div>
                                                                      </div>


                                                               </div>

                                                               <div class="form-row" id="frm_employee_no">
                                                                      <div class="col-lg-2 name">
                                                                      </div>
                                                                      <div class="col-lg-2">
                                                                             <div class="input-group">
                                                                                    <a class="btn btn-primary" type="submit" onclick="get_detail(`add`)" name="detail_destination" id="detail_destination" style="font-size: 10px;color: white;border-radius: 30px;width: 100px;background: #74614a;border-color: 1px solid transparent;">
                                                                                           Confirm
                                                                                    </a>
                                                                             </div>
                                                                      </div>
                                                               </div>

                                                               <div class="card-body table-responsive p-0" style="height: 50vh; width: 100%; overflow-y: scroll;overflow-x: hidden;border: 1px solid white;">
                                                                      <div class="form-row">
                                                                             <div class="col-sm-12">
                                                                                    <div id="attendance_list"></div>
                                                                             </div>
                                                                      </div>
                                                               </div>

                                                        </fieldset>
                                          </div>
                                          <div class="modal-footer-sdk">
                                                 <button type="reset" class="btn-sdk btn-primary-center-only" data-dismiss="modal" onclick="ResetTable();" aria-hidden="true">
                                                        &nbsp;Cancel&nbsp;
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
                            $("#CreateButton").on('click', function() {
                                   $('#frm_inp_course').hide();

                                   // mymodalss.style.display = "block";

                                   document.getElementById("revised_title").innerHTML = "Add Training Request";
                                   // reset the form
                                   $("#request_no").remove();

                                   $("#FormDisplayCreate")[0].reset();

                                   $("#modalcancelcondition_0").show();
                                   $("#modalcancelcondition_1").hide();
                                   $("#modalcancelcondition_2").hide();
                                   $("#modalcancelcondition_3").hide();
                                   // empty the message div

                                   // submit form

                                   $("#FormDisplayCreate").unbind('submit').bind('submit', function() {

                                          mymodalss.style.display = "block";

                                          $(".text-danger").remove();

                                          var form = $(this);

                                          var inp_emp_no = $("#inp_emp_no").val();
                                          var inp_destination_code = $("#inp_destination_code").val();
                                          var inp_topic = $("#inp_topic").val();
                                          var inp_add_startdate = $("#inp_add_startdate").val();
                                          var inp_add_enddate = $("#inp_add_enddate").val();
                                          var from = new Date(inp_add_startdate).getTime();
                                          var to = new Date(inp_add_enddate).getTime();
                                          var inp_venue = $("#inp_venue").val();
                                          var inp_room = $("#inp_room").val();
                                          var inp_cost = $("#inp_cost").val();
                                          var inp_reason = $("#inp_reason").val();

                                          var regex = /^[a-zA-Z]+$/;

                                          if (from > to) {
                                                 mymodalss.style.display = "none";
                                                 modals.style.display = "block";
                                                 document.getElementById("msg").innerHTML = "Entry Date: Enter Date in Proper Range";
                                                 return false;

                                          } else if (inp_destination_code == "") {
                                                 mymodalss.style.display = "none";
                                                 modals.style.display = "block";
                                                 document.getElementById("msg").innerHTML = "Please choose training category";
                                                 return false;

                                          } else if (!$("input[name='inp_course']:checked").val()) {
                                                 mymodalss.style.display = "none";
                                                 modals.style.display = "block";
                                                 document.getElementById("msg").innerHTML = "Please choose training course";
                                                 return false;

                                          } else if (inp_topic == "") {
                                                 mymodalss.style.display = "none";
                                                 modals.style.display = "block";
                                                 document.getElementById("msg").innerHTML = "Training topic cannot empty";
                                                 return false;

                                          } else if (inp_add_startdate == "") {
                                                 mymodalss.style.display = "none";
                                                 modals.style.display = "block";
                                                 document.getElementById("msg").innerHTML = "Start date cannot empty";
                                                 return false;

                                          } else if (inp_add_enddate == "") {
                                                 mymodalss.style.display = "none";
                                                 modals.style.display = "block";
                                                 document.getElementById("msg").innerHTML = "End date cannot empty";
                                                 return false;

                                          } else if (inp_emp_no == "") {
                                                 mymodalss.style.display = "none";
                                                 modals.style.display = "block";
                                                 document.getElementById("msg").innerHTML = "Employee no cannot empty";
                                                 return false;

                                          } else if (inp_venue == "") {
                                                 mymodalss.style.display = "none";
                                                 modals.style.display = "block";
                                                 document.getElementById("msg").innerHTML = "Venue cannot empty";
                                                 return false;

                                          } else if (inp_room == "") {
                                                 mymodalss.style.display = "none";
                                                 modals.style.display = "block";
                                                 document.getElementById("msg").innerHTML = "Room cannot empty";
                                                 return false;

                                          } else if (inp_cost == "") {
                                                 mymodalss.style.display = "none";
                                                 modals.style.display = "block";
                                                 document.getElementById("msg").innerHTML = "Estimated cost cannot empty";
                                                 return false;

                                          } else if (inp_reason == "") {
                                                 mymodalss.style.display = "none";
                                                 modals.style.display = "block";
                                                 document.getElementById("msg").innerHTML = "Reason cannot empty";
                                                 return false;

                                          } else {
                                                 //submi the form to server
                                                 $.ajax({
                                                        url: "php_action/FuncDataCreate.php<?php echo $getPackage; ?>",
                                                        type: form.attr('method'),
                                                        // data: form.serialize(),

                                                        data: new FormData(this),
                                                        processData: false,
                                                        contentType: false,

                                                        dataType: 'json',
                                                        success: function(response) {

                                                               // remove the error 
                                                               $(".form-group").removeClass('has-error').removeClass('has-success');

                                                               if (response.code == 'success_message') {
                                                                      mymodalss.style.display = "none";
                                                                      modals.style.display = "block";
                                                                      document.getElementById("msg").innerHTML = response.messages;

                                                                      $("[data-dismiss=modal]").trigger({
                                                                             type: "click"
                                                                      });

                                                                      // reset the form
                                                                      $("#FormDisplayCreate")[0].reset();
                                                                      // reload the datatables
                                                                      datatable.ajax.reload(null, false);
                                                                      // this function is built in function of datatables;
                                                               } else {
                                                                      mymodalss.style.display = "none";
                                                                      modals.style.display = "block";
                                                                      document.getElementById("msg").innerHTML = response.messages;
                                                               } // /else
                                                        } // success  
                                                 }); // ajax subit 				

                                                 return false;
                                          }

                                   }); // /submit form for create member
                            }); // /add modal
                     });
















































































                     function DestinationForm(id = null) {




                            if (id) {
                                   // remove the error 
                                   $(".form-group").removeClass('has-error').removeClass('has-success');
                                   $(".text-danger").remove();
                                   // empty the message div
                                   $(".messages_update").html("");

                                   // remove the id
                                   $("#member_id").remove();

                                   $("#DestinationForm").show();

                                   $("#detail_destination").on('click', function() {
                                          mymodalss.style.display = "none";
                                          var modal_emp = $("#modal_emp").val();

                                          var myarr = modal_emp.split(" ");

                                          var myvar = myarr[1];
                                          // var myvar2 = myarr[1];
                                          // var myvar3 = myarr[2];
                                          // var myvar4 = myarr[3];

                                          if (myvar == '') {
                                                 mymodalss.style.display = "none";
                                                 modals.style.display = "block";
                                                 document.getElementById("msg").innerHTML = "Please select employee";
                                                 return false
                                          }

                                          var inp_add_startdate = $("#inp_add_startdate").val();
                                          var inp_add_enddate = $("#inp_add_enddate").val();
                                          $("#attendance_list").show();



                                          $(document).ready(function() {
                                                 $("#attendance_list").load("pages_relation/_pages_attendance.php<?php echo $getPackage; ?>inp_add_startdate=" + inp_add_startdate + "&inp_add_enddate=" + inp_add_enddate + "&src_emp_no=<?php echo $username; ?>", function(responseTxt, statusTxt, xhr) {
                                                        if (statusTxt == "success")
                                                               mymodalss.style.display = "none";
                                                        if (statusTxt == "error")
                                                               alert("Error: " + xhr.status + ": " + xhr.statusText);

                                                 });
                                          })






                                   });

                                   // fetch the member data
                                   $.ajax({
                                          url: 'php_action/getSelectedEmployeeFamily.php',
                                          type: 'post',
                                          data: {
                                                 member_id: id
                                          },
                                          dataType: 'json',

                                          success: function(response) {

                                                 // $("#settlement_emp_id").val(response.emp_id);
                                                 $("#family_empfamily_id").val(response.empfamily_id);
                                                 $("#family_relationship").val(response.relationship);
                                                 $("#family_name").val(response.name);
                                                 $("#family_gender").val(response.gender);
                                                 $("#family_birth_date").val(response.birthdate);
                                                 $("#family_alivestatus").val(response.alive_status);


                                                 // here update the member data
                                                 $("#FormFamily").unbind('submit').bind('submit', function() {
                                                        // remove error messages
                                                        $(".text-danger").remove();

                                                        var form = $(this);

                                                        var family_empfamily_id = $("#family_empfamily_id").val();
                                                        var family_relationship = $("#family_relationship").val();
                                                        var family_name = $("#family_name").val();

                                                        var regex = /^[a-zA-Z]+$/;

                                                        if (family_empfamily_id == "") {
                                                               modals.style.display = "block";
                                                               document.getElementById("msg").innerHTML = "Family id code cannot empty";
                                                        }

                                                        if (family_empfamily_id) {

                                                               $.ajax({
                                                                      url: form.attr('action'),
                                                                      type: form.attr('method'),
                                                                      // data: form.serialize(),

                                                                      data: new FormData(this),
                                                                      processData: false,
                                                                      contentType: false,

                                                                      dataType: 'json',
                                                                      success: function(response) {

                                                                             if (response.code == 'success_message_update') {

                                                                                    modals.style.display = "block";
                                                                                    document.getElementById("msg").innerHTML = response.messages;

                                                                                    $("#destination_list").load("pages_relation/_pages_destination.php<?php echo $getPackage; ?>rfid=" + response.employee,
                                                                                           function(responseTxt, statusTxt, jqXHR) {
                                                                                                  if (statusTxt == "success") {
                                                                                                         $("#destination_list").show();
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
                     $(document).ready(function() {
                            $('#inp_add_startdate').bootstrapMaterialDatePicker({
                                   time: false,
                                   clearButton: true
                            });

                            $('#inp_add_enddate').bootstrapMaterialDatePicker({
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

                            $('#modal_revised_leave_start').bootstrapMaterialDatePicker({
                                   time: false,
                                   clearButton: true
                            });

                            $('#modal_revised_leave_end').bootstrapMaterialDatePicker({
                                   time: false,
                                   clearButton: true
                            });

                            $('#inp_revised_starttime').bootstrapMaterialDatePicker({
                                   date: false,
                                   format: 'HH:mm'
                            });

                            $('#inp_revised_endtime').bootstrapMaterialDatePicker({
                                   date: false,
                                   format: 'HH:mm'
                            });
                     });
              </script>

              <script>
                     $(document).ready(function() {
                            $('#inp_destination_code').focus(function() {
                                   var query = $(this).val();
                                   if (query != '') {
                                          $.ajax({
                                                 url: "search_category.php<?php echo $getPackage; ?>userid=<?php echo $username; ?>",
                                                 method: "POST",
                                                 data: {
                                                        query: query
                                                 },
                                                 success: function(data) {
                                                        $('#category_add_list').fadeIn();
                                                        $('#category_add_list').html(data);

                                                 }
                                          });
                                   }
                            });
                            $('#inp_destination_code').keyup(function() {
                                   var query = $(this).val();
                                   if (query != '') {
                                          $.ajax({
                                                 url: "search_category.php<?php echo $getPackage; ?>userid=<?php echo $username; ?>",
                                                 method: "POST",
                                                 data: {
                                                        query: query
                                                 },
                                                 success: function(data) {
                                                        $('#category_add_list').fadeIn();
                                                        $('#category_add_list').html(data);

                                                 }
                                          });
                                   }
                            });

                            $('#inp_destination_code').mouseover(function() {
                                   $('#category_add_list').fadeOut();
                            });

                            $(document).on('click', '.searchterm_category', function() {

                                   $('#inp_destination_code').val($(this).text());

                                   $('#category_add_list').fadeOut();

                                   var inp_destination_code = document.getElementById("inp_destination_code").value;



                                   var myarr = inp_destination_code.split(" - ");

                                   var myvar = myarr[0];


                                   $('#frm_inp_course').show();

                                   $("#box_add_training_topic").load("pages_relation/_pages_topic.php<?php echo $getPackage; ?>rfid=" + myvar,
                                          function(responseTxt, statusTxt, jqXHR) {
                                                 if (statusTxt == "success") {

                                                        $("#box_add_training_topic").show();
                                                 }
                                                 if (statusTxt == "error") {
                                                        alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                                 }
                                          }
                                   );

                            });
                     });






                     $(document).ready(function() {
                            $('#inp_venue').focus(function() {
                                   var query = $(this).val();
                                   if (query != '') {
                                          $.ajax({
                                                 url: "search_venue.php<?php echo $getPackage; ?>userid=<?php echo $username; ?>",
                                                 method: "POST",
                                                 data: {
                                                        query: query
                                                 },
                                                 success: function(data) {
                                                        $('#venue_add_list').fadeIn();
                                                        $('#venue_add_list').html(data);
                                                 }
                                          });
                                   }
                            });
                            $('#inp_venue').keyup(function() {
                                   var query = $(this).val();
                                   if (query != '') {
                                          $.ajax({
                                                 url: "search_venue.php<?php echo $getPackage; ?>userid=<?php echo $username; ?>",
                                                 method: "POST",
                                                 data: {
                                                        query: query
                                                 },
                                                 success: function(data) {
                                                        $('#venue_add_list').fadeIn();
                                                        $('#venue_add_list').html(data);

                                                 }
                                          });
                                   }
                            });

                            $('#inp_venue').mouseover(function() {
                                   $('#venue_add_list').fadeOut();
                            });

                            $(document).on('click', '.searchterm_venue', function() {

                                   $('#inp_venue').val($(this).text());

                                   $('#venue_add_list').fadeOut();

                                   var inp_venue = document.getElementById("inp_venue").value;



                                   var myarr = inp_venue.split(" - ");

                                   var myvar = myarr[0];

                            });
                     });
              </script>



              <script>
                     $(document).ready(function() {
                            $('#modal_emp').focus(function() {
                                   var query = $(this).val();
                                   if (query != '') {
                                          $.ajax({
                                                 url: "search.php<?php echo $getPackage; ?>userid=<?php echo $username; ?>",
                                                 method: "POST",
                                                 data: {
                                                        query: query
                                                 },
                                                 success: function(data) {
                                                        $('#employeeList').fadeIn();
                                                        $('#employeeList').html(data);
                                                 }
                                          });
                                   }
                            });
                            $('#modal_emp').keyup(function() {
                                   var query = $(this).val();
                                   if (query != '') {
                                          $.ajax({
                                                 url: "search.php<?php echo $getPackage; ?>userid=<?php echo $username; ?>",
                                                 method: "POST",
                                                 data: {
                                                        query: query
                                                 },
                                                 success: function(data) {
                                                        $('#employeeList').fadeIn();
                                                        $('#employeeList').html(data);
                                                 }
                                          });
                                   }
                            });

                            $('#modal_emp').mouseover(function() {
                                   $('#employeeList').fadeOut();
                            });

                            $(document).on('click', 'li', function() {
                                   $('#modal_emp').val($(this).text());
                                   $('#employeeList').fadeOut();

                                   var emps = document.getElementById("modal_emp").value;

                                   var myarr = emps.split(" ");

                                   var myvar = myarr[1];
                                   var myvar2 = myarr[2];

                                   //     // Show the resulting value
                                   console.log(myvar2);


                                   $("#inp_careerhistory").val(myvar);
                                   $("#inp_empperformance").val(myvar2);

                            });
                     });










                     $(document).ready(function() {
                            $('#inp_destination_code').focus(function() {
                                   var query = $(this).val();
                                   if (query != '') {
                                          $.ajax({
                                                 url: "search_category.php<?php echo $getPackage; ?>userid=<?php echo $username; ?>",
                                                 method: "POST",
                                                 data: {
                                                        query: query
                                                 },
                                                 success: function(data) {
                                                        $('#category_add_list').fadeIn();
                                                        $('#category_add_list').html(data);

                                                 }
                                          });
                                   }
                            });
                            $('#inp_destination_code').keyup(function() {
                                   var query = $(this).val();
                                   if (query != '') {
                                          $.ajax({
                                                 url: "search_category.php<?php echo $getPackage; ?>userid=<?php echo $username; ?>",
                                                 method: "POST",
                                                 data: {
                                                        query: query
                                                 },
                                                 success: function(data) {
                                                        $('#category_add_list').fadeIn();
                                                        $('#category_add_list').html(data);

                                                 }
                                          });
                                   }
                            });

                            $('#inp_destination_code').mouseover(function() {
                                   $('#category_add_list').fadeOut();
                            });

                            $(document).on('click', '.searchterm_category', function() {

                                   $('#inp_destination_code').val($(this).text());

                                   $('#category_add_list').fadeOut();

                                   var inp_destination_code = document.getElementById("inp_destination_code").value;



                                   var myarr = inp_destination_code.split(" - ");

                                   var myvar = myarr[0];


                                   $('#frm_inp_course').show();

                                   $("#box_add_training_topic").load("pages_relation/_pages_topic.php<?php echo $getPackage; ?>rfid=" + myvar,
                                          function(responseTxt, statusTxt, jqXHR) {
                                                 if (statusTxt == "success") {

                                                        $("#box_add_training_topic").show();
                                                 }
                                                 if (statusTxt == "error") {
                                                        alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                                 }
                                          }
                                   );

                            });
                     });
              </script>