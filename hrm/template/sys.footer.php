<!-- The modals -->
<div id="mymodals_withhref_passed" class="modals" style="display: none;z-index: 9999;">
       <div class="modals-content">
              <p>
              <table width="100%">
                     <tr>
                            <td align="center"><img src="../../asset/dist/img/passed.png" style="max-width: 90%;margin-top: 20px;"></td>
                     </tr>
                     <tr>
                            <td style="width: 85%; font-weight:bold;color: #777b7b;" align="center">
                                   <p class="digital" id="msg_href_passed"></p><br>
                                   <button type='submit' style="padding: 1px;" type='button' class="btn digital btn-warning button_bot closeds_withhref_passed">
                                          Close
                                   </button>
                            </td>
                     </tr>
              </table>
              </p>
       </div>
</div>
<!-- The modals -->
<script>
       // Get the modals
       var modals_href_passed = document.getElementById("mymodals_withhref_passed");
       var span_href_passed = document.getElementsByClassName("closeds_withhref_passed")[0];
       span_href_passed.onclick = function() {
              modals_href_passed.style.display = "none";
              window.location.href = '';
       }
</script>


<!-- The modals -->
<div id="mymodals_withhref_failed" class="modals" style="display: none;z-index: 9999;">
       <div class="modals-content">
              <p>
              <table width="100%">
                     <tr>
                            <td align="center"><img src="../../asset/dist/img/failed.png" style="max-width: 90%;margin-top: 20px;"></td>
                     </tr>
                     <tr>
                            <td style="width: 85%; font-weight:bold;color: #777b7b;" align="center">
                                   <p class="digital" id="msg_href_failed"></p><br>
                                   <button type='submit' style="padding: 1px;" type='button' class="btn digital btn-warning button_bot closeds_withhref_failed">
                                          Close
                                   </button>
                            </td>
                     </tr>
              </table>
              </p>
       </div>
</div>
<!-- The modals -->
<script>
       // Get the modals
       var modals_href_failed = document.getElementById("mymodals_withhref_failed");
       var span_href_failed = document.getElementsByClassName("closeds_withhref_failed")[0];
       span_href_failed.onclick = function() {
              modals_href_failed.style.display = "none";
              window.location.href = '';
       }
</script>





<!-- The modals -->
<div id="mymodals_withhref" class="modals" style="display: none;z-index: 9999;">
       <div class="modals-content">
              <p>
              <table width="100%">
                     <tr>
                            <td align="center"><img src="../../asset/dist/img/sf-mola-mola.png" style="max-width: 90%;margin-top: 20px;"></td>
                     </tr>
                     <tr>
                            <td style="width: 85%; font-weight:bold;color: #777b7b;" align="center">
                                   <p class="digital" id="msg_href"></p><br>
                                   <button type='submit' style="padding: 1px;" type='button' class="btn digital btn-warning button_bot closeds_withhref">
                                          Close
                                   </button>
                            </td>
                     </tr>
              </table>
              </p>
       </div>
</div>
<!-- The modals -->
<script>
       // Get the modals
       var modals_href = document.getElementById("mymodals_withhref");
       var span_href = document.getElementsByClassName("closeds_withhref")[0];
       span_href.onclick = function() {
              modals_href.style.display = "none";
              window.location.href = '';
       }
</script>



<!-- The modals -->
<div id="mymodals" class="modals" style="display: none;z-index: 9999;">
       <div class="modals-content" style="background: whitesmoke;border-radius: 4px;width: 264px;margin-top: 62px;">
              <p>
              <table width="100%">
                     <tr>
                            <td align="center"><img src="../../asset/dist/img/sf-mola-mola.png" style="max-width: 90%;margin-top: 20px;"></td>
                     </tr>
                     <tr>
                            <td style="width: 85%; font-weight:bold;color: #777b7b;" align="center">
                                   <p class="digital" id="msg"></p>
                                   <button type='submit' style="padding: 1px;" type='button' class="btn digital btn-warning button_bot closeds">
                                          Close
                                   </button>
                            </td>
                     </tr>
              </table>
              </p>
       </div>
</div>
<!-- The modals -->
<script>
       // Get the modals
       var modals = document.getElementById("mymodals");
       var span = document.getElementsByClassName("closeds")[0];
       span.onclick = function() {
              modals.style.display = "none";
       }
</script>




<!-- The modalss -->
<div id="mymodalss" class="modals" style="display: none;z-index: 9999;">
       <div class="modals-content-loader">
              <p>
              <table width="100%">
                     <tr>
                            <td align="center"><span class="spinner large">
                                          <span class="bar bar1"></span>
                                          <span class="bar bar2"></span>
                                          <span class="bar bar3"></span>
                                   </span>
                                   <font color="white" >Please wait. loading..</font>
                            </td>
                     </tr>
              </table>
              </p>
       </div>
</div>
<!-- The modalss -->
<script>
       // Get the modalss
       var modalss = document.getElementById("mymodalss");
       var span = document.getElementsByClassName("closed")[0];
       span.onclick = function() {
              modalss.style.display = "none";
       
       }
       window.onclick = function(event) {
              if (event.target == modalss) {
                     modalss.style.display = "none";
              }
       }
</script>
<!-- The modalsss -->
<div id="mymodals2" class="modals" style="display: none;z-index: 9999;">
       <div class="modals-content">
              <p>
              <table width="100%">
                     <tr>
                            <td align="center"><img src="../../asset/dist/img/sf-mola-mola.png" style="max-width: 90%;margin-top: 20px;"></td>
                     </tr>
                     <tr>
                            <td style="width: 85%; font-weight:bold;color: #777b7b;" align="center">
                                   <p class="digital" id="msg">Data refreshed</p><br>
                                   <!-- <button type='submit' onclick="myFunctionForClose()" name='submit_add' id='submit_add' style="padding: 1px;" type='button' class="btn digital btn-warning button_bot closeds">
                        Close
                    </button> -->

                                   <button class="btn digital btn-warning" style="width: 50%;" onclick="myFunctionForClose()" type="submit" name="submit_delete" id="submit_delete">
                                          Close
                                   </button>
                            </td>
                     </tr>
              </table>
              </p>
       </div>
</div>
<!-- The modalss -->
<script>
       function myFunctionForClose() {
              document.getElementById("mymodals2").style.display = "none";
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
<!-- <script>
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
                                                        start: start <php echo $frameworks; ?>
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
                                                                             "<button type='button' class='btn digital btn-warning'>Please Wait....</button>"
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
                            </script> -->
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
       @media (max-width:960px) {
              .footer {
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

       @media (min-width:960px) {
              .footer {
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

       :root {
              --avatar-size: 10rem;
              /* change this value anything, e.g., 100px, 10rem, etc. */
       }

       .circle {
              background-color: #ccc;
              border-radius: 50%;
              height: var(--avatar-size);
              text-align: center;
              width: var(--avatar-size);
       }

       .initials {
              font-size: calc(var(--avatar-size) / 2);
              /* 50% of parent */
              line-height: 1;
              position: relative;
              top: calc(var(--avatar-size) / 4);
              /* 25% of parent */
       }
</style>



<!-- footer -->
<!-- ============================================================== -->
<?php
if ($footer == 'yes') {
       echo "<footer class='footer'>
                            Human Resource Information System | app version 4.10.1
                     </footer>";
} else if ($footer == 'no') {
       echo '';
}
?>
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
       document.onreadystatechange = function() {
              var state = document.readyState
              if (state == 'interactive') {
                     document.getElementById('contents').style.visibility = "hidden";
              } else if (state == 'complete') {
                     setTimeout(function() {
                            document.getElementById('interactive');
                            document.getElementById('divBlockSpace').style.visibility = "hidden";
                            document.getElementById('contents').style.visibility = "visible";
                     }, 100);
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
       $(function() {
              $("#example1").DataTable();
              $("#example3").DataTable({
                     "ordering": false,
                     "sort": false
              });
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
       $(document).ready(function() {
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
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js">
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

<!-- MAIN DATATABLE SERVERSIDE CSS -->
<!-- MAIN DATATABLE SERVERSIDE CSS -->
<script type="text/javascript" src="../../asset/sdk_datatables_core/gt_dist/jquery.dataTables.min.js"></script>
<!-- MAIN DATATABLE SERVERSIDE CSS -->
<!-- MAIN DATATABLE SERVERSIDE CSS -->