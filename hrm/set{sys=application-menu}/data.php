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
					<th class="fontCustom" style="z-index: 1;">menu_id</th>
					<th class="fontCustom" style="z-index: 1;">menu</th>
					<th class="fontCustom" style="z-index: 1;">module</th>
					<th class="fontCustom" style="z-index: 1;">Action</th>
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
							<div class="col-4 name">User Group Name <span class="required">*</span></div>
							<div class="col-sm-8">
								<div class="input-group">
									<input class="input--style-6"  id="input_user_menu_name"
										name="input_user_menu_name" type="Text" value="" size="30"
										style="width: 60%;">
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

<!-- list data sub menu modal -->
<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="list_data_sub_menu" aria-hidden="true">
	<div class="modal-dialog modal-belakang modal-bg" role="document">

		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">List Data Sub-Menu</h4>
				<a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close"
					style="margin-top: -15px;">
					<span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
				</a>
			</div>
			<div class="py-3" style="height: auto; width: 100%; overflow: scroll;overflow-x: hidden;">
			<div>
				<a href="#" class="open_modal_search float-right" title="Add" data-toggle="modal" data-target="#form_create_sub_menu" id="button_create_sub_menu" data-keyboard="false" data-backdrop="static">
					<div class="toolbar sprite-toolbar-add" title="add sub menu">
					</div>
				</a>
			</div>
				<table class="table table-striped table-bordered display mt-4" id="table-sub-menu">
					<thead class="thead-light">
						<tr>
							<th style="text-align:center">No</th>
							<th style="text-align:center">Menu ID</th>
							<th style="text-align:center">Menu Name</th>
							<th style="text-align:center">Module</th>
							<th style="text-align:center">Action</th>
						</tr>
					</thead>
					<tbody id="data_list_sub_menu">
					</tbody>
				</table>
			</div>
		</div>

		</form>
	</div><!-- /.modal-content -->
</div>
</div>

<!-- list data detail sub menu modal -->
<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="list_data_detail_sub_menu" aria-hidden="true">
	<div class="modal-dialog modal-belakang modal-bg" role="document">

		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">List Data Detail Sub-Menu</h4>
				<a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close"
					style="margin-top: -15px;">
					<span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
				</a>
			</div>
			<div class="py-3" style="height: auto; width: 100%; overflow: scroll;overflow-x: hidden;">
			<div>
				<a href="#" class="open_modal_search float-right" title="Add" data-toggle="modal" data-target="#form_create_detail_sub_menu" id="button_create_detail_sub_menu" data-keyboard="false" data-backdrop="static">
					<div class="toolbar sprite-toolbar-add" title="add detail sub menu">
					</div>
				</a>
			</div>
				<table class="table table-striped table-bordered display mt-4" id="table-detail-sub-menu">
					<thead class="thead-light">
						<tr>
							<th style="text-align:center">No</th>
							<th style="text-align:center">Menu ID</th>
							<th style="text-align:center">Menu Name</th>
							<th style="text-align:center">Module</th>
							<th style="text-align:center">Action</th>
						</tr>
					</thead>
					<tbody id="data_list_detail_sub_menu">
					</tbody>
				</table>
			</div>
		</div>

		</form>
	</div><!-- /.modal-content -->
</div>
</div>


