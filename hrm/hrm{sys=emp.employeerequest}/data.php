<script src="vendor/modal/bootstrap.min.js"></script>

<?php
$search_en             = '';
$search_ea             = '';
// jika nip dan nama terisi
if (!empty($_POST['search_en'])) {
       $search_en             = $_POST['search_en'];
       // AgusPrass 04/03/2021 menambahkan kondisi saat memfilter
}
if (!empty($_POST['search_ea'])) {
       $search_ea                = $_POST['search_ea'];
}
?>


<?php
if (!empty($_POST['cari'])) {
       $filter = $_POST['cari'];
       $filterprint = 'Filter: Ticketing Number Is ' . $_POST['cari'];
} else {
       $filter = '';
       $filterprint = '';
}

?>


<!-- Modal -->
<div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" data-backdrop="false">
       <div class="modal-dialog" role="document">
              <div class="modal-content">
                     <div class="modal-body">

                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                            <form method="post" id="myform">
                                   <fieldset id="fset_1" style="margin-top: 25px;border-radius: 5px;border: 1px solid #e4e8ea;">
                                          <legend>Searching</legend>
                                          <div class="form-row">
                                                 <div class="col-4 name">Employee No</div>
                                                 <div class="col-sm-8">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off" autofocus="on" id="search_en" name="search_en" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50"  validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-row">
                                                 <div class="col-4 name">Employee Name</div>
                                                 <div class="col-sm-8">
                                                        <div class="input-group">

                                                               <input class="input--style-6" autocomplete="off" autofocus="on" name="search_ea" id="search_ea" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50"  validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
                                                        </div>
                                                 </div>
                                          </div>

                                   </fieldset>

                                   <button class="btn btn-warning" type="submit" style="width: 100%;border-radius: 17px;font-weight: bold;letter-spacing: 1px;font-size: 12px;">
                                          Filter
                                   </button>
                            </form>
                     </div>

              </div><!-- modal-content -->
       </div><!-- modal-dialog -->
</div><!-- modal -->


<style>
       body {
              font-family: Arial;
       }

       /* Style the tab */
       .tab {
              overflow: hidden;
              border: 1px solid #ccc;
              background-color: #f1f1f1;
       }

       /* Style the buttons inside the tab */
       .tab button {
              background-color: inherit;
              float: left;
              border: none;
              outline: none;
              cursor: pointer;
              padding: 14px 16px;
              transition: 0.3s;
              font-size: 12px;
       }

       /* Change background color of buttons on hover */
       .tab button:hover {
              background-color: #ddd;
       }

       /* Create an active/current tablink class */
       .tab button.active {
              background-color: #ccc;
       }

       /* Style the tab content */
       .tabcontent {
              display: none;
              padding: 6px 12px;
              border: 1px solid #ccc;
              border-top: none;
       }

       /* Style the close button */
       .topright {
              float: right;
              cursor: pointer;
              font-size: 28px;
       }

       .topright:hover {
              color: red;
       }
</style>

<div class="col-md-12">
       <div class="card">
              <!--  -->

              <div class="card-body " style="margin: 5px;">

                     <div class="tab">
                            <button class="tablinks" id="emp_req" style="font-family: verdana;font-size: 10px;">Employee Request</button>
                            <button class="tablinks" id="my_inbox" style="font-family: verdana;font-size: 10px;">My Inbox</button>
                     </div>

                     <!-- TAB STARTTED -->

                     <div class="card-body table-responsive p-0" style="width: 100vw;height: 78vh; width: 98.8%; margin: 5px; margin: 5px;overflow: scroll;">

                            <div id="tampilansetting" class=""></div>


                     </div>



              </div>


              <div class='card-footer' style='background-color: #eee;height: 37px;padding-top: 5px;'>

                     <div class='row mb-2'>
                            <div class='col-sm-10'>
                                   <?php echo $filterprint; ?>
                            </div>
                            <div class='col-sm-2'>

                            </div>

                     </div>


              </div>
       </div>


       <!-- Modal untuk reqest requester -->
       <div class="modal fade" id="modal-view-request">
              <div class="modal-dialog modal-md">
                     <div class="modal-content">
                            <div class="modal-header">
                                   <h4 class="modal-title" id="title_modal"></h4>
                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                          <span aria-hidden="true">&times;</span>
                                   </button>
                            </div>
                            <div id="yanampilmodal"></div>

                     </div>
                     <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
       </div>
       <!-- /.modal -->
       <!-- Modal untuk reqest requester -->




       <!-- Modal untuk reqest requester -->
       <div class="modal fade" id="modal-default">
              <div class="modal-dialog modal-md">
                     <div class="modal-content">
                            <div class="modal-header">
                                   <h4 class="modal-title" id="title_tambah"></h4>
                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                          <span aria-hidden="true">&times;</span>
                                   </button>
                            </div>

                            <div id="tampil_tambah"></div>
                     </div>


                     <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
       </div>
       <!-- /.modal -->
       <!-- Modal untuk reqest requester -->

       <!-- Modal untuk reqest requester -->
       <div class="modal fade" id="modal-preview_approver">
              <div class="modal-dialog modal-md">
                     <div class="modal-content">
                            <div class="modal-header">
                                   <h4 class="modal-title" id="title_preview_app"></h4>
                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                          <span aria-hidden="true">&times;</span>
                                   </button>
                            </div>
                            <!-- <div class="card-body table-responsive p-0" style="width: 100vw; height: 89vh; width: 100%; margin: 5px; overflow: scroll;"> -->
                            <div id="tampil_view_app">

                            </div>
                            <!-- </div> -->

                     </div>
                     <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
       </div>
       <!-- /.modal -->
       <!-- Modal untuk reqest requester -->






       <script src="../../asset/vendor/datatable/datatables.min.js"></script>


       <script type="text/javascript" language="javascript">
              $(document).ready(function() {
                     // Default active button
                     var element1 = document.getElementById("emp_req");
                     element1.classList.add("active");
                     // Default active button

                     emp_request();

                     $(document).on('click', '#emp_req', function() {
                            var element1 = document.getElementById("emp_req");
                            var element2 = document.getElementById("my_inbox");

                            element1.classList.add("active");
                            element2.classList.remove("active");

                            emp_request();

                     });

                     $(document).on('click', '#my_inbox', function() {
                            var element1 = document.getElementById("emp_req");
                            var element2 = document.getElementById("my_inbox");

                            element1.classList.remove("active");
                            element2.classList.add("active");

                            my_box();

                     });

                     function emp_request() {
                            $.ajax({
                                   url: "ajax/emp_request.php",
                                   type: "POST",
                                   data: {

                                   },
                                   success: function(ajaxData) {
                                          $("#tampilansetting").html(ajaxData);

                                   }
                            });
                     }

                     function my_box() {
                            $.ajax({
                                   url: "ajax/emp_inbox.php",
                                   type: "POST",
                                   data: {

                                   },
                                   success: function(ajaxData) {
                                          $("#tampilansetting").html(ajaxData);

                                   }
                            });
                     }



              })
       </script>