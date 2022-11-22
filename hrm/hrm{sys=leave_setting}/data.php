<?php  
                                   // jika nip dan nama terisi
                                   $mynip                      = '';
                                   $myname                     = '';
                                   $inp_active                 = '';
                                   if (!empty($_POST['nip']) && !empty($_POST['full_name']) && !empty($_POST['inp_active'])) {
                                          $mynip               = $_POST['nip'];
                                          $myname              = $_POST['full_name'];
                                          $inp_active          = $_POST['inp_active'];
                                          $frameworks          = ",inp_emp :"."'".$mynip."' ,inp_name :"."'".$myname."' ,inp_active :"."'".$inp_active."'";
                                   // jika nip saja yang terisi
                                   } elseif (!empty($_POST['nip']) && !empty($_POST['full_name']) ) {
                                          $mynip               = $_POST['nip'];
                                          $myname              = $_POST['full_name'];
                                          $inp_active          = $_POST['inp_active'];
                                          $frameworks          = ",inp_emp :"."'".$mynip."' ,inp_name :"."'".$myname."' ";
                                   // jika nama saja yang terisi
                                   }  elseif (!empty($_POST['nip']) && !empty($_POST['inp_active']) ) {
                                          $mynip               = $_POST['nip'];
                                          $myname              = $_POST['full_name'];
                                          $inp_active          = $_POST['inp_active'];
                                          $frameworks          = ",inp_emp :"."'".$mynip."' ,inp_active :"."'".$inp_active."'";
                                   // jika nama saja yang terisi
                                   }  elseif (!empty($_POST['full_name']) && !empty($_POST['inp_active']) ) {
                                          $mynip               = $_POST['nip'];
                                          $myname              = $_POST['full_name'];
                                          $inp_active          = $_POST['inp_active'];
                                          $frameworks          = ",inp_name :"."'".$myname."' ,inp_active :"."'".$inp_active."'";
                                   // jika nama saja yang terisi
                                   } elseif (!empty($_POST['nip'])) {
                                          $mynip               = $_POST['nip'];
                                          $myname              = $_POST['full_name'];
                                          $inp_active          = $_POST['inp_active'];
                                          $frameworks          = ",inp_emp :"."'".$mynip."'";
                                   // jika nama saja yang terisi
                                   } elseif (!empty($_POST['full_name'])) {
                                          $mynip               = $_POST['nip'];
                                          $myname              = $_POST['full_name'];
                                          $inp_active          = $_POST['inp_active'];
                                          $frameworks          = ",inp_name :"."'".$myname."'";
                                   // jika tidak ada yang terisi
                                   } elseif (!empty($_POST['inp_active'])) {
                                          $mynip               = $_POST['nip'];
                                          $myname              = $_POST['full_name'];
                                          $inp_active          = $_POST['inp_active'];
                                          $frameworks          = ",inp_active :"."'".$inp_active."'";
                                   // jika tidak ada yang terisi
                                   } else { 
                                          $frameworks          = "";
                                   }
                            ?>



<?php
                            if (!empty($_POST['cari'])) {
                                   $filter = $_POST['cari'];
                                   $filterprint = 'Filter: Ticketing Number Is '.$_POST['cari'];
                            } else { 
                                   $filter = '';
                                   $filterprint = '';
                            }
                            ?>



