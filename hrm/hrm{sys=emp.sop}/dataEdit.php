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

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sqlProsedur = "SELECT * FROM hrmprosedur WHERE idProsedur = '$id'";
    $prosedur = mysqli_query($connect, $sqlProsedur);
    $masukin = mysqli_fetch_array($prosedur);
    
    $prosedur_code = $masukin['prosedur_code'];
    $namaProsedur = $masukin['namaProsedur'];
    $pemilik = $masukin['pemilik'];
    $tanggalTerbit = $masukin['tanggalTerbit'];
    $tanggalBerlaku = $masukin['tanggalBerlaku'];
    $diajukanOleh = $masukin['diajukanOleh'];
}

if(isset($_POST['simpan'])){
    $nomordata = $_POST['nomordata'];
    $nomor = $_POST['nomor'];
    $namaProsedurPost = $_POST['nama'];
    $pemilik = $_POST['pemilik'];
    $terbit = $_POST['terbit'];
    $berlaku = $_POST['berlaku'];
    $diajukan = $_POST['diajukan'];

    $namaProsedurLama = $_POST['namaProsedurLama'];
    $pemilikLama = $_POST['pemilikLama'];
    $terbitLama = $_POST['terbitLama'];
    $berlakuLama = $_POST['berlakuLama'];
    $ajuLama = $_POST['ajuLama'];

    if($terbitLama == "0000-00-00"){
        $terbitLama = "";
    }
    
    // Proses Update Atas
    $sqlCekAtas = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomor'";
    $cekAtas = mysqli_query($connect, $sqlCekAtas);

    if ($nomor != $nomordata || $namaProsedurLama != $namaProsedurPost || $pemilik != $pemilikLama || $terbit != $terbitLama || $berlaku != $berlakuLama || $diajukan != $ajuLama) {

        $sqlGetId = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomordata'";
        $getId = mysqli_query($connect, $sqlGetId);
        $arrayId = mysqli_fetch_array($getId);
        $idProsedur = $arrayId['idProsedur'];
        
        $before = "$nomordata/$namaProsedurLama/$pemilikLama/$terbitLama/$berlakuLama/$ajuLama";
        $after = "$nomor/$nama/$pemilik/$terbit/$berlaku/$diajukan";

        $sqlInsertLog = "INSERT INTO hrdlogprosedur (emp_id, modified_date, idProsedur, sebelum, sesudah, aksi) VALUES ('".$username."', NOW(), '$idProsedur', '$before', '$after', 'Update')";
        mysqli_query($connect, $sqlInsertLog);

        if($nomordata == $nomor || mysqli_num_rows($cekAtas) == 0) {
            $sqlUpdateAtas = "UPDATE hrmprosedur SET modified_date = NOW(), modified_by = '".$nama."', prosedur_code = '$nomor', namaProsedur = '$namaProsedurPost', pemilik = '$pemilik', tanggalTerbit = '$terbit', tanggalBerlaku = '$berlaku', diajukanOleh = '$diajukan' WHERE prosedur_code = '$nomordata'";
            mysqli_query($connect, $sqlUpdateAtas);
            $alert = 0;
        } else {
            $sqlCek2 = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomordata'";
            $cek2 = mysqli_query($connect, $sqlCek2);
    
            $arrayMasukin = mysqli_fetch_array($cek2);
            $po = $arrayMasukin['idProsedur'];
            echo "<script> alert('Nomor Prosedur sudah terdaftar');
            document.location='edit.php?id=$po';</script>";
        }
    }

    // Update Definisi
    $defDataArray = $_POST['defDataArray'];
    $encodeDefArray = json_encode($defDataArray, TRUE);

    $idDefPost = $_POST['idDefinition'];
    $encodeDefPost = json_encode($idDefPost, TRUE);

    $idDefSystem1 = $_POST['idDefSystem'];
    $idDefSystem = json_encode($idDefSystem1, TRUE);

    $defOld1 = $_POST['defOld'];
    $defOld = json_encode($defOld1, TRUE);

    if($defOld != $idDefSystem) {
        $alert = 0;
    }

    if($encodeDefArray != $encodeDefPost) {
        $updateModify = "UPDATE hrmprosedur SET modified_by = '".$nama."', modified_date = NOW() WHERE prosedur_code = '$nomor'";

        $idDefSystem = $_POST['idDefSystem'];
        $encodeId = json_encode($idDefSystem, TRUE);
        $str1 = str_replace("[", "", $encodeId);
        $str2 = str_replace("]", "", $str1);

        $sqlGetId = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomor'";
        $getId = mysqli_query($connect, $sqlGetId);
        $arrayId = mysqli_fetch_array($getId);
        $idGet = $arrayId['idProsedur'];

        $sqlCekDef = "SELECT * FROM hrdprosedurdef WHERE idDefinition NOT IN ($str2) and idProsedur = '$idGet'";
        $cekDef = mysqli_query($connect, $sqlCekDef);

        if(mysqli_num_rows($cekDef) > 0) {
            $before = "idDef$encodeDefArray";
            $after = "idDef$encodeDefPost";

            mysqli_query($connect, $updateModify);
            $sqlInsertLog = "INSERT INTO hrdlogprosedur (emp_id, modified_date, idProsedur, sebelum, sesudah, aksi) VALUES ('".$username."', NOW(), '$idGet', '$before', '$after', 'Delete')";
            mysqli_query($connect, $sqlInsertLog);
        }

        $sqlDelDef = "DELETE FROM hrdprosedurdef WHERE idDefinition NOT IN ($str2) and idProsedur = '$idGet'";
        mysqli_query($connect, $sqlDelDef);
    }

    $kamus = $_POST['kamus'];
    if(empty($kamus)) {
        $updateModify = "UPDATE hrmprosedur SET modified_by = '".$nama."', modified_date = NOW() WHERE prosedur_code = '$nomor'";

        $sqlGetId = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomor'";
        $getId = mysqli_query($connect, $sqlGetId);
        $arrayId = mysqli_fetch_array($getId);
        $idGet = $arrayId['idProsedur'];

        $before = "idDef$encodeDefArray";
        $after = "empty";

        $sqlInsertLog = "INSERT INTO hrdlogprosedur (emp_id, modified_date, idProsedur, sebelum, sesudah, aksi) VALUES ('".$username."', NOW(), '$idGet', '$before', '$after', 'Delete')";

        $sqlDeleteDefAll = "DELETE FROM hrdprosedurdef WHERE idProsedur = '$idGet'";

        $sqlCekDef2 = "SELECT * FROM hrdprosedurdef WHERE idProsedur = '$idGet'";
        $cekDef2 = mysqli_query($connect, $sqlCekDef2);
        if(mysqli_num_rows($cekDef2) > 0) {
            $alert = 0;
            mysqli_query($connect, $updateModify);
            mysqli_query($connect, $sqlInsertLog);
            mysqli_query($connect, $sqlDeleteDefAll);   
        }

    } else {
        $dataKamus = count($_POST["kamus"]);
        for ($i=0; $i < $dataKamus; $i++) {
            $kamus = $_POST['kamus'][$i];
            $definition = $_POST['definition'][$i];
            $idDefinition = $_POST['idDefinition'][$i];

            $idDefLama = $_POST['idDefLama'][$i];
            $kamusLama = $_POST['kamusLama'][$i];
            $defLama = $_POST['defLama'][$i];

            $sqlUpdateDefinition = "UPDATE hrdprosedurdef SET modified_by = '".$nama."', definition_code = '$idDefinition', kamus = '$kamus', definisi = '$definition', modified_date = NOW() WHERE definition_code = '$idDefLama'";

            $sqlGetId = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomor'";
            $getId = mysqli_query($connect, $sqlGetId);
            $arrayId = mysqli_fetch_array($getId);
            $idGet = $arrayId['idProsedur'];

            $sqlcek = "SELECT * FROM hrdprosedurdef WHERE definition_code = '$idDefinition' and idProsedur = '$idGet' ";
            $cek = mysqli_query($connect, $sqlcek);
            
            if($idDefinition != $idDefLama || $kamus != $kamusLama || $defLama != $definition) {
                
                $sqlCekIdDef = "SELECT * FROM hrdprosedurdef WHERE definition_code = '$idDefinition' and idProsedur = '$idGet'";
                $cekIdDef = mysqli_query($connect, $sqlCekIdDef);

                $updateModify = "UPDATE hrmprosedur SET modified_by = '".$nama."', modified_date = NOW() WHERE prosedur_code = '$nomor'";

                $insertDef = "INSERT INTO hrdprosedurdef(definition_code, idProsedur, kamus, definisi, created_date, created_by, modified_date, modified_by) VALUES ('$idDefinition', '$idGet', '$kamus', '$definition', NOW(), '".$nama."', NOW(), '".$nama."')";

                $sqlGetId = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomordata'";
                $getId = mysqli_query($connect, $sqlGetId);
                $arrayId = mysqli_fetch_array($getId);
                $idProsedur = $arrayId['idProsedur'];

                $before = "idDef-$idDefLama/$kamusLama/$defLama";
                $after = "idDef-$idDefinition/$kamus/$definition";

                $sqlInsertLog = "INSERT INTO hrdlogprosedur (emp_id, modified_date, idProsedur, sebelum, sesudah, aksi) VALUES ('".$username."', NOW(), '$idProsedur', '$before', '$after', 'Update')";

                if($idDefinition == $idDefLama) {
                    if($idDefLama) {
                        mysqli_query($connect, $sqlInsertLog);
                        mysqli_query($connect, $updateModify);
                    }
                    $alert = 0;
                    mysqli_query($connect, $sqlUpdateDefinition);
                }
        
                if(mysqli_num_rows($cek) == 0 && $idDefinition != $idDefLama) {
                    if($idDefLama) {
                        mysqli_query($connect, $sqlInsertLog);
                        mysqli_query($connect, $updateModify);
                    }
                    $alert = 0;
                    mysqli_query($connect, $sqlUpdateDefinition);
                }
            }

            if(mysqli_num_rows($cek) == 0 && empty($idDefLama)) {
                mysqli_query($connect, $insertDef);
                
                $sqlGetId = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomordata'";
                $getId = mysqli_query($connect, $sqlGetId);
                $arrayId = mysqli_fetch_array($getId);
                $idProsedur = $arrayId['idProsedur'];

                $before = "";
                $after = "idDef-$idDefinition/$kamus/$definition";

                $sqlInsertLog = "INSERT INTO hrdlogprosedur (emp_id, modified_date, idProsedur, sebelum, sesudah, aksi) VALUES ('".$username."', NOW(), '$idProsedur', '$before', '$after', 'Insert')";
                $alert = 0;
                mysqli_query($connect, $sqlInsertLog);
                mysqli_query($connect, $updateModify);
            }

        }
    }
    
    // Update Business Process
    $listDataArray = $_POST['listDataArray'];
    $encodeListArray = json_encode($listDataArray, TRUE);

    $idList = $_POST['idList'];
    $encodeListPost = json_encode($idList, TRUE);

    $idListSystem1 = $_POST['idListSystem'];
    $idListSystem = json_encode($idListSystem1, TRUE);

    $listOld1 = $_POST['listOld'];
    $listOld = json_encode($listOld1, TRUE);

    if($listOld != $idListSystem) {
        $alert = 0;
    }

    if($encodeListArray != $encodeListPost) {
        $updateModify = "UPDATE hrmprosedur SET modified_by = '".$nama."', modified_date = NOW() WHERE prosedur_code = '$nomor'";

        $idListSystem = $_POST['idListSystem'];
        $encodeId = json_encode($idListSystem, TRUE);
        $str1 = str_replace("[", "", $encodeId);
        $str2 = str_replace("]", "", $str1);

        //  tambahan
        $sqlGetId = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomor'";
        $getId = mysqli_query($connect, $sqlGetId);
        $arrayId = mysqli_fetch_array($getId);
        $idGet = $arrayId['idProsedur'];

        $sqlCekList = "SELECT * FROM hrdprosedurlist WHERE idList NOT IN ($str2) and idProsedur = '$idGet'";
        $cekList = mysqli_query($connect, $sqlCekList);

        if(mysqli_num_rows($cekList) > 0) {
            $before = "idList$encodeListArray";
            $after = "idList$encodeListPost";

            mysqli_query($connect, $updateModify);
            $sqlInsertLog = "INSERT INTO hrdlogprosedur (emp_id, modified_date, idProsedur, sebelum, sesudah, aksi) VALUES ('".$username."', NOW(), '$idGet', '$before', '$after', 'Delete')";
            mysqli_query($connect, $sqlInsertLog);
        }

        //  tambahan

        $sqlDelDef = "DELETE FROM hrdprosedurlist WHERE idList NOT IN ($str2) AND idProsedur = '$idGet'";
        mysqli_query($connect, $sqlDelDef);
    }

    $proses = $_POST['proses'];
    if(empty($proses)) {
        $updateModify = "UPDATE hrmprosedur SET modified_by = '".$nama."', modified_date = NOW() WHERE prosedur_code = '$nomor'";

        //  tambahan

        $sqlGetId = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomor'";
        $getId = mysqli_query($connect, $sqlGetId);
        $arrayId = mysqli_fetch_array($getId);
        $idGet = $arrayId['idProsedur'];

        $before = "idList$encodeListArray";
        $after = "empty";

        $sqlInsertLog = "INSERT INTO hrdlogprosedur (emp_id, modified_date, idProsedur, sebelum, sesudah, aksi) VALUES ('".$username."', NOW(), '$idGet', '$before', '$after', 'Delete')";

        //  tambahan

        $sqlDeleteListAll = "DELETE FROM hrdprosedurlist WHERE idProsedur = '$idGet'";

        $sqlCekList2 = "SELECT * FROM hrdprosedurlist WHERE idProsedur = '$idGet'";
        $cekList2 = mysqli_query($connect, $sqlCekList2);
        if(mysqli_num_rows($cekList2) > 0) {
            $alert = 0;
            mysqli_query($connect, $updateModify);
            mysqli_query($connect, $sqlInsertLog);
            mysqli_query($connect, $sqlDeleteListAll); 
        }

    } else {
        $dataList = count($_POST["idList"]);
        for ($p=0; $p < $dataList; $p++) {
            $idList = $_POST['idList'][$p];
            $proses = $_POST['proses'][$p];
            $pic = $_POST['pic'][$p];
            $desc = $_POST['desc'][$p];
            $tipeProses = $_POST['tipeProses'][$p];

            $idListLama = $_POST['idListLama'][$p];
            $prosesLama = $_POST['prosesLama'][$p];
            $picLama = $_POST['picLama'][$p];
            $descLama = $_POST['descLama'][$p];
            $tipeProsesLama = $_POST['tipeProsesLama'][$p];

            $sqlUpdateList = "UPDATE hrdprosedurlist SET modified_by = '".$nama."', list_code = '$idList', businessProcess = '$proses', pic = '$pic', modified_date = NOW(), description = '$desc', tipeProses = '$tipeProses' WHERE list_code = '$idListLama' AND idProsedur = '$idGet'";

            $sqlGetId = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomor'";
            $getId = mysqli_query($connect, $sqlGetId);
            $arrayId = mysqli_fetch_array($getId);
            $idGet = $arrayId['idProsedur'];

            $sqlcek = "SELECT * FROM hrdprosedurlist WHERE list_code = '$idList' AND idProsedur = '$idGet'";
            $cek = mysqli_query($connect, $sqlcek);

            $sqlInsertList = "INSERT INTO hrdprosedurlist (list_code, idProsedur, businessProcess, pic, description, tipeProses, created_date, created_by, modified_date, modified_by) VALUES ('$idList', '$idGet', '$proses', '$pic', '$desc', '$tipeProses', NOW(), '".$nama."', NOW(), '".$nama."')";

            if($idList != $idListLama || $proses != $prosesLama || $pic != $picLama || $desc != $descLama || $tipeProses != $tipeProsesLama) {
                $updateModify = "UPDATE hrmprosedur SET modified_by = '".$nama."', modified_date = NOW() WHERE prosedur_code = '$nomor'";

                $sqlCekIdList = "SELECT * FROM hrdprosedurlist WHERE list_code = '$idList' and idProsedur = '$idGet'";
                $cekIdList = mysqli_query($connect, $sqlCekIdList);

                $sqlGetId = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomordata'";
                $getId = mysqli_query($connect, $sqlGetId);
                $arrayId = mysqli_fetch_array($getId);
                $idProsedur = $arrayId['idProsedur'];

                $before = "idList-$idListLama/$prosesLama/$picLama/$descLama/$tipeProsesLama";
                $after = "idList-$idList/$proses/$pic/$desc/$tipeProses";

                $sqlInsertLog = "INSERT INTO hrdlogprosedur (emp_id, modified_date, idProsedur, sebelum, sesudah, aksi) VALUES ('".$username."', NOW(), '$idProsedur', '$before', '$after', 'Update')";

                if($idList == $idListLama) {
                    if($idListLama) {
                        mysqli_query($connect, $updateModify);
                        mysqli_query($connect, $sqlInsertLog);
                    }
                    $alert = 0;
                    mysqli_query($connect, $sqlUpdateList);
                }
        
                if(mysqli_num_rows($cek) == 0 && $idList != $idListLama) {
                    if($idListLama) {
                        mysqli_query($connect, $updateModify);
                        mysqli_query($connect, $sqlInsertLog);
                    }
                    $alert = 0;
                    mysqli_query($connect, $sqlUpdateList);
                }

                if(mysqli_num_rows($cek) == 0 && empty($idListLama)) {
                    $sqlGetId = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomordata'";
                    $getId = mysqli_query($connect, $sqlGetId);
                    $arrayId = mysqli_fetch_array($getId);
                    $idProsedur = $arrayId['idProsedur'];

                    $before = "";
                    $after = "idList-$idList/$proses/$pic/$desc/$tipeProses";

                    $sqlInsertLog = "INSERT INTO hrdlogprosedur (emp_id, modified_date, idProsedur, sebelum, sesudah, aksi) VALUES ('".$username."', NOW(), '$idProsedur', '$before', '$after', 'Insert')";
                    $alert = 0;
                    mysqli_query($connect, $sqlInsertLog);
                    mysqli_query($connect, $updateModify);
                    mysqli_query($connect, $sqlInsertList);
                }
            }
        }
    }

    // Update Image BP
    $uploadBpSystem = $_POST['uploadBpSystem'];
    $encodeId = json_encode($uploadBpSystem, TRUE);
    $str1 = str_replace("[", "", $encodeId);
    $str2 = str_replace("]", "", $str1);
    
    $idUploadData = $_POST['idUploadData'];
    $encodeUpload = json_encode($idUploadData, TRUE);

    $sqlGetId = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomor'";
    $getId = mysqli_query($connect, $sqlGetId);
    $arrayId = mysqli_fetch_array($getId);
    $idGet = $arrayId['idProsedur'];

    if($encodeId != $encodeUpload) {
        $alert = 0;
    }
    
    if(empty($uploadBpSystem) && $encodeId != $encodeUpload) {
        $updateModify = "UPDATE hrmprosedur SET modified_by = '".$nama."', modified_date = NOW() WHERE prosedur_code = '$nomor'";
        mysqli_query($connect, $updateModify);
        
        $sqlGetId = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomor'";
        $getId = mysqli_query($connect, $sqlGetId);
        $arrayId = mysqli_fetch_array($getId);
        $idGet = $arrayId['idProsedur']; 

        $sqlBp = "SELECT * FROM hrdprosedurupload WHERE idProsedur = '$idGet'";
        $Bp = mysqli_query($connect, $sqlBp);
        
        while($arrayDeleteBp = mysqli_fetch_array($Bp)){
            unlink("image/".$arrayDeleteBp['businessPicture']); 
        }

        $before = "idUpload$encodeUpload";
        $after = "empty";

        $sqlInsertLog = "INSERT INTO hrdlogprosedur (emp_id, modified_date, idProsedur, sebelum, sesudah, aksi) VALUES ('".$username."', NOW(), '$idGet', '$before', '$after', 'Delete')";
        mysqli_query($connect, $sqlInsertLog);

        $sqlDeleteAllUpload = "DELETE FROM hrdprosedurupload WHERE idProsedur = '$idGet'";
        mysqli_query($connect, $sqlDeleteAllUpload);
        
    } else {
        if($encodeId != $encodeUpload) {
        $updateModify = "UPDATE hrmprosedur SET modified_by = '".$nama."', modified_date = NOW() WHERE prosedur_code = '$nomor'";
        mysqli_query($connect, $updateModify);
        
        $sqlUnlinkBp = "SELECT * FROM hrdprosedurupload WHERE idProsedur = '$idGet' AND idUpload NOT IN ($str2)";
        $unlinkBp = mysqli_query($connect, $sqlUnlinkBp);

        while($unlinkNow = mysqli_fetch_array($unlinkBp)) {
            unlink("image/".$unlinkNow['businessPicture']);
        }

        $sqlGetId = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomor'";
        $getId = mysqli_query($connect, $sqlGetId);
        $arrayId = mysqli_fetch_array($getId);
        $idGet = $arrayId['idProsedur']; 

        $before = "idUpload$encodeUpload";
        $after = "idUpload$encodeId";

        $sqlInsertLog = "INSERT INTO hrdlogprosedur (emp_id, modified_date, idProsedur, sebelum, sesudah, aksi) VALUES ('".$username."', NOW(), '$idGet', '$before', '$after', 'Delete')";
        mysqli_query($connect, $sqlInsertLog);

        $sqlDeleteUpload = "DELETE FROM hrdprosedurupload WHERE idProsedur = '$idGet' AND idUpload NOT IN ($str2)";
        mysqli_query($connect, $sqlDeleteUpload);
        }
    }

// Loop
    $uploadBpData = $_POST['uploadBpData'];
    if(empty($uploadBpData)) {

    } else {
        $dataBP = count($_POST["uploadBpData"]);
        for($y = 0; $y < $dataBP; $y++) {
            $uploadBP1 = $_FILES["uploadBP"]["name"][$y];
            $uploadBpData = $_POST['uploadBpData'][$y];
            $orderUploadBP = $_POST['orderUploadBP'][$y];

            if(empty($uploadBP) && $uploadBpData) {
                $sqlInsertCheck = "INSERT INTO temporder_check (checkOrder) VALUES ('$orderUploadBP')";
                mysqli_query($connect, $sqlInsertCheck);
            }
        }
    }

    $sqlCheckOrder = "SELECT checkOrder, COUNT(checkOrder) AS Total 
    FROM temporder_check 
    GROUP BY checkOrder
    HAVING COUNT(checkOrder) > 1";
    $checkOrder = mysqli_query($connect, $sqlCheckOrder);

    if(mysqli_num_rows($checkOrder) == 0) {
        $uploadBpData = $_POST['uploadBpData'];
        if(empty($uploadBpData)) {
    
        } else {
            for($k = 0; $k < $dataBP; $k++) {
                $uploadBpData = $_POST['uploadBpData'][$k];
                $orderUploadBP = $_POST['orderUploadBP'][$k];
                $uploadBpSystem = $_POST['uploadBpSystem'][$k];
                $uploadBP1 = $_FILES["uploadBP"]["name"][$k];
                $bpOrderData = $_POST['bpOrderData'][$k];
                $dataOrder = $_POST['dataOrder'][$k];
        
                if(empty($uploadBP1)) {
                    $uploadBP = "";
                } else {
                    $timeBP = date("dmy").time();
                    $uploadBP = $timeBP.$uploadBP1;
                }
        
                $sqlGetId = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomor'";
                $getId = mysqli_query($connect, $sqlGetId);
                $arrayId = mysqli_fetch_array($getId);
                $idGet = $arrayId['idProsedur'];     
        
                if(empty($uploadBpData) && $uploadBP) {
                    $sqlCekOrder = "SELECT * FROM hrdprosedurupload WHERE bpOrder = '$orderUploadBP' AND idProsedur = '$idGet'";
                    $cekOrder = mysqli_query($connect, $sqlCekOrder);
        
                    $allowed = array('jpg','jpeg', 'png', '');
                    $ext = pathinfo($uploadBP, PATHINFO_EXTENSION);

                    if(!in_array($ext, $allowed)) {
                        
                    } else {
                        if(mysqli_num_rows($cekOrder) == 0) {
                            $tempBp = $_FILES["uploadBP"]["tmp_name"][$k];
                            $folderBp = "image/".$uploadBP;
                            compressImage($tempBp, $folderBp, 20);
                        
                            $updateModify = "UPDATE hrmprosedur SET modified_by = '".$nama."', modified_date = NOW() WHERE prosedur_code = '$nomor'";
                            mysqli_query($connect, $updateModify);
                        
                            $sqlInsertBp = "INSERT INTO hrdprosedurupload (businessPicture, idProsedur, bpOrder, modified_by, modified_date) VALUES ('$uploadBP', '$idGet', '$orderUploadBP', '".$nama."', NOW())";
                            mysqli_query($connect, $sqlInsertBp);
                            $alert = 0;
                        
                            $sqlSelectMaxId = "SELECT MAX(idUpload) FROM hrdprosedurupload WHERE idProsedur = '$idGet'";
                            $selectMaxId = mysqli_query($connect, $sqlSelectMaxId);
                            $arrayMaxId = mysqli_fetch_array($selectMaxId);
                            $idUploadData = $arrayMaxId['MAX(idUpload)'];
                        
                            $before = "";
                            $after = "idUpload-$idUploadData/$uploadBP";

                            $sqlGetId = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomor'";
                            $getId = mysqli_query($connect, $sqlGetId);
                            $arrayId = mysqli_fetch_array($getId);
                            $idGet = $arrayId['idProsedur']; 
                        
                            $sqlInsertLog = "INSERT INTO hrdlogprosedur (emp_id, modified_date, idProsedur, sebelum, sesudah, aksi) VALUES ('".$username."', NOW(), '$idGet', '$before', '$after', 'insert')";
                            mysqli_query($connect, $sqlInsertLog);
                        } else {
                            echo '<script>alert("Order sudah terdaftar !");</script>';
                        }
                    }
                }

                if(empty($uploadBP) && $uploadBpData) {
                    if($bpOrderData != $orderUploadBP) {
                        $updateModify = "UPDATE hrmprosedur SET modified_by = '".$nama."', modified_date = NOW() WHERE prosedur_code = '$nomor'";
                        mysqli_query($connect, $updateModify);

                        $before = "idUpload-$uploadBpSystem/$uploadBpData/$bpOrderData";
                        $after = "idUpload-$uploadBpSystem/$uploadBpData/$orderUploadBP";

                        $sqlGetId = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomor'";
                        $getId = mysqli_query($connect, $sqlGetId);
                        $arrayId = mysqli_fetch_array($getId);
                        $idGet = $arrayId['idProsedur']; 

                        $sqlInsertLog = "INSERT INTO hrdlogprosedur (emp_id, modified_date, idProsedur, sebelum, sesudah, aksi) VALUES ('".$username."', NOW(), '$idGet', '$before', '$after', 'update')";
                        mysqli_query($connect, $sqlInsertLog);

                        $sqlUpdateBP = "UPDATE hrdprosedurupload SET modified_by = '".$nama."', bpOrder = '$orderUploadBP' WHERE idProsedur = '$idGet' AND idUpload = '$uploadBpSystem'";
                        mysqli_query($connect, $sqlUpdateBP);
                        $alert = 0;
                    }
                }
        
                if($uploadBP && $uploadBpData) {
                    $sqlGetId = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomor'";
                    $getId = mysqli_query($connect, $sqlGetId);
                    $arrayId = mysqli_fetch_array($getId);
                    $idGet = $arrayId['idProsedur'];

                    $sqlCekOrder = "SELECT * FROM hrdprosedurupload WHERE bpOrder = '$orderUploadBP' and idProsedur = '$idGet'";
                    $cekOrder = mysqli_query($connect, $sqlCekOrder);

                    if($bpOrderData == $orderUploadBP || mysqli_num_rows($cekOrder) == 0) {
                        $allowed = array('jpg','jpeg', 'png', '');
                        $ext = pathinfo($uploadBP, PATHINFO_EXTENSION);

                        $before = "idUpload-$uploadBpSystem/$uploadBpData/$bpOrderData";
                        $after = "idUpload-$uploadBpSystem/$uploadBP/$orderUploadBP";

                        $sqlGetId = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomor'";
                        $getId = mysqli_query($connect, $sqlGetId);
                        $arrayId = mysqli_fetch_array($getId);
                        $idGet = $arrayId['idProsedur']; 

                        $sqlInsertLog = "INSERT INTO hrdlogprosedur (emp_id, modified_date, idProsedur, sebelum, sesudah, aksi) VALUES ('".$username."', NOW(), '$idGet', '$before', '$after', 'update')";
                        mysqli_query($connect, $sqlInsertLog);
                        
                        if(!in_array($ext, $allowed)) {
                            
                        } else {
                            $updateModify = "UPDATE hrmprosedur SET modified_by = '".$nama."', modified_date = NOW() WHERE prosedur_code = '$nomor'";
                            mysqli_query($connect, $updateModify);
    
                            $tempBp = $_FILES["uploadBP"]["tmp_name"][$k];
                            $folderBp = "image/".$uploadBP;
                            compressImage($tempBp, $folderBp, 20);
            
                            $sqlBp = "SELECT * FROM hrdprosedurupload WHERE idProsedur = '$idGet' AND idUpload = '$uploadBpSystem'";
                            $Bp = mysqli_query($connect, $sqlBp);
                            $dataBp = mysqli_fetch_array($Bp);
            
                            if(is_file("image/".$dataBp['businessPicture'])) {
                                unlink("image/".$dataBp['businessPicture']); 
                            }
            
                            $sqlUpdateBP = "UPDATE hrdprosedurupload SET modified_by = '".$nama."', businessPicture = '$uploadBP', bpOrder = '$orderUploadBP' WHERE idProsedur = '$idGet' AND idUpload = '$uploadBpSystem'";
                            mysqli_query($connect, $sqlUpdateBP);
                            $alert = 0;
                        }
        
                    } else {
                        echo'<script>alert("Order sudah terdaftar !");</script>';
                    }
                }
        
            }
        }       
    } else {
        echo'<script>alert("Ada nomor order yang sama");</script>';
    }

    $sqlDeleteAll = "DELETE FROM temporder_check";
    mysqli_query($connect, $sqlDeleteAll);

    // Update Image Doc

    $timeBPD = date("dmy").time();
    $uploadBPD1 = $_FILES["uploadBPD"]["name"];
    if(empty($uploadBPD1)) {
        $uploadBPD = "";
    } else {
        $uploadBPD = $timeBPD.$uploadBPD1;
    }

    $allowedDoc = array('docx','');
    $extDoc = pathinfo($uploadBPD, PATHINFO_EXTENSION);
    
    if(!in_array($extDoc, $allowedDoc)) {
        echo '<script>alert("Format File Business Process Doc hanya docx");
        </script>';
    } else {
        $uploadBpDoc = $_POST['uploadBpDoc'];
        if(empty($uploadBpDoc) && $uploadBPD) {
            $updateModify = "UPDATE hrmprosedur SET modified_by = '".$nama."', modified_date = NOW() WHERE prosedur_code = '$nomor'";
            mysqli_query($connect, $updateModify);

            $sqlGetIdDoc = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomor'";
            $getIdDoc = mysqli_query($connect, $sqlGetIdDoc);
            $arrayIdDoc = mysqli_fetch_array($getIdDoc);
            $idGetDoc = $arrayIdDoc['idProsedur'];

            $tempnameDoc = $_FILES["uploadBPD"]["tmp_name"];
            $folderDoc = "image/".$uploadBPD;
            move_uploaded_file($tempnameDoc, $folderDoc);

            $sqlInsertBpd = "INSERT INTO hrdprosedurdoc (idProsedur, businessPictureDoc, created_date, modified_date, modified_by) VALUES ('$idGetDoc', '$uploadBPD', NOW(), NOW(), '".$nama."')";
            mysqli_query($connect, $sqlInsertBpd);
            $alert = 0;

            $sqlSelectMaxIdDoc = "SELECT MAX(idDoc) FROM hrdprosedurdoc WHERE idProsedur = '$idGetDoc' AND modified_by = '".$nama."'";
            $selectMaxIdDoc = mysqli_query($connect, $sqlSelectMaxIdDoc);
            $arrayMyIdDoc = mysqli_fetch_array($selectMaxIdDoc);
            $myIdDoc = $arrayMyIdDoc['MAX(idDoc)'];

            $before = "";
            $after = "idDoc-$myIdDoc/$uploadBPD";

            $sqlInsertLog = "INSERT INTO hrdlogprosedur (emp_id, modified_date, idProsedur, sebelum, sesudah, aksi) VALUES ('".$username."', NOW(), '$idGetDoc', '$before', '$after', 'insert')";
            mysqli_query($connect, $sqlInsertLog);
        }

        $sqlGetIdDoc = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomor'";
        $getIdDoc = mysqli_query($connect, $sqlGetIdDoc);
        $arrayIdDoc = mysqli_fetch_array($getIdDoc);
        $idGetDoc = $arrayIdDoc['idProsedur'];

        $sqlCekIsi = "SELECT * FROM hrdprosedurdoc WHERE idProsedur = '$idGetDoc'";
        $cekIsi = mysqli_query($connect, $sqlCekIsi);

        if(empty($uploadBpDoc) && empty($uploadBPD) && mysqli_num_rows($cekIsi) > 0) {
            $updateModify = "UPDATE hrmprosedur SET modified_by = '".$nama."', modified_date = NOW() WHERE prosedur_code = '$nomor'";
            mysqli_query($connect, $updateModify);

            $sqlSelectIdDoc = "SELECT * FROM hrdprosedurdoc WHERE idProsedur = '$idGetDoc'";
            $selectIdDoc = mysqli_query($connect, $sqlSelectIdDoc);
            $arrayIdDoc = mysqli_fetch_array($selectIdDoc);
            $myIdDoc = $arrayIdDoc['idDoc'];
            $myPictureDoc = $arrayIdDoc['businessPictureDoc'];

            $before = "idDoc-$myIdDoc/$myPictureDoc";
            $after = "empty";

            $sqlGetId = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomor'";
            $getId = mysqli_query($connect, $sqlGetId);
            $arrayId = mysqli_fetch_array($getId);
            $idGet = $arrayId['idProsedur']; 

            $sqlInsertLog = "INSERT INTO hrdlogprosedur (emp_id, modified_date, idProsedur, sebelum, sesudah, aksi) VALUES ('".$username."', NOW(), '$idGet', '$before', '$after', 'delete')";
            mysqli_query($connect, $sqlInsertLog);

            $sqlBpd = "SELECT * FROM hrdprosedurdoc WHERE idProsedur = '$idGetDoc'";
            $Bpd = mysqli_query($connect, $sqlBpd);
            $dataBpd = mysqli_fetch_array($Bpd);
        
            if(is_file("image/".$dataBpd['businessPictureDoc'])) {
                    unlink("image/".$dataBpd['businessPictureDoc']); 
                }

            $sqlDeleteBPD = "DELETE FROM hrdprosedurdoc WHERE idProsedur = '$idGetDoc'";
            mysqli_query($connect, $sqlDeleteBPD);
            $alert = 0;
        }

        if($uploadBPD && $uploadBpDoc) {
            $updateModify = "UPDATE hrmprosedur SET modified_by = '".$nama."', modified_date = NOW() WHERE prosedur_code = '$nomor'";
            mysqli_query($connect, $updateModify);

            $sqlSelectIdDoc = "SELECT * FROM hrdprosedurdoc WHERE idProsedur = '$idGetDoc'";
            $selectIdDoc = mysqli_query($connect, $sqlSelectIdDoc);
            $arrayIdDoc = mysqli_fetch_array($selectIdDoc);
            $myIdDoc = $arrayIdDoc['idDoc'];
            $myPictureDoc = $arrayIdDoc['businessPictureDoc'];

            $before = "idDoc-$myIdDoc/$myPictureDoc";
            $after = "idDoc-$myIdDoc/$uploadBPD";

            $sqlGetId = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomor'";
            $getId = mysqli_query($connect, $sqlGetId);
            $arrayId = mysqli_fetch_array($getId);
            $idGet = $arrayId['idProsedur'];

            $sqlInsertLog = "INSERT INTO hrdlogprosedur (emp_id, modified_date, idProsedur, sebelum, sesudah, aksi) VALUES ('".$username."', NOW(), '$idGet', '$before', '$after', 'update')";
            mysqli_query($connect, $sqlInsertLog);

            $tempnameDoc = $_FILES["uploadBPD"]["tmp_name"];
            $folderDoc = "image/".$uploadBPD;
            move_uploaded_file($tempnameDoc, $folderDoc);

            $sqlBpd = "SELECT * FROM hrdprosedurdoc WHERE idProsedur = '$idGetDoc'";
            $Bpd = mysqli_query($connect, $sqlBpd);
            $dataBpd = mysqli_fetch_array($Bpd);
        
            if(is_file("image/".$dataBpd['businessPictureDoc'])) {
                    unlink("image/".$dataBpd['businessPictureDoc']); 
                }

            $sqlUpdateBPD = "UPDATE hrdprosedurdoc SET modified_by = '".$nama."', businessPictureDoc = '$uploadBPD' WHERE idProsedur = '$idGetDoc'";
            mysqli_query($connect, $sqlUpdateBPD);
            $alert = 0;
        }

    }

    // insert ketentuan
    $idKetentuanSystemLama = $_POST['idKetentuanSystemLama'];
    $encodeSystemLamaKetentuan = json_encode($idKetentuanSystemLama, TRUE);

    $idKetentuanSystem = $_POST['idKetentuanSystem'];
    $encodeSystemKetentuan = json_encode($idKetentuanSystem, TRUE);

    $sqlGetId = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomor'";
    $getId = mysqli_query($connect, $sqlGetId);
    $arrayId = mysqli_fetch_array($getId);
    $idGet = $arrayId['idProsedur'];

    if($encodeSystemLamaKetentuan != $encodeSystemKetentuan) {
        $alert = 0;
        $idKetentuanSystem = $_POST['idKetentuanSystem'];
        $encodeKetentuanId = json_encode($idKetentuanSystem, TRUE);
        $strKet1 = str_replace("[", "", $encodeKetentuanId);
        $strKet2 = str_replace("]", "", $strKet1);

        $sqlCekKetentuanDelete = "SELECT * FROM hrdprosedurketentuan WHERE idKetentuan NOT IN ($strKet2) AND idProsedur = '$idGet'";
        $cekKetentuanDelete = mysqli_query($connect, $sqlCekKetentuanDelete);

        if(mysqli_num_rows($cekKetentuanDelete) == 0) {

        } else {
            $updateModify = "UPDATE hrmprosedur SET modified_by = '".$nama."', modified_date = NOW() WHERE prosedur_code = '$nomor'";
            mysqli_query($connect, $updateModify);

            while($dataImageKetentuan = mysqli_fetch_array($cekKetentuanDelete)) {
                if(is_file("image/".$dataImageKetentuan['foto'])) {
                    unlink("image/".$dataImageKetentuan['foto']); 
                }
            }
        }

        if(mysqli_num_rows($cekKetentuanDelete) > 0) {
            $sqlGetId = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomor'";
            $getId = mysqli_query($connect, $sqlGetId);
            $arrayId = mysqli_fetch_array($getId);
            $idProsedur = $arrayId['idProsedur'];

            $before = "idKetentuan$encodeSystemLamaKetentuan";
            $after = "idKetentuan$encodeSystemKetentuan";
            $sqlInsertLog = "INSERT INTO hrdlogprosedur (emp_id, modified_date, idProsedur, sebelum, sesudah,aksi) VALUES ('".$username."', NOW(), '$idProsedur', '$before', '$after', 'delete')";
            mysqli_query($connect, $sqlInsertLog);

            $sqlUpdateModify = "UPDATE hrmprosedur SET modified_by = '".$nama."', modified_date = NO() WHERE prosedur_code = '$nomor'";
            mysqli_query($connect, $sqlUpdateModify);
        }
            
        $sqlDelKet = "DELETE FROM hrdprosedurketentuan WHERE idKetentuan NOT IN ($strKet2) AND idProsedur='$idGet'";
        mysqli_query($connect, $sqlDelKet);
    }

    $dataKetentuanFoto = $_POST['uploadLama'];
    $encodeDataKetentuanFoto = json_encode($dataKetentuanFoto, TRUE);

    $ketentuanFoto = $_POST['uploadKetentuanIsi'];
    $encodeKetentuanFoto = json_encode($ketentuanFoto, TRUE);

    $strKetentuanFoto = str_replace("[", "", $encodeKetentuanFoto);
    $strKetentuanFoto2 = str_replace("]", "", $strKetentuanFoto);

    if($encodeDataKetentuanFoto != $encodeKetentuanFoto) {
        $sqlSelectDataKetentuan = "SELECT * FROM hrdprosedurketentuan WHERE foto NOT IN ($strKetentuanFoto2) AND idProsedur = '$idGet'";
        $selectDataKetentuan = mysqli_query($connect, $sqlSelectDataKetentuan);

        if(mysqli_num_rows($selectDataKetentuan) == 0) {

        } else {
            $updateModify = "UPDATE hrmprosedur SET modified_by = '".$nama."', modified_date = NOW() WHERE prosedur_code = '$nomor'";
            mysqli_query($connect, $updateModify);

            while($dataImageKetentuan = mysqli_fetch_array($selectDataKetentuan)) {
                if(is_file("image/".$dataImageKetentuan['foto'])) {
                    unlink("image/".$dataImageKetentuan['foto']); 
                }
            }
        }

        $sqlUpdateFotoKetentuan = "UPDATE hrdprosedurketentuan SET foto = '' WHERE foto NOT IN ($strKetentuanFoto2) AND idProsedur = '$idGet' AND modified_by = '".$nama."'";
        mysqli_query($connect, $sqlUpdateFotoKetentuan);
        $alert = 0;
    }

    $idKetentuan = $_POST['idKetentuan'];
    if(empty($idKetentuan)) {
        $sqlCekAdaDataKetentuan = "SELECT * FROM hrdprosedurketentuan WHERE idProsedur = '$idGet'";
        $cekAdaDataKetentuan = mysqli_query($connect, $sqlCekAdaDataKetentuan);

        $sqlUpdateModify = "UPDATE hrmprosedur SET modified_by = '".$nama."', modified_date = NOW() WHERE prosedur_code = '$nomor'";

        $sqlGetId = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomor'";
        $getId = mysqli_query($connect, $sqlGetId);
        $arrayId = mysqli_fetch_array($getId);
        $idProsedur = $arrayId['idProsedur'];

        if(mysqli_num_rows($cekAdaDataKetentuan) > 0) {
            $before = "idKetentuan$encodeSystemLamaKetentuan";
            $after = "empty";
            $sqlInsertLog = "INSERT INTO hrdlogprosedur (emp_id, modified_date, idProsedur, sebelum, sesudah,aksi) VALUES ('".$username."', NOW(), '$idProsedur', '$before', '$after', 'delete')";
            mysqli_query($connect, $sqlInsertLog);

            mysqli_query($connect, $sqlUpdateModify);
            $sqlDeleteKetentuan = "DELETE FROM hrdprosedurketentuan WHERE idProsedur = '$idGet'";
            mysqli_query($connect, $sqlDeleteKetentuan);
            $alert = 0;
        }

    } else {
        $dataKetentuan = count($_POST["idKetentuan"]);
        for($m=0; $m<$dataKetentuan; $m++) {
            // Data Ketentuan di Database
            $uploadLama = $_POST['uploadLama'][$m];
            $uploadKetentuanIsi = $_POST['uploadKetentuanIsi'][$m];
            
            // Ketentuan Post
            $idKetentuanSystem = $_POST['idKetentuanSystem'][$m];
            $idKetentuan = $_POST['idKetentuan'][$m];
            $ketentuan = $_POST['ketentuan'][$m];
            $timeKet = date("dmy").time();
            $uploadKetentuan1 = $_FILES["uploadKetentuan"]["name"][$m];

            if(empty($uploadKetentuan1)) {
                $uploadKetentuan = "";
            } else {
                $allowedKetentuan = array('jpg','jpeg', 'png', '');
                $extKetentuan = pathinfo($uploadKetentuan1, PATHINFO_EXTENSION);

                if(!in_array($extKetentuan, $allowedKetentuan)) {
                    $uploadKetentuan = "";
                } else {
                    $uploadKetentuan = $timeKet.$uploadKetentuan1;
                }
            }

            // Kebutuhan Ketentuan
            $sqlGetId = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomor'";
            $getId = mysqli_query($connect, $sqlGetId);
            $arrayId = mysqli_fetch_array($getId);
            $idGet = $arrayId['idProsedur'];

            $sqlCekKet = "SELECT * FROM hrdprosedurketentuan WHERE ketentuan_code = '$idKetentuan' and idProsedur = '$idGet'";
            $cekKet = mysqli_query($connect, $sqlCekKet);

            // Validasi Ketentuan
            $sqlBandingKetentuan = "SELECT ketentuan_code, deskripsi, foto,
            CONCAT(ketentuan_code,'/', deskripsi, '/', foto) AS data_before,
            CONCAT(ketentuan_code_after,'/', deskripsi_after, '/', foto_after) AS data_after
            FROM
            (
                SELECT
                ketentuan_code,deskripsi,foto,
                case when '$idKetentuan' = ketentuan_code THEN ketentuan_code ELSE '$idKetentuan' END AS ketentuan_code_after,
                case when '$ketentuan' = deskripsi  THEN deskripsi ELSE '$ketentuan' END AS deskripsi_after,
                case when '$uploadKetentuan' = foto  THEN foto ELSE '$uploadKetentuan' END AS foto_after
                FROM 
                hrdprosedurketentuan
                WHERE idKetentuan ='$idKetentuanSystem' AND idProsedur = '$idGet'
            )filterKetentuan";

            $myDataKetentuan =  mysqli_query($connect, $sqlBandingKetentuan);
            $arrayDataKetentuan = mysqli_fetch_array($myDataKetentuan);

            // Query SQL
            $sqlUpdateKetentuan = "UPDATE hrdprosedurketentuan SET modified_by = '".$nama."', ketentuan_code = '$idKetentuan', deskripsi = '$ketentuan', modified_date = NOW() WHERE ketentuan_code = '".$arrayDataKetentuan['ketentuan_code']."' and idProsedur = '$idGet'";

            $sqlInsertKetentuan = "INSERT INTO hrdprosedurketentuan (ketentuan_code, idProsedur, deskripsi, modified_by, foto, modified_date, created_date, created_by) VALUES ('$idKetentuan', '$idGet', '$ketentuan', '".$nama."', '', NOW(), NOW(), '".$nama."')";

            $sqlUpdateModify = "UPDATE hrmprosedur SET modified_by = '".$nama."', modified_date = NOW() WHERE prosedur_code = '$nomor'";

            // Mulai query

            if($idKetentuan != $arrayDataKetentuan['ketentuan_code'] || $ketentuan != $arrayDataKetentuan['deskripsi'] || $uploadKetentuan || $uploadKetentuanIsi != $uploadLama) {
                    $before2 = "idKetentuan-$idKetentuanSystem/".$arrayDataKetentuan['data_before']."";
                    $after2 = "idKetentuan-$idKetentuanSystem/".$arrayDataKetentuan['data_after']."";

                    if($uploadKetentuanIsi != $uploadLama) {
                        $before = "$before2$uploadLama";
                    } else {
                        $before = $before2;
                    }

                    if($uploadKetentuanIsi && empty($uploadKetentuan)) {
                        $after = "$after2$uploadKetentuanIsi";
                    } else {
                        $after = $after2;
                    }

                    $sqlGetId = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomor'";
                    $getId = mysqli_query($connect, $sqlGetId);
                    $arrayId = mysqli_fetch_array($getId);
                    $idProsedur = $arrayId['idProsedur'];

                    $sqlInsertLog = "INSERT INTO hrdlogprosedur (emp_id, modified_date, idProsedur, sebelum, sesudah, aksi) VALUES ('".$username."', NOW(), '$idProsedur', '$before', '$after', 'Update')";

                    $allowedKetentuan = array('jpg','jpeg', 'png', '');
                    $extKetentuan = pathinfo($uploadKetentuan, PATHINFO_EXTENSION);
                    
                    if($idKetentuan == $arrayDataKetentuan['ketentuan_code']) {
                        mysqli_query($connect, $sqlInsertLog);
                        mysqli_query($connect, $sqlUpdateModify);
                        mysqli_query($connect, $sqlUpdateKetentuan);
                        $alert = 0;

                        if($uploadKetentuan) {
                            if(!in_array($extKetentuan, $allowedKetentuan)) {
                                echo '<script>alert("Format file upload ketentuan hanya jpg, jpeg, png"); </script>';
                            } else {
                                $tempKetentuan = $_FILES["uploadKetentuan"]["tmp_name"][$m];
                                $folderKetentuan = "image/".$uploadKetentuan;
            
                                $sqlKetentuan = "UPDATE hrdprosedurketentuan SET modified_by = '".$nama."', foto = '$uploadKetentuan' WHERE ketentuan_code = '$idKetentuan' and idProsedur = '$idProsedur'";
            
                                if(is_file("image/".$uploadKetentuanIsi)) {
                                    unlink("image/".$uploadKetentuanIsi); 
                                }
                                
                                $alert = 0;
                                compressImage($tempKetentuan, $folderKetentuan, 20);
                                mysqli_query($connect, $sqlKetentuan);
                            }
                        }

                    }

                    if(mysqli_num_rows($cekKet) == 0 && $idKetentuan != $arrayDataKetentuan['ketentuan_code'] && $idKetentuanSystem) {
                        mysqli_query($connect, $sqlInsertLog);
                        mysqli_query($connect, $sqlUpdateModify);
                        mysqli_query($connect, $sqlUpdateKetentuan);
                        $alert = 0;

                        if($uploadKetentuan) {
                            if(!in_array($extKetentuan, $allowedKetentuan)) {
                                echo '<script>alert("Format file upload ketentuan hanya jpg, jpeg, png"); </script>';
                            } else {
                                $tempKetentuan = $_FILES["uploadKetentuan"]["tmp_name"][$m];
                                $folderKetentuan = "image/".$uploadKetentuan;
            
                                $sqlGetId = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomor'";
                                $getId = mysqli_query($connect, $sqlGetId);
                                $arrayId = mysqli_fetch_array($getId);
                                $idProsedur = $arrayId['idProsedur'];

                                $sqlKetentuan = "UPDATE hrdprosedurketentuan SET modified_by = '".$nama."', foto = '$uploadKetentuan' WHERE ketentuan_code = '$idKetentuan' and idProsedur = '$idProsedur'";
            
                                if(is_file("image/".$uploadKetentuanIsi)) {
                                    unlink("image/".$uploadKetentuanIsi); 
                                }
                                
                                $alert = 0;
                                compressImage($tempKetentuan, $folderKetentuan, 20);
                                mysqli_query($connect, $sqlKetentuan);
                            }
                        }

                    }

                    if(mysqli_num_rows($cekKet) == 0 && empty($idKetentuanSystem)) {
                        mysqli_query($connect, $sqlUpdateModify);
                        mysqli_query($connect, $sqlInsertKetentuan);
                        $alert = 0;

                        $sqlGetMaxIdKetentuan = "SELECT MAX(idKetentuan) FROM hrdprosedurketentuan WHERE idProsedur = '$idGet' AND  modified_by = '".$nama."'";
                        $getMaxIdKetentuan = mysqli_query($connect, $sqlGetMaxIdKetentuan);
                        $arrayMaxIdKetentuan = mysqli_fetch_array($getMaxIdKetentuan);
                        $maxIdKetentuan = $arrayMaxIdKetentuan['MAX(idKetentuan)'];
                        
                        $beforeInsert = "";
                        $afterInsert = "idKetentuan-$maxIdKetentuan/$idKetentuan/$ketentuan/$uploadKetentuan";

                        $sqlGetId = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomor'";
                        $getId = mysqli_query($connect, $sqlGetId);
                        $arrayId = mysqli_fetch_array($getId);
                        $idProsedur = $arrayId['idProsedur'];

                        $sqlInsertLog2 = "INSERT INTO hrdlogprosedur (emp_id, modified_date, idProsedur, sebelum, sesudah,aksi) VALUES ('".$username."', NOW(), '$idProsedur', '$beforeInsert', '$afterInsert', 'insert')";
                        mysqli_query($connect, $sqlInsertLog2);

                        if($uploadKetentuan) {
                            if(!in_array($extKetentuan, $allowedKetentuan)) {
                                echo '<script>alert("Format file upload ketentuan hanya jpg, jpeg, png"); </script>';
                            } else {
                                $tempKetentuan = $_FILES["uploadKetentuan"]["tmp_name"][$m];
                                $folderKetentuan = "image/".$uploadKetentuan;
            
                                $sqlGetId = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomor'";
                                $getId = mysqli_query($connect, $sqlGetId);
                                $arrayId = mysqli_fetch_array($getId);
                                $idProsedur = $arrayId['idProsedur'];

                                $sqlKetentuan = "UPDATE hrdprosedurketentuan SET modified_by = '".$nama."', foto = '$uploadKetentuan' WHERE ketentuan_code = '$idKetentuan' and idProsedur = '$idProsedur'";
            
                                if(is_file("image/".$uploadKetentuanIsi)) {
                                    unlink("image/".$uploadKetentuanIsi); 
                                }

                                $alert = 0;
                                compressImage($tempKetentuan, $folderKetentuan, 20);
                                mysqli_query($connect, $sqlKetentuan);
                            }
                        }
                    }
            }

        }

    }

    // insert Keterangan
    $idKeteranganSystemLama = $_POST['idKeteranganSystemLama'];
    $encodeSystemLamaKeterangan = json_encode($idKeteranganSystemLama, TRUE);

    $idKeteranganSystem = $_POST['idKeteranganSystem'];
    $encodeSystemKeterangan = json_encode($idKeteranganSystem, TRUE);

    $sqlGetId = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomor'";
    $getId = mysqli_query($connect, $sqlGetId);
    $arrayId = mysqli_fetch_array($getId);
    $idGet = $arrayId['idProsedur'];

    if($encodeSystemLamaKeterangan != $encodeSystemKeterangan) {
        $alert = 0;
        $idKeteranganSystem = $_POST['idKeteranganSystem'];
        $encodeKeteranganId = json_encode($idKeteranganSystem, TRUE);
        $strKet1 = str_replace("[", "", $encodeKeteranganId);
        $strKet2 = str_replace("]", "", $strKet1);

        $sqlCekKeteranganDelete = "SELECT * FROM hrdprosedurketerangan WHERE idKeterangan NOT IN ($strKet2) AND idProsedur = '$idGet'";
        $cekKeteranganDelete = mysqli_query($connect, $sqlCekKeteranganDelete);

        if(mysqli_num_rows($cekKeteranganDelete) == 0) {

        } else {
            $updateModify = "UPDATE hrmprosedur SET modified_by = '".$nama."', modified_date = NOW() WHERE prosedur_code = '$nomor'";
            mysqli_query($connect, $updateModify);

            while($dataImageKeterangan = mysqli_fetch_array($cekKeteranganDelete)) {
                if(is_file("image/".$dataImageKeterangan['foto'])) {
                    unlink("image/".$dataImageKeterangan['foto']); 
                }
            }
        }

        if(mysqli_num_rows($cekKeteranganDelete) > 0) {
            $sqlGetId = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomor'";
            $getId = mysqli_query($connect, $sqlGetId);
            $arrayId = mysqli_fetch_array($getId);
            $idProsedur = $arrayId['idProsedur'];

            $before = "idKeterangan$encodeSystemLamaKeterangan";
            $after = "idKeterangan$encodeSystemKeterangan";
            $sqlInsertLog = "INSERT INTO hrdlogprosedur (emp_id, modified_date, idProsedur, sebelum, sesudah,aksi) VALUES ('".$username."', NOW(), '$idProsedur', '$before', '$after', 'delete')";
            mysqli_query($connect, $sqlInsertLog);

            $sqlUpdateModify = "UPDATE hrmprosedur SET modified_by = '".$nama."', modified_date = NO() WHERE prosedur_code = '$nomor'";
            mysqli_query($connect, $sqlUpdateModify);
        }
            
        $sqlDelKet = "DELETE FROM hrdprosedurketerangan WHERE idKeterangan NOT IN ($strKet2) AND idProsedur='$idGet'";
        mysqli_query($connect, $sqlDelKet);
    }

    $dataKeteranganFoto = $_POST['uploadKeteranganLama'];
    $encodeDataKeteranganFoto = json_encode($dataKeteranganFoto, TRUE);

    $keteranganFoto = $_POST['uploadKeteranganIsi'];
    $encodeKeteranganFoto = json_encode($keteranganFoto, TRUE);

    $strKeteranganFoto = str_replace("[", "", $encodeKeteranganFoto);
    $strKeteranganFoto2 = str_replace("]", "", $strKeteranganFoto);

    if($encodeDataKeteranganFoto != $encodeKeteranganFoto) {
        $sqlSelectDataKeterangan = "SELECT * FROM hrdprosedurketerangan WHERE foto NOT IN ($strKeteranganFoto2) AND idProsedur = '$idGet'";
        $selectDataKeterangan = mysqli_query($connect, $sqlSelectDataKeterangan);

        if(mysqli_num_rows($selectDataKeterangan) == 0) {

        } else {
            $updateModify = "UPDATE hrmprosedur SET modified_by = '".$nama."', modified_date = NOW() WHERE prosedur_code = '$nomor'";
            mysqli_query($connect, $updateModify);

            while($dataImageKeterangan = mysqli_fetch_array($selectDataKeterangan)) {
                if(is_file("image/".$dataImageKeterangan['foto'])) {
                    unlink("image/".$dataImageKeterangan['foto']); 
                }
            }
        }

        $sqlUpdateFotoKeterangan = "UPDATE hrdprosedurketerangan SET foto = '' WHERE foto NOT IN ($strKeteranganFoto2) AND idProsedur = '$idGet' AND modified_by = '".$nama."'";
        mysqli_query($connect, $sqlUpdateFotoKeterangan);
        $alert = 0;
    }

    $idKeterangan = $_POST['idKeterangan'];
    if(empty($idKeterangan)) {
        $sqlCekAdaDataKeterangan = "SELECT * FROM hrdprosedurketerangan WHERE idProsedur = '$idGet'";
        $cekAdaDataKeterangan = mysqli_query($connect, $sqlCekAdaDataKeterangan);

        $sqlUpdateModify = "UPDATE hrmprosedur SET modified_by = '".$nama."', modified_date = NOW() WHERE prosedur_code = '$nomor'";

        if(mysqli_num_rows($cekAdaDataKeterangan) > 0) {
            $sqlGetId = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomor'";
            $getId = mysqli_query($connect, $sqlGetId);
            $arrayId = mysqli_fetch_array($getId);
            $idProsedur = $arrayId['idProsedur'];

            $before = "idKeterangan$encodeSystemLamaKeterangan";
            $after = "empty";
            $sqlInsertLog = "INSERT INTO hrdlogprosedur (emp_id, modified_date, idProsedur, sebelum, sesudah,aksi) VALUES ('".$username."', NOW(), '$idProsedur', '$before', '$after', 'delete')";
            mysqli_query($connect, $sqlInsertLog);

            mysqli_query($connect, $sqlUpdateModify);
            $sqlDeleteKeterangan = "DELETE FROM hrdprosedurketerangan WHERE idProsedur = '$idGet'";
            mysqli_query($connect, $sqlDeleteKeterangan);
            $alert = 0;
        }

    } else {
        $dataKeterangan = count($_POST["idKeterangan"]);
        for($m=0; $m<$dataKeterangan; $m++) {
            // Data Keterangan di Database
            $uploadKeteranganLama = $_POST['uploadKeteranganLama'][$m];
            $uploadKeteranganIsi = $_POST['uploadKeteranganIsi'][$m];
            
            // Keterangan Post
            $idKeteranganSystem = $_POST['idKeteranganSystem'][$m];
            $idKeterangan = $_POST['idKeterangan'][$m];
            $keterangan = $_POST['keterangan'][$m];
            $timeKeterangan = date("dmy").time();
            $uploadKeterangan1 = $_FILES["uploadKeterangan"]["name"][$m];

            if(empty($uploadKeterangan1)) {
                $uploadKeterangan = "";
            } else {
                $allowedKeterangan = array('jpg','jpeg', 'png', '');
                $extKeterangan = pathinfo($uploadKeterangan1, PATHINFO_EXTENSION);

                if(!in_array($extKeterangan, $allowedKeterangan)) {
                    $uploadKeterangan = "";
                } else {
                    $uploadKeterangan = $timeKeterangan.$uploadKeterangan1;
                }
            }

            // Kebutuhan Keterangan
            $sqlGetId = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomor'";
            $getId = mysqli_query($connect, $sqlGetId);
            $arrayId = mysqli_fetch_array($getId);
            $idGet = $arrayId['idProsedur'];

            $sqlCekKet = "SELECT * FROM hrdprosedurketerangan WHERE keterangan_code = '$idKeterangan' and idProsedur = '$idGet'";
            $cekKet = mysqli_query($connect, $sqlCekKet);

            // Validasi Keterangan
            $sqlBandingKeterangan = "SELECT keterangan_code, deskripsi, foto,
            CONCAT(keterangan_code,'/', deskripsi, '/', foto) AS data_before,
            CONCAT(keterangan_code_after,'/', deskripsi_after, '/', foto_after) AS data_after
            FROM
            (
                SELECT
                keterangan_code,deskripsi,foto,
                case when '$idKeterangan' = keterangan_code THEN keterangan_code ELSE '$idKeterangan' END AS keterangan_code_after,
                case when '$keterangan' = deskripsi  THEN deskripsi ELSE '$keterangan' END AS deskripsi_after,
                case when '$uploadKeterangan' = foto  THEN foto ELSE '$uploadKeterangan' END AS foto_after
                FROM 
                hrdprosedurketerangan
                WHERE idKeterangan ='$idKeteranganSystem' AND idProsedur = '$idGet'
            )filterKeterangan";

            $myDataKeterangan =  mysqli_query($connect, $sqlBandingKeterangan);
            $arrayDataKeterangan = mysqli_fetch_array($myDataKeterangan);

            // Query SQL
            $sqlUpdateKeterangan = "UPDATE hrdprosedurketerangan SET modified_by = '".$nama."', keterangan_code = '$idKeterangan', deskripsi = '$keterangan', modified_date = NOW() WHERE keterangan_code = '".$arrayDataKeterangan['keterangan_code']."' and idProsedur = '$idGet'";

            $sqlInsertKeterangan = "INSERT INTO hrdprosedurketerangan (keterangan_code, idProsedur, deskripsi, modified_by, foto, modified_date, created_date, created_by) VALUES ('$idKeterangan', '$idGet', '$keterangan', '".$nama."', '', NOW(), NOW(), '".$nama."')";

            $sqlUpdateModify = "UPDATE hrmprosedur SET modified_by = '".$nama."', modified_date = NOW() WHERE prosedur_code = '$nomor'";

            // Mulai query

            if($idKeterangan != $arrayDataKeterangan['keterangan_code'] || $keterangan != $arrayDataKeterangan['deskripsi'] || $uploadKeterangan || $uploadKeteranganIsi != $uploadKeteranganLama) {
                
                    $before2 = "idKeterangan-$idKeteranganSystem/".$arrayDataKeterangan['data_before']."";
                    $after2 = "idKeterangan-$idKeteranganSystem/".$arrayDataKeterangan['data_after']."";

                    if($uploadKeteranganIsi != $uploadKeteranganLama) {
                        $before = "$before2$uploadKeteranganLama";
                    } else {
                        $before = $before2;
                    }

                    if($uploadKeteranganIsi && empty($uploadKeterangan)) {
                        $after = "$after2$uploadKeteranganIsi";
                    } else {
                        $after = $after2;
                    }

                    $sqlGetId = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomor'";
                    $getId = mysqli_query($connect, $sqlGetId);
                    $arrayId = mysqli_fetch_array($getId);
                    $idProsedur = $arrayId['idProsedur'];

                    $sqlInsertLog = "INSERT INTO hrdlogprosedur (emp_id, modified_date, idProsedur, sebelum, sesudah, aksi) VALUES ('".$username."', NOW(), '$idProsedur', '$before', '$after', 'Update')";

                    $allowedKeterangan = array('jpg','jpeg', 'png', '');
                    $extKeterangan = pathinfo($uploadKeterangan, PATHINFO_EXTENSION);
                    
                    if($idKeterangan == $arrayDataKeterangan['keterangan_code']) {
                        mysqli_query($connect, $sqlInsertLog);
                        mysqli_query($connect, $sqlUpdateModify);
                        mysqli_query($connect, $sqlUpdateKeterangan);
                        $alert = 0;

                        if($uploadKeterangan) {
                            if(!in_array($extKeterangan, $allowedKeterangan)) {
                                echo '<script>alert("Format file upload keterangan hanya jpg, jpeg, png"); </script>';
                            } else {
                                $tempKeterangan = $_FILES["uploadKeterangan"]["tmp_name"][$m];
                                $folderKeterangan = "image/".$uploadKeterangan;
            
                                $sqlKeterangan = "UPDATE hrdprosedurketerangan SET modified_by = '".$nama."', foto = '$uploadKeterangan' WHERE keterangan_code = '$idKeterangan' and idProsedur = '$idProsedur'";
            
                                if(is_file("image/".$uploadKeteranganIsi)) {
                                    unlink("image/".$uploadKeteranganIsi); 
                                }
            
                                compressImage($tempKeterangan, $folderKeterangan, 20);
                                mysqli_query($connect, $sqlKeterangan);
                                $alert = 0;
                            }
                        }

                    }

                    if(mysqli_num_rows($cekKet) == 0 && $idKeterangan != $arrayDataKeterangan['keterangan_code'] && $idKeteranganSystem) {
                        mysqli_query($connect, $sqlInsertLog);
                        mysqli_query($connect, $sqlUpdateModify);
                        mysqli_query($connect, $sqlUpdateKeterangan);
                        $alert = 0;

                        if($uploadKeterangan) {
                            if(!in_array($extKeterangan, $allowedKeterangan)) {
                                echo '<script>alert("Format file upload keterangan hanya jpg, jpeg, png"); </script>';
                            } else {
                                $tempKeterangan = $_FILES["uploadKeterangan"]["tmp_name"][$m];
                                $folderKeterangan = "image/".$uploadKeterangan;

                                $sqlKeterangan = "UPDATE hrdprosedurketerangan SET modified_by = '".$nama."', foto = '$uploadKeterangan' WHERE keterangan_code = '$idKeterangan' and idProsedur = '$idProsedur'";
            
                                if(is_file("image/".$uploadKeteranganIsi)) {
                                    unlink("image/".$uploadKeteranganIsi); 
                                }
            
                                compressImage($tempKeterangan, $folderKeterangan, 20);
                                mysqli_query($connect, $sqlKeterangan);
                                $alert = 0;
                            }
                        }

                    }

                    if(mysqli_num_rows($cekKet) == 0 && empty($idKeteranganSystem)) {
                        mysqli_query($connect, $sqlUpdateModify);
                        mysqli_query($connect, $sqlInsertKeterangan);
                        $alert = 0;

                        $sqlGetMaxIdKeterangan = "SELECT MAX(idKeterangan) FROM hrdprosedurketerangan WHERE idProsedur = '$idGet'";
                        $getMaxIdKeterangan = mysqli_query($connect, $sqlGetMaxIdKeterangan);
                        $arrayMaxIdKeterangan = mysqli_fetch_array($getMaxIdKeterangan);
                        $maxIdKeterangan = $arrayMaxIdKeterangan['MAX(idKeterangan)'];
                        
                        $beforeInsert = "";
                        $afterInsert = "idKeterangan-$maxIdKeterangan/$idKeterangan/$keterangan/$uploadKeterangan";

                        $sqlGetId = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomor'";
                        $getId = mysqli_query($connect, $sqlGetId);
                        $arrayId = mysqli_fetch_array($getId);
                        $idProsedur = $arrayId['idProsedur'];

                        $sqlInsertLog2 = "INSERT INTO hrdlogprosedur (emp_id, modified_date, idProsedur, sebelum, sesudah,aksi) VALUES ('".$username."', NOW(), '$idProsedur', '$beforeInsert', '$afterInsert', 'insert')";
                        mysqli_query($connect, $sqlInsertLog2);

                        if($uploadKeterangan) {
                            if(!in_array($extKeterangan, $allowedKeterangan)) {
                                echo '<script>alert("Format file upload keterangan hanya jpg, jpeg, png"); </script>';
                            } else {
                                $tempKeterangan = $_FILES["uploadKeterangan"]["tmp_name"][$m];
                                $folderKeterangan = "image/".$uploadKeterangan;
            
                                $sqlKeterangan = "UPDATE hrdprosedurketerangan SET modified_by = '".$nama."', foto = '$uploadKeterangan' WHERE keterangan_code = '$idKeterangan' and idProsedur = '$idProsedur'";
            
                                if(is_file("image/".$uploadKeteranganIsi)) {
                                    unlink("image/".$uploadKeteranganIsi); 
                                }
            
                                compressImage($tempKeterangan, $folderKeterangan, 20);
                                mysqli_query($connect, $sqlKeterangan);
                                $alert = 0;
                            }
                        }
                    }
            }

        }

    }

    // insert lampiran
    $idLampiranSystemLama = $_POST['idLampiranSystemLama'];
    $encodeSystemLamaLampiran = json_encode($idLampiranSystemLama, TRUE);

    $idLampiranSystem = $_POST['idLampiranSystem'];
    $encodeSystemLampiran = json_encode($idLampiranSystem, TRUE);

    $sqlGetId = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomor'";
    $getId = mysqli_query($connect, $sqlGetId);
    $arrayId = mysqli_fetch_array($getId);
    $idGet = $arrayId['idProsedur'];

    if($encodeSystemLamaLampiran != $encodeSystemLampiran) {
        $alert = 0;
        $idLampiranSystem = $_POST['idLampiranSystem'];
        $encodeLampiranId = json_encode($idLampiranSystem, TRUE);
        $strKet1 = str_replace("[", "", $encodeLampiranId);
        $strKet2 = str_replace("]", "", $strKet1);

        $sqlCekLampiranDelete = "SELECT * FROM hrdprosedurlampiran WHERE idLampiran NOT IN ($strKet2) AND idProsedur = '$idGet'";
        $cekLampiranDelete = mysqli_query($connect, $sqlCekLampiranDelete);

        if(mysqli_num_rows($cekLampiranDelete) == 0) {

        } else {
            $updateModify = "UPDATE hrmprosedur SET modified_by = '".$nama."', modified_date = NOW() WHERE prosedur_code = '$nomor'";
            mysqli_query($connect, $updateModify);

            while($dataImageLampiran = mysqli_fetch_array($cekLampiranDelete)) {
                if(is_file("image/".$dataImageLampiran['foto'])) {
                    unlink("image/".$dataImageLampiran['foto']); 
                }
            }
        }

        if(mysqli_num_rows($cekLampiranDelete) > 0) {
            $sqlGetId = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomor'";
            $getId = mysqli_query($connect, $sqlGetId);
            $arrayId = mysqli_fetch_array($getId);
            $idProsedur = $arrayId['idProsedur'];

            $before = "idLampiran$encodeSystemLamaLampiran";
            $after = "idLampiran$encodeSystemLampiran";
            $sqlInsertLog = "INSERT INTO hrdlogprosedur (emp_id, modified_date, idProsedur, sebelum, sesudah,aksi) VALUES ('".$username."', NOW(), '$idProsedur', '$before', '$after', 'delete')";
            mysqli_query($connect, $sqlInsertLog);

            $sqlUpdateModify = "UPDATE hrmprosedur SET modified_by = '".$nama."', modified_date = NO() WHERE prosedur_code = '$nomor'";
            mysqli_query($connect, $sqlUpdateModify);
        }
            
        $sqlDelKet = "DELETE FROM hrdprosedurlampiran WHERE idLampiran NOT IN ($strKet2) AND idProsedur='$idGet'";
        mysqli_query($connect, $sqlDelKet);
    }

    $dataLampiranFoto = $_POST['uploadLampiranLama'];
    $encodeDataLampiranFoto = json_encode($dataLampiranFoto, TRUE);

    $lampiranFoto = $_POST['uploadLampiranIsi'];
    $encodeLampiranFoto = json_encode($lampiranFoto, TRUE);

    $strLampiranFoto = str_replace("[", "", $encodeLampiranFoto);
    $strLampiranFoto2 = str_replace("]", "", $strLampiranFoto);

    if($encodeDataLampiranFoto != $encodeLampiranFoto) {
        $sqlGetId = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomor'";
        $getId = mysqli_query($connect, $sqlGetId);
        $arrayId = mysqli_fetch_array($getId);
        $idGet = $arrayId['idProsedur'];

        $sqlSelectDataLampiran = "SELECT * FROM hrdprosedurlampiran WHERE foto NOT IN ($strLampiranFoto2) AND idProsedur = '$idGet'";
        $selectDataLampiran = mysqli_query($connect, $sqlSelectDataLampiran);

        if(mysqli_num_rows($selectDataLampiran) == 0) {
            
        } else {
            
            $updateModify = "UPDATE hrmprosedur SET modified_by = '".$nama."', modified_date = NOW() WHERE prosedur_code = '$nomor'";
            mysqli_query($connect, $updateModify);

            while($dataImageLampiran = mysqli_fetch_array($selectDataLampiran)) {
                if(is_file("image/".$dataImageLampiran['foto'])) {
                    unlink("image/".$dataImageLampiran['foto']); 
                }
            }
        }

        $sqlUpdateFotoLampiran = "UPDATE hrdprosedurlampiran SET foto = '' WHERE foto NOT IN ($strLampiranFoto2) AND idProsedur = '$idGet' AND modified_by = '".$nama."'";
        mysqli_query($connect, $sqlUpdateFotoLampiran);
        $alert = 0;
    }

    $idLampiran = $_POST['idLampiran'];
    if(empty($idLampiran)) {
        $sqlCekAdaDataLampiran = "SELECT * FROM hrdprosedurlampiran WHERE idProsedur = '$idGet'";
        $cekAdaDataLampiran = mysqli_query($connect, $sqlCekAdaDataLampiran);

        $sqlUpdateModify = "UPDATE hrmprosedur SET modified_by = '".$nama."', modified_date = NOW() WHERE prosedur_code = '$nomor'";

        if(mysqli_num_rows($cekAdaDataLampiran) > 0) {
            $before = "idLampiran$encodeSystemLamaLampiran";
            $after = "empty";

            $sqlGetId = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomor'";
            $getId = mysqli_query($connect, $sqlGetId);
            $arrayId = mysqli_fetch_array($getId);
            $idProsedur = $arrayId['idProsedur'];

            $sqlInsertLog = "INSERT INTO hrdlogprosedur (emp_id, modified_date, idProsedur, sebelum, sesudah,aksi) VALUES ('".$username."', NOW(), '$idProsedur', '$before', '$after', 'delete')";
            mysqli_query($connect, $sqlInsertLog);

            mysqli_query($connect, $sqlUpdateModify);
            $sqlDeleteLampiran = "DELETE FROM hrdprosedurlampiran WHERE idProsedur = '$idGet'";
            mysqli_query($connect, $sqlDeleteLampiran);
            $alert = 0;
        }
    } else {
        $dataLampiran = count($_POST["idLampiran"]);
        for($m=0; $m<$dataLampiran; $m++) {
            // Data Lampiran di Database
            $uploadLampiranLama = $_POST['uploadLampiranLama'][$m];
            $uploadLampiranIsi = $_POST['uploadLampiranIsi'][$m];
            
            // Lampiran Post
            $idLampiranSystem = $_POST['idLampiranSystem'][$m];
            $idLampiran = $_POST['idLampiran'][$m];
            $lampiran = $_POST['lampiran'][$m];
            $timeLampiran = date("dmy").time();
            $uploadLampiran1 = $_FILES["uploadLampiran"]["name"][$m];

            if(empty($uploadLampiran1)) {
                $uploadLampiran = "";
            } else {
                $allowedLampiran = array('jpg','jpeg', 'png', '');
                $extLampiran = pathinfo($uploadLampiran1, PATHINFO_EXTENSION);

                if(!in_array($extLampiran, $allowedLampiran)) {
                    $uploadLampiran = "";
                } else {
                    $uploadLampiran = $timeLampiran.$uploadLampiran1;
                }
            }

            // Kebutuhan Lampiran
            $sqlGetId = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomor'";
            $getId = mysqli_query($connect, $sqlGetId);
            $arrayId = mysqli_fetch_array($getId);
            $idGet = $arrayId['idProsedur'];

            $sqlCekKet = "SELECT * FROM hrdprosedurlampiran WHERE lampiran_code = '$idLampiran' and idProsedur = '$idGet'";
            $cekKet = mysqli_query($connect, $sqlCekKet);

            // Validasi Lampiran
            $sqlBandingLampiran = "SELECT lampiran_code, deskripsi, foto,
            CONCAT(lampiran_code,'/', deskripsi, '/', foto) AS data_before,
            CONCAT(lampiran_code_after,'/', deskripsi_after, '/', foto_after) AS data_after
            FROM
            (
                SELECT
                lampiran_code,deskripsi,foto,
                case when '$idLampiran' = lampiran_code THEN lampiran_code ELSE '$idLampiran' END AS lampiran_code_after,
                case when '$lampiran' = deskripsi  THEN deskripsi ELSE '$lampiran' END AS deskripsi_after,
                case when '$uploadLampiran' = foto  THEN foto ELSE '$uploadLampiran' END AS foto_after
                FROM 
                hrdprosedurlampiran
                WHERE idLampiran ='$idLampiranSystem' AND idProsedur = '$idGet'
            )filterLampiran";

            $myDataLampiran =  mysqli_query($connect, $sqlBandingLampiran);
            $arrayDataLampiran = mysqli_fetch_array($myDataLampiran);

            // Query SQL
            $sqlUpdateLampiran = "UPDATE hrdprosedurlampiran SET modified_by = '".$nama."', lampiran_code = '$idLampiran', deskripsi = '$lampiran', modified_date = NOW() WHERE lampiran_code = '".$arrayDataLampiran['lampiran_code']."' and idProsedur = '$idGet'";

            $sqlInsertLampiran = "INSERT INTO hrdprosedurlampiran (lampiran_code, idProsedur, deskripsi, foto, created_date, created_by, modified_date, modified_by) VALUES ('$idLampiran', '$idGet', '$lampiran', '', NOW(), '".$nama."', NOW(), '".$nama."')";

            $sqlUpdateModify = "UPDATE hrmprosedur SET modified_by = '".$nama."', modified_date = NOW() WHERE prosedur_code = '$nomor'";

            // Mulai query

            if($idLampiran != $arrayDataLampiran['lampiran_code'] || $lampiran != $arrayDataLampiran['deskripsi'] || $uploadLampiran || $uploadLampiranIsi != $uploadLampiranLama) {
                
                    $before2 = "idLampiran-$idLampiranSystem/".$arrayDataLampiran['data_before']."";
                    $after2 = "idLampiran-$idLampiranSystem/".$arrayDataLampiran['data_after']."";

                    if($uploadLampiranIsi != $uploadLampiranLama) {
                        $before = "$before2$uploadLampiranLama";
                    } else {
                        $before = $before2;
                    }

                    if($uploadLampiranIsi && empty($uploadLampiran)) {
                        $after = "$after2$uploadLampiranIsi";
                    } else {
                        $after = $after2;
                    }

                    $sqlGetId = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomor'";
                    $getId = mysqli_query($connect, $sqlGetId);
                    $arrayId = mysqli_fetch_array($getId);
                    $idProsedur = $arrayId['idProsedur'];

                    $sqlInsertLog = "INSERT INTO hrdlogprosedur (emp_id, modified_date, idProsedur, sebelum, sesudah, aksi) VALUES ('".$username."', NOW(), '$idProsedur', '$before', '$after', 'Update')";

                    $allowedLampiran = array('jpg','jpeg', 'png', '');
                    $extLampiran = pathinfo($uploadLampiran, PATHINFO_EXTENSION);
                    
                    if($idLampiran == $arrayDataLampiran['lampiran_code']) {
                        $alert = 0;
                        mysqli_query($connect, $sqlInsertLog);
                        mysqli_query($connect, $sqlUpdateModify);
                        mysqli_query($connect, $sqlUpdateLampiran);

                        if($uploadLampiran) {
                            if(!in_array($extLampiran, $allowedLampiran)) {
                                echo '<script>alert("Format file upload lampiran hanya jpg, jpeg, png"); </script>';
                            } else {
                                $tempLampiran = $_FILES["uploadLampiran"]["tmp_name"][$m];
                                $folderLampiran = "image/".$uploadLampiran;
            
                                $sqlLampiran = "UPDATE hrdprosedurlampiran SET modified_by = '".$nama."', foto = '$uploadLampiran' WHERE lampiran_code = '$idLampiran' and idProsedur = '$idProsedur'";
            
                                if(is_file("image/".$uploadLampiranIsi)) {
                                    unlink("image/".$uploadLampiranIsi); 
                                }
            
                                compressImage($tempLampiran, $folderLampiran, 20);
                                mysqli_query($connect, $sqlLampiran);
                                $alert = 0;
                            }
                        }

                    }

                    if(mysqli_num_rows($cekKet) == 0 && $idLampiran != $arrayDataLampiran['lampiran_code'] && $idLampiranSystem) {
                        $alert = 0;
                        mysqli_query($connect, $sqlInsertLog);
                        mysqli_query($connect, $sqlUpdateModify);
                        mysqli_query($connect, $sqlUpdateLampiran);

                        if($uploadLampiran) {
                            if(!in_array($extLampiran, $allowedLampiran)) {
                                echo '<script>alert("Format file upload lampiran hanya jpg, jpeg, png"); </script>';
                            } else {
                                $tempLampiran = $_FILES["uploadLampiran"]["tmp_name"][$m];
                                $folderLampiran = "image/".$uploadLampiran;
            
                                $sqlLampiran = "UPDATE hrdprosedurlampiran SET modified_by = '".$nama."', foto = '$uploadLampiran' WHERE lampiran_code = '$idLampiran' and idProsedur = '$idProsedur'";
            
                                if(is_file("image/".$uploadLampiranIsi)) {
                                    unlink("image/".$uploadLampiranIsi); 
                                }
            
                                compressImage($tempLampiran, $folderLampiran, 20);
                                mysqli_query($connect, $sqlLampiran);
                                $alert = 0;
                            }
                        }

                    }

                    if(mysqli_num_rows($cekKet) == 0 && empty($idLampiranSystem)) {
                        $alert = 0;
                        mysqli_query($connect, $sqlUpdateModify);
                        mysqli_query($connect, $sqlInsertLampiran);

                        $sqlGetMaxIdLampiran = "SELECT MAX(idLampiran) FROM hrdprosedurlampiran WHERE idProsedur = '$idGet'";
                        $getMaxIdLampiran = mysqli_query($connect, $sqlGetMaxIdLampiran);
                        $arrayMaxIdLampiran = mysqli_fetch_array($getMaxIdLampiran);
                        $maxIdLampiran = $arrayMaxIdLampiran['MAX(idLampiran)'];
                        
                        $beforeInsert = "";
                        $afterInsert = "idLampiran-$maxIdLampiran/$idLampiran/$lampiran/$uploadLampiran";

                        $sqlGetId = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomor'";
                        $getId = mysqli_query($connect, $sqlGetId);
                        $arrayId = mysqli_fetch_array($getId);
                        $idProsedur = $arrayId['idProsedur'];

                        $sqlInsertLog2 = "INSERT INTO hrdlogprosedur (emp_id, modified_date, idProsedur, sebelum, sesudah,aksi) VALUES ('".$username."', NOW(), '$idProsedur', '$beforeInsert', '$afterInsert', 'insert')";
                        mysqli_query($connect, $sqlInsertLog2);

                        if($uploadLampiran) {
                            if(!in_array($extLampiran, $allowedLampiran)) {
                                echo '<script>alert("Format file upload lampiran hanya jpg, jpeg, png"); </script>';
                            } else {
                                $tempLampiran = $_FILES["uploadLampiran"]["tmp_name"][$m];
                                $folderLampiran = "image/".$uploadLampiran;
            
                                $sqlLampiran = "UPDATE hrdprosedurlampiran SET modified_by = '".$nama."', foto = '$uploadLampiran' WHERE lampiran_code = '$idLampiran' and idProsedur = '$idProsedur'";
            
                                if(is_file("image/".$uploadLampiranIsi)) {
                                    unlink("image/".$uploadLampiranIsi); 
                                }
            
                                compressImage($tempLampiran, $folderLampiran, 20);
                                mysqli_query($connect, $sqlLampiran);
                                $alert = 0;
                            }
                        }
                    }
            }

        }

    }

    // insert All
    $sqlCek2 = "SELECT * FROM hrmprosedur WHERE prosedur_code = '$nomor'";
    $cek2 = mysqli_query($connect, $sqlCek2);
    $arrayMasukin = mysqli_fetch_array($cek2);
    $po = $arrayMasukin['idProsedur'];

    // dadax
    if($alert == "0") {
        echo '<script>alert("Data berhasil disimpan");
        document.location="edit.php?id='.$po.'"; </script>';
    } else {
        echo '<script>alert("Data gagal disimpan");
        document.location="edit.php?id='.$po.'"; </script>';
    }

}
?>

