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

    $request_no = $_GET['request_no'];

    // table_suggestion_improvement_planning_step