<?php
	require_once '../../../application/config.php';
	!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
	if ($getdata == 0) {
		include "../../../application/session/sessionlv2.php";
	} else {
		include "../../../application/session/mobile.session.php";
	}

    if ($_POST) {
        $response = [
            'success' => false,
            'messages' => []
        ];

        $data_employee_no = $_POST['data_employee_no'];
        $data_approval_request_no = $_POST['data_approval_request_no'];

        $getDataEmployee = mysqli_fetch_array(mysqli_query($connect, "SELECT emp_id, position_id FROM view_employee WHERE emp_no = '$data_employee_no'"));
        $dataEmpId = $getDataEmployee['emp_id'];
        $dataPositionId = $getDataEmployee['position_id'];

        $queryUpdateApproval = "UPDATE `hrmrequestapproval` SET
            `status` 		= '1',
            `_approval_time`	= '$SFdatetime'
            WHERE
            `request_no` 		= '$data_approval_request_no' AND
            `position_id`		= '$dataPositionId'";

        $exeQueryUpdateApproval = $connect->query($queryUpdateApproval);

        $get_any_request = mysqli_fetch_array(mysqli_query($connect, "SELECT
            COUNT(*) as total_approver,
            (SELECT 
                COUNT(*) AS total_approver_without_acknowledge
                FROM hrmrequestapproval
                    WHERE
                    request_no = '$data_approval_request_no' AND
                    req IN ('Sequence','Required')) AS total_approver_without_acknowledge,
            (SELECT 
                SUM(STATUS) AS total_approver_without_acknowledge
                FROM hrmrequestapproval
                    WHERE
                    request_no = '$data_approval_request_no' AND
                    req IN ('Sequence','Required')) AS total_without_acknowledge,
            SUM(STATUS) AS total
            FROM hrmrequestapproval
            WHERE
                request_no = '$data_approval_request_no' AND
                req IN ('Notification','Sequence','Required')"));

        if($get_any_request['total_approver'] == $get_any_request['total'] || $get_any_request['total'] > $get_any_request['total_approver'] || $get_any_request['total_without_acknowledge'] == $get_any_request['total_approver_without_acknowledge']) {
            $queryUpdateStatusApproval = "UPDATE `hrmrequestapproval` SET
                `request_status` 	= '3'
                WHERE
                `request_no` 		= '$data_approval_request_no'";
            $exeQueryUpdateStatusApproval = $connect->query($queryUpdateStatusApproval);
        } else {
            $queryUpdateStatusApproval = "UPDATE `hrmrequestapproval` SET
                `request_status` 	= '2'
                WHERE
                `request_no` 		= '$data_approval_request_no'";
            $exeQueryUpdateStatusApproval = $connect->query($queryUpdateStatusApproval);
        }

        // if ($exeQueryUpdateApproval == true && $exeQueryUpdateStatusApproval == true) {
        if ($exeQueryUpdateApproval == true) {
            http_response_code(200);
            $response['success'] = true;
            $response['code'] = "success_message";
            $response['messages'] = "Successfully approve request";
        } else {
            http_response_code(400);
            $response['success'] = false;
            $response['code'] = "success_message";
            $response['messages'] = "Failed to approve the request";
        }

        $connect->close();
        header('Content-Type: application/json');
        echo json_encode($response);

    }