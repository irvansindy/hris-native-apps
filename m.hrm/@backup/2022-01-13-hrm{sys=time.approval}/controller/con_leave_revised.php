<?php
if (isset($_POST['submit_revised'])) {

$modal_request_no       = $_POST['request_no'];
$modal_inp_remark       = $_POST['inp_remark'];

$getpositionid          = mysqli_fetch_array(mysqli_query($connect, "SELECT position_id FROM view_employee WHERE emp_no = '$username'"));
$getpositionidprint     = $getpositionid['position_id'];


$process = mysqli_query($connect, "UPDATE hrmrequestapproval      
                                    SET 
                                    request_status='4',
                                    `status` = '0'
                                    WHERE request_no = '$modal_request_no'
                              ");
$process2 = mysqli_query($connect, "UPDATE hrmrequestapproval      
                                    SET 
                                    `revised_remark` = '$modal_inp_remark'
                                    WHERE `request_no` = '$modal_request_no' and `position_id` = '$getpositionidprint'
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