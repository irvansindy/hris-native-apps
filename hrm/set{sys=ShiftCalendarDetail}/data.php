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
                     "ajax": "php_action/FuncDataRead.php<?php echo $getPackage; ?><?php echo $frameworks; ?>"
              });
       });
</script>


<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>


<div class="col-md-12">
       <div class="card">
              <div class="card-header d-flex align-items-center">
                     <h4 class="card-title mb-0">Employee Shift Calendar </h4>


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

              <div class="card-body table-responsive p-0" style="width: 100vw;height: 78vh; width: 98.8%; margin: 5px;overflow: scroll;">
                     <table id="datatable" width="100%" border="1" align="left" class="table table-bordered table-striped table-hover table-head-fixed">
                            <thead>
                                   <tr>
                                          <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No.</th>
                                          <th class="fontCustom" style="z-index: 1;">Shift Group Code</th>
                                          <th class="fontCustom" style="z-index: 1;">Shift Group name</th>
                                          <th class="fontCustom" style="z-index: 1;">Day Start</th>
                                          <th class="fontCustom" style="z-index: 1;">Shift Year</th>
                                          <th class="fontCustom" style="z-index: 1;">Group Code</th>
                                          <th class="fontCustom" style="z-index: 1;">Calendar Pattern</th>
                                   </tr>

                            </thead>
                     </table>

              </div>

              <div class='card-footer' style='background-color: #eee;height: 37px;padding-top: 5px;'>
              </div>

       </div>
</div>











