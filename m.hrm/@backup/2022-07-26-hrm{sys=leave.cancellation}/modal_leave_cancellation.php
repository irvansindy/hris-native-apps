<?php 
include "../../application/session/session.php";
$rfid = $_POST['rfid'];
$xfid = $_POST['xfid'];
$modal=mysqli_query($connect,"SELECT 
                                          a.request_no,
                                          c.emp_no,
                                          c.full_name,
                                          a.leave_code,
                                          a.remark
				       FROM
				       hrmleavecancelrequest a
                                   LEFT JOIN hrdleavecancelrequest b on a.request_no=b.request_no
                                   LEFT JOIN view_employee c on a.requestfor=c.emp_id
				       WHERE a.leaverequest_no='$xfid'
                                   GROUP BY a.leaverequest_no
		");



$data = mysqli_num_rows($modal);
if($data == 0)
{
		echo "<script type='text/javascript'>
					window.alert('$xfid Not Founds / Awaiting Approval from your appropriate');
					window.location.replace('../hrm{sys=leave.cancellation}');         
			  </script>";
  }
?>





<?php
	while($r=mysqli_fetch_array($modal)){

              $modal_request_no = $r['request_no'];
?>


<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>

<div class="modal-dialog modal-med" style="padding-left: -100px;">
       <div class="modal-content">

              <div class="modal-header">
                     <h4 class="modal-title">Leave Cancellation Request</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
              </div>

              <!-- AgusPrass 04/03/2021 Mengganti searching form leave req -->

              <form method="post" id="myform" onsubmit='return HrmsValidationForm()'>

                     <fieldset id="fset_1">
                            <legend>Searching Form [<?php echo $rfid; ?>]</legend>

                            <div class="form-row">
                                   <div class="col-4 name">Request No.</div>
                                   <div class="col-sm-8 name">
                                          LCRYYYYMMXXXXXXX 
                                   </div>
                            </div>

                            <div class="form-row">
                                   <div class="col-4 name">Leave Request No.</div>
                                   <div class="col-sm-8 name">
                                          <?php echo $r['request_no']; ?>
                                          <input id="inp_reqleavenumber" name="inp_reqleavenumber" type="Hidden" value="<?php echo $xfid; ?>" onfocus="hlentry(this)" size="30" maxlength="50"  onchange="formodified(this);" title="">
                                          <input id="inp_reqleavecancelnumber" name="inp_reqleavecancelnumber" type="Hidden" value="<?php echo $modal_request_no; ?>" onfocus="hlentry(this)" size="30" maxlength="50"  onchange="formodified(this);" title="">
                                   </div>
                            </div>

                            <div class="form-row">
                                   <div class="col-4 name">Request For</div>
                                   <div class="col-sm-8 name">
                                   [<?php echo $r['emp_no']; ?>] <?php echo $r['full_name']; ?>
                                   </div>
                            </div>

                            <div class="form-row">
                                   <div class="col-4 name">Type of Leave</div>
                                   <div class="col-sm-8 name">
                                   <?php echo $r['leave_code']; ?>
                                   </div>
                            </div>

                            <div class="form-row">
                                   <div class="col-4 name">Reason For Cancellation</div>
                                   <div class="col-sm-8 name">
                                   <textarea class="input--style-6" maxlength="255" id="inp_remark" name="inp_remark"
                                   rows="3" 
                                   cols="40"><?php echo $r['remark']; ?></textarea>
                                   </div>
                            </div>

                     </fieldset>

                     <fieldset id="fset_1"><legend>Add</legend><table style="width: 95%;"><tbody>
	<tr id="tr_inp_detailform" class="clTR2">
		<td colspan="2" class="label" id="tdb_1">
			<div id="cancellation">
				<table width="" align="center" cellpadding="2" cellspacing="1" bordercolor="" id="tblDetail">
							<tbody>
								<tr class="colheaderrel">
									<td class="header" style="background-color: lightgrey;" align="center">No</td>				
									<td class="header" style="background-color: lightgrey;" align="center">
									<input type="checkbox" onchange="checkAll(this)" checked="checked" name="chk[]" ></td>			
									<td class="header" style="background-color: lightgrey;" align="center">Leave Date</td>
                                                               <td class="header" style="background-color: lightgrey;" align="center">Total Days</td>
								</tr>
								<?php 
									$data = mysqli_query($connect, "select *,
                                                               CASE
                                                                      WHEN dayrequesttype = 3 THEN 1
                                                                      ELSE 0.5
                                                                      END as total_days 
                                                               FROM hrdleaverequest a
									LEFT JOIN hrmleaverequest b on a.request_no=b.request_no
									LEFT JOIN VIEW_EMPLOYEE c on b.emp_id=c.emp_id
                                                               LEFT JOIN hrmleavecancelrequest x on a.request_no=x.leaverequest_no
									LEFT JOIN hrdleavecancelrequest x1 on x.request_no=x1.request_no
									WHERE c.emp_no='$rfid' and x.leaverequest_no='$xfid'
                                                               and x.request_no = '$modal_request_no'
									and a.cancelsts = 'N'
                                                               and a.leave_date = x1.leave_date");
									$no = 1;
									while($d = mysqli_fetch_array($data)){
								?>
								
								<tr class="list-con odd">
									<td><?php echo $no++; ?></td>
									<td><input type="checkbox" checked="checked" class="tanggal" name="pilih[]" value="<?php echo $d['leave_date']; ?>"></td>	
									<td><?php echo $d['leave_starttime']; ?></td>	
                                                               <td><?php echo $d['total_days']; ?></td>	
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</span>
			</td>
		</tr>
	</table>
</fieldset>

<script type="text/javascript">
  function checkAll(ele) {
       var checkboxes = document.getElementsByTagName('input');
       if (ele.checked) {
           for (var i = 0; i < checkboxes.length; i++) {
               if (checkboxes[i].type == 'checkbox'  && !(checkboxes[i].disabled) ) {
                   checkboxes[i].checked = true;
               }
           }
       } else {
           for (var i = 0; i < checkboxes.length; i++) {
               if (checkboxes[i].type == 'checkbox') {
                   checkboxes[i].checked = false;
               }
           }
       }
   }

 </script>


                     <br>
                     <tr>
                            <td colspan="2" align="right" width="100%">
                                   <div class="modal-footer">
                                          <div class="form-group">
                                                 <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Cancel</button>
                                                 <button type="submit" id="submit_revised" name="submit_revised" class="btn btn-warning">Submit</button>
                                          </div>
                                   </div>
                            </td>
                     </tr>


                     </table>
       </div>
       </form>


       <?php } ?>


</div>

</div>
</div>
</div>



<script>
              function HrmsValidationForm() {
                     var inp_remark = document.getElementById("inp_remark").value;
                     var checkedCount = $('input[class="tanggal"]:checked').length;



                     if (inp_remark == "") {
                            alert("Remark Cant empty");
                            return false;
                     } else  if (checkedCount == 0) {
                            alert("Please select at least one date of leave");
                            return false;
                     } else {
                            return true;
                            $('#loading').show();
                     }
              }
              </script>
