<?php 
// $page    = $_POST['page'];
// $filter    = $_POST['filter'];
// $dept    = $_POST['dept'];

$tampungdir     = $_POST['tampungdir'];
$tampungdiv     = $_POST['tampungdiv'];
$tampungdept    = $_POST['tampungdept'];
$tampungfilter  = $_POST['tampungfilter'];
$tampunglevel   = $_POST['tampunglevel'];
$paramdept      = $_POST['paramdept'];
$paramdiv       = $_POST['paramdiv'];
$paramdir       = $_POST['paramdir'];

?>
<?php include "../../application/session/session.php";?>

<!-- <p>Tampung Dir : <?php echo $tampungdir; ?></p>
<p>Tampung Div : <?php echo $tampungdiv; ?></p>
<p>Tampung Dept : <?php echo $tampungdept; ?></p>
<p>Tampung Filter : <?php echo $tampungfilter; ?></p>
<p>Tampung Level : <?php echo $tampunglevel; ?></p> -->


<?php

if(empty($_SESSION['username'])){
    echo "<meta http-equiv='refresh' content='1;url=login.php'>";

}else{
    ?>

<?php 
 $u_agent   = $_SERVER['HTTP_USER_AGENT'];
 $bname     = 'unknown';
 $ub        = 'unknown';

 if(preg_match('/MSIE/i',$u_agent)){
     $bname = 'Internet Explorer';
     $ub    = 'MSIE';
 }elseif(preg_match('/Firefox/i',$u_agent)){
     $bname = 'Mozilla Firefox';
     $ub    = 'Firefox';
 }elseif(preg_match('/Chrome/i',$u_agent)){
     $bname = 'Google Chrome';
     $ub    = 'Chrome';
 }else{
     $bname = 'notsupport';
     $ub    = 'notsupport';
 }

 if($bname == 'notsupport'){
    echo"<script type='text/javascript'>
    window.alert('Please use Chrome or Firefox!');
    window.close();
</script>
";
 }elseif($bname == 'Internet Explorer'){
    echo"<script type='text/javascript'>
    window.alert('Please use Chrome or Firefox!');
    window.close();
    
</script>
";
 }else{

 
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
        <meta name="viewport" content="width=device-width, user-scalable=no">
      
        <title>Tampilan Struktur</title>
        <script src="jquery.min.js"></script>
        
        <link href="orgchart/orgchart.css" rel="stylesheet" type="text/css"/>
        
        
        
        
        <script type="text/javascript" src="orgchart/orgchart.js"></script>
        <!-- <link rel="stylesheet" href="asset/bootstrap.min_5.css"> -->
        <link rel="stylesheet" href="asset/bootstrap/dist/css/bootstrap.min.css">
        <script src="asset/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- <script src="asset/html2canvas.min.js"></script> -->
        <script src="asset/html2canvas.js"></script>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.js"></script> -->


        <!-- Ikon Login -->
        <style>
        .loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('images/loading2.gif') 50% 50% no-repeat rgb(249,249,249);
            opacity: 1;
        }
        </style>
        <!-- Ikon Login -->

                <!-- Ikon loading BAN -->
                <style type="text/css">
    
    
    
    #image {
        display: block;
        position: fixed;
        top: -1% 255PX;
        left: 0;
        z-index: 13;
        width: 100%;
        height: 100%;
        background-image: url("asset/loading/logo-Recovered.png");
        background-size: 5%;
        background-repeat: no-repeat;
        background-position: center;
        animation: spin 6s linear infinite

    }


    #image2 {
        display: block;
        position: fixed;
        top: -1% 255PX;
        left: 0;
        z-index: 13;
        width: 100%;
        height: 100%;
        background-image: url("asset/loading/logo-Recovered.png");
        background-size: 5%;
        background-repeat: no-repeat;
        background-position: center;
        animation: spin 6s linear infinite

    }
    

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
    

    
</style>
<!-- Ikon loading BAN -->

    </head>
    <body>
        <!-- <div class="loader"></div> -->
        <div id="image" style="margin-left:46%; margin-top:18%"></div>
        <div id="image2" style="margin-left:46%; margin-top:18%"></div>

        <!-- Mengambil Informasi Position User -->
        <?php 
            $emp_no = $_SESSION['username'];
            // $page   = isset($_POST['page']) ? $_POST['page'] : 0;
            // $dept   = isset($_POST['dept']) ? $_POST['dept'] : 0;
            // $view   = isset($_POST['filter']) ? $_POST['filter'] : 0;
            
            

            
                
            

            $query_grade_awal   = mysqli_query($connect, "SELECT * FROM od_simpeople a ORDER BY a.grade DESC LIMIT 1");
            
            $data_grade_awal    = mysqli_fetch_array($query_grade_awal);
            $grade_awal         = $data_grade_awal['grade'];

            $query_data_user     = mysqli_query($connect, "SELECT * FROM hrmorgpositionuser a WHERE a.emp_no = '$emp_no'");
            $data_user          = mysqli_fetch_assoc($query_data_user);
            $position_id        = $data_user['position_id'];
            $dept_pos_id        = $data_user['dept_pos_id'];
            $div_pos_id         = $data_user['div_pos_id'];
            $dir_pos_id         = $data_user['dir_pos_id'];
            $com_pos_id         = $data_user['com_pos_id'];
            $level              = $data_user['level'];

            if($dept_pos_id == '0' && $div_pos_id != '0'){
                $pos_id_awal    = $data_user['div_pos_id'];
            }elseif($dept_pos_id == '0' && $div_pos_id == '0'){
                $pos_id_awal    = $data_user['dir_pos_id'];
            }elseif($dept_pos_id != '0' && $div_pos_id != '0'){
                $pos_id_awal    = $data_user['dept_pos_id'];
            }

            $query_data_order   = mysqli_query($connect, "SELECT * FROM hrmorgintstruc a WHERE a.people_id = '$emp_no'");
            $data_order         = mysqli_fetch_assoc($query_data_order);
            $oderId             = $data_order['orderId'];
            
        ?>
