<?php $pageauthorized = "9";?>
<?php
    include "../../application/session/session.php";
	$id = $_POST['id'];
	//$modal_id = '1';
	$modal=mysqli_query($connect, 
	"SELECT 
	a.*
	FROM tclcreqappsetting_final a

	WHERE a.seq_id=$id
	GROUP BY a.seq_id
	");

	while($r=mysqli_fetch_array($modal)){
?>







<div class="modal-dialog modal-med">
       <div class="modal-content">

              <div class="modal-header">
                     <h4 class="modal-title">Workflow Approval</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
              </div>

              <div class="modal-body">



                     <table cellpadding="1" cellspacing="1" style="width:100%">
                            <tr>
                                   <td style="font-weight: bold;font-size: x-small;">
                                          Workflow Name :
                                   </td>
                                   <td colspan="3" style="font-weight: bold;font-size: x-small;">
                                          <?php echo $r['request_approval_name']; ?>
                                   </td>
                            </tr>
                            <tr>
				<td style="font-weight: bold;font-size: x-small;">
                                          Workflow Code :
                                   </td>
                                   <td colspan="3" style="font-weight: bold;font-size: x-small;">
                                          <?php echo $r['request_approval_code']; ?>
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
							seq_id=$id and 
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
								seq_id=$id and 
								squence_approval = '1' and
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
							seq_id=$id and 
							squence_approval = '2' and
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
                            </tr>

                     </table>






              </div>
       </div>




       <?php } ?>

</div>


</div>
</div>