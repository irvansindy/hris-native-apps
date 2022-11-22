<?php include "../../application/session/session.php";?>


<!-- AgusPrass 09 Maret 2021 -->

<!-- Menampilkan data request -->
<?php
       $emp = $_POST['id']; //Mengambil data req no dari tabel
       $emp_name = $_POST['id2']; //Mengambil data req no dari tabel
       
       $var1 = array("^");
	   $var2 = array(" ");
	   $conversion = str_replace($var1, $var2, $emp_name); 

       $datareq = mysqli_query($connect,"SELECT * FROM ttadattendancetemp WHERE emp_no='$emp' and starttime='$conversion' LIMIT 1
                                          "); // Query untuk mengambil dari leave request
       
       while($row1=mysqli_fetch_array($datareq)){


?>



<div class="modal-dialog modal-med">
       <div class="modal-content">

              <div class="modal-header">
                     <h4 class="modal-title">Attendance Attachment</h4>
                     <div class="toolbar sprite-toolbar-close" aria-label="Close" onclick='return stopload()' data-dismiss="modal" id="SEARCH"
                                                                      title="Search"></div>
              </div>
              <form name='form1' method="post" id="multiple_upload_form" enctype="multipart/form-data"
                     onsubmit='return HrmsValidationForm()'>
                     <fieldset id="fset_1">
                            <legend>Attachment Information</legend>

                            <div class="form-row">
                                   <div class="col-4 name">Employee no*</div>
                                   <div class="col-sm-8 name"> <?php echo $row1['emp_no'];?>
                                          <div class="input-group">

                                                 <input class="hidden"
                                                        onkeyup="isi_otomatis(), isi_otomatis_leave()"
                                                        autocomplete="off" autofocus="on" id="modal_emp"
                                                        name="modal_emp" type="hidden" value="<?php echo $row1['emp_no'];?>"
                                                        onfocus="hlentry(this)"
                                                        validate="NotNull:Invalid Form Entry"
                                                        onchange="formodified(this);" title="">

                                          </div>
                                   </div>
                            </div>

                            <div class="form-row">
                                   <div class="col-4 name">Photos*</div>
                                   <div class="col-sm-8 name"> 
                                         <div class="col-sm-8 name"> <img style="max-width: 100px;" src="../../API/uploads/<?php echo $row1['photos'];?>">
                                   </div>
                            </div>
</fieldset>

                           

                     

              </form>

              <?php } ?>











             