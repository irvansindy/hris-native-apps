<?php 
include "config.php";
?>
<html>
    <head>
        <title>Upload Data Struktur</title>
        <script src="./jquery.min.js"></script>
        <link rel="stylesheet" href="asset/bootstrap/dist/css/bootstrap.min.css">
        <script src="asset/bootstrap/dist/js/bootstrap.min.js"></script>

        <style type="text/css">
    
    
    
    
            #loadings {
                display: block;
                position: fixed;
                top: 0;
                left: 0;
                z-index: 10;
                width: 100%;
                height: 100%;
                background-color: #106159;
                background-size: 10%;
                background-repeat: no-repeat;
                background-position: center;
            }
            
            
            
            #image {
                display: block;
                position: fixed;
                top: -1% 255PX;
                left: 0;
                z-index: 13;
                width: 100%;
                height: 100%;
                background-image: url("./loading/logo-Recovered.png");
                background-size: 10%;
                background-repeat: no-repeat;
                background-position: center;
                animation: spin 6s linear infinite
        
            }


            #imagebg {
                display: block;
                position: fixed;
                top: -1% 255PX;
                left: 0;
                z-index: 11;
                width: 100%;
                height: 100%;
                background-image: url("./loading/logo-bg.png");
                background-size: 12%;
                background-repeat: no-repeat;
                background-position: center;
        
        
            }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
            
        
            
        </style>
        <!-- Ikon loading BAN -->
    </head>
    <body style="padding-top:10px;padding-left:10px; padding-right:10px">
        <div id="image" ></div>

        <div id="imagebg"></div>
        </div>
        
        <div id="loadings"></div>
        <table>
            <tr>
                <td>Pilih tipe data untuk diupload</td>
                <td><b style="margin-left:20px; margin-right:20px">:</b></td>
                <td>
                    <select name="tipe_data" id="tipe_data">
                        <option value="0">--Pilih Tipe Data--</option>
                        <option value="1">Master Organisasi </option>
                        <option value="2">Master Posisi</option>
                        <option value="3">Master Employee</option>
                    </select>
                </td>
                
            </tr>
        </table>
        <hr>
        <div style="background-color:orange; width:100%; padding-left:5px; padding-bottom:5px; display:none" id="tipe_migrateorgunit">
            <p style="text-align:center; font-weight:bold">Master Organisasi</p>
            <br>
            <table>
                <tr>
                    <td>1.</td>
                    <td>&nbsp</td>
                    <td>Download template upload Master Organisasi <a href="./asset/Template migrateorgunit.csv" target="_blank"><u>disini</u></a>.</td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td>&nbsp</td>
                    <td>Isi data sesuai template yang sebelumnya didownload.</td>
                </tr>
                <tr>
                    <td>3.</td>
                    <td>&nbsp</td>
                    <td>Upload data anda dengan menekan tombol choose file dibawah, setelah itu pilih file template migrate yang sebelumnya sudah diisikan dan tekan tombol upload.</td>
                </tr>
            </table>
            <br>
            <table>
                <form method="post" enctype="multipart/form-data" >
                    <tr>
                        <td>
                            <input class="form-control form-control-sm" name="filemhsw" id="formFileSm" type="file">
                        </td>
                    </tr>
                    <td>
                        <br>
                    </td>
                    <tr>
                        <td>
                            <button type="submit" class="btn btn-primary btn-sm" id="upload_mig" name="upload_mig">Upload</button>
                        </td>
                    </tr>
                </form>
            </table>
        </div>

        <div style="background-color:orange; width:100%; padding-left:5px; padding-bottom:5px; display:none" id="tipe_tempmigrateposition">
            <p style="text-align:center; font-weight:bold">Master Posisi</p>
            <br>
            <table>
                <tr>
                    <td>1.</td>
                    <td>&nbsp</td>
                    <td>Download template upload Master Posisi <a href="./asset/Template tempmigrateposition.csv" target="_blank"><u>disini</u></a>.</td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td>&nbsp</td>
                    <td>Isi data sesuai template yang sebelumnya didownload.</td>
                </tr>
                <tr>
                    <td>3.</td>
                    <td>&nbsp</td>
                    <td>Upload data anda dengan menekan tombol choose file dibawah, setelah itu pilih file template migrate yang sebelumnya sudah diisikan dan tekan tombol upload.</td>
                </tr>
            </table>
            <br>
            <table>
                <form method="post" enctype="multipart/form-data" >
                    <tr>
                        <td>
                            <input class="form-control form-control-sm" name="filemhsw" id="formFileSm" type="file">
                        </td>
                    </tr>
                    <td>
                        <br>
                    </td>
                    <tr>
                        <td>
                            <button type="submit" class="btn btn-success btn-sm" id="upload_temp" name="upload_temp">Upload</button>
                        </td>
                    </tr>
                </form>
            </table>
        </div>

        <div style="background-color:orange; width:100%; padding-left:5px; padding-bottom:5px; display:none" id="pos_emp">
            <p style="text-align:center; font-weight:bold">Master Employee</p>
            <br>
            <table>
                <tr>
                    <td>1.</td>
                    <td>&nbsp</td>
                    <td>Download template upload Master Employee <a href="./asset/Template tempmigrateemp.csv" target="_blank"><u>disini</u></a>.</td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td>&nbsp</td>
                    <td>Isi data sesuai template yang sebelumnya didownload.</td>
                </tr>
                <tr>
                    <td>3.</td>
                    <td>&nbsp</td>
                    <td>Upload data anda dengan menekan tombol choose file dibawah, setelah itu pilih file template migrate yang sebelumnya sudah diisikan dan tekan tombol upload.</td>
                </tr>
            </table>
            <br>
            <table>
                <form method="post" enctype="multipart/form-data" >
                    <tr>
                        <td>
                            <input class="form-control form-control-sm" name="filemhsw" id="formFileSm" type="file">
                        </td>
                    </tr>
                    <td>
                        <br>
                    </td>
                    <tr>
                        <td>
                            <button type="submit" class="btn btn-success btn-sm" id="upload_posemp" name="upload_posemp">Upload</button>
                        </td>
                    </tr>
                </form>
            </table>
        </div>

    <?php
        

	    if (isset($_POST['upload_mig'])) {

            // DELETE TABLE tempmigrateorgunit
            $delete_tempmigrateorgunit  = mysqli_query($masuk, "TRUNCATE od_tempmigrateorgunit");
            // DELETE TABLE tempmigrateorgunit


            require('spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
            require('spreadsheet-reader-master/SpreadsheetReader.php');

            //upload data excel kedalam folder uploads
            $target_dir = "upload/".basename($_FILES['filemhsw']['name']);
            
            move_uploaded_file($_FILES['filemhsw']['tmp_name'],$target_dir);

            $Reader = new SpreadsheetReader($target_dir);

            foreach ($Reader as $Key => $Row)
            {
                // import data excel mulai baris ke-2 (karena ada header pada baris 1)
                $department_id      = $Row[0];
                $department_name    = $Row[1];
                $division_id        = $Row[2];
                $division_name      = $Row[3];
                $direktorat_id      = $Row[4];
                $direktorat_name    = $Row[5];

                if ($Key < 1) continue;			
                $query=mysqli_query($masuk, "INSERT INTO od_tempmigrateorgunit(Departemen_id,Departemen_Name,Division_id,Division_name,Direktorat_id,Direktorat_name) 
                VALUES('".$department_id."','".$department_name."','".$division_id."','".$division_name."','".$direktorat_id."','".$direktorat_name."')");
            }
            if ($query) {
                    echo"<script type='text/javascript'>
                    window.alert('Berhasil!'); 
                    window.redirect('/interface-od');
                    </script>"; 
                }else{
                    echo"<script type='text/javascript'>
                    window.alert('Gagal!'); 
                    window.redirect('/interface-od');
                    </script>"; 
                }

	    }elseif(isset($_POST['upload_posemp'])){

            // DELETE TABLE tempmigrateorgunit
            $delete_posemp  = mysqli_query($masuk, "TRUNCATE od_tempmigrateemp");
            // DELETE TABLE tempmigrateorgunit


            require('spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
            require('spreadsheet-reader-master/SpreadsheetReader.php');

            //upload data excel kedalam folder uploads
            $target_dir = "upload/".basename($_FILES['filemhsw']['name']);
            
            move_uploaded_file($_FILES['filemhsw']['tmp_name'],$target_dir);

            $Reader = new SpreadsheetReader($target_dir);

            foreach ($Reader as $Key => $Row)
            {
                // import data excel mulai baris ke-2 (karena ada header pada baris 1)
                $emp_no             = $Row[0];
                $posisi_id          = $Row[1];

                if ($Key < 1) continue;			
                $query=mysqli_query($masuk, "INSERT INTO od_tempmigrateemp(emp_no,posisi_id) 
                VALUES('".$emp_no."','".$posisi_id."')");
            }
            if ($query) {
                    echo"<script type='text/javascript'>
                    window.alert('Berhasil!'); 
                    window.redirect('/interface-od');
                    </script>"; 
                }else{
                    echo"<script type='text/javascript'>
                    window.alert('Gagal!'); 
                    window.redirect('/interface-od');
                    </script>"; 
                }

        }elseif(isset($_POST['upload_temp'])){

            $sql_verif  = mysqli_query($masuk, "SELECT * FROM od_tempmigrateorgunit");
            $verif      = mysqli_num_rows($sql_verif);

            if($verif < 1){
                echo"<script type='text/javascript'>
                    window.alert('tempmigrateorgunit kosong!'); 
                    window.redirect('/interface-od');
                </script>"; 
                // exit();
            }else{
                 
            // DELETE TABLE tempmigrateposition
            $delete_tempmigrateposition  = mysqli_query($masuk, "TRUNCATE od_tempmigrateposition");
            // DELETE TABLE tempmigrateposition

            require('spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
            require('spreadsheet-reader-master/SpreadsheetReader.php');

            //upload data excel kedalam folder uploads
            $target_dir = "upload/".basename($_FILES['filemhsw']['name']);
            
            move_uploaded_file($_FILES['filemhsw']['tmp_name'],$target_dir);

            $Reader = new SpreadsheetReader($target_dir);

            foreach ($Reader as $Key => $Row)
            {
                // import data excel mulai baris ke-2 (karena ada header pada baris 1)
                $posisi_id          = $Row[0];
                $kode_posisi        = $Row[1];
                $nama_posisi        = addcslashes($Row[2], "'");
                $parent             = $Row[3];
                $direktorat_id      = $Row[4];
                $division_id        = $Row[5];
                $department_id      = $Row[6];
                $people_id          = $Row[7];
                $jobtitle_code      = $Row[8];
                $parent_path        = $Row[9];



                if ($Key < 1) continue;			
                $query=mysqli_query($masuk, "INSERT INTO od_tempmigrateposition(posisi_id,kode_posisi,nama_posisi,parent,Direktorat_id,Division_id,Departemen_id,people_id,Jobtitle_code,Parent_path) 
                VALUES('".$posisi_id."','".$kode_posisi."','".$nama_posisi."','".$parent."','".$direktorat_id."','".$division_id."','".$department_id."','".$people_id."','".$jobtitle_code."','".$parent_path."')");
            }
            if ($query) {

                
                    
                // STEP 3

                // DELETE TABLE tempmigratepositionpath
                $delete_tempmigratepositionpath     = mysqli_query($masuk, "TRUNCATE od_tempmigratepositionpath");
                // DELETE TABLE tempmigratepositionpath

                $insert_tempmigratepositionpath     = mysqli_query($masuk, "INSERT INTO od_tempmigratepositionpath (position_id,kode_posisi,nama_posisi,parent_path,parent)
                WITH RECURSIVE pathpos AS (
                   SELECT 
                        CAST(posisi_id AS VARCHAR(4000)) AS connect_by_path, nama_posisi,parent,posisi_id,kode_posisi 
                       FROM od_tempmigrateposition s 
                   UNION ALL
                   SELECT 
                        CONCAT(connect_by_path, ',', s.posisi_id) AS connect_by_path, s.nama_posisi,s.parent,s.posisi_id,s.kode_posisi
                       FROM pathpos r INNER JOIN od_tempmigrateposition s ON  r.posisi_id = s.parent
                )
                SELECT 
                pathpos.posisi_id,pathpos.kode_posisi,pathpos.nama_posisi,
                REPLACE(connect_by_path,(CONCAT(',',(RIGHT(connect_by_path,LENGTH(pathpos.posisi_id))))),'') AS parent_path,pathpos.parent
                FROM pathpos
                LEFT JOIN (SELECT posisi_id,MAX(LENGTH(connect_by_path)) AS len 
                               FROM pathpos GROUP BY posisi_id) prmt ON prmt.posisi_id = pathpos.posisi_id AND LENGTH(connect_by_path) = prmt.len
                WHERE prmt.len IS NOT NULL
                ORDER BY pathpos.posisi_id");

                    if($insert_tempmigratepositionpath){


                        // Verfi data error
                        $verif_error_tempmigratefinaldata   = mysqli_query($masuk, "SELECT a.posisi_id,a.kode_posisi,a.nama_posisi,a.Direktorat_id,a.Division_id,a.Departemen_id,'pos id sama poscode beda' AS type
                        from od_tempmigrateposition a
                        LEFT JOIN od_tempmigrateposition b ON b.posisi_id = a.posisi_id 
                        Where b.kode_posisi <> a.kode_posisi
                        UNION ALL
                        SELECT a.posisi_id,a.kode_posisi,a.nama_posisi,a.Direktorat_id,a.Division_id,a.Departemen_id,'poscode sama beda pos id' AS type
                        from od_tempmigrateposition a
                        LEFT JOIN od_tempmigrateposition b ON b.kode_posisi = a.kode_posisi 
                        Where b.posisi_id <> a.posisi_id
                        UNION ALL
                        SELECT a.posisi_id,a.kode_posisi,a.nama_posisi,a.Direktorat_id,a.Division_id,a.Departemen_id,'pos id sama beda parent' AS type
                        from od_tempmigrateposition a
                        LEFT JOIN od_tempmigrateposition b ON b.posisi_id = a.posisi_id 
                        Where b.parent <> a.parent
                        UNION ALL
                        SELECT distinct x.posisi_idx,x.kode_posisix,x.nama_posisix,y.Direktorat_id,y.Division_id,y.Departemen_id,'org unit sama memiliki dir/div/dept beda' AS type
                        FROM
                            (
                                SELECT 
                                a.position_id AS posisi_idx,
                                a.kode_posisi AS kode_posisix,
                                a.nama_posisi AS nama_posisix,
                                a.parent_path AS parent_pathx ,
                                        CONCAT(b.Departemen_id,',',b.Division_id,',',b.Direktorat_id) AS orgunitx,
                                        c.position_id,c.kode_posisi,c.parent_path,c.orgunit,c.nama_posisi
                                FROM od_tempmigratepositionpath a
                                LEFT JOIN od_tempmigrateposition b ON b.posisi_id = a.position_id
                                LEFT JOIN
                                        (
                                            SELECT a.position_id,a.kode_posisi,a.nama_posisi,a.parent_path,
                                                    CONCAT(b.Departemen_id,',',b.Division_id,',',b.Direktorat_id) AS orgunit
                                            FROM od_tempmigratepositionpath a
                                            LEFT JOIN od_tempmigrateposition b ON b.posisi_id = a.position_id
                                        ) c ON c.parent_path = a.parent_path 
                                WHERE CONCAT(b.Departemen_id,',',b.Division_id,',',b.Direktorat_id) <> c.orgunit
                            )x LEFT JOIN od_tempmigrateposition y ON y.posisi_id = x.posisi_idx
                        UNION ALL
                        SELECT a.posisi_id,a.kode_posisi,a.nama_posisi,a.Direktorat_id,a.Division_id,a.Departemen_id,'child dan parent punya job title sama' AS type
                        from od_tempmigrateposition a
                        LEFT JOIN od_tempmigrateposition b ON b.posisi_id = a.parent
                        LEFT JOIN od_orglevel c ON c.level_cat = a.Jobtitle_code
                        LEFT JOIN od_orglevel d ON d.level_cat = b.Jobtitle_code
                        WHERE c.level_cat = d.level_cat
                        UNION ALL
                        SELECT a.posisi_id,a.kode_posisi,a.nama_posisi,a.Direktorat_id,a.Division_id,a.Departemen_id,'Dept, division_id tidak sesuai master orgunit' AS type
                        from od_tempmigrateposition a
                        LEFT JOIN od_tempmigrateorgunit b ON b.Departemen_id = a.Departemen_id
                        WHERE a.Division_id <> b.Division_id
                        AND a.Departemen_id <> '0'
                        AND a.Departemen_id <> ''
                        UNION ALL
                        SELECT a.posisi_id,a.kode_posisi,a.nama_posisi,a.Departemen_id,a.Division_id,a.Direktorat_id,'Dept, Directorate tidak sesuai master orgunit' AS type
                        from od_tempmigrateposition a
                        LEFT JOIN od_tempmigrateorgunit b ON b.Departemen_id = a.Departemen_id
                        WHERE a.Direktorat_id <> b.Direktorat_id
                        AND a.Departemen_id <> '0'
                        AND a.Departemen_id <> ''
                        UNION ALL
                        SELECT a.posisi_id,a.kode_posisi,a.nama_posisi,a.Departemen_id,a.Division_id,a.Direktorat_id,'Divisi, Directorate tidak sesuai master orgunit' AS type
                        from od_tempmigrateposition a
                        LEFT JOIN od_tempmigrateorgunit b ON b.division_id = a.division_id
                        WHERE a.Direktorat_id <> b.Direktorat_id
                        AND a.division_id <> '0'
                        AND a.division_id <> ''
                        UNION ALL
                        SELECT a.posisi_id,a.kode_posisi,a.nama_posisi,a.Departemen_id,a.Division_id,a.Direktorat_id,'Penamaan tidak sesuai' AS type
                        from od_tempmigrateposition a
                        WHERE (a.nama_posisi LIKE '%HOD%' OR a.nama_posisi LIKE '%Department head%' OR a.nama_posisi LIKE '%dept head%'
                                 OR a.nama_posisi LIKE '%asst dept head%' OR a.nama_posisi LIKE '%sub dept head%' OR a.nama_posisi LIKE '%sub department head%'
                                 OR a.nama_posisi LIKE '%sec head%'
                                )");


                        $error_tempmigratefinaldata     = mysqli_num_rows($verif_error_tempmigratefinaldata);

                        if($error_tempmigratefinaldata > 0){

                            ?>
                                <table>
                                    <form method="post" enctype="multipart/form-data" >

                                    <tr>
                                        <!--<td><div id="" style="margin-left:20px;"><button id="lanjut" type="submit" class="btn btn-success btn-sm" name="continue">Lanjut Proses</button></div></td>-->
										                                        <td><div id="" style="margin-left:20px;"> <a href="lanjutgaes.php" class="btn btn-success btn-sm" target="_blank">Lanjut Proses</a></div></td>

                                        <td><div id="" style="margin-left:20px;"><button id="berhenti" type="submit" class="btn btn-danger btn-sm" name="abort">Abort Proses</button></div></td>
                                    </tr>

                                    </form>
                                </table>
                            <?php
                            

                            echo"<script type='text/javascript'>
                            window.alert('Ada data error!'); 
                            window.alert('Silahkan pilih untuk melanjutkan atau abort proses!');
                            $('#image').fadeOut('slow');  
                            $('#imagebg').fadeOut('slow');  
                            $('#loadings').fadeOut('slow');  
                            window.open('{print_error}.php','width=900,height=200,top=50,left=80,resizable=1,menubar=yes', true); 

                            

                            </script>"; 
                            exit();
                        }elseif($error_tempmigratefinaldata == '0'){

                        
                        // Verfi data error


                            // STEP 4

                            // DELETE TABLE tempmigratefinaldata
                            $delete_tempmigratefinaldata    = mysqli_query($masuk, "TRUNCATE od_tempmigratefinaldata");
                            // DELETE TABLE tempmigratefinaldata

                            $insert_tempmigratefinaldata    = mysqli_query($masuk, "INSERT INTO od_tempmigratefinaldata
                            select 
                            a.posisi_id as pos_child,
                            a.parent as org_child,
                            a.kode_posisi as child_pos_code,
                            a.nama_posisi as child_pos_name,
                            a.jobtitle_code as child_jobtitle_code,
                            pathx.parent_path as child_parent_path,
                            f.orderid as child_orderid,
                            a.parent as pos_parent,
                            e.parent as org_parent,
                            e.nama_posisi as parent_posname,
                            e.jobtitle_code as parent_jobtitle,
                            g.orderid as parent_orderid,
                            pathy.parent_path as parent_parentpath,
                            e.people_id as  parent_empno,
                            i.full_name as parent_name,
                            h.work_location_code as parent_plant,
                            h.cost_code as parent_costcenter,
                            CASE 
                                WHEN Ngap.posisi_id is not null AND (CAST(x1.orderid as SIGNED) - CAST(IFNULL(f.orderid,'0') as SIGNED) = 1) 
                                    THEN (CAST(f.orderid as SIGNED) - CAST(IFNULL(g.orderid,'0') as SIGNED)) + CAST(x1.orderid as SIGNED) - CAST(IFNULL(f.orderid,'0') as SIGNED)
                                ELSE CAST(f.orderid as SIGNED) - CAST(IFNULL(g.orderid,'0') as SIGNED)
                            END AS gap,
                            a.Direktorat_id,
                            a.Division_id,
                            a.Departemen_id
                            from od_tempmigrateposition a
                            left join (select distinct departemen_id,departemen_name from od_tempmigrateorgunit) b on b.departemen_id = a.departemen_id
                            left join (select distinct division_id,division_name from od_tempmigrateorgunit) c on c.division_id = a.division_id
                            left join (select distinct direktorat_id,direktorat_name from od_tempmigrateorgunit) d on d.direktorat_id = a.direktorat_id
                            left join od_tempmigrateposition e on e.posisi_id = a.parent
                            left join od_orglevel f on f.level_cat = a.jobtitle_code
                            left join od_orglevel g on g.level_cat = e.jobtitle_code
                            left join TEODEMPCOMPANY h on h.emp_no = e.people_id
                            left join TEOMEMPPERSONAL i on i.emp_id = h.emp_id
                            left join od_tempmigrateposition Ngap on Ngap.parent = a.parent and Ngap.jobtitle_code = e.jobtitle_code  
                            left join od_orglevel x1 on x1.level_cat = Ngap.jobtitle_code
                            left join od_tempmigratepositionpath pathx on pathx.position_id = a.posisi_id
                            left join od_tempmigratepositionpath pathy on pathy.position_id = a.parent
                            where a.posisi_id <> '0'
                            order by a.parent,a.posisi_id ASC");

                            if($insert_tempmigratefinaldata){

                                
							include "BuatOji.php";

                                

                            }else{
                                echo"<script type='text/javascript'>
                                window.alert('Gagal insert_tempmigratefinaldata!'); 
                                window.redirect('/interface-od');
                                </script>"; 
                            }

                        }

                    }else{
                        echo"<script type='text/javascript'>
                        window.alert('Gagal insert_tempmigratepositionpath!'); 
                        window.redirect('/interface-od');
                        </script>"; 
                    }


                }else{
                    echo"<script type='text/javascript'>
                    window.alert('Gagal!'); 
                    window.redirect('/interface-od');
                    </script>"; 
                }
            
            }

        // JIka lanjutkan proses
        }elseif(isset($_POST['continue'])){
            echo"<script type='text/javascript'>

            const imagebg = $('#imagebg');
            imagebg.css('display', 'block');
            const loadings = $('#loadings');
            loadings.css('display', 'block');
            const image = $('#image');
            image.css('display', 'block');

                            

                            </script>"; 
             // STEP 4

                            // DELETE TABLE tempmigratefinaldata
                            $delete_tempmigratefinaldata    = mysqli_query($masuk, "TRUNCATE od_tempmigratefinaldata");
                            // DELETE TABLE tempmigratefinaldata

                            $insert_tempmigratefinaldata    = mysqli_query($masuk, "INSERT INTO od_tempmigratefinaldata
                            select 
                            a.posisi_id as pos_child,
                            a.parent as org_child,
                            a.kode_posisi as child_pos_code,
                            a.nama_posisi as child_pos_name,
                            a.jobtitle_code as child_jobtitle_code,
                            pathx.parent_path as child_parent_path,
                            f.orderid as child_orderid,
                            a.parent as pos_parent,
                            e.parent as org_parent,
                            e.nama_posisi as parent_posname,
                            e.jobtitle_code as parent_jobtitle,
                            g.orderid as parent_orderid,
                            pathy.parent_path as parent_parentpath,
                            e.people_id as  parent_empno,
                            i.full_name as parent_name,
                            h.work_location_code as parent_plant,
                            h.cost_code as parent_costcenter,
                            CASE 
                                WHEN Ngap.posisi_id is not null AND (CAST(x1.orderid as SIGNED) - CAST(IFNULL(f.orderid,'0') as SIGNED) = 1) 
                                    THEN (CAST(f.orderid as SIGNED) - CAST(IFNULL(g.orderid,'0') as SIGNED)) + CAST(x1.orderid as SIGNED) - CAST(IFNULL(f.orderid,'0') as SIGNED)
                                ELSE CAST(f.orderid as SIGNED) - CAST(IFNULL(g.orderid,'0') as SIGNED)
                            END AS gap,
                            a.Direktorat_id,
                            a.Division_id,
                            a.Departemen_id
                            from od_tempmigrateposition a
                            left join (select distinct departemen_id,departemen_name from od_tempmigrateorgunit) b on b.departemen_id = a.departemen_id
                            left join (select distinct division_id,division_name from od_tempmigrateorgunit) c on c.division_id = a.division_id
                            left join (select distinct direktorat_id,direktorat_name from od_tempmigrateorgunit) d on d.direktorat_id = a.direktorat_id
                            left join od_tempmigrateposition e on e.posisi_id = a.parent
                            left join od_orglevel f on f.level_cat = a.jobtitle_code
                            left join od_orglevel g on g.level_cat = e.jobtitle_code
                            left join TEODEMPCOMPANY h on h.emp_no = e.people_id
                            left join TEOMEMPPERSONAL i on i.emp_id = h.emp_id
                            left join od_tempmigrateposition Ngap on Ngap.parent = a.parent and Ngap.jobtitle_code = e.jobtitle_code  
                            left join od_orglevel x1 on x1.level_cat = Ngap.jobtitle_code
                            left join od_tempmigratepositionpath pathx on pathx.position_id = a.posisi_id
                            left join od_tempmigratepositionpath pathy on pathy.position_id = a.parent
                            where a.posisi_id <> '0'
                            order by a.parent,a.posisi_id ASC");

                            if($insert_tempmigratefinaldata){

                                // Verifikasi GAP
                                

                                // $untuk_echo = '$process_UPD_add_'.$var_print;
                                // Verifikasi GAP

                                // STEP 5
                                // include "index_2_teomposition_V1A.php";

                                include "BuatOji.php";
                                
                                          
	



                                // STEP 5


                                // if($process_UPD_add_.$var_print){

                                //     echo"<script type='text/javascript'>
                                //     window.alert('Berhasil insert_teomposition_b1!'); 
                                //     window.redirect('/interface-od');
                                //     </script>"; 

                                // }else{

                                //     echo"<script type='text/javascript'>
                                //     window.alert('Gagal insert_teomposition_b1!'); 
                                //     window.redirect('/interface-od');
                                //     </script>"; 

                                // }

                                

                            }else{
                                echo"<script type='text/javascript'>
                                window.alert('Gagal insert_tempmigratefinaldata!'); 
                                window.redirect('/interface-od');
                                </script>"; 
                            }

        }elseif(isset($_POST['abort'])){
            // DELETE TABLE tempmigratepositionpath
            $delete_tempmigratepositionpath     = mysqli_query($masuk, "TRUNCATE od_tempmigratepositionpath");
            // DELETE TABLE tempmigratepositionpath

            if($delete_tempmigratepositionpath){
                // DELETE TABLE tempmigrateposition
                $delete_tempmigrateposition  = mysqli_query($masuk, "TRUNCATE od_tempmigrateposition");
                // DELETE TABLE tempmigrateposition
                if($delete_tempmigrateposition){
                    echo"<script type='text/javascript'>
                                window.alert('Berhasil Abort!'); 
                                window.redirect('/interface-od');
                                </script>";
                }
            }

        }
	?>

    <script>
        $(document).ready(function(){

            $("#image").fadeOut("slow");  
            $("#imagebg").fadeOut("slow");  
            $("#loadings").fadeOut("slow");  

            $(document).on('change', '#tipe_data', function(){
                var id    = $(this).val();

                if(id == '1'){
                    const tipe_migrateorgunit = $("#tipe_migrateorgunit");
                    tipe_migrateorgunit.css("display", "");

                    const tipe_tempmigrateposition = $("#tipe_tempmigrateposition");
                    tipe_tempmigrateposition.css("display", "none");

                    const pos_emp = $("#pos_emp");
                    pos_emp.css("display", "none");
                }else if(id == '2'){
                    const tipe_migrateorgunit = $("#tipe_migrateorgunit");
                    tipe_migrateorgunit.css("display", "none");

                    const tipe_tempmigrateposition = $("#tipe_tempmigrateposition");
                    tipe_tempmigrateposition.css("display", "");

                    const pos_emp = $("#pos_emp");
                    pos_emp.css("display", "none");
                }else if(id == '3'){
                    const tipe_migrateorgunit = $("#tipe_migrateorgunit");
                    tipe_migrateorgunit.css("display", "none");

                    const tipe_tempmigrateposition = $("#tipe_tempmigrateposition");
                    tipe_tempmigrateposition.css("display", "none");

                    const pos_emp = $("#pos_emp");
                    pos_emp.css("display", "");
                }
            });

            $(document).on('click', '#upload_mig', function(){
                const imagebg = $("#imagebg");
                imagebg.css("display", "block");
                const loadings = $("#loadings");
                loadings.css("display", "block");
                const image = $("#image");
                image.css("display", "block");
            });

            $(document).on('click', '#upload_temp', function(){
                const imagebg = $("#imagebg");
                imagebg.css("display", "block");
                const loadings = $("#loadings");
                loadings.css("display", "block");
                const image = $("#image");
                image.css("display", "block");
            });

            $(document).on('click', '#upload_posemp', function(){
                const imagebg = $("#imagebg");
                imagebg.css("display", "block");
                const loadings = $("#loadings");
                loadings.css("display", "block");
                const image = $("#image");
                image.css("display", "block");
            });

            $(document).on('click', '#lanjut', function(){
                alert('Test');
                const imagebg = $("#imagebg");
                imagebg.css("display", "block");
                const loadings = $("#loadings");
                loadings.css("display", "block");
                const image = $("#image");
                image.css("display", "block");
            });

            $(document).on('click', '#berhenti', function(){
                const imagebg = $("#imagebg");
                imagebg.css("display", "block");
                const loadings = $("#loadings");
                loadings.css("display", "block");
                const image = $("#image");
                image.css("display", "block");
            });
            
        });
    </script>




    </body>
</html>