<!-- LOADER -->
<!-- <div onclick='return stopload()' id="loading-circle"></div> -->
<!-- LOADER -->
<!-- <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css"> -->
<script src="vendor/modal/bootstrap.min.js"></script>

<?php  
       $search_elc            = '';
       $search_elm            = '';
       $search_ell            = '';
       $search_els            = '';
       // jika nip dan nama terisi
       if (!empty($_POST['search_elc'])) {
              $search_elc             = $_POST['search_elc'];
       // AgusPrass 04/03/2021 menambahkan kondisi saat memfilter
       }
       if(!empty($_POST['search_elm'])){
           $search_elm                = $_POST['search_elm'];
       }
       if(!empty($_POST['search_ell'])){
            $search_ell                = $_POST['search_ell'];
       }
       if(!empty($_POST['search_els'])){
              $search_els                = $_POST['search_els'];
              
       }
       if(isset($_POST['validasi_submit'])){
              if($_POST['search_els'] == '0'){
                     $search_els                = '0';
              }
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
                                                        <div class="col-4 name">Education Type Code</div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on" id="search_elc"
                                                                             name="search_elc" type="Text" value=""
                                                                             onfocus="hlentry(this)" size="30" maxlength="50"
                                                                             validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title="">
                                                               </div>
                                                        </div>
                                                 </div>

                                                 <div class="form-row">
                                                        <div class="col-4 name">Education Type Name</div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on"
                                                                             name="search_elm" id="search_elm" type="Text" value=""
                                                                             onfocus="hlentry(this)" size="30" maxlength="50"
                                                                             validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title="">
                                                               </div>
                                                        </div>
                                                 </div>

                                                 <div class="form-row">
                                                        <div class="col-4 name">Education Type Level</div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on"
                                                                             name="search_ell" id="search_ell" type="Text" value=""
                                                                             onfocus="hlentry(this)" size="30" maxlength="50"
                                                                             validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title="">
                                                               </div>
                                                        </div>
                                                 </div>

                                                 <div class="form-row">
                                                        <div class="col-4 name">Education Type Status</div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">

                                                                    <select class="input--style-6" name="search_els" id="search_els" style="height: 27px;">
                                                                        <option value="">--Select Status--</option>
                                                                        <option value="1">Active</option>
                                                                        <option value="0">Inactive</option>
                                                                    </select>
                                                               </div>
                                                        </div>
                                                 </div>
                                                 
                                          </fieldset>
                   
                                          <button class="btn btn-warning" name="validasi_submit" type="submit" style="width: 100%;border-radius: 17px;font-weight: bold;letter-spacing: 1px;font-size: 12px;">
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
                                        <h4 class="card-title mb-0">Education Level</h4>
                       

                                        <div class="card-actions ml-auto">
                                        <table>

                                        <td><a href='#' class='' data-toggle="modal" id="modal_tambah" id1="" data-target="#modal-default">
                                                               <div class="toolbar sprite-toolbar-add"
                                                                      title="Add"></div>
                                          </a></td>

                                   
                                          
                                        <!-- <td>
                                          <form action="export/excel" method="POST">
                                          
                                          <input type="hidden" name="data_search" value="<?php echo $search; ?>">
                                        

                                                
                                                        <button type="submit" class="toolbar sprite-toolbar-excel" id="EXCEL" style="border: 0;background-color: white;" name="submit_approve" value="submit">
                                                        </button>


                                                  
                                          </form>
                                        </td> -->
                                        <td>
                                          <a href='#' class='open_modal_search' class="btn btn-demo" data-toggle="modal" data-target="#myModal2">
                                                 <div class="toolbar sprite-toolbar-search" id="SEARCH" title="Search">
                                                 </div>
                                          </a>
                                        </td>

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
                                                               <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No</th>
                                                               <th class="fontCustom" style="z-index: 1;">Education Type Code</th>
                                                               <th class="fontCustom" style="z-index: 1;">Education Type Name</th>
                                                               <th class="fontCustom" style="z-index: 1;">Education Type Level</th>
                                                               <th class="fontCustom" style="z-index: 1;">Status</th>                                
                                                               
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
       <div class="modal fade" id="modal-view-edulevel">
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
       <div class="modal fade" id="modal-default">
          <div class="modal-dialog modal-md">
            <div class="modal-content">
              <div class="modal-header">
                     <h4 class="modal-title" id="title_tambah"></h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
              </div>
             
              <div id="tampil_tambah"></div>
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





          
                            <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
                            <script src="../../asset/vendor/datatable/datatables.min.js"></script>
                           


<script type="text/javascript" language="javascript" >
$(document).ready(function(){
     
        // Load data
       dataTable = $("#datatable").DataTable({
              
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
              destroy: true,
              columnDefs:[
                     {
                        "targets":[4],
                        "orderable":false,
                     },
              ], 
              "ajax": "ajax/data.php?data1=<?php echo $search_elc ?>&data2=<?php echo $search_elm ?>&data3=<?php echo $search_ell ?>&data4=<?php echo $search_els ?>"
       });
        //    Load data

       // Refresh Page
       $("#refresh").click(function(e) {
              // dataTable.ajax.reload();

              // setTimeout(function(){
              //        mymodalss.style.display = "none";
              //        document.getElementById("msg").innerHTML = "Data refreshed";
              //        return false;
              // }, 2000);

              // mymodalss.style.display = "block";
              // document.getElementById("msg").innerHTML = "Data refreshed";
              // return false;
              window.location.href = window.location.href;                   
       });
       // Refresh Page

        //    Edit
       $(document).on('click', '#modal_view_edulevel', function(){

            // Loader
            mymodalss.style.display = "block";
            document.getElementById("msg").innerHTML = "Data refreshed";
            // Loader

            $('#title_modal').html('Edit Education Level');

            var el    = $(this).attr('id1');

            // alert(el);  
            $.ajax({
                url: "ajax/edit_edulevel.php",
                type: "POST",
                        data: {
                                el: el,
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

            });

        // Save Edit
        $(document).on('click', '#edit_educationlevel', function(){

            var etc         = $('#edit_etc').val();
            var etm_en      = $('#edit_etm_en').val();   
            var etm_id      = $('#edit_etm_id').val();
            var etl         = $('#edit_etl').val();
            var ets         = $('#edit_ets').attr('id1');  

            if(etm_en == ''){
                alert('Education Type name en is required!');
                return;
            }
            if(etm_id == ''){
                alert('Education Type name id is required!');
                return;
            }
            if(etl == ''){
                alert('Education Type Level is required!');
                return;
            }

            let formData = new FormData();
            formData.append('etc', etc);
            formData.append('etm_en', etm_en);
            formData.append('etm_id', etm_id);
            formData.append('etl', etl);
            formData.append('ets', ets);

            $.ajax({
                type: 'POST',
                url: "ajax/saveedit.php",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function (msg) {
                    
                    dataTable.ajax.reload();

                    modals.style.display ="block";
                    mymodalss.style.display = "none";
                    $('#msg').html(msg);

                    $('#modal-edulevel').modal('hide');  
                    $("[data-dismiss=modal]").trigger({type: "click"}); 
                    
                }

            });

        });

        // Delete
        $(document).on('click', '#delete_educationlevel', function(){

            var etc         = $('#edit_etc').val();  

            let formData = new FormData();
            formData.append('etc', etc);

            $.ajax({
                type: 'POST',
                url: "ajax/deleteedulevel.php",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function (msg) {
                    
                    dataTable.ajax.reload();

                    modals.style.display ="block";
                    mymodalss.style.display = "none";
                    $('#msg').html(msg);

                    $('#modal-edulevel').modal('hide');  
                    $("[data-dismiss=modal]").trigger({type: "click"}); 
                    
                }

            });

        });

         //    Add
       $(document).on('click', '#modal_tambah', function(){

            // Loader
            mymodalss.style.display = "block";
            document.getElementById("msg").innerHTML = "Data refreshed";
            // Loader

            $('#title_tambah').html('Add Education Level');

            // alert(nc);  
            $.ajax({
                url: "ajax/add_educationlevel.php",
                type: "POST",
                        data: {
                                
                        },
                        success: function(ajaxData) {
                                $("#tampil_tambah").html(ajaxData);
                                

                                // Loader
                                mymodalss.style.display = "none";
                                document.getElementById("msg").innerHTML = "Data refreshed";
                                return false;
                                // Loader
                        }
                });

            });

            // Save Edit
        $(document).on('click', '#tambah_educationlevel', function(){

            var etc         = $('#tambah_etc').val();
            var etm_en      = $('#tambah_etm_en').val();   
            var etm_id      = $('#tambah_etm_id').val();
            var etl         = $('#tambah_etl').val();
            var ets         = $('#tambah_ets').attr('id1');
                       

            if(etc == ''){
                alert('Education Type code is required!');
                return;
            }
            if(etm_en == ''){
                alert('Education Type name en is required!');
                return;
            }
            if(etm_id == ''){
                alert('Education Type name id is required!');
                return;
            }
            if(etl == ''){
                alert('Education Type Level is required!');
                return;
            }
            
            let formData = new FormData();
            formData.append('etc', etc);
            formData.append('etm_en', etm_en);
            formData.append('etm_id', etm_id);
            formData.append('etl', etl);
            formData.append('ets', ets);

            $.ajax({
                type: 'POST',
                url: "ajax/saveadd.php",
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


    });
    
</script>