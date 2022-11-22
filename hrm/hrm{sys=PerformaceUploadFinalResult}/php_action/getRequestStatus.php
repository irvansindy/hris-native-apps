<?php 
require_once '../../../application/config.php';
require_once '../../../application/session/sessionlv2.php';

$memberId = $_POST['request_no_spvdown'];
//$memberId = 'PA-APPR2022-PAREQ202213029920220121033052';

$get_data_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT position_id FROM view_employee WHERE emp_no = '$username'"));
$get_data_print_0    = $get_data_0['position_id'];

$get_data_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT 
                                                                      ipa_reqno 
                                                                      FROM hrmperf_parequest_stfsc 
                                                                      WHERE pa_reqno = '$memberId'
                                                                      LIMIT 1"));
$get_data_print_1    = $get_data_1['ipa_reqno'];

//$memberId = 'DO170048';

$sql = "SELECT 
              COUNT(*) AS is_approved_spvdown,
              (SELECT (CASE
                            WHEN (SELECT COUNT(y1.req) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req IN ('Notification','Sequence','Required')) = '3' THEN
                                                 CASE WHEN 
                                                 a.req = 'Required' AND 
                                                 a.request_status IN ('1','2') AND
                                                 (SELECT SUM(y1.`status`) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req = 'Sequence') IN ('0')
                                                 THEN 'HIDE'
                                                 ELSE 'SHOW'		
                                                 END
                            WHEN (SELECT COUNT(y1.req) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req IN ('Notification','Sequence','Required')) = '2' THEN
                                                 CASE 
                                                        WHEN 
                                                               (SELECT COUNT(y1.req) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req = 'Notification') > 0 AND
                                                               (SELECT COUNT(y1.req) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req = 'Sequence') > 0 AND
                                                               (SELECT COUNT(y1.req) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req = 'Required') = 0
                                                        THEN 'SHOW'
                                                        WHEN 
                                                               (SELECT COUNT(y1.req) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req = 'Notification') > 0 AND
                                                               (SELECT COUNT(y1.req) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req = 'Sequence') = 0 AND
                                                               (SELECT COUNT(y1.req) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req = 'Required') > 0
                                                        THEN 'SHOW'
                                                        WHEN 
                                                               (SELECT COUNT(y1.req) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req = 'Notification') = 0 AND
                                                               (SELECT COUNT(y1.req) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req = 'Sequence') > 0 AND
                                                               (SELECT COUNT(y1.req) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req = 'Required') > 0 AND
                                                               a.req = 'Required' AND
                                                               a.request_status IN ('1','2') AND
                                                               (SELECT SUM(y1.`status`) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req = 'Sequence') IN ('0')
                                                        THEN 'HIDE'
                                                 ELSE 'SHOW'
                                                 END
                            WHEN (SELECT COUNT(y1.req) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req IN ('Notification','Sequence','Required')) = '1' THEN
                                                 CASE 
                                                        WHEN 
                                                               (SELECT COUNT(y1.req) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req = 'Notification') > 0 AND
                                                               (SELECT COUNT(y1.req) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req = 'Sequence') = 0 AND
                                                               (SELECT COUNT(y1.req) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req = 'Required') = 0
                                                        THEN 'SHOW'
                                                        WHEN 
                                                               (SELECT COUNT(y1.req) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req = 'Notification') = 0 AND
                                                               (SELECT COUNT(y1.req) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req = 'Sequence') > 0 AND
                                                               (SELECT COUNT(y1.req) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req = 'Required') = 0
                                                        THEN 'SHOW'
                                                        WHEN 
                                                               (SELECT COUNT(y1.req) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req = 'Notification') = 0 AND
                                                               (SELECT COUNT(y1.req) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req = 'Sequence') = 0 AND
                                                               (SELECT COUNT(y1.req) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req = 'Required') > 0
                                                        THEN 'SHOW'
                                                 ELSE 'SHOW'
                                                 END
                     END) IN ('SHOW')) AS ready
                     FROM 
              hrmrequestapproval a
              WHERE 
                     a.request_no         = '$get_data_print_1' AND
                     a.position_id        = '$get_data_print_0' AND
                     a.status             = '0' AND
                     a.request_status     IN ('1','2','3','','')";
		
$query = mysqli_query($connect, $sql);
$result = mysqli_fetch_assoc($query);

$connect->close();

echo json_encode($result);

