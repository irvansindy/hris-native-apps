<?php
$src_emp_no                        = '';
$src_employee_name                 = '';
if (!empty($_POST['src_emp_no']) && !empty($_POST['src_employee_name'])) {
	$src_emp_no                 = $_POST['src_emp_no'];
	$src_employee_name          = $_POST['src_employee_name'];
	$frameworks                 = "src_emp_no=" . "" . $src_emp_no . "&src_employee_name=" . "" . $src_employee_name . "";
} else if (empty($_POST['src_emp_no']) && !empty($_POST['src_employee_name'])) {
	$src_emp_no                 = $_POST['src_emp_no'];
	$src_employee_name          = $_POST['src_employee_name'];
	$frameworks                 = "src_employee_name=" . "" . $src_employee_name . "";
} else if (!empty($_POST['src_emp_no']) && empty($_POST['src_employee_name'])) {
	$src_emp_no                 = $_POST['src_emp_no'];
	$src_employee_name          = $_POST['src_employee_name'];
	$frameworks                 = "src_emp_no=" . "" . $src_emp_no . "";
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
							<div class="col-sm-4 name">Employee No.</div>
							<div class="col-sm-8">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="src_emp_no"
										name="src_emp_no" id="src_emp_no" type="Text" value="<?php echo $src_emp_no; ?>"
										onfocus="hlentry(this)" size="30" 										validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-4 name">Employee Name</div>
							<div class="col-sm-8">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on"
										name="src_employee_name" id="src_employee_name" type="Text"
										value="<?php echo $src_employee_name; ?>" onfocus="hlentry(this)" size="30"
										validate="NotNull:Invalid Form Entry"
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

<!-- CDN summernote -->
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<!-- add defer in cdn -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js" defer></script>

<!-- gantt chart -->
<script src="https://cdn.jsdelivr.net/npm/frappe-gantt@0.6.1/dist/frappe-gantt.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/frappe-gantt@0.6.1/dist/frappe-gantt.min.css" rel="stylesheet">

<!-- font awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- data table JSON -->
<script type="text/javascript">
	// global the manage memeber table 
	$(document).ready(function () {
		datatable = $("#datatable").DataTable({

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
			destroy: true,
			"ajax": "php_action/FetchAllData.php<?php echo $getPackage; ?><?php echo $frameworks; ?>"
		});
	});
</script>

<div class="MaximumFrameHeight card-body table-responsive p-0" style="width: 100vw;height: 80vh; width: 98%; margin-right: 5px;overflow: scroll;overflow-x: hidden;margin-top: 17px;">
	<div class="col-12 col-fit" style="margin-top: 17px;">
		<table id="datatable" width="100%" border="1" align="left"
			class="table table-bordered table-striped table-hover table-head-fixed">
			<thead>
				<tr>
					<th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No</th>
					<th class="fontCustom" style="z-index: 1;">Request Number</th>
					<th class="fontCustom" style="z-index: 1;">Title</th>
					<th class="fontCustom" style="z-index: 1;">Date</th>
					<th class="fontCustom" style="z-index: 1;">Status</th>
					<th class="fontCustom" style="z-index: 1;">Action</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

	<!-- create data modal -->
	<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="CreateForm">
		<div class="modal-dialog modal-belakang modal-bgkpi" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Add Suggestion Data</h4>
					<a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close"
						style="margin-top: -15px;">
						<span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
					</a>
				</div>

				<!-- <form class="form-horizontal" action="php_action/FuncDataUpdate.php" method="POST" id="updateMemberForm"> -->
				<form class="form-horizontal" action="" method="POST" id="form_create_data">

					<div class="card-body table-responsive p-0"
						style="width: 100vw;height: auto%; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

						<fieldset id="fset_1">
							<legend>General</legend>

							<div class="messages_update"></div>

							<input id="input_emp_no" name="input_emp_no" type="hidden" value="<?php echo $username; ?>">
							<input id="input_status" name="input_status" type="hidden" value="<?php echo $username; ?>">

							<!--FROM SESSION -->
							<input id="sel_token" name="sel_token" type="hidden" value="<?php echo $get_token; ?>">
							<!--FROM CONFIGURATION -->
							<div class="form-row">
								<div class="col-4 name">Title <span class="required">*</span></div>
								<div class="col-sm-8">
									<div class="input-group">
										<input class="input--style-6"  id="input_suggestion_title" placeholder="Suggestion Title"
											name="input_suggestion_title" type="Text" value="" style="width: 60%;">
									</div>
								</div>
							</div>
							<div class="form-row">
								<div class="col-4 name">Upload Diagram <span class="required">*</span></div>
								<div class="col-sm-8">
									<div class="input-group">
										<input class="input--style-6" id="input_diagram" name="input_diagram" type="file" value="" style="width: 60%;">
									</div>
									<span class="required">format file: jpg, jpeg, png</span>
								</div>
							</div>
							<div class="mt-3">
								<ul class="nav nav-tabs" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" href="#problem_identification" role="tab" data-toggle="tab">Problem Identification</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#problem_background" role="tab" data-toggle="tab">Problem Background</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#target_specity" role="tab" data-toggle="tab">Target Specify</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#root_cause" role="tab" data-toggle="tab">Root Cause</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#planing" role="tab" data-toggle="tab">Planing</a>
									</li>
									<!-- <li class="nav-item">
										<a class="nav-link" href="#dummy_gantt_chart" role="tab" data-toggle="tab">Gantt Chart</a>
									</li> -->
								</ul>

								<!-- Tab panes -->
								<div class="tab-content mt-4">
									<div role="tabpanel" class="tab-pane fade in active" id="problem_identification">
										<div class="form-row">
											<div class="col">
												<div class="input-group">
													<textarea class="input--style-6 suggestion_summernote" name="input_problem_identification" id="input_problem_identification"></textarea>
												</div>
											</div>
										</div>
									</div>
									<div role="tabpanel" class="tab-pane fade" id="problem_background">
										<div class="form-row">
											<div class="col">
												<div class="input-group">
													<textarea class="input--style-6 suggestion_summernote" name="input_problem_background" id="input_problem_background"></textarea>
												</div>
											</div>
										</div>
									</div>
									<div role="tabpanel" class="tab-pane fade" id="target_specity">
										<div class="form-row">
											<div class="col">
												<div class="input-group">
													<textarea class="input--style-6 suggestion_summernote" name="input_target_specify" id="input_target_specify"></textarea>
												</div>
											</div>
										</div>
									</div>
									<div role="tabpanel" class="tab-pane fade" id="root_cause">
										<table class="table table-striped table-bordered table-hover" id="table_root_cause">
											<thead class="thead-light">
												<tr>
													<!-- <th style="text-align:center">No</th> -->
													<th style="text-align:center">Category</th>
													<th style="text-align:center">Add Possible Direct Cause</th>
												</tr>
											</thead>
											<tbody id="data_list_root_cause">
											</tbody>
										</table>
									</div>
									<div role="tabpanel" class="tab-pane fade" id="planing">
										<div>
											<table class="table table-striped table-bordered table-hover" id="table_root_cause">
												<thead class="thead-light">
													<tr>
														<th style="text-align:center">Planing Root Cause</th>
														<th style="text-align:center">#</th>
													</tr>
												</thead>
												<tbody id="data_list_planing_root_cause">
												</tbody>
											</table>
										</div>
										<!-- <div class="mt-4" id="list_detail_planing_step"></div>
										<div class="float-right mb-4">
											<button type="button" class="btn btn-danger btn-sm" id="reset_master_planing_root_cause" hidden="true"><i class="fa fa-eraser"></i> Reset</button>
											<button type="button" class="btn btn btn-success btn-sm" id="confirm_master_planing_root_cause"><i class="fa-solid fa-check"></i> Confirm</button>
										</div> -->
										<br/>
									</div>
									<div role="tabpanel" class="tab-pane fade" id="dummy_gantt_chart">
										<div class="gantt"></div>
									</div>
								</div>
							</div>
						</fieldset>
						<div class="modal-footer-sdk">
							<button type="button" class="btn-sdk btn-primary-center-only rounded-pill" name="submit_draft" id="submit_draft" data-type_submit="draft">
							<!-- <button type="button" class="btn shine btn-sdk btn-primary-center-only rounded-pill" name="submit_draft" id="submit_draft" data-type_submit="draft"> -->
								<p class="text-center text-dark">
									&nbsp;Save as draft&nbsp;
								</p>
							</button>
							<!-- <button type="button" class="btn-sdk btn-primary-left" name="submit_draft" id="submit_draft" data-type_submit="draft">
								&nbsp;Save as draft&nbsp;
							</button> -->
							<!-- <button type="button" class="btn-sdk btn-primary-right" name="submit_full" id="submit_full" data-type_submit="full_submit">
								Submit
							</button> -->
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- detail data modal -->
	<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="detail_data_suggestion">
		<div class="modal-dialog modal-belakang modal-bgkpi" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Detail Suggestion Data</h4>
					<a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close"
						style="margin-top: -15px;">
						<span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
					</a>
				</div>

				<!-- <form class="form-horizontal" action="php_action/FuncDataUpdate.php" method="POST" id="updateMemberForm"> -->
				<form class="form-horizontal" action="" method="POST" id="form_detail_data_suggestion">

					<div class="card-body table-responsive p-0"
						style="width: 100vw;height: auto%; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

						<fieldset id="fset_1">
							<legend>General</legend>

							<div class="messages_update"></div>

							<input id="detail_emp_no" name="detail_emp_no" type="hidden" value="<?php echo $username; ?>">
							<input id="detail_request_no" name="detail_request_no" type="hidden" value="">

							<!--FROM SESSION -->
							<input id="sel_token" name="sel_token" type="hidden" value="<?php echo $get_token; ?>">
							<!--FROM CONFIGURATION -->
							<div class="form-row">
								<div class="col-4 name">Title <span class="required">*</span></div>
								<div class="col-sm-8">
									<div class="input-group">
										<input class="input--style-6"  id="detail_suggestion_title" placeholder="Suggestion Title"
											name="detail_suggestion_title" type="Text" value="" style="width: 60%;">
									</div>
								</div>
							</div>
							<div class="form-row" id="detail_upload_diagram">
								<div class="col-4 name">Upload Diagram <span class="required">*</span></div>
								<div class="col-sm-8">
									<div class="input-group">
										<input class="input--style-6" id="detail_diagram" name="detail_diagram" type="file" value="" style="width: 60%;">
									</div>
								</div>
							</div>
							<div class="form-row file-attachment-data">
								<div class="col-4 name">
									Attachment Diagram<font color="red">*</font>
								</div>
								<div class="col-8">
									<div class="input-group">
										<a href="" id="detail_fileupload" target="_blank" download>
											<div id="icon_file_upload"></div>
										</a>
										<br>
										<!-- <span><font color="red">click for detail</font></span> -->
									</div>
								</div>
							</div>
							<div class="mt-3">
								<ul class="nav nav-tabs" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" href="#detail_tab_problem_identification" role="tab" data-toggle="tab">Problem Identification</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#detail_tab_problem_background" role="tab" data-toggle="tab">Problem Background</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#detail_tab_target_specity" role="tab" data-toggle="tab">Target Specify</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#detail_root_cause" role="tab" data-toggle="tab">Root Cause</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#detail_planing" role="tab" data-toggle="tab">Planing</a>
									</li>
									<!-- <li class="nav-item">
										<a class="nav-link" href="#dummy_gantt_chart" role="tab" data-toggle="tab">Gantt Chart</a>
									</li> -->
								</ul>

								<!-- Tab panes -->
								<div class="tab-content mt-4">
									<div role="tabpanel" class="tab-pane fade in active" id="detail_tab_problem_identification">
										<div class="form-row">
											<div class="col">
												<div class="input-group">
													<textarea class="input--style-6" name="detail_problem_identification" id="detail_problem_identification"></textarea>
												</div>
											</div>
										</div>
									</div>
									<div role="tabpanel" class="tab-pane fade" id="detail_tab_problem_background">
										<div class="form-row">
											<div class="col">
												<div class="input-group">
													<textarea class="input--style-6" name="detail_problem_background" id="detail_problem_background"></textarea>
												</div>
											</div>
										</div>
									</div>
									<div role="tabpanel" class="tab-pane fade" id="detail_tab_target_specity">
										<div class="form-row">
											<div class="col">
												<div class="input-group">
													<textarea class="input--style-6" name="detail_target_specify" id="detail_target_specify"></textarea>
												</div>
											</div>
										</div>
									</div>
									<div role="tabpanel" class="tab-pane fade" id="detail_root_cause">
										<table class="table table-striped table-bordered table-hover" id="table_root_cause">
											<thead class="thead-light">
												<tr>
													<!-- <th style="text-align:center">No</th> -->
													<th style="text-align:center">Category</th>
													<th style="text-align:center">Add Possible Direct Cause</th>
												</tr>
											</thead>
											<tbody id="detail_data_list_root_cause">
											</tbody>
										</table>
									</div>
									<div role="tabpanel" class="tab-pane fade" id="detail_planing">
										<div>
											<table class="table table-striped table-bordered table-hover" id="table_root_cause">
												<thead class="thead-light">
													<tr>
														<th style="text-align:center">Planing Root Cause</th>
														<th style="text-align:center">#</th>
													</tr>
												</thead>
												<tbody id="detail_data_list_planing_root_cause">
												</tbody>
											</table>
										</div>
										<!-- <div class="mt-4" id="list_detail_planing_step"></div>
										<div class="float-right mb-4">
											<button type="button" class="btn btn-danger btn-sm" id="reset_master_planing_root_cause" hidden="true"><i class="fa fa-eraser"></i> Reset</button>
											<button type="button" class="btn btn btn-success btn-sm" id="confirm_master_planing_root_cause"><i class="fa-solid fa-check"></i> Confirm</button>
										</div> -->
										<br/>
									</div>
									<div role="tabpanel" class="tab-pane fade" id="dummy_gantt_chart">
										<div class="gantt"></div>
									</div>
								</div>
							</div>
						</fieldset>
						<div class="modal-footer-sdk">
							<div id="status_draft">
								<a style="<?php echo $button_status_hide_or_no; ?>; color: white;padding-top: 8px; width: 150px !important"
									class="btn-sdk btn-primary-not-only-left" name="detail_update_draft"id="detail_update_draft">
									&nbsp;&nbsp;Update Draft&nbsp;&nbsp;
								</a>
								<button class="btn-sdk btn-primary-not-only-right" type="submit" style="width: 150px !important"
									name="detail_send_to_approver" id="detail_send_to_approver">
									Send to Approver
								</button>
							</div>
							<div id="status_after_draft" style="display:none">
								<div type="reset" class="btn-sdk btn-primary-center-only" data-dismiss="modal" style="padding-top: 8px; color:black;" aria-hidden="true">
									&nbsp;Close&nbsp;
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- add planing step data modal -->
	<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="create_suggestion_planing_step">
		<div class="modal-dialog modal-belakang modal-bg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Add Suggestion Planning Step</h4>
					<a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close"
						style="margin-top: -15px;">
						<span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
					</a>
				</div>

				<!-- <form class="form-horizontal" action="php_action/FuncDataUpdate.php" method="POST" id="updateMemberForm"> -->
				<form class="form-horizontal" action="" method="POST" id="form_suggestion_planing_step">

					<div class="card-body table-responsive p-0"
						style="width: 100vw;height: auto%; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

						<fieldset id="fset_1">
							<legend>General</legend>

							<div class="messages_update"></div>

							<input id="planing_emp_no" name="planing_emp_no" type="hidden" value="<?php echo $username; ?>">
							<input id="planing_request_no" name="planing_request_no" type="hidden" value="">

							<!--FROM SESSION -->
							<input id="sel_token" name="sel_token" type="hidden" value="<?php echo $get_token; ?>">
							<!--FROM CONFIGURATION -->
							<div id="form_add_planing_step">

							</div>
							
						</fieldset>
						<div class="modal-footer-sdk">
							<button type="button" class="btn-sdk btn-primary-center-only rounded-pill" name="submit_planing_step" id="submit_planing_step" data-type_submit="draft">
								<p class="text-center text-dark">
									&nbsp;Submit&nbsp;
								</p>
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

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

<!-- load all event jquery for this file -->
<script type="module" src="pages_relation/event_create_data.js"></script>
<script type="module" src="pages_relation/event_detail_data.js"></script>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		var tasks = [
			{
				id: 'Task 1',
				name: 'Redesign website',
				start: '2016-12-01',
				end: '2016-12-07',
				progress: 20,
				// dependencies: 'Task 1, Task 2',
				custom_class: 'bar-milestone' // optional
			},{
				id: 'Task 1',
				name: 'Slicing design',
				start: '2016-12-09',
				end: '2016-12-23',
				progress: 20,
				// dependencies: 'Task 1, Task 2',
				custom_class: 'bar-milestone' // optional
			},{
				id: 'Task 2',
				name: 'UAT design',
				start: '2016-12-25',
				end: '2016-12-30',
				progress: 20,
				// dependencies: 'Task 1, Task 2',
				custom_class: 'bar-milestone' // optional
			},
		]
		var gantt = new Gantt(".gantt", tasks);
		gantt.change_view_mode('Week')
	})
</script>

</body>

</html>