<div class="col-md-12">
<div class="card">
<div class="card-header d-flex align-items-center">
<h4 class="card-title mb-0" style = "padding : 20px">Edit SOP</h4>
<div class="card-actions ml-auto">
</div>
</div>

<div class="card-body table-responsive p-0" style="width: 100vw;height: 78vh; width: 98%; margin: 5px; overflow: scroll;">
<!-- Isi -->

    <form action="edit.php" method="post" name="form_kategori" id="form_kategori" enctype="multipart/form-data" autocomplete = "off" style = "margin-left : 50px; margin-right : 50px; margin-top : 20px">
        <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nomor Prosedur</label>
                <div class="col-sm-10">
                    <input type="hidden" name="nomordata" class="form-control" size="4" placeholder = "PRM-HR-XX-XX" value = "<?php echo $prosedur_code?>">
                    <input type="text" name="nomor" class="form-control" size="4" placeholder = "PRM-HR-XX-XX" value = "<?php echo $prosedur_code?>" required>

                    <input type="hidden" name="namaProsedurLama" class="form-control" size="4" placeholder = "PRM-HR-XX-XX" value = "<?php echo $namaProsedur?>">
                    <input type="hidden" name="pemilikLama" class="form-control" size="4" placeholder = "PRM-HR-XX-XX" value = "<?php echo $pemilik?>">
                    <input type="hidden" name="terbitLama" class="form-control" size="4" placeholder = "PRM-HR-XX-XX" value = "<?php echo $tanggalTerbit?>">
                    <input type="hidden" name="berlakuLama" class="form-control" size="4" placeholder = "PRM-HR-XX-XX" value = "<?php echo $tanggalBerlaku?>">
                    <input type="hidden" name="ajuLama" class="form-control" size="4" placeholder = "PRM-HR-XX-XX" value = "<?php echo $diajukanOleh?>">
                </div>
        </div>

        <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Prosedur</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama" class="form-control" size="4" value = "<?php echo $namaProsedur?>" required>
                    </div>
        </div>

        <div class="form-group row">
                <label class="col-sm-2 col-form-label">Pemilik</label>
                <div class="col-sm-10">
                    <input type="text" name="pemilik" class="form-control" value = "<?php echo $pemilik?>" size="4">
                </div>
        </div>

        <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tanggal Terbit</label>
                    <div class="col-sm-10">
                        <input type="date" name="terbit" class="form-control" size="4" value = "<?php echo $tanggalTerbit?>" placeholder = "XXXX-XX-XX">
                    </div>
        </div>

        <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tanggal Berlaku</label>
                <div class="col-sm-10">
                    <input type="date" name="berlaku" class="form-control" size="4" value = "<?php echo $tanggalBerlaku?>" placeholder = "XXXX-XX-XX">
                </div>
        </div>

        <div class="form-group row">
                <label class="col-sm-2 col-form-label">Diajukan Oleh</label>
                <div class="col-sm-10">
                    <input type="text" name="diajukan" class="form-control" value = "<?php echo $diajukanOleh?>" size="4">
                </div>
        </div>

        <input type="hidden" name="kamus" placeholder="kamus" class="form-control kategori_field" style = "margin-right : 5px">

        <label class="col-sm-2 col-form-label"><b style = "font-size : 20px">Definition</b></label>
        <?php
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $sqlDataDef = "SELECT * FROM hrdprosedurdef WHERE idProsedur = '$id'";
                $dataDef = mysqli_query($connect, $sqlDataDef);

                while($arrayDef = mysqli_fetch_array($dataDef)) {
                    echo '<input type = "hidden" name = "defDataArray[]" value = "'.$arrayDef['definition_code'].'">';
                    echo '<input type = "hidden" name = "defOld[]" value = "'.$arrayDef['idDefinition'].'">';
                }
            }
        ?>

        <table id="dynamic_form" style = "margin-bottom : 10px" class = "table table-striped table-hover table-bordered">
                <tr style = "background-color : #54d692; font-weight : bold; color : black">
                    <td style = "width : 100px">ID</td>
                    <td style = "width : 250px">Kamus</td>
                    <td style = "width : 700px">Definition</td>
                    <td><button type="button" name="tambah" id="tambah" class="btn btn-warning defNoData"><b>Tambah</b></button></td>
                </tr>

                <?php
                    if(isset($_GET['id'])){
                        $id = $_GET['id'];
                        $sqlDef = "SELECT * FROM hrdprosedurdef WHERE idProsedur = '$id'";
                        $def = mysqli_query($connect, $sqlDef);

                        if(mysqli_num_rows($def) > 0) {
                            for ($i=0; $i < mysqli_num_rows($def); $i++) {
                                $data = mysqli_fetch_array($def);
                                echo'
                                <tr id = "pok'.$i.'">

                                <input type="hidden" name="idDefLama[]" value = "'.$data['definition_code'].'" class="form-control kategori_field" style = "margin-right : 5px" />
                                <input type="hidden" name="kamusLama[]" value = "'.$data['kamus'].'" class="form-control kategori_field" style = "margin-right : 5px" />
                                <input type="hidden" name="defLama[]" value = "'.$data['definisi'].'" class="form-control kategori_field" style = "margin-right : 5px" />

                                <td> <input type="text" name="idDefinition[]" value = "'.$data['definition_code'].'" placeholder="ID" class="form-control kategori_field" style = "margin-right : 5px"/> 
                                <input type="hidden" name="idDefSystem[]" value = "'.$data['idDefinition'].'" class="form-control kategori_field" style = "margin-right : 5px"/></td>
                                <td> <input type="text" name="kamus[]" value = "'.$data['kamus'].'" placeholder="Kamus" class="form-control kategori_field" style = "margin-right : 5px" /> </td>
                                <td>
                                <textarea rows="4" cols="60" name="definition[]" style="text-align : left" class="form-control kategori_field">'.$data['definisi'].'</textarea>
                                </td>
                                <td> <button type="button" name="tambah" class="btn btn-danger btn_remove gp" id = "'.$i.'">Hapus</button> </td>
                                </tr>
                                ';
                            }
                        } else {
                            echo '<tr id = "definisiNoData"><td colspan = "5" style = "background-color : #F0FFF0">';
                            echo 'No Data';
                            echo '</tr></td>';
                        }
                }
                ?>

            <script>
                $(document).on('click', '.defNoData', function(){  
                    $('#definisiNoData').remove();  
                }); 
            </script>

            </table>

            <label class="col-sm-2 col-form-label"><b style = "font-size : 20px">List Proccess</b></label>

            <?php
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $sqlDataList = "SELECT * FROM hrdprosedurlist WHERE idProsedur = '$id'";
                    $dataList = mysqli_query($connect, $sqlDataList);

                    while($arrayList = mysqli_fetch_array($dataList)) {
                        echo '<input type = "hidden" name = listDataArray[] value = "'.$arrayList['list_code'].'">';
                        echo '<input type = "hidden" name = listOld[] value = "'.$arrayList['idList'].'">';
                    }
                }
            ?>

            <table id="list_form" style = "margin-bottom : 10px" class="table table-striped table-hover table-bordered">
                <tr style = "background-color : #54d692; font-weight : bold; color : black">
                    <td style = "width : 70px">No</td>
                    <td style = "width : 300px">Business Process</td>
                    <td style = "width : 200px">Person In Charge</td>
                    <td style = "width : 300px">Description</td>
                    <td style = "width : 130px"> Type of Process </td>
                    <td style = "text-align : center; width : 100px"><button type="button" name="tambahList" id="tambahList" class="btn btn-warning hapusListNoData"><b>Tambah</b></button></td>
                </tr>

                <!-- Hidden data proses -->
                <input type="hidden" name="proses" placeholder="No Business Process" class="form-control kategori_field" style = "margin-right : 5px" />

                <?php
                    if(isset($_GET['id'])){
                            $id = $_GET['id'];
                            $sqlList = "SELECT * FROM hrdprosedurlist WHERE idProsedur = '$id'";
                            $list = mysqli_query($connect, $sqlList);

                            if(mysqli_num_rows($list) > 0) {
                                for ($i=0; $i < mysqli_num_rows($list); $i++) {
                                    $data = mysqli_fetch_array($list);
                                    echo'
                                    <tr id = "list'.$i.'">

                                    <input type="hidden" name="idListLama[]" value = "'.$data['list_code'].'" placeholder="No Business Process" class="form-control kategori_field" style = "margin-right : 5px" />
                                    <input type="hidden" name="prosesLama[]" placeholder="Business Process" value = "'.$data['businessProcess'].'" class="form-control kategori_field" style = "margin-right : 5px" />
                                    <input type="hidden" name="picLama[]" placeholder="Person In Charge" value = "'.$data['pic'].'" class="form-control kategori_field" style = "margin-right : 5px" />
                                    <input type="hidden" name="descLama[]" placeholder="Description" value = "'.$data['description'].'" class="form-control kategori_field" style = "margin-right : 5px" />
                                    <input type = "hidden" name = "tipeProsesLama[]" class="form-control kategori_field" value = "'.$data['tipeProses'].'">';?>

                                    <?php echo'
                                    <td style = "text-align : center"><input type="hidden" name="idListSystem[]" value = "'.$data['idList'].'" placeholder="No Business Process" class="form-control kategori_field" style = "margin-right : 5px" /><input type="text" name="idList[]" value = "'.$data['list_code'].'" placeholder="No" class="form-control kategori_field" style = "margin-right : 5px" /></td>
                                    <td> <input type="text" name="proses[]" placeholder="Business Process" value = "'.$data['businessProcess'].'" class="form-control kategori_field" style = "margin-right : 5px" /> </td>
                                    <td> <input type="text" name="pic[]" placeholder="Person In Charge" value = "'.$data['pic'].'" class="form-control kategori_field" style = "margin-right : 5px" /> </td>
                                    <td><textarea rows="5" cols="60" name="desc[]" placeholder="Description" class="form-control kategori_field">'.$data['description'].'</textarea></td>
                                    <td>';?>

                                    <select name = "tipeProses[]" class="form-control kategori_field">
                                    <option value = "Manual" <?php if($data['tipeProses']==='Manual') echo 'selected="selected"';?>>Manual</option>
                                    <option value = "System" <?php if($data['tipeProses']==='System') echo 'selected="selected"';?>>System</option>
                                    </select>

                                    <?php echo'
                                    </td>
                                    <td style = "text-align : center"> <button type="button" name="tambah" class="btn btn-danger btn_remove lt" id = "'.$i.'">Hapus</button> </td>
                                    </tr>
                                    ';
                                }
                            } else {
                                echo '<tr id = "listNoData"><td colspan = "6" style = "background-color : #F0FFF0">';
                                echo 'No Data';
                                echo '</tr></td>';
                            }
                    }
                ?>
            </table>

            <script>
                $(document).on('click', '.hapusListNoData', function(){  
                    $('#listNoData').remove();  
                }); 
            </script>
            
