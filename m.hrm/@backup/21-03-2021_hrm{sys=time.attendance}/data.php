<!-- LOADER -->
<div onclick='return stopload()' id="loading-circle"></div>
<!-- LOADER -->

<?php include "../../model/ta/GMLeaveReqSearchGen.php"; ?>
<?php include "../../model/ta/GMLeaveReqList.php";      ?>

<?php  
       $inp_req             = '';
       $inp_date            = '';
       $inp_enddate         = '';
       // jika nip dan nama terisi
       if (!empty($_POST['inp_req']) && !empty($_POST['inp_date']) && !empty($_POST['inp_enddate'])) {
              $inp_req             = $_POST['inp_req'];
              $inp_date            = $_POST['inp_date'];
              $inp_enddate         = $_POST['inp_enddate'];
              $frameworks          = ",inp_req :"."'".$inp_req."' ,inp_date :"."'".$inp_date."' ,inp_enddate :"."'".$inp_enddate."'";
       // jika nip saja yang terisi
       } elseif (!empty($_POST['inp_req']) && !empty($_POST['inp_date'])) {
              $inp_req             = $_POST['inp_req'];
              $inp_date            = $_POST['inp_date'];
              $frameworks          = ",inp_req :"."'".$inp_req."' ,inp_date :"."'".$inp_date."'";
       // jika tidak ada yang terisi
       } elseif (!empty($_POST['inp_req'])) {
              $inp_req             = $_POST['inp_req'];
              $frameworks          = ",inp_req :"."'".$inp_req."'";
        // jika tidak ada yang terisi

       // AgusPrass 04/03/2021 menambahkan kondisi saat memfilter
       }elseif(empty($_POST['inp_req']) && !empty($_POST['inp_date']) && !empty($_POST['inp_enddate'])){
              $inp_date            = $_POST['inp_date'];
              $inp_enddate         = $_POST['inp_enddate'];
              $frameworks          = ",inp_date :"."'".$inp_date."' ,inp_enddate :"."'".$inp_enddate."'";
       }elseif(empty($_POST['inp_req']) && !empty($_POST['inp_date'])){
              $inp_date            = $_POST['inp_date'];
              $frameworks          = ",inp_date :"."'".$inp_date."'";
       }elseif(empty($_POST['inp_req']) && !empty($_POST['inp_enddate'])){
              $inp_enddate         = $_POST['inp_enddate'];
              $frameworks          = ",inp_enddate :"."'".$inp_enddate."'";
       }
       // AgusPrass 04/03/2021 menambahkan kondisi saat memfilter
       else {
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

                                   function load_employement_data(limit, start) {
                                          $.ajax({
                                                 url: "loadmore.php?emp_id=<?php echo $username; ?>",
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
                                                               $('#example3_messageS')
                                                                      .html(
                                                                             "<button type='button' class='btn btn-info'>No Data Found</button>"
                                                                             );
                                                               action = 'active';
                                                        } else {
                                                               $('#example3_messageS')
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
                                          load_employement_data(limit, start);
                                   }
                                   $(window).scroll(function() {
                                          if ($(window).scrollTop() + $(window).height() >
                                                 420 && action == 'inactive') {
                                                 action = 'active';
                                                 start = start + limit;
                                                 setTimeout(function() {
                                                        load_employement_data(
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
                                        <h4 class="card-title mb-0">Leave Request</h4>
                       

                                        <div class="card-actions ml-auto">
                                        <table>
                                        <td><a href='#' onclick='return startload()' class='open_modal_add'>
                                                               <div class="toolbar sprite-toolbar-add" id="add"
                                                                      title="Add"></div>
                                                        </a></td>
                                        <td>
                                        <a href='#' class='open_modal_search'>
                                                               <div class="toolbar sprite-toolbar-search" id="SEARCH"
                                                                      title="Search"></div>
                                                        </a>
                                        </td>

                                        <!-- AgusPrass 04/03/2021 Menghilangkan fungsi print -->
                                        <!-- <td>
                                        <a href='#' onclick='return stopload()'>
                                                        <div class="toolbar sprite-toolbar-print" id="PRINT"
                                                               title="Print"
                                                               onclick="popPrint('?prid=hrm.employee.listemp&amp;psize=A4&amp;porient=landscape');">
                                                        </div>
                                                        </a>
                                        </td> -->
                                        <td>
                                          <form action="../rfid=repository/cli_Template_Download/ta/TaDownloadGTTGRLeaveReqExport" method="POST">
                                          
                                          <input type="hidden" name="inp_req" value="<?php echo $inp_req; ?>">
                                          <input type="hidden" name="inp_date" value="<?php echo $inp_date; ?>">
                                          <input type="hidden" name="inp_enddate" value="<?php echo $inp_enddate; ?>">

                                                
                                                        <button type="submit" class="toolbar sprite-toolbar-excel" id="EXCEL" style="border: 0;background-color: white;" name="submit_approve" value="submit">
                                                        </button>


                                                  
                                          </form>
                                        </td>
                                        <!-- AgusPrass 02/03/2021 Menghilangkan # pada href-->
                                        <td>
                                        <a href='' onclick='return stopload()'>
                                                        <div class="toolbar sprite-toolbar-reload" id="RELOAD"
                                                               title="Reload" onclick="reloadPage();">
                                                        </div>
                                                        </a>
                                        </td>
                                        <!-- AgusPrass 02/03/2021 -->
                                        <!-- <td>
                                        <a href='#' onclick='return stopload()'>
                                                        <div class="toolbar sprite-toolbar-help" id="HELP" title="Help"
                                                               onclick="popPrint('/sf6help/index.cfm?HelpId=hrm.employee.listemp&amp;feat=5423CD04D3C08D9CC6FBC4C3787256C2E8D1BE39D4E9ABE1B8BD8CD2C25535B64D0E0D9FE8A0E6A1DD1E95AAD4FB1F4B9C13C9AF89C189B0CF247DE3A25EEC0D4ECFF90DD39A98EEDC27DAB66F06AED5336E315FA6CCC120EB4352EAD7B7A962F8CBDAA2AB0F4B02C09537CB0FEA11627B0911941F891C0308AFF2ACF1FDC101E0E3270708EDBFB6B256AEF8E3B6AAFEC6D8C379F1CCC5E00B63B88AFCD69BA32E5B43D132CDA5DB65E210C307DCCC23D32B8EC2A64AE3BD4E0BDEF94AA6A7CD17FCE1B78AF98E0AD33C8E42CF053283B404FBF91F9CABFB59CAD361BA474DF8972D8FC328AEDBCBAACB17D0F3A0B50393CED6A8B4CBE7F7129C28FF2BDDF38828DD00DF193C3CFF5503130038C903DFD34CD48F1ED0E2B4B146C7C4FB8A78C6CFABE299DACEC52D1F0767837AD3D0E9BECFE7C8D760BECFAEC8F14DB6CFCB27D1BFA7EFC8C7DBA6B50CE50DD2896EC92C0A&amp;ist=dataon1&amp;appacs=SINGLE&amp;lang=en');">
                                                        </div>
                                                        </a>
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
                                                               <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No.</th>
                                                               <th class="fontCustom" style="z-index: 1;">Request Number</th>
                                                               <th class="fontCustom" style="z-index: 1;">Request For</th>
                                                               <th class="fontCustom" style="z-index: 1;">Type of Leave</th>
                                                               <th class="fontCustom" style="z-index: 1;">Start Date</th>
                                                               <th class="fontCustom" style="z-index: 1;">End Date</th>
                                                               <th class="fontCustom" style="z-index: 1;">Total Days</th>
                                                               <th class="fontCustom" style="z-index: 1;">Remark</th>
                                                               <th class="fontCustom" style="z-index: 1;">Request Status</th>
                                                               <th class="fontCustom" style="z-index: 1;">Leave Category</th>
                                                               <th class="fontCustom" style="z-index: 1;">Attch</th>
                                                               <th class="fontCustom" style="z-index: 1;">Approval Status</th>

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
<?php include "controller/con_leave_revised.php";?>
<?php include "controller/con_leave_cancel.php";?>
<?php include "controller/con_leave_approval.php";?>
<?php include "controller/con_leave_submit_attachment.php";?>


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