<?php 
require_once '../../../application/config.php';

//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$sel_ls_process_order	= strtoupper($_POST['sel_ls_process_order']);
	$sel_ls_ordering		= strtoupper($_POST['sel_ls_ordering']);
	$sel_process_order		= strtoupper($_POST['sel_process_order']);
	$sel_formula			= addslashes($_POST['sel_formula']);

		$start = $_POST['sel_process_order'];
		$end = $_POST['sel_ls_process_order'];
		

		$getdata = mysqli_query($connect, "SELECT * FROM hrmattformula WHERE ordering = '$start'");
		$ada = "SELECT * FROM hrmattformula WHERE ordering = '$start'";
		if(mysqli_num_rows($getdata) > '0') {
			$getdata_r = mysqli_fetch_array($getdata);
			$getdata_r_process_order = $getdata_r['process_order'];

			$sql = "UPDATE hrmattformula SET
					`ordering`		= '$sel_ls_ordering'
				WHERE process_order 		= '$getdata_r_process_order'";
			// condition start
			$query = $connect->query($sql);
		}


		$sql = "UPDATE hrmattformula SET 
					`ordering`		= '$sel_process_order',
					`attformula`	 	= '$sel_formula'
				WHERE process_order 		= '$sel_ls_process_order'";

		// condition start
		$query = $connect->query($sql);
		// $sql1 = "UPDATE hrmattformula SET 
		// 				`ordering`		= '$sel_ls_process_order'	
		// 			WHERE process_order 		= '$sel_process_order'";
		// // condition start
		// $query1 = $connect->query($sql1);


	

	if($query == TRUE) {						
		$validator['success'] = true;
		$validator['code'] = "success_message";
		$validator['messages'] = "Successfully Update data";			
	} else {		
		$validator['success'] = false;
		$validator['code'] = "failed_message";
		$validator['messages'] = "Failed Update data";	
	}
	// condition ends

	// close the database connection
	$connect->close();
	echo json_encode($validator);
}