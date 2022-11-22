<?php
include "../../application/config.php";
$username = $_GET['userid'];
?>

<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>

<!-- AgusPrass 09 Maret 2021 -->

<!-- Menampilkan data request -->
<?php
       $emp = $_POST['id']; //Mengambil data req no dari tabel

       $datareq = mysqli_query($connect,"SELECT a.*,b.Full_Name FROM hrdattendance a
       LEFT JOIN view_employee b on a.emp_id=b.emp_id
       WHERE a.attend_id='$emp' LIMIT 1"); // Query untuk mengambil dari leave request
       
       while($row1=mysqli_fetch_array($datareq)){


?>

<style> 
            .gfg {
                width:auto;
                text-align:center;
         
            }
            img {
                
            }
        </style>

<div class="modal-dialog modal-med">
       <div class="modal-content" style="background: #f2f0f0;">
            <div class="modal-header" style="background-color: rgb(81, 191, 240);color: rgb(255, 253, 253);border-bottom: solid 3px rgb(40, 176, 238);height: 50px;padding: 15px;font-size: 8px;">
                     <h4 class="modal-title" style="font-size: 14px;">Time & Attendance > Attendance Attachment</h4>
                     <div class="toolbar sprite-toolbar-close" aria-label="Close" onclick="return stopload()" data-dismiss="modal" id="SEARCH" title="Search"></div>
            </div>
              
              <!--<div class="modal-header">-->
              <!--       <h4 class="modal-title">Attendance Attachment</h4>-->
              <!--       <div class="toolbar sprite-toolbar-close" aria-label="Close" onclick='return stopload()' data-dismiss="modal" id="SEARCH"-->
              <!--                                                        title="Search"></div>-->
              <!--</div>-->
              <form name='form1' method="post" id="multiple_upload_form" enctype="multipart/form-data"
                     onsubmit='return HrmsValidationForm()'>
                     <fieldset id="fset_1">
                            <legend>Attachment Information</legend>

                         
                            
                            <div class="form-row">
                                   <div class="col-4 name">Employee </div>
                                   <div class = "gfg">
                                       [ <?php echo $row1['emp_id'];?> ] <?php echo $row1['Full_Name'];?>
                                       
                                 
                                   </div>
                            </div>

                         
                            <?php

                            $photo1 = $row1['photo_start'];
                            $photo2 = $row1['photo_end'];

                            if($photo1 == ''){
                                   $photo1_a = 'no-image-post.png';
                            } else {
                                   $photo1_a = $row1['photo_start'];
                            }

                            if($photo2 == ''){
                                   $photo2_a = 'no-image-post.png';
                            } else {
                                   $photo2_a = $row1['photo_end'];
                            }

                            ?>

                            <div class="form-row">
                                   <div class="col-4 name">Photos Start</div>
                                   <div class = "gfg">
                                       <?php echo $row1['starttime'];?>
                                       
                                   <p id="my-image">
                                       <img src="../../API/uploads/<?php echo $photo1_a;?>" alt="no photos in" class="profile-pic rounded-circle" width="50" height="50">
                                   </p>
                                   </div>
                            </div>

                            <div class="form-row">
                                   <div class="col-4 name">Photos End</div>
                                   <div class = "gfg">
                                       <?php echo $row1['endtime'];?>
                                   <p id="my-image">
                                   
                                    <img src="../../API/uploads/<?php echo $photo2_a;?>" alt="no photos out" class="profile-pic rounded-circle" width="50" height="50">
                                   </p>
                                   </div>
                            </div>

                            
</fieldset>

                           


                            <!--        <tr>-->
                            <!--       <td colspan="3" align="right" width="100%">-->
                            <!--              <div class="modal-footer">-->


                            <!--                     <div class="mb-3 col-md-12">-->

                            <!--                            <button data-repeater-delete=""-->
                            <!--                                   class="btn rounded-pill px-4 btn-light-danger text-danger font-weight-medium waves-effect waves-light m-l-10"-->
                            <!--                                   type="button" onclick='return stopload()' type="button"-->
                            <!--                                   class="btn btn-default" data-dismiss="modal">-->
                            <!--                                   <svg xmlns="http://www.w3.org/2000/svg" width="24"-->
                            <!--                                          height="24" viewBox="0 0 24 24" fill="none"-->
                            <!--                                          stroke="currentColor" stroke-width="2"-->
                            <!--                                          stroke-linecap="round" stroke-linejoin="round"-->
                            <!--                                          class="feather feather-trash-2 feather-sm ms-2 fill-white">-->
                            <!--                                          <polyline points="3 6 5 6 21 6">-->
                            <!--                                          </polyline>-->
                            <!--                                          <path-->
                            <!--                                                 d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">-->
                            <!--                                          </path>-->
                            <!--                                          <line x1="10" y1="11" x2="10" y2="17"></line>-->
                            <!--                                          <line x1="14" y1="11" x2="14" y2="17"></line>-->
                            <!--                                   </svg>-->
                            <!--                                   Cancel-->
                            <!--                            </button>-->
                            <!--                            <button class="btn rounded-pill px-4 btn-light-success text-success font-weight-medium waves-effect waves-light"-->
                            <!--                                   type="submit" class="btn btn-info"-->
                            <!--                                   value="submit_create_hrm{sys=empshiftgroup}"-->
                            <!--                                   name="submit_create_hrm{sys=empshiftgroup}">-->
                            <!--                                   <svg xmlns="http://www.w3.org/2000/svg" width="24"-->
                            <!--                                          height="24" viewBox="0 0 24 24" fill="none"-->
                            <!--                                          stroke="currentColor" stroke-width="2"-->
                            <!--                                          stroke-linecap="round" stroke-linejoin="round"-->
                            <!--                                          class="feather feather-send feather-sm ms-2 fill-white">-->
                            <!--                                          <line x1="22" y1="2" x2="11" y2="13"></line>-->
                            <!--                                          <polygon points="22 2 15 22 11 13 2 9 22 2">-->
                            <!--                                          </polygon>-->
                            <!--                                   </svg>-->
                            <!--                                   Submit-->
                            <!--                            </button>-->
                            <!--                     </div>-->
                            <!--              </div>-->
                            <!--       </td>-->
                            <!--</tr>-->


                     

              </form>

              <?php } ?>











              <script type="text/javascript">
              $(document).ready(function() {
                     $('#inp_starttime').bootstrapMaterialDatePicker({
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
                            alert("Something went wrong");
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
                            return true;
                            $('#loading').show();
                     }
              }
              </script>

             