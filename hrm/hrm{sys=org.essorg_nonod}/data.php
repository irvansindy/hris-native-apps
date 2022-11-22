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

                                        <!-- <td><a href='#' class='' data-toggle="modal" id="modal_tambah" id1="" data-target="#modal-default">
                                                               <div class="toolbar sprite-toolbar-add"
                                                                      title="Add"></div>
                                          </a></td> -->

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
       <div class="modal fade" id="modal-view-od">
          <div class="modal-dialog modal-bg">
            <div class="modal-content">
              <div class="modal-header">
                     <h4 class="modal-title" id="title_view_od"></h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
              </div>
              <div id="tampil_view_od"></div>
            
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <!-- Modal untuk reqest requester -->

                <!-- Modal untuk reqest requester -->
       <div class="modal fade" id="modal-view-od-1" data-backdrop="false">
          <div class="modal-dialog modal-md">
            <div class="modal-content">
              <div class="modal-header">
                     <h4 class="modal-title" id="title_view_od-1"></h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close_chat_box"
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
              </div>
              <div id="tampil_view_od-1"></div>
            
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

        // Menampilkan data
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
              "ajax": "ajax/ajax_data.php?id1=<?php echo $search_rn ?>&id2=<?php echo $search_rb ?>&id3=<?php echo $search_type ?>"
       });
       // Menampilkan data

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

       // Merubah status approval
       $(document).on('change', '.approval_status', function(){
              // Loader
              mymodalss.style.display = "block";
              // Loader

              var req_id    = $(this).attr('id');
              var code      = $(this).val();

              $.ajax({
                     url: "ajax/ajax_change_app_stat.php",
                     type: "POST",
                            data: {
                                   req_id: req_id, code:code,
                            },
                            success: function(ajaxData) {

                            modals.style.display ="block";
                            mymodalss.style.display = "none";
                            $('#msg').html(ajaxData);

                            dataTable.ajax.reload();

                            }
                     });
       });
       // Merubah status approval

       // Merubah status request
       $(document).on('change', '.status_req', function(){
              // Loader
              mymodalss.style.display = "block";
              // Loader

              var req_id    = $(this).attr('id');
              var code      = $(this).val();

              // alert(req_id);
              // alert(code);

              $.ajax({
                     url: "ajax/ajax_change_req_stat.php",
                     type: "POST",
                            data: {
                                   req_id: req_id, code:code,
                            },
                            success: function(ajaxData) {

                            modals.style.display ="block";
                            mymodalss.style.display = "none";
                            $('#msg').html(ajaxData);

                            dataTable.ajax.reload();

                            }
                     });
              
       });
       // Merubah status request

       // Menampilkan request OD
       $(document).on('click', '#modal_view_od', function(){

              // Loader
              mymodalss.style.display = "block";
              document.getElementById("msg").innerHTML = "Data refreshed";
              // Loader

              $('#title_view_od').html('Preview Usulan Perubahan Struktur Organisasi');

              var req_id    = $(this).attr('id1');


              $.ajax({
                     url: "ajax/modal_view_od.php",
                     type: "POST",
                            data: {
                                   req_id: req_id,
                            },
                            success: function(ajaxData) {
                                   $("#tampil_view_od").html(ajaxData);
                                  

                                   // Loader
                                   mymodalss.style.display = "none";
                                   document.getElementById("msg").innerHTML = "Data refreshed";
                                   return false;
                                   // Loader
                            }
                     });
              
       });

       // Insert revision
       $(document).on('click', '#submit_revision', function(){
              // alert('Masuk');
              
              var req_id           = $('#revision_reqid').val();
              var rev_remarks      = $('#revision_remarks').val();

              if(rev_remarks == ''){
                     alert('Remarks is required!');
                     return;
              }

              $.ajax({
                     url: "ajax/add_revision.php",
                     type: "POST",
                            data: {
                                   req_id: req_id, rev_remarks:rev_remarks,
                            },
                            success: function(ajaxData) {

                            modals.style.display ="block";
                            mymodalss.style.display = "none";
                            $('#msg').html(ajaxData);

                            dataTable.ajax.reload();

                           
                            }
              });

             
                                
              
       });

       // Insert approved
       $(document).on('click', '#od_approve', function(){
              
              var status_approval  = $('#stat_app_od').val()


              // if(status_approval == '3'){
              //        alert('Approval status is Fully Approved!');
              //        return;
              // }else if(status_approval != '2'){

              //        alert('Approval status must partially first!');
              //        return;
              // }


              var req_id           = $(this).attr('id1');
              

              $.ajax({
                     url: "ajax/approve.php",
                     type: "POST",
                            data: {
                                   req_id: req_id, 
                            },
                            success: function(ajaxData) {

                            modals.style.display ="block";
                            mymodalss.style.display = "none";
                            $('#msg').html(ajaxData);

                            dataTable.ajax.reload();

                         

                            }
              });
          
             
                                
              
       });

       // Insert rejected
       $(document).on('click', '#approval_reject_od', function(){
              
              
              var req_id           = $(this).attr('id1');
              
              var status_approval  = $('#stat_app_od').val()

              // if(status_approval != '1'){

              //        alert('Reject only when status approval Unverified!');
              //        return;
              // }

              $.ajax({
                     url: "ajax/rejection.php",
                     type: "POST",
                            data: {
                                   req_id: req_id, 
                            },
                            success: function(ajaxData) {

                            modals.style.display ="block";
                            mymodalss.style.display = "none";
                            $('#msg').html(ajaxData);

                            dataTable.ajax.reload();

                         

                            }
              });            
             
                                
              
       });
       // $(document).on('click', '#close_chat_box', function(){
       //        alert('Masuk');
       //        // const el      = querySelector('#modal-view-od');
       //        // el.classList.remove("in");
       //        $('#modal-view-od')[0].setAttribute("class", "modal fade");
       //        const penambahan = $("#modal-view-od");
       //        penambahan.css("display", "none");
              
       //        $('#modal-view-od')[0].setAttribute("class", "modal fade in show");
       //        penambahan.css("display", "block");
       // });
});
</script>