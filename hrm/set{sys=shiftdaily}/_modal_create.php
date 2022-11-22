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
                     <div class="toolbar sprite-toolbar-close" aria-label="Close" onclick='return stopload()' data-dismiss="modal" id="SEARCH"
                                                                      title="Search"></div>
              </div>

       <div class="card-body table-responsive p-0" style="width: 100vw;height: 60vh; width: 98.8%; margin: 5px;overflow: scroll;">
                                        
              <form name='form1' method="post" id="multiple_upload_form" enctype="multipart/form-data"
                     onsubmit='return HrmsValidationForm()'>
                     <fieldset id="fset_1">
                            <legend style="font-weight: 700;font-size: 12px;">Setting Shift Form</legend>

                            <div class="form-row">
                                   <div class="col-4 name">Shift Daily Code <font color="red">*</font></div>
                                   <div class="col-sm-8">
                                          <div class="input-group">
                                                 <input class="input--style-6"
                                                        type="Text"
                                                        id="inp_shiftdailycode"
                                                        name="inp_shiftdailycode"
                                                        value=""
                                                        autocomplete="off"
                                                        autofocus="on" 
                                                        size="30" 
                                                        maxlength="50" 
                                                        
                                                        placeholder="shiftdailycode"
                                                        title="shiftdailycode">
                                          </div>
                                   </div>
                            </div>

                            <script>
                            $(function () {
                            $('#WD0').show();
                            $('#WD1').show();
                            $('#WD2').show();
          
                                   $('#inp_daytype').change(function () {
                                          $('#WD0').show();
                                          $('#WD1').show();
                                          $('#WD2').show();
                                  
                                          if (this.options[this.selectedIndex].value == 'WD') {
                                                 $('#WD0').show();
                                                 $('#WD1').show();
                                                 $('#WD2').show();
                                                 document.getElementById("inp_flexibleshift").checked = false;
                                                 document.getElementById("inp_flexibleshift").disabled = false;
       
                                          } else if (this.options[this.selectedIndex].value == 'OFF') {
                                                 $('#WD0').hide();
                                                 $('#WD1').hide();
                                                 $('#WD2').hide();
                                                 document.getElementById("inp_flexibleshift").checked = true;
                                                 document.getElementById("inp_flexibleshift").disabled = true;
                                          } 
                                   });
                            });
                            </script>

                            <div class="form-row">
                                   <div class="col-4 name">Day Type </div>
                                   <div class="col-sm-8">
                                          <div class="input-group">
                                                 <select class="input--style-6" 
                                                        name="inp_daytype"
                                                        id="inp_daytype"
                                                        style="width: 50%;height: 30px;" >
                                                        <option value="WD">WD</option>
                                                        <?php
                                                               $sql = mysqli_query($connect,"SELECT daytype FROM hrmttamshiftdaily WHERE daytype='off' GROUP BY daytype");
                                                               while($row=mysqli_fetch_array($sql))
                                                               {
                                                               echo '<option value="'.$row['daytype'].'">'.$row['daytype'].'</option>';
                                                               } 
                                                               ?>
                                                 </select>
                                          </div>
                                   </div>
                            </div>

                            <script>
                            $(function () {
                                   $("#inp_flexibleshift").click(function () {
                                   if ($(this).is(":checked")) {
                                          $('#WD0').hide();
                                          $('#WD1').hide();
                                          $('#WD2').hide();
                                   } else {
                                          $('#WD0').show();
                                          $('#WD1').show();
                                          $('#WD2').show();
                                   }
                                   });
                            });
                            </script>

                            <div class="form-row" id="Upload2">
                                   <div class="col-4 name">Flexible Shift </div>
                                   <div class="col-sm-6">
                                          <div class="input-group">
                                                        <div class="form-check form-check-inline" style="margin-top: 15px;">
                                                               <input class="form-check-input" type="checkbox" id="inp_flexibleshift" name="inp_flexibleshift" value="Y">
                                                               <label class="form-check-label" for="inp_flexibleshift">Yes</label>
                                                        </div>
                                          </div>
                                   </div>
                            </div>

                            <div class="form-row" id="WD0">
                                   <div class="col-4 name">Start Time <font color="red">*</font></div>
                                   <div class="col-sm-6">
                                          <div class="input-group">
                                                 <input class="input--style-6"
                                                        type="Text"
                                                        id="inp_starttime"
                                                        name="inp_starttime"
                                                        value=""
                                                        autocomplete="off"
                                                        autofocus="on" 
                                                        size="30" 
                                                        maxlength="5" 
                                                        
                                                        placeholder="starttime"
                                                        title="starttime">
                                          </div>
                                   </div>
                            </div>

                            <div class="form-row" id="WD1">
                                   <div class="col-4 name">End Time <font color="red">*</font></div>
                                   <div class="col-sm-6">
                                          <div class="input-group">
                                                 <input class="input--style-6"
                                                        type="Text"
                                                        id="inp_endtime"
                                                        name="inp_endtime"
                                                        value=""
                                                        autocomplete="off"
                                                        autofocus="on" 
                                                        size="30" 
                                                        maxlength="5" 
                                                        
                                                        placeholder="endtime"
                                                        title="endtime">
                                          </div>
                                   </div>
                            </div>

                            <div class="form-row" id="WD2">
                                   <div class="col-4 name">Grace for Late <font color="red">*</font></div>
                                   <div class="col-sm-2">
                                          <div class="input-group">
                                                 <input class="input--style-6"
                                                        type="Text"
                                                        id="inp_graceforlate"
                                                        name="inp_graceforlate"
                                                        value=""
                                                        autocomplete="off"
                                                        autofocus="on" 
                                                        size="30" 
                                                        maxlength="5" 
                                                        
                                                        placeholder="graceforlate"
                                                        title="graceforlate">
                                          </div>
                                   </div>
                                   <div class="col-2 name">Minute(s)</div>
                            </div>

                            <div class="form-row">
                                   <div class="col-4 name">Productive Work Time <font color="red">*</font></div>
                                   <div class="col-sm-2">
                                          <div class="input-group">
                                                 <input class="input--style-6"
                                                        type="Text"
                                                        id="inp_productivehours"
                                                        name="inp_productivehours"
                                                        value=""
                                                        autocomplete="off"
                                                        autofocus="on" 
                                                        size="30" 
                                                        maxlength="5" 
                                                        
                                                        placeholder="productivehours"
                                                        title="productivehours">
                                          </div>
                                   </div>
                                   <div class="col-2 name">Minute(s)</div>
                            </div>

                            <div class="form-row">
                                   <div class="col-4 name">Remark <font color="red">*</font></div>
                                   <div class="col-sm-8">
                                          <div class="input-group">
                                                 <textarea class="input--style-6"
                                                        type="Text"
                                                        id="inp_remark"
                                                        name="inp_remark"
                                                        value=""
                                                        autocomplete="off"
                                                        autofocus="on" 
                                                        size="30" 
                                                        
                                                        placeholder="remark"
                                                        title="remark"></textarea>
                                          </div>
                                   </div>
                                   
                            </div>
                     
                     </fieldset>
                     
                     <fieldset id="fset_1">
                            <legend style="font-weight: 700;font-size: 12px;">Shift Break</legend>

                            <div class="form-row">
                                   <div class="col-4 name">Start Time </div>
                                   <div class="col-sm-2">
                                          <div class="input-group">
                                                 <input class="input--style-6"
                                                        type="Text"
                                                        id="inp_break_starttime"
                                                        name="inp_break_starttime"
                                                        value=""
                                                        autocomplete="off"
                                                        autofocus="on" 
                                                        size="30" 
                                                        maxlength="5" 
                                                        
                                                        placeholder="break_starttime"
                                                        title="break_starttime">
                                          </div>
                                   </div>
                                   <div class="col-2 name"></div>
                            </div>

                            <div class="form-row">
                                   <div class="col-4 name">End Time </div>
                                   <div class="col-sm-2">
                                          <div class="input-group">
                                                 <input class="input--style-6"
                                                        type="Text"
                                                        id="inp_break_endtime"
                                                        name="inp_break_endtime"
                                                        value=""
                                                        autocomplete="off"
                                                        autofocus="on" 
                                                        size="30" 
                                                        maxlength="5" 
                                                        
                                                        placeholder="break_endtime"
                                                        title="break_endtime">
                                          </div>
                                   </div>
                                   <div class="col-2 name"></div>
                            </div>
                     
                     </fieldset>

                     <fieldset id="fset_1">
                            <legend style="font-weight: 700;font-size: 12px;">Grace Time Setting</legend>

                            <div class="form-row">
                                   <div class="col-4 name">Early In <font color="red">*</font></div>
                                   <div class="col-sm-2">
                                          <div class="input-group">
                                                 <input class="input--style-6"
                                                        type="Text"
                                                        id="inp_grace_eai"
                                                        name="inp_grace_eai"
                                                        value=""
                                                        autocomplete="off"
                                                        autofocus="on" 
                                                        size="30" 
                                                        maxlength="5" 
                                                        
                                                        placeholder="grace_eai"
                                                        title="grace_eai">
                                          </div>
                                   </div>
                                   <div class="col-2 name">Minute(s)</div>
                            </div>

                            <div class="form-row">
                                   <div class="col-4 name">Late In <font color="red">*</font></div>
                                   <div class="col-sm-2">
                                          <div class="input-group">
                                                 <input class="input--style-6"
                                                        type="Text"
                                                        id="inp_grace_lti"
                                                        name="inp_grace_lti"
                                                        value=""
                                                        autocomplete="off"
                                                        autofocus="on" 
                                                        size="30" 
                                                        maxlength="5" 
                                                        
                                                        placeholder="grace_lti"
                                                        title="grace_lti">
                                          </div>
                                   </div>
                                   <div class="col-2 name">Minute(s)</div>
                            </div>

                            <div class="form-row">
                                   <div class="col-4 name">Early Out <font color="red">*</font></div>
                                   <div class="col-sm-2">
                                          <div class="input-group">
                                                 <input class="input--style-6"
                                                        type="Text"
                                                        id="inp_grace_eao"
                                                        name="inp_grace_eao"
                                                        value=""
                                                        autocomplete="off"
                                                        autofocus="on" 
                                                        size="30" 
                                                        maxlength="5" 
                                                        
                                                        placeholder="grace_eao"
                                                        title="grace_eao">
                                          </div>
                                   </div>
                                   <div class="col-2 name">Minute(s)</div>
                            </div>

                            <div class="form-row">
                                   <div class="col-4 name">Late Out <font color="red">*</font></div>
                                   <div class="col-sm-2">
                                          <div class="input-group">
                                                 <input class="input--style-6"
                                                        type="Text"
                                                        id="inp_grace_lto"
                                                        name="inp_grace_lto"
                                                        value=""
                                                        autocomplete="off"
                                                        autofocus="on" 
                                                        size="30" 
                                                        maxlength="5" 
                                                        
                                                        placeholder="grace_lto"
                                                        title="grace_lto">
                                          </div>
                                   </div>
                                   <div class="col-2 name">Minute(s)</div>
                            </div>
                     
                     </fieldset>

                     <fieldset id="fset_1">
                            <legend style="font-weight: 700;font-size: 12px;">Overtime Setting </legend>

                            <div class="form-row">
                                   <div class="col-6 name">Overtime Code <font color="red">*</font></div>
                                   <div class="col-sm-6">
                                          <div class="input-group">
                                                 <select class="input--style-6 " name="inp_overtimecode"
                                                        style="width: 50%;height: 30px;" id="inp_overtimecode">
                                                        <option value="">--Select One--</option>
                                                        <?php
                                                               $sql = mysqli_query($connect,"SELECT * FROM HRMTTAMOVERTIME");
                                                               while($row=mysqli_fetch_array($sql))
                                                               {
                                                               echo '<option value="'.$row['overtime_code'].'">'.$row['overtime_code'].'</option>';
                                                               } 
                                                               ?>
                                                 </select>
                                          </div>
                                   </div>
                            </div>

                            <div class="form-row">
                                   <div class="col-6 name">Public Holiday Overtime Code <font color="red">*</font></div>
                                   <div class="col-sm-6">
                                          <div class="input-group">
                                                 <select class="input--style-6 " name="inp_overtimecode_ph"
                                                        style="width: 50%;height: 30px;" id="inp_overtimecode_ph">
                                                        <option value="">--Select One--</option>
                                                        <?php
                                                               $sql = mysqli_query($connect,"SELECT * FROM HRMTTAMOVERTIME");
                                                               while($row=mysqli_fetch_array($sql))
                                                               {
                                                               echo '<option value="'.$row['overtime_code'].'">'.$row['overtime_code'].'</option>';
                                                               } 
                                                               ?>
                                                 </select>
                                          </div>
                                   </div>
                            </div>
                            
                            <script>
                            $(document).ready(function(){
                                   $("#customControlValidation3").click(function(){
                                          $("#SH").hide();
                                          $("#RM").show();
                                   });
                                   $("#customControlValidation2").click(function(){
                                          $("#RM").hide();
                                          $("#SH").show();
                                   });
                            });
                            </script>

                            <div class="form-row">
                                   <div class="col-6 name">Automatic Overtime </div>
                                   <div class="col-sm-6">
                                          <div class="input-group" style="margin-left: -15px;">
                                          
                                                        <div class="form-check form-check-inline">
                                                               <div class="custom-control custom-radio">
                                                                      <input type="radio" name="inp_automaticovt_type" value="SH" checked="checked" class="custom-control-input" id="customControlValidation2" name="radio-stacked">
                                                                      <label class="custom-control-label" for="customControlValidation2">Static Hour</label>
                                                               </div>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                               <div class="custom-control custom-radio">
                                                                      <input type="radio" name="inp_automaticovt_type" value="RM" class="custom-control-input" id="customControlValidation3" name="radio-stacked">
                                                                      <label class="custom-control-label" for="customControlValidation3">Relative Minutes</label>
                                                               </div>
                                                        </div>
                                      
                                          </div><br>

                                          <div class="input-group" id="SH">
                                                 <input class="input--style-6"
                                                        type="Text"
                                                        id="inp_automaticovt_start"
                                                        name="inp_automaticovt_start"
                                                        value=""
                                                        autocomplete="off"
                                                        autofocus="on" 
                                                        size="10" 
                                                        maxlength="5" 
                                                        style="width: 130px;"
                                                        placeholder="automaticovt_start"
                                                        title="automaticovt_start">
                                                 &nbsp;&nbsp;to&nbsp;&nbsp;
                                                 <input class="input--style-6"
                                                        type="Text"
                                                        id="inp_automaticovt_end"
                                                        name="inp_automaticovt_end"
                                                        value=""
                                                        autocomplete="off"
                                                        autofocus="on" 
                                                        size="10" 
                                                        maxlength="5" 
                                                        style="width: 130px;"
                                                        placeholder="automaticovt_end"
                                                        title="automaticovt_end">
                                          </div>
                            

                                          <div class="input-group" id="RM" style="display:none">
                                                 <input class="input--style-6"
                                                        type="Text"
                                                        id="inp_autoovtminutes"
                                                        name="inp_autoovtminutes"
                                                        value=""
                                                        autocomplete="off"
                                                        autofocus="on" 
                                                        size="10" 
                                                        maxlength="5" 
                                                        style="width: 130px;"
                                                        placeholder="autoovtminutes"
                                                        title="autoovtminutes">
                                          </div>


                                   </div>
                            </div>

                            <div class="form-row">
                                   <div class="col-6 name">Maximum Overtime End before Work Shift Begins </div>
                                   <div class="col-sm-2">
                                          <div class="input-group">
                                                 <input class="input--style-6"
                                                        type="Text"
                                                        id="inp_ovt_beforeend"
                                                        name="inp_ovt_beforeend"
                                                        value=""
                                                        autocomplete="off"
                                                        autofocus="on" 
                                                        size="30" 
                                                        maxlength="5" 
                                                        
                                                        placeholder="ovt_beforeend"
                                                        title="ovt_beforeend">
                                          </div>
                                   </div>
                            </div>

                            <script>
                            $(function () {
                                   $("#inp_breakovt_calculation").click(function () {
                                   if ($(this).is(":checked")) {
                                          $("#dvPassport").show();
                                   } else {
                                          $("#dvPassport").hide();
                                   }
                                   });
                            });
                            </script>

                            <div class="form-row">
                                   <div class="col-6 name">Calculate Break </div>
                                   <div class="col-sm-6">
                                          <div class="input-group">
                                                        <div class="form-check form-check-inline" style="margin-top: 15px;">
                                                               <input class="form-check-input" type="checkbox" id="inp_breakovt_calculation" name="inp_breakovt_calculation" value="Y">
                                                               <label class="form-check-label" for="inp_breakovt_calculation">Yes</label>
                                                        </div>
                                          </div>
                                   </div>
                            </div>

                            <div class="form-row" id="dvPassport" style="display:none">
                                   <div class="col-6 name">Overtime Start in Break Time 1 </div>
                                   <div class="col-sm-2">
                                          <div class="input-group">
                                                 <input class="input--style-6"
                                                        type="Text"
                                                        id="inp_ovt_breakstart"
                                                        name="inp_ovt_breakstart"
                                                        value=""
                                                        autocomplete="off"
                                                        autofocus="on"
                                                        size="30" 
                                                        maxlength="5" 
                                                        
                                                        placeholder="ovt_breakstart"
                                                        title="ovt_breakstart">
                                          </div>
                                   </div>
                            </div>

                       
                          

                            <div class="form-row">
                                   <div class="col-6 name">Overtime Start After Work Shift Ends </div>
                                   <div class="col-sm-2">
                                          <div class="input-group">
                                                 <input class="input--style-6"
                                                        type="Text"
                                                        id="inp_ovt_afterstart"
                                                        name="inp_ovt_afterstart"
                                                        value=""
                                                        autocomplete="off"
                                                        autofocus="on"
                                                        size="30" 
                                                        maxlength="5" 
                                                        
                                                        placeholder="ovt_afterstart"
                                                        title="ovt_afterstart">
                                          </div>
                                   </div>
                            </div>




                     </fieldset>
                     
                     <fieldset id="fset_1">
                            <legend style="font-weight: 700;font-size: 12px;">Shift Overtime Break </legend>

                            <div class="form-row">
                                   <div class="col-4 name">Start Time </div>
                                   <div class="col-sm-2">
                                          <div class="input-group">
                                                 <input class="input--style-6"
                                                        type="Text"
                                                        id="btsovt_1"
                                                        name="btsovt_1"
                                                        value=""
                                                        autocomplete="off"
                                                        autofocus="on" 
                                                        size="30" 
                                                        maxlength="5" 
                                                        style="background: #ffe3c5;"
                                                        placeholder=""
                                                        title="">
                                          </div>
                                   </div>
                                   <div class="col-2 name">Minute(s)</div>
                            </div>

                            <div class="form-row">
                                   <div class="col-4 name">End Time </div>
                                   <div class="col-sm-2">
                                          <div class="input-group">
                                                 <input class="input--style-6"
                                                        type="Text"
                                                        id="bteovt_1"
                                                        name="bteovt_1"
                                                        value=""
                                                        autocomplete="off"
                                                        autofocus="on" 
                                                        size="30" 
                                                        maxlength="5" 
                                                        style="background: #ffe3c5;"
                                                        placeholder=""
                                                        title="">
                                          </div>
                                   </div>
                                   <div class="col-2 name">Minute(s)</div>
                            </div>
                     
                     </fieldset>











                            <table style="width: 95%;">
                                   <input type="hidden" id="inp_leavedaytype" name="inp_leavedaytype" value="">
                                   <input type="hidden" id="get_token" name="get_token" value="<?php echo $get_token; ?>">
                                   <input type="hidden" id="inp_leaveisurgent" name="inp_leaveisurgent" value="">
                            </table>

                            <div id="box"></div>
                            <div id="boxifblur"></div>
                    


                     <tr>
                            <td colspan="3" align="right" width="100%">
                                   <div class="modal-footer">
                                          <div class="form-group">
                                                 <button onclick='return stopload()' type="button"
                                                        class="btn btn-default" data-dismiss="modal">Cancel</button>

                                                 <script language="javascript" type="text/javascript">
                                                 var modal_emp = document.getElementById("modal_emp").value;

                                                 function OpenPopupCenter(val, pageURL,
                                                        title, w, h) {
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
                         

                                                 <a href='#' id="show_preview2" style='display:none;' class="btn btn-primary" style="color: cornsilk;" onclick='return startload()'>
                                                               Preview Approver
                                                 </a>

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


                                                 <button class="btn btn-warning"
                                                        type="submit" 
                                                        name="submit_add_setting_shift_daily" 
                                                        id="submit_add_setting_shift_daily">
                                                        Submit
                                                 </button>

                                                 <button class="btn btn-warning" 
                                                        type="button" 
                                                        name="submit_add2"
                                                        id="submit_add2" 
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

       <!-- end of div overflow -->
       </div>
       <!-- end of div overflow -->

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
                     $('#inp_automaticovt_start').bootstrapMaterialDatePicker({
                            date: false,
                            format: 'HH:mm'
                     });
                     $('#inp_automaticovt_end').bootstrapMaterialDatePicker({
                            date: false,
                            format: 'HH:mm'
                     });
                     $('#inp_ovt_beforeend').bootstrapMaterialDatePicker({
                            date: false,
                            format: 'HH:mm'
                     });
                     $('#inp_ovt_afterstart').bootstrapMaterialDatePicker({
                            date: false,
                            format: 'HH:mm'
                     });
                     $('#inp_ovt_breakstart').bootstrapMaterialDatePicker({
                            date: false,
                            format: 'HH:mm'
                     });
                     $('#btsovt_1').bootstrapMaterialDatePicker({
                            date: false,
                            format: 'HH:mm'
                     });
                     $('#bteovt_1').bootstrapMaterialDatePicker({
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
                     var inp_shiftdailycode = document.getElementById("inp_shiftdailycode").value;
                     var inp_daytype = document.getElementById("inp_daytype").value;
                     var inp_starttime = document.getElementById("inp_starttime").value;
                     var inp_endtime = document.getElementById("inp_endtime").value;
                     var inp_graceforlate = document.getElementById("inp_graceforlate").value;
                     var inp_productivehours = document.getElementById("inp_productivehours").value;
                     var inp_remark = document.getElementById("inp_remark").value;
                     var inp_grace_eai = document.getElementById("inp_grace_eai").value;
                     var inp_grace_lti = document.getElementById("inp_grace_lti").value;
                     var inp_grace_eao = document.getElementById("inp_grace_eao").value;
                     var inp_grace_lto = document.getElementById("inp_grace_lto").value;
                     var inp_overtimecode = document.getElementById("inp_overtimecode").value;
                     var inp_overtimecode_ph = document.getElementById("inp_overtimecode_ph").value;

                      if (inp_shiftdailycode == "") {
                            modals.style.display = 'block';
                            document.getElementById('msg').innerHTML = 'Shiftdaily Code cannot empty';
                            return false;
                     
                     } else if (inp_daytype == "WD") {

                            if (inp_starttime == "") {
                                   modals.style.display = 'block';
                                   document.getElementById('msg').innerHTML = 'Starttime cannot empty';
                                   return false;

                            } else if (inp_endtime == "") {
                                   modals.style.display = 'block';
                                   document.getElementById('msg').innerHTML = 'Endtime cannot empty';
                                   return false;
                            
                            } else if (inp_graceforlate == "") {
                                   modals.style.display = 'block';
                                   document.getElementById('msg').innerHTML = 'Grace for late cannot empty';
                                   return false;
                            
                            } else if (inp_productivehours == "") {
                                   modals.style.display = 'block';
                                   document.getElementById('msg').innerHTML = 'Productive Hours cannot empty';
                                   return false;
                            
                            } else if (inp_remark == "") {
                                   modals.style.display = 'block';
                                   document.getElementById('msg').innerHTML = 'Remark cannot empty';
                                   return false;
                            
                            } else if (inp_grace_eai == "") {
                                   modals.style.display = 'block';
                                   document.getElementById('msg').innerHTML = 'Grace eai cannot empty';
                                   return false;
                            
                            } else if (inp_grace_lti == "") {
                                   modals.style.display = 'block';
                                   document.getElementById('msg').innerHTML = 'Grace lti cannot empty';
                                   return false;
                            
                            } else if (inp_grace_eao == "") {
                                   modals.style.display = 'block';
                                   document.getElementById('msg').innerHTML = 'Grace eao cannot empty';
                                   return false;
                            
                            } else if (inp_grace_lto == "") {
                                   modals.style.display = 'block';
                                   document.getElementById('msg').innerHTML = 'Grace lto cannot empty';
                                   return false;

                            } else if (inp_overtimecode == "") {
                                   modals.style.display = 'block';
                                   document.getElementById('msg').innerHTML = 'Please select Overtime code';
                                   return false;
                            
                            } else if (inp_overtimecode_ph == "") {
                                   modals.style.display = 'block';
                                   document.getElementById('msg').innerHTML = 'Please select Overtime code Public Holiday';
                                   return false;


                            } else {
                                   $('#submit_add').hide();
                                   $('#submit_add2').show();
                            }

                     } else if (inp_daytype == "OFF") {

                            if (inp_productivehours == "") {
                                   modals.style.display = 'block';
                                   document.getElementById('msg').innerHTML = 'Productive Hours cannot empty';
                                   return false;

                            } else if (inp_remark == "") {
                                   modals.style.display = 'block';
                                   document.getElementById('msg').innerHTML = 'Remark cannot empty';
                                   return false;

                            } else if (inp_grace_eai == "") {
                                   modals.style.display = 'block';
                                   document.getElementById('msg').innerHTML = 'Grace eai cannot empty';
                                   return false;

                            } else if (inp_grace_lti == "") {
                                   modals.style.display = 'block';
                                   document.getElementById('msg').innerHTML = 'Grace lti cannot empty';
                                   return false;

                            } else if (inp_grace_eao == "") {
                                   modals.style.display = 'block';
                                   document.getElementById('msg').innerHTML = 'Grace eao cannot empty';
                                   return false;

                            } else if (inp_grace_lto == "") {
                                   modals.style.display = 'block';
                                   document.getElementById('msg').innerHTML = 'Grace lto cannot empty';
                                   return false;

                            } else if (inp_overtimecode == "") {
                                   modals.style.display = 'block';
                                   document.getElementById('msg').innerHTML = 'Please select Overtime code';
                                   return false;

                            } else if (inp_overtimecode_ph == "") {
                                   modals.style.display = 'block';
                                   document.getElementById('msg').innerHTML = 'Please select Overtime code Public Holiday';
                                   return false;


                            } else {
                                   $('#submit_add').hide();
                                   $('#submit_add2').show();
                            }
                     } else {
                            $('#submit_add').hide();
                            $('#submit_add2').show();
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