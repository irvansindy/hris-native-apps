<?php
$src_training_request                     = '';
$src_training_request_cancel              = '';
if (!empty($_POST['src_training_request']) && !empty($_POST['src_training_request_cancel'])) {
       $src_training_request              = $_POST['src_training_request'];
       $src_training_request_cancel       = $_POST['src_training_request_cancel'];
       $frameworks                        = "src_training_request=" . "" . $src_training_request . " &&src_training_request_cancel=" . "" . $src_training_request_cancel . "";
} else if (empty($_POST['src_training_request']) && !empty($_POST['src_training_request_cancel'])) {
       $src_training_request              = $_POST['src_training_request'];
       $src_training_request_cancel       = $_POST['src_training_request_cancel'];
       $frameworks                        = "src_training_request_cancel=" . "" . $src_training_request_cancel . "";
} else if (!empty($_POST['src_training_request']) && empty($_POST['src_training_request_cancel'])) {
       $src_training_request              = $_POST['src_training_request'];
       $src_training_request_cancel       = $_POST['src_training_request_cancel'];
       $frameworks                        = "src_training_request=" . "" . $src_training_request . "";
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
                                                 <div class="col-4 name">Training Request</div>
                                                 <div class="col-lg-8">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="src_training_request" name="src_training_request" id="src_training_request" type="Text" value="<?php echo $src_training_request; ?>" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row" style="display:none;">
                                                 <div class="col-4 name">Leave Cancel Request</div>
                                                 <div class="col-lg-8">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off" autofocus="on" name="src_training_request_cancel" id="src_training_request_cancel" type="Text" value="<?php echo $src_training_request_cancel; ?>" onfocus="hlentry(this)" size="30" maxlength="50" validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                                        </div>
                                                 </div>
                                          </div>

                                   </fieldset>
                                   <button type="submit" name="submit_add" id="submit_add" type="button" class="btn btn-warning button_bot">
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


<script type="text/javascript">
       $(document).ready(function() {
              $('#inp_add_startdate').bootstrapMaterialDatePicker({
                     time: false,
                     clearButton: true
              });

              $('#inp_add_enddate').bootstrapMaterialDatePicker({
                     time: false,
                     clearButton: true
              });

              $('#inp_pdtype_starttime').bootstrapMaterialDatePicker({
                     date: false,
                     format: 'HH:mm'
              });

              $('#inp_pdtype_endtime').bootstrapMaterialDatePicker({
                     date: false,
                     format: 'HH:mm'
              });
       });
</script>

<!-- isi JSON -->
<script type="text/javascript">
       // global the manage memeber table 
       $(document).ready(function() {
              datatable = $("#datatable").DataTable({

                     dom: "B<'row'<'col-lg-12 col-md-9'l><'col-lg-12 col-md-9'f>>" +
                            "<'row'<'col-lg-12'tr>>" +
                            "<'row'<'col-lg-12 col-md-6'i><'col-lg-12 col-md-7'p>>",

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
                     destroy: true,
                     "ajax": "php_action/FuncDataRead.php<?php echo $getPackage; ?><?php echo $frameworks; ?>"
              });
       });
</script>



<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>


<div class="col-md-12">
       <div class="card">
              <div class="card-header d-flex align-items-center">
                     <h4 class="card-title mb-0">Training Request </h4>


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
                                   <!-- AgusPrass 02/03/2021 -->

                                   <td>
                                          <div class="toolbar sprite-toolbar-add" title="Add" data-toggle="modal" data-target="#CreateForm" id="CreateButton" data-keyboard="false" data-backdrop="static">
                                                 <!-- <a title="add" href="" class="toolbar sprite-toolbar-add" data-toggle="modal" data-target="#CreateForm" id="CreateButton" data-keyboard="false" data-backdrop="static">tambah</a> -->
                                          </div>
                                   </td>

                            </table>



                     </div>
              </div>

          


              <div class="card-body table-responsive p-0" style="width: 100vw;height: 78vh; width: 98.8%; margin: 5px;overflow: scroll;">
                     <table id="datatable" width="100%" border="1" align="left" class="table table-bordered table-striped table-hover table-head-fixed">
                            <thead>
                                   <tr>
                                          <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No.</th>
                                          <th class="fontCustom" style="z-index: 1;">Request No.</th>
                                          <th class="fontCustom" style="z-index: 1;">Training Type</th>
                                          <th class="fontCustom" style="z-index: 1;">Training Course</th>
                                          <th class="fontCustom" style="z-index: 1;">Start Date</th>
                                          <th class="fontCustom" style="z-index: 1;">End Date</th>
                                          <th class="fontCustom" style="z-index: 1;">Reason</th>
                                          <th class="fontCustom" style="z-index: 1;">Approval Status</th>
                                          <th class="fontCustom" style="z-index: 1;">Cancellation Status</th>
                                   </tr>

                            </thead>
                     </table>

              </div>

              <div class='card-footer' style='background-color: #eee;height: 37px;padding-top: 5px;'>
              </div>

       </div>
</div>











<!-- add modal -->
<div class="modal  fade fade-custom" tabindex="-1" role="dialog" id="CreateForm">
       <div class="modal-dialog modal-belakang modal-bg" role="document">
              <div class="modal-content">
                     <div class="modal-header">
                            <h4 class="modal-title" id="revised_title">Add Training Request</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <form class="form-horizontal" method="POST" id="FormDisplayCreate"  onkeydown="return event.key != 'Enter';">

                            <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

                                   <fieldset id="fset_1">
                                          <legend>Training Entry Form</legend>

                                          <div class="messages_create"></div>
                                          
                                          <div class="form-row" id="frm_employee_no">
                                                 <div class="col-lg-3 name">Training Category <font color="red">*</font>
                                                 </div>
                                                 <div class="col-lg-4">
                                                        <div class="input-group">
                                                               <input type="hidden" name="inp_emp_no" value="<?php echo $username; ?>">
                                                               <input class="input--style-6 search-input" 
                                                                      onfocus="this.value=''" 
                                                                      autocomplete="off" 
                                                                      id="inp_training_category" 
                                                                      name="inp_training_category" 
                                                                      type="Text" 
                                                                      value="" 
                                                                      title=""
                                                                      onchange="select_add_category()">

                                                                      <div id="category_add_list"></div>

                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row" id="frm_employee_no" style="display: none">
                                                 <div class="col-lg-3 name">Show Training Related My Job Title Only
                                                 </div>
                                                 <div class="col-lg-4">
                                                        <div class="input-group">
                                                               <input class="input--style-6 search-input" 
                                                                      onfocus="this.value=''" 
                                                                      autocomplete="off" 
                                                                      id="inp_related"
                                                                      name="inp_related"
                                                                      type="Text"
                                                                      value=""
                                                                      title="">
                                                        </div>
                                                 </div>
                                          </div>
                                          
                                          <div class="form-row" id="frm_inp_course" style="display:none;">
                                                 <div class="col-lg-3 name">Training Course <font color="red">*</font>
                                                 </div>
                                                 <div class="col-lg-8">
                                                        <div class="input-group">
                                                               <div id="box_add_training_topic"></div>
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row" id="frm_employee_no">
                                                 <div class="col-lg-3 name">Training Topic <font color="red">*</font>
                                                 </div>
                                                 <div class="col-lg-4">
                                                        <div class="input-group">
                                                               <input class="input--style-6 search-input" 
                                                                      onfocus="this.value=''" 
                                                                      autocomplete="off" 
                                                                      id="inp_topic" 
                                                                      name="inp_topic" 
                                                                      type="Text" 
                                                                      value="" 
                                                                      title="">

                                                               

                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row" id="frm_employee_no">
                                                 <div class="col-lg-3 name">Date Between <font color="red">*</font>
                                                 </div>
                                                 <div class="col-lg-3">
                                                        <div class="input-group">
                                                               <input type="text" 
                                                                      id="inp_add_startdate"
                                                                      name="inp_add_startdate" 
                                                                      class="input--style-6"
                                                                      placeholder="Start Date"
                                                                      style="background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                             background-size: 17px;
                                                                             background-position:right;   
                                                                             background-repeat:no-repeat; 
                                                                             padding-right:10px;"
                                                                      autocomplete="off"/>
                                                        </div>
                                                 </div>

                                                 <div class="col-lg-3">
                                                        <div class="input-group">
                                                               <input type="text" 
                                                                      id="inp_add_enddate"
                                                                      name="inp_add_enddate" 
                                                                      class="input--style-6"
                                                                      placeholder="End Date"
                                                                      style="background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                             background-size: 17px;
                                                                             background-position:right;   
                                                                             background-repeat:no-repeat; 
                                                                             padding-right:10px;"
                                                                      autocomplete="off"/>
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row" id="show_employees">
                                                 <div class="col-3 name">Employee</div>                          
                                                 <div class="col-lg-8">
                                                        <div class="card-body table-responsive p-0" style="width: 100vw;height: 30vh; width: 100%; overflow: scroll;overflow-x: hidden;border:1px solid #d2d2d2;border-radius: 4px;">
                                                               <div id="box_add_employee"></div>
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row" id="frm_employee_no">
                                                 <div class="col-lg-3 name">Training Venue <font color="red">*</font>
                                                 </div>
                                                 <div class="col-lg-4">
                                                        <div class="input-group">
                                                               <input class="input--style-6 search-input" 
                                                                      onfocus="this.value=''" 
                                                                      autocomplete="off" 
                                                                      id="inp_venue" 
                                                                      name="inp_venue" 
                                                                      type="Text" 
                                                                      value="" 
                                                                      title="">

                                                                      <div id="venue_add_list"></div>
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row" id="frm_employee_no">
                                                 <div class="col-lg-3 name">Room <font color="red">*</font>
                                                 </div>
                                                 <div class="col-lg-4">
                                                        <div class="input-group">
                                                               <input class="input--style-6 search-input" 
                                                                      onfocus="this.value=''" 
                                                                      autocomplete="off" 
                                                                      id="inp_room" 
                                                                      name="inp_room" 
                                                                      type="Text" 
                                                                      value="" 
                                                                      title="">

                                                               

                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row" id="frm_employee_no">
                                                 <div class="col-lg-3 name">Estimated Cost <font color="red">*</font>
                                                 </div>
                                                 <div class="col-lg-4">
                                                        <div class="input-group">
                                                               <input class="input--style-6 search-input" 
                                                                      onfocus="this.value=''" 
                                                                      autocomplete="off" 
                                                                      id="inp_cost" 
                                                                      name="inp_cost" 
                                                                      type="Text" 
                                                                      value="" 
                                                                      title="">

                                                               

                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row" id="frm_employee_no">
                                                 <div class="col-lg-3 name">Reason For Request <font color="red">*</font>
                                                 </div>
                                                 <div class="col-lg-4">
                                                        <div class="input-group">
                                                               <textarea class="input--style-6 search-input" 
                                                                      onfocus="this.value=''" 
                                                                      autocomplete="off" 
                                                                      id="inp_reason" 
                                                                      name="inp_reason" 
                                                                      title=""></textarea>

                                                               

                                                        </div>
                                                 </div>
                                          </div>
                               
                                         
                                   </fieldset>

                            </div>

                            <!-- //LOAD BUTTON APPROVER STATUS -->
                            <div class="modal-footer-sdk" id="modalcancelcondition_0" style="display:none">
                                   <button type="reset" class="btn-sdk btn-primary-left" data-dismiss="modal" aria-hidden="true">
                                          &nbsp;Cancel&nbsp;
                                   </button>
                                   <button class="btn-sdk btn-primary-right" type="submit" name="submit_update" id="submit_update">
                                          Confirm
                                   </button>
                            </div>
                            <div class="modal-footer-sdk" id="modalcancelcondition_1">
                                   <div type="reset" class="shine btn-sdk btn-primary-center-only" data-dismiss="modal"
                                          style="padding-top: 8px;"
                                          aria-hidden="true">
                                          &nbsp;Close&nbsp;
                                   </div>
                            </div>
                            <div class="modal-footer-sdk" id="modalcancelcondition_2" style="display:none">
                                   <button type="reset" class="btn-sdk btn-primary-center-only" data-dismiss="modal"
                                          aria-hidden="true">
                                          &nbsp;Close&nbsp;
                                   </button>
                            </div>
                            <div class="modal-footer-sdk" id="modalcancelcondition_3" style="display:none">
                                   <button type="reset" class="btn-sdk btn-primary-not-only-left" data-dismiss="modal"
                                          aria-hidden="true">
                                          &nbsp;Cancel&nbsp;
                                   </button>
                                   <button class="btn-sdk btn-primary-center-not-only" type="submit" name="submit_update" id="submit_update">
                                          Confirm
                                   </button>
                                   <a id="cancellation_id" style="padding-top: 8px;" class="btn-sdk btn-primary-not-only-right delete" type="submit" name="submit_delete" id="submit_delete">
                                          Cancel
                                   </a>
                            </div>

                            
                            <!-- //LOAD BUTTON APPROVER STATUS -->

                            <!-- ==================================================================================================== -->
                            <!-- ==================================================================================================== -->
                            <input id="inp_emp_no" name="inp_emp_no" type="hidden" value="<?php echo $username; ?>">
                            <!--FROM SESSION -->
                            <input id="inp_token" name="inp_token" type="hidden" value="<?php echo $get_token; ?>">
                            <!--FROM CONFIGURATION -->
                            <input id="inp_requestfor" name="inp_requestfor" type="hidden">
                            <!--FROM CONFIGURATION -->
                            <input id="inp_leaverequestv" name="inp_leaverequestv" type="hidden">
                            <!--FROM CONFIGURATION -->
                            <input id="inp_daytype" name="inp_daytype" type="hidden">
                            <!--FROM CONFIGURATION -->
                            <input id="inp_summaryleavebalance" name="inp_summaryleavebalance" type="hidden">
                            <!--FROM CONFIGURATION -->
                            <input id="inp_deductedleave" name="inp_deductedleave" type="hidden">
                            <!--FROM CONFIGURATION -->
                            <!-- ==================================================================================================== -->
                            <!-- ==================================================================================================== -->

                     </form>
              </div>
       </div>
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /edit modal -->









































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




<!-- isi JSON -->
<script type="text/javascript">
      
       // global the manage memeber table 
       $(document).ready(function() {
              $("#CreateButton").on('click', function() {
                     $('#frm_inp_course').hide();

                     mymodalss.style.display = "block";
        
                     document.getElementById("revised_title").innerHTML = "Add Training Request";
                     // reset the form

                     $("#request_no").remove();
              
                     $("#FormDisplayCreate")[0].reset();

                     $("#modalcancelcondition_0").show();    
                     $("#modalcancelcondition_1").hide();    
                     $("#modalcancelcondition_2").hide();  
                     $("#modalcancelcondition_3").hide(); 
                     // empty the message div


                     $("#box_add_employee").load("pages_relation/_pages_add_employee.php?rfid=",
                            function(responseTxt, statusTxt, jqXHR){
                                   if(statusTxt == "success"){
                                          $("#box_add_employee").show();
                                          if($("#box_add_employee").show()) {
                                                 mymodalss.style.display = "none";
                                          }
                                   }
                                   if(statusTxt == "error"){
                                          alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                   }
                            }
                     );

                     // submit form

                     $("#FormDisplayCreate").unbind('submit').bind('submit', function() {

                            mymodalss.style.display = "block";

                            $(".text-danger").remove();

                            var form = $(this);

                            var inp_emp_no              = $("#inp_emp_no").val();
                            var inp_training_category   = $("#inp_training_category").val();
                            var inp_topic               = $("#inp_topic").val();
                            var inp_add_startdate       = $("#inp_add_startdate").val();
                            var inp_add_enddate         = $("#inp_add_enddate").val();
                            var from                    = new Date(inp_add_startdate).getTime();
                            var to                      = new Date(inp_add_enddate).getTime();
                            var inp_venue               = $("#inp_venue").val();
                            var inp_room                = $("#inp_room").val();
                            var inp_cost                = $("#inp_cost").val();
                            var inp_reason              = $("#inp_reason").val();

                            var regex = /^[a-zA-Z]+$/;

                            if (from > to) {
                                   mymodalss.style.display = "none";
                                   modals.style.display ="block";
                                   document.getElementById("msg").innerHTML = "Entry Date: Enter Date in Proper Range";
                                   return false;

                            } else if (inp_training_category == "") {
                                   mymodalss.style.display = "none";
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Please choose training category";
                                   return false;
                            
                            } else if (!$("input[name='inp_course']:checked").val()) {
                                   mymodalss.style.display = "none";
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Please choose training course";
                                   return false;
                            
                            } else if (inp_topic == "") {
                                   mymodalss.style.display = "none";
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Training topic cannot empty";
                                   return false;

                            } else if (inp_add_startdate == "") {
                                   mymodalss.style.display = "none";
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Start date cannot empty";
                                   return false;

                            } else if (inp_add_enddate == "") {
                                   mymodalss.style.display = "none";
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "End date cannot empty";
                                   return false;

                            } else if (inp_emp_no == "") {
                                   mymodalss.style.display = "none";
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Employee no cannot empty";
                                   return false;
                            
                            } else if (inp_venue == "") {
                                   mymodalss.style.display = "none";
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Venue cannot empty";
                                   return false;

                            } else if (inp_room == "") {
                                   mymodalss.style.display = "none";
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Room cannot empty";
                                   return false;

                            } else if (inp_cost == "" ) {
                                   mymodalss.style.display = "none";
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Estimated cost cannot empty";
                                   return false;

                            } else if (inp_reason == "") {
                                   mymodalss.style.display = "none";
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Reason cannot empty";
                                   return false;

                            } else {
                                   //submi the form to server
                                   $.ajax({
                                          url: "php_action/FuncDataCreate.php<?php echo $getPackage; ?>",
                                          type: form.attr('method'),
                                          // data: form.serialize(),

                                          data: new FormData(this),
                                          processData: false,
                                          contentType: false,

                                          dataType: 'json',
                                          success: function(response) {

                                                 // remove the error 
                                                 $(".form-group").removeClass('has-error').removeClass('has-success');

                                                 if (response.code == 'success_message') {
                                                        mymodalss.style.display = "none";
                                                        modals.style.display ="block";
                                                        document.getElementById("msg").innerHTML = response.messages;

                                                        $("[data-dismiss=modal]").trigger({type: "click"});   

                                                        // reset the form
                                                        $("#FormDisplayCreate")[0].reset();
                                                        // reload the datatables
                                                        datatable.ajax.reload(null,false);
                                                        // this function is built in function of datatables;
                                                 } else {
                                                        mymodalss.style.display = "none";
                                                        modals.style.display = "block";
                                                        document.getElementById("msg").innerHTML = response.messages;
                                                 } // /else
                                          } // success  
                                   }); // ajax subit 				
           
                                   return false;
                            }

                     }); // /submit form for create member
              }); // /add modal
       });














































       

function update_training(id = null) {

       mymodalss.style.display = "block";
       $('#inp_training_category').removeAttr('onfocus');
       $('#inp_topic').removeAttr('onfocus');
       $('#inp_add_startdate').removeAttr('onfocus');
       $('#inp_add_enddate').removeAttr('onfocus');
       $('#inp_venue').removeAttr('onfocus');
       $('#inp_room').removeAttr('onfocus');
       $('#inp_cost').removeAttr('onfocus');
       $('#inp_reason').removeAttr('onfocus');

       if(id) {
       
              $.ajax({
                     url: 'php_action/getSelectedRequest.php<?php echo $getPackage; ?>',
                     type: 'post',
                     data: {member_id : id},
                     dataType: 'json',
                     success:function(response) {

                            $("#cancellation_id").attr("data-id", response.request_no);

                                   $.ajax({
                                          url: 'php_action/getRequestStatus.php<?php echo $getPackage; ?>',
                                          type: 'post',
                                          data: {request_no : response.request_no},
                                          dataType: 'json',
                                          success:function(response) {
                                                        
                                                        mymodalss.style.display = "none";
                                   
                                                        if(response.status_request == 1) {
                                                               $("#modalcancelcondition_0").hide();    
                                                               $("#modalcancelcondition_1").hide();    
                                                               $("#modalcancelcondition_2").hide();  
                                                               $("#modalcancelcondition_3").show();    
                                                        } else {
                                                               $("#modalcancelcondition_0").hide();    
                                                               $("#modalcancelcondition_1").hide(); 
                                                               $("#modalcancelcondition_2").show();
                                                               $("#modalcancelcondition_3").hide();       
                                                        }
                                                 }
                                   }); // /ajax

                                   $("#FormDisplayCreate").append('<input type="hidden" name="request_no" id="request_no" value="'+response.request_no+'"/>');

                                   document.getElementById("revised_title").innerHTML = "Update Training Request : " + response.request_no;
                            
                                   $("#inp_training_category").val(response.sel_categoryname);
                                   $("#inp_topic").val(response.training_topic);
                                   $("#inp_add_startdate").val(response.startdate);
                                   $("#inp_add_enddate").val(response.enddate);
                                   $("#inp_venue").val(response.venues);
                                   $("#inp_room").val(response.room);
                                   $("#inp_cost").val(response.training_cost);
                                   $("#inp_reason").val(response.reason);
                                   
                                   $("#box_add_employee").load("pages_relation/_pages_add_employee.php?rfid=" + response.request_no,
                                          function(responseTxt, statusTxt, jqXHR){
                                                 if(statusTxt == "success"){
                                                        $("#box_add_employee").show();
                                                        if($("#box_add_employee").show()) {
                                                               mymodalss.style.display = "none";
                                                        }
                                                 }
                                                 if(statusTxt == "error"){
                                                        alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                                 }
                                          }
                                   );

                                   $('#frm_inp_course').show();
                 
                                   $("#box_add_training_topic").load("pages_relation/_pages_topic.php<?php echo $getPackage; ?>rfid=" + response.training_category + "&sfid=" + response.training_course, 
                                          function(responseTxt, statusTxt, jqXHR){
                                                 if(statusTxt == "success"){
                                                        $("#box_add_training_topic").show();
                                                 }
                                                 if(statusTxt == "error"){
                                                        alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                                 }
                                          }
                                   );

                                   $("#FormDisplayCreate").unbind('submit').bind('submit', function() {

                                          mymodalss.style.display = "block";
                            
                                          var form = $(this);

                                          var request_no              = $("#request_no").val();
                                          var inp_emp_no              = $("#inp_emp_no").val();
                                          var inp_training_category   = $("#inp_training_category").val();
                                          var inp_topic               = $("#inp_topic").val();
                                          var inp_add_startdate       = $("#inp_add_startdate").val();
                                          var inp_add_enddate         = $("#inp_add_enddate").val();
                                          var from                    = new Date(inp_add_startdate).getTime();
                                          var to                      = new Date(inp_add_enddate).getTime();
                                          var inp_venue               = $("#inp_venue").val();
                                          var inp_room                = $("#inp_room").val();
                                          var inp_cost                = $("#inp_cost").val();
                                          var inp_reason              = $("#inp_reason").val();

                                          var regex = /^[a-zA-Z]+$/;

                                          if (request_no == "") {
                                                 mymodalss.style.display = "none";
                                                 modals.style.display ="block";
                                                 document.getElementById("msg").innerHTML = "Request No. cannot empty";
                                                 return false;

                                          } else if (from > to) {
                                                 mymodalss.style.display = "none";
                                                 modals.style.display ="block";
                                                 document.getElementById("msg").innerHTML = "Entry Date: Enter Date in Proper Range";
                                                 return false;

                                          } else if (inp_training_category == "") {
                                                 mymodalss.style.display = "none";
                                                 modals.style.display = "block";
                                                 document.getElementById("msg").innerHTML = "Please choose training category";
                                                 return false;
                                          
                                          } else if (!$("input[name='inp_course']:checked").val()) {
                                                 mymodalss.style.display = "none";
                                                 modals.style.display = "block";
                                                 document.getElementById("msg").innerHTML = "Please choose training course";
                                                 return false;
                                          
                                          } else if (inp_topic == "") {
                                                 mymodalss.style.display = "none";
                                                 modals.style.display = "block";
                                                 document.getElementById("msg").innerHTML = "Training topic cannot empty";
                                                 return false;

                                          } else if (inp_add_startdate == "") {
                                                 mymodalss.style.display = "none";
                                                 modals.style.display = "block";
                                                 document.getElementById("msg").innerHTML = "Start date cannot empty";
                                                 return false;

                                          } else if (inp_add_enddate == "") {
                                                 mymodalss.style.display = "none";
                                                 modals.style.display = "block";
                                                 document.getElementById("msg").innerHTML = "End date cannot empty";
                                                 return false;

                                          } else if (inp_emp_no == "") {
                                                 mymodalss.style.display = "none";
                                                 modals.style.display = "block";
                                                 document.getElementById("msg").innerHTML = "Employee no cannot empty";
                                                 return false;
                                          
                                          } else if (inp_venue == "") {
                                                 mymodalss.style.display = "none";
                                                 modals.style.display = "block";
                                                 document.getElementById("msg").innerHTML = "Venue cannot empty";
                                                 return false;

                                          } else if (inp_room == "") {
                                                 mymodalss.style.display = "none";
                                                 modals.style.display = "block";
                                                 document.getElementById("msg").innerHTML = "Room cannot empty";
                                                 return false;

                                          } else if (inp_cost == "" ) {
                                                 mymodalss.style.display = "none";
                                                 modals.style.display = "block";
                                                 document.getElementById("msg").innerHTML = "Estimated cost cannot empty";
                                                 return false;

                                          } else if (inp_reason == "") {
                                                 mymodalss.style.display = "none";
                                                 modals.style.display = "block";
                                                 document.getElementById("msg").innerHTML = "Reason cannot empty";
                                                 return false;

                                          } else {

                                                 $.ajax({
                                                               url: "php_action/FuncDataUpdate.php<?php echo $getPackage; ?>",
                                                               type: form.attr('method'),
                                                               data: form.serialize(),
                                                               dataType: 'json',
                                                               success:function(response) {
                                                                      if (response.code == 'success_message') {
                                                                             
                                                                             mymodalss.style.display = "none";
                                                                             modals.style.display ="block";
                                                                             document.getElementById("msg").innerHTML = response.messages;

                                                                             $("#request_no").remove();

                                                                             $("[data-dismiss=modal]").trigger({type: "click"});   

                                                                             // reset the form
                                                                             $("#FormDisplayCreate")[0].reset();
                                                                             // reload the datatables
                                                                             datatable.ajax.reload(null,false);
                                                                             // this function is built in function of datatables;
                                                                      } else {
                                                                             mymodalss.style.display = "none";
                                                                             modals.style.display = "block";
                                                                             document.getElementById("msg").innerHTML = response.messages;
                                                                      } // /else
                                                               } // /success
                                                        }); // /ajax
                                                 return false;
                                          }
                            });
                     } // /success
              }); // /fetch selected member info
       
       // Delete if exist
       $('.delete').click(function(){
       var el = this;
       
       // Delete id
       var deleteid = $(this).data('id');
       
       var confirmalert = confirm("Are you sure to cancel request?");
       if (confirmalert == true) {
       // AJAX Request
       $.ajax({
              url: 'php_action/FuncDataDelete.php<?php echo $getPackage; ?>id=' + deleteid,
              type: 'GET',
              processData: false,
              contentType: false,
              dataType: 'json',
              success: function(response){
                            if (response.code == 'success_message') {
                                   mymodals_withhref.style.display = "block";
                                   document.getElementById("msg_href").innerHTML = response.messages;
                            } else {
                                   mymodals_withhref.style.display = "block";
                                   document.getElementById("msg_href").innerHTML = response.messages;
                                   return false;
                            }
                     }
                     
              }
              );
       }

       });

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
              $('#inp_add_startdate').bootstrapMaterialDatePicker({
                     time: false,
                     clearButton: true
              });

              $('#inp_add_enddate').bootstrapMaterialDatePicker({
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

              $('#modal_revised_leave_start').bootstrapMaterialDatePicker({
                     time: false,
                     clearButton: true
              });

              $('#modal_revised_leave_end').bootstrapMaterialDatePicker({
                     time: false,
                     clearButton: true
              });

              $('#inp_revised_starttime').bootstrapMaterialDatePicker({
                     date: false,
                     format: 'HH:mm'
              });

              $('#inp_revised_endtime').bootstrapMaterialDatePicker({
                     date: false,
                     format: 'HH:mm'
              });
       });
</script>

<script>
       $(document).ready(function() {
              $('#inp_training_category').focus(function() {
                     var query = $(this).val();
                     if (query != '') {
                            $.ajax({
                                   url: "search_category.php<?php echo $getPackage; ?>userid=<?php echo $username; ?>",
                                   method: "POST",
                                   data: {
                                          query: query
                                   },
                                   success: function(data) {
                                          $('#category_add_list').fadeIn();
                                          $('#category_add_list').html(data);
                                          
                                   }
                            });
                     }
              });
              $('#inp_training_category').keyup(function() {
                     var query = $(this).val();
                     if (query != '') {
                            $.ajax({
                                   url: "search_category.php<?php echo $getPackage; ?>userid=<?php echo $username; ?>",
                                   method: "POST",
                                   data: {
                                          query: query
                                   },
                                   success: function(data) {
                                          $('#category_add_list').fadeIn();
                                          $('#category_add_list').html(data);
                                          
                                   }
                            });
                     }
              });

              $('#inp_training_category').mouseover(function() {
                     $('#category_add_list').fadeOut();
              });

              $(document).on('click', '.searchterm_category', function() {

                     $('#inp_training_category').val($(this).text());

                     $('#category_add_list').fadeOut();

                     var inp_training_category   = document.getElementById("inp_training_category").value;

               

                     var myarr = inp_training_category.split(" - ");
              
                     var myvar = myarr[0];


                     $('#frm_inp_course').show();
                 
                     $("#box_add_training_topic").load("pages_relation/_pages_topic.php<?php echo $getPackage; ?>rfid=" + myvar, 
                            function(responseTxt, statusTxt, jqXHR){
                                   if(statusTxt == "success"){
                      
                                          $("#box_add_training_topic").show();
                                   }
                                   if(statusTxt == "error"){
                                          alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                   }
                            }
                     );

              });
       });






       $(document).ready(function() {
              $('#inp_venue').focus(function() {
                     var query = $(this).val();
                     if (query != '') {
                            $.ajax({
                                   url: "search_venue.php<?php echo $getPackage; ?>userid=<?php echo $username; ?>",
                                   method: "POST",
                                   data: {
                                          query: query
                                   },
                                   success: function(data) {
                                          $('#venue_add_list').fadeIn();
                                          $('#venue_add_list').html(data);
                                   }
                            });
                     }
              });
              $('#inp_venue').keyup(function() {
                     var query = $(this).val();
                     if (query != '') {
                            $.ajax({
                                   url: "search_venue.php<?php echo $getPackage; ?>userid=<?php echo $username; ?>",
                                   method: "POST",
                                   data: {
                                          query: query
                                   },
                                   success: function(data) {
                                          $('#venue_add_list').fadeIn();
                                          $('#venue_add_list').html(data);
                                          
                                   }
                            });
                     }
              });

              $('#inp_venue').mouseover(function() {
                     $('#venue_add_list').fadeOut();
              });

              $(document).on('click', '.searchterm_venue', function() {

                     $('#inp_venue').val($(this).text());

                     $('#venue_add_list').fadeOut();

                     var inp_venue   = document.getElementById("inp_venue").value;

               

                     var myarr = inp_venue.split(" - ");
              
                     var myvar = myarr[0];

              });
       });
</script>


