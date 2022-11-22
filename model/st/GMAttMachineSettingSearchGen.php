<?php
			
			if (!empty($_POST['src_machine_code']) && !empty($_POST['src_method'])) {
				$src_machine_code 	= $_POST['src_machine_code'];
				$src_method    = $_POST['src_method'];
				$where 			= "WHERE (a.machine_code LIKE '%$src_machine_code%') AND (a.method = '$src_method')";

			} elseif (!empty($_POST['src_machine_code']) && empty($_POST['src_method'])) {
				$src_machine_code 	= $_POST['src_machine_code'];
				$src_method    = $_POST['src_method'];
				$where 			= "WHERE (a.machine_code LIKE '%$src_machine_code%')";
			
			} elseif (empty($_POST['src_machine_code']) && !empty($_POST['src_method'])) {
				$src_machine_code 	= $_POST['src_machine_code'];
				$src_method    = $_POST['src_method'];
				$where 			= "WHERE (a.method = '$src_method')";

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