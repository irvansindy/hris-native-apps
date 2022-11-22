<!-- LOADER -->
<div onclick='return stopload()' id="loading-circle"></div>
<!-- LOADER -->


<?php  
       $inp_emp             = '';
       $inp_name            = '';
       $inp_date            = '';
       $inp_enddate         = '';
       // jika nip dan nama terisi
       if (!empty($_POST['inp_emp']) && !empty($_POST['inp_name']) && !empty($_POST['inp_date']) && !empty($_POST['inp_enddate'])) {
              $inp_emp             = $_POST['inp_emp'];
              $inp_name            = $_POST['inp_name'];
              $inp_date            = $_POST['inp_date'];
              $inp_enddate         = $_POST['inp_enddate'];
              $frameworks          = ",inp_emp :"."'".$inp_emp."' ,inp_name :"."'".$inp_name."' ,inp_date :"."'".$inp_date."' ,inp_enddate :"."'".$inp_enddate."'";
       // jika nip saja yang terisi
       } elseif (!empty($_POST['inp_emp'])) {
              $inp_emp             = $_POST['inp_emp'];
              $inp_name            = $_POST['inp_name'];
              $inp_date            = $_POST['inp_date'];
              $inp_enddate         = $_POST['inp_enddate'];
              $frameworks          = ",inp_emp :"."'".$inp_emp."'";
       // jika nama saja yang terisi
       } elseif (!empty($_POST['inp_name'])) {
              $inp_emp             = $_POST['inp_emp'];
              $inp_name            = $_POST['inp_name'];
              $inp_date            = $_POST['inp_date'];
              $$inp_enddate        = $_POST['inp_enddate'];
              $frameworks          = ",inp_name :"."'".$inp_name."'";
       // jika tidak ada yang terisi
       } elseif (!empty($_POST['inp_date'])) {
              $inp_emp             = $_POST['inp_emp'];
              $inp_name            = $_POST['inp_name'];
              $inp_date            = $_POST['inp_date'];
              $inp_enddate         = $_POST['inp_enddate'];
              $frameworks          = ",inp_date :"."'".$inp_date."'";
        // jika tidak ada yang terisi
       } elseif (!empty($_POST['inp_enddate'])) {
              $inp_emp             = $_POST['inp_emp'];
              $inp_name            = $_POST['inp_name'];
              $inp_date            = $_POST['inp_date'];
              $inp_enddate         = $_POST['inp_enddate'];
              $frameworks          = ",inp_enddate :"."'".$inp_enddate."'";
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
                                                 url: "loadmore.php?user=<?php echo $username; ?>",
                                                 method: "POST",
                                                 data: {
                                                        limit: limit,
                                                        start: start <?php echo $frameworks; ?>
                                                 },
                                                 cache: false,
                                                 success: function(data) {
                                                        $('#tableOTSetting').append(
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
                                        <h4 class="card-title mb-0">Attendance Data</h4>
                       

                                        <div class="card-actions ml-auto">
                                        <table>
                                        <td>
                                        <a href='#' class='open_modal_search'>
                                                               <div class="toolbar sprite-toolbar-search" id="SEARCH"
                                                                      title="Search"></div>
                                                        </a>
                                        </td>
                                     
                                       
                                        <td>
                                        <a href="" onclick="return stopload()">
                                                        <div class="toolbar sprite-toolbar-reload" id="RELOAD" title="Reload" onclick="reloadPage();">
                                                        </div>
                                                        </a>
                                        </td>
                                        
                                        </table>
                                          

                                        </div>
                                    </div>

                                    <div class="card-body table-responsive p-0"
                                        style="width: 100vw;height: 78vh; width: 98.8%; margin: 5px; margin: 5px;overflow: scroll;">
                                        <table id="tableOTSetting" width="100%"
                                                class="table table-bordered table-striped table-hover table-head-fixed">


                                                <thead>
                                                <tr bordercolor="#000000">
                                                <td rowspan="3" class="header-data" nowrap="nowrap" align="center">Employee No.</td>
                                                <td rowspan="3" class="header-data" nowrap="nowrap" align="center">Employee Name</td>
                                                        <td rowspan="3" class="header-data" nowrap="nowrap" align="center">Date</td>
                                                        <td rowspan="3" class="header-data" align="center">Shift</td>
                                                        <td rowspan="3" class="header-data" align="center">Day Type</td>
                                                        <td rowspan="2" colspan="2" class="header-data" align="center">Shift Daily</td>
                                                        <td colspan="4" class="header-data" align="center">Actual Time</td>
                                                       
                                                        <td rowspan="3" class="header-data" align="center">Status</td>
                                                      
                                                        <td rowspan="3" class="header-data" align="center">Remark</td>
                                                        <td rowspan="2" colspan="2" class="header-data" align="center">Position Status</td>
                                                        <td rowspan="3" class="header-data" nowrap="nowrap" align="center">Photos</td>
                                                 </tr>
                                                 <tr bordercolor="#000000">
                                                        <td colspan="2" class="header-data" align="center"> in </td>
                                                        <td colspan="2" class="header-data" align="center"> Out</td>
                                                 </tr>
                                                 <tr bordercolor="#000000">
                                                        <td class="header-data" align="center"> in </td>
                                                        <td class="header-data" align="center"> Out</td>
                                                        <td class="header-data" align="center">Time</td>
                                                        <td class="header-data" align="center">+/-Minute(s)</td>
                                                        <td class="header-data" align="center">Time</td>
                                                        <td class="header-data" align="center">+/-Minute(s)</td>
                                                        <td class="header-data" align="center"> in </td>
                                                        <td class="header-data" align="center"> Out</td>
                                                 
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
                                                                      onclick="innerPop('?xfid=hrm.employee.add&amp;forcegen=1',reposBlock)">
                                                                      <a class="down" href="#"><button>Load More</a></div>
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







<section class="content">
       <div class="row">

              <div class="col-12">



                     <div class="modal fade" id="modal-default">
                            <div class="modal-dialog modal-lg">
                                   <div class="modal-content">
                                          <div class="modal-header">
                                                 <h4 class="modal-title">Add Ticket</h4>
                                                 <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                 </button>
                                          </div>
                                          <div class="modal-body">
                                                 <form method="post" id="multiple_upload_form"
                                                        enctype="multipart/form-data">

                                                        <!-- Untuk mengecek apakah sedang di submit atau tidak -->
                                                        <input type="hidden" name="image_form_submit" value="1" />
                                                        <table width="100%">

                                                               <div class="row">

                                                                      <div class="form-group col-4">
                                                                             <select name="id"
                                                                                    class="form-control select2bs4 id"
                                                                                    style="width: 100%;"
                                                                                    required="required">
                                                                                    <option value="">Choose Apps *
                                                                                    </option>
                                                                                    <?php
                      $sql = mysqli_query($connect,"select * from ticket_apps where id $employee_access");
                      while($row=mysqli_fetch_array($sql))
                      {
                      echo '<option value="'.$row['id'].'">'.$row['ticket_apps'].'</option>';
                      } ?>
                                                                             </select>
                                                                      </div>

                                                                      <div class="form-group col-4">
                                                                             <select name="module"
                                                                                    class="form-control select2bs4 module"
                                                                                    style="width: 100%;"
                                                                                    required="required">
                                                                                    <option>Select Menu *</option>
                                                                             </select>
                                                                      </div>
                                                                      <div class="form-group col-4">

                                                                             <select name="task"
                                                                                    class="form-control select2bs4 "
                                                                                    style="width: 100%;"
                                                                                    required="required">
                                                                                    <option value="">Select Task *
                                                                                    </option>
                                                                                    <?php
                      $sql = mysqli_query($connect,"select * from ticket_type");
                      while($row=mysqli_fetch_array($sql))
                      {
                      echo '<option value="'.$row['id'].'">'.$row['type'].'</option>';
                      } ?>
                                                                             </select>
                                                                      </div>
                                                               </div>

                                                               <div class="row">
                                                                      <div class="form-group col-12">
                                                                             <input name="subject" type="text"
                                                                                    class="form-control"
                                                                                    required="required"
                                                                                    placeholder="Subject">
                                                                      </div>
                                                               </div>

                                                               <div class="row">
                                                                      <div class="form-group col-12">
                                                                             <textarea name="content" class="ckeditor"
                                                                                    id="editor-basic"></textarea>
                                                                      </div>
                                                               </div>


                                                               <tr>
                                                                      <td colspan="2" width="100%">
                                                                             <div class="form-group">
                                                                                    <label for="exampleInputFile">Attachment
                                                                                           : </label>
                                                                                    <div class="input-group">
                                                                                           <div class="custom-file">
                                                                                                  <input type="file"
                                                                                                         name="images[]"
                                                                                                         id="images"
                                                                                                         multiple
                                                                                                         class="custom-file-input">
                                                                                                  <label class="custom-file-label"
                                                                                                         for="exampleInputFile">Choose
                                                                                                         file</label>
                                                                                           </div>
                                                                                           <div
                                                                                                  class="input-group-append">
                                                                                                  <span class="input-group-text"
                                                                                                         id="">Upload</span>
                                                                                           </div>
                                                                                    </div>
                                                                             </div>
                                                                      </td>
                                                               </tr>

                                                               <tr>
                                                                      <table cellpadding="1" cellspacing="1"
                                                                             style="width:100%">
                                                                             <tbody>
                                                                                    <tr>
                                                                                           <td
                                                                                                  style="background-color:#ffcc33; width:100%">
                                                                                                  <ul>
                                                                                                         <li><strong><span
                                                                                                                              style="color:#ffffff">Please
                                                                                                                              do
                                                                                                                              not
                                                                                                                              attach
                                                                                                                              documents
                                                                                                                              containing
                                                                                                                              confidential
                                                                                                                              data</span></strong><br />
                                                                                                                &nbsp;
                                                                                                                <ol>
                                                                                                                       <li><strong><span
                                                                                                                                            style="color:#ffffff">Max
                                                                                                                                            upload
                                                                                                                                            size:
                                                                                                                                            3MB</span></strong>
                                                                                                                       </li>
                                                                                                                       <li><span
                                                                                                                                     style="color:#ffffff"><strong>Only
                                                                                                                                            for
                                                                                                                                            Image
                                                                                                                                            and
                                                                                                                                            document
                                                                                                                                            file
                                                                                                                                            (.jpg,
                                                                                                                                            .jpeg,
                                                                                                                                            .gif,
                                                                                                                                            .doc,
                                                                                                                                            .docx,
                                                                                                                                            .xls,
                                                                                                                                            .xlsx,
                                                                                                                                            .pdf,
                                                                                                                                            .txt,
                                                                                                                                            .odt,
                                                                                                                                            .ods,
                                                                                                                                            .zip,
                                                                                                                                            and
                                                                                                                                            *.rar)</strong></span>
                                                                                                                       </li>
                                                                                                                </ol>
                                                                                                         </li>
                                                                                                  </ul>
                                                                                           </td>
                                                                                    </tr>
                                                                             </tbody>
                                                                      </table>


                                                               </tr><br>


                                                               <tr>
                                                                      <td colspan="2" align="right" width="100%">
                                                                             <div class="modal-footer">
                                                                                    <div class="form-group">
                                                                                           <button type="button"
                                                                                                  class="btn btn-default"
                                                                                                  data-dismiss="modal">Cancel</button>
                                                                                           <button type="submit"
                                                                                                  name="in_modal_added"
                                                                                                  class="btn btn-warning">Submit</button>
                                                                                    </div>
                                                                             </div>
                                                                      </td>
                                                               </tr>






                                                               </html>


                                                               <!-- /.card -->
                                          </div>
                                          <!-- /.col -->
                                   </div>
                                   <!-- /.row -->
</section>


<?php include "controller/con_leave_save.php";?>
<?php include "controller/con_leave_edit.php";?>
<?php include "controller/con_leave_delete.php";?>
<?php include "controller/con_leave_approval.php";?>


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