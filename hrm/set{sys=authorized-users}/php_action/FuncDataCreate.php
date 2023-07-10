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

    if ($_POST) {
        // set variable
        $input_emp_no = $_POST['input_emp_no'];
        $input_user_menu_name = strtoupper($_POST['input_user_menu_name']);
        // $input_user_menu_name = $_POST['input_user_menu_name'];
        $input_description = $_POST['input_description'];
        $input_remark = $_POST['input_remark'];
        $menu_item = $_POST['data_menu_item'];
        $input_active_status = $_POST['input_active_status'];

        $result_menu = implode(',', $menu_item);
        $result_status = $input_active_status != null ? 1 : 0;
        
        $total_menu = count($menu_item);
        // print_r($total_menu);
        // set input data to database
        $query_insert_master_data = "INSERT INTO `users_menugroup_setting` (
            `users_menu_name`,
            `description`,
            `active_status`,
            `membership_formula`,
            `group_type`,
            `remark`,
            `created_by`,
            `created_date`,
            `modified_by`,
            `modified_date`
        ) VALUES (
            '$input_user_menu_name',
            '$input_description',
            '$result_status',
            '$result_menu',
            'FIXED',
            '$input_remark',
            '$input_emp_no',
            '$SFdatetime',
            '$input_emp_no',
            '$SFdatetime'
        )";

        $execute_query_master_data = $connect->query($query_insert_master_data);

        for ($i=0; $i < $total_menu; $i++) { 
            $query_detail = "INSERT INTO `users_menugroup_setting_detail` (
                `users_menu_name`,
                `menu_id`
            ) VALUES (
                '$input_user_menu_name',
                '$menu_item[$i]'
            )";

            $execute_query_detail = $connect->query($query_detail);
        }
        // for ($i=0; $i < $total_menu; $i++) { 
        //     $query_insert_menu = "INSERT INTO `users_menu_access` 
        //         (
        //             `emp_no`, 
        //             `formula`, 
        //             `is_acccessgroup_use`,
        //             `company_id`
        //         ) 
        //         VALUES 
        //             (
        //                 '$input_emp_no',
        //                 '$menu_item[$i]',
        //                 '',
        //                 '13576'
                        
        //             )";
            
        //     // $execute_query_menu = $connect->query($query_insert_menu);
        // }
        

        // if ($execute_query_master_data == true && $execute_query_menu == true) {
        // if ($execute_query_master_data == true) {
        if ($execute_query_master_data == true && $execute_query_detail == true) {
            http_response_code(200);
            $response['success'] = true;
            $response['code'] = "success_message";
            $response['messages'] = 'Authorized user successfully added';
        } else {
            http_response_code(400);
            $response['success'] = false;
            $response['code'] = "success_message";
            $response['messages'] = 'Authorized user failed to add';
        }

        $connect->close();
        header('Content-Type: application/json');
        echo json_encode($response);
    }