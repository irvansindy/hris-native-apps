<?php
include('../config.php');
include "zklibrary.php";
echo 'Library Loaded</br>';
$zk = new ZKLibrary('192.168.10.4', 4370, 'TCP');
echo 'Requesting for connection</br>';
$zk->connect();
echo 'Connected</br>';
$zk->disableDevice();
echo 'disabling device</br>';
$users = $zk->getUser();


$attendace = $zk->getAttendance();
?>

<table width="100%" border="1" cellspacing="0" cellpadding="0" style="border-collapse:collapse;">
<thead>
  <tr>
    <td width="25">No</td>
    <td>UID</td>
    <td>ID</td>
    <td>State</td>
    <td>Date/Time</td>
  </tr>
</thead>

<tbody>
<?php
$no = 0;
foreach($attendace as $key=>$at)
{
  $no++;

  $var1 = array(".",":"," ", "-");
	$var2 = array("","","","");
	$conversion = $at[1].str_replace($var1, $var2, $at[3]);
  $hour       = substr($at[3],12,2);
  $minutes    = substr($at[3],15,2);
  $second     = substr($at[3],18,2);
  $day        = substr($at[3],9,2);
  $month      = substr($at[3],6,2);
  $year       = substr($at[3],0,4);
  
  if($at[2] == '0') {
    $status = '1';
  } else if ($at[2] == '1') {
    $status = '0';
  } else {
    $status = $at[2];
  }

  if($at[1] != '0') {
    $sendToMachine = mysqli_query($connect , "INSERT IGNORE INTO `hrdattendancetemp` 
                                                (
                                                  `attenddata`, 
                                                  `machine_code`, 
                                                  `attendanceid`, 
                                                  `attend_date`, 
                                                  `hour`, 
                                                  `minute`, 
                                                  `second`, 
                                                  `day`, 
                                                  `month`, 
                                                  `year`, 
                                                  `status`, 
                                                  `machineno`, 
                                                  `uploadstatus`, 
                                                  `created_by`, 
                                                  `created_date`, 
                                                  `modified_by`, 
                                                  `modified_date`, 
                                                  `company_id`, 
                                                  `remark`, 
                                                  `photo`, 
                                                  `geolocation`, 
                                                  `att_on`
                                                ) VALUES 
                                                    (
                                                      '$conversion',
                                                      'FINGERPRINT',
                                                      '$at[1]', 
                                                      '$at[3]', 
                                                      '$hour', 
                                                      '$minutes', 
                                                      '$second', 
                                                      '$day', 
                                                      '$month', 
                                                      '$year', 
                                                      '$status', 
                                                      '192.168.10.4', 
                                                      '0', 
                                                      '$at[1]', 
                                                      '$SFdatetime', 
                                                      '$at[1]', 
                                                      '$SFdatetime', 
                                                      '0', 
                                                      '0', 
                                                      '0', 
                                                      '0', 
                                                      '0'
                                                    )");
  }
 
?>



  <tr>
    <td align="right"><?php echo $no;?></td>
    <td><?php echo $at[0];?></td>
    <td><?php echo $at[1];?></td>
    <td><?php echo $at[2];?></td>
    <td><?php echo $at[3];?></td>
  </tr>

<?php
}
?>

</tbody>
</table>
<?php

$zk->enableDevice();
$zk->disconnect();

?>