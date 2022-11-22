<!-- LOADER -->
<div onclick='return stopload()' id="loading-circle"></div>
<!-- LOADER -->



<?php  
       // jika nip dan nama terisi
       if (!empty($_POST['nip']) && !empty($_POST['full_name'])) {
              $mynip = $_POST['nip'];
              $myname = $_POST['full_name'];
              $frameworks = ",empnip :"."'".$mynip."' ,empname :"."'".$myname."'";
       // jika nip saja yang terisi
       } elseif (!empty($_POST['nip'])) {
              $mynip = $_POST['nip'];
              $myname = $_POST['full_name'];
              $frameworks = ",empnip :"."'".$mynip."'";
       // jika nama saja yang terisi
       } elseif (!empty($_POST['full_name'])) {
              $mynip = $_POST['nip'];
              $myname = $_POST['full_name'];
              $frameworks = ",empname :"."'".$myname."'";
       // jika tidak ada yang terisi
       } else { 
              $frameworks = "";
       }
?>

<div class="col-md-12">

<div class="row">
                    <!-- Column -->
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><i class="text-success fa fa-circle font-10 mr-2 "></i>Leave Request</h4>
                                <h6 class="card-subtitle"></h6>
                                <div  style="height: 300px;">

                                
                                <div class="card-body table-responsive p-0"
                                        style="width: 100vw;height: 280px; width: 98.8%; margin: 5px;overflow: scroll;">
                                        <table id="example3LOAD" width="99%" border="1"
                                                class="table table-bordered table-striped table-hover table-head-fixed">
                                                <thead>
                                                        <tr>
                                                               <th class="fontCustom" style="background-color: lightgray;z-index: 1;">No.</th>
                                                               <th class="fontCustom" style="background-color: lightgray; z-index: 1;" nowrap="nowrap">Req. No.</th>
                                                               <th class="fontCustom" style="background-color: lightgray; z-index: 1;" nowrap="nowrap">Leave Code</th>
                                                                <th class="fontCustom" style="background-color: lightgray;z-index: 1;" nowrap="nowrap">Start Date</th>
                                                                <th class="fontCustom" style="background-color: lightgray;z-index: 1;" nowrap="nowrap">End Date</th>
                                                                <th class="fontCustom" style="background-color: lightgray;z-index: 1;" nowrap="nowrap">Total Days</th>
                                                                <th class="fontCustom" style="background-color: lightgray;z-index: 1;" nowrap="nowrap">Status</th>
                                                        </tr>
                                                </thead>
                                        </table>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <ul class="list-inline">
                                   <!-- AgusPrass 02/03/2021 Merubah -->
                                        <!-- <li class="list-inline-item px-2">
                                            <h6 class="text-success"><i class="fa fa-circle font-10 mr-2 "></i>Leave Request
                                            </h6>
                                        </li> -->
                                   <!-- AgusPrass 02/03/2021 Merubah -->
                                        <li class="list-inline-item px-2">
                                            <h6 class=" text-info"><i class="fa fa-circle font-10 mr-2"></i>ANL, AWLV, MNLV, MTLV</h6>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><i class="text-success fa fa-circle font-10 mr-2 "></i>Permission</h4>
                                <h6 class="card-subtitle"></h6>
                                <div  style="height: 300px;">

                                
                                <div class="card-body table-responsive p-0"
                                        style="width: 100vw;height: 280px; width: 98.8%; margin: 5px;overflow: scroll;">
                                        <table id="req_permit" width="99%" border="1"
                                                class="table table-bordered table-striped table-hover table-head-fixed">


                                                <thead>
                                                        <tr>
                                                               <th class="fontCustom" style="background-color: lightgray;z-index: 1;">No.</th>
                                                               <th class="fontCustom" style="background-color: lightgray; z-index: 1;" nowrap="nowrap">Req. No.</th>
                                                               <th class="fontCustom" style="background-color: lightgray; z-index: 1;" nowrap="nowrap">Leave Code</th>
                                                                <th class="fontCustom" style="background-color: lightgray;z-index: 1;" nowrap="nowrap">Start Date</th>
                                                                <th class="fontCustom" style="background-color: lightgray;z-index: 1;" nowrap="nowrap">End Date</th>
                                                                <th class="fontCustom" style="background-color: lightgray;z-index: 1;" nowrap="nowrap">Total Days</th>
                                                                <th class="fontCustom" style="background-color: lightgray;z-index: 1;" nowrap="nowrap">Status</th>
                                                        </tr>

                                                </thead>

                                        </table>
                                    </div>
         
                                
                                </div>

                                
                                
                                
                                <div class="text-center">
                                    <ul class="list-inline">
                                   <!-- AgusPrass 02/03/2021 Merubah -->
                                        <!-- <li class="list-inline-item px-2">
                                            <h6 class="text-success"><i class="fa fa-circle font-10 mr-2 "></i>Permission
                                            </h6>
                                        </li> -->
                                   <!-- AgusPrass 02/03/2021 Merubah -->
                                        <li class="list-inline-item px-2">
                                            <h6 class=" text-info"><i class="fa fa-circle font-10 mr-2"></i>PDPR, PERMIT, PERMITHALF</h6>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->

                    <!-- AgusPrass 02/03/2021 Merubah -->
                    <!-- <div class="col-lg-4 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><i class="text-success fa fa-circle font-10 mr-2 "></i>Sickness</h4>
                                <h6 class="card-subtitle"></h6>
                                <div  style="height: 300px;">

                                
                                <div class="card-body table-responsive p-0"
                                        style="width: 100vw;height: 280px; width: 98.8%; margin: 5px;overflow: scroll;">
                                        <table id="req_sickness" width="99%" border="1"
                                                class="table table-bordered table-striped table-hover table-head-fixed">


                                                <thead>
                                                        <tr>
                                                               <th class="fontCustom" style="background-color: lightgray;z-index: 1;">No.</th>
                                                               <th class="fontCustom" style="background-color: lightgray; z-index: 1;" nowrap="nowrap">Req. No.</th>
                                                               <th class="fontCustom" style="background-color: lightgray; z-index: 1;" nowrap="nowrap">Leave Code</th>
                                                                <th class="fontCustom" style="background-color: lightgray;z-index: 1;" nowrap="nowrap">Start Date</th>
                                                                <th class="fontCustom" style="background-color: lightgray;z-index: 1;" nowrap="nowrap">End Date</th>
                                                                <th class="fontCustom" style="background-color: lightgray;z-index: 1;" nowrap="nowrap">Total Days</th>
                                                                <th class="fontCustom" style="background-color: lightgray;z-index: 1;" nowrap="nowrap">Status</th>
                                                        </tr>

                                                </thead>

                                        </table>
                                    </div>
         
                                
                                </div>
                                
                                <div class="text-center">
                                    <ul class="list-inline">
                                        <li class="list-inline-item px-2">
                                            <h6 class="text-success"><i class="fa fa-circle font-10 mr-2 "></i>Sickness
                                            </h6>
                                        </li>
                                        <li class="list-inline-item px-2">
                                            <h6 class=" text-info"><i class="fa fa-circle font-10 mr-2"></i>HOSP, OSIC, SICK, SICKHALF</h6>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- Column -->
                    <!-- AgusPrass 02/03/2021 Merubah -->
                    <!-- Column -->
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><i class="text-success fa fa-circle font-10 mr-2 "></i>Dispensation</h4>
                                <h6 class="card-subtitle"></h6>
                                <div  style="height: 300px;">

                                
                                <div class="card-body table-responsive p-0"
                                        style="width: 100vw;height: 280px; width: 98.8%; margin: 5px;overflow: scroll;">
                                        <table id="req_dispensation" width="99%" border="1"
                                                class="table table-bordered table-striped table-hover table-head-fixed">


                                                <thead>
                                                        <tr>
                                                        <th class="fontCustom" style="background-color: lightgray;z-index: 1;">No.</th>
                                                               <th class="fontCustom" style="background-color: lightgray; z-index: 1;" nowrap="nowrap">Req. No.</th>
                                                               <th class="fontCustom" style="background-color: lightgray; z-index: 1;" nowrap="nowrap">Leave Code</th>
                                                                <th class="fontCustom" style="background-color: lightgray;z-index: 1;" nowrap="nowrap">Start Date</th>
                                                                <th class="fontCustom" style="background-color: lightgray;z-index: 1;" nowrap="nowrap">End Date</th>
                                                                <th class="fontCustom" style="background-color: lightgray;z-index: 1;" nowrap="nowrap">Total Days</th>
                                                                <th class="fontCustom" style="background-color: lightgray;z-index: 1;" nowrap="nowrap">Status</th>
                                                        </tr>

                                                </thead>

                                        </table>
                                    </div>
         
                                
                                </div>
                                
                                <div class="text-center">
                                    <ul class="list-inline">
                                   <!-- AgusPrass 02/03/2021 Merubah -->
                                        <!-- <li class="list-inline-item px-2">
                                            <h6 class="text-success"><i class="fa fa-circle font-10 mr-2 "></i>Dsipensation
                                            </h6>
                                        </li> -->
                                   <!-- AgusPrass 02/03/2021 Merubah -->
                                        <li class="list-inline-item px-2">
                                            <h6 class=" text-info"><i class="fa fa-circle font-10 mr-2"></i>BPT, CCM, DCF, DOR, DSCI, ECB, EML, EWMCL, GRD, GRDC, HCF, PLG, UMR, UMRCMP</h6>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    
                </div>











                                

                                   

                  
                            </div>
                            <div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                   aria-hidden="true">
                            </div>
                            <!-- Column -->




