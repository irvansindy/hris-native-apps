<!-- LOADER -->
<!-- <div onclick='return stopload()' id="loading-circle"></div> -->
<!-- LOADER -->
<!-- <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css"> -->
<script src="vendor/modal/bootstrap.min.js"></script>

<?php  
       $search_id             = '';
       $search_judul             = '';
       $search_tahun             = '';
       // jika nip dan nama terisi
       if (!empty($_POST['search_id'])) {
              $search_id             = $_POST['search_id'];
       // AgusPrass 04/03/2021 menambahkan kondisi saat memfilter
       }
       if(!empty($_POST['search_judul'])){
           $search_judul             = $_POST['search_judul'];
       }
       if(!empty($_POST['search_tahun'])){
              $search_tahun          = $_POST['search_tahun'];
          }
       
          date_default_timezone_set('Asia/Bangkok'); 
$year_now             = date("Y");
$year_after1           = $year_now+1;
$year_after2           = $year_now+2;
$year_after3           = $year_now+3;

$year_before1           = $year_now-1;
$year_before2           = $year_now-2;
$year_before3           = $year_now-3;
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
                                                        <div class="col-4 name">ID Event</div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on" id="search_id"
                                                                             name="search_id" type="Text" value=""
                                                                             onfocus="hlentry(this)" size="30" maxlength="50" 
                                                                             validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title="">
                                                               </div>
                                                        </div>
                                                 </div>

                                                 <div class="form-row">
                                                        <div class="col-4 name">Judul</div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on"
                                                                             name="search_judul" id="search_judul" type="Text" value=""
                                                                             onfocus="hlentry(this)" size="30" maxlength="50" 
                                                                             validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title="">
                                                               </div>
                                                        </div>
                                                 </div>
                                                 <div class="form-row">
                                                        <div class="col-4 name">Tahun</div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">

                                                                      <select class="input--style-6" name="search_tahun" id="search_tahun" style="width: ;height: 27px;">
                                                                             <option value="">--SELECT ONE--</option>
                                                                             <option value="<?php echo $year_before3 ?>"><?php echo $year_before3 ?></option>
                                                                             <option value="<?php echo $year_before2 ?>"><?php echo $year_before2 ?></option>
                                                                             <option value="<?php echo $year_before1 ?>"><?php echo $year_before1 ?></option>
                                                                             <option value="<?php echo $year_now ?>"><?php echo $year_now ?></option>
                                                                             <option value="<?php echo $year_after1 ?>"><?php echo $year_after1 ?></option>
                                                                             <option value="<?php echo $year_after2 ?>"><?php echo $year_after2 ?></option>
                                                                             <option value="<?php echo $year_after3 ?>"><?php echo $year_after3 ?></option>

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
                                        <h4 class="card-title mb-0">Management Event</h4>
                       

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
                                                               <th class="fontCustom" style="z-index: 1;">ID Event</th>
                                                               <th class="fontCustom" style="z-index: 1;">Judul</th>
                                                               <th class="fontCustom" style="z-index: 1;">Tahun</th>
                                                               <th class="fontCustom" style="z-index: 1;">PIC Divisi</th>
                                                               <th class="fontCustom" style="z-index: 1;">PIC Departemen</th>
                                                                                                                           
                                                               
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
       <div class="modal fade" id="modal-view-event">
          <div class="modal-dialog modal-bg">
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
          <div class="modal-dialog modal-bg">
            <div class="modal-content">
              <div class="modal-header">
                     <h4 class="modal-title" id="title_tambah"></h4>
                     <button type="button" id="clear_modaltambah" class="close" data-dismiss="modal" aria-label="Close"
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
          <div class="modal-dialog modal-bg">
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
                           
