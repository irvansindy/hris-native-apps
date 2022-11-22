<?php  
       $src_kpi_no                        = '';
       $src_employee_no                   = '';
       $src_full_name                     = '';
       $src                               = '';

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
                                          <fieldset id="fset_1" style="margin-top: 25px;border-radius: 5px;border: 1px solid #e4e8ea;">
                                                 <legend>Searching</legend>
                                                 <div class="form-row">
                                                        <div class="col-4 name">KPI Code </div>
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
                                                        <div class="col-4 name">Employee No. </div>
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
                                                                             autocomplete="off" autofocus="on"
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
              columnDefs: [
              { orderable: false, targets: 0 }
              ], 
              destroy: true,
              "ajax": "php_action/FuncDataRead.php<?php echo $frameworks; ?>"
       });
});
</script>

<style>
       /* thead {
              display:none;
              } */
       .sorting_1 {
              border-left: 1px solid white;
       }
       .odd  {
              border-left: 1px solid white;
       }
             
</style>

<!-- 
<div class="col-md-12">
       <div class="card" style="border-radius: 20px 20px 20px 20px;">
              <div class="card-header d-flex align-items-center" style="border-bottom: 1px solid white;">
                     <h4 class="card-title mb-0">IP Records Entry </h4>


                     <div class="card-actions ml-auto">
                            <table>

                                   <td>
                                          <form action="../rfid=repository/cli_Template_Download/st/StFunctionDownload.php" method="GET">
                                                 <input type="hidden" name="filedata" value="StDownloadGTTGROvertimeSettingData.php">
                                                 <input type="hidden" name="filename" value="Overtime Setting">
                                                 <input type="hidden" name="src_news" value="<php echo $src_news; ?>">
                                                 <input type="hidden" name="src_title" value="<php echo $src_title; ?>">
                                                 <button type="submit" class="toolbar sprite-toolbar-excel" id="EXCEL" style="border: 0;background-color: white;" name="submit_approve" value="submit"></button>
                                          </form>
                                   </td> -->
                                   <!-- <td>
                                          <a href='#' class='open_modal_search' class="btn btn-demo" data-toggle="modal" data-target="#myModal2">
                                                 <div class="toolbar sprite-toolbar-search" id="SEARCH" title="Search">
                                                 </div>
                                          </a>
                                   </td> -->
                                   <!-- AgusPrass 02/03/2021 Menghapus # pada href-->
                                   <!-- <td>
                                          <div class="toolbar sprite-toolbar-reload" id="RELOAD" title="Reload"
                                                 onclick="RefreshPage();">
                                          </div>
                                   </td>

                            </table>
                     </div>
              </div>

              <div class="card-body table-responsive p-0"
                     style="width: 100vw;height: 70vh; width: 98%; margin: 5px;overflow:scroll;overflow-x: hidden;">
                     <table id="datatable" width="100%" border="1" align="left"
                            class="table table-bordered-sdk table-hover">
                            <thead hidden="hidden">
</thead>
                     </table>

              </div> -->
<!-- 
              <div class='card-footer' style='background-color: #eee;height: 37px;padding-top: 5px;'>
              </div>
       </div>
</div> -->




