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

	$sel_period     		= $_POST['sel_period'];
	$sel_total_value		= $_POST['sel_total_value'];

	//OBJECT ORIENTED STYLE
	$query 					= "SELECT FLOOR(COUNT(*)/2+1) AS total FROM hrmperf_comparatio A WHERE A.ip_period='$sel_period'";
	$result 				= $connect->query($query);
	$row 					= $result->fetch_array(MYSQLI_ASSOC);
	$arr 					= $row["total"];
	//OBJECT ORIENTED STYLE

	$sql_0 = "UPDATE `hrmperf_comparatio_annual_budget`
					SET
						`total_value` 		= '$sel_total_value'
					WHERE `ip_period` 		= '$sel_period'";

	$sql_1 = "UPDATE hrmperf_comparatio A
			INNER JOIN (
							SELECT
							ip_period,
							index_percentage_vertical,
							index_percentage_horizontal,
							$sel_total_value * ((index_percentage_vertical/100) * (index_percentage_horizontal/100)) AS new_total_value
							FROM hrmperf_comparatio) B ON 
							A.ip_period = B.ip_period AND 
							A.index_percentage_vertical=B.index_percentage_vertical AND 
							A.index_percentage_horizontal=B.index_percentage_horizontal
							
			SET A.total_value = 
			CASE 
				WHEN A.index_compa=$arr THEN $sel_total_value
				ELSE B.new_total_value
			END

			WHERE A.ip_period='$sel_period'";

	$query_0 = $connect->query($sql_0);
	$query_1 = $connect->query($sql_1);

	if ($query_0 == TRUE) {

		$validator['success'] = false;
		$validator['code'] = "success_message";
		$validator['messages'] = "Successfully Update Index Budget";
	} else {

		$validator['success'] = false;
		$validator['code'] = "failed_message";
		$validator['messages'] = "Failed Update Index Budget";
	}

	// close the database connection
	$connect->close();
	echo json_encode($validator);
}
