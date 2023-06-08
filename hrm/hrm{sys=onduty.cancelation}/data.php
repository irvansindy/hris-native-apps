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
		searching: true,
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
					<!-- <td>
						<a href='#' class='open_modal_search' class="btn btn-demo" data-toggle="modal"
							data-target="#myModal2">
							<div class="toolbar sprite-toolbar-search" id="SEARCH" title="Search">
							</div>
						</a>
					</td> -->
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
						<th class="fontCustom" style="z-index: 1;">On Duty Request No</th>
						<th class="fontCustom" style="z-index: 1;">Type of Leave</th>
						<th class="fontCustom" style="z-index: 1;">Request Date</th>
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

				<div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 100%; overflow: scroll;overflow-x: hidden;">
					<div id="filter_onduty">
						<fieldset id="fset_1">
							<legend>General Filter</legend>
							<div class="messages_create"></div>
							<input id="inp_emp_no" name="inp_emp_no" type="hidden" value="<?php echo $username; ?>">
							<!--FROM SESSION -->
							<input id="inp_token" name="inp_token" type="hidden" value="<?php echo $get_token; ?>">
							<!--FROM CONFIGURATION -->
							<div class="form-row">
								<div class="col-4 name">Employee no*</div>
								<div class="col-sm-8">
									<div class="input-group card-body table-responsive p-0">
										<td>
											<input class="input--style-6"
												autocomplete="off" autofocus="on" id="emp_no_for" name="emp_no_for" type="Text"
												onfocus="this.value=''" size="30" value=""
												maxlength="50" validate="NotNull:Invalid Form Entry"
												data-emp="<?php echo $username; ?>">
											</div>
											<div id="employeeList"></div>
											<input type="hidden" name="emp_id_for" id="emp_id_for">
										</td>
								</div>
							</div>
							<div class="form-row">
								<div class="col-4 name">On Duty Request No.</div>
								<div class="col-sm-8">
									<div class="input-group">
										<input class="input--style-6" id="input_onduty_request" name="input_onduty_request" type="Text"
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
								<div class="col-sm-8 name">
									<button id="show_preview_leave_request" class='btn btn-default' data-empno='<?php echo $username; ?>'>
										Show
									</button>
								</div>
							</div>
						</fieldset>
					</div>
					<div id="table_on_duty_request"></div>
					<div id="table_on_duty_detail_request"></div>
				</div>
				<div id="button_submit_data"></div>
			</form>
		</div>
	</div>
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /edit modal -->

