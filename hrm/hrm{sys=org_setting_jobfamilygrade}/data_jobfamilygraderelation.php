<?php 
include "../../application/session/session.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    $id = $_POST['id'];
}

// Query ambil data jobtile
$sql_jobtitle       = mysqli_query($connect, "SELECT 
b.jf_name_en,
c.jfgrade_name_en,
a.jfl_name_en
FROM teorjfl a
LEFT JOIN teomjf b ON b.jf_code = a.jf_code
LEFT JOIN teomjfgrade c ON c.jfgrade_code = a.jfgrade_code
WHERE a.jfgrade_code = '$id'");
// Query ambil data jobtile


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
                     <h4 class="modal-title">Job Family Relation</h4>
                     <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button> -->
              </div>


              <!-- <form method="post" id="myform"> -->

                            <fieldset id="fset_1">

                                   
                            <div class="card-body table-responsive p-0"
                                        style="width: 100vw;height: 78vh; width: 98.8%; margin: 5px;overflow: scroll;">
                                        <table id="example3LOAD" width="99%" border="1"
                                                class="table table-bordered table-striped table-hover table-head-fixed">


                                                <thead>
                                                    <tr>
                                                                <th class="fontCustom" style="z-index: 1;" >Job Family Grade</th>

                                                               <th class="fontCustom" style="z-index: 1;" >Job Family</th>
                                                               <th class="fontCustom" style="z-index: 1;" >Job Family Level</th>

                                                               


                                                               
                                                               

                                                        </tr>
                                                     

                                                </thead>
                                                <tbody>
                                                <?php 
                                                    while($data_family_relation = mysqli_fetch_assoc($sql_jobtitle)){
                                                ?>
                                                    <tr>
                                                    <td class='fontCustom'><?php echo $data_family_relation['jfgrade_name_en']; ?></td>

                                                        <td class='fontCustom'><?php echo $data_family_relation['jf_name_en']; ?></td>
                                                        <td class='fontCustom'><?php echo $data_family_relation['jfl_name_en']; ?></td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                                
                                                       

                                        </table>


                                        

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
