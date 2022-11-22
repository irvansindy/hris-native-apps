<?php
//isset function create
if (isset($_POST['submit_add_setting_shift_daily'])) {

date_default_timezone_set('Asia/Bangkok'); 
	
$SFdate                 = date("Y-m-d");
$SFtime                 = date('h:i:s');
$SFtime_current         = date('Y-m-d h:i');
$SFdatetime             = date("Y-m-d H:i:s");
$SFnumber               = date("YmdHis");
$SFnumbercon            = 'LVR'.$SFnumber;
$SFGet_token            = $_POST['get_token'];

//========================POST VALUE FORM========================//
$inp_shiftdailycode     = $_POST['inp_shiftdailycode']; //shiftdailycode
$inp_daytype            = $_POST['inp_daytype']; //daytype
$inp_flexibleshift      = $_POST['inp_flexibleshift']; //flexibleshift
$inp_starttime          = $SFdate. " " .$_POST['inp_starttime'].":00"; //starttime
$inp_endtime            = $SFdate. " " .$_POST['inp_endtime'].":00"; //endtime
$inp_graceforlate       = $_POST['inp_graceforlate']; //graceforlate
$inp_productivehours    = $_POST['inp_productivehours']; //productivehours
$inp_remark             = $_POST['inp_remark']; //remark
$inp_breakovt_calculation = $_POST['inp_breakovt_calculation']; //productivehours
$inp_break_starttime    = $SFdate. " " .$_POST['inp_break_starttime'].":00"; //break_starttime
$inp_break_endtime      = $SFdate. " " .$_POST['inp_break_endtime'].":00"; //break_endtime
$inp_grace_eai          = $_POST['inp_grace_eai']; //grace_eai
$inp_grace_lti          = $_POST['inp_grace_lti']; //grace_lti
$inp_grace_eao          = $_POST['inp_grace_eao']; //grace_eao
$inp_grace_lto          = $_POST['inp_grace_lto']; //grace_lto
$inp_overtimecode       = $_POST['inp_overtimecode']; //overtimecode
$inp_overtimecode_ph    = $_POST['inp_overtimecode_ph']; //overtimecode_ph
$inp_automaticovt_type  = $_POST['inp_automaticovt_type']; //automaticovt_type
$inp_automaticovt_start = $SFdate. " " .$_POST['inp_automaticovt_start'].":00"; //automaticovt_start
$inp_automaticovt_end   = $SFdate. " " .$_POST['inp_automaticovt_end'].":00"; //automaticovt_end
$inp_autoovtminutes     = $_POST['inp_autoovtminutes']; //autoovtminutes
$inp_ovt_beforeend      = $SFdate. " " .$_POST['inp_ovt_beforeend'].":00"; //ovt_beforeend
$inp_ovt_afterstart     = $SFdate. " " .$_POST['inp_ovt_afterstart'].":00"; //ovt_afterstart
$inp_ovt_breakstart     = $SFdate. " " .$_POST['inp_ovt_breakstart'].":00"; //ovt_afterstart
$btsovt_1               = $_POST['btsovt_1']; //btsovt_1
$bteovt_1               = $_POST['bteovt_1']; //btsovt_1
//========================POST VALUE FORM========================//

//========================GET VAR FORM SQL========================//
$get_companyid = mysqli_fetch_array(mysqli_query($connect, "SELECT company_id FROM view_employee WHERE emp_no='$username'"));
//========================GET VAR FORM SQL========================//

//=======================POST VALUE PROCESS======================//
$process0 = mysqli_query($connect, "INSERT INTO `hrmttadshiftbreak` 
                                                      (
                                                            `shiftdailycode`, 
                                                            `company_id`, 
                                                            `break_no`, 
                                                            `break_starttime`, 
                                                            `break_endtime`, 
                                                            `break_duration`, 
                                                            `break_startafter`, 
                                                            `created_by`, 
                                                            `created_date`, 
                                                            `modified_by`, 
                                                            `modified_date`, 
                                                            `ovt_breakstart`
                                                      ) VALUES 
                                                            (
                                                                  '$inp_shiftdailycode',
                                                                  '$get_companyid[company_id]', 
                                                                  '1',
                                                                  '$inp_break_starttime', 
                                                                  '$inp_break_endtime', 
                                                                   NULL, 
                                                                   NULL, 
                                                                  '$username', 
                                                                  '$SFdatetime', 
                                                                  '$username', 
                                                                  '$SFdatetime', 
                                                                  '$inp_ovt_breakstart'
                                                            )");
if($process0){
      $process1 = mysqli_query($connect, "INSERT INTO `hrmttamshiftdaily` 
                                                      (
                                                            `shiftdailycode`, 
                                                            `company_id`, 
                                                            `starttime`, 
                                                            `endtime`, 
                                                            `productivehours`, 
                                                            `daytype`, 
                                                            `flexibleshift`, 
                                                            `grace_eai`, 
                                                            `grace_lti`, 
                                                            `grace_eao`, 
                                                            `graceforlate`, 
                                                            `grace_lto`, 
                                                            `gracebreak_eai`, 
                                                            `gracebreak_lti`, 
                                                            `gracebreak_eao`, 
                                                            `gracebreak_lto`, 
                                                            `overtimecode`, 
                                                            `overtimecode_ph`, 
                                                            `automaticovt_type`, 
                                                            `automaticovt_start`, 
                                                            `automaticovt_end`, 
                                                            `autoovtminutes`, 
                                                            `ovt_beforeend`, 
                                                            `ovt_afterstart`, 
                                                            `created_by`, 
                                                            `created_date`, 
                                                            `modified_by`, 
                                                            `modified_date`, 
                                                            `remark`, 
                                                            `breakovt_calculation`, 
                                                            `shiftdailycodeph`, 
                                                            `overtimecode_restd`, 
                                                            `overtimecode_phrestd`, 
                                                            `overtimecode_sdrestd`, 
                                                            `overtimecode_sd`, 
                                                            `overtimecode_inside`, 
                                                            `ovt_afterstart_mnt`, 
                                                            `color`,
                                                            `btsovt_1,
                                                            `bteovt_1
                                                      ) VALUES 
                                                            (
                                                                  '$inp_shiftdailycode',
                                                                  '$get_companyid[company_id]',
                                                                  '$inp_starttime', 
                                                                  '$inp_endtime', 
                                                                  '$inp_productivehours', 
                                                                  '$inp_daytype', 
                                                                  '$inp_flexibleshift', 
                                                                  '$inp_graceforlate', 
                                                                  '$inp_grace_eai', 
                                                                  '$inp_grace_lti', 
                                                                  '$inp_grace_eao',
                                                                  '$inp_grace_lto',  
                                                                   NULL, 
                                                                   NULL, 
                                                                   NULL, 
                                                                   NULL, 
                                                                  '$inp_overtimecode', 
                                                                  '$inp_overtimecode_ph', 
                                                                  '$inp_automaticovt_type', 
                                                                  '$inp_automaticovt_start', 
                                                                  '$inp_automaticovt_end', 
                                                                  '$inp_autoovtminutes',
                                                                  '$inp_ovt_beforeend', 
                                                                  '$inp_ovt_afterstart', 
                                                                  '$username', 
                                                                  '$SFdatetime', 
                                                                  '$username', 
                                                                  '$SFdatetime', 
                                                                  '$inp_remark', 
                                                                  '$inp_breakovt_calculation', 
                                                                  '0', 
                                                                  '0', 
                                                                  '0', 
                                                                  '0', 
                                                                  '0', 
                                                                  '0', 
                                                                  '0', 
                                                                  '0',
                                                                  '$btsovt_1',
                                                                  '$bteovt_1'
                                                            )");
}

$alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '6'"));
$alert_print_0    = $alert_0['alert'];
$alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '7'"));
$alert_print_1    = $alert_1['alert'];

mysqli_close($connect);

//=======================POST VALUE PROCESS======================//

      if($process1) 
      {
            echo "<script type='text/javascript'>
                        jQuery(function(){           
                        $.redirect('../set{sys=shiftdaily}/', 
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
//isset function update
else if (isset($_POST['submit_update_setting_shift_daily'])) {

      date_default_timezone_set('Asia/Bangkok'); 
            
      $SFdate                 = date("Y-m-d");
      $SFtime                 = date('h:i:s');
      $SFtime_current         = date('Y-m-d h:i');
      $SFdatetime             = date("Y-m-d H:i:s");
      $SFnumber               = date("YmdHis");
      $SFnumbercon            = 'LVR'.$SFnumber;
      $SFGet_token            = $_POST['get_token'];
      
      //========================POST VALUE FORM========================//
      $var_shiftdailycode     = $_POST['var_shiftdailycode']; //shiftdailycode
      $inp_daytype            = $_POST['inp_daytype']; //daytype
      $inp_flexibleshift      = $_POST['inp_flexibleshift']; //flexibleshift
      $inp_starttime          = $SFdate. " " .$_POST['inp_starttime'].":00"; //starttime
      $inp_endtime            = $SFdate. " " .$_POST['inp_endtime'].":00"; //endtime
      $inp_graceforlate       = $_POST['inp_graceforlate']; //graceforlate
      $inp_productivehours    = $_POST['inp_productivehours']; //productivehours
      $inp_remark             = $_POST['inp_remark']; //remark
      $inp_breakovt_calculation = $_POST['inp_breakovt_calculation']; //productivehours
      $inp_break_starttime    = $SFdate. " " .$_POST['inp_break_starttime'].":00"; //break_starttime
      $inp_break_endtime      = $SFdate. " " .$_POST['inp_break_endtime'].":00"; //break_endtime
      $inp_grace_eai          = $_POST['inp_grace_eai']; //grace_eai
      $inp_grace_lti          = $_POST['inp_grace_lti']; //grace_lti
      $inp_grace_eao          = $_POST['inp_grace_eao']; //grace_eao
      $inp_grace_lto          = $_POST['inp_grace_lto']; //grace_lto
      $inp_overtimecode       = $_POST['inp_overtimecode']; //overtimecode
      $inp_overtimecode_ph    = $_POST['inp_overtimecode_ph']; //overtimecode_ph
      $inp_automaticovt_type  = $_POST['inp_automaticovt_type']; //automaticovt_type
      $inp_automaticovt_start = $SFdate. " " .$_POST['inp_automaticovt_start'].":00"; //automaticovt_start
      $inp_automaticovt_end   = $SFdate. " " .$_POST['inp_automaticovt_end'].":00"; //automaticovt_end
      $inp_autoovtminutes     = $_POST['inp_autoovtminutes']; //autoovtminutes
      $inp_ovt_beforeend      = $SFdate. " " .$_POST['inp_ovt_beforeend'].":00"; //ovt_beforeend
      $inp_ovt_afterstart     = $SFdate. " " .$_POST['inp_ovt_afterstart'].":00"; //ovt_afterstart
      $inp_ovt_breakstart     = $SFdate. " " .$_POST['inp_ovt_breakstart'].":00"; //ovt_afterstart

      $btsovt_1               = $_POST['btsovt_1']; //btsovt_1
      $bteovt_1               = $_POST['bteovt_1']; //btsovt_1
      //========================POST VALUE FORM========================//
      
      //========================GET VAR FORM SQL========================//
      $get_companyid = mysqli_fetch_array(mysqli_query($connect, "SELECT company_id FROM view_employee WHERE emp_no='$username'"));
      //========================GET VAR FORM SQL========================//
      
      //=======================POST VALUE PROCESS======================//
      $process0 = mysqli_query($connect, "UPDATE `hrmttadshiftbreak` SET

                                                            `company_id` = '$get_companyid[company_id]', 
                                                            `break_no` = '1',
                                                            `break_starttime` = '$inp_break_starttime', 
                                                            `break_endtime` = '$inp_break_endtime', 
                         
                                                            `modified_by` = '$username', 
                                                            `modified_date` = '$SFdatetime',
                                                            `ovt_breakstart` = '$inp_ovt_breakstart'
                                                      
                                                      WHERE `shiftdailycode` = '$var_shiftdailycode'");
      if($process0){
            $process1 = mysqli_query($connect, "UPDATE `hrmttamshiftdaily` SET
                                                            
                                                            `company_id` = '$get_companyid[company_id]',
                                                            `starttime` = '$inp_starttime',  
                                                            `endtime` = '$inp_endtime',   
                                                            `productivehours` = '$inp_productivehours',   
                                                            `daytype` = '$inp_daytype', 
                                                            `flexibleshift` = '$inp_flexibleshift',
                                                            `graceforlate` = '$inp_graceforlate', 
                                                            `grace_eai` = '$inp_grace_eai',
                                                            `grace_lti` = '$inp_grace_lti',
                                                            `grace_eao` = '$inp_grace_eao',
                                                            `grace_lto` = '$inp_grace_lto',
             
                                                            `overtimecode` = '$inp_overtimecode',
                                                            `overtimecode_ph` = '$inp_overtimecode_ph',  
                                                            `automaticovt_type` = '$inp_automaticovt_type', 
                                                            `automaticovt_start` = '$inp_automaticovt_start',
                                                            `automaticovt_end` = '$inp_automaticovt_end',
                                                            `autoovtminutes` = '$inp_autoovtminutes',
                                                            `ovt_beforeend` = '$inp_ovt_beforeend', 
                                                            `ovt_afterstart` = '$inp_ovt_afterstart',  
                                                            `modified_by` = '$username', 
                                                            `modified_date` = '$SFdatetime', 
                                                            `remark` = '$inp_remark', 
                                                            `breakovt_calculation` = '$inp_breakovt_calculation',
                                                            `shiftdailycodeph` = '0', 
                                                            `overtimecode_restd` = '0', 
                                                            `overtimecode_phrestd` = '0', 
                                                            `overtimecode_sdrestd` = '0', 
                                                            `overtimecode_sd` = '0', 
                                                            `overtimecode_inside` = '0', 
                                                            `ovt_afterstart_mnt` =  '0',
                                                            `color` = '0',
                                                            `btsovt_1` = '$btsovt_1',
                                                            `bteovt_1` = '$bteovt_1'
                                                            
                                                      WHERE `shiftdailycode` = '$var_shiftdailycode'");
      }

      $alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '10'"));
      $alert_print_0    = $alert_0['alert'];
      $alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '11'"));
      $alert_print_1    = $alert_1['alert'];
      
      mysqli_close($connect);
      
      //=======================POST VALUE PROCESS======================//
      
            if($process1) 
            {
                  echo "<script type='text/javascript'>
                              jQuery(function(){           
                              $.redirect('../set{sys=shiftdaily}/', 
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
                                    document.getElementById('msg').innerHTML = 'UI';
                                    return false;
                        });
                        </script>";
                  }
                  //isset function update
      }
//isset function delete
else if (isset($_POST['submit_delete_setting_shift_daily'])) {
                  
      date_default_timezone_set('Asia/Bangkok'); 
                              
      $SFdate                 = date("Y-m-d");
      $SFtime                 = date('h:i:s');
      $SFtime_current         = date('Y-m-d h:i');
      $SFdatetime             = date("Y-m-d H:i:s");
      $SFnumber               = date("YmdHis");
      $SFnumbercon            = 'LVR'.$SFnumber;
      $SFGet_token            = $_POST['get_token'];
                  
      //========================POST VALUE FORM========================//
      $var_shiftdailycode     = $_POST['var_shiftdailycode']; //attend_code
                         
      //========================POST VALUE FORM========================//

      $alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '8'"));
      $alert_print_0    = $alert_0['alert'];
      $alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '9'"));
      $alert_print_1    = $alert_1['alert'];
                  
      $get_usage = mysqli_query($connect, "SELECT shiftdailycode FROM `HRMTTARSHIFTGROUPDAILY` WHERE `shiftdailycode` = '$var_shiftdailycode'");
            if(mysqli_num_rows($get_usage) < 1 ) {
            $process0 = mysqli_query($connect, "DELETE FROM `hrmttamshiftdaily` WHERE `shiftdailycode` = '$var_shiftdailycode'");
                  if($process0){
                        echo "<script type='text/javascript'>
                              jQuery(function(){           
                              $.redirect('../set{sys=shiftdaily}/', 
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
            } else {
                  echo "<script type='text/javascript'>
                              $(document).ready(function(){
                                          modals.style.display = 'block';
                                          document.getElementById('msg').innerHTML = 'Cannot Delete Shift Daily Code, Shift Daily Code has been used';
                                          return false;
                              });
                              </script>";
             }
      }
//isset function update
?>