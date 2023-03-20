<?php 
require_once '../../../application/config.php';

$code = $_POST['venue_code'];

// get data master setting venue
$getDataMaster = "SELECT 
a.venue_code,
a.venue_name,
a.venue_type,
a.venue_address,
a.country_id,
b.country_name,
a.state_id,
c.state_name,
a.city_id,
d.city_name,
a.venue_zipcode,
a.venue_phone,
a.venue_fax,
a.remark
FROM trnmvenue a
LEFT JOIN hrmcountry b
    ON a.country_id =  b.country_id
LEFT JOIN hrmstate c
    ON a.state_id = c.state_id
LEFT JOIN hrmcity d
    ON a.city_id = d.city_id
WHERE a.venue_code = '$code'";
$queryMaster = mysqli_query($connect, $getDataMaster);
$resultMaster = mysqli_fetch_assoc($queryMaster);

// get data detail setting venue
$queryDataDetail = "SELECT * FROM trndvenue WHERE venue_code = '$code'";
$exeQueryDataDetail = mysqli_query($connect, $queryDataDetail);
$resultDataDetail = mysqli_fetch_all($exeQueryDataDetail, MYSQLI_ASSOC);

// get data all country
$queryCountry = "SELECT country_id, country_name FROM hrmcountry ORDER BY country_name ASC";
$exeQueryCountry = mysqli_query($connect, $queryCountry);
$resultCountry = mysqli_fetch_all($exeQueryCountry, MYSQLI_ASSOC);
// $resultCountry = mysqli_fetch_assoc($exeQueryCountry);

if ($resultMaster == true && $resultDataDetail == true) {
    http_response_code(200);
    $dataResults = [
        'messages' => 'Success to load data',
        'master' => $resultMaster,
        'detail' => $resultDataDetail,
        'country' => $resultCountry
    ];
} else {
    http_response_code(400);
    $dataResults = [
        'messages' => 'Failed to load data',
        NULL
    ];
}


$connect->close();
header('Content-Type: application/json');
echo json_encode($dataResults);