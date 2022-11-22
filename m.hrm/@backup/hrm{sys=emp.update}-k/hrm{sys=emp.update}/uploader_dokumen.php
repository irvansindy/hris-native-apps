<?php
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0'; 
if($getdata == 0) {
	include "../../application/session/session.php";
} else {
	include "../../application/session/mobile.session.php";	
}
?>
<?php 
date_default_timezone_set('Asia/Bangkok'); 
	
$SFdate                 = date("Y-m-d");
$SFtime                 = date('h:i:s');
$SFdatetime             = date("Y-m-d H:i:s");
$SFnumber               = date("YmdHis");
$SFcode                 = "DOC".date("YmdHis");
$token                  = $_GET['token']
?>

<?php
if($_GET['code'] == '1' && $_FILES["file"]["name"] != '')
{
 $test = explode('.', $_FILES["file"]["name"]);
 $ext = end($test);
 $ext_sl = strtolower($ext);
 $ori   = $_FILES["file"]["name"];

 $get_singkat_file = mysqli_fetch_array(mysqli_query($connect, "SELECT document_name from document_reference WHERE id = '1'"));
 $name = '01-'.  $get_singkat_file['document_name'] . '-' . $token . '-' . $SFcode . '.' . $ext;

 $before = mysqli_query($connect, "SELECT a.id,a.document_file,a.attachment,a.ext FROM mgtools_attachment a WHERE a.emp_id = '$username' and a.document_file = '1'");
 if(mysqli_num_rows($before) < 1){
    $location = '../../asset/list_document/' . $name;
 } else {
    $location = '';
    echo '<script type="text/javascript">
                    $(document).ready(function(){
                                modals.style.display = "block";
                                document.getElementById("msg").innerHTML = "Silahkan hapus file sebelumnya";
                                return false;
                    });
                    </script>';
    
    $before = mysqli_fetch_array(mysqli_query($connect, "SELECT a.id,a.document_file,a.attachment,a.ext FROM mgtools_attachment a WHERE a.emp_id = '$username' and a.document_file = '1'"));
    $before_attachment_r = $before['attachment'];
    $ext_file = $before['ext'];
    if($ext_file == 'pdf'){
        $img = "uploaded_files/pngs.png";
    } else {
        $img = '../../asset/list_document/'.$before_attachment_r.'';
    }
        
    echo '<div class="datax" style="margin-right: 10px;padding: 10px;" id="imgbox1a"><p style="word-wrap: break-word;"><code class="w3-codespan" style="wrap">Kartu tanda penduduk</code></p>
                            <img src="'.$img.'" style="max-height: 300px;" alt="gthris">
                            <p>
                            <input type="hidden" value="'.$before_attachment_r.'" name="nama1a">
                            <a href="#" type="submit" class="ws-btn w3-block open_modal_search" style="background: darkcyan;font-weight: 500;font-size: 14px;margin: 5px 0px 5px 0px;width: 100%;color: white;">Lihat File
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg></a>
                                <a style="color: white;margin-bottom: 10px;font-size: 14px;" class="ws-btn w3-block tombol-simpan1a" onclick="removeElement1()">Hapus
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-square feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                                </a></p>
                            </div>';
                    
    echo "<script type='text/javascript'>
                            $(document).ready(function(){
                                $('#imgbox1').hide();
                            });
                            </script>";
 }

    if(move_uploaded_file($_FILES["file"]["tmp_name"], $location)){ 
       
        $process_request    = mysqli_query($connect, "INSERT INTO `mgtools_attachment` 
                                                    (  
                                                        `attachment`,
                                                        `emp_id`,
                                                        `ext`,
                                                        `document_file`
                                                        
                                                    ) VALUES 
                                                        (
                                                            '$name',
                                                            '$token',
                                                            '$ext_sl',
                                                            '$_GET[code]'
                                                        )
                                                    ");
        
        if($process_request)
        {
            if($ext == 'pdf'){
                echo '<div class="datax" style="margin-right: 10px;padding: 10px;" id="imgbox1a"><p style="word-wrap: break-word;"><code class="w3-codespan" style="wrap">Kartu tanda penduduk</code></p>
                        <img src="uploaded_files/pngs.png" style="max-height: 300px;" alt="gthris">
                        <p>
                        <input type="hidden" value="'.$name.'" name="nama1a">
                        <a href="#" type="submit" class="ws-btn w3-block open_modal_search" style="background: darkcyan;font-weight: 500;font-size: 14px;margin: 5px 0px 5px 0px;width: 100%;color: white;">Lihat File
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg></a>
                            <a style="color: white;margin-bottom: 10px;font-size: 14px;" class="ws-btn w3-block tombol-simpan1a" onclick="removeElement1()">Hapus
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-square feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                            </a></p>
                        </div>';
            } else {
    
                echo '<div class="datax" style="margin-right: 10px;padding: 10px;" id="imgbox1a"><p style="word-wrap: break-word;"><code class="w3-codespan" style="wrap">Kartu tanda penduduk</code></p>
                        <img src="../../asset/list_document/'.$name.'" style="max-height: 300px;" alt="gthris">
                        <p>
                        <input type="hidden" value="'.$name.'" name="nama1a">
                        <a href="#" type="submit" class="ws-btn w3-block open_modal_search" style="background: darkcyan;font-weight: 500;font-size: 14px;margin: 5px 0px 5px 0px;width: 100%;color: white;">Lihat File
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg></a>
                            <a style="color: white;margin-bottom: 10px;font-size: 14px;" class="ws-btn w3-block tombol-simpan1a" onclick="removeElement1()">Hapus
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-square feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                            </a></p>
                        </div>';
            }
        } else {
            echo '<script type="text/javascript">
                    $(document).ready(function(){
                                modals.style.display = "block";
                                document.getElementById("msg").innerHTML = "Silahkan hapus file sebelumnya";
                                return false;
                    });
                    </script>';
            
            $before = mysqli_fetch_array(mysqli_query($connect, "SELECT a.id,a.document_file,a.attachment,a.ext FROM mgtools_attachment a WHERE a.emp_id = '$username' and a.document_file = '1'"));
            $before_attachment_r = $before['attachment'];

            echo '<div class="datax" style="margin-right: 10px;padding: 10px;" id="imgbox1a"><p style="word-wrap: break-word;"><code class="w3-codespan" style="wrap">Kartu tanda penduduk</code></p>
                    <img src="../../asset/list_document/'.$before_attachment_r.'" style="max-height: 300px;" alt="gthris">
                    <p>
                    <input type="hidden" value="'.$before_attachment_r.'" name="nama1a">
                    <a href="#" type="submit" class="ws-btn w3-block open_modal_search" style="background: darkcyan;font-weight: 500;font-size: 14px;margin: 5px 0px 5px 0px;width: 100%;color: white;">Lihat File
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg></a>
                        <a style="color: white;margin-bottom: 10px;font-size: 14px;" class="ws-btn w3-block tombol-simpan1a" onclick="removeElement1()">Hapus
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-square feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                        </a></p>
                    </div>';
            
            echo "<script type='text/javascript'>
                    $(document).ready(function(){
                        $('#imgbox1').hide();
                    });
                    </script>";
                    
        }        
    }
}




























if($_GET['code'] == '2' && $_FILES["file2"]["name"] != '')
{
 $test = explode('.', $_FILES["file2"]["name"]);
 $ext = end($test);
 $ori   = $_FILES["file2"]["name"];

 $get_singkat_file = mysqli_fetch_array(mysqli_query($connect, "SELECT document_name from document_reference WHERE id = '2'"));
 $name = '02-'.  $get_singkat_file['document_name'] . '-' . $token . '-' . $SFcode . '.' . $ext;

 $before = mysqli_query($connect, "SELECT a.id,a.document_file,a.attachment,a.ext FROM mgtools_attachment a WHERE a.emp_id = '$username' and a.document_file = '2'");
 if(mysqli_num_rows($before) < 1){
    $location = '../../asset/list_document/' . $name;
 } else {
    $location = '';
    echo '<script type="text/javascript">
                    $(document).ready(function(){
                                modals.style.display = "block";
                                document.getElementById("msg").innerHTML = "Silahkan hapus file sebelumnya";
                                return false;
                    });
                    </script>';
    
    $before = mysqli_fetch_array(mysqli_query($connect, "SELECT a.id,a.document_file,a.attachment,a.ext FROM mgtools_attachment a WHERE a.emp_id = '$username' and a.document_file = '1'"));
    $before_attachment_r = $before['attachment'];
    $ext_file = $before['ext'];
    if($ext_file == 'pdf'){
        $img = "uploaded_files/pngs.png";
    } else {
        $img = '../../asset/list_document/'.$before_attachment_r.'';
    }
        
    echo '<div class="datax" style="margin-right: 10px;padding: 10px;" id="imgbox2a"><p style="word-wrap: break-word;"><code class="w3-codespan" style="wrap">Kartu tanda penduduk</code></p>
                            <img src="'.$img.'" style="max-height: 300px;" alt="gthris">
                            <p>
                            <input type="hidden" value="'.$before_attachment_r.'" name="nama2a">
                            <a href="#" type="submit" class="ws-btn w3-block open_modal_search2" style="background: darkcyan;font-weight: 500;font-size: 14px;margin: 5px 0px 5px 0px;width: 100%;color: white;">Lihat File
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg></a>
                                <a style="color: white;margin-bottom: 10px;font-size: 14px;" class="ws-btn w3-block tombol-simpan2a" onclick="removeElement2a()">Hapus
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-square feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                                </a></p>
                            </div>';
                    
    echo "<script type='text/javascript'>
                            $(document).ready(function(){
                                $('#imgbox2').hide();
                            });
                            </script>";
 }
 
    if(move_uploaded_file($_FILES["file2"]["tmp_name"], $location)){ 
       
        $process_request    = mysqli_query($connect, "INSERT INTO `mgtools_attachment` 
                                                    (  
                                                        `attachment`,
                                                        `emp_id`,
                                                        `ext`,
                                                        `document_file`
                                                        
                                                    ) VALUES 
                                                        (
                                                            '$name',
                                                            '$token',
                                                            '$ext',
                                                            '$_GET[code]'
                                                        )");

        if($process_request)
        {
            if($ext == 'pdf'){
                echo '<div class="datax" style="margin-right: 10px;padding: 10px;" id="imgbox2a"><p style="word-wrap: break-word;"><code class="w3-codespan" style="wrap">Kartu Keluarga</code></p>
                        <img src="uploaded_files/pngs.png" style="max-height: 300px;" alt="gthris">
                        <p>
                        <input type="hidden" value="'.$name.'" name="nama2a">
                        <a href="#" type="submit" class="ws-btn w3-block open_modal_search2" style="background: darkcyan;font-weight: 500;font-size: 14px;margin: 5px 0px 5px 0px;width: 100%;color: white;">Lihat File
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg></a>
                            <a style="color: white;margin-bottom: 10px;font-size: 14px;" class="ws-btn w3-block tombol-simpan2a" onclick="removeElement2a()">Hapus
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-square feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                            </a></p>
                        </div>';
            } else {

                echo '<div class="datax" style="margin-right: 10px;padding: 10px;" id="imgbox2a"><p style="word-wrap: break-word;"><code class="w3-codespan" style="wrap">Kartu Keluarga</code></p>
                        <img src="../../asset/list_document/'.$name.'" style="max-height: 300px;" alt="gthris">
                        <p>
                        <input type="hidden" value="'.$name.'" name="nama2a">
                        <a href="#" type="submit" class="ws-btn w3-block open_modal_search2" style="background: darkcyan;font-weight: 500;font-size: 14px;margin: 5px 0px 5px 0px;width: 100%;color: white;">Lihat File
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg></a>
                            <a style="color: white;margin-bottom: 10px;font-size: 14px;" class="ws-btn w3-block tombol-simpan2a" onclick="removeElement2a()">Hapus
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-square feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                            </a></p>
                        </div>';
            }
        } else {
            echo '<script type="text/javascript">
                    $(document).ready(function(){
                                modals.style.display = "block";
                                document.getElementById("msg").innerHTML = "Silahkan hapus file sebelumnya";
                                return false;
                    });
                    </script>';
            
            $before = mysqli_fetch_array(mysqli_query($connect, "SELECT a.id,a.document_file,a.attachment,a.ext FROM mgtools_attachment a WHERE a.emp_id = '$username' and a.document_file = '2'"));
            $before_attachment_r = $before['attachment'];

            echo '<div class="datax" style="margin-right: 10px;padding: 10px;" id="imgbox2a"><p style="word-wrap: break-word;"><code class="w3-codespan" style="wrap">Kartu Keluarga</code></p>
                    <img src="../../asset/list_document/'.$before_attachment_r.'" style="max-height: 300px;" alt="gthris">
                    <p>
                    <input type="hidden" value="'.$before_attachment_r.'" name="nama2a">
                    <a href="#" type="submit" class="ws-btn w3-block open_modal_search2" style="background: darkcyan;font-weight: 500;font-size: 14px;margin: 5px 0px 5px 0px;width: 100%;color: white;">Lihat File
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg></a>
                        <a style="color: white;margin-bottom: 10px;font-size: 14px;" class="ws-btn w3-block tombol-simpan2a" onclick="removeElement2a()">Hapus
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-square feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                        </a></p>
                    </div>';
            
            echo "<script type='text/javascript'>
                    $(document).ready(function(){
                        $('#imgbox2').hide();
                    });
                    </script>";
        }
    }
}






































if($_GET['code'] == '3' && $_FILES["file3"]["name"] != '')
{
 $test = explode('.', $_FILES["file3"]["name"]);
 $ext = end($test);
 $ori   = $_FILES["file3"]["name"];

 $get_singkat_file = mysqli_fetch_array(mysqli_query($connect, "SELECT document_name from document_reference WHERE id = '3'"));
 $name = '03-'.  $get_singkat_file['document_name'] . '-' . $token . '-' . $SFcode . '.' . $ext;

 $location = '../../asset/list_document/' . $name; 
 
    if(move_uploaded_file($_FILES["file3"]["tmp_name"], $location)){ 
       
        $process_request    = mysqli_query($connect, "INSERT INTO `mgtools_attachment` 
                                                    (  
                                                        `attachment`,
                                                        `emp_id`,
                                                        `ext`,
                                                        `document_file`
                                                        
                                                    ) VALUES 
                                                        (
                                                            '$name',
                                                            '$token',
                                                            '$ext',
                                                            '$_GET[code]'
                                                        )");

        if($process_request)
        {
            if($ext == 'pdf'){
                echo '<div class="datax" style="margin-right: 10px;padding: 10px;" id="imgbox3a"><p style="word-wrap: break-word;"><code class="w3-codespan" style="wrap">Ijazah</code></p>
                        <img src="uploaded_files/pngs.png" style="max-height: 300px;" alt="gthris">
                        <p>
                        <input type="hidden" value="'.$name.'" name="nama3a">
                        <a href="#" type="submit" class="ws-btn w3-block open_modal_search3" style="background: darkcyan;font-weight: 500;font-size: 14px;margin: 5px 0px 5px 0px;width: 100%;color: white;">Lihat File
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg></a>
                            <a style="color: white;margin-bottom: 10px;font-size: 14px;" class="ws-btn w3-block tombol-simpan3a" onclick="removeElement3a()">Hapus
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-square feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                            </a></p>
                        </div>';
            } else {

                echo '<div class="datax" style="margin-right: 10px;padding: 10px;" id="imgbox3a"><p style="word-wrap: break-word;"><code class="w3-codespan" style="wrap">Ijazah</code></p>
                        <img src="../../asset/list_document/'.$name.'" style="max-height: 300px;" alt="gthris">
                        <p>
                        <input type="hidden" value="'.$name.'" name="nama3a">
                        <a href="#" type="submit" class="ws-btn w3-block open_modal_search3" style="background: darkcyan;font-weight: 500;font-size: 14px;margin: 5px 0px 5px 0px;width: 100%;color: white;">Lihat File
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg></a>
                            <a style="color: white;margin-bottom: 10px;font-size: 14px;" class="ws-btn w3-block tombol-simpan3a" onclick="removeElement3a()">Hapus
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-square feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                            </a></p>
                        </div>';
            }
        } else {
            echo '<script type="text/javascript">
                    $(document).ready(function(){
                                modals.style.display = "block";
                                document.getElementById("msg").innerHTML = "Silahkan hapus file sebelumnya";
                                return false;
                    });
                    </script>';
            
            $before = mysqli_fetch_array(mysqli_query($connect, "SELECT a.id,a.document_file,a.attachment,a.ext FROM mgtools_attachment a WHERE a.emp_id = '$username' and a.document_file = '3'"));
            $before_attachment_r = $before['attachment'];

            echo '<div class="datax" style="margin-right: 10px;padding: 10px;" id="imgbox3a"><p style="word-wrap: break-word;"><code class="w3-codespan" style="wrap">Ijazah</code></p>
                    <img src="../../asset/list_document/'.$before_attachment_r.'" style="max-height: 300px;" alt="gthris">
                    <p>
                    <input type="hidden" value="'.$before_attachment_r.'" name="nama3a">
                    <a href="#" type="submit" class="ws-btn w3-block open_modal_search3" style="background: darkcyan;font-weight: 500;font-size: 14px;margin: 5px 0px 5px 0px;width: 100%;color: white;">Lihat File
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg></a>
                        <a style="color: white;margin-bottom: 10px;font-size: 14px;" class="ws-btn w3-block tombol-simpan3a" onclick="removeElement3a()">Hapus
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-square feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                        </a></p>
                    </div>';

            echo "<script type='text/javascript'>
                    $(document).ready(function(){
                        $('#imgbox3').hide();
                    });
                    </script>";
        }
    }
}









































if($_GET['code'] == '4' && $_FILES["file4"]["name"] != '')
{
 $test = explode('.', $_FILES["file4"]["name"]);
 $ext = end($test);
 $ori   = $_FILES["file4"]["name"];

 $get_singkat_file = mysqli_fetch_array(mysqli_query($connect, "SELECT document_name from document_reference WHERE id = '4'"));
 $name = '04-'.  $get_singkat_file['document_name'] . '-' . $token . '-' . $SFcode . '.' . $ext;

 $location = '../../asset/list_document/' . $name; 
 
    if(move_uploaded_file($_FILES["file4"]["tmp_name"], $location)){ 
       
        $process_request    = mysqli_query($connect, "INSERT INTO `mgtools_attachment` 
                                                    (  
                                                        `attachment`,
                                                        `emp_id`,
                                                        `ext`,
                                                        `document_file`
                                                        
                                                    ) VALUES 
                                                        (
                                                            '$name',
                                                            '$token',
                                                            '$ext',
                                                            '$_GET[code]'
                                                        )");

        if($process_request)
        {
            if($ext == 'pdf'){
                echo '<div class="datax" style="margin-right: 10px;padding: 10px;" id="imgbox4a"><p style="word-wrap: break-word;"><code class="w3-codespan" style="wrap">NPWP</code></p>
                        <img src="uploaded_files/pngs.png" style="max-height: 300px;" alt="gthris">
                        <p>
                        <input type="hidden" value="'.$name.'" name="nama4a">
                        <a href="#" type="submit" class="ws-btn w3-block open_modal_search4" style="background: darkcyan;font-weight: 500;font-size: 14px;margin: 5px 0px 5px 0px;width: 100%;color: white;">Lihat File
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg></a>
                            <a style="color: white;margin-bottom: 10px;font-size: 14px;" class="ws-btn w3-block tombol-simpan4a" onclick="removeElement4a()">Hapus
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-square feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                            </a></p>
                        </div>';
            } else {

                echo '<div class="datax" style="margin-right: 10px;padding: 10px;" id="imgbox4a"><p style="word-wrap: break-word;"><code class="w3-codespan" style="wrap">NPWP</code></p>
                        <img src="../../asset/list_document/'.$name.'" style="max-height: 300px;" alt="gthris">
                        <p>
                        <input type="hidden" value="'.$name.'" name="nama4a">
                        <a href="#" type="submit" class="ws-btn w3-block open_modal_search4" style="background: darkcyan;font-weight: 500;font-size: 14px;margin: 5px 0px 5px 0px;width: 100%;color: white;">Lihat File
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg></a>
                            <a style="color: white;margin-bottom: 10px;font-size: 14px;" class="ws-btn w3-block tombol-simpan4a" onclick="removeElement4a()">Hapus
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-square feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                            </a></p>
                        </div>';
            }
        } else {
            echo '<script type="text/javascript">
                    $(document).ready(function(){
                                modals.style.display = "block";
                                document.getElementById("msg").innerHTML = "Silahkan hapus file sebelumnya";
                                return false;
                    });
                    </script>';
            
            $before = mysqli_fetch_array(mysqli_query($connect, "SELECT a.id,a.document_file,a.attachment,a.ext FROM mgtools_attachment a WHERE a.emp_id = '$username' and a.document_file = '4'"));
            $before_attachment_r = $before['attachment'];

            echo '<div class="datax" style="margin-right: 10px;padding: 10px;" id="imgbox4a"><p style="word-wrap: break-word;"><code class="w3-codespan" style="wrap">NPWP</code></p>
                    <img src="../../asset/list_document/'.$before_attachment_r.'" style="max-height: 300px;" alt="gthris">
                    <p>
                    <input type="hidden" value="'.$before_attachment_r.'" name="nama4a">
                    <a href="#" type="submit" class="ws-btn w3-block open_modal_search4" style="background: darkcyan;font-weight: 500;font-size: 14px;margin: 5px 0px 5px 0px;width: 100%;color: white;">Lihat File
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg></a>
                        <a style="color: white;margin-bottom: 10px;font-size: 14px;" class="ws-btn w3-block tombol-simpan4a" onclick="removeElement4a()">Hapus
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-square feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                        </a></p>
                    </div>';
            
            echo "<script type='text/javascript'>
                    $(document).ready(function(){
                        $('#imgbox4').hide();
                    });
                    </script>";
        }
    }
}









































if($_GET['code'] == '5' && $_FILES["file5"]["name"] != '')
{
 $test = explode('.', $_FILES["file5"]["name"]);
 $ext = end($test);
 $ori   = $_FILES["file5"]["name"];

 $get_singkat_file = mysqli_fetch_array(mysqli_query($connect, "SELECT document_name from document_reference WHERE id = '5'"));
 $name = '05-'.  $get_singkat_file['document_name'] . '-' . $token . '-' . $SFcode . '.' . $ext;

 $location = '../../asset/list_document/' . $name; 
 
    if(move_uploaded_file($_FILES["file5"]["tmp_name"], $location)){ 
       
        $process_request    = mysqli_query($connect, "INSERT INTO `mgtools_attachment` 
                                                    (  
                                                        `attachment`,
                                                        `emp_id`,
                                                        `ext`,
                                                        `document_file`
                                                        
                                                    ) VALUES 
                                                        (
                                                            '$name',
                                                            '$token',
                                                            '$ext',
                                                            '$_GET[code]'
                                                        )");

        if($process_request)
        {
            if($ext == 'pdf'){
                echo '<div class="datax" style="margin-right: 10px;padding: 10px;" id="imgbox5a"><p style="word-wrap: break-word;"><code class="w3-codespan" style="wrap">NPWP</code></p>
                        <img src="uploaded_files/pngs.png" style="max-height: 300px;" alt="gthris">
                        <p>
                        <input type="hidden" value="'.$name.'" name="nama5a">
                        <a href="#" type="submit" class="ws-btn w3-block open_modal_search5" style="background: darkcyan;font-weight: 500;font-size: 15px;margin: 5px 0px 5px 0px;width: 100%;color: white;">Lihat File
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 25 25" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg></a>
                            <a style="color: white;margin-bottom: 10px;font-size: 15px;" class="ws-btn w3-block tombol-simpan5a" onclick="removeElement5a()">Hapus
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 25 25" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-square feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                            </a></p>
                        </div>';
            } else {

                echo '<div class="datax" style="margin-right: 10px;padding: 10px;" id="imgbox5a"><p style="word-wrap: break-word;"><code class="w3-codespan" style="wrap">NPWP</code></p>
                        <img src="../../asset/list_document/'.$name.'" style="max-height: 300px;" alt="gthris">
                        <p>
                        <input type="hidden" value="'.$name.'" name="nama5a">
                        <a href="#" type="submit" class="ws-btn w3-block open_modal_search5" style="background: darkcyan;font-weight: 500;font-size: 15px;margin: 5px 0px 5px 0px;width: 100%;color: white;">Lihat File
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 25 25" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg></a>
                            <a style="color: white;margin-bottom: 10px;font-size: 15px;" class="ws-btn w3-block tombol-simpan5a" onclick="removeElement5a()">Hapus
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 25 25" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-square feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                            </a></p>
                        </div>';
            }
        } else {
            echo '<script type="text/javascript">
                    $(document).ready(function(){
                                modals.style.display = "block";
                                document.getElementById("msg").innerHTML = "Silahkan hapus file sebelumnya";
                                return false;
                    });
                    </script>';
            
            $before = mysqli_fetch_array(mysqli_query($connect, "SELECT a.id,a.document_file,a.attachment,a.ext FROM mgtools_attachment a WHERE a.emp_id = '$username' and a.document_file = '5'"));
            $before_attachment_r = $before['attachment'];

            echo '<div class="datax" style="margin-right: 10px;padding: 10px;" id="imgbox5a"><p style="word-wrap: break-word;"><code class="w3-codespan" style="wrap">NPWP</code></p>
                    <img src="../../asset/list_document/'.$before_attachment_r.'" style="max-height: 300px;" alt="gthris">
                    <p>
                    <input type="hidden" value="'.$before_attachment_r.'" name="nama5a">
                    <a href="#" type="submit" class="ws-btn w3-block open_modal_search5" style="background: darkcyan;font-weight: 500;font-size: 15px;margin: 5px 0px 5px 0px;width: 100%;color: white;">Lihat File
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 25 25" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg></a>
                        <a style="color: white;margin-bottom: 10px;font-size: 15px;" class="ws-btn w3-block tombol-simpan5a" onclick="removeElement5a()">Hapus
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 25 25" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-square feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                        </a></p>
                    </div>';
            
            echo "<script type='text/javascript'>
                    $(document).ready(function(){
                        $('#imgbox5').hide();
                    });
                    </script>";
        }
    }
}
?>


































<div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                   aria-hidden="true">
                            </div>

<!-- Javascript untuk popup modal Edit-->
<script type="text/javascript">
$(document).ready(function() {
       $(".open_modal_search").click(function(e) {
              var m = $(this).attr("id");
              $.ajax({
                     url: "modal_search.php?id=1&username=<?php echo $username; ?>",
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

<!-- Javascript untuk popup modal Edit-->
<script type="text/javascript">
$(document).ready(function() {
       $(".open_modal_search2").click(function(e) {
              var m = $(this).attr("id");
              $.ajax({
                     url: "modal_search.php?id=2&username=<?php echo $username; ?>",
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

<!-- Javascript untuk popup modal Edit-->
<script type="text/javascript">
$(document).ready(function() {
       $(".open_modal_search3").click(function(e) {
              var m = $(this).attr("id");
              $.ajax({
                     url: "modal_search.php?id=3&username=<?php echo $username; ?>",
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

<!-- Javascript untuk popup modal Edit-->
<script type="text/javascript">
$(document).ready(function() {
       $(".open_modal_search5").click(function(e) {
              var m = $(this).attr("id");
              $.ajax({
                     url: "modal_search.php?id=5&username=<?php echo $username; ?>",
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

<script type="text/javascript">
	$(document).ready(function(){
		$(".tombol-simpan").click(function(){
			var data = $('.form-user').serialize();
			$.ajax({
				type: 'POST',
				url: "aksi.php?proc=1",
				data: data,
				success: function() {
					modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Dokumen berhasil dihapus";
                                   document.getElementById("file1").value = "";
                                   document.getElementById("any_file1").value = "";
                                   return false;
				}
			});
		});
	});
</script>

 
<script type="text/javascript">
	$(document).ready(function(){
		$(".tombol-simpan2").click(function(){
			var data = $('.form-user').serialize();
			$.ajax({
				type: 'POST',
				url: "aksi.php?proc=2",
				data: data,
				success: function() {
					modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Dokumen berhasil dihapus";
                                   document.getElementById("file2").value = "";
                                   document.getElementById("any_file2").value = "";
                                   return false;
				}
			});
		});
	});
</script>


 
<script type="text/javascript">
	$(document).ready(function(){
		$(".tombol-simpan3").click(function(){
			var data = $('.form-user').serialize();
			$.ajax({
				type: 'POST',
				url: "aksi.php?proc=3",
				data: data,
				success: function() {
					modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Dokumen berhasil dihapus";
                                   document.getElementById("file3").value = "";
                                   document.getElementById("any_file3").value = "";
                                   return false;
				}
			});
		});
	});
</script>



 
<script type="text/javascript">
	$(document).ready(function(){
		$(".tombol-simpan4").click(function(){
			var data = $('.form-user').serialize();
			$.ajax({
				type: 'POST',
				url: "aksi.php?proc=4",
				data: data,
				success: function() {
					modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Dokumen berhasil dihapus";
                                   document.getElementById("file4").value = "";
                                   document.getElementById("any_file4").value = "";
                                   return false;
				}
			});
		});
	});
</script>


 
<script type="text/javascript">
	$(document).ready(function(){
		$(".tombol-simpan5").click(function(){
			var data = $('.form-user').serialize();
			$.ajax({
				type: 'POST',
				url: "aksi.php?proc=5",
				data: data,
				success: function() {
					modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Dokumen berhasil dihapus";
                                   document.getElementById("file5").value = "";
                                   document.getElementById("any_file5").value = "";
                                   return false;
				}
			});
		});
	});
</script>



<script type="text/javascript">
	$(document).ready(function(){
		$(".tombol-simpan1a").click(function(){
			var data = $('.form-user').serialize();
			$.ajax({
				type: 'POST',
				url: "aksi.php?proc=1a",
				data: data,
				success: function() {
					modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Dokumen berhasil dihapus";
                                   document.getElementById("file1a").value = "";
                                   document.getElementById("any_file1a").value = "";
                                   return false;
				}
			});
		});
	});
</script>



<script type="text/javascript">
	$(document).ready(function(){
		$(".tombol-simpan2a").click(function(){
			var data = $('.form-user').serialize();
			$.ajax({
				type: 'POST',
				url: "aksi.php?proc=2a",
				data: data,
				success: function() {
					modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Dokumen berhasil dihapus";
                                   document.getElementById("file2a").value = "";
                                   document.getElementById("any_file2a").value = "";
                                   return false;
				}
			});
		});
	});
</script>



<script type="text/javascript">
	$(document).ready(function(){
		$(".tombol-simpan3a").click(function(){
			var data = $('.form-user').serialize();
			$.ajax({
				type: 'POST',
				url: "aksi.php?proc=3a",
				data: data,
				success: function() {
					modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Dokumen berhasil dihapus";
                                   document.getElementById("file3a").value = "";
                                   document.getElementById("any_file3a").value = "";
                                   return false;
				}
			});
		});
	});
</script>



<script type="text/javascript">
	$(document).ready(function(){
		$(".tombol-simpan4a").click(function(){
			var data = $('.form-user').serialize();
			$.ajax({
				type: 'POST',
				url: "aksi.php?proc=4a",
				data: data,
				success: function() {
					modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Dokumen berhasil dihapus";
                                   document.getElementById("file4a").value = "";
                                   document.getElementById("any_file4a").value = "";
                                   return false;
				}
			});
		});
	});
</script>



<script type="text/javascript">
	$(document).ready(function(){
		$(".tombol-simpan5a").click(function(){
			var data = $('.form-user').serialize();
			$.ajax({
				type: 'POST',
				url: "aksi.php?proc=5a",
				data: data,
				success: function() {
					modals.style.display = "block";
                                   document.getElementById("msg").innerHTML = "Dokumen berhasil dihapus";
                                   document.getElementById("file5a").value = "";
                                   document.getElementById("any_file5a").value = "";
                                   return false;
				}
			});
		});
	});
</script>