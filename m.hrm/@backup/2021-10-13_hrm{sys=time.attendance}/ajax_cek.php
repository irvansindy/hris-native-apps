<?php
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0'; 
if($getdata == 0) {
	include "../../application/session/session.php";
} else {
	include "../../application/session/mobile.session.php";	
}
?>

<?php 
include "../../application/config.php";


if(empty($_GET['modal_emp'])){
       $nip = '';
} else {
       $nip = $_GET['modal_emp'];
       $qPosEmp    = mysqli_fetch_array(mysqli_query($connect, "SELECT position_id FROM view_employee WHERE emp_no = '$username'"));
}

              $req 		= mysqli_query($connect, "SET SESSION group_concat_max_len = 100000");
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
											LEFT JOIN view_employeemidtemp b on b.position_id = a.position_id
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
			
		
			
                     $where = "WHERE ($conversion) AND a.emp_no='$nip'";
					


$query = mysqli_query($connect, "SELECT 
                                   a.*,
                                   b.status,
                                   DATE_FORMAT(a.start_date, '%d %b %Y') as join_date

                                   FROM view_employee a
                                   LEFT JOIN teodempcompany b on a.emp_id=b.emp_id


                                   $where 

                                   ORDER BY a.Full_name asc");

$hrs = mysqli_fetch_array($query);

$data = array(
            'nama'          =>  $hrs['Full_Name'],
            'nik'           =>  $hrs['emp_no']);
 echo json_encode($data);
?>