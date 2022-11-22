
<table id="datatable" width="99%" border="1" class="table table-bordered table-striped table-hover table-head-fixed">


       <thead>
              <tr>
                     <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No</th>
                     <th class="fontCustom" style="z-index: 1;">Request No</th>
                     <th class="fontCustom" style="z-index: 1;">Employee No</th>
                     <th class="fontCustom" style="z-index: 1;">Requester Name</th>
                     <th class="fontCustom" style="z-index: 1;">Request Type</th>
                     <th class="fontCustom" style="z-index: 1;">Request Date</th>
                     <th class="fontCustom" style="z-index: 1;">Request Status</th>
              </tr>


       </thead>


</table>


<script type="text/javascript" language="javascript">
       $(document).ready(function() {

              // Load data
              dataTable = $("#datatable").DataTable({

                     dom: "B<'row'<'col-sm-12 col-md-9'l><'col-sm-12 col-md-9'f>>" +
                            "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-7'p>>",

                     processing: true,
                     // retrieve: true,
                     searching: true,
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
                     columnDefs: [{

                     }, 
              ],
                     "ajax": "ajax/data_emp_req.php"
              });
              //    Load data
              // Refresh Page
              $("#refresh").click(function(e) {
                     dataTable.ajax.reload();

                     setTimeout(function() {
                            mymodalss.style.display = "none";
                            document.getElementById("msg").innerHTML = "Data refreshed";
                            return false;
                     }, 2000);

                     mymodalss.style.display = "block";
                     document.getElementById("msg").innerHTML = "Data refreshed";
                     return false;

              });
              // Refresh Page






              
       })








       
</script>




<!-- add modal -->
<div class="modal  fade fade-custom" tabindex="-1" role="dialog" id="ApprovalForm">
<div class="modal-dialog modal-belakang modal-bs modal-med" role="document">
              <div class="modal-content">
                     <div class="modal-header">
                            <h4 class="modal-title">Approval</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 99%; margin: 5px;overflow: scroll;overflow-x: hidden;">

                     <form class="form-horizontal" action="php_action/FuncDataUpdate.php<?php echo $getPackage; ?>" method="POST" id="updatedelMemberForm">

                            <fieldset id="fset_1">
                                   <legend>&nbsp;Detail Information&nbsp;</legend>

                                   <div class="messages_create"></div>

                                   <input id="sel_emp_no_approver" name="sel_emp_no_approver" type="hidden" value="<?php echo $username; ?>"><!--FROM SESSION -->
                             
                                   <div class="form-row">
                                          <div class="col-sm-4 name"> Request No. <span class="required">*</span></div>
                                          <div class="col-sm-8 name">
                                          <div class="input-group" id="contoh" style="display:none; font-weight: bold;color: #5b5b5b;">
                                                 </div>       
                                          <div class="input-group" id="sel_identity_request_no" style="font-weight: bold;color: #5b5b5b;">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-sm-4 name"> Employee <span class="required">*</span></div>
                                          <div class="col-sm-8 name">
                                                 <div class="input-group" id="sel_identity_requester" style="font-weight: bold;color: #5b5b5b;">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row" style="display:none">
                                          <div class="col-4 name"> APP Detail <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">
                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_approval_request_no" name="sel_approval_request_no"
                                                               type="Text">
                                                 </div>
                                          </div>
                                   </div>
                                   </fieldset>

                                   <fieldset id="fset_1">
                                   <legend>Approval Detail</legend>
                                                 <div class="card-body table-responsive p-0" style="width: 99%; margin: 1px;overflow: scroll;">
                                                        <!-- pages relation -->
                                                        <div id="box_approval_request_detail"></div>
                                                        <!-- pages relation -->
                                                 <div>
                                   </div>
                                   
                                   </fieldset>
                                 </div>
                            <!-- //LOAD BUTTON APPROVER STATUS -->
                            
                            <div class="modal-footer-sdk" id="modalcancelcondition_0">
                                          <!-- <box class="shine"></box>
                                          <div><lines class="shine"></lines></div> -->

                                          <div type="reset" class="shine btn-sdk btn-primary-center-only" data-dismiss="modal"
                                                 aria-hidden="true">
                                                 &nbsp;Close&nbsp;
                                          </div>
                            </div>
                            <div class="modal-footer-sdk" id="modalcancelcondition_1" style="display:none">
                                          <button type="reset" class="btn-sdk btn-primary-center-only" data-dismiss="modal"
                                                 aria-hidden="true">
                                                 &nbsp;Close&nbsp;
                                          </button>
                            </div>
                            <div class="modal-footer-sdk" id="modalcancelcondition_2" style="display:none">
                                          <button type="reset" class="btn-sdk btn-primary-left" data-dismiss="modal"
                                                 aria-hidden="true">
                                                 &nbsp;Cancel&nbsp;
                                          </button>
                                          <a id="cancellation_id" style="padding-top: 8px;" class="btn-sdk btn-primary-right delete" type="submit" name="submit_update" id="submit_update">
                                                 Cancel Request
                                                        </a>
                            </div>
                            <!-- //LOAD BUTTON APPROVER STATUS -->



                     </form>
              </div>
       </div>
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /edit modal -->




