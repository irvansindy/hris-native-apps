<?php
require_once '../../../application/config.php';
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
       include "../../../application/session/sessionlv2.php";
} else {
       include "../../../application/session/mobile.session.php";
}

 
include "../../../model/ta/GMLeaveCancellationReqSearchGen.php";
include "../../../model/ta/GMLeaveCancellationReqList.php"; 


$output = array('data' => array());

$sql = $qListRenderSrvSide;

$query = mysqli_query($connect, $sql);

$x = 1;
while ($row = mysqli_fetch_assoc($query)) {

	$rmintf = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#UpdateForm" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="editMember(`'.$row['request_no'].'`)"><u>'.$row['request_no'].'</u></a>   ';

	$prn = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#FormDisplayLeaveApproval" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="ApprovalSubmission(`'.$row['request_no'].'`)"> <input type="image" src="../../asset/dist/img/icons/icon-addinfo.png" title="delete" width="22px"/></a>';

	$active = '';
       if($row['name_en'] == "Revised") {
              $active = "<td class='fontCustom' style='color: #3838d0;text-decoration: underline;'><a onclick='return startload()' href='#' class='open_modal_edit' id={$row["request_no"]}>{$row["request_no"]}</a></td>";
       } elseif($row['name_en'] == "Unverified") {
              $active = "<td class='fontCustom' style='color: #3838d0;text-decoration: underline;'><a onclick='return startload()' href='#' class='open_modal_edit' id={$row["request_no"]}>{$row["request_no"]}</a></td>";
       } else {
              $active = "<td class='fontCustom'>{$row["request_no"]}</td>";
       }

       $revisi = '';
       if($row['name_en'] == "Revised"){
              $revisi = "<td class='fontCustom'>
              <a href='#' onclick='return startload()' class='open_modal_revised' id={$row["request_no"]} data-toggle='tooltip' title='Revised'>{$row["request_no"]}</a>
              </td>";
       }else{
              $revisi = "<td class='fontCustom'>{$row["request_no"]}</td>";
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

	$status = '<span class="badge '.$activebadge.'">'.$row['name_en'].'</span>';

	$output['data'][] = array(
		$x,
		$revisi,
		$row['Full_name'],
		$row['leaverequest_no'],
		$row['leave_code'],
		$row['requestdate'],
		$row['totaldays'],
		$row['remark'],
		$status,

		$prn
	);

	$x++;
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP