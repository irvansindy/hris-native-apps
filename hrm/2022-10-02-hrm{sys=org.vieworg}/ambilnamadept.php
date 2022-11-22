<?php 
include "../../application/config.php"; 
$dept    = $_POST['dept'];
                                                                    $query_ambil_division   = mysqli_query($connect, "SELECT * FROM od_tempmigrateorgunit where departemen_id = '$dept'");
                                                                    $count_ambil_division   = mysqli_num_rows($query_ambil_division);
                                                                    $data_ambil_division    = mysqli_fetch_assoc($query_ambil_division);
                                                                    if($count_ambil_division > 0){
                                                                        $nama_divisi    = $data_ambil_division['departemen_name'];
                                                                    }else{
                                                                        $nama_divisi    = '-';
                                                                    }
echo "$nama_divisi";
?>