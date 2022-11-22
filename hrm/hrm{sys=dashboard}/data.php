<?php
$src_emp_no                = '';
if (!empty($_POST['src_emp_no'])) {
       $src_emp_no         = $_POST['src_emp_no'];
       $frameworks          = "?username=$username" . "&src_emp_no=" . "" . $src_emp_no . "";
} else {
       $frameworks          = "?username=$username";
}
?>

<!-- LOADER -->
<div onclick='return stopload()' id="loading-circle"></div>
<!-- LOADER -->



<?php
// jika nip dan nama terisi
if (!empty($_POST['nip']) && !empty($_POST['full_name'])) {
       $mynip = $_POST['nip'];
       $myname = $_POST['full_name'];
       $frameworks = ",empnip :" . "'" . $mynip . "' ,empname :" . "'" . $myname . "'";
       // jika nip saja yang terisi
} elseif (!empty($_POST['nip'])) {
       $mynip = $_POST['nip'];
       $myname = $_POST['full_name'];
       $frameworks = ",empnip :" . "'" . $mynip . "'";
       // jika nama saja yang terisi
} elseif (!empty($_POST['full_name'])) {
       $mynip = $_POST['nip'];
       $myname = $_POST['full_name'];
       $frameworks = ",empname :" . "'" . $myname . "'";

       // jika tidak ada yang terisi

} else {

       $frameworks = "";
}

?>





<!-- MAIN DATATABLE SERVERSIDE CSS -->

<!-- MAIN DATATABLE SERVERSIDE CSS -->

<script type="text/javascript" src="../../asset/sdk_datatables_core/gt_dist/jQuery-2.1.4.min.js"></script>

<script type="text/javascript" src="../../asset/sdk_datatables_core/datatables/bedanihbuatjson/bootstrap/js/bootstrap.min.js"></script>

<!-- MAIN DATATABLE SERVERSIDE CSS -->

<!-- MAIN DATATABLE SERVERSIDE CSS -->



<!-- isi JSON -->

<script type="text/javascript">
       // global the manage memeber table 

       $(document).ready(function() {

              datatable = $("#datatable").DataTable({



                     dom: "B<'row'<'col-sm-12 col-md-9'l><'col-sm-12 col-md-9'f>>" +

                            "<'row'<'col-sm-12'tr>>" +

                            "<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-7'p>>",



                     processing: true,

                     // retrieve: true,

                     searching: false,

                     paging: true,

                     order: [

                            [0, "asc"]

                     ],

                     pagingType: "simple",

                     bPaginate: true,

                     bLengthChange: false,

                     bFilter: false,

                     bInfo: true,

                     orderable: false,

                     bAutoWidth: true,

                     language: {

                            "processing": "Please wait..",

                     },

                     columnDefs: [{

                            orderable: false,

                            targets: 0

                     }],

                     destroy: true,

                     "ajax": "php_action/FuncDataRead.php<?php echo $frameworks; ?>"

              });

       });
</script>



<style>
       .sorting_1 {

              border-left: 1px solid white;

       }



       .odd {

              border-left: 1px solid white;

       }
</style>



<!-- <script src="../../asset/dist/js/jquery-1.11.3.min.js"></script> -->



<style>
       .kolp {
              height: 100%;
              width: 100%;
       }
</style>

<script src="../../asset/dist/js/jquery-1.11.3.min.js"></script>

<script src="../../asset/gt_developer/geolocation/geo-min.js" type="text/javascript" charset="utf-8"></script>

<script src="../../asset/gt_developer/geolocation/geo-min.js" type="text/javascript" charset="utf-8"></script>

<script>
       if (geo_position_js.init()) {

              geo_position_js.getCurrentPosition(success_callback, error_callback, {

                     enableHighAccuracy: true

              });

       } else {

              div_isi = document.getElementById("div_isi");

              div_isi.innerHTML = "Tidak ada fungsi geolocation";

       }



       function success_callback(p) {

              latitude = p.coords.latitude;

              longitude = p.coords.longitude;

              pesan = 'posisi:' + latitude + ',' + longitude;

              pesan = pesan + "<br/>";



              div_isi = document.getElementById("div_isi").value = +latitude;

              div_isi2 = document.getElementById("div_isi2").value = +longitude;



              div_isi_get = document.getElementById("div_isi_get").value = +latitude;

              div_isi_get2 = document.getElementById("div_isi_get2").value = +longitude;

              //alert(pesan);

              div_isi.innerHTML = pesan;

       }



       function error_callback(p) {



              div_isi = document.getElementById("div_isi").value = "div_isi";

              div_isi.innerHTML = 'error=' + p.message;

       }
</script>







<?php

date_default_timezone_set('Asia/Jakarta'); //Menyesuaikan waktu dengan tempat kita tinggal

$days = date('D, d M Y'); //Menampilkan Jam Sekarang

?>







<?php

