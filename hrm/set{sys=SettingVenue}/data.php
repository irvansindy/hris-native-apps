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
			<h4 class="card-title mb-0">Data Setting Provider</h4>
			<div class="card-actions ml-auto">
				<table>
					<!-- <td>
						<form action="../rfid=repository/cli_Template_Download/st/StFunctionDownload.php" method="GET">
							<input type="hidden" name="filedata" value="StDownloadGTTGROvertimeReasonData.php">
							<input type="hidden" name="filename" value="OvertimeReason">
							<input type="hidden" name="src_reason_code" value="<?php echo $src_reason_code; ?>">
							<input type="hidden" name="src_reason_name_en" value="<?php echo $src_reason_name_en; ?>">
						</form>
					</td> -->
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
                        <th class="fontCustom" style="z-index: 1;">Venue Code</th>
                        <th class="fontCustom" style="z-index: 1;">Venue Name</th>
                        <th class="fontCustom" style="z-index: 1;">Venue Type</th>
                        <th class="fontCustom" style="z-index: 1;">Phone</th>
                        <th class="fontCustom" style="z-index: 1;">Fax</th>
                    </tr>
				</thead>
			</table>
		</div>
		<div class='card-footer' style='background-color: #eee;height: 37px;padding-top: 5px;'>
		</div>
	</div>
</div>

<!-- data modal add setting venue -->
<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="CreateForm">
	<div class="modal-dialog modal-belakang modal-bg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add Data Setting Venue</h4>
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
						<div class="col-4 name">Venue Code <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">

								<input class="input--style-6" autocomplete="off" autofocus="on" id="input_venue_code"
									name="input_venue_code" type="Text" value="" onfocus="hlentry(this)" size="30"
									maxlength="50" style="text-transform:uppercase;width: 60%;"
									validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
							</div>
						</div>
					</div>

					<div class="form-row">
						<div class="col-4 name">Venue Name <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on" id="input_venue_name"
									name="input_venue_name" type="Text" value="" onfocus="hlentry(this)" size="30"
									maxlength="50" style="text-transform:uppercase;width: 60%;"
									validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">Venue Type <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="input_venue_type" name="input_venue_type" value="INTERNAL">
									<label class="form-check-label">Internal</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="input_venue_type" name="input_venue_type" value="EXTERNAL">
									<label class="form-check-label">External</label>
								</div>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">Venue Room <span class="required">*</span></div>
						<div class="col-lg-8">
							<div class="form-group">
								<div class="col-lg-3">
									<input class="input--style-6"
										autocomplete="off" id="input_venue_room_code" name="input_venue_room_code[]" type="Text" value="" title="" placeholder="Room Code">
								</div>
								<div class="col-lg-3">
									<input class="input--style-6"
										autocomplete="off" id="input_venue_room_name" name="input_venue_room_name[]" type="Text" value="" title="" placeholder="Room Name">
								</div>
								<div class="col-lg-3">
								<button class="btn btn-primary btn-sm" id="add_room" type="button">
									<i class="fa-solid fa-plus"></i>
								</button>
								</div>
							</div>
						</div>
					</div>
					<div class="dynamic_venue_room"></div>
					<div class="form-row">
						<div class="col-4 name">Venue Address <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<textarea class="input--style-6" autocomplete="off" autofocus="on"
									id="input_venue_address" name="input_venue_address"
									type="Text" value=""
									style="text-transform:uppercase;width: 60%;"
									validate="NotNull:Invalid Form Entry"
									onchange="formodified(this);" title=""></textarea>
							</div>
						</div>
					</div>

					
					<div class="form-row">
						<div class="col-4 name">Country <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<select class="input--style-6 input_venue_country" name="input_venue_country" style="width: 50%;height: 30px;" id="input_venue_country">
									<option value="">--Select One--</option>
									<?php
										$queryCountry = mysqli_query($connect, "SELECT * FROM hrmcountry ORDER BY country_name ASC");
										while ($country = mysqli_fetch_array($queryCountry)) {
											echo '<option value="' . $country['country_id'] . '">' . $country['country_name'] . '</option>';
										}
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">province <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<select class="input--style-6 input_venue_state" name="input_venue_state" style="width: 50%;height: 30px;" id="input_venue_state">
									<option value="">--Select One--</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">City <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<select class="input--style-6 input_venue_city" name="input_venue_city" style="width: 50%;height: 30px;" id="input_venue_city">
									<option value="">--Select One--</option>
								</select>
							</div>
						</div>
					</div>

					<div class="form-row">
						<div class="col-4 name">Postal Code <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on"
									id="input_venue_postal_code" name="input_venue_postal_code"
									type="number" value="" size="30"
									maxlength="50"
									style="text-transform:uppercase;width: 80%;"
									validate="NotNull:Invalid Form Entry"
									onchange="formodified(this);" title=""
									pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==5) return false;">
							</div>
						</div>
					</div>
					
					<div class="form-row">
						<div class="col-4 name">Phone <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on"
									id="input_venue_phone" name="input_venue_phone"
									type="number" value="" size="30"
									maxlength="50"
									style="text-transform:uppercase;width: 80%;"
									validate="NotNull:Invalid Form Entry"
									onchange="formodified(this);" title=""
									pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==13) return false;">
							</div>
						</div>
					</div>

					<div class="form-row">
						<div class="col-4 name">Fax <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on"
									id="input_venue_fax" name="input_venue_fax"
									type="number" value="" size="30"
									maxlength="50"
									style="text-transform:uppercase;width: 80%;"
									validate="NotNull:Invalid Form Entry"
									onchange="formodified(this);" title=""
									pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==13) return false;">
							</div>
						</div>
					</div>
					
					<div class="form-row">
						<div class="col-4 name">Remark <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<textarea class="input--style-6" autocomplete="off" autofocus="on"
								id="input_venue_remark" name="input_venue_remark"
								type="Text" value=""
								style="text-transform:uppercase;width: 80%;"
								validate="NotNull:Invalid Form Entry"
								onchange="formodified(this);" title=""></textarea>
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

<!-- data modal edit setting venue -->
<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="UpdateForm">
	<div class="modal-dialog modal-belakang modal-bg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Edit Data Setting Venue</h4>
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
						<div class="col-4 name">Venue Code <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group" id="init_venue_code"></div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">Venue Code <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">

								<input class="input--style-6" autocomplete="off" autofocus="on" id="edit_venue_code"
									name="edit_venue_code" type="Text" value="" onfocus="hlentry(this)" size="30"
									maxlength="50" style="text-transform:uppercase;width: 60%;"
									validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
							</div>
						</div>
					</div>

					<div class="form-row">
						<div class="col-4 name">Venue Name <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on" id="edit_venue_name"
									name="edit_venue_name" type="Text" value="" onfocus="hlentry(this)" size="30"
									maxlength="50" style="text-transform:uppercase;width: 60%;"
									validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">Venue Type <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="edit_venue_type" name="edit_venue_type" value="INTERNAL">
									<label class="form-check-label">Internal</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="edit_venue_type" name="edit_venue_type" value="EXTERNAL">
									<label class="form-check-label">External</label>
								</div>
							</div>
						</div>
					</div>
					<div class="edit_venue_room"></div>
					<div class="dynamic_edit_venue_room"></div>
					<div class="form-row">
						<div class="col-4 name">Venue Address <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<textarea class="input--style-6" autocomplete="off" autofocus="on"
									id="edit_venue_address" name="edit_venue_address"
									type="Text" value=""
									style="text-transform:uppercase;width: 60%;"
									validate="NotNull:Invalid Form Entry"
									onchange="formodified(this);" title=""></textarea>
							</div>
						</div>
					</div>
					
					<div class="form-row">
						<div class="col-4 name">Country <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<select class="input--style-6 edit_venue_country" name="edit_venue_country" style="width: 50%;height: 30px;" id="edit_venue_country">
									<option value="">--Select One--</option>
									<?php
										$queryCountry = mysqli_query($connect, "SELECT * FROM hrmcountry ORDER BY country_name ASC");
										while ($country = mysqli_fetch_array($queryCountry)) {
											echo '<option value="' . $country['country_id'] . '">' . $country['country_name'] . '</option>';
										}
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">province <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<select class="input--style-6 edit_venue_state" name="edit_venue_state" style="width: 50%;height: 30px;" id="edit_venue_state">
									<option value="">--Select One--</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">City <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<select class="input--style-6 edit_venue_city" name="edit_venue_city" style="width: 50%;height: 30px;" id="edit_venue_city">
									<option value="">--Select One--</option>
								</select>
							</div>
						</div>
					</div>

					<div class="form-row">
						<div class="col-4 name">Postal Code <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on"
									id="edit_venue_postal_code" name="edit_venue_postal_code"
									type="number" value="" size="30"
									maxlength="50"
									style="text-transform:uppercase;width: 80%;"
									validate="NotNull:Invalid Form Entry"
									onchange="formodified(this);" title=""
									pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==5) return false;">
							</div>
						</div>
					</div>
					
					<div class="form-row">
						<div class="col-4 name">Phone <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on"
									id="edit_venue_phone" name="edit_venue_phone"
									type="number" value="" size="30"
									maxlength="50"
									style="text-transform:uppercase;width: 80%;"
									validate="NotNull:Invalid Form Entry"
									onchange="formodified(this);" title=""
									pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==13) return false;">
							</div>
						</div>
					</div>

					<div class="form-row">
						<div class="col-4 name">Fax <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on"
									id="edit_venue_fax" name="edit_venue_fax"
									type="number" value="" size="30"
									maxlength="50"
									style="text-transform:uppercase;width: 80%;"
									validate="NotNull:Invalid Form Entry"
									onchange="formodified(this);" title=""
									pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==13) return false;">
							</div>
						</div>
					</div>
					
					<div class="form-row">
						<div class="col-4 name">Remark <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<textarea class="input--style-6" autocomplete="off" autofocus="on"
								id="edit_venue_remark" name="edit_venue_remark"
								type="Text" value=""
								style="text-transform:uppercase;width: 80%;"
								validate="NotNull:Invalid Form Entry"
								onchange="formodified(this);" title=""></textarea>
							</div>
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
				<input type="hidden" class="form-control input-report" id="del_provider_code" name="provider_code" placeholder="">
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
		// reset the form 
		$("#FormDisplayCreate")[0].reset();
		// empty the message div

		$(".messages_create").html("");

		// submit form
		$("#FormDisplayCreate").unbind('submit').bind('submit', function() {

			$(".text-danger").remove();

			var form = $(this);

			// initial variable
			var inp_emp_no = $("#inp_emp_no").val();
			var input_venue_code = $("#input_venue_code").val();
			var input_venue_name = $("#input_venue_name").val();
			var input_venue_type = $("#input_venue_type").val();
			var input_venue_room_code = [];
			var input_venue_room_name = [];
			var input_venue_address = $("#input_venue_address").val();
			var input_venue_country = $("#input_venue_country").val();
			var input_venue_state = $("#input_venue_state").val();
			var input_venue_city = $("#input_venue_city").val();
			var input_venue_postal_code = $("#input_venue_postal_code").val();
			var input_venue_phone = $("#input_venue_phone").val();
			var input_venue_fax = $("#input_venue_fax").val();
			var input_venue_remark = $("#input_venue_remark").val();

			var regex=/^[a-zA-Z]+$/;

			if (input_venue_code == "") {
				modals.style.display ="block";
				document.getElementById("msg").innerHTML = "Venue Code cannot empty";
				return false;
			} else if (input_venue_name == "") {
				modals.style.display ="block";
				document.getElementById("msg").innerHTML = "Venue Name cannot empty";
				return false;
			} else if (input_venue_type == "") {
				modals.style.display ="block";
				document.getElementById("msg").innerHTML = "Venue Type cannot empty";
				return false;
			} else if (input_venue_address == "") {
				modals.style.display ="block";
				document.getElementById("msg").innerHTML = "Venue Address cannot empty";
				return false;
			} else if (input_venue_country == "") {
				modals.style.display ="block";
				document.getElementById("msg").innerHTML = "Venue Country cannot empty";
				return false;
			} else if (input_venue_state == "") {
				modals.style.display ="block";
				document.getElementById("msg").innerHTML = "Venue State / Province cannot empty";
				return false;
			} else if (input_venue_city == "") {
				modals.style.display ="block";
				document.getElementById("msg").innerHTML = "Venue City cannot empty";
				return false;
			} else if (input_venue_postal_code == "") {
				modals.style.display ="block";
				document.getElementById("msg").innerHTML = "Venue Postal Code cannot empty";
				return false;
			} else if (input_venue_phone == "") {
				modals.style.display ="block";
				document.getElementById("msg").innerHTML = "Venue Phone cannot empty";
				return false;
			} else if (input_venue_fax == "") {
				modals.style.display ="block";
				document.getElementById("msg").innerHTML = "Venue Fax cannot empty";
				return false;
			} else if (input_venue_remark == "") {
				modals.style.display ="block";
				document.getElementById("msg").innerHTML = "Venue Remark cannot empty";
				return false;
			} else {
				$('#submit_add').hide();
				$('#submit_add2').show();
			}

			if (input_venue_code && input_venue_name && input_venue_type && input_venue_address && input_venue_country && input_venue_state && input_venue_city && input_venue_postal_code && input_venue_phone && input_venue_fax && input_venue_remark) {

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
					} // success  
				}); // ajax subit 				
			} /// if
			return false;
		}); // /submit form for create member
	}); // /add modal
});

