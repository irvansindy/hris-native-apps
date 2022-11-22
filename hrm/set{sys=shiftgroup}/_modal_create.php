<?php
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0'; 
if($getdata == 0) {
	include "../../application/session/session.php";
} else {
	include "../../application/session/mobile.session.php";	
}
include "../template/sys.alert.php";
?>

<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>

<style>
.colheaderrel {
       font-family: ARIAL, Verdana;
       font-weight: thin;
       font-size: 8pt;
       clear: left;
       border-top: 1px solid C7C7C7;
       border-left: 1px solid C7C7C7;
       border-bottom: 1px solid gray;
       padding-top: 5px;
       padding-left: 10px;
       position: relative;
       background-color: #999;
       color: white;
       cursor: default;
       overflow: hidden;
       white-space: nowrap;
       height: 22px;
}
</style>


<!-- <table>
                <tr><td>NIM</td><td><input type="text" onkeyup="isi_otomatis()" id="nim"></td></tr>
                <tr><td>NAMA</td><td><input type="text" id="nama" disabled></td></tr>
                <tr><td>JENIS KELAMIN</td><td><input type="text" id="jeniskelamin" disabled></td></tr>
            </table>
      
              <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
              <script type="text/javascript">
              function isi_otomatis(){
                     var nim = $("#nim").val();
                     $.ajax({
                     url: '_get_shiftdetail.php',
                     data:"nim="+nim ,
                     }).success(function (data) {
                     var json = data,
                     obj = JSON.parse(json);
                     $('#nama').val(obj.company_id1);
                     $('#jeniskelamin').val(obj.company_id2);
                     });
              }
              </script> -->


