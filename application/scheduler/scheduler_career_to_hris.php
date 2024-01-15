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

    // $db_host2 = "pralon.co.id";
    // $db_user2 = "pralonco_hris_dev";
    // $db_password2 = "P@yr0ll009ksf";
    // $db_name2 = "pralonco_hris_dev";
    // $db_port2 = "3306";

    $db_host2 = "127.0.0.1";
    $db_user2 = "root";
    $db_password2 = "";
    $db_name2 = "hris";
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
            ON a.id_applicant = b.table_id
        WHERE b.table_id IS NULL";

    $query_fetch_comp_vacancy_from_career = "SELECT 
        a.*,
        b.*
        FROM company_vacancy a 
        LEFT JOIN log_scheduler b
            ON a.id_vacancy = b.table_id
        WHERE b.table_id IS NULL";

    $query_fetch_users_from_career = "SELECT 
        a.*,
        b.*
        FROM teodempersonal a 
        LEFT JOIN log_scheduler b
            ON a.userid = b.table_id
        WHERE b.table_id IS NULL";

    $query_fetch_user_experience_from_career = "SELECT 
        a.*,
        b.*
        FROM userexperience a 
        LEFT JOIN log_scheduler b
            ON a.id = b.table_id
        WHERE b.table_id IS NULL";

    $query_fetch_user_family_from_career = "SELECT 
        a.*,
        b.*
        FROM userfamily a 
        LEFT JOIN log_scheduler b
            ON a.id = b.table_id
        WHERE b.table_id IS NULL";
    
    $query_fetch_user_edu_from_career = "SELECT 
        a.*,
        b.*
        FROM usereducation a 
        LEFT JOIN log_scheduler b
            ON a.id = b.table_id
        WHERE b.table_id IS NULL";
    
    $query_fetch_user_skill_from_career = "SELECT 
        a.*,
        b.*
        FROM userskill a 
        LEFT JOIN log_scheduler b
            ON a.id = b.table_id
        WHERE b.table_id IS NULL";
    
    $query_fetch_user_training_from_career = "SELECT 
        a.*,
        b.*
        FROM userTrainingAchievement a 
        LEFT JOIN log_scheduler b
            ON a.id = b.table_id
        WHERE b.table_id IS NULL";

    $result_emp_applicant = mysqli_fetch_all(mysqli_query($db_connect1, $query_fetch_emp_applicant_from_career), MYSQLI_ASSOC);
    $result_comp_vacancy = mysqli_fetch_all(mysqli_query($db_connect1, $query_fetch_comp_vacancy_from_career), MYSQLI_ASSOC);
    $result_users = mysqli_fetch_all(mysqli_query($db_connect1, $query_fetch_users_from_career), MYSQLI_ASSOC);
    $result_user_experience = mysqli_fetch_all(mysqli_query($db_connect1, $query_fetch_user_experience_from_career), MYSQLI_ASSOC);
    $result_user_family = mysqli_fetch_all(mysqli_query($db_connect1, $query_fetch_user_family_from_career), MYSQLI_ASSOC);
    $result_user_edu = mysqli_fetch_all(mysqli_query($db_connect1, $query_fetch_user_edu_from_career), MYSQLI_ASSOC);
    $result_user_skill = mysqli_fetch_all(mysqli_query($db_connect1, $query_fetch_user_skill_from_career), MYSQLI_ASSOC);
    $result_user_training = mysqli_fetch_all(mysqli_query($db_connect1, $query_fetch_user_training_from_career), MYSQLI_ASSOC);

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

        $query_insert_emp_applicant_detail_to_hris = "INSERT INTO `employer_applicant_detail` (
            `employer_applicant_id`,
            `application_status_id`,
            `created_at`,
            `updated_at`
        ) VALUES (
            '$emp_app_id_applicant',
            0,
            '$SFdatetime',
            '0000-00-00 00:00:00'
        )";

        $exe_emp_applicant_detail_to_hris = $db_connect2->query($query_insert_emp_applicant_detail_to_hris);

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
    
    for ($i=0; $i < count($result_users) ; $i++) { 
        $user_id = $result_users[$i]["userid"];
        $first_name = $result_users[$i]["first_name"];
        $middle_name = $result_users[$i]["middle_name"];
        $last_name = $result_users[$i]["last_name"];
        $full_name = $result_users[$i]["full_name"];
        $email = $result_users[$i]["email"];
        $gender = $result_users[$i]["gender"];
        $photo = $result_users[$i]["photo"];
        $birthplace = $result_users[$i]["birthplace"];
        $birthdate = $result_users[$i]["birthdate"];
        $maritalstatus = $result_users[$i]["maritalstatus"];
        $address = $result_users[$i]["address"];
        $city_id = $result_users[$i]["city_id"];
        $state_id = $result_users[$i]["state_id"];
        $religion = $result_users[$i]["religion"];
        $idnumber = $result_users[$i]["idnumber"];
        $created_at = $result_users[$i]["created_at"];
        $created_by = $result_users[$i]["created_by"];
        $updated_at = $result_users[$i]["updated_at"];
        $modified_by = $result_users[$i]["modified_by"];

        $query_insert_users_to_hris = "INSERT INTO `teodempersonal` (
            `userid`,
            `first_name`,
            `middle_name`,
            `last_name`,
            `full_name`,
            `email`,
            `gender`,
            `photo`,
            `birthplace`,
            `birthdate`,
            `maritalstatus`,
            `address`,
            `city_id`,
            `state_id`,
            `religion`,
            `idnumber`,
            `created_at`,
            `created_by`,
            `updated_at`,
            `modified_by`
        ) VALUES (
            '$user_id',
            '$first_name',
            '$middle_name',
            '$last_name',
            '$full_name',
            '$email',
            '$gender',
            '$photo',
            '$birthplace',
            '$birthdate',
            '$maritalstatus',
            '$address',
            '$city_id',
            '$state_id',
            '$religion',
            '$idnumber',
            '$created_at',
            '$created_by',
            '$updated_at',
            '$modified_by'
        )";

        $exe_insert_users = $db_connect2->query($query_insert_users_to_hris);

        // log_scheduler
        $query_log_schedule_users = "INSERT INTO `log_scheduler` (
            `table_id`,
            `initial_table`,
            `created_date`,
            `status`
        ) VALUES (
            '$user_id',
            'teodempersonal',
            '$SFdatetime',
            '1'
        )";

        $exe_log_schedule_users = $db_connect1->query($query_log_schedule_users);
    }

    for ($i=0; $i < count($result_user_experience) ; $i++) { 
        $user_exp_id = $result_user_experience[$i]["id"];
        $user_exp_userid = $result_user_experience[$i]["userid"];
        $user_exp_company_name = $result_user_experience[$i]["companyName"];
        $user_exp_company_address = $result_user_experience[$i]["companyAddress"];
        $user_exp_yos_start = $result_user_experience[$i]["yosStart"];
        $user_exp_yos_end = $result_user_experience[$i]["yosEnd"];
        $user_exp_pos_start = $result_user_experience[$i]["posStart"];
        $user_exp_pos_end = $result_user_experience[$i]["posEnd"];
        $user_exp_job_desc = $result_user_experience[$i]["jobDesc"];
        $user_exp_project = $result_user_experience[$i]["project"];
        $user_exp_salary_start = $result_user_experience[$i]["salaryStart"];
        $user_exp_salary_end = $result_user_experience[$i]["salaryEnd"];
        $user_exp_benefit = $result_user_experience[$i]["benefit"];
        $user_exp_leave_reason = $result_user_experience[$i]["leavingReason"];
        $user_exp_created_at = $result_user_experience[$i]["created_at"];
        $user_exp_updated_at = $result_user_experience[$i]["updated_at"];

        $query_insert_user_exp = "INSERT INTO `userexperience` (
            `id`,
            `userid`,
            `companyName`,
            `companyAddress`,
            `yosStart`,
            `yosEnd`,
            `posStart`,
            `posEnd`,
            `jobDesc`,
            `project`,
            `salaryStart`,
            `salaryEnd`,
            `benefit`,
            `leavingReason`,
            `created_at`,
            `updated_at`
        ) VALUES (
            '$user_exp_id',
            '$user_exp_userid',
            '$user_exp_company_name',
            '$user_exp_company_address',
            '$user_exp_yos_start',
            '$user_exp_yos_end',
            '$user_exp_pos_start',
            '$user_exp_pos_end',
            '$user_exp_job_desc',
            '$user_exp_project',
            '$user_exp_salary_start',
            '$user_exp_salary_end',
            '$user_exp_benefit',
            '$user_exp_leave_reason',
            '$user_exp_created_at',
            '$user_exp_updated_at'
        )";

        $exe_insert_user_exp = $db_connect2->query($query_insert_user_exp);

        // log_scheduler
        $query_log_schedule_user_exp = "INSERT INTO `log_scheduler` (
            `table_id`,
            `initial_table`,
            `created_date`,
            `status`
        ) VALUES (
            '$user_exp_id',
            'userexperience',
            '$SFdatetime',
            '1'
        )";

        $exe_log_schedule_user_exp = $db_connect1->query($query_log_schedule_user_exp);
    }

    for ($i=0; $i < count($result_user_family) ; $i++) { 
        $user_family_id = $result_user_family[$i]["id"];
        $user_family_user_id = $result_user_family[$i]["userid"];
        $user_family_name = $result_user_family[$i]["familyName"];
        $user_family_relation = $result_user_family[$i]["familyRelation"];
        $user_family_age = $result_user_family[$i]["age"];
        $user_family_occupation = $result_user_family[$i]["occupation"];
        $user_family_status = $result_user_family[$i]["status"];
        $user_family_created_at = $result_user_family[$i]["created_at"];
        $user_family_updated_at = $result_user_family[$i]["updated_at"];

        $query_insert_user_family = "INSERT INTO `userfamily` (
            `id`,
            `userid`,
            `familyName`,
            `familyRelation`,
            `age`,
            `occupation`,
            `status`,
            `updated_at`,
            `created_at`
        ) VALUES (
            '$user_family_id',
            '$user_family_user_id',
            '$user_family_name',
            '$user_family_relation',
            '$user_family_age',
            '$user_family_occupation',
            '$user_family_status',
            '$user_family_created_at',
            '$user_family_updated_at'
        )";

        $exe_insert_user_family = $db_connect2->query($query_insert_user_family);

        // log_scheduler
        $query_log_schedule_user_family = "INSERT INTO `log_scheduler` (
            `table_id`,
            `initial_table`,
            `created_date`,
            `status`
        ) VALUES (
            '$user_family_id',
            'userfamily',
            '$SFdatetime',
            '1'
        )";

        $exe_log_schedule_user_family = $db_connect1->query($query_log_schedule_user_family);
    }

    for ($i=0; $i < count($result_user_edu) ; $i++) { 
        $user_edu_id = $result_user_edu[$i]["id"];
        $user_edu_user_id = $result_user_edu[$i]["userid"];
        $user_edu_name = $result_user_edu[$i]["institutionName"];
        $user_edu_degree = $result_user_edu[$i]["degree"];
        $user_edu_major = $result_user_edu[$i]["major"];
        $user_edu_start_year = $result_user_edu[$i]["startYear"];
        $user_edu_end_year = $result_user_edu[$i]["endYear"];
        $user_edu_achievement = $result_user_edu[$i]["achievement"];
        $user_edu_updated_at = $result_user_edu[$i]["updated_at"];
        $user_edu_created_at = $result_user_edu[$i]["created_at"];
        $user_edu_value = $result_user_edu[$i]["value"];

        $query_insert_user_edu = "INSERT INTO `usereducation` (
            `id`,
            `userid`,
            `institutionName`,
            `degree`,
            `major`,
            `startYear`,
            `endYear`,
            `achievement`,
            `updated_at`,
            `created_at`,
            `value`
        ) VALUES (
            '$user_edu_id',
            '$user_edu_user_id',
            '$user_edu_name',
            '$user_edu_degree',
            '$user_edu_major',
            '$user_edu_start_year',
            '$user_edu_end_year',
            '$user_edu_achievement',
            '$user_edu_updated_at',
            '$user_edu_created_at',
            '$user_edu_value'
        )";

        $exe_insert_user_edu = $db_connect2->query($query_insert_user_edu);

        // log_scheduler
        $query_log_schedule_user_edu = "INSERT INTO `log_scheduler` (
            `table_id`,
            `initial_table`,
            `created_date`,
            `status`
        ) VALUES (
            '$user_edu_id',
            'usereducation',
            '$SFdatetime',
            '1'
        )";

        $exe_log_schedule_user_edu = $db_connect1->query($query_log_schedule_user_edu);
    }

    for ($i=0; $i < count($result_user_skill) ; $i++) { 
        $skill_id = $result_user_skill[$i]["id"];
        $skill_user_id = $result_user_skill[$i]["userid"];
        $skill_name = $result_user_skill[$i]["skillName"];
        $skill_category = $result_user_skill[$i]["skillCategory"];
        $skill_value = $result_user_skill[$i]["skillValue"];
        $skill_from = $result_user_skill[$i]["skillFrom"];
        $skill_created_at = $result_user_skill[$i]["created_at"];
        $skill_updated_at = $result_user_skill[$i]["updated_at"];
        $skill_bar_color = $result_user_skill[$i]["barColor"];

        $query_insert_user_skill = "INSERT INTO `userskill` (
            `id`,
            `userid`,
            `skillName`,
            `skillCategory`,
            `skillValue`,
            `skillFrom`,
            `created_at`,
            `updated_at`,
            `barColor`
        ) VALUES (
            '$skill_id',
            '$skill_user_id',
            '$skill_name',
            '$skill_category',
            '$skill_value',
            '$skill_from',
            '$skill_created_at',
            '$skill_updated_at',
            '$skill_bar_color'
        )";

        $exe_insert_user_skill = $db_connect2->query($query_insert_user_skill);

        // log_scheduler
        $query_log_schedule_user_skill = "INSERT INTO `log_scheduler` (
            `table_id`,
            `initial_table`,
            `created_date`,
            `status`
        ) VALUES (
            '$skill_id',
            'userskill',
            '$SFdatetime',
            '1'
        )";

        $exe_log_schedule_user_skill = $db_connect1->query($query_log_schedule_user_skill);
    }

    for ($i=0; $i < count($result_user_training) ; $i++) { 
        $training_id = $result_user_training[$i]["id"];
        $training_user_id = $result_user_training[$i]["userid"];
        $training_name = $result_user_training[$i]["trachName"];
        $training_category = $result_user_training[$i]["trachCategory"];
        $training_organizer = $result_user_training[$i]["trachOrganizer"];
        $training_detail = $result_user_training[$i]["trachDetail"];
        $training_start = $result_user_training[$i]["trachStart"];
        $training_end = $result_user_training[$i]["trachEnd"];
        $training_updated_at = $result_user_training[$i]["updated_at"];
        $training_created_at = $result_user_training[$i]["created_at"];

        $query_insert_user_training = "INSERT INTO `userTrainingAchievement` (
            `id`,
            `userid`,
            `trachName`,
            `trachCategory`,
            `trachOrganizer`,
            `trachDetail`,
            `trachStart`,
            `trachEnd`,
            `updated_at`,
            `created_at`
        ) VALUES (
            '$training_id',
            '$training_user_id',
            '$training_name',
            '$training_category',
            '$training_organizer',
            '$training_detail',
            '$training_start',
            '$training_end',
            '$training_updated_at',
            '$training_created_at'
        )";

        $exe_insert_user_training = $db_connect2->query($query_insert_user_training);

        // log_scheduler
        $query_log_schedule_user_training = "INSERT INTO `log_scheduler` (
            `table_id`,
            `initial_table`,
            `created_date`,
            `status`
        ) VALUES (
            '$training_id',
            'userTrainingAchievement',
            '$SFdatetime',
            '1'
        )";

        $exe_log_schedule_user_training = $db_connect1->query($query_log_schedule_user_training);
    }
    // echo json_encode([
    //     $result_emp_applicant[0],
    //     $result_comp_vacancy[0]
    // ]);