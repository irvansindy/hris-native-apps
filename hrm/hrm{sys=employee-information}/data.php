<!-- Modal search -->
<div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2"
	data-backdrop="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">

				<a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close"
					style="margin-top: -15px;">
					<span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
				</a>
				<form class="form-horizontal" method="POST" id="searching_form"
					onkeydown="return event.key != 'Enter';">
					<fieldset id="fset_1" style="margin-top: 25px;border-radius: 5px;border: 1px solid #e4e8ea;">
						<legend>Searching</legend>
						<div class="form-row">
							<div class="col-4 name">Active Status </div>
							<div class="col-sm-8">
								<div class="input-group">

									<select class="form-control input--style-6" autocomplete="off" autofocus="on"
										id="src_active_status" name="src_active_status" style="height: 33px;">

										<option value="1">Active</option>
										<option value="0">Inactive</option>

									</select>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-4 name">Worklocation</div>
							<div class="col-sm-8">
								<div class="input-group">

									<select class="form-control input--style-6" autocomplete="off" autofocus="on"
										id="src_worklocation" name="src_worklocation" style="height: 33px;">

										<option value="" selected> All</option>
										<?php
                                                                      $sql = mysqli_query($connect, "SELECT * FROM teomworklocation");
                                                                      while ($data = mysqli_fetch_array($sql)) {
                                                                      ?>
										<option value="<?= $data['worklocation_code'] ?>">
											<?= $data['worklocation_name'] ?></option>
										<?php
                                                                      }
                                                                      ?>
									</select>
								</div>
							</div>
						</div>
					</fieldset>
					<button type="submit" name="submit" data-dismiss="modal" data-dismiss="modal"
						class="btn btn-warning button_bot" id="apply--button" style="color: white;font-size: 11px;"
						onclick="SubmitFilter(`post`)">
						<i class="fas fa-search"></i> &nbsp;&nbsp;Apply Filter
					</button>
				</form>
			</div>

		</div><!-- modal-content -->
	</div><!-- modal-dialog -->
</div><!-- modal search -->


<!-- MAIN DATATABLE SERVERSIDE CSS -->
<!-- MAIN DATATABLE SERVERSIDE CSS -->
<script type="text/javascript" src="../../asset/sdk_datatables_core/gt_dist/jQuery-2.1.4.min.js"></script>
<script type="text/javascript"
	src="../../asset/sdk_datatables_core/datatables/bedanihbuatjson/bootstrap/js/bootstrap.min.js"></script>
<!-- MAIN DATATABLE SERVERSIDE CSS -->
<!-- MAIN DATATABLE SERVERSIDE CSS -->


<!-- font awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>

<?php
//OBJECT ORIENTED STYLE
$query = "SELECT code_pattern FROM tclmdocnumber WHERE code_type = 'EMP_NO'";
$result = $connect->query($query);
$row = $result->fetch_array(MYSQLI_ASSOC);
$arr_0 = $row["code_pattern"];

//OBJECT ORIENTED STYLE
?>

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

		$('#inp_pdtype_starttime').bootstrapMaterialDatePicker({
			date: false,
			format: 'HH:mm'
		});

		$('#inp_pdtype_endtime').bootstrapMaterialDatePicker({
			date: false,
			format: 'HH:mm'
		});

		$('#inp_birthdate').bootstrapMaterialDatePicker({
			time: false,
			clearButton: true
		});

		$('#inp_start_date').bootstrapMaterialDatePicker({
			time: false,
			clearButton: true
		});

		$('#inp_joindate').bootstrapMaterialDatePicker({
			time: false,
			clearButton: true
		});

		$('#sel_joindate').bootstrapMaterialDatePicker({
			time: false,
			clearButton: true
		});
	});
</script>

<!-- isi JSON -->
<script type="text/javascript">
	// global the manage memeber table 
	$(document).ready(function () {
		datatable = $("#datatable").DataTable({

			processing: true,
			lengthMenu: [
				[200, 10, 25, 50, -1],
				[200, 10, 25, 50, 'All Records'],
			],
			searching: true,
			paging: true,
			ordering: true,
			pagingType: "simple",
			bPaginate: true,
			bLengthChange: true,
			bFilter: true,
			bInfo: true,
			bAutoWidth: true,
			language: {
				"processing": "Please wait..",
			},
			columnDefs: [{
				orderable: false,
				targets: 5
			}],
			destroy: true,
			"ajax": "php_action/FuncDataRead.php?username=<?php echo $username; ?>&src_active_status=1"
		});
	});

	$('#apply--button').click(function (e) {

		var src_active_status = $("#src_active_status").val();
		var src_worklocation = $("#src_worklocation").val();

		RefreshPage();

		$(document).ready(function () {
			datatable = $("#datatable").DataTable({

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
				bLengthChange: true,
				bFilter: true,
				bInfo: true,
				bAutoWidth: true,
				language: {
					"processing": "Please wait..",
				},
				destroy: true,
				"ajax": "php_action/FuncDataRead.php?username=<?php echo $username; ?>"
			});
		});
	});
</script>

<!-- isi JSON -->
<script type="text/javascript">
	$(document).ready(function () {
		datatable_family = $("#datatable_family").DataTable({

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
			columnDefs: [{
				orderable: false,
				targets: 0
			}],
			destroy: true,
			"ajax": "php_action/FuncDataReadFamily.php<?php echo $frameworks; ?>"
		});
	});

	$(document).ready(function () {
		datatable_position = $("#datatable_position").DataTable({

			processing: true,
			searching: true,
			paging: true,
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
			"ajax": "php_action/FuncDataReadPosition.php"
		});
	});
</script>




<style>
	body {
		font-family: Arial;
	}

	/* Style the tab */
	.tab {
		overflow: hidden;
		border: 1px solid #f5f5f5;
		border-bottom-color: rgb(245, 245, 245);
		border-bottom-style: solid;
		border-bottom-width: 1px;
		background-color: #f5f5f5;
		border-bottom: 1px solid #ccc;


	}

	/* Style the buttons inside the tab */
	.tab a {
		background-color: inherit;
		float: left;
		border: none;
		outline: none;
		cursor: pointer;
		padding: 6px 16px;
		transition: 0.3s;
		font-size: 12px;
		border-bottom: 3px solid #f5f5f5;
		border-top-right-radius: 5px;
		border-top-left-radius: 5px;
		border-right: 1px solid #a0a0a0;
		border-left: 1px solid #a0a0a0;
		border-top: 1px solid #cac6c6;
		height: 35px;
		margin-right: 1px;
	}

	/* Change background color of buttons on hover */
	.tab a:hover {
		background-color: #f5f5f5;
		border-bottom: 3px solid #e8eaec;
	}

	/* Create an active/current tablink class */
	.tab a.active {
		background-color: #f5f5f5;
		border-bottom: 3px solid #1890ff;
		border-top-right-radius: 5px;
		border-top-left-radius: 5px;
		border-right: 1px solid #a0a0a0;
		border-left: 1px solid #a0a0a0;
		border-top: 1px solid #cac6c6;
	}

	/* Style the tab content */
	.tabcontent {
		display: none;
		padding: 6px 12px;
		border: 1px solid #ccc;
		border-top: none;
	}
</style>

<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>



<a data-toggle="modal" data-target="#CreateForm" id="CreateButtonFloating" data-keyboard="false" data-backdrop="static"
	class="floating" target="_blank" style="color: white;color: white;cursor: pointer;">
	<i class="fa fa-plus fab-icon" aria-hidden="true"></i>
</a>

<div class="MaximumFrameHeight card-body table-responsive p-0" style="width: 100vw; width: 98%; margin-right: 5px;overflow: scroll;overflow-x: hidden;margin-top: 17px;" id="section_list_data">
	<div class="col-12 col-fit" style="margin-top: 17px;">
		<table id="datatable" width="100%" border="1" align="left"
			class="table table-bordered table-striped table-hover table-head-fixed">
			<thead>
				<tr>
					<th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No.</th>
					<th class="fontCustom" style="z-index: 1;">Request No.</th>
					<th class="fontCustom" style="z-index: 1;">Employee No.</th>
					<th class="fontCustom" style="z-index: 1;">Employee Name</th>
					<th class="fontCustom" style="z-index: 1;">Create Date</th>
					<th class="fontCustom" style="z-index: 1;">Status</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

