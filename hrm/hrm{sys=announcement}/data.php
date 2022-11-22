<?php  
       $src_news                   = '';
       $src_title                  = '';
       if (!empty($_POST['src_news']) && !empty($_POST['src_title'])) {
              $src_news            = $_POST['src_news'];
              $src_title           = $_POST['src_title'];
              $frameworks          = "?src_news="."".$src_news." &&src_title="."".$src_title."";
       } else if (empty($_POST['src_news']) && !empty($_POST['src_title'])) {
              $src_news            = $_POST['src_news'];
              $src_title           = $_POST['src_title'];
              $frameworks          = "?src_title="."".$src_title."";
       } else if (!empty($_POST['src_news']) && empty($_POST['src_title'])) {
              $src_news            = $_POST['src_news'];
              $src_title           = $_POST['src_title'];
              $frameworks          = "?src_news="."".$src_news."";
       }
?>
<!-- Modal -->
	<div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2"  data-backdrop="false">
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
                                                        <div class="col-4 name">News Content</div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on" id="src_news"
                                                                             name="src_news" id="src_news" type="Text" value="<?php echo $src_news; ?>"
                                                                             onfocus="hlentry(this)" size="30" maxlength="50" 
                                                                             validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title="">
                                                               </div>
                                                        </div>
                                                 </div>

                                                 <div class="form-row" >
                                                        <div class="col-4 name">Judul </div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on"
                                                                             name="src_title" id="src_title" type="Text" value="<?php echo $src_title; ?>"
                                                                             onfocus="hlentry(this)" size="30" maxlength="50" 
                                                                             validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title="">
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
                     [0, "asc"]
              ],
              pagingType : "simple",
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
                     <h4 class="card-title mb-0">News </h4>


                     <div class="card-actions ml-auto">
                            <table>

                                   <td>
                                          <form action="../rfid=repository/cli_Template_Download/st/StFunctionDownload.php" method="GET">
                                                 <input type="hidden" name="filedata" value="StDownloadGTTGROvertimeSettingData.php">
                                                 <input type="hidden" name="filename" value="Overtime Setting">
                                                 <input type="hidden" name="src_news" value="<?php echo $src_news; ?>">
                                                 <input type="hidden" name="src_title" value="<?php echo $src_title; ?>">
                                                 <button type="submit" class="toolbar sprite-toolbar-excel" id="EXCEL" style="border: 0;background-color: white;" name="submit_approve" value="submit"></button>
                                          </form>

                                   </td>
                                   <td>

                                          <a href='#' class='open_modal_search' class="btn btn-demo" data-toggle="modal" data-target="#myModal2">
                                                 <div class="toolbar sprite-toolbar-search" id="SEARCH" title="Search">
                                                 </div>
                                          </a>



                                   </td>
                                   <!-- AgusPrass 02/03/2021 Menghapus # pada href-->
                                   <td>
                                          <div class="toolbar sprite-toolbar-reload" id="RELOAD" title="Reload"
                                                 onclick="RefreshPage();">
                                          </div>

                                          


                                   </td>
                                   <!-- AgusPrass 02/03/2021 -->

                                   <td>
                                          <div class="toolbar sprite-toolbar-add" title="Add" data-toggle="modal"
                                                 data-target="#CreateForm" id="CreateButton" data-keyboard="false"
                                                 data-backdrop="static">
                                                 <!-- <a title="add" href="" class="toolbar sprite-toolbar-add" data-toggle="modal" data-target="#CreateForm" id="CreateButton" data-keyboard="false" data-backdrop="static">tambah</a> -->
                                          </div>
                                   </td>

                            </table>

                          

                     </div>
              </div>

              <div class="card-body table-responsive p-0"
                     style="width: 100vw;height: 78vh; width: 99.1%; margin: 5px;overflow: scroll;">
                     <table id="datatable" width="100%" border="1" align="left"
                            class="table table-bordered table-striped table-hover table-head-fixed">
                            <thead>
                                   <tr>
                                          <th class="fontCustom"
                                                 style="z-index: 1;vertical-align: ce;vertical-align: middle;"
                                                 nowrap="nowrap">No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                          <th class="fontCustom"
                                                 style="z-index: 1;vertical-align: ce;vertical-align: middle;">
                                                 News Title&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                          <th class="fontCustom"
                                                 style="z-index: 1;vertical-align: ce;vertical-align: middle;"> Action
                                          </th>
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
       <div class="modal-dialog modal-belakang modal-bgkpi" role="document">
              <div class="modal-content">
                     <div class="modal-header">
                            <h4 class="modal-title">Add News</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">
                     
                     <form class="form-horizontal" action="php_action/FuncDataCreate.php" method="POST"
                            id="FormDisplayCreate">

                            <fieldset id="fset_1">
                                   <legend>Detail Informations</legend>

                                   <div class="messages_create"></div>

                                   <input id="inp_emp_no" name="inp_emp_no" type="hidden" value="<?php echo $username; ?>"><!--FROM SESSION -->

                                   <div class="form-row">
                                          <div class="col-4 name">Subject <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="inp_news" name="inp_news"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;width: 100%;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Photos <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">
                                                        <input type="file" name="inp_fileToUpload" id="inp_fileToUpload">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name">Content <span class="required">*</span></div>
                                   </div>


                                   <textarea id="editor" name="editor"></textarea>
                                 
                            </fieldset>

                            
                            </div>
                            <div class="modal-footer-sdk">
                                   <button type="reset" class="btn-sdk btn-primary-left" data-dismiss="modal" onclick="ResetTable();"
                                          aria-hidden="true">
                                          &nbsp;Cancel&nbsp;
                                   </button>
                                   <button class="btn-sdk btn-primary-right" type="submit" name="submit_add" id="submit_add">
                                          Confirm
                                   </button>
                                   <button class="btn-sdk btn-primary-right" type="button" name="submit_add2"
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
       <div class="modal-dialog modal-belakang modal-bgkpi" role="document">

              <div class="modal-content">
                     <div class="modal-header">
                            <h4 class="modal-title">Edit News</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 99%; margin: 5px;overflow: scroll;overflow-x: hidden;">


                     <form class="form-horizontal" action="php_action/FuncDataUpdate.php" method="POST" id="FormDisplayUpdate">

                            <fieldset id="fset_1">
                                   <legend>General Information</legend>

                                   <input id="inp_emp_no" name="inp_emp_no" type="hidden" value="<?php echo $username; ?>"><!--FROM SESSION -->
                                   
                                   <div class="form-row" style="display:none">
                                          <div class="col-4 name"> <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">
                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="update_id_berita" name="update_id_berita"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;width: 60%;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>
                      
                                

                                   <div class="form-row">
                                          <div class="col-4 name">Subject <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="update_subject" name="update_subject"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;width: 100%;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Photos <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">
                                                        <input type="file" name="update_fileToUpload" id="update_fileToUpload">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name">Content <span class="required">*</span></div>
                                   </div>

                                   <textarea id="editor_update" name="editor_update"></textarea>
                                
                            </fieldset>

                     </div>
   
              <!-- END SCROLLING -->

                           
                            
                            <div class="modal-footer-sdk">
                                   <button type="reset" class="btn-sdk btn-primary-left" data-dismiss="modal"
                                          aria-hidden="true">
                                          &nbsp;Cancel&nbsp;
                                   </button>
                                   <button class="btn-sdk btn-primary-right" type="submit" name="submit_update" id="submit_update">
                                          Confirm
                                   </button>
                                   <button class="btn-sdk btn-primary-right" type="button" name="submit_update2"
                                          id="submit_update2" style='display:none;' disabled>
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




























	<!-- delete transaction modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="FormDisplayDelete">
	
	  <div class="modal-dialog modal-vsm" style="margin-top: 120px;">
	    <div class="modal-content" style="border-radius: 5px;">
		<form class="form-horizontal" action="php_action/FuncDataDelete.php" method="POST" id="updatedelMemberForm">	      

		<div class="modal-body">      	
		  <div class="edit-messages"></div>
		  <table width="100%">
                     <tr><td align="center"><img src="../../asset/dist/img/sf-mola-mola.png" style="max-width: 90%;margin-top: 20px;"></td></tr>
                   
                     </table>
                     <div class="form-group">
                            <div class="col-sm-12">	
                                          <table width="100%"><td align="center"><label id="isi">Are you sure to delete news ?</label></td></table>		
                                          <input type="hidden" class="form-control input-report" id="sel_id_berita" name="sel_id_berita" placeholder="Nip">
                            </div>
                     </div>

                            <div class="modal-footer-delete FormDisplayDelete" style="text-align: center;padding-bottom: 14px;">
                                   <button type="reset" class="btn btn-primary1" data-dismiss="modal" onclick="ResetTable();"
                                          aria-hidden="true">
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
// global the manage memeber table 
$(document).ready(function() {
       $("#CreateButton").on('click', function() {
              // reset the form 
              $("#FormDisplayCreate")[0].reset();
              // empty the message div

              $(".messages_create").html("");

              // submit form
              $("#FormDisplayCreate").unbind('submit').bind('submit', function() {

                     $(".text-danger").remove();

                     var form = $(this);

                     var inp_news = $("#inp_news").val();
                     var inp_fileToUpload = $("#inp_fileToUpload").val();
                     var editor = $("#editor").val();

                     var regex=/^[a-zA-Z]+$/;
                  
                     if (inp_news == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Subject cannot empty";
                     } else if (inp_fileToUpload == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Attachment cannot empty";
                     } else if (editor == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Content cannot empty";
                     } else {
                            $('#submit_add').hide();
                            $('#submit_add2').show();
                             mymodalss.style.display = "block";
                     }

                     if (inp_news && inp_fileToUpload && editor) {

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
                                                 $('#submit_add').show();
                                                 $('#submit_add2').hide();

                                                 $('#FormDisplayCreate').modal('hide');  
                                                 $("[data-dismiss=modal]").trigger({type: "click"});   

                                                 // reset the form
                                                 $("#FormDisplayCreate")[0].reset();
                                                 // reload the datatables
                                                 datatable.ajax.reload(null,false);
                                                 // this function is built in function of datatables;

                                                 mymodalss.style.display = "none";
                                                 modals.style.display ="block";
                                                 document.getElementById("msg").innerHTML = response.messages;

                                          } else {
                                                 mymodalss.style.display = "none";
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
                            
                            $("#update_id_berita").val(response.id_berita);
                            $("#update_subject").val(response.judul);
                            $("#editor_update").val(response.isi_berita);


                            // here update the member data
                            $("#FormDisplayUpdate").unbind('submit').bind('submit', function() {
                                   // remove error messages
                                   $(".text-danger").remove();

                                   var form = $(this);

                                   var update_id_berita        = $("#update_id_berita").val();
                                   var update_subject          = $("#update_subject").val();
                                
                                   var regex=/^[a-zA-Z]+$/;

                                   if (update_id_berita == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "Overtime code cannot empty";

                                   } else if (update_subject == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "Overtime minimum cannot empty";

                                   } else {
                                          $('#submit_update').hide();
                                          $('#submit_update2').show();
                                   }




                                   if (update_id_berita && update_subject) {

                                          $.ajax({
                                                 
                                                 url: form.attr('action'),
                                                 type: form.attr('method'),
                                                 // data: form.serialize(),

                                                 data: new FormData(this),
                                                 processData: false,
                                                 contentType: false,

                                                 dataType: 'json',
                                                 success: function(response) {

                                                        if (response.code =='success_message_update') {

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

				$("#sel_id_berita").val(response.id_berita);

				// mmeber id 
				$(".FormDisplayDelete").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');

				// here update the member data
				$("#updatedelMemberForm").unbind('submit').bind('submit', function() {
					// remove error messages
					$(".text-danger").remove();

					var form = $(this);

					// validation

					var sel_id_berita = $("#sel_id_berita").val();

	

					if(sel_id_berita == "") {
						$("#sel_id_berita").closest('.form-group').addClass('has-error');
						$("#sel_id_berita").after('<p class="text-danger">The Name field is required</p>');
                                   } else {
                                          $('#submit_delete').hide();
                                          $('#submit_delete2').show();
                                   }


                                   


					if(sel_id_berita) {
						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {
								if (response.code == 'success_message_delete') {

                                                               $('#submit_delete').show();
                                                               $('#submit_delete2').hide();

                                                               $('#FormDisplayDelete').modal('hide');  
                                                               $("[data-dismiss=modal]").trigger({type: "click"});      
                                                             

                                                               // reload the datatables
                                                               datatable.ajax.reload(null,false);
                                                               // reload the datatables
                                                               mymodalss.style.display = "none";
                                                               modals.style.display ="block";
                                                               document.getElementById("msg").innerHTML = response.messages;

                                                               
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



                           
      
                        




                           
      

<script src="asset/ckeditor.js"></script>
<script src="asset/js/sample.js"></script>
<script src="asset/js/sampleupdate.js"></script>
                        
    <script>
                     initSample();
                     initSampleUpdate();
              </script>