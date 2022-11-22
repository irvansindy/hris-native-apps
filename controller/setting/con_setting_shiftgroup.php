<?php
//isset function create
if (isset($_POST['submit_add_setting_shift_group'])) {

date_default_timezone_set('Asia/Bangkok'); 
	
$SFdate                 = date("Y-m-d");
$SFtime                 = date('h:i:s');
$SFtime_current         = date('Y-m-d h:i');
$SFdatetime             = date("Y-m-d H:i:s");
$SFnumber               = date("YmdHis");
$SFnumbercon            = 'LVR'.$SFnumber;
$SFGet_token            = $_POST['get_token'];

//========================POST VALUE FORM========================//

$inp_groupcode                = $_POST['inp_groupcode']; //inp_groupcode
$inp_groupname                = $_POST['inp_groupname']; //daytype
$inp_overtime_calculation     = $_POST['inp_overtime_calculation']; //flexibleshift

//========================POST VALUE FORM========================//

//========================GET VAR FORM SQL========================//
$get_companyid = mysqli_fetch_array(mysqli_query($connect, "SELECT company_id FROM view_employee WHERE emp_no='$username'"));
//========================GET VAR FORM SQL========================//

//=======================POST VALUE PROCESS======================//
$process0 = mysqli_query($connect, "INSERT INTO `HRMTTAMSHIFTGROUP` 
                                                      (
                                                            `shiftgroupcode`, 
                                                            `shiftgroupname`, 
                                                            `company_id`, 
                                                            `totaldays`, 
                                                            `created_date`, 
                                                            `created_by`, 
                                                            `modified_date`, 
                                                            `modified_by`, 
                                                            `overtime_calculation`,
                                                            `PH_OFFDAY`, 
                                                            `premicheck`, 
                                                            `shiftgroupstart`, 
                                                            `totalspecialday`
                                                      ) 
                                                            VALUES 
                                                                  (
                                                                        '$inp_groupcode', 
                                                                        '$inp_groupname', 
                                                                        '$get_companyid[company_id]', 
                                                                        '90', 
                                                                        '$SFdatetime', 
                                                                        '$username', 
                                                                        '$SFdatetime', 
                                                                        '$username', 
                                                                        '$inp_overtime_calculation', 
                                                                        'N', 
                                                                        NULL, 
                                                                        NULL, 
                                                                        NULL
                                                                  )");

if($process0){
      for($i=0;$i<count($_POST['sg0']);$i++){
            $sg0 = $_POST['sg0'][$i];
            $sg1 = $_POST['sg1'][$i];
            $count = count($_POST['sg0'])-1;
        
            if($sg0!=='' && sg1!==''){
                  mysqli_query($connect, "INSERT INTO `HRMTTARSHIFTGROUPDAILY` 
                                                        (
                                                              `shiftgroupcode`, 
                                                              `company_id`, 
                                                              `shiftdailycode`, 
                                                              `day_no`, 
                                                              `default_shift`, 
                                                              `created_date`, 
                                                              `created_by`, 
                                                              `modified_date`, 
                                                              `modified_by`, 
                                                              `order_no`, 
                                                              `premicheck`
                                                        ) 
                                                              VALUES 
                                                                    (
                                                                          '$inp_groupcode', 
                                                                          '$get_companyid[company_id]', 
                                                                          '$sg0', 
                                                                           $i+1, 
                                                                          'Y', 
                                                                          '$SFdatetime', 
                                                                          '$username', 
                                                                          '$SFdatetime', 
                                                                          '$username', 
                                                                          '1', 
                                                                          '$sg1'
                                                                    )");
                  
                  mysqli_query($connect, "UPDATE HRMTTAMSHIFTGROUP SET `totaldays` = '$count' WHERE `shiftgroupcode` = '$inp_groupcode'"); 
            }
        }
}
    
$alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '6'"));
$alert_print_0    = $alert_0['alert'];
$alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '7'"));
$alert_print_1    = $alert_1['alert'];

$var1 = array("#param");
$var2 = array("shiftgroup code");
$conversion_01 = str_replace($var1, $var2, $alert_print_0);
$conversion_11 = str_replace($var1, $var2, $alert_print_1);

//=======================POST VALUE PROCESS======================//

            if($process0) 
            {
            echo "<script type='text/javascript'>
                        jQuery(function(){           
                        $.redirect('../set{sys=shiftgroup}/', 
                              {
                                    rfid: 'create', 
                                    process_time: '$SFtime_current',
                                    pesan: '$conversion_01',
                                    filtered: '$SFtime_current',
                              }, 
                              'POST', 
                        '_self');       
                        });
                  </script>"; 
            } else {
            echo "<script type='text/javascript'>
                  $(document).ready(function(){
                              modals.style.display = 'block';
                              document.getElementById('msg').innerHTML = '$conversion_11';
                              return false;
                  });
                  </script>";
            }
      //isset function create
      mysqli_close($connect);
      }
//isset function update
else if (isset($_POST['submit_update_setting_shift_group'])) {

date_default_timezone_set('Asia/Bangkok'); 
	
$SFdate                 = date("Y-m-d");
$SFtime                 = date('h:i:s');
$SFtime_current         = date('Y-m-d h:i');
$SFdatetime             = date("Y-m-d H:i:s");
$SFnumber               = date("YmdHis");
$SFnumbercon            = 'LVR'.$SFnumber;
$SFGet_token            = $_POST['get_token'];

//========================POST VALUE FORM========================//
$inp_groupcode                = $_POST['inp_groupcode']; //inp_groupcode
$inp_groupname                = $_POST['inp_groupname']; //daytype
$inp_overtime_calculation     = $_POST['inp_overtime_calculation']; //flexibleshift

//========================POST VALUE FORM========================//

//========================GET VAR FORM SQL========================//
$get_companyid = mysqli_fetch_array(mysqli_query($connect, "SELECT company_id FROM view_employee WHERE emp_no='$username'"));
//========================GET VAR FORM SQL========================//

//=======================POST VALUE PROCESS======================//
$process0 = mysqli_query($connect, "UPDATE `HRMTTAMSHIFTGROUP` SET
                                                `shiftgroupname`        = '$inp_groupname',
                                                `company_id`            = '$get_companyid[company_id]',
                                                `totaldays`             = '90',
                                                `created_date`          = '$SFdatetime',
                                                `created_by`            = '$username',
                                                `modified_date`         = '$SFdatetime',
                                                `modified_by`           = '$username',
                                                `overtime_calculation`  = '$inp_overtime_calculation',
                                                `PH_OFFDAY`             = 'N'
                                          WHERE `shiftgroupcode`        = '$inp_groupcode'");

$process1 = mysqli_query($connect, "DELETE FROM HRMTTARSHIFTGROUPDAILY WHERE `shiftgroupcode` = '$inp_groupcode'");

if($process1){
      for($i=0;$i<count($_POST['sg0']);$i++){
            $sg0 = $_POST['sg0'][$i];
            $sg1 = $_POST['sg1'][$i];
            $count = count($_POST['sg0'])-1;
        
            if($sg0!=='' && sg1!==''){
                  mysqli_query($connect, "INSERT INTO `HRMTTARSHIFTGROUPDAILY` 
                                                        (
                                                              `shiftgroupcode`, 
                                                              `company_id`, 
                                                              `shiftdailycode`, 
                                                              `day_no`, 
                                                              `default_shift`, 
                                                              `created_date`, 
                                                              `created_by`, 
                                                              `modified_date`, 
                                                              `modified_by`, 
                                                              `order_no`, 
                                                              `premicheck`
                                                        ) 
                                                              VALUES 
                                                                    (
                                                                          '$inp_groupcode', 
                                                                          '$get_companyid[company_id]', 
                                                                          '$sg0', 
                                                                           $i+1, 
                                                                          'Y', 
                                                                          '$SFdatetime', 
                                                                          '$username', 
                                                                          '$SFdatetime', 
                                                                          '$username', 
                                                                          '1', 
                                                                          '$sg1'
                                                                    )");

                  mysqli_query($connect, "UPDATE HRMTTAMSHIFTGROUP SET `totaldays` = '$count' WHERE `shiftgroupcode` = '$inp_groupcode'");
            }
        }
}

$alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '10'"));
$alert_print_0    = $alert_0['alert'];
$alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '11'"));
$alert_print_1    = $alert_1['alert'];

$var1 = array("#param");
$var2 = array("shiftgroup code");
$conversion_01 = str_replace($var1, $var2, $alert_print_0);
$conversion_11 = str_replace($var1, $var2, $alert_print_1);

//=======================POST VALUE PROCESS======================//

            if($process0) 
            {
            echo "<script type='text/javascript'>
                        jQuery(function(){           
                        $.redirect('../set{sys=shiftgroup}/', 
                              {
                                    rfid: 'create', 
                                    process_time: '$SFtime_current',
                                    pesan: '$conversion_01',
                                    filtered: '$SFtime_current',
                              }, 
                              'POST', 
                        '_self');       
                        });
                  </script>"; 
            } else {
            echo "<script type='text/javascript'>
                  $(document).ready(function(){
                              modals.style.display = 'block';
                              document.getElementById('msg').innerHTML = '$conversion_11';
                              return false;
                  });
                  </script>";
            }
      //isset function update
      mysqli_close($connect);
      }
//isset function delete
else if (isset($_POST['submit_delete_setting_shift_group'])) {
                  
      date_default_timezone_set('Asia/Bangkok'); 
                              
      $SFdate                 = date("Y-m-d");
      $SFtime                 = date('h:i:s');
      $SFtime_current         = date('Y-m-d h:i');
      $SFdatetime             = date("Y-m-d H:i:s");
      $SFnumber               = date("YmdHis");
      $SFnumbercon            = 'LVR'.$SFnumber;
      $SFGet_token            = $_POST['get_token'];
                  
      //========================POST VALUE FORM========================//
      $inp_groupcode          = $_POST['inp_groupcode']; //inp_groupcode
      //========================POST VALUE FORM========================//

      $alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '8'"));
      $alert_print_0    = $alert_0['alert'];
      $alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '9'"));
      $alert_print_1    = $alert_1['alert'];
      $alert_2          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '9'"));
      $alert_print_2    = $alert_2['alert'];

      $var1 = array("#param");
      $var2 = array("shiftgroup code");
      $conversion_01 = str_replace($var1, $var2, $alert_print_0);
      $conversion_11 = str_replace($var1, $var2, $alert_print_1);
      $conversion_12 = str_replace($var1, $var2, $alert_print_2);
                  
      $get_usage = mysqli_query($connect, "SELECT shiftgroupcode FROM `hrdattendance` WHERE `shiftgroupcode` = '$inp_groupcode'");
            if(mysqli_num_rows($get_usage) < 1 ) {
            $process0 = mysqli_query($connect, "DELETE FROM `HRMTTAMSHIFTGROUP` WHERE `shiftgroupcode` = '$inp_groupcode'");
            $process0 = mysqli_query($connect, "DELETE FROM `HRMTTARSHIFTGROUPDAILY` WHERE `shiftgroupcode` = '$inp_groupcode'");
                  if($process0){
                        echo "<script type='text/javascript'>
                              jQuery(function(){           
                              $.redirect('../set{sys=shiftgroup}/', 
                                    {
                                          rfid: 'create', 
                                          process_time: '$SFtime_current',
                                          pesan: '$conversion_01',
                                          filtered: '$SFtime_current',
                                    }, 
                                    'POST', 
                              '_self');       
                              });
                              </script>";
                  } else {
                        echo "<script type='text/javascript'>
                        $(document).ready(function(){
                                    modals.style.display = 'block';
                                    document.getElementById('msg').innerHTML = '$conversion_11';
                                    return false;
                        });
                        </script>";
                  }
            } else {
                  echo "<script type='text/javascript'>
                              $(document).ready(function(){
                                          modals.style.display = 'block';
                                          document.getElementById('msg').innerHTML = '$conversion_12';
                                          return false;
                              });
                              </script>";

                              
             }
      }
      //isset function update
      mysqli_close($connect);
?>