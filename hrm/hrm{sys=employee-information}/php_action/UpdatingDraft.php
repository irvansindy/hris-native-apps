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
    $detail_request_update_id = $_POST['detail_request_update_id'];
    $detail_emp_no = $_POST['detail_emp_no'];
    $detail_emp_id = $_POST['detail_emp_id'];
    $detail_full_name = $_POST['detail_full_name'];
    $detail_nip = $_POST['detail_nip'];
    $detail_birth_place = $_POST['detail_birth_place'];
    $detail_birthdate = $_POST['detail_birthdate'];
    $detail_nik = $_POST['detail_nik'];
    $detail_kk = $_POST['detail_kk'];
    $detail_start_date = $_POST['detail_start_date'];
    $detail_gender = $_POST['detail_gender'];
    $detail_blood_type = $_POST['detail_blood_type'];
    $detail_religion = $_POST['detail_religion'];
    $detail_marital_status = $_POST['detail_marital_status'];
    $detail_nationality = $_POST['detail_nationality'];
    $detail_phone_number = $_POST['detail_phone_number'];
    $detail_email = $_POST['detail_email'];
    $detail_email_personal = $_POST['detail_email_personal'];
    $detail_address_ktp = $_POST['detail_address_ktp'];
    $detail_npwp = $_POST['detail_npwp'];
    $detail_ptkp = $_POST['detail_ptkp'];
    $detail_bpjs_ks = $_POST['detail_bpjs_ks'];
    $detail_bpjs_tk = $_POST['detail_bpjs_tk'];
    $detail_insurance = $_POST['detail_insurance'];
    $detail_bank_name = $_POST['detail_bank_name'];
    $detail_bank_number = $_POST['detail_bank_number'];
    $detail_bank_user_account = $_POST['detail_bank_user_account'];
    $detail_bank_branch_office = $_POST['detail_bank_branch_office'];

    $detail_employee_education = $_POST['detail_employee_education'];
    $detail_employee_education_value = $_POST['detail_employee_education_value'];
    $detail_school_name = $_POST['detail_school_name'];
    $detail_school_place = $_POST['detail_school_place'];
    $detail_school_major = $_POST['detail_school_major'];
    $detail_school_start_date = $_POST['detail_school_start_date'];
    $detail_school_end_date = $_POST['detail_school_end_date'];
    $detail_school_ipk = $_POST['detail_school_ipk'];
    
    $detail_contact_name = $_POST['detail_contact_name'];
    $detail_contact_relation = $_POST['detail_contact_relation'];
    $detail_contact_number = $_POST['detail_contact_number'];
    $detail_contact_address = $_POST['detail_contact_address'];
    
    $detail_family_member = $_POST['detail_family_member'];
    $detail_family_member_value = $_POST['detail_family_member_value'];
    $detail_family_name = $_POST['detail_family_name'];
    $detail_family_birth_date = $_POST['detail_family_birth_date'];
    $detail_family_status = $_POST['detail_family_status'];

    if($_POST) {
        $query_updating_draft = "UPDATE view_employee_update SET 
            `emp_id` = '$detail_emp_id',
            `emp_no` = '$detail_emp_no',
            `full_name` = '$detail_full_name',
            `birth_place` = '$detail_birth_place',
            `birth_date` = '$detail_birthdate',
            `gender` = '$detail_gender',
            `NIK` = '$detail_nik',
            `family_card` = '$detail_kk',
            `work_entry_date` = '$detail_start_date',
            `blood_type` = '$detail_blood_type',
            `religion` = '$detail_religion',
            `nationality` = '$detail_nationality',
            `contact` = '$detail_phone_number',
            `email` = '$detail_email',
            `address_ktp` ='$detail_address_ktp',
            `address_domisili` ='$detail_address_ktp',
            `npwp` = '$detail_npwp',
            `ptkp` = '$detail_ptkp',
            `bpjs_ks` = '$detail_bpjs_ks',
            `bpjs_tk` = '$detail_bpjs_tk',
            `insurance_number` = '$detail_insurance',
            `bank_account_name` = '$detail_bank_name',
            `bank_account_number` = '$detail_bank_number',
            `bank_account_user` = '$detail_bank_user_account',
            `bank_account_office` = '$detail_bank_branch_office',
            -- `status`,
            -- `create_date`,
            -- `create_by`,
            `modify_date` = '$date_time',
            `modify_by` = '$detail_emp_no'
            WHERE `request_update_id` = '$detail_request_update_id'
        ";

        $exe_query_updating_draft = $connect->query($query_updating_draft);

        $query_delete_education = "DELETE FROM employee_education_update WHERE request_update_id = '$detail_request_update_id'";
        $exe_query_delete_education = $connect->query($query_delete_education);

        for ($i=0; $i < count($detail_employee_education_value); $i++) { 
            $query_updating_education = "INSERT INTO `employee_education_update` (
                `request_update_id`,
                `name`,
                `school`,
                `location`,
                `major`,
                `year_start`,
                `year_end`,
                `grade_point`
            ) VALUES (
                '$detail_request_update_id',
                '$detail_employee_education_value[$i]',
                '$detail_school_name[$i]',
                '$detail_school_place[$i]',
                '$detail_school_major[$i]',
                '$detail_school_start_date[$i]',
                '$detail_school_end_date[$i]',
                '$detail_school_ipk[$i]'
            )";

            $exe_query_updating_education = $connect->query($query_updating_education);
        }

        $query_delete_contact = "DELETE FROM employee_emergency_contact_update WHERE request_update_id = '$detail_request_update_id'";
        $exe_query_delete_contact = $connect->query($query_delete_contact);

        for ($i= 0; $i < count($detail_contact_name); $i++) {
            $query_updating_contact = "INSERT INTO `employee_emergency_contact_update` (
                `request_update_id`,
                `name`,
                `relation`,
                `number`,
                `address`
            ) VALUES (
                '$detail_request_update_id',
                '$detail_contact_name[$i]',
                '$detail_contact_relation[$i]',
                '$detail_contact_number[$i]',
                '$detail_contact_address[$i]'
            )";

            $exe_query_updating_contact = $connect->query($query_updating_contact);
        }

        $query_delete_family = "DELETE FROM employee_family_dependent_update WHERE request_update_id = '$detail_request_update_id'";
        $exe_query_delete_family = $connect->query($query_delete_family);

        for ($i= 0; $i < count($detail_family_member); $i++) {
            $query_updating_family = "INSERT INTO `employee_family_dependent_update` (
                `request_update_id`,
                `member_type`,
                `name`,
                `birth_date`,
                `status`
            ) VALUES (
                '$detail_request_update_id',
                '$detail_family_member[$i]',
                '$detail_family_name[$i]',
                '$detail_family_birth_date[$i]',
                '$detail_family_status[$i]'
            )";

            $exe_query_updating_family = $connect->query($query_updating_family);
        }

        if ($exe_query_updating_draft = FALSE) {
            http_response_code(422);
            mysqli_rollback($connect);
            $response['success'] = false;
            $response['code'] = "failed_message";
            $response['messages'] = 'Update employee failed to update';
        } else {
            http_response_code(200);
            $response['success'] = true;
            $response['code'] = "success_message";
            $response['messages'] = 'Update employee successfully updated';
        }

        $connect->close();
        header('Content-Type: application/json');
        echo json_encode($response);
    }