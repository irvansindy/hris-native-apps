<?php 
require_once '../../../application/config.php';

$memberId = $_POST['member_id'];

//$memberId = 'DO170048';

$sql = "SELECT 
		a.*,
		b.Full_Name,
		a.ipa_remark as remarks,
		(SELECT 
			CASE 
				WHEN MAX(rev_id)+1 IS NULL THEN '0'
				ELSE MAX(rev_id)+1
			END AS 'REV'
			FROM hrdperf_ipprequest_review 
			WHERE ipp_reqno = '$memberId') AS revno
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
		LEFT JOIN hrmperf_parequest c ON a.ipa_reqno=c.ipp_reqno
	   WHERE a.ipp_reqno = '$memberId'
	   GROUP BY a.ipp_reqno";
		
$query = mysqli_query($connect, $sql);
$result = mysqli_fetch_assoc($query);

$connect->close();

echo json_encode($result);

