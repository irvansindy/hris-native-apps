<?php 
include "../../application/config.php";
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0'; 
if($getdata == 0) {
	include "../../application/session/session.php";
} else {
	include "../../application/session/mobile.session.php";	
}

date_default_timezone_set('Asia/Bangkok'); 
	
$SFdate                 = date("Y-m-d");
$SFtime                 = date('h:i:s');
$SFdatetime             = date("Y-m-d H:i:s");
$SFnumber               = date("YmdHis");
$SFnumbercon            = 'LVR'.$SFnumber;

if(empty($_GET['modal_emp'])){
       $nip = '';
       $lvb = '';
} else {
       $nip = $_GET['modal_emp'];
       $lvb = $_GET['modal_leave'];
}

$query = mysqli_query($connect, "SELECT 
                                   d.daytype,
                                   e.urgent,
                                   d.is_companyleave,
                                   (SELECT REPLACE(SUM(x1.remaining),'.',',') FROM hrmempleavebal x1 WHERE a.emp_id=x1.emp_id AND x1.leave_code='$lvb' GROUP BY x1.leave_code) AS remaining
                                   from view_employee a
                                   LEFT JOIN hrmempleavebal c on a.emp_id=c.emp_id
                                   LEFT JOIN ttamleavetype d on d.leave_code='$lvb'
                                   INNER JOIN hrmvalleave e on e.leave_code='$lvb'
                                   where 
                                          a.emp_no='$nip' and 
                                          c.leave_code = '$lvb' and
                                          c.active_status = '1'
                                          GROUP BY e.leave_code");

$hrs = mysqli_fetch_array($query);

$data = array(
       'ltp'           =>  $hrs['daytype'],
       'lvb'           =>  $hrs['remaining'],
       'lvc'           =>  $hrs['is_companyleave'],
       'lur'           =>  $hrs['urgent']);
echo json_encode($data);
?>


