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
<?php
	include 'php_action/getDataCountry';
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
										size="30" maxlength="50" 
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
										size="30" maxlength="50" 
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
<script type="text/javascript" src="../../asset/sdk_datatables_core/datatables/bedanihbuatjson/bootstrap/js/bootstrap.min.js"></script>
<!-- MAIN DATATABLE SERVERSIDE CSS -->
<!-- MAIN DATATABLE SERVERSIDE CSS -->

<!-- select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- font awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<!-- CDN summernote -->
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<!-- add defer in cdn -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js" defer></script>

<!-- sweetalert2 -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
			<h4 class="card-title mb-0">Data Setting Certificate Templates</h4>
			<div class="card-actions ml-auto">
				<table>
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
						</div>
					</td>
				</table>
			</div>
		</div>

		<!-- table data list setting provider -->
		<div class="card-body table-responsive p-0" style="width: 100vw;height: 78vh; width: 99.8%; margin: 5px;overflow: scroll;">
			<table id="datatable" width="60%" border="1" align="left"
				class="table table-bordered table-striped table-hover table-head-fixed">
				<thead>
					<tr>
                        <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No.</th>
                        <th class="fontCustom" style="z-index: 1;">Certificate Code</th>
                        <th class="fontCustom" style="z-index: 1;">Certificate Name</th>
                        <th class="fontCustom" style="z-index: 1;">Action</th>
                    </tr>
				</thead>
			</table>
		</div>
		<div class='card-footer' style='background-color: #eee;height: 37px;padding-top: 5px;'>
		</div>
	</div>
</div>

<!-- data modal add certificate templates -->
<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="CreateForm">
	<div class="modal-dialog modal-belakang modal-bg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add Data Certificate Templates</h4>
				<a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
					<span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
				</a>
			</div>

			<form class="form-horizontal" action="php_action/FuncDataCreate.php" method="POST" id="FormDisplayCreate">
				<fieldset id="fset_1">
					<legend>Form Data</legend>

					<div class="messages_create"></div>

					<!--FROM SESSION -->
					<input id="input_emp_no" name="input_emp_no" type="hidden" value="<?php echo $username; ?>">
					<!--FROM CONFIGURATION -->
					<input id="inp_token" name="inp_token" type="hidden" value="<?php echo $get_token; ?>">

					<div class="form-row">
						<div class="col-4 name">Certificate Code <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on" id="input_certificate_code"
									name="input_certificate_code" type="Text" value="" onfocus="hlentry(this)" size="30"
									maxlength="50" style="text-transform:uppercase;width: 60%;"
									validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
							</div>
						</div>
					</div>

					<div class="form-row">
						<div class="col-4 name">Certificate Title <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on" id="input_certificate_title_en"
									name="input_certificate_title_en" type="Text" value="" onfocus="hlentry(this)" size="30"
									maxlength="50" style="text-transform:uppercase;width: 60%;"
									validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="" placeholder="Inggris">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name"></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on" id="input_certificate_title_id"
									name="input_certificate_title_id" type="Text" value="" onfocus="hlentry(this)" size="30"
									maxlength="50" style="text-transform:uppercase;width: 60%;"
									validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="" placeholder="Indonesia">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name"></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on" id="input_certificate_title_th"
									name="input_certificate_title_th" type="Text" value="" onfocus="hlentry(this)" size="30"
									maxlength="50" style="text-transform:uppercase;width: 60%;"
									validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="" placeholder="Thailand">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">Preview Certificate <span class="required">English</span></div>
						<div class="col-8">
							<textarea id="input_certificate_editor_wysiwyg_en" name="input_certificate_editor_wysiwyg_en"></textarea>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">Preview Certificate <span class="required">Indonesian</span></div>
						<div class="col-8">
							<textarea id="input_certificate_editor_wysiwyg_id" name="input_certificate_editor_wysiwyg_id"></textarea>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">Preview Certificate <span class="required">Thailand</span></div>
						<div class="col-8">
							<textarea id="input_certificate_editor_wysiwyg_th" name="input_certificate_editor_wysiwyg_th"></textarea>
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

