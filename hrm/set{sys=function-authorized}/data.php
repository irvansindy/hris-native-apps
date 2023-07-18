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
										onfocus="hlentry(this)" size="30" maxlength="50"
										validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
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
<!-- cdn select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- end cdn select2 -->
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
			"ajax": "php_action/FuncDataRead.php<?php echo $getPackage; ?><?php echo $frameworks; ?>"
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
					<th class="fontCustom" style="z-index: 1;">Authorize Name</th>
					<th class="fontCustom" style="z-index: 1;">Type</th>
					<th class="fontCustom" style="z-index: 1;">Active Status</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

<!-- create data modal -->
<div class="modal  fade fade-custom" tabindex="-1" role="dialog" id="CreateForm">
	<div class="modal-dialog modal-belakang modal-bg" role="document">

		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Function Authorization</h4>
				<a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close"
					style="margin-top: -15px;">
					<span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
				</a>
			</div>

			<!-- <form class="form-horizontal" action="php_action/FuncDataUpdate.php" method="POST" id="updateMemberForm"> -->
			<form class="form-horizontal" action="" method="POST" id="FormDisplayCreate">

				<div class="card-body table-responsive p-0"
					style="height: auto; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

					<fieldset id="fset_1">
						<legend>General</legend>

						<div class="messages_update"></div>

						<input id="input_emp_no" name="input_emp_no" type="hidden" value="<?php echo $username; ?>">

						<!--FROM SESSION -->
						<input id="sel_token" name="sel_token" type="hidden" value="<?php echo $get_token; ?>">
						<!--FROM CONFIGURATION -->
						<div class="form-row">
							<div class="col-sm-12">
								<div class="input-group" id="sel_identity">
								</div>
							</div>
						</div>

						<div class="form-row">
							<div class="col-4 name">Group Name <span class="required">*</span></div>
							<div class="col-sm-8">
								<div class="input-group">
									<input class="input--style-6"  id="input_group_name"
									name="input_group_name" type="Text" value="" size="30"
									maxlength="50" style="text-transform:uppercase;width: 60%;">
								</div>
							</div>
						</div>
						
						<div class="form-row">
							<div class="col-4 name">Description <span class="required">*</span></div>
							<div class="col-sm-8">
								<div class="input-group">
									<textarea class="input--style-6" name="input_description" id="input_description" cols="7" rows="" style="width:80%;"></textarea>
								</div>
							</div>
						</div>

						<div class="form-row">
							<div class="col-4 name">Admin Type <span class="required">*</span></div>
							<div class="col-sm-8">
								<div class="input-group">
								<div class="input-group">
									<?php
										$modal=mysqli_query($connect, "SELECT * FROM hrmadmintype");
									?>
									<select class="input--style-6" id="input_admin_type" name="input_admin_type" style="width: 60%;height: 30px;">
									<option value="">Select One</option>
										<?php if (mysqli_num_rows($modal) > 0) { ?>
											<?php while ($row = mysqli_fetch_array($modal)) { ?>
											<option value="<?php echo $row['id'] ?>" ><?php echo $row['admin_type_name'] ?></option>
											<?php } ?>
										<?php } ?>
									</select>
								</div>
								</div>
							</div>
						</div>
					
						<div class="form-row">
							<div class="col-4 name">Active Status <span class="required">*</span></div>
							<div class="col-sm-8">
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" name="input_active_status" id="input_active_status" value="1">
									<label class="form-check-label" for="input_active_status">Yes</label>
								</div>
							</div>
						</div>
						
						<div class="form-row">
							<div class="col-4 name">Verification On Accessing Menu <span class="required">*</span></div>
							<div class="col-sm-8">
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" name="input_active_verify" id="input_active_verify" value="1">
									<label class="form-check-label" for="input_active_verify">Enable</label>
								</div>
							</div>
						</div>
					</fieldset>

				</div>

				<div class="modal-footer-sdk">
					<button type="reset" class="btn-sdk btn-primary-left" data-dismiss="modal" aria-hidden="true">
						&nbsp;Cancel&nbsp;
					</button>
					<button class="btn-sdk btn-primary-right" type="submit" name="submit_create" id="submit_create">
						Confirm
					</button>
					<button class="btn-sdk btn-primary-right" type="button" name="submit_create2" id="submit_create2"
						style='display:none;' disabled>
						<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
						&nbsp;&nbsp;Processing..
					</button>
				</div>
			</form>


		</div>

		</form>
	</div><!-- /.modal-content -->
