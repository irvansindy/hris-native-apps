<?php 
$qListRender = "SELECT 

                     a.attend_code,
                     a.attend_name_id,
                     a.present_flag AS prs,
                     CASE
                            WHEN a.present_flag = 'Y' THEN '../../asset/dist/img/tick.png'
                            WHEN a.present_flag = 'N' THEN '../../asset/dist/img/inactive.png'
                     ELSE '../../asset/dist/img/inactive.png'
                     END as present_flag

                FROM HRMTTAMATTSTATUS a

                $where
       
                ORDER BY a.attend_code asc
                
                LIMIT $limit, $page";
?>