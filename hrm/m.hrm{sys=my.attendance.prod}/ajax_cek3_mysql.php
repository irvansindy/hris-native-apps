<?php 
include "../../application/config.php";
include "../../application/session/sessionlv2.php";

if(empty($_GET['modal_emp'])){
       $nip = '';
       $lvb = '';
} else {
       $nip = $_GET['modal_emp'];
       $lvb = $_GET['modal_leave'];
}


$query = mysqli_query($connect, "select 
                                   REPLACE(c.remaining,'.',',') as remaining
                                   from teodempcompany a
                                   LEFT JOIN teomemppersonal b on a.emp_id=b.emp_id
                                   LEFT JOIN ttadempgetleave c on a.emp_id=c.emp_id


                                   where a.emp_no='$nip' and c.leave_code = '$lvb'");

$hrs = mysqli_fetch_array($query);

$data = array(
       'lvb'           =>  $hrs['remaining'],
       'nik'           =>  $hrs['remaining']);
echo json_encode($data);
?>


