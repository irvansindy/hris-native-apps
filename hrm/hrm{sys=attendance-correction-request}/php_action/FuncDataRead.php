<?php
	require_once '../../../application/config.php';
	!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
	if ($getdata == 0) {
	include "../../../application/session/sessionlv2.php";
	} else {
	include "../../../application/session/mobile.session.php";
	}

	// include "../../../model/ta/GMAttendanceCorrectsReqSearch.php";
	include "../../../model/ta/GMAttendanceCorrectsReqList.php";

	$output = [
		'data' => []
	];

	$sql = $query_get_attendance_correct;
	$query = mysqli_query($connect, $sql);
	$number = 1;

	while ($row = mysqli_fetch_assoc($query)) {

		$request_number = '<a type="button" href="" nowrap="nowrap" data-toggle="modal" data-target="#DetailForm" data-backdrop="static" onclick="detailAttendanceCorrectRequest(`'.$row['request_no'].'`)">'.$row['request_no'].'</a>';

		$activebadge = '';
		if ($row['name_en'] == "Draft") {
			$activebadge = "badge-draft";
		} elseif ($row['name_en'] == "Unverified") {
			$activebadge = "badge-Unverified";
		} elseif ($row['name_en'] == "Partially Approved") {
			$activebadge = "badge-Partially-Approved";
		} elseif ($row['name_en'] == "Fully Approved") {
			$activebadge = "badge-Fully-Approved";
		} elseif ($row['name_en'] == "Revised") {
			$activebadge = "badge-Revised";
		} elseif ($row['name_en'] == "Rejected") {
			$activebadge = "badge-Rejected";
		} elseif ($row['name_en'] == "Cancelled") {
			$activebadge = "badge-Cancelled";
		} else {
			$activebadge = "badge-Closed";
		}

		$status = '<span class="badge ' . $activebadge . '">' . $row['name_en'] . '</span>';
		$button_approval = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#FormDisplayAttendanceCorrectApproval" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="detailAttendanceCorrectApproval(`' . $row['request_no'] . '`)"> <input type="image" src="../../asset/dist/img/icons/icon-addinfo.png" title="See detail approval request for ' . $row['request_no'] . '" width="22px"/></a>';


		$output['data'][] = array(
			$number,
			$request_number,
			$row['requestdate'],
			$row['startdate'],
			$row['enddate'],
			$row['Full_Name'],
			$status,
			$button_approval
		);

		$number++;
	}

	$connect->close();
	echo json_encode($output);

?>
