<?php
$qListRender_srvside = "SELECT 
	a.*,
	c.*,
	DATE_FORMAT(a.start_date, '%d %b %Y') as join_date,
	DATE_FORMAT(c.dateforcheck, '%a, %d %b %Y') as attend_date,

	CASE 
		WHEN c.daytype LIKE '%PH%' THEN 'background-color: pink;'
		ELSE ''
		END AS style,

	(SELECT GROUP_CONCAT(attend_code) 
	FROM hrdattstatusdetail
	WHERE attend_id = c.attend_id
	GROUP BY attend_id) as attdetaillist,
	
	REPLACE(c.attend_id, '-', '') as key_att,

	TIME_FORMAT(c.shiftstarttime, '%H:%i') as shiftstarttime,
	TIME_FORMAT(c.shiftendtime, '%H:%i') as shiftendtime,
	TIME_FORMAT(c.starttime, '%H:%i') as starttime,
	TIME_FORMAT(c.endtime, '%H:%i') as endtime,

	DATE_FORMAT(c.shiftstarttime ,'%d') as stoday,
	DATE_FORMAT(DATE_ADD(c.shiftstarttime, INTERVAL -1 DAY),'%d') as sdayminone,
	DATE_FORMAT(DATE_ADD(c.shiftstarttime, INTERVAL 0 DAY),'%d') as sdayone,
	DATE_FORMAT(DATE_ADD(c.shiftstarttime, INTERVAL 1 DAY),'%d') as sdayplusone,

	DATE_FORMAT(DATE_ADD(c.shiftstarttime, INTERVAL -1 DAY),'%Y-%m-%d') as sfdayminone,
	DATE_FORMAT(DATE_ADD(c.shiftstarttime, INTERVAL 0 DAY),'%Y-%m-%d') as sfdayone,
	DATE_FORMAT(DATE_ADD(c.shiftstarttime, INTERVAL 1 DAY),'%Y-%m-%d') as sfdayplusone,

	CASE WHEN 
			DATE_FORMAT(c.shiftstarttime ,'%d') = DATE_FORMAT(DATE_ADD(c.shiftstarttime, INTERVAL -1 DAY),'%d') THEN 'checked=checked'
			ELSE ''
	END AS sdayminone_check,
	CASE WHEN 
			DATE_FORMAT(c.shiftstarttime ,'%d') = DATE_FORMAT(DATE_ADD(c.shiftstarttime, INTERVAL 0 DAY),'%d') THEN 'checked=checked'
			ELSE ''
	END AS sdayone_check,
	CASE WHEN 
			DATE_FORMAT(c.shiftstarttime ,'%d') = DATE_FORMAT(DATE_ADD(c.shiftstarttime, INTERVAL 1 DAY),'%d') THEN 'checked=checked'
			ELSE ''
	END AS sdayplusone_check,

	DATE_FORMAT(c.shiftendtime ,'%d') as etoday,
	DATE_FORMAT(DATE_ADD(c.shiftendtime, INTERVAL -1 DAY),'%d') as edayminone,
	DATE_FORMAT(DATE_ADD(c.shiftendtime, INTERVAL 0 DAY),'%d') as edayone,
	DATE_FORMAT(DATE_ADD(c.shiftendtime, INTERVAL 1 DAY),'%d') as edayplusone,

	DATE_FORMAT(DATE_ADD(c.shiftendtime, INTERVAL -1 DAY),'%Y-%m-%d') as efdayminone,
	DATE_FORMAT(DATE_ADD(c.shiftendtime, INTERVAL 0 DAY),'%Y-%m-%d') as efdayone,
	DATE_FORMAT(DATE_ADD(c.shiftendtime, INTERVAL 1 DAY),'%Y-%m-%d') as efdayplusone,
	CASE WHEN 
			DATE_FORMAT(c.shiftendtime ,'%d') = DATE_FORMAT(DATE_ADD(c.shiftstarttime, INTERVAL -1 DAY),'%d') THEN 'checked=checked'
			ELSE ''
	END AS edayminone_check,
	CASE WHEN 
			DATE_FORMAT(c.shiftendtime ,'%d') = DATE_FORMAT(DATE_ADD(c.shiftstarttime, INTERVAL 0 DAY),'%d') THEN 'checked=checked'
			ELSE ''
	END AS edayone_check,
	CASE WHEN 
			DATE_FORMAT(c.shiftendtime ,'%d') = DATE_FORMAT(DATE_ADD(c.shiftstarttime, INTERVAL 1 DAY),'%d') THEN 'checked=checked'
			ELSE ''
	END AS edayplusone_check

	FROM view_employee a
	LEFT JOIN hrdattendance c on a.emp_id=c.emp_id

	WHERE (a.emp_no LIKE '%$src_emp_no%') and c.dateforcheck BETWEEN '$src_startdate' and '$src_enddate' 

	GROUP BY c.attend_id
	ORDER BY c.dateforcheck
		";
?>