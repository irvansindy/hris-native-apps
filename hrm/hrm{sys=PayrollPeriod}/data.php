<!-- MAIN DATATABLE SERVERSIDE CSS -->
<!-- MAIN DATATABLE SERVERSIDE CSS -->
<script type="text/javascript" src="../../asset/sdk_datatables_core/gt_dist/jQuery-2.1.4.min.js"></script>
<script type="text/javascript"
	src="../../asset/sdk_datatables_core/datatables/bedanihbuatjson/bootstrap/js/bootstrap.min.js"></script>
<!-- MAIN DATATABLE SERVERSIDE CSS -->
<!-- MAIN DATATABLE SERVERSIDE CSS -->



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

		$('#inp_add_paydate').bootstrapMaterialDatePicker({
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

		$('#inp_pdtype_paytime').bootstrapMaterialDatePicker({
			date: false,
			format: 'HH:mm'
		});
	});
</script>

<!-- isi JSON -->
<script type="text/javascript">
	// global the manage memeber table 
	$(document).ready(function () {
		datatable = $("#datatable").DataTable({

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
			bAutoWidth: true,
			language: {
				"processing": "Please wait..",
			},
			// columnDefs: [{
			//        orderable: false,
			//        targets: 7
			// }],
			destroy: true,
			"ajax": "php_action/FuncDataRead.php"
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

<div class="MaximumFrameHeight card-body table-responsive p-0"
	style="width: 100vw;height: 80vh; width: 98%; margin-right: 5px;overflow: scroll;overflow-x: hidden;margin-top: 17px;">
	<div class="col-12 col-fit" style="margin-top: 17px;">
		<table id="datatable" width="100%" border="1" align="left"
			class="table table-bordered table-striped table-hover table-head-fixed">
			<thead>
				<tr>
					<th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No</th>
					<th class="fontCustom" style="z-index: 1;">Period ID</th>
					<th class="fontCustom" style="z-index: 1;">Period Name </th>
					<th class="fontCustom" style="z-index: 1;">Pay Date</th>
					<th class="fontCustom" style="z-index: 1;">Start Date</th>
					<th class="fontCustom" style="z-index: 1;">End Date</th>
					<th class="fontCustom" style="z-index: 1;">Interval Period</th>
					<th class="fontCustom" style="z-index: 1;">Status</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

<!-- add modal -->
<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="CreateForm">
	<div class="modal-dialog modal-belakang modal-med" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="modal--title"></h4>
				<a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close"
					style="margin-top: -15px;">
					<span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
				</a>
			</div>

			<form class="form-horizontal" method="POST" id="FormDisplayCreate" onkeydown="return event.key != 'Enter';">

				<div class="card-body table-responsive p-0"
					style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

					<input type="hidden" name="function" id="function" value="create" />

					<fieldset id="fset_1">
						<legend>Payroll Period Form</legend>



						<div class="form-row" id="period_id_form">
							<div class="col-3 name">Period ID <font color="red">*</font>
							</div>
							<div class="col-sm-8">
								<div class="input-group">
									<input class="input--style-6" type="Text" id="inp_period_id" name="inp_period_id"
										value="" autocomplete="off" autofocus="on" size="30" maxlength="50"
										placeholder="period_id" title="period_id">
								</div>
							</div>
						</div>

						<div class="form-row">
							<div class="col-3 name">Period Name <font color="red">*</font>
							</div>
							<div class="col-sm-8">
								<div class="input-group">
									<input class="input--style-6" type="Text" id="inp_period_name"
										name="inp_period_name" value="" autocomplete="off" autofocus="on" size="30"
										maxlength="50" placeholder="period_name" title="period_name">

								</div>


							</div>



						</div>


						<div class="form-row">
							<div class="col-3 name">Pay Date <font color="red">*</font>
							</div>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="inp_add_paydate" name="inp_add_paydate"
										class="input--style-6" placeholder="Pay Date" style="background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                             background-size: 17px;
                                                                             background-position:right;   
                                                                             background-repeat:no-repeat; 
                                                                             padding-right:10px;" autocomplete="off" />
								</div>


							</div>



						</div>





						<div class="form-row" id="period_date">
							<div class="col-lg-3 name">Date Between <font color="red">*</font>
							</div>
							<div class="col-lg-4">
								<div class="input-group">
									<input type="text" id="inp_add_startdate" name="inp_add_startdate"
										class="input--style-6" placeholder="Start Date" style="background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                             background-size: 17px;
                                                                             background-position:right;   
                                                                             background-repeat:no-repeat; 
                                                                             padding-right:10px;" autocomplete="off" />
								</div>
							</div>

							<div class="col-lg-4">
								<div class="input-group">
									<input type="text" id="inp_add_enddate" name="inp_add_enddate"
										class="input--style-6" placeholder="End Date" style="background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                             background-size: 17px;
                                                                             background-position:right;   
                                                                             background-repeat:no-repeat; 
                                                                             padding-right:10px;" autocomplete="off" />
								</div>
							</div>
						</div>


						<div class="form-row">
							<div class="col-3 name">Interval Period <font color="red">*</font>
							</div>
							<div class="col-sm-8">
								<div class="input-group">
									<select class="input--style-6" name="inp_interval_period" id="inp_interval_period"
										style="width: 100%;height: 30px;">
										<option value="">--Select One--</option>
										<option value="D">Daily</option>
										<option value="M">Monthly</option>
										<option value="Y">Yearly</option>



									</select>
								</div>
							</div>
						</div>


						<div class="form-row" id="Upload2" style="display:none">

							<input type="hidden" name="inp_status_code" id="inp_status_code" value="1">

							<div class="col-sm-3 name">Active status? </div>
							<div class="col-sm-8">
								<div class="input-group" id="tr_inp_status">
									<div class="vc-toggle-container">
										<label class="vc-switch">
											<input type="checkbox" checked="checked" name="inp_status" id="inp_status"
												class="vc-switch-input">
											<span class="vc-switch-label" data-on="Yes" data-off="No"></span>
											<span class="vc-handle"></span>
										</label>
									</div>
								</div>
							</div>
						</div>



						<div class="form-row" id="show_employees">
							<div class="col-3 name">Employee<font color="red">*</font>
							</div>

						</div>

						<div class="form-row" id="show_employees_table">
							<div class="col-lg-11">
								<div class="card-body table-responsive p-0"
									style="width: 100vw;height: 30vh; width: 100%; overflow: scroll;overflow-x: hidden;border:1px solid #d2d2d2;border-radius: 4px;">
									<div id="box_add_employee"></div>
								</div>
							</div>
						</div>







				</div>

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
			</form>
		</div>
	</div>
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /edit modal -->










































<!-- delete transaction modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="FormDisplayDelete">

	<div class="modal-dialog modal-vsm" style="margin-top: 120px;">
		<div class="modal-content" style="border-radius: 5px;">
			<form class="form-horizontal" action="php_action/FuncDataDelete.php" method="POST" id="DeleteFormDisplay">

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
								<td align="center"><label id="isi" style="margin-bottom: 13px;">Are you sure to delete
										this position ?</label></td>
							</table>
							<input type="hidden" id="shiftdailycode_delete" name="shiftdailycode_delete">
						</div>
					</div>

					<div class="modal-footer-delete FormDisplayDelete" id="bottom_action"
						style="text-align: center;padding-bottom: 14px;">
						<button type="reset" class="btn btn-primary1" data-dismiss="modal" onclick="ResetTable();"
							aria-hidden="true">
							&nbsp;Cancel&nbsp;
						</button>
						<button class="btn btn-warning" type="submit" name="submit_delete" id="submit_delete">
							Confirm
						</button>
					</div>

					<div class="modal-footer-sdk" id="bottom_action1" style="background: transparent;display:none;">
						<button type="reset" class="btn-sdk btn-primary-center-only" data-dismiss="modal"
							aria-hidden="true">
							&nbsp;Close&nbsp;
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

		$("#box_add_employee").load("pages_relation/_pages_add_employee.php?rfid=",
			function (responseTxt, statusTxt, jqXHR) {
				if (statusTxt == "success") {
					$("#box_add_employee").show();
					if ($("#box_add_employee").show()) {
						mymodalss.style.display = "none";
					}
				}
				if (statusTxt == "error") {
					alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
				}
			}
		);

		$("#CreateButton , #CreateButtonFloating").on('click', function () {


			mymodalss.style.display = "block";


			document.getElementById("modal--title").innerHTML = "Add Payroll Period Setting";
			// reset the form

			$("#period_id_form").show();
			$("#Upload2").hide();


			$("#inp_keyofupdate").remove();

			$("#FormDisplayCreate")[0].reset();

			$("#modalcancelcondition_0").show();
			$("#modalcancelcondition_1").hide();
			$("#modalcancelcondition_2").hide();
			$("#modalcancelcondition_3").hide();
			// empty the message div

			mymodalss.style.display = "none";

			// submit form

			$("#FormDisplayCreate").unbind('submit').bind('submit', function () {



				$(".text-danger").remove();

				var form = $(this);

				var inp_period_id = $("#inp_period_id").val();
				var inp_period_name = $("#inp_period_name").val();
				var inp_add_paydate = $("#inp_add_paydate").val();
				var inp_add_startdate = $("#inp_add_startdate").val();
				var inp_add_enddate = $("#inp_add_enddate").val();
				var from = new Date(inp_add_startdate).getTime();
				var to = new Date(inp_add_enddate).getTime();
				var inp_interval_period = $("#inp_interval_period").val();

				var selected = [];
				for (var option of document.getElementById('test-select-4s').options) {
					if (option.selected) {
						selected.push(option.value);
					}
				}

				var regex = /^[a-zA-Z]+$/;


				if (inp_period_id == "") {
					modals.style.display = 'block';
					document.getElementById('msg').innerHTML = 'Period ID cannot empty';
					return false;

				} else if (inp_period_name == "") {
					modals.style.display = 'block';
					document.getElementById('msg').innerHTML = 'Period Name cannot empty';
					return false;

				} else if (inp_add_paydate == "") {
					mymodalss.style.display = "none";
					modals.style.display = "block";
					document.getElementById("msg").innerHTML = "Pay Date cannot empty";
					return false;

				} else if (from > to) {
					mymodalss.style.display = "none";
					modals.style.display = "block";
					document.getElementById("msg").innerHTML =
						"Entry Date: Enter Date in Proper Range";
					return false;

				} else if (inp_add_startdate == "") {
					mymodalss.style.display = "none";
					modals.style.display = "block";
					document.getElementById("msg").innerHTML = "Start date cannot empty";
					return false;

				} else if (inp_add_enddate == "") {
					mymodalss.style.display = "none";
					modals.style.display = "block";
					document.getElementById("msg").innerHTML = "End date cannot empty";
					return false;

				} else if (inp_interval_period == "") {
					modals.style.display = 'block';
					document.getElementById('msg').innerHTML = 'Period Interval cannot empty';
					return false;

				} else if (selected == '') {
					mymodalss.style.display = "none";
					modals.style.display = "block";
					document.getElementById("msg").innerHTML =
						"Please select at least one employee";
					return false;
				} else {

					$.ajax({
						url: "php_action/FunctionController.php?function=create",
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
								modals.style.display = "block";
								document.getElementById("msg").innerHTML = response
									.messages;
								datatable.ajax.reload(null, true);
								$("[data-dismiss=modal]").trigger({
									type: "click"
								});

								// reset the form
								// $("#FormDisplayCreate")[0].reset();
								// reload the datatables

								// this function is built in function of datatables;
							} else {
								mymodalss.style.display = "none";
								modals.style.display = "block";
								document.getElementById("msg").innerHTML = response
									.messages;
							} // /else
						} // success  
					}); // ajax subit 				

					return false;
				}

			}); // /submit form for create member
		}); // /add modal
	});











































































































	function update(id = null) {

		mymodalss.style.display = "block";

		$("#inp_keyofupdate").remove();
		$("#automaticovt_type").remove();
		$("#function").remove();

		if (id) {
			$.ajax({
				url: 'php_action/getSelectedRows.php',
				type: 'post',
				data: {
					member_id: id
				},
				dataType: 'json',
				success: function (response) {

					mymodalss.style.display = "none";






					$("#cancellation_id").attr("data-id", response.period_id);


					$("#FormDisplayCreate").append(
						'<input type="hidden" name="inp_keyofupdate" id="inp_keyofupdate" value="' +
						response.period_id + '"/>');
					$("#FormDisplayCreate").append(
						'<input type="hidden" name="automaticovt_type" id="automaticovt_type" value="' +
						response.automaticovt_type + '"/>');
					$("#FormDisplayCreate").append(
						'<input type="hidden" name="function" id="function" value="update"/>');

					document.getElementById("modal--title").innerHTML = "Update Payroll Period Setting : " +
						response.period_id;
					$("#period_id_form").hide();



					$("#inp_period_name").val(response.period_name);
					$("#inp_add_paydate").val(response.paydate);
					$("#inp_add_startdate").val(response.datestart);
					$("#inp_add_enddate").val(response.dateend);
					$("#inp_interval_period").val(response.interval_period);


					$("#box_add_employee").load("pages_relation/_pages_add_employee.php?rfid=" + response
						.period_id,
						function (responseTxt, statusTxt, jqXHR) {
							if (statusTxt == "success") {
								$("#box_add_employee").show();
								if ($("#box_add_employee").show()) {
									mymodalss.style.display = "none";
								}
							}
							if (statusTxt == "error") {
								alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
							}
						}
					);



					$("#Upload2").show();
					if (response.status == 1) {
						$('#inp_status').prop('checked', true);
					} else {
						$('#inp_status').prop('checked', false);
					}





					$("#modalcancelcondition_0").show();
					$("#modalcancelcondition_1").hide();
					$("#modalcancelcondition_2").hide();
					$("#modalcancelcondition_3").hide();

					$("#FormDisplayCreate").unbind('submit').bind('submit', function () {



						var form = $(this);

						var inp_period_name = $("#inp_period_name").val();
						var inp_add_paydate = $("#inp_add_startdate").val();
						var inp_add_startdate = $("#inp_add_startdate").val();
						var inp_add_enddate = $("#inp_add_enddate").val();
						var from = new Date(inp_add_startdate).getTime();
						var to = new Date(inp_add_enddate).getTime();
						var inp_interval_period = $("#inp_interval_period").val();


						var selected = [];
						for (var option of document.getElementById('test-select-4s').options) {
							if (option.selected) {
								selected.push(option.value);
							}
						}


						if (inp_period_name == "") {
							modals.style.display = 'block';
							document.getElementById('msg').innerHTML = 'Period Name cannot empty';
							return false;

						} else if (from > to) {
							modals.style.display = "block";
							document.getElementById("msg").innerHTML =
								"Entry Date: Enter Date in Proper Range";
							return false;

						} else if (inp_add_startdate == "") {
							modals.style.display = "block";
							document.getElementById("msg").innerHTML = "Start date cannot empty";
							return false;

						} else if (inp_add_enddate == "") {
							modals.style.display = "block";
							document.getElementById("msg").innerHTML = "End date cannot empty";
							return false;

						} else if (inp_interval_period == "") {
							modals.style.display = 'block';
							document.getElementById('msg').innerHTML = 'Period Interval cannot empty';
							return false;

						} else if (selected == '') {
							mymodalss.style.display = "none";
							modals.style.display = "block";
							document.getElementById("msg").innerHTML =
								"Please select at least one employee";
							return false;
						} else {
							mymodalss.style.display = "block";

							$.ajax({
								url: "php_action/FunctionController.php?function=update",
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
										modals.style.display = "block";
										document.getElementById("msg").innerHTML = response
											.messages;

										// reload the datatables
										datatable.ajax.reload(null, true);
										// this function is built in function of datatables;

										$("[data-dismiss=modal]").trigger({
											type: "click"
										});

										// reset the form
										// $("#FormDisplayCreate")[0].reset();

									} else {
										mymodalss.style.display = "none";
										modals.style.display = "block";
										document.getElementById("msg").innerHTML = response
											.messages;
									} // /else
								} // success  
							}); // ajax subit 				

							return false;
						}

					});
				} // /success
			}); // /fetch selected member info

			// Delete if exist
			// $('.delete').click(function(){
			// var el = this;

			// // Delete id
			// var deleteid = $(this).data('id');

			// var confirmalert = confirm("Are you sure to cancel request?");
			// if (confirmalert == true) {
			// // AJAX Request
			// $.ajax({
			//        url: 'php_action/FuncDataDelete.php<?php echo $getPackage; ?>id=' + deleteid,
			//        type: 'GET',
			//        processData: false,
			//        contentType: false,
			//        dataType: 'json',
			//        success: function(response){
			//                      if (response.code == 'success_message') {
			//                             mymodals_withhref.style.display = "block";
			//                             document.getElementById("msg_href").innerHTML = response.messages;
			//                      } else {
			//                             mymodals_withhref.style.display = "block";
			//                             document.getElementById("msg_href").innerHTML = response.messages;
			//                             return false;
			//                      }
			//               }

			//        }
			//        );
			// }

			// });

		} else {
			alert("Error : Refresh the page again");
		}
	}




























	function update_structure(id = null) {

		mymodalss.style.display = "block";

		if (id) {

			$.ajax({
				url: 'php_action/getSelectedPosition.php',
				type: 'post',
				data: {
					member_id: id
				},
				dataType: 'json',
				success: function (response) {

					mymodalss.style.display = "none";

					$("#cancellation_id").attr("data-id", response.inp_keyofupdate);

					$("#FormDisplayCreate").append(
						'<input type="hidden" name="inp_keyofupdate" id="inp_keyofupdate" value="' +
						response.shiftdailycode + '"/>');
					$("#FormDisplayCreate").append(
						'<input type="hidden" name="request_for" id="request_for" value="' + response
						.parent_id + '"/>');

					document.getElementById("modal--title").innerHTML = "Update Training Requests : " +
						response.pos_code;

					$("#inp_unit_name_id").val(response.parent_pos_id);
					$("#inp_unit_name").val(response.parent_pos_en);
					$("#inp_parent").val(response.parent);
					$("#inp_pos_flag").val(response.startdate);
					$("#inp_employee").val(response.employee);

					$("#modalcancelcondition_0").show();
					$("#modalcancelcondition_1").hide();
					$("#modalcancelcondition_2").hide();
					$("#modalcancelcondition_3").hide();

					$("#FormDisplayCreate").unbind('submit').bind('submit', function () {

						mymodalss.style.display = "block";

						var form = $(this);

						var inp_unit_name = $("#inp_unit_name").val();
						var inp_parent = $("#inp_parent").val();
						var inp_pos_flag = $("#inp_reason").val();

						if (inp_unit_name == '') {
							mymodalss.style.display = "none";
							modals.style.display = "block";
							document.getElementById("msg").innerHTML = "Unit name cannot empty";
							return false;

						} else if (inp_parent == "") {
							mymodalss.style.display = "none";
							modals.style.display = "block";
							document.getElementById("msg").innerHTML = "Parent cannot empty";
							return false;

						} else if (!$("input[name='inp_pos_flag']:checked").val()) {
							mymodalss.style.display = "none";
							modals.style.display = "block";
							document.getElementById("msg").innerHTML = "Please choose training course";
							return false;

						} else {
							//submi the form to server
							$.ajax({
								url: "php_action/FuncDataUpdate.php<?php echo $getPackage; ?>",
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
										modals.style.display = "block";
										document.getElementById("msg").innerHTML = response
											.messages;
										datatable.ajax.reload(null, false);
										// this function is built in function of datatables;
									} else {
										mymodalss.style.display = "none";
										modals.style.display = "block";
										document.getElementById("msg").innerHTML = response
											.messages;
									} // /else
								} // success  
							}); // ajax subit 				

							return false;
						}
					});
				} // /success
			}); // /fetch selected member info

			// Delete if exist
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
				url: 'php_action/getSelectedPosition.php',
				type: 'post',
				data: {
					member_id: id
				},
				dataType: 'json',
				success: function (response) {

					$("#shiftdailycode_delete").val(response.shiftdailycode);

					// here update the member data
					$("#DeleteFormDisplay").unbind('submit').bind('submit', function () {
						// remove error messages
						$(".text-danger").remove();

						var form = $(this);

						// validation

						var shiftdailycode_delete = $("#shiftdailycode_delete").val();


						if (shiftdailycode_delete) {
							$.ajax({
								url: form.attr('action'),
								type: form.attr('method'),
								data: form.serialize(),
								dataType: 'json',
								success: function (response) {
									if (response.code == 'success_message_delete') {

										$('#FormDisplayDelete').modal('hide');
										$("[data-dismiss=modal]").trigger({
											type: "click"
										});
										// reload the datatables
										datatable.ajax.reload(null, false);
										// reload the datatables
										mymodalss.style.display = "none";
										modals.style.display = "block";
										document.getElementById("msg").innerHTML = response
											.messages;

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
		$('#inp_break_starttime').bootstrapMaterialDatePicker({
			date: false,
			format: 'HH:mm'
		});
		$('#inp_break_endtime').bootstrapMaterialDatePicker({
			date: false,
			format: 'HH:mm'
		});
		$('#inp_automaticovt_start').bootstrapMaterialDatePicker({
			date: false,
			format: 'HH:mm'
		});
		$('#inp_automaticovt_end').bootstrapMaterialDatePicker({
			date: false,
			format: 'HH:mm'
		});
		$('#inp_ovt_beforeend').bootstrapMaterialDatePicker({
			date: false,
			format: 'HH:mm'
		});
		$('#inp_ovt_afterstart').bootstrapMaterialDatePicker({
			date: false,
			format: 'HH:mm'
		});
		$('#inp_ovt_breakstart').bootstrapMaterialDatePicker({
			date: false,
			format: 'HH:mm'
		});
		$('#btsovt_1').bootstrapMaterialDatePicker({
			date: false,
			format: 'HH:mm'
		});
		$('#bteovt_1').bootstrapMaterialDatePicker({
			date: false,
			format: 'HH:mm'
		});
	});


	$(document).ready(function () {
		$("#inp_status").click(function () {
			if ($('#inp_status').is(':checked')) {
				$("#inp_status_code").val('1');
			} else {
				$("#inp_status_code").val('0');
			}
		});
	});
</script>