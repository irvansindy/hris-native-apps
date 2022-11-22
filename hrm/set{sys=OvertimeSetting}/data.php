<?php  
       $src_overtimecode           = '';
       $src_minimumtime            = '';
       if (!empty($_POST['src_overtimecode']) && !empty($_POST['src_minimumtime'])) {
              $src_overtimecode    = $_POST['src_overtimecode'];
              $src_minimumtime     = $_POST['src_minimumtime'];
              $frameworks          = "?src_overtimecode="."".$src_overtimecode." &&src_minimumtime="."".$src_minimumtime."";
       } else if (empty($_POST['src_overtimecode']) && !empty($_POST['src_minimumtime'])) {
              $src_overtimecode    = $_POST['src_overtimecode'];
              $src_minimumtime     = $_POST['src_minimumtime'];
              $frameworks          = "?src_minimumtime="."".$src_minimumtime."";
       } else if (!empty($_POST['src_overtimecode']) && empty($_POST['src_minimumtime'])) {
              $src_overtimecode    = $_POST['src_overtimecode'];
              $src_minimumtime     = $_POST['src_minimumtime'];
              $frameworks          = "?src_overtimecode="."".$src_overtimecode."";
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
                                                        <div class="col-4 name">Overtime code</div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on" id="src_overtimecode"
                                                                             name="src_overtimecode" id="src_overtimecode" type="Text" value="<?php echo $src_overtimecode; ?>"
                                                                             onfocus="hlentry(this)" size="30" maxlength="50" 
                                                                             validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title="">
                                                               </div>
                                                        </div>
                                                 </div>

                                                 <div class="form-row" style="display:none">
                                                        <div class="col-4 name">Minimum time</div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on"
                                                                             name="src_minimumtime" id="src_minimumtime" type="Text" value="<?php echo $src_minimumtime; ?>"
                                                                             onfocus="hlentry(this)" size="30" maxlength="50" 
                                                                             validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title="">
                                                               </div>
                                                        </div>
                                                 </div>
                                          </fieldset>
                                          <button type="submit" name="submit_add" id="submit_add" type="button" class="btn btn-warning button_bot">
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
              "ajax": "php_action/FuncDataRead.php<?php echo $frameworks; ?>"
       });
});
</script>




<div class="col-md-12">
       <div class="card">
              <div class="card-header d-flex align-items-center">
                     <h4 class="card-title mb-0">Overtime Setting </h4>


                     <div class="card-actions ml-auto">
                            <table>

                                   <td>
                                          <form action="../rfid=repository/cli_Template_Download/st/StFunctionDownload.php" method="GET">
                                                 <input type="hidden" name="filedata" value="StDownloadGTTGROvertimeSettingData.php">
                                                 <input type="hidden" name="filename" value="Overtime Setting">
                                                 <input type="hidden" name="src_overtimecode" value="<?php echo $src_overtimecode; ?>">
                                                 <input type="hidden" name="src_minimumtime" value="<?php echo $src_minimumtime; ?>">
                                                 <button type="submit" class="toolbar sprite-toolbar-excel" id="EXCEL" style="border: 0;background-color: white;" name="submit_approve" value="submit"></button>
                                          </form>

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
                                   <!-- AgusPrass 02/03/2021 -->

                                   <td>
                                          <div class="toolbar sprite-toolbar-add" title="Add" data-toggle="modal"
                                                 data-target="#CreateForm" id="CreateButton" data-keyboard="false"
                                                 data-backdrop="static">
                                                 <!-- <a title="add" href="" class="toolbar sprite-toolbar-add" data-toggle="modal" data-target="#CreateForm" id="CreateButton" data-keyboard="false" data-backdrop="static">tambah</a> -->
                                          </div>
                                   </td>

                            </table>

                          

                     </div>
              </div>

              <div class="card-body table-responsive p-0"
                     style="width: 100vw;height: 78vh; width: 99.1%; margin: 5px;overflow: scroll;">
                     <table id="datatable" width="100%" border="1" align="left"
                            class="table table-bordered table-striped table-hover table-head-fixed">
                            <thead>
                                   <tr>
                                          <th class="fontCustom"
                                                 style="z-index: 1;vertical-align: ce;vertical-align: middle;"
                                                 nowrap="nowrap">No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                          <th class="fontCustom"
                                                 style="z-index: 1;vertical-align: ce;vertical-align: middle;">
                                                 Overtime Code&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                          <th class="fontCustom"
                                                 style="z-index: 1;vertical-align: ce;vertical-align: middle;">Minimum Time&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          </th>
                                          <th class="fontCustom"
                                                 style="z-index: 1;vertical-align: ce;vertical-align: middle;">Overtime Calculation
                                          </th>
                                          <th class="fontCustom"
                                                 style="z-index: 1;vertical-align: ce;vertical-align: middle;">Overtime
                                                 Rounding (Minutes)</th>
                                          <th class="fontCustom"
                                                 style="z-index: 1;vertical-align: ce;vertical-align: middle;">Overtime
                                                 Round Limit (Minutes)
                                          </th>
                                          <th class="fontCustom"
                                                 style="z-index: 1;vertical-align: ce;vertical-align: middle;">Factor
                                                 Setting
                                          </th>
                                          <th class="fontCustom"
                                                 style="z-index: 1;vertical-align: ce;vertical-align: middle;">Factor
                                                 Action
                                          </th>
                                          <!-- <th class="fontCustom" style="z-index: 1;vertical-align: ce;vertical-align: middle;">Grade</th>
                                    
                                          <th class="fontCustom" style="z-index: 1;vertical-align: ce;vertical-align: middle;">Join Date</th>
                                                                <th class="fontCustom" style="z-index: 1;vertical-align: ce;vertical-align: middle;">Employment Code</th> -->
                                   </tr>
                            </thead>
                     </table>

              </div>

              <div class='card-footer' style='background-color: #eee;height: 37px;padding-top: 5px;'>



              </div>

       </div>
