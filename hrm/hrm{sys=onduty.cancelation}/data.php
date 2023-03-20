<?php  
	$src_leave_request                        = '';
	$src_leave_request_cancel                 = '';
	if (!empty($_POST['src_leave_request']) && !empty($_POST['src_leave_request_cancel'])) {
		$src_leave_request                 = $_POST['src_leave_request'];
		$src_leave_request_cancel          = $_POST['src_leave_request_cancel'];
		$frameworks                        = "src_leave_request="."".$src_leave_request." &&src_leave_request_cancel="."".$src_leave_request_cancel."";
	} else if (empty($_POST['src_leave_request']) && !empty($_POST['src_leave_request_cancel'])) {
		$src_leave_request                 = $_POST['src_leave_request'];
		$src_leave_request_cancel          = $_POST['src_leave_request_cancel'];
		$frameworks                        = "src_leave_request_cancel="."".$src_leave_request_cancel."";
	} else if (!empty($_POST['src_leave_request']) && empty($_POST['src_leave_request_cancel'])) {
		$src_leave_request                 = $_POST['src_leave_request'];
		$src_leave_request_cancel          = $_POST['src_leave_request_cancel'];
		$frameworks                        = "src_leave_request="."".$src_leave_request."";
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

						<div class="form-row">
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

<!-- isi JSON -->
<script type="text/javascript">
// global the manage memeber table 
$(document).ready(function () {
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
		pageLength: 15,
		scrollX: true,
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


<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>

<div class="col-md-12">
	<div class="card">
		<div class="card-header d-flex align-items-center">
			<h4 class="card-title mb-0">On Duty Cancellation Request</h4>
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
						<div class="toolbar sprite-toolbar-reload" id="RELOAD" title="Reload" onclick="RefreshPage();">
						</div>
					</td>
					<!-- AgusPrass 02/03/2021 -->
					<td>
						<div class="toolbar sprite-toolbar-add" title="Add" data-toggle="modal" data-empno='<?php echo $username; ?>'
							data-target="#CreateForm" id="CreateButton" data-keyboard="false" data-backdrop="static">
							<!-- <a title="add" href="" class="toolbar sprite-toolbar-add" data-toggle="modal" data-target="#CreateForm" id="CreateButton" data-keyboard="false" data-backdrop="static">tambah</a> -->
						</div>
					</td>
				</table>
			</div>
		</div>

		<div class="card-body table-responsive p-0"
			style="width: 100vw;height: 78vh; width: 98.8%; margin: 5px;overflow: scroll;">
			<table id="datatable" width="98%" border="1" align="left"
				class="table table-bordered table-striped table-hover table-head-fixed">
				<thead>
					<tr>
						<th class="fontCustom" style="z-index: 1;" nowrap="nowrap">
							No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
						<th class="fontCustom" style="z-index: 1;">Request Number</th>
						<th class="fontCustom" style="z-index: 1;">Request For</th>
						<th class="fontCustom" style="z-index: 1;">Leave Request No.</th>
						<th class="fontCustom" style="z-index: 1;">Type of Leave</th>
						<th class="fontCustom" style="z-index: 1;">Request Date</th>
						<th class="fontCustom" style="z-index: 1;">Proposed Day</th>
						<th class="fontCustom" style="z-index: 1;">Remark</th>
						<th class="fontCustom" style="z-index: 1;">Request Status</th>
						<th class="fontCustom" style="z-index: 1;">Approval Status</th>
					</tr>

				</thead>
			</table>

		</div>

		<div class='card-footer' style='background-color: #eee;height: 37px;padding-top: 5px;'>
		</div>

	</div>
</div>

<!-- add modal -->
<div class="modal  fade fade-custom" tabindex="-1" role="dialog" id="CreateForm">
<div class="modal-dialog modal-belakang modal-med" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title">List On Duty Request</h4>
			<a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close"
				style="margin-top: -15px;">
				<span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
			</a>
		</div>

		<form class="form-horizontal" action="php_action/FuncDataCreate.php<?php echo $getPackage; ?>" method="POST"
			id="FormDisplayCreate">

			<div class="card-body table-responsive p-0"
				style="width: 100vw;height: 50vh; width: 100%; margin: 5px;overflow: scroll;overflow-x: hidden;">
				<fieldset id="fset_1">
					<legend>General</legend>
					<div class="messages_create"></div>
					<input id="inp_emp_no" name="inp_emp_no" type="hidden" value="<?php echo $username; ?>">
					<!--FROM SESSION -->
					<input id="inp_token" name="inp_token" type="hidden" value="<?php echo $get_token; ?>">
					<!--FROM CONFIGURATION -->
					<div class="form-row">
						<div class="col-4 name">Employee no*</div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" onkeyup="isi_otomatis(), isi_otomatis_leave()"
									autocomplete="off" autofocus="on" id="modal_emp" name="modal_emp" type="Text"
									value="<?php echo $username; ?>" onfocus="hlentry(this)" size="30"
									maxlength="50" validate="NotNull:Invalid Form Entry"
									onchange="formodified(this);" title="">
							</div>
						</div>
					</div>
					<?php 
						$emp = mysqli_fetch_array(mysqli_query($connect, "SELECT full_name FROM view_employee WHERE emp_no='$username'"));
					?>
					<div class="form-row">
						<div class="col-4 name">Name*</div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" style="background-color: #fff3b4;" id="inp_nickname"
									name="inp_nickname" type="Text" value="<?php echo $emp['full_name']; ?>"
									onfocus="hlentry(this)" size="20" maxlength="50"
									validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title=""
									readonly>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">Leave Request No.</div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" id="inp_leavereq" name="inp_leavereq" type="Text"
									value="" onfocus="hlentry(this)" size="20" maxlength="50"
									validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">Date</div>
						<div class="col-sm-4">
							<div class="input-group">
								<input type="text" id="inp_startdate" name="inp_startdate" class="input--style-6"
									style="
									background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
									background-size: 17px;
									background-position:right;   
									background-repeat:no-repeat; 
									padding-right:10px;  
									" />
							</div>
						</div>
						<div class="col-sm-4">
							<div class="input-group">
								<input type="text" id="inp_enddate" name="inp_enddate" class="input--style-6" style="
									background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
									background-size: 17px;
									background-position:right;   
									background-repeat:no-repeat; 
									padding-right:10px;  
									" />
							</div>
						</div>
						<div class="col-sm-4"></div>
						<div class="col-sm-8 name"> <a href='#' id="show_preview_leave_request"
								class='btn btn-default'>
								Show
							</a>

						</div>
					</div>

					<div id="box"></div>
					<div id="boxifblur"></div>
					<div class="box_show_preview_leave_request"></div>
					<div class="box_show_preview_leave_request_detail"></div>

					<script>
						$(document).ready(function () {
							$("#show_preview_leave_request").click(function () {

								// alert("pencet");

								$("#boxifblur").hide();
								var modal_emp = document.getElementById("modal_emp").value;
								var inp_leavereq = document.getElementById("inp_leavereq").value;
								var inp_startdate = document.getElementById("inp_startdate").value;
								var inp_enddate = document.getElementById("inp_enddate").value;

								$("#box").load(
									"pages_relation/_pages_preview_request.php<?php echo $getPackage; ?>rfid=" +
									modal_emp + "&xfid=" + inp_leavereq + "&sfid=" + inp_startdate + "&efid=" +
									inp_enddate,
									function (responseTxt, statusTxt, jqXHR) {
										if (statusTxt == "success") {
											// alert("New content loaded successfully!");
											$("#box_show_preview_leave_request").show();
										}
										if (statusTxt == "error") {
											alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
										}
									});
							});
						});
					</script>

					<script>
						$(document).ready(function () {
							$("#show_preview_leave_request_detail").click(function () {
								$("#boxifblur").hide();
								var modal_emp = document.getElementById("modal_emp").value;
								var inp_leavereq = document.getElementById("inp_leavereq").value;

								var m = $(this).attr("id");
								var m2 = $(this).attr("id2");

								$("#box").load("modal_leave.php<?php echo $getPackage; ?>rfid=" + m + "&xfid=" + m2,
									function (responseTxt, statusTxt, jqXHR) {
										if (statusTxt == "success") {
											// alert("New content loaded successfully!");
											$("#box_show_preview_leave_request_detail").show();
										}
										if (statusTxt == "error") {
											alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
										}
									});
							});
						});
					</script>



				</fieldset>

			</div>

			<div class="modal-footer">

			</div>
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
			<!-- <box class="shine"></box>
										<div><lines class="shine"></lines></div> -->

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



















































<!-- edit modal -->
<div class="modal  fade fade-custom" tabindex="-1" role="dialog" id="UpdateForm">
<div class="modal-dialog modal-belakang modal-bs" role="document">

	<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title">Edit Scheduling Group Setting</h4>
			<a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close"
				style="margin-top: -15px;">
				<span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
			</a>
		</div>

		<!-- <form class="form-horizontal" action="php_action/FuncDataUpdate.php" method="POST" id="updateMemberForm"> -->
		<form class="form-horizontal" action="php_action/FuncDataUpdate.php<?php echo $getPackage; ?>" method="POST"
			id="FormDisplayUpdate">

			<fieldset id="fset_1">
				<legend>General</legend>

				<div class="messages_update"></div>

				<input id="sel_emp_no" name="sel_emp_no" type="hidden" value="<?php echo $username; ?>">
				<!--FROM SESSION -->
				<input id="sel_token" name="sel_token" type="hidden" value="<?php echo $get_token; ?>">
				<!--FROM CONFIGURATION -->


				<div class="form-row">
					<div class="col-4 name">Group Code <span class="required">*</span></div>
					<div class="col-sm-8">
						<div class="input-group" id="sel_identity">
						</div>
					</div>
				</div>
				<div class="form-row" style="display:none">
					<div class="col-4 name">Reason Code <span class="required">*</span></div>
					<div class="col-sm-8">
						<div class="input-group">

							<input class="input--style-6" autocomplete="off" autofocus="on" id="sel_reason_code"
								name="sel_reason_code" type="Text" value="" onfocus="hlentry(this)" size="30"
								maxlength="50" style="text-transform:uppercase;width: 60%;"
								validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
						</div>
					</div>
				</div>

				<div class="form-row">
					<div class="col-4 name">Reason Name <span class="required">*</span></div>
					<div class="col-sm-8">
						<div class="input-group">

							<input class="input--style-6" autocomplete="off" autofocus="on" id="sel_reason_name_en"
								name="sel_reason_name_en" type="Text" value="" onfocus="hlentry(this)" size="30"
								maxlength="50" style="text-transform:uppercase;width: 60%;"
								validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
							<img src="../../asset/img/icons/flag_en.png">
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-4 name"></div>
					<div class="col-sm-8">
						<div class="input-group">

							<input class="input--style-6" autocomplete="off" autofocus="on" id="sel_reason_name_id"
								name="sel_reason_name_id" type="Text" value="" onfocus="hlentry(this)" size="30"
								maxlength="50" style="text-transform:uppercase;width: 60%;"
								validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
							<img src="../../asset/img/icons/flag_id.png">
						</div>
					</div>
				</div>
			</fieldset>

			<div class="modal-footer">
				<button type="reset" class="btn btn-primary1" data-dismiss="modal" aria-hidden="true">
					&nbsp;Cancel&nbsp;
				</button>

				<button class="btn btn-warning" type="submit" name="submit_update" id="submit_update">
					Confirm
				</button>
				<button class="btn btn-warning" type="button" name="submit_update2" id="submit_update2"
					style='display:none;' disabled>
					<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
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




























<!-- delete transaction modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="FormDisplayDelete">
<div class="modal-dialog" style="width: 25%;">
	<div class="modal-content">
		<form class="form-horizontal" action="php_action/FuncDataDelete.php<?php echo $getPackage; ?>" method="POST"
			id="updatedelMemberForm">

			<div class="modal-body">
				<div class="edit-messages"></div>
				<table width="100%">
					<tr>
						<td align="center"><img src="../../asset/dist/img/sf-mola-mola.png"
								style="max-width: 90%;margin-top: 20px;"></td>
					</tr>

				</table>
				<div class="form-group">
					<div class="col-sm-12">
						<table width="100%">
							<td align="center"><label id="isi">Are you sure to delete data ?</label></td>
						</table>
						<input type="hidden" class="form-control input-report" id="sel_reason_codeS"
							name="sel_reason_code" placeholder="">
					</div>
				</div>



				<div class="modal-footer-delete FormDisplayDelete" style="text-align: center;padding-top: 20px;">
					<button type="reset" class="btn btn-primary1" style="background: #ececec;" data-dismiss="modal"
						aria-hidden="true">
						&nbsp;Cancel&nbsp;
					</button>
					<button class="btn btn-warning" type="submit" name="submit_delete" id="submit_delete">
						Confirm
					</button>
					<button class="btn btn-warning" type="button" name="submit_delete2" id="submit_delete2"
						style='display:none;' disabled>
						<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
						&nbsp;&nbsp;Processing..
					</button>
				</div>
			</div>


		</form>
	</div><!-- /.modal-content -->
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
<script type="text/javascript">
// global the manage memeber table 
$(document).ready(function () {
	$("#CreateButton").on('click', function () {
		var empno = $(this).data("empno")
		alert(empno);
		// reset the form 
		$("#FormDisplayCreate")[0].reset();
		// empty the message div

		$(".messages_create").html("");

		// submit form
		$("#FormDisplayCreate").unbind('submit').bind('submit', function () {

			$(".text-danger").remove();

			var form = $(this);

			var inp_remark = $("#inp_remark").val();


			var regex = /^[a-zA-Z]+$/;

			if (inp_remark == "") {
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = "Remark cannot empty";

			}

			if (inp_remark) {

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

							$('#FormDisplayCreate').modal('hide');
							$("[data-dismiss=modal]").trigger({
								type: "click"
							});

							// reset the form
							$("#FormDisplayCreate")[0].reset();
							// reload the datatables
							datatable.ajax.reload(null, false);
							// this function is built in function of datatables;

							modals.style.display = "block";
							document.getElementById("msg").innerHTML = response
								.messages;
						} else {
							modals.style.display = "block";
							document.getElementById("msg").innerHTML = response
								.messages;

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

				$("#sel_approval_request_no").val(response.request_no);
				$("#sel_ipp_requester_spv_downS").val(response.requester);
				// $("#sel_remark_from_approver").val(response.remark);

				$("#cancellation_id").attr("data-id", response.request_no);

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

						document.getElementById("contoh").innerHTML = fill_is_urgent_request;

						if (fill_is_approved_spvdown == '0') { //jika sudah approve request
							document.getElementById("submit_reject_spvdown").style.display =
								"none";
							document.getElementById("submit_revision_spvdown").style.display =
								"none";
							document.getElementById("submit_approval_spvdown").style.display =
								"none";
						} else if (fill_is_ready == '0') { //jika sudah approve request
							document.getElementById("submit_reject_spvdown").style.display =
								"none";
							document.getElementById("submit_revision_spvdown").style.display =
								"none";
							document.getElementById("submit_approval_spvdown").style.display =
								"none";
						} else if (fill_is_urgent_request == 'Y' && fill_is_file_name ==
							'0') { //jika tipe request urgent dan attachment belum ada maka hide tombol
							document.getElementById("submit_reject_spvdown").style.display =
								"none";
							document.getElementById("submit_revision_spvdown").style.display =
								"none";
							document.getElementById("submit_approval_spvdown").style.display =
								"none";
						} else {
							document.getElementById("submit_reject_spvdown").style.display =
								"block";
							document.getElementById("submit_revision_spvdown").style.display =
								"block";
							document.getElementById("submit_approval_spvdown").style.display =
								"block";
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
					}

				});
			}

		});

	} else {
		alert("Error : Refresh the page again");
	}
}















































function editMember(id = null) {
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
			url: 'php_action/getSelectedEmployee.php<?php echo $getPackage; ?>',
			type: 'post',
			data: {
				member_id: id
			},
			dataType: 'json',


			success: function (response) {
				document.getElementById("sel_identity").innerHTML = response.reason_code;


				$("#sel_reason_code").val(response.reason_code);
				$("#sel_reason_name_en").val(response.reason_name_en);
				$("#sel_reason_name_id").val(response.reason_name_id);


				// here update the member data
				$("#FormDisplayUpdate").unbind('submit').bind('submit', function () {
					// remove error messages
					$(".text-danger").remove();

					var form = $(this);

					var sel_reason_code = $("#sel_reason_code").val();
					var sel_reason_name_en = $("#sel_reason_name_en").val();
					var sel_reason_name_id = $("#sel_reason_name_id").val();

					var regex = /^[a-zA-Z]+$/;

					if (sel_reason_code == "") {
						modals.style.display = "block";
						document.getElementById("msg").innerHTML = "Reason code cannot empty";

					} else if (sel_reason_name_en == "") {
						modals.style.display = "block";
						document.getElementById("msg").innerHTML = "Reason desc en cannot empty";

					} else if (sel_reason_name_id == "") {
						modals.style.display = "block";
						document.getElementById("msg").innerHTML = "Reason desc id cannot empty";

					} else {
						$('#submit_update').hide();
						$('#submit_update2').show();
					}


					if (sel_reason_code && sel_reason_name_en && sel_reason_name_id) {

						$.ajax({

							url: form.attr('action'),
							type: form.attr('method'),
							// data: form.serialize(),

							data: new FormData(this),
							processData: false,
							contentType: false,

							dataType: 'json',
							success: function (response) {

								if (response.code == 'success_message') {
									modals.style.display = "block";
									document.getElementById("msg").innerHTML = response
										.messages;

									$('#submit_update').show();
									$('#submit_update2').hide();

									$('#FormDisplayUpdate').modal('hide');
									$("[data-dismiss=modal]").trigger({
										type: "click"
									});

									// reload the datatables
									datatable.ajax.reload(null, false);
									// reload the datatables

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

















































function editdelMember(id = null) {
	if (id) {

		// remove the error 
		$(".form-group").removeClass('has-error').removeClass('has-success');
		$(".text-danger").remove();
		// empty the message div
		$(".edit-messages").html("");

		// remove the id
		$("#member_id").remove();

		// fetch the member data
		$.ajax({
			url: 'php_action/getSelectedEmployee.php<?php echo $getPackage; ?>',
			type: 'post',
			data: {
				member_id: id
			},
			dataType: 'json',
			success: function (response) {

				$("#sel_reason_codeS").val(response.reason_code);

				// mmeber id 
				$(".FormDisplayDelete").append(
					'<input type="hidden" name="member_id" id="member_id" value="' + response.id +
					'"/>');

				// here update the member data
				$("#updatedelMemberForm").unbind('submit').bind('submit', function () {
					// remove error messages
					$(".text-danger").remove();

					var form = $(this);

					// validation

					var sel_reason_code = $("#sel_reason_codeS").val();

					if (sel_reason_code == "") {
						modals.style.display = "block";
						document.getElementById("msg").innerHTML =
							"Shiftgroup schedule code cannot empty";
					} else {
						$('#submit_delete').hide();
						$('#submit_delete2').show();
					}


					if (sel_reason_code) {
						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success: function (response) {
								if (response.code == 'success_message') {
									modals.style.display = "block";
									document.getElementById("msg").innerHTML = response
										.messages;

									$('#submit_delete').show();
									$('#submit_delete2').hide();

									// reload the datatables
									datatable.ajax.reload(null, false);
									// reload the datatables

									$('#FormDisplayDelete').modal('hide');
									$("[data-dismiss=modal]").trigger({
										type: "click"
									});

								} else {
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
</script>
<!-- isi JSONs -->
</body>

</html>

<script type="text/javascript">
$(document).ready(function () {
	$('#inp_startdate').bootstrapMaterialDatePicker({
		time: false,
		clearButton: true
	});
	$('#inp_enddate').bootstrapMaterialDatePicker({
		time: false,
		clearButton: true
	});

});
</script>

<script>
jQuery(function ($) {
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
		url: 'ajax_cek.php<?php echo $getPackage; ?>',
		data: "nip=" + nip,
	}).success(function (data) {
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