function updateVenue(id = null) {
	if (id) {
		// remove the error 
		$(".form-group").removeClass('has-error').removeClass('has-success');
		$(".text-danger").remove();
		// empty the message div
		$(".messages_update").html("");

		// fetch the member data
		$.ajax({
			url: 'php_action/getDataSettingVenueById.php',
			type: 'post',
			data: {
				venue_code: id
			},
			dataType: 'json',

			success: function(response) {
				document.getElementById("init_venue_code").innerHTML = response.master.venue_code;

				$('#edit_venue_code').val(response.master.venue_code);
				$('#edit_venue_name').val(response.master.venue_name);
				// $('#edit_venue_type').val(response.master.venue_type);
				$('#edit_venue_address').val(response.master.venue_address);
				$('#edit_venue_postal_code').val(response.master.venue_zipcode);
				$('#edit_venue_phone').val(response.master.venue_phone);
				$('#edit_venue_fax').val(response.master.venue_fax);
				$('#edit_venue_remark').val(response.master.remark);
				
				// looping venue room by data
				$('.edit_venue_room').empty();
				$.each(response.detail, (i, data) => {
					// dynamic form edit venue room and venue
					$('.edit_venue_room').append(
						`<div class="form-row array_edit_venue_room">
						<div class="col-4 name">
							${i == 0 ? `Venue Room <span class="required">*</span>` : ``}
						</div>
						<div class="col-lg-8">
							<div class="form-group">
								<div class="col-lg-3">
									<input class="input--style-6"
										autocomplete="off" id="edit_venue_room_code" name="edit_venue_room_code[]" type="Text" value="`+data.room_code+`" title="" placeholder="Room Code">
								</div>
								<div class="col-lg-3">
									<input class="input--style-6"
										autocomplete="off" id="edit_venue_room_name" name="edit_venue_room_name[]" type="Text" value="`+data.room_name+`" title="" placeholder="Room Name">
								</div>
								<div class="col-lg-3">
								${i == 0 ? 
									`<button class="btn btn-primary btn-sm" id="add_edit_room" type="button">
									<i class="fa-solid fa-plus"></i>
								</button>` : `<button class="btn btn-danger btn-sm" id="btn_pop_edit_room" type="button">
									<i class="fa-solid fa-minus"></i>
								</button>`}
								</div>
							</div>
						</div>
					</div>`
					);
				});

				// add dynamic form venue room
				$('#add_edit_room').on('click', () => {
					$('.dynamic_edit_venue_room').append(
						`<div class="form-row array_edit_venue_room">
						<div class="col-4 name">
							
						</div>
						<div class="col-lg-8">
							<div class="form-group">
								<div class="col-lg-3">
									<input class="input--style-6"
										autocomplete="off" id="edit_venue_room_code" name="edit_venue_room_code[]" type="Text" value="" title="" placeholder="Room Code">
								</div>
								<div class="col-lg-3">
									<input class="input--style-6"
										autocomplete="off" id="edit_venue_room_name" name="edit_venue_room_name[]" type="Text" value="" title="" placeholder="Room Name">
								</div>
								<div class="col-lg-3">
									<button class="btn btn-danger btn-sm" id="btn_pop_edit_room" type="button">
										<i class="fa-solid fa-minus"></i>
									</button>
								</div>
							</div>
						</div>
					</div>`
					);
				});

				// delete dynamic form venue room
				$(document).on('click', '#btn_pop_edit_room', function () {
					$(this).closest('.array_edit_venue_room').remove();
				});

				// validate checkbox venue type
				$('input[type=checkbox]').on('change', function(evt) {
					if($('input[id=edit_venue_type]:checked').length > 1) {
						this.checked = false;
						mymodalss.style.display = "none";
						modals.style.display = "block";
						document.getElementById("msg").innerHTML =
						"Can only choose one type";
						return false;
					}
				});
				// here update the member data
				$("#FormDisplayUpdate").unbind('submit').bind('submit', function() {
					// remove error messages
					$(".text-danger").remove();

					var form = $(this);

					// initial variable
					var edit_emp_no = $('#edit_emp_no').val();
					var edit_venue_code = $('#edit_venue_code').val();
					var edit_venue_name = $('#edit_venue_name').val();
					var edit_venue_type = $('#edit_venue_type').val();
					var edit_venue_room_code = [];
					var edit_venue_room_name = [];
					var edit_venue_address = $('#edit_venue_address').val();
					var edit_venue_country = $('#edit_venue_country').val();
					var edit_venue_state = $('#edit_venue_state').val();
					var edit_venue_city = $('#edit_venue_city').val();
					var edit_venue_postal_code = $('#edit_venue_postal_code').val();
					var edit_venue_phone = $('#edit_venue_phone').val();
					var edit_venue_fax = $('#edit_venue_fax').val();
					var edit_venue_remark = $('#edit_venue_remark').val();

					var regex=/^[a-zA-Z]+$/;

					if (edit_venue_name == "") {
						modals.style.display ="block";
						document.getElementById("msg").innerHTML = "Venue name cannot empty";
					} else if (edit_venue_type == "") {
						modals.style.display ="block";
						document.getElementById("msg").innerHTML = "Venue type cannot empty";
					} else if (edit_venue_address == "") {
						modals.style.display ="block";
						document.getElementById("msg").innerHTML = "Venue address cannot empty";
					} else if (edit_venue_country == "") {
						modals.style.display ="block";
						document.getElementById("msg").innerHTML = "Venue country cannot empty";
					} else if (edit_venue_state == "") {
						modals.style.display ="block";
						document.getElementById("msg").innerHTML = "Venue state cannot empty";
					} else if (edit_venue_city == "") {
						modals.style.display ="block";
						document.getElementById("msg").innerHTML = "Venue city cannot empty";
					} else if (edit_venue_postal_code == "") {
						modals.style.display ="block";
						document.getElementById("msg").innerHTML = "Venue Postal Code cannot empty";
					} else if (edit_venue_phone == "") {
						modals.style.display ="block";
						document.getElementById("msg").innerHTML = "Venue Phone cannot empty";
					} else if (edit_venue_fax == "") {
						modals.style.display ="block";
						document.getElementById("msg").innerHTML = "Venue Fax cannot empty";
					} else if (edit_venue_remark == "") {
						modals.style.display ="block";
						document.getElementById("msg").innerHTML = "Venue remark cannot empty";
					} else {
							$('#submit_update').hide();
							$('#submit_update2').show();
					}
					if (edit_venue_name && edit_venue_type && edit_venue_address && edit_venue_country && edit_venue_state && edit_venue_city && edit_venue_postal_code && edit_venue_phone && edit_venue_fax && edit_venue_remark) {
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
		url: 'php_action/getSettingProviderById.php',
		type: 'post',
		data: {
			provider_code: id
		},
		dataType: 'json',
		success:function(response) {

			$("#del_provider_code").val(response.provider_code);

			// mmeber id 
			$(".FormDisplayDelete").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');

			// here update the member data
			$("#updatedelMemberForm").unbind('submit').bind('submit', function() {
				// remove error messages
				$(".text-danger").remove();

				var form = $(this);

				// validation
				var del_provider_code = $("#del_provider_code").val();

				if(del_provider_code == "") {
					modals.style.display ="block";
					document.getElementById("msg").innerHTML = "Shiftgroup schedule code cannot empty";
				} else {
					$('#submit_delete').hide();
					$('#submit_delete2').show();
				}

				if(del_provider_code) {
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

<!-- onchange data dropdown country -->
<script>
	// validate checkbox venue type
    $('input[type=checkbox]').on('change', function(evt) {
    if($('input[id=input_venue_type]:checked').length > 1) {
        this.checked = false;
        // alert('can only choose one type');
        mymodalss.style.display = "none";
        modals.style.display = "block";
        document.getElementById("msg").innerHTML =
        "Can only choose one type";
        return false;
    }
    });

    $('#add_room').on('click', function() {
        $('.dynamic_venue_room').append(
            `<div class="form-row array_venue_room" id="frm_employee_no">
                <div class="col-lg-4 name"></div>
                <div class="col-lg-8">
                    <div class="form-group">
                        <div class="col-lg-3">
                            <input class="input--style-6"
                                autocomplete="off" id="input_venue_room_code" name="input_venue_room_code[]" type="Text" value="" title="" placeholder="Room Code">
                        </div>
                        <div class="col-lg-3">
                            <input class="input--style-6"
                                autocomplete="off" id="input_venue_room_name" name="input_venue_room_name[]" type="Text" value="" title="" placeholder="Room Name">
                        </div>
                        <div class="col-lg-3">
                        <button class="btn btn-danger btn-sm" id="btn_pop_room" type="button">
                            <i class="fa-solid fa-minus"></i>
                        </button>
                        </div>
                    </div>
                </div>
            </div>`
        );
    });

    // delete dynamic form venue room
    $(document).on('click', '#btn_pop_room', function () {
        $(this).closest('.array_venue_room').remove();
    });

	// for select 2 create
	$('.input_venue_country').select2({
		dropdownParent: $('#CreateForm')
	});
	$('.input_venue_state').select2({
		dropdownParent: $('#CreateForm')
	});
	$('.input_venue_city').select2({
		dropdownParent: $('#CreateForm')
	});

	// for form create
	$('#input_venue_state').prop('disabled', true)
	$('#input_venue_city').prop('disabled', true)

	$('#input_venue_country').on('change', () => {
		$('#input_venue_state').prop('disabled', false)
		$('#input_venue_city').prop('disabled', true)
		$('#input_venue_city').empty()
		$('#input_venue_city').append('<option value="">select a province first</option>')
		get_state()
	})
	$('#input_venue_state').on('change', () => {
		$('#input_venue_city').prop('disabled', false)
		get_city()
	})

	// for form create
	function get_state() {
		$.ajax({
			url: 'php_action/getDataState.php',
			type: "get",
            dataType: 'json',
            async: true,
			data: {
				'venue_country': $('#input_venue_country').val()
			},
			success: function(response) {
				$('#input_venue_state').empty();
				$('#input_venue_state').append('<option value="">select a state first</option>');
				
				$.each(response.data, function(i, data) {
					$('#input_venue_state').append('<option value="'+data.state_id+'">' + data.state_name +'</option>')
				})
			}
		})
	}

	function get_city() {
		$.ajax({
			url: 'php_action/getDataCity.php',
			type: "get",
			dataType: 'json',
			async: true,
			data: {
				'venue_state': $('#input_venue_state').val()
			},
			success: function(response) {
				$('#input_venue_city').empty(),
				$('#input_venue_city').append('<option value="">select a city</option>');
				
				$.each(response.data, function(i, data) {
					$('#input_venue_city').append('<option value="'+data.city_id+'">' + data.city_name +'</option>')
				})
			}
		})
	}

	// for select 2 edit
	$('.edit_venue_country').select2({
		dropdownParent: $('#UpdateForm')
	});
	$('.edit_venue_state').select2({
		dropdownParent: $('#UpdateForm')
	});
	$('.edit_venue_city').select2({
		dropdownParent: $('#UpdateForm')
	});
	
	// for edit
	$('#edit_venue_state').prop('disabled', true)
	$('#edit_venue_city').prop('disabled', true)

	// for form edit
	$('#edit_venue_country').on('change', () => {
		$('#edit_venue_state').prop('disabled', false)
		$('#edit_venue_city').prop('disabled', true)
		$('#edit_venue_city').empty()
		$('#edit_venue_city').append('<option value="">select a province first</option>')
		edit_state()
	})
	$('#edit_venue_state').on('change', () => {
		$('#edit_venue_city').prop('disabled', false)
		edit_city()
	})	

	// for form edit
	function edit_state() {
		$.ajax({
			url: 'php_action/getDataState.php',
			type: "get",
            dataType: 'json',
            async: true,
			data: {
				'venue_country': $('#edit_venue_country').val()
			},
			success: function(response) {
				$('#edit_venue_state').empty();
				$('#edit_venue_state').append('<option value="">select a state first</option>');
				
				$.each(response.data, function(i, data) {
					$('#edit_venue_state').append('<option value="'+data.state_id+'">' + data.state_name +'</option>')
				})
			}
		})
	}

	function edit_city() {
		$.ajax({
			url: 'php_action/getDataCity.php',
			type: "get",
			dataType: 'json',
			async: true,
			data: {
				'venue_state': $('#edit_venue_state').val()
			},
			success: function(response) {
				$('#edit_venue_city').empty(),
				$('#edit_venue_city').append('<option value="">select a city</option>');
				
				$.each(response.data, function(i, data) {
					$('#edit_venue_city').append('<option value="'+data.city_id+'">' + data.city_name +'</option>')
				})
			}
		})
	}

	$('#close_edit_form_venue').on('click', (e) => {
		$(this).find('#UpdateForm')[0].clear();

	})

	// $('#UpdateForm').on('hidden.bs.modal', function(e) {
	// 	$(this).find('#edit_form_venue')[0].reset();
	// });

</script>