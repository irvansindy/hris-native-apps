<?php  
       $src_kpi_no                        = '';
       $src_employee_no                   = '';
       $src_request_status                = '';
       $code_print                        = '';
       if (!empty($_POST['src_kpi_no']) && !empty($_POST['src_employee_no']) && !empty($_POST['src_request_status'])) {
              $src_kpi_no                 = $_POST['src_kpi_no'];
              $src_employee_no            = $_POST['src_employee_no'];
              $src_request_status         = $_POST['src_request_status'];
              $frameworks                 = "?src_kpi_no="."".$src_kpi_no."&src_employee_no="."".$src_employee_no."&src_request_status="."".$src_request_status."";
       } else if (empty($_POST['src_kpi_no']) && empty($_POST['src_employee_no']) && !empty($_POST['src_request_status'])) {
              $src_kpi_no                 = $_POST['src_kpi_no'];
              $src_employee_no            = $_POST['src_employee_no'];
              $src_request_status         = $_POST['src_request_status'];
              $frameworks                 = "?src_request_status="."".$src_request_status."";
       } else if (empty($_POST['src_kpi_no']) && !empty($_POST['src_employee_no']) && empty($_POST['src_request_status'])) {
              $src_kpi_no                 = $_POST['src_kpi_no'];
              $src_employee_no            = $_POST['src_employee_no'];
              $src_request_status         = $_POST['src_request_status'];
              $frameworks                 = "?src_employee_no="."".$src_employee_no."";
       } else if (!empty($_POST['src_kpi_no']) && empty($_POST['src_employee_no']) && empty($_POST['src_request_status'])) {
              $src_kpi_no                 = $_POST['src_kpi_no'];
              $src_employee_no            = $_POST['src_employee_no'];
              $src_request_status         = $_POST['src_request_status'];
              $frameworks                 = "?src_kpi_no="."".$src_kpi_no."";
       } else if (empty($_POST['src_kpi_no']) && !empty($_POST['src_employee_no']) && !empty($_POST['src_request_status'])) {
              $src_kpi_no                 = $_POST['src_kpi_no'];
              $src_employee_no            = $_POST['src_employee_no'];
              $src_request_status         = $_POST['src_request_status'];
              $frameworks                 = "?src_employee_no="."".$src_employee_no."&src_request_status="."".$src_request_status."";
       } else if (!empty($_POST['src_kpi_no']) && !empty($_POST['src_employee_no']) && empty($_POST['src_request_status'])) {
              $src_kpi_no                 = $_POST['src_kpi_no'];
              $src_employee_no            = $_POST['src_employee_no'];
              $src_request_status         = $_POST['src_request_status'];
              $frameworks                 = "?src_kpi_no="."".$src_kpi_no."&src_employee_no="."".$src_employee_no."";
       } else if (!empty($_POST['src_kpi_no']) && empty($_POST['src_employee_no']) && !empty($_POST['src_request_status'])) {
              $src_kpi_no                 = $_POST['src_kpi_no'];
              $src_employee_no            = $_POST['src_employee_no'];
              $src_request_status         = $_POST['src_request_status'];
              $frameworks                 = "?src_kpi_no="."".$src_kpi_no."&src_request_status="."".$src_request_status."";
       } else {
              $frameworks                 = "";
       }
       if(!empty($_POST['src_request_status'])) {
              $code = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM hrmstatus WHERE code = '$src_request_status'"));
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
                                                        <div class="col-4 name">Request Status </div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">

                                                                      <select id="src_request_status" class="input--style-6"
                                                                             name="src_request_status" onfocus="hlentry(this)"
                                                                             onchange="formodified(this);"
                                                                             style="width:undefined;border: 1px solid #cac2c2;color: #484545; height:33px">
                                                                             <option value="<?php echo $src_request_status; ?>"><?php echo $code_print; ?></option>
                                                                             <?php
                                                                                    $sql = mysqli_query($connect,"SELECT code, name_en FROM hrmstatus WHERE code IN ('0','1','2','3','4','5','8','10')");
                                                                                    while($row=mysqli_fetch_array($sql))
                                                                                    {
                                                                                    echo '<option value="'.$row['code'].'">'.$row['name_en'].'</option>';
                                                                                    } 
                                                                             ?>
                                                                      </select>

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
                     <h4 class="card-title mb-0"> Performance Appraisal</h4>
                     <div class="card-actions ml-auto">
                            <table>
                                   <!-- <td>
                                          <form action="../rfid=repository/cli_Template_Download/st/StFunctionDownload.php" method="GET">
                                                 <input type="hidden" name="filedata" value="StDownloadGTTGROndtAllowanceItemData.php">
                                                 <input type="hidden" name="filename" value="OndtAllowanceItem">
                                                 <input type="hidden" name="src_ip_period" value="<php echo $src_ip_period; ?>">
                                                 <input type="hidden" name="src_ipp_reqno" value="<php echo $src_ipp_reqno; ?>">
                                                 <button type="submit" class="toolbar sprite-toolbar-excel" id="EXCEL" style="border: 0;background-color: white;" name="submit_approve" value="submit"></button>
                                          </form>
                                   </td> -->
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
                                                 style="z-index:1;vertical-align: ce;vertical-align: middle;">Appraisal statuss&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          </th>
                                          <!-- <th class="fontCustom"
                                                 style="z-index:1;vertical-align: ce;vertical-align: middle;">Request status&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          </th> -->
                                          <th class="fontCustom"
                                                 style="z-index: 1;vertical-align: ce;vertical-align: middle;">
                                                 Action&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          </th>
                                   </tr>
                            </thead>
                     </table>

              </div>
              <div class='card-footer' style='background-color: #eee;height: 37px;padding-top: 5px;'>
              </div>
       </div>
</div>
























<!-- add modal -->
<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="FormDisplayAppraisalSPVDOWN">
              <div class="modal-dialog modal-belakang modal-bs modal-bgkpi" role="document">
              <div class="modal-content">
                     <div class="modal-header">
                            <h4 class="modal-title">Individual Performance Appraisal Request</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

                     <form class="form-horizontal" action="php_action/FuncDataCreate.php" method="POST" id="updatedelMemberForm" onkeydown="return event.key != 'Enter';">

                            <fieldset id="fset_1">
                                   <legend>&nbsp;Employee Information&nbsp;</legend>

                                   <div class="messages_create"></div>

                                   <input id="sel_emp_no_approver" name="sel_emp_no_approver" type="hidden" value="<?php echo $username; ?>"><!--FROM SESSION -->
                             
                                   <div class="form-row">
                                          <div class="col-4 name"> Perormance Period <span class="required">*</span></div>
                                          <div class="col-sm-8 name">
                                                 <div class="input-group" id="sel_identity_pa_reqno" style="font-weight: bold;color: #5b5b5b;">
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
                                                               id="sel_ipp_reqno_spv_downS" name="sel_ipp_reqno_spv_downS"
                                                               type="Text">
                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_ipp_requester_spv_downS" name="sel_ipp_requester_spv_downS"
                                                               type="Text">

                                                 </div>
                                          </div>
                                   </div>
                                   </fieldset>

                                   <fieldset id="fset_1">
                                   <legend>KPI Detail</legend>
                                                 <div class="card-body table-responsive p-0" style="height:300px; width: 100%; margin: 1px;overflow: scroll;">
                                                        <!-- pages relation -->
                                                        <div id="box"></div>
                                                        <!-- pages relation -->
                                                 <div>
                                   </div>
                            </fieldset>


                            <fieldset id="fset_1">
                                   <legend>Remark </legend>
                                   <div class="card-body table-responsive p-0" style="width: 100%; height: 130px; margin: 1px;overflow: scroll;">
                                          <table class="table table-bordered table-hover table-head-fixed">
                                                 <thead>
                                                        <tr>
                                                               <th>Remark.</th> 
                                                        </tr>
                                                 </thead>
                                                 <tbody>
                                                        <tr id="recs-1" style="background: #eee;border: 1px solid #0869bd;">
                                                               <td>
                                                                      <textarea name="sel_remark_from_approver_spv_down" id="sel_remark_from_approver_spv_down" class="form-control"></textarea>
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




























<!-- add modal -->
<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="FormDisplayAppraisalSPVUP">
              <div class="modal-dialog modal-belakang modal-bs modal-bgkpi" role="document">
              <div class="modal-content">
                     <div class="modal-header">
                            <h4 class="modal-title">Individual Performance Appraisal Request SPV UP</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

                     <form class="form-horizontal" action="php_action/FuncDataCreateSPVUP.php" method="POST" id="updateApproveSPVUPMemberForm" onkeydown="return event.key != 'Enter';">

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
                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_ipp_revno_spv_upS" name="sel_ipp_revno_spv_upS"
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


                            <fieldset id="fset_1" style="display:none;">
                                   <legend>Remark </legend>
                                   <div class="card-body table-responsive p-0" style="width: 100%; height: 130px; margin: 1px;overflow: scroll;">
                                          <table class="table table-bordered table-hover table-head-fixed">
                                                 <thead>
                                                        <tr>
                                                               <th>Remark.</th> 
                                                        </tr>
                                                 </thead>
                                                 <tbody>
                                                        <tr id="recs-1" style="background: #eee;border: 1px solid #0869bd;">
                                                               <td>
                                                                      <textarea name="sel_remark_from_approver_spv_up" id="sel_remark_from_approver_spv_up" class="form-control"></textarea>
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
                                    <button class="btn btn-warning" type="submit" name="submit_approval_spvup" id="submit_approval_spvup">
                                          Submit
                                   </button>
                                   <button class="btn btn-warning" type="button" name="submit_approval_spvup2"
                                          id="submit_approval_spvup2" style='display:none;' disabled>
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
function EditAppraisalMemberSPVDOWN(id = null) {

       mymodalss.style.display = "block";
       
	if(id) {

		$.ajax({
			url: 'php_action/getSelectedEmployee.php',
			type: 'post',
			data: {member_id : id},
			dataType: 'json',
			success:function(response) {

                            document.getElementById("sel_identity_pa_reqno").innerHTML = response.pa_reqno;
                            document.getElementById("sel_remark_from_approver_spv_down").innerHTML = response.remark;
                            document.getElementById("sel_identity_requester").innerHTML = response.Full_Name + " ("+response.requester+") "; 

                            
                            
                            // document.getElementsByTagName("harusdiselipin").setAttribute("class", "democlass"); 
                            $("#submit_reject_spvdown").attr("onclick", "editreject_spvdown_request(`" + response.pa_reqno + "`)");
                            $("#submit_revision_spvdown").attr("onclick", "editrevision_spvdown_request(`" + response.pa_reqno + "`)");
                            // onclick="editrejectrequest(`PAREQ2022-130299`)"

				$("#sel_ipp_reqno_spv_downS").val(response.pa_reqno);
                            $("#sel_ipp_requester_spv_downS").val(response.requester);
                            // $("#sel_remark_from_approver").val(response.remark);

                            $("#box").load("pages_relation/_pages_approval_spvdown.php?rfid=" + response.pa_reqno, 
                                   function(responseTxt, statusTxt, jqXHR){
                                          if(statusTxt == "success"){
                                                 $("#box").show();
                                          }
                                          if(statusTxt == "error"){
                                                 alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                          }
                                   }
                            );

                            $.ajax({
                                   url: 'php_action/getRequestStatus.php',
                                   type: 'post',
                                   data: {request_no_spvdown : response.pa_reqno},
                                   dataType: 'json',
                                   success:function(response) {
                                                 
                                                 mymodalss.style.display = "none";

                                                 var fill_is_approved_spvdown = response.is_approved_spvdown;

                                                 if(fill_is_approved_spvdown == '0'){ //jika sudah approve request
                                                        document.getElementById("submit_approval_spvdown").style.display = "none";
                                                 } else {
                                                        document.getElementById("submit_approval_spvdown").style.display = "block";
                                                 }
                                          }
				}); // /ajax

                            mymodalss.style.display = "none";                                   

				// mmeber id 
				$(".FormDisplayAppraisalSPVDOWN").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');

				// here update the member data
				$("#updatedelMemberForm").unbind('submit').bind('submit', function() {

                                   mymodalss.style.display = "block";
                                  
					// remove error messages
					$(".text-danger").remove();

					var form = $(this);

					// validation
					var sel_emp_no_approver            = $("#sel_emp_no_approver").val();
                                   var sel_ipp_reqno_spv_downS        = $("#sel_ipp_reqno_spv_downS").val();
                                   var sel_ipp_requester_spv_downS    = $("#sel_ipp_requester_spv_downS").val();


					if(sel_emp_no_approver == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "There is some error";
                                   } else if(sel_ipp_reqno_spv_downS == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "There is some error";
                                   } else if(sel_ipp_requester_spv_downS == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "There is some error";
                                   } else {
                                          $('#submit_approval_spvdown').hide();
                                          $('#submit_approval_spvdown2').show();
                                   }

					if(sel_emp_no_approver && sel_ipp_reqno_spv_downS && sel_ipp_requester_spv_downS) {
						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {
								if (response.code == 'success_appraised_spvdown') {

                                                               $('#submit_approval_spvdown').show();
                                                               $('#submit_approval_spvdown2').hide();    
                                                               
                                                               mymodalss.style.display = "none";
                                                               // reload the datatables
                                                               datatable.ajax.reload(null,false);
                                                               // reload the datatables

                                                               $('#FormDisplayAppraisalSPVDOWN').modal('hide');
                                                      
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





































function EditAppraisalMemberSPVUP(id = null) {

       mymodalss.style.display = "block";
       
	if(id) {

		$.ajax({
			url: 'php_action/getSelectedEmployeeSPVUP.php',
			type: 'post',
			data: {member_id : id},
			dataType: 'json',
			success:function(response) {

                            document.getElementById("sel_identity_spvup_pa_reqno").innerHTML = response.ipp_reqno;
                            document.getElementById("sel_remark_from_approver_spv_up").innerHTML = response.remarks;
                            document.getElementById("sel_identity_spvup_requester").innerHTML = response.Full_Name + " ("+response.requester+") "; 
                            
                            // document.getElementsByTagName("harusdiselipin").setAttribute("class", "democlass"); 
                            $("#submit_reject_spvup").attr("onclick", "editreject_spvup_request(`" + response.ipp_reqno + "`)");
                            $("#submit_revision_spvup").attr("onclick", "editrevision_spvup_request(`" + response.ipp_reqno + "`)");
                            // onclick="editrejectrequest(`PAREQ2022-130299`)"

				$("#sel_ipp_reqno_spv_upS").val(response.ipp_reqno); 
                            $("#sel_ipp_revno_spv_upS").val(response.revno); 
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

                                                 if(fill_is_approved_spvup == "0"){ //jika sudah approve request
                                                        document.getElementById("submit_approval_spvup").style.display = "none";
                                                 } else {
                                                        document.getElementById("submit_approval_spvup").style.display = "block";
                                                 }
                                          }
				}); // /ajax

				// mmeber id 
				$(".FormDisplayAppraisalSPVUP").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');

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
								if (response.code == 'success_appraised_spvup') {

                                                               $('#submit_approval_spvup').show();
                                                               $('#submit_approval_spvup2').hide();    
                                                               
                                                               mymodalss.style.display = "none";

                                                               // reload the datatables
                                                               datatable.ajax.reload(null,false);
                                                               // reload the datatables

                                                               $('#FormDisplayAppraisalSPVUP').modal('hide');
                                                      
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

</script>




<script type="text/javascript">
$(document).ready(function() {
       jQuery(document).delegate('a.add-record_spvup_appraisal_one', 'click', function(e) {
              e.preventDefault();
              var content = jQuery('#sample_table_spvup_appraisal_one tr'),
              size = jQuery('#tbl_posts_spvup_appraisal_one >tbody >tr').length + 1,
              element = null,
              element = content.clone();
              element.attr('id', 'recspvup_appraisal_one-' + size);
              element.find('.delete-record_spvup_appraisal_one').attr('data-id', size);
              element.appendTo('#tbl_posts_body_spvup_appraisal_one');
              element.find('.sn').html(size);
       });

       jQuery(document).delegate('a.delete-record_spvup_appraisal_one_parent', 'click', function(e) {e.preventDefault();

              var id = jQuery(this).attr('data-id');
              var targetDiv = jQuery(this).attr('targetDiv');
              jQuery('#recspvup_appraisal_one-' + id).remove();

                     //regnerate index number on table
              $('#tbl_posts_body_spvup_appraisal_one tr').each(function(index) {
                     $(this).find('span.sn').html(index + 1);
              });
              return true;
              
       });

       jQuery(document).delegate('a.delete-record_spvup_appraisal_one', 'click', function(e) {e.preventDefault();
              var id = jQuery(this).attr('data-id');
              var targetDiv = jQuery(this).attr('targetDiv');
              jQuery('#recspvup_appraisal_one-' + id).remove();

                     //regnerate index number on table
              $('#tbl_posts_body_spvup_appraisal_one tr').each(function(index) {
                     $(this).find('span.sn').html(index + 1);
              });
              return true;
              
       });
});
</script>

<script>
jQuery(function($) {
       $("#nip").mask("99-9999");
       $("#nik").mask("9999999999999999");
       $("#join").mask("9999-99-99");
       $("#date").mask("9999-99-99");
       $("#account").mask("9999-9-99999-9");
});
</script>
