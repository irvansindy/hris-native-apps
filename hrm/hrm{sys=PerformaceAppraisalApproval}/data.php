<?php  
       $src_kpi_no                        = '';
       $src_employee_no                    = '';
       $src_request_status                = '';
       $code_print                        = '';
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
                                                        <div class="col-4 name">KPI Code</div>
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
                                                                             <?php
                                                                                    $sql = mysqli_query($connect,"SELECT code, name_en FROM hrmstatus WHERE code IN ('0','1','2','3','4','5','8','10')");
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
<script type="text/javascript" src="../../asset/sdk_datatables_core/datatables/bedanihbuatjson/bootstrap/js/bootstrap.min.js"></script>
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
                     <h4 class="card-title mb-0"> Performance Appraisal Approval</h4>
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
                                   <!-- AgusPrass 02/03/2021 Menghapus # pada href-->
                                   <td>
                                          <div class="toolbar sprite-toolbar-reload" id="RELOAD" title="Reload"
                                                 onclick="RefreshPage();">
                                          </div>
                                   </td>
                                   <!-- AgusPrass 02/03/2021 -->
                            </table>
                     </div>
              </div>

              <div class="card-body table-responsive p-0" style="width: 100vw;height: 78vh; width: 98.4%; margin: 5px;overflow: scroll;">
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
                                                 style="z-index:1;vertical-align: ce;vertical-align: middle;">Appraisal status&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
                            <h4 class="modal-title">Performance Appraisal Approval</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98.4%; margin: 5px;overflow: scroll;overflow-x: hidden;">
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
                                                 
                                   <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98.4%; margin: 5px;overflow: scroll;overflow-x: hidden;">
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
                                                                                                                ELSE 'myFunctionspvup'
                                                                                                                END AS use_function

                                                                                                                FROM hrdperf_set_period a
                                                                                                                LEFT JOIN view_employee b ON a.emp_no=b.emp_no WHERE $conversion
                                                                                                                AND a.period_type = '2'
                                                                                                                ");
                                                                             while ($row = mysqli_fetch_array($data)) { ?>

                                                                                    <tr>
                                                                                           <td>
                                                                                                  <input type="radio" <?php echo $row['use_form'] ?> onclick="<?php echo $row['use_function'] ?><?php echo $row['position_id'] ?>()" name="numberInput" id="<?php echo $row['position_id'] ?>" value="<?php echo $row['Full_Name'] ?> [ <?php echo $row['emp_no'] ?> ]">
                                                                                                  <?php
                                                                                                         echo "<script>
                                                                                                                       function myFunctionspvup$row[position_id]() {
                                                                                                                       tokenAmount = document.getElementById('$row[position_id]').value;
                                                                                                                              elements1 = document.getElementById('mymodal_search');
                                                                                                                              elements1.style.display = 'none';
                                                                                                                              elements2 = document.getElementById('mymodal_SPV_search');
                                                                                                                              elements2.style.display = 'none';
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
                                                        <input type="text" value="<?php echo $nama; ?> [ <?php echo $username; ?> ]" style="width: 70%;font-size: 11px;border: 1px solid #aaa6a6;border-radius: 8px;height: 20px;width: 256px;padding-left: 10px;background: #1e88e521;" readonly name="inp_SpvDonwManpower" id="inp_SpvDonwManpower">
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

                                   </fieldset>

                                   <fieldset id="fset_1">
                                   <legend>KPI Detail</legend>
                                   <div class="card-body table-responsive p-0" style="width: 98.4%; height: 300px; margin: 1px;overflow: scroll;">
                                          <table class="table table-bordered table-hover table-head-fixed">
                                                 <thead>
                                                        <tr>
                                                               <th>No.</th>
                                                               <th>Attitude </th>
                                                               <th>Bobot (B)</th>
                                                               <th>Target</th>
                                                               <th>Target Mid Year</th>
                                                               <th>Full Year</th>
                                                        </tr>
                                                 </thead>
                                                 <tbody>
                                                        <?php
                                                               $row_no = 0;
                                                               $sql_attitude = mysqli_query($connect, "SELECT att_item,att_name FROM hrmperf_set_attitude");
                                                               $row_attitude = mysqli_num_rows($sql_attitude);
                                                                             while ($row_attitude = mysqli_fetch_array($sql_attitude)){
                                                                                    $row_no++ ;
                                                        ?>
                                                        <tr id="recs-1">
                                                               <td><?php echo $row_no; ?>.</td>
                                                               <td align="center"><select id="sel_currency_code" name="inp_attitude0[]" 
                                                                             onfocus="hlentry(this)" 
                                                                             onchange="formodified(this);" 
                                                                             style="width:undefined;width: 160px;border: 1px solid #cac2c2;text-align: left;color: #484545;">
                                                                             <option value="<?php echo $row_attitude['att_item']; ?>"><?php echo $row_attitude['att_name']; ?></option>
                                                                             <?php
                                                                             $sql = mysqli_query($connect, "SELECT att_item,att_name FROM hrmperf_set_attitude");
                                                                             $row = mysqli_num_rows($sql);
                                                                             while ($row = mysqli_fetch_array($sql)){
                                                                             echo "<option value='". $row['att_item'] ."'>" .$row['att_name'] ."</option>" ;
                                                                             }
                                                                             ?>
                                                                      </select></td>
                                                               <td align="center"><input type="text" autocomplete="off" id="spv_down<?php echo $row_no; ?>" onchange="addspv_down()" value="0" name="inp_attitude1[]" style="border: 1px solid #d7d7d7;text-align: right;"></td>
                                                               <td align="center"><textarea type="text" value="" name="inp_attitude2[]" style="border: 1px solid #d7d7d7;"></textarea></td>
                                                               <td align="center"><input type="text" autocomplete="off" value="" name="inp_attitude3[]" style="border: 1px solid #d7d7d7;text-align: right;"></td>
                                                               <td align="center"><input type="text" autocomplete="off" value="" name="inp_attitude4[]" style="border: 1px solid #d7d7d7;text-align: right;"></td>
                                                        </tr>
                                                        <script type='text/javascript'>
                                                               function addspv_down(){
                                                                      var spv_down1,spv_down2,spv_down3,spv_down4,spv_down5,spv_down6,spv_down7;    
                                                                      spv_down1 = document.getElementById('spv_down1').value;
                                                                      spv_down2 = document.getElementById('spv_down2').value;
                                                                      spv_down3 = document.getElementById('spv_down3').value;
                                                                      spv_down4 = document.getElementById('spv_down4').value;
                                                                      spv_down5 = document.getElementById('spv_down5').value;
                                                                      spv_down6 = document.getElementById('spv_down6').value;
                                                                      spv_down7 = document.getElementById('spv_down7').value;     
                                                                      spv_downTotal = 
                                                                                           parseFloat(spv_down1.replace(/,/g, '')) + 
                                                                                           parseFloat(spv_down2.replace(/,/g, '')) + 
                                                                                           parseFloat(spv_down3.replace(/,/g, '')) + 
                                                                                           parseFloat(spv_down4.replace(/,/g, '')) + 
                                                                                           parseFloat(spv_down5.replace(/,/g, '')) + 
                                                                                           parseFloat(spv_down6.replace(/,/g, '')) + 
                                                                                           parseFloat(spv_down7.replace(/,/g, ''))  
                                                                                           
                                                                                           ;
																					
                                                                      document.getElementById('spv_downGrandTotal').value = spv_downTotal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                                                                                    
                                                                      }
                                                        </script>
                                                        <?php } ?>
                                                        <tr id="recs-1" style="background: #eee;border: 1px solid #0869bd;">
                                                               <td colspan="2">Total</td>
                                                               <td align="center"><input type="text" id="spv_downGrandTotal" value="0" name="inp_attitude1[]" style="border: 1px solid #d7d7d7;text-align: right;"></td>
                                                               <td colspan="3">&nbsp;</td>
                                                        </tr>

                                                 </tbody>
                                          </table>
                                   </div>
                            
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











































<!-- add modal -->
<div class="modal fade fade-custom" tabindex="-1" role="dialog" id="CreateFormSPVUP">
       <div class="modal-dialog modal-belakang modal-bgkpi" role="document">
              <div class="modal-content">
                     <div class="modal-header">
                            <h4 class="modal-title">Performance Plan Approval [ FOR Suvervisory UP]</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>
                     
                     <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98.4%; margin: 5px;overflow: scroll;overflow-x: hidden;">

                     <form class="form-horizontal" action="php_action/FuncDataCreateSPVUP.php" method="POST" id="FormDisplayCreateSPVUP">

                            <fieldset id="fset_1">
                                   <legend>&nbsp;Employee Information&nbsp;</legend>

                           
                                   <div class="messages_create_spv_up"></div>

                                   <input id="inp_emp_no" name="inp_emp_no" type="hiddens" value="<?php echo $username; ?>"><!--FROM SESSION -->
                                   <input id="inp_token" name="inp_token" type="hidden" value="<?php echo $get_token; ?>"><!--FROM CONFIGURATION -->

                                   <div class="form-row">
                                          <div class="col-4 name">Employee <span class="required">*</span></div>
                                          <div class="col-sm-7 name">
                                                 <div class="input-group">
                                                        <a id="tombolSPV"><img width="15px" src="../../asset/img/icon_user.png" style="margin-left: -3px;"></a>
                                                     <input type="text" value="<?php echo $nama; ?> [ <?php echo $username; ?> ]" style="width: 70%;font-size: 11px;border: 1px solid #aaa6a6;border-radius: 8px;height: 20px;width: 256px;padding-left: 10px;background: #1e88e521;" readonly name="inp_SpvUPManpower" id="inp_SpvUPManpower">
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
                                   
                                   </fieldset>

                                   <fieldset id="fset_1">
                                   <legend>KPI Detail</legend>
                            </fieldset>

                            <div class="modal-footer">
                                   <button type="reset" class="btn btn-primary1" data-dismiss="modal"
                                          aria-hidden="true">
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
                            <h4 class="modal-title">Approval Performance Plan</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98.4%; margin: 5px;overflow: scroll;overflow-x: hidden;">

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
                                                 <div class="card-body table-responsive p-0" style="height:300px; margin: 1px;overflow: scroll;">
                                                        <!-- pages relation -->
                                                        <div id="box"></div>
                                                        <!-- pages relation -->
                                                 <div>
                                   </div>
                            </fieldset>


                            <fieldset id="fset_1" style="display:none">
                                   <legend>Remark From Approver</legend>
                                   <div class="card-body table-responsive p-0" style="height: 130px; margin: 1px;overflow: scroll;">
                                          <table class="table table-bordered table-hover table-head-fixed">
                                                 <thead>
                                                        <tr>
                                                               <th>Remark.</th> 
                                                        </tr>
                                                 </thead>
                                                 <tbody>
                                                        <tr id="recs-1" style="background: #eee;border: 1px solid #0869bd;">
                                                               <td>
                                                                      <textarea name="sel_remark_from_approver" id="sel_remark_from_approver" class="form-control"></textarea>
                                                               </td>
                                                        </tr>
                                                 </tbody>
                                          </table>
                                   </div>
                            </div>
                            </fieldset>

                            <!-- //LOAD BUTTON APPROVER STATUS -->
                            <div class="modal-footer">
                                   <button type="reset" class="btn btn-primary1" style="background: #e1e1e1;" data-dismiss="modal"
                                          aria-hidden="true" data-backdrop="false">
                                          &nbsp;Cancel&nbsp;
                                   </button>
                                   <a style="<?php echo $button_status_hide_or_no; ?>; color: white;" class="btn btn-warning" name="submit_reject_spvdown" id="submit_reject_spvdown" data-toggle="modal" data-target="#FormDisplayRejectspvdown">
                                          &nbsp;&nbsp;Reject&nbsp;&nbsp;
                                   </a>
                                   <a style="<?php echo $button_status_hide_or_no; ?>; color: white;" class="btn btn-warning" name="submit_revision_spvdown"  id="submit_revision_spvdown" data-toggle="modal" data-target="#FormDisplayrevisionspvdown">
                                          &nbsp;Revision&nbsp;
                                   </a>
                                   <button class="btn btn-warning" type="submit" name="submit_approval_spvdown" id="submit_approval_spvdown">
                                          Approved
                                   </button>
                                   <button class="btn btn-warning" type="button" name="submit_approval_spvdown2"
                                          id="submit_approval_spvdown2" style='display:none;' disabled>
                                          <span class="spinner-grow spinner-grow-sm" role="status"
                                                 aria-hidden="true"></span>
                                          &nbsp;&nbsp;Processing..
                                   </button>
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
                            <h4 class="modal-title">Individual Appraisal Approval Plan SPV UP</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98.4%; margin: 5px;overflow: scroll;overflow-x: hidden;">

                     <form class="form-horizontal" action="php_action/FuncDataUpdateSPVUP.php" method="POST" id="updateApproveSPVUPMemberForm">

                            <fieldset id="fset_1">
                                   <legend>&nbsp;Employee Information&nbsp;</legend>

                                   <div class="messages_create"></div>

                                   <input id="sel_emp_no_approver" name="sel_emp_no_approver" type="hidden" value="<?php echo $username; ?>"><!--FROM SESSION -->
                             
                                   <div class="form-row">
                                          <div class="col-4 name"> Perormance Request <span class="required">*</span></div>
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
                                   <a style="<?php echo $button_status_hide_or_no; ?>; display: block;color: white;background: linear-gradient(229deg, #b9b9b980, #8c8b88);border: 1px saddlebrown;" class="btn btn-warning" name="submit_revision_history_spvup"  id="submit_revision_history_spvup" data-toggle="modal" data-target="#FormDisplayrevisionHistoryspvup">
                                          &nbsp;Revision History&nbsp;
                                   </a>
                                                 <div class="card-body table-responsive p-0" style="height: 50vh; margin: 1px;overflow: scroll;">
                                                        <!-- pages relation -->
                                                        <div id="box_spvup"></div>
                                                        <!-- pages relation -->
                                                 <div>
                                   </div>
                                   </fieldset>

                                   <fieldset id="fset_1">
                                          <legend>Sikap Kerja/ Attitude</legend>
                                                        <div class="card-body table-responsive p-0" style="height: 40vh; margin: 1px;overflow: scroll;">
                                                               <!-- pages relation -->
                                                               <div id="box_att_spvup"></div>
                                                               <!-- pages relation -->
                                                        <div>
                                          </div>
                                   </fieldset>

                                   <fieldset id="fset_1">
                                          <legend>Feedback</legend>
                                                        <div class="card-body table-responsive p-0" style="height: 40vh; margin: 1px;overflow: scroll;">
                                                               <!-- pages relation -->
                                                               <div id="box_feed_spvup"></div>
                                                               <!-- pages relation -->
                                                        <div>
                                          </div>
                                   </fieldset>


                            <fieldset id="fset_1" style="display:none">
                                   <legend>Remark From Approver</legend>
                                   <div class="card-body table-responsive p-0" style="height: 130px; margin: 1px;overflow: scroll;">
                                          <table class="table table-bordered table-hover table-head-fixed">
                                                 <thead>
                                                        <tr>
                                                               <th>Remark.</th> 
                                                        </tr>
                                                 </thead>
                                                 <tbody>
                                                        <tr id="recs-1" style="background: #eee;border: 1px solid #0869bd;">
                                                               <td>
                                                                      <textarea name="sel_remark_from_approver_spv_up" id="sel_remark_from_approver_spv_up" class="form-control"></textarea>
                                                               </td>
                                                        </tr>
                                                 </tbody>
                                          </table>
                                   </div>
                            </div>
                            </fieldset>

                            <!-- //LOAD BUTTON APPROVER STATUS -->
                            <div class="modal-footer">
                                   <button type="reset" class="btn btn-primary1" style="background: #e1e1e1;" data-dismiss="modal"
                                          aria-hidden="true" data-backdrop="false">
                                          &nbsp;Cancel&nbsp;
                                   </button>
                                   <a style="<?php echo $button_status_hide_or_no; ?>; color: white;" class="btn btn-warning" name="submit_reject_spvup" id="submit_reject_spvup" data-toggle="modal" data-target="#FormDisplayRejectspvup">
                                          &nbsp;&nbsp;Reject&nbsp;&nbsp;
                                   </a>
                                   <a style="<?php echo $button_status_hide_or_no; ?>; color: white;" class="btn btn-warning" name="submit_revision_spvup"  id="submit_revision_spvup" data-toggle="modal" data-target="#FormDisplayrevisionspvup">
                                          &nbsp;Revision&nbsp;
                                   </a>
                                   <button class="btn btn-warning" type="submit" name="submit_approval_spvup" id="submit_approval_spvup">
                                          Approved
                                   </button>
                                   <button class="btn btn-warning" type="button" name="submit_approval_spvup2"
                                          id="submit_approval_spvup2" style='display:none;' disabled>
                                          <span class="spinner-grow spinner-grow-sm" role="status"
                                                 aria-hidden="true"></span>
                                          &nbsp;&nbsp;Processing..
                                   </button>
                            </div>
                            <!-- //LOAD BUTTON APPROVER STATUS -->
                     </form>
              </div>
       </div>
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /edit modal -->





















































<!-- delete transaction modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="FormDisplayDeleteSPVUP">
	<div class="modal-dialog" style="width: 25%;">
	    <div class="modal-content">
		<form class="form-horizontal" action="php_action/FuncDataDeleteSPVUP.php" method="POST" id="updatedelMemberFormSPVUP">	      

		<div class="modal-body">      	
		  <div class="edit-messages"></div>
		  <table width="100%">
                     <tr><td align="center"><img src="../../asset/dist/img/sf-mola-mola.png" style="max-width: 90%;margin-top: 20px;"></td></tr>
                     </table>
                            <div class="form-group">
                                   <div class="col-sm-12">	
                                                 <table width="100%"><td align="center"><label id="isi">Are you sure to delete data ?</label></td></table>		
                                                 <input type="hiddens" class="form-control input-report" id="sel_ipp_reqnoS" name="sel_ipp_reqnoS" placeholder="">
                                   </div>
                            </div>
				<div class="modal-footer-delete FormDisplayDeleteSPVUP" style="text-align: center;padding-top: 20px;">
                                          <button type="reset" class="btn btn-primary1" style="background: #ececec;" data-dismiss="modal" data-backdrop="false" aria-hidden="true">
                                                        &nbsp;Cancel&nbsp;
                                          </button>
                                          <button class="btn btn-warning" type="submit" name="submit_delete_SPVUP" id="submit_delete_SPVUP">
                                                 Confirm
                                          </button>
                                          <button class="btn btn-warning" type="button" name="submit_delete_SPVUP2"
                                                 id="submit_delete_SPVUP2" style='display:none;' disabled>
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
<div class="modal fade" tabindex="-1" role="dialog" id="FormDisplayRejectspvdown">

       <div class="modals-content" style="margin-top: 125px;border: 1px solid #dbd2d2;background: #fbfbfb;">  
      
	   
		<form class="form-horizontal" action="php_action/FuncDataRejectRequest.php" method="POST" id="updaterejectMemberFormspvdown">	      

		<div class="modal-body">      	
		  <div class="edit-messages"></div>
                
                <input id="sel_emp_no_approver" name="sel_emp_no_approver" type="hidden" value="<?php echo $username; ?>"><!--FROM SESSION -->

		  <table width="100%">
                     <tr><td align="center"><img src="../../asset/dist/img/sf-mola-mola.png" style="max-width: 90%;margin-top: 20px;"></td></tr>
                     </table>
                            <div class="form-group">
                                   <div class="col-sm-12">	
                                          <table width="100%"><td align="center"><label id="isi_sel_reject_spvdown">Are you sure to reject datas ?</label></td></table>		
                                          <input type="hidden" class="form-control input-report" id="sel_reject_spvdown" name="sel_reject_spvdown" placeholder="">
                                   </div>
                            </div>
				<div class="modal-footer-delete FormDisplayRejectSPVDOWN" style="text-align: center;padding-top: 20px;">
                                          <button onclick="CloseThis();" type="reset" class="btn btn-primary1" style="background: #ececec;" data-dismiss="modal" aria-hidden="true">
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
      
	   
		<form class="form-horizontal" action="php_action/FuncDataRejectRequestSPVUP.php" method="POST" id="updaterejectMemberFormspvup">	      

		<div class="modal-body">      	
		  <div class="edit-messages"></div>
                
                <input id="sel_emp_no_approver" name="sel_emp_no_approver" type="hidden" value="<?php echo $username; ?>"><!--FROM SESSION -->

		  <table width="100%">
                     <tr><td align="center"><img src="../../asset/dist/img/sf-mola-mola.png" style="max-width: 90%;margin-top: 20px;"></td></tr>
                     </table>
                            <div class="form-group">
                                   <div class="col-sm-12">	
                                          <table width="100%"><td align="center"><label id="isi_sel_reject_spvup">Are you sure to reject data ?</label></td></table>		
                                          <input type="hidden" class="form-control input-report" id="sel_reject_spvup" name="sel_reject_spvup" placeholder="">
                                   </div>
                            </div>
				<div class="modal-footer-delete FormDisplayRejectSPVUP" style="text-align: center;padding-top: 20px;">
                                          <button onclick="CloseThis();" type="reset" class="btn btn-primary1" style="background: #ececec;" data-dismiss="modal" aria-hidden="true">
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




















































<!-- delete transaction modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="FormDisplayrevisionspvdown">
       <div class="modal-dialog modal-belakang modal-onmodals" role="document"  style="margin-top: 50px;">
              <div class="modal-content" style="border: 1px solid #b3b2b2;background: #f9f9f9">
                     <div class="modal-header">
                            <h4 class="modal-title">Revised performance plan</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98.4%; margin: 5px;overflow: scroll;overflow-x: hidden;">

                     <form class="form-horizontal" action="php_action/FuncDataRevisionRequest.php" method="POST" id="updaterevisionMemberFormspvdown">

                            <fieldset id="fset_1">
                                   <legend>Detail Revised</legend>

                                   <div class="messages_create"></div>

                                   <input id="inp_emp_no" name="inp_emp_no" type="hidden" value="<?php echo $username; ?>"><!--FROM SESSION -->
                                   <input id="inp_token" name="inp_token" type="hidden" value="<?php echo $get_token; ?>"><!--FROM CONFIGURATION -->

                                 

                                   <div class="form-row">
                                          <div class="col-sm-4 name">Request No. <span class="required">*</span></div>
                                          <div class="col-sm-8 name" id="isi_sel_revision_spvdown">
                                          </div>
                                   </div>
                                   <div class="form-row" style="display:none;">
                                          <div class="col-sm-4 name">Request No. <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_revision_spvdown" name="sel_revision_spvdown"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-sm-4 name">Remark Revised</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">
                                                        <textarea class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_revision_remark_spvdown" name="sel_revision_remark_spvdown"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title=""></textarea>
                                                 </div>
                                          </div>
                                   </div>
                            </fieldset>

                            <fieldset id="fset_1">
                                   <legend>List Revised</legend>
                                                 <div class="card-body table-responsive p-0" style="height: 50vh; margin: 1px;overflow: scroll;">
                                                        <!-- pages relation -->
                                                        <div id="box_revision_remark_history_spvdown"></div>
                                                        <!-- pages relation -->
                                                 <div>
                                   </div>
                            </fieldset>
                            </div>

                            <div class="modal-footer">
                                   <button type="reset" class="btn btn-primary1" data-dismiss="modal"
                                          aria-hidden="true">
                                          &nbsp;Cancel&nbsp;
                                   </button>
                                   <button class="btn btn-warning" type="submit" name="submit_revision_spvdown1" id="submit_revision_spvdown1">
                                          Revised
                                   </button>
                                   <button class="btn btn-warning" type="button" name="submit_revision_spvdown2"
                                          id="submit_revision_spvdown2" style='display:none;' disabled>
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




















































<!-- delete transaction modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="FormDisplayrevisionspvup">
       <div class="modal-dialog modal-belakang modal-onmodals" role="document"  style="margin-top: 50px;">
              <div class="modal-content" style="border: 1px solid #b3b2b2;background: #f9f9f9">
                     <div class="modal-header">
                            <h4 class="modal-title">Revised performance plan</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98.4%; margin: 5px;overflow: scroll;overflow-x: hidden;">

                     <form class="form-horizontal" action="php_action/FuncDataRevisionRequestSPVUP.php" method="POST" id="updaterevisionMemberFormspvup">

                            <fieldset id="fset_1">
                                   <legend>Detail Revised</legend>

                                   <div class="messages_create"></div>

                                   <input id="inp_emp_no" name="inp_emp_no" type="hidden" value="<?php echo $username; ?>"><!--FROM SESSION -->
                                   <input id="inp_token" name="inp_token" type="hidden" value="<?php echo $get_token; ?>"><!--FROM CONFIGURATION -->

                                   <div class="form-row">
                                          <div class="col-sm-4 name">Request No. <span class="required">*</span></div>
                                          <div class="col-sm-8 name" id="isi_sel_revision_spvup">
                                          </div>
                                   </div>
                                   <div class="form-row" style="display:none;">
                                          <div class="col-sm-4 name">Request No. <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_revision_spvup" name="sel_revision_spvup"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-sm-4 name">Remark Revised</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">
                                                        <textarea class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_revision_remark_spvup" name="sel_revision_remark_spvup"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title=""></textarea>
                                                 </div>
                                          </div>
                                   </div>
                                 


                            </fieldset>

                            <fieldset id="fset_1">
                                   <legend>List Revised</legend>
                                                 <div class="card-body table-responsive p-0" style="height: 50vh; margin: 1px;overflow: scroll;">
                                                        <!-- pages relation -->
                                                        <div id="box_revision_remark_history_spvup"></div>
                                                        <!-- pages relation -->
                                                 <div>
                                   </div>
                            </fieldset>
                            </div>

                            <div class="modal-footer">
                                   <button type="reset" class="btn btn-primary1" data-dismiss="modal"
                                          aria-hidden="true">
                                          &nbsp;Cancel&nbsp;
                                   </button>
                                   <button class="btn btn-warning" type="submit" name="submit_revision_spvup1" id="submit_revision_spvup1">
                                          Revised
                                   </button>
                                   <button class="btn btn-warning" type="button" name="submit_revision_spvup2"
                                          id="submit_revision_spvup2" style='display:none;' disabled>
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




















































<!-- revision transaction modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="FormDisplayrevisionHistoryspvup">
       <div class="modal-dialog modal-belakang modal-full" role="document"  style="margin-top: 50px;">
              <div class="modal-content" style="border: 1px solid #b3b2b2;background: #f9f9f9">
                     <div class="modal-header">
                            <h4 class="modal-title">History revised performance plan</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <form class="form-horizontal" action="php_action/FuncDataRevisionRequestSPVUP.php" method="POST" id="updaterevisionMemberFormspvup">

                            <fieldset id="fset_1">
                                   <legend>Detail Revised</legend>

                                   <div class="messages_create"></div>

                                   <input id="inp_emp_no" name="inp_emp_no" type="hidden" value="<?php echo $username; ?>"><!--FROM SESSION -->
                                   <input id="inp_token" name="inp_token" type="hidden" value="<?php echo $get_token; ?>"><!--FROM CONFIGURATION -->

                                   <div class="form-row">
                                          <div class="col-sm-4 name">Request No. <span class="required">*</span></div>
                                          <div class="col-sm-8 name" id="isi_sel_revision_history_spvup">
                                          </div>
                                   </div>
                                   <div class="form-row" style="display:none;">
                                          <div class="col-sm-4 name">Request No. <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="sel_revision_history_spvup" name="sel_revision_history_spvup"
                                                               type="Text" value="" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               style="text-transform:uppercase;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>                              
                            </fieldset>

                            <fieldset id="fset_1">
                                   <legend>KPI Detail</legend>
                                                 <div class="card-body table-responsive p-0" style="height: 50vh; margin: 1px;overflow: scroll;">
                                                        <!-- pages relation -->
                                                        <div id="box_revision_hostory_spvup"></div>
                                                        <!-- pages relation -->
                                                 <div>
                                   </div>
                            </fieldset>

                            <div class="modal-footer">
                                   <button type="reset" class="btn btn-primary1" data-dismiss="modal"
                                          aria-hidden="true">
                                          &nbsp;Close&nbsp;
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
function CloseThis() {
      $('.modal-backdrop').remove();
}
</script>

























  
                     
                            
                                   
                                
                                   
                                 
               
                   
            





<!-- isi JSON -->
<script type="text/javascript">
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

				$("#sel_ipp_reqno_spv_downS").val(response.ipa_reqno);
                            $("#sel_ipp_requester_spv_downS").val(response.requester);
                            // $("#sel_remark_from_approver").val(response.remark);

                            $("#box").load("pages_relation/_pages_approval_spvdown.php?rfid=" + response.pa_reqno, 
                                   function(responseTxt, statusTxt, jqXHR){
                                          if(statusTxt == "success"){
                                                 $("#box").show();
                                          }
                                          if(statusTxt == "error"){
                                                 alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                          }
                                   }
                            );
                          

                            $.ajax({
                                   url: 'php_action/getRequestStatus.php',
                                   type: 'post',
                                   data: {request_no_spvdown : response.pa_reqno},
                                   dataType: 'json',
                                   success:function(response) {
                                                 
                                                 mymodalss.style.display = "none";

                                                 var fill_is_approved_spvdown = response.is_approved_spvdown;
                                                 var fill_is_ready = response.ready;
                                                 var fill_is_urgent_request = response.urgent_request;
                                                 var fill_is_file_name = response.file_name;        

                                                

                                                 if(fill_is_approved_spvdown == '0'){ //jika belum approve request
                                                        document.getElementById("submit_reject_spvdown").style.display = "none";
                                                        document.getElementById("submit_revision_spvdown").style.display = "none";
                                                        document.getElementById("submit_approval_spvdown").style.display = "none";
                                                 } else if(fill_is_ready == '0'){ //jika belum approve request
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

                                   var inp_attitude_spvdown_approver1 = [];
                                   var inp_attitude_spvdown_approver2 = [];
                                   var inp_attitude_spvdown_approver3 = [];
                                   var inp_attitude_spvdown_approver4 = [];
                                   var inp_attitude_spvdown_approver5 = [];
                                   var inp_attitude_spvdown_approver6 = [];
                                   var inp_attitude_spvdown_approver7 = [];

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
                            
                            var revision = response.revno;
                            if(revision == '0'){ //jika tipe request urgent dan attachment belum ada maka hide tombol
                                   document.getElementById("submit_revision_history_spvup").style.display = "none";
                            } else {
                                   document.getElementById("submit_revision_history_spvup").style.display = "block";
                            }

                            document.getElementById("sel_identity_spvup_pa_reqno").innerHTML = response.ipa_reqno;
                            document.getElementById("sel_identity_spvup_requester").innerHTML = response.Full_Name + " ("+response.requester+") "; 
                            
                            // document.getElementsByTagName("harusdiselipin").setAttribute("class", "democlass"); 
                            $("#submit_reject_spvup").attr("onclick", "editreject_spvup_request(`" + response.ipp_reqno + "`)");
                            $("#submit_revision_spvup").attr("onclick", "editrevision_spvup_request(`" + response.ipp_reqno + "`)");
                            $("#submit_revision_history_spvup").attr("onclick", "editrevision_history_spvup_request(`" + response.ipp_reqno + "`)");

                            
                            // onclick="editrejectrequest(`PAREQ2022-130299`)"

				$("#sel_ipp_reqno_spv_upS").val(response.ipa_reqno); 
                            $("#sel_ipp_requester_spv_upS").val(response.requester);
                            $("#sel_remark_from_approver_spv_up").val(response.remark);

                           

                            $("#box_spvup").load("pages_relation/_pages_approval_spvup.php?rfid=" + response.ipp_reqno, 
                                   function(responseTxt, statusTxt, jqXHR){
                                          if(statusTxt == "success"){
                                                 $("#box_spvup").show();
                                          }
                                          if(statusTxt == "error"){
                                                 alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                          }
                                   }
                            );

                            $("#box_att_spvup").load("pages_relation/_pages_approval_att_spvup.php?rfid=" + response.ipp_reqno, 
                                   function(responseTxt, statusTxt, jqXHR){
                                          if(statusTxt == "success"){
                                                 $("#box_att_spvup").show();
                                          }
                                          if(statusTxt == "error"){
                                                 alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                          }
                                   }
                            );

                            $("#box_feed_spvup").load("pages_relation/_pages_approval_feed_spvup.php?rfid=" + response.ipp_reqno, 
                                   function(responseTxt, statusTxt, jqXHR){
                                          if(statusTxt == "success"){
                                                 $("#box_feed_spvup").show();
                                          }
                                          if(statusTxt == "error"){
                                                 alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                          }
                                   }
                            );
                            
                          
                            $.ajax({
                                   url: 'php_action/getRequestStatusSPVUP.php',
                                   type: 'post',
                                   data: {request_no_spvup : response.ipa_reqno},
                                   dataType: 'json',
                                   success:function(response) {

                                                 var fill_is_approved_spvup = response.is_approved_spvup;
                                                 var fill_is_ready = response.ready;
                                                 var fill_is_urgent_request = response.urgent_request;
                                                 var fill_is_file_name = response.file_name;
                         

                                                 if(fill_is_approved_spvup == '0'){ //jika sudah approve request
                                                        document.getElementById("submit_reject_spvup").style.display = "none";
                                                        document.getElementById("submit_revision_spvup").style.display = "none";
                                                        document.getElementById("submit_approval_spvup").style.display = "none";
                                                 } else if(fill_is_ready == '0'){ //jika sudah approve request
                                                        document.getElementById("submit_reject_spvup").style.display = "none";
                                                        document.getElementById("submit_revision_spvup").style.display = "none";
                                                        document.getElementById("submit_approval_spvup").style.display = "none";
                                                 } else if(fill_is_urgent_request == 'Y' && fill_is_file_name == ''){ //jika tipe request urgent dan attachment belum ada maka hide tombol
                                                        document.getElementById("submit_reject_spvup").style.display = "none";
                                                        document.getElementById("submit_revision_spvup").style.display = "none";
                                                        document.getElementById("submit_approval_spvup").style.display = "none";
                                                 } else {
                                                        document.getElementById("submit_reject_spvup").style.display = "block";
                                                        document.getElementById("submit_revision_spvup").style.display = "block";
                                                        document.getElementById("submit_approval_spvup").style.display = "block";
                                                 }

                                                 mymodalss.style.display = "none";



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
                                   var inp_performance_spvup_approver0 = [];
                                   var inp_performance_spvup_approver1 = [];
                                   var inp_performance_spvup_approver2 = [];
                                   var inp_performance_spvup_approver3 = [];
                                   var inp_performance_spvup_approver4 = [];
                                   var inp_performance_spvup_approver5 = [];
                                   var inp_performance_spvup_approver6 = [];
                                   var inp_performance_spvup_approver7 = [];
                                   var inp_performance_spvup_approver8 = [];
                                   
                                   var inp_performance_att_spvup_approver = [];
                                   var inp_performance_att_spvup_approver0 = [];
                                   var inp_performance_att_spvup_approver1 = [];
                                   var inp_performance_att_spvup_approver2 = [];
                                   var inp_performance_att_spvup_approver3 = [];
                                   var inp_performance_att_spvup_approver4 = [];
                                   var inp_performance_att_spvup_approver5 = [];

                                   var inp_performance_feed_spvup_approver0 = [];
                                   var inp_performance_feed_spvup_approver1 = [];
                                   var inp_performance_feed_spvup_approver2 = [];
                                   var inp_performance_feed_spvup_approver3 = [];

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

                            document.getElementById("isi_sel_reject_spvdown").innerHTML = "Are you sure to reject request "+response.pa_reqno+ " ?";

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
								if (response.code == 'success_message_reject_spv_down') {

                                                               $('#submit_reject_spvdown1').show();
                                                               $('#submit_reject_spvdown2').hide();                                      

                                                               // reload the datatables
                                                               datatable.ajax.reload(null,false);
                                                               // reload the datatables

                                                               $('#FormDisplayRejectspvdown').hide();  
                                                               $('#FormDisplayDelete').modal('hide');
                                                               
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

                            document.getElementById("isi_sel_reject_spvup").innerHTML = "Are you sure to reject request "+response.ipp_reqno+ " ?";

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
								if (response.code == 'success_message_reject_spv_up') {

                                                               $('#submit_reject_spvup1').show();
                                                               $('#submit_reject_spvup2').hide();                                      

                                                               // reload the datatables
                                                               datatable.ajax.reload(null,false);
                                                               // reload the datatables

                                                               $('#FormDisplayRejectspvup').hide();  
                                                               $('#FormDisplayDelete').modal('hide');
                                                               
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

























  
                     
                            
                                   
                                
                                   
                                 
               
                   
            






function editrevision_spvdown_request(id = null) {
	if(id) {
		// fetch the member data
              mymodalss.style.display = "block";
              document.getElementById("msg").innerHTML = "Data refreshed";

		$.ajax({
			url: 'php_action/getSelectedEmployee.php',
			type: 'post',
			data: {member_id : id},
			dataType: 'json',
			success:function(response) {

                            mymodalss.style.display = "none";
                            document.getElementById("msg").innerHTML = "Data refreshed";


				$("#sel_revision_spvdown").val(response.pa_reqno); 
                            document.getElementById("isi_sel_revision_spvdown").innerHTML = response.pa_reqno;

                            $("#box_revision_remark_history_spvdown").load("pages_relation/_pages_approval_revision_remark_history_spvdown.php?rfid=" + response.pa_reqno, 
                                   function(responseTxt, statusTxt, jqXHR){
                                          if(statusTxt == "success"){
                                                 $("#box_revision_remark_history_spvdown").show();
                                          }
                                          if(statusTxt == "error"){
                                                 alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                          }
                                   }
                            );

				// mmeber id 
				$(".FormDisplayrevisionPVDOWN").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');

				// here update the member data
				$("#updaterevisionMemberFormspvdown").unbind('submit').bind('submit', function() {
                                                                     
					var form = $(this);

					// validation
					var sel_revision_spvdown = $("#sel_revision_spvdown").val();
                                   var sel_revision_remark_spvdown = $("#sel_revision_remark_spvdown").val();
                                   
					if(sel_revision_spvdown == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "There is some error";
                                   } else if(sel_revision_remark_spvdown == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "Revised remark cannot empty";
                                   } else {
                                          $('#submit_revision_spvdown1').hide();
                                          $('#submit_revision_spvdown2').show();
                                   }


					if(sel_ipp_reqno_spv_downS && sel_revision_remark_spvdown) {


						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {
								if (response.code == 'success_message_revision_spv_down') {

                                                               

                                                               $('#submit_revision_spvdown1').show();
                                                               $('#submit_revision_spvdown2').hide();                                                             

                                                               // reload the datatables
                                                               datatable.ajax.reload(null,false);
                                                               // reload the datatables

                                                               $('#FormDisplayrevisionspvup').hide();  
                                                               $('#FormDisplayDelete').modal('hide');
                                                               
                                                               $("[data-dismiss=modal]").trigger({type: "click"});

                                                               modals.style.display = "block";
                                                               document.getElementById("msg").innerHTML = response.messages;

                                                               
                                                               
                                                        } else {

                                                               $('#submit_revision_spvdown1').show();
                                                               $('#submit_revision_spvdown2').hide();         

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

























  
                     
                            
                                   
                                
                                   
                                 
               
                   
            






function editrevision_spvup_request(id = null) {

	if(id) {
		// fetch the member data
              mymodalss.style.display = "block";

		$.ajax({
			url: 'php_action/getSelectedEmployeeSPVUP.php',
			type: 'post',
			data: {member_id : id},
			dataType: 'json',
			success:function(response) {

                            mymodalss.style.display = "none";

				$("#sel_revision_spvup").val(response.ipp_reqno); 
                            
                            document.getElementById("isi_sel_revision_spvup").innerHTML = response.ipp_reqno;

                            $("#box_revision_remark_history_spvup").load("pages_relation/_pages_approval_revision_remark_history_spvup.php?rfid=" + response.ipp_reqno, 
                                   function(responseTxt, statusTxt, jqXHR){
                                          if(statusTxt == "success"){
                                                 $("#box_revision_remark_history_spvup").show();
                                          }
                                          if(statusTxt == "error"){
                                                 alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                          }
                                   }
                            );

				// mmeber id 
				$(".FormDisplayrevisionPVUP").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');

				// here update the member data
				$("#updaterevisionMemberFormspvup").unbind('submit').bind('submit', function() {
                                                                     
					var form = $(this);

					// validation
					var sel_revision_spvup = $("#sel_revision_spvup").val();
                                   var sel_revision_remark_spvup = $("#sel_revision_remark_spvup").val();
                                   
					if(sel_revision_spvup == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "There is some error";
                                   } else if(sel_revision_remark_spvup == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "Revised remark cannot empty";
                                   } else {
                                          $('#submit_revision_spvup1').hide();
                                          $('#submit_revision_spvup2').show();
                                   }


					if(sel_revision_spvup && sel_revision_remark_spvup) {


						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {
								if (response.code == 'success_message_revision_spv_up') {

                                                               

                                                               $('#submit_revision_spvup1').show();
                                                               $('#submit_revision_spvup2').hide();                                                             

                                                               // reload the datatables
                                                               datatable.ajax.reload(null,false);
                                                               // reload the datatables

                                                               $('#FormDisplayrevisionspvup').hide();  
                                                               $('#FormDisplayDelete').modal('hide');
                                                               
                                                               $("[data-dismiss=modal]").trigger({type: "click"});

                                                               modals.style.display = "block";
                                                               document.getElementById("msg").innerHTML = response.messages;

                                                               
                                                               
                                                        } else {

                                                               $('#submit_revision_spvup1').show();
                                                               $('#submit_revision_spvup2').hide();         

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

























  
                     
                            
                                   
                                
                                   
                                 
               
                   
            






function editrevision_history_spvup_request(id = null) {

	if(id) {
		// fetch the member data
              mymodalss.style.display = "block";

		$.ajax({
			url: 'php_action/getSelectedEmployeeSPVUP.php',
			type: 'post',
			data: {member_id : id},
			dataType: 'json',
			success:function(response) {

                            mymodalss.style.display = "none";

				$("#sel_revision_history_spvup").val(response.ipp_reqno);

                            $("#box_revision_hostory_spvup").load("pages_relation/_pages_approval_revision_history_spvup.php?rfid=" + response.ipp_reqno, 
                                   function(responseTxt, statusTxt, jqXHR){
                                          if(statusTxt == "success"){
                                                 $("#box_revision_hostory_spvup").show();
                                          }
                                          if(statusTxt == "error"){
                                                 alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                          }
                                   }
                            );
                            
                            document.getElementById("isi_sel_revision_history_spvup").innerHTML = response.ipp_reqno;

				// mmeber id 
				$(".FormDisplayrevisionPVUP").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');

				// here update the member data
				$("#updaterevisionMemberFormspvup").unbind('submit').bind('submit', function() {
                                                                     
					var form = $(this);

					// validation
					var sel_revision_spvup = $("#sel_revision_spvup").val();
                                   var sel_revision_remark_spvup = $("#sel_revision_remark_spvup").val();
                                   
					if(sel_revision_spvup == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "There is some error";
                                   } else if(sel_revision_remark_spvup == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "Revised remark cannot empty";
                                   } else {
                                          $('#submit_revision_spvup1').hide();
                                          $('#submit_revision_spvup2').show();
                                   }


					if(sel_revision_spvup && sel_revision_remark_spvup) {


						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {
								if (response.code == 'success_message_revision_spv_up') {

                                                               

                                                               $('#submit_revision_spvup1').show();
                                                               $('#submit_revision_spvup2').hide();                                                             

                                                               // reload the datatables
                                                               datatable.ajax.reload(null,false);
                                                               // reload the datatables

                                                               $('#FormDisplayrevisionspvup').hide();  
                                                               $('#FormDisplayDelete').modal('hide');
                                                               
                                                               $("[data-dismiss=modal]").trigger({type: "click"});

                                                               modals.style.display = "block";
                                                               document.getElementById("msg").innerHTML = response.messages;

                                                               
                                                               
                                                        } else {

                                                               $('#submit_revision_spvup1').show();
                                                               $('#submit_revision_spvup2').hide();         

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























function editdelMemberSPVUP(id = null) {
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
			url: 'php_action/getSelectedEmployeeSPVUP.php',
			type: 'post',
			data: {member_id : id},
			dataType: 'json',
			success:function(response) {

				$("#sel_ipp_reqnoS").val(response.ipp_reqno);

				// mmeber id 
				$(".FormDisplayDeleteSPVUP").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');

				// here update the member data
				$("#updatedelMemberFormSPVUP").unbind('submit').bind('submit', function() {
					// remove error messages
					$(".text-danger").remove();

					var form = $(this);

					// validation
					var sel_ipp_reqnoS = $("#sel_ipp_reqnoS").val();

					if(sel_ipp_reqnoS == "") {
                                          modals.style.display ="block";
                                          document.getElementById("msg").innerHTML = "Item code cannot empty";
                                   } else {
                                          $('#submit_delete_SPVUP').hide();
                                          $('#submit_delete_SPVUP2').show();
                                   }


					if(sel_ipp_reqnoS) {
						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {
								if (response.code == 'success_message_delete_spv_up') {
                                                               modals.style.display = "block";
                                                               document.getElementById("msg").innerHTML = response.messages;

                                                               $('#submit_delete_SPVUP').show();
                                                               $('#submit_delete_SPVUP2').hide();                                                             

                                                               // reload the datatables
                                                               datatable.ajax.reload(null,false);
                                                               // reload the datatables

                                                               $('#FormDisplayDeleteSPVUP').modal('hide');  
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
<!-- 
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
</script> -->