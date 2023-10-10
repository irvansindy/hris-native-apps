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

<!-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- svg-percent-chart -->
<link rel="stylesheet" href="source_js/svg-percent-chart/percent-chart.css"/>
<script src="source_js/svg-percent-chart/percent-chart.js"></script>

<!-- select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- data list card -->
<div class="container-fluid overflow-auto mt-5">
<!-- style="width: 100vw;height: 80vh; width: 98%; margin-right: 5px;overflow: scroll;overflow-x: hidden;margin-top: 17px;" -->
	<div class="row mx-auto applicant">
        
    </div>
	<!-- dummy pagination -->
	<!-- <div id="data-container"></div>
	<div id="pagination-container"></div> -->
</div>
<!-- detail applicant data modal -->
<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="detail_data_applicant">
	<div class="modal-dialog modal-belakang modal-bg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Detail Applicant Data</h4>
				<a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close"
					style="margin-top: -15px;">
					<span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
				</a>
			</div>

			<form class="form-horizontal" action="" method="POST" id="form_detail_data_applicant">

				<div class="card-body table-responsive p-0"
						style="width: 100vw;height: auto%; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

						<fieldset id="fset_1">
							<legend id="detail_vacancy_id"></legend>

							<div class="messages_update"></div>

							<input id="detail_emp_no" name="detail_emp_no" type="hidden" value="<?php echo $username; ?>">
							<input id="detail_request_no" name="detail_request_no" type="hidden" value="">

							<!--FROM SESSION -->
							<input id="sel_token" name="sel_token" type="hidden" value="<?php echo $get_token; ?>">
							<!--FROM CONFIGURATION -->
							<div class="row">
								<div class="col-lg">
									<div class="form-row">
										<div class="col-sm-4 name"> Full Name <span class="required">*</span></div>
										<div class="col-sm-8 name">
											<div class="input-group" id="detail_full_name"
												style="font-weight: bold;color: #5b5b5b;">
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="col-sm-4 name"> Gender <span class="required">*</span></div>
										<div class="col-sm-8 name">
											<div class="input-group" id="detail_gender"
												style="font-weight: bold;color: #5b5b5b;">
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="col-sm-4 name"> Phone <span class="required">*</span></div>
										<div class="col-sm-8 name">
											<div class="input-group" id="detail_phone"
												style="font-weight: bold;color: #5b5b5b;">
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="col-sm-4 name"> Email <span class="required">*</span></div>
										<div class="col-sm-8 name">
											<div class="input-group" id="detail_email"
												style="font-weight: bold;color: #5b5b5b;">
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg">
									<div class="form-row">
										<div class="col-sm-4 name"> Birth Place & Date <span class="required">*</span></div>
										<div class="col-sm-8 name">
											<div class="input-group" id="detail_birthplace_birthdate"
												style="font-weight: bold;color: #5b5b5b;">
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="col-sm-4 name"> Status <span class="required">*</span></div>
										<div class="col-sm-8 name">
											<div class="input-group" id="detail_maritalstatus"
												style="font-weight: bold;color: #5b5b5b;">
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="col-sm-4 name"> Religion <span class="required">*</span></div>
										<div class="col-sm-8 name">
											<div class="input-group" id="detail_religion"
												style="font-weight: bold;color: #5b5b5b;">
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="col-sm-4 name"> Address <span class="required">*</span></div>
										<div class="col-sm-8 name">
											<div class="input-group" id="detail_address"
												style="font-weight: bold;color: #5b5b5b;">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="mt-3">
								<ul class="nav nav-tabs" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" href="#detail_tab_experience" role="tab" data-toggle="tab">Experiences</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#detail_tab_education" role="tab" data-toggle="tab">Educations</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#detail_tab_skill" role="tab" data-toggle="tab">Skills</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#detail_tab_training_achievement" role="tab" data-toggle="tab">Training & Achievement</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#detail_tab_family" role="tab" data-toggle="tab">Family</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#detail_tab_application_status" role="tab" data-toggle="tab">Application Status</a>
									</li>
								</ul>

								<!-- Tab panes -->
								<div class="tab-content mt-4">
									<div role="tabpanel" class="tab-pane fade in active" id="detail_tab_experience">
										<div class="row" id="data_list_experience"></div>
									</div>
									<div role="tabpanel" class="tab-pane fade" id="detail_tab_education">
										<div class="row" id="data_list_education"></div>
									</div>
									<div role="tabpanel" class="tab-pane fade" id="detail_tab_skill">
										<div class="row data_list_skill"></div>
									</div>
									<div role="tabpanel" class="tab-pane fade" id="detail_tab_training_achievement">
										<div class="row" id="data_list_training_achievement"></div>
									</div>
									<div role="tabpanel" class="tab-pane fade" id="detail_tab_family">
										<table class="table table-striped table-bordered display mt-4">
											<thead class="thead-light">
												<tr>
													<th>No.</th>
													<th>Name</th>
													<th>Relationship</th>
													<th>Age</th>
													<th>Occupation</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody id="data_list_family">
												
											</tbody>
										</table>
									</div>
									<div role="tabpanel" class="tab-pane fade" id="detail_tab_application_status">
										<div class="md-stepper-horizontal blue container-fluid" id="data_list_applicant_status">
											
										</div>
										<div class="col-md-8 mt-5">
											<select class="input--style-6" name="application_status" id="application_status" style="width: 40%;height: 30px;">
												<!-- <option value="0">SCREENING</option>
												<option value="1">TEST & HR INTERVIEW</option>
												<option value="2">USER INTERVIEW</option>
												<option value="3">JOB OFFER</option>
												<option value="4">YOU'RE HIRED!</option> -->
											</select>
											<input type="hidden" class="input--style-6" id="value_application_status">
										</div>
									</div>
								</div>
							</div>
						</fieldset>
						<!-- <div class="modal-footer-sdk">
							<div id="status_draft">
								<a style="<?php echo $button_status_hide_or_no; ?>; color: white;padding-top: 8px; width: 150px !important"
									class="btn-sdk btn-primary-not-only-left" name="detail_update_draft"id="detail_update_draft">
									&nbsp;&nbsp;Update Draft&nbsp;&nbsp;
								</a>
								<button class="btn-sdk btn-primary-not-only-right" type="submit" style="width: 150px !important"
									name="detail_send_to_approver" id="detail_send_to_approver">
									Send to Approver
								</button>
							</div>
							<div id="status_after_draft" style="display:none">
								<div type="reset" class="btn-sdk btn-primary-center-only" data-dismiss="modal" style="padding-top: 8px; color:black;" aria-hidden="true">
									&nbsp;Close&nbsp;
								</div>
							</div>
						</div> -->
					</div>
			</form>
		</div>
	</div>
</div>
<style>
	.stepper {
		display: flex;
		justify-content: space-between;
		align-items: center;
	}

	.step {
		text-align: center;
		width: 30px;
		height: 30px;
		line-height: 30px;
		border: 2px solid #ccc;
		background-color: #fff;
		border-radius: 50%;
		font-weight: bold;
	}

	.step.active {
		background-color: #007bff;
		color: #fff;
	}

	/* .pc-fill {
		fill: #1b6fb9 !important;
	}
	.pc-bg {
		fill: #1b6fb9 !important;
	}
	#pc-percent, #pc-actual, #pc-unit {
		fill: #F5F5F5 !important;
	} */
</style>
<script>
	// var myStepper = new Stepper($('#stepper-example'))
	$('#application_status').select2()

	$('#application_status').on('change', function(e) {
        if(e.keyCode == 13) {
            e.preventDefault();
            return false;
        }
        let step_length = $('.md-step').length
		// alert(step_length)
		for (let index = 0; index < step_length.length; index++) {
			$('.md-step').addClass('active')
			
		}
    })
</script>
</body>

</html>