<!-- Mengambil Informasi Position User -->
                                            <?php
                                                // if($view == '1' || $view == '2'){
                                                //     $tampil     = '';
                                                // }else{
                                                //     $tampil     = 'none';
                                                // }
                                            ?>

                        <div style="margin-top:20px; margin-left:20px; ">
                            <!-- <div> -->
                                <!-- <table>
                                    <tr>
                                       
                                    </tr>

                                    <tr>
                                        <td style="height:60px; width:50%">
                                                        <table>
                                                            <tr id="namadiv" style="display:none">
                                                                
                                                                <td style="width:100px">Division</td>
                                                                <td style="width:10px">:</td>
                                                                <td><div id="ambilnamadivisi"></div></td>
                                                            </tr>
                                                            <tr id="namadept" style="display:none">
                                                               
                                                                <td style="width:100px; height:30px">Departement</td>
                                                                <td style="width:10px">:</td>
                                                                <td><div id="ambilnamadept"></div></td>
                                                            </tr>
                                                            <tr id="namaperusahaan" style="display:none">
                                                               
                                                                <td style="width:100%px; height:30px">PT GAJAH TUNGGAL Tbk</td>
                                                            
                                                            </tr>
                                                            <tr id="namaperusahaan" style="display:none">
                                                               
                                                                <td style="width:100%px; height:30px">
                                                                    <div id="ambilnamadir"></div>
                                                                </td>
                                                            
                                                            </tr>
                                                        </table>
                                        </td>
                                        <td style="width:50%; text-align:right">
                                            <table>
                                                <tr>
                                                    
                                                    <td style="width: 90px">
                                                        <div>
                                                            <a id="a-make" class="" href="#"><img src="images/camera.png" alt="" style="width:30px; height:25px"></a>
                                                        </div>
                                                    </td>
                                                   
                                                </tr>
                                                
                                                
                                            </table>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <hr>
                                        </td>
                                    </tr>
                                    
                                    
                                </table> -->
                               
                            <!-- </div> -->
                            <div class="row">
                                <!-- <div class="col-sm-6">
                                    <table>
                                        <tr>
                                            <td >
                                                            <table>
                                                                <tr id="namadiv" style="display:none">
                                                                    
                                                                    <td style="width:100px">Division</td>
                                                                    <td style="width:10px">:</td>
                                                                    <td><div id="ambilnamadivisi"></div></td>
                                                                </tr>
                                                                <tr id="namadept" style="display:none">
                                                                
                                                                    <td style="width:100px; height:30px">Departement</td>
                                                                    <td style="width:10px">:</td>
                                                                    <td><div id="ambilnamadept"></div></td>
                                                                </tr>
                                                                <tr id="namaperusahaan" style="display:none">
                                                                
                                                                    <td style="width:100%px; height:30px">PT GAJAH TUNGGAL Tbk</td>
                                                                
                                                                </tr>
                                                                <tr id="namaperusahaan" style="display:none">
                                                                
                                                                    <td style="width:100%px; height:30px">
                                                                        <div id="ambilnamadir"></div>
                                                                    </td>
                                                                
                                                                </tr>
                                                            </table>
                                            </td>
                                        </tr>
                                    </table>
                                </div> -->
                                <div class="col-sm-3" >
                                    <table>
                                                <tr>
                                                    
                                                    <td >
                                                        <div>
                                                            <a id="a-make" class="" href="#"><img src="images/camera.png" alt="" style="width:60px; height:50px"><b>Download Org. Structure Picture</b></a>
                                                        </div>
                                                    </td>
                                                   
                                                </tr>
                                                
                                                
                                    </table>
                                </div>
                            </div>


                        </div>
        
                        <!-- Hasil Lemparan filter -->
                        <input type="hidden" id="tampungdir" value="<?php echo $tampungdir ?>">
                        <input type="hidden" id="tampungdiv" value="<?php echo $tampungdiv ?>">
                        <input type="hidden" id="tampungdept" value="<?php echo $tampungdept ?>">
                        <input type="hidden" id="tampungfilter" value="<?php echo $tampungfilter ?>">
                        <input type="hidden" id="tampunglevel" value="<?php echo $tampunglevel ?>">
                        <!-- Hasil Lemparan filter -->

                        <!-- Hasil query informasi posisi user -->
                        <input type="hidden" id="posisidept" value="<?php echo $dept_pos_id ?>">
                        <input type="hidden" id="posisidiv" value="<?php echo $div_pos_id ?>">
                        <input type="hidden" id="posisidir" value="<?php echo $dir_pos_id ?>">
                        <input type="hidden" id="orderid" value="<?php echo $oderId; ?>">

                        <!-- Hasil query informasi posisi user -->


                        <!-- Hasil lemparan ajax Judul Organisasi -->
                        <input type="hidden" id="tampungambilnamadept" value="0">
                        <input type="hidden" id="tampungambilnamadivisi" value="0">
                        <input type="hidden" id="tampungambilnamadir" value="0">
                        <!-- Hasil lemparan ajax Judul Organisasi -->

                        <!-- Posisi yang akan ditampilkan strukturnya -->
                        <input type="hidden" id="posisiuntuktampil" value="0">
                        <input type="hidden" id="namadept1" value="0">
                        <!-- Posisi yang akan ditampilkan strukturnya -->

                        <input type="hidden" id="filter_tittle" value="0">
                        <input type="hidden" id="page_tittle" value="0">

                        <input type="hidden" id="paramdept" value="<?php echo $paramdept ?>">
                        <input type="hidden" id="paramdiv" value="<?php echo $paramdiv ?>">
                        <input type="hidden" id="paramdir" value="<?php echo $paramdir ?>">  
                        
                        <input type="hidden" id="namadiv1" value="0">
                        <input type="hidden" id="namadept2" value="0">
                        <input type="hidden" id="namadir" value="0">
                        <input type="hidden" id="namadir1" value="0">


                        <input type="hidden" id="filter" value="0">

