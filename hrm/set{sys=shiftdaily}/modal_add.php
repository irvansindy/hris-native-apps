
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
              <form name='form1' method="post" id="multiple_upload_form" enctype="multipart/form-data"
                     onsubmit='return HrmsValidationForm()'>
                     <fieldset id="fset_1">
                            <legend>Setting Shift Form</legend>

                            <div class="form-row">
                                   <div class="col-4 name">Group Code <font color="red">*</font></div>
                                   <div class="col-sm-8">
                                          <div class="input-group">
                                                 <input class="input--style-6"
                                                        type="Text"
                                                        id="inp_group_code"
                                                        name="inp_group_code"
                                                        value=""
                                                        autocomplete="off"
                                                        autofocus="on" 
                                                        size="30" 
                                                        maxlength="50" 
                                                        
                                                        placeholder="group_code"
                                                        title="group_code">
                                          </div>
                                   </div>
                            </div>

                            <div class="form-row">
                                   <div class="col-4 name">Group Name <font color="red">*</font></div>
                                   <div class="col-sm-8">
                                          <div class="input-group">
                                                 <input class="input--style-6"
                                                        type="Text"
                                                        id="inp_shiftregroup_name"
                                                        name="inp_shiftregroup_name"
                                                        value=""
                                                        autocomplete="off"
                                                        autofocus="on" 
                                                        size="30" 
                                                        maxlength="50" 
                                                        
                                                        placeholder="shiftregroup_name"
                                                        title="shiftregroup_name">
                                          </div>
                                   </div>
                            </div>

                            <div class="form-row">
                                   <div class="col-12 name">Shift Assign <font color="red">*</font></div>
                                   <div class="col-sm-12">
                                          <div class="input-group">
                                                 <table id="example3LOAD" width="99%" border="1"
                                                 class="table table-bordered table-striped table-hover table-head-fixed">
                                                 <thead>
                                                               <tr>
                                                                      <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No</th>
                                                                      <th class="fontCustom" style="z-index: 1;">Group Code</th>
                                                                      <th class="fontCustom" style="z-index: 1;">Group Name</th>
                                                                      <th class="fontCustom" style="z-index: 1;">Year</th>
                                                                      <th class="fontCustom" style="z-index: 1;">Preview</th>
                                                                      <th class="fontCustom" style="z-index: 1;">Last Modified</th>
                                                                      <th class="fontCustom" style="z-index: 1;width: 80%;"></th>
                                                               </tr>

                                                 </thead>
                                                               <?php
                                                                      $sql = mysqli_query($connect, "SELECT * FROM `HRMTSHIFTREGROUP` ORDER BY shiftyear DESC");
                                                                      $no = 0;
                                                                      $no++;
                                                                      while ($r = mysqli_fetch_array($sql)) {
                                                               ?>
                                                               <tr>
                                                                      <td class="fontCustom" style="z-index: 1;" nowrap="nowrap"><?php echo $no++; ?></td>          
                                                                      <td class="fontCustom" style="z-index: 1;" nowrap="nowrap"><?php echo $r['group_code']; ?></td>   
                                                                      <td class="fontCustom" style="z-index: 1;" nowrap="nowrap"><?php echo $r['shiftregroup_name']; ?></td>   
                                                                      <td class="fontCustom" style="z-index: 1;" nowrap="nowrap"><?php echo $r['shiftyear']; ?></td>   
                                                                      <td class="fontCustom" style="z-index: 1;" nowrap="nowrap">View</td>        
                                                                      <td class="fontCustom" style="z-index: 1;" nowrap="nowrap"><?php echo date("d M Y h:i:s" , strtotime($r['modified_date'])); ?></td>
                                                                      <?php } ?>   
                                                               </tr>
                                          </table>

                                          </div>
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