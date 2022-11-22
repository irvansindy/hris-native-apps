<?php 
$qListRender = "SELECT 

                     a.shiftdailycode,
                     TIME_FORMAT(a.starttime, '%H:%i:%s') as starttime,
                     TIME_FORMAT(a.endtime, '%H:%i:%s') as endtime,
                     CONCAT('Break ', b.break_no, ' : ' , TIME_FORMAT(b.break_starttime, '%H:%i') , ' - ' , TIME_FORMAT(b.break_endtime, '%H:%i')) as break_no,
                     CASE
                            WHEN a.daytype = 'wd' THEN 'Work Day'
                            WHEN a.daytype = 'off' THEN 'Off Day'
                     ELSE 'unidentified'
                     END as daytype,
                     CASE
                            WHEN a.flexibleshift = 'Y' THEN '../../asset/dist/img/tick.png'
                            WHEN a.flexibleshift = 'N' THEN '../../asset/dist/img/inactive.png'
                     ELSE '../../asset/dist/img/inactive.png'
                     END as flexibleshift,
                     a.remark

                FROM hrmttamshiftdaily a
                LEFT JOIN hrmttadshiftbreak b on a.shiftdailycode=b.shiftdailycode

                $where
       
                ORDER BY a.shiftdailycode asc
                
                LIMIT $limit, $page";
?>