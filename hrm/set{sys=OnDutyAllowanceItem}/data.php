<?php  
       $src_item_code                   = '';
       $src_item_name_en                = '';
       if (!empty($_POST['src_item_code']) && !empty($_POST['src_item_name_en'])) {
              $src_item_code            = $_POST['src_item_code'];
              $src_item_name_en         = $_POST['src_item_name_en'];
              $frameworks                   = "?src_item_code="."".$src_item_code."&src_item_name_en="."".$src_item_name_en."";
       } else if (empty($_POST['src_item_code']) && !empty($_POST['src_item_name_en'])) {
              $src_item_code            = $_POST['src_item_code'];
              $src_item_name_en         = $_POST['src_item_name_en'];
              $frameworks                   = "?src_item_name_en="."".$src_item_name_en."";
       } else if (!empty($_POST['src_item_code']) && empty($_POST['src_item_name_en'])) {
              $src_item_code            = $_POST['src_item_code'];
              $src_item_name_en         = $_POST['src_item_name_en'];
              $frameworks                   = "?src_item_code="."".$src_item_code."";
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
                                                        <div class="col-4 name">Allowance Item code </div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on" id="src_item_code"
                                                                             name="src_item_code" id="src_item_code" type="Text" value="<?php echo $src_item_code; ?>"
                                                                             onfocus="hlentry(this)" size="30" maxlength="50" 
                                                                             validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title="">
                                                               </div>
                                                        </div>
                                                 </div>

                                                 <div class="form-row">
                                                        <div class="col-4 name">Allowance Item name </div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on"
                                                                             name="src_item_name_en" id="src_item_name_en" type="Text" value="<?php echo $src_item_name_en; ?>"
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
                     <h4 class="card-title mb-0">On Duty Allowance Item Setting </h4>
                     <div class="card-actions ml-auto">
                            <table>
                                   <td>
                                          <form action="../rfid=repository/cli_Template_Download/st/StFunctionDownload.php" method="GET">
                                                 <input type="hidden" name="filedata" value="StDownloadGTTGROndtAllowanceItemData.php">
                                                 <input type="hidden" name="filename" value="OndtAllowanceItem">
                                                 <input type="hidden" name="src_item_code" value="<?php echo $src_item_code; ?>">
                                                 <input type="hidden" name="src_item_name_en" value="<?php echo $src_item_name_en; ?>">
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

              <div class="card-body table-responsive p-0" style="width: 100vw;height: 78vh; width: 99%; margin: 5px;overflow: scroll;">
                     <table id="datatable" width="99%" border="1"
                            class="table table-bordered table-striped table-hover table-head-fixed">
                            <thead>
                                   <tr>
                                          <th class="fontCustom"
                                                 style="z-index: 1;vertical-align: ce;vertical-align: middle;"
                                                 nowrap="nowrap">No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                          <th class="fontCustom"
                                          style="z-index: 1; vertical-align: middle; width: 100px;">
                                                 Item Code&nbsp;&nbsp;&nbsp;</th>
                                          <th class="fontCustom"
                                                 style="z-index:1;vertical-align: ce;vertical-align: middle;">Item Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          </th>
                                          <th class="fontCustom"
                                                 style="z-index:1;vertical-align: ce;vertical-align: middle;">Category&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          </th>
                                          <th class="fontCustom"
                                                 style="z-index:1;vertical-align: ce;vertical-align: middle;">Purpose Type&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          </th>
                                          <th class="fontCustom"
                                                 style="z-index:1;vertical-align: ce;vertical-align: middle;">Type&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          </th>
                                          <th class="fontCustom"
                                                 style="z-index:1;vertical-align: ce;vertical-align: middle;">Currency&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          </th>
                                          <th class="fontCustom"
                                                 style="z-index: 1;vertical-align: ce;vertical-align: middle;">
                                                 Action&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
                            <h4 class="modal-title">Add On Duty Allowance Item</h4>
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
                                          <div class="col-4 name">Code <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="inp_item_code" name="inp_item_code"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="width: 60%;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name">Name <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="inp_item_name_en" name="inp_item_name_en"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="width: 60%;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                        <img src="../../asset/img/icons/flag_en.png">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name"></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="inp_item_name_id" name="inp_item_name_id"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="width: 60%;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                        <img src="../../asset/img/icons/flag_id.png">
                                                 </div>
                                          </div>
                                   </div>
                                   
                                   <div class="form-row">
                                          <div class="col-4 name">Type <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <select id="inp_type" class="input--style-6"
                                                                      name="inp_type" onfocus="hlentry(this)"
                                                                      onchange="formodified(this);"
                                                                      style="width:undefined;height: 33px;width: 45%;">
                                                                      <option value="">--Select One--</option>
                                                                      <option value="Daily">Daily</option>
                                                                      <option value="Total">Total</option>
                                                               </select>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Currency <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                 <select id="inp_currency_code" class="input--style-6" name="inp_currency_code" onfocus="hlentry(this)" onchange="formodified(this);" style="width:undefined;height: 33px;width: 45%;">
                                                               <option value="">--Select One--</option>
                                                               <?php
                                                               $sql = mysqli_query($connect, "SELECT currency_code FROM tgemcurrency");
                                                               $row = mysqli_num_rows($sql);
                                                               while ($row = mysqli_fetch_array($sql)){
                                                               echo "<option value='". $row['currency_code'] ."'>" .$row['currency_code'] ."</option>" ;
                                                               }
                                                               ?>
                                                        </select>
                                                       
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name">Allowance Category <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">
                                                        <select id="inp_category_name_en" class="input--style-6" name="inp_category_name_en" onfocus="hlentry(this)" onchange="formodified(this);" style="width:undefined;height: 33px;width: 45%;">
                                                               <option value="">--Select One--</option>
                                                               <?php
                                                               $sql = mysqli_query($connect, "SELECT category_code,category_name_en FROM hrmondutyallowcat");
                                                               $row = mysqli_num_rows($sql);
                                                               while ($row = mysqli_fetch_array($sql)){
                                                               echo "<option value='". $row['category_code'] ."'>" .$row['category_name_en'] ."</option>" ;
                                                               }
                                                               ?>
                                                        </select>
                                                       
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name">Purpose Type </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-sm-12">
                                                 <div class="input-group">
                                                 <link rel="stylesheet" href="../../asset/gt_developer/asset_use/jquery.tree-multiselect.min.css">
                                                 <script src="../../asset/gt_developer/asset_use/jquery-ui.min.js"></script>
                                                 <script src="../../asset/gt_developer/asset_use/jquery.tree-multiselect.js"></script>
                                                 <?php
                                                 $modal=mysqli_query($connect, "SELECT a.* FROM hrmondutypurposetype a");
                                                 ?>
                                                 <select id="test-select-4" multiple="multiple" class="framework" id="inp_purposed_code" name="inp_purposed_code[]" >
                                                        <?php if (mysqli_num_rows($modal) > 0) { ?>
                                                               <?php while ($row = mysqli_fetch_array($modal)) { ?>
                                                                      <option value="<?php echo $row['purpose_code'] ?>"
                                                                      data-section="purpose"
                                                                      data-index="1"><?php echo $row['purpose_name_en'] ?></option>
                                                               <?php } ?>
                                                        <?php } ?>
                                                 </select>
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name">Formula <span class="required">*</span></div>
                                          <div class="col-sm-7">
                                                 <div class="input-group">

                                                 <textarea class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="inp_formula" name="inp_formula"
                                                               type="Text" onfocus="hlentry(this)" size="30"
                                                               height="200"
                                                               style="width: 100%;"
                                                               v
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title=""></textarea>
                                                       
                                                 </div>
                                          </div>
                                          <div class="col-sm-1">
                                                 <div class="input-group">
                                                        <img  onclick="SelectName()" src="../../asset/dist/img/suggest.png" style="cursor: pointer;">
                                                 </div>
                                          </div>
                                   </div>

                                
					
    
                                                 <script type="text/javascript">
                                                 var popup;
                                                 function SelectName() {
                                                        var x = document.getElementById("inp_formula").value; 
                                                               
                                                        popup = window.open("Popup.php?id=" + x , "Popup", "width=510,height=300");
                                                        popup.focus();
                                                        return false
                                                 }
                                                 </script>

                                 
                                 

                            </div>
                            </fieldset>

                            <div class="modal-footer">
                                   <button type="reset" class="btn btn-primary1" data-dismiss="modal"
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
                            <h4 class="modal-title">Edit On Duty Allowance Item</h4>
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
                                          <div class="col-4 name"> Code <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group" id="sel_identity">
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row" style="display:none">
                                          <div class="col-4 name">Code <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_item_code" name="sel_item_code"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="width: 60%;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name">Name <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_item_name_en" name="sel_item_name_en"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="width: 60%;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                        <img src="../../asset/img/icons/flag_en.png">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name"></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_item_name_id" name="sel_item_name_id"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="width: 60%;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                        <img src="../../asset/img/icons/flag_id.png">
                                                 </div>
                                          </div>
                                   </div>
                                   
                                   <div class="form-row">
                                          <div class="col-4 name">Type <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <select id="sel_type" class="input--style-6"
                                                                      name="sel_type" onfocus="hlentry(this)"
                                                                      onchange="formodified(this);"
                                                                      style="width:undefined;height: 33px;width: 45%;">
                                                                      <option value="">--Select One--</option>
                                                                      <option value="DAILY">Daily</option>
                                                                      <option value="TOTAL">Total</option>
                                                               </select>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Currency <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                 <select id="sel_currency_code" class="input--style-6" name="sel_currency_code" onfocus="hlentry(this)" onchange="formodified(this);" style="width:undefined;height: 33px;width: 45%;">
                                                               <option value="">--Select One--</option>
                                                               <?php
                                                               $sql = mysqli_query($connect, "SELECT currency_code FROM tgemcurrency");
                                                               $row = mysqli_num_rows($sql);
                                                               while ($row = mysqli_fetch_array($sql)){
                                                               echo "<option value='". $row['currency_code'] ."'>" .$row['currency_code'] ."</option>" ;
                                                               }
                                                               ?>
                                                        </select>
                                                       
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name">Allowance Category <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">
                                                        <select id="sel_category_name_en" class="input--style-6" name="sel_category_name_en" onfocus="hlentry(this)" onchange="formodified(this);" style="width:undefined;height: 33px;width: 45%;">
                                                               <option value="">--Select One--</option>
                                                               <?php
                                                               $sql = mysqli_query($connect, "SELECT category_code,category_name_en FROM hrmondutyallowcat");
                                                               $row = mysqli_num_rows($sql);
                                                               while ($row = mysqli_fetch_array($sql)){
                                                               echo "<option value='". $row['category_code'] ."'>" .$row['category_name_en'] ."</option>" ;
                                                               }
                                                               ?>
                                                        </select>
                                                       
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name">Purpose Type </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-sm-12">
                                                 <!-- pages relation -->
                                                 <div id="box"></div>
                                                 <!-- pages relation -->
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name">Formula <span class="required">*</span></div>
                                          <div class="col-sm-7">
                                                 <div class="input-group">

                                                 <textarea class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_formula" name="sel_formula"
                                                               type="Text" onfocus="hlentry(this)" size="30"
                                                               height="200"
                                                               style="width: 100%;"
                                                               
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title=""></textarea>
                                                       
                                                 </div>
                                          </div>
                                          <div class="col-sm-1">
                                                 <div class="input-group">
                                                        <img  onclick="SelectNameUpdate()" src="../../asset/dist/img/suggest.png" style="cursor: pointer;">
                                                 </div>
                                          </div>

                                          <script type="text/javascript">
                                                 var popup;
                                                 function SelectNameUpdate() {
                                                        var x = document.getElementById("sel_formula").value; 
                                                               
                                                        popup = window.open("PopupUpdate.php?id=" + x , "Popup", "width=510,height=300");
                                                        popup.focus();
                                                        return false
                                                 }
                                          </script>
                                   </div>
                                  
                            </fieldset>
                            
                            </div>

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
                                                 <input type="hidden" class="form-control input-report" id="sel_item_codeS" name="sel_item_codeS" placeholder="">
                                   </div>
                            </div>
				<div class="modal-footer-delete FormDisplayDelete" style="text-align: center;padding-top: 20px;">
                                          <button type="reset" class="btn btn-primary1" style="background: #ececec;" data-dismiss="modal" aria-hidden="true">
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

                     var inp_item_code = $("#inp_item_code").val();
                     var inp_item_name_en = $("#inp_item_name_en").val();
                     var inp_item_name_id = $("#inp_item_name_id").val();
                     var inp_type = $("#inp_type").val();
                     var inp_currency_code = $("#inp_currency_code").val();
                     var inp_category_name_en = $("#inp_category_name_en").val();
                     var inp_formula = $("#inp_formula").val();

                     var inp_purposed_code = [];
                  
                     var regex=/^[a-zA-Z]+$/;
                  
                     if (inp_item_code == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Item code cannot empty";

                     } else if (inp_item_name_en == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Item desc en cannot empty";

                     } else if (inp_item_name_id == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Item desc id cannot empty";

                     } else if (inp_type == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Item type id cannot empty";
                     
                     } else if (inp_currency_code == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Currency cannot empty";
                     
                     } else if (inp_category_name_en == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Category cannot empty";

                     } else if (inp_formula == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Formula cannot empty";

                     } else {
                            $('#submit_add').hide();
                            $('#submit_add2').show();
                     }

                     if (inp_item_code && inp_item_name_en && inp_item_name_id && inp_type && inp_currency_code && inp_category_name_en) {

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
                            document.getElementById("sel_identity").innerHTML = response.item_code;
                            
                            $("#sel_item_code").val(response.item_code);
                            $("#sel_item_name_en").val(response.item_name_en);
                            $("#sel_item_name_id").val(response.item_name_id);
                            $("#sel_type").val(response.type);
                            $("#sel_currency_code").val(response.currency_code);
                            $("#sel_category_name_en").val(response.category_code);
                            $("#sel_formula").val(response.formula);
                            
                            var sel_item_codeS       = response.item_code;

                                   $("#box").load("pages_relation/_pages_setting.php?rfid=" + sel_item_codeS, 
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

                                   var sel_item_code = $("#sel_item_code").val();
                                   var sel_item_name_en = $("#sel_item_name_en").val();
                                   var sel_item_name_id = $("#sel_item_name_id").val();
                                   var sel_type = $("#sel_type").val();
                                   var sel_currency_code = $("#sel_currency_code").val();
                                   var sel_category_name_en = $("#sel_category_name_en").val();
                                   var sel_formula = $("#sel_formula").val();

                                   var sel_purposed_code = [];                                   

                                   if (sel_item_code == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "Item code cannot empty";

                                   } else if (sel_item_name_en == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "Item name en desc en cannot empty";

                                   } else if (sel_item_name_id == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "Item name id desc en cannot empty";

                                
                                   } else {
                                          $('#submit_update').hide();
                                          $('#submit_update2').show();
                                   }


                                   if (sel_item_code && sel_item_name_en && sel_item_name_id) {

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

				$("#sel_item_codeS").val(response.item_code);

				// mmeber id 
				$(".FormDisplayDelete").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');

				// here update the member data
				$("#updatedelMemberForm").unbind('submit').bind('submit', function() {
					// remove error messages
					$(".text-danger").remove();

					var form = $(this);

					// validation

					var sel_item_codeS = $("#sel_item_codeS").val();

					if(sel_item_codeS == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "Item code cannot empty";
                                   } else {
                                          $('#submit_delete').hide();
                                          $('#submit_delete2').show();
                                   }


					if(sel_item_codeS) {
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

                                                               // reload the datatables
                                                               datatable.ajax.reload(null,false);
                                                               // reload the datatables

                                                               $('#FormDisplayDelete').modal('hide');  
                                                               $("[data-dismiss=modal]").trigger({type: "click"}); 
                                                               
                                                        } else {
                                                               modals.style.display = "block";
                                                               document.getElementById("msg").innerHTML = response.messages;
                                                               // reload the datatables

                                                               $('#submit_delete').show();
                                                               $('#submit_delete2').hide();         
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
                        
<script type="text/javascript">
       var tree4 = $("#test-select-4").treeMultiselect({
              allowBatchSelection: true,
              enableSelectAll: true,
              searchable: true,
              sortable: true,
              startCollapsed: false,
       });
</script>