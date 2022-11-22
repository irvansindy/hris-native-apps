<?php

    include "../../../application/config.php";

	$rfid = $_GET['rfid'];
       $username = $_GET['username'];
	//$modal_id = '1';
	$modal=mysqli_query($connect, "SELECT 
                                          *,
                                          case 
                                                 when a.created_by <> '$username' THEN 'display:none'
                                                 else ''
                                          end as display_delete_setting

                                          FROM whstm_attachment a
                                          WHERE a.request_id='$rfid'
	");

	while($r=mysqli_fetch_array($modal)){
?>

<?php 
if($r['file_type'] <> 'pdf') {
echo '<div class="file-preview-frame krajee-default  kv-preview-thumb" id="preview-1655009951510_15-2" data-fileindex="2"
       data-template="image">
       <div class="kv-file-content">
              <img src="../../../asset/request.file.whistleblower.attachment/'.$r['file_name'].'" style="width:auto;height:auto;max-width:100%;max-height:100%;">
       </div>
       <div class="file-thumbnail-footer">
              <div class="file-footer-caption" title="Screenshot _3).png">
                     <div class="file-caption-info">'.$r['file_name'].'</div>
                     <div class="file-size-info"> <samp>('.$r['file_size'].' KB)</samp></div>
              </div>
              <div class="file-thumb-progress kv-hidden">
                     <div class="progress">
                            <div class="progress-bar bg-success progress-bar-success progress-bar-striped active"
                                   role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                   style="width:0%;">
                                   Initializing...
                            </div>
                     </div>
              </div>
              <div class="file-actions" style="'.$r['display_delete_setting'].'">
                     <div class="file-footer-buttons">

                            <button type="button" class="kv-file-remove btn btn-kv btn-default btn-outline-secondary"
                                   title="Remove file"><i class="fa fa-trash"></i></button>
                     </div>
              </div>

              <div class="clearfix"></div>
       </div>
</div>';
} else {
echo '<div class="file-preview-frame krajee-default  kv-preview-thumb" id="preview-1655025713647_10-0" data-fileindex="0" data-template="pdf" title="'.$r['file_name'].'"><div class="kv-file-content">
<embed class="kv-preview-data file-preview-pdf" src="../../../asset/request.file.whistleblower.attachment/'.$r['file_name'].'" type="application/pdf" style="width:213px;height:160px;">
</div><div class="file-thumbnail-footer">
    <div class="file-footer-caption" title="'.$r['file_name'].'">
        <div class="file-caption-info">'.$r['file_name'].'</div>
        <div class="file-size-info"> <samp>(16 KB)</samp></div>
    </div>
    <div class="file-thumb-progress kv-hidden"><div class="progress">
    <div class="progress-bar bg-success progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;">
        Initializing...
     </div>
</div></div>
<div class="file-actions"  style="'.$r['display_delete_setting'].'>
    <div class="file-footer-buttons">
         <button type="button" class="kv-file-remove btn btn-kv btn-default btn-outline-secondary" title="Remove file"><i class="fa fa-trash"></i></button>
   </div>
</div>

<div class="clearfix"></div>

</div>
</div>';
}

?>




<?php } ?>




