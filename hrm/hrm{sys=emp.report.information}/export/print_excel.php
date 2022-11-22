<?php 

// Fungsi header dengan mengirimkan raw data excel
// if(isset($_POST['print_excel'])){
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=Employee Information Detail Report.xls");
 
// Tambahkan table
include 'data_excel.php';
// }
?>