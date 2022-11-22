<?php
if (isset($_POST['submit_add_access'])) {

date_default_timezone_set('Asia/Bangkok'); 
	
$SFdate                 = date("Y-m-d");
$SFtime                 = date('h:i:s');
$SFdatetime             = date("Y-m-d H:i:s");
$SFnumber               = date("YmdHis");
$SFnumbercon            = 'LVR'.$SFnumber;
$SFGet_token            = $_POST['get_token'];

$modal_access           = $_POST['modal_access'];
$modal_access_name      = $_POST['modal_access_name'];

$process = mysqli_query($connect, "INSERT INTO hrm_accessgroup (`access_code`, `access_name`) VALUES ('$modal_access', '$modal_access_name')");

if($process) 
      {
            echo "<script type='text/javascript'>
                        window.alert('Successfully Insert New Access Data'); 
                        window.location.replace('../hrm{sys=menu_authorization}');         
                  </script>";  
            }
            else
            {
                  echo"<script type='text/javascript'>
                              window.alert('Something went wrong');     
                        </script>";
            } 
      }
?>