<?php 
include "../../application/session/session.php";

if(isset($_POST['id'])){
    $id     = $_POST['id'];
}elseif(isset($_GET['id'])){
    $id     = $_GET['id'];
}

// Query ambil data insurance
$sql_bank       = mysqli_query($connect, "SELECT a.institution_code, a.institution_name FROM tgeminsurance a");
// Query ambil data bank

// Query untuk ambil data
$sql_data       = mysqli_query($connect, "SELECT * FROM teorcompinsurance a WHERE a.register_no = '$id'");

$data           = mysqli_fetch_assoc($sql_data);
// Query untuk ambil data


?>

<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>

<script src="../../asset/gt_developer/jquery.min.js"></script>
    <link href="../../asset/admus/chartist.css" rel="stylesheet">
    <link href="../../asset/admus/chartist-init.css" rel="stylesheet">
    <link href="../../asset/admus/chartist-plugin-tooltip.css" rel="stylesheet">
    <link href="../../asset/admus/c3.css" rel="stylesheet">
    <link href="../../asset/admus/style.css" rel="stylesheet">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="../../asset/vendor/bootstrap/css/modal.css">

    <link rel="stylesheet" href="../../asset/gt_developer/adminlte.css">

    <link rel="stylesheet" type="text/css" href="../../asset/gt_developer/vc-toggle-switch.css" />

    <link rel="stylesheet" href="../../asset/vendor/font-awesome/css/font-awesome.min.css">


    

    
      



      <script src="../../asset/gt_developer/jquery.min.js"></script>



      <!-- Developer css -->
      <link rel="stylesheet" href="../../asset/gt_developer/developer_hris.css">
      <link rel="stylesheet" href="../../asset/gt_developer/forms.css">
      <link rel="stylesheet" href="../../asset/gt_developer/loader.css">

      <style>
      .divBlockSpace {
      position: fixed;
      overflow: hidden;
      background:url("../../asset/dist/img/loading.gif") no-repeat center center;
      background-color: #fdfdfd;
      opacity: .75;
      filter: alpha(opacity=85);
      z-index: 100;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      border: 0 solid blue;
      
      }

      .loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('images/loading2.gif') 50% 50% no-repeat rgb(249,249,249);
            opacity: 1;
        }
      </style>

      



              <div class="card-header">
                     <h4 class="modal-title">Add Insurance of Company</h4>
                     <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button> -->
              </div>


              <!-- <form method="post" id="myform"> -->
              <div class="card-body table-responsive p-0" style="width: 100vw;height: 78vh; width: 98.8%; margin: 5px; margin: 5px;overflow: scroll;">  


                            <fieldset id="fset_1">
                                <div class="form-row">
                                          <div class="col-sm-4 name">Insurance Number *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on"
                                                               name="insurance_number" id="insurance_number" type="Text" value="<?php echo $data['register_no'] ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-sm-4 name">Insurance Name *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                    <select class="input--style-6" name="insurance_name" id="insurance_name" style="width: ;height: 30px;">
                                                        <option value="">-- Select one --</option>
                                                        <?php 
                                                            while($data_bank = mysqli_fetch_assoc($sql_bank)){
                                                        ?>
                                                        <option value="<?php echo $data_bank['institution_code'] ?>" <?php if($data['institution_code'] == $data_bank['institution_code']){ echo 'selected';} ?> ><?php echo $data_bank['institution_name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-sm-4 name">Insurance Date *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                    <input type="text" id="insurance_date" class="input--style-6"
                                                        name="insurance_date" style="
                                                                      background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                      background-size: 17px;
                                                                      background-position:right;   
                                                                      background-repeat:no-repeat; 
                                                                      padding-right:10px;  
                                                                      "
                                                                      value="<?php echo $data['register_date'] ?>"
                                                                      autocomplete="off"/>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-sm-4 name">Branch Code *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="branch_code" id="branch_code" type="Text" value="<?php echo $data['branch_code'] ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-sm-4 name">Branch Name *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="branch_name" id="branch_name" type="Text" value="<?php echo $data['branch_name'] ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-sm-4 name">Branch Account *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on"
                                                               name="branch_account" id="branch_account" type="Text" value="<?php echo $data['branch_account'] ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-sm-4 name">Branch Address</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                    <textarea class="textarea--style-6" id="branch_address" name="branch_address" placeholder="Branch Address"><?php echo $data['branch_address'] ?></textarea>        

                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-sm-4 name">Branch Phone</div>
                                          <div class="col-sm-4">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on"
                                                               name="branch_phone" id="branch_phone" type="Text" value="<?php echo $data['branch_phone'] ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                          <div class="col-sm-4">
                                          <div class="input-group">

                                                        <p>Use comma (,) for multiple entries</p>
                                                 </div>
                                          </div>
                                        <!-- </div> -->
                                   </div>
                                   <div class="form-row">
                                          <div class="col-sm-4 name">Company Name</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="company_name" id="company_name" type="Text" value="<?php echo $data['branchcompany_name'] ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-sm-4 name">Company Address</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                    <textarea class="textarea--style-6" id="insurance_address" name="insurance_address" placeholder="Insurance Address"><?php echo $data['insurance_address'] ?></textarea>        

                                                 </div>
                                          </div>
                                   </div>
                                   
                                   <div class="form-row">
                                          <div class="col-sm-4 name">Company Phone</div>
                                          <div class="col-sm-4">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on"
                                                               name="insurance_phone" id="insurance_phone" type="Text" value="<?php echo $data['insurance_phone'] ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                          <div class="col-sm-4">
                                          <div class="input-group">

                                                        <p>Use comma (,) for multiple entries</p>
                                                 </div>
                                          </div>
                                        <!-- </div> -->
                                   </div>
                                   
                                   <div class="form-row">
                                          <div class="col-sm-4 name">Business Unit</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="business_unit" id="business_unit" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>
                                   
                                   <div class="form-row">
                                          <div class="col-sm-4 name">Default</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">
                                                    <input class="form-check-input" type="checkbox" value="" id1="0" id="insurance_default" <?php if($data['default_insurance'] == '1'){ echo 'checked';} ?> >

                        
                                                 </div>
                                          </div>
                                   </div>

                                          
                                         

                                  
                            </fieldset>


                            
                    
                                                 <br>
                                                 <tr>
                                                        <td colspan="2" align="right" width="100%">
                                                               <div class="modal-footer">
                                                                      <div class="form-group">
                                                                             <button type="button" id="close"
                                                                                    class="btn btn-default"
                                                                                    data-dismiss="modal">Cancel</button>
                                                                             <button type="submit" id="delete_insurance"
                                                                                    class="btn btn-danger">Delete</button>
                                                                             <button type="submit" id="edit_insurance"
                                                                                    class="btn btn-warning">Submit</button>
                                                                      </div>
                                                               </div>
                                                        </td>
                                                 </tr>
                               

                            </table>
                     </div>
              <!-- </form> -->
            </div>
       </div>

</div>
<!-- </div> -->
<!-- </div> -->

<script>
$(document).ready(function() {
    $(document).on('click', '#edit_insurance', function(){
       var insurance_number         = $('#insurance_number').val();
       var insurance_name           = $('#insurance_name').val();
       var insurance_date           = $('#insurance_date').val();
       var branch_code              = $('#branch_code').val();
       var branch_name              = $('#branch_name').val();
       var branch_account           = $('#branch_account').val();
       var branch_address           = $('#branch_address').val();
       var branch_phone             = $('#branch_phone').val();
       var company_name             = $('#company_name').val();
       var insurance_address        = $('#insurance_address').val();
       var insurance_phone          = $('#insurance_phone').val();
       var business_unit            = $('#business_unit').val();
       var insurance_default        = $('#insurance_default').attr('id1');

       // Validasi
       if(insurance_name == ''){
              alert('Insurance name cannot empty!');
              return;
       }else if(insurance_date == ''){
              alert('Insurance date cannot empty!');
              return;
       }else if(branch_name == ''){
              alert('Branch name cannot empty!');
              return;
       }else if(branch_account == ''){
              alert('Branch account cannot empty!');
              return;
       }
       // Validasi


       let formData = new FormData();
                formData.append('insurance_number', insurance_number);
                formData.append('insurance_name', insurance_name);
                formData.append('insurance_date', insurance_date);
                formData.append('branch_code', branch_code);
                formData.append('branch_name', branch_name);
                formData.append('branch_account', branch_account);
                formData.append('branch_address', branch_address);
                formData.append('branch_phone', branch_phone);
                formData.append('company_name', company_name);
                formData.append('insurance_address', insurance_address);
                formData.append('insurance_phone', insurance_phone);
                formData.append('business_unit', business_unit);
                formData.append('insurance_default', insurance_default);

       $.ajax({
                     type: 'POST',
                     url: "ajax_editinsurance.php",
                     data: formData,
                     cache: false,
                     processData: false,
                     contentType: false,
	            success: function (msg) {
	                alert(msg);
                       window.close();
	            },
	            error: function () {
	                alert("Data Gagal Diupload");
	            }
	});

    });

    $(document).on('click', '#delete_insurance', function(){

       var insurance_number     = $('#insurance_number').val();

       let formData = new FormData();
                formData.append('insurance_number', insurance_number);

       $.ajax({
                     type: 'POST',
                     url: "ajax_deleteinsurance.php",
                     data: formData,
                     cache: false,
                     processData: false,
                     contentType: false,
	            success: function (msg) {
	                alert(msg);
                       window.close();
	            },
	            error: function () {
	                alert("Data Gagal Diupload");
	            }
	});

    });


       $(document).on('change', '#insurance_default', function(){
              var c   = $('#insurance_default').attr('id1');
              // alert(c);
              if(c == '1'){
                     $('#insurance_default').attr('id1', '0');
              }else if(c == '0'){
                     $('#insurance_default').attr('id1', '1');  
              }
       });

       $(document).on('click', '#close', function(){
              window.close();
	});

    

      
});
</script>

             
<script type="text/javascript">
              $(document).ready(function() {
                     $('#insurance_date').bootstrapMaterialDatePicker({
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
              });
              </script>

<script>
// Get the modals
var modals = document.getElementById("mymodals");
var span = document.getElementsByClassName("closed")[0];
span.onclick = function() {
  modals.style.display = "none";
}
window.onclick = function(event) {
  if (event.target == modals) {
    modals.style.display = "none";
  }
}
</script>

<!-- /**
 *
 * '||''|.                            '||
 *  ||   ||    ....  .... ...   ....   ||    ...   ... ...  ... ..
 *  ||    || .|...||  '|.  |  .|...||  ||  .|  '|.  ||'  ||  ||' ''
 *  ||    || ||        '|.|   ||       ||  ||   ||  ||    |  ||
 * .||...|'   '|...'    '|     '|...' .||.  '|..|'  ||...'  .||.
 *                                                  ||
 * --------------- By Display:inline ------------- '''' -----------
 */
//NOTIFIKASI
//NOTIFIKASI -->
                            <script>
                            $(document).ready(function() {
                                   var limit = 100;
                                   var start = 0;
                                   var action = 'inactive';

                                   function load_country_data_s(limit, start) {
                                          $.ajax({
                                                 url: "../../view/no/VMNotificationList.php",
                                                 method: "POST",
                                                 data: {
                                                        limit: limit,
                                                        start: start <?php echo $frameworks; ?>
                                                 },
                                                 cache: false,
                                                 success: function(data) {
                                                        $('#notifications').append(
                                                               data);
                                                        if (data == '') {
                                                               $('#example3_message')
                                                                      .html(
                                                                             "<button type='button' class='btn btn-info'>No Data Found</button>"
                                                                             );
                                                               action = 'active';
                                                        } else {
                                                               $('#example3_message')
                                                                      .html(
                                                                             "<button type='button' class='btn btn-warning'>Please Wait....</button>"
                                                                             );
                                                               action = "inactive";
                                                        }
                                                 }
                                          });
                                   }

                                          if (action == 'inactive') {
                                                 action = 'active';
                                                 load_country_data_s(limit, start);
                                          }
                                          $(window).scroll(function() {
                                                 if ($(window).scrollTop() + $(window).height() >
                                                        420 && action == 'inactive') {
                                                        action = 'active';
                                                        start = start + limit;
                                                        setTimeout(function() {
                                                               load_country_data_s(
                                                                      limit,
                                                                      start);
                                                        }, 1000);
                                                 }
                                          });

                                   });
                            </script>
<!-- /**
 *
 * '||''|.                            '||
 *  ||   ||    ....  .... ...   ....   ||    ...   ... ...  ... ..
 *  ||    || .|...||  '|.  |  .|...||  ||  .|  '|.  ||'  ||  ||' ''
 *  ||    || ||        '|.|   ||       ||  ||   ||  ||    |  ||
 * .||...|'   '|...'    '|     '|...' .||.  '|..|'  ||...'  .||.
 *                                                  ||
 * --------------- By Display:inline ------------- '''' -----------
 */
//NOTIFIKASI
//NOTIFIKASI -->
<br>
<br>
<style>
@media (max-width:960px) { .footer {
       position: fixed;
       left: 0;
       bottom: 0;
       width: 100%;
       background-color: #fff;
       color: grey;
       text-align: center;
       z-index: 2;
}
}

@media (min-width:960px) { .footer {
       position: fixed;
       left: 0;
       bottom: 0;
       width: 100%;
       background-color: #fff;
       color: grey;
       text-align: right;
       z-index: 2;
}
} 

</style>



 <!-- footer -->
            <!-- ============================================================== -->
            
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- customizer Panel -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    
    <script src="../../asset/admus/jquery.js"></script>
    <script src="../../asset/admus/popper.js"></script>
    <script src="../../asset/admus/bootstrap.js"></script>
    <script src="../../asset/admus/app.js"></script>
    <script src="../../asset/admus/app_002.js"></script>
    <script src="../../asset/admus/app-style-switcher.js"></script>
    <script src="../../asset/admus/perfect-scrollbar.js"></script>
    <script src="../../asset/admus/sparkline.js"></script>
    <script src="../../asset/admus/waves.js"></script>
    <script src="../../asset/admus/sidebarmenu.js"></script>
    <script src="../../asset/admus/custom.js"></script>
    <script src="../../asset/admus/chartist.js"></script>
    <script src="../../asset/admus/chartist-plugin-tooltip.js"></script>
    <script src="../../asset/admus/d3.js"></script>
    <script src="../../asset/admus/c3.js"></script>
    <script src="../../asset/admus/dashboard6.js"></script>

    

</body>
</html>


<script>
       document.onreadystatechange = function () {
            var state = document.readyState
            if (state == 'interactive') {
                  document.getElementById('contents').style.visibility="hidden";
            } else if (state == 'complete') {
                  setTimeout(function(){
                  document.getElementById('interactive');
                  document.getElementById('divBlockSpace').style.visibility="hidden";
                  document.getElementById('contents').style.visibility="visible";
                  },100);
            }
            }
       </script>
       <script>
       function startloadmore() {
              $(document).ready(function() {
                     const lockModal = $("#lock-modal");
                     const loadingCircle = $("#loading-circle");
                     const form = $("#my-form");

                     // lock down the form
                     lockModal.css("display", "block");
                     loadingCircle.css("display", "block");

                     form.children("input").each(function() {
                            $(this).attr("readonly", true);
                     });

                     setTimeout(function() {
                            // re-enable the form
                            lockModal.css("display", "none");
                            loadingCircle.css("display", "none");

                            
                     }, 500);
              });
       };
       </script>
       <script>
       function startload() {
              $(document).ready(function() {
                     const lockModal = $("#lock-modal");
                     const loadingCircle = $("#loading-circle");
                     const form = $("#my-form");

                     // lock down the form
                     lockModal.css("display", "block");
                     loadingCircle.css("display", "block");

                     form.children("input").each(function() {
                            $(this).attr("readonly", true);
                     });

                     setTimeout(function() {
                            // re-enable the form
                            lockModal.css("display", "none");
                            loadingCircle.css("display", "none");

                            
                     }, 35000);
              });
       };
       </script>
       <script>
       function stopload() {
              $(document).ready(function() {
                     const lockModal = $("#lock-modal");
                     const loadingCircle = $("#loading-circle");
                     const form = $("#my-form");

                     // lock down the form
                     lockModal.css("display", "none");
                     loadingCircle.css("display", "none");

                     
              });
       };
       </script>
       <script>
       $(function () {
       $("#example1").DataTable();
       $("#example3").DataTable({ 
       "ordering" : false,
       "sort": false });
       $('#example2').DataTable({
       "paging": false,
       "lengthChange": false,
       "searching": false,
       "ordering": false,
       "info": true,
       "autoWidth": true,
       });
       });

       $('.toastsDefaultFull').click(function() {
       $(document).Toasts('create', {
       body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
       title: 'Toast Title',
       subtitle: 'Subtitle',
       icon: 'fas fa-envelope fa-lg',
       })
       });
       </script>

       <script type="text/javascript">
       $(document).ready(function () {
       bsCustomFileInput.init();
       });
       </script>

<!-- 

       <script src="../../asset/admus/custom.js"></script>
       <script src="../../asset/admus/chartist.js"></script>
       <script src="../../asset/admus/chartist-plugin-tooltip.js"></script>
       <script src="../../asset/admus/d3.js"></script>
       <script src="../../asset/admus/c3.js"></script>
       <script src="../../asset/admus/dashboard6.js"></script>-->
    
    <!-- <script src="../../asset/vendor/jquery/jquery.min.js"></script>
       <script src="../../asset/vendor/bootstrap/js/bootstrap.min.js"></script>  -->
      <!-- Vendor -->
       <!-- <script src="../../asset/vendor/jquery/jquery.min.js"></script>

       <script src="../../asset/vendor/bootstrap/js/bootstrap.min.js"></script>
    
       <script src="../../asset/admus/perfect-scrollbar.js"></script>
       <script src="../../asset/admus/sparkline.js"></script>
       <script src="../../asset/admus/waves.js"></script>

       <script type='text/javascript' src='../../asset/gt_developer/jquery.redirect.js'></script> -->

       <!-- <script src="../../asset/admus/jquery.js"></script>
       <script src="../../asset/admus/popper.js"></script>
       <script src="../../asset/admus/bootstrap.js"></script>
       <script src="../../asset/admus/app.js"></script>
       <script src="../../asset/admus/app_002.js"></script>
       <script src="../../asset/admus/app-style-switcher.js"></script>
       <script src="../../asset/admus/perfect-scrollbar.js"></script>
       <script src="../../asset/admus/sparkline.js"></script>
       <script src="../../asset/admus/waves.js"></script> -->
       <!-- <script src="../../asset/admus/sidebarmenu.js"></script> -->
       <!-- <script src="../../asset/admus/custom.js"></script>
       <script src="../../asset/admus/chartist.js"></script>
       <script src="../../asset/admus/chartist-plugin-tooltip.js"></script>
       <script src="../../asset/admus/d3.js"></script>
       <script src="../../asset/admus/c3.js"></script>
       <script src="../../asset/admus/dashboard6.js"></script> -->

       <script src="../../asset/vendor/bootstrap/js/bootstrap.min.js"></script>




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
