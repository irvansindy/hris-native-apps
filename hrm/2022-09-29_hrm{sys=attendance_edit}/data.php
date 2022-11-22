<?php
$src_emp_no_ori             = '';
$src_emp_no                 = '';
$src_enddate                = '';
$src_status                 = '';
$src_startdate              = '';

$datatable_style            = "display:none;";

if (!empty($_POST['employee'])) {
       $src_emp_no_ori      = $_POST['employee'];
       $src_emp_no          = trim(substr($_POST['employee'], 1, 7) , ' ');
       $src_startdate       = $_POST['inp_startdate'];
       $src_enddate         = $_POST['inp_enddate'];
       $src_status          = $_POST['src_status'];
       $datatable_style     = "";
       $frameworks          = "?src_emp_no=" . "" . $src_emp_no . "&src_startdate=" . "" . $src_startdate . "&src_enddate=" . "" . $src_enddate . "";
} else if (!empty($_POST['employeeR'])) {

       $src_emp_no_ori      = $_POST['employeeR'];
       $src_emp_no          = trim(substr($_POST['employeeR'], 1, 7) , ' ');
       $src_startdate       = $_POST['inp_startdate'];
       $src_enddate         = $_POST['inp_enddate'];
       $datatable_style     = "";
       $frameworks          = "?src_emp_no=" . "" . $src_emp_no . "&src_startdate=" . "" . $src_startdate . "&src_enddate=" . "" . $src_enddate . "";
} else {

       $src_emp_no_ori      = $_POST['employee'];
       $src_emp_no          = trim(substr($_POST['employee'], 1, 7) , ' ');
       $src_startdate       = $_POST['inp_startdate'];
       $src_enddate         = $_POST['inp_enddate'];
       $src_status          = $_POST['src_status'];
       $datatable_style     = "display:none;";
       $frameworks          = "?src_emp_no=" . "" . $src_emp_no . "&src_startdate=" . "" . $src_startdate . "&src_enddate=" . "" . $src_enddate . "";
}


include "../../model/ta/GMAttendanceEditList.php";
?>

<script>
       function validateForm() {
              var employee = document.forms["myForm"]["employee"].value;
              var inp_startdate = document.forms["myForm"]["inp_startdate"].value;
              var inp_enddate = document.forms["myForm"]["inp_enddate"].value;

              if (employee == "") {
                     alert("Employee must fill");
                     return false;
              } else if (inp_startdate == "") {
                     alert("Start date cannot empty");
                     return false;
              } else if (inp_enddate == "") {
                     alert("End date cannot empty");
                     return false;
              }
       }
</script>

<!-- MAIN DATATABLE SERVERSIDE CSS -->
<!-- MAIN DATATABLE SERVERSIDE CSS -->
<!-- <script type="text/javascript" src="../../asset/sdk_datatables_core/gt_dist/jQuery-2.1.4.min.js"></script>
<script type="text/javascript"
       src="../../asset/sdk_datatables_core/datatables/bedanihbuatjson/bootstrap/js/bootstrap.min.js"></script> -->
<!-- MAIN DATATABLE SERVERSIDE CSS -->
<!-- MAIN DATATABLE SERVERSIDE CSS -->

<!-- isi JSON -->
<!-- <script type="text/javascript">
       // global the manage memeber table 
       $(document).ready(function() {
              datatable = $("#datatable").DataTable({

                     dom: "B<'row'<'col-sm-12 col-md-9'l><'col-sm-12 col-md-9'f>>" +
                            "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-7'p>>",

                     processing: true,
                     // retrieve: true,
                     searching: false,
                     paging: false,
                     order: [
                            [0, "asc"]
                     ],
                     pagingType: "simple",
                     bPaginate: true,
                     bLengthChange: false,
                     bFilter: false,
                     bInfo: true,
                     bAutoWidth: true,
                     language: {
                            "processing": "Please wait..",
                     },
                     destroy: false
                     // "ajax": "php_action/FuncDataRead.php<php echo $frameworks; >"
              });
       });
       </script> -->

