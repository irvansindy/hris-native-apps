<?php
	!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0'; 
	if($getdata == 0) {
		include "../../../application/session/sessionlv2.php";
	} else {
		include "../../../application/session/mobile.session.php";	
	}

	!empty($_GET['src_perf']) ? $getdata = '1' : $getdata = '0';
	!empty($_GET['src_perf_grade']) ? $getdata1 = '1' : $getdata1 = '0';
	
	if($getdata == 1 && $getdata1 == 0) {
		$WHERE = "WHERE (a.pa_grade = '$_GET[src_perf]')";
	} else if($getdata == 0 && $getdata1 == 1) {
		$WHERE = "WHERE (a.pa_grade_adjust = '$_GET[src_perf_grade]')";
    } else if($getdata == 1 && $getdata1 == 1) {
		$WHERE = "WHERE (a.pa_grade = '$_GET[src_perf]') AND (a.pa_grade_adjust = '$_GET[src_perf_grade]')";
    }
	
?>