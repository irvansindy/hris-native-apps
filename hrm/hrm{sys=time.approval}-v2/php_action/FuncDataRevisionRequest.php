<?php 
require_once '../../../application/config.php';

$validator = array('success' => false, 'messages' => array());

$sel_revision_spvdown			= $_POST['sel_revision_spvdown'];
$sel_revision_remark_spvdown		= $_POST['sel_revision_remark_spvdown'];

$get_any_request = mysqli_query($connect, "SELECT 
							a.request_no
							FROM hrmleaverequest a
							LEFT JOIN (
									SELECT 
									request_no,
									MAX(request_status) AS sts
									FROM
									hrmrequestapproval
									WHERE request_status NOT IN ('0','4','8','5')
									GROUP BY request_no
								) rests ON rests.request_no = a.request_no
								LEFT JOIN hrmstatus d ON d.code = rests.sts
							WHERE a.request_no = '$sel_revision_spvdown'
							AND rests.sts IN ('1','2','3')");

if(mysqli_num_rows($get_any_request) < 1 ){
	$sql = "UPDATE hrmrequestapprovalX";
} else {
	$sql = "UPDATE hrmrequestapproval SET request_status = '4', revised_remark = '$sel_revision_remark_spvdown' WHERE request_no = '$sel_revision_spvdown'";
}

$alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '21'"));
$alert_print_0    = $alert_0['alert'];
$alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '22'"));
$alert_print_1    = $alert_1['alert'];

$query = $connect->query($sql);
$query1 = $connect->query($sql1);

if($query == TRUE) {						
	$validator['success'] = true;
	$validator['code'] = "success_message_revision_request";
	$validator['messages'] = $alert_print_0;			
} else {		
	$validator['success'] = false;
	$validator['code'] = "failed_message";
	$validator['messages'] = $alert_print_1;			
}

// close database connection
$connect->close();
echo json_encode($validator);