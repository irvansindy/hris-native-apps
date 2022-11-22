
<?php
if (isset($_POST['submit_revised'])) {

date_default_timezone_set('Asia/Bangkok'); 
	
$SFdate                 = date("Y-m-d");
$SFtime                 = date('h:i:s');
$SFdatetime             = date("Y-m-d H:i:s");
$SFnumber               = date("YmdHis");
$SFnumbercon            = 'LCR'.$SFnumber;

$inp_reqleavenumber     = $_POST['inp_reqleavenumber'];
$inp_reqleavecancelnumber  = $_POST['inp_reqleavecancelnumber'];
$inp_remark             = $_POST['inp_remark'];

$emp                    = mysqli_fetch_array(mysqli_query($connect, "SELECT b.emp_no,a.leave_code FROM hrmleaverequest a LEFT JOIN VIEW_EMPLOYEE b on a.emp_id=b.emp_id WHERE a.request_no='$inp_reqleavenumber'"));
$emp_print              = $emp['emp_no'];
$modal_leave            = $emp['leave_code'];
$var_emp_id             = mysqli_fetch_array(mysqli_query($connect, "SELECT emp_id FROM teodempcompany WHERE emp_no = '$emp_print'"));
// $emp_print              = $_POST['modal_emp'];
// $modal_remark           = $_POST['inp_remark'];
// $modal_leave            = $_POST['modal_leave'];

// $modal_lvb              = $_POST['inp_leavebalance'];
// $modal_leave_start      = date ("Y-m-d", strtotime ($_POST['modal_leave_start']));
// $modal_leave_end        = date ("Y-m-d", strtotime ($_POST['modal_leave_end']));



      $var_date_leave   = $_POST['pilih'];
      $total_leave_cancel_request   = count($var_date_leave);

            /**
             *
             * '||''|.                            '||
             *  ||   ||    ....  .... ...   ....   ||    ...   ... ...  ... ..
             *  ||    || .|...||  '|.  |  .|...||  ||  .|  '|.  ||'  ||  ||' ''
             *  ||    || ||        '|.|   ||       ||  ||   ||  ||    |  ||
             * .||...|'   '|...'    '|     '|...' .||.  '|..|'  ||...'  .||.
             *                                                  ||
             * --------------- By Display:inline ------------- '''' -----------
             */

            $del_process_request = mysqli_query($connect, "DELETE FROM hrmleavecancelrequest WHERE request_no = '$inp_reqleavecancelnumber'");
            $del_process_request = mysqli_query($connect, "DELETE FROM hrdleavecancelrequest WHERE request_no = '$inp_reqleavecancelnumber'");
            $upd_process_approval = mysqli_query($connect, "UPDATE hrmrequestapproval SET request_status = '1' WHERE request_no = '$inp_reqleavecancelnumber'");
            
      

            for($x=0;$x<$total_leave_cancel_request;$x++){
                  $process_request    = mysqli_query($connect, "INSERT INTO hrmleavecancelrequest 
                                                                  (
                                                                        `request_no`, 
                                                                        `company_id`, 
                                                                        `requestedby`, 
                                                                        `requestfor`, 
                                                                        `requestdate`, 
                                                                        `leaverequest_no`, 
                                                                        `leave_code`, 
                                                                        `totaldays`, 
                                                                        `remark`, 
                                                                        `approval_status`, 
                                                                        `created_by`, 
                                                                        `created_date`, 
                                                                        `modified_by`, 
                                                                        `modified_date`, 
                                                                        `request_type`) 
                                                                              VALUES 
                                                                                    (
                                                                                          '$inp_reqleavecancelnumber',
                                                                                          '13576', 
                                                                                          '$username', 
                                                                                          '$var_emp_id[emp_id]', 
                                                                                          '$SFdatetime', 
                                                                                          '$inp_reqleavenumber', 
                                                                                          '$modal_leave', 
                                                                                          '$total_leave_cancel_request', 
                                                                                          '$inp_remark',
                                                                                          '0',  
                                                                                          '$username', 
                                                                                          '$SFdatetime', 
                                                                                          '$username', 
                                                                                          '$SFdatetime', 
                                                                                          '1')");
            }

            for($x=0;$x<$total_leave_cancel_request;$x++){
                  $process_request_detail    = mysqli_query($connect, "INSERT INTO hrdleavecancelrequest 
                                                                        (
                                                                              `request_no`, 
                                                                              `company_id`, 
                                                                              `leave_date`, 
                                                                              `leave_starttime`, 
                                                                              `leave_endtime`, 
                                                                              `created_by`, 
                                                                              `created_date`, 
                                                                              `modified_by`, 
                                                                              `modified_date`
                                                                        ) 
                                                                              VALUES 
                                                                                    (
                                                                                          '$inp_reqleavecancelnumber', 
                                                                                          '13576',
                                                                                          '$var_date_leave[$x]', 
                                                                                          '$var_date_leave[$x]',  
                                                                                          '$var_date_leave[$x]',  
                                                                                          '$username', 
                                                                                          '$SFdatetime', 
                                                                                          '$username', 
                                                                                          '$SFdatetime')");
            }

           

            


      if($process_request_detail)
            {
                  echo "<script type='text/javascript'>
                                    window.alert('Successfully Submit Revise Cancellation'); 
                                    window.close();
                              </script>";
            } else{
                  echo "<script type='text/javascript'>
                              window.alert('Something went error');
                              window.close();  
                        </script>";
            }
      }


?>