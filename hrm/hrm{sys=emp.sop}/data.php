<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<script src="vendor/modal/bootstrap.min.js"></script>
<script src="sweetalert.js"></script>
<link rel="stylesheet" href="w3.css">

<?php
require('library/php-excel-reader/excel_reader2.php');
require('library/SpreadsheetReader.php');

if(isset($_POST['Submit'])){
       $bagian = $_POST['bagian'];
       $kodeProsedur = $_POST['kodeProsedur'];
       $idProsedur = $_POST['idProsedur'];
   
       $file = $_FILES["file"]["name"];
       $allowedImp = array('xls','xlsx');
       $extImp = pathinfo($file, PATHINFO_EXTENSION);
   
           if(in_array($extImp, $allowedImp)){
               $uploadFilePath = 'uploads/'.basename($_FILES['file']['name']);
               move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath);
               $Reader = new SpreadsheetReader($uploadFilePath);
               $totalSheet = count($Reader->sheets());
   
               if($bagian == "definisi") {
                   for($i=0;$i<$totalSheet;$i++){
                       $Reader->ChangeSheet($i);
                       foreach ($Reader as $Row) {
                       $definition_code = isset($Row[0]) ? $Row[0] : '';
                       $kamus = isset($Row[1]) ? $Row[1] : '';
                       $definisi = isset($Row[2]) ? $Row[2] : '';
           
                           if($definition_code != "definition_code" && $kamus != "kamus" && $definisi != "definisi") {
                               $sqlCekDefinisi = "SELECT * FROM hrdprosedurdef WHERE idProsedur = '$idProsedur' AND definition_code = '$definition_code'";
                               $cekDefinisi = mysqli_query($connect, $sqlCekDefinisi);
           
                               if(mysqli_num_rows($cekDefinisi) == 0) {
                                   $sqlDefinisi = "insert into temp_definisi(definition_code, idProsedur, kamus, definisi) values('$definition_code', '$idProsedur', '$kamus', '$definisi')";
                                   mysqli_query($connect, $sqlDefinisi);
                                   
                                   $sqlCekDoubleDef = "SELECT definition_code, COUNT(definition_code) AS Total FROM temp_definisi WHERE idProsedur = '$idProsedur' GROUP BY definition_code HAVING COUNT(definition_code) > 1";
                                   $cekDoubleDef = mysqli_query($connect, $sqlCekDoubleDef);
           
                                   if(mysqli_num_rows($cekDoubleDef) > 0) {
                                       $getDoubleDef = mysqli_fetch_array($cekDoubleDef);
                                       $arrayDef = $getDoubleDef['definition_code'];
                                       $sqlHapusDef = "DELETE FROM temp_definisi WHERE definition_code = '$arrayDef' AND idProsedur = '$idProsedur'";
                                       mysqli_query($connect, $sqlHapusDef);
                                   }
   
                                   $sqlCekDefinisiNow = "SELECT * FROM hrdprosedurdef WHERE idProsedur = '$idProsedur' AND definition_code = '$definition_code'";
                                   $cekDefinisiNow = mysqli_query($connect, $sqlCekDefinisiNow);
   
                                   if(mysqli_num_rows($cekDefinisiNow) > 0 || empty($definition_code)) {
                                       $sqlDeleteTemp = "DELETE FROM temp_definisi WHERE idProsedur = '$idProsedur' AND definition_code = '$definition_code'";
                                       mysqli_query($connect, $sqlDeleteTemp);
                                   }
                                   
                               }
           
                               
                           }
                       
                       }
                   }
           
                   $sqlTempDef = "SELECT * FROM temp_definisi";
                   $tempDef = mysqli_query($connect, $sqlTempDef);
           
                   if(mysqli_num_rows($tempDef) > 0) {
                       echo '<script>alert("Data berhasil diimport!");</script>';
                       for($i=0; $i < mysqli_num_rows($tempDef); $i++) {
                           $dataTempDef = mysqli_fetch_array($tempDef);
           
                           $def_code_temp = $dataTempDef['definition_code'];
                           $kamus_temp = $dataTempDef['kamus'];
                           $def_temp = $dataTempDef['definisi'];
           
                           $sqlInsertDef = "insert into hrdprosedurdef (definition_code, idProsedur, kamus, definisi, created_date, created_by, modified_date, modified_by) values('$def_code_temp', '$idProsedur', '$kamus_temp', '$def_temp', NOW(), '".$nama."', NOW(), '".$nama."')";
                           mysqli_query($connect, $sqlInsertDef);
   
                           $sqlDeleteTempDef = "DELETE FROM temp_definisi";
                           mysqli_query($connect, $sqlDeleteTempDef);
                           }  
                           echo '<script>document.location="index.php";</script>';
                       } else {
                           echo '<script>alert("Data tidak berhasil diimport!");</script>';
                           echo '<script>document.location="index.php";</script>';
                       }
               }
   
               if($bagian == "listProcess") {
                   for($i=0;$i<$totalSheet;$i++){
                       $Reader->ChangeSheet($i);
                       foreach ($Reader as $Row) {
                       $nomor = isset($Row[0]) ? $Row[0] : '';
                       $businessProcess = isset($Row[1]) ? $Row[1] : '';
                       $personInCharge = isset($Row[2]) ? $Row[2] : '';
                       $description = isset($Row[3]) ? $Row[3] : '';
                       $typeOfProcess = isset($Row[4]) ? $Row[4] : '';
           
                           if($nomor != "nomor" && $businessProcess != "Business Process" && $personInCharge != "Person In Charge" && $description != "Description" && $typeOfProcess != "Type of Process") {
                               $sqlCekList = "SELECT * FROM hrdprosedurlist WHERE idProsedur = '$idProsedur' AND list_code = '$nomor'";
                               $cekList = mysqli_query($connect, $sqlCekList);
           
                               if(mysqli_num_rows($cekList) == 0) {
                                   $sqlList = "insert into temp_list(nomor, businessProcess, personInCharge, description, typeOfProcess, idProsedur) values('$nomor', '$businessProcess', '$personInCharge', '$description', '$typeOfProcess', '$idProsedur')";
                                   mysqli_query($connect, $sqlList);
                                   
                                   $sqlCekDoubleList = "SELECT nomor, COUNT(nomor) AS Total FROM temp_list WHERE idProsedur = '$idProsedur' GROUP BY nomor HAVING COUNT(nomor) > 1";
                                   $cekDoubleList = mysqli_query($connect, $sqlCekDoubleList);
           
                                   if(mysqli_num_rows($cekDoubleList) > 0) {
                                       $getDoubleList = mysqli_fetch_array($cekDoubleList);
                                       $arrayList = $getDoubleList['nomor'];
                                       $sqlHapusList = "DELETE FROM temp_list WHERE nomor = '$arrayList' AND idProsedur = '$idProsedur'";
                                       mysqli_query($connect, $sqlHapusList);
                                   }
   
                                   $sqlCekListNow = "SELECT * FROM hrdprosedurlist WHERE idProsedur = '$idProsedur' AND list_code = '$nomor'";
                                   $cekListNow = mysqli_query($connect, $sqlCekListNow);
   
                                   if(mysqli_num_rows($cekListNow) > 0 || empty($nomor)) {
                                       $sqlDeleteTemp = "DELETE FROM temp_list WHERE idProsedur = '$idProsedur' AND nomor = '$nomor'";
                                       mysqli_query($connect, $sqlDeleteTemp);
                                   }
                               }          
                           }  
                       }
                   }
           
                   $sqlTempList = "SELECT * FROM temp_list";
                   $tempList = mysqli_query($connect, $sqlTempList);
           
                   if(mysqli_num_rows($tempList) > 0) {
                       echo '<script>alert("Data berhasil diimport!");</script>';
                       for($i=0; $i < mysqli_num_rows($tempList); $i++) {
                           $dataTempList = mysqli_fetch_array($tempList);
           
                           $nomor_temp = $dataTempList['nomor'];
                           $businessProcess_temp = $dataTempList['businessProcess'];
                           $personInCharge_temp = $dataTempList['personInCharge'];
                           $description_temp = $dataTempList['description'];
                           $typeOfProcess_temp = $dataTempList['typeOfProcess'];
           
                           $sqlInsertList = "insert into hrdprosedurlist (list_code, idProsedur, businessProcess, pic, description, tipeProses, created_date, created_by, modified_date, modified_by) values('$nomor_temp', '$idProsedur', '$businessProcess_temp', '$personInCharge_temp', '$description_temp', '$typeOfProcess_temp', NOW(), '".$nama."', NOW(), '".$nama."')";
                           mysqli_query($connect, $sqlInsertList);
   
                           $sqlDeleteTempList = "DELETE FROM temp_list";
                           mysqli_query($connect, $sqlDeleteTempList);
                           }  
                           echo '<script>document.location="index.php";</script>';
                       } else {
                           echo '<script>alert("Data tidak berhasil diimport!");</script>';
                           echo '<script>document.location="index.php";</script>';
                       }
               }
   
               if($bagian == "ketentuan") {
                   for($i=0;$i<$totalSheet;$i++){
                       $Reader->ChangeSheet($i);
                       foreach ($Reader as $Row) {
                       $idKetentuan = isset($Row[0]) ? $Row[0] : '';
                       $deskripsi = isset($Row[1]) ? $Row[1] : '';
           
                           if($idKetentuan != "idKetentuan" && $deskripsi != "deskripsi") {
                               $sqlCekKetentuan = "SELECT * FROM hrdprosedurketentuan WHERE idProsedur = '$idProsedur' AND ketentuan_code = '$idKetentuan'";
                               $cekKetentuan = mysqli_query($connect, $sqlCekKetentuan);
           
                               if(mysqli_num_rows($cekKetentuan) == 0) {
                                   $sqlKetentuan = "insert into temp_ketentuan(idKetentuan, deskripsi, idProsedur) values('$idKetentuan', '$deskripsi', '$idProsedur')";
                                   mysqli_query($connect, $sqlKetentuan);
                                   
                                   $sqlCekDoubleKetentuan = "SELECT idKetentuan, COUNT(idKetentuan) AS Total FROM temp_ketentuan WHERE idProsedur = '$idProsedur' GROUP BY idKetentuan HAVING COUNT(idKetentuan) > 1";
                                   $cekDoubleKetentuan = mysqli_query($connect, $sqlCekDoubleKetentuan);
           
                                   if(mysqli_num_rows($cekDoubleKetentuan) > 0) {
                                       $getDoubleKetentuan = mysqli_fetch_array($cekDoubleKetentuan);
                                       $arrayKetentuan = $getDoubleKetentuan['idKetentuan'];
                                       $sqlHapusKetentuan = "DELETE FROM temp_ketentuan WHERE idKetentuan = '$arrayKetentuan' AND idProsedur = '$idProsedur'";
                                       mysqli_query($connect, $sqlHapusKetentuan);
                                   }
   
                                   $sqlCekKetentuanNow = "SELECT * FROM hrdprosedurketentuan WHERE idProsedur = '$idProsedur' AND ketentuan_code = '$idKetentuan'";
                                   $cekKetentuanNow = mysqli_query($connect, $sqlCekKetentuanNow);
   
                                   if(mysqli_num_rows($cekKetentuanNow) > 0 || empty($idKetentuan)) {
                                       $sqlDeleteTemp = "DELETE FROM temp_ketentuan WHERE idProsedur = '$idProsedur' AND idKetentuan = '$idKetentuan'";
                                       mysqli_query($connect, $sqlDeleteTemp);
                                   }
                               }          
                           }  
                       }
                   }
           
                   $sqlTempKetentuan = "SELECT * FROM temp_ketentuan";
                   $tempKetentuan = mysqli_query($connect, $sqlTempKetentuan);
           
                   if(mysqli_num_rows($tempKetentuan) > 0) {
                       echo '<script>alert("Data berhasil diimport!");</script>';
                       for($i=0; $i < mysqli_num_rows($tempKetentuan); $i++) {
                           $dataTempKetentuan = mysqli_fetch_array($tempKetentuan);
           
                           $idKetentuan_temp = $dataTempKetentuan['idKetentuan'];
                           $deskripsi_temp = $dataTempKetentuan['deskripsi'];
           
                           $sqlInsertKetentuan = "insert into hrdprosedurketentuan (ketentuan_code, idProsedur, deskripsi, created_date, created_by, modified_date, modified_by) values('$idKetentuan', '$idProsedur', '$deskripsi', NOW(), '".$nama."', NOW(), '".$nama."')";
                           mysqli_query($connect, $sqlInsertKetentuan);
   
                           $sqlDeleteTempKetentuan = "DELETE FROM temp_ketentuan";
                           mysqli_query($connect, $sqlDeleteTempKetentuan);
                           }  
                           echo '<script>document.location="index.php";</script>';
                       } else {
                           echo '<script>alert("Data tidak berhasil diimport!");</script>';
                           echo '<script>document.location="index.php";</script>';
                       }
               }
   
               if($bagian == "keterangan") {
                   for($i=0;$i<$totalSheet;$i++){
                       $Reader->ChangeSheet($i);
                       foreach ($Reader as $Row) {
                       $idKeterangan = isset($Row[0]) ? $Row[0] : '';
                       $deskripsi = isset($Row[1]) ? $Row[1] : '';
           
                           if($idKeterangan != "idKeterangan" && $deskripsi != "deskripsi") {
                               $sqlCekKeterangan = "SELECT * FROM hrdprosedurketerangan WHERE idProsedur = '$idProsedur' AND keterangan_code = '$idKeterangan'";
                               $cekKeterangan = mysqli_query($connect, $sqlCekKeterangan);
           
                               if(mysqli_num_rows($cekKeterangan) == 0) {
                                   $sqlKeterangan = "insert into temp_keterangan(idKeterangan, deskripsi, idProsedur) values('$idKeterangan', '$deskripsi', '$idProsedur')";
                                   mysqli_query($connect, $sqlKeterangan);
                                   
                                   $sqlCekDoubleKeterangan = "SELECT idKeterangan, COUNT(idKeterangan) AS Total FROM temp_keterangan WHERE idProsedur = '$idProsedur' GROUP BY idKeterangan HAVING COUNT(idKeterangan) > 1";
                                   $cekDoubleKeterangan = mysqli_query($connect, $sqlCekDoubleKeterangan);
           
                                   if(mysqli_num_rows($cekDoubleKeterangan) > 0) {
                                       $getDoubleKeterangan = mysqli_fetch_array($cekDoubleKeterangan);
                                       $arrayKeterangan = $getDoubleKeterangan['idKeterangan'];
                                       $sqlHapusKeterangan = "DELETE FROM temp_keterangan WHERE idKeterangan = '$arrayKeterangan' AND idProsedur = '$idProsedur'";
                                       mysqli_query($connect, $sqlHapusKeterangan);
                                   }
   
                                   $sqlCekKeteranganNow = "SELECT * FROM hrdprosedurketerangan WHERE idProsedur = '$idProsedur' AND keterangan_code = '$idKeterangan'";
                                   $cekKeteranganNow = mysqli_query($connect, $sqlCekKeteranganNow);
   
                                   if(mysqli_num_rows($cekKeteranganNow) > 0 || empty($idKeterangan)) {
                                       $sqlDeleteTemp = "DELETE FROM temp_keterangan WHERE idProsedur = '$idProsedur' AND idKeterangan = '$idKeterangan'";
                                       mysqli_query($connect, $sqlDeleteTemp);
                                   }
                               }          
                           }  
                       }
                   }
           
                   $sqlTempKeterangan = "SELECT * FROM temp_keterangan";
                   $tempKeterangan = mysqli_query($connect, $sqlTempKeterangan);
           
                   if(mysqli_num_rows($tempKeterangan) > 0) {
                       echo '<script>alert("Data berhasil diimport!");</script>';
                       for($i=0; $i < mysqli_num_rows($tempKeterangan); $i++) {
                           $dataTempKeterangan = mysqli_fetch_array($tempKeterangan);
           
                           $idKeterangan_temp = $dataTempKeterangan['idKeterangan'];
                           $deskripsi_temp = $dataTempKeterangan['deskripsi'];
           
                           $sqlInsertKeterangan = "insert into hrdprosedurketerangan (keterangan_code, deskripsi, idProsedur, created_date, created_by, modified_date, modified_by) values('$idKeterangan_temp', '$deskripsi_temp', '$idProsedur', NOW(), '".$nama."', NOW(), '".$_SESSION['']."')";
                           mysqli_query($connect, $sqlInsertKeterangan);
   
                           $sqlDeleteTempKeterangan = "DELETE FROM temp_keterangan";
                           mysqli_query($connect, $sqlDeleteTempKeterangan);
                           }  
                           echo '<script>document.location="index.php";</script>';
                       } else {
                           echo '<script>alert("Data tidak berhasil diimport!");</script>';
                           echo '<script>document.location="index.php";</script>';
                       }
               }
   
               if($bagian == "lampiran") {
                   for($i=0;$i<$totalSheet;$i++){
                       $Reader->ChangeSheet($i);
                       foreach ($Reader as $Row) {
                       $idLampiran = isset($Row[0]) ? $Row[0] : '';
                       $deskripsi = isset($Row[1]) ? $Row[1] : '';
           
                           if($idLampiran != "idLampiran" && $deskripsi != "deskripsi") {
                               $sqlCekLampiran = "SELECT * FROM hrdprosedurlampiran WHERE idProsedur = '$idProsedur' AND lampiran_code = '$idLampiran'";
                               $cekLampiran = mysqli_query($connect, $sqlCekLampiran);
           
                               if(mysqli_num_rows($cekLampiran) == 0) {
                                   $sqlLampiran = "insert into temp_lampiran (idLampiran, deskripsi, idProsedur) values('$idLampiran', '$deskripsi', '$idProsedur')";
                                   mysqli_query($connect, $sqlLampiran);
                                   
                                   $sqlCekDoubleLampiran = "SELECT idLampiran, COUNT(idLampiran) AS Total FROM temp_lampiran WHERE idProsedur = '$idProsedur' GROUP BY idLampiran HAVING COUNT(idLampiran) > 1";
                                   $cekDoubleLampiran = mysqli_query($connect, $sqlCekDoubleLampiran);
           
                                   if(mysqli_num_rows($cekDoubleLampiran) > 0) {
                                       $getDoubleLampiran = mysqli_fetch_array($cekDoubleLampiran);
                                       $arrayLampiran = $getDoubleLampiran['idLampiran'];
                                       $sqlHapusLampiran = "DELETE FROM temp_lampiran WHERE idLampiran = '$arrayLampiran' AND idProsedur = '$idProsedur'";
                                       mysqli_query($connect, $sqlHapusLampiran);
                                   }
   
                                   $sqlCekLampiranNow = "SELECT * FROM hrdprosedurlampiran WHERE idProsedur = '$idProsedur' AND lampiran_code = '$idLampiran'";
                                   $cekLampiranNow = mysqli_query($connect, $sqlCekLampiranNow);
   
                                   if(mysqli_num_rows($cekLampiranNow) > 0 || empty($idLampiran)) {
                                       $sqlDeleteTemp = "DELETE FROM temp_lampiran WHERE idProsedur = '$idProsedur' AND idLampiran = '$idLampiran'";
                                       mysqli_query($connect, $sqlDeleteTemp);
                                   }
                               }          
                           }  
                       }
                   }
           
                   $sqlTempLampiran = "SELECT * FROM temp_lampiran";
                   $tempLampiran = mysqli_query($connect, $sqlTempLampiran);
           
                   if(mysqli_num_rows($tempLampiran) > 0) {
                       echo '<script>alert("Data berhasil diimport!");</script>';
                       for($i=0; $i < mysqli_num_rows($tempLampiran); $i++) {
                           $dataTempLampiran = mysqli_fetch_array($tempLampiran);
           
                           $idLampiran_temp = $dataTempLampiran['idLampiran'];
                           $deskripsi_temp = $dataTempLampiran['deskripsi'];
           
                           $sqlInsertLampiran = "insert into hrdprosedurlampiran (lampiran_code, idProsedur, deskripsi, created_date, created_by, modified_date, modified_by) values('$idLampiran_temp', '$idProsedur', '$deskripsi_temp', NOW(), '".$nama."', NOW(), '".$nama."')";
                           mysqli_query($connect, $sqlInsertLampiran);
   
                           $sqlDeleteTempLampiran = "DELETE FROM temp_lampiran";
                           mysqli_query($connect, $sqlDeleteTempLampiran);
                           }  
                           echo '<script>document.location="index.php";</script>';
                       } else {
                           echo '<script>alert("Data tidak berhasil diimport!");</script>';
                           echo '<script>document.location="index.php";</script>';
                       }
               }
   
           } else {
               echo '<script> alert("Sorry, File type is not allowed. Only Excel file");
               document.location="index.php";</script>';
           }
       }
