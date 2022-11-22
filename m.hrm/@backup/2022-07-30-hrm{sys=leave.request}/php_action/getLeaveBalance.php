<?php
require_once '../../../application/config.php';
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
       include "../../../application/session/sessionlv2.php";
} else {
       include "../../../application/session/mobile.session.php";
}

if(empty($_GET['modal_emp'])){
       $nip = '';
       $lvb = '';
} else {
       $nip = $_GET['modal_emp'];
       $lvb = $_GET['modal_leave'];
}


// $nim = '$nip';
// $query = mysqli_query($connect, "select * from view_employee where emp_no='$nim'");
// $mahasiswa = mysqli_fetch_array($query);
// $data = array(
//             'nama'      =>  $mahasiswa['emp_no'],
//             'jurusan'   =>  $mahasiswa['emp_no'],
//             'alamat'    =>  $mahasiswa['emp_no'],);
//  echo json_encode($data);

$sql = "SELECT 
                                   d.daytype, 
                                   e.urgent, 
                                   d.is_companyleave,
                                   f.total
                                   FROM view_employee a
                                   LEFT JOIN hrmempleavebal c ON a.emp_id=c.emp_id
                                   LEFT JOIN ttamleavetype d ON d.leave_code='$lvb'
                                   INNER JOIN hrmvalleave e ON e.leave_code='$lvb'
                                   LEFT JOIN (
                                                        SELECT
                                                               x1.emp_id,
                                                               SUM(x1.remaining) AS total FROM hrmempleavebal x1 
                                                               WHERE x1.leave_code='$lvb' AND x1.active_status = '1'
                                                               GROUP BY x1.emp_id
                                                 ) f ON a.emp_id=f.emp_id
                                   
                                   
                                   
                                   WHERE a.emp_no='$nip' AND c.leave_code = '$lvb' AND c.active_status = '1'
                                   GROUP BY e.leave_code";
       
       $query = mysqli_query($connect, $sql);
       $result = mysqli_fetch_assoc($query);
       
       $connect->close();
       
       echo json_encode($result);
       
       