<?php
	!empty($_GET['src_reason_code']) ? $getdata = '1' : $getdata = '0';
	!empty($_GET['src_reason_name_en']) ? $getdata2 = '1' : $getdata2 = '0';
	if($getdata == 0 && $getdata2 == 0) {
		$WHERE = "";
	} else if($getdata == 1 && $getdata2 == 1) {
		$WHERE = "WHERE a.reason_code = '$_GET[src_reason_code]' AND a.reason_name_en = '$_GET[src_reason_name_en]'";
	} else if($getdata == 1 && $getdata2 == 0) {
		$WHERE = "WHERE a.reason_code = '$_GET[src_reason_code]'";
	} else if($getdata == 0 && $getdata2 == 1) {
		$WHERE = "WHERE a.reason_name_en = '$_GET[src_reason_name_en]'";
	} 
?>