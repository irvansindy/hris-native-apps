<?php
//isset function create
if (isset($_POST['submit_create_setting_attendancemachine'])) {

date_default_timezone_set('Asia/Bangkok'); 

$SFdate                 = date("Y-m-d");
$SFtime                 = date('h:i:s');
$SFtime_current         = date('Y-m-d h:i');
$SFdatetime             = date("Y-m-d H:i:s");
$SFnumber               = date("YmdHis");
$SFnumbercon            = 'LVR'.$SFnumber;
$SFGet_token            = $_POST['get_token'];

//========================POST VALUE FORM========================//
$inp_machine_code       = $_POST['inp_machine_code']; //machine_code
$inp_method             = $_POST['inp_method']; //method
$inp_file_type          = $_POST['inp_file_type']; //file_type
$inp_fileext            = $_POST['inp_fileext']; //fileext
$inp_inoutflag          = $_POST['inp_inoutflag']; //inoutflag
$inp_datasource         = $_POST['inp_datasource']; //datasource
$inp_table_name         = $_POST['inp_table_name']; //table_name
$inp_attend_code        = $_POST['inp_attend_code']; //attend_code
$inp_datemask           = $_POST['inp_datemask']; //datemask
$inp_in_status          = $_POST['inp_in_status']; //in_status
$inp_out_status         = $_POST['inp_out_status']; //out_status
//========================POST VALUE FORM========================//

//========================GET VAR FORM SQL========================//
$get_companyid = mysqli_fetch_array(mysqli_query($connect, "SELECT company_id FROM view_employee WHERE emp_no='$username'"));
//========================GET VAR FORM SQL========================//

//=======================POST VALUE PROCESS======================//
$process0 = mysqli_query($connect, "INSERT INTO `hrmattmachine` 
                                                      (
                                                            `machine_code`, 
                                                            `company_id`, 
                                                            `method`, 
                                                            `in_status`, 
                                                            `out_status`, 
                                                            `fileext`, 
                                                            `datasource`, 
                                                            `table_name`, 
                                                            `attend_code`, 
                                                            `created_by`, 
                                                            `created_date`, 
                                                            `modified_by`, 
                                                            `modified_date`, 
                                                            `inoutflag`, 
                                                            `file_type`, 
                                                            `breakstart_code`, 
                                                            `breakend_code`, 
                                                            `datemask`
                                                      ) VALUES 
                                                            (
                                                                  '$inp_machine_code', 
                                                                  '$get_companyid[company_id]', 
                                                                  '$inp_method',
                                                                  '$inp_in_status', 
                                                                  '$inp_out_status', 
                                                                  '$inp_fileext', 
                                                                  '$inp_datasource',
                                                                  '$inp_table_name', 
                                                                  '$inp_attend_code',
                                                                  '$username', 
                                                                  '$SFdatetime', 
                                                                  '$username', 
                                                                  '$SFdatetime', 
                                                                  '$inp_inoutflag', 
                                                                  '$inp_file_type', 
                                                                  '0', 
                                                                  '0', 
                                                                  '$inp_datemask'
                                                            )");

for($imac=0;$imac<count($_POST['data_mac1']);$imac++){
      $data_mac1 = $_POST['data_mac1'][$imac];
      $data_mac2 = $_POST['data_mac2'][$imac];
      $data_mac3 = $_POST['data_mac3'][$imac];
      $data_mac4 = $_POST['data_mac4'][$imac];

      
      if($data_mac1!=='' && $data_mac2!=='' && $data_mac3!=='' && $data_mac4!==''){

      $process1 = mysqli_query($connect, "INSERT INTO `HRDATTMACHINE` 
                              (
                                    `machine_code`, 
                                    `company_id`, 
                                    `field_type`, 
                                    `column_name`, 
                                    `column_desc`, 
                                    `length`, 
                                    `order_no`, 
                                    `created_by`, 
                                    `created_date`, 
                                    `modified_by`, 
                                    `modified_date`
                              ) VALUES 
                                    (
                                          '$inp_machine_code', 
                                          '$get_companyid[company_id]', 
                                          '$data_mac1', 
                                          '$data_mac2', 
                                          '$data_mac3', 
                                          '$data_mac4', 
                                          '$imac', 
                                          '$username', 
                                          '$SFdatetime', 
                                          '$username', 
                                          '$SFdatetime'
                                    )");
      }
}

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
                        $.redirect('../set{sys=attmachine}/', 
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
else if (isset($_POST['submit_update_setting_attendancemachine'])) {

      date_default_timezone_set('Asia/Bangkok'); 
            
      $SFdate                 = date("Y-m-d");
      $SFtime                 = date('h:i:s');
      $SFtime_current         = date('Y-m-d h:i');
      $SFdatetime             = date("Y-m-d H:i:s");
      $SFnumber               = date("YmdHis");
      $SFnumbercon            = 'LVR'.$SFnumber;
      $SFGet_token            = $_POST['get_token'];
      
      //========================POST VALUE FORM========================//
      $var_machine_code       = $_POST['var_machine_code']; //machine_code
      $inp_method             = $_POST['inp_method']; //method
      $inp_file_type          = $_POST['inp_file_type']; //file_type
      $inp_fileext            = $_POST['inp_fileext']; //fileext
      $inp_inoutflag          = $_POST['inp_inoutflag']; //inoutflag
      $inp_datasource         = $_POST['inp_datasource']; //datasource
      $inp_table_name         = $_POST['inp_table_name']; //table_name
      $inp_attend_code        = $_POST['inp_attend_code']; //attend_code
      $inp_datemask           = $_POST['inp_datemask']; //datemask
      $inp_in_status          = $_POST['inp_in_status']; //in_status
      $inp_out_status         = $_POST['inp_out_status']; //out_status
      
      //========================POST VALUE FORM========================//
      
      //========================GET VAR FORM SQL========================//
      $get_companyid = mysqli_fetch_array(mysqli_query($connect, "SELECT company_id FROM view_employee WHERE emp_no='$username'"));
      //========================GET VAR FORM SQL========================//
      
      //=======================POST VALUE PROCESS======================//
      $process0 = mysqli_query($connect, "UPDATE `hrmattmachine` SET
                                                      
                                                      `company_id` = '$get_companyid[company_id]', 
                                                      `method` = '$inp_method',
                                                      `in_status` = '$inp_in_status',
                                                      `out_status` = '$inp_out_status',
                                                      `fileext` = '$inp_fileext',
                                                      `datasource` = '$inp_datasource',
                                                      `table_name` = '$inp_table_name',
                                                      `attend_code` = '$inp_attend_code',
                                                      `modified_by` = '$username',
                                                      `modified_date` = '$SFdatetime', 
                                                      `inoutflag` = '$inp_inoutflag', 
                                                      `file_type` = '$inp_file_type', 
                                                      `breakstart_code` = '0',
                                                      `breakend_code` = '0',
                                                      `datemask` = '$inp_datemask'
                                                
                                                WHERE `machine_code` = '$var_machine_code'");
      
      $process1 = mysqli_query($connect, "DELETE FROM `HRDATTMACHINE` WHERE `machine_code` = '$var_machine_code'");

      for($imac=0;$imac<count($_POST['data_mac1']);$imac++){
            $data_mac1 = $_POST['data_mac1'][$imac];
            $data_mac2 = $_POST['data_mac2'][$imac];
            $data_mac3 = $_POST['data_mac3'][$imac];
            $data_mac4 = $_POST['data_mac4'][$imac];
      
            
            if($data_mac1!=='' && $data_mac2!=='' && $data_mac3!=='' && $data_mac4!==''){
      
            $$process2 =  mysqli_query($connect, "INSERT INTO `HRDATTMACHINE` 
                                    (
                                          `machine_code`, 
                                          `company_id`, 
                                          `field_type`, 
                                          `column_name`, 
                                          `column_desc`, 
                                          `length`, 
                                          `order_no`, 
                                          `created_by`, 
                                          `created_date`, 
                                          `modified_by`, 
                                          `modified_date`
                                    ) VALUES 
                                          (
                                                '$var_machine_code', 
                                                '$get_companyid[company_id]', 
                                                '$data_mac1', 
                                                '$data_mac2', 
                                                '$data_mac3', 
                                                '$data_mac4', 
                                                '$imac', 
                                                '$username', 
                                                '$SFdatetime', 
                                                '$username', 
                                                '$SFdatetime'
                                          )");
            }
      }

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
                              $.redirect('../set{sys=attmachine}/', 
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
else if (isset($_POST['submit_delete_setting_attendancemachine'])) {

      date_default_timezone_set('Asia/Bangkok'); 
            
      $SFdate                 = date("Y-m-d");
      $SFtime                 = date('h:i:s');
      $SFtime_current         = date('Y-m-d h:i');
      $SFdatetime             = date("Y-m-d H:i:s");
      $SFnumber               = date("YmdHis");
      $SFnumbercon            = 'LVR'.$SFnumber;
      $SFGet_token            = $_POST['get_token'];

       //========================POST VALUE FORM========================//
       $var_machine_code       = $_POST['var_machine_code']; //machine_code
       
       //========================POST VALUE FORM========================//

      $alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '8'"));
      $alert_print_0    = $alert_0['alert'];
      $alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '9'"));
      $alert_print_1    = $alert_1['alert'];
      
      $get_usage = mysqli_query($connect, "SELECT machine_code FROM `HRDATTENDANCETEMP` WHERE `machine_code` = '$var_machine_code'");
            if(mysqli_num_rows($get_usage) < 1 ) {
                  $process0 = mysqli_query($connect, "DELETE FROM `hrmattmachine` WHERE `machine_code` = '$var_machine_code'");
                  $process0 = mysqli_query($connect, "DELETE FROM `HRDATTENDANCETEMP` WHERE `machine_code` = '$var_machine_code'");
                  if($process0){
                        echo "<script type='text/javascript'>
                              jQuery(function(){           
                              $.redirect('../set{sys=attmachine}/', 
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
                                          document.getElementById('msg').innerHTML = 'Cannot Delete Machine, Machine has been used';
                                          return false;
                              });
                              </script>";
            }
      }
//isset function update
?>