<!-- uploadBp Data -->
            <div class="form-group row" style = "width : 1500px; margin-top : 20px">
                    <div class="col-sm-10" style = "line-height :30px">

                    <?php
                    if(isset($_GET['id'])){
                        $id = $_GET['id'];
                        $sqlOrder = "SELECT * FROM hrdprosedurupload WHERE idProsedur = '$id' ORDER BY bpOrder ASC";
                        $order = mysqli_query($connect, $sqlOrder);

                        while($orderData = mysqli_fetch_array($order)){
                            echo'
                                <input type = "hidden" name = "bpOrderData[]" value = "'.$orderData['bpOrder'].'">
                            ';
                        }
                    }
                    ?>

                    <input type = "hidden" name = "uploadBpData" placeholder = "uploadBpData">
                    <input type = "hidden" name = "uploadBpSystem" placeholder = "uploadBpSystem">
                    <input type = "hidden" name = "idUploadData" placeholder = "uploadBpSystem">

                    <?php
                    if(isset($_GET['id'])){
                        $id = $_GET['id'];
                        $sqlIdUpload = "SELECT * FROM hrdprosedurupload WHERE idProsedur = '$id' ORDER BY bpOrder ASC";
                        $idUpload = mysqli_query($connect, $sqlIdUpload);
                        
                        while ($data = mysqli_fetch_array($idUpload)) {
                            echo '<input type = "hidden" value = "'.$data['idUpload'].'" name = "idUploadData[]">';
                        }
                    }
                    
                    ?>

                    <table class="table table-striped table-hover table-sm table-bordered" style = "width : 700px" id = "bp_form">
                        <tr style = "background-color : #54d692; font-weight : bold; color : black">
                            <td style = "text-align : center"><b>Upload Business Picture</b></td>
                            <td style = "text-align : center"><b>File</b></td>
                            <td style = "text-align : center"><b>Order</b></td>
                            <td><button type="button" name="tambahUploadBp" id="tambahUploadBp" class="btn btn-warning"><b>+</b></button></td>
                        </tr>

                        <?php
                             if(isset($_GET['id'])){
                                $id = $_GET['id'];
                                $sqlBP = "SELECT * FROM hrdprosedurupload WHERE idProsedur = '$id' ORDER BY bpOrder ASC";
                                $BP = mysqli_query($connect, $sqlBP);
                                
                                if(mysqli_num_rows($BP) == 0) {
                                    ?>
                                    <tr>
                                        <td>
                                        <input type = "hidden" placeholder = "uploadBpdata" name = "uploadBpData[]" readonly>
                                        <input type="file" name="uploadBP[]" style = "width : 280px">
                                        </td>

                                        <td>
                                        <b> No File Uploaded </b>
                                        </td>
                                        
                                        <td>
                                        <select name = "orderUploadBP[]">
                                            <?php
                                            for($o=1; $o<100; $o++) {
                                                ?>
                                                    <option value = "<?php echo $o;?>" <?php if($data['bpOrder']===''.$o.'') echo 'selected="selected"';?>> <?php
                                                    echo $o;
                                                    ?> </option>
                                                <?php
                                            }
                                            ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <?php
                                } else {
                                    for($i=0; $i<mysqli_num_rows($BP); $i++) {
                                        ?>
                                            <?php
                                            $data = mysqli_fetch_array($BP);
                                            echo'
                                            <tr id = "uploadBp'.$i.'">
                                            <td>
                                            <input type="hidden" name="uploadBpSystem[]" style = "width : 280px" value = "'.$data['idUpload'].'">
                                            <input type="file" name="uploadBP[]" style = "width : 280px"> <br>
                                            </td>

                                            <td id = "hapusRowImg">
                                            <input type = "text" name = "uploadBpData[]" id = "entry" style = "border : none; outline : none" value = "'.$data['businessPicture'].'" readonly>
                                            </td>

                                            <td>
                                            <input type = "hidden" name = "dataOrder[]" value = "'.$data['bpOrder'].'"">
                                            ';?>
                                            <select name = "orderUploadBP[]">
                                            <?php
                                            for($o=1; $o<100; $o++) {
                                                ?>
                                                    <option value = "<?php echo $o;?>" <?php if($data['bpOrder']===''.$o.'') echo 'selected="selected"';?>> <?php
                                                    echo $o;
                                                    ?> </option>
                                                <?php
                                            }
                                            ?>
                                            </select>

                                            <?php
                                            echo'
                                            </td>

                                            <td>
                                            <button type="button" name="tambah" class="btn btn-danger btn_remove bp" id = "'.$i.'">-</button>
                                            </td>

                                            </tr>
                                            ';
                                            ?>
                                        <?php
                                    }

                                }
                                
                            }
                        ?>
                    </table>
                              
                        <div style = "font-size : 18px;">
                        </div>
                    </div>
            </div>