<div style="margin-left:20px; margin-top:5px ">
    <div class="row">
        <div id="semua" style="width:135%; background:white">
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

        




<script>
    $(document).ready(function(){
        // $('body').css('MozTransform','scale(1)');
        var getCanvas; // global variable

        function makeScreenshot()
        {
            var namadiv1     = $('#namadiv1').val();
            var namadept2    = $('#namadept2').val();
            var namadir      = $('#namadir1').val();
            var namadownload;

            if(namadir != '0' && namadiv1 != '0' && namadept2 == '0'){
                namadownload = namadiv1;
            }
            if(namadir != '0' && namadiv1 != '0' && namadept2 != '0'){
                namadownload = namadept2;
            }
            if(namadir != '0' && namadiv1 == '0' && namadept2 == '0'){
                namadownload = namadir;
            }

            var today = new Date();

            var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();

            html2canvas(document.getElementById("semua"), {scale: 5,}).then(
				function (canvas) {
                // canvas.id = "canvasID";
                getCanvas = canvas;
                var main = document.getElementById("preview");
                // while (main.firstChild) { main.removeChild(main.firstChild); }
                // main.appendChild(canvas);
                var width = getCanvas.clientWidth;
                var height = getCanvas.clientHeight;
                // alert("Gambar siap untuk diunduh");

                var imgageData = getCanvas.toDataURL("image/png", 1);
                // Now browser starts downloading it instead of just showing it
                var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");

                var link = document.createElement('a');
    
                document.body.appendChild(link); // Firefox requires the link to be in the body
                link.download = 'ORG_'+namadownload+'_'+date+'.png';
                link.href = newData;
                link.click();
                document.body.removeChild(link);
                $("#image2").fadeOut("slow");  

            });
        
        }

        $(document).on('click', '#a-make', function(){
        
            $('#preview').empty();
            // document.getElementById("testprint").setAttribute("class","wide");
            // document.getElementById('printtest1').style.width='16384px';
            const printtest1 = $("#printtest1");
            // printtest1.css("display", "none");

            // const amake = $("#a-make");
            // const adownload = $("#a-download");
            // amake.css("display", "none");
            // adownload.css("display", "");

            const gambarplus = $('[id="gambarplus"]');
            
            gambarplus.css("display", "none");

            // document.body.style.zoom = (window.innerWidth / window.outerWidth);


            // document.getElementById("a-make").style.display = "none";
            makeScreenshot();
            // Loader

            

                const loading = $(".loader");
                loading.css("display", "block");
                const loadings = $("#loadings");
                loadings.css("display", "block");


                const image = $("#image2");
                image.css("display", "block");

                // capture();  

                // function capture(){
        
                //     setTimeout(function() {

                //         var preview = $('#preview');
                    
                //         if(preview != ''){
                //             var hehe    = 'test';
                //         }else{
                //             var hehe    = ''
                //         }

                //         if(hehe == 'test'){

                                
                //         $(".loader").fadeOut("slow"); 
                //         $("#loadings").fadeOut("slow");   
                //         //  $("#image2").fadeOut("slow");  
                //         $('#preview').empty();
                //         return;

                //         }     
                //         capture();             
                //     }, 2000);

                // }
                // Loader
            gambarplus.css("display", "");

        
            // document.getElementById("a-download").style.display = "inline";

        
        });

        $(document).on('click', '#a-download', function(){
            
            var imgageData = getCanvas.toDataURL("image/png", 1);
            // Now browser starts downloading it instead of just showing it
            var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
            $("#a-download").attr("download", "Struktur Organisasi.png").attr("href", newData);
        });
    })
