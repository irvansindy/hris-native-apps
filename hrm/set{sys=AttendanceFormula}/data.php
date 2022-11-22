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
              retrieve: true,
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
              "ajax": "php_action/FuncDataRead.php"
       });
});
</script>




<div class="col-md-12">
       <div class="card">
              <div class="card-header d-flex align-items-center">
                     <h4 class="card-title mb-0">Attendance Formula Setting </h4>


                     <div class="card-actions ml-auto">
                            <table>
                                   <!-- <td>
                                          <a href='#' class="toolbar sprite-toolbar-reload" id="RELOAD" title="Reload">
                                                 <div class="toolbar sprite-toolbar-search" id="SEARCH" title="Search" onclick="RefreshPage();">
                                                 </div>
                                          </a>
                                   </td> -->
                                   <td>
                                          <a href='#'><div class="toolbar sprite-toolbar-add" title="Add" data-toggle="modal" data-target="#CreateForm" id="CreateButton" data-keyboard="false" data-backdrop="static">
                                          </div></a>
                                   </td>
                                   <!-- AgusPrass 02/03/2021 Menghapus # pada href-->
                                   <td>
                                          <a href='#'><div class="toolbar sprite-toolbar-reload" id="RELOAD" title="Reload"
                                                 onclick="RefreshPage();">
                                          </div></a>
                                   </td>
                                   <!-- AgusPrass 02/03/2021 -->

                            </table>
                     </div>
              </div>

              <div class="card-body table-responsive p-0"
                     style="width: 100vw;height: 78vh; width: 98.8%; margin: 5px;overflow: scroll;">
                     <table id="datatable" width="98%" border="1" align="left"
                            class="table table-bordered table-striped table-hover table-head-fixed">
                            <thead>
                                   <tr>
                                          <th class="fontCustom"
                                                 style="z-index: 1;vertical-align: ce;vertical-align: middle;"
                                                 nowrap="nowrap">No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                          <th class="fontCustom"
                                                 style="z-index:1;vertical-align: ce;vertical-align: middle;">Formula&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          </th>
                                          <th class="fontCustom"
                                                 style="z-index: 1;vertical-align: ce;vertical-align: middle;">
                                                 Action&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          </th>
                                          <!-- <th class="fontCustom" style="z-index: 1;vertical-align: ce;vertical-align: middle;">Order</th> -->
                                    
                                          <!-- <th class="fontCustom" style="z-index: 1;vertical-align: ce;vertical-align: middle;">Join Date</th>
                                                                <th class="fontCustom" style="z-index: 1;vertical-align: ce;vertical-align: middle;">Employment Code</th> -->
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
                            <h4 class="modal-title">Add Attendance Formula</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

                     <form class="form-horizontal" action="php_action/FuncDataCreate.php" method="POST"
                            id="FormDisplayCreate">

                             <fieldset id="fset_1">
                                          <legend>General</legend>

                                          <div class="messages_update"></div>

                                          <input id="inp_emp_no" name="inp_emp_no" type="hidden" value="<?php echo $username; ?>"><!--FROM SESSION -->
                                          <input id="inp_token" name="inp_token" type="hidden" value="<?php echo $get_token; ?>"><!--FROM CONFIGURATION -->

                                   
                                          <div class="form-row" style="display:none">
                                                 <div class="col-4 name">Group Code <span class="required">*</span></div>
                                                 <div class="col-sm-8">
                                                        <div class="input-group" id="sel_identity">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-4 name">Order <span class="required">*</span></div>
                                          </div>

                                          <div class="form-row" style="display:nones">
                                                 <div class="col-sm-12">
                                                        <div class="input-group">

                                                               <input class="hidden" autocomplete="off" autofocus="on"
                                                                      id="inp_ls_process_order" name="inp_ls_process_order"
                                                                      type="hidden" value="" onfocus="hlentry(this)" size="30"
                                                                      style="width: 100%;"
                                                                      validate="NotNull:Invalid Form Entry"
                                                                      onchange="formodified(this);" title="">

                                                               <input class="hidden" autocomplete="off" autofocus="on"
                                                                      id="inp_ls_ordering" name="inp_ls_ordering"
                                                                      type="hidden" value="" onfocus="hlentry(this)" size="30"
                                                                      style="width: 100%;"
                                                                      validate="NotNull:Invalid Form Entry"
                                                                      onchange="formodified(this);" title="">

                                                               <select id="inp_process_order" class="input--style-6" name="inp_process_order" onfocus="hlentry(this)"
                                                                             onchange="formodified(this);"
                                                                             style="width:undefined;border: 1px solid #cac2c2;color: #484545; height:33px">
                                                                             <option value="">--select one--</option>
                                                                             <?php echo $src; ?>
                                                                             <?php
                                                                                    $sql = mysqli_query($connect,"SELECT max(process_order)+1 as process_order FROM hrmattformula
                                                                                                                  ORDER BY process_order ASC");
                                                                                    while($row=mysqli_fetch_array($sql))
                                                                                    {
                                                                                           echo '<option value="'.$row['process_order'].'">'.$row['process_order'].'</option>';
                                                                                    }
                                                                             ?>
                                                               </select>
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-4 name">Formula <span class="required">*</span></div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-12">
                                                        <div class="input-group">
                                                               <textarea class="form-control" autocomplete="off" autofocus="on"
                                                                      id="inp_formula" name="inp_formula"
                                                                      type="Text" value="" onfocus="hlentry(this)" size="30"
                                                                      style="width: 100%;height: 200px;"
                                                                      validate="NotNull:Invalid Form Entry"
                                                                      onchange="formodified(this);" title=""></textarea>
                                                               <img onclick="SelectName()" src="../../asset/dist/img/suggest.png" style="cursor: pointer;">
                                                               <script type="text/javascript">
                                                                      var popup;
                                                                      function SelectName() {
                                                                             var x = document.getElementById("inp_formula").value;
                                                                             var y = document.getElementById("inp_ls_process_order").value;
                                                                             popup = window.open("Popup_create.php?id=" + x + '&git=' + y , "Popup", "width=510,height=300");
                                                                             popup.focus();
                                                                             return false
                                                                      }
                                                               </script>
                                                        </div>
                                                 </div>
                                          </div>
                                   </fieldset>

                            </div>

                            <div class="modal-footer">
                                   <button type="reset" class="btn btn-primary1" data-dismiss="modal"
                                          aria-hidden="true">
                                          &nbsp;Cancel&nbsp;
                                   </button>
                                   <button class="btn btn-warning" type="submit" name="submit_add" id="submit_add">
                                          Confirm
                                   </button>
                                   <button class="btn btn-warning" type="button" name="submit_add2"
                                          id="submit_add2" style='display:none;' disabled>
                                          <span class="spinner-grow spinner-grow-sm" role="status"
                                                 aria-hidden="true"></span>
                                          &nbsp;&nbsp;Processing..
                                   </button>
                            </div>      
                     </form>
              </div>
       </div>
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /edit modal -->













































<!-- edit modal -->
<div class="modal  fade fade-custom" tabindex="-1" role="dialog" id="UpdateForm">
       <div class="modal-dialog modal-belakang modal-bg" role="document">

              <div class="modal-content">
                     <div class="modal-header">
                            <h4 class="modal-title">Edit Formula Setting</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

                     <!-- <form class="form-horizontal" action="php_action/FuncDataUpdate.php" method="POST" id="updateMemberForm"> -->
                     <form class="form-horizontal" action="php_action/FuncDataUpdate.php" method="POST" id="FormDisplayUpdate">

                                   <fieldset id="fset_1">
                                          <legend>General</legend>

                                          <div class="messages_update"></div>

                                          <input id="sel_emp_no" name="sel_emp_no" type="hidden" value="<?php echo $username; ?>"><!--FROM SESSION -->
                                          <input id="sel_token" name="sel_token" type="hidden" value="<?php echo $get_token; ?>"><!--FROM CONFIGURATION -->

                                   
                                          <div class="form-row" style="display:none">
                                                 <div class="col-4 name">Group Code <span class="required">*</span></div>
                                                 <div class="col-sm-8">
                                                        <div class="input-group" id="sel_identity">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-4 name">Order <span class="required">*</span></div>
                                          </div>

                                          <div class="form-row" style="display:nones">
                                                 <div class="col-sm-12">
                                                        <div class="input-group">

                                                               <input class="hidden" autocomplete="off" autofocus="on"
                                                                      id="sel_ls_process_order" name="sel_ls_process_order"
                                                                      type="hidden" value="" onfocus="hlentry(this)" size="30"
                                                                      style="width: 100%;"
                                                                      validate="NotNull:Invalid Form Entry"
                                                                      onchange="formodified(this);" title="">

                                                               <input class="hidden" autocomplete="off" autofocus="on"
                                                                      id="sel_ls_ordering" name="sel_ls_ordering"
                                                                      type="hidden" value="" onfocus="hlentry(this)" size="30"
                                                                      style="width: 100%;"
                                                                      validate="NotNull:Invalid Form Entry"
                                                                      onchange="formodified(this);" title="">

                                                               <select id="sel_process_order" class="input--style-6"
                                                                             name="sel_process_order" onfocus="hlentry(this)"
                                                                             onchange="formodified(this);"
                                                                             style="width:undefined;border: 1px solid #cac2c2;color: #484545; height:33px">
                                                                             <option value="">--select one--</option>
                                                                             <?php echo $src; ?>
                                                                             <?php
                                                                                    $sql = mysqli_query($connect,"SELECT process_order FROM hrmattformula
                                                                                                                      
                                                                                                                       ORDER BY process_order ASC");
                                                                                    while($row=mysqli_fetch_array($sql))
                                                                                    {
                                                                                           echo '<option value="'.$row['process_order'].'">'.$row['process_order'].'</option>';
                                                                                    } 
                                                                             ?>
                                                               </select>
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-4 name">Formula <span class="required">*</span></div>
                                          </div>

                                          <!-- pages relation -->
                                          <div id="box_sp_up"></div>
                                          <!-- pages relation -->

                                        
                                   </fieldset>
                            </div>

                            <div class="modal-footer">
                                   <button type="reset" class="btn btn-primary1" data-dismiss="modal"
                                          aria-hidden="true">
                                          &nbsp;Cancel&nbsp;
                                   </button>
                                 
                                   <button class="btn btn-warning" type="submit" name="submit_update" id="submit_update">
                                          Confirm
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




























	<!-- delete transaction modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="FormDisplayDelete">
	  <div class="modal-dialog" style="width: 25%;">
	    <div class="modal-content">
		<form class="form-horizontal" action="php_action/FuncDataDelete.php" method="POST" id="updatedelMemberForm">	      

		<div class="modal-body">      	
		  <div class="edit-messages"></div>
		  <table width="100%">
                     <tr><td align="center"><img src="../../asset/dist/img/sf-mola-mola.png" style="max-width: 90%;margin-top: 20px;"></td></tr>
                   
                     </table>
                     <div class="form-group">
                            <div class="col-sm-12">	
                                          <table width="100%"><td align="center"><label id="isi">Are you sure to delete data ?</label></td></table>		
                                          <input type="hidden" class="form-control input-report" id="sel_process_orderS" name="sel_process_order" placeholder="">
                            </div>
                     </div>


				
				<div class="modal-footer-delete FormDisplayDelete" style="text-align: center;padding-top: 20px;">
                                          <button type="reset" class="btn btn-primary1" style="background: #ececec;" data-dismiss="modal" aria-hidden="true">
                                                        &nbsp;Cancel&nbsp;
                                          </button>
                                          <button class="btn btn-warning" type="submit" name="submit_delete" id="submit_delete">
                                                 Confirm
                                          </button>
                                          <button class="btn btn-warning" type="button" name="submit_delete2"
                                                 id="submit_delete2" style='display:none;' disabled>
                                                 <span class="spinner-grow spinner-grow-sm" role="status"
                                                        aria-hidden="true"></span>
                                                 &nbsp;&nbsp;Processing..
                                          </button>
					</div>
				</div>


	      </form>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<!-- /edit modal -->

	











































<script>
function RefreshPage() {
       datatable.ajax.reload(null, true);

       setTimeout(function(){
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

              //      alert("data");

              // reset the form 
              $("#FormDisplayCreate")[0].reset();
              // empty the message div

              $(".messages_create").html("");

              // submit form
              $("#FormDisplayCreate").unbind('submit').bind('submit', function() {

                     $(".text-danger").remove();

                     var form = $(this);

                     var inp_process_order = $("#inp_process_order").val();
                     var inp_formula = $("#inp_formula").val();
                  

                     var regex=/^[a-zA-Z]+$/;
                  
                     if (inp_process_order == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Process Order Cannot Empty";

                     } else if (inp_formula == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Formula Cannot Empty";

                     } else {
                            $('#submit_add').hide();
                            $('#submit_add2').show();
                     }

                     if (inp_process_order && inp_formula) {

                            //submi the form to server
                            $.ajax({
                                   url: form.attr('action'),
                                   type: form.attr('method'),
                                   // data: form.serialize(),

                                   data: new FormData(this),
                                   processData: false,
                                   contentType: false,

                                   dataType: 'json',
                                   success: function(response) {

                                          // remove the error 
                                          $(".form-group").removeClass('has-error').removeClass('has-success');

                                          if (response.code =='success_message') {
                                                 mymodals_withhref.style.display ="block";
                                                 document.getElementById("msg_href").innerHTML = response.messages;

                                                 $('#submit_add').show();
                                                 $('#submit_add2').hide();

                                                 $('#FormDisplayCreate').modal('hide');  
                                                 $("[data-dismiss=modal]").trigger({type: "click"});   

                                                 // reset the form
                                                 $("#FormDisplayCreate")[0].reset();
                                                 // reload the datatables
                                                 datatable.ajax.reload(null,false);
                                                 // this function is built in function of datatables;
                                          } else {
                                                 modals.style.display ="block";
                                                 document.getElementById("msg").innerHTML = response.messages;

                                                 $('#submit_add').show();
                                                 $('#submit_add2').hide();

                                                 window.setTimeout(
                                                        function() {
                                                               $(".alert")
                                                                      .fadeTo(
                                                                             500,
                                                                             0
                                                                             )
                                                                      .slideUp(
                                                                             500,
                                                                             function() {
                                                                                    $(this)
                                                                             .remove();
                                                                             }
                                                                      );
                                                        },
                                                        4000
                                                        );
                                          } // /else
                                   } // success  
                            }); // ajax subit 				
                     } /// if
                     return false;
              }); // /submit form for create member
       }); // /add modal
});






























  
                     
                            
                                   
                                
                                   
                                 
               
                   
            






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
                            document.getElementById("sel_identity").innerHTML = response.ordering;
                            
                        
                            $("#sel_process_order").val(response.ordering);
                            $("#sel_ls_process_order").val(response.process_order);
                            $("#sel_ls_ordering").val(response.ordering);
                            $("#sel_formula").val(response.attformula);
                            // $("#sel_reason_name_en").val(response.reason_name_en);
                            // $("#sel_reason_name_id").val(response.reason_name_id);    
                            
                            $("#box_sp_up").load("pages_relation/_pop_up_formula_update.php?rfid=" + response.process_order, 
                                   function(responseTxt_spv_up, statusTxt_spv_up, jqXHR_spv_up){
                                          if(statusTxt_spv_up == "success"){
                                                 $("#box_sp_up").show();
                                                 mymodalss.style.display = "none";
                                          }
                                   }
                            );                                            

                            // here update the member data
                            $("#FormDisplayUpdate").unbind('submit').bind('submit', function() {
                                   // remove error messages
                                   $(".text-danger").remove();

                                   var form = $(this);

                                   var sel_process_order       = $("#sel_process_order").val();
                                   var sel_formula             = $("#sel_formula").val();
                                
         
                                   var regex=/^[a-zA-Z]+$/;

                                   if (sel_process_order == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "Process Order Cannot Empty";

                                   } else if (sel_formula == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "Formula Cannot Empty";

                                   } else {
                                          $('#submit_update').hide();
                                          $('#submit_update2').show();
                                   }


                                   if (sel_process_order && sel_formula) {

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
                                                               modals.style.display ="block";
                                                               document.getElementById("msg").innerHTML = response.messages;

                                                               $('#submit_update').show();
                                                               $('#submit_update2').hide();

                                                               $('#FormDisplayUpdate').modal('hide');  
                                                               $("[data-dismiss=modal]").trigger({type: "click"});      
                                                        
                                                               // reload the datatables
                                                               datatable.ajax.reload(null,false);
                                                               // reload the datatables
                                                               
                                                        } else {
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

















































function editdelMember(id = null) {
	if(id) {

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
			data: {member_id : id},
			dataType: 'json',
			success:function(response) {

				$("#sel_process_orderS").val(response.process_order);

                            

				// mmeber id 
				$(".FormDisplayDelete").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');

				// here update the member data
				$("#updatedelMemberForm").unbind('submit').bind('submit', function() {
					// remove error messages
					$(".text-danger").remove();

					var form = $(this);

					// validation

					var sel_process_order = $("#sel_process_orderS").val();

					if(sel_process_order == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "Shiftgroup schedule code cannot empty";
                                   } else {
                                          $('#submit_delete').hide();
                                          $('#submit_delete2').show();
                                   }


					if(sel_process_order) {
						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {
								if (response.code == 'success_message') {
                                                               modals.style.display = "block";
                                                               document.getElementById("msg").innerHTML = response.messages;

                                                               $('#submit_delete').show();
                                                               $('#submit_delete2').hide();                                                             

                                                               // reload the datatables
                                                               datatable.ajax.reload(null,false);
                                                               // reload the datatables

                                                               $('#FormDisplayDelete').modal('hide');  
                                                               $("[data-dismiss=modal]").trigger({type: "click"}); 
                                                               
                                                        } else {
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

	} else {
		alert("Error : Refresh the page again");
	}
}








































</script>
<!-- isi JSONs -->
</body>

</html>

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



                           
      
                        
