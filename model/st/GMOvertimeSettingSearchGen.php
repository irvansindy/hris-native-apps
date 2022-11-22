<?php
	!empty($_GET['src_overtimecode']) ? $getdata = '1' : $getdata = '0';
	!empty($_GET['src_minimumtime']) ? $getdata2 = '1' : $getdata2 = '0';
	if($getdata == 0 && $getdata2 == 0) {
		$WHERE = "";
	} else if($getdata == 1 && $getdata2 == 1) {
		$WHERE = "WHERE a.overtime_code = '$_GET[src_overtimecode]' AND a.overtime_minimum = '$_GET[src_minimumtime]'";
	} else if($getdata == 1 && $getdata2 == 0) {
		$WHERE = "WHERE a.overtime_code = '$_GET[src_overtimecode]'";
	} else if($getdata == 0 && $getdata2 == 1) {
		$WHERE = "WHERE a.overtime_minimum = '$_GET[src_minimumtime]'";
	} 
?>