<?php $pageauthorized = "9";?>
<?php
    include "../../application/session/session.php";
	$rfid = $_GET['rfid'];
	//$modal_id = '1';
	$modal=mysqli_query($connect, 
	"SELECT 
	a.*,
       c.seq_id
	FROM teodempcompany a
       LEFT JOIN hrmorgstruc b on a.position_id=b.position_id
       LEFT JOIN tclcreqappsetting_final c on b.pos_code=c.position_id
	WHERE a.emp_no = '$rfid'
	GROUP BY a.emp_no
	");

	while($r=mysqli_fetch_array($modal)){

       $var1 =  $r['seq_id'];
?>






<div class="modal-dialog modal-med">
       <div class="modal-content">

              <div class="modal-header">
                     <h4 class="modal-title">Workflow Approval Old</h4>
                     <!-- <button type="button" onclick='return stopload()' class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button> -->
              </div>

              <div class="modal-body">



                     <table cellpadding="1" cellspacing="1" style="width:100%">
                            <tr>
                                   <td style="font-weight: bold;font-size: x-small;">
                                          Workflow Name :
                                   </td>
                                   <td colspan="3" style="font-weight: bold;font-size: x-small;">
                                          <?php echo $r['emp_no']; ?>
                                   </td>
                            </tr>
                            <tr>
				<td style="font-weight: bold;font-size: x-small;">
                                          Workflow Code :
                                   </td>
                                   <td colspan="3" style="font-weight: bold;font-size: x-small;">
                                          <?php echo $r['seq_id']; ?>
                                   </td>
                            </tr>

                            <tr>
                                   <td style="vertical-align:top" align='center'>
                                          <table cellpadding="1" cellspacing="1" style="width:100%">
                                                 <tbody>
                                                        <tr>
                                                               <td width="10px" align='center'
                                                                      style="color:white; background-color: #a29e9e;">
                                                                      Step1</td>
                                                        </tr>
                                                        <?php 
                                                               $no = 0;
                                                               $modals=mysqli_query($connect, "SELECT 
                                                               b.position_id,
                                                               a.request_approval_formula,
                                                               a.ordering,
                                                               c.emp_no,
                                                               d.full_name
                                                               FROM tclcreqappsetting_final_fantasy_final a
                                                               LEFT JOIN hrmorgstruc b on REPLACE(a.request_approval_formula, '*' , '') = b.pos_code
                                                               LEFT JOIN teodempcompany c on b.position_id=c.position_id
                                                               LEFT JOIN teomemppersonal d on c.emp_id=d.emp_id
                                                               WHERE 
                                                               seq_id='$var1' and 
                                                               squence_approval = '0' and
                                                               c.status = '1'
                                                               ORDER BY a.ordering ASC");

                                                               while($rs=mysqli_fetch_array($modals)){
                                                               $no++;	
                                                        ?>
                                                        <tr>
                                                               <td style="padding-left: 12px; font-weight: bold;font-size: x-small;"
                                                                      align='left'>
                                                                      <?php echo $rs['request_approval_formula']; ?><br>
                                                                      <?php echo $rs['full_name']; ?>
                                                                      [<?php echo $rs['emp_no']; ?>]</td>
                                                        </tr>
                                                        <?php } ?>
                                                 </tbody>
                                          </table>
                                   </td>
                                   <td style="vertical-align:top" align='center'>
                                          <table cellpadding="1" cellspacing="1" style="width:100%">
                                                 <tbody>
                                                        <tr>
                                                               <td width="10px" align='center'
                                                                      style="color:white; background-color: #a29e9e;">
                                                                      Step2</td>
                                                        </tr>
                                                        <?php 
							$no = 0;
							$modals=mysqli_query($connect, "SELECT 
								b.position_id,
								a.request_approval_formula,
								a.ordering,
								c.emp_no,
								d.full_name
								FROM tclcreqappsetting_final_fantasy_final a
								LEFT JOIN hrmorgstruc b on REPLACE(a.request_approval_formula, '*' , '') = b.pos_code
								LEFT JOIN teodempcompany c on b.position_id=c.position_id
								LEFT JOIN teomemppersonal d on c.emp_id=d.emp_id
								WHERE 
								seq_id='$var1' and 
								squence_approval = '1' and
								c.status = '1'
								ORDER BY a.ordering ASC");
                                                 
                                                 $modals1=mysqli_query($connect, "SELECT 
								b.position_id,
								a.request_approval_formula,
								a.ordering,
								c.emp_no,
								d.full_name
								FROM tclcreqappsetting_final_fantasy_final a
								LEFT JOIN hrmorgstruc b on REPLACE(a.request_approval_formula, '*' , '') = b.pos_code
								LEFT JOIN teodempcompany c on b.position_id=c.position_id
								LEFT JOIN teomemppersonal d on c.emp_id=d.emp_id
								WHERE 
								seq_id='0' and 
								squence_approval = '1' and
								c.status = '1'
								ORDER BY a.ordering ASC");

                                                 $num = mysqli_num_rows($modals);

                                                 if($num > 0) {
                                                        $modaluse = $modals;
                                                 } else {
                                                        $modaluse = $modals1;
                                                 }



							while($rs=mysqli_fetch_array($modaluse)){


							$no++;	
						?>
                                                        <tr>
                                                               <td style="padding-left: 12px; font-weight: bold;font-size: x-small;"
                                                                      align='left'>
                                                                      <?php echo $rs['request_approval_formula']; ?><br>
                                                                      <?php echo $rs['full_name']; ?>
                                                                      [<?php echo $rs['emp_no']; ?>]</td>
                                                        </tr>
                                                        <?php } ?>
                                                 </tbody>
                                          </table>
                                   </td>

                                   <td style="vertical-align:top" align='center'>
                                          <table cellpadding="1" cellspacing="1" style="width:100%">
                                                 <tbody>
                                                        <tr>
                                                               <td width="10px" align='center'
                                                                      style="color:white; background-color: #a29e9e;">
                                                                      Step3</td>
                                                        </tr>
                                                        <?php 
                                                        $no = 0;
                                                        $modals=mysqli_query($connect, "SELECT 
                                                               b.position_id,
                                                               a.request_approval_formula,
                                                               a.ordering,
                                                               c.emp_no,
                                                               d.full_name
                                                               FROM tclcreqappsetting_final_fantasy_final a
                                                               LEFT JOIN hrmorgstruc b on REPLACE(a.request_approval_formula, '*' , '') = b.pos_code
                                                               LEFT JOIN teodempcompany c on b.position_id=c.position_id
                                                               LEFT JOIN teomemppersonal d on c.emp_id=d.emp_id
                                                               WHERE 
                                                               seq_id='$var1' and 
                                                               squence_approval = '2' and
                                                               c.status = '1'
                                                               ORDER BY a.ordering ASC");
                                                        
                                                        $modals1=mysqli_query($connect, "SELECT 
                                                               b.position_id,
                                                               a.request_approval_formula,
                                                               a.ordering,
                                                               c.emp_no,
                                                               d.full_name
                                                               FROM tclcreqappsetting_final_fantasy_final a
                                                               LEFT JOIN hrmorgstruc b on REPLACE(a.request_approval_formula, '*' , '') = b.pos_code
                                                               LEFT JOIN teodempcompany c on b.position_id=c.position_id
                                                               LEFT JOIN teomemppersonal d on c.emp_id=d.emp_id
                                                               WHERE 
                                                               seq_id='0' and 
                                                               squence_approval = '1' and
                                                               c.status = '1'
                                                               ORDER BY a.ordering ASC");

                                                        $num = mysqli_num_rows($modals);

                                                        if($num > 0) {
                                                               $modaluse = $modals;
                                                        } else {
                                                               $modaluse = $modals1;
                                                        }

                                                        while($rs=mysqli_fetch_array($modaluse)){
                                                        $no++;	
						?>
                                                        <tr>
                                                               <td style="padding-left: 12px; font-weight: bold;font-size: x-small;"
                                                                      align='left'>
                                                                      <?php echo $rs['request_approval_formula']; ?><br>
                                                                      <?php echo $rs['full_name']; ?>
                                                                      [<?php echo $rs['emp_no']; ?>]</td>
                                                        </tr>
                                                        <?php } ?>
                                                 </tbody>
                                          </table>
                                   </td>
                            </tr>

                     </table>






              </div>
       </div>




       <?php } ?>

</div>


</div>
</div>



<br>





<div class="modal-dialog modal-med">
       <div class="modal-content">

              <div class="modal-header">
                     <h4 class="modal-title">Standard Workflow Approval BY Organization</h4>
                     <!-- <button type="button" onclick='return stopload()' class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button> -->
              </div>

              <div class="modal-body">



                     <table cellpadding="1" cellspacing="1" style="width:100%">
                            <tr>
                                   <td style="font-weight: bold;font-size: x-small;">
                                          Workflow Name :
                                   </td>
                                   <td colspan="3" style="font-weight: bold;font-size: x-small;">
                                          <?php echo $rfid ?>
                                   </td>
                            </tr>
                            <tr>


                            <tr>
                                   <td style="vertical-align:top" align='center'>
                                          <table cellpadding="1" cellspacing="1" style="width:100%">
                                                 <tbody>
                                                        <tr>
                                                               <td width="10px" align='center'
                                                                      style="color:white; background-color: #a29e9e;">
                                                                      Step1</td>
                                                        </tr>
                                                        <?php 
                                                               $no = 0;
                                                               $modals=mysqli_query($connect, "SELECT 
                                                               a.emp_no as seq_id,
                                                               a.empno_appvr1,
                                                               x2.full_name,
                                                               x2.emp_no,
                                                               x2.position_id,
                                                               x2.pos_code as request_approval_formula,
                                                               'Notification' as req,
                                                               '0' as ordering
                                                               FROM tclcdreqappsetting a
                                                               LEFT JOIN view_employee x1 on a.emp_no=x1.emp_no
                                                               LEFT JOIN view_employee x2 on a.empno_appvr1=x2.emp_no
                                                               where a.emp_no = '$rfid'");

                                                               while($rs=mysqli_fetch_array($modals)){
                                                               $no++;	
                                                        ?>
                                                        <tr>
                                                               <td style="padding-left: 12px; font-weight: bold;font-size: x-small;"
                                                                      align='left'>
                                                                      <?php echo $rs['request_approval_formula']; ?><br>
                                                                      <?php echo $rs['full_name']; ?>
                                                                      [<?php echo $rs['emp_no']; ?>]</td>
                                                        </tr>
                                                        <?php } ?>
                                                 </tbody>
                                          </table>
                                   </td>
                                   <td style="vertical-align:top" align='center'>
                                          <table cellpadding="1" cellspacing="1" style="width:100%">
                                                 <tbody>
                                                        <tr>
                                                               <td width="10px" align='center'
                                                                      style="color:white; background-color: #a29e9e;">
                                                                      Step2</td>
                                                        </tr>
                                                        <?php 
                                                               $no = 0;
                                                               $modals=mysqli_query($connect, "SELECT 
                                                               a.emp_no as seq_id,
                                                               a.empno_appvr2,
                                                               x2.full_name,
                                                               x2.emp_no,
                                                               x2.position_id,
                                                               x2.pos_code as request_approval_formula,
                                                               'Sequence' as req,
                                                               '0' as ordering
                                                               FROM tclcdreqappsetting a
                                                               LEFT JOIN view_employee x1 on a.emp_no=x1.emp_no
                                                               LEFT JOIN view_employee x2 on a.empno_appvr2=x2.emp_no
                                                               where a.emp_no = '$rfid'");

                                                               while($rs=mysqli_fetch_array($modals)){
                                                               $no++;	
                                                        ?>
                                                        <tr>
                                                               <td style="padding-left: 12px; font-weight: bold;font-size: x-small;"
                                                                      align='left'>
                                                                      <?php echo $rs['request_approval_formula']; ?><br>
                                                                      <?php echo $rs['full_name']; ?>
                                                                      [<?php echo $rs['emp_no']; ?>]</td>
                                                        </tr>
                                                        <?php } ?>
                                                 </tbody>
                                          </table>
                                   </td>

                                   <td style="vertical-align:top" align='center'>
                                          <table cellpadding="1" cellspacing="1" style="width:100%">
                                                 <tbody>
                                                        <tr>
                                                               <td width="10px" align='center'
                                                                      style="color:white; background-color: #a29e9e;">
                                                                      Step3</td>
                                                        </tr>
                                                        <?php 
                                                               $no = 0;
                                                               $modals=mysqli_query($connect, "SELECT 
                                                               a.emp_no as seq_id,
                                                               a.empno_appvr3,
                                                               x2.full_name,
                                                               x2.emp_no,
                                                               x2.position_id,
                                                               x2.pos_code as request_approval_formula,
                                                               'Sequence' as req,
                                                               '0' as ordering
                                                               FROM tclcdreqappsetting a
                                                               LEFT JOIN view_employee x1 on a.emp_no=x1.emp_no
                                                               LEFT JOIN view_employee x2 on a.empno_appvr3=x2.emp_no
                                                               where a.emp_no = '$rfid'");

                                                               while($rs=mysqli_fetch_array($modals)){
                                                               $no++;	
                                                        ?>
                                                        <tr>
                                                               <td style="padding-left: 12px; font-weight: bold;font-size: x-small;"
                                                                      align='left'>
                                                                      <?php echo $rs['request_approval_formula']; ?><br>
                                                                      <?php echo $rs['full_name']; ?>
                                                                      [<?php echo $rs['emp_no']; ?>]</td>
                                                        </tr>
                                                        <?php } ?>
                                                 </tbody>
                                          </table>
                                   </td>
                            </tr>
                     </table>
              </div>
       </div>
</div>
</div>
</div>