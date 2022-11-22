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
                                   var id     = 1;

                                   function load_country_data(limit,start,id) {
                                          $.ajax({
                                                 url: "loadmore.php",
                                                 method: "POST",
                                                 data: {
                                                        limit: limit,
                                                        start: start <?php echo $frameworks; ?>,
                                                        id: id
                                                 },
                                                 cache: false,
                                                 success: function(data) {
                                                        $('#example3LOAD').html(
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
                                          load_country_data(limit, start,id);
                                   }
                                   // $(window).scroll(function() {
                                   //        if ($(window).scrollTop() + $(window).height() >
                                   //               420 && action == 'inactive') {
                                   //               action = 'active';
                                   //               start = start + limit;
                                   //               setTimeout(function() {
                                   //                      load_country_data(
                                   //                             limit,
                                   //                             start,id);
                                   //               }, 1000);
                                   //        }
                                   // });
                                   $(document).on('change', '#filter', function(){
                                          var id = $(this).val();
                                          // alert(id);
                                          setTimeout(function() {
                                                        load_country_data(
                                                               limit,
                                                               start,id);
                                                 }, 1000);
                                          
                                   });

                                   



                            });
                            </script>



<div class="col-md-12">
                                <div class="card">
                                    <div class="card-header d-flex align-items-center">
                                        <h4 class="card-title mb-0">List Survey</h4>
                       

                                        <div class="card-actions ml-auto">
                                        <table>
                                        <td>
                                        <!--<a href='#' class='open_modal_search'>
                                                               <div class="toolbar sprite-toolbar-search" id="SEARCH"
                                                                      title="Search"></div>
                                                        </a>
                                        </td>-->
                                        
                                        
                                        <!-- AgusPrass 02/03/2021 Menghapus # pada href -->
                                        <td>
                                        <a href='' class='open_modal_search'>
                                        <div class="toolbar sprite-toolbar-reload" id="RELOAD"
                                                               title="Reload" onclick="reloadPage();"></div>
                                                    
                                                        </a>
                                        </td>
                                        
                                        
                                        </table>
                                          

                                        </div>
                                    </div>

                                    <div class="card-body d-flex align-items-center">
                                          <div class="col-md-12">
                                                 <form method="" action="" onSubmit="" class="form-horizontal">
                                                        
                                                        <!-- <div class="from-row">
                                                               <div class="col-sm-1">
                                                                      <button type="button" style="margin-left:0px;" id="ongoing" id1="1" class="btn btn-primary btn-sm active">Ongoing</button>
                                                               </div>
                                                        </div>
                                                        <div class="from-row">
                                                               <div class="col-sm-1">
                                                                      <button type="button" style="margin-left:0px;" id="will" id1="2" class="btn btn-warning btn-sm">Will Come</button>
                                                               </div>
                                                        </div>
                                                        <div class="from-row">
                                                               <div class="col-sm-1">
                                                                      <button type="button" style="margin-left:0px;" id="done1" id1="3" class="btn btn-warning btn-sm">Done/Expired</button>
                                                               </div>
                                                        </div> -->
                                                        <div class="from">
                                                               <div class="col-sm-9"></div>
                                                               <div class="col-sm-1">Filter :</div>
                                                               <div class="col-sm-2">
                                                                      <select id="filter" class="form-control" name="orderessay[]">
                                                                             <option value="1">Ongoing</option>
                                                                             <option value="2">New</option>
                                                                             <option value="3">Done/Expired</option>
                                                                      </select>
                                                               </div>
                                                        </div>

                                                 </from>
                                          </div>
                                   </div>
                                   
                                   <div class="card-body "
                                        style="margin: 5px;"> 
                                        <table id="datatable" width="99%" border="1"
                                                class="table table-bordered table-striped table-hover table-head-fixed">


                                                <thead>
                                                        <tr>
                                                               <th class="fontCustom" style="z-index: 1;"  nowrap="nowrap">No.</th>
                                                               <th class="fontCustom" style="z-index: 1;" >ID Event</th>
                                                               <th class="fontCustom" style="z-index: 1;" >Judul</th>
                                                               <th class="fontCustom" style="z-index: 1;" >Tahun</th>
                                                               <th class="fontCustom" style="z-index: 1;" >Start Date</th>
                                                               <th class="fontCustom" style="z-index: 1;" >End Date</th>
                                                               <th class="fontCustom" style="z-index: 1;" >PIC Divisi</th>
                                                               <th class="fontCustom" style="z-index: 1;" >PIC Departement</th>
                                                               <th class="fontCustom" style="z-index: 1;" >Status</th>
                                                               <th class="fontCustom" style="z-index: 1;" >Survey</th>
                                                        </tr>

                                                </thead>

                                        </table>


                                        

                                <!-- </div> -->


                                <div class='card-footer' style='background-color: #eee;height: 37px;padding-top: 5px;'>

                                          <div class='row mb-2'>
                                                 <div class='col-sm-10'>
                                                        <?php echo $filterprint; ?>
                                                 </div>
                                                 <div class='col-sm-2'>

                                                        <div id="toolbarlist">
                                                               <div class="toolbar-load sprite-toolbar-loadmore" id="ADD"
                                                                      title="Add"
                                                                      onclick="innerPop('?xfid=hrm.employee.add&amp;forcegen=1',reposBlock)">
                                                                      <a class="down" href="#"><button>Load More</a></div>
                                                        </div>


                                                 </div>
                                          </div>

                                    </div>

                                
                            </div>
                            </div>

                            <!-- Column -->


<?php 
// include "controller/aksi_edit.php";
?>

                            


                            <script src="../../asset/vendor/datatable/datatables.min.js"></script>
                           


<script type="text/javascript" language="javascript" >
$(document).ready(function(){

       var id        = 1;
       $(document).on('change', '#filter', function(){
              id = $(this).val();
              
               // Load data
       dataTable = $("#datatable").DataTable({
              
              dom: "B<'row'<'col-sm-12 col-md-9'l><'col-sm-12 col-md-9'f>>" +
                   "<'row'<'col-sm-12'tr>>" +
                   "<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-7'p>>",

              processing: true,
              // retrieve: true,
              searching: false,
              paging: true,
              order: [
                     [0, "asc"]
              ],
               pagingType: "simple",
              bPaginate: true,
              bLengthChange: false,
              bFilter: false,
              bInfo: true,
              bAutoWidth: true,
              language: {
                     "processing": "Please wait..",
              },
              destroy: true,
              columnDefs:[
                     {
                            
                     },
              ], 
              "ajax": "ajax/data.php?id="+id+""
       });
        //    Load data
       });

     
        // Load data
       dataTable = $("#datatable").DataTable({
              
              dom: "B<'row'<'col-sm-12 col-md-9'l><'col-sm-12 col-md-9'f>>" +
                   "<'row'<'col-sm-12'tr>>" +
                   "<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-7'p>>",

              processing: true,
              // retrieve: true,
              searching: false,
              paging: true,
              order: [
                     [0, "asc"]
              ],
               pagingType: "simple",
              bPaginate: true,
              bLengthChange: false,
              bFilter: false,
              bInfo: true,
              bAutoWidth: true,
              language: {
                     "processing": "Please wait..",
              },
              destroy: true,
              columnDefs:[
                     {
                            
                     },
              ], 
              "ajax": "ajax/data.php?id="+id+""
       });
        //    Load data
})
</script>


<script type="text/javascript">
$(document).ready(function() {
       bsCustomFileInput.init();
});
</script>
<script type="text/javascript">
$(document).ready(function() {
       $(".id").change(function() {
              var id = $(this).val();
              var post_id = 'id=' + id;

              $.ajax({
                     type: "POST",
                     url: "fetch_filter_v2.php",
                     data: post_id,
                     cache: false,
                     success: function(cities) {
                            $(".module").html(cities);
                     }
              });

       });
});
</script>

<!-- <script type="text/javascript">
$(document).ready(function() {
       $("#ongoing").click(function(e) {
              var id = $(this).attr('id1');
              // alert(id);
              $.ajax({
                     type: "POST",
                     url: "loadmore.php",
                     data: id:id,
                     cache: false,
                     success: function(data) {
                            $("#example3LOAD").append(data);
                     }
              });

       });
});
</script> -->

<!-- <script type="text/javascript">
$(document).ready(function() {
       $("#done").click(function(e) {
              $("#example3LOAD").clear();+
              var id = $(this).attr('id1');
              // alert('Hahaha');
              $.ajax({
                     type: "POST",
                     url: "loadmore.php",
                     data: id:id,
                     cache: false,
                     success: function(data) {
                            $("#example3LOAD").append(data);
                            alert("hehehe");
                     }
              });

       });
});
</script> -->



<div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                   aria-hidden="true">
                            </div>