<!-- section add data -->
<div class="container-fluid" id="section_create_data">
	<form class="form-horizontal" action="php_action/FuncDataCreate.php<?php echo $getPackage; ?>" method="POST" id="FormDisplayCreate">

		<fieldset id="fset_1">
			<legend>Detail Information</legend>

			<input id="inp_emp_no" name="inp_emp_no" type="hidden" value="<?php echo $username; ?>">
			<input id="inp_emp_id" name="inp_emp_id" type="hidden" value="">
			<!--FROM SESSION -->

			<div class="form-row">
				<div class="col-sm-2 name">Full Name <span class="required">*</span></div>
				<div class="col-sm-4 name">
					<div class="input-group">
						<input class="input--style-6" autocomplete="off" autofocus="on" id="inp_full_name"
							name="inp_full_name" type="text">
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">NIP <span class="required">*</span></div>
				<div class="col-sm-4 name">
					<div class="input-group">
						<input class="input--style-6" autocomplete="off" autofocus="on" id="inp_nip"
							name="inp_nip" type="text" value onkeypress="return (event.charCode !=8 && event.charCode ==0 || ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57)))">
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">Birth Place <span class="required">*</span></div>
				<div class="col-sm-4 name">
					<div class="input-group">
						<input class="input--style-6" autocomplete="off" autofocus="on" id="inp_birth_place"
							name="inp_birth_place" type="text" value>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">Birthdate <span class="required">*</span></div>
				<div class="col-sm-4">
					<div class="input-group">
						<input class="input--style-6" type="Text" id="inp_birthdate" name="inp_birthdate"
							value="" autocomplete="off" autofocus="on" size="30" maxlength="5" style="background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
							background-size: 17px;
							background-position:right;   
							background-repeat:no-repeat; 
							padding-right:10px;  
							">
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">NIK <span class="required">*</span></div>
				<div class="col-sm-4 name">
					<div class="input-group">
						<input class="input--style-6" autocomplete="off" autofocus="on" id="inp_nik"
							name="inp_nik" type="text" value onkeypress="return (event.charCode !=8 && event.charCode ==0 || ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57)))">
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">KK <span class="required">*</span></div>
				<div class="col-sm-4 name">
					<div class="input-group">
						<input class="input--style-6" autocomplete="off" autofocus="on" id="inp_kk"
							name="inp_kk" type="text" value onkeypress="return (event.charCode !=8 && event.charCode ==0 || ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57)))">
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">Start Date <span class="required">*</span></div>
				<div class="col-sm-4">
					<div class="input-group">
						<input class="input--style-6" type="Text" id="inp_start_date" name="inp_start_date"
							value="" autocomplete="off" autofocus="on" size="30" maxlength="5" style="background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
							background-size: 17px;
							background-position:right;   
							background-repeat:no-repeat; 
							padding-right:10px;  
							">
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">Gender <span class="required">*</span></div>
				<div class="col-sm-6">
					<div class="input-group">

						<select class="input--style-6" autocomplete="off" autofocus="on" id="inp_gender"
							name="inp_gender" style="height: 33px;">
							<option value="" selected> --Select one --</option>
							<?php
								$sql = mysqli_query($connect, "SELECT * FROM ttamgender GROUP BY gender_name");
								while ($data = mysqli_fetch_array($sql)) {
								?>
							<option value="<?= $data['id'] ?>"><?= $data['gender_name'] ?></option>
							<?php
							}
							?>
						</select>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">Blood Type <span class="required">*</span></div>
				<div class="col-sm-6">
					<div class="input-group">

						<select class="input--style-6" autocomplete="off" autofocus="on" id="inp_blood_type"
							name="inp_blood_type" style="height: 33px;">
							<option value=""> --Select one --</option>
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="AB">AB</option>
							<option value="O">O</option>
							
						</select>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">Religion <span class="required">*</span></div>
				<div class="col-sm-4">
					<div class="input-group">

						<select class="form-control input--style-6" autocomplete="off" autofocus="on"
							id="inp_religion" name="inp_religion" style="height: 33px;">
							<option value="" selected> --Select one --</option>
							<?php
								$sql = mysqli_query($connect, "SELECT * FROM hrmreligion");
								while ($data = mysqli_fetch_array($sql)) {
								?>
							<option value="<?= $data['religion_code'] ?>"><?= $data['religion_name_id'] ?>
							</option>
							<?php
							}
							?>
						</select>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">Marital status <span class="required">*</span></div>
				<div class="col-sm-4">
					<div class="input-group">
						<select class="form-control input--style-6" autocomplete="off" autofocus="on"
							id="inp_marital_status" name="inp_marital_status" style="height: 33px;">
							<option value="" selected> --Select one --</option>
							<?php
								$sql = mysqli_query($connect, "SELECT * FROM teommarital");
								while ($data = mysqli_fetch_array($sql)) {
								?>
							<option value="<?= $data['code'] ?>"><?= $data['name_en'] ?></option>
							<?php
							}
							?>
						</select>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">Nationality <span class="required">*</span></div>
				<div class="col-sm-6">
					<div class="input-group">

						<select class="input--style-6" autocomplete="off" autofocus="on" id="inp_nationality"
							name="inp_nationality" style="height: 33px;">
							<option value=""> --Select one --</option>
							<option value="WNI">WNI</option>
							<option value="WNA">WNA</option>
							
						</select>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">Phone Number <span class="required">*</span></div>
				<div class="col-sm-4 name">
					<div class="input-group">
						<input class="input--style-6" autocomplete="off" autofocus="on" id="inp_phone_number"
							name="inp_phone_number" type="text" value onkeypress="return (event.charCode !=8 && event.charCode ==0 || ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57)))">
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">Email <span class="required">*</span></div>
				<div class="col-sm-4 name">
					<div class="input-group">
						<input class="input--style-6" autocomplete="off" autofocus="on" id="inp_email"
							name="inp_email" type="email" value>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">Email Personal <span class="required">*</span></div>
				<div class="col-sm-4 name">
					<div class="input-group">
						<input class="input--style-6" autocomplete="off" autofocus="on" id="inp_email_personal"
							name="inp_email_personal" type="email" value>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">Address <span class="required">*</span></div>
				<div class="col-sm-4 name">
					<div class="input-group">
						<textarea class="input--style-6" name="inp_address_ktp" id="inp_address_ktp" cols="50" rows="5"></textarea>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">NPWP <span class="required">*</span></div>
				<div class="col-sm-4 name">
					<div class="input-group">
						<input class="input--style-6" autocomplete="off" autofocus="on" id="inp_npwp"
							name="inp_npwp" type="text" value onkeypress="return (event.charCode !=8 && event.charCode ==0 || ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57)))">
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">PTKP <span class="required">*</span></div>
				<div class="col-sm-4 name">
					<div class="input-group">
						<select class="input--style-6" autocomplete="off" autofocus="on" id="inp_ptkp"
							name="inp_ptkp" style="height: 33px;">
							<option value="" selected> --Select one --</option>
							<?php
								$sql = mysqli_query($connect, "SELECT * FROM hrmptkp");
								while ($data = mysqli_fetch_array($sql)) {
								?>
							<option value="<?= $data['ptkp_id'] ?>"><?= $data['ptkp_name'] ?></option>
							<?php
							}
							?>
						</select>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">BPJS (KS) <span class="required">*</span></div>
				<div class="col-sm-4 name">
					<div class="input-group">
						<input class="input--style-6" autocomplete="off" autofocus="on" id="inp_bpjs_ks"
							name="inp_bpjs_ks" type="text" value onkeypress="return (event.charCode !=8 && event.charCode ==0 || ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57)))">
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">BPJS (TK) <span class="required">*</span></div>
				<div class="col-sm-4 name">
					<div class="input-group">
						<input class="input--style-6" autocomplete="off" autofocus="on" id="inp_bpjs_tk"
							name="inp_bpjs_tk" type="text" value onkeypress="return (event.charCode !=8 && event.charCode ==0 || ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57)))">
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">Insurance <span class="required">*</span></div>
				<div class="col-sm-4 name">
					<div class="input-group">
						<input class="input--style-6" autocomplete="off" autofocus="on" id="inp_insurance"
							name="inp_insurance" type="text" value onkeypress="return (event.charCode !=8 && event.charCode ==0 || ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57)))">
					</div>
				</div>
			</div>

			<div class="form-row">
				<div class="col-sm-2 name">Bank <span class="required">*</span></div>
				<div class="col-sm-6">
					<div class="input-group">
						<select class="input--style-6" autocomplete="off" autofocus="on" id="inp_bank_name"
							name="inp_bank_name" style="height: 33px;">
							<option value="" selected> --Select one --</option>
							<?php
								$sql = mysqli_query($connect, "SELECT * FROM toebank");
								while ($data = mysqli_fetch_array($sql)) {
								?>
							<option value="<?= $data['no'] ?>"><?= $data['bank'] ?></option>
							<?php
							}
							?>
						</select>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">Bank Number <span class="required">*</span></div>
				<div class="col-sm-4 name">
					<div class="input-group">
						<input class="input--style-6" autocomplete="off" autofocus="on" id="inp_bank_number"
							name="inp_bank_number" type="text" value onkeypress="return (event.charCode !=8 && event.charCode ==0 || ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57)))">
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">Bank User Account <span class="required">*</span></div>
				<div class="col-sm-4 name">
					<div class="input-group">
						<input class="input--style-6" autocomplete="off" autofocus="on" id="inp_bank_user_account"
							name="inp_bank_user_account" type="text" value>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">Bank branch office <span class="required">*</span></div>
				<div class="col-sm-4 name">
					<div class="input-group">
						<input class="input--style-6" autocomplete="off" autofocus="on" id="inp_bank_branch_office"
							name="inp_bank_branch_office" type="text" value>
					</div>
				</div>
			</div>
		</fieldset>

		<!-- education -->
		<fieldset>
			<legend>Educations</legend>
			<div>
				<table class="table table-striped table-bordered table-hover" id="table_employee_education">
					<thead class="thead-light">
						<tr>
							<th style="text-align:center">Pendidikan</th>
							<th style="text-align:center">Nama Sekolah</th>
							<th style="text-align:center">Tempat/Lokasi</th>
							<th style="text-align:center">Jurusan</th>
							<th style="text-align:center">Tahun</th>
							<th style="text-align:center">IPK</th>
						</tr>
					</thead>
					<tbody id="data_list_employee_education">
					</tbody>
				</table>
			</div>
		</fieldset>
		
		<!-- emergency contact -->
		<fieldset>
			<legend>Emergency Contact</legend>
			<div>
				<table class="table table-striped table-bordered table-hover" id="table_emergency_contact">
					<thead class="thead-light">
						<tr>
							<th style="text-align:center">Nama Kontak</th>
							<th style="text-align:center">Hubungan Dengan Karyawan</th>
							<th style="text-align:center">Nomor Kontak</th>
							<th style="text-align:center">Alamat Lengkap</th>
						</tr>
					</thead>
					<tbody id="data_list_emergency_contact">
					</tbody>
				</table>
			</div>
		</fieldset>
		
		<!-- family & dependent -->
		<fieldset>
			<legend>Family & Dependent</legend>
			<div>
				<table class="table table-striped table-bordered table-hover" id="table_family_dependent">
					<thead class="thead-light">
						<tr>
							<th style="text-align:center">Anggota Keluarga</th>
							<th style="text-align:center">Nama Lengkap</th>
							<th style="text-align:center">Tanggal Lahir</th>
							<th style="text-align:center">Status</th>
						</tr>
					</thead>
					<tbody id="data_list_family_dependent">
					</tbody>
				</table>
			</div>
		</fieldset>
		<div class="modal-footer-sdk">
			<button type="button" class="btn-sdk btn-primary-left" name="update_draft" id="update_draft">
				&nbsp;Draft&nbsp;
			</button>
			<button class="btn-sdk btn-primary-right" type="button" name="save_submit" id="save_submit">
				Submit
			</button>
		</div>
	</form>
