<?php 
require_once '../../../application/config.php';

$validator = array('success' => false, 'messages' => array());

$sel_ipp_reqno_spv_downS			= $_POST['sel_ipp_reqno_spv_downS'];

$get_any_request = mysqli_query($connect, "SELECT 
							a.pa_reqno
							FROM hrmperf_parequest_stfsc a
							LEFT JOIN (
												SELECT 
												request_no,
												MAX(request_status) AS sts
												FROM
												hrmrequestapproval
												WHERE request_status NOT IN ('0','4','8','5')
												GROUP BY request_no
											) rests ON rests.request_no = a.pa_reqno
											LEFT JOIN hrmstatus d ON d.code = rests.sts
							WHERE pa_reqno = '$sel_ipp_reqno_spv_downS'
							AND rests.sts IN ('2','3')");

if(mysqli_num_rows($get_any_request) > 0 ){
	$sql = "DELETE FROM hrmperf_parequest_stfscX";
	$sql1 = "DELETE FROM hrmrequestapprovalX";
} else {
	$sql = "DELETE FROM hrmperf_parequest_stfsc WHERE pa_reqno = '$sel_ipp_reqno_spv_downS'";
	$sql1 = "DELETE FROM hrmrequestapproval WHERE request_no = '$sel_ipp_reqno_spv_downS'";
}

$e = "SELECT pa_reqno FROM hrmperf_parequest_stfsc WHERE pa_reqno = '$sel_ipp_reqno_spv_downS'";

$alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '8'"));
$alert_print_0    = $alert_0['alert'];
$alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '9'"));
$alert_print_1    = $alert_1['alert'];

$query = $connect->query($sql);
$query1 = $connect->query($sql1);

if($query == TRUE) {						
	$validator['success'] = true;
	$validator['code'] = "success_message_delete_spv_down";
	$validator['messages'] = $alert_print_0;			
} else {		
	$validator['success'] = false;
	$validator['code'] = "failed_message";
	$validator['messages'] = $alert_print_1;			
}

// close database connection
$connect->close();
echo json_encode($validator);