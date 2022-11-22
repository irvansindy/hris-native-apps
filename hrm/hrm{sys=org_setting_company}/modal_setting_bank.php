<?php 
include "../../application/session/session.php";

if(isset($_POST['id'])){
    $id     = $_POST['id'];
}elseif(isset($_GET['id'])){
    $id     = $_GET['id'];
}

// Query ambil data
$sql_data       = mysqli_query($connect, "SELECT 
a.bank_code,
a.bank_account,
a.account_name,
a.alias_name,
a.default_bank
FROM teorcompbank a
WHERE a.bank_account = '$id'");

$data           = mysqli_fetch_assoc($sql_data);
// Query ambil data

// Query ambil data bank
$sql_bank       = mysqli_query($connect, "SELECT a.bank_code, a.bank_name, a.bankgroup_code FROM tpymbank a");
// Query ambil data bank


?>

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
                     <h4 class="modal-title">Edit Bank of Company</h4>
                     <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button> -->
              </div>


              <!-- <form method="post" id="myform"> -->

                            <fieldset id="fset_1">

                                   <div class="form-row">
                                          <div class="col-sm-4 name">Bank Name *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                    <select class="input--style-6" name="bank_name" id="bank_name" style="width: ;height: 30px;">
                                                        <option value="0">-- Select one --</option>
                                                        <?php 
                                                            while($data_bank = mysqli_fetch_assoc($sql_bank)){
                                                        ?>
                                                        <option value="<?php echo $data_bank['bank_code'] ?>" <?php if($data_bank['bank_code'] == $data['bank_code']){ echo 'selected';} ?>><?php echo $data_bank['bank_name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-sm-4 name">Bank Account *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="bank_account" id="bank_account" type="Text" value="<?php echo $data['bank_account'] ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-sm-4 name">Account Name *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="account_name" id="account_name" type="Text" value="<?php echo $data['account_name'] ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-sm-4 name">Alias *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on"
                                                               name="alias" id="alias" type="Text" value="<?php echo $data['alias_name'] ?>"
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
                                                        <input class="form-check-input" type="checkbox" value="" id1="<?php echo $data['default_bank'] ?>" id="bank_default" <?php if($data['default_bank'] == '1'){ echo 'checked';} ?> >
                        
                                                 </div>
                                          </div>
                                   </div>

                                          
                                         

                                  
                            </fieldset>


                            
                    
                                                 <br>
                                                 <tr>
                                                        <td colspan="2" align="right" width="100%">
                                                               <div class="modal-footer">
                                                                      <div class="form-group">
                                                                             <button type="button"
                                                                                    class="btn btn-default" id="close"
                                                                                    data-dismiss="modal">Cancel</button>
                                                                            <button type="submit" id="delete_bank"
                                                                                    class="btn btn-danger">Delete</button>
                                                                             <button type="submit" id="ubah_bank"
                                                                                    class="btn btn-warning ubah_bank">Ubah</button>
                                                                      </div>
                                                               </div>
                                                        </td>
                                                 </tr>
                               

                            </table>
                     </div>
              <!-- </form> -->
       </div>

</div>
<!-- </div> -->
<!-- </div> -->

<script>
$(document).ready(function() {
    $(document).on('click', '#ubah_bank', function(){
       var bank_name        = $('#bank_name').val();
       var bank_account     = $('#bank_account').val();
       var account_name     = $('#account_name').val();
       var alias            = $('#alias').val();
       var bank_default     = $('#bank_default').attr('id1');

       var number           = /^[0-9]+$/;

       // Validasi
       if(bank_name == ''){
              alert('Bank name cannot empty!');
              return;
       }else if(account_name == ''){
              alert('Bank account cannot empty!');
              return;
       }else if(alias == ''){
              alert('Bank alias cannot empty!');
              return;
       }else if(!bank_account.match(number)){
              alert('Bank account must number!');
              return;
       }
       // Validasi

       let formData = new FormData();
                formData.append('bank_name', bank_name);
                formData.append('bank_account', bank_account);
                formData.append('account_name', account_name);
                formData.append('alias', alias);
                formData.append('bank_default', bank_default);

       $.ajax({
                     type: 'POST',
                     url: "ajax_ubahbank.php",
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

    $(document).on('click', '#delete_bank', function(){
       var bank_account     = $('#bank_account').val();

       let formData = new FormData();
                formData.append('bank_account', bank_account);

       $.ajax({
                     type: 'POST',
                     url: "ajax_deletebank.php",
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

       $(document).on('change', '#bank_default', function(){
              var c   = $('#bank_default').attr('id1');
              // alert(c);
              if(c == '1'){
                     $('#bank_default').attr('id1', '0');
              }else if(c == '0'){
                     $('#bank_default').attr('id1', '1');  
              }
       });

       $(document).on('click', '#close', function(){
              window.close();
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
