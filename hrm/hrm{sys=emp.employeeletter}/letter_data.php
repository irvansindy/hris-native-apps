
<script src="vendor/modal/bootstrap.min.js"></script>

<?php  
       $username = $_GET['emp_no'];
       $search_en             = '';
       $search_ea             = '';
       // jika nip dan nama terisi
       if (!empty($_POST['search_en'])) {
              $search_en             = $_POST['search_en'];
       // AgusPrass 04/03/2021 menambahkan kondisi saat memfilter
       }
       if(!empty($_POST['search_ea'])){
           $search_ea                = $_POST['search_ea'];
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
                                                        <div class="col-4 name">Employee No</div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on" id="search_en"
                                                                             name="search_en" type="Text" value=""
                                                                             onfocus="hlentry(this)" size="30" maxlength="50" 
                                                                             validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title="">
                                                               </div>
                                                        </div>
                                                 </div>

                                                 <div class="form-row">
                                                        <div class="col-4 name">Employee Name</div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on"
                                                                             name="search_ea" id="search_ea" type="Text" value=""
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
                                        <a href="../hrm{sys=emp.employeeletter}/" onclick="return startload()" class="">
                                                               <div class="toolbar sprite-toolbar-back" id="add" title="Add"></div>
                                                        </a>
                                        <h4 class="card-title mb-0">Employee Letter</h4>
                       

                                        <div class="card-actions ml-auto">
                                        <table>

                                        <!--<td><a href='#' class='' data-toggle="modal" id="modal_tambah" id1="" data-target="#modal-default">
                                                               <div class="toolbar sprite-toolbar-add"
                                                                      title="Add"></div>
                                          </a></td>-->

                                   
                                          
                                        <!-- <td>
                                          <a href='#' class='open_modal_search' class="btn btn-demo" data-toggle="modal" data-target="#myModal2">
                                                 <div class="toolbar sprite-toolbar-search" id="SEARCH" title="Search">
                                                 </div>
                                          </a>
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
                                                               <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No</th>
                                                               <th class="fontCustom" style="z-index: 1;">Employee Name</th>
                                                               <th class="fontCustom" style="z-index: 1;">Letter Number</th>                                                     
                                                               <th class="fontCustom" style="z-index: 1;">Reference Date</th>
                                                               <th class="fontCustom" style="z-index: 1;">Letter Content</th>
                                                               <th class="fontCustom" style="z-index: 1;">Signed By</th>
                                                        </tr>
                                                     

                                                </thead>
                                                       

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
       <div class="modal fade" id="modal-view-letter">
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
       <div class="modal fade" id="modal-view-print">
          <div class="modal-dialog modal-bg">
            <div class="modal-content">
              <div class="modal-header">
                     <h4 class="modal-title" id="title_preview_print"></h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
              </div>
              <!-- <div class="card-body table-responsive p-0" style="width: 100vw; height: 89vh; width: 100%; margin: 5px; overflow: scroll;"> -->
                     <div id="tampil_view_print">
                            
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
              "ajax": "ajax/data_letter.php?username=<?php echo $username ?>"
       });
        //    Load data

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

        //    Edit
       $(document).on('click', '#modal_view_letter', function(){

            // Loader
            mymodalss.style.display = "block";
            document.getElementById("msg").innerHTML = "Data refreshed";
            // Loader

            $('#title_modal').html('Edit Employee Letter');

            var nc    = $(this).attr('id1');

            // alert(nc);  
            $.ajax({
                url: "ajax/edit_letter.php",
                type: "POST",
                        data: {
                                nc: nc,
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

            $(document).on('click', '#modal_view_print', function(){

// Loader
mymodalss.style.display = "block";
document.getElementById("msg").innerHTML = "Data refreshed";
// Loader

$('#title_preview_print').html('Preview Employee Letter');

var nc    = $(this).attr('id1');

// alert(nc);  
$.ajax({
    url: "ajax/edit_print.php",
    type: "POST",
            data: {
                    nc: nc,
            },
            success: function(ajaxData) {
                    $("#tampil_view_print").html(ajaxData);
                    

                    // Loader
                    mymodalss.style.display = "none";
                    document.getElementById("msg").innerHTML = "Data refreshed";
                    return false;
                    // Loader
            }
    });

});

        // Save Edit
        $(document).on('click', '#edit_letter', function(){

            var letter_no          = $(this).attr('id1');
            var signed       = $('#signed_edit').attr('id1');
            var refdate       = $('#refdate_edit').val();    

            if(signed == ''){
                   alert('Signed By is required!');
                   return;
            }
            if(refdate == ''){
                   alert('Reference date is required!');
                   return;
            }

            let formData = new FormData();
            formData.append('letter_no', letter_no);
            formData.append('signed', signed);
            formData.append('refdate', refdate);

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

                    $('#modal-view-letter').modal('hide');  
                    $("[data-dismiss=modal]").trigger({type: "click"});  

                    
                }

            });

        });

        // Delete
        $(document).on('click', '#delete_letter', function(){

            var id          = $(this).attr('id1');  

            let formData = new FormData();
            formData.append('id', id);

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

                    $('#modal-view-letter').modal('hide');  
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

            $('#title_tambah').html('Add Employee Letter');

            var id = '<?php echo $username ?>';

            // alert(nc);  
            $.ajax({
                url: "ajax/add_letter.php",
                type: "POST",
                        data: {
                                id:id,
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
        $(document).on('click', '#add_letter', function(){

            var id          = $(this).attr('id1');
            var signed       = $('#signed').attr('id1');   
            var letter_template       = $('#letter_template').val();   
            var refdate       = $('#refdate').val();  

            if(signed == ''){
                   alert('Signed by is required!');
                   return;
            }
            if(letter_template == ''){
                   alert('Letter template is required!');
                   return;
            }
            if(refdate == ''){
                     alert('Reference date is required!');
                   return;
            } 

            let formData = new FormData();
            formData.append('id', id);
            formData.append('signed', signed);
            formData.append('letter_template', letter_template);
            formData.append('refdate', refdate);

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