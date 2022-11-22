<?php
require_once '../../../application/config.php';
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
       include "../../../application/session/sessionlv2.php";
} else {
       include "../../../application/session/mobile.session.php";
}

$leave_balance       = $_POST['leave_balance'];
$emp_id              = $_POST['emp_id'];

$sql = "SELECT * FROM hrmempleavebal WHERE emp_id = (SELECT emp_id FROM view_employee WHERE emp_no = '$emp_id') AND leave_code = '$leave_balance' AND active_status = '1'";

$query = mysqli_query($connect, $sql);
$result = mysqli_fetch_assoc($query);

$connect->close();

echo json_encode($result);