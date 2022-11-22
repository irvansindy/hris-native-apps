<?php  
       $src_startdate                   = '';
       $src_enddate                = '';
       if (!empty($_POST['src_startdate']) && !empty($_POST['src_enddate'])) {
              $src_startdate            = $_POST['src_startdate'];
              $src_enddate         = $_POST['src_enddate'];
              $frameworks                   = "?emp_id="."".$username."&src_startdate="."".$src_startdate."&src_enddate="."".$src_enddate."";
       } else if (empty($_POST['src_startdate']) && !empty($_POST['src_enddate'])) {
              $src_startdate            = $_POST['src_startdate'];
              $src_enddate         = $_POST['src_enddate'];
              $frameworks                   = "?emp_id="."".$username."&src_enddate="."".$src_enddate."";
       } else if (!empty($_POST['src_startdate']) && empty($_POST['src_enddate'])) {
              $src_startdate            = $_POST['src_startdate'];
              $src_enddate         = $_POST['src_enddate'];
              $frameworks                   = "?emp_id="."".$username."&src_startdate="."".$src_startdate."";
       } else {
              $frameworks                   = "?emp_id="."".$username."";
       }

?>
<!-- Modal -->
<div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2"
       data-backdrop="false">
       <div class="modal-dialog" role="document">
              <div class="modal-content">
                     <div class="modal-body">

                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                            <form method="post" id="myform">
                                   <fieldset id="fset_1"
                                          style="margin-top: 25px;border-radius: 5px;border: 1px solid #e4e8ea;">
                                          <legend>Searching</legend>
                                          <div class="form-row">
                                                 <div class="col-4 name">Start Date </div>
                                                 <div class="col-sm-8">
                                                        <div class="input-group">

                                                               <input type="text" id="src_startdate"
                                                                      class="input--style-6"
                                                                      value="<?php echo $src_startdate; ?>"
                                                                      name="src_startdate" style="
                                                                                                  background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                                                  background-size: 17px;
                                                                                                  background-position:right;   
                                                                                                  background-repeat:no-repeat; 
                                                                                                  padding-right:10px;  
                                                                                                  " />
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-4 name">End Date </div>
                                                 <div class="col-sm-8">
                                                        <div class="input-group">

                                                               <input type="text" id="src_enddate"
                                                                      class="input--style-6"
                                                                      value="<?php echo $src_enddate; ?>"
                                                                      name="src_enddate" style="
                                                                                                  background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                                                  background-size: 17px;
                                                                                                  background-position:right;   
                                                                                                  background-repeat:no-repeat; 
                                                                                                  padding-right:10px;  
                                                                                                  " />
                                                        </div>
                                                 </div>
                                          </div>

                                   </fieldset>
                                   <button type="submit" name="submit_add" id="submit_add" type="button"
                                          class="btn btn-warning button_bot">
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
<script type="text/javascript"
       src="../../asset/sdk_datatables_core/datatables/bedanihbuatjson/bootstrap/js/bootstrap.min.js"></script>
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
                     [0, "DESC"]
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
              "ajax": "php_action/FuncDataRead.php<?php echo $frameworks; ?>"
       });
});
</script>




<div class="col-md-12">
       <div class="card">
              <div class="card-header d-flex align-items-center">
                     <h4 class="card-title mb-0">Attendance Correction Approval </h4>


                     <div class="card-actions ml-auto">
                            <table>
                                   <td>
                                          <a href='#' class='open_modal_search' class="btn btn-demo" data-toggle="modal"
                                                 data-target="#myModal2">
                                                 <div class="toolbar sprite-toolbar-search" id="SEARCH" title="Search">
                                                 </div>
                                          </a>
                                   </td>
                                   <td>
                                          <div class="toolbar sprite-toolbar-reload" id="RELOAD" title="Reload"
                                                 onclick="RefreshPage();">
                                          </div>
                                   </td>
                            </table>
                     </div>
              </div>

              <div class="card-body table-responsive p-0"
                     style="width: 100vw;height: 78vh; width: 99.1%; margin: 5px;overflow: scroll;">
                     <table id="datatable" width="68%" border="1" align="left"
                            class="table table-bordered table-striped table-hover table-head-fixed">
                            <thead>
                                   <tr>
                                          <th class="fontCustom"
                                                 style="z-index: 1;vertical-align: ce;vertical-align: middle;">
                                                 Attend Date</th>
                                          <th class="fontCustom"
                                                 style="z-index: 1;vertical-align: ce;vertical-align: middle;">
                                                 Emp No</th>
                                          <th class="fontCustom"
                                                 style="z-index: 1;vertical-align: ce;vertical-align: middle;">
                                                 Full Name</th>
                                          <th class="fontCustom"
                                                 style="z-index:1;vertical-align: ce;vertical-align: middle;">Day Type
                                          </th>
                                          <th class="fontCustom"
                                                 style="z-index:1;vertical-align: ce;vertical-align: middle;">Status In
                                          </th>
                                          <th class="fontCustom"
                                                 style="z-index:1;vertical-align: ce;vertical-align: middle;">Status Out
                                          </th>
                                          <th class="fontCustom"
                                                 style="z-index: 1;vertical-align: ce;vertical-align: middle;">
                                                 Action
                                          </th>
                                   </tr>
                            </thead>
                     </table>

              </div>

              <div class='card-footer' style='background-color: #eee;height: 37px;padding-top: 5px;'>



              </div>

       </div>
</div>





































