<?php include "../../application/session/session.php";?>

<div class="modal-dialog modal-med">
       <div class="modal-content">

              <div class="modal-header">
                     <h4 class="modal-title">Search Employee</h4>
                     <button type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" 
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
              </div>
              <form name='form1' method="post" onsubmit='return validasi()'>

                     

                     <fieldset id="fset_1">
                                   <legend>Searching Form</legend>



                                   <table style="width: 95%;">
                                          <tbody>
                                                 <tr>
                                                        <td width="40%"><label id="lbl_inp_name" for="inp_name"
                                                                      title="">Employee No <span
                                                                             class="required">*</span></label>
                                                        </td>
                                                        <td colspan="3" class="" id="tdb_1">
                                                        
                                                               <!-- <input type="text" onkeyup="isi_otomatis()" autofocus="on" class="form-control input-report" id="inp_emp" name="inp_emp" placeholder="Nip" autocomplete="off"> -->
                                                               <input class="form-control" style="margin-bottom: 2px;"
                                                                      onkeyup="isi_otomatis(), isi_otomatis_leave()"
                                                                      autocomplete="off"
                                                                      autofocus="on" id="inp_emp" name="inp_emp"
                                                                      type="Text" value="<?php echo $username; ?>" onfocus="hlentry(this)"
                                                                      size="30" maxlength="50" 
                                                                      validate="NotNull:Invalid Form Entry"
                                                                      onchange="formodified(this);" title="">
                                                        </td>
                                                 </tr>
                                                 <tr id="tr_inp_name" class="clTR1">
                                                        <td><label id="lbl_inp_name" for="inp_name"
                                                                      title="">Employee Name <span
                                                                             class="required">*</span></label>
                                                        </td>
                                                        <td colspan="3" class="" id="tdb_1"><input class="form-control"
                                                                      style="margin-bottom: 2px;background-color: #ffdcad;"
                                                                      id="inp_name" name="inp_name" type="Text"
                                                                      value="<?php echo $nama; ?>" onfocus="hlentry(this)" size="20"
                                                                      maxlength="50" 
                                                                      validate="NotNull:Invalid Form Entry"
                                                                      onchange="formodified(this);" title="" readonly>
                                                        </td>
                                                 </tr>

                                       

                                                 <tr id="tr_inp_name" class="clTR1">
                                                        <td><label id="lbl_inp_name" for="inp_name"
                                                                      title="">Date <span
                                                                             class="required">*</span></label>
                                                        </td>
                                                        <?php
                                                        $year  = date('/Y');
                                                        $month  = date('m/');
                                                        $qLast = mysqli_fetch_array(mysqli_query($connect, "SELECT LAST_DAY(NOW()) AS DATA"));
                                                        ?>
                                                        <td id="tdb_1"><input class="form-control"
                                                                      style="margin-bottom: 2px; width: 100%;"
                                                                      id="inp_date" name="inp_date" value="<?php echo date ("Y-m-01", strtotime ($qLast['DATA'])); ?>"
                                                                      type="date" onfocus="hlentry(this)"
                                                                      size="20" maxlength="50" 
                                                                      validate="NotNull:Invalid Form Entry"
                                                                      onchange="formodified(this);" title=""></td>

                                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;To&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                        

                                                        <td id="tdb_1"><input class="form-control"
                                                                      style="margin-bottom: 2px; width: 100%;"
                                                                      id="inp_enddate" name="inp_enddate"
                                                                      type="date" value="<?php echo date ("Y-m-d", strtotime ($qLast['DATA'])); ?>" onfocus="hlentry(this)"
                                                                      size="20" maxlength="50" 
                                                                      validate="NotNull:Invalid Form Entry"
                                                                      onchange="formodified(this);" title=""></td>


                                                 </tr>

                               

                                          </tbody>
                                   </table>
                            </fieldset>


                            <tr>
                                   <td colspan="3" align="right" width="100%">
                                          <div class="modal-footer">
                                                 <div class="form-group">
                                                        <button type="button" class="btn btn-default"
                                                               data-dismiss="modal">Cancel</button>

                                          


                                                        <button type="submit" 
                                                             
                                                               class="btn btn-warning">Search</button>
                                                 </div>
                                          </div>
                                   </td>
                            </tr>




		</form>
              <script>
                     function validasi() {
                            var modal_leave_starts = document.getElementById("inp_date").value;
                            var modal_leave_ends = document.getElementById("inp_enddate").value;

                            var from = new Date(modal_leave_starts).getTime();
                            var to = new Date(modal_leave_ends).getTime();
              
                            
                            if(from > to) {
                                   alert("Entry Date: Enter Date in Proper Range");
                                   return false;
                            } else if(modal_leave_starts == "") {
                                   alert("lStart Cant Empty");
                                   return false;
                            } else if(modal_leave_ends == "") {
                                   alert("End date Cant empty");
                                   return false;
                            }

                       
                            
                            // if(inp_emp == "") {
                            //        alert("Employee Number invalid");
                            //        return false;
                            // } else if(modal_nick == "") {
                            //        alert("Invalid Employee Number or Employee is not your authorized");
                            //        return false;
                            // } if (inp_emp != "" && modal_nick!= "") {
                            //        return true;
                            // }
                     }
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


<script type="text/javascript">
function log(message) {

}

window.onload = function() {
       document.querySelector('#datepicker1').addEventListener('datechanged', function(e) {
              console.log('New date', e.data, this.value)
       })

       duDatepicker('#datepicker1', {
              format: 'd mmmm yyyy',
              range: false,
              clearBtn: true,
              // disabledDays: ['Sat', 'Sun'],
              events: {
                     dateChanged: function(data) {
                            log('From: ' + data.dateFrom + '\nTo: ' + data.dateTo)
                     },
                     onRangeFormat: function(from, to) {
                            var fromFormat = 'd mmmm d, yyyy',
                                   toFormat = 'mmmm d, yyyy';

                            if (from.getMonth() === to.getMonth() && from.getFullYear() ===
                                   to.getFullYear()) {
                                   fromFormat = 'd mmmm'
                                   toFormat = 'd, yyyy'
                            } else if (from.getFullYear() === to.getFullYear()) {
                                   fromFormat = 'd mmmm'
                                   toFormat = 'd mmmm, yyyy'
                            }

                            return from.getTime() === to.getTime() ?
                                   this.formatDate(from, 'd mmmm, yyyy') : [this.formatDate(
                                          from, fromFormat), this.formatDate(to,
                                          toFormat)].join('-');
                     }
              }
       })


}
</script>