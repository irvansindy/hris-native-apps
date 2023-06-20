<?php
    $query_get_attendance_correct = "SELECT 
    a.*,
    c.Full_Name,
    DATE_FORMAT(a.requestdate, '%d %b %Y') as requestdate,
    DATE_FORMAT(a.startdate, '%d %b %Y') as startdate,
    DATE_FORMAT(a.enddate, '%d %b %Y') as enddate,
    d.name_en
    FROM hrmattcorrection a
    LEFT JOIN hrdattcorrection b ON a.request_no=b.request_no
    LEFT JOIN view_employee c ON a.emp_id=c.emp_id
    LEFT JOIN hrmstatus d on (SELECT request_status FROM hrmrequestapproval
    WHERE request_no = a.request_no ORDER BY `request_status` DESC limit 1)=d.code
    WHERE c.emp_no='$username' OR a.created_by='$username'
    GROUP BY a.request_no
    ORDER BY a.created_date DESC";