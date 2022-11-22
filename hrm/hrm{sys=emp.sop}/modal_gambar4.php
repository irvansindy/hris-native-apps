<?php
include "../../application/config.php";
$nc = $_POST['id'];
?>

<link rel="stylesheet" href="w3.css">

<div class="modal-body">
<fieldset id="fset_1">
<div class="form-row">
<?php
    $sqlKetentuan = "SELECT * FROM hrdprosedurketentuan where idProsedur = '$nc'";
    $ketentuan = mysqli_query($connect, $sqlKetentuan);
    $sqlKeterangan = "SELECT * FROM hrdprosedurketerangan where idProsedur = '$nc'";
    $keterangan = mysqli_query($connect, $sqlKeterangan);
    $sqlKeterangan = "SELECT * FROM hrdprosedurketerangan where idProsedur = '$nc'";
    $keterangan = mysqli_query($connect, $sqlKeterangan);
    $sqlDefinisi = "SELECT * FROM hrdprosedurdef where idProsedur = '$nc'";
    $definisi = mysqli_query($connect, $sqlDefinisi);
    $sqlLampiran = "SELECT * FROM hrdprosedurlampiran where idProsedur = '$nc'";
    $lampiran = mysqli_query($connect, $sqlLampiran);
?>

<b style = "font-size : 20px">Definisi</b>
<table style = "margin-bottom : 20px" class="table table-striped table-hover table-sm table-bordered table-responsive">
<tr style = "background-color : black; color : white">
    <td style = "width : 20px">ID</td>
    <td style = "width : 1000px">Kamus</td>
    <td style = "width : 400px">Definition</td>
</tr>
<?php
    if(mysqli_num_rows($definisi) == 0) {
        echo '<tr><td colspan = "4" style = "background-color : #F0FFF0; text-align : left">';
        echo 'No Data';
        echo '</td></tr>';
    } else {
        while($arrayDefinisi = mysqli_fetch_array($definisi)) {
            echo "<tr>";
            echo "<td>";
            echo $arrayDefinisi['definition_code'];
            echo "</td>";
            echo "<td>";
            echo $arrayDefinisi['kamus'];
            echo "</td>";
            echo "<td>";
            echo $arrayDefinisi['definisi'];
            echo "</td>";
            echo "</tr>";
        }
    }
?>
</table>

<b style = "font-size : 20px">Ketentuan</b>
<table style = "margin-bottom : 20px" class="table table-striped table-hover table-sm table-bordered table-responsive">
        <tr style = "background-color : black; color : white">
            <td style = "width : 20px">ID</td>
            <td style = "width : 1000px">Deskripsi</td>
            <td style = "width : 400px">Image</td>
        </tr>
        <?php
            if(mysqli_num_rows($ketentuan) == 0) {
                echo '<tr><td colspan = "4" style = "background-color : #F0FFF0; text-align : left">';
                echo 'No Data';
                echo '</td></tr>';
            } else {
                for($i=0; $i < mysqli_num_rows($ketentuan); $i++){
                    $arrayKetentuan = mysqli_fetch_array($ketentuan);
                    echo "<tr>";
                    echo "<td>";
                    echo $arrayKetentuan['ketentuan_code'];
                    echo "</td>";
                    echo "<td>";
                    echo $arrayKetentuan['deskripsi'];
                    echo "</td>";
                    if(empty($arrayKetentuan['foto'])){
                        echo'<td style = "width : 400px">No File</td>';
                    } else {
                        echo '<td style = "width : 400px">';
                        echo '<img src = "image/'.$arrayKetentuan['foto'].'" style = "width : 500px">';
                        echo '</td>';
                    }
                    echo "</tr>";
                }
            }
        ?>
