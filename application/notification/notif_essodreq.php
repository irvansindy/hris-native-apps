<?php 
include "../config.php"; // Server Connect
date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");


// Get Data Scheduler
$sql_get_data_schedule = mysqli_fetch_assoc(mysqli_query($connect, "SELECT 
a.process_id,
a.process_code,
a.last_process,
a.before_process
FROM sys_scheduler a WHERE a.process_code = 'ESSODNewRequestNotif'"));

$sql_get_data = mysqli_query($connect, "SELECT 
a.request_no,
DATE_FORMAT(a.request_date, '%d %M %Y') AS req_date,
b.Full_Name AS created_by,
c.`type`,
e.Full_Name AS name_apprv1,
e.email AS email
FROM hrmorgessrequest a 
LEFT JOIN view_employee b ON b.emp_no = a.request_by
LEFT JOIN hrmorgessrequesttype c ON a.request_type = c.type_id
LEFT JOIN tclcdreqappsettingessod d ON d.emp_no = a.request_by
LEFT JOIN view_employee e ON e.emp_no = d.empno_appvr1
WHERE a.request_date < '$SFdatetime' AND a.request_date >= '$sql_get_data_schedule[last_process]'");

$count_data = mysqli_num_rows($sql_get_data);


$headers = "From: info@gt-hris.com\r\n"; 
$headers .= "Reply-to: rizky.agus@gt-tires.com\r\n"; 
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
if($count_data > 0){

while($data = mysqli_fetch_assoc($sql_get_data)){
// Data buat email
$subject = "GT HRIS ESS Organization New Request, $data[request_no]";

$object  = "<font face='Arial'>Yth.&nbsp;$data[name_apprv1],<br /> <br /> 
Dengan ini kami beritahukan bahwa ada sebuah permohonan $data[type] struktur organisasi<br /> 
yang dibuat di dalam aplikasi GT HRIS ESS Organization untuk Anda.<br /> 
Berikut adalah informasi singkat terkait permohonan dimaksud.<br /> <br /> 
<table cellspacing='1' cellpadding='1' border='0'>     
    <tbody>         
        <tr>             
            <td nowrap='nowrap'>No. Request</td>             
            <td>: $data[request_no]</td>         
        </tr>        
         <tr>             
             <td nowrap='nowrap'>Type Pengajuan</td>             
             <td>: $data[type]</td>         
        </tr>         
        <tr>             
            <td nowrap='nowrap'>Tanggal Dibuat</td>             
            <td>: $data[req_date]</td>        
        </tr>                
        <tr>             
            <td nowrap='nowrap'>Dibuat Oleh</td>             
            <td>: $data[created_by]</td>         
        </tr>     
    </tbody> 
</table> 
<br /><br /> <br /> 
Hormat Kami,<br /> <br /> 
INFO@GT-HRIS</font>";

$mail_sent = @mail("rizky.agus@gt-tires.com", "$subject", "$object", $headers); 
// $date_now  = date("Y-m-d H:i:s");
// $update     = mysqli_query($connect, "UPDATE `sys_scheduler` SET 
//     `before_process`='$date_now',
//     `modified_date`='$date_now'
//     WHERE `process_code` = 'ESSODNewRequestNotif'");
echo $object.'<br>';
$date_now = date("Y-m-d H:i:s");

}
// echo $mail_sent ? "Terkirim" : "Gagal";
$update     = mysqli_query($connect, "UPDATE `sys_scheduler` SET 
    `last_process`='$date_now',
    `modified_date`='$date_now'
    WHERE `process_code` = 'ESSODNewRequestNotif'");
}else{
    echo 'No data!';
}
?>