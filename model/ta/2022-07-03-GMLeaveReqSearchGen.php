<?php 
// Include the database configuration file

       if (!empty($_POST['inp_req']) && !empty($_POST['inp_date']) && !empty($_POST['inp_enddate'])) {
              $inp_req             = $_POST['inp_req'];
              $inp_date            = $_POST['inp_date'];
              $inp_enddate         = $_POST['inp_enddate'];
              $where               = "WHERE ((b.emp_no='$username') or (a.created_by='$username')) AND  
                                          (a.request_no like '$inp_req') AND
                                          (DATE(a.leave_startdate) >= '$inp_date' AND DATE(a.leave_enddate) <= '$inp_enddate')";
       } elseif (!empty($_POST['inp_req']) && !empty($_POST['inp_date'])) {
              $inp_req             = $_POST['inp_req'];
              $inp_date            = $_POST['inp_date'];
              $where               = "WHERE ((b.emp_no='$username') or (a.created_by='$username')) AND  
                                          (a.request_no like '$inp_req') AND
                                          DATE(a.leave_startdate) = '$inp_date'";

       } elseif (!empty($_POST['inp_req'])) {
              $inp_req             = $_POST['inp_req'];
              $where               = "WHERE ((b.emp_no='$username') or (a.created_by='$username')) AND  
                                                                      (a.request_no like '$inp_req')";
                                   
       // AgusPrass 04/03/2021 Menambahkan Logic untuk search jika request number tidak terisi
       } elseif(empty($_POST['inp_req']) && !empty($_POST['inp_date']) && !empty($_POST['inp_enddate'])){
              $inp_date            = $_POST['inp_date'];
              $inp_enddate         = $_POST['inp_enddate'];
              $where               = "WHERE ((b.emp_no='$username') or (a.created_by='$username')) AND
                                          (DATE(a.leave_startdate) >= '$inp_date' AND DATE(a.leave_enddate) <= '$inp_enddate')";
       
       }elseif(empty($_POST['inp_req']) && !empty($_POST['inp_date'])){
              $inp_date            = $_POST['inp_date'];
              $where               = "WHERE ((b.emp_no='$username') or (a.created_by='$username')) AND DATE(a.leave_startdate) LIKE '$inp_date'";
                                                                      
       }elseif(empty($_POST['inp_req']) && !empty($_POST['inp_enddate'])){
              $inp_enddate         = $_POST['inp_enddate'];
              $where               = "WHERE ((b.emp_no='$username') or (a.created_by='$username')) AND DATE(a.leave_enddate) LIKE '$inp_enddate'";
       }
       // AgusPrass 04/03/2021 Menambahkan Logic untuk search jika request number tidak terisi
        else{
              
              $where               = "WHERE ((b.emp_no='$username') or (a.created_by='$username'))";

       }

	if (isset($_POST["limit"], $_POST["start"])) {
		$page = $_POST["limit"];
		$limit = $_POST["start"];
	}else{
		$page = 0;
		$limit = 10;
    }
?>