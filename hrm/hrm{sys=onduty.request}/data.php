<?php
$frameworks                     = '';
?>




<!-- MAIN DATATABLE SERVERSIDE CSS -->
<!-- MAIN DATATABLE SERVERSIDE CSS -->
<script type="text/javascript" src="../../asset/sdk_datatables_core/gt_dist/jQuery-2.1.4.min.js"></script>
<script type="text/javascript"
	src="../../asset/sdk_datatables_core/datatables/bedanihbuatjson/bootstrap/js/bootstrap.min.js"></script>
<!-- MAIN DATATABLE SERVERSIDE CSS -->
<!-- MAIN DATATABLE SERVERSIDE CSS -->

<!-- cdn select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- end cdn select2 -->

<!-- icon bootstrap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>


<script type="text/javascript">
	$(document).ready(function () {
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
	$(document).ready(function () {
		datatable = $("#datatable<?php echo $platform; ?>").DataTable({

			dom: "B<'row'<'col-lg-12 col-md-9'l><'col-lg-12 col-md-9'f>>" +
				"<'row'<'col-lg-12'tr>>" +
				"<'row'<'col-lg-12 col-md-6'i><'col-lg-12 col-md-7'p>>",

			processing: true,
			lengthMenu: [
				[-1, 10, 25, 50],
				['All Records', 10, 25, 50],
			],
			searching: true,
			paging: true,
			ordering: true,
			pagingType: "simple",
			bPaginate: true,
			bLengthChange: false,
			bFilter: false,
			bInfo: true,
			scrollX: true,
			// scrollY: 200,
			bAutoWidth: true,
			language: {
				"processing": "Please wait..",
			},
			columnDefs: [{
				orderable: false,
				targets: 7
			}],
			destroy: true,
			pageLength: 15,
			"ajax": "php_action/FuncDataRead<?php echo $platform; ?>.php<?php echo $getPackage; ?><?php echo $frameworks; ?>"
		});
	});
</script>



<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>



<a data-toggle="modal" data-target="#CreateForm" id="CreateButtonFloating" data-keyboard="false" data-backdrop="static"
	class="floating" target="_blank" style="color: white;color: white;cursor: pointer;">
	<i class="fa fa-plus fab-icon" aria-hidden="true"></i>
</a>

<?php
if ($platform != 'mobile') {
?>

<div class="MaximumFrameHeight card-body table-responsive p-0"
	style="width: 100vw;height: 80vh; width: 98%; margin-right: 5px;overflow: scroll;overflow-x: hidden;margin-top: 17px;">
	<div class="col-12 col-fit" style="margin-top: 17px;">
		<div class="row page-titles" style="margin-top: -16px;">
			<div class="col-md-5 col-12 align-self-center">
				<ol class="breadcrumb mb-0 p-0 bg-transparent">
					<li class="digital" style="font-size: 12px;">Setting&nbsp;&nbsp;</li>
					<li class="digital" style="font-size: 12px;"><i class="fa fa-angle-right"
							aria-hidden="true"></i>&nbsp;Time & Attendance&nbsp;&nbsp;</li>
					<li class="digital" style="font-size: 12px;"><i class="fa fa-angle-right"
							aria-hidden="true"></i>&nbsp;On Duty Request</li>
				</ol>
			</div>

			<div class="card-actions ml-auto" style="margin-top: -3px;">
				<table>
					<tbody>
						<tr>
							<td>
								<a href="#" class="open_modal_search" title="Add" data-toggle="modal"
									data-target="#CreateForm" id="CreateButton" data-keyboard="false"
									data-backdrop="static">
									<div class="toolbar sprite-toolbar-add">
									</div>
								</a>
							</td>
							<td>
								<div class="toolbar sprite-toolbar-reload" id="RELOAD" title="Reload"
									onclick="RefreshPage();">
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<table id="datatable" width="100%" border="1" align="left"
			class="table table-bordered table-striped table-hover table-head-fixed">
			<thead>
				<tr>
					<th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No</th>
					<th class="fontCustom" style="z-index: 1;">Request No</th>
					<th class="fontCustom" style="z-index: 1;">Start Date</th>
					<th class="fontCustom" style="z-index: 1;">End Date</th>
					<th class="fontCustom" style="z-index: 1;">Request By</th>
					<th class="fontCustom" style="z-index: 1;">Request For</th>
					<th class="fontCustom" style="z-index: 1;">Remark</th>
					<th class="fontCustom" style="z-index: 1;">Request Status</th>
					<th class="fontCustom" style="z-index: 1;">Approval Status</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
<?php
} else {
?>

<div class="MaximumFrameHeight card-body table-responsive p-0"
	style="width: 100vw;height: 80vh; width: 98%; margin-right: 5px;overflow: scroll;overflow-x: hidden;margin-top: 17px;">
	<div class="col-12 col-fit" style="margin-top: 17px;">
		<table id="datatablemobile" width="100%" align="left">
			<thead style="display:none;">
				<tr>
					<th class="fontCustom" style="z-index: 1;" nowrap="nowrap"></th>
				</tr>
			</thead>
		</table>
	</div>
</div>

<?php } ?>







<!-- add modal -->
<div class="modal  fade fade-custom" tabindex="-1" role="dialog" id="CreateForm">
	<div class="modal-dialog modal-belakang modal-bg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="revised_title">Add On Duty Request</h4>
				<a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close"
					style="margin-top: -15px;">
					<span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
				</a>
			</div>
			<form class="form-horizontal" method="POST" action="" id="FormDisplayCreate" onkeydown="return event.key != 'Enter';">
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

				<div class="card-body table-responsive p-0"
					style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

					<fieldset id="fset_1">
						<legend>On Duty Entry Form</legend>

						<div class="messages_create"></div>

						<div class="form-row" id="frm_employee_no">
							<div class="col-lg-3 name">On Duty Purpose Type <font color="red">*</font>
							</div>
							<div class="col-lg-4">
								<div class="input-group">
									<input type="hidden" name="inp_emp_no" value="<?php echo $username; ?>">
									<select class="input--style-6 modal_leave" name="inp_purpose_type"
										style="width: 80%;height: 30px;" id="inp_purpose_type" required>
										<option value="">--Select One--</option>
										<!-- onchange="isi_otomatis_leave()" -->
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
							$emp = mysqli_fetch_array(mysqli_query($connect, "SELECT full_name, pos_name_en, emp_id FROM view_employee WHERE emp_no='$username'"));
						?>

						<div class="form-row" id="frm_employee_no">
							<div class="col-sm-3 name">Request For <font color="red">*</font>
							</div>
							<div class="col-sm-5">
								<div class="input-group">
									<input type="text" class="input--style-6 search-input" id="modal_emp"
										name="modal_emp"
										value="<?php echo $emp['emp_id']; ?>"
										size="30" maxlength="50" validate="NotNull:Invalid Form Entry" readonly required>
									<!-- <div id="employeeList"></div> -->
								</div>
							</div>
						</div>
<!-- value="<?php echo $username; ?> [ <?php echo $emp['full_name']; ?> ] <?php echo $emp['pos_name_en']; ?>" -->
						<div class="form-row" id="frm_employee_no">
							<div class="col-lg-3 name">remark <font color="red">*</font>
							</div>
							<div class="col-lg-8">
								<div class="input-group">
									<textarea class="input--style-6 search-input" onfocus="this.value=''"
										autocomplete="off" id="inp_remark" name="inp_remark" type="Text" value=""
										title="" required></textarea>
								</div>
							</div>
						</div>
						<!-- <div class="form-row">
							<div class="col-lg-3 name"></div>
							<div class="col-lg-8">
								<div class="form-check form-check-inline">
									<input type="checkbox" class="form-check-input" id="checkFileAttachment" name="checkFileAttachment">
									<label class="form-check-label" for="checkFileAttachment">With Attachment</label>
								</div>
							</div>
						</div> -->
						<!-- <div id="dataFileAttechment"></div> -->
						<div class="form-row" id="formFileAttachment">
							<div class="col-lg-3 name">File Attachment <font color="red">*</font>
							</div>
							<div class="col-lg-5">
								<div class="input-group">
									<input type="file" name="fileupload" id="fileupload" class="form-control">
									<span><font color="red">pdf, doc/docx, jpg/jpeg, png</font></span>
								</div>
							</div>
						</div>
					</fieldset>

					<fieldset class="mb-5" id="fset_1">
						<legend>Destination</legend>
						<div class="form-row" id="frm_employee_no">
							<div class="col-sm-3 name">Destination <span class="required">*</span></div>
							<div class="col-sm-5 name">
								<div class="input-group">
									<select class="input--style-6 modal_leave" style="width: 80%;height: 30px;" name="inp_onduty_purpose" id="inp_onduty_purpose" required>
										<option value="">--Select Option--</option>
										hrmdestination
										<?php
											$sql = mysqli_query($connect, "SELECT 
											a.id_destination,
											a.city
											FROM 
											hrmdestination a
											ORDER BY a.id_destination ASC");
											while ($row = mysqli_fetch_array($sql)) {
												echo '<option value="' . $row['id_destination'] . '">' . $row['city'] . '</option>';
											}
										?>
									</select>
								</div>
							</div>
						</div>
						<div id="otherDestinationDetail"></div>
						<div class="form-row">
							<div class="col-sm-3 mr-2 name">
								Date Between <font color="red">*</font>
							</div>
							<div class="row">
								<div class="col-sm">
									<input type="text" id="inp_add_startdate" name="inp_add_startdate"
										class="input--style-6" placeholder="Start Date" style="background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
										background-size: 17px;
										background-position:right;   
										background-repeat:no-repeat; 
										padding-right:10px;" autocomplete="off" required/>
								</div>
								<div class="col-sm">
									<input type="text" id="inp_add_enddate" name="inp_add_enddate"
										class="input--style-6" placeholder="End Date" style="background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
										background-size: 17px;
										background-position:right;   
										background-repeat:no-repeat;
										padding-right:10px;" autocomplete="off" required/>
								</div>
									<div class="col-sm">
										<div class="input-group">
											<a class="btn btn-primary" type="submit"
												name="confirm_detail_destination" id="confirm_detail_destination"
												style="font-size: 10px;color: white;border-radius: 30px;width: 100px;background: #74614a;border-color: 1px solid transparent;">
												Confirm Date
											</a>
										</div>
									</div>
								</div>
							</div>
							<div id="list_detail_attendance"></div>
						</div>
						
					</fieldset>
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
						<div type="reset" class="shine btn-sdk btn-primary-center-only" data-dismiss="modal"
							style="padding-top: 8px;" aria-hidden="true">
							&nbsp;Close&nbsp;
						</div>
					</div>
					<div class="modal-footer-sdk" id="modalcancelcondition_2" style="display:none">
						<button type="reset" class="btn-sdk btn-primary-center-only" data-dismiss="modal"
							aria-hidden="true">
							&nbsp;Close&nbsp;
						</button>
					</div>
					<div class="modal-footer-sdk" id="modalcancelcondition_3" style="display:none">
						<button type="reset" class="btn-sdk btn-primary-not-only-left" data-dismiss="modal"
							aria-hidden="true">
							&nbsp;Cancel&nbsp;
						</button>
						<button class="btn-sdk btn-primary-center-not-only" type="submit" name="submit_update"
							id="submit_update">
							Confirm
						</button>
						<a id="cancellation_id" style="padding-top: 8px;" class="btn-sdk btn-primary-not-only-right delete"
							type="submit" name="submit_delete" id="submit_delete">
							Cancel
						</a>
					</div>
					<!-- //LOAD BUTTON APPROVER STATUS -->
				</div>
				

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

<!-- detail update modal -->
<div class="modal  fade fade-custom" tabindex="-1" role="dialog" id="DetailForm">
	<div class="modal-dialog modal-belakang modal-bg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="revised_title">Detail On Duty Request</h4>
				<a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close"
					style="margin-top: -15px;">
					<span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
				</a>
			</div>
			<form class="form-horizontal" method="" action="" id="FormDisplayDetail" onkeydown="return event.key != 'Enter';">
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

				<div class="card-body table-responsive p-0"
					style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

					<fieldset id="fset_1">
						<legend>On Duty Detail Form</legend>

						<div class="messages_create"></div>

						<div class="form-row" id="frm_employee_no">
							<div class="col-lg-3 name">On Duty Purpose Type <font color="red">*</font>
							</div>
							<div class="col-lg-4">
								<div class="input-group">
									<input type="hidden" name="detail_emp_no" id="detail_emp_no" value="<?php echo $username; ?>">
									<select class="input--style-6 modal_leave" name="detail_purpose_type"
										style="width: 80%;height: 30px;" id="detail_purpose_type" required disabled>
										<option value="">--Select One--</option>
										<!-- onchange="isi_otomatis_leave()" -->
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

						<div class="form-row" id="frm_employee_no">
							<div class="col-sm-3 name">Request For <font color="red">*</font>
							</div>
							<div class="col-sm-5">
								<div class="input-group">
									<input type="text" class="input--style-6 search-input" id="detail_modal_emp"
										name="detail_modal_emp"
										size="30" maxlength="50" validate="NotNull:Invalid Form Entry" readonly required>
									<!-- <div id="employeeList"></div> -->
								</div>
							</div>
						</div>

						<div class="form-row" id="frm_employee_no">
							<div class="col-lg-3 name">remark <font color="red">*</font>
							</div>
							<div class="col-lg-8">
								<div class="input-group">
									<textarea class="input--style-6 search-input" onfocus="this.value=''"
										autocomplete="off" id="detail_remark" name="detail_remark" type="Text" value=""
										title="" required></textarea>
								</div>
							</div>
						</div>

						<div class="form-row file-attachment-data" id="frm_employee_no">
							<div class="col-lg-3 name">File Attachment <font color="red">*</font>
							</div>
							<div class="col-lg-5">
								<div class="input-group">
									<a href="" id="detail_fileupload" target="_blank" download>
										<div id="icon_file_upload"></div>
									</a>
									<br>
									<!-- <span><font color="red">click for detail</font></span> -->
								</div>
							</div>
						</div>
					</fieldset>

					<fieldset class="mb-5" id="fset_1">
						<legend>Destination</legend>
						<div class="form-row" id="frm_employee_no">
							<div class="col-sm-3 name">Destination <span class="required">*</span></div>
							<div class="col-sm-5 name">
								<div class="input-group">
									<select class="input--style-6 modal_leave" style="width: 80%;height: 30px;"
										name="detail_onduty_purpose" id="detail_onduty_purpose" disabled>
										<option value="hidden">--Select Option--</option>
										hrmdestination
										<?php
											$sql = mysqli_query($connect, "SELECT 
											a.id_destination,
											a.city
											FROM 
											hrmdestination a
											ORDER BY a.id_destination ASC");
											while ($row = mysqli_fetch_array($sql)) {
												echo '<option value="' . $row['id_destination'] . '">' . $row['city'] . '</option>';
											}
										?>
									</select>
								</div>
							</div>
						</div>
						<div id="detailOtherDestination"></div>
						<div class="form-row">
							<div class="col-sm-3 mr-2 name">
								Date Between <font color="red">*</font>
							</div>
							<div class="row">
								<div class="col-sm">
									<input type="text" id="detail_add_startdate" name="detail_add_startdate"
										class="input--style-6" placeholder="Start Date" style="background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
										background-size: 17px;
										background-position:right;   
										background-repeat:no-repeat; 
										padding-right:10px;" autocomplete="off" readonly/>
								</div>
								<div class="col-sm">
									<input type="text" id="detail_add_enddate" name="detail_add_enddate"
										class="input--style-6" placeholder="End Date" style="background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
										background-size: 17px;
										background-position:right;   
										background-repeat:no-repeat;
										padding-right:10px;" autocomplete="off" readonly/>
								</div>
								</div>
							</div>
							<div id="list_detail_onduty">
								<!-- id="detailOnDutyTable" -->
								<table class="table table-striped table-bordered display mt-4">
									<thead class="thead-dark">
										<tr>
											<th style="text-align:center">Date</th>
											<th style="text-align:center">Time In</th>
											<th style="text-align:center">Time Out</th>
										</tr>
									</thead>
									<tbody id="detailOnDutyTable">
									</tbody>
								</table>
							</div>
						</div>
						
					</fieldset>
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
						<div type="reset" class="btn shine btn-sdk btn-primary-center-only rounded-pill" data-dismiss="modal"
							style="padding-top: 8px; color:black" aria-hidden="true">
							&nbsp;Close&nbsp;
						</div>
					</div>
				</div>
				

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

<!--approval onduty modal -->
<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="FormDisplayOnDutyApproval">
	<div class="modal-dialog modal-belakang modal-bs modal-med" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Onduty Approval</h4>
				<a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close"
					style="margin-top: -15px;">
					<span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
				</a>
			</div>

			<div class="card-body table-responsive p-0"
				style="width: 100vw;height: 50vh; width: 99%; margin: 5px;overflow: scroll;overflow-x: hidden;">

				<form class="form-horizontal" action="php_action/FuncApprove.php<?php echo $getPackage; ?>"
					method="POST" id="dataDetailOnDutyApproval">

					<fieldset id="fset_1">
						<legend>&nbsp;Detail Information&nbsp;</legend>

						<div class="messages_create"></div>

						<input id="sel_emp_no_approver" name="sel_emp_no_approver" type="hidden"
							value="<?php echo $username; ?>">
						<!--FROM SESSION -->

						<div class="form-row">
							<div class="col-sm-4 name"> Request No. <span class="required">*</span></div>
							<div class="col-sm-8 name">
								<div class="input-group" id="contoh"
									style="display:none; font-weight: bold;color: #5b5b5b;">
								</div>
								<div class="input-group" id="detail_request_no"
									style="font-weight: bold;color: #5b5b5b;">
								</div>
							</div>
						</div>

						<div class="form-row">
							<div class="col-sm-4 name"> Employee <span class="required">*</span></div>
							<div class="col-sm-8 name">
								<div class="input-group" id="detail_full_name"
									style="font-weight: bold;color: #5b5b5b;">
								</div>
							</div>
						</div>

						<div class="form-row">
							<div class="col-sm-4 name"> Detail On Duty <span class="required">*</span></div>
							<div class="col-sm-8 name">
								<div class="input-group" id="detail_on_duty"
									style="font-weight: bold;color: #5b5b5b;">
								</div>
							</div>
						</div>
				
						<div class="form-row">
							<div class="col-sm-4 name"> Date <span class="required">*</span></div>
							<div class="col-sm-8 name">
								<div class="input-group" id="detail_date_on_duty"
									style="font-weight: bold;color: #5b5b5b;">
								</div>
							</div>
						</div>

						<div class="form-row" style="display:none">
							<div class="col-4 name"> APP Detail <span class="required">*</span></div>
							<div class="col-sm-8">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on"
										id="sel_approval_request_no" name="sel_approval_request_no" type="Text">
								</div>
							</div>
						</div>
					</fieldset>

					<fieldset id="fset_1">
						<legend>Approval Detail</legend>
						<div class="card-body table-responsive p-0" style="width: 99%; margin: 1px;overflow: scroll;">
							<table class="table table-striped table-bordered display mt-4">
								<thead class="thead-light">
									<tr>
									<th>No.</th>
									<th>Approver name </th>
									<th>Type of approver</th>
									<th>Approval status</th>
									</tr>
								</thead>
								<tbody id="list_user_approval_detail"></tbody>
							</table>
							<!-- <div> -->
						</div>

					</fieldset>
			</div>

			<!-- //LOAD BUTTON APPROVER STATUS -->
			<div class="modal-footer-sdk cancel_button" id="cancel_button_0">
				<div type="reset" class="btn shine btn-sdk btn-primary-center-only rounded-pill" style="color: black;" data-dismiss="modal" aria-hidden="true">
					&nbsp;Close&nbsp;
				</div>
			</div>
			<div class="modal-footer-sdk cancel_button" id="cancel_button_1">
				<button type="reset" class="btn shine btn-sdk btn-primary-center-only rounded-pill" data-dismiss="modal" aria-hidden="true">
					&nbsp;Close&nbsp;
				</button>
			</div>
			<div class="modal-footer-sdk cancel_button" id="cancel_button_2">
				<button type="reset" class="btn-sdk btn-primary-left" data-dismiss="modal" aria-hidden="true">
					&nbsp;Cancel&nbsp;
				</button>
				<a id="cancel_onduty" style="padding-top: 8px;" class="btn-sdk btn-primary-right delete" type="submit"
					name="submit_update" id="submit_update">
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


<script>
	function RefreshPage() {
		datatable.ajax.reload(null, true);

		setTimeout(function () {
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
	// for select 2 create
	$('#inp_purpose_type').select2({
		dropdownParent: $('#CreateForm')
	});
	$('#inp_onduty_purpose').select2({
		dropdownParent: $('#CreateForm')
	});

	$('#CreateButtonFloating').on('click', function() {
		$('#CreateForm')[0].reset()
	})

	// for file attachment
	$('#checkFileAttachment').on('change', function() {
		if(this.checked) {
			$('#dataFileAttechment').append(`
				<div class="form-row" id="formFileAttachment">
					<div class="col-lg-3 name">File Attachment <font color="red">*</font>
					</div>
					<div class="col-lg-5">
						<div class="input-group">
							<input type="file" name="fileupload" id="fileupload" class="form-control">
							<span><font color="red">pdf, doc/docx, jpg/jpeg, png</font></span>
						</div>
					</div>
				</div>
			`)
		} else {
			$('#formFileAttachment').remove()
		}
	})

	// for append and remove textarea when change select option
	$('#inp_onduty_purpose').on('change', function(){
		if($(this).val() == 'DST005') {
			$('#otherDestinationDetail').append(`
				<div class="form-row" id="formDestinationDetail" name="formDestinationDetail">
					<div class="col-lg-3 name">Destination Detail <font color="red">*</font>
					</div>
					<div class="col-lg-8">
						<div class="input-group">
							<textarea class="input--style-6 search-input" onfocus="this.value=''"
								autocomplete="off" id="input_destination_detail" name="input_destination_detail" type="Text" value=""
								title="" required></textarea>
						</div>
					</div>
				</div>
			`);
		} else {
			$('#formDestinationDetail').remove();
		}
	});

	// for detail attendance list
	$('#confirm_detail_destination').on('click', () => {
		var modal_emp = $("#modal_emp").val();
		var myarr = modal_emp.split(" ");
		var myvar = myarr[1];

		if (myvar == '') {
			mymodalss.style.display = "none";
			modals.style.display = "block";
			document.getElementById("msg").innerHTML = "Please select employee";
			return false
		}

		var inp_add_startdate = $("#inp_add_startdate").val();
		var inp_add_enddate = $("#inp_add_enddate").val();

		if(inp_add_enddate < inp_add_startdate) {
			mymodalss.style.display = "none";
			modals.style.display = "block";
			document.getElementById("msg").innerHTML =
				"Entry Date: Enter Date in Proper Range";
			return false;
		}
		$("#list_detail_attendance").show();
		
		$("#list_detail_attendance").load(
			"pages_relation/_pages_attendance.php<?php echo $getPackage; ?>inp_add_startdate=" +
			inp_add_startdate + "&inp_add_enddate=" + inp_add_enddate +
			"&src_emp_no=<?php echo $username; ?>",
			function (responseTxt, statusTxt, xhr) {
				if (statusTxt == "success")
					mymodalss.style.display = "none";
				if (statusTxt == "error")
					alert("Error: " + xhr.status + ": " + xhr.statusText);
			}
		);
		// var inp_hours_endtime = document.getElementsByName('inp_hours_endtime[]');
		// alert(inp_hours_endtime)


	});
</script>

<!-- isi JSON -->
<script type="text/javascript">
	// global the manage memeber table 
	$(document).ready(function () {
		$("#CreateButton").on('click', function () {
			$('#frm_inp_course').hide();
			// reset form when click new create data
			document.getElementById("FormDisplayCreate").reset();
			$('#FormDisplayCreate')[0].reset();
			$("#list_detail_attendance").hide();

			document.getElementById("revised_title").innerHTML = "Add Onduty Request";
			// reset the form
			$("#request_no").remove();

			$("#modalcancelcondition_0").show();
			$("#modalcancelcondition_1").hide();
			$("#modalcancelcondition_2").hide();
			$("#modalcancelcondition_3").hide();
			// empty the message div

			// submit form

			$("#FormDisplayCreate").unbind('submit').bind('submit', function () {

				// mymodalss.style.display = "block";

				$(".text-danger").remove();

				var form = $(this);

				var inp_emp_no = $("#inp_emp_no").val();
				var modal_emp = $("#modal_emp").val();
				var inp_purpose_type = $('#inp_purpose_type').val();
				var inp_remark = $('#inp_remark').val();
				// var fileupload = $('#fileupload').prop('files')[0];
				// var fileName = fileupload.name;
				// var fileSize = fileupload.size;
				var inp_onduty_purpose = $('#inp_onduty_purpose').val();
				var inp_add_startdate = $('#inp_add_startdate').val();
				var inp_add_enddate = $('#inp_add_enddate').val();
				var input_destination_detail = $('#input_destination_detail').val();

				var start_time_values = $("input[name='inp_hours_starttime[]']").map(function(){return $(this).val();}).get();
				var end_time_values = $("input[name='inp_hours_endtime[]']").map(function(){return $(this).val();}).get();
				

				var regex = /^[a-zA-Z]+$/;

				if (modal_emp == '') {
					mymodalss.style.display = "none";
					modals.style.display = "block";
					document.getElementById("msg").innerHTML =
						"Employee cannot empty";
					return false;

				} else if (inp_purpose_type == '')  {
					mymodalss.style.display = "none";
					modals.style.display = "block";
					document.getElementById("msg").innerHTML =
						"On Duty Purpose Type cannot empty";
					return false;
					
				} else if (inp_remark == '') {
					mymodalss.style.display = "none";
					modals.style.display = "block";
					document.getElementById("msg").innerHTML =
						"Remark cannot empty";
					return false;
				} else if (inp_onduty_purpose == '') {
					mymodalss.style.display = "none";
					modals.style.display = "block";
					document.getElementById("msg").innerHTML =
						"On Duty Purpose cannot empty";
					return false;
				} else if (inp_onduty_purpose == 'DST005' && input_destination_detail == '') {
					mymodalss.style.display = "none";
					modals.style.display = "block";
					document.getElementById("msg").innerHTML =
						"Destination detail cannot empty";
					return false;
				} else if (end_time_values < start_time_values) {
					mymodalss.style.display = "none";
					modals.style.display = "block";
					document.getElementById("msg").innerHTML =
						"Entry Time: Enter Time in Proper Range";
					return false;
				}
				
				// call ajax
				if (modal_emp && inp_purpose_type && inp_remark && inp_onduty_purpose) {
					$.ajax({
						url: "php_action/FuncDataCreate.php<?php echo $getPackage; ?>",
						type: form.attr('method'),
						// data: form.serialize(),

						data: new FormData(this),
						// data: formData,
						processData: false,
						contentType: false,
						dataType: 'json',
						success: function(response) {
							// remove the error 
							$(".form-group").removeClass('has-error').removeClass(
								'has-success');
							mymodalss.style.display = "none";
							modals.style.display = "block";
							document.getElementById("msg").innerHTML = response.messages;

							$('#FormDisplayCreate').modal('hide');
							$("[data-dismiss=modal]").trigger({type: "click"});

							// reset the form
							$("#FormDisplayCreate")[0].reset();
							// reload the datatables
							datatable.ajax.reload(null, false);
							// window.location.reload()
							// if (response.success == true) {
								// this function is built in function of datatables;
							// }
						},
						error: function(xhr, status, error) {
							mymodalss.style.display = "none";
							modals.style.display = "block";
							document.getElementById("msg").innerHTML = xhr.responseJSON.messages;
							// var err = eval("(" + xhr.responseText + ")");
							// alert(err.messages);
						}
					});
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

			$("#detail_destination").on('click', function () {
				mymodalss.style.display = "none";
				var modal_emp = $("#modal_emp").val();

				var myarr = modal_emp.split(" ");

				var myvar = myarr[1];

				if (myvar == '') {
					mymodalss.style.display = "none";
					modals.style.display = "block";
					document.getElementById("msg").innerHTML = "Please select employee";
					return false
				}

				var inp_add_startdate = $("#inp_add_startdate").val();
				var inp_add_enddate = $("#inp_add_enddate").val();
				$("#attendance_list").show();



				$(document).ready(function () {
					$("#attendance_list").load(
						"pages_relation/_pages_attendance.php<?php echo $getPackage; ?>inp_add_startdate=" +
						inp_add_startdate + "&inp_add_enddate=" + inp_add_enddate +
						"&src_emp_no=<?php echo $username; ?>",
						function (responseTxt, statusTxt, xhr) {
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

				success: function (response) {

					// $("#settlement_emp_id").val(response.emp_id);
					$("#family_empfamily_id").val(response.empfamily_id);
					$("#family_relationship").val(response.relationship);
					$("#family_name").val(response.name);
					$("#family_gender").val(response.gender);
					$("#family_birth_date").val(response.birthdate);
					$("#family_alivestatus").val(response.alive_status);


					// here update the member data
					$("#FormFamily").unbind('submit').bind('submit', function () {
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
								success: function (response) {

									if (response.code == 'success_message_update') {

										modals.style.display = "block";
										document.getElementById("msg").innerHTML = response
											.messages;

										$("#destination_list").load(
											"pages_relation/_pages_destination.php<?php echo $getPackage; ?>rfid=" +
											response.employee,
											function (responseTxt, statusTxt, jqXHR) {
												if (statusTxt == "success") {
													$("#destination_list").show();
												}
												if (statusTxt == "error") {
													alert("Error: " + jqXHR.status +
														" " + jqXHR.statusText);
												}
											}
										);

									} else {
										modals.style.display = "block";
										document.getElementById("msg").innerHTML = response
											.messages;
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

<!-- detail function -->
<script>
	function detailUpdateOndutyRequest(request_no) {
		$("#list_detail_attendance").hide();
		$("#modalcancelcondition_0").show();
		$("#modalcancelcondition_1").hide();
		$("#modalcancelcondition_2").hide();
		$("#modalcancelcondition_3").hide();
		$('.file-attachment-data').show()
		// remove the error // remove the error 
		$(".form-group").removeClass('has-error').removeClass('has-success');
		$(".text-danger").remove();
		$(".messages_update").html("");
		$('#icon_file_upload').empty();
		$('#detailOnDutyTable').empty();
		$.ajax({
			url: 'php_action/FuncGetDataById.php',
			type: 'GET',
			data: {
				request_no: request_no
			},
			dataType: 'json',
			async: true,
			success: function(response) {
				// $('#FormDisplayDetail')
				$('#detail_emp_no').val(response[0].request_no)
				$('#detail_purpose_type').val(response[0].purpose_code)
				$('#detail_modal_emp').val(response[0].requestfor)
				
				var data_fileupload = response[0].upload_filename
				// alert(response[0].upload_filename)
				// alert(data_fileupload)
				if (data_fileupload == "") {
					// $('#detail_fileupload').removeAttr('download')
					// $('#icon_file_upload').append(`<i class="bi bi-file-x-fill fa-5x"></i>`)
					$('.file-attachment-data').hide()
				} else {
					// $('#detail_fileupload').attr('download')
					let fileExtension = data_fileupload.replace(/^.*\./, '');
					// console.log (fileExtension);
					if (fileExtension == 'pdf') {
						$('#icon_file_upload').append(`<i class="bi bi-filetype-pdf fa-5x"></i>`)
						// $('#data_detail_file').remove()
					} else if (fileExtension == 'doc') {
						$('#icon_file_upload').append(`<i class="bi bi-file-earmark-text fa-5x"></i>`)
						// $('#data_detail_file').remove()
					} else if (fileExtension == 'docx') {
						$('#icon_file_upload').append(`<i class="bi bi-file-earmark-text fa-5x"></i>`)
						// $('#data_detail_file').remove()
					} else {
						$('#icon_file_upload').append(`<img id="data_detail_file" class="img-fluid img-thumbnail" src="" alt="file attachment" width="100" height="140">`)
					}
				}

				$('#detail_fileupload').attr("href", 'hrstudio.presfst/'+data_fileupload)
				$('#data_detail_file').attr("src", 'hrstudio.presfst/'+data_fileupload)
				$('#detail_remark').val(response[0].remark)
				$('#detail_onduty_purpose').val(response[1].destination_no)

				var start_time = moment(response[1].startdate).format('YYYY-MM-DD')
				var end_time = moment(response[1].enddate).format('YYYY-MM-DD')
				$('#detail_add_startdate').val(start_time)
				$('#detail_add_enddate').val(end_time)

				var destination_detail = response[1].destination_detail
				$('#detailOtherDestination').empty()
				if(destination_detail != '') {
					$('#detailOtherDestination').append(`
						<div class="form-row" id="formDestinationDetail" name="formDestinationDetail">
							<div class="col-lg-3 name">Destination Detail <font color="red">*</font>
							</div>
							<div class="col-lg-8">
								<div class="input-group">
									<textarea class="input--style-6 search-input" readonly
										title="">${destination_detail}</textarea>
								</div>
							</div>
						</div>
					`)
				}

				for (var index = 0; index < response[2].length; index++) {
					$('#detailOnDutyTable').append(
						`
							<tr>
								<td style="width:20%;text-align:left;">
									${response[2][index]['startdate'] == null ? '' : moment(response[2][index]['startdate']).format('LL')}
								</td>
								<td style="width:20%;text-align:left;">
									${response[2][index]['startdate'] == null ? '' : moment(response[2][index]['startdate']).format('LTS')}
								</td>
								<td style="width:20%;text-align:left;">
									${response[2][index]['enddate'] == null ? '' : moment(response[2][index]['enddate']).format('LTS')}
								</td>
							</tr>
						`
					)
				}
			}
		})
	}
</script>

<!-- detail approval on duty request -->
<script>
	function detailApproval(request_no) {
		$('#list_user_approval_detail').empty()
		$('.cancel_button').removeAttr('style')

		$.ajax({
			url:'php_action/FuncDetailApproval.php',
			type: 'GET',
			data: {
				request_no: request_no
			},
			dataType: 'json',
			// async: true,
			success: function (response) {

				if (response[2].status_request == 1) {
					$("#cancel_button_0").css("display", "none")
					$("#cancel_button_1").css("display", "none")
					$("#cancel_button_2").css("display", "true")
					$('#cancel_onduty').attr('data-request_no', response[0].request_no)
				} else {
					$("#cancel_button_0").css("display", "true")
					$("#cancel_button_1").css("display", "none")
					$("#cancel_button_2").css("display", "none")
				}
				document.getElementById("detail_request_no").innerHTML = response[0].request_no;
				document.getElementById("detail_full_name").innerHTML = response[0].Full_Name  + " - " + "[" + response[0].emp_no + "]";
				document.getElementById("detail_on_duty").innerHTML = response[0].remark;
				document.getElementById("detail_date_on_duty").innerHTML = response[0].requestdate + " - " + response[0].requestenddate;
				
				// looping detail approval
				var no = 1;

				for (let index = 0; index < response[1].length; index++) {

					$('#list_user_approval_detail').append(
						`
						<tr>
							<td style="width:20%;text-align:left;">
								${no++}
							</td>
							<td style="width:20%;text-align:left;">
								${response[1][index]['Full_Name'] == null ? '' : response[1][index]['Full_Name']} - ${response[1][index]['emp_no'] == null ? '' : response[1][index]['emp_no']}
							</td>
							<td style="width:20%;text-align:left;">
								${response[1][index]['req'] == null ? '' : response[1][index]['req']}
								</td>
							<td style="width:20%;text-align:left;">
								${response[1][index]['status_approve'] == null ? '' : response[1][index]['status_approve']}
							</td>
						</tr>
						`
					);
				}
			}
		});
		
		$('#cancel_onduty').click(function () {
			var request_no = $(this).data('request_no')
			var confirmation = confirm("Are you sure to cancel request " + request_no + " ?")
			if (confirmation == true) {
				$.ajax({
					url: 'php_action/FuncCancelApprovalFromUser.php<?php echo $getPackage; ?>request_no=' + request_no,
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
					},
				})
			}
		});
	}
</script>
</body>

</html>

<script type="text/javascript">
	$(document).ready(function () {
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
	$(document).ready(function () {
		$('#inp_destination_code').focus(function () {
			var query = $(this).val();
			if (query != '') {
				$.ajax({
					url: "search_category.php<?php echo $getPackage; ?>userid=<?php echo $username; ?>",
					method: "POST",
					data: {
						query: query
					},
					success: function (data) {
						$('#category_add_list').fadeIn();
						$('#category_add_list').html(data);

					}
				});
			}
		});
		$('#inp_destination_code').keyup(function () {
			var query = $(this).val();
			if (query != '') {
				$.ajax({
					url: "search_category.php<?php echo $getPackage; ?>userid=<?php echo $username; ?>",
					method: "POST",
					data: {
						query: query
					},
					success: function (data) {
						$('#category_add_list').fadeIn();
						$('#category_add_list').html(data);

					}
				});
			}
		});

		$('#inp_destination_code').mouseover(function () {
			$('#category_add_list').fadeOut();
		});

		$(document).on('click', '.searchterm_category', function () {

			$('#inp_destination_code').val($(this).text());

			$('#category_add_list').fadeOut();

			var inp_destination_code = document.getElementById("inp_destination_code").value;



			var myarr = inp_destination_code.split(" - ");

			var myvar = myarr[0];


			$('#frm_inp_course').show();

			$("#box_add_training_topic").load(
				"pages_relation/_pages_topic.php<?php echo $getPackage; ?>rfid=" + myvar,
				function (responseTxt, statusTxt, jqXHR) {
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

	$(document).ready(function () {
		$('#inp_venue').focus(function () {
			var query = $(this).val();
			if (query != '') {
				$.ajax({
					url: "search_venue.php<?php echo $getPackage; ?>userid=<?php echo $username; ?>",
					method: "POST",
					data: {
						query: query
					},
					success: function (data) {
						$('#venue_add_list').fadeIn();
						$('#venue_add_list').html(data);
					}
				});
			}
		});
		$('#inp_venue').keyup(function () {
			var query = $(this).val();
			if (query != '') {
				$.ajax({
					url: "search_venue.php<?php echo $getPackage; ?>userid=<?php echo $username; ?>",
					method: "POST",
					data: {
						query: query
					},
					success: function (data) {
						$('#venue_add_list').fadeIn();
						$('#venue_add_list').html(data);

					}
				});
			}
		});

		$('#inp_venue').mouseover(function () {
			$('#venue_add_list').fadeOut();
		});

		$(document).on('click', '.searchterm_venue', function () {

			$('#inp_venue').val($(this).text());

			$('#venue_add_list').fadeOut();

			var inp_venue = document.getElementById("inp_venue").value;



			var myarr = inp_venue.split(" - ");

			var myvar = myarr[0];

		});
	});
</script>

<script>
	$(document).ready(function () {
		$('#modal_emp').focus(function () {
			var query = $(this).val();
			if (query != '') {
				$.ajax({
					url: "search.php<?php echo $getPackage; ?>userid=<?php echo $username; ?>",
					method: "POST",
					data: {
						query: query
					},
					success: function (data) {
						$('#employeeList').fadeIn();
						$('#employeeList').html(data);
					}
				});
			}
		});
		$('#modal_emp').keyup(function () {
			var query = $(this).val();
			if (query != '') {
				$.ajax({
					url: "search.php<?php echo $getPackage; ?>userid=<?php echo $username; ?>",
					method: "POST",
					data: {
						query: query
					},
					success: function (data) {
						$('#employeeList').fadeIn();
						$('#employeeList').html(data);
					}
				});
			}
		});

		$('#modal_emp').mouseover(function () {
			$('#employeeList').fadeOut();
		});

		$(document).on('click', 'li', function () {
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

	$(document).ready(function () {
		$('#inp_destination_code').focus(function () {
			var query = $(this).val();
			if (query != '') {
				$.ajax({
					url: "search_category.php<?php echo $getPackage; ?>userid=<?php echo $username; ?>",
					method: "POST",
					data: {
						query: query
					},
					success: function (data) {
						$('#category_add_list').fadeIn();
						$('#category_add_list').html(data);

					}
				});
			}
		});
		$('#inp_destination_code').keyup(function () {
			var query = $(this).val();
			if (query != '') {
				$.ajax({
					url: "search_category.php<?php echo $getPackage; ?>userid=<?php echo $username; ?>",
					method: "POST",
					data: {
						query: query
					},
					success: function (data) {
						$('#category_add_list').fadeIn();
						$('#category_add_list').html(data);

					}
				});
			}
		});

		$('#inp_destination_code').mouseover(function () {
			$('#category_add_list').fadeOut();
		});

		$(document).on('click', '.searchterm_category', function () {

			$('#inp_destination_code').val($(this).text());

			$('#category_add_list').fadeOut();

			var inp_destination_code = document.getElementById("inp_destination_code").value;



			var myarr = inp_destination_code.split(" - ");

			var myvar = myarr[0];


			$('#frm_inp_course').show();

			$("#box_add_training_topic").load(
				"pages_relation/_pages_topic.php<?php echo $getPackage; ?>rfid=" + myvar,
				function (responseTxt, statusTxt, jqXHR) {
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