<!-- add modal -->
<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="CreateForm">
       <div class="modal-dialog modal-belakang modal-bg" role="document">
              <div class="modal-content">
                     <div class="modal-header">
                            <h4 class="modal-title">Add Calendar Schedule </h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <form class="form-horizontal" action="php_action/FuncDataCreate.php<?php echo $getPackage; ?>" method="POST" id="FormDisplayCreate">

                            <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

                                   <fieldset id="fset_1">
                                          <legend>Calendar Schedule Form</legend>

                                          <div class="messages_create"></div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Shift Group Name</div>
                                                 <div class="col-sm-8">
                                                        <div class="input-group">
                                                               <input class="input--style-6 inp_shiftgroupname" name="inp_shiftgroupname" style="width: 100%;height: 30px;" id="inp_shiftgroupname" value="">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Select Year</div>
                                                 <div class="col-sm-6">
                                                        <div class="input-group">

                                                               <select class="input--style-6 inp_years" name="inp_years" style="width: 50%;height: 30px;" id="inp_years">
                                                                      <option value="">--Select One--</option>
                                                                      <?php
                                                                      $sql = mysqli_query($connect, "SELECT 
                                                                                                  a.`year`-2 AS `year`
                                                                                                  FROM 
                                                                                                  hrmsysdate a
                                                                                                  GROUP BY YEAR(a.`year`) UNION
                                                                                                  SELECT 
                                                                                                  a.`year`-1 AS `year`
                                                                                                  FROM 
                                                                                                  hrmsysdate a
                                                                                                  GROUP BY YEAR(a.`year`) UNION
                                                                                                  SELECT 
                                                                                                  a.`year`AS `year`
                                                                                                  FROM 
                                                                                                  hrmsysdate a
                                                                                                  GROUP BY YEAR(a.`year`) UNION
                                                                                                  SELECT 
                                                                                                  a.`year`+1 AS `year`
                                                                                                  FROM 
                                                                                                  hrmsysdate a
                                                                                                  GROUP BY YEAR(a.`year`)
                                                                                           
                                                                                                  
                                                                                                  ");
                                                                      while ($row = mysqli_fetch_array($sql)) {
                                                                             echo '<option value="' . $row['year'] . '">' . $row['year'] . '</option>';
                                                                      }
                                                                      ?>
                                                               </select>
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Select Shift Group</div>
                                                 <div class="col-sm-6">
                                                        <div class="input-group">

                                                               <select class="input--style-6 inp_shiftgroup" name="inp_shiftgroup" style="width: 50%;height: 30px;" id="inp_shiftgroup" onchange="fetch_select(this.value);">
                                                                      <option value="">--Select One--</option>
                                                                      <?php
                                                                      $sql = mysqli_query($connect, "SELECT 
                                                                                                         a.*
                                                                                                  FROM 
                                                                                                  hrmttamshiftgroup a
                                                                                                  GROUP BY a.shiftgroupcode
                                                                                                  ORDER BY a.shiftgroupcode ASC       
                                                                                                  ");
                                                                      while ($row = mysqli_fetch_array($sql)) {
                                                                             echo '<option value="' . $row['shiftgroupcode'] . '">' . $row['shiftgroupcode'] . ' - ' . $row['shiftgroupname'] . '</option>';
                                                                      }
                                                                      ?>
                                                               </select>
                                                        </div>
                                                 </div>
                                          </div>

                                          <script type="text/javascript">
                                                 function fetch_select(val) {
                                                        $.ajax({
                                                               type: 'post',
                                                               url: 'pages_relation/_fetch_data_calendar.php',
                                                               data: {
                                                                      get_option: val
                                                               },
                                                               success: function(response) {
                                                                      document.getElementById("day_count").innerHTML = response;
                                                                      $('#day_count_form').show();
                                                               }
                                                        });
                                                 }
                                          </script>
                                          <div class="form-row" id="day_count_form" style="display:none;">
                                                 <div class="col-sm-2 name">Select Start Days</div>
                                                 <div class="col-sm-6">
                                                        <div class="input-group">

                                                               <select class="input--style-6 modal_leave" name="day_count" style="width: 50%;height: 30px;" id="day_count">
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
                                          <legend>Calendar Schedule Form</legend>

                                          <div class="messages_create"></div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Shift Group Name</div>
                                                 <div class="col-sm-8">
                                                        <div class="input-group">
                                                               <input class="input--style-6 sel_shiftgroupname" name="sel_shiftgroupname" style="width: 100%;height: 30px;" id="sel_shiftgroupname" value="">
                                                               <input class="input--style-6 sel_shiftgroupid" type="hidden" name="sel_shiftgroupid" style="width: 100%;height: 30px;" id="sel_shiftgroupid" value="">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Select Year</div>
                                                 <div class="col-sm-6">
                                                        <div class="input-group">

                                                               <select class="input--style-6 sel_years" name="sel_years" style="width: 50%;height: 30px;" id="sel_years">
                                                                      <option value="">--Select One--</option>
                                                                      <?php
                                                                      $sql = mysqli_query($connect, "SELECT 
                                                                                                  a.`year`-2 AS `year`
                                                                                                  FROM 
                                                                                                  hrmsysdate a
                                                                                                  GROUP BY YEAR(a.`year`) UNION
                                                                                                  SELECT 
                                                                                                  a.`year`-1 AS `year`
                                                                                                  FROM 
                                                                                                  hrmsysdate a
                                                                                                  GROUP BY YEAR(a.`year`) UNION
                                                                                                  SELECT 
                                                                                                  a.`year`AS `year`
                                                                                                  FROM 
                                                                                                  hrmsysdate a
                                                                                                  GROUP BY YEAR(a.`year`) UNION
                                                                                                  SELECT 
                                                                                                  a.`year`+1 AS `year`
                                                                                                  FROM 
                                                                                                  hrmsysdate a
                                                                                                  GROUP BY YEAR(a.`year`)
                                                                                           
                                                                                                  
                                                                                                  ");
                                                                      while ($row = mysqli_fetch_array($sql)) {
                                                                             echo '<option value="' . $row['year'] . '">' . $row['year'] . '</option>';
                                                                      }
                                                                      ?>
                                                               </select>
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Select Shift Group</div>
                                                 <div class="col-sm-6">
                                                        <div class="input-group">

                                                               <select class="input--style-6 sel_shiftgroup" name="sel_shiftgroup" style="width: 50%;height: 30px;" id="sel_shiftgroup" onchange="fetch_select_update(this.value);">
                                                                      <option value="">--Select One--</option>
                                                                      <?php
                                                                      $sql = mysqli_query($connect, "SELECT 
                                                                                                         a.*
                                                                                                  FROM 
                                                                                                  hrmttamshiftgroup a
                                                                                                  GROUP BY a.shiftgroupcode
                                                                                                  ORDER BY a.shiftgroupcode ASC       
                                                                                                  ");
                                                                      while ($row = mysqli_fetch_array($sql)) {
                                                                             echo '<option value="' . $row['shiftgroupcode'] . '">' . $row['shiftgroupcode'] . ' - ' . $row['shiftgroupname'] . '</option>';
                                                                      }
                                                                      ?>
                                                               </select>
                                                        </div>
                                                 </div>
                                          </div>

                                          <script type="text/javascript">
                                                 function fetch_select(val) {
                                                        $.ajax({
                                                               type: 'post',
                                                               url: 'pages_relation/_fetch_data_calendar.php',
                                                               data: {
                                                                      get_option: val
                                                               },
                                                               success: function(response) {
                                                                      document.getElementById("day_count").innerHTML = response;
                                                                      $('#day_count_form').show();
                                                               }
                                                        });
                                                 }

                                                 function fetch_select_update(val) {
                                                        $.ajax({
                                                               type: 'post',
                                                               url: 'pages_relation/_fetch_data_calendar.php',
                                                               data: {
                                                                      get_option: val
                                                               },
                                                               success: function(response) {
                                                                      document.getElementById("sel_day_counts").innerHTML = response;
                                                                      $('#day_count_form').show();
                                                               }
                                                        });
                                                 }
                                          </script>

                                          <div class="form-row" id="day_count_form">
                                                 <div class="col-sm-2 name">Select Start Days</div>
                                                 <div class="col-sm-6">
                                                        <div class="input-group" id="box_days">
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
































<!-- add modal -->
<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="PatternForm">
       <div class="modal-dialog modal-belakang modal-bg" role="document">
              <div class="modal-content">
                     <div class="modal-header">
                            <h4 class="modal-title">Calendar Pattern </h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <form class="form-horizontal" action="php_action/FuncDataUpdate.php" method="POST" id="PatternFormContent">

                            <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">
                                   <fieldset id="fset_1">
                                          <legend>Calendar Schedule Form</legend>

                                          <div class="messages_create"></div>

                                          <div class="form-row">
                                                 <div class="col-sm-12 name">
                                                        <div class="input-group" id="box_view_calendar"></div>
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
              $("#CreateButton").on('click', function() {

                     // alert("newConf");
                     // reset the form 
                     $("#FormDisplayCreate")[0].reset();
                     // empty the message div

                     $(".messages_create").html("");

                     // submit form
                     $("#FormDisplayCreate").unbind('submit').bind('submit', function() {

                            mymodalss.style.display = "block";

                            $(".text-danger").remove();

                            var form = $(this);

                            var inp_years = $("#inp_years").val();
                            var inp_shiftgroup = $("#inp_shiftgroup").val();
                            var day_count = $("#day_count").val();

                            var regex = /^[a-zA-Z]+$/;

                            if (inp_years == '') {
                                   mymodalss.style.display = "none";
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Request for empty";
                                   return false;

                            } else if (inp_shiftgroup == '') {
                                   mymodalss.style.display = "none";
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Leave request empty";
                                   return false;

                            } else if (day_count == '') {
                                   mymodalss.style.display = "none";
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Leave start empty";
                                   return false;

                            }

                            if (inp_years && inp_shiftgroup && day_count) {

                                   //submi the form to server
                                   $.ajax({
                                          url: form.attr('action'),
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
                                                        mymodals_withhref.style.display = "block";
                                                        document.getElementById("msg_href").innerHTML = response.messages;

                                                        // reset the form
                                                        $("#FormDisplayCreate")[0].reset();
                                                        // reload the datatables
                                                        datatable.ajax.reload(null, false);
                                                        // this function is built in function of datatables;
                                                 } else {
                                                        mymodalss.style.display = "none";
                                                        modals.style.display = "block";
                                                        document.getElementById("msg").innerHTML = response.messages;

                                                        $('#submit_add').show();
                                                        $('#submit_add2').hide();

                                                        window.setTimeout(
                                                               function() {
                                                                      $(".alert")
                                                                             .fadeTo(
                                                                                    500,
                                                                                    0
                                                                             )
                                                                             .slideUp(
                                                                                    500,
                                                                                    function() {
                                                                                           $(this)
                                                                                                  .remove();
                                                                                    }
                                                                             );
                                                               },
                                                               4000
                                                        );
                                                 } // /else
                                          } // success  
                                   }); // ajax subit 				
                            } /// if
                            return false;
                     }); // /submit form for create member
              }); // /add modal
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

                                   $("#sel_shiftgroupname").val(response.shiftregroup_name);
                                   $("#sel_years").val(response.shiftyear);
                                   $("#sel_shiftgroup").val(response.shiftgroup_id);
                                   $("#sel_day_count").val(response.day_start);
                                   $("#sel_shiftgroupid").val(response.shiftregroup_id);

                                   $("#box_days").load("pages_relation/_fetch_data_calendar_update.php<?php echo $getPackage; ?>rfid=" + response.shiftgroup_id + "&day_start=" + response.day_start,
                                          function(responseTxt, statusTxt, jqXHR) {
                                                 if (statusTxt == "success") {
                                                        $("#box_days").show();
                                                 }
                                                 if (statusTxt == "error") {
                                                        alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                                 }
                                          }
                                   );

                                   $("#UpdateFormContent").unbind('submit').bind('submit', function() {
                                          

                                          var form = $(this);

                                          var sel_years = $("#sel_years").val();
                                          var sel_shiftgroup = $("#sel_shiftgroup").val();
                                          var sel_day_counts = $("#day_count").val();

                                          var regex = /^[a-zA-Z]+$/;

                                          if (sel_years == '') {
                                                 mymodalss.style.display = "none";
                                                 modals.style.display = "block";
                                                 document.getElementById("msg").innerHTML = "Requests for empty";
                                                 return false;

                                          } else if (sel_shiftgroup == '') {
                                                 mymodalss.style.display = "none";
                                                 modals.style.display = "block";
                                                 document.getElementById("msg").innerHTML = "Leave request empty";
                                                 return false;

                                          } 

                                          if (sel_years && sel_shiftgroup) {

                                                 mymodalss.style.display = "block";

                                                 $.ajax({
                                                        url: form.attr('action'),
                                                        type: form.attr('method'),
                                                        data: form.serialize(),
                                                        dataType: 'json',
                                                        success: function(response) {
                                                               
                                                               if (response.code == 'success_message') {

                                                                      mymodalss.style.display = "none";
                                                                      mymodals_withhref.style.display = "block";
                                                                      document.getElementById("msg_href").innerHTML = response.messages;

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