<?php
if (isset($_POST['submitpemutakhiran'])) {

date_default_timezone_set('Asia/Bangkok'); 
	
$SFdate                       = date("Y-m-d");
$SFtime                       = date('h:i:s');
$SFtime_current               = date('Y-m-d h:i');
$SFdatetime                   = date("Y-m-d H:i:s");
$SFnumber                     = date("YmdHis");
$SFnumbercon                  = 'LVR'.$SFnumber;
// $SFGet_token               = $_POST['get_token'];

$modal_inp_first_name         = strtoupper($_POST['inp_first_name']);
$modal_inp_middle_name        = strtoupper($_POST['inp_middle_name']);
$modal_inp_last_name          = strtoupper($_POST['inp_last_name']);

$find_replace = array('  ');
$new_replace  = array(' ');
$modal_official_name          = str_replace($find_replace, $new_replace, strtoupper($modal_inp_first_name." ".$modal_inp_middle_name." ".$modal_inp_last_name));


$modal_lastreqno              = $_POST['lastreqno'];
$get_empid                    = mysqli_fetch_array(mysqli_query($connect, "SELECT emp_id FROM mgtools_view_employee WHERE emp_no = '$modal_lastreqno'"));
$get_empid_r                  = $get_empid['emp_id'];

$inp_marital_status           = $_POST['inp_marital_status'];
$inp_birthplace               = $_POST['inp_birthplace'];
$inp_birthdate                = $_POST['inp_birthdate'];
$inp_id_number                = $_POST['inp_id_number'];
$inp_family_number            = $_POST['inp_family_number'];
$inp_gender                   = $_POST['inp_gender'];
$inp_blood_type               = $_POST['inp_blood_type'];
$inp_religion                 = $_POST['inp_religion'];
$inp_nationality              = $_POST['inp_nationality'];
$inp_phone                    = $_POST['inp_phone'];
$inp_email                    = $_POST['inp_email'];
$inp_email_personal           = $_POST['inp_email_personal'];

// ___KTP ADDRESS
// ___KTP ADDRESS
$inp_ktp_address              = strtoupper($_POST['inp_ktp_address']);
$inp_ktp_rt                   = $_POST['inp_ktp_rt']; //rt
$inp_ktp_rw                   = $_POST['inp_ktp_rw']; //rw
$inp_ktp_postalcode           = $_POST['inp_ktp_postalcode']; //zipcode
$inp_ktp_country              = $_POST['inp_ktp_country']; //country_id
$inp_ktp_state                = $_POST['inp_ktp_state']; //state_id
$inp_ktp_city                 = $_POST['inp_ktp_city']; //city_id
$inp_ktp_district             = $_POST['inp_ktp_district']; //district
$inp_ktp_subdistrict          = $_POST['inp_ktp_subdistrict']; //subdistrict
// ___KTP ADDRESS
// ___KTP ADDRESS


// DOMISI ADDRESS
// DOMISI ADDRESS
$inp_domisili_address         = strtoupper($_POST['inp_domisili_address']); //address
$inp_domisili_rt              = $_POST['inp_domisili_rt']; //rt
$inp_domisili_rw              = $_POST['inp_domisili_rw']; //rw
$inp_domisili_postalcode      = $_POST['inp_domisili_postalcode']; //zipcode
$inp_domisili_country         = $_POST['inp_domisili_country']; //country_id
$inp_domisili_state           = $_POST['inp_domisili_state']; //state_id
$inp_domisili_city            = $_POST['inp_domisili_city']; //city_id
$inp_domisili_district        = $_POST['inp_domisili_district']; //district
$inp_domisili_subdistrict     = $_POST['inp_domisili_subdistrict']; //subdistrict
// DOMISI ADDRESS
// DOMISI ADDRESS


// SECTION BANK
// SECTION BANK
$empbank_id                   = $_POST['empbank_id'];
$bank_code                    = $_POST['bank_code']; 
$bank_account                 = $_POST['bank_account'];
$account_name                 = $_POST['account_name'];
// SECTION BANK
// SECTION BANK


//SECTION EDUCATION
//SECTION EDUCATION
$edu_code                     = 'EDU'.$modal_lastreqno;
$fam_code                     = 'EMP'.$SFnumber;
$bnk_code                     = 'EMPBANK'.$SFnumber;
//SECTION EDUCATION
//SECTION EDUCATION

for($i=0;$i<count($_POST['data_edu0']);$i++){

        $data_edu0            = $_POST['data_edu0'][$i];
        $data_edu1            = $_POST['data_edu1'][$i];
        $data_edu2            = $_POST['data_edu2'][$i];
        $data_edu3            = $_POST['data_edu3'][$i];
        $data_edu4            = $_POST['data_edu4'][$i];
        $data_edu4A           = $_POST['data_edu4A'][$i];
        $data_edu5            = $_POST['data_edu5'][$i];
        
        if($data_edu0!=='' && $data_edu1!=='' && $data_edu2!=='' && $data_edu3!=='' && $data_edu4!=='' && $data_edu4A!=='' && $data_edu5!==''){
       
            $truncate_before  = mysqli_query($connect, "DELETE FROM mgtools_teodempeducation WHERE emp_id = '$get_empid_r'");

            $get_city_name    = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM tgemcity WHERE city_name = '$data_edu2'"));
            $get_city_name_r1 = $get_city_name['city_id'];
            $get_city_name_r2 = $get_city_name['country_id'];
            $get_city_name_r3 = $get_city_name['state_id'];
            
            $get_edu_name = mysqli_query($connect, "SELECT edu_code FROM teomeduinstitution WHERE edu_name = '$data_edu1'");
            if(mysqli_num_rows($get_edu_name) > 0) {
                  $q_get_edu_name = mysqli_fetch_array($get_edu_name);
                  $q_get_edu_name_r = $q_get_edu_name['edu_code'];
            } else {
                  $q_get_edu_name_r = $edu_code.$i;
                  $process_to_teomeduinstitution = mysqli_query($connect, "INSERT INTO `teomeduinstitution` 
                                                                              (
                                                                                    `edu_code`,
                                                                                    `edu_name`,          
                                                                                    `created_date`,     
                                                                                    `created_by`,  
                                                                                    `modified_date`,
                                                                                    `modified_by`,
                                                                                    `status`
                                                                              )
                                                                              VALUES
                                                                                    (
                                                                                          '$q_get_edu_name_r',
                                                                                          '$data_edu1',
                                                                                          '$SFdatetime',
                                                                                          '$username',
                                                                                          '$SFdatetime',
                                                                                          '$username',
                                                                                          '1'
                                                                                    )");
            }
            

        $sql="INSERT INTO `mgtools_teodempeducation` 
                        (
                              `emp_id`, 
                              `edu_name`, 
                              `edu_type`, 
                              `faculty`, 
                              `start_year`, 
                              `end_year`,
                              `gpa`,
                              `country`,
                              `city`,
                              `state`,
                              `created_date`, 
                              `created_by`, 
                              `modified_date`, 
                              `modified_by`
                        ) VALUES (
                              '$get_empid_r', 
                              '$q_get_edu_name_r', 
                              '$data_edu0', 
                              '$data_edu3',  
                              '$data_edu4', 
                              '$data_edu4A',
                              '$data_edu5',
                              '$get_city_name_r2',
                              '$get_city_name_r1',
                              '$get_city_name_r3', 
                              '$SFdatetime', 
                              '$username', 
                              '$SFdatetime', 
                              '$username')";

            $stmt=$connect->prepare($sql);
            $stmt->execute();
            //echo '<div class="alert alert-success" role="alert">Submitted Successfully</div>';
        }
        else{
            echo '<div class="alert alert-danger" role="alert">Error Submitting in Data</div>';
        }
    }

    $truncate_before = mysqli_query($connect, "DELETE FROM mgtools_teodempemergency WHERE emp_id = '$get_empid_r'");
    $truncate_before = mysqli_query($connect, "DELETE FROM mgtools_tpydempbank WHERE emp_id = '$get_empid_r'");

    for($iemg=0;$iemg<count($_POST['data_emg0']);$iemg++){
      $data_emg0 = $_POST['data_emg0'][$iemg];
      $data_emg1 = $_POST['data_emg1'][$iemg];
      $data_emg2 = $_POST['data_emg2'][$iemg];
      $data_emg3 = $_POST['data_emg3'][$iemg];

      
      if($data_emg0!=='' && $data_emg1!=='' && $data_emg2!=='' && $data_emg3!==''){

      $sql="INSERT INTO `mgtools_teodempemergency` 
                  (
                        `emp_id`, 
                        `contact_name`, 
                        `relationship_code`, 
                        `address`, 
                        `subdistrict_id`, 
                        `district_id`, 
                        `city_id`, 
                        `state_id`, 
                        `country_id`, 
                        `zipcode`, 
                        `phone`, 
                        `relationship_other`, 
                        `created_date`, 
                        `created_by`, 
                        `modified_date`, 
                        `modified_by`
                  ) VALUES 
                        (
                              '$get_empid_r',  
                              '$data_emg0', 
                              '$data_emg1', 
                              '$data_emg3', 
                              '1', 
                              '1', 
                              '1', 
                              '1', 
                              '1', 
                              '1', 
                              '$data_emg2', 
                              '1', 
                              '$SFdatetime', 
                              '$username', 
                              '$SFdatetime', 
                              '$username'
                        )";

          $stmt=$connect->prepare($sql);
          $stmt->execute();
          //echo '<div class="alert alert-success" role="alert">Submitted Successfully</div>';
      }
      else{
          echo '<div class="alert alert-danger" role="alert">Error Submitting in Data</div>';
      }
  }

    $truncate_before = mysqli_query($connect, "DELETE FROM mgtools_teodempfamily WHERE emp_id = '$get_empid_r'");
    for($ifam=0;$ifam<count($_POST['data_fam0']);$ifam++){

      $data_fam0 = $_POST['data_fam0'][$ifam];
      $data_fam1 = $_POST['data_fam1'][$ifam];
      $data_fam2 = $_POST['data_fam2'][$ifam];
      $data_fam3 = $_POST['data_fam3'][$ifam];

      $data_fam1_Upper = strtoupper($data_fam1);

      $dependentsts = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM mgtools_teodempfamily 
                                                                        WHERE relationship = '$data_fam0' and emp_id = '$get_empid_r'
                                                                        ORDER BY dependentsts DESC LIMIT 1"));
      if($data_fam0 == 'CHLD'){
            $dependentsts_r = '1';
      } else if($data_fam0 == 'CHLD2'){
            $dependentsts_r = '2';
      } else if($data_fam0 == 'CHLD3'){
            $dependentsts_r = '3';
      } else if($data_fam0 == 'CHLD4'){
            $dependentsts_r = '4';
      } else if($data_fam0 == 'CHLD5'){
            $dependentsts_r = '5';
      } else if($data_fam0 == 'CHLD6'){
            $dependentsts_r = '6';
      } else if($data_fam0 == 'CHLD7'){
            $dependentsts_r = '7';
      } else if($data_fam0 == 'CHLD8'){
            $dependentsts_r = '8';
      } else if($data_fam0 == 'CHLD9'){
            $dependentsts_r = '9';
      } else {
            $dependentsts_r = $dependentsts['dependentsts']+1;
      }
      
      $relationship_r = $dependentsts['relationship'];
      
      if($data_fam0!=='' && $data_fam1!=='' && $data_fam2!=='' && $data_fam3!==''){

      if($relationship_r == 'FTHR' || $relationship_r == 'MTHR' || $relationship_r == 'MOTL' || $relationship_r == 'FATL' ){
            $sql= "INSERT INTO `mgtools_teodempfamily` 
                              (
                                    `empfamily_id`, 
                                    `emp_id`, 
                                    `name`, 
                                    `relationship`, 
                                    `dependentsts`, 
                                    `gender`, 
                                    `alive_status`, 
                                    `birthplace`, 
                                    `birthdate`, 
                                    `occupation`, 
                                    `familyemp_id`, 
                                    `marital_status`, 
                                    `blood_type`, 
                                    `phone`, 
                                    `address`, 
                                    `document`, 
                                    `supporting_document`, 
                                    `document_date`, 
                                    `lasteducation_status`, 
                                    `child_order`, 
                                    `company`, 
                                    `created_date`, 
                                    `created_by`, 
                                    `modified_date`, 
                                    `modified_by`, 
                                    `first_name`, 
                                    `middle_name`, 
                                    `last_name`, 
                                    `identity_no`, 
                                    `sss_dependent`, 
                                    `bir_dependent`, 
                                    `philhealth_dependent`, 
                                    `disability`, 
                                    `legitimate`
                              ) VALUES 
                                    (
                                          '', 
                                          '',  
                                          '', 
                                          '',
                                          '', 
                                          '',
                                          '',
                                          '',
                                          '',
                                          '',
                                          '',
                                          '',
                                          '',
                                          '',
                                          '', 
                                          '', 
                                          '', 
                                          '',
                                          '', 
                                          '', 
                                          '', 
                                          '',
                                          '',
                                          '', 
                                          '',
                                          '',
                                          '1', 
                                          '1', 
                                          '1', 
                                          '1', 
                                          '1', 
                                          '1', 
                                          '1', 
                                          '1'
                                    )";
      } else {
            $sql= "INSERT INTO `mgtools_teodempfamily` 
                              (
                                    `empfamily_id`, 
                                    `emp_id`, 
                                    `name`, 
                                    `relationship`, 
                                    `dependentsts`, 
                                    `gender`, 
                                    `alive_status`, 
                                    `birthplace`, 
                                    `birthdate`, 
                                    `occupation`, 
                                    `familyemp_id`, 
                                    `marital_status`, 
                                    `blood_type`, 
                                    `phone`, 
                                    `address`, 
                                    `document`, 
                                    `supporting_document`, 
                                    `document_date`, 
                                    `lasteducation_status`, 
                                    `child_order`, 
                                    `company`, 
                                    `created_date`, 
                                    `created_by`, 
                                    `modified_date`, 
                                    `modified_by`, 
                                    `first_name`, 
                                    `middle_name`, 
                                    `last_name`, 
                                    `identity_no`, 
                                    `sss_dependent`, 
                                    `bir_dependent`, 
                                    `philhealth_dependent`, 
                                    `disability`, 
                                    `legitimate`
                              ) VALUES 
                                    (
                                          '$fam_code$ifam', 
                                          '$get_empid_r',  
                                          '$data_fam1_Upper', 
                                          '$data_fam0',
                                          '$dependentsts_r', 
                                          '1', 
                                          '$data_fam3', 
                                          '1', 
                                          '$data_fam2', 
                                          '1', 
                                          '1', 
                                          '1', 
                                          '1', 
                                          '1', 
                                          '1', 
                                          '1', 
                                          '1', 
                                          '2021-08-12 11:21:48', 
                                          '1', 
                                          '1', 
                                          '1', 
                                          '$SFdatetime', 
                                          '$username', 
                                          '$SFdatetime', 
                                          '$username',
                                          '1', 
                                          '1', 
                                          '1', 
                                          '1', 
                                          '1', 
                                          '1', 
                                          '1', 
                                          '1', 
                                          '1'
                                    )";
      }
      

          $stmt= $connect->prepare($sql);
          $stmt->execute();
          //echo '<div class="alert alert-success" role="alert">Submitted Successfully</div>';
          
      }
      else{
          echo '<div class="alert alert-danger" role="alert">Error Submitting in Data</div>';
      }
  }

  
$process_request = mysqli_query($connect, "UPDATE mgtools_teomemppersonal SET
                                                      first_name        = '$modal_inp_first_name',
                                                      middle_name       = '$modal_inp_middle_name',
                                                      last_name         = '$modal_inp_last_name',
                                                      full_name         = '$modal_official_name',
                                                      official_name     = '$modal_official_name',
                                                      gender            = '$inp_gender',
                                                      email             = '$inp_email'
                                                WHERE emp_id      = '$get_empid_r'");

$process_request = mysqli_query($connect, "UPDATE mgtools_teodemppersonal SET
                                                      birthplace        = '$inp_birthplace',
                                                      birthdate         = '$inp_birthdate',
                                                      identity_no       = '$inp_id_number',
                                                      religion_code     = '$inp_religion',
                                                      maritalstatus     = '$inp_marital_status',
                                                      nationality_code  = '$inp_nationality',
                                                      phone             = '$inp_phone'
                                                WHERE emp_id      = '$get_empid_r'");

$process_request = mysqli_query($connect, "INSERT INTO `mgtools_teodempcustomfield` 
                                                            (
                                                                  emp_id,
                                                                  customfield16,
                                                                  customfield15
                                                            ) VALUES
                                                            (
                                                                  '$get_empid_r',
                                                                  '$inp_family_number',
                                                                  '$inp_email_personal'
                                                            )
                                                            ON DUPLICATE KEY UPDATE
                                                            customfield16     = '$inp_family_number',
                                                            customfield15     = '$inp_email_personal'");

$process_request = mysqli_query($connect, "INSERT INTO `mgtools_teodempmedical` 
                                                            (
                                                                  emp_id,
                                                                  bloodtype
                                                            ) VALUES
                                                                  (
                                                                        '$get_empid_r',
                                                                        '$inp_blood_type'
                                                                  )
                                                                  ON DUPLICATE KEY UPDATE
                                                                  bloodtype         = '$inp_blood_type'");

$process_request = mysqli_query($connect, "UPDATE mgtools_view_employee SET
                                                      birthplace        = '$inp_birthplace',
                                                      birthdate         = '$inp_birthdate',
                                                      first_name        = '$modal_inp_first_name',
                                                      middle_name       = '$modal_inp_middle_name',
                                                      last_name         = '$modal_inp_last_name',
                                                      gender            = '$inp_gender',
                                                      maritalstatus     = '$inp_marital_status',
                                                      phone             = '$inp_phone',
                                                      email             = '$inp_email',
                                                      `address`         = '$inp_domisili_address',
                                                      zip_code          = '$inp_domisili_postalcode'
                                                WHERE emp_id      = '$get_empid_r'");

$process_request = mysqli_query($connect, "INSERT INTO `mgtools_tpydempbank` 
                                                (
                                                      `empbank_id`,
                                                      `emp_id`,
                                                      `bank_code`,
                                                      `bank_account`,
                                                      `account_name`,
                                                      `modified_by`,
                                                      `modified_date`
                                                ) VALUES 
                                                      (
                                                            '$bnk_code',
                                                            '$get_empid_r',
                                                            '$bank_code',
                                                            '$bank_account',
                                                            '$account_name',
                                                            '$username',
                                                            '$SFdatetime'
                                                      )");

$process_request = mysqli_query($connect, "INSERT INTO `mgtools_teodempaddress` 
                                                      (
                                                            `emp_id`, 
                                                            `addresstype_code`, 
                                                            `address`, 
                                                            `rt`, 
                                                            `rw`, 
                                                            `subdistrict`, 
                                                            `district`, 
                                                            `city_id`, 
                                                            `state_id`, 
                                                            `country_id`, 
                                                            `zipcode`, 
                                                            `phone`, 
                                                            `living_status`, 
                                                            `owner_status`, 
                                                            `address_distance`, 
                                                            `created_date`,
                                                            `created_by`, 
                                                            `modified_date`, 
                                                            `modified_by`, 
                                                            `lat_lng`, 
                                                            `local_address`
                                                      ) VALUES 
                                                            (
                                                                  '$get_empid_r', 
                                                                  'A', 
                                                                  '$inp_ktp_address', 
                                                                  '$inp_ktp_rt', 
                                                                  '$inp_ktp_rw', 
                                                                  '$inp_ktp_district', 
                                                                  '$inp_ktp_subdistrict', 
                                                                  '$inp_ktp_city', 
                                                                  '$inp_ktp_state', 
                                                                  '$inp_ktp_country', 
                                                                  '$inp_ktp_postalcode', 
                                                                  '0', 
                                                                  '0',
                                                                  '0', 
                                                                  '0', 
                                                                  '$SFdatetime', 
                                                                  '$username', 
                                                                  '$SFdatetime', 
                                                                  '$username', 
                                                                  '0', 
                                                                  '0'
                                                            )
                                                      ON DUPLICATE KEY UPDATE
                                                      `address`         = '$inp_ktp_address',
                                                      `rt`              = '$inp_ktp_rt',
                                                      `rw`              = '$inp_ktp_rw',
                                                      `zipcode`         = '$inp_ktp_postalcode',
                                                      `country_id`      = '$inp_ktp_country',
                                                      `state_id`        = '$inp_ktp_state',
                                                      `city_id`         = '$inp_ktp_city',
                                                      `district`        = '$inp_ktp_district',
                                                      `subdistrict`     = '$inp_ktp_subdistrict'");

$process_request = mysqli_query($connect, "INSERT INTO `mgtools_teodempaddress` 
                                                (
                                                      `emp_id`, 
                                                      `addresstype_code`, 
                                                      `address`, 
                                                      `rt`, 
                                                      `rw`, 
                                                      `subdistrict`, 
                                                      `district`, 
                                                      `city_id`, 
                                                      `state_id`, 
                                                      `country_id`, 
                                                      `zipcode`, 
                                                      `phone`, 
                                                      `living_status`, 
                                                      `owner_status`, 
                                                      `address_distance`, 
                                                      `created_date`,
                                                      `created_by`, 
                                                      `modified_date`, 
                                                      `modified_by`, 
                                                      `lat_lng`, 
                                                      `local_address`
                                                ) VALUES 
                                                      (
                                                            '$get_empid_r', 
                                                            'B', 
                                                            '$inp_domisili_address', 
                                                            '$inp_domisili_rt', 
                                                            '$inp_domisili_rw', 
                                                            '$inp_domisili_district', 
                                                            '$inp_domisili_subdistrict', 
                                                            '$inp_domisili_city', 
                                                            '$inp_domisili_state', 
                                                            '$inp_domisili_country', 
                                                            '$inp_domisili_postalcode', 
                                                            '0', 
                                                            '0',
                                                            '0', 
                                                            '0', 
                                                            '$SFdatetime', 
                                                            '$username', 
                                                            '$SFdatetime', 
                                                            '$username', 
                                                            '0', 
                                                            '0'
                                                      )
                                                ON DUPLICATE KEY UPDATE
                                                      `address`         = '$inp_domisili_address',
                                                      `rt`              = '$inp_domisili_rt',
                                                      `rw`              = '$inp_domisili_rw',
                                                      `zipcode`         = '$inp_domisili_postalcode',
                                                      `country_id`      = '$inp_domisili_country',
                                                      `state_id`        = '$inp_domisili_state',
                                                      `city_id`         = '$inp_domisili_city',
                                                      `district`        = '$inp_domisili_district',
                                                      `subdistrict`     = '$inp_domisili_subdistrict'");







      if($process_request) 
            {
           

                       echo "<script type='text/javascript'>
                              jQuery(function(){           
                              $.redirect('../hrm{sys=emp.update}/summarized', 
                                    {
                                          rfid: '$modal_lastreqno', 
                                          process_time: '$SFtime_current',
                                          pesan: 'Successfully added record shiftgroup $get_empid_r',
                                          filtered: '$SFtime_current',
                                          
                                    }, 
                                    'POST', '_self');       
                              });
                        </script>";
                 
                  }
                  else
                  {
                        echo"<script type='text/javascript'>
                                    window.alert('Wrong Approval Formula');     
                              </script>";
                  } 
      }



















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
                              window.location='../hrm{sys=emp.update}/'
                              }, 3000);
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