<?php
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0'; 
if($getdata == 0) {
	include "../../application/session/session.php";
} else {
	include "../../application/session/mobile.session.php";	
}
?>

<?php include "../../model/ta/GMAttendanceSearchGen.php";?>
<?php include "../../model/ta/GMAttendanceList.php";?>

<?php	
	$no = 0;

	$sql = $qListRender;
	
	$query = $connect->query($sql);

	if ($query->num_rows > 0) {
		
	$output = "";

	$output .= "<tbody>";

	while ($row = $query->fetch_assoc()) {


       $attend_date = '';
       if($row['daytype'] == "OFF") {
              $attend_date = "<td style='background-color:pink' align='center' class='fontCustom'>{$row["shiftstarttime"]}</td>";
       } elseif($row['daytype'] == "PHOFF") {
              $attend_date = "<td style='background-color:pink' align='center' class='fontCustom'>{$row["shiftstarttime"]}</td>";
       } else {
              $attend_date = "<td align='center' class='fontCustom'>{$row["shiftstarttime"]}</td>";
       }

       $start_time = '';
       if($row['starttime'] == "00:00:00") {
              $start_time = "<td align='center' class='fontCustom'></td>";
       } else {
              $start_time = "<td align='center' class='fontCustom'>{$row["starttime"]}</td>";
       }

       $end_time = '';
       if($row['endtime'] == "00:00:00") {
              $end_time = "<td align='center' class='fontCustom'></td>";
       } else {
              $end_time = "<td align='center' class='fontCustom'>{$row["endtime"]}</td>";
       }

       $actual_in = '';
       if($row['starttime'] == "00:00:00") {
              $actual_in = "<td align='center' class='fontCustom'></td>";
       } else {
              $actual_in = "<td align='center' class='fontCustom'>{$row["actual_in"]}</td>";
       }

       $actual_out = '';
       if($row['endtime'] == "00:00:00") {
              $actual_out = "<td align='center' class='fontCustom'></td>";
       } else {
              $actual_out = "<td align='center' class='fontCustom'>{$row["actual_out"]}</td>";
       }

              

	$no++;
       $output.="<tr>
                            <td align='center' class='fontCustom'>{$row["emp_no"]}</td>
                            <td align='left' class='fontCustom'>{$row["Full_name"]}</td>
                            {$attend_date}
                            <td align='center' class='fontCustom'>{$row["shiftdaily_code"]}</td>
                            <td align='center' class='fontCustom'>{$row["daytype"]}</td>
                            
                            <td align='center' class='fontCustom'>{$row["shiftin"]}</td>
                            <td align='center' class='fontCustom'>{$row["shiftout"]}</td>
                     
                            {$start_time}
                            {$actual_in}
                            {$end_time}
                            {$actual_out}
                            <td align='center' class='fontCustom'>{$row["attend_code"]}</td>
                            <td align='center' class='fontCustom'>{$row["other_status"]}</td>
                            <td align='center' class='fontCustom'>{$row["remark"]}</td>
                           
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
                     url: "modal_add.php",
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
       $(".open_modal_appsetting").click(function(e) {
              var m = $(this).attr("id");
              $.ajax({
                     url: "modal_appsetting.php?emp_id=<?php echo $username; ?>",
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