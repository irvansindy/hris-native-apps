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
        $menu_item = $_POST['menu_item'];

        $result_menu = implode(',', $menu_item);

        // var_dump([

        // ]);

        // die();
        // set input data to database
        $query_insert_data = "INSERT INTO `users_menugroup_setting` (
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
            '1',
            '$result_menu',
            'FIXED',
            '$input_remark',
            '$input_emp_no',
            '$SFdatetime',
            '$input_emp_no',
            '$SFdatetime'
        )";

        $execute_query = $connect->query($query_insert_data);

        if ($execute_query == true) {
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