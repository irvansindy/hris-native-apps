    <link rel="stylesheet" href="asset_in/css/rSlider.min.css">


    


<?php  
       $src_kpi_no                        = '';
       $src_employee_no                    = '';
       $src_full_name                = '';
       $code_print                        = '';
       if (!empty($_POST['src_kpi_no']) && !empty($_POST['src_employee_no']) && !empty($_POST['src_full_name'])) {
              $src_kpi_no                 = $_POST['src_kpi_no'];
              $src_employee_no            = $_POST['src_employee_no'];
              $src_full_name              = $_POST['src_full_name'];
              $frameworks                 = "?src_kpi_no="."".$src_kpi_no."&src_employee_no="."".$src_employee_no."&src_full_name="."".$src_full_name."";
       } else if (empty($_POST['src_kpi_no']) && empty($_POST['src_employee_no']) && !empty($_POST['src_full_name'])) {
              $src_kpi_no                 = $_POST['src_kpi_no'];
              $src_employee_no            = $_POST['src_employee_no'];
              $src_full_name              = $_POST['src_full_name'];
              $frameworks                 = "?src_full_name="."".$src_full_name."";
       } else if (empty($_POST['src_kpi_no']) && !empty($_POST['src_employee_no']) && empty($_POST['src_full_name'])) {
              $src_kpi_no                 = $_POST['src_kpi_no'];
              $src_employee_no            = $_POST['src_employee_no'];
              $src_full_name              = $_POST['src_full_name'];
              $frameworks                 = "?src_employee_no="."".$src_employee_no."";
       } else if (!empty($_POST['src_kpi_no']) && empty($_POST['src_employee_no']) && empty($_POST['src_full_name'])) {
              $src_kpi_no                 = $_POST['src_kpi_no'];
              $src_employee_no            = $_POST['src_employee_no'];
              $src_full_name              = $_POST['src_full_name'];
              $frameworks                 = "?src_kpi_no="."".$src_kpi_no."";
       } else if (empty($_POST['src_kpi_no']) && !empty($_POST['src_employee_no']) && !empty($_POST['src_full_name'])) {
              $src_kpi_no                 = $_POST['src_kpi_no'];
              $src_employee_no            = $_POST['src_employee_no'];
              $src_full_name              = $_POST['src_full_name'];
              $frameworks                 = "?src_employee_no="."".$src_employee_no."&src_full_name="."".$src_full_name."";
       } else if (!empty($_POST['src_kpi_no']) && !empty($_POST['src_employee_no']) && empty($_POST['src_full_name'])) {
              $src_kpi_no                 = $_POST['src_kpi_no'];
              $src_employee_no            = $_POST['src_employee_no'];
              $src_full_name              = $_POST['src_full_name'];
              $frameworks                 = "?src_kpi_no="."".$src_kpi_no."&src_employee_no="."".$src_employee_no."";
       } else if (!empty($_POST['src_kpi_no']) && empty($_POST['src_employee_no']) && !empty($_POST['src_full_name'])) {
              $src_kpi_no                 = $_POST['src_kpi_no'];
              $src_employee_no            = $_POST['src_employee_no'];
              $src_full_name              = $_POST['src_full_name'];
              $frameworks                 = "?src_kpi_no="."".$src_kpi_no."&src_full_name="."".$src_full_name."";
       } else {
              $frameworks                 = "";
       }
       if(!empty($_POST['src_full_name'])) {
              $code = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM hrmstatus WHERE code = '$src_full_name'"));
              $code_print = $code['name_en'];
       }
?>

