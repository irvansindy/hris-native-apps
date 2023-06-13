<?php
include "../../../application/config.php";
$src_emp_no          = $_GET['src_emp_no'];
$src_startdate       = $_GET['inp_add_startdate'];
$src_enddate         = $_GET['inp_add_enddate'];

include "../../../model/ta/GMAttendanceEditList.php";
?>


<div class="card-body table-responsive p-0"
	style="width: 100vw; width: 99.1%; margin: 5px;overflow-y: scroll;overflow-x: scroll;">

	<input type="hidden" name="employeee" value="<?php echo $src_emp_no; ?>">

	<label><?php echo $src_emp_no_ori; ?></label>
	<table id="datatable" width="60%" class="table table-bordered table-striped table-hover table-head-fixed"
		style="width: 90px;">
		<thead>
			<tr>
				<td rowspan="2"
					style="vertical-align: inherit;background: #74614a;font-weight: bold;color: white;border: 1px solid white;;text-align: center;">
					Date</td>
				<td rowspan="2"
					style="vertical-align: inherit;background: #74614a;font-weight: bold;color: white;border: 1px solid white;;text-align: center;">
					Shift</td>
				<td colspan="2" rowspan="1"
					style="vertical-align: inherit;background: #74614a;font-weight: bold;color: white;border: 1px solid white;;text-align: center;">
					Shift Daily</td>
				<td colspan="3"
					style="vertical-align: inherit;background: #74614a;font-weight: bold;color: white;border: 1px solid white;;text-align: center;">
					Actual Time</td>
			</tr>
			<tr>
				<td
					style="background: #74614a;font-weight: bold;color: white;border: 1px solid white;;text-align: center;">
					in</td>
				<td
					style="background: #74614a;font-weight: bold;color: white;border: 1px solid white;;text-align: center;">
					Out</td>
				<td
					style="background: #74614a;font-weight: bold;color: white;border: 1px solid white;;text-align: center;">
					Time In</td>
				<td
					style="background: #74614a;font-weight: bold;color: white;border: 1px solid white;;text-align: center;">
					Time Out</td>
			</tr>
		</thead>


		<?php
			$data_attendance = mysqli_query($connect, $qListRender_srvside);
			// var_dump(count($data_attendance));
			while ($r = mysqli_fetch_array($data_attendance)) {
			?>
		
		<tr id="">
			<!-- data attendance -->
			<input id="employeeR" name="employeeR" type="hidden" readonly="true" size="4"
				value="<?php echo $src_emp_no_ori; ?>" style="background:yellow">
			<input id="inp_startdate" name="inp_startdate" type="hidden" readonly="true" size="4"
				value="<?php echo $src_startdate; ?>" style="background:yellow">
			<input id="inp_enddate" name="inp_enddate" type="hidden" readonly="true" size="4"
				value="<?php echo $src_enddate; ?>" style="background:yellow">

			<input id="inp_dateforcheck_<?php echo $r['key_att']; ?>"
				name="inp_dateforcheck_<?php echo $r['key_att']; ?>" type="hidden" readonly="true" size="4"
				value="<?php echo $r['dateforcheck']; ?>" style="background:yellow">
			<input id="inp_attend_id_<?php echo $r['key_att']; ?>" name="inp_attend_id_<?php echo $r['key_att']; ?>"
				type="hidden" readonly="true" size="4" value="<?php echo $r['attend_id']; ?>" style="background:yellow">
			<input id="emp_id_<?php echo $r['key_att']; ?>" name="emp_id_<?php echo $r['key_att']; ?>" type="hidden"
				readonly="true" size="4" value="<?php echo $r['emp_id']; ?>" style="background:yellow">
			
			<!-- data list attendance -->
			<td nowrap="nowrap" class="date_onduty" style="<?php echo $r['style']; ?>">
				<?php echo $r['attend_date']; ?>
				<input type="hidden" name="date_attendance[]" id="date_attendance[]" value="<?php echo $r['attend_date_default']; ?>" readonly>
			</td>
			
			<!-- default start time attendance -->
			<td style="padding-top: 13px;" align="center">
				<p id="shiftstarttime_<?php echo $r['key_att']; ?>">
					<?php echo $r['shiftdaily_code']; ?></p>
				<input id="inp_shiftstart_1" name="inp_shiftstart_1" type="hidden" readonly="true" size="4"
					value="<?php echo $r['shiftdaily_code']; ?>" style="background:yellow">
			</td>
			<td style="padding-top: 13px;" align="center">
				<p id="shiftstarttime_<?php echo $r['key_att']; ?>">
					<?php echo $r['shiftstarttime']; ?></p>
				<input id="inp_shiftstart_1" name="inp_shiftstart_1" type="hidden" readonly="true" size="4"
					value="<?php echo $r['shiftstarttime']; ?>" style="background:yellow">
			</td>
			<!-- default end time attendance -->
			<td style="padding-top: 13px;" align="center">
				<p id="shiftendtime_<?php echo $r['key_att']; ?>">
					<?php echo $r['shiftendtime']; ?></p>
				<input id="inp_shiftend_1" name="inp_shiftend_1" type="hidden" readonly="true" size="4"
					value="<?php echo $r['shiftendtime']; ?>" style="background:yellow">
			</td>
			
			<!-- text form time start -->
			<td>
				<table>
				<tr style="background-color: #f0f8ff00;border: 0px solid black;">
						<td style="white-space: nowrap;border: 1px solid transparent;padding: 0;">
							<label>
								<input type="radio" id="starttime1_in_<?php echo $r['key_att']; ?>"
									name="starttime_in_<?php echo $r['key_att']; ?>"
									value="<?php echo $r['sfdayminone']; ?>" checked>
								<img src="../../asset/dist/img/calendar-icon.png" width="100px" style="width: 25px;">
								<?php echo $r['sdayminone']; ?>
							</label>
							<label>
								<input type="radio" id="starttime2_in_<?php echo $r['key_att']; ?>"
									name="starttime_in_<?php echo $r['key_att']; ?>"
									name="starttime[]"
									value="<?php echo $r['sfdayone']; ?>" <?php echo $r['sdayone_check']; ?>>
								<img src="../../asset/dist/img/calendar-icon.png" width="100px" style="width: 25px;">
								<?php echo $r['sdayone']; ?>
							</label>
							<label>
								<input type="radio" id="starttime3_in_<?php echo $r['key_att']; ?>"
									name="starttime_in_<?php echo $r['key_att']; ?>"
									value="<?php echo $r['sfdayplusone']; ?>" <?php echo $r['sdayplusone_check']; ?>>
								<img src="../../asset/dist/img/calendar-icon.png" width="100px" style="width: 25px;">
								<?php echo $r['sdayplusone']; ?>
							</label>
						</td>
						<td style="white-space: nowrap;border: 1px solid transparent;padding: 0;padding-left: 5px;">
							<input type="time"
								onkeypress="return (event.charCode !=8 && event.charCode ==0 || ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57)))"
								name="inp_hours_starttime[]"
								id="inp_hours_starttime"
								value=""
								required
								placeholder="start time"
								style="border: 1px solid #d9bfbf;font-size: 12px;width: 70px;padding: 4px;"></label>
						</td>
					</tr>
				</table>
			</td>
			<!-- text form time end -->
			<td>
				<table>
					<tr style="background-color: #f0f8ff00;border: 0px solid black;">
						<td style="white-space: nowrap;border: 1px solid transparent;padding: 0;">
							<label>
								<input type="radio" id="endtime1_out<?php echo $r['key_att']; ?>"
									name="endtime_out_<?php echo $r['key_att']; ?>"
									value="<?php echo $r['sfdayminone']; ?>" <?php echo $r['edayminone_check']; ?>>
								<img src="../../asset/dist/img/calendar-icon.png" width="100px" style="width: 25px;">
								<?php echo $r['sdayminone']; ?>
							</label>
							<label>
								<input type="radio" id="endtime2_out<?php echo $r['key_att']; ?>"
									name="endtime_out_<?php echo $r['key_att']; ?>"
									value="<?php echo $r['sfdayone']; ?>" <?php echo $r['edayone_check']; ?>>
								<img src="../../asset/dist/img/calendar-icon.png" width="100px" style="width: 25px;">
								<?php echo $r['sdayone']; ?>
							</label>
							<label>
								<input type="radio" id="endtime3_out<?php echo $r['key_att']; ?>"
									name="endtime_out_<?php echo $r['key_att']; ?>"
									value="<?php echo $r['sfdayplusone']; ?>" <?php echo $r['edayplusone_check']; ?>>
								<img src="../../asset/dist/img/calendar-icon.png" width="100px" style="width: 25px;">
								<?php echo $r['sdayplusone']; ?>
							</label>
						</td>
						<td style="white-space: nowrap;border: 1px solid transparent;padding: 0;padding-left: 5px;">
							<input type="time"
								onkeypress="return (event.charCode !=8 && event.charCode ==0 || ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57)))"
								name="inp_hours_endtime[]"
								id="inp_hours_endtime"
								value=""
								placeholder="end time"
								required
								style="border: 1px solid #d9bfbf;font-size: 12px;width: 70px;padding: 4px;"></label>
						</td>
					</tr>
				</table>
			</td>
			<style type="text/css">
				label>input {
					/* Menyembunyikan radio button */
					visibility: hidden;
					position: absolute;
				}

				label>input+img {
					/* style gambar */
					cursor: pointer;
					border: 2px solid transparent;
				}

				label>input:checked+img {
					/* (RADIO CHECKED) style gambar */
					border: 2px solid #999;
					border-radius: 4px;
				}
			</style>

			<!-- <td style="text-align:center;">
				<input type='checkbox' id="cek<?php echo $r['key_att']; ?>" name='update[]'
					value='<?php echo $r['key_att']; ?>'>
				<script>
					$('#inp_remark_<?php echo $r['
						key_att ']; ?> , #inp_hours_starttime_<?php echo $r['
						key_att ']; ?> , #sel_shiftdaily_code_<?php echo $r['
						key_att ']; ?>').change(function () {
						$('input[id="cek<?php echo $r['key_att ']; ?>"]').prop('checked', true);
					});
				</script>
			</td> -->
		</tr>
		
		<!-- die function -->
		<script>
			function myFunction_kodestart_< ? php echo $r['key_att']; ?> () {

				var x = document.getElementById("sel_shiftdaily_code_<?php echo $r['key_att']; ?>")
					.value;
				//  alert(x);

				$.ajax({
					url: 'php_action/getData_Shiftdetail.php',
					type: 'post',
					data: {
						shift_id: x
					},
					dataType: 'json',
					success: function (response) {

						document.getElementById("shiftstarttime_<?php echo $r['key_att']; ?>").innerHTML = response
							.shiftstarttime;
						document.getElementById("shiftendtime_<?php echo $r['key_att']; ?>").innerHTML = response
							.shiftendtime;
						$("#revised_request_no").val(response.shiftstarttime);
					} // /success
				}); // /fetch selected member info
			}
		</script>

		<script>
				// var array_inp_endtime = document.getElementsByName('inp_hours_endtime[]');
				$("input[name='inp_hours_endtime[]']").on('change', function() {
					// alert(array_inp_endtime)
					var start_time_values = $("input[name='inp_hours_starttime[]']").map(function(){return $(this).val();}).get();
					var end_time_values = $("input[name='inp_hours_endtime[]']").map(function(){return $(this).val();}).get();
					if (end_time_values < start_time_values) {
						
						mymodalss.style.display = "none";
						modals.style.display = "block";
						document.getElementById("msg").innerHTML =
							"Entry Time: Enter Time in Proper Range";
						return false;
					}
				})

		</script>

		<?php } ?>

		<!-- <button class="btn btn-primary" type="submit" name="button_setattendance" id="button_setattendance"
			style="background: #cdcdcd;border: 1px solid transparent;font-size: 10px;border-radius: 33px;width: 103px;padding: 7px;margin-bottom: 6px;">
			Confirm
		</button> -->

		<script type="text/javascript">
			$(document).ready(function () {
				// Check/Uncheck ALl
				$('#checkAll').change(function () {
					if ($(this).is(':checked')) {
						$('input[name="update[]"]').prop('checked', true);
					} else {
						$('input[name="update[]"]').each(function () {
							$(this).prop('checked', false);
						});
					}

					var numberOfChecked = $('input:checkbox:checked').length;
					if (numberOfChecked > 0) {
						$("#button_setattendance").show();
					} else {
						$("#button_setattendance").hide();
					}
				});

				// Checkbox click
				$('input[name="update[]"]').click(function () {
					var total_checkboxes = $('input[name="update[]"]').length;
					var total_checkboxes_checked = $('input[name="update[]"]:checked').length;

					if (total_checkboxes_checked == total_checkboxes) {
						$('#checkAll').prop('checked', true);
					} else {
						$('#checkAll').prop('checked', false);
					}

					var numberOfChecked = $('input:checkbox:checked').length;
					if (numberOfChecked > 0) {
						$("#button_setattendance").show();
					} else {
						$("#button_setattendance").hide();
					}
				});
			});

			$(document).ready(function () {
				$("#button_setattendance").on('click', function () {
					$("#FormAttendanceEdit").unbind('submit').bind('submit', function () {

						mymodalss.style.display = "block";

						var form = $(this);

						var employeee = $("#employeee").val();

						var regex = /^[a-zA-Z]+$/;

						if (employeee == '') {
							mymodalss.style.display = "none";
							modals.style.display = "block";
							document.getElementById("msg").innerHTML = "Invalid employee";
							return false;

						} else {
							//submi the form to server
							$.ajax({
								url: "php_action/FuncDataAttendance.php<?php echo $getPackage; ?>",
								type: form.attr('method'),
								data: form.serialize(),
								dataType: 'json',
								success: function (response) {
									if (response.code == 'success_message_update') {

										mymodalss.style.display = "none";
										modals.style.display = "block";
										document.getElementById("msg").innerHTML = response
											.messages;

										$("#FormAttendanceEdit")[0].reset();
										$("#attendance_list").hide();

									} else {
										mymodalss.style.display = "none";
										modals.style.display = "block";
										document.getElementById("msg").innerHTML = response
											.messages;
									} // /else
								} // /success
							}); // /ajax		

							return false;
						}

					}); // /submit form for create member
				}); // /add modal
			});
		</script>