<?php
require_once '../../../application/config.php';
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
       include "../../../application/session/sessionlv2.php";
} else {
       include "../../../application/session/mobile.session.php";
}

include "../../../model/ta/GMEmployeeCalendarScheduleSearchGen.php";
include "../../../model/ta/GMEmployeeCalendarScheduleList.php";


$output = array('data' => array());

$sql = $qListRenderSrvSide;

$query = mysqli_query($connect, $sql);

$x = 1;
while ($row = mysqli_fetch_assoc($query)) {

       $prn = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#UpdateForm" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="UpdateForm(`' . $row['shiftregroup_id'] . '`)"> '.$row['shiftregroup_name'].'</a>';
       $viw = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#PatternForm" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="PatternForm(`' . $row['shiftregroup_id'] . '`)"> View Pattern </a>';

       $output['data'][] = array(
              $x,
              $prn,
              $row['shiftregroup_name'],
              $row['day_start'],
              $row['shiftyear'],
              $row['group_code'],
              $viw

       );

       $x++;
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP