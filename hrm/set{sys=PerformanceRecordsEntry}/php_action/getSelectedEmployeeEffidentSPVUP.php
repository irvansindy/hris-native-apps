<?php 
require_once '../../../application/config.php';

$memberId = $_POST['member_id'];

//$memberId = 'DO170048';

$sql = "SELECT 
		a.*,
		b.Full_Name,
		c.perspektif_name,
		SUBSTRING('$memberId', -2, 1) as kpi_pers_spv_up,
		SUBSTRING('$memberId', -1, 1) as kpi_id_spv_up
		FROM hrmperf_ipprequest a
		LEFT JOIN view_employee b ON a.requester=b.emp_no
		LEFT JOIN hrmperf_set_kpiperspektif c ON SUBSTRING('$memberId', -2, 1) = c.perspektif_id
	   WHERE CONCAT(a.ipp_reqno) = SUBSTRING('$memberId', 1, 30)";
		
$query = mysqli_query($connect, $sql);
$result = mysqli_fetch_assoc($query);

$connect->close();

echo json_encode($result);

