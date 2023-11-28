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

    // $db_host2 = "127.0.0.1";
    // $db_user2 = "root";
    // $db_password2 = "";
    // $db_name2 = "hris";
    // $db_port2 = "3306";

    $db_connect2 = mysqli_connect($db_host2, $db_user2, $db_password2, $db_name2);

    if(mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: ". mysqli_connect_error();
    }

    $query_fetch_emp_applicant_from_career = "SELECT 
        a.*,
        b.*
        FROM employer_applicant a 
        LEFT JOIN log_scheduler b
            ON a.id_applicant = b.table_id
        WHERE b.table_id IS NULL";

    $query_fetch_comp_vacancy_from_career = "SELECT 
        a.*,
        b.*
        FROM company_vacancy a 
        LEFT JOIN log_scheduler b
            ON a.id_vacancy = b.table_id
        WHERE b.table_id IS NULL";

    $result_emp_applicant = mysqli_fetch_all(mysqli_query($db_connect1, $query_fetch_emp_applicant_from_career), MYSQLI_ASSOC);
    $result_comp_vacancy = mysqli_fetch_all(mysqli_query($db_connect1, $query_fetch_comp_vacancy_from_career), MYSQLI_ASSOC);

    // var_dump($result_emp_applicant[0]["id_applicant"]);

    for ($i=0; $i < count($result_emp_applicant); $i++) { 
        $emp_app_id_applicant = $result_emp_applicant[$i]['id_applicant'];
        $emp_app_userid = $result_emp_applicant[$i]['userid'];
        $emp_app_id_vacancy = $result_emp_applicant[$i]['id_vacancy'];
        $emp_app_applied_at = $result_emp_applicant[$i]['applied_at'];
        $emp_app_receive_at = $result_emp_applicant[$i]['receive_at'];
        $emp_app_status = $result_emp_applicant[$i]['status'];
        $emp_app_created_at = $result_emp_applicant[$i]['created_at'];
        $emp_app_Updated_at = $result_emp_applicant[$i]['Updated_at'];
        $emp_app_value = $result_emp_applicant[$i]['value'];
        $emp_app_process = $result_emp_applicant[$i]['process'];
        $emp_app_progress = $result_emp_applicant[$i]['progress'];

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
            '$emp_app_id_applicant',
            '$emp_app_userid',
            '$emp_app_id_vacancy',
            '$emp_app_applied_at',
            '$emp_app_receive_at',
            '$emp_app_status',
            '$emp_app_created_at',
            '$emp_app_Updated_at',
            '$emp_app_value',
            '$emp_app_process',
            '$emp_app_progress'
        )";

        $exe_emp_applicant_to_hris = $db_connect2->query($query_insert_emp_applicant_to_hris);
        // log_scheduler
        $query_log_schedule_emp_applicant = "INSERT INTO `log_scheduler` (
            `table_id`,
            `initial_table`,
            `created_date`,
            `status`
        ) VALUES (
            '$emp_app_id_applicant',
            'employer_applicant',
            '$SFdatetime',
            '1'
        )";

        $exe_log_schedule_emp_applicant = $db_connect1->query($query_log_schedule_emp_applicant);
    }

    for ($i=0; $i < count($result_comp_vacancy); $i++) { 
        $comp_vacancy_id = $result_comp_vacancy[$i]["id_vacancy"];
        $comp_vacancy_name = $result_comp_vacancy[$i]["vacancy_name"];
        $comp_company_name = $result_comp_vacancy[$i]["company_name"];
        $comp_banner = $result_comp_vacancy[$i]["banner"];
        $comp_status = $result_comp_vacancy[$i]["status"];
        $comp_vacancy_detail = $result_comp_vacancy[$i]["vacancy_detail"];
        $comp_created_by = $result_comp_vacancy[$i]["created_by"];
        $comp_created_date = $result_comp_vacancy[$i]["created_date"];
        $comp_modified_by = $result_comp_vacancy[$i]["modified_by"];
        $comp_modified_date = $result_comp_vacancy[$i]["modified_date"];
        $comp_reqDegree = $result_comp_vacancy[$i]["reqDegree"];
        $comp_reqMajor = $result_comp_vacancy[$i]["reqMajor"];
        $comp_reqCity = $result_comp_vacancy[$i]["reqCity"];
        $comp_reqState = $result_comp_vacancy[$i]["reqState"];
        $comp_salary = $result_comp_vacancy[$i]["salary"];

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
        ) VALUES (
            '$comp_vacancy_id',
            '$comp_vacancy_name',
            '$comp_company_name',
            '$comp_banner',
            '$comp_status',
            '$comp_vacancy_detail',
            '$comp_created_by',
            '$comp_created_date',
            '$comp_modified_by',
            '$comp_modified_date',
            '$comp_reqDegree',
            '$comp_reqMajor',
            '$comp_reqCity',
            '$comp_reqState',
            '$comp_salary'
        )";

        $exe_emp_applicant_to_hris = $db_connect2->query($query_insert_comp_vacancy_to_hris);

        $query_log_schedule_com_vacancy = "INSERT INTO `log_scheduler` (
            `table_id`,
            `initial_table`,
            `created_date`,
            `status`
        ) VALUES (
            '$comp_vacancy_id',
            'company_vacancy',
            '$SFdatetime',
            '1'
        )";

        $exe_log_schedule_com_vacancy = $db_connect1->query($query_log_schedule_com_vacancy);

    }
    
    // echo json_encode([
    //     $result_emp_applicant[0],
    //     $result_comp_vacancy[0]
    // ]);