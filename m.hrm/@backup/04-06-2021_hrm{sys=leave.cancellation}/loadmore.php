<?php
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if($getdata == 0) {
	include "../../application/session/session.php";
} else {
	include "../../application/session/mobile.session.php";
}
?>
<?php 
       include "../../model/ta/GMLeaveCancellationReqSearchGen.php";
       include "../../model/ta/GMLeaveCancellationReqList.php"; 
?>

<?php	
	

	$no = 0;

       $sql = $qListRender;
	
	$query = $connect->query($sql);

	if ($query->num_rows > 0) {
		
	$output = "";

	$output .= "<tbody>";

	while ($row = $query->fetch_assoc()) {

              $active = '';
              if($row['name_en'] == "Revised") {
                     $active = "<td class='fontCustom' style='color: #3838d0;text-decoration: underline;'><a onclick='return startload()' href='#' class='open_modal_edit' id={$row["request_no"]}>{$row["request_no"]}</a></td>";
              } elseif($row['name_en'] == "Unverified") {
                     $active = "<td class='fontCustom' style='color: #3838d0;text-decoration: underline;'><a onclick='return startload()' href='#' class='open_modal_edit' id={$row["request_no"]}>{$row["request_no"]}</a></td>";
              } else {
                     $active = "<td class='fontCustom'>{$row["request_no"]}</td>";
              }

              $revisi = '';
              if($row['name_en'] == "Revised"){
                     $revisi = "<td class='fontCustom'>
                     <a href='#' onclick='return startload()' class='open_modal_revised' id={$row["request_no"]} data-toggle='tooltip' title='Revised'>{$row["request_no"]}</a>
                     </td>";
              }else{
                     $revisi = "<td class='fontCustom'>{$row["request_no"]}</td>";
              }

       // AgusPrass 01/03/2021
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
       // AgusPrass 01/03/2021

	$no++;
	$output.="<tr>
			<td class='fontCustom'>{$no}</td>		
			$revisi
                     <td class='fontCustom'>{$row["Full_name"]}</td>
                     <td class='fontCustom'>{$row["leaverequest_no"]}</td>
			<td class='fontCustom'>{$row["leave_code"]}</td>
			<td class='fontCustom'>{$row["requestdate"]}</td>
			<td class='fontCustom'>{$row["totaldays"]}</td>
			<td class='fontCustom'>{$row["remark"]}</td>
			<td class='fontCustom'><span class='badge {$activebadge}'>{$row["name_en"]}</span></td>
                     <td class='fontCustom'>
			<a href='#' onclick='return startload()' class='open_modal_appsetting_user_lvc' id={$row["request_no"]}><img src='../../asset/dist/img/icons/icon-addinfo.png' data-toggle='tooltip' title='approval'></a>
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
       $(".open_modal_appsetting_user_lvc").click(function(e) {
              var m = $(this).attr("id");
              $.ajax({
                     url: "modal_appsetting_user_lvc.php?emp_id=<?php echo $username; ?>",
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