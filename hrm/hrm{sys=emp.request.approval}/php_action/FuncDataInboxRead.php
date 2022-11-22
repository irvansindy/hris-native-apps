<?php
require_once '../../../application/config.php';
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
       include "../../../application/session/sessionlv2.php";
} else {
       include "../../../application/session/mobile.session.php";
}

include "../../../model/eo/GMInboxApprovalSearchGen.php";
include "../../../model/eo/GMInboxApprovalList.php";

$output = array('data' => array());

$sql = $qListRender;

$query = mysqli_query($connect, $sql);

$x = 1;
while ($row = mysqli_fetch_assoc($query)) {

       if($row['request_type'] == 'Attendance.leave') {
              $prn = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#FormDisplayMyRequestForleave" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="MyRequestForLeaveApproval(`'.$row['request_no'].'`)">'.$row['request_no'].'</a>';
       } else {
              $prn = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#FormDisplayMyRequestForGeneral" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="MyRequestForGeneralApproval(`'.$row['request_no'].'`)">'.$row['request_no'].'</a>';
       }

       $activebadge = '';
       if ($row['status_pengajuan'] == "Draft") {
              $activebadge = "badge-draft";
       } elseif ($row['status_pengajuan'] == "Unverified") {
              $activebadge = "badge-Unverified";
       } elseif ($row['status_pengajuan'] == "Partially Approved") {
              $activebadge = "badge-Partially-Approved";
       } elseif ($row['status_pengajuan'] == "Fully Approved") {
              $activebadge = "badge-Fully-Approved";
       } elseif ($row['status_pengajuan'] == "Revised") {
              $activebadge = "badge-Revised";
       } elseif ($row['status_pengajuan'] == "Rejected") {
              $activebadge = "badge-Rejected";
       } elseif ($row['status_pengajuan'] == "Cancelled") {
              $activebadge = "badge-Cancelled";
       } else {
              $activebadge = "badge-Closed";
       }

       $status = '<span class="badge ' . $activebadge . '">' . $row['status_pengajuan'] . '</span>';

       $output['data'][] = array(
              $x,
              $prn,
              $row['emp_no'],
              $row['Full_Name'],
              $row['request_type'],
              $row['request_date'],
              $status
       );

       $x++;
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP