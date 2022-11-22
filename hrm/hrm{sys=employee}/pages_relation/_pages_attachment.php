<?php
include "../../../application/config.php";
$username = $_GET['rfid'];

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

    $openFile = "<a href='#' type='submit' class='btn btn-submit open_modal_search' style='background: darkcyan;font-weight: 500;font-size: 14px;margin: 5px 0px 5px 0px;width: 100%;color: white;'>Preview
       <svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-image feather-sm'><rect x='3' y='3' width='18' height='18' rx='2' ry='2'></rect><circle cx='8.5' cy='8.5' r='1.5'></circle><polyline points='21 15 16 10 5 21'></polyline></svg></a>";
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

    $openFile2 = "<a href='#' type='submit' class='btn btn-submit open_modal_search2' style='background: darkcyan;font-weight: 500;font-size: 14px;margin: 5px 0px 5px 0px;width: 100%;color: white;'>Preview
       <svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-image feather-sm'><rect x='3' y='3' width='18' height='18' rx='2' ry='2'></rect><circle cx='8.5' cy='8.5' r='1.5'></circle><polyline points='21 15 16 10 5 21'></polyline></svg></a>";
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

    $openFile3 = "<a href='#' type='submit' class='btn btn-submit open_modal_search3' style='background: darkcyan;font-weight: 500;font-size: 14px;margin: 5px 0px 5px 0px;width: 100%;color: white;'>Preview
       <svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-image feather-sm'><rect x='3' y='3' width='18' height='18' rx='2' ry='2'></rect><circle cx='8.5' cy='8.5' r='1.5'></circle><polyline points='21 15 16 10 5 21'></polyline></svg></a>";
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

    $openFile4 = "<a href='#' type='submit' class='btn btn-submit open_modal_search4' style='background: darkcyan;font-weight: 500;font-size: 14px;margin: 5px 0px 5px 0px;width: 100%;color: white;'>Preview
       <svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-image feather-sm'><rect x='3' y='3' width='18' height='18' rx='2' ry='2'></rect><circle cx='8.5' cy='8.5' r='1.5'></circle><polyline points='21 15 16 10 5 21'></polyline></svg></a>";
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

    $openFile5 = "<a href='#' type='submit' class='btn btn-submit open_modal_search5' style='background: darkcyan;font-weight: 500;font-size: 15px;margin: 5px 0px 5px 0px;width: 100%;color: white;'>Preview
       <svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' viewBox='0 0 25 25' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-image feather-sm'><rect x='3' y='3' width='18' height='18' rx='2' ry='2'></rect><circle cx='8.5' cy='8.5' r='1.5'></circle><polyline points='21 15 16 10 5 21'></polyline></svg></a>";
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
                                                                                                                                                          
                                                                                                                                                                 <p>
                                                                                                                                                                        ' . $openFile . '
                                                                                                                                                                        <input type="hidden" value="' . $any_id . '" name="nama">
                                                                                                                                                                        <a style="color: white;margin-bottom: 10px;font-size: 14px;width: 100%;background: #b5b2b2;" class="btn btn-submit tombol-simpan" onclick="removeElement()">Remove
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
            <input type="hidden" id="any_file" value="<?php echo $any_file; ?>" class="form-control">
            <input class="input-file" id="file" name="file" type="file" style="font-size: 12px;">
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
                                                                                                                                                                               <p>
                                                                                                                                                                                      ' . $openFile2 . '
                                                                                                                                                                                      <input type="hidden" value="' . $any_id2 . '" name="nama2">
                                                                                                                                                                                      <a style="color: white;margin-bottom: 10px;font-size: 14px;width: 100%;background: #b5b2b2;" class="btn btn-submit tombol-simpan2" onclick="removeElement2()">Remove
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

            <input type="hidden" id="any_file2" value="<?php echo $any_file2; ?>" class="form-control">
            <input class="input-file" id="file2" name="file2" type="file" style="font-size: 12px;">
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
                                                               <p>
                                                                      ' . $openFile3 . '
                                                                      <input type="hidden" value="' . $any_id3 . '" name="nama3">
                                                                      <a style="color: white;margin-bottom: 10px;font-size: 14px;width: 100%;background: #b5b2b2;" class="btn btn-submit tombol-simpan3" onclick="removeElement3()">Remove
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
            <input type="hidden" id="any_file3" value="<?php echo $any_file3; ?>" class="form-control">
            <input class="input-file" id="file3" name="file3" type="file" style="font-size: 12px;">
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
                                                               <p>
                                                                      ' . $openFile4 . '
                                                                      <input type="hidden" value="' . $any_id4 . '" name="nama4">
                                                                      <a style="color: white;margin-bottom: 10px;font-size: 14px;width: 100%;background: #b5b2b2;" class="btn btn-submit tombol-simpan4" onclick="removeElement4()">Remove
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
            <input type="hidden" id="any_file4" value="<?php echo $any_file4; ?>" class="form-control">
            <input class="input-file" id="file4" name="file4" type="file" style="font-size: 12px;">
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
                                                               <p>
                                                                      ' . $openFile5 . '
                                                                      <input type="hidden" value="' . $any_id5 . '" name="nama5">
                                                                      <a style="color: white;margin-bottom: 10px;font-size: 15px;width: 100%;background: #b5b2b2;" class="btn btn-submit tombol-simpan5" onclick="removeElement5()">Remove
                                                                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 25 25" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-square feather-sm"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                                                                      </a></p>
                                                               </div>
                                          ';
                }
                ?>
            </div>
        </div>
        <div class="p-2 rounded border-top text-center">
            <label>BUKU NIKAH<br>(Maksimal 3 MB) <span class='badge badge-Partially-Approved' style="color: white;font-weight: bold;font-size: 12px;margin-bottom: 5px;width: auto;background: #03569b;border-bottom: 5px solid #eae9d9;"> ( Tipe File : jpg, jpeg, png, pdf ) </span></label>
            <input type="hidden" id="any_file5" name="any_file5" value="<?php echo $any_file5; ?>" class="form-control">
            <input class="input-file" value="" id="file5" name="file5" type="file" style="font-size: 12px;">
        </div>
    </div>
    <!-- Column -->
</div>



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
                                   document.getElementById("msg").innerHTML = "Successfully remove files";
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
                                   document.getElementById("msg").innerHTML = "Successfully remove files";
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
                                   document.getElementById("msg").innerHTML = "Successfully remove files";
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
                                   document.getElementById("msg").innerHTML = "Successfully remove files";
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
                                   document.getElementById("msg").innerHTML = "Successfully remove files";
                                   document.getElementById("file5").value = "";
                                   document.getElementById("any_file5").value = "";
                                   return false;
				}
			});
		});
	});
</script>
