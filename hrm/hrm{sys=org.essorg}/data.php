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
                                          
                                        <!--<td>
                                          <form action="export/excel" method="POST">
                                          
                                          <input type="hidden" name="data_search" value="<?php echo $search; ?>">
                                        

                                                
                                                        <button type="submit" class="toolbar sprite-toolbar-excel" id="EXCEL" style="border: 0;background-color: white;" name="submit_approve" value="submit">
                                                        </button>


                                                  
                                          </form>
                                        </td>-->
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
                                                               <th class="fontCustom" style="z-index: 1;">Request Position</th>
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
          <div class="modal-dialog modal-md">
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
          <div class="modal-dialog modal-bg">
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
     

       //     dataTable = $('.table').DataTable({
       //        "paging":true,  
       //        "processing": true,
       //        "serverSide": true,
       //        "info":true,
       //        "bFilter":false,
       //        "ajax":{
       //                 "url": "ajax/ajax_data.php?action=table_data",
       //                 "dataType": "json",
       //                 "type": "POST"
       //               },
            
       //        "columns": [
       //            { "data": "request_no" },
       //            { "data": "Full_Name" },
       //            { "data": "request_date" },
       //            { "data": "pos_name_en_1" },
       //            { "data": "pos_name_en_2" },
       //            { "data": "position_name" },
       //            { "data": "request_type" },
       //            { "data": "name_en_1" },
       //            { "data": "name_en_2" },
       //            { "data": "aksi", "orderable":false, },
                  

       //        ] 



       //    });
       dataTable = $("#datatable").DataTable({
              
              dom: "B<'row'<'col-sm-12 col-md-9'l><'col-sm-12 col-md-9'f>>" +
                   "<'row'<'col-sm-12'tr>>" +
                   "<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-7'p>>",

              processing: true,
              // retrieve: true,
              searching: false,
              paging: true,
              order: [
                     [7, "desc"]
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
                            "targets":[9],
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

              
              // modals.style.display ="block";
              //               document.getElementById("msg").innerHTML = "Overtime code cannot empty";
                   
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
              const fileupload    = $('#penambahan_file').prop('files')[0];   

              var button           = $(this).attr('id1');
        
              var division         = $('#division').val();
              var department       = $('#department').val();
              var type             = $('#tipe_pengajuan').val();

	      var orgpos           = $('#penambahan_orgorpos').val();
              var leader_pos       = $('#penambahan_leader_pos').attr('id1');
              var pos_name         = $('#penambahan_pos_name').val();
              var cost_center      = $('#penambahan_cost_center').val();
              var work_location    = $('#penambahan_work_location').val();
              var job_status       = $('#penambahan_job_status').val();
              var jobtitle_code    = $('#penambahan_job_title').val();
              var reason           = $('#penambahan_reason').val();
              var remarks          = $('#penambahan_remark').val();

      

              if(division == ''){
                     alert('Division is required!');
                     mymodalss.style.display = "none";
                     return;
              }else if(department == ''){
                     alert('Department is required!');
                     mymodalss.style.display = "none";
                     return;
              }else if(type == ''){
                     alert('Type is required!');
                     mymodalss.style.display = "none";
                     return;
              }else if(orgpos == ''){
                     alert('Org unit/Position is required!');
                     mymodalss.style.display = "none";
                     return;
              }else if(leader_pos == ''){
                     alert('Leader position is required!');
                     mymodalss.style.display = "none";
                     return;
              }else if(pos_name == ''){
                     alert('Position name is required!');
                     mymodalss.style.display = "none";
                     return;
              }else if(cost_center == ''){
                     alert('Cost center is required!');
                     mymodalss.style.display = "none";
                     return
              }else if(work_location == ''){
                     alert('Work location is required!');
                     mymodalss.style.display = "none";
                     return
              }else if(job_status == ''){
                     alert('Job status is required!');
                     mymodalss.style.display = "none";
                     return
              }else if(jobtitle_code == ''){
                     alert('Job title is required!');
                     mymodalss.style.display = "none";
                     return
              }else if(reason == ''){
                     alert('Reason is required!');
                     mymodalss.style.display = "none";
                     return
              }

              let formData = new FormData();
              formData.append('file', fileupload);
              formData.append('button', button);
              formData.append('division', division);
              formData.append('department', department);
              formData.append('type', type);
	      formData.append('orgpos', orgpos);
              formData.append('leader_pos', leader_pos);
              formData.append('pos_name', pos_name);
              formData.append('cost_center', cost_center);
              formData.append('work_location', work_location);
              formData.append('job_status', job_status);
              formData.append('jobtitle_code', jobtitle_code);
              formData.append('reason', reason);
              formData.append('remarks', remarks);
               
              $.ajax({
                     type: 'POST',
                     url: "ajax_add_request.php",
                     data: formData,
                     cache: false,
                     processData: false,
                     contentType: false,
	            success: function (msg) {
	                modals.style.display ="block";
                       mymodalss.style.display = "none";
                       $('#msg').html(msg);

                       dataTable.ajax.reload();

                     //   Empty form

                     $('#penambahan_leader_pos').val('');
                     $('#penambahan_leader_pos').attr('id1', '');
                     $('#penambahan_pos_name').val('');
                     
                     var cost_center1 = [];
                        $.each($("#penambahan_cost_center option:selected"), function () {
                            cost_center1.push($(this).val());
                            $(this).prop('selected', false); // <-- HERE
                     });

                     var work_location1 = [];
                        $.each($("#penambahan_work_location option:selected"), function () {
                            work_location1.push($(this).val());
                            $(this).prop('selected', false); // <-- HERE
                     });

                     var job_status1 = [];
                        $.each($("#penambahan_job_status option:selected"), function () {
                            job_status1.push($(this).val());
                            $(this).prop('selected', false); // <-- HERE
                     });
                     
                     var job_title1 = [];
                        $.each($("#penambahan_job_title option:selected"), function () {
                            job_title1.push($(this).val());
                            $(this).prop('selected', false); // <-- HERE
                     });

                     $('#penambahan_reason').val('');
                     $('#penambahan_remark').val('');

                     //   Empty form

                     // $('#modal-default').modal('hide');
                     // $('.modal-backdrop').remove();
                     

                     return false;
	            }
	            
	       });

       }); 

       // Penghapusan

       $(document).on('click', '#submit_penghapusan', function(){

       mymodalss.style.display = "block";
       const fileupload    = $('#penghapusan_file').prop('files')[0];   

       var button           = $(this).attr('id1');

       var division         = $('#division').val();
       var department       = $('#department').val();
       var type             = $('#tipe_pengajuan').val();

       var leader_pos       = $('#penghapusan_leader_pos').attr('id1');
       var pos_name         = $('#penghapusan_pos_name').val();
       var pos_code         = $('#penghapusan_pos_code').val();
       var cost_center      = $('#penghapusan_cost_center').val();
       var work_location    = $('#penghapusan_work_location').attr('id1');
       var job_status       = $('#penghapusan_job_status').attr('id1');
       var jobtitle_code    = $('#penghapusan_jobtitle_code').attr('id1');
       var reason           = $('#penghapusan_reason').val();
       var remarks          = $('#penghapusan_remark').val();

       // alert(division);
       // alert(department);
       // alert(type);
       // alert(leader_pos);
       // alert(pos_name);
       // alert(cost_center);
       // alert(work_location);
       // alert(job_status);
       // alert(jobtitle_code);
       // alert(reason);
       // alert(remarks);

       if(division == ''){
              alert('Division is required!');
              mymodalss.style.display = "none";
              return;
       }else if(department == ''){
              alert('Department is required!');
              mymodalss.style.display = "none";
              return;
       }else if(type == ''){
              alert('Type is required!');
              mymodalss.style.display = "none";
              return;
       }else if(leader_pos == ''){
              alert('Leader position is required!');
              mymodalss.style.display = "none";
              return;
       }else if(pos_name == ''){
              alert('Position name is required!');
              mymodalss.style.display = "none";
              return;
       }else if(cost_center == ''){
              alert('Cost center is required!');
              mymodalss.style.display = "none";
              return
       }else if(work_location == ''){
              alert('Work location is required!');
              mymodalss.style.display = "none";
              return
       }else if(job_status == ''){
              alert('Job status is required!');
              mymodalss.style.display = "none";
              return
       }else if(jobtitle_code == ''){
              alert('Job title is required!');
              mymodalss.style.display = "none";
              return
       }else if(reason == ''){
              alert('Reason is required!');
              mymodalss.style.display = "none";
              return
       }

       let formData = new FormData();
       formData.append('file', fileupload);
       formData.append('button', button);
       formData.append('division', division);
       formData.append('department', department);
       formData.append('type', type);
       formData.append('leader_pos', leader_pos);
       formData.append('pos_name', pos_name);
       formData.append('pos_code', pos_code);
       formData.append('cost_center', cost_center);
       formData.append('work_location', work_location);
       formData.append('job_status', job_status);
       formData.append('jobtitle_code', jobtitle_code);
       formData.append('reason', reason);
       formData.append('remarks', remarks);
       
       $.ajax({
              type: 'POST',
              url: "ajax_delete_request.php",
              data: formData,
              cache: false,
              processData: false,
              contentType: false,
       success: function (msg) {
              modals.style.display ="block";
              mymodalss.style.display = "none";
              $('#msg').html(msg);

              dataTable.ajax.reload();

              //   Empty form

              $('#penghapusan_leader_pos').val('');
              $('#penghapusan_leader_pos').attr('id1', '');
              $('#penghapusan_pos_name').val('');
              $('#penghapusan_pos_name').attr('id1', '');

              $('#penghapusan_pos_code').val('');
              $('#penghapusan_pos_code').attr('id1', '');
              

              $('#penghapusan_cost_center').val('');
              $('#penghapusan_cost_center').attr('id1', '');

              $('#penghapusan_work_location').val('');
              $('#penghapusan_work_location').attr('id1', '');

              $('#penghapusan_job_status').val('');
              $('#penghapusan_job_status').attr('id1', '');

              $('#penghapusan_jobtitle_code').val('');
              $('#penghapusan_jobtitle_code').attr('id1', '');
             

              $('#penghapusan_reason').val('');
              $('#penghapusan_remark').val('');

              //   Empty form
              

              return false;
       }
       
       });

       }); 


       // Peleburan

       $(document).on('click', '#submit_peleburan', function(){

       mymodalss.style.display = "block";
       const fileupload    = $('#peleburan_file').prop('files')[0];   

       var button           = $(this).attr('id1');

       var division         = $('#division').val();
       var department       = $('#department').val();
       var type             = $('#tipe_pengajuan').val();

       var leader_pos       = $('#peleburan_leader_pos').attr('id1');
       var pos_name         = $('#peleburan_pos_name').val();
       var pos_code         = $('#peleburan_pos_code').attr('id1');
       var cost_center      = $('#peleburan_cost_center').val();
       var work_location    = $('#peleburan_work_location').val();
       var job_status       = $('#peleburan_job_status').val();
       var jobtitle_code    = $('#peleburan_jobtitle_code').val();
       var reason           = $('#peleburan_reason').val();
       var remarks          = $('#peleburan_remark').val();

       
       if(division == ''){
              alert('Division is required!');
              mymodalss.style.display = "none";
              return;
       }else if(department == ''){
              alert('Department is required!');
              mymodalss.style.display = "none";
              return;
       }else if(type == ''){
              alert('Type is required!');
              mymodalss.style.display = "none";
              return;
       }else if(leader_pos == ''){
              alert('Leader position is required!');
              mymodalss.style.display = "none";
              return;
       }else if(pos_name == ''){
              alert('Position name is required!');
              mymodalss.style.display = "none";
              return;
       }else if(cost_center == ''){
              alert('Cost center is required!');
              mymodalss.style.display = "none";
              return
       }else if(work_location == ''){
              alert('Work location is required!');
              mymodalss.style.display = "none";
              return
       }else if(job_status == ''){
              alert('Job status is required!');
              mymodalss.style.display = "none";
              return
       }else if(jobtitle_code == ''){
              alert('Job title is required!');
              mymodalss.style.display = "none";
              return
       }else if(reason == ''){
              alert('Reason is required!');
              mymodalss.style.display = "none";
              return
       }

       let formData = new FormData();
       formData.append('file', fileupload);
       formData.append('button', button);
       formData.append('division', division);
       formData.append('department', department);
       formData.append('type', type);
       formData.append('leader_pos', leader_pos);
       formData.append('pos_name', pos_name);
       formData.append('pos_code', pos_code);
       formData.append('cost_center', cost_center);
       formData.append('work_location', work_location);
       formData.append('job_status', job_status);
       formData.append('jobtitle_code', jobtitle_code);
       formData.append('reason', reason);
       formData.append('remarks', remarks);

       $.ajax({
              type: 'POST',
              url: "ajax_fusion_request.php",
              data: formData,
              cache: false,
              processData: false,
              contentType: false,
       success: function (msg) {
              modals.style.display ="block";
              mymodalss.style.display = "none";
              $('#msg').html(msg);

              dataTable.ajax.reload();

              //   Empty form

              $('#tampil_lp').html('<input class="input--style-6" id1="" name="peleburan_leader_pos" id="peleburan_leader_pos" type="Text" value="" size="30" disabled>');
              $('#tampil_pn').html('<input class="input--style-6" id1="" name="peleburan_pos_name" id="peleburan_pos_name" type="Text" value="" size="30" disabled>');

              $('#peleburan_pos_code').val('');
              $('#peleburan_pos_code').attr('id1', '');
              

              $('#tampil_cc').html('<input class="input--style-6" id1="" name="peleburan_cost_center" id="peleburan_cost_center" type="Text" value="" size="30" disabled>');


              $('#tampil_wl').html('<input class="input--style-6" id1="" name="peleburan_work_location" id="peleburan_work_location" type="Text" value="" size="30" disabled>');


              $('#tampil_js').html('<input class="input--style-6" id1="" name="peleburan_job_status" id="peleburan_job_status" type="Text" value="" size="30" disabled>');


              $('#tampil_jt').html('<input class="input--style-6" id1="" name="peleburan_jobtitle_code" id="peleburan_jobtitle_code" type="Text" value="" size="30" disabled>');

             

              $('#peleburan_reason').val('');
              $('#peleburan_remark').val('');

              //   Empty form
              

              return false;
       }

       });

       }); 


       // Pemisahan

       $(document).on('click', '#submit_pemisahan', function(){

       mymodalss.style.display = "block";
       const fileupload    = $('#pemisahan_file').prop('files')[0];   

       var button           = $(this).attr('id1');

       var division         = $('#division').val();
       var department       = $('#department').val();
       var type             = $('#tipe_pengajuan').val();

       var leader_pos       = $('#pemisahan_leader_pos').attr('id1');
       var pos_name         = $('#pemisahan_pos_name').val();
       var pos_code         = $('#pemisahan_pos_code').attr('id1');
       var cost_center      = $('#pemisahan_cost_center').val();
       var work_location    = $('#pemisahan_work_location').val();
       var job_status       = $('#pemisahan_job_status').val();
       var jobtitle_code    = $('#pemisahan_jobtitle_code').val();
       var reason           = $('#pemisahan_reason').val();
       var remarks          = $('#pemisahan_remark').val();


       if(division == ''){
              alert('Division is required!');
              mymodalss.style.display = "none";
              return;
       }else if(department == ''){
              alert('Department is required!');
              mymodalss.style.display = "none";
              return;
       }else if(type == ''){
              alert('Type is required!');
              mymodalss.style.display = "none";
              return;
       }else if(leader_pos == ''){
              alert('Leader position is required!');
              mymodalss.style.display = "none";
              return;
       }else if(pos_name == ''){
              alert('Position name is required!');
              mymodalss.style.display = "none";
              return;
       }else if(cost_center == ''){
              alert('Cost center is required!');
              mymodalss.style.display = "none";
              return
       }else if(work_location == ''){
              alert('Work location is required!');
              mymodalss.style.display = "none";
              return
       }else if(job_status == ''){
              alert('Job status is required!');
              mymodalss.style.display = "none";
              return
       }else if(jobtitle_code == ''){
              alert('Job title is required!');
              mymodalss.style.display = "none";
              return
       }else if(reason == ''){
              alert('Reason is required!');
              mymodalss.style.display = "none";
              return
       }

       let formData = new FormData();
       formData.append('file', fileupload);
       formData.append('button', button);
       formData.append('division', division);
       formData.append('department', department);
       formData.append('type', type);
       formData.append('leader_pos', leader_pos);
       formData.append('pos_name', pos_name);
       formData.append('pos_code', pos_code);
       formData.append('cost_center', cost_center);
       formData.append('work_location', work_location);
       formData.append('job_status', job_status);
       formData.append('jobtitle_code', jobtitle_code);
       formData.append('reason', reason);
       formData.append('remarks', remarks);

       $.ajax({
              type: 'POST',
              url: "ajax_separation_request.php",
              data: formData,
              cache: false,
              processData: false,
              contentType: false,
       success: function (msg) {
              modals.style.display ="block";
              mymodalss.style.display = "none";
              $('#msg').html(msg);

              dataTable.ajax.reload();

              //   Empty form

              $('#tampil_lp_pl').html('<input class="input--style-6" id1="" name="pemisahan_leader_pos" id="pemisahan_leader_pos" type="Text" value="" size="30" disabled>');
              $('#tampil_pn_pl').html('<input class="input--style-6" id1="" name="pemisahan_pos_name" id="pemisahan_pos_name" type="Text" value="" size="30" disabled>');

              $('#pemisahan_pos_code').val('');
              $('#pemisahan_pos_code').attr('id1', '');
              

              $('#tampil_cc_pl').html('<input class="input--style-6" id1="" name="pemisahan_cost_center" id="pemisahan_cost_center" type="Text" value="" size="30" disabled>');


              $('#tampil_wl_pl').html('<input class="input--style-6" id1="" name="pemisahan_work_location" id="pemisahan_work_location" type="Text" value="" size="30" disabled>');


              $('#tampil_js_pl').html('<input class="input--style-6" id1="" name="pemisahan_job_status" id="pemisahan_job_status" type="Text" value="" size="30" disabled>');


              $('#tampil_jt_pl').html('<input class="input--style-6" id1="" name="pemisahan_jobtitle_code" id="pemisahan_jobtitle_code" type="Text" value="" size="30" disabled>');

       

              $('#pemisahan_reason').val('');
              $('#pemisahan_remark').val('');

              //   Empty form
              

              return false;
       }

       });

       }); 

       // Ajax save


       // Preview

       // Penambahan
       $(document).on('click', '#submit_penambahan_view', function(){

              mymodalss.style.display = "block";
              const fileupload    = $('#view_penambahan_file').prop('files')[0];   

              var button           = $(this).attr('id1');
              var req_no           = $('#view_penambahan_reqno').val();

              var division         = $('#division').val();
              var department       = $('#department').val();
              var type             = $('#tipe_pengajuan').val();

              var leader_pos       = $('#view_penambahan_leader_pos').attr('id1');
              var pos_name         = $('#view_penambahan_pos_name').val();
              var cost_center      = $('#view_penambahan_cost_center').val();
              var work_location    = $('#view_penambahan_work_location').val();
              var job_status       = $('#view_penambahan_job_status').val();
              var jobtitle_code    = $('#view_penambahan_job_title').val();
              var reason           = $('#view_penambahan_reason').val();
              var remarks          = $('#view_penambahan_remark').val();


              if(division == ''){
                     alert('Division is required!');
                     mymodalss.style.display = "none";
                     return;
              }else if(department == ''){
                     alert('Department is required!');
                     mymodalss.style.display = "none";
                     return;
              }else if(type == ''){
                     alert('Type is required!');
                     mymodalss.style.display = "none";
                     return;
              }else if(leader_pos == ''){
                     alert('Leader position is required!');
                     mymodalss.style.display = "none";
                     return;
              }else if(pos_name == ''){
                     alert('Position name is required!');
                     mymodalss.style.display = "none";
                     return;
              }else if(cost_center == ''){
                     alert('Cost center is required!');
                     mymodalss.style.display = "none";
                     return
              }else if(work_location == ''){
                     alert('Work location is required!');
                     mymodalss.style.display = "none";
                     return
              }else if(job_status == ''){
                     alert('Job status is required!');
                     mymodalss.style.display = "none";
                     return
              }else if(jobtitle_code == ''){
                     alert('Job title is required!');
                     mymodalss.style.display = "none";
                     return
              }else if(reason == ''){
                     alert('Reason is required!');
                     mymodalss.style.display = "none";
                     return
              }

              let formData = new FormData();
              formData.append('file', fileupload);
              formData.append('req_no', req_no);
              formData.append('button', button);
              formData.append('division', division);
              formData.append('department', department);
              formData.append('type', type);
              formData.append('leader_pos', leader_pos);
              formData.append('pos_name', pos_name);
              formData.append('cost_center', cost_center);
              formData.append('work_location', work_location);
              formData.append('job_status', job_status);
              formData.append('jobtitle_code', jobtitle_code);
              formData.append('reason', reason);
              formData.append('remarks', remarks);

              $.ajax({
                     type: 'POST',
                     url: "requester/ajax_add_request_view.php",
                     data: formData,
                     cache: false,
                     processData: false,
                     contentType: false,
              success: function (msg) {
                     modals.style.display ="block";
                     mymodalss.style.display = "none";
                     $('#msg').html(msg);

                     dataTable.ajax.reload();
                     

                     return false;
              }

              });

              }); 


       // Penghapusan

       $(document).on('click', '#submit_penghapusan_view', function(){

              mymodalss.style.display = "block";
              const fileupload    = $('#view_penghapusan_file').prop('files')[0];   

              var button           = $(this).attr('id1');
              var req_no           = $('#view_penambahan_reqno').val();

              var division         = $('#division').val();
              var department       = $('#department').val();
              var type             = $('#tipe_pengajuan').val();

              var leader_pos       = $('#view_penghapusan_leader_pos').attr('id1');
              var pos_name         = $('#view_penghapusan_pos_name').val();
              var pos_code         = $('#view_penghapusan_pos_code').attr('id1');
              var cost_center      = $('#view_penghapusan_cost_center').val();
              var work_location    = $('#view_penghapusan_work_location').attr('id1');
              var job_status       = $('#view_penghapusan_job_status').attr('id1');
              var jobtitle_code    = $('#view_penghapusan_jobtitle_code').attr('id1');
              var reason           = $('#view_penghapusan_reason').val();
              var remarks          = $('#view_penghapusan_remark').val();


              if(division == ''){
                     alert('Division is required!');
                     mymodalss.style.display = "none";
                     return;
              }else if(department == ''){
                     alert('Department is required!');
                     mymodalss.style.display = "none";
                     return;
              }else if(type == ''){
                     alert('Type is required!');
                     mymodalss.style.display = "none";
                     return;
              }else if(leader_pos == ''){
                     alert('Leader position is required!');
                     mymodalss.style.display = "none";
                     return;
              }else if(pos_name == ''){
                     alert('Position name is required!');
                     mymodalss.style.display = "none";
                     return;
              }else if(cost_center == ''){
                     alert('Cost center is required!');
                     mymodalss.style.display = "none";
                     return
              }else if(work_location == ''){
                     alert('Work location is required!');
                     mymodalss.style.display = "none";
                     return
              }else if(job_status == ''){
                     alert('Job status is required!');
                     mymodalss.style.display = "none";
                     return
              }else if(jobtitle_code == ''){
                     alert('Job title is required!');
                     mymodalss.style.display = "none";
                     return
              }else if(reason == ''){
                     alert('Reason is required!');
                     mymodalss.style.display = "none";
                     return
              }

              let formData = new FormData();
              formData.append('file', fileupload);
              formData.append('button', button);
              formData.append('req_no', req_no);
              formData.append('division', division);
              formData.append('department', department);
              formData.append('type', type);
              formData.append('leader_pos', leader_pos);
              formData.append('pos_name', pos_name);
              formData.append('pos_code', pos_code);
              formData.append('cost_center', cost_center);
              formData.append('work_location', work_location);
              formData.append('job_status', job_status);
              formData.append('jobtitle_code', jobtitle_code);
              formData.append('reason', reason);
              formData.append('remarks', remarks);

              $.ajax({
                     type: 'POST',
                     url: "requester/ajax_delete_request_view.php",
                     data: formData,
                     cache: false,
                     processData: false,
                     contentType: false,
              success: function (msg) {
                     modals.style.display ="block";
                     mymodalss.style.display = "none";
                     $('#msg').html(msg);

                     dataTable.ajax.reload();
                     

                     return false;
              }

              });

              }); 

              // Peleburan

              $(document).on('click', '#submit_peleburan_view', function(){

              mymodalss.style.display = "block";
              const fileupload    = $('#view_peleburan_file').prop('files')[0];   

              var button           = $(this).attr('id1');
              var req_no           = $('#view_peleburan_reqno').val();

              var division         = $('#division').val();
              var department       = $('#department').val();
              var type             = $('#tipe_pengajuan').val();

              var leader_pos       = $('#view_peleburan_leader_pos').attr('id1');
              var pos_name         = $('#view_peleburan_pos_name').val();
              var pos_code         = $('#view_peleburan_pos_code').attr('id1');
              var cost_center      = $('#view_peleburan_cost_center').val();
              var work_location    = $('#view_peleburan_work_location').val();
              var job_status       = $('#view_peleburan_job_status').val();
              var jobtitle_code    = $('#view_peleburan_jobtitle_code').val();
              var reason           = $('#view_peleburan_reason').val();
              var remarks          = $('#view_peleburan_remark').val();


              if(division == ''){
                     alert('Division is required!');
                     mymodalss.style.display = "none";
                     return;
              }else if(department == ''){
                     alert('Department is required!');
                     mymodalss.style.display = "none";
                     return;
              }else if(type == ''){
                     alert('Type is required!');
                     mymodalss.style.display = "none";
                     return;
              }else if(leader_pos == ''){
                     alert('Leader position is required!');
                     mymodalss.style.display = "none";
                     return;
              }else if(pos_name == ''){
                     alert('Position name is required!');
                     mymodalss.style.display = "none";
                     return;
              }else if(cost_center == ''){
                     alert('Cost center is required!');
                     mymodalss.style.display = "none";
                     return
              }else if(work_location == ''){
                     alert('Work location is required!');
                     mymodalss.style.display = "none";
                     return
              }else if(job_status == ''){
                     alert('Job status is required!');
                     mymodalss.style.display = "none";
                     return
              }else if(jobtitle_code == ''){
                     alert('Job title is required!');
                     mymodalss.style.display = "none";
                     return
              }else if(reason == ''){
                     alert('Reason is required!');
                     mymodalss.style.display = "none";
                     return
              }

              let formData = new FormData();
              formData.append('file', fileupload);
              formData.append('button', button);
              formData.append('req_no', req_no);
              formData.append('division', division);
              formData.append('department', department);
              formData.append('type', type);
              formData.append('leader_pos', leader_pos);
              formData.append('pos_name', pos_name);
              formData.append('pos_code', pos_code);
              formData.append('cost_center', cost_center);
              formData.append('work_location', work_location);
              formData.append('job_status', job_status);
              formData.append('jobtitle_code', jobtitle_code);
              formData.append('reason', reason);
              formData.append('remarks', remarks);

              $.ajax({
                     type: 'POST',
                     url: "requester/ajax_fusion_request_view.php",
                     data: formData,
                     cache: false,
                     processData: false,
                     contentType: false,
              success: function (msg) {
                     modals.style.display ="block";
                     mymodalss.style.display = "none";
                     $('#msg').html(msg);

                     dataTable.ajax.reload();
                     

                     return false;
              }

              });

              }); 

              // Pemisahan

              $(document).on('click', '#submit_pemisahan_view', function(){

              mymodalss.style.display = "block";
              const fileupload    = $('#view_pemisahan_file').prop('files')[0];   

              var button           = $(this).attr('id1');
              var req_no           = $('#view_pemisahan_reqno').val();

              var division         = $('#division').val();
              var department       = $('#department').val();
              var type             = $('#tipe_pengajuan').val();

              var leader_pos       = $('#view_pemisahan_leader_pos').attr('id1');
              var pos_name         = $('#view_pemisahan_pos_name').val();
              var pos_code         = $('#view_pemisahan_pos_code').attr('id1');
              var cost_center      = $('#view_pemisahan_cost_center').val();
              var work_location    = $('#view_pemisahan_work_location').val();
              var job_status       = $('#view_pemisahan_job_status').val();
              var jobtitle_code    = $('#view_pemisahan_jobtitle_code').val();
              var reason           = $('#view_pemisahan_reason').val();
              var remarks          = $('#view_pemisahan_remark').val();

             
              if(division == ''){
                     alert('Division is required!');
                     mymodalss.style.display = "none";
                     return;
              }else if(department == ''){
                     alert('Department is required!');
                     mymodalss.style.display = "none";
                     return;
              }else if(type == ''){
                     alert('Type is required!');
                     mymodalss.style.display = "none";
                     return;
              }else if(leader_pos == ''){
                     alert('Leader position is required!');
                     mymodalss.style.display = "none";
                     return;
              }else if(pos_name == ''){
                     alert('Position name is required!');
                     mymodalss.style.display = "none";
                     return;
              }else if(cost_center == ''){
                     alert('Cost center is required!');
                     mymodalss.style.display = "none";
                     return
              }else if(work_location == ''){
                     alert('Work location is required!');
                     mymodalss.style.display = "none";
                     return
              }else if(job_status == ''){
                     alert('Job status is required!');
                     mymodalss.style.display = "none";
                     return
              }else if(jobtitle_code == ''){
                     alert('Job title is required!');
                     mymodalss.style.display = "none";
                     return
              }else if(reason == ''){
                     alert('Reason is required!');
                     mymodalss.style.display = "none";
                     return
              }

              let formData = new FormData();
              formData.append('file', fileupload);
              formData.append('button', button);
              formData.append('req_no', req_no);
              formData.append('division', division);
              formData.append('department', department);
              formData.append('type', type);
              formData.append('leader_pos', leader_pos);
              formData.append('pos_name', pos_name);
              formData.append('pos_code', pos_code);
              formData.append('cost_center', cost_center);
              formData.append('work_location', work_location);
              formData.append('job_status', job_status);
              formData.append('jobtitle_code', jobtitle_code);
              formData.append('reason', reason);
              formData.append('remarks', remarks);

              $.ajax({
                     type: 'POST',
                     url: "requester/ajax_separation_request_view.php",
                     data: formData,
                     cache: false,
                     processData: false,
                     contentType: false,
              success: function (msg) {
                     modals.style.display ="block";
                     mymodalss.style.display = "none";
                     $('#msg').html(msg);

                     dataTable.ajax.reload();
                     

                     return false;
              }

              });

              }); 
     
       
    });



       
</script>




