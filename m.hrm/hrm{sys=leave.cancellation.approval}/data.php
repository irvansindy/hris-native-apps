<?php  
       $src_request_no                    = '';
       $src_request_status                = '';
       $code_print                        = '';
       if (!empty($_POST['src_request_no']) && !empty($_POST['src_request_status'])) {
              $src_request_no             = $_POST['src_request_no'];
              $src_request_status         = $_POST['src_request_status'];
              $frameworks                 = "src_request_no="."".$src_request_no."&src_request_status="."".$src_request_status."";
       } else if (empty($_POST['src_request_no']) && !empty($_POST['src_request_status'])) {
              $src_request_no             = $_POST['src_request_no'];
              $src_request_status         = $_POST['src_request_status'];
              $frameworks                 = "src_request_status="."".$src_request_status."";
       } else if (!empty($_POST['src_request_no']) && empty($_POST['src_request_status'])) {
              $src_request_no             = $_POST['src_request_no'];
              $src_request_status         = $_POST['src_request_status'];
              $frameworks                 = "src_request_no="."".$src_request_no."";
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
                                          <fieldset id="fset_1" style="margin-top: 25px;border-radius: 5px;border: 1px solid #e4e8ea;">
                                                 <legend>Searching</legend>
                                                 <div class="form-row">
                                                        <div class="col-4 name">Request No.</div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on" id="src_request_no"
                                                                             name="src_request_no" id="src_request_no" type="Text" value="<?php echo $src_request_no; ?>"
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
                                                                                    $sql = mysqli_query($connect,"SELECT code, name_en FROM hrmstatus WHERE code IN ('1','2','3','4','5','8') AND code NOT IN ('$src_request_status')");
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
              "ajax": "php_action/FuncDataRead.php<?php echo $getPackage; ?><?php echo $frameworks; ?>"
       });
});
</script>



















<div class="col-md-12">
       <div class="card">
              <div class="card-header d-flex align-items-center">
                     <h4 class="card-title mb-0"> Leave Cancellation Approval</h4>


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
                                          <div class="toolbar sprite-toolbar-reload" id="RELOAD" title="Reload"
                                                 onclick="RefreshPage();">
                                          </div>
                                   </td>
                                   <!-- AgusPrass 02/03/2021 -->
                                   
                            </table>
                     </div>
              </div>

              <div class="card-body table-responsive p-0" style="width: 100vw;height: 78vh; width: 99%; margin: 5px;overflow: scroll;">
                     <table id="datatable" width="100%" border="1"
                            class="table table-bordered table-striped table-hover table-head-fixed">
                            <thead>
                                                        <tr>
                                                               <th class="fontCustom" style="z-index: 1;"  nowrap="nowrap">No.</th>
                                                               <th class="fontCustom" style="z-index: 1;" >Request Number</th>
                                                               <th class="fontCustom" style="z-index: 1;" >Request For</th>
                                                               <th class="fontCustom" style="z-index: 1;" >Type of Leave</th>
                                                               <th class="fontCustom" style="z-index: 1;" >Req Date</th>
                                                               <th class="fontCustom" style="z-index: 1;" >Total Days</th>
                                                               <th class="fontCustom" style="z-index: 1;" >Remark</th>
                                                               <th class="fontCustom" style="z-index: 1;" >Request Status</th>
                                                               <th class="fontCustom" style="z-index: 1;" >Approval Status</th>
                                                        </tr>

                                                </thead>
                     </table>

              </div>
              <div class='card-footer' style='background-color: #eee;height: 37px;padding-top: 5px;'>
              </div>
       </div>
</div>



















































































