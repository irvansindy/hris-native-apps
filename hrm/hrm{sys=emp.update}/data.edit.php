<?php
$country = '';
$query = "SELECT country_id,country_name FROM tgemcountry GROUP BY country_code ORDER BY country_code ASC";
$result = mysqli_query($connect, $query);
while($row = mysqli_fetch_array($result))
{
 $country .= '<option value="'.$row["country_id"].'">'.$row["country_name"].'</option>';
}
?>

<?php include "../../model/val/GMValidationForm.php";?>

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
                                          iw.name_en as faculty_name,
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
                                   LEFT JOIN hrmnationality e on b.nationality_code=e.nationality_code
                                   LEFT JOIN mgtools_teodempaddress f on f.emp_id=b.emp_id and f.addresstype_code='B'
                                   LEFT JOIN mgtools_teodempaddress g on g.emp_id=b.emp_id and g.addresstype_code='A'
                                   LEFT JOIN mgtools_tpydempbank h on h.emp_id=a.emp_id
                                   LEFT JOIN mgtools_teodempeducation i on a.emp_id=i.emp_id
                                   LEFT JOIN hrmcity ix on ix.city_id=i.city
                                   LEFT JOIN TEOMFACULTY iw on iw.code=i.faculty

                                   LEFT JOIN hrmeduinstitution iz on iz.edu_code=i.edu_name
                                   LEFT JOIN view_employee j on a.emp_id=j.emp_id

                                   -- SECTION1
                                   LEFT JOIN hrmcountry gaa on g.country_id=gaa.country_id
                                   LEFT JOIN hrmstate gab on g.state_id=gab.state_id
                                   LEFT JOIN hrmcity gac on g.city_id=gac.city_id
                                   LEFT JOIN hrmdistrict gad on g.district=gad.district_id
                                   LEFT JOIN hrmsubdistrict gae on g.subdistrict=gae.subdistrict_id
                                   -- SECTION1
                                   LEFT JOIN hrmcountry faa on f.country_id=faa.country_id
                                   LEFT JOIN hrmstate fab on f.state_id=fab.state_id
                                   LEFT JOIN hrmcity fac on f.city_id=fac.city_id
                                   LEFT JOIN hrmdistrict fad on f.district=fad.district_id
                                   LEFT JOIN hrmsubdistrict fae on f.subdistrict=fae.subdistrict_id
                                   
                                
                                   WHERE j.emp_no  = '$rfid'");
