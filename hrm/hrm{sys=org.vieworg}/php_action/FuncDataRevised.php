<?php
require_once '../../../application/config.php';
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
       include "../../../application/session/sessionlv2.php";
} else {
       include "../../../application/session/mobile.session.php";
}

$years		   	= date("Y");
$flag		   	= date("his");
//if form is submitted
if ($_POST) {

	$validator = array('success' => false, 'messages' => array());

	$SFdate         		= date("Y-m-d");
	$SFtime         		= date('h:i:s');
	$SFdatetime     		= date("Y-m-d H:i:s");
	$SFnumber       		= date("YmdHis");
	$SFnumbercon    		= 'LVR' . $SFnumber;
	$SFReqtype				= 'Attendance.leave';

	$inp_revised_request_no     	= $_POST['inp_revised_request_no'];
	$inp_revised_emp_no     		= $_POST['inp_revised_emp_no'];
	$inp_revised_token				= addslashes($_POST['inp_revised_token']);
	$inp_revised_requestfor 		= $_POST['inp_revised_requestfor'];
	$modal_leave					= $_POST['modal_leave_revised'];
	$inp_revised_daytype			= $_POST['inp_revised_daytype'];
	$inp_revised_remark				= $_POST['inp_revised_remark'];
	$inp_revised_urgent_decl        = $_POST['inp_revised_urgent_decl'];

	$modal_leave_start 				= $_POST['modal_revised_leave_start'];
	$modal_leave_end 				= $_POST['modal_revised_leave_end'];
	$inp_revised_hdtype_starttime	= $_POST['inp_revised_hdtype_starttime'];
	$inp_revised_hdtype_endtime		= $_POST['inp_revised_hdtype_endtime'];
	$inp_revised_pdtype_starttime	= $_POST['inp_revised_pdtype_starttime'];
	$inp_revised_pdtype_endtime		= $_POST['inp_revised_pdtype_endtime'];

	$sql_leave_request_detail            = "SELECT 
													b.emp_id,
													a.shiftstarttime,
													a.shiftendtime,
													d.shiftstarttime as max_shiftstarttime,
													d.shiftendtime as min_shiftendtime,
													DATE(a.shiftstarttime) as date_shift,
													MID(a.shiftstarttime,12,12) as shift_start,
													MID(a.shiftendtime,12,12) as shift_end,
													TIME_FORMAT(c.break_starttime, '%H:%i:%s') as break_starttime,
													TIME_FORMAT(c.break_endtime, '%H:%i:%s') as break_endtime,
													CASE 
														WHEN $inp_revised_urgent_decl = '1' THEN 'Y'
														ELSE 'N'
													END AS urgent_request,
													CASE 
														WHEN '$inp_revised_daytype' = 'FD' THEN MIN(a.shiftstarttime)
														WHEN '$inp_revised_daytype' = 'HD' AND '$modal_leave_start' = DATE(MIN(a.shiftstarttime)) AND '$inp_revised_hdtype_starttime' = '1' THEN MIN(a.shiftstarttime)
														WHEN '$inp_revised_daytype' = 'HD' AND '$modal_leave_start' = DATE(MIN(a.shiftstarttime)) AND '$inp_revised_hdtype_starttime' = '2' THEN CONCAT(DATE_FORMAT(MIN(a.shiftstarttime), '%Y-%m-%d ') , TIME_FORMAT(c.break_endtime, '%H:%i:%s'))
														WHEN '$inp_revised_daytype' = 'HD' AND '$modal_leave_start' = DATE(MIN(a.shiftstarttime)) AND '$inp_revised_hdtype_starttime' = '3' THEN MIN(a.shiftstarttime)
														WHEN '$inp_revised_daytype' = 'PD' AND '$modal_leave_start' = DATE(MIN(a.shiftstarttime)) THEN CONCAT(DATE_FORMAT(MIN(a.shiftstarttime), '%Y-%m-%d ') , '$inp_revised_pdtype_starttime')
														ELSE MIN(a.shiftstarttime)
													END AS leave_starttime,
													CASE 
														WHEN '$inp_revised_daytype' = 'FD' THEN MAX(a.shiftendtime)
														WHEN '$inp_revised_daytype' = 'HD' AND '$modal_leave_end' = DATE(MAX(a.shiftendtime)) AND '$inp_revised_hdtype_starttime' = '1' AND '$inp_revised_hdtype_endtime' = 'noselect' THEN CONCAT(DATE_FORMAT(MAX(a.shiftendtime), '%Y-%m-%d ') , TIME_FORMAT(c.break_starttime, '%H:%i:%s'))
														WHEN '$inp_revised_daytype' = 'HD' AND '$modal_leave_end' = DATE(MAX(a.shiftendtime)) AND '$inp_revised_hdtype_starttime' = '2' AND '$inp_revised_hdtype_endtime' = 'noselect' THEN MAX(a.shiftendtime)
														WHEN '$inp_revised_daytype' = 'HD' AND '$modal_leave_end' = DATE(MAX(a.shiftendtime)) AND '$inp_revised_hdtype_starttime' = '3' AND '$inp_revised_hdtype_endtime' = 'noselect' THEN MAX(a.shiftendtime)
														WHEN '$inp_revised_daytype' = 'HD' AND '$modal_leave_end' = DATE(MAX(a.shiftendtime)) AND '$inp_revised_hdtype_endtime' = '1' THEN CONCAT(DATE_FORMAT(MAX(a.shiftendtime), '%Y-%m-%d ') , TIME_FORMAT(c.break_starttime, '%H:%i:%s'))
														WHEN '$inp_revised_daytype' = 'PD' AND '$modal_leave_end' = DATE(MAX(a.shiftendtime)) THEN CONCAT(DATE_FORMAT(MAX(a.shiftendtime), '%Y-%m-%d ') , '$inp_revised_pdtype_endtime')
														ELSE MAX(a.shiftendtime)
													END AS leave_endtime,
													CASE 
														WHEN '$inp_revised_daytype' IN ('FD','PD') THEN '3'
														WHEN '$inp_revised_daytype' = 'HD' AND '$modal_leave_start' = DATE(MIN(a.shiftstarttime)) AND '$inp_revised_hdtype_starttime' = '1' THEN '1'
														WHEN '$inp_revised_daytype' = 'HD' AND '$modal_leave_start' = DATE(MIN(a.shiftstarttime)) AND '$inp_revised_hdtype_starttime' = '2' THEN '2'
														WHEN '$inp_revised_daytype' = 'HD' AND '$modal_leave_end' = DATE(MAX(a.shiftendtime)) AND '$inp_revised_hdtype_endtime' = '1' THEN '1'
														WHEN '$inp_revised_daytype' = 'HD' AND '$modal_leave_end' = DATE(MAX(a.shiftendtime)) AND '$inp_revised_hdtype_endtime' = '2' THEN '2'
														WHEN '$inp_revised_daytype' = 'HD' AND '$modal_leave_end' = DATE(MAX(a.shiftendtime)) AND '$inp_revised_hdtype_endtime' = '3' THEN '3'
														ELSE '3'
													END AS dayrequesttype,
													-- ESTES
													CASE 
											
														WHEN '$inp_revised_daytype' = 'HD' AND '$modal_leave_start' = DATE(MIN(a.shiftstarttime)) AND '$inp_revised_hdtype_starttime' IN ('1','2') AND '$inp_revised_hdtype_endtime' = 'noselect' THEN d.total_calculate-0.5
														WHEN '$inp_revised_daytype' = 'HD' AND '$modal_leave_start' = DATE(MIN(a.shiftstarttime)) AND '$inp_revised_hdtype_starttime' = '3' AND '$inp_revised_hdtype_endtime' = 'noselect' THEN d.total_calculate
														WHEN '$inp_revised_daytype' = 'HD' AND '$modal_leave_start' = DATE(MIN(a.shiftstarttime)) AND '$inp_revised_hdtype_starttime' = '2' AND '$inp_revised_hdtype_endtime' = '1' THEN d.total_calculate-1
														WHEN '$inp_revised_daytype' = 'HD' AND '$modal_leave_start' = DATE(MIN(a.shiftstarttime)) AND '$inp_revised_hdtype_starttime' = '3' AND '$inp_revised_hdtype_endtime' = '1' THEN d.total_calculate-0.5
														WHEN '$inp_revised_daytype' = 'HD' AND '$modal_leave_start' = DATE(MIN(a.shiftstarttime)) AND '$inp_revised_hdtype_starttime' = '2' AND '$inp_revised_hdtype_endtime' = '2' THEN d.total_calculate-0.5
														WHEN '$inp_revised_daytype' = 'HD' AND '$modal_leave_start' = DATE(MIN(a.shiftstarttime)) AND '$inp_revised_hdtype_starttime' = '2' AND '$inp_revised_hdtype_endtime' = '3' THEN d.total_calculate-0.5
														WHEN '$inp_revised_daytype' = 'PD' AND 
																					(
																						(
																							CONCAT('$modal_leave_start ' , TIME_FORMAT(c.break_starttime, '%H:%i:%s')) >
																							CONCAT('$modal_leave_start ' , '$inp_revised_pdtype_starttime') AND
																							CONCAT('$modal_leave_start ' , TIME_FORMAT(c.break_starttime, '%H:%i:%s')) <
																							CONCAT('$modal_leave_start ' , '$inp_revised_pdtype_endtime') 
																								OR
																							CONCAT('$modal_leave_start ' , TIME_FORMAT(c.break_endtime, '%H:%i:%s')) >
																							CONCAT('$modal_leave_start ' , '$inp_revised_pdtype_starttime') AND
																							CONCAT('$modal_leave_start ' , TIME_FORMAT(c.break_endtime, '%H:%i:%s')) <
																							CONCAT('$modal_leave_start ' , '$inp_revised_pdtype_endtime') 
																						)
																					) THEN
																					(TIMESTAMPDIFF(MINUTE,CONCAT('$modal_leave_start ' , '$inp_pdtype_starttime'),CONCAT('$modal_leave_end ' , '$inp_pdtype_endtime'))/e.productivehours) -
																										(TIMESTAMPDIFF(MINUTE,CONCAT(DATE_FORMAT(MIN(a.shiftstarttime), '%Y-%m-%d ') , TIME_FORMAT(c.break_starttime, '%H:%i:%s')),CONCAT(DATE_FORMAT(MAX(a.shiftendtime), '%Y-%m-%d ') , TIME_FORMAT(c.break_endtime, '%H:%i:%s')))/e.productivehours)
														WHEN '$inp_revised_daytype' = 'PD' THEN (TIMESTAMPDIFF(MINUTE,CONCAT('$modal_leave_start ' , '$inp_revised_pdtype_starttime'),CONCAT('$modal_leave_end ' , '$inp_revised_pdtype_endtime'))/e.productivehours)
														ELSE d.total_calculate
												
													END AS total_days
													-- ESTES
                                            FROM hrdattendance a
                                            LEFT JOIN view_employee b on a.emp_id=b.emp_id
											LEFT JOIN HRMTTADSHIFTBREAK c on a.shiftdaily_code=c.shiftdailycode
											LEFT JOIN 
														(
															SELECT 
																sub1.emp_id,
																sub1.attend_id,
																MIN(sub1.shiftstarttime) as shiftstarttime,
																MAX(sub1.shiftendtime) as shiftendtime,
																count(sub1.daytype) as total_calculate
															FROM hrdattendance sub1
															WHERE
															sub1.emp_id = (SELECT emp_id FROM view_employee WHERE emp_no = '$inp_revised_requestfor') and
															sub1.daytype IN ('WD','PHWD') and
															sub1.dateforcheck between '$modal_leave_start' and '$modal_leave_end'
														) d ON a.emp_id=d.emp_id
											LEFT JOIN HRMTTAMSHIFTDAILY e on a.shiftdaily_code=e.shiftdailycode
                                            WHERE 
                                            b.emp_no = '$inp_revised_requestfor' and
                                            a.daytype IN ('WD','PHWD') and
                                            a.dateforcheck between '$modal_leave_start' and '$modal_leave_end'
											GROUP BY a.dateforcheck
											ORDER BY a.dateforcheck DESC";

	$leave_request_detail = mysqli_query($connect, $sql_leave_request_detail );

	if (mysqli_num_rows($leave_request_detail) == '0') {
		$validator['success'] = false;
		$validator['code'] = "failed_message";
		$validator['messages'] = "0 working days" ;
	}

	$sql_0 = $connect->query("DELETE FROM `hrdleaverequest` WHERE `request_no` = '$inp_revised_request_no'");

	while ($r_detail = mysqli_fetch_array($leave_request_detail)) {

		$sql_1 = "INSERT INTO hrdleaverequest 
                                (
                                      `request_no`, 
                                      `company_id`, 
                                      `leave_date`, 
                                      `leave_starttime`,
                                      `leave_endtime`, 
                                      `created_by`, 
                                      `created_date`, 
                                      `modified_by`, 
                                      `modified_date`, 
                                      `cancelsts`, 
                                      `dayrequesttype`
                                ) 
                                      VALUES 
                                            (
                                                  '$inp_revised_request_no', 
                                                  '13576', 
                                                  '$r_detail[shiftstarttime]',
                                                  '$r_detail[leave_starttime]',
                                                  '$r_detail[leave_endtime]',
                                                  '$username', 
                                                  '$SFdatetime', 
                                                  '$username', 
                                                  '$SFdatetime', 
                                                  'N',
												  '$r_detail[dayrequesttype]'
                                            )";
			
			$query_1 = $connect->query($sql_1);
		
			$sql_2 = "SELECT
							COUNT(*) AS total
						FROM hrdleaverequest a
						LEFT JOIN 
								(
									SELECT 
									sub1.request_no,
										MAX(sub1.request_status) as request_status
									FROM hrmrequestapproval sub1
									GROUP BY sub1.request_no
								) b on a.request_no=b.request_no
						WHERE 
									b.request_status IN ('1','2','3','','9') AND
									('$r_detail[leave_starttime]' BETWEEN a.leave_starttime AND a.leave_endtime OR 
									'$r_detail[leave_endtime]' BETWEEN a.leave_starttime AND a.leave_endtime)";

				$query_2 = mysqli_fetch_array(mysqli_query($connect , $sql_2));

				$sql_3 = "SELECT 
							CASE 
							WHEN SUM(c.remaining) < '$r_detail[total_days]' THEN 'notallowed'
							ELSE 'allow'
							END balance_amount
						FROM view_employee a
						LEFT JOIN hrmempleavebal c on a.emp_id=c.emp_id
						WHERE a.emp_no='$inp_revised_requestfor' and c.leave_code = '$modal_leave' and c.active_status = '1'";

				$query_3 = mysqli_fetch_array(mysqli_query($connect , $sql_3));

				$sql_4 = "SELECT 
							a.max_req_day,
							a.min_req_day,
							CASE 
								WHEN DATEDIFF('$modal_leave_start', CURRENT_DATE()) < a.max_req_day AND $inp_revised_urgent_decl = '0' THEN 'notallowed'
								ELSE 'allow'
							END AS urgent_permission 
						FROM hrmvalleave a 
						WHERE a.leave_code = '$modal_leave'";

				$query_4 = mysqli_fetch_array(mysqli_query($connect , $sql_4));


		if ($query_3['balance_amount'] == 'notallowed') {
				$validator['success'] = false;
				$validator['code'] = "failed_message";
				$validator['messages'] = "Leave balance remaining not enough" ;

		} else {

			$query_0 = $connect->query($sql_0);

			if ($r_detail['leave_starttime'] > $r_detail['leave_endtime']) {
				$validator['success'] = false;
				$validator['code'] = "failed_message";
				$validator['messages'] = "Leave starttime cannot more than endtime $inp_urgent_decl" ;
	
			} else if ($sql_0 == TRUE) {
				$validator['success'] = false;
				$validator['code'] = "success_message";
				
				$key_0 = $inp_revised_request_no; 
				$key_1 = $modal_leave; 
				$key_2 = $r_detail['total_days']; 
				$key_3 = $r_detail['emp_id'];
				$key_4 = $inp_revised_emp_no;

				$connect->query("DELETE FROM `sys_deducted_leave` WHERE `leave_request_no` = '$key_0'");
				$kros = "SELECT
                          a.emp_id,
                          a.empgetleave_id,
                          a.leave_code, 
                          YEAR(a.startvaliddate) AS period,
                          a.remaining,
                          b.total_active_leave,
                          a.startvaliddate,
                          c.remaining_old,
                          d.remaining_new,
                          e.remaining_all_old,
                          f.remaining_all_new,
                          CASE
                  
                                 WHEN b.total_active_leave > 1 AND c.remaining_old > 0 AND c.remaining_old >= '$r_detail[total_days]' THEN '$r_detail[total_days]'
                         
                                 WHEN b.total_active_leave > 1 AND c.remaining_old IS NULL AND e.remaining_all_old >= '$r_detail[total_days]' THEN '0'
                         
                                 WHEN b.total_active_leave > 1 AND c.remaining_old > 0 AND c.remaining_old < '$r_detail[total_days]' THEN REPLACE(c.remaining_old, '.0000', '')
          
                                 WHEN b.total_active_leave > 1 AND d.remaining_new > 0 AND e.remaining_all_old < '$r_detail[total_days]' AND e.remaining_all_old = 0 THEN '$r_detail[total_days]' - e.remaining_all_old
                                 WHEN b.total_active_leave > 1 AND d.remaining_new > 0 AND e.remaining_all_old < '$r_detail[total_days]' AND e.remaining_all_old < 0 THEN '$r_detail[total_days]'
                                 WHEN b.total_active_leave > 1 AND d.remaining_new > 0 AND e.remaining_all_old < '$r_detail[total_days]' THEN '$r_detail[total_days]' - e.remaining_all_old
              
                                 WHEN b.total_active_leave > 1 AND (c.remaining_old <= 0  OR c.remaining_old < 0) THEN '0'
        
                          WHEN b.total_active_leave > 1 AND d.remaining_new > 0 AND c.remaining_old < '$r_detail[total_days]' AND e.remaining_all_old < 0 THEN '$r_detail[total_days]'
                          WHEN b.total_active_leave = 1 AND c.remaining_old > 0 AND c.remaining_old > '$r_detail[total_days]' THEN c.remaining_old-'$r_detail[total_days]'
                          WHEN b.total_active_leave = 1 AND c.remaining_old < '$r_detail[total_days]' THEN c.remaining_old-'$r_detail[total_days]'	
                          END AS 
                          total_amount_yang_dipake
                   FROM hrmempleavebal a
                   LEFT JOIN 
                                        (
                                               SELECT
                                               sub1.leave_code,
                                               COUNT(*) AS total_active_leave
                                               FROM hrmempleavebal sub1
                                               WHERE sub1.emp_id='$key_3' AND sub1.leave_code='$key_1' AND sub1.active_status='1'
                                        ) b ON a.leave_code=b.leave_code
                   LEFT JOIN 
                                        (
                                               SELECT
                                                      sub2.empgetleave_id,
                                                      sub2.remaining AS remaining_old
                                               FROM hrmempleavebal sub2
                                               WHERE sub2.emp_id='$key_3' AND sub2.leave_code='$key_1' AND sub2.active_status='1'
                                               ORDER BY sub2.startvaliddate ASC LIMIT 1
                                        ) c ON a.empgetleave_id=c.empgetleave_id
                   LEFT JOIN 
                                        (
                                               SELECT
                                                      sub3.empgetleave_id,
                                                      sub3.remaining AS remaining_new
                                               FROM hrmempleavebal sub3
                                               WHERE sub3.emp_id='$key_3' AND sub3.leave_code='$key_1' AND sub3.active_status='1'
                                               ORDER BY sub3.startvaliddate DESC LIMIT 1
                                        ) d ON a.empgetleave_id=d.empgetleave_id
                   LEFT JOIN 
                                        (
                                               SELECT
                                                      sub4.emp_id,
                                                      sub4.remaining AS remaining_all_old
                                               FROM hrmempleavebal sub4
                                               WHERE sub4.emp_id='$key_3' AND sub4.leave_code='$key_1' AND sub4.active_status='1'
                                               ORDER BY sub4.startvaliddate ASC LIMIT 1
                                        ) e ON a.emp_id=e.emp_id
                   LEFT JOIN 
                                        (
                                               SELECT
                                                      sub5.emp_id,
                                                      sub5.remaining AS remaining_all_new
                                               FROM hrmempleavebal sub5
                                               WHERE sub5.emp_id='$key_3' AND sub5.leave_code='$key_1' AND sub5.active_status='1'
                                               ORDER BY sub5.startvaliddate DESC LIMIT 1
                                        ) f ON a.emp_id=f.emp_id
                   WHERE a.emp_id='$key_3' AND a.leave_code='$key_1' AND a.active_status='1'
                   ORDER BY YEAR(a.startvaliddate) ASC ";

				$get_Formula = mysqli_query($connect, $kros);
				while ($row = mysqli_fetch_array($get_Formula)) {
					$condition = $row['total_amount_yang_dipake'];
					if($condition > 0) {
						$att_formula = "INSERT INTO `sys_deducted_leave` (`empgetleave_bal`, `leave_request_no`, `total_usage`,`created_by`) VALUES ('$row[empgetleave_id]', '$inp_revised_request_no', '$row[total_amount_yang_dipake]','$key_4')";
						$formula_process = mysqli_query($connect, $att_formula);
					}
				}
				

				$sql_3  = $connect->query("UPDATE `hrmleaverequest` SET 
												`leave_code` 		= '$modal_leave',
												`leave_startdate`	= '$r_detail[max_shiftstarttime]', 
												`leave_enddate`		= '$r_detail[min_shiftendtime]',  
												`totaldays`			= '$r_detail[total_days]', 
												`remark`			= '$inp_revised_remark',
												`modified_by`		= '$inp_revised_emp_no',
												`modified_date`		= '$SFdatetime'
											WHERE `request_no` = '$inp_revised_request_no'");
					
				

				$validator['messages'] = "Successfully submit request";

				$connect->query("UPDATE `hrmrequestapproval` SET `request_status` = '1' WHERE `request_status` = '4' AND `request_no` = '$inp_revised_request_no'");
				$connect->query("UPDATE `hrmrequestapproval` SET `status` = '0' WHERE `request_status` = '4' AND `request_no` = '$inp_revised_request_no' AND `status` = '0'");
				
			} else {
				$validator['success'] = false;
				$validator['code'] = "failed_message";
				$validator['messages'] = "Failed create request";
			}
	}

	
}

	






	// condition ends

	// close the database connection
	$connect->close();
	echo json_encode($validator);
}
