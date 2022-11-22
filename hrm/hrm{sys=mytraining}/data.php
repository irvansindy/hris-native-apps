<?php
$src_emp_no                = '';
if (!empty($_POST['src_emp_no'])) {
       $src_emp_no         = $_POST['src_emp_no'];
       $frameworks          = "?username=$username" . "&src_emp_no=" . "" . $src_emp_no . "";
} else {
       $frameworks          = "?username=$username";
}
?>
<!-- Modal -->
<div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" data-backdrop="false">
       <div class="modal-dialog" role="document">
              <div class="modal-content">
                     <div class="modal-body">

                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                            <form method="post" id="myform">
                                   <fieldset id="fset_1" style="margin-top: 25px;border-radius: 5px;border: 1px solid #e4e8ea;">
                                          <legend>Searching</legend>
                                          <div class="form-row">
                                                 <div class="col-4 name">Employee No. </div>
                                                 <div class="col-sm-8">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="src_emp_no" name="src_emp_no" id="src_emp_no" type="Text" value="<?php echo $src_emp_no; ?>" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                                        </div>
                                                 </div>
                                          </div>
                                   </fieldset>
                                   <button type="submit" name="submit_search" id="submit_search" type="button" class="btn btn-warning button_bot">
                                          Filter
                                   </button>
                            </form>
                     </div>

              </div><!-- modal-content -->
       </div><!-- modal-dialog -->
</div><!-- modal -->





<!-- MAIN DATATABLE SERVERSIDE CSS -->
<!-- MAIN DATATABLE SERVERSIDE CSS -->
<script type="text/javascript" src="../../asset/sdk_datatables_core/gt_dist/jQuery-2.1.4.min.js"></script>
<script type="text/javascript" src="../../asset/sdk_datatables_core/datatables/bedanihbuatjson/bootstrap/js/bootstrap.min.js"></script>
<!-- MAIN DATATABLE SERVERSIDE CSS -->
<!-- MAIN DATATABLE SERVERSIDE CSS -->

