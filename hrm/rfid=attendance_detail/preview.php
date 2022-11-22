<?php
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
    include "../../application/session/session.php";
    $getPackage = "?";
} else {
    include "../../application/session/mobile.session.php";
    $getPackage = "?emp_id=$username&";
}
?>

<style type="text/css" media="print">
    table {
        border: solid 0px #000;
        border-collapse: collapse;
        width: 100%;
    }

    tr {
        border: solid 0px #000
    }

    td {
        padding: 0px 5px;
        font-family: Arial;
        font-size: 15px;
        padding-top: 4px;
    }

    h3 {
        margin-bottom: 0px
    }

    h2 {
        margin-bottom: 0px
    }
</style>

<style type="text/css" media="screen">
    table {
        border: solid 0px #000;
        border-collapse: collapse;
        width: 45%;
    }

    tr {
        border: solid 0px #000
    }

    td {
        padding: 0px 5px;
        font-family: Arial;
        font-size: 15px;
        padding-top: 4px;
    }

    h3 {
        margin-bottom: 0px
    }

    h2 {
        margin-bottom: 0px
    }
</style>

<?php

$datestart = $_POST['inp_add_startdate'];
$dateend = $_POST['inp_add_enddate'];

?>

<body onLoad="window.print()">



    <title>Report | Reimburse</title>

    <link rel="stylesheet" href="../../../asset/dist/css/report.css" />
    <link href="../../../asset/dist/gt.png" rel="shortcut icon" type="image/x-icon" />
    <p>
        <font size="-1" face="Arial, Gadget, sans-serif">PT Pralon
    </p>
    <p>&nbsp;</p>
    <p>
        <font size="-1" face="Arial, Gadget, sans-serif">Location : Tangerang
    </p>
    <hr>
    <table width="100%" class="approval">
        <tr>
            <td align="center"><strong>
                    <font size="2">

                        <table width="100%">
                            <tr>
                                <td align="center"><strong>ATTENDANCE DETAIL</strong>
                                    <br>
                                    <font size="-1" face="Arial, Gadget, sans-serif"><?php echo date("d F Y", strtotime($datestart)); ?> - <?php echo date("d F Y", strtotime($dateend)); ?>
                                        <br>
                                        <font size="-1" face="Arial, Gadget, sans-serif">Company : PT Pralon (Tangerang)</p>
                                </td>
                            </tr>
                        </table>
            </td>
        </tr>
    </table>

    <table>
        <tr>

            <th style="background: lightgray;color: white;" width="95" height="37" align="center">
                <font size="-1" face="Arial, Gadget, sans-serif">No.
            </th>
            <th style="background: lightgray;color: white;" align="center" width="69">
                <font size="-1" face="Arial, Gadget, sans-serif">Nip
            </th>
            <th style="background: lightgray;color: white;" width="143">
                <font size="-1" face="Arial, Gadget, sans-serif">Name
            </th>
            <th style="background: lightgray;color: white;" width="50%">
                <font size="-1" face="Arial, Gadget, sans-serif">Dept
            </th>
            <th style="background: lightgray;color: white;">
                <font size="-1" face="Arial, Gadget, sans-serif">Status
            </th>
            <th style="background: lightgray;color: white;">
                <font size="-1" face="Arial, Gadget, sans-serif">Starttime
            </th>
            <th style="background: lightgray;color: white;">
                <font size="-1" face="Arial, Gadget, sans-serif">Geolocation
            </th>
            <th style="background: lightgray;color: white;">
                <font size="-1" face="Arial, Gadget, sans-serif">Distance
            </th>
            <th style="background: lightgray;color: white;">
                <font size="-1" face="Arial, Gadget, sans-serif">Photos
            </th>

        </tr>

        
<?php 
  $no = 0;
  $com1=mysqli_query( $connect , "SELECT *,a.status as att_status FROM ttadattendancetemp a
                                        LEFT JOIN view_employee b on a.emp_no=b.emp_no");
  while($r=mysqli_fetch_array($com1)){
  $no++;
?>		
	  <tr>
        <td align="center"><font size="-1" face="Arial, Gadget, sans-serif"><?php echo $no ?></td>
        <td align="center" nowrap="nowrap"><font size="-1" face="Arial, Gadget, sans-serif"><?php echo $r['emp_no'] ?></td>
        <td nowrap="nowrap"><font size="-1" face="Arial, Gadget, sans-serif"><?php echo $r['Full_Name'] ?></td>
        <td nowrap="nowrap"><font size="-1" face="Arial, Gadget, sans-serif"><?php echo $r['cost_code'] ?></td>
        <td nowrap="nowrap"><font size="-1" face="Arial, Gadget, sans-serif"><?php echo $r['att_status'] ?></td>
        <td align="center" nowrap="nowrap"><font size="-1" face="Arial, Gadget, sans-serif"><?php echo date ("d F Y H:m:s", strtotime ($r['starttime'])) ?></td>
        <td nowrap="nowrap"><font size="-1" face="Arial, Gadget, sans-serif"><?php echo $r['latitude'] ?> , <?php echo $r['longlatitude'] ?></td>
    
        <td nowrap="nowrap"><font size="-1" face="Arial, Gadget, sans-serif"><?php echo $r['distance_flag'] ?></td>
        <td nowrap="nowrap"><font size="-1" face="Arial, Gadget, sans-serif"><img src="../../application/API/uploads/<?php echo $r['photos'] ?>" style="max-width: 200px;"></td>
      </tr>
<?php } ?>

    </table>