<style>
       body {
              font-family: calibri;
       }

       input[type=radio] {
              display: none;
       }

       input[type=radio]+label {
              display: inline-block;
              margin: -2px;
              padding: 4px 12px;
              margin-bottom: 0;
              font-size: 14px;
              line-height: 20px;
              color: #333;
              text-align: center;
              text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
              vertical-align: middle;
              cursor: pointer;
              background-color: #f5f5f5;
              background-image: -moz-linear-gradient(top, #fff, #e6e6e6);
              background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#fff), to(#e6e6e6));
              background-image: -webkit-linear-gradient(top, #fff, #e6e6e6);
              background-image: -o-linear-gradient(top, #fff, #e6e6e6);
              background-image: linear-gradient(to bottom, #fff, #e6e6e6);
              background-repeat: repeat-x;
              border: 1px solid #ccc;
              border-color: #e6e6e6 #e6e6e6 #bfbfbf;
              border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
              border-bottom-color: #b3b3b3;
              filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffffff', endColorstr='#ffe6e6e6', GradientType=0);
              filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
              -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
              -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
              box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
       }
</style>


<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>

<script type="text/javascript">
       $(document).ready(function() {
              $('#inp_startdate').bootstrapMaterialDatePicker({
                     time: false,
                     clearButton: true
              });

              $('#inp_enddate').bootstrapMaterialDatePicker({
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

<br>

<div class="col-md-12">
       <div class="card">
              <div class="card-header d-flex align-items-center">




                     <form name="myForm" action="" method="POST" onsubmit="return validateForm()">

                            <div class="form-row" style="width: 100%;margin-top: 14px;">
                                   <div class="col-sm-3" style="text-align: left;padding-top: 3px;padding-left: 12px;">
                                          <td>
                                                 Employee Name :
                                          </td>
                                   </div>
                                   <div class="col-sm-5">
                                          <div class="card-body table-responsive p-0" style="margin-bottom: 7px;margin-left: 2px;">
                                                 <td>
                                                        <a><img width="15px" src="../../asset/img/icon_user.png" style="margin-left: 5px;"></a>&nbsp;&nbsp;
                                                        <input type="text" autocomplete="off" onfocus="this.value=''" value="" style="font-size: 11px;border: 1px solid #aaa6a6;border-radius: 8px;height: 20px;padding-left: 10px;background: #1e88e521;" name="employee" id="employee" class="search-input">

                                                        <!-- <input type="text" name="inp_SpvUPManpower" id="inp_SpvUPManpower" style="width: 70%;font-size: 11px;border: 1px solid #aaa6a6;border-radius: 8px;height: 20px;padding-left: 10px;background: #1e88e521;" class="form-control" placeholder="Employee" />   -->
                                                        <div id="employeeList"></div>
                                                 </td>
                                          </div>
                                   </div>

                                   <div class="col-sm-2">
                                          <div class="card-body table-responsive p-0" style="overflow: scroll;overflow-x: hidden;">
                                                 <td>

                                                 </td>
                                          </div>
                                   </div>


                                   <div class="form-row" style="width: 100%;">
                                          <div class="col-sm-3" style="text-align: left;padding-top: 2px;">
                                                 <td>
                                                        Period :
                                                 </td>
                                          </div>

                                          <td>
                                                 From
                                          </td>

                                          <div class="col-sm-2">

                                                 <td>
                                                        <input type="text" id="inp_startdate" name="inp_startdate" class="input--style-6" style="
                                                                      background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                      background-size: 17px;
                                                                      background-position:right;   
                                                                      background-repeat:no-repeat; 
                                                                      padding-right:10px; 
                                                                      font-size: 11px;border: 1px solid #aaa6a6;border-radius: 8px;height: 20px;padding-left: 10px;background: #1e88e521;
                                                                      " />
                                                 </td>
                                          </div>

                                          <td>
                                                 To
                                          </td>

                                          <div class="col-sm-2">
                                                 <td>
                                                        <input type="text" id="inp_enddate" name="inp_enddate" class="input--style-6" style="
                                                                      background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                      background-size: 17px;
                                                                      background-position:right;   
                                                                      background-repeat:no-repeat; 
                                                                      padding-right:10px;
                                                                      font-size: 11px;border: 1px solid #aaa6a6;border-radius: 8px;height: 20px;padding-left: 10px;background: #1e88e521;  
                                                                      " />
                                                 </td>
                                          </div>
                                          <div class="col-sm-2">
                                                 <td>
                                                        <button type="submit" name="submit" style="width: 97px;margin-top: -5px;background: grey;border: 1px solid;" value="Upload" class="btn btn-rounded btn-warning btn-sm text-white d-inline-block">Search</button>
                                                 </td>
                                          </div>
                                   </div>
                            </div>
              </div>
              </form>

              <div class="card-body table-responsive p-0" style="width: 100vw;height: 78vh; width: 99.1%; margin: 5px;overflow: scroll;<?php echo $datatable_style; ?>">

                     <form name="myForm" onsubmit="return HrmsValidationForm()" method="post">


                            <label><?php echo $src_emp_no_ori; ?></label>
                            <table id="datatable" width="100%" class="table table-bordered table-striped table-hover table-head-fixed">
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
                                                               $sql = mysqli_query($connect, "SELECT shiftdailycode FROM HRMTTAMSHIFTDAILY");
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

<!--  
                                                                             <input type="radio" id="starttime1_in_<php echo $r['key_att']; ?>" name="starttime_in_<php echo $r['key_att']; ?>" value="<php echo $r['sfdayminone']; ?>" checked>
                                                                             <img src="../../asset/dist/img/calendar-icon.png" width="100px" style="width: 25px;">
                                                                             <label for="starttime1_in_<php echo $r['key_att']; ?>"><php echo $r['sdayminone']; ?></label>
                                                                             <input type="radio" id="starttime2_in_<php echo $r['key_att']; ?>" name="starttime_in_<php echo $r['key_att']; ?>" value="<php echo $r['sfdayone']; ?>" <php echo $r['sdayone_check']; ?>>
                                                                             <img src="../../asset/dist/img/calendar-icon.png" width="100px" style="width: 25px;">
                                                                             <label for="starttime2_in_<php echo $r['key_att']; ?>"><php echo $r['sdayone']; ?></label>
                                                                             <input type="radio" id="starttime3_in_<php echo $r['key_att']; ?>" name="starttime_in_<php echo $r['key_att']; ?>" value="<php echo $r['sfdayplusone']; ?>" <php echo $r['sdayplusone_check']; ?>>
                                                                             <img src="../../asset/dist/img/calendar-icon.png" width="100px" style="width: 25px;">
                                                                             <label for="starttime3_in_<php echo $r['key_att']; ?>"><php echo $r['sdayplusone']; ?></label>&nbsp;&nbsp; <label> -->
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


                                                                             <!-- <input type="radio" id="endtime1_out<php echo $r['key_att']; ?>" name="endtime_out_<php echo $r['key_att']; ?>" value="<php echo $r['sfdayminone']; ?>" <php echo $r['edayminone_check']; ?>>
                                                                             <img src="../../asset/dist/img/calendar-icon.png" width="100px" style="width: 25px;">
                                                                             <label for="endtime1_out<php echo $r['key_att']; ?>"><php echo $r['sdayminone']; ?></label>
                                                                             <input type="radio" id="endtime2_out<php echo $r['key_att']; ?>" name="endtime_out_<php echo $r['key_att']; ?>" value="<php echo $r['sfdayone']; ?>" <php echo $r['edayone_check']; ?>>
                                                                             <img src="../../asset/dist/img/calendar-icon.png" width="100px" style="width: 25px;">
                                                                             <label for="endtime2_out<php echo $r['key_att']; ?>"><php echo $r['sdayone']; ?></label>
                                                                             <input type="radio" id="endtime3_out<php echo $r['key_att']; ?>" name="endtime_out_<php echo $r['key_att']; ?>" value="<php echo $r['sfdayplusone']; ?>" <php echo $r['edayplusone_check']; ?>>
                                                                             <img src="../../asset/dist/img/calendar-icon.png" width="100px" style="width: 25px;">
                                                                             <label for="endtime3_out<php echo $r['key_att']; ?>"><php echo $r['sdayplusone']; ?></label>&nbsp;&nbsp;<label> -->
                                                                      </td>
                                                                      <td style="white-space: nowrap;border: 1px solid transparent;padding: 0;padding-left: 5px;">
                                                                             <input type="text" name="inp_hours_endtime_<?php echo $r['key_att']; ?>" id="inp_hours_endtime_<?php echo $r['key_att']; ?>" value="<?php echo $r['endtime']; ?>" style="border: 1px solid #d9bfbf;font-size: 12px;width: 70px;padding: 4px;"></label>
                                                                      </td>
                                                               </tr>
                                                        </table>
                                                 </td>


 <style type="text/css">
  label > input{ /* Menyembunyikan radio button */
          visibility: hidden; 
          position: absolute; 
        }
        label > input + img{ /* style gambar */
          cursor:pointer;
          border:2px solid transparent;
        }
        label > input:checked + img{ /* (RADIO CHECKED) style gambar */
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
                                                                                                                                     FROM HRMTTAMATTSTATUS a
                                                                                                                                     LEFT JOIN hrdattstatusdetail b ON b.attend_id='$r[attend_id]' AND a.attend_code=b.attend_code
                                                                                                                                     GROUP BY a.attend_code");
                                                                                                                              while ($row_att = mysqli_fetch_array($sql)) {
                                                                                                                                     echo '<input type="checkbox" ' . $row_att['checked'] . ' name="neighborhood_id_' . $r['key_att'] . '" value="' . $row_att['attend_code'] . '"> ' . $row_att['attend_code'] . '<br>';
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
























                                                        <div class="modal">
                                                               <div class="modal-dialog modal-belakang modal-med" role="document">
                                                                      <div class="modal-content">
                                                                             <div class="modal-header">
                                                                                    <h4 class="modal-title">Select Attend Code</h4>
                                                                                    <button type="button" class="close" id="close_<?php echo $r['key_att']; ?>" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                                                                           <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                             </div>
                                                                             <div class="modal-body">

                                                                                    <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

                                                                                           <fieldset id="fset_1">
                                                                                                  <legend>General</legend>

                                                                                                  <div class="container">
                                                                                                         <div id="disp_data"></div>
                                                                                                         <script>
                                                                                                                function myFunction_selected_<?php echo $r['key_att']; ?>() {

                                                                                                                       /// modal
                                                                                                                       var modal = document.getElementById("myModal_<?php echo $r['key_att']; ?>");
                                                                                                                       var btn = document.getElementById("myBtn_<?php echo $r['key_att']; ?>");
                                                                                                                       var span = document.getElementById("close_<?php echo $r['key_att']; ?>");
                                                                                                                       btn.onclick = function() {
                                                                                                                              modal.style.display = "block";
                                                                                                                       }
                                                                                                                       span.onclick = function() {
                                                                                                                              modal.style.display = "none";
                                                                                                                       }
                                                                                                                       window.onclick = function(event) {
                                                                                                                              if (event.target == modal) {
                                                                                                                                     modal.style.display = "none";
                                                                                                                              }
                                                                                                                       }

                                                                                                                       $('input[name=neighborhood_id_<?php echo $r['key_att']; ?>]').change(function() {
                                                                                                                              $('#selected_attend_code_<?php echo $r['key_att']; ?>').val(
                                                                                                                                     $('[name=neighborhood_id_<?php echo $r['key_att']; ?>]:checked').map(function() {
                                                                                                                                            return $(this).val();
                                                                                                                                     }).get().join(',./')
                                                                                                                              );
                                                                                                                       });
                                                                                                                }; // /fetch selected member info                   
                                                                                                         </script>
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

                            </table>
                            <div class="col-sm-12" style="text-align: right;">
                                   <button type="submit" id="but_update" name="but_update" style="width: 97px;margin-top: 5px;background: grey;border: 1px solid;" value="Upload" class="btn btn-rounded btn-warning btn-sm text-white d-inline-block">Submit</button>
                            </div>

                     </form>
              </div>

              <div class='card-footer' style='background-color: #eee;height: 37px;padding-top: 5px;'>
              </div>
       </div>
</div>





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
                            $("#but_update").show();
                     } else {
                            $("#but_update").hide();
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
                            $("#but_update").show();
                     } else {
                            $("#but_update").hide();
                     }
              });
       });




       $('#but_update').click(function() {
              if (confirm("Are you sure to process attendance?")) {
                     var update = [];

                     $('input:checkbox[name^="update[]"]:checked').each(function(i) {
                            update[i] = $(this).val();
                     });

                     if (update.length == 0) {
                            alert("Pilih select at least one rows");
                            return false;
                     } else {

                            // return true;
                            // setTimeout(function(){

                            // }, 3000);

                            setTimeout(function() {
                                   mymodalss.style.display = "none";
                                   document.getElementById("msg").innerHTML = "Data refreshed";
                                   return false;
                            }, 2000);



                            mymodalss.style.display = "block";

                            document.getElementById("msg").innerHTML = "Data refreshed";


                            return true;

                     }
              } else {
                     return false;
              }
       });
</script>

<?php
if (isset($_POST['but_update'])) {

       if (isset($_POST['update'])) {

              foreach ($_POST['update'] as $updateid) {

                     $inp_attend_id              = $_POST['inp_attend_id_' . $updateid]; // inp_attend_id_ATDDO1775330906202220220404144802
                     $emp_id_id                  = $_POST['emp_id_' . $updateid]; // emp_id_id_ATDDO1775330906202220220404144802
                     $sel_shiftdaily_code_id     = $_POST['sel_shiftdaily_code_' . $updateid]; // starttime_in_ATDDO1775330906202220220404144802
                     $starttime_in_id            = $_POST['starttime_in_' . $updateid]; // starttime_in_ATDDO1775330906202220220404144802
                     $endtime_in_id              = $_POST['endtime_out_' . $updateid]; // starttime_in_ATDDO1775330906202220220404144802
                     $inp_hours_starttime        = $_POST['inp_hours_starttime_' . $updateid]; // starttime_in_ATDDO1775330906202220220404144802
                     $inp_hours_endtime          = $_POST['inp_hours_endtime_' . $updateid]; // starttime_in_ATDDO1775330906202220220404144802
                     $inp_remark                 = $_POST['inp_remark_' . $updateid]; // remark_ATDDO1775330906202220220404144802
                     $inp_dateforcheck           = $_POST['inp_dateforcheck_' . $updateid]; // dateforcheck_ATDDO1775330906202220220404144802
                     $before                     = $_POST['before_' . $updateid]; // dateforcheck_ATDDO1775330906202220220404144802
                     $break                      = $_POST['break_' . $updateid]; // dateforcheck_ATDDO1775330906202220220404144802
                     $after                      = $_POST['after_' . $updateid]; // dateforcheck_ATDDO1775330906202220220404144802
                     $inp_overtime_relative      = $_POST['inp_overtime_relative_' . $updateid]; // inp_overtime_relative_ATDDO1775330906202220220404144802
                     $total_ot                   = $before + $break + $after;

                     $get_attendance_attend_id = $inp_attend_id;
                     $get_attendance_emp_id = $emp_id_id;
                     $get_attendance_dateforcheck = $inp_dateforcheck;
                     $get_attendance_shiftstarttime = $starttime_in_id;
                     $get_attendance_overtime_before = $before;
                     $get_attendance_overtime_break = $break;
                     $get_attendance_overtime_after = $after;
                     $get_attendance_relative = $inp_overtime_relative;

                     $delete = mysqli_query($connect, "DELETE FROM `hrdattstatusdetail` WHERE `attend_id` = '$inp_attend_id'");

                     include "../set{sys=system_function_authorization}/attendance_formula.php";

                     // include "../set{sys=system_function_authorization}/attendance_overtime.php";

                     ECHO $delete_process;

                     $get_attendance_starttime = $starttime_in_id . " " . $inp_hours_starttime . ":00";
                     if ($inp_hours_starttime == '00:00' || $inp_hours_starttime == '') {
                            $starttime = ",`starttime`            = NULL";
                            $insertstarttime = "NULL";
                     } else {
                            $starttime = ",`starttime`            = '$get_attendance_starttime'";
                            $insertstarttime = "'$get_attendance_starttime'";
                     }
                     $get_attendance_endtime = $endtime_in_id . " " . $inp_hours_endtime . ":00";
                     if ($inp_hours_endtime == '00:00' || $inp_hours_endtime == '') {
                            $endtime = ",`endtime`            = NULL";
                            $insertendtime = "NULL";
                     } else {
                            $endtime = ",`endtime`            = '$get_attendance_endtime'";
                            $insertendtime = "'$get_attendance_endtime'";
                     }

                     $sql_shift = "SELECT 
                                                                             (CASE 
                                                                                    WHEN (SELECT DATE(hrmholiday.start_date) FROM hrmholiday WHERE DATE(hrmholiday.start_date) = '$inp_dateforcheck' AND hrmholiday.is_recur = '0') = '$inp_dateforcheck' THEN CONCAT('PH' , HRMTTAMSHIFTDAILY.daytype)
                                                                                    WHEN (SELECT 
                                                                                           DATE_FORMAT(hrmholiday.start_date, '%m-%d') 
                                                                                           FROM hrmholiday
                                                                                           WHERE DATE_FORMAT(hrmholiday.start_date, '%m-%d') = DATE_FORMAT('$inp_dateforcheck', '%m-%d')
                                                                                           AND hrmholiday.is_recur = '1'
                                                                                    ) =  DATE_FORMAT('$inp_dateforcheck', '%m-%d')
                                                                                    THEN HRMTTAMSHIFTDAILY.overtimecode_ph
                                                                                    ELSE HRMTTAMSHIFTDAILY.overtimecode
                                                                                    END
                                                                             ) AS 'overtimecode',
                                                                             CONCAT('$inp_dateforcheck', TIME_FORMAT(HRMTTAMSHIFTDAILY.starttime, ' %H:%i:%s')) AS starttime, 
                                                                             CASE 
                                                                             WHEN HRMTTAMSHIFTDAILY.shiftdailycode  LIKE 'S3%' THEN CONCAT(DATE_ADD('$inp_dateforcheck', INTERVAL 1 DAY), TIME_FORMAT(HRMTTAMSHIFTDAILY.endtime, ' %H:%i:%s'))
                                                                             ELSE CONCAT('$inp_dateforcheck', TIME_FORMAT(HRMTTAMSHIFTDAILY.endtime, ' %H:%i:%s'))
                                                                             END AS endtime,
                                                                             (CASE 
                                                                                    WHEN (SELECT DATE(hrmholiday.start_date) FROM hrmholiday WHERE DATE(hrmholiday.start_date) = '$inp_dateforcheck' AND hrmholiday.is_recur = '0') = '$inp_dateforcheck' THEN CONCAT('PH' , HRMTTAMSHIFTDAILY.daytype)
                                                                                    WHEN (SELECT 
                                                                                           DATE_FORMAT(hrmholiday.start_date, '%m-%d') 
                                                                                           FROM hrmholiday
                                                                                           WHERE DATE_FORMAT(hrmholiday.start_date, '%m-%d') = DATE_FORMAT('$inp_dateforcheck', '%m-%d')
                                                                                           AND hrmholiday.is_recur = '1'
                                                                                    ) =  DATE_FORMAT('$inp_dateforcheck', '%m-%d')
                                                                                    THEN CONCAT('PH' , HRMTTAMSHIFTDAILY.daytype)
                                                                                    ELSE HRMTTAMSHIFTDAILY.daytype
                                                                                    END
                                                                             ) AS 'daytype'
                                                                       FROM HRMTTAMSHIFTDAILY 
                                                                       WHERE HRMTTAMSHIFTDAILY.shiftdailycode = '$sel_shiftdaily_code_id'";

                     $sql_shiftschedule = mysqli_fetch_array(mysqli_query($connect, $sql_shift));

                     $str_arr = explode(",", $string);

                     $sql_att_edit = "INSERT INTO `hrdattendance` 
                                                 (
                                                        `attend_id` 
                                                        ,`emp_id` 
                                                        ,`attend_date` 
                                                        ,`shiftdaily_code` 
                                                        ,`company_id` 
                                                        ,`shiftstarttime` 
                                                        ,`shiftendtime` 
                                                        ,`attend_code` 
                                                        ,`starttime` 
                                                        ,`endtime` 
                                                        ,`actual_in` 
                                                        ,`actual_out`
                                                        ,`daytype`
                                                        ,`ip_starttime` 
                                                        ,`ip_endtime`
                                                        ,`remark`
                                                        ,`default_shift`
                                                        ,`total_ot`
                                                        ,`total_otindex`
                                                        ,`overtime_code` 
                                                        ,`created_date` 
                                                        ,`created_by`
                                                        ,`modified_date`
                                                        ,`modified_by` 
                                                        ,`flexibleshift`
                                                        ,`auto_ovt`
                                                        ,`actualworkmnt`
                                                        ,`premicheck`
                                                        ,`dateforcheck`
                                                        ,`shiftgroupcode`
                                                        ,`geolocation` 
                                                        ,`photo_start` 
                                                        ,`photo_end` 
                                                        ,`geoloc_start` 
                                                        ,`geoloc_end` 
                                                        ,`att_flag_start` 
                                                        ,`att_flag_end` 
                                                        ,`distance_start` 
                                                        ,`distance_end` 
                                                        ,`totalot_rounddown` 
                                                        ,`check`
                                                        ,`check2`
                                                 ) VALUES (
                                                        '$inp_attend_id' 
                                                        ,'$emp_id_id' 
                                                        ,'$starttime_in_id' 
                                                        ,'$sel_shiftdaily_code_id' 
                                                        ,'op'
                                                        ,'$sql_shiftschedule[starttime]' 
                                                        ,'$sql_shiftschedule[endtime]' 
                                                        ,'po'
                                                        ,$insertstarttime
                                                        ,$insertendtime
                                                        ,'op' 
                                                        ,'op'
                                                        ,'op'
                                                        ,'$sql_shiftschedule[daytype]'
                                                        ,'po'
                                                        ,'$inp_remark'
                                                        ,'po'
                                                        ,'po'
                                                        ,'pop' 
                                                        ,'$sql_shiftschedule[overtimecode]'
                                                        ,'2022-06-08 12:48:43' 
                                                        ,'o'
                                                        ,'2022-06-08 12:48:43' 
                                                        ,'op'
                                                        ,'op' 
                                                        ,'opo'
                                                        ,'po' 
                                                        ,'po'
                                                        ,'$inp_dateforcheck'
                                                        ,'pop' 
                                                        ,'o' 
                                                        ,'po'
                                                        ,'po' 
                                                        ,'p' 
                                                        ,'op' 
                                                        ,'op' 
                                                        ,'op' 
                                                        ,'op' 
                                                        ,'op' 
                                                        ,'op' 
                                                        ,'op' 
                                                        ,'$starttime_in_id'

                                                 ) ON DUPLICATE KEY UPDATE
                                                 
                                                 `attend_id`          = '$inp_attend_id'
                                                 ,`shiftdaily_code`   = '$sel_shiftdaily_code_id'
                                                 ,`shiftstarttime`    = '$sql_shiftschedule[starttime]'
                                                 ,`shiftendtime`      = '$sql_shiftschedule[endtime]'
                                                 ,`daytype`           = '$sql_shiftschedule[daytype]'
                                                 ,`overtime_code`     = '$sql_shiftschedule[overtimecode]'
                                                 ,`remark`            = '$inp_remark Attendance Edit ~ Update'
                                                 $starttime
                                                 $endtime";

                     $process = mysqli_query($connect, $sql_att_edit);

                     if ($process) {

                            $delete = mysqli_query($connect, "DELETE FROM `hrdattstatusdetail` WHERE `attend_id` = '$inp_attend_id'");

                            include "../set{sys=system_function_authorization}/attendance_formula.php";

                            // include "../set{sys=system_function_authorization}/attendance_overtime.php";

                            foreach ($_POST['update'] as $updateid) {
                                   $inp_attend_id               = $_POST['inp_attend_id_' . $updateid];
                                   $emp_id_id                   = $_POST['emp_id_' . $updateid];
                                   $selected_att_id             = $_POST['selected_attend_code_' . $updateid];
                                   $inp_dateforcheck            = $_POST['inp_dateforcheck_' . $updateid]; // dateforcheck_ATDDO1775330906202220220404144802

                                   $var = explode(",", $selected_att_id);

                                   foreach ($var as $value) {

                                          // if($value  != '') {

                                          $syu = "INSERT IGNORE INTO `hrdattstatusdetail` 
                                                                             (
                                                                                    `attend_id`, 
                                                                                    `emp_id`, 
                                                                                    `attend_date`, 
                                                                                    `company_id`,
                                                                                    `attend_code`, 
                                                                                    `created_by`,
                                                                                    `created_date`, 
                                                                                    `modified_by`, 
                                                                                    `modified_date`
                                                                             ) VALUES 
                                                                                    (
                                                                                           '$inp_attend_id', 
                                                                                           '$emp_id_id', 
                                                                                           '$inp_dateforcheck', 
                                                                                           '13576', 
                                                                                           '$value', 
                                                                                           '$username',
                                                                                           '$SFdatetime',
                                                                                           '$username', 
                                                                                           '$SFdatetime'
                                                                                    )";

                                          $sql_1 = mysqli_query($connect, "INSERT IGNORE INTO `hrdattstatusdetail` 
                                                                             (
                                                                                    `attend_id`, 
                                                                                    `emp_id`, 
                                                                                    `attend_date`, 
                                                                                    `company_id`,
                                                                                    `attend_code`, 
                                                                                    `created_by`,
                                                                                    `created_date`, 
                                                                                    `modified_by`, 
                                                                                    `modified_date`
                                                                             ) VALUES 
                                                                                    (
                                                                                           '$inp_attend_id', 
                                                                                           '$emp_id_id', 
                                                                                           '$inp_dateforcheck', 
                                                                                           '13576', 
                                                                                           '$value', 
                                                                                           '$username',
                                                                                           '$SFdatetime',
                                                                                           '$username', 
                                                                                           '$SFdatetime'
                                                                                    )");

                                      

                                                 $delete = mysqli_query($connect, "DELETE FROM `hrdattstatusdetail` WHERE `attend_id` = '$inp_attend_id' AND `attend_code` = ''");

                                                 include "../set{sys=system_function_authorization}/attendance_formula.php";

                                                 // include "../set{sys=system_function_authorization}/attendance_overtime.php";

                                   }
                            }

                            echo "<script type='text/javascript'>
                                          jQuery(function(){           
                                          $.redirect('../hrm{sys=attendance_edit}/', 
                                                 {
                                                        employee: '$src_emp_no_ori',
                                                        inp_startdate: '$src_startdate',
                                                        inp_enddate: '$src_enddate',
                                                        filtered: '$SFtime_current',
                                                 },
                                                 'POST',
                                                 '_self');
                                          });
                                   </script>";
                     } else {
                            return false;
                     }
              }
       }
}
?>




<script>
       function RefreshPage() {
              datatable.ajax.reload(null, true);

              setTimeout(function() {
                     mymodalss.style.display = "none";
                     document.getElementById("msg").innerHTML = "Data refreshed";
                     return false;
              }, 2000);

              mymodalss.style.display = "block";
              document.getElementById("msg").innerHTML = "Data refreshed";
              return false;
       }
</script>

<script>
       function ResetTable() {
              $("#tbl_posts > tbody > .reset-delete-record").html("");
              $("#tbl_posts_second > tbody > .reset-delete-record").html("");

              for (let i = 2; i < 100; i++) {
                     jQuery('#rec-' + [i]).remove();
                     jQuery('#recs-' + [i]).remove();
              }
       }
</script>









































<!-- isi JSON -->
<script type="text/javascript">
       function editMember(id = null) {
              if (id) {
                     // remove the error 
                     $(".form-group").removeClass('has-error').removeClass('has-success');
                     $(".text-danger").remove();
                     // empty the message div
                     $(".messages_update").html("");

                     // remove the id
                     $("#member_id").remove();

                     // fetch the member data
                     $.ajax({
                            url: 'php_action/getSelectedEmployee.php',
                            type: 'post',
                            data: {
                                   member_id: id
                            },
                            dataType: 'json',


                            success: function(response) {

                                   document.getElementById("sel_emp_no").innerHTML = response.emp_no;
                                   document.getElementById("sel_emp_name").innerHTML = response.Full_Name;

                                   $("#CreateButton").attr("onclick", "addMember(`" + response.emp_id +
                                          "`)");

                                   $("#sel_emp_no").val(response.emp_no);

                                   var sel_emp_id = response.emp_id;

                                   $("#box").load("pages_relation/_pages_shiftgroup_code?rfid=" +
                                          sel_emp_id,
                                          function(responseTxt, statusTxt, jqXHR) {
                                                 if (statusTxt == "success") {
                                                        $("#box").show();
                                                 }
                                                 if (statusTxt == "error") {
                                                        alert("Error: " + jqXHR.status + " " +
                                                               jqXHR.statusText);
                                                 }
                                          }
                                   );


                                   // here update the member data
                                   $("#FormDisplayUpdate").unbind('submit').bind('submit', function() {
                                          // remove error messages
                                          $(".text-danger").remove();

                                          var form = $(this);

                                          var sel_overtime_code = $("#sel_overtime_code")
                                                 .val();
                                          var sel_overtime_minimum = $(
                                                 "#sel_overtime_minimum").val();
                                          var sel_ovtcalctype = $("#sel_ovtcalctype").val();
                                          var sel_otrounding = $("#sel_otrounding").val();
                                          var sel_otroundlimit = $("#sel_otroundlimit")
                                                 .val();
                                          var sel_otachieved = $("#sel_otachieved").val();
                                          var lbl_sel_otdeucted = $("#lbl_sel_otdeucted")
                                                 .val();
                                          var sel_ovtcalctype = $("#sel_ovtcalctype").val();
                                          var sel_emp_no = $("#sel_emp_no").val();
                                          var sel_token = $("#sel_token").val();
                                          var FactorHour = [];
                                          var FactorValue = [];

                                          var SelOTtypeother = [];
                                          var SelOTminutes = [];
                                          var SelOTmeal = [];
                                          var SelOTtransport = [];

                                          var regex = /^[a-zA-Z]+$/;

                                          if (sel_overtime_code == "") {
                                                 modals.style.display = "block";
                                                 document.getElementById("msg").innerHTML =
                                                        "Overtime code cannot empty";

                                          } else if (sel_overtime_minimum == "") {
                                                 modals.style.display = "block";
                                                 document.getElementById("msg").innerHTML =
                                                        "Overtime minimum cannot empty";

                                          } else if (sel_overtime_minimum.match(regex)) {
                                                 modals.style.display = "block";
                                                 document.getElementById("msg").innerHTML =
                                                        "Please enter valid number";

                                          } else if (sel_ovtcalctype == "") {
                                                 modals.style.display = "block";
                                                 document.getElementById("msg").innerHTML =
                                                        "Overtime calctype";

                                          } else if (sel_otrounding == "") {
                                                 modals.style.display = "block";
                                                 document.getElementById("msg").innerHTML =
                                                        "Overtime rounding";

                                          } else if (sel_otroundlimit == "") {
                                                 modals.style.display = "block";
                                                 document.getElementById("msg").innerHTML =
                                                        "Overtime rounding limit";


                                          } else {
                                                 $('#submit_update').hide();
                                                 $('#submit_update2').show();
                                          }




                                          if (sel_overtime_code && sel_overtime_minimum &&
                                                 sel_ovtcalctype && sel_otrounding &&
                                                 sel_otroundlimit) {

                                                 $.ajax({

                                                        url: form.attr(
                                                               'action'
                                                        ),
                                                        type: form.attr(
                                                               'method'
                                                        ),
                                                        // data: form.serialize(),

                                                        data: new FormData(
                                                               this),
                                                        processData: false,
                                                        contentType: false,

                                                        dataType: 'json',
                                                        success: function(
                                                               response
                                                        ) {

                                                               if (response
                                                                      .code ==
                                                                      'success_message'
                                                               ) {
                                                                      modals.style
                                                                             .display =
                                                                             "block";
                                                                      document
                                                                             .getElementById(
                                                                                    "msg"
                                                                             )
                                                                             .innerHTML =
                                                                             response
                                                                             .messages;

                                                                      $("#tbl_posts_third > tbody > .reset-delete-record")
                                                                             .html(
                                                                                    "");
                                                                      $("#tbl_posts_four > tbody > .reset-delete-record")
                                                                             .html(
                                                                                    "");

                                                                      $('#submit_update')
                                                                             .show();
                                                                      $('#submit_update2')
                                                                             .hide();

                                                                      $('#FormDisplayUpdate')
                                                                             .modal(
                                                                                    'hide');
                                                                      $("[data-dismiss=modal]")
                                                                             .trigger({
                                                                                    type: "click"
                                                                             });

                                                                      // reload the datatables
                                                                      datatable
                                                                             .ajax
                                                                             .reload(
                                                                                    null,
                                                                                    false
                                                                             );
                                                                      // reload the datatables

                                                               } else {
                                                                      modals.style
                                                                             .display =
                                                                             "block";
                                                                      document
                                                                             .getElementById(
                                                                                    "msg"
                                                                             )
                                                                             .innerHTML =
                                                                             response
                                                                             .messages;
                                                               }
                                                        } // /success
                                                 }); // /ajax
                                          } // /if
                                          return false;
                                   });
                            } // /success
                     }); // /fetch selected member info
              } else {
                     alert("Error : Refresh the page again");
              }
       }




























       function addMember(id = null) {
              if (id) {
                     // remove the error
                     $(".form-group").removeClass('has-error').removeClass('has-success');
                     $(".text-danger").remove();
                     // empty the message div
                     $(".messages_update").html("");

                     // remove the id
                     $("#member_id").remove();

                     // fetch the member data
                     $.ajax({
                            url: 'php_action/getSelectedEmployee.php',
                            type: 'post',
                            data: {
                                   member_id: id
                            },
                            dataType: 'json',

                            success: function(response) {
                                   $("#inp_emp_id").val(response.emp_id);

                                   var sel_emp_id = response.emp_id;

                                   // here update the member data
                                   $("#FormDisplayCreate").unbind('submit').bind('submit', function() {
                                          // remove error messages
                                          $(".text-danger").remove();

                                          var form = $(this);

                                          var inp_emp_id = $("#inp_emp_id").val();
                                          var inp_shiftstartdate = $("#inp_shiftstartdate")
                                                 .val();
                                          var inp_shiftgroupcode = $("#inp_shiftgroupcode")
                                                 .val();

                                          var regex = /^[a-zA-Z]+$/;

                                          var getSelectedValue = document.querySelector(
                                                 'input[name="inp_shiftgroupcode"]:checked'
                                          );

                                          if (inp_shiftstartdate == "") {
                                                 modals.style.display = "block";
                                                 document.getElementById("msg").innerHTML =
                                                        "Shift start cannot empty";
                                                 return false;

                                          } else if (getSelectedValue == null) {

                                                 modals.style.display = "block";
                                                 document.getElementById("msg").innerHTML =
                                                        "Please select shiftgroup";
                                                 return false;

                                          } else {

                                                 $('#submit_add').hide();
                                                 $('#submit_add2').show();

                                          }


                                          if (inp_shiftstartdate && getSelectedValue) {

                                                 $.ajax({

                                                        url: form.attr(
                                                               'action'
                                                        ),
                                                        type: form.attr(
                                                               'method'
                                                        ),
                                                        // data: form.serialize(),

                                                        data: new FormData(
                                                               this),
                                                        processData: false,
                                                        contentType: false,

                                                        dataType: 'json',
                                                        success: function(
                                                               response
                                                        ) {

                                                               if (response
                                                                      .code ==
                                                                      'success_message'
                                                               ) {
                                                                      modals.style
                                                                             .display =
                                                                             "block";
                                                                      document
                                                                             .getElementById(
                                                                                    "msg"
                                                                             )
                                                                             .innerHTML =
                                                                             response
                                                                             .messages;

                                                                      $('#submit_add')
                                                                             .show();
                                                                      $('#submit_add2')
                                                                             .hide();

                                                                      $('#FormDisplayUpdate')
                                                                             .modal(
                                                                                    'hide');
                                                                      $("[data-dismiss=modal]")
                                                                             .trigger({
                                                                                    type: "click"
                                                                             });

                                                                      // reload the datatables
                                                                      datatable
                                                                             .ajax
                                                                             .reload(
                                                                                    null,
                                                                                    false
                                                                             );
                                                                      // reload the datatables

                                                               } else {
                                                                      modals.style
                                                                             .display =
                                                                             "block";
                                                                      document
                                                                             .getElementById(
                                                                                    "msg"
                                                                             )
                                                                             .innerHTML =
                                                                             response
                                                                             .messages;

                                                                      $('#submit_add')
                                                                             .show();
                                                                      $('#submit_add2')
                                                                             .hide();
                                                               }
                                                        } // /success
                                                 }); // /ajax
                                          } // /if
                                          return false;
                                   });
                            } // /success
                     }); // /fetch selected member info
              } else {
                     alert("Error : Refresh the page again");
              }
       }
























       function editdelMember(id = null) {
              if (id) {

                     // remove the error 
                     $(".form-group").removeClass('has-error').removeClass('has-success');
                     $(".text-danger").remove();
                     // empty the message div
                     $(".edit-messages").html("");

                     // remove the id
                     $("#member_id").remove();

                     // fetch the member data
                     $.ajax({
                            url: 'php_action/getSelectedEmployee.php',
                            type: 'post',
                            data: {
                                   member_id: id
                            },
                            dataType: 'json',
                            success: function(response) {

                                   $("#sel_overtime_codes").val(response.overtime_code);

                                   // mmeber id 
                                   $(".FormDisplayDelete").append(
                                          '<input type="hidden" name="member_id" id="member_id" value="' +
                                          response.id + '"/>');

                                   // here update the member data
                                   $("#updatedelMemberForm").unbind('submit').bind('submit', function() {
                                          // remove error messages
                                          $(".text-danger").remove();

                                          var form = $(this);

                                          // validation

                                          var sel_overtime_codes = $("#sel_overtime_codes")
                                                 .val();



                                          if (sel_overtime_codes == "") {
                                                 $("#sel_overtime_codes").closest(
                                                        '.form-group').addClass(
                                                        'has-error');
                                                 $("#sel_overtime_codes").after(
                                                        '<p class="text-danger">The Name field is required</p>'
                                                 );
                                          } else {
                                                 $('#submit_delete').hide();
                                                 $('#submit_delete2').show();
                                          }





                                          if (sel_overtime_codes) {
                                                 $.ajax({
                                                        url: form.attr(
                                                               'action'
                                                        ),
                                                        type: form.attr(
                                                               'method'
                                                        ),
                                                        data: form
                                                               .serialize(),
                                                        dataType: 'json',
                                                        success: function(
                                                               response
                                                        ) {
                                                               if (response
                                                                      .code ==
                                                                      'success_message'
                                                               ) {
                                                                      modals.style
                                                                             .display =
                                                                             "block";
                                                                      document
                                                                             .getElementById(
                                                                                    "msg"
                                                                             )
                                                                             .innerHTML =
                                                                             response
                                                                             .messages;

                                                                      $('#submit_delete')
                                                                             .show();
                                                                      $('#submit_delete2')
                                                                             .hide();

                                                                      $('#FormDisplayDelete')
                                                                             .modal(
                                                                                    'hide');
                                                                      $("[data-dismiss=modal]")
                                                                             .trigger({
                                                                                    type: "click"
                                                                             });


                                                                      // reload the datatables
                                                                      datatable
                                                                             .ajax
                                                                             .reload(
                                                                                    null,
                                                                                    false
                                                                             );
                                                                      // reload the datatables

                                                               } else {
                                                                      modals.style
                                                                             .display =
                                                                             "block";
                                                                      document
                                                                             .getElementById(
                                                                                    "msg"
                                                                             )
                                                                             .innerHTML =
                                                                             response
                                                                             .messages;
                                                                      // reload the datatables
                                                               }
                                                        } // /success
                                                 }); // /ajax
                                          } // /if

                                          return false;
                                   });

                            } // /success
                     }); // /fetch selected member info

              } else {
                     alert("Error : Refresh the page again");
              }
       }
</script>
<!-- isi JSONs -->
</body>

</html>




<script type="text/javascript">
       $(document).ready(function() {
              $('#inp_shiftstartdate').bootstrapMaterialDatePicker({
                     time: false,
                     clearButton: true
              });
       });
</script>



<script src="js/jquery.min.js"></script>

<script>
       $(document).ready(function() {
              $('#employee').focus(function() {
                     var query = $(this).val();
                     if (query != '') {
                            $.ajax({
                                   url: "search.php?userid=<?php echo $username; ?>",
                                   method: "POST",
                                   data: {
                                          query: query
                                   },
                                   success: function(data) {
                                          $('#employeeList').fadeIn();
                                          $('#employeeList').html(data);
                                   }
                            });
                     }
              });
              $('#employee').keyup(function() {
                     var query = $(this).val();
                     if (query != '') {
                            $.ajax({
                                   url: "search.php?userid=<?php echo $username; ?>",
                                   method: "POST",
                                   data: {
                                          query: query
                                   },
                                   success: function(data) {
                                          $('#employeeList').fadeIn();
                                          $('#employeeList').html(data);
                                   }
                            });
                     }
              });

              $('#employee').mouseover(function() {
                     $('#employeeList').fadeOut();
              });

              $(document).on('click', 'li', function() {
                     $('#employee').val($(this).text());
                     $('#employeeList').fadeOut();

                     var emps = document.getElementById("employee").value;

                     var myarr = emps.split(" ");

                     var myvar = myarr[1];
                     var myvar2 = myarr[2];

                     //     // Show the resulting value
                     console.log(myvar2);


                     $("#inp_careerhistory").val(myvar);
                     $("#inp_empperformance").val(myvar2);

                     //     alert(emps);
                     $.ajax({
                            url: 'php_action/getCareer.php',
                            type: 'post',
                            data: {
                                   employee: emps
                            },
                            dataType: 'json',
                            success: function(response_career) {

                                   var fill_is_approved_spvdown =
                                          response_career.emp_no;
                                   var career = response_career.history_no +
                                          '-' + response_career.secon;

                                   // alert(career);
                            }
                     }); // /ajax

              });
       });
</script>


<script>
       $(document).ready(function() {
              $('#employeeSpectator').focus(function() {
                     var query = $(this).val();
                     if (query != '') {
                            $.ajax({
                                   url: "search.php?userid=<?php echo $username; ?>",
                                   method: "POST",
                                   data: {
                                          query: query
                                   },
                                   success: function(data) {
                                          $('#employeeListSpectator')
                                                 .fadeIn();
                                          $('#employeeListSpectator').html(
                                                 data);
                                   }
                            });
                     }
              });
              $('#employeeSpectator').keyup(function() {
                     var query = $(this).val();
                     if (query != '') {
                            $.ajax({
                                   url: "search.php?userid=<?php echo $username; ?>",
                                   method: "POST",
                                   data: {
                                          query: query
                                   },
                                   success: function(data) {
                                          $('#employeeListSpectator')
                                                 .fadeIn();
                                          $('#employeeListSpectator').html(
                                                 data);
                                   }
                            });
                     }
              });

              $('#employeeSpectator').mouseover(function() {
                     $('#employeeListSpectator').fadeOut();
              });

              $(document).on('click', 'li', function() {
                     $('#employeeSpectator').val($(this).text());
                     $('#employeeListSpectator').fadeOut();

                     var emps = document.getElementById("employeeSpectator").value;

                     var myarr = emps.split(" ");

                     var myvar = myarr[1];
                     var myvar2 = myarr[2];

                     //     // Show the resulting value
                     console.log(myvar2);


                     $("#inp_careerhistory").val(myvar);
                     $("#inp_empperformance").val(myvar2);




                     //     alert(emps);

                     $.ajax({
                            url: 'php_action/getCareer.php',
                            type: 'post',
                            data: {
                                   employee: emps
                            },
                            dataType: 'json',
                            success: function(response_career) {

                                   var fill_is_approved_spvdown =
                                          response_career.emp_no;
                                   var career = response_career.history_no +
                                          '-' + response_career.secon;

                                   // alert(career);
                            }
                     }); // /ajax

              });
       });
</script>
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
                            $("#but_update").show();
                     } else {
                            $("#but_update").hide();
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
                            $("#but_update").show();
                     } else {
                            $("#but_update").hide();
                     }
              });
       });
</script>