<div class="modal-dialog modal-med">
       <div class="modal-content">
              <div class="modal-header">
                     <h4 class="modal-title"><?php echo $_GET['modal_header']; ?></h4>
                     <div class="toolbar sprite-toolbar-close" aria-label="Close" id="CloseHref1" data-dismiss="modal"
                            id="SEARCH" title="Search"></div>
              </div>

              <div class="card-body table-responsive p-0"
                     style="width: 100vw;height: 60vh; width: 98.8%; margin: 5px;overflow: scroll;">
                     <fieldset id="fset_1">
                            <legend style="font-weight: 700;font-size: 12px;">Add Shift Group</legend>

                            <form name='form1' method="post" id="multiple_upload_form" enctype="multipart/form-data"
                                   onsubmit='return HrmsValidationForm()'>
                                   <div class="form-row">
                                          <div class="col-4 name">Group Code <font color="red">*</font>
                                          </div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">
                                                        <input class="input--style-6" type="Text" id="inp_groupcode"
                                                               name="inp_groupcode" value="" autocomplete="off"
                                                               autofocus="on" size="30" maxlength="50" 
                                                               placeholder="groupcode" title="groupcode">
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Group Name <font color="red">*</font>
                                          </div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">
                                                        <input class="input--style-6" type="Text" id="inp_groupname"
                                                               name="inp_groupname" value="" autocomplete="off"
                                                               autofocus="on" size="30" maxlength="50" 
                                                               placeholder="groupname" title="groupname">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name">Overtime Based On <font color="red">*</font>
                                          </div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">
                                                        <select id="inp_overtime_calculation"
                                                               name="inp_overtime_calculation" class="input--style-6"
                                                               onfocus="hlentry(this)" onchange="groupEntry('spOVB',this.value);
                                                                      formodified(this);"
                                                               style="width:undefined;height: 33px;">
                                                               <option value="RA">Request And Attendance</option>
                                                               <option value="RO">Request Only</option>
                                                               <option value="AO">Attendance Only</option>
                                                               <option value="AW">Attendance With Request</option>
                                                        </select>
                                                 </div>
                                          </div>
                                   </div>





                                   <table class="table table-bordered" id="tbl_posts">
                                          <thead>
                                                 <tr class="colheaderrel">
                                                        <th class="tblr" style="text-align: center;vertical-align: middle;font-weight: bold;">day(s)</th>
                                                        <th class="tbr"style="text-align: center;vertical-align: middle;font-weight: bold;">Shift Code</th>
                                                        <th class="tbr"style="text-align: center;vertical-align: middle;font-weight: bold;">Premi<br>Checked</th>
                                                        <th class="tbr"style="text-align: center;vertical-align: middle;font-weight: bold;">Add / Delete<br>Other Shift
                                                               
                                                        </th>
                                                        <th class="tbr"style="text-align: center;vertical-align: middle;font-weight: bold;"><a class="add-record"
                                                                      data-added="0">

                                                                      <img src="../../asset/img/icons/acssadd.png">
                                                                     
                                                               </a></th>
                                                 </tr>
                                          </thead>




                                          <tbody id="tbl_posts_body">
                                                 <tr id="rec-3">
                                                        <td><span class="sn">1</span>.</td>
                                                        <td style="width: 100%;"><SELECT name="sg0[]" autocomplete="off"
                                                                      id="sg0" class="form-control">
                                                                      <option value="">None</option>
                                                                      <?php
                            $get_relation = mysqli_query($connect, "SELECT
                                                                      a.shiftdailycode,
                                                                      CASE 
                                                                             WHEN a.starttime IS NULL THEN concat(a.shiftdailycode , ' | Flexible Shift 0 Productive Hour')
                                                                             WHEN a.starttime IS NOT NULL AND b.break_starttime IS NOT NULL THEN CONCAT(a.shiftdailycode, ' | Start - End:' , TIME_FORMAT(a.starttime, '%H:%i') , '-' , TIME_FORMAT(a.endtime, '%H:%i') , ' Break Time 1 : ' , TIME_FORMAT(b.break_starttime, '%H:%i') , '-', TIME_FORMAT(b.break_endtime, '%H:%i'))
                                                                             WHEN a.starttime IS NOT NULL AND b.break_starttime IS NULL THEN CONCAT(a.shiftdailycode, ' | Start - End:' , TIME_FORMAT(a.starttime, '%H:%i') , '-' , TIME_FORMAT(a.endtime, '%H:%i') )
                                                                                    WHEN a.starttime IS NULL AND b.break_starttime IS NOT NULL THEN CONCAT(' Break Time 1 : ' , TIME_FORMAT(b.break_starttime, '%H:%i') , '-', TIME_FORMAT(b.break_endtime, '%H:%i'))
                                                                             
                                                                                    ELSE concat(a.shiftdailycode , ' | Flexible Shift 0 Productive Hour')
                                                                                    
                                                                      END AS shiftdailycodes 
                                                                      FROM hrmttamshiftdaily a
                                                                      LEFT JOIN hrmttadshiftbreak b ON a.shiftdailycode=b.shiftdailycode");         

                            while($rows = mysqli_fetch_array($get_relation)){
                            echo '<option value='.$rows['shiftdailycode'].'>'.$rows['shiftdailycodes'].'</option>';
                            }
                            ?>
                                                               </SELECT></td>
                                                        <td style="text-align: center;">
                                                        <SELECT name="sg1[]" autocomplete="off"
                                                                      id="sg1" class="form-control">
                                                                      <option value="0">No</option>
                                                                      <option value="1">Yes</option>
                                                        </SELECT>
                                                        </td>
                                                        <td colspan="2" style="text-align: center;"><a
                                                                      class="btn btn-xs delete-record" data-id="0">
                                                                      <img src="../../asset/img/icons/minus.png">
                                                               </a>
                                                        </td>
                                                 </tr>
                                          </tbody>
                                   </table>



                                   <div style="display:none;">
                                          <table id="sample_table">
                                                 <tr id="">
                                                        <td><span class="sn"></span>.</td>
                                                        <td style="width: 100%;"><SELECT name="sg0[]" autocomplete="off"
                                                                      id="sg0" class="form-control">
                                                                      <option value="">None</option>
                                                                      <?php
                            $get_relation = mysqli_query($connect, "SELECT
                                                                      a.shiftdailycode,
                                                                      CASE 
                                                                             WHEN a.starttime IS NULL THEN CONCAT(a.shiftdailycode)
                                                                             WHEN a.starttime IS NOT NULL AND b.break_starttime IS NOT NULL THEN CONCAT(a.shiftdailycode, ' | Start - End:' , TIME_FORMAT(a.starttime, '%H:%i') , '-' , TIME_FORMAT(a.endtime, '%H:%i') , ' Break Time 1 : ' , TIME_FORMAT(b.break_starttime, '%H:%i') , '-', TIME_FORMAT(b.break_endtime, '%H:%i'))
                                                                             WHEN a.starttime IS NOT NULL AND b.break_starttime IS NULL THEN CONCAT(a.shiftdailycode, ' | Start - End:' , TIME_FORMAT(a.starttime, '%H:%i') , '-' , TIME_FORMAT(a.endtime, '%H:%i') )
                                                                                    WHEN a.starttime IS NULL AND b.break_starttime IS NOT NULL THEN CONCAT(' Break Time 1 : ' , TIME_FORMAT(b.break_starttime, '%H:%i') , '-', TIME_FORMAT(b.break_endtime, '%H:%i'))
                                                                             
                                                                                    ELSE concat(a.shiftdailycode , ' Flexible Shift 0 Productive Hour')
                                                                                    
                                                                      END AS shiftdailycodes 
                                                                      FROM hrmttamshiftdaily a
                                                                      LEFT JOIN hrmttadshiftbreak b ON a.shiftdailycode=b.shiftdailycode");         

                            while($rows = mysqli_fetch_array($get_relation)){
                            echo '<option value='.$rows['shiftdailycode'].'>'.$rows['shiftdailycodes'].'</option>';
                            }
                            ?>
                                                               </SELECT></td>
                                                        <td style="text-align: center;">
                                                        <SELECT name="sg1[]" autocomplete="off"
                                                                      id="sg1" class="form-control">
                                                                      <option value="0">No</option>
                                                                      <option value="1">Yes</option>
                                                        </SELECT>
                                                        </td>
                                                        <td colspan="2" style="text-align: center;"><a
                                                                      class="btn btn-xs delete-record" data-id="0">
                                                                      <img src="../../asset/img/icons/minus.png">
                                                               </a></td>
                                                 </tr>
                                          </table>
                                   </div>


                                   <div class="modal-footer">
                                          <div class="form-group">
                                                 <button id="CloseHref2" type="button" class="btn btn-default"
                                                        data-dismiss="modal">Cancel</button>
                                                 <button class="btn btn-warning" type="submit"
                                                        name="submit_add_setting_shift_group"
                                                        id="submit_add_setting_shift_group">
                                                        Submit
                                                 </button>

                                                 <button class="btn btn-warning" type="button" name="submit_add2"
                                                        id="submit_add2" style='display:none;' disabled>
                                                        <span class="spinner-grow spinner-grow-sm" role="status"
                                                               aria-hidden="true"></span>
                                                        Processing..
                                                 </button>

                                          </div>
                                   </div>


                     </fieldset>

                     </body>

                     </html>

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
                                   var didConfirm = confirm(
                                          "Are you sure You want to delete");
                                   if (didConfirm == true) {
                                          var id = jQuery(this).attr('data-id');
                                          var targetDiv = jQuery(this).attr('targetDiv');
                                          jQuery('#rec-' + id).remove();

                                          //regnerate index number on table
                                          $('#tbl_posts_body tr').each(function(index) {
                                                 $(this).find('span.sn').html(
                                                        index + 1);
                                          });
                                          return true;
                                   } else {
                                          return false;
                                   }
                            });
                     });
                     </script>







                     <script type="text/javascript">
                     $(document).ready(function() {
                            $('#modal_leave_start').bootstrapMaterialDatePicker({
                                   time: false,
                                   clearButton: true
                            });
                            $('#modal_leave_end').bootstrapMaterialDatePicker({
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
                            $('#inp_break_starttime').bootstrapMaterialDatePicker({
                                   date: false,
                                   format: 'HH:mm'
                            });
                            $('#inp_break_endtime').bootstrapMaterialDatePicker({
                                   date: false,
                                   format: 'HH:mm'
                            });
                            $('#inp_automaticovt_start').bootstrapMaterialDatePicker({
                                   date: false,
                                   format: 'HH:mm'
                            });
                            $('#inp_automaticovt_end').bootstrapMaterialDatePicker({
                                   date: false,
                                   format: 'HH:mm'
                            });
                            $('#inp_ovt_beforeend').bootstrapMaterialDatePicker({
                                   date: false,
                                   format: 'HH:mm'
                            });
                            $('#inp_ovt_afterstart').bootstrapMaterialDatePicker({
                                   date: false,
                                   format: 'HH:mm'
                            });
                            $('#inp_ovt_breakstart').bootstrapMaterialDatePicker({
                                   date: false,
                                   format: 'HH:mm'
                            });

                     });
                     </script>

                     <script>
                     function HrmsValidationForm() {
                            var inp_groupcode = document.getElementById("inp_groupcode").value;

                            if (inp_groupcode == "") {
                                   modals.style.display = 'block';
                                   document.getElementById('msg').innerHTML = 'Shift Group cannot empty';
                                   return false;
                            } else {
                                   $('#submit_add_setting_shift_group').hide();
                                   $('#submit_add2').show();
                            }
                     }
                     </script>

                     <script>
                     $("#CloseHref1").on('click', function() {
                            window.location = "../set{sys=shiftgroup}/";
                     });
                     $("#CloseHref2").on('click', function() {
                            window.location = "../set{sys=shiftgroup}/";
                     });
                     </script>

                     </form>