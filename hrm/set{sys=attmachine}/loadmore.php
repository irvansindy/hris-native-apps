<?php
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if($getdata == 0) {
	include "../../application/session/session.php";
} else {
	include "../../application/session/mobile.session.php";
}

include "../../model/st/GMAttMachineSettingSearchGen.php";
include "../../model/st/GMAttMachineSetting.php";
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
				<td class='fontCustom'><a href='#' onclick='return startload()' class='open_modal_update' id={$row["machine_code"]} data-toggle='tooltip' title='update'>{$row["machine_code"]}</a></td>
				<td class='fontCustom'>{$row["method"]}</td>
                            <td class='fontCustom'>{$row["file_type"]}</td>
                            <td class='fontCustom'>{$row["fileext"]}</td>
                            <td class='fontCustom'><img src={$row["inoutflag"]}></td>
                            <td class='fontCustom'>{$row["datasource"]}</td>
                            <td class='fontCustom'>{$row["table_name"]}</td>
                            <td class='fontCustom'>{$row["in_status"]}</td>
                            <td class='fontCustom'>{$row["out_status"]}</td>
                            <td class='fontCustom'>{$row["breakstart_code"]}</td>
                            <td class='fontCustom'>{$row["breakend_code"]}</td>
                            <td class='fontCustom'>{$row["attend_code"]}</td>
				
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
                     url: "_modal_search.php?modal_header=Search Attendance Machine",
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
                     url: "_modal_update.php?modal_header=Edit Attendance Machine&emp_id=<?php echo $username; ?>",
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