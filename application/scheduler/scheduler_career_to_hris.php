<?php
    error_reporting(0);
    date_default_timezone_set('Asia/Jakarta');

    $SFdate = date("Y-m-d");
    $SFtime = date('h:i:s');
    $SFdatetime = date("Y-m-d H:i:s");
    $SFyear = date("Y");
    $SFnumber = date("YmdHis");

    $db_host1 = "career.pralon.co.id";
    $db_user1 = "pralonco_career";
    $db_password1 = "P@yr0ll009ksf";
    $db_name1 = "pralonco_career";
    $db_port1 = "3306";

    $db_connect1 = mysqli_connect($db_host1, $db_user1, $db_password1, $db_name1);

    $db_host2 = "pralon.co.id";
    $db_user2 = "pralonco_hris_dev";
    $db_password2 = "P@yr0ll009ksf";
    $db_name2 = "pralonco_hris_dev";
    $db_port2 = "3306";

    $db_connect2 = mysqli_connect($db_host2, $db_user2, $db_password2, $db_name2);

    if(mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: ". mysqli_connect_error();
    }

    $query_fetch_emp_applicant_from_career = "SELECT 
        a.*,
        b.*
        FROM employer_applicant a 
        LEFT JOIN log_scheduler b
            ON a.id_applicant = b.key
        AND b.key IS NULL";
    $query_fetch_comp_vacancy_from_career = "SELECT 
        a.*,
        b.*
        FROM company_vacancy a 
        LEFT JOIN log_scheduler b
            ON a.id_vacancy = b.key
        AND b.key IS NULL";

    $result_emp_applicant = mysqli_fetch_all(mysqli_query($db_connect1, $query_fetch_emp_applicant_from_career), MYSQLI_ASSOC);
    $result_comp_vacancy = mysqli_fetch_all(mysqli_query($db_connect1, $query_fetch_comp_vacancy_from_career), MYSQLI_ASSOC);

    for ($i=0; $i < count($result_emp_applicant); $i++) { 
        $query_insert_emp_applicant_to_hris = "INSERT INTO `employer_applicant` (
            `id_applicant`,
            `userid`,
            `id_vacancy`,
            `applied_at`,
            `receive_at`,
            `status`,
            `created_at`,
            `Updated_at`,
            `value`,
            `process`,
            `progress`
        ) VALUES (
            '$result_emp_applicant[$i][`id_vacancy`]',
            '$result_emp_applicant[$i][`userid`]',
            '$result_emp_applicant[$i][`id_vacancy`]',
            '$result_emp_applicant[$i][`applied_at`]',
            '$result_emp_applicant[$i][`receive_at`]',
            '$result_emp_applicant[$i][`status`]',
            '$result_emp_applicant[$i][`created_at`]',
            '$result_emp_applicant[$i][`Updated_at`]',
            '$result_emp_applicant[$i][`value`]',
            '$result_emp_applicant[$i][`process`]',
            '$result_emp_applicant[$i][`progress`]'
        )";

        $exe_emp_applicant_to_hris = $db_connect2->query($query_insert_emp_applicant_to_hris);
        // log_scheduler
        $query_log_schedule_emp_applicant = "INSERT INTO `log_scheduler` (
            `key`,
            `initial_table`,
            `created_date`,
            `status`
        ) VALUES (
            '$result_emp_applicant[$i][`id_vacancy`]',
            'employer_applicant',
            '$SFdatetime',
            '1'
        )";

        $exe_log_schedule_emp_applicant = $db_connect2->query($query_log_schedule_emp_applicant);
    }

    for ($i=0; $i < count($result_comp_vacancy); $i++) { 
        $query_insert_comp_vacancy_to_hris = "INSERT INTO `company_vacancy` (
            `id_vacancy`,
            `vacancy_name`,
            `company_name`,
            `banner`,
            `status`,
            `vacancy_detail`,
            `created_by`,
            `created_date`,
            `modified_by`,
            `modified_date`,
            `reqDegree`,
            `reqMajor`,
            `reqCity`,
            `reqState`,
            `salary`
        )";

        $exe_emp_applicant_to_hris = $db_connect2->query($query_insert_comp_vacancy_to_hris);

        $query_log_schedule_com_vacancy = "INSERT INTO `log_scheduler` (
            `key`,
            `initial_table`,
            `created_date`,
            `status`
        ) VALUES (
            '$result_emp_applicant[$i][`id_vacancy`]',
            'employer_applicant',
            '$SFdatetime',
            '1'
        )";

        $exe_log_schedule_com_vacancy = $db_connect2->query($query_log_schedule_com_vacancy);
    }