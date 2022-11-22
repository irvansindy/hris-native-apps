<?php
!empty($_GET['rfid']) ? $getdata = '1' : $getdata = '0'; 
if($getdata == 0) {
	include "../../application/session/session.php";
} else {
	include "../../application/session/mobile.session.php";	
}
?>


<?php $pageauthorized = "9";?>
<?php

	$rfid = $_GET['rfid'];
	//$modal_id = '1';
	$modal=mysqli_query($connect, 
	"SELECT 
	a.*,
       c.seq_id
	FROM teodempcompany a
       LEFT JOIN hrmorgstruc b on a.position_id=b.position_id
       LEFT JOIN tclcreqappsetting_final c on b.pos_code=c.emp_id
	WHERE a.emp_no='$_GET[rfid]'
	GROUP BY a.emp_no
	");
	while($r=mysqli_fetch_array($modal)){
       $var1 =  $r['seq_id'];
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
								seq_id=$var1 and 
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
							seq_id=$var1 and 
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