<!-- edit modal -->
<div class="modal  fade fade-custom" tabindex="-1" role="dialog" id="UpdateForm">
       <div class="modal-dialog modal-belakang modal-bs" role="document">

              <div class="modal-content">
                     <div class="modal-header">
                            <h4 class="modal-title">Add attendance correction request</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <!-- <form class="form-horizontal" action="php_action/FuncDataUpdate.php" method="POST" id="updateMemberForm"> -->
                     <form class="form-horizontal" action="php_action/FuncDataUpdate.php" method="POST"
                            id="FormDisplayUpdate">

                            <fieldset id="fset_1">
                                   <legend>Reason for outzone</legend>

                                   <div class="messages_create"></div>

                                   <div class="form-row">
                                          <div class="col-4 name"> Attend id<span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group" id="sel_identity">
                                                 </div>
                                                 <input type="hidden" id="sel_emp" name="sel_emp"
                                                        value="<?php echo $username; ?>">
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name">Reason <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">


                                                        <input type="hidden" id="sel_attend_id" name="sel_attend_id">
                                                        <textarea class="input--style-6" autocomplete="off"
                                                               autofocus="on" id="sel_remark" name="sel_remark"
                                                               type="Text" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;width: 100%;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title=""></textarea>
                                                 </div>
                                          </div>
                                   </div>


                            </fieldset>

                            <div class="modal-footer">
                                   <button type="reset" class="btn btn-primary1" data-dismiss="modal"
                                          aria-hidden="true">
                                          &nbsp;Cancel&nbsp;
                                   </button>
                                   <button class="btn btn-warning" type="submit" name="submit_update"
                                          id="submit_update">
                                          Approved
                                   </button>
                                   <button class="btn btn-warning" type="button" name="submit_update2"
                                          id="submit_update2" style='display:none;' disabled>
                                          <span class="spinner-grow spinner-grow-sm" role="status"
                                                 aria-hidden="true"></span>
                                          &nbsp;&nbsp;Processing..
                                   </button>
                            </div>
                     </form>


              </div>

              </form>
       </div><!-- /.modal-content -->
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
function editMember(id = null) {
       if (id) {
              // remove the error 
              $(".form-group").removeClass('has-error').removeClass('has-success');
              $(".text-danger").remove();
              // empty the message div
              $(".messages_update").html("");

              // remove the id
              $("#member_id").remove();

              modalss.style.display ="block";
             
              // fetch the member data
              $.ajax({
                     url: 'php_action/getSelectedEmployee.php',
                     type: 'post',
                     data: {
                            member_id: id
                     },
            
                     dataType: 'json',

                     success: function(response) {

                            modalss.style.display ="none";

                            document.getElementById("sel_identity").innerHTML = response.attend_id;
                            
                            $("#sel_attend_id").val(response.attend_id);
                            $("#sel_remark").val(response.remark_in);
                            
                            // here update the member data
                            $("#FormDisplayUpdate").unbind('submit').bind('submit', function() {
                                   // remove error messages
                                   $(".text-danger").remove();

                                   var form = $(this);

                                   var sel_attend_id                  = $("#sel_attend_id").val();
                                   var sel_remark                     = $("#sel_remark").val();

                                   if (sel_remark == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "remark cannot empty";
                                   } else {
                                          $('#submit_update').hide();
                                          $('#submit_update2').show();
                                   }


                                   if (sel_remark) {

                                          $.ajax({
                                                 
                                                 url: form.attr('action'),
                                                 type: form.attr('method'),
                                                 // data: form.serialize(),

                                                 data: new FormData(this),
                                                 processData: false,
                                                 contentType: false,

                                                 dataType: 'json',
                                                 success: function(response) {

                                                        if (response.code =='success_message') {
                                                               

                                                               $('#submit_update').show();
                                                               $('#submit_update2').hide();

                                                               $('#FormDisplayUpdate').modal('hide');  
                                                               $("[data-dismiss=modal]").trigger({type: "click"});      
                                                        
                                                               // reload the datatables
                                                               datatable.ajax.reload(null,false);
                                                               // reload the datatables
                                                               
                                                               modals.style.display = "block";
                                                               document.getElementById("msg").innerHTML =response.messages;
                                                        } else {

                                                               $('#submit_update').show();
                                                               $('#submit_update2').hide();

                                                               modals.style.display = "block";
                                                               document.getElementById("msg").innerHTML = response.messages;
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
       $('#inp_birthdate').bootstrapMaterialDatePicker({
              time: false,
              clearButton: true
       });

       $('#inp_joindate').bootstrapMaterialDatePicker({
              time: false,
              clearButton: true
       });

       $('#src_startdate').bootstrapMaterialDatePicker({
              time: false,
              clearButton: true
       });

       $('#src_enddate').bootstrapMaterialDatePicker({
              time: false,
              clearButton: true
       });
});
</script>
<script>
jQuery(function($) {
       $("#nip").mask("99-9999");
       $("#nik").mask("9999999999999999");
       $("#join").mask("9999-99-99");
       $("#date").mask("9999-99-99");
       $("#account").mask("9999-9-99999-9");
});
</script>

<script type="text/javascript">
function isi_otomatis() {
       var nip = $("#nip").val();
       $.ajax({
              url: 'ajax_cek.php',
              data: "nip=" + nip,
       }).success(function(data) {
              var json = data,
                     obj = JSON.parse(json);
              $('#nama').val(obj.nama);
              $('#nik').val(obj.nik);
              $('#org').val(obj.org);
              $('#emp').val(obj.emp);
              $('#join').val(obj.join);
              $('#account').val(obj.account);
              $('#norek').val(obj.norek);
              $('#approve').val(obj.approve);
              $('#grp').val(obj.grp);
              $('#jobstatus').val(obj.jobstatus);
       });
}
</script>

<script type="text/javascript">
var tree4 = $("#test-select-4").treeMultiselect({
       allowBatchSelection: true,
       enableSelectAll: true,
       searchable: true,
       sortable: true,
       startCollapsed: false,
});
</script>





<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>