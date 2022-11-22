<!-- LOADER -->
<!-- <div onclick='return stopload()' id="loading-circle"></div> -->
<!-- LOADER -->
<!-- <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css"> -->
<script src="vendor/modal/bootstrap.min.js"></script>

<?php  
       $search_empno             = '';
       $search_name              = '';

       // jika nip dan nama terisi
       if (!empty($_POST['search_empno'])) {
              $search_empno             = $_POST['search_empno'];
       // AgusPrass 04/03/2021 menambahkan kondisi saat memfilter
       }
       if(!empty($_POST['search_name'])){
           $search_name                = $_POST['search_name'];
       }
?>


<?php
$sql_penalty = mysqli_query($connect, "SELECT 
a.penalty_id,
a.penalty_name
FROM hrmpenaltytype a");

if (!empty($_POST['cari'])) {
       $filter = $_POST['cari'];
       $filterprint = 'Filter: Ticketing Number Is '.$_POST['cari'];
} else { 
       $filter = '';
       $filterprint = '';
}

?>

<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>


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
                                                        <div class="col-4 name">Emp No</div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on" id="search_empno"
                                                                             name="search_empno" type="Text" value=""
                                                                             onfocus="hlentry(this)" size="30" maxlength="50" 
                                                                             validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title="">
                                                               </div>
                                                        </div>
                                                 </div>

                                                 <div class="form-row">
                                                        <div class="col-4 name">Name</div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on"
                                                                             name="search_name" id="search_name" type="Text" value=""
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

<!-- Modal -->
<div class="modal right fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2"  data-backdrop="false">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-body">

                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                                   <!-- <form method="post" id="myform" name="myForm" action="export/print_st.php" target="_blank" onSubmit="return validateForm()"> -->
                                          <fieldset id="fset_1" style="margin-top: 25px;border-radius: 5px;border: 1px solid #e4e8ea;">
                                                 <legend>Print</legend>
                                                 <div class="form-row">
                                                        <div class="col-3 name">Periode</div>
                                                        <div class="col-sm-4">
                                                               <div class="input-group">

                                                               <input type="text" id="periode_start" class="input--style-6 periode_start"
                                                                                    name="print_periode_start" style="
                                                                                    background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                                    background-size: 17px;
                                                                                    background-position:right;   
                                                                                    background-repeat:no-repeat; 
                                                                                    padding-right:10px;
                                                                                    padding-left:8px; 
                                                                                    "
                                                                                    autocomplete="off"/>
                                                               </div>
                                                        </div>
                                                        <div class="col-sm-1" style="text-align:center; padding-top:5px">
                                                               To
                                                        </div>
                                                        <div class="col-sm-4">
                                                               <div class="input-group">

                                                               <input type="text" id="periode_end" class="input--style-6 periode_end"
                                                                                    name="print_periode_end" style="
                                                                                    background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                                    background-size: 17px;
                                                                                    background-position:right;   
                                                                                    background-repeat:no-repeat; 
                                                                                    padding-right:10px;  
                                                                                    padding-left:8px;
                                                                                    "
                                                                                    autocomplete="off"/>
                                                               </div>
                                                        </div>
                                                 </div>

                                                 <div class="form-row">
                                                        <div class="col-3 name">Tipe Sanksi</div>
                                                        <div class="col-sm-9">
                                                               <div class="input-group">

                                                                      <select class="input--style-6" name="print_tipe_sanksi" id="print_tipe_sanksi" style="width: ;height: 30px;">
                                                                             <option value="">-- Select one --</option>
                                                                             <?php 
                                        while($data_penalty  = mysqli_fetch_assoc($sql_penalty)){
                                    ?>
                                        <option value="<?php echo $data_penalty['penalty_id'] ?>"><?php echo $data_penalty['penalty_name'] ?></option>
                                    <?php } ?>
                          
                                                    </select>
                                                               </div>
                                                        </div>
                                                 </div>

                                                 <div class="form-row">
                                                        <div class="col-3 name">Emp No</div>
                                                        <div class="col-sm-9">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on"
                                                                             name="print_empno" id="print_empno" type="Text" value=""
                                                                             onfocus="hlentry(this)" size="30" maxlength="50" 
                                                                             validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title="">
                                                               </div>
                                                        </div>
                                                 </div>
                                                 
                                          </fieldset>
                   
                                          <button class="btn btn-warning" id="print" type="submit" style="width: 100%;border-radius: 17px;font-weight: bold;letter-spacing: 1px;font-size: 12px;">
                                                 Print
                                          </button>
                                   <!-- </form> -->
				</div>

			</div><!-- modal-content -->
		</div><!-- modal-dialog -->
	</div><!-- modal -->
                           



<div class="col-md-12">
                                <div class="card">
                                    <div class="card-header d-flex align-items-center">
                                        <h4 class="card-title mb-0">Surat Panggilan</h4>
                       

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
                                          <a href='#' class='open_modal_print' class="btn btn-demo" data-toggle="modal" data-target="#myModal3">
                                                 <div class="toolbar sprite-toolbar-excel" id="EXCEL" title="Print">
                                                 </div>
                                          </a>
                                        </td>
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
                                                               <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">Ref No</th>
                                                               <th class="fontCustom" style="z-index: 1;">Emp No</th>
                                                               <th class="fontCustom" style="z-index: 1;">Name</th>
                                                               <th class="fontCustom" style="z-index: 1;">Date</th>
                                                               <th class="fontCustom" style="z-index: 1;">Created By</th>
                                                               <th class="fontCustom" style="z-index: 1;">Created Date</th>
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
       <div class="modal fade" id="modal-view-sp">
          <div class="modal-dialog modal-lg">
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
       <div class="modal fade" id="modal-edit-sp">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                     <h4 class="modal-title" id="title_edit_sp"></h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
              </div>
              <!-- <div class="card-body table-responsive p-0" style="width: 100vw; height: 89vh; width: 100%; margin: 5px; overflow: scroll;"> -->
                     <div id="tampil_edit_sp">
                            
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
              "ajax": "ajax/data.php?data1=<?php echo $search_empno ?>&data2=<?php echo $search_name ?>"
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

        //    View
       $(document).on('click', '#modal_view_sp', function(){

            // Loader
            mymodalss.style.display = "block";
            document.getElementById("msg").innerHTML = "Data refreshed";
            // Loader

            $('#title_modal').html('View Surat Panggilan');

            var rc    = $(this).attr('id1');

            // alert(rc);  
            $.ajax({
                url: "ajax/view_sp.php",
                type: "POST",
                        data: {
                                rc: rc,
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

            //    Edit
            $(document).on('click', '#modal_edit_sp', function(){

            // Loader
            mymodalss.style.display = "block";
            document.getElementById("msg").innerHTML = "Data refreshed";
            // Loader

            $('#title_edit_sp').html('Edit Surat Panggilan');

            var rc    = $(this).attr('id1');

            // alert(rc);  
            $.ajax({
                url: "ajax/edit_sp.php",
                type: "POST",
                        data: {
                                rc: rc,
                        },
                        success: function(ajaxData) {
                                $("#tampil_edit_sp").html(ajaxData);
                                

                                // Loader
                                mymodalss.style.display = "none";
                                document.getElementById("msg").innerHTML = "Data refreshed";
                                return false;
                                // Loader
                        }
                });

            });

        // Save Edit
        $(document).on('click', '#letter_submit', function(){

            var noref           = $(this).attr('id1');
            var validasi        = $(this).attr('id2');
            var letter_to       = $('#letter_to').attr('id1');   
       //      var letter_hari     = $('#letter_hari').val();   
            var letter_tanggal  = $('#letter_tanggal').val();   
            var letter_waktu_start    = $('#letter_waktu_start').val(); 
            var letter_waktu_end    = $('#letter_waktu_end').val();  
            var letter_tempat   = $('#letter_tempat').val(); 
            var letter_masalah  = $('#letter_masalah').val(); 
            var letter_signee   = $('#letter_signee').attr('id1');

            var konseling_tanggal  = $('#konseling_tanggal').val(); 
            var konseling_conselor     = $('#konseling_conselor').val(); 
            var konseling_penaltytype     = $('#konseling_penaltytype').val(); 
            var konseling_penaltydate     = $('#konseling_penaltydate').val(); 
            var konseling_status     = $('#konseling_status').val(); 

            if(letter_to == ''){
                alert('Kepada is required!');
                return;
            }            
            if(letter_tanggal == ''){
                alert('Tanggal is required!');
                return;
            } 
            if(letter_waktu_start == ''){
                alert('Waktu mulai is required!');
                return;
            } 
            if(letter_waktu_end == ''){
                alert('Waktu selesai is required!');
                return;
            } 
            if(letter_waktu_start > letter_waktu_end){
                alert('Pastikan memilih waktu yang sesuai!');
                return;
            } 
            if(letter_tempat == ''){
                alert('Tempat is required!');
                return;
            } 
            if(letter_masalah == ''){
                alert('Masalah is required!');
                return;
            } 
            if(letter_signee == ''){
                alert('Signee by is required!');
                return;
            } 
            

            let formData = new FormData();
            formData.append('noref', noref);
            formData.append('validasi', validasi);
            formData.append('letter_to', letter_to);
       //      formData.append('letter_hari', letter_hari);
            formData.append('letter_tanggal', letter_tanggal);
            formData.append('letter_waktu_start', letter_waktu_start);
            formData.append('letter_waktu_end', letter_waktu_end);
            formData.append('letter_tempat', letter_tempat);
            formData.append('letter_masalah', letter_masalah);
            formData.append('letter_signee', letter_signee);
            formData.append('konseling_tanggal', konseling_tanggal);
            formData.append('konseling_conselor', konseling_conselor);
            formData.append('konseling_penaltytype', konseling_penaltytype);
            formData.append('konseling_penaltydate', konseling_penaltydate);
            formData.append('konseling_status', konseling_status);

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

                    $('#modal-edit-sp').modal('hide');  
                    $("[data-dismiss=modal]").trigger({type: "click"});  
                    
                }

            });

        });

        // Delete
        $(document).on('click', '#delete_letter', function(){

            var rc          = $(this).attr('id1');  

            let formData = new FormData();
            formData.append('rc', rc);

            $.ajax({
                type: 'POST',
                url: "ajax/deleteletter.php",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function (msg) {
                    
                    dataTable.ajax.reload();

                    modals.style.display ="block";
                    mymodalss.style.display = "none";
                    $('#msg').html(msg);

                    $('#modal-edit-sp').modal('hide');  
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

            $('#title_tambah').html('Add Surat Panggilan');

            $.ajax({
                url: "ajax/add_suratpanggilan.php",
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
        $(document).on('click', '#add_letter_submit', function(){

            var letter_to       = $('#add_letter_to').attr('id1');   
       //      var letter_hari     = $('#add_letter_hari').val();   
            var letter_tanggal  = $('#add_letter_tanggal').val();   
            var letter_waktu_start    = $('#add_letter_waktu_start').val(); 
            var letter_waktu_end    = $('#add_letter_waktu_end').val(); 
            var letter_tempat   = $('#add_letter_tempat').val(); 
            var letter_masalah  = $('#add_letter_masalah').val(); 
            var letter_signee   = $('#add_letter_signee').attr('id1');

            if(letter_to == ''){
                alert('Kepada is required!');
                return;
            }
       //      if(letter_hari == ''){
       //          alert('Hari is required!');
       //          return;
       //      }
            if(letter_tanggal == ''){
                alert('Tanggal is required!');
                return;
            } 
            if(letter_waktu_start == ''){
                alert('Waktu mulai is required!');
                return;
            }
            if(letter_waktu_end == ''){
                alert('Waktu selesai is required!');
                return;
            }  
            if(letter_waktu_end < letter_waktu_start){
                alert('Pastikan memilih waktu yang benar!');
                return;
            }  
            if(letter_tempat == ''){
                alert('Tempat is required!');
                return;
            } 
            if(letter_masalah == ''){
                alert('Masalah is required!');
                return;
            } 
            if(letter_signee == ''){
                alert('Signee by is required!');
                return;
            }

            let formData = new FormData();
            formData.append('letter_to', letter_to);
       //      formData.append('letter_hari', letter_hari);
            formData.append('letter_tanggal', letter_tanggal);
            formData.append('letter_waktu_start', letter_waktu_start);
            formData.append('letter_waktu_end', letter_waktu_end);
            formData.append('letter_tempat', letter_tempat);
            formData.append('letter_masalah', letter_masalah);
            formData.append('letter_signee', letter_signee);

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


        $(document).on('click', '#print', function(){
              var periode_start = $('#periode_start').val();
              var periode_end = $('#periode_end').val();
              var print_tipe_sanksi = $('#print_tipe_sanksi').val();
              var print_empno = $('#print_empno').val();

              if(periode_start != '' && periode_end == ''){
                     alert("End period can't empty!");
                     return;
              }
              if(periode_start == '' && periode_end != ''){
                     alert("Start period can't empty!");
                     return;
              }
              if(periode_start > periode_end){
                     alert('Please set period correctly!');
                     return;
              }

              $.post('export/print_st.php',{periode_start:periode_start, periode_end:periode_end, print_tipe_sanksi:print_tipe_sanksi, print_empno:print_empno}, function (data) {
                    var w = window.open('about:blank', 'width=1500,height=1000,top=70,left=100,resizable=1,menubar=yes', true);
                    w.document.open();
                    w.document.write(data);
                    w.document.close();
                    // w.document.focus();
              });
       });


    });
    
</script>

<script type="text/javascript">
              $(document).ready(function() {
                     $('#periode_start').bootstrapMaterialDatePicker({
                            date: true,
                            time: false,
                            clearButton: true,
                            format: 'YYYY-MM-DD',
                            locale:'id'
                     });

                     $('#periode_end').bootstrapMaterialDatePicker({
                            date: true,
                            time: false,
                            clearButton: true,
                            format: 'YYYY-MM-DD',
                            locale:'id'
                     });

                     $('#modal_leave_end').bootstrapMaterialDatePicker({
                            time: false,
                            clearButton: true
                     });

                     $('#add_letter_waktu_start').bootstrapMaterialDatePicker({
                            date: false,
                            time: true,
                            clearButton: true,
                            format: 'HH:mm',
                            locale:'id'
                     });

                     $('#add_letter_waktu_end').bootstrapMaterialDatePicker({
                            date: false,
                            time: true,
                            clearButton: true,
                            format: 'HH:mm',
                            locale:'id'
                     });
              });
</script>