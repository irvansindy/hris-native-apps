<?php
if (isset($_POST['submit_reject'])) {

$modal_request_no       = $_POST['request_no'];


$process = mysqli_query($connect, "UPDATE hrmrequestapproval      
                                    SET 
                                    request_status='8'
                                    WHERE request_no = '$modal_request_no' and request_status in ('0','1','4')
                              ");


if($process)
	{
            $process = mysqli_query($connect, "UPDATE hrdleaverequest      
                        SET 
                        cancelsts='Y'
                        WHERE request_no = '$modal_request_no'
                  ");
                  echo "<script type='text/javascript'>
                              window.alert('Successfully Cancel Request'); 
                              window.location.replace('../hrm{sys=time.attendance}?emp_id=$username');         
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