<!-- Modal -->
	<div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2"  data-backdrop="false">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-body">

                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                                   <form method="post" id="myform">
                                   <!-- <form method="#" id="myform"> -->
                                          <fieldset id="fset_1" style="margin-top: 25px;border-radius: 5px;border: 1px solid #e4e8ea;">
                                                 <legend>Searching</legend>
                                                 <div class="form-row">
                                                        <div class="col-4 name">KPI Code</div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on" id="src_kpi_no"
                                                                             name="src_kpi_no" id="src_kpi_no" type="Text" value="<?php echo $src_kpi_no; ?>"
                                                                             onfocus="hlentry(this)" size="30" maxlength="50" 
                                                                             validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title="">
                                                               </div>
                                                        </div>
                                                 </div>
                                                 
                                                 <div class="form-row">
                                                        <div class="col-4 name">Employee No.</div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on" id="src_employee_no"
                                                                             name="src_employee_no" id="src_employee_no" type="Text" value="<?php echo $src_employee_no; ?>"
                                                                             onfocus="hlentry(this)" size="30" maxlength="50" 
                                                                             validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title="">
                                                               </div>
                                                        </div>
                                                 </div>

                                                 <div class="form-row">
                                                        <div class="col-4 name">Employee Name </div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on" id="src_full_name"
                                                                             name="src_full_name" id="src_full_name" type="Text" value="<?php echo $src_full_name; ?>"
                                                                             onfocus="hlentry(this)" size="30" maxlength="50" 
                                                                             validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title="">

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




















<div class="col-md-12">
       <div class="card">
              <div class="card-header d-flex align-items-center">
                     <h4 class="card-title mb-0"> Performance Final Result</h4>
                     <div class="card-actions ml-auto">
                            <table>
                                   <td>
                                          <form action="../rfid=repository/cli_Template_Download/pr/StFunctionDownload.php" method="GET">
                                                 <input type="hidden" name="filedata" value="StDownloadGTTGRPerformanceResultData.php">
                                                 <input type="hidden" name="filename" value="PerformanceResultData">
                                                 <input type="hidden" name="src_kpi_no" value="<?php echo $src_kpi_no; ?>">
                                                 <input type="hidden" name="src_employee_no" value="<?php echo $src_employee_no; ?>">
                                                 <input type="hidden" name="src_full_name" value="<?php echo $src_full_name; ?>">
                                                 <button type="submit" class="toolbar sprite-toolbar-excel" id="EXCEL" style="border: 0;background-color: white;" name="submit_approve" value="submit"></button>
                                          </form>
                                   </td>


                                   <td>
                                          <a href='#' class='open_modal_search' class="btn btn-demo" data-toggle='modal' data-target='#CreateFormPeriod' id='CreateButtonSPVUP' data-keyboard='false' data-backdrop='false'>
                                                 <div class="toolbar sprite-toolbar-upload" id="SEARCH" title="Search">
                                                 </div>
                                          </a>
                                   </td>
                                   <td>
                                          <a href='#' class='open_modal_search' class="btn btn-demo" data-toggle="modal" data-target="#myModal2">
                                                 <div class="toolbar sprite-toolbar-search" id="SEARCH" title="Search">
                                                 </div>
                                          </a>
                                   </td>
                                   <!-- AgusPrass 02/03/2021 Menghapus # pada href-->
                                   <td>
                                          <div class="toolbar sprite-toolbar-reload" id="RELOAD" title="Reload"
                                                 onclick="RefreshPage();">
                                          </div>
                                   </td>
                                   <!-- AgusPrass 02/03/2021 -->
                            </table>
                     </div>
              </div>

              <div class="card-body table-responsive p-0" style="width: 100vw;height: 78vh; width: 98.4%; margin: 5px;overflow: scroll;">
                     <table id="datatable" width="100%" border="1"
                            class="table table-bordered table-striped table-hover table-head-fixed">
                            <thead>
                                   <tr>
                                          <th class="fontCustom"
                                                 style="z-index: 1;vertical-align: ce;vertical-align: middle;"
                                                 nowrap="nowrap">No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                          <th class="fontCustom"
                                          style="z-index: 1; vertical-align: middle; width: 100px;">
                                                 KPI Code&nbsp;&nbsp;&nbsp;</th>
                                        
                                          <th class="fontCustom"
                                                 style="z-index:1;vertical-align: ce;vertical-align: middle;">KPI Period&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          </th>
                                          <th class="fontCustom"
                                                 style="z-index:1;vertical-align: ce;vertical-align: middle;">Employee no&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          </th>
                                          <th class="fontCustom"
                                                 style="z-index:1;vertical-align: ce;vertical-align: middle;">Employee name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          </th>
                                          <th class="fontCustom"
                                                 style="z-index:1;vertical-align: ce;vertical-align: middle;">Performance Result&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          </th>
                                          <th class="fontCustom"
                                                 style="z-index:1;vertical-align: ce;vertical-align: middle;">Performance Grade&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          </th>
                                           <th class="fontCustom"
                                                 style="z-index:1;vertical-align: ce;vertical-align: middle;">Performance Adjustment&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          </th>
                                          <th class="fontCustom"
                                                 style="z-index:1;vertical-align: ce;vertical-align: middle;">Created date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          </th>
                                           <th class="fontCustom"
                                                 style="z-index:1;vertical-align: ce;vertical-align: middle;">Created by&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          </th>
                                          <th class="fontCustom"
                                                 style="z-index:1;vertical-align: ce;vertical-align: middle;">Modified date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          </th>
                                          <th class="fontCustom"
                                                 style="z-index:1;vertical-align: ce;vertical-align: middle;">Modified by&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          </th>
                                          <th class="fontCustom"
                                                 style="z-index: 1;vertical-align: ce;vertical-align: middle;">
                                                 Action&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          </th>
                                          <!-- <th class="fontCustom" style="z-index: 1;vertical-align: ce;vertical-align: middle;">Grade</th>
                                    
                                          <th class="fontCustom" style="z-index: 1;vertical-align: ce;vertical-align: middle;">Join Date</th>
                                                                <th class="fontCustom" style="z-index: 1;vertical-align: ce;vertical-align: middle;">Employment Code</th> -->
                                   </tr>
                            </thead>
                     </table>

              </div>
              <div class='card-footer' style='background-color: #eee;height: 37px;padding-top: 5px;'>
              </div>
       </div>
