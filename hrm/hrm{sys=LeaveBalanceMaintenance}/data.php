
<?php  
       $src_cost_code                   = '';
       $src_reason_name_en                = '';
       if (!empty($_POST['src_cost_code']) && !empty($_POST['src_reason_name_en'])) {
              $src_cost_code            = $_POST['src_cost_code'];
              $src_reason_name_en         = $_POST['src_reason_name_en'];
              $frameworks                 = "?src_cost_code="."".$src_cost_code." &&src_reason_name_en="."".$src_reason_name_en."";
       } else if (empty($_POST['src_cost_code']) && !empty($_POST['src_reason_name_en'])) {
              $src_cost_code            = $_POST['src_cost_code'];
              $src_reason_name_en         = $_POST['src_reason_name_en'];
              $frameworks                 = "?src_reason_name_en="."".$src_reason_name_en."";
       } else if (!empty($_POST['src_cost_code']) && empty($_POST['src_reason_name_en'])) {
              $src_cost_code            = $_POST['src_cost_code'];
              $src_reason_name_en         = $_POST['src_reason_name_en'];
              $frameworks                 = "?src_cost_code="."".$src_cost_code."";
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
                                   <form>
                                          <fieldset id="fset_1" style="margin-top: 25px;border-radius: 5px;border: 1px solid #e4e8ea;">
                                                 <legend>Searching</legend>
                                                 <div class="form-row">
                                                        <div class="col-4 name">Cost code</div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on" id="src_cost_code"
                                                                             name="src_cost_code" id="src_cost_code" type="Text" value=""
                                                                             onfocus="hlentry(this)" size="30" maxlength="50" 
                                                                             validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title="">
                                                               </div>
                                                        </div>
                                                 </div>
                                          </fieldset>
                                          <button type="submit"  data-dismiss="modal"
                                                 aria-label="Close" name="submit_filter" id="submit_filter" type="button" class="btn btn-warning button_bot">
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


<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>


<div class="col-md-12">
       <div class="card">
              <div class="card-header d-flex align-items-center">
                     <h4 class="card-title mb-0">Leave Balance Maintenance </h4>
                     <div class="card-actions ml-auto">
                            <table>
                                   <td>
                                          <a href='#'>
                                                 <div class="toolbar sprite-toolbar-reload" id="RELOAD" title="Reload" onclick="RefreshPage();">
                                                 </div>
                                          </a>
                                   </td>
                            </table>
                     </div>
              </div>


              <div class="card-body table-responsive p-0"
                     style="width: 100vw;height: 78vh; width: 98%; margin: 5px;overflow: scroll;">
                     <script type="text/javascript">
                     function validateForm() {
                            function hasExtension(inputID, exts) {
                                   var fileName = document.getElementById(inputID).value;
                                   return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(
                                   fileName);
                            }
                            if (!hasExtension('filepegawaiall', ['.xls'])) {
                                   return false;
                            }
                     }
                     </script>

                     <!-- <form> -->
                     <form name="myForm" id="myForm" enctype="multipart/form-data" action="php_action/FuncDataUpload.php" method="post" target="popupwindow" onsubmit=" return validateForm(), window.open('php_action/FuncDataUpload.php', 'popupwindow', 'scrollbars=yes,toolbar=no');">
                            <fieldset id="fset_1">
                                   <legend>Employee Leave Balance Maintenance</legend>

                                   <div class="form-row" style="display:none;">
                                          <div class="col-4 name">Upload Excel File <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input type="file" id="filepegawaiall" name="filepegawaiall" />      
                                                        <input name="date" class="hidden" type="hidden" value="<?php echo date('Y-m-d H:i:s') ?>">
                                                        
                                                        
                                                 </div>
                                          </div>
                                   </div>  

                                   <div class="form-row">
                                          <div class="col-4 name">Leave/ Permit Type * </div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <select class="input--style-6 modal_leave" name="list_ofleave"
                                                               style="width: 50%;height: 30px;" id="list_ofleave"
                                                               onchange="isi_otomatis_leave()">
                                                               <option>--Select One--</option>
                                                               <?php
                                                               $sql = mysqli_query($connect,"SELECT 
                                                                                                  a.leave_code,
                                                                                                  a.leavename_en
                                                                                                  FROM 
                                                                                                  ttamleavetype a
                                                                                                  ORDER BY a.leave_code ASC");
                                                                      while($row=mysqli_fetch_array($sql))
                                                                      {
                                                                             echo '<option value="'.$row['leave_code'].'">'.$row['leavename_en'].'</option>';
                                                                      }
                                                                      ?>
                                                        </select>
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name">Leave Status</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <select onchange="editMember(`Performance`)" class="input--style-6 leave_status" name="leave_status"
                                                               style="width: 20%;height: 30px;" id="leave_status">
                                                               <option value="2">All</option>
                                                               <option value="1">Active</option>
                                                               <option value="0">Inactive</option>
                                                        </select>
                                                 </div>
                                          </div>
                                   </div>

                  
                                   <div class="form-row" id="show_employee" style="display:none;">
                                          <div class="col-11 name">Employee</div>
                                          <div class="col-sm-1" style="padding-left: 55px;">
                                                 <div class="card-body table-responsive p-0" style="overflow: scroll;overflow-x: hidden;">
                                                         <td>
                                                               <a href='#' class='open_modal_search' class="btn btn-demo" data-toggle="modal" data-target="#myModal2">
                                                                      <div class="toolbar sprite-toolbar-search" id="SEARCH" title="Search">
                                                                      </div>
                                                               </a>
                                                        </td>
                                                 </div>
                                          </div>
                                   </div>
                                   
                                   <div class="form-row" id="show_employees" style="display:none;">
                                          <div class="col-4 name"></div>                          
                                          <div class="col-sm-8">
                                                 <div class="card-body table-responsive p-0" style="width: 100vw;height: 30vh; width: 100%; overflow: scroll;overflow-x: hidden;">
                                                        <div id="box"></div>
                                                        <div id="box_with"></div>
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name"> </div>
                                          <div class="col-sm-8" style="text-align: right;">
                                                 <div class="input-group">
                                                        <button type="submit" name="browse" id="browse" style="width: 135px;"
                                                               value="Browse File"
                                                               class="btn btn-rounded btn-warning btn-sm text-white d-inline-block">Browse</button><br />
                                                 </div>
                                          </div>
                                   </div>

                            </fieldset>
                     </form>
              </div>
       </div>
</div>





















































</body>

</html>


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
       $("#leave_status, #list_ofleave").on('change', function() {
       var leave_status = $("#leave_status").val();
       var list_ofleave = $("#list_ofleave").val();
       var src_cost_code = $("#src_cost_code").val();

       mymodalss.style.display = "block";
       //For empty multiselect
       $('#test-select-4s1').val(null).trigger("change")
       //For empty multiselect
       $("#box_with").hide();
       $("#box").load("pages_relation/_pages_setting.php?rfid=" + leave_status + "&rfid1=" + list_ofleave + "&token=" + '0' + "&rfid2=" + src_cost_code,
              function(responseTxt, statusTxt, jqXHR){
                     if(statusTxt == "success"){
                            $("#show_employee").show();
                            $("#show_employees").show();
                            $("#box").show();
                            if($("#box").show()) {
                                   mymodalss.style.display = "none";
                            }
                     }
                     if(statusTxt == "error"){
                            alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                     }
              }
       );

       $("#submit_filter").on('click', function() {
       //For empty multiselect
       $('#test-select-4s0').val(null).trigger("change")
       //For empty multiselect
       $("#box").hide();
              mymodalss.style.display = "block";

                     var leave_status = $("#leave_status").val();
                     var list_ofleave = $("#list_ofleave").val();
                     var src_cost_code = $("#src_cost_code").val();
                     
                     $("#box_with").load("pages_relation/_pages_setting.php?rfid=" + leave_status + "&rfid1=" + list_ofleave + "&token=" + '1' + "&rfid2=" + src_cost_code,
                     function(responseTxt, statusTxt, jqXHR){
                                   if(statusTxt == "success"){
                                          $("#show_employee").show();
                                          $("#show_employees").show();
                                          $("#box_with").show();
                                          if($("#box_with").show()) {
                                                 mymodalss.style.display = "none";
                                          }
                                   }
                                   if(statusTxt == "error"){
                                          alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                   }
                            }
                     );
       });

       $("#browse").on('click', function() {

              var leave_status_post = $("#leave_status").val();
              var list_ofleave = $("#list_ofleave").val();
              var sel_parameters = $("#sel_parameters").val();

              $.ajax({
                     url: 'pages_relation/_show.php',
                     method: 'POST',
                     success: function(data) {
                     console.log(data);
                     $("#page_details").load('pages_relation/_show.php', {
                            data1 : leave_status_post,
                            data2 : list_ofleave,
                            sel_parameters : sel_parameters
                     });  
                     }
              });
              
       });
                  
       var regex=/^[a-zA-Z]+$/;
                  
       if (inp_reason_code == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Reason code cannot empty";

                     } else if (inp_reason_name_en == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Reason desc en cannot empty";

                     } else if (inp_reason_name_id == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Reason desc id cannot empty";

                     } else {
                            $('#submit_add').hide();
                            $('#submit_add2').show();
                     }

                    
                     return false;
       }); // /add modal
});
</script>
<!-- isi JSONs -->