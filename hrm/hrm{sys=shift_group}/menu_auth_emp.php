<?php include "../../application/session/session.php";?>
<?php include "../template/sys.header.php";?>
<?php include "../template/sys.sidebar.php";?>



<!-- LOADER -->
<div onclick='return stopload()' id="divBlockSpace" class="divBlockSpace"></div>
<div onclick='return stopload()' id="loading-circle"></div>
<div id="contents"></div>
<!-- LOADER -->

<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper" style="display: block;">
       <div class="row page-titles">
              <div class="col-md-5 col-12 align-self-center">
                     <h3 class="text-themecolor mb-0">Employee Group Data</h3>
                     <ol class="breadcrumb mb-0 p-0 bg-transparent">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home&nbsp;&nbsp;</a></li>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i>&nbsp;Employee Group Data
                                   Information</li>
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
                                   <div class="col-md-12">
                                          <div class="card">
                                                 <div class="card-header d-flex align-items-center">
                                                 <td><a href='../hrm{sys=shift_group}/' onclick='return startload()' class='open_modal_add'>
                                                               <div class="toolbar sprite-toolbar-back" id="add"
                                                                      title="Add"></div>
                                                        </a></td>
                                                 <td>

                                                        <h4 class="card-title mb-0">Employee Group Data Information
                                                        </h4>


                                                        <div class="card-actions ml-auto">
                                                               <table>
                                                                      <td>
                                                                             <form action="../rfid=repository/cli_Template_Download/eo/DownloadGTTGREmployeeExport.php"
                                                                                    method="POST">

                                                                                    <input type="hidden" name="inp_emp"
                                                                                           value="<?php echo $mynip; ?>">
                                                                                    <input type="hidden" name="inp_name"
                                                                                           value="<?php echo $myname; ?>">


                                                                                    <button type="submit"
                                                                                           class="toolbar sprite-toolbar-excel"
                                                                                           id="EXCEL"
                                                                                           style="border: 0;background-color: white;"
                                                                                           name="submit_approve"
                                                                                           value="submit">
                                                                                    </button>



                                                                             </form>
                                                                      </td>
                                                                      <td>

                                                                             <a href='#' class='open_modal_search'>
                                                                                    <div class="toolbar sprite-toolbar-search"
                                                                                           id="SEARCH" title="Search">
                                                                                    </div>
                                                                             </a>

                                                                      </td>


                                                               </table>


                                                        </div>
                                                 </div>

                                                 <div class="card-body table-responsive p-0"
                                                        style="width: 100vw;height: 78vh; width: 98.8%; margin: 5px;overflow: scroll;">




                                                        


                                                        <!DOCTYPE html5>
                                                        <html>

                                                        <head>


                                                               <meta charset="UTF-8">
                                                               <link rel="stylesheet" href="../../asset/gt_developer/asset_use/jquery.tree-multiselect.min.css">
                                                               <script src="../../asset/gt_developer/asset_use/jquery-1.11.3.min.js"></script>
                                                               <script src="../../asset/gt_developer/asset_use/jquery-ui.min.js"></script>
                                                               <script src="../../asset/gt_developer/asset_use/jquery.tree-multiselect.js">
                                                               </script>
                                                        </head>

                                                        <body>
                                                               

                                                               <form action="process" method="post" target="popupwindow"
                                                                      onsubmit="window.open('process', 'popupwindow', 'location=no, directories=no, status=no, menubar=yes, scrollbars=yes, resizable=no, copyhistory=no, width=800,height=800'); return true">

                                                                      <?php
                                                                      $emp_no = $_GET['rfid'];
                                                                      $modal=mysqli_query($connect, "SELECT *,
                                                                      CASE 
                                                                             WHEN status_use = '1' THEN 'selected'
                                                                             WHEN status_use = '' THEN ''
                                                                      END AS selected

                                                                      FROM hrmgroupdata where emp_no = '$emp_no'");
                                                                      ?>
                                                                      
                                                                      <input type="hidden" name="emp_no" value="<?php echo $emp_no; ?>">
                                                                      <select id="test-select-4" multiple="multiple" class="framework" id="framework" name="framework[]" >
                                                                             <?php if (mysqli_num_rows($modal) > 0) { ?>
                                                                                    <?php while ($row = mysqli_fetch_array($modal)) { ?>
                                                                                           <option value="<?php echo $row['Authorized_User'] ?>"
                                                                                           data-section="<?php echo $row['Authorized_User'] ?>"
                                                                                           title="<?php echo $row['Authorized_formula'] ?>"
                                                                                           data-index="1" <?php echo $row['selected'] ?>><?php echo $row['Authorized_User'] ?></option>
                                                                                    <?php } ?>
                                                                             <?php } ?>
                                                                      </select>


                                                                      <tr>
                                                                             <td colspan="3" align="right" width="100%">
                                                                                    <div class="modal-footer">
                                                                                           <div class="mb-3 col-md-12">

                                                                                                  <button data-repeater-delete=""
                                                                                                         class="btn rounded-pill px-4 btn-light-danger text-danger font-weight-medium waves-effect waves-light m-l-10"
                                                                                                         type="button"
                                                                                                         onclick='return stopload()'
                                                                                                         type="button"
                                                                                                         class="btn btn-default"
                                                                                                         data-dismiss="modal">
                                                                                                         <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                                width="24"
                                                                                                                height="24"
                                                                                                                viewBox="0 0 24 24"
                                                                                                                fill="none"
                                                                                                                stroke="currentColor"
                                                                                                                stroke-width="2"
                                                                                                                stroke-linecap="round"
                                                                                                                stroke-linejoin="round"
                                                                                                                class="feather feather-trash-2 feather-sm ms-2 fill-white">
                                                                                                                <polyline
                                                                                                                       points="3 6 5 6 21 6">
                                                                                                                </polyline>
                                                                                                                <path
                                                                                                                       d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                                                                </path>
                                                                                                                <line x1="10"
                                                                                                                       y1="11"
                                                                                                                       x2="10"
                                                                                                                       y2="17">
                                                                                                                </line>
                                                                                                                <line x1="14"
                                                                                                                       y1="11"
                                                                                                                       x2="14"
                                                                                                                       y2="17">
                                                                                                                </line>
                                                                                                         </svg>
                                                                                                         Cancel
                                                                                                  </button>
                                                                                                  <button class="btn rounded-pill px-4 btn-light-success text-success font-weight-medium waves-effect waves-light"
                                                                                                         type="submit"
                                                                                                         name="save"
                                                                                                         id="save"
                                                                                                         class="btn btn-info"
                                                                                                         value="Save"
                                                                                                         name="submit_create_hrm{sys=user_management}">
                                                                                                         <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                                width="24"
                                                                                                                height="24"
                                                                                                                viewBox="0 0 24 24"
                                                                                                                fill="none"
                                                                                                                stroke="currentColor"
                                                                                                                stroke-width="2"
                                                                                                                stroke-linecap="round"
                                                                                                                stroke-linejoin="round"
                                                                                                                class="feather feather-send feather-sm ms-2 fill-white">
                                                                                                                <line x1="22"
                                                                                                                       y1="2"
                                                                                                                       x2="11"
                                                                                                                       y2="13">
                                                                                                                </line>
                                                                                                                <polygon
                                                                                                                       points="22 2 15 22 11 13 2 9 22 2">
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

                                                 <div class='card-footer'
                                                        style='background-color: #eee;height: 37px;padding-top: 5px;'>

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
                     </div>


              </div>
              <!-- Row -->
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

       <?php include "../template/sys.footer.php";?>