<!-- LOADER -->
<!-- <div onclick='return stopload()' id="loading-circle"></div> -->
<!-- LOADER -->
<!-- <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css"> -->
<script src="vendor/modal/bootstrap.min.js"></script>

<?php  
       $search_cgc             = '';
       $search_cgn             = '';
       // jika nip dan nama terisi
       if (!empty($_POST['search_cgc'])) {
              $search_cgc             = $_POST['search_cgc'];
       // AgusPrass 04/03/2021 menambahkan kondisi saat memfilter
       }
       if(!empty($_POST['search_cgn'])){
           $search_cgn                = $_POST['search_cgn'];
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
                                                        <div class="col-4 name">Checklist Group Code</div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on" id="search_cgc"
                                                                             name="search_cgc" type="Text" value=""
                                                                             onfocus="hlentry(this)" size="30" maxlength="50" 
                                                                             validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title="">
                                                               </div>
                                                        </div>
                                                 </div>

                                                 <div class="form-row">
                                                        <div class="col-4 name">Checklist Group Name</div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on"
                                                                             name="search_cgn" id="search_cgn" type="Text" value=""
                                                                             onfocus="hlentry(this)" size="30" maxlength="50" 
                                                                             validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title="">
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
                                        <h4 class="card-title mb-0">Educational Institution</h4>
                       

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
                                                               <th class="fontCustom" style="z-index: 1;">Checklist Group Code</th>
                                                               <th class="fontCustom" style="z-index: 1;">Checklist Group Name</th>
                                                               <th class="fontCustom" style="z-index: 1;">Organization Unit</th>
                                                                                                                           
                                                               
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
       <div class="modal fade" id="modal-view-checklistheader">
          <div class="modal-dialog modal-bg" style="width:1200px">
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
          <div class="modal-dialog modal-bg" style="width:1200px">
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
                            
                     },
              ], 
              "ajax": "ajax/data.php?data1=<?php echo $search_cgc ?>&data2=<?php echo $search_cgn ?>"
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
       $(document).on('click', '#modal_view_checklistheader', function(){

            // Loader
            mymodalss.style.display = "block";
            document.getElementById("msg").innerHTML = "Data refreshed";
            // Loader

            $('#title_modal').html('Edit Employee Checklist');

            var eic    = $(this).attr('id1');

            // alert(eic);  
            $.ajax({
                url: "ajax/edit_empchecklist.php",
                type: "POST",
                        data: {
                                eic: eic,
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
        $(document).on('click', '#edit_empchecklist', function(){

            var counte             = $(this).attr('id2');
            var cgc                = $('#edit_cgc').val();
            var cgm                = $('#edit_cgm').val();   
            var ou                 = $('.edit_ou').val(); 
            var facility           = $('#edit_facility').val(); 
            var tambah_newhire     = $('#edit_newhire').val(); 
            var tambah_exit        = $('#edit_exit').val(); 
            var pica               = $('.edit_pic').val(); 
            var pico               = $('.edit_pic');

            var input = document.getElementsByName('edit_facility[]');
            var pic   = document.getElementsByName('edit_pic[]');
            var newhire = document.getElementsByName('edit_newhire[]');
            var exit = document.getElementsByName('edit_exit[]');

            if(cgc == ''){
                   alert('Checklist group code is required!');
                   return;
            }
            if(cgm == ''){
                   alert('Checklist group name is required!');
                   return;
            }


            var k = '';

            for (var i = 0; i < input.length; i++) {
                var a = input[i];
                var z = i + 1;
                if(i < counte){
                       var dual = $('#test-select-ab'+z+'').val();
                }else{
                       var dual = $('#test-select-'+z+'').val();
                }
                k = k + a.value + '&' + dual + '% ';
            };

            k = k + ']';


       //      new hire

            var n = '';

            for (var i = 0; i < newhire.length; i++) {
                var a = newhire[i];
               
                n = n + a.value + '% ';
            };

            n = n + ']';
// Exit
            var o = '';

            for (var i = 0; i < exit.length; i++) {
                var a = exit[i];
               
                o = o + a.value + '% ';
            };

            o = o + ']';


            let formData = new FormData();
            formData.append('cgc', cgc);
            formData.append('cgm', cgm);
            formData.append('n', n);
            formData.append('o', o);
            formData.append('k', k);
            formData.append('ou', ou);
            formData.append('cgm', cgm);

           
            $.ajax({
                type: 'POST',
                url: "ajax/updateempchecklist.php",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function (msg) {
                    
                    dataTable.ajax.reload();

                    modals.style.display ="block";
                    mymodalss.style.display = "none";
                    $('#msg').html(msg);
window.location.reload();
                    $('#modal-view-checklistheader').modal('hide');  
                    $("[data-dismiss=modal]").trigger({type: "click"}); 

                    
                }

            });

        });

        // Delete
        $(document).on('click', '#delete_eduinstitution', function(){

            var eic          = $('#edit_eic').val();  

            let formData = new FormData();
            formData.append('eic', eic);

            $.ajax({
                type: 'POST',
                url: "ajax/deleteeduinstitution.php",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function (msg) {
                    
                    dataTable.ajax.reload();

                    modals.style.display ="block";
                    mymodalss.style.display = "none";
                    $('#msg').html(msg);

                    $('#modal-edu').modal('hide');  
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

            $('#title_tambah').html('Add Employee Checklist');

            // alert(nc);  
            $.ajax({
                url: "ajax/add_empchecklist.php",
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
        $(document).on('click', '#tambah_empchecklist', function(){

            var cgc                = $('#tambah_cgc').val();
            var cgm                = $('#tambah_cgm').val();   
            var ou                 = $('.tambah_ou').val(); 
            var facility           = $('#facility').val(); 
            var tambah_newhire     = $('#tambah_newhire').val(); 
            var tambah_exit        = $('#tambah_exit').val(); 
            var pica               = $('.pic').val(); 
            var pico               = $('.pic');

            var input = document.getElementsByName('facility[]');
            var pic   = document.getElementsByName('pic[]');
            var newhire = document.getElementsByName('tambah_newhire[]');
            var exit = document.getElementsByName('tambah_exit[]');

            if(cgc == ''){
                   alert('Checklist group code is required!');
                   return;
            }
            if(cgm == ''){
                   alert('Checklist group name is required!');
                   return;
            }


            var k = '';

            for (var i = 0; i < input.length; i++) {
                var a = input[i];
                if(i == 0){
                       var dual = $('#test-select-ab').val();
                }else{
                       var dual = $('#test-select-'+i+'').val();
                }
                k = k + a.value + '&' + dual + '% ';
            };

            k = k + ']';

       //      new hire

            var n = '';

            for (var i = 0; i < newhire.length; i++) {
                var a = newhire[i];
               
                n = n + a.value + '% ';
            };

            n = n + ']';
// Exit
            var o = '';

            for (var i = 0; i < exit.length; i++) {
                var a = exit[i];
               
                o = o + a.value + '% ';
            };

            o = o + ']';


            let formData = new FormData();
            formData.append('cgc', cgc);
            formData.append('cgm', cgm);
            formData.append('n', n);
            formData.append('o', o);
            formData.append('k', k);
            formData.append('ou', ou);
       //      formData.append('cgm', cgm);

           
            $.ajax({
                type: 'POST',
                url: "ajax/saveempchecklist.php",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function (msg) {
                    
                    dataTable.ajax.reload();

                    modals.style.display ="block";
                    mymodalss.style.display = "none";
                    $('#msg').html(msg);
window.location.reload();

                    $('#modal-default').modal('hide');  
                    $("[data-dismiss=modal]").trigger({type: "click"}); 

                    
                }

            });

        });


    });
    
</script>