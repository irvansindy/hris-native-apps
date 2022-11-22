<?php
	!empty($_GET['src_schedulegroup_code']) ? $getdata = '1' : $getdata = '0';
	!empty($_GET['src_schedulegroup_desc']) ? $getdata2 = '1' : $getdata2 = '0';
	if($getdata == 0 && $getdata2 == 0) {
		$WHERE = "";
	} else if($getdata == 1 && $getdata2 == 1) {
		$WHERE = "WHERE a.schedulegroup_code LIKE '%$_GET[src_schedulegroup_code]%' AND a.schedulegroup_desc LIKE '%$_GET[src_schedulegroup_desc]%'";
	} else if($getdata == 1 && $getdata2 == 0) {
		$WHERE = "WHERE a.schedulegroup_code LIKE '%$_GET[src_schedulegroup_code]%'";
	} else if($getdata == 0 && $getdata2 == 1) {
		$WHERE = "WHERE a.schedulegroup_desc LIKE '%$_GET[src_schedulegroup_desc]%'";
	} 
?>