<!-- form create sub menu modal -->
<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="form_create_sub_menu">
	<div class="modal-dialog" role="document">

		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Form Create Sub Menu</h4>
				<a type="button" class="close" data-dismiss="modal" aria-label="Close"
					style="margin-top: -15px;">
					<span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
				</a>
			</div>
			<form class="form-horizontal" action="" method="" id="create_data_sub_menu">

				<div class="card-body table-responsive p-0"">

					<fieldset id="fset_1">
						<legend>Input Form Data</legend>

						<div class="messages_update"></div>

						<input id="detail_emp_no" name="detail_emp_no" type="hidden" value="<?php echo $username; ?>">
						<input id="master_menu_id" name="master_menu_id" type="hidden" value="">

						<!--FROM SESSION -->
						<input id="sel_token" name="sel_token" type="hidden" value="<?php echo $get_token; ?>">

						<div class="form-row">
							<div class="col-4 name">Menu Name <span class="required">*</span></div>
							<div class="col-sm-8">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="input_menu"
										name="input_menu" type="Text" value="" size="30"
										style="width: 60%;">
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-4 name">Hyperlink <span class="required">*</span></div>
							<div class="col-sm-8">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="input_hyperlink"
										name="input_hyperlink" type="Text" value="" size="30"
										style="width: 60%;">
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-4 name">Module Code <span class="required">*</span></div>
							<div class="col-sm-8">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="input_module_code"
										name="input_module_code" type="Text" value="" size="30"
										style="width: 60%;">
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-4 name">Module <span class="required">*</span></div>
							<div class="col-sm-8">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="input_module"
										name="input_module" type="Text" value="" size="30"
										style="width: 60%;">
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-4 name">Link Icon (SVG) <span class="required">*</span></div>
							<div class="col-sm-8">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="input_icon"
										name="input_icon" type="Text" value="" size="30"
										style="width: 60%;">
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
					</fieldset>
				</div>

				<div class="modal-footer-sdk">
					<button type="reset" class="btn-sdk btn-primary-left" data-dismiss="modal" aria-hidden="true">
						&nbsp;Cancel&nbsp;
					</button>
					<button class="btn-sdk btn-primary-right" type="submit" name="submit_data" id="submit_data">
						Confirm
					</button>
				
				</div>
			</form>

		</div>

		</form>
	</div><!-- /.modal-content -->
</div>
</div>
<!-- form create detail sub menu modal -->
<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="form_create_detail_sub_menu">
	<div class="modal-dialog" role="document">

		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Form Create Detail Sub Menu</h4>
				<a type="button" class="close" data-dismiss="modal" aria-label="Close"
					style="margin-top: -15px;">
					<span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
				</a>
			</div>
			<form class="form-horizontal" action="" method="" id="create_data_detail_sub_menu">

				<div class="card-body table-responsive p-0"">

					<fieldset id="fset_1">
						<legend>Input Form Data</legend>

						<div class="messages_update"></div>

						<input id="detail_emp_no" name="detail_emp_no" type="hidden" value="<?php echo $username; ?>">
						<input id="master_detail_menu_id" name="master_detail_menu_id" type="hidden" value="">

						<!--FROM SESSION -->
						<input id="sel_token" name="sel_token" type="hidden" value="<?php echo $get_token; ?>">

						<div class="form-row">
							<div class="col-4 name">Menu Name <span class="required">*</span></div>
							<div class="col-sm-8">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="input_detail_menu"
										name="input_detail_menu" type="Text" value="" size="30"
										style="width: 60%;">
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-4 name">Hyperlink <span class="required">*</span></div>
							<div class="col-sm-8">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="input_detail_hyperlink"
										name="input_detail_hyperlink" type="Text" value="" size="30"
										style="width: 60%;">
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-4 name">Module Code <span class="required">*</span></div>
							<div class="col-sm-8">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="input_detail_module_code"
										name="input_detail_module_code" type="Text" value="" size="30"
										style="width: 60%;">
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-4 name">Module <span class="required">*</span></div>
							<div class="col-sm-8">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="input_detail_module"
										name="input_detail_module" type="Text" value="" size="30"
										style="width: 60%;">
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-4 name">Link Icon (SVG) <span class="required">*</span></div>
							<div class="col-sm-8">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="input_detail_icon"
										name="input_detail_icon" type="Text" value="" size="30"
										style="width: 60%;">
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-4 name">Active Status <span class="required">*</span></div>
							<div class="col-sm-8">
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" name="input_active_status" id="input_detail_active_status" value="1">
									<label class="form-check-label" for="input_detail_active_status">Yes</label>
								</div>
							</div>
						</div>
					</fieldset>
				</div>

				<div class="modal-footer-sdk">
					<button type="reset" class="btn-sdk btn-primary-left" data-dismiss="modal" aria-hidden="true">
						&nbsp;Cancel&nbsp;
					</button>
					<button class="btn-sdk btn-primary-right" type="submit" name="submit_data_detail" id="submit_data_detail">
						Confirm
					</button>
				
				</div>
			</form>

		</div>

		</form>
	</div><!-- /.modal-content -->
