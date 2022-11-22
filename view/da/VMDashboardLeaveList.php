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

	$sql = $qListRender_For_Leave;
	
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
			
			  // AgusPrass 02/03/2021
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
              // AgusPrass 02/03/2021
              

	$no++;
	$output.="<tr>
		
			<td class='fontCustom'>{$no}</td>		
			{$active}
		
			<td class='fontCustom'>{$row["leave_code"]}</td>
			<td class='fontCustom' nowrap='nowrap'>{$row["leave_startdates"]}</td>
			<td class='fontCustom' nowrap='nowrap'>{$row["leave_enddates"]}</td>
			<td class='fontCustom'>{$row["totaldays"]}</td>
			<td class='fontCustom'><span class='badge {$activebadge}'>{$row["name_en"]}</span></td>
	     </tr>";
	}

	$output .= "<tbody>";
			
	$output .= "";
	echo $output;	  
	}

?>
