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
function getToken($val){
       $token = password_hash($val, PASSWORD_DEFAULT);
              return $token;
       }
$get_token = getToken('1');
?>

              <script>
              $(document).ready(function() {
                     $('#modal_leave').on('blur', function() {

                            var inp_leavedaytype = document.getElementById("inp_leavedaytype").value;
                            var inp_leaveisurgent = document.getElementById("inp_leaveisurgent").value;

                            if (inp_leavedaytype == 'HD') {
                                   $("#HD").show();

                                   $("#inp_hdtype_starttime_full_day").show();
                                   $("#inp_starttime").hide();
                                   $("#inp_endtime").hide();

                                   $(document).ready(function() {
                                          $("#hide").click(function() {
                                                 $("#inp_hdtype_starttime")
                                                        .show();
                                                 $("#inp_hdtype_starttime_full_day")
                                                        .hide();

                                                 document.getElementById(
                                                        "inp_hdtype_starttime"
                                                        ).setAttribute(
                                                        "name",
                                                        "inp_hdtype_starttime"
                                                        );
                                                 document.getElementById(
                                                        "inp_hdtype_starttime_full_day"
                                                        ).setAttribute(
                                                        "name",
                                                        "hidden");

                                                 $("#show").show();
                                                 $("#hide").hide();
                                          });
                                          $("#show").click(function() {
                                                 $("#inp_hdtype_starttime")
                                                        .hide();
                                                 $("#inp_hdtype_starttime_full_day")
                                                        .show();

                                                 document.getElementById(
                                                        "inp_hdtype_starttime"
                                                        ).setAttribute(
                                                        "name",
                                                        "hidden");
                                                 document.getElementById(
                                                        "inp_hdtype_starttime_full_day"
                                                        ).setAttribute(
                                                        "name",
                                                        "inp_hdtype_starttime"
                                                        );

                                                 $("#show").hide();
                                                 $("#hide").show();
                                          });


                                   });

                            } else if (inp_leavedaytype == 'PD') {
                                   $("#HD").hide();
                                   $("#inp_hdtype_starttime").hide();
                                   $("#inp_hdtype_starttime_full_day").hide();
                                   $("#inp_starttime").show();
                                   $("#inp_endtime").show();
                            } else {
                                   $("#HD").hide();
                                   $("#inp_hdtype_starttime").hide();
                                   $("#inp_hdtype_starttime_full_day").hide();
                                   $("#inp_starttime").hide();
                                   $("#inp_endtime").hide();
                            }

                            if (inp_leaveisurgent == '1') {
                                   $("#tr_inp_leaveisurgent").show();
                            } else {
                                   $("#tr_inp_leaveisurgent").hide();
                            }


                     });
              });

              //CEK APAKAH URGENT ATAU TIDAK
              //CEK APAKAH URGENT ATAU TIDAK
              $(document).ready(function() {
                     $("#inp_urgent_on").click(function() {
                            var inp_urgent_on = document.getElementById("inp_urgent_on").value;
                            if (inp_urgent_on == '1') {
                                   $("#tr_inp_urgent_on").hide();
                                   $("#tr_inp_urgent_off").show();
                                   $("#tr_inp_urgent_reason").show();
                                   $('#inp_urgent_on').prop('checked', false);
                                   document.getElementById("inp_urgent_on_back").setAttribute("name",
                                          "hidden");


                            }
                     });
              });
              $(document).ready(function() {
                     $("#inp_urgent_off").click(function() {
                            var inp_urgent_off = document.getElementById("inp_urgent_off").value;
                            if (inp_urgent_off == '0') {
                                   $("#tr_inp_urgent_on").show();
                                   $("#tr_inp_urgent_off").hide();
                                   $("#tr_inp_urgent_reason").hide();
                                   $('#inp_urgent_off').prop('checked', true);
                                   document.getElementById("inp_urgent_on_back").setAttribute("name",
                                          "inp_urgent_decl");
                            }
                     });
              });
              //CEK APAKAH URGENT ATAU TIDAK
              //CEK APAKAH URGENT ATAU TIDAK 

              $(document).ready(function() {
                     $('#modal_leave_start, #modal_leave_end, #button-2').on('change', function() {
                            var modal_leave_starts = document.getElementById("modal_leave_start").value;
                            var modal_leave_ends = document.getElementById("modal_leave_end").value;

                            var inp_leavedaytype = document.getElementById("inp_leavedaytype").value;
                            var modal_leave = document.getElementById("modal_leave").value;

                            var from = new Date(modal_leave_starts).getTime();
                            var to = new Date(modal_leave_ends).getTime();

                            if (from < to && inp_leavedaytype == 'HD') {
                                   $("#inp_hdtype_starttime_con2").show();
                                   $("#inp_hdtype_starttime2").show();

                                   $("#inp_hdtype_starttime_full_day").hide();
                                   $("#inp_hdtype_starttime").hide();

                                   $("#show").hide();

                                   document.getElementById("inp_hdtype_starttime_full_day").setAttribute("name","hidden");
                                   document.getElementById("inp_hdtype_starttime_con2").setAttribute("name", "inp_hdtype_starttime");
                                   document.getElementById("inp_hdtype_starttime").setAttribute("name", "hidden");
                                   document.getElementById("inp_hdtype_starttime2").setAttribute("name", "inp_hdtype_starttime2");
                                   document.getElementById("inp_hdtype_starttime2_declare").setAttribute("name", "hidden");

                            } else if (from == to && inp_leavedaytype == 'HD') {
                                   // $("#inp_hdtype_starttime2").show();
                                   // $("#inp_hdtype_starttime_con2").show();

                                   $("#inp_hdtype_starttime_con2").hide();
                                   $("#inp_hdtype_starttime2").hide();

                                   $("#inp_hdtype_starttime_full_day").show();
                                   $("#inp_hdtype_starttime2_declare").show();

                                   $("#show").show();

                                   document.getElementById("inp_hdtype_starttime_full_day").setAttribute("name","inp_hdtype_starttime");
                                   document.getElementById("inp_hdtype_starttime_con2").setAttribute("name", "hidden");
                                   document.getElementById("inp_hdtype_starttime").setAttribute("name", "hidden");
                                   document.getElementById("inp_hdtype_starttime2").setAttribute("name", "hidden");
                                   document.getElementById("inp_hdtype_starttime2_declare").setAttribute("name", "inp_hdtype_starttime2");

                            } else if (inp_leavedaytype == 'PD') {
                                   // $("#inp_hdtype_starttime2").show();
                                   // $("#inp_hdtype_starttime_con2").show();

                                   $("#inp_hdtype_starttime_con2").hide();
                                   $("#inp_hdtype_starttime2").hide();

                                   $("#inp_hdtype_starttime_full_day").hide();
                                   $("#inp_hdtype_starttime2_declare").hide();

                                   $("#show").show();

                                   document.getElementById("inp_hdtype_starttime_con2").setAttribute(
                                          "name", "hidden");
                                   document.getElementById("inp_hdtype_starttime").setAttribute("name",
                                          "hidden");
                            } else if (from > to) {
                                   $("#inp_hdtype_starttime_con2").hide();
                                   $("#inp_hdtype_starttime2").hide();

                                   $("#inp_hdtype_starttime_full_day").hide();
                                   $("#inp_hdtype_starttime").hide();

                                   $("#show").hide();

                                   document.getElementById("inp_hdtype_starttime2_declare").setAttribute(
                                          "name", "hidden");
                                   document.getElementById("inp_hdtype_starttime").setAttribute("name",
                                          "hidden");
                                   document.getElementById("inp_hdtype_starttime_full_day").setAttribute(
                                          "name", "hidden");

                            }
                     });

              });
              </script>