</div>

<div class="container-fluid" id="section_detail_data">
	<form class="form-horizontal" action="" method="POST" id="FormDisplayUpdateEmployee">

		<fieldset id="fset_1">
			<legend>Detail Information</legend>

			<input id="detail_request_update_id" name="detail_request_update_id" type="hidden" value="<?php echo $username; ?>">
			<input id="detail_emp_no" name="detail_emp_no" type="hidden" value="<?php echo $username; ?>">
			<input id="detail_emp_id" name="detail_emp_id" type="hidden" value="">
			<!--FROM SESSION -->

			<div class="form-row">
				<div class="col-sm-2 name">Full Name <span class="required">*</span></div>
				<div class="col-sm-4 name">
					<div class="input-group">
						<input class="input--style-6" autocomplete="off" autofocus="on" id="detail_full_name"
							name="detail_full_name" type="text">
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">NIP <span class="required">*</span></div>
				<div class="col-sm-4 name">
					<div class="input-group">
						<input class="input--style-6" autocomplete="off" autofocus="on" id="detail_nip"
							name="detail_nip" type="text" value>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">Birth Place <span class="required">*</span></div>
				<div class="col-sm-4 name">
					<div class="input-group">
						<input class="input--style-6" autocomplete="off" autofocus="on" id="detail_birth_place"
							name="detail_birth_place" type="text" value>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">Birthdate <span class="required">*</span></div>
				<div class="col-sm-4">
					<div class="input-group">
						<input class="input--style-6" type="Text" id="detail_birthdate" name="detail_birthdate"
							value="" autocomplete="off" autofocus="on" size="30" maxlength="5" style="background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
							background-size: 17px;
							background-position:right;   
							background-repeat:no-repeat; 
							padding-right:10px;  
							">
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">NIK <span class="required">*</span></div>
				<div class="col-sm-4 name">
					<div class="input-group">
						<input class="input--style-6" autocomplete="off" autofocus="on" id="detail_nik"
							name="detail_nik" type="text" value>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">KK <span class="required">*</span></div>
				<div class="col-sm-4 name">
					<div class="input-group">
						<input class="input--style-6" autocomplete="off" autofocus="on" id="detail_kk"
							name="detail_kk" type="text" value>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">Start Date <span class="required">*</span></div>
				<div class="col-sm-4">
					<div class="input-group">
						<input class="input--style-6" type="Text" id="detail_start_date" name="detail_start_date"
							value="" autocomplete="off" autofocus="on" size="30" maxlength="5" style="background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
							background-size: 17px;
							background-position:right;   
							background-repeat:no-repeat; 
							padding-right:10px;  
							">
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">Gender <span class="required">*</span></div>
				<div class="col-sm-6">
					<div class="input-group">

						<select class="input--style-6" autocomplete="off" autofocus="on" id="detail_gender"
							name="detail_gender" style="height: 33px;">
							<option value="" selected> --Select one --</option>
							<?php
								$sql = mysqli_query($connect, "SELECT * FROM ttamgender GROUP BY gender_name");
								while ($data = mysqli_fetch_array($sql)) {
								?>
							<option value="<?= $data['id'] ?>"><?= $data['gender_name'] ?></option>
							<?php
							}
							?>
						</select>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">Blood Type <span class="required">*</span></div>
				<div class="col-sm-6">
					<div class="input-group">

						<select class="input--style-6" autocomplete="off" autofocus="on" id="detail_blood_type"
							name="detail_blood_type" style="height: 33px;">
							<option value=""> --Select one --</option>
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="AB">AB</option>
							<option value="O">O</option>
							
						</select>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">Religion <span class="required">*</span></div>
				<div class="col-sm-4">
					<div class="input-group">

						<select class="form-control input--style-6" autocomplete="off" autofocus="on"
							id="detail_religion" name="detail_religion" style="height: 33px;">
							<option value="" selected> --Select one --</option>
							<?php
								$sql = mysqli_query($connect, "SELECT * FROM hrmreligion");
								while ($data = mysqli_fetch_array($sql)) {
								?>
							<option value="<?= $data['religion_code'] ?>"><?= $data['religion_name_id'] ?>
							</option>
							<?php
							}
							?>
						</select>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">Marital status <span class="required">*</span></div>
				<div class="col-sm-4">
					<div class="input-group">
						<select class="form-control input--style-6" autocomplete="off" autofocus="on"
							id="detail_marital_status" name="detail_marital_status" style="height: 33px;">
							<option value="" selected> --Select one --</option>
							<?php
								$sql = mysqli_query($connect, "SELECT * FROM teommarital");
								while ($data = mysqli_fetch_array($sql)) {
								?>
							<option value="<?= $data['code'] ?>"><?= $data['name_en'] ?></option>
							<?php
							}
							?>
						</select>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">Nationality <span class="required">*</span></div>
				<div class="col-sm-6">
					<div class="input-group">

						<select class="input--style-6" autocomplete="off" autofocus="on" id="detail_nationality"
							name="detail_nationality" style="height: 33px;">
							<option value=""> --Select one --</option>
							<option value="WNI">WNI</option>
							<option value="WNA">WNA</option>
							
						</select>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">Phone Number <span class="required">*</span></div>
				<div class="col-sm-4 name">
					<div class="input-group">
						<input class="input--style-6" autocomplete="off" autofocus="on" id="detail_phone_number"
							name="detail_phone_number" type="text" value>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">Email <span class="required">*</span></div>
				<div class="col-sm-4 name">
					<div class="input-group">
						<input class="input--style-6" autocomplete="off" autofocus="on" id="detail_email"
							name="detail_email" type="email" value>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">Email Personal <span class="required">*</span></div>
				<div class="col-sm-4 name">
					<div class="input-group">
						<input class="input--style-6" autocomplete="off" autofocus="on" id="detail_email_personal"
							name="detail_email_personal" type="email" value>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">Address <span class="required">*</span></div>
				<div class="col-sm-4 name">
					<div class="input-group">
						<textarea class="input--style-6" name="detail_address_ktp" id="detail_address_ktp" cols="50" rows="5"></textarea>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">NPWP <span class="required">*</span></div>
				<div class="col-sm-4 name">
					<div class="input-group">
						<input class="input--style-6" autocomplete="off" autofocus="on" id="detail_npwp"
							name="detail_npwp" type="text" value>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">PTKP <span class="required">*</span></div>
				<div class="col-sm-4 name">
					<div class="input-group">
						<select class="input--style-6" autocomplete="off" autofocus="on" id="detail_ptkp"
							name="detail_ptkp" style="height: 33px;">
							<option value="" selected> --Select one --</option>
							<?php
								$sql = mysqli_query($connect, "SELECT * FROM hrmptkp");
								while ($data = mysqli_fetch_array($sql)) {
								?>
							<option value="<?= $data['ptkp_id'] ?>"><?= $data['ptkp_name'] ?></option>
							<?php
							}
							?>
						</select>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">BPJS (KS) <span class="required">*</span></div>
				<div class="col-sm-4 name">
					<div class="input-group">
						<input class="input--style-6" autocomplete="off" autofocus="on" id="detail_bpjs_ks"
							name="detail_bpjs_ks" type="text" value>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">BPJS (TK) <span class="required">*</span></div>
				<div class="col-sm-4 name">
					<div class="input-group">
						<input class="input--style-6" autocomplete="off" autofocus="on" id="detail_bpjs_tk"
							name="detail_bpjs_tk" type="text" value>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">Insurance <span class="required">*</span></div>
				<div class="col-sm-4 name">
					<div class="input-group">
						<input class="input--style-6" autocomplete="off" autofocus="on" id="detail_insurance"
							name="detail_insurance" type="text" value>
					</div>
				</div>
			</div>

			<div class="form-row">
				<div class="col-sm-2 name">Bank <span class="required">*</span></div>
				<div class="col-sm-6">
					<div class="input-group">

						<select class="input--style-6" autocomplete="off" autofocus="on" id="detail_bank_name"
							name="detail_bank_name" style="height: 33px;">
							<option value="" selected> --Select one --</option>
							<?php
								$sql = mysqli_query($connect, "SELECT * FROM toebank");
								while ($data = mysqli_fetch_array($sql)) {
								?>
							<option value="<?= $data['no'] ?>"><?= $data['bank'] ?></option>
							<?php
							}
							?>
						</select>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">Bank Number <span class="required">*</span></div>
				<div class="col-sm-4 name">
					<div class="input-group">
						<input class="input--style-6" autocomplete="off" autofocus="on" id="detail_bank_number"
							name="detail_bank_number" type="text" value>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">Bank User Account <span class="required">*</span></div>
				<div class="col-sm-4 name">
					<div class="input-group">
						<input class="input--style-6" autocomplete="off" autofocus="on" id="detail_bank_user_account"
							name="detail_bank_user_account" type="text" value>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2 name">Bank branch office <span class="required">*</span></div>
				<div class="col-sm-4 name">
					<div class="input-group">
						<input class="input--style-6" autocomplete="off" autofocus="on" id="detail_bank_branch_office"
							name="detail_bank_branch_office" type="text" value>
					</div>
				</div>
			</div>
		</fieldset>

		<!-- education -->
		<fieldset>
			<legend>Educations</legend>
			<div>
				<table class="table table-striped table-bordered table-hover" id="table_employee_education_detail">
					<thead class="thead-light">
						<tr>
							<th style="text-align:center">Pendidikan</th>
							<th style="text-align:center">Nama Sekolah</th>
							<th style="text-align:center">Tempat/Lokasi</th>
							<th style="text-align:center">Jurusan</th>
							<th style="text-align:center">Tahun</th>
							<th style="text-align:center">IPK</th>
							<th style="text-align:center">#</th>
						</tr>
					</thead>
					<tbody id="data_list_employee_education_detail">
					</tbody>
				</table>
			</div>
		</fieldset>
		
		<!-- emergency contact -->
		<fieldset>
			<legend>Emergency Contact</legend>
			<div>
				<table class="table table-striped table-bordered table-hover" id="table_emergency_contact_detail">
					<thead class="thead-light">
						<tr>
							<th style="text-align:center">Nama Kontak</th>
							<th style="text-align:center">Hubungan Dengan Karyawan</th>
							<th style="text-align:center">Nomor Kontak</th>
							<th style="text-align:center">Alamat Lengkap</th>
							<th style="text-align:center">#</th>
						</tr>
					</thead>
					<tbody id="data_list_emergency_contact_detail">
					</tbody>
				</table>
			</div>
		</fieldset>
		
		
		<!-- family & dependent -->
		<fieldset>
			<legend>Family & Dependent</legend>
			<div>
				<table class="table table-striped table-bordered table-hover" id="table_family_dependent_detail">
					<thead class="thead-light">
						<tr>
							<th style="text-align:center">Anggota Keluarga</th>
							<th style="text-align:center">Nama Lengkap</th>
							<th style="text-align:center">Tanggal Lahir</th>
							<th style="text-align:center">Status</th>
							<th style="text-align:center">#</th>
						</tr>
					</thead>
					<tbody id="data_list_family_dependent_detail">
					</tbody>
				</table>
			</div>
		</fieldset>
		<div class="modal-footer-sdk">
			<button type="button" class="btn-sdk btn-primary-left" name="update_draft" id="update_draft">
				&nbsp;Draft&nbsp;
			</button>
			<button class="btn-sdk btn-primary-right" type="button" name="update_submit" id="update_submit">
				Submit
			</button>
		</div>
	</form>
