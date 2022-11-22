<!-- MAIN DATATABLE SERVERSIDE CSS -->

<!-- MAIN DATATABLE SERVERSIDE CSS -->

<script type="text/javascript" src="../../asset/sdk_datatables_core/gt_dist/jQuery-2.1.4.min.js"></script>

<script type="text/javascript" src="../../asset/sdk_datatables_core/datatables/bedanihbuatjson/bootstrap/js/bootstrap.min.js"></script>

<script src="../../asset/dist/js/jquery-1.11.3.min.js"></script>

<script src="../../asset/gt_developer/geolocation/geo-min.js" type="text/javascript" charset="utf-8"></script>

<script src="../../asset/gt_developer/geolocation/geo-min.js" type="text/javascript" charset="utf-8"></script>


<?php
date_default_timezone_set('Asia/Jakarta'); //Menyesuaikan waktu dengan tempat kita tinggal
$days = date('D, d M Y'); //Menampilkan Jam Sekarang
?>



<script>
       $(document).ready(function() {
              if (navigator.geolocation) {
                     navigator.geolocation.getCurrentPosition(showPosition);
              } else {
                     x.innerHTML = "Geolocation is not supported by this browser.";
              }

              function showPosition(position) {

                     $("#geolocation").val(position.coords.latitude);
                     $("#geolocation2").val(position.coords.longitude);

                     $(".geolocation").val(position.coords.latitude);
                     $(".geolocation2").val(position.coords.longitude);

                     $(".geolocation_timesheet").val(position.coords.latitude);
                     $(".geolocation_timesheet2").val(position.coords.longitude);

              }
       });
</script>