</script>

    
<script>
    $(document).ready(function(){

        //$("#image").fadeOut("slow");  
        $("#image2").fadeOut("slow");  

        // Ambil parameter lemparan filter
            var tampungdir      = $('#tampungdir').val();
            var tampungdiv      = $('#tampungdiv').val();
            var tampungdept     = $('#tampungdept').val();
            var tampungfilter   = $('#tampungfilter').val();
            var tampunglevel    = $('#tampunglevel').val();
        // Ambil parameter lemparan filter

        // Ambil parameter informasi posisi user
            var posisidept      = $('#posisidept').val();
            var posisidiv       = $('#posisidiv').val();
            var posisidir       = $('#posisidir').val();
        // Ambil parameter informasi posisi user

        // // Logic struktur mana yang akan ditampilkan
        //     // Jika filter yang dipilih divisi saja
        //     if(tampungdept == '0' && tampungdiv != '0' && tampungdir != '0'){
        //         $('#posisiuntuktampil').val(tampungdiv);
        //         $('#namadept1').val('0');

        //         $('#filter').val('2');

        //         // Judul Dept tidak Tampil
        //         $("#namadept").css("display", "none");
        //         // Judul Div Tampil
        //         $("#namadiv").css("display", "");
        //         // Judul Dir tidak Tampil
        //         $("#namadir").css("display", "none");
        //         // Judul Perusahaan tidak Tampil
        //         $("#namaperusahaan").css("display", "none");

        //         // Mengambil judul dari ajax divisi
        //         var div     = $('#tampungdiv').val();
                
        //                 $.ajax({
        //                     url:"ambilnamadept.php",
        //                     method:"POST",
        //                     data:{dept:div},
        //                     success:function(data){
        //                         $('#ambilnamadivisi').html(data);
        //                         $('#tampungambilnamadivisi').val(data);
        //                     }

        //             });
        //         // Mengambil judul dari ajax divisi
        //     }
        //     // Jika filter yang dipilih divisi dan dept
        //     else if(tampungdept != '0' && tampungdiv != '0' && tampungdir != '0'){
        //         $('#posisiuntuktampil').val(tampungdept);
        //         $('#namadept1').val('1');

        //         $('#filter').val('1');

        //         // Judul Dept Tampil
        //         $("#namadept").css("display", "");
        //         // Judul Div Tampil
        //         $("#namadiv").css("display", "");
        //         // Judul Dir tidak Tampil
        //         $("#namadir").css("display", "none");
        //         // Judul Perusahaan tidak Tampil
        //         $("#namaperusahaan").css("display", "none");

        //         // Mengambil judul dari ajax dept dan divisi
        //         var dept    = $('#tampungdept').val();
        //         var div     = $('#tampungdiv').val();
        //         $.ajax({
        //                     url:"ambilnamadept.php",
        //                     method:"POST",
        //                     data:{dept:dept},
        //                     success:function(data){
        //                         $('#ambilnamadept').html(data);
        //                         $('#tampungambilnamadept').val(data);
        //                     }

        //                 });

        //                 $.ajax({
        //                     url:"ambilnamadept.php",
        //                     method:"POST",
        //                     data:{dept:div},
        //                     success:function(data){
        //                         $('#ambilnamadivisi').html(data);
        //                         $('#tampungambilnamadivisi').val(data);
        //                     }

        //             });
        //         // Mengambil judul dari ajax dept dan divisi


        //     }
        //     // Jika filter yang dipilih tidak divisi dan tidak dept
        //     else if(tampungdept == '0' && tampungdiv == '0' && tampungdir == '0'){

        //             if(tampunglevel == '1'){
        //                 $('#posisiuntuktampil').val(tampungdir);
        //                 $('#namadept1').val('0');

        //                 $('#filter').val('1');

        //                 // Judul Dept tidak Tampil
        //                 $("#namadept").css("display", "none");
        //                 // Judul Div tidak Tampil
        //                 $("#namadiv").css("display", "none");
        //                 // Judul Dir tidak Tampil
        //                 $("#namadir").css("display", "none");
        //                 // Judul Perusahaan Tampil
        //                 $("#namaperusahaan").css("display", "");
        //                 }
        //             else if(tampunglevel == '2'){
        //                 if(posisidept != '0' && posisidiv != '0'){
        //                     alert('disini');
        //                     $('#posisiuntuktampil').val(posisidept);
        //                     $('#namadept1').val('1');

        //                     // Judul Dept Tampil
        //                     $("#namadept").css("display", "");
        //                     // Judul Div Tampil
        //                     $("#namadiv").css("display", "");
        //                     // Judul Dir tidak Tampil
        //                     $("#namadir").css("display", "none");
        //                     // Judul Perusahaan tidak Tampil
        //                     $("#namaperusahaan").css("display", "none");

        //                     // Mengambil judul dari ajax dept dan divisi
        //                     var dept    = $('#posisidept').val();
        //                     var div     = $('#posisidiv').val();
        //                     $.ajax({
        //                                 url:"ambilnamadept.php",
        //                                 method:"POST",
        //                                 data:{dept:dept},
        //                                 success:function(data){
        //                                     $('#ambilnamadept').html(data);
        //                                     $('#tampungambilnamadept').val(data);
        //                                 }

        //                     });

        //                             $.ajax({
        //                                 url:"ambilnamadept.php",
        //                                 method:"POST",
        //                                 data:{dept:div},
        //                                 success:function(data){
        //                                     $('#ambilnamadivisi').html(data);
        //                                     $('#tampungambilnamadivisi').val(data);
        //                                 }

        //                     });
        //                     // Mengambil judul dari ajax dept dan divisi
        //                 }
        //                 // Jika informasi user hanya ada untuk div, dir maka tampilkan dept
        //                 else if(posisidept == '0' && posisidiv != '0'){
        //                     $('#posisiuntuktampil').val(posisidiv);
        //                     $('#namadept1').val('0');

        //                     // Judul Dept tidak Tampil
        //                     $("#namadept").css("display", "none");
        //                     // Judul Div Tampil
        //                     $("#namadiv").css("display", "");
        //                     // Judul Dir tidak Tampil
        //                     $("#namadir").css("display", "none");
        //                     // Judul Perusahaan tidak Tampil
        //                     $("#namaperusahaan").css("display", "none");

        //                     // Mengambil judul dari ajax divisi
        //                     var div     = $('#posisidiv').val();
                            
        //                     $.ajax({
        //                         url:"ambilnamadept.php",
        //                         method:"POST",
        //                         data:{dept:div},
        //                         success:function(data){
        //                             $('#ambilnamadivisi').html(data);
        //                             $('#tampungambilnamadivisi').val(data);
        //                         }

        //                     });
        //                     // Mengambil judul dari ajax divisi
        //                 }
        //                 else if(posisidept == '0' && posisidiv == '0'){
        //                     $('#posisiuntuktampil').val(posisidir);
        //                     $('#namadept1').val('0');

        //                     // Judul Dept tidak Tampil
        //                     $("#namadept").css("display", "none");
        //                     // Judul Div Tampil
        //                     $("#namadiv").css("display", "none");
        //                     // Judul Dir Tampil
        //                     $("#namadir").css("display", "");
        //                     // Judul Perusahaan tidak Tampil
        //                     $("#namaperusahaan").css("display", "none");

        //                     // Mengambil judul dari ajax dir
        //                     var div     = $('#posisidir').val();
                            
        //                     $.ajax({
        //                         url:"ambilnamadept.php",
        //                         method:"POST",
        //                         data:{dept:div},
        //                         success:function(data){
        //                             $('#ambilnamadir').html(data);
        //                             $('#tampungambilnamadir').val(data);
        //                         }

        //                     });
        //                     // Mengambil judul dari ajax dir
                            
                        
        //             }
        //         }
        //     }
        // // Logic struktur mana yang akan ditampilkan

        // Menampilkan struktur
        if(tampungdept != '0' && tampungdiv != '0' && tampungdir != '0'){
                var page    = tampungdept;
                var filter  = '1';
                $('#namadept1').val('1');
                $('#filter_tittle').val('1');
                $('#page_tittle').val(tampungdept);
            }else if(tampungdept != '0' && tampungdiv == '0' && tampungdir != '0'){
                var page    = tampungdept;
                var filter  = '1';
                $('#namadept1').val('1');
                $('#filter_tittle').val('1');
                $('#page_tittle').val(tampungdept);
            }else if(tampungdept == '0' && tampungdiv != '0' && tampungdir != '0'){
                var page    = tampungdiv;
                var filter  = '2';
                $('#namadept1').val('0');
                $('#filter_tittle').val('2');
                $('#page_tittle').val(tampungdiv);
            }else if(tampungdept == '0' && tampungdiv == '0' && tampungdir != '0'){
                var page    = tampungdir;
                var filter  = '3';
                $('#namadept1').val('0');
                $('#filter_tittle').val('3');
                $('#page_tittle').val(tampungdir);
            }else if(tampungdept == '0' && tampungdiv == '0' && tampungdir == '0'){
                if(level == '2'){
                    if(posisidept != '0' && posisidiv != '0' && posisidir != '0'){
                        var page    = posisidept;
                        var filter  = '1';
                        $('#namadept1').val('1');
                        $('#filter_tittle').val('1');
                        $('#page_tittle').val(dept);
                    }else if(posisidept == '0' && posisidiv != '0' && posisidir != '0'){
                        var page    = posisidiv;
                        var filter  = '2';
                        $('#namadept1').val('0');
                        $('#filter_tittle').val('2');
                        $('#page_tittle').val(posisidiv);
                    }else if(posisidept == '0' && posisidiv == '0' && posisidir != '0'){
                        var page    = posisidir;
                        var filter  = '3';
                        $('#namadept1').val('0');
                        $('#filter_tittle').val('3');
                        $('#page_tittle').val(posisidir);
                    }
                }else{
                    var page    = posisidir;
                    var filter  = '3';
                    $('#namadept1').val('0');
                    $('#filter_tittle').val('3');
                    $('#page_tittle').val(posisidir);
                }
            }
            // Menampilkan struktur


        // Mengambil posisiuntuk tampil

        // Mengambil posisiuntuk tampil

        load_data(page,filter);


        
        // Fungsi untuk load data tampilan struktur organisasi
        function load_data(page,filter){


            // alert(page);
            // alert(filter);
            var posisiuntuktampil   = page;
            var tampunglevel        = $('#tampunglevel').val();

                                    
                                    // alert(posisiuntuktampil);
                                    $.ajax({
                                        url:"data.php",
                                        method:"POST",
                                        data:{posisiuntuktampil:posisiuntuktampil, tampunglevel:tampunglevel, filter:filter},
                                        success:function(data){
                                            // alert('sukses');

                                            $('#tampilan').html(data);
                                        
                                            
                                            
                                        }

                                    })
                                

        }

        // Fungsi untuk load data tampilan struktur organisasi
        

        // Fungsi untuk load data tampilan struktur organisasi
  

        // Fungsi untuk menampilkan title
        
        // function tampiltittle(height){

        //     var valpage = $('#valpage').val();

            
        //                             $.ajax({
        //                                 url:"jobtittle.php",
        //                                 method:"POST",
        //                                 data:{height:height, valpage:valpage},
        //                                     success:function(jobtit){
                                                            
        //                                         $('#tampilantittle').html(jobtit);
        //                                         // alert('hehe')
                                                            
                                                            
        //                                     }

        //                             })

        //     var width = document.getElementById("printtest1").offsetWidth;
        //     const background = $('.background');

        //     var height = document.getElementById("printtest1").offsetHeight;
        //     const semua = $('#semua');
            
            

        //     if(width > 1170){
        //         background.css("width", "max-content");
        //     }

        //     if(width < 1170){
        //         background.css("width", "auto");

        //     }

        //     if(height > 650){
        //         semua.css("height", "91vh");
        //         semua.css("margin-top", "6px");
        //     }
        //     else if(height < 650){
        //         semua.css("height", "88vh");
        //         semua.css("margin-top", "7px");
        //     }
        // }

        // Fungsi untuk menampilkan title

        // Logic untuk colap and expand struktur

        // $(document).on('click', '#gambarplus', function(){
        //     // var table   = $('#tableterpakai').val();
        //     var height = document.getElementById("strukturorg").offsetHeight;
        //     // var height = $("#strukturorg").offsetHeight;


        //     alert(height);

        //     var valpage = $('#posisiuntuktampil').val();

        //     var bisa    = $('#bisa').val();

        //     var level   = $('#level').val();


        //         $.ajax({
        //                 url:"jobtittle.php",
        //                 method:"POST",
        //                 data:{height:height, valpage:valpage, bisa:bisa, level:level},
        //                     success:function(data){
                                            
        //                         $('#tampilantittle').html(data);
                                            
                                            
                                            
        //                     }

        //                 })

        //     var width = document.getElementById("printtest1").offsetWidth;
        //     const background = $('.background');

        //     var height = document.getElementById("printtest1").offsetHeight;
        //     const semua = $('#semua');
            
            

        //     if(width > 1170){
        //         background.css("width", "max-content");
        //     }

        //     if(width < 1170){
        //         background.css("width", "auto");

        //     }

        //     if(height > 650){
        //         semua.css("height", "91vh");
        //         semua.css("margin-top", "6px");
        //     }
        //     else if(height < 650){
        //         semua.css("height", "88vh");
        //         semua.css("margin-top", "7px");
        //     }

            
        // })

        // $(document).on('click', '#gambarminus', function(){
        //     // var table   = $('#tableterpakai').val();
        //     var height = document.getElementById("strukturorg").offsetHeight;
        //     // var height = $("#strukturorg").offsetHeight;

        //     alert(height);

        //     var valpage = $('#posisiuntuktampil').val();
        //     var bisa    = $('#bisa').val();
        //     var level   = $('#level').val();

        //         $.ajax({
        //                 url:"jobtittle.php",
        //                 method:"POST",
        //                 data:{height:height, valpage:valpage, bisa:bisa, level:level},
        //                     success:function(data){
                                            
        //                         $('#tampilantittle').html(data);
                                            
                                            
                                            
        //                     }

        //                 })

        //     var width = document.getElementById("printtest1").offsetWidth;
        //     const background = $('.background');
            
            

        //     if(width > 1170){
        //         background.css("width", "max-content");
        //     }

        //     if(width < 1170){
        //         background.css("width", "auto");

        //     }

            
        // })

        
        // Menampilkan title
        tampil_title(page,filter,tampunglevel);

        function tampil_title(page,filter,tampunglevel,height1){
                var height1 = document.getElementById("semua").offsetHeight;
            if(height1 > 0){
                var height1 = document.getElementById("strukturorg").offsetHeight;

                var width  = document.getElementById("printtest1").offsetWidth;  
                                        
                                        if(width > 1140){
                                                var lebar  = width+250;
                                            }else{
                                                var lebar  = 1140+173;
                                            }

                                        

                                        const lebar1 = $("#semua");
                                        lebar1.css("width", lebar);
				$("#image").fadeOut("slow");  
        
            }
            
            //var test    = $('#validate');
            // alert(test);
            
            //if(test != ''){
                //$haha   = 'test';
           // }

            //if($haha == 'test'){
                //$("#image").fadeOut("slow");
            //}
            

            $.ajax({

                    url:"jobtittle.php",
                    method:"POST",
                    data:{height:height1, valpage:page, filter:filter, level:tampunglevel},
                        success:function(data){
                                            
                            $('#tampilantittle').html(data);

                            setTimeout(function() {
               
                                    
                                tampil_title(page,filter,tampunglevel); 
                                        
                                                    
                            }, 2000)                 
                                            
                                            
                        }

            })
        }
        // Menampilkan title

        // Fungsi untuk menampilkan judul struktur organisasi
        ambil_nama_struktur(filter);

        function ambil_nama_struktur(filter){
            var div     = $('#tampungdiv').val();
            var dept    = $('#tampungdept').val();
            var dir     = $('#tampungdir').val();


            // Jika Departement
            if(filter == '1'){
                // alert('Masuk');
                $.ajax({
                        url:"ambilnamadept.php",
                        method:"POST",
                        data:{dept:dept},
                        success:function(data){
                            $('#ambilnamadept').html(data);
                            $('#namadept2').val(data);

                        }

                });

                $.ajax({
                        url:"ambilnamadivisi.php",
                        method:"POST",
                        data:{div:div},
                        success:function(data){
                            $('#ambilnamadivisi').html(data);
                            $('#namadiv1').val(data);

                        }

                });

                $.ajax({
                        url:"ambilnamadir.php",
                        method:"POST",
                        data:{dir:dir},
                        success:function(data){
                            $('#ambilnamadir').html(data);
                            $('#namadir1').val(data);

                        }

                });

                const namadept = $("#namadept");
                namadept.css("display", "none");
                const namadiv = $("#namadiv");
                namadiv.css("display", "none");
                const namadir = $("#namadir");
                namadir.css("display", "none");
                

            }else if(filter == '2'){
                $.ajax({
                        url:"ambilnamadivisi.php",
                        method:"POST",
                        data:{div:div},
                        success:function(data){
                            $('#ambilnamadivisi').html(data);
                            $('#namadiv1').val(data);

                        }

                });

                $.ajax({
                        url:"ambilnamadir.php",
                        method:"POST",
                        data:{dir:dir},
                        success:function(data){
                            $('#ambilnamadir').html(data);
                            $('#namadir1').val(data);

                        }

                });

                const namadept = $("#namadept");
                namadept.css("display", "none");
                const namadiv = $("#namadiv");
                namadiv.css("display", "none");
                const namadir = $("#namadir");
                namadir.css("display", "none");

            }else if(filter == '3'){
                $.ajax({
                        url:"ambilnamadir.php",
                        method:"POST",
                        data:{dir:dir},
                        success:function(data){
                            $('#ambilnamadir').html(data);
                            $('#namadir1').val(data);

                        }

                });

                const namadept = $("#namadept");
                namadept.css("display", "none");
                const namadiv = $("#namadiv");
                namadiv.css("display", "none");
                const namadir = $("#namadir");
                namadir.css("display", "none");

            }
            // Jika Departement

                
                    
        }
        
        // Fungsi untuk menampilkan judul struktur organisasi



        
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

    </script>

    <!-- Menampilkan detail profil sesuai modal yang kita pilih -->

    <script>
        $(document).ready(function(){
            $(document).on('click', '#modal_profile', function(){
                var empno   = $(this).attr('id1');
                    $.ajax({
                                        url:"modalprofil.php",
                                        method:"POST",
                                        data:{empno:empno},
                                            success:function(jobtit){
                                                            
                                                $('#yanampilmodal').html(jobtit);
                                                            
                                                            
                                            }

                    })
            });
        });
    </script>

    <!-- Menampilkan detail profil sesuai modal yang kita pilih -->

    </body>
</html>

<?php } ?>
<?php } ?>


