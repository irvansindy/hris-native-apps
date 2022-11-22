
<!-- MAIN DATATABLE SERVERSIDE CSS -->
<!-- MAIN DATATABLE SERVERSIDE CSS -->
<script type="text/javascript" src="../../asset/sdk_datatables_core/gt_dist/jQuery-2.1.4.min.js"></script>
<script type="text/javascript"
       src="../../asset/sdk_datatables_core/datatables/bedanihbuatjson/bootstrap/js/bootstrap.min.js"></script>
<!-- MAIN DATATABLE SERVERSIDE CSS -->
<!-- MAIN DATATABLE SERVERSIDE CSS -->



<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>



<script type="text/javascript">
              $(document).ready(function() {
                     $('#inp_startdate').bootstrapMaterialDatePicker({
                            time: false,
                            clearButton: true
                     });

                     $('#inp_enddate').bootstrapMaterialDatePicker({
                            time: false,
                            clearButton: true
                     });

                     $('#inp_starttime').bootstrapMaterialDatePicker({
                            date: false,
                            format: 'HH:mm'
                     });

                     $('#inp_endtime').bootstrapMaterialDatePicker({
                            date: false,
                            format: 'HH:mm'
                     });
              });
</script>







<?php  
       $getispic = mysqli_fetch_array(mysqli_query($connect, "SELECT pic,GROUP_CONCAT('`', _id , '`') AS authorized
                                                                             FROM whstm_pic_category
                                                                             WHERE pic = '$username'
                                                                             GROUP BY pic"));

                                                                             // echo "SELECT pic,GROUP_CONCAT('`', _id , '`') AS authorized
                                                                             // FROM whstm_pic_category
                                                                             // WHERE pic = '$username'
                                                                             // GROUP BY pic";

       $getispic_r = str_replace("`" , "'" , $getispic['authorized']);


       $src_emp_no                = '';
       $src_request_no            = '';
       if (!empty($_POST['src_emp_no']) && !empty($_POST['src_request_no'])) {
              $src_emp_no          = $_POST['src_emp_no'];
              $src_request_no      = $_POST['src_request_no'];
              $frameworks          = "?user=$username"."&is_pic="."".$getispic_r."&src_emp_no="."".$src_emp_no."&src_request_no="."".$src_request_no."";
       } else if (!empty($_POST['src_emp_no'])) {
              $src_emp_no          = $_POST['src_emp_no'];
              $src_request_no      = $_POST['src_request_no'];
              $frameworks          = "?user=$username"."&is_pic="."".$getispic_r."&src_emp_no="."".$src_emp_no."";
       } else if (!empty($_POST['src_request_no'])) {
              $src_emp_no          = $_POST['src_emp_no'];
              $src_request_no      = $_POST['src_request_no'];
              $frameworks          = "?user=$username"."&is_pic="."".$getispic_r."&src_request_no="."".$src_request_no."";
       } else {
              $frameworks          = "?user=$username"."&is_pic="."".$getispic_r."";
       }

       $random = rand();

       $SFnumbercon         	= 'WHIST'.$SFyear.'-'.$random.$SFnumber;

       if(!empty($getispic_r)){
              $display_add = 'display:none;';
       } else {
              $display_add = '';
       }

       // echo  $display_add . "<br>";
       // echo $getispic_r;
             
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
                                                        <div class="col-4 name">Suspecter No.  </div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on" id="src_emp_no"
                                                                             name="src_emp_no" id="src_emp_no" type="Text" value="<?php echo $src_emp_no; ?>"
                                                                             onfocus="hlentry(this)" size="30" maxlength="50" 
                                                                             validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title="">
                                                               </div>
                                                        </div>
                                                 </div>

                                                 <div class="form-row">
                                                        <div class="col-4 name">Request No.  </div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on" id="src_request_no"
                                                                             name="src_request_no" id="src_request_no" type="Text" value="<?php echo $src_request_no; ?>"
                                                                             onfocus="hlentry(this)" size="30" maxlength="50" 
                                                                             validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title="">
                                                               </div>
                                                        </div>
                                                 </div>
                                          </fieldset>
                                          <button type="submit" name="submit_search" id="submit_search" type="button" class="btn btn-warning button_bot">
                                                 Filter
                                          </button>
                                   </form>
				</div>

			</div><!-- modal-content -->
		</div><!-- modal-dialog -->
	</div><!-- modal -->
	




<!-- MAIN DATATABLE SERVERSIDE CSS -->
<!-- MAIN DATATABLE SERVERSIDE CSS -->
<script type="text/javascript" src="../../asset/sdk_datatables_core/gt_dist/jQuery-2.1.4.min.js"></script>
<script type="text/javascript"
       src="../../asset/sdk_datatables_core/datatables/bedanihbuatjson/bootstrap/js/bootstrap.min.js"></script>
<!-- MAIN DATATABLE SERVERSIDE CSS -->
<!-- MAIN DATATABLE SERVERSIDE CSS -->

<!-- isi JSON -->
<script type="text/javascript">
// global the manage memeber table 
$(document).ready(function() {
       datatable = $("#datatable").DataTable({
              
              dom: "B<'row'<'col-sm-12 col-md-9'l><'col-sm-12 col-md-9'f>>" +
                   "<'row'<'col-sm-12'tr>>" +
                   "<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-7'p>>",

              processing: true,
              // retrieve: true,
              searching: false,
              paging: true,
              // order: [
              //        [0, "desc"]
              // ],
              ordering: false,
              pagingType : "simple",
              bPaginate: true,
              bLengthChange: false,
              bFilter: false,
              bInfo: true,
              bAutoWidth: true,
              language: {
                     "processing": "Please wait..",
              },
              columnDefs: [
              { orderable: false, targets: 0 }
              ], 
              destroy: true,
              "ajax": "php_action/FuncDataRead.php<?php echo $frameworks; ?>"
       });
});
</script>

<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>

<style>
       thead {
              display:none;
              }
       .sorting_1 {
              border-left: 1px solid white;
       }
       .odd  {
              border-left: 1px solid white;
       }
             
</style>


<div class="col-md-12">
       <div class="card" style="border-radius: 20px 20px 20px 20px;margin-bottom: 25px;margin-left: -34px;margin-right: -34px;">
              <div class="card-header d-flex align-items-center" style="border-bottom: 1px solid white;">
                     <h4 class="card-title mb-0">Whistle Request List </h4>


                     <div class="card-actions ml-auto">
                            <table>

                                  <td>
                                          <div class="toolbar sprite-toolbar-add" title="Add" data-toggle="modal"
                                                 data-target="#CreateForm" style="<?php echo $display_add; ?>" id="CreateButton" data-keyboard="false"
                                                 data-backdrop="static">
                                                        <!-- <a title="add" href="" class="toolbar sprite-toolbar-add" data-toggle="modal" data-target="#CreateForm" id="CreateButton" data-keyboard="false" data-backdrop="static">tambah</a> -->
                                          </div>
                                   </td>
                                   <td>

                                          <a href='#' class='open_modal_search' class="btn btn-demo" data-toggle="modal" data-target="#myModal2">
                                                 <div class="toolbar sprite-toolbar-search" id="SEARCH" title="Search">
                                                 </div>
                                          </a>



                                   </td>
                                   <!-- AgusPrass 02/03/2021 Menghapus # pada href-->
                                   <td>
                                          <div class="toolbar sprite-toolbar-reload" id="RELOAD" title="Reload"
                                                 onclick="RefreshPage();">
                                          </div>

                                          


                                   </td>
                                   

                            </table>
                     </div>
              </div>

              <div class="card-body table-responsive p-0"
                     style="width: 100vw;height: 70vh; width: 98%; margin: 5px;overflow:scroll;overflow-x: hidden;border: 1px solid white;">
                     <table id="datatable" width="100%" border="1" align="left"
                            class="table table-bordered-sdk table-hover"> 
                     </table>

                     <div>
                     </div>

              </div>
       </div>
</div>











<!-- add modal -->
<div class="modal  fade fade-custom" tabindex="-1" role="dialog" id="CreateForm">
       <div class="modal-dialog modal-belakang modal-bgkpi" role="document">
              <div class="modal-content">
                     <div class="modal-header">
                            <h4 class="modal-title">Add Whistle</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">
                     
                     <form class="form-horizontal" action="php_action/FuncDataCreate.php" method="POST"
                            id="FormDisplayCreate">

                            <fieldset id="fset_1">
                                   <legend>Detail Informations</legend>

                                   <div class="messages_create"></div>

                                   <input id="inp_emp_no" name="inp_emp_no" type="hidden" value="<?php echo $username; ?>">
                                   
                                   <!--FROM SESSION -->
                                   <input id="inp_whistle_requestno" name="inp_whistle_requestno" type="hidden" value="<?php echo $SFnumbercon; ?>">
                                   <!--FROM SESSION -->

                                   <div class="form-row" id="WD0">
                                          <div class="col-sm-2 name">Employee <span class="required">*</span></div>
                                          <div class="col-sm-10">
                                                 <div class="input-group">
                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="inp_emp_id" 
                                                               name="inp_emp_id"
                                                               type="Text" value="<?php echo $username; ?>" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               placeholder="input title"
                                                               style="text-transform:uppercase;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row" id="WD1" style="display:none;">
                                          <div class="col-sm-2 name">You are currently</div>
                                          <div class="col-sm-10">
                                                 <div class="input-group">
                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="inp_emp_id_Anonymous" 
                                                               name="inp_emp_id_Anonymous"
                                                               type="Text" value="Anonymous" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               placeholder="input title"
                                                               style="text-transform:uppercase;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>

                                                 
                                          </div>
                                   </div>
                                   

                                   <div class="form-row">
                                          <div class="col-sm-2 name"></div>
                                          <div class="col-sm-10">
                                                 <div class="input-group">
                                                        <script>
                                                        $(function () {
                                                               $("#anonymous").click(function () {
                                                               if ($("#anonymous").is(":checked")) {
                                                                      $('#WD0').hide();
                                                                      $('#WD1').show();
                                                               } else {
                                                                      $('#WD0').show();
                                                                      $('#WD1').hide();
                                                               }
                                                               });
                                                        });
                                                        </script>
                                                        <div class="form-check form-check-inline" style="margin-top: 15px;">
                                                                      <input class="form-check-input" type="checkbox" id="anonymous" name="anonymous" value="Y">
                                                                      <label class="form-check-label" for="anonymous">Set as anonymous ?</label>
                                                        </div>
                                                 </div>

                                                 
                                          </div>
                                   </div>

                                   
                                   
                                   <div class="form-row">
                                          <div class="col-sm-2 name">Title <span class="required">*</span></div>
                                          <div class="col-sm-10">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="inp_title" 
                                                               name="inp_title"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               placeholder="input title"
                                                               style="text-transform:uppercase;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>

                                    <div class="form-row">
                                          <div class="col-sm-2 name">Category Of Report <span class="required">*</span></div>
                                          <div class="col-sm-4">
                                                 <div class="input-group">

                                                        <select class="form-control input--style-6" 
                                                                      autocomplete="off" 
                                                                      autofocus="on"
                                                                      id="inp_category" 
                                                                      name="inp_category"
                                                                      style="height: 33px;">
                                                                             <option value="" selected> --Select one --</option>
                                                                             <?php 
                                                                             $sql=mysqli_query($connect, "SELECT * FROM whstm_category");
                                                                             while ($data=mysqli_fetch_array($sql)) {
                                                                             ?>
                                                                             <option value="<?=$data['_id']?>"><?=$data['_category_name']?></option> 
                                                               <?php
                                                               }
                                                               ?>
                                                        </select>
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-2 name">Suspector <span class="required">*</span></div>
                                          <div class="col-sm-7 name">
                                                 <div class="input-group">
                                                        <a><img width="15px" src="../../asset/img/icon_user.png" style="margin-left: 5px;"></a>&nbsp;&nbsp;
                                                        <input type="text" autocomplete="off" onfocus="this.value=''" value="" style="font-size: 11px;border: 1px solid #aaa6a6;border-radius: 8px;height: 20px;padding-left: 10px;background: #1e88e521;" name="employee" id="employee" class="search-input">

                                                        <!-- <input type="text" name="inp_SpvUPManpower" id="inp_SpvUPManpower" style="width: 70%;font-size: 11px;border: 1px solid #aaa6a6;border-radius: 8px;height: 20px;padding-left: 10px;background: #1e88e521;" class="form-control" placeholder="Employee" />   -->
                                                        <div id="employeeList"></div>

                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row" id="start_form">
                                          <div class="col-sm-2 name">Time of event</div>
                                          <div class="col-sm-3">
                                                 <div class="card-body table-responsive p-0"
                                                        style="overflow: scroll;overflow-x: hidden;">
                                                        <td>
                                                               <input type="text" 
                                                                      id="inp_startdate" 
                                                                      name="inp_startdate" 
                                                                      class="input--style-6"
                                                                      style="
                                                                      background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                      background-size: 17px;
                                                                      background-position:right;   
                                                                      background-repeat:no-repeat; 
                                                                      padding-right:10px;  
                                                                      " />
                                                        </td>
                                                 </div>
                                          </div>
                                        
                                   </div>



                                   <div class="form-row">
                                          <div class="col-sm-2 name">Case Detail <span class="required">*</span></div>
                                          <div class="col-sm-6">
                                                 <div class="input-group">
                                                        <textarea id="editor" value="" name="inp_address"></textarea>
                                                 </div>
                                          </div>
                                   </div>

                                  
                                  
                                   
                                 
                            </fieldset>


                            <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>

                            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css"/>

                            <style type="text/css">

                            
                                   .fileinput-remove{

                                   display: none;

                                   },

                                   .fileinput-upload{

                                   display: none;

                                   }

                                   .file-caption{

                                   height: 34px;

                                   }

                            </style>

                            <div class="form-row">
                                   <div class="col-sm-12 name">
                                          <div class="file-loading">
                                                 <input id="file-1" type="file" name="file" multiple class="file" style="padding: 7px;" data-overwrite-initial="false" data-min-file-count="2">
                                          </div>
                                   </div>
                            </div>



                            <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

                            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript"></script>

                            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js" type="text/javascript"></script>

                            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" type="text/javascript"></script>

                            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" type="text/javascript"></script>


                            <script type="text/javascript">

                                   var inp_whistle_requestno        = $("#inp_whistle_requestno").val();

                                   $("#file-1").fileinput({

                                   theme: 'fa',

                                   uploadUrl: "imageUpload.php?emp_id=<?php echo $username; ?>&id_whitle=" + inp_whistle_requestno + "&username=<?php echo $username; ?>",

                                   allowedFileExtensions: ['jpg', 'png', 'gif','jpeg', 'pdf'],

                                   overwriteInitial: false,

                                   maxFileSize:10000,

                                   maxFilesNum: 10,

                                   slugCallback: function (filename) {

                                          return filename.replace('(', '_').replace(']', '_');

                                   }

                                   });

                            </script>
                            </div>
                            <div class="modal-footer-sdk">
                                   <button type="reset" class="btn-sdk btn-primary-left" data-dismiss="modal" onclick="ResetTable();"
                                          aria-hidden="true">
                                          &nbsp;Cancel&nbsp;
                                   </button>
                                   <button class="btn-sdk btn-primary-right" type="submit" name="submit_add" id="submit_add">
                                          Confirm
                                   </button>
                                   <button class="btn-sdk btn-primary-right" type="button" name="submit_add2"
                                          id="submit_add2" style='display:none;' disabled>
                                          <span class="spinner-grow spinner-grow-sm" role="status"
                                                 aria-hidden="true"></span>
                                          &nbsp;&nbsp;Processing..
                                   </button>
                            </div>
                    
                     </form>
              </div>
       </div>
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /edit modal -->













































<!-- edit modal -->
<div class="modal  fade fade-custom" tabindex="-1" role="dialog" id="UpdateForm">
       <div class="modal-dialog modal-belakang modal-bgkpi" role="document">

              <div class="modal-content">
                     <div class="modal-header">
                            <h4 class="modal-title">Edit Whistle</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 99%; margin: 5px;overflow: scroll;overflow-x: hidden;">


                     <form class="form-horizontal" action="php_action/FuncDataUpdate.php" method="POST" id="FormDisplayUpdate">

                     <fieldset id="fset_1">
                                   <legend>Detail Informations</legend>

                                   <div class="messages_create"></div>

                                   <input id="sel_emp_no" name="sel_emp_no" type="hidden" value="<?php echo $username; ?>">
                                   
                                   <!--FROM SESSION -->
                                   <input id="sel_whistle_requestno" name="sel_whistle_requestno" onchange="" type="hidden" value="">
                                   <!--FROM SESSION -->

                                   <div class="form-row" id="WD0_update">
                                          <div class="col-sm-2 name">Employee <span class="required">*</span></div>
                                          <div class="col-sm-10">
                                                 <div class="input-group">
                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_emp_id" 
                                                               name="sel_emp_id"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               placeholder="input title"
                                                               style="text-transform:uppercase;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row" id="WD1_update" style="display:none;">
                                          <div class="col-sm-2 name">You are currently</div>
                                          <div class="col-sm-10">
                                                 <div class="input-group">
                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_emp_id_Anonymous" 
                                                               name="sel_emp_id_Anonymous"
                                                               type="Text" value="Anonymous" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               placeholder="input title"
                                                               style="text-transform:uppercase;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>

                                                 
                                          </div>
                                   </div>
                                   

                                   <div class="form-row">
                                          <div class="col-sm-2 name"></div>
                                          <div class="col-sm-10">
                                                 <div class="input-group">
                                                        <script>
                                                        $(function () {
                                   
                                                               $("#sel_anonymous").click(function () {
                                                               if ($("#sel_anonymous").is(":checked")) {
                                                                      $('#WD0_update').hide();
                                                                      $('#WD1_update').show();
                                                               } else {
                                                                      $('#WD0_update').show();
                                                                      $('#WD1_update').hide();
                                                               }
                                                               });
                                                        });
                                                        </script>
                                                        <div class="form-check form-check-inline" style="margin-top: 15px;">
                                                                      <input class="form-check-input" type="checkbox" id="sel_anonymous" name="sel_anonymous" value="Y">
                                                                      <label class="form-check-label" for="sel_anonymous">Set as anonymous ?</label>
                                                        </div>
                                                 </div>

                                                 
                                          </div>
                                   </div>

                                   
                                   
                                   <div class="form-row">
                                          <div class="col-sm-2 name">Title <span class="required">*</span></div>
                                          <div class="col-sm-10">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_title" 
                                                               name="sel_title"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               placeholder="input title"
                                                               style="text-transform:uppercase;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>

                                    <div class="form-row">
                                          <div class="col-sm-2 name">Category Of Report <span class="required">*</span></div>
                                          <div class="col-sm-4">
                                                 <div class="input-group">

                                                        <select class="form-control input--style-6" 
                                                                      autocomplete="off" 
                                                                      autofocus="on"
                                                                      id="sel_category" 
                                                                      name="sel_category"
                                                                      style="height: 33px;">
                                                                             <option value="" selected> --Select one --</option>
                                                                             <?php 
                                                                             $sql=mysqli_query($connect, "SELECT * FROM whstm_category");
                                                                             while ($data=mysqli_fetch_array($sql)) {
                                                                             ?>
                                                                             <option value="<?=$data['_id']?>"><?=$data['_category_name']?></option> 
                                                               <?php
                                                               }
                                                               ?>
                                                        </select>
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-2 name">Suspector <span class="required">*</span></div>
                                          <div class="col-sm-7 name">
                                                 <div class="input-group">
                                                        <a><img width="15px" src="../../asset/img/icon_user.png" style="margin-left: 5px;"></a>&nbsp;&nbsp;
                                                        <input type="text" autocomplete="off" value="" style="font-size: 11px;border: 1px solid #aaa6a6;border-radius: 8px;height: 20px;padding-left: 10px;background: #1e88e521;" name="sel_employee" id="sel_employee" class="search-input">

                                                        <!-- <input type="text" name="inp_SpvUPManpower" id="inp_SpvUPManpower" style="width: 70%;font-size: 11px;border: 1px solid #aaa6a6;border-radius: 8px;height: 20px;padding-left: 10px;background: #1e88e521;" class="form-control" placeholder="Employee" />   -->
                                                        <div id="employeeList"></div>

                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row" id="start_form">
                                          <div class="col-sm-2 name">Time of event</div>
                                          <div class="col-sm-3">
                                                 <div class="card-body table-responsive p-0"
                                                        style="overflow: scroll;overflow-x: hidden;">
                                                        <td>
                                                               <input type="text" 
                                                                      id="sel_startdate" 
                                                                      name="sel_startdate" 
                                                                      class="input--style-6"
                                                                      style="
                                                                      background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                      background-size: 17px;
                                                                      background-position:right;   
                                                                      background-repeat:no-repeat; 
                                                                      padding-right:10px;  
                                                                      " />
                                                        </td>
                                                 </div>
                                          </div>
                                        
                                   </div>



                                   <div class="form-row">
                                          <div class="col-sm-2 name">Case Detail <span class="required">*</span></div>
                                          <div class="col-sm-6">
                                                 <div class="input-group">
                                                        <textarea id="editor_updates" class="form-control" style="height:100px" value="" name="sel_address"></textarea>
                                                 </div>
                                          </div>
                                   </div>

                                   <!-- pages relation -->
                                   <div id="box"></div>
                                   <!-- pages relation -->

                                    <!-- pages relation -->
                                   <div id="box_update"></div>
                                   <!-- pages relation -->

                                  
                                  
                                   
                                 
                            </fieldset>


              
                            <div class="form-row">
                                   <div class="col-sm-12 name">
                                          <div class="">
                                                 <input type="file" name="file_update" id="file_update" class="form-control file" style="padding: 7px;">
                                          </div>
                                   </div>
                            </div>

                            <form >

    <!-- <div class="form-group">
        <label>File Upload</label>
        <input type="file" name="file_update" id="file_update" class="form-control" />
    </div> -->

                            <script>
            
                                   document.getElementById("file_update").onchange = function() {

                                   // alert("gerak"); 

                                   const file_update = $('#file_update').prop('files')[0];
                                   var nama_file = $('#nama_file').val();
                                   var sel_whistle_requestno = $('#sel_whistle_requestno').val();

                                                 if (file_update!="") {
                                                        let formData = new FormData();
                                                        formData.append('file_update', file_update);
                                          
                                                        $.ajax({
                                                        type: 'POST',
                                                        url: "imageUploadUpdate.php?emp_id=<?php echo $username; ?>&id_whistle_upload=" + sel_whistle_requestno + "&username=<?php echo $username; ?>",
                                                        data: formData,
                                                        cache: false,
                                                        processData: false,
                                                        contentType: false,
                                                        success: function () {
                                                               // alert("berhasil");

                                                               $("#box").hide();
                                                               $("#box_update").load("pages_relation/_pages_photo.php?emp_id=<?php echo $username; ?>&rfid=" + sel_whistle_requestno + "&username=<?php echo $username; ?>", 
                                                                             function(responseTxt_spv_up, statusTxt_spv_up, jqXHR_spv_up){
                                                                                    if(statusTxt_spv_up == "success"){
                                                                                           $("#box_update").show();
                                                                                           mymodalss.style.display = "none";
                                                                                    }
                                                                             }
                                                               );
                                                        },
                                                        error: function () {
                                                               alert("Data Gagal Diupload");
                                                        }
                                                 });
                                          }
                                   };



                                   
                     
                            </script>
                            </div>
                            <div class="modal-footer-sdk" >
                                   <button type="reset" id="submit_update_cancel" class="btn-sdk btn-primary-left" data-dismiss="modal" onclick="ResetTable();"
                                          aria-hidden="true">
                                          &nbsp;Cancel&nbsp;
                                   </button>
                                   <button class="btn-sdk btn-primary-right" type="submit" name="submit_update" id="submit_update">
                                          Confirm
                                   </button>
                                   <button class="btn-sdk btn-primary-right" type="button" name="submit_update2"
                                          id="submit_update2" style='display:none;' disabled>
                                          <span class="spinner-grow spinner-grow-sm" role="status"
                                                 aria-hidden="true"></span>
                                          &nbsp;&nbsp;Processing..
                                   </button>
                            </div>
                    
                     </form>
              </div>
       </div>
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /edit modal -->




























	<!-- delete transaction modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="FormDisplayDelete">
	
	  <div class="modal-dialog modal-vsm" style="margin-top: 120px;">
	    <div class="modal-content" style="border-radius: 5px;">
		<form class="form-horizontal" action="php_action/FuncDataDelete.php" method="POST" id="updatedelMemberForm">	      

		<div class="modal-body">      	
		  <div class="edit-messages"></div>
		  <table width="100%">
                     <tr><td align="center"><img src="../../asset/dist/img/sf-mola-mola.png" style="max-width: 90%;margin-top: 20px;"></td></tr>
                   
                     </table>
                     <div class="form-group">
                            <div class="col-sm-12">	
                                          <table width="100%"><td align="center"><label id="isi">Are you sure to delete news ?</label></td></table>		
                                          <input type="hidden" class="form-control input-report" id="sel_id_berita" name="sel_id_berita" placeholder="Nip">
                            </div>
                     </div>

                            <div class="modal-footer-delete FormDisplayDelete" style="text-align: center;padding-bottom: 14px;" >
                                   <button type="reset" class="btn btn-primary1" data-dismiss="modal" onclick="ResetTable();"
                                          aria-hidden="true">
                                          &nbsp;Cancel&nbsp;
                                   </button>
                                   <button class="btn btn-warning" type="submit" name="submit_delete" id="submit_delete">
                                          Confirm
                                   </button>
                                   <button class="btn btn-warning" type="button" name="submit_delete2"
                                          id="submit_delete2" style='display:none;' disabled>
                                          <span class="spinner-grow spinner-grow-sm" role="status"
                                                 aria-hidden="true"></span>
                                          &nbsp;&nbsp;Processing..
                                   </button>
                            </div>


	      </form>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<!-- /edit modal -->

	












































<script>
function RefreshPage() {
       datatable.ajax.reload(null, true);

       setTimeout(function(){
              mymodalss.style.display = "none";
              document.getElementById("msg").innerHTML = "Data refreshed";
              return false;
       }, 2000);

       mymodalss.style.display = "block";
       document.getElementById("msg").innerHTML = "Data refreshed";
       return false;
}
</script>
<script>
function ResetTable() {
       $("#tbl_posts > tbody > .reset-delete-record").html("");
       $("#tbl_posts_second > tbody > .reset-delete-record").html("");

       for (let i = 2; i < 100; i++) {
              jQuery('#rec-' + [i]).remove();
              jQuery('#recs-' + [i]).remove();
       }
}
</script>









































<!-- isi JSON -->
<script type="text/javascript">
// global the manage memeber table 
$(document).ready(function() {
       $("#CreateButton").on('click', function() {
              // reset the form 
              $("#FormDisplayCreate")[0].reset();
              // empty the message div

              $(".messages_create").html("");

              // submit form
              $("#FormDisplayCreate").unbind('submit').bind('submit', function() {

                     $(".text-danger").remove();

                     var form = $(this);

                     var inp_emp_id              = $("#inp_emp_id").val();
                     var inp_title               = $("#inp_title").val();
                     var inp_category            = $("#inp_category").val();
                     var inp_startdate           = $("#inp_startdate").val();
                     var employee                = $("#employee").val();

                     var regex=/^[a-zA-Z]+$/;
                  
                     if (inp_emp_id == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Emp id cannot empty";

                     } else if (inp_title == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Title cannot empty";

                     } else if (inp_category == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Category cannot empty";
                     
                     } else if (inp_startdate == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Startdate cannot empty";
                     
                     } else if (employee == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Suspector cannot empty";

                     } else {
                            $('#submit_add').hide();
                            $('#submit_add2').show();
                             mymodalss.style.display = "block";
                     }

                     if (inp_emp_id && inp_title && inp_category && inp_startdate && employee) {
                            //submi the form to server
                            $.ajax({
                                   url: form.attr('action'),
                                   type: form.attr('method'),
                                   // data: form.serialize(),

                                   data: new FormData(this),
                                   processData: false,
                                   contentType: false,

                                   dataType: 'json',
                                   success: function(response) {

                                          // remove the error 
                                          $(".form-group").removeClass('has-error').removeClass('has-success');

                                          if (response.code =='success_message') {
                                                 $('#submit_add').show();
                                                 $('#submit_add2').hide();

                                                 $('#FormDisplayCreate').modal('hide');  
                                                 $("[data-dismiss=modal]").trigger({type: "click"});   

                                                 // reset the form
                                                 $("#FormDisplayCreate")[0].reset();
                                                 // reload the datatables
                                                 datatable.ajax.reload(null,false);
                                                 // this function is built in function of datatables;

                                                 mymodalss.style.display = "none";
                                                 modals.style.display ="block";
                                                 document.getElementById("msg").innerHTML = response.messages;

                                                 // failed_message_without_attachment
                                          
                                          } else if (response.code =='failed_message_without_attachment') {
                                                 mymodalss.style.display = "none";
                                                 modals.style.display ="block";
                                                 document.getElementById("msg").innerHTML = response.messages;

                                                 $('#submit_add').show();
                                                 $('#submit_add2').hide();

                                                 window.setTimeout(
                                                        function() {
                                                               $(".alert")
                                                                      .fadeTo(
                                                                             500,
                                                                             0
                                                                             )
                                                                      .slideUp(
                                                                             500,
                                                                             function() {
                                                                                    $(this)
                                                                             .remove();
                                                                             }
                                                                      );
                                                        },
                                                        4000
                                                        );

                                                 // failed_message_without_attachment

                                          } else {
                                                 mymodalss.style.display = "none";
                                                 modals.style.display ="block";
                                                 document.getElementById("msg").innerHTML = response.messages;

                                                 $('#submit_add').show();
                                                 $('#submit_add2').hide();

                                                 window.setTimeout(
                                                        function() {
                                                               $(".alert")
                                                                      .fadeTo(
                                                                             500,
                                                                             0
                                                                             )
                                                                      .slideUp(
                                                                             500,
                                                                             function() {
                                                                                    $(this)
                                                                             .remove();
                                                                             }
                                                                      );
                                                        },
                                                        4000
                                                        );
                                          } // /else
                                   } // success  
                            }); // ajax subit 				
                     } /// if
                     return false;
              }); // /submit form for create member
       }); // /add modal
});






























  
                     
                            
                                   
                                
                                   
                                 
               
                   
            






function editMember(id = null) {
       if (id) {
              // remove the error 
              $(".form-group").removeClass('has-error').removeClass('has-success');
              $(".text-danger").remove();
              // empty the message div
              $(".messages_update").html("");

              // remove the id
              $("#member_id").remove();

              



              // fetch the member data
              $.ajax({
                     url: 'php_action/getSelectedRequest.php?emp_id=<?php echo $username; ?>',
                     type: 'post',
                     data: {
                            member_id: id
                     },
                     dataType: 'json',


                     success: function(response) {
                            var sel_emp_no = $("#sel_emp_no").val();
                            
        
                            $("#box").load("pages_relation/_pages_photo.php?emp_id=<?php echo $username; ?>&rfid=" + response._id_whistle + "&username=<?php echo $username; ?>", 
                                          function(responseTxt_spv_up, statusTxt_spv_up, jqXHR_spv_up){
                                                 if(statusTxt_spv_up == "success"){
                                                        $("#box").show();
                                                        mymodalss.style.display = "none";
                                                 }
                                          }
                            );

                            // alert(sel_emp_no);

                            


                            

                            
                            $("#editor_updates").val(response.whistle_description); 
                            $("#sel_whistle_requestno").val(response._id_whistle);
                            $("#sel_emp_id").val(response.created_by);
                            $("#sel_title").val(response.title);
                            $("#sel_category").val(response.category);
                            $("#sel_employee").val(response.suspecter + " " + response.suspect);
                            $("#sel_startdate").val(response.reported_date);
                               
                            
                            if(response.anonymous == 'Y') {
                                   $('#WD0_update').hide();
                                   $('#WD1_update').show();
                                   $( "#sel_anonymous").prop('checked', true);
                            } else {
                                   $('#WD0_update').show();
                                   $('#WD1_update').hide();
                                   $( "#sel_anonymous").prop('checked', false);
                            }
                           
                            if(response.created_by != sel_emp_no) {
                                   $("#submit_update_cancel").hide();
                                   $("#submit_update").hide();
                                   $("#submit_update2").hide();
                                   $(".file-caption-main").hide();
                            } else {
                                   $("#submit_update_cancel").show();
                                   $("#submit_update").show();
                                   $("#.file-caption-main").show();
                        
                            }



                    
                        


                            // here update the member data
                            $("#FormDisplayUpdate").unbind('submit').bind('submit', function() {
                                   // remove error messages
                                   $(".text-danger").remove();

                                   var form = $(this);

                                   var update_id_berita        = $("#update_id_berita").val();
                                   var update_subject          = $("#update_subject").val();

                                   var sel_whistle_requestno = $("#sel_whistle_requestno").val();
                                   var sel_emp_id = $("#sel_emp_id").val();
                                   var sel_title = $("#sel_title").val();
                                   var sel_category = $("#sel_category").val();
                                   var sel_employee = $("#sel_employee").val();
                                   var sel_startdate = $("#sel_startdate").val();
                                   var editor_update = $("#editor_update").val(); 
                                
                                   var regex=/^[a-zA-Z]+$/;

                                   if (sel_emp_id == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "Empid cannot empty";
                                   } else {
                                          $('#submit_update').hide();
                                          $('#submit_update2').show();
                                   }




                                   if (sel_emp_id) {

                                          $.ajax({
                                                 
                                                 url: form.attr('action'),
                                                 type: form.attr('method'),
                                                 // data: form.serialize(),

                                                 data: new FormData(this),
                                                 processData: false,
                                                 contentType: false,

                                                 dataType: 'json',
                                                 success: function(response) {

                                                        if (response.code =='success_message_update') {

                                                               $('#submit_update').show();
                                                               $('#submit_update2').hide();

                                                               $('#FormDisplayUpdate').modal('hide');  
                                                               $("[data-dismiss=modal]").trigger({type: "click"});      
                                                        
                                                               // reload the datatables
                                                               datatable.ajax.reload(null,false);
                                                               // reload the datatables

                                                               modals.style.display = "block";
                                                               document.getElementById("msg").innerHTML =response.messages;

                                                        } else if (response.code =='failed_message_without_attachment') {
                                                
                                                               mymodalss.style.display = "none";
                                                               modals.style.display ="block";
                                                               document.getElementById("msg").innerHTML = response.messages;

                                                               $('#submit_update').show();
                                                               $('#submit_update2').hide();

                                                               window.setTimeout(
                                                                      function() {
                                                                             $(".alert")
                                                                                    .fadeTo(
                                                                                           500,
                                                                                           0
                                                                                           )
                                                                                    .slideUp(
                                                                                           500,
                                                                                           function() {
                                                                                                  $(this)
                                                                                           .remove();
                                                                                           }
                                                                                    );
                                                                      },
                                                                      4000
                                                                      );

                                                               // failed_message_without_attachment
                                                               
                                                        } else {
                                                               modals.style.display = "block";
                                                               document.getElementById("msg").innerHTML = response.messages;
                                                        }
                                                 } // /success
                                          }); // /ajax
                                   } // /if
                                   return false;
                            });
                     } // /success
              }); // /fetch selected member info
       } else {
              alert("Error : Refresh the page again");
       }
}

















































function editdelMember(id = null) {
	if(id) {

		// remove the error 
		$(".form-group").removeClass('has-error').removeClass('has-success');
		$(".text-danger").remove();
		// empty the message div
		$(".edit-messages").html("");

		// remove the id
		$("#member_id").remove();

		// fetch the member data
		$.ajax({
			url: 'php_action/getSelectedEmployee.php?emp_id=<?php echo $username; ?>',
			type: 'post',
			data: {member_id : id},
			dataType: 'json',
			success:function(response) {

				$("#sel_id_berita").val(response.id_berita);

				// mmeber id 
				$(".FormDisplayDelete").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');

				// here update the member data
				$("#updatedelMemberForm").unbind('submit').bind('submit', function() {
					// remove error messages
					$(".text-danger").remove();

					var form = $(this);

					// validation

					var sel_id_berita = $("#sel_id_berita").val();

	

					if(sel_id_berita == "") {
						$("#sel_id_berita").closest('.form-group').addClass('has-error');
						$("#sel_id_berita").after('<p class="text-danger">The Name field is required</p>');
                                   } else {
                                          $('#submit_delete').hide();
                                          $('#submit_delete2').show();
                                   }


                                   


					if(sel_id_berita) {
						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {
								if (response.code == 'success_message_delete') {

                                                               $('#submit_delete').show();
                                                               $('#submit_delete2').hide();

                                                               $('#FormDisplayDelete').modal('hide');  
                                                               $("[data-dismiss=modal]").trigger({type: "click"});      
                                                             

                                                               // reload the datatables
                                                               datatable.ajax.reload(null,false);
                                                               // reload the datatables
                                                               mymodalss.style.display = "none";
                                                               modals.style.display ="block";
                                                               document.getElementById("msg").innerHTML = response.messages;

                                                               
                                                        } else {
                                                               modals.style.display = "block";
                                                               document.getElementById("msg").innerHTML = response.messages;
                                                               // reload the datatables
                                                        }
							} // /success
						}); // /ajax
					} // /if

					return false;
				});

			} // /success
		}); // /fetch selected member info

	} else {
		alert("Error : Refresh the page again");
	}
}








































