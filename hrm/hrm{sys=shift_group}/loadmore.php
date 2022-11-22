<?php include "../../application/session/session.php";?>
<?php include "../../model/eo/GMEmployeeSearchGen.php";?>
<?php include "../../model/eo/GMEmployeeList.php";?>
<?php	

	$sql = $qListRender;

	$query = $connect->query($sql);

	if ($query->num_rows > 0) {

	$output = "";

	$output .= "<tbody>";

	while ($row = $query->fetch_assoc()) {
			
	$last_id = $row['position_id'];

	$gender = '';
	if($row["gender"] == '1') {
		$gender = "Male";
	} elseif($row["gender"] == '0') {
		$gender = "Female";
	}

	$output.="<tr>
			<td class='fontCustom'><a href='menu_auth_emp?rfid={$row["emp_no"]}&group_set=emp'>{$row["emp_no"]}</a></td>
			<td class='fontCustom'><small>{$row["Full_Name"]}</small></td>
			<td class='fontCustom'><small>{$gender}</small></td>
			<td class='fontCustom'><small>{$row["cost_code"]}</small></td>
			<td class='fontCustom'><small>{$row["worklocation_code"]}</small></td>
			<td class='fontCustom'><small>{$row["pos_name_id"]}</small></td>
			<td class='fontCustom'><small>{$row["grade_code"]}</small></td>
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
                     url: "modal_search.php",
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
