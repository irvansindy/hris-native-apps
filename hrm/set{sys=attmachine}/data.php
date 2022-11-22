<?php
//1. ALERT 
date_default_timezone_set('Asia/Bangkok'); 
$SFtime_current         = date('Y-m-d h:i');
!empty($_POST['rfid']) ? $getdata = $_POST['rfid'] : $getdata = '0';
!empty($_POST['pesan']) ? $getmsg = $_POST['pesan'] : $getmsg = '0';
!empty($_POST['filtered']) ? $getfilter = $_POST['filtered'] : $getfilter = '0';
if($getdata == 'create') {
       if($SFtime_current == $getfilter){
              echo "<script type='text/javascript'>
                    $(document).ready(function(){
                                modals.style.display = 'block';
                                document.getElementById('msg').innerHTML = '$getmsg';
                                return false;
                    });
                    </script>";
       } else {
              echo "<script type='text/javascript'>
                    $(document).ready(function(){
                                modals.style.display = 'block';
                                document.getElementById('msg').innerHTML = '$getmsg';
                                return false;
                    });
                    </script>";
       }
}

//2. ALERT                                 
$src_machine_code            = '';
$src_method              = '';

       //JIKA TERISI SEMUA
       if (!empty($_POST['src_machine_code']) && !empty($_POST['src_method'])) {
              $src_machine_code     = $_POST['src_machine_code'];
              $src_method       = $_POST['src_method'];
              $frameworks        = ",
                                          src_machine_code :"."'".$src_machine_code."',
                                          src_method :"."'".$src_method."'
                                   ";
       //JIKA TERISI HANYA SHIFT
       } else if (!empty($_POST['src_machine_code']) && empty($_POST['src_method'])) {
              $src_machine_code     = $_POST['src_machine_code'];
              $src_method       = $_POST['src_method'];
              $frameworks        = ",
                                          src_machine_code :"."'".$src_machine_code."',
                                          src_method :"."'".$src_method."'
                                   ";
       //JIKA TERISI HANYA DAYTYPE
       } else if (empty($_POST['src_machine_code']) && !empty($_POST['src_method'])) {
              $src_machine_code     = $_POST['src_machine_code'];
              $src_method       = $_POST['src_method'];
              $frameworks        = ",
                                          src_machine_code :"."'".$src_machine_code."',
                                          src_method :"."'".$src_method."'
                                   ";
       //ELSE
       } else { 
              $frameworks        = "";
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
                                        <h4 class="card-title mb-0">Attendance Machine</h4>
                       

                                        <div class="card-actions ml-auto">
                                        <table>

                                        <td>
                                          <div onclick="return startload()" class="toolbar sprite-toolbar-add open_modal_add" id="add" title="Add"></div>
                                        </td>
                                        
                                        <td>
                                          <form action="../rfid=repository/cli_Template_Download/st/StFunctionDownload.php?filedata=StDownloadGTTGRAttMachineData.php&filename=Attendance Machine" method="POST">
                                                 <input type="hidden" name="src_machine_code" value="<?php echo $src_machine_code; ?>">
                                                 <input type="hidden" name="src_method" value="<?php echo $src_method; ?>">
                                                 <button type="submit" class="toolbar sprite-toolbar-excel" id="EXCEL" style="border: 0;background-color: white;" name="submit_approve" value="submit"></button>
                                          </form>
                                        </td>
                                        <td>
                                        
                                        <a href='#' onclick="return startload()" class='open_modal_search'>
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
                                        
                                       
                                        
                                        </table>
                                          

                                        </div>
                                    </div>

                                   
                                                 

                                    <div class="card-body table-responsive p-0"
                                        style="width: 100vw;height: 78vh; width: 98.8%; margin: 5px;overflow: scroll;">
                                        <table id="example3LOAD" width="99%" border="1"
                                                class="table table-bordered table-striped table-hover table-head-fixed">


                                                <thead>
                                                        <tr>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No</th>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">Machine Code</th>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">Method</th>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">File Type</th>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">File Extension</th>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">Use In/Out Flag</th>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">Datasource</th>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">Table Name</th>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">In Code</th>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">Out Code</th>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">Break Start Code</th>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">Break End Code</th>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">Attendance ID based on</th>
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


<!-- Column -->                    
<div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
       aria-hidden="true">
</div>
<!-- Column -->

<!-- Javascript untuk popup modal Edit-->
<script type="text/javascript">
$(document).ready(function() {
       $(".open_modal_add").click(function(e) {
              var m = $(this).attr("id");
              $.ajax({
                     url: "_modal_create.php?modal_header=Add Attendance Machine&emp_id=<?php echo $username; ?>",
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