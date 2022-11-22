<?php
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0'; 
if($getdata == 0) {
	include "../../application/session/session.php";
} else {
	include "../../application/session/mobile.session.php";	
}
?>

<?php
if (isset($_POST['submit_revised'])) {

$modal_request_no       = $_POST['request_no'];
$modal_inp_remark       = $_POST['inp_remark'];


$process = mysqli_query($connect, "UPDATE hrmrequestapproval      
                                    SET 
                                    request_status='4',
                                    revised_remark='$modal_inp_remark'
                                    WHERE request_no = '$modal_request_no'
                              ");

if($process)
	{
                  echo "<script type='text/javascript'>
                              window.alert('Successfully update request to Revised'); 
                              window.location.replace('../hrm{sys=time.approval}?emp_id=$username');         
                        </script>";
	} else{
            echo "<script type='text/javascript'>
                        window.alert('Something went error');     
                  </script>";
      }
}
?>
<?php
//DEBUG
// echo $modal_id . '<br>';
// echo $modal_name . '<br>';
// echo $modal_address . '<br>';
// echo $modal_start . '<br>';
// echo $modal_end . '<br>';
// echo $modal_position . '<br>';
// echo $modal_major . '<br>';
// echo $modal_salary . '<br>';
// echo $modal_benefits . '<br>';
// echo $modal_reason . '<br>';
// ?>