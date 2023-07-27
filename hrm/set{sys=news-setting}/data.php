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

<div class="MaximumFrameHeight card-body table-responsive p-0"
	style="width: 100vw;height: 80vh; width: 98%; margin-right: 5px;overflow: scroll;overflow-x: hidden;margin-top: 17px;">
	<div class="col-12 col-fit" style="margin-top: 17px;">
		<table id="datatable" width="100%" border="1" align="left"
			class="table table-bordered table-striped table-hover table-head-fixed">
			<thead>
				<tr>
					<th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No.1</th>
					<th class="fontCustom" style="z-index: 1;">Title</th>
					<th class="fontCustom" style="z-index: 1;">Sub - Title</th>
					<th class="fontCustom" style="z-index: 1;">Status</th>
					<th class="fontCustom" style="z-index: 1;">Headline</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

<!-- data modal add news templates -->
<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="CreateForm">
	<div class="modal-dialog modal-belakang modal-bg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add News</h4>
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
						<?php
						// Date Format: Y/m/dd
						
						?>
						<div class="col-4 name">Title <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on" id="input_title"
									name="input_title" type="Text" value="" size="30"
									maxlength="50" style="text-transform:uppercase;width: 60%;" title="">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">Sub Title <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on" id="input_sub_title"
									name="input_sub_title" type="Text" value="" size="30"
									maxlength="50" style="text-transform:uppercase;width: 60%;" title="">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">SEO Title <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on" id="input_seo_title"
									name="input_seo_title" type="Text" value="" size="30"
									maxlength="50" style="text-transform:uppercase;width: 60%;" title="">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">Headline Active <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="checkbox" name="input_active_headline" id="input_active_headline" value="1">
								<label class="form-check-label" for="input_active_headline">Yes</label>
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
						<div class="col-4 name">Content <span class="required">*</span></div>
						<div class="col-8">
							<textarea id="input_content" name="input_content"></textarea>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">Information <span class="required">*</span></div>
						<div class="col-8">
							<textarea class="input--style-6" id="input_information" name="input_information" style="width: 60%;"></textarea>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4">
							File Thumbnail <font color="red">*</font>
						</div>
						<div class="col-8">
							<div class="input-group">
								<input type="file" name="image_news_thumbnail" id="image_news_thumbnail" class="form-control" />
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

