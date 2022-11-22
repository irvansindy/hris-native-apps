<?php
include "../../../application/config.php";
$employee       = $_GET['employee'];
$requestno      = $_GET['requestno'];
$category       = $_GET['category'];
//$modal_id = '1';
$no = 1;
$modal = mysqli_query($connect, "SELECT 
                                        *,
                                        DATE_FORMAT(e.startdate, '%d %b %Y') as c_startdate,
                                        DATE_FORMAT(e.enddate, '%d %b %Y') as c_enddate
                                        FROM trndrequest a
                                        LEFT JOIN trnmrequest e ON a.request_no=e.request_no
                                        LEFT JOIN view_employee b ON a.emp_id=b.emp_id
                                        LEFT JOIN trncourse c ON c.id_course=e.training_category
                                        LEFT JOIN trnprovider d ON d.provider_code=e.training_provider
                                    WHERE 
                                        a.request_no = '$requestno' AND 
                                        a.emp_id = '$employee' AND 
                                        e.training_category = '$category'"); 

$datarows = mysqli_fetch_array($modal);
?>

<style type="text/css">
    .dota {
        border: 13px #eee solid;
        width: 100%;
        height: 100%;
        max-height: 1000px;
        min-height: 600px;
    }
</style>
<table class="dota" background="../../asset/certificate/Screenshot 2022-09-16 084108.png" style="background-size: 100%;background-repeat: no-repeat;" border="1">


    <tr>
        <td style="text-align: center;font-size: 27px;font-weight: bold;padding-top: 15px;">
            <?php echo $datarows['Full_Name']; ?> (<?php echo $datarows['emp_no']; ?>)<br><br>
            <?php echo $datarows['course_name']; ?><br>
            <span style="font-size: 11px;">Diselenggarakan oleh <?php echo $datarows['providername']; ?></span><br>
            <div style="font-size: 11px;padding-top: -9px;margin-top: -6px;font-weight: initial;font-style: italic;">(Held by <?php echo $datarows['providername']; ?> )</div>
            <span style="font-size: 11px;">Pada Tanggal <?php echo $datarows['c_startdate']; ?></span><br>
            <div style="font-size: 11px;padding-top: -9px;margin-top: -6px;font-weight: initial;font-style: italic;">(On The <?php echo $datarows['c_startdate']; ?>)</div>
            <span style="font-size: 11px;">Tangerang, 11 Juli 2022</span><br>
            <div style="font-size: 11px;padding-top: -9px;margin-top: -6px;font-weight: initial;font-style: italic;">(Tangerang, 11 th July 2022)</div>
        </td>
    </tr>

</table>