<body id="bods" style="padding-right:0px;" class="margin">
<div class="col-md-12">
       <div class="card">
              <div class="card-header d-flex align-items-center">
                     <h4 class="card-title mb-0">IPP Records </h4>
                     <div class="card-actions ml-auto">
                            <table>

                                   <td>
                                          <a href='#' class='open_modal_search' class="btn btn-demo" data-toggle="modal" data-target="#myModal2">
                                                 <div class="toolbar sprite-toolbar-search" id="SEARCH" title="Search">
                                                 </div>
                                          </a>
                                   </td>

                                   <td>
                                          <div class="toolbar sprite-toolbar-reload" id="RELOAD" title="Reload"
                                                 onclick="RefreshPage();">
                                          </div>
                                   </td>

                                   <?php
                                          $get_request_regulation = mysqli_query($connect, "SELECT *
                                                                                                  FROM
                                                                                                  hrdperf_set_period
                                                                                                  WHERE 
                                                                                                         emp_no        = '$username' AND
                                                                                                         period_id     = (SELECT MAX(x1.period_id) FROM hrdperf_set_period x1 WHERE x1.emp_no = '$username') AND
                                                                                                         period_type   = '1'");
                                          if(mysqli_num_rows($get_request_regulation) < 1){
                                                 $data_target  = 'data-target="#CreateFormSPVUP"';
                                                 $id           = 'id="CreateButtonSPVUP"';
                                          } else {
                                                 $data_target  = 'data-target="#CreateForm"';
                                                 $id           = 'id="CreateButton"';
                                          }
                                   ?>
                                   <?php
                                          $get_period = mysqli_query($connect, "SELECT a.*
                                          FROM
                                          hrmperf_set_period a
                                          WHERE 
                                                 '$SFdate' BETWEEN DATE(a.period_pp_start) AND DATE(a.period_pp_end)");
                                   ?>
                                   <?php
                                   if(mysqli_num_rows($get_period) > 0){
                                          $row = mysqli_fetch_array($get_period);
                                          $data = '';
                                   } else {
                                          $data = 'display:none;';
                                   }
                                   ?>
                                   <!-- <td>
                                          <div class="toolbar sprite-toolbar-add" title="Add" data-toggle="modal" style="<?php echo $data; ?>"
                                                 data-target="#CreateFormSPVUP" id="CreateButtonSPVUP" data-keyboard="false"
                                          data-backdrop="static">
                                                 data-backdrop="static">
                                                <a title="add" href="" class="toolbar sprite-toolbar-add" data-toggle="modal" data-target="#CreateForm" id="CreateButton" data-keyboard="false" data-backdrop="static">tambah</a>
                                          </div>
                                   </td> -->
                            </table>
                     </div>
              </div>

              <div class="card-body table-responsive p-0" style="width: 100vw;height: 78vh; width: 98%; margin: 5px;overflow: scroll;">
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
                                                 style="z-index: 1; vertical-align: middle; width: 100px;">
                                                 KPI Type&nbsp;&nbsp;&nbsp;</th>
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
                                                 style="z-index:1;vertical-align: ce;vertical-align: middle;">Position&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          </th>
                                          <th class="fontCustom"
                                                 style="z-index:1;vertical-align: ce;vertical-align: middle;">Cost Center&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          </th>
                                          <!-- <th class="fontCustom"
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
                                          </th> -->
                                          <th class="fontCustom"
                                                 style="z-index:1;vertical-align: ce;vertical-align: middle;">Request status&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
</div>






















































<!-- edit modal -->
<div class="modal  fade fade-custom" tabindex="-1" role="dialog" id="UpdateForm">
       <div class="modal-dialog modal-bgkpi" role="document">

              <div class="modal-content">
                     <div class="modal-header">
                            <h4 class="modal-title">Edit Scheduling Group Setting</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <!-- <form class="form-horizontal" action="php_action/FuncDataUpdate.php" method="POST" id="updateMemberForm"> -->
                     <form class="form-horizontal" action="php_action/FuncDataUpdate.php" method="POST" id="FormDisplayUpdate">

                            <fieldset id="fset_1">
                                   <legend>General</legend>

                                   <div class="messages_update"></div>

                                   <input id="sel_emp_no" name="sel_emp_no" type="hidden" value="<?php echo $username; ?>"><!--FROM SESSION -->
                                   <input id="sel_token" name="sel_token" type="hidden" value="<?php echo $get_token; ?>"><!--FROM CONFIGURATION -->

                                   <div class="form-row">
                                          <div class="col-4 name"> Code <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group" id="sel_identity">
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row" style="display:none">
                                          <div class="col-4 name">Code <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_category_code" name="sel_category_code"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;width: 60%;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name">Name <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_category_name_en" name="sel_category_name_en"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;width: 60%;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                        <img src="../../asset/img/icons/flag_en.png">
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name"></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">
                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_category_name_id" name="sel_category_name_id"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;width: 60%;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                        <img src="../../asset/img/icons/flag_id.png">
                                                 </div>
                                          </div>
                                   </div>
                                  
                            </fieldset>

                            <div class="modal-footer">
                                   <button type="reset" class="btn btn-primary1" data-dismiss="modal"
                                          aria-hidden="true">
                                          &nbsp;Cancel&nbsp;
                                   </button>
                                 
                                   <button class="btn btn-warning" type="submit" name="submit_update" id="submit_update">
                                          Confirm
                                   </button>
                                   <button class="btn btn-warning" type="button" name="submit_update2"
                                          id="submit_update2" style='display:none;' disabled>
                                          <span class="spinner-grow spinner-grow-sm" role="status"
                                                 aria-hidden="true"></span>
                                          &nbsp;&nbsp;Processing..
                                   </button>
                            </div>
                     </form>

                     
              </div>

              </form>
       </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /edit modal -->





















<!-- add modal -->
<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="FormDisplayApproverSPVUP">
              <div class="modal-dialog modal-belakang modal-bs modal-bgkpi" role="document">
              <div class="modal-content" >
                     <div class="modal-header">
                            <h4 class="modal-title">IPP Records Entry</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

                     <form class="form-horizontal" action="php_action/FuncDataUpdateSPVUP.php" method="POST" id="updateApproveSPVUPMemberForm">

                            <fieldset id="fset_1">
                                   <legend>&nbsp;Employee Information&nbsp;</legend>

                                   <div class="messages_create"></div>

                                   <input id="sel_emp_no_approver" name="sel_emp_no_approver" type="hidden" value="<?php echo $username; ?>"><!--FROM SESSION -->
                             
                                   <div class="form-row">
                                          <div class="col-4 name"> Perormance Period <span class="required">*</span></div>
                                          <div class="col-sm-8 name">
                                                 <div class="input-group" id="sel_identity_spvup_pa_reqno" style="font-weight: bold;color: #5b5b5b;">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name"> Employee <span class="required">*</span></div>
                                          <div class="col-sm-4 name">
                                                 <div class="input-group" id="sel_identity_spvup_requester" style="font-weight: bold;color: #5b5b5b;">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row" style="display:none">
                                          <div class="col-4 name"> PP Detail <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_ipp_reqno_spv_upS" name="sel_ipp_reqno_spv_upS"
                                                               type="Text">
                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_ipp_requester_spv_upS" name="sel_ipp_requester_spv_upS"
                                                               type="Text">

                                                 </div>
                                          </div>
                                   </div>
                                   </fieldset>

                                   <fieldset id="fset_1">
                                   <legend>KPI Detail</legend>
                                                 <div class="card-body table-responsive p-0" style="width: 100%; margin: 1px;overflow: scroll;">
                                                        <!-- pages relation -->
                                                        <div id="box_spvup"></div>
                                                        <!-- pages relation -->
                                                 <div>
                                   </div>
                            </fieldset>


                       
                            </div>
                           

                            <!-- //LOAD BUTTON APPROVER STATUS -->
                            <div class="modal-footer">
                                   <button type="reset" class="btn btn-primary1" style="background: #e1e1e1;" data-dismiss="modal"
                                          aria-hidden="true" data-backdrop="false">
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





































<!-- add modal -->
<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="FormDisplayAddEffidentSPVUP">
              <div class="modal-dialog modal-belakang modal-bs modal-med" role="document" style="margin-top: 38px;">
              <div class="modal-content">
                     <div class="modal-header">
                            <h4 class="modal-title" id="entry_spvup">Entry List</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

                     <form class="form-horizontal" action="php_action/FuncDataUpdateSPVUP.php" method="POST" id="updateApproveSPVUPMemberForm">

                            <fieldset id="fset_1">
                                   <legend>&nbsp;Employee Information&nbsp;</legend>

                                   <div class="messages_create"></div>

                                   <input id="sel_emp_no_approver" name="sel_emp_no_approver" type="hidden" value="<?php echo $username; ?>"><!--FROM SESSION -->
                             
                                   <div class="form-row">
                                          <div class="col-4 name"> Performance Period <span class="required">*</span></div>
                                          <div class="col-sm-8 name">
                                                 <div class="input-group" id="sel_identity_effident_spvup_pa_reqno" style="font-weight: bold;color: #5b5b5b;">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name"> Employee <span class="required">*</span></div>
                                          <div class="col-sm-4 name">
                                                 <div class="input-group" id="sel_identity_effident_spvup_requester" style="font-weight: bold;color: #5b5b5b;">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row" style="display:none">
                                          <div class="col-4 name"> PP Detail <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_ipp_reqno_spv_upS" name="sel_ipp_reqno_spv_upS"
                                                               type="Text">
                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_ipp_requester_spv_upS" name="sel_ipp_requester_spv_upS"
                                                               type="Text">

                                                 </div>
                                          </div>
                                   </div>
                                   </fieldset>

                                   <fieldset id="fset_1">
                                   <legend>KPI Review</legend>
                                                 <div class="card-body table-responsive p-0" style="width: 100%; margin: 1px;overflow: scroll;">
                                                        <!-- pages relation -->
                                                        <div id="box_spvup_effident"></div>
                                                        <!-- pages relation -->
                                                 <div>
                                   </div>
                            </fieldset>


                       
                            </div>
                           

                            <!-- //LOAD BUTTON APPROVER STATUS -->
                            <div class="modal-footer">
                                   <button type="reset" class="btn btn-primary1" style="background: #e1e1e1;" data-dismiss="modal"
                                          aria-hidden="true" data-backdrop="false">
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




<!-- isi JSON -->
<script type="text/javascript">
function editApprovalSPVUPMember(id = null) {

       mymodalss.style.display = "block";
       
	if(id) {

		$.ajax({
			url: 'php_action/getSelectedEmployeeSPVUP.php',
			type: 'post',
			data: {member_id : id},
			dataType: 'json',
			success:function(response) {

                            document.getElementById("sel_identity_spvup_pa_reqno").innerHTML = response.ipp_reqno;
                            document.getElementById("sel_identity_spvup_requester").innerHTML = response.Full_Name + " ("+response.requester+") "; 
                            
                            // document.getElementsByTagName("harusdiselipin").setAttribute("class", "democlass"); 
                            $("#submit_reject_spvup").attr("onclick", "editreject_spvup_request(`" + response.ipp_reqno + "`)");
                            $("#submit_revision_spvup").attr("onclick", "editrevision_spvup_request(`" + response.ipp_reqno + "`)");
                            // onclick="editrejectrequest(`PAREQ2022-130299`)"

				$("#sel_ipp_reqno_spv_upS").val(response.ipp_reqno); 
                            $("#sel_ipp_requester_spv_upS").val(response.requester);
                            // $("#sel_remark_from_approver").val(response.remark);

                            $("#box_spvup").load("pages_relation/_pages_approval_spvup.php?rfid=" + response.ipp_reqno, 
                                   function(responseTxt, statusTxt, jqXHR){
                                          if(statusTxt == "success"){
                                                 $("#box_spvup").show();
                                          }
                                          if(statusTxt == "error"){
                                                 alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                          }
                                   }
                            );
                          
                            $.ajax({
                                   url: 'php_action/getRequestStatusSPVUP.php',
                                   type: 'post',
                                   data: {request_no_spvup : response.ipp_reqno},
                                   dataType: 'json',
                                   success:function(response) {
                                                 
                                                 mymodalss.style.display = "none";

                                                 var fill_is_approved_spvup = response.is_approved_spvup;

                                                 if(fill_is_approved_spvup == 1){ //jika sudah approve request
                                                        document.getElementById("submit_reject_spvup").style.display = "none";
                                                        document.getElementById("submit_revision_spvup").style.display = "none";
                                                        document.getElementById("submit_approval_spvup").style.display = "none";
                                                 } else {
                                                        document.getElementById("submit_reject_spvup").style.display = "block";
                                                        document.getElementById("submit_revision_spvup").style.display = "block";
                                                        document.getElementById("submit_approval_spvup").style.display = "block";
                                                 }
                                          }
					}); // /ajax

				// mmeber id 
				$(".FormDisplayApproverSPVUP").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');

				// here update the member data
				$("#updateApproveSPVUPMemberForm").unbind('submit').bind('submit', function() {

                                   mymodalss.style.display = "block";
                                  
					// remove error messages
					$(".text-danger").remove();

					var form = $(this);

					// validation
					var sel_ipp_reqno_spv_upS = $("#sel_ipp_reqno_spv_upS").val();
                                   var sel_ipp_requester_spv_upS = $("#sel_ipp_reqno_spv_upS").val();

					if(sel_ipp_reqno_spv_upS == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "There is some error";
                                   } else if(sel_ipp_requester_spv_upS == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "There is some error";
                                   } else {
                                          $('#submit_approval_spvup').hide();
                                          $('#submit_approval_spvup2').show();
                                   }

					if(sel_ipp_reqno_spv_upS && sel_ipp_requester_spv_upS) {


						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {
								if (response.code == 'success_message_approved_spv_up') {

                                                               $('#submit_approval_spvup').show();
                                                               $('#submit_approval_spvup2').hide();    
                                                               
                                                               mymodalss.style.display = "none";

                                                               // reload the datatables
                                                               datatable.ajax.reload(null,false);
                                                               // reload the datatables

                                                               $('#FormDisplayApproverSPVUP').modal('hide');
                                                      
                                                               $("[data-dismiss=modal]").trigger({type: "click"});

                                                               modals.style.display = "block";
                                                               document.getElementById("msg").innerHTML = response.messages;

                                                               
                                                               
                                                        } else {
                                                               $('#submit_approval_spvup').show();
                                                               $('#submit_approval_spvup2').hide();

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










function editApprovalEffidentSPVUPMember(id = null) {

       mymodalss.style.display = "block";
       
	if(id) {

		$.ajax({
			url: 'php_action/getSelectedEmployeeEffidentSPVUP.php',
			type: 'post',
			data: {member_id : id},
			dataType: 'json',
			success:function(response) {
                            
                            mymodalss.style.display = "none";

                            document.getElementById("sel_identity_effident_spvup_pa_reqno").innerHTML = response.ipp_reqno;
                            document.getElementById("sel_identity_effident_spvup_requester").innerHTML = response.Full_Name + " ("+response.requester+") ";

                            document.getElementById("entry_spvup").innerHTML = response.perspektif_name;

                            $("#box_spvup_effident").load("pages_relation/_pages_approval_effident_spvup.php?rfid=" + response.ipp_reqno + "&kpi_pers_spv_up=" + response.kpi_pers_spv_up, 
                                   function(responseTxt, statusTxt, jqXHR){
                                          if(statusTxt == "success"){
                                                 $("#box_spvup_effident").show();
                                          }
                                          if(statusTxt == "error"){
                                                 alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                          }
                                   }
                            );
                          
				// mmeber id 
				$(".FormDisplayApproverSPVUP").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');

				// here update the member data
				$("#updateApproveSPVUPMemberForm").unbind('submit').bind('submit', function() {

                                   mymodalss.style.display = "block";
                                  
					// remove error messages
					$(".text-danger").remove();

					var form = $(this);

					// validation
					var sel_ipp_reqno_spv_upS = $("#sel_ipp_reqno_spv_upS").val();
                                   var sel_ipp_requester_spv_upS = $("#sel_ipp_reqno_spv_upS").val();

					if(sel_ipp_reqno_spv_upS == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "There is some error";
                                   } else if(sel_ipp_requester_spv_upS == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "There is some error";
                                   } else {
                                          $('#submit_approval_spvup').hide();
                                          $('#submit_approval_spvup2').show();
                                   }

					if(sel_ipp_reqno_spv_upS && sel_ipp_requester_spv_upS) {

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {
								if (response.code == 'success_message_approved_spv_up') {

                                                               $('#submit_approval_spvup').show();
                                                               $('#submit_approval_spvup2').hide();    
                                                               
                                                               mymodalss.style.display = "none";

                                                               // reload the datatables
                                                               datatable.ajax.reload(null,false);
                                                               // reload the datatables

                                                               $('#FormDisplayApproverSPVUP').modal('hide');
                                                      
                                                               $("[data-dismiss=modal]").trigger({type: "click"});

                                                               modals.style.display = "block";
                                                               document.getElementById("msg").innerHTML = response.messages;

                                                               
                                                               
                                                        } else {
                                                               $('#submit_approval_spvup').show();
                                                               $('#submit_approval_spvup2').hide();

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


















































function editdelMember(id = null) {
	if(id) {

		// remove the error 
		$(".form-group").removeClass('has-error').removeClass('has-success');
		$(".text-danger").remove();
		// empty the message div
		$(".edit-messages").html("");

		// remove the id
		$("#member_id").remove();

		// fetch the member data
		$.ajax({
			url: 'php_action/getSelectedEmployee.php',
			type: 'post',
			data: {member_id : id},
			dataType: 'json',
			success:function(response) {

				$("#sel_category_codeS").val(response.category_code);

				// mmeber id 
				$(".FormDisplayDelete").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');

				// here update the member data
				$("#updatedelMemberForm").unbind('submit').bind('submit', function() {
					// remove error messages
					$(".text-danger").remove();

					var form = $(this);

					// validation

					var sel_category_codeS = $("#sel_category_codeS").val();

					if(sel_category_codeS == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "category code cannot empty";
                                   } else {
                                          $('#submit_delete').hide();
                                          $('#submit_delete2').show();
                                   }


					if(sel_category_codeS) {
						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {
								if (response.code == 'success_message') {
                                                               modals.style.display = "block";
                                                               document.getElementById("msg").innerHTML = response.messages;

                                                               $('#submit_delete').show();
                                                               $('#submit_delete2').hide();                                                             

                                                               // reload the datatables
                                                               datatable.ajax.reload(null,false);
                                                               // reload the datatables

                                                               $('#FormDisplayDelete').modal('hide');  
                                                               $("[data-dismiss=modal]").trigger({type: "click"}); 
                                                               
                                                        } else {
                                                               modals.style.display = "block";
                                                               document.getElementById("msg").innerHTML = response.messages;
                                                               // reload the datatables

                                                               $('#submit_delete').show();
                                                               $('#submit_delete2').hide();         
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
</script>