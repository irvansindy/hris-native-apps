<?php
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0'; 
if($getdata == 0) {
	include "../../application/session/session.php";
} else {
	include "../../application/session/mobile.session.php";	
}
?>

<?php 

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
					REPLACE(c.remaining,'.',',') as remaining
                                   from teodempcompany a
                                   LEFT JOIN teomemppersonal b on a.emp_id=b.emp_id
                                   LEFT JOIN hrmempleavebal c on a.emp_id=c.emp_id
                                   LEFT JOIN ttamleavetype d on d.leave_code='$lvb'
                                   INNER JOIN hrmvalleave e on e.leave_code='$lvb'
                                   where a.emp_no='$nip' and c.leave_code = '$lvb'");

$hrs = mysqli_fetch_array($query);

$data = array(
       'ltp'           =>  $hrs['daytype'],
       'lvb'           =>  $hrs['remaining'],
       'lur'           =>  $hrs['urgent']);
echo json_encode($data);
?>