</div>

<!-- add modal -->
<div class="modal  fade fade-custom" tabindex="-1" role="dialog" id="">
	<div class="modal-dialog modal-belakang modal-bgkpi" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Create Updating Employee</h4>
				<a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close"
					style="margin-top: -15px;">
					<span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
				</a>
			</div>

			<div class="card-body table-responsive p-0"
				style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

				<form class="form-horizontal" action="php_action/FuncDataCreate.php<?php echo $getPackage; ?>"
					method="POST" id="FormDisplayCreate">

					<fieldset id="fset_1">
						<legend>Detail Information</legend>

						<input id="inp_emp_no" name="inp_emp_no" type="hidden" value="<?php echo $username; ?>">
						<input id="inp_emp_id" name="inp_emp_id" type="hidden" value="">
						<!--FROM SESSION -->

						<div class="form-row">
							<div class="col-sm-2 name">Full Name <span class="required">*</span></div>
							<div class="col-sm-4 name">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="inp_full_name"
										name="inp_full_name" type="text">
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">NIP <span class="required">*</span></div>
							<div class="col-sm-4 name">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="inp_nip"
										name="inp_nip" type="text" value>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">Birth Place <span class="required">*</span></div>
							<div class="col-sm-4 name">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="inp_birth_place"
										name="inp_birth_place" type="text" value>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">Birthdate <span class="required">*</span></div>
							<div class="col-sm-4">
								<div class="input-group">
									<input class="input--style-6" type="Text" id="inp_birthdate" name="inp_birthdate"
										value="" autocomplete="off" autofocus="on" size="30" maxlength="5" style="background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
										background-size: 17px;
										background-position:right;   
										background-repeat:no-repeat; 
										padding-right:10px;  
										">
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">NIK <span class="required">*</span></div>
							<div class="col-sm-4 name">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="inp_nik"
										name="inp_nik" type="text" value>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">KK <span class="required">*</span></div>
							<div class="col-sm-4 name">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="inp_kk"
										name="inp_kk" type="text" value>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">Start Date <span class="required">*</span></div>
							<div class="col-sm-4">
								<div class="input-group">
									<input class="input--style-6" type="Text" id="inp_start_date" name="inp_start_date"
										value="" autocomplete="off" autofocus="on" size="30" maxlength="5" style="background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
										background-size: 17px;
										background-position:right;   
										background-repeat:no-repeat; 
										padding-right:10px;  
										">
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">Gender <span class="required">*</span></div>
							<div class="col-sm-6">
								<div class="input-group">

									<select class="input--style-6" autocomplete="off" autofocus="on" id="inp_gender"
										name="inp_gender" style="height: 33px;">
										<option value="" selected> --Select one --</option>
										<?php
											$sql = mysqli_query($connect, "SELECT * FROM ttamgender GROUP BY gender_name");
											while ($data = mysqli_fetch_array($sql)) {
											?>
										<option value="<?= $data['id'] ?>"><?= $data['gender_name'] ?></option>
										<?php
										}
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">Blood Type <span class="required">*</span></div>
							<div class="col-sm-6">
								<div class="input-group">

									<select class="input--style-6" autocomplete="off" autofocus="on" id="inp_blood_type"
										name="inp_blood_type" style="height: 33px;">
										<option value=""> --Select one --</option>
										<option value="A">A</option>
										<option value="B">B</option>
										<option value="AB">AB</option>
										<option value="O">O</option>
										
									</select>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">Religion <span class="required">*</span></div>
							<div class="col-sm-4">
								<div class="input-group">

									<select class="form-control input--style-6" autocomplete="off" autofocus="on"
										id="inp_religion" name="inp_religion" style="height: 33px;">
										<option value="" selected> --Select one --</option>
										<?php
											$sql = mysqli_query($connect, "SELECT * FROM hrmreligion");
											while ($data = mysqli_fetch_array($sql)) {
											?>
										<option value="<?= $data['religion_code'] ?>"><?= $data['religion_name_id'] ?>
										</option>
										<?php
										}
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">Marital status <span class="required">*</span></div>
							<div class="col-sm-4">
								<div class="input-group">
									<select class="form-control input--style-6" autocomplete="off" autofocus="on"
										id="inp_marital_status" name="inp_marital_status" style="height: 33px;">
										<option value="" selected> --Select one --</option>
										<?php
											$sql = mysqli_query($connect, "SELECT * FROM teommarital");
											while ($data = mysqli_fetch_array($sql)) {
											?>
										<option value="<?= $data['code'] ?>"><?= $data['name_en'] ?></option>
										<?php
										}
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">Nationality <span class="required">*</span></div>
							<div class="col-sm-6">
								<div class="input-group">

									<select class="input--style-6" autocomplete="off" autofocus="on" id="inp_nationality"
										name="inp_nationality" style="height: 33px;">
										<option value=""> --Select one --</option>
										<option value="WNI">WNI</option>
										<option value="WNA">WNA</option>
										
									</select>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">Phone Number <span class="required">*</span></div>
							<div class="col-sm-4 name">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="inp_phone_number"
										name="inp_phone_number" type="text" value>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">Email <span class="required">*</span></div>
							<div class="col-sm-4 name">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="inp_email"
										name="inp_email" type="email" value>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">Email Personal <span class="required">*</span></div>
							<div class="col-sm-4 name">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="inp_email_personal"
										name="inp_email_personal" type="email" value>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">Address <span class="required">*</span></div>
							<div class="col-sm-4 name">
								<div class="input-group">
									<textarea class="input--style-6" name="inp_address_ktp" id="inp_address_ktp" cols="50" rows="5"></textarea>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">NPWP <span class="required">*</span></div>
							<div class="col-sm-4 name">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="inp_npwp"
										name="inp_npwp" type="text" value>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">BPJS (KS) <span class="required">*</span></div>
							<div class="col-sm-4 name">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="inp_bpjs_ks"
										name="inp_bpjs_ks" type="text" value>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">BPJS (TK) <span class="required">*</span></div>
							<div class="col-sm-4 name">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="inp_bpjs_tk"
										name="inp_bpjs_tk" type="text" value>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">Insurance <span class="required">*</span></div>
							<div class="col-sm-4 name">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="inp_insurance"
										name="inp_insurance" type="text" value>
								</div>
							</div>
						</div>

						<div class="form-row">
							<div class="col-sm-2 name">Bank <span class="required">*</span></div>
							<div class="col-sm-6">
								<div class="input-group">

									<select class="input--style-6" autocomplete="off" autofocus="on" id="inp_bank_name"
										name="inp_bank_name" style="height: 33px;">
										<option value=""> --Select one --</option>
										<option value="A">A</option>
										<option value="B">B</option>
										<option value="AB">AB</option>
										<option value="O">O</option>
										
									</select>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">Bank Number <span class="required">*</span></div>
							<div class="col-sm-4 name">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="inp_bank_number"
										name="inp_bank_number" type="text" value>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">Bank User Account <span class="required">*</span></div>
							<div class="col-sm-4 name">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="inp_bank_user_account"
										name="inp_bank_user_account" type="text" value>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">Bank branch office <span class="required">*</span></div>
							<div class="col-sm-4 name">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="inp_bank_branch_office"
										name="inp_bank_branch_office" type="text" value>
								</div>
							</div>
						</div>
					</fieldset>

					<!-- education -->
					<fieldset>
						<legend>Educations</legend>
						<div>
							<table class="table table-striped table-bordered table-hover" id="table_employee_education">
								<thead class="thead-light">
									<tr>
										<th style="text-align:center">Pendidikan</th>
										<th style="text-align:center">Nama Sekolah</th>
										<th style="text-align:center">Tempat/Lokasi</th>
										<th style="text-align:center">Jurusan</th>
										<th style="text-align:center">Tahun</th>
										<th style="text-align:center">IPK</th>
										<th style="text-align:center">#</th>
									</tr>
								</thead>
								<tbody id="data_list_employee_education">
								</tbody>
							</table>
						</div>
					</fieldset>
					
					<!-- emergency contact -->
					<fieldset>
						<legend>Emergency Contact</legend>
						<div>
							<table class="table table-striped table-bordered table-hover" id="table_emergency_contact">
								<thead class="thead-light">
									<tr>
										<th style="text-align:center">Nama Kontak</th>
										<th style="text-align:center">Hubungan Dengan Karyawan</th>
										<th style="text-align:center">Nomor Kontak</th>
										<th style="text-align:center">Alamat Lengkap</th>
										<th style="text-align:center">#</th>
									</tr>
								</thead>
								<tbody id="data_list_emergency_contact">
								</tbody>
							</table>
						</div>
					</fieldset>
					
					
					<!-- family & dependent -->
					<fieldset>
						<legend>Family & Dependent</legend>
						<div>
							<table class="table table-striped table-bordered table-hover" id="table_family_dependent">
								<thead class="thead-light">
									<tr>
										<th style="text-align:center">Anggota Keluarga</th>
										<th style="text-align:center">Nama Lengkap</th>
										<th style="text-align:center">Tanggal Lahir</th>
										<th style="text-align:center">Status</th>
										<th style="text-align:center">#</th>
									</tr>
								</thead>
								<tbody id="data_list_family_dependent">
								</tbody>
							</table>
						</div>
					</fieldset>
					
			</div>
			<div class="modal-footer-sdk">
				<button type="button" class="btn-sdk btn-primary-left" name="save_draft" id="save_draft">
					&nbsp;Draft&nbsp;
				</button>
				<button class="btn-sdk btn-primary-right" type="button" name="save_submit" id="save_submit">
					Submit
				</button>
			</div>
			</form>
		</div>
	</div>
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /edit modal -->