</table>

    <b style = "font-size : 20px">Keterangan</b>
    <table style = "margin-bottom : 20px" class="table table-striped table-hover table-sm table-bordered table-responsive">
        <tr style = "background-color : black; color : white">
        <td style = "width : 20px">ID</td>
        <td style = "width : 1000px">Deskripsi</td>
        <td style = "width : 400px">Image</td>
        </tr>
        <?php
            if(mysqli_num_rows($keterangan) == 0) {
                echo '<tr><td colspan = "4" style = "background-color : #F0FFF0; text-align : left">';
                echo 'No Data';
                echo '</td></tr>';
            } else {
                for($k=0; $k < mysqli_num_rows($keterangan); $k++){
                    $arrayKeterangan = mysqli_fetch_array($keterangan);
                    echo "<tr>";
                    echo "<td>";
                    echo $arrayKeterangan['keterangan_code'];
                    echo "</td>";
                    echo "<td>";
                    echo $arrayKeterangan['deskripsi'];
                    echo "</td>";
                    if(empty($arrayKeterangan['foto'])){
                        echo'<td style = "width : 400px">No File</td>';
                    } else {
                        echo '<td>';
                        echo '<img src = "image/'.$arrayKeterangan['foto'].'" style = "width : 500px">';
                        echo '</td>';
                    }
                    echo "</tr>";
                }
            }
        ?>
</table> 

    <b style = "font-size : 20px">Lampiran</b>
    <table class="table table-striped table-hover table-sm table-bordered table-responsive">
        <tr style = "background-color : black; color : white">
            <td style = "width : 20px">ID</td>
            <td style = "width : 1000px">Deskripsi</td>
            <td style = "width : 400px">Image</td>
        </tr>
        <?php
            if(mysqli_num_rows($lampiran) == 0) {
                echo '<tr><td colspan = "4" style = "background-color : #F0FFF0; text-align : left">';
                echo 'No Data';
                echo '</td></tr>';
            } else {
                for($b=0; $b < mysqli_num_rows($lampiran); $b++){
                    $arraylampiran = mysqli_fetch_array($lampiran);
                    echo "<tr>";
                    echo "<td>";
                    echo $arraylampiran['lampiran_code'];
                    echo "</td>";
                    echo "<td>";
                    echo $arraylampiran['deskripsi'];
                    echo "</td>";
                    if(empty($arraylampiran['foto'])){
                        echo'<td>No File</td>';
                    } else {
                        echo '<td style = "width : 400px">'; 
                        echo '<img src = "image/'.$arraylampiran['foto'].'" style = "width : 500px">';
                        echo '</td>';
                    }
                    echo "</tr>";
                }
            }
        ?>
</table>

</fieldset>
</div>
</div>

<div class="modal-footer">

                    <?php   
                            $sqlGetData = "SELECT * FROM hrdprosedurdoc where idProsedur = '$nc'";
                            $getData = mysqli_query($connect, $sqlGetData);

                            if(mysqli_num_rows($getData) == 0) {
                                echo '<div class="mr-auto">';
                                echo '<font style = "margin-right : auto; margin-left : auto;"><b>';
                                echo 'No document file';
                                echo '</b></font>';
                                echo '</div>';
                            } else {
                                $arrayGetData = mysqli_fetch_array($getData);
                                $data = $arrayGetData['businessPictureDoc'];
                                echo'<div class="mr-auto">';
                                echo '<b>Supporting Document : </b>';
                                echo '<font size = "3"><i>';
                                echo $data;
                                echo '</i></font>';
                                echo '
                                <a href="image/'.$data.'" style = "color : black">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" style = "padding-left : 3px" class="bi bi-download" viewBox="0 0 16 16">
                                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                    <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                    </svg>
                                </a>
                                ';
                                echo'</div>';
                            }
                    ?>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>

<script>
    var slideIndex = 1;
    showDivs(slideIndex);

    function plusDivs(n) {
    showDivs(slideIndex += n);
    }

    function showDivs(n) {
    var i;
    var x = document.getElementsByClassName("mySlides");

    if (n > x.length) {slideIndex = 1}
    if (n < 1) {slideIndex = x.length}
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";  
    }
        x[slideIndex-1].style.display = "block";  
    }
</script>