</div>
</div>

<!-- detail data modal -->
<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="DetailForm">
	<div class="modal-dialog modal-belakang modal-bg" role="document">

		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Detail Authorized User</h4>
				<a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close"
					style="margin-top: -15px;">
					<span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
				</a>
			</div>

			<!-- <form class="form-horizontal" action="php_action/FuncDataUpdate.php" method="POST" id="updateMemberForm"> -->
			<form class="form-horizontal" action="" method="" id="FormDisplayDetail">

				<div class="card-body table-responsive p-0"
					style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

					<fieldset id="fset_1">
						<legend>General</legend>

						<div class="messages_update"></div>

						<input id="input_emp_no" name="input_emp_no" type="hidden" value="<?php echo $username; ?>">

						<!--FROM SESSION -->
						<input id="sel_token" name="sel_token" type="hidden" value="<?php echo $get_token; ?>">
						<!--FROM CONFIGURATION -->
						<div class="form-row">
							<div class="col-sm-12">
								<div class="input-group" id="sel_identity">
								</div>
							</div>
						</div>

						<div class="form-row">
							<div class="col-4 name">User Group Name <span class="required">*</span></div>
							<div class="col-sm-8">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="detail_user_menu_name"
										name="detail_user_menu_name" type="Text" value="" readonly size="30"
										maxlength="50" style="text-transform:uppercase;width: 60%;">
								</div>
							</div>
						</div>
						
						<div class="form-row">
							<div class="col-4 name">Description <span class="required">*</span></div>
							<div class="col-sm-8">
								<div class="input-group">
									<textarea class="input--style-6" name="detail_description" id="detail_description" cols="7" rows="" style="width:60%;" readonly></textarea>
								</div>
							</div>
						</div>
						
						<div class="form-row">
							<div class="col-4 name">Remark <span class="required">*</span></div>
							<div class="col-sm-8">
								<div class="input-group">
									<textarea class="input--style-6" name="detail_remark" id="detail_remark" cols="7" rows="" style="width:60%;" readonly></textarea>
								</div>
							</div>
						</div>

						<div class="form-row">
							<div class="col-4 name">Menu Authorization </div>
						</div>

						<div class="form-row">
							<div class="card-body table-responsive p-0"
								style="width: 100vw;height: 30vh; width: 100%; overflow: scroll;overflow-x: hidden;border:1px solid #d2d2d2;border-radius: 4px;">
								<div id="box"></div>
							</div>
						</div>

						<!-- <div class="form-row">
							<div class="col-sm-12">
								<div class="input-group">
									<link rel="stylesheet"
										href="../../asset/gt_developer/asset_use/jquery.tree-multiselect.min.css">
									<script src="../../asset/gt_developer/asset_use/jquery-ui.min.js"></script>
									<script src="../../asset/gt_developer/asset_use/jquery.tree-multiselect.js"></script>
									<?php
										$modal=mysqli_query($connect, "SELECT 
										a.menu_id,
										a.menu,
										GROUP_CONCAT(b.formula ORDER BY b.formula ASC SEPARATOR ' . ') AS group_item
												FROM hrmmenu a
												LEFT JOIN users_menu_access b ON a.menu_id=b.formula
										-- WHERE b.emp_no='$rfid'
										GROUP BY a.menu_id
										ORDER BY a.menu_id ASC");
									?>
									<select id="detail-menu-item" multiple="multiple" class="framework" id="detail_menu_item"
										name="detail_menu_item[]">
										<?php if (mysqli_num_rows($modal) > 0) { ?>
											<?php while ($row = mysqli_fetch_array($modal)) { ?>
											<option value="<?php echo $row['menu_id'] ?>" data-section="Detail Menu Item"
												data-index="1"><?php echo $row['menu'] ?></option>
											<?php } ?>
										<?php } ?>
									</select>
								</div>
							</div>
						</div> -->
					</fieldset>

				</div>

				<div class="modal-footer-sdk">
					<button type="reset" class="btn-sdk btn-primary-center-only" data-dismiss="modal" aria-hidden="true">
						&nbsp;Close&nbsp;
					</button>
					<!-- <button class="btn-sdk btn-primary-right" type="submit" name="submit_create" id="submit_create">
						Confirm
					</button> -->
					<!-- <button class="btn-sdk btn-primary-right" type="button" name="submit_create2" id="submit_create2"
						style='display:none;' disabled>
						<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
						&nbsp;&nbsp;Processing..
					</button> -->
				</div>
			</form>


		</div>

		</form>
	</div><!-- /.modal-content -->
</div>
</div>

<script>
	$('#input_admin_type').select2({
		dropdownParent: $('#CreateForm')
	});

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
	// for create data
	$(document).ready(function () {
		$('#CreateButton').on('click', function() {
			document.getElementById("FormDisplayCreate").reset();
			$("#menu_item").load("pages_relation/_pages_setting?rfid=",
				function (responseTxt, statusTxt, jqXHR) {
					if (statusTxt == "success") {
						$("#menu_item").show();
					}
					if (statusTxt == "error") {
						alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
					}
				}
			);

			$("#FormDisplayCreate").unbind('submit').bind('submit', function () {
				var form = $(this);

				var input_emp_no = $('#input_emp_no').val()
				var input_group_name = $('#input_group_name').val()
				var input_description = $('#input_description').val()
				var input_admin_type = $('#input_admin_type').val();
				// var list_menu_item = $("input[name='data_menu_item[]']").map(function(){return $(this).val();}).get();

				var arr_menu = $('.option:checked').map(function(){
					return this.value;
				}).get();

				if (input_group_name == "") {
					mymodalss.style.display = "none";
					modals.style.display = "block";
					document.getElementById("msg").innerHTML = "Group Name cannot empty";
					return false;
				} else if (input_description == "") {
					mymodalss.style.display = "none";
					modals.style.display = "block";
					document.getElementById("msg").innerHTML = "Description cannot empty";
					return false;
				} else if (input_admin_type == "") {
					mymodalss.style.display = "none";
					modals.style.display = "block";
					document.getElementById("msg").innerHTML = "Admin Type cannot empty";
					return false;
				}

				if (input_group_name && input_description && input_admin_type) {
					$.ajax({
						url: "php_action/FuncDataCreate.php<?php echo $getPackage; ?>",
						type: form.attr('method'),
						data: new FormData(this),
						processData: false,
						contentType: false,
						dataType: 'json',
						success: function(response) {
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
						},
						error: function(xhr, status, error) {
							mymodalss.style.display = "none";
							modals.style.display = "block";
							document.getElementById("msg").innerHTML = xhr.responseJSON.messages;
						}
					});
					return false;
				}
			})
		})
	})
	
	// $("#test-select-4").treeMultiselect({
	// 	allowBatchSelection: true,
	// 	enableSelectAll: true,
	// 	searchable: true,
	// 	sortable: true,
	// 	startCollapsed: false,
	// })

	$("#detail-menu-item").treeMultiselect({
		allowBatchSelection: true,
		enableSelectAll: true,
		searchable: true,
		sortable: true,
		startCollapsed: false,
	});

	function DetailAuthorizedUser(request) {
		document.getElementById("FormDisplayDetail").reset();
		
		$.ajax({
			url: 'php_action/FuncGetDataById.php',
			type: 'GET',
			data: {
				request: request
			},
			dataType: 'json',
			async: true,
			success: function(response) {
				// console.log(response[0].users_menu_name)				
				$('#detail_user_menu_name').val(response[0].users_menu_name)
				$('#detail_description').val(response[0].description)
				$('#detail_remark').val(response[0].remark)

				$("#box").load("pages_relation/_pages_setting?rfid=" + response[0].users_menu_name,
					function (responseTxt, statusTxt, jqXHR) {
						if (statusTxt == "success") {
							$("#box").show();
						}
						if (statusTxt == "error") {
							alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
						}
					}
				);
			},
		})
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
				url: 'php_action/getSelectedEmployee.php',
				type: 'post',
				data: {
					member_id: id
				},
				dataType: 'json',


				success: function (response) {
					document.getElementById("sel_identity").innerHTML = response.Full_Name;

					$("#sel_employee").val(response.emp_no);

					$("#box").load("pages_relation/_pages_setting?rfid=" + response.emp_no,
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

						var sel_employee = $("#sel_employee").val();

						var regex = /^[a-zA-Z]+$/;

						if (sel_employee == "") {
							modals.style.display = "block";
							document.getElementById("msg").innerHTML = "work request";

						} else {
							$('#submit_update').hide();
							$('#submit_update2').show();
						}


						if (sel_employee) {

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
										$('#submit_update').show();
										$('#submit_update2').hide();

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
</body>

</html>


<script type="text/javascript">
	// var tree4 = 
	
	
</script>