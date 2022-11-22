<?php include "../../application/session/session.php";?>
<?php
if($_GET['proc'] == '1'){
    $nama = $_POST['nama'];
    $sel = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM mgtools_attachment WHERE id = '$nama' or attachment LIKE '%$nama%' and document_file = '1'"));
    $sel_r = $sel['attachment'];
    $Path = "../../asset/list_document/$sel_r";
    if (unlink($Path)) {    
        mysqli_query($connect, "DELETE FROM mgtools_attachment WHERE id = '$nama' or attachment LIKE '%$nama%' and document_file = '1'");
    }

} else if($_GET['proc'] == '2'){
    $nama = $_POST['nama2'];
    $sel = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM mgtools_attachment WHERE id = '$nama' or attachment LIKE '%$nama%' and document_file = '2'"));
    $sel_r = $sel['attachment'];
    $Path = "../../asset/list_document/$sel_r";
    if (unlink($Path)) {
        mysqli_query($connect, "DELETE FROM mgtools_attachment WHERE id = '$nama' or attachment LIKE '%$nama%' and document_file = '2'");
    }


} else if($_GET['proc'] == '3'){
    $nama = $_POST['nama3'];
    $sel = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM mgtools_attachment WHERE id = '$nama' or attachment LIKE '%$nama%' and document_file = '3'"));
    $sel_r = $sel['attachment'];
    $Path = "../../asset/list_document/$sel_r";
    if (unlink($Path)) {    
        mysqli_query($connect, "DELETE FROM mgtools_attachment WHERE id = '$nama' or attachment LIKE '%$nama%' and document_file = '3'");
    }
    
} else if($_GET['proc'] == '4'){
    $nama = $_POST['nama4'];
    $sel = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM mgtools_attachment WHERE id = '$nama' or attachment LIKE '%$nama%' and document_file = '4'"));
    $sel_r = $sel['attachment'];
    $Path = "../../asset/list_document/$sel_r";
    if (unlink($Path)) {    
        mysqli_query($connect, "DELETE FROM mgtools_attachment WHERE id = '$nama' or attachment LIKE '%$nama%' and document_file = '4'");
    }

} else if($_GET['proc'] == '5'){
    $nama = $_POST['nama5'];
    $sel = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM mgtools_attachment WHERE id = '$nama' or attachment LIKE '%$nama%' and document_file = '5'"));
    $sel_r = $sel['attachment'];
    $Path = "../../asset/list_document/$sel_r";
    if (unlink($Path)) {    
        mysqli_query($connect, "DELETE FROM mgtools_attachment WHERE id = '$nama' or attachment LIKE '%$nama%' and document_file = '5'");
    }

} else if($_GET['proc'] == '1a'){
    $nama = $_POST['nama1a'];
    $sel = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM mgtools_attachment WHERE id = '$nama' or attachment LIKE '%$nama%' and document_file = '1'"));
    $sel_r = $sel['attachment'];
    $Path = "../../asset/list_document/$sel_r";
    if (unlink($Path)) {    
        mysqli_query($connect, "DELETE FROM mgtools_attachment WHERE id = '$nama' or attachment LIKE '%$nama%' and document_file = '1'");
    }
    
} else if($_GET['proc'] == '2a'){
    $nama = $_POST['nama2a'];
    $sel = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM mgtools_attachment WHERE id = '$nama' or attachment LIKE '%$nama%' and document_file = '2'"));
    $sel_r = $sel['attachment'];
    $Path = "../../asset/list_document/$sel_r";
    if (unlink($Path)) {    
        mysqli_query($connect, "DELETE FROM mgtools_attachment WHERE id = '$nama' or attachment LIKE '%$nama%' and document_file = '2'");
    }
    
} else if($_GET['proc'] == '3a'){
    $nama = $_POST['nama3a'];
    $sel = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM mgtools_attachment WHERE id = '$nama' or attachment LIKE '%$nama%' and document_file = '3'"));
    $sel_r = $sel['attachment'];
    $Path = "../../asset/list_document/$sel_r";
    if (unlink($Path)) {    
        mysqli_query($connect, "DELETE FROM mgtools_attachment WHERE id = '$nama' or attachment LIKE '%$nama%' and document_file = '3'");
    }
    
} else if($_GET['proc'] == '4a'){
    $nama = $_POST['nama4a'];
    $sel = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM mgtools_attachment WHERE id = '$nama' or attachment LIKE '%$nama%' and document_file = '4'"));
    $sel_r = $sel['attachment'];
    $Path = "../../asset/list_document/$sel_r";
    if (unlink($Path)) {    
        mysqli_query($connect, "DELETE FROM mgtools_attachment WHERE id = '$nama' or attachment LIKE '%$nama%' and document_file = '4'");
    }

} else if($_GET['proc'] == '5a'){
    $nama = $_POST['nama5a'];
    $sel = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM mgtools_attachment WHERE id = '$nama' or attachment LIKE '%$nama%' and document_file = '5'"));
    $sel_r = $sel['attachment'];
    $Path = "../../asset/list_document/$sel_r";
    if (unlink($Path)) {    
        mysqli_query($connect, "DELETE FROM mgtools_attachment WHERE id = '$nama' or attachment LIKE '%$nama%' and document_file = '5'");
    }

}
?>