<?php 
require_once '../../../application/config.php';

$user = $_GET['user'];

//--GET AUTHORIIZATION--||--GET AUTHORIIZATION--||--GET AUTHORIIZATION--||--GET AUTHORIIZATION--||--GET AUTHORIIZATION--
//--GET AUTHORIIZATION--||--GET AUTHORIIZATION--||--GET AUTHORIIZATION--||--GET AUTHORIIZATION--||--GET AUTHORIIZATION--
	$req 								= mysqli_query($connect, "SET SESSION group_concat_max_len = 100000");
	$req_app 							= mysqli_query($connect, "SELECT emp_no, 
																	GROUP_CONCAT(Authorized_formula ORDER BY Authorized_Group ASC SEPARATOR ',') AS formula 
																			FROM hrmgroupdata
																			WHERE 
																			emp_no = '$user' AND 
																			Authorized_formula <> '' AND 
																			Authorized_formula IS NOT NULL
																			GROUP BY emp_no");
														$SQLSS = "SELECT emp_no, 
														GROUP_CONCAT(Authorized_formula ORDER BY Authorized_Group ASC SEPARATOR ',') AS formula 
																FROM hrmgroupdata
																WHERE 
																emp_no = '$user' AND 
																Authorized_formula <> '' AND 
																Authorized_formula IS NOT NULL
																GROUP BY emp_no";


				
	$var_having_formula 				= mysqli_fetch_array($req_app);
			
	if(mysqli_num_rows($req_app) > 0) {
		$var1 = array(",",);
		$var2 = array("','");
		$conversion_formula = str_replace($var1, $var2, $var_having_formula['formula']);
		// $conversion_formula_print = "b.id IN ('$conversion_formula')"; 
		$conversion = $conversion_formula; 
	} else {
		$conversion = "a.emp_no = '$user'"; 
	}	
	
				
	!empty($_GET['src_emp_no']) ? $getdata1 = '1' : $getdata1 = '0';

	if($getdata1 == 1) {
		$where_srvside = "WHERE (a.emp_no LIKE '%$_GET[src_emp_no]%')AND ($conversion)";
	} else {
		$where_srvside = "WHERE ($conversion)";
	}
//--GET AUTHORIIZATION--||--GET AUTHORIIZATION--||--GET AUTHORIIZATION--||--GET AUTHORIIZATION--||--GET AUTHORIIZATION--
//--GET AUTHORIIZATION--||--GET AUTHORIIZATION--||--GET AUTHORIIZATION--||--GET AUTHORIIZATION--||--GET AUTHORIIZATION--

$output = array('data' => array());

$sql = "SELECT 
a.*,
substring(a.cost_code, 1, 3) as cost_codex,
DATE_FORMAT(a.start_date, '%d %b %Y') as join_date

FROM view_employee a
LEFT JOIN hrmworklocation b on a.worklocation_code=b.worklocation_code
$where_srvside
ORDER BY a.Full_name asc";

$query = mysqli_query($connect, $sql);

$x = 1;
while ($row = mysqli_fetch_assoc($query)) {

	$rmintf = '<img src="../../asset/emp_photos/'.$row['photo'].'" alt="user" class="profile-pic rounded-circle" width="30"> <a type="button" nowrap="nowrap" data-toggle="modal" data-target="#UpdateForm" data-backdrop="static" style="color: orange; border: 5px; cursor:pointer;font-weight: bold;font-size: 13px;" onclick="editMember(`'.$row['emp_no'].'`)">'.$row['emp_id'].'</a>  <br> <label style="padding-top: 4px;color: #A5B0B7 !important;">'.$row['Full_Name'].' </label>';

	$output['data'][] = array(
		$rmintf
	);

	$x++;
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP