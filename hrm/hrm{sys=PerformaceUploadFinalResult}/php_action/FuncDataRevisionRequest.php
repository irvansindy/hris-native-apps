<?php 
require_once '../../../application/config.php';

$validator = array('success' => false, 'messages' => array());

$inp_emp_no					= $_POST['inp_emp_no'];
$sel_revision_spvdown			= $_POST['sel_revision_spvdown'];
$sel_revision_remark_spvdown		= $_POST['sel_revision_remark_spvdown'];

$get_any_request = mysqli_query($connect, "SELECT 
							a.pa_reqno,
							a.ipa_reqno
							FROM hrmperf_parequest_stfsc a
							LEFT JOIN (
									SELECT 
									request_no,
									MAX(request_status) AS sts
									FROM
									hrmrequestapproval
									WHERE request_status NOT IN ('0','4','8','5')
									GROUP BY request_no
								) rests ON rests.request_no = a.ipa_reqno
								LEFT JOIN hrmstatus d ON d.code = rests.sts
							WHERE pa_reqno = '$sel_revision_spvdown'
							AND rests.sts IN ('1','2','3')");

$get_any_request_r = mysqli_fetch_array($get_any_request);

if(mysqli_num_rows($get_any_request) < 1 ){
	$sql = "UPDATE hrmrequestapprovalX";
} else {
	$sql = "UPDATE hrmrequestapproval SET request_status = '4', revised_remark = '$sel_revision_remark_spvdown'  WHERE request_no = '$get_any_request_r[ipa_reqno]'";
	$sql_1 = "UPDATE hrmperf_parequest_stfsc SET appraisal_status = '4' WHERE ipa_reqno = '$get_any_request_r[ipa_reqno]'";
	$sql_2 = "INSERT INTO `hrmperf_remark_revised` (`ipp_reqno`, `remark_revised`, `created_date`, `created_by`) VALUES ('$sel_revision_spvdown', '$sel_revision_remark_spvdown', '$SFdatetime', '$inp_emp_no')";
	$query = $connect->query($sql_2);
}

$alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '21'"));
$alert_print_0    = $alert_0['alert'];
$alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '22'"));
$alert_print_1    = $alert_1['alert'];

$query = $connect->query($sql);
$query1 = $connect->query($sql_1);

if($query == TRUE) {						
	$validator['success'] = true;
	$validator['code'] = "success_message_revision_spv_down";
	$validator['messages'] = $alert_print_0;			
} else {		
	$validator['success'] = false;
	$validator['code'] = "failed_message";
	$validator['messages'] = $alert_print_1;			
}

// close database connection
$connect->close();
echo json_encode($validator);