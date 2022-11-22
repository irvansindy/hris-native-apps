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
              <div class="card-header d-flex align-items-center" style="background: linear-gradient(229deg, #4e595e54, #fff);">

                     <form name="myForm" action="" method="POST" id="FormDisplayCreate" onsubmit="return validateForm()">

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


              <fieldset id="fset_1_attendance_edit" style="display:none">
                     <legend>Attendance Detail</legend>
                     <div class="card-body table-responsive p-0" style="height: 50vh; width: 100%; overflow-y: scroll;overflow-x: hidden;border: 1px solid white;">
                            <div class="form-row">
                                   <div class="col-sm-12">
                                          <div class="fade-in-image" id="attendance_list"></div>
                                   </div>
                            </div>
                     </div>

              </fieldset>

            

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


































              <!-- isi JSON -->
              <script type="text/javascript">
                     // global the manage memeber table 
                     $(document).ready(function() {

                            $("#FormDisplayCreate").unbind('submit').bind('submit', function() {

                                   mymodalss.style.display = "block";

                                   $(".text-danger").remove();

                                   var form = $(this);

                                   var employee   = document.getElementById("employee").value;
                                   var myarr = employee.split(" ");
                                   var myvar = myarr[1];

                                   var inp_add_startdate = $("#inp_startdate").val();
                                   var inp_add_enddate = $("#inp_enddate").val();
                                   var from = new Date(inp_add_startdate).getTime();
                                   var to = new Date(inp_add_enddate).getTime();

                                  


                                   var regex = /^[a-zA-Z]+$/;

                                   if (from > to) {
                                          mymodalss.style.display = "none";
                                          modals.style.display = "block";
                                          document.getElementById("msg").innerHTML = "Entry Date: Enter Date in Proper Range";
                                          return false;

                                   } else if (employee == "") {
                                          mymodalss.style.display = "none";
                                          modals.style.display = "block";
                                          document.getElementById("msg").innerHTML = "Please select employee";
                                          return false;

                                   } else if (inp_add_startdate == "") {
                                          mymodalss.style.display = "none";
                                          modals.style.display = "block";
                                          document.getElementById("msg").innerHTML = "Please fill start date";
                                          return false;

                                   } else if (inp_add_enddate == "") {
                                          mymodalss.style.display = "none";
                                          modals.style.display = "block";
                                          document.getElementById("msg").innerHTML = "Please fill end date";
                                          return false;

                                   } else {

                                          fset_1_attendance_edit.style.display = "block";

                                          $(document).ready(function() {

                                                 attendance_list.style.display = "block";
                                                 
                                                 $("#attendance_list").load("pages_relation/_pages_attendance.php<?php echo $getPackage; ?>inp_add_startdate=" + inp_add_startdate + "&inp_add_enddate=" + inp_add_enddate + "&src_emp_no=" + myvar, function(responseTxt, statusTxt, xhr) {
                                                        if (statusTxt == "success")
                                                               mymodalss.style.display = "none";
                                                        if (statusTxt == "error")
                                                               alert("Error: " + xhr.status + ": " + xhr.statusText);
                                                 });
                                          })
                                          return false;
                                   }

                            }); // /submit form for create member
                     }); // /add modal
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