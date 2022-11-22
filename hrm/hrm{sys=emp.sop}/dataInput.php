<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<script src="vendor/modal/bootstrap.min.js"></script>
<script src="sweetalert.js"></script>

<?php

function compressImage($source, $destination, $quality) {
    $imgInfo = getimagesize($source); 
    $mime = $imgInfo['mime'];  
    switch($mime){ 
        case 'image/jpeg': 
            $image = imagecreatefromjpeg($source); 
            break; 
        case 'image/png': 
            $image = imagecreatefrompng($source); 
            break; 
        case 'image/gif': 
            $image = imagecreatefromgif($source); 
            break; 
        default: 
            $image = imagecreatefromjpeg($source);
    } 
    imagejpeg($image, $destination, $quality); 
    return $destination; 
}

if(isset($_POST['simpan'])){
    $nomor = $_POST['nomor'];
    $namaProsedurPost = $_POST['nama'];
    $pemilik = $_POST['pemilik'];
    $terbit = $_POST['terbit'];
    $berlaku = $_POST['berlaku'];
    $diajukan = $_POST['diajukan'];

    // Proses insert Atas
    $insert = "INSERT INTO hrmprosedur (prosedur_code, namaProsedur, pemilik, tanggalTerbit, tanggalBerlaku, diajukanOleh, created_date, created_by, status) VALUES ('$nomor','$namaProsedurPost','$pemilik', '$terbit', '$berlaku', '$diajukan', NOW(), '".$nama."', 'Aktif')";
    $insert = mysqli_query($connect, $insert);

    $sqlOpen = "SELECT idProsedur FROM hrmprosedur where prosedur_code = '$nomor'";
    $open = mysqli_query($connect, $sqlOpen);
    $masukin = mysqli_fetch_array($open);
    $idProsedur = $masukin['idProsedur'];
    
    // insert definisi
    $dataKamus = count($_POST["kamus"]);
    for ($i=0; $i < $dataKamus; $i++) {
        $kamus = $_POST['kamus'][$i];
        $definition = $_POST['definition'][$i];
        $idDefinition = $_POST['idDefinition'][$i];

        $sqlDefinition = "INSERT INTO hrdprosedurdef (definition_code, idProsedur, kamus, definisi, created_date, created_by) VALUES ('$idDefinition', '$idProsedur', '$kamus', '$definition', NOW(), '".$nama."')";
        
        $sqlcek = "SELECT * FROM hrdprosedurdef WHERE definition_code = '$idDefinition' and idProsedur = '$idProsedur'";
        $cek = mysqli_query($connect, $sqlcek);

        if(empty($idDefinition)) {

        } else {
            if(mysqli_num_rows($cek) == 0){
                mysqli_query($connect,$sqlDefinition);
            } else {
                
            }   
        }     
    }

    // Insert Business Process
    $dataList = count($_POST["idList"]);
    for ($p=0; $p < $dataList; $p++) {
        $idList = $_POST['idList'][$p];
        $proses = $_POST['proses'][$p];
        $pic = $_POST['pic'][$p];
        $desc = $_POST['desc'][$p];
        $tipeProses = $_POST['tipeProses'][$p];

        $sqlOpen = "SELECT idProsedur FROM hrmprosedur where prosedur_code = '$nomor'";
        $open = mysqli_query($connect, $sqlOpen);
        $masukin = mysqli_fetch_array($open);
        $idProsedur = $masukin['idProsedur'];

        $sqlProses = "INSERT INTO hrdprosedurlist (list_code, idProsedur, businessProcess, pic, description, tipeProses, created_date, created_by) VALUES ('$idList', '$idProsedur', '$proses', '$pic', '$desc', '$tipeProses', NOW(), '".$nama."')";

        $sqlCekProses = "SELECT * FROM hrdprosedurlist WHERE list_code = '$idList' and idProsedur = '$idProsedur'";
        $cekProsess = mysqli_query($connect, $sqlCekProses);
        
        if(empty($idList)) {

        } else {
            if(mysqli_num_rows($cekProsess) == 0) {
                mysqli_query($connect, $sqlProses);
            } else {
                
            }
        }
    }

    // Upload BP

    $sqlOpen = "SELECT idProsedur FROM hrmprosedur where prosedur_code = '$nomor'";
    $open = mysqli_query($connect, $sqlOpen);
    $masukin = mysqli_fetch_array($open);
    $idProsedur = $masukin['idProsedur'];

    $uploadData = count($_POST['uploadBpData']);

    for($p=0; $p<$uploadData; $p++) {
        $uploadBP1 = $_FILES["uploadBP"]["name"][$p];
        $orderUploadBp = $_POST['orderUploadBp'][$p];

        if(empty($uploadBP1)) {
            $uploadBP = "";
        } else {
            $timeBP = date("dmy").time();
            $uploadBP = $timeBP.$uploadBP1;
        }

        $sqlCekBpOrder = "SELECT * FROM hrdprosedurupload WHERE idProsedur = '$idProsedur' AND bpOrder = '$orderUploadBp'";
        $cekBpOrder = mysqli_query($connect, $sqlCekBpOrder);

        if($uploadBP) {
            $allowed = array('jpg','jpeg', 'png', '');
            $ext = pathinfo($uploadBP, PATHINFO_EXTENSION);

            if(!in_array($ext, $allowed)) {
               
            } else {
                if(mysqli_num_rows($cekBpOrder) == 0) {
                    $sqlInsertBp = "INSERT INTO hrdprosedurupload (idProsedur, bpOrder, businessPicture, created_date, created_by) VALUES ('$idProsedur', '$orderUploadBp', '$uploadBP', NOW(), '".$nama."')";
                    mysqli_query($connect, $sqlInsertBp);
    
                    $tempBp = $_FILES["uploadBP"]["tmp_name"][$p];
                    $folderBp = "image/".$uploadBP;
                    compressImage($tempBp, $folderBp, 20);
    
                } else {
                    echo'<script>alert("No order tidak boleh sama");</script>';
                }
            }
        }
    }

       // uploadBPD

       $sqlOpen = "SELECT idProsedur FROM hrmprosedur where prosedur_code = '$nomor'";
       $open = mysqli_query($connect, $sqlOpen);
       $masukin = mysqli_fetch_array($open);
       $idProsedur = $masukin['idProsedur'];
   
       $uploadBPD1 = $_FILES["uploadBPD"]["name"];
   
       if(empty($uploadBPD1)) {
           $uploadBPD = "";
       } else {
           $timeBPD = date("dmy").time();
           $uploadBPD = $timeBPD.$uploadBPD1;
       }
   
       $sqlCekBpOrder = "SELECT * FROM hrdprosedurupload WHERE idProsedur = '$idProsedur' AND bpOrder = '$orderUploadBp'";
       $cekBpOrder = mysqli_query($connect, $sqlCekBpOrder);
   
       if(empty($uploadBPD)) {
   
       } else {

        $allowedbpd = array('doc','docx', '');
        $extbpd = pathinfo($uploadBPD, PATHINFO_EXTENSION);

            if(!in_array($extbpd, $allowedbpd)) {
                echo'<script>alert("esfes");</script>';
            } else {
                if(mysqli_num_rows($cekBpOrder) == 0) {
                    $sqlInsertBpd = "INSERT INTO hrdprosedurdoc (idProsedur, businessPictureDoc, created_date, created_by) VALUES ('$idProsedur', '$uploadBPD', NOW(), '".$nama."')";
                    mysqli_query($connect, $sqlInsertBpd);
            
                    $tempBpd = $_FILES["uploadBPD"]["tmp_name"];
                    $folderBpd = "image/".$uploadBPD;
                    move_uploaded_file($tempBpd, $folderBpd);
                }
            }
       }

    // insert Ketentuan
    $dataKetentuan = count($_POST["idKetentuan"]);
    for ($m=0; $m < $dataKetentuan; $m++) {
        $idKetentuan = $_POST['idKetentuan'][$m];
        $ketentuan = $_POST['ketentuan'][$m];
        $uploadKetentuan = $_FILES["uploadKetentuan"]["name"][$m];

        $allowedKetentuan = array('jpg','jpeg', 'png', '');
        $extKetentuan = pathinfo($uploadKetentuan, PATHINFO_EXTENSION);

        if(!in_array($extKetentuan, $allowedKetentuan)) {
            echo '<script>alert("Format file upload ketentuan hanya jpg, jpeg, png"); </script>';
        } else {
            $tempKetentuan = $_FILES["uploadKetentuan"]["tmp_name"][$m];
            $folderKetentuan = "image/".$uploadKetentuan;

            $sqlKetentuan = "INSERT INTO hrdprosedurketentuan (ketentuan_code, idProsedur, deskripsi, foto, created_date, created_by) VALUES ('$idKetentuan', '$idProsedur', '$ketentuan','$uploadKetentuan', NOW(), '".$nama."')";

            if(empty($uploadKeterangan)) {

            } else {
                compressImage($tempKetentuan, $folderKetentuan, 20);
            }

            $sqlOpen = "SELECT idProsedur FROM hrmprosedur where prosedur_code = '$nomor'";
            $open = mysqli_query($connect, $sqlOpen);
            $masukin = mysqli_fetch_array($open);
            $idProsedur = $masukin['idProsedur'];
            
            $sqlcekKetentuan = "SELECT * FROM hrdprosedurketentuan WHERE ketentuan_code = '$idKetentuan' and idProsedur = '$idProsedur'";
            $cekKetentuan = mysqli_query($connect, $sqlcekKetentuan);

            if(empty($idKetentuan)) {

            } else {
                if(mysqli_num_rows($cekKetentuan) == 0){
                    mysqli_query($connect,$sqlKetentuan);
                } else {
                    
                }
            }
      
        }
    }

    // insert Keterangan
    $dataKeterangan = count($_POST["idKeterangan"]);
    for ($g=0; $g < $dataKeterangan; $g++) {
        $idKeterangan = $_POST['idKeterangan'][$g];
        $keterangan = $_POST['keterangan'][$g];
        $uploadKeterangan = $_FILES["uploadKeterangan"]["name"][$g];

        $allowedKeterangan = array('jpg','jpeg', 'png', '');
        $extKeterangan = pathinfo($uploadKeterangan, PATHINFO_EXTENSION);

        if(!in_array($extKeterangan, $allowedKeterangan)) {
            echo '<script>alert("Format file upload keterangan hanya jpg, jpeg, png"); </script>';
        } else {
            $tempKeterangan = $_FILES["uploadKeterangan"]["tmp_name"][$g];
            $folderKeterangan = "image/".$uploadKeterangan;

            $sqlKeterangan = "INSERT INTO hrdprosedurketerangan (keterangan_code, idProsedur, deskripsi, foto, created_date, created_by) VALUES ('$idKeterangan', '$idProsedur', '$keterangan', '$uploadKeterangan', NOW(), '".$nama."')";

            if(empty($uploadKeterangan)) {

            } else {
                compressImage($tempKeterangan, $folderKeterangan, 20);
            }

            $sqlOpen = "SELECT idProsedur FROM hrmprosedur where prosedur_code = '$nomor'";
            $open = mysqli_query($connect, $sqlOpen);
            $masukin = mysqli_fetch_array($open);
            $idProsedur = $masukin['idProsedur'];

            $sqlcekKeterangan = "SELECT * FROM hrdprosedurketerangan WHERE keterangan_code = '$idKeterangan' and idProsedur = '$idProsedur'";
            $cekKeterangan = mysqli_query($connect, $sqlcekKeterangan);
    
            if(empty($idKeterangan)) {

            } else {
                if(mysqli_num_rows($cekKeterangan) == 0){
                    mysqli_query($connect,$sqlKeterangan);
                } else {
                   
                } 
            }

        }       
    }

    // insert lampiran
    $dataLampiran = count($_POST["idLampiran"]);
    for ($n=0; $n < $dataLampiran; $n++) {
        $idLampiran = $_POST['idLampiran'][$n];
        $lampiran = $_POST['lampiran'][$n];
        $uploadLampiran = $_FILES["uploadLampiran"]["name"][$n];

        $allowedLampiran = array('jpg','jpeg', 'png', '');
        $extLampiran = pathinfo($uploadLampiran, PATHINFO_EXTENSION);

        if(!in_array($extLampiran, $allowedLampiran)) {
            echo '<script>alert("Format file upload lampiran hanya jpg, jpeg, png"); </script>';
        } else {
            $tempLampiran = $_FILES["uploadLampiran"]["tmp_name"][$n];
            $folderLampiran = "image/".$uploadLampiran;

            $sqlLampiran = "INSERT INTO hrdprosedurlampiran (lampiran_code, idProsedur, deskripsi, foto, created_date, created_by) VALUES ('$idLampiran', '$idProsedur', '$lampiran','$uploadLampiran', NOW(), '".$nama."')";

            if(empty($uploadLampiran)) {

            } else {
                compressImage($tempLampiran, $folderLampiran, 20);
            }

            $sqlOpen = "SELECT idProsedur FROM hrmprosedur where prosedur_code = '$nomor'";
            $open = mysqli_query($connect, $sqlOpen);
            $masukin = mysqli_fetch_array($open);
            $idProsedur = $masukin['idProsedur'];
            
            $sqlcekLampiran = "SELECT * FROM hrdprosedurlampiran WHERE lampiran_code = '$idLampiran' and idProsedur = '$idProsedur'";
            $cekLampiran = mysqli_query($connect, $sqlcekLampiran);

            if(empty($idLampiran)) {

            } else {
                if(mysqli_num_rows($cekLampiran) == 0){
                    mysqli_query($connect,$sqlLampiran);
                } else {
                    
                }
            }
        }        
    }

    // insert All
    if($insert) {
        echo"<script>alert('Data berhasil disimpan');
        document.location='input.php';</script>';</script>";
    }
}

