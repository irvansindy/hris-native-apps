<?php
$qListRender = "SELECT 
                a.*,
                b.status,
                DATE_FORMAT(a.start_date, '%d %b %Y') as join_date

                FROM view_employee a
                LEFT JOIN teodempcompany b on a.emp_id=b.emp_id


                $where 

                ORDER BY a.Full_name asc

                LIMIT $limit, $page";


$qListRender_pemutakhiran = "SELECT 
                a.*,
                b.status,
                DATE_FORMAT(a.start_date, '%d %b %Y') as join_date

                FROM view_employee a
                LEFT JOIN teodempcompany b on a.emp_id=b.emp_id


                WHERE a.emp_no = '$username'

                ORDER BY a.Full_name asc

                LIMIT $limit, $page";

$qListRender_second = "SELECT 
                a.emp_no,
                a.full_name,
                a.worklocation_code,
                CASE 
					 	WHEN c.emp_id IS NULL THEN ''
					 	WHEN c.emp_id IS NOT NULL THEN 'selected'
					END AS selected

                FROM view_employee a
                LEFT JOIN teodempcompany b on a.emp_id=b.emp_id
                LEFT JOIN hrdvalleave c on a.emp_no=c.emp_id

                $where 

                ORDER BY a.worklocation_code asc
";


$qListRender_srvside = "SELECT 
                        a.*,
                        b.*,
                        CASE 
                            WHEN b.user_status = '1' THEN 'tick.png'
                            ELSE 'inactive.png'
                        END AS user_status,
                        (SELECT 'selected' FROM trndrequest x1 WHERE x1.request_no='$rfid' AND x1.active_status = '1' AND a.emp_id=x1.emp_id) as selected,
                        CASE
                            WHEN (a.end_date = '0000-00-00 00:00:00' OR a.end_date IS NULL) THEN 'tick.png'
                            ELSE 'inactive.png'
                        END AS employment_status,
                        d.company_name,
                        c.worklocation_name,
                        substring(a.cost_code, 1, 3) as cost_codex,
                        DATE_FORMAT(a.start_date, '%d %b %Y') as join_date,
                        DATE_FORMAT(a.end_date, '%d %b %Y') as end_date,
                        e.country_id as cur_country_id,
                        f.gender_name,
                        g.employmentstatus_name_en
                        FROM view_employee a
                        LEFT JOIN users b ON a.emp_no=b.username
                        LEFT JOIN teomworklocation c ON a.worklocation_code=c.worklocation_code
                        LEFT JOIN teomcompany d ON a.company_id=d.company_id
                        LEFT JOIN teodempaddress e ON a.emp_id=e.emp_id AND e.addresstype_code='A'
                        LEFT JOIN ttamgender f ON a.gender=f.id
                        LEFT JOIN hrmemploymentstatus g ON a.employ_code=g.employmentstatus_code
                        $where_srvside
                        ORDER BY a.Full_name asc";


$qListRender_by_WORKFLOW = "SELECT 
                                a.*,
                                (SELECT 'selected' FROM trndrequest x1 WHERE x1.request_no='$rfid' AND x1.active_status = '1' AND a.emp_id=x1.emp_id GROUP BY x1.emp_id) as selected
                            FROM view_employee a

                            $where_srvside
                            ORDER BY a.Full_name asc";