<section class="content">
       <div class="row">

              <div class="col-12">
                    
                                          <!-- /.col -->
                                   </div>
                                   <!-- /.row -->
</section>

                            <script>
                            $(document).ready(function() {
                                   var limit = 100;
                                   var start = 0;
                                   var action = 'inactive';

                                   function load_country_data(limit, start) {
                                          $.ajax({
                                                 url: "../../view/da/VMDashboardLeaveList.php?emp_id=<?php echo $username; ?>",
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

                                   function load_country_data_s(limit, start) {
                                          $.ajax({
                                                 url: "../../view/da/VMDashboardPermitList.php?emp_id=<?php echo $username; ?>",
                                                 method: "POST",
                                                 data: {
                                                        limit: limit,
                                                        start: start <?php echo $frameworks; ?>
                                                 },
                                                 cache: false,
                                                 success: function(data) {
                                                        $('#req_permit').append(
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


                            <script>
                            $(document).ready(function() {
                                   var limit = 100;
                                   var start = 0;
                                   var action = 'inactive';

                                   function load_country_data_s(limit, start) {
                                          $.ajax({
                                                 url: "../../view/da/VMDashboardSicknessList.php?emp_id=<?php echo $username; ?>",
                                                 method: "POST",
                                                 data: {
                                                        limit: limit,
                                                        start: start <?php echo $frameworks; ?>
                                                 },
                                                 cache: false,
                                                 success: function(data) {
                                                        $('#req_sickness').append(
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


                            <script>
                            $(document).ready(function() {
                                   var limit = 100;
                                   var start = 0;
                                   var action = 'inactive';

                                   function load_country_data_s(limit, start) {
                                          $.ajax({
                                                 url: "../../view/da/VMDashboardDispensationList.php?emp_id=<?php echo $username; ?>",
                                                 method: "POST",
                                                 data: {
                                                        limit: limit,
                                                        start: start <?php echo $frameworks; ?>
                                                 },
                                                 cache: false,
                                                 success: function(data) {
                                                        $('#req_dispensation').append(
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

                            