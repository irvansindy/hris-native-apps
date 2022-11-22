<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<table class="table table-bordered table-hover table-head-fixed">
       <thead>
              <tr>
                     <th>No.</th>
                     <th>Leave code </th>
                     <th>Period</th>
                     <th>Remaining</th>
              </tr>
       </thead>
       <tbody style="background: #ff0;">
              <?php
       include "../../../application/config.php";
       $no; 
	$rfid = $_GET['rfid'];
       $sfid = $_GET['sfid'];
	//$modal_id = '1';
       $sql_approval = mysqli_query($connect, "SELECT
                                                 a.leave_code,
                                                 YEAR(a.startvaliddate) AS period,
                                                 a.remaining
                                                 FROM hrmempleavebal a 
                                                 WHERE a.emp_id=(SELECT emp_id FROM view_employee WHERE emp_no = '$rfid')
                                                 AND a.leave_code='$sfid'
                                                 AND a.active_status='1'");
                            
      	while($r=mysqli_fetch_array($sql_approval)){

       $no++;
?>

              <tr>
                     <td><?php echo $no; ?>.</td>
                     <td><?php echo $r['leave_code']; ?></td>
                     <td><?php echo $r['period']; ?></td>
                     <td><?php echo $r['remaining']; ?></td>
              </tr>


              <?php  } ?>
</table>