<div class="col-md-12">

       <div class="row">
              <div class="col-lg-4 col-md-12">
                     <?php
                     if ($platform != 'mobile') {
                     ?>
                            <div class="card " style="background: linear-gradient(248deg, #348ac7, #7474bf);">
                                   <div class="card-body">
                                          <div class="d-flex">
                                                 <div class="me-3 align-self-center">
                                                 </div>
                                                 <div>
                                                        <h4 class="text-white card-title" style="font-size: 12px;font-family: verdana;font-weight: bold;letter-spacing: -0.9px; color:#fff !important">Attendance Entry Form </h4>
                                                 </div>
                                          </div>
                                          <div class="row mt-1">
                                                 <div class="p-3 d-flex align-items-start rounded-3" style="width: 100%;">
                                                        <div class="user-img position-relative d-inline-block me-2" style="width: unset;">
                                                               <img src="../../asset/emp_photos/<?php echo $avatar; ?>" alt="user" class="rounded-circle w-100">
                                                        </div>
                                                        <div class="ps-2 v-middle d-md-flex align-items-center w-100" style="margin-left: 15px;">
                                                               <div>
                                                                      <h5 class="my-1 text-dark font-weight-medium" style="color: #fff !important;">
                                                                             <?php echo $textbaru; ?>
                                                                      </h5>
                                                                      <span class="text-muted fs-2" style="color: #fff !important;">Shift Daily : <?php echo $get_Attendance_Shift['shiftdaily_code']; ?></span>
                                                                      <!-- <span class="text-muted fs-2 d-block">45 mins ago</span> -->
                                                               </div>
                                                        </div>
                                                        <div class="ms-auto d-flex button-group mt-3 mt-md-0">
                                                               <button type="button" href="#" class="btn btn-sm btn-light-danger text-danger">
                                                                      <?php echo $get_Attendance_Shift['starttime']; ?>
                                                               </button>
                                                               <button style="margin-left: 4px;" type="button" href="#" class="btn btn-sm btn-light-primary text-primary">
                                                                      <?php echo $get_Attendance_Shift['endtime']; ?>
                                                               </button>
                                                        </div>
                                                 </div>

                                                 <div class="modal-footer-sdk" style="background: transparent;padding-top: -10px;margin-top: -13px; width: 100%;">
                                                        <button type="reset" class="btn-sdk btn-primary-left" data-dismiss="modal" aria-hidden="true" data-toggle="modal" data-target="#CreateFormStarttime" id="CreateButtonStarttime" data-keyboard="false" data-backdrop="static">
                                                               &nbsp;Starttime&nbsp;
                                                        </button>
                                                        <button type="reset" class="btn-sdk btn-primary-right" data-dismiss="modal" aria-hidden="true" data-toggle="modal" id="CreateButtonEndtime" data-keyboard="false" data-backdrop="static">
                                                               Endtime
                                                        </button>
                                                 </div>
                                          </div>
                                   </div>
                            </div>
                     <?php } else if ($platform == 'mobile') { ?>
                     <?php } ?>

                     <div class="card " style="background: linear-gradient(229deg, #e8eae9, #d3d3d3);">
                            <div class="card-body">
                                   <div class="d-flex">
                                          <div class="me-3 align-self-center">
                                          </div>
                                          <div>
                                                 <h4 class="text-white card-title" style="font-size: 12px;font-family: verdana;font-weight: bold;letter-spacing: -0.9px; color : #5a5a5a !important">Timesheet</h4>
                                          </div>
                                   </div>
                                   <div class="row mt-1">
                                          <div class="p-3 d-flex align-items-start rounded-3" style="width: 100%;">
                                                 <div class="user-img position-relative d-inline-block me-2" style="width: unset;">
                                                        <img src="355980.png" alt="user" class="rounded-circle" style="width: 48% !important;">
                                                 </div>
                                                 <div class="ps-2 v-middle d-md-flex align-items-center w-100" style="margin-left: 15px;">
                                                        <div>
                                                               <h5 class="my-1 text-dark font-weight-medium" style="color: #5a5a5a !important">
                                                                      Today activity :
                                                               </h5>
                                                               <?php
                                                               $get_data = mysqli_fetch_array(mysqli_query($connect , "SELECT COUNT(*) AS total FROM ttadatttimesheet WHERE emp_no = '$username' AND DATE(starttime) = '$SFdate'")) 
                                                               ?>
                                                               <span class="text-muted fs-2" style="color: #5a5a5a !important"><?php echo $get_data['total']; ?> </span>
                                                        </div>
                                                 </div>
                                          </div>


                                          <div class="modal-footer-sdk" style="background: transparent;padding-top: -10px;margin-top: -13px; width: 100%;">
                                                 <button type="reset" class="btn-sdk btn-primary-center-only" data-dismiss="modal" aria-hidden="true" data-toggle="modal" data-target="#CreateFormTimesheet" id="CreateButtonTimesheet" data-keyboard="false" data-backdrop="static">
                                                        &nbsp;Add Timesheet&nbsp;
                                                 </button>
                                          </div>

                                   </div>
                            </div>
                     </div>
              </div>

              <?php
              if ($platform != 'mobile') {
              ?>

                     <div class="col-lg-4 d-flex align-items-stretch">
                            <div class="card w-100">
                                   <div class="card-body rounded-top" style="position: relative;">
                                          <h3 class="card-title">Company News</h3>
                                          <div class="resize-triggers">

                                                 <div class="form-row" id="inp_leavebalances_amount" style="width: 100%;">
                                                        <div class="card-body table-responsive p-0" style="width: 100vw;height: 40vh; width: 98%; margin: 5px;overflow:scroll;overflow-x: hidden;border: 1px solid white;">
                                                               <table id="datatable" width="100%" border="1" align="left" class="table table-bordered-sdk table-hover">
                                                               </table>
                                                               <div>
                                                               </div>
                                                        </div>
                                                 </div>
                                          </div>
                                   </div>

                            </div>
                     </div>
       </div>
<?php } else if ($platform == 'mobile') { ?>
<?php } ?>











