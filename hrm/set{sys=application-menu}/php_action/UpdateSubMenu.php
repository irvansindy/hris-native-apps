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
    $detail_menu_id = $_POST['detail_menu_id'];
    $detail_menu = ucfirst($_POST['detail_menu']);
    $detail_hyperlink = $_POST['detail_hyperlink'];
    $detail_module_code = $_POST['detail_module_code'];
    $detail_module = $_POST['detail_module'];
    $detail_icon = $_POST['detail_icon'];
    $detail_active_status = $_POST['detail_active_status'];
    $result_status = $detail_active_status != null ? 1 : 0;

    if ($_POST) {
        $query_update = "UPDATE hrmmenu SET
            `menu` = '$detail_menu',
            `hyperlink` = '$detail_hyperlink',
            `module` = '$detail_module',
            `module_code` = '$detail_module_code',
            `is_active` = '$result_status',
            `svg_icon` = '$detail_icon'
            WHERE `menu_id` = '$detail_menu_id'
        ";

        $exe_query_update = $connect->query($query_update);

        if ($exe_query_update == true) {
            http_response_code(200);
            $response['success'] = true;
            $response['code'] = "success_message";
            $response['messages'] = 'Successfully update sub menu';
        } else {
            http_response_code(400);
            $response['success'] = false;
            $response['code'] = "success_message";
            $response['messages'] = 'Failed to update sub menu';
        }

        $connect->close();
        header('Content-Type: application/json');
        echo json_encode($response);
    }