</div>











<!-- add modal -->
<div class="modal  fade fade-custom" tabindex="-1" role="dialog" id="CreateForm">
       <div class="modal-dialog modal-belakang modal-bg" role="document">
              <div class="modal-content">
                     <div class="modal-header">
                            <h4 class="modal-title">Add Overtime Setting</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 99%; margin: 5px;overflow: scroll;overflow-x: hidden;">
                     
                     <form class="form-horizontal" action="php_action/FuncDataCreate.php" method="POST"
                            id="FormDisplayCreate">

                            <fieldset id="fset_1">
                                   <legend>General</legend>

                                   <div class="messages_create"></div>

                                   <input id="inp_emp_no" name="inp_emp_no" type="hidden" value="<?php echo $username; ?>"><!--FROM SESSION -->
                                   <input id="inp_token" name="inp_token" type="hidden" value="<?php echo $get_token; ?>"><!--FROM CONFIGURATION -->

                                   <div class="form-row">
                                          <div class="col-4 name">Overtime Code <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                 <p id="demo"></p>

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="inp_overtime_code" name="inp_overtime_code"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;width: 60%;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Minimum Time <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="inp_overtime_minimum" name="inp_overtime_minimum"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;width: 30%;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Overtime Calculation <span class="required">*</span>
                                          </div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">
                                                        <select id="inp_ovtcalctype" class="input--style-6"
                                                               name="inp_ovtcalctype" onfocus="hlentry(this)"
                                                               onchange="formodified(this);"
                                                               style="width:undefined;height: 33px;width: 45%;">
                                                               <option value="">--Select One--</option>
                                                               <option value="SEPARATED">Separated Calculation</option>
                                                               <option value="SUMMARIZE">Summarize Calculation</option>
                                                        </select>
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name">Overtime Rounding <span class="required">*</span>
                                          </div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">
                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="inp_otrounding" name="inp_otrounding" type="Text"
                                                               value="" onfocus="hlentry(this)" size="30" maxlength="50"
                                                               style="text-transform:uppercase;width: 30%;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Overtime Round Limit <span class="required">*</span>
                                          </div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">
                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="inp_otroundlimit" name="inp_otroundlimit" type="Text"
                                                               value="" onfocus="hlentry(this)" size="30" maxlength="50"
                                                               style="text-transform:uppercase;width: 30%;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Every Overtime Achieved </div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">
                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="inp_otachieved" name="inp_otachieved" type="Text"
                                                               value="" onfocus="hlentry(this)" size="30" maxlength="50"
                                                               style="text-transform:uppercase;width: 30%;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Deducted by </div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">
                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="lbl_inp_otdeucted" name="lbl_inp_otdeucted"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;width: 30%;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Factor Setting </div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                 <div class="card-body table-responsive p-0" style="width: 88%; margin: 1px;overflow: scroll;">
                                                        
                                                        <table class="table table-bordered table-striped table-hover table-head-fixed" id="tbl_posts">
                                                               <thead>
                                                                      <tr>
                                                                             <th>No.</th>
                                                                             <th>Per Hour</th>
                                                                             <th>Value</th>
                                                                             <th><a class=" add-record" style="margin-right: 7px;" data-added="0"><img src="../../asset/img/icons/acssadd.png"></a></th>
                                                                      </tr>
                                                               </thead>
                                                               <tbody id="tbl_posts_body">
                                                                      <tr id="rec-1">
                                                                             <td><span class="sn">1</span>.</td>
                                                                             <td><input type="text" value="" name="FactorHour[]"></td>
                                                                             <td><input type="text" value="" name="FactorValue[]"></td>
                                                                             <td><a class="delete-record" data-added="0"><img src="../../asset/img/icons/minus.png"></a></td>
                                                                      </tr>
                                                               </tbody>
                                                        </table>
                                                        <div style="display:none;">
                                                               <table id="sample_table"
                                                                      class="table table-bordered table-striped table-hover table-head-fixed">
                                                                      <tr id="" class="reset-delete-record">
                                                                             <td><span class="sn"></span>.</td>
                                                                             <td><input type="text" value="" name="FactorHour[]"></td>
                                                                             <td><input type="text" value="" name="FactorValue[]"></td>
                                                                             <td><a class="delete-record" data-added="0"><img src="../../asset/img/icons/minus.png"></a></td>
                                                                      </tr>
                                                               </table>
                                                        </div>
                                                        </div>
                                                 </div>
                                          </div>
                                   </div>
                                   <br>
                                   
                            </fieldset>

                            <fieldset id="fset_1">
                                   <legend>Other Overtime Setting</legend>

                                   <div class="card-body table-responsive p-0" style="width: 99%; margin: 1px;overflow: scroll;">

                                          <table class="table table-bordered table-striped table-hover table-head-fixed" id="tbl_posts_second">
                                                 <thead>
                                                        <tr>
                                                               <th>No.</th>
                                                               <th >Overtime Other Type</th>
                                                               <th>Minute(s)</th>
                                                               <th>Meal</th>
                                                               <th>Transport</th>
                                                               <th><a class="add-record_second" style="margin-right: 7px;" data-added="0"><img src="../../asset/img/icons/acssadd.png"></a></th>
                                                        </tr>
                                                 </thead>
                                                 <tbody id="tbl_posts_body_second">
                                                        <tr id="recs-1">
                                                               <td><span class="sn">1</span>.</td>
                                                               <td><select id="OTtypeother" class=""
                                                                             name="OTtypeother[]" onfocus="hlentry(this)"
                                                                             onchange="formodified(this);"
                                                                             style="width:undefined;width: 160px;border: 1px solid #cac2c2;text-align: center;color: #484545;">
                                                                             <option value="">--Select One--</option>
                                                                             <option value="OTMEAL">OTMEAL</option>
                                                                             <option value="OTTRANSPORT">OTTRANSPORT</option>
                                                                      </select></td>
                                                               <td><input type="text" value="" name="OTminutes[]"></td>
                                                               <td><input type="text" value="" name="OTmeal[]"></td>
                                                               <td><input type="text" value="" name="OTtransport[]"></td>
                                                               <td><a class="delete-record_second" data-added="0"><img src="../../asset/img/icons/minus.png"></a></td>
                                                        </tr>
                                                 </tbody>
                                          </table>
                                          <div style="display:none;">
                                                 <table id="sample_table_second"
                                                        class="table table-bordered table-striped table-hover table-head-fixed">
                                                        <tr id="" class="reset-delete-record">
                                                               <td><span class="sn"></span>.</td>
                                                               <td><select id="OTtypeother" class=""
                                                                             name="OTtypeother[]" onfocus="hlentry(this)"
                                                                             onchange="formodified(this);"
                                                                             style="width:undefined;width: 160px;border: 1px solid #cac2c2;text-align: center;color: #484545;">
                                                                             <option value="">--Select One--</option>
                                                                             <option value="OTMEAL">OTMEAL</option>
                                                                             <option value="OTTRANSPORT">OTTRANSPORT</option>
                                                                      </select></td>
                                                               <td><input type="text" value="" name="OTminutes[]"></td>
                                                               <td><input type="text" value="" name="OTmeal[]"></td>
                                                               <td><input type="text" value="" name="OTtransport[]"></td>
                                                               <td><a class="delete-record_second" data-added="0"><img src="../../asset/img/icons/minus.png"></a></td>
                                                        </tr>
                                                 </table>
                                          </div>
                                   </div>
                            </fieldset>
                            </div>
                            <div class="modal-footer">
                                   <button type="reset" class="btn btn-primary1" data-dismiss="modal" onclick="ResetTable();"
                                          aria-hidden="true">
                                          &nbsp;Cancel&nbsp;
                                   </button>
                                   <button class="btn btn-warning" type="submit" name="submit_add" id="submit_add">
                                          Confirm
                                   </button>
                                   <button class="btn btn-warning" type="button" name="submit_add2"
                                          id="submit_add2" style='display:none;' disabled>
                                          <span class="spinner-grow spinner-grow-sm" role="status"
                                                 aria-hidden="true"></span>
                                          &nbsp;&nbsp;Processing..
                                   </button>
                            </div>
                  

                     <script type="text/javascript">
                     $(document).ready(function() {
                            jQuery(document).delegate('a.add-record', 'click', function(e) {
                                   e.preventDefault();
                                   var content = jQuery('#sample_table tr'),
                                          size = jQuery('#tbl_posts >tbody >tr').length + 1,
                                          element = null,
                                          element = content.clone();
                                   element.attr('id', 'rec-' + size);
                                   element.find('.delete-record').attr('data-id', size);
                                   element.appendTo('#tbl_posts_body');
                                   element.find('.sn').html(size);
                            });
                            jQuery(document).delegate('a.delete-record', 'click', function(e) {
                                   e.preventDefault();
                     
                                          var id = jQuery(this).attr('data-id');
                                          var targetDiv = jQuery(this).attr('targetDiv');
                                          jQuery('#rec-' + id).remove();

                                          //regnerate index number on table
                                          $('#tbl_posts_body tr').each(function(index) {
                                                 $(this).find('span.sn').html(index + 1);
                                          });
                                          return true;
                                  
                            });
                     });
                     </script>
                     <script type="text/javascript">
                     $(document).ready(function() {
                            jQuery(document).delegate('a.add-record_second', 'click', function(e) {
                                   e.preventDefault();
                                   var content = jQuery('#sample_table_second tr'),
                                          size = jQuery('#tbl_posts_second >tbody >tr').length + 1,
                                          element = null,
                                          element = content.clone();
                                   element.attr('id', 'recs-' + size);
                                   element.find('.delete-record_second').attr('data-id', size);
                                   element.appendTo('#tbl_posts_body_second');
                                   element.find('.sn').html(size);
                            });
                            jQuery(document).delegate('a.delete-record_second', 'click', function(e) {
                                   e.preventDefault();
                  
                  
                                          var id = jQuery(this).attr('data-id');
                                          var targetDiv = jQuery(this).attr('targetDiv');
                                          jQuery('#recs-' + id).remove();

                                          //regnerate index number on table
                                          $('#tbl_posts_body_second tr').each(function(index) {
                                                 $(this).find('span.sn').html(index + 1);
                                          });
                                          return true;
                                  
                            });
                     });
                     </script>

                    
                     </form>
              </div>
       </div>
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /edit modal -->













