$no = 0;
$no++;
while ($r = mysqli_fetch_array($sql)) {
?>

<?php
$get_cek_file    = mysqli_query($connect, "SELECT a.id,a.document_file,a.attachment,a.ext FROM mgtools_attachment a WHERE a.emp_id = '$username' and a.document_file = '1'");
$get_cek_file_r  = mysqli_fetch_array($get_cek_file);
if(mysqli_num_rows($get_cek_file) != '0'){
       $any_id = $get_cek_file_r['id'];
       $any_docf = $get_cek_file_r['document_file'];
       $any_file = $get_cek_file_r['attachment'];
       $ext_file = $get_cek_file_r['ext'];
       
       
       if($ext_file == 'pdf'){
              $attch = "<span id='uploaded_image_exist'><img style='width: 10%;;margin-bottom: 20px;' src='uploaded_files/pngs.png' height='150' width='225' class='img-thumbnail'/></span>'";   
              $img = "uploaded_files/pngs.png";
       } else {
              $attch = '<img style="width: 10%;;margin-bottom: 20px;min-height: 115px;" src="../../asset/list_document/'.$any_file.'" height="425" width="425" class="img-thumbnail" />';
              $img = '../../asset/list_document/'.$any_file.'';
       }

       $openFile = "<a href='#' type='submit' class='btn btn-submit open_modal_search' style='background: darkcyan;font-weight: 500;font-size: 14px;margin: 5px 0px 5px 0px;width: 100%;color: white;'>Lihat File
       <svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-image feather-sm'><rect x='3' y='3' width='18' height='18' rx='2' ry='2'></rect><circle cx='8.5' cy='8.5' r='1.5'></circle><polyline points='21 15 16 10 5 21'></polyline></svg></a>";

} else {

       $any_file = '';
       $attch = "";
       $openFile = "";

}

$get_cek_file2    = mysqli_query($connect, "SELECT a.id,a.document_file,a.attachment,a.ext FROM mgtools_attachment a WHERE a.emp_id = '$username' and a.document_file = '2'");
$get_cek_file2_r  = mysqli_fetch_array($get_cek_file2);
if(mysqli_num_rows($get_cek_file2) != '0'){
       $any_id2 = $get_cek_file2_r['id'];
       $any_docf2 = $get_cek_file2_r['document_file'];
       $any_file2 = $get_cek_file2_r['attachment'];
       $ext_file = $get_cek_file2_r['ext'];

       if($ext_file == 'pdf'){
              $attch2 = "<span id='uploaded_image_exist'><img style='width: 10%;;margin-bottom: 20px;' src='uploaded_files/pngs.png' height='150' width='225' class='img-thumbnail'/></span>'";   
              $img2 = "uploaded_files/pngs.png";
       } else {
              $attch2 = '<img style="width: 10%;;margin-bottom: 20px;min-height: 115px;" src="../../asset/list_document/'.$any_file2.'" height="425" width="425" class="img-thumbnail" />';
              $img2 = '../../asset/list_document/'.$any_file2.'';
       }

       $openFile2 = "<a href='#' type='submit' class='btn btn-submit open_modal_search2' style='background: darkcyan;font-weight: 500;font-size: 14px;margin: 5px 0px 5px 0px;width: 100%;color: white;'>Lihat File
       <svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-image feather-sm'><rect x='3' y='3' width='18' height='18' rx='2' ry='2'></rect><circle cx='8.5' cy='8.5' r='1.5'></circle><polyline points='21 15 16 10 5 21'></polyline></svg></a>";

} else {
       $any_file2 = '';
       $attch2 = "";
       $openFile2 = "";
}

$get_cek_file3    = mysqli_query($connect, "SELECT a.id,a.document_file,a.attachment,a.ext FROM mgtools_attachment a WHERE a.emp_id = '$username' and a.document_file = '3'");
$get_cek_file3_r  = mysqli_fetch_array($get_cek_file3);
if(mysqli_num_rows($get_cek_file3) != '0'){
       $any_id3 = $get_cek_file3_r['id'];
       $any_docf3 = $get_cek_file3_r['document_file'];
       $any_file3 = $get_cek_file3_r['attachment'];
       $ext_file = $get_cek_file3_r['ext'];

       if($ext_file == 'pdf'){
              $attch3 = "<span id='uploaded_image_exist'><img style='width: 10%;;margin-bottom: 20px;' src='uploaded_files/pngs.png' height='150' width='225' class='img-thumbnail'/></span>'";   
              $img3 = "uploaded_files/pngs.png";
       } else {
              $attch3 = '<img style="width: 10%;;margin-bottom: 20px;min-height: 115px;" src="../../asset/list_document/'.$any_file3.'" height="425" width="425" class="img-thumbnail" />';
              $img3 = '../../asset/list_document/'.$any_file3.'';
       }

       $openFile3 = "<a href='#' type='submit' class='btn btn-submit open_modal_search3' style='background: darkcyan;font-weight: 500;font-size: 14px;margin: 5px 0px 5px 0px;width: 100%;color: white;'>Lihat File
       <svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-image feather-sm'><rect x='3' y='3' width='18' height='18' rx='2' ry='2'></rect><circle cx='8.5' cy='8.5' r='1.5'></circle><polyline points='21 15 16 10 5 21'></polyline></svg></a>";


} else {
       $any_file3 = '';
       $attch3 = "";
       $openFile3 = "";
}

$get_cek_file4    = mysqli_query($connect, "SELECT a.id,a.document_file,a.attachment,a.ext FROM mgtools_attachment a WHERE a.emp_id = '$username' and a.document_file = '4'");
$get_cek_file4_r  = mysqli_fetch_array($get_cek_file4);
if(mysqli_num_rows($get_cek_file4) != '0'){
       $any_id4 = $get_cek_file4_r['id'];
       $any_docf4 = $get_cek_file4_r['document_file'];
       $any_file4 = $get_cek_file4_r['attachment'];
       $ext_file = $get_cek_file4_r['ext'];

       if($ext_file == 'pdf'){
              $attch4 = "<span id='uploaded_image_exist'><img style='width: 10%;;margin-bottom: 20px;' src='uploaded_files/pngs.png' height='150' width='225' class='img-thumbnail'/></span>'";   
              $img4 = "uploaded_files/pngs.png";
       } else {
              $attch4 = '<img style="width: 10%;;margin-bottom: 20px;min-height: 115px;" src="../../asset/list_document/'.$any_file4.'" height="425" width="425" class="img-thumbnail" />';
              $img4 = '../../asset/list_document/'.$any_file4.'';
       }
       
       $openFile4 = "<a href='#' type='submit' class='btn btn-submit open_modal_search4' style='background: darkcyan;font-weight: 500;font-size: 14px;margin: 5px 0px 5px 0px;width: 100%;color: white;'>Lihat File
       <svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-image feather-sm'><rect x='3' y='3' width='18' height='18' rx='2' ry='2'></rect><circle cx='8.5' cy='8.5' r='1.5'></circle><polyline points='21 15 16 10 5 21'></polyline></svg></a>";


} else {
       $any_file4 = '';
       $attch4 = "";
       $openFile4 = "";
}

$get_cek_file5    = mysqli_query($connect, "SELECT a.id,a.document_file,a.attachment,a.ext FROM mgtools_attachment a WHERE a.emp_id = '$username' and a.document_file = '5'");
$get_cek_file5_r  = mysqli_fetch_array($get_cek_file5);
if(mysqli_num_rows($get_cek_file5) != '0'){
       $any_id5 = $get_cek_file5_r['id'];
       $any_docf5 = $get_cek_file5_r['document_file'];
       $any_file5 = $get_cek_file5_r['attachment'];
       $ext_file = $get_cek_file5_r['ext'];

       if($ext_file == 'pdf'){
              $attch5 = "<span id='uploaded_image_exist'><img style='width: 10%;;margin-bottom: 20px;' src='uploaded_files/pngs.png' height='150' width='225' class='img-thumbnail'/></span>'";   
              $img5 = "uploaded_files/pngs.png";
       } else {
              $attch5 = '<img style="width: 10%;;margin-bottom: 20px;min-height: 115px;" src="../../asset/list_document/'.$any_file5.'" height="525" width="525" class="img-thumbnail" />';
              $img5 = '../../asset/list_document/'.$any_file5.'';
       }
       
       $openFile5 = "<a href='#' type='submit' class='btn btn-submit open_modal_search5' style='background: darkcyan;font-weight: 500;font-size: 15px;margin: 5px 0px 5px 0px;width: 100%;color: white;'>Lihat File
       <svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' viewBox='0 0 25 25' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-image feather-sm'><rect x='3' y='3' width='18' height='18' rx='2' ry='2'></rect><circle cx='8.5' cy='8.5' r='1.5'></circle><polyline points='21 15 16 10 5 21'></polyline></svg></a>";


} else {
       $any_file5 = '';
       $attch5 = "";
       $openFile5 = "";
}
?>



<!-- Google Font -->
<link rel="stylesheet" href="asset/css.css">

<!-- Font-Awesome Stylesheet -->
<link rel="stylesheet" href="asset/font-awesome.css">


<!-- Plugin Custom Stylesheet -->
<link rel="stylesheet" href="asset/form-wizard-blue.css">
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
                                   <form action="../hrm{sys=emp.update}/" method="POST">
                                          <input class="form-control" id="rfid"
                                                        style="text-transform:uppercase"
                                                        name="rfid" type="hidden" 
                                                        value="<?php echo $rfid; ?>">

                                          
                                                        <button type="submit" name=''
                                                               class="btn btn-submit"><div
                                                 class="toolbar sprite-toolbar-back" id="back" title="back"></div></button>

                                   </form>

                                   <a href='#' class='open_modal_search'>
                                          
                                   </a>
                            </td>
                            <td>
                                   <h4 class="card-title mb-0">Employee Information</h4>
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
                            <form action="summarized" name='form1' method="post" id="multiple_upload_form" enctype="multipart/form-data"
                                   onsubmit='return HrmsValidationForm()' class="form-user">

                                   <?php
                                   $is_hidden_v09 = ''; // SET AS '' if you want running code
                                   ?>
                                   <input type="hidden<?php echo $is_hidden_v09; ?>" name="lastreqno" value="<?php echo $rfid; ?>">
                                   <input type="hidden<?php echo $is_hidden_v09; ?>" name="empbank_id" value="<?php echo $r['empbank_id']; ?>">


                                  
                                          <h3>PEMUTAKHIRAN DATA KARYAWAN</h3>
                                          <p>PT. Gajah Tunggal Tbk.</p>

                                          <!-- Form progress -->
                                          <div class="form-wizard-steps form-wizard-tolal-steps-4">
                                                 <div class="form-wizard-progress">
                                                        <div class="form-wizard-progress-line" data-now-value="16.25"
                                                               data-number-of-steps="6" style="width: 16.25%;"></div>
                                                 </div>
                                                 <!-- Step 1 -->
                                                 <div class="form-wizard-step active" style="width: 16%;">
                                                        <div class="form-wizard-step-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home feather-sm"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></div>
                                                        <!-- <p>Personal Information </p> -->
                                                 </div>
                                                 <!-- Step 1 -->

                                                 <!-- Step 2 -->
                                                 <div class="form-wizard-step" style="width: 16%;">
                                                        <div class="form-wizard-step-icon"><i class="fa fa-university"
                                                                      aria-hidden="true"></i></div>
                                                        <!-- <p>Bank Account </p> -->
                                                 </div>
                                                 <!-- Step 2 -->

                                                 <!-- Step 3 -->
                                                 <div class="form-wizard-step" style="width: 16%;">
                                                        <div class="form-wizard-step-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-sun feather-sm"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg></div>
                                                        <!-- <p>Education </p> -->
                                                 </div>
                                                 <!-- Step 3 -->

                                                 <!-- Step 4 -->
                                                 <div class="form-wizard-step" style="width: 16%;">
                                                        <div class="form-wizard-step-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone-call feather-sm"><path d="M15.05 5A5 5 0 0 1 19 8.95M15.05 1A9 9 0 0 1 23 8.94m-1 7.98v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg></div>
                                                        <!-- <p>Emergency Contact </p> -->
                                                 </div>
                                                 <!-- Step 4 -->

                                                 <!-- Step 5 -->
                                                 <div class="form-wizard-step" style="width: 16%;">
                                                        <div class="form-wizard-step-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list feather-sm"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3" y2="6"></line><line x1="3" y1="12" x2="3" y2="12"></line><line x1="3" y1="18" x2="3" y2="18"></line></svg></div>
                                                        <!-- <p>Family & Dependent </p> -->
                                                 </div>
                                                 <!-- Step 5 -->

                                                 <!-- Step 4 -->
                                                 <div class="form-wizard-step" style="width: 16%;">
                                                        <div class="form-wizard-step-icon"><i class="fa fa-file-text"
                                                                      aria-hidden="true"></i></div>
                                                     
                                                 </div>
                                                 <!-- Step 4 -->
                                          </div>
                                          <!-- Form progress -->



























































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
                                                 <h4>Informasi Pribadi : <span>Langkah 1 - 6</span></h4>

                                                 


       

       


                                                 <label>Nomor Induk Karyawan (NIP) <?php echo $field_flag2; ?> : </label>
                                                 <div class="form-row" style="padding: 0px 1px 1px 1px;">
                                                        <div class="col-sm-12" style="padding-bottom:5px">
                                                               <div class="input-group">

                                                                     
                                                                      <input class="form-control"
                                                                             style="text-transform:uppercase;background-color: transparent;border: solid 1px transparent;"
                                                                             type="Text" 
                                                                             id="<?php echo $field_name2; ?>"
                                                                             value="<?php echo $rfid; ?>"
                                                                             onfocus="hlentry(this)" size="20" maxlength="50"
                                                                              validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title=""
                                                                             placeholder="Employee Number"
                                                                             disabled="disabled"
                                                                             >
                                                               </div>
                                                        </div>
                                                 </div>

                                                 <div class="form-group">
                                                        <label>Tanggal Masuk Bekerja <span>*</span> : </label>
                                                        <input type="empno" name="join_date" placeholder="join_date"
                                                               value="<?php echo date("Y-m-d", strtotime($r['start_date'])); ?>"
                                                               class="form-control" 
                                                               style="text-transform:uppercase;background-color: transparent;border: solid 1px transparent;"
                                                               disabled="disabled">
                                                 </div>

                                                 <div class="form-row" style="padding: 0px 1px 1px 1px;">
                                                        <div class="col-sm-4" style="padding-bottom:5px">
                                                        <label>Nama Awal <?php echo $field_flag1; ?> : </label>
                                                               <div class="input-group">

                                                                      <input class="form-control" 
                                                                             id="<?php echo $field_name1; ?>"
                                                                             style="text-transform: uppercase"
                                                                             name="inp_first_name" type="Text" 
                                                                             value="<?php echo strtoupper($r['first_name']); ?>"
                                                                             onfocus="hlentry(this)" size="20" maxlength="50"
                                                                              validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title=""
                                                                             placeholder="Silahkan Isi Nama Awal"
                                                                             >
                                                               </div>
                                                        </div>
                                                        
                                                        <div class="col-sm-4" style="padding-bottom:5px">
                                                        <label>Nama Tengah : </label>
                                                               <div class="input-group">

                                                                      <input class="form-control" id="inp_middle_name"
                                                                             style="text-transform: uppercase"
                                                                             name="inp_middle_name" type="Text" 
                                                                             value="<?php echo strtoupper($r['middle_name']); ?>"
                                                                             onfocus="hlentry(this)" size="20" maxlength="50"
                                                                              validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title=""
                                                                             placeholder="Silahkan isi nama tengah">
                                                               </div>
                                                        </div>
                                                        <div class="col-sm-4" style="padding-bottom:5px">
                                                               <div class="input-group">
                                                               <label>Nama Belakang : </label>
                                                                      <input class="form-control" id="inp_last_name"
                                                                             style="text-transform: uppercase"
                                                                             name="inp_last_name" type="Text" 
                                                                             value="<?php echo strtoupper($r['last_name']); ?>"
                                                                             onfocus="hlentry(this)" size="20" maxlength="50"
                                                                              validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title=""
                                                                             placeholder="Silahkan isi nama belakang">
                                                               </div>
                                                        </div>
                                                 </div>

                                                
                                                 

                                                 <label>Tempat /Tgl.Lahir (Isi sesuai Ijasah) <?php echo $field_flag3; ?> : </label>
                                                 <div class="form-row" style="padding: 0px 1px 1px 1px;">
                                                        <div class="col-sm-5" style="padding-bottom:5px">
                                                               <div class="input-group">
                                                                      <input class="form-control" 
                                                                             style="text-transform: uppercase"
                                                                             name="inp_birthplace" type="Text"
                                                                             id="<?php echo $field_name3; ?>"
                                                                             value="<?php echo strtoupper($r['birthplace']); ?>"
                                                                             onfocus="hlentry(this)" size="20" maxlength="50"
                                                                              validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title=""
                                                                             placeholder="Silahkan isi tempat lahir">
                                                               </div>
                                                        </div>
                                                        <div class="col-sm-3" style="padding-bottom:5px">
                                                               <div class="input-group">
                                                                      <input type="text" 
                                                                             id="<?php echo $field_name4; ?>"
                                                                             value="<?php echo date("Y-m-d", strtotime($r['birthdate'])); ?>"
                                                                             class="form-control" name="inp_birthdate" style="
                                                                             background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                             background-size: 17px;
                                                                             background-position:right;   
                                                                             background-repeat:no-repeat; 
                                                                             padding-right:20px;"
                                                                             placeholder="Silahkan pilih tanggal lahir"/>
                                                               </div>
                                                        </div>
                                                 </div>

                                                 <div class="form-group">
                                                        <label>NIK (Nomor KTP) <?php echo $field_flag5; ?> : </label>
                                                        <input type="empno" name="inp_id_number" 
                                                               id="<?php echo $field_name5; ?>" 
                                                               value="<?php echo $r['identity_no'] ?>"
                                                               class="form-control" 
                                                               style="text-transform:uppercase"
                                                               placeholder="Silahkan isi nomor ktp">
                                                 </div>

                                                 <div class="form-group">
                                                        <label>Nomor Kartu Keluarga (KK) <?php echo $field_flag6; ?> : </label>
                                                        <input type="empno" name="inp_family_number"
                                                               id="<?php echo $field_name6; ?>"
                                                               value="<?php echo $r['customfield16'] ?>"
                                                               class="form-control" style="text-transform:uppercase"
                                                               placeholder="Silahkan isi nomor kartu keluarga">
                                                 </div>

                                                 <div class="form-group">
                                                        <label>Jenis Kelamin <?php echo $field_flag7; ?> : </label>
                                                        <?php
                                                        $gender = $r['gender'];
                                                        if($gender == '1'){
                                                               $value_gender = '1';
                                                               $text_gender = 'Laki Laki';
                                                        } else {
                                                               $value_gender = '0';
                                                               $text_gender = 'Perempuan';
                                                        }
                                                        ?>
                                                        <select name="inp_gender"
                                                               id="<?php echo $field_name7; ?>"
                                                               placeholder="Silahkan pilih jenis kelamin"
                                                               class="form-control"
                                                               style="text-transform:uppercase">
                                                               <option value="<?php echo $value_gender; ?>">
                                                                      <?php echo $text_gender; ?></option>
                                                               <option value="1">Laki Laki</option>
                                                               <option value="0">Perempuan</option>
                                                        </select>
                                                 </div>

                                                 <div class="form-group">
                                                        <label>Golongan Darah <?php echo $field_flag8; ?> : </label>
                                                        <select name="inp_blood_type" 
                                                               id="<?php echo $field_name8; ?>" 
                                                               placeholder="Silahkan pilih golongan darah"
                                                               class="form-control" style="text-transform:uppercase">
                                                               <option value="<?php echo $r['bloodtype'];?>">
                                                               <?php echo $r['bloodtype'];?></option>
                                                               <option value="A">A</option>
                                                               <option value="B">B</option>
                                                               <option value="AB">AB</option>
                                                               <option value="O">O</option>
                                                        </select>
                                                 </div>

                                                 <div class="form-group">
                                                        <label>Agama <?php echo $field_flag9; ?> : </label>
                                                        <?php
                                                        $religion = $r['religion_code'];
                                                        if($religion == 'BUDH'){
                                                               $text_religion = 'Budha';
                                                        } elseif($religion == 'CATH') {
                                                               $text_religion = 'Katolik';
                                                        } elseif($religion == 'CHRS') {
                                                               $text_religion = 'Kristen';
                                                        } elseif($religion == 'HNDU') {
                                                               $text_religion = 'Hindu';
                                                        } elseif($religion == 'ISLM') {
                                                               $text_religion = 'Islam';
                                                        } elseif($religion == 'KHCU') {
                                                               $text_religion = 'Konghucu';
                                                        } elseif($religion == 'OTHR') {
                                                               $text_religion = 'Lainnya';
                                                        } else {
                                                               $text_religion = '';
                                                        }
                                                        ?>
                                                        <select name="inp_religion" 
                                                               id="<?php echo $field_name9; ?>" 
                                                               placeholder="Silahkan pilih agama"
                                                               class="form-control" style="text-transform:uppercase">
                                                               <option value="<?php echo $r['religion_code']; ?>"><?php echo $text_religion; ?></option>
                                                               <option value="ISLM">Islam</option>
                                                               <option value="CHRS">Kristen</option>
                                                               <option value="KTLK">Katolik</option>
                                                               <option value="HNDU">Hindu</option>
                                                               <option value="BUDH">Budha</option>
                                                               <option value="KHCU">Kong Hu Cu</option>
                                                               <option value="OTHER">Lainnya</option>
                                                        </select>
                                                 </div>




                                                 <div class="form-group">
                                                        <label>Status Perkawinan <?php echo $field_flag10; ?> </label>
                                                        <?php
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
                                                        <select name="inp_marital_status" 
                                                               id="<?php echo $field_name10; ?>" 
                                                               placeholder="Silahkan pilih status perkawinan"
                                                               class="form-control select2bs4 id" style="text-transform:uppercase">
                                                               <option value="<?php echo $r['maritalstatus']; ?>">
                                                               <?php echo $text_gender;?></option>
                                                               <option value="1">Kawin</option>
                                                               <option value="0">Belum Kawin</option>
                                                               <option value="2">Duda</option>
                                                               <option value="3">Janda</option>
                                                        </select>
                                                 </div>

                                                 <div class="form-group">
                                                        <label>Kebangsaan <?php echo $field_flag11; ?> : </label>
                                                        <select name="inp_nationality" 
                                                               id="<?php echo $field_name11; ?>" 
                                                               placeholder="Silahkan pilih kebangsaan"
                                                               class="form-control selectNationality  select2bs4 id"
                                                               style="width:100%; background: #f8f8f8 none repeat scroll 0 0;"
                                                               id="selectNationality">
                                                               <option value="<?php echo $r['nationality_code'];?>">
                                                                      <?php echo $r['nationality_name_en'];?></option>
                                                        </select>
                                                 </div>



                                                 <div class="form-group">
                                                        <label>Kontak Karyawan [No Handphone] <?php echo $field_flag12; ?> : </label>
                                                        <input type="text" 
                                                               name="inp_phone"
                                                               id="<?php echo $field_name12; ?>" 
                                                               placeholder="Silahkan isi nomor telepon"
                                                               value="<?php echo $r['no_phone'];?>" class="form-control"
                                                               style="text-transform:uppercase">
                                                 </div>

                                                 <div class="form-group">
                                                        <label>Kontak Karyawan [Email] <?php echo $field_flag13; ?> : </label>
                                                        <input type="text" 
                                                               name="inp_email"
                                                               id="<?php echo $field_name13; ?>" 
                                                               placeholder="Silahkan masukkan email"
                                                               value="<?php echo $r['email'];?>" class="form-control"
                                                               style="text-transform:uppercase">
                                                 </div>

                                                 <div class="form-group">
                                                        <label>Kontak Karyawan [Email Pribadi] <?php echo $field_flag13; ?> : </label>
                                                        <input type="text" 
                                                               name="inp_email_personal"
                                                               id="inp_email_personal" 
                                                               placeholder="Silahkan masukkan email pribadi"
                                                               value="<?php echo $r['customfield15'];?>" class="form-control"
                                                               style="text-transform:uppercase">
                                                 </div>

                                     
                                                 
                                                 































<!-- SECTION ALAMAT SESUAI DOMISILI -->
                                                 <!-- SECTION ALAMAT SESUAI DOMISILI -->
                                                 <div class="form-group" style="margin-top: 10px;">
                                                        <label>Alamat Lengkap <span class='badge badge-Partially-Approved' style="color: white;font-weight: bold;font-size: 12px;margin-bottom: 5px;width: auto;"> ( Sesuai KTP ) </span></label>
                                                        <textarea style="height: 100px;" rows="4" name="inp_domisili_address"
                                                               placeholder="Alamat Lengkap (Sesuai KTP)"
                                                               class="form-control"
                                                               style="text-transform:uppercase"><?php echo $r['domisili_address'];?></textarea>
                                                 </div>

                                                 <div class="form-group">
                                                        <label>Kode Pos  <span class='badge badge-Partially-Approved' style="color: white;font-weight: bold;font-size: 12px;margin-bottom: 5px;width: auto;"> ( Sesuai KTP ) </span></label>
                                                        <input type="text" name="inp_domisili_postalcode"
                                                               placeholder="Kode Pos (Sesuai KTP)"
                                                               value="<?php echo $r['domisili_zipcode'];?>"
                                                               class="form-control" style="text-transform:uppercase">
                                                 </div>

                                                 <div class="form-row" style="padding: 0px 1px 1px 1px;">
                                                        <div class="col-sm-4" style="padding-bottom:5px">
                                                        <label>Negara <span>*</span> : </label>
                                                               <div class="input-group">
                                                                      <select name="inp_domisili_country" id="domisili_country" class="form-control action_domisili select2bs4 id">
                                                                             <option value="<?php !empty($r['domisili_country_id']) ? $domisili_country_id = $r['domisili_country_id'] : $domisili_country_id = ''; echo $domisili_country_id; ?>">
                                                                             <?php !empty($r['domisili_country_name']) ? $domisili_country_name = $r['domisili_country_name'] : $domisili_country_name = 'Pilih Negara'; echo $domisili_country_name; ?></option>
                                                                             <?php echo $country; ?>
                                                                      </select>
                                                               </div>
                                                        </div>
                                                        
                                                        <div class="col-sm-3" style="padding-bottom:5px">
                                                               <label>Provinsi <span>*</span> : </label>
                                                                      <div class="input-group">
                                                                             <select name="inp_domisili_state" id="domisili_state" class="form-control action_domisili select2bs4 id">
                                                                                    <option value="<?php !empty($r['domisili_state_id']) ? $domisili_state_id = $r['domisili_state_id'] : $domisili_state_id = ''; echo $domisili_state_id; ?>">
                                                                                    <?php !empty($r['domisili_state_name']) ? $domisili_state_name = $r['domisili_state_name'] : $domisili_state_name = 'Pilih Provinsi'; echo $domisili_state_name; ?></option>
                                                                                    <?php !empty($r['domisili_country_id']) ? $where_country_id = "WHERE country_id = '$r[domisili_country_id]'" : $where_country_id = '';?>
                                                                                    <?php
                                                                                    $get_state = mysqli_query($connect, "SELECT state_id,state_name FROM hrmstate $where_country_id");
                                                                                    if(mysqli_num_rows($get_state) != 0){
                                                                                           while($row_state = mysqli_fetch_array($get_state)){
                                                                                                  echo '<option value='.$row_state['state_id'].'>'.$row_state['state_name'].'</option>';
                                                                                           }
                                                                                    }
                                                                                    ?>
                                                                             </select>
                                                                      </div>
                                                        </div>
                                                        <div class="col-sm-3" style="padding-bottom:5px">
                                                                      <div class="input-group">
                                                                      <label>Kota / Kabupaten <span>*</span> : </label>
                                                                             <select name="inp_domisili_city" id="domisili_city" class="form-control action_domisili select2bs4 id">
                                                                                    <option value="<?php !empty($r['domisili_city_id']) ? $domisili_city_id = $r['domisili_city_id'] : $domisili_city_id = ''; echo $domisili_city_id; ?>">
                                                                                    <?php !empty($r['domisili_city_name']) ? $domisili_city_name = $r['domisili_city_name'] : $domisili_city_name = 'Pilih Kota / Kabupaten'; echo $domisili_city_name; ?></option>
                                                                                    <?php !empty($r['domisili_state_id']) ? $where_state_id = "WHERE state_id = '$r[domisili_state_id]'" : $where_state_id = '';?> 
                                                                                    <?php
                                                                                    $get_city = mysqli_query($connect, "SELECT city_id,city_name FROM hrmcity $where_state_id");
                                                                                    if(mysqli_num_rows($get_city) != 0){
                                                                                           while($row_city = mysqli_fetch_array($get_city)){
                                                                                                  echo '<option value='.$row_city['city_id'].'>'.$row_city['city_name'].'</option>';
                                                                                           }
                                                                                    }
                                                                                    ?>
                                                                             </select>
                                                        </div>
                                                        </div>

                                                        <div class="col-sm-1" style="padding-bottom:5px">
                                                                      <div class="input-group">
                                                                      <label>RT <span>*</span> : </label>
                                                                      <input type="text" name="inp_domisili_rt" placeholder="RT"
                                                                             value="<?php echo $r['domisili_rt'];?>" class="form-control"
                                                                             style="text-transform:uppercase">
                                                        </div>
                                                        </div>

                                                        <div class="col-sm-1" style="padding-bottom:5px">
                                                                      <div class="input-group">
                                                                      <label>RW <span>*</span> : </label>
                                                                      <input type="text" name="inp_domisili_rw" placeholder="RW"
                                                                             value="<?php echo $r['domisili_rw'];?>" class="form-control"
                                                                             style="text-transform:uppercase">
                                                        </div>
                                                        </div>
                                                 </div>

                                                 <div class="form-row" style="padding: 0px 1px 1px 1px;">
                                                        <div class="col-sm-6" style="padding-bottom:5px">
                                                        <label>Kecamatan <span>*</span> : </label>
                                                               <div class="input-group">
                                                                      <select name="inp_domisili_district" id="domisili_district" class="form-control action_domisili select2bs4">
                                                                             <option value="<?php !empty($r['domisili_district_id']) ? $domisili_district_id = $r['domisili_district_id'] : $domisili_district_id = ''; echo $domisili_district_id; ?>">
                                                                             <?php !empty($r['domisili_district_name']) ? $domisili_district_name = $r['domisili_district_name'] : $domisili_district_name = 'Pilih Keacamatan'; echo $domisili_district_name;?></option>
                                                                             <?php !empty($r['domisili_city_id']) ? $where_city_id = "WHERE city_id = '$r[domisili_city_id]'" : $where_city_id = '';?> 
                                                                             <?php
                                                                             $get_district = mysqli_query($connect, "SELECT district_id,district_name FROM hrmdistrict $where_city_id");
                                                                             if(mysqli_num_rows($get_district) != 0){
                                                                                    while($row_district = mysqli_fetch_array($get_district)){
                                                                                           echo '<option value='.$row_district['district_id'].'>'.$row_district['district_name'].'</option>';
                                                                                    }
                                                                             }
                                                                             ?>
                                                                      </select>
                                                               </div>
                                                        </div>
                                                        <div class="col-sm-6" style="padding-bottom:5px">
                                                        <label>Kelurahan <span>*</span> : </label>
                                                               <div class="input-group">
                                                                      <select name="inp_domisili_subdistrict" id="domisili_subdistrict" class="form-control select2bs4">
                                                                             <option value="<?php !empty($r['domisili_subdistrict_id']) ? $domisili_subdistrict_id = $r['domisili_subdistrict_id'] : $domisili_subdistrict_id = 'Pilih Keacamatan'; echo $domisili_subdistrict_id; ?>">
                                                                             <?php !empty($r['domisili_subdistrict_name']) ? $domisili_subdistrict_name = $r['domisili_subdistrict_name'] : $domisili_subdistrict_name = 'Pilih Keacamatan'; echo $domisili_subdistrict_name; ?></option>
                                                                             <?php !empty($r['domisili_district_id']) ? $where_district_id = "WHERE district_id = '$r[domisili_district_id]'" : $where_district_id = '';?> 
                                                                             <?php
                                                                             $get_subdistrict = mysqli_query($connect, "SELECT subdistrict_id,subdistrict_name FROM hrmsubdistrict $where_district_id");
                                                                             if(mysqli_num_rows($get_subdistrict) != 0){
                                                                                    while($row_subdistrict = mysqli_fetch_array($get_subdistrict)){
                                                                                           echo '<option value='.$row_subdistrict['subdistrict_id'].'>'.$row_subdistrict['subdistrict_name'].'</option>';
                                                                                    }
                                                                             }
                                                                             ?>
                                                                      </select>
                                                               </div>
                                                        </div>
                                                 </div>

            
 

                                                 <script>
                                                        $(document).ready(function(){
                                                               $('.action_domisili').change(function(){
                                                               if($(this).val() != '')
                                                               {
                                                               var action_domisili = $(this).attr("id");
                                                               var query = $(this).val();
                                                               var result = '';
                                                               if(action_domisili == "domisili_country")
                                                               {
                                                               result = 'domisili_state';
                                                               $('#domisili_city').html('<option value="">Pilih Kota</option>');
                                                               $('#domisili_district').html('<option value="">Pilih Kecamatan</option>');
                                                               $('#domisili_subdistrict').html('<option value="">Pilih Kelurahan</option>');
                                                               }
                                                               else if(action_domisili == "domisili_state")
                                                               {
                                                               result = 'domisili_city';
                                                               $('#domisili_district').html('<option value="">Pilih Kecamatan</option>');
                                                               $('#domisili_subdistrict').html('<option value="">Pilih Kelurahan</option>');
                                                               }
                                                               else if(action_domisili == "domisili_city")
                                                               {
                                                               result = 'domisili_district';
                                                               $('#domisili_subdistrict').html('<option value="">Pilih Kelurahan</option>');
                                                               }
                                                               else
                                                               {
                                                               result = 'domisili_subdistrict';
                                                               }
                                                               $.ajax({
                                                               url:"fetching/fetch_dynamic_country_city_state_2.php",
                                                               method:"POST",
                                                               data:{action_domisili:action_domisili, query:query},
                                                               success:function(data){
                                                                      $('#'+result).html(data);
                                                                      $('#'+result2).html(data);
                                                               }
                                                               })
                                                               }
                                                               });
                                                        });
                                                 </script>
                                                 <!-- SECTION ALAMAT SESUAI DOMISILI -->
                                                 <!-- SECTION ALAMAT SESUAI DOMISILI -->














                                                 
                                                 
                                                 <!-- SECTION ALAMAT SESUAI KTP -->
                                                 <!-- SECTION ALAMAT SESUAI KTP -->
                                                 <div class="form-group">
                                                        <label>Alamat Lengkap <span class='badge badge-Partially-Approved' style="color: white;font-weight: bold;font-size: 12px;margin-bottom: 5px;width: auto;background-color: #10aaaa;"> ( Sesuai Domisili ) </span> <span>**</span> : </label>
                                                        
                                                        <textarea style="height: 100px;" rows="4" id="inp_ktp_address"
                                                               name="inp_ktp_address"
                                                               placeholder="Silahkan isi Alamat Lengkap (Sesuai Domisili)"
                                                               class="form-control" style="text-transform:uppercase"
                                                               oninput="FunctionAddress(this.value)"><?php echo $r['ktp_address'];?></textarea>
                                                 </div>

                                                 <div class="form-group">
                                                        <label>Kode Pos <span class='badge badge-Partially-Approved' style="color: white;font-weight: bold;font-size: 12px;margin-bottom: 5px;width: auto;background-color: #10aaaa;"> ( Sesuai Domisili ) </span>  <span>**</span> : </label>
                                                        <input type="text" id="inp_ktp_postalcode" name="inp_ktp_postalcode"
                                                               placeholder="Kode Pos (Sesuai Domisili)"
                                                               value="<?php echo $r['ktp_zipcode'];?>"
                                                               class="form-control" style="text-transform:uppercase">
                                                 </div>

                                                 <div class="form-row" style="padding: 0px 1px 1px 1px;">
                                                        <div class="col-sm-4" style="padding-bottom:5px">
                                                        <label>Negara <span>*</span> : </label>
                                                               <div class="input-group">
                                                                      <select name="inp_ktp_country" id="country" class="form-control  select2bs4 action">
                                                                             <option value="<?php !empty($r['ktp_country_id']) ? $ktp_country_id = $r['ktp_country_id'] : $ktp_country_id = ''; echo $ktp_country_id; ?>">
                                                                             <?php !empty($r['ktp_country_name']) ? $ktp_country_name = $r['ktp_country_name'] : $ktp_country_name = 'Pilih Negara'; echo $ktp_country_name; ?></option>
                                                                             <?php echo $country; ?>
                                                                      </select>
                                                               </div>
                                                        </div>
                                                        
                                                        <div class="col-sm-3" style="padding-bottom:5px">
                                                               <label>Provinsi <span>*</span> : </label>
                                                                      <div class="input-group">
                                                                             <select name="inp_ktp_state" id="state" class="form-control  select2bs4 action">
                                                                                    <option value="<?php !empty($r['ktp_state_id']) ? $ktp_state_id = $r['ktp_state_id'] : $ktp_state_id = ''; echo $ktp_state_id; ?>">
                                                                                    <?php !empty($r['ktp_state_name']) ? $ktp_state_name = $r['ktp_state_name'] : $ktp_state_name = 'Pilih Provinsi'; echo $ktp_state_name; ?></option>
                                                                                    <?php
                                                                                    $get_state = mysqli_query($connect, "SELECT * FROM hrmstate");
                                                                                    if(mysqli_num_rows($get_state) != 0){
                                                                                           while($row_state = mysqli_fetch_array($get_state)){
                                                                                                  echo '<option value='.$row_state['state_id'].'>'.$row_state['state_name'].'</option>';
                                                                                           }
                                                                                    }
                                                                                    ?>
                                                                             </select>
                                                                      </div>
                                                        </div>
                                                        <div class="col-sm-3" style="padding-bottom:5px">
                                                                      <div class="input-group">
                                                                      <label>Kota / Kabupaten <span>*</span> : </label>
                                                                             <select name="inp_ktp_city" id="city" class="form-control  select2bs4 action">
                                                                                    <option value="<?php !empty($r['ktp_city_id']) ? $ktp_city_id = $r['ktp_city_id'] : $ktp_city_id = ''; echo $ktp_city_id; ?>">
                                                                                    <?php !empty($r['ktp_city_name']) ? $ktp_city_name = $r['ktp_city_name'] : $ktp_city_name = 'Pilih Kota / Kabupaten'; echo $ktp_city_name; ?></option>
                                                                                    <?php !empty($r['ktp_state_id']) ? $where_state_id = "WHERE state_id = '$r[ktp_state_id]'" : $where_state_id = '';?> 
                                                                                    <?php
                                                                                    $get_city = mysqli_query($connect, "SELECT city_id,city_name FROM hrmcity $where_state_id");
                                                                                    if(mysqli_num_rows($get_city) != 0){
                                                                                           while($row_city = mysqli_fetch_array($get_city)){
                                                                                                  echo '<option value='.$row_city['city_id'].'>'.$row_city['city_name'].'</option>';
                                                                                           }
                                                                                    }
                                                                                    ?>
                                                                             </select>
                                                        </div>
                                                        </div>

                                                        <div class="col-sm-1" style="padding-bottom:5px">
                                                                      <div class="input-group">
                                                                      <label>RT <span>*</span> : </label>
                                                                      <input type="text" name="inp_ktp_rt" placeholder="RT"
                                                                             value="<?php echo $r['ktp_rt'];?>" class="form-control"
                                                                             style="text-transform:uppercase">
                                                        </div>
                                                        </div>

                                                        <div class="col-sm-1" style="padding-bottom:5px">
                                                                      <div class="input-group">
                                                                      <label>RW <span>*</span> : </label>
                                                                      <input type="text" name="inp_ktp_rw" placeholder="RW"
                                                                             value="<?php echo $r['ktp_rw'];?>" class="form-control"
                                                                             style="text-transform:uppercase">
                                                        </div>
                                                        </div>
                                                 </div>

                                                        
                                                 <div class="form-row" style="padding: 0px 1px 1px 1px;">
                                                        <div class="col-sm-6" style="padding-bottom:5px">
                                                        <label>Kecamatan <span>*</span> : </label>
                                                               <div class="input-group">
                                                                      <select name="inp_ktp_district" id="district" class="form-control select2bs4 action">
                                                                             <option value="<?php !empty($r['ktp_district_id']) ? $ktp_district_id = $r['ktp_district_id'] : $ktp_district_id = ''; echo $ktp_district_id; ?>">
                                                                             <?php !empty($r['ktp_district_name']) ? $ktp_district_name = $r['ktp_district_name'] : $ktp_district_name = 'Pilih Keacamatan'; echo $ktp_district_name; ?></option>
                                                                             <?php !empty($r['ktp_city_id']) ? $where_city_id = "WHERE city_id = '$r[ktp_city_id]'" : $where_city_id = '';?> 
                                                                             <?php
                                                                             $get_district = mysqli_query($connect, "SELECT district_id,district_name FROM hrmdistrict $where_city_id");
                                                                             if(mysqli_num_rows($get_district) != 0){
                                                                                    while($row_district = mysqli_fetch_array($get_district)){
                                                                                           echo '<option value='.$row_district['district_id'].'>'.$row_district['district_name'].'</option>';
                                                                                    }
                                                                             }
                                                                             ?>
                                                                      </select>
                                                               </div>
                                                        </div>
                                                        <div class="col-sm-6" style="padding-bottom:5px">
                                                        <label>Kelurahan <span>*</span> : </label>
                                                               <div class="input-group">
                                                                      <select name="inp_ktp_subdistrict" id="subdistrict" class="form-control  select2bs4">
                                                                             <option value="<?php !empty($r['ktp_subdistrict_id']) ? $ktp_subdistrict_id = $r['ktp_subdistrict_id'] : $ktp_subdistrict_id = 'Pilih Keacamatan'; echo $ktp_subdistrict_id; ?>">
                                                                             <?php !empty($r['ktp_subdistrict_name']) ? $ktp_subdistrict_name = $r['ktp_subdistrict_name'] : $ktp_subdistrict_name = 'Pilih Keacamatan'; echo $ktp_subdistrict_name; ?></option>
                                                                             <?php !empty($r['ktp_district_id']) ? $where_district_id = "WHERE district_id = '$r[ktp_district_id]'" : $where_district_id = '';?> 
                                                                             <?php
                                                                             $get_subdistrict = mysqli_query($connect, "SELECT subdistrict_id,subdistrict_name FROM hrmsubdistrict $where_district_id");
                                                                             if(mysqli_num_rows($get_subdistrict) != 0){
                                                                                    while($row_subdistrict = mysqli_fetch_array($get_subdistrict)){
                                                                                           echo '<option value='.$row_subdistrict['subdistrict_id'].'>'.$row_subdistrict['subdistrict_name'].'</option>';
                                                                                    }
                                                                             }
                                                                             ?>
                                                                      </select>
                                                               </div>
                                                        </div>
                                                 </div>
                                                 <script>
                                                        $(document).ready(function(){
                                                               $('.action').change(function(){
                                                               if($(this).val() != '')
                                                               {
                                                               var action = $(this).attr("id");
                                                               var query = $(this).val();
                                                               var result = '';
                                                               if(action == "country")
                                                               {
                                                               result = 'state';
                                                               $('#city').html('<option value="">Pilih Kota</option>');
                                                               $('#district').html('<option value="">Pilih Kecamatan</option>');
                                                               $('#subdistrict').html('<option value="">Pilih Kelurahan</option>');
                                                               }
                                                               else if(action == "state")
                                                               {
                                                               result = 'city';
                                                               $('#district').html('<option value="">Pilih Kecamatan</option>');
                                                               $('#subdistrict').html('<option value="">Pilih Kelurahan</option>');
                                                               }
                                                               else if(action == "city")
                                                               {
                                                               result = 'district';
                                                               $('#subdistrict').html('<option value="">Pilih Kelurahan</option>');
                                                               }
                                                               else
                                                               {
                                                               result = 'subdistrict';
                                                               }
                                                               $.ajax({
                                                               url:"fetching/fetch_dynamic_country_city_state.php",
                                                               method:"POST",
                                                               data:{action:action, query:query},
                                                               success:function(data){
                                                               $('#'+result).html(data);
                                                               }
                                                               })
                                                               }
                                                               });
                                                        });
                                                 </script>
                                                 <!-- SECTION ALAMAT SESUAI KTP -->
                                                 <!-- SECTION ALAMAT SESUAI KTP -->







                                                 


































                                                 
                                                 <div class="form-wizard-buttons">
                                                        <button type="button" class="btn btn-next">Selanjutnya</button>
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
                                                 <h4>Informasi Bank : <span>Langkah 2 - 6</span></h4>
                                                
                                                 <div class="form-group">
                                                        <label>Nama Bank <span>*</span></label>

                                                        <select name="bank_code" placeholder="ID number"
                                                               class="form-control selectBanks"
                                                               style="width:100%; color: #9d9d9d; background: #f8f8f8 none repeat scroll 0 0;"
                                                               id="selectBanks">
                                                               <option value="<?php echo $r['bank_code'];?>">
                                                                      <?php echo $r['bank_code'];?></option>
                                                        </select>

                                                 </div>
                                                 <div class="form-group">
                                                        <label>Nomor Rekening<span>*</span></label>
                                                        <input type="text" name="bank_account" placeholder="Nomor Rekening"
                                                               value="<?php echo $r['bank_account'];?>"
                                                               class="form-control "
                                                               id="bank_account">
                                                 </div>

                                                 <div class="form-group">
                                                        <label>Nama Rekening<span>*</span></label>
                                                        <input type="text" name="account_name" placeholder="Nama Rekening"
                                                               value="<?php echo $r['account_name'];?>"
                                                               class="form-control "
                                                               id="account_name">
                                                 </div>
                                                

                                                 <div class="form-wizard-buttons">
                                                        <button type="button" class="btn btn-previous">Sebelumnya</button>
                                                        <button type="button" class="btn btn-next">Selanjutnya</button>
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
                                                 <h4>Informasi Pendidikan : <span>Langkah 3 - 6</span></h4>

                            

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
                                                                      <select name="data_edu0[]" placeholder=""
                                                                             class="form-control selectEducation"
                                                                             style="width:100%; background: #f8f8f8 none repeat scroll 0 0;"
                                                                             id="selectEducation">
                                                                             <option value="<?php echo $r['edu_type'];?>">
                                                                                    <?php echo $r['edu_type'];?></option>
                                                                      </select>
                                                               </td>

                                                               <td>
                                                                      <select id="selectEduname" name="data_edu1[]" placeholder=""
                                                                             class="form-control selectInstitution"
                                                                             style="width:100%; background: #f8f8f8 none repeat scroll 0 0;"
                                                                             id="selectInstitution">
                                                                             <option value="<?php echo $r['edu_name'];?>">
                                                                             <?php echo $r['edu_name'];?></option>
                                                                      </select>
                                                               </td>

                                                               <td><select name="data_edu2[]" placeholder=""
                                                                             class="form-control selectCity"
                                                                             style="width:100%; background: #f8f8f8 none repeat scroll 0 0;"
                                                                             id="selectCity">
                                                                             <option value="<?php echo $r['city_name'];?>">
                                                                             <?php echo $r['city_name'];?></option>
                                                                      </select>
                                                               </td>
                                                               <!-- <td><input type="text" name="data_edu3[]"  value="<php echo $r['faculty'];?>"
                                                                             id="selectfaculty"
                                                                             class="form-control"></td> -->

                                                               <td>
                                                               <select class="form-control" name="data_edu3[]"  id="selectfaculty">
	                                                        <option value=<?php echo $r['faculty'];?>><?php echo $r['faculty_name'];?></option>
                                                                      <?php
                                                                      $get_relation = mysqli_query($connect, "SELECT * FROM TEOMFACULTY");
                                                                      if(mysqli_num_rows($get_relation) != 0){
                                                                             while($row = mysqli_fetch_array($get_relation)){
                                                                                    echo '<option value='.$row['code'].'>'.$row['name_en'].'</option>';
                                                                             }
                                                                      }
                                                                      ?>
                                                               </select></td>

                                                               <td><input type="text" name="data_edu4[]" value="<?php echo $r['start_year'];?>"
                                                                             id="selectstart_year"
                                                                             class="form-control">
                                                               <td><input type="text" name="data_edu4A[]" value="<?php echo $r['end_year'];?>"
                                                                             id="selectend_year"
                                                                             class="form-control">


                                                               </td>
                                                               <td><input type="text" name="data_edu5[]"  value="<?php echo $r['gpa'];?>"
                                                                             class="form-control"></td>
                                                               <!-- <td><a href='javascript:void(0);' class='remove'><img
                                                                                    src="../../asset/img/icons/minus.png" style="max-width: none;" style="max-width: none;"></a>
                                                               </td> -->
                                                        </tr>
                                                 </table>
                                                </div>

                                                 <script>
                                                 $(function() {
                                                        $('#addMore').on('click', function() {
                                                               var data = $("#tb tr:eq(1)")
                                                                      .clone(true).appendTo(
                                                                             "#tb");
                                                               data.find("input").val('');
                                                        });
                                                        $(document).on('click', '.remove', function() {
                                                               var trIndex = $(this)
                                                                      .closest("tr")
                                                                      .index();
                                                               if (trIndex > 1) {
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

                                                 <div class="form-wizard-buttons">
                                                        <button type="button" class="btn btn-previous">Sebelumnya</button>
                                                        <button type="button" class="btn btn-next">Selanjutnya</button>
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
                                                 <h4>Kontak Darurat : <span>Langkah 4 - 6</span></h4>
                                                
                                                
                                                 <div class="card-body table-responsive p-0"
                                                 style="width: 100vw; width: 100.0%; margin: 5px;overflow: scroll;">
                                                        <table class="table table-hover small-text" id="tba">
                                                        <tr class="tr-header">
                                                               <th><label>Nama Kontak <span>*</span></label></th>
                                                               <th><label>Hubungan Dengan Karyawan <span>*</span></label></th>
                                                               <th><label>Nomor Kontak <span>*</span></label></th>
                                                               <th><label>Alamat Lengkap <span>*</span></label></th>
                                                               <th><a href="javascript:void(0);" style="font-size:18px;"
                                                                             id="addMorea" title="Add More Person"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-square feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg></a>
                                                               </th>
                                                       
                                                        <?php
                                                        $get_emergency = mysqli_query($connect, "SELECT a.*,b.relationship_name_id FROM  mgtools_teodempemergency a 
                                                                                                  LEFT JOIN hrmfamilyrelation b on a.relationship_code=b.relationship_code
                                                                                                  WHERE emp_id = (SELECT emp_id FROM view_employee WHERE emp_no='$rfid')
                                                                                                  ");
                                                        while($row = mysqli_fetch_array($get_emergency)){
                                                        ?>
                                                        <tr>
                                                               <td><input type="text" name="data_emg0[]" value="<?php echo $row['contact_name']; ?>" id="emer_contact_name" class="form-control"></td>
                                                               <td>
                                                               <select class="form-control" id="emer_relationship_code" name="data_emg1[]">
	                                                        <option value=<?php echo $row['relationship_code'] ?>><?php echo $row['relationship_name_id'] ?></option>
                                                                      <?php
                                                                      $get_relation = mysqli_query($connect, "SELECT relationship_code,relationship_name_id FROM hrmfamilyrelation WHERE relationship_code <> '$row[relationship_code]' ORDER BY `order` ASC");
                                                                   
                                                                             while($rows = mysqli_fetch_array($get_relation)){
                                                                                    echo '<option value='.$rows['relationship_code'].'>'.$rows['relationship_name_id'].'</option>';
                                                                        
                                                                      }
                                                                      ?>
                                                               </select></td>
                                                               <td><input type="text" name="data_emg2[]" value="<?php echo $row['phone']; ?>" id="emer_phone" class="form-control"></td>
                                                               <td><textarea type="text" name="data_emg3[]" id="emer_address" class="form-control"><?php echo $row['address']; ?></textarea></td>
                                                               <td><a href='javascript:void(0);' class='removea'><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-square feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="8" y1="12" x2="16" y2="12"></line></svg></a>
                                                               </td>
                                                        </tr>
                                                        <?php
                                                        }
                                                        ?>


                                                        <tr>
                                                               <td><input type="text" name="data_emg0[]" class="form-control"></td>
                                                               <td>
                                                               <select class="form-control" name="data_emg1[]">
	                                                        <option>-Select one-</option>
                                                                      <?php
                                                                      $get_relation = mysqli_query($connect, "SELECT relationship_code,relationship_name_id FROM hrmfamilyrelation ORDER BY relationship_code ASC");
                                                                      if(mysqli_num_rows($get_relation) != 0){
                                                                             while($row = mysqli_fetch_array($get_relation)){
                                                                                    echo '<option value='.$row['relationship_code'].'>'.$row['relationship_name_id'].'</option>';
                                                                             }
                                                                      }
                                                                      ?>
                                                               </select></td>
                                                               <td><input type="text" name="data_emg2[]" class="form-control"></td>
                                                               <td><textarea type="text" name="data_emg3[]" class="form-control"></textarea></td>
                                                               <td><a href='javascript:void(0);' class='removea'><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-square feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="8" y1="12" x2="16" y2="12"></line></svg></a>
                                                               </td>
                                                        </tr>
                                                 </table>
                                                 </div>

                                                 <div class="form-wizard-buttons">
                                                        <button type="button" class="btn btn-previous">Sebelumnya</button>
                                                        <button type="button" class="btn btn-next">Selanjutnya</button>
                                                 </div>

                                                 <script>
                                                 $(function() {
                                                        $('#addMorea').on('click', function() {
                                                               var data = $("#tba tr:eq(1)")
                                                                      .clone(true).appendTo(
                                                                             "#tba");
                                                               data.find("input").val('');
                                                        });
                                                        $(document).on('click', '.removea', function() {
                                                               var trIndex = $(this)
                                                                      .closest("tr")
                                                                      .index();
                                                               if (trIndex > 1) {
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
                                                               role="progressbar" aria-valuenow="75" aria-valuemin="0"
                                                               aria-valuemax="100" style="width: 75%">
                                                        </div>
                                                 </div>
                                                 <!-- Progress Bar -->
                                                 <h4>Keluarga & Tanggungan : <span>Langkah 5 - 6</span></h4>
                                                 
                                                 <div class="card-body table-responsive p-0"
                                                 style="width: 100vw; width: 100.0%; margin: 5px;overflow: scroll;">
                                                        <table class="table table-hover small-text" id="tbb">
                                                        <tr class="tr-header">
                                                               <th><label>Anggota Keluarga&nbsp;&nbsp;&nbsp;&nbsp;<span>*</span></label></th>
                                                               <th><label>Nama Lengkap&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>*</span></label></th>
                                                               <th><label>Tanggal Lahir&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>*</span></label></th>
                                                               <th><label>Status (Hidup/ Meninggal)&nbsp;&nbsp;&nbsp;<span>*</span></label></th>
                                                               <th><a href="javascript:void(0);" style="font-size:18px;"
                                                                             id="addMoreb" title="Add More Person"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-square feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg></a>
                                                               </th>
                                                       
                                                       
                                                        <?php
                                                        $get_family = mysqli_query($connect, "SELECT a.*,b.relationship_name_id
                                                                                                  FROM mgtools_teodempfamily a
                                                                                                  LEFT JOIN hrmfamilyrelation b on a.relationship=b.relationship_code
                                                                                                  WHERE emp_id = (SELECT emp_id FROM view_employee WHERE emp_no='$rfid')");
                                                        while($row = mysqli_fetch_array($get_family)){
                                                        ?>
                                                        
                                                        <tr>
                                                               <td>
                                                                      <select name="data_fam0[]" autocomplete="off" id="data_fam0" class="form-control">
                                                                      <option value="<?php echo $row['relationship']; ?>"><?php echo $row['relationship_name_id']; ?></option>
                                                                             <?php
                                                                             $get_relation = mysqli_query($connect, "SELECT relationship_code,relationship_name_id FROM hrmfamilyrelation WHERE relationship_code <> '$row[relationship]' ORDER BY `order` ASC");
                                                                
                                                                                    while($rows = mysqli_fetch_array($get_relation)){
                                                                                           echo '<option value='.$rows['relationship_code'].'>'.$rows['relationship_name_id'].'</option>';
                                                                                    }
                                                                             ?>
                                                                      </select>
                                                               </td>

                                                               <td><input type="text" name="data_fam1[]" autocomplete="off" id="data_fam1" style="text-transform:uppercase" class="form-control" value="<?php echo $row['name']; ?>"></td>
                                                               <td><input type="date" name="data_fam2[]" autocomplete="off" id="data_fam2" class="form-control" style="
                                                                             background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                             background-size: 17px;
                                                                             background-position:right;   
                                                                             background-repeat:no-repeat; 
                                                                             padding-right:20px;  
                                                                             "
                                                                             value="<?php echo date("Y-m-d", strtotime($row['birthdate'])); ?>"
                                                                             >

                                                               </td>
                                                               
                                                               <td><?php
                                                                      $alive = $row['alive_status'];
                                                                      if($alive == '1'){
                                                                             $value_alive = '1';
                                                                             $text_alive = 'Hidup';
                                                                      } else if($alive == '0') {
                                                                             $value_alive = '0';
                                                                             $text_alive = 'Meninggal';
                                                                      } else {
                                                                             $value_alive = '';
                                                                             $text_alive = '--silahkan pilih status--';
                                                                      }
                                                                      ?>
                                                                      <select name="data_fam3[]" autocomplete="off" id="data_fam3" placeholder="Silahkan Pilih Web"
                                                                             class="form-control"
                                                                             style="text-transform:uppercase">
                                                                             <option value="<?php echo $value_alive; ?>"><?php echo $text_alive; ?></option>
                                                                             <option value="1">Hidup</option>
                                                                             <option value="0">Meninggal</option>
                                                                      </select></td>
                                                               <td><a href='javascript:void(0);' class='removeb'><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-square feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="8" y1="12" x2="16" y2="12"></line></svg></a></td>
                                                        </tr>
                                                        <?php } ?>
                                                 </table>
                                                 </div>

                                                 <script>
                                                 $(function() {
                                                        $('#addMoreb').on('click', function() {
                                                               var data = $("#tbb tr:eq(1)")
                                                                      .clone(true).appendTo(
                                                                             "#tbb");
                                                               data.find("input").val('');
                                                               data.find("select").val('');
                                                        });
                                                        $(document).on('click', '.removeb', function() {
                                                               var trIndex = $(this)
                                                                      .closest("tr")
                                                                      .index();
                                               
                                                                      $(this).closest("tr")
                                                                             .remove();
                                                             
                                                        });
                                                 });
                                                 </script>

                                                 <div class="form-wizard-buttons">
                                                        <button type="button" class="btn btn-previous">Sebelumnya</button>
                                                        <button type="button" class="btn btn-next">Selanjutnya</button>
                                                 </div>
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
                                                 </div><br>

       <div class="card-group">
       <h4>Dokumen Pendukung : <span>Langkah 6 - 6</span></h4>

       <BR>
            <!-- Column -->
            <div class="card">
              <div class="card-body text-center">
                  <div id="unique-visit">
                     <div id="apexchartsrmi92407" class="apexcharts-canvas apexchartsrmi92407 apexcharts-theme-light">
                            <div class="apexcharts-tooltip apexcharts-theme-dark"><div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(38, 198, 218);"></span><div class="apexcharts-tooltip-text" style="font-family: Poppins, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-dark"><div class="apexcharts-yaxistooltip-text"></div></div></div></div>
                                   <div class="resize-triggers">
                    
                                   <div id="uploaded_image"></div>

                                   <?php
                                          if($img != ''){
                                                 echo '<div class="imgbox1" id="imgbox1"><p style="word-wrap: break-word;"><code class="w3-codespan" style="wrap">KTP</code></p>
                                                        <img src="'.$img.'" style="max-height: 300px;" alt="gthris">
                                                       
                                                        <p>
                                                               '.$openFile.'
                                                               <input type="hidden" value="'.$any_id.'" name="nama">
                                                               <a style="color: white;margin-bottom: 10px;font-size: 14px;width: 100%;background: #b5b2b2;" class="btn btn-submit tombol-simpan" onclick="removeElement()">Hapus
                                                               <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-square feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                                                               </a></p>
                                                        </div>
                                                                   
                                                 ';
                                          }
                                   ?>
                            </div>
                     </div>
              <div class="p-2 rounded border-top text-center">
              <label>Foto Copy KTP<br>(Maksimal 3 MB) <span class='badge badge-Partially-Approved' style="color: white;font-weight: bold;font-size: 12px;margin-bottom: 5px;width: auto;background: #03469b;border-bottom: 5px solid #eae9d9;"> ( Tipe File : jpg, jpeg, png, pdf ) </span> </label>
                                                        <input type="hidden" id="any_file"
                                                               value="<?php echo $any_file; ?>"
                                                               class="form-control">
                                                               <input class="input-file" id="file" name="file" type="file"
                                                               style="font-size: 12px;"> 
              </div>
            </div>
            <!-- Column -->
            <div class="card">
              <div class="card-body text-center">
                  <div id="unique-visit">
                     <div id="apexchartsrmi92407" class="apexcharts-canvas apexchartsrmi92407 apexcharts-theme-light">
                            <div class="apexcharts-tooltip apexcharts-theme-dark"><div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(38, 198, 218);"></span><div class="apexcharts-tooltip-text" style="font-family: Poppins, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-dark"><div class="apexcharts-yaxistooltip-text"></div></div></div></div>
                                   <div class="resize-triggers">
                    
                                   <div id="uploaded_image2"></div>
                                   <?php
                                          if($img2 != ''){
                                                 echo '<div class="datax imgbox2" id="imgbox2"><p style="word-wrap: break-word;"><code class="w3-codespan" style="wrap">Kartu keluarga</code></p>
                                                                      <img src="'.$img2.'" style="max-height: 300px;" alt="gthris">
                                                                      <p>
                                                                             '.$openFile2.'
                                                                             <input type="hidden" value="'.$any_id2.'" name="nama2">
                                                                             <a style="color: white;margin-bottom: 10px;font-size: 14px;width: 100%;background: #b5b2b2;" class="btn btn-submit tombol-simpan2" onclick="removeElement2()">Hapus
                                                                             <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-square feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                                                                             </a></p>
                                                                      </div>
                                                 ';
                                          }
                                   ?>
                            </div>
                     </div>
              <div class="p-2 rounded border-top text-center">
              <label>Kartu Keluarga<br>(Maksimal 3 MB) <span class='badge badge-Partially-Approved' style="color: white;font-weight: bold;font-size: 12px;margin-bottom: 5px;width: auto;background: #03469b;border-bottom: 5px solid #eae9d9;"> ( Tipe File : jpg, jpeg, png, pdf ) </span></label>

                                                        <input type="hidden" id="any_file2"
                                                               value="<?php echo $any_file2; ?>"
                                                               class="form-control">
                                                               <input class="input-file" id="file2" name="file2" type="file"
                                                               style="font-size: 12px;"> 
              </div>
            </div>
            <!-- Column -->
            <div class="card">
              <div class="card-body text-center">
                  <div id="unique-visit">
                     <div id="apexchartsrmi92407" class="apexcharts-canvas apexchartsrmi92407 apexcharts-theme-light">
                            <div class="apexcharts-tooltip apexcharts-theme-dark"><div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(38, 198, 218);"></span><div class="apexcharts-tooltip-text" style="font-family: Poppins, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-dark"><div class="apexcharts-yaxistooltip-text"></div></div></div></div>
                                   <div class="resize-triggers">
                    
                                   <div id="uploaded_image3"></div>
                                   <?php
                                   if($img3 != ''){
                                          echo '<div class="datax imgbox3" id="imgbox3"><p style="word-wrap: break-word;"><code class="w3-codespan" style="wrap">Ijazah</code></p>
                                                               <img src="'.$img3.'" style="max-height: 300px;" alt="gthris">
                                                               <p>
                                                                      '.$openFile3.'
                                                                      <input type="hidden" value="'.$any_id3.'" name="nama3">
                                                                      <a style="color: white;margin-bottom: 10px;font-size: 14px;width: 100%;background: #b5b2b2;" class="btn btn-submit tombol-simpan3" onclick="removeElement3()">Hapus
                                                                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-square feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                                                                      </a></p>
                                                            
                                                 </div>
                                          ';
                                   }
                                   ?>
                            </div>
                     </div>
              <div class="p-2 rounded border-top text-center">
              <label>Ijazah<br>(Maksimal 3 MB) <span class='badge badge-Partially-Approved' style="color: white;font-weight: bold;font-size: 12px;margin-bottom: 5px;width: auto;background: #03469b;border-bottom: 5px solid #eae9d9;"> ( Tipe File : jpg, jpeg, png, pdf ) </span></label>
                     <input type="hidden" id="any_file3"
                            value="<?php echo $any_file3; ?>"
                            class="form-control">
                            <input class="input-file" id="file3" name="file3" type="file"
                            style="font-size: 12px;">
              </div>
            </div>
            <!-- Column -->
            <div class="card">
              <div class="card-body text-center">
                  <div id="unique-visit">
                     <div id="apexchartsrmi92407" class="apexcharts-canvas apexchartsrmi92407 apexcharts-theme-light">
                            <div class="apexcharts-tooltip apexcharts-theme-dark"><div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(38, 198, 218);"></span><div class="apexcharts-tooltip-text" style="font-family: Poppins, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-dark"><div class="apexcharts-yaxistooltip-text"></div></div></div></div>
                                   <div class="resize-triggers">
                    
                                   <div id="uploaded_image4"></div>
                                    <?php
                                   if($img4 != ''){
                                          echo '<div class="datax imgbox4" id="imgbox4"><p style="word-wrap: break-word;"><code class="w3-codespan" style="wrap">NPWP</code></p>
                                                               <img src="'.$img4.'" style="max-height: 300px;" alt="gthris">
                                                               <p>
                                                                      '.$openFile4.'
                                                                      <input type="hidden" value="'.$any_id4.'" name="nama4">
                                                                      <a style="color: white;margin-bottom: 10px;font-size: 14px;width: 100%;background: #b5b2b2;" class="btn btn-submit tombol-simpan4" onclick="removeElement4()">Hapus
                                                                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-square feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                                                                      </a></p>
                                                               </div>
                                                 
                                          ';
                                   }
                                   ?>
                            </div>
                     </div>
              <div class="p-2 rounded border-top text-center">
              <label>NPWP<br>(Maksimal 3 MB) <span class='badge badge-Partially-Approved' style="color: white;font-weight: bold;font-size: 12px;margin-bottom: 5px;width: auto;background: #03469b;border-bottom: 5px solid #eae9d9;"> ( Tipe File : jpg, jpeg, png, pdf ) </span></label>
                     <input type="hidden" id="any_file4"
                            value="<?php echo $any_file4; ?>"
                            class="form-control">
                            <input class="input-file" id="file4" name="file4" type="file"
                            style="font-size: 12px;">
              </div>
            </div>
            <!-- Column -->
            <div class="card">
              <div class="card-body text-center">
                  <div id="unique-visit">
                     <div id="apexchartsrmi92407" class="apexcharts-canvas apexchartsrmi92407 apexcharts-theme-light">
                            <div class="apexcharts-tooltip apexcharts-theme-dark"><div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(38, 198, 218);"></span><div class="apexcharts-tooltip-text" style="font-family: Poppins, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-dark"><div class="apexcharts-yaxistooltip-text"></div></div></div></div>
                                   <div class="resize-triggers">
                                   <div id="uploaded_image5"></div>
                                   <?php
                                   if($img5 != ''){
                                          echo '<div class="datax imgbox5" id="imgbox5"><p style="word-wrap: break-word;"><code class="w3-codespan" style="wrap">Buku Nikah</code></p>
                                                               <img src="'.$img5.'" style="max-height: 300px;" alt="gthris">
                                                               <p>
                                                                      '.$openFile5.'
                                                                      <input type="hidden" value="'.$any_id5.'" name="nama5">
                                                                      <a style="color: white;margin-bottom: 10px;font-size: 15px;width: 100%;background: #b5b2b2;" class="btn btn-submit tombol-simpan5" onclick="removeElement5()">Hapus
                                                                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 25 25" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-square feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                                                                      </a></p>
                                                               </div>
                                          ';
                                   }
                                   ?>
                            </div>
                     </div>
              <div class="p-2 rounded border-top text-center">
              <label>BUKU NIKAH<br>(Maksimal 3 MB)<span class='badge badge-Partially-Approved' style="color: white;font-weight: bold;font-size: 12px;margin-bottom: 5px;width: auto;background: #03569b;border-bottom: 5px solid #eae9d9;"> ( Tipe File : jpg, jpeg, png, pdf ) </span></label>
                                                        <input type="hidden" id="any_file5" name="any_file5" value="<?php echo $any_file5; ?>"
                                                               class="form-control">
                                                        <input class="input-file" value="" id="file5" name="file5" type="file"
                                                               style="font-size: 12px;"> 
              </div>
            </div>
            <!-- Column -->
            </div>
            

                                                 <!-- Progress Bar -->
                                                 

                                                

                                                 <link rel="stylesheet" href="asset/w3schools28.css">

                                                  
                                                        <style>
                                                        @media (max-width:960px) 
                                                        { 
                                                               #imgbox1 {
                                                                      width: 100%; display: block;
                                                               }
                                                               #imgbox1a {
                                                                      width: 100%; display: block;
                                                               }
                                                                      #imgbox2 {
                                                                             width: 100%; display: block;
                                                                      }
                                                                      #imgbox2a {
                                                                             width: 100%; display: block;
                                                                      }
                                                                             #imgbox3 {
                                                                                    width: 100%; display: block;
                                                                             }
                                                                             #imgbox3a {
                                                                                    width: 100%; display: block;
                                                                             }
                                                                                    #imgbox4 {
                                                                                           width: 100%; display: block;
                                                                                    }
                                                                                    #imgbox4a {
                                                                                           width: 100%; display: block;
                                                                                    }
                                                                                           #imgbox5 {
                                                                                                  width: 100%; display: block;
                                                                                           }
                                                                                           #imgbox5a {
                                                                                                  width: 100%; display: block;
                                                                                           }
                                                        }

                                                        @media (min-width:960px) 
                                                        { 
                                                               #imgbox1 {
                                                                      width: 100%; display: block;
                                                               }
                                                               #imgbox1a {
                                                                      width: 100%; display: block;
                                                               }
                                                                      #imgbox2 {
                                                                             width: 100%; display: block;
                                                                      }
                                                                      #imgbox2a {
                                                                             width: 100%; display: block;
                                                                      }
                                                                             #imgbox3 {
                                                                                    width: 100%; display: block;
                                                                             }
                                                                             #imgbox3a {
                                                                                    width: 100%; display: block;
                                                                             }
                                                                                    #imgbox4 {
                                                                                           width: 100%; display: block;
                                                                                    }
                                                                                    #imgbox4a {
                                                                                           width: 100%; display: block;
                                                                                    }
                                                                                           #imgbox5 {
                                                                                                  width: 100%; display: block;
                                                                                           }
                                                                                           #imgbox5a {
                                                                                                  width: 100%; display: block;
                                                                                           }
                                                        }
                                                 </style>      
                                                                                                         
                                   



                                                 <div class="form-wizard-buttons">
                                                        <button type="button" class="btn btn-previous">Sebelumnya</button>
                                                        
                                                        <?php 
                                                        $is_active = mysqli_query($connect, "SELECT 
                                                                                                  *
                                                                                                  FROM mgtools_period
                                                                                                  WHERE CURDATE() BETWEEN period_start AND period_end");
                                                        if(mysqli_num_rows($is_active) > 0){
                                                               echo '<button type="submit" name="submitpemutakhiran"
                                                                      value="submitpemutakhiran"
                                                                      class="btn btn-submit">Kirim Pemutakhiran</button>';
                                                        } else {
                                                               echo '';
                                                        }
                                                        ?>
                                                 </div>

                                          </fieldset>
                                          <!-- Form Step 3 -->







                                          <input class="form-control" id="rfid"
                                                        style="text-transform:uppercase"
                                                        name="rfid" type="hidden" 
                                                        value="<?php echo $rfid; ?>">

                                          
                                                        <!-- <button type="submit" name='submitpemutakhiran'
                                                               value="submitpemutakhiran"
                                                               class="btn btn-submit">Submit</button> -->

                                                               

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

                     <!-- VALIDASI UNTUK JAVASCRIPTNYA, INI DARI DATABASE DI MENU YAA -->
                     <?php echo $field_script_JS1; ?>
                     <!-- VALIDASI UNTUK JAVASCRIPTNYA, INI DARI DATABASE DI MENU YAA -->

              </div>
       </div>
</div>






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

<!-- 

<script>
       var uploadField = document.getElementById("file");
       // doc,jpg,ods,png,txt,doc,pdf
       var allowedFiles = [".doc", ".jpg", ".ods", ".png", ".txt", ".doc", ".pdf"]
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
       var allowedFiles = [".doc", ".jpg", ".ods", ".png", ".txt", ".doc", ".pdf"]
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
       var allowedFiles = [".doc", ".jpg", ".ods", ".png", ".txt", ".doc", ".pdf"]
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
 -->


<script>
$(document).ready(function(){
 $(document).on('change', '#file', function(){
  var name = document.getElementById("file").files[0].name;
  var uploadField1 = document.getElementById("file");

  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();

  var allowedFiles = [".doc", ".jpg", ".jpeg", ".ods", ".png", ".txt", ".doc", ".pdf"]
  var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");

//   if(!regex.test(uploadField1.value.toLowerCase())) 
//   {
//    alert("Invalid Image File");
//   }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("file").files[0]);
  var f = document.getElementById("file").files[0];
  var fsize = f.size||f.fileSize;
  if(!regex.test(uploadField1.value.toLowerCase())) 
  {
       modals.style.display = "block";
       document.getElementById("msg").innerHTML = "File Tidak Diijinkan";
  } else if(fsize > 3145728)
  {
       modals.style.display = "block";
       document.getElementById("msg").innerHTML = "Dokumen terlalu besar maksimum besar file 3MB";
       return false;
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
       $('#uploaded_image').html("<img src='../../asset/dist/img/loading.gif' style='max-width: 10%;margin-top: 20px;'>");
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
  var uploadField2 = document.getElementById("file2");

  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  
  var allowedFiles = [".doc", ".jpg", ".jpeg", ".ods", ".png", ".txt", ".doc", ".pdf"]
  var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");

//   if(!regex.test(uploadField2.value.toLowerCase())) 
//   {
//    alert("Invalid Image File");
//   }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("file2").files[0]);
  var f = document.getElementById("file2").files[0];
  var fsize = f.size||f.fileSize;
  if(!regex.test(uploadField2.value.toLowerCase())) 
  {
       modals.style.display = "block";
       document.getElementById("msg").innerHTML = "File Tidak Diijinkan";
  } else if(fsize > 3145728)
  {
       modals.style.display = "block";
       document.getElementById("msg").innerHTML = "Dokumen terlalu besar maksimum besar file 3MB";
       return false;
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
       $('#uploaded_image2').html("<img src='../../asset/dist/img/loading.gif' style='max-width: 10%;margin-top: 20px;'>");
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
  var uploadField3 = document.getElementById("file3");

  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  
  var allowedFiles = [".doc", ".jpg", ".jpeg", ".ods", ".png", ".txt", ".doc", ".pdf"]
  var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");

//   if(!regex.test(uploadField3.value.toLowerCase())) 
//   {
//    alert("Invalid Image File");
//   }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("file3").files[0]);
  var f = document.getElementById("file3").files[0];
  var fsize = f.size||f.fileSize;
  if(!regex.test(uploadField3.value.toLowerCase())) 
  {
   modals.style.display = "block";
       document.getElementById("msg").innerHTML = "File Tidak Diijinkan";
  } else if(fsize > 3145728)
  {
       modals.style.display = "block";
       document.getElementById("msg").innerHTML = "Dokumen terlalu besar maksimum besar file 3MB";
       return false;
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
       $('#uploaded_image3').html("<img src='../../asset/dist/img/loading.gif' style='max-width: 10%;margin-top: 20px;'>");
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





<script>
$(document).ready(function(){
 $(document).on('change', '#file4', function(){
  var name = document.getElementById("file4").files[0].name;
  var uploadField4 = document.getElementById("file4");

  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  
  var allowedFiles = [".doc", ".jpg", ".jpeg", ".ods", ".png", ".txt", ".doc", ".pdf"]
  var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");

//   if(!regex.test(uploadField4.value.toLowerCase())) 
//   {
//    alert("Invalid Image File");
//   }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("file4").files[0]);
  var f = document.getElementById("file4").files[0];
  var fsize = f.size||f.fileSize;
  if(!regex.test(uploadField4.value.toLowerCase())) 
  {
   modals.style.display = "block";
       document.getElementById("msg").innerHTML = "File Tidak Diijinkan";
  } else if(fsize > 4145728)
  {
       modals.style.display = "block";
       document.getElementById("msg").innerHTML = "Dokumen terlalu besar maksimum besar file 3MB";
       return false;
  }
  else
  {
   form_data.append("file4", document.getElementById('file4').files[0]);
   $.ajax({
       url:"uploader_dokumen.php?&code=4&token=<?php echo $username; ?>",
       method:"POST",
       data: form_data,
       contentType: false,
       cache: false,
       processData: false,
       beforeSend:function(){
       $('#uploaded_image4').html("<img src='../../asset/dist/img/loading.gif' style='max-width: 10%;margin-top: 20px;'>");
       },   
       success:function(data)
       {
       $('#uploaded_image4').html(data);
       }
   });
  }
 });
});
</script>





<script>
$(document).ready(function(){
 $(document).on('change', '#file5', function(){
  var name = document.getElementById("file5").files[0].name;
  var uploadField4 = document.getElementById("file5");

  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  
  var allowedFiles = [".doc", ".jpg", ".jpeg", ".ods", ".png", ".txt", ".doc", ".pdf"]
  var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");

//   if(!regex.test(uploadField4.value.toLowerCase())) 
//   {
//    alert("Invalid Image File");
//   }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("file5").files[0]);
  var f = document.getElementById("file5").files[0];
  var fsize = f.size||f.fileSize;
  if(!regex.test(uploadField4.value.toLowerCase())) 
  {
   modals.style.display = "block";
       document.getElementById("msg").innerHTML = "File Tidak Diijinkan";
  } else if(fsize > 4145728)
  {
       modals.style.display = "block";
       document.getElementById("msg").innerHTML = "Dokumen terlalu besar maksimum besar file 3MB";
       return false;
  }
  else
  {
   form_data.append("file5", document.getElementById('file5').files[0]);
   $.ajax({
       url:"uploader_dokumen.php?&code=5&token=<?php echo $username; ?>",
       method:"POST",
       data: form_data,
       contentType: false,
       cache: false,
       processData: false,
       beforeSend:function(){
       $('#uploaded_image5').html("<img src='../../asset/dist/img/loading.gif' style='max-width: 10%;margin-top: 20px;'>");
       },   
       success:function(data)
       {
       $('#uploaded_image5').html(data);
       }
   });
  }
 });
});
</script>


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
       $(".open_modal_search4").click(function(e) {
              var m = $(this).attr("id");
              $.ajax({
                     url: "modal_search.php?id=4&username=<?php echo $username; ?>",
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




        <script src='jquery-3.0.0.js' type='text/javascript'></script>
        <script src='script.js' type='text/javascript'></script>
        
    
<script>
function removeElement() {
document.getElementById("imgbox1").style.display = "none";
document.getElementById("file").value = "";
document.getElementById("any_file").value = "";
}

function removeElement1() {
document.getElementById("imgbox1a").style.display = "none";
document.getElementById("file").value = "";
document.getElementById("any_file").value = "";
}

function removeElement2() {
document.getElementById("imgbox2").style.display = "none";
document.getElementById("file2").value = "";
document.getElementById("any_file2").value = "";
}

function removeElement2a() {
document.getElementById("imgbox2a").style.display = "none";
document.getElementById("file2").value = "";
document.getElementById("any_file2").value = "";
}

function removeElement3() {
document.getElementById("imgbox3").style.display = "none";
document.getElementById("file2").value = "";
document.getElementById("any_file2").value = "";
}

function removeElement3a() {
document.getElementById("imgbox3a").style.display = "none";
document.getElementById("file3").value = "";
document.getElementById("any_file3").value = "";
}

function removeElement4() {
document.getElementById("imgbox4").style.display = "none";
document.getElementById("file4").value = "";
document.getElementById("any_file4").value = "";
}

function removeElement4a() {
document.getElementById("imgbox4a").style.display = "none";
document.getElementById("file4").value = "";
document.getElementById("any_file4").value = "";
}

function removeElement5() {
document.getElementById("imgbox5").style.display = "none";
document.getElementById("file5").value = "";
document.getElementById("any_file5").value = "";
}

function removeElement5a() {
document.getElementById("imgbox5a").style.display = "none";
document.getElementById("file5").value = "";
document.getElementById("any_file5").value = "";
}
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
                                   document.getElementById("file").value = "";
                                   document.getElementById("any_file").value = "";
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

<script type="text/javascript" src="select2/select2.full.min.js"></script>
<script type="text/javascript" src="select2/bs-custom-file-input.min.js"></script>

<script>
       $(function() {
              $('.select2bs4').select2({
                     theme: 'bootstrap4'
              })
       })
</script>