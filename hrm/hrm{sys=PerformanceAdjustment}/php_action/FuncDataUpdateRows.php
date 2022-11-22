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
if ($_GET['key0']) {

	$validator = array('success' => false, 'messages' => array());

	$SFdate         		= date("Y-m-d");
	$SFtime         		= date('h:i:s');
	$SFdatetime     		= date("Y-m-d H:i:s");
	$SFnumber       		= date("YmdHis");


	$key0     	= $_GET['key0'];
	$key1		= $_GET['key1'];

	//OBJECT ORIENTED STYLE
	$query 					= "SELECT * FROM hrmperf_range a WHERE a.id_range = '$key1'";
	$result 				= $connect->query($query);
	$row 					= $result->fetch_array(MYSQLI_ASSOC);
	$arr_0 					= $row["score_start"];
	$arr_1 					= $row["score_end"];
	//OBJECT ORIENTED STYLE

	//OBJECT ORIENTED STYLE
	$query_1 				= "SELECT 
									CASE 
										WHEN MAX(pa_result_adjust) > $arr_0 AND MAX(pa_result_adjust)+0.0100 < $arr_1 THEN MAX(pa_result_adjust)+0.0100
										ELSE $arr_0+0.0002 
								END AS val
								FROM hrmperf_finalresult a WHERE a.pa_grade_adjust = '$key1'";
	$result_1 				= $connect->query($query_1);
	$row_1 					= $result_1->fetch_array(MYSQLI_ASSOC);
	$arr_0_1 				= $row_1["val"];
	//OBJECT ORIENTED STYLE



		$sql_0 = "UPDATE `hrmperf_finalresult`
				SET
					`pa_grade_adjust` 	= '$key1',
					`pa_result_adjust`	= '$arr_0_1'
					-- ,`pa_result_adjust` 	= '$sel_performance'
				WHERE `ipp_reqno` 		= '$key0'";

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


	// condition ends

	// close the database connection
	
}
