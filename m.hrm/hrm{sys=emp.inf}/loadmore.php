<?php
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0'; 
if($getdata == 0) {
	include "../../application/session/session.php";
} else {
	include "../../application/session/mobile.session.php";	
}
?>

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

	$isme = '';
	if($row["emp_no"] == $username) {

		$data = '<form action="../hrm{sys=emp.update}/edit" method="GET" style="margin: 10px;" onsubmit="return HrmsValidationForm()">
				<input type="hidden" class="hidden" value="'.$row[emp_no].'" name="rfid">
				<input type="hidden" class="hidden" value="'.$row[emp_no].'" name="emp_id">
				
				<button style="background-color: Transparent;
						background-repeat:no-repeat;
						border: none;
						cursor:pointer;
						overflow: hidden;
						color:grey;
						outline:none;" type="submit" name="submit_add" id="submit_add">
						
						<img src="../../asset/dist/img/icons/icon_user.png" title="Its me" hspace="2" height="16" align="absmiddle"> '.$row[emp_no].'
				</button>         
			</form>';

	
	} else {
		$data = ''.$row[emp_no].'';
	}

	$output.="<tr>
				<td style='text-align: center;' class='fontCustom'>{$data}</td>
				<td class='fontCustom'><small>{$row["Full_Name"]}</small></td>
				<td style='text-align: center;' class='fontCustom'><small>{$gender}</small></td>
				<td style='text-align: center;' class='fontCustom'><small>{$row["cost_code"]}</small></td>
				<td style='text-align: center;' class='fontCustom'><small>{$row["worklocation_code"]}</small></td>
				<td style='text-align: center;' class='fontCustom'><small>{$row["pos_name_id"]}</small></td>
				<td style='text-align: center;' class='fontCustom'><small>{$row["grade_code"]}</small></td>
				<td style='text-align: center;' class='fontCustom'><small>{$row["join_date"]}</small></td>
				<td style='text-align: center;' class='fontCustom'><small>{$row["employmentstatus_name_en"]}</small></td>
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