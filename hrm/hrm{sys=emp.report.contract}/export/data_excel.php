<?php 
include "../../../application/session/session_ess.php";

$org_unit = $_POST['org_unit'];
$work_location = $_POST['work_location'];
$employment_status = $_POST['employment_status'];
$start_date = $_POST['start_date'];

// Filter
if($org_unit == '' && $work_location == '' && $employment_status == ''){
    $where = "WHERE DATE(contract.employment_enddate) <= '$start_date'";
}elseif($org_unit == '' && $work_location == '' && $employment_status != ''){
    $where = "WHERE DATE(contract.employment_enddate) <= '$start_date' AND contract.employmentstatus_code = '$employment_status'";
}elseif($org_unit == '' && $work_location != '' && $employment_status == ''){
    $where = "WHERE DATE(contract.employment_enddate) <= '$start_date' AND a.worklocation_code = '$work_location'";
}elseif($org_unit == '' && $work_location != '' && $employment_status != ''){
    $where = "WHERE DATE(contract.employment_enddate) <= '$start_date' AND contract.employmentstatus_code = '$employment_status' AND a.worklocation_code = '$work_location'";
}elseif($org_unit != '' && $work_location == '' && $employment_status == ''){
    $where = "WHERE DATE(contract.employment_enddate) <= '$start_date' AND a.parent_path LIKE '%$org_unit%'";
}elseif($org_unit != '' && $work_location == '' && $employment_status != ''){
    $where = "WHERE DATE(contract.employment_enddate) <= '$start_date' AND a.parent_path LIKE '%$org_unit%' AND contract.employmentstatus_code = '$employment_status'";
}elseif($org_unit != '' && $work_location != '' && $employment_status == ''){
    $where = "WHERE DATE(contract.employment_enddate) <= '$start_date' AND a.parent_path LIKE '%$org_unit%' AND a.worklocation_code = '$work_location'";
}elseif($org_unit != '' && $work_location != '' && $employment_status != ''){
    $where = "WHERE DATE(contract.employment_enddate) <= '$start_date' AND a.parent_path LIKE '%$org_unit%' AND a.worklocation_code = '$work_location' AND contract.employmentstatus_code = '$employment_status'";
}

$sql_get_contract = mysqli_query($connect, "SELECT 
a.emp_no,
a.Full_Name,
a.pos_name_en,
contract.grade_code,
b.employmentstatus_name_en,
DATE_FORMAT(contract.effectivedt, '%d %M %Y') AS start_date,
DATE_FORMAT(contract.employment_enddate, '%d %M %Y') AS end_date
FROM view_employee a
LEFT JOIN 
(
SELECT z.effectivedt AS effective_date, z.emp_id, z.effectivedt, z.employment_enddate, z.grade_code, z.employmentstatus_code
FROM hrmemploymenthistory z 
WHERE (z.employmentstatus_code = 'CNTR' 
OR z.employmentstatus_code = 'DAYC' 
OR z.employmentstatus_code = 'EXPT' 
OR z.employmentstatus_code = 'PROB'
OR z.employmentstatus_code = 'PROBD')
AND z.enddt IS NULL
) contract ON contract.emp_id = a.emp_id
LEFT JOIN teomemploymentstatus b ON b.employmentstatus_code = contract.employmentstatus_code
$where");
?>

<style>
body {
	background-color:white;
	font-family:Verdana; 
	font-size:8pt;
}
table {
	border-collapse:collapse;
}
td {
	background-color:white;
	padding:2px 4px 2px 4px;
	font:8pt Verdana;
	
	vertical-align:top;
}
</style>



<div style="text-align:center">
    <p style="font-weight:bold; font-size:16px; margin-bottom:2px">Employee Contract Report</p>
</div>

<table border="1" width="100%" id="view_req" name="view_req">
    <tr>
        <td style="text-align:center">
            <p style="font-weight:bold">No</p>
        </td>
        <td style="text-align:center">
            <p style="font-weight:bold">Employee No</p>
        </td>
        <td style="text-align:center">
            <p style="font-weight:bold">Employee Name</p>
        </td>
        <td style="text-align:center">
            <p style="font-weight:bold">Position</p>
        </td>
        <td style="text-align:center">
            <p style="font-weight:bold">Grade</p>
        </td>
        <td style="text-align:center">
            <p style="font-weight:bold">Employment Status</p>
        </td>
        <td style="text-align:center">
            <p style="font-weight:bold">Contract Start Date</p>
        </td>
        <td style="text-align:center">
            <p style="font-weight:bold">Contract End Date</p>
        </td>
    </tr>
    <?php 
    $no = 1;
    while($data_contract = mysqli_fetch_assoc($sql_get_contract)){
    ?>
    <tr>
        <td>
            <p ><?php echo $no; ?></p>
        </td>
        <td>
            <p ><?php echo $data_contract['emp_no']; ?></p>
        </td>
        <td>
            <p ><?php echo $data_contract['Full_Name']; ?></p>
        </td>
        <td>
            <p ><?php echo $data_contract['pos_name_en']; ?></p>
        </td>
        <td>
            <p ><?php echo $data_contract['grade_code']; ?></p>
        </td>
        <td>
            <p ><?php echo $data_contract['employmentstatus_name_en']; ?></p>
        </td>
        <td>
            <p ><?php echo $data_contract['start_date']; ?></p>
        </td>
        <td>
            <p ><?php echo $data_contract['end_date']; ?></p>
        </td>
    </tr>
    <?php $no++; } ?>
</table>
