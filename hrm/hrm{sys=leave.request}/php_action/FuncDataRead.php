<?php
	require_once '../../../application/config.php';
	!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
	if ($getdata == 0) {
	include "../../../application/session/sessionlv2.php";
	} else {
	include "../../../application/session/mobile.session.php";
	}

	include "../../../model/ta/GMLeaveReqSearchGen.php";
	include "../../../model/ta/GMLeaveReqList.php";


	$output = array('data' => array());

	$sql = $qListRenderSrvSide;

	$query = mysqli_query($connect, $sql);

	$x = 1;
	while ($row = mysqli_fetch_assoc($query)) {

	$attachment = '';
	if ($row['file_name'] == "") {
		$attachment = "<td class='fontCustom'></td>";
	} else {
		$attachment = "<td class='fontCustom'>
									<a href='#' onclick='return startload()' class='open_modal_attch' id={$row["request_no"]}>
											<div class='toolbar sprite-toolbar-cus' id='add' title='{$row['file_name']}'>
											</div>
									</a>
							</td>";
	}

	$prn = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#FormDisplayLeaveApproval" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="ApprovalSubmission(`' . $row['request_no'] . '`)"> <input type="image" src="../../asset/dist/img/icons/icon-addinfo.png" title="See detail approval request for ' . $row['request_no'] . '" width="22px"/></a>';

	// AgusPrass 08/03/2021 Menambahkan hyperlink pada no req jika terevisi
	$revisi = '';
	if ($row['name_en'] == "Revised") {
		$revisi = '<td class="fontCustom">
					<a href="#" data-toggle="modal"
					data-target="#RevisedForm" data-keyboard="false"
					data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="RevisedForm(`' . $row['request_no'] . '`)">' . $row["request_no"] . '</a>
					</td>';
	} else {
		$revisi = "<td class='fontCustom'>{$row["request_no"]}</td>";
	}

	// AgusPrass 08/03/2021 Menambahkan hyperlink pada no req jika terevisi

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

	$urgent = '';
	$attachment = '';
	if ($row['urgent_request'] == 'Y') {
		$urgent = 'Yes';

		$attachment = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#AttachmentForm" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="urgent_attachment(`' . $row['request_no'] . '`)"> <div class="toolbar sprite-toolbar-cus" id="add" title="Please attach some file for leave ' . $row['request_no'] . '">
				</div></a>';
	} else {
		$urgent = 'No';
		$attachment = "<td class='fontCustom'></td>";
	}

	$status = '<span class="badge ' . $activebadge . '">' . $row['name_en'] . '</span>';

	$output['data'][] = array(
		$x,
		$revisi,
		$row['full_name'],
		$row['leave_code'],
		$row['leave_startdates'],
		$row['leave_enddates'],
		$row['totaldays'],
		$row['remark'],
		$urgent,
		$status,
		$attachment,
		$prn
	);

	$x++;
	}

	// database connection close
	$connect->close();
	echo json_encode($output);

	// KASIH KUTIP TUH DI NIP