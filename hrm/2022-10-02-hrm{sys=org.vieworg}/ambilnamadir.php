<?php 
include "../../application/config.php"; 
$dir    = $_POST['dir'];
                                                                    $query_ambil_dir   = mysqli_query($connect, "SELECT 
                                                                    DISTINCT(direktorat_name)
                                                                    FROM od_tempmigrateorgunit where direktorat_id = '$dir'");
                                                                    $count_ambil_dir   = mysqli_num_rows($query_ambil_dir);
                                                                    $data_ambil_dir    = mysqli_fetch_assoc($query_ambil_dir);
                                                                    if($count_ambil_dir > 0){
                                                                        $nama_dir    = $data_ambil_dir['direktorat_name'];
                                                                    }else{
                                                                        $nama_dir    = '0';
                                                                    }
echo "$nama_dir";
?>