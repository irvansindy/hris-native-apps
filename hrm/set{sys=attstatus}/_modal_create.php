<?php
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0'; 
if($getdata == 0) {
	include "../../application/session/session.php";
} else {
	include "../../application/session/mobile.session.php";	
}
include "../template/sys.alert.php";
?>

<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>



<div class="modal-dialog modal-med">
       <div class="modal-content">
              <div class="modal-header">
                     <h4 class="modal-title"><?php echo $_GET['modal_header']; ?></h4>
                     <div class="toolbar sprite-toolbar-close" aria-label="Close" onclick='return stopload()' data-dismiss="modal" id="SEARCH" title="Search"></div>
                     <input name="loader_stoper" id="loader_stoper" type="hidden" value="stop_loader">
              </div>

       <div class="card-body table-responsive p-0" style="width: 100vw;height: 47vh; width: 98.8%; margin: 5px;overflow: hidden;">
                                        
              <form name='form1' method="post" id="multiple_upload_form" enctype="multipart/form-data"
                     onsubmit='return HrmsValidationForm()'>
                     <fieldset id="fset_1">
                            <legend style="font-weight: 700;font-size: 12px;">Attendance Status</legend>

                            <div class="form-row">
                                   <div class="col-4 name">Status Code <font color="red">*</font></div>
                                   <div class="col-sm-8">
                                          <div class="input-group">
                                                 <input class="input--style-6"
                                                        type="Text"
                                                        id="inp_attend_code"
                                                        name="inp_attend_code"
                                                        value=""
                                                        autocomplete="off"
                                                        autofocus="on" 
                                                        size="30" 
                                                        maxlength="50" 
                                                        
                                                        placeholder="attend_code"
                                                        title="attend_code">
                                          </div>
                                   </div>
                            </div>

                            <div class="form-row">
                                   <div class="col-4 name">Status Description <font color="red">*</font></div>
                                   <div class="col-sm-7">
                                          <div class="input-group">
                                                 <textarea class="input--style-6"
                                                        type="Text"
                                                        id="inp_attend_name_en"
                                                        name="inp_attend_name_en"
                                                        value="dev"
                                                        autocomplete="off"
                                                        autofocus="on" 
                                                        size="30" 
                                                        maxlength="50" 
                                                        
                                                        placeholder="attend_name_en"
                                                        title="attend_name_en"></textarea>
                                          </div>
                                   </div>
                                   <div class="col-1 name"><img src="../../asset/img/en.png" style="width: 20px;"></div>
                            </div>

                            <div class="form-row">
                                   <div class="col-4 name"></div>
                                   <div class="col-sm-7">
                                          <div class="input-group">
                                                 <textarea class="input--style-6"
                                                        type="Text"
                                                        id="inp_attend_name_id"
                                                        name="inp_attend_name_id"
                                                        value="dev"
                                                        autocomplete="off"
                                                        autofocus="on" 
                                                        size="30" 
                                                        maxlength="50" 
                                                        
                                                        placeholder="attend_name_id"
                                                        title="attend_name_id"></textarea>
                                          </div>
                                   </div>
                                   <div class="col-1 name"><img src="../../asset/img/id.png" style="width: 20px;"></div>
                            </div>

                            <div class="form-row">
                                   <div class="col-4 name">Present Flag <font color="red">*</font></div>
                                   <div class="col-sm-6">
                                          <div class="input-group">
                                                        <div class="form-check form-check-inline" style="margin-top: 15px;">
                                                               <input class="form-check-input" type="checkbox" id="inp_present_flag" name="inp_present_flag" value="Y">
                                                               <label class="form-check-label" for="inp_present_flag">Yes</label>
                                                        </div>
                                          </div>
                                   </div>
                                  
                            </div>
                     </fieldset>

                     <!-- end of div overflow -->
                     </div>
                     <!-- end of div overflow -->











                            <table style="width: 95%;">
                                   <input type="hidden" id="inp_leavedaytype" name="inp_leavedaytype" value="">
                                   <input type="hidden" id="get_token" name="get_token" value="<?php echo $get_token; ?>">
                                   <input type="hidden" id="inp_leaveisurgent" name="inp_leaveisurgent" value="">
                            </table>


                     <tr>
                            <td colspan="3" align="right" width="100%">
                                   <div class="modal-footer">
                                          <div class="form-group">
                                                 <button onclick='return stopload()' type="button"
                                                        class="btn btn-default" data-dismiss="modal">Cancel</button>

                                          
                                                 <button class="btn btn-warning"
                                                        type="submit" 
                                                        name="submit_add_setting_attendancestatus" 
                                                        id="submit_add_setting_attendancestatus">
                                                        Submit
                                                 </button>

                                                 <button class="btn btn-warning" 
                                                        type="button" 
                                                        name="submit_add_setting_attendancestatus2"
                                                        id="submit_add_setting_attendancestatus2" 
                                                        style='display:none;' 
                                                        disabled>
                                                        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                                        Processing..
                                                 </button>

                                          </div>
                                   </div>
                            </td>
                     </tr>

              </form>

       

              <div id="ModalEdits1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="margin-left: -5px;"
                                   aria-hidden="true">
                            </div>


              <script type="text/javascript">
              $(document).ready(function() {
                     $('#modal_leave_start').bootstrapMaterialDatePicker({
                            time: false,
                            clearButton: true
                     });

                     $('#modal_leave_end').bootstrapMaterialDatePicker({
                            time: false,
                            clearButton: true
                     });

                     $('#inp_starttime').bootstrapMaterialDatePicker({
                            date: false,
                            format: 'HH:mm'
                     });

                     $('#inp_endtime').bootstrapMaterialDatePicker({
                            date: false,
                            format: 'HH:mm'
                     });
                     $('#inp_break_starttime').bootstrapMaterialDatePicker({
                            date: false,
                            format: 'HH:mm'
                     });
                     $('#inp_break_endtime').bootstrapMaterialDatePicker({
                            date: false,
                            format: 'HH:mm'
                     });

                     
              });
              </script>

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

              <script type="text/javascript">
              function isi_otomatis_leave() {
                     var modal_emps = $("#modal_emp").val();
                     var modal_leave = $("#modal_leave").val();
                     var modal_urgent = $("#modal_urgent").val();

                     $.ajax({
                            url: 'ajax_cek3_mysql.php?emp_id=<?php echo $username; ?>',
                            data: {
                                   modal_emp: modal_emps,
                                   modal_leave: modal_leave,
                                   modal_urgent: modal_urgent
                                   
                            },

                     }).success(function(data) {
                            var json = data,
                                   obj = JSON.parse(json);
                                          $('#inp_leavebalance').val(obj.lvb);
                                          $('#inp_leavedaytype').val(obj.ltp);
                                          $('#inp_leaveisurgent').val(obj.lur);
                     });
              }
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
                     $('#modal_emp').on('change', function() {

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
              

              <script>
              $(document).ready(function(){
                     
                            $("#show_preview").click(function(){
                                   
                                   $("#boxifblur").hide();
                                   var modal_emp = document.getElementById("modal_emp").value;
                                   $("#box").load("modal_preview_apv.php?rfid=" + modal_emp, function(responseTxt, statusTxt, jqXHR){
                                   if(statusTxt == "success"){
                                          alert("New content loaded successfully!");
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
                                          $("#boxifblur").load("modal_preview_apv.php?rfid=" + modal_emp, function(responseTxt, statusTxt, jqXHR){
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

              <script>
              function HrmsValidationForm() {
                     var inp_attend_code = document.getElementById("inp_attend_code").value;
                     var inp_attend_name_en = document.getElementById("inp_attend_name_en").value;
                     var inp_attend_name_id = document.getElementById("inp_attend_name_id").value;

       


                     if (inp_attend_code == "") {
                            modals.style.display = 'block';
                            document.getElementById('msg').innerHTML = 'Status Code cannot empty';
                            return false;
                     } else if (!inp_attend_name_en.trim().length) {
                            modals.style.display = 'block';
                            document.getElementById('msg').innerHTML = 'Status Description en cannot empty';
                            return false;
                     } else if (!inp_attend_name_id.trim().length) {
                            modals.style.display = 'block';
                            document.getElementById('msg').innerHTML = 'Status Description id cannot empty';
                            return false;
                     } else {
                            $('#submit_add_setting_attendancestatus').hide();
                            $('#submit_add_setting_attendancestatus2').show();
                     }
              }
              </script>

              <script>
              var uploadField = document.getElementById("inp_refdoc");

              uploadField.onchange = function() {
              if(this.files[0].size > 3145728){
                     alert("File is too large guys ! Max File Upload is 3MB");
                     this.value = "";
              };
              };
              </script>

              <script>
                            var uploadField = document.getElementById("inp_refdoc");
                            // doc,jpg,ods,png,txt,doc,pdf
                            var allowedFiles = [".doc",".jpg",".ods",".png",".txt",".docx",".pdf"];
                            var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");

                            uploadField.onchange = function() {
                            if(this.files[0].size > 3145728){
                                   alert("File is too large guys ! Max File Upload is 3MB");
                                   this.value = "";
                            } else if (!regex.test(uploadField.value.toLowerCase())) {
                                   alert("Only file [doc,jpg,ods,png,txt,doc,pdf] allowed");
                                   this.value = "";
                            };
                            };
              </script> 


              <!-- JAVASCRIPT UNTUK GET LEAVE TYPE VS URGENT REASON -->
              <!-- JAVASCRIPT UNTUK GET LEAVE TYPE VS URGENT REASON -->
              <script type="text/javascript">
              $(document).ready(function() {
                     $(".modal_leave").change(function() {
                            var leave_code = $(this).val();
                            var post_id = 'id=' + leave_code;

                            $.ajax({
                                   type: "POST",
                                   url: "ajax_cek4_leavetype.php?emp_id=<?php echo $username; ?>",
                                   data: post_id,
                                   cache: false,
                                   success: function(urgent_reason_print) {
                                          $(".urgent_reason").html(
                                                 urgent_reason_print
                                                 );
                                   }
                            });
                     });
              });
              </script>
              <!-- JAVASCRIPT UNTUK GET LEAVE TYPE VS URGENT REASON -->
              <!-- JAVASCRIPT UNTUK GET LEAVE TYPE VS URGENT REASON -->

<!-- LOADER STOPER -->
<script>
$(document).ready(function(){
       var loader_stoper = $("#loader_stoper").val();
              if (loader_stoper == "stop_loader") {
                     return stopload();
              } 
       });
</script>
<!-- LOADER STOPER -->