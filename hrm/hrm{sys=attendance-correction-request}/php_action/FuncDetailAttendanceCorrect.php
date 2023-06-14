<?php
    require_once '../../../application/config.php';

    $request_no = $_GET['request_no'];

    // get data master attendance correction
    $query_get_data_master = "SELECT
        a.request_no,
        a.emp_id,
        DATE_FORMAT(a.requestdate, '%d %b %Y') as requestdate,
        -- DATE_FORMAT(a.requestenddate, '%d %b %Y') as requestenddate,
        a.reason,
        b.Full_Name,
        b.emp_no
        FROM hrmattcorrection a LEFT JOIN view_employee b ON a.emp_id = b.emp_id 
        WHERE a.request_no = '$request_no'";

    $result_data_master = mysqli_fetch_assoc(mysqli_query($connect, $query_get_data_master));

    // get data detail approval attendance correction
    $query_get_list_approval = "SELECT 
        a.position_id,
        a.req,
        b.emp_no,
        b.Full_Name,
        c.name_id as status_approve,
        CASE 
            WHEN a.`status` = '1' THEN 'Has been approved'
            ELSE 'Waiting'
            END AS req_status 
        FROM hrmrequestapproval a
        INNER JOIN view_employee b ON a.position_id=b.position_id AND (b.end_date IS NULL OR b.end_date = '0000-00-00 00:00:00')
        INNER JOIN hrmstatus c ON a.request_status=c.code
        AND a.request_no = '$request_no' AND a.req = 'Notification'

        UNION ALL

        SELECT 
        a.position_id,
        a.req,
        b.emp_no,
        b.Full_Name,
        c.name_id as status_approve,

        CASE 
            WHEN a.`status` = '1' THEN 'Has been approved'
            ELSE 'Waiting'
            END AS req_status 
        FROM hrmrequestapproval a
        INNER JOIN view_employee b ON a.position_id=b.position_id AND (b.end_date IS NULL OR b.end_date = '0000-00-00 00:00:00')
        INNER JOIN hrmstatus c ON a.request_status=c.code
        AND a.request_no = '$request_no' AND a.req = 'Sequence'

        UNION ALL

        SELECT 
        a.position_id,
        a.req,
        b.emp_no,
        b.Full_Name,
        c.name_id as status_approve,
        
        CASE 
            WHEN a.`status` = '1' THEN 'Has been approved'
            ELSE 'Waiting'
            END AS req_status 
        FROM hrmrequestapproval a
        INNER JOIN view_employee b ON a.position_id=b.position_id AND (b.end_date IS NULL OR b.end_date = '0000-00-00 00:00:00')
        INNER JOIN hrmstatus c ON a.request_status=c.code
    AND a.request_no = 'ATR20230613190517' AND a.req = 'Required'";

    $result_data_approval = mysqli_fetch_all(mysqli_query($connect, $query_get_list_approval), MYSQLI_ASSOC);

    // get data status approval
    $query_get_status = "SELECT MAX(request_status) AS status_request FROM hrmrequestapproval WHERE request_no = '$request_no'";

    $result_data_status = mysqli_fetch_assoc(mysqli_query($connect, $query_get_status));

    $return_json = [
        $result_data_master, //0
        $result_data_approval, //1
        $result_data_status, //2
    ];

    $connect->close();
    header('Content-Type: application/json');
	echo json_encode($return_json);