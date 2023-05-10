<?php
$src_leave_request                 = '';
$src_leave_request_cancel          = '';
if (!empty($_POST['src_leave_request']) && !empty($_POST['src_leave_request_cancel'])) {
	$src_leave_request          = $_POST['src_leave_request'];
	$src_leave_request_cancel   = $_POST['src_leave_request_cancel'];
	$frameworks                 = "src_leave_request=" . "" . $src_leave_request . " &&src_leave_request_cancel=" . "" . $src_leave_request_cancel . "";
} else if (empty($_POST['src_leave_request']) && !empty($_POST['src_leave_request_cancel'])) {
	$src_leave_request          = $_POST['src_leave_request'];
	$src_leave_request_cancel   = $_POST['src_leave_request_cancel'];
	$frameworks                 = "src_leave_request_cancel=" . "" . $src_leave_request_cancel . "";
} else if (!empty($_POST['src_leave_request']) && empty($_POST['src_leave_request_cancel'])) {
	$src_leave_request          = $_POST['src_leave_request'];
	$src_leave_request_cancel   = $_POST['src_leave_request_cancel'];
	$frameworks                 = "src_leave_request=" . "" . $src_leave_request . "";
}
?>
<!-- Modal -->
<div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2"
	data-backdrop="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">

				<a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close"
					style="margin-top: -15px;">
					<span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
				</a>
				<form method="post" id="myform">
					<fieldset id="fset_1" style="margin-top: 25px;border-radius: 5px;border: 1px solid #e4e8ea;">
						<legend>Searching</legend>
						<div class="form-row">
							<div class="col-4 name">Leave Request</div>
							<div class="col-sm-8">
								<div class="input-group">

									<input class="input--style-6" autocomplete="off" autofocus="on"
										id="src_leave_request" name="src_leave_request" id="src_leave_request"
										type="Text" value="<?php echo $src_leave_request; ?>" onfocus="hlentry(this)"
										size="30" maxlength="50" validate="NotNull:Invalid Form Entry"
										onchange="formodified(this);" title="">
								</div>
							</div>
						</div>

						<div class="form-row" style="display:none;">
							<div class="col-4 name">Leave Cancel Request</div>
							<div class="col-sm-8">
								<div class="input-group">

									<input class="input--style-6" autocomplete="off" autofocus="on"
										name="src_leave_request_cancel" id="src_leave_request_cancel" type="Text"
										value="<?php echo $src_leave_request_cancel; ?>" onfocus="hlentry(this)"
										size="30" maxlength="50" validate="NotNull:Invalid Form Entry"
										onchange="formodified(this);" title="">
								</div>
							</div>
						</div>

					</fieldset>
					<button type="submit" name="submit_add" id="submit_add" type="button"
						class="btn btn-warning button_bot">
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

<!-- cdn select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- end cdn select2 -->

<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>


