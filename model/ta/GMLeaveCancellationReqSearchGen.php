<?php 
// Include the database configuration file
       // AgusPrass 04/03/2021 Mengganti logic IF pada search
       $inp_req             = '';
       $inp_date            = '';
       $inp_enddate         = '';

       if (!empty($_POST['inp_req']) && !empty($_POST['inp_date']) && !empty($_POST['inp_enddate'])) {
              $inp_req             = $_POST['inp_req'];
              $inp_date            = $_POST['inp_date'];
              $inp_enddate         = $_POST['inp_enddate'];
              $where               = "WHERE ((b.emp_no='$username') or (a.created_by='$username')) AND  
                                          (a.request_no like '$inp_req') AND
                                          (DATE(a.requestdate) >= '$inp_date' AND DATE(a.requestdate) <= '$inp_enddate')";
       } elseif (!empty($_POST['inp_req']) && !empty($_POST['inp_date'])) {
              $inp_req             = $_POST['inp_req'];
              $inp_date            = $_POST['inp_date'];
              $where               = "WHERE ((b.emp_no='$username') or (a.created_by='$username')) AND  
                                          (a.request_no like '$inp_req') AND
                                          DATE(a.requestdate) = '$inp_date'";

       } elseif (!empty($_POST['inp_req'])) {
              $inp_req             = $_POST['inp_req'];
              $where               = "WHERE ((b.emp_no='$username') or (a.created_by='$username')) AND  
                                                                      (a.request_no like '$inp_req')";
                                   
       // AgusPrass 04/03/2021 Menambahkan Logic untuk search jika request number tidak terisi
       } elseif(empty($_POST['inp_req']) && !empty($_POST['inp_date']) && !empty($_POST['inp_enddate'])){
              $inp_date            = $_POST['inp_date'];
              $inp_enddate         = $_POST['inp_enddate'];
              $where               = "WHERE ((b.emp_no='$username') or (a.created_by='$username')) AND
                                          (DATE(a.requestdate) >= '$inp_date' AND DATE(a.requestdate) <= '$inp_enddate')";
       
       }elseif(empty($_POST['inp_req']) && !empty($_POST['inp_date'])){
              $inp_date            = $_POST['inp_date'];
              $where               = "WHERE ((b.emp_no='$username') or (a.created_by='$username')) AND DATE(a.requestdate) LIKE '$inp_date'";
                                                                      
       }elseif(empty($_POST['inp_req']) && !empty($_POST['inp_enddate'])){
              $inp_enddate         = $_POST['inp_enddate'];
              $where               = "WHERE ((b.emp_no='$username') or (a.created_by='$username')) AND DATE(a.requestdate) LIKE '$inp_enddate'";
       }

       else {
              $where               = "WHERE ((b.emp_no='$username') or (a.created_by='$username'))";
       }





	if (isset($_POST["limit"], $_POST["start"])) {
		$page = $_POST["limit"];
		$limit = $_POST["start"];
	}else{
		$page = 0;
		$limit = 10;
	}


                    
			if (!empty($_GET['src_leave_request']) && !empty($_GET['src_leave_request_cancel'])) {
				$src_leave_request 	       = $_GET['src_leave_request'];
				$src_leave_request_cancel   = $_GET['src_leave_request_cancel'];
				$where_srv 			= "WHERE ((b.emp_no='$username') or (a.created_by='$username')) AND (a.leaverequest_no LIKE '%$src_leave_request%') AND (a.request_no = '$src_leave_request_cancel')";

			} elseif (!empty($_GET['src_leave_request']) && empty($_GET['src_leave_request_cancel'])) {
				$src_leave_request 	       = $_GET['src_leave_request'];
				$src_leave_request_cancel   = $_GET['src_leave_request_cancel'];
				$where_srv 			= "WHERE ((b.emp_no='$username') or (a.created_by='$username')) AND (a.leaverequest_no LIKE '%$src_leave_request%')";
			
			} elseif (empty($_GET['src_leave_request']) && !empty($_GET['src_leave_request_cancel'])) {
				$src_leave_request 	       = $_GET['src_leave_request'];
				$src_leave_request_cancel   = $_GET['src_leave_request_cancel'];
				$where_srv 			= "WHERE ((b.emp_no='$username') or (a.created_by='$username')) AND (a.request_no = '$src_leave_request_cancel')";

			} else {
				$where_srv 			= "WHERE ((b.emp_no='$username') or (a.created_by='$username'))";
			}

                   
?>