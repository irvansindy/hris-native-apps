<?php
include "../../application/config.php";
!empty($_GET['emp_id']) ? $username = $_GET['emp_id'] : $username = '';
!empty($_GET['rfid']) ? $rfid = $_GET['rfid'] : $rfid = '';
?>