<!-- upload BpDoc -->
            <div class="form-group row" style = "width : 1500px; margin-top : 20px">
                    <label class="col-sm-2 col-form-label" style = "background-color : #54d692; color : black"><b>Upload Business Process Doc</b></label>
                    <div class="col-sm-10" style = "line-height :30px">
                        <div style = "font-size : 18px;">
                        <?php
                            
                            if(isset($_GET['id'])){
                                $id = $_GET['id'];
                                $sqlBP = "SELECT * FROM hrdprosedurdoc WHERE idProsedur = '$id'";
                                $BP = mysqli_query($connect, $sqlBP);
                                $arrayBP = mysqli_fetch_array($BP);
                                $getBPD = $arrayBP['businessPictureDoc'];
                            }

                        ?>
                        <input type = "hidden" name = "uploadBpDoc" readonly>
                            <table>
                                <tr>
                                    <td><input type="file" name="uploadBPD" style = "width : 272px"></td>
                                    <td id = "hapusRowDoc">
                                    <?php
                                    if(isset($_GET['id'])){
                                        $id = $_GET['id'];
                                        $sqlGetDoc = "SELECT * FROM hrdprosedurdoc WHERE idProsedur = '$id'";
                                        $getDoc = mysqli_query($connect, $sqlGetDoc);
                                        $arrayDoc = mysqli_fetch_array($getDoc);
                                        $getBPD = $arrayDoc['businessPictureDoc'];
                                    }
                                    ?>
                                    <input type = "text" name = "uploadBpDoc" id = "entry1" style = "border : none; outline : none" value = "<?php echo $getBPD?>" readonly>
                                        <?php
                                            
                                            if(isset($_GET['id'])){
                                                $id = $_GET['id'];
                                                $sqlCheckBpd = "SELECT * FROM hrdprosedurdoc WHERE idProsedur = '$id'";
                                                $checkBpd = mysqli_query($connect, $sqlCheckBpd);
                                            }

                                            if(mysqli_num_rows($checkBpd) == 0) {
                                                echo '<b>';
                                                echo'No file uploaded';
                                                echo '</b>';
                                            } else {
                                                ?>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class = "trashDoc" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                    </svg>

                                                    <?php
                                                    if(isset($_GET['id'])){
                                                        $id = $_GET['id'];
                                                    }

                                                    $sqlGetData = "SELECT * FROM hrdprosedurdoc where idProsedur = '$id'";
                                                    $getData = mysqli_query($connect, $sqlGetData);
                                                    $arrayGetData = mysqli_fetch_array($getData);
                                                    $data = $arrayGetData['businessPictureDoc'];
                                                    echo '
                                                    <a href="image/'.$data.'">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                                        </svg>
                                                    </a>
                                                    ';
                                                        

                                                    ?>

                                                <?php
                                            }
                                        ?>

                                        <script>
                                        var input = document.getElementById("entry1");
                                        input.oninput = resizeInput;
                                        resizeInput.call(input);

                                        function resizeInput() {
                                            this.style.width = this.value.length + "ch";
                                        }
                                        </script>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
            </div>

