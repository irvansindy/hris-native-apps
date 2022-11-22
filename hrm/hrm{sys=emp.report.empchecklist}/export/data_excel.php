<?php 
include "../../../application/session/session_ess.php";

$checklist_type = $_POST['checklist_type'];
$include_completed = $_POST['include_completed'];
$req_employee = json_encode($_POST['req_employee'],TRUE);
$replace1 = str_replace('[', '', $req_employee);
$replace2 = str_replace(']', '', $replace1);
$replace3 = str_replace('"\"', '"', $replace2);
$replace5 = str_replace('\""', '"', $replace3);
$replace4 = str_replace('\"', '"', $replace5);

$sql_emp_checklist = mysqli_query($connect, "SELECT 
a.emp_no,
a.Full_Name,
orgunit.pos_name_en AS orgunit_name,
a.pos_name_en AS position_name,
DATE_FORMAT(a.start_date, '%d %M %Y') AS start_date,
DATE_FORMAT(a.end_date, '%d %M %Y') AS end_date
FROM view_employee a 
LEFT JOIN (
SELECT z.pos_name_en, z.position_id FROM hrmorgstruc z
) orgunit ON orgunit.position_id = a.parent_id
WHERE a.emp_no IN ($replace4)");
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
    <p style="font-weight:bold; font-size:16px; margin-bottom:2px">Employee Checklist Report</p>
</div>

<table border="1" width="100%" id="view_req" name="view_req">
    <tr>
        <td rowspan="2" style="text-align:center">
            <p style="font-weight:bold">No</p>
        </td>
        <td rowspan="2" style="text-align:center">
            <p style="font-weight:bold">Employee No</p>
        </td>
        <td rowspan="2" style="text-align:center">
            <p style="font-weight:bold">Employee Name</p>
        </td>
        <td rowspan="2" style="text-align:center">
            <p style="font-weight:bold">Organization Unit</p>
        </td>
        <td rowspan="2" style="text-align:center">
            <p style="font-weight:bold">Position</p>
        </td>
        <td rowspan="2" style="text-align:center">
            <p style="font-weight:bold">Join Date</p>
        </td>
        <td rowspan="2" style="text-align:center">
            <p style="font-weight:bold">End Date</p>
        </td>
        <td colspan="4" style="text-align:center">
            <p style="font-weight:bold">Checklist</p>
        </td>
    </tr>
    <tr>
        <td style="text-align:center">
            <p style="font-weight:bold">Item</p>
        </td>
        <td style="text-align:center">
            <p style="font-weight:bold">Completed</p>
        </td>
        <td style="text-align:center">
            <p style="font-weight:bold">Date</p>
        </td>
        <td style="text-align:center">
            <p style="font-weight:bold">Remark</p>
        </td>
    </tr>
    <?php 
    $no = 1;
    while($data_emp_checklist = mysqli_fetch_assoc($sql_emp_checklist)){
    $no_validasi = 1;
    $sql_item_checklist = mysqli_query($connect, "SELECT 
    b.facility_name,
    CASE
       WHEN a.completed = '1' THEN 'YES'
       WHEN a.completed = '0' THEN 'NO'
    END AS completed_status,
    DATE_FORMAT(a.completed_date, '%d %M %Y') AS completed_date,
    a.remark
    FROM teodempchecklist a
    LEFT JOIN teomfacility b ON a.checklist_code = b.facility_code
    WHERE a.emp_id IN (SELECT emp_id FROM view_employee WHERE emp_no = '$data_emp_checklist[emp_no]') AND  a.checklistgroup_code = '$checklist_type'");

    $count_item = mysqli_num_rows($sql_item_checklist);

    while($data_item = mysqli_fetch_assoc($sql_item_checklist)){
    ?>
    <?php 
    if($no_validasi == '1'){
    ?>
    <tr>
        <td rowspan="<?php echo $count_item; ?>">
            <p ><?php echo $no; ?></p>
        </td>
        <td rowspan="<?php echo $count_item; ?>">
            <p ><?php echo $data_emp_checklist['emp_no']; ?></p>
        </td>
        <td rowspan="<?php echo $count_item; ?>">
            <p ><?php echo $data_emp_checklist['Full_Name']; ?></p>
        </td>
        <td rowspan="<?php echo $count_item; ?>">
            <p ><?php echo $data_emp_checklist['orgunit_name']; ?></p>
        </td>
        <td rowspan="<?php echo $count_item; ?>">
            <p ><?php echo $data_emp_checklist['position_name']; ?></p>
        </td>
        <td rowspan="<?php echo $count_item; ?>">
            <p ><?php echo $data_emp_checklist['start_date']; ?></p>
        </td>
        <td rowspan="<?php echo $count_item; ?>">
            <p ><?php echo $data_emp_checklist['end_date']; ?></p>
        </td>
        <td>
            <p ><?php echo $data_item['facility_name']; ?></p>
        </td>
        <td>
            <p ><?php echo $data_item['completed_status']; ?></p>
        </td>
        <td>
            <p ><?php echo $data_item['completed_date']; ?></p>
        </td>
        <td>
            <p ><?php echo $data_item['remark']; ?></p>
        </td>
    </tr>
    <?php }else{ ?>
        <td>
            <p ><?php echo $data_item['facility_name']; ?></p>
        </td>
        <td>
            <p ><?php echo $data_item['completed_status']; ?></p>
        </td>
        <td>
            <p ><?php echo $data_item['completed_date']; ?></p>
        </td>
        <td>
            <p ><?php echo $data_item['remark']; ?></p>
        </td>
    <?php } ?>
    <?php $no_validasi++; } $no++; } ?>
</table>