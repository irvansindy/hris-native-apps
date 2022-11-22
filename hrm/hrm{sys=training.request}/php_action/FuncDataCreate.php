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
	$SFnumber_1       		= date("Ymd");
	$SFnumbercon    		= 'TRN-' . $SFnumber;					// MANDATORY TO WORKFLOW
	$SFReqtype				= 'Training.request';					// MANDATORY TO WORKFLOW
	$inp_emp_no     		= $_POST['inp_emp_no'];					// MANDATORY TO WORKFLOW

	$inp_token				= addslashes($_POST['inp_token']);

	$inp_training_category	= addslashes($_POST['inp_training_category']);
	$inp_training_category_arrays = explode(" ",$inp_training_category);
	$inp_venue				= addslashes($_POST['inp_venue']);
	$inp_venue_arrays 		= explode(" ",$inp_venue);

	$inp_course				= addslashes($_POST['inp_course']);
	$inp_add_startdate		= addslashes($_POST['inp_add_startdate']);
	$inp_add_enddate		= addslashes($_POST['inp_add_enddate']);
	$inp_room				= strtoupper(addslashes($_POST['inp_room']));
	$inp_cost				= addslashes($_POST['inp_cost']);
	$inp_reason				= strtoupper(addslashes($_POST['inp_reason']));
	$inp_topic				= strtoupper(addslashes($_POST['inp_topic']));

	$SFnumbercon_1    		= 'TREV-' . $inp_course . '-' . $SFnumber_1;					// MANDATORY TO WORKFLOW

	//OBJECT ORIENTED STYLE
	$query 					= "SELECT * FROM trncourse WHERE id_course = '$inp_course'";
	$result 				= $connect->query($query);
	$row 					= $result->fetch_array(MYSQLI_ASSOC);
	$arr_0 					= $row["provider"];
	$arr_1 					= $row["course_code"];
	$arr_2 					= $row["course_name"];
	//OBJECT ORIENTED STYLE

	$sql_0 = "INSERT INTO `trnmrequest` 
						(
							`request_no`,
							`training_event`,
							`training_type`, 
							`training_category`,
							`training_course`, 
							`training_topic`,
							`training_venue`,
							`training_provider`, 
							`room`, 
							`startdate`, 
							`enddate`,
							`training_cost`,
							`reason`, 
							`created_by`, 
							`created_date`, 
							`modified_by`
						) 
							VALUES 
								(
									'$SFnumbercon',
									'$SFnumbercon_1',
									'New',
									'$inp_course',
									'$inp_training_category_arrays[0]', 
									'$inp_topic',
									'$inp_venue_arrays[0]',
									'$arr_0',
									'$inp_room',
									'$inp_add_startdate',
									'$inp_add_enddate',
									'$inp_cost',
									'$inp_reason', 
									'$username', 
									'$SFdatetime', 
									'$username'
								)";

	$query_0 = $connect->query($sql_0);

	for($addemployee=0;$addemployee<count($_POST['sel_parameter']);$addemployee++){
		$addemployee_plus 	= $addemployee+1;
		$total_employee 	= count($_POST['sel_parameter']);
		$inp_employee_code	= $_POST['sel_parameter'][$addemployee]; 
		$inp_requestfor		= $_POST['sel_parameter'][$addemployee]; // MANDATORY TO WORKFLOW
		
		//OBJECT ORIENTED STYLE
		$query 					= "SELECT * FROM view_employee WHERE emp_no = '$inp_employee_code'";
		$result 				= $connect->query($query);
		$row 					= $result->fetch_array(MYSQLI_ASSOC);
		$arr_0 					= $row["emp_id"];
		//OBJECT ORIENTED STYLE
		require_once '../../set{sys=system_function_authorization}/workflow_formula.php';

		
		
		if($inp_purposed_code!==''){

			$sql_1 = "INSERT INTO `trndrequest` 
						(
							`request_no`, 
							`emp_id`, 
							`created_by`, 
							`created_date`, 
							`modified_by`, 
							`modified_date`
						) 
							VALUES
								(
									'$SFnumbercon', 
									'$arr_0', 
									'$username', 
									'$SFdatetime', 
									'$username', 
									'$SFdatetime'
								)";

			$query_1 = $connect->query($sql_1);
			if($query_1 == TRUE) {
				$connect->query("UPDATE `trnmrequest` SET `total_member` = '$total_employee' WHERE `request_no` = '$SFnumbercon'");
			}
		}
	}

	if ($list_approval_process == TRUE) {
			
		$validator['success'] = false;
		$validator['code'] = "success_message";
		$validator['messages'] = "Successfully submit request";

	} else {

		$validator['success'] = false;
		$validator['code'] = "failed_message";
		$validator['messages'] = "Wrong approval formula for some employee ";
		$connect->query("DELETE FROM `trnmrequest` WHERE `request_no` = '$SFnumbercon'");
		// $connect->query("DELETE FROM `hrdleaverequest` WHERE `request_no` = '$SFnumbercon'");
		// $connect->query("DELETE FROM `hrmrequestapproval` WHERE `request_no` = '$SFnumbercon'");
	}

	

	// close the database connection
	$connect->close();
	echo json_encode($validator);
}
