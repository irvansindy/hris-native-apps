<?php 
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
// BUAT KONVERSI DARI SUNFISH KE TABLE HRIS TIME & ATTENDANCE AGAR DAPAT DI CONSUME OLEH APP
// BUAT KONVERSI DARI SUNFISH KE TABLE HRIS TIME & ATTENDANCE AGAR DAPAT DI CONSUME OLEH APP
$var1_grouping					= mysqli_query($connect, "SELECT 
var1, 
GROUP_CONCAT(var1 ORDER BY id ASC SEPARATOR '~') AS formula 
FROM db_config_str
WHERE remark LIKE '%EMP.MODULE%'
GROUP BY remark
ORDER BY id asc");
$var2_grouping					= mysqli_query($connect, "SELECT 
var2, 
GROUP_CONCAT(var2 ORDER BY id ASC SEPARATOR '~') AS formula 
FROM db_config_str
WHERE remark LIKE '%EMP.MODULE%'
GROUP BY remark
ORDER BY id asc");

$var1_grouping_arr 				= mysqli_fetch_array($var1_grouping);
$var2_grouping_arr 				= mysqli_fetch_array($var2_grouping);

$var1 = array("~");
$var2 = array('","');
$var1_grouping_arr_conversion 	= '"'.str_replace($var1, $var2, $var1_grouping_arr['formula']).'"'; 
$var2_grouping_arr_conversion 	= '"'.str_replace($var1, $var2, $var2_grouping_arr['formula']).'"'; 
// BUAT KONVERSI DARI SUNFISH KE TABLE HRIS TIME & ATTENDANCE AGAR DAPAT DI CONSUME OLEH APP
// BUAT KONVERSI DARI SUNFISH KE TABLE HRIS TIME & ATTENDANCE AGAR DAPAT DI CONSUME OLEH APP

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
?>

			<?php				
			$req 				= mysqli_query($connect, "SET SESSION group_concat_max_len = 100000");
			$req_app 			= mysqli_query($connect, "SELECT emp_no, 
											GROUP_CONCAT(Authorized_formula ORDER BY Authorized_Group ASC SEPARATOR ' or ') AS formula 
													FROM hrmgroupdata
													WHERE 
													emp_no = '$username' AND 
													Authorized_formula <> '' AND 
													Authorized_formula IS NOT NULL AND
													status_use = '1'
													GROUP BY emp_no");
				
			$check_having_formula = mysqli_num_rows($req_app);
			$var_having_formula = mysqli_fetch_array($req_app);

			$req_app_use_full_query	= mysqli_query($connect, "SELECT
											'$username' as user,
											a.position_id,
											a.parent_id,
											a.parent_path
											FROM hrmorgstruc a
											LEFT JOIN view_employee b on b.position_id = a.position_id
											where b.emp_no = '$username'");
			$check_having_formula_use_full_query 	= mysqli_num_rows($req_app_use_full_query);
			$var_having_formula_use_full_query 	= mysqli_fetch_array($req_app_use_full_query);
			
			$var_having_formula_use_full_query_user_print 		= $var_having_formula_use_full_query['user'];
			$var_having_formula_use_full_query_position_print 	= $var_having_formula_use_full_query['position_id'];
			$var_having_formula_use_full_query_parent_id_print 	= $var_having_formula_use_full_query['parent_id'];
			$var_having_formula_use_full_query_parent_path_print 	= $var_having_formula_use_full_query['parent_path'];

			// 22-03-2021_agus prasetya update group data formula whatsapp windy 
			
			// $qEmployee = mysqli_query($connect, "SELECT 
			// 						'$var_having_formula_use_full_query_user_print' as user_emp,
			// 						GROUP_CONCAT(b.emp_no ORDER BY b.emp_no ASC SEPARATOR '|') AS formula 
			// 						from hrmorgstruc a
			// 						left join view_employeemidtemp b on b.position_id = a.position_id
			// 						left join view_employeemidtemp c on c.emp_id = b.emp_id
			// 						left join hrmorgstruc d on d.position_id = b.position_id
			// 						where (a.parent_path like '%,$var_having_formula_use_full_query_position_print' or a.parent_path like '%,$var_having_formula_use_full_query_parent_id_print%')
			// 						and b.emp_no is not null
			// 						and case when b.end_date is null or b.end_date >= now() then 'aktif' else 'resign' end = 'aktif'
			// 						GROUP BY user_emp");
			$qEmployee = mysqli_query($connect, "SELECT 
									'$var_having_formula_use_full_query_user_print' as user_emp,
									GROUP_CONCAT(emp_no ORDER BY emp_no ASC SEPARATOR '|') AS formula 
									FROM
									(
										select 
										b.emp_no,c.full_name,d.pos_name_en as posisi,
										b.worklocation_code as Plant,Left(b.cost_code,3) as costcenter,
										case when b.end_date is null or b.end_date >= now() then 'aktif' else 'resign' end as statusemp,
										case when b.emp_no = '$var_having_formula_use_full_query_user_print' or a.parent_path <> '$var_having_formula_use_full_query_parent_path_print' then 'yes' else 'no' end as sts
										from hrmorgstruc a
										left join view_employee b on b.position_id = a.position_id
										left join view_employee c on c.emp_id = b.emp_id
										left join hrmorgstruc d on d.position_id = b.position_id
										where (a.parent_path like '%,$var_having_formula_use_full_query_position_print' or a.parent_path like '%,$var_having_formula_use_full_query_parent_id_print%')
										and b.emp_no is not null
									)groupdata
								where groupdata.sts = 'yes'");
			
			$qEmployeePrint = "SELECT 
									'$var_having_formula_use_full_query_user_print' as user_emp,
									GROUP_CONCAT(emp_no ORDER BY emp_no ASC SEPARATOR '|') AS formula 
									FROM
									(
										select 
										b.emp_no,c.full_name,d.pos_name_en as posisi,
										b.worklocation_code as Plant,Left(b.cost_code,3) as costcenter,
										case when b.end_date is null or b.end_date >= now() then 'aktif' else 'resign' end as statusemp,
										case when b.emp_no = '$var_having_formula_use_full_query_user_print' or a.parent_path <> '$var_having_formula_use_full_query_position_print' then 'yes' else 'no' end as sts
										from hrmorgstruc a
										left join view_employee b on b.position_id = a.position_id
										left join view_employee c on c.emp_id = b.emp_id
										left join hrmorgstruc d on d.position_id = b.position_id
										where (a.parent_path like '%,$var_having_formula_use_full_query_position_print' or a.parent_path like '%,$var_having_formula_use_full_query_parent_id_print%')
										and b.emp_no is not null
									)groupdata
								where groupdata.sts = 'yes'";

			// 22-03-2021_agus prasetya update group data formula whatsapp windy
			$var_having_formula_qEmployee = mysqli_fetch_array($qEmployee);
		
			if($var_having_formula_qEmployee && $check_having_formula == 0) {
				$var1 = array("emp_no","cost_code","parent_path","Parent_path","pos_name_en","grade_code","pos_code","AND","OR","|","`");
				$var2 = array("a.emp_no","a.cost_code","a.parent_path","a.parent_path","a.pos_name_en","a.grade_code","a.pos_code"," AND "," OR ","','","' ");
				$conversion_formula = str_replace($var1, $var2, $var_having_formula_qEmployee['formula']); 
				$conversion = "a.emp_no IN ('$conversion_formula')"; 
			} else {
				$var1 = array("emp_no","cost_code","parent_path","Parent_path","pos_name_en","grade_code","pos_code","AND","OR","|","`");
				$var2 = array("a.emp_no","a.cost_code","a.parent_path","a.parent_path","a.pos_name_en","a.grade_code","a.pos_code"," AND "," OR ","','","' ");
				$conversion_formula = str_replace($var1, $var2, $var_having_formula_qEmployee['formula']);
				$conversion_formula_print = "a.emp_no IN ('$conversion_formula')"; 
				$conversion = str_replace($var1, $var2, $var_having_formula['formula']). ' or '. $conversion_formula_print; 
			}
			
			if (!empty($_POST['inp_emp']) && !empty($_POST['inp_name']) && !empty($_POST['inp_active'])) {
				$identitynip = $_POST['inp_emp'];
				$identityname = $_POST['inp_name'];
				if($_POST['inp_active'] == '1') {
					$identityactive = $_POST['inp_active'];
				} else {
					$identityactive = '0';
				}	
				$where = "WHERE (a.emp_no like '$identitynip') AND (a.Full_Name like '%$identityname%') AND (b.status like '%$identityactive%') AND ($conversion)";
				$wherePrint = "(emp_no like '$identitynip') AND (Full_Name like '%$identityname%') AND (status like '%$identityactive%') ";
			
			} elseif (!empty($_POST['inp_emp']) && !empty($_POST['inp_name'])) {
				$identitynip = $_POST['inp_emp'];
				$identityname = $_POST['inp_name'];
				$where = "WHERE (a.emp_no like '$identitynip') AND (a.Full_Name like '%$identityname%') AND ($conversion)";
				$wherePrint = "(emp_no like '$identitynip') AND (Full_Name like '%$identityname%')";
			 
			} elseif (!empty($_POST['inp_emp']) && !empty($_POST['inp_active'])) {
				$identitynip = $_POST['inp_emp'];
				$identityname = '';
				if($_POST['inp_active'] == '1') {
					$identityactive = $_POST['inp_active'];
				} elseif($_POST['inp_active'] == '2') {
					$identityactive = '0';
				}
				$where = "WHERE (a.emp_no like '$identitynip') AND (b.status like '%$identityactive%') AND ($conversion)";
				$wherePrint = "(emp_no like '$identitynip') AND (status like '%$identityactive%')";

			} elseif (!empty($_POST['inp_name']) && !empty($_POST['inp_active'])) {
				$identitynip = '';
				$identityname = $_POST['inp_name'];
				if($_POST['inp_active'] == '1') {
					$identityactive = $_POST['inp_active'];
				} elseif($_POST['inp_active'] == '2') {
					$identityactive = '0';
				}
				$where = "WHERE (a.Full_Name like '$identityname') AND (b.status like '%$identityactive%') AND ($conversion)";
				$wherePrint = "(Full_Name like '$identityname') AND (status like '%$identityactive%')";

			} elseif (!empty($_POST['inp_emp'])) {
				$identitynip = $_POST['inp_emp'];
				$where = "WHERE (a.emp_no like '$identitynip') AND ($conversion)";
				$wherePrint = "(emp_no like '$identitynip'))";
			
			} elseif (!empty($_POST['inp_name'])) {
				$identityname = $_POST['inp_name'];
				$where = "WHERE (a.Full_Name like '%$identityname%') AND ($conversion)";
				$wherePrint = "(Full_Name like '%$identityname%')";
			
			} elseif (!empty($_POST['inp_active'])) {
				if($_POST['inp_active'] == '1') {
					$identityactive = $_POST['inp_active'];
				} else {
					$identityactive = '0';
				}	
				$where = "WHERE (b.status like '%$identityactive%') AND ($conversion)";
				$wherePrint = "(status like '%$identityactive%')";
			
			} else {
				$where = "WHERE b.status='1' AND ($conversion)";
			}
	
			if (isset($_POST["limit"], $_POST["start"])) {
				
				$limit = $_POST["start"];
				$page = $_POST["limit"];
			}else{
				$page = 0;
				$limit = 10;
			}

	?>






















<?php				
			$req 								= mysqli_query($connect, "SET SESSION group_concat_max_len = 100000");
			$req_app 							= mysqli_query($connect, "SELECT emp_no, 
											GROUP_CONCAT(Authorized_formula ORDER BY Authorized_Group ASC SEPARATOR ' or ') AS formula 
													FROM hrmgroupdata
													WHERE 
													emp_no = '$username' AND 
													Authorized_formula <> '' AND 
													Authorized_formula IS NOT NULL AND
													status_use = '1'
													GROUP BY emp_no");
				
			$check_having_formula 					= mysqli_num_rows($req_app);
			$var_having_formula 						= mysqli_fetch_array($req_app);

			$req_app_use_full_query					= mysqli_query($connect, "SELECT
												'$username' as user,
												a.position_id,
												a.parent_id,
												a.parent_path
												FROM hrmorgstruc a
												LEFT JOIN view_employee b on b.position_id = a.position_id
												where b.emp_no = '$username'");
			$check_having_formula_use_full_query 			= mysqli_num_rows($req_app_use_full_query);
			$var_having_formula_use_full_query 			= mysqli_fetch_array($req_app_use_full_query);
			
			$var_having_formula_use_full_query_user_print 		= $var_having_formula_use_full_query['user'];
			$var_having_formula_use_full_query_position_print 	= $var_having_formula_use_full_query['position_id'];
			$var_having_formula_use_full_query_parent_id_print 	= $var_having_formula_use_full_query['parent_id'];
			$var_having_formula_use_full_query_parent_path_print 	= $var_having_formula_use_full_query['parent_path'];

			$qEmployee = mysqli_query($connect, "SELECT 
									'$var_having_formula_use_full_query_user_print' as user_emp,
									GROUP_CONCAT(emp_no ORDER BY emp_no ASC SEPARATOR '|') AS formula 
									FROM
									(
										select 
										b.emp_no,c.full_name,d.pos_name_en as posisi,
										b.worklocation_code as Plant,Left(b.cost_code,3) as costcenter,
										case when b.end_date is null or b.end_date >= now() then 'aktif' else 'resign' end as statusemp,
										case when b.emp_no = '$var_having_formula_use_full_query_user_print' or a.parent_path <> '$var_having_formula_use_full_query_parent_path_print' then 'yes' else 'no' end as sts
										from hrmorgstruc a
										left join view_employee b on b.position_id = a.position_id
										left join view_employee c on c.emp_id = b.emp_id
										left join hrmorgstruc d on d.position_id = b.position_id
										where (a.parent_path like '%,$var_having_formula_use_full_query_position_print' or a.parent_path like '%,$var_having_formula_use_full_query_parent_id_print%')
										and b.emp_no is not null
									)groupdata
								where groupdata.sts = 'yes'");

			// 22-03-2021_agus prasetya update group data formula whatsapp windy
			$var_having_formula_qEmployee = mysqli_fetch_array($qEmployee);
		
			if($var_having_formula_qEmployee && $check_having_formula == 0) {
				$var1 = array("emp_no","cost_code","parent_path","Parent_path","pos_name_en","grade_code","pos_code","AND","OR","|","`");
				$var2 = array("a.emp_no","a.cost_code","a.parent_path","a.parent_path","a.pos_name_en","a.grade_code","a.pos_code"," AND "," OR ","','","' ");
				$conversion_formula = str_replace($var1, $var2, $var_having_formula_qEmployee['formula']); 
				$conversion = "a.emp_no IN ('$conversion_formula')"; 
			} else {
				$var1 = array("emp_no","cost_code","parent_path","Parent_path","pos_name_en","grade_code","pos_code","AND","OR","|","`");
				$var2 = array("a.emp_no","a.cost_code","a.parent_path","a.parent_path","a.pos_name_en","a.grade_code","a.pos_code"," AND "," OR ","','","' ");
				$conversion_formula = str_replace($var1, $var2, $var_having_formula_qEmployee['formula']);
				$conversion_formula_print = "a.emp_no IN ('$conversion_formula')"; 
				$conversion = str_replace($var1, $var2, $var_having_formula['formula']). ' or '. $conversion_formula_print; 
			}

			!empty($_GET['src_emp_no']) ? $getdata1 = '1' : $getdata1 = '0';
			!empty($_GET['src_cost_code']) ? $getdata2 = '1' : $getdata2 = '0';

			if($getdata1 == 1 && $getdata2 == 0) {
				
				$where_srvside = "WHERE (a.emp_no LIKE '%$_GET[src_emp_no]%') AND ($conversion)";
			} else {
				// $where_srvside = 
				$where_srvside = "WHERE b.status='1' AND ($conversion)";
			}


	?>