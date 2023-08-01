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
						<th class="fontCustom" style="z-index: 1;vertical-align: ce;vertical-align: middle;" nowrap="nowrap">No.</th>
						<th class="fontCustom" style="z-index: 1;vertical-align: ce;vertical-align: middle;">Code</th>
						<th class="fontCustom" style="z-index: 1;vertical-align: ce;vertical-align: middle;">Name
						</th>
						<th class="fontCustom" style="z-index: 1;vertical-align: ce;vertical-align: middle;">Type
						</th>
						<th class="fontCustom" style="z-index: 1;vertical-align: ce;vertical-align: middle;">PIC
						</th>
						<th class="fontCustom" style="z-index: 1;vertical-align: ce;vertical-align: middle;">Action</th>
					</tr>
				</thead>
			</table>
		</div>
		<div class='card-footer' style='background-color: #eee;height: 37px;padding-top: 5px;'>
		</div>
	</div>
</div>

<!-- data modal add setting provider -->
<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="CreateForm">
	<div class="modal-dialog modal-belakang modal-bg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add Data Setting Provider</h4>
				<a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
					<span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
				</a>
			</div>

			<form class="form-horizontal" action="php_action/FuncDataCreate.php" method="POST" id="FormDisplayCreate">
				<fieldset id="fset_1">
					<legend>Form Data</legend>

					<div class="messages_create"></div>

					<!--FROM SESSION -->
					<input id="inp_emp_no" name="inp_emp_no" type="hidden" value="<?php echo $username; ?>">
					<!--FROM CONFIGURATION -->
					<input id="inp_token" name="inp_token" type="hidden" value="<?php echo $get_token; ?>">

					<div class="form-row">
						<div class="col-4 name">Provider Code <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on"
									id="provider_code" name="provider_code"
									type="Text" value="" size="30"
									maxlength="50"
									style="text-transform:uppercase; width: 80%;"
									validate="NotNull:Invalid Form Entry"
									onchange="formodified(this);" title="">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">Provider Name <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on"
									id="provider_name" name="provider_name"
									type="Text" value="" size="30"
									maxlength="50"
									style="text-transform:uppercase; width: 80%;"
									validate="NotNull:Invalid Form Entry"
									onchange="formodified(this);" title="">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">Provider Type <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<select class="input--style-6" id="provider_type" name="provider_type" style="width: 80%;height: 30px;">
									<option value="">-- Select One --</option>
									<option value="Internal">INTERNAL</option>
									<option value="External">EXTERNAL</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">PIC <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on"
									id="pic" name="pic"
									type="Text" value="" size="30"
									maxlength="50"
									style="text-transform:uppercase;width: 80%;"
									validate="NotNull:Invalid Form Entry"
									onchange="formodified(this);" title="">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">Country <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<select class="input--style-6 provider_country" name="provider_country" style="width: 50%;height: 30px;" id="provider_country">
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
								<select class="input--style-6 provider_state" name="provider_state" style="width: 50%;height: 30px;" id="provider_state">
									<option value="">--Select One--</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">City <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<select class="input--style-6 provider_city" name="provider_city" style="width: 50%;height: 30px;" id="provider_city">
									<option value="">--Select One--</option>
								</select>
							</div>
						</div>
					</div>

					<div class="form-row">
						<div class="col-4 name">Zip Code <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on"
									id="zipcode" name="zipcode"
									type="number" value="" size="30"
									maxlength="5"
									style="text-transform:uppercase;width: 80%;"
									validate="NotNull:Invalid Form Entry"
									onchange="formodified(this);" title="" onKeyPress="if(this.value.length==5) return false;">
							</div>
						</div>
					</div>

					<div class="form-row">
						<div class="col-4 name">Email <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on"
									id="provider_email" name="provider_email"
									type="email" value="" size="30"
									maxlength="70"
									style="width: 80%;"
									validate="NotNull:Invalid Form Entry"
									onchange="formodified(this);" title="">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">Phone <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on"
									id="provider_phone" name="provider_phone"
									type="text" value="" size="30"
									maxlength="13"
									style="text-transform:uppercase;width: 80%;"
									validate="NotNull:Invalid Form Entry"
									onkeypress = "javascript:return isNum(event)"
									onchange="formodified(this);" title="" onKeyPress="if(this.value.length==13) return false;">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">Fax <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on"
									id="provider_fax" name="provider_fax"
									type="Text" value="" size="30"
									maxlength="11"
									onkeypress = "javascript:return isNum(event)"
									style="text-transform:uppercase;width: 80%;"
									validate="NotNull:Invalid Form Entry"
									onchange="formodified(this);" title="" onKeyPress="if(this.value.length==13) return false;">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">Website <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on"
									id="provider_website" name="provider_website"
									type="Text" value="" size="30"
									maxlength="50"
									style="width: 80%;"
									validate="NotNull:Invalid Form Entry"
									onchange="formodified(this);" title="">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">Speciality <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<textarea class="input--style-6" autocomplete="off" autofocus="on"
									id="provider_speciality" name="provider_speciality"
									type="Text" value=""
									style="text-transform:uppercase;width: 80%;"
									validate="NotNull:Invalid Form Entry"
									onchange="formodified(this);" title=""></textarea>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">Address <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<textarea class="input--style-6" autocomplete="off" autofocus="on"
									id="provider_address" name="provider_address"
									type="Text" value=""
									style="text-transform:uppercase;width: 80%;"
									validate="NotNull:Invalid Form Entry"
									onchange="formodified(this);" title=""></textarea>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">Remark <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<textarea class="input--style-6" autocomplete="off" autofocus="on"
									id="provider_remark" name="provider_remark"
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

