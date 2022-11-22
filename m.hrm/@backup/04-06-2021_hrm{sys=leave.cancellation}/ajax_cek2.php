<?php
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0'; 
if($getdata == 0) {
	include "../../application/session/session.php";
} else {
	include "../../application/session/mobile.session.php";	
}
?>


<?php 


//SQL SERVER CONNECTION//SQL SERVER CONNECTION//SQL SERVER CONNECTION//SQL SERVER CONNECTION//SQL SERVER CONNECTION
$GETDB = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM sysintegration"));
$SVaddress    = $GETDB['server_address'];
$SVdbname     = $GETDB['db_name'];
$SVdbuser     = $GETDB['db_user'];
$SVdbpass     = $GETDB['db_pass'];

date_default_timezone_set('Asia/Bangkok');
$serverName = "$SVaddress";
$connectionInfo = array( "Database"=>$SVdbname, "UID"=>$SVdbuser, "PWD"=>$SVdbpass);
$conn = sqlsrv_connect( $serverName, $connectionInfo);
//SQL SERVER CONNECTION//SQL SERVER CONNECTION//SQL SERVER CONNECTION//SQL SERVER CONNECTION//SQL SERVER CONNECTION


$nip = $_GET['modal_emp'];
$lvb = $_GET['modal_leave'];

$query_sqlsrv = sqlsrv_query($conn, "select 
                                          CAST(c.remaining AS INT) as remaining
                                          from teodempcompany a
                                          LEFT JOIN teomemppersonal b on a.emp_id=b.emp_id
                                          LEFT JOIN ttadempgetleave c on a.emp_id=c.emp_id
						

						where a.emp_no='$nip' and c.leave_code = '$lvb'");
$hrs = sqlsrv_fetch_array($query_sqlsrv);

$data = array(
            'lvb'           =>  $hrs['remaining'],
            'nik'           =>  $hrs['remaining']);
 echo json_encode($data);
?>