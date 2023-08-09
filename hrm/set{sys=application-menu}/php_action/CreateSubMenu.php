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
    $master_menu_id = $_POST['master_menu_id'];
    $input_menu = ucfirst($_POST['input_menu']);
    $input_hyperlink = $_POST['input_hyperlink'];
    $input_module_code = $_POST['input_module_code'];
    $input_module = $_POST['input_module'];
    $input_icon = $_POST['input_icon'];
    $input_active_status = $_POST['input_active_status'];
    $result_status = $input_active_status != null ? 1 : 0;

    $get_last_list_order = "SELECT max(order_id) as order_number FROM hrmmenu WHERE submenu_id = '$master_menu_id' order by order_id desc;";
    $result_order = mysqli_fetch_assoc(mysqli_query($connect, $get_last_list_order));
    $number_order = $result_order['order_number'] + 1;

    if ($_POST) {
        // set input data to database
        $query_create_data = "INSERT INTO `hrmmenu` (
            `submenu_id`,
            `ul_submenu_id`,
            `menu`,
            `hyperlink`,
            `order_id`,
            `module`,
            `module_code`,
            `is_active`,
            `iden`,
            `svg_icon`,
            `access_code`,
            `javascript`,
            `request_type`,
            `company_id`
        ) VALUES (
            '$master_menu_id',
            '0',
            '$input_menu',
            '$input_hyperlink',
            '$number_order',
            '$input_module',
            '$input_module_code',
            '$result_status',
            null,
            '$input_icon',
            null,
            null,
            null,
            '1'
        )";

        $exe_query_master = $connect->query($query_create_data);
        
        if ($exe_query_master == true) {
            http_response_code(200);
            $response['success'] = true;
            $response['code'] = "success_message";
            $response['messages'] = 'Sub menu successfully added';
        } else {
            http_response_code(400);
            $response['success'] = false;
            $response['code'] = "success_message";
            $response['messages'] = 'Sub menu failed to add';
        }
        
        $connect->close();
        header('Content-Type: application/json');
        echo json_encode($response);
    }
