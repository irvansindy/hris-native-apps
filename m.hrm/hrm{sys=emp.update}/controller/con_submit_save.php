<?php
if (isset($_POST['submit_add_commit']))
{
      date_default_timezone_set('Asia/Bangkok'); 
	
      $SFdate                       = date("Y-m-d");
      $SFtime                       = date('h:i:s');
      $SFtime_current               = date('Y-m-d h:i');
      $SFdatetime                   = date("Y-m-d H:i:s");
      $SFnumber                     = date("YmdHis");
      $SFnumbercon                  = 'LVR'.$SFnumber;
      // $SFGet_token               = $_POST['get_token'];

      $get_empid_r                  = $_POST['rfid'];

      $get_period = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM mgtools_period ORDER BY migration_id DESC LIMIT 1"));
      $get_period_r = $get_period['migration_id'];

      $process_requestS = mysqli_query($connect, "INSERT INTO `mgtools_submission` 
                                                      (
                                                            `emp_no`,
                                                            `status`,
                                                            `submission_date`,
                                                            `migration_id`
                                                      ) VALUES 
                                                            (
                                                                  '$get_empid_r',
                                                                  'Y',
                                                                  '$SFdatetime',
                                                                  '$get_period_r'
                                                      ) ON DUPLICATE KEY UPDATE
                                                            `submission_date`= '$SFdatetime'");

            if($process_requestS) 
            {
                 echo"<script>
                              var timer = setTimeout(function() {
                              window.location='../hrm{sys=emp.inf}/index.php?emp_id=$get_empid_r'
                              }, 1000);
                        </script>";
                  echo '<script type="text/javascript">
                  $(document).ready(function(){
                              modals.style.display = "block";
                              document.getElementById("msg").innerHTML = "Berhasil menyelesaikan pemutakhiran data";
                              return false;
                  });
                  </script>';
                
                  
                  }
                  else
                  {
                        echo"<script type='text/javascript'>
                                    window.alert('Wrong Approval Formula');     
                              </script>";
                  } 
} 
?>