</div>



































































<!-- add modal -->
<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="FormDisplayDelete">
              <div class="modal-dialog modal-belakang modal-bs" role="document">
              <div class="modal-content">
                     <div class="modal-header">
                            <h4 class="modal-title">Edit Data Upload</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98.4%; margin: 5px;overflow: scroll;overflow-x: hidden;">

                     <form class="form-horizontal" action="php_action/FuncDataUpdate.php" method="POST" id="updatedelMemberForm" onkeydown="return event.key != 'Enter';">

                            <fieldset id="fset_1">
                                   <legend>&nbsp;Employee Information&nbsp;</legend>

<!--                                    
 <div class="container">
              <div class="slider-container">
              <input type="text" id="slider" class="slider" />
              </div>
       </div>
    
    <script src="asset_in/js/rSlider.min.js"></script>
    <script>
        (function () {
            'use strict';

            var init = function () {                
                var slider3 = new rSlider({
                    target: '#slider3',
                    values: ["A", "B", "C", "D"],
                    step: 10,
                    range: true,
                    set: [10, 40],
                    scale: true,
                    labels: false,
                    onChange: function (vals) {
                        console.log(vals);
                    }
                });

                var slider = new rSlider({
                    target: '#slider',
                   values: ["A", "B", "C", "D"],
                    range: false,
                    set: [2010, 2013],
                    onChange: function (vals) {
                        console.log(vals);
                    }
                });
            };
            window.onload = init;
        })();
    </script> -->

                                   <div class="messages_create"></div>

                                   <input id="sel_emp_no_approver" name="sel_emp_no_approver" type="hidden" value="<?php echo $username; ?>"><!--FROM SESSION -->
                             
                                   <div class="form-row">
                                          <div class="col-4 name"> Perormance Request <span class="required">*</span></div>
                                          <div class="col-sm-8 name">
                                                 <div class="input-group" id="sel_identity_pa_reqno" style="font-weight: bold;color: #5b5b5b;">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name"> Perormance Period <span class="required">*</span></div>
                                          <div class="col-sm-8 name">
                                                 <div class="input-group" id="sel_identity_pa_period" style="font-weight: bold;color: #5b5b5b;">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name"> Employee <span class="required">*</span></div>
                                          <div class="col-sm-4 name">
                                                 <div class="input-group" id="sel_identity_requester" style="font-weight: bold;color: #5b5b5b;">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row" style="display:none;">
                                          <div class="col-4 name"> PP Detail <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_ipp_reqno" name="sel_ipp_reqno"
                                                               type="Text">

                                                 </div>
                                          </div>
                                   </div>
                                   </fieldset>

                                   <fieldset id="fset_1">
                                   <legend>Performance </legend>
                                   
                                   <div class="form-row">
                                          <div class="col-4 name"> Perormance Result <span class="required">*</span></div>
                                          <div class="col-sm-8 name">
                                                  <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_ipp_result" name="sel_ipp_result"
                                                               type="Text">
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name"> Perormance Grade <span class="required">*</span></div>
                                          <div class="col-sm-8 name">


                                                 <select id="sel_ipp_grade" class="input--style-6"
                                                                             name="sel_ipp_grade" onfocus="hlentry(this)"
                                                                             onchange="formodified(this);"
                                                                             style="width:undefined;border: 1px solid #cac2c2;color: #484545; height:33px">
                                                                             <?php
                                                                                    $sql = mysqli_query($connect,"SELECT * FROM hrmperf_range WHERE active = '1' ORDER BY order_no asc");
                                                                                    while($row=mysqli_fetch_array($sql))
                                                                                    {
                                                                                           echo '<option value="'.$row['id_range'].'">'.$row['id_range'].' [ '.$row['persentage_start'].' %  - '.$row['persentage_end'].'  % ] </option>';
                                                                                    } 
                                                                             ?>
                                                                      </select>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name"> Perormance Grade Adjustment <span class="required">*</span></div>
                                          <div class="col-sm-8 name">

                                                 <select id="sel_ipp_grade_adj" class="input--style-6"
                                                                             name="sel_ipp_grade_adj" onfocus="hlentry(this)"
                                                                             onchange="formodified(this);"
                                                                             style="width:undefined;border: 1px solid #cac2c2;color: #484545; height:33px">
                                                                             <?php
                                                                                    $sql = mysqli_query($connect,"SELECT * FROM hrmperf_range WHERE active = '1' ORDER BY order_no asc");
                                                                                    while($row=mysqli_fetch_array($sql))
                                                                                    {
                                                                                           echo '<option value="'.$row['id_range'].'">'.$row['id_range'].' [ '.$row['persentage_start'].' %  - '.$row['persentage_end'].'  % ]</option>';
                                                                                    } 
                                                                             ?>
                                                                      </select>
                                          </div>
                                   </div>

                            </fieldset>


                            <fieldset id="fset_1" style="display:none">
                                   <legend>Remark From Approver</legend>
                                   <div class="card-body table-responsive p-0" style="height: 130px; margin: 1px;overflow: scroll;">
                                          <table class="table table-bordered table-hover table-head-fixed">
                                                 <thead>
                                                        <tr>
                                                               <th>Remark.</th> 
                                                        </tr>
                                                 </thead>
                                                 <tbody>
                                                        <tr id="recs-1" style="background: #eee;border: 1px solid #0869bd;">
                                                               <td>
                                                                      <textarea name="sel_remark_from_approver" id="sel_remark_from_approver" class="form-control"></textarea>
                                                               </td>
                                                        </tr>
                                                 </tbody>
                                          </table>
                                   </div>
                            </div>
                            </fieldset>

                            <!-- //LOAD BUTTON APPROVER STATUS -->
                            <div class="modal-footer">
                                   <button type="reset" class="btn btn-primary1" style="background: #e1e1e1;" data-dismiss="modal"
                                          aria-hidden="true" data-backdrop="false">
                                          &nbsp;Cancel&nbsp;
                                   </button>
                                   <button class="btn btn-warning" type="submit" name="submit_approval_spvdown" id="submit_approval_spvdown">
                                          Submit
                                   </button>
                                   <button class="btn btn-warning" type="button" name="submit_approval_spvdown2"
                                          id="submit_approval_spvdown2" style='display:none;' disabled>
                                          <span class="spinner-grow spinner-grow-sm" role="status"
                                                 aria-hidden="true"></span>
                                          &nbsp;&nbsp;Processing..
                                   </button>
                            </div>
                            <!-- //LOAD BUTTON APPROVER STATUS -->
                     </form>
              </div>
       </div>
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /edit modal -->









































































































































































































