</div>
</div>

<!-- form edit sub menu modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="form_edit_sub_menu">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Form Edit Sub Menu</h4>
				<a type="button" class="close" data-dismiss="modal" aria-label="Close"
					style="margin-top: -15px;">
					<span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
				</a>
			</div>
			<form class="form-horizontal" action="" method="" id="edit_data_sub_menu">

				<div class="card-body table-responsive p-0">

					<fieldset id="fset_1">
						<legend>Update Form Data</legend>

						<div class="messages_update"></div>

						<input id="detail_emp_no" name="detail_emp_no" type="hidden" value="<?php echo $username; ?>">
						<input id="detail_menu_id" name="detail_menu_id" type="hidden" value="">

						<!--FROM SESSION -->
						<input id="sel_token" name="sel_token" type="hidden" value="<?php echo $get_token; ?>">

						<div class="form-row">
							<div class="col-4 name">Menu Name <span class="required">*</span></div>
							<div class="col-sm-8">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="detail_menu"
										name="detail_menu" type="Text" value="" size="30"
										style="width: 60%;">
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-4 name">Hyperlink <span class="required">*</span></div>
							<div class="col-sm-8">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="detail_hyperlink"
										name="detail_hyperlink" type="Text" value="" size="30"
										style="width: 60%;">
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-4 name">Module Code <span class="required">*</span></div>
							<div class="col-sm-8">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="detail_module_code"
										name="detail_module_code" type="Text" value="" size="30"
										style="width: 60%;">
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-4 name">Module <span class="required">*</span></div>
							<div class="col-sm-8">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="detail_module"
										name="detail_module" type="Text" value="" size="30"
										style="width: 60%;">
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-4 name">Link Icon (SVG) <span class="required">*</span></div>
							<div class="col-sm-8">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="detail_icon"
										name="detail_icon" type="Text" value="" size="30"
										style="width: 60%;">
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-4 name">Active Status <span class="required">*</span></div>
							<div class="col-sm-8">
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" name="detail_active_status" id="detail_active_status" value="1">
									<label class="form-check-label" for="detail_active_status">Yes</label>
								</div>
							</div>
						</div>
					</fieldset>
				</div>

				<div class="modal-footer-sdk">
					<button type="reset" class="btn-sdk btn-primary-left" data-dismiss="modal" aria-hidden="true">
						&nbsp;Cancel&nbsp;
					</button>
					<button class="btn-sdk btn-primary-right" type="submit" name="submit_update" id="submit_update">
						Confirm
					</button>				
				</div>
			</form>

		</div>

		</form>
	</div><!-- /.modal-content -->
</div>
</div>

<!-- form edit detail sub menu modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="form_edit_detail_sub_menu">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Form Edit Detail Sub Menu</h4>
				<a type="button" class="close" data-dismiss="modal" aria-label="Close"
					style="margin-top: -15px;">
					<span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
				</a>
			</div>
			<form class="form-horizontal" action="" method="" id="edit_data_detail_sub_menu">

				<div class="card-body table-responsive p-0">

					<fieldset id="fset_1">
						<legend>Update Form Data</legend>

						<div class="messages_update"></div>

						<input id="detail_emp_no" name="detail_emp_no" type="hidden" value="<?php echo $username; ?>">
						<input id="detail_sub_menu_id" name="detail_sub_menu_id" type="hidden" value="">

						<!--FROM SESSION -->
						<input id="sel_token" name="sel_token" type="hidden" value="<?php echo $get_token; ?>">

						<div class="form-row">
							<div class="col-4 name">Menu Name <span class="required">*</span></div>
							<div class="col-sm-8">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="detail_sub_menu"
										name="detail_sub_menu" type="Text" value="" size="30"
										style="width: 60%;">
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-4 name">Hyperlink <span class="required">*</span></div>
							<div class="col-sm-8">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="detail_sub_hyperlink"
										name="detail_sub_hyperlink" type="Text" value="" size="30"
										style="width: 60%;">
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-4 name">Module Code <span class="required">*</span></div>
							<div class="col-sm-8">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="detail_sub_module_code"
										name="detail_sub_module_code" type="Text" value="" size="30"
										style="width: 60%;">
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-4 name">Module <span class="required">*</span></div>
							<div class="col-sm-8">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="detail_sub_module"
										name="detail_sub_module" type="Text" value="" size="30"
										style="width: 60%;">
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-4 name">Link Icon (SVG) <span class="required">*</span></div>
							<div class="col-sm-8">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="detail_sub_icon"
										name="detail_sub_icon" type="Text" value="" size="30"
										style="width: 60%;">
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-4 name">Active Status <span class="required">*</span></div>
							<div class="col-sm-8">
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" name="detail_sub_active_status" id="detail_sub_active_status" value="1">
									<label class="form-check-label" for="detail_sub_active_status">Yes</label>
								</div>
							</div>
						</div>
					</fieldset>
				</div>

				<div class="modal-footer-sdk">
					<button type="reset" class="btn-sdk btn-primary-left" data-dismiss="modal" aria-hidden="true">
						&nbsp;Cancel&nbsp;
					</button>
					<button class="btn-sdk btn-primary-right" type="submit" name="submit_update_detail" id="submit_update_detail">
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
	// for get all data sub menu from master menu 
	$(document).ready(function () {
		$(document).on('click','#get_list_sub_menu',function(e) {
			e.preventDefault();
			let menu_id = $(this).data('menuid')
			$.ajax({
				"type": "POST",
				"url": "php_action/GetDataSubMenu.php",
				"timeout": 120000,
				"data": {
					menu_id: menu_id
				},
				dataType: 'json',
				async: true,
				success:function(response){
					$('#data_list_sub_menu').empty()
					$('#button_create_sub_menu').attr('data-master_menu_id', menu_id)
					var number = 1
					for (let index = 0; index < response[0].length; index++) {
						// const element = array[index];
						$('#data_list_sub_menu').append(
							`
							<tr>
								<td style="width:20%;text-align:left;">
									${number++}
								</td>
								<td style="width:20%;text-align:left;">
									${response[0][index]['menu_id']}
								</td>
								<td style="width:20%;text-align:left;">
									${response[0][index]['menu']}
								</td>
								<td style="width:20%;text-align:left;">
									${response[0][index]['module']}
								</td>
								<td style="width:20%;text-align:left;">
									${response[0][index]['get_detail_sub_menu']}
									${response[0][index]['edit_sub_menu']}
								</td>
							</tr>
							`
						)
					}
					$('#table-sub-menu').DataTable({
						processing: true,
						searching: true,
						paging: true,
						retrieve: true,
						pagingType: "simple",
						bAutoWidth: true,
						language: {
							"processing": "Please wait..",
						},
						destroy: true,
					})
				},
				error: function(jqXHR, error, errorThrown) {  
					if(jqXHR.status&&jqXHR.status==400){
						mymodalss.style.display = "none";
						modals.style.display = "block";
						document.getElementById("msg").innerHTML = jqXHR.messages;
					}else{
						alert("Something went wrong");
						// return false;
					}
				}
			})
		})

		// for create sub menu
		$(document).on('click tap', '#button_create_sub_menu', function(e) {
			e.preventDefault();
			let master_menu_id = $(this).data('master_menu_id')
			$('#create_data_sub_menu')[0].reset()
			$('#master_menu_id').val(master_menu_id)
		})

		// submit data sub menu
		$(document).on('click tap', '#submit_data', function() {
			var input_menu = $('#input_menu').val()
			var input_hyperlink = $('#input_hyperlink').val()
			var input_module_code = $('#input_module_code').val()
			var input_module = $('#input_module').val()
			var input_icon = $('#input_icon').val()

			if (input_menu == "") {
				mymodalss.style.display = "none";
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = "Menu name cannot empty";
				return false;
			} else if (input_hyperlink == "") {
				mymodalss.style.display = "none";
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = "Hyperlink cannot empty";
				return false;
			} else if (input_module_code == "") {
				mymodalss.style.display = "none";
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = "Module code cannot empty";
				return false;
			} else if (input_module == "") {
				mymodalss.style.display = "none";
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = "Module cannot empty";
				return false;
			} else if (input_icon == "") {
				mymodalss.style.display = "none";
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = "Icon menu cannot empty";
				return false;
			}

			$.ajax({
				url: 'php_action/CreateSubMenu.php',
				type: 'POST',
				// data: new FormData(document.getElementById("create_data_sub_menu")),
				data: new FormData($('#create_data_sub_menu')[0]),
				processData: false,
				contentType: false,
				dataType: 'json',
				success: function(response){
					$(".form-group").removeClass('has-error').removeClass('has-success');
					mymodalss.style.display = "none";
					modals.style.display = "block";
					document.getElementById("msg").innerHTML = response.messages;

					$('#create_data_sub_menu').modal('hide');
					$("[data-dismiss=modal]").trigger({type: "click"});

					datatable.ajax.reload(null, false);
					location.reload();
				},
				error: function(xhr, status, error) {
					mymodalss.style.display = "none";
					modals.style.display = "block";
					document.getElementById("msg").innerHTML = xhr.responseJSON.messages;
				}
			})
			return false;
		})

		// get data sub menu by id
		$(document).on('click','#edit_list_sub_menu',function(e) {
			e.preventDefault();
			let menu_id = $(this).data('menuid')
			$('#edit_data_sub_menu')[0].reset()
			$('#detail_menu_id').val(menu_id)
			$.ajax({
				url: "php_action/GetDataSubMenuById.php",
				type: "POST",
				timeout: 120000,
				data: {
					menu_id: menu_id
				},
				dataType: 'json',
				async: true,
				success:function(response) {
					console.log(response)
					$('#master_menu_id').val(response.menu_id)
					$('#detail_menu').val(response.menu)
					$('#detail_hyperlink').val(response.hyperlink)
					$('#detail_module_code').val(response.module_code)
					$('#detail_module').val(response.module)
					$('#detail_icon').val(response.svg_icon)
					let detail_status = $('#detail_active_status');
					response.is_active == '1' ? detail_status.attr('checked', true) : detail_status.attr('checked', false)
				}
			})
		})

		// update data sub menu
		$(document).on('click tap', '#submit_update', function() {
			var detail_menu = $('#detail_menu').val()
			var detail_hyperlink = $('#detail_hyperlink').val()
			var detail_module_code = $('#detail_module_code').val()
			var detail_module = $('#detail_module').val()
			var detail_icon = $('#detail_icon').val()

			if (detail_menu == "") {
				mymodalss.style.display = "none";
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = "Menu name cannot empty";
				return false;
			} else if (detail_hyperlink == "") {
				mymodalss.style.display = "none";
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = "Hyperlink cannot empty";
				return false;
			} else if (detail_module_code == "") {
				mymodalss.style.display = "none";
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = "Module code cannot empty";
				return false;
			} else if (detail_module == "") {
				mymodalss.style.display = "none";
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = "Module cannot empty";
				return false;
			} else if (detail_icon == "") {
				mymodalss.style.display = "none";
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = "Icon menu cannot empty";
				return false;
			}

			$.ajax({
				url: 'php_action/UpdateSubMenu.php',
				type: 'POST',
				data: new FormData($('#edit_data_sub_menu')[0]),
				processData: false,
				contentType: false,
				dataType: 'json',
				success: function(response){
					$(".form-group").removeClass('has-error').removeClass('has-success');
					mymodalss.style.display = "none";
					modals.style.display = "block";
					document.getElementById("msg").innerHTML = response.messages;

					$('#create_data_sub_menu').modal('hide');
					$("[data-dismiss=modal]").trigger({type: "click"});

					datatable.ajax.reload(null, false);
					location.reload();
				},
				error: function(xhr, status, error) {
					mymodalss.style.display = "none";
					modals.style.display = "block";
					document.getElementById("msg").innerHTML = xhr.responseJSON.messages;
				}
			})
			return false;
		})

		// fetch data detail sub menu
		$(document).on('click', '#get_list_detail_sub_menu', function(e) {
			e.preventDefault();
			let menu_id = $(this).data('menuid')

			$.ajax({
				"type": "POST",
				"url": "php_action/GetDataDetailSubMenu.php",
				"timeout": 120000,
				"data": {
					menu_id: menu_id
				},
				dataType: 'json',
				async: true,
				success: function(response) {
					$('#data_list_detail_sub_menu').empty()
					$('#button_create_detail_sub_menu').attr('data-master_menu_id', menu_id)
					var number = 1
					for (let index = 0; index < response[0].length; index++) {
						$('#data_list_detail_sub_menu').append(
							`
							<tr>
								<td style="width:20%;text-align:left;">
									${number++}
								</td>
								<td style="width:20%;text-align:left;">
									${response[0][index]['menu_id']}
								</td>
								<td style="width:20%;text-align:left;">
									${response[0][index]['menu']}
								</td>
								<td style="width:20%;text-align:left;">
									${response[0][index]['module']}
								</td>
								<td style="width:20%;text-align:left;">
									${response[0][index]['edit_detail_sub_menu']}
								</td>
							</tr>
							`
						)
					}
					$('#table-detail-sub-menu').DataTable({
						processing: true,
						searching: true,
						paging: true,
						retrieve: true,
						pagingType: "simple",
						bAutoWidth: true,
						language: {
							"processing": "Please wait..",
						},
						destroy: true,
					})
				}
			})
		})

		// for create data detail sub menu
		$(document).on('click', '#button_create_detail_sub_menu', function(e) {
			e.preventDefault()
			let master_detail_menu_id = $(this).data('master_menu_id')
			$('#create_data_detail_sub_menu')[0].reset()
			$('#master_detail_menu_id').val(master_detail_menu_id)
		})

		// for submit data detail sub menu
		$(document).on('click tap', '#submit_data_detail', function() {
			var input_detail_menu = $('#input_detail_menu').val()
			var input_detail_hyperlink = $('#input_detail_hyperlink').val()
			var input_detail_module_code = $('#input_detail_module_code').val()
			var input_detail_module = $('#input_detail_module').val()
			var input_detail_icon = $('#input_detail_icon').val()

			if (input_detail_menu == "") {
				mymodalss.style.display = "none";
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = "Menu name cannot empty";
				return false;
			} else if (input_detail_hyperlink == "") {
				mymodalss.style.display = "none";
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = "Hyperlink cannot empty";
				return false;
			} else if (input_detail_module_code == "") {
				mymodalss.style.display = "none";
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = "Module code cannot empty";
				return false;
			} else if (input_detail_module == "") {
				mymodalss.style.display = "none";
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = "Module cannot empty";
				return false;
			} else if (input_detail_icon == "") {
				mymodalss.style.display = "none";
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = "Icon menu cannot empty";
				return false;
			}

			$.ajax({
				url: 'php_action/CreateDetailSubMenu.php',
				type: 'POST',
				data: new FormData($('#create_data_detail_sub_menu')[0]),
				processData: false,
				contentType: false,
				dataType: 'json',
				success: function(response){
					$(".form-group").removeClass('has-error').removeClass('has-success');
					mymodalss.style.display = "none";
					modals.style.display = "block";
					document.getElementById("msg").innerHTML = response.messages;

					$('#create_data_sub_menu').modal('hide');
					$("[data-dismiss=modal]").trigger({type: "click"});

					datatable.ajax.reload(null, false);
					location.reload();
				},
				error: function(xhr, status, error) {
					mymodalss.style.display = "none";
					modals.style.display = "block";
					document.getElementById("msg").innerHTML = xhr.responseJSON.messages;
				}
			})
			return false;
		})

		// for get data edit detail sub menu
		$(document).on('click','#edit_detail_sub_menu',function(e) {
			e.preventDefault();
			let detail_menu_id = $(this).data('menuid')
			$('#edit_data_detail_sub_menu')[0].reset()
			$('#detail_menu_id').val(detail_menu_id)

			$.ajax({
				url: "php_action/GetDataDetailSubMenuById.php",
				type: "POST",
				timeout: 120000,
				data: {
					menu_id: detail_menu_id
				},
				dataType: 'json',
				async: true,
				success:function(response) {
					console.log(response)
					$('#detail_sub_menu_id').val(response.menu_id)
					$('#detail_sub_menu').val(response.menu)
					$('#detail_sub_hyperlink').val(response.hyperlink)
					$('#detail_sub_module_code').val(response.module_code)
					$('#detail_sub_module').val(response.module)
					$('#detail_sub_icon').val(response.svg_icon)
					let detail_status = $('#detail_sub_active_status');
					response.is_active == '1' ? detail_status.attr('checked', true) : detail_status.attr('checked', false)
				}
			})
		})

		// for submit update detail sub menu
		$(document).on('click tap', '#submit_update_detail',function() {
			var detail_sub_menu = $('#detail_sub_menu').val()
			var detail_sub_hyperlink = $('#detail_sub_hyperlink').val()
			var detail_sub_module_code = $('#detail_sub_module_code').val()
			var detail_sub_module = $('#detail_sub_module').val()
			var detail_sub_icon = $('#detail_sub_icon').val()

			if (detail_sub_menu == "") {
				mymodalss.style.display = "none";
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = "Menu name cannot empty";
				return false;
			} else if (detail_sub_hyperlink == "") {
				mymodalss.style.display = "none";
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = "Hyperlink cannot empty";
				return false;
			} else if (detail_sub_module_code == "") {
				mymodalss.style.display = "none";
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = "Module code cannot empty";
				return false;
			} else if (detail_sub_module == "") {
				mymodalss.style.display = "none";
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = "Module cannot empty";
				return false;
			} else if (detail_sub_icon == "") {
				mymodalss.style.display = "none";
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = "Icon menu cannot empty";
				return false;
			}

			$.ajax({
				url: 'php_action/UpdateDetailSubMenu.php',
				type: 'POST',
				data: new FormData($('#edit_data_detail_sub_menu')[0]),
				processData: false,
				contentType: false,
				dataType: 'json',
				success: function(response){
					$(".form-group").removeClass('has-error').removeClass('has-success');
					mymodalss.style.display = "none";
					modals.style.display = "block";
					document.getElementById("msg").innerHTML = response.messages;

					$('#create_data_sub_menu').modal('hide');
					$("[data-dismiss=modal]").trigger({type: "click"});

					datatable.ajax.reload(null, false);
					location.reload();
				},
				error: function(xhr, status, error) {
					mymodalss.style.display = "none";
					modals.style.display = "block";
					document.getElementById("msg").innerHTML = xhr.responseJSON.messages;
				}
			})
			return false;
		})
	})
</script>

</body>

</html>