?>

<div class="col-md-12">
<div class="card">
<div class="card-header d-flex align-items-center">
<h4 class="card-title mb-0" style = "padding : 20px">Input SOP</h4>
<div class="card-actions ml-auto">
</div>
</div>

<div class="card-body table-responsive p-0" style="width: 100vw;height: 78vh; width: 98%; margin: 5px; overflow: scroll;">
<!-- Isi -->

<form action="input.php" method="post" name="form_kategori" id="form_kategori" enctype="multipart/form-data" autocomplete = "off" style = "margin-left : 50px; margin-right : 50px; margin-top : 20px">
    <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nomor Prosedur</label>
            <div class="col-sm-10">
                <input type="text" name="nomor" class="form-control" size="4" placeholder = "PRM-HR-XX-XX" required>
            </div>
    </div>

    <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nama Prosedur</label>
            <div class="col-sm-10">
                <input type="text" name="nama" class="form-control" size="4" required>
            </div>
    </div>

    <div class="form-group row">
            <label class="col-sm-2 col-form-label">Pemilik</label>
            <div class="col-sm-10">
                <input type="text" name="pemilik" class="form-control" size="4">
            </div>
    </div>
    <div class="form-group row">
            <label class="col-sm-2 col-form-label">Tanggal Terbit</label>
            <div class="col-sm-10">
                <input type="date" name="terbit" class="form-control" size="4" placeholder = "XXXX-XX-XX">
            </div>
    </div>
    <div class="form-group row">
            <label class="col-sm-2 col-form-label">Tanggal Berlaku</label>
            <div class="col-sm-10">
                <input type="date" name="berlaku" class="form-control" size="4" placeholder = "XXXX-XX-XX">
            </div>
    </div>
    <div class="form-group row">
            <label class="col-sm-2 col-form-label">Diajukan Oleh</label>
            <div class="col-sm-10">
                <input type="text" name="diajukan" class="form-control" size="4">
            </div>
    </div>
    <label class="col-sm-2 col-form-label"><b>Definition</b></label>
    <table id="dynamic_form" style = "margin-bottom : 10px" class = "table table-striped table-hover table-bordered">
        <tr style = "background-color : #54d692; font-weight : bold; color : black">
            <td style = "width : 100px">ID</td>
            <td style = "width : 250px">Kamus</td>
            <td style = "width : 1000px">Definition</td>
            <td style = "text-align : center">Action</td>
        </tr>
        <tr>
            <td> <input type="text" name="idDefinition[]" placeholder="ID" class="form-control kategori_field" style = "margin-right : 5px" /> </td>
            <td> <input type="text" name="kamus[]" placeholder="Kamus" class="form-control kategori_field" style = "margin-right : 5px" /> </td>
            <td> <textarea rows="4" cols="60" name="definition[]" placeholder="Definition" class="form-control kategori_field"></textarea> </td>
            <td style = "text-align : center"> <button type="button" name="tambah" id="tambah" class="btn btn-warning text-black">Tambah</button> </td>
        </tr>
    </table>
    <label class="col-sm-2 col-form-label"><b>List Proccess</b></label>
    <table id="list_form" style = "margin-bottom : 10px" class = "table table-striped table-hover table-bordered">
        <tr style = "background-color : #54d692; font-weight : bold; color : black">
            <td style = "width : 70px">No</td>
            <td style = "width : 1000px">Business Process</td>
            <td style = "width : 200px">Person In Charge</td>
            <td style = "width : 300px">Description</td>
            <td style = "width : 130px"> Type of Process </td>
            <td style = "text-align : center">Action</td>
        </tr>
        <tr>
            <td style = "text-align : center"><input type="text" name="idList[]" placeholder="No" class="form-control kategori_field" style = "margin-right : 5px" /></td>
            <td> <input type="text" name="proses[]" placeholder="Business Process" class="form-control kategori_field" style = "margin-right : 5px" /> </td>
            <td> <input type="text" name="pic[]" placeholder="Person In Charge" class="form-control kategori_field" style = "margin-right : 5px" /> </td>
            <td> <textarea rows="5" cols="60" name="desc[]" placeholder="Description" class="form-control kategori_field"></textarea> </td>
            <td> 
                <select class="form-control kategori_field" name = "tipeProses[]">
                    <option value = "Manual"> Manual </option>
                    <option value = "System"> System </option>
                </select>
            </td>
            <td style = "text-align : center"> <button type="button" name="tambahList" id="tambahList" class="btn btn-warning text-black">Tambah</button> </td>
        </tr>
    </table>
    <table class = "table table-striped table-hover table-bordered" style = "width : 700px" id = "bp_form">
        <tr style = "background-color : #54d692; font-weight : bold; color : black">
            <td style = "text-align : center"><b>Upload Business Picture</b></td>
            <td style = "text-align : center"><b>File</b></td>
            <td style = "text-align : center"><b>Order</b></td>
            <td><button type="button" name="tambahUploadBp" id="tambahUploadBp" class="btn btn-warning text-black">+</button></td>
        </tr>
        <tr>
            <td><input type="file" name="uploadBP[]" style = "width : 280px"></td>
            <td>
                <input type = "hidden" name="uploadBpData[]" placeholder = "uploadBpData">
                <b>No File Uploaded</b>
            </td>
            <td>
                <select name = "orderUploadBp[]">
                    <?php
                        for($i=1; $i<100; $i++) {
                            echo'
                                <option value = "'.$i.'">'.$i.'</option>
                            ';
                        }
                    ?>
                </select>
            </td>
        </tr>
    </table>
    <div class="form-group row" style = "width : 1500px; margin-top : 20px">
            <label class="col-sm-2 col-form-label">Upload Business Process Doc</label>
            <div class="col-sm-10" style = "line-height :30px">
                <input type="file" name="uploadBPD">
            </div>
    </div>
    <label class="col-sm-2 col-form-label"><b>Ketentuan</b></label>
    <table id="ketentuan_form" style = "margin-bottom : 10px" class = "table table-striped table-hover table-bordered">
        <tr style = "background-color : #54d692; font-weight : bold; color : black">
            <td style = "width : 100px">ID</td>
            <td style = "width : 1100px">Deskripsi</td>
            <td colspan = "2" style = "text-align : center">Action</td>
        </tr>
        <tr>
           <td><input type="text" name="idKetentuan[]" placeholder="ID" class="form-control kategori_field" style = "margin-right : 5px" /></td>
           <td><textarea rows="5" cols="60" name="ketentuan[]" placeholder="Deskripsi" class="form-control kategori_field"></textarea></td>
           <td style = "text-align : center; width : 50px">
           <button type="button" name="tambahKetentuan" id="tambahKetentuan" class="btn btn-warning text-black">Tambah</button></td>
           <td style = "text-align : center; width : 50px"><input type="file" name="uploadKetentuan[]" style = "margin-top : 5px; width : 200px"></td>
        </tr>
    </table>
    <label class="col-sm-2 col-form-label"><b>Keterangan</b></label>
    <table id="keterangan_form" style = "margin-bottom : 10px" class = "table table-striped table-hover table-bordered">
        <tr style = "background-color : #54d692; font-weight : bold; color : black">
            <td style = "width : 100px">ID</td>
            <td style = "width : 1100px">Deskripsi</td>
            <td colspan = "2" style = "text-align : center"> Action </td>
        </tr>
        <tr>
            <td><input type="text" name="idKeterangan[]" placeholder="ID" class="form-control kategori_field" style = "margin-right : 5px" /></td>
           <td><textarea rows="3" cols="60" name="keterangan[]" placeholder="Deskripsi" class="form-control kategori_field"></textarea></td>
           <td style = "text-align : center; width : 50px">
           <button type="button" name="tambahKeterangan" id="tambahKeterangan" class="btn btn-warning text-black">Tambah</button></td>
           <td style = "text-align : center; width : 50px"><input type="file" name="uploadKeterangan[]" style = "margin-top : 5px; width : 200px"></td>
        </tr>
    </table>
    <label class="col-sm-2 col-form-label"><b>Lampiran</b></label>
    <table id="lampiran_form" style = "margin-bottom : 10px" class = "table table-striped table-hover table-bordered">
        <tr style = "background-color : #54d692; font-weight : bold; color : black">
            <td style = "width : 100px">ID</td>
            <td style = "width : 1100px">Deskripsi</td>
            <td colspan = "2" style = "text-align : center"> Action </td>
        </tr>
        <tr>
            <td><input type="text" name="idLampiran[]" placeholder="ID" class="form-control kategori_field" style = "margin-right : 5px" /></td>
           <td><textarea rows="3" cols="60" name="lampiran[]" placeholder="Deskripsi" class="form-control kategori_field"></textarea></td>
           <td style = "text-align : center; width : 50px">
           <button type="button" name="tambahLampiran" id="tambahLampiran" class="btn btn-warning text-black">Tambah</button></td>
           <td style = "text-align : center; width : 50px"><input type="file" name="uploadLampiran[]" style = "margin-top : 5px; width : 200px"></td>
        </tr>
    </table>
    
    <a href = "index.php">
    <input type = "button" class="btn btn-primary text-black" value="Back" style = "width : 150px; padding : 5px; margin-bottom : 10px" />
    </a>
    <input type="submit" name="simpan" id="submit" class="btn btn-primary text-black" value="Submit" style = "width : 150px; padding : 5px; margin-bottom : 10px" />
    
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>

