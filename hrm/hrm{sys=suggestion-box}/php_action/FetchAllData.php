<?php
    error_reporting(0);
    date_default_timezone_set('Asia/Jakarta');
	include "../../../application/session/sessionlv2.php";
	require_once '../../../application/config.php';
    
    $query_fetch_data = "SELECT 
            a.request_no,
            a.suggestion_title,
            a.date,
            DATE_FORMAT(a.date, '%d %b %Y') as requestdate,
            a.emp_no,
            c.Full_Name,
            d.name_my
        FROM table_suggestion_master a
        LEFT JOIN view_employee c ON a.emp_no=c.emp_no
        LEFT JOIN hrmstatus d on 
        (SELECT request_status FROM hrmrequestapproval
        WHERE request_no = a.request_no ORDER BY `request_status` DESC limit 1)=d.code
    WHERE a.emp_no='$username'";
    
    $response = [
        'data' => []
    ];

    $exe_query_fetch = mysqli_query($connect, $query_fetch_data);

    $result_fetch_data = mysqli_fetch_all($exe_query_fetch, MYSQL_ASSOC);
    
    $number = 1;

    for ($i=0; $i < count($result_fetch_data); $i++) {
        $activebadge = '';
        if($result_fetch_data[$i]['name_my'] == "Draft") {
            $activebadge = "badge-Draft";
        } elseif($result_fetch_data[$i]['name_my'] == "Unverified") {
            $activebadge = "badge-Unverified";  
        } elseif($result_fetch_data[$i]['name_my'] == "Partially Approved") {
            $activebadge = "badge-Partially-Approved"; 
        } elseif($result_fetch_data[$i]['name_my'] == "Fully Approved") {
            $activebadge = "badge-Fully-Approved";
        } elseif($result_fetch_data[$i]['name_my'] == "Revised") {
            $activebadge = "badge-Revised";
        } elseif($result_fetch_data[$i]['name_my'] == "Rejected") {
            $activebadge = "badge-Rejected"; 
        } elseif($result_fetch_data[$i]['name_my'] == "Cancelled") {
            $activebadge = "badge-Cancelled";                
        } else {
            $activebadge = "badge-Closed";
        }
        // for request number
        $link_request = '<a type="button" href="" nowrap="nowrap" data-toggle="modal" data-target="#detail_data_suggestion" data-backdrop="static" data-request_no="'.$result_fetch_data[$i]['request_no'].'" id="get_detail_suggestion">'.$result_fetch_data[$i]['request_no'].'</a>';

        // for preview
        $preview = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#UpdateForm" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer"> <input type="image" src="../../asset/dist/img/glasses.png" title="Preview"></a>';

        // for status
        $status = '<span class="badge '.$activebadge.'">'.$result_fetch_data[$i]['name_my'].'</span>';

        // for approval
        $add_suggestion_planing_step = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#create_suggestion_planing_step" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" id="add_suggestion_planing_step" data-request_no="'.$result_fetch_data[$i]['request_no'].'"> <input type="image" src="../../asset/dist/img/icons/icon-addinfo.png" title="Detail Approval" width="22px"/></a>';

        // for action
        $result_fetch_data[$i]['name_my'] == "Draft" ? $action = $preview.'<span class="text-center mr-2"></span>'.$add_suggestion_planing_step : $action = $preview;

        $response['data'][] = [
            $number,
            $link_request,
            $result_fetch_data[$i]['suggestion_title'],
            $result_fetch_data[$i]['requestdate'],
            $status,
            $action
        ];
        $number++;
    }

    $connect->close();
    header('Content-Type: application/json');
    echo json_encode($response);
    // echo json_encode($response['data'][0][1]);