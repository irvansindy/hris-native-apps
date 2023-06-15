<?php
require_once '../../../application/config.php';
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
	include "../../../application/session/sessionlv2.php";
} else {
	include "../../../application/session/mobile.session.php";
}

include "../../../model/ta/GMAttendanceCorrectApprovalSearch.php"; 
include "../../../model/ta/GMAttendanceCorrectApprovalList.php";

$output = ['data' => []];

$sql = $query_attendance_correct_approval_list;

$query = mysqli_query($connect, $sql);

$x = 1;
while ($row = mysqli_fetch_assoc($query)) {

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

	$rmintf = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#UpdateForm" data-backdrop="static" onclick="editMember(`'.$row['request_no'].'`)">'.$row['request_no'].'</a>';

	$detail_approval = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#FormDisplayAttendanceCorrectApproval" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="ApprovalSubmission(`'.$row['request_no'].'`)"> <input type="image" src="../../asset/dist/img/icons/icon-addinfo.png" title="detail" width="22px"/></a>';

	$status = '<span class="badge '.$activebadge.'">'.$row['name_en'].'</span>';

	$output['data'][] = array(
		$x,
		$row['request_no'],
		$row['Full_Name'],
		// $row['purpose_name_en'],
		$row['requestdate'],
		// $row['requestenddate'],
		$row['reason'],
		$status,
		$detail_approval
	);

	$x++;
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP