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



<div class="modal-dialog modal-bg">
       <div class="modal-content">
              <div class="modal-header">
                     <h4 class="modal-title"><?php echo $_GET['modal_header']; ?></h4>
                     <div class="toolbar sprite-toolbar-close" aria-label="Close" onclick='return stopload()' data-dismiss="modal" id="SEARCH" title="Search"></div>
                     <input name="loader_stoper" id="loader_stoper" type="hidden" value="stop_loader">
              </div>

       <div class="card-body table-responsive p-0" style="width: 100vw;height: 60vh; width: 98.8%; margin: 5px;overflow: scroll;">
                                        
              <form name='form1' method="post" id="multiple_upload_form" enctype="multipart/form-data"
                     onsubmit='return HrmsValidationForm()'>
                     <fieldset id="fset_1">
                            <legend style="font-weight: 700;font-size: 12px;">Attendance Status</legend>

                            <div class="form-row">
                                   <div class="col-4 name">Machine Code <font color="red">*</font></div>
                                   <div class="col-sm-8">
                                          <div class="input-group">
                                                 <input class="input--style-6"
                                                        type="Text"
                                                        id="inp_machine_code"
                                                        name="inp_machine_code"
                                                        value=""
                                                        autocomplete="off"
                                                        autofocus="on" 
                                                        size="30" 
                                                        maxlength="50" 
                                                        
                                                        placeholder="machine_code"
                                                        title="machine_code">
                                          </div>
                                   </div>
                            </div>

                            <script>
                            $(function () {
                            $('#Upload0').hide();
                            $('#Upload1').hide();
                            $('#Query0').hide();
                            $('#Query1').hide();
          
                                   $('#inp_method').change(function () {
                                          $('#Upload0').hide();
                                          $('#Upload1').hide();
                                  
                                          if (this.options[this.selectedIndex].value == 'Upload') {
                                                 $('#Upload0').show();
                                                 $('#Upload1').show();
                                    
                                                        $('#Query0').hide();
                                                        $('#Query1').hide();
                                                        $('#Query2').hide();
                                          } else if (this.options[this.selectedIndex].value == 'Query') {
                                                 $('#Upload0').hide();
                                                 $('#Upload1').hide();
                                      
                                                        $('#Query0').show();
                                                        $('#Query1').show();
                                                        $('#Query2').show();
                                          } 
                                   });
                            });
                            </script>

                            
                            <div class="form-row">
                                   <div class="col-4 name">Method <font color="red">*</font></div>
                                   <div class="col-sm-8">
                                          <div class="input-group">
                                                 <select class="input--style-6" 
                                                        name="inp_method"
                                                        id="inp_method"
                                                        style="width: 50%;height: 30px;" >
                                                        <option value="">--Select One--</option>
                                                        <option value="Upload">Upload</option>
                                                        <option value="Query">Query</option>
                                                 </select>
                                          </div>
                                   </div>
                            </div>

                            <div class="form-row" id="Upload0">
                                   <div class="col-4 name">File Type <font color="red">*</font></div>
                                   <div class="col-sm-8">
                                          <div class="input-group">
                                                 <select class="input--style-6" 
                                                        name="inp_file_type"
                                                        id="inp_file_type"
                                                        style="width: 50%;height: 30px;" >
                                                        <option value="">--Select One--</option>
                                                        <option value="Excel">Excel</option>
                                                        <option value="Text">Text File</option>
                                                 </select>
                                          </div>
                                   </div>
                            </div>

                            <div class="form-row" id="Upload1">
                                   <div class="col-4 name">File Extension <font color="red">*</font></div>
                                   <div class="col-sm-5">
                                          <div class="input-group">
                                                 <select class="input--style-6" 
                                                        name="inp_fileext"
                                                        id="inp_fileext"
                                                        style="width: 50%;height: 30px;" >
                                                        <option value="">--Select One--</option>
                                                        <option value="xls">xls</option>
                                                        <option value="Text">Text File</option>
                                                 </select>
                                          </div>
                                   </div>
                            </div>

                            <script>
                            $(function () {
                                   $("#inp_inoutflag").click(function () {
                                   if ($(this).is(":checked")) {
                                          $("#dvPassport").show();
                                   } else {
                                          $("#dvPassport").hide();
                                   }
                                   });
                            });
                            </script>

                            <div class="form-row" id="Upload2">
                                   <div class="col-4 name">Use In/Out Flag </div>
                                   <div class="col-sm-6">
                                          <div class="input-group">
                                                        <div class="form-check form-check-inline" style="margin-top: 15px;">
                                                               <input class="form-check-input" type="checkbox" id="inp_inoutflag" name="inp_inoutflag" value="Y">
                                                               <label class="form-check-label" for="inp_inoutflag">Yes</label>
                                                        </div>
                                          </div>
                                   </div>
                            </div>

                            <div class="form-row" id="dvPassport" style="display:none">
                                   <div class="col-4 name">In Code <font color="red">*</font></div>
                                   <div class="col-sm-2">
                                          <div class="input-group">
                                                 <input class="input--style-6"
                                                        type="Text"
                                                        id="inp_in_status"
                                                        name="inp_in_status"
                                                        value=""
                                                        autocomplete="off"
                                                        autofocus="on"
                                                        size="30" 
                                                        maxlength="5" 
                                                        
                                                        placeholder="in status"
                                                        title="in status">
                                          </div>
                                   </div>
                                   <div class="col-2 name">Out Code <font color="red">*</font></div>
                                   <div class="col-sm-2">
                                          <div class="input-group">
                                                 <input class="input--style-6"
                                                        type="Text"
                                                        id="inp_out_status"
                                                        name="inp_out_status"
                                                        value=""
                                                        autocomplete="off"
                                                        autofocus="on"
                                                        size="30" 
                                                        maxlength="5" 
                                                        
                                                        placeholder="out status"
                                                        title="out status">
                                          </div>
                                   </div>
                            </div>

                            <div class="form-row" id="Query0">
                                   <div class="col-4 name">Datasource <font color="red">*</font></div>
                                   <div class="col-sm-5">
                                          <div class="input-group">
                                                 <select class="input--style-6" 
                                                        name="inp_datasource"
                                                        id="inp_datasource"
                                                        style="width: 50%;height: 30px;" >
                                                        <option value="">--Select One--</option>
                                                        <option value="gthrisco_tm">gthrisco_tm</option>
                                                        <option value="gthrisco_tmdev">gthrisco_tmdev</option>
                                                 </select>
                                          </div>
                                   </div>
                            </div>

                            <div class="form-row" id="Query1">
                                   <div class="col-4 name">Table Name <font color="red">*</font></div>
                                   <div class="col-sm-8">
                                          <div class="input-group">
                                                 <input class="input--style-6"
                                                        type="Text"
                                                        id="inp_table_name"
                                                        name="inp_table_name"
                                                        value=""
                                                        autocomplete="off"
                                                        autofocus="on" 
                                                        size="30" 
                                                        maxlength="50" 
                                                        
                                                        placeholder="table_name"
                                                        title="table_name">
                                          </div>
                                   </div>
                            </div>

                            <div class="form-row">
                                   <div class="col-4 name">Attendance ID based on </div>
                                   <div class="col-sm-8">
                                          <div class="input-group">
                                                 <select class="input--style-6" 
                                                        name="inp_attend_code"
                                                        id="inp_attend_code"
                                                        style="width: 50%;height: 30px;" >
                                                               <option value="">--Select One--</option>
                                                               <option value="TEODEMPCOMPANY.emp_id">Employee ID</option>
                                                               <option value="TEODEMPCOMPANY.emp_no" selected="">Employee No</option>
                                                               <option value="TEODEMPCUSTOMFIELD.CustomField1">Custom Field1</option>
                                                               <option value="TEODEMPCUSTOMFIELD.CustomField2">CustomField2</option>
                                                               <option value="TEODEMPCUSTOMFIELD.CustomField3">CustomField3</option>
                                                               <option value="TEODEMPCUSTOMFIELD.CustomField4">CustomField4</option>
                                                               <option value="TEODEMPCUSTOMFIELD.CustomField5">Custom Field5</option>
                                                               <option value="TEODEMPCUSTOMFIELD.CustomField6">Custom Field6</option>
                                                               <option value="TEODEMPCUSTOMFIELD.CustomField7">CustomField7</option>
                                                               <option value="TEODEMPCUSTOMFIELD.CustomField8">CustomField8</option>
                                                               <option value="TEODEMPCUSTOMFIELD.CustomField9">CustomField9</option>
                                                               <option value="TEODEMPCUSTOMFIELD.CustomField10">CustomField10</option>
                                                 </select>
                                          </div>
                                   </div>
                            </div>

                            <div class="form-row">
                                   <div class="col-4 name">Date Format </div>
                                   <div class="col-sm-6">
                                          <div class="input-group">
                                                 <select class="input--style-6" 
                                                        name="inp_datemask"
                                                        id="inp_datemask"
                                                        style="width: 50%;height: 30px;" >
                                                        <option value="mm/dd/yyyy">mm/dd/yyyy</option>
                                                        <option value="dd/mm/yyyy">dd/mm/yyyy</option>
                                                 </select>
                                          </div>
                                   </div>
                            </div>

                            <div class="card-body table-responsive p-0"
                                                 style="width: 100vw; width: 100.0%; margin: 5px;overflow: scroll;">
                                                        <table class="table table-hover small-text" id="tba">
                                                        <tr class="tr-header">
                                                               <th style="background: #e1dfdf;color: #464141;border: 1px solid white;"><label>Field Type <span>*</span></label></th>
                                                               <th style="background: #e1dfdf;color: #464141;border: 1px solid white;"><label>Name <span>*</span></label></th>
                                                               <th style="background: #e1dfdf;color: #464141;border: 1px solid white;"><label>Description <span>*</span></label></th>
                                                               <th style="background: #e1dfdf;color: #464141;border: 1px solid white;"><label>Length <span>*</span></label></th>
                                                               <th style="background: #e1dfdf;color: #464141;border: 1px solid white;"><a href="javascript:void(0);" style="font-size:18px;" id="addMorea" title="Add More Person"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-square feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg></a></th>
                                                        </tr>
                                                        <tr>
                                                               <td>
                                                               <select class="form-control" name="data_mac1[]">
                                                                      <option value="">None</option>
                                                                      <option value="MachineNo">MachineNo [xxx..]</option>`
                                                                      <option value="AttendanceId">AttendanceId [xxx..]</option>
                                                                      <option value="Hour">Hour [hh]</option>
                                                                      <option value="Minute">Minute [mm]</option>
                                                                      <option value="Second">Second [ss]</option>
                                                                      <option value="Day">Day [dd]</option>
                                                                      <option value="Month">Month [mm]</option>
                                                                      <option value="Year">Year [yyyy]</option>
                                                                      <option value="Status">Status [xxx..]</option>
                                                                      <option value="SpecialCharacter">SpecialCharacter [xxx..]</option>
                                                                      <option value="Date_Format">Full_Date [mm/dd/yyyy]</option>
                                                                      <option value="Time_Format">Time_Format [hh:mm]</option>
                                                               </select></td>
                                                               <td><input type="text" name="data_mac2[]" class="form-control"></td>
                                                               <td><input type="text" name="data_mac3[]" class="form-control"></td>
                                                               <td><input type="text" name="data_mac4[]" class="form-control"></td>
                                                               <td><a href='javascript:void(0);' class='removea'><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-square feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="8" y1="12" x2="16" y2="12"></line></svg></a>
                                                               </td>
                                                        </tr>
                                                 </table>
                                                 </div>

                                          
                                                 <script>
                                                 $(function() {
                                                        $('#addMorea').on('click', function() {
                                                               var data = $("#tba tr:eq(1)")
                                                                      .clone(true).appendTo(
                                                                             "#tba");
                                                               data.find("input").val('');
                                                        });
                                                        $(document).on('click', '.removea', function() {
                                                               var trIndex = $(this)
                                                                      .closest("tr")
                                                                      .index();
                                                               if (trIndex > 1) {
                                                                      $(this).closest("tr")
                                                                             .remove();
                                                               } else {
                                                                      alert(
                                                                             "Sorry required field cannot delete"
                                                                             );
                                                               }
                                                        });
                                                 });
                                                 </script>

                     </fieldset>


       <!-- end of div overflow -->
       </div>
       <!-- end of div overflow -->








                            <table style="width: 95%;">
                                   <input type="hidden" id="inp_leavemethod" name="inp_leavemethod" value="">
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
                                                        name="submit_create_setting_attendancemachine" 
                                                        id="submit_create_setting_attendancemachine">
                                                        Submit
                                                 </button>

                                                 <button class="btn btn-warning" 
                                                        type="button" 
                                                        name="submit_create_setting_attendancemachine2"
                                                        id="submit_create_setting_attendancemachine2" 
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
                                          $('#inp_leavemethod').val(obj.ltp);
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
                     var inp_machine_code = document.getElementById("inp_machine_code").value;
                     var inp_method = document.getElementById("inp_method").value;
                     var inp_attend_code = document.getElementById("inp_attend_code").value;
                     var inp_datemask = document.getElementById("inp_datemask").value;
                     var inp_inoutflag = document.getElementById("inp_inoutflag").value;
                     var inp_in_status = document.getElementById("inp_in_status").value;
                     var inp_out_status = document.getElementById("inp_out_status").value;
                     var inp_file_type = document.getElementById("inp_file_type").value;
                     var inp_fileext = document.getElementById("inp_fileext").value;
                     var inp_datasource = document.getElementById("inp_datasource").value;
                     var inp_table_name = document.getElementById("inp_table_name").value;

                     if (inp_machine_code == "") {
                            modals.style.display = 'block';
                            document.getElementById('msg').innerHTML = 'Machine Code cannot empty';
                            return false;

                     } else if (inp_method == "") {
                            modals.style.display = 'block';
                            document.getElementById('msg').innerHTML = 'Please select File method';
                            return false;

                     } else if (inp_method == "Upload") {
                          
                            if (inp_file_type == "") {
                                   modals.style.display = 'block';
                                   document.getElementById('msg').innerHTML = 'Please select file type';
                                   return false;
                            } else if (inp_fileext == "") {
                                   modals.style.display = 'block';
                                   document.getElementById('msg').innerHTML = 'Please select File Extension';
                                   return false;

                            } else {

                                   if (inp_attend_code == "") {
                                          modals.style.display = 'block';
                                          document.getElementById('msg').innerHTML = 'Please select Attendance ID based on ';
                                          return false;
                                   
                                   } else if (inp_datemask == "") {
                                          modals.style.display = 'block';
                                          document.getElementById('msg').innerHTML = 'Please select datemask ';
                                          return false;

                                   } else if($("#inp_inoutflag").is(':checked')){
                                          if (inp_in_status == "") {
                                                 modals.style.display = 'block';
                                                 document.getElementById('msg').innerHTML = 'In Status cannot empty';
                                                 return false;
                                          } else if (inp_out_status == "") {
                                                 modals.style.display = 'block';
                                                 document.getElementById('msg').innerHTML = 'Out Status cannot empty';
                                                 return false;
                                          } else {
                                                 $('#submit_create_setting_attendancemachine').hide();
                                                 $('#submit_create_setting_attendancemachine2').show();
                                          }

                                   } else {
                                          $('#submit_create_setting_attendancemachine').hide();
                                          $('#submit_create_setting_attendancemachine2').show();
                                   }
                            }
                     
                     } else if (inp_method == "Query") {
                          
                          if (inp_datasource == "") {
                                 modals.style.display = 'block';
                                 document.getElementById('msg').innerHTML = 'Please select datasource';
                                 return false;
                          } else if (inp_table_name == "") {
                                 modals.style.display = 'block';
                                 document.getElementById('msg').innerHTML = 'Please select table name';
                                 return false;
                          } else {

                                   if (inp_attend_code == "") {
                                          modals.style.display = 'block';
                                          document.getElementById('msg').innerHTML = 'Please select Attendance ID based on ';
                                          return false;
                                   
                                   } else if (inp_datemask == "") {
                                          modals.style.display = 'block';
                                          document.getElementById('msg').innerHTML = 'Please select datemask ';
                                          return false;

                                   } else if($("#inp_inoutflag").is(':checked')){
                                          if (inp_in_status == "") {
                                                 modals.style.display = 'block';
                                                 document.getElementById('msg').innerHTML = 'In Status cannot empty';
                                                 return false;
                                          } else if (inp_out_status == "") {
                                                 modals.style.display = 'block';
                                                 document.getElementById('msg').innerHTML = 'Out Status cannot empty';
                                                 return false;
                                          } else {
                                                 $('#submit_create_setting_attendancemachine').hide();
                                                 $('#submit_create_setting_attendancemachine2').show();
                                          }

                                   } else {
                                          $('#submit_create_setting_attendancemachine').hide();
                                          $('#submit_create_setting_attendancemachine2').show();
                                   }
                            }

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