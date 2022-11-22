<?php 
$qListRender = "SELECT 

                     aa.shiftgroupcode,
                     aa.shiftgroupname,
                     aa.company_id,
                     aa.totaldays,
                     aa.created_date,
                     aa.created_by,
                     aa.modified_date,
                     aa.modified_by,
                     CASE
                            WHEN aa.overtime_calculation = 'RA' THEN 'Request And Attendance'
                            WHEN aa.overtime_calculation = 'RO' THEN 'Request Only'
                            WHEN aa.overtime_calculation = 'AO' THEN 'Attendance Only'
                            WHEN aa.overtime_calculation = 'AW' THEN 'Attendance With Request'
                     ELSE 'Attendance With Request'
                     END AS overtime_calculation,
                     aa.PH_OFFDAY,
                     aa.premicheck,
                     aa.shiftgroupstart,
                     aa.totalspecialday,

                     (SELECT
                            GROUP_CONCAT((SELECT
                            CASE WHEN a.shiftdailycode = 'L01' THEN '(L01 - Flexible Shift)'
										ELSE 
                            CONCAT('(',a.shiftdailycode , ' Start - End : ' , TIME_FORMAT(b.starttime, '%H:%i:%s') , ' - ' , TIME_FORMAT(b.endtime, '%H:%i:%s') , ') ') END AS formula
    

                            FROM HRMTTARSHIFTGROUPDAILY a
                            LEFT JOIN hrmttamshiftdaily b ON a.shiftdailycode=b.shiftdailycode
                            WHERE a.shiftgroupcode=x.shiftgroupcode AND a.shiftdailycode=x.shiftdailycode
                            GROUP BY a.shiftdailycode) SEPARATOR ' <br> ') AS formula


                            FROM HRMTTARSHIFTGROUPDAILY x
                            WHERE x.shiftgroupcode=aa.shiftgroupcode
                            GROUP BY x.shiftgroupcode) as formula


              FROM HRMTTAMSHIFTGROUP aa

                $where
       
                ORDER BY aa.shiftgroupcode asc
                
                LIMIT $limit, $page";
?>