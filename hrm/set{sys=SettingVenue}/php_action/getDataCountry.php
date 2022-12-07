<?php
    require_once '../../../application/config.php';
    
    // $countryId = $_POST['provider_country'];

    $getDataCity = "SELECT * FROM hrmcountry";

    $query = mysqli_query($connect, $getDataCity);
    $resultCOuntry = mysqli_fetch_assoc($query);
    $connect->close();

    echo json_decode($resultCOuntry);