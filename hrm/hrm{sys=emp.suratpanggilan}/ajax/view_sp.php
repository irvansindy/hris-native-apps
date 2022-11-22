<?php 
include "../../../application/session/session_ess.php";

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("d m Y");
$tanggal                = date("d");
$bulan_num              = date("m");
$tahun                  = date("Y");
$bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
$bulan_num_min          = $bulan_num - 1;
$bulan_array = $bulan[$bulan_num_min];

$monthList = array(
    '01' => 'Januari',
    '02' => 'Februari',
    '03' => 'Maret',
    '04' => 'April',
    '05' => 'Mei',
    '06' => 'Juni',
    '07' => 'Juli',
    '08' => 'Agustus',
    '09' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Desember'
);

$rc     = $_POST['rc'];
$sql_data   = mysqli_query($connect, "SELECT 
b.Full_Name,
a.to_empno AS emp_no,
b.cost_code,
c.shiftgroupcode,
a.hari, DATE_FORMAT(a.tanggal, '%d') AS tanggal, 
DATE_FORMAT(a.tanggal, '%m') AS bulan, 
DATE_FORMAT(a.tanggal, '%Y') AS tahun,
a.waktu,
a.tempat,
a.masalah,
a.signee_by,
d.Full_Name AS signee_by_pengajuan,
d.pos_name_en, CONCAT('(', d.pos_code, ')') AS pos_code
FROM hrddisciplineshistory a
LEFT JOIN view_employee b ON b.emp_no = a.to_empno
LEFT JOIN curshiftgroup c ON c.emp_no = a.to_empno
LEFT JOIN view_employee d ON d.emp_no = a.signee_by
WHERE a.noref = '$rc'");

$data       = mysqli_fetch_assoc($sql_data);

$cc = str_replace('_', ' / ', $data['cost_code']);
$pos_name_en = str_replace($data['pos_code'], '', $data['pos_name_en']);

$tanggal_bulan_tahun = $data['tanggal'].' '.$monthList[$data['bulan']].' '.$data['tahun'];

?>


<div style="padding:40px;">
    <table width="100%">
        <tr>
            <td>
                <table>
                    <td><p style="width:50px; font-size:14px">Hal</p></td>
                    <td><p style="width:10px; font-size:14px">:</p></td>
                    <td><p style="font-size:14px">Panggilan</p></td>
                </table>
            </td>
        </tr>
        <tr>
            <td style="width:50%"></td>
            <td>
                <table width="100%">
                    <tr>
                        <td><p style="width:50px; font-size:14px; margin-bottom:0px">Sdr/Sdri</p></td>
                        <td><p style="width:10px; font-size:14px; margin-bottom:0px">:</p></td>
                        <td><p style="font-size:14px; margin-bottom:0px"><?php echo $data['Full_Name'] ?></p></td>
                    </tr>
                    <tr>
                        <td><p style="width:50px; font-size:14px; margin-bottom:0px">NIP</p></td>
                        <td><p style="width:10px; font-size:14px; margin-bottom:0px">:</p></td>
                        <td><p style="font-size:14px; margin-bottom:0px"><?php echo $data['emp_no'] ?></p></td>
                    </tr>
                    <tr>
                        <td><p style="width:50px; font-size:14px; margin-bottom:0px">Bagian</p></td>
                        <td><p style="width:10px; font-size:14px; margin-bottom:0px">:</p></td>
                        <td><p style="font-size:14px; margin-bottom:0px"><?php echo $cc; ?></p></td>
                    </tr>
                    <tr>
                        <td><p style="width:50px; font-size:14px; margin-bottom:0px">Group</p></td>
                        <td><p style="width:10px; font-size:14px; margin-bottom:0px">:</p></td>
                        <td><p style="font-size:14px; margin-bottom:0px"><?php echo $data['shiftgroupcode']; ?></p></td>
                    </tr>
                    <tr>
                        <td><p style="width:50px; font-size:14px; margin-bottom:0px">Via</p></td>
                        <td><p style="width:10px; font-size:14px; margin-bottom:0px">:</p></td>
                        <td><p style="font-size:14px; margin-bottom:0px">Pimpinan Ybs</p></td>
                    </tr>
                    <tr>
                        <td><p style="width:50px; font-size:14px">Di</p></td>
                        <td><p style="width:10px; font-size:14px">:</p></td>
                        <td><p style="font-size:14px">Tempat</p></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <table>
                <td><p style="font-size:14px">Dengan Hormat,</p></td>
            </table>
        </tr>
        <tr>
            <table>
                <td>
                    <p style="font-size:14px; margin-bottom:20px">Dengan ini kami mengharap kedatangannya pada :</p>
                </td>
            </table>
        </tr>
        <tr>
            <table width="100%">
                <td style="width:5%"></td>
                <td>
                    <table>
                        <tr>
                            <td><p style="width:60px; font-size:14px; margin-bottom:0px">Hari</p></td>
                            <td><p style="width:10px; font-size:14px; margin-bottom:0px">:</p></td>
                            <td><p style="font-size:14px; margin-bottom:0px"><?php echo $data['hari'] ?></p></td>
                        </tr>
                        <tr>
                            <td><p style="width:60px; font-size:14px; margin-bottom:0px">Tanggal</p></td>
                            <td><p style="width:10px; font-size:14px; margin-bottom:0px">:</p></td>
                            <td><p style="font-size:14px; margin-bottom:0px"><?php echo $tanggal_bulan_tahun; ?></p></td>
                        </tr>
                        <tr>
                            <td><p style="width:60px; font-size:14px; margin-bottom:0px">Waktu</p></td>
                            <td><p style="width:10px; font-size:14px; margin-bottom:0px">:</p></td>
                            <td><p style="font-size:14px; margin-bottom:0px"><?php echo $data['waktu'] ?></p></td>
                        </tr>
                        <tr>
                            <td><p style="width:60px; font-size:14px; margin-bottom:20px">Tempat</p></td>
                            <td><p style="width:10px; font-size:14px; margin-bottom:20px">:</p></td>
                            <td><p style="font-size:14px; margin-bottom:20px"><?php echo $data['tempat'] ?></p></td>
                        </tr>
                    </table>
                </td>
            </table>
        </tr>
        <tr>
            <table>
                <td>
                    <p style="font-size:14px">Sehubungan dengan masalah :</p>
                </td>
                <td><p style="font-size:14px"><?php echo $data['masalah'] ?></p></td>
            </table>
        </tr>
        <tr>
            <table>
                <td>
                    <p style="font-size:14px">Cc : Staff Personal Shift HR Operation</p>
                </td>
            </table>
        </tr>
        <tr>
            <table width="100%">
                <td style="width:50%"></td>
                <td>
                    <table>
                        <tr>
                            <td><p style="font-size:14px; margin-bottom:0px">Tangerang, <?php echo $tanggal; ?> <?php echo $bulan_array; ?> <?php echo $tahun; ?></p></td>
                        </tr>
                        <tr>
                            <td><p style="font-size:14px">Bagian HR Operation</p></td>
                        </tr>
                        <tr>
                            <td style="height:60px"></td>
                        </tr>
                        <tr>
                            <td><b style="font-size:14px; font-weight:bold"><?php echo $data['signee_by_pengajuan']; ?></b></td>
                        </tr>
                        <tr>
                            <td><p style="font-size:14px"><?php echo $pos_name_en; ?></p></td>
                        </tr>
                    </table>
                </td>
            </table>
        </tr>
    </table>
    <hr style="border: 2px solid black;">
    <table width="100%">
        <tr>
            <td>
                <table>
                    <td><p style="width:50px; font-size:14px">Hal</p></td>
                    <td><p style="width:10px; font-size:14px">:</p></td>
                    <td><p style="font-size:14px">Panggilan</p></td>
                </table>
            </td>
        </tr>
        <tr>
            <td style="width:50%"></td>
            <td>
                <table width="100%">
                    <tr>
                        <td><p style="width:50px; font-size:14px; margin-bottom:0px">Sdr/Sdri</p></td>
                        <td><p style="width:10px; font-size:14px; margin-bottom:0px">:</p></td>
                        <td><p style="font-size:14px; margin-bottom:0px"><?php echo $data['Full_Name'] ?></p></td>
                    </tr>
                    <tr>
                        <td><p style="width:50px; font-size:14px; margin-bottom:0px">NIP</p></td>
                        <td><p style="width:10px; font-size:14px; margin-bottom:0px">:</p></td>
                        <td><p style="font-size:14px; margin-bottom:0px"><?php echo $data['emp_no'] ?></p></td>
                    </tr>
                    <tr>
                        <td><p style="width:50px; font-size:14px; margin-bottom:0px">Bagian</p></td>
                        <td><p style="width:10px; font-size:14px; margin-bottom:0px">:</p></td>
                        <td><p style="font-size:14px; margin-bottom:0px"><?php echo $cc; ?></p></td>
                    </tr>
                    <tr>
                        <td><p style="width:50px; font-size:14px; margin-bottom:0px">Group</p></td>
                        <td><p style="width:10px; font-size:14px; margin-bottom:0px">:</p></td>
                        <td><p style="font-size:14px; margin-bottom:0px"><?php echo $data['shiftgroupcode']; ?></p></td>
                    </tr>
                    <tr>
                        <td><p style="width:50px; font-size:14px; margin-bottom:0px">Via</p></td>
                        <td><p style="width:10px; font-size:14px; margin-bottom:0px">:</p></td>
                        <td><p style="font-size:14px; margin-bottom:0px">Pimpinan Ybs</p></td>
                    </tr>
                    <tr>
                        <td><p style="width:50px; font-size:14px">Di</p></td>
                        <td><p style="width:10px; font-size:14px">:</p></td>
                        <td><p style="font-size:14px">Tempat</p></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <table>
                <td><p style="font-size:14px">Dengan Hormat,</p></td>
            </table>
        </tr>
        <tr>
            <table>
                <td>
                    <p style="font-size:14px; margin-bottom:20px">Dengan ini kami mengharap kedatangannya pada :</p>
                </td>
            </table>
        </tr>
        <tr>
            <table width="100%">
                <td style="width:5%"></td>
                <td>
                    <table>
                        <tr>
                            <td><p style="width:60px; font-size:14px; margin-bottom:0px">Hari</p></td>
                            <td><p style="width:10px; font-size:14px; margin-bottom:0px">:</p></td>
                            <td><p style="font-size:14px; margin-bottom:0px"><?php echo $data['hari'] ?></p></td>
                        </tr>
                        <tr>
                            <td><p style="width:60px; font-size:14px; margin-bottom:0px">Tanggal</p></td>
                            <td><p style="width:10px; font-size:14px; margin-bottom:0px">:</p></td>
                            <td><p style="font-size:14px; margin-bottom:0px"><?php echo $tanggal_bulan_tahun; ?></p></td>
                        </tr>
                        <tr>
                            <td><p style="width:60px; font-size:14px; margin-bottom:0px">Waktu</p></td>
                            <td><p style="width:10px; font-size:14px; margin-bottom:0px">:</p></td>
                            <td><p style="font-size:14px; margin-bottom:0px"><?php echo $data['waktu'] ?></p></td>
                        </tr>
                        <tr>
                            <td><p style="width:60px; font-size:14px; margin-bottom:20px">Tempat</p></td>
                            <td><p style="width:10px; font-size:14px; margin-bottom:20px">:</p></td>
                            <td><p style="font-size:14px; margin-bottom:20px"><?php echo $data['tempat'] ?></p></td>
                        </tr>
                    </table>
                </td>
            </table>
        </tr>
        <tr>
            <table>
                <td>
                    <p style="font-size:14px">Sehubungan dengan masalah :</p>
                </td>
                <td><p style="font-size:14px"><?php echo $data['masalah'] ?></p></td>
            </table>
        </tr>
        <tr>
            <table>
                <td>
                    <p style="font-size:14px">Cc : Staff Personal Shift HR Operation</p>
                </td>
            </table>
        </tr>
        <tr>
            <table width="100%">
                <td style="width:50%"></td>
                <td>
                    <table>
                        <tr>
                            <td><p style="font-size:14px; margin-bottom:0px">Tangerang, <?php echo $tanggal; ?> <?php echo $bulan_array; ?> <?php echo $tahun; ?></p></td>
                        </tr>
                        <tr>
                            <td><p style="font-size:14px">Bagian HR Operation</p></td>
                        </tr>
                        <tr>
                            <td style="height:60px"></td>
                        </tr>
                        <tr>
                            <td><b style="font-size:14px; font-weight:bold"><?php echo $data['signee_by_pengajuan']; ?></b></td>
                        </tr>
                        <tr>
                            <td><p style="font-size:14px"><?php echo $pos_name_en; ?></p></td>
                        </tr>
                    </table>
                </td>
            </table>
        </tr>
    </table>
</div>
<div class="modal-footer">
                                                                      <div class="form-group">
                                                                            <button type="button"
                                                                                    class="btn btn-default btn-sm"
                                                                                    data-dismiss="modal">Cancel</button>
                                                                           
                                                                             <a href="export/print.php?id=<?php echo $rc; ?>"  class="btn btn-warning btn-sm submit" target="_blank">Print</a>
                                                                             <!-- <button type="submit" id="letter_submit" id1="<?php echo $rc; ?>"
                                                                                    class="btn btn-warning btn-sm submit">Print</button> -->
                                                                            
                                                                      </div>
                                                               </div>