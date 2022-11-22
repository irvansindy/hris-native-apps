<?php include "../../application/session/session.php";?>
<?php include "../template/sys.header.php";?>
<?php include "../template/sys.sidebar.php";?>
<link href="orgchart/orgchart.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="orgchart/orgchart.js"></script>
<script src="orgchart/jquery.min.js"></script>
<!-- <link rel="stylesheet" href="asset/bootstrap/dist/css/bootstrap.min.css"> -->
<script src="asset/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="asset/html2canvas.js"></script>

<?php 
$page   = '2'; //menu id SELECT * FROM hrmmenu WHERE menu_id = '2'
$footer = 'yes'; //set as `yes` if you want to use default footer & set as `no` if you want to use custom footer
?>

<!-- LOADER -->
<div onclick='return stopload()' id="divBlockSpace" class="divBlockSpace"></div>
<div onclick='return stopload()' id="loading-circle"></div>
<div id="contents"></div>
<!-- <div class="loader"></div> -->
<!-- LOADER -->

<!-- Mengambil Informasi Position User -->
        <?php 
            $emp_no = $_SESSION['username'];
            $page   = isset($_POST['page']) ? $_POST['page'] : 0;
            $dept   = isset($_POST['dept']) ? $_POST['dept'] : 0;
            $view   = isset($_POST['filter']) ? $_POST['filter'] : 0;
            
            // Mengambil grade paling tinggi di table od_simpeople
            $query_grade_awal   = mysqli_query($connect, "SELECT a.grade FROM od_simpeople a ORDER BY a.grade DESC LIMIT 1");
            
            $data_grade_awal    = mysqli_fetch_array($query_grade_awal);
            $grade_awal         = $data_grade_awal['grade'];
            
            // Mengambil informasi departemen, division dan directorat dari user yang login pada table od_simpeople
            $query_data_user     = mysqli_query($connect, "SELECT a.departemen_id, a.division_id, a.direktorat_id FROM od_simposisi a left join od_tempmigrateemp x on x.posisi_id = a.posisi_id 
            WHERE x.emp_no = '$emp_no'");
            $data_user          = mysqli_fetch_assoc($query_data_user);
            
            $departemen_id        = $data_user['departemen_id'];
            $division_id          = $data_user['division_id'];
            $direktorat_id        = $data_user['direktorat_id'];

            // Melihat data user yang login admin atau sumper admin dari session login
            if($_SESSION['user_type'] == 'SuperAdmin'){
                $level            = '1';
            }elseif($_SESSION['user_type'] == 'Admin'){
                $level            = '2';
            }


            if($departemen_id == '0' && $division_id != '0'){
                // $pos_id_awal    = $data_user['div_pos_id'];
                $pos_id_awal    = 'HAHA';
            }elseif($departemen_id == '0' && $division_id == '0'){
                // $pos_id_awal    = $data_user['dir_pos_id'];
                $pos_id_awal    = 'HAHA';
            }elseif($departemen_id != '0' && $division_id != '0'){
                // $pos_id_awal    = $data_user['dept_pos_id'];
                $pos_id_awal    = 'HAHA';

            }

            // Mengambil orderId dari user yang login
            $query_data_order   = mysqli_query($connect, "SELECT a.orderId FROM od_simposisi a left join od_tempmigrateemp x on x.posisi_id = a.posisi_id WHERE x.emp_no = '$emp_no'");
            $data_order         = mysqli_fetch_assoc($query_data_order);
            $oderId             = $data_order['orderId'];
            
        ?>
<!-- Mengambil Informasi Position User -->

        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper" style="display: block;">
            <div class="row page-titles">
                <div class="col-md-5 col-12 align-self-center">
                    <h3 class="text-themecolor mb-0">View Organisasi</h3>
                    <ol class="breadcrumb mb-0 p-0 bg-transparent">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home&nbsp;&nbsp;</a></li>
                        <li ><i class="fa fa-angle-right" aria-hidden="true"></i>&nbsp;View Organisasi Filter</li>
                    </ol>
                </div>
                <div class="col-md-7 col-12 align-self-center d-none d-md-block">
                    <div class="d-flex mt-2 justify-content-end">
                    </div>
                </div>
            </div>


            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid" style="padding: 0px 10px">
                <!-- Row -->
                <div class="row">
                    <div class="col-lg-12 col-md-12">

                        <div class="row">
                           
                            <!-- Column -->
                            <div class="col-md-12">
                                <div class="card">
                                    <div style="margin-top:5px; margin-left:10px">
                                    <!-- <form  id=""> -->
                                        <div class="form-row">
                                            <div class="input-group">
                                                <div class="col-sm-6">
                                                    <h4>Filter Untuk Menampilkan Struktur Organisasi</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="input-group">
                                            
                                                            <div class="col-sm-3">
                                                            <select class="input--style-6" name="direktorat" id="direktorat" style="width: ;height: 30px;" >
                                                
                                                                <?php 
                                                                if($level == '1'){
                                                                    $query_ambil_dir     = mysqli_query($connect, "SELECT 
                                                                    DISTINCT(a.direktorat_id),
                                                                    a.direktorat_name
                                                                    FROM od_tempmigrateorgunit a");
                                                                    ?>
                                                                    <option value="0">Choose Directorate</option>
                                                                    <option value="all">ALL DIRECTORATE</option>
                                                                    <?php
                                                                }elseif($level == '2'){
                                                                    
                                                                        $query_ambil_dir     = mysqli_query($connect, "SELECT 
                                                                        DISTINCT(a.direktorat_id),
                                                                        a.direktorat_name
                                                                        FROM od_tempmigrateorgunit a
                                                                        WHERE a.direktorat_id = '$direktorat_id'");
                                                                    
                                                                    ?>
                                                                    
                                                                    <?php
                                                                }
                                                                while($data_ambil_dir = mysqli_fetch_assoc($query_ambil_dir)){
                                                                    if($level == '1'){
                                                                ?>
                                                                    <option value="<?php echo $data_ambil_dir['direktorat_id'] ?>"><?php echo $data_ambil_dir['direktorat_name'] ?></option>
                                                                <?php }else{
                                                                    ?>
                                                                    <option value="<?php echo $data_ambil_dir['direktorat_id'] ?>"><?php echo $data_ambil_dir['direktorat_name'] ?></option>
                                                                <?php } } ?>
                                                            </select>
                                                            </div>
                                            </div>
                                        </div> 
                                        <div class="form-row">
                                            <div class="input-group">
                                            
                                                            <div class="col-sm-3">
                                                            <select class="input--style-6" name="division" id="division" style="width: ;height: 30px;" >
                                                        
                                                        <?php 
                                                        if($level == '1'){
                                                            $query_ambil_divisi     = mysqli_query($connect, "SELECT 
                                                            DISTINCT(a.division_id),
                                                            a.division_name
                                                            FROM od_tempmigrateorgunit a
                                                            WHERE a.division_id IS NOT NULL");
                                                            ?>
                                                            <option value="0">Choose Division</option>
                                                            <?php
                                                        }elseif($level == '2'){
                                                            

                                                                $query_ambil_divisi     = mysqli_query($connect, "SELECT 
                                                                DISTINCT(a.division_id),
                                                                a.division_name
                                                                FROM od_tempmigrateorgunit a
                                                                WHERE a.division_id IS NOT NULL
                                                                AND a.division_id = '$division_id'");
                                                            
                                                                if($departemen_id == '0' && $division_id == '0'){

                                                                $query_ambil_divisi     = mysqli_query($connect, "SELECT 
                                                                DISTINCT(a.division_id),
                                                                a.division_name
                                                                FROM od_tempmigrateorgunit a
                                                                WHERE a.division_id IS NOT NULL
                                                                AND a.direktorat_id = '$direktorat_id'");
                                                            ?>
                                                            <option value="0">Choose Division</option>
                                                            <?php }
                                                        
                                                        }
                                                        while($data_ambil_divisi = mysqli_fetch_assoc($query_ambil_divisi)){
                                                            if($level != '1'){
                                                        ?>
                                                            <option value="<?php echo $data_ambil_divisi['division_id'] ?>"><?php echo $data_ambil_divisi['division_name'] ?></option>
                                                        <?php }else{
                                                            ?>
                                                            
                                                        <?php } } ?>
                                                        </select>
                                                                </select>
                                                            </div>
                                            </div>
                                        </div>    
                                        <div class="form-row">
                                                <div class="input-group">

                                                            <div class="col-sm-3">
                                                            <select class="input--style-6" name="departement" id="departement" style="width: ;height: 30px;">
                                                        
                                                        <?php 
                                                            if($level == '2'){
                                                                if($departemen_id != '0'){
                                                                    $query_departement  = mysqli_query($connect, "SELECT * FROM od_tempmigrateorgunit WHERE departemen_id = '$departemen_id'");
                                                                }else{
                                                                    ?>
                                                                    <option value="0">Choose Departement</option>
                                                                    <?php 
                                                                    $query_departement = mysqli_query($connect, "SELECT 
                                                                    DISTINCT(a.departemen_id),
                                                                    a.departemen_name
                                                                    FROM od_tempmigrateorgunit a
                                                                    WHERE a.departemen_id IS NOT NULL AND a.departemen_id <> '-' AND a.departemen_name <> '' AND a.departemen_name <> '-'
                                                                    AND a.division_id = '$division_id'");
                                                                }                                                                
                                                                while($data_departement = mysqli_fetch_assoc($query_departement)){
                                                                    ?>
                                                                        <option value="<?php echo $data_departement['departemen_id']; ?>" ><?php echo $data_departement['departemen_name']; ?></option>
                                                                    <?php }
                                                                    
                                                            }elseif($level == '1'){
                                                                ?>
                                                                <option value="0">Choose Departement</option>
                                                                <?php 
                                                                $query_departement = mysqli_query($connect, "SELECT * FROM od_tempmigrateorgunit WHERE departemen_id <> '' AND division_id <> ''");
                                                                while($data_departement = mysqli_fetch_assoc($query_departement)){
                                                                    ?>
                                                                        
                                                                    <?php }
                                                            }
                                                        ?>
                                                        <!-- <option value="HODHR">DIVISION HR</option>
                                                        <option value="HODHR">DIVISION GA</option> -->
                                                        </select>
                                                            </div>
                                                </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="input-group">
                                                            <div class="col-sm-3">
                                                                <select class="input--style-6" name="filterview" id="filterview" style="width: ;height: 30px;">
                                                                    <option value="0">Pilih Tampilan</option>
                                                                    <option value="1" <?php if($view == '1'){ echo "selected"; } ?>>View All</option>
                                                                    <option value="2" <?php if($view == '2'){ echo "selected"; } ?>>View Summary</option>
                                                                </select>
                                                            </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="input-group">

                                                            <div class="col-sm-3" style="text-align:right">
                                                                <button class="btn btn-primary btn-sm" id="haha1"><b>View Struktur</b></button>
                                                            </div>
                                            </div>
                                        </div>

                                        
                                    </div>
                                </div>

                                <!-- <input type="hidden" id="preview" value="0"> -->
                                <div id="preview" style="display:none"></div>
                                <input type="hidden" class="filterview" id="bisa" value="0">
                                <input type="hidden" class="valpage" id="valpage" value="<?php echo $pos_id_awal; ?>">
                                
                                <input type="hidden" id="namadept1" value="0">
                                <input type="hidden" id="tableterpakai" value="0">
                                <input type="hidden" id="username" value="<?php echo $username; ?>">
                                <input type="hidden" id="positionid" value="<?php echo $position_id; ?>">
                                <input type="hidden" id="deptposid" value="<?php echo $departemen_id; ?>">
                                <input type="hidden" id="divposid" value="<?php echo $division_id; ?>">
                                <input type="hidden" id="posidawal" value="<?php echo $pos_id_awal; ?>">
                                <input type="hidden" id="orderid" value="<?php echo $oderId; ?>">
                                <input type="hidden" id="level" value ="<?php echo $level; ?>">


                                <!-- Parameter 15 Oktober 2021 -->
                                <input type="hidden" id="dept_int" value="<?php echo $departemen_id ?>">
                                <input type="hidden" id="div_int" value="<?php echo $division_id ?>">
                                <input type="hidden" id="dir_int" value="<?php echo $direktorat_id ?>">

                                <input type="hidden" id="namadiv1" value="0">
                                <input type="hidden" id="namadept2" value="0">
                                <input type="hidden" id="namadir" value="0">
                                <input type="hidden" id="namadir1" value="0">


                                <!-- 22 November 2021 -->
                                <input type="hidden" id="paramdept" value="0">
                                <input type="hidden" id="paramdiv" value="0">
                                <input type="hidden" id="paramdir" value="0">                                                     
                                <!-- 22 November 2021 -->


                                <input type="hidden" id="filter_tittle" value="0">
                                <input type="hidden" id="page_tittle" value="0">
                                <input type="hidden" id="tampung_filter" value="0">


                                <div id="semua">
                                <div class="card-body table-responsive p-0"
                                     style="width: 100vw;height: 85vh; width: 99.8%; margin: 5px;overflow: scroll;"
                                        id="haha"
                                        >                                
                                <table>
                                    <td>
                                        <div id="tampilantittle"></div>
                                    </td>
                                    <td>
                                        <div class="" id="tampilan"></div>
                                    </td>
                                </table>
                                </div>
                                </div>

                            </div>
                            <!-- Column -->
                        </div>
                    </div>
                   
                        
                </div>
                <!-- Row -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <?php include "../template/sys.footer.php";?>

<script>
$(document).ready(function(){
    $(document).on('change', '#direktorat', function(){

        
        const namaperusahaan = $("#namaperusahaan");
        namaperusahaan.css("display", "none");

        $('#namadept2').val('0');
        $('#namadiv1').val('0');
        $('#namadir').val('0');

        $('#paramdir').val('1');
        $('#paramdiv').val('0');
        $('#paramdept').val('0');

        const amake = $("#a-make");
        const adownload = $("#a-download");
        amake.css("display", "");
        adownload.css("display", "none");

        // Mengambil Data Division by Direktorat
        var dir    = $('#direktorat').val();

        // alert(dir);



        $.ajax({
                url:"division.php",
                method:"POST",
                data:{dir:dir},
                success:function(data){
                    $('#division').html(data);
                }

        });
        // Mengambil Data Division by Direktorat

        // Mengambil Data Departemen by Division
            
            $.ajax({
                    url:"departement.php",
                    method:"POST",
                    data:{division:dir},
                    success:function(data){
                        $('#departement').html(data);
                    }

            });
            // Mengambil Data Departemen by Division

        // Uncheck check box view all dan summary
        $(".view1").prop("checked", false);
        $(".view2").prop("checked", false);
        $(".view1").attr('id', '0');
        $(".view2").attr('id', '0');
        // Uncheck check box view all dan summary

        // Merubah value view summary dan all menjadi 0
        $("#bisa").val("0");
        // Merubah value view summary dan all menjadi 0


    })
});
</script>

<script>
$(document).ready(function(){
    $(document).on('change', '#division', function(){
            const namaperusahaan = $("#namaperusahaan");
            namaperusahaan.css("display", "none");
            var valuediv    = $(this).val();

            $('#namadept2').val('0');
            $('#namadiv1').val('0');
            if(valuediv != '0'){
                $('#paramdiv').val('1');
            }else{
                $('#paramdiv').val('0');
            }
            $('#paramdept').val('0');


            const amake = $("#a-make");
            const adownload = $("#a-download");
            amake.css("display", "");
            adownload.css("display", "none");
            
            // Mengambil Data Departemen by Division
            var division    = $('#division').val();
            // alert(division);
            
            $.ajax({
                    url:"departement.php",
                    method:"POST",
                    data:{division:division},
                    success:function(data){
                        $('#departement').html(data);
                    }

            });
            // Mengambil Data Departemen by Division

            // Uncheck check box view all dan summary
            $(".view1").prop("checked", false);
            $(".view2").prop("checked", false);
            $(".view1").attr('id', '0');
            $(".view2").attr('id', '0');
            // Uncheck check box view all dan summary

            // Merubah value view summary dan all menjadi 0
            $("#bisa").val("0");
            // Merubah value view summary dan all menjadi 0

            
        
            

    })
});
</script>

<script>
$(document).ready(function(){
    $(document).on('change', '#departement', function(){
                const namaperusahaan = $("#namaperusahaan");
                namaperusahaan.css("display", "none");

                var valuedept    = $(this).val();

                if(valuedept != '0'){
                    $('#paramdept').val('1');
                }else{
                    $('#paramdept').val('0');
                }


                $('#namadept2').val('0');
                $('#namadept1').val('0');
                // $('#namadiv1').val('0');

                const amake = $("#a-make");
                const adownload = $("#a-download");
                amake.css("display", "");
                adownload.css("display", "none");

                var tampilan = $('#bisa').val();
                if(tampilan == 2){
                    filter = 2;
                }else if(tampilan == 1){
                    filter = 1;
                }
                else{
                    filter = 0;
                }
                var page = $("#departement").val();

                // Uncheck check box view all dan summary
                $(".view1").prop("checked", false);
                $(".view2").prop("checked", false);
                $(".view1").attr('id', '0');
                $(".view2").attr('id', '0');
                // Uncheck check box view all dan summary

                // Merubah value view summary dan all menjadi 0
                $("#bisa").val("0");
                // Merubah value view summary dan all menjadi 0

        });
});
</script>

<script>
    $(document).ready(function(){
        // $('body').css('MozTransform','scale(1)');
        var getCanvas; // global variable

        function makeScreenshot()
        {
            var namadiv1     = $('#namadiv1').val();
            var namadept2    = $('#namadept2').val();
            var namadownload;

            if(namadiv1 != '0' && namadept2 == '0'){
                namadownload = namadiv1;
            }
            if(namadiv1 != '0' && namadept2 != '0'){
                namadownload = namadept2;
            }
            if(namadiv1 = '0' && namadept2 != '0'){
                namadownload = namadept2;
            }

            var today = new Date();

            var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();

            window.scrollTo(0,0);

            html2canvas(document.getElementById("tree-view"),{scrollY: -window.scrollY}, {scale: 50,}).then(
				function (canvas) {
                // canvas.id = "canvasID";
                getCanvas = canvas;
                var main = document.getElementById("preview");
;

                var imgageData = getCanvas.toDataURL("image/png", 1);
                // Now browser starts downloading it instead of just showing it
                var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");

                var link = document.createElement('a');
    
                document.body.appendChild(link); // Firefox requires the link to be in the body
                link.download = 'ORG_'+namadownload+'_'+date+'.png';
                link.href = newData;
                link.click();
                document.body.removeChild(link);
            });
       
        }

        $(document).on('click', '#a-make', function(){
            alert("Masuk");
            
            const gambarplus = $('[id="gambarplus"]');
            
            gambarplus.css("display", "none");

            // document.body.style.zoom = (window.innerWidth / window.outerWidth);


            // document.getElementById("a-make").style.display = "none";
            
            // Loader

            

            const loading = $(".loader");
            loading.css("display", "block");
        
                setTimeout(function() {
                           
                 $(".loader").fadeOut("slow");                     
                }, 6000);
                // Loader
            gambarplus.css("display", "");
            makeScreenshot();

        
            // document.getElementById("a-download").style.display = "inline";
        });

        $(document).on('click', '#a-download', function(){
            // this.href = document.getElementById("canvasID").toDataURL();
            // this.download = "canvas-image.png";
            var imgageData = getCanvas.toDataURL("image/png", 1);
            // Now browser starts downloading it instead of just showing it
            var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
            $("#a-download").attr("download", "Struktur Organisasi.png").attr("href", newData);
        });
    })
</script>

    
<script>
    $(document).ready(function(){

        var dept    = $('#dept_int').val();
        var div     = $('#div_int').val();
        var dir     = $('#dir_int').val();
        var level   = $('#level').val();
        var order   = $('#orderid').val();

        // filter awal
        if(dept != '-' && div != '-' && dir != '-'){
            $('#paramdept').val('1');
            $('#paramdiv').val('1');
            $('#paramdir').val('1');
        }else if(dept == '-' && div != '-' && dir != '-'){
            $('#paramdept').val('0');
            $('#paramdiv').val('1');
            $('#paramdir').val('1');
        }else if(dept == '-' && div == '-' && dir != '-'){
            $('#paramdept').val('0');
            $('#paramdiv').val('0');
            $('#paramdir').val('1');
        }
        // filter awal
        

        $(document).on('change', '#filterview', function(){
           var filterview   = $(this).val();
           $('#tampung_filter').val(filterview);

        });


    });
 </script>

<script>
    $(document).keydown(function(event) {
if (event.ctrlKey==true && (event.which == '61' || event.which == '107' || event.which == '173' || event.which == '109'  || event.which == '187'  || event.which == '189'  ) ) {
        event.preventDefault();
     }
});

$(window).bind('mousewheel DOMMouseScroll', function (event) {
       if (event.ctrlKey == true) {
       event.preventDefault();
       }
});
</script>


<script>
        $(document).ready(function(){
            $(document).on('click', '#haha1', function(){
                
                var valfilter       = $('#filterview').val();
                if(valfilter == '1'){

                    var tampungdir      = $('#direktorat').val();
                    var tampungdiv      = $('#division').val();
                    var tampungdept     = $('#departement').val();
                    var tampungfilter   = $('#tampung_filter').val();
                    var tampunglevel    = $('#level').val();
                    var paramdept       = $('#paramdept').val();
                    var paramdiv        = $('#paramdiv').val();
                    var paramdir        = $('#paramdir').val();


                    // Load data
                    $.post('popuporg.php',{tampungdir:tampungdir, tampungdiv:tampungdiv, tampungdept:tampungdept, tampungfilter:tampungfilter, tampunglevel:tampunglevel, paramdept:paramdept, paramdiv:paramdiv, paramdir:paramdir}, function (data) {
                    var w = window.open('about:blank', 'width=1500,height=1000,top=70,left=100,resizable=1,menubar=yes', true);
                    w.document.open();
                    w.document.write(data);
                    w.document.close();
                    // w.document.focus();
                    });


                
                }else if(valfilter == '2'){
                
                    // Load data
                    var tampungdir      = $('#direktorat').val();
                    var tampungdiv      = $('#division').val();
                    var tampungdept     = $('#departement').val();
                    var tampungfilter   = $('#tampung_filter').val();
                    var tampunglevel    = $('#level').val();
                    var paramdept       = $('#paramdept').val();
                    var paramdiv        = $('#paramdiv').val();
                    var paramdir        = $('#paramdir').val();


                    $.post('popuporg.php',{tampungdir:tampungdir, tampungdiv:tampungdiv, tampungdept:tampungdept, tampungfilter:tampungfilter, tampunglevel:tampunglevel, paramdept:paramdept, paramdiv:paramdiv, paramdir:paramdir}, function (data) {
                    var w = window.open('about:blank','width=1500,height=1000,top=70,left=100,resizable=1,menubar=yes', true);
                    w.document.open();
                    w.document.write(data);
                    w.document.close();
                    // w.document.focus();
                    });


            }else if(valfilter == '0'){
alert('Please choose filter type!');
}
                

                
            });
        });
    </script>
        



            