<?php
    error_reporting(0);
    date_default_timezone_set('Asia/Jakarta');
	require_once '../../../application/config.php';
    !empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
    if ($getdata == 0) {
        include "../../../application/session/sessionlv2.php";
    } else {
        include "../../../application/session/mobile.session.php";
    }

    // response json
    $response = [
        'success' => false,
        'code' => [],
        'messages' => []
    ];
    // set data
    $date_time = date("Y-m-d H:i:s");
    $request_no_suggestion_approval = $_POST['request_no_suggestion_approval'];
    $input_remark_approval = $_POST['input_remark_approval'];
    $rating_value = $_POST['input_data_rating'];

    if ($_POST) {
        // approve data
        $query_approve = "UPDATE `hrmrequestapproval` SET
		-- `status` 		= '3',
		`request_status` 		= '3',
		`_approval_time`	= '$date_time'
		WHERE `request_no` = '$request_no_suggestion_approval'";

        $exe_query_approve = $connect->query($query_approve);

        // rating 
        $query_rating = "INSERT INTO `table_suggestion_score` (
            `suggestion_master_id`,
            `score`,
            `remark`,
            `created_at`,
            `created_by`,
            `updated_at`,
            `updated_by`
        ) VALUES (
            '$request_no_suggestion_approval',
            '$rating_value',
            '$input_remark_approval',
            '$date_time',
            '$input_emp_no',
            '$date_time',
            '$input_emp_no'
        )";
        $exe_query_rating = $connect->query($query_rating);

        if ($exe_query_approve == FALSE || $exe_query_rating == FALSE) {
            http_response_code(402);
            // rollback when response error
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