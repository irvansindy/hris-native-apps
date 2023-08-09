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

    // set variable
    $detail_sub_menu_id = $_POST['detail_sub_menu_id'];
    $detail_sub_menu = ucfirst($_POST['detail_sub_menu']);
    $detail_sub_hyperlink = $_POST['detail_sub_hyperlink'];
    $detail_sub_module_code = $_POST['detail_sub_module_code'];
    $detail_sub_module = $_POST['detail_sub_module'];
    $detail_sub_icon = $_POST['detail_sub_icon'];
    $detail_sub_active_status = $_POST['detail_sub_active_status'];
    $result_status = $detail_sub_active_status != null ? 1 : 0;

    if ($_POST) {
        $query_update = "UPDATE hrmmenu SET
            `menu` = '$detail_sub_menu',
            `hyperlink` = '$detail_sub_hyperlink',
            `module` = '$detail_sub_module',
            `module_code` = '$detail_sub_module_code',
            `is_active` = '$result_status',
            `svg_icon` = '$detail_sub_icon'
            WHERE `menu_id` = '$detail_sub_menu_id'
        ";

        $exe_query_update = $connect->query($query_update);

        if ($exe_query_update == true) {
            http_response_code(200);
            $response['success'] = true;
            $response['code'] = "success_message";
            $response['messages'] = 'Successfully update detail sub menu';
        } else {
            http_response_code(400);
            $response['success'] = false;
            $response['code'] = "success_message";
            $response['messages'] = 'Failed to update detail sub menu';
        }

        $connect->close();
        header('Content-Type: application/json');
        echo json_encode($response);
    }