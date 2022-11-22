<?php
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0'; 
if($getdata == 0) {
	include "../../application/session/session.php";
} else {
	include "../../application/session/mobile.session.php";	
}
?>

<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>

<?php
       $req_no = $_POST['id']; //Mengambil data req no dari tabel

       $datareq = mysqli_query($connect,"SELECT 
                                                 a.leaverequest_no,
                                                 b.emp_no,
                                                 b.full_name,
                                                 a.leave_code,
                                                 a.remark, 
                                                 (SELECT revised_remark FROM hrmrequestapproval WHERE request_no = '$req_no' LIMIT 1) as revised_remark
                                          FROM hrmleavecancelrequest a
                                          LEFT JOIN view_employee b on a.requestfor=b.emp_id
                                          WHERE a.request_no LIKE '$req_no'"); // Query untuk mengambil dari leave request
       
       while($row1=mysqli_fetch_array($datareq)){
?>



<?php 
$lvr_number = mysqli_fetch_array(mysqli_query($connect, "SELECT leaverequest_no FROM hrmleavecancelrequest WHERE request_no = '$req_no'"));
$lvr_number_print = $lvr_number['leaverequest_no'];
?>


<div class="modal-dialog ">
       <div class="modal-content modal-med">

              <div class="modal-header">
                     <h4 class="modal-title">Revising Leave Cancellation Request</h4>
                     <button onclick="window.location.href='../hrm{sys=leave.cancellation}'" type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" 
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
              </div>
                     <fieldset id="fset_1">
                                   <legend>Leave Entry Form</legend>

                                   <div class="form-row">
                                   <div class="col-4 name">Employee no*</div>
                                   <div class="col-sm-8">
                                          <div class="input-group">

                                                 <input class="input--style-6"
                                                        onkeyup="isi_otomatis(), isi_otomatis_leave()"
                                                        autocomplete="off" autofocus="on" id="modal_emp"
                                                        name="modal_emp" type="Text" value="<?php echo $row1['emp_no']; ?>"
                                                        onfocus="hlentry(this)" size="30" maxlength="50" 
                                                        validate="NotNull:Invalid Form Entry"
                                                        onchange="formodified(this);" title="" readonly>
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name">Name*</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6" style="background-color: #fff3b4;"
                                                               id="inp_nickname" name="inp_nickname" type="Text"
                                                               value="<?php echo $row1['full_name']; ?>" onfocus="hlentry(this)" size="20"
                                                               maxlength="50"  validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" readonly>
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name">Leave Request No. *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6" style="background-color: #fff3b4;"
                                                               id="inp_leavereq" name="inp_leavereq" type="Text"
                                                               value="<?php echo $row1['leaverequest_no']; ?>" onfocus="hlentry(this)" size="20"
                                                               maxlength="50"  validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" readonly>
                                                 </div>
                                          </div>
                                   </div>

                                  

                                   






              <div class="modal-header">
                     <h4 class="modal-title">Leave Cancellation Request</h4>
              </div>

              <!-- AgusPrass 04/03/2021 Mengganti searching form leave req -->

              <form method="POST" id="myform" onsubmit='return HrmsValidationForm()'>

                     <fieldset id="fset_1">
                            <legend><?php echo $req_no; ?></legend>

                            <div class="form-row">
                                   <div class="col-4 name">Request No.</div>
                                   <div class="col-sm-8 name">
                                          LCRYYYYMMXXXXXXX 
                                   </div>
                            </div>

                            <div class="form-row">
                                   <div class="col-4 name">Leave Request No.</div>
                                   <div class="col-sm-8 name">
                                          <?php echo $lvr_number_print; ?>
                                          <input id="inp_reqleavenumber" name="inp_reqleavenumber" type="Hidden" value="<?php echo $lvr_number_print; ?>" onfocus="hlentry(this)" size="30" maxlength="50"  onchange="formodified(this);" title="">
                                          <input id="inp_reqleavecancelnumber" name="inp_reqleavecancelnumber" type="Hidden" value="<?php echo $req_no; ?>" onfocus="hlentry(this)" size="30" maxlength="50"  onchange="formodified(this);" title="">
                                          <input id="inp_remark" name="inp_remark" type="Hidden" value="<?php echo $row1['remark']; ?>" onfocus="hlentry(this)" size="30" maxlength="50"  onchange="formodified(this);" title="">
                                   </div>
                            </div>

                            <div class="form-row">
                                   <div class="col-4 name">Request For</div>
                                   <div class="col-sm-8 name">
                                   [<?php echo $row1['emp_no']; ?>] <?php echo $r['full_name']; ?>
                                   </div>
                            </div>

                            <div class="form-row">
                                   <div class="col-4 name">Type of Leave</div>
                                   <div class="col-sm-8 name">
                                   <?php echo $row1['leave_code']; ?>
                                   </div>
                            </div>

                            <div class="form-row">
                                   <div class="col-4 name">Reason For Leave</div>
                                   <div class="col-sm-8 name">
                                   <?php echo $row1['remark']; ?>
                                   </div>
                            </div>

                            <div class="form-row">
                                   <div class="col-4 name">Reason For Cancellation</div>
                                   <div class="col-sm-8 name">
                                   <?php echo $row1['revised_remark']; ?>
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
									<input type="checkbox" onchange="checkAll(this)" name="chk[]" ></td>			
									<td class="header" style="background-color: lightgrey;" align="center">Leave Date</td>
                                                               <td class="header" style="background-color: lightgrey;" align="center">Total Days</td>
								</tr>
								<?php 
									$data = mysqli_query($connect, "SELECT a.leave_date,a.leave_starttime,
                                                               CASE
                                                                      WHEN dayrequesttype = 3 THEN 1
                                                                      ELSE 0.5
                                                                      END as total_days 
                                                               FROM hrdleaverequest a
									LEFT JOIN hrmleaverequest b on a.request_no=b.request_no
									LEFT JOIN view_employee c on b.emp_id=c.emp_id
                                                               LEFT JOIN hrmleavecancelrequest x on a.request_no=x.leaverequest_no
									LEFT JOIN hrdleavecancelrequest x1 on x.request_no=x1.request_no
									WHERE b.request_no='$lvr_number_print'
									and a.cancelsts = 'N'
                                                               and a.leave_date <> 
                                                               (CASE
									    WHEN (SELECT xx.leave_date FROM hrdleavecancelrequest xx WHERE xx.request_no=x.request_no) = '' THEN '0000-00-00 00:00:00'
									    WHEN (SELECT xx.leave_date FROM hrdleavecancelrequest xx WHERE xx.request_no=x.request_no) IS NULL THEN '0000-00-00 00:00:00'
									    ELSE (SELECT xx.leave_date FROM hrdleavecancelrequest xx WHERE xx.request_no=x.request_no)
									END)
                                                               GROUP BY a.leave_date
                                                               ");
									$no = 1;
									while($d = mysqli_fetch_array($data)){
								?>

                                                        
								
								<tr class="list-con odd">
									<td><?php echo $no++ ?></td>
									<td><input class="input--style-7" type="checkbox" class="tanggal" name="pilih[]" value="<?php echo $d['leave_date']; ?>"></td>	
									<td><?php echo $d['leave_starttime']; ?></td>	
                                                               <td style='align:center' align="center style='align:center'"><?php echo $d['total_days']; ?></td>	
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



                                   <div id="box"></div>
                                   <div id="boxifblur"></div>

                                   <br>
                                   <tr>
                                          <td colspan="2" align="right" width="100%">
                                                 <div class="modal-footer">
                                                        <div class="form-group">

                                                               <button type="submit" name="submit_revised" class="btn btn-warning">Submit</button>
                                                        </div>
                                                 </div>
                                          </td>
                                   </tr>

                            </fieldset>


                            <tr>
                                   <td colspan="3" align="right" width="100%">
                                          <div class="modal-footer">
                                                 <div class="form-group">
                                                        <button onclick="window.location.href='../hrm{sys=leave.cancellation}'" type="button" class="btn btn-default"
                                                               data-dismiss="modal">Cancel</button>

                                                        <script language="javascript" type="text/javascript">
                                                        
                                                        function OpenPopupCenter(val, pageURL,
                                                               title, w, h) {
                                                               var modal_emp = document.getElementById("modal_emp").value;
                                                               var left = (screen.width - w) / 2;
                                                               var top = (screen.height - h) /
                                                                      50; // for 25% - devide by 4  |  for 33% - devide by 3
                                                               var targetWin = window.open(
                                                                      'window_approver?rfid=' +
                                                                      modal_emp, title,
                                                                      'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' +
                                                                      w + ', height=' + h +
                                                                      ', top=' + 50 +
                                                                      ', left=' + left);
                                                        }
                                                        </script>
                                                        </head>

                                                        <body>
                                                        <a href='#' id="show_preview" class="btn btn-primary" style="color: cornsilk;" onclick='return startload()'>
                                                               Preview Approver
                                                        </a>

                                                        <a href='#' id="show_preview2" style='display:none;' class="btn btn-primary" style="color: cornsilk;" onclick='return startload()'>
                                                                      Preview Approver
                                                        </a>
                                                               <!-- <a id="four" class="btn btn-primary" name="four"
                                                                      onclick="OpenPopupCenter(this.value, 'TEST!?', 450, 900);"
                                                                      target="_blank">Preview
                                                                      Approver</a> -->

                                                        </body>

                                                        <script>
                                                        $(function() {
                                                               var $src = $('#modal_emp'),
                                                                      $dst = $('#four'
                                                                      );
                                                               $src.on('input',
                                                                      function() {
                                                                             $dst.val($src
                                                                                    .val());
                                                                      });
                                                        });
                                                        </script>


                     
                                                 </div>
                                          </div>
                                   </td>
                            </tr>

                            
		</form>

<?php } ?>

              <script>
              function HrmsValidationForm() {
                   
                     var atLeastOneIsChecked = $('input[name="pilih[]"]:checked').length > 0;


                     if (atLeastOneIsChecked == 0) {
                            alert("Please select date");
                            return false;
                     } else {
                            return true;
                            $('#loading').show();
                     }
              }
              </script>

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

              <script>
              $(document).ready(function(){
                            $("#show_preview").click(function(){
                                   $("#boxifblur").hide();
                                   var modal_emp = document.getElementById("modal_emp").value;
                                   $("#box").load("../../hrm/hrm{sys=time.attendance}/modal_preview_apv.php?rfid=" + modal_emp, function(responseTxt, statusTxt, jqXHR){
                                   if(statusTxt == "success"){
                                          // alert("New content loaded successfully!");
                                          $("#box").show();

                                          $("#show_preview").show();
                                          $("#show_preview2").hide();
                                   }
                                   if(statusTxt == "error"){
                                          alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                   }
                            });
                      });
              });
              </script>

              <script>
              $(document).ready(function(){
                     var inp_nickname = document.getElementById("inp_nickname").value;
                     $('#inp_nickname').on('change', function() {
                            var modal_emp = document.getElementById("modal_emp").value;
                                   $("#show_preview2").click(function(){
                                   $("#box").hide();
                                   $("#boxifblur").show();
                                          $("#boxifblur").load("../../hrm/hrm{sys=time.attendance}/modal_preview_apv.php?rfid=" + modal_emp, function(responseTxt, statusTxt, jqXHR){
                                          if(statusTxt == "success"){
                                                 //alert("New content loaded successfully! if blur");
                                                 $("#boxifblur").show();
                                          }
                                          if(statusTxt == "error"){
                                                 alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                          }
                                   });
                            });

                            $("#show_preview").hide();
                            $("#show_preview2").show();
                     });
              });
              </script>



       </div>

</div>
</div>
</div>








<!-- Javascript untuk popup modal Edit-->
<script type="text/javascript">
$(document).ready(function() {

       $(".open_modal_search").click(function(e) {
              var m = $(this).attr("id");
              var modal_emp = document.getElementById("modal_emp").value;
              var inp_leavereq = document.getElementById("inp_leavereq").value;

              $.ajax({
                     url: "modal_leave_cancellation.php",
                     type: "POST",
                     data: {
                            rfid: modal_emp,
                            xfid: inp_leavereq,
                     },
                     success: function(ajaxData) {
                            $("#ModalEdits1").html(ajaxData);
                            $("#ModalEdits1").modal({
                                  
                            });
                     }
              });
       });
});
</script>



<div id="ModalEdits1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="margin-left: -5px;"
                                   aria-hidden="true">
</div>