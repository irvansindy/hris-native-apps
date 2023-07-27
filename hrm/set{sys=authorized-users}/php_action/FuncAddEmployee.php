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
        $add_users_menu_name = $_POST['add_users_menu_name'];
        $list_employee = $_POST['list_employee'];

        $query_delete = "DELETE FROM users_menugroup_setting_employee WHERE users_menu_name = '$add_users_menu_name'";
        $execute_query_delete = $connect->query($query_delete);

        for ($i=0; $i < count($list_employee); $i++) { 
            $query_create_data = "INSERT INTO `users_menugroup_setting_employee` VALUES (
                '$add_users_menu_name',
                '$list_employee[$i]'
            )";

            $execute_query_create = $connect->query($query_create_data);
        }

        if ($execute_query_create == true) {
            http_response_code(200);
            $response['success'] = true;
            $response['code'] = "success_message";
            $response['messages'] = 'List Employee successfully added';
        } else {
            http_response_code(400);
            $response['success'] = false;
            $response['code'] = "success_message";
            $response['messages'] = 'List Employee failed to add';
        }

        $connect->close();
        header('Content-Type: application/json');
        echo json_encode($response);
    }