<?php  
       $src_emp_no                 = '';
       $src_cost_code              = '';
       $src_status                 = '';
       $src_emp_name               = '';
       if (!empty($_POST['src_emp_no']) && !empty($_POST['src_emp_name']) && !empty($_POST['src_cost_code'])) {
              $src_emp_no          = $_POST['src_emp_no'];
              $src_emp_name        = $_POST['src_emp_name'];
              $src_cost_code       = $_POST['src_cost_code'];
              $src_status          = $_POST['src_status'];
              $frameworks          = "?src_emp_no="."".$src_emp_no."&&src_emp_name="."".$src_emp_name."&&src_cost_code="."".$src_cost_code."&&src_status="."".$src_status."";
       } else if (empty($_POST['src_emp_no']) && !empty($_POST['src_emp_name']) && empty($_POST['src_cost_code'])) {
              $src_emp_no          = $_POST['src_emp_no'];
              $src_emp_name        = $_POST['src_emp_name'];
              $src_cost_code       = $_POST['src_cost_code'];
              $src_status          = $_POST['src_status'];
              $frameworks          = "?src_emp_name="."".$src_emp_name."&&src_status="."".$src_status."";
       } else if (empty($_POST['src_emp_no']) && empty($_POST['src_emp_name']) && !empty($_POST['src_cost_code'])) {
              $src_emp_no          = $_POST['src_emp_no'];
              $src_emp_name        = $_POST['src_emp_name'];
              $src_cost_code       = $_POST['src_cost_code'];
              $src_status          = $_POST['src_status'];
              $frameworks          = "?src_cost_code="."".$src_cost_code."&&src_status="."".$src_status."";
       } else if (!empty($_POST['src_emp_no']) && empty($_POST['src_emp_name']) && empty($_POST['src_cost_code'])) {
              $src_emp_no          = $_POST['src_emp_no'];
              $src_emp_name        = $_POST['src_emp_name'];
              $src_cost_code       = $_POST['src_cost_code'];
              $src_status          = $_POST['src_status'];
              $frameworks          = "?src_emp_no="."".$src_emp_no."&&src_status="."".$src_status."";
       } else if (!empty($_POST['src_emp_no']) && empty($_POST['src_emp_name']) && !empty($_POST['src_cost_code'])) {
              $src_emp_no          = $_POST['src_emp_no'];
              $src_emp_name        = $_POST['src_emp_name'];
              $src_cost_code       = $_POST['src_cost_code'];
              $src_status          = $_POST['src_status'];
              $frameworks          = "?src_emp_no="."".$src_emp_no."&&src_cost_code="."".$src_cost_code."&&src_status="."".$src_status."";
       } else if (!empty($_POST['src_emp_no']) && !empty($_POST['src_emp_name']) && empty($_POST['src_cost_code'])) {
              $src_emp_no          = $_POST['src_emp_no'];
              $src_emp_name        = $_POST['src_emp_name'];
              $src_cost_code       = $_POST['src_cost_code'];
              $src_status          = $_POST['src_status'];
              $frameworks          = "?src_emp_no="."".$src_emp_no."&&src_emp_name="."".$src_emp_name."&&src_status="."".$src_status."";
       } else if (empty($_POST['src_emp_no']) && !empty($_POST['src_emp_name']) && !empty($_POST['src_cost_code'])) {
              $src_emp_no          = $_POST['src_emp_no'];
              $src_emp_name        = $_POST['src_emp_name'];
              $src_cost_code       = $_POST['src_cost_code'];
              $src_status          = $_POST['src_status'];
              $frameworks          = "?src_emp_name="."".$src_emp_name."&&src_status="."".$src_status."&&src_cost_code="."".$src_cost_code."";
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
                                                        <div class="col-4 name">Employee No.</div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on" id="src_emp_no"
                                                                             name="src_emp_no" id="src_emp_no" type="Text" value="<?php echo $src_emp_no; ?>"
                                                                             onfocus="hlentry(this)" size="30" maxlength="50" 
                                                                             validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title="">
                                                               </div>
                                                        </div>
                                                 </div>

                                                 <div class="form-row">
                                                        <div class="col-4 name">Employee Name</div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on" id="src_emp_no"
                                                                             name="src_emp_name" id="src_emp_name" type="Text" value="<?php echo $src_emp_name; ?>"
                                                                             onfocus="hlentry(this)" size="30" maxlength="50" 
                                                                             validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title="">
                                                               </div>
                                                        </div>
                                                 </div>

                                                 <div class="form-row" style="display:none;">
                                                        <div class="col-4 name">Cost Code</div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on"
                                                                             name="src_cost_code" id="src_cost_code" type="Text" value="<?php echo $src_cost_code; ?>"
                                                                             onfocus="hlentry(this)" size="30" maxlength="50" 
                                                                             validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title="">
                                                               </div>
                                                        </div>
                                                 </div>

                                                 <div class="form-row">
                                                        <div class="col-4 name">Status</div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">
                                                                      <select name="src_status" id="src_status" class="input--style-6" style="width:undefined;border: 1px solid #cac2c2;color: #484545; height:33px" onfocus="hlentry(this)" onchange="formodified(this);" style="width:undefined"><option value="Active">Active</option><option value="Inactive">Inactive</option><option value="All">All</option></select>
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
<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>

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




<div class="col-md-12">
       <div class="card">
              <div class="card-header d-flex align-items-center">
                     <h4 class="card-title mb-0">Employee Shift Group </h4>


                     <div class="card-actions ml-auto">
                            <table>
<!-- 
                                   <td>
                                          <form action="../rfid=repository/cli_Template_Download/st/StFunctionDownload.php" method="GET">
                                                 <input type="hidden" name="filedata" value="StDownloadGTTGROvertimeSettingData.php">
                                                 <input type="hidden" name="filename" value="Employee Shift Group">
                                                 <input type="hidden" name="src_emp_no" value="<php echo $src_emp_no; ?>">
                                                 <input type="hidden" name="src_cost_code" value="<php echo $src_cost_code; ?>">
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

                                   <!-- <td>
                                          <div class="toolbar sprite-toolbar-add" title="Add" data-toggle="modal"
                                                 data-target="#CreateForm" id="CreateButton" data-keyboard="false"
                                                 data-backdrop="static">
                                                  <a title="add" href="" class="toolbar sprite-toolbar-add" data-toggle="modal" data-target="#CreateForm" id="CreateButton" data-keyboard="false" data-backdrop="static">tambah</a> 
                                          </div>
                                   </td> -->

                            </table>

                          

                     </div>
              </div>

              <div class="card-body table-responsive p-0"
                     style="width: 100vw;height: 78vh; width: 99.1%; margin: 5px;overflow: scroll;">
                     <table id="datatable" width="100%" border="1" align="left"
                            class="table table-bordered table-striped table-hover table-head-fixed">
                            <thead>
                                   <tr>
                                          <th nowrap="" class="fontCustom"
                                                 style="z-index: 1;vertical-align: ce;vertical-align: middle;"
                                                 nowrap="nowrap">No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                          <th nowrap="" class="fontCustom"
                                                 style="z-index: 1;vertical-align: ce;vertical-align: middle;">
                                                 Employee No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                          <th nowrap="" class="fontCustom"
                                                 style="z-index: 1;vertical-align: ce;vertical-align: middle;">Employee Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          </th>
                                          <th nowrap="" class="fontCustom"
                                                 style="z-index: 1;vertical-align: ce;vertical-align: middle;">Position&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          </th>
                                          <!-- <th class="fontCustom"
                                                 style="z-index: 1;vertical-align: ce;vertical-align: middle;">Overtime
                                                 Rounding (Minutes)</th>
                                          <th class="fontCustom"
                                                 style="z-index: 1;vertical-align: ce;vertical-align: middle;">Overtime
                                                 Round Limit (Minutes)
                                          </th>
                                          <th class="fontCustom"
                                                 style="z-index: 1;vertical-align: ce;vertical-align: middle;">Factor
                                                 Setting
                                          </th> -->
                                          <!-- <th class="fontCustom"
                                                 style="z-index: 1;vertical-align: ce;vertical-align: middle;">
                                                 Action
                                          </th> -->
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




















































<!-- edit modal -->
<div class="modal  fade fade-custom" tabindex="-1" role="dialog" id="UpdateForm">
       <div class="modal-dialog modal-belakang modal-bg" role="document">

              <div class="modal-content">
                     <div class="modal-header">
                            <h4 class="modal-title">Edit Employee Shift Group</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 99%; margin: 5px;overflow: scroll;overflow-x: hidden;">

                     <!-- <form class="form-horizontal" action="php_action/FuncDataUpdate.php" method="POST" id="updateMemberForm"> -->
                     <form class="form-horizontal" action="php_action/FuncDataUpdate.php" method="POST" id="FormDisplayUpdate">

                            <fieldset id="fset_1">
                                   <legend>General</legend>
                                   

                                   <div class="messages_update"></div>

                                   <input id="sel_username" name="sel_username" type="hidden" value="<?php echo $username; ?>"><!--FROM SESSION -->
                                   <input id="sel_token" name="sel_token" type="hidden" value="<?php echo $get_token; ?>"><!--FROM CONFIGURATION -->

                                   <div class="form-row">
                                          <div class="col-4 name"> Emp No <span class="required">*</span></div>
                                          <div class="col-sm-8 name">
                                                 <div class="input-group" id="sel_emp_no" style="font-weight: bold;color: #5b5b5b;">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name"> Emp Name <span class="required">*</span></div>
                                          <div class="col-sm-8 name">
                                                 <div class="input-group" id="sel_emp_name" style="font-weight: bold;color: #5b5b5b;">
                                                 </div>
                                          </div>
                                   </div>
                                   
                               
                                
                            </fieldset>

                            <fieldset id="fset_1">

                                   <div class="card-header d-flex align-items-center">
                                          <h4 class="card-title mb-0">Employee Shift Group </h4>
                                                 <div class="card-actions ml-auto">
                                                        <table>
                                                               <td>
                                                                      <a href='#'><div class="toolbar sprite-toolbar-add" title="Add" data-toggle="modal" data-target="#CreateForm" id="CreateButton" data-keyboard="false" data-backdrop="static">
                                                                      </div></a>
                                                               </td>
                                                        </table>
                                                        </div>
                                                 </div>
                                          
                                          <legend>Other Employee Shift Group</legend>
                                                 <div class="card-body table-responsive p-0" style="width: 99%; margin: 1px;overflow: scroll;">
                                                        <!-- pages relation -->
                                                        <div id="box"></div>
                                                        <!-- pages relation -->
                                                 <div>
                            </fieldset>

                     </div>
   
              <!-- END SCROLLING -->

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
<div class="modal  fade fade-custom" tabindex="-1" role="dialog" id="CreateForm">
       <div class="modal-dialog modal-belakang modal-onmodal" style="margin-top: 40px;" role="document">
              <div class="modal-content">
                     <div class="modal-header">
                            <h4 class="modal-title">Add Employee Group Schedule </h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 99%; margin: 5px;overflow: scroll;overflow-x: hidden;">
                     
                     <form class="form-horizontal" action="php_action/FuncDataCreate.php" method="POST" id="FormDisplayCreate">

                            <fieldset id="fset_1">
                                   <legend>Employee Group Schedule</legend>

                                   <div class="messages_create"></div>

                                   <input id="inp_emp_no" name="inp_emp_no" type="hidden" value="<?php echo $username; ?>"><!--FROM SESSION -->
                                   <input id="inp_token" name="inp_token" type="hidden" value="<?php echo $get_token; ?>"><!--FROM CONFIGURATION -->

                                   <div class="form-row">
                                          <div class="col-4 name">Start Shift Date <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                 <p id="demo"></p>

                                                 <input class="hidden" autocomplete="off" autofocus="on"
                                                               id="inp_emp_id" name="inp_emp_id"
                                                               type="hidden" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;width: 60%;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">       

                                                 <input type="text" id="inp_shiftstartdate"
                                                                             class="input--style-6"
                                                                             name="inp_shiftstartdate" style="
                                                                                                         background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                                                         background-size: 17px;
                                                                                                         background-position:right;   
                                                                                                         background-repeat:no-repeat; 
                                                                                                         padding-right:10px;  
                                                                                                         " />

                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4">Always Present <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                 <input data-xx="55" data-checked="false" type="checkbox" id="inp_always_present" name="inp_always_present" langed="Y" title="Yes" value="Y" onfocus="hlentry(this)" onclick="formodified(this);" class="modified">
                                                 </div>
                                          </div>
                                   </div>
                                   
                            </fieldset>

                            <fieldset id="fset_1">

                                          
                                          <legend>Other Employee Shift Group</legend>
                                                 <div class="card-body table-responsive p-0" style="width: 99%; margin: 1px;overflow: scroll;">
                                                  
                                                        <?php
                                                               $query = mysqli_query($connect,"SELECT * FROM HRMTTAMSHIFTGROUP");
                                                               while($allshiftgroup = mysqli_fetch_array($query)){
                                                        ?>
                                                               <input type="radio" name="inp_shiftgroupcode" id="inp_shiftgroupcode" value="<?php echo $allshiftgroup['shiftgroupcode']; ?>"><?php echo $allshiftgroup['shiftgroupcode']; ?> [ <?php echo $allshiftgroup['shiftgroupname']; ?> ]<br/>  
                                                        <?php } ?>

                                                 <div>
                            </fieldset>

                           
                            </div>
                            <div class="modal-footer">
                                   <button type="reset" class="btn btn-primary1" data-dismiss="modal" onclick="ResetTable();"
                                          aria-hidden="true">
                                          &nbsp;Cancel&nbsp;
                                   </button>
                                   <button class="btn btn-warning" type="submit" name="submit_add" id="submit_add">
                                          Confirm
                                   </button>
                                   <button class="btn btn-warning" type="button" name="submit_add2"
                                          id="submit_add2" style='display:none;' disabled>
                                          <span class="spinner-grow spinner-grow-sm" role="status"
                                                 aria-hidden="true"></span>
                                          &nbsp;&nbsp;Processing..
                                   </button>
                            </div>                   
                     </form>
              </div>
       </div>
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /edit modal -->




















	<!-- delete transaction modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="FormDisplayDelete">
	  <div class="modal-dialog" style="width: 25%;">
	    <div class="modal-content">
		<form class="form-horizontal" action="php_action/FuncDataDelete.php" method="POST" id="updatedelMemberForm">	      

		<div class="modal-body">      	
		  <div class="edit-messages"></div>
		  <table width="100%">
                     <tr><td align="center"><img src="../../asset/dist/img/sf-mola-mola.png" style="max-width: 90%;margin-top: 20px;"></td></tr>
                   
                     </table>
                     <div class="form-group">
                            <div class="col-sm-12">	
                                          <table width="100%"><td align="center"><label id="isi">Are you sure to delete data ?</label></td></table>		
                                          <input type="hidden" class="form-control input-report" id="sel_overtime_codes" name="sel_overtime_codes" placeholder="Nip">
                            </div>
                     </div>


				
				<!-- <div class="modal-footer-delete FormDisplayDelete" style="text-align: center;padding-top: 20px;">
                                          <button type="reset" class="btn btn-primary1" style="background: #ececec;" data-dismiss="modal" aria-hidden="true">
                                                        &nbsp;Cancel&nbsp;
                                          </button>
                                          <button class="btn btn-warning" type="submit"  aria-hidden="true"  id="removeBtn">
                                          Confirm
                                          </button>
					</div>
				</div> -->

                            <div class="modal-footer-delete FormDisplayDelete" style="text-align: center;padding-top: 20px;">
                                   <button type="reset" class="btn btn-primary1" data-dismiss="modal" onclick="ResetTable();"
                                          aria-hidden="true">
                                          &nbsp;Cancel&nbsp;
                                   </button>
                                   <button class="btn btn-warning" type="submit" name="submit_delete" id="submit_delete">
                                          Confirm
                                   </button>
                                   <button class="btn btn-warning" type="button" name="submit_delete2"
                                          id="submit_delete2" style='display:none;' disabled>
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
// $(document).ready(function() {
//        $("#CreateButton").on('click', function() {
//               // reset the form 
//               $("#FormDisplayCreate")[0].reset();
//               // empty the message div

//               $(".messages_create").html("");

//               // submit form
//               $("#FormDisplayCreate").unbind('submit').bind('submit', function() {

//                      $(".text-danger").remove();

//                      var form = $(this);

//                      var inp_shiftdtartdate = $("#inp_shiftdtartdate").val();

//                      var regex=/^[a-zA-Z]+$/;

//                      var getSelectedValue = document.querySelector( 'input[name="inp_shiftgroupcode"]:checked');   
                  
                     

                     
                     
//                      if (inp_shiftdtartdate == "") {
//                             modals.style.display ="block";
//                             document.getElementById("msg").innerHTML = "Shift start cannot empty";
//                             return false;

//                      } else if(getSelectedValue == null) {   
                            
//                             modals.style.display ="block";
//                             document.getElementById("msg").innerHTML = "Please select shiftgroup";
//                             return false;

//                      } else {
//                             $('#submit_add').hide();
//                             $('#submit_add2').show();
//                      }

                     

//                      if (inp_shiftdtartdate) {

//                             //submi the form to server
//                             $.ajax({
//                                    url: form.attr('action'),
//                                    type: form.attr('method'),
//                                    // data: form.serialize(),

//                                    data: new FormData(this),
//                                    processData: false,
//                                    contentType: false,

//                                    dataType: 'json',
//                                    success: function(response) {

//                                           // remove the error 
//                                           $(".form-group").removeClass('has-error').removeClass('has-success');

//                                           if (response.code =='success_message') {
//                                                  modals.style.display ="block";
//                                                  document.getElementById("msg").innerHTML = response.messages;

//                                                  // // empty table
//                                                  // $("#tbl_posts").empty();

//                                                  // // clear head
//                                                  // $("#tbl_posts  thead").remove();

//                                                  // // clear body
//                                                  // $("#tbl_posts  tbody").remove();
//                                                  $("#tbl_posts_second > tbody > .reset-delete-record").html("");
//                                                  $("#tbl_posts > tbody > .reset-delete-record").html("");

//                                                  $('#submit_add').show();
//                                                  $('#submit_add2').hide();

//                                                  $('#FormDisplayCreate').modal('hide');  
//                                                  $("[data-dismiss=modal]").trigger({type: "click"});   

//                                                  // reset the form
//                                                  $("#FormDisplayCreate")[0].reset();
//                                                  // reload the datatables
//                                                  datatable.ajax.reload(null,false);
//                                                  // this function is built in function of datatables;
//                                           } else {
//                                                  modals.style.display ="block";
//                                                  document.getElementById("msg").innerHTML = response.messages;

//                                                  $('#submit_add').show();
//                                                  $('#submit_add2').hide();

//                                                  window.setTimeout(
//                                                         function() {
//                                                                $(".alert")
//                                                                       .fadeTo(
//                                                                              500,
//                                                                              0
//                                                                              )
//                                                                       .slideUp(
//                                                                              500,
//                                                                              function() {
//                                                                                     $(this)
//                                                                              .remove();
//                                                                              }
//                                                                       );
//                                                         },
//                                                         4000
//                                                         );
//                                           } // /else
//                                    } // success  
//                             }); // ajax subit 				
//                      } /// if
//                      return false;
//               }); // /submit form for create member
//        }); // /add modal
// });






























  
                     
                            
                                   
                                
                                   
                                 
               
                   
            






function editMember(id = null) {

       mymodalss.style.display = "block";

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
                     url: 'php_action/getSelectedEmployee.php',
                     type: 'post',
                     data: {
                            member_id: id
                     },
                     dataType: 'json',


                     success: function(response) {

                            

                            document.getElementById("sel_emp_no").innerHTML = response.emp_no;
                            document.getElementById("sel_emp_name").innerHTML = response.Full_Name;

                            $("#CreateButton").attr("onclick", "addMember(`" + response.emp_id + "`)");

                            $("#sel_emp_no").val(response.emp_no);
                     
                            var sel_emp_id       = response.emp_id;

                                   $("#box").load("pages_relation/_pages_shiftgroup_code?rfid=" + sel_emp_id, 
                                   function(responseTxt, statusTxt, jqXHR){
                                                 if(statusTxt == "success"){
                                                        mymodalss.style.display = "none";
                                                        $("#box").show();
                                                 }
                                                 if(statusTxt == "error"){
                                                        alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                                 }
                                          }
                                   );                          


                            // here update the member data
                            $("#FormDisplayUpdate").unbind('submit').bind('submit', function() {
                                   // remove error messages
                                   $(".text-danger").remove();

                                   mymodalss.style.display = "block";

                                   var form = $(this);

                                   var sel_overtime_code       = $("#sel_overtime_code").val();
                                   var sel_overtime_minimum    = $("#sel_overtime_minimum").val();
                                   var sel_ovtcalctype         = $("#sel_ovtcalctype").val();
                                   var sel_otrounding          = $("#sel_otrounding").val();
                                   var sel_otroundlimit        = $("#sel_otroundlimit").val();
                                   var sel_otachieved          = $("#sel_otachieved").val();
                                   var lbl_sel_otdeucted       = $("#lbl_sel_otdeucted").val();
                                   var sel_ovtcalctype         = $("#sel_ovtcalctype").val();
                                   var sel_emp_no              = $("#sel_emp_no").val();
                                   var sel_token               = $("#sel_token").val();
                                   var FactorHour = [];
                                   var FactorValue = [];

                                   var SelOTtypeother = [];
                                   var SelOTminutes = [];
                                   var SelOTmeal = [];
                                   var SelOTtransport = [];
         
                                   var regex=/^[a-zA-Z]+$/;

                                   if (sel_overtime_code == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "Overtime code cannot empty";

                                   } else if (sel_overtime_minimum == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "Overtime minimum cannot empty";

                                   } else if (sel_overtime_minimum.match(regex)) {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "Please enter valid number";

                                   } else if (sel_ovtcalctype == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "Overtime calctype";

                                   } else if (sel_otrounding == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "Overtime rounding";

                                   } else if (sel_otroundlimit == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "Overtime rounding limit";

                                   } else {
                                          mymodalss.style.display = "block";
                                   }




                                   if (sel_overtime_code && sel_overtime_minimum && sel_ovtcalctype && sel_otrounding && sel_otroundlimit) {

                                          $.ajax({
                                                 
                                                 url: form.attr('action'),
                                                 type: form.attr('method'),
                                                 // data: form.serialize(),

                                                 data: new FormData(this),
                                                 processData: false,
                                                 contentType: false,

                                                 dataType: 'json',
                                                 success: function(response) {

                                                        if (response.code =='success_message') {
                                                               modals.style.display = "block";
                                                               document.getElementById("msg").innerHTML =response.messages;

                                                               mymodalss.style.display = "none";

                                                               $('#FormDisplayUpdate').modal('hide');  
                                                               $("[data-dismiss=modal]").trigger({type: "click"});      
                                                        
                                                               // reload the datatables
                                                               datatable.ajax.reload(null,false);
                                                               // reload the datatables
                                                               
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




























function addMember(id = null) {

    

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
                     url: 'php_action/getSelectedEmployee.php',
                     type: 'post',
                     data: {
                            member_id: id
                     },
                     dataType: 'json',


                     success: function(response) {
                            $("#inp_emp_id").val(response.emp_id);                            
                        
                            var sel_emp_id       = response.emp_id;
                            
                            // here update the member data
                            $("#FormDisplayCreate").unbind('submit').bind('submit', function() {
                                   // remove error messages
                                   $(".text-danger").remove();

                                   var form = $(this);

                                   var inp_emp_id              = $("#inp_emp_id").val();
                                   var inp_shiftstartdate      = $("#inp_shiftstartdate").val();
                                   var inp_shiftgroupcode      = $("#inp_shiftgroupcode").val();
         
                                   var regex=/^[a-zA-Z]+$/;

                                   var getSelectedValue = document.querySelector( 'input[name="inp_shiftgroupcode"]:checked');

                                   if (inp_shiftstartdate == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "Shift start cannot empty";
                                          return false;

                                   } else if(getSelectedValue == null) {   
                                          
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "Please select shiftgroup";
                                          return false;

                                   }


                                   if (inp_shiftstartdate && getSelectedValue) {

                                          $.ajax({
                                                 
                                                 url: form.attr('action'),
                                                 type: form.attr('method'),
                                                 // data: form.serialize(),

                                                 data: new FormData(this),
                                                 processData: false,
                                                 contentType: false,

                                                 dataType: 'json',
                                                 success: function(response) {

                                                        if (response.code =='success_message') {
                                                               modals.style.display ="block";
                                                               document.getElementById("msg").innerHTML = response.messages;

                                                               $('#FormDisplayUpdate').modal('hide');  
                                                               $("[data-dismiss=modal]").trigger({type: "click"});      
                                                        
                                                               // reload the datatables
                                                               datatable.ajax.reload(null,false);
                                                               // reload the datatables
                                                               
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

				$("#sel_overtime_codes").val(response.overtime_code);

				// mmeber id 
				$(".FormDisplayDelete").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');

				// here update the member data
				$("#updatedelMemberForm").unbind('submit').bind('submit', function() {
					// remove error messages
					$(".text-danger").remove();

					var form = $(this);

					// validation

					var sel_overtime_codes = $("#sel_overtime_codes").val();

	

					if(sel_overtime_codes == "") {
						$("#sel_overtime_codes").closest('.form-group').addClass('has-error');
						$("#sel_overtime_codes").after('<p class="text-danger">The Name field is required</p>');
                                   } else {
                                          $('#submit_delete').hide();
                                          $('#submit_delete2').show();
                                   }


                                   


					if(sel_overtime_codes) {
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

                                                               $('#FormDisplayDelete').modal('hide');  
                                                               $("[data-dismiss=modal]").trigger({type: "click"});      
                                                             

                                                               // reload the datatables
                                                               datatable.ajax.reload(null,false);
                                                               // reload the datatables
                                                               
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








































</script>
<!-- isi JSONs -->
</body>

</html>



<script type="text/javascript">
$(document).ready(function() {
       $('#inp_shiftstartdate').bootstrapMaterialDatePicker({
              time: false,
              clearButton: true
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



                           
      
                        
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>