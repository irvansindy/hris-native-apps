<?php
       include "../../../application/config.php";
       $rfid = $_GET['rfid'];
       $xfid = $_GET['xfid'];
       $modal=mysqli_query($connect,"SELECT a.request_no
										FROM
										hrmleaverequest a
										LEFT JOIN view_employee b ON a.emp_id=b.emp_id
										LEFT JOIN hrmstatus d on (SELECT request_status FROM hrmrequestapproval WHERE request_no = a.request_no ORDER BY `request_status` DESC limit 1)=d.code
										WHERE b.emp_no='$rfid' and a.request_no='$xfid' and (d.code IN ('3'))
		");

$data = mysqli_num_rows($modal);
if($data == 0)
{
		echo "<script type='text/javascript'>
					window.alert('$rfid $xfid Not Founds / Awaiting Approval from your appropriate');
					window.location.replace('../hrm{sys=leave.cancellation}');         
			  </script>";
  }
?>





<?php
   
   $rfid = $_GET['rfid'];
   $xfid = $_GET['xfid'];
		// $rfid = '13-0299';
		// $xfid = 'LVR20210106171009';
		$modal=mysqli_query($connect,"SELECT
										a.request_no,
										b.emp_no,
										b.full_name,
										a.leave_code,
										a.remark
										FROM
										hrmleaverequest a
										LEFT JOIN view_employee b ON a.emp_id=b.emp_id
										LEFT JOIN hrmstatus d on (SELECT request_status FROM hrmrequestapproval WHERE request_no = a.request_no ORDER BY `request_status` DESC limit 1)=d.code
										WHERE b.emp_no='$rfid' and a.request_no='$xfid' and (d.code IN ('3'))
		");
	while($r=mysqli_fetch_array($modal)){
?>


<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>



<div class="modal-header">
       <h4 class="modal-title">Leave Cancellation Request</h4>

</div>

<!-- AgusPrass 04/03/2021 Mengganti searching form leave req -->

<!-- <form method="POST" id="myform" onsubmit='return HrmsValidationForm()'> -->

       <fieldset id="fset_1">
              <legend><?php echo $r['request_no']; ?></legend>

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
                            <input id="inp_reqleavenumber" name="inp_reqleavenumber" type="Hidden"
                                   value="<?php echo $xfid; ?>" onfocus="hlentry(this)" size="30" maxlength="50"
                                   onchange="formodified(this);" title="">
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
                     <div class="col-4 name">Reason For Leave</div>
                     <div class="col-sm-8 name">
                            <?php echo $r['remark']; ?>
                     </div>
              </div>

              <div class="form-row">
                     <div class="col-4 name">Reason For Cancellation</div>
                     <div class="col-sm-8 name">
                            <textarea class="input--style-6" maxlength="255" id="inp_remark" name="inp_remark" rows="3"
                                   cols="40"></textarea>
                     </div>
              </div>

       </fieldset>

       <fieldset id="fset_1">
              <legend>Add</legend>
              <table style="width: 95%;">
                     <tbody>
                            <tr id="tr_inp_detailform" class="clTR2">
                                   <td colspan="2" class="label" id="tdb_1">
                                          <div id="cancellation">
                                                 <table width="" align="center" cellpadding="2" cellspacing="1"
                                                        bordercolor="" id="tblDetail">
                                                        <tbody>
                                                               <tr class="colheaderrel">
                                                                      <td class="header"
                                                                             style="background-color: lightgrey;"
                                                                             align="center">No</td>
                                                                      <td class="header"
                                                                             style="background-color: lightgrey;"
                                                                             align="center">
                                                                             <input type="checkbox"
                                                                                    onchange="checkAll(this)"
                                                                                    name="chk[]">
                                                                      </td>
                                                                      <td class="header"
                                                                             style="background-color: lightgrey;"
                                                                             align="center">Leave Date</td>
                                                                      <td class="header"
                                                                             style="background-color: lightgrey;"
                                                                             align="center">Total Days</td>
                                                               </tr>
                                                               <?php 
									$data = mysqli_query($connect, "SELECT a.leave_date,a.leave_starttime,b.leave_code,b.request_no,
                                                               CASE
                                                                      WHEN dayrequesttype = 3 THEN 1
                                                                      ELSE 0.5
                                                                      END as total_days 
                                                               FROM hrdleaverequest a
									LEFT JOIN hrmleaverequest b on a.request_no=b.request_no
									LEFT JOIN view_employee c on b.emp_id=c.emp_id
                                                               LEFT JOIN hrmleavecancelrequest x on a.request_no=x.leaverequest_no
									LEFT JOIN hrdleavecancelrequest x1 on x.request_no=x1.request_no
									WHERE c.emp_no='$rfid' and b.request_no='$xfid'
									and a.cancelsts = 'N'
                                                               and a.leave_date <> 
                                                               (CASE
									    WHEN (SELECT xx.leave_date FROM hrdleavecancelrequest xx WHERE xx.request_no=x.request_no) = '' THEN '0000-00-00 00:00:00'
									    WHEN (SELECT xx.leave_date FROM hrdleavecancelrequest xx WHERE xx.request_no=x.request_no) IS NULL THEN '0000-00-00 00:00:00'
									    ELSE (SELECT xx.leave_date FROM hrdleavecancelrequest xx WHERE xx.request_no=x.request_no)
									END)");
									$no = 1;
									while($d = mysqli_fetch_array($data)){
								?>

                                                               <tr class="list-con odd">
                                                                      <td><?php echo $no++; ?></td>
                                                                      <input class="input--style-7" type="hidden"
                                                                             name="pilih0[]"
                                                                             value="<?php echo $d['leave_code']; ?>">

                                                                             
                                                                      <input class="input--style-7" type="hidden"
                                                                             name="pilih1[]"
                                                                             value="<?php echo $d['request_no']; ?>">


                                                                      <td><input class="input--style-7" type="checkbox"
                                                                                    class="tanggal" name="pilih[]"
                                                                                    value="<?php echo $d['total_days']; ?>~<?php echo $d['leave_date']; ?>">
                                                                      </td>
                                                                      <td><?php echo $d['leave_starttime']; ?></td>
                                                                      <td style='text-align:center'
                                                                             align="center style='align:center'">
                                                                             <?php echo $d['total_days']; ?></td>
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
                            if (checkboxes[i].type == 'checkbox' && !(checkboxes[i].disabled)) {
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
                            <div class="modal-footer">
                                   <button type="reset" class="btn btn-primary1" data-dismiss="modal"
                                          aria-hidden="true">
                                          &nbsp;Cancel&nbsp;
                                   </button>
                                   <button class="btn btn-warning" type="submit" name="submit_add" id="submit_add">
                                          Confirm
                                   </button>
                                   <button class="btn btn-warning" type="button" name="submit_add2"
                                          id="submit_add2" style='display:none;' disabled>
                                          <span class="spinner-grow spinner-grow-sm" role="status"
                                                 aria-hidden="true"></span>
                                          &nbsp;&nbsp;Processing..
                                   </button>
                            </div>     


       </table>
       </div>
<!-- </form> -->


<?php } ?>


</div>

</div>
</div>
</div>



<script>
function HrmsValidationForm() {
       var inp_remark = document.getElementById("inp_remark").value;
       // var checkedCount = $('input[class="tanggal"]:checked').length;
       var atLeastOneIsChecked = $('input[name="pilih[]"]:checked').length > 0;


       if (inp_remark == "") {
              alert("Remark Cant empty");
              return false;
       } else if (atLeastOneIsChecked == 0) {
              alert("Please select date");
              return false;
       } else {
              return true;
              $('#loading').show();
       }
}
</script>