<!-- data modal edit news Templates -->
<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="UpdateForm">
	<div class="modal-dialog modal-belakang modal-bg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Edit News</h4>
				<a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
					<span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
				</a>
			</div>

			<form class="form-horizontal" action="php_action/FuncDataUpdate.php" method="POST" id="FormDisplayUpdate">
				<fieldset id="fset_1">
					<legend>Form Data</legend>

					<div class="messages_create"></div>

					<!--FROM SESSION -->
					<input id="edit_emp_no" name="edit_emp_no" type="hidden" value="<?php echo $username; ?>">
					<input id="edit_id_berita" name="edit_id_berita" type="hidden" value="">
					<!--FROM CONFIGURATION -->
					<input id="inp_token" name="inp_token" type="hidden" value="<?php echo $get_token; ?>">

					<div class="form-row">
						<div class="col-4 name">Title <span class="required">*</span></div>
						<div class="col-8">
							<input class="input--style-6" autocomplete="off" autofocus="on" id="edit_title"
								name="edit_title" type="Text" value="" size="30"
								maxlength="50" style="text-transform:uppercase;width: 60%;" title="">
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">Sub Title <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on" id="edit_sub_title"
									name="edit_sub_title" type="Text" value="" size="30"
									maxlength="50" style="text-transform:uppercase;width: 60%;" title="">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">SEO Title <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on" id="edit_seo_title"
									name="edit_seo_title" type="Text" value="" size="30"
									maxlength="50" style="text-transform:uppercase;width: 60%;" title="">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">Headline Active <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="checkbox" name="edit_active_headline" id="edit_active_headline" value="1">
								<label class="form-check-label" for="edit_active_headline">Yes</label>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">Active Status <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="checkbox" name="edit_active_status" id="edit_active_status" value="1">
								<label class="form-check-label" for="edit_active_status">Yes</label>
							</div>
						</div>
					</div>

					<div class="form-row">
						<div class="col-4 name">Content <span class="required">*</span></div>
						<div class="col-8">
							<textarea id="edit_content" name="edit_content"></textarea>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">Information <span class="required">*</span></div>
						<div class="col-8">
							<textarea class="input--style-6" id="edit_information" name="edit_information" style="width: 60%;"></textarea>
						</div>
					</div>
					<div class="form-row file_news_thumbnail_data">
						<div class="col-4">
							File Thumbnail <font color="red">*</font>
						</div>
						<div class="col-8">
							<div class="input-group">
								<a href="" id="edit_news_thumbnail" target="_blank" download>
									<div id="preview_thumbnail"></div>
								</a>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4">
							Change File Thumbnail <font color="red">*</font>
						</div>
						<div class="col-8">
							<div class="input-group">
								<input type="file" name="image_news_thumbnail" id="image_news_thumbnail" class="form-control" />
							</div>
						</div>
					</div>

				</fieldset>

				<div class="modal-footer">
					<button type="reset" class="btn btn-primary1" data-dismiss="modal" aria-hidden="true" id="close_edit_form_venue submit_update">
						&nbsp;Cancel&nbsp;
					</button>
					<button class="btn btn-warning" type="submit" name="submit_update" id="submit_update">
						Update
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
	$('#edit_content').summernote({
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

			// summernote create form
			$('#input_content').summernote({
				tabsize: 2,
				height: 100,
				spellCheck: true,
			});

			$(".messages_create").html("");

			// submit form
			$("#FormDisplayCreate").unbind('submit').bind('submit', function() {

				$(".text-danger").remove();

				var form = $(this);

				// initial variable
				var inp_emp_no = $("#inp_emp_no").val();
				var input_title = $("#input_title").val();
				var input_sub_title = $("#input_sub_title").val();
				var input_seo_title = $("#input_seo_title").val();
				var input_active_headline = $("#input_active_headline").val();
				var input_active_status = $("#input_active_status").val();
				var input_content = $("#input_content").val();
				var input_information = $("#input_information").val();
				
				var regex=/^[a-zA-Z]+$/;

				if (input_title == "") {
					modals.style.display ="block";
					document.getElementById("msg").innerHTML = "Title cannot empty";
					return false;
				} else if (input_sub_title == "") {
					modals.style.display ="block";
					document.getElementById("msg").innerHTML = "Sub Title cannot empty";
					return false;
				} else if (input_seo_title == "") {
					modals.style.display ="block";
					document.getElementById("msg").innerHTML = "Headline Title cannot empty";
					return false;
				} else if (input_content == "") {
					modals.style.display ="block";
					document.getElementById("msg").innerHTML = "Content cannot empty";
					return false;
				} else if (input_information == "") {
					modals.style.display ="block";
					document.getElementById("msg").innerHTML = "Information cannot empty";
					return false;
				} else {
					$('#submit_add').hide();
					$('#submit_add2').show();
				}

				if (input_title && input_sub_title && input_seo_title && input_content && input_information) {

					//submit the form to server
					$.ajax({
						url: form.attr('action'),
						type: form.attr('method'),
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

	// function update news
	function UpdateNews(request) {
		// alert(request)
		$('#FormDisplayUpdate')[0].reset();
		$(".form-group").removeClass('has-error').removeClass('has-success');
			$(".text-danger").remove();
			// empty the message div
			$(".messages_update").html("");

		$.ajax({
			url: 'php_action/FuncGetDataById',
			type: 'post',
			data: {
				request: request
			},
			dataType: 'json',
			async: true,
			success: function(response) {
				// alert(response[0].judul)
				$('#edit_id_berita').val(response[0].id_berita)
				$('#edit_title').val(response[0].judul)
				$("#edit_title").prop("readonly",true);
				$('#edit_sub_title').val(response[0].sub_judul)
				$('#edit_seo_title').val(response[0].judul_seo)
				
				let is_active_headline = $('#edit_active_headline')
				response[0].headline == 'Y' ? is_active_headline.prop("checked",true) : is_active_headline.prop("checked",false)
				let is_active_status = $('#edit_active_status')
				response[0].aktif == 'Y' ? is_active_status.prop("checked",true) : is_active_status.prop("checked",false)

				$('#edit_content').summernote('code', response[0].isi_berita)
				$('#edit_information').val(response[0].keterangan_gambar)

				let data_thumbnail = response[0].gambar
				if (data_thumbnail == "") {
					$('.file_news_thumbnail_data').hide()
				}
				preview_thumbnail
				$('#preview_thumbnail').append(`<img id="data_preview_thumbnail" class="img-fluid img-thumbnail" src="" alt="file attachment" width="100" height="140">`)
				$('#edit_news_thumbnail').attr("href", 'hrstudio.presfst/'+data_thumbnail)
				$('#data_preview_thumbnail').attr("src", 'hrstudio.presfst/'+data_thumbnail)

				$("#FormDisplayUpdate").unbind('submit').bind('submit', function() {
					// remove error messages
					$(".text-danger").remove();
					var form = $(this);

					// initial variable
					var edit_emp_no = $("#edit_emp_no").val();
					var edit_id_berita = $("#edit_id_berita").val();
					var edit_title = $("#edit_title").val();
					var edit_sub_title = $("#edit_sub_title").val();
					var edit_seo_title = $("#edit_seo_title").val();
					var edit_content = $("#edit_content").summernote('code');
					var edit_information = $("#edit_information").val();

					var regex=/^[a-zA-Z]+$/;

					if (edit_title == "") {
						modals.style.display ="block";
						document.getElementById("msg").innerHTML = "Title cannot empty";
						return false;
					} else if (edit_sub_title == "") {
						modals.style.display ="block";
						document.getElementById("msg").innerHTML = "Sub Title cannot empty";
						return false;
					} else if (edit_seo_title == "") {
						modals.style.display ="block";
						document.getElementById("msg").innerHTML = "Headline Title cannot empty";
						return false;
					} else if (edit_content == "") {
						modals.style.display ="block";
						document.getElementById("msg").innerHTML = "Content cannot empty";
						return false;
					} else if (edit_information == "") {
						modals.style.display ="block";
						document.getElementById("msg").innerHTML = "Information cannot empty";
						return false;
					} else {
						$('#submit_update').hide();
						$('#submit_update2').show();

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
				})
			}
		})
	}

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