<!-- add modal -->
<div class="modal  fade fade-custom" tabindex="-1" role="dialog" id="CreateFormTimesheet">
       <div class="modal-dialog modal-belakang modal-bg" role="document">
              <div class="modal-content">
                     <div class="modal-header">
                            <h4 class="modal-title">Timesheet</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>
                     <form class="form-horizontal" action="php_action/timesheet.php<?php echo $getPackage; ?>" method="POST" id="CreateFormEndtime" enctype="multipart/form-data">
                            <input type="hidden" class="form-control" name="emp_no" id="emp_no" value="<?php echo $username; ?>">
                            <input type="hidden" class="geolocation_timesheet" name="geolocation" id="geolocation_timesheet">
                            <input type="hidden" class="geolocation_timesheet2" name="geolocation2" id="geolocation_timesheet2">
                            <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">
                                   <fieldset id="fset_1">
                                          <legend>Timesheet Detail</legend>
                                          <div class="form-row">
                                                 <div class="col-lg-2 name">Customer Name</div>
                                                 <div class="col-lg-5">
                                                        <div class="input-group">
                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="inp_customre_name" name="inp_customre_name" type="Text">
                                                        </div>
                                                 </div>
                                          </div>
                                          <div class="form-row">
                                                 <div class="col-lg-2 name">Region</div>
                                                 <div class="col-sm-5">
                                                        <div class="input-group">
                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="inp_region" name="inp_region" type="Text">
                                                        </div>
                                                 </div>
                                          </div>
                                          <div class="form-row">
                                                 <div class="col-lg-2 name">Activity</div>
                                                 <div class="col-sm-5">
                                                        <div class="input-group">
                                                               <input type="checkbox" class="timesheet" name="timesheet[]" value="New Customer"> 1. New Customer<br>
                                                               <input type="checkbox" class="timesheet" name="timesheet[]" value="Follow Up"> 2. Follow Up<br>
                                                               <input type="checkbox" class="timesheet" name="timesheet[]" value="Order"> 3. Order<br>
                                                               <input type="checkbox" class="timesheet" name="timesheet[]" value="Receipt"> 4. Receipt<br>
                                                               <input type="checkbox" class="timesheet" name="timesheet[]" value="Billing"> 5. Billing<br>
                                                               <input type="checkbox" class="timesheet" name="timesheet[]" value="Delivery of goods"> 6. Delivery of goods<br>
                                                        </div>
                                                 </div>
                                          </div>
                                          <div class="form-row">
                                                 <div class="col-lg-2 name">Information / Notes</div>
                                                 <div class="col-sm-5">
                                                        <div class="input-group">
                                                               <textarea class="input--style-6" autocomplete="off" autofocus="on" id="inp_information" name="inp_information" type="Text"></textarea>
                                                        </div>
                                                 </div>
                                          </div>
                                          <div class="form-row">
                                                 <div class="col-lg-2 name">File Attachment <font color="red">*</font>
                                                 </div>
                                                 <div class="col-lg-8 name">
                                                        <div class="input-group">
                                                               <input type="file" name="fileupload" id="fileupload" class="form-control" />
                                                        </div>
                                                 </div>
                                          </div>
                                   </fieldset>
                            </div>

                            <div class="modal-footer-sdk">
                                   <a type="reset" class="btn-sdk btn-primary-left" data-dismiss="modal" aria-hidden="true" style="color: white;padding-top: 8px;">
                                          &nbsp;Cancel&nbsp;
                                   </a>
                                   <button id="button-timesheet" name="button-timesheet" class="btn-sdk btn-primary-right" type="submit" name="submit_update" id="submit_update" style="color: grey;padding-top: 8px;">
                                          Record Time
                                   </button>
                            </div>
                     </form>
              </div>
       </div>
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /edit modal -->














































































