<script>  
		$(document).ready(function(){  
			var i=1; 
			$('#tambah').click(function(){  
				i++;  
				$('#dynamic_form').append('<tr id="row'+i+'"><td> <input type="text" name="idDefinition[]" placeholder="ID" class="form-control kategori_field" style = "margin-right : 5px" /> </td><td> <input type="text" name="kamus[]" placeholder="Kamus" class="form-control kategori_field" style = "margin-right : 5px" /> </td><td> <textarea rows="4" cols="60" name="definition[]" placeholder="Definition" class="form-control kategori_field"></textarea> </td><td ><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">Hapus</button></td></tr>');  
			}); 

            var k=1;

            $('#tambahList').click(function(){  
				k++;  
				$('#list_form').append('<tr id="row'+k+'"><td style = "text-align : center"><input type="text" name="idList[]" placeholder="No" class="form-control kategori_field" style = "margin-right : 5px" /></td><td> <input type="text" name="proses[]" placeholder="Business Process" class="form-control kategori_field" style = "margin-right : 5px" /> </td><td> <input type="text" name="pic[]" placeholder="Person In Charge" class="form-control kategori_field" style = "margin-right : 5px" /> </td><td><textarea rows="5" cols="60" name="desc[]" placeholder="Description" class="form-control kategori_field"></textarea></td><td><select name = "tipeProses[]" class="form-control kategori_field"> <option value = "Manual"> Manual </option> <option value = "System"> System </option> </select></td><td style = "text-align : center"><button type="button" name="remove" id="'+k+'" class="btn btn-danger btn_remove">Hapus</button></td></tr>');  
			}); 

            $('#tambahKetentuan').click(function(){  
				i++;  
				$('#ketentuan_form').append('<tr id="row'+i+'"><td><input type="text" name="idKetentuan[]" placeholder="ID" class="form-control kategori_field" style = "margin-right : 5px" /></td><td><textarea rows="5" cols="60" name="ketentuan[]" placeholder="Deskripsi" class="form-control kategori_field"></textarea></td><td style = "text-align : center; width : 50px"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">Hapus</button></td><td style = "text-align : center; width : 50px"><input type="file" name="uploadKetentuan[]" style = "margin-top : 5px; width : 200px"></tr>');  
			}); 

            $('#tambahKeterangan').click(function(){  
				i++;  
				$('#keterangan_form').append('<tr id="row'+i+'"> <td><input type="text" name="idKeterangan[]" placeholder="ID" class="form-control kategori_field" style = "margin-right : 5px" /></td><td><textarea rows="3" cols="60" name="keterangan[]" placeholder="Deskripsi" class="form-control kategori_field"></textarea></td><td style = "text-align : center"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">Hapus</button></td><td style = "text-align : center; width : 50px"><input type="file" name="uploadKeterangan[]" style = "margin-top : 5px; width : 200px"></td></tr>');  
			}); 

            $('#tambahLampiran').click(function(){  
				i++;  
				$('#lampiran_form').append('<tr id="row'+i+'"><td><input type="text" name="idLampiran[]" placeholder="ID" class="form-control kategori_field" style = "margin-right : 5px" /></td><td><textarea rows="3" cols="60" name="lampiran[]" placeholder="Deskripsi" class="form-control kategori_field"></textarea></td><td style = "text-align : center"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">Hapus</button></td><td style = "text-align : center; width : 50px"><input type="file" name="uploadLampiran[]" style = "margin-top : 5px; width : 200px"></td></tr>');  
			}); 

            $('#tambahUploadBp').click(function(){  
				i++;  
				$('#bp_form').append('<tr id="row'+i+'"><td><input type="file" name="uploadBP[]" style = "width : 280px"></td><td><input type = "hidden" name="uploadBpData[]" placeholder = "uploadBpData"><b>No File Uploaded</b></td><td><select name = "orderUploadBp[]"><?php for($o=1; $o<100; $o++) {echo'<option value = "'.$o.'"> '.$o.' </option>';}?></select></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">-</button></td></tr>');
			}); 

			$(document).on('click', '.btn_remove', function(){  
				var button_id = $(this).attr("id");   
				$('#row'+button_id+'').remove();  
			}); 

            var i=1;

            var j=0;
            $(document).on('click', '.gp', function(){  
                j++;  
				var button_id = $(this).attr("id");   
				$('#pok'+button_id+'').remove();    
			});  

			$('#submit').click(function(){            
				$.ajax({  
					url:"aksi.php",  
					method:"POST",  
					data:$('#form_kategori').serialize(),  
					success:function(response){  
						alert(response);  
						$('#form_kategori')[0].reset();  
						console.log(response);
					},

					error:function(response){

						Swal.fire({
							icon: 'error',
							title: 'Oops..!',
							text: 'Server error!'
						});

						console.log(response);

					}  
				});  
			});  
		});  
	</script>

<!-- Isi -->

</div>

<!-- Footer -->
<div class='card-footer' style='background-color: #eee;height: 37px;padding-top: 5px;'>
<div class='row mb-2'>
<div class='col-sm-10'>
       <?php 
       echo $filterprint; 
       echo '<h6>Still On Development</h6?';
       ?>
</div>
<div class='col-sm-2'>
</div>
</div>
</div>
</div>

<script src="../../asset/vendor/datatable/datatables.min.js"></script>