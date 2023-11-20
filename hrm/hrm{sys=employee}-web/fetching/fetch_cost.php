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
 
 $sql = "SELECT * FROM hrmorgstruc WHERE costcenter_code LIKE '%$search%' GROUP BY costcenter_code";
 $result = $connect->query($sql);
 
 if ($result->num_rows > 0) {
     $list = array();
     $key=0;
     while($row = $result->fetch_assoc()) {
         $list[$key]['id'] = $row['costcenter_code'];
         $list[$key]['text'] = $row['costcenter_code']; 
     $key++;
     }
     echo json_encode($list);
 } else {
     echo "hasil kosong";
 }
 $connect->close();
}
 
?>