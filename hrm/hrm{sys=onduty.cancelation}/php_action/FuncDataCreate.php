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
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$SFdate                 = date("Y-m-d");
	$SFtime                 = date('h:i:s');
	$SFdatetime             = date("Y-m-d H:i:s");
	$SFnumber               = date("YmdHis");
	$SFnumbercon            = 'LCR'.$SFnumber;
	$SFReqtype				= 'Attendance.leave';

	$inp_reqleavenumber     = $_POST['inp_reqleavenumber'];
	$inp_remark             = $_POST['inp_remark'];

	$emp                    = mysqli_fetch_array(mysqli_query($connect, "SELECT b.emp_no,a.leave_code FROM hrmleaverequest a LEFT JOIN view_employee b on a.emp_id=b.emp_id WHERE a.request_no='$inp_reqleavenumber'"));
	$emp_print              = $emp['emp_no'];
	$modal_emp              = $emp['emp_no'];
	$inp_requestfor 		= $emp['emp_no'];
	$inp_emp_no				= $emp['emp_no'];
	$modal_leave            = $emp['leave_code'];
	$var_emp_id             = mysqli_fetch_array(mysqli_query($connect, "SELECT emp_id FROM teodempcompany WHERE emp_no = '$emp_print'"));
	$var_request_emp_id     = mysqli_fetch_array(mysqli_query($connect, "SELECT emp_id FROM teodempcompany WHERE emp_no = '$username'"));

	$var_date_leave   = $_POST['pilih'];
      	$total_leave_cancel_request   = count($var_date_leave);

	for($ikpi=0;$ikpi<count($_POST['pilih']);$ikpi++){
			$ikpi_plus 		= $ikpi+1;
			$var_date_leave	= $_POST['pilih'][$ikpi]; // item

			$selectDate  = $var_date_leave;
			$selectDateExplode = explode("~", $selectDate);

			$selectDateExplode0 = $selectDateExplode[0];
			$selectDateExplode1 = $selectDateExplode[1];

			$sql_1    = "INSERT INTO hrdleavecancelrequest 
                                                                             (
                                                                                    `request_no`, 
                                                                                    `company_id`, 
                                                                                    `leave_date`, 
                                                                                    `leave_starttime`, 
                                                                                    `leave_endtime`,
																					`total_days`,
                                                                                    `created_by`, 
                                                                                    `created_date`, 
                                                                                    `modified_by`, 
                                                                                    `modified_date`
                                                                             ) 
                                                                                    VALUES 
                                                                                           (
                                                                                           '$SFnumbercon', 
                                                                                           '13576',
                                                                                           '$selectDateExplode1', 
                                                                                           '$selectDateExplode1',  
                                                                                           '$selectDateExplode1',  
																						   '$selectDateExplode0', 
                                                                                           '$username', 
                                                                                           '$SFdatetime', 
                                                                                           '$username', 
                                                                                           '$SFdatetime')";

			$query_1 = $connect->query($sql_1);
	}

	// condition start
	// $query_0 = $connect->query($sql_0);

	if($query_1 == TRUE) {

				$get_total_leave = mysqli_fetch_array(mysqli_query($connect , "SELECT 
														SUM(total_days) AS total 
														FROM hrdleavecancelrequest
													WHERE `request_no` = '$SFnumbercon'"));
				
				$sq1_0    = mysqli_query($connect, "INSERT INTO hrmleavecancelrequest 
                                                                      (
                                                                             `request_no`, 
                                                                             `company_id`, 
                                                                             `requestedby`, 
                                                                             `requestfor`, 
                                                                             `requestdate`, 
                                                                             `leaverequest_no`, 
                                                                             `leave_code`, 
                                                                             `totaldays`, 
                                                                             `remark`, 
                                                                             `approval_status`, 
                                                                             `created_by`, 
                                                                             `created_date`, 
                                                                             `modified_by`, 
                                                                             `modified_date`, 
                                                                             `request_type`) 
                                                                                    VALUES 
                                                                                           (
                                                                                           '$SFnumbercon',
                                                                                           '13576', 
                                                                                           '$var_request_emp_id[emp_id]', 
                                                                                           '$var_emp_id[emp_id]', 
                                                                                           '$SFdatetime', 
                                                                                           '$inp_reqleavenumber', 
                                                                                           '$modal_leave', 
                                                                                           '$get_total_leave[total]', 
                                                                                           '$inp_remark',
                                                                                           '0',  
                                                                                           '$username', 
                                                                                           '$SFdatetime', 
                                                                                           '$username', 
                                                                                           '$SFdatetime', 
                                                                                           '1')");

				require_once '../../set{sys=system_function_authorization}/workflow_formula.php';

				$key_0 = $SFnumbercon; 
				$key_1 = $modal_leave; 
				$key_2 = $get_total_leave['total']; 
				$key_3 = $var_request_emp_id['emp_id'];
				$key_4 = $inp_emp_no;
				require_once '../../set{sys=system_function_authorization}/leave_balance_formula.php';

				$validator['success'] = false;
				$validator['code'] = "success_message";
				$validator['messages'] = "Successfully submit leave cancellation";			
			} else {		
				$validator['success'] = false;
				$validator['code'] = "failed_message";
				$validator['messages'] = "Failed submit leave cancellation $sql_1";	
			}
	
	// condition ends

	// close the database connection
	$connect->close();
	echo json_encode($validator);
}