<!-- <script src="vendor/addremove/rowfy.js"></script> -->

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
              "ajax": "ajax/data.php?data1=<?php echo $search_id ?>&data2=<?php echo $search_judul ?>&data3=<?php echo $search_tahun ?>"
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
       $(document).on('click', '#modal_view_event', function(){

            // Loader
            mymodalss.style.display = "block";
            document.getElementById("msg").innerHTML = "Data refreshed";
            // Loader

            $('#title_modal').html('Edit Event Survey');

            var id    = $(this).attr('id1');

            // alert(id);  
            $.ajax({
                url: "ajax/edit_event.php",
                type: "POST",
                        data: {
                                id: id,
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

                height1();

       });

        // Save Edit
        $(document).on('click', '#edit_event', function(){

            var id_event    = $(this).attr('id1');
            var judul       = $('#edit_judul').val();
            var tahun       = $('#edit_tahun').val();   
            var divisi      = $('#edit_divisi').val();   
            var departemen  = $('#edit_departemen').val(); 
            var target      = $('#edit_target').val(); 
            var start       = $('#edit_start').val(); 
            var end         = $('#edit_end').val(); 
            var gpertanyaan = $('#edit_gpertanyaan').val();
            var tjawaban    = $('#edit_tjawaban').val();
            var porder      = $('#edit_porder').val();
            var essay       = $('#essay').val();
            var anggota     = $('.edit_anggota').val();
            var all_anggota = $('#all_anggota').val();

            if(judul == ''){
                   alert('Judul is required!');
                   return;
            }
            if(tahun == ''){
                   alert('Tahun is required!');
                   return;
            }
            if(divisi == ''){
                   alert('Divisi is required!');
                   return;
            }
            if(departemen == ''){
                   alert('Departemen is required!');
                   return;
            }
            if(target == ''){
                   alert('Target is required!');
                   return;
            }
            if(start == ''){
                   alert('Start Periode is required!');
                   return;
            }
            if(end == ''){
                   alert('End Periode is required!');
                   return;
            }
            if(start > end){
                   alert('Please set periode correctly!');
                   return;
            }

            var gpertanyaan_array  = document.getElementsByName('edit_gpertanyaan[]');
            var tjawaban_array     = document.getElementsByName('edit_tjawaban[]');
            var porder_array       = document.getElementsByName('edit_porder[]');
            var gessay_array       = document.getElementsByName('edit_gessay[]');
            var orderessay_array   = document.getElementsByName('edit_orderessay[]');

              // Validasi group pertanyaan sama

              var n1 = '';

              for (var i = 0; i < gpertanyaan_array.length; i++) {
                     var a = gpertanyaan_array[i];
                     
                     n1 = n1 + a.value + '% ';
              };

              n1 = n1 + ']';

              var n2 = '';

              for (var i = 0; i < tjawaban_array.length; i++) {
                     var a = tjawaban_array[i];
                     
                     n2 = n2 + a.value + '% ';
              };

              n2 = n2 + ']';

              var n3 = '';

              for (var i = 0; i < porder_array.length; i++) {
                     var a = porder_array[i];
                     
                     n3 = n3 + a.value + '% ';
              };

              n3 = n3 + ']';

              var n4 = '';

              for (var i = 0; i < gessay_array.length; i++) {
                     var a = gessay_array[i];
                     
                     n4 = n4 + a.value + '% ';
              };

              n4 = n4 + ']';

              var n5 = '';

              for (var i = 0; i < orderessay_array.length; i++) {
                     var a = orderessay_array[i];
                     
                     n5 = n5 + a.value + '% ';
              };

              n5 = n5 + ']';


              $.ajax({
                url: "ajax/validasi_gpertanyaan.php",
                type: "POST",
                        data: {
                                n1: n1, n2: n2, n3: n3, n4: n4, n5: n5, essay: essay,
                        },
                        success: function(ajaxData) {
                            if(ajaxData == 1){
                                   $('#msg').html("Ada group pertanyaan yang sama!");
                            }else if(ajaxData == 2){
                                   $('#msg').html("Ada tipe jawaban yang berbeda!");
                            }else if(ajaxData == 3){
                                   $('#msg').html("Ada order pertanyaan yang sama!");
                            }else if(ajaxData == 4){
                                   $('#msg').html("Ada group essay yang sama!");
                            }else if(ajaxData == 5){
                                   $('#msg').html("Ada order essay yang sama!");
                            }else{

                                   $.ajax({
                                   url: "ajax/save_edit.php",
                                   type: "POST",
                                          data: {
                                                 n1: n1, n2: n2, n3: n3, n4: n4, n5: n5, essay: essay, judul: judul, tahun: tahun, divisi: divisi, departemen: departemen, target: target, start: start, end: end, id_event: id_event, anggota: anggota, all_anggota: all_anggota,
                                          },
                                          success: function(ajaxData) {
                                                 $('#msg').html(ajaxData);
                                                 modals.style.display ="block";
                                                 mymodalss.style.display = "none";

                                                 $('#modal-view-event').modal('hide');  
                                                 $("[data-dismiss=modal]").trigger({type: "click"});   
                                                 
                                          }
                                   });

                            }
                            modals.style.display ="block";
                            mymodalss.style.display = "none";
                            
                        }
                });

        });

        // Delete
        $(document).on('click', '#delete_religion', function(){

            var rc          = $('#rc').val();  

            let formData = new FormData();
            formData.append('rc', rc);

            $.ajax({
                type: 'POST',
                url: "ajax/deletereligion.php",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function (msg) {
                    
                    dataTable.ajax.reload();

                    modals.style.display ="block";
                    mymodalss.style.display = "none";
                    $('#msg').html(msg);

                    
                }

            });

        });

         //    Add
       $(document).on('click', '#modal_tambah', function(){

            // Loader
            mymodalss.style.display = "block";
            document.getElementById("msg").innerHTML = "Data refreshed";
            // Loader

            

      

            $('#title_tambah').html('Add Event');

            // alert(nc);  
            $.ajax({
                url: "ajax/add_event.php",
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

              height1();

              

       });

       $(document).on('click', '.rowfy-addrow', function(){
       let rowfyable = $(this).closest('table');
       let lastRow = $('tbody tr:last', rowfyable).clone();
       $('input', lastRow).val('');
       $('tbody', rowfyable).append(lastRow);
       $(this).removeClass('rowfy-addrow btn-success').addClass('rowfy-deleterow btn-danger').text('-');
       });

       /*Delete row event*/
       $(document).on('click', '.rowfy-deleterow', function(){
       $(this).closest('tr').remove();
       });

       function height1()
              {
                     var height = document.getElementById("tampil_tambah").offsetHeight;
                     var height2 = document.getElementById("yanampilmodal").offsetHeight;

                     if(height > 0){
                            $('.rowfy').each(function(){
                                   $('tbody', this).find('tr').each(function(){
                                   $(this).append('<td><button type="button" class="btn btn-sm '
                                   + ($(this).is(":last-child") ?
                                          'rowfy-addrow btn-success">+' :
                                          'rowfy-deleterow btn-danger">-') 
                                   +'</button></td>');
                                   });
                                   });
                            return;
                     }

                     if(height2 > 0){
                            $('.rowfy').each(function(){
                                   $('tbody', this).find('tr').each(function(){
                                   $(this).append('<td><button type="button" class="btn btn-sm '
                                   + ($(this).is(":last-child") ?
                                          'rowfy-addrow btn-success">+' :
                                          'rowfy-deleterow btn-danger">-') 
                                   +'</button></td>');
                                   });
                                   });
                            return;
                     }
                     setTimeout(function() {
               
                            
                     
                     
                     height1();
              
                     
                     }, 500);
       }

            // Save Edit
        $(document).on('click', '#add_event', function(){

            var judul       = $('#add_judul').val();
            var tahun       = $('#add_tahun').val();   
            var divisi      = $('#add_divisi').val();   
            var departemen  = $('#add_departemen').val(); 
            var target      = $('#add_target').val(); 
            var start       = $('#add_start').val(); 
            var end         = $('#add_end').val(); 
            var gpertanyaan = $('#add_gpertanyaan').val();
            var tjawaban    = $('#add_tjawaban').val();
            var porder      = $('#add_porder').val();
            var essay       = $('#essay1').val();
            var anggota     = $('.add_anggota').val();
            var all_anggota = $('#add_all_anggota').val();

            alert(all_anggota);

            if(judul == ''){
                   alert('Judul is required!');
                   return;
            }
            if(tahun == ''){
                   alert('Tahun is required!');
                   return;
            }
            if(divisi == ''){
                   alert('Divisi is required!');
                   return;
            }
            if(departemen == ''){
                   alert('Departemen is required!');
                   return;
            }
            if(target == ''){
                   alert('Target is required!');
                   return;
            }
            if(start == ''){
                   alert('Start Periode is required!');
                   return;
            }
            if(end == ''){
                   alert('End Periode is required!');
                   return;
            }
            if(start > end){
                   alert('Please set periode correctly!');
                   return;
            }

            var gpertanyaan_array  = document.getElementsByName('add_gpertanyaan[]');
            var tjawaban_array     = document.getElementsByName('add_tjawaban[]');
            var porder_array       = document.getElementsByName('add_porder[]');
            var gessay_array       = document.getElementsByName('add_gessay[]');
            var orderessay_array   = document.getElementsByName('add_orderessay[]');

              // Validasi group pertanyaan sama

              var n1 = '';

              for (var i = 0; i < gpertanyaan_array.length; i++) {
                     var a = gpertanyaan_array[i];
                     
                     n1 = n1 + a.value + '% ';
              };

              n1 = n1 + ']';

              var n2 = '';

              for (var i = 0; i < tjawaban_array.length; i++) {
                     var a = tjawaban_array[i];
                     
                     n2 = n2 + a.value + '% ';
              };

              n2 = n2 + ']';

              var n3 = '';

              for (var i = 0; i < porder_array.length; i++) {
                     var a = porder_array[i];
                     
                     n3 = n3 + a.value + '% ';
              };

              n3 = n3 + ']';

              var n4 = '';

              for (var i = 0; i < gessay_array.length; i++) {
                     var a = gessay_array[i];
                     
                     n4 = n4 + a.value + '% ';
              };

              n4 = n4 + ']';

              var n5 = '';

              for (var i = 0; i < orderessay_array.length; i++) {
                     var a = orderessay_array[i];
                     
                     n5 = n5 + a.value + '% ';
              };

              n5 = n5 + ']';


              $.ajax({
                url: "ajax/validasi_gpertanyaan.php",
                type: "POST",
                        data: {
                                n1: n1, n2: n2, n3: n3, n4: n4, n5: n5, essay: essay,
                        },
                        success: function(ajaxData) {
                            if(ajaxData == 1){
                                   $('#msg').html("Ada group pertanyaan yang sama!");
                            }else if(ajaxData == 2){
                                   $('#msg').html("Ada tipe jawaban yang berbeda!");
                            }else if(ajaxData == 3){
                                   $('#msg').html("Ada order pertanyaan yang sama!");
                            }else if(ajaxData == 4){
                                   $('#msg').html("Ada group essay yang sama!");
                            }else if(ajaxData == 5){
                                   $('#msg').html("Ada order essay yang sama!");
                            }else{

                                   $.ajax({
                                   url: "ajax/save_add.php",
                                   type: "POST",
                                          data: {
                                                 n1: n1, n2: n2, n3: n3, n4: n4, n5: n5, essay: essay, judul: judul, tahun: tahun, divisi: divisi, departemen: departemen, target: target, start: start, end: end, anggota: anggota, all_anggota: all_anggota,
                                          },
                                          success: function(ajaxData) {
                                                 $('#msg').html(ajaxData);
                                                 modals.style.display ="block";
                                                 mymodalss.style.display = "none";

                                                 $('#modal-view-event').modal('hide');  
                                                 $("[data-dismiss=modal]").trigger({type: "click"});   
                                                 
                                          }
                                   });

                            }
                            modals.style.display ="block";
                            mymodalss.style.display = "none";
                            
                        }
                });

        });


    });
    
</script>