<!-- data modal edit Certificate Templates -->
<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="UpdateForm">
	<div class="modal-dialog modal-belakang modal-bg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Edit Data Certificate Templates</h4>
				<a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
					<span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
				</a>
			</div>

			<form class="form-horizontal" action="php_action/FuncDataUpdate.php" method="POST" id="FormDisplayCreate">
				<fieldset id="fset_1">
					<legend>Form Data</legend>

					<div class="messages_create"></div>

					<!--FROM SESSION -->
					<input id="edit_emp_no" name="edit_emp_no" type="hidden" value="<?php echo $username; ?>">
					<!--FROM CONFIGURATION -->
					<input id="inp_token" name="inp_token" type="hidden" value="<?php echo $get_token; ?>">

					<div class="form-row">
						<div class="col-4 name">Certificate Code <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on" id="edit_certificate_code"
									name="edit_certificate_code" type="Text" value="" onfocus="hlentry(this)" size="30"
									maxlength="50" style="text-transform:uppercase;width: 60%;"
									validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="" readonly>
							</div>
						</div>
					</div>

					<div class="form-row">
						<div class="col-4 name">Certificate Title <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on" id="edit_certificate_title_en"
									name="edit_certificate_title_en" type="Text" value="" onfocus="hlentry(this)" size="30"
									maxlength="50" style="text-transform:uppercase;width: 60%;"
									validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="" placeholder="Inggris">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name"></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on" id="edit_certificate_title_id"
									name="edit_certificate_title_id" type="Text" value="" onfocus="hlentry(this)" size="30"
									maxlength="50" style="text-transform:uppercase;width: 60%;"
									validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="" placeholder="Indonesia">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name"></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on" id="edit_certificate_title_th"
									name="edit_certificate_title_th" type="Text" value="" onfocus="hlentry(this)" size="30"
									maxlength="50" style="text-transform:uppercase;width: 60%;"
									validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="" placeholder="Thailand">
							</div>
						</div>
					</div>

					<div class="form-row">
						<div class="col-4 name">Preview Certificate <span class="required">English</span></div>
						<div class="col-8">
							<textarea id="edit_certificate_editor_wysiwyg_en" name="edit_certificate_editor_wysiwyg_en"></textarea>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">Preview Certificate <span class="required">Indonesian</span></div>
						<div class="col-8">
							<textarea id="edit_certificate_editor_wysiwyg_id" name="edit_certificate_editor_wysiwyg_id"></textarea>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">Preview Certificate <span class="required">Thailand</span></div>
						<div class="col-8">
							<textarea id="edit_certificate_editor_wysiwyg_th" name="edit_certificate_editor_wysiwyg_th"></textarea>
						</div>
					</div>

				</fieldset>

				<div class="modal-footer">
					<button type="reset" class="btn btn-primary1" data-dismiss="modal" aria-hidden="true" id="close_edit_form_venue">
						&nbsp;Cancel&nbsp;
					</button>
					<button class="btn btn-warning" type="submit" name="submit_update" id="submit_update">
						Confirm
					</button>
					<button class="btn btn-warning" type="button" name="submit_update2"
						id="submit_update2" style='display:none;' disabled>
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
				<input type="hidden" class="form-control input-report" id="del_certificate_code" name="del_certificate_code" placeholder="">
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
	// summernote edit form
	$('#edit_certificate_editor_wysiwyg_en').summernote({
		tabsize: 2,
		height: 100,
		disableDragAndDrop: true
	});
	$('#edit_certificate_editor_wysiwyg_id').summernote({
		tabsize: 2,
		height: 100,
		disableDragAndDrop: true
	});
	$('#edit_certificate_editor_wysiwyg_th').summernote({
		tabsize: 2,
		height: 100,
		disableDragAndDrop: true
	});
