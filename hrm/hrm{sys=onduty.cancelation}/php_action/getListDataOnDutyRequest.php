<?php
    error_reporting(0);
    date_default_timezone_set('Asia/Jakarta');
    require_once '../../../application/config.php';
    
    // setup variable
    $emp_no = $_GET['empno'];
    $emp_id_for = $_GET['emp_id_for'];
    $inp_startdate = $_GET['inp_startdate'];
    $inp_enddate = $_GET['inp_enddate'];
    $input_onduty_request = $_GET['input_onduty_request'];

    // get employee id
    $getUser = "SELECT emp_id FROM view_employee WHERE emp_no = '$emp_no'";
    $resultGetUser = mysqli_fetch_assoc(mysqli_query($connect, $getUser));
    $emp_id = $resultGetUser['emp_id'];
    
    // where condition
    $where = '';
    // form emp_id, request_no, start and end date filled
    if (!empty($input_onduty_request) && !empty($emp_id_for) && !empty($inp_startdate) && !empty($inp_enddate)) {
        $where = "WHERE a.request_no = '$input_onduty_request' AND b.emp_id = '$emp_id_for' AND DATE_FORMAT(a.requestdate, '%Y-%m-%d') BETWEEN '$inp_startdate' AND '$inp_enddate' AND (d.code IN ('3'))";
    }
    // form emp_id and request no filled
    if (!empty($input_onduty_request) && !empty($emp_id_for)) {
        $where = "WHERE a.request_no = '$input_onduty_request' AND b.emp_id = '$emp_id_for' AND (d.code IN ('3'))";
    }
    // form emp_id, start and end date filled
    elseif (!empty($emp_id_for) && !empty($inp_startdate) && !empty($inp_enddate)) { 
        $where = "WHERE b.emp_id = '$emp_id_for' AND DATE_FORMAT(a.requestdate, '%Y-%m-%d') BETWEEN '$inp_startdate' AND '$inp_enddate' AND (d.code IN ('3'))";
    }
    // form emp_id and start date filled
    elseif (!empty($emp_id_for) && !empty($inp_startdate)) {
    $where = "WHERE b.emp_id = '$emp_id_for' AND DATE_FORMAT(a.requestdate, '%Y-%m-%d') = '$inp_startdate' AND (d.code IN ('3'))";
    }
    // form emp_id and end date filled
    elseif (!empty($emp_id_for) && !empty($inp_enddate)) { 
        $where = "WHERE b.emp_id = '$emp_id_for' AND DATE_FORMAT(a.requestdate, '%Y-%m-%d') = '$inp_enddate' AND (d.code IN ('3'))";
    }
    // form emp_id filled
    elseif (!empty($emp_id_for)) {
        $where = "WHERE b.emp_id = '$emp_id_for' AND (d.code IN ('3'))";
    }
    // form request no filled
    elseif (!empty($input_onduty_request)) {
        $where = "WHERE a.request_no = '$input_onduty_request' AND (d.code IN ('3'))";
    }
    // form start and end date filled
    elseif (!empty($inp_startdate) && !empty($inp_enddate)) {
        $where = "WHERE b.emp_id = '$emp_id' AND DATE_FORMAT(a.requestdate, '%Y-%m-%d') BETWEEN '$inp_startdate' AND '$inp_enddate' AND (d.code IN ('3'))";
    }
    // form start date filled
    elseif (!empty($inp_startdate)) {
        $where = "WHERE b.emp_id = '$emp_id' AND DATE_FORMAT(a.requestdate, '%Y-%m-%d') = '$inp_startdate' AND (d.code IN ('3'))";
    }
    // form end date filled
    elseif (!empty($inp_enddate)) {
        $where = "WHERE b.emp_id = '$emp_id' AND DATE_FORMAT(a.requestdate, '%Y-%m-%d') = '$inp_enddate' AND (d.code IN ('3'))";
    }
    // all form empty
    elseif (empty($input_onduty_request) && empty($emp_id_for) && empty($inp_startdate) && empty($inp_enddate)) {
        $where = "WHERE b.emp_id = '$emp_id'
        AND (d.code IN ('3'))";
    }

    // get data onduty request
    $queryGetDataOnDuty = "SELECT
        a.request_no,
        b.emp_no,
        b.emp_id,
        b.Full_Name,
        c.purpose_name_en,
        d.name_en,
        a.requestdate,
        a.requestenddate
    FROM hrdondutyrequest a
    LEFT JOIN view_employee b ON a.requestfor=b.emp_id
    INNER JOIN hrmondutypurposetype c ON a.purpose_code = c.purpose_code
    LEFT JOIN hrmstatus d ON (SELECT request_status FROM hrmrequestapproval 
        WHERE request_no = a.request_no ORDER BY `request_status` DESC limit 1) = d.code
    $where
    GROUP BY request_no";
    $resultGetDataOnDuty = mysqli_fetch_all(mysqli_query($connect, $queryGetDataOnDuty), MYSQLI_ASSOC);

    if($resultGetDataOnDuty == true) {
        http_response_code(200);
        $resultJson = [
            'messages' => 'Success to get all data',
            'data' => $resultGetDataOnDuty,
            'requestby' => $emp_id
        ];
    } else {
        http_response_code(400);
        $resultJson = [
            'messages' => 'Failed to get all data',
            'data' => NULL
        ];
    }

    $connect->close();
    header('Content-Type: application/json');
	echo json_encode($resultJson);