<script type="text/javascript">
	$(document).ready(function () {
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
	// global the manage memeber table s
	$(document).ready(function () {
		datatable = $("#datatable<?php echo $platform; ?>").DataTable({

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
			"ajax": "php_action/FuncDataRead<?php echo $platform; ?>.php<?php echo $getPackage; ?><?php echo $frameworks; ?>"
		});
	});
</script>


<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>





<?php
if ($platform != 'mobile') {         
?>

<div class="col-md-12">
	<div class="card">
		<div class="card-header d-flex align-items-center">
			<h4 class="card-title mb-0">Leave Request </h4>

			<?php } else if ($platform == 'mobile') { ?>

			<div class="col-md-12">
				<div class="card" style="border-radius: 20px 20px 20px 20px;margin-bottom: 25px;">
					<div class="card-header d-flex align-items-center" style="border-bottom: 1px solid white;">
						<h4 class="card-title mb-0">Leave Request </h4>
						<?php } ?>

						<div class="card-actions ml-auto">
							<table>
								<td>
									<a href='#' class='open_modal_search' class="btn btn-demo" data-toggle="modal"
										data-target="#myModal2">
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

								<td>
									<div class="toolbar sprite-toolbar-add" title="Add" data-toggle="modal"
										data-target="#CreateForm" id="CreateButton" data-keyboard="false"
										data-backdrop="static">
										<!-- <a title="add" href="" class="toolbar sprite-toolbar-add" data-toggle="modal" data-target="#CreateForm" id="CreateButton" data-keyboard="false" data-backdrop="static">tambah</a> -->
									</div>
								</td>

							</table>



						</div>

					</div>

					<br>

					<?php
						$leave = mysqli_fetch_assoc(mysqli_query($connect, "SELECT SUM(remaining) as total,  SUM(entitlement) as total_entitlement,ROUND(SUM(remaining) / SUM(entitlement)*100) AS daty FROM hrmempleavebal WHERE leave_code = 'ANL' AND emp_id=(SELECT emp_id FROM view_employee WHERE emp_no='$username') and active_status='1'"));
					?>

					<?php
					if ($platform != 'mobile') {
					?>
					<div class="card-body table-responsive p-0"
						style="width: 100vw;height: 78vh; width: 98.8%; margin: 5px;overflow: scroll;">
						<table id="datatable" width="100%" border="1" align="left"
							class="table table-bordered table-striped table-hover table-head-fixed">
							<thead>
								<tr>
									<th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No.</th>
									<th class="fontCustom" style="z-index: 1;">Request Number</th>
									<th class="fontCustom" style="z-index: 1;">Request For</th>
									<th class="fontCustom" style="z-index: 1;">Type of Leave</th>
									<th class="fontCustom" style="z-index: 1;">Start Date</th>
									<th class="fontCustom" style="z-index: 1;">End Date</th>
									<th class="fontCustom" style="z-index: 1;">Total Days</th>
									<th class="fontCustom" style="z-index: 1;">Remark</th>
									<th class="fontCustom" style="z-index: 1;">Urgent</th>
									<th class="fontCustom" style="z-index: 1;">Request Status</th>
									<th class="fontCustom" style="z-index: 1;">Attachment</th>
									<th class="fontCustom" style="z-index: 1;">Approval Status</th>
								</tr>

							</thead>
						</table>
					</div>

					<div class='card-footer' style='background-color: #eee;height: 37px;padding-top: 5px;'></div>

					<?php } else if ($platform == 'mobile') { ?>

					<div class="col-sm-12 name">
						<div class="progress-container progress-info">
							<div class="col-sm-5 name">
								<span class="progress-badge"
									style="font-size: 10px;font-family: verdana;font-weight: bold;letter-spacing: -0.9px; color:#cacaca !important;">Leave
									Balance <br> Annual Leave&nbsp;&nbsp;&nbsp; <?php echo $leave['total']; ?> /
									<?php echo $leave['total_entitlement']; ?></span>
							</div>

							<div class="progress">
								<div class="progress-bar progress-bar-info1" role="progressbar" aria-valuenow="80"
									aria-valuemin="0" aria-valuemax="100"
									style="width: <?php echo $leave['daty']; ?>%;cursor: pointer;" data-toggle="modal"
									data-target="#LeaveBalances" data-backdrop="static" onclick="BalancesDetail(`ANL`)">
								</div>
							</div>
						</div>
					</div>

					<br>


					<div class="card-body table-responsive p-0"
						style="width: 90vw;height: 78vh; margin: 5px;overflow: hidden;border: 1px solid white;">
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
							<h4 class="modal-title">Add Leave Request</h4>
							<a type="button" class="close" onclick='return stopload()' data-dismiss="modal"
								aria-label="Close" style="margin-top: -15px;">
								<span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
							</a>
						</div>

						<form class="form-horizontal" action="php_action/FuncDataCreate.php<?php echo $getPackage; ?>"
							method="POST" id="FormDisplayCreate">

							<div class="card-body table-responsive p-0"
								style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

								<fieldset id="fset_1">
									<legend>Leave Entry Form</legend>

									<div class="messages_create"></div>
									<?php
										$emp = mysqli_fetch_array(mysqli_query($connect, "SELECT full_name, pos_name_en FROM view_employee WHERE emp_no='$username'"));
                                          // echo "SELECT full_name, pos_name_en FROM view_employee WHERE emp_no='$username'";
									?>

									<div class="form-row" id="frm_employee_no">
										<div class="col-sm-2 name">Employee No. <font color="red">*</font>
										</div>
										<div class="col-sm-8">
											<div class="input-group">
												<input class="input--style-6 search-input"
													onkeyup="isi_otomatis(), isi_otomatis_leave()"
													onfocus="this.value=''" autocomplete="off" autofocus="on"
													id="modal_emp" name="modal_emp" type="Text"
													value=" <?php echo $username; ?> [ <?php echo $emp['full_name']; ?> ] <?php echo $emp['pos_name_en']; ?>"
													size="30" maxlength="50" validate="NotNull:Invalid Form Entry"
													onchange="formodified(this);" title="">
												<div id="employeeList"></div>
											</div>
										</div>
									</div>

									<div class="form-row">
										<div class="col-sm-2 name">Type of Leave*</div>
										<div class="col-sm-8">
											<div class="input-group">

												<select class="input--style-6 modal_leave" name="modal_leave"
													style="width: 50%;height: 30px;" id="modal_leave"
													onchange="isi_otomatis_leave()">
													<option value="">--Select One--</option>
													<?php
														$sql = mysqli_query($connect, "SELECT 
															a.leave_code,
															c.leavename_en
															FROM 
															hrmempleavebal a
															LEFT JOIN view_employee b ON a.emp_id=b.emp_id
															LEFT JOIN ttamleavetype c ON a.leave_code=c.leave_code
															WHERE b.emp_no = '$username'
															AND 
															('$SFdate' BETWEEN DATE(a.startvaliddate) AND DATE(a.endvaliddate) OR
															DATE(a.startvaliddate) < '$SFdate')
															GROUP BY a.leave_code
															ORDER BY a.leave_code ASC");
														while ($row = mysqli_fetch_array($sql)) {
															echo '<option value="' . $row['leave_code'] . '">' . $row['leavename_en'] . '</option>';
														}
														?>
												</select>
											</div>
										</div>
									</div>

									<div class="form-row" style="display:none;" id="inp_leavebalances_amount">
										<div class="col-sm-2 name">Balance*</div>
										<div class="col-sm-10">
											<div id="box_leavebalances"></div>
										</div>
									</div>

									<div class="form-row">
										<div class="col-sm-2 name">Date of Leave*</div>
										<div class="col-sm-4" style="padding-bottom:5px">
											<div class="input-group">

												<input type="text" id="modal_leave_start" class="input--style-6"
													onchange="isi_otomatis_leave()" name="modal_leave_start" style="
													background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
													background-size: 17px;
													background-position:right;   
													background-repeat:no-repeat; 
													padding-right:10px;  
													" autocomplete="off" />
											</div>
										</div>

										<div class="col-sm-3">
											<div class="input-group">
												<select class="input--style-6"
													style='display:none;height: 30px;width:150px'
													id="inp_hdtype_starttime" name="inp_hdtype_starttime"
													onfocus="hlentry(this)" onchange="formodified(this);">
													<option value="3" style="display: none;">Full Day</option>
													<option value="3">Full Day</option>
													<option value="1">First Half</option>
													<option value="2">Second Half</option>
												</select>
												<select class="input--style-6"
													style='display:none;height: 30px;width:150px'
													id="inp_hdtype_starttime_formmodified"
													name="inp_hdtype_starttime_formmodified" onfocus="hlentry(this)"
													onchange="formodified(this);">
													<option value="3" style="display: none;">Full Day</option>
													<option value="3">Full Day</option>
													<option value="2">Second Half</option>
												</select>

												<!-- UNTUK TIPE PART OF DAY / JAM JAMAN -->
												<!-- UNTUK TIPE PART OF DAY / JAM JAMAN -->
												<input class="input--style-6"
													style="display:none; margin-bottom: 2px; width: 90px;"
													id="inp_pdtype_starttime" name="inp_pdtype_starttime"
													placeholder="HH:ii" value="00:00"
													pattern="([0-1]{1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}">
												<!-- UNTUK TIPE PART OF DAY / JAM JAMAN -->
												<!-- UNTUK TIPE PART OF DAY / JAM JAMAN -->
											</div>
										</div>
									</div>

									<div class="form-row">
										<div class="col-sm-2 name">To</div>
										<div class="col-sm-4" style="padding-bottom:5px">
											<div class="input-group">

												<input class="input--style-6" maxlength="10" type="text"
													onchange="isi_otomatis_leave()" style="
													background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
													background-size: 17px;
													background-position:right;   
													background-repeat:no-repeat; 
													padding-right:10px;  
													" id="modal_leave_end"
													name="modal_leave_end" autocomplete="off" />
											</div>
										</div>

										<div class="col-sm-3">
											<div class="input-group">
												<select class="input--style-6"
													style='display:none;height: 30px;width:150px'
													id="inp_hdtype_endtime" name="inp_hdtype_endtime"
													onfocus="hlentry(this)" onchange="formodified(this);">
													<option value="3">Full Day</option>
													<option value="1">First Half</option>
													<option value="2">Second Half</option>
												</select>
												<input id="inp_hdtype_endtime_formmodified"
													name="inp_hdtype_endtime_formmodified" type="hidden"
													value="noselect">
												<!--FROM SESSION -->

												<!-- UNTUK TIPE PART OF DAY / JAM JAMAN -->
												<!-- UNTUK TIPE PART OF DAY / JAM JAMAN -->
												<input class="input--style-6"
													style="display:none; margin-bottom: 2px; width: 90px;"
													id="inp_pdtype_endtime" name="inp_pdtype_endtime"
													placeholder="HH:ii" value="00:00"
													pattern="([0-1]{1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}">
												<!-- UNTUK TIPE PART OF DAY / JAM JAMAN -->
												<!-- UNTUK TIPE PART OF DAY / JAM JAMAN -->
											</div>
										</div>

									</div>

									<div class="form-row">
										<div class="col-sm-2 name">Remark*</div>
										<div class="col-sm-8">
											<div class="input-group">
												<textarea class="textarea--style-6" id="inp_remark" name="inp_remark"
													placeholder="Remark of Leave"></textarea>
											</div>
										</div>
									</div>

									<div class="form-row" id="tr_inp_leaveisurgent" style='display:none;'>
										<div class="col-sm-2 name">Urgent? </div>
										<div class="col-sm-8">
											<div class="input-group" id="tr_inp_urgent_on">
												<div class="vc-toggle-container">
													<label class="vc-switch">
														<input type="checkbox" name="inp_urgents" id="inp_urgent_on"
															value='1' class="vc-switch-input"
															onchange="isi_otomatis_leave()" />
														<input type="hidden" checked="checked" name="inp_urgent_decl"
															id="inp_urgent_on_back" value='0'
															class="vc-switch-input hidden"
															onchange="isi_otomatis_leave()" />
														<span class="vc-switch-label" data-on="Yes"
															data-off="No"></span>
														<span class="vc-handle"></span>
													</label>
												</div>
											</div>
											<div class="input-group" id="tr_inp_urgent_off" style='display:none;'>
												<div class="vc-toggle-container">
													<label class="vc-switch">
														<input type="checkbox" checked="checked" name="inp_urgent"
															id="inp_urgent_off" value='1' class="vc-switch-input"
															onchange="isi_otomatis_leave()" />

														<span class="vc-switch-label" data-on="Yes"
															data-off="No"></span>
														<span class="vc-handle"></span>
													</label>
												</div>

											</div>
										</div>
									</div>

									<div class="form-row urgent_reason_additional" style='display:none;'>
										<div class="col-sm-2 name">Urgent Reason*</div>
										<div class="col-sm-8">
											<div class="input-group">

												<select class="input--style-6 urgent_reason" name="urgent_reason"
													style="width: 50%;height: 30px;" id="urgent_reason"
													onchange="isi_otomatis_leave()">
													<option value="">--Select One--</option>
													<?php
														$sql = mysqli_query($connect, "SELECT 
														a.reason_code,
														a.reason_name
													FROM hrmleaveurgreason a
													GROUP BY a.reason_name
													ORDER BY a.reason_name ASC;");
														while ($row = mysqli_fetch_array($sql)) {
															echo '<option value="' . $row['reason_code'] . '">' . $row['reason_name'] . '</option>';
														}
														?>
												</select>
											</div>
										</div>
									</div>

								</fieldset>

							</div>

							<div class="modal-footer-sdk">
								<button type="reset" class="btn-sdk btn-primary-left" data-dismiss="modal"
									aria-hidden="true">
									&nbsp;Cancel&nbsp;
								</button>
								<button class="btn-sdk btn-primary-right" type="submit" name="submit_update"
									id="submit_update">
									Confirm
								</button>
								<button class="btn-sdk btn-primary-right" type="button" name="submit_update2"
									id="submit_update2" style='display:none;' disabled>
									<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
									&nbsp;&nbsp;Processing..
								</button>
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

		<!-- add modal -->
		<div class="modal  fade fade-custom" tabindex="-1" role="dialog" id="RevisedForm">
			<div class="modal-dialog modal-belakang modal-bg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="revised_title">Revised Leave Request</h4>
						<a type="button" class="close" onclick='return stopload()' data-dismiss="modal"
							aria-label="Close" style="margin-top: -15px;">
							<span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
						</a>
					</div>

					<form class="form-horizontal" action="php_action/FuncDataRevised.php<?php echo $getPackage; ?>"
						method="POST" id="FormDisplayRevised">

						<div class="card-body table-responsive p-0"
							style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

							<fieldset id="fset_1">
								<legend>Leave Revised</legend>

								<div class="messages_Revised"></div>



								<?php
									$emp = mysqli_fetch_array(mysqli_query($connect, "SELECT full_name, pos_name_en FROM view_employee WHERE emp_no='$username'"));
									?>

								<mark style="margin-left: 6px;"><code id="revised_remark">Revised Remark :
									</code></mark>

								<div class="form-row" style="display:none;">
									<div class="col-sm-2 name">Employee No. <font color="red">*</font>
									</div>
									<div class="col-sm-8">
										<div class="input-group">

											<input class="input--style-6 search-input"
												onkeyup="isi_otomatis(), isi_otomatis_leave_revised()"
												onfocus="this.value=''" autocomplete="off" autofocus="on" id="modal_emp"
												name="modal_emp" type="Text"
												value=" <?php echo $username; ?> [ <?php echo $emp['full_name']; ?> ] <?php echo $emp['pos_name_en']; ?>"
												size="30" maxlength="50" validate="NotNull:Invalid Form Entry"
												onchange="formodified(this);" title="">
											<div id="employeeList"></div>
										</div>
									</div>
								</div>


								<div class="form-row">
									<div class="col-sm-2 name">Type of Leave*</div>
									<div class="col-sm-8">
										<div class="input-group">

											<select class="input--style-6 modal_leave_revised"
												name="modal_leave_revised" style="width: 50%;height: 30px;"
												id="modal_leave_revised" onchange="isi_otomatis_leave_revised()">
												<option value="">--Select One--</option>
												<?php
													$sql = mysqli_query($connect, "SELECT 
														a.leave_code,
														c.leavename_en
														FROM 
														hrmempleavebal a
														LEFT JOIN view_employee b ON a.emp_id=b.emp_id
														LEFT JOIN ttamleavetype c ON a.leave_code=c.leave_code
														WHERE b.emp_no = '$username'
														AND 
														('$SFdate' BETWEEN DATE(a.startvaliddate) AND DATE(a.endvaliddate) OR
														DATE(a.startvaliddate) < '$SFdate')
														GROUP BY a.leave_code
														ORDER BY a.leave_code ASC");

													while ($row = mysqli_fetch_array($sql)) {
															echo '<option value="' . $row['leave_code'] . '">' . $row['leavename_en'] . '</option>';
													}
													?>
											</select>
										</div>
									</div>
								</div>

								<div class="form-row" style="display:none;" id="inp_revised_leavebalances_amount">
									<div class="col-sm-2 name">Balance*</div>
									<div class="col-sm-10">
										<div id="box_leavebalances_revised"></div>
									</div>
								</div>

								<div class="form-row">
									<div class="col-sm-2 name">Date of Leave*</div>
									<div class="col-sm-4" style="padding-bottom:5px">
										<div class="input-group">

											<input type="text" id="modal_revised_leave_start" class="input--style-6"
												onchange="isi_otomatis_leave_revised()" name="modal_revised_leave_start"
												style="
												background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
												background-size: 17px;
												background-position:right;   
												background-repeat:no-repeat; 
												padding-right:10px;  
												" autocomplete="off" />
										</div>
									</div>

									<div class="col-sm-3">
										<div class="input-group">
											<select class="input--style-6" style='display:none;height: 30px;width:150px'
												id="inp_revised_hdtype_starttime" name="inp_revised_hdtype_starttime"
												onfocus="hlentry(this)" onchange="formodified(this);">
												<option value="3" style="display: none;">Full Day</option>
												<option value="3">Full Day</option>
												<option value="1">First Half</option>
												<option value="2">Second Half</option>
											</select>
											<select class="input--style-6" style='display:none;height: 30px;width:150px'
												id="inp_revised_hdtype_starttime_formmodified"
												name="inp_revised_hdtype_starttime_formmodified" onfocus="hlentry(this)"
												onchange="formodified(this);">
												<option value="3" style="display: none;">Full Day</option>
												<option value="3">Full Day</option>
												<option value="2">Second Half</option>
											</select>

											<!-- UNTUK TIPE PART OF DAY / JAM JAMAN -->
											<!-- UNTUK TIPE PART OF DAY / JAM JAMAN -->
											<input class="input--style-6"
												style="display:none; margin-bottom: 2px; width: 90px;"
												id="inp_revised_pdtype_starttime" name="inp_revised_pdtype_starttime"
												placeholder="HH:ii" value="00:00"
												pattern="([0-1]{1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}">
											<!-- UNTUK TIPE PART OF DAY / JAM JAMAN -->
											<!-- UNTUK TIPE PART OF DAY / JAM JAMAN -->
										</div>
									</div>
								</div>

								<div class="form-row">
									<div class="col-sm-2 name">To</div>
									<div class="col-sm-4" style="padding-bottom:5px">
										<div class="input-group">

											<input class="input--style-6" maxlength="10" type="text"
												onchange="isi_otomatis_leave_revised()" style="
												background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
												background-size: 17px;
												background-position:right;   
												background-repeat:no-repeat; 
												padding-right:10px;  
												" id="modal_revised_leave_end"
												name="modal_revised_leave_end" autocomplete="off" />
										</div>
									</div>

									<div class="col-sm-3">
										<div class="input-group">
											<select class="input--style-6"
												style='display:nonea;height: 30px;width:150px'
												id="inp_revised_hdtype_endtime" name="inp_revised_hdtype_endtime"
												onfocus="hlentry(this)" onchange="formodified(this);">
												<option value="3">Full Day</option>
												<option value="1">First Half</option>
												<option value="2">Second Half</option>
											</select>
											<input id="inp_revised_hdtype_endtime_formmodified"
												name="inp_revised_hdtype_endtime_formmodified" type="hiddena"
												value="noselect">
											<!--FROM SESSION -->

											<!-- UNTUK TIPE PART OF DAY / JAM JAMAN -->
											<!-- UNTUK TIPE PART OF DAY / JAM JAMAN -->
											<input class="input--style-6"
												style="display:none; margin-bottom: 2px; width: 90px;"
												id="inp_revised_pdtype_endtime" name="inp_revised_pdtype_endtime"
												placeholder="HH:ii" value="00:00"
												pattern="([0-1]{1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}">
											<!-- UNTUK TIPE PART OF DAY / JAM JAMAN -->
											<!-- UNTUK TIPE PART OF DAY / JAM JAMAN -->
										</div>
									</div>

								</div>

								<div class="form-row">
									<div class="col-sm-2 name">Remark*</div>
									<div class="col-sm-8">
										<div class="input-group">
											<textarea class="textarea--style-6" id="inp_revised_remark"
												name="inp_revised_remark" placeholder="Remark of Leave"></textarea>
										</div>
									</div>
								</div>

								<div class="form-row" id="tr_inp_revised_leaveisurgent" style='display:none;'>
									<div class="col-sm-2 name">Urgent? </div>
									<div class="col-sm-8">
										<div class="input-group" id="tr_inp_revised_urgent_on">
											<div class="vc-toggle-container">
												<label class="vc-switch">
													<input type="checkbox" name="inp_revised_urgents"
														id="inp_revised_urgent_on" value='1' class="vc-switch-input"
														onchange="isi_otomatis_leave_revised()" />
													<input type="hidden" checked="checked"
														name="inp_revised_urgent_decl" id="inp_revised_urgent_on_back"
														value='0' class="vc-switch-input hidden"
														onchange="isi_otomatis_leave_revised()" />
													<span class="vc-switch-label" data-on="Yes" data-off="No"></span>
													<span class="vc-handle"></span>
												</label>
											</div>
										</div>
										<div class="input-group" id="tr_inp_revised_urgent_off" style='display:none;'>
											<div class="vc-toggle-container">
												<label class="vc-switch">
													<input type="checkbox" checked="checked" name="inp_revised_urgent"
														id="inp_revised_urgent_off" value='1' class="vc-switch-input"
														onchange="isi_otomatis_leave_revised()" />

													<span class="vc-switch-label" data-on="Yes" data-off="No"></span>
													<span class="vc-handle"></span>
												</label>
											</div>

										</div>
									</div>
								</div>

							</fieldset>

						</div>

						<div class="modal-footer-sdk">
							<button type="reset" class="btn-sdk btn-primary-left" data-dismiss="modal"
								aria-hidden="true">
								&nbsp;Cancel&nbsp;
							</button>
							<button class="btn-sdk btn-primary-right" type="submit" name="submit_update"
								id="submit_update">
								Confirm
							</button>
							<button class="btn-sdk btn-primary-right" type="button" name="submit_update2"
								id="submit_update2" style='display:none;' disabled>
								<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
								&nbsp;&nbsp;Processing..
							</button>
						</div>

						<!-- ==================================================================================================== -->
						<!-- ==================================================================================================== -->
						<input id="inp_revised_emp_no" name="inp_revised_emp_no" type="hidden"
							value="<?php echo $username; ?>">
						<!--FROM SESSION -->
						<input id="inp_revised_request_no" name="inp_revised_request_no" type="hidden">
						<!--FROM SESSION -->
						<input id="inp_revised_token" name="inp_revised_token" type="hidden"
							value="<?php echo $get_token; ?>">
						<!--FROM CONFIGURATION -->
						<input id="inp_revised_requestfor" name="inp_revised_requestfor" type="hidden">
						<!--FROM CONFIGURATION -->
						<input id="inp_revised_leaverequestv" name="inp_revised_leaverequestv" type="hidden">
						<!--FROM CONFIGURATION -->
						<input id="inp_revised_daytype" name="inp_revised_daytype" type="hidden">
						<!--FROM CONFIGURATION -->
						<input id="inp_revised_summaryleavebalance" name="inp_revised_summaryleavebalance"
							type="hidden">
						<!--FROM CONFIGURATION -->
						<input id="inp_revised_deductedleave" name="inp_revised_deductedleave" type="hidden">
						<!--FROM CONFIGURATION -->
						<!-- ==================================================================================================== -->
						<!-- ==================================================================================================== -->

					</form>
				</div>
			</div>
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<!-- /edit modal -->

	<!-- add modal -->
	<div class="modal  fade fade-custom" tabindex="-1" role="dialog" id="AttachmentForm">
		<div class="modal-dialog modal-belakang modal-bg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="Attachment_title">Attachment Form</h4>
					<a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close"
						style="margin-top: -15px;">
						<span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
					</a>
				</div>

				<form id="form-data">

					<div class="card-body table-responsive p-0"
						style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

						<fieldset id="fset_1">
							<legend>Leave Attachment</legend>

							<div class="messages_Attachment"></div>

							<div class="form-row">
								<div class="col-sm-2 name">File Attachment <font color="red">*</font>
								</div>
								<div class="col-sm-8 name">
									<div class="input-group">
										<input type="file" name="fileupload" id="fileupload" class="form-control" />
									</div>
								</div>
							</div>
						</fieldset>



						<div class="col-sm-12 name">
							<div id="box_attachment"></div>
						</div>

					</div>

					<div class="modal-footer-sdk">
						<button type="reset" class="btn-sdk btn-primary-left" data-dismiss="modal" aria-hidden="true">
							&nbsp;Cancel&nbsp;
						</button>
						<a class="btn-sdk btn-primary-right" style="padding-top: 7px;" type="submit"
							name="submit_update" name="upload" id="upload">
							Upload file
						</a>
					</div>

					<!-- ==================================================================================================== -->
					<!-- ==================================================================================================== -->
					<input id="inp_Attachment_request_no" name="inp_Attachment_request_no" type="hidden">
					<!--FROM SESSION -->
					<input id="inp_Attachment_token" name="inp_Attachment_token" type="hidden"
						value="<?php echo $get_token; ?>">
					<!--FROM CONFIGURATION -->
					<input id="inp_Attachment_emp_no" name="inp_Attachment_emp_no" type="hidden"
						value="<?php echo $username; ?>">
					<!--FROM CONFIGURATION -->
					<!-- ==================================================================================================== -->
					<!-- ==================================================================================================== -->

				</form>
			</div>
		</div>
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /edit modal -->

<!-- add modal -->
<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="FormDisplayLeaveApproval">
	<div class="modal-dialog modal-belakang modal-bs modal-med" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Leave Approval</h4>
				<a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close"
					style="margin-top: -15px;">
					<span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
				</a>
			</div>

			<div class="card-body table-responsive p-0"
				style="width: 100vw;height: 50vh; width: 99%; margin: 5px;overflow: scroll;overflow-x: hidden;">

				<form class="form-horizontal" action="php_action/FuncDataUpdate.php<?php echo $getPackage; ?>"
					method="POST" id="updatedelMemberForm">

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
								<div class="input-group" id="sel_identity_request_no"
									style="font-weight: bold;color: #5b5b5b;">
								</div>
							</div>
						</div>

						<div class="form-row">
							<div class="col-sm-4 name"> Employee <span class="required">*</span></div>
							<div class="col-sm-8 name">
								<div class="input-group" id="sel_identity_requester"
									style="font-weight: bold;color: #5b5b5b;">
								</div>
							</div>
						</div>

						<div class="form-row">
							<div class="col-sm-4 name"> Detail Leave <span class="required">*</span></div>
							<div class="col-sm-8 name">
								<div class="input-group" id="sel_identity_leave_code"
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
							<!-- pages relation -->
							<div id="box_approval_request_detail"></div>
							<!-- pages relation -->
							<div>
							</div>

					</fieldset>
			</div>

			<!-- //LOAD BUTTON APPROVER STATUS -->
			<div class="modal-footer-sdk" id="modalcancelcondition_0">
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
				<a id="cancellation_id" style="padding-top: 8px;" class="btn-sdk btn-primary-right delete" type="submit"
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

<!-- isi JSON -->
<script type="text/javascript">	// global the manage memeber table 
	$(document).ready(function () {
		$("#CreateButton").on('click', function () {


			// alert("newConf");
			// reset the form 
			$("#FormDisplayCreate")[0].reset();
			// empty the message div

			$(".messages_create").html("");

			// submit form
			$("#FormDisplayCreate").unbind('submit').bind('submit', function () {

				mymodalss.style.display = "block";

				$(".text-danger").remove();

				var form = $(this);

				var inp_emp_no = $("#inp_emp_no").val();
				var $inp_token = $("#inp_token").val();
				var inp_requestfor = $("#inp_requestfor").val();
				var $inp_leaverequestv = $("#inp_leaverequestv").val();
				var inp_remark = $("#inp_remark").val();
				var modal_leave_start = $("#modal_leave_start").val();
				var modal_leave_end = $("#modal_leave_end").val();
				var inp_daytype = $("#inp_daytype").val();
				var inp_pdtype_starttime = $("#inp_pdtype_starttime").val();
				var inp_pdtype_endtime = $("#inp_pdtype_endtime").val();
				var from = new Date(modal_leave_start).getTime();
				var to = new Date(modal_leave_end).getTime();

				var regex = /^[a-zA-Z]+$/;

				if (from > to) {
					mymodalss.style.display = "none";
					modals.style.display = "block";
					document.getElementById("msg").innerHTML =
						"Entry Date: Enter Date in Proper Range";
					return false;

				} else if (inp_requestfor == '') {
					mymodalss.style.display = "none";
					modals.style.display = "block";
					document.getElementById("msg").innerHTML = "Request for empty";
					return false;

				} else if (inp_leaverequestv == '') {
					mymodalss.style.display = "none";
					modals.style.display = "block";
					document.getElementById("msg").innerHTML = "Leave request empty";
					return false;

				} else if (modal_leave_start == '') {
					mymodalss.style.display = "none";
					modals.style.display = "block";
					document.getElementById("msg").innerHTML = "Leave start empty";
					return false;

				} else if (modal_leave_end == '') {
					mymodalss.style.display = "none";
					modals.style.display = "block";
					document.getElementById("msg").innerHTML = "Leave start empty";
					return false;

				} else if (inp_remark == '') {
					mymodalss.style.display = "none";
					modals.style.display = "block";
					document.getElementById("msg").innerHTML = "Remark cannot empty";
					return false;

				} else if (inp_daytype == "PD" && (inp_pdtype_starttime == '00:00' ||
						inp_pdtype_endtime == '00:00')) {
					mymodalss.style.display = "none";
					modals.style.display = "block";
					document.getElementById("msg").innerHTML = "Please insert time";
					return false;

				} else if (inp_daytype == "PD" && from < to) {
					mymodalss.style.display = "none";
					modals.style.display = "block";
					document.getElementById("msg").innerHTML =
						"Partial Day Permit just allowing max 5 Hours";
					return false;

				}

				if (inp_requestfor && inp_leaverequestv && inp_remark && modal_leave_start && modal_leave_end) {

					//submi the form to server
					$.ajax({
						url: form.attr('action'),
						type: form.attr('method'),
						// data: form.serialize(),

						data: new FormData(this),
						processData: false,
						contentType: false,

						dataType: 'json',
						success: function (response) {

							// remove the error 
							$(".form-group").removeClass('has-error').removeClass(
								'has-success');

							if (response.code == 'success_message') {
								mymodalss.style.display = "none";
								mymodals_withhref.style.display = "block";
								document.getElementById("msg_href").innerHTML =
									response.messages;

								// reset the form
								$("#FormDisplayCreate")[0].reset();
								// reload the datatables
								datatable.ajax.reload(null, false);
								// this function is built in function of datatables;
							} else {
								mymodalss.style.display = "none";
								modals.style.display = "block";
								document.getElementById("msg").innerHTML = response
									.messages;

								$('#submit_add').show();
								$('#submit_add2').hide();

								window.setTimeout(
									function () {
										$(".alert")
											.fadeTo(
												500,
												0
											)
											.slideUp(
												500,
												function () {
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

	$('#modal_leave').select2({
		dropdownParent: $('#CreateForm')
	})

	$('#urgent_reason').select2({
		dropdownParent: $('#CreateForm')
	})

	$('#inp_urgent_on').on('change', function() {
		var isi = $('#inp_urgent_on').val()
		$('.urgent_reason_additional').show()
	})
	
	$('#inp_urgent_off').on('change', function() {
		var isi = $('#inp_urgent_on_back').val()
		$('.urgent_reason_additional').hide()
	})

	// if($('#tr_inp_leaveisurgent').is(':hidden') && $('#modal_leave').val() == '') {
	// 	$('#urgent_reason_additional').hide()
	// }

	$('#modal_leave').on('change', function() {
		if($(this).val() == '') {
			$('#tr_inp_leaveisurgent').hide()
			$('.urgent_reason_additional').hide()
			$("#tr_inp_urgent_on").show();
			$("#tr_inp_urgent_off").hide();
			$("#tr_inp_urgent_reason").hide();
			$('#inp_urgent_off').prop('checked', true);
			document.getElementById("inp_urgent_on_back").setAttribute("name", "inp_urgent_decl");
			document.getElementById("inp_urgent_off").setAttribute("name", "hidden");
		}

	// 	// if(('#tr_inp_leaveisurgent').css('display') == 'none') {
			
	// 	// }
	})

	function RevisedForm(id = null) {
		mymodalss.style.display = "block";

		if (id) {
			$.ajax({
				url: 'php_action/getSelectedRequest.php<?php echo $getPackage; ?>',
				type: 'post',
				data: {
					member_id: id
				},
				dataType: 'json',
				success: function (response) {

					mymodalss.style.display = "none";


					document.getElementById("revised_title").innerHTML = "Revised for : " + response
					.request_no;
					document.getElementById("revised_remark").innerHTML = "Revised Remark : " + response
						.remarkfromrevised;




					$("#inp_revised_requestfor").val(response.emp_no);
					$("#inp_revised_leaverequestv").val(response.leave_code);
					$("#inp_revised_request_no").val(response.request_no);
					$("#modal_leave_revised").val(response.leave_code);
					$("#modal_revised_leave_start").val(response.leave_startdates_print);
					$("#modal_revised_leave_end").val(response.leave_enddates_print);
					$("#inp_revised_remark").val(response.remark_req);
					$("#inp_revised_hdtype_starttime").val(response.hd_start);
					$("#inp_revised_hdtype_starttime_formmodified").val(response.hd_start);
					$("#inp_revised_daytype").val(response.daytype);

					var modal_leave_start = $("#modal_revised_leave_start").val();
					var modal_leave_end = $("#modal_revised_leave_end").val();
					var from = new Date(modal_leave_start).getTime();
					var to = new Date(modal_leave_end).getTime();

					$("#box_approval_request_detail").load(
						"pages_relation/_pages_approval.php<?php echo $getPackage; ?>rfid=" + response
						.request_no,
						function (responseTxt, statusTxt, jqXHR) {
							if (statusTxt == "success") {
								$("#box_approval_request_detail").show();
							}
							if (statusTxt == "error") {
								alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
							}
						}
					);

					$("#box_leavebalances_revised").load(
						"pages_relation/_pages_leavebalances.php<?php echo $getPackage; ?>rfid=" + response
						.emp_no + "&sfid=" + response.leave_code,
						function (responseTxt_spv_up, statusTxt_spv_up, jqXHR_spv_up) {
							if (statusTxt_spv_up == "success") {
								$("#inp_revised_leavebalances_amount").show();
								$("#box_leavebalances_revised").show();
								mymodalss.style.display = "none";
							}
						}
					);

					//IF CONDITION #1 SHOWING DAYTYPE
					if (response.daytype == 'HD') {
						$("#inp_revised_hdtype_starttime").show();
						$("#inp_revised_hdtype_endtime").hide();
						$("#inp_revised_pdtype_starttime").hide();
						$("#inp_revised_pdtype_endtime").hide();
						$("#inp_revised_hdtype_starttime_formmodified").hide();
						$("#inp_revised_hdtype_endtime_formmodified").hide();
					} else if (response.daytype == 'PD') {
						$("#inp_revised_hdtype_starttime").hide();
						$("#inp_revised_hdtype_endtime").hide();
						$("#inp_revised_pdtype_starttime").show();
						$("#inp_revised_pdtype_endtime").show();
						$("#inp_revised_hdtype_starttime_formmodified").hide();
						$("#inp_revised_hdtype_endtime_formmodified").hide();
					} else {
						$("#inp_revised_hdtype_starttime").hide();
						$("#inp_revised_hdtype_endtime").hide();
						$("#inp_revised_pdtype_starttime").hide();
						$("#inp_revised_pdtype_endtime").hide();
						$("#inp_revised_hdtype_starttime_formmodified").hide();
						$("#inp_revised_hdtype_endtime_formmodified").hide();
					}


					//IF CONDITION #2 SHOWING DAYTYPE AFTER DATE FILL
					//IF CONDITION #2 SHOWING DAYTYPE AFTER DATE FILL
					if (response.leave_startdates_print < response.leave_enddates_print && response.daytype ==
						'HD') {
						$("#inp_revised_hdtype_endtime").val(response.hd_end);
						$("#inp_revised_hdtype_endtime_formmodified").val(response.hd_end);

						$("#inp_revised_hdtype_starttime").hide();
						$("#inp_revised_hdtype_endtime").show();
						$("#inp_revised_hdtype_starttime_formmodified").show();
						document.getElementById("inp_revised_hdtype_starttime").setAttribute("name",
							"inp_revised_hdtype_starttime_formmodified");
						document.getElementById("inp_revised_hdtype_starttime_formmodified").setAttribute(
							"name", "inp_revised_hdtype_starttime");
						document.getElementById("inp_revised_hdtype_endtime").setAttribute("name",
							"inp_revised_hdtype_endtime");
						document.getElementById("inp_revised_hdtype_endtime_formmodified").setAttribute("name",
							"inp_revised_hdtype_endtime_formmodified");
					} else if (response.leave_startdates_print == response.leave_enddates_print && response
						.daytype == 'HD') {

						$("#inp_revised_hdtype_starttime").show();
						$("#inp_revised_hdtype_endtime").hide();
						$("#inp_revised_hdtype_starttime_formmodified").hide();
						document.getElementById("inp_revised_hdtype_starttime").setAttribute("name",
							"inp_revised_hdtype_starttime");
						document.getElementById("inp_revised_hdtype_starttime_formmodified").setAttribute(
							"name", "inp_revised_hdtype_starttime_formmodified");
						document.getElementById("inp_revised_hdtype_endtime_formmodified").setAttribute("name",
							"inp_revised_hdtype_endtime");
						document.getElementById("inp_revised_hdtype_endtime").setAttribute("name",
							"inp_revised_hdtype_endtime_formmodified");

					}


					$("#FormDisplayRevised").unbind('submit').bind('submit', function () {

						var form = $(this);

						var inp_revised_emp_no = $("#inp_revised_emp_no").val();
						var $inp_revised_token = $("#inp_revised_token").val();
						var inp_revised_requestfor = $("#inp_revised_requestfor").val();
						var $inp_revised_leaverequestv = $("#inp_revised_leaverequestv").val();
						var inp_revised_remark = $("#inp_revised_remark").val();
						var modal_leave_start = $("#modal_revised_leave_start").val();
						var modal_leave_end = $("#modal_revised_leave_end").val();
						var inp_revised_daytype = $("#inp_revised_daytype").val();
						var inp_revised_pdtype_starttime = $("#inp_revised_pdtype_starttime").val();
						var inp_revised_pdtype_endtime = $("#inp_revised_pdtype_endtime").val();
						var from = new Date(modal_leave_start).getTime();
						var to = new Date(modal_leave_end).getTime();

						var regex = /^[a-zA-Z]+$/;

						if (from > to) {
							mymodalss.style.display = "none";
							modals.style.display = "block";
							document.getElementById("msg").innerHTML =
								"Entry Date: Enter Date in Proper Range";
							return false;

						} else if (inp_revised_requestfor == '') {
							mymodalss.style.display = "none";
							modals.style.display = "block";
							document.getElementById("msg").innerHTML = "Request for empty";
							return false;

						} else if (inp_revised_leaverequestv == '') {
							mymodalss.style.display = "none";
							modals.style.display = "block";
							document.getElementById("msg").innerHTML = "Leave request empty";
							return false;

						} else if (modal_leave_start == '') {
							mymodalss.style.display = "none";
							modals.style.display = "block";
							document.getElementById("msg").innerHTML = "Leave start empty";
							return false;

						} else if (modal_leave_end == '') {
							mymodalss.style.display = "none";
							modals.style.display = "block";
							document.getElementById("msg").innerHTML = "Leave start empty";
							return false;

						} else if (inp_revised_remark == '') {
							mymodalss.style.display = "none";
							modals.style.display = "block";
							document.getElementById("msg").innerHTML = "Remark cannot empty";
							return false;

						} else if (inp_revised_daytype == "PD" && (inp_revised_pdtype_starttime ==
								'00:00' || inp_revised_pdtype_endtime == '00:00')) {
							mymodalss.style.display = "none";
							modals.style.display = "block";
							document.getElementById("msg").innerHTML = "Please insert time";
							return false;

						} else if (inp_revised_daytype == "PD" && from < to) {
							mymodalss.style.display = "none";
							modals.style.display = "block";
							document.getElementById("msg").innerHTML =
								"Partial Day Permit just allowing max 5 Hours";
							return false;

						}

						if (inp_revised_requestfor && inp_revised_leaverequestv &&
							inp_revised_remark && modal_leave_start && modal_leave_end) {


							$.ajax({
								url: form.attr('action'),
								type: form.attr('method'),
								data: form.serialize(),
								dataType: 'json',
								success: function (response) {
									if (response.code == 'success_message') {

										mymodalss.style.display = "none";
										mymodals_withhref.style.display = "block";
										document.getElementById("msg_href").innerHTML =
											response.messages;

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
										document.getElementById("msg").innerHTML = response
											.messages;
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

	function urgent_attachment(id = null) {
		mymodalss.style.display = "block";

		if (id) {
			$.ajax({
				url: 'php_action/getSelectedRequest.php<?php echo $getPackage; ?>',
				type: 'post',
				data: {
					member_id: id
				},
				dataType: 'json',
				success: function (response) {

					mymodalss.style.display = "none";

					$("#inp_Attachment_request_no").val(response.request_no);

					$("#box_attachment").load(
						"pages_relation/_pages_attachment.php<?php echo $getPackage; ?>rfid=" + response
						.request_no,
						function (responseTxt_spv_up, statusTxt_spv_up, jqXHR_spv_up) {
							if (statusTxt_spv_up == "success") {
								$("#inp_attachment_files").show();
								$("#box_attachment").show();
								mymodalss.style.display = "none";
							}
						}
					);


					$("#upload").click(function () {

						mymodalss.style.display = "block";

						const fileupload = $('#fileupload').prop('files')[0];
						var nama_file = $('#inp_Attachment_request_no').val();
						var inp_Attachment_emp_no = $('#inp_Attachment_emp_no').val();

						if (nama_file != "" && fileupload != "") {
							let formData = new FormData();
							formData.append('fileupload', fileupload);
							formData.append('nama_file', nama_file);
							formData.append('inp_Attachment_emp_no', inp_Attachment_emp_no);

							$.ajax({
								type: 'POST',
								url: "php_action/FuncDataUpload.php<?php echo $getPackage; ?>",
								data: formData,
								cache: false,
								processData: false,
								contentType: false,
								dataType: 'json',
								success: function (msg) {

									document.getElementById("form-data").reset();
									$("#inp_Attachment_request_no").val(response
										.request_no);


									mymodalss.style.display = "none";
									modals.style.display = "block";
									document.getElementById("msg").innerHTML = msg
									.messages;

									$("#box_attachment").load(
										"pages_relation/_pages_attachment.php<?php echo $getPackage; ?>rfid=" +
										response.request_no,
										function (responseTxt_spv_up, statusTxt_spv_up,
											jqXHR_spv_up) {
											if (statusTxt_spv_up == "success") {
												$("#inp_attachment_files").show();
												$("#box_attachment").show();
												mymodalss.style.display = "none";
											}
										}
									);
								},
								error: function () {

									mymodalss.style.display = "none";
									modals.style.display = "block";
									document.getElementById("msg").innerHTML = msg
									.messages;
								}
							});
						}
					});

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
				success: function (response) {

					document.getElementById("sel_identity_request_no").innerHTML = response.request_no;
					document.getElementById("sel_identity_leave_code").innerHTML = response.leave_code +
						" ( Total Days : " + response.totaldays + ") " + " Leave Date " + response
						.leave_startdates + " - " + response.leave_enddates;
					document.getElementById("sel_identity_requester").innerHTML = response.Full_Name + " (" +
						response.emp_no + ") ";

					// document.getElementsByTagName("harusdiselipin").setAttribute("class", "democlass"); 
					$("#submit_reject_spvdown").attr("onclick", "editreject_approval(`" + response.request_no +
						"`)");
					$("#submit_revision_spvdown").attr("onclick", "editrevision_approval(`" + response
						.request_no + "`)");
					// onclick="editrejectrequest(`PAREQ2022-130299`)"

					$("#cancellation_id").attr("data-id", response.request_no);

					// $("#cancellation_id").data(response.request_no);

					$("#sel_approval_request_no").val(response.request_no);
					$("#sel_ipp_requester_spv_downS").val(response.requester);
					// $("#sel_remark_from_approver").val(response.remark);

					$("#box_approval_request_detail").load(
						"pages_relation/_pages_approval.php<?php echo $getPackage; ?>rfid=" + response
						.request_no,
						function (responseTxt, statusTxt, jqXHR) {
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
						success: function (response) {

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
					$(".FormDisplayLeaveApproval").append(
						'<input type="hidden" name="member_id" id="member_id" value="' + response.id +
						'"/>');

					// here update the member data
					$("#updatedelMemberForm").unbind('submit').bind('submit', function () {

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
								success: function (response) {
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
										document.getElementById("msg").innerHTML = response
											.messages;



									} else {
										$('#submit_approval_spvdown').show();
										$('#submit_approval_spvdown2').hide();

										mymodalss.style.display = "none";

										modals.style.display = "block";
										document.getElementById("msg").innerHTML = response
											.messages;
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
			$('.delete').click(function () {
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
						success: function (response) {
							if (response.code == 'success_message') {
								mymodals_withhref.style.display = "block";
								document.getElementById("msg_href").innerHTML = response.messages;
							} else {
								mymodals_withhref.style.display = "block";
								document.getElementById("msg_href").innerHTML = response.messages;
								return false;
							}
						},
						error: function(xhr, status, error) {
							var err = eval("(" + xhr.responseText + ")");
							mymodals_withhref.style.display = "block";
							document.getElementById("msg_href").innerHTML = err;
							return false;
							// alert(err.Message);
						}

					});
				}

			});


		} else {
			alert("Error : Refresh the page again");
		}
	}
</script>
<!-- isi JSONs -->
</body>

</html>

<script type="text/javascript">
	function isi_otomatis_leave() {
		var emps = document.getElementById("modal_emp").value;
		var myarr = emps.split(" ");
		var modal_emps = myarr[1];
		$("#inp_requestfor").val(modal_emps);

		var modal_leave = $("#modal_leave").val();
		$("#inp_leaverequestv").val(modal_leave);
		var modal_leave_starts = document.getElementById("modal_leave_start").value;
		var modal_leave_ends = document.getElementById("modal_leave_end").value;
		var from = new Date(modal_leave_starts).getTime();
		var to = new Date(modal_leave_ends).getTime();

		$(document).ready(function () {
			$("#inp_urgent_on").click(function () {
				var inp_urgent_on = document.getElementById("inp_urgent_on").value;
				if (inp_urgent_on == '1') {
					$("#tr_inp_urgent_on").hide();
					$("#tr_inp_urgent_off").show();
					$("#tr_inp_urgent_reason").show();
					$('#inp_urgent_on').prop('checked', false);
					document.getElementById("inp_urgent_on_back").setAttribute("name", "hidden");
					document.getElementById("inp_urgent_off").setAttribute("name", "inp_urgent_decl");
				}
			});
		});
		$(document).ready(function () {
			$("#inp_urgent_off").click(function () {
				var inp_urgent_off = document.getElementById("inp_urgent_off").value;
				if (inp_urgent_off == '1') {
					$("#tr_inp_urgent_on").show();
					$("#tr_inp_urgent_off").hide();
					$("#tr_inp_urgent_reason").hide();
					$('#inp_urgent_off').prop('checked', true);
					document.getElementById("inp_urgent_on_back").setAttribute("name", "inp_urgent_decl");
					document.getElementById("inp_urgent_off").setAttribute("name", "hidden");
				}
			});
		});

		$.ajax({
			url: 'php_action/getLeaveBalance.php<?php echo $getPackage; ?>',
			type: 'get',
			data: {
				modal_emp: modal_emps,
				modal_leave: modal_leave
			},
			dataType: 'json',
			success: function (response) {

				$("#inp_daytype").val(response.daytype);
				$("#inp_summaryleavebalance").val(response.total);
				$("#inp_deductedleave").val(response.deductedleave);

				$("#box_leavebalances").load(
					"pages_relation/_pages_leavebalances.php<?php echo $getPackage; ?>rfid=" + modal_emps +
					"&sfid=" + modal_leave,
					function (responseTxt_spv_up, statusTxt_spv_up, jqXHR_spv_up) {
						if (statusTxt_spv_up == "success") {
							$("#inp_leavebalances_amount").show();
							$("#box_leavebalances").show();
							mymodalss.style.display = "none";
						}
					}
				);

				if (response.urgent == '1') {
					$("#tr_inp_leaveisurgent").show();
				} else {
					// $("#tr_inp_leaveisurgent").hide();
					// $("#tr_inp_urgent_reason").hide();
					$('#tr_inp_leaveisurgent').hide()
					$('.urgent_reason_additional').hide()
					$("#tr_inp_urgent_on").show();
					$("#tr_inp_urgent_off").hide();
					$("#tr_inp_urgent_reason").hide();
					$('#inp_urgent_off').prop('checked', true);
					document.getElementById("inp_urgent_on_back").setAttribute("name", "inp_urgent_decl");
					document.getElementById("inp_urgent_off").setAttribute("name", "hidden");
				}

				//IF CONDITION #1 SHOWING DAYTYPE
				if (response.daytype == 'HD') {
					$("#inp_hdtype_starttime").show();
					$("#inp_hdtype_endtime").hide();
					$("#inp_pdtype_starttime").hide();
					$("#inp_pdtype_endtime").hide();
					$("#inp_hdtype_starttime_formmodified").hide();
					$("#inp_hdtype_endtime_formmodified").hide();
				} else if (response.daytype == 'PD') {
					$("#inp_hdtype_starttime").hide();
					$("#inp_hdtype_endtime").hide();
					$("#inp_pdtype_starttime").show();
					$("#inp_pdtype_endtime").show();
					$("#inp_hdtype_starttime_formmodified").hide();
					$("#inp_hdtype_endtime_formmodified").hide();
				} else {
					$("#inp_hdtype_starttime").hide();
					$("#inp_hdtype_endtime").hide();
					$("#inp_pdtype_starttime").hide();
					$("#inp_pdtype_endtime").hide();
					$("#inp_hdtype_starttime_formmodified").hide();
					$("#inp_hdtype_endtime_formmodified").hide();
				}
				//IF CONDITION #2 SHOWING DAYTYPE AFTER DATE FILL
				if (from < to && response.daytype == 'HD') {
					$("#inp_hdtype_starttime").hide();
					$("#inp_hdtype_endtime").show();
					$("#inp_hdtype_starttime_formmodified").show();
					document.getElementById("inp_hdtype_starttime").setAttribute("name",
						"inp_hdtype_starttime_formmodified");
					document.getElementById("inp_hdtype_starttime_formmodified").setAttribute("name",
						"inp_hdtype_starttime");
					document.getElementById("inp_hdtype_endtime").setAttribute("name", "inp_hdtype_endtime");
					document.getElementById("inp_hdtype_endtime_formmodified").setAttribute("name",
						"inp_hdtype_endtime_formmodified");
				} else if (from == to && response.daytype == 'HD') {
					$("#inp_hdtype_starttime").show();
					$("#inp_hdtype_endtime").hide();
					$("#inp_hdtype_starttime_formmodified").hide();
					document.getElementById("inp_hdtype_starttime").setAttribute("name",
						"inp_hdtype_starttime");
					document.getElementById("inp_hdtype_starttime_formmodified").setAttribute("name",
						"inp_hdtype_starttime_formmodified");
					document.getElementById("inp_hdtype_endtime_formmodified").setAttribute("name",
						"inp_hdtype_endtime");
					document.getElementById("inp_hdtype_endtime").setAttribute("name",
						"inp_hdtype_endtime_formmodified");
				}
			}
		}); // /ajax
	}

	function isi_otomatis_leave_revised() {

		var emps = document.getElementById("modal_emp").value;
		var myarr = emps.split(" ");
		var modal_emps = myarr[1];
		$("#inp_revised_requestfor").val(modal_emps);

		var modal_leave = $("#modal_leave_revised").val();
		$("#inp_revised_leaverequestv").val(modal_leave);
		var modal_revised_leave_starts = document.getElementById("modal_revised_leave_start").value;
		var modal_revised_leave_ends = document.getElementById("modal_revised_leave_end").value;
		var from = new Date(modal_revised_leave_starts).getTime();
		var to = new Date(modal_revised_leave_ends).getTime();

		$(document).ready(function () {
			$("#inp_revised_urgent_on").click(function () {
				var inp_revised_urgent_on = document.getElementById("inp_revised_urgent_on").value;
				if (inp_revised_urgent_on == '1') {
					$("#tr_inp_revised_urgent_on").hide();
					$("#tr_inp_revised_urgent_off").show();
					$("#tr_inp_revised_urgent_reason").show();
					$('#inp_revised_urgent_on').prop('checked', false);
					document.getElementById("inp_revised_urgent_on_back").setAttribute("name", "hidden");
					document.getElementById("inp_revised_urgent_off").setAttribute("name",
						"inp_revised_urgent_decl");
				}
			});
		});
		$(document).ready(function () {
			$("#inp_revised_urgent_off").click(function () {
				var inp_revised_urgent_off = document.getElementById("inp_revised_urgent_off").value;
				if (inp_revised_urgent_off == '1') {
					$("#tr_inp_revised_urgent_on").show();
					$("#tr_inp_revised_urgent_off").hide();
					$("#tr_inp_revised_urgent_reason").hide();
					$('#inp_revised_urgent_off').prop('checked', true);
					document.getElementById("inp_revised_urgent_on_back").setAttribute("name",
						"inp_revised_urgent_decl");
					document.getElementById("inp_revised_urgent_off").setAttribute("name", "hidden");
				}
			});
		});

		$.ajax({
			url: 'php_action/getLeaveBalance.php<?php echo $getPackage; ?>',
			type: 'get',
			data: {
				modal_emp: modal_emps,
				modal_leave: modal_leave
			},


			dataType: 'json',
			success: function (response) {

				$("#inp_revised_daytype").val(response.daytype);
				$("#inp_revised_summaryleavebalance").val(response.total);
				$("#inp_revised_deductedleave").val(response.deductedleave);


				$("#box_leavebalances_revised").load(
					"pages_relation/_pages_leavebalances.php<?php echo $getPackage; ?>rfid=" + modal_emps +
					"&sfid=" + modal_leave,
					function (responseTxt_spv_up, statusTxt_spv_up, jqXHR_spv_up) {
						if (statusTxt_spv_up == "success") {
							$("#inp_revised_leavebalances_amount").show();
							$("#box_leavebalances_revised").show();
							mymodalss.style.display = "none";
						}
					}
				);

				if (response.urgent == '1') {
					$("#tr_inp_revised_leaveisurgent").show();
				} else {
					$("#tr_inp_revised_leaveisurgent").hide();
					$("#tr_inp_revised_urgent_reason").hide();
				}

				//IF CONDITION #1 SHOWING DAYTYPE
				if (response.daytype == 'HD') {
					$("#inp_revised_hdtype_starttime").show();
					$("#inp_revised_hdtype_endtime").hide();
					$("#inp_revised_pdtype_starttime").hide();
					$("#inp_revised_pdtype_endtime").hide();
					$("#inp_revised_hdtype_starttime_formmodified").hide();
					$("#inp_revised_hdtype_endtime_formmodified").hide();
				} else if (response.daytype == 'PD') {
					$("#inp_revised_hdtype_starttime").hide();
					$("#inp_revised_hdtype_endtime").hide();
					$("#inp_revised_pdtype_starttime").show();
					$("#inp_revised_pdtype_endtime").show();
					$("#inp_revised_hdtype_starttime_formmodified").hide();
					$("#inp_revised_hdtype_endtime_formmodified").hide();
				} else {
					$("#inp_revised_hdtype_starttime").hide();
					$("#inp_revised_hdtype_endtime").hide();
					$("#inp_revised_pdtype_starttime").hide();
					$("#inp_revised_pdtype_endtime").hide();
					$("#inp_revised_hdtype_starttime_formmodified").hide();
					$("#inp_revised_hdtype_endtime_formmodified").hide();
				}
				//IF CONDITION #2 SHOWING DAYTYPE AFTER DATE FILL
				if (from < to && response.daytype == 'HD') {
					$("#inp_revised_hdtype_starttime").hide();
					$("#inp_revised_hdtype_endtime").show();
					$("#inp_revised_hdtype_starttime_formmodified").show();
					document.getElementById("inp_revised_hdtype_starttime").setAttribute("name",
						"inp_revised_hdtype_starttime_formmodified");
					document.getElementById("inp_revised_hdtype_starttime_formmodified").setAttribute("name",
						"inp_revised_hdtype_starttime");
					document.getElementById("inp_revised_hdtype_endtime").setAttribute("name",
						"inp_revised_hdtype_endtime");
					document.getElementById("inp_revised_hdtype_endtime_formmodified").setAttribute("name",
						"inp_revised_hdtype_endtime_formmodified");
				} else if (from == to && response.daytype == 'HD') {
					$("#inp_revised_hdtype_starttime").show();
					$("#inp_revised_hdtype_endtime").hide();
					$("#inp_revised_hdtype_starttime_formmodified").hide();
					document.getElementById("inp_revised_hdtype_starttime").setAttribute("name",
						"inp_revised_hdtype_starttime");
					document.getElementById("inp_revised_hdtype_starttime_formmodified").setAttribute("name",
						"inp_revised_hdtype_starttime_formmodified");
					document.getElementById("inp_revised_hdtype_endtime_formmodified").setAttribute("name",
						"inp_revised_hdtype_endtime");
					document.getElementById("inp_revised_hdtype_endtime").setAttribute("name",
						"inp_revised_hdtype_endtime_formmodified");
				}
			}
		}); // /ajax
	}
</script>

<script type="text/javascript">
	$(document).ready(function () {
		$('#modal_leave_start').bootstrapMaterialDatePicker({
			time: false,
			clearButton: true
		});

		$('#modal_leave_end').bootstrapMaterialDatePicker({
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
</script>