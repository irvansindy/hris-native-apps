<?php 
$qListRender = "SELECT 
                a.*,
                c.Full_Name,
                DATE_FORMAT(a.requestdate, '%d %b %Y') as requestdate,
                DATE_FORMAT(a.requestenddate, '%d %b %Y') as requestenddate,
                DATE_FORMAT(b.startdate, '%d %b %Y') as c_startdate,
                DATE_FORMAT(b.enddate, '%d %b %Y') as c_enddate,
                d.name_en,
                f.destination_no,
                e.purpose_name_en
                FROM hrdondutyrequest a
                LEFT JOIN hrdondutyrequestdtl b ON a.request_no=b.request_no
                LEFT JOIN view_employee c ON a.requestfor=c.emp_id
                LEFT JOIN hrmstatus d on (SELECT request_status FROM hrmrequestapproval WHERE request_no = a.request_no ORDER BY `request_status` DESC limit 1)=d.code
                LEFT JOIN hrmondutypurposetype e on e.purpose_code=a.purpose_code
                LEFT JOIN 
                    (
                        SELECT
                        sub1.request_no,
                        MAX(sub1.destination_no) AS destination_no
                        FROM hrdondutyrequestdtl sub1
                    ) f ON a.request_no=f.request_no
                $where
                GROUP BY a.request_no
                ORDER BY a.created_date DESC";