<?php
require_once '../../../application/config.php';
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
       include "../../../application/session/sessionlv2.php";
} else {
       include "../../../application/session/mobile.session.php";
}

$key = $_POST['key'];

$sql = "SELECT * FROM hrmperf_finalresult a
              LEFT JOIN view_employee b on b.emp_no=a.request_for
		WHERE a.ipp_reqno = '$key'
		GROUP BY a.ipp_reqno";
		

$query = mysqli_query($connect, $sql);
$result = mysqli_fetch_assoc($query);

$connect->close();

echo json_encode($result);

