<?php 
include "../config.php"; // Server Connect
require 'phpmailer/class.phpmailer.php'; // gajahtunggal domain php mailer vendor
?>
<?php 
$get_date = mysqli_fetxh_array(mysqli_query($connect, "SELECT last_process WHERE process_code = 'NewRequestNotifTee'"));
$get_date_print = $get_date['last_process'];
$result = mysqli_query($connect, "SELECT request_no FROM hrdleaverequest where created_date > '$get_date_print' LIMIT 1");
if (!$result) { 
die(""); 
}
while ($row = mysqli_fetch_array($result)) 
{    
   	$mail = new PHPMailer;
    	$mail->isSMTP();
	$mail->Host 		= '192.168.16.15';
	$mail->Port 		= 25;
    	$mail->SMTPSecure 	= 'SSL';
	$mail->SMTPAuth 	= true;
    	$mail->Username 	= 'agus.prasetya@gt-tires.com';
    	$mail->Password 	= 'P@yr0ll009ksf9090srsAs';
    	$mail->setFrom('system.info@gt-tires.com', 'system.info@gt-tires.com');
	
	$raised 			= $row['request_no'];
	$sqluser 			= mysqli_fetch_array(mysqli_query($connect, " 
											SELECT 
											a.request_no,
											a.position_id,
											b.email
											FROM hrmrequestapproval a
											INNER JOIN view_employee b on a.position_id=b.position_id
											LEFT JOIN teodempcompany c on b.emp_id=c.emp_id
											where a.request_no = '$raised'
											and c.`status` = '1'
											and a.position_id = '14733'"));
	$SFuser 			= $sqluser['email'];
	
	$mail->addAddress($SFuser);
	
	$request_no		 		= $row['request_no'];

    	$mail->Subject = 'New Request [ '.$request_no.' ]';
	
       $mail->msgHTML('

					<table width="100px" style="font-fanggus
					ly:arial;font-size:14px">
					  <tbody>
						<tr>
						  <td colspan="3">This email sent by HRIS Support WebApp<br><br><br></td>
						</tr>
						<tr>
						  <td colspan="3">Dear Mr/Mrs.<br><br></td>
						</tr>
						<tr>
						  <td colspan="3">We are please to inform you that request for : <br></td>
						</tr>
						<tr height="10px">
						  <td height="10px" nowrap="nowrap" width="50px">Ticket No</td>
						  <td>:</td>
						  <td>'.$request_no.'</td>
						</tr>
					  </tbody>
					</table>

					');
					if($mail->Send()){
						$input = mysqli_fetch_array(mysqli_query($connect, "UPDATE sys_scheduler SET last_process = '$get_date_print' where process_code = 'NewRequestNotifTee')"));
					 }else {
						$input = "";
					}}
?>