<script type="text/javascript">
       // $(document).ready(function() {

       //        $("#CreateButtonTimesheet").on('click', function() {
       //               event.preventDefault();

                     var emp_no = $('#emp_no').val();
                     var geolocation = $('#geolocation_timesheet').val();
                     var geolocation2 = $('#geolocation_timesheet2').val();


       //               var myTimeout = setTimeout(myGreeting, 1000);

       //               function myGreeting() {
       //                      $("#box_timesheet").load("pages_relation/_pages_attendances.php<?php echo $getPackage; ?>",
       //                             function(responseTxt_spv_up, statusTxt_spv_up, jqXHR_spv_up) {
       //                                    if (statusTxt_spv_up == "success") {
       //                                           $("#box_timesheet").show();
       //                                           mymodalss.style.display = "none";
       //                                    }
       //                             }
       //                      );
       //               }

       //               $("#button-timesheet").on('click', function() {
                            // var inp_customre_name = $('#inp_customre_name').val();
                            // var inp_information = $('#inp_information').val();
                            // var inp_region = $('#inp_region').val();
                            // var timesheet = $('#inp_region').val();
                            // var checkedCount = $('input[class="timesheet"]:checked').length;

       //                      var update = [];

       //                      $('input:checkbox[name^="timesheet[]"]:checked').each(function(i) {
       //                             update[i] = $(this).val();
       //                      });

                            // if (inp_customre_name == "") {
                            //        mymodalss.style.display = "none";
                            //        modals.style.display = "block";
                            //        document.getElementById("msg").innerHTML = "Customer name cannot empty";
                            //        return false;
                            // } else if (inp_region == "") {
                            //        mymodalss.style.display = "none";
                            //        modals.style.display = "block";
                            //        document.getElementById("msg").innerHTML = "Region cannot empty";
                            //        return false;
                            // } else if (checkedCount == 0) {
                            //        mymodalss.style.display = "none";
                            //        modals.style.display = "block";
                            //        document.getElementById("msg").innerHTML = "Select at leave one activity";
                            //        return false;
       //                      } else {


       //                             $.ajax({
       //                                    url: 'timesheet.php',
       //                                    type: 'POST',
       //                                    data:formData,
       //                                    // data: {
       //                                    //        emp_no: emp_no,
       //                                    //        geolocation: geolocation,
       //                                    //        geolocation2: geolocation2,
       //                                    //        inp_customre_name: inp_customre_name,
       //                                    //        inp_region: inp_region,
       //                                    //        inp_information: inp_information,
       //                                    //        // image: image,
       //                                    //        timesheet: update
       //                                    // },

       //                                    success: function(data) {

       //                                           if (emp_no == "") {
       //                                                  mymodalss.style.display = "none";
       //                                                  modals.style.display = "block";
       //                                                  document.getElementById("msg").innerHTML = "Invalid request response | emp_no is not found";
       //                                                  return false;
                                                 // } else if (geolocation == "") {
                                                 //        mymodalss.style.display = "none";
                                                 //        modals.style.display = "block";
                                                 //        document.getElementById("msg").innerHTML = "Location not found";
                                                 //        return false;
                                                 // } else if (geolocation2 == "") {
                                                 //        mymodalss.style.display = "none";
                                                 //        modals.style.display = "block";
                                                 //        document.getElementById("msg").innerHTML = "Location not found";
                                                 //        return false;

       //                                           } else {
       //                                                  mymodalss.style.display = "none";
       //                                                  mymodals_withhref.style.display = "block";
       //                                                  document.getElementById("msg_href").innerHTML = " Successfully Record Attendance";
       //                                           }
       //                                    }
       //                             })
       //                      }
       //               });
       //        });
       // });


       // global the manage memeber table 
       $(document).ready(function() {
              $("#CreateButtonTimesheet").on('click', function() {

                     $("#CreateFormEndtime").unbind('submit').bind('submit', function() {

                            mymodalss.style.display = "block";

                            $(".text-danger").remove();

                            var form = $(this);

                            // var inp_emp_no              = $("#inp_emp_no").val();

                            var emp_no           = $('#emp_no').val();
                            var geolocation      = $('#geolocation_timesheet').val();
                            var geolocation2     = $('#geolocation_timesheet2').val();
                            var inp_customre_name = $('#inp_customre_name').val();
                            var inp_information = $('#inp_information').val();
                            var inp_region = $('#inp_region').val();
                            var timesheet = $('#inp_region').val();
                            var checkedCount = $('input[class="timesheet"]:checked').length;
                            var fileupload     = $('#fileupload').val();

                            var regex = /^[a-zA-Z]+$/;

                            if (inp_customre_name == "") {
                                   mymodalss.style.display = "none";
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Customer name cannot empty";
                                   return false;
                            } else if (inp_region == "") {
                                   mymodalss.style.display = "none";
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Region cannot empty";
                                   return false;
                            } else if (checkedCount == 0) {
                                   mymodalss.style.display = "none";
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Select at leave one activity";
                                   return false;
                            } else if (geolocation == "") {
                                   mymodalss.style.display = "none";
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Location not found";
                                   return false;
                            } else if (geolocation2 == "") {
                                   mymodalss.style.display = "none";
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Location not found";
                                   return false;
                            } else if (fileupload == "") {
                                   mymodalss.style.display = "none";
                                   modals.style.display ="block";
                                   document.getElementById("msg").innerHTML = "Invalid Employee";
                                   return false;

                            } else {
                                   //submi the form to server
                                   $.ajax({
                                          url: "timesheet.php",
                                          type: form.attr('method'),
                                          data: new FormData(this),
                                          processData: false,
                                          contentType: false,
                                          dataType: 'json',
                                          success: function(response) {


                                                 // remove the error 
                                                 $(".form-group").removeClass('has-error').removeClass('has-success');

                                                 if (response.code == 'success_message') {
                                                        mymodalss.style.display = "none";
                                                        modals_href.style.display ="block";
                                                        document.getElementById("msg_href").innerHTML = response.messages;
                                                 } else {
                                                        mymodalss.style.display = "none";
                                                        modals_href.style.display = "block";
                                                        document.getElementById("msg_href").innerHTML = response.messages;
                                                 } // /else
                                          } // success  
                                   }); // ajax subit 				
           
                                   return false;
                            }

                     }); // /submit form for create member
              }); // /add modal
       });
</script>