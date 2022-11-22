<?php 
include "../../application/config.php";
date_default_timezone_set('Asia/Bangkok'); 
	
$SFdate                 = date("Y-m-d");
$SFtime                 = date('h:i:s');
$SFdatetime             = date("Y-m-d H:i:s");
$SFnumber               = date("YmdHis");
$SFcode                 = "PROC".date("YmdHis");
?>

<?php
//upload.php
if($_GET['code'] == '1' && $_FILES["file"]["name"] != '')
{

 
 $test = explode('.', $_FILES["file"]["name"]);
 $ext = end($test);
 $ori   = $_FILES["file"]["name"];
 $get_singkat_file = sqlsrv_fetch_array(sqlsrv_query($conn, "SELECT singkat_file from proc_mfile WHERE id_file = '22'"));
 $name = '22-'.  $get_singkat_file['singkat_file'] . '.' . $ext;
 $location = '../../asset/list_document/' . $name; 
 
    if(move_uploaded_file($_FILES["file"]["tmp_name"], $location)){ 
        $usingdb 	        = sqlsrv_query($conn, "SET IDENTITY_INSERT proc_mattacment ON");
        // $process_request    = sqlsrv_query($conn, "UPDATE proc_drfqitems SET file_brosur = '$name' WHERE purchasing_document = '$purchasing_document' and material = '$material'");
        // $process_request    = sqlsrv_query($conn, "INSERT INTO proc_drfqitemsattachment 
        //                                             (  
        //                                                 purchasing_document,
        //                                                 material,
        //                                                 file_brosur,
        //                                                 created_date,
        //                                                 created_by,
        //                                                 modified_date,
        //                                                 modified_by

        //                                             ) VALUES 
        //                                                 (
        //                                                     '$purchasing_document',
        //                                                     '$material',
        //                                                     '$name',
        //                                                     '$SFdatetime',
        //                                                     'SYSTEM',
        //                                                     '$SFdatetime',
        //                                                     'SYSTEM'
        //                                                 )
        //                                             ");

    echo '<img style="width: 50%;margin-bottom: 20px;" src="uploaded_files/pngs.png" height="425" width="425" class="img-thumbnail" />';
    }
 }
?>