<?php
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if($getdata == 0) {
	include "../../application/session/session.php";
} else {
	include "../../application/session/mobile.session.php";
}

include "../../model/st/GMShiftDailySettingSearchGen.php";
include "../../model/st/GMShiftDailySetting.php";
?>


<?php	
	$no = 0;
	$sql = $qListRender;

	$query = $connect->query($sql);

	if ($query->num_rows > 0) {

	$output = "";

	$output .= "<tbody>";

	while ($row = $query->fetch_assoc()) {
	$no++;
	$output.="<tr>
				<td class='fontCustom'>{$no}</td>				
				<td class='fontCustom'><a href='#' onclick='return startload()' class='open_modal_update' id={$row["shiftdailycode"]} data-toggle='tooltip' title='update'>{$row["shiftdailycode"]}</a></td>
				<td class='fontCustom'>{$row["starttime"]}</td>
				<td class='fontCustom'>{$row["endtime"]}</td>
				<td class='fontCustom'>{$row["break_no"]}</td>
				<td class='fontCustom'>{$row["daytype"]}</td>
				<td class='fontCustom'><img src={$row["flexibleshift"]}> </td>
				<td class='fontCustom'>{$row["remark"]}</td>
			
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
       $(".open_modal_search").click(function(e) {
              var m = $(this).attr("id");
              $.ajax({
                     url: "_modal_search.php?modal_header=Search Shift Daily",
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
       $(".open_modal_update").click(function(e) {
              var m = $(this).attr("id");
              $.ajax({
                     url: "_modal_update.php?modal_header=Edit Shift Daily&emp_id=<?php echo $username; ?>",
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