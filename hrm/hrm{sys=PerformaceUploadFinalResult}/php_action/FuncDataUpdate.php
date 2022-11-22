<?php 
require_once '../../../application/config.php';
//if form is submitted
if($_POST) {

	$validator = array('success' => false, 'messages' => array());

	$sel_ipp_reqno		= strtoupper($_POST['sel_ipp_reqno']);
	$sel_ipp_result		= strtoupper($_POST['sel_ipp_result']);
	$sel_ipp_grade		= strtoupper($_POST['sel_ipp_grade']);
	$sel_ipp_grade_adj		= strtoupper($_POST['sel_ipp_grade_adj']);

	$sql = "UPDATE `hrmperf_finalresult` SET
					`pa_result` 		= '$sel_ipp_result',
					`pa_grade`		= '$sel_ipp_grade',
					`pa_result_adjust`	= '$sel_ipp_grade_adj'
				WHERE
					`ipp_reqno`		= '$sel_ipp_reqno'";


	$alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '10'"));
	$alert_print_0    = $alert_0['alert'];
	$alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '11'"));
	$alert_print_1    = $alert_1['alert'];

	// condition start
	$query = $connect->query($sql);

	if($query == TRUE) {

		$validator['success'] = true;
		$validator['code'] = "success_message_approved_spv_down";
		$validator['messages'] = $alert_print_0;			
	} else {		
		$validator['success'] = false;
		$validator['code'] = "failed_message";
		$validator['messages'] = $alert_print_1 . $get_data_print_1;	
	}
	// condition ends

	// close the database connection
	$connect->close();
	echo json_encode($validator);
}