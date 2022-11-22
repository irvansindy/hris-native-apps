<?php
	!empty($_GET['src_news']) ? $getdata = '1' : $getdata = '0';
	!empty($_GET['src_title']) ? $getdata2 = '1' : $getdata2 = '0';
	if($getdata == 0 && $getdata2 == 0) {
		$WHERES = "";
	} else if($getdata == 1 && $getdata2 == 1) {
		$WHERES = "WHERE a.isi_berita LIKE '%$_GET[src_news]%' AND a.judul LIKE '%$_GET[src_title]%'";
	} else if($getdata == 1 && $getdata2 == 0) {
		$WHERES = "WHERE a.isi_berita LIKE '%$_GET[src_news]%'";
	} else if($getdata == 0 && $getdata2 == 1) {
		$WHERES = "WHERE a.judul LIKE '%$_GET[src_title]%'";
	} 
?>