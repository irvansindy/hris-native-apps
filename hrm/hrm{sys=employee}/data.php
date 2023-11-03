<?php
$src_emp_no                = '';
if (!empty($_POST['src_emp_no']) && !empty($_POST['src_active_status'])) {
       $src_emp_no         = $_POST['src_emp_no'];
       $src_active_status  = $_POST['src_active_status'];
       $frameworks          = "&username=$username" . "&src_emp_no=" . "" . $src_emp_no . "" . "&src_active_status=" . "" . $src_active_status . "";
} else if (!empty($_POST['src_emp_no'])) {
       $src_emp_no         = $_POST['src_emp_no'];
       $frameworks          = "&username=$username" . "&src_emp_no=" . "" . $src_emp_no . "";
} else if (!empty($_POST['src_active_status'])) {
       $src_active_status         = $_POST['src_active_status'];
       $frameworks          = "&username=$username" . "&src_active_status=" . "" . $src_active_status . "";
} else {
       $frameworks          = "&username=$username";
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
                                                 <div class="col-4 name">Employee No. </div>
                                                 <div class="col-sm-8">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="src_emp_no" name="src_emp_no" id="src_emp_no" type="Text" value="<?php echo $src_emp_no; ?>" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                                        </div>
                                                 </div>
                                          </div>
                                          <div class="form-row">
                                                 <div class="col-4 name">Employee Information </div>
                                                 <div class="col-sm-8">
                                                        <div class="input-group">
                                                        <select class="input--style-6" autocomplete="off" autofocus="on" id="src_active_status" name="src_active_status" style="height: 33px;">
                                                                             <option value="1">Active</option>
                                                                             <option value="0">Inactive</option>
                                                                      </select>
                                                        </div>
                                                 </div>
                                          </div>
                                   </fieldset>
                                   <button type="submit" name="submit_search" id="submit_search" type="button" class="btn btn-warning button_bot">
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
</script>
<script type="text/javascript">
       $(document).ready(function() {
              $('#inp_birthdate').bootstrapMaterialDatePicker({
                     time: false,
                     clearButton: true
              });

              $('#inp_joindate').bootstrapMaterialDatePicker({
                     time: false,
                     clearButton: true
              });

              $('#sel_joindate').bootstrapMaterialDatePicker({
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
              $('#settlement_birth_date').bootstrapMaterialDatePicker({
                     time: false,
                     clearButton: true
              });
              $('#family_birth_date').bootstrapMaterialDatePicker({
                     time: false,
                     clearButton: true
              });
       });
</script>



<!-- isi JSON -->
<script type="text/javascript">
       // global the manage memeber table 
       $(document).ready(function() {
              datatable = $("#datatable<?php echo $platform; ?>").DataTable({

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
                     columnDefs: [{
                            orderable: false,
                            targets: 0
                     }],
                     destroy: true,
                     "ajax": "php_action/FuncDataRead<?php echo $platform?>.php<?php echo $getPackage; ?><?php echo $frameworks; ?>"
              });
       });

       $(document).ready(function() {
              datatable_family = $("#datatable_family").DataTable({

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
                     columnDefs: [{
                            orderable: false,
                            targets: 0
                     }],
                     destroy: true,
                     "ajax": "php_action/FuncDataReadFamily.php<?php echo $frameworks; ?>"
              });
       });
</script>



              <?php
              if ($platform != 'mobile') {         
              ?>
              <div class="col-md-12">
                     <div class="card">
                            <div class="card-header d-flex align-items-center">
                                   <h4 class="card-title mb-0">Employee Information </h4>

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
                                                 <?php
                                                 $get_auth = "SELECT user_type FROM users WHERE username = '$username'";
                                                 $get_auth_r = mysqli_fetch_assoc(mysqli_query($connect, $get_auth));

                                                 if ($get_auth_r['user_type'] == 'SuperAdmin') {
                                                        echo '<td>
                                                               <div class="toolbar sprite-toolbar-add" title="Add" data-toggle="modal"
                                                                      data-target="#CreateForm" id="CreateButton" data-keyboard="false"
                                                                      data-backdrop="static">
                                                                      <!-- <a title="add" href="" class="toolbar sprite-toolbar-add" data-toggle="modal" data-target="#CreateForm" id="CreateButton" data-keyboard="false" data-backdrop="static">tambah</a> -->
                                                               </div>
                                                        </td>';
                                                 }
                                                 ?>

                                          </table>
                                   </div>

              <?php } else if ($platform == 'mobile') { ?>

              <!-- <div class="col-md-12">
                     <div class="card" style="border-radius: 20px 20px 20px 20px;margin-bottom: 25px;">
                            <div class="card-header d-flex align-items-center" style="border-bottom: 1px solid white;">
                                   <h4 class="card-title mb-0">Employee Information </h4> -->

                                   <div class="card-actions ml-auto" style="margin-right: 15px;">
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
                                                

                                          </table>
                                   </div>
              <?php } ?>



                     
              </div>
              


              

              <!DOCTYPE html>
              <html>

              <head>
                     <meta name="viewport" content="width=device-width, initial-scale=1">
                     <style>
                            body {
                                   font-family: Arial;
                            }

                            /* Style the tab */
                            .tab {
                                   overflow: hidden;
                                   border: 1px solid #f5f5f5;
                                     border-bottom-color: rgb(245, 245, 245);
                                     border-bottom-style: solid;
                                     border-bottom-width: 1px;
                                   background-color: #f5f5f5;
                                   border-bottom: 1px solid #ccc;
                            }

                            /* Style the buttons inside the tab */
                            .tab a {
                                   background-color: inherit;
                                   float: left;
                                   border: none;
                                   outline: none;
                                   cursor: pointer;
                                   padding: 14px 16px;
                                   transition: 0.3s;
                                   font-size: 12px;
                                   border-bottom: 3px solid #f5f5f5;
                            }

                            /* Change background color of buttons on hover */
                            .tab a:hover {
                                   background-color: #f5f5f5;
                                   border-bottom: 3px solid #e8eaec;
                            }

                            /* Create an active/current tablink class */
                            .tab a.active {
                                   background-color: #f5f5f5;
                                   border-bottom: 3px solid #1890ff;
                            }

                            /* Style the tab content */
                            .tabcontent {
                                   display: none;
                                   padding: 6px 12px;
                                   border: 1px solid #ccc;
                                   border-top: none;
                            }
                     </style>


                    













              <!-- <div class="card-body table-responsive p-0"
                     style="width: 100vw;height: 78vh; width: 98.8%; margin: 5px;overflow: scroll;">
                     <table id="datatable" width="100%" border="1" align="left"
                            class="table table-bordered table-striped table-hover table-head-fixed">
                            <thead>
                                   <tr>
                                          <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No.</th>
                                          <th class="fontCustom" style="z-index: 1;">Employee No.</th>
                                          <th class="fontCustom" style="z-index: 1;">Employee Name</th>
                                          <th class="fontCustom" style="z-index: 1;">Gender</th>
                                          <th class="fontCustom" style="z-index: 1;">Position</th>

                                          <th class="fontCustom" style="z-index: 1;">Join Date</th>
                                          <th class="fontCustom" style="z-index: 1;">Employment Status</th>
                                          <th class="fontCustom" style="z-index: 1;">Email</th>
                                          <th class="fontCustom" style="z-index: 1;">Terminate Date</th>
                                          <th class="fontCustom" style="z-index: 1;">Permanent Date</th>
                                   </tr>
                                                     
                            </thead>
                     </table>

              </div>
       </div>
</div> -->

<!-- <php
$user = '100138';
require_once '../../model/gen_auth_data/_auth_data.php';
require_once '../../model/eo/GMEmployeeList.php';

echo $qListRender_srvside;
?> -->

<?php
              if ($platform != 'mobile') {
              ?>
                     <div class="card-body table-responsive p-0" style="width: 100vw;height: 78vh; width: 98.8%; margin: 5px;overflow: scroll;">
                     <table id="datatable" width="100%" border="1" align="left"
                            class="table table-bordered table-striped table-hover table-head-fixed">
                            <thead>
                                   <tr>
                                          <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No.</th>
                                          <th class="fontCustom" style="z-index: 1;">Employee No.</th>
                                          <th class="fontCustom" style="z-index: 1;">Employee Name</th>
                                          <th class="fontCustom" style="z-index: 1;">Gender</th>
                                          <th class="fontCustom" style="z-index: 1;">Position</th>

                                          <th class="fontCustom" style="z-index: 1;">Join Date</th>
                                          <!-- <th class="fontCustom" style="z-index: 1;">Employment Status</th> -->
                                          <th class="fontCustom" style="z-index: 1;">Email</th>
                                          <th class="fontCustom" style="z-index: 1;">Terminate Date</th>
                                          <th class="fontCustom" style="z-index: 1;">Permanent Date</th>
                                   </tr>
                                                     
                            </thead>
                     </table>
                     </div>

                     <div class='card-footer' style='background-color: #eee;height: 37px;padding-top: 5px;'></div>

              <?php } else if ($platform == 'mobile') { ?>

                     <div class="card-body table-responsive p-0" style="width: 90vw;min-height: 150vh; margin: 5px;overflow: hidden;border: 1px solid white;">
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
                            <h4 class="modal-title">Add Employee</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

                            <form class="form-horizontal" action="php_action/FuncDataCreate.php<?php echo $getPackage; ?>" method="POST" id="FormDisplayCreate">

                           

                                   <fieldset id="fset_1">
                                          <legend>Detail Information</legend>

                                          

                                          <input id="inp_emp_no" name="inp_emp_no" type="hidden" value="<?php echo $username; ?>">
                                          <!--FROM SESSION -->

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Employee id <span class="required">*</span></div>
                                                 <div class="col-sm-10">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="inp_emp_id" name="inp_emp_id" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">

                                                 <div class="col-sm-2 name">First Name <span class="required">*</span></div>
                                                 <div class="col-sm-2">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="inp_first_name" name="inp_first_name" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                                        </div>
                                                 </div>

                                                 <div class="col-sm-2 name">Middle Name <span class="required">*</span></div>
                                                 <div class="col-sm-2">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="inp_middle_name" name="inp_middle_name" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                                        </div>
                                                 </div>

                                                 <div class="col-sm-2 name">Last Name <span class="required">*</span></div>
                                                 <div class="col-sm-2">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="inp_last_name" name="inp_last_name" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Gender <span class="required">*</span></div>
                                                 <div class="col-sm-6">
                                                        <div class="input-group">

                                                               <select class="input--style-6" autocomplete="off" autofocus="on" id="inp_gender" name="inp_gender" style="height: 33px;">
                                                                      <option value="" selected> --Select one --</option>
                                                                      <?php
                                                                      $sql = mysqli_query($connect, "SELECT * FROM ttamgender GROUP BY gender_name");
                                                                      while ($data = mysqli_fetch_array($sql)) {
                                                                      ?>
                                                                             <option value="<?= $data['id'] ?>"><?= $data['gender_name'] ?></option>
                                                                      <?php
                                                                      }
                                                                      ?>
                                                               </select>
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Identity no <span class="required">*</span></div>
                                                 <div class="col-sm-4">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="inp_identity_no" name="inp_identity_no" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Tax no <span class="required">*</span></div>
                                                 <div class="col-sm-4">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="inp_taxno" name="inp_taxno" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Email <span class="required">*</span></div>
                                                 <div class="col-sm-6">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="inp_email" name="inp_email" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Phone <span class="required">*</span></div>
                                                 <div class="col-sm-4">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="inp_phone" name="inp_phone" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Birthplace <span class="required">*</span></div>
                                                 <div class="col-sm-4">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="inp_birthplace" name="inp_birthplace" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Birthdate <span class="required">*</span></div>
                                                 <div class="col-sm-4">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="inp_birthdate" name="inp_birthdate" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Marital status <span class="required">*</span></div>
                                                 <div class="col-sm-4">
                                                        <div class="input-group">
                                                               <select class="form-control input--style-6" autocomplete="off" autofocus="on" id="inp_maritalstatus" name="inp_maritalstatus" style="height: 33px;">
                                                                      <option value="" selected> --Select one --</option>
                                                                      <?php
                                                                      $sql = mysqli_query($connect, "SELECT * FROM teommarital");
                                                                      while ($data = mysqli_fetch_array($sql)) {
                                                                      ?>
                                                                             <option value="<?= $data['code'] ?>"><?= $data['name_en'] ?></option>
                                                                      <?php
                                                                      }
                                                                      ?>
                                                               </select>
                                                        </div>
                                                 </div>
                                          </div>

                                         
                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Employee Status <span class="required">*</span></div>
                                                 <div class="col-sm-4">
                                                        <div class="input-group">

                                                               <select class="form-control input--style-6" autocomplete="off" autofocus="on" id="inp_employ_code" name="inp_employ_code" style="height: 33px;">
                                                                      <option value="" selected> --Select one --</option>
                                                                      <?php
                                                                      $sql = mysqli_query($connect, "SELECT * FROM hrmemploymentstatus");
                                                                      while ($data = mysqli_fetch_array($sql)) {
                                                                      ?>
                                                                             <option value="<?= $data['employmentstatus_code'] ?>"><?= $data['employmentstatus_name_en'] ?></option>
                                                                      <?php
                                                                      }
                                                                      ?>
                                                               </select>
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Grade <span class="required">*</span></div>
                                                 <div class="col-sm-4">
                                                        <div class="input-group">

                                                               <select class="form-control input--style-6" autocomplete="off" autofocus="on" id="inp_grade_code" name="inp_grade_code" style="height: 33px;">
                                                                      <option value="" selected> --Select one --</option>
                                                                      <?php
                                                                      $sql = mysqli_query($connect, "SELECT * FROM teomjobgrade");
                                                                      while ($data = mysqli_fetch_array($sql)) {
                                                                      ?>
                                                                             <option value="<?= $data['grade_code'] ?>"><?= $data['grade_code'] ?></option>
                                                                      <?php
                                                                      }
                                                                      ?>
                                                               </select>
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Cost Center <span class="required">*</span></div>
                                                 <div class="col-sm-4">
                                                        <div class="input-group">

                                                               <select class="form-control input--style-6" autocomplete="off" autofocus="on" id="inp_cost_code" name="inp_cost_code" style="height: 33px;">
                                                                      <option value="" selected> --Select one --</option>
                                                                      <?php
                                                                      $sql = mysqli_query($connect, "SELECT * FROM teomcostcenter");
                                                                      while ($data = mysqli_fetch_array($sql)) {
                                                                      ?>
                                                                             <option value="<?= $data['costcenter_code'] ?>"><?= $data['costcenter_code'] ?></option>
                                                                      <?php
                                                                      }
                                                                      ?>
                                                               </select>
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Position <span class="required">*</span></div>
                                                 <div class="col-sm-4">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="inp_position_id" name="inp_position_id" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Worklocation <span class="required">*</span></div>
                                                 <div class="col-sm-4">
                                                        <div class="input-group">

                                                               <select class="form-control input--style-6" autocomplete="off" autofocus="on" id="inp_worklocation_code" name="inp_worklocation_code" style="height: 33px;">
                                                                      <option value="" selected> --Select one --</option>
                                                                      <?php
                                                                      $sql = mysqli_query($connect, "SELECT * FROM teomworklocation");
                                                                      while ($data = mysqli_fetch_array($sql)) {
                                                                      ?>
                                                                             <option value="<?= $data['worklocation_code'] ?>"><?= $data['worklocation_name'] ?></option>
                                                                      <?php
                                                                      }
                                                                      ?>
                                                               </select>
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Photos <span class="required">*</span></div>
                                                 <div class="col-sm-8">
                                                        <div class="input-group">
                                                               <input type="file" name="inp_fileToUpload" id="inp_fileToUpload">
                                                        </div>
                                                 </div>
                                          </div>



                                   </fieldset>

                                   <fieldset id="fset_1" style="min-height: 100%;">
                                          <legend>Career Information</legend>

                                          

                                          <input id="inp_emp_no" name="inp_emp_no" type="hidden" value="<?php echo $username; ?>">
                                          <!--FROM SESSION -->

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Join Date <span class="required">*</span></div>
                                                 <div class="col-sm-4">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="inp_joindate" name="inp_joindate" type="text" value="" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                                        </div>
                                                 </div>
                                          </div>

                                   </fieldset>


                                   <fieldset id="fset_1" style="min-height: 100%;">
                                          <legend>User Informations</legend>

                                          

                                          <input id="inp_emp_no" name="inp_emp_no" type="hidden" value="<?php echo $username; ?>">
                                          <!--FROM SESSION -->

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Latitude <span class="required">*</span></div>
                                                 <div class="col-sm-4">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="inp_latitude" name="inp_latitude" type="text" value="" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Longitude <span class="required">*</span></div>
                                                 <div class="col-sm-4">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="inp_longitude" name="inp_longitude" type="text" value="" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">PIN Payslip <span class="required">*</span></div>
                                                 <div class="col-sm-4">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="inp_pin" name="inp_pin" type="text" value="" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                                        </div>
                                                 </div>
                                          </div>
                                   </fieldset>

                                   <fieldset id="fset_1" style="min-height: 100%;">
                                          <legend>Shift Group</legend>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Shift Group <span class="required">*</span></div>
                                                 <div class="col-sm-4">
                                                        <div class="input-group">

                                                               <select class="form-control input--style-6" autocomplete="off" autofocus="on" id="inp_shiftgroup_code" name="inp_shiftgroup_code" style="height: 33px;">
                                                                      <option value="" selected> --Select one --</option>
                                                                      <?php
                                                                      $sql = mysqli_query($connect, "SELECT * FROM hrmttamshiftgroup");
                                                                      while ($data = mysqli_fetch_array($sql)) {
                                                                      ?>
                                                                             <option value="<?= $data['shiftgroupcode'] ?>"><?= $data['shiftgroupcode'] ?></option>
                                                                      <?php
                                                                      }
                                                                      ?>
                                                               </select>
                                                        </div>
                                                 </div>
                                          </div>
                                   </fieldset>

                                   <fieldset id="fset_1" style="min-height: 100%;">
                                          <legend>Bank Information</legend>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Account Name <span class="required">*</span></div>
                                                 <div class="col-sm-4">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="inp_account_name" name="inp_account_name" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="" placeholder="employee number">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Bank *</div>
                                                 <div class="col-sm-4" style="padding-bottom:5px">
                                                        <div class="input-group">
                                                               <select class="form-control input--style-6" autocomplete="off" autofocus="on" id="inp_bank_name" name="inp_bank_name" style="height: 33px;">
                                                                      <option value="" selected> --Select one --</option>
                                                                      <?php
                                                                      $sql = mysqli_query($connect, "SELECT * FROM toebank");
                                                                      while ($data = mysqli_fetch_array($sql)) {
                                                                      ?>
                                                                             <option value="<?= $data['bank'] ?>"><?= $data['bank'] ?></option>
                                                                      <?php
                                                                      }
                                                                      ?>
                                                               </select>
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Branch *</div>
                                                 <div class="col-sm-4" style="padding-bottom:5px">
                                                        <div class="input-group">
                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="inp_branch" name="inp_branch" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="" placeholder="Bank Branch">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Account no *</div>
                                                 <div class="col-sm-4" style="padding-bottom:5px">
                                                        <div class="input-group">
                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="inp_account_number" name="inp_account_number" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="" placeholder="Account Number">
                                                        </div>
                                                 </div>
                                          </div>

                                   </fieldset>

                                   <fieldset id="fset_1" style="min-height: 100%;">
                                          <legend>Customfield</legend>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">NPWP - Customfield4 <span class="required">*</span></div>
                                                 <div class="col-sm-4">
                                                        <div class="input-group">
                                                               <input class="input--style-6" 
                                                                      autocomplete="off" 
                                                                      id="inp_sel_customfield4" 
                                                                      name="inp_sel_customfield4" 
                                                                      type="Text" 
                                                                      value="">
                                                        </div>
                                                 </div>
                                          </div>
                                          
                                          <div class="form-row">
                                                 <div class="col-sm-2 name">PTKP - Customfield5 <span class="required">*</span></div>
                                                 <div class="col-sm-4">
                                                        <div class="input-group">


                                                               <select class="input--style-6" autocomplete="off" autofocus="on" id="inp_sel_ptkp" name="inp_sel_ptkp" style="height: 33px;">
                                                                      <option value="" selected> --Select one --</option>
                                                                      <?php
                                                                      $sql = mysqli_query($connect, "SELECT * FROM hrmptkp GROUP BY ptkp_id");
                                                                      while ($data = mysqli_fetch_array($sql)) {
                                                                      ?>
                                                                             <option value="<?= $data['ptkp_id'] ?>"><?= $data['ptkp_id'] ?></option>
                                                                      <?php
                                                                      }
                                                                      ?>
                                                               </select>


                                                        </div>
                                                 </div>
                                          </div>
                                   </fieldset>


                     </div>
                     <div class="modal-footer-sdk">
                            <button type="reset" class="btn-sdk btn-primary-left" data-dismiss="modal" onclick="ResetTable();" aria-hidden="true">
                                   &nbsp;Cancel&nbsp;
                            </button>
                            <button class="btn-sdk btn-primary-right" type="submit" name="submit_add" id="submit_add">
                                   Confirm
                            </button>
                            <button class="btn-sdk btn-primary-right" type="button" name="submit_add2" id="submit_add2" style='display:none;' disabled>
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













































<!-- edit modal -->
<div class="modal  fade fade-custom" tabindex="-1" role="dialog" id="UpdateForm">
       <div class="modal-dialog modal-belakang modal-bg" role="document">

              <div class="modal-content">
                     <div class="modal-header">
                            <h4 class="modal-title">Detail Employee</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                            <div class="tab">
                                   <table>
                                          <tr>
                                                 <td>
                                                        <a class="tablinks" id="defaultOpen" onclick="openCity(event, 'tabpersonal')">Personal</a>
                                                        <a class="tablinks" onclick="openCity(event, 'tabcareer')">Career</a>
                                                        <a class="tablinks" onclick="openCity(event, 'tabuser')">User Information</a>
                                                        <a class="tablinks" onclick="openCity(event, 'tabbank')">Bank</a>
                                                        <a class="tablinks" onclick="openCity(event, 'customfield')">Customfield</a>
                                                        <a class="tablinks" onclick="openCity(event, 'tabfams')">Family & Dependent</a>
                                                        <a class="tablinks" onclick="openCity(event, 'tabtraining')">Training Record</a>
                                                        <a class="tablinks" onclick="openCity(event, 'tabpayroll')">Payroll Constant</a>
                                                 </td>
                                          </tr>
                                   </table>
                                   
                                   
                            </div>

                     <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 100%; overflow: scroll;overflow-x: hidden;border: 1px solid #ececec00;">


                            <form class="form-horizontal" action="php_action/FuncDataUpdate.php<?php echo $getPackage; ?>" method="POST" id="FormDisplayUpdate">

                                   
                            

                            <div id="tabpersonal" class="tabcontent">
                                   <fieldset id="fset_1">
                                          <legend>Detail Informations</legend>

                                          

                                          <input id="inp_emp_no" name="inp_emp_no" type="hidden" value="<?php echo $username; ?>">
                                          <!--FROM SESSION -->

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Employee id <span class="required">*</span></div>
                                                 <div class="col-sm-10">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="sel_emp_id" name="sel_emp_id" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">First Name <span class="required">*</span></div>
                                                 <div class="col-sm-2">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="sel_first_name" name="sel_first_name" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                                        </div>
                                                 </div>

                                                 <div class="col-sm-2 name">Middle Name <span class="required">*</span></div>
                                                 <div class="col-sm-2">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="sel_middle_name" name="sel_middle_name" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                                        </div>
                                                 </div>

                                                 <div class="col-sm-2 name">Last Name <span class="required">*</span></div>
                                                 <div class="col-sm-2">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="sel_last_name" name="sel_last_name" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Gender <span class="required">*</span></div>
                                                 <div class="col-sm-6">
                                                        <div class="input-group">

                                                               <select class="input--style-6" autocomplete="off" autofocus="on" id="sel_gender" name="sel_gender" style="height: 33px;">
                                                                      <option value="" selected> --Select one --</option>
                                                                      <?php
                                                                      $sql = mysqli_query($connect, "SELECT * FROM ttamgender GROUP BY gender_name");
                                                                      while ($data = mysqli_fetch_array($sql)) {
                                                                      ?>
                                                                             <option value="<?= $data['id'] ?>"><?= $data['gender_name'] ?></option>
                                                                      <?php
                                                                      }
                                                                      ?>
                                                               </select>
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Identity no <span class="required">*</span></div>
                                                 <div class="col-sm-4">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="sel_identity_no" name="sel_identity_no" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Tax no <span class="required">*</span></div>
                                                 <div class="col-sm-4">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="sel_taxno" name="sel_taxno" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Email <span class="required">*</span></div>
                                                 <div class="col-sm-6">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="sel_email" name="sel_email" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Phone <span class="required">*</span></div>
                                                 <div class="col-sm-4">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="sel_phone" name="sel_phone" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Birthplace <span class="required">*</span></div>
                                                 <div class="col-sm-4">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="sel_birthplace" name="sel_birthplace" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Birthdate <span class="required">*</span></div>
                                                 <div class="col-sm-4">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="sel_birthdate" name="sel_birthdate" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Marital status <span class="required">*</span></div>
                                                 <div class="col-sm-4">
                                                        <div class="input-group">

                                                               <select class="form-control input--style-6" autocomplete="off" autofocus="on" id="sel_maritalstatus" name="sel_maritalstatus" style="height: 33px;">
                                                                      <option value="" selected> --Select one --</option>
                                                                      <?php
                                                                      $sql = mysqli_query($connect, "SELECT * FROM teommarital");
                                                                      while ($data = mysqli_fetch_array($sql)) {
                                                                      ?>
                                                                             <option value="<?= $data['code'] ?>"><?= $data['name_en'] ?></option>
                                                                      <?php
                                                                      }
                                                                      ?>
                                                               </select>
                                                        </div>
                                                 </div>
                                          </div>

                                       
                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Employee Status <span class="required">*</span></div>
                                                 <div class="col-sm-4">
                                                        <div class="input-group">

                                                               <select class="form-control input--style-6" autocomplete="off" autofocus="on" id="sel_employ_code" name="sel_employ_code" style="height: 33px;">
                                                                      <option value="" selected> --Select one --</option>
                                                                      <?php
                                                                      $sql = mysqli_query($connect, "SELECT * FROM hrmemploymentstatus");
                                                                      while ($data = mysqli_fetch_array($sql)) {
                                                                      ?>
                                                                             <option value="<?= $data['employmentstatus_code'] ?>"><?= $data['employmentstatus_name_en'] ?></option>
                                                                      <?php
                                                                      }
                                                                      ?>
                                                               </select>
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Grade <span class="required">*</span></div>
                                                 <div class="col-sm-4">
                                                        <div class="input-group">

                                                               <select class="form-control input--style-6" autocomplete="off" autofocus="on" id="sel_grade_code" name="sel_grade_code" style="height: 33px;">
                                                                      <option value="" selected> --Select one --</option>
                                                                      <?php
                                                                      $sql = mysqli_query($connect, "SELECT * FROM teomjobgrade");
                                                                      while ($data = mysqli_fetch_array($sql)) {
                                                                      ?>
                                                                             <option value="<?= $data['grade_code'] ?>"><?= $data['grade_code'] ?></option>
                                                                      <?php
                                                                      }
                                                                      ?>
                                                               </select>
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Cost Center <span class="required">*</span></div>
                                                 <div class="col-sm-4">
                                                        <div class="input-group">

                                                               <select class="form-control input--style-6" autocomplete="off" autofocus="on" id="sel_cost_code" name="sel_cost_code" style="height: 33px;">
                                                                      <option value="" selected> --Select one --</option>
                                                                      <?php
                                                                      $sql = mysqli_query($connect, "SELECT * FROM teomcostcenter");
                                                                      while ($data = mysqli_fetch_array($sql)) {
                                                                      ?>
                                                                             <option value="<?= $data['costcenter_code'] ?>"><?= $data['costcenter_code'] ?></option>
                                                                      <?php
                                                                      }
                                                                      ?>
                                                               </select>
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Position <span class="required">*</span></div>
                                                 <div class="col-sm-4">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="sel_position_id" name="sel_position_id" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Worklocation <span class="required">*</span></div>
                                                 <div class="col-sm-4">
                                                        <div class="input-group">

                                                               <select class="form-control input--style-6" autocomplete="off" autofocus="on" id="sel_worklocation_code" name="sel_worklocation_code" style="height: 33px;">
                                                                      <option value="" selected> --Select one --</option>
                                                                      <?php
                                                                      $sql = mysqli_query($connect, "SELECT * FROM teomworklocation");
                                                                      while ($data = mysqli_fetch_array($sql)) {
                                                                      ?>
                                                                             <option value="<?= $data['worklocation_code'] ?>"><?= $data['worklocation_name'] ?></option>
                                                                      <?php
                                                                      }
                                                                      ?>
                                                               </select>
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Photos <span class="required">*</span></div>
                                                 <div class="col-sm-8">
                                                        <div class="input-group">
                                                               <input type="file" name="sel_fileToUpload" id="sel_fileToUpload">
                                                        </div>
                                                 </div>
                                          </div>



                                   </fieldset>
                            </div>

                            <div id="tabcareer" class="tabcontent">
                                   <fieldset id="fset_1" style="min-height: 100%;">
                                          <legend>Career Information</legend>

                                          <div id="career_list"></div>

                                          <input class="hidden" id="sel_emp_no" name="sel_emp_no" type="hidden" value="<?php echo $username; ?>">
                                          <!--FROM SESSION -->

                                          <div class="form-row" style="display:none;">
                                                 <div class="col-sm-2 name">Join Date <span class="required">*</span></div>
                                                 <div class="col-sm-4">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="sel_joindate" name="sel_joindate" type="text" value="" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                                        </div>
                                                 </div>
                                          </div>

                                   </fieldset>
                            </div>

                            <div id="tabuser" class="tabcontent">
                                   <fieldset id="fset_1" style="min-height: 100%;">
                                          <legend>User Informations</legend>

                                          

                                          <input id="sel_emp_no" name="sel_emp_no" type="hidden" value="<?php echo $username; ?>">
                                          <!--FROM SESSION -->

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Latitude <span class="required">*</span></div>
                                                 <div class="col-sm-4">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="sel_latitude" name="sel_latitude" type="text" value="" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Longitude <span class="required">*</span></div>
                                                 <div class="col-sm-4">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="sel_longitude" name="sel_longitude" type="text" value="" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">PIN Payslip <span class="required">*</span></div>
                                                 <div class="col-sm-4">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="sel_pin" name="sel_pin" type="text" value="" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                                        </div>
                                                 </div>
                                          </div>
                                   </fieldset>
                            </div>

                            <div id="tabbank" class="tabcontent">
                                   <fieldset id="fset_1" style="min-height: 100%;">
                                          <legend>Bank Information</legend>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Account Name <span class="required">*</span></div>
                                                 <div class="col-sm-4">
                                                        <div class="input-group">
                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="sel_account_name" name="sel_account_name" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="" placeholder="employee number">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Bank *</div>
                                                 <div class="col-sm-4" style="padding-bottom:5px">
                                                        <div class="input-group">
                                                               <select class="form-control input--style-6" autocomplete="off" autofocus="on" id="sel_bank_name" name="sel_bank_name" style="height: 33px;">
                                                                      <option value="" selected> --Select one --</option>
                                                                      <?php
                                                                      $sql = mysqli_query($connect, "SELECT * FROM toebank");
                                                                      while ($data = mysqli_fetch_array($sql)) {
                                                                      ?>
                                                                             <option value="<?= $data['bank'] ?>"><?= $data['bank'] ?></option>
                                                                      <?php
                                                                      }
                                                                      ?>
                                                               </select>
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Branch *</div>
                                                 <div class="col-sm-4" style="padding-bottom:5px">
                                                        <div class="input-group">
                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="sel_branch" name="sel_branch" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="" placeholder="Bank Branch">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Account no *</div>
                                                 <div class="col-sm-4" style="padding-bottom:5px">
                                                        <div class="input-group">
                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="sel_account_number" name="sel_account_number" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="" placeholder="Account Number">
                                                        </div>
                                                 </div>
                                          </div>

                                   </fieldset>
                            </div>

                            <div id="customfield" class="tabcontent">
                                   <fieldset id="fset_1" style="min-height: 100%;">
                                          <legend>Customfield</legend>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">NPWP - Customfield4 <span class="required">*</span></div>
                                                 <div class="col-sm-4">
                                                        <div class="input-group">
                                                               <input class="input--style-6" 
                                                                      autocomplete="off" 
                                                                      id="sel_customfield4" 
                                                                      name="sel_customfield4" 
                                                                      type="Text" 
                                                                      value="">
                                                        </div>
                                                 </div>
                                          </div>
                                          
                                          <div class="form-row">
                                                 <div class="col-sm-2 name">PTKP - Customfield5 <span class="required">*</span></div>
                                                 <div class="col-sm-4">
                                                        <div class="input-group">


                                                               <select class="input--style-6" autocomplete="off" autofocus="on" id="sel_ptkp" name="sel_ptkp" style="height: 33px;">
                                                                      <option value="" selected> --Select one --</option>
                                                                      <?php
                                                                      $sql = mysqli_query($connect, "SELECT * FROM hrmptkp GROUP BY ptkp_id");
                                                                      while ($data = mysqli_fetch_array($sql)) {
                                                                      ?>
                                                                             <option value="<?= $data['ptkp_id'] ?>"><?= $data['ptkp_id'] ?></option>
                                                                      <?php
                                                                      }
                                                                      ?>
                                                               </select>


                                                        </div>
                                                 </div>
                                          </div>
                                   </fieldset>
                            </div>

                            <div id="tabpayroll" class="tabcontent">
                                   <fieldset id="fset_1" style="min-height: 100%;">
                                          <legend>Payroll Component</legend>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Bpjs Jaminan Kesehatan <span class="required">*</span></div>
                                                 <div class="col-sm-4">
                                                        <div class="input-group">
                                                               <select class="input--style-6" autocomplete="off" autofocus="on" id="sel_bpjskes" name="sel_bpjskes" style="height: 33px;">
                                                                      <option value="" selected> --Select one --</option>
                                                                      <?php
                                                                      $sql = mysqli_query($connect, "SELECT * FROM db_config_str WHERE id IN ('17','18')");
                                                                      while ($data = mysqli_fetch_array($sql)) {
                                                                      ?>
                                                                             <option value="<?= $data['remark'] ?>"><?= $data['var1'] ?></option>
                                                                      <?php
                                                                      }
                                                                      ?>
                                                               </select>
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Bpjs Jaminan Pensiun <span class="required">*</span></div>
                                                 <div class="col-sm-4">
                                                        <div class="input-group">
                                                               <select class="input--style-6" autocomplete="off" autofocus="on" id="sel_bpjspensiun" name="sel_bpjspensiun" style="height: 33px;">
                                                                      <option value="" selected> --Select one --</option>
                                                                      <?php
                                                                      $sql = mysqli_query($connect, "SELECT * FROM db_config_str WHERE id IN ('17','18')");
                                                                      while ($data = mysqli_fetch_array($sql)) {
                                                                      ?>
                                                                             <option value="<?= $data['remark'] ?>"><?= $data['var1'] ?></option>
                                                                      <?php
                                                                      }
                                                                      ?>
                                                               </select>
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Bpjs Jaminan Ketenagakerjaan <span class="required">*</span></div>
                                                 <div class="col-sm-4">
                                                        <div class="input-group">
                                                               <select class="input--style-6" autocomplete="off" autofocus="on" id="sel_bpjsket" name="sel_bpjsket" style="height: 33px;">
                                                                      <option value="" selected> --Select one --</option>
                                                                      <?php
                                                                      $sql = mysqli_query($connect, "SELECT * FROM db_config_str WHERE id IN ('17','18')");
                                                                      while ($data = mysqli_fetch_array($sql)) {
                                                                      ?>
                                                                             <option value="<?= $data['remark'] ?>"><?= $data['var1'] ?></option>
                                                                      <?php
                                                                      }
                                                                      ?>
                                                               </select>
                                                        </div>
                                                 </div>
                                          </div>


                                         
                                          
                                   </fieldset>
                            </div>

                            <div id="tabfams" class="tabcontent">
                                   <fieldset id="fset_1" style="min-height: 100%;">

                                   <?php
                                          if ($get_auth_r['user_type'] == 'SuperAdmin') {
                                   ?>
                                          <table width="100%">                         
                                                 <td>
                                                        <button class="btn btn-primary ml-auto" data-toggle="modal" data-target="#FamilyForm" id="FamilyAddForms" data-keyboard="false" data-backdrop="static" style="width: 100%;border-radius: 103px;font-size: 10px;background: grey;" type="button">Add Family</button>
                                                 </td>
                                                 <td text-align: right;>
                                          </table>
                                   <?php } else { ?>
                                   <?php } ?>
                                   
                                                                                    
                                          <legend>Family & Dependents</legend>

                                          <div id="family_personal_list"></div>
                                   </fieldset>
                            </div>

                            <div id="tabtraining" class="tabcontent">
                                   <fieldset id="fset_1" style="min-height: 100%;">
                                          <legend>Training Record</legend>  
                                   </fieldset>
                            </div>
                     </div>

                     <!-- END SCROLLING -->



                     

                     <?php
                            if ($get_auth_r['user_type'] == 'SuperAdmin') {
                     ?>
                            <div class="modal-footer-sdk">
                                   <button type="reset" class="btn-sdk btn-primary-left" data-dismiss="modal" aria-hidden="true">
                                          &nbsp;Cancel&nbsp;
                                   </button>
                                   <button class="btn-sdk btn-primary-right" type="submit" name="submit_update" id="submit_update">
                                          Confirm
                                   </button>
                            </div> 
                     <?php } else { ?>
                            <div class="modal-footer-sdk">
                                   <button type="reset" class="btn-sdk btn-primary-center-only" data-dismiss="modal" aria-hidden="true">
                                          &nbsp;Close&nbsp;
                                   </button>
                            </div>
                     <?php } ?>
                     


              </div>

              </form>
       </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /edit modal -->


























































<!-- Modal -->
<div class="modal right fade" id="modalSettlement" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" data-backdrop="false">
       <div class="modal-dialog" role="document" style="top: 0px;width: 100%;">
              <div class="modal-content" style="overflow: scroll;">
                     <div class="modal-body" style="background: url('../../asset/img/bgcol.png?v=1') no-repeat fixed center; background-size: cover;border-bottom-right-radius: 100px;border-bottom-left-radius: 100px;height:10px">

                            <button type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true" style="color: white;">&times;</span>
                            </button>


                            <!--PEN CONTENT     -->
                            <div class="content">
                                   <!--content inner-->
                                   <div class="content__inner">
                                          <div class="container">
                                                 <!--multisteps-form-->
                                                 <div class="multisteps-form">
                                                        <!--progress bar-->
                                                        <div class="row">
                                                               <div class="col-12">
                                                                      <div class="multisteps-form__progress">
                                                                             <button class="multisteps-form__progress-btn js-active" type="button"><b style="font-weight: bold;">Employee Information</b><br>Informasi Karyawan</button>
                                                                             <!-- <button class="multisteps-form__progress-btn" type="button" title="Informasi Bank">Informasi Bank </button>
                                                                             
                                                                             <button class="multisteps-form__progress-btn" type="button" title="Kontak Darurat">Kontak Darurat </button> -->
                                                                             <button class="multisteps-form__progress-btn" type="button"><b style="font-weight: bold;">Family & Dependent</b><br>Keluarga & Tanggungan</button>
                                                                             <button class="multisteps-form__progress-btn" type="button"><b style="font-weight: bold;">Supporting Document</b><br>Dokumen Pendukung </button>
                                                                      </div>
                                                               </div>
                                                        </div>
                                                        <!--form panels-->
                                                        <div class="row" style="margin-right: -45px;margin-left: -45px;">
                                                               <div class="col-12" style="top: 20px;padding-right: 0;padding-left: 0px;">

                                                                      <form class="multisteps-form__form form-horizontal" action="php_action/FuncDataUpdateEmployee.php<?php echo $getPackage; ?>" method="POST" id="FormSettlement" onkeydown="return event.key != 'Enter';">

                                                                             <!--single form panel-->
                                                                             <div class="multisteps-form__panel shadow p-4 bg-white js-active" style="border: 1px solid #d7d7d7; border-top-left-radius: 30px;border-top-right-radius: 30px;box-shadow: 0 .5rem 1rem rgba(255, 255, 255, 0.15) !important;background-color: #f5f5f5 !important;">


                                                                                    <table width="100%">
                                                                                           <tr>
                                                                                                  <td>
                                                                                                         <h3 class="multisteps-form__title">Employee Information</h3>
                                                                                                  </td>
                                                                                                  <td>
                                                                                                         <button class="btn btn-primary ml-auto" data-toggle="modal" data-target="#ListRequest" onclick="ListRequest(`<?php echo $username; ?>`)" data-keyboard="false" data-backdrop="static" style="width: 100%;border-radius: 103px;font-size: 10px;background: grey;" type="button">List Request</button>
                                                                                                  </td>
                                                                                           </tr>

                                                                                    </table>

                                                                                    <!-- <div class=" card-body table-responsive p-0" style=" width: 98.8%; margin: 5px;overflow-y: auto;overflow-x: hidden;border: 1px solid white;"> -->
                                                                                    <div class="card-body table-responsive p-0" style="height: 50vh; width: 98.8%; margin: 5px;overflow-y: auto;overflow-x: hidden;border: 1px solid transparent;">

                                                                                           <div class="form-row" style="display:none;">
                                                                                                  <div class="col-lg-3 name"> <label>Employee No. </label><span class="required">*</span></div>
                                                                                                  <div class="col-lg-9" style="margin-top: 5px;">
                                                                                                         <div class="input-group">
                                                                                                                <input id="inp_emp_no" name="inp_emp_no" type="hidden" value="<?php echo $username; ?>">
                                                                                                                <input class="input--style-6" id="settlement_emp_id" name="settlement_emp_id" id="settlement_emp_id" type="hidden" onfocus="hlentry(this)" size="30" maxlength="50">
                                                                                                                <input class="input--style-6" autocomplete="off" autofocus="on" id="settlement_emp_no" name="settlement_emp_no" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" placeholder="Employee Number" readonly>
                                                                                                         </div>
                                                                                                  </div>
                                                                                           </div>
                                                                                           <div class="form-row">
                                                                                                  <div class="col-lg-3 name"> <label>Employee Name </label><br> Nama Karyawan<span class="required">*</span></div>
                                                                                                  <div class="col-lg-3" style="margin-top: 5px;">
                                                                                                         <div class="input-group">
                                                                                                                <input class="input--style-6" autocomplete="off" autofocus="on" id="settlement_first_name" name="settlement_first_name" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" placeholder="First Name">
                                                                                                         </div>
                                                                                                  </div>
                                                                                                  <div class="col-lg-3" style="margin-top: 5px;">
                                                                                                         <div class="input-group">
                                                                                                                <input class="input--style-6" autocomplete="off" autofocus="on" id="settlement_middle_name" name="settlement_middle_name" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" placeholder="Middle Name">
                                                                                                         </div>
                                                                                                  </div>
                                                                                                  <div class="col-lg-3" style="margin-top: 5px;">
                                                                                                         <div class="input-group">
                                                                                                                <input class="input--style-6" autocomplete="off" autofocus="on" id="settlement_last_name" name="settlement_last_name" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" placeholder="Last Name">
                                                                                                         </div>
                                                                                                  </div>
                                                                                           </div>
                                                                                           <div class="form-row">
                                                                                                  <div class="col-lg-3 name">
                                                                                                         <label>Join date</label><br> Tanggal Masuk
                                                                                                  </div>
                                                                                                  <div class="col-lg-4" style="margin-top: 5px;">
                                                                                                         <div class="input-group">
                                                                                                                <input class="input--style-6" autocomplete="off" autofocus="on" id="settlement_join_date" name="settlement_join_date" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" placeholder="Join Date">
                                                                                                         </div>
                                                                                                  </div>
                                                                                           </div>
                                                                                           <div class="form-row">
                                                                                                  <div class="col-lg-3 name">
                                                                                                         <label>Place / Birth date</label><br> Tempat/ Tanggal Lahir
                                                                                                  </div>
                                                                                                  <div class="col-lg-3" style="margin-top: 5px;">
                                                                                                         <div class="input-group">
                                                                                                                <input class="input--style-6" autocomplete="off" autofocus="on" id="settlement_place_ofbirth" name="settlement_place_ofbirth" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" placeholder="Place of Birth">
                                                                                                         </div>
                                                                                                  </div>

                                                                                                  <div class="col-lg-3" style="margin-top: 5px;">
                                                                                                         <div class="input-group">

                                                                                                                <input type="text" id="settlement_birth_date" class="input--style-6" name="settlement_birth_date" placeholder="Birth Date" style="
                                                                                                                              background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                                                                              background-size: 17px;
                                                                                                                              background-position:right;   
                                                                                                                              background-repeat:no-repeat; 
                                                                                                                              padding-right:10px;" autocomplete="off" />
                                                                                                         </div>
                                                                                                  </div>
                                                                                           </div>
                                                                                           <div class="form-row">
                                                                                                  <div class="col-lg-3 name">
                                                                                                         <label>ID Number</label><br> Nomor KTP
                                                                                                  </div>
                                                                                                  <div class="col-lg-6" style="margin-top: 5px;">
                                                                                                         <div class="input-group">
                                                                                                                <input class="input--style-6" autocomplete="off" autofocus="on" id="settlement_id_number" name="settlement_id_number" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" placeholder="ID Number">
                                                                                                         </div>
                                                                                                  </div>
                                                                                           </div>
                                                                                           <div class="form-row">
                                                                                                  <div class="col-lg-3 name">
                                                                                                         <label>ID Family Number</label><br> Nomor KK
                                                                                                  </div>
                                                                                                  <div class="col-lg-6" style="margin-top: 5px;">
                                                                                                         <div class="input-group">
                                                                                                                <input class="input--style-6" autocomplete="off" autofocus="on" id="settlement_idfamily" name="settlement_idfamily" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" placeholder="ID Family Number">
                                                                                                         </div>
                                                                                                  </div>
                                                                                           </div>
                                                                                           <div class="form-row">
                                                                                                  <div class="col-lg-3 name">
                                                                                                         <label>Gender</label><br> Jenis Kelamin
                                                                                                  </div>
                                                                                                  <div class="col-lg-6" style="margin-top: 5px;">
                                                                                                         <div class="input-group">

                                                                                                                <select name="settlement_gender" id="settlement_gender" placeholder="Gender" class="input--style-6" style="height: 33px;">
                                                                                                                       <option value="">-select one-</option>
                                                                                                                       <option value="1">Laki Laki</option>
                                                                                                                       <option value="0">Perempuan</option>
                                                                                                                </select>
                                                                                                         </div>
                                                                                                  </div>
                                                                                           </div>
                                                                                           <div class="form-row">
                                                                                                  <div class="col-lg-3 name">
                                                                                                         <label>Blood Type</label><br> Golongan Darah
                                                                                                  </div>
                                                                                                  <div class="col-lg-4" style="margin-top: 5px;">
                                                                                                         <div class="input-group">

                                                                                                                <select name="settlement_bloodtype" id="settlement_bloodtype" placeholder="Silahkan pilih golongan darah" class="input--style-6" style="height: 33px;">
                                                                                                                       <option value="">-select one-</option>
                                                                                                                       <option value="A">A</option>
                                                                                                                       <option value="B">B</option>
                                                                                                                       <option value="AB">AB</option>
                                                                                                                       <option value="O">O</option>
                                                                                                                </select>

                                                                                                         </div>
                                                                                                  </div>
                                                                                           </div>
                                                                                           <div class="form-row">
                                                                                                  <div class="col-lg-3 name">
                                                                                                         <label>Religion</label><br> Agama
                                                                                                  </div>
                                                                                                  <div class="col-lg-4" style="margin-top: 5px;">
                                                                                                         <div class="input-group">
                                                                                                                <select name="settlement_religion" id="settlement_religion" placeholder="Silahkan pilih agama" class="input--style-6" style="height: 33px;">
                                                                                                                       <option value="">-select one-</option>
                                                                                                                       <option value="ISLM">Islam</option>
                                                                                                                       <option value="CHRS">Kristen</option>
                                                                                                                       <option value="KTLK">Katolik</option>
                                                                                                                       <option value="HNDU">Hindu</option>
                                                                                                                       <option value="BUDH">Budha</option>
                                                                                                                       <option value="KHCU">Kong Hu Cu</option>
                                                                                                                       <option value="OTHER">Lainnya</option>
                                                                                                                </select>

                                                                                                         </div>
                                                                                                  </div>
                                                                                           </div>
                                                                                           <div class="form-row">
                                                                                                  <div class="col-lg-3 name">
                                                                                                         <label>Marital Status</label><br> Status Perkawinan
                                                                                                  </div>
                                                                                                  <div class="col-lg-4" style="margin-top: 5px;">
                                                                                                         <div class="input-group">
                                                                                                                <select name="settlement_maritalstatus" id="settlement_maritalstatus" placeholder="Marital Status" class="input--style-6" style="height: 33px;">
                                                                                                                       <option value="">-select one-</option>
                                                                                                                       <option value="1">Kawin</option>
                                                                                                                       <option value="0">Belum Kawin</option>
                                                                                                                       <option value="2">Duda</option>
                                                                                                                       <option value="3">Janda</option>
                                                                                                                </select>
                                                                                                         </div>
                                                                                                  </div>
                                                                                           </div>
                                                                                           <div class="form-row">
                                                                                                  <div class="col-lg-3 name">
                                                                                                         <label>Nationality</label><br> Kebangsaan
                                                                                                  </div>
                                                                                                  <div class="col-lg-4" style="margin-top: 5px;">
                                                                                                         <div class="input-group">
                                                                                                                <input class="input--style-6" autocomplete="off" autofocus="on" id="settlement_nationality" name="settlement_nationality" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" placeholder="Nationality">
                                                                                                         </div>
                                                                                                  </div>
                                                                                           </div>
                                                                                           <div class="form-row">
                                                                                                  <div class="col-lg-3 name">
                                                                                                         <label>Phone Number</label><br> Nomor Telepon
                                                                                                  </div>
                                                                                                  <div class="col-lg-6" style="margin-top: 5px;">
                                                                                                         <div class="input-group">
                                                                                                                <input class="input--style-6" autocomplete="off" autofocus="on" id="settlement_mobilephone" name="settlement_mobilephone" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" placeholder="Employee Contact [Phone Number]">
                                                                                                         </div>
                                                                                                  </div>
                                                                                           </div>
                                                                                           <div class="form-row">
                                                                                                  <div class="col-lg-3 name">
                                                                                                         <label>Personal Email</label><br> Surel Pribadi
                                                                                                  </div>
                                                                                                  <div class="col-lg-4" style="margin-top: 5px;">
                                                                                                         <div class="input-group">
                                                                                                                <input class="input--style-6" autocomplete="off" autofocus="on" id="settlement_personalmail" name="settlement_personalmail" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" placeholder="Employee Contact [Personal Email]">
                                                                                                         </div>
                                                                                                  </div>
                                                                                           </div>
                                                                                           <div class="form-row">
                                                                                                  <div class="col-lg-3 name">
                                                                                                         <label>Office Email</label> Surel Kantor
                                                                                                  </div>
                                                                                                  <div class="col-lg-4" style="margin-top: 5px;">
                                                                                                         <div class="input-group">
                                                                                                                <input class="input--style-6" autocomplete="off" autofocus="on" id="settlement_officemail" name="settlement_officemail" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" placeholder="Employee Contact [Office Email]">
                                                                                                         </div>
                                                                                                  </div>
                                                                                           </div>



                                                                                           <div class="form-row">
                                                                                                  <div class="col-lg-3 name">
                                                                                                         <label>Current Address <span class='badge badge-Partially-Approved' style="color: white;font-weight: bold;font-size: 12px;margin-bottom: 5px;width: auto;"> ( Base on Identity ) </span></label> Alamat Domisili (Sesuai KTP)
                                                                                                  </div>
                                                                                                  <div class="col-lg-9" style="margin-top: 5px;">
                                                                                                         <div class="input-group">
                                                                                                                <textarea style="height: 100px;" rows="4" name="settlement_current_address" id="settlement_current_address" placeholder="Full Current Address" class="input--style-6"></textarea>
                                                                                                         </div>
                                                                                                  </div>
                                                                                           </div>

                                                                                           <div class="form-row">
                                                                                                  <div class="col-lg-3 name">

                                                                                                  </div>
                                                                                                  <div class="col-lg-3" style="margin-top: 5px;">
                                                                                                         <div class="input-group">
                                                                                                                <!-- <input class="input--style-6 action_domisili" autocomplete="off" autofocus="on" id="settlement_curcountry" name="settlement_curcountry" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" placeholder="Country"> -->
                                                                                                                <?php
                                                                                                                $country = '';
                                                                                                                $query = "SELECT country_id,country_name FROM hrmcountry GROUP BY country_code ORDER BY country_code ASC";
                                                                                                                $result = mysqli_query($connect, $query);
                                                                                                                while ($row = mysqli_fetch_array($result)) {
                                                                                                                       $country .= '<option value="' . $row["country_id"] . '">' . $row["country_name"] . '</option>';
                                                                                                                }
                                                                                                                ?>
                                                                                                                <select name="settlement_curcountry" id="settlement_curcountry" placeholder="Country" class="input--style-6 action_domisili" style="height: 33px;">
                                                                                                                       <option value="<?php !empty($r['domisili_country_id']) ? $domisili_country_id = $r['domisili_country_id'] : $domisili_country_id = '';
                                                                                                                                            echo $domisili_country_id; ?>">
                                                                                                                              <?php !empty($r['domisili_country_name']) ? $domisili_country_name = $r['domisili_country_name'] : $domisili_country_name = 'Select Country';
                                                                                                                              echo $domisili_country_name; ?></option>
                                                                                                                       <?php echo $country; ?>
                                                                                                                </select>
                                                                                                         </div>
                                                                                                  </div>
                                                                                                  <div class="col-lg-3" style="margin-top: 5px;">
                                                                                                         <div class="input-group">

                                                                                                                <select name="settlement_curprovince" id="settlement_curprovince" placeholder="Country" class="input--style-6 action_domisili" style="height: 33px;">
                                                                                                                       <option value="<?php !empty($r['settlement_curprovince_id']) ? $settlement_curprovince_id = $r['settlement_curprovince_id'] : $settlement_curprovince_id = '';
                                                                                                                                            echo $settlement_curprovince_id; ?>">
                                                                                                                              <?php !empty($r['settlement_curprovince_name']) ? $settlement_curprovince_name = $r['settlement_curprovince_name'] : $settlement_curprovince_name = 'Select State/City';
                                                                                                                              echo $settlement_curprovince_name; ?></option>
                                                                                                                       <?php !empty($r['domisili_country_id']) ? $where_country_id = "WHERE country_id = '$r[domisili_country_id]'" : $where_country_id = ''; ?>
                                                                                                                       <?php
                                                                                                                       $get_state = mysqli_query($connect, "SELECT state_id,state_name FROM hrmstate $where_country_id");
                                                                                                                       if (mysqli_num_rows($get_state) != 0) {
                                                                                                                              while ($row_state = mysqli_fetch_array($get_state)) {
                                                                                                                                     echo '<option value=' . $row_state['state_id'] . '>' . $row_state['state_name'] . '</option>';
                                                                                                                              }
                                                                                                                       }
                                                                                                                       ?>
                                                                                                                </select>


                                                                                                         </div>
                                                                                                  </div>
                                                                                                  <div class="col-lg-3" style="margin-top: 5px;">
                                                                                                         <div class="input-group">

                                                                                                                <select name="settlement_curcity" id="settlement_curcity" class="input--style-6 action_domisili" style="height: 33px;">
                                                                                                                       <option value="<?php !empty($r['settlement_curcity_id']) ? $settlement_curcity_id = $r['settlement_curcity_id'] : $settlement_curcity_id = '';
                                                                                                                                            echo $settlement_curcity_id; ?>">
                                                                                                                              <?php !empty($r['settlement_curcity_name']) ? $settlement_curcity_name = $r['settlement_curcity_name'] : $settlement_curcity_name = 'Select City';
                                                                                                                              echo $settlement_curcity_name; ?></option>
                                                                                                                       <?php !empty($r['domisili_state_id']) ? $where_state_id = "WHERE state_id = '$r[domisili_state_id]'" : $where_state_id = ''; ?>
                                                                                                                       <?php
                                                                                                                       $get_city = mysqli_query($connect, "SELECT city_id,city_name FROM hrmcity $where_state_id");
                                                                                                                       if (mysqli_num_rows($get_city) != 0) {
                                                                                                                              while ($row_city = mysqli_fetch_array($get_city)) {
                                                                                                                                     echo '<option value=' . $row_city['city_id'] . '>' . $row_city['city_name'] . '</option>';
                                                                                                                              }
                                                                                                                       }
                                                                                                                       ?>
                                                                                                                </select>
                                                                                                         </div>
                                                                                                  </div>
                                                                                           </div>

                                                                                           <div class="form-row">
                                                                                                  <div class="col-lg-3 name">

                                                                                                  </div>
                                                                                                  <div class="col-lg-3" style="margin-top: 5px;">
                                                                                                         <div class="input-group">
                                                                                                                <select name="settlement_curdistrict" id="settlement_curdistrict" class="input--style-6 action_domisili" style="height: 33px;">
                                                                                                                       <option value="<?php !empty($r['settlement_curdistrict_id']) ? $settlement_curdistrict_id = $r['settlement_curdistrict_id'] : $settlement_curdistrict_id = '';
                                                                                                                                            echo $settlement_curdistrict_id; ?>">
                                                                                                                              <?php !empty($r['settlement_curdistrict_name']) ? $settlement_curdistrict_name = $r['settlement_curdistrict_name'] : $settlement_curdistrict_name = 'Select District';
                                                                                                                              echo $settlement_curdistrict_name; ?></option>
                                                                                                                       <?php !empty($r['domisili_city_id']) ? $where_city_id = "WHERE city_id = '$r[domisili_city_id]'" : $where_city_id = ''; ?>
                                                                                                                       <?php
                                                                                                                       $get_district = mysqli_query($connect, "SELECT district_id,district_name FROM hrmdistrict $where_city_id");
                                                                                                                       if (mysqli_num_rows($get_district) != 0) {
                                                                                                                              while ($row_district = mysqli_fetch_array($get_district)) {
                                                                                                                                     echo '<option value=' . $row_district['district_id'] . '>' . $row_district['district_name'] . '</option>';
                                                                                                                              }
                                                                                                                       }
                                                                                                                       ?>
                                                                                                                </select>
                                                                                                         </div>
                                                                                                  </div>





                                                                                                  <div class="col-lg-3" style="margin-top: 5px;">
                                                                                                         <div class="input-group">
                                                                                                                <input class="input--style-6" autocomplete="off" autofocus="on" id="settlement_curpostalcode" name="settlement_curpostalcode" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" placeholder="RT">
                                                                                                         </div>
                                                                                                  </div>
                                                                                                  <div class="col-lg-1" style="margin-top: 5px;">
                                                                                                         <div class="input-group">
                                                                                                                <input class="input--style-6" autocomplete="off" autofocus="on" id="settlement_currt" name="settlement_currt" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" placeholder="RT">
                                                                                                         </div>
                                                                                                  </div>
                                                                                                  <div class="col-lg-1" style="margin-top: 5px;">
                                                                                                         <div class="input-group">
                                                                                                                <input class="input--style-6" autocomplete="off" autofocus="on" id="settlement_currw" name="settlement_currw" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" placeholder="RW">
                                                                                                         </div>
                                                                                                  </div>

                                                                                           </div>



                                                                                    </div>

                                                                                    <!-- <div style="border: 1px solid #e2e0e0;margin-left: 10px;margin-right: 10px;"></div> -->

                                                                                    <!-- <div class="button-row d-flex mt-4"> -->
                                                                                           <div class="modal-footer-sdk">
                                                                                           <button class="btn-sdk btn-primary-center-only js-btn-next" type="button" onclick="topFunction()" id="myBtn" title="Next">Next</button>
                                                                                           </div>

                                                                                           <!-- <div class="modal-footer-sdk">
                                                                                                  <button type="reset" class="btn-sdk btn-primary-left" data-dismiss="modal" onclick="ResetTable();" aria-hidden="true">
                                                                                                         &nbsp;Cancel&nbsp;
                                                                                                  </button>
                                                                                                  <button class="btn-sdk btn-primary-right" type="submit" name="submit_add" id="submit_add">
                                                                                                         Confirm
                                                                                                  </button>
                                                                                                  <button class="btn-sdk btn-primary-right" type="button" name="submit_add2" id="submit_add2" style="display:none;" disabled="">
                                                                                                         <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                                                                                         &nbsp;&nbsp;Processing..
                                                                                                  </button>
                                                                                           </div> -->


                                                                                    <!-- </div> -->



                                                                             </div>

                                                                             <!--single form panel-->
                                                                             <div class="multisteps-form__panel shadow p-4 bg-white" data-animation="scaleIn" style="border: 1px solid #d7d7d7; border-top-left-radius: 30px;border-top-right-radius: 30px;box-shadow: 0 .5rem 1rem rgba(255, 255, 255, 0.15) !important;background-color: #f5f5f5 !important;">


                                                                                    <table width="100%">
                                                                                           <td>
                                                                                                  <h3 class="multisteps-form__title">Family & Dependent</h3>
                                                                                           </td>
                                                                                           <td>
                                                                                                  <button class="btn btn-primary ml-auto" data-toggle="modal" data-target="#FamilyForm" id="FamilyAddFormsMember" data-keyboard="false" data-backdrop="static" style="width: 100%;border-radius: 103px;font-size: 10px;background: grey;" type="button">Add Family</button>
                                                                                           </td>
                                                                                           <td text-align: right;>


                                                                                    </table>



                                                                                    <!-- <div class="card-body table-responsive p-0" style="height: 50vh; width: 98.8%; margin: 5px;overflow-y: auto;overflow-x: hidden;border: 1px solid transparent;"> -->
                                                                                    <div class="card-body table-responsive p-0" style="height: 50vh; width: 98.8%; margin: 5px;overflow-y: auto;overflow-x: hidden;border: 1px solid transparent;">

                                                                                           <div class="multisteps-form__content">
                                                                                                  <div class="form-row">
                                                                                                         <div class="col-sm-12">
                                                                                                                <div id="family_list"></div>
                                                                                                         </div>
                                                                                                  </div>
                                                                                           </div>
                                                                                    </div>

                                                                                    <!-- <div style="border: 1px solid #e2e0e0;margin-left: 10px;margin-right: 10px;"></div> -->

                                                                                    <!-- <div class="button-row d-flex mt-4">
                                                                                           <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
                                                                                           <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next">Next</button>
                                                                                    </div> -->

                                                                                    <div class="modal-footer-sdk">
                                                                                           <button class="btn-sdk btn-primary-left js-btn-prev" type="button" id="myBtn" title="Prev">Prev</button>
                                                                                           <button class="btn-sdk btn-primary-right ml-auto js-btn-next" type="button" title="Next">Next</button>
                                                                                    </div>


                                                                             </div>
                                                                             <!--single form panel-->
                                                                             <div class="multisteps-form__panel shadow p-4 bg-white" data-animation="scaleIn" style="border: 1px solid #d7d7d7; border-top-left-radius: 30px;border-top-right-radius: 30px;box-shadow: 0 .5rem 1rem rgba(255, 255, 255, 0.15) !important;background-color: #f5f5f5 !important;">
                                                                                    <h3 class="multisteps-form__title">Suporting Document</h3>


                                                                                    <div class="multisteps-form__content">

                                                                                    <div class="card-body table-responsive p-0" style="height: 50vh; width: 98.8%; margin: 5px;overflow-y: auto;overflow-x: hidden;border: 1px solid transparent;">
                                                                                           

                                                                                                  <!-- Column -->

                                                                                                  <div class="col-md-12">
                                                                                                         <br>
                                                                                                         <div class="row" id="form_attachment">
                                                                                                         </div>

                                                                                                  </div>



                                                                                           </div>
                                                                                    </div>
                                                                                    <!-- <div style="border: 1px solid #e2e0e0;margin-left: 10px;margin-right: 10px;"></div> -->
                                                                                    <!-- <div class="button-row d-flex mt-4">
                                                                                           <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
                                                                                           <button class="btn btn-success ml-auto" type="submit" title="Send">Send</button>
                                                                                    </div> -->

                                                                                    <div class="modal-footer-sdk">
                                                                                           <button class="btn-sdk btn-primary-left js-btn-prev" type="button" id="myBtn" title="Prev">Prev</button>
                                                                                           <button class="btn-sdk btn-primary-right ml-auto" type="submit" title="Send">Submit</button>
                                                                                    </div>
                                                                             </div>
                                                               </div>
                                                               </form>
                                                        </div>
                                                 </div>
                                          </div>
                                   </div>
                            </div>
                     </div>
              </div>

       </div><!-- modal-content -->
</div><!-- modal-dialog -->
</div><!-- modal -->







<!-- add modal -->
<div class="modal  fade fade-custom" tabindex="-1" role="dialog" id="FamilyForm">
       <div class="modal-dialog modal-belakang modal-sm" role="document">
              <div class="modal-content">
                     <div class="modal-header">
                            <h4 class="modal-title">Add Family</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

                            <form class="form-horizontal" action="php_action/FuncDataUpdateFamily.php" method="POST" id="FormFamily">

                                   <fieldset id="fset_1">
                                          <legend>Detail Information</legend>
                                          <div class="form-row">
                                                 <div class="col-sm-3 name">Relationship <span class="required">*</span></div>
                                                 <div class="col-sm-9 name">
                                                        <div class="input-group">
                                                               <input id="inp_emp_no" name="inp_emp_no" type="hidden" value="<?php echo $username; ?>">
                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="family_empfamily_id" name="family_empfamily_id" type="hidden" value="" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">

                                                               <select name="family_relationship" id="family_relationship" placeholder="Marital Status" class="input--style-6" style="height: 33px;">
                                                                      <option value="">-select one-</option>
                                                                      <?php
                                                                      $get_relation = mysqli_query($connect, "SELECT relationship_code,relationship_name_id FROM hrmfamilyrelation WHERE relationship_code <> '$row[relationship]' ORDER BY `order` ASC");

                                                                      while ($rows = mysqli_fetch_array($get_relation)) {
                                                                             echo '<option value=' . $rows['relationship_code'] . '>' . $rows['relationship_name_id'] . '</option>';
                                                                      }
                                                                      ?>
                                                               </select>

                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-3 name">Name <span class="required">*</span></div>
                                                 <div class="col-sm-9 name">
                                                        <div class="input-group">
                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="family_name" name="family_name" placeholder="Family Name" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-3 name">Birth Date <span class="required">*</span></div>
                                                 <div class="col-sm-9 name">
                                                        <div class="input-group">
                                                               <input type="text" id="family_birth_date" class="input--style-6" name="family_birth_date" placeholder="Birth Date" style="
                                                                      background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                      background-size: 17px;
                                                                      background-position:right;   
                                                                      background-repeat:no-repeat; 
                                                                      padding-right:10px;" autocomplete="off" data-dtp="dtp_tAL63">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-3 name">Gender <span class="required">*</span></div>
                                                 <div class="col-sm-6">
                                                        <div class="input-group">

                                                               <select name="family_gender" id="family_gender" placeholder="Gender" class="input--style-6" style="height: 33px;">
                                                                      <option value="">-select one-</option>
                                                                      <?php
                                                                      $sql = mysqli_query($connect, "SELECT * FROM ttamgender GROUP BY gender_name");
                                                                      while ($data = mysqli_fetch_array($sql)) {
                                                                      ?>
                                                                             <option value="<?= $data['id'] ?>"><?= $data['gender_name'] ?></option>
                                                                      <?php
                                                                      }
                                                                      ?>
                                                               </select>
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-3 name">Alive status <span class="required">*</span></div>
                                                 <div class="col-sm-6">
                                                        <div class="input-group">

                                                               <select name="family_alivestatus" id="family_alivestatus" placeholder="Marital Status" class="input--style-6" style="height: 33px;">
                                                                      <option value="">-select one-</option>
                                                                      <option value="1">Hidup</option>
                                                                      <option value="0">Meninggal</option>
                                                               </select>
                                                        </div>
                                                 </div>
                                          </div>




                                   </fieldset>
                     </div>
                     <div class="modal-footer-sdk">
                            <button type="reset" class="btn-sdk btn-primary-left" data-dismiss="modal" onclick="ResetTable();" aria-hidden="true">
                                   &nbsp;Cancel&nbsp;
                            </button>
                            <button class="btn-sdk btn-primary-right" type="submit" name="submit_add" id="submit_add">
                                   Confirm
                            </button>
                            <button class="btn-sdk btn-primary-right" type="button" name="submit_add2" id="submit_add2" style='display:none;' disabled>
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
<div class="modal  fade fade-custom" tabindex="-1" role="dialog" id="ListRequest">
       <div class="modal-dialog modal-belakang modal-sm" role="document">
              <div class="modal-content">
                     <div class="modal-header">
                            <h4 class="modal-title">List of Employee Data Changes</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

                            <form class="form-horizontal" action="php_action/FuncDataUpdateFamily.php<?php echo $getPackage; ?>" method="POST" id="FormEmployeeDataChanges">

                                   <fieldset id="fset_1">
                                          <legend>Detail Information</legend>
                                          <div class="form-row">
                                                 <div class="col-lg-12 name" id="listofrequest"></div>
                                          </div>
                                   </fieldset>
                     </div>
                     <div class="modal-footer-sdk">
                            <button type="reset" class="btn-sdk btn-primary-center-only" data-dismiss="modal" onclick="ResetTable();" aria-hidden="true">
                                   &nbsp;Close&nbsp;
                            </button>
                     </div>

                     </form>
              </div>
       </div>
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /edit modal -->














































<!-- add modal -->
<div class="modal  fade fade-custom" tabindex="-1" role="dialog" id="ApprovalForm">
       <div class="modal-dialog modal-belakang modal-bs modal-med" role="document">
              <div class="modal-content">
                     <div class="modal-header">
                            <h4 class="modal-title">Approval</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 99%; margin: 5px;overflow: scroll;overflow-x: hidden;">

                            <form class="form-horizontal" action="php_action/FuncDataUpdate.php<?php echo $getPackage; ?>" method="POST" id="updatedelMemberForm">

                                   <fieldset id="fset_1">
                                          <legend>&nbsp;Detail Information&nbsp;</legend>

                                          

                                          <input id="sel_emp_no_approver" name="sel_emp_no_approver" type="hidden" value="<?php echo $username; ?>">
                                          <!--FROM SESSION -->

                                          <div class="form-row">
                                                 <div class="col-sm-4 name"> Request No. <span class="required">*</span></div>
                                                 <div class="col-sm-8 name">
                                                        <div class="input-group" id="contoh" style="display:none; font-weight: bold;color: #5b5b5b;">
                                                        </div>
                                                        <div class="input-group" id="sel_identity_request_no" style="font-weight: bold;color: #5b5b5b;">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-4 name"> Employee <span class="required">*</span></div>
                                                 <div class="col-sm-8 name">
                                                        <div class="input-group" id="sel_identity_requester" style="font-weight: bold;color: #5b5b5b;">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row" style="display:none">
                                                 <div class="col-4 name"> APP Detail <span class="required">*</span></div>
                                                 <div class="col-sm-8">
                                                        <div class="input-group">
                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="sel_approval_request_no" name="sel_approval_request_no" type="Text">
                                                        </div>
                                                 </div>
                                          </div>
                                   </fieldset>

                                   <fieldset id="fset_1">
                                          <legend>Approval Detail</legend>
                                          <div class="card-body table-responsive p-0" style="width: 99%; margin: 1px;overflow: scroll;">
                                                 <!-- pages relation -->
                                                 <div id="box_approval_request_detail"></div>
                                                 <!-- pages relation -->
                                                 <div>
                                                 </div>

                                   </fieldset>
                     </div>
                     <!-- //LOAD BUTTON APPROVER STATUS -->

                     <div class="modal-footer-sdk" id="modalcancelcondition_0">
                            <!-- <box class="shine"></box>
                                          <div><lines class="shine"></lines></div> -->

                            <div type="reset" class="shine btn-sdk btn-primary-center-only" data-dismiss="modal" aria-hidden="true">
                                   &nbsp;Close&nbsp;
                            </div>
                     </div>
                     <div class="modal-footer-sdk" id="modalcancelcondition_1" style="display:none">
                            <button type="reset" class="btn-sdk btn-primary-center-only" data-dismiss="modal" aria-hidden="true">
                                   &nbsp;Close&nbsp;
                            </button>
                     </div>
                     <div class="modal-footer-sdk" id="modalcancelcondition_2" style="display:none">
                            <button type="reset" class="btn-sdk btn-primary-left" data-dismiss="modal" aria-hidden="true">
                                   &nbsp;Cancel&nbsp;
                            </button>
                            <a id="cancellation_id" style="padding-top: 8px;" class="btn-sdk btn-primary-right delete" type="submit" name="submit_update" id="submit_update">
                                   Cancel Request
                            </a>
                     </div>
                     <!-- //LOAD BUTTON APPROVER STATUS -->



                     </form>
              </div>
       </div>
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /edit modal -->



























<!-- add modal -->
<div class="modal  fade fade-custom" tabindex="-1" role="dialog" id="PreviewForm">
       <div class="modal-dialog modal-belakang modal-bs modal-bgkpi" role="document">
              <div class="modal-content">
                     <div class="modal-header">
                            <h4 class="modal-title">Preview Form</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

                            <form class="form-horizontal" action="php_action/FuncDataUpdate.php<?php echo $getPackage; ?>" method="POST">


                                   <!-- pages relation -->
                                   <div id="box_preview_request_detail"></div>
                                   <!-- pages relation -->



                     </div>
                     <!-- //LOAD BUTTON APPROVER STATUS -->
                     <div class="modal-footer-sdk" id="modalcancelcondition_1">
                            <button type="reset" class="btn-sdk btn-primary-center-only" data-dismiss="modal" aria-hidden="true">
                                   &nbsp;Close&nbsp;
                            </button>
                     </div>
                     <!-- //LOAD BUTTON APPROVER STATUS -->
                     </form>
              </div>
       </div>
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /edit modal -->





























<!-- delete transaction modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="FormDisplayDelete">

       <div class="modal-dialog modal-vsm" style="margin-top: 120px;">
              <div class="modal-content" style="border-radius: 5px;">
                     <form class="form-horizontal" action="php_action/FuncDataFamilyDelete.php<?php echo $getPackage; ?>" method="POST" id="DeleteFormDisplay">

                            <div class="modal-body">
                                   <div class="edit-messages"></div>
                                   <table width="100%">
                                          <tr>
                                                 <td align="center"><img src="../../asset/dist/img/sf-mola-mola.png" style="max-width: 90%;margin-top: 20px;"></td>
                                          </tr>
                                   </table>
                                   <div class="form-group">
                                          <div class="col-sm-12">
                                                 <table width="100%">
                                                        <td align="center"><label id="isi" style="margin-bottom: 13px;">Are you sure to delete family ?</label></td>
                                                 </table>
                                                 <input type="hidden" id="family_delete_empfamily_id" name="family_delete_empfamily_id">
                                                 <input type="hidden" id="family_delete_emp_id" name="family_delete_emp_id">
                                          </div>
                                   </div>

                                   <div class="modal-footer-delete FormDisplayDelete" id="bottom_action" style="text-align: center;padding-bottom: 14px;">
                                          <button type="reset" class="btn btn-primary1" data-dismiss="modal" onclick="ResetTable();" aria-hidden="true">
                                                 &nbsp;Cancel&nbsp;
                                          </button>
                                          <button class="btn btn-warning" type="submit" name="submit_delete" id="submit_delete">
                                                 Confirm
                                          </button>
                                   </div>

                                   <div class="modal-footer-sdk" id="bottom_action1" style="background: transparent;display:none;">
                                          <button type="reset" class="btn-sdk btn-primary-center-only" data-dismiss="modal" aria-hidden="true">
                                                 &nbsp;Close&nbsp;
                                          </button>
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
<script>
       function ResetTable() {
              $("#tbl_posts > tbody > .reset-delete-record").html("");
              $("#tbl_posts_second > tbody > .reset-delete-record").html("");

              for (let i = 2; i < 100; i++) {
                     jQuery('#rec-' + [i]).remove();
                     jQuery('#recs-' + [i]).remove();
              }
       }
</script>









































<!-- isi JSON -->
<script type="text/javascript">
       // global the manage memeber table 
       $(document).ready(function() {
              $("#CreateButton").on('click', function() {
                     // reset the form 
                     $("#FormDisplayCreate")[0].reset();
                     // empty the message div

                     $(".messages_create").html("");

                     // submit form
                     $("#FormDisplayCreate").unbind('submit').bind('submit', function() {

                            $(".text-danger").remove();

                            var form = $(this);

                            var inp_emp_id = $("#inp_emp_id").val();
                            var inp_first_name = $("#inp_first_name").val();
                            var inp_middle_name = $("#inp_middle_name").val();
                            var inp_last_name = $("#inp_last_name").val();
                            var inp_gender = $("#inp_gender").val();
                            var inp_identity_no = $("#inp_identity_no").val();
                            var inp_taxno = $("#inp_taxno").val();
                            var inp_email = $("#inp_email").val();
                            var inp_phone = $("#inp_phone").val();
                            var inp_birthplace = $("#inp_birthplace").val();
                            var inp_birthdate = $("#inp_birthdate").val();
                            var inp_maritalstatus = $("#inp_maritalstatus").val();
                            var inp_address = $("#inp_address").val();
                            var inp_city_id = $("#inp_city_id").val();
                            var inp_zipcode = $("#inp_zipcode").val();
                            var inp_employ_code = $("#inp_employ_code").val();
                            var inp_grade_code = $("#inp_grade_code").val();
                            var inp_cost_code = $("#inp_cost_code").val();
                            var inp_position_id = $("#inp_position_id").val();
                            var inp_worklocation_code = $("#inp_worklocation_code").val();
                            var inp_fileToUpload = $("#inp_fileToUpload").val();

                            var inp_joindate = $("#inp_joindate").val();
                            var inp_latitude = $("#inp_latitude").val();
                            var inp_longitude = $("#inp_longitude").val();
                            var inp_pin = $("#inp_pin").val();
                            var inp_shiftgroup_code = $("#inp_shiftgroup_code").val();
                            var inp_account_name = $("#inp_account_name").val();
                            var inp_bank_name = $("#inp_bank_name").val();
                            var inp_branch = $("#inp_branch").val();
                            var inp_account_number = $("#inp_account_number").val();


                            var regex = /^[a-zA-Z]+$/;

                            if (inp_emp_id == "") {
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Emp id cannot empty";

                            } else if (inp_first_name == "") {
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "First name cannot empty";

                            } else if (inp_gender == "") {
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Gender cannot empty";

                            } else if (inp_identity_no == "") {
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Identity no cannot empty";

                            } else if (inp_taxno == "") {
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Tax no cannot empty";

                            } else if (inp_email == "") {
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Email cannot empty";

                            } else if (inp_phone == "") {
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Phone cannot empty";

                            } else if (inp_birthplace == "") {
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "birthplace cannot empty";

                            } else if (inp_birthdate == "") {
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "birthdate cannot empty";

                            } else if (inp_maritalstatus == "") {
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "maritalstatus cannot empty";

                            } else if (inp_city_id == "") {
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "city cannot empty";

                            } else if (inp_zipcode == "") {
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "zipcode cannot empty";

                            } else if (inp_employ_code == "") {
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "employment status cannot empty";

                            } else if (inp_grade_code == "") {
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "grade code cannot empty";

                            } else if (inp_cost_code == "") {
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "cost code cannot empty";

                            } else if (inp_position_id == "") {
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "position cannot empty";

                            } else if (inp_worklocation_code == "") {
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "worklocation cannot empty";

                            } else if (inp_fileToUpload == "") {
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Attachment cannot empty";

                            } else if (inp_joindate == "") {
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Join date cannot empty";

                            } else if (inp_latitude == "") {
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Latitude cannot empty";

                            } else if (inp_longitude == "") {
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Longitude cannot empty";

                            } else if (inp_pin == "") {
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Pin cannot empty";

                            } else if (inp_shiftgroup_code == "") {
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Shiftgroup cannot empty";

                            } else if (inp_account_name == "") {
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Bank Account cannot empty";

                            } else if (inp_bank_name == "") {
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Bank Name cannot empty";

                            } else if (inp_branch == "") {
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Branch cannot empty";

                            } else if (inp_account_number == "") {
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Account Number cannot empty";

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

                                                 // remove the error 
                                                 $(".form-group").removeClass('has-error').removeClass('has-success');

                                                 if (response.code == 'success_message') {
                                                        $('#submit_add').show();
                                                        $('#submit_add2').hide();

                                                        $('#FormDisplayCreate').modal('hide');
                                                        $("[data-dismiss=modal]").trigger({
                                                               type: "click"
                                                        });

                                                        // reset the form
                                                        $("#FormDisplayCreate")[0].reset();
                                                        // reload the datatables
                                                        datatable.ajax.reload(null, false);
                                                        // this function is built in function of datatables;

                                                        mymodalss.style.display = "none";
                                                        modals.style.display = "block";
                                                        document.getElementById("msg").innerHTML = response.messages;

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
                            url: 'php_action/getSelectedEmployee.php<?php echo $getPackage; ?>',
                            type: 'post',
                            data: {
                                   member_id: id
                            },
                            dataType: 'json',


                            success: function(response) {


                                   $("#sel_emp_id").val(response.emp_id);
                                   $("#sel_first_name").val(response.first_name);
                                   $("#sel_middle_name").val(response.middle_name);
                                   $("#sel_last_name").val(response.last_name);
                                   $("#sel_gender").val(response.gender);
                                   $("#sel_taxno").val(response.taxno);
                                   $("#sel_email").val(response.email);
                                   $("#sel_phone").val(response.phone);
                                   $("#sel_birthplace").val(response.birthplace);
                                   $("#sel_birthdate").val(response.birthdate);
                                   $("#sel_maritalstatus").val(response.maritalstatus);
                                   $("#editor_update").val(response.address);
                                   $("#sel_city_id").val(response.city_id);
                                   $("#sel_zipcode").val(response.zipcode);
                                   $("#sel_employ_code").val(response.employ_code);
                                   $("#sel_grade_code").val(response.grade_code);
                                   $("#sel_cost_code").val(response.cost_code);
                                   $("#sel_position_id").val(response.pos_name_en);
                                   $("#sel_worklocation_code").val(response.worklocation_code);
                                   $("#sel_shiftgroup_code").val(response.shiftgroup_code);
                                   $("#sel_joindate").val(response.joindate);
                                   $("#sel_identity_no").val(response.idnumber);
                                   $("#sel_joindate").val(response.start_date);

                                   $("#sel_joindate").val(response.start_date);
                                   $("#sel_joindate").val(response.start_date);

                                   $("#sel_customfield4").val(response.customfield4);
                                   $("#sel_ptkp").val(response.customfield5);
                                   $("#sel_pin").val(response.pin);

                                   $("#sel_bpjskes").val(response.kes);
                                   $("#sel_bpjspensiun").val(response.jp);
                                   $("#sel_bpjsket").val(response.ket);

                                   
                                   $("#sel_account_name").val(response.name_inbank);
                                   $("#sel_bank_name").val(response.bank);
                                   $("#sel_branch").val(response.cabang);
                                   $("#sel_account_number").val(response.rekening);

                                   $("#family_personal_list").load("pages_relation/_pages_family.php<?php echo $getPackage; ?>rfid=" + response.emp_id,
                                          function(responseTxt, statusTxt, jqXHR) {
                                                 if (statusTxt == "success") {
                                                        $("#family_personal_list").show();
                                                 }
                                                 if (statusTxt == "error") {
                                                        alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                                 }
                                          }
                                   );

                                   $("#career_list").load("pages_relation/_pages_career.php<?php echo $getPackage; ?>rfid=" + response.emp_id,
                                          function(responseTxt, statusTxt, jqXHR) {
                                                 if (statusTxt == "success") {
                                                        $("#career_list").show();
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

                                          var update_id_berita = $("#update_id_berita").val();
                                          var update_subject = $("#update_subject").val();

                                          var regex = /^[a-zA-Z]+$/;

                                          mymodalss.style.display = "block";

                                          if (sel_emp_id == "") {
                                                 mymodalss.style.display = "none";
                                                 modals.style.display = "block";
                                                 document.getElementById("msg").innerHTML = "Overtime code cannot empty";
                                          }

                                          if (sel_emp_id) {

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
                                                                      mymodalss.style.display = "none";

                                                                      // FormDisplayDelete
                                                                      $('#FormDisplayUpdate').modal('hide');
                                                                      $("[data-dismiss=modal]").trigger({
                                                                             type: "click"
                                                                      });

                                                                      // reload the datatables
                                                                      datatable.ajax.reload(null, false);
                                                                      // reload the datatables

                                                                      modals.style.display = "block";
                                                                      document.getElementById("msg").innerHTML = response.messages;

                                                               } else {
                                                                      mymodalss.style.display = "none";
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

















































       function editdelMember(id = null) {
              if (id) {

                     // remove the error 
                     $(".form-group").removeClass('has-error').removeClass('has-success');
                     $(".text-danger").remove();
                     // empty the message div
                     $(".edit-messages").html("");

                     // remove the id
                     $("#member_id").remove();

                     // fetch the member data
                     $.ajax({
                            url: 'php_action/getSelectedEmployee.php<?php echo $getPackage; ?>',
                            type: 'post',
                            data: {
                                   member_id: id
                            },
                            dataType: 'json',
                            success: function(response) {

                                   $("#sel_id_berita").val(response.id_berita);

                                   // mmeber id 
                                   $(".FormDisplayDelete").append('<input type="hidden" name="member_id" id="member_id" value="' + response.id + '"/>');

                                   // here update the member data
                                   $("#updatedelMemberForm").unbind('submit').bind('submit', function() {
                                          // remove error messages
                                          $(".text-danger").remove();

                                          var form = $(this);

                                          // validation

                                          var sel_id_berita = $("#sel_id_berita").val();



                                          if (sel_id_berita == "") {
                                                 $("#sel_id_berita").closest('.form-group').addClass('has-error');
                                                 $("#sel_id_berita").after('<p class="text-danger">The Name field is required</p>');
                                          }





                                          if (sel_id_berita) {
                                                 $.ajax({
                                                        url: form.attr('action'),
                                                        type: form.attr('method'),
                                                        data: form.serialize(),
                                                        dataType: 'json',
                                                        success: function(response) {
                                                               if (response.code == 'success_message_delete') {


                                                                      $('#FormDisplayDelete').modal('hide');
                                                                      $("[data-dismiss=modal]").trigger({
                                                                             type: "click"
                                                                      });


                                                                      // reload the datatables
                                                                      datatable.ajax.reload(null, false);
                                                                      // reload the datatables
                                                                      mymodalss.style.display = "none";
                                                                      modals.style.display = "block";
                                                                      document.getElementById("msg").innerHTML = response.messages;


                                                               } else {
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
       }



































       function settlement(id = null) {
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
                            url: 'php_action/getSelectedEmployee.php<?php echo $getPackage; ?>',
                            type: 'post',
                            data: {
                                   member_id: id
                            },
                            dataType: 'json',


                            success: function(response) {

                                

                                   $("#settlement_emp_id").val(response.emp_id);
                                   $("#settlement_emp_no").val(response.emp_no);
                                   $("#settlement_join_date").val(response.start_date);
                                   $("#settlement_first_name").val(response.first_name);
                                   $("#settlement_middle_name").val(response.middle_name);
                                   $("#settlement_last_name").val(response.last_name);
                                   $("#settlement_place_ofbirth").val(response.r_birthplace);
                                   $("#settlement_birth_date").val(response.r_birthdate);
                                   $("#settlement_id_number").val(response.idnumber);
                                   $("#settlement_idfamily").val(response.familyidnumber);
                                   $("#settlement_gender").val(response.gender);
                                   $("#settlement_bloodtype").val(response.bloodtype);
                                   $("#settlement_religion").val(response.religion);
                                   $("#settlement_maritalstatus").val(response.maritalstatus);
                                   $("#settlement_nationality").val(response.nationality);
                                   $("#settlement_mobilephone").val(response.phone);
                                   $("#settlement_personalmail").val(response.email_personal);
                                   $("#settlement_officemail").val(response.email);
                                   $("#settlement_curcountry").val(response.cur_country_id);
                                   $("#settlement_curprovince").val(response.cur_state_id);
                                   $("#settlement_curcity").val(response.cur_city_id);
                                   $("#settlement_current_address").val(response.cur_address);
                                   $("#settlement_curdistrict").val(response.cur_district);
                                   $("#settlement_cursubdistrict").val(response.cur_subdistrict);
                                   $("#settlement_currt").val(response.cur_rt);
                                   $("#settlement_currw").val(response.cur_rw);
                                   $("#settlement_curpostalcode").val(response.cur_zipcode);

                                   $("#FamilyAddFormsMember").attr("onclick", "FamilyForm(`" + response.emp_id + "`)");

                                   $("#family_list").load("pages_relation/_pages_family.php<?php echo $getPackage; ?>rfid=" + response.emp_id,
                                          function(responseTxt, statusTxt, jqXHR) {
                                                 if (statusTxt == "success") {
                                                        $("#family_list").show();
                                                 }
                                                 if (statusTxt == "error") {
                                                        alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                                 }
                                          }
                                   );

                                   $("#form_attachment").load("pages_relation/_pages_attachment.php<?php echo $getPackage; ?>rfid=" + response.emp_no,
                                          function(responseTxt, statusTxt, jqXHR) {
                                                 if (statusTxt == "success") {
                                                        $("#form_attachment").show();
                                                 }
                                                 if (statusTxt == "error") {
                                                        alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                                 }
                                          }
                                   );






                                   // here update the member data
                                   $("#FormSettlement").unbind('submit').bind('submit', function() {
                                          // remove error messages
                                          $(".text-danger").remove();

                                          var form = $(this);

                                          var settlement_emp_id = $("#settlement_emp_id").val();
                                          var settlement_emp_no = $("#settlement_emp_no").val();
                                          var settlement_first_name = $("#settlement_first_name").val();
                                          var settlement_middle_name = $("#settlement_middle_name").val();
                                          var settlement_place_ofbirth = $("#settlement_place_ofbirth").val();

                                          var settlement_birth_date = $("#settlement_birth_date").val();
                                          var settlement_id_number = $("#settlement_id_number").val();
                                          var settlement_idfamily = $("#settlement_idfamily").val();
                                          var settlement_gender = $("#settlement_gender").val();
                                          var settlement_bloodtype = $("#settlement_bloodtype").val();
                                          var settlement_religion = $("#settlement_religion").val();
                                          var settlement_maritalstatus = $("#settlement_maritalstatus").val();
                                          var settlement_nationality = $("#settlement_nationality").val();
                                          var settlement_mobilephone = $("#settlement_mobilephone").val();
                                          var settlement_personalmail = $("#settlement_personalmail").val();
                                          var settlement_officemail = $("#settlement_officemail").val();

                                          var regex = /^[a-zA-Z]+$/;

                                          if (settlement_emp_id == "") {
                                                 modals.style.display = "block";
                                                 document.getElementById("msg").innerHTML = "Overtime code cannot empty";

                                          }

                                          if (settlement_emp_id) {

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

                                                                      // reload the datatables
                                                                      datatable.ajax.reload(null, false);
                                                                      // reload the datatables

                                                                      modals_href.style.display = "block";
                                                                      document.getElementById("msg_href").innerHTML = response.messages;

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

















       function FamilyForm(id = null) {

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
                            url: 'php_action/getSelectedEmployeeFamily.php<?php echo $getPackage; ?>',
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

                                                                      $("#family_list").load("pages_relation/_pages_family.php<?php echo $getPackage; ?>rfid=" + response.employee,
                                                                             function(responseTxt, statusTxt, jqXHR) {
                                                                                    if (statusTxt == "success") {
                                                                                           $("#family_list").show();
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






















       function FamilyDeleteForm(id = null) {
              if (id) {
                     $('#bottom_action').show();
                     $('#bottom_action1').hide();

                     // $('#FormDisplayDelete').modal('show');

                     // fetch the member data
                     $.ajax({
                            url: 'php_action/getSelectedEmployeeFamily.php<?php echo $getPackage; ?>',
                            type: 'post',
                            data: {
                                   member_id: id
                            },
                            dataType: 'json',

                            success: function(response) {
                                   // $("#settlement_emp_id").val(response.emp_id);
                                   $("#family_delete_empfamily_id").val(response.empfamily_id);
                                   $("#family_delete_emp_id").val(response.emp_id);

                                   // here update the member data
                                   $("#DeleteFormDisplay").unbind('submit').bind('submit', function() {
                                          // remove error messages
                                          $(".text-danger").remove();

                                          var form = $(this);

                                          var family_delete_empfamily_id = $("#family_delete_empfamily_id").val();
                                          var family_delete_emp_id = $("#family_delete_emp_id").val();

                                          var regex = /^[a-zA-Z]+$/;

                                          if (family_delete_empfamily_id == "") {
                                                 modals.style.display = "block";
                                                 document.getElementById("msg").innerHTML = "Family id code cannot empty";

                                          }

                                          if (family_delete_empfamily_id) {

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

                                                                      $("#family_list").load("pages_relation/_pages_family.php<?php echo $getPackage; ?>rfid=" + response.employee,
                                                                             function(responseTxt, statusTxt, jqXHR) {
                                                                                    if (statusTxt == "success") {
                                                                                           $("#family_list").show();
                                                                                    }
                                                                                    if (statusTxt == "error") {
                                                                                           alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                                                                    }
                                                                             }
                                                                      );

                                                                      $("#family_personal_list").load("pages_relation/_pages_family.php<?php echo $getPackage; ?>rfid=" + response.employee,
                                                                             function(responseTxt, statusTxt, jqXHR) {
                                                                                    if (statusTxt == "success") {
                                                                                           $("#family_personal_list").show();
                                                                                    }
                                                                                    if (statusTxt == "error") {
                                                                                           alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                                                                    }
                                                                             }
                                                                      );



                                                                      $('#bottom_action').hide();
                                                                      $('#bottom_action1').show();

                                                                      modals.style.display = "block";
                                                                      document.getElementById("msg").innerHTML = response.messages;

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

































       function ListRequest(id = null) {

              if (id) {
                     $('#bottom_action').show();
                     $('#bottom_action1').hide();
                     // fetch the member data
                     $.ajax({
                            url: 'php_action/getSelectedRequestList.php<?php echo $getPackage; ?>',
                            type: 'post',
                            data: {
                                   member_id: id
                            },
                            dataType: 'json',

                            success: function(response) {
                                   // $("#settlement_emp_id").val(response.emp_id);
                                   $("#listofrequest").load("pages_relation/_pages_request.php<?php echo $getPackage; ?>rfid=" + response.emp_id,
                                          function(responseTxt, statusTxt, jqXHR) {
                                                 if (statusTxt == "success") {
                                                        $("#listofrequest").show();
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
       }


























       function ApprovalSubmission(id = null) {
              mymodalss.style.display = "block";

              if (id) {
                     $.ajax({
                            url: 'php_action/getSelectedRequest.php<?php echo $getPackage; ?>',
                            type: 'post',
                            data: {
                                   member_id: id
                            },
                            dataType: 'json',
                            success: function(response) {

                                   mymodalss.style.display = "none";

                                   document.getElementById("sel_identity_request_no").innerHTML = response.request_no;
                                   document.getElementById("sel_identity_requester").innerHTML = response.Full_Name + " (" + response.emp_no + ") ";

                                   $("#cancellation_id").attr("data-id", response.request_no);


                                   $("#box_approval_request_detail").load("pages_relation/_pages_approval.php<?php echo $getPackage; ?>rfid=" + response.request_no,
                                          function(responseTxt, statusTxt, jqXHR) {
                                                 if (statusTxt == "success") {
                                                        $("#box_approval_request_detail").show();
                                                 }
                                                 if (statusTxt == "error") {
                                                        alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                                 }
                                          }
                                   );


                                   $.ajax({
                                          url: 'php_action/getRequestStatus.php<?php echo $getPackage; ?>',
                                          type: 'post',
                                          data: {
                                                 request_no: response.request_no
                                          },
                                          dataType: 'json',
                                          success: function(response) {

                                                 mymodalss.style.display = "none";


                                                 if (response.status_request == 1) {
                                                        $("#modalcancelcondition_0").hide();
                                                        $("#modalcancelcondition_1").hide();
                                                        $("#modalcancelcondition_2").show();
                                                 } else {
                                                        $("#modalcancelcondition_0").hide();
                                                        $("#modalcancelcondition_1").show();
                                                        $("#modalcancelcondition_2").hide();
                                                 }
                                          }
                                   }); // /ajax

                                   // mmeber id 
                                   $(".FormDisplayLeaveApproval").append('<input type="hidden" name="member_id" id="member_id" value="' + response.id + '"/>');

                                   // here update the member data
                                   $("#updatedelMemberForm").unbind('submit').bind('submit', function() {

                                          // remove error messages
                                          $(".text-danger").remove();

                                          var form = $(this);

                                          // validation
                                          var sel_approval_request_no = $("#sel_approval_request_no").val();
                                          var sel_emp_no_approver = $("#sel_emp_no_approver").val();

                                          if (sel_approval_request_no == "") {
                                                 modals.style.display = "block";
                                                 document.getElementById("msg").innerHTML = "There is some error";
                                          } else if (sel_emp_no_approver == "") {
                                                 modals.style.display = "block";
                                                 document.getElementById("msg").innerHTML = "There is some error";
                                          } else {
                                                 $('#submit_approval_spvdown').hide();
                                                 $('#submit_approval_spvdown2').show();
                                                 mymodalss.style.display = "block";
                                          }

                                          if (sel_approval_request_no && sel_emp_no_approver) {


                                                 $.ajax({
                                                        url: form.attr('action'),
                                                        type: form.attr('method'),
                                                        data: form.serialize(),
                                                        dataType: 'json',
                                                        success: function(response) {
                                                               if (response.code == 'success_message_approved') {



                                                                      $('#submit_approval_spvdown').show();
                                                                      $('#submit_approval_spvdown2').hide();

                                                                      mymodalss.style.display = "none";

                                                                      // reload the datatables
                                                                      datatable.ajax.reload(null, false);
                                                                      // reload the datatables

                                                                      $('#FormDisplayLeaveApproval').modal('hide');

                                                                      $("[data-dismiss=modal]").trigger({
                                                                             type: "click"
                                                                      });

                                                                      modals.style.display = "block";
                                                                      document.getElementById("msg").innerHTML = response.messages;



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

                     // Delete 
                     $('.delete').click(function() {
                            var el = this;

                            // Delete id
                            var deleteid = $(this).data('id');

                            var confirmalert = confirm("Are you sure to cancel request?");
                            if (confirmalert == true) {
                                   // AJAX Request
                                   $.ajax({
                                          url: 'php_action/FuncDataDelete.php<?php echo $getPackage; ?>id=' + deleteid,
                                          type: 'GET',
                                          processData: false,
                                          contentType: false,
                                          dataType: 'json',
                                          success: function(response) {
                                                 if (response.code == 'success_message') {
                                                        mymodals_withhref.style.display = "block";
                                                        document.getElementById("msg_href").innerHTML = response.messages;
                                                 } else {
                                                        mymodals_withhref.style.display = "block";
                                                        document.getElementById("msg_href").innerHTML = response.messages;
                                                        return false;
                                                 }
                                          }

                                   });
                            }

                     });


              } else {
                     alert("Error : Refresh the page again");
              }
       }
























































       function PreviewChanges(id = null) {
              mymodalss.style.display = "block";

              if (id) {
                     $.ajax({
                            url: 'php_action/getSelectedRequest.php<?php echo $getPackage; ?>',
                            type: 'post',
                            data: {
                                   member_id: id
                            },
                            dataType: 'json',
                            success: function(response) {

                                   mymodalss.style.display = "none";

                                   $("#box_preview_request_detail").load("pages_relation/_pages_preview.php<?php echo $getPackage; ?>rfid=" + response.request_no,
                                          function(responseTxt, statusTxt, jqXHR) {
                                                 if (statusTxt == "success") {
                                                        $("#box_preview_request_detail").show();
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
       }


























       // global the manage memeber table
       $(document).ready(function() {
              $("#FamilyAddFormsMember").on('click', function() {

                     // reset the form
                     $("#FormFamily")[0].reset();
                     // empty the message div

                     $(".messages_create").html("");

                     // submit form
                     $("#FormFamily").unbind('submit').bind('submit', function() {

                            $(".text-danger").remove();

                            var form = $(this);

                            var family_name = $("#family_name").val();
                            var family_relationship = $("#family_relationship").val();
                            var family_birth_date = $("#family_birth_date").val();
                            var family_gender = $("#family_gender").val();
                            var family_alivestatus = $("#family_alivestatus").val();


                            var regex = /^[a-zA-Z]+$/;

                            if (family_relationship == "") {
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Reationship cannot empty";

                            } else if (family_name == "") {
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Name cannot empty";

                            } else if (family_birth_date == "") {
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Birth date cannot empty";

                            } else if (family_gender == "") {
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Gener cannot empty";

                            } else if (family_alivestatus == "") {
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Alive status cannot empty";


                            } else {
                                   $('#submit_add').hide();
                                   $('#submit_add2').show();
                                   mymodalss.style.display = "block";
                            }

                            if (family_name && family_relationship && family_birth_date && family_gender && family_alivestatus) {
                                   //submi the form to server
                                   $.ajax({
                                          url: 'php_action/FuncDataCreateFamily.php<?php echo $getPackage; ?>',
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

                                                        modals.style.display = "block";
                                                        document.getElementById("msg").innerHTML = response.messages;

                                                        mymodalss.style.display = "none";

                                                        $("#family_list").load("pages_relation/_pages_family.php<?php echo $getPackage; ?>rfid=" + response.employee,
                                                               function(responseTxt, statusTxt, jqXHR) {
                                                                      if (statusTxt == "success") {
                                                                             $("#family_list").show();
                                                                      }
                                                                      if (statusTxt == "error") {
                                                                             alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                                                      }
                                                               }
                                                        );

                                                        $("#family_personal_list").load("pages_relation/_pages_family.php<?php echo $getPackage; ?>rfid=" + response.employee,
                                                               function(responseTxt, statusTxt, jqXHR) {
                                                                      if (statusTxt == "success") {
                                                                             $("#family_personal_list").show();
                                                                      }
                                                                      if (statusTxt == "error") {
                                                                             alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                                                      }
                                                               }
                                                        );

                                                        $("#FormFamily")[0].reset();

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
</script>
<!-- isi JSONs -->
</body>

</html>

<link rel="stylesheet" href="asset/w3schools28.css">
<link rel="stylesheet" href="asset/style_photo.css">





<!-- Jquery JS -->
<script src="asset/jquery-1.js"></script>
<!-- bootStrap JS -->
<script src="asset/bootstrap.js"></script>
<!-- Plugin Custom JS -->
<script src="asset/form-wizard.js"></script>
<!-- Plugin Custom JS -->

<script type="text/javascript">
       $('#classic').click(function() {
              $('.form-wizard').addClass("form-header-classic").removeClass(
                     "form-header-stylist form-header-modarn");
       });

       $('#modarn').click(function() {
              $('.form-wizard').addClass("form-header-modarn").removeClass(
                     "form-header-classic form-header-stylist");
       });

       $('#stylist').click(function() {
              $('.form-wizard').addClass("form-header-stylist").removeClass(
                     "form-header-classic form-header-modarn");
       });
</script>

<script type="text/javascript">
       $('#classic-body').click(function() {
              $('.form-wizard').addClass("form-body-classic").removeClass(
                     "form-body-stylist form-body-material");
       });

       $('#material-body').click(function() {
              $('.form-wizard').addClass("form-body-material").removeClass(
                     "form-body-classic form-body-stylist");
       });

       $('#stylist-body').click(function() {
              $('.form-wizard').addClass("form-body-stylist").removeClass(
                     "form-body-classic form-body-material");
       });
</script>

<script>
       document.querySelector("html").classList.add('js');

       var fileInput = document.querySelector(".input-file"),
              button = document.querySelector(".input-file-trigger"),
              the_return = document.querySelector(".file-return");

       button.addEventListener("keydown", function(event) {
              if (event.keyCode == 13 || event.keyCode == 32) {
                     fileInput.focus();
              }
       });
       button.addEventListener("click", function(event) {
              fileInput.focus();
              return false;
       });
       fileInput.addEventListener("change", function(event) {
              the_return.innerHTML = this.value;
       });
</script>



<script>
       $(document).ready(function() {
              $(document).on('change', '#file', function() {
                     var name = document.getElementById("file").files[0].name;
                     var uploadField1 = document.getElementById("file");

                     var form_data = new FormData();
                     var ext = name.split('.').pop().toLowerCase();

                     var allowedFiles = [".doc", ".jpg", ".jpeg", ".ods", ".png", ".txt", ".doc", ".pdf"]
                     var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");

                     var oFReader = new FileReader();
                     oFReader.readAsDataURL(document.getElementById("file").files[0]);
                     var f = document.getElementById("file").files[0];
                     var fsize = f.size || f.fileSize;
                     if (!regex.test(uploadField1.value.toLowerCase())) {
                            modals.style.display = "block";
                            document.getElementById("msg").innerHTML = "File Tidak Diijinkan";
                     } else if (fsize > 3145728) {
                            modals.style.display = "block";
                            document.getElementById("msg").innerHTML = "Dokumen terlalu besar maksimum besar file 3MB";
                            return false;
                     } else {
                            form_data.append("file", document.getElementById('file').files[0]);
                            $.ajax({
                                   url: "uploader_dokumen.php<?php echo $getPackage; ?>code=1&token=<?php echo $username; ?>",
                                   method: "POST",
                                   data: form_data,
                                   contentType: false,
                                   cache: false,
                                   processData: false,
                                   beforeSend: function() {
                                          $('#uploaded_image').html("<img src='../../asset/dist/img/loading.gif' style='max-width: 10%;margin-top: 20px;'>");
                                   },
                                   success: function(data) {
                                          $('#uploaded_image').html(data);
                                   }
                            });
                     }
              });
       });
</script>


<script>
       $(document).ready(function() {
              $(document).on('change', '#file2', function() {
                     var name = document.getElementById("file2").files[0].name;
                     var uploadField2 = document.getElementById("file2");

                     var form_data = new FormData();
                     var ext = name.split('.').pop().toLowerCase();

                     var allowedFiles = [".doc", ".jpg", ".jpeg", ".ods", ".png", ".txt", ".doc", ".pdf"]
                     var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");

                     //   if(!regex.test(uploadField2.value.toLowerCase())) 
                     //   {
                     //    alert("Invalid Image File");
                     //   }
                     var oFReader = new FileReader();
                     oFReader.readAsDataURL(document.getElementById("file2").files[0]);
                     var f = document.getElementById("file2").files[0];
                     var fsize = f.size || f.fileSize;
                     if (!regex.test(uploadField2.value.toLowerCase())) {
                            modals.style.display = "block";
                            document.getElementById("msg").innerHTML = "File Tidak Diijinkan";
                     } else if (fsize > 3145728) {
                            modals.style.display = "block";
                            document.getElementById("msg").innerHTML = "Dokumen terlalu besar maksimum besar file 3MB";
                            return false;
                     } else {
                            form_data.append("file2", document.getElementById('file2').files[0]);
                            $.ajax({
                                   url: "uploader_dokumen.php<?php echo $getPackage; ?>code=2&token=<?php echo $username; ?>",
                                   method: "POST",
                                   data: form_data,
                                   contentType: false,
                                   cache: false,
                                   processData: false,
                                   beforeSend: function() {
                                          $('#uploaded_image2').html("<img src='../../asset/dist/img/loading.gif' style='max-width: 10%;margin-top: 20px;'>");
                                   },
                                   success: function(data) {
                                          $('#uploaded_image2').html(data);
                                   }
                            });
                     }
              });
       });
</script>


<script>
       $(document).ready(function() {
              $(document).on('change', '#file3', function() {
                     var name = document.getElementById("file3").files[0].name;
                     var uploadField3 = document.getElementById("file3");

                     var form_data = new FormData();
                     var ext = name.split('.').pop().toLowerCase();

                     var allowedFiles = [".doc", ".jpg", ".jpeg", ".ods", ".png", ".txt", ".doc", ".pdf"]
                     var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");

                     //   if(!regex.test(uploadField3.value.toLowerCase())) 
                     //   {
                     //    alert("Invalid Image File");
                     //   }
                     var oFReader = new FileReader();
                     oFReader.readAsDataURL(document.getElementById("file3").files[0]);
                     var f = document.getElementById("file3").files[0];
                     var fsize = f.size || f.fileSize;
                     if (!regex.test(uploadField3.value.toLowerCase())) {
                            modals.style.display = "block";
                            document.getElementById("msg").innerHTML = "File Tidak Diijinkan";
                     } else if (fsize > 3145728) {
                            modals.style.display = "block";
                            document.getElementById("msg").innerHTML = "Dokumen terlalu besar maksimum besar file 3MB";
                            return false;
                     } else {
                            form_data.append("file3", document.getElementById('file3').files[0]);
                            $.ajax({
                                   url: "uploader_dokumen.php<?php echo $getPackage; ?>code=3&token=<?php echo $username; ?>",
                                   method: "POST",
                                   data: form_data,
                                   contentType: false,
                                   cache: false,
                                   processData: false,
                                   beforeSend: function() {
                                          $('#uploaded_image3').html("<img src='../../asset/dist/img/loading.gif' style='max-width: 10%;margin-top: 20px;'>");
                                   },
                                   success: function(data) {
                                          $('#uploaded_image3').html(data);
                                   }
                            });
                     }
              });
       });
</script>





<script>
       $(document).ready(function() {
              $(document).on('change', '#file4', function() {
                     var name = document.getElementById("file4").files[0].name;
                     var uploadField4 = document.getElementById("file4");

                     var form_data = new FormData();
                     var ext = name.split('.').pop().toLowerCase();

                     var allowedFiles = [".doc", ".jpg", ".jpeg", ".ods", ".png", ".txt", ".doc", ".pdf"]
                     var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");

                     //   if(!regex.test(uploadField4.value.toLowerCase())) 
                     //   {
                     //    alert("Invalid Image File");
                     //   }
                     var oFReader = new FileReader();
                     oFReader.readAsDataURL(document.getElementById("file4").files[0]);
                     var f = document.getElementById("file4").files[0];
                     var fsize = f.size || f.fileSize;
                     if (!regex.test(uploadField4.value.toLowerCase())) {
                            modals.style.display = "block";
                            document.getElementById("msg").innerHTML = "File Tidak Diijinkan";
                     } else if (fsize > 4145728) {
                            modals.style.display = "block";
                            document.getElementById("msg").innerHTML = "Dokumen terlalu besar maksimum besar file 3MB";
                            return false;
                     } else {
                            form_data.append("file4", document.getElementById('file4').files[0]);
                            $.ajax({
                                   url: "uploader_dokumen.php<?php echo $getPackage; ?>code=4&token=<?php echo $username; ?>",
                                   method: "POST",
                                   data: form_data,
                                   contentType: false,
                                   cache: false,
                                   processData: false,
                                   beforeSend: function() {
                                          $('#uploaded_image4').html("<img src='../../asset/dist/img/loading.gif' style='max-width: 10%;margin-top: 20px;'>");
                                   },
                                   success: function(data) {
                                          $('#uploaded_image4').html(data);
                                   }
                            });
                     }
              });
       });
</script>





<script>
       $(document).ready(function() {
              $(document).on('change', '#file5', function() {
                     var name = document.getElementById("file5").files[0].name;
                     var uploadField4 = document.getElementById("file5");

                     var form_data = new FormData();
                     var ext = name.split('.').pop().toLowerCase();

                     var allowedFiles = [".doc", ".jpg", ".jpeg", ".ods", ".png", ".txt", ".doc", ".pdf"]
                     var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");

                     //   if(!regex.test(uploadField4.value.toLowerCase())) 
                     //   {
                     //    alert("Invalid Image File");
                     //   }
                     var oFReader = new FileReader();
                     oFReader.readAsDataURL(document.getElementById("file5").files[0]);
                     var f = document.getElementById("file5").files[0];
                     var fsize = f.size || f.fileSize;
                     if (!regex.test(uploadField4.value.toLowerCase())) {
                            modals.style.display = "block";
                            document.getElementById("msg").innerHTML = "File Tidak Diijinkan";
                     } else if (fsize > 4145728) {
                            modals.style.display = "block";
                            document.getElementById("msg").innerHTML = "Dokumen terlalu besar maksimum besar file 3MB";
                            return false;
                     } else {
                            form_data.append("file5", document.getElementById('file5').files[0]);
                            $.ajax({
                                   url: "uploader_dokumen.php<?php echo $getPackage; ?>code=5&token=<?php echo $username; ?>",
                                   method: "POST",
                                   data: form_data,
                                   contentType: false,
                                   cache: false,
                                   processData: false,
                                   beforeSend: function() {
                                          $('#uploaded_image5').html("<img src='../../asset/dist/img/loading.gif' style='max-width: 10%;margin-top: 20px;'>");
                                   },
                                   success: function(data) {
                                          $('#uploaded_image5').html(data);
                                   }
                            });
                     }
              });
       });
</script>





<script>
       function removeElement() {
              document.getElementById("imgbox1").style.display = "none";
              document.getElementById("file").value = "";
              document.getElementById("any_file").value = "";
       }

       function removeElement1() {
              document.getElementById("imgbox1a").style.display = "none";
              document.getElementById("file").value = "";
              document.getElementById("any_file").value = "";
       }

       function removeElement2() {
              document.getElementById("imgbox2").style.display = "none";
              document.getElementById("file2").value = "";
              document.getElementById("any_file2").value = "";
       }

       function removeElement2a() {
              document.getElementById("imgbox2a").style.display = "none";
              document.getElementById("file2").value = "";
              document.getElementById("any_file2").value = "";
       }

       function removeElement3() {
              document.getElementById("imgbox3").style.display = "none";
              document.getElementById("file2").value = "";
              document.getElementById("any_file2").value = "";
       }

       function removeElement3a() {
              document.getElementById("imgbox3a").style.display = "none";
              document.getElementById("file3").value = "";
              document.getElementById("any_file3").value = "";
       }

       function removeElement4() {
              document.getElementById("imgbox4").style.display = "none";
              document.getElementById("file4").value = "";
              document.getElementById("any_file4").value = "";
       }

       function removeElement4a() {
              document.getElementById("imgbox4a").style.display = "none";
              document.getElementById("file4").value = "";
              document.getElementById("any_file4").value = "";
       }

       function removeElement5() {
              document.getElementById("imgbox5").style.display = "none";
              document.getElementById("file5").value = "";
              document.getElementById("any_file5").value = "";
       }

       function removeElement5a() {
              document.getElementById("imgbox5a").style.display = "none";
              document.getElementById("file5").value = "";
              document.getElementById("any_file5").value = "";
       }
</script>



<script>
       $(document).ready(function() {
              $('.action_domisili').change(function() {
                     if ($(this).val() != '') {
                            var action_domisili = $(this).attr("id");
                            var query = $(this).val();
                            var result = '';
                            if (action_domisili == "settlement_curcountry") {
                                   result = 'settlement_curprovince';
                                   $('#settlement_curcity').html('<option value="">Select City</option>');
                                   $('#settlement_curdistrict').html('<option value="">Select District</option>');
                                   $('#settlement_cursubdistrict').html('<option value="">Select SubDistrict</option>');
                            } else if (action_domisili == "settlement_curprovince") {
                                   result = 'settlement_curcity';
                                   $('#settlement_curdistrict').html('<option value="">Select District</option>');
                                   $('#settlement_cursubdistrict').html('<option value="">Select SubDistrict</option>');
                            } else if (action_domisili == "settlement_curcity") {
                                   result = 'settlement_curdistrict';
                                   $('#settlement_cursubdistrict').html('<option value="">Select SubDistrict</option>');
                            } else {
                                   result = 'settlement_cursubdistrict';
                            }
                            $.ajax({
                                   url: "fetching/fetch_dynamic_country_city_state_2.php",
                                   method: "POST",
                                   data: {
                                          action_domisili: action_domisili,
                                          query: query
                                   },
                                   success: function(data) {
                                          $('#' + result).html(data);
                                          $('#' + result2).html(data);
                                   }
                            })
                     }
              });
       });
</script>
<!-- SECTION ALAMAT SESUAI DOMISILI -->
<!-- SECTION ALAMAT SESUAI DOMISILI -->


<script src="asset/ckeditor.js"></script>
<script src="asset/js/sample.js"></script>
<script src="asset/js/sampleupdate.js"></script>

<script>
       initSample();
       initSampleUpdate();
</script>


<script>
       function openCity(evt, cityName) {
              var i, tabcontent, tablinks;
              tabcontent = document.getElementsByClassName("tabcontent");
              for (i = 0; i < tabcontent.length; i++) {
                     tabcontent[i].style.display = "none";
              }
              tablinks = document.getElementsByClassName("tablinks");
              for (i = 0; i < tablinks.length; i++) {
                     tablinks[i].className = tablinks[i].className.replace(" active", "");
              }
              document.getElementById(cityName).style.display = "block";
              evt.currentTarget.className += " active";
       }

       // Get the element with id="defaultOpen" and click on it
       document.getElementById("defaultOpen").click();
</script>


<script>
// Get the button
let mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>