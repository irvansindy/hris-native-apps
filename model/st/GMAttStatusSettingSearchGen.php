<?php
			
			if (!empty($_POST['src_attend_code']) && !empty($_POST['src_attend_name_id'])) {
				$src_attend_code = $_POST['src_attend_code'];
				$src_attend_name_id = $_POST['src_attend_name_id'];
				$where = "WHERE (a.attend_code LIKE '%$src_attend_code%') AND (a.attend_name_id LIKE '%$src_attend_name_id%')";

			} elseif (!empty($_POST['src_attend_code']) && empty($_POST['src_attend_name_id'])) {
				$src_attend_code = $_POST['src_attend_code'];
				$src_attend_name_id = $_POST['src_attend_name_id'];
				$where = "WHERE (a.attend_code LIKE '%$src_attend_code%')";
			
			} elseif (empty($_POST['src_attend_code']) && !empty($_POST['src_attend_name_id'])) {
				$src_attend_code = $_POST['src_attend_code'];
				$src_attend_name_id = $_POST['src_attend_name_id'];
				$where = "WHERE (a.attend_name_id = '$src_attend_name_id')";

			} else {
				$where = "";
			}
	
			if (isset($_POST["limit"], $_POST["start"])) {
				$limit = $_POST["start"];
				$page = $_POST["limit"];
			}else{
				$page = 0;
				$limit = 10;
			}
	?>