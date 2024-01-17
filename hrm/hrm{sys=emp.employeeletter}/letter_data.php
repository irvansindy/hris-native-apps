<script src="vendor/modal/bootstrap.min.js"></script>

<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>

<!-- cdn select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- end cdn select2 -->

<?php
$username = $_GET['emp_no'];
$search_en             = '';
$search_ea             = '';
// jika nip dan nama terisi
if (!empty($_POST['search_en'])) {
	$search_en             = $_POST['search_en'];
	// AgusPrass 04/03/2021 menambahkan kondisi saat memfilter
}
if (!empty($_POST['search_ea'])) {
	$search_ea                = $_POST['search_ea'];
}
?>


<?php
if (!empty($_POST['cari'])) {
	$filter = $_POST['cari'];
	$filterprint = 'Filter: Ticketing Number Is ' . $_POST['cari'];
} else {
	$filter = '';
	$filterprint = '';
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
							<div class="col-4 name">Employee No</div>
							<div class="col-sm-8">
								<div class="input-group">

									<input class="input--style-6" autocomplete="off" autofocus="on" id="search_en"
										name="search_en" type="Text" value="" onfocus="hlentry(this)" size="30"
										maxlength="50" validate="NotNull:Invalid Form Entry"
										onchange="formodified(this);" title="">
								</div>
							</div>
						</div>

						<div class="form-row">
							<div class="col-4 name">Employee Name</div>
							<div class="col-sm-8">
								<div class="input-group">

									<input class="input--style-6" autocomplete="off" autofocus="on" name="search_ea"
										id="search_ea" type="Text" value="" onfocus="hlentry(this)" size="30"
										maxlength="50" validate="NotNull:Invalid Form Entry"
										onchange="formodified(this);" title="">
								</div>
							</div>
						</div>

					</fieldset>

					<button class="btn btn-warning" type="submit"
						style="width: 100%;border-radius: 17px;font-weight: bold;letter-spacing: 1px;font-size: 12px;">
						Filter
					</button>
				</form>
			</div>

		</div><!-- modal-content -->
	</div><!-- modal-dialog -->
</div><!-- modal -->





<div class="MaximumFrameHeight card-body table-responsive p-0"
	style="width: 50vw;height: 80vh; width: 70%; margin-right: 5px;overflow: scroll;overflow-x: hidden;margin-top: 17px;">
	<div class="col-12 col-fit" style="margin-top: 17px;">
		<table id="datatable" width="100%" border="1" align="left"
			class="table table-bordered table-striped table-hover table-head-fixed">
			<thead>
				<tr>
					<th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No </th>
					<th class="fontCustom" style="z-index: 1;">Employee Name</th>
					<th class="fontCustom" style="z-index: 1;">Letter Number</th>
					<th class="fontCustom" style="z-index: 1;">Reference Date</th>
					<th class="fontCustom" style="z-index: 1;">Letter Content</th>
					<th class="fontCustom" style="z-index: 1;">Signed By</th>
					<th class="fontCustom" style="z-index: 1;">Action</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

<!-- create data modal -->
<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="CreateForm">
	<div class="modal-dialog modal-belakang modal-bg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add Decree</h4>
				<a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close"
					style="margin-top: -15px;">
					<span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
				</a>
			</div>

			<!-- <form class="form-horizontal" action="php_action/FuncDataUpdate.php" method="POST" id="updateMemberForm"> -->
			<form class="form-horizontal" action="" method="POST" id="form_create_data">

				<div class="card-body table-responsive p-0"
					style="width: 100vw;height: auto%; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

					<fieldset id="fset_1">
						<legend>General</legend>

						<div class="messages_update"></div>

						<input id="input_emp_no" name="input_emp_no" type="hidden" value="<?php echo $username; ?>">
						<input id="input_emp_id" name="input_emp_id" type="hidden" value="">
						<input id="input_seq_number" name="input_seq_number" type="hidden" value="">

						<!--FROM SESSION -->
						<input id="sel_token" name="sel_token" type="hidden" value="<?php echo $get_token; ?>">
						<!--FROM CONFIGURATION -->

						<div class="form-row">
							<div class="col-4 name">Letter Type <span class="required">*</span></div>
							<div class="col-sm-8">
								<div class="input-group">
									<select class="input--style-6 letter_type" style="width: 70%;height: 30px;"
										name="input_letter_type" id="input_letter_type" required>
										<option value="">--Select Option--</option>
										<?php
												$sql = mysqli_query($connect, "SELECT
												seq_id,
												template_code,
												pattern_group
											FROM tsfmlettertemplate");
												while ($row = mysqli_fetch_array($sql)) {
													echo '<option value="' . $row['pattern_group'] . '">' . $row['template_code'] . '</option>';
												}
											?>
									</select>
								</div>
							</div>
						</div>
						<div id="form_data_decree">
							<div class="form-row">
								<div class="col-4 name">Decree Number <span class="required">*</span></div>
								<div class="col-sm-8">
									<div class="input-group">
										<input class="input--style-6" id="input_decree_number" placeholder=""
											name="input_decree_number" type="Text" value="" style="width: 70%;"
											readonly="true">
									</div>
								</div>
							</div>
							<div class="form-row">
								<div class="col-4 name">Letter Date <span class="required">*</span></div>
								<div class="col-sm-8">
									<div class="input-group">
										<input type="text" id="input_letter_date" name="input_letter_date"
											class="input--style-6" placeholder="" style="background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
											background-size: 17px;
											background-position:right;   
											background-repeat:no-repeat; 
											padding-right:10px;
											width: 70%;
											" autocomplete="off" required />
									</div>
								</div>
							</div>
							<div class="form-row">
								<div class="col-4 name">Effective Date <span class="required">*</span></div>
								<div class="col-sm-8">
									<div class="input-group">
										<input type="text" id="input_effective_date" name="input_effective_date"
											class="input--style-6" placeholder="" style="background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
											background-size: 17px;
											background-position:right;   
											background-repeat:no-repeat; 
											padding-right:10px;
											width: 70%;
											" autocomplete="off" required />
									</div>
								</div>
							</div>
							<div class="form-row">
								<div class="col-4 name">Letter Reference <span class="required">*</span></div>
								<div class="col-sm-8">
									<div class="input-group">
										<select class="input--style-6 letter_reference" style="width: 70%;height: 30px;"
											name="input_letter_reference" id="input_letter_reference">
											<option value="">--Select Option--</option>
											<?php
												$sql = mysqli_query($connect, "SELECT
												history_no,
												emp_id,
												careertransition_code,
												careertranstype
											FROM hrmemploymenthistory
												WHERE emp_id = '".$_GET['emp_id']."'");
												while ($row = mysqli_fetch_array($sql)) {
													echo '<option value="' . $row['history_no'] . '">' . $row['history_no'] . '</option>';
												}
											?>
										</select>
									</div>
								</div>
							</div>
						</div>
					</fieldset>
					<div class="modal-footer-sdk">
						<button type="button" class="btn-sdk btn-primary-center-only rounded-pill" name="submit_decree"
							id="submit_decree" data-type_submit="draft"
							style="background-color: #337ab7 !important; color: #fff !important;">
							<p class="text-center">
								&nbsp;Save &nbsp;
							</p>
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- detail data modal -->
<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="DetailDecree">
	<div class="modal-dialog modal-belakang modal-bg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Detail Decree</h4>
				<a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close"
					style="margin-top: -15px;">
					<span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
				</a>
			</div>

			<!-- <form class="form-horizontal" action="php_action/FuncDataUpdate.php" method="POST" id="updateMemberForm"> -->
			<form class="form-horizontal" action="" method="POST" id="form_update_data">

				<div class="card-body table-responsive p-0"
					style="width: 100vw;height: auto%; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

					<fieldset id="fset_1">
						<legend>General</legend>

						<div class="messages_update"></div>

						<input id="detail_emp_no" name="detail_emp_no" type="hidden" value="<?php echo $username; ?>">
						<input id="detail_emp_id" name="detail_emp_id" type="hidden" value="">
						<input id="detail_seq_number" name="detail_seq_number" type="hidden" value="">

						<!--FROM SESSION -->
						<input id="sel_token" name="sel_token" type="hidden" value="<?php echo $get_token; ?>">
						<!--FROM CONFIGURATION -->
						<div class="form-row">
							<div class="col-4 name">Decree Number <span class="required">*</span></div>
							<div class="col-sm-8">
								<div class="input-group">
									<input class="input--style-6" id="detail_decree_number" placeholder=""
										name="detail_decree_number" type="Text" value="" style="width: 70%;"
										readonly="true">
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-4 name">Letter Type <span class="required">*</span></div>
							<div class="col-sm-8">
								<div class="input-group">
									<select class="input--style-6 letter_type" style="width: 70%;height: 30px;" name="detail_letter_type" id="detail_letter_type" required></select>
									<input type="hidden" class="form-control" id="value_detail_letter_type">
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-4 name">Letter Date <span class="required">*</span></div>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="detail_letter_date" name="detail_letter_date"
										class="input--style-6" placeholder="" style="background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
											background-size: 17px;
											background-position:right;   
											background-repeat:no-repeat; 
											padding-right:10px;
											width: 70%;
											" autocomplete="off" required />
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-4 name">Effective Date <span class="required">*</span></div>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="text" id="detail_effective_date" name="detail_effective_date"
										class="input--style-6" placeholder="" style="background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
											background-size: 17px;
											background-position:right;   
											background-repeat:no-repeat; 
											padding-right:10px;
											width: 70%;
											" autocomplete="off" required />
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-4 name">Letter Reference <span class="required">*</span></div>
							<div class="col-sm-8">
								<div class="input-group">
									<select class="input--style-6 letter_reference" style="width: 70%;height: 30px;" name="detail_letter_reference" id="detail_letter_reference">
										<!-- <option value="">--Select Option--</option> -->
									</select>
									<input type="hidden" class="form-control" id="value_detail_letter_reference">
								</div>
							</div>
						</div>
					</fieldset>
					<div class="modal-footer-sdk">
						<button type="button" class="btn-sdk btn-primary-center-only rounded-pill" name="update_decree"
							id="update_decree" data-type_submit="draft"
							style="background-color: #337ab7 !important; color: #fff !important;">
							<p class="text-center">
								&nbsp;Update &nbsp;
							</p>
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>


<script src="../../asset/vendor/datatable/datatables.min.js"></script>

<script>
	$(document).on('click', '#create_data_decree', function (e) {
		e.preventDefault()
		let data_emp_id = $(this).data('emp_id')
		$('#form_create_data')[0].reset()
		$('#input_emp_id').val(data_emp_id)
		$('#form_data_decree').hide()
	})

	$(document).on('change', '#input_letter_type', function () {
		let val_input_letter_type = $('#input_letter_type').val()
		// alert(val_input_letter_type)
		$.ajax({
			url: 'action/generateNumber.php',
			type: 'GET',
			data: {
				pattern_group: val_input_letter_type
			},
			async: true,
			success: function(res) {
				if (val_input_letter_type == '') {
					$('#form_data_decree').hide()
					$('#input_decree_number').val('')
					$('#input_letter_date').val('')
					$('#input_effective_date').val('')
					$('#input_letter_reference').val('')
				} else {
					$('#form_data_decree').show()
					$('#input_seq_number').val(res[1])
					$('#input_decree_number').val(res[0])
				}

			}
		})

	})

	$('#input_letter_date').bootstrapMaterialDatePicker({
		time: false,
		clearButton: true
	});

	$('#input_effective_date').bootstrapMaterialDatePicker({
		time: false,
		clearButton: true
	});

	$('#detail_letter_date').bootstrapMaterialDatePicker({
		time: false,
		clearButton: true
	});

	$('#detail_effective_date').bootstrapMaterialDatePicker({
		time: false,
		clearButton: true
	});

	$('#input_letter_type').select2({
		dropdownParent: $('#CreateForm')
	});
	
	$('#input_letter_reference').select2({
		dropdownParent: $('#CreateForm')
	})

	$('#detail_letter_type').select2({
		dropdownParent: $('#DetailDecree')
	});

	$('#detail_letter_reference').select2({
		dropdownParent: $('#DetailDecree')
	});

	$('#submit_decree').on('click', function (e) {
		e.preventDefault()

		let input_decree_number = $('#input_decree_number').val()
		let input_letter_type = $('#input_letter_type').val()
		let input_letter_date = $('#input_letter_date').val()
		let input_effective_date = $('#input_effective_date').val()

		if (input_decree_number == '') {
			mymodalss.style.display = "none";
			modals.style.display = "block";
			document.getElementById("msg").innerHTML = "Decree number cannot empty";
			return false;
		}
		if (input_letter_type == '') {
			mymodalss.style.display = "none";
			modals.style.display = "block";
			document.getElementById("msg").innerHTML = "Letter type cannot empty";
			return false;
		}
		if (input_letter_date == '') {
			mymodalss.style.display = "none";
			modals.style.display = "block";
			document.getElementById("msg").innerHTML = "Letter date cannot empty";
			return false;
		}
		if (input_effective_date == '') {
			mymodalss.style.display = "none";
			modals.style.display = "block";
			document.getElementById("msg").innerHTML = "Effective date cannot empty";
			return false;
		}

		$.ajax({
			url: 'action/createDecree.php',
			type: 'POST',
			data: new FormData($('#form_create_data')[0]),
			processData: false,
			contentType: false,
			dataType: 'json',
			async: true,
			success: function (response) {
				$(".form-group").removeClass('has-error').removeClass('has-success');
				mymodalss.style.display = "none";
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = response.messages;

				$('#form_create_data')[0].reset()
				$('#CreateForm').modal('toggle');
				location.reload();
				datatable.ajax.reload(null, false);
			},
			error: function (xhr, status, error) {
				var errorMessage = JSON.parse(xhr.responseText);
				mymodalss.style.display = "none";
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = errorMessage.messages;
			}
		})
	})

	$(document).on('click', '.list_detail_decree', function (e) {
		e.preventDefault()
		let detail_number_decree = $(this).data('number_decree')
		let detail_emp_id = $(this).data('emp_id')
		$.ajax({
			url: 'action/getDataByid.php',
			type: 'GET',
			data: {
				letter_no: detail_number_decree,
				emp_id: detail_emp_id
			},
			dataType: 'json',
			async: true,
			success: function (res) {
				$('#form_update_data')[0].reset()
				$('#detail_emp_id').val(res.decree.letter_receiver)
				$('#detail_decree_number').val(res.decree.letter_no)

				$('#value_detail_letter_type').val(res.decree.template_code)
				$('#detail_letter_type').empty()
				$('#detail_letter_type').append('<option value="'+res.decree.template_code+'">'+res.decree.template_code+'</option>')
				
				$('#detail_letter_date').val(res.decree.letter_date)
				$('#detail_effective_date').val(res.decree.effective_date)

				if(res.decree.letter_reference == '') {
					$('#value_detail_letter_reference').val('')
					$('#detail_letter_reference').empty()
					$('#detail_letter_reference').append('<option value="">--Select Option--</option>')
					$.each(res.ref, function(i, data) {
						$('#detail_letter_reference').append('<option value="'+data.history_no+'">'+data.history_no+'</option>')
					})
				} else {
					$('#value_detail_letter_reference').val(res.decree.letter_reference)
					$('#detail_letter_reference').empty()
					$.each(res.ref, function(i, data) {
						$('#detail_letter_reference').append('<option value="'+data.history_no+'">'+data.history_no+'</option>')
					})
				}
				// $('#detail_letter_reference').val(res.letter_reference)
			}
		})
	})

	$('#update_decree').on('click', function (e) {
		let detail_decree_number = $('#detail_decree_number').val()
		let detail_letter_type = $('#detail_letter_type').val()
		let detail_letter_date = $('#detail_letter_date').val()
		let detail_effective_date = $('#detail_letter_date').val()

		if (input_decree_number == '') {
			mymodalss.style.display = "none";
			modals.style.display = "block";
			document.getElementById("msg").innerHTML = "Decree number cannot empty";
			return false;
		}
		if (detail_letter_type == '') {
			mymodalss.style.display = "none";
			modals.style.display = "block";
			document.getElementById("msg").innerHTML = "Letter type cannot empty";
			return false;
		}
		if (detail_letter_date == '') {
			mymodalss.style.display = "none";
			modals.style.display = "block";
			document.getElementById("msg").innerHTML = "Letter date cannot empty";
			return false;
		}
		if (detail_effective_date == '') {
			mymodalss.style.display = "none";
			modals.style.display = "block";
			document.getElementById("msg").innerHTML = "Effective date cannot empty";
			return false;
		}

		$.ajax({
			url: 'action/updateDecree.php',
			type: 'POST',
			data: new FormData($('#form_update_data')[0]),
			processData: false,
			contentType: false,
			dataType: 'json',
			async: true,
			success: function (response) {
				$(".form-group").removeClass('has-error').removeClass('has-success');
				mymodalss.style.display = "none";
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = response.messages;

				$('#form_create_data')[0].reset()
				$('#CreateForm').modal('toggle');
				location.reload();
				datatable.ajax.reload(null, false);
			},
			error: function (xhr, status, error) {
				var errorMessage = JSON.parse(xhr.responseText);
				mymodalss.style.display = "none";
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = errorMessage.messages;
			}
		})
	})
	$('#input_letter_reference').select2({
		dropdownParent: $('#CreateForm')
	});
</script>

<script>

</script>

<script type="text/javascript" language="javascript">
	$(document).ready(function () {

		// Load data
		dataTable = $("#datatable").DataTable({

			processing: true,
			lengthMenu: [
				[200, 10, 25, 50, -1],
				[200, 10, 25, 50, 'All Records'],
			],
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
			columnDefs: [{
				orderable: false,
				targets: 0
			}],
			destroy: true,
			"ajax": "ajax/data_letter.php?username=<?php echo $username ?>"
		});
		//    Load data

		// Refresh Page
		$("#refresh").click(function (e) {
			dataTable.ajax.reload();

			setTimeout(function () {
				mymodalss.style.display = "none";
				document.getElementById("msg").innerHTML = "Data refreshed";
				return false;
			}, 2000);

			mymodalss.style.display = "block";
			document.getElementById("msg").innerHTML = "Data refreshed";
			return false;

		});
		// Refresh Page

		//    Edit
		$(document).on('click', '#modal_view_letter', function () {

			// Loader
			mymodalss.style.display = "block";
			document.getElementById("msg").innerHTML = "Data refreshed";
			// Loader

			$('#title_modal').html('Edit Employee Letter');

			var nc = $(this).attr('id1');

			// alert(nc);  
			$.ajax({
				url: "ajax/edit_letter.php",
				type: "POST",
				data: {
					nc: nc,
				},
				success: function (ajaxData) {
					$("#yanampilmodal").html(ajaxData);


					// Loader
					mymodalss.style.display = "none";
					document.getElementById("msg").innerHTML = "Data refreshed";
					return false;
					// Loader
				}
			});

		});

		$(document).on('click', '#modal_view_print', function () {

			// Loader
			mymodalss.style.display = "block";
			document.getElementById("msg").innerHTML = "Data refreshed";
			// Loader

			$('#title_preview_print').html('Preview Employee Letter');

			var nc = $(this).attr('id1');

			// alert(nc);  
			$.ajax({
				url: "ajax/edit_print.php",
				type: "POST",
				data: {
					nc: nc,
				},
				success: function (ajaxData) {
					$("#tampil_view_print").html(ajaxData);


					// Loader
					mymodalss.style.display = "none";
					document.getElementById("msg").innerHTML = "Data refreshed";
					return false;
					// Loader
				}
			});

		});

		// Save Edit
		$(document).on('click', '#edit_letter', function () {

			var letter_no = $(this).attr('id1');
			var signed = $('#signed_edit').attr('id1');
			var refdate = $('#refdate_edit').val();

			if (signed == '') {
				alert('Signed By is required!');
				return;
			}
			if (refdate == '') {
				alert('Reference date is required!');
				return;
			}

			let formData = new FormData();
			formData.append('letter_no', letter_no);
			formData.append('signed', signed);
			formData.append('refdate', refdate);

			$.ajax({
				type: 'POST',
				url: "ajax/saveedit.php",
				data: formData,
				cache: false,
				processData: false,
				contentType: false,
				success: function (msg) {

					dataTable.ajax.reload();

					modals.style.display = "block";
					mymodalss.style.display = "none";
					$('#msg').html(msg);

					$('#modal-view-letter').modal('hide');
					$("[data-dismiss=modal]").trigger({
						type: "click"
					});


				}

			});

		});

		// Delete
		$(document).on('click', '#delete_letter', function () {

			var id = $(this).attr('id1');

			let formData = new FormData();
			formData.append('id', id);

			$.ajax({
				type: 'POST',
				url: "ajax/deleteletter.php",
				data: formData,
				cache: false,
				processData: false,
				contentType: false,
				success: function (msg) {

					dataTable.ajax.reload();

					modals.style.display = "block";
					mymodalss.style.display = "none";
					$('#msg').html(msg);

					$('#modal-view-letter').modal('hide');
					$("[data-dismiss=modal]").trigger({
						type: "click"
					});


				}

			});

		});

		//    Add
		$(document).on('click', '#modal_tambah', function () {

			// Loader
			mymodalss.style.display = "block";
			document.getElementById("msg").innerHTML = "Data refreshed";
			// Loader

			$('#title_tambah').html('Add Employee Letter');

			var id = '<?php echo $username ?>';

			// alert(nc);  
			$.ajax({
				url: "ajax/add_letter.php",
				type: "POST",
				data: {
					id: id,
				},
				success: function (ajaxData) {
					$("#tampil_tambah").html(ajaxData);


					// Loader
					mymodalss.style.display = "none";
					document.getElementById("msg").innerHTML = "Data refreshed";
					return false;
					// Loader
				}
			});

		});

		// Save Edit
		$(document).on('click', '#add_letter', function () {

			var id = $(this).attr('id1');
			var signed = $('#signed').attr('id1');
			var letter_template = $('#letter_template').val();
			var refdate = $('#refdate').val();

			if (signed == '') {
				alert('Signed by is required!');
				return;
			}
			if (letter_template == '') {
				alert('Letter template is required!');
				return;
			}
			if (refdate == '') {
				alert('Reference date is required!');
				return;
			}

			let formData = new FormData();
			formData.append('id', id);
			formData.append('signed', signed);
			formData.append('letter_template', letter_template);
			formData.append('refdate', refdate);

			$.ajax({
				type: 'POST',
				url: "ajax/saveadd.php",
				data: formData,
				cache: false,
				processData: false,
				contentType: false,
				success: function (msg) {

					dataTable.ajax.reload();

					modals.style.display = "block";
					mymodalss.style.display = "none";
					$('#msg').html(msg);

					$('#modal-default').modal('hide');
					$("[data-dismiss=modal]").trigger({
						type: "click"
					});


				}

			});

		});





		function previewgh(id = null) {
			mymodalss.style.display = "block";

			if (id) {
				alert("asdsa");
			} else {
				alert("Error : Refresh the page again");
			}
		}




	});


	$(document).on('click', '#submit_preview', function () {

		var id1 = $(this).attr('id1');

		var popupWinWidth = 900;
		var popupWinHeight = 600;

		var left = (screen.width - popupWinWidth) / 2;
		var top = (screen.height - popupWinHeight) / 4;

		window.open('preview?letter=' + id1, 'popupwindow', 'menubar=no, location=no, resizable=yes, width=' +
			popupWinWidth +
			', height=' + popupWinHeight + ', top=' +
			top + ', left=' + left);
		mymodalss.style.display = "none";
		return false;


	}); // /submit form for create member
</script>