<!-- edit modal -->
<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="UpdateForm">
	<div class="modal-dialog modal-belakang modal-bg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Edit Setting Provider</h4>
				<a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
					<span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
				</a>
			</div>
			<form class="form-horizontal" action="php_action/FuncDataUpdate.php" method="POST" id="FormDisplayUpdate">
				<fieldset id="fset_1">
					<legend>Form Data</legend>

					<div class="messages_update"></div>
					<!-- <div class="form-row">
						<div class="col-4 name">Provider Code <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group" id="init_provider_code"></div>
						</div>
					</div> -->

					<div class="form-row">
						<div class="col-4 name">Provider Code <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on"
									id="edit_provider_code" name="edit_provider_code"
									type="Text" value="" size="30"
									maxlength="50"
									style="text-transform:uppercase;width: 80%;"
									validate="NotNull:Invalid Form Entry"
									onchange="formodified(this);" title="" readonly>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">Provider Name <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on"
									id="edit_provider_name" name="edit_provider_name"
									type="Text" value="" size="30"
									maxlength="50"
									style="text-transform:uppercase;width: 80%;"
									validate="NotNull:Invalid Form Entry"
									onchange="formodified(this);" title="">
							</div>
						</div>
					</div>
					<!-- <div class="form-row">
						<div class="col-4 name">Provider Type <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on"
									id="edit_provider_type" name="edit_provider_type"
									type="Text" value="" size="30"
									maxlength="50"
									style="text-transform:uppercase;width: 80%;"
									validate="NotNull:Invalid Form Entry"
									onchange="formodified(this);" title="">
							</div>
						</div>
					</div> -->
					<div class="form-row">
						<div class="col-4 name">Provider Type <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<select class="input--style-6" id="edit_provider_type" name="edit_provider_type" style="width: 80%;height: 30px;">
									<option value="Internal">INTERNAL</option>
									<option value="External">EXTERNAL</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">PIC <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on"
									id="edit_pic" name="edit_pic"
									type="Text" value="" size="30"
									maxlength="50"
									style="text-transform:uppercase;width: 80%;"
									validate="NotNull:Invalid Form Entry"
									onchange="formodified(this);" title="">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">Country <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<select class="input--style-6 edit_provider_country" name="edit_provider_country" style="width: 50%;height: 30px;" id="edit_provider_country"></select>
								<input type="hidden" class="form-control" id="valueEditCountryId">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">province <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<select class="input--style-6 edit_provider_state" name="edit_provider_state" style="width: 50%;height: 30px;" id="edit_provider_state"></select>
								<input type="hidden" class="form-control" id="valueEditStateId">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">City <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<select class="input--style-6 edit_provider_city" name="edit_provider_city" style="width: 50%;height: 30px;" id="edit_provider_city"></select>
								<input type="hidden" class="form-control" id="valueEditCityId">
							</div>
						</div>
					</div>

					<div class="form-row">
						<div class="col-4 name">Zip Code <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on"
									id="edit_zipcode" name="edit_zipcode"
									type="number" value="" size="30"
									maxlength="50"
									style="text-transform:uppercase;width: 80%;"
									validate="NotNull:Invalid Form Entry"
									onchange="formodified(this);" title="" onKeyPress="if(this.value.length==5) return false;">
							</div>
						</div>
					</div>

					<div class="form-row">
						<div class="col-4 name">Email <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on"
									id="edit_provider_email" name="edit_provider_email"
									type="email" value="" size="30"
									maxlength="50"
									style="text-transform:uppercase;width: 80%;"
									validate="NotNull:Invalid Form Entry"
									onchange="formodified(this);" title="">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">Phone <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on"
									id="edit_provider_phone" name="edit_provider_phone"
									type="number" value="" size="30"
									maxlength="50"
									style="text-transform:uppercase;width: 80%;"
									validate="NotNull:Invalid Form Entry"
									onchange="formodified(this);" title="" onKeyPress="if(this.value.length==13) return false;">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">Fax <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on"
									id="edit_provider_fax" name="edit_provider_fax"
									type="Text" value="" size="30"
									maxlength="50"
									style="text-transform:uppercase;width: 80%;"
									validate="NotNull:Invalid Form Entry"
									onchange="formodified(this);" title="" onKeyPress="if(this.value.length==13) return false;">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">Website <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<input class="input--style-6" autocomplete="off" autofocus="on"
									id="edit_provider_website" name="edit_provider_website"
									type="Text" value="" size="30"
									maxlength="50"
									style="text-transform:uppercase;width: 80%;"
									validate="NotNull:Invalid Form Entry"
									onchange="formodified(this);" title="">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">Speciality <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<textarea class="input--style-6" autocomplete="off" autofocus="on"
									id="edit_provider_speciality" name="edit_provider_speciality"
									type="Text" value=""
									style="text-transform:uppercase;width: 80%;"
									validate="NotNull:Invalid Form Entry"
									onchange="formodified(this);" title=""></textarea>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">Address <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<textarea class="input--style-6" autocomplete="off" autofocus="on"
									id="edit_provider_address" name="edit_provider_address"
									type="Text" value=""
									style="text-transform:uppercase;width: 80%;"
									validate="NotNull:Invalid Form Entry"
									onchange="formodified(this);" title=""></textarea>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-4 name">Remark <span class="required">*</span></div>
						<div class="col-sm-8">
							<div class="input-group">
								<textarea class="input--style-6" autocomplete="off" autofocus="on"
									id="edit_provider_remark" name="edit_provider_remark"
									type="Text" value=""
									style="text-transform:uppercase;width: 80%;"
									validate="NotNull:Invalid Form Entry"
									onchange="formodified(this);" title=""></textarea>
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
				<input type="hidden" class="form-control input-report" id="del_provider_code" name="del_provider_code" value="">
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
			var provider_name = $('#provider_name').val();
			var provider_type = $('#provider_type').val();
			var pic = $('#pic').val();
			var provider_country = $('#provider_country').val();
			var provider_state = $('#provider_state').val();
			var provider_city = $('#provider_city').val();
			var zipcode = $('#zipcode').val();
			var provider_email = $('#provider_email').val();
			var provider_phone = $('#provider_phone').val();
			var provider_fax = $('#provider_fax').val();
			var provider_website = $('#provider_website').val();
			var provider_speciality = $('#provider_speciality').val();
			var provider_address = $('#provider_address').val();
			var provider_remark = $('#provider_remark').val();
			
			var regex=/^[a-zA-Z]+$/;
		
			if (provider_name == "") {
				modals.style.display ="block";
				document.getElementById("msg").innerHTML = "Provider name cannot empty";
			} else if (provider_type == "") {
				modals.style.display ="block";
				document.getElementById("msg").innerHTML = "Provider type cannot empty";
			} else if (pic == "") {
				modals.style.display ="block";
				document.getElementById("msg").innerHTML = "PIC cannot empty";
			} else if (provider_country == "") {
				modals.style.display ="block";
				document.getElementById("msg").innerHTML = "Provider country cannot empty";
			} else if (provider_state == "") {
				modals.style.display ="block";
				document.getElementById("msg").innerHTML = "Provider state cannot empty";
			} else if (provider_city == "") {
				modals.style.display ="block";
				document.getElementById("msg").innerHTML = "Provider city cannot empty";
			} else if (zipcode == "") {
				modals.style.display ="block";
				document.getElementById("msg").innerHTML = "Provider zipcode cannot empty";
			} else if (provider_email == "") {
				modals.style.display ="block";
				document.getElementById("msg").innerHTML = "Provider email cannot empty";
			} else if (provider_phone == "") {
				modals.style.display ="block";
				document.getElementById("msg").innerHTML = "Provider phone cannot empty";
			} else if (provider_fax == "") {
				modals.style.display ="block";
				document.getElementById("msg").innerHTML = "Provider fax cannot empty";
			} else if (provider_website == "") {
				modals.style.display ="block";
				document.getElementById("msg").innerHTML = "Provider website cannot empty";
			} else if (provider_speciality == "") {
				modals.style.display ="block";
				document.getElementById("msg").innerHTML = "Provider speciality cannot empty";
			} else if (provider_address == "") {
				modals.style.display ="block";
				document.getElementById("msg").innerHTML = "Provider address cannot empty";
			} else if (provider_remark == "") {
				modals.style.display ="block";
				document.getElementById("msg").innerHTML = "Provider remark cannot empty";
			} else {
				$('#submit_add').hide();
				$('#submit_add2').show();
			}

			if (provider_name && provider_type && pic && provider_country && provider_state && provider_city && provider_email && provider_phone && provider_fax && provider_website && provider_speciality && provider_address && provider_remark) {

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
					},
					error: function(xhr, status, error) {
						mymodalss.style.display = "none";
						modals.style.display = "block";
						document.getElementById("msg").innerHTML = xhr.responseJSON.messages;
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
					}
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
		// $("#member_id").remove();

		// fetch the member data
		$.ajax({
			url: 'php_action/getSettingProviderById.php',
			type: 'post',
			data: {
				provider_code: id
			},
			dataType: 'json',

			success: function(response) {
				// document.getElementById("init_provider_code").innerHTML = response.data[0].provider_code;

				$('#edit_provider_code').val(response.data[0].provider_code);
				$('#edit_provider_name').val(response.data[0].provider_name);
				$('#edit_provider_type').val(response.data[0].provider_type);
				$('#edit_pic').val(response.data[0].pic);
				// get and append country data
				$('#valueEditCountryId').val(response.data[0].provider_country);
				$('#edit_provider_country').empty();
				$('#edit_provider_country').append('<option value="'+response.data[0].country_id+'">'+response.data[0].country_name+'</option>')
				$.each(response.data[1], function(i, data) {
					$('#edit_provider_country').append('<option value="'+data.country_id+'">'+data.country_name+'</option>')
				});
				// get state data
				$('#valueEditStateId').val(response.data[0].provider_state);
				$('#edit_provider_state').empty()
				$('#edit_provider_state').append('<option value="'+response.data[0].state_id+'">'+response.data[0].state_name+'</option>');
				// get city data
				$('#valueEditCityId').val(response.data[0].provider_city);
				$('#edit_provider_city').empty()
				$('#edit_provider_city').append('<option value="'+response.data[0].city_id+'">'+response.data[0].city_name+'</option>');
				$('#edit_zipcode').val(response.data[0].zipcode);
				$('#edit_provider_email').val(response.data[0].email);
				$('#edit_provider_phone').val(response.data[0].phone);
				$('#edit_provider_fax').val(response.data[0].fax);
				$('#edit_provider_website').val(response.data[0].web_address);
				$('#edit_provider_speciality').val(response.data[0].speciality);
				$('#edit_provider_address').val(response.data[0].address);
				$('#edit_provider_remark').val(response.data[0].remark);

				// here update the member data
				$("#FormDisplayUpdate").unbind('submit').bind('submit', function() {
					// remove error messages
					$(".text-danger").remove();

					var form = $(this);

					// initial variable
					var edit_provider_code = $('#edit_provider_code').val();
					var edit_provider_name = $('#edit_provider_name').val();
					var edit_provider_type = $('#edit_provider_type').val();
					var edit_pic = $('#edit_pic').val();
					var edit_provider_country = $('#edit_provider_country').val();
					var edit_provider_state = $('#edit_provider_state').val();
					var edit_provider_city = $('#edit_provider_city').val();
					var edit_zipcode = $('#edit_zipcode').val();
					var edit_provider_email = $('#edit_provider_email').val();
					var edit_provider_phone = $('#edit_provider_phone').val();
					var edit_provider_fax = $('#edit_provider_fax').val();
					var edit_provider_website = $('#edit_provider_website').val();
					var edit_provider_speciality = $('#edit_provider_speciality').val();
					var edit_provider_address = $('#edit_provider_address').val();
					var edit_provider_remark = $('#edit_provider_remark').val();

					var regex=/^[a-zA-Z]+$/;

					if (edit_provider_code == "") {
						modals.style.display ="block";
						document.getElementById("msg").innerHTML = "Provider name cannot empty";
					} else if (edit_provider_name == "") {
						modals.style.display ="block";
						document.getElementById("msg").innerHTML = "Provider name cannot empty";
					} else if (edit_provider_type == "") {
						modals.style.display ="block";
						document.getElementById("msg").innerHTML = "Provider type cannot empty";
					} else if (edit_pic == "") {
						modals.style.display ="block";
						document.getElementById("msg").innerHTML = "PIC cannot empty";
					} else if (edit_provider_country == "") {
						modals.style.display ="block";
						document.getElementById("msg").innerHTML = "Provider country cannot empty";
					} else if (edit_provider_state == "") {
						modals.style.display ="block";
						document.getElementById("msg").innerHTML = "Provider state cannot empty";
					} else if (edit_provider_city == "") {
						modals.style.display ="block";
						document.getElementById("msg").innerHTML = "Provider city cannot empty";
					} else if (edit_zipcode == "") {
						modals.style.display ="block";
						document.getElementById("msg").innerHTML = "Provider zipcode cannot empty";
					} else if (edit_provider_email == "") {
						modals.style.display ="block";
						document.getElementById("msg").innerHTML = "Provider email cannot empty";
					} else if (edit_provider_phone == "") {
						modals.style.display ="block";
						document.getElementById("msg").innerHTML = "Provider phone cannot empty";
					} else if (edit_provider_fax == "") {
						modals.style.display ="block";
						document.getElementById("msg").innerHTML = "Provider fax cannot empty";
					} else if (edit_provider_website == "") {
						modals.style.display ="block";
						document.getElementById("msg").innerHTML = "Provider website cannot empty";
					} else if (edit_provider_speciality == "") {
						modals.style.display ="block";
						document.getElementById("msg").innerHTML = "Provider speciality cannot empty";
					} else if (edit_provider_address == "") {
						modals.style.display ="block";
						document.getElementById("msg").innerHTML = "Provider address cannot empty";
					} else if (edit_provider_remark == "") {
						modals.style.display ="block";
						document.getElementById("msg").innerHTML = "Provider remark cannot empty";
					} else {
							$('#submit_update').hide();
							$('#submit_update2').show();
					}
					if (edit_provider_code && edit_provider_name && edit_provider_type && edit_pic && edit_provider_country && edit_provider_state && edit_provider_city && edit_zipcode && edit_provider_email && edit_provider_phone && edit_provider_fax && edit_provider_website && edit_provider_speciality && edit_provider_address && edit_provider_remark) {
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

// validate number only
function isNum(evt){
	var charCode=(evt.which)?evt.which:event.keyCode
	if(charCode>31 && (charCode<48 || charCode>57)){
		return false;
	}
	else{
		return true;
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
			console.log(response.data[0].provider_code)
			$("#del_provider_code").val(response.data[0].provider_code);

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
					// document.getElementById("msg").innerHTML = "Provider Code cannot empty";
					document.getElementById("msg").innerHTML = "Cannot delete the provider, please contact HRD";
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

<!-- onchange data dropdown provider_country -->
<script>
	// for select 2 create
	$('.provider_country').select2({
		dropdownParent: $('#CreateForm')
	});
	$('.provider_state').select2({
		dropdownParent: $('#CreateForm')
	});
	$('.provider_city').select2({
		dropdownParent: $('#CreateForm')
	});

	// for form create
	$('#provider_state').prop('disabled', true)
	$('#provider_city').prop('disabled', true)

	$('#provider_country').on('change', () => {
		$('#provider_state').prop('disabled', false)
		$('#provider_city').prop('disabled', true)
		$('#provider_city').empty()
		$('#provider_city').append('<option value="">select a province first</option>')
		get_state()
	})
	$('#provider_state').on('change', () => {
		$('#provider_city').prop('disabled', false)
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
				'provider_country': $('#provider_country').val()
			},
			success: function(response) {
				$('#provider_state').empty();
				$('#provider_state').append('<option value="">select a state first</option>');
				
				$.each(response.data, function(i, data) {
					$('#provider_state').append('<option value="'+data.state_id+'">' + data.state_name +'</option>')
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
				'provider_state': $('#provider_state').val()
			},
			success: function(response) {
				$('#provider_city').empty(),
				$('#provider_city').append('<option value="">select a city</option>');
				
				$.each(response.data, function(i, data) {
					$('#provider_city').append('<option value="'+data.city_id+'">' + data.city_name +'</option>')
				})
			}
		})
	}

	// for select 2 edit
	$('.edit_provider_country').select2({
		dropdownParent: $('#UpdateForm')
	});
	$('.edit_provider_state').select2({
		dropdownParent: $('#UpdateForm')
	});
	$('.edit_provider_city').select2({
		dropdownParent: $('#UpdateForm')
	});
	
	// for create
	$('#edit_provider_state').prop('disabled', true)
	$('#edit_provider_city').prop('disabled', true)

	// for form edit
	$('#edit_provider_country').on('change', () => {
		$('#edit_provider_state').prop('disabled', false)
		$('#edit_provider_city').prop('disabled', true)
		$('#edit_provider_city').empty()
		$('#edit_provider_city').append('<option value="">select a province first</option>')
		edit_state()
	})
	$('#edit_provider_state').on('change', () => {
		$('#edit_provider_city').prop('disabled', false)
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
				'provider_country': $('#edit_provider_country').val()
			},
			success: function(response) {
				$('#edit_provider_state').empty();
				$('#edit_provider_state').append('<option value="">select a state first</option>');
				
				$.each(response.data, function(i, data) {
					$('#edit_provider_state').append('<option value="'+data.state_id+'">' + data.state_name +'</option>')
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
				'provider_state': $('#edit_provider_state').val()
			},
			success: function(response) {
				$('#edit_provider_city').empty(),
				$('#edit_provider_city').append('<option value="">select a city</option>');
				
				$.each(response.data, function(i, data) {
					$('#edit_provider_city').append('<option value="'+data.city_id+'">' + data.city_name +'</option>')
				})
			}
		})
	}

</script>