<!-- LOADER -->
<!-- <div onclick='return stopload()' id="loading-circle"></div> -->
<!-- LOADER -->
<!-- <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css"> -->
<script src="vendor/modal/bootstrap.min.js"></script>
<link rel="stylesheet" href="../../asset/gt_developer/asset_use/jquery.tree-multiselect.min.css">
<script src="../../asset/gt_developer/asset_use/jquery-1.11.3.min.js"></script>
<script src="../../asset/gt_developer/asset_use/jquery-ui.min.js"></script>
<script src="../../asset/gt_developer/asset_use/jquery.tree-multiselect.js"></script>
                           
<?php  
       $search_dc             = '';
       
       $search_dm             = '';
       // jika nip dan nama terisi
       if (!empty($_POST['search_dc'])) {
              $search_dc             = $_POST['search_dc'];
       // AgusPrass 04/03/2021 menambahkan kondisi saat memfilter
       }
       if(!empty($_POST['search_dm'])){
           $search_dm                = $_POST['search_dm'];
       }

        $sql_counselor_gtmo = mysqli_query($connect, "SELECT  
        b.emp_no,
        b.pos_code,
        b.Full_Name,
        a.`status`
        FROM hrmconselor a
        LEFT JOIN view_employee b ON b.pos_code = a.pos_code
        WHERE b.emp_no IS NOT NULL
        AND (b.end_date > CURDATE() OR b.end_date = '0000-00-00 00:00:00')
        AND a.worklocation = 'GTMO'
        AND a.`status` = '0'");

        $sql_counselor_gtmo_selected = mysqli_query($connect, "SELECT  
        b.emp_no,
        b.pos_code,
        b.Full_Name,
        a.`status`
        FROM hrmconselor a
        LEFT JOIN view_employee b ON b.pos_code = a.pos_code
        WHERE b.emp_no IS NOT NULL
        AND (b.end_date > CURDATE() OR b.end_date = '0000-00-00 00:00:00')
        AND a.worklocation = 'GTMO'
        AND a.`status` = '1'");
        

        $sql_counselor_ac = mysqli_query($connect, "SELECT  
        b.emp_no,
        b.pos_code,
        b.Full_Name,
        a.`status`
        FROM hrmconselor a
        LEFT JOIN view_employee b ON b.pos_code = a.pos_code
        WHERE b.emp_no IS NOT NULL
        AND (b.end_date > CURDATE() OR b.end_date = '0000-00-00 00:00:00')
        AND (a.worklocation LIKE '%PLTA%' OR a.worklocation LIKE '%PLTC%')
        AND a.`status` = '0'");

        $sql_counselor_ac_selected = mysqli_query($connect, "SELECT  
        b.emp_no,
        b.pos_code,
        b.Full_Name,
        a.`status`
        FROM hrmconselor a
        LEFT JOIN view_employee b ON b.pos_code = a.pos_code
        WHERE b.emp_no IS NOT NULL
        AND (b.end_date > CURDATE() OR b.end_date = '0000-00-00 00:00:00')
        AND (a.worklocation LIKE '%PLTA%' OR a.worklocation LIKE '%PLTC%')
        AND a.`status` = '1'");

        $sql_counselor_bhi = mysqli_query($connect, "SELECT  
        b.emp_no,
        b.pos_code,
        b.Full_Name,
        a.`status`
        FROM hrmconselor a
        LEFT JOIN view_employee b ON b.pos_code = a.pos_code
        WHERE b.emp_no IS NOT NULL
        AND (b.end_date > CURDATE() OR b.end_date = '0000-00-00 00:00:00')
        AND (a.worklocation LIKE '%PLTB%' OR a.worklocation LIKE '%PLTH%' OR a.worklocation LIKE '%PLTI%')
        AND a.`status` = '0'");

        $sql_counselor_bhi_selected = mysqli_query($connect, "SELECT  
        b.emp_no,
        b.pos_code,
        b.Full_Name,
        a.`status`
        FROM hrmconselor a
        LEFT JOIN view_employee b ON b.pos_code = a.pos_code
        WHERE b.emp_no IS NOT NULL
        AND (b.end_date > CURDATE() OR b.end_date = '0000-00-00 00:00:00')
        AND (a.worklocation LIKE '%PLTB%' OR a.worklocation LIKE '%PLTH%' OR a.worklocation LIKE '%PLTI%')
        AND a.`status` = '1'");
        
        $sql_counselor_dk = mysqli_query($connect, "SELECT  
        b.emp_no,
        b.pos_code,
        b.Full_Name,
        a.`status`
        FROM hrmconselor a
        LEFT JOIN view_employee b ON b.pos_code = a.pos_code
        WHERE b.emp_no IS NOT NULL
        AND (b.end_date > CURDATE() OR b.end_date = '0000-00-00 00:00:00')
        AND (a.worklocation LIKE '%PLTD%' OR a.worklocation LIKE '%PLTK%')
        AND a.`status` = '0'");

        $sql_counselor_dk_selected = mysqli_query($connect, "SELECT  
        b.emp_no,
        b.pos_code,
        b.Full_Name,
        a.`status`
        FROM hrmconselor a
        LEFT JOIN view_employee b ON b.pos_code = a.pos_code
        WHERE b.emp_no IS NOT NULL
        AND (b.end_date > CURDATE() OR b.end_date = '0000-00-00 00:00:00')
        AND (a.worklocation LIKE '%PLTD%' OR a.worklocation LIKE '%PLTK%')
        AND a.`status` = '1'");

        $sql_counselor_rem = mysqli_query($connect, "SELECT  
        b.emp_no,
        b.pos_code,
        b.Full_Name,
        a.`status`
        FROM hrmconselor a
        LEFT JOIN view_employee b ON b.pos_code = a.pos_code
        WHERE b.emp_no IS NOT NULL
        AND (b.end_date > CURDATE() OR b.end_date = '0000-00-00 00:00:00')
        AND (a.worklocation LIKE '%PLTR%' OR a.worklocation LIKE '%PLTE%' OR a.worklocation LIKE '%PLTM%')
        AND a.`status` = '0'");

        $sql_counselor_rem_selected = mysqli_query($connect, "SELECT  
        b.emp_no,
        b.pos_code,
        b.Full_Name,
        a.`status`
        FROM hrmconselor a
        LEFT JOIN view_employee b ON b.pos_code = a.pos_code
        WHERE b.emp_no IS NOT NULL
        AND (b.end_date > CURDATE() OR b.end_date = '0000-00-00 00:00:00')
        AND (a.worklocation LIKE '%PLTR%' OR a.worklocation LIKE '%PLTE%' OR a.worklocation LIKE '%PLTM%')
        AND a.`status` = '1'");
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
                                                        <div class="col-4 name">Disease Code</div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on" id="search_dc"
                                                                             name="search_dc" type="Text" value=""
                                                                             onfocus="hlentry(this)" size="30" maxlength="50" 
                                                                             validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title="">
                                                               </div>
                                                        </div>
                                                 </div>

                                                 <div class="form-row">
                                                        <div class="col-4 name">Disease Name</div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on"
                                                                             name="search_dm" id="search_dm" type="Text" value=""
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
                                        <h4 class="card-title mb-0">Counselor</h4>
                       

                                        <div class="card-actions ml-auto">
                                        
                                          

                                        </div>
                                    </div>

                                    <div class="card-body " style="margin: 5px;"> 
                                        
                                  

                            <div class="form-row">
                                <div class="col-3 name">GTMO</div>
                                <div class="col-sm-9" style="padding-left:15px">
                                    <div class="input-group">
                                        <div class="card-body table-responsive p-0" style="width: 100vw;height: 40vh; width: 98.8%; margin: 5px;overflow: scroll;">
                                            <select id="test-select-4" multiple="multiple" class="framework gtmo" name="framework[]" >
                                                <?php 
                                                    while($counselor_gtmo = mysqli_fetch_assoc($sql_counselor_gtmo)){
                                                ?>
                                                <option value="<?php echo $counselor_gtmo['pos_code'] ?>" data-section="" data-index=""><?php echo $counselor_gtmo['Full_Name'] ?></option>
                                                <?php } ?>
                                                <?php 
                                                    while($counselor_gtmo_selected = mysqli_fetch_assoc($sql_counselor_gtmo_selected)){
                                                ?>
                                                <option value="<?php echo $counselor_gtmo_selected['pos_code'] ?>" data-section="" data-index="" selected><?php echo $counselor_gtmo_selected['Full_Name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-3 name">PLTA and PLTC</div>
                                <div class="col-sm-9" style="padding-left:15px">
                                    <div class="input-group">
                                        <div class="card-body table-responsive p-0" style="width: 100vw;height: 40vh; width: 98.8%; margin: 5px;overflow: scroll;">
                                            <select id="test-select-5" multiple="multiple" class="framework pltac" name="framework[]" >
                                                <?php 
                                                    while($counselor_ac = mysqli_fetch_assoc($sql_counselor_ac)){
                                                ?>
                                                <option value="<?php echo $counselor_ac['pos_code'] ?>" data-section="" data-index=""><?php echo $counselor_ac['Full_Name'] ?></option>
                                                <?php } ?>
                                                <?php 
                                                    while($counselor_ac_selected = mysqli_fetch_assoc($sql_counselor_ac_selected)){
                                                ?>
                                                <option value="<?php echo $counselor_ac_selected['pos_code'] ?>" data-section="" data-index="" selected><?php echo $counselor_ac_selected['Full_Name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-3 name">PLTB,PLTH and PLTI</div>
                                <div class="col-sm-9" style="padding-left:15px">
                                    <div class="input-group">
                                        <div class="card-body table-responsive p-0" style="width: 100vw;height: 40vh; width: 98.8%; margin: 5px;overflow: scroll;">
                                            <select id="test-select-6" multiple="multiple" class="framework pltbhi" name="framework[]" >
                                                <?php 
                                                    while($counselor_bhi = mysqli_fetch_assoc($sql_counselor_bhi)){
                                                ?>
                                                <option value="<?php echo $counselor_bhi['pos_code'] ?>" data-section="" data-index=""><?php echo $counselor_bhi['Full_Name'] ?></option>
                                                <?php } ?>
                                                <?php 
                                                    while($counselor_bhi_selected = mysqli_fetch_assoc($sql_counselor_bhi_selected)){
                                                ?>
                                                <option value="<?php echo $counselor_bhi_selected['pos_code'] ?>" data-section="" data-index="" selected><?php echo $counselor_bhi_selected['Full_Name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-3 name">PLTD and PLTK</div>
                                <div class="col-sm-9" style="padding-left:15px">
                                    <div class="input-group">
                                        <div class="card-body table-responsive p-0" style="width: 100vw;height: 40vh; width: 98.8%; margin: 5px;overflow: scroll;">
                                            <select id="test-select-7" multiple="multiple" class="framework pltdk" name="framework[]" >
                                                <?php 
                                                    while($counselor_dk = mysqli_fetch_assoc($sql_counselor_dk)){
                                                ?>
                                                <option value="<?php echo $counselor_dk['pos_code'] ?>" data-section="" data-index=""><?php echo $counselor_dk['Full_Name'] ?></option>
                                                <?php } ?>
                                                <?php 
                                                    while($counselor_dk_selected = mysqli_fetch_assoc($sql_counselor_dk_selected)){
                                                ?>
                                                <option value="<?php echo $counselor_dk_selected['pos_code'] ?>" data-section="" data-index="" selected><?php echo $counselor_dk_selected['Full_Name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-3 name">PLTR, PLTE and PLTM</div>
                                <div class="col-sm-9" style="padding-left:15px">
                                    <div class="input-group">
                                        <div class="card-body table-responsive p-0" style="width: 100vw;height: 40vh; width: 98.8%; margin: 5px;overflow: scroll;">
                                            <select id="test-select-8" multiple="multiple" class="framework pltrem" name="framework[]" >
                                                <?php 
                                                    while($counselor_rem = mysqli_fetch_assoc($sql_counselor_rem)){
                                                ?>
                                                <option value="<?php echo $counselor_rem['pos_code'] ?>" data-section="" data-index=""><?php echo $counselor_rem['Full_Name'] ?></option>
                                                <?php } ?>
                                                <?php 
                                                    while($counselor_rem_selected = mysqli_fetch_assoc($sql_counselor_rem_selected)){
                                                ?>
                                                <option value="<?php echo $counselor_rem_selected['pos_code'] ?>" data-section="" data-index="" selected><?php echo $counselor_rem_selected['Full_Name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                        

                                </div>
                             

                                <div class="modal-footer">
                                                                                           <div class="mb-3 col-md-12">

                                                                                                  <button data-repeater-delete="" class="btn rounded-pill px-4 btn-light-danger text-danger font-weight-medium waves-effect waves-light m-l-10" type="button" onclick="return stopload()" data-dismiss="modal">
                                                                                                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 feather-sm ms-2 fill-white">
                                                                                                                <polyline points="3 6 5 6 21 6">
                                                                                                                </polyline>
                                                                                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                                                                </path>
                                                                                                                <line x1="10" y1="11" x2="10" y2="17">
                                                                                                                </line>
                                                                                                                <line x1="14" y1="11" x2="14" y2="17">
                                                                                                                </line>
                                                                                                         </svg>
                                                                                                         Cancel
                                                                                                  </button>
                                                                                                  <button class="btn rounded-pill px-4 btn-light-success text-success font-weight-medium waves-effect waves-light" type="submit" name="save" id="save" value="Save">
                                                                                                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send feather-sm ms-2 fill-white">
                                                                                                                <line x1="22" y1="2" x2="11" y2="13">
                                                                                                                </line>
                                                                                                                <polygon points="22 2 15 22 11 13 2 9 22 2">
                                                                                                                </polygon>
                                                                                                         </svg>
                                                                                                         Submit
                                                                                                  </button>
                                                                                           </div>
                                                                                    </div>

                                
                            </div>
                            </div>

                           
       <!-- Modal untuk reqest requester -->
       <div class="modal fade" id="modal-view-disease">
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
                            <script type="text/javascript"></script>
<script type="text/javascript">
       var tree4 = $("#test-select-4").treeMultiselect({
              allowBatchSelection: true,
              enableSelectAll: true,
              searchable: true,
              sortable: true,
              startCollapsed: false,
       });
       var tree5 = $("#test-select-5").treeMultiselect({
              allowBatchSelection: true,
              enableSelectAll: true,
              searchable: true,
              sortable: true,
              startCollapsed: false,
       });
       var tree5 = $("#test-select-6").treeMultiselect({
              allowBatchSelection: true,
              enableSelectAll: true,
              searchable: true,
              sortable: true,
              startCollapsed: false,
       });
       var tree5 = $("#test-select-7").treeMultiselect({
              allowBatchSelection: true,
              enableSelectAll: true,
              searchable: true,
              sortable: true,
              startCollapsed: false,
       });
       var tree5 = $("#test-select-8").treeMultiselect({
              allowBatchSelection: true,
              enableSelectAll: true,
              searchable: true,
              sortable: true,
              startCollapsed: false,
       });
</script>

 


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
              "ajax": "ajax/data.php?data1=<?php echo $search_dc ?>&data2=<?php echo $search_dm ?>"
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
       $(document).on('click', '#modal_view_disease', function(){

            // Loader
            mymodalss.style.display = "block";
            document.getElementById("msg").innerHTML = "Data refreshed";
            // Loader

            $('#title_modal').html('Edit Disease');

            var dc    = $(this).attr('id1');

            // alert(fc);  
            $.ajax({
                url: "ajax/edit_disease.php",
                type: "POST",
                        data: {
                                dc: dc,
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
        $(document).on('click', '#save', function(){

            var gtmo          = $('.gtmo').val();
            var pltac         = $('.pltac').val();   
            var pltbhi        = $('.pltbhi').val();   
            var pltdk         = $('.pltdk').val();
            var pltrem        = $('.pltrem').val(); 

            // alert(gtmo);
            // alert(pltac);
            // alert(pltbhi);
            // alert(pltdk);
            // alert(pltrem);
            let formData = new FormData();
            formData.append('gtmo', gtmo);
            formData.append('pltac', pltac);
            formData.append('pltbhi', pltbhi);
            formData.append('pltdk', pltdk);
            formData.append('pltrem', pltrem);

            $.ajax({
                type: 'POST',
                url: "ajax/saveworklocation.php",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function (msg) {
                    
                    dataTable.ajax.reload();

                    modals.style.display ="block";
                    mymodalss.style.display = "none";
                    $('#msg').html(msg);

                    // $('#modal-view-disease').modal('hide');  
                    // $("[data-dismiss=modal]").trigger({type: "click"}); 
                    
                }

            });

        });

        // Delete
        $(document).on('click', '#delete_disease', function(){

              var dc          = $('#dc').val();  

            let formData = new FormData();
            formData.append('dc', dc);

            $.ajax({
                type: 'POST',
                url: "ajax/deletedisease.php",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function (msg) {
                    
                    dataTable.ajax.reload();

                    modals.style.display ="block";
                    mymodalss.style.display = "none";
                    $('#msg').html(msg);

                    $('#modal-view-disease').modal('hide');  
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

            $('#title_tambah').html('Add Disease');

            // alert(nc);  
            $.ajax({
                url: "ajax/add_disease.php",
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
        $(document).on('click', '#tambah_disease', function(){

            var dc          = $('#tambah_dc').val();
            var dm_en       = $('#tambah_dm_en').val();
            var dm_id       = $('#tambah_dm_id').val(); 

            if(dc == ''){
                alert('Disease code is required!');
                return;
            }
            if(dm_en == ''){
                alert('Disease name en is required!');
                return;
            }
            if(dm_id == ''){
                alert('Disease name id is required!');
                return;
            }

            let formData = new FormData();
            formData.append('dc', dc);
            formData.append('dm_en', dm_en);
            formData.append('dm_id', dm_id);

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