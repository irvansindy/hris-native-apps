<?php
    error_reporting(0);
    date_default_timezone_set('Asia/Jakarta');
    require_once '../../../application/config.php';

    // response json
    $response = [
        'success' => false,
        'code' => [],
        'messages' => []
    ];

    // set local time
    $date = date('Y-m-d');
    $date_time = date("Y-m-d H:i:s");

    // set variable
    // set local time
    $date = date('Y-m-d');
    $date_time = date("Y-m-d H:i:s");

    // set variable
    $inp_emp_no = $_POST['inp_emp_no'];
    $inp_emp_id = $_POST['inp_emp_id'];
    $inp_full_name = $_POST['inp_full_name'];
    $inp_nip = $_POST['inp_nip'];
    $inp_birth_place = $_POST['inp_birth_place'];
    $inp_birthdate = $_POST['inp_birthdate'];
    $inp_nik = $_POST['inp_nik'];
    $inp_kk = $_POST['inp_kk'];
    $inp_start_date = $_POST['inp_start_date'];
    $inp_gender = $_POST['inp_gender'];
    $inp_blood_type = $_POST['inp_blood_type'];
    $inp_religion = $_POST['inp_religion'];
    $inp_marital_status = $_POST['inp_marital_status'];
    $inp_nationality = $_POST['inp_nationality'];
    $inp_phone_number = $_POST['inp_phone_number'];
    $inp_email = $_POST['inp_email'];
    $inp_email_personal = $_POST['inp_email_personal'];
    $inp_address_ktp = $_POST['inp_address_ktp'];
    $inp_npwp = $_POST['inp_npwp'];
    $inp_ptkp = $_POST['inp_ptkp'];
    $inp_bpjs_ks = $_POST['inp_bpjs_ks'];
    $inp_bpjs_tk = $_POST['inp_bpjs_tk'];
    $inp_insurance = $_POST['inp_insurance'];
    $inp_bank_name = $_POST['inp_bank_name'];
    $inp_bank_number = $_POST['inp_bank_number'];
    $inp_bank_user_account = $_POST['inp_bank_user_account'];
    $inp_bank_branch_office = $_POST['inp_bank_branch_office'];

    $input_employee_education = $_POST['input_employee_education'];
    $input_school_name = $_POST['input_school_name'];
    $input_school_place = $_POST['input_school_place'];
    $input_school_major = $_POST['input_school_major'];
    $input_school_start_date = $_POST['input_school_start_date'];
    $input_school_end_date = $_POST['input_school_end_date'];
    $input_school_ipk = $_POST['input_school_ipk'];
    
    $input_contact_name = $_POST['input_contact_name'];
    $input_contact_relation = $_POST['input_contact_relation'];
    $input_contact_number = $_POST['input_contact_number'];
    $input_contact_address = $_POST['input_contact_address'];
    
    $input_family_member = $_POST['input_family_member'];
    $input_family_name = $_POST['input_family_name'];
    $input_family_birth_date = $_POST['input_family_birth_date'];
    $input_family_status = $_POST['input_family_status'];

    $query_get_format_number = "SELECT code_type, code_pattern, seq_number, reset_flag FROM tclmdocnumber WHERE code_type = 'EMPDATACHANGES'";
    $result_format_number = mysqli_fetch_assoc(mysqli_query($connect, $query_get_format_number));

    $pattern_number = $result_format_number["code_pattern"];

    $pattern_number = str_replace(['[', ']'], '', $pattern_number);

    $substring = substr($pattern_number, 0,3);
    
    $numbering_length = strlen($result_format_number['seq_number']);

    // generate first number
    $first_number = '';
    $current_first_number_auto = $result_format_number['seq_number'] + 1;
    if ($numbering_length == 1) {
        $first_number = '00000'.$current_first_number_auto;
    } else if ($numbering_length == 2) {
        $first_number = '0000'.$current_first_number_auto;
    } else if ($numbering_length == 3) {
        $first_number = '000'.$current_first_number_auto;
    } else if ($numbering_length == 4) {
        $first_number = '00'.$current_first_number_auto;
    } else if ($numbering_length == 5) {
        $first_number = '0'.$current_first_number_auto;
    } else if ($numbering_length == 6) {
        $first_number = $current_first_number_auto;
    }

    // generate month romawi
    $month = date("m");
    $month_romawi = '';
    switch ($month) {
        case '01':
            $month_romawi = 'I';
            break;
        case '02':
            $month_romawi = 'II';
            break;
        case '03':
            $month_romawi = 'III';
            break;
        case '04':
            $month_romawi = 'IV';
            break;
        case '05':
            $month_romawi = 'V';
            break;
        case '06':
            $month_romawi = 'VI';
            break;
        case '07':
            $month_romawi = 'VII';
            break;
        case '08':
            $month_romawi = 'VIII';
            break;
        case '09':
            $month_romawi = 'IX';
            break;
        case '10':
            $month_romawi = 'X';
            break;
        case '11':
            $month_romawi = 'XI';
            break;
        case '12':
            $month_romawi = 'XII';
            break;
        default:
            $month_romawi = '';
            break;
    }

    $year = date('Y');
    $result_auto_number = $substring.'-'.$month_romawi.'/'.$year.'-'.$first_number;

    // var_dump($result_auto_number);

    if($_POST){
        $query_update_employee = "INSERT INTO `view_employee_update` (
            `request_update_id`,
            `emp_id`,
            `emp_no`,
            `full_name`,
            `birth_place`,
            `birth_date`,
            `gender`,
            `NIK`,
            `family_card`,
            `work_entry_date`,
            `blood_type`,
            `religion`,
            `nationality`,
            `contact`,
            `email`,
            `address_ktp`,
            `address_domisili`,
            `npwp`,
            `ptkp`,
            `bpjs_ks`,
            `bpjs_tk`,
            `insurance_number`,
            `bank_account_name`,
            `bank_account_number`,
            `bank_account_user`,
            `bank_account_office`,
            `status`,
            `create_date`,
            `create_by`,
            `modify_date`,
            `modify_by`
        ) VALUE (
            '$result_auto_number',
            '$inp_emp_id',
            '$inp_emp_no',
            '$inp_full_name',
            '$inp_birth_place',
            '$inp_birthdate',
            '$inp_gender',
            '$inp_nik',
            '$inp_kk',
            '$inp_start_date',
            '$inp_blood_type',
            '$inp_religion',
            '$inp_nationality',
            '$inp_phone_number',
            '$inp_email',
            '$inp_address_ktp',
            '$inp_address_ktp',
            '$inp_npwp',
            '$inp_ptkp',
            '$inp_bpjs_ks',
            '$inp_bpjs_tk',
            '$inp_insurance',
            '$inp_bank_name',
            '$inp_bank_number',
            '$inp_bank_user_account',
            '$inp_bank_branch_office',
            'submit',
            '$date_time',
            '$inp_emp_no',
            '$date_time',
            '$inp_emp_no'
        )";

        // var_dump($query_update_employee);

        $exe_update_employee = $connect->query($query_update_employee);

        $query_update_counter = "UPDATE tclmdocnumber SET 
            `seq_number` = '$current_first_number_auto'
            WHERE code_type = 'EMPDATACHANGES'";
        $exe_update_counter = $connect->query($query_update_counter);

        if (count($input_employee_education) != 0) {
            for ($i=0; $i < count($input_employee_education); $i++) { 
                $query_create_update_education = "INSERT INTO `employee_education_update` (
                    `request_update_id`,
                    `name`,
                    `school`,
                    `location`,
                    `major`,
                    `year_start`,
                    `year_end`,
                    `grade_point`
                ) VALUES (
                    '$result_auto_number',
                    '$input_employee_education[$i]',
                    '$input_school_name[$i]',
                    '$input_school_place[$i]',
                    '$input_school_major[$i]',
                    '$input_school_start_date[$i]',
                    '$input_school_end_date[$i]',
                    '$input_school_ipk[$i]'
                )";

                $exe_query_create_update_education = $connect->query($query_create_update_education);
            }
        }

        if (count($input_contact_name) != 0) {
            for ($i= 0; $i < count($input_contact_name); $i++) {
                $query_create_update_contact = "INSERT INTO `employee_emergency_contact_update` (
                    `request_update_id`,
                    `name`,
                    `relation`,
                    `number`,
                    `address`
                ) VALUES (
                    '$result_auto_number',
                    '$input_contact_name[$i]',
                    '$input_contact_relation[$i]',
                    '$input_contact_number[$i]',
                    '$input_contact_address[$i]'
                )";
            }

            $exe_query_create_update_contact = $connect->query($query_create_update_contact);
        }

        if (count($input_family_member) != 0) {
            for ($i= 0; $i < count($input_family_member); $i++) {
                $query_create_update_family = "INSERT INTO `employee_family_dependent_update` (
                    `request_update_id`,
                    `member_type`,
                    `name`,
                    `birth_date`,
                    `status`
                ) VALUES (
                    '$result_auto_number',
                    '$input_family_member[$i]',
                    '$input_family_name[$i]',
                    '$input_family_birth_date[$i]',
                    '$input_family_status[$i]'
                )";
            }
        }

        if ($exe_update_employee = FALSE) {
            http_response_code(422);
            mysqli_rollback($connect);
            $response['success'] = false;
            $response['code'] = "failed_message";
            $response['messages'] = 'Update employee failed to create';
        } else {
            http_response_code(200);
            $response['success'] = true;
            $response['code'] = "success_message";
            $response['messages'] = 'Update employee successfully added';
        }

        $connect->close();
        header('Content-Type: application/json');
        echo json_encode($response);
    }