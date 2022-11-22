<script src="../../asset/admus/jquery.js"></script>

<?php 
include "../../application/session/session.php";

$req_type = $_POST['req_type'];
// $req_status = $_POST['req_status'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$req_employee_array = $_POST['req_employee'];
$req_employee = json_encode($_POST['req_employee'], TRUE);
$replace1 = str_replace('[', '', $req_employee);
$replace2 = str_replace(']', '', $replace1);

$req_waitapprove = $_POST['req_waitapprove'];
$req_showapprove = $_POST['req_showapprove'];

if(isset($_POST['req_status'])){
    $req_status = $_POST['req_status'];
}else{
    $req_status = '';
}



if(!isset($_POST['req_status']) && $req_type == ''){
    $kondisi = 1;
    $sql = mysqli_query($connect, "SELECT 
    DISTINCT(a.request_no),
    a.seq_id,
    b.Full_Name,
    a.request_type,
    DATE_FORMAT(a.created_date, '%d %M %Y') AS created_date,
    c.name_en AS status_pengajuan
    FROM hrmrequestapproval a 
    LEFT JOIN view_employee b ON a.seq_id = b.emp_no
    LEFT JOIN hrmstatus c ON c.code = a.request_status
    WHERE a.seq_id IN ($replace2)
    AND (DATE(a.created_date) >= '$start_date' AND DATE(a.created_date) <= '$end_date')
    ORDER BY a.created_date ASC");
}

if(!isset($_POST['req_status']) && $req_type != ''){
    $kondisi = 2;
    $sql = mysqli_query($connect, "SELECT 
    DISTINCT(a.request_no),
    a.seq_id,
    b.Full_Name,
    a.request_type,
    DATE_FORMAT(a.created_date, '%d %M %Y') AS created_date,
    c.name_en AS status_pengajuan
    FROM hrmrequestapproval a 
    LEFT JOIN view_employee b ON a.seq_id = b.emp_no
    LEFT JOIN hrmstatus c ON c.code = a.request_status
    WHERE a.seq_id IN ($replace2)
    AND a.request_type = '$req_type'
    AND (DATE(a.created_date) >= '$start_date' AND DATE(a.created_date) <= '$end_date')
    ORDER BY a.created_date ASC");
}

if(isset($_POST['req_status']) && $req_type == ''){
    $kondisi = 3;
    $req_status = json_encode($_POST['req_status']);
    $status1 = str_replace('[', '', $req_status);
    $status2 = str_replace(']', '', $status1);

    $sql = mysqli_query($connect, "SELECT 
    DISTINCT(a.request_no),
    a.seq_id,
    b.Full_Name,
    a.request_type,
    DATE_FORMAT(a.created_date, '%d %M %Y') AS created_date,
    c.name_en AS status_pengajuan
    FROM hrmrequestapproval a 
    LEFT JOIN view_employee b ON a.seq_id = b.emp_no
    LEFT JOIN hrmstatus c ON c.code = a.request_status
    WHERE a.seq_id IN ($replace2)
    AND a.request_status IN ($status2)
    AND (DATE(a.created_date) >= '$start_date' AND DATE(a.created_date) <= '$end_date')
    ORDER BY a.created_date ASC");
}

if(isset($_POST['req_status']) && $req_type != ''){
    $kondisi = 4;
    $req_status = json_encode($_POST['req_status']);
    $status1 = str_replace('[', '', $req_status);
    $status2 = str_replace(']', '', $status1);

    $sql = mysqli_query($connect, "SELECT 
    DISTINCT(a.request_no),
    a.seq_id,
    b.Full_Name,
    a.request_type,
    DATE_FORMAT(a.created_date, '%d %M %Y') AS created_date,
    c.name_en AS status_pengajuan
    FROM hrmrequestapproval a 
    LEFT JOIN view_employee b ON a.seq_id = b.emp_no
    LEFT JOIN hrmstatus c ON c.code = a.request_status
    WHERE a.seq_id IN ($replace2)
    AND a.request_status IN ($status2)
    AND a.request_type = '$req_type'
    AND (DATE(a.created_date) >= '$start_date' AND DATE(a.created_date) <= '$end_date')
    ORDER BY a.created_date ASC");
}


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
<input type="hidden" name="kondisi" value="<?php echo $kondisi ?>">
<input type="hidden" name="req_type" value="<?php echo $req_type ?>">
<input type="hidden" name="start_date" value="<?php echo $start_date; ?>">
<input type="hidden" name="end_date" value="<?php echo $end_date; ?>">
<input type="hidden" name="req_employee" value='<?php echo $replace2; ?>'>
<input type="hidden" name="req_waitapprove" value="<?php echo $req_waitapprove; ?>">
<input type="hidden" name="req_showapprove" value="<?php echo $req_showapprove; ?>">
<input type="hidden" name="req_status" value='<?php echo $status2; ?>'>


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
    <p style="font-size:12px">Periode : <?php echo $start_date; ?> / <?php echo $end_date; ?></p>
</div>
<?php 
if($req_waitapprove == '0' && $req_showapprove == '0'){
?>
<table border="1" width="100%" id="view_req" name="view_req">
    <tr>
        <td style="text-align:center">
            <p style="font-weight:bold">No</p>
        </td>
        <td style="text-align:center">
            <p style="font-weight:bold">No Request</p>
        </td>
        <td style="text-align:center">
            <p style="font-weight:bold">Employee No (Requestee)</p>
        </td>
        <td style="text-align:center">
            <p style="font-weight:bold">Requestee Name</p>
        </td>
        <td style="text-align:center">
            <p style="font-weight:bold">Request Type</p>
        </td>
        <td style="text-align:center">
            <p style="font-weight:bold">Requested Date</p>
        </td>
        <td style="text-align:center">
            <p style="font-weight:bold">Employee No (Requester)</p>
        </td>
        <td style="text-align:center">
            <p style="font-weight:bold">Requester</p>
        </td>
        <td style="text-align:center">
            <p style="font-weight:bold">Status</p>
        </td>
    </tr>
    <?php 
    $no = 1;
    while($data = mysqli_fetch_assoc($sql)){
    ?>
    <tr>
        <td>
            <p ><?php echo $no; ?></p>
        </td>
        <td>
            <p ><?php echo $data['request_no'] ?></p>
        </td>
        <td>
            <p ><?php echo $data['seq_id'] ?></p>
        </td>
        <td>
            <p ><?php echo $data['Full_Name'] ?></p>
        </td>
        <td>
            <p ><?php echo $data['request_type'] ?></p>
        </td>
        <td>
            <p ><?php echo $data['created_date'] ?></p>
        </td>
        <td>
            <p ><?php echo $data['seq_id'] ?></p>
        </td>
        <td>
            <p ><?php echo $data['Full_Name'] ?></p>
        </td>
        <td>
            <p ><?php echo $data['status_pengajuan'] ?></p>
        </td>
    </tr>
    <?php $no++; } ?>
</table>
<?php }elseif($req_waitapprove == '1' && $req_showapprove == '0'){ ?>
<table border="1" width="100%" id="view_req">
    <tr>
        <td rowspan="2" style="text-align:center">
            <p style="font-weight:bold">No</p>
        </td>
        <td rowspan="2" style="text-align:center">
            <p style="font-weight:bold">No Request</p>
        </td>
        <td rowspan="2" style="text-align:center">
            <p style="font-weight:bold">Employee No (Requestee)</p>
        </td>
        <td rowspan="2" style="text-align:center">
            <p style="font-weight:bold">Requestee Name</p>
        </td>
        <td rowspan="2" style="text-align:center">
            <p style="font-weight:bold">Request Type</p>
        </td>
        <td rowspan="2" style="text-align:center">
            <p style="font-weight:bold">Requested Date</p>
        </td>
        <td rowspan="2" style="text-align:center">
            <p style="font-weight:bold">Employee No (Requester)</p>
        </td>
        <td rowspan="2" style="text-align:center">
            <p style="font-weight:bold">Requester</p>
        </td>
        <td rowspan="2" style="text-align:center">
            <p style="font-weight:bold">Status</p>
        </td>
        <td colspan="2" style="text-align:center">
            <p style="font-weight:bold">Waiting Approver</p>
        </td>
    </tr>
    <tr>
        <td style="text-align:center"><p style="font-weight:bold">Sequence</p></td>
        <td style="text-align:center"><p style="font-weight:bold">Required</p></td>
    </tr>
    <?php 
    $no = 1;
    while($data = mysqli_fetch_assoc($sql)){
        $sql_get_waitapproval = mysqli_query($connect, "SELECT 
        DISTINCT(a.request_no),
        CONCAT(seq.seqname, ' [',seq.seqempno,']') AS seqname,
        CONCAT(req.reqname, ' [',req.reqempno,']') AS reqname
        FROM hrmrequestapproval a 
        LEFT JOIN (
        SELECT p.request_no, q.Full_Name AS seqname, q.emp_no AS seqempno
        FROM hrmrequestapproval p 
        LEFT JOIN view_employee q ON q.pos_code = p.approval_list
        WHERE p.req = 'Sequence' AND p.status = '0' AND p.request_status <> '0' AND p.request_status <> '5' AND p.request_status <> '8' AND p.request_status <> '9'
        ) seq ON seq.request_no = a.request_no
        LEFT JOIN (
        SELECT r.request_no, s.Full_Name AS reqname, s.emp_no AS reqempno
        FROM hrmrequestapproval r 
        LEFT JOIN view_employee s ON s.pos_code = r.approval_list
        WHERE r.req = 'Required' AND r.status = '0' AND r.request_status <> '0' AND r.request_status <> '5' AND r.request_status <> '8' AND r.request_status <> '9'
        ) req ON req.request_no = a.request_no
        WHERE a.request_no = '$data[request_no]'");

        $data_waitapproval = mysqli_fetch_assoc($sql_get_waitapproval);
    ?>
    <tr>
        <td>
            <p ><?php echo $no; ?></p>
        </td>
        <td>
            <p ><?php echo $data['request_no'] ?></p>
        </td>
        <td>
            <p ><?php echo $data['seq_id'] ?></p>
        </td>
        <td>
            <p ><?php echo $data['Full_Name'] ?></p>
        </td>
        <td>
            <p ><?php echo $data['request_type'] ?></p>
        </td>
        <td>
            <p ><?php echo $data['created_date'] ?></p>
        </td>
        <td>
            <p ><?php echo $data['seq_id'] ?></p>
        </td>
        <td>
            <p ><?php echo $data['Full_Name'] ?></p>
        </td>
        <td>
            <p ><?php echo $data['status_pengajuan'] ?></p>
        </td>
        <td>
            <p ><?php echo $data_waitapproval['seqname']; ?></p>
        </td>
        <td>
            <p ><?php echo $data_waitapproval['reqname']; ?></p>
        </td>
    </tr>
    <?php $no++; } ?>
</table>
<?php }else if($req_waitapprove == '0' && $req_showapprove == '1'){ ?>
<table border="1" width="100%" id="view_req">
    <tr>
        <td rowspan="2" style="text-align:center">
            <p style="font-weight:bold">No</p>
        </td>
        <td rowspan="2" style="text-align:center">
            <p style="font-weight:bold">No Request</p>
        </td>
        <td rowspan="2" style="text-align:center">
            <p style="font-weight:bold">Employee No (Requestee)</p>
        </td>
        <td rowspan="2" style="text-align:center">
            <p style="font-weight:bold">Requestee Name</p>
        </td>
        <td rowspan="2" style="text-align:center">
            <p style="font-weight:bold">Request Type</p>
        </td>
        <td rowspan="2" style="text-align:center">
            <p style="font-weight:bold">Requested Date</p>
        </td>
        <td rowspan="2" style="text-align:center">
            <p style="font-weight:bold">Employee No (Requester)</p>
        </td>
        <td rowspan="2" style="text-align:center">
            <p style="font-weight:bold">Requester</p>
        </td>
        <td rowspan="2" style="text-align:center">
            <p style="font-weight:bold">Status</p>
        </td>
        <td colspan="2" style="text-align:center">
            <p style="font-weight:bold">Approval Data</p>
        </td>
    </tr>
    <tr>
        <td style="text-align:center"><p style="font-weight:bold">Approver</p></td>
        <td style="text-align:center"><p style="font-weight:bold">Decision</p></td>
    </tr>
    <?php 
    $no = 1;
    while($data = mysqli_fetch_assoc($sql)){
        $no_validasi = 1;
        $sql_get_waitapproval = mysqli_query($connect, "SELECT 
        CONCAT(b.Full_Name, ' [',b.emp_no,']') AS nama_approver,
        'Approved' AS status_approver
        FROM hrmrequestapproval a 
        LEFT JOIN view_employee b ON a.approval_list = b.pos_code
        WHERE a.request_no = '$data[request_no]'
        AND (b.end_date IS NULL OR b.end_date = '0000-00-00 00:00:00')
        AND a.`status` = '1'
        ");

        $count_row = mysqli_num_rows($sql_get_waitapproval);

        while($data_waitapproval = mysqli_fetch_assoc($sql_get_waitapproval)){
    ?>
    <?php 
    if($no_validasi == '1'){
    ?>
    <tr>
        <td rowspan="<?php echo $count_row; ?>">
            <p ><?php echo $no; ?></p>
        </td>
        <td rowspan="<?php echo $count_row; ?>">
            <p ><?php echo $data['request_no'] ?></p>
        </td>
        <td rowspan="<?php echo $count_row; ?>">
            <p ><?php echo $data['seq_id'] ?></p>
        </td>
        <td rowspan="<?php echo $count_row; ?>">
            <p ><?php echo $data['Full_Name'] ?></p>
        </td>
        <td rowspan="<?php echo $count_row; ?>">
            <p ><?php echo $data['request_type'] ?></p>
        </td>
        <td rowspan="<?php echo $count_row; ?>">
            <p ><?php echo $data['created_date'] ?></p>
        </td>
        <td rowspan="<?php echo $count_row; ?>">
            <p ><?php echo $data['seq_id'] ?></p>
        </td>
        <td rowspan="<?php echo $count_row; ?>">
            <p ><?php echo $data['Full_Name'] ?></p>
        </td>
        <td rowspan="<?php echo $count_row; ?>">
            <p ><?php echo $data['status_pengajuan'] ?></p>
        </td>
        <td>
            <p ><?php echo $data_waitapproval['nama_approver']; ?></p>
        </td>
        <td>
            <p ><?php echo $data_waitapproval['status_approver']; ?></p>
        </td>
    </tr>
    <?php }else{ ?>
    <tr>
        <td>
            <p ><?php echo $data_waitapproval['nama_approver']; ?></p>
        </td>
        <td>
            <p ><?php echo $data_waitapproval['status_approver']; ?></p>
        </td>
    </tr>
    <?php } ?>
    <?php $no_validasi++; } $no++; } ?>
</table>
<?php }else if($req_waitapprove == '1' && $req_showapprove == '1'){ ?>
<table border="1" width="100%" id="view_req">
    <tr>
        <td rowspan="2" style="text-align:center">
            <p style="font-weight:bold">No</p>
        </td>
        <td rowspan="2" style="text-align:center">
            <p style="font-weight:bold">No Request</p>
        </td>
        <td rowspan="2" style="text-align:center">
            <p style="font-weight:bold">Employee No (Requestee)</p>
        </td>
        <td rowspan="2" style="text-align:center">
            <p style="font-weight:bold">Requestee Name</p>
        </td>
        <td rowspan="2" style="text-align:center">
            <p style="font-weight:bold">Request Type</p>
        </td>
        <td rowspan="2" style="text-align:center">
            <p style="font-weight:bold">Requested Date</p>
        </td>
        <td rowspan="2" style="text-align:center">
            <p style="font-weight:bold">Employee No (Requester)</p>
        </td>
        <td rowspan="2" style="text-align:center">
            <p style="font-weight:bold">Requester</p>
        </td>
        <td rowspan="2" style="text-align:center">
            <p style="font-weight:bold">Status</p>
        </td>
        <td colspan="2" style="text-align:center">
            <p style="font-weight:bold">Waiting Approver</p>
        </td>
        <td colspan="2" style="text-align:center">
            <p style="font-weight:bold">Approval Data</p>
        </td>
    </tr>
    <tr>
        <td style="text-align:center"><p style="font-weight:bold">Sequence</p></td>
        <td style="text-align:center"><p style="font-weight:bold">Required</p></td>
        <td style="text-align:center"><p style="font-weight:bold">Approver</p></td>
        <td style="text-align:center"><p style="font-weight:bold">Decision</p></td>
    </tr>
    <?php 
    $no = 1;
    while($data = mysqli_fetch_assoc($sql)){
        $sql_get_waitapproval = mysqli_query($connect, "SELECT 
        DISTINCT(a.request_no),
        CONCAT(seq.seqname, ' [',seq.seqempno,']') AS seqname,
        CONCAT(req.reqname, ' [',req.reqempno,']') AS reqname
        FROM hrmrequestapproval a 
        LEFT JOIN (
        SELECT p.request_no, q.Full_Name AS seqname, q.emp_no AS seqempno
        FROM hrmrequestapproval p 
        LEFT JOIN view_employee q ON q.pos_code = p.approval_list
        WHERE p.req = 'Sequence' AND p.status = '0' AND p.request_status <> '0' AND p.request_status <> '5' AND p.request_status <> '8' AND p.request_status <> '9'
        ) seq ON seq.request_no = a.request_no
        LEFT JOIN (
        SELECT r.request_no, s.Full_Name AS reqname, s.emp_no AS reqempno
        FROM hrmrequestapproval r 
        LEFT JOIN view_employee s ON s.pos_code = r.approval_list
        WHERE r.req = 'Required' AND r.status = '0' AND r.request_status <> '0' AND r.request_status <> '5' AND r.request_status <> '8' AND r.request_status <> '9'
        ) req ON req.request_no = a.request_no
        WHERE a.request_no = '$data[request_no]'");

        $data_waitapproval = mysqli_fetch_assoc($sql_get_waitapproval);

        $no_validasi = 1;
        $sql_get_dataapproval = mysqli_query($connect, "SELECT 
        CONCAT(b.Full_Name, ' [',b.emp_no,']') AS nama_approver,
        'Approved' AS status_approver
        FROM hrmrequestapproval a 
        LEFT JOIN view_employee b ON a.approval_list = b.pos_code
        WHERE a.request_no = '$data[request_no]'
        AND (b.end_date IS NULL OR b.end_date = '0000-00-00 00:00:00')
        AND a.`status` = '1'
        ");

        $count_row = mysqli_num_rows($sql_get_dataapproval);

        while($data_dataapproval = mysqli_fetch_assoc($sql_get_dataapproval)){
    ?>
    <?php 
    if($no_validasi == '1'){
    ?>
    <tr>
        <td rowspan="<?php echo $count_row; ?>">
            <p ><?php echo $no; ?></p>
        </td>
        <td rowspan="<?php echo $count_row; ?>">
            <p ><?php echo $data['request_no'] ?></p>
        </td>
        <td rowspan="<?php echo $count_row; ?>">
            <p ><?php echo $data['seq_id'] ?></p>
        </td>
        <td rowspan="<?php echo $count_row; ?>">
            <p ><?php echo $data['Full_Name'] ?></p>
        </td>
        <td rowspan="<?php echo $count_row; ?>">
            <p ><?php echo $data['request_type'] ?></p>
        </td>
        <td rowspan="<?php echo $count_row; ?>">
            <p ><?php echo $data['created_date'] ?></p>
        </td>
        <td rowspan="<?php echo $count_row; ?>">
            <p ><?php echo $data['seq_id'] ?></p>
        </td>
        <td rowspan="<?php echo $count_row; ?>">
            <p ><?php echo $data['Full_Name'] ?></p>
        </td>
        <td rowspan="<?php echo $count_row; ?>">
            <p ><?php echo $data['status_pengajuan'] ?></p>
        </td>
        <td rowspan="<?php echo $count_row; ?>">
            <p ><?php echo $data_waitapproval['seqname']; ?></p>
        </td>
        <td rowspan="<?php echo $count_row; ?>">
            <p ><?php echo $data_waitapproval['reqname']; ?></p>
        </td>
        <td>
            <p ><?php echo $data_dataapproval['nama_approver']; ?></p>
        </td>
        <td>
            <p ><?php echo $data_dataapproval['status_approver']; ?></p>
        </td>
    </tr>
    <?php }else{ ?>
    <tr>
        <td>
            <p ><?php echo $data_dataapproval['nama_approver']; ?></p>
        </td>
        <td>
            <p ><?php echo $data_dataapproval['status_approver']; ?></p>
        </td>
    </tr>
    <?php } ?>
    <?php $no_validasi++; } $no++; } ?>
</table>
<?php } ?>

<script type="text/javascript" language="javascript" >
$(document).ready(function(){

        var req_type = '<?php echo $req_type ?>';
        var start_date = '<?php echo $start_date; ?>';
        var end_date = '<?php echo $end_date ?>';
        var req_employee = '<?php echo $req_employee ?>';
        var req_waitapprove = '<?php echo $req_waitapprove ?>';
        var req_showapprove = '<?php echo $req_showapprove ?>';
        var req_status = '<?php echo $req_status; ?>';

    $(document).on('click', '#test', function(){
        
        

        $.post('export/print_excel.php',{req_type:req_type, start_date:start_date, end_date:end_date, req_employee:req_employee, req_waitapprove:req_waitapprove, req_showapprove:req_showapprove, req_status:req_status}, function (data) {
                    var w = window.open('about:blank', 'width=1500,height=1000,top=70,left=100,resizable=1,menubar=yes', true);
                    w.document.open();
                    w.document.write(data);
                    w.document.close();
                    // w.document.focus();
                    });
    })
})
</script>



