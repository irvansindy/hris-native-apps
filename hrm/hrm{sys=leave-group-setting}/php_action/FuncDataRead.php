<?php
require_once '../../../application/config.php';
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
       include "../../../application/session/sessionlv2.php";
} else {
       include "../../../application/session/mobile.session.php";
}


// include "../../../model/st/GMPayrollPeriod.php";
include "../../../model/st/GMLeaveSettingQuotaList.php";


$output = array('data' => array());


$sql = $query_leave_group_setting;

$query = mysqli_query($connect, $sql);

$number = 1;
while ($row = mysqli_fetch_assoc($query)) {

       $shift_daily_code = '<a type="button" href="" nowrap="nowrap" data-toggle="modal" data-target="#EditForm" data-backdrop="static" onclick="update(`' . $row['id'] . '`)"> ' . $row['id'] . '</a>';

       $output['data'][] = array(
              $number,
              $shift_daily_code,
              $row['cost_code'],
              $row['max_manpower'],
              $row['active_status'] == 1 ? 'Active' : 'Inactive'

       );

       $number++;
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP