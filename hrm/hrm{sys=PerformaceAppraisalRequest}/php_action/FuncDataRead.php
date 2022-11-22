<?php 
require_once '../../../application/config.php';
include "../../../model/pr/GMPerformancePlanSearchGen.php";
include "../../../model/pr/GMPerformancePlan.php";

$output = array('data' => array());

$sql = $qListRenderApprraisalRequest;

$query = mysqli_query($connect, $sql);

$x = 1;
while ($row = mysqli_fetch_assoc($query)) {

	if($row['kpi_type'] == 'SPV-Up') {
		$use_form_delete_for = 'FormDisplayAppraisalSPVUP';
		$use_function_delete_for = 'EditAppraisalMemberSPVUP';
	} else {
		$use_form_delete_for = 'FormDisplayAppraisalSPVDOWN';
		$use_function_delete_for = 'EditAppraisalMemberSPVDOWN';
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

	$activebadge_appraisal = '';
       if($row['name_id_appraisal'] == "None") {
                     $activebadge_appraisal = "badge-Revised";
	} elseif($row['name_id_appraisal'] == "Draft") {
                     $activebadge_appraisal = "badge-Cancelled";
       } elseif($row['name_id_appraisal'] == "Unverified") {
                     $activebadge_appraisal = "badge-Unverified";  
       } elseif($row['name_id_appraisal'] == "Partially Approved") {
                     $activebadge_appraisal = "badge-Partially-Approved"; 
       } elseif($row['name_id_appraisal'] == "Fully Approved") {
                     $activebadge_appraisal = "badge-Fully-Approved";
       } elseif($row['name_id_appraisal'] == "Revised") {
                     $activebadge_appraisal = "badge-Revised";
       } elseif($row['name_id_appraisal'] == "Rejected") {
                     $activebadge_appraisal = "badge-Rejected"; 
       } elseif($row['name_id_appraisal'] == "Cancelled") {
                     $activebadge_appraisal = "badge-Cancelled";                
       } else {
                     $activebadge_appraisal = "badge-Closed";
       }

	
	$prn = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#'.$use_form_delete_for.'" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="'.$use_function_delete_for.'(`'.$row['ipp_reqno'].'`)"> <input type="image" src="../../asset/dist/img/icons/icon-addinfo.png" title="delete" width="22px"/></a>';

	$status_appraisal = '<span class="badge '.$activebadge_appraisal.'">'.$row['name_id_appraisal'].'</span>';
	$status = '<span class="badge '.$activebadge.'">'.$row['name_en'].'</span>';

	$output['data'][] = array(
		$x,
		$row['sts'] . "|" . $row['ipp_reqno'],
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
		$status_appraisal,
		// $status,
		$prn
	);

	$x++;
}

// database connection close
$connect->close();
echo json_encode($output);
// KASIH KUTIP TUH DI NIP