<?php include "../../../application/config.php";?>
<?php
if($_SERVER['REQUEST_METHOD']=="GET"){

 daftarPropinsi($_GET['search']);
}
 
function daftarPropinsi($search){
 global $connect;
 
 if ($connect->connect_error) {
     die("Koneksi Gagal: " . $conn->connect_error);
 }
 
 $sql = "SELECT * FROM hrmeduinstitution WHERE edu_name LIKE '$search%' ORDER BY edu_name ASC";
 $result = $connect->query($sql);
 
 if ($result->num_rows > 0) {
     $list = array();
     $key=0;
     while($row = $result->fetch_assoc()) {
         $list[$key]['id'] = $row['edu_name'];
         $list[$key]['text'] = $row['edu_name']; 
     $key++;
     }
     echo json_encode($list);
 } else {
     echo "hasil kosong";
 }
 $connect->close();
}
 
?>