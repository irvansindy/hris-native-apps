<?php 
require_once '../../../application/config.php';
require_once '../../../application/session/sessionlv2.php';

$memberId = $_POST['member_id'];

$sql = "SELECT       
                     a.*,
                     b.emp_no,
			b.Full_Name,
                     c.period_name
              FROM hrmperf_finalresult a
              LEFT JOIN view_employee b on a.request_for=b.emp_no
              LEFT JOIN hrmperf_set_period c on a.ip_period=c.period_id
              LEFT JOIN users d ON d.username = '$username'
              WHERE a.ipp_reqno = '$memberId'
                                       
		GROUP BY a.ipp_reqno";
		
$query = mysqli_query($connect, $sql);
$result = mysqli_fetch_assoc($query);

$connect->close();

echo json_encode($result);