</script>

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
	// setup form create and insert data
	$(document).ready(function() {
		$("#CreateButton").on('click', function() {
			// reset the form 
			$("#FormDisplayCreate")[0].reset();
			// empty the message div

			// summernote create form
			$('#input_certificate_editor_wysiwyg_en').summernote({
				tabsize: 2,
				height: 100,
				spellCheck: true,
				// toolbar: [
				// 	['style', ['style']],
				// 	['font', ['bold', 'underline', 'italic', 'superscript', 'subscript', 'clear']],
				// 	['fontname', ['fontname','fontsize']],
				// 	['color', ['color']],
				// 	['para', ['ul', 'ol', 'paragraph']],
				// 	['table', ['table']],
				// 	['insert', ['link', 'picture', 'video']],
				// 	['view', ['fullscreen', 'help', 'undo', 'redo']],
				// ],
				// callbacks: {
				// 	onImageUpload: function(files, editor, welEditable) {
				// 		uploadFile(files[0], editor, welEditable);
				// 	}
				// }

			});
			$('#input_certificate_editor_wysiwyg_id').summernote({
				tabsize: 2,
				height: 100,
				spellCheck: true,
				// toolbar: [
				// 	['style', ['style']],
				// 	['font', ['bold', 'underline', 'italic', 'superscript', 'subscript', 'clear']],
				// 	['fontname', ['fontname','fontsize']],
				// 	['color', ['color']],
				// 	['para', ['ul', 'ol', 'paragraph']],
				// 	['table', ['table']],
				// 	['insert', ['link', 'picture', 'video']],
				// 	['view', ['fullscreen', 'help', 'undo', 'redo']],
				// ],
				// callbacks: {
				// 	onImageUpload: function(files, editor, welEditable) {
				// 		uploadFile(files[0], editor, welEditable);
				// 	}
				// }

			});
			$('#input_certificate_editor_wysiwyg_th').summernote({
				tabsize: 2,
				height: 100,
				spellCheck: true,
				// toolbar: [
				// 	['style', ['style']],
				// 	['font', ['bold', 'underline', 'italic', 'superscript', 'subscript', 'clear']],
				// 	['fontname', ['fontname','fontsize']],
				// 	['color', ['color']],
				// 	['para', ['ul', 'ol', 'paragraph']],
				// 	['table', ['table']],
				// 	['insert', ['link', 'picture', 'video']],
				// 	['view', ['fullscreen', 'help', 'undo', 'redo']],
				// ],
				// callbacks: {
				// 	onImageUpload: function(files, editor, welEditable) {
				// 		uploadFile(files[0], editor, welEditable);
				// 	}
				// }

			});
			$(".messages_create").html("");

			// submit form
			$("#FormDisplayCreate").unbind('submit').bind('submit', function() {

				$(".text-danger").remove();

				var form = $(this);

				// initial variable
				var inp_emp_no = $("#inp_emp_no").val();
				var input_certificate_code = $("#input_certificate_code").val();
				var input_certificate_title_en = $("#input_certificate_title_en").val();
				var input_certificate_title_id = $("#input_certificate_title_id").val();
				var input_certificate_title_th = $("#input_certificate_title_th").val();
				var input_certificate_editor_wysiwyg_en = $("#input_certificate_editor_wysiwyg_en").val();
				var input_certificate_editor_wysiwyg_id = $("#input_certificate_editor_wysiwyg_id").val();
				var input_certificate_editor_wysiwyg_th = $("#input_certificate_editor_wysiwyg_th").val();
				
				var regex=/^[a-zA-Z]+$/;

				if (input_certificate_code == "") {
					modals.style.display ="block";
					document.getElementById("msg").innerHTML = "Certificate Code cannot empty";
					return false;
				} else if (input_certificate_title_en == "") {
					modals.style.display ="block";
					document.getElementById("msg").innerHTML = "Certificate Title English cannot empty";
					return false;
				} else if (input_certificate_title_id == "") {
					modals.style.display ="block";
					document.getElementById("msg").innerHTML = "Certificate Title Indonesian cannot empty";
					return false;
				} else if (input_certificate_title_th == "") {
					modals.style.display ="block";
					document.getElementById("msg").innerHTML = "Certificate Title Thailand cannot empty";
					return false;
				} else if (input_certificate_editor_wysiwyg_en == "") {
					modals.style.display ="block";
					document.getElementById("msg").innerHTML = "Certificate Design English cannot empty";
					return false;
				} else if (input_certificate_editor_wysiwyg_id == "") {
					modals.style.display ="block";
					document.getElementById("msg").innerHTML = "Certificate Design Indonesian cannot empty";
					return false;
				} else if (input_certificate_editor_wysiwyg_th == "") {
					modals.style.display ="block";
					document.getElementById("msg").innerHTML = "Certificate Design Thailand cannot empty";
					return false;
				} else {
					$('#submit_add').hide();
					$('#submit_add2').show();
				}

				if (input_certificate_code && input_certificate_title_en && input_certificate_title_id && input_certificate_title_th && input_certificate_editor_wysiwyg_en && input_certificate_editor_wysiwyg_id && input_certificate_editor_wysiwyg_th) {

					//submit the form to server
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

							if (response.code == 'success_message') {
								// mymodalss.style.display = "none";
								modals.style.display = "block";
								document.getElementById("msg").innerHTML = response.messages;

								$('#submit_add').show();
								$('#submit_add2').hide();

								$('#FormDisplayCreate').modal('hide');
								$("[data-dismiss=modal]").trigger({
									type: "click"
								});

								// reset the form
								$("#FormDisplayCreate")[0].reset();
								// reload the datatables
								datatable.ajax.reload(null, false);
								// this function is built in function of datatables;
							} else {
								modals.style.display = "block";
								document.getElementById("msg").innerHTML = response.messages;

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
						},
						// uploadFile()
					});
				}
				return false;
			}); // /submit form for create member
		}); // /add modal
	});


	// function for update data
	function updateCertificate(id = null) {
		if (id) {
			// remove the error 
			$(".form-group").removeClass('has-error').removeClass('has-success');
			$(".text-danger").remove();
			// empty the message div
			$(".messages_update").html("");

			// fetch the member data
			$.ajax({
				url: 'php_action/getDataCertificateById.php',
				type: 'post',
				data: {
					certificate_code: id
				},
				dataType: 'json',
				async: true,

				success: function(response) {
					// document.getElementById("edit_certificate_code").innerHTML = response.master.certificate_code;

					$('#edit_certificate_code').val(response.master.certificate_code);
					$('#edit_certificate_title_en').val(response.master.certificate_title_en);
					$('#edit_certificate_title_id').val(response.master.certificate_title_id);
					$('#edit_certificate_title_th').val(response.master.certificate_title_th);
					
					$('#edit_certificate_editor_wysiwyg_en').summernote('code', response.master.certificate_template_en);
					$('#edit_certificate_editor_wysiwyg_id').summernote('code', response.master.certificate_template_id);
					$('#edit_certificate_editor_wysiwyg_th').summernote('code', response.master.certificate_template_th); 

					// here update data
					$("#FormDisplayUpdate").unbind('submit').bind('submit', function() {
						// remove error messages
						$(".text-danger").remove();

						var form = $(this);

						// initial variable
						var edit_emp_no = $("#edit_emp_no").val();
						var edit_certificate_code = $("#edit_certificate_code").val();
						var edit_certificate_title_en = $("#edit_certificate_title_en").val();
						var edit_certificate_title_id = $("#edit_certificate_title_id").val();
						var edit_certificate_title_th = $("#edit_certificate_title_th").val();
						var edit_certificate_editor_wysiwyg_en = $("#edit_certificate_editor_wysiwyg_en").val();
						var edit_certificate_editor_wysiwyg_id = $("#edit_certificate_editor_wysiwyg_id").val();
						var edit_certificate_editor_wysiwyg_th = $("#edit_certificate_editor_wysiwyg_th").val();

						var regex=/^[a-zA-Z]+$/;

						if (edit_certificate_code == "") {
							modals.style.display ="block";
							document.getElementById("msg").innerHTML = "Certificate Code cannot empty";
							// return false;
						} else if (edit_certificate_title_en == "") {
							modals.style.display ="block";
							document.getElementById("msg").innerHTML = "Certificate Title English cannot empty";
							// return false;
						} else if (edit_certificate_title_id == "") {
							modals.style.display ="block";
							document.getElementById("msg").innerHTML = "Certificate Title Indonesian cannot empty";
							// return false;
						} else if (edit_certificate_title_th == "") {
							modals.style.display ="block";
							document.getElementById("msg").innerHTML = "Certificate Title Thailand cannot empty";
							// return false;
						} else if (edit_certificate_editor_wysiwyg_en == "") {
							modals.style.display ="block";
							document.getElementById("msg").innerHTML = "Certificate Design English cannot empty";
							// return false;
						} else if (edit_certificate_editor_wysiwyg_id == "") {
							modals.style.display ="block";
							document.getElementById("msg").innerHTML = "Certificate Design Indonesian cannot empty";
							// return false;
						} else if (edit_certificate_editor_wysiwyg_th == "") {
							modals.style.display ="block";
							document.getElementById("msg").innerHTML = "Certificate Design Thailand cannot empty";
							// return false;
						} else {
							$('#submit_update').hide();
							$('#submit_update2').show();
						}

						if(edit_certificate_code && edit_certificate_title_en && edit_certificate_title_id && edit_certificate_title_th && edit_certificate_editor_wysiwyg_en && edit_certificate_editor_wysiwyg_id && edit_certificate_editor_wysiwyg_th) {
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
						}
						return false;
					});
				} // /success
			}); // /fetch selected member info
		} else {
			alert("Error : Refresh the page again");
		}
	}

	// function delete data dummy
	function deleteCertificate(id = null) {
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
		url: 'php_action/getDataCertificateById.php',
		type: 'post',
		data: {
			certificate_code: id
		},
		dataType: 'json',
		success:function(response) {

			$("#del_certificate_code").val(response.master.certificate_code);

			// mmeber id 
			$(".FormDisplayDelete").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');

			// here update the member data
			$("#updatedelMemberForm").unbind('submit').bind('submit', function() {
				// remove error messages
				$(".text-danger").remove();

				var form = $(this);

				// validation
				var del_certificate_code = $("#del_certificate_code").val();

				if(del_certificate_code == "") {
					modals.style.display ="block";
					document.getElementById("msg").innerHTML = "Shiftgroup schedule code cannot empty";
				} else {
					$('#submit_delete').hide();
					$('#submit_delete2').show();
				}

				if(del_certificate_code) {
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

<!-- function upload file from text editor wysiwyg -->
<script>
	// function upload file
	function uploadFile(files, editor, welEditable) {
		data = new FormData();
		data.append('file', file);
		$.ajax({
			url: 'php_action/FuncUploadfileFromEditor.php',
			cache: false,
			contentType: false,
			processData: false,
			data: data,
			type: 'POST',
			success: function(url) {
				editor.insertImage(welEditable, url);
			}
			error: function(data) {
				console.log(data);
			}
		});
	}
</script>