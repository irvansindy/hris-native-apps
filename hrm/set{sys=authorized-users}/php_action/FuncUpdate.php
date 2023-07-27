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

    // set time
    $SFdate = date("Y-m-d");
    $SFtime = date('h:i:s');
    $SFdatetime = date("Y-m-d H:i:s");
    $SFnumber = date("YmdHis");
    
    // detail_menu_item
    if ($_POST) {
        // set variable
        $detail_emp_no = $_POST['detail_emp_no'];
        $detail_user_menu_name = strtoupper($_POST['detail_user_menu_name']);
        $detail_description = $_POST['detail_description'];
        $detail_remark = $_POST['detail_remark'];
        $menu_item = $_POST['detail_menu_item'];
        $detail_active_status = $_POST['detail_active_status'];

        $result_menu = implode(',', $menu_item);
        $result_status = $input_active_status != null ? 1 : 0;
        
        $total_menu = count($menu_item);

        $query_update_master_data = "UPDATE users_menugroup_setting SET 
            -- `users_menu_name` = '$detail_user_menu_name',
            `description` = '$detail_description',
            `active_status` = '$detail_remark',
            `membership_formula` = '$result_menu',
            `group_type` = 'FIXED',
            `remark` = '$detail_remark',
            -- `created_by`,
            -- `created_date`,
            `modified_by` = '$detail_emp_no',
            `modified_date` = '$SFdatetime'
            WHERE `users_menu_name` = '$detail_user_menu_name'
        ";

        $exe_query_data = $connect->query($query_update_master_data);

        $query_delete = "DELETE FROM users_menugroup_setting_detail WHERE users_menu_name = '$detail_user_menu_name'";
        $execute_query_delete = $connect->query($query_delete);

        for ($i=0; $i < $total_menu; $i++) { 
            $query_update_detail_data = "INSERT INTO `users_menugroup_setting_detail` VALUES (
                '$detail_user_menu_name',
                '$menu_item[$i]'
            )";

            $execute_query_update = $connect->query($query_update_detail_data);
        }

        if ($exe_query_data == true && $execute_query_update == true) {
            http_response_code(200);
            $response['success'] = true;
            $response['code'] = "success_message";
            $response['messages'] = 'List Employee successfully updated';
        } else {
            http_response_code(400);
            $response['success'] = false;
            $response['code'] = "success_message";
            $response['messages'] = 'List Employee failed to update';
        }

        $connect->close();
        header('Content-Type: application/json');
        echo json_encode($response);
    }