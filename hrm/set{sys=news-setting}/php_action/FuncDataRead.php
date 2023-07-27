<?php
    require_once '../../../application/config.php';

    $output = array('data' => array());


    $get_data_berita = "SELECT
        a.* ,
        CASE
            WHEN a.aktif = 'Y' THEN 'tick.png'
            ELSE 'inactive.png'
        END AS active_status,
        CASE
            WHEN a.headline = 'Y' THEN 'tick.png'
            ELSE 'inactive.png'
        END AS headline_status
    FROM berita a";

    $query = mysqli_query($connect, $get_data_berita);

    $number = 1;
    while ($row = mysqli_fetch_assoc($query)) {

        $button_edit = '<a type="button" href="" nowrap="nowrap" data-toggle="modal" data-target="#UpdateForm" data-backdrop="static" onclick="UpdateNews(`' . $row['id_berita'] . '`)"> ' . $row['judul'] . '</a>';
        
        $button_delete = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#FormDisplayDelete" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="deleteCertificate(`'.$row['id_berita'].'`)"> <input type="image" src="../../asset/dist/img/ios7-close-outline.png" title="delete" width="22px"/></a>';

        $output['data'][] = array(
            $number,
            $button_edit,
            $row['sub_judul'],
            "<img src='../../asset/dist/img/$row[active_status]'/>",
            "<img src='../../asset/dist/img/$row[headline_status]'/>",
            // $button_delete
        );

        $number++;
    }

    // database connection close
    $connect->close();
    echo json_encode($output);

    // KASIH KUTIP TUH DI NIP