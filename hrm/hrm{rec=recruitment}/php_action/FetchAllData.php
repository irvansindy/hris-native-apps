<?php
    error_reporting(0);
    date_default_timezone_set('Asia/Jakarta');
	include "../../../application/session/sessionlv2.php";
	require_once '../../../application/config.php';

    // response json
    $limit_fetch = $_GET['limit_fetch'];
    $offset = $_GET['offset'];
    $search_city = $_GET['search_city'];
    $search_education = $_GET['search_education'];
    $search_expected_salary = $_GET['search_expected_salary'];
    $search_gender = $_GET['search_gender'];
    $search_religion = $_GET['search_religion'];
    $search_status = $_GET['search_status'];
    $ordering = $_GET['ordering'];

    $query_fetch_data = "SELECT
	a.id_applicant,
    a.userid,
    a.id_vacancy,
    DATE_FORMAT(a.applied_at, '%d-%M-%Y') AS applied_time,
    a.receive_at,
    a.status,
    b.full_name,
    b.gender,
    b.religion,
    b.photo,
    b.phone,
    b.address,
    e.city_name,
    f.state_name,
    c.institutionName,
    c.degree,
    c.major,
    d.vacancy_name,
    g.status_name
    FROM employer_applicant a
    LEFT JOIN teodempersonal b
        ON a.userid = b.userid
    LEFT JOIN usereducation c
        ON a.userid = c.userid
    LEFT JOIN company_vacancy d
        ON a.id_vacancy = d.id_vacancy
    LEFT JOIN tgemcity e
        ON b.city_id = e.city_id
    LEFT JOIN tgemstate f
        ON b.state_id = f.state_id
    LEFT JOIN application_status g
        ON a.status = g.id
        WHERE a.applied_at BETWEEN (CURDATE() - INTERVAL 90 DAY) AND CURDATE()
        ";

    if (!empty($search_city)) {
        $query_fetch_data .= "AND e.city_name LIKE '%$search_city%' ";
    }

    if (!empty($search_education)) {
        $query_fetch_data .= "AND c.major LIKE '%$search_education%' ";
    }

    // if (!empty($search_expected_salary)) {
    //     $query_fetch_data .= "";
    // }

    if (!empty($search_gender)) {
        $query_fetch_data .= "AND b.gender LIKE '%$gender%' ";
    }

    if (!empty($search_religion)) {
        $query_fetch_data .= "AND b.religion LIKE '%$search_religion%' ";
    }

    if (!empty($search_status)) {
        $query_fetch_data .= "AND g.status_name LIKE '%$search_status%' ";
    }

    $query_fetch_data .= "GROUP BY a.id_applicant ";

    if (!empty($ordering)) {
        $query_fetch_data .= " ORDER BY a.status $ordering ";
    } else {
        $query_fetch_data .= " ORDER BY applied_time DESC ";
    }
    
    $query_fetch_data .= "LIMIT " . $limit_fetch . " OFFSET " . $offset;

    // print_r($query_fetch_data);

    $result = mysqli_fetch_all(mysqli_query($connect, $query_fetch_data), MYSQLI_ASSOC);

    $connect->close();
    header('Content-Type: application/json');
    echo json_encode($result);