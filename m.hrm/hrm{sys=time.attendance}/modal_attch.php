<?php
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0'; 
if($getdata == 0) {
	include "../../application/session/session.php";
} else {
	include "../../application/session/mobile.session.php";	
}
?>

<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />

<?php
	$id = $_POST['id'];
	$modal=mysqli_query($connect, 
	"SELECT 
	a.*,
       b.emp_no,
       b.Full_name
	FROM hrmleaverequest a
       LEFT JOIN view_employee b on a.emp_id=b.emp_id
	WHERE a.request_no='$id'
	GROUP BY a.request_no
	");
	while($r=mysqli_fetch_array($modal)){
?>




<div class="modal-dialog modal-med">
       <div class="modal-content">

              <div class="modal-header">
                     <h4 class="modal-title">Leave Request Attachment <?php 
                     $id = $_POST['id'];
                     echo $id;
                     ?></h4>

              <div class="toolbar sprite-toolbar-close" aria-label="Close" onclick='return stopload()' data-dismiss="modal" id="SEARCH"
                                                                      title="Search"></div>
  
              </div>
              <form name='form1' method="post" id="multiple_upload_form" enctype="multipart/form-data"
                     onsubmit='return HrmsValidationForm()'>
                     <fieldset id="fset_1">
                            <legend>Attachment Submission Form</legend>
                            <!-- /**
                            *
                            * '||''|.                            '||
                            *  ||   ||    ....  .... ...   ....   ||    ...   ... ...  ... ..
                            *  ||    || .|...||  '|.  |  .|...||  ||  .|  '|.  ||'  ||  ||' ''
                            *  ||    || ||        '|.|   ||       ||  ||   ||  ||    |  ||
                            * .||...|'   '|...'    '|     '|...' .||.  '|..|'  ||...'  .||.
                            *                                                  ||
                            * --------------- FOR HIDDEN TYPE ------------- '''' -----------
                            */ -->
                            <input class="hidden"
                                   id="db_requestno"
                                   name="db_requestno" 
                                   type="hidden" 
                                   value="<?php echo $r['request_no'] ?>">
                            <!-- /**
                            *
                            * '||''|.                            '||
                            *  ||   ||    ....  .... ...   ....   ||    ...   ... ...  ... ..
                            *  ||    || .|...||  '|.  |  .|...||  ||  .|  '|.  ||'  ||  ||' ''
                            *  ||    || ||        '|.|   ||       ||  ||   ||  ||    |  ||
                            * .||...|'   '|...'    '|     '|...' .||.  '|..|'  ||...'  .||.
                            *                                                  ||
                            * --------------- FOR HIDDEN TYPE ------------- '''' -----------
                            */ -->
                            <div class="form-row">
                                   <div class="col-4 name">Employee no*</div>
                                   <div class="col-sm-8 name">
                                          <?php echo $r['emp_no'];?>
                                   </div>
                            </div>

                            <div class="form-row">
                                   <div class="col-4 name">Name*</div>
                                   <div class="col-sm-8 name">
                                          <?php echo $r['Full_name'];?>
                                   </div>
                            </div>

                            <div class="form-row" id="tr_inp_urgent_reason" style='display:none;'>
                                   <div class="col-4 name">Urgent Reason</div>
                                   <div class="col-sm-8">
                                          <div class="input-group">
                                                 <select name="sel_inp_urgreason" class="input--style-6 urgent_reason"
                                                        style="margin-bottom: 2px; width: 100%;height: 30px;">
                                                        <option>--Select One--</option>
                                                 </select>
                                          </div>
                                   </div>
                            </div>

                            <div class="form-row">
                                   <div class="col-4 name">File Attachment </div>
                                   <div class="col-sm-8">
                                          <div class="input-group js-input-file">
                                                 <input class="input-file" id="inp_refdoc" name="inp_refdoc[]"
                                                        type="File" value="" onfocus="hlentry(this)" size="30"
                                                        maxlength="50" style="float: left; margin: -3px;"
                                                        onchange="formodified(this);" title="">
                                          </div>
                                          <div class="label--desc">Upload any other relevant file. Max
                                                 file size 3 MB, doc,jpg,jpeg,ods,png,txt,doc,pdf </div>
                                   </div>
                            </div>

                            
                            

                            <fieldset id="fset_1">
                            <legend>List Attachment</legend>
                               
                                        <!-- <table border="1"
                                                class="table table-bordered table-striped table-hover table-head-fixed"> -->
                                          <table border="1" width="80%"
                                                class="table table-bordered table-striped table-hover table-head-fixed">
                                                <thead>
                                                        <tr>
                                                             
                                                               <th class="fontCustom" >Doc Number</th>
                                                               <th class="fontCustom" >File Name</th>
                                                          
                                                        </tr>
                                                </thead>
                                                 <?php
                                                        $sql = mysqli_query($connect, "SELECT `request_no`,`file_name`,DATE_FORMAT(`created_date`, '%d %M %Y %H:%i:%s') as `created_date` FROM hrmattachment where `request_no` = '$id' order by created_date desc");
                                                        $no = 0;
                                                        $no++;
                                                        while ($r = mysqli_fetch_array($sql)) {
                                                        ?>
                                                        <tr>
                                                        
                                                        <td href='#'><?php echo $r['request_no']; ?></td>
                                                        <td class='fontCustom'>
                                                               <a href='../../asset/request.file.attachment/<?php echo $r['file_name'];?>' onclick='return startload()'>
                                                              
                                                               <?php
                                                               $num_char = 20;
                                                               $print = $r['file_name'];
                                                               echo substr($print, 0, $num_char) . '...';
                                                               ?>
                                                               </a>
                                                               <br>
                                                               <?php echo $r['created_date']; ?>

                                                               <button type="button" id="mymodal" class="btn btn-primary" data-toggle="modal" data-target="#myModal" data-src="../../asset/request.file.attachment/<?php echo $r['file_name'];?>">
                                                               see file
                                                               </button>

                                                             
                                                              
                                                        </td>
                                                      
                                                 <?php
                                                 }                    
                                                 ?>
                                        </table>
                              
                            </fieldset>
                         

                     </fieldset>


                     <tr>
                            <td colspan="3" align="right" width="100%">
                                   <div class="modal-footer">
                                          <div class="form-group">
                                                 <button onclick='return stopload()' type="button"
                                                        class="btn btn-default" data-dismiss="modal">Cancel</button>

                                                 


                                                 <button type="submit" name="submit_add_attachment"
                                                        class="btn btn-warning">Upload</button>
                                          </div>
                                   </div>
                            </td>
                     </tr>

              </form>

<?php } ?>












       </div>

</div>
</div>
</div>


             

              <script>
              jQuery(document).ready(function(e) {
                     $('button').on('click', function(e) {
                     $img = $(this).attr("data-src");
                     $('#myModal iframe').attr('src', $img);
                     });
              });
              </script>

              <script>
                     var uploadField = document.getElementById("inp_refdoc");
                            // doc,jpg,ods,png,txt,doc,pdf
                     var allowedFiles = [".doc",".jpg",".jpeg",".ods",".png",".txt",".docx",".pdf"];
                     var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");

                     uploadField.onchange = function() {
                     if(this.files[0].size > 3145728){
                            alert("File is too large, max file upload is 3MB !");
                            this.value = "";
                     } else if (!regex.test(uploadField.value.toLowerCase())) {
                            alert("Only file [doc,jpg,jpeg,ods,png,txt,doc,pdf] allowed");
                            this.value = "";
                     };
                     };
              </script>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

<div class="modal-dialog modal-med">
       <div class="modal-content" style="margin-top: 100px; width:99%">





    <div class="modal-content">
      
       <iframe height="400px">
       </iframe>
    </div>
  </div>
</div>




</body>
</html>