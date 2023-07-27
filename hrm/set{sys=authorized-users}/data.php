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
					<th class="fontCustom" style="z-index: 1;">Employee</th>
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
				<h4 class="modal-title">Add Authorized User</h4>
				<a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close"
					style="margin-top: -15px;">
					<span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
				</a>
			</div>

			<!-- <form class="form-horizontal" action="php_action/FuncDataUpdate.php" method="POST" id="updateMemberForm"> -->
			<form class="form-horizontal" action="" method="POST" id="FormDisplayCreate">

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
									<input class="input--style-6"  id="input_user_menu_name"
										name="input_user_menu_name" type="Text" value="" size="30"
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
							<div class="col-4 name">Remark <span class="required">*</span></div>
							<div class="col-sm-8">
								<div class="input-group">
									<textarea class="input--style-6" name="input_remark" id="input_remark" cols="7" rows="" style="width:80%;"></textarea>
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
							<div class="col-4 name">Menu Authorization </div>
						</div>

						<div class="form-row">
							<div class="card-body table-responsive p-0"
								style="width: 100vw;height: 30vh; width: 100%; overflow: scroll;overflow-x: hidden;border:1px solid #d2d2d2;border-radius: 4px;">
								<div id="menu_item"></div>
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

						<input id="detail_emp_no" name="detail_emp_no" type="hidden" value="<?php echo $username; ?>">

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
									<textarea class="input--style-6" name="detail_description" id="detail_description" cols="7" rows="" style="width:60%;" ></textarea>
								</div>
							</div>
						</div>
						
						<div class="form-row">
							<div class="col-4 name">Remark <span class="required">*</span></div>
							<div class="col-sm-8">
								<div class="input-group">
									<textarea class="input--style-6" name="detail_remark" id="detail_remark" cols="7" rows="" style="width:60%;" ></textarea>
								</div>
							</div>
						</div>

						<div class="form-row">
							<div class="col-4 name">Menu Authorization </div>
						</div>

						<div class="form-row">
							<div class="card-body table-responsive p-0"
								style="width: 100vw;height: 30vh; width: 100%; overflow: scroll;overflow-x: hidden;border:1px solid #d2d2d2;border-radius: 4px;">
								<div id="detail_list_menu_authorization"></div>
							</div>
						</div>
					</fieldset>

				</div>

				<div class="modal-footer-sdk">
					<!-- <button type="reset" class="btn-sdk btn-primary-center-only" data-dismiss="modal" aria-hidden="true">
						&nbsp;Close&nbsp;
					</button> -->
					<button type="reset" class="btn-sdk btn-primary-left" data-dismiss="modal" aria-hidden="true">
						&nbsp;Cancel&nbsp;
					</button>
					<button class="btn-sdk btn-primary-right" type="submit" name="submit_update" id="submit_update">
						Update
					</button>
					<button class="btn-sdk btn-primary-right" type="button" name="submit_update2" id="submit_update2"
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
<!-- add user employee modal -->
<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="AddUserEmployee">
	<div class="modal-dialog modal-belakang modal-bg" role="document">

		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add Employee</h4>
				<a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close"
					style="margin-top: -15px;">
					<span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
				</a>
			</div>

			<!-- <form class="form-horizontal" action="php_action/FuncDataUpdate.php" method="POST" id="updateMemberForm"> -->
			<form class="form-horizontal" action="" method="" id="FormDisplayEmployee">

				<div class="card-body table-responsive p-0"
					style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

					<fieldset id="fset_1">
						<legend>General</legend>

						<div class="messages_update"></div>

						<input id="input_emp_no" name="input_emp_no" type="hidden" value="<?php echo $username; ?>">
						<input id="add_users_menu_name" name="add_users_menu_name" type="hidden" value="">

						<!--FROM SESSION -->
						<input id="sel_token" name="sel_token" type="hidden" value="<?php echo $get_token; ?>">
						<!--FROM CONFIGURATION -->
						<div class="form-row">
						<div class="col-4 name">List Employee </div>
					</div>
					<div class="form-row">
						<div class="col-sm-12">
							<div class="input-group">
								<link rel="stylesheet"
									href="../../asset/gt_developer/asset_use/jquery.tree-multiselect.min.css">
								<script src="../../asset/gt_developer/asset_use/jquery-ui.min.js"></script>
								<script src="../../asset/gt_developer/asset_use/jquery.tree-multiselect.js"></script>
								<?php
									$modal=mysqli_query($connect, "SELECT emp_id, Full_Name, user_id, emp_no,
									DATE_FORMAT(start_date,'%Y-%m-%d') as start_date, DATE_FORMAT(end_date,'%Y-%m-%d') as end_date 
									from view_employee
									where end_date = '0000-00-00' OR end_date = '' OR end_date = NULL
									ORDER BY emp_no ASC");
								?>
								<select multiple="multiple" class="framework" id="list_employee"
									name="list_employee[]">
									<?php if (mysqli_num_rows($modal) > 0) { ?>
									<?php while ($row = mysqli_fetch_array($modal)) { ?>
									<option class="checked-employee" value="<?php echo $row['emp_no'] ?>" data-section="Employees"
										data-index="1"><?php echo $row['Full_Name'] ?></option>
									<?php } ?>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
					</fieldset>

				</div>

				<div class="modal-footer-sdk">
					<button type="reset" class="btn-sdk btn-primary-left" data-dismiss="modal" aria-hidden="true">
						&nbsp;Cancel&nbsp;
					</button>
					<button class="btn-sdk btn-primary-right" type="button" name="submit_employee" id="submit_employee">
						Confirm
					</button>
				</div>
			</form>


		</div>

		</form>
	</div><!-- /.modal-content -->
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

<script>
	function DetailAuthorizedUser(request) {
		$('#FormDisplayDetail')[0].reset()
		// alert(response)
		$.ajax({
			url: 'php_action/FuncGetDataById.php',
			type: 'post',
			data: {
				request: request
			},
			dataType: 'json',
			async: true,
			success:function(response) {
				$('#detail_user_menu_name').val(response[0].users_menu_name)
				$('#detail_description').val(response[0].description)
				$('#detail_remark').val(response[0].remark)
				$("#detail_list_menu_authorization").load("pages_relation/list_data_menu?rfid=" + response[0].users_menu_name,
					function (responseTxt, statusTxt, jqXHR) {
						if (statusTxt == "success") {
							$("#detail_list_menu_authorization").show();
						}
						if (statusTxt == "error") {
							alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
						}
					}
				);
			}
		})
	}

	$("#FormDisplayDetail").unbind('submit').bind('submit', function (){
		alert('submit update')
		var form = $(this);
		var detail_emp_no = $('#detail_emp_no').val()
		var detail_user_menu_name = $('#detail_user_menu_name').val()
		var detail_description = $('#detail_description').val()
		var detail_remark = $('#detail_remark').val();

		var detail_list_menu = $('.option:checked').map(function(){
			return this.value;
		}).get();

		if (detail_description == "") {
			mymodalss.style.display = "none";
			modals.style.display = "block";
			document.getElementById("msg").innerHTML = "Description cannot empty";
			return false;
		} else if (detail_remark == "") {
			mymodalss.style.display = "none";
			modals.style.display = "block";
			document.getElementById("msg").innerHTML = "Remark cannot empty";
			return false;
		} else if (detail_list_menu.length < 1) {
			mymodalss.style.display = "none";
			modals.style.display = "block";
			document.getElementById("msg").innerHTML = "List menu authorization cannot empty";
			return false;
		} else {
			$.ajax({
				url: 'php_action/FuncUpdate.php',
				type: 'post',
				data: new FormData(document.getElementById("FormDisplayDetail")),
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
			})
		}
	})
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
				var input_user_menu_name = $('#input_user_menu_name').val()
				var input_description = $('#input_description').val()
				var input_remark = $('#input_remark').val();
				// var list_menu_item = $("input[name='data_menu_item[]']").map(function(){return $(this).val();}).get();

				var arr_menu = $('.option:checked').map(function(){
					return this.value;
				}).get();

				if (input_user_menu_name == "") {
					mymodalss.style.display = "none";
					modals.style.display = "block";
					document.getElementById("msg").innerHTML = "User Menu Name cannot empty";
					return false;
				} else if (input_description == "") {
					mymodalss.style.display = "none";
					modals.style.display = "block";
					document.getElementById("msg").innerHTML = "Description cannot empty";
					return false;
				} else if (input_remark == "") {
					mymodalss.style.display = "none";
					modals.style.display = "block";
					document.getElementById("msg").innerHTML = "Remark cannot empty";
					return false;
				} else if (arr_menu.length < 1) {
					mymodalss.style.display = "none";
					modals.style.display = "block";
					document.getElementById("msg").innerHTML = "List menu authorization cannot empty";
					return false;
				}

				if (input_user_menu_name && input_description && input_remark) {
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
	
	$("#list_employee").treeMultiselect({
		allowBatchSelection: true,
		enableSelectAll: true,
		searchable: true,
		sortable: true,
		startCollapsed: false,
	})

	$("#detail-menu-item").treeMultiselect({
		allowBatchSelection: true,
		enableSelectAll: true,
		searchable: true,
		sortable: true,
		startCollapsed: false,
	});

	function AddEmployee(request) {
		document.getElementById("FormDisplayEmployee").reset();
		$('#add_users_menu_name').val(request)
		let checked_employee = $('.option:checked').map(function(){
			return this.value;
		}).get();
		console.log(checked_employee)
	}

	function CreateListEmployee(request) {
		let add_users_menu_name = $('#add_users_menu_name').val()
		let list_employee = $('#list_employee').val()
		let checked_employee = $('.option:checked').map(function(){
			return this.value;
		}).get();

		console.log(checked_employee)
	}

	$('#submit_employee').on('click',function() {
		let add_users_menu_name = $('#add_users_menu_name').val()
		let checked_employee = $('.option:checked').map(function(){
			return this.value;
		}).get();
		console.log(checked_employee.length)
		if (checked_employee.length < 1) {
			mymodalss.style.display = "none";
			modals.style.display = "block";
			document.getElementById("msg").innerHTML = "List employee cannot empty";
			return false;
		}
		$.ajax({
			url: 'php_action/FuncAddEmployee.php',
			type: 'post',
			data: new FormData(document.getElementById("FormDisplayEmployee")),
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
			// error: function(xhr, status, error) {
			// 	mymodalss.style.display = "none";
			// 	modals.style.display = "block";
			// 	document.getElementById("msg").innerHTML = xhr.responseJSON.messages;
			// }
			error:function(response) {
				mymodalss.style.display = "none";
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = response.messages;
			}
		})

	})
	
	
</script>
<!-- isi JSONs -->
</body>

</html>


<script type="text/javascript">
	// var tree4 = 
	
	
</script>