$get_Attendance_Shift = mysqli_fetch_array(mysqli_query($connect, "SELECT

                                                                             CONCAT(shiftdaily_code , ' - ' , TIME_FORMAT(shiftstarttime, '%H:%i') , ' - ' , TIME_FORMAT(shiftendtime, '%H:%i') ) AS shiftdaily_code,

                                                                             CASE

                                                                                    WHEN starttime IS NULL THEN '00:00'

                                                                                    ELSE TIME_FORMAT(starttime, '%H:%i')

                                                                             END AS starttime,

                                                                             CASE

                                                                                    WHEN endtime IS NULL THEN '00:00'

                                                                                    ELSE TIME_FORMAT(endtime, '%H:%i')

                                                                             END AS endtime

                                                                         

                                                                      FROM hrdattendance

                                                                      WHERE emp_id = (

                                                                      SELECT emp_id

                                                                      FROM view_employee

                                                                      WHERE emp_no = '$username') AND 

                                                                      dateforcheck = DATE(NOW())"));

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
                                                 <button type="reset" class="btn-sdk btn-primary-right" data-dismiss="modal" aria-hidden="true" data-toggle="modal" data-target="#CreateFormEndtime" id="CreateButtonEndtime" data-keyboard="false" data-backdrop="static">
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
                                   <h3 class="card-title">Employee Leave Balances</h3>
                                   <div class="resize-triggers">
                                          <div class="expand-trigger">
                                                 <div style="width: 393px;">
                                                 </div>
                                          </div>
                                          <div class="contract-trigger">
                                                 
                                          </div>
                                          <div class="form-row" id="inp_leavebalances_amount" style="width: 100%;">
                                                        <div class="col-sm-6 name">
                                                               <div class="progress-container progress-info">
                                                                      <span class="progress-badge" style="font-size: 10px;font-family: verdana;font-weight: bold;letter-spacing: -0.9px; color:#cacaca !important;">Leave Balance <br> Annual Leave</span>
                                                                      <div class="progress">
                                                                             <div class="progress-bar progress-bar-info1" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;cursor: pointer;" data-toggle="modal" data-target="#LeaveBalances" data-backdrop="static" onclick="BalancesDetail(`ANL`)">
                                                                             </div>
                                                                      </div>
                                                               </div>
                                                        </div>
                                                        <div class="col-sm-6 name">
                                                               <div class="progress-container progress-info">
                                                                      <span class="progress-badge" style="font-size: 10px;font-family: verdana;font-weight: bold;letter-spacing: -0.9px; color:#cacaca !important;">Leave Balance <br> Award Leave</span>
                                                                      <div class="progress">
                                                                             <div class="progress-bar progress-bar-info1" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;cursor: pointer;" data-toggle="modal" data-target="#LeaveBalances" data-backdrop="static" onclick="BalancesDetail(`AWLV`)">
                                                                             </div>
                                                                      </div>
                                                               </div>
                                                        </div>
                                                        <div class="col-sm-12 name">
                                                               <div class="progress-container progress-info">
                                                                      <span class="progress-badge" style="font-size: 10px;font-family: verdana;font-weight: bold;letter-spacing: -0.9px; color:#cacaca !important;">Task Finnished</span>
                                                                      <div class="progress">
                                                                             <div class="progress-bar progress-bar-info2" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;">
                                                                             </div>
                                                                      </div>
                                                               </div>
                                                        </div>
                                                 </div>
                                   </div>
                            </div>
                            

                     </div>
              </div>
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
              <div class="modal  fade fade-custom" tabindex="-1" role="dialog" id="CreateFormStarttime">
                     <div class="modal-dialog modal-belakang modal-bg" role="document">
                            <div class="modal-content">
                                   <div class="modal-header">
                                          <h4 class="modal-title">Attendance Form Start Time</h4>
                                          <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                                 <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                                          </a>
                                   </div>
                                   <form class="form-horizontal" action="php_action/FuncDataCreate.php<?php echo $getPackage; ?>" method="POST" id="FormDisplayCreate">
                                          <input type="hidden" class="form-control" name="emp_no" id="emp_no" value="<?php echo $username; ?>" required>
                                          <input type="hidden" name="geolocation" id="geolocation">
                                          <input type="hidden" name="geolocation2" id="geolocation2">
                                          <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">
                                                 <fieldset id="fset_1">
                                                        <div class="form-row" id="frm_employee_no">
                                                               <div class="col-sm-12 name">
                                                                      <div id="box_attendances_starttime"></div>
                                                               </div>
                                                        </div>
                                                 </fieldset>
                                          </div>
                                          <div class="modal-footer-sdk">
                                                 <a type="reset" class="btn-sdk btn-primary-left" data-dismiss="modal" aria-hidden="true" style="color: white;padding-top: 8px;">
                                                        &nbsp;Cancel&nbsp;
                                                 </a>
                                                 <a id="button-starttime" name="button-starttime" class="btn-sdk btn-primary-right" type="submit" name="submit_update" id="submit_update" style="color: grey;padding-top: 8px;">
                                                        Record Time
                                                 </a>
                                          </div>
                                   </form>
                                   </div>
                            </div>
                     </div><!-- /.modal-dialog -->
              </div><!-- /.modal -->
              <!-- /edit modal -->









              <!-- add modal -->
              <div class="modal  fade fade-custom" tabindex="-1" role="dialog" id="CreateFormEndtime">
                     <div class="modal-dialog modal-belakang modal-bg" role="document">
                            <div class="modal-content">
                                   <div class="modal-header">
                                          <h4 class="modal-title">Attendance Form End Time</h4>
                                          <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                                 <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                                          </a>
                                   </div>
                                   <form class="form-horizontal" action="php_action/FuncDataCreate.php<?php echo $getPackage; ?>" method="POST" id="CreateFormEndtime">
                                          <input type="hidden" class="form-control" name="emp_no" id="emp_no" value="<?php echo $username; ?>" required>
                                          <input type="hidden" class="geolocation" name="geolocation" id="geolocation">
                                          <input type="hidden" class="geolocation2" name="geolocation2" id="geolocation2">
                                          <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">
                                                 <fieldset id="fset_1">
                                                        <div class="form-row" id="frm_employee_no">
                                                               <div class="col-sm-12 name">
                                                                      <div id="box_attendances_endtime"></div>
                                                               </div>
                                                        </div>
                                                 </fieldset>
                                          </div>

                                          <div class="modal-footer-sdk">
                                                 <a type="reset" class="btn-sdk btn-primary-left" data-dismiss="modal" aria-hidden="true" style="color: white;padding-top: 8px;">
                                                        &nbsp;Cancel&nbsp;
                                                 </a>
                                                 <a id="button-endtime" name="button-endtime" class="btn-sdk btn-primary-right" type="submit" name="submit_update" id="submit_update" style="color: grey;padding-top: 8px;">
                                                        Record Time
                                                 </a>
                                          </div>
                                   </form>
                                   </div>
                            </div>
                     </div><!-- /.modal-dialog -->
              </div><!-- /.modal -->
              <!-- /edit modal -->









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
                                   <form class="form-horizontal" action="php_action/FuncDataCreate.php<?php echo $getPackage; ?>" method="POST" id="CreateFormEndtime">
                                          <input type="hidden" class="form-control" name="emp_no" id="emp_no" value="<?php echo $username; ?>" required>
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
                                                                             <textarea class="input--style-6" autocomplete="off" autofocus="on" id="inp_information" name="inp_information" type="Text">
                                                                             </textarea>
                                                                      </div>
                                                               </div>
                                                        </div>
                                                        <div class="form-row" id="frm_employee_no">
                                                               <div class="col-sm-12 name">
                                                                      <div id="box_timesheet"></div>
                                                               </div>
                                                        </div>
                                                 </fieldset>
                                          </div>

                                          <div class="modal-footer-sdk">
                                                 <a type="reset" class="btn-sdk btn-primary-left" data-dismiss="modal" aria-hidden="true" style="color: white;padding-top: 8px;">
                                                        &nbsp;Cancel&nbsp;
                                                 </a>
                                                 <a id="button-timesheet" name="button-timesheet" class="btn-sdk btn-primary-right" type="submit" name="submit_update" id="submit_update" style="color: grey;padding-top: 8px;">
                                                        Record Time
                                                 </a>
                                          </div>
                                   </form>
                                   </div>
                            </div>
                     </div><!-- /.modal-dialog -->
              </div><!-- /.modal -->
              <!-- /edit modal -->








































































































<!-- add modal -->

<div class="modal  fade fade-custom" tabindex="-1" role="dialog" id="NewsDetail">

       <div class="modal-dialog modal-belakang modal-bg" role="document">

              <div class="modal-content">

                     <div class="modal-header">

                            <h4 class="modal-title">News Detail</h4>

                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">

                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>

                            </a>

                     </div>



                     <form class="form-horizontal" action="php_action/FuncDataCreate.php<?php echo $getPackage; ?>" method="POST" id="NewsDetail">



                            <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

                                   <div class="form-row" id="frm_employee_no">

                                          <div id="news_content" class="col-sm-12 name">

                                          </div>

                                   </div>

                            </div>

                            <div class="modal-footer-sdk">

                                   <a type="reset" class="btn-sdk btn-primary-center-only" data-dismiss="modal" aria-hidden="true" style="color: white;padding-top: 8px;">

                                          &nbsp;Close&nbsp;

                                   </a>

                            </div>

                     </form>

              </div>

       </div>

</div><!-- /.modal-dialog -->

</div><!-- /.modal -->

<!-- /edit modal -->



































































<!-- add modal -->

<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="LeaveBalances">

       <div class="modal-dialog modal-belakang modal-bg" role="document">

              <div class="modal-content">

                     <div class="modal-header">

                            <h4 class="modal-title">Leave Balance</h4>

                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">

                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>

                            </a>

                     </div>



                     <form class="form-horizontal" action="php_action/FuncDataCreate.php<?php echo $getPackage; ?>" method="POST" id="NewsDetail">



                            <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: scroll;">

                                   <div class="form-row" id="frm_employee_no">

                                          <div id="box_leave" class="col-sm-12 name">

                                          </div>

                                   </div>

                            </div>

                            <div class="modal-footer-sdk">

                                   <a type="reset" class="btn-sdk btn-primary-center-only" data-dismiss="modal" aria-hidden="true" style="color: white;padding-top: 8px;">

                                          &nbsp;Close&nbsp;

                                   </a>

                            </div>

                     </form>

              </div>

       </div>

</div><!-- /.modal-dialog -->





































































<div class="row">

       <!-- Column -->

       <div class="col-lg-12 col-md-12">

              <div class="card">

                     <div class="card-body">

                            <h4 class="card-title"><i class="text-success fa fa-circle font-10 mr-2 "></i>Leave Request</h4>

                            <h6 class="card-subtitle"></h6>

                            <div style="height: 300px;">





                                   <div class="card-body table-responsive p-0" style="width: 100vw;height: 280px; width: 98.8%; margin: 5px;overflow: scroll;">

                                          <table id="example3LOAD" width="99%" border="1" class="table table-bordered table-striped table-hover table-head-fixed">

                                                 <thead>

                                                        <tr>

                                                               <th class="fontCustom" style="background-color: lightgray;z-index: 1;">No.</th>

                                                               <th class="fontCustom" style="background-color: lightgray; z-index: 1;" nowrap="nowrap">Req. No.</th>

                                                               <th class="fontCustom" style="background-color: lightgray; z-index: 1;" nowrap="nowrap">Leave Code</th>

                                                               <th class="fontCustom" style="background-color: lightgray;z-index: 1;" nowrap="nowrap">Start Date</th>

                                                               <th class="fontCustom" style="background-color: lightgray;z-index: 1;" nowrap="nowrap">End Date</th>

                                                               <th class="fontCustom" style="background-color: lightgray;z-index: 1;" nowrap="nowrap">Total Days</th>

                                                               <th class="fontCustom" style="background-color: lightgray;z-index: 1;" nowrap="nowrap">Status</th>

                                                        </tr>

                                                 </thead>

                                          </table>

                                   </div>

                            </div>

                            <div class="text-center">

                                   <ul class="list-inline">

                                          <!-- AgusPrass 02/03/2021 Merubah -->

                                          <!-- <li class="list-inline-item px-2">

                                            <h6 class="text-success"><i class="fa fa-circle font-10 mr-2 "></i>Leave Request

                                            </h6>

                                        </li> -->

                                          <!-- AgusPrass 02/03/2021 Merubah -->

                                          <li class="list-inline-item px-2">

                                                 <h6 class=" text-info"><i class="fa fa-circle font-10 mr-2"></i>ANL, AWLV, MNLV, MTLV</h6>

                                          </li>

                                   </ul>

                            </div>

                     </div>

              </div>

       </div>

       <!-- Column -->

       <!-- Column -->

       <div class="col-lg-12 col-md-12">

              <div class="card">

                     <div class="card-body">

                            <h4 class="card-title"><i class="text-success fa fa-circle font-10 mr-2 "></i>Permission</h4>

                            <h6 class="card-subtitle"></h6>

                            <div style="height: 300px;">





                                   <div class="card-body table-responsive p-0" style="width: 100vw;height: 280px; width: 98.8%; margin: 5px;overflow: scroll;">

                                          <table id="req_permit" width="99%" border="1" class="table table-bordered table-striped table-hover table-head-fixed">





                                                 <thead>

                                                        <tr>

                                                               <th class="fontCustom" style="background-color: lightgray;z-index: 1;">No.</th>

                                                               <th class="fontCustom" style="background-color: lightgray; z-index: 1;" nowrap="nowrap">Req. No.</th>

                                                               <th class="fontCustom" style="background-color: lightgray; z-index: 1;" nowrap="nowrap">Leave Code</th>

                                                               <th class="fontCustom" style="background-color: lightgray;z-index: 1;" nowrap="nowrap">Start Date</th>

                                                               <th class="fontCustom" style="background-color: lightgray;z-index: 1;" nowrap="nowrap">End Date</th>

                                                               <th class="fontCustom" style="background-color: lightgray;z-index: 1;" nowrap="nowrap">Total Days</th>

                                                               <th class="fontCustom" style="background-color: lightgray;z-index: 1;" nowrap="nowrap">Status</th>

                                                        </tr>



                                                 </thead>



                                          </table>

                                   </div>





                            </div>









                            <div class="text-center">

                                   <ul class="list-inline">

                                          <!-- AgusPrass 02/03/2021 Merubah -->

                                          <!-- <li class="list-inline-item px-2">

                                            <h6 class="text-success"><i class="fa fa-circle font-10 mr-2 "></i>Permission

                                            </h6>

                                        </li> -->

                                          <!-- AgusPrass 02/03/2021 Merubah -->

                                          <li class="list-inline-item px-2">

                                                 <h6 class=" text-info"><i class="fa fa-circle font-10 mr-2"></i>PDPR, PERMIT, PERMITHALF</h6>

                                          </li>

                                   </ul>

                            </div>

                     </div>

              </div>

       </div>

       <!-- Column -->

       <!-- Column -->



       <!-- AgusPrass 02/03/2021 Merubah -->

       <!-- <div class="col-lg-4 col-md-12">

                        <div class="card">

                            <div class="card-body">

                                <h4 class="card-title"><i class="text-success fa fa-circle font-10 mr-2 "></i>Sickness</h4>

                                <h6 class="card-subtitle"></h6>

                                <div  style="height: 300px;">



                                

                                <div class="card-body table-responsive p-0"

                                        style="width: 100vw;height: 280px; width: 98.8%; margin: 5px;overflow: scroll;">

                                        <table id="req_sickness" width="99%" border="1"

                                                class="table table-bordered table-striped table-hover table-head-fixed">





                                                <thead>

                                                        <tr>

                                                               <th class="fontCustom" style="background-color: lightgray;z-index: 1;">No.</th>

                                                               <th class="fontCustom" style="background-color: lightgray; z-index: 1;" nowrap="nowrap">Req. No.</th>

                                                               <th class="fontCustom" style="background-color: lightgray; z-index: 1;" nowrap="nowrap">Leave Code</th>

                                                                <th class="fontCustom" style="background-color: lightgray;z-index: 1;" nowrap="nowrap">Start Date</th>

                                                                <th class="fontCustom" style="background-color: lightgray;z-index: 1;" nowrap="nowrap">End Date</th>

                                                                <th class="fontCustom" style="background-color: lightgray;z-index: 1;" nowrap="nowrap">Total Days</th>

                                                                <th class="fontCustom" style="background-color: lightgray;z-index: 1;" nowrap="nowrap">Status</th>

                                                        </tr>



                                                </thead>



                                        </table>

                                    </div>

         

                                

                                </div>

                                

                                <div class="text-center">

                                    <ul class="list-inline">

                                        <li class="list-inline-item px-2">

                                            <h6 class="text-success"><i class="fa fa-circle font-10 mr-2 "></i>Sickness

                                            </h6>

                                        </li>

                                        <li class="list-inline-item px-2">

                                            <h6 class=" text-info"><i class="fa fa-circle font-10 mr-2"></i>HOSP, OSIC, SICK, SICKHALF</h6>

                                        </li>

                                    </ul>

                                </div>

                            </div>

                        </div>

                    </div> -->

       <!-- Column -->

       <!-- AgusPrass 02/03/2021 Merubah -->

       <!-- Column -->

       <div class="col-lg-12 col-md-12">

              <div class="card">

                     <div class="card-body">

                            <h4 class="card-title"><i class="text-success fa fa-circle font-10 mr-2 "></i>Dispensation</h4>

                            <h6 class="card-subtitle"></h6>

                            <div style="height: 300px;">





                                   <div class="card-body table-responsive p-0" style="width: 100vw;height: 280px; width: 98.8%; margin: 5px;overflow: scroll;">

                                          <table id="req_dispensation" width="99%" border="1" class="table table-bordered table-striped table-hover table-head-fixed">





                                                 <thead>

                                                        <tr>

                                                               <th class="fontCustom" style="background-color: lightgray;z-index: 1;">No.</th>

                                                               <th class="fontCustom" style="background-color: lightgray; z-index: 1;" nowrap="nowrap">Req. No.</th>

                                                               <th class="fontCustom" style="background-color: lightgray; z-index: 1;" nowrap="nowrap">Leave Code</th>

                                                               <th class="fontCustom" style="background-color: lightgray;z-index: 1;" nowrap="nowrap">Start Date</th>

                                                               <th class="fontCustom" style="background-color: lightgray;z-index: 1;" nowrap="nowrap">End Date</th>

                                                               <th class="fontCustom" style="background-color: lightgray;z-index: 1;" nowrap="nowrap">Total Days</th>

                                                               <th class="fontCustom" style="background-color: lightgray;z-index: 1;" nowrap="nowrap">Status</th>

                                                        </tr>



                                                 </thead>



                                          </table>

                                   </div>





                            </div>



                            <div class="text-center">

                                   <ul class="list-inline">

                                          <!-- AgusPrass 02/03/2021 Merubah -->

                                          <!-- <li class="list-inline-item px-2">

                                            <h6 class="text-success"><i class="fa fa-circle font-10 mr-2 "></i>Dsipensation

                                            </h6>

                                        </li> -->

                                          <!-- AgusPrass 02/03/2021 Merubah -->

                                          <li class="list-inline-item px-2">

                                                 <h6 class=" text-info"><i class="fa fa-circle font-10 mr-2"></i>BPT, CCM, DCF, DOR, DSCI, ECB, EML, EWMCL, GRD, GRDC, HCF, PLG, UMR, UMRCMP</h6>

                                          </li>

                                   </ul>

                            </div>

                     </div>

              </div>

       </div>

       <!-- Column -->



</div>

































</div>

<div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>

<!-- Column -->







<script>
       $(document).ready(function() {

              var limit = 100;

              var start = 0;

              var action = 'inactive';



              function load_country_data(limit, start) {

                     $.ajax({

                            url: "../../view/da/VMDashboardLeaveList.php<?php echo $getPackage; ?>",

                            method: "POST",

                            data: {

                                   limit: limit,

                                   start: start <?php echo $frameworks; ?>,

                            },

                            cache: false,

                            success: function(data) {

                                   $('#example3LOAD').append(

                                          data);

                                   if (data == '') {

                                          $('#example3_message')

                                                 .html(

                                                        "<button type='button' class='btn btn-info'>No Data Found</button>"

                                                 );

                                          action = 'active';

                                   } else {

                                          $('#example3_message')

                                                 .html(

                                                        "<button type='button' class='btn btn-warning'>Please Wait....</button>"

                                                 );

                                          action = "inactive";

                                   }

                            }

                     });

              }



              if (action == 'inactive') {

                     action = 'active';

                     load_country_data(limit, start);

              }

              $(window).scroll(function() {

                     if ($(window).scrollTop() + $(window).height() >

                            420 && action == 'inactive') {

                            action = 'active';

                            start = start + limit;

                            setTimeout(function() {

                                   load_country_data(

                                          limit,

                                          start);

                            }, 1000);

                     }

              });



       });
</script>







<script>
       $(document).ready(function() {

              var limit = 100;

              var start = 0;

              var action = 'inactive';



              function load_country_data_s(limit, start) {

                     $.ajax({

                            url: "../../view/da/VMDashboardPermitList.php<?php echo $getPackage; ?>",

                            method: "POST",

                            data: {

                                   limit: limit,

                                   start: start <?php echo $frameworks; ?>,

                            },

                            cache: false,

                            success: function(data) {

                                   $('#req_permit').append(

                                          data);

                                   if (data == '') {

                                          $('#example3_message')

                                                 .html(

                                                        "<button type='button' class='btn btn-info'>No Data Found</button>"

                                                 );

                                          action = 'active';

                                   } else {

                                          $('#example3_message')

                                                 .html(

                                                        "<button type='button' class='btn btn-warning'>Please Wait....</button>"

                                                 );

                                          action = "inactive";

                                   }

                            }

                     });

              }



              if (action == 'inactive') {

                     action = 'active';

                     load_country_data_s(limit, start);

              }

              $(window).scroll(function() {

                     if ($(window).scrollTop() + $(window).height() >

                            420 && action == 'inactive') {

                            action = 'active';

                            start = start + limit;

                            setTimeout(function() {

                                   load_country_data_s(

                                          limit,

                                          start);

                            }, 1000);

                     }

              });



       });
</script>





<script>
       $(document).ready(function() {

              var limit = 100;

              var start = 0;

              var action = 'inactive';



              function load_country_data_s(limit, start) {

                     $.ajax({

                            url: "../../view/da/VMDashboardSicknessList.php<?php echo $getPackage; ?>",

                            method: "POST",

                            data: {

                                   limit: limit,

                                   start: start <?php echo $frameworks; ?>,

                            },

                            cache: false,

                            success: function(data) {

                                   $('#req_sickness').append(

                                          data);

                                   if (data == '') {

                                          $('#example3_message')

                                                 .html(

                                                        "<button type='button' class='btn btn-info'>No Data Found</button>"

                                                 );

                                          action = 'active';

                                   } else {

                                          $('#example3_message')

                                                 .html(

                                                        "<button type='button' class='btn btn-warning'>Please Wait....</button>"

                                                 );

                                          action = "inactive";

                                   }

                            }

                     });

              }



              if (action == 'inactive') {

                     action = 'active';

                     load_country_data_s(limit, start);

              }

              $(window).scroll(function() {

                     if ($(window).scrollTop() + $(window).height() >

                            420 && action == 'inactive') {

                            action = 'active';

                            start = start + limit;

                            setTimeout(function() {

                                   load_country_data_s(

                                          limit,

                                          start);

                            }, 1000);

                     }

              });



       });
</script>



<script language="JavaScript">
       Webcam.set({

              image_format: 'jpeg',

              jpeg_quality: 130

       });

       Webcam.attach('#my_camera');
</script>



<script type="text/javascript">
       $(document).ready(function() {
              $("#CreateButtonStarttime").on('click', function() {
                     event.preventDefault();
                     var image = '';
                     var emp_no = $('#emp_no').val();
                     var geolocation = $('#geolocation').val();
                     var geolocation2 = $('#geolocation2').val();
                     var myTimeout = setTimeout(myGreeting, 1000);
                     function myGreeting() {
                            $("#box_attendances_starttime").load("pages_relation/_pages_attendances.php<?php echo $getPackage; ?>",
                                   function(responseTxt_spv_up, statusTxt_spv_up, jqXHR_spv_up) {
                                          if (statusTxt_spv_up == "success") {
                                                 $("#box_attendances_starttime").show();
                                                 mymodalss.style.display = "none";
                                          }
                                   }
                            );
                     }

                     $("#button-starttime").on('click', function() {
                            Webcam.snap(function(data_uri) {
                                   image = data_uri;
                            });

                                   $.ajax({
                                          url: 'action.php',
                                          type: 'POST',
                                          data: {
                                                 emp_no: emp_no,
                                                 geolocation: geolocation,
                                                 geolocation2: geolocation2,
                                                 tipe: '1',
                                                 image: image
                                          },
                                          success: function(data) {
                                                 if (emp_no == "") {
                                                        mymodalss.style.display = "none";
                                                        modals.style.display = "block";
                                                        document.getElementById("msg").innerHTML = "Invalid request response | emp_no is not found";
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
                                                 } else if (image == "") {
                                                        mymodalss.style.display = "none";
                                                        modals.style.display = "block";
                                                        document.getElementById("msg").innerHTML = "Activate your camera";
                                                        return false;
                                                 } else {
                                                        mymodalss.style.display = "none";
                                                        mymodals_withhref.style.display = "block";
                                                        document.getElementById("msg_href").innerHTML = " Successfully Record Attendance";
                                                 }
                                          }
                                   })
                            });
                     });
              });





























              $(document).ready(function() {

                     $("#CreateButtonEndtime").on('click', function() {
                            event.preventDefault();
                            var image = '';
                            var emp_no = $('#emp_no').val();
                            var geolocation = $('#geolocation').val();
                            var geolocation2 = $('#geolocation2').val();
                            var myTimeout = setTimeout(myGreeting, 1000);
                            function myGreeting() {
                                   $("#box_attendances_endtime").load("pages_relation/_pages_attendances.php<?php echo $getPackage; ?>",
                                          function(responseTxt_spv_up, statusTxt_spv_up, jqXHR_spv_up) {
                                                 if (statusTxt_spv_up == "success") {
                                                        $("#box_attendances_endtime").show();
                                                        mymodalss.style.display = "none";
                                                 }
                                          }
                                   );
                            }

                     $("#button-endtime").on('click', function() {
                            Webcam.snap(function(data_uri) {
                                   image = data_uri;
                            });
                                   $.ajax({
                                          url: 'action.php',
                                          type: 'POST',
                                          data: {
                                                 emp_no: emp_no,
                                                 geolocation: geolocation,
                                                 geolocation2: geolocation2,
                                                 tipe: '2',
                                                 image: image
                                          },

                                          success: function(data) {
                                                 if (emp_no == "") {
                                                        mymodalss.style.display = "none";
                                                        modals.style.display = "block";
                                                        document.getElementById("msg").innerHTML = "Invalid request response | emp_no is not found";
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
                                                 } else if (image == "") {
                                                        mymodalss.style.display = "none";
                                                        modals.style.display = "block";
                                                        document.getElementById("msg").innerHTML = "Activate your camera";
                                                        return false;
                                                 } else {
                                                        mymodalss.style.display = "none";
                                                        mymodals_withhref.style.display = "block";
                                                        document.getElementById("msg_href").innerHTML = " Successfully Record Attendance";
                                                 }
                                          }
                                   })
                            });
                     });
              });





























              $(document).ready(function() {

                     $("#CreateButtonTimesheet").on('click', function() {
                            event.preventDefault();
                            var image = '';
                            var emp_no = $('#emp_no').val();
                            var geolocation = $('#geolocation_timesheet').val();
                            var geolocation2 = $('#geolocation_timesheet2').val();
                            
                            
                            var myTimeout = setTimeout(myGreeting, 1000);
                            function myGreeting() {
                                   $("#box_timesheet").load("pages_relation/_pages_attendances.php<?php echo $getPackage; ?>",
                                          function(responseTxt_spv_up, statusTxt_spv_up, jqXHR_spv_up) {
                                                 if (statusTxt_spv_up == "success") {
                                                        $("#box_timesheet").show();
                                                        mymodalss.style.display = "none";
                                                 }
                                          }
                                   );
                            }

                            $("#button-timesheet").on('click', function() {
                                          var inp_customre_name = $('#inp_customre_name').val();
                                          var inp_information = $('#inp_information').val();
                                          var inp_region = $('#inp_region').val();
                                          var timesheet = $('#inp_region').val();
                                          var checkedCount = $('input[class="timesheet"]:checked').length;

                                          var update = [];

                                          $('input:checkbox[name^="timesheet[]"]:checked').each(function(i) {
                                                 update[i] = $(this).val();
                                          });

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
                                          } else {
                                                 Webcam.snap(function(data_uri) {
                                                 image = data_uri;
                                          });

                                                 $.ajax({
                                                        url: 'timesheet.php',
                                                        type: 'POST',
                                                        data: {
                                                               emp_no: emp_no,
                                                               geolocation: geolocation,
                                                               geolocation2: geolocation2,
                                                               inp_customre_name : inp_customre_name,
                                                               inp_region : inp_region,
                                                               inp_information : inp_information,
                                                               image: image,
                                                               timesheet : update
                                                        },

                                                        success: function(data) {

                                                               if (emp_no == "") {
                                                                      mymodalss.style.display = "none";
                                                                      modals.style.display = "block";
                                                                      document.getElementById("msg").innerHTML = "Invalid request response | emp_no is not found";
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
                                                               } else if (image == "") {
                                                                      mymodalss.style.display = "none";
                                                                      modals.style.display = "block";
                                                                      document.getElementById("msg").innerHTML = "Activate your camera";
                                                                      return false;
                                                               } else {
                                                                      mymodalss.style.display = "none";
                                                                      mymodals_withhref.style.display = "block";
                                                                      document.getElementById("msg_href").innerHTML = " Successfully Record Attendance";
                                                               }
                                                        }
                                                 })
                                          }
                                   });
                            });
              });

















































       function NewsDetail(id = null) {

              mymodalss.style.display = "block";



              if (id) {

                     $.ajax({

                            url: 'php_action/getSelectedNews.php<?php echo $getPackage; ?>',

                            type: 'post',

                            data: {

                                   news_id: id

                            },

                            dataType: 'json',

                            success: function(response) {





                                   mymodalss.style.display = "none";

                                   document.getElementById("news_content").innerHTML = response.isi_berita;





                            } // /success

                     }); // /fetch selected member info

              } else {

                     alert("Error : Refresh the page again");

              }

       }





       function BalancesDetail(id = null) {

              mymodalss.style.display = "block";



              if (id) {

                     $.ajax({

                            url: 'php_action/getSelectedBalances.php<?php echo $getPackage; ?>',

                            type: 'POST',

                            data: {

                                   leave_balance: id,

                                   emp_id: <?php echo $username; ?>

                            },

                            dataType: 'json',

                            success: function(response, statusRes, jqXHR) {



                                   $("#box_leave").load("pages_relation/_pages_leave.php?rfid=" + response.empgetleave_id + "&emp_id=" + response.emp_id + "&lcode=" + response.leave_code,

                                          function(responseTxt, statusTxt, jqXHR) {

                                                 if (statusTxt == "success") {

                                                        mymodalss.style.display = "none";

                                                        $("#box_leave").show();

                                                 } else {

                                                        mymodalss.style.display = "none";

                                                 }



                                          }

                                   );



                            }, // /succes

                     }); // /fetch selected member info

              } else {

                     alert("Error : Refresh the page again");

              }

       }











































































       $(document).ready(function() {

              var limit = 100;

              var start = 0;

              var action = 'inactive';



              function load_country_data_s(limit, start) {

                     $.ajax({

                            url: "../../view/da/VMDashboardDispensationList.php<?php echo $getPackage; ?>",

                            method: "POST",

                            data: {

                                   limit: limit,

                                   start: start <?php echo $frameworks; ?>,

                            },

                            cache: false,

                            success: function(data) {

                                   $('#req_dispensation').append(

                                          data);

                                   if (data == '') {

                                          $('#example3_message')

                                                 .html(

                                                        "<button type='button' class='btn btn-info'>No Data Found</button>"

                                                 );

                                          action = 'active';

                                   } else {

                                          $('#example3_message')

                                                 .html(

                                                        "<button type='button' class='btn btn-warning'>Please Wait....</button>"

                                                 );

                                          action = "inactive";

                                   }

                            }

                     });

              }



              if (action == 'inactive') {

                     action = 'active';

                     load_country_data_s(limit, start);

              }

              $(window).scroll(function() {

                     if ($(window).scrollTop() + $(window).height() >

                            420 && action == 'inactive') {

                            action = 'active';

                            start = start + limit;

                            setTimeout(function() {

                                   load_country_data_s(

                                          limit,

                                          start);

                            }, 1000);

                     }

              });



       });
</script>