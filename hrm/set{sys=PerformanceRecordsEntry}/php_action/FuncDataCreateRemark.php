<?php

require_once '../../../application/config.php';

if(isset($_POST['field']) && isset($_POST['req_no']) && isset($_POST['target'])  && isset($_POST['ipp_id'])){
   $field = mysqli_real_escape_string($connect,$_POST['field']);
    $req_no = mysqli_real_escape_string($connect,$_POST['req_no']);
     $target = mysqli_real_escape_string($connect,$_POST['target']);
      $ipp_id = mysqli_real_escape_string($connect,$_POST['ipp_id']);
       $kpi_perspektif_id = mysqli_real_escape_string($connect,$_POST['kpi_perspektif_id']);

   // $query = "INSERT INTO `gthrisco_tmdev`.`debug` (`name`, `last_name`, `ende`) VALUES ('$field', '$req_no', '$target')";

   $query = "UPDATE hrmperf_iprecord SET remark = '$field' WHERE `ipp_reqno` = '$req_no' AND `target` = '$target' AND `ipp_id` = '$ipp_id' AND `kpi_perspektif_id` = '$kpi_perspektif_id'";

   $proc = mysqli_query($connect,$query);

   if($proc) {
      echo 1;
   } else {
      echo 0;
   }

   
}else{
   echo 0;
}
exit;