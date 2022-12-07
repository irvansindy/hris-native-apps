<?php
    require_once '../../../application/config.php';

    $output = array('data' => array());


    $get_data_master_venue = "SELECT * FROM trnmvenue";

    $query = mysqli_query($connect, $get_data_master_venue);

    $number = 1;
    while ($row = mysqli_fetch_assoc($query)) {

        $prn = '<a type="button" href="" nowrap="nowrap" data-toggle="modal" data-target="#CreateForm" data-backdrop="static" onclick="updateVenue(`' . $row['venue_code'] . '`)"> ' . $row['venue_code'] . '</a>';

        $output['data'][] = array(
            $number,
            $prn,
            $row['venue_name'],
            $row['venue_type'],
            $row['venue_phone'],
            $row['venue_fax']
        );

        $number++;
    }

    // database connection close
    $connect->close();
    echo json_encode($output);

    // KASIH KUTIP TUH DI NIP