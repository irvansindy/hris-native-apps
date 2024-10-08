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
<!-- <script type="text/javascript" src="../../asset/gantt_chart/js/jquery.fn.gantt.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/jquery.gantt@1.0.0/dist/jquery-gantt.min.js" integrity="sha256-I8Y1RUotpfMVH7hfK/a8Xwbf0YHcvtsFx+WzAZEAB6k=" crossorigin="anonymous"></script> -->
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
					<th class="fontCustom" style="z-index: 1;">User Request</th>
					<th class="fontCustom" style="z-index: 1;">Date Request</th>
					<th class="fontCustom" style="z-index: 1;">Status</th>
					<th class="fontCustom" style="z-index: 1;">Preview</th>
					<th class="fontCustom" style="z-index: 1;">Approval Status</th>
				</tr>
			</thead>
		</table>
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
							<button type="button" class="btn-sdk btn-primary-center-only rounded-pill" name="submit_draft" id="submit_draft" data-type_submit="draft">
							<!-- <button type="button" class="btn shine btn-sdk btn-primary-center-only rounded-pill" name="submit_draft" id="submit_draft" data-type_submit="draft"> -->
								<p class="text-center text-dark">
									&nbsp;Save as draft&nbsp;
								</p>
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- end detail data modal -->

	<!-- detail data approval modal -->
	<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="detail_data_suggestion_approval">
		<div class="modal-dialog modal-belakang modal-med" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Suggestion Box Approval</h4>
					<a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close"
						style="margin-top: -15px;">
						<span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
					</a>
				</div>

				<!-- <form class="form-horizontal" action="php_action/FuncDataUpdate.php" method="POST" id="updateMemberForm"> -->
				<form class="form-horizontal" action="" method="" id="form_detail_data_suggestion">

					<div class="card-body table-responsive p-0"
						style="width: 100vw;height: auto%; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">
						<fieldset id="fset_1">
							<legend>General</legend>
							<input id="detail_emp_no" name="detail_emp_no" type="hidden" value="<?php echo $username; ?>">
							<input id="sel_token" name="sel_token" type="hidden" value="<?php echo $get_token; ?>">
							<div class="form-row">
								<div class="col-sm-4 name"> Request Number <span class="required">*</span></div>
								<div class="col-sm-8 name">
									<div class="input-group" id="contoh"
										style="font-weight: bold;color: #5b5b5b;">
									</div>
									<div class="input-group" id="detail_approval_request_no"
										style="font-weight: bold;color: #5b5b5b;">
									</div>
								</div>
							</div>
							<div class="form-row">
								<div class="col-sm-4 name"> Request Title <span class="required">*</span></div>
								<div class="col-sm-8 name">
									<div class="input-group" id="contoh"
										style="font-weight: bold;color: #5b5b5b;">
									</div>
									<div class="input-group" id="detail_approval_request_title"
										style="font-weight: bold;color: #5b5b5b;">
									</div>
								</div>
							</div>
							<div class="form-row">
								<div class="col-sm-4 name"> Employee <span class="required">*</span></div>
								<div class="col-sm-8 name">
									<div class="input-group" id="contoh"
										style="font-weight: bold;color: #5b5b5b;">
									</div>
									<div class="input-group" id="detail_approval_request_employee"
										style="font-weight: bold;color: #5b5b5b;">
									</div>
								</div>
							</div>
							<div class="form-row">
								<div class="col-sm-4 name"> Request Date <span class="required">*</span></div>
								<div class="col-sm-8 name">
									<div class="input-group" id="contoh"
										style="font-weight: bold;color: #5b5b5b;">
									</div>
									<div class="input-group" id="detail_approval_request_date"
										style="font-weight: bold;color: #5b5b5b;">
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
									<tbody id="list_user_approval_detail">
										
									</tbody>
								</table>
								<div>
							</div>
						</fieldset>
						<div class="modal-footer-sdk">
							<button type="button" class="btn-sdk btn-primary-center-only rounded-pill" name="create_suggestion_approval" id="create_suggestion_approval"  style="background-color: #1b6fb9; !important" data-toggle="modal" data-target="#comment_rating_suggestion_box" data-backdrop="static">
							<!-- data-backdrop="static" -->
								<p class="text-center">
									&nbsp;Approve&nbsp;
								</p>
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- end detail data approval modal -->
	
	<!-- detail data approval submit modal -->
	<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="comment_rating_suggestion_box">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Comment and Rating Box</h4>
					<a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close"
						style="margin-top: -15px;">
						<span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
					</a>
				</div>
				<form class="form-horizontal" action="" method="" id="form_suggestion_approval">
					<div class="modal-body">
						<div class="input-group">
							<label for="#input_remark_approval">Remark <span class="required">*</span></label>
							<textarea class="input--style-6 suggestion_summernote_approval" name="input_remark_approval" id="input_remark_approval"></textarea>
						</div>
						<div class="input-group mt-5">
							<div class="rating">
								<i class="rating__star far fa-star fa-2xl"></i>
								<i class="rating__star far fa-star fa-2xl"></i>
								<i class="rating__star far fa-star fa-2xl"></i>
								<i class="rating__star far fa-star fa-2xl"></i>
								<i class="rating__star far fa-star fa-2xl"></i>
							</div>
						</div>
						<div class="input-group mt-5">
							<input type="hidden" name="input_data_rating" id="input_data_rating">
							<input type="hidden" name="request_no_suggestion_approval" id="request_no_suggestion_approval">
						</div>
					</div>
					<div class="modal-footer-sdk">
						<button type="button" class="btn-sdk btn-primary-center-only rounded-pill" name="submit_suggestion_approval" id="submit_suggestion_approval"  style="background-color: #1b6fb9; !important" data-toggle="modal" data-target="#comment_rating_suggestion_box" data-backdrop="static">
						<!-- data-backdrop="static" -->
							<p class="text-center mt-2">
								&nbsp;Submit&nbsp;
							</p>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- end detail data approval modal -->

	<style>
		.rating {
		width: 180px;
		}

		.rating__star {
		cursor: pointer;
		color: #dabd18b2;
		}
	</style>
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
<script type="module" src="pages_relation/event_detail_approval.js"></script>

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