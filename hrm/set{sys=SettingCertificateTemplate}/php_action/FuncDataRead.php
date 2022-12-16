<?php
    require_once '../../../application/config.php';

    $output = array('data' => array());


    $get_data_master_venue = "SELECT * FROM ttamcertification_template";

    $query = mysqli_query($connect, $get_data_master_venue);

    $number = 1;
    while ($row = mysqli_fetch_assoc($query)) {

        $button_edit = '<a type="button" href="" nowrap="nowrap" data-toggle="modal" data-target="#UpdateForm" data-backdrop="static" onclick="updateCertificate(`' . $row['certificate_code'] . '`)"> ' . $row['certificate_code'] . '</a>';
        
        $button_delete = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#FormDisplayDelete" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="deleteCertificate(`'.$row['certificate_code'].'`)"> <input type="image" src="../../asset/dist/img/ios7-close-outline.png" title="delete" width="22px"/></a>';

        $output['data'][] = array(
            $number,
            $button_edit,
            $row['certificate_title_id'],
            $button_delete
        );

        $number++;
    }

    // database connection close
    $connect->close();
    echo json_encode($output);

    // KASIH KUTIP TUH DI NIP