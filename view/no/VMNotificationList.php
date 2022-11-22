<?php
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0'; 
if($getdata == 0) {
	include "../../application/session/session.php";
} else {
	include "../../application/session/mobile.session.php";	
}
?>
<?php include "../../model/no/GMNotificationList.php";?>


<?php	



	$no = 0;

	$sql = $qListRender;
	
	$query = $connect->query($sql);

	if ($query->num_rows > 0) {
		
	$output = "";

	$output .= "<tbody>";

	while ($row = $query->fetch_assoc()) {
		$notif = substr($row['request_no'],0,3);
		if($notif == 'LVR'){
			$notif1 = "<span class='font-12 text-nowrap d-block text-muted'></span>&nbsp;&nbsp;$row[leave_startdate] to $row[leave_enddate]</div>";
			$modal = "class='message-item d-flex align-items-center border-bottom px-3 py-2'";
			$href = "../hrm{sys=time.approval}";
		}elseif($notif == 'LCR'){
			$notif1 = "<span class='font-12 text-nowrap d-block text-muted'></span>&nbsp;&nbsp;$row[req_date] 
			</div>";
			$modal = "class='message-item d-flex align-items-center border-bottom px-3 py-2'";
			$href = "../hrm{sys=leave.cancellation.approval}";
		}

		$activebadge = "<a href={$href} onclick='return startload()' $modal id={$row["request_no"]} style='width: 1000px;'>
							<span class='user-img position-relative d-inline-block'> <img src='../../asset/emp_photos/$row[emp_no].png' alt='user' class='rounded-circle w-100'> <span class='profile-status rounded-circle online'></span> </span>
							<div class='w-75 d-inline-block v-middle pl-2'>
								<h5 class='message-title mb-0 mt-1'>&nbsp;&nbsp;$row[request_no]</h5> 
								<span class='font-12 text-nowrap d-block text-muted text-truncate'>&nbsp;&nbsp;$row[leavename_en] / $row[name_en]</span>
								$notif1
						</a>";
		
              

	$no++;
	$output.="
	
	{$activebadge}
	<tr>
		

	<td class='fontCustom'>{$activebadge}</td>

	     </tr>";
	}

	$output .= "<tbody>";
			
	$output .= "";
	echo $output;	  
	}

?>

<!-- Javascript untuk popup modal Edit-->
<script type="text/javascript">
$(document).ready(function() {
       $(".open_modal_appsetting").click(function(e) {
              var m = $(this).attr("id");
              $.ajax({
                     url: "../../hrm/hrm{sys=time.approval}/modal_appsetting.php",
                     type: "POST",
                     data: {
                            id: m,
                     },
                     success: function(ajaxData) {
                            $("#ModalEdit").html(ajaxData);
                            $("#ModalEdit").modal({
                                   backdrop: 'static',
                                   keyboard: 'false'
                            });
                     }
              });
       });
});
</script>

<!-- Javascript untuk popup modal Edit-->
<script type="text/javascript">
$(document).ready(function() {
       $(".open_modal_appsetting1").click(function(e) {
              var m = $(this).attr("id");
              $.ajax({
                     url: "../../hrm/hrm{sys=leave.cancellation.approval}/modal_appsetting.php",
                     type: "POST",
                     data: {
                            id: m,
                     },
                     success: function(ajaxData) {
                            $("#ModalEdit").html(ajaxData);
                            $("#ModalEdit").modal({
                                   backdrop: 'static',
                                   keyboard: 'false'
                            });
                     }
              });
       });
});
</script>

<!-- AgusPrass 04/03/2021 Nitip kodingan -->
<!-- onclick='return startload()' class='open_modal_appsetting' id={$row["request_no"]} -->

<!-- $activebadge = "<a href='../hrm{sys=time.approval}' class='message-item d-flex align-items-center border-bottom px-3 py-2' style='width: 1000px;'>
							<span class='user-img position-relative d-inline-block'> <img src='../../asset/emp_photos/$row[created_by].png' alt='user' class='rounded-circle w-100'> <span class='profile-status rounded-circle online'></span> </span>
							<div class='w-75 d-inline-block v-middle pl-2'>
								<h5 class='message-title mb-0 mt-1'>&nbsp;&nbsp;$row[request_no]</h5> 
								<span class='font-12 text-nowrap d-block text-muted text-truncate'>&nbsp;&nbsp;$row[leavename_en] / $row[name_en]</span>
								<span class='font-12 text-nowrap d-block text-muted'></span>&nbsp;&nbsp;$row[leave_startdates] to $row[leave_enddates]</div>
						</a>"; -->