<!-- add modal -->
<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="FormDisplayDetailApproval">
<div class="modal-dialog modal-belakang modal-bs modal-med" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title">On Duty Approval</h4>
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
							<div class="input-group" id="detail_request_no"
								style="font-weight: bold;color: #5b5b5b;">
							</div>
						</div>
					</div>

					<div class="form-row">
						<div class="col-sm-4 name"> Employee <span class="required">*</span></div>
						<div class="col-sm-8 name">
							<div class="input-group" id="detail_requester_employee"
								style="font-weight: bold;color: #5b5b5b;">
							</div>
						</div>
					</div>

					<div class="form-row">
						<div class="col-sm-4 name"> Detail On Duty <span class="required">*</span></div>
						<div class="col-sm-8 name">
							<div class="input-group" id="detail_purpose"
								style="font-weight: bold;color: #5b5b5b;">
							</div>
						</div>
					</div>
					
					<div class="form-row">
						<div class="col-sm-4 name"> Date <span class="required">*</span></div>
						<div class="col-sm-8 name">
							<div class="input-group" id="detail_request_date"
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
					&nbsp;Close&nbsp;
				</button>
				<a id="cancel_onduty" style="padding-top: 10px;" class="btn-sdk btn-primary-right delete" type="submit"
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
<script src="js/jquery.min.js"></script>
<!-- get list employee -->
<script>
	$('#emp_no_for').focus(function(){
		var value = $(this).val()
		var emp = $(this).data("emp")
		$('#emp_id_for').val("")

		if (value != '') {
			$.ajax({
				url: 'php_action/getListUser.php',
				type: 'POST',
				data: {
					value: value,
					emp: emp
				},
				// dataType: 'json',
				// async: true,
				success: function(response) {
					$('#employeeList').fadeIn();
					$('#employeeList').html(response);
				}
			})
		}
	})
	
	$('#emp_no_for').keyup(function(){
		var value = $(this).val()
		var emp = $(this).data("emp")
		if (value != '') {
			$.ajax({
				url: 'php_action/getListUser.php',
				type: 'POST',
				data: {
					value: value,
					emp: emp
				},
				// dataType: 'json',
				// async: true,
				success: function(response) {
					$('#employeeList').fadeIn();
					$('#employeeList').html(response);
				}
			})
		}
	})

	$('#emp_no_for').mouseover(function () {
		$('#employeeList').fadeOut();
	});

	$(document).on('click', 'li', function () {
		$('#emp_no_for').val($(this).text());
		$('#employeeList').fadeOut();

		var emps = document.getElementById("emp_no_for").value;

		var myarr = emps.split(" ");

		var myvar = myarr[1];
		var myvar2 = myarr[2];

		$("#inp_careerhistory").val(myvar);
		$("#inp_empperformance").val(myvar2);

		//     alert(emps);
		$.ajax({
			url: 'php_action/getCareer.php',
			type: 'post',
			data: {
				employee: emps
			},
			dataType: 'json',
			success: function (response_career) {
				var fill_is_approved_spvdown =
					response_career.emp_no;
				var career = response_career.history_no +
					'-' + response_career.secon;
				$('#emp_id_for').val(response_career.emp_id)
				// alert(career);
			}
		}); // /ajax

	});
</script>

