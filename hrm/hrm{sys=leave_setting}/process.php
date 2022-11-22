<?php
if (isset($_POST['submit_update_leave'])) {

date_default_timezone_set('Asia/Bangkok'); 
	
$SFdate                       = date("Y-m-d");
$SFtime                       = date('h:i:s');
$SFtime_current               = date('Y-m-d h:i');
$SFdatetime                   = date("Y-m-d H:i:s");
$SFnumber                     = date("YmdHis");
$SFnumbercon                  = 'LVR'.$SFnumber;

if(!empty($_POST['framework'])) 
{   
    $frm                = $_POST['framework'];
    $count              = count($_POST['framework']);
} else {
    $frm                = '';
    $count              = '';
}

$delete = mysqli_query($connect, "DELETE FROM hrdvalleave WHERE created_by = '$username'");

if ($delete)
{

    $query_team = "

    INSERT INTO hrdvalleave (
        leave_code,
        emp_id,
        created_by) VALUES ";

    for( $i=0; $i < $count; $i++ )
    {
        $query_team .= "(
            'ANL',
            '{$frm[$i]}',
            '$username')";

        $query_team .= ",";
    }

    $sql = rtrim($query_team,",");
    $data = mysqli_query($connect, $sql);

} else {
    $query_team = "

    INSERT INTO hrdvalleave (
        leave_code,
        emp_id,
        created_by) VALUES ";

    for( $i=0; $i < $count; $i++ )
    {
        $query_team .= "(
            'ANL',
            '{$frm[$i]}',
            '$username')";

        $query_team .= ",";
    }

    $sql = rtrim($query_team,",");
    $data = mysqli_query($connect, $sql);
}

    if($data) 
    {
    echo "<script type='text/javascript'>
                window.alert('Successfully Update Leave Setting'); 
                window.location.replace('../hrm{sys=leave_setting}');         
            </script>";  
    }
    else
    {
    echo"<script type='text/javascript'>
                window.alert('Wrong Approval Formula');     
            </script>";
     }
    }
?>