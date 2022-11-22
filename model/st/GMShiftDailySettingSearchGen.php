<?php
			
			if (!empty($_POST['src_shiftcode']) && !empty($_POST['src_daytype'])) {
				$src_shiftcode 	= $_POST['src_shiftcode'];
				$src_daytype    = $_POST['src_daytype'];
				$where 			= "WHERE (a.shiftdailycode LIKE '%$src_shiftcode%') AND (a.daytype = '$src_daytype')";

			} elseif (!empty($_POST['src_shiftcode']) && empty($_POST['src_daytype'])) {
				$src_shiftcode 	= $_POST['src_shiftcode'];
				$src_daytype    = $_POST['src_daytype'];
				$where 			= "WHERE (a.shiftdailycode LIKE '%$src_shiftcode%')";
			
			} elseif (empty($_POST['src_shiftcode']) && !empty($_POST['src_daytype'])) {
				$src_shiftcode 	= $_POST['src_shiftcode'];
				$src_daytype    = $_POST['src_daytype'];
				$where 			= "WHERE (a.daytype = '$src_daytype')";

			} else {
				$where 			= "";
			}
	
			if (isset($_POST["limit"], $_POST["start"])) {
				$limit = $_POST["start"];
				$page = $_POST["limit"];
			}else{
				$page = 0;
				$limit = 10;
			}
	?>