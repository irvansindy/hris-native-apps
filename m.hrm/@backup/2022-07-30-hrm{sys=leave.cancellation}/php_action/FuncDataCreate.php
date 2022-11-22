<?php
require_once '../../../application/config.php';
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if($getdata == 0) {
	include "../../../application/session/session.php";
} else {
	include "../../../application/session/mobile.session.php";
}

$years		   	= date("Y");
$flag		   	= date("his");
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$SFdate                 = date("Y-m-d");
	$SFtime                 = date('h:i:s');
	$SFdatetime             = date("Y-m-d H:i:s");
	$SFnumber               = date("YmdHis");
	$SFnumbercon            = 'LCR'.$SFnumber;

	$inp_reqleavenumber     = $_POST['inp_reqleavenumber'];
	$inp_remark             = $_POST['inp_remark'];

	$emp                    = mysqli_fetch_array(mysqli_query($connect, "SELECT b.emp_no,a.leave_code FROM hrmleaverequest a LEFT JOIN view_employee b on a.emp_id=b.emp_id WHERE a.request_no='$inp_reqleavenumber'"));
	$emp_print              = $emp['emp_no'];
	$modal_emp              = $emp['emp_no'];
	$modal_leave            = $emp['leave_code'];
	$var_emp_id             = mysqli_fetch_array(mysqli_query($connect, "SELECT emp_id FROM teodempcompany WHERE emp_no = '$emp_print'"));
	$var_request_emp_id     = mysqli_fetch_array(mysqli_query($connect, "SELECT emp_id FROM teodempcompany WHERE emp_no = '$username'"));

	$var_date_leave   = $_POST['pilih'];
      	$total_leave_cancel_request   = count($var_date_leave);

	for($ikpi=0;$ikpi<count($_POST['pilih']);$ikpi++){
			$ikpi_plus 		= $ikpi+1;
			$var_date_leave	= $_POST['pilih'][$ikpi]; // item

			$selectDate  = $var_date_leave;
			$selectDateExplode = explode("~", $selectDate);

			$selectDateExplode0 = $selectDateExplode[0];
			$selectDateExplode1 = $selectDateExplode[1];

			$sql_1    = "INSERT INTO hrdleavecancelrequest 
                                                                             (
                                                                                    `request_no`, 
                                                                                    `company_id`, 
                                                                                    `leave_date`, 
                                                                                    `leave_starttime`, 
                                                                                    `leave_endtime`,
												`total_days`,
                                                                                    `created_by`, 
                                                                                    `created_date`, 
                                                                                    `modified_by`, 
                                                                                    `modified_date`
                                                                             ) 
                                                                                    VALUES 
                                                                                           (
                                                                                           '$SFnumbercon', 
                                                                                           '13576',
                                                                                           '$selectDateExplode1', 
                                                                                           '$selectDateExplode1',  
                                                                                           '$selectDateExplode1',  
													'$selectDateExplode0', 
                                                                                           '$username', 
                                                                                           '$SFdatetime', 
                                                                                           '$username', 
                                                                                           '$SFdatetime')";

			$query_1 = $connect->query($sql_1);

			
	
	}

	// condition start
	// $query_0 = $connect->query($sql_0);

	if($query_1 == TRUE) {

				$get_total_leave = mysqli_fetch_array(mysqli_query($connect , "SELECT 
														SUM(total_days) AS total 
														FROM hrdleavecancelrequest
													WHERE `request_no` = '$SFnumbercon'"));
				
				$sq1_0    = mysqli_query($connect, "INSERT INTO hrmleavecancelrequest 
                                                                      (
                                                                             `request_no`, 
                                                                             `company_id`, 
                                                                             `requestedby`, 
                                                                             `requestfor`, 
                                                                             `requestdate`, 
                                                                             `leaverequest_no`, 
                                                                             `leave_code`, 
                                                                             `totaldays`, 
                                                                             `remark`, 
                                                                             `approval_status`, 
                                                                             `created_by`, 
                                                                             `created_date`, 
                                                                             `modified_by`, 
                                                                             `modified_date`, 
                                                                             `request_type`) 
                                                                                    VALUES 
                                                                                           (
                                                                                           '$SFnumbercon',
                                                                                           '13576', 
                                                                                           '$var_request_emp_id[emp_id]', 
                                                                                           '$var_emp_id[emp_id]', 
                                                                                           '$SFdatetime', 
                                                                                           '$inp_reqleavenumber', 
                                                                                           '$modal_leave', 
                                                                                           '$get_total_leave[total]', 
                                                                                           '$inp_remark',
                                                                                           '0',  
                                                                                           '$username', 
                                                                                           '$SFdatetime', 
                                                                                           '$username', 
                                                                                           '$SFdatetime', 
                                                                                           '1')");

				//MENCARI APPROVER DARI FORMULA LEAVE YANG ADA DI DB CONFIG
				//MENCARI APPROVER DARI FORMULA LEAVE YANG ADA DI DB CONFIG
				$get_approver_setting = mysqli_query($connect,"SELECT 
											REPLACE(a.request_approval_formula, '*', '') as request_approval_formula,
											a.position_id,
											b.seq_id,
											a.request_approval_name,
											a.req,
											a.ordering
											FROM tclcreqappsetting_final_fantasy_final a
											LEFT JOIN tclcreqappsetting_final b on a.seq_id=b.seq_id
											LEFT JOIN hrmorgstruc c on b.position_id=c.pos_code
											LEFT JOIN view_employee d on c.position_id=d.position_id

											WHERE d.emp_no='$modal_emp'
											and b.status_use = '1'");

				$get_approver_setting_sf = mysqli_num_rows($get_approver_setting);
				if($get_approver_setting_sf > 0){
					$modal_approval            = mysqli_query($connect, "SELECT 
													REPLACE(a.request_approval_formula, '*', '') as request_approval_formula,
													a.position_id,
													b.seq_id,
													a.request_approval_name,
													a.req,
													a.ordering
												FROM tclcreqappsetting_final_fantasy_final a
												LEFT JOIN tclcreqappsetting_final b on a.seq_id=b.seq_id
												LEFT JOIN hrmorgstruc c on b.position_id=c.pos_code
												LEFT JOIN view_employee d on c.position_id=d.position_id

												WHERE d.emp_no='$modal_emp'
												and b.status_use = '1'");   
				} else {
					$modal_approval = mysqli_query($connect, 
											"SELECT 
											a.emp_no as seq_id,
											a.empno_appvr1,
											x2.position_id,
											x2.pos_code as request_approval_formula,
											'Notification' as req,
											'0' as ordering
											FROM tclcdreqappsetting a
											LEFT JOIN view_employee x1 on a.emp_no=x1.emp_no
											LEFT JOIN view_employee x2 on a.empno_appvr1=x2.emp_no
											where a.emp_no = '$modal_emp' and
												a.empno_appvr1 is not null and
												a.request_type = 'Attendance.leave' and
												a.empno_appvr1 <> ''

												UNION ALL

												SELECT 
												a.emp_no as seq_id,
												a.empno_appvr2,
												x2.position_id,
												x2.pos_code as request_approval_formula,
												'Sequence' as req,
												'0' as ordering
												FROM tclcdreqappsetting a
												LEFT JOIN view_employee x1 on a.emp_no=x1.emp_no
												LEFT JOIN view_employee x2 on a.empno_appvr2=x2.emp_no
												where a.emp_no = '$modal_emp' and
													a.empno_appvr2 is not null and
													a.request_type = 'Attendance.leave' and
													a.empno_appvr2 <> ''

													UNION ALL

													SELECT 
													a.emp_no as seq_id,
													a.empno_appvr3,
													x2.position_id,
													x2.pos_code as request_approval_formula,
													'Required' as req,
													'0' as ordering
													FROM tclcdreqappsetting a
													LEFT JOIN view_employee x1 on a.emp_no=x1.emp_no
													LEFT JOIN view_employee x2 on a.empno_appvr3=x2.emp_no
													where a.emp_no = '$modal_emp' and
														a.empno_appvr3 is not null and
														a.request_type = 'Attendance.leave' and
														a.empno_appvr3 <> ''
												");
											}

				while($r=mysqli_fetch_array($modal_approval)){
					/**
					 *
					 * '||''|.                            '||
					 *  ||   ||    ....  .... ...   ....   ||    ...   ... ...  ... ..
					 *  ||    || .|...||  '|.  |  .|...||  ||  .|  '|.  ||'  ||  ||' ''
					 *  ||    || ||        '|.|   ||       ||  ||   ||  ||    |  ||
					 * .||...|'   '|...'    '|     '|...' .||.  '|..|'  ||...'  .||.
					 *                                                  ||
					 * --------------- By Display:inline ------------- '''' -----------
					 */
					$var1 = $r['request_approval_formula'];

					$var2 = mysqli_fetch_array(mysqli_query($connect, 
										"SELECT 
										b.pos_code 
										FROM 
										view_employee a 
										LEFT JOIN hrmorgstruc b on a.position_id=b.position_id 
										WHERE a.emp_no = '$username'"));
					
						if ($var1 == $var2['pos_code']) {
							$lvsts = '1';
						} else {
							$lvsts = '0';
						}
					
					$var3 = mysqli_fetch_array(mysqli_query($connect, "SELECT
													a.emp_no,
													b.position_id,
													e.pos_code,
													c.seq_id,
													d.req,
													f.emp_no
												FROM view_employee a
												LEFT JOIN hrmorgstruc b on a.position_id=b.position_id
												LEFT JOIN tclcreqappsetting_final c on b.pos_code=c.position_id
												LEFT JOIN tclcreqappsetting_final_fantasy_final d on c.seq_id=d.seq_id and d.req IN ('Sequence','Required')
												LEFT JOIN hrmorgstruc e on REPLACE(d.request_approval_formula, '*', '')=e.pos_code
												LEFT JOIN view_employee f on e.position_id=f.position_id
												WHERE a.emp_no = '$emp_print' and f.emp_no='$username'"));
					
					!empty($var3['pos_code']) ? $var3_print = $var3['pos_code'] : $var3_print = '0';
					
					if ($var1 == $var3_print) {
						$lvreqsts = '2';
					} else {
						$lvreqsts = '1';
					}

					$process_approval = mysqli_query($connect, "INSERT INTO hrmrequestapproval 
											(
												`request_no`, 
												`approval_list`,
												`position_id`,
												`seq_id`,
												`req`,
												`status`,
												`ordering`,
												`request_status`
											) 
												VALUES 
													(
														'$SFnumbercon', 
														'$r[request_approval_formula]', 
														'$r[position_id]', 
														'$r[seq_id]',  
														'$r[req]',
														'$lvsts',
														'$r[ordering]',
														'$lvreqsts'
													)");
					}

				$validator['success'] = false;
				$validator['code'] = "success_message";
				$validator['messages'] = "Successfully submit leave cancellation";			
			} else {		
				$validator['success'] = false;
				$validator['code'] = "failed_message";
				$validator['messages'] = "Failed submit leave cancellation";	
			}
	
	// condition ends

	// close the database connection
	$connect->close();
	echo json_encode($validator);
}