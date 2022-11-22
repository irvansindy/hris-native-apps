<?php 
$qListRender = "SELECT 
 				a.emp_no,
                            a.Full_name as Full_name,
                            b.attend_code,
				DATE_FORMAT(b.shiftstarttime, '%d %b %Y') as shiftstarttime,
                            (SELECT 
                                   GROUP_CONCAT(attend_code ORDER BY attend_code ASC SEPARATOR ', ') AS attend_code
                                   from hrdadattstatus
                                   WHERE attend_id=b.attend_id
                                   GROUP BY attend_id) as other_status,
                            b.shiftdaily_code,
                            b.daytype,
                            b.remark,
                            DATE_FORMAT(b.shiftstarttime, '%H:%i:%s' ) as shiftin,
                            DATE_FORMAT(b.shiftendtime, '%H:%i:%s' ) as shiftout,
                            DATE_FORMAT(b.starttime, '%H:%i:%s' ) as starttime,
                            DATE_FORMAT(b.endtime, '%H:%i:%s' ) as endtime,
                            b.actual_in,
                            b.actual_out 
FROM (SELECT * FROM hrdattendance) b
JOIN (SELECT * FROM view_employee) a
on a.emp_id=b.emp_id

$where

ORDER BY b.dateforcheck DESC
LIMIT $limit, $page";
?>