<!-- add modal -->
<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="FormDisplayLeaveApproval">
              <div class="modal-dialog modal-belakang modal-bs modal-med" role="document">
              <div class="modal-content">
                     <div class="modal-header">
                            <h4 class="modal-title">Leave Approval Form</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

                     <form class="form-horizontal" action="php_action/FuncDataUpdate.php<?php echo $getPackage; ?>" method="POST" id="updatedelMemberForm">

                            <fieldset id="fset_1">
                                   <legend>&nbsp;Detail Information&nbsp;</legend>

                                   <div class="messages_create"></div>

                                   <input id="sel_emp_no_approver" name="sel_emp_no_approver" type="hidden" value="<?php echo $username; ?>"><!--FROM SESSION -->
                             
                                   <div class="form-row">
                                          <div class="col-sm-4 name"> Request No. <span class="required">*</span></div>
                                          <div class="col-sm-8 name">
                                          <div class="input-group" id="contoh" style="font-weight: bold;color: #5b5b5b;">
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

                                   <div class="form-row">
                                          <div class="col-sm-4 name"> Detail Leave <span class="required">*</span></div>
                                          <div class="col-sm-8 name">
                                                 <div class="input-group" id="sel_identity_leave_code" style="font-weight: bold;color: #5b5b5b;">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row" style="display:none">
                                          <div class="col-4 name"> APP Detail <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">
                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_approval_request_no" name="sel_approval_request_no"
                                                               type="Text">
                                                 </div>
                                          </div>
                                   </div>
                                   </fieldset>

                                   <fieldset id="fset_1">
                                   <legend>Approval Detail</legend>
                                                 <div class="card-body table-responsive p-0" style="width: 99%; margin: 1px;overflow: scroll;">
                                                        <!-- pages relation -->
                                                        <div id="box"></div>
                                                        <!-- pages relation -->
                                                 <div>
                                   </div>
                                   
                                   </fieldset>
                                 </div>
                            <!-- //LOAD BUTTON APPROVER STATUS -->
                            <div class="modal-footer" id="config-form0" style="display:none;">
                                   <mark id="attachment" style="margin-left: 6px;display:none;"><code >Please wait attachment from requester </code></mark>
                            </div>
     

                            <div class="modal-footer-sdk" id="config-form1" style="display:none">
                                          <a style="<?php echo $button_status_hide_or_no; ?>; color: white;padding-top: 8px;" class="btn-sdk btn-primary-not-only-left"  data-dismiss="modal"
                                                 aria-hidden="true">
                                                 &nbsp;&nbsp;Close&nbsp;&nbsp;
                                          </a>
                                       
                                          <button class="btn-sdk btn-primary-not-only-right" type="submit" name="submit_approval_spvdown" id="submit_approval_spvdown">
                                                 Approved
                                          </button>
                            </div>
                      
                            <div class="modal-footer-sdk" id="config-form2_0" style="display:none">


                                          <div type="reset" class="shine btn-sdk btn-primary-center-only" data-dismiss="modal"
                                                 aria-hidden="true">
                                                 &nbsp;Close&nbsp;
                                          </div>
                            </div>
                            <div class="modal-footer-sdk" id="config-form2_1" style="display:none">
                                          <button type="reset" class="btn-sdk btn-primary-center-only" data-dismiss="modal"
                                                 aria-hidden="true">
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
<div class="modal fade" tabindex="-1" role="dialog" id="FormDisplayRejectRequest">

       <div class="modals-content" style="margin-top: 125px;border: 1px solid #dbd2d2;background: #fbfbfb;">  
      
	   
		<form class="form-horizontal" action="php_action/FuncDataRejectRequest.php<?php echo $getPackage; ?>" method="POST" id="updaterejectMemberFormspvdown">	      

		<div class="modal-body">      	
		  <div class="edit-messages"></div>
                
                <input id="sel_emp_no_approver" name="sel_emp_no_approver" type="hidden" value="<?php echo $username; ?>"><!--FROM SESSION -->

		  <table width="100%">
                     <tr><td align="center"><img src="../../asset/dist/img/sf-mola-mola.png" style="max-width: 90%;margin-top: 20px;"></td></tr>
                     </table>
                            <div class="form-group">
                                   <div class="col-sm-12">	
                                          <table width="100%"><td align="center"><label id="isi_sel_reject_request">Are you sure to reject datas ?</label></td></table>		
                                          <input type="hidden" class="form-control input-report" id="sel_reject_request" name="sel_reject_request" placeholder="">
                                   </div>
                            </div>
				<div class="modal-footer-delete FormDisplayRejectRequest" style="text-align: center;padding-top: 20px;">
                                          <button onclick="CloseThis();" type="reset" class="btn btn-primary1" style="background: #ececec;" data-dismiss="modal" aria-hidden="true">
                                                        &nbsp;Cancel&nbsp;
                                          </button>
                                          <button class="btn btn-warning" type="submit" name="submit_reject_spvdown1" id="submit_reject_spvdown1">
                                                 Confirm
                                          </button>
                                          <button class="btn btn-warning" type="button" name="submit_reject_spvdown2"
                                                 id="submit_reject_spvdown2" style='display:none;' disabled>
                                                 <span class="spinner-grow spinner-grow-sm" role="status"
                                                        aria-hidden="true"></span>
                                                 &nbsp;&nbsp;Processing..
                                          </button>
					</div>
				</div>
	      </form>
	    </div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /edit modal -->



























































































