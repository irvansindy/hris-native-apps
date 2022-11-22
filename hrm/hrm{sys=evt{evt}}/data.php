<!-- LOADER -->
<div onclick='return stopload()' id="loading-circle"></div>
<!-- LOADER -->



<?php  
        
        $id_event       = $_GET['id'];
        $nip            = $_SESSION['username'];
        $aksi           =mysqli_query($connect, "SELECT * FROM hrmsurveyanggotaevent WHERE id_event='$id_event' AND nip ='$nip'");
        $ra             =mysqli_fetch_assoc($aksi);
        $sql_tipe_jawaban   = mysqli_query($connect, "SELECT 
        DISTINCT(a.tipejawaban)
        FROM hrmsurveygrouppertanyaan a WHERE a.id_event = '$id_event'");
        $tipe_jawaban       = mysqli_fetch_assoc($sql_tipe_jawaban);
       // jika nip dan nama terisi
       if (!empty($_POST['nip']) && !empty($_POST['full_name'])) {
              $mynip = $_POST['nip'];
              $myname = $_POST['full_name'];
              $frameworks = ",empnip :"."'".$mynip."' ,empname :"."'".$myname."'";
       // jika nip saja yang terisi
       } elseif (!empty($_POST['nip'])) {
              $mynip = $_POST['nip'];
              $myname = $_POST['full_name'];
              $frameworks = ",empnip :"."'".$mynip."'";
       // jika nama saja yang terisi
       } elseif (!empty($_POST['full_name'])) {
              $mynip = $_POST['nip'];
              $myname = $_POST['full_name'];
              $frameworks = ",empname :"."'".$myname."'";
       // jika tidak ada yang terisi
       } else { 
              $frameworks = "";
       }

$query_midtemp      = mysqli_query($connect, "SELECT * FROM hrmsurveytjawabanmidtemp WHERE nip = '$_SESSION[username]'");
$data_midtemp       = mysqli_num_rows($query_midtemp);
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
<script>
                            $(document).ready(function() {
                                   var limit = 1000;
                                   var start = 0;
                                   var action = 'inactive';

                                   function load_country_data(limit, start) {
                                          $.ajax({
                                                 url: "loadmore.php",
                                                 method: "POST",
                                                 data: {
                                                        limit: limit,
                                                        start: start <?php echo $frameworks; ?>
                                                 },
                                                 cache: false,
                                                 success: function(data) {
                                                        $('#example3LOAD').append(
                                                               data);
                                                        if (data == '') {
                                                               $('#example3_message')
                                                                      .html(
                                                                             "<button type='button' class='btn btn-info'>No Data Found</button>"
                                                                             );
                                                               action = 'active';
                                                        } else {
                                                               $('#example3_message')
                                                                      .html(
                                                                             "<button type='button' class='btn btn-warning'>Please Wait....</button>"
                                                                             );
                                                               action = "inactive";
                                                        }
                                                 }
                                          });
                                   }

                                   if (action == 'inactive') {
                                          action = 'active';
                                          load_country_data(limit, start);
                                   }
                                   $(window).scroll(function() {
                                          if ($(window).scrollTop() + $(window).height() >
                                                 420 && action == 'inactive') {
                                                 action = 'active';
                                                 start = start + limit;
                                                 setTimeout(function() {
                                                        load_country_data(
                                                               limit,
                                                               start);
                                                 }, 1000);
                                          }
                                   });

                            });
                            </script>



<div class="col-md-12">
                                <div class="card">
                                    <div class="card-header d-flex align-items-center">
                                        <h3 class="">SILAHKAN ISI SURVEY</h3>
                                        
                       

                                    </div>
                                    <?php 
                                    if($tipe_jawaban['tipejawaban'] == '2'){
                                    ?>
                                    <p style="margin-left:10px; margin-top:5px; font-size:10px">(STS : Sangat Tidak Setuju, TS : Tidak Setuju, C : Cukup setuju, S : Setuju, SS : Sangat Setuju)</p>
                                    <?php }
                                    
                                    if($tipe_jawaban['tipejawaban'] == '1'){ ?>
                                        <p style="margin-left:10px; margin-top:5px; font-size:10px">(STS : Sangat Tidak Setuju, TS : Tidak Setuju, S : Setuju, SS : Sangat Setuju)</p>
                                    <?php } ?>
                                <?php if($data_midtemp == 0){ ?>
                                    <?php if($ra['aksi'] == '0') { ?>
                                        <div class="card-body table-responsive p-0"
                                        style="width: 100vw;height: 78vh; width: 98.8%; margin: 5px;overflow: scroll;">
                                        <form  method="post" action="controller/aksi_submit.php" onSubmit="return validasi(this)" class="" >
                                                <input type="hidden" name="id" value="<?php echo $id_event; ?>">
                                                <input type="hidden" name="nip" value="<?php echo $_SESSION['username']; ?>">
                                        <table id="example3LOAD" width="99%" border="1"
                                                class="table table-bordered table-striped table-hover table-head-fixed">


                                                <thead>
                                        
                                                                    <tr>
                                                                        <th width='3%' class="fontCustom" style="z-index: 1;"  nowrap="nowrap"><p align="center">No.</p></th>
                                                                        <th colspan='2' class="fontCustom" style="z-index: 1;"><p align="center">DESKRIPSI</p></th>
                                                                        <th colspan='5' class="fontCustom" style="z-index: 1;" ><p align="center">JAWABAN</p></th>

                                                                    </tr>
                                                            </thead>
                                                            <tbody>
                                                                    <!-- Menampilkan pertanyaan -->
                                                                    <?php
                                                                        $company = mysqli_query($connect, "SELECT * FROM hrmsurveytjawaban WHERE id_event = '$id_event'");
                                                                        $c = mysqli_fetch_array($company);
                                                                        error_reporting(0);
                                                                        $no = 1;
                                                                        $sql = mysqli_query($connect, "SELECT
                                                                        b.*,
                                                                        a.tipejawaban 
                                                                        FROM hrmsurveygrouppertanyaan a
                                                                        LEFT JOIN hrmsurveytgroup b ON b.groupId = a.id_group
                                                                        WHERE a.id_event = '$id_event' ORDER BY a.order ASC");
                                                                        while($data = mysqli_fetch_array($sql)){
                                                                            $id_group = $data['groupId'];
                                                  
                                                                    ?>
                                                                    <!-- Menampilkan pertanyaan -->
                                                                    <tr>
                                                                        <td class='fontCustom' colspan="1"><?php echo $no; ?></td>
                                                                        <td class='fontCustom' colspan="2"><b><?php echo $data['groupName'] ?></b></td>
                                                                        <?php if($data['tipejawaban'] == '1'){ ?>
                                                                            <td height='' width='8%' bgcolor='#000000' class='fontCustom' align="center"><font face='Tahoma' size='1' color='white'>1<br>(STS)</font></td>
                                                                        <td height='' width='8%' bgcolor='#000000' class='fontCustom' align="center"><font face='Tahoma' size='1' color='white'>2<br>(TS)</font></td>
                                                                        <td height='' width='8%' bgcolor='#000000' class='fontCustom' align="center"><font face='Tahoma' size='1' color='white'>3<br>(S)</font></td>
                                                                        <td height='' width='8%' bgcolor='#000000' class='fontCustom' align="center"><font face='Tahoma' size='1' color='white'>4<br>(SS)</font></td>
                                                                        <?php }elseif($data['tipejawaban'] == '2'){ ?>
                                                                        <td height='' width='8%' bgcolor='#000000' class='fontCustom' align="center"><font face='Tahoma' size='1' color='white'>1<br>(STS)</font></td>
                                                                        <td height='' width='8%' bgcolor='#000000' class='fontCustom' align="center"><font face='Tahoma' size='1' color='white'>2<br>(TS)</font></td>
                                                                        <td height='' width='8%' bgcolor='#000000' class='fontCustom' align="center"><font face='Tahoma' size='1' color='white'>3<br>(C)</font></td>
                                                                        <td height='' width='8%' bgcolor='#000000' class='fontCustom' align="center"><font face='Tahoma' size='1' color='white'>4<br>(S)</font></td>
                                                                        <td height='' width='8%' bgcolor='#000000' class='fontCustom' align="center"><font face='Tahoma' size='1' color='white'>5<br>(SS)</font></td>
                                                                        <?php }elseif($data['tipejawaban'] == '3'){ ?>
                                                                        <td height='' width='8%' bgcolor='#000000' class='fontCustom' align="center"><font face='Tahoma' size='1' color='white'>Yes<br></font></td>
                                                                        <td height='' width='8%' bgcolor='#000000' class='fontCustom' align="center"><font face='Tahoma' size='1' color='white'>No<br></font></td>
                                                                        <?php }elseif($data['tipejawaban'] == '4') { ?> 
                                                                        <td height='' width='' bgcolor='#000000' class='fontCustom'><p align='center'><font face='Tahoma' size='1' color='white'>Isi Kuesioner<br></font></td>
                                                                        <?php } ?>
                                                                    </tr>
                                                                    <?php    
                                                                    $hasil = mysqli_query($connect, "SELECT * FROM hrmsurveytdescription, hrmsurveytgroup WHERE hrmsurveytdescription.groupId = '$id_group' AND hrmsurveytdescription.groupId = hrmsurveytgroup.groupId ORDER BY hrmsurveytgroup.groupId");
                                                                    $i = 1;
                                                                    while ($r = mysqli_fetch_array($hasil)){
                                                                        $select = mysqli_query($connect, "SELECT * FROM hrmsurveytanswer WHERE descriptionId = '$r[descriptionId]' AND companyId = '$c[companyId]'");
                                                                        $s = mysqli_fetch_array($select);
                                                                        $nocount = $id_group.'jawaban'.$i;
                                                                    ?>
                                                                    <tr>
                                                                        <td colspan='1'></td>
                                                                
                                                                        <td colspan='2'><font face='Tahoma' size='2'><b><?php echo $i; ?></b><b>.</b>&nbsp<?php echo $r[description]; ?></font></td>
                                                                        <?php if($data['tipejawaban'] == '1'){ ?>
                                                                        <td align='center' class='fontCustom'> <input type='radio' name='<?php echo $nocount; ?>' value='A' > </td>
                                                                        <td align='center' class='fontCustom'> <input type='radio' name='<?php echo $nocount; ?>' value='B' > </td>
                                                                        <td align='center' class='fontCustom'> <input type='radio' name='<?php echo $nocount; ?>' value='C' > </td>
                                                                        <td align='center' class='fontCustom'> <input type='radio' name='<?php echo $nocount; ?>' value='D' > </td>
                                                                        <?php }elseif($data['tipejawaban'] == '2'){ ?>
                                                                        <td align='center' class='fontCustom'> <input type='radio' name='<?php echo $nocount; ?>' value='A' > </td>
                                                                        <td align='center' class='fontCustom'> <input type='radio' name='<?php echo $nocount; ?>' value='B' > </td>
                                                                        <td align='center' class='fontCustom'> <input type='radio' name='<?php echo $nocount; ?>' value='C' > </td>
                                                                        <td align='center' class='fontCustom'> <input type='radio' name='<?php echo $nocount; ?>' value='D' > </td>
                                                                        <td align='center' class='fontCustom'> <input type='radio' name='<?php echo $nocount; ?>' value='E' > </td>
                                                                        <?php }elseif($data['tipejawaban'] == '3'){ ?>
                                                                        <td align='center' class='fontCustom'> <input type='radio' name='<?php echo $nocount; ?>' value='1' > </td>
                                                                        <td align='center' class='fontCustom'> <input type='radio' name='<?php echo $nocount; ?>' value='0' > </td>
                                                                        <?php }elseif($data['tipejawaban'] == '4') { ?> 
                                                                        <td align='center' class='fontCustom'><textarea name='<?php echo $nocount; ?>' class="form-control" rows="3" placeholder="Tulis Jawaban Kuisioner..."></textarea></td>
                                                                        <?php } ?>
                                                                    </tr>
                                                                    <?php $i++;
                                                                    }?>
                                                                    <!-- <br> -->
                                                                    <?php
                                                                    $no++;
                                                                    
                                                                }
                                                                ?>
                                                            </tbody>
                                                    </table>
                                                    <table id="example3LOAD" width="99%" border="1" class="table table-bordered table-striped table-hover table-head-fixed">
                                                        <?php
                                                        error_reporting(0);
                                                        $sql_essay = mysqli_query($connect, "SELECT
                                                        b.*
                                                        FROM hrmsurveygroupessay a
                                                        LEFT JOIN hrmsurveytgroup b ON b.groupId = a.id_group
                                                        WHERE a.id_event = '$id_event' ORDER BY a.order ASC");
                                                        while($data_essay = mysqli_fetch_array($sql_essay)){
                                                            $id_essay = $data_essay[groupId];
                                                        
                                                        ?>
                                                        
                                                        <?php    
                                                            $i_essay = 1;
                                                            $hasil_essay = mysqli_query($connect, "SELECT * FROM hrmsurveytdescription, hrmsurveytgroup WHERE hrmsurveytdescription.groupId = '$data_essay[groupId]' AND hrmsurveytdescription.groupId = hrmsurveytgroup.groupId ORDER BY hrmsurveytgroup.groupId");
                                                            while ($r_essay = mysqli_fetch_array($hasil_essay)){ 
                                                                $nocountessay   = $id_essay.'jawaban'.$i_essay;
                                                                ?> 
                                                        <tr>
                                                            <td colspan="8">    
                                                                    <div class="well">
                                                                        <h4><?php echo $r_essay['description']; ?></h4>           
                                                                            <div class="form-group">
                                                                                <textarea name='<?php echo $nocountessay; ?>' class="form-control" rows="3" placeholder="Tulis Jawaban Anda..."></textarea>
                                                                            </div>
                                                                            
                                                                    </div>
                                                                <!-- <hr> -->
                                                            </td>
                                                            </tr>
                                                        <?php $i_essay++; } ?>
                                                        <?php } ?>
                                                            
                                                    </table>
                                                    <table id="example3LOAD" width="99%" border="1" class="table table-bordered table-striped table-hover table-head-fixed">
                                                        <tr>
                                                            <td colspan="8" align=right><button type="submit" class="btn btn-primary btn-lg">Submit</button></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="97%" valign="top" align="center" colspan="5" style="border-style: none; border-width: medium">
                                                            <center class="well">
                                                            <font face="Arial" size="1"><b>Terima Kasih Atas Waktu dan Masukan yang anda berikan,Semua masukan yang anda berikan </b> </i></font>
                                                            <font face="Arial" size="1"><b>akan kami terima sebagai sarana bagi kami untuk meningkatkan kulaitas pelayanan kami</b>  </i></font>
                                                            </center>
                                                            </td>
                                                        </tr>
                                                    </table>
                                            </form>

                                        </div>
                                        <?php }else{ ?>
                                        
                                            <div class="card-body table-responsive p-0"
                                        style="width: 100vw;height: 78vh; width: 98.8%; margin: 5px;overflow: scroll;">
                                            <form  method="post" action="controller/aksi_submit.php" onSubmit="return validasi(this)" class="" >
                                                <input type="hidden" name="id" value="<?php echo $id_event; ?>">
                                                <input type="hidden" name="nip" value="<?php echo $_SESSION['username']; ?>">
                                                    <table id="example3LOAD" width="99%" border="1" class="table table-bordered table-striped table-hover table-head-fixed">
                                                            <thead>
                                                                    <tr>
                                                                        <th width='3%' class="fontCustom" style="z-index: 1;"  nowrap="nowrap"><p align="center">No.</p></th>
                                                                        <th colspan='2' class="fontCustom" style="z-index: 1;"><p align="center">DESKRIPSI</p></th>
                                                                        <th colspan='5' class="fontCustom" style="z-index: 1;" ><p align="center">JAWABAN</p></th>

                                                                    </tr>
                                                            </thead>
                                                            <tbody>
                                                                    <!-- Menampilkan pertanyaan -->
                                                                    <?php
                                                                         $tjawaban = mysqli_query($connect, "SELECT * FROM hrmsurveytjawaban WHERE id_event = '$id_event' AND nip = '$nip'");
                                                                         $tj = mysqli_fetch_assoc($tjawaban);
                                                                        error_reporting(0);
                                                                        $no = 1;
                                                                        $sql = mysqli_query($connect, "SELECT
                                                                        b.*,
                                                                        a.tipejawaban 
                                                                        FROM hrmsurveygrouppertanyaan a
                                                                        LEFT JOIN hrmsurveytgroup b ON b.groupId = a.id_group
                                                                        WHERE a.id_event = '$id_event' ORDER BY a.order ASC");
                                                                        while($data = mysqli_fetch_array($sql)){
                                                                            $id_group = $data['groupId'];
                                                  
                                                                    ?>
                                                                    <!-- Menampilkan pertanyaan -->
                                                                    <tr>
                                                                        <td class='fontCustom' colspan="1"><?php echo $no; ?></td>
                                                                        <td class='fontCustom' colspan="2"><b><?php echo $data['groupName'] ?></b></td>
                                                                        <?php if($data['tipejawaban'] == '1'){ ?>
                                                                            <td height='' width='8%' bgcolor='#000000' class='fontCustom' align="center"><font face='Tahoma' size='1' color='white'>1<br>(STS)</font></td>
                                                                        <td height='' width='8%' bgcolor='#000000' class='fontCustom' align="center"><font face='Tahoma' size='1' color='white'>2<br>(TS)</font></td>
                                                                        <td height='' width='8%' bgcolor='#000000' class='fontCustom' align="center"><font face='Tahoma' size='1' color='white'>3<br>(S)</font></td>
                                                                        <td height='' width='8%' bgcolor='#000000' class='fontCustom' align="center"><font face='Tahoma' size='1' color='white'>4<br>(SS)</font></td>
                                                                        <?php }elseif($data['tipejawaban'] == '2'){ ?>
                                                                        <td height='' width='8%' bgcolor='#000000' class='fontCustom' align="center"><font face='Tahoma' size='1' color='white'>1<br>(STS)</font></td>
                                                                        <td height='' width='8%' bgcolor='#000000' class='fontCustom' align="center"><font face='Tahoma' size='1' color='white'>2<br>(TS)</font></td>
                                                                        <td height='' width='8%' bgcolor='#000000' class='fontCustom' align="center"><font face='Tahoma' size='1' color='white'>3<br>(C)</font></td>
                                                                        <td height='' width='8%' bgcolor='#000000' class='fontCustom' align="center"><font face='Tahoma' size='1' color='white'>4<br>(S)</font></td>
                                                                        <td height='' width='8%' bgcolor='#000000' class='fontCustom' align="center"><font face='Tahoma' size='1' color='white'>5<br>(SS)</font></td>
                                                                        <?php }elseif($data['tipejawaban'] == '3'){ ?>
                                                                        <td height='' width='8%' bgcolor='#000000' class='fontCustom' align="center"><font face='Tahoma' size='1' color='white'>Yes<br></font></td>
                                                                        <td height='' width='8%' bgcolor='#000000' class='fontCustom' align="center"><font face='Tahoma' size='1' color='white'>No<br></font></td>
                                                                        <?php }elseif($data['tipejawaban'] == '4') { ?> 
                                                                        <td height='' width='' bgcolor='#000000' class='fontCustom'><p align='center'><font face='Tahoma' size='1' color='white'>Isi Kuesioner<br></font></td>
                                                                        <?php } ?>
                                                                    </tr>
                                                                    <?php    
                                                                        $hasil = mysqli_query($connect, "SELECT * FROM hrmsurveytdescription, hrmsurveytgroup WHERE hrmsurveytdescription.groupId = '$id_group' AND hrmsurveytdescription.groupId = hrmsurveytgroup.groupId ORDER BY hrmsurveytgroup.groupId");
                                                                        $i = 1;
                                                                        while ($r = mysqli_fetch_assoc($hasil)){
                                                    
                                                                            ?>
                                                                            <tr>
                                                                                    <td colspan='1'></td>
                                                                                    
                                                                                    <td colspan='2'><font face='Tahoma' size='2'><?php echo $r[description]; ?></font></td>
                                                                                    <?php if($data['tipejawaban'] == '1'){ 
                                                                                        $select = mysqli_query($connect, "SELECT * FROM hrmsurveytanswer1 WHERE descriptionId = '$r[descriptionId]' AND answerId = '$tj[answerId]'");
                                                                                        $s = mysqli_fetch_array($select);
                                                                                        ?>
                                                                                    <td align='center' class='fontCustom'> <input type='radio' name='' value='1' <?php if($s['jawaban1'] == '1'){ echo 'checked'; }else{ echo 'disabled'; } ?>> </td>
                                                                                    <td align='center' class='fontCustom'> <input type='radio' name='' value='2' <?php if($s['jawaban2'] == '1'){ echo 'checked'; }else{ echo 'disabled'; } ?> > </td>
                                                                                    <td align='center' class='fontCustom'> <input type='radio' name='' value='3' <?php if($s['jawaban3'] == '1'){ echo 'checked'; }else{ echo 'disabled'; } ?>> </td>
                                                                                    <td align='center' class='fontCustom'> <input type='radio' name='' value='4' <?php if($s['jawaban4'] == '1'){ echo 'checked'; }else{ echo 'disabled'; } ?>> </td>
                                                                                    <?php }elseif($data['tipejawaban'] == '2'){ 
                                                                                        $select = mysqli_query($connect, "SELECT * FROM hrmsurveytanswer2 WHERE descriptionId = '$r[descriptionId]' AND answerId = '$tj[answerId]'");
                                                                                        $s = mysqli_fetch_array($select);
                                                                                        ?>
                                                                                    <td align='center' class='fontCustom'> <input type='radio' name='' value='A' <?php if($s['jawaban1'] == '1'){ echo 'checked'; }else{ echo 'disabled'; } ?>> </td>
                                                                                    <td align='center' class='fontCustom'> <input type='radio' name='' value='B' <?php if($s['jawaban2'] == '1'){ echo 'checked'; }else{ echo 'disabled'; } ?> > </td>
                                                                                    <td align='center' class='fontCustom'> <input type='radio' name='' value='C' <?php if($s['jawaban3'] == '1'){ echo 'checked'; }else{ echo 'disabled'; } ?>> </td>
                                                                                    <td align='center' class='fontCustom'> <input type='radio' name='' value='D' <?php if($s['jawaban4'] == '1'){ echo 'checked'; }else{ echo 'disabled'; } ?>> </td>
                                                                                    <td align='center' class='fontCustom'> <input type='radio' name='' value='E' <?php if($s['jawaban5'] == '1'){ echo 'checked'; }else{ echo 'disabled'; } ?>> </td>
                                                                                    <?php }elseif($data['tipejawaban'] == '3'){ 
                                                                                        $select = mysqli_query($connect, "SELECT * FROM hrmsurveytanswer3 WHERE descriptionId = '$r[descriptionId]' AND answerId = '$tj[answerId]'");
                                                                                        $s = mysqli_fetch_array($select);
                                                                                        ?>
                                                                                    <td align='center' class='fontCustom'> <input type='radio' name='' value='1' <?php if($s['jawaban1'] == '1'){ echo 'checked'; }else{ echo 'disabled'; } ?>> </td>
                                                                                    <td align='center' class='fontCustom'> <input type='radio' name='' value='0' <?php if($s['jawaban0'] == '1'){ echo 'checked'; }else{ echo 'disabled'; } ?> > </td>
                                                                                    <?php }elseif($data['tipejawaban'] == '4') { ?> 
                                                                                
                                                                                    <?php } ?>
                                                                    </tr>
                                                                    <?php $i++;
                                                                    }?>
                                                                    <!-- <br> -->
                                                                    <?php
                                                                    $no++;
                                                                    
                                                                }
                                                                ?>
                                                            </tbody>
                                                    </table>
                                                <!-- <div class="card-body table-responsive p-0" style="width: 100vw;height: 78vh; width: 98.8%; margin: 5px;"> -->

                                                    <table id="example3LOAD" width="99%" border="1" class="table table-bordered table-striped table-hover table-head-fixed">
                                                        <?php
                                                        error_reporting(0);
                                                        $sql_essay = mysqli_query($connect, "SELECT
                                                        b.*
                                                        FROM hrmsurveygroupessay a
                                                        LEFT JOIN hrmsurveytgroup b ON b.groupId = a.id_group
                                                        WHERE a.id_event = '$id_event' ORDER BY a.order ASC");
                                                        while($data_essay = mysqli_fetch_array($sql_essay)){
                                                            $id_essay = $data_essay[groupId];
                                                        
                                                        ?>
                                                        
                                                        <?php    
                                                            $i_essay = 1;
                                                            $hasil_essay = mysqli_query($connect, "SELECT * FROM hrmsurveytdescription, hrmsurveytgroup WHERE hrmsurveytdescription.groupId = '$data_essay[groupId]' AND hrmsurveytdescription.groupId = hrmsurveytgroup.groupId ORDER BY hrmsurveytgroup.groupId");
                                                            while ($r_essay = mysqli_fetch_array($hasil_essay)){ 
                                                                $nocountessay   = $id_essay.'jawaban'.$i_essay;
                                                                $essay = mysqli_query($connect, "SELECT * FROM hrmsurveytansweressay WHERE descriptionId = '$r_essay[descriptionId]' AND answerId = '$tj[answerId]'");
                                                                $es = mysqli_fetch_array($essay);
                                                                ?> 
                                                        <tr>
                                                            <td colspan="8">    
                                                                    <div class="well">
                                                                        <h4><?php echo $r_essay['description']; ?></h4>           
                                                                            <div class="form-group">
                                                                                <textarea name='<?php echo $nocountessay; ?>' class="form-control" rows="3" placeholder="Tulis Jawaban Anda..." disabled><?php echo $es['jawaban'] ?></textarea>
                                                                            </div>
                                                                            
                                                                    </div>
                                                                <!-- <hr> -->
                                                            </td>
                                                            </tr>
                                                        <?php $i_essay++; } ?>
                                                        <?php } ?>
                                                            
                                                    </table>
                                                    <table id="example3LOAD" width="99%" border="1" class="table table-bordered table-striped table-hover table-head-fixed">
                                                        <tr>
                                                            <td width="97%" valign="top" align="center" colspan="5" style="border-style: none; border-width: medium">
                                                            <center class="well">
                                                            <font face="Arial" size="1"><b>Terima Kasih Atas Waktu dan Masukan yang anda berikan,Semua masukan yang anda berikan </b> </i></font>
                                                            <font face="Arial" size="1"><b>akan kami terima sebagai sarana bagi kami untuk meningkatkan kulaitas pelayanan kami</b>  </i></font>
                                                            </center>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                <!-- </div> -->
                                            </form>

                                        </div>

                                        <?php } ?>
                                    <?php }elseif($data_midtemp >= 1){ ?>

                                        <div class="card-body table-responsive p-0"
                                        style="width: 100vw;height: 78vh; width: 98.8%; margin: 5px;overflow: scroll;">
                                            <form  method="post" action="controller/aksi_submit.php" onSubmit="return validasi(this)" class="" >
                                                <input type="hidden" name="id" value="<?php echo $id_event; ?>">
                                                <input type="hidden" name="nip" value="<?php echo $_SESSION['username']; ?>">
                                                    <table id="example3LOAD" width="99%" border="1" class="table table-bordered table-striped table-hover table-head-fixed">
                                                            <thead>
                                                                    <tr>
                                                                        <th width='3%' class="fontCustom" style="z-index: 1;"  nowrap="nowrap"><p align="center">No.</p></th>
                                                                        <th colspan='2' class="fontCustom" style="z-index: 1;"><p align="center">DESKRIPSI</p></th>
                                                                        <th colspan='5' class="fontCustom" style="z-index: 1;" ><p align="center">JAWABAN</p></th>

                                                                    </tr>
                                                            </thead>
                                                            <tbody>
                                                                    <!-- Menampilkan pertanyaan -->
                                                                    <?php
                                                                         $tjawaban = mysqli_query($connect, "SELECT * FROM hrmsurveytjawabanmidtemp WHERE id_event = '$id_event' AND nip = '$nip'");
                                                                         $tj = mysqli_fetch_assoc($tjawaban);
                                                                        error_reporting(0);
                                                                        $no = 1;
                                                                        $sql = mysqli_query($connect, "SELECT
                                                                        b.*,
                                                                        a.tipejawaban 
                                                                        FROM hrmsurveygrouppertanyaan a
                                                                        LEFT JOIN hrmsurveytgroup b ON b.groupId = a.id_group
                                                                        WHERE a.id_event = '$id_event' ORDER BY a.order ASC");
                                                                        while($data = mysqli_fetch_array($sql)){
                                                                            $id_group = $data['groupId'];
                                                  
                                                                    ?>
                                                                    <!-- Menampilkan pertanyaan -->
                                                                    <tr>
                                                                        <td class='fontCustom' colspan="1"><?php echo $no; ?></td>
                                                                        <td class='fontCustom' colspan="2"><b><?php echo $data['groupName'] ?></b></td>
                                                                        <?php if($data['tipejawaban'] == '1'){ ?>
                                                                        <td height='' width='8%' bgcolor='#000000' class='fontCustom' align="center"><font face='Tahoma' size='1' color='white'>1<br>(STS)</font></td>
                                                                        <td height='' width='8%' bgcolor='#000000' class='fontCustom' align="center"><font face='Tahoma' size='1' color='white'>2<br>(TS)</font></td>
                                                                        <td height='' width='8%' bgcolor='#000000' class='fontCustom' align="center"><font face='Tahoma' size='1' color='white'>3<br>(S)</font></td>
                                                                        <td height='' width='8%' bgcolor='#000000' class='fontCustom' align="center"><font face='Tahoma' size='1' color='white'>4<br>(SS)</font></td>
                                                                        <?php }elseif($data['tipejawaban'] == '2'){ ?>
                                                                        <td height='' width='8%' bgcolor='#000000' class='fontCustom' align="center"><font face='Tahoma' size='1' color='white'>1<br>(STS)</font></td>
                                                                        <td height='' width='8%' bgcolor='#000000' class='fontCustom' align="center"><font face='Tahoma' size='1' color='white'>2<br>(TS)</font></td>
                                                                        <td height='' width='8%' bgcolor='#000000' class='fontCustom' align="center"><font face='Tahoma' size='1' color='white'>3<br>(C)</font></td>
                                                                        <td height='' width='8%' bgcolor='#000000' class='fontCustom' align="center"><font face='Tahoma' size='1' color='white'>4<br>(S)</font></td>
                                                                        <td height='' width='8%' bgcolor='#000000' class='fontCustom' align="center"><font face='Tahoma' size='1' color='white'>5<br>(SS)</font></td>
                                                                        <?php }elseif($data['tipejawaban'] == '3'){ ?>
                                                                        <td height='' width='8%' bgcolor='#000000' class='fontCustom' align="center"><font face='Tahoma' size='1' color='white'>Yes<br></font></td>
                                                                        <td height='' width='8%' bgcolor='#000000' class='fontCustom' align="center"><font face='Tahoma' size='1' color='white'>No<br></font></td>
                                                                        <?php }elseif($data['tipejawaban'] == '4') { ?> 
                                                                        <td height='' width='' bgcolor='#000000' class='fontCustom'><p align='center'><font face='Tahoma' size='1' color='white'>Isi Kuesioner<br></font></td>
                                                                        <?php } ?>
                                                                    </tr>
                                                                    <?php    
                                                                        $hasil = mysqli_query($connect, "SELECT * FROM hrmsurveytdescription, hrmsurveytgroup WHERE hrmsurveytdescription.groupId = '$id_group' AND hrmsurveytdescription.groupId = hrmsurveytgroup.groupId ORDER BY hrmsurveytgroup.groupId");
                                                                        $i = 1;
                                                                        while ($r = mysqli_fetch_assoc($hasil)){

                                                                            $nocount = $id_group.'jawaban'.$i;
                                                    
                                                                            ?>
                                                                            <tr>
                                                                                    <td colspan='1'></td>
                                                                                    
                                                                                    <td colspan='2'><font face='Tahoma' size='2'><?php echo $r[description]; ?></font></td>
                                                                                    <?php if($data['tipejawaban'] == '1'){ 
                                                                                        $select = mysqli_query($connect, "SELECT * FROM hrmsurveytanswer1midtemp WHERE descriptionId = '$r[descriptionId]' AND answerId = '$tj[answerId]' AND nip = '$nip'");
                                                                                        $s = mysqli_fetch_array($select);
                                                                                        ?>
                                                                                    <td align='center' class='fontCustom'> <input type='radio' name='<?php echo $nocount; ?>' value='A' <?php if($s['jawaban1'] == '1'){ echo 'checked'; } ?>> </td>
                                                                                    <td align='center' class='fontCustom'> <input type='radio' name='<?php echo $nocount; ?>' value='B' <?php if($s['jawaban2'] == '1'){ echo 'checked'; } ?> > </td>
                                                                                    <td align='center' class='fontCustom'> <input type='radio' name='<?php echo $nocount; ?>' value='C' <?php if($s['jawaban3'] == '1'){ echo 'checked'; } ?>> </td>
                                                                                    <td align='center' class='fontCustom'> <input type='radio' name='<?php echo $nocount; ?>' value='D' <?php if($s['jawaban4'] == '1'){ echo 'checked'; } ?>> </td>
                                                                                    <?php }elseif($data['tipejawaban'] == '2'){ 
                                                                                        $select = mysqli_query($connect, "SELECT * FROM hrmsurveytanswer2midtemp WHERE descriptionId = '$r[descriptionId]' AND answerId = '$tj[answerId]' AND nip = '$nip'");
                                                                                        $s = mysqli_fetch_array($select);
                                                                                        ?>
                                                                                    <td align='center' class='fontCustom'> <input type='radio' name='<?php echo $nocount; ?>' value='A' <?php if($s['jawaban1'] == '1'){ echo 'checked'; } ?>> </td>
                                                                                    <td align='center' class='fontCustom'> <input type='radio' name='<?php echo $nocount; ?>' value='B' <?php if($s['jawaban2'] == '1'){ echo 'checked'; } ?> > </td>
                                                                                    <td align='center' class='fontCustom'> <input type='radio' name='<?php echo $nocount; ?>' value='C' <?php if($s['jawaban3'] == '1'){ echo 'checked'; } ?>> </td>
                                                                                    <td align='center' class='fontCustom'> <input type='radio' name='<?php echo $nocount; ?>' value='D' <?php if($s['jawaban4'] == '1'){ echo 'checked'; } ?>> </td>
                                                                                    <td align='center' class='fontCustom'> <input type='radio' name='<?php echo $nocount; ?>' value='E' <?php if($s['jawaban5'] == '1'){ echo 'checked'; } ?>> </td>
                                                                                    <?php }elseif($data['tipejawaban'] == '3'){ 
                                                                                        $select = mysqli_query($connect, "SELECT * FROM hrmsurveytanswer3midtemp WHERE descriptionId = '$r[descriptionId]' AND answerId = '$tj[answerId]' AND nip = '$nip'");
                                                                                        $s = mysqli_fetch_array($select);
                                                                                        ?>
                                                                                    <td align='center' class='fontCustom'> <input type='radio' name='<?php echo $nocount; ?>' value='1' <?php if($s['jawaban1'] == '1'){ echo 'checked'; } ?>> </td>
                                                                                    <td align='center' class='fontCustom'> <input type='radio' name='<?php echo $nocount; ?>' value='0' <?php if($s['jawaban0'] == '1'){ echo 'checked'; } ?> > </td>
                                                                                    <?php }elseif($data['tipejawaban'] == '4') { 
                                                                                        $select = mysqli_query($connect, "SELECT * FROM hrmsurveytansweressaymidtemp WHERE descriptionId = '$r[descriptionId]' AND answerId = '$tj[answerId]' AND nip = '$nip'");
                                                                                        $s = mysqli_fetch_array($select);
                                                                                        ?> 
                                                                                        <td align='center' class='fontCustom'><textarea name='<?php echo $nocount; ?>' class="form-control" rows="3" placeholder="<?php echo $s['jawaban']; ?>"></textarea></td>
                                                                                    <?php } ?>
                                                                    </tr>
                                                                    <?php $i++;
                                                                    }?>
                                                                    <!-- <br> -->
                                                                    <?php
                                                                    $no++;
                                                                    
                                                                }
                                                                ?>
                                                            </tbody>
                                                    </table>
                                                <!-- <div class="card-body table-responsive p-0" style="width: 100vw;height: 78vh; width: 98.8%; margin: 5px;"> -->

                                                    <table id="example3LOAD" width="99%" border="1" class="table table-bordered table-striped table-hover table-head-fixed">
                                                        <?php
                                                        error_reporting(0);
                                                        $sql_essay = mysqli_query($connect, "SELECT
                                                        b.*
                                                        FROM hrmsurveygroupessay a
                                                        LEFT JOIN hrmsurveytgroup b ON b.groupId = a.id_group
                                                        WHERE a.id_event = '$id_event' ORDER BY a.order ASC");
                                                        while($data_essay = mysqli_fetch_array($sql_essay)){
                                                            $id_essay = $data_essay[groupId];
                                                        
                                                        ?>
                                                        
                                                        <?php    
                                                            $i_essay = 1;
                                                            $hasil_essay = mysqli_query($connect, "SELECT * FROM hrmsurveytdescription, hrmsurveytgroup WHERE hrmsurveytdescription.groupId = '$data_essay[groupId]' AND hrmsurveytdescription.groupId = hrmsurveytgroup.groupId ORDER BY hrmsurveytgroup.groupId");
                                                            while ($r_essay = mysqli_fetch_array($hasil_essay)){ 
                                                                $nocountessay   = $id_essay.'jawaban'.$i_essay;
                                                                $essay = mysqli_query($connect, "SELECT * FROM hrmsurveytansweressaymidtemp WHERE descriptionId = '$r_essay[descriptionId]' AND answerId = '$tj[answerId]' AND nip = '$nip'");
                                                                $es = mysqli_fetch_array($essay);
                                                                ?> 
                                                        <tr>
                                                            <td colspan="8">    
                                                                    <div class="well">
                                                                        <h4><?php echo $r_essay['description']; ?></h4>           
                                                                            <div class="form-group">
                                                                                <textarea name='<?php echo $nocountessay; ?>' class="form-control" rows="3" placeholder="Tulis Jawaban Anda..." ><?php echo $es['jawaban'] ?></textarea>
                                                                            </div>
                                                                            
                                                                    </div>
                                                                <!-- <hr> -->
                                                            </td>
                                                            </tr>
                                                        <?php $i_essay++; } ?>
                                                        <?php } ?>
                                                            
                                                    </table>
                                                    <table id="example3LOAD" width="99%" border="1" class="table table-bordered table-striped table-hover table-head-fixed">
                                                        <tr>
                                                            <td colspan="8" align=right><button type="submit" class="btn btn-primary btn-lg">Submit</button> </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="97%" valign="top" align="center" colspan="5" style="border-style: none; border-width: medium">
                                                            <center class="well">
                                                            <font face="Arial" size="1"><b>Terima Kasih Atas Waktu dan Masukan yang anda berikan,Semua masukan yang anda berikan </b> </i></font>
                                                            <font face="Arial" size="1"><b>akan kami terima sebagai sarana bagi kami untuk meningkatkan kulaitas pelayanan kami</b>  </i></font>
                                                            </center>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                <!-- </div> -->
                                            </form>

                                        </div>


                                    <?php } ?>
                                </div>


                                <div class='card-footer' style='background-color: #eee;height: 37px;padding-top: 5px;'>

<div class='row mb-2'>
       <div class='col-sm-10'>
              <?php echo $filterprint; ?>
       </div>
       <div class='col-sm-2'>

              <div id="toolbarlist">
                     <div class="toolbar-load sprite-toolbar-loadmore" id="ADD"
                            title="Add"
                            onclick='return startloadmore()'
                            onclick="innerPop('?xfid=hrm.employee.add&amp;forcegen=1',reposBlock)">
                            <a onclick='#' class="down" href="#"></a></div>
              </div>


       </div>
</div>

</div>

</div>
</div>
<div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
</div>

                            <!-- Column -->


<?php 
// include "controller/aksi_edit.php";
?>

                            

        


<script type="text/javascript">
$(document).ready(function() {
       bsCustomFileInput.init();
});
</script>
<script type="text/javascript">
$(document).ready(function() {
       $(".id").change(function() {
              var id = $(this).val();
              var post_id = 'id=' + id;

              $.ajax({
                     type: "POST",
                     url: "fetch_filter_v2.php",
                     data: post_id,
                     cache: false,
                     success: function(cities) {
                            $(".module").html(cities);
                     }
              });

       });
});
</script>

<div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                   aria-hidden="true">
                            </div>