<!-- edit modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="CreateFormPeriod">
              <div class="modal-dialog modal-belakang" role="document">
             <div class="modal-content" style="border: 1px solid #b3b2b2;background: #f9f9f9">
                     <div class="modal-header">
                            <h4 class="modal-title">Upload Performance Final Result</h4>
                            <button type="button" class="close" onclick="RefreshPage();" data-dismiss="modal"
                                   aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true">&times;</span>
                            </button>
                     </div>

                            <form name="myForm" id="myForm" enctype="multipart/form-data" action="php_action/FuncDataUpload" method="post" target="popupwindow" onsubmit="return validateForm(), window.open('php_action/FuncDataUpload', 'popupwindow', 'scrollbars=yes,toolbar=no,width=800,height=400');"> 
                            <span class="xls" align="left"><font size="-1" color="#00000" face="Arial, Gadget, sans-serif"><span class="berhasil">

                            <fieldset id="fset_1" style="height: 150px;">
                                   <legend>Upload Form</legend>

                                   <div class="messages_create"></div>

                                   <input id="inp_emp_no" name="inp_emp_no" type="hidden" value="<?php echo $username; ?>"><!--FROM SESSION -->
                                   <input id="inp_token" name="inp_token" type="hidden" value="<?php echo $get_token; ?>"><!--FROM CONFIGURATION -->

                                   <div class="form-row">
                                          <div class="col-sm-1 name">
                                                 <a href='../cli_Template_Download/pr/DownloadGTTGRPerformanceResultExport.php' class='open_modal_search' class="btn btn-demo">
                                                        <div class="toolbar sprite-toolbar-excel">
                                                        </div>
                                                 </a>                                          
                                          </div>
                                          <div class="col-sm-5 name" style="padding-top: 4px;">
                                                 Download booking
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-sm-12 name" style="margin-top: -4px;">   
                                          File allowed: Excel 97-2003 file (*.xls)
						Maximum file size: 4 MB <span class="required">*</span></div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-sm-8">
                                                 <div class="input-group">
                                                        <input name="date" class="hidden" type="hidden" value="<?php echo date('Y-m-d H:i:s') ?>">
                                                        <input type="file" id="filepegawaiall" name="filepegawaiall" />
                                                 </div>
                                          </div>
                                   </div>                              
                            </fieldset>
                            <br>

                                   <div class="form-row">
                                          <div class="col-sm-3 name" style="margin-top: -4px;">   
                                          <strong style="font-weight:bold">Note : upload condition</strong> <span class="required">*</span></div>
                                          <div class="col-sm-9 name" style="margin-top: -4px;">   
                                          1. All column must be filled<br>
                                          2. Please make sure employee active, employee no & employee name matching<br>
                                          3. Please download booking on icon excel<br>
                                          4. If data already exist your upload will be update existing data
                                          </div>
                                   </div>

                            <div class="modal-footer">
                                   <button type="reset" class="btn btn-primary1" onclick="RefreshPage();" data-dismiss="modal"
                                          aria-hidden="true">
                                          &nbsp;Cancel&nbsp;
                                   </button>
                                   <button class="btn btn-warning" type="submit" name="submit" id="submit">
                                          Upload
                                   </button>
                                   <button class="btn btn-warning" type="button" name="submit_revision_spvup2"
                                          id="submit_revision_spvup2" style='display:none;' disabled>
                                          <span class="spinner-grow spinner-grow-sm" role="status"
                                                 aria-hidden="true"></span>
                                          &nbsp;&nbsp;Processing..
                                   </button>
                            </div>


                            
				<div class="modal-body">      	

						

                                          <script type="text/javascript">
                                          function validateForm()
                                          {
                                                 function hasExtension(inputID, exts) {
                                                 var fileName = document.getElementById(inputID).value;
                                                 return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
                                                 }
                                                 if(!hasExtension('filepegawaiall', ['.xls'])){
                                                 alert("Hanya file XLS (Excel 2003) yang diijinkan.");
                                                 return false;
                                                 }
                                          }
                                          </script>
					</form>
                     </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
       </div><!-- /.modal -->
       <!-- /edit modal -->











  
                     
                            
                                   
                                
                                   
                                 
               
                   
            