<!-- delete transaction modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="FormDisplayRevisionRequest">
       <div class="modal-dialog modal-belakang modal-onmodals" role="document"  style="margin-top: 50px;">
              <div class="modal-content" style="border: 1px solid #b3b2b2;background: #f9f9f9">
                     <div class="modal-header">
                            <h4 class="modal-title">Revised Request No.</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <form class="form-horizontal" action="php_action/FuncDataRevisionRequest.php<?php echo $getPackage; ?>" method="POST" id="updaterevisionMemberFormspvdown">

                            <fieldset id="fset_1">
                                   <legend>Detail Revised</legend>

                                   <div class="messages_create"></div>

                                   <input id="inp_emp_no" name="inp_emp_no" type="hidden" value="<?php echo $username; ?>"><!--FROM SESSION -->
                                   <input id="inp_token" name="inp_token" type="hidden" value="<?php echo $get_token; ?>"><!--FROM CONFIGURATION -->

                                 

                                   <div class="form-row">
                                          <div class="col-sm-4 name">Request No. <span class="required">*</span></div>
                                          <div class="col-sm-8 name" id="isi_sel_revision_spvdown">
                                          </div>
                                   </div>
                                   <div class="form-row" style="display:none;">
                                          <div class="col-sm-4 name">Request No. <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_revision_spvdown" name="sel_revision_spvdown"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-sm-4 name">Remark Revised</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">
                                                        <textarea class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_revision_remark_spvdown" name="sel_revision_remark_spvdown"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title=""></textarea>
                                                 </div>
                                          </div>
                                   </div>
                                 


                            </fieldset>

                            <div class="modal-footer">
                                   <button type="reset" class="btn btn-primary1" data-dismiss="modal"
                                          aria-hidden="true">
                                          &nbsp;Cancel&nbsp;
                                   </button>
                                   <button class="btn btn-warning" type="submit" name="submit_revision_spvdown1" id="submit_revision_spvdown1">
                                          Revised
                                   </button>
                                   <button class="btn btn-warning" type="button" name="submit_revision_spvdown2"
                                          id="submit_revision_spvdown2" style='display:none;' disabled>
                                          <span class="spinner-grow spinner-grow-sm" role="status"
                                                 aria-hidden="true"></span>
                                          &nbsp;&nbsp;Processing..
                                   </button>
                            </div>      
                     </form>
              </div><!-- /.modal-content -->
       </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /edit modal -->



























































































