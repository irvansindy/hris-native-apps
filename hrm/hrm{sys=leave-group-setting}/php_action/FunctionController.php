<?php
require_once '../../../application/config.php';
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
	include "../../../application/session/sessionlv2.php";
} else {
	include "../../../application/session/mobile.session.php";
}


//if form is submitted
if ($_POST) {

	$validator = array('success' => false, 'messages' => array());

	$SFdate         		= date("Y-m-d");
	$SFtime         		= date('h:i:s');
	$SFdatetime     		= date("Y-m-d H:i:s");
	$SFnumber       		= date("YmdHis");
	$SFnumber_1       		= date("Ymd");
	$years		   			= date("Y");
	$flag		   			= date("his");

	//OBJECT ORIENTED STYLE
	$query 					= "SELECT company_id FROM view_employee WHERE emp_no='$username'";
	$result 				= $connect->query($query);
	$row 					= $result->fetch_array(MYSQLI_ASSOC);
	$arr_0 					= $row["company_id"];
	//OBJECT ORIENTED STYLE

	//========================POST VALUE FORM========================//
	$inp_period_id     		= $_POST['inp_period_id']; //period id
	$inp_period_name    	= $_POST['inp_period_name']; //period name
	$inp_paydate     		= $_POST['inp_add_paydate']; //paydate
	$inp_startdate     		= $_POST['inp_add_startdate']; //starttime
	$inp_enddate     		= $_POST['inp_add_enddate']; //endtime
	$inp_interval_period   	= $_POST['inp_interval_period']; //period interval




	//========================POST VALUE FORM========================//

	if($_GET['function'] == 'create') {
		
		$sql_0 = "INSERT INTO `pay_period` 
											(
												`period_id`, 
												`period_name`, 
												`pay_date`, 
												`start_date`, 
												`end_date`, 
												`interval_period`,
												`status`,
												`created_date`, 
												`created_by`, 
												`modified_date`, 
												`modified_by`
											) 
												VALUES 
													(
															'$inp_period_id',
															'$inp_period_name',
															'$inp_paydate',
															'$inp_startdate',
															'$inp_enddate',
															'$inp_interval_period',
															'1',
															'$SFdatetime',
															'$username',
															'$SFdatetime',  
															'$username'
													)";
													
													$query_0 = $connect->query($sql_0);

				if ($query_0 == TRUE) {
				

		for($add_employee=0;$add_employee<count($_POST['sel_parameter']);$add_employee++){
			$add_employee_plus 		= $add_employee+1;
			$total_employee 		= count($_POST['sel_parameter']);
			$inp_requestfor			= $_POST['sel_parameter'][$add_employee];


			$query_emp 				= "SELECT * FROM view_employee WHERE emp_id = '$inp_requestfor'";
			$result_emp				= $connect->query($query_emp);
			$row_emp				= $result_emp->fetch_array(MYSQLI_ASSOC);
			$arr_emp 				= $row_emp["emp_id"];
	
	
			



			

			

			

				$sql_1 = "REPLACE INTO `hrmempperiod` 
										(
											`emp_id`, 
											`period_code`, 
											`created_by`, 
											`created_date`, 
											`modified_by`,
											`modified_date`
										) 
											VALUES 
												(
														'$arr_emp',
														'$inp_period_id',
														'$username',
														'$SFdatetime',  
														'$username',
														'$SFdatetime'
												)";

				$query_1 = $connect->query($sql_1);

				} 
				
			}	if($query_1 == true){
			
					$validator['success'] = false;
					$validator['code'] = "success_message";
					$validator['messages'] = "Success to saved data";
				}else{

					$validator['success'] = false;
					$validator['code'] = "failed_message";
					$validator['messages'] = "Failed to saved data $sql_1";
				}
		
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	} else if($_GET['function'] == 'update') {
		
		
		
		
		
		
		$inp_keyofupdate = $_POST['inp_keyofupdate'];
		$inp_status_code = $_POST['inp_status_code'];



		$sql_0 = "UPDATE `pay_period` SET 
									`period_name` 			= '$inp_period_name',
									`pay_date` 				= '$inp_paydate', 
									`start_date` 			= '$inp_startdate',
									`end_date`				= '$inp_enddate',
									`interval_period`		= '$inp_interval_period',
									`modified_date` 		= '$SFdatetime',
									`modified_by`  			= '$username',
									`status`				='$inp_status_code'
						WHERE `period_id` = '$inp_keyofupdate'";

		$query_0 = $connect->query($sql_0);
		
		
		$sql_delete = " DELETE FROM hrmempperiod
						WHERE period_code = '$inp_keyofupdate'";

			$query_delete = $connect->query($sql_delete);

		for($add_employee=0;$add_employee<count($_POST['sel_parameter']);$add_employee++){
			$add_employee_plus 		= $add_employee+1;
			$total_employee 		= count($_POST['sel_parameter']);
			$inp_requestfor			= $_POST['sel_parameter'][$add_employee];


			$query_emp 				= "SELECT * FROM view_employee WHERE emp_id = '$inp_requestfor'";
			$result_emp				= $connect->query($query_emp);
			$row_emp				= $result_emp->fetch_array(MYSQLI_ASSOC);
			$arr_emp 				= $row_emp["emp_id"];

		

		

						

		

			





			$sql_1 = "REPLACE INTO `hrmempperiod` 
					(
						`emp_id`, 
						`period_code`, 
						`created_by`, 
						`created_date`, 
						`modified_by`,
						`modified_date`
						
					) 
						SELECT
							
									'$arr_emp',
									'$inp_keyofupdate',
									'$username',
									'$SFdatetime',  
									'$username',
									'$SFdatetime'
							
				";

			$query_1 = $connect->query($sql_1);

		}

				
		if($query_1 == true){
			
				$validator['success'] = false;
				$validator['code'] = "success_message";
				$validator['messages'] = "Success to saved data";
			}else{

				$validator['success'] = false;
				$validator['code'] = "failed_message";
				$validator['messages'] = "Failed to saved data $sql_1";
			}

	
	}
	// close the database connection
	$connect->close();
	echo json_encode($validator);

}