</script>
<!-- isi JSONs -->
</body>

</html>

<script>
jQuery(function($) {
       $("#nip").mask("99-9999");
       $("#nik").mask("9999999999999999");
       $("#join").mask("9999-99-99");
       $("#date").mask("9999-99-99");
       $("#account").mask("9999-9-99999-9");
});
</script>

<script type="text/javascript">
function isi_otomatis() {
       var nip = $("#nip").val();
       $.ajax({
              url: 'ajax_cek.php?emp_id=<?php echo $username; ?>',
              data: "nip=" + nip,
       }).success(function(data) {
              var json = data,
                     obj = JSON.parse(json);
              $('#nama').val(obj.nama);
              $('#nik').val(obj.nik);
              $('#org').val(obj.org);
              $('#emp').val(obj.emp);
              $('#join').val(obj.join);
              $('#account').val(obj.account);
              $('#norek').val(obj.norek);
              $('#approve').val(obj.approve);
              $('#grp').val(obj.grp);
              $('#jobstatus').val(obj.jobstatus);
       });
}
</script>



                           
<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
            <link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
            <script type="text/javascript"
                src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js">
            </script>
            <script type="text/javascript">
                     $(document).ready(function() {
                            $('#inp_birthdate').bootstrapMaterialDatePicker({
                                   time: false,
                                   clearButton: true
                            });

                            $('#inp_joindate').bootstrapMaterialDatePicker({
                                   time: false,
                                   clearButton: true
                            });

                            $('#sel_joindate').bootstrapMaterialDatePicker({
                                   time: false,
                                   clearButton: true
                            });

                            $('#inp_starttime').bootstrapMaterialDatePicker({
                                   date: false,
                                   format: 'HH:mm'
                            });

                            $('#inp_endtime').bootstrapMaterialDatePicker({
                                   date: false,
                                   format: 'HH:mm'
                            });
                     });
            </script>
                        

 <script src="js/jquery.min.js"></script>
  
 <script>
 $(document).ready(function(){
      $('#employee').focus(function(){
           var query = $(this).val();  
           if(query != '')
           {
                $.ajax({
                     url:"search.php?emp_id=<?php echo $username; ?>&userid=<?php echo $username; ?>",
                     method:"POST",
                     data:{query:query},
                     success:function(data)
                     {
                          $('#employeeList').fadeIn();
                          $('#employeeList').html(data);
                     }
                });
           }
      });
      $('#employee').keyup(function(){  
           var query = $(this).val();  
           if(query != '')  
           {  
                $.ajax({
                     url:"search.php?emp_id=<?php echo $username; ?>&userid=<?php echo $username; ?>",
                     method:"POST",
                     data:{query:query},
                     success:function(data)
                     {
                          $('#employeeList').fadeIn();
                          $('#employeeList').html(data);
                     }
                });
           }
      });
      
      $('#employee').mouseover(function(){  
           $('#employeeList').fadeOut();
      });

      $(document).on('click', 'li', function(){  
           $('#employee').val($(this).text());  
           $('#employeeList').fadeOut();

           var emps = document.getElementById("employee").value;

           var myarr = emps.split(" ");
      
           var myvar = myarr[1];
           var myvar2 = myarr[2];

       //     // Show the resulting value
           console.log(myvar2);

           
           $("#inp_careerhistory").val(myvar);
           $("#inp_empperformance").val(myvar2);




       //     alert(emps);

           $.ajax({
           url: 'php_action/getCareer.php?emp_id=<?php echo $username; ?>',
           type: 'post',
           data: {employee : emps},
           dataType: 'json',
           success:function(response_career) {

                     var fill_is_approved_spvdown = response_career.emp_no;
                     var career = response_career.history_no + '-' + response_career.secon;
                     
                     // alert(career);
              }
	    }); // /ajax

      });  
 });  