<!-- isi JSON -->
<script type="text/javascript">

	$(document).ready(function() {
		$("#CreateButton").on('click', function () {
			var empno = $(this).data("empno")
			// reset the form 
			$("#FormDisplayCreate")[0].reset();
			// empty the message div
			$(".messages_create").html("");
			$('#filter_onduty').show()
			$('#table_on_duty_request').show()
			$('#table_on_duty_request').empty()
			$('#table_on_duty_detail_request').empty()
			$('#button_submit_data').empty()
		
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
			});
		
		});
	})

	$("#show_preview_leave_request").click(function () {
		var empno = $(this).data('empno')
		var input_onduty_request = $('#input_onduty_request').val()
		var emp_no_for = $('#emp_no_for').val()
		var emp_id_for = $('#emp_id_for').val()
		var inp_startdate = $('#inp_startdate').val()
		var inp_enddate = $('#inp_enddate').val()

		// console.log(emp_id_for)
		$('#table_on_duty_request').empty()
		$.ajax({
			url: 'php_action/getListDataOnDutyRequest.php',
			type: 'GET',
			data: {
				empno: empno,
				emp_id_for: emp_id_for,
				inp_startdate: inp_startdate,
				inp_enddate: inp_enddate,
				input_onduty_request: input_onduty_request
			},
			dataType: 'json',
			async: true,
			success: function(response) {
				// alert(response.messages)
				$('#table_on_duty_request').append(`
					<fieldset id="fset_1">
						<legend>List On Duty Request</legend>
						<div>
							<table class="table table-striped table-bordered display mt-4" id="tableOnDuty">
								<thead class="thead-light">
									<tr>
										<th style="text-align:center">Request Number</th>
										<th style="text-align:center">Start Date</th>
										<th style="text-align:center">End Date</th>
									</tr>
								</thead>
								<tbody id="list_data_on_duty_request">
								</tbody>
							</table>
						</div>
					</fieldset>
				`);

				$('#list_data_on_duty_request').empty()
				for (let index = 0; index < response.data.length; index++) {
					$('#list_data_on_duty_request').append(`
						<tr>
							<td style="width:20%;text-align:left;">
								<a href="#" class="buttonOnDutyRequest" data-id="${response.data[index]['request_no']}" data-empid ="${response.data[index]['emp_id']}" data-requestby="${response.requestby}">
									${response.data[index]['request_no'] == null ? '' : response.data[index]['request_no']}
								</a>
							</td>
							<td style="width:20%;text-align:left;">
								${response.data[index]['requestdate'] == null ? '' : moment(response.data[index]['requestdate']).format('LL')}
							</td>
							<td style="width:20%;text-align:left;">
								${response.data[index]['requestenddate'] == null ? '' : moment(response.data[index]['requestenddate']).format('LL')}
							</td>
						</tr>
					`)
				}

			},
			error: function(xhr, status, error) {
				mymodalss.style.display = "none";
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = xhr.responseJSON.messages;
			}
		})
	});

	$('body').on('click tap', '.buttonOnDutyRequest', function(e) {
		var target = $(e.target);
		var request_no = target.data("id");
		var emp_id = target.data("empid");
		var requestby = target.data("requestby");
		e.preventDefault()
		// alert(emp_id)
		$('#table_on_duty_detail_request').empty()
		$.ajax({
			url: 'php_action/getListDataDetailOnDutyRequest.php',
			type: 'GET',
			data: {
				request_no: request_no,
				requestby: requestby
			},
			dataType: 'json',
			async: true,
			success: function(response) {
				$('#table_on_duty_request').hide()
				$('#filter_onduty').hide()
				$('#table_on_duty_detail_request').append(`
					<fieldset id="fset_1">
						<legend>List On Duty Detail Request</legend>
						<div class="form-row">
							<div class="col-4 name">On Duty Request No : </div>
							<div class="col-sm-8 name">
								${response.data[0][0]['request_no']}
								<input id="input_onduty_request_no" name="input_onduty_request_no" type="Hidden" value="${response.data[0][0]['request_no']}">
							</div>
						</div>
						<div class="form-row">
							<div class="col-4 name">Request For</div>
							<div class="col-sm-8 name">
								[${response.data[0][0]['emp_no']}] - ${response.data[0][0]['Full_Name']}
								<input id="input_onduty_request_for" name="input_onduty_request_for" type="Hidden" value="${response.data[0][0]['requestfor']}">
								<input id="input_onduty_request_by" name="input_onduty_request_by" type="Hidden" value="${response.requestby}">
							</div>
						</div>
						<div class="form-row">
							<div class="col-4 name">Purpose On Duty</div>
							<div class="col-sm-8 name">
								${response.data[0][0]['purpose_name_en']}
								<input id="input_onduty_purpose_code" name="input_onduty_purpose_code" type="Hidden" value="${response.data[0][0]['purpose_code']}">
							</div>
						</div>
						<div class="form-row">
							<div class="col-4 name">Remark</div>
							<div class="col-sm-8 name">
								${response.data[0][0]['remark']}
							</div>
						</div>
						<div class="form-row">
							<div class="col-4 name">Remark Cancelation</div>
							<div class="col-sm-8 name">
								<textarea  class="input--style-6"  rows="3" cols="40" id="input_remark_cancelation" name="input_remark_cancelation"></textarea>
							</div>
						</div>
						<div>
							<table class="table table-striped table-bordered display mt-4" id="tableOnDuty">
								<thead class="thead-light">
									<tr>
										<th style="text-align:center">
											<input type="checkbox" class="inputCheckAll" name="checkAllRequest[]" onclick="checkAll(this)"> <span>Check All</span>
											
										</th>
										<th style="text-align:center">Number</th>
										<th style="text-align:center">Start Date</th>
										<th style="text-align:center">End Date</th>
									</tr>
								</thead>
								<tbody id="list_data_on_duty_detail_request">
								</tbody>
							</table>
						</div>
						<div>
							<button type="button" class="btn btn-danger btn-sm" id="backOnDutyRequest" style="float: right;">Back</button>
						</div>
					</fieldset>
					`)
					
					$('#button_submit_data').append(`
					<div class="modal-footer-sdk">
						<button type="reset" class="btn-sdk btn-primary-left" data-dismiss="modal" aria-hidden="true">
							&nbsp;Cancel&nbsp;
						</button>
						<button class="btn-sdk btn-primary-right" type="button" name="submit_request" id="submit_request">
							Confirm
						</button>
					</div>
				`)

				let no = 1;
				let checked = 1;
				for (let index = 0; index < response.data[1].length; index++) {
					$('#list_data_on_duty_detail_request').append(`
						<tr>
							<td style="width:20%;text-align:left;">
								<input class="input--style-7" type="checkbox" class="checkbox-tanggal" name="checked[]" onclick="checklist(this)" value="${checked++}">
							</td>
							<td style="width:20%;text-align:left;">
								${no++}
							</td>
							<td style="width:20%;text-align:left;">
								${response.data[1][index]['startdate'] == null ? '' : moment(response.data[1][index]['startdate']).format('LL')}
								<input type="hidden" id="startdate_detail" name="startdate_detail[]" value="${response.data[1][index]['startdate']}"></input>
							</td>
							<td style="width:20%;text-align:left;">
								${response.data[1][index]['enddate'] == null ? '' : moment(response.data[1][index]['enddate']).format('LL')}
								<input type="hidden" id="enddate_detail" name="enddate_detail[]" value="${response.data[1][index]['enddate']}"></input>
							</td>
						</tr>
					`)
				}
			},
			error: function(xhr, status, error) {
				mymodalss.style.display = "none";
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = xhr.responseJSON.messages;
			}
		})
	})

	$('body').on('click tap', '#backOnDutyRequest', function() {
		$('#filter_onduty').show()
		$('#table_on_duty_request').show()
		$('#table_on_duty_detail_request').empty()
		$('#button_submit_data').empty()
	})

	function checkAll(e) {
		var checkboxes = document.getElementsByTagName('input')
		var checkboxes = document.getElementsByName('checked[]')
		
		if(e.checked) {
			for (let index = 0; index < checkboxes.length; index++) {
				if(checkboxes[index].type == 'checkbox' && !(checkboxes[index].disabled)) {
					checkboxes[index].checked = true;
					// let data = document.querySelector('input[name="checked[]"]:checked').value
					// var values = [].filter.call(document.getElementsByName('checked[]'), (c) => c.checked).map(c => c.value).length;
					// console.log(values)
				}
			}
		} else {
			for (var index = 0; index < checkboxes.length; index++) {
				if (checkboxes[index].type == 'checkbox') {
					checkboxes[index].checked = false;
				}
			}
		}
	}

	function checklist() {
		let checked = document.getElementsByName('checked[]')
		let checked_values = [].filter.call(document.getElementsByName('checked[]'), (c) => c.checked).map(c => c.value).length;
		for (let index = 0; index < checked.length; index++) {
			var checked_data = checked[index];
			if(checked_data.type == 'checkbox' && checked_data.checked == false) {
				let checked_parent = document.getElementsByName('checkAllRequest[]')
				for (let index = 0; index < checked_parent.length; index++) {
					if (checked_parent[index].type == 'checkbox') {
						checked_parent[index].checked = false
					}
				}
			} else if(checked.length == checked_values) {
				let checked_parent = document.getElementsByName('checkAllRequest[]')
				for (let index = 0; index < checked_parent.length; index++) {
					if (checked_parent[index].type == 'checkbox') {
						checked_parent[index].checked = true
					}
				}
				// checked_parent[index].checked = true
			}
			// else if ($('input:checkbox[name=checked[]]:checked').length) {

			// }
		}
	}
	// input:checkbox[name=checked[]]:checked
	$('body').on('click tap', '.checkbox-tanggal', function() {
		console.log('get attr')
	})

	$('body').on('click', '#submit_request', function() {
		$.ajax({
			url: 'php_action/funcDataCreate.php',
			type: 'POST',
			data: new FormData($('#FormDisplayCreate')[0]),
			// data: data,
			processData: false,
			contentType: false,
			dataType: 'json',
			success: function (response) {
				// alert('sukses')
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
				document.getElementById("msg").innerHTML = response.messages;
			},
			error: function(xhr, status, error) {
				// alert('gagal')
				mymodalss.style.display = "none";
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = xhr.responseJSON.messages;
			}
		})
	})

	$('.close-create').on('click', function() {
		// $('#table_on_duty_request').empty()
		$('#table_on_duty_detail_request').empty()
		$('#button_submit_data').empty()
	})

	function detailApproval(request_no) {
		$('#list_user_approval_detail').empty()
		$('.cancel_button').removeAttr('style')

		$.ajax({
			url: 'php_action/FuncGetDetailApproval.php<?php echo $getPackage; ?>',
			// url: 'php_action/getSelectedRequest.php<?php echo $getPackage; ?>',
			type: 'post',
			data: {
				request_no: request_no
			},
			dataType: 'json',
			success: function(response) {
				if (response.data[2].status_request == 1) {
					$("#cancel_button_0").css("display", "none")
					$("#cancel_button_1").css("display", "none")
					$("#cancel_button_2").css("display", "true")
					$('#cancel_onduty').attr('data-request_no', response.data[0].request_no)
				} else {
					$("#cancel_button_0").css("display", "true")
					$("#cancel_button_1").css("display", "none")
					$("#cancel_button_2").css("display", "none")
				}
				document.getElementById("detail_request_no").innerHTML = response.data[0].request_no;
				document.getElementById("detail_requester_employee").innerHTML = response.data[0].Full_Name + " (" + response.data[0].emp_no + ") "
				document.getElementById("detail_purpose").innerHTML = response.data[0].purpose_name_en
				document.getElementById("detail_request_date").innerHTML = response.data[0].requestdate

				// auto number list approval
				let no = 1

				for (let index = 0; index < response.data[1].length; index++) {
					$('#list_user_approval_detail').append(
						`
						<tr>
							<td style="width:20%;text-align:left;">
								${no++}
							</td>
							<td style="width:20%;text-align:left;">
								${response.data[1][index]['Full_Name'] == null ? '' : response.data[1][index]['Full_Name']} - ${response.data[1][index]['emp_no'] == null ? '' : response.data[1][index]['emp_no']}
							</td>
							<td style="width:20%;text-align:left;">
								${response.data[1][index]['req'] == null ? '' : response.data[1][index]['req']}
								</td>
							<td style="width:20%;text-align:left;">
								${response.data[1][index]['status_approve'] == null ? '' : response.data[1][index]['status_approve']}
							</td>
						</tr>
						`
					);
				}
			},
			error: function(xhr, status, error) {
				alert('error')
				mymodalss.style.display = "none";
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = xhr.responseJSON.messages;
			}
		})
		// mymodalss.style.display = "block";
		// if (request_no) {
		// 	$.ajax({
		// 		url: 'php_action/getSelectedRequest.php<?php echo $getPackage; ?>',
		// 		type: 'post',
		// 		data: {
		// 			request_no: request_no
		// 		},
		// 		dataType: 'json',
		// 		success: function (response) {
		// 			alert('wkwkwkwk')
		// 			document.getElementById("detail_request_no").innerHTML = response.request_no;
		// 			document.getElementById("detail_purpose").innerHTML = response.leave_code +
		// 				" ( Total Days : " + response.totaldays + ") " + " Leave Date " + response
		// 				.leave_startdates + " - " + response.leave_enddates;
		// 			document.getElementById("detail_requester_employee").innerHTML = response.Full_Name + " (" +
		// 				response.emp_no + ") ";

		// 			// document.getElementsByTagName("harusdiselipin").setAttribute("class", "democlass"); 
		// 			$("#submit_reject_spvdown").attr("onclick", "editreject_approval(`" + response.request_no +
		// 				"`)");
		// 			$("#submit_revision_spvdown").attr("onclick", "editrevision_approval(`" + response
		// 				.request_no + "`)");
		// 			// onclick="editrejectrequest(`PAREQ2022-130299`)"

		// 			$("#sel_approval_request_no").val(response.request_no);
		// 			$("#sel_ipp_requester_spv_downS").val(response.requester);
		// 			// $("#sel_remark_from_approver").val(response.remark);

		// 			$("#cancellation_id").attr("data-id", response.request_no);

		// 			$("#box_approval_request_detail").load(
		// 				"pages_relation/_pages_approval.php<?php echo $getPackage; ?>rfid=" + response
		// 				.request_no,
		// 				function (responseTxt, statusTxt, jqXHR) {
		// 					if (statusTxt == "success") {

		// 						$("#box_approval_request_detail").show();
		// 					}
		// 					if (statusTxt == "error") {
		// 						alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
		// 					}
		// 				}
		// 			);


		// 			$.ajax({
		// 				url: 'php_action/getRequestStatus.php<?php echo $getPackage; ?>',
		// 				type: 'post',
		// 				data: {
		// 					request_no: response.request_no
		// 				},
		// 				dataType: 'json',
		// 				success: function (response) {

		// 					mymodalss.style.display = "none";

		// 					if (response.status_request == 1) {
		// 						$("#modalcancelcondition_0").hide();
		// 						$("#modalcancelcondition_1").hide();
		// 						$("#modalcancelcondition_2").show();
		// 					} else {
		// 						$("#modalcancelcondition_0").hide();
		// 						$("#modalcancelcondition_1").show();
		// 						$("#modalcancelcondition_2").hide();
		// 					}

		// 					document.getElementById("contoh").innerHTML = fill_is_urgent_request;

		// 					if (fill_is_approved_spvdown == '0') { //jika sudah approve request
		// 						document.getElementById("submit_reject_spvdown").style.display =
		// 							"none";
		// 						document.getElementById("submit_revision_spvdown").style.display =
		// 							"none";
		// 						document.getElementById("submit_approval_spvdown").style.display =
		// 							"none";
		// 					} else if (fill_is_ready == '0') { //jika sudah approve request
		// 						document.getElementById("submit_reject_spvdown").style.display =
		// 							"none";
		// 						document.getElementById("submit_revision_spvdown").style.display =
		// 							"none";
		// 						document.getElementById("submit_approval_spvdown").style.display =
		// 							"none";
		// 					} else if (fill_is_urgent_request == 'Y' && fill_is_file_name ==
		// 						'0') { //jika tipe request urgent dan attachment belum ada maka hide tombol
		// 						document.getElementById("submit_reject_spvdown").style.display =
		// 							"none";
		// 						document.getElementById("submit_revision_spvdown").style.display =
		// 							"none";
		// 						document.getElementById("submit_approval_spvdown").style.display =
		// 							"none";
		// 					} else {
		// 						document.getElementById("submit_reject_spvdown").style.display =
		// 							"block";
		// 						document.getElementById("submit_revision_spvdown").style.display =
		// 							"block";
		// 						document.getElementById("submit_approval_spvdown").style.display =
		// 							"block";
		// 					}
		// 				}
		// 			}); // /ajax

		// 			// mmeber id 
		// 			$(".FormDisplayDetailApproval").append(
		// 				'<input type="hidden" name="member_id" id="member_id" value="' + response.id +
		// 				'"/>');

		// 			// here update the member data
		// 			$("#updatedelMemberForm").unbind('submit').bind('submit', function () {

		// 				// remove error messages
		// 				$(".text-danger").remove();

		// 				var form = $(this);

		// 				// validation
		// 				var sel_approval_request_no = $("#sel_approval_request_no").val();
		// 				var sel_emp_no_approver = $("#sel_emp_no_approver").val();

		// 				if (sel_approval_request_no == "") {
		// 					modals.style.display = "block";
		// 					document.getElementById("msg").innerHTML = "There is some error";
		// 				} else if (sel_emp_no_approver == "") {
		// 					modals.style.display = "block";
		// 					document.getElementById("msg").innerHTML = "There is some error";
		// 				} else {
		// 					$('#submit_approval_spvdown').hide();
		// 					$('#submit_approval_spvdown2').show();
		// 					mymodalss.style.display = "block";
		// 				}

		// 				if (sel_approval_request_no && sel_emp_no_approver) {


		// 					$.ajax({
		// 						url: form.attr('action'),
		// 						type: form.attr('method'),
		// 						data: form.serialize(),
		// 						dataType: 'json',
		// 						success: function (response) {
		// 							if (response.code == 'success_message_approved') {



		// 								$('#submit_approval_spvdown').show();
		// 								$('#submit_approval_spvdown2').hide();

		// 								mymodalss.style.display = "none";

		// 								// reload the datatables
		// 								datatable.ajax.reload(null, false);
		// 								// reload the datatables

		// 								$('#FormDisplayDetailApproval').modal('hide');

		// 								$("[data-dismiss=modal]").trigger({
		// 									type: "click"
		// 								});

		// 								modals.style.display = "block";
		// 								document.getElementById("msg").innerHTML = response
		// 									.messages;



		// 							} else {
		// 								$('#submit_approval_spvdown').show();
		// 								$('#submit_approval_spvdown2').hide();

		// 								mymodalss.style.display = "none";

		// 								modals.style.display = "block";
		// 								document.getElementById("msg").innerHTML = response
		// 									.messages;
		// 								// reload the datatables      
		// 							}
		// 						} // /success
		// 					}); // /ajax
		// 				} // /if

		// 				return false;
		// 			});

		// 		} // /success
		// 	}); // /fetch selected member info

		// 	// Delete 
		// 	$('.delete').click(function () {
		// 		var el = this;

		// 		// Delete id
		// 		var deleteid = $(this).data('id');

		// 		var confirmalert = confirm("Are you sure to cancel request?");
		// 		if (confirmalert == true) {
		// 			// AJAX Request
		// 			$.ajax({
		// 				url: 'php_action/FuncDataDelete.php<?php echo $getPackage; ?>id=' + deleteid,
		// 				type: 'GET',
		// 				processData: false,
		// 				contentType: false,
		// 				dataType: 'json',
		// 				success: function (response) {
		// 					if (response.code == 'success_message') {
		// 						mymodals_withhref.style.display = "block";
		// 						document.getElementById("msg_href").innerHTML = response.messages;
		// 					} else {
		// 						mymodals_withhref.style.display = "block";
		// 						document.getElementById("msg_href").innerHTML = response.messages;
		// 						return false;
		// 					}
		// 				}

		// 			});
		// 		}

		// 	});

		// } else {
		// 	alert("Error : Refresh the page again");
		// }
	}

	$('#cancel_onduty').click(function () {
		var request_no = $(this).data('request_no')
		var confirmation = confirm("Are you sure to cancel request " + request_no + " ?")
		if (confirmation == true) {
			// alert('success cancel')
			$.ajax({
				// url: 'php_action/FuncCancelFromUser.php',
				url: 'php_action/FuncCancelFromUser.php<?php echo $getPackage; ?>request_no=' + request_no,
				type: 'GET',
				processData: false,
				contentType: false,
				dataType: 'json',
				success: function (response) {
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
					document.getElementById("msg").innerHTML = response.messages;
				},
				error: function(xhr, status, error) {
					// alert('gagal')
					mymodalss.style.display = "none";
					modals.style.display = "block";
					document.getElementById("msg").innerHTML = xhr.responseJSON.messages;
				}
			})
		} 
	})
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