<!-- update modal -->
<div class="modal  fade fade-custom" tabindex="-1" role="dialog" id="">
	<div class="modal-dialog modal-belakang modal-bgkpi" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Create Updating Employee</h4>
				<a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close"
					style="margin-top: -15px;">
					<span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
				</a>
			</div>

			<div class="card-body table-responsive p-0"
				style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

				<form class="form-horizontal" action="" method="POST" id="FormDisplayUpdateEmployee">

					<fieldset id="fset_1">
						<legend>Detail Information</legend>

						<input id="detail_emp_no" name="detail_emp_no" type="hidden" value="<?php echo $username; ?>">
						<input id="detail_emp_id" name="detail_emp_id" type="hidden" value="">
						<!--FROM SESSION -->

						<div class="form-row">
							<div class="col-sm-2 name">Full Name <span class="required">*</span></div>
							<div class="col-sm-4 name">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="detail_full_name"
										name="detail_full_name" type="text">
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">NIP <span class="required">*</span></div>
							<div class="col-sm-4 name">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="detail_nip"
										name="detail_nip" type="text" value>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">Birth Place <span class="required">*</span></div>
							<div class="col-sm-4 name">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="detail_birth_place"
										name="detail_birth_place" type="text" value>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">Birthdate <span class="required">*</span></div>
							<div class="col-sm-4">
								<div class="input-group">
									<input class="input--style-6" type="Text" id="detail_birthdate" name="detail_birthdate"
										value="" autocomplete="off" autofocus="on" size="30" maxlength="5" style="background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
										background-size: 17px;
										background-position:right;   
										background-repeat:no-repeat; 
										padding-right:10px;  
										">
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">NIK <span class="required">*</span></div>
							<div class="col-sm-4 name">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="detail_nik"
										name="detail_nik" type="text" value>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">KK <span class="required">*</span></div>
							<div class="col-sm-4 name">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="detail_kk"
										name="detail_kk" type="text" value>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">Start Date <span class="required">*</span></div>
							<div class="col-sm-4">
								<div class="input-group">
									<input class="input--style-6" type="Text" id="detail_start_date" name="detail_start_date"
										value="" autocomplete="off" autofocus="on" size="30" maxlength="5" style="background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
										background-size: 17px;
										background-position:right;   
										background-repeat:no-repeat; 
										padding-right:10px;  
										">
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">Gender <span class="required">*</span></div>
							<div class="col-sm-6">
								<div class="input-group">

									<select class="input--style-6" autocomplete="off" autofocus="on" id="detail_gender"
										name="detail_gender" style="height: 33px;">
										<option value="" selected> --Select one --</option>
										<?php
											$sql = mysqli_query($connect, "SELECT * FROM ttamgender GROUP BY gender_name");
											while ($data = mysqli_fetch_array($sql)) {
											?>
										<option value="<?= $data['id'] ?>"><?= $data['gender_name'] ?></option>
										<?php
										}
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">Blood Type <span class="required">*</span></div>
							<div class="col-sm-6">
								<div class="input-group">

									<select class="input--style-6" autocomplete="off" autofocus="on" id="detail_blood_type"
										name="detail_blood_type" style="height: 33px;">
										<option value=""> --Select one --</option>
										<option value="A">A</option>
										<option value="B">B</option>
										<option value="AB">AB</option>
										<option value="O">O</option>
										
									</select>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">Religion <span class="required">*</span></div>
							<div class="col-sm-4">
								<div class="input-group">

									<select class="form-control input--style-6" autocomplete="off" autofocus="on"
										id="detail_religion" name="detail_religion" style="height: 33px;">
										<option value="" selected> --Select one --</option>
										<?php
											$sql = mysqli_query($connect, "SELECT * FROM hrmreligion");
											while ($data = mysqli_fetch_array($sql)) {
											?>
										<option value="<?= $data['religion_code'] ?>"><?= $data['religion_name_id'] ?>
										</option>
										<?php
										}
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">Marital status <span class="required">*</span></div>
							<div class="col-sm-4">
								<div class="input-group">
									<select class="form-control input--style-6" autocomplete="off" autofocus="on"
										id="detail_marital_status" name="detail_marital_status" style="height: 33px;">
										<option value="" selected> --Select one --</option>
										<?php
											$sql = mysqli_query($connect, "SELECT * FROM teommarital");
											while ($data = mysqli_fetch_array($sql)) {
											?>
										<option value="<?= $data['code'] ?>"><?= $data['name_en'] ?></option>
										<?php
										}
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">Nationality <span class="required">*</span></div>
							<div class="col-sm-6">
								<div class="input-group">

									<select class="input--style-6" autocomplete="off" autofocus="on" id="detail_nationality"
										name="detail_nationality" style="height: 33px;">
										<option value=""> --Select one --</option>
										<option value="WNI">WNI</option>
										<option value="WNA">WNA</option>
										
									</select>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">Phone Number <span class="required">*</span></div>
							<div class="col-sm-4 name">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="detail_phone_number"
										name="detail_phone_number" type="text" value>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">Email <span class="required">*</span></div>
							<div class="col-sm-4 name">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="detail_email"
										name="detail_email" type="email" value>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">Email Personal <span class="required">*</span></div>
							<div class="col-sm-4 name">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="detail_email_personal"
										name="detail_email_personal" type="email" value>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">Address <span class="required">*</span></div>
							<div class="col-sm-4 name">
								<div class="input-group">
									<textarea class="input--style-6" name="detail_address_ktp" id="detail_address_ktp" cols="50" rows="5"></textarea>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">NPWP <span class="required">*</span></div>
							<div class="col-sm-4 name">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="detail_npwp"
										name="detail_npwp" type="text" value>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">BPJS (KS) <span class="required">*</span></div>
							<div class="col-sm-4 name">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="detail_bpjs_ks"
										name="detail_bpjs_ks" type="text" value>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">BPJS (TK) <span class="required">*</span></div>
							<div class="col-sm-4 name">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="detail_bpjs_tk"
										name="detail_bpjs_tk" type="text" value>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">Insurance <span class="required">*</span></div>
							<div class="col-sm-4 name">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="detail_insurance"
										name="detail_insurance" type="text" value>
								</div>
							</div>
						</div>

						<div class="form-row">
							<div class="col-sm-2 name">Bank <span class="required">*</span></div>
							<div class="col-sm-6">
								<div class="input-group">

									<select class="input--style-6" autocomplete="off" autofocus="on" id="detail_bank_name"
										name="detail_bank_name" style="height: 33px;">
										<option value=""> --Select one --</option>
										<option value="A">A</option>
										<option value="B">B</option>
										<option value="AB">AB</option>
										<option value="O">O</option>
										
									</select>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">Bank Number <span class="required">*</span></div>
							<div class="col-sm-4 name">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="detail_bank_number"
										name="detail_bank_number" type="text" value>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">Bank User Account <span class="required">*</span></div>
							<div class="col-sm-4 name">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="detail_bank_user_account"
										name="detail_bank_user_account" type="text" value>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-2 name">Bank branch office <span class="required">*</span></div>
							<div class="col-sm-4 name">
								<div class="input-group">
									<input class="input--style-6" autocomplete="off" autofocus="on" id="detail_bank_branch_office"
										name="detail_bank_branch_office" type="text" value>
								</div>
							</div>
						</div>
					</fieldset>

					<!-- education -->
					<fieldset>
						<legend>Educations</legend>
						<div>
							<table class="table table-striped table-bordered table-hover" id="table_employee_education_detail">
								<thead class="thead-light">
									<tr>
										<th style="text-align:center">Pendidikan</th>
										<th style="text-align:center">Nama Sekolah</th>
										<th style="text-align:center">Tempat/Lokasi</th>
										<th style="text-align:center">Jurusan</th>
										<th style="text-align:center">Tahun</th>
										<th style="text-align:center">IPK</th>
										<th style="text-align:center">#</th>
									</tr>
								</thead>
								<tbody id="data_list_employee_education_detail">
								</tbody>
							</table>
						</div>
					</fieldset>
					
					<!-- emergency contact -->
					<fieldset>
						<legend>Emergency Contact</legend>
						<div>
							<table class="table table-striped table-bordered table-hover" id="table_emergency_contact_detail">
								<thead class="thead-light">
									<tr>
										<th style="text-align:center">Nama Kontak</th>
										<th style="text-align:center">Hubungan Dengan Karyawan</th>
										<th style="text-align:center">Nomor Kontak</th>
										<th style="text-align:center">Alamat Lengkap</th>
										<th style="text-align:center">#</th>
									</tr>
								</thead>
								<tbody id="data_list_emergency_contact_detail">
								</tbody>
							</table>
						</div>
					</fieldset>
					
					
					<!-- family & dependent -->
					<fieldset>
						<legend>Family & Dependent</legend>
						<div>
							<table class="table table-striped table-bordered table-hover" id="table_family_dependent_detail">
								<thead class="thead-light">
									<tr>
										<th style="text-align:center">Anggota Keluarga</th>
										<th style="text-align:center">Nama Lengkap</th>
										<th style="text-align:center">Tanggal Lahir</th>
										<th style="text-align:center">Status</th>
										<th style="text-align:center">#</th>
									</tr>
								</thead>
								<tbody id="data_list_family_dependent_detail">
								</tbody>
							</table>
						</div>
					</fieldset>
					
			</div>
			<div class="modal-footer-sdk">
				<button type="button" class="btn-sdk btn-primary-left" name="update_draft" id="update_draft">
					&nbsp;Draft&nbsp;
				</button>
				<button class="btn-sdk btn-primary-right" type="button" name="save_submit" id="save_submit">
					Submit
				</button>
			</div>
			</form>
		</div>
	</div>
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
<script>
	function ResetTable() {
		$("#tbl_posts > tbody > .reset-delete-record").html("");
		$("#tbl_posts_second > tbody > .reset-delete-record").html("");

		for (let i = 2; i < 100; i++) {
			jQuery('#rec-' + [i]).remove();
			jQuery('#recs-' + [i]).remove();
		}
	}
