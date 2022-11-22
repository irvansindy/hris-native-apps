<?php
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if($getdata == 0) {
	include "../../application/session/session.php";
} else {
	include "../../application/session/mobile.session.php";
}
?>
<?php include "../../model/ta/GMLeaveReqSearchGen.php"; ?>
<?php include "../../model/ta/GMLeaveReqList.php";      ?>

<!-- CODE;NAME_EN
0;Draft
1;Unverified
2;Partially Approved
3;Fully Approved
4;Revised
5;Rejected
8;Cancelled
9;Closed -->

<?php	
	$no = 0;

	$sql = $qListRender;
	
	$query = $connect->query($sql);

	if ($query->num_rows > 0) {
		
	$output = "";

	$output .= "<tbody>";

	while ($row = $query->fetch_assoc()) {

            

              $attachment = '';
              if($row['file_name'] == "") {
                     $attachment = "<td class='fontCustom'></td>";
              } else {
                     $attachment = "<td class='fontCustom'>
                                          <a href='#' onclick='return startload()' class='open_modal_attch' id={$row["request_no"]}>
                                                 <div class='toolbar sprite-toolbar-cus' id='add' title='{$row['file_name']}'>
                                                 </div>
                                          </a>
                                   </td>";
              }
              
              // $activebadge = ''
              // if($row['name_en'] == "Draft") {
              //        $activebadge = "badge-draft";
              // } elseif($row['name_en'] == "Unverified") {
              //        $activebadge = "badge-Unverified";        
              // } elseif($row['name_en'] == "Partially Approved") {
              //        $activebadge = "badge-Partially-Approved"; 
              // } elseif($row['name_en'] == "Fully Approved") {
              //        $activebadge = "badge-Fully-Approved";
              // } elseif($row['name_en'] == "Revised") {
              //        $activebadge = "badge-Revised";
              // } elseif($row['name_en'] == "Rejected") {
              //        $activebadge = "badge-Rejected"; 
              // } elseif($row['name_en'] == "Cancelled") {
              //        $activebadge = "badge-Cancelled";                
              // } else {
              //        $activebadge = "badge-Closed";
              // }

              // AgusPrass 08/03/2021 Menambahkan hyperlink pada no req jika terevisi
                     $revisi = '';
                     if($row['name_en'] == "Revised"){
                            $revisi = "<td class='fontCustom'>
                            <a href='#' onclick='return startload()' class='open_modal_revised' id={$row["request_no"]} data-toggle='tooltip' title='Revised'>{$row["request_no"]}</a>
                            </td>";
                     }else{
                            $revisi = "<td class='fontCustom'>{$row["request_no"]}</td>";
                     }

              // AgusPrass 08/03/2021 Menambahkan hyperlink pada no req jika terevisi

              $activebadge = '';
              if($row['name_en'] == "Draft") {
                     $activebadge = "badge-draft";
              } elseif($row['name_en'] == "Unverified") {
                     $activebadge = "badge-Unverified";  
              } elseif($row['name_en'] == "Partially Approved") {
                     $activebadge = "badge-Partially-Approved"; 
              } elseif($row['name_en'] == "Fully Approved") {
                     $activebadge = "badge-Fully-Approved";
              } elseif($row['name_en'] == "Revised") {
                     $activebadge = "badge-Revised";
              } elseif($row['name_en'] == "Rejected") {
                     $activebadge = "badge-Rejected"; 
              } elseif($row['name_en'] == "Cancelled") {
                     $activebadge = "badge-Cancelled";                
              } else {
                     $activebadge = "badge-Closed";
              }

              $urgent = '';
              $attachment = '';
              if($row['urgent_request'] == 'Y') {
                     $urgent = 'Yes';
                     $attachment = "<td class='fontCustom'>
                                          <a href='#' onclick='return startload()' class='open_modal_attch' id={$row["request_no"]}>
                                                 <div class='toolbar sprite-toolbar-cus' id='add' title='{$row['file_name']}'>
                                                 </div>
                                          </a>
                                   </td>";
                     
              } else {
                     $urgent = 'No';
                     $attachment = "<td class='fontCustom'></td>";
              }

	$no++;
	$output.="<tr>
		
			<td class='fontCustom'>{$no}</td>		
			$revisi
			<td class='fontCustom'>{$row["full_name"]}</td>
			<td class='fontCustom'>{$row["leave_code"]}</td>
			<td class='fontCustom'>{$row["leave_startdates"]}</td>
			<td class='fontCustom'>{$row["leave_enddates"]}</td>
			<td class='fontCustom'>{$row["totaldays"]}</td>
			<td class='fontCustom'>{$row["remark"]}</td>
                     <td class='fontCustom'>{$urgent}</td>
			<td class='fontCustom'><span class='badge {$activebadge}'>{$row["name_en"]}</span></td>
                     {$attachment}
                     <td class='fontCustom'>
			<a href='#' onclick='return startload()' class='open_modal_appsetting_lvu' id={$row["request_no"]}><img src='../../asset/dist/img/icons/icon-addinfo.png' data-toggle='tooltip' title='approval'></a>
			</td>
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
       $(".open_modal_edit").click(function(e) {
              var m = $(this).attr("id");
              $.ajax({
                     url: "modal_edit.php?emp_id=<?php echo $username; ?>",
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
       $(".open_modal_attch").click(function(e) {
              var m = $(this).attr("id");
              $.ajax({
                     url: "modal_attch.php?emp_id=<?php echo $username; ?>",
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
       $(".open_modal_add").click(function(e) {
              var m = $(this).attr("id");
              $.ajax({
                     url: "modal_add.php?emp_id=<?php echo $username; ?>",
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
       $(".open_modal_search").click(function(e) {
              var m = $(this).attr("id");
              $.ajax({
                     url: "modal_search.php?emp_id=<?php echo $username; ?>",
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
       $(".open_modal_appsetting_lvu").click(function(e) {
              var m = $(this).attr("id");
              $.ajax({
                     url: "../hrm{sys=time.attendance}/modal_appsetting_lvu.php?emp_id=<?php echo $username; ?>",
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
       $(".open_modal_revised").click(function(e) {
              var m = $(this).attr("id");
              $.ajax({
                     url: "modal_revised.php?emp_id=<?php echo $username; ?>",
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