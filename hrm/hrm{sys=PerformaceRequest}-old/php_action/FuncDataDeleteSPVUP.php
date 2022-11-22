<?php 
require_once '../../../application/config.php';

$validator = array('success' => false, 'messages' => array());

$sel_ipp_reqnoS			= $_POST['sel_ipp_reqnoS'];

$get_any_request = mysqli_query($connect, "SELECT 
							a.ipp_reqno
							FROM hrmperf_ipprequest a
							LEFT JOIN (
												SELECT 
												request_no,
												MAX(request_status) AS sts
												FROM
												hrmrequestapproval
												WHERE request_status NOT IN ('0','4','8','5')
												GROUP BY request_no
											) rests ON rests.request_no = a.ipp_reqno
											LEFT JOIN hrmstatus d ON d.code = rests.sts
							WHERE ipp_reqno = '$sel_ipp_reqnoS'
							AND rests.sts IN ('2','3')");


if(mysqli_num_rows($get_any_request) > 0 ){
	$sql = "DELETE FROM hrmperf_ipprequestX";
	$sql1 = "DELETE FROM hrmrequestapprovalX";
} else {
	$sql = "DELETE FROM hrmperf_ipprequest WHERE ipp_reqno = '$sel_ipp_reqnoS'";
	$sql1 = "DELETE FROM hrmrequestapproval WHERE request_no = '$sel_ipp_reqnoS'";
}

$alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '8'"));
$alert_print_0    = $alert_0['alert'];
$alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '9'"));
$alert_print_1    = $alert_1['alert'];

$query = $connect->query($sql);
$query1 = $connect->query($sql1);

if($query == TRUE) {						
	$validator['success'] = true;
	$validator['code'] = "success_message_delete_spv_up";
	$validator['messages'] = $alert_print_0;			
} else {		
	$validator['success'] = false;
	$validator['code'] = "failed_message";
	$validator['messages'] = $alert_print_1;			
}

// close database connection
$connect->close();
echo json_encode($validator);