<script>
$(document).ready(function() {
       var limit = 100;
       var start = 0;
       var action = 'inactive';

       function load_country_data(limit, start) {
              $.ajax({
                     url: "loadmore.php",
                     method: "POST",
                     data: {
                            limit: limit,
                            start: start <?php echo $frameworks; ?>
                     },
                     cache: false,
                     success: function(data) {
                            $('#example3LOAD').append(
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
              load_country_data(limit, start);
       }
       $(window).scroll(function() {
              if ($(window).scrollTop() + $(window).height() >
                     420 && action == 'inactive') {
                     action = 'active';
                     start = start + limit;
                     setTimeout(function() {
                            load_country_data(
                                   limit,
                                   start);
                     }, 1000);
              }
       });

});
</script>


<script>
$(document).ready(function() {
       var limit = 100;
       var start = 0;
       var action = 'inactive';

       function load_country_data(limit, start) {
              $.ajax({
                     url: "loadmore_group.php",
                     method: "POST",
                     data: {
                            limit: limit,
                            start: start <?php echo $frameworks; ?>
                     },
                     cache: false,
                     success: function(data) {
                            $('#LoadGroupData').append(
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
              load_country_data(limit, start);
       }
       $(window).scroll(function() {
              if ($(window).scrollTop() + $(window).height() >
                     420 && action == 'inactive') {
                     action = 'active';
                     start = start + limit;
                     setTimeout(function() {
                            load_country_data(
                                   limit,
                                   start);
                     }, 1000);
              }
       });

});
</script>


<div class="col-md-12">
       <div class="card">
              <div class="card-header d-flex align-items-center">
                     <h4 class="card-title mb-0">Employee Access Menu Information</h4>


                     <div class="card-actions ml-auto">
                            <table>
                                   <td>

                                          <a href='#' class='open_modal_search'>
                                                 <div class="toolbar sprite-toolbar-search" id="SEARCH" title="Search">
                                                 </div>
                                          </a>

                                   </td>

                            </table>


                     </div>
              </div>

              <div class="card-body table-responsive p-0"
                     style="width: 100vw;height: 78vh; width: 98.8%; margin: 5px;overflow: scroll;">


                     <body>


                           

                            <!-- TAB STARTTED -->

                            
                                   
                                   <table id="example3LOAD" width="99%" border="1" class="table table-bordered table-striped table-hover table-head-fixed">
                                                 <thead>
                                                        <tr>
                                                               <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">Leave Code</th>
                                                               <th class="fontCustom" style="z-index: 1;">Leave Name</th>
                                                               <th class="fontCustom" style="z-index: 1;">Eligibility Formula</th>
                                                               <th class="fontCustom" style="z-index: 1;">Day Type</th>
                                                               <th class="fontCustom" style="z-index: 1;">Deducted Leave</th>
                                                               <th class="fontCustom" style="z-index: 1;">Day Count</th>
                                                               <th class="fontCustom" style="z-index: 1;">Repeat Period</th>
                                                        </tr>

                                                 </thead>
                                          </table>
                      




                     </body>



                     
              </div>

              <div class='card-footer' style='background-color: #eee;height: 37px;padding-top: 5px;'>

                     <div class='row mb-2'>
                            <div class='col-sm-10'>
                                   <?php echo $filterprint; ?>
                            </div>
                            <div class='col-sm-2'>

                                   <div id="toolbarlist">
                                          <div class="toolbar-load sprite-toolbar-loadmore" id="ADD" title="Add"
                                                 onclick='return startloadmore()'
                                                 onclick="innerPop('?xfid=hrm.employee.add&amp;forcegen=1',reposBlock)">
                                                 <a onclick='return startloadmore()' class="down" href="#"><button>Load
                                                               More</a>
                                          </div>
                                   </div>


                            </div>
                     </div>

              </div>

       </div>
</div>
<div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
<!-- Column -->

<?php include "controller/con_access_save.php";?>


<!-- Javascript untuk popup modal Edit-->
<script type="text/javascript">
$(document).ready(function() {
       $(".open_modal_add").click(function(e) {
              var m = $(this).attr("id");
              $.ajax({
                     url: "modal_add.php",
                     type: "POST",
                     data: {
                            id: m,
                     },
                     success: function(ajaxData) {
                            $("#ModalEdit").html(ajaxData);
                            $("#ModalEdit").modal({
                                   backdrop: 'static',
                                   keyboard: 'false'
                            });
                     }
              });
       });
});
</script>