<?php 
include "../../application/session/session.php";
$emp_no     = $_POST['empno'];

$query_data_profile     = mysqli_query($connect, "SELECT 
                    a.name,
                    b.nama_posisi,
                    a.grade,
                    a.join_date,
                    a.los,
                    a.picture,
                    a.address,
                    a.age,
                    a.lastPOS,
                    a.lastPOSyear,
                    a.LastestgradeStart,
                    a.LastestgradeYears
                    FROM od_simpeople a
                    LEFT JOIN od_simposisi b ON a.people_id = b.people_id
                    WHERE a.people_id = '$emp_no'");
                    $data_profile           = mysqli_fetch_assoc($query_data_profile);
?>
<table>
                    <tr>
                        <td valign="top" style="width:240px">
                            <div>
                                <img style="width:224px;height:280px; border:2px solid black" src="images/user/<?php echo $data_profile['picture'] ?>" alt="">
                            </div>
                        </td>
                        <td valign="top">
                            <div>
                                <table>
                                    <tr>
                                        <td><b style="font-size:22px; font-family: Arial;"><?php echo $data_profile['name'] ?></b></td>
                                    </tr>
                                    <tr>
                                        <td><p style="font-size:16px; font-family: Arial;"><?php echo $data_profile['nama_posisi'] ?></p></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table>
                                                <tr>
                                                    <td style="width:200px; font-size:16px"><b>Join Date : <?php echo $data_profile['join_date'] ?></b></td>
                                                    <td style="width:40px"><b>|</b></td>
                                                    <td style="width:100px; font-size:16px"><b>Grade : <?php if($data_profile['grade'] == '0'){ echo 'NA'; }else{ echo $data_profile['grade']; }  ?></b></td>
                                                    <td style="width:40px"><b>|</b></td>
                                                    <td style="width:90px; font-size:16px"><b>Age : <?php echo  $data_profile['age']  ?></b></td>
                                                    <td style="width:40px"><b>|</b></td>
                                                    <td style="width:80px; font-size:16px"><b>LOS : <?php echo $data_profile['los'] ?></b></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table style="margin-top: 10px">
                                                <tr>
                                                    <td style="width:300px; font-size:16px;"><b>Date at current position</b></td>
                                                    <td style="width:20px"><b>:</b></td>
                                                    <td style="width:100px; font-size:16px"><b><?php echo $data_profile['lastPOS'] ?></b></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:180px; font-size:16px"><b>Service period at current position</b></td>
                                                    <td style="width:20px"><b>:</b></td>
                                                    <td style="width:100px; font-size:16px"><b><?php echo $data_profile['lastPOSyear'] ?></b></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="margin-top:10px"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table>
                                                <tr>
                                                    <td style="width:300px; font-size:16px"><b>Date at current grade</b></td>
                                                    <td style="width:20px"><b>:</b></td>
                                                    <td style="width:100px; font-size:16px"><b><?php echo $data_profile['LastestgradeStart'] ?></b></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:180px; font-size:16px"><b>Service period at current grade</b></td>
                                                    <td style="width:20px"><b>:</b></td>
                                                    <td style="width:100px; font-size:16px"><b><?php echo $data_profile['LastestgradeYears'] ?></b></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><hr></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table>
                                                <tr>
                                                    <td>
                                                        <b>CAREER HISTORY</b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="table-responsive">
                                                            <table class="table" style="background-color: rgb(255, 248, 237);" border="1">
                                                                <thead>
                                                                    <tr>
                                                                    <th scope="col">#</th>
                                                                    <th scope="col">HISTORY NO</th>
                                                                    <th scope="col">POSITION</th>
                                                                    <th scope="col">CAREER TYPE </th>
                                                                    <th scope="col">CAREER DETAIL</th>
                                                                    <th scope="col">START PERIOD</th>
                                                                    <th scope="col">END PERIOD</th>
                                                                    <th scope="col">GRADE</th>
                                                                    <th scope="col">REMARKS</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php 
                                                                        $no = 1;
                                                                        $query_data_career  = mysqli_query($connect, "SELECT history_no, pos_name_en, careertransition_name_en, careertrans_dtl_name_en, start_period, end_period, grade_code, remarks
                                                                        FROM od_teodemployementhistory WHERE emp_no = '$emp_no'");
                                                                        while($data_career  = mysqli_fetch_assoc($query_data_career)){

                                                                        
                                                                    ?>
                                                                    <tr>
                                                                    <td scope="row"><?php echo $no++; ?></td>
                                                                    <td><?php echo $data_career['history_no']; ?></td>
                                                                    <td><?php echo $data_career['pos_name_en']; ?></td>
                                                                    <td><?php echo $data_career['careertransition_name_en']; ?></td>
                                                                    <td><?php echo $data_career['careertrans_dtl_name_en']; ?></td>
                                                                    <td><?php echo $data_career['start_period']; ?></td>
                                                                    <td><?php echo $data_career['end_period']; ?></td>
                                                                    <td><?php echo $data_career['grade_code']; ?></td>
                                                                    <td><?php echo $data_career['remarks']; ?></td>
                                                                    </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                </table>