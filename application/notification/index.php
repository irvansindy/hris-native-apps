<?php 
include "config.php"; // Server Connect
require 'phpmailer/class.phpmailer.php'; // gajahtunggal domain php mailer vendor
require('phpfpdf/fpdf.php'); // required if file need attachment pdf format
?>
<?php 
$result = mysqli_query($connect, "SELECT
ticket_apps.ticket_apps as ticket_apps,
ticket_apps_weight.ticket_apps_en  as ticket_apps_en,
ticket_list.*
FROM ticket_list 
LEFT JOIN ticket_apps ON ticket_list.apps=ticket_apps.id
LEFT JOIN ticket_apps_weight on ticket_list.module=ticket_apps_weight.wight_id where ticket_list.notification = '0'"); 
if (!$result) { 
die(""); 
}

while ($row = mysqli_fetch_assoc($result)) 
{    
	$input = mysqli_query($connect, "UPDATE ticket_list SET notification='1' where ticketing_id='$applicant_id'");
   	$mail = new PHPMailer;
    	$mail->isSMTP();
	$mail->Host 		= '192.168.16.15';
	$mail->Port 		= 25;
    	$mail->SMTPSecure 	= 'SSL';
	$mail->SMTPAuth 	= true;
    	$mail->Username 	= 'agus.prasetya@gt-tires.com';
    	$mail->Password 	= 'P@yr0ll009ksf9090srsAs';
    	$mail->setFrom('system.info@gt-tires.com', 'system.info@gt-tires.com');
	
	$raised 			= $row['raised_by'];
	$sqluser 			= mysqli_fetch_array(mysqli_query($connect, " 
							SELECT email
							FROM 
							teodempersonal 
							WHERE emp_no = '$raised'"));
	$SFuser 			= $sqluser['email'];
	
	$technical_support	= $row['technical_support'];
	$sqluser_ts		= mysqli_fetch_array(mysqli_query($connect, " 
						SELECT email
						FROM 
						teodempersonal 
						WHERE emp_no = '$technical_support'"));
	$SFuser_ts 		= $sqluser_ts['email'];
	
	
	$mail->addAddress($SFuser);
	$mail->addAddress($SFuser_ts);
	$mail->addCC('taufik.sujianto@gt-tires.com');
    	$mail->addCC('windy.sinaga@gt-tires.com');
	// $mail->addCC('minggus@gt-tires.com');
	$mail->addCC('agus.prasetya@gt-tires.com');
	
	$apps		 		= $row['ticket_apps'];
	$module		 	= $row['ticket_apps_en'];
	$applicant_id 		= $row['ticketing_id'];
	$circle_name 			= $row['source'];
	$created_date 		= $row['created_date'];
	$created_by 			= $row['created_by'];
	
	$fname		= mysqli_fetch_array(mysqli_query($connect, " 
						SELECT full_name
						FROM 
						teodempersonal
						WHERE emp_no = '$created_by'"));
	$full_names 		= $fname['full_name'];
    
    	$mail->Subject = 'Successfully Add New Ticket [ '.$applicant_id.' ]';
	
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
						  <td>'.$applicant_id.'</td>
						</tr>
						
						<tr height="10px">
						  <td height="10px" nowrap="nowrap" width="50px">Source</td>
						  <td>:</td>
						  <td>'.$circle_name.'</td>
						</tr>
						
						<tr height="10px">
						  <td height="10px" nowrap="nowrap" width="50px">Apps</td>
						  <td>:</td>
						  <td>'.$apps.'</td>
						</tr>
						
						<tr height="10px">
						  <td height="10px" nowrap="nowrap" width="50px">Module</td>
						  <td>:</td>
						  <td>'.$module.'</td>
						</tr>
						
						<tr height="10px">
						  <td height="10px" nowrap="nowrap" width="50px">Created By</td>
						  <td>:</td>
						  <td>'.$full_names.' [ '.$created_by.' ]</td>
						</tr>
						
						<tr height="10px">
						  <td height="10px" nowrap="nowrap" width="50px">Created date</td>
						  <td>:</td>
						  <td>'.$created_date.'</td>
						</tr>
						
						<tr>
						  <td colspan="3">Please check on HRIS Support WebApp, for detail Registration<br><br></td>
						</tr>
						<tr>
						  <td colspan="3">Best Regards<br>HRIS Department<br>Tangerang Factory<br><br><br></td>
						</tr>
						<tr>
						  <td colspan="3">Note: Please do not reply to this email.<br>This mailbox does not allow incoming messages. </td>
						</tr>
					  </tbody>
					</table>

					');
					if($mail->Send()){
						$input = mysqli_query($connect, "UPDATE ticket_list SET notification='1' where ticketing_id='$applicant_id'");
					 }else {
						$input = "";
					 
					}}
?>
<?php
$result = mysqli_query($connect, "
SELECT 
a.id_chat,
a.ticketing_id,
b.created_by,
b.respon_by,
b.technical_support,
a.message
FROM ticket_chat a
LEFT JOIN ticket_list b on a.ticketing_id=b.ticketing_id
where a.notification = '0' and a.id_chat NOT IN ('Fixed','Create','Respond','Closed')"); 

if (!$result) { 
die(""); 
}

while ($row = mysqli_fetch_assoc($result)) 
{   
	$input = mysqli_query($connect, "UPDATE ticket_chat SET notification = '1' where ticketing_id='$applicant_id' and id_chat='$id_chat'");
    $mail = new PHPMailer;
    $mail->isSMTP();

	$mail->Host 		= '192.168.16.15';
	$mail->Port 		= 25;
    $mail->SMTPSecure 	= 'SSL';
	$mail->SMTPAuth 	= true;
    $mail->Username 	= 'agus.prasetya@gt-tires.com';
    $mail->Password 	= 'P@yr0ll009ksf9090srsAs';
    $mail->setFrom('system.info@gt-tires.com', 'system.info@gt-tires.com');
	
	$raised 			= $row['created_by'];
	$respon_by			= $row['respon_by'];
	$technical_support	= $row['technical_support'];
	
	$sqluser 			= mysqli_fetch_array(mysqli_query($connect, " 
						SELECT email
						FROM 
						teodempersonal 
						WHERE emp_no = '$raised'"));
	$SFuser 			= $sqluser['email'];
	
	$sqluser_respon		= mysqli_fetch_array(mysqli_query($connect, " 
						SELECT email
						FROM 
						teodempersonal 
						WHERE emp_no = '$respon_by'"));
	$SFuser_respon 		= $sqluser_respon['email'];
	
	$sqluser_ts		= mysqli_fetch_array(mysqli_query($connect, " 
						SELECT email
						FROM 
						teodempersonal 
						WHERE emp_no = '$technical_support'"));
	$SFuser_ts 		= $sqluser_ts['email'];
	
	
	$mail->addAddress($SFuser);
	$mail->addAddress($SFuser_ts);
	$mail->addAddress($SFuser_respon);
	//
	
	$mail->addCC('taufik.sujianto@gt-tires.com');
	$mail->addCC('windy.sinaga@gt-tires.com');
	
	$mail->addBCC('agus.prasetya@gt-tires.com');
	

	
	$applicant_id 		= $row['ticketing_id'];
	$circle_name 		= $row['message'];
	$id_chat 			= $row['id_chat'];
    
    $mail->Subject = 'New Message From HRIS support Ticketing [ '.$applicant_id.' ]';
	
        $mail->msgHTML('

					<table width:300px" style="font-family:arial;font-size:14px">
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
						  <td>'.$applicant_id.'</td>
						</tr>
						<tr height="10px">
						  <td colspan="3">&nbsp;</td>
						</tr>
						
						<tr>
							<td colspan="3" style="background-color:#ffcc00; height:40px">&nbsp;Message :</td>
						</tr>
						
						<tr height="10px">
						  <td colspan="3" style="background-color:#dddddd">'.$circle_name.'</td>
						</tr>
						<tr height="10px">
						  <td colspan="3">&nbsp;</td>
						</tr>
						<tr>
						  <td colspan="3">Please check on HRIS Support WebApp, for detail Registration<br><br></td>
						</tr>
						<tr>
						  <td colspan="3">Best Regards<br>HRIS Department<br>Tangerang Factory<br><br><br></td>
						</tr>
						<tr>
						  <td colspan="3">Note: Please do not reply to this email.<br>This mailbox does not allow incoming messages. </td>
						</tr>
					  </tbody>
					</table>

					');
					if($mail->Send()){
						$input = mysqli_query($connect, "UPDATE ticket_chat SET notification = '1' where ticketing_id='$applicant_id' and id_chat='$id_chat'");
					 }else {
						$input = "";
					 
					}}			
?>