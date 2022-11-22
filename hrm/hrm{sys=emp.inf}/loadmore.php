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

$emp_no = "<a href='#open' id='testopen' id1='{$row["emp_no"]}'>{$row["emp_no"]}</a>";

	$data = '<form name="form1" method="post" id="multiple_upload_form" enctype="multipart/form-data"
	onsubmit="return HrmsValidationForm()" action="../hrm{sys=emp.update}/edit" method="POST">         
				<input type="hidden" class="hidden" value="'.$row[emp_no].'" name="rfid">
				<button type="submit" style="background-color: Transparent;
								background-repeat:no-repeat;
								border: none;
								cursor:pointer;
								overflow: hidden;
								outline:none;" name="submit_add" id="submit_add">
				'.$row[emp_no].'
				</button>       
				
				<div name="submit_add2" id="submit_add2" style="display:none;"> 
					<span class="spinner large"> 
					<span class="bar bar1"></span>
					<span class="bar bar2"></span>
					<span class="bar bar3"></span>
				</div>

			</form>';

	$output.="<tr>
				<td class='fontCustom'>{$emp_no}</td>
				<td class='fontCustom'><small>{$row["Full_Name"]}</small></td>
				<td class='fontCustom'><small>{$gender}</small></td>
				<td class='fontCustom'><small>{$row["cost_code"]}</small></td>
				<td class='fontCustom'><small>{$row["worklocation_code"]}</small></td>
				<td class='fontCustom'><small>{$row["pos_name_id"]}</small></td>
				<td class='fontCustom'><small>{$row["grade_code"]}</small></td>
				<td class='fontCustom'><small>{$row["join_date"]}</small></td>
				<td class='fontCustom'><small>{$row["employ_code"]}</small></td>
			</tr>";		 
	}

	$output .= "<tbody>";

	$output .= "";

	echo $output;	  

}

?>

<script>
              function HrmsValidationForm() {



                     
                            $('#submit_add').hide();
                            $('#submit_add2').show();
               
              }
              </script>


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