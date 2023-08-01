<?php  
	$src_purpose_code                   = '';
	$src_purpose_name_en                = '';
	if (!empty($_POST['src_purpose_code']) && !empty($_POST['src_purpose_name_en'])) {
		$src_purpose_code            = $_POST['src_purpose_code'];
		$src_purpose_name_en         = $_POST['src_purpose_name_en'];
		$frameworks                  = "?src_purpose_code="."".$src_purpose_code." &&src_purpose_name_en="."".$src_purpose_name_en."";
	} else if (empty($_POST['src_purpose_code']) && !empty($_POST['src_purpose_name_en'])) {
		$src_purpose_code            = $_POST['src_purpose_code'];
		$src_purpose_name_en         = $_POST['src_purpose_name_en'];
		$frameworks                  = "?src_purpose_name_en="."".$src_purpose_name_en."";
	} else if (!empty($_POST['src_purpose_code']) && empty($_POST['src_purpose_name_en'])) {
		$src_purpose_code            = $_POST['src_purpose_code'];
		$src_purpose_name_en         = $_POST['src_purpose_name_en'];
		$frameworks                  = "?src_purpose_code="."".$src_purpose_code."";
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
							<div class="col-4 name">Purpose type code</div>
							<div class="col-sm-8">
								<div class="input-group">

									<input class="input--style-6" autocomplete="off" autofocus="on"
										id="src_purpose_code" name="src_purpose_code" id="src_purpose_code" type="Text"
										value="<?php echo $src_purpose_code; ?>" onfocus="hlentry(this)" size="30"
										maxlength="50" validate="NotNull:Invalid Form Entry"
										onchange="formodified(this);" title="">
								</div>
							</div>
						</div>

						<div class="form-row">
							<div class="col-4 name">Purpose type name</div>
							<div class="col-sm-8">
								<div class="input-group">

									<input class="input--style-6" autocomplete="off" autofocus="on"
										name="src_purpose_name_en" id="src_purpose_name_en" type="Text"
										value="<?php echo $src_purpose_name_en; ?>" onfocus="hlentry(this)" size="30"
										maxlength="50" validate="NotNull:Invalid Form Entry"
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



<div class="MaximumFrameHeight card-body table-responsive p-0"
	style="width: 100vw;height: 80vh; width: 98%; margin-right: 5px;overflow: scroll;overflow-x: hidden;margin-top: 17px;">
	<div class="col-12 col-fit" style="margin-top: 17px;">
		<table id="datatable" width="100%" border="1" align="left"
			class="table table-bordered table-striped table-hover table-head-fixed">
			<thead>
				<tr>
					<th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No</th>
					<th class="fontCustom" style="z-index: 1;">Purpose Type Code</th>
					<th class="fontCustom" style="z-index: 1;">Purpose Type Name</th>
					<th class="fontCustom" style="z-index: 1;">Allowance Item</th>
					<!-- <th class="fontCustom" style="z-index: 1;">Active Status</th> -->
				</tr>
			</thead>
		</table>
	</div>
</div>
<!-- add modal -->
<div class="modal  fade fade-custom" tabindex="-1" role="dialog" id="CreateForm">
	<div class="modal-dialog modal-belakang modal-bs" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add Purpose Type</h4>
				<a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close"
					style="margin-top: -15px;">
					<span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
				</a>
			</div>

			<form class="form-horizontal" action="php_action/FuncDataCreate.php" method="POST" id="FormDisplayCreate">

				<fieldset id="fset_1">
					<legend>General</legend>

					<div class="messages_create"></div>

					<input id="inp_emp_no" name="inp_emp_no" type="hidden" value="<?php echo $username; ?>">
					<!--FROM SESSION -->
					<input id="inp_token" name="inp_token" type="hidden" value="<?php echo $get_token; ?>">
					<!--FROM CONFIGURATION -->

					<div class="form-row">
						<div class="col-4 name">Code <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">

								<input class="input--style-6" autocomplete="off" autofocus="on" id="inp_purpose_code"
									name="inp_purpose_code" type="Text" value="" onfocus="hlentry(this)" size="30"
									maxlength="50" style="text-transform:uppercase;width: 60%;"
									validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
							</div>
						</div>
					</div>

					<div class="form-row">
						<div class="col-4 name">Name <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">

								<input class="input--style-6" autocomplete="off" autofocus="on" id="inp_purpose_name_en"
									name="inp_purpose_name_en" type="Text" value="" onfocus="hlentry(this)" size="30"
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
								<input class="input--style-6" autocomplete="off" autofocus="on" id="inp_purpose_name_id"
									name="inp_purpose_name_id" type="Text" value="" onfocus="hlentry(this)" size="30"
									maxlength="50" style="text-transform:uppercase;width: 60%;"
									validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
								<img src="../../asset/img/icons/flag_id.png">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">Allowance </div>
					</div>
					<div class="form-row">
						<div class="col-sm-12">
							<div class="input-group">
								<link rel="stylesheet"
									href="../../asset/gt_developer/asset_use/jquery.tree-multiselect.min.css">
								<script src="../../asset/gt_developer/asset_use/jquery-ui.min.js"></script>
								<script src="../../asset/gt_developer/asset_use/jquery.tree-multiselect.js"></script>
								<?php
									$modal=mysqli_query($connect, "SELECT a.*
									FROM hrmondutyallowitem a");
								?>
								<select multiple="multiple" class="framework" id="inp_allowance_item"
									name="inp_allowance_item[]">
									<?php if (mysqli_num_rows($modal) > 0) { ?>
									<?php while ($row = mysqli_fetch_array($modal)) { ?>
									<option value="<?php echo $row['item_code'] ?>" data-section="allowance item"
										data-index="1"><?php echo $row['item_name_en'] ?></option>
									<?php } ?>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>

					<div class="form-row">
						<div class="col-4 name">Attendance status <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<select id="inp_attendcode" class="input--style-6" name="inp_attendcode"
									onfocus="hlentry(this)" onchange="formodified(this);"
									style="width:undefined;height: 33px;width: 80%;">
									<option value="">--Select One--</option>
									<?php 
										// $req = mysqli_query($connect, "SELECT * FROM `HRMTTAMATTSTATUS`");
										$req = mysqli_query($connect, "SELECT * FROM `hrmttamattstatus`");
									?>
									<?php if (mysqli_num_rows($req) > 0) { ?>
									<?php while ($row = mysqli_fetch_array($req)) { ?>
									<option value="<?php echo $row['attend_code'] ?>">
										<?php echo $row['attend_name_en'] ?>
										<?php } ?>
										<?php } ?>
								</select>
							</div>
						</div>
					</div>


				</fieldset>

				<div class="modal-footer">
					<button type="reset" class="btn btn-primary1" data-dismiss="modal" aria-hidden="true">
						&nbsp;Cancel&nbsp;
					</button>
					<button class="btn btn-warning" type="submit" name="submit_add" id="submit_add">
						Confirm
					</button>
					<button class="btn btn-warning" type="button" name="submit_add2" id="submit_add2"
						style='display:none;' disabled>
						<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
						&nbsp;&nbsp;Processing..
					</button>
				</div>
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
			<form class="form-horizontal" action="php_action/FuncDataUpdate.php" method="POST" id="FormDisplayUpdate">

				<fieldset id="fset_1">
					<legend>General</legend>

					<div class="messages_update"></div>

					<input id="sel_emp_no" name="sel_emp_no" type="hidden" value="<?php echo $username; ?>">
					<!--FROM SESSION -->
					<input id="sel_token" name="sel_token" type="hidden" value="<?php echo $get_token; ?>">
					<!--FROM CONFIGURATION -->

					<div class="form-row">
						<div class="col-4 name"> Code <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group" id="sel_identity">
							</div>
						</div>
					</div>
					<div class="form-row" style="display:none">
						<div class="col-4 name">Code <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">

								<input class="input--style-6" autocomplete="off" autofocus="on" id="sel_purpose_code"
									name="sel_purpose_code" type="Text" value="" onfocus="hlentry(this)" size="30"
									maxlength="50" style="text-transform:uppercase;width: 60%;"
									validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
							</div>
						</div>
					</div>

					<div class="form-row">
						<div class="col-4 name">Name <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">

								<input class="input--style-6" autocomplete="off" autofocus="on" id="sel_purpose_name_en"
									name="sel_purpose_name_en" type="Text" value="" onfocus="hlentry(this)" size="30"
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
								<input class="input--style-6" autocomplete="off" autofocus="on" id="sel_purpose_name_id"
									name="sel_purpose_name_id" type="Text" value="" onfocus="hlentry(this)" size="30"
									maxlength="50" style="text-transform:uppercase;width: 60%;"
									validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
								<img src="../../asset/img/icons/flag_id.png">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">Allowance </div>
					</div>
					<div class="form-row">
						<!-- pages relation -->
						<div class="col-sm-12" id="box"></div>
						<!-- pages relation -->




					</div>

					<div class="form-row">
						<div class="col-4 name">Attendance status <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">

								<?php 
										$req=mysqli_query($connect, "SELECT * FROM `HRMTTAMATTSTATUS`");
										?>
								<select name="sel_attend_code" id="sel_attend_code" class="input--style-6"
									style="width:undefined;height: 33px;width: 80%;">
									<option value="">--Select One--</option>
									<?php if (mysqli_num_rows($req) > 0) { ?>
									<?php while ($row = mysqli_fetch_array($req)) { ?>
									<option><?php echo $row['attend_code'] ?>
										<?php } ?>
										<?php } ?>
								</select>
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
			<form class="form-horizontal" action="php_action/FuncDataDelete.php" method="POST" id="updatedelMemberForm">

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
							<input type="hidden" class="form-control input-report" id="sel_purpose_codeS"
								name="sel_purpose_codeS" placeholder="">
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
			// reset the form 
			$("#FormDisplayCreate")[0].reset();
			// empty the message div

			$(".messages_create").html("");

			// submit form
			$("#FormDisplayCreate").unbind('submit').bind('submit', function () {

				$(".text-danger").remove();

				var form = $(this);

				var inp_purpose_code = $("#inp_purpose_code").val();
				var inp_purpose_name_en = $("#inp_purpose_name_en").val();
				var inp_purpose_name_id = $("#inp_purpose_name_id").val();
				var inp_attendcode = $("#inp_attendcode").val();

				var inp_allowance_item = [];
				let checked_allowance_item = $('.option:checked').map(function(){
					return this.value;
				}).get();

				var regex = /^[a-zA-Z]+$/;

				if (inp_purpose_code == "") {
					modals.style.display = "block";
					document.getElementById("msg").innerHTML = "Purpose code cannot empty";
					return false
				} else if (inp_purpose_name_en == "") {
					modals.style.display = "block";
					document.getElementById("msg").innerHTML = "Purpose desc en cannot empty";
					return false
				} else if (inp_purpose_name_id == "") {
					modals.style.display = "block";
					document.getElementById("msg").innerHTML = "Purpose desc id cannot empty";
					return false
				} else if (checked_allowance_item == "") {
					modals.style.display = "block";
					document.getElementById("msg").innerHTML = "Allowance cannot empty";
					return false
				} else if (inp_attendcode == "") {
					modals.style.display = "block";
					document.getElementById("msg").innerHTML = "Attend status cannot empty";
					return false
				} else {
					$('#submit_add').hide();
					$('#submit_add2').show();
				}

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
							$(".form-group").removeClass('has-error').removeClass(
								'has-success');
							mymodalss.style.display = "none";
							modals.style.display = "block";
							document.getElementById("msg").innerHTML = response.messages;

							$('#FormDisplayDetail').modal('hide');
							$("[data-dismiss=modal]").trigger({type: "click"});

							// reset the form
							$("#FormDisplayDetail")[0].reset();
							datatable.ajax.reload(null, false);
						} else {
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
				return false;
				// if (inp_purpose_code && inp_purpose_name_en && inp_purpose_name_id && inp_attendcode) {
				// }
			}); // /submit form for create member
		}); // /add modal
	});














































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
				url: 'php_action/getSelectedEmployee.php',
				type: 'post',
				data: {
					member_id: id
				},
				dataType: 'json',
				async: true,
				success: function (response) {
					document.getElementById("sel_identity").innerHTML = response.purpose_code;

					$("#sel_purpose_code").val(response.purpose_code);
					$("#sel_purpose_name_en").val(response.purpose_name_en);
					$("#sel_purpose_name_id").val(response.purpose_name_id);
					$("#sel_attend_code").val(response.attend_code);

					var sel_purpose_code = response.purpose_code;
					// alert(sel_purpose_code)
					$("#box").load("pages_relation/_pages_setting?rfid=" + sel_purpose_code,
						function (responseTxt, statusTxt, jqXHR) {
							if (statusTxt == "success") {
								$("#box").show();
							}
							if (statusTxt == "error") {
								alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
							}
						}
					);


					// here update the member data
					$("#FormDisplayUpdate").unbind('submit').bind('submit', function () {
						// remove error messages
						$(".text-danger").remove();

						var form = $(this);

						var sel_purpose_code = $("#sel_purpose_code").val();
						var sel_purpose_name_en = $("#sel_purpose_name_en").val();
						var sel_purpose_name_id = $("#sel_purpose_name_id").val();
						var sel_attend_code = $("#sel_attend_code").val();

						var sel_allowance_item = [];

						var regex = /^[a-zA-Z]+$/;

						if (sel_purpose_code == "") {
							modals.style.display = "block";
							document.getElementById("msg").innerHTML = "Purpose code cannot empty";

						} else if (sel_purpose_name_en == "") {
							modals.style.display = "block";
							document.getElementById("msg").innerHTML =
								"Purpose name en desc en cannot empty";

						} else if (sel_purpose_name_id == "") {
							modals.style.display = "block";
							document.getElementById("msg").innerHTML =
								"Purpose name id desc en cannot empty";

						} else if (sel_attend_code == "") {
							modals.style.display = "block";
							document.getElementById("msg").innerHTML = "Attend code cannot empty";

						} else {
							$('#submit_update').hide();
							$('#submit_update2').show();
						}


						if (sel_purpose_code && sel_purpose_name_en && sel_purpose_name_id &&
							sel_attend_code) {

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
				url: 'php_action/getSelectedEmployee.php',
				type: 'post',
				data: {
					member_id: id
				},
				dataType: 'json',
				success: function (response) {

					$("#sel_purpose_codeS").val(response.purpose_code);

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

						var sel_purpose_codeS = $("#sel_purpose_codeS").val();

						if (sel_purpose_codeS == "") {
							modals.style.display = "block";
							document.getElementById("msg").innerHTML = "purpose code cannot empty";
						} else {
							$('#submit_delete').hide();
							$('#submit_delete2').show();
						}


						if (sel_purpose_codeS) {
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

										$('#submit_delete').show();
										$('#submit_delete2').hide();
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
			url: 'ajax_cek.php',
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

<script type="text/javascript">
	var tree4 = $("#inp_allowance_item").treeMultiselect({
		allowBatchSelection: true,
		enableSelectAll: true,
		searchable: true,
		sortable: true,
		startCollapsed: false,
	});
</script>