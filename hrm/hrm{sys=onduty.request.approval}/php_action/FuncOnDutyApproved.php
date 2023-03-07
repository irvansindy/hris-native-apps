<?php
    require_once '../../../application/config.php';
    !empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
    if ($getdata == 0) {
        include "../../../application/session/sessionlv2.php";
    } else {
        include "../../../application/session/mobile.session.php";
    }

    $response = [
        'success' => false,
        'messages' => []
    ];

    $empNoApprover = $_POST['sel_emp_no_approver'];
    $approvalRequestNo = $_POST['sel_approval_request_no'];

    // get position id milik user
    $getEmpDate = mysqli_fetch_array(mysqli_query($connect, "SELECT emp_id, position_id FROM view_employee WHERE emp_no = '$empNoApprover'"));
    $empPositionId = $getEmpDate['position_id'];

    // update data list approval
    $queryApprovalStatus = "UPDATE `hrmrequestapproval` SET
        `status` 		= '1',
		`_approval_time`	= '$SFdatetime'
            WHERE
		`request_no` 		= '$approvalRequestNo' AND
		`position_id`		= '$empNoApprover'";
    $exeApprovalStatus = $connect->query($queryApprovalStatus);

    // echo $queryApprovalStatus;

    // check total row approval
    $queryCheckApproval = mysqli_fetch_array(mysqli_query($connect,
        "SELECT 
            COUNT(*) AS total_approver, 
            (SELECT 
                COUNT(*) AS total_approver_without_acknowledge
                FROM hrmrequestapproval
                    WHERE 
                    request_no = '$approvalRequestNo' AND 
                    req IN ('Sequence','Required')) AS total_approver_without_acknowledge,
            (SELECT 
                SUM(STATUS) AS total_approver_without_acknowledge,
                FROM hrmrequestapproval
                    WHERE
                    request_no = '$approvalRequestNo' AND
                    req IN ('Sequence','Required')) AS total_without_acknowledge,
            SUM(status) AS total)
        FROM hrmrequestapproval
            WHERE 
            request_no = '$approvalRequestNo' AND
            req IN ('Notification','Sequence','Required')"
    ));

    // checking for full approval
    if ($queryCheckApproval['total_approver'] == $queryCheckApproval['total'] || $queryCheckApproval['total'] > $queryCheckApproval['total_approver'] || $queryCheckApproval['total_without_acknowledge'] == $queryCheckApproval['total_approver_without_acknowledge']) {
        
        $queryFullApproval = "UPDATE `hrmrequestapproval` SET
        `request_status` = '3'
            WHERE
        `request_no` = '$approvalRequestNo'";

        $exeFullApproval = $connect->query($queryFullApproval);

        // get data on duty list detail
        $getDetailOnDuty = "SELECT request_no, startdate AS starttime, enddate AS endtime, date_format(startdate, '%Y-%m-%d') AS startdate, date_format(enddate, '%Y-%m-%d') 
	AS enddate, date_format(startdate, '%H:%m:%s') AS starthour, date_format(enddate, '%H:%m:%s') AS endhour FROM hrdondutyrequestdtl WHERE request_no = '$request_no'";
        $exeDetailOnDuty = mysqli_query($connect, $getDetailOnDuty);
        $resultDetailOnDuty = mysqli_fetch_all($exeDetailOnDuty, MYSQLI_ASSOC);
        $countRow = mysqli_num_rows($exeDetailOnDuty);

        for ($index=0; $index <= $countRow; $index++) {
            $emp_id = $getEmpDate['emp_id'];
            $startTIme = $resultDetailOnDuty[$index]['starttime'];
            $endTime = $resultDetailOnDuty[$index]['endtime'];
            $startDate = $resultDetailOnDuty[$index]['startdate'];
            $queryUpdateAttendance = "UPDATE `hrdattendance` SET
                `starttime` = '$startTIme',
                `endtime` = '$endTime'

                WHERE `emp_id` = '$emp_id'
                AND date_format(`attend_date`, '%Y-%m-%d') = '$startDate'
            ";

            $isUpdate = $connect->query($queryUpdateAttendance);
            print_r($resultDetailOnDuty[0]['starttime']);
        }
        // echo $queryUpdateAttendance;

    // when partial approved
    } else {
        $queryPartialApproval = "UPDATE `hrmrequestapproval` SET
        `request_status` = 2
            WHERE
        `request_no` = '$approvalRequestNo'";

        $exeFullApproval = $connect->query($queryPartialApproval);
    }

    if ($exeApprovalStatus == TRUE && $exeFullApproval == TRUE || $isUpdate == TRUE) {
        $response['success'] = true;
        $response['code'] = "success_message";
        $response['messages'] = "Successfully approve request" ;
    } else {
        $response['success'] = false;
        $response['code'] = "failed_message";
        $response['messages'] = "Failed to approve request";
    }

    $connect->close();
    echo json_encode($response);