<!-- ketentuan -->
            <input type="hidden" name="idKetentuan" placeholder="idketentuan" class="form-control kategori_field" style = "margin-right : 5px">
            <input type="hidden" name="uploadKetentuanIsi" placeholder="uploadKetentuanIsi" class="form-control kategori_field" style = "margin-right : 5px">

            <label class="col-sm-2 col-form-label"><b style = "font-size : 20px">Ketentuan</b></label>

            <table id="ketentuan_form" style = "margin-bottom : 10px" class="table table-striped table-hover table-bordered">
                <tr style = "background-color : #54d692; font-weight : bold; color : black">
                    <td style = "width : 100px">ID</td>
                    <td style = "width : 1050px">Deskripsi</td>
                    <td style = "text-align : center; padding-left : 60px; padding-right : 60px" colspan="2"> <button type="button" name="tambahKetentuan" id="tambahKetentuan" class="btn btn-warning hapusNoData"><b>Tambah</b></button></td>
                    <td style = "text-align : center">View</td>
                </tr>

                <?php
                    if(isset($_GET['id'])){
                        $id = $_GET['id'];
                        $sqlKetentuan = "SELECT * FROM hrdprosedurketentuan WHERE idProsedur = '$id'";
                        $ketentuan = mysqli_query($connect, $sqlKetentuan);

                        if(mysqli_num_rows($ketentuan) > 0) {
                            for ($i=0; $i < mysqli_num_rows($ketentuan); $i++) {
                                $data = mysqli_fetch_array($ketentuan);
                                echo'
                                <input type="hidden" name="idKetentuanSystemLama[]" value = "'.$data['idKetentuan'].'" placeholder="No Business Process" class="form-control kategori_field" style = "margin-right : 5px" />
                                <input type="hidden" name="uploadLama[]" value = "'.$data['foto'].'" class="form-control kategori_field" style = "margin-right : 5px" />
                                
                                <tr id = "ketentuan'.$i.'">
                                <td><input type="hidden" name="idKetentuanSystem[]" placeholder="Id Ketentuan" value = "'.$data['idKetentuan'].'" class="form-control kategori_field" style = "margin-right : 5px" /><input type="text" name="idKetentuan[]" placeholder="ID" value = "'.$data['ketentuan_code'].'" class="form-control kategori_field" style = "margin-right : 5px" required/></td>
                                <td><textarea rows="3" cols="60" name="ketentuan[]" placeholder="Deskripsi" class="form-control kategori_field">'.$data['deskripsi'].'</textarea></td>
                                <td style = "text-align : center"><button type="button" name="tambah" class="btn btn-danger btn_remove kt" id = "'.$i.'">Hapus</button></td>
                                <td style = "text-align : center; width : 50px"><input type="file" name="uploadKetentuan[]" style = "margin-top : 5px; width : 100px"></td>

                                <td id = "hapusRowKet'.$i.'" style = "padding-top : 17px; text-align : center">';?>
                                
                                <?php 

                                if(empty($data['foto'])) {

                                } else {
                                    echo '
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16" data-toggle="modal" data-target="#modalKetentuan'.$i.'">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                    </svg>';
                                    ?>
                                    <!-- Modal -->
                                            <div class="modal fade" id="modalKetentuan<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        <!-- Modal Title -->
                                                        <?php
                                                        echo $data['foto'];
                                                        ?>
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Modal Body -->
                                                    <?php
                                                            echo '<img src = "image/'.$data['foto'].'" style = "width : 460px">';
                                                        ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                    
                                    <?php echo'
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="trashKet" id = "'.$i.'" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                    ';
                                }

                                echo'
                                <input type="hidden" name="uploadKetentuanIsi[]" placeholder="" value = "'.$data['foto'].'" class="form-control kategori_field" style = "margin-right : 5px" />
                                </td>
                                </tr>
                                ';
                            }
                        } else {
                            echo '<tr id = "ketentuanNoData"><td colspan = "5" style = "background-color : #F0FFF0">';
                            echo 'No Data';
                            echo '</tr></td>';
                        }
                }
                ?>
                

            </table>

            <script>
                $(document).on('click', '.trashKet', function(){  
                    var button_id = $(this).attr("id");
                    document.getElementById('hapusRowKet'+button_id+'').innerHTML = "<td><input type = 'hidden' name = 'uploadKetentuanIsi[]'></td>";
                }); 

                $(document).on('click', '.hapusNoData', function(){  
                    $('#ketentuanNoData').remove();  
                }); 
            </script>

