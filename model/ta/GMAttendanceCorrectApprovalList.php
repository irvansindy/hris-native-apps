<?php
	$query_attendance_correct_approval_list = "SELECT
		a.request_no,
		a.created_date,
		a.emp_id,
		a.requestby,
		DATE_FORMAT(a.requestdate, '%d %b %Y') AS requestdate,
		# DATE_FORMAT(a.requestenddate, '%d %b %Y') AS requestenddate,
		# a.purpose_code,
		a.reason,
		a.attachment,
		b.emp_id,
		b.Full_Name,
		b.user_id,
		b.emp_no,
		# g.purpose_name_en,
		xdec1.name_en,
		xdec1.status
		FROM hrmattcorrection a 
		INNER JOIN view_employee b on a.emp_id = b.emp_id
		LEFT JOIN (
			SELECT
				c.status,
				c.request_no as no_approval,
				d.req,
				e.name_en
				FROM (
					SELECT MAX(f.request_status) status, f.request_no
					FROM hrmrequestapproval f
					GROUP BY f.request_no
				) c
			INNER JOIN hrmrequestapproval d ON d.request_no = c.request_no
			AND d.request_status = c.status
			LEFT JOIN hrmstatus e ON c.status = e.code
		) xdec1 ON xdec1.no_approval=a.request_no
		LEFT JOIN view_employee e ON e.emp_no = '$username'
		INNER JOIN hrmrequestapproval f ON f.request_no = a.request_no
		AND f.position_id = e.position_id
		# LEFT JOIN hrmondutypurposetype g ON g.purpose_code = a.purpose_code
		WHERE (e.emp_no = '$username') AND xdec1.status IN ('1','2','3','5')
		GROUP BY a.request_no
		ORDER BY xdec1.name_en DESC, a.request_no DESC";