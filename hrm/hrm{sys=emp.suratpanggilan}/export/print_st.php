<?php 
include "../../../application/session/session_ess.php";


$username           = $_SESSION['username'];

// Validasi can see all
$sql_view_all = mysqli_query($connect, "SELECT 
a.view_all
FROM hrmconselor a
LEFT JOIN view_employee b ON b.pos_code = a.pos_code
WHERE b.emp_no = '$username'");

$data_view_all = mysqli_fetch_assoc($sql_view_all);

$sql_get_worklocation = mysqli_query($connect, "SELECT 
a.worklocation_code
FROM view_employee a WHERE a.emp_no = '$username'");

$get_worklocation = mysqli_fetch_assoc($sql_get_worklocation);

$print_periode_start = $_POST['periode_start'];
$print_periode_end = $_POST['periode_end'];
$print_tipe_sanksi = $_POST['print_tipe_sanksi'];
$print_empno = $_POST['print_empno'];

if($data_view_all['view_all'] == '1'){
    if($print_periode_start == '' && $print_tipe_sanksi == '' && $print_empno == ''){
        $where = '';
    }else if($print_periode_start == '' && $print_tipe_sanksi == '' && $print_empno != ''){
        $where = "WHERE a.to_empno = '$print_empno'";
    }else if($print_periode_start == '' && $print_tipe_sanksi != '' && $print_empno == ''){
        $where = "WHERE e.penalty_type = '$print_tipe_sanksi'";
    }else if($print_periode_start == '' && $print_tipe_sanksi != '' && $print_empno != ''){
        $where = "WHERE e.penalty_type = '$print_tipe_sanksi' AND a.to_empno = '$print_empno'";
    }else if($print_periode_start != '' && $print_tipe_sanksi == '' && $print_empno == ''){
        $where = "WHERE (DATE(a.tanggal) >= '$print_periode_start' AND DATE(a.tanggal) <= '$print_periode_end')";
    }else if($print_periode_start != '' && $print_tipe_sanksi == '' && $print_empno != ''){
        $where = "WHERE (DATE(a.tanggal) >= '$print_periode_start' AND DATE(a.tanggal) <= '$print_periode_end') AND a.to_empno = '$print_empno'";
    }else if($print_periode_start != '' && $print_tipe_sanksi != '' && $print_empno == ''){
        $where = "WHERE (DATE(a.tanggal) >= '$print_periode_start' AND DATE(a.tanggal) <= '$print_periode_end') AND e.penalty_type = '$print_tipe_sanksi'";
    }else if($print_periode_start != '' && $print_tipe_sanksi != '' && $print_empno == ''){
        $where = "WHERE (DATE(a.tanggal) >= '$print_periode_start' AND DATE(a.tanggal) <= '$print_periode_end') AND e.penalty_type = '$print_tipe_sanksi' AND a.to_empno = '$print_empno'";
    }
}else{
    if($print_periode_start == '' && $print_tipe_sanksi == '' && $print_empno == ''){
        $where = "WHERE a.work_location LIKE '%$get_worklocation[worklocation_code]%'";
    }else if($print_periode_start == '' && $print_tipe_sanksi == '' && $print_empno != ''){
        $where = "WHERE a.to_empno = '$print_empno' AND a.work_location LIKE '%$get_worklocation[worklocation_code]%'";
    }else if($print_periode_start == '' && $print_tipe_sanksi != '' && $print_empno == ''){
        $where = "WHERE e.penalty_type = '$print_tipe_sanksi' AND a.work_location LIKE '%$get_worklocation[worklocation_code]%'";
    }else if($print_periode_start == '' && $print_tipe_sanksi != '' && $print_empno != ''){
        $where = "WHERE e.penalty_type = '$print_tipe_sanksi' AND a.to_empno = '$print_empno' AND a.work_location LIKE '%$get_worklocation[worklocation_code]%'";
    }else if($print_periode_start != '' && $print_tipe_sanksi == '' && $print_empno == ''){
        $where = "WHERE (DATE(a.tanggal) >= '$print_periode_start' AND DATE(a.tanggal) <= '$print_periode_end') AND a.work_location LIKE '%$get_worklocation[worklocation_code]%'";
    }else if($print_periode_start != '' && $print_tipe_sanksi == '' && $print_empno != ''){
        $where = "WHERE (DATE(a.tanggal) >= '$print_periode_start' AND DATE(a.tanggal) <= '$print_periode_end') AND a.to_empno = '$print_empno' AND a.work_location LIKE '%$get_worklocation[worklocation_code]%'";
    }else if($print_periode_start != '' && $print_tipe_sanksi != '' && $print_empno == ''){
        $where = "WHERE (DATE(a.tanggal) >= '$print_periode_start' AND DATE(a.tanggal) <= '$print_periode_end') AND e.penalty_type = '$print_tipe_sanksi' AND a.work_location LIKE '%$get_worklocation[worklocation_code]%'";
    }else if($print_periode_start != '' && $print_tipe_sanksi != '' && $print_empno == ''){
        $where = "WHERE (DATE(a.tanggal) >= '$print_periode_start' AND DATE(a.tanggal) <= '$print_periode_end') AND e.penalty_type = '$print_tipe_sanksi' AND a.to_empno = '$print_empno' AND a.work_location LIKE '%$get_worklocation[worklocation_code]%'";
    }
}

$sql_report = mysqli_query($connect, "SELECT 
a.noref,
a.to_empno,
b.Full_Name AS nama,
b.cost_code AS bagian,
c.shiftgroupcode,
d.employmentstatus_name_en,
a.tanggal AS tanggal_panggilan,
a.waktu AS waktu_panggilan,
DATE_FORMAT(e.coounseling_date, '%Y-%m-%d') AS tanggal_konseling,
f.Full_Name AS consellor,
DATE_FORMAT(e.penalty_date, '%Y-%m-%d') AS tanggal_sanksi,
g.penalty_name,
a.masalah,
CASE
   WHEN e.`status` = '0' THEN 'Open'
   WHEN e.`status` = '1' THEN 'Closed'
END AS status_pengajuan
FROM hrddisciplineshistory a
LEFT JOIN view_employee b ON a.to_empno = b.emp_no
LEFT JOIN curshiftgroup c ON c.emp_id = b.emp_id
LEFT JOIN teomemploymentstatus d ON d.employmentstatus_code = b.employ_code
LEFT JOIN hrmcouseling e ON e.noref = a.noref
LEFT JOIN view_employee f ON f.emp_no = e.conselor
LEFT JOIN hrmpenaltytype g ON g.penalty_id = e.penalty_type
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

<form method="post" id="" action="export/print_excel.php">
<input type="hidden" name="print_periode_start" value="<?php echo $print_periode_start ?>">
<input type="hidden" name="print_periode_end" value="<?php echo $print_periode_end ?>">
<input type="hidden" name="print_tipe_sanksi" value="<?php echo $print_tipe_sanksi; ?>">
<input type="hidden" name="print_empno" value="<?php echo $print_empno; ?>">


<div>
    <table>
        <tr>
            <td>
                <button>
                <img src="../../asset/img/icons/excel.png" alt="">
                </button>
                <!-- <a href="#" id="test"><img src="../../asset/img/icons/excel.png" alt=""></a> -->
            </td>
        </tr>
    </table>
</div>
</form>

<div style="text-align:center">
    <p style="font-weight:bold; font-size:16px; margin-bottom:0px">Employee Request Report</p>
</div>
<div style="text-align:center">
    <p style="font-size:12px">Periode : <?php echo $print_periode_start; ?> / <?php echo $print_periode_end; ?></p>
</div>

<table border="1" width="100%">
    <tr>
        <td style="text-align:center; background:#F0F0F0">
            <p style="font-weight:bold">No</p>
        </td>
        <td style="text-align:center; background:#F0F0F0">
            <p style="font-weight:bold">Ref No</p>
        </td>
        <td style="text-align:center; background:#F0F0F0">
            <p style="font-weight:bold">NIP</p>
        </td>
        <td style="text-align:center; background:#F0F0F0">
            <p style="font-weight:bold">Nama</p>
        </td>
        <td style="text-align:center; background:#F0F0F0">
            <p style="font-weight:bold">Bagian</p>
        </td>
        <td style="text-align:center; background:#F0F0F0">
            <p style="font-weight:bold">Group</p>
        </td>
        <td style="text-align:center; background:#F0F0F0">
            <p style="font-weight:bold">Employment Status</p>
        </td>
        <td style="text-align:center; background:#F0F0F0">
            <p style="font-weight:bold">Tanggal Panggilan</p>
        </td>
        <!-- <td style="text-align:center; background:#F0F0F0">
            <p style="font-weight:bold">Hari</p>
        </td> -->
        <td style="text-align:center; background:#F0F0F0">
            <p style="font-weight:bold">Waktu</p>
        </td>
        <td style="text-align:center; background:#F0F0F0">
            <p style="font-weight:bold">Tanggal Konseling</p>
        </td>
        <!-- <td style="text-align:center; background:#F0F0F0">
            <p style="font-weight:bold">Tanggal Realisasi</p>
        </td> -->
        <td style="text-align:center; background:#F0F0F0">
            <p style="font-weight:bold">Konselor</p>
        </td>
        <td style="text-align:center; background:#F0F0F0">
            <p style="font-weight:bold">Tanggal Sanksi</p>
        </td>
        <td style="text-align:center; background:#F0F0F0">
            <p style="font-weight:bold">Tipe Sanksi</p>
        </td>
        <td style="text-align:center; background:#F0F0F0">
            <p style="font-weight:bold">Keterangan</p>
        </td>
        <td style="text-align:center; background:#F0F0F0">
            <p style="font-weight:bold">Status</p>
        </td>
    </tr>
    <?php 
    $no = 1;
    while($data_report = mysqli_fetch_assoc($sql_report)){
    ?>
    <tr>
        <td>
            <p><?php echo $no; ?></p>
        </td>
        <td>
            <p><?php echo $data_report['noref']; ?></p>
        </td>
        <td>
            <p><?php echo $data_report['to_empno']; ?></p>
        </td>
        <td>
            <p><?php echo $data_report['nama']; ?></p>
        </td>
        <td>
            <p><?php echo $data_report['bagian']; ?></p>
        </td>
        <td>
            <p><?php echo $data_report['shiftgroupcode']; ?></p>
        </td>
        <td>
            <p><?php echo $data_report['employmentstatus_name_en']; ?></p>
        </td>
        <td>
            <p><?php echo $data_report['tanggal_panggilan']; ?></p>
        </td>
        <td>
            <p><?php echo $data_report['waktu_panggilan']; ?></p>
        </td>
        <td>
            <p><?php echo $data_report['tanggal_konseling']; ?></p>
        </td>
        <td>
            <p><?php echo $data_report['consellor']; ?></p>
        </td>
        <td>
            <p><?php echo $data_report['tanggal_sanksi']; ?></p>
        </td>
        <td>
            <p><?php echo $data_report['penalty_name']; ?></p>
        </td>
        <td>
            <p><?php echo $data_report['masalah']; ?></p>
        </td>
        <td>
            <p><?php echo $data_report['status_pengajuan']; ?></p>
        </td>
    </tr>
    <?php $no++; } ?>
</table>