<!-- keterangan -->
            <input type="hidden" name="idKeterangan" placeholder="hidden idKeterangan" style = "margin-right : 5px" /> 
            <input type="hidden" name="uploadKeteranganIsi" placeholder="hidden uploadKeteranganIsi" style = "margin-right : 5px" /> 

            <label class="col-sm-2 col-form-label"><b style = "font-size : 20px">Keterangan</b></label>

            <table id="keterangan_form" style = "margin-bottom : 10px" class="table table-striped table-hover table-bordered">
                <tr style = "background-color : #54d692; font-weight : bold; color : black">
                    <td style = "width : 100px">ID</td>
                    <td style = "width : 1050px">Deskripsi</td>
                    <td colspan = "2" style = "text-align : center; padding-left : 60px; padding-right : 60px"> <button type="button" name="tambahKeterangan" id="tambahKeterangan" class="btn btn-warning hapusNoDataKeterangan"><b>Tambah</b></button> </td>
                    <td style = "text-align : center">View</td>
                </tr>

                <?php
                    if(isset($_GET['id'])){
                            $id = $_GET['id'];
                            $sqlKeterangan = "SELECT * FROM hrdprosedurketerangan WHERE idProsedur = '$id'";
                            $keterangan = mysqli_query($connect, $sqlKeterangan);

                            if(mysqli_num_rows($keterangan) > 0) {
                                for ($i=0; $i < mysqli_num_rows($keterangan); $i++) {
                                    $data = mysqli_fetch_array($keterangan);
                                    echo'
                                    <input type="hidden" name="idKeteranganSystemLama[]" value = "'.$data['idKeterangan'].'" placeholder="No Business Process" class="form-control kategori_field" style = "margin-right : 5px" />
                                    <input type="hidden" name="uploadKeteranganLama[]" class="form-control kategori_field" value = "'.$data['foto'].'" readonly>

                                    <tr id = "keterangan'.$i.'">
                                    <td><input type="hidden" name="idKeteranganSystem[]" placeholder="Id Keterangan" value = "'.$data['idKeterangan'].'" class="form-control kategori_field" style = "margin-right : 5px" /><input type="text" value = "'.$data['keterangan_code'].'" name="idKeterangan[]" placeholder="ID" class="form-control kategori_field" style = "margin-right : 5px" required /></td>
                                    <td><textarea rows="3" cols="60" name="keterangan[]" placeholder="Deskripsi" class="form-control kategori_field">'.$data['deskripsi'].'</textarea></td>
                                    <td style = "text-align : center">
                                    <button type="button" name="tambah" class="btn btn-danger btn_remove ktn" id = "'.$i.'">Hapus</button></td>
                                    <td style = "text-align : center; width : 50px"><input type="file" name="uploadKeterangan[]" style = "margin-top : 5px; width : 100px">
                                    </td>

                                    <td id = "hapusRowKeterangan'.$i.'" style = "padding-top : 17px; text-align : center">';?>
                                    
                                    <?php
                                        if(empty($data['foto'])) {

                                        } else {
                                            echo '
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16" data-toggle="modal" data-target="#modalKeterangan'.$i.'">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                            </svg>
                                            
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="trashKeterangan" id = "'.$i.'" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                            </svg>';
                                        }
                                    ?>
                                <!-- Modal -->
                                    <div class="modal fade" id="modalKeterangan<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            <!-- Modal Title -->
                                                            <?php
                                                            echo $data['foto'];
                                                            ?>
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Modal Body -->
                                                        <?php
                                                                echo '<img src = "image/'.$data['foto'].'" style = "width : 460px">';
                                                            ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                    </div>
                                                </div>
                                                </div>

                                    <?php echo'
                                    <input type="hidden" name="uploadKeteranganIsi[]" class="form-control kategori_field" value = "'.$data['foto'].'" readonly>
                                    </td>
                                    </tr>
                                    '; 
                                }
                            } else {
                                echo '<tr id = "keteranganNoData"><td colspan = "5" style = "background-color : #F0FFF0">';
                                echo 'No Data';
                                echo '</tr></td>';
                            }
                    }
                ?>
            </table>

            <script>
                $(document).on('click', '.trashKeterangan', function(){  
                    var button_id = $(this).attr("id");
                    document.getElementById('hapusRowKeterangan'+button_id+'').innerHTML = "<td><input type = 'hidden' name = 'uploadKeteranganIsi[]'></td>";
                }); 

                $(document).on('click', '.hapusNoDataKeterangan', function(){  
                    $('#keteranganNoData').remove();  
                }); 
            </script>

