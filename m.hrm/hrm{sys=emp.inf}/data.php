


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
                                   var limit = 500;
                                   var start = 0;
                                   var action = 'inactive';

                                   function load_country_data(limit, start) {
                                          $.ajax({
                                                 url: "loadmore.php?emp_id=<?php echo $username; ?>",
                                                 method: "POST",
                                                 data: {
                                                        limit: limit,
                                                        start: start <?php echo $frameworks; ?>
                                                 },
                                                 cache: false,
                                                 success: function(data) {
                                                        $('#example3LOAD').append(data);
                                                        $('#loader-datatable').hide();
                                                        if ('#example3LOAD' == '') {
                                                               action = 'active';
                                                               $('#msg').hide();
                                                        } else {
                                                               modalss.style.display = "none";
                                                               action = 'inactive';
                                                        }
                                                 }
                                          });
                                   }

                                   if (action == 'inactive') {
                                          action = 'active';
                                          modalss.style.display = "block";
                                          document.getElementById("msg").innerHTML = "Please wait load data ..";
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
                                        <h4 class="card-title mb-0">Employee Information</h4>
                       

                                        <div class="card-actions ml-auto">
                                        <table>
                                        
                                        
                                        <td>
                                        
                                        <a href='#' class='open_modal_search'>
                                                               <div class="toolbar sprite-toolbar-search" id="SEARCH"
                                                                      title="Search"></div>
                                                        </a>

                                        </td>
                                        <!-- AgusPrass 02/03/2021 Menghapus # pada href-->
                                        <td>
                                          <a href='' onclick='return stopload()'>
                                                        <div class="toolbar sprite-toolbar-reload" id="RELOAD"
                                                               title="Reload" onclick="reloadPage();">
                                                        </div>
                                                        </a>
                                        </td>
                                        <!-- AgusPrass 02/03/2021 -->
                                        
                                        <!-- <td>
                                        <div class="toolbar sprite-toolbar-add" id="add" title="Add"></div>
                                        </td> -->
                                        
                                        </table>
                                          

                                        </div>
                                    </div>

                                    <div class="card-body table-responsive p-0"
                                        style="width: 100vw;height: 78vh; width: 98.8%; margin: 5px;overflow: scroll;">
                                        <table id="example3LOAD" width="99%" border="1"
                                                class="table table-bordered table-striped table-hover table-head-fixed">


                                                <thead>
                                                        <tr>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">Employee No.</th>
                                                                <th class="fontCustom" style="z-index: 1;">Employee Name</th>
                                                                <th class="fontCustom" style="z-index: 1;">Gender</th>
                                                                <th class="fontCustom" style="z-index: 1;">Cost Code</th>
                                                                <th class="fontCustom" style="z-index: 1;">Work Location</th>
                                                                <th class="fontCustom" style="z-index: 1;">Position</th>
                                                                <th class="fontCustom" style="z-index: 1;">Grade</th>
                                                                <th class="fontCustom" style="z-index: 1;">Join Date</th>
                                                                <th class="fontCustom" style="z-index: 1;">Employment Code</th>
                                                        </tr>
                                                        <tr id="loader-datatable" name="loader-datatable" class="loader-datatable" style="border: 1px solid white;border-bottom: 1px solid #ececec;">
                                                               <td style="border: 1px solid #ececec;background: #fbfbfb;text-align: left;" colspan="9"><p id="msg" name="msg" class="loader-datatable"></p></td>
                                                        </tr>
                                                </thead>

                                        </table>
                                    </div>

                                    <div class='card-footer' style='background-color: #eee;height: 37px;padding-top: 5px;'>

                                          <div class='row mb-2'>
                                                 <div class='col-sm-10'>
                                                        <?php echo $filterprint; ?>
                                                 </div>
                                                 <div class='col-sm-2'>

                                                        <div id="toolbarlist">
                                                               <div class="toolbar-load sprite-toolbar-loadmore" id="ADD"
                                                                      title="Add"
                                                                      onclick='return startloadmore()'
                                                                      onclick="innerPop('?xfid=hrm.employee.add&amp;forcegen=1',reposBlock)">
                                                                      <a onclick='return startloadmore()' class="down" href="#"><button>Load More</a></div>
                                                        </div>


                                                 </div>
                                          </div>

                                    </div>

                                </div>
                            </div>
                            <div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                   aria-hidden="true">
                            </div>
                            <!-- Column -->