<?php 

// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=LeaveCancellationReqData_Booking.xls");
 
// Tambahkan table
include 'TaDownloadGTTGRLeaveCancellationReqData.php';
?>