<!-- Lampiran -->

            <input type="hidden" name="idLampiran" placeholder="idLampiran" style = "margin-right : 5px"/> 
            <input type="hidden" name="uploadLampiranIsi" placeholder="uploadLampiranIsi" style = "margin-right : 5px" /> 

            <label class="col-sm-2 col-form-label"><b style = "font-size : 20px">Lampiran</b></label>

            <table id="lampiran_form" style = "margin-bottom : 10px" class = "table table-striped table-hover table-bordered">
                <tr style = "background-color : #54d692; font-weight : bold; color : black">
                    <td style = "width : 100px">ID</td>
                    <td style = "width : 1050px">Deskripsi</td>
                    <td colspan = "2" style = "text-align : center; padding-left : 60px; padding-right : 60px"> <button type="button" name="tambahLampiran" id="tambahLampiran" class="btn btn-warning lampNoData"><b>Tambah</b></button> </td>
                    <td style = "text-align : center">View</td>
                </tr>

                <?php
                    if(isset($_GET['id'])){
                            $id = $_GET['id'];
                            $sqlLampiran = "SELECT * FROM hrdprosedurlampiran WHERE idProsedur = '$id'";
                            $lampiran = mysqli_query($connect, $sqlLampiran);

                            if(mysqli_num_rows($lampiran) > 0) {
                                for ($i=0; $i < mysqli_num_rows($lampiran); $i++) {
                                    $data = mysqli_fetch_array($lampiran);
                                    echo'
                                    <input type="hidden" name="idLampiranSystemLama[]" value = "'.$data['idLampiran'].'" placeholder="No Business Process" class="form-control kategori_field" style = "margin-right : 5px" />
                                    <input type="hidden" name="uploadLampiranLama[]" class="form-control kategori_field" value = "'.$data['foto'].'" readonly>

                                    <tr id = "lampiran'.$i.'">
                                    <td><input type="hidden" name="idLampiranSystem[]" placeholder="Id Lampiran" value = "'.$data['idLampiran'].'" class="form-control kategori_field" style = "margin-right : 5px" /><input type="text" value = "'.$data['lampiran_code'].'" name="idLampiran[]" placeholder="ID" class="form-control kategori_field" style = "margin-right : 5px" required /></td>
                                    <td><textarea rows="3" cols="60" name="lampiran[]" placeholder="Deskripsi" class="form-control kategori_field">'.$data['deskripsi'].'</textarea></td>
                                    <td style = "text-align : center">
                                    <button type="button" name="tambah" class="btn btn-danger btn_remove lp" id = "'.$i.'">Hapus</button></td>
                                    <td style = "text-align : center; width : 50px"><input type="file" name="uploadLampiran[]" style = "margin-top : 5px; width : 100px">
                                    </td>

                                    <td id = "hapusRowLampiran'.$i.'" style = "padding-top : 17px; text-align : center">';?>
                                    
                                    <?php
                                        if(empty($data['foto'])) {

                                        } else {
                                            echo '
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16" data-toggle="modal" data-target="#modalLampiran'.$i.'">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                            </svg>
                                            
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="trashLampiran" id = "'.$i.'" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                            </svg>';
                                        }
                                    ?>
                                <!-- Modal -->
                                    <div class="modal fade" id="modalLampiran<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            <!-- Modal Title -->
                                                            <?php
                                                            echo $data['foto'];
                                                            ?>
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Modal Body -->
                                                        <?php
                                                                echo '<img src = "image/'.$data['foto'].'" style = "width : 460px">';
                                                            ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                    </div>
                                                </div>
                                                </div>

                                    <?php echo'
                                    <input type="hidden" name="uploadLampiranIsi[]" class="form-control kategori_field" value = "'.$data['foto'].'" readonly>
                                    </td>
                                    </tr>
                                    '; 
                                }
                            } else {
                                echo '<tr id = "lampiranNoData"><td colspan = "5" style = "background-color : #F0FFF0">';
                                echo 'No Data';
                                echo '</tr></td>';
                            }
                    }
                ?>
            </table>

            <script>
                $(document).on('click', '.trashLampiran', function(){  
                    var button_id = $(this).attr("id");
                    document.getElementById('hapusRowLampiran'+button_id+'').innerHTML = "<td><input type = 'hidden' name = 'uploadLampiranIsi[]'></td>";
                }); 

                $(document).on('click', '.lampNoData', function(){  
                    $('#lampiranNoData').remove();  
                }); 
            </script>
            
            <div style = "padding : 5px; margin-bottom : 20px; margin-top : 20px">
                <a href = "index.php">
                <input type = "button" class="btn btn-primary text-black" value="Back" style = "width : 80px; height : 40px"/>
                </a>
                <input type="submit" name="simpan" id="submit" class="btn btn-primary text-black" style = "width : 80px; height : 40px" value="Submit"/>
            </div>
            
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>