<!-- stop list select -->

















<div class="modal-dialog modal-med">
       <div class="modal-content">

              <div class="modal-header">
                     <h4 class="modal-title">Add Leave Requests</h4>
                     <div class="toolbar sprite-toolbar-close" aria-label="Close" onclick='return stopload()' data-dismiss="modal" id="SEARCH"
                                                                      title="Search"></div>
              </div>
              <form name='form1' method="post" id="multiple_upload_form" enctype="multipart/form-data"
                     onsubmit='return HrmsValidationForm()'>
                     <fieldset id="fset_1">
                            <legend>Leave Entry Form</legend>

                            <div class="form-row">
                                   <div class="col-4 name">Employee no*</div>
                                   <div class="col-sm-8">
                                          <div class="input-group">

                                                 <input class="input--style-6"
                                                        onkeyup="isi_otomatis(), isi_otomatis_leave()"
                                                        autocomplete="off" autofocus="on" id="modal_emp"
                                                        name="modal_emp" type="Text" value="<?php echo $username; ?>"
                                                        onfocus="hlentry(this)" size="30" maxlength="50" 
                                                        validate="NotNull:Invalid Form Entry"
                                                        onchange="formodified(this);" title="">
                                          </div>
                                   </div>
                            </div>

                            <?php 
                                   $emp = mysqli_fetch_array(mysqli_query($connect, "SELECT full_name FROM view_employee WHERE emp_no='$username'"));
                            ?>

                            <div class="form-row">
                                   <div class="col-4 name">Name*</div>
                                   <div class="col-sm-8">
                                          <div class="input-group">

                                                 <input class="input--style-6" style="background-color: #fff3b4;"
                                                        id="inp_nickname" name="inp_nickname" type="Text"
                                                        value="<?php echo $emp['full_name']; ?>" onfocus="hlentry(this)" size="20"
                                                        maxlength="50"  validate="NotNull:Invalid Form Entry"
                                                        onchange="formodified(this);" title="" readonly>
                                          </div>
                                   </div>
                            </div>

                            <div class="form-row">
                                   <div class="col-4 name">Type of Leave*</div>
                                   <div class="col-sm-8">
                                          <div class="input-group">

                                                 <select class="input--style-6 modal_leave" name="modal_leave"
                                                        style="width: 50%;height: 30px;" id="modal_leave"
                                                        onchange="isi_otomatis_leave()">
                                                        <option value="0">--Select One--</option>
                                                        <?php
                                                               $sql = mysqli_query($connect,"select * from ttamleavetype");
                                                               while($row=mysqli_fetch_array($sql))
                                                               {
                                                               echo '<option value="'.$row['leave_code'].'">'.$row['leavename_en'].'</option>';
                                                               } 
                                                               ?>
                                                 </select>
                                          </div>
                                   </div>
                            </div>

                            <div class="form-row">
                                   <div class="col-4 name">Balance*</div>
                                   <div class="col-sm-8">
                                          <div class="input-group">

                                                 <input class="input--style-6"
                                                        style="margin-bottom: 2px;background-color: #fff3b4;"
                                                        id="inp_leavebalance" name="inp_leavebalance" type="Text"
                                                        value="" onfocus="hlentry(this)" size="20" maxlength="50"
                                                         validate="NotNull:Invalid Form Entry"
                                                        onchange="formodified(this);" title="" readonly>
                                          </div>
                                   </div>
                            </div>

                            <div class="form-row">
                                   <div class="col-4 name">Date of Leave*</div>
                                   <div class="col-sm-4" style="padding-bottom:5px">
                                          <div class="input-group">

                                                 <input type="text" id="modal_leave_start" class="input--style-6"
                                                        name="modal_leave_start" style="
                                                                      background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                      background-size: 17px;
                                                                      background-position:right;   
                                                                      background-repeat:no-repeat; 
                                                                      padding-right:10px;  
                                                                      "
                                                                      autocomplete="off"/>
                                          </div>
                                   </div>

                                   <div class="col-sm-3">
                                          <div class="input-group">
                                                 <select class="input--style-6"
                                                        style='display:none;height: 30px;width:150px'
                                                        id="inp_hdtype_starttime" name="inp_hdtype_starttime"
                                                        onfocus="hlentry(this)" onchange="formodified(this);" >
                                                        <option value="1" style="display: none;">First Half</option>
                                                        <option value="1">First Half</option>
                                                        <option value="2">Second Half</option>
                                                 </select>

                                                 <select class="input--style-6"
                                                        style='display:none;height: 30px;width:150px'
                                                        id="inp_hdtype_starttime_con2" name="inp_hdtype_starttime"
                                                        onfocus="hlentry(this)" onchange="formodified(this);" >
                                                        <option value="3" style="display: none;">Full Day</option>
                                                        <option value="3">Full Day</option>
                                                        <option value="1">First Half</option>
                                                        <option value="2">Second Half</option>
                                                 </select>

                                                 <select class="input--style-6"
                                                        style='display:none;background-color: blanchedalmond;height: 30px;width:150px'
                                                        id="inp_hdtype_starttime_full_day" name="inp_hdtype_starttime"
                                                        onfocus="hlentry(this)" onchange="formodified(this);" >
                                                        <option value="3" style="display: none;">Full Day</option>
                                                        <option value="3">Full Day</option>
                                                 </select>

                                                 <!-- UNTUK TIPE PART OF DAY / JAM JAMAN -->
                                                 <!-- UNTUK TIPE PART OF DAY / JAM JAMAN -->
                                                 <input class="input--style-6"
                                                        style="display:none; margin-bottom: 2px; width: 90px;"
                                                        id="inp_starttime" name="inp_starttime" placeholder="HH:ii"
                                                        value="00:00"
                                                        pattern="([0-1]{1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}">
                                                 <!-- UNTUK TIPE PART OF DAY / JAM JAMAN -->
                                                 <!-- UNTUK TIPE PART OF DAY / JAM JAMAN -->
                                          </div>
                                   </div>
                                   <div id='HD' class="col-sm-1" style='display:none;'>
                                          <div class="input-group">
                                                 <div style='display:none;' id="hide" class="toolbar sprite-toolbar-add"
                                                        id="add" title="Add"></div>
                                                 <div id="show" class="toolbar sprite-toolbar-add" id="add" title="Add">
                                                 </div>
                                          </div>
                                   </div>
                            </div>

                            <div class="form-row">
                                   <div class="col-4 name">To</div>
                                   <div class="col-sm-4" style="padding-bottom:5px">
                                          <div class="input-group">

                                                 <input class="input--style-6" maxlength="10" type="text" style="
                                                                      background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                      background-size: 17px;
                                                                      background-position:right;   
                                                                      background-repeat:no-repeat; 
                                                                      padding-right:10px;  
                                                                      " id="modal_leave_end" name="modal_leave_end"
                                                                      autocomplete="off"/>
                                          </div>
                                   </div>

                                   <div class="col-sm-3">
                                          <div class="input-group">


                                                 <select class="input--style-6"
                                                        style='display:none;height: 30px;width:150px'
                                                        id="inp_hdtype_starttime2" name="inp_hdtype_starttime2"
                                                        onfocus="hlentry(this)" onchange="formodified(this);" >
                                                        <option value="1" style="display: none;">First Half</option>
                                                        <option value="1">First Half</option>
                                                        <option value="3">Full Day</option>
                                                 </select>

                                                 <input id="inp_hdtype_starttime2_declare" name="inp_hdtype_starttime2"
                                                        type="hidden" value="undefined">

                                                 <!-- UNTUK TIPE PART OF DAY / JAM JAMAN -->
                                                 <!-- UNTUK TIPE PART OF DAY / JAM JAMAN -->
                                                 <input class="input--style-6"
                                                        style="display:none; margin-bottom: 2px; width: 90px;"
                                                        id="inp_endtime" name="inp_endtime" placeholder="HH:ii"
                                                        value="00:00"
                                                        pattern="([0-1]{1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}">
                                                 <!-- UNTUK TIPE PART OF DAY / JAM JAMAN -->
                                                 <!-- UNTUK TIPE PART OF DAY / JAM JAMAN -->

                                          </div>
                                   </div>

                            </div>

                            <div class="form-row">
                                   <div class="col-4 name">Remark*</div>
                                   <div class="col-sm-8">
                                          <div class="input-group">
                                                 <textarea class="textarea--style-6" id="inp_remark" name="inp_remark"
                                                        placeholder="Remark of Leave"></textarea>
                                          </div>
                                   </div>
                            </div>

                            <div class="form-row" id="tr_inp_leaveisurgent" style='display:none;'>
                                   <div class="col-4 name">Urgent? </div>
                                   <div class="col-sm-8">
                                          <div class="input-group" id="tr_inp_urgent_on">
                                                 <div class="vc-toggle-container">
                                                        <label class="vc-switch">
                                                               <input type="checkbox" name="inp_urgents"
                                                                      id="inp_urgent_on" value='1'
                                                                      class="vc-switch-input" />
                                                               <input type="hidden" checked="checked"
                                                                      name="inp_urgent_decl" id="inp_urgent_on_back"
                                                                      value='1' class="vc-switch-input hidden" />
                                                               <span class="vc-switch-label" data-on="Yes"
                                                                      data-off="No"></span>
                                                               <span class="vc-handle"></span>
                                                        </label>
                                                 </div>
                                          </div>
                                          <div class="input-group" id="tr_inp_urgent_off" style='display:none;'>
                                                 <div class="vc-toggle-container">
                                                        <label class="vc-switch">
                                                               <input type="checkbox" checked="checked"
                                                                      name="inp_urgent" id="inp_urgent_off" value='0'
                                                                      class="vc-switch-input" />
                                                              
                                                               <span class="vc-switch-label" data-on="Yes"
                                                                      data-off="No"></span>
                                                               <span class="vc-handle"></span>
                                                        </label>
                                                 </div>

                                          </div>
                                   </div>
                            </div>

                           

                            <div class="form-row" id="tr_inp_urgent_reason" style='display:none;'>
                                   <div class="col-4 name">Urgent Reason</div>
                                   <div class="col-sm-8">
                                          <div class="input-group">
                                                 <select name="sel_inp_urgreason" class="input--style-6 urgent_reason"
                                                        style="margin-bottom: 2px; width: 100%;height: 30px;">
                                                        <option>--Select One--</option>
                                                 </select>
                                          </div>
                                   </div>
                            </div>

                            <div class="form-row">
                                   <div class="col-4 name">File Attachment </div>
                                   <div class="col-sm-8">
                                          <div class="input-group js-input-file">
                                                 <input class="input-file" id="inp_refdoc" name="inp_refdoc[]"
                                                        type="File" value="" onfocus="hlentry(this)" size="30"
                                                        maxlength="50" style="float: left; margin: -3px;"
                                                        onchange="formodified(this);" title="">
                                          </div>
                                          <div class="label--desc">Upload your Effident or any other relevant file. Max
                                                 file size 50 MB, doc,jpg,ods,png,txt,docx,pdf </div>
                                   </div>
                            </div>

                            <table style="width: 95%;">
                                   <input type="hidden" id="inp_leavedaytype" name="inp_leavedaytype" value="">
                                   <input type="hidden" id="get_token" name="get_token" value="<?php echo $get_token; ?>">
                                   <input type="hidden" id="inp_leaveisurgent" name="inp_leaveisurgent" value="">
                            </table>

                            <div id="box"></div>
                            <div id="boxifblur"></div>
                     </fieldset>


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
                         
                                                        
                                                 <a href='#' id="show_preview" class="btn btn-primary" style="color: cornsilk;" onclick='return startload()'>
                                                               Preview Approver
                                                 </a>

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


                                                 <button type="submit" name="submit_add" id="submit_add"
                                                        class="btn btn-warning">Submit</button>

                                                 <button class="btn btn-warning" type="button" name="submit_add2"
                                                        id="submit_add2" style='display:none;' disabled>
                                                        <span class="spinner-grow spinner-grow-sm" role="status"
                                                               aria-hidden="true"></span>
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
                            url: 'ajax_cek3_mysql.php?emp_id=13-0299',
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

              <!-- <script type="text/javascript">
              $(document).ready(function() {

                     $(".close_modal").click(function(e) {
                            $("#ModalEdits1").hide();
                            $('#ModalEdits1').find('.close').remove();
   
                            $('#ModalEdits1').unbind('click');
                     });
              });
              </script> -->

              

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
                     var modal_emp = document.getElementById("modal_emp").value;
                     var modal_leave = document.getElementById("modal_leave").value;
                     var inp_leavebalance = document.getElementById("inp_leavebalance").value;
                     var modal_leave_starts = document.getElementById("modal_leave_start").value;
                     var modal_leave_ends = document.getElementById("modal_leave_end").value;
                     var inp_remark = document.getElementById("inp_remark").value;
                     var inp_leavedaytype = document.getElementById("inp_leavedaytype").value;
                   


                     var from = new Date(modal_leave_starts).getTime();
                     var to = new Date(modal_leave_ends).getTime();


                     if (from > to) {
                            alert("Entry Date: Enter Date in Proper Range");
                            return false;
                     } else if (modal_emp == "") {
                            alert("Employee Number invalid");
                            return false;
                     } else if (modal_leave == "") {
                            alert("Please select type of leave");
                            return false;
                     } else if (inp_leavebalance == "") {
                            alert("Please Select Type of leave");
                            return false;
                     } else if (modal_leave_starts == "") {
                            alert("Start date Cant empty");
                            return false;
                     } else if (modal_leave_ends == "") {
                            alert("End date Cant empty");
                            return false;
                     } else if (inp_remark == "") {
                            alert("Remark Cant empty");
                            return false;
                     } else if (inp_leavedaytype == "PD" && from < to) {
                            alert("Partial Day Permit just allowing max 5 Hours");
                            return false;
                    
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