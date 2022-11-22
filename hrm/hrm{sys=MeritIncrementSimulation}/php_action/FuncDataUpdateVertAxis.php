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
if ($_POST) {

	$validator = array('success' => false, 'messages' => array());

	$SFdate         		= date("Y-m-d");
	$SFtime         		= date('h:i:s');
	$SFdatetime     		= date("Y-m-d H:i:s");
	$SFnumber       		= date("YmdHis");

	$last_vert_value     	= $_POST['last_vert_value'];
	$new_vert_value			= $_POST['new_vert_value'];
	$sel_period				= $_POST['sel_period_vert'];
	$sel_performance		= $_POST['sel_performance'];

	//OBJECT ORIENTED STYLE
	$query 					= "SELECT FLOOR(COUNT(*)/2+1) AS total FROM hrmperf_comparatio A WHERE A.ip_period='$sel_period'";
	$result 				= $connect->query($query);
	$row 					= $result->fetch_array(MYSQLI_ASSOC);
	$arr 					= $row["total"];
	//OBJECT ORIENTED STYLE

	//OBJECT ORIENTED STYLE
	$query_0 				= "SELECT total_value AS total FROM hrmperf_comparatio_annual_budget A WHERE A.ip_period='$sel_period'";
	$result_0 				= $connect->query($query_0);
	$row_0 					= $result_0->fetch_array(MYSQLI_ASSOC);
	$arr_0 					= $row_0["total"];
	//OBJECT ORIENTED STYLE

	$sql = "UPDATE `hrmperf_compaaxis`
					SET
						`total_value`					= '$new_vert_value'
					WHERE 
						`total_value`					= '$last_vert_value' AND
						`axis`							= 'X'";

	$query = $connect->query($sql);

	$sql_0 = "UPDATE `hrmperf_comparatio`
					SET
						`index_percentage_vertical`		= '$new_vert_value'
					WHERE `ip_period` 					= '$sel_period' AND
							`index_percentage_vertical`	= '$last_vert_value' AND
							`performance`				= '$sel_performance'";

	$query_0 = $connect->query($sql_0);

	if ($query_0 == TRUE) {

		$sql_1 = "UPDATE hrmperf_comparatio A
					INNER JOIN (
									SELECT
									ip_period,
									index_percentage_vertical,
									index_percentage_horizontal,
									$arr_0 * ((index_percentage_vertical/100) * (index_percentage_horizontal/100)) AS new_total_value
									FROM hrmperf_comparatio) B ON 
									A.ip_period = B.ip_period AND 
									A.index_percentage_vertical=B.index_percentage_vertical AND 
									A.index_percentage_horizontal=B.index_percentage_horizontal
									
					SET A.total_value = 
					CASE 
						WHEN A.index_compa=$arr THEN $arr_0
						ELSE B.new_total_value
					END
					WHERE A.ip_period='$sel_period'";
		
		$query_1 = $connect->query($sql_1);

		$validator['success'] = false;
		$validator['code'] = "success_message";
		$validator['messages'] = "Successfully Update Vertical Axis";
	} else {

		$validator['success'] = false;
		$validator['code'] = "failed_message";
		$validator['messages'] = "Failed Update Vertical Axis";
	}

	// close the database connection
	$connect->close();
	echo json_encode($validator);
}
