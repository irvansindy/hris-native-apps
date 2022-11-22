<?php
	include '../config.php';
	$id=$_GET['id'];
	$con->query("DELETE FROM ttadleaverequestdetail WHERE id=".$id);
?>