</script>


 <script>
 $(document).ready(function(){
      $('#employeeSpectator').focus(function(){
           var query = $(this).val();  
           if(query != '')
           {
                $.ajax({
                     url:"search.php?emp_id=<?php echo $username; ?>&userid=<?php echo $username; ?>",
                     method:"POST",
                     data:{query:query},
                     success:function(data)
                     {
                          $('#employeeListSpectator').fadeIn();
                          $('#employeeListSpectator').html(data);
                     }
                });
           }
      });
      $('#employeeSpectator').keyup(function(){  
           var query = $(this).val();  
           if(query != '')  
           {  
                $.ajax({
                     url:"search.php?emp_id=<?php echo $username; ?>&userid=<?php echo $username; ?>",
                     method:"POST",
                     data:{query:query},
                     success:function(data)
                     {
                          $('#employeeListSpectator').fadeIn();
                          $('#employeeListSpectator').html(data);
                     }
                });
           }
      });
      
      $('#employeeSpectator').mouseover(function(){  
           $('#employeeListSpectator').fadeOut();
      });

      $(document).on('click', 'li', function(){  
           $('#employeeSpectator').val($(this).text());  
           $('#employeeListSpectator').fadeOut();

           var emps = document.getElementById("employeeSpectator").value;

           var myarr = emps.split(" ");
      
           var myvar = myarr[1];
           var myvar2 = myarr[2];

       //     // Show the resulting value
           console.log(myvar2);

           
           $("#inp_careerhistory").val(myvar);
           $("#inp_empperformance").val(myvar2);




       //     alert(emps);

           $.ajax({
           url: 'php_action/getCareer.php?emp_id=<?php echo $username; ?>',
           type: 'post',
           data: {employee : emps},
           dataType: 'json',
           success:function(response_career) {

                     var fill_is_approved_spvdown = response_career.emp_no;
                     var career = response_career.history_no + '-' + response_career.secon;
                     
                     // alert(career);
              }
	    }); // /ajax

      });  
 });  
</script>

<!-- employeeListSpectator -->
<script src="asset/ckeditor.js"></script>
<script src="asset/js/sample.js"></script>
<script src="asset/js/sampleupdate.js"></script>
                        
    <script>
                     initSample();
                     initSampleUpdate();
              </script>