</script>


</body>

</html>

<link rel="stylesheet" href="asset/w3schools28.css">
<link rel="stylesheet" href="asset/style_photo.css">

<!-- Jquery JS -->
<script src="asset/jquery-1.js"></script>
<!-- bootStrap JS -->
<script src="asset/bootstrap.js"></script>
<!-- Plugin Custom JS -->
<script src="asset/form-wizard.js"></script>
<!-- Plugin Custom JS -->

<script type="text/javascript">
	$('#classic').click(function () {
		$('.form-wizard').addClass("form-header-classic").removeClass(
			"form-header-stylist form-header-modarn");
	});

	$('#modarn').click(function () {
		$('.form-wizard').addClass("form-header-modarn").removeClass(
			"form-header-classic form-header-stylist");
	});

	$('#stylist').click(function () {
		$('.form-wizard').addClass("form-header-stylist").removeClass(
			"form-header-classic form-header-modarn");
	});
</script>

<script type="text/javascript">
	$('#classic-body').click(function () {
		$('.form-wizard').addClass("form-body-classic").removeClass(
			"form-body-stylist form-body-material");
	});

	$('#material-body').click(function () {
		$('.form-wizard').addClass("form-body-material").removeClass(
			"form-body-classic form-body-stylist");
	});

	$('#stylist-body').click(function () {
		$('.form-wizard').addClass("form-body-stylist").removeClass(
			"form-body-classic form-body-material");
	});
