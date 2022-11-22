<?php
	!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0'; 
	if($getdata == 0) {
		include "../../../application/session/sessionlv2.php";
	} else {
		include "../../../application/session/mobile.session.php";	
	}

	!empty($_GET['src_kpi_no']) ? $getdata = '1' : $getdata = '0';
	!empty($_GET['src_employee_no']) ? $getdata2 = '1' : $getdata2 = '0';
	!empty($_GET['src_request_status']) ? $getdata3 = '1' : $getdata3 = '0';
	!empty($_GET['src_full_name']) ? $getdata3 = '1' : $getdata3 = '0';
	
	// if($getdata == 0 && $getdata2 == 0) {
	// 	$WHERE = "WHERE (a.created_by = '$username')";
	// 	$WHERE_APP = "WHERE (e.emp_no = '$username') AND xdec1.sts IN ('1','2','3','5')";
	// 	$WHERE_APPRAISAL_REQUEST = "WHERE (a.created_by = '$username') AND xdec1.sts IN ('3')";
	// } else if($getdata == 1 && $getdata2 == 1) {
	// 	$WHERE = "WHERE (a.created_by = '$username') AND a.ip_period LIKE '%$_GET[src_ip_period]%' AND a.ipp_reqno LIKE '%$_GET[src_ipp_reqno]%'";
	// 	$WHERE_APP = "WHERE (e.emp_no = '$username') AND a.ip_period LIKE '%$_GET[src_ip_period]%' AND a.ipp_reqno LIKE '%$_GET[src_ipp_reqno]%'";
	// 	$WHERE_APPRAISAL_REQUEST = "WHERE (a.created_by = '$username') AND a.ip_period LIKE '%$_GET[src_ip_period]%' AND a.ipp_reqno LIKE '%$_GET[src_ipp_reqno]%'";
	// } else if($getdata == 1 && $getdata2 == 0) {
	// 	$WHERE = "WHERE (a.created_by = '$username') AND a.ip_period LIKE '%$_GET[src_ip_period]%'";
	// 	$WHERE_APP = "WHERE (e.emp_no = '$username') AND a.ip_period LIKE '%$_GET[src_ip_period]%'";
	// 	$WHERE_APPRAISAL_REQUEST = "WHERE (a.created_by = '$username') AND a.ip_period LIKE '%$_GET[src_ip_period]%'";
	// } else if($getdata == 0 && $getdata2 == 1) {
	// 	$WHERE = "WHERE (a.created_by = '$username') AND a.ipp_reqno LIKE '%$_GET[src_ipp_reqno]%'";
	// 	$WHERE_APP = "WHERE (e.emp_no = '$username') AND a.ipp_reqno LIKE '%$_GET[src_ipp_reqno]%'";
	// 	$WHERE_APPRAISAL_REQUEST = "WHERE (a.created_by = '$username') AND a.ipp_reqno LIKE '%$_GET[src_ipp_reqno]%'";
	// }

	if($getdata == 0 && $getdata2 == 0 && $getdata3 == 0) {
		$WHERE = "WHERE (a.created_by = '$username')";
		$WHERE_SPV_UP = "WHERE (a.created_by = '$username')";

		$WHERE_APP = "WHERE (e.emp_no = '$username') AND xdec1.sts IN ('1','2','3','5')";
		$WHERE_APP_SPV_UP = "WHERE (e.emp_no = '$username') AND xdec1.sts IN ('1','2','3','5')";

		$WHERE_APPRAISAL_REQUEST = "WHERE (c.emp_no = '$username') AND xdec2.sts = '3'";
		$WHERE_APPRAISAL_REQUEST_SPV_UP = "WHERE (c.emp_no = '$username') AND xdec2.sts = '3'";

		$WHERE_APP_APPRAISAL = "WHERE (e.emp_no = '$username') AND xdec1.sts IN ('1','2','3','5')";
		$WHERE_APP_APPRAISAL_SPV_UP = "WHERE (e.emp_no = '$username') AND xdec1.sts IN ('1','2','3','5')";

		$WHERE_RECORD_ENTRY = "WHERE (a.requester = '$username') AND xdec1.sts IN ('3')";
		$WHERE_RECORD_ENTRY_SPV_UP = "WHERE (a.requester = '$username') AND xdec1.sts IN ('3')";

		$WHERE_RECORD = "WHERE (e.emp_no = '$username') AND xdec1.sts IN ('3')";
		$WHERE_RECORD_SPV_UP = "WHERE (e.emp_no = '$username') AND xdec1.sts IN ('3')";

		$WHERE_FINAL_RESULT = "WHERE (d.user_type='SuperAdmin')";

	} else if($getdata == 1 && $getdata2 == 1 && $getdata3 == 1) {
		$WHERE = "WHERE (a.created_by = '$username') AND a.pa_reqno LIKE '%$_GET[src_kpi_no]%' AND a.requester LIKE '%$_GET[src_employee_no]%' AND xdec1.sts LIKE '%$_GET[src_request_status]%'";
		$WHERE_SPV_UP = "WHERE (a.created_by = '$username') AND a.ipp_reqno LIKE '%$_GET[src_kpi_no]%' AND a.requester LIKE '%$_GET[src_employee_no]%' AND xdec1.sts LIKE '%$_GET[src_request_status]%'";

		$WHERE_APP = "WHERE (e.emp_no = '$username') AND a.pa_reqno LIKE '%$_GET[src_kpi_no]%' AND a.requester LIKE '%$_GET[src_employee_no]%' AND xdec1.sts LIKE '%$_GET[src_request_status]%' AND xdec1.sts IN ('1','2','3','5')";
		$WHERE_APP_SPV_UP = "WHERE (e.emp_no = '$username') AND a.ipp_reqno LIKE '%$_GET[src_kpi_no]%' AND a.requester LIKE '%$_GET[src_employee_no]%' AND xdec1.sts LIKE '%$_GET[src_request_status]%' AND xdec1.sts IN ('1','2','3','5')";

		$WHERE_APPRAISAL_REQUEST = "WHERE (c.emp_no = '$username') AND a.pa_reqno LIKE '%$_GET[src_kpi_no]%' AND a.requester LIKE '%$_GET[src_employee_no]%' AND xdec1.sts LIKE '%$_GET[src_request_status]%' AND xdec2.sts IN ('3')";
		$WHERE_APPRAISAL_REQUEST_SPV_UP = "WHERE (c.emp_no = '$username') AND a.ipp_reqno LIKE '%$_GET[src_kpi_no]%' AND a.requester LIKE '%$_GET[src_employee_no]%' AND xdec1.sts LIKE '%$_GET[src_request_status]%' AND xdec2.sts IN ('3')";

		$WHERE_APP_APPRAISAL = "WHERE (e.emp_no = '$username') AND a.ipa_reqno LIKE '%$_GET[src_kpi_no]%' AND a.requester LIKE '%$_GET[src_employee_no]%' AND xdec1.sts LIKE '%$_GET[src_request_status]%' AND xdec1.sts IN ('1','2','3','5')";
		$WHERE_APP_APPRAISAL_SPV_UP = "WHERE (e.emp_no = '$username') AND a.ipa_reqno LIKE '%$_GET[src_kpi_no]%' AND a.requester LIKE '%$_GET[src_employee_no]%' AND xdec1.sts LIKE '%$_GET[src_request_status]%' AND xdec1.sts IN ('1','2','3','5')";

		$WHERE_RECORD = "WHERE (e.emp_no = '$username') AND c.Full_Name LIKE '%$_GET[src_full_name]%' AND a.requester LIKE '%$_GET[src_employee_no]%' AND a.ipp_reqno LIKE '%$_GET[src_kpi_no]%' AND xdec1.sts IN ('3')";
		$WHERE_RECORD_SPV_UP = "WHERE (e.emp_no = '$username') AND c.Full_Name LIKE '%$_GET[src_full_name]%' AND a.requester LIKE '%$_GET[src_employee_no]%' AND a.ipp_reqno LIKE '%$_GET[src_kpi_no]%' AND xdec1.sts IN ('3')";

		$WHERE_FINAL_RESULT = "WHERE (d.user_type='SuperAdmin') AND a.ipp_reqno LIKE '%$_GET[src_kpi_no]%' AND a.request_for LIKE '%$_GET[src_employee_no]%' AND b.Full_Name LIKE '%$_GET[src_full_name]%'";

	} else if($getdata == 0 && $getdata2 == 0 && $getdata3 == 1) {
		$WHERE = "WHERE (a.created_by = '$username') AND xdec1.sts LIKE '%$_GET[src_request_status]%'";
		$WHERE_SPV_UP = "WHERE (a.created_by = '$username') AND xdec1.sts LIKE '%$_GET[src_request_status]%'";

		$WHERE_APP = "WHERE (e.emp_no = '$username') AND xdec1.sts LIKE '%$_GET[src_request_status]%' AND xdec1.sts IN ('1','2','3','5')";
		$WHERE_APP_SPV_UP = "WHERE (e.emp_no = '$username') AND xdec1.sts LIKE '%$_GET[src_request_status]%' AND xdec1.sts IN ('1','2','3','5')";

		$WHERE_APPRAISAL_REQUEST = "WHERE (c.emp_no = '$username') AND xdec1.sts LIKE '%$_GET[src_request_status]%'";
		$WHERE_APPRAISAL_REQUEST_SPV_UP = "WHERE (c.emp_no = '$username') AND xdec1.sts LIKE '%$_GET[src_request_status]%'";

		$WHERE_APP_APPRAISAL = "WHERE (e.emp_no = '$username') AND xdec1.sts LIKE '%$_GET[src_request_status]%' AND xdec2.sts = '3'";
		$WHERE_APP_APPRAISAL_SPV_UP = "WHERE (e.emp_no = '$username') AND xdec1.sts LIKE '%$_GET[src_request_status]%' AND xdec2.sts = '3'";

		$WHERE_RECORD = "WHERE (e.emp_no = '$username') AND c.Full_Name LIKE '%$_GET[src_full_name]%' AND xdec1.sts IN ('3')";
		$WHERE_RECORD_SPV_UP = "WHERE (e.emp_no = '$username') AND c.Full_Name LIKE '%$_GET[src_full_name]%' AND xdec1.sts IN ('3')";

		$WHERE_FINAL_RESULT = "WHERE (d.user_type='SuperAdmin') AND b.Full_Name LIKE '%$_GET[src_full_name]%'";

	} else if($getdata == 0 && $getdata2 == 1 && $getdata3 == 0) {
		$WHERE = "WHERE (a.created_by = '$username') AND a.requester LIKE '%$_GET[src_employee_no]%'";
		$WHERE_SPV_UP = "WHERE (a.created_by = '$username') AND a.requester LIKE '%$_GET[src_employee_no]%'";

		$WHERE_APP = "WHERE (e.emp_no = '$username') AND a.requester LIKE '%$_GET[src_employee_no]%' AND xdec1.sts IN ('1','2','3','5')";
		$WHERE_APP_SPV_UP = "WHERE (e.emp_no = '$username') AND a.requester LIKE '%$_GET[src_employee_no]%' AND xdec1.sts IN ('1','2','3','5')";

		$WHERE_APPRAISAL_REQUEST = "WHERE (c.emp_no = '$username') AND a.requester LIKE '%$_GET[src_employee_no]%' AND xdec2.sts IN ('3')";
		$WHERE_APPRAISAL_REQUEST_SPV_UP = "WHERE (c.emp_no = '$username') AND a.requester LIKE '%$_GET[src_employee_no]%' AND xdec2.sts IN ('3')";

		$WHERE_APP_APPRAISAL = "WHERE (e.emp_no = '$username') AND a.requester LIKE '%$_GET[src_employee_no]%' AND xdec1.sts IN ('1','2','3','5')";
		$WHERE_APP_APPRAISAL_SPV_UP = "WHERE (e.emp_no = '$username') AND a.requester LIKE '%$_GET[src_employee_no]%' AND xdec1.sts IN ('1','2','3','5')";

		$WHERE_RECORD = "WHERE (e.emp_no = '$username') AND a.requester LIKE '%$_GET[src_employee_no]%' AND xdec1.sts IN ('3')";
		$WHERE_RECORD_SPV_UP = "WHERE (e.emp_no = '$username') AND a.requester LIKE '%$_GET[src_employee_no]%' AND xdec1.sts IN ('3')";

		$WHERE_FINAL_RESULT = "WHERE (d.user_type='SuperAdmin') AND a.request_for LIKE '%$_GET[src_employee_no]%'";
		
	} else if($getdata == 1 && $getdata2 == 0 && $getdata3 == 0) {
		$WHERE = "WHERE (a.created_by = '$username') AND a.pa_reqno LIKE '%$_GET[src_kpi_no]%'";
		$WHERE_SPV_UP = "WHERE (a.created_by = '$username') AND a.ipp_reqno LIKE '%$_GET[src_kpi_no]%'";

		$WHERE_APP = "WHERE (e.emp_no = '$username') AND a.pa_reqno LIKE '%$_GET[src_kpi_no]%' AND xdec1.sts IN ('1','2','3','5')";
		$WHERE_APP_SPV_UP = "WHERE (e.emp_no = '$username') AND a.ipp_reqno LIKE '%$_GET[src_kpi_no]%' AND xdec1.sts IN ('1','2','3','5')";

		$WHERE_APPRAISAL_REQUEST = "WHERE (c.emp_no = '$username') AND a.pa_reqno LIKE '%$_GET[src_kpi_no]%' AND xdec2.sts IN ('3')";
		$WHERE_APPRAISAL_REQUEST_SPV_UP = "WHERE (c.emp_no = '$username') AND a.ipp_reqno LIKE '%$_GET[src_kpi_no]%' AND xdec2.sts IN ('3')";

		$WHERE_APP_APPRAISAL = "WHERE (e.emp_no = '$username') AND a.ipa_reqno LIKE '%$_GET[src_kpi_no]%' AND xdec1.sts IN ('1','2','3','5')";
		$WHERE_APP_APPRAISAL_SPV_UP = "WHERE (e.emp_no = '$username') AND a.ipa_reqno LIKE '%$_GET[src_kpi_no]%' AND xdec1.sts IN ('1','2','3','5')";

		$WHERE_RECORD = "WHERE (e.emp_no = '$username') AND a.ipp_reqno LIKE '%$_GET[src_kpi_no]%' AND xdec1.sts IN ('3')";
		$WHERE_RECORD_SPV_UP = "WHERE (e.emp_no = '$username') AND a.ipp_reqno LIKE '%$_GET[src_kpi_no]%' AND xdec1.sts IN ('3')";

		$WHERE_FINAL_RESULT = "WHERE (d.user_type='SuperAdmin') AND a.ipp_reqno LIKE '%$_GET[src_kpi_no]%'";

	} else if($getdata == 0 && $getdata2 == 1 && $getdata3 == 1) {
		$WHERE = "WHERE (a.created_by = '$username') AND a.requester LIKE '%$_GET[src_employee_no]%' AND xdec1.sts LIKE '%$_GET[src_request_status]%'";
		$WHERE_SPV_UP = "WHERE (a.created_by = '$username') AND a.requester LIKE '%$_GET[src_employee_no]%' AND xdec1.sts LIKE '%$_GET[src_request_status]%'";

		$WHERE_APP = "WHERE (e.emp_no = '$username') AND a.requester LIKE '%$_GET[src_employee_no]%' AND xdec1.sts LIKE '%$_GET[src_request_status]%' AND xdec1.sts IN ('1','2','3','5')";
		$WHERE_APP_SPV_UP = "WHERE (e.emp_no = '$username') AND a.requester LIKE '%$_GET[src_employee_no]%' AND xdec1.sts LIKE '%$_GET[src_request_status]%' AND xdec1.sts IN ('1','2','3','5')";

		$WHERE_APPRAISAL_REQUEST = "WHERE (c.emp_no = '$username') AND a.requester LIKE '%$_GET[src_employee_no]%' AND xdec1.sts LIKE '%$_GET[src_request_status]%' AND xdec2.sts IN ('3')";
		$WHERE_APPRAISAL_REQUEST_SPV_UP = "WHERE (c.emp_no = '$username') AND a.requester LIKE '%$_GET[src_employee_no]%' AND xdec1.sts LIKE '%$_GET[src_request_status]%' AND xdec2.sts IN ('3')";

		$WHERE_APP_APPRAISAL = "WHERE (e.emp_no = '$username') AND a.requester LIKE '%$_GET[src_employee_no]%' AND xdec1.sts LIKE '%$_GET[src_request_status]%' AND xdec1.sts IN ('1','2','3','5')";
		$WHERE_APP_APPRAISAL_SPV_UP = "WHERE (e.emp_no = '$username') AND a.requester LIKE '%$_GET[src_employee_no]%' AND xdec1.sts LIKE '%$_GET[src_request_status]%' AND xdec1.sts IN ('1','2','3','5')";

		$WHERE_RECORD = "WHERE (e.emp_no = '$username') AND a.requester LIKE '%$_GET[src_employee_no]%' AND c.Full_Name LIKE '%$_GET[src_full_name]%' AND xdec1.sts IN ('3')";
		$WHERE_RECORD_SPV_UP = "WHERE (e.emp_no = '$username') AND a.requester LIKE '%$_GET[src_employee_no]%' AND c.Full_Name LIKE '%$_GET[src_full_name]%' AND xdec1.sts IN ('3')";
		
		$WHERE_FINAL_RESULT = "WHERE (d.user_type='SuperAdmin')";

	} else if($getdata == 1 && $getdata2 == 1 && $getdata3 == 0) {
		$WHERE = "WHERE (a.created_by = '$username') AND a.pa_reqno LIKE '%$_GET[src_kpi_no]%' AND a.requester LIKE '%$_GET[src_employee_no]%'";
		$WHERE_SPV_UP = "WHERE (a.created_by = '$username') AND a.ipp_reqno LIKE '%$_GET[src_kpi_no]%' AND a.requester LIKE '%$_GET[src_employee_no]%'";
		
		$WHERE_APP = "WHERE (e.emp_no = '$username') AND a.pa_reqno LIKE '%$_GET[src_kpi_no]%' AND a.requester LIKE '%$_GET[src_employee_no]%' AND xdec1.sts IN ('1','2','3','5')";
		$WHERE_APP_SPV_UP = "WHERE (e.emp_no = '$username') AND a.ipp_reqno LIKE '%$_GET[src_kpi_no]%' AND a.requester LIKE '%$_GET[src_employee_no]%' AND xdec1.sts IN ('1','2','3','5')";

		$WHERE_APPRAISAL_REQUEST = "WHERE (c.emp_no = '$username') AND a.pa_reqno LIKE '%$_GET[src_kpi_no]%' AND a.requester LIKE '%$_GET[src_employee_no]%' AND xdec2.sts IN ('3')";
		$WHERE_APPRAISAL_REQUEST_SPV_UP = "WHERE (c.emp_no = '$username') AND a.ipp_reqno LIKE '%$_GET[src_kpi_no]%' AND a.requester LIKE '%$_GET[src_employee_no]%' AND xdec2.sts IN ('3')";

		$WHERE_APP_APPRAISAL = "WHERE (e.emp_no = '$username') AND a.ipa_reqno LIKE '%$_GET[src_kpi_no]%' AND a.requester LIKE '%$_GET[src_employee_no]%' AND xdec1.sts IN ('1','2','3','5')";
		$WHERE_APP_APPRAISAL_SPV_UP = "WHERE (e.emp_no = '$username') AND a.ipa_reqno LIKE '%$_GET[src_kpi_no]%' AND a.requester LIKE '%$_GET[src_employee_no]%' AND xdec1.sts IN ('1','2','3','5')";

		$WHERE_RECORD = "WHERE (e.emp_no = '$username') AND a.requester LIKE '%$_GET[src_employee_no]%' AND a.ipp_reqno LIKE '%$_GET[src_kpi_no]%' AND xdec1.sts IN ('3')";
		$WHERE_RECORD_SPV_UP = "WHERE (e.emp_no = '$username') AND a.requester LIKE '%$_GET[src_employee_no]%' AND a.ipp_reqno LIKE '%$_GET[src_kpi_no]%' AND xdec1.sts IN ('3')";

		$WHERE_FINAL_RESULT = "WHERE (d.user_type='SuperAdmin')  AND a.ipp_reqno LIKE '%$_GET[src_kpi_no]%' AND a.request_for LIKE '%$_GET[src_employee_no]%'";

	} else if($getdata == 1 && $getdata2 == 0 && $getdata3 == 1) {
		$WHERE = "WHERE (a.created_by = '$username') AND a.pa_reqno LIKE '%$_GET[src_kpi_no]%' AND xdec1.sts LIKE '%$_GET[src_request_status]%'";
		$WHERE_SPV_UP = "WHERE (a.created_by = '$username') AND a.ipp_reqno LIKE '%$_GET[src_kpi_no]%' AND xdec1.sts LIKE '%$_GET[src_request_status]%'";

		$WHERE_APP = "WHERE (e.emp_no = '$username') AND a.pa_reqno LIKE '%$_GET[src_kpi_no]%' AND xdec1.sts LIKE '%$_GET[src_request_status]%' AND xdec1.sts IN ('1','2','3','5')";
		$WHERE_APP_SPV_UP = "WHERE (e.emp_no = '$username') AND a.ipp_reqno LIKE '%$_GET[src_kpi_no]%' AND xdec1.sts LIKE '%$_GET[src_request_status]%' AND xdec1.sts IN ('1','2','3','5')";

		$WHERE_APPRAISAL_REQUEST = "WHERE (c.emp_no = '$username') AND a.pa_reqno LIKE '%$_GET[src_kpi_no]%' AND xdec1.sts LIKE '%$_GET[src_request_status]%' AND xdec2.sts IN ('3')";
		$WHERE_APPRAISAL_REQUEST_SPV_UP = "WHERE (c.emp_no = '$username') AND a.ipp_reqno LIKE '%$_GET[src_kpi_no]%' AND xdec1.sts LIKE '%$_GET[src_request_status]%' AND xdec2.sts IN ('3')";

		$WHERE_APP_APPRAISAL = "WHERE (e.emp_no = '$username') AND a.ipa_reqno LIKE '%$_GET[src_kpi_no]%' AND xdec1.sts LIKE '%$_GET[src_request_status]%' AND xdec1.sts IN ('1','2','3','5')";
		$WHERE_APP_APPRAISAL_SPV_UP = "WHERE (e.emp_no = '$username') AND a.ipa_reqno LIKE '%$_GET[src_kpi_no]%' AND xdec1.sts LIKE '%$_GET[src_request_status]%' AND xdec1.sts IN ('1','2','3','5')";

		$WHERE_RECORD = "WHERE (e.emp_no = '$username') AND a.ipa_reqno LIKE '%$_GET[src_kpi_no]%' AND c.Full_Name LIKE '%$_GET[src_full_name]%' AND xdec1.sts IN ('3')";
		$WHERE_RECORD_SPV_UP = "WHERE (e.emp_no = '$username') AND a.ipa_reqno LIKE '%$_GET[src_kpi_no]%' AND c.Full_Name LIKE '%$_GET[src_full_name]%' AND xdec1.sts IN ('3')";

		$WHERE_FINAL_RESULT = "WHERE (d.user_type='SuperAdmin')  AND a.ipp_reqno LIKE '%$_GET[src_kpi_no]%' AND b.Full_Name LIKE '%$_GET[src_full_name]%'";
	} 
	
?>