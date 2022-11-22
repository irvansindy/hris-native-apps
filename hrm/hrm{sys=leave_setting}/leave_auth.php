<?php include "../../application/session/session.php"; ?>

<?php include "../template/sys.header.php"; ?>

<!-- <script src="../../asset/gt_developer/jquery.min.js"></script> -->
<?php
$page   = '13'; //menu id SELECT * FROM hrmmenu WHERE menu_id = '21'
$footer = 'no'; //set as `yes` if you want to use default footer & set as `no` if you want to use custom footer
?>

<?php include "../template/sys.sidebar.php"; ?>

<?php include "../../model/eo/GMEmployeeSearchGen.php"; ?>
<?php include "../../model/eo/GMEmployeeList.php"; ?>

<!-- LOADER -->
<div onclick='return stopload()' id="divBlockSpace" class="divBlockSpace"></div>
<div onclick='return stopload()' id="loading-circle"></div>
<div id="contents"></div>
<!-- LOADER -->

<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div style="width: 100vw;height: 100vh;overflow-x: hidden;">
<div class="page-wrapper" style="display: block;">
       <div class="row page-titles">
              <div class="col-md-5 col-12 align-self-center">
                     <h3 class="text-themecolor mb-0">Leave Setting</h3>
                     <ol class="breadcrumb mb-0 p-0 bg-transparent">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home&nbsp;&nbsp;</a></li>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i>&nbsp;Leave Setting</li>
                     </ol>
              </div>
              <div class="col-md-7 col-12 align-self-center d-none d-md-block">
                     <div class="d-flex mt-2 justify-content-end">
                     </div>
              </div>
       </div>


       <!-- ============================================================== -->
       <!-- Container fluid  -->
       <!-- ============================================================== -->
       <div class="container-fluid">
              <!-- Row -->
              <div class="row">
                     <div class="col-lg-12 col-md-12">

                            <div class="row">

                                   <?php

                                   if ($get_auth['access'] > 0) {
                                   ?>

                                          <div class="col-md-12">
                                                 <div class="card">
                                                        <div class="card-header d-flex align-items-center">
                                                               <td><a href='../hrm{sys=leave_setting}/' onclick='return startload()' class='open_modal_add'>
                                                                             <div class="toolbar sprite-toolbar-back" id="add" title="Add"></div>
                                                                      </a></td>
                                                               <td>

                                                                      <h4 class="card-title mb-0">Leave Setting
                                                                      </h4>



                                                        </div>

                                                        <div class="card-body table-responsive p-0" style="width: 100vw;height: 78vh; width: 98.8%; margin: 5px;overflow: scroll;">
                                                               <!DOCTYPE html5>
                                                               <html>

                                                               <head>
                                                                      <link rel="stylesheet" href="../../asset/gt_developer/asset_use/jquery.tree-multiselect.min.css">
                                                                      <script src="../../asset/gt_developer/asset_use/jquery-1.11.3.min.js">
                                                                      </script>
                                                                      <script src="../../asset/gt_developer/asset_use/jquery-ui.min.js">
                                                                      </script>
                                                                      <script src="../../asset/gt_developer/asset_use/jquery.tree-multiselect.js">
                                                                      </script>
                                                               </head>

                                                               <body>


                                                                      <form action="" method="post">
                                                                             <tr>
                                                                                    <td colspan="3" align="right" width="100%">
                                                                                           <select class="input--style-6 modal_leave_revised" name="modal_leave_revised" style="width: 50%;height: 30px;margin-bottom: 10px;width: 9%;" id="modal_leave_revised" onchange="isi_otomatis_leave_revised()">
                                                                                          
                                                                                           <?php
                                                                                           $rfid = $_GET['rfid'];
                                                                                           $sql1 = mysqli_fetch_array(mysqli_query($connect, "SELECT 
                                                                                                                                     ttamleavetype.`is_active`,
                                                                                                                                     db_config_str.var1
                                                                                                                              FROM 
                                                                                                                              ttamleavetype
                                                                                                                              LEFT JOIN db_config_str ON ttamleavetype.is_active = db_config_str.id
                                                                                                                              WHERE ttamleavetype.leave_code = '$rfid'"));
                                                                                       
                                                                                                  echo '<option value="' . $sql1['is_active'] . '">' . $sql1['var1'] . '</option>';
                                                                                           
                                                                                           $sql = mysqli_query($connect, "SELECT 
                                                                                                                                     db_config_str.id
                                                                                                                                     db_config_str.var1
                                                                                                                              FROM 
                                                                                                                              db_config_str ON ttamleavetype.is_active = db_config_str.id
                                                                                                                              WHERE ttamleavetype.leave_code = '$rfid' and db_config_str.id IN ('17','18') and db_config_str.id <> '$sql[is_active]' ");


                                                                                           while ($row = mysqli_fetch_array($sql)) {
                                                                                                  echo '<option value="' . $row['is_active'] . '">' . $row['var1'] . '</option>';
                                                                                           }
                                                                                           ?>
                                                                                    </select>
                                                                                    </td>
                                                                             </tr>

                                                                             <tr>
                                                                                    <td>
                                                                                           <?php
                                                                                           $emp_no = $_GET['rfid'];
                                                                                           $req_app                      = mysqli_fetch_array(mysqli_query($connect, "SELECT emp_no, 
                                                                                                                                            REPLACE(GROUP_CONCAT(formula ORDER BY formula ASC SEPARATOR ','),',','`,`') AS formula 
                                                                                                                                                          FROM users_menu_access
                                                                                                                                                          WHERE 
                                                                                                                                                          emp_no = '$emp_no'
                                                                                                                                                          GROUP BY emp_no"));
                                                                                           $var1 = array("`");
                                                                                           $var2 = array("'");
                                                                                           if ($req_app) {
                                                                                                  $conversion_formula = str_replace($var1, $var2, $req_app['formula']);
                                                                                           } else {
                                                                                                  $conversion_formula = "";
                                                                                           }

                                                                                           $forumla_used = "'" . $conversion_formula . "'";
                                                                                           ?>
                                                                                           <?php
                                                                                           $modal = mysqli_query($connect, "$qListRender_second");
                                                                                           ?>

                                                                                           <input type="hidden" name="emp_no" value="<?php echo $emp_no; ?>">
                                                                                           <select id="test-select-4" multiple="multiple" class="framework" id="framework" name="framework[]">
                                                                                                  <?php if (mysqli_num_rows($modal) > 0) { ?>
                                                                                                         <?php while ($row = mysqli_fetch_array($modal)) { ?>
                                                                                                                <option value="<?php echo $row['emp_no'] ?>" data-section="<?php echo $row['worklocation_code'] ?>" data-index="1" <?php echo $row['selected'] ?>>
                                                                                                                       <?php echo $row['emp_no'] ?>
                                                                                                                       <?php echo $row['full_name'] ?>
                                                                                                                </option>
                                                                                                         <?php } ?>
                                                                                                  <?php } ?>
                                                                                           </select>
                                                                                           </td>
                                                                             </tr>
                                                                             

                                                                             
                                                                             


                                                                             <tr>
                                                                                    <td colspan="3" align="right" width="100%">
                                                                                           <div class="modal-footer">
                                                                                                  <div class="mb-3 col-md-12">


                                                                                                         <button class="btn rounded-pill px-4 btn-light-success text-success font-weight-medium waves-effect waves-light" type="submit" name="submit_update_leave" id="submit_update_leave" class="btn btn-info" value="Save" name="submit_create_hrm{sys=user_management}">
                                                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send feather-sm ms-2 fill-white">
                                                                                                                       <line x1="22" y1="2" x2="11" y2="13">
                                                                                                                       </line>
                                                                                                                       <polygon points="22 2 15 22 11 13 2 9 22 2">
                                                                                                                       </polygon>
                                                                                                                </svg>
                                                                                                                Submit
                                                                                                         </button>
                                                                                                  </div>
                                                                                           </div>
                                                                                    </td>
                                                                             </tr>
                                                               </body>

                                                               </html>




                                                        </div>

                                                        <div class='card-footer' style='background-color: #eee;height: 37px;padding-top: 5px;'>

                                                               <div class='row mb-2'>
                                                                      <div class='col-sm-10'>

                                                                      </div>
                                                                      <div class='col-sm-2'>

                                                                             <div id="toolbarlist">

                                                                             </div>


                                                                      </div>
                                                               </div>

                                                        </div>

                                                 </div>
                                          </div>
                                          <!-- Column -->
                            </div>
                     <?php
                                   } else {
                                          include "../saas.error/index.php";
                                   }
                     ?>
                     </div>


              </div>
              <!-- Row -->
       </div>
       </div>
       <!-- ============================================================== -->
       <!-- End Container fluid  -->
       <!-- ============================================================== -->
       <!-- ============================================================== -->
       <script type="text/javascript">
              var tree4 = $("#test-select-4").treeMultiselect({
                     allowBatchSelection: true,
                     enableSelectAll: true,
                     searchable: true,
                     sortable: true,
                     startCollapsed: false,
              });
       </script>

       <?php include "process.php"; ?>

       <?php include "../template/sys.footer.php"; ?>