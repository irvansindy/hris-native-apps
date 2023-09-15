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

    // set variable
    $date_time = date("Y-m-d H:i:s");
    $detail_request_no = $_POST['detail_request_no'];
    $detail_emp_no = $_POST['detail_emp_no'];
    $detail_suggestion_title = $_POST['detail_suggestion_title'];
    $detail_problem_identification = $_POST['detail_problem_identification'];
    $detail_problem_background = $_POST['detail_problem_background'];
    $detail_target_specify = $_POST['detail_target_specify'];
    $detail_possible_direct_cause_Man = $_POST['detail_possible_direct_cause_Man'];
    $detail_possible_direct_cause_Machine = $_POST['detail_possible_direct_cause_Machine'];
    $detail_possible_direct_cause_Method = $_POST['detail_possible_direct_cause_Method'];
    $detail_possible_direct_cause_Material = $_POST['detail_possible_direct_cause_Material'];
    $detail_possible_direct_cause_Mother_Nature = $_POST['detail_possible_direct_cause_Mother_Nature'];
    $detail_possible_direct_cause_Measurement = $_POST['detail_possible_direct_cause_Measurement'];
    $detail_planing_root_cause = $_POST['detail_planing_root_cause'];

    if ($_POST) {
        if (!empty($_FILES['detail_diagram'])) {
            $file_name = $_FILES['detail_diagram']['name'];
            $file_upload = $_FILES['detail_diagram']['tmp_name'];
            
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

        // update data master
        $query_update_suggestion_master = "UPDATE table_suggestion_master SET
            `suggestion_title` = '$detail_suggestion_title',
            `problem_identification` = '$detail_problem_identification',
            `problem_background` = '$detail_problem_background',
            `target_specify` = '$detail_target_specify',
            `diagram` = '$file_diagram_attachment',
            `updated_at` = '$date_time',
            `updated_by` = '$detail_emp_no'
            WHERE request_no = '$detail_request_no'";
        $exe_suggestion_master = $connect->query($query_update_suggestion_master);

        // update data direct root cause
        // delete initial data
        $query_delete_suggestion_identify_problem_detail = "DELETE FROM table_suggestion_identify_problem_detail WHERE request_no = '$detail_request_no'";
        $exe_delete_suggestion_identify_problem_detail = $connect->query($query_delete_suggestion_identify_problem_detail);
        
        // detail_possible_direct_cause_Man
        $total_detail_possible_direct_cause_Man = count($detail_possible_direct_cause_Man);
        if ($total_detail_possible_direct_cause_Man > 0 && $detail_possible_direct_cause_Man[0] != '') {
            for ($i=0; $i < $total_detail_possible_direct_cause_Man; $i++) { 
                $query_identify_cause_man = "INSERT INTO `table_suggestion_identify_problem_detail` (
                    `request_no`,
                    `suggestion_identify_problem_master_id`,
                    `possible_direct_cause`,
                    `created_at`,
                    `created_by`,
                    `updated_at`,
                    `updated_by`
                ) VALUES (
                    '$detail_request_no',
                    1,
                    '$detail_possible_direct_cause_Man[$i]',
                    '$date_time',
                    '$detail_emp_no',
                    '$date_time',
                    '$detail_emp_no'
                )";
    
                $exe_query_identify_cause_man = $connect->query($query_identify_cause_man);
            }
        }
        
        // detail_possible_direct_cause_Machine
        $total_detail_possible_direct_cause_Machine = count($detail_possible_direct_cause_Machine);
        if ($total_detail_possible_direct_cause_Machine > 0 && $detail_possible_direct_cause_Machine[0] != '') {
            for ($i=0; $i < $total_detail_possible_direct_cause_Machine; $i++) { 
                $query_identify_cause_Machine = "INSERT INTO `table_suggestion_identify_problem_detail` (
                    `request_no`,
                    `suggestion_identify_problem_master_id`,
                    `possible_direct_cause`,
                    `created_at`,
                    `created_by`,
                    `updated_at`,
                    `updated_by`
                ) VALUES (
                    '$detail_request_no',
                    2,
                    '$detail_possible_direct_cause_Machine[$i]',
                    '$date_time',
                    '$detail_emp_no',
                    '$date_time',
                    '$detail_emp_no'
                )";
    
                $exe_query_identify_cause_Machine = $connect->query($query_identify_cause_Machine);
            }
        }
        
        // detail_possible_direct_cause_Method
        $total_detail_possible_direct_cause_Method = count($detail_possible_direct_cause_Method);
        if ($total_detail_possible_direct_cause_Method > 0 && $detail_possible_direct_cause_Method[0] != '') {
            for ($i=0; $i < $total_detail_possible_direct_cause_Method; $i++) { 
                $query_identify_cause_Method = "INSERT INTO `table_suggestion_identify_problem_detail` (
                    `request_no`,
                    `suggestion_identify_problem_master_id`,
                    `possible_direct_cause`,
                    `created_at`,
                    `created_by`,
                    `updated_at`,
                    `updated_by`
                ) VALUES (
                    '$detail_request_no',
                    3,
                    '$detail_possible_direct_cause_Method[$i]',
                    '$date_time',
                    '$detail_emp_no',
                    '$date_time',
                    '$detail_emp_no'
                )";
    
                $exe_query_identify_cause_Method = $connect->query($query_identify_cause_Method);
            }
        }
        
        // detail_possible_direct_cause_Material
        $total_detail_possible_direct_cause_Material = count($detail_possible_direct_cause_Material);
        if ($total_detail_possible_direct_cause_Material > 0 && $detail_possible_direct_cause_Material[0] != '') {
            for ($i=0; $i < $total_detail_possible_direct_cause_Material; $i++) { 
                $query_identify_cause_Material = "INSERT INTO `table_suggestion_identify_problem_detail` (
                    `request_no`,
                    `suggestion_identify_problem_master_id`,
                    `possible_direct_cause`,
                    `created_at`,
                    `created_by`,
                    `updated_at`,
                    `updated_by`
                ) VALUES (
                    '$detail_request_no',
                    4,
                    '$detail_possible_direct_cause_Material[$i]',
                    '$date_time',
                    '$detail_emp_no',
                    '$date_time',
                    '$detail_emp_no'
                )";
    
                $exe_query_identify_cause_Material = $connect->query($query_identify_cause_Material);
            }
        }
        
        // detail_possible_direct_cause_Mother_Nature
        $total_detail_possible_direct_cause_Mother_Nature = count($detail_possible_direct_cause_Mother_Nature);
        if ($total_detail_possible_direct_cause_Mother_Nature > 0 && $detail_possible_direct_cause_Mother_Nature[0] != '') {
            for ($i=0; $i < $total_detail_possible_direct_cause_Mother_Nature; $i++) { 
                $query_identify_cause_Mother_Nature = "INSERT INTO `table_suggestion_identify_problem_detail` (
                    `request_no`,
                    `suggestion_identify_problem_master_id`,
                    `possible_direct_cause`,
                    `created_at`,
                    `created_by`,
                    `updated_at`,
                    `updated_by`
                ) VALUES (
                    '$detail_request_no',
                    5,
                    '$detail_possible_direct_cause_Mother_Nature[$i]',
                    '$date_time',
                    '$detail_emp_no',
                    '$date_time',
                    '$detail_emp_no'
                )";
    
                $exe_query_identify_cause_Mother_Nature = $connect->query($query_identify_cause_Mother_Nature);
            }
        }
        
        // detail_possible_direct_cause_Measurement
        $total_detail_possible_direct_cause_Measurement = count($detail_possible_direct_cause_Measurement);
        if ($total_detail_possible_direct_cause_Measurement > 0 && $detail_possible_direct_cause_Measurement[0] != '') {
            for ($i=0; $i < $total_detail_possible_direct_cause_Measurement; $i++) { 
                $query_identify_cause_Measurement = "INSERT INTO `table_suggestion_identify_problem_detail` (
                    `request_no`,
                    `suggestion_identify_problem_master_id`,
                    `possible_direct_cause`,
                    `created_at`,
                    `created_by`,
                    `updated_at`,
                    `updated_by`
                ) VALUES (
                    '$detail_request_no',
                    6,
                    '$detail_possible_direct_cause_Measurement[$i]',
                    '$date_time',
                    '$detail_emp_no',
                    '$date_time',
                    '$detail_emp_no'
                )";
    
                $exe_query_identify_cause_Measurement = $connect->query($query_identify_cause_Measurement);
            }
        }

        // update suggestion planing
        // delete initial data
        $query_delete_suggestion_planing_root_cause = "DELETE FROM table_suggestion_improvement_planning WHERE request_no = '$detail_request_no'";
        $exe_query_delete_suggestion_planing_root_cause = $connect->query($query_delete_suggestion_planing_root_cause);

        if (count($detail_planing_root_cause) > 0 && $detail_planing_root_cause[0] != '') {
            for ($i=0; $i < count($detail_planing_root_cause) ; $i++) { 
                $lower_case_planing_root_cause = strtolower($detail_planing_root_cause[$i]);
                $set_planing_root_cause = str_replace(' ', '_', $lower_case_planing_root_cause);
                $result_planing_root_cause = $set_planing_root_cause.'_'.$detail_request_no;
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
                    '$detail_request_no',
                    '$detail_planing_root_cause[$i]',
                    '$date_time',
                    '$detail_emp_no',
                    '$date_time',
                    '$detail_emp_no'
                )";

                $exe_planing_root_cause = $connect->query($query_planing_root_cause);
            }
        }

        // if ($exe_suggestion_master == FALSE || $exe_query_identify_cause_man == FALSE || $exe_identify_cause_machine == FALSE || $exe_identify_cause_method == FALSE || $exe_identify_cause_material == FALSE || $exe_identify_cause_mother_nature == FALSE || $exe_identify_cause_measurement == FALSE || $exe_planing_root_cause == FALSE) {
        if ($exe_suggestion_master == FALSE) {
            http_response_code(402);
            // rollback for error response
            mysqli_rollback($connect);
            $response['success'] = false;
            $response['code'] = "success_message";
            $response['messages'] = 'Suggestion failed to update';
        } else {
            http_response_code(200);
            $response['success'] = true;
            $response['code'] = "success_message";
            $response['messages'] = 'Suggestion successfully updated';
        }

        $connect->close();
        header('Content-Type: application/json');
        echo json_encode($response);

    }