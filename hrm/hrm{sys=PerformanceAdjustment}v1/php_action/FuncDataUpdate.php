<?php
require_once '../../../application/config.php';
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
	include "../../../application/session/sessionlv2.php";
} else {
	include "../../../application/session/mobile.session.php";
}

$years		   	= date("Y");
$flag		   	= date("his");
//if form is submitted
if ($_POST) {

	$validator = array('success' => false, 'messages' => array());

	$SFdate         		= date("Y-m-d");
	$SFtime         		= date('h:i:s');
	$SFdatetime     		= date("Y-m-d H:i:s");
	$SFnumber       		= date("YmdHis");
	$SFnumbercon    		= 'LVR' . $SFnumber;
	$SFReqtype				= 'Attendance.leave';

	$sel_request_no     	= $_POST['sel_request_no'];
	$sel_grade				= $_POST['sel_grade'];

	$sql_0 = "UPDATE `hrmperf_finalresult`
					SET
						`pa_grade` 			= '$sel_grade'
					WHERE `ipp_reqno` 		= '$sel_request_no'";

	$query_0 = $connect->query($sql_0);

	if ($query_0 == TRUE) {

		$validator['success'] = false;
		$validator['code'] = "success_message";
		$validator['messages'] = "Successfully Calibration Request";
	} else {

		$validator['success'] = false;
		$validator['code'] = "failed_message";
		$validator['messages'] = "Failed to Calibration Request";
	}


	// condition ends

	// close the database connection
	$connect->close();
	echo json_encode($validator);
}