<script>
function RefreshPage() {
       datatable.ajax.reload(null, true);

       setTimeout(function(){
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
function CloseThis() {
      $('.modal-backdrop').remove();
}
</script>

























  
                     
                            
                                   
                                
                                   
                                 
               
                   
            





<!-- isi JSON -->
<script type="text/javascript">
function editdelMember(id = null) {

       mymodalss.style.display = "block";
       
	if(id) {

		$.ajax({
			url: 'php_action/getSelectedEmployee.php',
			type: 'post',
			data: {member_id : id},
			dataType: 'json',
			success:function(response) {

                            mymodalss.style.display = "none";

                            document.getElementById("sel_identity_pa_reqno").innerHTML = response.ipp_reqno;
                            document.getElementById("sel_identity_pa_period").innerHTML = response.period_name;
                            document.getElementById("sel_identity_requester").innerHTML = response.Full_Name + " ("+response.emp_no+") "; 

				$("#sel_ipp_result").val(response.pa_result);
                            $("#sel_ipp_grade").val(response.pa_grade);
                            $("#sel_ipp_grade_adj").val(response.pa_result_adjust);
                            $("#sel_ipp_reqno").val(response.ipp_reqno);

                            
                          

				// mmeber id 
				$(".FormDisplayDelete").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');

				// here update the member data
				$("#updatedelMemberForm").unbind('submit').bind('submit', function() {

                                   mymodalss.style.display = "block";
                                  
					// remove error messages
					$(".text-danger").remove();

					var form = $(this);

					// validation
					var sel_ipp_result = $("#sel_ipp_result").val();

					if(sel_ipp_result == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "There is some error";
                                   } else {
                                          $('#submit_approval_spvdown').hide();
                                          $('#submit_approval_spvdown2').show();
                                   }

					if(sel_ipp_result) {


						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {
								if (response.code == 'success_message_approved_spv_down') {
                                                               
                                                               $('#submit_approval_spvdown').show();
                                                               $('#submit_approval_spvdown2').hide();    
                                                               
                                                               mymodalss.style.display = "block";

                                                               // reload the datatables
                                                               datatable.ajax.reload(null,false);
                                                               // reload the datatables

                                                               $('#FormDisplayDelete').modal('hide');
                                                      
                                                               $("[data-dismiss=modal]").trigger({type: "click"});

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

	} else {
		alert("Error : Refresh the page again");
	}
}










































































</script>
<!-- isi JSONs -->
</body>

</html>

<script>

jQuery(function($) {
       $("#nip").mask("99-9999");
       $("#nik").mask("9999999999999999");
       $("#join").mask("9999-99-99");
       $("#date").mask("9999-99-99");
       $("#account").mask("9999-9-99999-9");
});
</script>
<!-- 
<script type="text/javascript">
function isi_otomatis() {
       var nip = $("#nip").val();
       $.ajax({
              url: 'ajax_cek.php',
              data: "nip=" + nip,
       }).success(function(data) {
              var json = data,
                     obj = JSON.parse(json);
              $('#nama').val(obj.nama);
              $('#nik').val(obj.nik);
              $('#org').val(obj.org);
              $('#emp').val(obj.emp);
              $('#join').val(obj.join);
              $('#account').val(obj.account);
              $('#norek').val(obj.norek);
              $('#approve').val(obj.approve);
              $('#grp').val(obj.grp);
              $('#jobstatus').val(obj.jobstatus);
       });
}
</script> 
                        
<script type="text/javascript">
       var tree4 = $("#test-select-4").treeMultiselect({
              allowBatchSelection: true,
              enableSelectAll: true,
              searchable: true,
              sortable: true,
              startCollapsed: false,
       });
</script> -->