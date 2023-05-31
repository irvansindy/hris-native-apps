<?php
require_once '../../../application/config.php';
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
       include "../../../application/session/sessionlv2.php";
} else {
       include "../../../application/session/mobile.session.php";
}


include "../../../model/st/GMPayrollPeriod.php";


$output = array('data' => array());


$sql = $qListRender;

$query = mysqli_query($connect, $sql);

$x = 1;
while ($row = mysqli_fetch_assoc($query)) {

       $prn = '<a type="button" href="" nowrap="nowrap" data-toggle="modal" data-target="#CreateForm" data-backdrop="static" onclick="update(`' . $row['period_id'] . '`)"> ' . $row['period_id'] . '</a>';

       $output['data'][] = array(
              $x,
              $prn,
              $row['period_name'],
              $row['pay_date'],
              $row['date_start'],
              $row['date_end'],
              $row['intervalperiod'],
              '<img src='.$row['periodstatus'].'>'

       );

       $x++;
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP