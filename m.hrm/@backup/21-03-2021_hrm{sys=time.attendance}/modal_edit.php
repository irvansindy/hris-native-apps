<?php
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0'; 
if($getdata == 0) {
	include "../../application/session/session.php";
} else {
	include "../../application/session/mobile.session.php";	
}
?>


<?php
	$id = $_POST['id'];
	$modal=mysqli_query($connect, 
	"SELECT 
	a.*
	FROM hrmleaverequest a

	WHERE a.request_no='$id'
	GROUP BY a.request_no
	");

	while($r=mysqli_fetch_array($modal)){
?>



<div class="modal-dialog modal-med">
       <div class="modal-content">

              <div class="modal-header">
                     <h4 class="modal-title">Edit Leave Request <?php 
                     $id = $_POST['id'];
                     echo $id;
                     ?></h4>

                     <button type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" 
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
                                                        
                                                               <input type="hidden" name="req_num" value="<?php echo $id; ?>" >
                                                               <input class="form-control" style="margin-bottom: 2px;"
                                                                      onkeyup="isi_otomatis(), isi_otomatis_leave()"
                                                                      autocomplete="off"
                                                                      autofocus="on" id="modal_emp" name="modal_emp"
                                                                      type="Text" value="<?php echo $username; ?>" onfocus="hlentry(this)"
                                                                      size="30" maxlength="50"
                                                                      validate="NotNull:Invalid Form Entry"
                                                                      onchange="formodified(this);" title="" readonly>
                                                        </td>
                                                 </tr>
                                                 <tr id="tr_inp_nickname" class="clTR1">
                                                        <td><label id="lbl_inp_nickname" for="inp_nickname"
                                                                      title="">Employee Name <span
                                                                             class="required">*</span></label>
                                                        </td>
                                                        <td colspan="3" class="" id="tdb_1"><input class="form-control"
                                                                      style="margin-bottom: 2px;background-color: #fff3b4;"
                                                                      id="inp_nickname" name="inp_nickname" type="Text"
                                                                      value="<?php echo $nama; ?>" onfocus="hlentry(this)" size="20"
                                                                      maxlength="50" 
                                                                      validate="NotNull:Invalid Form Entry"
                                                                      onchange="formodified(this);" title="" readonly>
                                                        </td>
                                                 </tr>
                                                 <tr id="tr_inp_user_status" class="clTR1">
                                                        <td><label id="lbl_inp_user_status" for="inp_user_status"
                                                                      title="">Type of Leave <span
                                                                             class="required">*</span></label></td>
                                                        <td colspan="3" class="" id="tdb_1"><select class="form-control"
                                                                      style="margin-bottom: 2px; width: 50%;"
                                                                      id="modal_leave" name="modal_leave"
                                                                      onchange="isi_otomatis_leave()"
                                                                      style="width:undefined">


                                                                      <option value="">--Select One--</option>
                                                                      <?php
                                                                      $sql = mysqli_query($connect,"select * from ttamleavetype");
                                                                      while($row=mysqli_fetch_array($sql))
                                                                      {
                                                                      echo '<option style="font-size: 12px;" value="'.$row['leave_code'].'">'.$row['leavename_en'].'</option>';
                                                                      } ?>
                                                               </select>

                                                        </td>
                                                 </tr>





                                                 <tr id="tr_inp_nickname" class="clTR1">
                                                        <td><label id="lbl_inp_nickname" for="inp_nickname"
                                                                      title="">Leave Balance <span
                                                                             class="required">*</span></label>
                                                        </td>
                                                        <td colspan="3" class="" id="tdb_1"><input class="form-control"
                                                                      style="margin-bottom: 2px;background-color: #fff3b4;"
                                                                      id="inp_leavebalance" name="inp_leavebalance"
                                                                      type="Text" value="" onfocus="hlentry(this)"
                                                                      size="20" maxlength="50" 
                                                                      validate="NotNull:Invalid Form Entry"
                                                                      onchange="formodified(this);" title="" readonly>
                                                        </td>
                                                 </tr>

                                                 <tr id="tr_inp_nickname" class="clTR1">
                                                        <td><label id="lbl_inp_nickname" for="inp_nickname"
                                                                      title="">Date <span
                                                                             class="required">*</span></label>
                                                        </td>
                                                        <td id="tdb_1"><input class="form-control"
                                                                      style="margin-bottom: 2px; width: 100%;"
                                                                      id="modal_leave_start" name="modal_leave_start"
                                                                      type="date" value="" onfocus="hlentry(this)"
                                                                      size="20" maxlength="50" 
                                                                      validate="NotNull:Invalid Form Entry"
                                                                      onchange="formodified(this);" title=""></td>

                                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;To&nbsp;&nbsp;&nbsp;&nbsp;</td>

                                                        <td id="tdb_1"><input class="form-control"
                                                                      style="margin-bottom: 2px; width: 100%;"
                                                                      id="modal_leave_end" name="modal_leave_end"
                                                                      type="date" value="" onfocus="hlentry(this)"
                                                                      size="20" maxlength="50" 
                                                                      validate="NotNull:Invalid Form Entry"
                                                                      onchange="formodified(this);" title=""></td>


                                                 </tr>

                                                 <tr id="tr_inp_nickname" class="clTR1">
                                                        <td><label id="lbl_inp_nickname" for="inp_nickname"
                                                                      title="">Remark <span
                                                                             class="required">*</span></label>
                                                        </td>
                                                        <td colspan="3" class="" id="tdb_1"><textarea
                                                                      class="form-control"
                                                                      style="margin-bottom: 2px; width: 100%;"
                                                                      id="inp_remark" name="inp_remark" type="Text"
                                                                      value="" onfocus="hlentry(this)" size="20"
                                                                      maxlength="50" 
                                                                      validate="NotNull:Invalid Form Entry"
                                                                      onchange="formodified(this);" title=""></textarea>
                                                        </td>
                                                 </tr>


                                                 <tr id="tr_inp_refdoc" class="selected">
                                                        <td><label id="lbl_inp_refdoc" for="inp_refdoc" title="">File
                                                                      Attachment</label>
                                                        </td>
                                                        <td colspan="3" class="" id="tdb_1"><span
                                                                      style="display:inline-block; margin:3px 0px">Max
                                                                      File : <span id="maxFile_refdoc" title=""
                                                                             style="cursor: default;">10000 KByte
                                                                      </span></span><br><input class="form-control"
                                                                      id="inp_refdoc" name="inp_refdoc" type="File"
                                                                      value="" onfocus="hlentry(this)" size="30"
                                                                      maxlength="50" style="float: left; margin: -3px;"
                                                                      onchange="formodified(this);" title=""></td>
                                                 </tr>


                                                 <tr id="tr_inp_file_ext" class="clTR1">
                                                        <td><label id="lbl_inp_file_ext" for="inp_file_ext"
                                                                      title="">File Extension</label>
                                                        </td>
                                                        <td colspan="3" class="label" id="tdb_1">doc,jpg,ods,png,txt,doc
                                                        </td>
                                                               </tr>


                                                 </tr>

                                                 <tr id="tr_inp_file_ext" class="clTR1">
                                                        <td><label id="lbl_inp_file_ext" for="inp_file_ext"
                                                                      title="">Revise Reason</label>
                                                        </td>
                                                        <td colspan="3"  id="tdb_1">
                                                        <?php
                                                        $modalremark= mysqli_fetch_array(mysqli_query($connect, 
                                                        "SELECT revised_remark FROM hrmrequestapproval WHERE request_no='$id' GROUP BY request_no
                                                        "));
                                                        ?>
                                                        
                                                        <b><?php echo $modalremark['revised_remark'];?>
                                                        
                                                        
                                                        </td>
                                                               </tr>


                                                 </tr>

                               

                                          </tbody>
                                   </table>
                            </fieldset>


                            <tr>
                                   <td colspan="3" align="right" width="100%">
                                          <div class="modal-footer">
                                                 <div class="form-group">
                                                        <button onclick='return stopload()' type="button" class="btn btn-default"
                                                               data-dismiss="modal">Cancel</button>

                                                        <script language="javascript" type="text/javascript">
                                                        function OpenPopupCenter(val, pageURL,
                                                               title, w, h) {
                                                               var left = (screen.width - w) / 2;
                                                               var top = (screen.height - h) /
                                                                      50; // for 25% - devide by 4  |  for 33% - devide by 3
                                                               var targetWin = window.open(
                                                                      'window_approver.php?rfid=' +
                                                                      val, title,
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
                                                               var $src = $(
                                                                             '#modal_emp'),
                                                                      $dst = $(
                                                                             '#four'
                                                                      );
                                                               $src.on('input',
                                                                      function() {
                                                                             $dst.val($src
                                                                                    .val());
                                                                      });
                                                        });
                                                        </script>


                                                        <button type="submit" name="submit_edit"
                                                             
                                                               class="btn btn-warning">Submit</button>
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









<?php } ?>












       </div>

</div>
</div>
</div>





<script type="text/javascript">
function isi_otomatis() {
       var modal_emps = $("#modal_emp").val();
       $.ajax({
              url: 'ajax_cek.php',
              data: "modal_emp=" + modal_emps,
       }).success(function(data) {
              var json = data,
                     obj = JSON.parse(json);
              $('#inp_nickname').val(obj.nama);
              $('#nik').val(obj.nik);
       });
}
</script>

<script type="text/javascript">
function isi_otomatis_leave() {
       var modal_emps = $("#modal_emp").val();
       var modal_leave = $("#modal_leave").val();

       $.ajax({
              url: 'ajax_cek3_mysql.php',
              data: {
                     modal_emp: modal_emps,
                     modal_leave: modal_leave
              },

       }).success(function(data) {
              var json = data,
                     obj = JSON.parse(json);
              $('#inp_leavebalance').val(obj.lvb);

       });
}
</script>




<script type="text/javascript">
function log(message) {

}

window.onload = function() {
       document.querySelector('#datepicker1').addEventListener('datechanged', function(e) {
              console.log('New date', e.data, this.value)
       })

       duDatepicker('#datepicker1', {
              format: 'd mmmm yyyy',
              range: false,
              clearBtn: true,
              // disabledDays: ['Sat', 'Sun'],
              events: {
                     dateChanged: function(data) {
                            log('From: ' + data.dateFrom + '\nTo: ' + data.dateTo)
                     },
                     onRangeFormat: function(from, to) {
                            var fromFormat = 'd mmmm d, yyyy',
                                   toFormat = 'mmmm d, yyyy';

                            if (from.getMonth() === to.getMonth() && from.getFullYear() ===
                                   to.getFullYear()) {
                                   fromFormat = 'd mmmm'
                                   toFormat = 'd, yyyy'
                            } else if (from.getFullYear() === to.getFullYear()) {
                                   fromFormat = 'd mmmm'
                                   toFormat = 'd mmmm, yyyy'
                            }

                            return from.getTime() === to.getTime() ?
                                   this.formatDate(from, 'd mmmm, yyyy') : [this.formatDate(
                                          from, fromFormat), this.formatDate(to,
                                          toFormat)].join('-');
                     }
              }
       })


}
</script>