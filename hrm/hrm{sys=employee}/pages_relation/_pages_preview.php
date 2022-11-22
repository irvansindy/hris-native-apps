<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js">
</script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>

<link rel="stylesheet" type="text/css" media="all" href="../../asset/gt_tab_menus/pe.css" />



<fieldset id="fset_1">
       <legend>Employee Information</legend>

       <?php
       include "../../../application/config.php";
       $rfid = $_GET['rfid'];
       //$modal_id = '1';
       $modal = mysqli_query($connect, "SELECT 
                                          a.*,
                                          CASE 
                                                 WHEN a.start_date = '---' THEN '---'
                                                 ELSE DATE_FORMAT(a.start_date, '%d %b %Y')
                                          END AS _start_date,
                                          CASE 
                                                 WHEN a.birthdate = '---' THEN '---'
                                                 ELSE DATE_FORMAT(a.birthdate, '%d %b %Y')
                                          END AS _birthdate,
                                          a.request_no,
                                         
                                          CASE 
                                                 WHEN b.address = '---' THEN '---'
                                                 ELSE b.address
                                          END AS address_A,
                                          CASE 
                                                 WHEN a.gender = '---' THEN '---'
                                                 ELSE sub1.gender_name
                                          END AS gender_name,
                                          CASE 
                                                 WHEN a.religion = '---' THEN '---'
                                                 ELSE sub2.religion_name_en
                                          END AS religion_name_en,
                                          CASE 
                                                 WHEN a.maritalstatus = '---' THEN '---'
                                                 ELSE sub3.name_en
                                          END AS marital_en,
                                          CASE 
                                                 WHEN b.state_id = '---' THEN '---'
                                                 ELSE sub5.state_name
                                          END AS state_name_A,
                                          CASE 
                                                 WHEN b.district = '---' THEN '---'
                                                 ELSE sub6.district_name
                                          END AS district_name_A,
                                          CASE 
                                                 WHEN b.subdistrict = '---' THEN '---'
                                                 ELSE sub7.subdistrict_name
                                          END AS sub_district_name_A,
                                          CASE 
                                                 WHEN b.country_id = '---' THEN '---'
                                                 ELSE sub4.country_name
                                          END AS country_A,
                                          DATE_FORMAT(a.created_date, '%d %b %Y') as _timestamp,
                                          sub8.emp_no
                                   FROM mgtools_view_employee a
                                   LEFT JOIN mgtools_teodempaddress b ON a.request_no=b.request_no AND B.addresstype_code='A'
                                   LEFT JOIN ttamgender sub1 ON a.gender=sub1.id
                                   LEFT JOIN hrmreligion sub2 ON a.religion=sub2.religion_code
                                   LEFT JOIN teommarital sub3 ON a.maritalstatus=sub3.code
                                   LEFT JOIN hrmcountry sub4 ON b.country_id=sub4.country_id
                                   LEFT JOIN hrmstate sub5 ON b.state_id=sub5.state_id
                                   LEFT JOIN hrmdistrict sub6 ON b.district=sub6.district_id
                                   LEFT JOIN hrmsubdistrict sub7 ON b.subdistrict=sub7.subdistrict_id
                                   LEFT JOIN view_employee sub8 ON a.emp_id=sub8.emp_id
                                   WHERE a.request_no = '$rfid'
                                   GROUP BY a.request_no");

       while ($row = mysqli_fetch_array($modal)) {

              $empid .= $row["emp_id"];
              $empno .= $row["emp_no"];

       ?>

              <div class="form-row">
                     <div class="col-lg-2 name"> <label>First Name </label><br> Nama Depan</div>
                     <div class="col-lg-2 name">
                            <div class="input-group">
                                   <?php echo $row['first_name']; ?>
                            </div>
                     </div>

                     <div class="col-lg-2 name"> <label>Middle Name </label><br> Nama Tengah</div>
                     <div class="col-lg-2 name">
                            <div class="input-group">
                                   <?php echo $row['middle_name']; ?>
                            </div>
                     </div>

                     <div class="col-lg-2 name"> <label>Last Name </label><br> Nama Belakang</div>
                     <div class="col-lg-2 name">
                            <div class="input-group">
                                   <?php echo $row['last_name']; ?>
                            </div>
                     </div>

              </div>

              <div class="form-row">
                     <div class="col-lg-2 name"> <label>Employee No </label><br> No. Induk</div>
                     <div class="col-lg-2 name">
                            <div class="input-group">
                                   <?php echo $row['emp_id']; ?>
                            </div>
                     </div>
              </div>

              <div class="form-row">
                     <div class="col-lg-2 name">
                            <label>Join date</label><br> Tanggal Masuk
                     </div>
                     <div class="col-lg-4 name" style="margin-top: 5px;">
                            <div class="input-group">
                                   <?php echo $row['_start_date']; ?>
                            </div>
                     </div>
              </div>
              <div class="form-row">
                     <div class="col-lg-2 name">
                            <label>Place / Birth date</label><br> Tempat/ Tanggal Lahir
                     </div>
                     <div class="col-lg-10 name" style="margin-top: 5px;">
                            <div class="input-group">
                                   <?php echo $row['birthplace']; ?> / <?php echo $row['_birthdate']; ?>
                            </div>
                     </div>
              </div>
              <div class="form-row">
                     <div class="col-lg-2 name">
                            <label>ID Number</label><br> Nomor KTP
                     </div>
                     <div class="col-lg-6" style="margin-top: 5px;">
                            <div class="input-group">
                                   <?php echo $row['idnumber']; ?>
                            </div>
                     </div>
              </div>
              <div class="form-row">
                     <div class="col-lg-2 name">
                            <label>ID Family Number</label><br> Nomor KK
                     </div>
                     <div class="col-lg-6" style="margin-top: 5px;">
                            <div class="input-group">
                                   <?php echo $row['familyidnumber']; ?>
                            </div>
                     </div>
              </div>
              <div class="form-row">
                     <div class="col-lg-2 name">
                            <label>Gender</label><br> Jenis Kelamin
                     </div>
                     <div class="col-lg-6" style="margin-top: 5px;">
                            <div class="input-group">
                                   <?php echo $row['gender_name']; ?>
                            </div>
                     </div>
              </div>

              <div class="form-row">
                     <div class="col-lg-2 name">
                            <label>Blood Type</label><br> Golongan Darah
                     </div>
                     <div class="col-lg-6" style="margin-top: 5px;">
                            <div class="input-group">
                                   <?php echo $row['blood']; ?>
                            </div>
                     </div>
              </div>

              <div class="form-row">
                     <div class="col-lg-2 name">
                            <label>Religion</label><br> Agama
                     </div>
                     <div class="col-lg-6" style="margin-top: 5px;">
                            <div class="input-group">
                                   <?php echo $row['religion_name_en']; ?>
                            </div>
                     </div>
              </div>


              <div class="form-row">
                     <div class="col-lg-2 name">
                            <label>Marital Status</label><br> Status Perkawinan
                     </div>
                     <div class="col-lg-6" style="margin-top: 5px;">
                            <div class="input-group">
                                   <?php echo $row['marital_en']; ?>
                            </div>
                     </div>
              </div>

              <div class="form-row">
                     <div class="col-lg-2 name">
                            <label>Nationality</label><br> Kebangsaan
                     </div>
                     <div class="col-lg-6" style="margin-top: 5px;">
                            <div class="input-group">
                                   <?php echo $row['nationality']; ?>
                            </div>
                     </div>
              </div>

              <div class="form-row">
                     <div class="col-lg-2 name">
                            <label>Phone Number</label><br> Nomor Telepon
                     </div>
                     <div class="col-lg-6" style="margin-top: 5px;">
                            <div class="input-group">
                                   <?php echo $row['phone']; ?>
                            </div>
                     </div>
              </div>

              <div class="form-row">
                     <div class="col-lg-2 name">
                            <label>Personal Email</label><br> Surel Pribadi
                     </div>
                     <div class="col-lg-6" style="margin-top: 5px;">
                            <div class="input-group">
                                   <?php echo $row['email_personal']; ?>
                            </div>
                     </div>
              </div>

              <div class="form-row">
                     <div class="col-lg-2 name">
                            <label>Office Email</label> Surel Kantor
                     </div>
                     <div class="col-lg-6" style="margin-top: 5px;">
                            <div class="input-group">
                                   <?php echo $row['email']; ?>
                            </div>
                     </div>
              </div>

              <div class="form-row">
                     <div class="col-lg-2 name">
                            <label>Current Address <span class='badge badge-Partially-Approved' style="color: white;font-weight: bold;font-size: 12px;margin-bottom: 5px;width: auto;"> ( Base on Identity ) </span></label> Alamat Domisili (Sesuai KTP)
                     </div>
                     <div class="col-lg-10 name" style="margin-top: 5px;">
                            <div class="input-group">
                                   <?php echo $row['address_A']; ?>
                            </div>
                     </div>
              </div>

              <div class="form-row">
                     <div class="col-lg-2 name">
                            <label>Country</label><br> Negara
                     </div>
                     <div class="col-lg-2 name" style="margin-top: 5px;">
                            <div class="input-group">
                                   <?php echo $row['country_A']; ?>
                            </div>
                     </div>

                     <div class="col-lg-2 name">
                            <label>State</label><br> Provinsi
                     </div>
                     <div class="col-lg-2 name" style="margin-top: 5px;">
                            <div class="input-group">
                                   <?php echo $row['state_name_A']; ?>
                            </div>
                     </div>

                     <div class="col-lg-2 name">
                            <label>District</label><br> Kelurahan
                     </div>
                     <div class="col-lg-2 name" style="margin-top: 5px;">
                            <div class="input-group">
                                   <?php echo $row['district_name_A']; ?>
                            </div>
                     </div>
              </div>

              <div class="form-row">
                     <div class="col-lg-2 name">
                            <label>Sub District</label><br> Kecamatan
                     </div>
                     <div class="col-lg-2 name" style="margin-top: 5px;">
                            <div class="input-group">
                                   <?php echo $row['sub_district_name_A']; ?>
                            </div>
                     </div>
              </div>


       <?php } ?>

</fieldset>

<fieldset id="fset_1">
       <legend>Family & Dependent</legend>

       <?php
       $modal = mysqli_query($connect, "SELECT * FROM teodempfamily a
                                                        LEFT JOIN hrmfamilyrelation b ON b.relationship_code=a.relationship WHERE emp_id = '$empid'");

       while ($row = mysqli_fetch_array($modal)) {
       ?>


              <div class="form-row">
                     <div class="col-lg-2 name">
                            <label><?php echo $row['relationship_name_en'] ?></label>
                     </div>
                     <div class="col-lg-2 name" style="margin-top: 5px;">
                            <div class="input-group">
                                   <?php echo $row['name'] ?>
                            </div>
                     </div>
              </div>

       <?php } ?>
</fieldset>

<fieldset id="fset_1">
       <legend>Supporting Document</legend>

       <?php
       $username = $empno;

       $get_cek_file    = mysqli_query($connect, "SELECT a.id,a.document_file,a.attachment,a.ext FROM mgtools_attachment a WHERE a.emp_id = '$username' and a.document_file = '1'");
       $get_cek_file_r  = mysqli_fetch_array($get_cek_file);
       if (mysqli_num_rows($get_cek_file) != '0') {
              $any_id = $get_cek_file_r['id'];
              $any_docf = $get_cek_file_r['document_file'];
              $any_file = $get_cek_file_r['attachment'];
              $ext_file = $get_cek_file_r['ext'];


              if ($ext_file == 'pdf') {
                     $attch = "<span id='uploaded_image_exist'><img style='width: 10%;;margin-bottom: 20px;' src='uploaded_files/pngs.png' height='150' width='225' class='img-thumbnail'/></span>'";
                     $img = "uploaded_files/pngs.png";
              } else {
                     $attch = '<img style="width: 10%;;margin-bottom: 20px;min-height: 115px;" src="../../asset/list_document/' . $any_file . '" height="425" width="425" class="img-thumbnail" />';
                     $img = '../../asset/list_document/' . $any_file . '';
              }
       } else {

              $any_file = '';
              $attch = "";
              $openFile = "";
       }

       $get_cek_file2    = mysqli_query($connect, "SELECT a.id,a.document_file,a.attachment,a.ext FROM mgtools_attachment a WHERE a.emp_id = '$username' and a.document_file = '2'");
       $get_cek_file2_r  = mysqli_fetch_array($get_cek_file2);
       if (mysqli_num_rows($get_cek_file2) != '0') {
              $any_id2 = $get_cek_file2_r['id'];
              $any_docf2 = $get_cek_file2_r['document_file'];
              $any_file2 = $get_cek_file2_r['attachment'];
              $ext_file = $get_cek_file2_r['ext'];

              if ($ext_file == 'pdf') {
                     $attch2 = "<span id='uploaded_image_exist'><img style='width: 10%;;margin-bottom: 20px;' src='uploaded_files/pngs.png' height='150' width='225' class='img-thumbnail'/></span>'";
                     $img2 = "uploaded_files/pngs.png";
              } else {
                     $attch2 = '<img style="width: 10%;;margin-bottom: 20px;min-height: 115px;" src="../../asset/list_document/' . $any_file2 . '" height="425" width="425" class="img-thumbnail" />';
                     $img2 = '../../asset/list_document/' . $any_file2 . '';
              }
       } else {
              $any_file2 = '';
              $attch2 = "";
              $openFile2 = "";
       }

       $get_cek_file3    = mysqli_query($connect, "SELECT a.id,a.document_file,a.attachment,a.ext FROM mgtools_attachment a WHERE a.emp_id = '$username' and a.document_file = '3'");
       $get_cek_file3_r  = mysqli_fetch_array($get_cek_file3);
       if (mysqli_num_rows($get_cek_file3) != '0') {
              $any_id3 = $get_cek_file3_r['id'];
              $any_docf3 = $get_cek_file3_r['document_file'];
              $any_file3 = $get_cek_file3_r['attachment'];
              $ext_file = $get_cek_file3_r['ext'];

              if ($ext_file == 'pdf') {
                     $attch3 = "<span id='uploaded_image_exist'><img style='width: 10%;;margin-bottom: 20px;' src='uploaded_files/pngs.png' height='150' width='225' class='img-thumbnail'/></span>'";
                     $img3 = "uploaded_files/pngs.png";
              } else {
                     $attch3 = '<img style="width: 10%;;margin-bottom: 20px;min-height: 115px;" src="../../asset/list_document/' . $any_file3 . '" height="425" width="425" class="img-thumbnail" />';
                     $img3 = '../../asset/list_document/' . $any_file3 . '';
              }
       } else {
              $any_file3 = '';
              $attch3 = "";
              $openFile3 = "";
       }

       $get_cek_file4    = mysqli_query($connect, "SELECT a.id,a.document_file,a.attachment,a.ext FROM mgtools_attachment a WHERE a.emp_id = '$username' and a.document_file = '4'");
       $get_cek_file4_r  = mysqli_fetch_array($get_cek_file4);
       if (mysqli_num_rows($get_cek_file4) != '0') {
              $any_id4 = $get_cek_file4_r['id'];
              $any_docf4 = $get_cek_file4_r['document_file'];
              $any_file4 = $get_cek_file4_r['attachment'];
              $ext_file = $get_cek_file4_r['ext'];

              if ($ext_file == 'pdf') {
                     $attch4 = "<span id='uploaded_image_exist'><img style='width: 10%;;margin-bottom: 20px;' src='uploaded_files/pngs.png' height='150' width='225' class='img-thumbnail'/></span>'";
                     $img4 = "uploaded_files/pngs.png";
              } else {
                     $attch4 = '<img style="width: 10%;;margin-bottom: 20px;min-height: 115px;" src="../../asset/list_document/' . $any_file4 . '" height="425" width="425" class="img-thumbnail" />';
                     $img4 = '../../asset/list_document/' . $any_file4 . '';
              }
       } else {
              $any_file4 = '';
              $attch4 = "";
              $openFile4 = "";
       }

       $get_cek_file5    = mysqli_query($connect, "SELECT a.id,a.document_file,a.attachment,a.ext FROM mgtools_attachment a WHERE a.emp_id = '$username' and a.document_file = '5'");
       $get_cek_file5_r  = mysqli_fetch_array($get_cek_file5);
       if (mysqli_num_rows($get_cek_file5) != '0') {
              $any_id5 = $get_cek_file5_r['id'];
              $any_docf5 = $get_cek_file5_r['document_file'];
              $any_file5 = $get_cek_file5_r['attachment'];
              $ext_file = $get_cek_file5_r['ext'];

              if ($ext_file == 'pdf') {
                     $attch5 = "<span id='uploaded_image_exist'><img style='width: 10%;;margin-bottom: 20px;' src='uploaded_files/pngs.png' height='150' width='225' class='img-thumbnail'/></span>'";
                     $img5 = "uploaded_files/pngs.png";
              } else {
                     $attch5 = '<img style="width: 10%;;margin-bottom: 20px;min-height: 115px;" src="../../asset/list_document/' . $any_file5 . '" height="525" width="525" class="img-thumbnail" />';
                     $img5 = '../../asset/list_document/' . $any_file5 . '';
              }
       } else {
              $any_file5 = '';
              $attch5 = "";
              $openFile5 = "";
       }
       ?>




       <div class="col-lg-4 col-md-4">
              <!-- Column -->
              <div class="card">
                     <div class="card-body text-center">
                            <div id="unique-visit">
                                   <div id="apexchartsrmi92407" class="apexcharts-canvas apexchartsrmi92407 apexcharts-theme-light">
                                          <div class="apexcharts-tooltip apexcharts-theme-dark">
                                                 <div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(38, 198, 218);"></span>
                                                        <div class="apexcharts-tooltip-text" style="font-family: Poppins, sans-serif; font-size: 12px;">
                                                               <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div>
                                                               <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                                                        </div>
                                                 </div>
                                          </div>
                                          <div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-dark">
                                                 <div class="apexcharts-yaxistooltip-text"></div>
                                          </div>
                                   </div>
                            </div>
                            <div class="resize-triggers">

                                   <div id="uploaded_image"></div>

                                   <?php
                                   if ($img != '') {
                                          echo '<div class="imgbox1" id="imgbox1"><p style="word-wrap: break-word;"><code class="w3-codespan" style="wrap">KTP</code></p>
                                                                                                                                                                 <img src="' . $img . '" style="height: 100px;" alt="gthris">
                                                                                                                                                          
                                                                                                                                                              
                                                                                                                                                                 </div>
                                                                                                                                                                        
                                                                                                                                                          ';
                                   }
                                   ?>
                            </div>
                     </div>

              </div>
              <!-- Column -->
       </div>



       <div class="col-lg-4 col-md-4">
              <!-- Column -->
              <div class="card">
                     <div class="card-body text-center">
                            <div id="unique-visit">
                                   <div id="apexchartsrmi92407" class="apexcharts-canvas apexchartsrmi92407 apexcharts-theme-light">
                                          <div class="apexcharts-tooltip apexcharts-theme-dark">
                                                 <div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(38, 198, 218);"></span>
                                                        <div class="apexcharts-tooltip-text" style="font-family: Poppins, sans-serif; font-size: 12px;">
                                                               <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div>
                                                               <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                                                        </div>
                                                 </div>
                                          </div>
                                          <div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-dark">
                                                 <div class="apexcharts-yaxistooltip-text"></div>
                                          </div>
                                   </div>
                            </div>
                            <div class="resize-triggers">

                                   <div id="uploaded_image2"></div>
                                   <?php
                                   if ($img2 != '') {
                                          echo '<div class="datax imgbox2" id="imgbox2"><p style="word-wrap: break-word;"><code class="w3-codespan" style="wrap">Kartu keluarga</code></p>
                                                                                                                                                                               <img src="' . $img2 . '" style="height: 100px;" alt="gthris">
                                                                                                                                                                             
                                                                                                                                                                               </div>
                                                                                                                                                          ';
                                   }
                                   ?>
                            </div>
                     </div>

              </div>
              <!-- Column -->
       </div>


       <div class="col-lg-4 col-md-4">
              <!-- Column -->
              <div class="card">
                     <div class="card-body text-center">
                            <div id="unique-visit">
                                   <div id="apexchartsrmi92407" class="apexcharts-canvas apexchartsrmi92407 apexcharts-theme-light">
                                          <div class="apexcharts-tooltip apexcharts-theme-dark">
                                                 <div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(38, 198, 218);"></span>
                                                        <div class="apexcharts-tooltip-text" style="font-family: Poppins, sans-serif; font-size: 12px;">
                                                               <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div>
                                                               <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                                                        </div>
                                                 </div>
                                          </div>
                                          <div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-dark">
                                                 <div class="apexcharts-yaxistooltip-text"></div>
                                          </div>
                                   </div>
                            </div>
                            <div class="resize-triggers">

                                   <div id="uploaded_image3"></div>
                                   <?php
                                   if ($img3 != '') {
                                          echo '<div class="datax imgbox3" id="imgbox3"><p style="word-wrap: break-word;"><code class="w3-codespan" style="wrap">Ijazah</code></p>
                                                               <img src="' . $img3 . '" style="height: 100px;" alt="gthris">
                                                              
                                                            
                                                 </div>
                                          ';
                                   }
                                   ?>
                            </div>
                     </div>

              </div>
              <!-- Column -->
       </div>


       <div class="col-lg-4 col-md-4">
              <!-- Column -->
              <div class="card">
                     <div class="card-body text-center">
                            <div id="unique-visit">
                                   <div id="apexchartsrmi92407" class="apexcharts-canvas apexchartsrmi92407 apexcharts-theme-light">
                                          <div class="apexcharts-tooltip apexcharts-theme-dark">
                                                 <div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(38, 198, 218);"></span>
                                                        <div class="apexcharts-tooltip-text" style="font-family: Poppins, sans-serif; font-size: 12px;">
                                                               <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div>
                                                               <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                                                        </div>
                                                 </div>
                                          </div>
                                          <div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-dark">
                                                 <div class="apexcharts-yaxistooltip-text"></div>
                                          </div>
                                   </div>
                            </div>
                            <div class="resize-triggers">

                                   <div id="uploaded_image4"></div>
                                   <?php
                                   if ($img4 != '') {
                                          echo '<div class="datax imgbox4" id="imgbox4"><p style="word-wrap: break-word;"><code class="w3-codespan" style="wrap">NPWP</code></p>
                                                               <img src="' . $img4 . '" style="height: 100px;" alt="gthris">
                                                              
                                                               </div>
                                                 
                                          ';
                                   }
                                   ?>
                            </div>
                     </div>

              </div>
              <!-- Column -->
       </div>


       <div class="col-lg-4 col-md-4">
              <!-- Column -->
              <div class="card">
                     <div class="card-body text-center">
                            <div id="unique-visit">
                                   <div id="apexchartsrmi92407" class="apexcharts-canvas apexchartsrmi92407 apexcharts-theme-light">
                                          <div class="apexcharts-tooltip apexcharts-theme-dark">
                                                 <div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(38, 198, 218);"></span>
                                                        <div class="apexcharts-tooltip-text" style="font-family: Poppins, sans-serif; font-size: 12px;">
                                                               <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div>
                                                               <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                                                        </div>
                                                 </div>
                                          </div>
                                          <div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-dark">
                                                 <div class="apexcharts-yaxistooltip-text"></div>
                                          </div>
                                   </div>
                            </div>
                            <div class="resize-triggers">
                                   <div id="uploaded_image5"></div>
                                   <?php
                                   if ($img5 != '') {
                                          echo '<div class="datax imgbox5" id="imgbox5"><p style="word-wrap: break-word;"><code class="w3-codespan" style="wrap">Buku Nikah</code></p>
                                                               <img src="' . $img5 . '" style="height: 100px;" alt="gthris">
                                                              
                                                               </div>
                                          ';
                                   }
                                   ?>
                            </div>
                     </div>

              </div>
              <!-- Column -->
       </div>

</fieldset>
</table>