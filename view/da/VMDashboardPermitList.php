<?php
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0'; 
if($getdata == 0) {
	include "../../application/session/session.php";
} else {
	include "../../application/session/mobile.session.php";	
}
?>


<?php include "../../model/ta/GMLeaveReqSearchGen.php";?>
<?php include "../../model/ta/GMLeaveReqList.php";?>


<?php	

	$no = 0;

	$sql = $qListRender_For_Permit;
	
	$query = $connect->query($sql);

	if ($query->num_rows > 0) {
		
	$output = "";

	$output .= "<tbody>";

	while ($row = $query->fetch_assoc()) {

              $active = '';
              if($row['name_en'] == "Revised") {
                     $active = "<td class='fontCustom'>{$row["request_no"]}</td>";
              } elseif($row['name_en'] == "Unverified") {
                     $active = "<td class='fontCustom'>{$row["request_no"]}</td>";
              } else {
                     $active = "<td class='fontCustom'>{$row["request_no"]}</td>";
              }

              

	$no++;
	$output.="<tr>
		
			<td class='fontCustom'>{$no}</td>		
			{$active}
		
			<td class='fontCustom'>{$row["leave_code"]}</td>
			<td class='fontCustom' nowrap='nowrap'>{$row["leave_startdates"]}</td>
			<td class='fontCustom' nowrap='nowrap'>{$row["leave_enddates"]}</td>
			<td class='fontCustom'>{$row["totaldays"]}</td>
			<td class='fontCustom'><span class='badge badge-secondary'>{$row["name_en"]}</span></td>
	     </tr>";
	}

	$output .= "<tbody>";
			
	$output .= "";
	echo $output;	  
	}

?>
