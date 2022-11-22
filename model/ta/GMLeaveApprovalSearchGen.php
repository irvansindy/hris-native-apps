<?php 
// Include the database configuration file
       // AgusPrass 18-03-2021

       // if (!empty($_POST['inp_req']) && !empty($_POST['inp_date']) && !empty($_POST['inp_enddate'])) {
       //        $inp_req             = $_POST['inp_req'];
       //        $inp_date            = $_POST['inp_date'];
       //        $inp_enddate         = $_POST['inp_enddate'];
       //        $where               = "WHERE ((g.emp_no='$username' or (a.created_by='$username') or b.emp_no='$username')) AND  
       //                                    (a.request_no like '$inp_req') AND
       //                                    (DATE(a.leave_startdate) >= '$inp_date' AND DATE(a.leave_enddate) <= '$inp_enddate') and (d.code NOT IN ('0','4','8','5'))";
       // } elseif (!empty($_POST['inp_req']) && !empty($_POST['inp_date'])) {
       //        $inp_req             = $_POST['inp_req'];
       //        $inp_date            = $_POST['inp_date'];
       //        $where               = "WHERE ((b.emp_no='$username') or (a.created_by='$username') or (g.emp_no='$username')) AND  
       //                                    (a.request_no like '$inp_req') AND
       //                                    DATE(a.leave_startdate) = '$inp_date' and (d.code NOT IN ('0','4','8','5'))";

       // } elseif (!empty($_POST['inp_req'])) {
       //        $inp_req             = $_POST['inp_req'];
       //        $where               = "WHERE ((b.emp_no='$username') or (a.created_by='$username')  or (g.emp_no='$username')) AND  
       //                                                                (a.request_no like '$inp_req') and (d.code NOT IN ('0','4','8','5'))";
                                   
       // // AgusPrass 04/03/2021 Menambahkan Logic untuk search jika request number tidak terisi
       // } elseif(empty($_POST['inp_req']) && !empty($_POST['inp_date']) && !empty($_POST['inp_enddate'])){
       //        $inp_date            = $_POST['inp_date'];
       //        $inp_enddate         = $_POST['inp_enddate'];
       //        $where               = "WHERE ((b.emp_no='$username') or (a.created_by='$username') or (g.emp_no='$username')) AND
       //                                    (DATE(a.leave_startdate) >= '$inp_date' AND DATE(a.leave_enddate) <= '$inp_enddate') and (d.code NOT IN ('0','4','8','5'))";
       
       // }elseif(empty($_POST['inp_req']) && !empty($_POST['inp_date'])){
       //        $inp_date            = $_POST['inp_date'];
       //        $where               = "WHERE ((b.emp_no='$username') or (a.created_by='$username') or (g.emp_no='$username')) AND DATE(a.leave_startdate) LIKE '$inp_date'  and (d.code NOT IN ('0','4','8','5'))";
                                                                      
       // }elseif(empty($_POST['inp_req']) && !empty($_POST['inp_enddate'])){
       //        $inp_enddate         = $_POST['inp_enddate'];
       //        $where               = "WHERE ((b.emp_no='$username') or (a.created_by='$username') or (g.emp_no='$username')) AND DATE(a.leave_enddate) LIKE '$inp_enddate'  and (d.code NOT IN ('0','4','8','5'))";
       // }

       // else {
       //        $where = "WHERE (g.emp_no='$username' or b.emp_no='$username' or a.created_by='$username') and (d.code NOT IN ('0','4','8','5'))";
       // }

       // AGUS 17/05/2021 Menghilangkan authorisasi kepada created by dan request own, di leave approval hanya orang yang bisa melakukan approve
       if (!empty($_POST['inp_req']) && !empty($_POST['inp_date']) && !empty($_POST['inp_enddate'])) {
              $inp_req             = $_POST['inp_req'];
              $inp_date            = $_POST['inp_date'];
              $inp_enddate         = $_POST['inp_enddate'];
              $where               = "WHERE ((g.emp_no='$username')) AND  
                                          (a.request_no like '$inp_req') AND
                                          (DATE(a.leave_startdate) >= '$inp_date' AND DATE(a.leave_enddate) <= '$inp_enddate') and (d.code NOT IN ('0','4','8','5'))";
       } elseif (!empty($_POST['inp_req']) && !empty($_POST['inp_date'])) {
              $inp_req             = $_POST['inp_req'];
              $inp_date            = $_POST['inp_date'];
              $where               = "WHERE ((g.emp_no='$username')) AND  
                                          (a.request_no like '$inp_req') AND
                                          DATE(a.leave_startdate) = '$inp_date' and (d.code NOT IN ('0','4','8','5'))";

       } elseif (!empty($_POST['inp_req'])) {
              $inp_req             = $_POST['inp_req'];
              $where               = "WHERE ((g.emp_no='$username')) AND (a.request_no like '$inp_req') and (d.code NOT IN ('0','4','8','5'))";
                                   
       // AgusPrass 04/03/2021 Menambahkan Logic untuk search jika request number tidak terisi
       } elseif (empty($_POST['inp_req']) && !empty($_POST['inp_date']) && !empty($_POST['inp_enddate'])){
              $inp_date            = $_POST['inp_date'];
              $inp_enddate         = $_POST['inp_enddate'];
              $where               = "WHERE ((g.emp_no='$username')) AND
                                          (DATE(a.leave_startdate) >= '$inp_date' AND DATE(a.leave_enddate) <= '$inp_enddate') and (d.code NOT IN ('0','4','8','5'))";
       
       } elseif (empty($_POST['inp_req']) && !empty($_POST['inp_date'])){
              $inp_date            = $_POST['inp_date'];
              $where               = "WHERE ((g.emp_no='$username')) AND DATE(a.leave_startdate) LIKE '$inp_date' and (d.code NOT IN ('0','4','8','5'))";
                                                                      
       } elseif (empty($_POST['inp_req']) && !empty($_POST['inp_enddate'])){
              $inp_enddate         = $_POST['inp_enddate'];
              $where               = "WHERE ((g.emp_no='$username')) AND DATE(a.leave_enddate) LIKE '$inp_enddate' and (d.code NOT IN ('0','4','8','5'))";
       }

       else {
              $where = "WHERE (g.emp_no='$username') and (d.code NOT IN ('0','4','8','5'))";
       }

       // if (!empty($_POST['empnip']) && !empty($_POST['empname'])) {
       //        $identitynip = $_POST['empnip'];
       //        $identityname = $_POST['empname'];
       //        $where = "WHERE (a.request_no like '$identitynip') AND (b.full_name like '%$identityname%') AND g.emp_no='$username'";
       // } elseif (!empty($_POST['empnip']) && empty($_POST['empname'])) {
       //        $identitynip = $_POST['empnip'];
       //        $where = "WHERE (a.request_no like '$identitynip')";
       // } elseif (!empty($_POST['empname'])) {
       //        $identityname = $_POST['empname'];
       //        $where = "WHERE (b.full_name like '%$identityname%')";
       // } else {
       //        $where = "WHERE (g.emp_no='$username' or b.emp_no='$username') and (d.code NOT IN ('0','4','8','5'))";
       // }


	if (isset($_POST["limit"], $_POST["start"])) {
		$page = $_POST["limit"];
		$limit = $_POST["start"];
	}else{
		$page = 0;
		$limit = 10;
	}
?>