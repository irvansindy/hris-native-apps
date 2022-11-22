<?php  
       $src_kpi_no                        = '';
       $src_employee_no                   = '';
       $src_request_status                = '';
       $code_print                        = '--Select status--';

       $src                               = '';

       if (!empty($_POST['src_kpi_no']) && !empty($_POST['src_employee_no']) && !empty($_POST['src_request_status'])) {
              $src_kpi_no                 = $_POST['src_kpi_no'];
              $src_employee_no            = $_POST['src_employee_no'];
              $src_request_status         = $_POST['src_request_status'];
              $frameworks                 = "?src_kpi_no="."".$src_kpi_no."&src_employee_no="."".$src_employee_no."&src_request_status="."".$src_request_status."";
       } else if (empty($_POST['src_kpi_no']) && empty($_POST['src_employee_no']) && !empty($_POST['src_request_status'])) {
              $src_kpi_no                 = $_POST['src_kpi_no'];
              $src_employee_no            = $_POST['src_employee_no'];
              $src_request_status         = $_POST['src_request_status'];
              $frameworks                 = "?src_request_status="."".$src_request_status."";
       } else if (empty($_POST['src_kpi_no']) && !empty($_POST['src_employee_no']) && empty($_POST['src_request_status'])) {
              $src_kpi_no                 = $_POST['src_kpi_no'];
              $src_employee_no            = $_POST['src_employee_no'];
              $src_request_status         = $_POST['src_request_status'];
              $frameworks                 = "?src_employee_no="."".$src_employee_no."";
       } else if (!empty($_POST['src_kpi_no']) && empty($_POST['src_employee_no']) && empty($_POST['src_request_status'])) {
              $src_kpi_no                 = $_POST['src_kpi_no'];
              $src_employee_no            = $_POST['src_employee_no'];
              $src_request_status         = $_POST['src_request_status'];
              $frameworks                 = "?src_kpi_no="."".$src_kpi_no."";
       } else if (empty($_POST['src_kpi_no']) && !empty($_POST['src_employee_no']) && !empty($_POST['src_request_status'])) {
              $src_kpi_no                 = $_POST['src_kpi_no'];
              $src_employee_no            = $_POST['src_employee_no'];
              $src_request_status         = $_POST['src_request_status'];
              $frameworks                 = "?src_employee_no="."".$src_employee_no."&src_request_status="."".$src_request_status."";
       } else if (!empty($_POST['src_kpi_no']) && !empty($_POST['src_employee_no']) && empty($_POST['src_request_status'])) {
              $src_kpi_no                 = $_POST['src_kpi_no'];
              $src_employee_no            = $_POST['src_employee_no'];
              $src_request_status         = $_POST['src_request_status'];
              $frameworks                 = "?src_kpi_no="."".$src_kpi_no."&src_employee_no="."".$src_employee_no."";
       } else if (!empty($_POST['src_kpi_no']) && empty($_POST['src_employee_no']) && !empty($_POST['src_request_status'])) {
              $src_kpi_no                 = $_POST['src_kpi_no'];
              $src_employee_no            = $_POST['src_employee_no'];
              $src_request_status         = $_POST['src_request_status'];
              $frameworks                 = "?src_kpi_no="."".$src_kpi_no."&src_request_status="."".$src_request_status."";
       } else {
              $frameworks                 = "";
       }
       if(!empty($_POST['src_request_status'])) {
              $code = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM hrmstatus WHERE code = '$src_request_status'"));
              $code_print = $code['name_en'];

              $src = '<option value="">show all</option>';
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
                                   <!-- <form method="#" id="myform"> -->
                                          <fieldset id="fset_1" style="margin-top: 25px;border-radius: 5px;border: 1px solid #e4e8ea;">
                                                 <legend>Searching</legend>
                                                 <div class="form-row">
                                                        <div class="col-4 name">KPI Code </div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on" id="src_kpi_no"
                                                                             name="src_kpi_no" id="src_kpi_no" type="Text" value="<?php echo $src_kpi_no; ?>"
                                                                             onfocus="hlentry(this)" size="30" maxlength="50" 
                                                                             validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title="">
                                                               </div>
                                                        </div>
                                                 </div>
                                                 
                                                 <div class="form-row">
                                                        <div class="col-4 name">Employee No.</div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on" id="src_employee_no"
                                                                             name="src_employee_no" id="src_employee_no" type="Text" value="<?php echo $src_employee_no; ?>"
                                                                             onfocus="hlentry(this)" size="30" maxlength="50" 
                                                                             validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title="">
                                                               </div>
                                                        </div>
                                                 </div>

                                                 <div class="form-row">
                                                        <div class="col-4 name">Request Status </div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">

                                                                      <select id="src_request_status" class="input--style-6"
                                                                             name="src_request_status" onfocus="hlentry(this)"
                                                                             onchange="formodified(this);"
                                                                             style="width:undefined;border: 1px solid #cac2c2;color: #484545; height:33px">
                                                                             <option value="<?php echo $src_request_status; ?>"><?php echo $code_print; ?></option>
                                                                             <?php echo $src; ?>
                                                                             <?php
                                                                                    $sql = mysqli_query($connect,"SELECT code, name_en FROM hrmstatus WHERE code IN ('1','2','3','4','5','8') AND code NOT IN ('$src_request_status')");
                                                                                    while($row=mysqli_fetch_array($sql))
                                                                                    {
                                                                                    echo '<option value="'.$row['code'].'">'.$row['name_en'].'</option>';
                                                                                    } 
                                                                             ?>
                                                                      </select>

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

<style>
.margin {
 padding-right: 0px;
}
</style>

<body id="bods" style="padding-right:0px;" class="margin">
<div class="col-md-12">
       <div class="card">
              <div class="card-header d-flex align-items-center">
                     <h4 class="card-title mb-0">MY Individual Performance Plan </h4>
                     <div class="card-actions ml-auto">
                            <table>
                                   <!-- <td>
                                          <form action="../rfid=repository/cli_Template_Download/st/StFunctionDownload.php" method="GET">
                                                 <input type="hidden" name="filedata" value="StDownloadGTTGROndtAllowanceItemData.php">
                                                 <input type="hidden" name="filename" value="OndtAllowanceItem">
                                                 <input type="hidden" name="src_ip_period" value="<php echo $src_ip_period; ?>">
                                                 <input type="hidden" name="src_ipp_reqno" value="<php echo $src_ipp_reqno; ?>">
                                                 <button type="submit" class="toolbar sprite-toolbar-excel" id="EXCEL" style="border: 0;background-color: white;" name="submit_approve" value="submit"></button>
                                          </form>
                                   </td> -->
                                   <td>
                                          <a href='#' class='open_modal_search' class="btn btn-demo" data-toggle="modal" data-target="#myModal2">
                                                 <div class="toolbar sprite-toolbar-search" id="SEARCH" title="Search">
                                                 </div>
                                          </a>
                                   </td>

                                   <td>
                                          <div class="toolbar sprite-toolbar-reload" id="RELOAD" title="Reload"
                                                 onclick="RefreshPage();">
                                          </div>
                                   </td>

                                   <?php
                                          $get_request_regulation = mysqli_query($connect, "SELECT *
                                                                                                  FROM
                                                                                                  hrdperf_set_period
                                                                                                  WHERE 
                                                                                                         emp_no        = '$username' AND
                                                                                                         period_id     = (SELECT MAX(x1.period_id) FROM hrdperf_set_period x1 WHERE x1.emp_no = '$username') AND
                                                                                                         period_type   = '1'");
                                          if(mysqli_num_rows($get_request_regulation) < 1){
                                                 $data_target  = 'data-target="#CreateFormSPVUP"';
                                                 $id           = 'id="CreateButtonSPVUP"';
                                          } else {
                                                 $data_target  = 'data-target="#CreateForm"';
                                                 $id           = 'id="CreateButton"';
                                          }
                                   ?>
                                   <td>
                                          <div class="toolbar sprite-toolbar-add" title="Add" data-toggle="modal"
                                                 <?php echo $data_target; ?> <?php echo $id; ?> data-keyboard="false"
                                                 data-backdrop="static">
                                                 <!-- <a title="add" href="" class="toolbar sprite-toolbar-add" data-toggle="modal" data-target="#CreateForm" id="CreateButton" data-keyboard="false" data-backdrop="static">tambah</a> -->
                                          </div>
                                   </td>
                            </table>
                     </div>
              </div>

              <div class="card-body table-responsive p-0" style="width: 100vw;height: 78vh; width: 98%; margin: 5px;overflow: scroll;">
                     <table id="datatable" width="100%" border="1"
                            class="table table-bordered table-striped table-hover table-head-fixed">
                            <thead>
                                   <tr>
                                          <th class="fontCustom"
                                                 style="z-index: 1;vertical-align: ce;vertical-align: middle;"
                                                 nowrap="nowrap">No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                          <th class="fontCustom"
                                          style="z-index: 1; vertical-align: middle; width: 100px;">
                                                 KPI Code&nbsp;&nbsp;&nbsp;</th>
                                          <th class="fontCustom"
                                                 style="z-index: 1; vertical-align: middle; width: 100px;">
                                                 KPI Type&nbsp;&nbsp;&nbsp;</th>
                                          <th class="fontCustom"
                                                 style="z-index:1;vertical-align: ce;vertical-align: middle;">KPI Period&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          </th>
                                          <th class="fontCustom"
                                                 style="z-index:1;vertical-align: ce;vertical-align: middle;">Employee no&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          </th>
                                          <th class="fontCustom"
                                                 style="z-index:1;vertical-align: ce;vertical-align: middle;">Employee name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          </th>
                                          <th class="fontCustom"
                                                 style="z-index:1;vertical-align: ce;vertical-align: middle;">Position&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          </th>
                                          <th class="fontCustom"
                                                 style="z-index:1;vertical-align: ce;vertical-align: middle;">Cost Center&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          </th>
                                          <th class="fontCustom"
                                                 style="z-index:1;vertical-align: ce;vertical-align: middle;">Created date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          </th>
                                           <th class="fontCustom"
                                                 style="z-index:1;vertical-align: ce;vertical-align: middle;">Created by&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          </th>
                                          <th class="fontCustom"
                                                 style="z-index:1;vertical-align: ce;vertical-align: middle;">Modified date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          </th>
                                          <th class="fontCustom"
                                                 style="z-index:1;vertical-align: ce;vertical-align: middle;">Modified by&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          </th>
                                          <th class="fontCustom"
                                                 style="z-index:1;vertical-align: ce;vertical-align: middle;">Request status&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="CreateForm">
       <div class="modal-dialog modal-belakang modal-bgkpi" role="document">
              <div class="modal-content">
                     <div class="modal-header">
                            <h4 class="modal-title">Add Individual Performance Plan</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">
                            <script type="text/javascript">
                                   $(document).ready(function(){
                                          $('#tombol').click(function(){
                                                 // $('#mymodal_search , #bg').fadeIn("slow");
                                                 $('#mymodal_search').fadeIn("slow");
                                                 $('#mymodal_SPV_search').fadeIn("slow");
                                          });
                                          $('#tombol-tutup').click(function(){
                                                 // $('#mymodal_search , #bg').fadeOut("slow");
                                                 $('#mymodal_search').fadeOut("slow");
                                                 $('#mymodal_SPV_search').fadeOut("slow");
                                          });
                                   });
                                   function myFunctionForClose() {
                                          document.getElementById("mymodal_search").style.display = "none";
                                          document.getElementById("mymodal_SPV_search").style.display = "none";
                                   }
                            </script>
                            <script type="text/javascript">
                                   $(document).ready(function(){
                                          $('#tombolSPV').click(function(){
                                                 // $('#mymodal_search , #bg').fadeIn("slow");
                                                 $('#mymodal_search').fadeIn("slow");
                                                 $('#mymodal_SPV_search').fadeIn("slow");
                                          });
                                          $('#tombol-tutup').click(function(){
                                                 // $('#mymodal_search , #bg').fadeOut("slow");
                                                 $('#mymodal_search').fadeOut("slow");
                                                 $('#mymodal_SPV_search').fadeOut("slow");
                                          });
                                   });
                                   function myFunctionForClose() {
                                          document.getElementById("mymodal_search").style.display = "none";
                                          document.getElementById("mymodal_SPV_search").style.display = "none";
                                   }
                            </script>

                     <!-- The modals -->
                     <div id="mymodal_search" class="modals" style="display: none;z-index: 9999;">
                            <div class="modals-content" style="margin-top: -50px;">
                                                 
                                   <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">
                                          <div class="form-row">
                                                 <div class="col-sm-12">
                                                               <div class="input-group">
                                                                      <button class="btn btn-warning" type="submit"  data-toggle="modal"
                                                                             data-target="#CreateFormSPVUP" id="CreateButtonSPVUP2" name="submit_add_SPVUP" id="submit_add_SPVUP">
                                                                             Switch mode
                                                                      </button>
                                                               </div>
                                                        </div>
                                                 </div>
                                                 <table width="100%">
                                                 
                                                 <div class="form-row">
                                                        <div class="col-sm-8">
                                                               <div class="input-group">
                                                                      <?php
                                                                             include '../../model/gen_auth_data/_auth_data.php';
                                                                             $data = mysqli_query($connect, "SELECT
                                                                                                                b.*,
                                                                                                                a.emp_no,
                                                                                                                CASE 
                                                                                                                       WHEN a.period_type = '1' THEN 'data-toggle=modal data-target=#CreateFormSPVUP id=CreateButtonSPVUP2 data-dismiss=modal aria-hidden=true'
                                                                                                                ELSE ''
                                                                                                                END AS use_form,
                                                                                                                CASE 
                                                                                                                       WHEN a.period_type = '1' THEN 'myFunctionSpvUP'
                                                                                                                ELSE 'myFunctionSpvdown'
                                                                                                                END AS use_function

                                                                                                                FROM hrdperf_set_period a
                                                                                                                LEFT JOIN view_employee b ON a.emp_no=b.emp_no WHERE $conversion
                                                                                                                AND a.period_type = '2'
                                                                                                                AND b.emp_no <> '$username'
                                                                                                                ");
                                                                             while ($row = mysqli_fetch_array($data)) { ?>

                                                                                    <tr>
                                                                                           <td>
                                                                                                  <input type="radio" <?php echo $row['use_form'] ?> onclick="<?php echo $row['use_function'] ?><?php echo $row['position_id'] ?>()" name="numberInput" id="<?php echo $row['position_id'] ?>" value="<?php echo $row['Full_Name'] ?> [ <?php echo $row['emp_no'] ?> ]">
                                                                                                  <?php
                                                                                                         echo "<script>
                                                                                                                       function myFunctionSpvdown$row[position_id]() {
                                                                                                                       tokenAmount = document.getElementById('$row[position_id]').value;
                                                                                                                              elements1 = document.getElementById('mymodal_search');
                                                                                                                              elements1.style.display = 'none';
                                                                                                                              elements2 = document.getElementById('mymodal_SPV_search');
                                                                                                                              elements2.style.display = 'none';
                                                                                                                              $('#box_sp_up').hide();
                                                                                                                              $('#box_sp_down').hide();
                                                                                                                       document.getElementById('inp_SpvDonwManpower').value = tokenAmount;
                                                                                                                       return
                                                                                                                       }
                                                                                                         </script>";
                                                                                                  ?>
                                                                                                  <img width="30px" src="../../asset/emp_photos/<?php echo $row['photo'] ?>" alt="gthris apps">
                                                                                                  <br><label for="<?php echo $row['emp_no'] ?>"><?php echo $row['Full_Name'] ?> [ <?php echo $row['emp_no'] ?> ] </label><br>
                                                                                           </td>
                                                                                    </tr>
                                                                      <?php } ?>
                                                        
                                                               </div>
                                                        </div>
                                                 </div>    
                                          </table> 
                                    </div>
                            </div>
                     </div>
                     <!-- The modals -->

                     <form class="form-horizontal" action="php_action/FuncDataCreate.php" method="POST" id="FormDisplayCreate">

                            <fieldset id="fset_1">
                                   <legend>&nbsp;Employee Information&nbsp;</legend>

                                   <div class="messages_create"></div>

                                   <input id="inp_emp_no" name="inp_emp_no" type="hidden" value="<?php echo $username; ?>"><!--FROM SESSION -->
                                   <input id="inp_token" name="inp_token" type="hidden" value="<?php echo $get_token; ?>"><!--FROM CONFIGURATION -->

                                   <div class="form-row">
                                          <div class="col-4 name">Employee <span class="required">*</span></div>
                                          
                                          <div class="col-sm-7 name">
                                                 <div class="input-group">
                                                        <a id="tombol"><img width="15px" src="../../asset/img/icon_user.png" style="margin-left: -3px;"></a>
                                                        <input type="text" value="" style="width: 70%;font-size: 11px;border: 1px solid #aaa6a6;border-radius: 8px;height: 20px;width: 256px;padding-left: 10px;background: #1e88e521;" readonly name="inp_SpvDonwManpower" id="inp_SpvDonwManpower">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name">KPI Period <span class="required">*</span></div>
                                          <div class="col-sm-8 name">
                                                 <div class="input-group">
                                                        Performance 2021
                                                 </div>
                                          </div>
                                   </div>

                                    <div class="form-row">
                                          <div class="col-4 name"></div>
                                          <div class="col-sm-8 name">
                                                 <div class="input-group">
                                                        <a type="submit" name="show_detail_for_spv_down" id="show_detail_for_spv_down" style="color: white;background: #8d8d93;font-size: 12px;" class="btn btn-primary">
                                                               Show detail
                                                        </a>
                                                 </div>
                                          </div>
                                   </div>
                                   </fieldset>

                                  
                                                        
                                   <!-- pages relation -->
                                   <div id="box_sp_down"></div>
                                   <!-- pages relation -->
                                                        

                              
                            </div>
                            </fieldset>

                            <div class="modal-footer">
                                   <button type="reset" class="btn btn-primary1" data-dismiss="modal" 
                                          aria-hidden="true">
                                          &nbsp;Cancel&nbsp;
                                   </button>
                                   <button class="btn btn-warning" type="submit" name="submit_request_spv_down" id="submit_request_spv_down">
                                          Confirm
                                   </button>
                                   <button class="btn btn-warning" type="button" name="submit_request_spv_down2"
                                          id="submit_request_spv_down2" style='display:none;' disabled>
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











































<!-- add modal -->
<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="CreateFormSPVUP">
       <div class="modal-dialog modal-belakang modal-bgkpi" role="document">
              <div class="modal-content">
                     <div class="modal-header">
                            <h4 class="modal-title">Add Individual Performance Plan [ FOR Suvervisory UP]</h4>
                            <button type="button" class="close" onclick='return stopload();' data-dismiss="modal"
                                   aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true">&times;</span>
                            </button>
                     </div>
                     

                     <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

                     <!-- The modals -->
                     <div id="mymodal_SPV_search" class="modals" style="display:none;z-index: 9999;">
                   
                            <div class="modals-content" style="margin-top: -50px;">
                                                 
                                   <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">
                                                 <div class="form-row">
                                                        <div class="col-sm-12">
                                                               <div class="input-group">
                                                                      <button class="btn btn-warning" type="submit"  data-toggle="modal"
                                                                             data-target="#CreateForm" id="CreateButton2" name="submit_add" id="submit_add">
                                                                             Switch mode
                                                                      </button>
                                                               </div>
                                                        </div>
                                                 </div>
                                                 <table width="100%">
                                                 <div class="form-row">
                                                        <div class="col-sm-8">
                                                               <div class="input-group">
                                                                      <?php
                                                                             include '../../model/gen_auth_data/_auth_data.php';
                                                                             $data = mysqli_query($connect, "SELECT
                                                                                                                b.*,
                                                                                                                a.emp_no,
                                                                                                                CASE 
                                                                                                                       WHEN a.period_type = '2' THEN 'data-toggle=modal data-target=#CreateForm id=CreateButton2 data-dismiss=modal aria-hidden=true'
                                                                                                                ELSE ''
                                                                                                                END AS use_form,
                                                                                                                CASE 
                                                                                                                       WHEN a.period_type = '1' THEN 'myFunctionSpvUP'
                                                                                                                ELSE 'myFunctionSpvdown'
                                                                                                                END AS use_function

                                                                                                                FROM hrdperf_set_period a
                                                                                                                LEFT JOIN view_employee b ON a.emp_no=b.emp_no WHERE $conversion
                                                                                                                AND a.period_type = '1'
                                                                                                                AND b.emp_no <> '$username'");
                                                                             while ($row = mysqli_fetch_array($data)) { ?>

                                                                                    <tr>
                                                                                           <td>
                                                                                                  <input type="radio" <?php echo $row['use_form'] ?> onclick="<?php echo $row['use_function'] ?><?php echo $row['position_id'] ?>()" name="numberInput" id="<?php echo $row['position_id'] ?>" value="<?php echo $row['Full_Name'] ?> [ <?php echo $row['emp_no'] ?> ]">
                                                                                                  <?php
                                                                                                         echo "<script>
                                                                                                                       function myFunctionSpvUP$row[position_id]() {
                                                                                                                       tokenAmount = document.getElementById('$row[position_id]').value;
                                                                                                                              elements1 = document.getElementById('mymodal_search');
                                                                                                                              elements1.style.display = 'none';
                                                                                                                              elements2 = document.getElementById('mymodal_SPV_search');
                                                                                                                              elements2.style.display = 'none';
                                                                                                                              $('#box_sp_up').hide();
                                                                                                                              $('#box_sp_down').hide();
                                                                                                                       document.getElementById('inp_SpvUPManpower').value = tokenAmount;
                                                                                                                       return
                                                                                                                       }
                                                                                                         </script>";
                                                                                                  ?>
                                                                                                  <img width="30px" src="../../asset/emp_photos/<?php echo $row['photo'] ?>" alt="gthris apps">
                                                                                                  <br><label for="<?php echo $row['emp_no'] ?>"><?php echo $row['Full_Name'] ?> [ <?php echo $row['emp_no'] ?> ] </label><br>
                                                                                           </td>
                                                                                    </tr>
                                                                      <?php } ?>
                                                        
                                                               </div>
                                                        </div>
                                                 </div>    
                                          </table> 
                                    </div>
                            </div>
                     </div>
                     <!-- The modals -->

                     <form class="form-horizontal" action="php_action/FuncDataCreateSPVUP.php" method="POST" id="FormDisplayCreateSPVUP">

                            <fieldset id="fset_1">
                                   <legend>&nbsp;Employee Information&nbsp;</legend>
                           
                                   <div class="messages_create_spv_up"></div>

                                   <input id="inp_emp_no" name="inp_emp_no" type="hidden" value="<?php echo $username; ?>"><!--FROM SESSION -->
                                   <input id="inp_token" name="inp_token" type="hidden" value="<?php echo $get_token; ?>"><!--FROM CONFIGURATION -->

                                   <div class="form-row">
                                          <div class="col-4 name">Employee <span class="required">*</span></div>
                                          <div class="col-sm-7 name">
                                                 <div class="input-group">
                                                        <a id="tombolSPV"><img width="15px" src="../../asset/img/icon_user.png" style="margin-left: -3px;"></a>
                                                     <input type="text" value="" style="width: 70%;font-size: 11px;border: 1px solid #aaa6a6;border-radius: 8px;height: 20px;width: 256px;padding-left: 10px;background: #1e88e521;" readonly name="inp_SpvUPManpower" id="inp_SpvUPManpower">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name">KPI Period <span class="required">*</span></div>
                                          <div class="col-sm-8 name">
                                                 <div class="input-group">
                                                        Performance 2021
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name"></div>
                                          <div class="col-sm-8 name">
                                                 <div class="input-group">
                                                        <a type="submit" name="show_detail_for_spv_up" id="show_detail_for_spv_up" style="color: white;background: #8d8d93;font-size: 12px;" class="btn btn-primary">
                                                               Show detail
                                                        </a>
                                                 </div>
                                          </div>
                                   </div>
                                   </fieldset>

                                   <!-- pages relation -->
                                   <div id="box_sp_up"></div>
                                   <!-- pages relation -->
  </div>
                            </fieldset>
                                   

                            <div class="modal-footer">
                                   <button type="reset" class="btn btn-primary1" 
                                          data-dismiss="modal" aria-hidden="true">
                                          &nbsp;Cancel&nbsp;
                                   </button>
                                   <button class="btn btn-warning" type="submit" name="submit_add_SPVUP" id="submit_add_SPVUP">
                                          Confirm
                                   </button>
                                   <button class="btn btn-warning" type="button" name="submit_add_SPVUP2"
                                          id="submit_add_SPVUP2" style='display:none;' disabled>
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







































<!-- add modal -->
<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="FormDisplayDelete">
              <div class="modal-dialog modal-belakang modal-bs modal-bgkpi" role="document">
              <div class="modal-content">
                     <div class="modal-header">
                            <h4 class="modal-title">Individual Performance Plan</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal"
                                   aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true">&times;</span>
                                                                                                                </a>
                     </div>

                     <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

                     <form class="form-horizontal" action="php_action/FuncDataUpdate.php" method="POST" id="updatedelMemberForm" onkeydown="return event.key != 'Enter';">

                            <fieldset id="fset_1">
                                   <legend>&nbsp;Employee Information&nbsp;</legend>

                                   <div class="messages_create"></div>

                                   <input id="sel_emp_no_approver" name="sel_emp_no_approver" type="hidden" value="<?php echo $username; ?>"><!--FROM SESSION -->
                             
                                   <div class="form-row">
                                          <div class="col-4 name"> Perormance Period <span class="required">*</span></div>
                                          <div class="col-sm-8 name">
                                                 <div class="input-group" id="sel_identity_pa_reqno" style="font-weight: bold;color: #5b5b5b;">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name"> Employee <span class="required">*</span></div>
                                          <div class="col-sm-4 name">
                                                 <div class="input-group" id="sel_identity_requester" style="font-weight: bold;color: #5b5b5b;">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row" style="display:none">
                                          <div class="col-4 name"> PP Detail <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_ipp_reqno_spv_downS" name="sel_ipp_reqno_spv_downS"
                                                               type="Text">
                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_ipp_requester_spv_downS" name="sel_ipp_requester_spv_downS"
                                                               type="Text">

                                                 </div>
                                          </div>
                                   </div>
                                   </fieldset>

                                   <fieldset id="fset_1">
                                   <legend>KPI Detail</legend>
                                                 <div class="card-body table-responsive p-0" style="width: 100%; height: 300px; margin: 1px;overflow: scroll;">
                                                        <!-- pages relation -->
                                                        <div id="box"></div>
                                                        <!-- pages relation -->
                                                 <div>
                                   </div>
                            </fieldset>

                     </div>
                           

                            <!-- //LOAD BUTTON APPROVER STATUS -->
                            <div class="modal-footer">
                                   <a type="reset" class="btn btn-primary1" style="background: #e1e1e1;" data-dismiss="modal"
                                          aria-hidden="true" data-backdrop="false">
                                          &nbsp;Cancel&nbsp;
                                                                                                                </a>
                                   <a style="<?php echo $button_status_hide_or_no; ?>; color: white;" class="btn btn-warning" name="submit_reject_spvdown" id="submit_reject_spvdown" data-backdrop="false" data-toggle="modal" data-target="#FormDisplayRejectspvdown">
                                          &nbsp;&nbsp;Cancel Request&nbsp;&nbsp;
                                   </a>
                            </div>
                            <!-- //LOAD BUTTON APPROVER STATUS -->
                     </form>
              </div>
       </div>
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /edit modal -->




























<!-- add modal -->
<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="FormDisplayApproverSPVUP">
              <div class="modal-dialog modal-belakang modal-bs modal-bgkpi" role="document">
              <div class="modal-content">
                     <div class="modal-header">
                            <h4 class="modal-title">Individual Performance Plan SPV UP</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal"
                                   aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true">&times;</span>
                                                                                                                </a>
                     </div>

                     <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

                     <form class="form-horizontal" action="php_action/FuncDataUpdateSPVUP.php" method="POST" id="updateApproveSPVUPMemberForm">

                            <fieldset id="fset_1">
                                   <legend>&nbsp;Employee Information&nbsp;</legend>

                                   <div class="messages_create"></div>

                                   <input id="sel_emp_no_approver" name="sel_emp_no_approver" type="hidden" value="<?php echo $username; ?>"><!--FROM SESSION -->
                             
                                   <div class="form-row">
                                          <div class="col-4 name"> Perormance Period <span class="required">*</span></div>
                                          <div class="col-sm-8 name">
                                                 <div class="input-group" id="sel_identity_spvup_pa_reqno" style="font-weight: bold;color: #5b5b5b;">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name"> Employee <span class="required">*</span></div>
                                          <div class="col-sm-4 name">
                                                 <div class="input-group" id="sel_identity_spvup_requester" style="font-weight: bold;color: #5b5b5b;">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row" style="display:none">
                                          <div class="col-4 name"> PP Detail <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_ipp_reqno_spv_upS" name="sel_ipp_reqno_spv_upS"
                                                               type="Text">
                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_ipp_requester_spv_upS" name="sel_ipp_requester_spv_upS"
                                                               type="Text">

                                                 </div>
                                          </div>
                                   </div>
                                   </fieldset>

                                   <fieldset id="fset_1">
                                   <legend>KPI Detail</legend>
                                                 <div class="card-body table-responsive p-0" style="width: 100%; margin: 1px;overflow: scroll;">
                                                        <!-- pages relation -->
                                                        <div id="box_spvup"></div>
                                                        <!-- pages relation -->
                                                 <div>
                                   </div>
                            </fieldset>

                            </div>

                            <!-- //LOAD BUTTON APPROVER STATUS -->
                            <div class="modal-footer">
                                   <a type="reset" class="btn btn-primary1" style="background: #e1e1e1;" data-dismiss="modal"
                                          aria-hidden="true" data-backdrop="false">
                                          &nbsp;Cancel&nbsp;
                                                                                                                </a>
                                   <a style="<?php echo $button_status_hide_or_no; ?>; color: white;" class="btn btn-warning" name="submit_reject_spvup" id="submit_reject_spvup" data-backdrop="false" data-toggle="modal" data-target="#FormDisplayRejectspvup">
                                          &nbsp;&nbsp;Cancel Request&nbsp;&nbsp;
                                   </a>
                            </div>
                            <!-- //LOAD BUTTON APPROVER STATUS -->
                     </form>
              </div>
       </div>
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /edit modal -->


































































<!-- edit modal -->
<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="FormDisplayRevised">
       <div class="modal-dialog modal-belakang modal-bgkpi" role="document">
              <div class="modal-content">
                     <div class="modal-header">
                            <h4 class="modal-title">Revised Individual Performance Plan</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 99%; margin: 5px;overflow: scroll;overflow-x: hidden;">

                     <!-- <form class="form-horizontal" action="php_action/FuncDataUpdate.php" method="POST" id="updateMemberForm"> -->
                     <form class="form-horizontal" action="php_action/FuncDataRevised.php" method="POST" id="updateFormDisplayRevised">

                            <fieldset id="fset_1">
                                   <legend>&nbsp;Request Information&nbsp;</legend>

                                   <div class="messages_create"></div>

                                   <input id="inp_emp_no" name="inp_emp_no" type="hidden" value="<?php echo $username; ?>"><!--FROM SESSION -->
                                   <input id="revised_request_no" name="revised_request_no" type="hiddens"><!--FROM SESSION -->
                                   <input id="revised_requester" name="revised_requester_spvdown" type="hiddens"><!--FROM SESSION -->
                                   <input id="inp_token" name="inp_token" type="hidden" value="<?php echo $get_token; ?>"><!--FROM CONFIGURATION -->

                                   <div class="form-row">
                                          <div class="col-4 name">Request No. <span class="required">*</span></div>
                                          
                                          <div class="col-sm-7 name">
                                                 <div class="input-group" id="revised_inp_sel_request_no">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name">Employee <span class="required">*</span></div>
                                          
                                          <div class="col-sm-7 name">
                                                 <div class="input-group" id="revised_inp_sel_employee">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name">KPI Period <span class="required">*</span></div>
                                          <div class="col-sm-8 name">
                                                 <div class="input-group" id="revised_inp_period">
                                                 </div>
                                          </div>
                                   </div>

                                   </fieldset>
                                                        
                                   <!-- pages relation -->
                                   <div id="revised_sp_down"></div>
                                   <!-- pages relation -->
                            </div>
                            </fieldset>

                            <div class="modal-footer">
                                   <button type="reset" class="btn btn-primary1" data-dismiss="modal"
                                          aria-hidden="true">
                                          &nbsp;Cancel&nbsp;
                                   </button>
                                   <button class="btn btn-warning" type="submit" name="submit_revised_spvdown" id="submit_revised_spvdown">
                                          Confirm
                                   </button>
                                   <button class="btn btn-warning" type="button" name="submit_revised_spvdown2"
                                          id="submit_revised_spvdown2" style='display:none;' disabled>
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
<div class="modal fade" tabindex="-1" role="dialog" id="FormDisplayRejectspvdown">

       <div class="modals-content" style="margin-top: 125px;border: 1px solid #dbd2d2;background: #fbfbfb;">  
      
	   
		<form class="form-horizontal" action="php_action/FuncDataCancelRequest.php" method="POST" id="updaterejectMemberFormspvdown">	      

		<div class="modal-body">      	
		  <div class="edit-messages"></div>
                
                <input id="sel_emp_no_approver" name="sel_emp_no_approver" type="hidden" value="<?php echo $username; ?>"><!--FROM SESSION -->

		  <table width="100%">
                     <tr><td align="center"><img src="../../asset/dist/img/sf-mola-mola.png" style="max-width: 90%;margin-top: 20px;"></td></tr>
                     </table>
                            <div class="form-group">
                                   <div class="col-sm-12">	
                                          <table width="100%"><td align="center"><label id="isi_sel_reject_spvdown">Are you sure to cancel request ?</label></td></table>		
                                          <input type="hidden" class="form-control input-report" id="sel_reject_spvdown" name="sel_reject_spvdown" placeholder="">
                                   </div>
                            </div>
				<div class="modal-footer-delete FormDisplayRejectSPVDOWN" style="text-align: center;padding-top: 20px;">
                                          <button type="reset" class="btn btn-primary1" style="background: #ececec;" data-dismiss="modal" aria-hidden="true">
                                                        &nbsp;Cancel&nbsp;
                                          </button>
                                          <button class="btn btn-warning" type="submit" name="submit_reject_spvdown1" id="submit_reject_spvdown1">
                                                 Confirm
                                          </button>
                                          <button class="btn btn-warning" type="button" name="submit_reject_spvdown2"
                                                 id="submit_reject_spvdown2" style='display:none;' disabled>
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
<div class="modal fade" tabindex="-1" role="dialog" id="FormDisplayRejectspvup">

                 <div class="modals-content" style="margin-top: 125px;border: 1px solid #dbd2d2;background: #fbfbfb;">  
      
	   
		<form class="form-horizontal" action="php_action/FuncDataCancelRequestSPVUP.php" method="POST" id="updaterejectMemberFormspvup">	      

		<div class="modal-body">      	
		  <div class="edit-messages"></div>
                
                <input id="sel_emp_no_approver" name="sel_emp_no_approver" type="hidden" value="<?php echo $username; ?>"><!--FROM SESSION -->

		  <table width="100%">
                     <tr><td align="center"><img src="../../asset/dist/img/sf-mola-mola.png" style="max-width: 90%;margin-top: 20px;"></td></tr>
                     </table>
                            <div class="form-group">
                                   <div class="col-sm-12">	
                                          <table width="100%"><td align="center"><label id="isi_sel_reject_spvup">Are you sure to cancel request ?</label></td></table>		
                                          <input type="hidden" class="form-control input-report" id="sel_reject_spvup" name="sel_reject_spvup" placeholder="">
                                   </div>
                            </div>
				<div class="modal-footer-delete FormDisplayRejectSPVUP" style="text-align: center;padding-top: 20px;">
                                          <button type="reset" class="btn btn-primary1" style="background: #ececec;" data-dismiss="modal" aria-hidden="true">
                                                        &nbsp;Cancel&nbsp;
                                          </button>
                                          <button class="btn btn-warning" type="submit" name="submit_reject_spvup" id="submit_reject_spvup">
                                                 Confirm
                                          </button>
                                          <button class="btn btn-warning" type="button" name="submit_reject_spvup2"
                                                 id="submit_reject_spvup2" style='display:none;' disabled>
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


<script type="text/javascript">
$(document).ready(function() {
       jQuery(document).delegate('a.add-record', 'click', function(e) {
              e.preventDefault();
              var content = jQuery('#sample_table tr'),
                     size = jQuery('#tbl_posts_spv_up >tbody >tr').length + 1,
                     element = null,
                     element = content.clone();
              element.attr('id', 'rec_spvup-' + size);
              element.find('.delete-record').attr('data-id', size);
              element.appendTo('#tbl_posts_spv_up_body');
              element.find('.sn').html(size);
       });
       jQuery(document).delegate('a.delete-record', 'click', function(e) {
              e.preventDefault();

              var id = jQuery(this).attr('data-id');
              var targetDiv = jQuery(this).attr('targetDiv');
              jQuery('#rec_spvup-' + id).remove();

              //regnerate index number on table
              $('#tbl_posts_spv_up_body tr').each(function(index) {
                     $(this).find('span.sn').html(index + 1);
              });
              return true;

       });
});
</script>














<!-- isi JSON -->
<script type="text/javascript">
// global the manage memeber table 
$(document).ready(function() {
       $("#CreateButton, #CreateButton2").on('click', function() {

              $('#FormDisplayCreateSPVUP').modal('hide');
              $("[data-dismiss=modal]").trigger({type: "click"}); 

              // reset the form 
              $("#FormDisplayCreate")[0].reset();

              $('#show_detail_for_spv_down').click(function(){

                     mymodalss.style.display = "block";
                    
                     var key_spv_down = document.getElementById("inp_SpvDonwManpower").value;

                     var key_value_after_substring_spv_down = key_spv_down.slice(-9,-2);

                     $("#box_sp_down").load("pages_relation/_pages_approval_spvdown.php?rfid=" + key_value_after_substring_spv_down, 
                            function(responseTxt, statusTxt, jqXHR){
                                   if(statusTxt == "success"){
                                          $("#box_sp_down").show();
                                          mymodalss.style.display = "none";
                                   }
                                   if(statusTxt == "error"){
                                          alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                          mymodalss.style.display = "none";
                                   }
                            }
                     );
              });

              // submit form
              $("#FormDisplayCreate").unbind('submit').bind('submit', function() {

                     var form = $(this);

                     var inp_SpvDonwManpower = $("#inp_SpvDonwManpower").val();
                     var total_request_spv_down = $("#total_request_spv_down").val();
                     var inp_attitude0 = [];
                     var inp_attitude1 = [];
                     var inp_attitude2 = [];
                     var inp_attitude3 = [];
                     var inp_attitude4 = [];
                  
                     var regex=/^[a-zA-Z]+$/;
                  
                     if (inp_SpvDonwManpower == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Please select employee";
                            mymodalss.style.display = "none";
                            return false;

                     } else if (total_request_spv_down != '100') {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Bobot (B) must be equal 100%";
                            mymodalss.style.display = "none";
                            return false;

                     } else if (total_request_spv_down > '100') {
                            modals.style.display ="block"; be
                            document.getElementById("msg").innerHTML = "Bobot (B) can`t be greater than 100%";
                            mymodalss.style.display = "none";
                            return false;
                     
                     } else {
                            $('#submit_request_spv_down').hide();
                            $('#submit_request_spv_down2').show();
                            mymodalss.style.display = "block";
                     }

                     if (inp_SpvDonwManpower && total_request_spv_down) {

                            //submi the form to server
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

                                          if (response.code =='success_message_spv_down') {
                                           
                                                 $('#submit_request_spv_down').show();
                                                 $('#submit_request_spv_down2').hide();

                                                 $("#box_sp_up").hide();
                                                 $("#box_sp_down").hide();

                                                 $('#CreateForm').modal('hide');
                                                 $('#FormDisplayCreateSPVUP').modal('hide');
                                                 $("[data-dismiss=modal]").trigger({type: "click"});

                                                 document.getElementById("bods").style.paddingRight = "0px"; 

                                                 // reset the form
                                                 $("#FormDisplayCreate")[0].reset();
                                                 // reload the datatables
                                                 datatable.ajax.reload(null,false);
                                                 // this function is built in function of datatables;

                                                 mymodalss.style.display = "none";
                                                 modals.style.display ="block";
                                                 document.getElementById("msg").innerHTML = response.messages;

                                          } else {

                                                 $('#submit_request_spv_down').show();
                                                 $('#submit_request_spv_down2').hide();

                                                 $("#box_sp_up").hide();
                                                 $("#box_sp_down").hide();

                                                 mymodalss.style.display = "none";
                                                 modals.style.display ="block";
                                                 document.getElementById("msg").innerHTML = response.messages;
                                          } // /else
                                   } // success  
                            }); // ajax subit 				
                     } /// if
                     return false;
              }); // /submit form for create member
       }); // /add modal
});































  
                     
                            
                                   
                                
                                   
                                 
               
                   
            






// global the manage memeber table 
$(document).ready(function() {
       $("#CreateButtonSPVUP, #CreateButtonSPVUP2").on('click', function() {

              $("#tbl_posts_spv_up > tbody > .reset-delete-record-spv-up").html("");

              $('#FormDisplayCreate').modal('hide');
              $("[data-dismiss=modal]").trigger({type: "click"}); 
             
              // reset the form 
              $("#FormDisplayCreateSPVUP")[0].reset();
              $("#FormDisplayCreateSPVUP")[0].reset();

              // empty the message div
              $(".messages_create_spv_up").html("");

              $('#show_detail_for_spv_up').click(function(){

                     mymodalss.style.display = "block";
                    
                     var key_spv_down = document.getElementById("inp_SpvUPManpower").value;

                     var key_value_after_substring_spv_up = key_spv_down.slice(-9,-2);

                     $("#box_sp_up").load("pages_relation/_pages_approval_spvup.php?rfid=" + key_value_after_substring_spv_up, 
                            function(responseTxt, statusTxt, jqXHR){
                                   if(statusTxt == "success"){
                                          $("#box_sp_up").show();
                                          mymodalss.style.display = "none";
                                   }
                                   if(statusTxt == "error"){
                                          alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                          mymodalss.style.display = "none";
                                   }
                            }
                     );
              });

              // submit form
              $("#FormDisplayCreateSPVUP").unbind('submit').bind('submit', function() {

              mymodalss.style.display = "block";

                     $(".text-danger").remove();

                     var form = $(this);

                     var inp_SpvUPManpower = $("#inp_SpvUPManpower").val();
                     var inp_performance0 = [];
                     var inp_performance1 = [];
                     var inp_performance2 = [];
                     var inp_performance3 = [];
                     var inp_performance4 = [];
                     var inp_performance5 = [];
                     var inp_performance6 = [];
                     var inp_performance7 = [];
                     var inp_performance8 = [];
                     var inp_performance9 = [];
                  
                     var regex=/^[a-zA-Z]+$/;
                     
                     if (inp_SpvUPManpower == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Please select employee";
                            mymodalss.style.display = "none";
                     } else {
                            $('#submit_add_SPVUP').hide();
                            $('#submit_add_SPVUP2').show();
                            mymodalss.style.display = "none";
                     }

                     if (inp_SpvUPManpower) {

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

                                          if (response.code =='success_message_spv_up') {
                                           
                                                 $('#submit_add_SPVUP').show();
                                                 $('#submit_add_SPVUP2').hide();

                                                 $("#box_sp_up").hide();
                                                 $("#box_sp_down").hide();

                                                 $('#FormDisplayCreateSPVUP').modal('hide');
                                                 $("[data-dismiss=modal]").trigger({type: "click"});

                                                 $("#tbl_posts_second > tbody > .reset-delete-record").html("");
                                                 $("#tbl_posts_body > tbody > .reset-delete-record").html("");

                                                 // reset the form
                                                 $("#FormDisplayCreateSPVUP")[0].reset();
                                                 // reload the datatables
                                                 datatable.ajax.reload(null,false);
                                                 // this function is built in function of datatables;

                                                 mymodalss.style.display = "none";
                                                 modals.style.display ="block";
                                                 document.getElementById("msg").innerHTML = response.messages;

                                          } else {

                                                 $('#submit_add_SPVUP').show();
                                                 $('#submit_add_SPVUP2').hide();

                                                 $("#box_sp_up").hide();
                                                 $("#box_sp_down").hide();

                                                 mymodalss.style.display = "none";
                                                 modals.style.display ="block";
                                                 document.getElementById("msg").innerHTML = response.messages;
                                          } // /else
                                   } // success  
                            }); // ajax subit 				
                     } /// if
                     return false;
              }); // /submit form for create member
       }); // /add modal
});


































// REVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISED
// REVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISED

function editRevisedMember(id = null) {
	if(id) {
              mymodalss.style.display = "block";
		// remove the error 
		$(".form-group").removeClass('has-error').removeClass('has-success');
		$(".text-danger").remove();
		// empty the message div
		$(".edit-messages").html("");
		$("#member_id").remove();

              

		// fetch the member data
		$.ajax({
			url: 'php_action/getSelectedEmployee.php',
			type: 'post',
			data: {member_id : id},
			dataType: 'json',
			success:function(response) {

                            mymodalss.style.display = "none";

                            document.getElementById("revised_inp_sel_request_no").innerHTML = response.pa_reqno;
                            document.getElementById("revised_inp_sel_employee").innerHTML = response.Full_Name + ' [' +response.requester + ']';
                            document.getElementById("revised_inp_period").innerHTML = response.period_name;
                            $("#revised_request_no").val(response.pa_reqno);
                            $("#revised_requester").val(response.requester);
                            
                            $("#revised_sp_down").load("pages_relation/_pages_revisedfor_spvdown.php?rfid=" + response.pa_reqno, 
                                   function(responseTxt, statusTxt, jqXHR){
                                          if(statusTxt == "success"){
                                                 $("#revised_sp_down").show();
                                                 mymodalss.style.display = "none";
                                          }
                                          if(statusTxt == "error"){
                                                 alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                                 mymodalss.style.display = "none";
                                          }
                                   }
                            );
                            

				// mmeber id 
				$(".FormDisplayRevised").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');

				// here update the member data
				$("#updateFormDisplayRevised").unbind('submit').bind('submit', function() {

                                   mymodalss.style.display = "block";

					// remove error messages
					$(".text-danger").remove();

					var form = $(this);

					// validation
					var revised_request_no = $("#revised_request_no").val();
                                   var inp_attitude_revised0 = [];
                                   var inp_attitude_revised1 = [];
                                   var inp_attitude_revised2 = [];
                                   var inp_attitude_revised3 = [];
                                   var inp_attitude_revised4 = [];

					if(revised_request_no == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "There is some error";
                                   } else {
                                          $('#submit_revised_spvdown').hide();
                                          $('#submit_revised_spvdown2').show();
                                   }


					if(revised_request_no) {


						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {
								if (response.code == 'success_message_revised_spv_down') {

                                                               $('#submit_revised_spvdown').show();
                                                               $('#submit_revised_spvdown2').hide();                                                             

                                                               // reload the datatables
                                                               datatable.ajax.reload(null,false);
                                                               // reload the datatables

                                                               $('#FormDisplayRevised').hide();  
                                                               $('#FormDisplayRevised').modal('hide');

                                                               $("[data-dismiss=modal]").trigger({type: "click"});

                                                               mymodalss.style.display = "none";
                                                               modals.style.display = "block";
                                                               document.getElementById("msg").innerHTML = response.messages;
                                                               
                                                        } else {
                                                               // reload the datatables

                                                               $('#submit_revised_spvdown').show();
                                                               $('#submit_revised_spvdown2').hide();

                                                               mymodalss.style.display = "none";
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
// REVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISED
// REVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISEDREVISED






































function editdelMember(id = null) {

       mymodalss.style.display = "block";
       
	if(id) {

		$.ajax({
			url: 'php_action/getSelectedEmployee.php',
			type: 'post',
			data: {member_id : id},
			dataType: 'json',
			success:function(response) {

                            

                            document.getElementById("sel_identity_pa_reqno").innerHTML = response.pa_reqno;
                            document.getElementById("sel_identity_requester").innerHTML = response.Full_Name + " ("+response.requester+") "; 
                            
                            // document.getElementsByTagName("harusdiselipin").setAttribute("class", "democlass"); 
                            $("#submit_reject_spvdown").attr("onclick", "editreject_spvdown_request(`" + response.pa_reqno + "`)");
                            $("#submit_revision_spvdown").attr("onclick", "editrevision_spvdown_request(`" + response.pa_reqno + "`)");
                            // onclick="editrejectrequest(`PAREQ2022-130299`)"

				$("#sel_ipp_reqno_spv_downS").val(response.pa_reqno);
                            $("#sel_ipp_requester_spv_downS").val(response.requester);
                            // $("#sel_remark_from_approver").val(response.remark);

                            $("#box").load("pages_relation/_pages_form_spvdown.php?rfid=" + response.pa_reqno,
                                   function(responseTxt, statusTxt, jqXHR){
                                          if(statusTxt == "success"){
                                                 $("#box").show();
                                          }
                                          if(statusTxt == "error"){
                                                 alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                          }
                                   }
                            );

                            var request_number_for_cancel_spv_down = response.pa_reqno;
                           
                            $.ajax({
                                   url: 'php_action/getRequestStatus.php',
                                   type: 'post',
                                   data: {request_no_spvdown : request_number_for_cancel_spv_down},
                                   dataType: 'json',
                                   success:function(response) {
                                                 
                                                 mymodalss.style.display = "none";

                                                 var fill_is_approved_spvdown = response.is_approved_spvdown;
                                                
                                                 if(fill_is_approved_spvdown == 0){ //jika sudah approve request
                                                        document.getElementById("submit_reject_spvdown").style.display = "none";
                                                        document.getElementById("submit_revision_spvdown").style.display = "none";
                                                        document.getElementById("submit_approval_spvdown").style.display = "none";
                                                 } else {
                                                        document.getElementById("submit_reject_spvdown").style.display = "block";
                                                        document.getElementById("submit_revision_spvdown").style.display = "block";
                                                        document.getElementById("submit_approval_spvdown").style.display = "block";
                                                 }
                                          }
					}); // /ajax

				// mmeber id 
				$(".FormDisplayDelete").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');

				// here update the member data
				$("#updatedelMemberForm").unbind('submit').bind('submit', function() {

                                   mymodalss.style.display = "block";
                                  
					// remove error messages
					$(".text-danger").remove();

					var form = $(this);

					// validation
					var sel_ipp_reqno_spv_downS = $("#sel_ipp_reqno_spv_downS").val();
                                   var sel_ipp_requester_spv_downS = $("#sel_ipp_reqno_spv_downS").val();

					if(sel_ipp_reqno_spv_downS == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "There is some error";
                                   } else if(sel_ipp_requester_spv_downS == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "There is some error";
                                   } else {
                                          $('#submit_approval_spvdown').hide();
                                          $('#submit_approval_spvdown2').show();
                                   }

					if(sel_ipp_reqno_spv_downS && sel_ipp_requester_spv_downS) {


						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {
								if (response.code == 'success_message_approved_spv_down') {

                                                               

                                                               $('#submit_approval_spvdown').show();
                                                               $('#submit_approval_spvdown2').hide();    
                                                               
                                                               mymodalss.style.display = "none";

                                                               // reload the datatables
                                                               datatable.ajax.reload(null,false);
                                                               // reload the datatables

                                                               $('#FormDisplayDelete').modal('hide');
                                                      
                                                               $("[data-dismiss=modal]").trigger({type: "click"});

                                                               modals.style.display = "block";
                                                               document.getElementById("msg").innerHTML = response.messages;

                                                               
                                                               
                                                        } else {
                                                               $('#submit_approval_spvdown').show();
                                                               $('#submit_approval_spvdown2').hide();

                                                               mymodalss.style.display = "none";

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





































function editApprovalSPVUPMember(id = null) {

       mymodalss.style.display = "block";
       
	if(id) {

		$.ajax({
			url: 'php_action/getSelectedEmployeeSPVUP.php',
			type: 'post',
			data: {member_id : id},
			dataType: 'json',
			success:function(response) {

                            document.getElementById("sel_identity_spvup_pa_reqno").innerHTML = response.ipp_reqno;
                            document.getElementById("sel_identity_spvup_requester").innerHTML = response.Full_Name + " ("+response.requester+") "; 
                            
                            // document.getElementsByTagName("harusdiselipin").setAttribute("class", "democlass"); 
                            $("#submit_reject_spvup").attr("onclick", "editreject_spvup_request(`" + response.ipp_reqno + "`)");
                            $("#submit_revision_spvup").attr("onclick", "editrevision_spvup_request(`" + response.ipp_reqno + "`)");
                            // onclick="editrejectrequest(`PAREQ2022-130299`)"

				$("#sel_ipp_reqno_spv_upS").val(response.ipp_reqno); 
                            $("#sel_ipp_requester_spv_upS").val(response.requester);
                            // $("#sel_remark_from_approver").val(response.remark);

                            $("#box_spvup").load("pages_relation/_pages_form_spvup.php?rfid=" + response.ipp_reqno, 
                                   function(responseTxt, statusTxt, jqXHR){
                                          if(statusTxt == "success"){
                                                 $("#box_spvup").show();
                                          }
                                          if(statusTxt == "error"){
                                                 alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                          }
                                   }
                            );

                            var request_number_for_cancel_spv_up = response.ipp_reqno;
                          
                            $.ajax({
                                   url: 'php_action/getRequestStatusSPVUP.php',
                                   type: 'post',
                                   data: {request_no_spvup : request_number_for_cancel_spv_up},
                                   dataType: 'json',
                                   success:function(response) {
                                                 
                                                 mymodalss.style.display = "none";

                                                 var fill_is_approved_spvup = response.is_approved_spvup;

                                                 if(fill_is_approved_spvup == 0){ //jika sudah approve request
                                                        document.getElementById("submit_reject_spvup").style.display = "none";
                                                        document.getElementById("submit_revision_spvup").style.display = "none";
                                                        document.getElementById("submit_approval_spvup").style.display = "none";
                                                 } else {
                                                        document.getElementById("submit_reject_spvup").style.display = "block";
                                                        document.getElementById("submit_revision_spvup").style.display = "block";
                                                        document.getElementById("submit_approval_spvup").style.display = "block";
                                                 }
                                          }
					}); // /ajax

				// mmeber id 
				$(".FormDisplayApproverSPVUP").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');

				// here update the member data
				$("#updateApproveSPVUPMemberForm").unbind('submit').bind('submit', function() {

                                   mymodalss.style.display = "block";
                                  
					// remove error messages
					$(".text-danger").remove();

					var form = $(this);

					// validation
					var sel_ipp_reqno_spv_upS = $("#sel_ipp_reqno_spv_upS").val();
                                   var sel_ipp_requester_spv_upS = $("#sel_ipp_reqno_spv_upS").val();

					if(sel_ipp_reqno_spv_upS == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "There is some error";
                                   } else if(sel_ipp_requester_spv_upS == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "There is some error";
                                   } else {
                                          $('#submit_approval_spvup').hide();
                                          $('#submit_approval_spvup2').show();
                                   }

					if(sel_ipp_reqno_spv_upS && sel_ipp_requester_spv_upS) {


						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {
								if (response.code == 'success_message_approved_spv_up') {

                                                               $('#submit_approval_spvup').show();
                                                               $('#submit_approval_spvup2').hide();    
                                                               
                                                               mymodalss.style.display = "none";

                                                               // reload the datatables
                                                               datatable.ajax.reload(null,false);
                                                               // reload the datatables

                                                               $('#FormDisplayApproverSPVUP').modal('hide');
                                                      
                                                               $("[data-dismiss=modal]").trigger({type: "click"});

                                                               modals.style.display = "block";
                                                               document.getElementById("msg").innerHTML = response.messages;

                                                               
                                                               
                                                        } else {
                                                               $('#submit_approval_spvup').show();
                                                               $('#submit_approval_spvup2').hide();

                                                               mymodalss.style.display = "none";

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



































function editdelMemberSPVUP(id = null) {
	if(id) {

              mymodalss.style.display = "block";

		// remove the error 
		$(".form-group").removeClass('has-error').removeClass('has-success');
		$(".text-danger").remove();
		// empty the message div
		$(".edit-messages").html("");

		// remove the id
		$("#member_id").remove();

		// fetch the member data
		$.ajax({
			url: 'php_action/getSelectedEmployeeSPVUP.php',
			type: 'post',
			data: {member_id : id},
			dataType: 'json',
			success:function(response) {

                            mymodalss.style.display = "none";

				$("#sel_ipp_reqnoS").val(response.ipp_reqno);

				// mmeber id 
				$(".FormDisplayDeleteSPVUP").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');

				// here update the member data
				$("#updatedelMemberFormSPVUP").unbind('submit').bind('submit', function() {

                                   mymodalss.style.display = "block";

					// remove error messages
					$(".text-danger").remove();

					var form = $(this);

					// validation
					var sel_ipp_reqnoS = $("#sel_ipp_reqnoS").val();

					if(sel_ipp_reqnoS == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "Item code cannot empty";
                                   } else {
                                          $('#submit_delete').hide();
                                          $('#submit_delete2').show();
                                   }


					if(sel_ipp_reqnoS) {
						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {
								if (response.code == 'success_message_delete_spv_up') {
                                                               $('#submit_delete').show();
                                                               $('#submit_delete2').hide();                                                             

                                                               // reload the datatables
                                                               datatable.ajax.reload(null,false);
                                                               // reload the datatables
                                                               
                                                               $('#FormDisplayDeleteSPVUP').modal('hide');
                                                               $("[data-dismiss=modal]").trigger({type: "click"});

                                                               mymodalss.style.display = "none";
                                                               modals.style.display = "block";
                                                               document.getElementById("msg").innerHTML = response.messages;
                                                        } else {
                                                               $('#submit_delete').show();
                                                               $('#submit_delete2').hide();   

                                                               mymodalss.style.display = "none";
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








































// editreject_spvdown_request
function editreject_spvdown_request(id = null) {

       mymodalss.style.display = "block";

	if(id) {
		// fetch the member data
		$.ajax({
			url: 'php_action/getSelectedEmployee.php',
			type: 'post',
			data: {member_id : id},
			dataType: 'json',
			success:function(response) {

                            mymodalss.style.display = "none";

                            document.getElementById("isi_sel_reject_spvdown").innerHTML = "Are you sure to cancel request "+response.pa_reqno+ " ?";

				$("#sel_reject_spvdown").val(response.pa_reqno);

				// mmeber id 
				$(".FormDisplayRejectspvdown").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');

				// here update the member data
				$("#updaterejectMemberFormspvdown").unbind('submit').bind('submit', function() {

					var form = $(this);

					// validation
					var sel_reject_spvdown = $("#sel_reject_spvdown").val();
           
					if(sel_reject_spvdown == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "There is some error";
                                   } else {
                                          $('#submit_reject_spvdown1').hide();
                                          $('#submit_reject_spvdown2').show();
                                   }


					if(sel_reject_spvdown) {

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {
								if (response.code == 'success_message_cancel_spv_down') {

                                                               $('#submit_reject_spvdown1').show();
                                                               $('#submit_reject_spvdown2').hide();                                      

                                                               // reload the datatables
                                                               datatable.ajax.reload(null,false);
                                                               // reload the datatables

                                                               $('#FormDisplayRejectspvdown').hide();  
                                                               // $('#FormDisplayDelete').modal('hide');
                                                               
                                                               $("[data-dismiss=modal]").trigger({type: "click"});

                                                               modals.style.display = "block";
                                                               document.getElementById("msg").innerHTML = response.messages;
                                                               
                                                        } else {
                                                               // reload the datatables

                                                               $('#submit_reject_spvdown1').show();
                                                               $('#submit_reject_spvdown2').hide();         

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

























  
                     
                            
                                   
                                
                                   
                                 
               
                   
            



// editreject_spvdown_request
function editreject_spvup_request(id = null) {

       mymodalss.style.display = "block";

	if(id) {
		// fetch the member data
		$.ajax({
			url: 'php_action/getSelectedEmployeeSPVUP.php',
			type: 'post',
			data: {member_id : id},
			dataType: 'json',
			success:function(response) {

                            mymodalss.style.display = "none";

                            document.getElementById("isi_sel_reject_spvup").innerHTML = "Are you sure to cancel request "+response.ipp_reqno+ " ?";

				$("#sel_reject_spvup").val(response.ipp_reqno);

				// mmeber id 
				$(".FormDisplayRejectspvup").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');

				// here update the member data
				$("#updaterejectMemberFormspvup").unbind('submit').bind('submit', function() {

					var form = $(this);

					// validation
					var sel_reject_spvup = $("#sel_reject_spvup").val();
           
					if(sel_reject_spvup == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "There is some error";
                                   } else {
                                          $('#submit_reject_spvup1').hide();
                                          $('#submit_reject_spvup2').show();
                                   }


					if(sel_reject_spvup) {

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {
								if (response.code == 'success_message_cancel_spv_up') {

                                                               $('#submit_reject_spvup1').show();
                                                               $('#submit_reject_spvup2').hide();                                      

                                                               // reload the datatables
                                                               datatable.ajax.reload(null,false);
                                                               // reload the datatables

                                                               $('#FormDisplayRejectspvup').hide();  
                                                               // $('#FormDisplayDelete').modal('hide');
                                                               
                                                               $("[data-dismiss=modal]").trigger({type: "click"});

                                                               modals.style.display = "block";
                                                               document.getElementById("msg").innerHTML = response.messages;
                                                               
                                                        } else {
                                                               // reload the datatables

                                                               $('#submit_reject_spvup1').show();
                                                               $('#submit_reject_spvup2').hide();         

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