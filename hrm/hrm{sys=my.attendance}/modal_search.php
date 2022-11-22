<?php include "../../application/session/session.php";?>


<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>

<div class="modal-dialog modal-med">
       <div class="modal-content">

              <div class="modal-header">
                     <h4 class="modal-title">Search Employee</h4>
                     <button type="button" class="close" onclick='return stopload()' data-dismiss="modal"
                            aria-label="Close" style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
              </div>
              
              <form name='form1' method="post" onsubmit='return HrmsValidationForm()'>
                     <fieldset id="fset_1">
                            <legend>Searching Form</legend>

                            <div class="form-row">
                                   <div class="col-4 name">Employee no*</div>
                                   <div class="col-sm-8">
                                          <div class="input-group">

                                                 <input class="input--style-6"
                                                        onkeyup="isi_otomatis(), isi_otomatis_leave()"
                                                        autocomplete="off" autofocus="on" id="inp_emp"
                                                        name="inp_emp" type="Text" value="<?php echo $username; ?>"
                                                        onfocus="hlentry(this)" size="30" maxlength="50" 
                                                        validate="NotNull:Invalid Form Entry"
                                                        onchange="formodified(this);" title="">
                                          </div>
                                   </div>
                            </div>

                            <div class="form-row">
                                   <div class="col-4 name">Name*</div>
                                   <div class="col-sm-8">
                                          <div class="input-group">

                                                 <input class="input--style-6" style="background-color: #fff3b4;"
                                                        id="inp_name" name="inp_name" type="Text"
                                                        value="<?php echo $nama; ?>" onfocus="hlentry(this)" size="20"
                                                        maxlength="50"  validate="NotNull:Invalid Form Entry"
                                                        onchange="formodified(this);" title="" readonly>
                                          </div>
                                   </div>
                            </div>

                            <div class="form-row">
                                   <div class="col-4 name">Date of Leave*</div>
                                   <div class="col-sm-4" style="padding-bottom:5px">
                                          <div class="input-group">
                                          <?php
                                                        $year  = date('/Y');
                                                        $month  = date('m/');
                                                        $qLast = mysqli_fetch_array(mysqli_query($connect, "SELECT LAST_DAY(NOW()) AS DATA"));
                                                        ?>
                                                 <input type="text" id="inp_date" class="input--style-6"
                                                        name="inp_date"
                                                        value="<?php echo date ("Y-m-01", strtotime ($qLast['DATA'])); ?>"
                                                        style="
                                                                      background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                      background-size: 17px;
                                                                      background-position:right;   
                                                                      background-repeat:no-repeat; 
                                                                      padding-right:10px;  
                                                                      " />
                                          </div>
                                   </div>
                                   <div class="col-sm-4" style="padding-bottom:5px">
                                          <div class="input-group">

                                                 <input class="input--style-6" maxlength="10" type="text" 
                                                        value="<?php echo date ("Y-m-d", strtotime ($qLast['DATA'])); ?>"
                                                        style="
                                                                      background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                      background-size: 17px;
                                                                      background-position:right;   
                                                                      background-repeat:no-repeat; 
                                                                      padding-right:10px;  
                                                                      " id="inp_enddate" name="inp_enddate" />
                                          </div>
                                   </div>
                            </div>

                           

                     </fieldset>


                     <tr>
                            <td colspan="3" align="right" width="100%">
                                   <div class="modal-footer">
                                          <div class="form-group">
                                                 <button onclick='return stopload()' type="button" class="btn btn-default"
                                                        data-dismiss="modal">Cancel</button>

                                                 <button type="submit" name="submit_add" id="submit_add"
                                                        class="btn btn-warning">Submit</button>

                                                 <button class="btn btn-warning" type="button" name="submit_add2"
                                                        id="submit_add2" style='display:none;' disabled>
                                                        <span class="spinner-grow spinner-grow-sm" role="status"
                                                               aria-hidden="true"></span>
                                                        Processing..
                                                 </button>

                                          </div>
                                   </div>
                            </td>
                     </tr>




              </form>
              <script>
              function HrmsValidationForm() {

                     var modal_leave_starts = document.getElementById("inp_date").value;
                     var modal_leave_ends = document.getElementById("inp_enddate").value;

                     var from = new Date(modal_leave_starts).getTime();
                     var to = new Date(modal_leave_ends).getTime();


                     if (from > to) {
                            alert("Entry Date: Enter Date in Proper Range");
                            return false;
                     } else {
                            $('#submit_add').hide();
                            $('#submit_add2').show();
                     }
              }
              </script>
              
              <script>
              $(document).ready(function() {
                     $('#inp_emp').on('change', function() {

                            var inp_name = document.getElementById("inp_name").value;
                         
                            if (inp_name == '') {
                                   alert("Invalid lookup");
                                   return false;
                            } else {
                                   $("#tr_inp_leaveisurgent").hide();
                            }
                     });
              });
              </script>

              <script type="text/javascript">
              $(document).ready(function() {
                     $('#inp_date').bootstrapMaterialDatePicker({
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






















       </div>

</div>
</div>
</div>





<script type="text/javascript">
function isi_otomatis() {
       var inp_emps = $("#inp_emp").val();
       $.ajax({
              url: 'ajax_cek.php',
              data: "inp_emp=" + inp_emps,
       }).success(function(data) {
              var json = data,
                     obj = JSON.parse(json);
              $('#inp_name').val(obj.nama);
              $('#nik').val(obj.nik);
       });
}
</script>

<script type="text/javascript">
function isi_otomatis_leave() {
       var inp_emps = $("#inp_emp").val();
       var modal_leave = $("#modal_leave").val();

       $.ajax({
              url: 'ajax_cek3_mysql.php',
              data: {
                     inp_emp: inp_emps,
                     modal_leave: modal_leave
              },

       }).success(function(data) {
              var json = data,
                     obj = JSON.parse(json);
              $('#inp_leavebalance').val(obj.lvb);

       });
}
</script>
