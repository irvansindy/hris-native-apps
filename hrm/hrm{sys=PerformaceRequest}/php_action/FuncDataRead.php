<?php 
require_once '../../../application/config.php';
include "../../../model/pr/GMPerformancePlanSearchGen.php";
include "../../../model/pr/GMPerformancePlan.php";

$output = array('data' => array());

$sql = $qListRender;

$query = mysqli_query($connect, $sql);

$x = 1;
while ($row = mysqli_fetch_assoc($query)) {

	if($row['kpi_type'] == 'SPV-Up') {
		$use_form_delete_for = 'FormDisplayApproverSPVUP';
		$use_form_revised_for = 'FormDisplayRevisedSPVUP';
		$use_function_delete_for = 'editApprovalSPVUPMember';
		$use_function_revised_for = 'editRevisedMemberSPVUP';
	} else {
		$use_form_delete_for = 'FormDisplayDelete';
		$use_form_revised_for = 'FormDisplayRevised';-
		$use_function_delete_for = 'editdelMember';
		$use_function_revised_for = 'editRevisedMember';
	}

	if($row['name_en'] == "Revised") {
		$rmintf = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#'.$use_form_revised_for.'" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="'.$use_function_revised_for.'(`'.$row['ipp_reqno'].'`)"><u>'.$row['ipp_reqno'].'</u></a>';
	} else {
		$rmintf = $row['ipp_reqno'];
	}

	

	// $prn = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#'.$use_form_delete_for.'" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="'.$use_function_delete_for.'(`'.$row['ipp_reqno'].'`)"> <input type="image" src="../../asset/dist/img/ios7-close-outline.png" title="delete" width="22px"/></a>';

	$prn = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#'.$use_form_delete_for.'" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="'.$use_function_delete_for.'(`'.$row['ipp_reqno'].'`)"> <input type="image" src="../../asset/dist/img/icons/icon-addinfo.png" title="delete" width="22px"/></a>';

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

	$status = '<span class="badge '.$activebadge.'">'.$row['name_en'].'</span>';

	$output['data'][] = array(
		$x,
		$rmintf,
		$row['kpi_type'],
		$row['period_name'],
		$row['emp_no'],
		$row['Full_Name'],
		$row['pos_name_en'],
		$row['cost_code'],
		$row['created_date'],
		$row['created_by'],
		$row['modified_date'],
		$row['created_by'],
		$status,
		$prn
	);

	$x++;
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP