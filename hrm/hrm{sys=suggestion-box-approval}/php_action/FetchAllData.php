<?php
    error_reporting(0);
    date_default_timezone_set('Asia/Jakarta');
	include "../../../application/session/sessionlv2.php";
	require_once '../../../application/config.php';
    
    $query_fetch_data = "SELECT
    a.request_no,
    a.suggestion_title,
    a.emp_no,
    DATE_FORMAT(a.date, '%d %b %Y') as requestdate,
    b.Full_Name,
    stat.name_my,
    stat.status
    FROM table_suggestion_master a
    JOIN view_employee b on a.emp_no = b.emp_no
    LEFT JOIN (
			SELECT
				c.status,
				c.request_no as no_approval,
				d.req,
				e.name_my
				FROM (
					SELECT MAX(f.request_status) status, f.request_no
					FROM hrmrequestapproval f
					GROUP BY f.request_no
				) c
			INNER JOIN hrmrequestapproval d ON d.request_no = c.request_no
			AND d.request_status = c.status
			LEFT JOIN hrmstatus e ON c.status = e.code
    ) stat ON stat.no_approval=a.request_no
    LEFT JOIN view_employee e ON e.emp_no = '$username'
    INNER JOIN hrmrequestapproval f ON f.request_no = a.request_no
        AND f.position_id = e.position_id
        WHERE (e.emp_no = '$username') AND stat.status IN ('1','2','3','5','10')
		GROUP BY a.request_no
		ORDER BY stat.name_my DESC, a.request_no DESC";
    
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
        $preview = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#UpdateForm" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer"> <input type="image" src="../../asset/dist/img/glasses.png" title="Preview Request"></a>';

        // for status
        $status = '<span class="badge '.$activebadge.'">'.$result_fetch_data[$i]['name_my'].'</span>';

        // for approval
        $detail_approval = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#detail_data_suggestion_approval" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" id="detail_suggestion_approval" data-request_no="'.$result_fetch_data[$i]['request_no'].'"> <input type="image" src="../../asset/dist/img/icons/icon-addinfo.png" title="Detail Approval" width="22px"/></a>';

        $response['data'][] = [
            $number,
            // $link_request,
            $result_fetch_data[$i]['request_no'],
            $result_fetch_data[$i]['suggestion_title'],
            $result_fetch_data[$i]['Full_Name'],
            $result_fetch_data[$i]['requestdate'],
            $status,
            $preview,
            $detail_approval
        ];
        $number++;
    }

    $connect->close();
    header('Content-Type: application/json');
    echo json_encode($response);
    // echo json_encode($response['data'][0][1]);