</script>

<script>
	document.querySelector("html").classList.add('js');

	var fileInput = document.querySelector(".input-file"),
		button = document.querySelector(".input-file-trigger"),
		the_return = document.querySelector(".file-return");

	button.addEventListener("keydown", function (event) {
		if (event.keyCode == 13 || event.keyCode == 32) {
			fileInput.focus();
		}
	});
	button.addEventListener("click", function (event) {
		fileInput.focus();
		return false;
	});
	fileInput.addEventListener("change", function (event) {
		the_return.innerHTML = this.value;
	});
</script>



<script>
	$(document).ready(function () {
		$(document).on('change', '#file', function () {
			var name = document.getElementById("file").files[0].name;
			var uploadField1 = document.getElementById("file");

			var form_data = new FormData();
			var ext = name.split('.').pop().toLowerCase();

			var allowedFiles = [".doc", ".jpg", ".jpeg", ".ods", ".png", ".txt", ".doc", ".pdf"]
			var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");

			var oFReader = new FileReader();
			oFReader.readAsDataURL(document.getElementById("file").files[0]);
			var f = document.getElementById("file").files[0];
			var fsize = f.size || f.fileSize;
			if (!regex.test(uploadField1.value.toLowerCase())) {
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = "File Tidak Diijinkan";
			} else if (fsize > 3145728) {
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = "Dokumen terlalu besar maksimum besar file 3MB";
				return false;
			} else {
				form_data.append("file", document.getElementById('file').files[0]);
				$.ajax({
					url: "uploader_dokumen.php<?php echo $getPackage; ?>code=1&token=<?php echo $username; ?>",
					method: "POST",
					data: form_data,
					contentType: false,
					cache: false,
					processData: false,
					beforeSend: function () {
						$('#uploaded_image').html(
							"<img src='../../asset/dist/img/loading.gif' style='max-width: 10%;margin-top: 20px;'>"
						);
					},
					success: function (data) {
						$('#uploaded_image').html(data);
					}
				});
			}
		});
	});
</script>


<script>
	$(document).ready(function () {
		$(document).on('change', '#file2', function () {
			var name = document.getElementById("file2").files[0].name;
			var uploadField2 = document.getElementById("file2");

			var form_data = new FormData();
			var ext = name.split('.').pop().toLowerCase();

			var allowedFiles = [".doc", ".jpg", ".jpeg", ".ods", ".png", ".txt", ".doc", ".pdf"]
			var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");

			//   if(!regex.test(uploadField2.value.toLowerCase())) 
			//   {
			//    alert("Invalid Image File");
			//   }
			var oFReader = new FileReader();
			oFReader.readAsDataURL(document.getElementById("file2").files[0]);
			var f = document.getElementById("file2").files[0];
			var fsize = f.size || f.fileSize;
			if (!regex.test(uploadField2.value.toLowerCase())) {
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = "File Tidak Diijinkan";
			} else if (fsize > 3145728) {
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = "Dokumen terlalu besar maksimum besar file 3MB";
				return false;
			} else {
				form_data.append("file2", document.getElementById('file2').files[0]);
				$.ajax({
					url: "uploader_dokumen.php<?php echo $getPackage; ?>code=2&token=<?php echo $username; ?>",
					method: "POST",
					data: form_data,
					contentType: false,
					cache: false,
					processData: false,
					beforeSend: function () {
						$('#uploaded_image2').html(
							"<img src='../../asset/dist/img/loading.gif' style='max-width: 10%;margin-top: 20px;'>"
						);
					},
					success: function (data) {
						$('#uploaded_image2').html(data);
					}
				});
			}
		});
	});
</script>


<script>
	$(document).ready(function () {
		$(document).on('change', '#file3', function () {
			var name = document.getElementById("file3").files[0].name;
			var uploadField3 = document.getElementById("file3");

			var form_data = new FormData();
			var ext = name.split('.').pop().toLowerCase();

			var allowedFiles = [".doc", ".jpg", ".jpeg", ".ods", ".png", ".txt", ".doc", ".pdf"]
			var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");

			//   if(!regex.test(uploadField3.value.toLowerCase())) 
			//   {
			//    alert("Invalid Image File");
			//   }
			var oFReader = new FileReader();
			oFReader.readAsDataURL(document.getElementById("file3").files[0]);
			var f = document.getElementById("file3").files[0];
			var fsize = f.size || f.fileSize;
			if (!regex.test(uploadField3.value.toLowerCase())) {
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = "File Tidak Diijinkan";
			} else if (fsize > 3145728) {
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = "Dokumen terlalu besar maksimum besar file 3MB";
				return false;
			} else {
				form_data.append("file3", document.getElementById('file3').files[0]);
				$.ajax({
					url: "uploader_dokumen.php<?php echo $getPackage; ?>code=3&token=<?php echo $username; ?>",
					method: "POST",
					data: form_data,
					contentType: false,
					cache: false,
					processData: false,
					beforeSend: function () {
						$('#uploaded_image3').html(
							"<img src='../../asset/dist/img/loading.gif' style='max-width: 10%;margin-top: 20px;'>"
						);
					},
					success: function (data) {
						$('#uploaded_image3').html(data);
					}
				});
			}
		});
	});
