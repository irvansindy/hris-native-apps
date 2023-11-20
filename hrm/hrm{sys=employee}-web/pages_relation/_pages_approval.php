<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<table class="table table-bordered table-hover table-head-fixed">


 
              <tr>
                     <th style="background: #d2d2d2;">No.</th>
                     <th style="background: #d2d2d2;">Approver name </th>
                     <th style="background: #d2d2d2;">Type of approver</th>
                     <th style="background: #d2d2d2;">Approval status</th>
              </tr>
 
       <tbody>
              <?php
       include "../../../application/config.php";
       $no; 
	$rfid = $_GET['rfid'];
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
                            FROM hrmrequestapproval a
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
                            FROM hrmrequestapproval a
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
                            FROM hrmrequestapproval a
                            INNER JOIN view_employee b ON a.position_id=b.position_id AND (b.end_date IS NULL OR b.end_date = '0000-00-00 00:00:00')
                            AND a.request_no = '$rfid' AND a.req = 'Required'");
                            
      	while($r=mysqli_fetch_array($sql_approval)){

       $no++;
?>

              <tr>
                     <td><?php echo $no; ?></td>
                     <td><?php echo $r['Full_Name']; ?> [ <?php echo $r['emp_no']; ?> ] </td>
                     <td><?php echo $r['req']; ?></td>
                     <td><?php echo $r['req_status']; ?></td>
              </tr>


              <?php  } ?>
</table>