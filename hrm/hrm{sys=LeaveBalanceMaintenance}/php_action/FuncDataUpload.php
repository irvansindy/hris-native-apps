<style>
body {
       font-family: Arial;
       margin: 0;
}

.header {
       padding-bottom: 5px;
       text-align: center;
       background: #3d8ad9;
       font-weight: 200px;
       color: white;
       height: 25px;
       border-bottom: 3px solid #FFF;
}
</style>


<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<?php require_once '../../../application/config.php'; ?>
<?php require_once '../../../application/session/session.php'; ?>
<?php
date_default_timezone_set('Asia/Bangkok');
?>



       <!-- Form -->
       <!-- <form method='post' action=''> -->
       <form name="myForm" onsubmit="return HrmsValidationForm()" method="post">

       <!-- Name: <input type="text" name="fname"> -->

              <!-- Submit button -->
              

              <table width="100%" cellspacing="1" cellpadding="2" bordercolor="" align="left" style="font-size: 12px;">
                     <tbody>
                            <tr class="colheaderrel">
                                   <td class="header" align="left">Select
                                          <input id='checkAll' name="inp_chkAll" type="checkbox" onclick="checkAll();"
                                                 align="middle">
                                   </td>
                                   <td class="header">Employee No</td>
                                   <td class="header">Name</td>
                                   <td class="header">Start Valid Date</td>
                                   <td class="header">End Valid Date</td>
                                   <td class="header">Next Valid Date</td>
                                   <td class="header">Current Period</td>
                                   <td class="header">Entitlement</td>
                                   <td class="header">Proportional</td>
                                   <td class="header">Bring Forward</td>
                                   <td class="header">Forfeited</td>
                                   <td class="header">Adjustment</td>
                                   <td style="display:none;" class="header">Allow to take</td>
                                   <td class="header">Used</td>
                                   <td class="header">Remaining</td>
                                   <td class="header" align="center">Remark</td>
                                   <td class="header">Active Status</td>
                            </tr>

                     </tbody>
                     <?php
       for($iemg=0;$iemg<count($_POST['sel_parameter']);$iemg++){
              $iemg_plus = $iemg+1;

              $list_ofleave		= $_POST['list_ofleave'];
              $rfid = $_POST['leave_status'];
              if($rfid == '2') {
                     $where_active = "AND a.active_status IN ('0','1')";
              } else {
                     $where_active = "AND a.active_status = '$rfid'";
              }

              $sel_parameters	= $_POST['sel_parameter'][$iemg];

              // echo  $sel_parameters;
       ?>


       <?php
              $data_employee = mysqli_query($connect, "SELECT * FROM hrmempleavebal a
                                                        LEFT JOIN view_employee b ON a.emp_id=b.emp_id
                                                        WHERE b.emp_no = '$sel_parameters' and a.leave_code = '$list_ofleave' $where_active");
              while($r=mysqli_fetch_array($data_employee)){
                     $id = $r['empgetleave_id'];
                     $username = $r['emp_no'];
                     $remark = $r['emp_no'];
                     $status = $r['active_status'];
                     if($status == '1') {
                            $print_status = 'Active';
                            $list = '<option value="0">Inactive</option>';
                     } else if ($status == '0') {
                            $print_status = 'Inactive';
                            $list = '<option value="1">Active</option>';
                     } else {
                            $list = '<option value="1">Active</option><option value="0">Inactive</option>';
                     }

              ?>

                            <tr>
                                   <td><input type='checkbox' id="cek<?= $id ?>" name='update[]' value='<?= $id ?>'></td>
                                   <td><?php echo $sel_parameters; ?></td>
                                   <td><?php echo $r['Full_Name']; ?></td>
                                   <td><input type="text" id="startvaliddate" name='startvaliddate_<?= $id ?>'
                                                 value="<?php echo $r['startvaliddate']; ?>"></td>
                                   <td><input type="text" id="endvaliddate" name='endvaliddate_<?= $id ?>'
                                                 value="<?php echo $r['endvaliddate']; ?>"></td>
                                   <td><input type="text" id="nextvaliddate" name='nextvaliddate_<?= $id ?>'
                                                 value="<?php echo $r['nextvaliddate']; ?>"></td>
                                   <td>-</td>
                                   <td><?php echo $r['entitlement']; ?></td>
                                   <td><?php echo $r['proportional']; ?></td>
                                   <td><?php echo $r['bringforward']; ?></td>
                                   <td><?php echo $r['forfeited']; ?></td>
                                   <td><input type="text" id="inp_adjustment_1<?php echo $r['empgetleave_id']; ?>"
                                                 name='inp_adjustment_1_<?= $id ?>'
                                                 value=""></td>
                                   <td style="display:none;"><?php echo $r['remaining']-$r['used']; ?></td>
                                   <td><?php echo $r['used']; ?><input type="hidden"
                                                 id="used<?php echo $r['empgetleave_id']; ?>" name='used_<?= $id ?>'
                                                 value="<?php echo $r['used']; ?>"></td>

                                   <td>
                                          <div class="input-group" id="sel_remaining<?php echo $r['empgetleave_id']; ?>"
                                                 style="font-weight: bold;color: #5b5b5b;"></div>
                                          <div class="input-group" id="sel_remaining_before<?php echo $r['empgetleave_id']; ?>"
                                                 style="font-weight: bold;color: #5b5b5b;"><?php echo $r['remaining']; ?></div>
                                          <input type="hidden" id="current_remaining<?php echo $r['empgetleave_id']; ?>"
                                                 name='current_remaining_<?= $id ?>' value="<?php echo $r['remaining']; ?>">
                                          <input type="hidden" id="last_remaining<?php echo $r['empgetleave_id']; ?>"
                                                 name='last_remaining_<?= $id ?>' value="<?php echo $r['remaining']; ?>">
                                   </td>

                                   <td><textarea id="remark<?php echo $r['empgetleave_id']; ?>" name='remark_<?= $id ?>' name="remark"></textarea></td>
                                   <td><select id="active_status_<?= $id ?>" 
                                                 name="active_status_<?= $id ?>">
                                                 <option value="<?php echo $r['active_status']; ?>"><?php echo $print_status; ?></option>
                                                 <?php echo $list; ?>
                                          
                                   </select></td>
                            </tr>

                            <script type="text/javascript">
                            $(document).ready(function() {
                                    // Check/Uncheck ALl
                                   $('#inp_adjustment_1<?php echo $r['empgetleave_id']; ?> , #remark<?php echo $r['empgetleave_id']; ?> , #active_status_<?php echo $r['empgetleave_id']; ?> ' ).change(function() {
                          
                                                 var inp_adjustment_1<?php echo $r['empgetleave_id']; ?> = $("#inp_adjustment_1<?php echo $r['empgetleave_id']; ?>").val();
                                                 var remark<?php echo $r['empgetleave_id']; ?> = $("#remark<?php echo $r['empgetleave_id']; ?>").val();

                                                 if(inp_adjustment_1<?php echo $r['empgetleave_id']; ?> == '' && remark<?php echo $r['empgetleave_id']; ?> == '' ) {
                                                        $('input[id="cek<?= $id ?>"]').prop('checked', false);
                                                 } else {
                                                        $('input[id="cek<?= $id ?>"]').prop('checked', true);
                                                 }

                                                 var numberOfChecked = $('input:checkbox:checked').length;

                                                 if(numberOfChecked > 0) {
                                                        $("#but_update").show();
                                                 } else {
                                                        $("#but_update").hide();
                                                 }
                                                 
                                      
                                   });
                            });
                            </script>

                            <script type="text/javascript">
                            $(document).ready(function() {
                                   $("#last_remaining<?php echo $r['empgetleave_id']; ?>, #inp_adjustment_1<?php echo $r['empgetleave_id']; ?>")
                                          .keyup(function() {

                                                 var inp_adjustment_1<?php echo $r['empgetleave_id']; ?> =
                                                        $(
                                                               "#inp_adjustment_1<?php echo $r['empgetleave_id']; ?>")
                                                        .val();
                                                 var last_remaining<?php echo $r['empgetleave_id']; ?> =
                                                        $(
                                                               "#last_remaining<?php echo $r['empgetleave_id']; ?>")
                                                        .val();
                                                 var used<?php echo $r['empgetleave_id']; ?> = $(
                                                               "#used<?php echo $r['empgetleave_id']; ?>")
                                                        .val();

                                                 var ss =
                                                        Number(last_remaining<?php echo $r['empgetleave_id']; ?>) +
                                  
                                                        Number(inp_adjustment_1<?php echo $r['empgetleave_id']; ?>);

                                                 console.log(ss);
                                                 if (isNaN(ss)) {
                                                        console.log('failed');
                                                        $("#current_remaining<?php echo $r['empgetleave_id']; ?>").val("Please insert number");
                                                 } else {
                                                        $("#current_remaining<?php echo $r['empgetleave_id']; ?>").val(ss);
                                                        document.getElementById("sel_remaining<?php echo $r['empgetleave_id']; ?>").innerHTML = ss;
                                                        $('#sel_remaining_before<?php echo $r['empgetleave_id']; ?>').hide();
                                                 }

                                          });
                            });
                            </script>

       <?php
              }}
       ?>

                            <tr>
                                   <td colspan="16" style="text-align: right;padding-top: 15px;"><input type='submit' style="display:none;" onclick='return HrmsValidationForm()' value='Update'
                                   name='but_update' id='but_update'></td>
                            </tr>

              </table>

              
       </form>
</div>

<script type="text/javascript" src="../../../asset/sdk_datatables_core/gt_dist/jQuery-2.1.4.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

       // Check/Uncheck ALl
       $('#checkAll').change(function() {
              if ($(this).is(':checked')) {
                     $('input[name="update[]"]').prop('checked', true);
              } else {
                     $('input[name="update[]"]').each(function() {
                            $(this).prop('checked', false);
                     });
              }

              var numberOfChecked = $('input:checkbox:checked').length;
              if(numberOfChecked > 0) {
                     $("#but_update").show();
              } else {
                     $("#but_update").hide();
              }
       });

       // Checkbox click
       $('input[name="update[]"]').click(function() {
              var total_checkboxes = $('input[name="update[]"]').length;
              var total_checkboxes_checked = $('input[name="update[]"]:checked').length;

              if (total_checkboxes_checked == total_checkboxes) {
                     $('#checkAll').prop('checked', true);
              } else {
                     $('#checkAll').prop('checked', false);
              }

              var numberOfChecked = $('input:checkbox:checked').length;
              if(numberOfChecked > 0) {
                     $("#but_update").show();
              } else {
                     $("#but_update").hide();
              } 
       });
});
</script>


<?php
if(isset($_POST['but_update'])){
  if(isset($_POST['update'])){
    foreach($_POST['update'] as $updateid){

      $remark = $_POST['remark_'.$updateid];
      $remaining = $_POST['current_remaining_'.$updateid];
      $active = $_POST['active_status_'.$updateid];
      $startvaliddate = date ("Y-m-d", strtotime ($_POST['startvaliddate_'.$updateid]));
      $endvaliddate = date ("Y-m-d", strtotime ($_POST['endvaliddate_'.$updateid])); 
      $nextvaliddate = date ("Y-m-d", strtotime ($_POST['nextvaliddate_'.$updateid]));

     

       $process = mysqli_query($connect, "UPDATE hrmempleavebal SET
                      startvaliddate = '$startvaliddate',
                      endvaliddate =  '$endvaliddate',
                      nextvaliddate = '$nextvaliddate',
                      remaining = '$remaining',
                      active_status = '$active',
                      modified_by = '$username',
                      modified_date = '$SFdatetime'
                      WHERE empgetleave_id = '$updateid'");

       if($process) {

              echo "<script>alert('successfully update leave balance')</script>";
              echo "<script>window.close();</script>";
              
              
       } else {
               return false;
       }
      
    }
  }
}
?>