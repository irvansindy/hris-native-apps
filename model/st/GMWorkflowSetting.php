<?php 
$qListRender = "SELECT 
                     a.emp_no,
                     a.full_name,
                     a.cost_code,
                     a.worklocation_code,
                     'Attendance.leave' as request_code,
                     c.empno_appvr1,
                     c.empno_appvr2,
                     c.empno_appvr3
                     FROM view_employee a
                     LEFT JOIN tclcmreqtype b ON b.request_code = 'Attendance.leave'
                     LEFT JOIN tclcdreqappsetting c ON b.request_code=c.request_type AND c.emp_no=a.emp_no
                     WHERE a.emp_no IN ('13-0299','12-0116')
                                   
                     UNION ALL

                     SELECT 
                     a.emp_no,
                     a.full_name,
                     a.cost_code,
                     a.worklocation_code,
                     'Performance' as request_code,
                     c.empno_appvr1,
                     c.empno_appvr2,
                     c.empno_appvr3
                     FROM view_employee a
                     LEFT JOIN tclcmreqtype b ON b.request_code = 'Performance'
                     LEFT JOIN tclcdreqappsetting c ON b.request_code=c.request_type AND c.emp_no=a.emp_no
                     WHERE a.emp_no IN ('13-0299','12-0116')
                                   
                     UNION ALL

                     SELECT 
                     a.emp_no,
                     a.full_name,
                     a.cost_code,
                     a.worklocation_code,
                     'Performance.appraisal' as request_code,
                     c.empno_appvr1,
                     c.empno_appvr2,
                     c.empno_appvr3
                     FROM view_employee a
                     LEFT JOIN tclcmreqtype b ON b.request_code = 'Performance.appraisal'
                     LEFT JOIN tclcdreqappsetting c ON b.request_code=c.request_type AND c.emp_no=a.emp_no
                     WHERE a.emp_no IN ('13-0299','12-0116')     
                     $WHERE";
?>