<script>  
		$(document).ready(function(){  
			var i=1; 
			$('#tambah').click(function(){  
				i++;  
				$('#dynamic_form').append('<tr id="row'+i+'"><td> <input type="hidden" name="idDefLama[]" class="form-control kategori_field" style = "width : 5px"> <input type="text" name="idDefinition[]" placeholder="ID" class="form-control kategori_field" style = "margin-right : 5px" required /> </td><td> <input type="text" name="kamus[]" placeholder="Kamus" class="form-control kategori_field" style = "margin-right : 5px" /> </td><td><textarea rows="4" cols="60" name="definition[]" placeholder="Definition" class="form-control kategori_field"></textarea></td><td ><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">Hapus</button></td></tr>');  
                
			}); 

            var k=1;

            $('#tambahList').click(function(){  
				k++;  
				$('#list_form').append('<tr id="row'+k+'"><td style = "text-align : center"><input type="hidden" name="idListLama[]" class="form-control kategori_field" style = "width : 5px"><input type="text" name="idList[]" placeholder="No" class="form-control kategori_field" style = "margin-right : 5px" required/></td><td> <input type="text" name="proses[]" placeholder="Business Process" class="form-control kategori_field" style = "margin-right : 5px" /> </td><td> <input type="text" name="pic[]" placeholder="Person In Charge" class="form-control kategori_field" style = "margin-right : 5px" /> </td><td><textarea rows="5" cols="60" name="desc[]" placeholder="Description" class="form-control kategori_field"></textarea></td><td><select name = "tipeProses[]" class="form-control kategori_field"><option value = "Manual"> Manual </option> <option value = "System"> System </option></select></td><td style = "text-align : center"><button type="button" name="remove" id="'+k+'" class="btn btn-danger btn_remove">Hapus</button></td></tr>');  
			}); 

            var u=0;
            $(document).on('click', '.lt', function(){  
                u++;  
				var button_id = $(this).attr("id");   
				$('#list'+button_id+'').remove();    
			});  

            
            $('#tambahKetentuan').click(function(){  
				i++;
				$('#ketentuan_form').append('<tr id="row'+i+'"><td><input type="hidden" name="idKetentuanSystem[]" class="form-control kategori_field" style = "width : 5px"><input type="text" name="idKetentuan[]" placeholder="ID" class="form-control kategori_field" style = "margin-right : 5px" required/></td><td><textarea rows="3" cols="60" name="ketentuan[]" placeholder="Deskripsi" class="form-control kategori_field"></textarea></td><td style = "text-align : center"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">Hapus</button></td><td style = "text-align : center; width : 50px"><input type="file" name="uploadKetentuan[]" style = "margin-top : 5px; width : 100px"><td></td></tr>');  
			}); 

            var l=0;
            $(document).on('click', '.kt', function(){  
                l++;  
				var button_id = $(this).attr("id");   
				$('#ketentuan'+button_id+'').remove();    
			});  

            $('#tambahKeterangan').click(function(){  
				i++;  
				$('#keterangan_form').append('<tr id="row'+i+'"> <td><input type="text" name="idKeterangan[]" placeholder="ID" class="form-control kategori_field" style = "margin-right : 5px" required /></td><td><textarea rows="3" cols="60" name="keterangan[]" placeholder="Deskripsi" class="form-control kategori_field"></textarea></td><td style = "text-align : center"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">Hapus</button></td><td style = "text-align : center; width : 50px"><input type="file" name="uploadKeterangan[]" style = "margin-top : 5px; width : 100px"></td><td></td></tr>');  
			}); 

            $('#tambahUploadBp').click(function(){  
				i++;  
				$('#bp_form').append('<tr id="row'+i+'"><td><input type="file" name="uploadBP[]" style = "width : 280px" required></td><td><input type = "hidden" name="uploadBpData[]" placeholder = "uploadBpData"><b>No File Uploaded</b></td><td><select name = "orderUploadBP[]"><?php for($o=1; $o<100; $o++) {echo'<option value = "'.$o.'"> '.$o.' </option>';}?></select></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">-</button></td></tr>');
			}); 

            var x=0;
            $(document).on('click', '.ktn', function(){  
                x++;  
				var button_id = $(this).attr("id");   
				$('#keterangan'+button_id+'').remove();    
			}); 

            $('#tambahLampiran').click(function(){  
				i++;  
				$('#lampiran_form').append('<tr id="row'+i+'"><td><input type="text" name="idLampiran[]" placeholder="ID" class="form-control kategori_field" style = "margin-right : 5px" required /></td><td><textarea rows="3" cols="60" name="lampiran[]" placeholder="Deskripsi" class="form-control kategori_field"></textarea></td><td style = "text-align : center"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">Hapus</button></td><td style = "text-align : center; width : 50px"><input type="file" name="uploadLampiran[]" style = "margin-top : 5px; width : 100px"></td><td></td></tr>');  
			}); 

            var c=0;
            $(document).on('click', '.lp', function(){  
                c++;  
				var button_id = $(this).attr("id");   
				$('#lampiran'+button_id+'').remove();    
			}); 

			$(document).on('click', '.btn_remove', function(){  
				var button_id = $(this).attr("id");   
				$('#row'+button_id+'').remove();  
			}); 

            var j=0;
            $(document).on('click', '.gp', function(){  
                j++;  
				var button_id = $(this).attr("id");   
				$('#pok'+button_id+'').remove();    
			});  

            var b=0;
            $(document).on('click', '.bp', function(){  
                b++;  
				var button_id = $(this).attr("id");   
				$('#uploadBp'+button_id+'').remove();    
			});  

            $(document).on('click', '.trashImg', function(){  
                l++;    
				$('#hapusRowImg').remove();    
			});  

            $(document).on('click', '.trashDoc', function(){  
                l++;    
				$('#hapusRowDoc').remove();    
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