<?php
require_once '../../../application/config.php';
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
       include "../../../application/session/sessionlv2.php";
} else {
       include "../../../application/session/mobile.session.php";
}


$memberId = $_POST['member_id'];
//$memberId = 'PAREQ2022-130299';

$get_data_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT position_id FROM view_employee WHERE emp_no = '$username'"));
$get_data_print_0    = $get_data_0['position_id'];

//$memberId = 'DO170048';

$sql = "SELECT 
		a.*,
		a.leave_code,
		DATE_FORMAT(a.leave_startdate, '%d %b %Y') as leave_startdates,
              DATE_FORMAT(a.leave_enddate, '%d %b %Y') as leave_enddates,
              a.totaldays,
		b.Full_Name,
		b.emp_no,
		rests.revised_remark as remark
		FROM hrmleaverequest a
		LEFT JOIN view_employee b ON a.emp_id=b.emp_id
		LEFT JOIN (
				SELECT 
				request_no,
				revised_remark,
				MAX(request_status) AS sts
				FROM
				hrmrequestapproval
				WHERE position_id = '$get_data_print_0'
				GROUP BY request_no
			) rests ON rests.request_no = a.request_no
			LEFT JOIN hrmstatus d ON d.code = rests.sts
		WHERE a.request_no = '$memberId'
		GROUP BY a.request_no";
		
$query = mysqli_query($connect, $sql);
$result = mysqli_fetch_assoc($query);

$connect->close();

echo json_encode($result);

