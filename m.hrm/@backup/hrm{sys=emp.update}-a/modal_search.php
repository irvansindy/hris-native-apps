<?php include "../../application/session/session.php";?>
<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />

<?php
$key = $_GET['id'];
$key1 = $_GET['username'];

$get_cek_file    = mysqli_query($connect, "SELECT a.attachment,a.ext FROM mgtools_attachment a WHERE a.document_file = '$key' and emp_id = '$key1'");
$get_cek_file_r  = mysqli_fetch_array($get_cek_file);
if(mysqli_num_rows($get_cek_file) != '0'){
       $any_file = $get_cek_file_r['attachment'];
       $ext_file = $get_cek_file_r['ext'];

       if($ext_file == 'pdf'){
              $attch = '<embed type="application/pdf" src="../../asset/list_document/'.$any_file.'" width="100%" height="800"></embed>';   
       } else {
              $attch = '<img style="width: 95%;;margin-bottom: 20px;min-height: 115px; margin: 10px 10px 10px 10px;" src="../../asset/list_document/'.$any_file.'" height="425" width="100%" />';
       }
}

?>
<div class="modal-dialog" style="width: 95%;">
       <div class="modal-content">

              <div class="modal-header">
                     <h4 class="modal-title"><?php echo $_GET['id']; ?></h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
              </div>


              <form method="post" id="myform">
                            


              <?php echo $attch; ?>
                   
              </form>
       </div>

</div>
</div>
</div>