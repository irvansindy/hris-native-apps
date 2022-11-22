<?php
			
			if (!empty($_POST['src_shiftgroupcode']) && !empty($_POST['src_shiftgroupname'])) {
				$src_shiftgroupcode 	= $_POST['src_shiftgroupcode'];
				$src_shiftgroupname  = $_POST['src_shiftgroupname'];
				$where 		= "WHERE (aa.shiftgroupcode LIKE '%$src_shiftgroupcode%') AND (aa.shiftgroupname LIKE '%$src_shiftgroupname%')";

			} elseif (!empty($_POST['src_shiftgroupcode']) && empty($_POST['src_shiftgroupname'])) {
				$src_shiftgroupcode 	= $_POST['src_shiftgroupcode'];
				$src_shiftgroupname  = $_POST['src_shiftgroupname'];
				$where 		= "WHERE (aa.shiftgroupcode LIKE '%$src_shiftgroupcode%')";
			
			} elseif (empty($_POST['src_shiftgroupcode']) && !empty($_POST['src_shiftgroupname'])) {
				$src_shiftgroupcode 	= $_POST['src_shiftgroupcode'];
				$src_shiftgroupname  = $_POST['src_shiftgroupname'];
				$where 		= "WHERE (aa.shiftgroupname LIKE '%$src_shiftgroupname%')";

			} else {
				$where 		= "";
			}
	
			if (isset($_POST["limit"], $_POST["start"])) {
				$limit = $_POST["start"];
				$page = $_POST["limit"];
			}else{
				$page = 0;
				$limit = 10;
			}
	?>