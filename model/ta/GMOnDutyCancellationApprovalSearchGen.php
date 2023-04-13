<?php 

       if (!empty($_POST['inp_req']) && !empty($_POST['inp_date']) && !empty($_POST['inp_enddate'])) {
              $inp_req             = $_POST['inp_req'];
              $inp_date            = $_POST['inp_date'];
              $inp_enddate         = $_POST['inp_enddate'];
              $where               = "WHERE ((g.emp_no='$username')) and (d.code NOT IN ('0','4','8','5')) AND  
                                          (a.request_no like '$inp_req') AND
                                          (DATE(a.requestdate) >= '$inp_date' AND DATE(a.requestdate) <= '$inp_enddate')";
       }
       if (!empty($_POST['inp_req']) && !empty($_POST['inp_date'])) {
              $inp_req             = $_POST['inp_req'];
              $inp_date            = $_POST['inp_date'];
              $where               = "WHERE ((g.emp_no='$username')) and (d.code NOT IN ('0','4','8','5')) AND  
                                          (a.request_no like '$inp_req') AND
                                          DATE(a.requestdate) = '$inp_date'";

       } elseif (!empty($_POST['inp_req'])) {
              $inp_req             = $_POST['inp_req'];
              $where               = "WHERE ((g.emp_no='$username')) and (d.code NOT IN ('0','4','8','5')) AND  
                                                                      (a.request_no like '$inp_req')";
                                   
       // AgusPrass 04/03/2021 Menambahkan Logic untuk search jika request number tidak terisi
       }
       if(empty($_POST['inp_req']) && !empty($_POST['inp_date']) && !empty($_POST['inp_enddate'])){
              $inp_date            = $_POST['inp_date'];
              $inp_enddate         = $_POST['inp_enddate'];
              $where               = "WHERE ((g.emp_no='$username')) and (d.code NOT IN ('0','4','8','5')) AND 
                                          (DATE(a.requestdate) >= '$inp_date' AND DATE(a.requestdate) <= '$inp_enddate')";
       
       }
       if(empty($_POST['inp_req']) && !empty($_POST['inp_date'])){
              $inp_date            = $_POST['inp_date'];
              $where               = "WHERE ((g.emp_no='$username')) and (d.code NOT IN ('0','4','8','5')) AND DATE(a.requestdate) LIKE '$inp_date'";
                                                                      
       }
       if(empty($_POST['inp_req']) && !empty($_POST['inp_enddate'])){
              $inp_enddate         = $_POST['inp_enddate'];
              $where               = "WHERE ((g.emp_no='$username')) and (d.code NOT IN ('0','4','8','5')) AND DATE(a.requestdate) LIKE '$inp_enddate'";

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
       // } 

       // AgusPrass 04/03/2021 Mengganti logic IF pada search
       } 
       if(empty($_POST['inp_req']) && empty($_POST['inp_date']) && empty($_POST['inp_enddate'])) {
              $where = "WHERE (g.emp_no='$username') and (d.code NOT IN ('0','4','8','5'))";
       }


	if (isset($_POST["limit"], $_POST["start"])) {
		$page = $_POST["limit"];
		$limit = $_POST["start"];
	}else{
		$page = 0;
		$limit = 10;
	}



       !empty($_GET['src_request_no']) ? $getdata = '1' : $getdata = '0';
	!empty($_GET['src_request_status']) ? $getdata2 = '1' : $getdata2 = '0';
	
	if($getdata == 0 && $getdata2 == 0) {
		$WHERE_APP = "WHERE (e.emp_no = '$username') AND xdec1.sts IN ('1','2','3','5')";
	} else if($getdata == 1 && $getdata2 == 1) {
		$WHERE_APP = "WHERE (e.emp_no = '$username') AND xdec1.sts LIKE '%$_GET[src_request_status]%' AND a.request_no LIKE '%$_GET[src_request_no]%'";
	} else if($getdata == 1 && $getdata2 == 0) {
		$WHERE_APP = "WHERE (e.emp_no = '$username') AND a.request_no LIKE '%$_GET[src_request_no]%'";
	} else if($getdata == 0 && $getdata2 == 1) {
		$WHERE_APP = "WHERE (e.emp_no = '$username') AND xdec1.sts LIKE '%$_GET[src_request_status]%'";
	}

?>