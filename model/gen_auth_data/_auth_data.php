<?php
//--GET AUTHORIIZATION--||--GET AUTHORIIZATION--||--GET AUTHORIIZATION--||--GET AUTHORIIZATION--||--GET AUTHORIIZATION--
//--GET AUTHORIIZATION--||--GET AUTHORIIZATION--||--GET AUTHORIIZATION--||--GET AUTHORIIZATION--||--GET AUTHORIIZATION--
	$req 								= mysqli_query($connect, "SET SESSION group_concat_max_len = 100000");
	$req_app 							= mysqli_query($connect, "SELECT emp_no, 
																	GROUP_CONCAT(Authorized_formula ORDER BY Authorized_Group ASC SEPARATOR ',') AS formula 
																			FROM hrmgroupdata
																			WHERE 
																			emp_no = '$user' AND 
																			Authorized_formula <> '' AND 
																			Authorized_formula IS NOT NULL
																			GROUP BY emp_no");
														$SQLSS = "SELECT emp_no, 
														GROUP_CONCAT(Authorized_formula ORDER BY Authorized_Group ASC SEPARATOR ',') AS formula 
																FROM hrmgroupdata
																WHERE 
																emp_no = '$user' AND 
																Authorized_formula <> '' AND 
																Authorized_formula IS NOT NULL
																GROUP BY emp_no";
				
	$var_having_formula 				= mysqli_fetch_array($req_app);
			
	if(mysqli_num_rows($req_app) > 0) {
		$var1 = array(",",);
		$var2 = array("','");
		$conversion_formula = str_replace($var1, $var2, $var_having_formula['formula']);
		// $conversion_formula_print = "a.worklocation_code IN ('$conversion_formula')";
		$conversion = $conversion_formula;
	} else {
		$conversion = "a.emp_no = '$user'"; 
	}	
	
	!empty($_GET['src_emp_no']) ? $getdata1 = '1' : $getdata1 = '0';
	!empty($_GET['src_employee_name']) ? $getdata0 = '1' : $getdata0 = '0';

	if ($getdata0 == 1 && $getdata1 == 1) {
		$where_srvside = "WHERE (a.Full_Name LIKE '%$_GET[src_employee_name]%' AND  a.emp_no LIKE '%$_GET[src_emp_no]%') AND ($conversion)";
	} else if($getdata1 == 1) {
		$where_srvside = "WHERE (a.emp_no LIKE '%$_GET[src_emp_no]%') AND ($conversion)";
	} else if ($getdata0 == 1) {
		$where_srvside = "WHERE (a.Full_Name LIKE '%$_GET[src_employee_name]%') AND ($conversion)";
	} else {
		$where_srvside = "WHERE ($conversion)";
	}
//--GET AUTHORIIZATION--||--GET AUTHORIIZATION--||--GET AUTHORIIZATION--||--GET AUTHORIIZATION--||--GET AUTHORIIZATION--
//--GET AUTHORIIZATION--||--GET AUTHORIIZATION--||--GET AUTHORIIZATION--||--GET AUTHORIIZATION--||--GET AUTHORIIZATION--

//--GET AUTHORIIZATION by WORKFLOW
//--GET AUTHORIIZATION by WORKFLOW
$req_workflow 								= mysqli_query($connect, "SET SESSION group_concat_max_len = 100000");
$req_workflow_app 							= mysqli_query($connect, "SELECT 
																			a.request_type, 
																			GROUP_CONCAT(formula
																			ORDER BY formula ASC SEPARATOR ',') AS formula
																		FROM tclcdreqappsetting_formula a
																		WHERE 
																			a.request_type = 'Training.request'
																			AND (a.empno_appvr1 = '$user' OR a.empno_appvr2 = '$user' OR a.empno_appvr3 = '$user')
																		GROUP BY a.workflow_name");
			
$var_having_workflow_formula 				= mysqli_fetch_array($req_workflow_app);

if(mysqli_num_rows($req_workflow_app) > 0) {
	$var1 = array(",", "cost_code");
	$var2 = array(" OR ", "a.cost_code");
	$conversion_formula = str_replace($var1, $var2, $var_having_workflow_formula['formula']);
	// $conversion_formula_print = "a.worklocation_code IN ('$conversion_formula')"; 
	$conversion = $conversion_formula;
	$where_workflow_srvside = "WHERE $conversion";
} else {
	$conversion = "a.emp_no = '$user'";
	$where_workflow_srvside = "WHERE $conversion";
}	