<!-- delete transaction modal -->
<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="FormDisplayAttachmentRequest">
              <div class="modal-dialog modal-belakang modal-bs modal-med" role="document">
              <div class="modal-content">
                     <div class="modal-header">
                            <h4 class="modal-title">Attachment</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

                     <form class="form-horizontal" action="php_action/FuncDataUpdate.php<?php echo $getPackage; ?>" method="POST" id="updatedelMemberForm">

                       
                            <fieldset id="fset_1">
                                   <legend>Attachment</legend>
                                                 <div class="card-body table-responsive p-0" style="width: 99%; margin: 1px;overflow: scroll;">
                                                        <!-- pages relation -->
                                                        <div id="box_attachment"></div>
                                                        <!-- pages relation -->
                                                 <div>
                                   </div>
                            </fieldset>
                     </div>
                            <!-- //LOAD BUTTON APPROVER STATUS -->
                            <div class="modal-footer">
                                   <button type="reset" class="btn btn-primary1" style="background: #e1e1e1;" data-dismiss="modal"
                                          aria-hidden="true" data-backdrop="false">
                                          &nbsp;Cancel&nbsp;
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
<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="FormDisplayAttachmentPreviewRequest">
              <div class="modal-dialog modal-belakang modal-bs modal-bgkpi" role="document">
              <div class="modal-content">
                     <div class="modal-header">
                            <h4 class="modal-title">Preview Attachment</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: scroll;">

                     <form class="form-horizontal" action="php_action/FuncDataUpdate.php<?php echo $getPackage; ?>" method="POST" id="updatedelMemberForm">

                       
                            <fieldset id="fset_1">
                                   <legend>Attachment</legend>
                                                 <div class="card-body table-responsive p-0" style="width: 99%; margin: 1px;overflow: scroll;">
                                                        <!-- pages relation -->
                                                        <div id="box_attachment_preview"></div>
                                                        <!-- pages relation -->
                                                 <div>
                                   </div>
                            </fieldset>
                     </div>
                            <!-- //LOAD BUTTON APPROVER STATUS -->
                            <div class="modal-footer">
                                   <button type="reset" class="btn btn-primary1" style="background: #e1e1e1;" data-dismiss="modal"
                                          aria-hidden="true" data-backdrop="false">
                                          &nbsp;Cancel&nbsp;
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
function ApprovalSubmission(id = null) {

       mymodalss.style.display = "block";
       
	if(id) {
		$.ajax({
			url: 'php_action/getSelectedRequest.php<?php echo $getPackage; ?>',
			type: 'post',
			data: {member_id : id},
			dataType: 'json',
			success:function(response) {

                            document.getElementById("sel_identity_request_no").innerHTML = response.request_no;
                            document.getElementById("sel_identity_leave_code").innerHTML = response.leave_code + " ( Total Days : "+response.totaldays+") " + " Leave Date " + response.leave_startdates + " - " + response.leave_enddates;
                            document.getElementById("sel_identity_requester").innerHTML = response.Full_Name + " ("+response.emp_no+") "; 
                            
                            // document.getElementsByTagName("harusdiselipin").setAttribute("class", "democlass"); 
                            $("#submit_reject_spvdown").attr("onclick", "editreject_approval(`" + response.request_no + "`)");
                            $("#submit_revision_spvdown").attr("onclick", "editrevision_approval(`" + response.request_no + "`)");
                            // onclick="editrejectrequest(`PAREQ2022-130299`)"

				$("#sel_approval_request_no").val(response.request_no);
                            $("#sel_ipp_requester_spv_downS").val(response.requester);
                            // $("#sel_remark_from_approver").val(response.remark);

                            $("#box").load("pages_relation/_pages_approval.php<?php echo $getPackage; ?>rfid=" + response.request_no, 
                                   function(responseTxt, statusTxt, jqXHR){
                                          if(statusTxt == "success"){
                                                 $("#box").show();
                                          }
                                          if(statusTxt == "error"){
                                                 alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                          }
                                   }
                            );
                          
                            $('#config-form2_0').show();
                            $('#config-form2_1').hide();

                            $.ajax({
                                   url: 'php_action/getRequestStatus.php<?php echo $getPackage; ?>',
                                   type: 'post',
                                   data: {request_no_spvdown : response.request_no},
                                   dataType: 'json',
                                   success:function(response) {
                                                 
                                                 mymodalss.style.display = "none";

                                                 var fill_is_approved_spvdown = response.is_approved_spvdown;
                                                 var fill_is_ready = response.ready;
                                                 var fill_is_urgent_request = response.urg;
                                                 var fill_is_file_name = response.file_name;

                                                 // alert(fill_is_urgent_request);

                                                 if(fill_is_urgent_request == 'Y' && fill_is_file_name == '0') {
                                                        $('#config-form0').show();
                                                        $('#attachment').show();
                                                        $('#config-form1').hide();
                                                        $('#config-form2_0').hide();
                                                        $('#config-form2_1').hide();
                                                 } else if(fill_is_urgent_request == 'Y' && fill_is_file_name == '1') {

                                                        if(fill_is_approved_spvdown == '0') {
                                                               $('#config-form0').hide();
                                                               $('#attachment').hide();
                                                               $('#config-form1').hide();
                                                               $('#config-form2_0').hide();
                                                               $('#config-form2_1').show();
                                                        } else if (fill_is_ready == '0') {
                                                               $('#config-form0').hide();
                                                               $('#attachment').hide();
                                                               $('#config-form1').hide();
                                                               $('#config-form2_0').hide();
                                                               $('#config-form2_1').show();
                                                        } else {
                                                               $('#config-form0').hide();
                                                               $('#attachment').hide();
                                                               $('#config-form1').show();
                                                               $('#config-form2_0').hide();
                                                               $('#config-form2_1').hide();
                                                        }
                                                 }  else if(fill_is_urgent_request == 'N') {

                                                        if(fill_is_approved_spvdown == '0') {
                                                               $('#config-form0').hide();
                                                               $('#attachment').hide();
                                                               $('#config-form1').hide();
                                                               $('#config-form2_0').hide();
                                                               $('#config-form2_1').show();
                                                        } else if (fill_is_ready == '0') {
                                                               $('#config-form0').hide();
                                                               $('#attachment').hide();
                                                               $('#config-form1').hide();
                                                               $('#config-form2_0').hide();
                                                               $('#config-form2_1').show();
                                                        } else {
                                                               $('#config-form0').hide();
                                                               $('#attachment').hide();
                                                               $('#config-form1').show();
                                                               $('#config-form2_0').hide();
                                                               $('#config-form2_1').hide();
                                                        }
                                                 } 

                                              
                                          }
					}); // /ajax

				// mmeber id 
				$(".FormDisplayLeaveApproval").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');

				// here update the member data
				$("#updatedelMemberForm").unbind('submit').bind('submit', function() {
                                  
					// remove error messages
					$(".text-danger").remove();

					var form = $(this);

					// validation
					var sel_approval_request_no = $("#sel_approval_request_no").val();
                                   var sel_emp_no_approver = $("#sel_emp_no_approver").val();

					if(sel_approval_request_no == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "There is some error";
                                   } else if(sel_emp_no_approver == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "There is some error";
                                   } else {
                                          $('#submit_approval_spvdown').hide();
                                          $('#submit_approval_spvdown2').show();
                                          mymodalss.style.display = "block";
                                   }

					if(sel_approval_request_no && sel_emp_no_approver) {


						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {
								if (response.code == 'success_message') {

                         
                                                               
                                                               mymodalss.style.display = "none";

                                                               // reload the datatables
                                                               datatable.ajax.reload(null,false);
                                                               // reload the datatables

                                                               $('#FormDisplayLeaveApproval').modal('hide');
                                                      
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









































  
                     
                            
                                   
                                
                                   
                                 
               
                   
            



// editreject_approval
function editreject_approval(id = null) {

       mymodalss.style.display = "block";

	if(id) {
		// fetch the member data
		$.ajax({
			url: 'php_action/getSelectedRequest.php<?php echo $getPackage; ?>',
			type: 'post',
			data: {member_id : id},
			dataType: 'json',
			success:function(response) {

                            mymodalss.style.display = "none";

                            document.getElementById("isi_sel_reject_request").innerHTML = "Are you sure to reject request "+response.request_no+ " ?";

				$("#sel_reject_request").val(response.request_no);

				// mmeber id 
				$(".FormDisplayRejectRequest").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');

				// here update the member data
				$("#updaterejectMemberFormspvdown").unbind('submit').bind('submit', function() {

					var form = $(this);

					// validation
					var sel_reject_request = $("#sel_reject_request").val();
           
					if(sel_reject_request == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "There is some error";
                                   } else {
                                          $('#submit_reject_spvdown1').hide();
                                          $('#submit_reject_spvdown2').show();
                                          mymodalss.style.display = "block";
                                   }


					if(sel_reject_request) {

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {
								if (response.code == 'success_message_reject_request') {

                                                               $('#submit_reject_spvdown1').show();
                                                               $('#submit_reject_spvdown2').hide();                                      

                                                               // reload the datatables
                                                               datatable.ajax.reload(null,false);
                                                               // reload the datatables

                                                               $('#FormDisplayRejectRequest').hide();  
                                                               $('#FormDisplayLeaveApproval').modal('hide');
                                                               
                                                               $("[data-dismiss=modal]").trigger({type: "click"});

                                                               mymodalss.style.display = "none";
                                                               modals.style.display = "block";
                                                               document.getElementById("msg").innerHTML = response.messages;
                                                               
                                                        } else {
                                                               // reload the datatables

                                                               $('#submit_reject_spvdown1').show();
                                                               $('#submit_reject_spvdown2').hide();         

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

























  
                     
                            
                                   
                                
                                   
                                 
               
                   
            






















  
                     
                            
                                   
                                
                                   
                                 
               
                   
            






function editrevision_approval(id = null) {
	if(id) {
		// fetch the member data
              mymodalss.style.display = "block";

		$.ajax({
			url: 'php_action/getSelectedRequest.php<?php echo $getPackage; ?>',
			type: 'post',
			data: {member_id : id},
			dataType: 'json',
			success:function(response) {

                            mymodalss.style.display = "none";

				$("#sel_revision_spvdown").val(response.request_no); 
                            document.getElementById("isi_sel_revision_spvdown").innerHTML = response.request_no;

				// mmeber id 
				$(".FormDisplayrevisionPVDOWN").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');

				// here update the member data
				$("#updaterevisionMemberFormspvdown").unbind('submit').bind('submit', function() {
                                                                     
					var form = $(this);

					// validation
					var sel_revision_spvdown = $("#sel_revision_spvdown").val();
                                   var sel_revision_remark_spvdown = $("#sel_revision_remark_spvdown").val();
                                   
					if(sel_revision_spvdown == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "There is some error";
                                   } else if(sel_revision_remark_spvdown == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "Revised remark cannot empty";
                                   } else {
                                          $('#submit_revision_spvdown1').hide();
                                          $('#submit_revision_spvdown2').show();
                                          mymodalss.style.display = "block";
                                   }


					if(sel_approval_request_no && sel_revision_remark_spvdown) {


						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {
								if (response.code == 'success_message_revision_request') {

                                                               $('#submit_revision_spvdown1').show();
                                                               $('#submit_revision_spvdown2').hide();                                                             

                                                               // reload the datatables
                                                               datatable.ajax.reload(null,false);
                                                               // reload the datatables

                                                               $('#FormDisplayrevisionspvup').hide();  
                                                               $('#FormDisplayLeaveApproval').modal('hide');
                                                               
                                                               $("[data-dismiss=modal]").trigger({type: "click"});

                                                               mymodalss.style.display = "none";
                                                               modals.style.display = "block";
                                                               document.getElementById("msg").innerHTML = response.messages;
                                                        } else {

                                                               $('#submit_revision_spvdown1').show();
                                                               $('#submit_revision_spvdown2').hide();         

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

























  
                     
                            
                                   
                                
                                   
                                 
               
                   
            






















  
                     
                            
                                   
                                
                                   
                                 
               
                   
            






function Attachment(id = null) {
	if(id) {
		// fetch the member data
              mymodalss.style.display = "block";

		$.ajax({
			url: 'php_action/getAttachment.php<?php echo $getPackage; ?>',
			type: 'post',
			data: {member_id : id},
			dataType: 'json',
			success:function(response) {

                            mymodalss.style.display = "none";

				// mmeber id 
				$(".FormDisplayrevisionPVDOWN").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');

                            $("#box_attachment").load("pages_relation/_pages_attachment.php<?php echo $getPackage; ?>rfid=" + response.request_no, 
                                   function(responseTxt, statusTxt, jqXHR){
                                          if(statusTxt == "success"){
                                                 $("#box_attachment").show();
                                          }
                                          if(statusTxt == "error"){
                                                 alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                          }
                                   }
                            );

				// here update the member data
				$("#updaterevisionMemberFormspvdown").unbind('submit').bind('submit', function() {
                                                                     
					var form = $(this);

					// validation
					var sel_revision_spvdown = $("#sel_revision_spvdown").val();
                                   var sel_revision_remark_spvdown = $("#sel_revision_remark_spvdown").val();
                                   
					if(sel_revision_spvdown == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "There is some error";
                                   } else if(sel_revision_remark_spvdown == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "Revised remark cannot empty";
                                   } else {
                                          $('#submit_revision_spvdown1').hide();
                                          $('#submit_revision_spvdown2').show();
                                          mymodalss.style.display = "block";
                                   }
					return false;
				});

			} // /success
		}); // /fetch selected member info

	} else {
		alert("Error : Refresh the page again");
	}
}


function PreviewAttachment(id = null) {
	if(id) {
		// fetch the member data
              mymodalss.style.display = "block";

		$.ajax({
			url: 'php_action/getAttachment.php<?php echo $getPackage; ?>',
			type: 'post',
			data: {member_id : id},
			dataType: 'json',
			success:function(response) {

                            mymodalss.style.display = "none";
                            
				// mmeber id 
				$(".FormDisplayrevisionPVDOWN").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');

                            $("#box_attachment_preview").load("pages_relation/_pages_attachment_preview.php<?php echo $getPackage; ?>rfid=" + response.file_name, 
                                   function(responseTxt, statusTxt, jqXHR){
                                          if(statusTxt == "success"){
                                                 $("#box_attachment_preview").show();
                                          }
                                          if(statusTxt == "error"){
                                                 alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                          }
                                   }
                            );

				// here update the member data
				$("#updaterevisionMemberFormspvdown").unbind('submit').bind('submit', function() {
                                                                     
					var form = $(this);

					// validation
					var sel_revision_spvdown = $("#sel_revision_spvdown").val();
                                   var sel_revision_remark_spvdown = $("#sel_revision_remark_spvdown").val();
                                   
					if(sel_revision_spvdown == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "There is some error";
                                   } else if(sel_revision_remark_spvdown == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "Revised remark cannot empty";
                                   } else {
                                          $('#submit_revision_spvdown1').hide();
                                          $('#submit_revision_spvdown2').show();
                                          mymodalss.style.display = "block";
                                   }
					return false;
				});

			} // /success
		}); // /fetch selected member info

	} else {
		alert("Error : Refresh the page again");
	}
}







// 

















  
                     
                            
                                   
                                
                                   
                                 
               
                   
            






























































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