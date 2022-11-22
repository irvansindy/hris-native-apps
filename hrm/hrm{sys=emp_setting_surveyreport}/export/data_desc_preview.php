<?php
    include "../../../application/session/session_ess.php";

    $id_event   = $_POST['id_event'];
    $id_group   = $_POST['id_group'];
    $descriptionId     = $_POST['descriptionId'];
    $data_anggota   = $_POST['data_anggota'];
    $description    = $_POST['description'];

    $query_essay    = mysqli_query($connect, "SELECT * FROM hrmsurveytansweressay WHERE groupId = '$id_group' AND descriptionId = '$descriptionId' AND id_event = '$id_event'");
    $data_pertanyaan    = mysqli_fetch_assoc($query_essay);
    $data_actual        = mysqli_num_rows($query_essay);
    $query_event	= mysqli_query($connect, "SELECT * FROM hrmsurveyevent WHERE id_event = '$id_event'");
    $data_event		= mysqli_fetch_assoc($query_event);
?>

<style type="text/css" media="print">

table {border: solid 1px #000; border-collapse: collapse; width: 100%}

tr { border: solid 2px #000}

td { border: solid 2px #000; padding: 0px 3px; font-family:Arial; font-size: 15px;}

h3 { margin-bottom: 10px }

h2 { margin-bottom: 10px }

</style>

<style type="text/css" media="screen">

  table {border: solid 1px #000; border-collapse: collapse; width: 50%}

  tr { border: solid 1px #000}

  td { padding: 0px 5px; font-family:Arial; font-size: 15px;}

  h3 { margin-bottom: 0px}

  h2 { margin-bottom: 0px }

</style>

<center>
<h3><?php echo $data_event['judul'] ?></h3>
</center>

<table border="1">
                    <thead>
                        <tr>
                            <td colspan="" bgcolor='#1f65b5' class="fontCustom"><p align="center"><b style="color:white;">NO</b></p></td>
                            <td colspan="" bgcolor='#5b1f8c' class="fontCustom"><p align="center"><b style="color:white;">PERTANYAAN</b></p></td>
                            <td colspan="" bgcolor='#5b1f8c' class="fontCustom"><p align="center"><b style="color:white;">EMP NO</b></p></td>  
                            <td colspan="" bgcolor='#5b1f8c' class="fontCustom"><p align="center"><b style="color:white;">FULLNAME</b></p></td>
                            <td colspan="" bgcolor='#5b1f8c' class="fontCustom"><p align="center"><b style="color:white;">PERNYATAAN</b></p></td>
                        </tr>

                    </thead>
                    <tbody>
                        <?php 
                        $query_essay    = mysqli_query($connect, "SELECT a.*,
                        b.nama 
                        FROM hrmsurveytansweressay a 
                        LEFT JOIN users b  ON a.nip = b.username
                        WHERE groupId = '$id_group' AND descriptionId = '$descriptionId' AND id_event = '$id_event'");
                        $no = 1;
                        $no1 = substr($description,0,2);
                        $des = substr($description,3);
                        while($data_essay = mysqli_fetch_assoc($query_essay)){
                            if($no > 1){ $no1 = ''; $des = ''; }
                        
                        ?>
                        <tr>
                            <td align="center" class="fontCustom"><?php echo $no1; ?></td>
                            <td align="center" class="fontCustom"><?php echo $des; ?></td>
                            <td align="center" class="fontCustom"><?php echo $data_essay['nip'] ?></td>
                            <td class="fontCustom"><?php echo $data_essay['nama'] ?></td>
                            <td class="fontCustom"><?php echo $data_essay['jawaban'] ?></td>
                        </tr>
                       <?php $no++; } ?>
                    </tbody>
                </table>