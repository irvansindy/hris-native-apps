<?php 
require_once '../../../application/config.php';

$code = $_POST['provider_code'];

// $getData = "SELECT * FROM trnprovider WHERE provider_code = '$code'";
$getData = "SELECT 
a.provider_code,
a.provider_name,
a.provider_type,
a.pic,
a.country_id,
b.country_name,
a.state_id,
c.state_name,
a.city_id,
d.city_name,
a.zipcode,
a.phone,
a.fax,
a.email,
a.web_address,
a.speciality,
a.address,
a.remark
FROM trnprovider a
LEFT JOIN hrmcountry b
    ON a.country_id =  b.country_id
LEFT JOIN hrmstate c
    ON a.state_id = c.state_id
LEFT JOIN hrmcity d
    ON a.city_id = d.city_id
WHERE a.provider_code = '$code'";

$query = mysqli_query($connect, $getData);
$result = mysqli_fetch_assoc($query);

// get data all country
$queryCountry = "SELECT country_id, country_name FROM hrmcountry ORDER BY country_name ASC";
$exeQueryCountry = mysqli_query($connect, $queryCountry);
$resultCountry = mysqli_fetch_all($exeQueryCountry, MYSQLI_ASSOC);

if($result == true) {
    http_response_code(200);
    $dataResult = [
        'messages' => 'Success to load data',
        'data' => [
            $result, //0
            $resultCountry //1
        ]
    ];
} else {
    http_response_code(400);
    $dataResult = [
        'messages' => 'Failed to load data',
        'data' => NULL
    ];
}

$connect->close();
header('Content-Type: application/json');
echo json_encode($dataResult);