</script>





<script>
	$(document).ready(function () {
		$(document).on('change', '#file4', function () {
			var name = document.getElementById("file4").files[0].name;
			var uploadField4 = document.getElementById("file4");

			var form_data = new FormData();
			var ext = name.split('.').pop().toLowerCase();

			var allowedFiles = [".doc", ".jpg", ".jpeg", ".ods", ".png", ".txt", ".doc", ".pdf"]
			var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");

			//   if(!regex.test(uploadField4.value.toLowerCase())) 
			//   {
			//    alert("Invalid Image File");
			//   }
			var oFReader = new FileReader();
			oFReader.readAsDataURL(document.getElementById("file4").files[0]);
			var f = document.getElementById("file4").files[0];
			var fsize = f.size || f.fileSize;
			if (!regex.test(uploadField4.value.toLowerCase())) {
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = "File Tidak Diijinkan";
			} else if (fsize > 4145728) {
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = "Dokumen terlalu besar maksimum besar file 3MB";
				return false;
			} else {
				form_data.append("file4", document.getElementById('file4').files[0]);
				$.ajax({
					url: "uploader_dokumen.php<?php echo $getPackage; ?>code=4&token=<?php echo $username; ?>",
					method: "POST",
					data: form_data,
					contentType: false,
					cache: false,
					processData: false,
					beforeSend: function () {
						$('#uploaded_image4').html(
							"<img src='../../asset/dist/img/loading.gif' style='max-width: 10%;margin-top: 20px;'>"
						);
					},
					success: function (data) {
						$('#uploaded_image4').html(data);
					}
				});
			}
		});
	});
</script>





<script>
	$(document).ready(function () {
		$(document).on('change', '#file5', function () {
			var name = document.getElementById("file5").files[0].name;
			var uploadField4 = document.getElementById("file5");

			var form_data = new FormData();
			var ext = name.split('.').pop().toLowerCase();

			var allowedFiles = [".doc", ".jpg", ".jpeg", ".ods", ".png", ".txt", ".doc", ".pdf"]
			var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");

			//   if(!regex.test(uploadField4.value.toLowerCase())) 
			//   {
			//    alert("Invalid Image File");
			//   }
			var oFReader = new FileReader();
			oFReader.readAsDataURL(document.getElementById("file5").files[0]);
			var f = document.getElementById("file5").files[0];
			var fsize = f.size || f.fileSize;
			if (!regex.test(uploadField4.value.toLowerCase())) {
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = "File Tidak Diijinkan";
			} else if (fsize > 4145728) {
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = "Dokumen terlalu besar maksimum besar file 3MB";
				return false;
			} else {
				form_data.append("file5", document.getElementById('file5').files[0]);
				$.ajax({
					url: "uploader_dokumen.php<?php echo $getPackage; ?>code=5&token=<?php echo $username; ?>",
					method: "POST",
					data: form_data,
					contentType: false,
					cache: false,
					processData: false,
					beforeSend: function () {
						$('#uploaded_image5').html(
							"<img src='../../asset/dist/img/loading.gif' style='max-width: 10%;margin-top: 20px;'>"
						);
					},
					success: function (data) {
						$('#uploaded_image5').html(data);
					}
				});
			}
		});
	});
</script>





<script>
	function removeElement() {
		document.getElementById("imgbox1").style.display = "none";
		document.getElementById("file").value = "";
		document.getElementById("any_file").value = "";
	}

	function removeElement1() {
		document.getElementById("imgbox1a").style.display = "none";
		document.getElementById("file").value = "";
		document.getElementById("any_file").value = "";
	}

	function removeElement2() {
		document.getElementById("imgbox2").style.display = "none";
		document.getElementById("file2").value = "";
		document.getElementById("any_file2").value = "";
	}

	function removeElement2a() {
		document.getElementById("imgbox2a").style.display = "none";
		document.getElementById("file2").value = "";
		document.getElementById("any_file2").value = "";
	}

	function removeElement3() {
		document.getElementById("imgbox3").style.display = "none";
		document.getElementById("file2").value = "";
		document.getElementById("any_file2").value = "";
	}

	function removeElement3a() {
		document.getElementById("imgbox3a").style.display = "none";
		document.getElementById("file3").value = "";
		document.getElementById("any_file3").value = "";
	}

	function removeElement4() {
		document.getElementById("imgbox4").style.display = "none";
		document.getElementById("file4").value = "";
		document.getElementById("any_file4").value = "";
	}

	function removeElement4a() {
		document.getElementById("imgbox4a").style.display = "none";
		document.getElementById("file4").value = "";
		document.getElementById("any_file4").value = "";
	}

	function removeElement5() {
		document.getElementById("imgbox5").style.display = "none";
		document.getElementById("file5").value = "";
		document.getElementById("any_file5").value = "";
	}

	function removeElement5a() {
		document.getElementById("imgbox5a").style.display = "none";
		document.getElementById("file5").value = "";
		document.getElementById("any_file5").value = "";
	}
</script>



<script>
	$(document).ready(function () {
		$('.action_domisili').change(function () {
			if ($(this).val() != '') {
				var action_domisili = $(this).attr("id");
				var query = $(this).val();
				var result = '';
				if (action_domisili == "settlement_curcountry") {
					result = 'settlement_curprovince';
					$('#settlement_curcity').html('<option value="">Select City</option>');
					$('#settlement_curdistrict').html('<option value="">Select District</option>');
					$('#settlement_cursubdistrict').html('<option value="">Select SubDistrict</option>');
				} else if (action_domisili == "settlement_curprovince") {
					result = 'settlement_curcity';
					$('#settlement_curdistrict').html('<option value="">Select District</option>');
					$('#settlement_cursubdistrict').html('<option value="">Select SubDistrict</option>');
				} else if (action_domisili == "settlement_curcity") {
					result = 'settlement_curdistrict';
					$('#settlement_cursubdistrict').html('<option value="">Select SubDistrict</option>');
				} else {
					result = 'settlement_cursubdistrict';
				}
				$.ajax({
					url: "fetching/fetch_dynamic_country_city_state_2.php",
					method: "POST",
					data: {
						action_domisili: action_domisili,
						query: query
					},
					success: function (data) {
						$('#' + result).html(data);
						$('#' + result2).html(data);
					}
				})
			}
		});
	});
</script>
<!-- SECTION ALAMAT SESUAI DOMISILI -->
<!-- SECTION ALAMAT SESUAI DOMISILI -->


<script src="asset/ckeditor.js"></script>
<script src="asset/js/sample.js"></script>
<script src="asset/js/sampleupdate.js"></script>

<script>
	initSample();
	initSampleUpdate();
</script>


<script>
	function openCity(evt, cityName) {
		var i, tabcontent, tablinks;
		tabcontent = document.getElementsByClassName("tabcontent");
		for (i = 0; i < tabcontent.length; i++) {
			tabcontent[i].style.display = "none";
		}
		tablinks = document.getElementsByClassName("tablinks");
		for (i = 0; i < tablinks.length; i++) {
			tablinks[i].className = tablinks[i].className.replace(" active", "");
		}
		document.getElementById(cityName).style.display = "block";
		evt.currentTarget.className += " active";
	}

	// Get the element with id="defaultOpen" and click on it
	document.getElementById("defaultOpen").click();
</script>


<script>
	// Get the button
	let mybutton = document.getElementById("myBtn");

	// When the user scrolls down 20px from the top of the document, show the button
	window.onscroll = function () {
		scrollFunction()
	};

	function scrollFunction() {
		if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
			mybutton.style.display = "block";
		} else {
			mybutton.style.display = "none";
		}
	}

	// When the user clicks on the button, scroll to the top of the document
	function topFunction() {
		document.body.scrollTop = 0;
		document.documentElement.scrollTop = 0;
	}
</script>

<script src="js/source_js.js"></script>