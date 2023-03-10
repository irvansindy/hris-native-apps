<?php
    require_once '../../../application/config.php';
    !empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
    if ($getdata == 0) {
        include "../../../application/session/sessionlv2.php";
    } else {
        include "../../../application/session/mobile.session.php";
    }

    // include "../../../model/ta/GMOndutyReqSearchGen.php";
    // include "../../../model/ta/GMOndutyReqList.php";

    $dataOnDutyCancel = ['data' => []];