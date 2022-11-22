<?php
	!empty($_GET['src_category_code']) ? $getdata = '1' : $getdata = '0';
	!empty($_GET['src_category_name_en']) ? $getdata2 = '1' : $getdata2 = '0';
	if($getdata == 0 && $getdata2 == 0) {
		$WHERE = "";
	} else if($getdata == 1 && $getdata2 == 1) {
		$WHERE = "WHERE a.category_code LIKE '%$_GET[src_category_code]%' AND a.category_name_en LIKE '%$_GET[src_category_name_en]%'";
	} else if($getdata == 1 && $getdata2 == 0) {
		$WHERE = "WHERE a.category_code LIKE '%$_GET[src_category_code]%'";
	} else if($getdata == 0 && $getdata2 == 1) {
		$WHERE = "WHERE a.category_name_en LIKE '%$_GET[src_category_name_en]%'";
	} 
?>