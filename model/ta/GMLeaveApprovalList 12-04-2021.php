<?php 
$qListRender = "SELECT 
a.*,
            DATE_FORMAT(a.leave_startdate, '%d %b %Y') as leave_startdates,
            DATE_FORMAT(a.leave_enddate, '%d %b %Y') as leave_enddates,
            b.emp_no,
            b.full_name,
            d.name_en     
            FROM hrmleaverequest a
            LEFT JOIN view_employee b on a.emp_id=b.emp_id
            -- LEFT JOIN hrmrequest c on a.request_no=c.request_no

            LEFT JOIN hrmstatus d on (SELECT request_status FROM hrmrequestapproval WHERE request_no = a.request_no ORDER BY `request_status` DESC limit 1)=d.code

            LEFT JOIN hrmrequestapproval e on a.request_no=e.request_no
            LEFT JOIN hrmorgstruc f on f.pos_code=e.approval_list
            LEFT JOIN view_employee g on f.position_id=g.position_id

            $where

                        GROUP BY a.request_no

                        
            ORDER BY a.created_date DESC
           
            LIMIT $limit, $page
            
            
            ";

                ?>

