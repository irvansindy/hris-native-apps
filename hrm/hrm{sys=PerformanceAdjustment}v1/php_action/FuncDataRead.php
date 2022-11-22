<?php 
require_once '../../../application/config.php';
include "../../../model/pr/GMPerformancePlanSearchGen.php";
include "../../../model/pr/GMPerformancePlan.php";

$output = array('data' => array());

$sql = $qListRenderPerformanceFinalResult;

$query = mysqli_query($connect, $sql);

$x = 1;
while ($row = mysqli_fetch_assoc($query)) {

	if($row['kpi_type'] == 'SPV-Up') {
		$use_form_delete_for = 'FormDisplayApproverSPVUP';
		$use_function_delete_for = 'editApprovalSPVUPMember';
	} else {
		$use_form_delete_for = 'FormDisplayDelete';
		$use_function_delete_for = 'editdelMember';
	}

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

	
	$prn = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#UpdateForm" data-backdrop="static" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="UpdateForm(`'.$row['ipp_reqno'].'`)"> <input type="image" src="../../asset/dist/img/icons/icon-addinfo.png" title="delete" width="22px"/></a>';
       // $prn = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#UpdateForm" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="UpdateForm(`' . $row['shiftregroup_id'] . '`)"> '.$row['shiftregroup_name'].'</a>';

	$status = '<span class="badge '.$activebadge.'">'.$row['name_en'].'</span>';

	$output['data'][] = array(
		$x,
		$row['emp_no'],
		$row['Full_Name'],
		$row['pa_grade'],
		$prn
	);

	$x++;
}

// database connection close
$connect->close();
echo json_encode($output);
// KASIH KUTIP TUH DI NIP