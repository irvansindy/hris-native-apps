<?php
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0'; 
if($getdata == 0) {
       include "../../../application/session/sessionlv2.php";
} else {
       include "../../../application/session/mobile.session.php";	
}

$qListRender = "SELECT 
                     DISTINCT(a.request_no) AS request_no,
                     b.emp_no,
                     b.Full_Name,
                     a.request_type,
                     DATE_FORMAT(a.created_date, '%d %M %Y') AS request_date,
                     c.name_en AS status_pengajuan
                     FROM hrmrequestapproval a
                     LEFT JOIN view_employee b ON a.seq_id = b.emp_no
                     LEFT JOIN hrmstatus c ON a.request_status = c.code
                     WHERE a.seq_id IN (SELECT x.emp_no FROM view_employee x WHERE x.emp_no = '13-0299')
                     
                     ORDER BY a.request_no DESC";
