<?php
if (isset($_POST['submit_reject'])) {

date_default_timezone_set('Asia/Bangkok'); 
	
$SFdate                 = date("Y-m-d");
$SFtime                 = date('h:i:s');
$SFdatetime             = date("Y-m-d H:i:s");
$SFnumber               = date("YmdHis");

$modal_req_num          = $_POST['request_no'];


		$process = mysqli_query($connect, "
	     	UPDATE hrmrequestapproval SET 
		     request_status	= '5'
		WHERE request_no	= '$modal_req_num'");

            
            
            if($process){
                  echo"<script type='text/javascript'>
                              window.alert('Successfully Reject Leave Transaction Request');
                              window.location.replace('../hrm{sys=leave.cancellation.approval}?emp_id=$username');       
                        </script>";
                  } else {
                  echo"<script type='text/javascript'>
                              window.alert('Wrong Approval Formula');     
                              </script>";
                  }
            }

      
            ?>