<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>
</script>
<script type="text/javascript">
       $(document).ready(function() {
              $('#inp_birthdate').bootstrapMaterialDatePicker({
                     time: false,
                     clearButton: true
              });

              $('#inp_joindate').bootstrapMaterialDatePicker({
                     time: false,
                     clearButton: true
              });

              $('#sel_joindate').bootstrapMaterialDatePicker({
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
              $('#settlement_birth_date').bootstrapMaterialDatePicker({
                     time: false,
                     clearButton: true
              });
              $('#family_birth_date').bootstrapMaterialDatePicker({
                     time: false,
                     clearButton: true
              });
       });
</script>



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

       $(document).ready(function() {
              datatable = $("#datatable_family").DataTable({

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
                     bAutoWidth: true,
                     language: {
                            "processing": "Please wait..",
                     },
                     columnDefs: [{
                            orderable: false,
                            targets: 0
                     }],
                     destroy: true,
                     "ajax": "php_action/FuncDataReadFamily.php<?php echo $frameworks; ?>"
              });
       });
</script>





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




<div class="col-md-12">
       <div class="card">
              <div class="card-header d-flex align-items-center" style="border-bottom: 1px solid white;">
                     <h4 class="card-title mb-0">MY Training </h4>



                     <div class="card-actions ml-auto">
                            <table>
                                   <td>

                                          <a href='#' class='open_modal_search' class="btn btn-demo" data-toggle="modal" data-target="#myModal2">
                                                 <div class="toolbar sprite-toolbar-search" id="SEARCH" title="Search">
                                                 </div>
                                          </a>



                                   </td>
                                   <!-- AgusPrass 02/03/2021 Menghapus # pada href-->
                                   <td>
                                          <div class="toolbar sprite-toolbar-reload" id="RELOAD" title="Reload" onclick="RefreshPage();">
                                          </div>




                                   </td>

                            </table>
                     </div>
              </div>





              <!DOCTYPE html>
              <html>

              <head>
                     <meta name="viewport" content="width=device-width, initial-scale=1">
                     <style>
                            body {
                                   font-family: Arial;
                            }

                            /* Style the tab */
                            .tab {
                                   overflow: hidden;
                                   border: 1px solid #f5f5f5;
                                   border-bottom-color: rgb(245, 245, 245);
                                   border-bottom-style: solid;
                                   border-bottom-width: 1px;
                                   background-color: #f5f5f5;
                                   border-bottom: 1px solid #ccc;
                            }

                            /* Style the buttons inside the tab */
                            .tab a {
                                   background-color: inherit;
                                   float: left;
                                   border: none;
                                   outline: none;
                                   cursor: pointer;
                                   padding: 14px 16px;
                                   transition: 0.3s;
                                   font-size: 12px;
                                   border-bottom: 3px solid #f5f5f5;
                            }

                            /* Change background color of buttons on hover */
                            .tab a:hover {
                                   background-color: #f5f5f5;
                                   border-bottom: 3px solid #e8eaec;
                            }

                            /* Create an active/current tablink class */
                            .tab a.active {
                                   background-color: #f5f5f5;
                                   border-bottom: 3px solid #1890ff;
                            }

                            /* Style the tab content */
                            .tabcontent {
                                   display: none;
                                   padding: 6px 12px;
                                   border: 1px solid #ccc;
                                   border-top: none;
                            }
                     </style>



                     <div class="card-body table-responsive p-0" style="width: 100vw;height: 78vh; width: 98.8%; margin: 5px;overflow: scroll;">
                            <table id="datatable" width="100%" border="1" align="left" class="table table-bordered table-striped table-hover table-head-fixed">
                                   <thead>
                                          <tr>
                                                 <th class="fontCustom" style="z-index: 1;padding-right: 30px;" nowrap="nowrap">No.</th>
                                                 <th class="fontCustom" style="z-index: 1;padding-right: 30px;">Training Request No.</th>
                                                 <th class="fontCustom" style="z-index: 1;padding-right: 30px;">Training Course</th>
                                                 <th class="fontCustom" style="z-index: 1;padding-right: 30px;">Training Topic</th>
                                                 <th class="fontCustom" style="z-index: 1;padding-right: 30px;">Start Date</th>
                                                 <th class="fontCustom" style="z-index: 1;padding-right: 30px;">End Date</th>
                                                 <th class="fontCustom" style="z-index: 1;padding-right: 30px;">Type</th>
                                                 <th class="fontCustom" style="z-index: 1;padding-right: 30px;">Provider</th>
                                                 <th class="fontCustom" style="z-index: 1;padding-right: 30px;">Attendance</th>
                                                 <th class="fontCustom" style="z-index: 1;padding-right: 30px;">Feedback</th>
                                                 <th class="fontCustom" style="z-index: 1;padding-right: 30px;">Has Evaluation Stage</th>
                                                 <th class="fontCustom" style="z-index: 1;padding-right: 30px;">Print Certificate</th>
                                                 <th class="fontCustom" style="z-index: 1;padding-right: 30px;">Training Status</th>
                                          </tr>
                                   </thead>
                            </table>
                     </div>
              </div>
       </div>












































<!-- add modal -->
<div class="modal  fade fade-custom" tabindex="-1" role="dialog" id="FormChooseTest">
       <div class="modal-dialog modal-belakang modal-bg" role="document">
              <div class="modal-content">
                     <div class="modal-header">
                            <h4 class="modal-title">Select Test</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <form class="form-horizontal" action="php_action/FuncDataCreate.php<?php echo $getPackage; ?>" method="POST" id="NewsDetail">

                            <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">
                                   <div class="form-row" id="frm_employee_no">

                                          <div class="col-lg-6 col-md-6 col-xl-2">
                                                 <!-- Card -->
                                                 <div class="card">
                                                        <img class="card-img-top img-responsive" src="../../asset/dist/img/img3.jpg" alt="Card image cap">
                                                        <div class="card-body">
                                                               <a href="javascript:void(0)" id="submit_pretest" class="btn btn-primary">PRE TEST</a>
                                                               <p class="card-text">
                                                                      Pre-test merupakan tes yang dilakukan untuk mengukur kemampuan awal penerima latihan sebelum mengikuti kegiatan pembelajaran<br><br>
                                                               </p>

                                                        </div>
                                                 </div>
                                                 <!-- Card -->
                                          </div>

                                          <div class="col-lg-6 col-md-6 col-xl-2">
                                                 <!-- Card -->
                                                 <div class="card">
                                                        <img class="card-img-top img-responsive" src="../../asset/dist/img/img3.jpg" alt="Card image cap">
                                                        <div class="card-body">

                                                               <a href="javascript:void(0)" id="submit_postest" class="btn btn-primary">POST TEST</a>
                                                               <p class="card-text">
                                                                      Post-test adalah suatu evaluasi akhir dalam bentuk pertanyaan yang penulis berikan kepada masyarakat sasaran setelah pelajaran/materi telah tersampaikan
                                                               </p>

                                                        </div>
                                                 </div>
                                                 <!-- Card -->
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
<div class="modal  fade fade-custom" tabindex="-1" role="dialog" id="Certificate">
                     <div class="modal-dialog modal-belakang modal-bg" role="document">
                            <div class="modal-content">
                                   <div class="modal-header">
                                          <h4 class="modal-title">Certificate</h4>
                                          <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                                 <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                                          </a>
                                   </div>

                                   <form class="form-horizontal" action="php_action/FuncDataCreate.php<?php echo $getPackage; ?>" method="POST" id="FormDisplayCreate">

                                          <input type="hidden" class="form-control" name="emp_no" id="emp_no" value="<?php echo $username; ?>" required>
                                          <input type="hidden" name="geolocation" id="div_isi" value="asd">
                                          <input type="hidden" name="geolocation2" id="div_isi2" value="asd">

                                          <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">
                                                 <!-- <fieldset id="fset_1">
                                                        <img src="../../asset/certificate/Screenshot 2022-09-16 084108.png">
                                                 </fieldset> -->
                                                 <fieldset id="fset_1">
                                                        <div class="form-row" id="frm_employee_no">
                                                               <div class="col-sm-12 name">
                                                                      <div id="box_certificate"></div>
                                                               </div>
                                                        </div>
                                                 </fieldset>
                                          </div>
                                          <div class="modal-footer-sdk" style="box-shadow: 0 .5rem 1rem rgba(0,0,0,.15) !important;">
                                                 <button type="reset" class="btn-sdk btn-primary-center-only" data-dismiss="modal" aria-hidden="true">
                                                        &nbsp;Close&nbsp;
                                                 </button>
                                          </div>
                                   </form>
                            </div>
                     </div>
              </div><!-- /.modal-dialog -->
       </div><!-- /.modal -->
       <!-- /edit modal -->









































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
                                          <input type="hidden" name="geolocation" id="div_isi" value="asd">
                                          <input type="hidden" name="geolocation2" id="div_isi2" value="asd">

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



























































<!-- Modal -->
<div class="modal right fade" id="modalSettlement" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" data-backdrop="false">
       <div class="modal-dialog" role="document" style="top: 0px;width: 100%;">
              <div class="modal-content">
                     <div class="modal-body">

                            <button type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;opacity: inherit;">

                                   <img src="../../asset/dist/img/images.png" style="width: 26px;">
                            </button>
                            
                            <link rel="stylesheet" href="asset/style_question.css"/>

                            <!--PEN CONTENT     -->
                            <div class="content">
                                   <!--content inner-->
                                   <div class="content__inner">
                                          <div class="container">
                                                 <!--multisteps-form-->

                                                 <!--form panels-->
                                                 <div class="row">
                                                        <div class="col-12" style="top: 20px;">
                                                               <form class="form-horizontal" action="php_action/FuncDataCreateAnswer.php" method="POST" id="FormSettlement" onkeydown="return event.key != 'Enter';">

                                                                      <div class=" shadow p-4 rounded bg-white" data-animation="scaleIn" style="border-radius: 0px !important;">
                                                                             <h3 class="">PRETEST</h3>
                                                                             <div class="">
                                                                                    <input class="input--style-6" id="settlement_emp_id" name="settlement_emp_id" id="settlement_emp_id" type="hidden" onfocus="hlentry(this)" size="30" maxlength="50">
                                                                                    <div class="card-body table-responsive p-0" style="height: 65vh; width: 98.8%; margin: 5px;overflow-y: auto;overflow-x: hidden;border: 1px solid white;">
                                                                                           <div class="col-lg-12">
                                                                                                  <div id="form_question"></div>
                                                                                           </div>
                                                                                    </div>
                                                                             </div>
                                                                      </div>

                                                                      <div class="modal-footer-sdk" id="modalcancelcondition_0" style="box-shadow: 0 .5rem 1rem rgba(0,0,0,.15) !important;">
                                                                             <div type="reset" class="shine btn-sdk btn-primary-center-only" style="padding-top: 10px;" data-dismiss="modal" aria-hidden="true">
                                                                                    &nbsp;Close&nbsp;
                                                                             </div>
                                                                      </div>
                                                                      <div class="modal-footer-sdk" id="modalcancelcondition_1" style="display:none;box-shadow: 0 .5rem 1rem rgba(0,0,0,.15) !important;">
                                                                             <button type="reset" class="btn-sdk btn-primary-center-only" data-dismiss="modal" aria-hidden="true">
                                                                                    &nbsp;Close&nbsp;
                                                                             </button>
                                                                      </div>
                                                                      <div class="modal-footer-sdk" id="modalcancelcondition_2" style="display:none;box-shadow: 0 .5rem 1rem rgba(0,0,0,.15) !important;">
                                                                             <button type="reset" class="btn-sdk btn-primary-left" data-dismiss="modal" aria-hidden="true">
                                                                                    &nbsp;Cancel&nbsp;
                                                                             </button>
                                                                             <button class="btn-sdk btn-primary-right" type="submit" name="submit_update_test" id="submit_update_test">
                                                                                    Confirm
                                                                             </button>
                                                                      </div>
                                                        </div>
                                                        </form>
                                                 </div>

                                          </div>
                                   </div>
                            </div>
                     </div>
              </div>

       </div><!-- modal-content -->
</div><!-- modal-dialog -->
</div><!-- modal -->































































































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






































<script language="JavaScript">
       Webcam.set({
              image_format: 'jpeg',
              jpeg_quality: 130
       });
       Webcam.attach('#my_camera');
</script>



<!-- isi JSON -->
<script type="text/javascript">
      



       function settlement(id = null) {
              mymodalss.style.display = "block";
              if (id) {

                     var myarr = id.split("#");

                     var myvar = myarr[0];
                     var myvar2 = myarr[1];
                     var myvar3 = myarr[2];
                     var myvar4 = myarr[3];

                     // remove the error 
                     $(".form-group").removeClass('has-error').removeClass('has-success');

                     // mymodalss.style.display = "block";
                     $(".text-danger").remove();

                     // empty the message div
                     $(".messages_update").html("");

                     // remove the id
                     $("#member_id").remove();

                     // fetch the member data
                     $.ajax({
                            url: 'php_action/getSelectedQuestionForTraining.php',
                            type: 'POST',
                            data: {
                                   request_no: myvar,
                                   emp_id: myvar2,
                                   training_category: myvar3,
                                   question_type: myvar4
                            },
                            dataType: 'json',

                            success: function(response) {

                                   $("#settlement_emp_id").val(response.emp_id);

                                   $("#form_question").load("pages_relation/_pages_attachment.php<?php echo $getPackage; ?>employee=" + myvar2 + "&requestno=" + myvar + "&category=" + myvar3 + "&question_type=" + myvar4,
                                          function(responseTxt, statusTxt, jqXHR) {
                                                 if (statusTxt == "success") {
                                                        $("#form_question").show();
                                                        mymodalss.style.display = "none";
                                                 }
                                                 if (statusTxt == "error") {
                                                        alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                                 }
                                          }
                                   );

                                   $.ajax({
                                          url: 'php_action/getExistingAnswer.php',
                                          type: 'POST',
                                          data: {
                                                 request_no: myvar,
                                                 emp_id: myvar2,
                                                 training_category: myvar3,
                                                 question_type: myvar4
                                          },
                                          dataType: 'json',
                                          success: function(response) {

                                                 mymodalss.style.display = "none";

                                                 if (response.total_answer == 0) {
                                                        $("#modalcancelcondition_0").hide();
                                                        $("#modalcancelcondition_1").hide();
                                                        $("#modalcancelcondition_2").show();
                                                 } else {
                                                        $("#modalcancelcondition_0").hide();
                                                        $("#modalcancelcondition_1").show();
                                                        $("#modalcancelcondition_2").hide();
                                                 }

                                          }
                                   });
                                   return false;
                            } // /success
                     }); // /fetch selected member info
              } else {
                     alert("Error : Refresh the page again");
              }
       }

       // chooseTest





































       function CreateButtonStarttime(id = null) {
              mymodalss.style.display = "block";
              if (id) {


                     event.preventDefault();
                     var image = '';
                     var emp_no = $('#emp_no').val();
                     var geolocation = $('#div_isi').val();
                     var geolocation2 = $('#div_isi2').val();

                     var myarr = id.split("#");

                     var myvar = myarr[0];
                     var myvar2 = myarr[1];
                     var myvar3 = myarr[2];
                     var myvar4 = myarr[3];

                     var myTimeout = setTimeout(myGreeting, 1000);

                     function myGreeting() {
                            $("#box_attendances_starttime").load("pages_relation/_pages_attendances.php",
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
                                          image: image,
                                          request_no: myvar,
                                          emp_id: myvar2,
                                          training_category: myvar3,
                                          question_type: myvar4
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

              
              } else {
                     alert("Error : Refresh the page again");
              }
       }

       // 





















































       function chooseTest(id = null) {

              if (id) {


                     var myarr = id.split("#");

                     var myvar = myarr[0];
                     var myvar2 = myarr[1];
                     var myvar3 = myarr[2];
                     var myvar4 = myarr[3];

                     // remove the error 
                     $(".form-group").removeClass('has-error').removeClass('has-success');
                     // mymodalss.style.display = "block";
                     $(".text-danger").remove();
                     // empty the message div
                     $(".messages_update").html("");

                     // remove the id
                     $("#member_id").remove();

                     // fetch the member data
                     $.ajax({
                            url: 'php_action/getSelectedQuestionForTraining.php',
                            type: 'POST',
                            data: {
                                   request_no: myvar,
                                   emp_id: myvar2,
                                   training_category: myvar3,
                                   training_course: myvar4
                            },
                            dataType: 'json',

                            success: function(response) {

                                   $("#settlement_emp_id").val(response.emp_id);

                                   $("#submit_pretest").attr("onclick", "settlement(`" + myvar + '#' + myvar2 + '#' + myvar3 + '#PRETEST' + "`)");
                                   $("#submit_pretest").attr("data-toggle", "modal");
                                   $("#submit_pretest").attr("data-target", "#modalSettlement");

                                   $("#submit_postest").attr("onclick", "settlement(`" + myvar + '#' + myvar2 + '#' + myvar3 + '#POSTTEST' + "`)");
                                   $("#submit_postest").attr("data-toggle", "modal");
                                   $("#submit_postest").attr("data-target", "#modalSettlement");
                            } // /success
                     }); // /fetch selected member info
              } else {
                     alert("Error : Refresh the page again");
              }
       }
























       function Certificate(id = null) {

       if (id) {
              var myarr = id.split("#");
              var myvar = myarr[0];
              var myvar2 = myarr[1];
              var myvar3 = myarr[2];
              var myvar4 = myarr[3];


                     $("#box_certificate").load("pages_relation/_pages_certificate.php<?php echo $getPackage; ?>employee=" + myvar2 + "&requestno=" + myvar + "&category=" + myvar3 + "&course=" + myvar4,
                            function(responseTxt, statusTxt, jqXHR) {
                                   if (statusTxt == "success") {
                                          $("#box_certificate").show();
                                          mymodalss.style.display = "none";
                                   }
                                   if (statusTxt == "error") {
                                          alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                   }
                            }
                     );

              } else {
                     alert("Error : Refresh the page again");
              }
       }
</script>
<!-- isi JSONs -->
</body>

</html>

<link rel="stylesheet" href="asset/w3schools28.css">
<link rel="stylesheet" href="asset/style_photo.css">





<!-- Jquery JS -->
<script src="asset/jquery-1.js"></script>
<!-- bootStrap JS -->
<script src="asset/bootstrap.js"></script>
<!-- Plugin Custom JS -->
<script src="asset/form-wizard.js"></script>
<!-- Plugin Custom JS -->

<script type="text/javascript">
       $('#classic').click(function() {
              $('.form-wizard').addClass("form-header-classic").removeClass(
                     "form-header-stylist form-header-modarn");
       });

       $('#modarn').click(function() {
              $('.form-wizard').addClass("form-header-modarn").removeClass(
                     "form-header-classic form-header-stylist");
       });

       $('#stylist').click(function() {
              $('.form-wizard').addClass("form-header-stylist").removeClass(
                     "form-header-classic form-header-modarn");
       });
</script>

<script type="text/javascript">
       $('#classic-body').click(function() {
              $('.form-wizard').addClass("form-body-classic").removeClass(
                     "form-body-stylist form-body-material");
       });

       $('#material-body').click(function() {
              $('.form-wizard').addClass("form-body-material").removeClass(
                     "form-body-classic form-body-stylist");
       });

       $('#stylist-body').click(function() {
              $('.form-wizard').addClass("form-body-stylist").removeClass(
                     "form-body-classic form-body-material");
       });
</script>

<script>
       document.querySelector("html").classList.add('js');

       var fileInput = document.querySelector(".input-file"),
              button = document.querySelector(".input-file-trigger"),
              the_return = document.querySelector(".file-return");

       button.addEventListener("keydown", function(event) {
              if (event.keyCode == 13 || event.keyCode == 32) {
                     fileInput.focus();
              }
       });
       button.addEventListener("click", function(event) {
              fileInput.focus();
              return false;
       });
       fileInput.addEventListener("change", function(event) {
              the_return.innerHTML = this.value;
       });
</script>



<script>
       $(document).ready(function() {
              $(document).on('change', '#file', function() {
                     var name = document.getElementById("file").files[0].name;
                     var uploadField1 = document.getElementById("file");

                     var form_data = new FormData();
                     var ext = name.split('.').pop().toLowerCase();

                     var allowedFiles = [".doc", ".jpg", ".jpeg", ".ods", ".png", ".txt", ".doc", ".pdf"]
                     var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");

                     var oFReader = new FileReader();
                     oFReader.readAsDataURL(document.getElementById("file").files[0]);
                     var f = document.getElementById("file").files[0];
                     var fsize = f.size || f.fileSize;
                     if (!regex.test(uploadField1.value.toLowerCase())) {
                            modals.style.display = "block";
                            document.getElementById("msg").innerHTML = "File Tidak Diijinkan";
                     } else if (fsize > 3145728) {
                            modals.style.display = "block";
                            document.getElementById("msg").innerHTML = "Dokumen terlalu besar maksimum besar file 3MB";
                            return false;
                     } else {
                            form_data.append("file", document.getElementById('file').files[0]);
                            $.ajax({
                                   url: "uploader_dokumen.php?&code=1&token=<?php echo $username; ?>",
                                   method: "POST",
                                   data: form_data,
                                   contentType: false,
                                   cache: false,
                                   processData: false,
                                   beforeSend: function() {
                                          $('#uploaded_image').html("<img src='../../asset/dist/img/loading.gif' style='max-width: 10%;margin-top: 20px;'>");
                                   },
                                   success: function(data) {
                                          $('#uploaded_image').html(data);
                                   }
                            });
                     }
              });
       });
</script>


<script>
       $(document).ready(function() {
              $(document).on('change', '#file2', function() {
                     var name = document.getElementById("file2").files[0].name;
                     var uploadField2 = document.getElementById("file2");

                     var form_data = new FormData();
                     var ext = name.split('.').pop().toLowerCase();

                     var allowedFiles = [".doc", ".jpg", ".jpeg", ".ods", ".png", ".txt", ".doc", ".pdf"]
                     var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");

                     //   if(!regex.test(uploadField2.value.toLowerCase())) 
                     //   {
                     //    alert("Invalid Image File");
                     //   }
                     var oFReader = new FileReader();
                     oFReader.readAsDataURL(document.getElementById("file2").files[0]);
                     var f = document.getElementById("file2").files[0];
                     var fsize = f.size || f.fileSize;
                     if (!regex.test(uploadField2.value.toLowerCase())) {
                            modals.style.display = "block";
                            document.getElementById("msg").innerHTML = "File Tidak Diijinkan";
                     } else if (fsize > 3145728) {
                            modals.style.display = "block";
                            document.getElementById("msg").innerHTML = "Dokumen terlalu besar maksimum besar file 3MB";
                            return false;
                     } else {
                            form_data.append("file2", document.getElementById('file2').files[0]);
                            $.ajax({
                                   url: "uploader_dokumen.php?&code=2&token=<?php echo $username; ?>",
                                   method: "POST",
                                   data: form_data,
                                   contentType: false,
                                   cache: false,
                                   processData: false,
                                   beforeSend: function() {
                                          $('#uploaded_image2').html("<img src='../../asset/dist/img/loading.gif' style='max-width: 10%;margin-top: 20px;'>");
                                   },
                                   success: function(data) {
                                          $('#uploaded_image2').html(data);
                                   }
                            });
                     }
              });
       });
</script>


<script>
       $(document).ready(function() {
              $(document).on('change', '#file3', function() {
                     var name = document.getElementById("file3").files[0].name;
                     var uploadField3 = document.getElementById("file3");

                     var form_data = new FormData();
                     var ext = name.split('.').pop().toLowerCase();

                     var allowedFiles = [".doc", ".jpg", ".jpeg", ".ods", ".png", ".txt", ".doc", ".pdf"]
                     var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");

                     //   if(!regex.test(uploadField3.value.toLowerCase())) 
                     //   {
                     //    alert("Invalid Image File");
                     //   }
                     var oFReader = new FileReader();
                     oFReader.readAsDataURL(document.getElementById("file3").files[0]);
                     var f = document.getElementById("file3").files[0];
                     var fsize = f.size || f.fileSize;
                     if (!regex.test(uploadField3.value.toLowerCase())) {
                            modals.style.display = "block";
                            document.getElementById("msg").innerHTML = "File Tidak Diijinkan";
                     } else if (fsize > 3145728) {
                            modals.style.display = "block";
                            document.getElementById("msg").innerHTML = "Dokumen terlalu besar maksimum besar file 3MB";
                            return false;
                     } else {
                            form_data.append("file3", document.getElementById('file3').files[0]);
                            $.ajax({
                                   url: "uploader_dokumen.php?&code=3&token=<?php echo $username; ?>",
                                   method: "POST",
                                   data: form_data,
                                   contentType: false,
                                   cache: false,
                                   processData: false,
                                   beforeSend: function() {
                                          $('#uploaded_image3').html("<img src='../../asset/dist/img/loading.gif' style='max-width: 10%;margin-top: 20px;'>");
                                   },
                                   success: function(data) {
                                          $('#uploaded_image3').html(data);
                                   }
                            });
                     }
              });
       });
</script>





<script>
       $(document).ready(function() {
              $(document).on('change', '#file4', function() {
                     var name = document.getElementById("file4").files[0].name;
                     var uploadField4 = document.getElementById("file4");

                     var form_data = new FormData();
                     var ext = name.split('.').pop().toLowerCase();

                     var allowedFiles = [".doc", ".jpg", ".jpeg", ".ods", ".png", ".txt", ".doc", ".pdf"]
                     var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");

                     //   if(!regex.test(uploadField4.value.toLowerCase())) 
                     //   {
                     //    alert("Invalid Image File");
                     //   }
                     var oFReader = new FileReader();
                     oFReader.readAsDataURL(document.getElementById("file4").files[0]);
                     var f = document.getElementById("file4").files[0];
                     var fsize = f.size || f.fileSize;
                     if (!regex.test(uploadField4.value.toLowerCase())) {
                            modals.style.display = "block";
                            document.getElementById("msg").innerHTML = "File Tidak Diijinkan";
                     } else if (fsize > 4145728) {
                            modals.style.display = "block";
                            document.getElementById("msg").innerHTML = "Dokumen terlalu besar maksimum besar file 3MB";
                            return false;
                     } else {
                            form_data.append("file4", document.getElementById('file4').files[0]);
                            $.ajax({
                                   url: "uploader_dokumen.php?&code=4&token=<?php echo $username; ?>",
                                   method: "POST",
                                   data: form_data,
                                   contentType: false,
                                   cache: false,
                                   processData: false,
                                   beforeSend: function() {
                                          $('#uploaded_image4').html("<img src='../../asset/dist/img/loading.gif' style='max-width: 10%;margin-top: 20px;'>");
                                   },
                                   success: function(data) {
                                          $('#uploaded_image4').html(data);
                                   }
                            });
                     }
              });
       });
</script>





<script>
       $(document).ready(function() {
              $(document).on('change', '#file5', function() {
                     var name = document.getElementById("file5").files[0].name;
                     var uploadField4 = document.getElementById("file5");

                     var form_data = new FormData();
                     var ext = name.split('.').pop().toLowerCase();

                     var allowedFiles = [".doc", ".jpg", ".jpeg", ".ods", ".png", ".txt", ".doc", ".pdf"]
                     var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");

                     //   if(!regex.test(uploadField4.value.toLowerCase())) 
                     //   {
                     //    alert("Invalid Image File");
                     //   }
                     var oFReader = new FileReader();
                     oFReader.readAsDataURL(document.getElementById("file5").files[0]);
                     var f = document.getElementById("file5").files[0];
                     var fsize = f.size || f.fileSize;
                     if (!regex.test(uploadField4.value.toLowerCase())) {
                            modals.style.display = "block";
                            document.getElementById("msg").innerHTML = "File Tidak Diijinkan";
                     } else if (fsize > 4145728) {
                            modals.style.display = "block";
                            document.getElementById("msg").innerHTML = "Dokumen terlalu besar maksimum besar file 3MB";
                            return false;
                     } else {
                            form_data.append("file5", document.getElementById('file5').files[0]);
                            $.ajax({
                                   url: "uploader_dokumen.php?&code=5&token=<?php echo $username; ?>",
                                   method: "POST",
                                   data: form_data,
                                   contentType: false,
                                   cache: false,
                                   processData: false,
                                   beforeSend: function() {
                                          $('#uploaded_image5').html("<img src='../../asset/dist/img/loading.gif' style='max-width: 10%;margin-top: 20px;'>");
                                   },
                                   success: function(data) {
                                          $('#uploaded_image5').html(data);
                                   }
                            });
                     }
              });
       });
</script>





<script>
       function removeElement() {
              document.getElementById("imgbox1").style.display = "none";
              document.getElementById("file").value = "";
              document.getElementById("any_file").value = "";
       }

       function removeElement1() {
              document.getElementById("imgbox1a").style.display = "none";
              document.getElementById("file").value = "";
              document.getElementById("any_file").value = "";
       }

       function removeElement2() {
              document.getElementById("imgbox2").style.display = "none";
              document.getElementById("file2").value = "";
              document.getElementById("any_file2").value = "";
       }

       function removeElement2a() {
              document.getElementById("imgbox2a").style.display = "none";
              document.getElementById("file2").value = "";
              document.getElementById("any_file2").value = "";
       }

       function removeElement3() {
              document.getElementById("imgbox3").style.display = "none";
              document.getElementById("file2").value = "";
              document.getElementById("any_file2").value = "";
       }

       function removeElement3a() {
              document.getElementById("imgbox3a").style.display = "none";
              document.getElementById("file3").value = "";
              document.getElementById("any_file3").value = "";
       }

       function removeElement4() {
              document.getElementById("imgbox4").style.display = "none";
              document.getElementById("file4").value = "";
              document.getElementById("any_file4").value = "";
       }

       function removeElement4a() {
              document.getElementById("imgbox4a").style.display = "none";
              document.getElementById("file4").value = "";
              document.getElementById("any_file4").value = "";
       }

       function removeElement5() {
              document.getElementById("imgbox5").style.display = "none";
              document.getElementById("file5").value = "";
              document.getElementById("any_file5").value = "";
       }

       function removeElement5a() {
              document.getElementById("imgbox5a").style.display = "none";
              document.getElementById("file5").value = "";
              document.getElementById("any_file5").value = "";
       }
</script>



<script>
       $(document).ready(function() {
              $('.action_domisili').change(function() {
                     if ($(this).val() != '') {
                            var action_domisili = $(this).attr("id");
                            var query = $(this).val();
                            var result = '';
                            if (action_domisili == "settlement_curcountry") {
                                   result = 'settlement_curprovince';
                                   $('#settlement_curcity').html('<option value="">Select City</option>');
                                   $('#settlement_curdistrict').html('<option value="">Select District</option>');
                                   $('#settlement_cursubdistrict').html('<option value="">Select SubDistrict</option>');
                            } else if (action_domisili == "settlement_curprovince") {
                                   result = 'settlement_curcity';
                                   $('#settlement_curdistrict').html('<option value="">Select District</option>');
                                   $('#settlement_cursubdistrict').html('<option value="">Select SubDistrict</option>');
                            } else if (action_domisili == "settlement_curcity") {
                                   result = 'settlement_curdistrict';
                                   $('#settlement_cursubdistrict').html('<option value="">Select SubDistrict</option>');
                            } else {
                                   result = 'settlement_cursubdistrict';
                            }
                            $.ajax({
                                   url: "fetching/fetch_dynamic_country_city_state_2.php",
                                   method: "POST",
                                   data: {
                                          action_domisili: action_domisili,
                                          query: query
                                   },
                                   success: function(data) {
                                          $('#' + result).html(data);
                                          $('#' + result2).html(data);
                                   }
                            })
                     }
              });
       });
</script>
<!-- SECTION ALAMAT SESUAI DOMISILI -->
<!-- SECTION ALAMAT SESUAI DOMISILI -->


<script src="asset/ckeditor.js"></script>
<script src="asset/js/sample.js"></script>
<script src="asset/js/sampleupdate.js"></script>

<script>
       initSample();
       initSampleUpdate();
</script>


<script>
       function openCity(evt, cityName) {
              var i, tabcontent, tablinks;
              tabcontent = document.getElementsByClassName("tabcontent");
              for (i = 0; i < tabcontent.length; i++) {
                     tabcontent[i].style.display = "none";
              }
              tablinks = document.getElementsByClassName("tablinks");
              for (i = 0; i < tablinks.length; i++) {
                     tablinks[i].className = tablinks[i].className.replace(" active", "");
              }
              document.getElementById(cityName).style.display = "block";
              evt.currentTarget.className += " active";
       }

       // Get the element with id="defaultOpen" and click on it
       document.getElementById("defaultOpen").click();
</script>