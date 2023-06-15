<?php
require_once '../../../application/config.php';
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
       include "../../../application/session/sessionlv2.php";
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

	$rmintf = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#UpdateForm" data-backdrop="static" onclick="editMember(`'.$row['request_no'].'`)">'.$row['request_no'].'</a>';

	$prn = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#FormDisplayLeaveApproval" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="ApprovalSubmission(`'.$row['request_no'].'`)"> <input type="image" src="../../asset/dist/img/icons/icon-addinfo.png" title="delete" width="22px"/></a>';

	$status = '<span class="badge '.$activebadge.'">'.$row['name_en'].'</span>';

	$rmintf = '' . $revisi . ' <a type="button" nowrap="nowrap" data-toggle="modal" data-target="#UpdateForm" data-backdrop="static" style="color: orange; border: 5px; cursor:pointer;font-weight: bold;font-size: 13px;" onclick="editMember(`' . $row['_id_whistle'] . '`) , myFunction()">' . $row['emp_no'] . ' ' . $row['Full_Name'] . '</a>  <br> <label style="padding-top: 4px;color: #A5B0B7 !important;">
       '.$row['leave_code'].' ('.$row['totaldays'].') ' . $row['leave_startdates'] . ' - ' . $row['leave_enddates'] . '</label> 

       <div class="toolbar sprite-toolbar-mandatoryTraining" style="position: unset;text-align: right;margin-left: 96%;margin-top: -24px;" data-toggle="modal"  data-target="#FormDisplayLeaveApproval" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="ApprovalSubmission(`' . $row['request_no'] . '`)"></div>
              <div class="chart-text me-2">
                     <h6 class="mb-0"><small>' . strtoupper($row['name_en']) . '</small></h6>
              </div>

           ';

       $output['data'][] = array(
              $rmintf
       );

	$x++;
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP