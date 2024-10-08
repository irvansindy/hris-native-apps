<?php 
$qListRender = "SELECT 
                a.*,
                            DATE_FORMAT(a.requestdate, '%d %b %Y') as leave_startdates,
                b.emp_no,
                d.name_en,
                            h.Full_name
                FROM hrmleavecancelrequest a
                LEFT JOIN teodempcompany b on a.requestfor=b.emp_id
                LEFT JOIN hrmstatus d on (SELECT request_status FROM hrmrequestapproval WHERE request_no = a.request_no ORDER BY `request_status` DESC limit 1)=d.code
                            LEFT JOIN hrmrequestapproval e on a.request_no=e.request_no
                            LEFT JOIN hrmorgstruc f on f.pos_code=e.approval_list
                            LEFT JOIN teodempcompany g on f.position_id=g.position_id
                            LEFT JOIN view_employee h on a.requestfor=h.emp_id
                            $where
                            GROUP BY a.request_no
                ORDER BY a.created_date DESC
                LIMIT $limit, $page";

$qListRenderSrvSide = "SELECT 
                a.*,
                            DATE_FORMAT(a.requestdate, '%d %b %Y') as leave_startdates,
                b.emp_no,
                d.name_en,
                            h.Full_name
                FROM hrmleavecancelrequest a
                LEFT JOIN teodempcompany b on a.requestfor=b.emp_id
                LEFT JOIN hrmstatus d on (SELECT request_status FROM hrmrequestapproval WHERE request_no = a.request_no ORDER BY `request_status` DESC limit 1)=d.code
                            LEFT JOIN hrmrequestapproval e on a.request_no=e.request_no
                            LEFT JOIN hrmorgstruc f on f.pos_code=e.approval_list
                            LEFT JOIN teodempcompany g on f.position_id=g.position_id
                            LEFT JOIN view_employee h on a.requestfor=h.emp_id
                            $where_srv
                            GROUP BY a.request_no
                ORDER BY a.created_date DESC";
?>