<?php
require_once '../../../application/config.php';
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if($getdata == 0) {
	include "../../../application/session/session.php";
} else {
	include "../../../application/session/mobile.session.php";
}

$memberId = $_POST['member_id'];

//$memberId = 'DO170048';

$sql = "SELECT 
		a.*,
		b.Full_Name,
		rests.revised_remark as remark
		FROM hrmperf_ipprequest a
		LEFT JOIN view_employee b ON a.requester=b.emp_no
		LEFT JOIN (
				SELECT 
				request_no,
				revised_remark,
				MAX(request_status) AS sts
				FROM
				hrmrequestapproval
				WHERE position_id = '$get_data_print_0'
				GROUP BY request_no
			) rests ON rests.request_no = a.ipp_reqno
			LEFT JOIN hrmstatus d ON d.code = rests.sts
	   WHERE a.ipp_reqno = '$memberId'";
		
$query = mysqli_query($connect, $sql);
$result = mysqli_fetch_assoc($query);

$connect->close();

echo json_encode($result);

