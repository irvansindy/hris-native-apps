<?php
    include "../../../application/config.php";

    

    $queryGetDataOnDuty = "SELECT
	a.request_no,
    b.emp_id,
	c.purpose_name_en,
    d.name_en,
    a.requestdate,
    a.requestenddate
FROM hrdondutyrequest a
LEFT JOIN view_employee b ON a.requestfor=b.emp_id
INNER JOIN hrmondutypurposetype c ON a.purpose_code = c.purpose_code
LEFT JOIN hrmstatus d ON (SELECT request_status FROM hrmrequestapproval 
	WHERE request_no = a.request_no ORDER BY `request_status` DESC limit 1) = d.code
WHERE b.emp_id = 
AND (d.code IN ('3'))
GROUP BY request_no";