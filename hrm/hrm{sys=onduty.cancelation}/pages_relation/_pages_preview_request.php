<?php
    include "../../../application/config.php";


	$rfid = $_GET['rfid'];
	$xfid = $_GET['xfid'];
	$sfid = $_GET['sfid'];
	$efid = $_GET['efid'];
?>

<?php
$where= '';
if(!empty($xfid) && !empty($sfid) && !empty($efid)) {
	$where = "WHERE b.emp_no='$rfid' and a.request_no='$xfid' and (DATE(a.leave_startdate) between '$sfid' and '$efid')";
} elseif (!empty($xfid) && !empty($sfid) && empty($efid)) {
	$where = "WHERE b.emp_no='$rfid' and a.request_no='$xfid' and (DATE(a.leave_startdate) = '$sfid')";
} elseif (empty($xfid) && !empty($sfid) && !empty($efid)) {
	$where = "WHERE b.emp_no='$rfid' and (DATE(a.leave_startdate) between '$sfid' and '$efid')";
} elseif (!empty($xfid) && empty($sfid) && empty($efid)) {
	$where = "WHERE b.emp_no='$rfid' and a.request_no='$xfid'";
} elseif (empty($xfid) && !empty($sfid) && empty($efid)) {
	$where = "WHERE b.emp_no='$rfid' and (DATE(a.leave_startdate) = '$sfid')";
} elseif (empty($xfid) && empty($sfid) && !empty($efid)) {
	$where = "WHERE b.emp_no='$rfid' and (DATE(a.leave_enddate) = '$sfid')";
} else {
	$where = "WHERE b.emp_no='$rfid'";
}
?>

<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<fieldset id="fset_1">


	<legend>Leave Requests </legend>

	<div class="card-body table-responsive p-0"
		style="width: 100vw;height: 50vh; width: 100%; margin: 5px;overflow: scroll;overflow-x: scroll;">

		<p>
			<table id="example3LOAD" width="100%" border="1"
				class="table table-bordered table-striped table-hover table-head-fixed">



				<thead>
					<tr>
						<th class="fontCustom" style="z-index: 1;background-color: #a2a2a2" nowrap="nowrap">No.</th>
						<th class="fontCustom" style="z-index: 1;background-color: #a2a2a2">Request<br>Number</th>
						<th class="fontCustom" style="z-index: 1;background-color: #a2a2a2">Type of<br>Leave</th>
						<th class="fontCustom" style="z-index: 1;background-color: #a2a2a2">Start<br>Date</th>
						<th class="fontCustom" style="z-index: 1;background-color: #a2a2a2">End<br>Date</th>
						<th class="fontCustom" style="z-index: 1;background-color: #a2a2a2">Total<br>Days</th>
					</tr>
					<?php
						$sql = mysqli_query($connect, "SELECT 
							b.emp_no,
							a.request_no,
							a.leave_code,
							a.leave_startdate,
							a.leave_enddate,
							a.totaldays
								FROM
								hrmleaverequest a
								LEFT JOIN view_employee b ON a.emp_id=b.emp_id
								LEFT JOIN hrmstatus d on (SELECT request_status FROM hrmrequestapproval WHERE request_no = a.request_no ORDER BY `request_status` DESC limit 1)=d.code
									$where
								and 
								(d.code IN ('3'))");
						$no = 0;
						$no++;
					while ($r = mysqli_fetch_array($sql)) {
					?>
					<tr>
						<td width=50><?php echo $no++; ?></td>
						<td href="#" nowrap="nowrap"
							name='show_preview_leave_request_detail<?php echo $r['request_no']; ?>'
							onclick='return startload()' ide='<?php echo $r['emp_no']; ?>'
							idr='<?php echo $r['request_no']; ?>' class="open_modal_leave_open">





							<a href='#' id="show_preview_leave_request_detail<?php echo $r['request_no']; ?>"
								ide='<?php echo $r['emp_no']; ?>' idr='<?php echo $r['request_no']; ?>'
								onclick='return startload()'>
								<?php echo $r['request_no']; ?>
							</a>



						</td>
						<td href="#" nowrap="nowrap"><?php echo $r['leave_code']; ?></td>
						<td href="#" nowrap="nowrap"><?php echo $r['leave_startdate']; ?></td>
						<td href="#" nowrap="nowrap"><?php echo $r['leave_enddate']; ?></td>
						<td href="#" nowrap="nowrap"><?php echo $r['totaldays']; ?></td>


						<script>
							$(document).ready(function () {
								$("#show_preview_leave_request_detail<?php echo $r['request_no']; ?>").click(function () {
									$("#boxifblur").hide();

									var m = $(this).attr("ide");
									var m2 = $(this).attr("idr");

									$("#box").load("pages_relation/_pages_leave_detail.php?rfid=" + m + "&xfid=" + m2,
										function (responseTxt, statusTxt, jqXHR) {
											if (statusTxt == "success") {
												$("#box_show_preview_leave_request_detail").show();
											}
											if (statusTxt == "error") {
												alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
											}
										});
								});
							});
						</script>


						<?php
                    }                    
                    ?>
					</tr>
				</thead>




			</table>
			</td>
			</tr>
			</table>
		</p>

	</div>

</fieldset>


</div>

</div>
</div>
</div>


<!-- <script type="text/javascript">
                            $(document).ready(function() {
                     $(".open_modal_leave_open").click(function(e) {
                            var m = $(this).attr("id");
                            var m2 = $(this).attr("id2");

                          

                            $.ajax({
                                   url: "modal_leave.php",
                                   type: "POST",
                                   data: {
                                          xfid: m,
                                          rfid: m2
                                   },
                                   success: function(ajaxData) {
                                          $("#ModalEdits1").html(ajaxData);
                                          $("#ModalEdits1").modal({
                                          
                                          });
                                   }
                            });
                     });
              });
              </script> -->



<div id="ModalEdits1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	style="margin-left: -5px;" aria-hidden="true"></div>