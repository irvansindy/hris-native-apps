<?php
	!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0'; 
	if($getdata == 0) {
		include "../../../application/session/sessionlv2.php";
	} else {
		include "../../../application/session/mobile.session.php";	
	}

	!empty($_GET['src_request_no']) ? $getdata = '1' : $getdata = '0';
	!empty($_GET['src_request_status']) ? $getdata2 = '1' : $getdata2 = '0';
	
	if($getdata == 0 && $getdata2 == 0) {
		$WHERE_APP = "WHERE (e.emp_no = '$username') AND xdec1.status IN ('1','2','3','5')";
	} else if($getdata == 1 && $getdata2 == 1) {
		$WHERE_APP = "WHERE (e.emp_no = '$username') AND xdec1.status LIKE '%$_GET[src_request_status]%' AND a.request_no LIKE '%$_GET[src_request_no]%'";
	} else if($getdata == 1 && $getdata2 == 0) {
		$WHERE_APP = "WHERE (e.emp_no = '$username') AND a.request_no LIKE '%$_GET[src_request_no]%'";
	} else if($getdata == 0 && $getdata2 == 1) {
		$WHERE_APP = "WHERE (e.emp_no = '$username') AND xdec1.status LIKE '%$_GET[src_request_status]%'";
	}
?>