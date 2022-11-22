<script type="text/javascript">
$(document).ready(function(){
              window.location.href = '#';
});
</script>
<script src="vendor/modal/bootstrap.min.js"></script>
<style>
    .modalDialog {
        position: fixed;
        font-family: Arial, Helvetica, sans-serif;
        top: 32%;
        right: 35%;
        bottom: 0;
        left: 0;
        /* background: rgba(0,0,0,0.8); */
        z-index: 99999;
        opacity:0;
        transition: opacity 200ms ease-in;
        pointer-events: none;
    }
    .modalDialog:target {opacity:1; pointer-events: auto;}
    .modalDialog > div {
        width: 400px;
        height:180px;
        position: relative;
        margin: 10% auto;
        padding: 5px 20px 13px 20px;
        border-radius: 10px;
        background: #fff;
        /* background: linear-gradient(#fff, #aaa); */
        border: 1px solid black;
        box-shadow: 2px 5px #888888;
    }
    .closemodal:hover { background:#00d9ff; }
    .closemodal {
        background: #606061;
        color: #FFFFFF;

        position: absolute;
        text-align: center;
        
        text-decoration: none;
        font-weight: bold;

    }
    .closepopup:hover { background:#00d9ff; }
    .closepopup {
        background: #606061;
        color: #FFFFFF;
        line-height: 25px;
        position: absolute;
        text-align: center;
        top: -10px;
        right: -12px;
        width: 24px;
        text-decoration: none;
        font-weight: bold;
        border-radius: 12px;
        box-shadow: 1px 1px 3px #000;
    }
     

/* button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
} */
span.psw {
    float: right;
}
 
    </style>
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
                                                <!-- <script>
                                          $(document).ready(function(){
                                          $("#emp_no").click(function(){
                                          $("#div1").fadeIn();
                                          $("#div2").fadeIn("slow");
                                          $("#div3").fadeIn(3000);
                                          });
                                          });
                                          </script>
                                          <button>Click to fade in boxes</button><br><br> -->

                                                <thead>
                                                        <tr>
                                                                <th class="fontCustom" id="emp_no" style="z-index: 1;" nowrap="nowrap">Employee No.</th>
                                                                  <div id="div1" class="popsearch" style="top: 60px; width: 142px; left: 5px; height: 100px;display:none;background-color:red;"></div><br>
                                                                      <style>
                                                                      .popsearch {
                                                                             position: absolute;
                                                                             overflow: hidden;
                                                                      }
                                                                      </style>
                                                                <!-- <div id="div1" class="popsearch" style="top: 60px; width: 142px; left: 86px; height: 100px;"><br><div id="div1" class="txtsearch-headbar" style="position: absolute; top: 0px; width: 142px;"><span style="width: 142px;"><input id="txtSearch_2" type="Text" maxlength="255" onkeyup="checkSubmit(event,this,2);" onblur="checkSubmit(event,this,2);" style="width: 100%;"></span></div></div> -->

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
                                    
                                   

                                    <div class='card-footer' style='background-color: #eee;height: 37px;padding-top: 5px;'>

                                          <div class='row mb-2'>
                                                 <div class='col-sm-10'>
                                                        <?php echo $filterprint; ?>
                                                 </div>
                                                 <div class='col-sm-2'>

                                                        <div id="toolbarlist">
                                                               <div class="toolbar-load sprite-toolbar-loadmore" id="ADD"
                                                                      title="Add"
                                                                      onclick='return startloadmore()'>
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


<div class="modal fade" id="modal-default">
          <div class="modal-dialog modal-bg">
            <div class="modal-content">
              <div class="modal-header">
                     <h4 class="modal-title" id="title_tambah"></h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
              </div>
             
              <div id="tampil_profile"></div>
              </div>
            
           
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <!-- Modal untuk reqest requester -->

<div id="open" class="modalDialog" style="display:">
    <div>
        <a href="#" title="Close" class="closepopup">X</a>
        <div id="popupprofile"></div>
    </div>
</div>

<script type="text/javascript" language="javascript" >
$(document).ready(function(){
       $(document).on('click', '#testopen', function(){

       const penghapusan = $(".modalDialog");
       penghapusan.css("display", ""); 

       var id = $(this).attr('id1');

       // mymodalss.style.display = "block";
 
       $.ajax({
       url: "profile.php",
       type: "POST",
              data: {
                     id:id,
              },
              success: function(ajaxData) {
                     $("#popupprofile").html(ajaxData);
                     // mymodalss.style.display = "none";
              }
       });

       });
});

$(document).ready(function(){
       $(document).on('click', '#modal_view_profile', function(){

       const penghapusan = $(".modalDialog");
       penghapusan.css("display", "none");

       var id = $(this).attr('id1');
       $('#title_tambah').html('Profile');

       // alert(nc);  
       $.ajax({
       url: "modal_profile.php",
       type: "POST",
              data: {
                     id:id,
              },
              success: function(ajaxData) {
                     $("#tampil_profile").html(ajaxData);
                     // alert(ajaxData);
              }
       });

       });
});
</script>

                            