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
                              window.location.replace('../hrm{sys=time.attendance}');         
                        </script>";

                        mysqli_query($connect,"INSERT INTO `TCLLMLOGACTIVITY` 
                        (
                              `table_name`, 
                              `record_key`, 
                              `activity_type`, 
                              `modified_date`, 
                              `modified_by`, 
                              `devices`, 
                              `sfpage`
                        ) 
                              VALUES 
                                    (
                                          'hrmleaverequest', 
                                          '$SFnumbercon', 
                                          'U', 
                                          '$SFdatetime', 
                                          '$username', 
                                          'Web',
                                          'con_leave_cancel.php'
                                    )");

	} else{
            echo "<script type='text/javascript'>
                        window.alert('Something went error');     
                  </script>";
      }
}
?>