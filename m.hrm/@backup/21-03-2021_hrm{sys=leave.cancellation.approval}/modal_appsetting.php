<?php
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0'; 
if($getdata == 0) {
	include "../../application/session/session.php";
} else {
	include "../../application/session/mobile.session.php";	
}
?>

<?php $pageauthorized = "9";?>
<?php
	$id = $_POST['id'];
	//$modal_id = '1';
	$modal=mysqli_query($connect, 
	"SELECT 
	a.*,
	b.*,
       e.name_en
	FROM hrmrequestapproval a
       LEFT JOIN hrmorgstruc b on a.approval_list=b.pos_code
	LEFT JOIN teodempcompany c on c.position_id=b.position_id
       LEFT JOIN hrmrequest d on a.request_no=d.request_no

       LEFT JOIN hrmstatus e on (SELECT request_status FROM hrmrequestapproval WHERE request_no = a.request_no ORDER BY `request_status` DESC limit 1)=e.code



	WHERE 
       a.request_no='$id'
	GROUP BY a.request_no
	");
	while($r=mysqli_fetch_array($modal)){
?>






<STYLE>
#form1 {
       padding: 15px;
       background: #fff;
       display: none;
}

#formButton {
       display: block;
       margin-right: auto;
       margin-left: auto;
}
</STYLE>