<!-- edit modal -->
<div class="modal  fade fade-custom" tabindex="-1" role="dialog" id="UpdateForm">
       <div class="modal-dialog modal-belakang modal-bg" role="document">

              <div class="modal-content">
                     <div class="modal-header">
                            <h4 class="modal-title">Edit Overtime Setting</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 99%; margin: 5px;overflow: scroll;overflow-x: hidden;">

                     <!-- <form class="form-horizontal" action="php_action/FuncDataUpdate.php" method="POST" id="updateMemberForm"> -->
                     <form class="form-horizontal" action="php_action/FuncDataUpdate.php" method="POST" id="FormDisplayUpdate">

                            <fieldset id="fset_1">
                                   <legend>General</legend>
                                   

                                   <div class="messages_update"></div>

                                   <input id="sel_emp_no" name="sel_emp_no" type="hidden" value="<?php echo $username; ?>"><!--FROM SESSION -->
                                   <input id="sel_token" name="sel_token" type="hidden" value="<?php echo $get_token; ?>"><!--FROM CONFIGURATION -->

                                   <div class="form-row">
                                          <div class="col-4 name">Overtime Code <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group" id="sel_identity">
                                                 </div>
                                          </div>
                                   </div>
                                   
                                   <div class="form-row" style="display:none">
                                          <div class="col-4 name">Overtime Code <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">
                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_overtime_code" name="sel_overtime_code"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;width: 60%;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>
                      
                                   <div class="form-row">
                                          <div class="col-4 name">Minimum Time <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_overtime_minimum" name="sel_overtime_minimum"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;width: 30%;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name">Overtime Calculation <span class="required">*</span>
                                          </div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">
                                                        <select id="sel_ovtcalctype" class="input--style-6"
                                                               name="sel_ovtcalctype" onfocus="hlentry(this)"
                                                               onchange="formodified(this);"
                                                               style="width:undefined;height: 33px;width: 45%;">
                                                               <option value="">--Select One--</option>
                                                               <option value="SEPARATED">Separated Calculation</option>
                                                               <option value="SUMMARIZE">Summarize Calculation</option>
                                                        </select>
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name">Overtime Rounding <span class="required">*</span>
                                          </div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_otrounding" name="sel_otrounding" type="Text"
                                                               value="" onfocus="hlentry(this)" size="30" maxlength="50"
                                                               style="text-transform:uppercase;width: 30%;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Overtime Round Limit <span class="required">*</span>
                                          </div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">
                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_otroundlimit" name="sel_otroundlimit" type="Text"
                                                               value="" onfocus="hlentry(this)" size="30" maxlength="50"
                                                               style="text-transform:uppercase;width: 30%;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Every Overtime Achieved </div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_otachieved" name="sel_otachieved" type="Text"
                                                               value="" onfocus="hlentry(this)" size="30" maxlength="50"
                                                               style="text-transform:uppercase;width: 30%;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Deducted by </div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="lbl_sel_otdeucted" name="lbl_sel_otdeucted"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;width: 30%;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Factor Setting </div>
                                          <div class="col-sm-8">
                                                 <div class="card-body table-responsive p-0" style="width: 99%; margin: 1px;overflow: scroll;">
                                                        <!-- pages relation -->
                                                        <div id="box"></div>
                                                        <!-- pages relation -->
                                                 <div>
                                          </div>
                                   </div>
                                   <br>
                                
                            </fieldset>

                            <fieldset id="fset_1">
                                   
                                   <legend>Other Overtime Setting</legend>
                                          <div class="card-body table-responsive p-0" style="width: 99%; margin: 1px;overflow: scroll;">
                                                 <!-- pages relation -->
                                                 <div id="box2"></div>
                                                 <!-- pages relation -->
                                          <div>
                            </fieldset>
                     </div>
   
              <!-- END SCROLLING -->

                            <div class="modal-footer">
                                   <button type="reset" class="btn btn-primary1" data-dismiss="modal"
                                          aria-hidden="true">
                                          &nbsp;Cancel&nbsp;
                                   </button>
                                 
                                   <button class="btn btn-warning" type="submit" name="submit_update" id="submit_update">
                                          Confirm
                                   </button>
                                   <button class="btn btn-warning" type="button" name="submit_update2"
                                          id="submit_update2" style='display:none;' disabled>
                                          <span class="spinner-grow spinner-grow-sm" role="status"
                                                 aria-hidden="true"></span>
                                          &nbsp;&nbsp;Processing..
                                   </button>
                            </div>
                  

                     <script type="text/javascript">
                     $(document).ready(function() {
                            jQuery(document).delegate('a.add-record_third', 'click', function(e) {
                                   e.preventDefault();
                                   var content = jQuery('#sample_table_third tr'),
                                          size = jQuery('#tbl_posts_third >tbody >tr').length + 1,
                                          element = null,
                                          element = content.clone();
                                   element.attr('id', 'recthird-' + size);
                                   element.find('.delete-record_third').attr('data-id', size);
                                   element.appendTo('#tbl_posts_body_third');
                                   element.find('.sn').html(size);
                            });
                            jQuery(document).delegate('a.delete-record_third', 'click', function(e) {
                                   e.preventDefault();
                                 
                                          var id = jQuery(this).attr('data-id');
                                          var targetDiv = jQuery(this).attr('targetDiv');
                                          jQuery('#recthird-' + id).remove();

                                          //regnerate index number on table
                                          $('#tbl_posts_body_third tr').each(function(index) {
                                                 $(this).find('span.sn').html(index + 1);
                                          });
                                          return true;
                                 
                            });
                     });
                     </script>
                     <script type="text/javascript">
                     $(document).ready(function() {
                            jQuery(document).delegate('a.add-record_four', 'click', function(e) {
                                   e.preventDefault();
                                   var content = jQuery('#sample_table_four tr'),
                                          size = jQuery('#tbl_posts_four >tbody >tr').length + 1,
                                          element = null,
                                          element = content.clone();
                                   element.attr('id', 'recfour-' + size);
                                   element.find('.delete-record_four').attr('data-id', size);
                                   element.appendTo('#tbl_posts_body_four');
                                   element.find('.sn').html(size);
                            });
                            jQuery(document).delegate('a.delete-record_four', 'click', function(e) {
                                   e.preventDefault();
                                
                                          var id = jQuery(this).attr('data-id');
                                          var targetDiv = jQuery(this).attr('targetDiv');
                                          jQuery('#recfour-' + id).remove();

                                          //regnerate index number on table
                                          $('#tbl_posts_body_four tr').each(function(index) {
                                                 $(this).find('span.sn').html(index + 1);
                                          });
                                          return true;
                                  
                            });
                     });
                     </script>

                    
                     </form>

                     
              </div>

              </form>
       </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /edit modal -->




























	<!-- delete transaction modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="FormDisplayDelete">
	  <div class="modal-dialog" style="width: 25%;">
	    <div class="modal-content">
		<form class="form-horizontal" action="php_action/FuncDataDelete.php" method="POST" id="updatedelMemberForm">	      

		<div class="modal-body">      	
		  <div class="edit-messages"></div>
		  <table width="100%">
                     <tr><td align="center"><img src="../../asset/dist/img/sf-mola-mola.png" style="max-width: 90%;margin-top: 20px;"></td></tr>
                   
                     </table>
                     <div class="form-group">
                            <div class="col-sm-12">	
                                          <table width="100%"><td align="center"><label id="isi">Are you sure to delete data ?</label></td></table>		
                                          <input type="hidden" class="form-control input-report" id="sel_overtime_codes" name="sel_overtime_codes" placeholder="Nip">
                            </div>
                     </div>


				
				<!-- <div class="modal-footer-delete FormDisplayDelete" style="text-align: center;padding-top: 20px;">
                                          <button type="reset" class="btn btn-primary1" style="background: #ececec;" data-dismiss="modal" aria-hidden="true">
                                                        &nbsp;Cancel&nbsp;
                                          </button>
                                          <button class="btn btn-warning" type="submit"  aria-hidden="true"  id="removeBtn">
                                          Confirm
                                          </button>
					</div>
				</div> -->

                            <div class="modal-footer-delete FormDisplayDelete" style="text-align: center;padding-top: 20px;">
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

                     var inp_overtime_code = $("#inp_overtime_code").val();
                     var inp_overtime_minimum = $("#inp_overtime_minimum").val();
                     var inp_ovtcalctype = $("#inp_ovtcalctype").val();
                     var inp_otrounding = $("#inp_otrounding").val();
                     var inp_otroundlimit = $("#inp_otroundlimit").val();
                     var inp_otachieved = $("#inp_otachieved").val();
                     var lbl_inp_otdeucted = $("#lbl_inp_otdeucted").val();
                     var inp_emp_no = $("#inp_emp_no").val();
                     var inp_token = $("#inp_token").val();
                     var FactorHour = [];
                     var FactorValue = [];
                     var OTtypeother = [];
                     var OTminutes = [];
                     var OTmeal = [];
                     var OTtransport = [];

                     var regex=/^[a-zA-Z]+$/;
                  
                     if (inp_overtime_code == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Overtime code cannot empty";

                     } else if (inp_overtime_minimum == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Overtime minimum cannot empty";

                     } else if (inp_overtime_minimum.match(regex)) {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Please enter valid number";

                     } else if (inp_ovtcalctype == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Overtime calctype";

                     } else if (inp_otrounding == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Overtime rounding";

                     } else if (inp_otroundlimit == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Overtime rounding limit";

                     } else {
                            $('#submit_add').hide();
                            $('#submit_add2').show();
                     }

                     if (inp_overtime_code && inp_overtime_minimum && inp_ovtcalctype && inp_otrounding && inp_otroundlimit) {

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
                                                 modals.style.display ="block";
                                                 document.getElementById("msg").innerHTML = response.messages;

                                                 // // empty table
                                                 // $("#tbl_posts").empty();

                                                 // // clear head
                                                 // $("#tbl_posts  thead").remove();

                                                 // // clear body
                                                 // $("#tbl_posts  tbody").remove();
                                                 $("#tbl_posts_second > tbody > .reset-delete-record").html("");
                                                 $("#tbl_posts > tbody > .reset-delete-record").html("");

                                                 $('#submit_add').show();
                                                 $('#submit_add2').hide();

                                                 $('#FormDisplayCreate').modal('hide');  
                                                 $("[data-dismiss=modal]").trigger({type: "click"});   

                                                 // reset the form
                                                 $("#FormDisplayCreate")[0].reset();
                                                 // reload the datatables
                                                 datatable.ajax.reload(null,false);
                                                 // this function is built in function of datatables;
                                          } else {
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
                     url: 'php_action/getSelectedEmployee.php',
                     type: 'post',
                     data: {
                            member_id: id
                     },
                     dataType: 'json',


                     success: function(response) {
                            document.getElementById("sel_identity").innerHTML = response.overtime_code;

                            $("#sel_overtime_code").val(response.overtime_code);
                            $("#sel_overtime_minimum").val(response.overtime_minimum);
                            $("#sel_ovtcalctype") .val(response.ovtcalctype);
                            $("#sel_otrounding").val(response.otrounding);
                            $("#sel_otroundlimit").val(response.otroundlimit);
                            $("#sel_otachieved").val(response.nsd);
                            $("#lbl_sel_otdeucted").val(response.otdeducthour);
                            $("#sel_ovtcalctype").val(response.ovtcalctype);
                            $("#sel_emp_no").val(response.emp_no);
                            $("#sel_token").val(response.token);

                            var sel_overtime_code       = response.overtime_code;

                                   $("#box").load("pages_relation/_pages_factor_overtime?rfid=" + sel_overtime_code, 
                                   function(responseTxt, statusTxt, jqXHR){
                                                 if(statusTxt == "success"){
                                                        $("#box").show();
                                                 }
                                                 if(statusTxt == "error"){
                                                        alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                                 }
                                          }
                                   );

                                   $("#box2").load("pages_relation/_pages_factor_setting.php?rfid=" + sel_overtime_code, 
                                   function(responseTxt, statusTxt, jqXHR){
                                                 if(statusTxt == "success"){
                                                        $("#box").show();
                                                 }
                                                 if(statusTxt == "error"){
                                                        alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                                 }
                                          }
                                   );

                            


                            // here update the member data
                            $("#FormDisplayUpdate").unbind('submit').bind('submit', function() {
                                   // remove error messages
                                   $(".text-danger").remove();

                                   var form = $(this);

                                   var sel_overtime_code       = $("#sel_overtime_code").val();
                                   var sel_overtime_minimum    = $("#sel_overtime_minimum").val();
                                   var sel_ovtcalctype         = $("#sel_ovtcalctype").val();
                                   var sel_otrounding          = $("#sel_otrounding").val();
                                   var sel_otroundlimit        = $("#sel_otroundlimit").val();
                                   var sel_otachieved          = $("#sel_otachieved").val();
                                   var lbl_sel_otdeucted       = $("#lbl_sel_otdeucted").val();
                                   var sel_ovtcalctype         = $("#sel_ovtcalctype").val();
                                   var sel_emp_no              = $("#sel_emp_no").val();
                                   var sel_token               = $("#sel_token").val();
                                   var FactorHour = [];
                                   var FactorValue = [];

                                   var SelOTtypeother = [];
                                   var SelOTminutes = [];
                                   var SelOTmeal = [];
                                   var SelOTtransport = [];
         
                                   var regex=/^[a-zA-Z]+$/;

                                   if (sel_overtime_code == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "Overtime code cannot empty";

                                   } else if (sel_overtime_minimum == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "Overtime minimum cannot empty";

                                   } else if (sel_overtime_minimum.match(regex)) {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "Please enter valid number";

                                   } else if (sel_ovtcalctype == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "Overtime calctype";

                                   } else if (sel_otrounding == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "Overtime rounding";

                                   } else if (sel_otroundlimit == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "Overtime rounding limit";


                                   } else {
                                          $('#submit_update').hide();
                                          $('#submit_update2').show();
                                   }




                                   if (sel_overtime_code && sel_overtime_minimum && sel_ovtcalctype && sel_otrounding && sel_otroundlimit) {

                                          $.ajax({
                                                 
                                                 url: form.attr('action'),
                                                 type: form.attr('method'),
                                                 // data: form.serialize(),

                                                 data: new FormData(this),
                                                 processData: false,
                                                 contentType: false,

                                                 dataType: 'json',
                                                 success: function(response) {

                                                        if (response.code =='success_message') {
                                                               modals.style.display = "block";
                                                               document.getElementById("msg").innerHTML =response.messages;

                                                               $("#tbl_posts_third > tbody > .reset-delete-record").html("");
                                                               $("#tbl_posts_four > tbody > .reset-delete-record").html("");

                                                               $('#submit_update').show();
                                                               $('#submit_update2').hide();

                                                               $('#FormDisplayUpdate').modal('hide');  
                                                               $("[data-dismiss=modal]").trigger({type: "click"});      
                                                        
                                                               // reload the datatables
                                                               datatable.ajax.reload(null,false);
                                                               // reload the datatables
                                                               
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
			url: 'php_action/getSelectedEmployee.php',
			type: 'post',
			data: {member_id : id},
			dataType: 'json',
			success:function(response) {

				$("#sel_overtime_codes").val(response.overtime_code);

				// mmeber id 
				$(".FormDisplayDelete").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');

				// here update the member data
				$("#updatedelMemberForm").unbind('submit').bind('submit', function() {
					// remove error messages
					$(".text-danger").remove();

					var form = $(this);

					// validation

					var sel_overtime_codes = $("#sel_overtime_codes").val();

	

					if(sel_overtime_codes == "") {
						$("#sel_overtime_codes").closest('.form-group').addClass('has-error');
						$("#sel_overtime_codes").after('<p class="text-danger">The Name field is required</p>');
                                   } else {
                                          $('#submit_delete').hide();
                                          $('#submit_delete2').show();
                                   }


                                   


					if(sel_overtime_codes) {
						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {
								if (response.code == 'success_message') {
                                                               modals.style.display = "block";
                                                               document.getElementById("msg").innerHTML = response.messages;

                                                               $('#submit_delete').show();
                                                               $('#submit_delete2').hide();

                                                               $('#FormDisplayDelete').modal('hide');  
                                                               $("[data-dismiss=modal]").trigger({type: "click"});      
                                                             

                                                               // reload the datatables
                                                               datatable.ajax.reload(null,false);
                                                               // reload the datatables
                                                               
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
              url: 'ajax_cek.php',
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



                           
      
                        
