
<script src="vendor/modal/bootstrap.min.js"></script>
<link rel="stylesheet" href="../../asset/gt_developer/asset_use/jquery.tree-multiselect.min.css">
<script src="../../asset/gt_developer/asset_use/jquery-1.11.3.min.js"></script>
<script src="../../asset/gt_developer/asset_use/jquery-ui.min.js"></script>
<script src="../../asset/gt_developer/asset_use/jquery.tree-multiselect.js"></script>

<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>
                           
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

       $sql_get_reqtype = mysqli_query($connect, "select
       a.approval_request
       from tsfmdatalookup a
       where a.isfapproval = '1'
       and a.module in ('EO','TA','TR','PM','GE','CA')
       and a.approval_request is not null
       and a.approval_request <> ''
       order by a.module,a.approval_request");

       $sql_get_status = mysqli_query($connect, "SELECT 
       a.code,
       a.name_en
       FROM hrmstatus a");

        $sql_view_all = mysqli_query($connect, "SELECT 
        b.Full_Name,
        b.emp_no
        FROM view_employee b
        WHERE (b.end_date > CURDATE() OR b.end_date = '0000-00-00 00:00:00')");


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
                                        <h4 class="card-title mb-0">Report Filter</h4>
                       

                                        <div class="card-actions ml-auto">
                                        
                                          

                                        </div>
                                    </div>
                                

                                    <div class="card-body " style="margin: 5px;"> 
                            <div class="form-row">
                                <div class="col-3 name">Request Type :</div>
                                <div class="col-sm-9" style="padding-left:15px">
                                    <div class="input-group">
                                        <select class="input--style-6" name="req_type" id="req_type" style="width: ;height: 30px;">
                                            <option value="">Not Specify</option>
                                            <?php 
                                            while($data_reqstatus = mysqli_fetch_assoc($sql_get_reqtype)){
                                            ?>
                                            <option value="<?php echo $data_reqstatus['approval_request'] ?>"><?php echo $data_reqstatus['approval_request']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-3 name">Status :</div>
                                <div class="col-sm-9" style="padding-left:15px">
                                    <div class="input-group">
                                        <div class="card-body table-responsive p-0" style="width: 100vw;height: 25vh; width: 98.8%; margin: 5px;overflow: scroll;">
                                            <select id="test-select-10" multiple="multiple" class="framework req_status" name="framework[]" >
                                                <?php 
                                                    while($data_status = mysqli_fetch_assoc($sql_get_status)){
                                                ?>
                                                <option value="<?php echo $data_status['code'] ?>" data-section="" data-index=""><?php echo $data_status['name_en'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-3 name">Request Date * :</div>
                                <div class="col-sm-9" style="padding-left:15px">
                                <div class="form-row" style="padding-left:0px; padding-bottom:0px">
                                <div class="col-sm-5">
                                    <div class="input-group">
                                    <input type="text" id="start_date" class="input--style-6 start_date"
                                                                                    name="start_date" style="
                                                                                    background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                                    background-size: 17px;
                                                                                    background-position:right;   
                                                                                    background-repeat:no-repeat; 
                                                                                    padding-right:10px;  
                                                                                    "
                                                                                    value=""
                                                                                    autocomplete="off"/>
                                    </div>
                                </div>
                                <div class="col-sm-2" style="text-align:center">
                                    To
                                </div>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                    <input type="text" id="end_date" class="input--style-6 end_date"
                                                                                    name="end_date" style="
                                                                                    background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                                    background-size: 17px;
                                                                                    background-position:right;   
                                                                                    background-repeat:no-repeat; 
                                                                                    padding-right:10px;  
                                                                                    "
                                                                                    value=""
                                                                                    autocomplete="off"/>
                                    </div>
                                </div>
                            </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-3 name">Employee * :</div>
                                <div class="col-sm-9" style="padding-left:15px">
                                    <div class="input-group">
                                        <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98.8%; margin: 5px;overflow: scroll;">
                                            <select id="test-select-9" multiple="multiple" class="framework req_employee" name="framework[]" >
                                                <?php 
                                                    while($view_all = mysqli_fetch_assoc($sql_view_all)){
                                                ?>
                                                <option value="<?php echo $view_all['emp_no'] ?>" data-section="" data-index=""><?php echo $view_all['Full_Name'] ?> [<?php echo $view_all['emp_no'] ?>]</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-3 name">Waiting Approver :</div>
                                <div class="col-sm-9" style="padding-left:15px">
                                    <div class="input-group" style="margin-top:8px">
                                        <input class="form-check-input" id="req_waitapprove" type="checkbox" value="0" id="flexCheckDefault">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-3 name">Show Approval Data :</div>
                                <div class="col-sm-9" style="padding-left:15px">
                                    <div class="input-group" style="margin-top:8px">
                                        <input class="form-check-input" id="req_showapprove" type="checkbox" value="0" id="flexCheckDefault">
                                    </div>
                                </div>
                            </div>
                                                    <!-- </div> -->
                                                    </div>
                                                    <div class="modal-footer">
                                                                                           <div class="mb-3 col-md-12">

                                                                                                  <a href="../hrm{sys=dashboard}/" data-repeater-delete="" class="btn rounded-pill px-4 btn-light-danger text-danger font-weight-medium waves-effect waves-light m-l-10">
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
                                                                                                  </a>
                                                                                                  <button class="btn rounded-pill px-4 btn-light-success text-success font-weight-medium waves-effect waves-light" type="submit" name="view_information" id="view_information" value="Save">
                                                                                                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send feather-sm ms-2 fill-white">
                                                                                                                <line x1="22" y1="2" x2="11" y2="13">
                                                                                                                </line>
                                                                                                                <polygon points="22 2 15 22 11 13 2 9 22 2">
                                                                                                                </polygon>
                                                                                                         </svg>
                                                                                                         Preview
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
                            <script type="text/javascript"></script>
<script type="text/javascript">
       var tree5 = $("#test-select-9").treeMultiselect({
              allowBatchSelection: true,
              enableSelectAll: true,
              searchable: true,
              sortable: true,
              startCollapsed: false,
       });
       var tree6 = $("#test-select-10").treeMultiselect({
              allowBatchSelection: true,
              enableSelectAll: true,
              searchable: true,
              sortable: true,
              startCollapsed: false,
       });
</script>

<script type="text/javascript">
              $(document).ready(function() {
                     $('#start_date').bootstrapMaterialDatePicker({
                            date: true,
                            time: false,
                            clearButton: true,
                            format: 'YYYY-MM-DD',
                            locale:'id'
                     });

                     $('#end_date').bootstrapMaterialDatePicker({
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


<script type="text/javascript" language="javascript" >
$(document).ready(function(){

            // Save Edit
        $(document).on('click', '#view_information', function(){

            var req_type = $('#req_type').val();
            var req_status = $('.req_status').val();
            var start_date = $('.start_date').val();
            var end_date = $('.end_date').val();
            var req_employee = $('.req_employee').val();
            var req_waitapprove = $('#req_waitapprove').val();
            var req_showapprove = $('#req_showapprove').val();


            if(start_date == ''){
                alert('Start date is required!');
                return;
            }
            if(end_date == ''){
                alert('End date is required!');
                return;
            }
            if(start_date > end_date){
                alert('Please check date picker!')
                return;
            }
            if(req_employee == ''){
                alert('Employee is required!')
                return;
            }

            $.post('view_report.php',{req_type:req_type, req_status:req_status, start_date:start_date, end_date:end_date, req_employee:req_employee, req_waitapprove:req_waitapprove, req_showapprove:req_showapprove}, function (data) {
                    var w = window.open('about:blank', 'width=1500,height=1000,top=70,left=100,resizable=1,menubar=yes', true);
                    w.document.open();
                    w.document.write(data);
                    w.document.close();
                    // w.document.focus();
                    });

        });

        $(document).on('click', '#req_waitapprove', function(){

            var id = $(this).val();
            if(id == 1){
                $('#req_waitapprove').val('0');
            }else if(id == 0){
                $('#req_waitapprove').val('1');
            }
        })

        $(document).on('click', '#req_showapprove', function(){

var id = $(this).val();
if(id == 1){
    $('#req_showapprove').val('0');
}else if(id == 0){
    $('#req_showapprove').val('1');
}
})

       


    });
    
</script>