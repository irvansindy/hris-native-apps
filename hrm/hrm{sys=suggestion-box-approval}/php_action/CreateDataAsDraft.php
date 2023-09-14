<?php
    error_reporting(0);
    date_default_timezone_set('Asia/Jakarta');
    require_once '../../../application/config.php';

    // directory file
    $directory_file = '../../../asset/request.file.attachment/';

    // allowed file types
    $allow_types = array('jpg', 'png', 'jpeg', 'svg');

    // response json
    $response = [
        'success' => false,
        'code' => [],
        'messages' => []
    ];

    // set data variable
    $request_number = 'SS'.date("YmdHis");
    $date_time = date("Y-m-d H:i:s");
    $input_suggestion_title = $_POST['input_suggestion_title'];
    $input_emp_no = $_POST['input_emp_no'];
    $input_problem_identification = $_POST['input_problem_identification'];
    $input_problem_background = $_POST['input_problem_background'];
    $input_target_specify = $_POST['input_target_specify'];

    $input_possible_direct_cause_Man = $_POST['input_possible_direct_cause_Man'];
    $input_possible_direct_cause_Machine = $_POST['input_possible_direct_cause_Machine'];
    $input_possible_direct_cause_Method = $_POST['input_possible_direct_cause_Method'];
    $input_possible_direct_cause_Material = $_POST['input_possible_direct_cause_Material'];
    $input_possible_direct_cause_Mother_Nature = $_POST['input_possible_direct_cause_Mother_Nature'];
    $input_possible_direct_cause_Measurement = $_POST['input_possible_direct_cause_Measurement'];
    
    $input_planing_root_cause = $_POST['input_planing_root_cause'];
    
    // send data to work formula
    $SFnumbercon = $request_number;
    $SFReqtype = 'EMPLOYEE.sugestionSystem';
    $inp_requestfor = $input_emp_no;
    $inp_emp_no = $input_emp_no;
    $input_status = $_POST['input_status'];

    if ($_POST) {
        if (!empty($_FILES['input_diagram'])) {
            $file_name = $_FILES['input_diagram']['name'];
            $file_upload = $_FILES['input_diagram']['tmp_name'];
            
            // get uploaded file's extension
            $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            // can upload same image using rand function
            $final_image = rand(1000,1000000).$file_name;

            if (in_array($ext, $allow_types)) {
                $final_file = $directory_file.strtolower($final_image);
        
                $info_file = getimagesize($file_upload);
            }
            // destination upload file
            $upload_data_file = move_uploaded_file($file_upload, $final_file);
        }

        $file_diagram_attachment = $final_file != '' ? $final_file : '';

        // query create data suggestion master
        $query_suggestion_master = "INSERT INTO `table_suggestion_master`(
            `request_no`,
            `suggestion_title`,
            `emp_no`,
            `problem_identification`,
            `problem_background`,
            `target_specify`,
            `diagram`,
            `date`,
            `created_at`,
            `created_by`,
            `updated_at`,
            `updated_by`
        ) VALUES (
            '$request_number',
            '$input_suggestion_title',
            '$input_emp_no',
            '$input_problem_identification',
            '$input_problem_background',
            '$input_target_specify',
            '$file_diagram_attachment',
            '$date_time',
            '$date_time',
            '$input_emp_no',
            '$date_time',
            '$input_emp_no'
        )";

        $exe_suggestion_master = $connect->query($query_suggestion_master);

        // query create data suggestion identify problem (root cause)
        // input_possible_direct_cause_Man
        if (count($input_possible_direct_cause_Man) > 0 && $input_possible_direct_cause_Man[0] != '') {
            for ($i=0; $i < count($input_possible_direct_cause_Man); $i++) { 
                $query_identify_cause_man = "INSERT INTO `table_suggestion_identify_problem_detail` (
                    `request_no`,
                    `suggestion_identify_problem_master_id`,
                    `possible_direct_cause`,
                    `created_at`,
                    `created_by`,
                    `updated_at`,
                    `updated_by`
                ) VALUES (
                    '$request_number',
                    1,
                    '$input_possible_direct_cause_Man[$i]',
                    '$date_time',
                    '$input_emp_no',
                    '$date_time',
                    '$input_emp_no'
                )";

                $exe_query_identify_cause_man = $connect->query($query_identify_cause_man);
            }
        }
        
        // input_possible_direct_cause_Machine
        if (count($input_possible_direct_cause_Machine) > 0 && $input_possible_direct_cause_Machine[0] != '') {
            for ($i=0; $i < count($input_possible_direct_cause_Machine); $i++) { 
                $query_identify_cause_machine = "INSERT INTO `table_suggestion_identify_problem_detail` (
                    `request_no`,
                    `suggestion_identify_problem_master_id`,
                    `possible_direct_cause`,
                    `created_at`,
                    `created_by`,
                    `updated_at`,
                    `updated_by`
                ) VALUES (
                    '$request_number',
                    2,
                    '$input_possible_direct_cause_Machine[$i]',
                    '$date_time',
                    '$input_emp_no',
                    '$date_time',
                    '$input_emp_no'
                )";

                $exe_identify_cause_machine = $connect->query($query_identify_cause_machine);
            }
        }
        
        // input_possible_direct_cause_Method
        if (count($input_possible_direct_cause_Method) > 0 && $input_possible_direct_cause_Method[0] != '') {
            for ($i=0; $i < count($input_possible_direct_cause_Method); $i++) { 
                $query_identify_cause_method = "INSERT INTO `table_suggestion_identify_problem_detail` (
                    `request_no`,
                    `suggestion_identify_problem_master_id`,
                    `possible_direct_cause`,
                    `created_at`,
                    `created_by`,
                    `updated_at`,
                    `updated_by`
                ) VALUES (
                    '$request_number',
                    3,
                    '$input_possible_direct_cause_Method[$i]',
                    '$date_time',
                    '$input_emp_no',
                    '$date_time',
                    '$input_emp_no'
                )";

                $exe_identify_cause_method = $connect->query($query_identify_cause_method);
            }
        }
        
        // input_possible_direct_cause_Material
        if (count($input_possible_direct_cause_Material) > 0 && $input_possible_direct_cause_Material[0] != '') {
            for ($i=0; $i < count($input_possible_direct_cause_Material); $i++) { 
                $query_identify_cause_material = "INSERT INTO `table_suggestion_identify_problem_detail` (
                    `request_no`,
                    `suggestion_identify_problem_master_id`,
                    `possible_direct_cause`,
                    `created_at`,
                    `created_by`,
                    `updated_at`,
                    `updated_by`
                ) VALUES (
                    '$request_number',
                    4,
                    '$input_possible_direct_cause_Material[$i]',
                    '$date_time',
                    '$input_emp_no',
                    '$date_time',
                    '$input_emp_no'
                )";

                $exe_identify_cause_material = $connect->query($query_identify_cause_material);
            }
        }
        
        // input_possible_direct_cause_Mother_Nature
        if (count($input_possible_direct_cause_Mother_Nature) > 0 && $input_possible_direct_cause_Mother_Nature[0] != '') {
            for ($i=0; $i < count($input_possible_direct_cause_Mother_Nature); $i++) { 
                $query_identify_cause_mother_nature = "INSERT INTO `table_suggestion_identify_problem_detail` (
                    `request_no`,
                    `suggestion_identify_problem_master_id`,
                    `possible_direct_cause`,
                    `created_at`,
                    `created_by`,
                    `updated_at`,
                    `updated_by`
                ) VALUES (
                    '$request_number',
                    5,
                    '$input_possible_direct_cause_Mother_Nature[$i]',
                    '$date_time',
                    '$input_emp_no',
                    '$date_time',
                    '$input_emp_no'
                )";

                $exe_identify_cause_mother_nature = $connect->query($query_identify_cause_mother_nature);
            }
        }
        
        // input_possible_direct_cause_Measurement
        if (count($input_possible_direct_cause_Measurement) > 0 && $input_possible_direct_cause_Measurement[0] != '') {
            for ($i=0; $i < count($input_possible_direct_cause_Measurement); $i++) { 
                $query_identify_cause_measurement = "INSERT INTO `table_suggestion_identify_problem_detail` (
                    `request_no`,
                    `suggestion_identify_problem_master_id`,
                    `possible_direct_cause`,
                    `created_at`,
                    `created_by`,
                    `updated_at`,
                    `updated_by`
                ) VALUES (
                    '$request_number',
                    6,
                    '$input_possible_direct_cause_Measurement[$i]',
                    '$date_time',
                    '$input_emp_no',
                    '$date_time',
                    '$input_emp_no'
                )";

                $exe_identify_cause_measurement = $connect->query($query_identify_cause_measurement);
            }
        }

        // input_planing_root_cause
        if (count($input_planing_root_cause) > 0 && $input_planing_root_cause[0] != '') {
            for ($i=0; $i < count($input_planing_root_cause) ; $i++) { 
                $lower_case_planing_root_cause = strtolower($input_planing_root_cause[$i]);
                $set_planing_root_cause = str_replace(' ', '_', $lower_case_planing_root_cause);
                $result_planing_root_cause = $set_planing_root_cause.'_'.$request_number;
                $query_planing_root_cause = "INSERT INTO `table_suggestion_improvement_planning`(
                    `id`,
                    `request_no`,
                    `root_cause`,
                    `created_at`,
                    `created_by`,
                    `updated_at`,
                    `updated_by`
                ) VALUES (
                    '$result_planing_root_cause',
                    '$request_number',
                    '$input_planing_root_cause[$i]',
                    '$date_time',
                    '$input_emp_no',
                    '$date_time',
                    '$input_emp_no'
                )";

                $exe_planing_root_cause = $connect->query($query_planing_root_cause);
            }
        }

        // fetch file work formula 
        $execute_approval = require_once '../../set{sys=system_function_authorization}/workflow_formula.php';

        // if ($exe_suggestion_master == FALSE || $exe_query_identify_cause_man == FALSE || $exe_identify_cause_machine == FALSE || $exe_identify_cause_method == FALSE || $exe_identify_cause_material == FALSE || $exe_identify_cause_mother_nature == FALSE || $exe_identify_cause_measurement == FALSE || $exe_planing_root_cause == FALSE) {
        if ($exe_suggestion_master == FALSE) {
            http_response_code(402);
            // rollback for error response
            mysqli_rollback($connect);
            $response['success'] = false;
            $response['code'] = "success_message";
            $response['messages'] = 'Suggestion failed to add';
        } else {
            http_response_code(200);
            $response['success'] = true;
            $response['code'] = "success_message";
            $response['messages'] = 'Suggestion successfully added';
        }

        $connect->close();
        header('Content-Type: application/json');
        echo json_encode($response);
    }