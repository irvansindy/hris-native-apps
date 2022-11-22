<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />

<?php
       include "../../../application/session/session_ess.php";
       $no = 1; 
	$rfid = $_POST['id'];
       $username = $_SESSION['username'];
	//$modal_id = '1';
       $sql_approval = mysqli_query($connect, "SELECT 
                            a.position_id,
                            a.req,
                            b.emp_no,
                            b.Full_Name,
                            CASE 
                                   WHEN a.`status` = '1' THEN 'Has been approved'
                                   ELSE ''
                                   END AS req_status 
                            FROM hrmrequestapprovalessod a
                            INNER JOIN view_employee b ON a.position_id=b.position_id AND (b.end_date IS NULL OR b.end_date = '0000-00-00 00:00:00')
                            AND a.request_no = '$rfid' AND a.req = 'Notification'

                            UNION ALL

                            SELECT 
                            a.position_id,
                            a.req,
                            b.emp_no,
                            b.Full_Name,
                            CASE 
                                   WHEN a.`status` = '1' THEN 'Has been approved'
                                   ELSE ''
                                   END AS req_status 
                            FROM hrmrequestapprovalessod a
                            INNER JOIN view_employee b ON a.position_id=b.position_id AND (b.end_date IS NULL OR b.end_date = '0000-00-00 00:00:00')
                            AND a.request_no = '$rfid' AND a.req = 'Sequence'

                            UNION ALL

                            SELECT 
                            a.position_id,
                            a.req,
                            b.emp_no,
                            b.Full_Name,
                            CASE 
                                   WHEN a.`status` = '1' THEN 'Has been approved'
                                   ELSE ''
                                   END AS req_status 
                            FROM hrmrequestapprovalessod a
                            INNER JOIN view_employee b ON a.position_id=b.position_id AND (b.end_date IS NULL OR b.end_date = '0000-00-00 00:00:00')
                            AND a.request_no = '$rfid' AND a.req = 'Required'");

       $sql_data_request = mysqli_query($connect, "SELECT 
       b.name_en
       FROM hrmorgessrequest a 
       LEFT JOIN hrmstatus b ON a.status_approval = b.code
       WHERE a.request_no = '$rfid'");

       $data_request = mysqli_fetch_assoc($sql_data_request);
?>
<div style="padding-left:5px; padding-right:5px">
<table cellpadding="1" cellspacing="1" style="width:100%">
  <tbody>
    <tr>
      <td style="font-weight: bold;font-size: x-small;">
        Request Number :
      </td>
      <td colspan="3" style="font-weight: bold;font-size: x-small;">
        <?php echo $rfid; ?>                                   
      </td>
    </tr>
    <tr>
      <td style="font-weight: bold;font-size: x-small;">
        Request Status:
      </td>
      <td colspan="3" style="font-weight: bold;font-size: x-small;">
        <span class="badge badge-secondary"><?php echo $data_request['name_en']; ?></span>
      </td>
    </tr>
    <tr>
      <td colspan="4" style="font-weight: bold;font-size: x-small;">
        Waiting Approval From :
      </td>
    </tr>
  </tbody>
</table>

<table cellpadding="1" cellspacing="1" style="width:100%">

<?php
        $temp = '';             
      	while($r=mysqli_fetch_array($sql_approval)){
        
?>
    <tr>
      <td nowrap="nowrap" style="font-weight: bold;font-size: x-small; vertical-align: top;">
        <?php if($temp != $r['req']){ ?>
        Step <?php echo $no; ?> :
        <?php }else{ ?>
        &nbsp
        <?php } ?>
      </td>
      <td colspan="3" style="font-weight: bold;font-size: x-small; vertical-align: top;">
        <?php echo $r['Full_Name']; ?>, <?php echo $r['req']; ?>                  
      </td>
    </tr>
    <tr>
      <td>     
      </td>
      <td colspan="3" style="font-weight: bold; color:#ffa759;font-size: x-small; vertical-align: top;font-size: smaller;font-family: verdana;font-style: oblique;">
      <?php echo $r['req_status']; ?> 
      </td>
    </tr>
    <?php
    if($temp != $r['req']){
    $no++;
    }
    $temp = $r['req'];
    }
    ?>   

</table>