<script>
       
function ApprovalSubmission(id = null) {
mymodalss.style.display = "block";

if(id) {
       $.ajax({
              url: 'php_action/getSelectedRequest.php<?php echo $getPackage; ?>',
              type: 'post',
              data: {member_id : id},
              dataType: 'json',
              success:function(response) {

                     mymodalss.style.display = "none";                     
                                   
                     document.getElementById("sel_identity_request_no").innerHTML = response.request_no;
                     document.getElementById("sel_identity_requester").innerHTML = response.Full_Name + " ("+response.emp_no+") "; 

                     $("#cancellation_id").attr("data-id", response.request_no);


                     $("#box_approval_request_detail").load("pages_relation/_pages_approval.php<?php echo $getPackage; ?>rfid=" + response.request_no, 
                            function(responseTxt, statusTxt, jqXHR){
                                   if(statusTxt == "success"){
                                          $("#box_approval_request_detail").show();
                                   }
                                   if(statusTxt == "error"){
                                          alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                   }
                            }
                     );
                   

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
                                                 $("#modalcancelcondition_2").show();    
                                          } else {
                                                 $("#modalcancelcondition_0").hide();    
                                                 $("#modalcancelcondition_1").show(); 
                                                 $("#modalcancelcondition_2").hide();       
                                          }
                                   }
                            }); // /ajax

                     // mmeber id 
                     $(".FormDisplayLeaveApproval").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');

                     // here update the member data
                     $("#updatedelMemberForm").unbind('submit').bind('submit', function() {
                           
                            // remove error messages
                            $(".text-danger").remove();

                            var form = $(this);

                            // validation
                            var sel_approval_request_no = $("#sel_approval_request_no").val();
                            var sel_emp_no_approver = $("#sel_emp_no_approver").val();

                            if(sel_approval_request_no == "") {
                                   modals.style.display ="block";
                                   document.getElementById("msg").innerHTML = "There is some error";
                            } else if(sel_emp_no_approver == "") {
                                   modals.style.display ="block";
                                   document.getElementById("msg").innerHTML = "There is some error";
                            } else {
                                   $('#submit_approval_spvdown').hide();
                                   $('#submit_approval_spvdown2').show();
                                   mymodalss.style.display = "block";
                            }

                            if(sel_approval_request_no && sel_emp_no_approver) {


                                   $.ajax({
                                          url: form.attr('action'),
                                          type: form.attr('method'),
                                          data: form.serialize(),
                                          dataType: 'json',
                                          success:function(response) {
                                                 if (response.code == 'success_message_approved') {

                                                        

                                                        $('#submit_approval_spvdown').show();
                                                        $('#submit_approval_spvdown2').hide();    
                                                        
                                                        mymodalss.style.display = "none";

                                                        // reload the datatables
                                                        datatable.ajax.reload(null,false);
                                                        // reload the datatables

                                                        $('#FormDisplayLeaveApproval').modal('hide');
                                               
                                                        $("[data-dismiss=modal]").trigger({type: "click"});

                                                        modals.style.display = "block";
                                                        document.getElementById("msg").innerHTML = response.messages;

                                                        
                                                        
                                                 } else {
                                                        $('#submit_approval_spvdown').show();
                                                        $('#submit_approval_spvdown2').hide();

                                                        mymodalss.style.display = "none";

                                                        modals.style.display = "block";
                                                        document.getElementById("msg").innerHTML = response.messages;
                                                        // reload the datatables      
                                                 }
                                          } // /success
                                   }); // /ajax
                            } // /if

                            return false;
                     });

              } // /success
       }); // /fetch selected member info

       // Delete 
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