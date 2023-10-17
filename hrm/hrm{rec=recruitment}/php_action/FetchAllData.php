<?php
    error_reporting(0);
    date_default_timezone_set('Asia/Jakarta');
	include "../../../application/session/sessionlv2.php";
	require_once '../../../application/config.php';

    // response json
    $limit_fetch = $_GET['limit_fetch'];
    $offset = $_GET['offset'];

    $query_fetch_data = "SELECT
	a.id_applicant,
    a.userid,
    a.id_vacancy,
    DATE_FORMAT(a.applied_at, '%d-%M-%Y') AS applied_time,
    a.receive_at,
    a.status,
    b.full_name,
    b.gender,
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
    GROUP BY a.id_applicant
    -- GROUP BY a.userid 
    -- and a.id_vacancy
    ORDER BY applied_time DESC
    LIMIT $limit_fetch
    OFFSET $offset
        ";

    $result = mysqli_fetch_all(mysqli_query($connect, $query_fetch_data), MYSQLI_ASSOC);

    $connect->close();
    header('Content-Type: application/json');
    echo json_encode($result);