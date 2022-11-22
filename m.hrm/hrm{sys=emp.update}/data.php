
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








                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header d-flex align-items-center">
                                        <h4 class="card-title mb-0">Employee Information</h4>
                       

                                        <div class="card-actions ml-auto">
                                        <table>
                                        
                                        <td>
                                          <form action="../rfid=repository/cli_Template_Download/eo/DownloadGTTGREmployeeExport.php" method="POST">
                                          
                                          <input type="hidden" name="inp_emp" value="<?php echo $mynip; ?>">
                                          <input type="hidden" name="inp_name" value="<?php echo $myname; ?>">

                                   
                                          <button type="submit" class="toolbar sprite-toolbar-excel" id="EXCEL" style="border: 0;background-color: white;" name="submit_approve" value="submit">
                                                        </button>
                                                  
                                          </form>
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
                                        style="width: 100vw; height: 23vh; width: 98.8%; margin: 5px;overflow: scroll;">
                                        <table id="example3LOAD" width="99%" border="1"
                                                class="table table-bordered table-striped table-hover table-head-fixed">


                                                <thead>
                                                        <tr>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">Employee No.</th>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">Employee Name</th>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">Gender</th>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">Cost Code</th>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">Work Location</th>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">Position</th>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">Grade</th>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">Join Date</th>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">Employment Code</th>
                                                      
                                                        </tr>

                                                </thead>

                                        </table>
                                        
                                    </div>

                                    <!-- <div class='card-footer' style='background-color: #eee;height: 37px;padding-top: 5px;'>

                                          <div class='row mb-2'>
                                                 <div class='col-sm-10'>
                                                      
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

                                    </div> -->

                                </div>
                            </div>
                            <div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                   aria-hidden="true">
                            </div>
                            <!-- Column -->


                            <?php include "controller/con_leave_save.php";?>


                        
<style>
.footer2 {
       position: fixed;
       left: 0;
       bottom: 0;
       width: 100%;
       background-color: #fff;
       color: white;
       text-align: center;
       z-index: 2;
}
/* KALO VIEW MOBILE */
@media (max-width:960px) { 
       .button_bot {
              background-color: #F68A22;
              border: solid 1px #DCDFDE;
              font-weight: bold;
              color: #E1E1E1;
              width: 100%;
              height: 50px;
              padding: 12px;
              text-align: center;
              text-decoration: none;
              display: inline-block;
              font-size: 14px;
              margin: 1px 1px;
              cursor: pointer;
              border-radius: 40px;
       }
       .button_bot[disabled]{
              background-color: #F68A22;
              border: solid 1px #DCDFDE;
              font-weight: bold;
              color: #E1E1E1;
              width: 100%;
              height: 50px;
              padding: 12px;
              text-align: center;
              text-decoration: none;
              display: inline-block;
              font-size: 14px;
              margin: 1px 1px;
              cursor: pointer;
              border-radius: 40px;
       }

       
}
/* KALO VIEW WEB */
@media (min-width:960px) { 
       .button_bot {
              background-color: #F68A22;
              border: solid 1px #DCDFDE;
              font-weight: bold;
              color: #E1E1E1;
              width: 40%;
              height: 50px;
              padding: 12px;
              text-align: center;
              text-decoration: none;
              display: inline-block;
              font-size: 14px;
              margin: 1px 1px;
              cursor: pointer;
              border-radius: 40px;
       }
       .button_bot[disabled]{
              background-color: #F68A22;
              border: solid 1px #DCDFDE;
              font-weight: bold;
              color: #E1E1E1;
              width: 40%;
              height: 50px;
              cursor: no-drop;
              padding: 12px;
              text-align: center;
              text-decoration: none;
              display: inline-block;
              font-size: 14px;
              margin: 1px 1px;
              cursor: pointer;
              border-radius: 40px;
       }
} 
</style>


<footer class='footer2'>
       <form action='edit' method='POST' style="margin: 10px;" onsubmit='return HrmsValidationForm()'>
              <input type='hidden' class='hidden' value='<?php echo $username; ?>' type='text' name='rfid'>
              
              <?php 
              $is_active = mysqli_query($connect, "SELECT 
                                                        *
                                                        FROM mgtools_period
                                                         WHERE CURDATE() BETWEEN period_start AND period_end");
              if(mysqli_num_rows($is_active) > 0){
                     echo '<button type="submit" name="submit_add" id="submit_add" type="button" class="btn btn-warning button_bot">
                            Update Data
                            </button>';
              } else {
                     echo '<button type="submit" style="background-color: #3090E4;" name="submit_add" id="submit_add" type="button" class="btn btn-primary button_bot">
                            Preview Data
                            </button>';
              }
              ?>
              

              <button class="btn btn-warning button_bot" type="button" name="submit_add2"
                     id="submit_add2" style="display:none; cursor: no-drop;" disabled>
                     <img src="../../asset/dist/img/Rolling-0.6s-200px.gif" width="30">
              </button>
       </form>
</footer>

<script>
function HrmsValidationForm() {
       $('#submit_add').hide();
       $('#submit_add2').show();
}
</script>