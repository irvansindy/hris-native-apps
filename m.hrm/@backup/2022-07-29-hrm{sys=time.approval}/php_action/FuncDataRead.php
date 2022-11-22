<?php
require_once '../../../application/config.php';
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if($getdata == 0) {
	include "../../../application/session/session.php";
} else {
	include "../../../application/session/mobile.session.php";
}

include "../../../model/ta/GMLeaveApprovalSearchGen2.php"; 
include "../../../model/ta/GMLeaveApprovalList.php";      

$output = array('data' => array());

$sql = $qListRenderApproval;

$query = mysqli_query($connect, $sql);

$x = 1;
while ($row = mysqli_fetch_assoc($query)) {

	if($row['urgent_request'] == 'Y') {
		$urgent_request_Print = 'Yes';
	} else {
		$urgent_request_Print = 'No';
	}

      	$attachment = '';
              if($row['file_name'] == "") {
                     $attachment = "<td class='fontCustom'></td>";
              } else {
                     $attachment = "<td class='fontCustom'>
                                          <a href='#' data-toggle='modal' data-target='#FormDisplayAttachmentRequest' onclick='Attachment(`$row[request_no]`)'>
                                                 <div class='toolbar sprite-toolbar-cus' id='add' title='{$row['file_name']}'>
                                                 </div>
                                          </a>
                                   </td>";
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

	$rmintf = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#UpdateForm" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="editMember(`'.$row['request_no'].'`)"><u>'.$row['request_no'].'</u></a>';

	$prn = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#FormDisplayLeaveApproval" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="ApprovalSubmission(`'.$row['request_no'].'`)"> <input type="image" src="../../asset/dist/img/icons/icon-addinfo.png" title="delete" width="22px"/></a>';

	$status = '<span class="badge '.$activebadge.'">'.$row['name_en'].'</span>';

	$output['data'][] = array(
		$x,
		$rmintf,
		$row['Full_Name'],
		$row['leave_code'],
		$row['leave_startdates'],
		$row['leave_enddates'],
		$row['totaldays'],
		$row['remark'],
		$urgent_request_Print,
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