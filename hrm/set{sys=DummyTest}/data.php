<?php  
	$src_reason_code                   = '';
	$src_reason_name_en                = '';
	if (!empty($_POST['src_reason_code']) && !empty($_POST['src_reason_name_en'])) {
			$src_reason_code            = $_POST['src_reason_code'];
			$src_reason_name_en         = $_POST['src_reason_name_en'];
			$frameworks                 = "?src_reason_code="."".$src_reason_code." &&src_reason_name_en="."".$src_reason_name_en."";
	} else if (empty($_POST['src_reason_code']) && !empty($_POST['src_reason_name_en'])) {
			$src_reason_code            = $_POST['src_reason_code'];
			$src_reason_name_en         = $_POST['src_reason_name_en'];
			$frameworks                 = "?src_reason_name_en="."".$src_reason_name_en."";
	} else if (!empty($_POST['src_reason_code']) && empty($_POST['src_reason_name_en'])) {
			$src_reason_code            = $_POST['src_reason_code'];
			$src_reason_name_en         = $_POST['src_reason_name_en'];
			$frameworks                 = "?src_reason_code="."".$src_reason_code."";
	}
?>
<!-- Modal -->
<div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2"  data-backdrop="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
					<span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
				</a>
				<form method="post" id="myform">
					<fieldset id="fset_1" style="margin-top: 25px;border-radius: 5px;border: 1px solid #e4e8ea;">
						<legend>Searching</legend>
						<div class="form-row">
							<div class="col-4 name">Reason code</div>
							<div class="col-sm-8">
								<div class="input-group">
									<input class="input--style-6"
										autocomplete="off" autofocus="on" id="src_reason_code"
										name="src_reason_code" id="src_reason_code" type="Text" value="<?php echo $src_reason_code; ?>"
										onfocus="hlentry(this)" size="30" maxlength="50" 
										validate="NotNull:Invalid Form Entry"
										onchange="formodified(this);" title="">
								</div>
							</div>
						</div>

						<div class="form-row">
							<div class="col-4 name">Reason name</div>
							<div class="col-sm-8">
								<div class="input-group"></div>
									<input class="input--style-6"
										autocomplete="off" autofocus="on"
										name="src_reason_name_en" id="src_reason_name_en" type="Text" value="<?php echo $src_reason_name_en; ?>"
										onfocus="hlentry(this)" size="30" maxlength="50" 
										validate="NotNull:Invalid Form Entry"
										onchange="formodified(this);" title="">
								</div>
							</div>
						</div>
					</fieldset>
					<button type="submit" name="submit_add" id="submit_add" type="button" class="btn btn-warning button_bot">
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
$(document).ready(function() {
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




<div class="col-md-12">
	<div class="card">
			<div class="card-header d-flex align-items-center">
					<h4 class="card-title mb-0">Overtime Reason Setting </h4>
					<div class="card-actions ml-auto">
						<table>
								<td>
										<form action="../rfid=repository/cli_Template_Download/st/StFunctionDownload.php" method="GET">
												<input type="hidden" name="filedata" value="StDownloadGTTGROvertimeReasonData.php">
												<input type="hidden" name="filename" value="OvertimeReason">
												<input type="hidden" name="src_reason_code" value="<?php echo $src_reason_code; ?>">
												<input type="hidden" name="src_reason_name_en" value="<?php echo $src_reason_name_en; ?>">
												<button type="submit" class="toolbar sprite-toolbar-excel" id="EXCEL" style="border: 0;background-color: white;" name="submit_approve" value="submit"></button>
										</form>

								</td>
								<td>

										<a href='#' class='open_modal_search' class="btn btn-demo" data-toggle="modal" data-target="#myModal2">
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

			<div class="card-body table-responsive p-0"
					style="width: 100vw;height: 78vh; width: 99.8%; margin: 5px;overflow: scroll;">
					<table id="datatable" width="60%" border="1" align="left"
						class="table table-bordered table-striped table-hover table-head-fixed">
						<thead>
								<tr>
										<th class="fontCustom"
												style="z-index: 1;vertical-align: ce;vertical-align: middle;"
												nowrap="nowrap">No.</th>
										<th class="fontCustom"
												style="z-index: 1;vertical-align: ce;vertical-align: middle;">
												Column 1</th>
										<th class="fontCustom"
												style="z-index: 1;vertical-align: ce;vertical-align: middle;">Column 2
										</th>
										<th class="fontCustom"
												style="z-index: 1;vertical-align: ce;vertical-align: middle;">Column 3
										</th>
										<th class="fontCustom"
												style="z-index: 1;vertical-align: ce;vertical-align: middle;">Column 4
										</th>
										<th class="fontCustom"
												style="z-index: 1;vertical-align: ce;vertical-align: middle;">
												Action
										</th>
										<!-- <th class="fontCustom" style="z-index: 1;vertical-align: ce;vertical-align: middle;">Grade</th>
								
										<th class="fontCustom" style="z-index: 1;vertical-align: ce;vertical-align: middle;">Join Date</th>
															<th class="fontCustom" style="z-index: 1;vertical-align: ce;vertical-align: middle;">Employment Code</th> -->
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
	<div class="modal-dialog modal-belakang modal-bs" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add Table Debug</h4>
				<a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
					<span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
				</a>
			</div>

			<form class="form-horizontal" action="php_action/FuncDataCreate.php" method="POST" id="FormDisplayCreate">
				<fieldset id="fset_1">
					<legend>General</legend>

					<div class="messages_create"></div>

					<input id="inp_emp_no" name="inp_emp_no" type="hidden" value="<?php echo $username; ?>"><!--FROM SESSION -->
					<input id="inp_token" name="inp_token" type="hidden" value="<?php echo $get_token; ?>"><!--FROM CONFIGURATION -->

					<div class="form-row">
						<div class="col-4 name">col_1 <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on"
									id="inp_col_1" name="inp_col_1"
									type="Text" value="" onfocus="hlentry(this)" size="30"
									maxlength="50"
									style="text-transform:uppercase;width: 60%;"
									validate="NotNull:Invalid Form Entry"
									onchange="formodified(this);" title="">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">col_2 <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on"
									id="inp_col_2" name="inp_col_2"
									type="Text" value="" onfocus="hlentry(this)" size="30"
									maxlength="50"
									style="text-transform:uppercase;width: 60%;"
									validate="NotNull:Invalid Form Entry"
									onchange="formodified(this);" title="">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">col_3 <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on"
									id="inp_col_3" name="inp_col_3"
									type="Text" value="" onfocus="hlentry(this)" size="30"
									maxlength="50"
									style="text-transform:uppercase;width: 60%;"
									validate="NotNull:Invalid Form Entry"
									onchange="formodified(this);" title="">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">col_4 <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on"
									id="inp_col_4" name="inp_col_4"
									type="Text" value="" onfocus="hlentry(this)" size="30"
									maxlength="50"
									style="text-transform:uppercase;width: 60%;"
									validate="NotNull:Invalid Form Entry"
									onchange="formodified(this);" title="">
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
					<button class="btn btn-warning" type="button" name="submit_add2" id="submit_add2" style='display:none;' disabled>
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
				<a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
					<span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
				</a>
			</div>
			<form class="form-horizontal" action="php_action/FuncDataUpdate.php" method="POST" id="FormDisplayUpdate">
				<fieldset id="fset_1">
					<legend>General</legend>

					<div class="messages_update"></div>

					<input id="sel_emp_no" name="sel_emp_no" type="hidden" value="<?php echo $username; ?>"><!--FROM SESSION -->
					<input id="sel_token" name="sel_token" type="hidden" value="<?php echo $get_token; ?>"><!--FROM CONFIGURATION -->
					<div class="form-row">
						<div class="col-4 name">Group Code <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group" id="sel_identity"></div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">Column 1 <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on"
									id="edit_col1" name="edit_col1"
									type="Text" value="" onfocus="hlentry(this)" size="30"
									maxlength="50"
									style="text-transform:uppercase;width: 60%;"
									validate="NotNull:Invalid Form Entry"
									onchange="formodified(this);" title="" readonly>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">Column 2 <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on"
									id="edit_col2" name="edit_col2"
									type="Text" value="" onfocus="hlentry(this)" size="30"
									maxlength="50"
									style="text-transform:uppercase;width: 60%;"
									validate="NotNull:Invalid Form Entry"
									onchange="formodified(this);" title="">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">Column 3 <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on"
									id="edit_col3" name="edit_col3"
									type="Text" value="" onfocus="hlentry(this)" size="30"
									maxlength="50"
									style="text-transform:uppercase;width: 60%;"
									validate="NotNull:Invalid Form Entry"
									onchange="formodified(this);" title="">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">Column 4 <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on"
									id="edit_col4" name="edit_col4"
									type="Text" value="" onfocus="hlentry(this)" size="30"
									maxlength="50"
									style="text-transform:uppercase;width: 60%;"
									validate="NotNull:Invalid Form Entry"
									onchange="formodified(this);" title="">
							</div>
						</div>
					</div>
				</fieldset>

				<div class="modal-footer">
					<button type="reset" class="btn btn-primary1" data-dismiss="modal"
							aria-hidden="true">
							&nbsp;Cancel&nbsp;
					</button>
					
					<button class="btn btn-warning" type="submit" name="submit_update" id="submit_update">
							Confirm
					</button>
					<button class="btn btn-warning" type="button" name="submit_update2"
						id="submit_update2" style='display:none;' disabled>
						<span class="spinner-grow spinner-grow-sm" role="status"
								aria-hidden="true"></span>
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
				<td align="center"><img src="../../asset/dist/img/sf-mola-mola.png" style="max-width: 90%;margin-top: 20px;"><td>
			</tr>
		</table>
		<div class="form-group">
			<div class="col-sm-12">	
				<table width="100%">
					<td align="center">
						<label id="isi">Are you sure to delete data ?</label>
					</td>
				</table>		
				<input type="hidden" class="form-control input-report" id="del_dummy_debug_by_col1" name="debug_by_col1" placeholder="">
			</div>
		</div>
		<div class="modal-footer-delete FormDisplayDelete" style="text-align: center;padding-top: 20px;">
				<button type="reset" class="btn btn-primary1" style="background: #ececec;" data-dismiss="modal" aria-hidden="true">
					&nbsp;Cancel&nbsp;
				</button>
				<button class="btn btn-warning" type="submit" name="submit_delete" id="submit_delete">
					Confirm
				</button>
				<button class="btn btn-warning" type="button" name="submit_delete2"
					id="submit_delete2" style='display:none;' disabled>
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

	setTimeout(function(){
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
$(document).ready(function() {
	$("#CreateButton").on('click', function() {

		alert("Dummy Test");
		// reset the form 
		$("#FormDisplayCreate")[0].reset();
		// empty the message div

		$(".messages_create").html("");

		// submit form
		$("#FormDisplayCreate").unbind('submit').bind('submit', function() {

			$(".text-danger").remove();

			var form = $(this);

			// var inp_reason_code = $("#inp_reason_code").val();
			// var inp_reason_name_en = $("#inp_reason_name_en").val();
			// var inp_reason_name_id = $("#inp_reason_name_id").val();
			var inp_col_1 = $("#inp_col_1").val();
			var inp_col_2 = $("#inp_col_2").val();
			var inp_col_3 = $("#inp_col_3").val();
			var inp_col_4 = $("#inp_col_4").val();
		

			var regex=/^[a-zA-Z]+$/;
		
			if (inp_col_1 == "") {
				modals.style.display ="block";
				document.getElementById("msg").innerHTML = "Column 1 cannot empty";

			} else if (inp_col_2 == "") {
				modals.style.display ="block";
				document.getElementById("msg").innerHTML = "Column 2 en cannot empty";

			} else if (inp_col_3 == "") {
				modals.style.display ="block";
				document.getElementById("msg").innerHTML = "Column 3 id cannot empty";

			} else if (inp_col_4 == "") {
				modals.style.display ="block";
				document.getElementById("msg").innerHTML = "Column 4 id cannot empty";

			} else {
				$('#submit_add').hide();
				$('#submit_add2').show();
			}

			if (inp_col_1 && inp_col_2 && inp_col_3 && inp_col_4) {

				//submi the form to server
				$.ajax({
					url: form.attr('action'),
					type: form.attr('method'),
					// data: form.serialize(),

					data: new FormData(this),
					processData: false,
					contentType: false,

					dataType: 'json',
					success: function(response) {
						// remove the error 
						$(".form-group").removeClass('has-error').removeClass('has-success');

						if (response.code =='success_message') {
							modals.style.display ="block";
							document.getElementById("msg").innerHTML = response.messages;

							$('#submit_add').show();
							$('#submit_add2').hide();

							$('#FormDisplayCreate').modal('hide');  
							$("[data-dismiss=modal]").trigger({type: "click"});   

							// reset the form
							$("#FormDisplayCreate")[0].reset();
							// reload the datatables
							datatable.ajax.reload(null,false);
							// this function is built in function of datatables;
						} else {
							modals.style.display ="block";
							document.getElementById("msg").innerHTML = response.messages;

							$('#submit_add').show();
							$('#submit_add2').hide();

							window.setTimeout(
								function() {
									$(".alert")
										.fadeTo(500,0).slideUp(500, function() {
											$(this).remove();
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

			success: function(response) {
				document.getElementById("sel_identity").innerHTML = response.col1;
				// $("#debug_by_col1").val(response.reason_code);
				// $("#sel_reason_name_id").val(response.reason_name_id);     
				$("#edit_col1").val(response.col1);
				$("#edit_col2").val(response.col2);
				$("#edit_col3").val(response.col3);
				$("#edit_col4").val(response.col4);
								

				// here update the member data
				$("#FormDisplayUpdate").unbind('submit').bind('submit', function() {
					// remove error messages
					$(".text-danger").remove();

					var form = $(this);

					// var debug_by_col1         = $("#debug_by_col1").val();
					// var sel_reason_name_id      = $("#sel_reason_name_id").val();
					var edit_col1      = $("#edit_col1").val();
					var edit_col2      = $("#edit_col2").val();
					var edit_col3      = $("#edit_col3").val();
					var edit_col4      = $("#edit_col4").val();

					var regex=/^[a-zA-Z]+$/;

					if (edit_col1 == "") {
							modals.style.display ="block";
							document.getElementById("msg").innerHTML = "Reason code cannot empty";

					} else if (edit_col2 == "") {
							modals.style.display ="block";
							document.getElementById("msg").innerHTML = "Reason desc en cannot empty";

					} else if (edit_col3 == "") {
							modals.style.display ="block";
							document.getElementById("msg").innerHTML = "Reason desc id cannot empty";
					
						} else if (edit_col4 == "") {
							modals.style.display ="block";
							document.getElementById("msg").innerHTML = "Reason desc id cannot empty";

					} else {
							$('#submit_update').hide();
							$('#submit_update2').show();
					}
					if (edit_col1 && edit_col2 && edit_col3 && edit_col4) {
						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							// data: form.serialize(),

							data: new FormData(this),
							processData: false,
							contentType: false,

							dataType: 'json',
							success: function(response) {
								if (response.code =='success_message') {
									modals.style.display = "block";
									document.getElementById("msg").innerHTML =response.messages;

									$('#submit_update').show();
									$('#submit_update2').hide();

									$('#FormDisplayUpdate').modal('hide');  
									$("[data-dismiss=modal]").trigger({type: "click"});      
							
									// reload the datatables
									datatable.ajax.reload(null,false);
									// reload the datatables
								} else {
									modals.style.display = "block";
									document.getElementById("msg").innerHTML = response.messages;
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

// function delete data dummy
function editdelMember(id = null) {
if(id) {

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
		data: {member_id : id},
		dataType: 'json',
		success:function(response) {

			$("#del_dummy_debug_by_col1").val(response.col1);

			// mmeber id 
			$(".FormDisplayDelete").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');

			// here update the member data
			$("#updatedelMemberForm").unbind('submit').bind('submit', function() {
				// remove error messages
				$(".text-danger").remove();

				var form = $(this);

				// validation
				var del_dummy_debug_by_col1 = $("#del_dummy_debug_by_col1").val();

				if(del_dummy_debug_by_col1 == "") {
					modals.style.display ="block";
					document.getElementById("msg").innerHTML = "Shiftgroup schedule code cannot empty";
				} else {
					$('#submit_delete').hide();
					$('#submit_delete2').show();
				}

				if(del_dummy_debug_by_col1) {
					$.ajax({
						url: form.attr('action'),
						type: form.attr('method'),
						data: form.serialize(),
						dataType: 'json',
						success:function(response) {
							if (response.code == 'success_message') {
								modals.style.display = "block";
								document.getElementById("msg").innerHTML = response.messages;

								$('#submit_delete').show();
								$('#submit_delete2').hide();                                                             

								// reload the datatables
								datatable.ajax.reload(null,false);
								// reload the datatables

								$('#FormDisplayDelete').modal('hide');  
								$("[data-dismiss=modal]").trigger({type: "click"}); 
								
							} else {
								modals.style.display = "block";
								document.getElementById("msg").innerHTML = response.messages;
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

<script>
jQuery(function($) {
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
	}).success(function(data) {
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



						
	
					