?>

<?php  
       $search_en             = '';
       $search_ea             = '';
       // jika nip dan nama terisi
       if (!empty($_POST['search_en'])) {
              $nomorProsedur             = $_POST['search_en'];
       // AgusPrass 04/03/2021 menambahkan kondisi saat memfilter
       }
       if(!empty($_POST['search_ea'])){
              $namaProsedur                = $_POST['search_ea'];
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


<!-- Modal -->
<div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2"  data-backdrop="false">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-body">

                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                                   <form method="post" id="myform">
                                          <fieldset id="fset_1" style="margin-top: 25px;border-radius: 5px;border: 1px solid #e4e8ea;">
                                                 <legend>Searching</legend>
                                                 <div class="form-row">
                                                        <div class="col-4 name">Nomor Prosedur</div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on" id="search_en"
                                                                             name="search_en" type="Text" value=""
                                                                             onfocus="hlentry(this)" size="30" maxlength="50" 
                                                                             validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title="">
                                                               </div>
                                                        </div>
                                                 </div>

                                                 <div class="form-row">
                                                        <div class="col-4 name">Nama Prosedur</div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on"
                                                                             name="search_ea" id="search_ea" type="Text" value=""
                                                                             onfocus="hlentry(this)" size="30" maxlength="50" 
                                                                             validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title="">
                                                               </div>
                                                        </div>
                                                 </div>
                                                 
                                          </fieldset>
                   
                                          <button class="btn btn-warning" type="submit" style="width: 100%;border-radius: 17px;font-weight: bold;letter-spacing: 1px;font-size: 12px;">
                                                 Filter
                                          </button>
                                   </form>
				</div>

			</div><!-- modal-content -->
		</div><!-- modal-dialog -->
	</div><!-- modal -->

<div class="col-md-12">
       <div class="card">
               <div class="card-header d-flex align-items-center">
                     <h4 class="card-title mb-0">SOP</h4>
                            <div class="card-actions ml-auto">
                                   <table>
                                        <td>

                                                  <a href='#' class='open_modal_search' class="btn btn-demo" data-toggle="modal" data-target="#myModal2">
                                                 <div class="toolbar sprite-toolbar-search" id="SEARCH" title="Search">
                                                 </div>
                                          </a>
                                        </td>

                                        <!-- AgusPrass 02/03/2021 Menghilangkan # pada href-->
                                        <td>
                                          <div class="toolbar sprite-toolbar-reload" id="refresh" title="Reload" onclick="">
                                          </div>
                                        </td>
                                        <!-- AgusPrass 02/03/2021 -->
                                        
                                        </table>
                                          

                                        </div>
                                    </div>

                                   <!-- Button -->
                                   <div style = "margin-top : 10px; text-align : right; margin-right : 13px; margin-bottom : 5px">
                                   <div id="contact" style = "margin-right : 5px">
                                   
                                   <a href = "input.php">
                                   <button class = "btn btn-primary" style = "width : 100px">Input</button>
                                   </a>
                                   </div>
                                   </div>

                                   <!-- Tempat Modal -->
                                   
                                   <!-- Modal Gambar Besar-->
                                   <div class="modal fade" id="modal-besar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                               <div class="modal-dialog modal-bgkpi" style = "margin-bottom : 100px" role="document">
                                                                      <div class="modal-content">
                                                                      <div class="modal-header">
                                                                      <h5 class="modal-title3" id="title_modal3">
                                          </h5>

                                          </div>
                                                 <!-- <div class="modal-body"></div> -->
                                          <div id="besar"></div>
                                                 <!-- div modal footer -->
                                                 </div>
                                                 </div>
                                   </div>

                                   <!-- Modal Gambar -->
                                   <div class="modal fade" id="modal-penjelasan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                 <div class="modal-dialog modal-lg" style = "margin-bottom : 100px" role="document">
                                                        <div class="modal-content">
                                                               <div class="modal-header">
                                                               <h5 class="modal-title" id="title_modal">
                                   </h5>
                                   </div>
                                          <!-- <div class="modal-body"> </div>   -->
                                   <div id="test"></div>
                                          <!-- div modal footer -->
                                   </div>
                                   </div>
                                   </div>

                                   <!-- Table -->
                                   <div class="card-body table-responsive p-0" style="width: 100vw;height: 78vh; width: 98%; margin: 5px; overflow: scroll;">
                                   <table id="datatable" style = "width : 1500px" class="table table-bordered table-striped table-hover table-head-fixed">
                                          <thead style = "text-align : center; background-color : black; color : white; white-space: nowrap;">
                                                 <th style="z-index: 1;"> No </th>
                                                 <th style="z-index: 1;"> Nomor Prosedur </th>
                                                 <th style="z-index: 1;"> Nama Prosedur </th>
                                                 <th style="z-index: 1;"> Pemilik </th>
                                                 <th style="z-index: 1;"> Tanggal Terbit </th>
                                                 <th style="z-index: 1;"> Tanggal Berlaku </th>
                                                 <th style="z-index: 1;"> Request By </th>
                                                 <th style="z-index: 1;"> Created By </th>
                                                 <th style="z-index: 1;"> Modified Date </th>
                                                 <th style="z-index: 1;"> Modified By </th>
                                                 <th style="z-index: 1;"> Document </th>
                                                 <th style="z-index: 1;"> View </th>
                                                 <th style="z-index: 1;"> Edit </th>
                                                 <th style="z-index: 1;"> Hapus </th>
                                          </thead>

                                          <tbody>
                                          <?php
                                                 // Menentukan Query
                                                 // Query untuk semua employee [Admin]
                                                 if($user_type == "SuperAdmin") {
                                                        if(empty($nomorProsedur) && empty($namaProsedur)) {
                                                            $sql="SELECT * FROM hrmprosedur WHERE status = 'aktif'";
                                                        } else {
                                                            if($nomorProsedur && empty($namaProsedur)) {
                                                                $sql="SELECT * FROM hrmprosedur WHERE status = 'aktif' AND prosedur_code LIKE '%$nomorProsedur%'";
                                                            }
                                
                                                            if(empty($nomorProsedur) && $namaProsedur) {
                                                                $sql="SELECT * FROM hrmprosedur WHERE status = 'aktif' AND namaProsedur LIKE '%$namaProsedur%'";
                                                            }
                                
                                                            if($nomorProsedur && $namaProsedur) {
                                                                $sql="SELECT * FROM hrmprosedur WHERE status = 'aktif' AND prosedur_code LIKE '%$nomorProsedur%' AND namaProsedur LIKE '%$namaProsedur%'";
                                                            }
                                                        }
                                                 }

                                                 // Query untuk semua employee tapi dibatasi [Employee / Passive]
                                                 if($user_type == "Passive") {
                                                        $sql2 = "SELECT y.emp_id FROM hrdgroupemp x 
                                                        INNER JOIN hrdgroupotorisasidata y ON x.idGroup = y.idGroup 
                                                        WHERE x.emp_id = '$username'";
                                                        $koneksiSql2 = mysqli_query($connect, $sql2);

                                                        if(mysqli_num_rows($koneksiSql2) == 0) {
                                                               $nama_employee = "'0'";
                                                        } else {
                                                               $array = array();
                                                               while($row = mysqli_fetch_assoc($koneksiSql2)){
                                                                      $array[] = $row['emp_id'];
                                                               }
                               
                                                               $encodeRow = json_encode($array, TRUE);
                                                               $str1 = str_replace("[", "", $encodeRow);
                                                               $str2 = str_replace("]", "", $str1);
                                                               $nama_employee = str_replace('"', "'", $str2);
                                                        }

                                                        // Setting Query
                                                        if(empty($nomorProsedur) && empty($namaProsedur)) {
                                                               $sql="SELECT * FROM hrmprosedur WHERE status = 'aktif' AND diajukanOleh IN ('$username' , $nama_employee) OR created_by = '$username'";
                                                        } else {
                                                               if($nomorProsedur && empty($namaProsedur)) {
                                                                   $sql="SELECT * FROM hrmprosedur WHERE status = 'aktif' AND prosedur_code LIKE '%$nomorProsedur%' AND (diajukanOleh IN ('$username', $nama_employee) OR created_by = '$username')";
                                                               }
                                   
                                                               if(empty($nomorProsedur) && $namaProsedur) {
                                                                   $sql="SELECT * FROM hrmprosedur WHERE status = 'aktif' AND namaProsedur LIKE '%$namaProsedur%' AND (diajukanOleh IN ('$username', $nama_employee) OR created_by = '$username')";
                                                               }
                                   
                                                               if($nomorProsedur && $namaProsedur) {
                                                                   $sql="SELECT * FROM hrmprosedur WHERE status = 'aktif' AND prosedur_code LIKE '%$nomorProsedur%' AND namaProsedur LIKE '%$namaProsedur%' AND (diajukanOleh IN ('$username', $nama_employee) OR created_by = '$username')";
                                                               }
                                                        }
                                                 }

                                                 // Mulai menjalankan Query
                                                 $sql1 = "SELECT * FROM hrmprosedur WHERE status = 'aktif'";
                                                 $prosedur = mysqli_query($connect, $sql1);
                                                 if(mysqli_num_rows($prosedur) == 0) {
                                                     echo '
                                                     <tr>
                                                         <td colspan = "14">No Data</td>
                                                     </tr>
                                                     ';
                                                 } else {
                                                        $no = 1;
                                                        // Query didapatkan berdasarkan Admin / Passive
                                                        $hasil = mysqli_query($connect,$sql);
                                                        if(mysqli_num_rows($hasil) == 0) {
                                                               // Tidak ada hasil di pencarian
                                                               if(empty($nomorProsedur) && empty($namaProsedur)) {
                                                               echo '<tr>
                                                                      <td colspan = "14" style = "font-size : 15px; font-weight : bold">No data</td>
                                                                      </tr>';
                                                               } else {
                                                               echo '
                                                               <tr>
                                                                      <td colspan = "14" style = "font-size : 15px; font-weight : bold">Tidak ada hasil pencarian untuk '.$nomorProsedur.' '.$namaProsedur.'</td>
                                                               </tr>
                                                               ';
                                                               }
                                                        } else {
                                                               // Terdapat data dan ditampilkan
                                                               for($i=0; $i < mysqli_num_rows($hasil); $i++) {
                                                                      $data = mysqli_fetch_array($hasil);
                                                                      // Menampilkan data prosedur saja
                                                                      echo'
                                                                             <tr style = "text-align : center; white-space : nowrap;">
                                                                             <td style = "text-align : center">'.$no.'</td>
                                                                             <td>'.$data['prosedur_code'].'</td>
                                                                             <td>'.$data['namaProsedur'].'</td>
                                                                             <td>'.$data['pemilik'].'</td>
                                                                             <td>'.$data['tanggalTerbit'].'</td>
                                                                             <td>'.$data['tanggalBerlaku'].'</td>
                                                                             <td>'.$data['diajukanOleh'].'</td>
                                                                             <td>'.$data['created_by'].'</td>
                                                                             <td>'.$data['modified_date'].'</td>
                                                                             <td>'.$data['modified_by'].'</td>
                                                                             <td>'.$data['document'].'</td>';

                                                                             $sqlIdProsedur = "SELECT * FROM hrmprosedur WHERE prosedur_code = '".$data['prosedur_code']."' AND status = 'Aktif'";
                                                                             $idProsedur = mysqli_query($connect, $sqlIdProsedur);
                                                                             $arrayId = mysqli_fetch_array($idProsedur);
                                                                             $getId = $arrayId['idProsedur'];

                                                                      // Menampilkan Column view
                                                                      echo'
                                                                             <td>
                                                                             <img src = "foto/image1.png" style = "width : 30px; height : 30px" id1="'.$getId.'" data-toggle="modal" id="modal_gambar1" data-target="#modal-penjelasan">
                                                                             <img src = "foto/image2.png" style = "width : 30px; height : 30px" id1="'.$getId.'" data-toggle="modal" id="modal_penjelasan" data-target="#modal-besar">
                                                                             <img src = "foto/image3.png" style = "width : 30px; height : 30px" id1="'.$getId.'" data-toggle="modal" id="modal_gambar3" data-target="#modal-besar">
                                                                             <img src = "foto/kamus.png" style = "width : 25px; height : 30px" id1="'.$getId.'" data-toggle="modal" id="modal_gambar4" data-target="#modal-besar">
                                                                             </td>
                                                                      ';

                                                                      // Menampilkan column edit dan delete
                                                                      // [Admin]
                                                                      if($user_type == "SuperAdmin") {
                                                                             // Column Edit
                                                                             echo '<td>';
                                                                             echo '<button class = "btn btn-primary" style = "border-color : green; background-color : green; height : 35px; width : 70px" data-toggle="modal" data-target="#import-modal'.$i.'">Import</button>';

                                                                             echo '
                                                                             <a href = "edit.php?id='.$data['idProsedur'].'">
                                                                             <img src = "foto/image4.png" style = "width : 30px; height : 30px">
                                                                             </a>';
                                                                             echo '</td>';

                                                                             // Column Hapus
                                                                             ?>
                                                                             <td>
                                                                             <button onclick = "<?php echo "deletingToday".$data['idProsedur']."()" ?>" class = "btn btn-primary" style = "background-color : green; border : none; outline : none">Delete</button>
                                                                             <script>
                                                                                    function <?php echo 'deletingToday'.$data['idProsedur'].'()' ?> {  
                                                                                           swal({
                                                                                                  title: "Are you sure?",
                                                                                                  text: "You won't be able to revert this!",
                                                                                                  icon: "warning",
                                                                                                  buttons: true,
                                                                                                  dangerMode: true,
                                                                                           }) .then((willDelete) => {
                                                                                                  if (willDelete) {
                                                                                                         swal("Data successfully deleted !", {
                                                                                                         icon: "success",
                                                                                                         }).then ((willDelete) => {
                                                                                                         window.location.href = "delete.php?id=<?php echo $data['prosedur_code']; ?>";
                                                                                                         });
                                                                                                  }
                                                                                                  });
                                                                                    }
                                                                             </script>
                                                                             </td>
                                                                             <?php
                                                                      }

                                                                      // [Employee/Passive]
                                                                      if($user_type == "Passive") {
                                                                             // Menampilkan button sesuai dengan id SESSION [Ada Akses]
                                                                             if($data['diajukanOleh'] == $username || $data['created_by'] == $username) {
                                                                                    // Column Edit
                                                                                    echo '<td>';
                                                                                    echo '<button class = "btn btn-primary" style = "border-color : green; background-color : green; height : 35px; width : 70px" data-toggle="modal" data-target="#import-modal'.$i.'">Import</button>';
                                                                                    echo '
                                                                                    <a href = "edit.php?id='.$data['idProsedur'].'">
                                                                                    <img src = "foto/image4.png" style = "width : 30px; height : 30px">
                                                                                    </a>
                                                                                    ';
                                                                                    echo '</td>';
                                                                                    ?>
                                                                                    
                                                                                    <!-- Column Delete -->
                                                                                    <td>
                                                                                    <button onclick = "<?php echo "deleteNow".$data['idProsedur']."()" ?>" class = "btn btn-primary" style = "background-color : green; border : none; outline : none">Delete</button>
                                                                                    </td>

                                                                                    <script>
                                                                                           function <?php echo "deleteNow".$data['idProsedur']."()" ?> {  
                                                                                                  swal({
                                                                                                  title: "Are you sure?",
                                                                                                  text: "You won't be able to revert this!",
                                                                                                  icon: "warning",
                                                                                                  buttons: true,
                                                                                                  dangerMode: true,
                                                                                                  })
                                                                                                  .then((willDelete) => {
                                                                                                  if (willDelete) {
                                                                                                         swal("Data successfully deleted !", {
                                                                                                         icon: "success",
                                                                                                         }).then ((willDelete) => {
                                                                                                         window.location.href = "delete.php?id=<?php echo $data['prosedur_code']; ?>";
                                                                                                         });
                                                                                                  }
                                                                                                  });
                                                                                           }
                                                                                    </script>
                                                                                    <?php
                                                                             } else {
                                                                             // Menampilkan button sesuai dengan akses yang dimiliki [Tidak ada Akses]
                                                                             // Column Edit
                                                                             echo'<td>';
                                                                             echo '<button class = "btn btn-primary" style = "border-color : green; margin-right : 3px; background-color : green; height : 35px; width : 70px" onclick = "importing()">Import</button>';
                                                                             echo '<img src = "foto/image4.png" style = "width : 30px; height : 30px" onclick = "edit()">';
                                                                             echo'</td>';

                                                                             // Column Delete
                                                                             echo'
                                                                                 <td>
                                                                                     <button onclick="deleting()" class = "btn btn-primary" style = "background-color : green; border : none; outline : none">Delete</button>
                                                                                 </td>';
                                                                             }
                                                                             ?>
                                                                                    <script>
                                                                                           function edit() {  
                                                                                                  swal ( "Error" ,  "Hanya admin yang bisa melakukan edit!" ,  "error" ) 
                                                                                           }

                                                                                           function importing() {  
                                                                                                  swal ( "Error" ,  "Hanya admin yang bisa melakukan import!" ,  "error" )  
                                                                                           }

                                                                                           function deleting() {  
                                                                                                  swal ( "Error" ,  "Hanya admin yang bisa melakukan delete!" ,  "error" )  
                                                                                           }
                                                                                    </script>
                                                                             <?php
                                                                      }

                                                                      ?>
                                                                      <!-- Modal Import -->
                                                                      <div id="import-modal<?php echo $i; ?>" class="modal fade" role="dialog" style = "color : black">
                                                                                           <div class="modal-dialog">
                                                                                           <div class="modal-content">
                                                                                                  <div class="modal-header">
                                                                                                         <div>
                                                                                                         <h3><?php echo $data['prosedur_code']; ?></h3> 
                                                                                                         <h6><?php echo $data['namaProsedur']; ?></h6>
                                                                                                         </div>
                                                                                                  </div>
                                                                                                  <form method="POST" action="index.php" enctype="multipart/form-data">
                                                                                                         <div class="modal-body">
                                                                                                         <!-- cek -->
                                                                                                         <div class="forlistProcesslist m-group" style = "margin-bottom : 10px">
                                                                                                         <input type = "hidden" name = "kodeProsedur" value = "<?php echo $data['prosedur_code']; ?>">
                                                                                                         <input type = "hidden" name = "idProsedur" value = "<?php echo $data['idProsedur']; ?>">
                                                                                                                <label for="bagian">Bagian File yang akan diimport :</label>
                                                                                                                <select class = "form-control kategori_field" name = "bagian" id1="<?php echo $i; ?>" id = "bagian" required>
                                                                                                                <option disabled selected value style="display:none" > Import File </option>
                                                                                                                <option value="definisi">Definisi</option>
                                                                                                                <option value="listProcess">List Process</option>
                                                                                                                <option value="ketentuan">Ketentuan</option>
                                                                                                                <option value="keterangan">Keterangan</option>
                                                                                                                <option value="lampiran">Lampiran</option>
                                                                                                                </select>
                                                                                                         </div>
                                                                                                         <div class="form-group">
                                                                                                                <label for="file">File</label>
                                                                                                                <input type="file" name="file" class = "form-control kategori_field" style = "height : 43px" required>
                                                                                                                <br>
                                                                                                                <div id="box<?php echo $i; ?>"></div>                                  
                                                                                                         </div>
                                                                                                         <!-- cek -->
                                                                                                         </div>
                                                                                                         <div class="modal-footer">					
                                                                                                         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                                         <button type="submit" name="Submit" class="btn btn-success">Upload</button>
                                                                                                         </div>
                                                                                                  </form>
                                                                                           </div>
                                                                                           </div>
                                                                                    </div>
                                                                      <!-- Modal Import -->
                                                                      <?php
                                                                      $no++;
                                                               }
                                                        }

                                                 }
                                          ?>
                                          </tbody>
                                   </table>
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

<!-- Refresh Data saat click refresh -->
<script type="text/javascript" language="javascript" >
$(document).ready(function(){
        // Load data
              dataTable = $("#datatable").DataTable({
              dom: "B<'row'<'col-sm-12 col-md-9'l><'col-sm-12 col-md-9'f>>" +
                   "<'row'<'col-sm-12'tr>>" +
                   "<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-7'p>>",
              processing: true,
              // retrieve: true,
              searching: false,
              paging: true,
              order: [
                     [0, "asc"]
              ],
               pagingType: "simple",
              bPaginate: true,
              bLengthChange: false,
              bFilter: false,
              bInfo: true,
              bAutoWidth: true,
              language: {
                     "processing": "Please wait..",
              },
              destroy: true,
              columnDefs:[
                     {
                            
                     },
              ], 
       });

       // Refresh Page
       $("#refresh").click(function(e) {
              dataTable.ajax.reload();

              setTimeout(function(){
                     mymodalss.style.display = "none";
                     document.getElementById("msg").innerHTML = "Data refreshed";
                     return false;
              }, 2000);

              mymodalss.style.display = "block";
              document.getElementById("msg").innerHTML = "Data refreshed";
              return false;
                   
       });
    });
</script>

<!-- Menampilkan download template -->
<script type="text/javascript" language="javascript">
$(document).on('change', '#bagian', function(){
    var id = $(this).attr('id1');
    var value = $(this).val();
    if(value == 'definisi'){
        $('#box'+id+'').html('<a href="download/Definisi.xls">Download Template</a>');
    }else if(value == 'listProcess'){
        $('#box'+id+'').html('<a href="download/List Process.xls">Download Template</a>');
    }else if(value == 'ketentuan'){
        $('#box'+id+'').html('<a href="download/Ketentuan.xls">Download Template</a>');
    }else if(value == 'keterangan'){
        $('#box'+id+'').html('<a href="download/Keterangan.xls">Download Template</a>');
    }else if(value == 'lampiran'){
        $('#box'+id+'').html('<a href="download/Lampiran.xls">Download Template</a>');
    }
        });
</script>

<!-- Modal Gambar 1 -->
<script type="text/javascript" language="javascript">
$(document).on('click', '#modal_gambar1', function(){
            $('#title_modal').html('Gambar Proses');
            var id = $(this).attr('id1');
            var data = "id="+id+"";
              $.ajax({
			type: 'POST',
			url: "modal_gambar1.php",
			data: data,
			success: function(hasil) {
              $('#test').html(hasil);
			}
		});
            });
</script>

<!-- Modal Gambar 2 -->
<script type="text/javascript" language="javascript">
$(document).on('click', '#modal_penjelasan', function(){
       $('#title_modal3').html('Business Process');
       var id = $(this).attr('id1');
       var data = "id="+id+"";
              $.ajax({
                     type: 'POST',
                     url: "modal_penjelasan1.php",
                     data: data,
                     success: function(hasil) {
                            $('#besar').html(hasil);
                     }
              });
       });
</script>

<!-- Modal Gambar 3 -->
<script type="text/javascript" language="javascript">
$(document).on('click', '#modal_gambar3', function(){
            $('#title_modal3').html('Proses Sistem dan Manual');
            var id = $(this).attr('id1');
            var data = "id="+id+"";
            $.ajax({
			type: 'POST',
			url: "modal_gambar3.php",
			data: data,
			success: function(hasil) {
                        $('#besar').html(hasil);
			}
		});
            });
</script>

<!-- Modal Gambar 4 -->
<script type="text/javascript" language="javascript">
$(document).on('click', '#modal_gambar4', function(){
            $('#title_modal3').html('Ketentuan/Keterangan/Lampiran/Definisi');
            var id = $(this).attr('id1');
            var data = "id="+id+"";
            $.ajax({
			type: 'POST',
			url: "modal_gambar4.php",
			data: data,
			success: function(hasil) {
                            $('#besar').html(hasil);
			}
		});
            });
</script>