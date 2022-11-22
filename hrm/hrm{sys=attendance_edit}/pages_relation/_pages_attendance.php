<?php
include "../../../application/config.php";
$src_emp_no          = $_GET['src_emp_no'];
$src_startdate       = $_GET['inp_add_startdate'];
$src_enddate         = $_GET['inp_add_enddate'];

include "../../../model/ta/GMAttendanceEditList.php";

$employee = mysqli_fetch_array(mysqli_query($connect, "SELECT Full_Name, pos_name_en FROM view_employee WHERE emp_no = '$src_emp_no'"));
?>


<div class="card-body table-responsive p-0" style="min-height:200px; width: 100vw; width: 99.1%; margin: 5px;overflow-y: scroll;overflow-x: scroll;">
       <form class="form-horizontal" action="php_action/FuncDataCreateAnswer.php" method="POST" id="FormAttendanceEdit" onkeydown="return event.key != 'Enter';">
              <input type="hidden" name="employeee" value="<?php echo $src_emp_no; ?>">

              <label id="loop_employee"><?php echo $src_emp_no ?> [ <?php echo $employee[0] ?> ] <?php echo $employee[1] ?></label>
              <table id="datatable" width="60%" class="table table-bordered table-striped table-hover table-head-fixed" style="width: 100%">
                     <thead>
                            <tr>
                                   <td rowspan="2" style="vertical-align: inherit;background: #ccc;font-weight: bold;color: white;border: 1px solid white;;text-align: center;">Date</td>
                                   <td rowspan="2" style="vertical-align: inherit;background: #ccc;font-weight: bold;color: white;border: 1px solid white;;text-align: center;">Shift</td>
                                   <td colspan="2" rowspan="1" style="vertical-align: inherit;background: #ccc;font-weight: bold;color: white;border: 1px solid white;;text-align: center;">Shift Daily</td>
                                   <td colspan="2" style="vertical-align: inherit;background: #ccc;font-weight: bold;color: white;border: 1px solid white;;text-align: center;">Actual Time</td>
                                   <td colspan="2" style="vertical-align: inherit;background: #ccc;font-weight: bold;color: white;border: 1px solid white;;text-align: center;">Over Time</td>
                                   <td rowspan="2" style="vertical-align: inherit;background: #ccc;font-weight: bold;color: white;border: 1px solid white;;text-align: center;">Day Type</td>
                                   <td rowspan="2" style="vertical-align: inherit;background: #ccc;font-weight: bold;color: white;border: 1px solid white;;text-align: center;">Status</td>
                                   <td rowspan="2" style="vertical-align: inherit;background: #ccc;font-weight: bold;color: white;border: 1px solid white;;text-align: center;">Remark</td>
                                   <td rowspan="2" style="vertical-align: inherit;background: #ccc;font-weight: bold;color: white;border: 1px solid white;;text-align: center;">Update <input id="checkAll" name="checkAll" type="checkbox" /></td>
                            </tr>
                            <tr>
                                   <td style="background: #ccc;font-weight: bold;color: white;border: 1px solid white;;text-align: center;">in</td>
                                   <td style="background: #ccc;font-weight: bold;color: white;border: 1px solid white;;text-align: center;">Out</td>
                                   <td style="background: #ccc;font-weight: bold;color: white;border: 1px solid white;;text-align: center;">Time</td>
                                   <td style="background: #ccc;font-weight: bold;color: white;border: 1px solid white;;text-align: center;">Time</td>
                                   <td colspan="2" style="background: #ccc;font-weight: bold;color: white;border: 1px solid white;text-align: center;">Minute(s) (Index)</td>
                            </tr>
                     </thead>


                     <?php
                     $data_attendance = mysqli_query($connect, $qListRender_srvside);

                     while ($r = mysqli_fetch_array($data_attendance)) {
                     ?>


                            <tr id="<?php echo $r["key_att"]; ?>">

                                   <input id="employeeR" name="employeeR" type="hidden" readonly="true" size="4" value="<?php echo $src_emp_no_ori; ?>" style="background:yellow">
                                   <input id="inp_startdate" name="inp_startdate" type="hidden" readonly="true" size="4" value="<?php echo $src_startdate; ?>" style="background:yellow">
                                   <input id="inp_enddate" name="inp_enddate" type="hidden" readonly="true" size="4" value="<?php echo $src_enddate; ?>" style="background:yellow">

                                   <input id="inp_dateforcheck_<?php echo $r['key_att']; ?>" name="inp_dateforcheck_<?php echo $r['key_att']; ?>" type="hidden" readonly="true" size="4" value="<?php echo $r['dateforcheck']; ?>" style="background:yellow">
                                   <input id="inp_attend_id_<?php echo $r['key_att']; ?>" name="inp_attend_id_<?php echo $r['key_att']; ?>" type="hidden" readonly="true" size="4" value="<?php echo $r['attend_id']; ?>" style="background:yellow">
                                   <input id="emp_id_<?php echo $r['key_att']; ?>" name="emp_id_<?php echo $r['key_att']; ?>" type="hidden" readonly="true" size="4" value="<?php echo $r['emp_id']; ?>" style="background:yellow">

                                   <td nowrap="nowrap" style="<?php echo $r['style']; ?>"> <?php echo $r['attend_date']; ?> </td>
                                   <td> <select id="sel_shiftdaily_code_<?php echo $r['key_att']; ?>" class="input--style-6" name="sel_shiftdaily_code_<?php echo $r['key_att']; ?>" onfocus="hlentry(this)" onchange="myFunction_kodestart_<?php echo $r['key_att']; ?>()" style="border: 1px solid #d9bfbf;font-size: 12px;padding: 4px;background: #d9d9d9;width: 78.9px;">
                                                 <option value="<?php echo $r['shiftdaily_code']; ?>" selected>
                                                        <?php echo $r['shiftdaily_code']; ?></option>
                                                 <?php
                                                 $sql = mysqli_query($connect, "SELECT shiftdailycode FROM hrmttamshiftdaily");
                                                 while ($row = mysqli_fetch_array($sql)) {
                                                        echo '<option value="' . $row['shiftdailycode'] . '">' . $row['shiftdailycode'] . '</option>';
                                                 }
                                                 ?>
                                          </select> </td>

                                   <td style="padding-top: 13px;" align="center">
                                          <p id="shiftstarttime_<?php echo $r['key_att']; ?>">
                                                 <?php echo $r['shiftstarttime']; ?></p>
                                          <input id="inp_shiftstart_1" name="inp_shiftstart_1" type="hidden" readonly="true" size="4" value="<?php echo $r['shiftstarttime']; ?>" style="background:yellow">
                                   </td>
                                   <td style="padding-top: 13px;" align="center">
                                          <p id="shiftendtime_<?php echo $r['key_att']; ?>">
                                                 <?php echo $r['shiftendtime']; ?></p>
                                          <input id="inp_shiftend_1" name="inp_shiftend_1" type="hidden" readonly="true" size="4" value="<?php echo $r['shiftendtime']; ?>" style="background:yellow">
                                   </td>


                                   <td>
                                          <table>
                                                 <tr style="background-color: #f0f8ff00;border: 0px solid black;">
                                                        <td style="white-space: nowrap;border: 1px solid transparent;padding: 0;">
                                                               <label>
                                                                      <input type="radio" id="starttime1_in_<?php echo $r['key_att']; ?>" name="starttime_in_<?php echo $r['key_att']; ?>" value="<?php echo $r['sfdayminone']; ?>" checked>
                                                                      <img src="../../asset/dist/img/calendar-icon.png" width="100px" style="width: 25px;">
                                                                      <?php echo $r['sdayminone']; ?>
                                                               </label>
                                                               <label>
                                                                      <input type="radio" id="starttime2_in_<?php echo $r['key_att']; ?>" name="starttime_in_<?php echo $r['key_att']; ?>" value="<?php echo $r['sfdayone']; ?>" <?php echo $r['sdayone_check']; ?>>
                                                                      <img src="../../asset/dist/img/calendar-icon.png" width="100px" style="width: 25px;">
                                                                      <?php echo $r['sdayone']; ?>
                                                               </label>
                                                               <label>
                                                                      <input type="radio" id="starttime3_in_<?php echo $r['key_att']; ?>" name="starttime_in_<?php echo $r['key_att']; ?>" value="<?php echo $r['sfdayplusone']; ?>" <?php echo $r['sdayplusone_check']; ?>>
                                                                      <img src="../../asset/dist/img/calendar-icon.png" width="100px" style="width: 25px;">
                                                                      <?php echo $r['sdayplusone']; ?>
                                                               </label>

                                                        </td>
                                                        <td style="white-space: nowrap;border: 1px solid transparent;padding: 0;padding-left: 5px;">
                                                               <input type="text" name="inp_hours_starttime_<?php echo $r['key_att']; ?>" id="inp_hours_starttime_<?php echo $r['key_att']; ?>" value="<?php echo $r['starttime']; ?>" style="border: 1px solid #d9bfbf;font-size: 12px;width: 70px;padding: 4px;"></label>
                                                        </td>
                                                 </tr>
                                          </table>
                                   </td>

                                   <td>
                                          <table>
                                                 <tr style="background-color: #f0f8ff00;border: 0px solid black;">
                                                        <td style="white-space: nowrap;border: 1px solid transparent;padding: 0;">
                                                               <label>
                                                                      <input type="radio" id="endtime1_out<?php echo $r['key_att']; ?>" name="endtime_out_<?php echo $r['key_att']; ?>" value="<?php echo $r['sfdayminone']; ?>" <?php echo $r['edayminone_check']; ?>>
                                                                      <img src="../../asset/dist/img/calendar-icon.png" width="100px" style="width: 25px;">
                                                                      <?php echo $r['sdayminone']; ?>
                                                               </label>
                                                               <label>
                                                                      <input type="radio" id="endtime2_out<?php echo $r['key_att']; ?>" name="endtime_out_<?php echo $r['key_att']; ?>" value="<?php echo $r['sfdayone']; ?>" <?php echo $r['edayone_check']; ?>>
                                                                      <img src="../../asset/dist/img/calendar-icon.png" width="100px" style="width: 25px;">
                                                                      <?php echo $r['sdayone']; ?>
                                                               </label>
                                                               <label>
                                                                      <input type="radio" id="endtime3_out<?php echo $r['key_att']; ?>" name="endtime_out_<?php echo $r['key_att']; ?>" value="<?php echo $r['sfdayplusone']; ?>" <?php echo $r['edayplusone_check']; ?>>
                                                                      <img src="../../asset/dist/img/calendar-icon.png" width="100px" style="width: 25px;">
                                                                      <?php echo $r['sdayplusone']; ?>
                                                               </label>
                                                        </td>
                                                        <td style="white-space: nowrap;border: 1px solid transparent;padding: 0;padding-left: 5px;">
                                                               <input type="text" name="inp_hours_endtime_<?php echo $r['key_att']; ?>" id="inp_hours_endtime_<?php echo $r['key_att']; ?>" value="<?php echo $r['endtime']; ?>" style="border: 1px solid #d9bfbf;font-size: 12px;width: 70px;padding: 4px;"></label>
                                                        </td>
                                                 </tr>
                                          </table>
                                   </td>


                                   <style type="text/css">
                                          label>input {
                                                 /* Menyembunyikan radio button */
                                                 visibility: hidden;
                                                 position: absolute;
                                          }

                                          label>input+img {
                                                 /* style gambar */
                                                 cursor: pointer;
                                                 border: 2px solid transparent;
                                          }

                                          label>input:checked+img {
                                                 /* (RADIO CHECKED) style gambar */
                                                 border: 2px solid #999;
                                                 border-radius: 4px;
                                          }
                                   </style>


                                   <td style="padding-top: 13px;">
                                          <input type="hidden" name="" value="<?php echo $r['accepted_min']; ?>" style="border: 1px solid #d9bfbf;font-size: 12px;width: 70px;padding: 4px;"></label>
                                          <?php echo $r['accepted_min']; ?>
                                   </td>

                                   <td>

                                          <li style="list-style-type: none;" class="nav-item dropdown open">
                                                 <a class="nav-link  waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <div class="toolbar sprite-toolbar-add" style="margin-top: -6px" id="add" title="Add"></div>
                                                 </a>


                                                 <div class="dropdown-menu mailbox dropdown-menu-right scale-up" style="background-color:#f9f4ca;  ">
                                                        <ul class="dropdown-user list-style-none">
                                                               <li>
                                                                      <div class="dw-user-box p-3 d-flex">
                                                                             <div class="u-text ml-2" style="height: 195px;background-color: #f9f4ca;">

                                                                                    <div class="form-row" id="OV0_<?php echo $r['key_att']; ?>">
                                                                                           <div class="col-sm-8" style="bottom: 6px;">
                                                                                                  <table>
                                                                                                         <thead>
                                                                                                                <tr>
                                                                                                                       <th>Time</th>
                                                                                                                       <th>(Minutes)</th>
                                                                                                                </tr>
                                                                                                         </thead>
                                                                                                         <tr>
                                                                                                                <td>Before</td>
                                                                                                                <td><input type="text" name="before_<?php echo $r['key_att']; ?>" value="<?php echo $r['before_min']; ?>" maxlength="5" size="4"></td>
                                                                                                         </tr>
                                                                                                         <tr>
                                                                                                                <td>Break1</td>
                                                                                                                <td><input type="text" name="break_<?php echo $r['key_att']; ?>" id="break_<?php echo $r['key_att']; ?>" value="<?php echo $r['break_1_min']; ?>" maxlength="5" size="4"></td>
                                                                                                         </tr>
                                                                                                         <tr>
                                                                                                                <td>After</td>
                                                                                                                <td><input type="text" name="after_<?php echo $r['key_att']; ?>" value="<?php echo $r['after_min']; ?>" maxlength="5" size="4"></td>
                                                                                                         </tr>

                                                                                                  </table>
                                                                                           </div>
                                                                                    </div>

                                                                             </div>
                                                                      </div>
                                                               </li>
                                                        </ul>
                                                 </div>
                                          </li>
                                   </td>

                                   <td style="padding-top: 13px;">
                                          <?php echo $r['daytype']; ?>
                                   </td>



                                   <td>
                                          <table>
                                                 <tr style="background-color: #f0f8ff00;border: 0px solid black;">
                                                        <td style="white-space: nowrap;border: 1px solid transparent;padding: 0;">
                                                               <input type="text" name="selected_attend_code_<?php echo $r['key_att']; ?>" id="selected_attend_code_<?php echo $r['key_att']; ?>" value="<?php echo $r['attdetaillist']; ?>" style="border: 1px solid #d9bfbf;font-size: 12px;padding: 4px;">
                                                        </td>
                                                        <td style="white-space: nowrap;border: 1px solid transparent;padding: 0;">






                                                               <li style="list-style-type: none;" class="nav-item dropdown open">

                                                                      <a onclick="myFunction_selected_<?php echo $r['key_att']; ?>()" id="myBtn_<?php echo $r['key_att']; ?>" class="nav-link  waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                             <div class="toolbar sprite-toolbar-waitinglist" style="margin-top: -6px;margin-left: -6px;" id="add" title="Add"></div>
                                                                      </a>


                                                                      


                                                                      <div class="dropdown-menu mailbox dropdown-menu-right scale-up" style="background-color:#f9f4ca;">
                                                                             <ul class="dropdown-user list-style-none">
                                                                                    <li>
                                                                                           <div class="dw-user-box p-3 d-flex">
                                                                                                  <div class="u-text ml-2" style="height: 195px;background-color: #f9f4ca;">
                                                                                                         <div class="card-body table-responsive p-0" style="width: 100vw;height: 30vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">
                                                                                                                <?php
                                                                                                                $sql = mysqli_query($connect, "SELECT a.attend_code,
                                                                                                                                     (CASE 
                                                                                                                                            WHEN a.attend_code=b.attend_code THEN 'checked=checked'
                                                                                                                                            ELSE ''
                                                                                                                                            END
                                                                                                                                     ) AS 'checked'
                                                                                                                                     FROM hrmttamattstatus a
                                                                                                                                     LEFT JOIN hrdattstatusdetail b ON b.attend_id='$r[attend_id]' AND a.attend_code=b.attend_code
                                                                                                                                     GROUP BY a.attend_code");
                                                                                                                while ($row_att = mysqli_fetch_array($sql)) {
                                                                                                                       echo '<input type="checkbox" ' . $row_att['checked'] . ' onchange="GFG_click_'.$r['key_att'].'(this.id)" id="neighborhood_id_' . $r['key_att'] . '" name="neighborhood_id_' . $r['key_att'] . '" value="' . $row_att['attend_code'] . '">' . $row_att['attend_code'] . '<br>';
                                                                                                                ?>
                                                                                                                
                                                                                                                <script>
                                                                                                                       function GFG_click_<?php echo $r['key_att']; ?>(clicked) {
                                                                                                                              $('#selected_attend_code_<?php echo $r['key_att']; ?>').val(
                                                                                                                                     $('[name=neighborhood_id_<?php echo $r['key_att']; ?>]:checked').map(function() {
                                                                                                                                            return $(this).val();
                                                                                                                                     }).get().join(',')
                                                                                                                              );
                                                                                                                              $('input[id="cek<?php echo $r['key_att']; ?>"]').prop('checked', true);
                                                                                                                       }         
                                                                                                                       </script> 
                                                                                                                <?php
                                                                                                                }
                                                                                                                ?>
                                                                                                         </div>
                                                                                                  </div>
                                                                                           </div>
                                                                                    </li>
                                                                             </ul>
                                                                      </div>
                                                               </li>
                                                        </td>
                                                 </tr>
                                          </table>
                                   </td>






















                                          <td> <input name="inp_remark_<?php echo $r['key_att']; ?>" id="inp_remark_<?php echo $r['key_att']; ?>" type="text" value="<?php echo $r['remark']; ?>" style="border: 1px solid #d9bfbf;font-size: 12px;width: 200px;padding: 4px;">
                                   </td>

                                      
                                  
                                   <td style="text-align:center;">
                                          <input type='checkbox' id="cek<?php echo $r['key_att']; ?>" name='update[]' value='<?php echo $r['key_att']; ?>'>
                                          <script>
                                                 $('#inp_remark_<?php echo $r['key_att']; ?> , #inp_hours_starttime_<?php echo $r['key_att']; ?> , #sel_shiftdaily_code_<?php echo $r['key_att']; ?>').change(function() {
                                                        $('input[id="cek<?php echo $r['key_att']; ?>"]').prop('checked', true);
                                                 });
                                          </script>
                                   </td>
                            </tr>

                            
                            <script>
                                   function myFunction_kodestart_<?php echo $r['key_att']; ?>() {

                                          var x = document.getElementById("sel_shiftdaily_code_<?php echo $r['key_att']; ?>")
                                                 .value;
                                          //  alert(x);

                                          $.ajax({
                                                 url: 'php_action/getData_Shiftdetail.php',
                                                 type: 'post',
                                                 data: {
                                                        shift_id: x
                                                 },
                                                 dataType: 'json',
                                                 success: function(response) {

                                                        document.getElementById("shiftstarttime_<?php echo $r['key_att']; ?>").innerHTML = response.shiftstarttime;
                                                        document.getElementById("shiftendtime_<?php echo $r['key_att']; ?>").innerHTML = response.shiftendtime;
                                                        $("#revised_request_no").val(response.shiftstarttime);
                                                 } // /success
                                          }); // /fetch selected member info
                                   }
                            </script>

                     <?php } ?>

                     <table style="width: 100%;text-align: right;">
                            <tr>
                                   <td><button class="btn btn-primary" type="submit" name="button_setattendance" id="button_setattendance" style="background: #cdcdcd;border: 1px solid transparent;font-size: 10px;border-radius: 33px;width: 103px;padding: 7px;margin-bottom: 6px;">
                                                 Confirm
                                          </button></td>
                            </tr>
                     </table>



                     <script type="text/javascript">
                            $(document).ready(function() {
                                   // Check/Uncheck ALl
                                   $('#checkAll').change(function() {
                                          if ($(this).is(':checked')) {
                                                 $('input[name="update[]"]').prop('checked', true);
                                          } else {
                                                 $('input[name="update[]"]').each(function() {
                                                        $(this).prop('checked', false);
                                                 });
                                          }

                                          var numberOfChecked = $('input:checkbox:checked').length;
                                          if (numberOfChecked > 0) {
                                                 $("#button_setattendance").show();
                                          } else {
                                                 $("#button_setattendance").hide();
                                          }
                                   });

                                   // Checkbox click
                                   $('input[name="update[]"]').click(function() {
                                          var total_checkboxes = $('input[name="update[]"]').length;
                                          var total_checkboxes_checked = $('input[name="update[]"]:checked').length;

                                          if (total_checkboxes_checked == total_checkboxes) {
                                                 $('#checkAll').prop('checked', true);
                                          } else {
                                                 $('#checkAll').prop('checked', false);
                                          }

                                          var numberOfChecked = $('input:checkbox:checked').length;
                                          if (numberOfChecked > 0) {
                                                 $("#button_setattendance").show();
                                          } else {
                                                 $("#button_setattendance").hide();
                                          }
                                   });
                            });
































                            $(document).ready(function() {
                                   $("#button_setattendance").on('click', function() {
                                          $("#FormAttendanceEdit").unbind('submit').bind('submit', function() {

                                                 var update = [];

                                                 $('input:checkbox[name^="update[]"]:checked').each(function(i) {
                                                        update[i] = $(this).val();
                                                 });



                                                 mymodalss.style.display = "block";

                                                 var form = $(this);

                                                 var employeee = $("#employeee").val();

                                                 var regex = /^[a-zA-Z]+$/;

                                                 if (update.length == 0) {

                                                        mymodalss.style.display = "none";
                                                        modals.style.display = "block";
                                                        document.getElementById("msg").innerHTML = "Pilih select at least one rows";
                                                        return false;

                                                 } else if (employeee == '') {
                                                        mymodalss.style.display = "none";
                                                        modals.style.display = "block";
                                                        document.getElementById("msg").innerHTML = "Invalid employee";
                                                        return false;

                                                 } else {
                                                        //submi the form to server
                                                        $.ajax({
                                                               url: "php_action/FuncDataAttendance.php<?php echo $getPackage; ?>",
                                                               type: form.attr('method'),
                                                               data: form.serialize(),
                                                               dataType: 'json',
                                                               success: function(response) {
                                                                      if (response.code == 'success_message_update') {

                                                                             mymodalss.style.display = "none";
                                                                             modals.style.display = "block";
                                                                             document.getElementById("msg").innerHTML = response.messages;

                                                                             attendance_list.style.display = "none";

                                                                             $(document).ready(function() {
                                                                                    $("#attendance_list").load("pages_relation/_pages_attendance.php?src_emp_no=<?php echo $src_emp_no; ?>&inp_add_startdate=<?php echo $src_startdate; ?>&inp_add_enddate=<?php echo $src_enddate; ?>", function(responseTxt, statusTxt, xhr) {
                                                                                           if (statusTxt == "success")
                                                                                                  attendance_list.style.display = "block";
                                                                                           mymodalss.style.display = "none";

                                                                                           if (statusTxt == "error")
                                                                                                  alert("Error: " + xhr.status + ": " + xhr.statusText);
                                                                                    });
                                                                             })


                                                                      } else {
                                                                             mymodalss.style.display = "none";
                                                                             modals.style.display = "block";
                                                                             document.getElementById("msg").innerHTML = response.messages;
                                                                      } // /else
                                                               } // /success
                                                        }); // /ajax		

                                                        return false;
                                                 }

                                          }); // /submit form for create member
                                   }); // /add modal
                            });
                     </script>

                     <style>
                            .fade-in-image {
                                   animation: fadeIn 0.5s;
                            }
                     </style>