<?php
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0'; 
if($getdata == 0) {
	include "../../application/session/session.php";
} else {
	include "../../application/session/mobile.session.php";	
}
?>

<div class="modal-dialog">
       <div class="modal-content">

              <div class="modal-header">
                     <h4 class="modal-title">Add Leave Request</h4>
                     <button onclick="window.location.href='../hrm{sys=leave.cancellation}?emp_id=<?php echo $username; ?>'" type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" 
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
              </div>
              <form name='form1' method="post" onsubmit='return validasi()'>

                     

                     <fieldset id="fset_1">
                                   <legend>Leave Entry Form</legend>
                                   <table style="width: 95%;">
                                          <tbody>
                                                 <tr>
                                                        <td width="40%"><label id="lbl_inp_nickname" for="inp_nickname"
                                                                      title="">Employee No <span
                                                                             class="required">*</span></label>
                                                        </td>
                                                        <td colspan="3" class="" id="tdb_1">
                                                               <!-- <input type="text" onkeyup="isi_otomatis()" autofocus="on" class="form-control input-report" id="modal_emp" name="modal_emp" placeholder="Nip" autocomplete="off"> -->
                                                               <input class="form-control" style="margin-bottom: 2px;"
                                                                      onkeyup="isi_otomatis(), isi_otomatis_leave()"
                                                                      autocomplete="off"
                                                                      autofocus="on" id="modal_emp" name="modal_emp"
                                                                      type="Text" value="<?php echo $username; ?>" onfocus="hlentry(this)"
                                                                      size="30" maxlength="50" 
                                                                      validate="NotNull:Invalid Form Entry"
                                                                      onchange="formodified(this);" title="">
                                                        </td>
                                                 </tr>

                                                 <?php 
                                                        $emp = mysqli_fetch_array(mysqli_query($connect, "SELECT full_name FROM view_employee WHERE emp_no='$username'"));
                                                 ?>

       
                                                 
                                                 <tr id="tr_inp_nickname" class="clTR1">
                                                        <td><label id="lbl_inp_nickname" for="inp_nickname"
                                                                      title="">Employee Name <span
                                                                             class="required">*</span></label>
                                                        </td>
                                                        <td colspan="3" class="" id="tdb_1"><input class="form-control"
                                                                      style="margin-bottom: 2px;background-color: #fff3b4;"
                                                                      id="inp_nickname" name="inp_nickname" type="Text"
                                                                      value="<?php echo $emp['full_name']; ?>" onfocus="hlentry(this)" size="20"
                                                                      maxlength="50" 
                                                                      validate="NotNull:Invalid Form Entry"
                                                                      onchange="formodified(this);" title="" readonly>
                                                        </td>
                                                 </tr>


                                                 <tr id="tr_inp_nickname" class="clTR1">
                                                        <td><label id="lbl_inp_nickname" for="inp_nickname"
                                                                      title="">Leave Request No. <span
                                                                             class="required">*</span></label>
                                                        </td>
                                                        <td colspan="3" class="" id="tdb_1"><input class="form-control"
                                                                      style="margin-bottom: 2px; width: 50%;"
                                                                      id="inp_leavereq" name="inp_leavereq"
                                                                      type="Text" value="" onfocus="hlentry(this)"
                                                                      size="20" maxlength="50" 
                                                                      validate="NotNull:Invalid Form Entry"
                                                                      onchange="formodified(this);" title="">
                                                        </td>
                                                 </tr>

                                                 

                                                 

                                                 
                                                 <tr id="tr_inp_nickname" class="clTR1">
                                                        <td><label id="lbl_inp_nickname" for="inp_nickname"
                                                                      title=""><span
                                                                             class="required"></span></label>
                                                        </td>

                                                        
                                                        <script language="javascript" type="text/javascript">
                                                        
                                                        function OpenPopupCenterLeave(val, pageURL,
                                                               title, w, h) {
                                                               var modal_emp = document.getElementById("modal_emp").value;
                                                               var left = (screen.width - w) / 2;
                                                               var top = (screen.height - h) /
                                                                      50; // for 25% - devide by 4  |  for 33% - devide by 3
                                                               var targetWin = window.open(
                                                                      'modal_leave?empid=' +
                                                                      modal_emp + '&requestno='+val, title,
                                                                      'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' +
                                                                      w + ', height=' + h +
                                                                      ', top=' + 50 +
                                                                      ', left=' + left);
                                                        }
                                                        </script>
                                                        <td id="tdb_1">
                                                        <body>
                                                               <!-- <a id="printinp_leavereq" class="btn btn-default" name="printinp_leavereq"
                                                                      onclick="OpenPopupCenterLeave(this.value, 'TEST!?', 450, 900);"
                                                                      target="_blank">Show</a> -->

              
                                                                      <a href='#' onclick='return startload()' class='btn btn-default open_modal_search'>
                                                                             Show
                                                                      </a>

                                                        </body>
                                                        </td>
                                                        <script>
                                                        $(function() {
                                                               var $src = $('#inp_leavereq'),
                                                                      $dst = $('#printinp_leavereq'
                                                                      );
                                                               $src.on('input',
                                                                      function() {
                                                                             $dst.val($src
                                                                                    .val());
                                                                      });
                                                        });
                                                        </script>


                                                 </tr>

                                                 

                               

                                          </tbody>
                                   </table>
                            </fieldset>


                            <tr>
                                   <td colspan="3" align="right" width="100%">
                                          <div class="modal-footer">
                                                 <div class="form-group">
                                                        <button onclick="window.location.href='../hrm{sys=leave.cancellation}?emp_id=<?php echo $username; ?>'" type="button" class="btn btn-default"
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
                                                               <a id="four" class="btn btn-primary" name="four"
                                                                      onclick="OpenPopupCenter(this.value, 'TEST!?', 450, 900);"
                                                                      target="_blank">Preview
                                                                      Approver</a>

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
              <script>
                     function validasi() {
                            var modal_emp = document.getElementById("modal_emp").value;
                            var modal_leave = document.getElementById("modal_leave").value;
                            var inp_leavebalance = document.getElementById("inp_leavebalance").value;
                            var modal_leave_starts = document.getElementById("modal_leave_start").value;
                            var modal_leave_ends = document.getElementById("modal_leave_end").value;
                            var inp_remark = document.getElementById("inp_remark").value;


                            var from = new Date(modal_leave_starts).getTime();
                            var to = new Date(modal_leave_ends).getTime();
              
                            
                            if(from > to) {
                                   alert("Entry Date: Enter Date in Proper Range");
                                   return false;
                            } else if(modal_emp == "") {
                                   alert("Employee Number invalid");
                                   return false;
                            } else if(modal_leave == "") {
                                   alert("Please select type of leave");
                                   return false;
                            } else if(inp_leavebalance == "") {
                                   alert("Something went wrong");
                                   return false;
                            } else if(modal_leave_starts == "") {
                                   alert("Start date Cant empty");
                                   return false;
                            } else if(modal_leave_ends == "") {
                                   alert("End date Cant empty");
                                   return false;
                            } else if(inp_remark == "") {
                                   alert("Remark Cant empty");
                                   return false;
                            } if (modal_emp != "" && modal_leave_start!= "") {
                                   return true;
                            }
                     }
              </script>


       </div>

</div>
</div>
</div>





<script type="text/javascript">
function isi_otomatis() {
       var modal_emps = $("#modal_emp").val();
       $.ajax({
              url: 'ajax_cek.php?emp_id=<?php echo $username; ?>',
              data: "modal_emp=" + modal_emps,
       }).success(function(data) {
              var json = data,
                     obj = JSON.parse(json);
              $('#inp_nickname').val(obj.nama);
              $('#nik').val(obj.nik);
       });
}
</script>




<!-- Javascript untuk popup modal Edit-->
<script type="text/javascript">
$(document).ready(function() {

       $(".open_modal_search").click(function(e) {
              var m = $(this).attr("id");
              var modal_emp = document.getElementById("modal_emp").value;
              var inp_leavereq = document.getElementById("inp_leavereq").value;

              $.ajax({
                     url: "modal_leave.php?emp_id=<?php echo $username; ?>",
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

<script>
              $(document).ready(function() {
                     $('#modal_emp').on('blur', function() {

                            var inp_nickname = document.getElementById("inp_nickname").value;
                         
                            if (inp_nickname == '') {
                                   alert("Invalid lookup");
                                   return false;
                            } else {
                                   $("#tr_inp_leaveisurgent").hide();
                            }
                     });
              });
              </script>



<div id="ModalEdits1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="margin-left: -5px;"
                                   aria-hidden="true">
                            </div>