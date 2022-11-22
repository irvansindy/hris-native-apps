<?php 
$qListRender = "SELECT 
                a.*,
                DATE_FORMAT(a.startdate, '%d %b %Y') as c_startdate,
                DATE_FORMAT(a.enddate, '%d %b %Y') as c_enddate,
                d.name_en
                FROM trnmrequest a
                LEFT JOIN trndrequest b ON a.request_no=b.request_no
                LEFT JOIN view_employee c ON b.emp_id=c.emp_id
                LEFT JOIN hrmstatus d on (SELECT request_status FROM hrmrequestapproval WHERE request_no = a.request_no ORDER BY `request_status` DESC limit 1)=d.code
                $where
                GROUP BY a.request_no
                ORDER BY a.created_date DESC";

$qListRenderMyTrining = "SELECT 
                a.*,
                b.emp_id,
                e.course_name,
                f.providertype,
                f.providername,
                CASE
                    WHEN g.final_result IN ('Passed','Failed') THEN g.final_result
                    ELSE 'Unverified'
                END AS fr,
                DATE_FORMAT(a.startdate, '%d %b %Y') as c_startdate,
                DATE_FORMAT(a.enddate, '%d %b %Y') as c_enddate,
                d.name_en
                FROM trnmrequest a
                LEFT JOIN trndrequest b ON a.request_no=b.request_no
                LEFT JOIN view_employee c ON b.emp_id=c.emp_id
                LEFT JOIN hrmstatus d on (SELECT request_status FROM hrmrequestapproval WHERE request_no = a.request_no ORDER BY `request_status` DESC limit 1)=d.code
                LEFT JOIN trncourse e on a.training_category=e.id_course
                LEFT JOIN trnprovider f on a.training_provider=f.provider_code
                LEFT JOIN trndanswer g ON a.request_no=g.request_no AND g.question_type = 'POSTTEST' AND b.emp_id=g.emp_id
                LEFT JOIN 
                        (
                            SELECT 
                                sub1.request_no,
                                MAX(sub1.request_status) as request_status
                            FROM hrmrequestapproval sub1 
                            GROUP BY sub1.request_no
                        ) h on a.request_no=h.request_no
                 
                WHERE b.emp_id = (SELECT emp_id FROM view_employee WHERE emp_no = '$username')
                AND h.request_status IN ('3')
                GROUP BY a.request_no
                ORDER BY a.created_date DESC";