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
		e.daytype,
		DATE_FORMAT(MIN(a1.leave_starttime), '%d %b %Y') as leave_startdates,
        DATE_FORMAT(MAX(a1.leave_endtime), '%d %b %Y') as leave_enddates,
		DATE(MIN(a1.leave_starttime)) as leave_startdates_print,
        DATE(MAX(a1.leave_endtime)) as leave_enddates_print,
              a.totaldays,
		b.Full_Name,
		b.emp_no,
		a.remark as remark_req,
		h.revised_remark as remarkfromrevised,
		f.dayrequesttype AS hd_start,
		g.dayrequesttype AS hd_end
		FROM hrmleaverequest a
		LEFT JOIN hrdleaverequest a1 ON a.request_no=a1.request_no
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
		LEFT JOIN ttamleavetype e ON a.leave_code=e.leave_code
		LEFT JOIN 
					(
						SELECT
							sub1.request_no,
							sub1.dayrequesttype
						FROM hrdleaverequest sub1
						WHERE sub1.request_no = '$memberId'
						GROUP BY sub1.leave_date
						ORDER BY sub1.leave_date ASC
						LIMIT 1
					) f ON a.request_no=f.request_no
		LEFT JOIN 
					(
						SELECT
							sub2.request_no,
							sub2.dayrequesttype
						FROM hrdleaverequest sub2
						WHERE sub2.request_no = '$memberId'
						GROUP BY sub2.leave_date
						ORDER BY sub2.leave_date DESC
						LIMIT 1
					) g ON a.request_no=g.request_no
		LEFT JOIN 
					(
						SELECT 
							sub3.request_no,
							sub3.revised_remark
						FROM hrmrequestapproval sub3
						WHERE sub3.revised_remark IS NOT NULL
					) h ON a.request_no=h.request_no
		WHERE a.request_no = '$memberId'
		GROUP BY a.request_no";
		

$query = mysqli_query($connect, $sql);
$result = mysqli_fetch_assoc($query);

$connect->close();

echo json_encode($result);

