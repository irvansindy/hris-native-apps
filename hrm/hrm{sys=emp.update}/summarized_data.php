<?php
$country = '';
$query = "SELECT country_id,country_name FROM tgemcountry GROUP BY country_code ORDER BY country_code ASC";
$result = mysqli_query($connect, $query);
while($row = mysqli_fetch_array($result))
{
 $country .= '<option value="'.$row["country_id"].'">'.$row["country_name"].'</option>';
}
?>


<?php
$rfid = $_POST['rfid'];
$sql = mysqli_query($connect, "SELECT 
                                          a.*,
                                          b.*,
                                          b.phone as no_phone,
                                          c.*,
                                          d.*,
                                          e.nationality_name_en,
                                          f.address as id_address,
                                          f.zipcode as id_zipcode,
                                          f.*,
                                          g.address as current_address,
                                          g.zipcode as current_zipcode,
                                          i.*,
                                          h.*,
                                          ix.city_name,
                                          iz.edu_name,
                                          j.start_date,

                                          g.rt as ktp_rt,
                                          g.rw as ktp_rw,
                                          g.address as ktp_address,
                                          g.zipcode as ktp_zipcode,
                                          gaa.country_id as ktp_country_id,
                                          gaa.country_name as ktp_country_name,
                                          gab.state_id as ktp_state_id,
                                          gab.state_name as ktp_state_name,
                                          gac.city_id as ktp_city_id,
                                          gac.city_name as ktp_city_name,
                                          gad.district_id as ktp_district_id,
                                          gad.district_name as ktp_district_name,
                                          gae.subdistrict_id as ktp_subdistrict_id,
                                          gae.subdistrict_name as ktp_subdistrict_name,

                                          f.rt as domisili_rt,
                                          f.rw as domisili_rw,
                                          f.address as domisili_address,
                                          f.zipcode as domisili_zipcode,
                                          faa.country_id as domisili_country_id,
                                          faa.country_name as domisili_country_name,
                                          fab.state_id as domisili_state_id,
                                          fab.state_name as domisili_state_name,
                                          fac.city_id as domisili_city_id,
                                          fac.city_name as domisili_city_name,
                                          fad.district_id as domisili_district_id,
                                          fad.district_name as domisili_district_name,
                                          fae.subdistrict_id as domisili_subdistrict_id,
                                          fae.subdistrict_name as domisili_subdistrict_name

                                   -- MAIN TABLE
                                   FROM mgtools_teomemppersonal a
                                   LEFT JOIN mgtools_teodemppersonal b on a.emp_id=b.emp_id
                                   LEFT JOIN mgtools_teodempcustomfield c on a.emp_id=c.emp_id
                                   LEFT JOIN mgtools_teodempmedical d on d.emp_id=c.emp_id
                                   LEFT JOIN TEOMNATIONALITY e on b.nationality_code=e.nationality_code
                                   LEFT JOIN mgtools_teodempaddress f on f.emp_id=b.emp_id and f.addresstype_code='B'
                                   LEFT JOIN mgtools_teodempaddress g on g.emp_id=b.emp_id and g.addresstype_code='A'
                                   LEFT JOIN mgtools_tpydempbank h on h.emp_id=a.emp_id
                                   LEFT JOIN mgtools_teodempeducation i on a.emp_id=i.emp_id
                                   LEFT JOIN tgemcity ix on ix.city_id=i.city
                                   LEFT JOIN teomeduinstitution iz on iz.edu_code=i.edu_name
                                   LEFT JOIN view_employee j on a.emp_id=j.emp_id

                                   -- SECTION1
                                   LEFT JOIN tgemcountry gaa on g.country_id=gaa.country_id
                                   LEFT JOIN tgemstate gab on g.state_id=gab.state_id
                                   LEFT JOIN tgemcity gac on g.city_id=gac.city_id
                                   LEFT JOIN tgemdistrict gad on g.district=gad.district_id
                                   LEFT JOIN tgemsubdistrict gae on g.subdistrict=gae.subdistrict_id
                                   -- SECTION1
                                   LEFT JOIN tgemcountry faa on f.country_id=faa.country_id
                                   LEFT JOIN tgemstate fab on f.state_id=fab.state_id
                                   LEFT JOIN tgemcity fac on f.city_id=fac.city_id
                                   LEFT JOIN tgemdistrict fad on f.district=fad.district_id
                                   LEFT JOIN tgemsubdistrict fae on f.subdistrict=fae.subdistrict_id
                                
                                   WHERE j.emp_no  = '$rfid'");
$no = 0;
$no++;
while ($r = mysqli_fetch_array($sql)) {
?>

<?php
$get_cek_file    = mysqli_query($connect, "SELECT a.attachment,a.ext FROM mgtools_attachment a WHERE a.emp_id = '$username' and a.document_file = '1'");
$get_cek_file_r  = mysqli_fetch_array($get_cek_file);
if(mysqli_num_rows($get_cek_file) != '0'){
       $any_file = $get_cek_file_r['attachment'];
       $ext_file = $get_cek_file_r['ext'];
       
       if($ext_file == 'pdf'){
              $attch = "<span id='uploaded_image_exist'><img style=' min-width: 10%; max-width: 50%;margin-bottom: 20px;' src='uploaded_files/pngs.png' height='150' width='225' class='img-thumbnail'/></span>'";   
       } else {
              $attch = '<img style=" min-width: 10%; max-width: 50%;margin-bottom: 20px;min-height: 115px;" src="../../asset/list_document/'.$any_file.'" height="425" width="425" class="img-thumbnail" />';
       }
          
       
} else {
       $any_file = '';
       $attch = "";
}

$get_cek_file2    = mysqli_query($connect, "SELECT a.attachment,a.ext FROM mgtools_attachment a WHERE a.emp_id = '$username' and a.document_file = '2'");
$get_cek_file2_r  = mysqli_fetch_array($get_cek_file2);
if(mysqli_num_rows($get_cek_file2) != '0'){
       $any_file2 = $get_cek_file2_r['attachment'];
       $ext_file = $get_cek_file2_r['ext'];

       if($ext_file == 'pdf'){
              $attch2 = "<span id='uploaded_image_exist'><img style=' min-width: 10%; max-width: 50%;margin-bottom: 20px;' src='uploaded_files/pngs.png' height='150' width='225' class='img-thumbnail'/></span>'";   
       } else {
              $attch2 = '<img style=" min-width: 10%; max-width: 50%;margin-bottom: 20px;min-height: 115px;" src="../../asset/list_document/'.$any_file2.'" height="425" width="425" class="img-thumbnail" />';
       }
} else {
       $any_file2 = '';
       $attch2 = "";
}

$get_cek_file3    = mysqli_query($connect, "SELECT a.attachment,a.ext FROM mgtools_attachment a WHERE a.emp_id = '$username' and a.document_file = '3'");
$get_cek_file3_r  = mysqli_fetch_array($get_cek_file3);
if(mysqli_num_rows($get_cek_file3) != '0'){
       $any_file3 = $get_cek_file3_r['attachment'];
       $ext_file = $get_cek_file3_r['ext'];

       if($ext_file == 'pdf'){
              $attch3 = "<span id='uploaded_image_exist'><img style=' min-width: 10%; max-width: 50%;margin-bottom: 20px;' src='uploaded_files/pngs.png' height='150' width='225' class='img-thumbnail'/></span>'";   
       } else {
              $attch3 = '<img style=" min-width: 10%; max-width: 50%;margin-bottom: 20px;min-height: 115px;" src="../../asset/list_document/'.$any_file3.'" height="425" width="425" class="img-thumbnail" />';
       }

} else {
       $any_file3 = '';
       $attch3 = "";
}

$get_cek_file4    = mysqli_query($connect, "SELECT a.attachment,a.ext FROM mgtools_attachment a WHERE a.emp_id = '$username' and a.document_file = '4'");
$get_cek_file4_r  = mysqli_fetch_array($get_cek_file4);
if(mysqli_num_rows($get_cek_file4) != '0'){
       $any_file4 = $get_cek_file4_r['attachment'];
       $ext_file = $get_cek_file4_r['ext'];

       if($ext_file == 'pdf'){
              $attch4 = "<span id='uploaded_image_exist'><img style=' min-width: 10%; max-width: 50%;margin-bottom: 20px;' src='uploaded_files/pngs.png' height='150' width='225' class='img-thumbnail'/></span>'";   
       } else {
              $attch4 = '<img style=" min-width: 10%; max-width: 50%;margin-bottom: 20px;min-height: 115px;" src="../../asset/list_document/'.$any_file4.'" height="425" width="425" class="img-thumbnail" />';
       }

} else {
       $any_file4 = '';
       $attch4 = "";
}

$get_cek_file5    = mysqli_query($connect, "SELECT a.attachment,a.ext FROM mgtools_attachment a WHERE a.emp_id = '$username' and a.document_file = '5'");
$get_cek_file5_r  = mysqli_fetch_array($get_cek_file5);
if(mysqli_num_rows($get_cek_file5) != '0'){
       $any_file5 = $get_cek_file5_r['attachment'];
       $ext_file = $get_cek_file5_r['ext'];

       if($ext_file == 'pdf'){
              $attch5 = "<span id='uploaded_image_exist'><img style=' min-width: 10%; max-width: 50%;margin-bottom: 20px;' src='uploaded_files/pngs.png' height='150' width='225' class='img-thumbnail'/></span>'";   
       } else {
              $attch5 = '<img style=" min-width: 10%; max-width: 50%;margin-bottom: 20px;min-height: 115px;" src="../../asset/list_document/'.$any_file5.'" height="525" width="525" class="img-thumbnail" />';
       }

} else {
       $any_file5 = '';
       $attch5 = "";
}
?>

<!-- Google Font -->
<link rel="stylesheet" href="asset/css.css">

<!-- Font-Awesome Stylesheet -->
<link rel="stylesheet" href="asset/font-awesome.css">



<!--*****
		If you need to change the form color then you have to just change the CSS file name!! Do it very simply, like as "form-wizard-red.css" for make it red color. Our template other colors name is there ( black, blue, red, pink, purple, teal, green, yellow, orange, brown, cyan, lime ). Replace the name and make it awesome!!!
		*****-->

<style type="text/css" media="screen">
.header-button-group,
.body-button-group {
       float: left;
       width: 100%;
       height: auto;
       display: block;
       text-align: center;
       overflow: hidden;
}

.header-button-group h2,
.body-button-group h2 {
       font-size: 20px;
       color: #2b2b2b;
       text-transform: uppercase;
       padding: 8px 0;
}

.header-button-group button,
.body-button-group button {
       background: #6753D8;
       padding: 7px 15px;
       color: #fff;
       font-weight: 500;
       text-transform: uppercase;
}
</style>



</head>









<div class="col-md-12">
       <div class="card">
              <div class="card-header d-flex align-items-center">
                     <table>
                            <td>
                                   <form action="../hrm{sys=emp.update}/edit" method="POST">
                                          <input class="form-control" id="rfid"
                                                        style="text-transform:uppercase"
                                                        name="rfid" type="hidden" 
                                                        value="<?php echo $rfid; ?>">

                                          
                                                        <button type="submit" name=''
                                                               class="btn btn-submit"><div
                                                 class="toolbar sprite-toolbar-back" id="back" title="back"></div></button>

                                   </form>
                            </td>
                            <td>
                                   <h5 class="card-title mb-0">Kembali</h5>
                            </td>
                     </table>


                     <div class="card-actions ml-auto">
                            <table>
                                   <td>

                                          <a href='#' class='open_modal_search'>
                                                 <div class="toolbar" id="SEARCH" title="Search">
                                                 </div>
                                          </a>

                                   </td>
                            </table>
                     </div>
              </div>


       


                     <link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
                     <link rel="stylesheet"
                            href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
                     <script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js">
                     </script>
                     <script type="text/javascript"
                            src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>

                     <link rel="stylesheet" type="text/css" media="all" href="../../asset/gt_tab_menus/pe.css" />


                     <!-- main content -->
                     <section class="form-box">
                            <div class="form-wizard form-header-classic form-body-material">
                            <form name='form1' method="post" id="multiple_upload_form" enctype="multipart/form-data"
                                   onsubmit='return HrmsValidationForm()'>

                                   <?php
                                   $is_hidden_v09 = ''; // SET AS '' if you want running code
                                   ?>
                                   <input type="hidden<?php echo $is_hidden_v09; ?>" name="lastreqno" value="<?php echo $rfid; ?>">
                                   <input type="hidden<?php echo $is_hidden_v09; ?>" name="empbank_id" value="<?php echo $r['empbank_id']; ?>">


                                  






















































                                   
<div style="margin-left: 7px;"><h3 style="color: #595858;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-inbox feather-sm"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline><path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path></svg> Konfirmasi Pemutakhiran Data</h3></div>
                                          <!-- Form Step 1 -->
                                          <fieldset style="display: block;">
                                          
                                                 <!-- Progress Bar -->
                                                 <div class="progress">
                                                        <div class="progress-bar progress-bar-striped active"
                                                               role="progressbar" aria-valuenow="15" aria-valuemin="0"
                                                               aria-valuemax="100" style="width: 15%">
                                                        </div>
                                                 </div>
                                                 <!-- Progress Bar -->
                                                 <h5>Informasi Pribadi : <span>Langkah 1 - 6</span></h5>

                                                 <div class="table-responsive">
                                                        <table class="table">
                                                               <tbody>
                                                                      <tr>
                                                                             <th style="font-weight: bold;">Nama Lengkap </th>
                                                                             <td>
                                                                                    <p>: <?php echo strtoupper($r['first_name']); ?> <?php echo strtoupper($r['middle_name']); ?> <?php echo strtoupper($r['last_name']); ?></p>
                                                                             </td>
                                                                      </tr>
                                                                      <tr>
                                                                             <th style="font-weight: bold;">Nomor Induk Karyawan (NIP) </th>
                                                                             <td>
                                                                                    <p>: <?php echo $rfid; ?></p>
                                                                             </td>
                                                                      </tr>
                                                                      <tr>
                                                                             <th style="font-weight: bold;">Tempat /Tgl.Lahir (Diisi sesuai Ijasah) </th>
                                                                             <td>
                                                                                    <p>: <?php echo strtoupper($r['birthplace']); ?>, <?php echo date("Y-m-d", strtotime($r['birthdate'])); ?></p>
                                                                             </td>
                                                                      </tr>
                                                                      <tr>
                                                                             <th style="font-weight: bold;">NIK (Nomor KTP) </th>
                                                                             <td>
                                                                                    <p>: <?php echo $r['identity_no'] ?></p>
                                                                             </td>
                                                                      </tr>
                                                                      <tr>
                                                                             <th style="font-weight: bold;">Nomor Kartu Keluarga (KK) </th>
                                                                             <td>
                                                                                    <p>: <?php echo $r['customfield16'] ?></p>
                                                                             </td>
                                                                      </tr>
                                                                      <tr>
                                                                             <th style="font-weight: bold;">Tanggal Masuk Bekerja </th>
                                                                             <td>
                                                                                    <p>: <?php echo date("Y-m-d", strtotime($r['start_date'])); ?></p>
                                                                             </td>
                                                                      </tr>
                                                                      <tr>
                                                                             <th style="font-weight: bold;">Jenis Kelamin </th>
                                                                             <td><?php
                                                                                    $gender = $r['gender'];
                                                                                    if($gender == '1'){
                                                                                           $value_gender = '1';
                                                                                           $text_gender = 'Laki Laki';
                                                                                    } else {
                                                                                           $value_gender = '0';
                                                                                           $text_gender = 'Perempuan';
                                                                                    }
                                                                                    ?>
                                                                                    <p>:  <?php echo $text_gender; ?></p>
                                                                             </td>
                                                                      </tr>
                                                                      <tr>
                                                                             <th style="font-weight: bold;">Golongan Darah </th>
                                                                             <td>
                                                                                    <p>:  <?php echo $r['bloodtype'];?></p>
                                                                             </td>
                                                                      </tr>
                                                                      <tr>
                                                                             <th style="font-weight: bold;">Agama </th>
                                                                             <td> <?php
                                                                                    $religion = $r['religion_code'];
                                                                                    if($religion == 'BUDH'){
                                                                                           $text_religion = 'Buddhist';
                                                                                    } elseif($religion == 'CATH') {
                                                                                           $text_religion = 'Catholic';
                                                                                    } elseif($religion == 'CHRS') {
                                                                                           $text_religion = 'Christian';
                                                                                    } elseif($religion == 'HNDU') {
                                                                                           $text_religion = 'Hindu';
                                                                                    } elseif($religion == 'ISLM') {
                                                                                           $text_religion = 'Islam';
                                                                                    } elseif($religion == 'KHCU') {
                                                                                           $text_religion = 'Konghucu';
                                                                                    } elseif($religion == 'OTHR') {
                                                                                           $text_religion = 'Others';
                                                                                    } else {
                                                                                           $text_religion = '';
                                                                                    }
                                                                                    ?>
                                                                                    <p>: <?php echo $text_religion; ?></p>
                                                                             </td>
                                                                      </tr>
                                                                      <tr>
                                                                             <th style="font-weight: bold;">Status Perkawinan </th>
                                                                             <td><?php
                                                                                    $marital = $r['maritalstatus'];
                                                                                    if($marital == '0') {
                                                                                           $text_gender = 'Belum Kawin';
                                                                                    } elseif($marital == '1') {
                                                                                           $text_gender = 'Kawin';
                                                                                    } elseif($marital == '2') {
                                                                                           $text_gender = 'Duda';
                                                                                    } elseif($marital == '3') {
                                                                                           $text_gender = 'Janda';
                                                                                    }
                                                                                    ?>
                                                                                    <p>: <?php echo $text_gender;?></p>
                                                                             </td>
                                                                      </tr>
                                                                      <tr>
                                                                             <th style="font-weight: bold;">Kebangsaan </th>
                                                                             <td>
                                                                                    <p>: <?php echo $r['nationality_name_en'];?></p>
                                                                             </td>
                                                                      </tr>
                                                                      <tr>
                                                                             <th style="font-weight: bold;">Kontak Karyawan [No Handphone] </th>
                                                                             <td>
                                                                                    <p>: <?php echo $r['no_phone'];?></p>
                                                                             </td>
                                                                      </tr>
                                                                      <tr>
                                                                             <th style="font-weight: bold;">Kontak Karyawan [Email Perusahaan] </th>
                                                                             <td>
                                                                                    <p>: <?php echo $r['email'];?></p>
                                                                             </td>
                                                                      </tr>
                                                                      <tr>
                                                                             <th style="font-weight: bold;">Kontak Karyawan [Email Pribadi] </th>
                                                                             <td>
                                                                                    <p>: <?php echo $r['customfield15'];?></p>
                                                                             </td>
                                                                      </tr>
                                                                      <tr>
                                                                             <th style="font-weight: bold;">Alamat Lengkap ( <font color="#0faaaa">Sesuai Domisili</font> ) </th>
                                                                             <td>
                                                                                    <p>: <?php echo $r['ktp_address'];?></p>
                                                                             </td>
                                                                      </tr>
                                                                      <tr>
                                                                             <th style="font-weight: bold;">Kode Pos ( <font color="#0faaaa">Sesuai Domisili</font> ) </th>
                                                                             <td>
                                                                                    <p>: <?php echo $r['ktp_zipcode'];?></p>
                                                                             </td>
                                                                      </tr>
                                                                      <tr>
                                                                             <th style="font-weight: bold;">Negara ( <font color="#0faaaa">Sesuai Domisili</font> ) </th>
                                                                             <td>
                                                                                    <p>: <?php echo $r['ktp_country_name'];?></p>
                                                                             </td>
                                                                      </tr>
                                                                      <tr>
                                                                             <th style="font-weight: bold;">Provinsi ( <font color="#0faaaa">Sesuai Domisili</font> ) </th>
                                                                             <td>
                                                                                    <p>: <?php echo $r['ktp_state_name'];?></p>
                                                                             </td>
                                                                      </tr>
                                                                      <tr>
                                                                             <th style="font-weight: bold;">Kota / Kabupaten ( <font color="#0faaaa">Sesuai Domisili</font> ) </th>
                                                                             <td>
                                                                                    <p>: <?php echo $r['ktp_city_name'];?></p>
                                                                             </td>
                                                                      </tr>
                                                                      <tr>
                                                                             <th style="font-weight: bold;">RT ( <font color="#0faaaa">Sesuai Domisili</font> ) </th>
                                                                             <td>
                                                                                    <p>: <?php echo $r['ktp_rt'];?></p>
                                                                             </td>
                                                                      </tr>
                                                                      <tr>
                                                                             <th style="font-weight: bold;">RW ( <font color="#0faaaa">Sesuai Domisili</font> ) </th>
                                                                             <td>
                                                                                    <p>: <?php echo $r['ktp_rw'];?></p>
                                                                             </td>
                                                                      </tr>
                                                                      <tr>
                                                                             <th style="font-weight: bold;">Kecamatan ( <font color="#0faaaa">Sesuai Domisili</font> ) </th>
                                                                             <td>
                                                                                    <p>: <?php echo $r['ktp_district_name'];?></p>
                                                                             </td>
                                                                      </tr>
                                                                      <tr>
                                                                             <th style="font-weight: bold;">Kelurahan ( <font color="#0faaaa"><font color="#0faaaa">Sesuai Domisili</font></font> ) </th>
                                                                             <td>
                                                                                    <p>: <?php echo $r['ktp_subdistrict_name'];?></p>
                                                                             </td>
                                                                      </tr>

                                                                      <!-- //----------------------------------------------------------------------------------------------------------------------------------------- -->

                                                                      <tr>
                                                                             <th style="font-weight: bold;">Alamat Lengkap ( <font color="#ff861a">Sesuai Ktp</font> ) </th>
                                                                             <td>
                                                                                    <p>: <?php echo $r['domisili_address'];?></p>
                                                                             </td>
                                                                      </tr>
                                                                      <tr>
                                                                             <th style="font-weight: bold;">Kode Pos ( <font color="#ff861a">Sesuai Ktp</font> ) </th>
                                                                             <td>
                                                                                    <p>: <?php echo $r['domisili_zipcode'];?></p>
                                                                             </td>
                                                                      </tr>
                                                                      <tr>
                                                                             <th style="font-weight: bold;">Negara ( <font color="#ff861a">Sesuai Ktp</font> ) </th>
                                                                             <td>
                                                                                    <p>: <?php echo $r['domisili_country_name'];?></p>
                                                                             </td>
                                                                      </tr>
                                                                      <tr>
                                                                             <th style="font-weight: bold;">Provinsi ( <font color="#ff861a">Sesuai Ktp</font> ) </th>
                                                                             <td>
                                                                                    <p>: <?php echo $r['domisili_state_name'];?></p>
                                                                             </td>
                                                                      </tr>
                                                                      <tr>
                                                                             <th style="font-weight: bold;">Kota / Kabupaten ( <font color="#ff861a">Sesuai Ktp</font> ) </th>
                                                                             <td>
                                                                                    <p>: <?php echo $r['domisili_city_name'];?></p>
                                                                             </td>
                                                                      </tr>
                                                                      <tr>
                                                                             <th style="font-weight: bold;">RT ( <font color="#ff861a">Sesuai Ktp</font> ) </th>
                                                                             <td>
                                                                                    <p>: <?php echo $r['domisili_rt'];?></p>
                                                                             </td>
                                                                      </tr>
                                                                      <tr>
                                                                             <th style="font-weight: bold;">RW ( <font color="#ff861a">Sesuai Ktp</font> ) </th>
                                                                             <td>
                                                                                    <p>: <?php echo $r['domisili_rw'];?></p>
                                                                             </td>
                                                                      </tr>
                                                                      <tr>
                                                                             <th style="font-weight: bold;">Kecamatan ( <font color="#ff861a">Sesuai Ktp</font> ) </th>
                                                                             <td>
                                                                                    <p>: <?php echo $r['domisili_district_name'];?></p>
                                                                             </td>
                                                                      </tr>
                                                                      <tr>
                                                                             <th style="font-weight: bold;">Kelurahan ( <font color="#ff861a"><font color="#ff861a">Sesuai Ktp</font></font> ) </th>
                                                                             <td>
                                                                                    <p>: <?php echo $r['domisili_subdistrict_name'];?></p>
                                                                             </td>
                                                                      </tr>
                                                               </tbody>
                                                        </table>
                                                 </div>































                                          </fieldset>
                                          <!-- Form Step 1 -->





















































































                                          <!-- Form Step 2 -->
                                          <fieldset>
                                                 <!-- Progress Bar -->
                                                 <div class="progress">
                                                        <div class="progress-bar progress-bar-striped active"
                                                               role="progressbar" aria-valuenow="30" aria-valuemin="0"
                                                               aria-valuemax="100" style="width: 30%">
                                                        </div>
                                                 </div>
                                                 <!-- Progress Bar -->
                                                 <h5>Informasi Bank : <span>Langkah 2 - 6</span></h5>

                                                 <div class="table-responsive">
                                                        <table class="table">
                                                               <tbody>
                                                                      <tr>
                                                                             <th style="font-weight: bold;">Nama Bank </th>
                                                                             <td>
                                                                                    <p>: <?php echo $r['bank_code'];?></p>
                                                                             </td>
                                                                      </tr>
                                                                      <tr>
                                                                             <th style="font-weight: bold;">Nomor Rekening </th>
                                                                             <td>
                                                                                    <p>: <?php echo $r['bank_account'];?></p>
                                                                             </td>
                                                                      </tr>
                                                                      <tr>
                                                                             <th style="font-weight: bold;">Nama Rekening </th>
                                                                             <td>
                                                                                    <p>: <?php echo $r['account_name'];?></p>
                                                                             </td>
                                                                      </tr>
                                                                      
                                                               </tbody>
                                                        </table>
                                                 </div>
                                          </fieldset>
                                          <!-- Form Step 2 -->






















































































                                          <!-- Form Step 3 -->
                                          <fieldset>
                                                 <!-- Progress Bar -->
                                                 <div class="progress">
                                                        <div class="progress-bar progress-bar-striped active"
                                                               role="progressbar" aria-valuenow="45" aria-valuemin="0"
                                                               aria-valuemax="100" style="width: 45%">
                                                        </div>
                                                 </div>
                                                 <!-- Progress Bar -->
                                                 <h5>Informasi Pendidikan: <span>Langkah 3 - 6</span></h5>

                            

                                          <div class="card-body table-responsive p-0"
                                                 style="width: 100vw; width: 100.0%; margin: 5px;overflow: scroll;">
                                                 <table class="table table-hover small-text" id="tb">
                                                        <tr class="tr-header">
                                                               <th><label>Pendidikan&nbsp;&nbsp;&nbsp;<span>*</span></label></th>
                                                               <th><label>Nama Sekolah&nbsp;&nbsp;&nbsp;<span>*</span></label></th>
                                                               <th><label>Tempat/ Kota&nbsp;&nbsp;&nbsp;<span>*</span></label></th>
                                                               <th><label>Jurusan&nbsp;&nbsp;&nbsp;&nbsp;<span>*</span></label></th>
                                                               <th><label>Tahun Mulai&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>*</span></label></th>
                                                               <th><label>Tahun Selesai&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>*</span></label></th>
                                                               <th><label>IPK&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>*</span></label></th>
                                                               <!-- <th><a href="javascript:void(0);" style="font-size:18px;"
                                                                             id="addMore" title="Add More Person"><img
                                                                                    src="../../asset/img/icons/acssadd.png"  style="max-width: none;" style="max-width: none;"></a>
                                                               </th> -->
                                                        <tr>
                                                               <td>
                                                                      <p><?php echo $r['edu_type'];?></p>
                                                               </td>
                                                               <td>
                                                                      <p><?php echo $r['edu_name'];?></p>
                                                               </td>
                                                               <td>
                                                                      <p><?php echo $r['city_name'];?></p>
                                                               </td>
                                                               <td>
                                                                      <p><?php echo $r['faculty'];?></p>
                                                               </td>
                                                               <td>
                                                                      <p><?php echo $r['start_year'];?></p>
                                                               </td>
                                                               <td>
                                                                      <p><?php echo $r['end_year'];?></p>
                                                               </td>
                                                               <td>
                                                                      <p><?php echo $r['gpa'];?></p>
                                                               </td>
                                                        </tr>
                                                 </table>
                                                </div>                                                
                                          </fieldset>
                                          <!-- Form Step 3 -->

















































































                                          <!-- Form Step 3 -->
                                          <fieldset>
                                                 <!-- Progress Bar -->
                                                 <div class="progress">
                                                        <div class="progress-bar progress-bar-striped active"
                                                               role="progressbar" aria-valuenow="60" aria-valuemin="0"
                                                               aria-valuemax="100" style="width: 60%">
                                                        </div>
                                                 </div>
                                                 <!-- Progress Bar -->
                                                 <h5>Kontak Darurat : <span>Langkah 4 - 6</span></h5>
                                                
                                                
                                                 <div class="card-body table-responsive p-0"
                                                 style="width: 100vw; width: 100.0%; margin: 5px;overflow: scroll;">
                                                        <table class="table table-hover small-text" id="tba">
                                                        <tr class="tr-header">
                                                               <th><label>Nama Kontak <span>*</span></label></th>
                                                               <th><label>Hubungan Dengan Karyawan <span>*</span></label></th>
                                                               <th><label>Nomor Kontak <span>*</span></label></th>
                                                               <th><label>Alamat Lengkap <span>*</span></label></th>
                                                        <?php
                                                        $get_emergency = mysqli_query($connect, "SELECT * FROM  mgtools_teodempemergency a
                                                                                                         LEFT JOIN teomfamilyrelation b ON a.relationship_code=b.relationship_code
                                                                                                         WHERE 
                                                                                                                a.emp_id = (SELECT emp_id FROM view_employee WHERE emp_no='$rfid')");
                                                        while($row = mysqli_fetch_array($get_emergency)){
                                                        ?>
                                                        <tr>
                                                                      
                                                               <td>
                                                                      <p><?php echo $row['contact_name'];?></p>
                                                               </td>
                                                               <td>
                                                                      <p><?php echo $row['relationship_name_id'];?></p>
                                                               </td>
                                                               <td>
                                                                      <p><?php echo $row['phone'];?></p>
                                                               </td>
                                                               <td>
                                                                      <p><?php echo $row['address'];?></p>
                                                               </td>
                                                        </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                 </table>
                                                 </div>
                                          </fieldset>
                                          <!-- Form Step 3 -->

                                          























































































                                          <!-- Form Step 3 -->
                                          <fieldset>
                                                 <!-- Progress Bar -->
                                                 <div class="progress">
                                                        <div class="progress-bar progress-bar-striped active"
                                                               role="progressbar" aria-valuenow="75" aria-valuemin="0"
                                                               aria-valuemax="100" style="width: 75%">
                                                        </div>
                                                 </div>
                                                 <!-- Progress Bar -->
                                                 <h5>Keluarga & Tanggungan : <span>Langkah 5 - 6</span></h5>
                                                 
                                                 <div class="card-body table-responsive p-0"
                                                 style="width: 100vw; width: 100.0%; margin: 5px;overflow: scroll;">
                                                        <table class="table table-hover small-text" id="tbb">
                                                        <tr class="tr-header">
                                                               <th><label>Anggota Keluarga&nbsp;&nbsp;&nbsp;&nbsp;<span>*</span></label></th>
                                                               <th><label>Nama Lengkap&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>*</span></label></th>
                                                               <th><label>Tanggal Lahir&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>*</span></label></th>
                                                               <th><label>Status (Hidup/ Meninggal)&nbsp;&nbsp;&nbsp;<span>*</span></label></th>
                                                              
                                                       
                                                       
                                                        <?php
                                                        $get_family = mysqli_query($connect, "SELECT * FROM mgtools_teodempfamily a
                                                                                                  LEFT JOIN teomfamilyrelation b ON a.relationship=b.relationship_code
                                                                                                  WHERE a.emp_id = (SELECT emp_id FROM view_employee WHERE emp_no='$rfid')
                                                                                                  ORDER BY b.order ASC
                                                                                                  ");
                                                        while($row = mysqli_fetch_array($get_family)){
                                                        ?>

                                                        <tr>
                                                               <td>
                                                                       <p><?php echo $row['relationship_name_id'];?></p>
                                                               </td>
                                                               <td>
                                                                       <p><?php echo $row['name'];?></p>
                                                               </td>
                                                               <td>
                                                                       <p><?php echo date('Y-m-d', strtotime($row['birthdate']));?></p>
                                                               </td>
                                                               <td>
                                                                      <p><?php if($row['alive_status'] == '1')
                                                                                    {
                                                                                           echo "Hidup"; 
                                                                                    } else {
                                                                                           echo "Meninggal"; 
                                                                                    }
                                                                                    ?>
                                                                      </p>
                                                               </td>
                                                              
                                              
                                                        
                                                        </tr>
                                                        <?php
                                                        }
                                                        ?>

                                                 
                                                 </table>
                                                 </div>
                                                 <script>
                                                 $(function() {
                                                        $('#addMoreb').on('click', function() {
                                                               var data = $("#tbb tr:eq(1)")
                                                                      .clone(true).appendTo(
                                                                             "#tbb");
                                                               data.find("input").val('');
                                                        });
                                                        $(document).on('click', '.removeb', function() {
                                                               var trIndex = $(this)
                                                                      .closest("tr")
                                                                      .index();
                                                               if (trIndex > 7) {
                                                                      $(this).closest("tr")
                                                                             .remove();
                                                               } else {
                                                                      alert(
                                                                             "Sorry required field cannot delete"
                                                                             );
                                                               }
                                                        });
                                                 });
                                                 </script>

                                                
                                          </fieldset>
                                          <!-- Form Step 3 -->



































                                          <!-- Form Step 3 -->
                                          <fieldset>
                                                 <!-- Progress Bar -->
                                                 <div class="progress">
                                                        <div class="progress-bar progress-bar-striped active"
                                                               role="progressbar" aria-valuenow="90" aria-valuemin="0"
                                                               aria-valuemax="100" style="width: 90%">
                                                        </div>
                                                 </div>

                                                 <!-- Progress Bar -->
                                                 <h5>Dokumen Pendukung: <span>Langkah 6 - 6</span></h5>

                                                 <div class="form-group">
                                                        <label>Foto Copy KTP <span></span> </label>
                                                        
                                                          <br>
                                                 <span id="uploaded_image"></span>
                                                 <?php echo $attch;?>
                                                 </div>

                                                 <div class="form-group">
                                                        <label>Kartu Keluarga <span></span></label>
                                                      
                                                          <br>
                                                 <span id="uploaded_image2"></span>
                                                 <?php echo $attch2;?>
                                                 </div>

                                                 <div class="form-group">
                                                        <label>Ijazah <span></span></label>
                                                      
                                                          <br>
                                                 <span id="uploaded_image3"></span>
                                                 <?php echo $attch3;?>
                                                 </div>

                                                 <div class="form-group">
                                                        <label>Npwp <span></span></label>
                                                      
                                                          <br>
                                                 <span id="uploaded_image4"></span>
                                                 <?php echo $attch4;?>
                                                 </div>

                                                 <div class="form-group">
                                                        <label>Buku Nikah <span></span></label>
                                                      
                                                          <br>
                                                 <span id="uploaded_image5"></span>
                                                 <?php echo $attch5;?>
                                                 </div>


                                          </fieldset>
                                          <!-- Form Step 3 -->






















































































                                          <input class="form-control" id="rfid"
                                                        style="text-transform:uppercase"
                                                        name="rfid" type="hidden" 
                                                        value="<?php echo $rfid; ?>"
                                                        >

                                        

                                   </form>


                                   <!-- Form Wizard -->

                            </div>
                          
                     </section>
                     <!-- main content -->


                    
                     <?php include "controller/con_leave_save.php";?>

                     <?php } ?>

                     <script type="text/javascript">
                     $(document).ready(function() {
                            $('#inp_birthdate').bootstrapMaterialDatePicker({
                                   time: false,
                                   clearButton: true
                            });
                            $('#inp_birthdate2').bootstrapMaterialDatePicker({
                                   time: false,
                                   clearButton: true
                            });
                            $('#inp_birthdate3').bootstrapMaterialDatePicker({
                                   time: false,
                                   clearButton: true
                            });
                            $('#inp_birthdate4').bootstrapMaterialDatePicker({
                                   time: false,
                                   clearButton: true
                            });
                            $('#inp_birthdate5').bootstrapMaterialDatePicker({
                                   time: false,
                                   clearButton: true
                            });
                            $('#inp_birthdate6').bootstrapMaterialDatePicker({
                                   time: false,
                                   clearButton: true
                            });
                            $('#inp_birthdate7').bootstrapMaterialDatePicker({
                                   time: false,
                                   clearButton: true
                            });
                            $('#inp_birthdate8').bootstrapMaterialDatePicker({
                                   time: false,
                                   clearButton: true
                            });
                            $('#inp_birthdate9').bootstrapMaterialDatePicker({
                                   time: false,
                                   clearButton: true
                            });
                            $('#inp_birthdate10').bootstrapMaterialDatePicker({
                                   time: false,
                                   clearButton: true
                            });
                            $('#inp_birthdate11').bootstrapMaterialDatePicker({
                                   time: false,
                                   clearButton: true
                            });
                            $('#inp_birthdate12').bootstrapMaterialDatePicker({
                                   time: false,
                                   clearButton: true
                            });

                            $('#inp_joindate').bootstrapMaterialDatePicker({
                                   time: false,
                                   clearButton: true
                            });

                            $('#inp_starttime').bootstrapMaterialDatePicker({
                                   date: false,
                                   format: 'HH:mm'
                            });

                            $('#inp_endtime').bootstrapMaterialDatePicker({
                                   date: false,
                                   format: 'HH:mm'
                            });
                     });
                     </script>

                     <script>
                     function FunctionName(val) {
                            document.getElementById("inp_first_name").innerHTML = val;
                     }

                     function FunctionAddess(val) {
                            document.getElementById("FunctionAddress").innerHTML = val;
                     }
                     </script>



                     <script>
                     function HrmsValidationForm() {
                            var any_file = document.getElementById("any_file").value;
                            var any_file1 = document.getElementById("any_file1").value;

                            if (any_file == "") {
                                   alert("Masukkan Lampiran KTP");
                                   return false;
                            } else if (any_file1 == "") {
                                   alert("Masukkan Lampiran KK");
                                   return false;
                            } else {
                                   $('#submit_add').hide();
                                   $('#submit_add2').show();
                            }
                     }
                     </script>

                     <script>
                     var uploadField = document.getElementById("inp_refdoc");

                     uploadField.onchange = function() {
                            if (this.files[0].size > 3145728) {
                                   alert("File is too large guys ! Max File Upload is 3MB");
                                   this.value = "";
                            };
                     };
                     </script>

                     <script>
                     var uploadField = document.getElementById("inp_refdoc");
                     // doc,jpg,ods,png,txt,doc,pdf
                     var allowedFiles = [".doc", ".jpg", ".ods", ".png", ".txt", ".doc", ".pdf"];
                     var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");

                     uploadField.onchange = function() {
                            if (this.files[0].size > 3145728) {
                                   alert("File is too large guys ! Max File Upload is 3MB");
                                   this.value = "";
                            } else if (!regex.test(uploadField.value.toLowerCase())) {
                                   alert("Only file [doc,jpg,ods,png,txt,doc,pdf] allowed");
                                   this.value = "";
                            };
                     };
                     </script>




                     <!-- JAVASCRIPT UNTUK GET LEAVE TYPE VS URGENT REASON -->
                     <!-- JAVASCRIPT UNTUK GET LEAVE TYPE VS URGENT REASON -->
                     <script type="text/javascript">
                     $(document).ready(function() {
                            $(".modal_leave").change(function() {
                                   var leave_code = $(this).val();
                                   var post_id = 'id=' + leave_code;

                                   $.ajax({
                                          type: "POST",
                                          url: "ajax_cek4_leavetype.php",
                                          data: post_id,
                                          cache: false,
                                          success: function(
                                                 urgent_reason_print) {
                                                 $(".urgent_reason")
                                                        .html(
                                                               urgent_reason_print
                                                        );
                                          }
                                   });
                            });
                     });
                     </script>
                     <!-- JAVASCRIPT UNTUK GET LEAVE TYPE VS URGENT REASON -->
                     <!-- JAVASCRIPT UNTUK GET LEAVE TYPE VS URGENT REASON -->

                     <script>
                     function openCity(evt, cityName) {
                            var i, tabcontent, tablinks;
                            tabcontent = document.getElementsByClassName(
                                   "tabcontent");
                            for (i = 0; i < tabcontent.length; i++) {
                                   tabcontent[i].style.display = "none";
                            }
                            tablinks = document.getElementsByClassName(
                                   "tablinks");
                            for (i = 0; i < tablinks.length; i++) {
                                   tablinks[i].className = tablinks[i]
                                          .className.replace(" active", "");
                            }
                            document.getElementById(cityName).style.display =
                                   "block";
                            evt.currentTarget.className += " active";
                     }

                     // Get the element with id="defaultOpen" and click on it
                     document.getElementById("defaultOpen").click();
                     </script>
              </div>
       </div>
</div>




<br>

<!-- Jquery JS -->
<script src="asset/jquery-1.js"></script>
<!-- bootStrap JS -->
<script src="asset/bootstrap.js"></script>


<!-- Plugin Custom JS -->
<script src="asset/form-wizard.js"></script>
<!-- Plugin Custom JS -->

<script type="text/javascript">
$('#classic').click(function() {
       $('.form-wizard').addClass("form-header-classic").removeClass(
              "form-header-stylist form-header-modarn");
});

$('#modarn').click(function() {
       $('.form-wizard').addClass("form-header-modarn").removeClass(
              "form-header-classic form-header-stylist");
});

$('#stylist').click(function() {
       $('.form-wizard').addClass("form-header-stylist").removeClass(
              "form-header-classic form-header-modarn");
});
</script>



<script type="text/javascript">
$('#classic-body').click(function() {
       $('.form-wizard').addClass("form-body-classic").removeClass(
              "form-body-stylist form-body-material");
});

$('#material-body').click(function() {
       $('.form-wizard').addClass("form-body-material").removeClass(
              "form-body-classic form-body-stylist");
});

$('#stylist-body').click(function() {
       $('.form-wizard').addClass("form-body-stylist").removeClass(
              "form-body-classic form-body-material");
});
</script>

<script>
document.querySelector("html").classList.add('js');

var fileInput  = document.querySelector( ".input-file" ),  
    button     = document.querySelector( ".input-file-trigger" ),
    the_return = document.querySelector(".file-return");
      
button.addEventListener( "keydown", function( event ) {  
    if ( event.keyCode == 13 || event.keyCode == 32 ) {  
        fileInput.focus();  
    }  
});
button.addEventListener( "click", function( event ) {
   fileInput.focus();
   return false;
});  
fileInput.addEventListener( "change", function( event ) {  
    the_return.innerHTML = this.value;  
});  
</script>



<script>
       var uploadField = document.getElementById("file");
       // doc,jpg,ods,png,txt,doc,pdf
       var allowedFiles = [".pdf"];
       var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");

       uploadField.onchange = function() {
       if(this.files[0].size > 3145728){
                                   alert("Dokumen terlalu besar, Maksimum upload file 4 Mb");
                                   this.value = "";
       } else if (!regex.test(uploadField.value.toLowerCase())) {
                                   alert("Hanya File Pdf yang diijinkan");
                                   this.value = "";
       };
       };
</script>
<script>
       var uploadField2 = document.getElementById("file2");
       // doc,jpg,ods,png,txt,doc,pdf
       var allowedFiles = [".pdf"];
       var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");

       uploadField2.onchange = function() {
       if(this.files[0].size > 3145728){
                                   alert("Dokumen terlalu besar, Maksimum upload file 4MB");
                                   this.value = "";
       } else if (!regex.test(uploadField2.value.toLowerCase())) {
                                   alert("Hanya File Pdf yang diijinkan");
                                   this.value = "";
       };
       };
</script>
<script>
       var uploadField3 = document.getElementById("file3");
       // doc,jpg,ods,png,txt,doc,pdf
       var allowedFiles = [".pdf"];
       var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");

       uploadField3.onchange = function() {
       if(this.files[0].size > 3145728){
                                   alert("Dokumen terlalu besar, Maksimum upload file 4MB");
                                   this.value = "";
       } else if (!regex.test(uploadField3.value.toLowerCase())) {
                                   alert("Hanya File Pdf yang diijinkan");
                                   this.value = "";
       };
       };
</script>



<script>
$(document).ready(function(){
 $(document).on('change', '#file', function(){
  var name = document.getElementById("file").files[0].name;
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  if(jQuery.inArray(ext, ['pdf']) == -1) 
  {
   alert("Invalid Image File");
  }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("file").files[0]);
  var f = document.getElementById("file").files[0];
  var fsize = f.size||f.fileSize;
  if(fsize > 2000000)
  {
   alert("Image File Size is very big");
  }
  else
  {
   form_data.append("file", document.getElementById('file').files[0]);
   $.ajax({
       url:"uploader_dokumen.php?&code=1&token=<?php echo $username; ?>",
       method:"POST",
       data: form_data,
       contentType: false,
       cache: false,
       processData: false,
       beforeSend:function(){
       $('#uploaded_image').html("<label class='text-success'>Document Uploading...</label>");
       },   
       success:function(data)
       {
       $('#uploaded_image').html(data);
       }
   });
  }
 });
});
</script>

<script>
$(document).ready(function(){
 $(document).on('change', '#file2', function(){
  var name = document.getElementById("file2").files[0].name;
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  if(jQuery.inArray(ext, ['pdf']) == -1) 
  {
   alert("Invalid Image File");
  }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("file2").files[0]);
  var f = document.getElementById("file2").files[0];
  var fsize = f.size||f.fileSize;
  if(fsize > 2000000)
  {
   alert("Image File Size is very big");
  }
  else
  {
   form_data.append("file2", document.getElementById('file2').files[0]);
   $.ajax({
       url:"uploader_dokumen.php?&code=2&token=<?php echo $username; ?>",
       method:"POST",
       data: form_data,
       contentType: false,
       cache: false,
       processData: false,
       beforeSend:function(){
       $('#uploaded_image2').html("<label class='text-success'>Document Uploading...</label>");
       },   
       success:function(data)
       {
       $('#uploaded_image2').html(data);
       }
   });
  }
 });
});
</script>


<script>
$(document).ready(function(){
 $(document).on('change', '#file3', function(){
  var name = document.getElementById("file3").files[0].name;
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  if(jQuery.inArray(ext, ['pdf']) == -1) 
  {
   alert("Invalid Image File");
  }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("file3").files[0]);
  var f = document.getElementById("file3").files[0];
  var fsize = f.size||f.fileSize;
  if(fsize > 2000000)
  {
   alert("Image File Size is very big");
  }
  else
  {
   form_data.append("file3", document.getElementById('file3').files[0]);
   $.ajax({
       url:"uploader_dokumen.php?&code=3&token=<?php echo $username; ?>",
       method:"POST",
       data: form_data,
       contentType: false,
       cache: false,
       processData: false,
       beforeSend:function(){
       $('#uploaded_image3').html("<label class='text-success'>Document Uploading...</label>");
       },   
       success:function(data)
       {
       $('#uploaded_image3').html(data);
       }
   });
  }
 });
});
</script>






                            
<style>
.footer2 {
       position: fixed;
       left: 0;
       bottom: 0;
       width: 100%;
       background-color: #fff;
       color: white;
       text-align: center;
       z-index: 2;
}
/* KALO VIEW MOBILE */
@media (max-width:960px) { 
       .button_bot {
              background-color: #F68A22;
              border: solid 1px #DCDFDE;
              font-weight: bold;
              color: #E1E1E1;
              width: 100%;
              height: 50px;
              padding: 12px;
              text-align: center;
              text-decoration: none;
              display: inline-block;
              font-size: 14px;
              margin: 1px 1px;
              cursor: pointer;
              border-radius: 40px;
       }
       .button_bot[disabled]{
              background-color: #F68A22;
              border: solid 1px #DCDFDE;
              font-weight: bold;
              color: #E1E1E1;
              width: 100%;
              height: 50px;
              padding: 12px;
              text-align: center;
              text-decoration: none;
              display: inline-block;
              font-size: 14px;
              margin: 1px 1px;
              cursor: pointer;
              border-radius: 40px;
       }
}
/* KALO VIEW WEB */
@media (min-width:960px) { 
       .button_bot {
              background-color: #F68A22;
              border: solid 1px #DCDFDE;
              font-weight: bold;
              color: #E1E1E1;
              width: 40%;
              height: 50px;
              padding: 12px;
              text-align: center;
              text-decoration: none;
              display: inline-block;
              font-size: 14px;
              margin: 1px 1px;
              cursor: pointer;
              border-radius: 40px;
       }
       .button_bot[disabled]{
              background-color: #F68A22;
              border: solid 1px #DCDFDE;
              font-weight: bold;
              color: #E1E1E1;
              width: 40%;
              height: 50px;
              cursor: no-drop;
              padding: 12px;
              text-align: center;
              text-decoration: none;
              display: inline-block;
              font-size: 14px;
              margin: 1px 1px;
              cursor: pointer;
              border-radius: 40px;
       }
} 
</style>


<footer class='footer2'>
                                                 

       <form method='POST' style="margin: 10px;" onsubmit='return HrmsValidationForm()'>
              <input type='hidden' class='hidden' value='<?php echo $username; ?>' type='text' name='rfid'>
              <button type='submit' name='submit_add_commit' id='submit_add' type='button' class="btn btn-warning button_bot">
              Update Data
              </button>
              <button class="btn btn-warning button_bot" type="button" name="submit_add2"
                     id="submit_add2" style="display:none; cursor: no-drop;" disabled>
                     <img src="../../asset/dist/img/Rolling-0.6s-200px.gif" width="30">
              </button>
            
       </form>
</footer>

<script>
function HrmsValidationForm() {
       $('#submit_add').hide();
       $('#submit_add2').show();
}
</script>