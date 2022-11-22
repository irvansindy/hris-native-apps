<?php 

// Fungsi header dengan mengirimkan raw data excel
if(isset($_POST['print_excel'])){
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=Scale All.xls");
 
// Tambahkan table
include 'data_scale_all.php';
}
if(isset($_POST['print_cetak'])){
     
    // Tambahkan table
    include 'data_scale_all.php'; ?>
    <script>
		window.print();
	</script>
<?php }
?>