<?php
require_once '../../../application/config.php';
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
       include "../../../application/session/sessionlv2.php";
} else {
       include "../../../application/session/mobile.session.php";
}

include "../../../model/tr/GMTrainingReqSearchGen.php";
include "../../../model/tr/GMTrainingReqList.php";


$output = array('data' => array());


$sql = $qListRender;

$query = mysqli_query($connect, $sql);

$x = 1;
while ($row = mysqli_fetch_assoc($query)) {

       $prn = '<a type="button" href="" nowrap="nowrap" data-toggle="modal" data-target="#CreateForm" data-backdrop="static" onclick="update_training(`' . $row['request_no'] . '`)"> ' . $row['request_no'] . '</a>';

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

       $output['data'][] = array(
              $x,
              $prn,
              $row['training_type'],
              $row['training_course'],
              $row['c_startdate'],
              $row['c_enddate'],
              $row['reason'],
              $status,
              'No'
       );

       $x++;
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP