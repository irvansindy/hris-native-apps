<?php

//membuat koneksi ke database
$koneksi = mysqli_connect("localhost", "gthrisco", "il!4Pj39", "gthrisco_tm");

if(empty($_GET['modal_emp'])){
       $nip = '';
       $lvb = '';
} else {
       $nip = $_GET['modal_emp'];
       $lvb = $_GET['modal_leave'];
}


// $nim = '13-0299';
// $query = mysqli_query($koneksi, "select * from view_employee where emp_no='$nim'");
// $mahasiswa = mysqli_fetch_array($query);
// $data = array(
//             'nama'      =>  $mahasiswa['emp_no'],
//             'jurusan'   =>  $mahasiswa['emp_no'],
//             'alamat'    =>  $mahasiswa['emp_no'],);
//  echo json_encode($data);

 $query = mysqli_query($koneksi, "SELECT 
                                   d.daytype,
                                   e.urgent,
                                   d.is_companyleave,
                                   (SELECT REPLACE(SUM(x1.remaining),'.',',') FROM hrmempleavebal x1 WHERE a.emp_id=x1.emp_id AND x1.leave_code='$lvb' AND x1.active_status = '1' GROUP BY x1.leave_code) AS remaining
                                   from view_employee a
                                   LEFT JOIN hrmempleavebal c on a.emp_id=c.emp_id
                                   LEFT JOIN ttamleavetype d on d.leave_code='$lvb'
                                   INNER JOIN hrmvalleave e on e.leave_code='$lvb'
                                   where 
                                          a.emp_no='$nip' and 
                                          c.leave_code = '$lvb' and
                                          c.active_status = '1'
                                          GROUP BY e.leave_code");
$mahasiswa = mysqli_fetch_array($query);
$data = array(
            'ltp'      =>  $mahasiswa['daytype'],
            'lvb'    =>  $mahasiswa['remaining'],
            'lvc'   =>  $mahasiswa['is_companyleave'],
            'lur'    =>  $mahasiswa['urgent'],);
 echo json_encode($data);



?>