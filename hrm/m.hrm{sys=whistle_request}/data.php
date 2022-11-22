<?php  
       $src_emp_no                = '';
       if (!empty($_POST['src_emp_no'])) {
              $src_emp_no         = $_POST['src_emp_no'];
              $frameworks          = "?user=$username"."&src_emp_no="."".$src_emp_no."";
       } else {
              $frameworks          = "?user=$username";
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
                                                 <legend>Searchings</legend>
                                                 <div class="form-row">
                                                        <div class="col-4 name">Employee No.  </div>
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
              order: [
                     [0, "asc"]
              ],
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
       <div class="card" style="border-radius: 20px 20px 20px 20px;margin-bottom: 25px;">
              <div class="card-header d-flex align-items-center" style="border-bottom: 1px solid white;">
                     <h4 class="card-title mb-0">Employee Information </h4>


                     <div class="card-actions ml-auto">
                            <table>

                                   <!-- <td>
                                          <form action="../rfid=repository/cli_Template_Download/st/StFunctionDownload.php" method="GET">
                                                 <input type="hidden" name="filedata" value="StDownloadGTTGROvertimeSettingData.php">
                                                 <input type="hidden" name="filename" value="Overtime Setting">
                                                 <input type="hidden" name="src_emp_no" value="<php echo $src_emp_no; ?>">
                                                 <input type="hidden" name="src_title" value="<php echo $src_title; ?>">
                                                 <button type="submit" class="toolbar sprite-toolbar-excel" id="EXCEL" style="border: 0;background-color: white;" name="submit_approve" value="submit"></button>
                                          </form>

                                   </td> -->
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
                                   <?php
                                          $get_auth = "SELECT user_type FROM users WHERE username = '$username'";
                                          $get_auth_r = mysqli_fetch_assoc(mysqli_query($connect , $get_auth));

                                          if($get_auth_r['user_type'] == 'SuperAdmin') {
                                                 echo '<td>
                                                 <div class="toolbar sprite-toolbar-add" title="Add" data-toggle="modal"
                                                        data-target="#CreateForm" id="CreateButton" data-keyboard="false"
                                                        data-backdrop="static">
                                                        <!-- <a title="add" href="" class="toolbar sprite-toolbar-add" data-toggle="modal" data-target="#CreateForm" id="CreateButton" data-keyboard="false" data-backdrop="static">tambah</a> -->
                                                 </div>
                                          </td>';
                                          }
                                   ?>
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

                                   <input id="inp_emp_no" name="inp_emp_no" type="hidden" value="<?php echo $username; ?>"><!--FROM SESSION -->

                                   <div class="form-row">
                                          <div class="col-sm-2 name">Employee id <span class="required">*</span></div>
                                          <div class="col-sm-10">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="inp_emp_id" 
                                                               name="inp_emp_id"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-sm-2 name">First Name <span class="required">*</span></div>
                                          <div class="col-sm-2">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="inp_first_name" 
                                                               name="inp_first_name"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>

                                          <div class="col-sm-2 name">Middle Name <span class="required">*</span></div>
                                          <div class="col-sm-2">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="inp_middle_name" 
                                                               name="inp_middle_name"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>

                                          <div class="col-sm-2 name">Last Name <span class="required">*</span></div>
                                          <div class="col-sm-2">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="inp_last_name" 
                                                               name="inp_last_name"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-sm-2 name">Gender <span class="required">*</span></div>
                                          <div class="col-sm-6">
                                                 <div class="input-group">

                                                        <select class="input--style-6" 
                                                               autocomplete="off" 
                                                               autofocus="on"
                                                               id="inp_gender" 
                                                               name="inp_gender"
                                                               style="height: 33px;">
                                                                      <option value="" selected> --Select one --</option>
                                                                      <?php 
                                                                      $sql=mysqli_query($connect, "SELECT * FROM sys_gender");
                                                                      while ($data=mysqli_fetch_array($sql)) {
                                                                      ?>
                                                                      <option value="<?=$data['id']?>"><?=$data['gender_en']?></option> 
                                                        <?php
                                                        }
                                                        ?>
                                                        </select>
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-sm-2 name">Identity no <span class="required">*</span></div>
                                          <div class="col-sm-4">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="inp_identity_no" 
                                                               name="inp_identity_no"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>
                                   
                                   <div class="form-row">
                                          <div class="col-sm-2 name">Tax no <span class="required">*</span></div>
                                          <div class="col-sm-4">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="inp_taxno" 
                                                               name="inp_taxno"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-sm-2 name">Email <span class="required">*</span></div>
                                          <div class="col-sm-6">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="inp_email" 
                                                               name="inp_email"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-sm-2 name">Phone <span class="required">*</span></div>
                                          <div class="col-sm-4">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="inp_phone" 
                                                               name="inp_phone"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-sm-2 name">Birthplace <span class="required">*</span></div>
                                          <div class="col-sm-4">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="inp_birthplace" 
                                                               name="inp_birthplace"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-sm-2 name">Birthdate <span class="required">*</span></div>
                                          <div class="col-sm-4">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="inp_birthdate" 
                                                               name="inp_birthdate"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-sm-2 name">Marital status <span class="required">*</span></div>
                                          <div class="col-sm-4">
                                                 <div class="input-group">

                                                        <select class="form-control input--style-6" 
                                                                      autocomplete="off" 
                                                                      autofocus="on"
                                                                      id="inp_maritalstatus" 
                                                                      name="inp_maritalstatus"
                                                                      style="height: 33px;">
                                                                             <option value="" selected> --Select one --</option>
                                                                             <?php 
                                                                             $sql=mysqli_query($connect, "SELECT * FROM sys_marital");
                                                                             while ($data=mysqli_fetch_array($sql)) {
                                                                             ?>
                                                                             <option value="<?=$data['id']?>"><?=$data['marital_en']?></option> 
                                                               <?php
                                                               }
                                                               ?>
                                                        </select>
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-sm-2 name">Address <span class="required">*</span></div>
                                          <div class="col-sm-6">
                                                 <div class="input-group">
                                                        <textarea id="editor" value="" name="inp_address"></textarea>
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-sm-2 name">City <span class="required">*</span></div>
                                          <div class="col-sm-4">
                                                 <div class="input-group">

                                                        <select class="form-control input--style-6" 
                                                                      autocomplete="off" 
                                                                      autofocus="on"
                                                                      id="inp_city_id" 
                                                                      name="inp_city_id"
                                                                      style="height: 33px;">
                                                                             <option value="" selected> --Select one --</option>
                                                                             <?php 
                                                                             $sql=mysqli_query($connect, "SELECT * FROM teomcity");
                                                                             while ($data=mysqli_fetch_array($sql)) {
                                                                             ?>
                                                                             <option value="<?=$data['city_id']?>"><?=$data['city_name']?></option> 
                                                               <?php
                                                               }
                                                               ?>
                                                        </select>
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-sm-2 name">Zipcode <span class="required">*</span></div>
                                          <div class="col-sm-4">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="inp_zipcode" 
                                                               name="inp_zipcode"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-sm-2 name">Employee Status <span class="required">*</span></div>
                                          <div class="col-sm-4">
                                                 <div class="input-group">

                                                        <select class="form-control input--style-6" 
                                                                      autocomplete="off" 
                                                                      autofocus="on"
                                                                      id="inp_employ_code" 
                                                                      name="inp_employ_code"
                                                                      style="height: 33px;">
                                                                             <option value="" selected> --Select one --</option>
                                                                             <?php 
                                                                             $sql=mysqli_query($connect, "SELECT * FROM hrmemploymentstatus");
                                                                             while ($data=mysqli_fetch_array($sql)) {
                                                                             ?>
                                                                             <option value="<?=$data['employmentstatus_code']?>"><?=$data['employmentstatus_name_en']?></option> 
                                                               <?php
                                                               }
                                                               ?>
                                                        </select>
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-sm-2 name">Grade <span class="required">*</span></div>
                                          <div class="col-sm-4">
                                                 <div class="input-group">

                                                        <select class="form-control input--style-6" 
                                                                      autocomplete="off" 
                                                                      autofocus="on"
                                                                      id="inp_grade_code" 
                                                                      name="inp_grade_code"
                                                                      style="height: 33px;">
                                                                             <option value="" selected> --Select one --</option>
                                                                             <?php 
                                                                             $sql=mysqli_query($connect, "SELECT * FROM teomjobgrade");
                                                                             while ($data=mysqli_fetch_array($sql)) {
                                                                             ?>
                                                                             <option value="<?=$data['grade_code']?>"><?=$data['grade_code']?></option> 
                                                               <?php
                                                               }
                                                               ?>
                                                        </select>
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-sm-2 name">Cost Center <span class="required">*</span></div>
                                          <div class="col-sm-4">
                                                 <div class="input-group">

                                                        <select class="form-control input--style-6" 
                                                                      autocomplete="off" 
                                                                      autofocus="on"
                                                                      id="inp_cost_code" 
                                                                      name="inp_cost_code"
                                                                      style="height: 33px;">
                                                                             <option value="" selected> --Select one --</option>
                                                                             <?php 
                                                                             $sql=mysqli_query($connect, "SELECT * FROM teomcostcenter");
                                                                             while ($data=mysqli_fetch_array($sql)) {
                                                                             ?>
                                                                             <option value="<?=$data['costcenter_code']?>"><?=$data['costcenter_code']?></option> 
                                                               <?php
                                                               }
                                                               ?>
                                                        </select>
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-sm-2 name">Position <span class="required">*</span></div>
                                          <div class="col-sm-4">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="inp_position_id" 
                                                               name="inp_position_id"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-sm-2 name">Worklocation <span class="required">*</span></div>
                                          <div class="col-sm-4">
                                                 <div class="input-group">

                                                        <select class="form-control input--style-6" 
                                                                      autocomplete="off" 
                                                                      autofocus="on"
                                                                      id="inp_worklocation_code" 
                                                                      name="inp_worklocation_code"
                                                                      style="height: 33px;">
                                                                             <option value="" selected> --Select one --</option>
                                                                             <?php 
                                                                             $sql=mysqli_query($connect, "SELECT * FROM hrmworklocation");
                                                                             while ($data=mysqli_fetch_array($sql)) {
                                                                             ?>
                                                                             <option value="<?=$data['id']?>"><?=$data['worklocation_name']?></option> 
                                                               <?php
                                                               }
                                                               ?>
                                                        </select>
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-sm-2 name">Photos <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">
                                                        <input type="file" name="inp_fileToUpload" id="inp_fileToUpload">
                                                 </div>
                                          </div>
                                   </div>

                                   
                                 
                            </fieldset>

                            
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
                            <h4 class="modal-title">Edit Employee</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 99%; margin: 5px;overflow: scroll;overflow-x: hidden;">


                     <form class="form-horizontal" action="php_action/FuncDataUpdate.php" method="POST" id="FormDisplayUpdate">

                     <fieldset id="fset_1">
                                   <legend>Detail Informations</legend>

                                   <div class="messages_create"></div>

                                   <input id="inp_emp_no" name="inp_emp_no" type="hidden" value="<?php echo $username; ?>"><!--FROM SESSION -->

                                   <div class="form-row">
                                          <div class="col-sm-2 name">Employee id <span class="required">*</span></div>
                                          <div class="col-sm-10">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_emp_id" 
                                                               name="sel_emp_id"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-sm-2 name">First Name <span class="required">*</span></div>
                                          <div class="col-sm-2">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_first_name" 
                                                               name="sel_first_name"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>

                                          <div class="col-sm-2 name">Middle Name <span class="required">*</span></div>
                                          <div class="col-sm-2">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_middle_name" 
                                                               name="sel_middle_name"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>

                                          <div class="col-sm-2 name">Last Name <span class="required">*</span></div>
                                          <div class="col-sm-2">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_last_name" 
                                                               name="sel_last_name"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-sm-2 name">Gender <span class="required">*</span></div>
                                          <div class="col-sm-6">
                                                 <div class="input-group">

                                                        <select class="input--style-6" 
                                                               autocomplete="off" 
                                                               autofocus="on"
                                                               id="sel_gender" 
                                                               name="sel_gender"
                                                               style="height: 33px;">
                                                                      <option value="" selected> --Select one --</option>
                                                                      <?php 
                                                                      $sql=mysqli_query($connect, "SELECT * FROM sys_gender");
                                                                      while ($data=mysqli_fetch_array($sql)) {
                                                                      ?>
                                                                      <option value="<?=$data['id']?>"><?=$data['gender_en']?></option> 
                                                        <?php
                                                        }
                                                        ?>
                                                        </select>
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-sm-2 name">Identity no <span class="required">*</span></div>
                                          <div class="col-sm-4">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_identity_no" 
                                                               name="sel_identity_no"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>
                                   
                                   <div class="form-row">
                                          <div class="col-sm-2 name">Tax no <span class="required">*</span></div>
                                          <div class="col-sm-4">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_taxno" 
                                                               name="sel_taxno"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-sm-2 name">Email <span class="required">*</span></div>
                                          <div class="col-sm-6">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_email" 
                                                               name="sel_email"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-sm-2 name">Phone <span class="required">*</span></div>
                                          <div class="col-sm-4">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_phone" 
                                                               name="sel_phone"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-sm-2 name">Birthplace <span class="required">*</span></div>
                                          <div class="col-sm-4">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_birthplace" 
                                                               name="sel_birthplace"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-sm-2 name">Birthdate <span class="required">*</span></div>
                                          <div class="col-sm-4">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_birthdate" 
                                                               name="sel_birthdate"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-sm-2 name">Marital status <span class="required">*</span></div>
                                          <div class="col-sm-4">
                                                 <div class="input-group">

                                                        <select class="form-control input--style-6" 
                                                                      autocomplete="off" 
                                                                      autofocus="on"
                                                                      id="sel_maritalstatus" 
                                                                      name="sel_maritalstatus"
                                                                      style="height: 33px;">
                                                                             <option value="" selected> --Select one --</option>
                                                                             <?php 
                                                                             $sql=mysqli_query($connect, "SELECT * FROM sys_marital");
                                                                             while ($data=mysqli_fetch_array($sql)) {
                                                                             ?>
                                                                             <option value="<?=$data['id']?>"><?=$data['marital_en']?></option> 
                                                               <?php
                                                               }
                                                               ?>
                                                        </select>
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-sm-2 name">Address <span class="required">*</span></div>
                                          <div class="col-sm-6">
                                                 <div class="input-group">
                                                        <textarea id="editor_update" value="" name="sel_address"></textarea>
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-sm-2 name">City <span class="required">*</span></div>
                                          <div class="col-sm-4">
                                                 <div class="input-group">

                                                        <select class="form-control input--style-6" 
                                                                      autocomplete="off" 
                                                                      autofocus="on"
                                                                      id="sel_city_id" 
                                                                      name="sel_city_id"
                                                                      style="height: 33px;">
                                                                             <option value="" selected> --Select one --</option>
                                                                             <?php 
                                                                             $sql=mysqli_query($connect, "SELECT * FROM teomcity");
                                                                             while ($data=mysqli_fetch_array($sql)) {
                                                                             ?>
                                                                             <option value="<?=$data['city_id']?>"><?=$data['city_name']?></option> 
                                                               <?php
                                                               }
                                                               ?>
                                                        </select>
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-sm-2 name">Zipcode <span class="required">*</span></div>
                                          <div class="col-sm-4">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_zipcode" 
                                                               name="sel_zipcode"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-sm-2 name">Employee Status <span class="required">*</span></div>
                                          <div class="col-sm-4">
                                                 <div class="input-group">

                                                        <select class="form-control input--style-6" 
                                                                      autocomplete="off" 
                                                                      autofocus="on"
                                                                      id="sel_employ_code" 
                                                                      name="sel_employ_code"
                                                                      style="height: 33px;">
                                                                             <option value="" selected> --Select one --</option>
                                                                             <?php 
                                                                             $sql=mysqli_query($connect, "SELECT * FROM hrmemploymentstatus");
                                                                             while ($data=mysqli_fetch_array($sql)) {
                                                                             ?>
                                                                             <option value="<?=$data['employmentstatus_code']?>"><?=$data['employmentstatus_name_en']?></option> 
                                                               <?php
                                                               }
                                                               ?>
                                                        </select>
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-sm-2 name">Grade <span class="required">*</span></div>
                                          <div class="col-sm-4">
                                                 <div class="input-group">

                                                        <select class="form-control input--style-6" 
                                                                      autocomplete="off" 
                                                                      autofocus="on"
                                                                      id="sel_grade_code" 
                                                                      name="sel_grade_code"
                                                                      style="height: 33px;">
                                                                             <option value="" selected> --Select one --</option>
                                                                             <?php 
                                                                             $sql=mysqli_query($connect, "SELECT * FROM teomjobgrade");
                                                                             while ($data=mysqli_fetch_array($sql)) {
                                                                             ?>
                                                                             <option value="<?=$data['grade_code']?>"><?=$data['grade_code']?></option> 
                                                               <?php
                                                               }
                                                               ?>
                                                        </select>
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-sm-2 name">Cost Center <span class="required">*</span></div>
                                          <div class="col-sm-4">
                                                 <div class="input-group">

                                                        <select class="form-control input--style-6" 
                                                                      autocomplete="off" 
                                                                      autofocus="on"
                                                                      id="sel_cost_code" 
                                                                      name="sel_cost_code"
                                                                      style="height: 33px;">
                                                                             <option value="" selected> --Select one --</option>
                                                                             <?php 
                                                                             $sql=mysqli_query($connect, "SELECT * FROM teomcostcenter");
                                                                             while ($data=mysqli_fetch_array($sql)) {
                                                                             ?>
                                                                             <option value="<?=$data['costcenter_code']?>"><?=$data['costcenter_code']?></option> 
                                                               <?php
                                                               }
                                                               ?>
                                                        </select>
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-sm-2 name">Position <span class="required">*</span></div>
                                          <div class="col-sm-4">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_position_id" 
                                                               name="sel_position_id"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-sm-2 name">Worklocation <span class="required">*</span></div>
                                          <div class="col-sm-4">
                                                 <div class="input-group">

                                                        <select class="form-control input--style-6" 
                                                                      autocomplete="off" 
                                                                      autofocus="on"
                                                                      id="sel_worklocation_code" 
                                                                      name="sel_worklocation_code"
                                                                      style="height: 33px;">
                                                                             <option value="" selected> --Select one --</option>
                                                                             <?php 
                                                                             $sql=mysqli_query($connect, "SELECT * FROM hrmworklocation");
                                                                             while ($data=mysqli_fetch_array($sql)) {
                                                                             ?>
                                                                             <option value="<?=$data['worklocation_code']?>"><?=$data['worklocation_name']?></option> 
                                                               <?php
                                                               }
                                                               ?>
                                                        </select>
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-sm-2 name">Photos <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">
                                                        <input type="file" name="sel_fileToUpload" id="sel_fileToUpload">
                                                 </div>
                                          </div>
                                   </div>

                                   
                                 
                            </fieldset>

                            <fieldset id="fset_1" style="min-height: 100%;">
                                   <legend>Career Information</legend>

                                   <div class="messages_create"></div>

                                   <input id="sel_emp_no" name="sel_emp_no" type="hidden" value="<?php echo $username; ?>"><!--FROM SESSION -->
                                   
                                   <div class="form-row">
                                          <div class="col-sm-2 name">Join Date <span class="required">*</span></div>
                                          <div class="col-sm-4">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_joindate" 
                                                               name="sel_joindate"
                                                               type="text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>

                            </fieldset>


                            <fieldset id="fset_1" style="min-height: 100%;">
                                   <legend>User Informations</legend>

                                   <div class="messages_create"></div>

                                   <input id="sel_emp_no" name="sel_emp_no" type="hidden" value="<?php echo $username; ?>"><!--FROM SESSION -->
                                   
                                   <div class="form-row">
                                          <div class="col-sm-2 name">Latitude <span class="required">*</span></div>
                                          <div class="col-sm-4">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_latitude" 
                                                               name="sel_latitude"
                                                               type="text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-sm-2 name">Longitude <span class="required">*</span></div>
                                          <div class="col-sm-4">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_longitude" 
                                                               name="sel_longitude"
                                                               type="text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-sm-2 name">PIN Payslip <span class="required">*</span></div>
                                          <div class="col-sm-4">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_pin" 
                                                               name="sel_pin"
                                                               type="text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>
                            </fieldset>

                            <fieldset id="fset_1" style="min-height: 100%; display:none;">
                                   <legend>Shift Group</legend>

                                   <div class="form-row">
                                          <div class="col-sm-2 name">Shift Group <span class="required">*</span></div>
                                          <div class="col-sm-4">
                                                 <div class="input-group">

                                                        <select class="form-control input--style-6" 
                                                                      autocomplete="off" 
                                                                      autofocus="on"
                                                                      id="sel_shiftgroup_code" 
                                                                      name="sel_shiftgroup_code"
                                                                      style="height: 33px;">
                                                                             <option value="" selected> --Select one --</option>
                                                                             <?php 
                                                                             $sql=mysqli_query($connect, "SELECT * FROM hrmshiftgroup");
                                                                             while ($data=mysqli_fetch_array($sql)) {
                                                                             ?>
                                                                             <option value="<?=$data['shiftgroupcode']?>"><?=$data['shiftgroupcode']?></option> 
                                                               <?php
                                                               }
                                                               ?>
                                                        </select>
                                                 </div>
                                          </div>
                                   </div>
                            </fieldset>

                            <fieldset id="fset_1" style="min-height: 100%;">
                                   <legend>Bank Information</legend>

                                   <div class="form-row">
                                          <div class="col-sm-2 name">Account Name <span class="required">*</span></div>
                                          <div class="col-sm-4">
                                                 <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off"
                                                                      autofocus="on" id="sel_account_name"
                                                                      name="sel_account_name" type="Text" value=""
                                                                      onfocus="hlentry(this)" size="30" maxlength="50"
                                                                       validate="NotNull:Invalid Form Entry"
                                                                      onchange="formodified(this);" title=""
                                                                      placeholder="employee number">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                                 <div class="col-sm-2 name">Bank *</div>
                                                 <div class="col-sm-4" style="padding-bottom:5px">
                                                        <div class="input-group">
                                                               <select class="form-control input--style-6" 
                                                                             autocomplete="off" 
                                                                             autofocus="on"
                                                                             id="sel_bank_name" 
                                                                             name="sel_bank_name"
                                                                             style="height: 33px;">
                                                                                    <option value="" selected> --Select one --</option>
                                                                                    <?php 
                                                                                    $sql=mysqli_query($connect, "SELECT * FROM sys_bank");
                                                                                    while ($data=mysqli_fetch_array($sql)) {
                                                                                    ?>
                                                                                    <option value="<?=$data['bank']?>"><?=$data['bank']?></option> 
                                                                      <?php
                                                                      }
                                                                      ?>
                                                               </select>
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Branch *</div>
                                                 <div class="col-sm-4" style="padding-bottom:5px">
                                                        <div class="input-group">
                                                               <input class="input--style-6" autocomplete="off"
                                                                      autofocus="on" id="sel_branch" name="sel_branch"
                                                                      type="Text" value="" onfocus="hlentry(this)"
                                                                      size="30" maxlength="50" 
                                                                      validate="NotNull:Invalid Form Entry"
                                                                      onchange="formodified(this);" title=""
                                                                      placeholder="Bank Branch">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-sm-2 name">Account no *</div>
                                                 <div class="col-sm-4" style="padding-bottom:5px">
                                                        <div class="input-group">
                                                               <input class="input--style-6" autocomplete="off"
                                                                      autofocus="on" id="sel_account_number"
                                                                      name="sel_account_number" type="Text" value=""
                                                                      onfocus="hlentry(this)" size="30" maxlength="50"
                                                                       validate="NotNull:Invalid Form Entry"
                                                                      onchange="formodified(this);" title=""
                                                                      placeholder="Account Number">
                                                        </div>
                                                 </div>
                                          </div>

                            </fieldset>

                     </div>
   
              <!-- END SCROLLING -->

                           
                            
                            <div class="modal-footer-sdk">
                                   <button type="reset" class="btn-sdk btn-primary-left" data-dismiss="modal"
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
         

                     
              </div>

              </form>
       </div><!-- /.modal-content -->
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

                            <div class="modal-footer-delete FormDisplayDelete" style="text-align: center;padding-bottom: 14px;">
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
                     var inp_first_name          = $("#inp_first_name").val();
                     var inp_middle_name         = $("#inp_middle_name").val();
                     var inp_last_name           = $("#inp_last_name").val();
                     var inp_gender              = $("#inp_gender").val();
                     var inp_identity_no         = $("#inp_identity_no").val();
                     var inp_taxno               = $("#inp_taxno").val();
                     var inp_email               = $("#inp_email").val();
                     var inp_phone               = $("#inp_phone").val();
                     var inp_birthplace          = $("#inp_birthplace").val();
                     var inp_birthdate           = $("#inp_birthdate").val();
                     var inp_maritalstatus       = $("#inp_maritalstatus").val();
                     var inp_address             = $("#inp_address").val();
                     var inp_city_id             = $("#inp_city_id").val();
                     var inp_zipcode             = $("#inp_zipcode").val();
                     var inp_employ_code         = $("#inp_employ_code").val();
                     var inp_grade_code          = $("#inp_grade_code").val();
                     var inp_cost_code           = $("#inp_cost_code").val();
                     var inp_position_id         = $("#inp_position_id").val();
                     var inp_worklocation_code   = $("#inp_worklocation_code").val();
                     var inp_fileToUpload        = $("#inp_fileToUpload").val();

                     var inp_joindate            = $("#inp_joindate").val();
                     var inp_latitude            = $("#inp_latitude").val();
                     var inp_longitude           = $("#inp_longitude").val();
                     var inp_pin                 = $("#inp_pin").val();
                     var inp_shiftgroup_code     = $("#inp_shiftgroup_code").val();
                     var inp_account_name        = $("#inp_account_name").val();
                     var inp_bank_name           = $("#inp_bank_name").val();
                     var inp_branch              = $("#inp_branch").val();
                     var inp_account_number      = $("#inp_account_number").val();
              

                     var regex=/^[a-zA-Z]+$/;
                  
                     if (inp_emp_id == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Emp id cannot empty";
                            
                     } else if (inp_first_name == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "First name cannot empty";

                     } else if (inp_gender == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Gender cannot empty";

                     } else if (inp_identity_no == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Identity no cannot empty";
                     
                     } else if (inp_taxno == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Tax no cannot empty";

                     } else if (inp_email == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Email cannot empty";

                     } else if (inp_phone == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Phone cannot empty";

                     } else if (inp_birthplace == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "birthplace cannot empty";

                     } else if (inp_birthdate == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "birthdate cannot empty";

                     } else if (inp_maritalstatus == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "maritalstatus cannot empty";

                     } else if (document.getElementById("editor").value == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "address cannot empty";

                     } else if (inp_city_id == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "city cannot empty";

                     } else if (inp_zipcode == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "zipcode cannot empty";

                     } else if (inp_employ_code == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "employ code cannot empty";

                     } else if (inp_grade_code == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "grade code cannot empty";

                     } else if (inp_cost_code == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "cost code cannot empty";

                     } else if (inp_position_id == "") {modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "position cannot empty";

                     } else if (inp_worklocation_code == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "worklocation cannot empty";

                     } else if (inp_fileToUpload == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Attachment cannot empty";

                     } else if (inp_joindate == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Join date cannot empty";

                     } else if (inp_latitude == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Latitude cannot empty";

                     } else if (inp_longitude == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Longitude cannot empty";

                     } else if (inp_pin == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Pin cannot empty";

                     } else if (inp_shiftgroup_code == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Shiftgroup cannot empty";

                     } else if (inp_account_name == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Bank Account cannot empty";

                     } else if (inp_bank_name == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Bank Name cannot empty";
                    
                     } else if (inp_branch == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Branch cannot empty";

                     } else if (inp_account_number == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Account Number cannot empty";

                     } else {
                            $('#submit_add').hide();
                            $('#submit_add2').show();
                             mymodalss.style.display = "block";
                     }

                     if (inp_emp_id && inp_first_name && inp_gender && inp_taxno && inp_identity_no && inp_email && inp_phone && inp_birthplace && inp_birthdate && inp_maritalstatus && inp_city_id && inp_zipcode && inp_employ_code && inp_grade_code && inp_cost_code && inp_position_id && inp_worklocation_code && inp_fileToUpload && inp_joindate && inp_latitude && inp_longitude && inp_pin && inp_shiftgroup_code && inp_account_name && inp_bank_name && inp_branch && inp_account_number) {
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
                     url: 'php_action/getSelectedEmployee.php',
                     type: 'post',
                     data: {
                            member_id: id
                     },
                     dataType: 'json',


                     success: function(response) {
                            
        
                            $("#sel_emp_id").val(response.emp_id);
                            $("#sel_first_name").val(response.first_name);
                            $("#sel_middle_name").val(response.middle_name);
                            $("#sel_last_name").val(response.last_name);
                            $("#sel_gender").val(response.gender);
                            $("#sel_taxno").val(response.taxno);
                            $("#sel_email").val(response.email);
                            $("#sel_phone").val(response.phone);
                            $("#sel_birthplace").val(response.birthplace);
                            $("#sel_birthdate").val(response.birthdate);
                            $("#sel_maritalstatus").val(response.maritalstatus);
                            $("#editor_update").val(response.address);
                            $("#sel_city_id").val(response.city_id);
                            $("#sel_zipcode").val(response.zipcode);
                            $("#sel_employ_code").val(response.employ_code);
                            $("#sel_grade_code").val(response.grade_code);
                            $("#sel_cost_code").val(response.cost_code);
                            $("#sel_position_id").val(response.position_id);
                            $("#sel_worklocation_code").val(response.worklocation_code);
                            $("#sel_shiftgroup_code").val(response.shiftgroup_code);
                            $("#sel_joindate").val(response.joindate);
                            $("#sel_identity_no").val(response.identity_no);
                            $("#sel_joindate").val(response.start_date);

                            $("#sel_latitude").val(response.latitude);
                            $("#sel_longitude").val(response.longlatitude);
                            $("#sel_pin").val(response.pin);

                            $("#sel_account_name").val(response.name_inbank);
                            $("#sel_bank_name").val(response.bank);
                            $("#sel_branch").val(response.cabang);
                            $("#sel_account_number").val(response.rekening);



                    
                        


                            // here update the member data
                            $("#FormDisplayUpdate").unbind('submit').bind('submit', function() {
                                   // remove error messages
                                   $(".text-danger").remove();

                                   var form = $(this);

                                   var update_id_berita        = $("#update_id_berita").val();
                                   var update_subject          = $("#update_subject").val();
                                
                                   var regex=/^[a-zA-Z]+$/;

                                   if (sel_emp_id == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "Overtime code cannot empty";

                                   // } else if (update_subject == "") {
                                   //        modals.style.display ="block";
                                   //        document.getElementById("msg").innerHTML = "Overtime minimum cannot empty";

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
                        




                           
      

<script src="asset/ckeditor.js"></script>
<script src="asset/js/sample.js"></script>
<script src="asset/js/sampleupdate.js"></script>
                        
    <script>
                     initSample();
                     initSampleUpdate();
              </script>