<div class="modal-dialog modal-med">
       <div class="modal-content">

              <div class="modal-header">
                     <h4 class="modal-title">Workflow Approval</h4>
                     <button type="button" onclick='return stopload()' class="close" data-dismiss="modal"
                            aria-label="Close" style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
              </div>

              <div class="modal-body">



                     <table cellpadding="1" cellspacing="1" style="width:100%">
                            <tr>
                                   <td style="font-weight: bold;font-size: x-small;">
                                          Request Number :
                                   </td>
                                   <td colspan="3" style="font-weight: bold;font-size: x-small;">
                                          <?php echo $r['request_no']; ?>
                                   </td>
                            </tr>
                            <tr>
                                   <td style="font-weight: bold;font-size: x-small;">
                                          Request Status:
                                   </td>
                                   <td colspan="3" style="font-weight: bold;font-size: x-small;">
                                          <span class="badge badge-secondary"><?php echo $r['name_en']; ?></span>
                                   </td>
                            </tr>
                            <tr>
                                   <td colspan="4" style="font-weight: bold;font-size: x-small;">
                                          Waiting Approval From :
                                   </td>
                            </tr>

                     </table>


                     <table cellpadding="1" cellspacing="1" style="width:100%">
                            <tr>
                                   <td nowrap="nowrap"
                                          style="font-weight: bold;font-size: x-small; vertical-align: top;">
                                          Step1 :
                                   </td>
                                   <td colspan="3" style="font-weight: bold;font-size: x-small; vertical-align: top;">
                                          <?php 
                                                               $no = 0;	
                                                               $modals_notification=mysqli_query($connect, "SELECT 
                                                               a.*,
                                                               b.*,
                                                               c.emp_no,
                                                               e.name_en,
                                                               f.code,
                                                               g.full_name
                                                               FROM hrmrequestapproval a
                                                               LEFT JOIN hrmorgstruc b on a.approval_list=b.pos_code
                                                               LEFT JOIN teodempcompany c on c.position_id=b.position_id
                                                               LEFT JOIN hrmrequest d on a.request_no=d.request_no
                                                               LEFT JOIN hrmstatus e on d.code=e.code
                                                               LEFT JOIN hrmstatus f on a.req=f.name_en
                                                               LEFT JOIN teomemppersonal g on c.emp_id=g.emp_id
                                                               
                                                        
                                                               WHERE 
                                                               a.request_no='$id' and
                                                               a.req = 'Notification' and
                                                               c.status = '1'

                                                               GROUP BY c.emp_no

                                                               ORDER BY f.code ASC, a.ordering ASC
                                                             
                                                               ");

                                                               while($rs=mysqli_fetch_array($modals_notification)){
                                                               $no++;	
                                                        ?>


                                          <?php echo $rs['emp_no']; ?> <?php echo $rs['full_name']; ?>
                                          <?php echo $rs['req']; ?>,<br>

                                          <?php } ?>
                                   </td>
                            </tr>


                            <?php
                            $has_approve1=mysqli_query($connect, "SELECT 
                                                                      c.emp_no
                                                                      FROM hrmrequestapproval a
                                                                      LEFT JOIN hrmorgstruc b on a.approval_list=b.pos_code
                                                                      LEFT JOIN teodempcompany c on b.position_id=c.position_id
                                                                      WHERE 
                                                                      a.request_no='$id' and
                                                                      a.req = 'Notification' and
                                                                      a.status = '1'
                                                                      ");
                            $var_approver1 = mysqli_num_rows($has_approve1);
                            $var_has_approver1 = mysqli_fetch_array($has_approve1);

                     
                            if($var_approver1 > 0) {
                            $var_who_approver1 = $var_has_approver1['emp_no'];
                                   echo '<tr>
                                                 <td>     
                                                 </td>
                                                 <td colspan="3" style="font-weight: bold; color:#ffa759;font-size: x-small; vertical-align: top;font-size: smaller;font-family: verdana;font-style: oblique;">
                                                        '.$var_who_approver1.' Has Been Approved
                                                 </td>
                                          </tr>';
                            } else {
                                   echo '';
                            }
                            ?>


                            <tr>
                                   <td nowrap="nowrap"
                                          style="font-weight: bold;font-size: x-small; vertical-align: top;">
                                          Step2:
                                   </td>
                                   <td colspan="3" style="font-weight: bold;font-size: x-small; vertical-align: top;">
                                          <?php 
                                                               $no = 0;	
                                                               $modals=mysqli_query($connect, "SELECT 
                                                               a.*,
                                                               b.*,
                                                               c.emp_no,
                                                               e.name_en,
                                                               f.code,
                                                               g.full_name
                                                               FROM hrmrequestapproval a
                                                               LEFT JOIN hrmorgstruc b on a.approval_list=b.pos_code
                                                               LEFT JOIN teodempcompany c on c.position_id=b.position_id
                                                               LEFT JOIN hrmrequest d on a.request_no=d.request_no
                                                               LEFT JOIN hrmstatus e on d.code=e.code
                                                               LEFT JOIN hrmstatus f on a.req=f.name_en
                                                               LEFT JOIN teomemppersonal g on c.emp_id=g.emp_id
                                                               
                                                        
                                                               WHERE 
                                                               a.request_no='$id' and
                                                               a.req = 'Sequence' and
                                                               c.status = '1'

                                                               GROUP BY c.emp_no

                                                               ORDER BY f.code ASC, a.ordering ASC
                                                               
                                                               ");

                                                               while($rs=mysqli_fetch_array($modals)){
                                                               $no++;	
                                                        ?>



                                          <?php echo $rs['emp_no']; ?> <?php echo $rs['full_name']; ?>
                                          <?php echo $rs['req']; ?>,<br>



                                          <?php } ?>
                                   </td>
                            </tr>


                            <?php
                            $has_approve2=mysqli_query($connect, "SELECT 
                                                                      c.emp_no
                                                                      FROM hrmrequestapproval a
                                                                      LEFT JOIN hrmorgstruc b on a.approval_list=b.pos_code
                                                                      LEFT JOIN teodempcompany c on b.position_id=c.position_id
                                                                      WHERE 
                                                                      a.request_no='$id' and
                                                                      a.req = 'Sequence' and
                                                                      a.status = '1'
                                                                      ");
                            $var_approver2 = mysqli_num_rows($has_approve2);
                            $var_has_approver2 = mysqli_fetch_array($has_approve2);

                     
                            if($var_approver2 > 0) {
                            $var_who_approver2 = $var_has_approver2['emp_no'];
                                   echo '<tr>
                                                 <td>     
                                                 </td>
                                                 <td colspan="3" style="font-weight: bold; color:#ffa759;font-size: x-small; vertical-align: top;font-size: smaller;font-family: verdana;font-style: oblique;">
                                                        '.$var_who_approver2.' Has Been Approved
                                                 </td>
                                          </tr>';
                            } else {
                                   echo '';
                            }
                            ?>


                            <tr>
                                   <td nowrap="nowrap"
                                          style="font-weight: bold;font-size: x-small; vertical-align: top;">
                                          Step3:
                                   </td>
                                   <td colspan="3" style="font-weight: bold;font-size: x-small; vertical-align: top;">
                                          <?php 
                                                               $no = 0;	
                                                               $modals=mysqli_query($connect, "SELECT 
                                                               a.*,
                                                               b.*,
                                                               c.emp_no,
                                                               e.name_en,
                                                               f.code,
                                                               g.full_name
                                                               FROM hrmrequestapproval a
                                                               LEFT JOIN hrmorgstruc b on a.approval_list=b.pos_code
                                                               LEFT JOIN teodempcompany c on c.position_id=b.position_id
                                                               LEFT JOIN hrmrequest d on a.request_no=d.request_no
                                                               LEFT JOIN hrmstatus e on d.code=e.code
                                                               LEFT JOIN hrmstatus f on a.req=f.name_en
                                                               LEFT JOIN teomemppersonal g on c.emp_id=g.emp_id
                                                               
                                                        
                                                               WHERE 
                                                               a.request_no='$id' and
                                                               a.req = 'Required' and
                                                               c.status = '1'

                                                               GROUP BY c.emp_no

                                                               ORDER BY f.code ASC, a.ordering ASC
                                                             
                                                               ");

                                                               while($rs=mysqli_fetch_array($modals)){
                                                               $no++;	
                                                        ?>



                                          <?php echo $rs['emp_no']; ?> <?php echo $rs['full_name']; ?>
                                          <?php echo $rs['req']; ?>,<br>



                                          <?php } ?>
                                   </td>
                            </tr>


                            <?php
                            $has_approve3=mysqli_query($connect, "SELECT 
                                                                      c.emp_no
                                                                      FROM hrmrequestapproval a
                                                                      LEFT JOIN hrmorgstruc b on a.approval_list=b.pos_code
                                                                      LEFT JOIN teodempcompany c on b.position_id=c.position_id
                                                                      WHERE 
                                                                      a.request_no='$id' and
                                                                      a.req = 'Required' and
                                                                      a.status = '1'
                                                                      ");
                            $var_approver3 = mysqli_num_rows($has_approve3);
                            $var_has_approver3 = mysqli_fetch_array($has_approve3);

                     
                            if($var_approver3 > 0) {
                            $var_who_approver3 = $var_has_approver3['emp_no'];
                                   echo '<tr>
                                                 <td>     
                                                 </td>
                                                 <td colspan="3" style="font-weight: bold; color:#ffa759;font-size: x-small; vertical-align: top;font-size: smaller;font-family: verdana;font-style: oblique;">
                                                        '.$var_who_approver3.' Has Been Approved
                                                 </td>
                                          </tr>';
                            } else {
                                   echo '';
                            }
                            ?>




                            <tr>

                                   <td colspan="4" align="right" width="100%">
                                          <div class="modal-footer">
                                                 <div class="form-group">

                                                        <?php
                                                 $check_notification=mysqli_query($connect, "SELECT * FROM hrmrequestapproval
                                                                                                  where 
                                                                                                  request_no = '$id' and 
                                                                                                  req = 'Notification'
                                                                                                  GROUP BY req");
                                                        $check_sequence=mysqli_query($connect, "SELECT * FROM hrmrequestapproval
                                                                                                  where 
                                                                                                  request_no = '$id' and 
                                                                                                  req = 'Sequence'
                                                                                                  GROUP BY req");
                                                               $check_required=mysqli_query($connect, "SELECT * FROM hrmrequestapproval
                                                                                                  where 
                                                                                                  request_no = '$id' and 
                                                                                                  req = 'Required'
                                                                                                  GROUP BY req");

                                                 $var_check_notification                   = mysqli_num_rows($check_notification);
                                                        $var_check_sequence                = mysqli_num_rows($check_sequence);
                                                               $var_check_required         = mysqli_num_rows($check_required);
                                          
                                                 



                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                 
                                                 // START VALIDATION APPROVER
                                                 // START VALIDATION APPROVER
                                                 // START VALIDATION APPROVER
                                                 // START VALIDATION APPROVER
                                                 // START VALIDATION APPROVER
                                                 // START VALIDATION APPROVER
                                                 // START VALIDATION APPROVER
                                                 // START VALIDATION APPROVER
                                                 // START VALIDATION APPROVER
                                                 // START VALIDATION APPROVER
                                                 
                                                 // MENGECEK APAKAH TERDAPAT SETTING UNTUK ACKNOWLEDGE PADA REQUEST FORMULA
                                                 IF($var_check_sequence > 0 && $var_check_required > 0) {

                                                               $check_approve2=mysqli_query($connect, "SELECT 
                                                               c.emp_no
                                                               FROM hrmrequestapproval a
                                                               LEFT JOIN hrmorgstruc b on a.approval_list=b.pos_code
                                                               LEFT JOIN teodempcompany c on b.position_id=c.position_id
                                                               WHERE
                                                               a.request_no='$id' and
                                                               a.req = 'Sequence' and
                                                               a.status = '1'
                                                               ");
                                                               $check_approver2 = mysqli_num_rows($check_approve2);
                                                               $var_check_approver2 = mysqli_fetch_array($check_approve2);

                                                               // JIKA IYA MAKA CEK LAGI SUDAH APPROVE ATAU BELUM
                                                               if($check_approver2 < 1) {

                                                                      // CEK UNTUK SEQUENCE SUDAH APPROVE ATAU BELUM
                                                                      $var_approver_seq = mysqli_query($connect, "SELECT 
                                                                                                                c.emp_no,
                                                                                                                a.approval_list
                                                                                                                FROM hrmrequestapproval a
                                                                                                                LEFT JOIN hrmorgstruc b on a.approval_list=b.pos_code
                                                                                                                LEFT JOIN teodempcompany c on b.position_id=c.position_id
                                                                                                                WHERE
                                                                                                                a.request_no='$id' and
                                                                                                                a.req = 'Sequence' and
                                                                                                                c.emp_no = '$username' and
                                                                                                                a.status = '0'
                                                                                                                ");
                                                                      $check_var_approver_seq = mysqli_num_rows($var_approver_seq);
                                                                      $var_check_approver_seq = mysqli_fetch_array($var_approver_seq);

                                                                      if($check_var_approver_seq > 0){
                                                                             echo '
                                                                             <td><form method="post" id="myform">
                                                                                           <input type="hidden" name="request_no" value="'.$id.'">
                                                                                           <input type="hidden" name="request_app" value="'.$var_check_approver_seq['approval_list'].'">
                                                                                           <button type="submit" style="border: 0; background: transparent" name="submit_approve" value="submit"><img src="../../asset/img/icons/acticon-ok.png" alt="Submit"></button>
                                                                                    </form></td>
                                                                             <td><form method="post" id="myform">
                                                                                           <input type="hidden" name="request_no" value="'.$id.'">
                                                                                           <input type="hidden" name="request_app" value="'.$var_check_approver_seq['approval_list'].'">
                                                                                           <button type="button" id="formButton" style="border: 0; background: transparent" name="submit_approve" value="submit"><img src="../../asset/img/icons/acticon-rev.png" alt="Submit"></button>
                                                                                    </form></td>
                                                                             <td><form method="post" id="myform" onsubmit="return myFunctionCancel()"">
                                                                                           <input type="hidden" name="request_no" value="'.$id.'">
                                                                                           <input type="hidden" name="request_app" value="'.$var_check_approver_seq['approval_list'].'">
                                                                                           <button type="submit" style="border: 0; background: transparent" name="submit_reject" value="submit"><img src="../../asset/img/icons/acticon-no.png" alt="Submit"></button>
                                                                                    </form>
                                                                             </td>
                                                                                    
                                                                                    ';
                                                                             } else {
                                                                                    echo '';
                                                                             }

                                         
                                                               } else {
                                                                      // CEK APAKAH TERDAPAT REQUIRED PADA REQUEST TERSEBUT
                                                                      $check_approve3=mysqli_query($connect, "SELECT
                                                                      c.emp_no
                                                                      FROM hrmrequestapproval a
                                                                      LEFT JOIN hrmorgstruc b on a.approval_list=b.pos_code
                                                                      LEFT JOIN teodempcompany c on b.position_id=c.position_id
                                                                      WHERE
                                                                      a.request_no='$id' and
                                                                      a.req = 'Required' and
                                                                      a.status = '1'
                                                                      ");
                                                                      $check_approver3 = mysqli_num_rows($check_approve3);
                                                                      $var_check_approver3 = mysqli_fetch_array($check_approve3);

                                                                      // JIKA IYA MAKA CEK LAGI SUDAH APPROVE ATAU BELUM
                                                                      if($check_approver3 < 1) {

                                                                             // CEK UNTUK REQUIRED SUDAH APPROVE ATAU BELUM
                                                                             $var_approver_req = mysqli_query($connect, "SELECT 
                                                                             c.emp_no,
                                                                             a.approval_list
                                                                             FROM hrmrequestapproval a
                                                                             LEFT JOIN hrmorgstruc b on a.approval_list=b.pos_code
                                                                             LEFT JOIN teodempcompany c on b.position_id=c.position_id
                                                                             WHERE
                                                                             a.request_no='$id' and
                                                                             a.req = 'Required' and
                                                                             c.emp_no = '$username' and
                                                                             a.status = '0'
                                                                             ");
                                                                             $check_var_approver_req = mysqli_num_rows($var_approver_req);
                                                                             $var_check_approver_req = mysqli_fetch_array($var_approver_req);

                                                                             if($check_var_approver_req > 0){
                                                                                    echo '
                                                                                    <td><form method="post" id="myform">
                                                                                           <input type="hidden" name="request_no" value="'.$id.'">
                                                                                           <input type="hidden" name="request_app"  value="'.$var_check_approver_req['approval_list'].'">
                                                                                           <button type="submit" style="border: 0; background: transparent" name="submit_approve" value="submit"><img src="../../asset/img/icons/acticon-ok.png" alt="Submit"></button>
                                                                                    </form></td>
                                                                                    <td><form method="post" id="myform">
                                                                                           <input type="hidden" name="request_no" value="'.$id.'">
                                                                                           <input type="hidden" name="request_app" value="'.$var_check_approver_req['approval_list'].'">
                                                                                           <button type="button" id="formButton" style="border: 0; background: transparent" name="submit_approve" value="submit"><img src="../../asset/img/icons/acticon-rev.png" alt="Submit"></button>
                                                                                    </form></td>
                                                                                    ';
                                                                             } else {

                                                                             }
                                                                      } 
                                                               }
                                                 }

                                                 // END VALIDATION APPROVER
                                                 // END VALIDATION APPROVER
                                                 // END VALIDATION APPROVER
                                                 // END VALIDATION APPROVER
                                                 // END VALIDATION APPROVER
                                                 // END VALIDATION APPROVER
                                                 // END VALIDATION APPROVER
                                                 // END VALIDATION APPROVER
                                                 // END VALIDATION APPROVER
                                                 // END VALIDATION APPROVER
                                                 // END VALIDATION APPROVER
                                                 ?>

























































                                                 </div>
                                          </div>
                                   </td>
                            </tr>

                     </table>




<script>
function myFunctionCancel() {
  var txt;
  var r = confirm("Are You Sure You Want to Reject this Request?");
  if (r == true) {
    txt = window.location.replace('index');
  } else {
       return false;
  }
  document.getElementById("demo").innerHTML = txt;
}
</script>



                     <form name='form1' id="form1" method="post" onsubmit='return validasi()'>

                            <td colspan="3" class="" id="tdb_1"><textarea class="form-control"
                                          style="margin-bottom: 2px; width: 100%;" id="inp_remark" name="inp_remark"
                                          type="Text" value="" onfocus="hlentry(this)" size="20" maxlength="50" 
                                          validate="NotNull:Invalid Form Entry" onchange="formodified(this);"
                                          title=""></textarea>
                                          <input type="hidden" name="request_no" value="<?php echo $id; ?>">
                            </td>


                            <tr>
                                   <td colspan="3" align="right" width="100%">
          
                                                 <div class="form-group">
                                                        <button type="submit" name="submit_revised"
                                                               class="btn btn-warning">Revised</button>
                                                 </div>
                                
                                   </td>
                            </tr>
                     </form>
                     <script>
                     function validasi() {
                            var inp_remark = document.getElementById("inp_remark").value;

                            if (inp_remark == "") {
                                   alert("Remark for revise Cant empty");
                                   return false;
                            }
                            if (modal_emp != "" && modal_leave_start != "") {
                                   return true;
                            }
                     }
                     </script>



              </div>
       </div>




       <?php } ?>

</div>


</div>
</div>



<script>
$(document).ready(function() {
       $("#formButton").click(function() {
              $("#form1").toggle();
       });
});
</script>