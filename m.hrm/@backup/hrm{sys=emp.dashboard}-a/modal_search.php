<?php include "../../application/session/session.php";?>

<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>


                     
                     <!-- mulai list select -->
                     <script>
                     function trimfield(str) 
                     { 
                            return str.replace(/^\s+|\s+$/g,''); 
                     }
                     function validate()
                     {
                             var obj1 = document.getElementById('remark');
                             var obj2 = document.getElementById('remark');
                                    if(trimfield(obj1.value) == '') 
                                    {      
                                            alert("Please Provide Details!");
                                            obj1.focus();
                                            return false;       
                                    }
                                    else if(trimfield(obj2.value) == '')
                                    {      
                                             alert("Please Provide Name!");
                                             obj2.focus();
                                             return false;       
                                   }
                                    else
                                      return true;
                     }
                     
                     
                     $(document).ready(function(){
                            $('#purpose').on('change', function() {
                              if ( this.value == '0')
                              {
                                      $("#business_new").hide();
                                   $("#business").hide();
                              }
                              else if ( this.value == '1')
                              {
                                      $("#business_new").hide();
                                   $("#business").show();
                              }
                              else  if ( this.value == '2')
                              {
                                     $("#business").hide();
                                   $("#business_new").show();
                              }
                               else  
                              {
                                   $("#business").hide();
                              }
                            });
                     });
                     </script>
                     <body>
                     
                     <!-- stop list select -->
                            
                     
                     

              
       






<div class="modal-dialog modal-med">
       <div class="modal-content">

              <div class="modal-header" style="background-color: #1b747b;color: aliceblue;">
                     <h4 class="modal-title">Filter</h4>
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
                                                 

                                       

                                                 <tr id="tr_inp_name" class="clTR1">
                                                        <td><label id="lbl_inp_name" for="inp_name"
                                                                      title="">Date <span
                                                                             class="required">*</span></label>
                                                        </td>
                                                        <?php
                                                        $SFdate  = date("Y-m-d");
                                                        $year  = date('/Y');
                                                        $month  = date('m/');
                                                        $qLast = mysqli_fetch_array(mysqli_query($connect, "SELECT LAST_DAY(NOW()) AS DATA"));
                                                        ?>

                                                        <td>
                                                        <div class="input-group">

                                                               <input type="text" 
                                                                      id="inp_date" 
                                                                      name="inp_date" 
                                                                      class="input--style-6"
                                                                      value="<?php echo $SFdate ; ?>"
                                                                      style="
                                                                             background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                             background-size: 17px;
                                                                             background-position:right;   
                                                                             background-repeat:no-repeat; 
                                                                             padding-right:10px;  
                                                                             " />
                                                        </div>
                                                        </td>
                                                        
                                                        <!-- Codingan Date -->
                                                        <!-- <td id="tdb_1"><input class="form-control"
                                                                      style="margin-bottom: 12px; width: 100%;padding-bottom: 30px;"
                                                                      id="inp_date" name="inp_date" value="<?php echo $SFdate ; ?>"
                                                                      type="date" onfocus="hlentry(this)"
                                                                      size="20" maxlength="50" 
                                                                      validate="NotNull:Invalid Form Entry"
                                                                      onchange="formodified(this);" title="">
                                                        </td> -->

                                                        <!-- <td>&nbsp;&nbsp;&nbsp;&nbsp;To&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                        

                                                        <td id="tdb_1"><input class="form-control"
                                                                      style="margin-bottom: 2px; width: 100%;"
                                                                      id="inp_enddate" name="inp_enddate"
                                                                      type="date" value="<?php echo date ("Y-m-d", strtotime ($qLast['DATA'])); ?>" onfocus="hlentry(this)"
                                                                      size="20" maxlength="50" 
                                                                      validate="NotNull:Invalid Form Entry"
                                                                      onchange="formodified(this);" title=""></td> -->


                                                 </tr>


                                                 <!-- <div class="form-group" >
                                                        <select id='purpose' class="form-control">
                                                               <option value="0">-select one-</option>
                                                               <option value="1">Warga</option>
                                                               <option value="2">Majelis Taklim</option>
                                                        </select>
                                                 </div> -->

                                                 <!-- kalo yang dipilih warga taklim maka yang muncul ini -->
                                                 <div style='display:none;' id='business'>
                                                 <form name="modal_popup" onsubmit="return validate();" enctype="multipart/form-data" method="POST">
                                                                      <textarea name="remark" class="form-control"></textarea>
                                                        </form>
                                                 </div>
                                                 <!-- kalo yang dipilih warga maka yang muncul ini sampai sini  -->
                                                 
                                                 <!-- kalo yang dipilih majelis taklim maka yang muncul ini -->
                                                 <div style='display:none;' id='business_new'>
                                                 <form name="modal_popup" onsubmit="return validate();" enctype="multipart/form-data" method="POST">
                                                                      <textarea name="remark" class="form-control">dasdas</textarea>
                                                        </form>
                                                 </div>
                                                 <!-- kalo yang dipilih majelis taklim maka yang muncul ini sampai sini -->

                               

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
                            // var modal_leave_ends = document.getElementById("inp_enddate").value;

                            var from = new Date(modal_leave_starts).getTime();
                            // var to = new Date(modal_leave_ends).getTime();
              
                            
                            if(modal_leave_starts = ""){
                                   alert("Date Cant empty");
                                   return false;
                            }
                            // if(from > to) {
                            //        alert("Entry Date: Enter Date in Proper Range");
                            //        return false;
                            // } else if(modal_leave_starts == "") {
                            //        alert("lStart Cant Empty");
                            //        return false;
                            // } else if(modal_leave_ends == "") {
                            //        alert("End date Cant empty");
                            //        return false;
                            // }

                       
                            
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
              <!-- Script Date Picker -->
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