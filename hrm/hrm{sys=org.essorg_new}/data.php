<!-- LOADER -->
<!-- <div onclick='return stopload()' id="loading-circle"></div> -->
<!-- LOADER -->
<!-- <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css"> -->
<script src="bootstrap/dist/js/bootstrap.min.js"></script>

<?php  
       $search_rn             = '';
       $search_rb             = '';
       $search_type           = '';
       // jika nip dan nama terisi
       if (!empty($_POST['search_rn'])) {
              $search_rn             = $_POST['search_rn'];
       }
       if (!empty($_POST['search_rb'])) {
              $search_rb             = $_POST['search_rb'];
       }
       if (!empty($_POST['search_type'])) {
              $search_type             = $_POST['search_type'];
       }
?>


<?php
                            if (!empty($_POST['cari'])) {
                                   $filter = $_POST['cari'];
                                   $filterprint = 'Filter: Ticketing Number Is '.$_POST['cari'];
                            } else { 
                                   $filter = '';
                                   $filterprint = '';
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
                                                        <div class="col-4 name">Request No</div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on" id="search_rn"
                                                                             name="search_rn" type="Text" value=""
                                                                             onfocus="hlentry(this)" size="30" maxlength="50" 
                                                                             validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title="">
                                                               </div>
                                                        </div>
                                                 </div>

                                                 <div class="form-row">
                                                        <div class="col-4 name">Request By</div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on"
                                                                             name="search_rb" id="search_rb" type="Text" value=""
                                                                             onfocus="hlentry(this)" size="30" maxlength="50" 
                                                                             validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title="">
                                                               </div>
                                                        </div>
                                                 </div>

                                                 <div class="form-row">
                                                        <div class="col-4 name">Type</div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">
                                                                      <select class="input--style-6" name="search_type" id="search_type" style="width: ;height: 30px;">
                                                                             <option value="">-- Select one --</option>
                                                                             <option value="1">PENAMBAHAN</option>
                                                                             <option value="2">PENGHAPUSAN</option>
                                                                             <option value="3">PELEBURAN</option>
                                                                             <option value="4">PEMISAHAN</option>
                                                                      </select>
                                                               </div>
                                                        </div>
                                                 </div>
                                                 
                                          </fieldset>
                   
                                          <button class="btn btn-warning" type="submit" style="width: 100%;border-radius: 17px;font-weight: bold;letter-spacing: 1px;font-size: 12px;">
                                                 Filter
                                          </button>
                                   </form>
				</div>

			</div><!-- modal-content -->
		</div><!-- modal-dialog -->
	</div><!-- modal -->                        



<div class="col-md-12">
                                <div class="card">
                                    <div class="card-header d-flex align-items-center">
                                        <h4 class="card-title mb-0">ESS Organization</h4>
                       

                                        <div class="card-actions ml-auto">
                                        <table>

                                        <td><a href='#' class='' data-toggle="modal" id="modal_tambah" id1="" data-target="#modal-default">
                                                               <div class="toolbar sprite-toolbar-add"
                                                                      title="Add"></div>
                                          </a></td>

                                          <td>
                                          <a href='#' class='open_modal_search' class="btn btn-demo" data-toggle="modal" data-target="#myModal2">
                                                 <div class="toolbar sprite-toolbar-search" id="SEARCH" title="Search">
                                                 </div>
                                          </a>
                                        </td>
                                          
                                        <!-- <td>
                                          <form action="export/excel" method="POST">
                                          
                                          <input type="hidden" name="data_search" value="<?php echo $search; ?>">
                                        

                                                
                                                        <button type="submit" class="toolbar sprite-toolbar-excel" id="EXCEL" style="border: 0;background-color: white;" name="submit_approve" value="submit">
                                                        </button>


                                                  
                                          </form>
                                        </td> -->
                                        <!-- AgusPrass 02/03/2021 Menghilangkan # pada href-->
                                        <td>
                                          <div class="toolbar sprite-toolbar-reload" id="refresh" title="Reload"
                                                 onclick="">
                                          </div>
                                        </td>
                                        <!-- AgusPrass 02/03/2021 -->
                                     
                                        
                                        </table>
                                          

                                        </div>
                                    </div>

                                    <div class="card-body "
                                        style="margin: 5px;"> 
                                        <table id="datatable" width="99%" border="1"
                                                class="table table-bordered table-striped table-hover table-head-fixed">


                                                <thead>
                                                        <tr>
                                                               <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">Request No.</th>
                                                               <th class="fontCustom" style="z-index: 1;">Request By</th>
                                                               <th class="fontCustom" style="z-index: 1;">Request Date</th>
                                                               <th class="fontCustom" style="z-index: 1;">Request Division</th>
                                                               <th class="fontCustom" style="z-index: 1;">Request Department</th>
                                                               <!-- <th class="fontCustom" style="z-index: 1;">Request Position</th> -->
                                                               <th class="fontCustom" style="z-index: 1;">Type</th>
                                                               <th class="fontCustom" style="z-index: 1;">Status Approval</th>
                                                               <th class="fontCustom" style="z-index: 1;">Status Request</th>
                                                               <th class="fontCustom" style="z-index: 1;">Action</th>
                                                               
                                                               

                                                        </tr>
                                                     

                                                </thead>
                                                <!-- <tbody id="example3LOADe">

                                                </tbody> -->
                                                       

                                        </table>


                                        

                                </div>
                             

                                <div class='card-footer' style='background-color: #eee;height: 37px;padding-top: 5px;'>

                                          <div class='row mb-2'>
                                                 <div class='col-sm-10'>
                                                        <?php echo $filterprint; ?>
                                                 </div>
                                                 <div class='col-sm-2'>

                                                        <!-- <div id="toolbarlist">
                                                               <div class="toolbar-load sprite-toolbar-loadmore" id="ADD"
                                                                      title="Add"
                                                                      onclick="innerPop('?xfid=hrm.employee.add&amp;forcegen=1',reposBlock)">
                                                                      <a class="down" href="#"><button>Load More</a></div>
                                                        </div>


                                                 </div> -->
                                          </div>

                                    </div>

                                
                            </div>
                            </div>

                           
       <!-- Modal untuk reqest requester -->
       <div class="modal fade" id="modal-default">
          <div class="modal-dialog modal-bgkpi">
            <div class="modal-content">
              <div class="modal-header">
                     <h4 class="modal-title" id="title_modal"></h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
              </div>
              <div id="yanampilmodal"></div>
            
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <!-- Modal untuk reqest requester -->




        <!-- Modal untuk reqest requester -->
       <div class="modal fade" id="modal-view-requester">
          <div class="modal-dialog modal-bgkpi">
            <div class="modal-content">
              <div class="modal-header">
                     <h4 class="modal-title" id="title_view_requester"></h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
              </div>
              <div class="card-body table-responsive p-0" style="width: 100vw; height: 90vh; width: 99%; margin: 5px; overflow: scroll;">
              <div id="tampil_view_requester"></div>
              </div>
            
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <!-- Modal untuk reqest requester -->

       <!-- Modal untuk reqest requester -->
       <div class="modal fade" id="modal-preview_approver">
          <div class="modal-dialog modal-md">
            <div class="modal-content">
              <div class="modal-header">
                     <h4 class="modal-title" id="title_preview_app"></h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
              </div>
              <!-- <div class="card-body table-responsive p-0" style="width: 100vw; height: 89vh; width: 100%; margin: 5px; overflow: scroll;"> -->
                     <div id="tampil_view_app">
                            
                     </div>
              <!-- </div> -->
            
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <!-- Modal untuk reqest requester -->





          
            
                            <script src="../../asset/vendor/datatable/datatables.min.js"></script>
                           


<script type="text/javascript" language="javascript" >
$(document).ready(function(){
     
       dataTable = $("#datatable").DataTable({
              
              dom: "B<'row'<'col-sm-12 col-md-9'l><'col-sm-12 col-md-9'f>>" +
                   "<'row'<'col-sm-12'tr>>" +
                   "<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-7'p>>",

              processing: true,
              // retrieve: true,
              searching: false,
              paging: true,
              order: [
                     [6, "desc"]
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
              columnDefs:[
                     {
                            "targets":[8],
                            "orderable":false,
                     },
              ], 
              "ajax": "ajax/ajax_data1.php?id1=<?php echo $search_rn ?>&id2=<?php echo $search_rb ?>&id3=<?php echo $search_type ?>"
       });
        

       $("#modal_tambah").click(function(e) {

              // Loader
              mymodalss.style.display = "block";
              document.getElementById("msg").innerHTML = "Data refreshed";
              // Loader

              var m = $(this).attr("id");
              
              $.ajax({
                     url: "modal_add_request.php",
                     type: "POST",
                            data: {
                                   id: m,
                            },
                            success: function(ajaxData) {
                                   $("#yanampilmodal").html(ajaxData);
                                  

                                   // Loader
                                   mymodalss.style.display = "none";
                                   document.getElementById("msg").innerHTML = "Data refreshed";
                                   return false;
                                   // Loader
                            }
                     });

              
                     height1()
                   
       });

       

       // Penambahan
       $("#modal_tambah").click(function(e) {
              $('#title_modal').html('Organization Request');
                   
       });
       // Penambahan

       // View reuqester
       $(document).on('click', '#modal_view_requester', function(){

              // Loader
              mymodalss.style.display = "block";
              document.getElementById("msg").innerHTML = "Data refreshed";
              // Loader

              $('#title_view_requester').html('Preview Organization Request');

              var m        = $(this).attr('id1');

              var n        = $(this).attr('id2');

              
              if(n == '1'){

                     $.ajax({
                     url: "requester/modal_penambahan_requester.php",
                     type: "POST",
                            data: {
                                   id: m,
                            },
                            success: function(ajaxData) {
                                   $("#tampil_view_requester").html(ajaxData);
                                  

                                   // Loader
                                   mymodalss.style.display = "none";
                                   document.getElementById("msg").innerHTML = "Data refreshed";
                                   return false;
                                   // Loader
                            }
                     });

              }else if(n == '2'){

                     $.ajax({
                     url: "requester/modal_penghapusan_requester.php",
                     type: "POST",
                            data: {
                                   id: m,
                            },
                            success: function(ajaxData) {
                                   $("#tampil_view_requester").html(ajaxData);
                                  

                                   // Loader
                                   mymodalss.style.display = "none";
                                   document.getElementById("msg").innerHTML = "Data refreshed";
                                   return false;
                                   // Loader
                            }
                     });

              }else if(n == '3'){

                     $.ajax({
                     url: "requester/modal_peleburan_requester.php",
                     type: "POST",
                            data: {
                                   id: m,
                            },
                            success: function(ajaxData) {
                                   $("#tampil_view_requester").html(ajaxData);
                                  

                                   // Loader
                                   mymodalss.style.display = "none";
                                   document.getElementById("msg").innerHTML = "Data refreshed";
                                   return false;
                                   // Loader
                            }
                     });

              }else if(n == '4'){

                     $.ajax({
                     url: "requester/modal_pemisahan_requester.php",
                     type: "POST",
                            data: {
                                   id: m,
                            },
                            success: function(ajaxData) {
                                   $("#tampil_view_requester").html(ajaxData);
                                  

                                   // Loader
                                   mymodalss.style.display = "none";
                                   document.getElementById("msg").innerHTML = "Data refreshed";
                                   return false;
                                   // Loader
                            }
                     });

              }
                   
       });
       // View reuqester


       // Refresh Page
       $("#refresh").click(function(e) {
              dataTable.ajax.reload();

              setTimeout(function(){
                     mymodalss.style.display = "none";
                     document.getElementById("msg").innerHTML = "Data refreshed";
                     return false;
              }, 2000);

              mymodalss.style.display = "block";
              document.getElementById("msg").innerHTML = "Data refreshed";
              return false;
                   
       });
       // Refresh Page

       // Chat
       $(document).on('click', '#preview_app', function(){
              $('#title_preview_app').html('Organization Approval');

              var m         = $(this).attr('id1');

              $.ajax({
                     url: "ajax/approver.php",
                     type: "POST",
                            data: {
                                   id: m,
                            },
                            success: function(ajaxData) {
                                   $("#tampil_view_app").html(ajaxData);
                                  

                                   // Loader
                                   mymodalss.style.display = "none";
                                   document.getElementById("msg").innerHTML = "Data refreshed";
                                   return false;
                                   // Loader
                            }
                     });
                     

                   
       });

       $(document).on('click', '#preview_app_view', function(){
              $('#title_preview_app').html('Organization Approval');

              var m         = $(this).attr('id1');

              $.ajax({
                     url: "ajax/view_approver.php",
                     type: "POST",
                            data: {
                                   id: m,
                            },
                            success: function(ajaxData) {
                                   $("#tampil_view_app").html(ajaxData);
                                  

                                   // Loader
                                   mymodalss.style.display = "none";
                                   document.getElementById("msg").innerHTML = "Data refreshed";
                                   return false;
                                   // Loader
                            }
                     });
                     

                   
       });
       // Chat
  
       // Ajax save

       // Penambahan
       $(document).on('click', '#submit_penambahan', function(){

              mymodalss.style.display = "block";

              const fileupload    = $('#file_pengajuan').prop('files')[0];   

              var division = $('#division').val();
              var department = $('#department').val();
              var tipe_pengajuan = $('#tipe_pengajuan').val();
              var penambahan_orgorpos = document.getElementsByName('penambahan_orgorpos[]');
              var penambahan_leader_pos = document.getElementsByName('penambahan_leader_pos[]');
              var penambahan_pos_name = document.getElementsByName('penambahan_pos_name[]');
              var penambahan_cost_center = document.getElementsByName('penambahan_cost_center[]');
              var penambahan_work_location = document.getElementsByName('penambahan_work_location[]');
              var penambahan_job_status = document.getElementsByName('penambahan_job_status[]');
              var penambahan_job_title = document.getElementsByName('penambahan_job_title[]');
              var penambahan_reason = document.getElementsByName('penambahan_reason[]');
              var penambahan_remarks = document.getElementsByName('penambahan_remarks[]');



              // Buat Array Org/Pos
              var orgpos = '';
              for (var i = 0; i < penambahan_orgorpos.length; i++) {
                     var a = penambahan_orgorpos[i];
                     orgpos = orgpos + a.value + '-';
              };
                     orgpos = orgpos + ']';
              // Buat Array Org/Pos

              // Buat Array Leader Pos
              var leader_pos = '';
              for (var i = 0; i < penambahan_leader_pos.length; i++) {
                     var a = penambahan_leader_pos[i];
                     leader_pos = leader_pos + a.getAttribute("id1") + '-';
              };
                     leader_pos = leader_pos + ']';
              // Buat Array Leader Pos

              // Buat Array Pos Name
              var pos_name = '';
              for (var i = 0; i < penambahan_pos_name.length; i++) {
                     var a = penambahan_pos_name[i];
                     pos_name = pos_name + a.value + '-';
              };
                     pos_name = pos_name + ']';
              // Buat Array Pos Name

              // Buat Array Cost Center
              var cost_center = '';
              for (var i = 0; i < penambahan_cost_center.length; i++) {
                     var a = penambahan_cost_center[i];
                     cost_center = cost_center + a.value + '-';
              };
                     cost_center = cost_center + ']';
              // Buat Array Cost Center

              // Buat Array Work Location
              var work_location = '';
              for (var i = 0; i < penambahan_work_location.length; i++) {
                     var a = penambahan_work_location[i];
                     work_location = work_location + a.value + '-';
              };
                     work_location = work_location + ']';
              // Buat Array Work Location

              // Buat Array Job Status
              var job_status = '';
              for (var i = 0; i < penambahan_job_status.length; i++) {
                     var a = penambahan_job_status[i];
                     job_status = job_status + a.value + '-';
              };
                     job_status = job_status + ']';
              // Buat Array Job Status

              // Buat Array Job Title
              var job_title = '';
              for (var i = 0; i < penambahan_job_title.length; i++) {
                     var a = penambahan_job_title[i];
                     job_title = job_title + a.value + '-';
              };
                     job_title = job_title + ']';
              // Buat Array Job Title

              // Buat Array Reason
              var reason = '';
              for (var i = 0; i < penambahan_reason.length; i++) {
                     var a = penambahan_reason[i];
                     reason = reason + a.value + '-';
              };
                     reason = reason + ']';
              // Buat Array Reason

              // Buat Array Remarks
              var remarks = '';
              for (var i = 0; i < penambahan_remarks.length; i++) {
                     var a = penambahan_remarks[i];
                     remarks = remarks + a.value + '-';
              };
                     remarks = remarks + ']';
              // Buat Array Remarks

              let formData = new FormData();
              formData.append('file', fileupload);
              formData.append('division', division);
              formData.append('department', department);
              formData.append('tipe_pengajuan', tipe_pengajuan);
              formData.append('orgpos', orgpos);
              formData.append('leader_pos', leader_pos);
              formData.append('pos_name', pos_name);
              formData.append('cost_center', cost_center);
              formData.append('work_location', work_location);
              formData.append('job_status', job_status);
              formData.append('job_title', job_title);
              formData.append('reason', reason);
              formData.append('remarks', remarks);

              $.ajax({
                     type: 'POST',
                     url: "ajax/savepenambahan.php",
                     data: formData,
                     cache: false,
                     processData: false,
                     contentType: false,
                     success: function (msg) {

                            dataTable.ajax.reload();

                            modals.style.display ="block";
                            mymodalss.style.display = "none";
                            $('#msg').html(msg);

                            $('#modal-default').modal('hide');  
                            $("[data-dismiss=modal]").trigger({type: "click"});  

                     }
              })
       }); 

       // Penghapusan

       $(document).on('click', '#submit_penghapusan', function(){

              mymodalss.style.display = "block";

              const fileupload    = $('#file_pengajuan').prop('files')[0];   

              var division = $('#division').val();
              var department = $('#department').val();
              var tipe_pengajuan = $('#tipe_pengajuan').val();

              var penghapusan_pos_code = document.getElementsByName('penghapusan_pos_code[]');
              var penghapusan_reason = document.getElementsByName('penghapusan_reason[]');
              var penghapusan_remaks = document.getElementsByName('penghapusan_remaks[]');


              // Buat Array pos_code
              var pos_code = '';
              for (var i = 0; i < penghapusan_pos_code.length; i++) {
                     var a = penghapusan_pos_code[i];
                     pos_code = pos_code + a.getAttribute("id1") + '-';
              };
                     pos_code = pos_code + ']';
              // Buat Array pos_code

              // Buat Array Reason
              var reason = '';
              for (var i = 0; i < penghapusan_reason.length; i++) {
                     var a = penghapusan_reason[i];
                     reason = reason + a.value + '-';
              };
                     reason = reason + ']';
              // Buat Array Reason

              // Buat Array Remarks
              var remarks = '';
              for (var i = 0; i < penghapusan_remaks.length; i++) {
                     var a = penghapusan_remaks[i];
                     remarks = remarks + a.value + '-';
              };
                     remarks = remarks + ']';
              // Buat Array Remarks


              let formData = new FormData();
              formData.append('file', fileupload);
              formData.append('division', division);
              formData.append('department', department);
              formData.append('tipe_pengajuan', tipe_pengajuan);
              formData.append('pos_code', pos_code);
              formData.append('reason', reason);
              formData.append('remarks', remarks);
              
              $.ajax({
                     type: 'POST',
                     url: "ajax/savepenghapusan.php",
                     data: formData,
                     cache: false,
                     processData: false,
                     contentType: false,
              success: function (msg) {

                     dataTable.ajax.reload();

                     modals.style.display ="block";
                     mymodalss.style.display = "none";
                     $('#msg').html(msg);

                     $('#modal-default').modal('hide');  
                     $("[data-dismiss=modal]").trigger({type: "click"});  
              
                     }
       
              });

       }); 


       // Peleburan

       $(document).on('click', '#submit_peleburan', function(){

       mymodalss.style.display = "block";

              const fileupload    = $('#file_pengajuan').prop('files')[0];   

              var division = $('#division').val();
              var department = $('#department').val();
              var tipe_pengajuan = $('#tipe_pengajuan').val();
              var peleburan_leader_pos = document.getElementsByName('peleburan_leader_pos[]');
              var peleburan_pos_name = document.getElementsByName('peleburan_pos_name[]');
              var peleburan_pos_code = document.getElementsByName('peleburan_pos_code[]');
              var peleburan_cost_center = document.getElementsByName('peleburan_cost_center[]');
              var peleburan_work_location = document.getElementsByName('peleburan_work_location[]');
              var peleburan_job_status = document.getElementsByName('peleburan_job_status[]');
              var peleburan_job_title = document.getElementsByName('peleburan_job_title[]');
              var peleburan_reason = document.getElementsByName('peleburan_reason[]');
              var peleburan_remarks = document.getElementsByName('peleburan_remarks[]');


              // Buat Array Leader Pos
              var leader_pos = '';
              for (var i = 0; i < peleburan_leader_pos.length; i++) {
                     var a = peleburan_leader_pos[i];
                     leader_pos = leader_pos + a.getAttribute("id1") + '-';
              };
                     leader_pos = leader_pos + ']';
              // Buat Array Leader Pos

              // Buat Array pos_code
              var pos_code = '';
              for (var i = 0; i < peleburan_pos_code.length; i++) {
                     var a = peleburan_pos_code[i];
                     pos_code = pos_code + a.getAttribute("id1") + '-';
              };
                     pos_code = pos_code + ']';
              // Buat Array pos_code

              // Buat Array Pos Name
              var pos_name = '';
              for (var i = 0; i < peleburan_pos_name.length; i++) {
                     var a = peleburan_pos_name[i];
                     pos_name = pos_name + a.value + '-';
              };
                     pos_name = pos_name + ']';
              // Buat Array Pos Name

              // Buat Array Cost Center
              var cost_center = '';
              for (var i = 0; i < peleburan_cost_center.length; i++) {
                     var a = peleburan_cost_center[i];
                     cost_center = cost_center + a.value + '-';
              };
                     cost_center = cost_center + ']';
              // Buat Array Cost Center

              // Buat Array Work Location
              var work_location = '';
              for (var i = 0; i < peleburan_work_location.length; i++) {
                     var a = peleburan_work_location[i];
                     work_location = work_location + a.value + '-';
              };
                     work_location = work_location + ']';
              // Buat Array Work Location

              // Buat Array Job Status
              var job_status = '';
              for (var i = 0; i < peleburan_job_status.length; i++) {
                     var a = peleburan_job_status[i];
                     job_status = job_status + a.value + '-';
              };
                     job_status = job_status + ']';
              // Buat Array Job Status

              // Buat Array Job Title
              var job_title = '';
              for (var i = 0; i < peleburan_job_title.length; i++) {
                     var a = peleburan_job_title[i];
                     job_title = job_title + a.value + '-';
              };
                     job_title = job_title + ']';
              // Buat Array Job Title

              // Buat Array Reason
              var reason = '';
              for (var i = 0; i < peleburan_reason.length; i++) {
                     var a = peleburan_reason[i];
                     reason = reason + a.value + '-';
              };
                     reason = reason + ']';
              // Buat Array Reason

              // Buat Array Remarks
              var remarks = '';
              for (var i = 0; i < peleburan_remarks.length; i++) {
                     var a = peleburan_remarks[i];
                     remarks = remarks + a.value + '-';
              };
                     remarks = remarks + ']';
              // Buat Array Remarks

              let formData = new FormData();
              formData.append('file', fileupload);
              formData.append('division', division);
              formData.append('department', department);
              formData.append('tipe_pengajuan', tipe_pengajuan);
              formData.append('leader_pos', leader_pos);
              formData.append('pos_code', pos_code);
              formData.append('pos_name', pos_name);
              formData.append('cost_center', cost_center);
              formData.append('work_location', work_location);
              formData.append('job_status', job_status);
              formData.append('job_title', job_title);
              formData.append('reason', reason);
              formData.append('remarks', remarks);

              $.ajax({
                     type: 'POST',
                     url: "ajax/savepeleburan.php",
                     data: formData,
                     cache: false,
                     processData: false,
                     contentType: false,
                     success: function (msg) {

                            dataTable.ajax.reload();

                            modals.style.display ="block";
                            mymodalss.style.display = "none";
                            $('#msg').html(msg);

                            $('#modal-default').modal('hide');  
                            $("[data-dismiss=modal]").trigger({type: "click"});  

                     }
              })

       }); 


       // Pemisahan

       $(document).on('click', '#submit_pemisahan', function(){

       mymodalss.style.display = "block";

              const fileupload    = $('#file_pengajuan').prop('files')[0];   

              var division = $('#division').val();
              var department = $('#department').val();
              var tipe_pengajuan = $('#tipe_pengajuan').val();
              var pemisahan_leader_pos = document.getElementsByName('pemisahan_leader_pos[]');
              var pemisahan_pos_name = document.getElementsByName('pemisahan_pos_name[]');
              var pemisahan_pos_code = document.getElementsByName('pemisahan_pos_code[]');
              var pemisahan_cost_center = document.getElementsByName('pemisahan_cost_center[]');
              var pemisahan_work_location = document.getElementsByName('pemisahan_work_location[]');
              var pemisahan_job_status = document.getElementsByName('pemisahan_job_status[]');
              var pemisahan_job_title = document.getElementsByName('pemisahan_job_title[]');
              var pemisahan_reason = document.getElementsByName('pemisahan_reason[]');
              var pemisahan_remarks = document.getElementsByName('pemisahan_remarks[]');


              // Buat Array Leader Pos
              var leader_pos = '';
              for (var i = 0; i < pemisahan_leader_pos.length; i++) {
                     var a = pemisahan_leader_pos[i];
                     leader_pos = leader_pos + a.getAttribute("id1") + '-';
              };
                     leader_pos = leader_pos + ']';
              // Buat Array Leader Pos

              // Buat Array pos_code
              var pos_code = '';
              for (var i = 0; i < pemisahan_pos_code.length; i++) {
                     var a = pemisahan_pos_code[i];
                     pos_code = pos_code + a.getAttribute("id1") + '-';
              };
                     pos_code = pos_code + ']';
              // Buat Array pos_code

              // Buat Array Pos Name
              var pos_name = '';
              for (var i = 0; i < pemisahan_pos_name.length; i++) {
                     var a = pemisahan_pos_name[i];
                     pos_name = pos_name + a.value + '-';
              };
                     pos_name = pos_name + ']';
              // Buat Array Pos Name

              // Buat Array Cost Center
              var cost_center = '';
              for (var i = 0; i < pemisahan_cost_center.length; i++) {
                     var a = pemisahan_cost_center[i];
                     cost_center = cost_center + a.value + '-';
              };
                     cost_center = cost_center + ']';
              // Buat Array Cost Center

              // Buat Array Work Location
              var work_location = '';
              for (var i = 0; i < pemisahan_work_location.length; i++) {
                     var a = pemisahan_work_location[i];
                     work_location = work_location + a.value + '-';
              };
                     work_location = work_location + ']';
              // Buat Array Work Location

              // Buat Array Job Status
              var job_status = '';
              for (var i = 0; i < pemisahan_job_status.length; i++) {
                     var a = pemisahan_job_status[i];
                     job_status = job_status + a.value + '-';
              };
                     job_status = job_status + ']';
              // Buat Array Job Status

              // Buat Array Job Title
              var job_title = '';
              for (var i = 0; i < pemisahan_job_title.length; i++) {
                     var a = pemisahan_job_title[i];
                     job_title = job_title + a.value + '-';
              };
                     job_title = job_title + ']';
              // Buat Array Job Title

              // Buat Array Reason
              var reason = '';
              for (var i = 0; i < pemisahan_reason.length; i++) {
                     var a = pemisahan_reason[i];
                     reason = reason + a.value + '-';
              };
                     reason = reason + ']';
              // Buat Array Reason

              // Buat Array Remarks
              var remarks = '';
              for (var i = 0; i < pemisahan_remarks.length; i++) {
                     var a = pemisahan_remarks[i];
                     remarks = remarks + a.value + '-';
              };
                     remarks = remarks + ']';
              // Buat Array Remarks

              let formData = new FormData();
              formData.append('file', fileupload);
              formData.append('division', division);
              formData.append('department', department);
              formData.append('tipe_pengajuan', tipe_pengajuan);
              formData.append('leader_pos', leader_pos);
              formData.append('pos_code', pos_code);
              formData.append('pos_name', pos_name);
              formData.append('cost_center', cost_center);
              formData.append('work_location', work_location);
              formData.append('job_status', job_status);
              formData.append('job_title', job_title);
              formData.append('reason', reason);
              formData.append('remarks', remarks);

              $.ajax({
                     type: 'POST',
                     url: "ajax/savepemisahan.php",
                     data: formData,
                     cache: false,
                     processData: false,
                     contentType: false,
                     success: function (msg) {

                            dataTable.ajax.reload();

                            modals.style.display ="block";
                            mymodalss.style.display = "none";
                            $('#msg').html(msg);

                            $('#modal-default').modal('hide');  
                            $("[data-dismiss=modal]").trigger({type: "click"});  

                     }
              })

       }); 

       // Ajax save


       // Preview

       // Penambahan
       $(document).on('click', '#submit_penambahan_view', function(){

              mymodalss.style.display = "block";

              const fileupload    = $('#file_pengajuan').prop('files')[0];   

              var req_no = $('#req_no_penambahan').val();
              var division = $('#division').val();
              var department = $('#department').val();
              var tipe_pengajuan = $('#tipe_pengajuan').val();
              var penambahan_orgorpos = document.getElementsByName('penambahan_orgorpos_view[]');
              var penambahan_leader_pos = document.getElementsByName('penambahan_leader_pos_view[]');
              var penambahan_pos_name = document.getElementsByName('penambahan_pos_name_view[]');
              var penambahan_cost_center = document.getElementsByName('penambahan_cost_center_view[]');
              var penambahan_work_location = document.getElementsByName('penambahan_work_location_view[]');
              var penambahan_job_status = document.getElementsByName('penambahan_job_status_view[]');
              var penambahan_job_title = document.getElementsByName('penambahan_job_title_view[]');
              var penambahan_reason = document.getElementsByName('penambahan_reason_view[]');
              var penambahan_remarks = document.getElementsByName('penambahan_remarks_view[]');



              // Buat Array Org/Pos
              var orgpos = '';
              for (var i = 0; i < penambahan_orgorpos.length; i++) {
                     var a = penambahan_orgorpos[i];
                     orgpos = orgpos + a.value + '-';
              };
                     orgpos = orgpos + ']';
              // Buat Array Org/Pos

              // Buat Array Leader Pos
              var leader_pos = '';
              for (var i = 0; i < penambahan_leader_pos.length; i++) {
                     var a = penambahan_leader_pos[i];
                     leader_pos = leader_pos + a.getAttribute("id1") + '-';
              };
                     leader_pos = leader_pos + ']';
              // Buat Array Leader Pos

              // Buat Array Pos Name
              var pos_name = '';
              for (var i = 0; i < penambahan_pos_name.length; i++) {
                     var a = penambahan_pos_name[i];
                     pos_name = pos_name + a.value + '-';
              };
                     pos_name = pos_name + ']';
              // Buat Array Pos Name

              // Buat Array Cost Center
              var cost_center = '';
              for (var i = 0; i < penambahan_cost_center.length; i++) {
                     var a = penambahan_cost_center[i];
                     cost_center = cost_center + a.value + '-';
              };
                     cost_center = cost_center + ']';
              // Buat Array Cost Center

              // Buat Array Work Location
              var work_location = '';
              for (var i = 0; i < penambahan_work_location.length; i++) {
                     var a = penambahan_work_location[i];
                     work_location = work_location + a.value + '-';
              };
                     work_location = work_location + ']';
              // Buat Array Work Location

              // Buat Array Job Status
              var job_status = '';
              for (var i = 0; i < penambahan_job_status.length; i++) {
                     var a = penambahan_job_status[i];
                     job_status = job_status + a.value + '-';
              };
                     job_status = job_status + ']';
              // Buat Array Job Status

              // Buat Array Job Title
              var job_title = '';
              for (var i = 0; i < penambahan_job_title.length; i++) {
                     var a = penambahan_job_title[i];
                     job_title = job_title + a.value + '-';
              };
                     job_title = job_title + ']';
              // Buat Array Job Title

              // Buat Array Reason
              var reason = '';
              for (var i = 0; i < penambahan_reason.length; i++) {
                     var a = penambahan_reason[i];
                     reason = reason + a.value + '-';
              };
                     reason = reason + ']';
              // Buat Array Reason

              // Buat Array Remarks
              var remarks = '';
              for (var i = 0; i < penambahan_remarks.length; i++) {
                     var a = penambahan_remarks[i];
                     remarks = remarks + a.value + '-';
              };
                     remarks = remarks + ']';
              // Buat Array Remarks

              let formData = new FormData();
              formData.append('req_no', req_no);
              formData.append('file', fileupload);
              formData.append('division', division);
              formData.append('department', department);
              formData.append('tipe_pengajuan', tipe_pengajuan);
              formData.append('orgpos', orgpos);
              formData.append('leader_pos', leader_pos);
              formData.append('pos_name', pos_name);
              formData.append('cost_center', cost_center);
              formData.append('work_location', work_location);
              formData.append('job_status', job_status);
              formData.append('job_title', job_title);
              formData.append('reason', reason);
              formData.append('remarks', remarks);

              $.ajax({
                     type: 'POST',
                     url: "ajax/updatepenambahan.php",
                     data: formData,
                     cache: false,
                     processData: false,
                     contentType: false,
                     success: function (msg) {

                            dataTable.ajax.reload();

                            modals.style.display ="block";
                            mymodalss.style.display = "none";
                            $('#msg').html(msg);

                            $('#modal-default').modal('hide');  
                            $("[data-dismiss=modal]").trigger({type: "click"});  

                     }
              })

       
       }); 


       // Penghapusan

       $(document).on('click', '#submit_penghapusan_view', function(){

              mymodalss.style.display = "block";

              const fileupload    = $('#file_pengajuan').prop('files')[0];   

              var req_no = $('#req_no_penghapusan').val();
              var division = $('#division').val();
              var department = $('#department').val();
              var tipe_pengajuan = $('#tipe_pengajuan').val();

              var penghapusan_pos_code = document.getElementsByName('penghapusan_pos_code_view[]');
              var penghapusan_reason = document.getElementsByName('penghapusan_reason_view[]');
              var penghapusan_remaks = document.getElementsByName('penghapusan_remaks_view[]');


              // Buat Array pos_code
              var pos_code = '';
              for (var i = 0; i < penghapusan_pos_code.length; i++) {
                     var a = penghapusan_pos_code[i];
                     pos_code = pos_code + a.getAttribute("id1") + '-';
              };
                     pos_code = pos_code + ']';
              // Buat Array pos_code

              // Buat Array Reason
              var reason = '';
              for (var i = 0; i < penghapusan_reason.length; i++) {
                     var a = penghapusan_reason[i];
                     reason = reason + a.value + '-';
              };
                     reason = reason + ']';
              // Buat Array Reason

              // Buat Array Remarks
              var remarks = '';
              for (var i = 0; i < penghapusan_remaks.length; i++) {
                     var a = penghapusan_remaks[i];
                     remarks = remarks + a.value + '-';
              };
                     remarks = remarks + ']';
              // Buat Array Remarks

              let formData = new FormData();
              formData.append('req_no', req_no);
              formData.append('file', fileupload);
              formData.append('division', division);
              formData.append('department', department);
              formData.append('tipe_pengajuan', tipe_pengajuan);
              formData.append('pos_code', pos_code);
              formData.append('reason', reason);
              formData.append('remarks', remarks);
              
              $.ajax({
                     type: 'POST',
                     url: "ajax/updatepenghapusan.php",
                     data: formData,
                     cache: false,
                     processData: false,
                     contentType: false,
              success: function (msg) {

                     dataTable.ajax.reload();

                     modals.style.display ="block";
                     mymodalss.style.display = "none";
                     $('#msg').html(msg);

                     $('#modal-default').modal('hide');  
                     $("[data-dismiss=modal]").trigger({type: "click"});  
              
                     }
       
              });

       }); 

       // Peleburan

       $(document).on('click', '#submit_peleburan_view', function(){

              // mymodalss.style.display = "block";

              const fileupload    = $('#file_pengajuan').prop('files')[0];   

              var req_no = $('#req_no_peleburan').val();
              var division = $('#division').val();
              var department = $('#department').val();
              var tipe_pengajuan = $('#tipe_pengajuan').val();
              var peleburan_leader_pos = document.getElementsByName('peleburan_leader_pos_view[]');
              var peleburan_pos_name = document.getElementsByName('peleburan_pos_name_view[]');
              var peleburan_pos_code = document.getElementsByName('peleburan_pos_code_view[]');
              var peleburan_cost_center = document.getElementsByName('peleburan_cost_center_view[]');
              var peleburan_work_location = document.getElementsByName('peleburan_work_location_view[]');
              var peleburan_job_status = document.getElementsByName('peleburan_job_status_view[]');
              var peleburan_job_title = document.getElementsByName('peleburan_job_title_view[]');
              var peleburan_reason = document.getElementsByName('peleburan_reason_view[]');
              var peleburan_remarks = document.getElementsByName('peleburan_remarks_view[]');


              // Buat Array Leader Pos
              var leader_pos = '';
              for (var i = 0; i < peleburan_leader_pos.length; i++) {
                     var a = peleburan_leader_pos[i];
                     leader_pos = leader_pos + a.getAttribute("id1") + '-';
              };
                     leader_pos = leader_pos + ']';
              // Buat Array Leader Pos

              // Buat Array pos_code
              var pos_code = '';
              for (var i = 0; i < peleburan_pos_code.length; i++) {
                     var a = peleburan_pos_code[i];
                     pos_code = pos_code + a.getAttribute("id1") + '-';
              };
                     pos_code = pos_code + ']';
              // Buat Array pos_code

              // Buat Array Pos Name
              var pos_name = '';
              for (var i = 0; i < peleburan_pos_name.length; i++) {
                     var a = peleburan_pos_name[i];
                     pos_name = pos_name + a.value + '-';
              };
                     pos_name = pos_name + ']';
              // Buat Array Pos Name

              // Buat Array Cost Center
              var cost_center = '';
              for (var i = 0; i < peleburan_cost_center.length; i++) {
                     var a = peleburan_cost_center[i];
                     cost_center = cost_center + a.value + '-';
              };
                     cost_center = cost_center + ']';
              // Buat Array Cost Center

              // Buat Array Work Location
              var work_location = '';
              for (var i = 0; i < peleburan_work_location.length; i++) {
                     var a = peleburan_work_location[i];
                     work_location = work_location + a.value + '-';
              };
                     work_location = work_location + ']';
              // Buat Array Work Location

              // Buat Array Job Status
              var job_status = '';
              for (var i = 0; i < peleburan_job_status.length; i++) {
                     var a = peleburan_job_status[i];
                     job_status = job_status + a.value + '-';
              };
                     job_status = job_status + ']';
              // Buat Array Job Status

              // Buat Array Job Title
              var job_title = '';
              for (var i = 0; i < peleburan_job_title.length; i++) {
                     var a = peleburan_job_title[i];
                     job_title = job_title + a.value + '-';
              };
                     job_title = job_title + ']';
              // Buat Array Job Title

              // Buat Array Reason
              var reason = '';
              for (var i = 0; i < peleburan_reason.length; i++) {
                     var a = peleburan_reason[i];
                     reason = reason + a.value + '-';
              };
                     reason = reason + ']';
              // Buat Array Reason

              // Buat Array Remarks
              var remarks = '';
              for (var i = 0; i < peleburan_remarks.length; i++) {
                     var a = peleburan_remarks[i];
                     remarks = remarks + a.value + '-';
              };
                     remarks = remarks + ']';
              // Buat Array Remarks

              let formData = new FormData();
              formData.append('req_no', req_no);
              formData.append('file', fileupload);
              formData.append('division', division);
              formData.append('department', department);
              formData.append('tipe_pengajuan', tipe_pengajuan);
              formData.append('leader_pos', leader_pos);
              formData.append('pos_code', pos_code);
              formData.append('pos_name', pos_name);
              formData.append('cost_center', cost_center);
              formData.append('work_location', work_location);
              formData.append('job_status', job_status);
              formData.append('job_title', job_title);
              formData.append('reason', reason);
              formData.append('remarks', remarks);

              $.ajax({
                     type: 'POST',
                     url: "ajax/updatepeleburan.php",
                     data: formData,
                     cache: false,
                     processData: false,
                     contentType: false,
                     success: function (msg) {

                            dataTable.ajax.reload();

                            modals.style.display ="block";
                            mymodalss.style.display = "none";
                            $('#msg').html(msg);

                            $('#modal-default').modal('hide');  
                            $("[data-dismiss=modal]").trigger({type: "click"});  

                     }
              })
              

       }); 

              // Pemisahan

       $(document).on('click', '#submit_pemisahan_view', function(){

              // mymodalss.style.display = "block";

              const fileupload    = $('#file_pengajuan').prop('files')[0];   

              var req_no = $('#req_no_pemisahan').val();
              var division = $('#division').val();
              var department = $('#department').val();
              var tipe_pengajuan = $('#tipe_pengajuan').val();
              var pemisahan_leader_pos = document.getElementsByName('pemisahan_leader_pos_view[]');
              var pemisahan_pos_name = document.getElementsByName('pemisahan_pos_name_view[]');
              var pemisahan_pos_code = document.getElementsByName('pemisahan_pos_code_view[]');
              var pemisahan_cost_center = document.getElementsByName('pemisahan_cost_center_view[]');
              var pemisahan_work_location = document.getElementsByName('pemisahan_work_location_view[]');
              var pemisahan_job_status = document.getElementsByName('pemisahan_job_status_view[]');
              var pemisahan_job_title = document.getElementsByName('pemisahan_job_title_view[]');
              var pemisahan_reason = document.getElementsByName('pemisahan_reason_view[]');
              var pemisahan_remarks = document.getElementsByName('pemisahan_remarks_view[]');


              // Buat Array Leader Pos
              var leader_pos = '';
              for (var i = 0; i < pemisahan_leader_pos.length; i++) {
                     var a = pemisahan_leader_pos[i];
                     leader_pos = leader_pos + a.getAttribute("id1") + '-';
              };
                     leader_pos = leader_pos + ']';
              // Buat Array Leader Pos

              // Buat Array pos_code
              var pos_code = '';
              for (var i = 0; i < pemisahan_pos_code.length; i++) {
                     var a = pemisahan_pos_code[i];
                     pos_code = pos_code + a.getAttribute("id1") + '-';
              };
                     pos_code = pos_code + ']';
              // Buat Array pos_code

              // Buat Array Pos Name
              var pos_name = '';
              for (var i = 0; i < pemisahan_pos_name.length; i++) {
                     var a = pemisahan_pos_name[i];
                     pos_name = pos_name + a.value + '-';
              };
                     pos_name = pos_name + ']';
              // Buat Array Pos Name

              // Buat Array Cost Center
              var cost_center = '';
              for (var i = 0; i < pemisahan_cost_center.length; i++) {
                     var a = pemisahan_cost_center[i];
                     cost_center = cost_center + a.value + '-';
              };
                     cost_center = cost_center + ']';
              // Buat Array Cost Center

              // Buat Array Work Location
              var work_location = '';
              for (var i = 0; i < pemisahan_work_location.length; i++) {
                     var a = pemisahan_work_location[i];
                     work_location = work_location + a.value + '-';
              };
                     work_location = work_location + ']';
              // Buat Array Work Location

              // Buat Array Job Status
              var job_status = '';
              for (var i = 0; i < pemisahan_job_status.length; i++) {
                     var a = pemisahan_job_status[i];
                     job_status = job_status + a.value + '-';
              };
                     job_status = job_status + ']';
              // Buat Array Job Status

              // Buat Array Job Title
              var job_title = '';
              for (var i = 0; i < pemisahan_job_title.length; i++) {
                     var a = pemisahan_job_title[i];
                     job_title = job_title + a.value + '-';
              };
                     job_title = job_title + ']';
              // Buat Array Job Title

              // Buat Array Reason
              var reason = '';
              for (var i = 0; i < pemisahan_reason.length; i++) {
                     var a = pemisahan_reason[i];
                     reason = reason + a.value + '-';
              };
                     reason = reason + ']';
              // Buat Array Reason

              // Buat Array Remarks
              var remarks = '';
              for (var i = 0; i < pemisahan_remarks.length; i++) {
                     var a = pemisahan_remarks[i];
                     remarks = remarks + a.value + '-';
              };
                     remarks = remarks + ']';
              // Buat Array Remarks

              let formData = new FormData();
              formData.append('req_no', req_no);
              formData.append('file', fileupload);
              formData.append('division', division);
              formData.append('department', department);
              formData.append('tipe_pengajuan', tipe_pengajuan);
              formData.append('leader_pos', leader_pos);
              formData.append('pos_code', pos_code);
              formData.append('pos_name', pos_name);
              formData.append('cost_center', cost_center);
              formData.append('work_location', work_location);
              formData.append('job_status', job_status);
              formData.append('job_title', job_title);
              formData.append('reason', reason);
              formData.append('remarks', remarks);

              $.ajax({
                     type: 'POST',
                     url: "ajax/updatepemisahan.php",
                     data: formData,
                     cache: false,
                     processData: false,
                     contentType: false,
                     success: function (msg) {

                            dataTable.ajax.reload();

                            modals.style.display ="block";
                            mymodalss.style.display = "none";
                            $('#msg').html(msg);

                            $('#modal-default').modal('hide');  
                            $("[data-dismiss=modal]").trigger({type: "click"});  

                     }
              })

       }); 
     
       
    });



       
</script>




