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


	$sel_request_no     	= $_POST['sel_request_no'];
	$sel_grade				= $_POST['sel_grade'];
	$sel_performance		= $_POST['sel_performance'];

	//OBJECT ORIENTED STYLE
	$query 					= "SELECT * FROM hrmperf_range a WHERE $sel_performance BETWEEN a.score_start AND a.score_end";
	$result 				= $connect->query($query);
	$row 					= $result->fetch_array(MYSQLI_ASSOC);
	$arr_0 					= $row["id_range"];
	//OBJECT ORIENTED STYLE



	if($arr_0 == '') {
		$validator['success'] = false;
		$validator['code'] = "failed_message";
		$validator['messages'] = "Invalid Range";

		$connect->close();
	echo json_encode($validator);
		
	} else {
		$sql_0 = "UPDATE `hrmperf_finalresult`
				SET
					`pa_grade_adjust` 	= '$arr_0',
					`pa_result_adjust` 	= '$sel_performance'
				WHERE `ipp_reqno` 		= '$sel_request_no'";

		$query_0 = $connect->query($sql_0);

		if ($query_0 == TRUE) {

			$validator['success'] = true;
			$validator['code'] = "success_message";
			$validator['messages'] = "Successfully Calibration Request";
		} else {
	
			$validator['success'] = false;
			$validator['code'] = "failed_message";
			$validator['messages'] = "Failed to Calibration Request";
		}	

		$connect->close();
		echo json_encode($validator);
	}

	// condition ends

	// close the database connection
	
}
