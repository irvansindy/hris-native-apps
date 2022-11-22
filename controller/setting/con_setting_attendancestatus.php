<?php
//isset function create
if (isset($_POST['submit_add_setting_attendancestatus'])) {

date_default_timezone_set('Asia/Bangkok'); 
	
$SFdate                 = date("Y-m-d");
$SFtime                 = date('h:i:s');
$SFtime_current         = date('Y-m-d h:i');
$SFdatetime             = date("Y-m-d H:i:s");
$SFnumber               = date("YmdHis");
$SFnumbercon            = 'LVR'.$SFnumber;
$SFGet_token            = $_POST['get_token'];

//========================POST VALUE FORM========================//
$inp_attend_code        = $_POST['inp_attend_code']; //attend_code
$inp_attend_name_en     = $_POST['inp_attend_name_en']; //attend_name_en
$inp_attend_name_id     = $_POST['inp_attend_name_id']; //attend_name_id
$inp_present_flag       = $_POST['inp_present_flag']; //present_flag
//========================POST VALUE FORM========================//

//========================GET VAR FORM SQL========================//
$get_companyid = mysqli_fetch_array(mysqli_query($connect, "SELECT company_id FROM view_employee WHERE emp_no='$username'"));
//========================GET VAR FORM SQL========================//

//=======================POST VALUE PROCESS======================//
$process0 = mysqli_query($connect, "INSERT INTO `HRMTTAMATTSTATUS` 
                                                      (
                                                            `attend_code`, 
                                                            `attend_name_en`, 
                                                            `attend_name_id`, 
                                                            `attend_name_my`, 
                                                            `attend_name_th`, 
                                                            `present_flag`, 
                                                            `created_by`, 
                                                            `created_date`, 
                                                            `modified_by`, 
                                                            `modified_date`, 
                                                            `orderno`
                                                      ) VALUES 
                                                            (
                                                                  '$inp_attend_code', 
                                                                  '$inp_attend_name_en', 
                                                                  '$inp_attend_name_id', 
                                                                  '',
                                                                  '',
                                                                  '$inp_present_flag',
                                                                  '$username',
                                                                  '$SFdatetime',
                                                                  '$username',
                                                                  '$SFdatetime',
                                                                  NULL
                                                            )");


$alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '6'"));
$alert_print_0    = $alert_0['alert'];
$alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '7'"));
$alert_print_1    = $alert_1['alert'];

mysqli_close($connect);

//=======================POST VALUE PROCESS======================//


      if($process0) 
      {
            echo "<script type='text/javascript'>
                        jQuery(function(){           
                        $.redirect('../set{sys=attstatus}/', 
                              {
                                    rfid: 'create', 
                                    process_time: '$SFtime_current',
                                    pesan: '$alert_print_0',
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
                              document.getElementById('msg').innerHTML = '$alert_print_1';
                              return false;
                  });
                  </script>";
            
            }
//isset function create
      }
//isset function create
else if (isset($_POST['submit_update_setting_attendancestatus'])) {

      date_default_timezone_set('Asia/Bangkok'); 
            
      $SFdate                 = date("Y-m-d");
      $SFtime                 = date('h:i:s');
      $SFtime_current         = date('Y-m-d h:i');
      $SFdatetime             = date("Y-m-d H:i:s");
      $SFnumber               = date("YmdHis");
      $SFnumbercon            = 'LVR'.$SFnumber;
      $SFGet_token            = $_POST['get_token'];
      
      //========================POST VALUE FORM========================//
      $var_attend_code        = $_POST['var_attend_code']; //attend_code
      $inp_attend_name_en     = $_POST['inp_attend_name_en']; //attend_name_en
      $inp_attend_name_id     = $_POST['inp_attend_name_id']; //attend_name_id
      $inp_present_flag       = $_POST['inp_present_flag']; //present_flag
      
      //========================POST VALUE FORM========================//
      
      //========================GET VAR FORM SQL========================//
      $get_companyid = mysqli_fetch_array(mysqli_query($connect, "SELECT company_id FROM view_employee WHERE emp_no='$username'"));
      //========================GET VAR FORM SQL========================//
      
      //=======================POST VALUE PROCESS======================//
      $process0 = mysqli_query($connect, "UPDATE `HRMTTAMATTSTATUS` 
                                                            SET 
                                                                  `attend_name_en` = '$inp_attend_name_en', 
                                                                  `attend_name_id` = '$inp_attend_name_id', 
                                                                  `present_flag` = '$inp_present_flag', 
                                                                  `modified_by` = '$username',
                                                                  `modified_date` = '$SFdatetime'
                                                      WHERE `attend_code` = '$var_attend_code'");
      
      $alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '10'"));
      $alert_print_0    = $alert_0['alert'];
      $alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '11'"));
      $alert_print_1    = $alert_1['alert'];

      mysqli_close($connect);
      
      //=======================POST VALUE PROCESS======================//
      
            if($process0) 
            {
                  echo "<script type='text/javascript'>
                              jQuery(function(){           
                              $.redirect('../set{sys=attstatus}/', 
                                    {
                                          rfid: 'create', 
                                          process_time: '$SFtime_current',
                                          pesan: '$alert_print_0',
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
                                    document.getElementById('msg').innerHTML = '$alert_print_1';
                                    return false;
                        });
                        </script>";
                  
                  }
//isset function update
      }
//isset function delete
else if (isset($_POST['submit_delete_setting_attendancestatus'])) {

      date_default_timezone_set('Asia/Bangkok'); 
            
      $SFdate                 = date("Y-m-d");
      $SFtime                 = date('h:i:s');
      $SFtime_current         = date('Y-m-d h:i');
      $SFdatetime             = date("Y-m-d H:i:s");
      $SFnumber               = date("YmdHis");
      $SFnumbercon            = 'LVR'.$SFnumber;
      $SFGet_token            = $_POST['get_token'];

       //========================POST VALUE FORM========================//
       $var_attend_code        = $_POST['var_attend_code']; //attend_code
       
       //========================POST VALUE FORM========================//

      $alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '8'"));
      $alert_print_0    = $alert_0['alert'];
      $alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '9'"));
      $alert_print_1    = $alert_1['alert'];

      $get_usage = mysqli_query($connect, "SELECT attend_code FROM hrdattendance WHERE `attend_code` = '$var_attend_code'");
            if(mysqli_num_rows($get_usage) < 1 ) {
                  $process0 = mysqli_query($connect, "DELETE FROM `HRMTTAMATTSTATUS` WHERE `attend_code` = '$var_attend_code'");
                  if($process0){
                        echo "<script type='text/javascript'>
                              jQuery(function(){           
                              $.redirect('../set{sys=attstatus}/', 
                                    {
                                          rfid: 'create', 
                                          process_time: '$SFtime_current',
                                          pesan: '$alert_0',
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
                                          document.getElementById('msg').innerHTML = '$alert_print_1';
                                          return false;
                              });
                              </script>";  
                  }
                  
            } else {
                  echo "<script type='text/javascript'>
                              $(document).ready(function(){
                                          modals.style.display = 'block';
                                          document.getElementById('msg').innerHTML = 'Cannot Delete Attendance Status, Attendance Status has been used';
                                          return false;
                              });
                              </script>";
            }
      }
//isset function update
?>