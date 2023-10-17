<?php
    error_reporting(0);
    date_default_timezone_set('Asia/Jakarta');
	include "../../../application/session/sessionlv2.php";
	require_once '../../../application/config.php';

    // parameter mandatory
    $vacancy = $_GET['vacancy'];
    $user = $_GET['user'];
    $status_code = $_GET['status_code'];
    $id_applicant = $_GET['id_applicant'];
    
    // get data user applicant
    $query_fetch_user = "SELECT 
        a.userid,
        a.full_name,
        a.email,
        a.gender,
        a.phone,
        a.birthplace,
        -- a.birthdate,
        DATE_FORMAT(a.birthdate, '%d %b %Y') AS birthdate,
        a.maritalstatus,
        a.address,
        a.religion,
        a.created_at,
        b.city_name,
        c.state_name
    FROM teodempersonal a
    LEFT JOIN tgemcity b
        ON a.city_id = b.city_id
    LEFT JOIN tgemstate c
        ON a.state_id = b.state_id
    WHERE userid = '$user' LIMIT 1";
    $result_user = mysqli_fetch_all(mysqli_query($connect, $query_fetch_user), MYSQLI_ASSOC);

    // get data experience
    $query_fetch_experience = "SELECT 
            a.id,
            a.userid,
            a.companyName AS company_name,
            a.companyAddress AS company_address,
            DATE_FORMAT(a.yosStart, '%d %b %Y') AS start_date,
            DATE_FORMAT(a.yosEnd, '%d %b %Y') AS end_date,
            a.posStart AS start_position,
            a.posEnd AS end_position,
            a.jobDesc AS job_desc,
            a.project,
            a.salaryStart AS salary_entry,
            a.salaryEnd AS salary_last,
            a.benefit,
            a.leavingReason AS reason_for_leaving
        FROM userexperience a
            WHERE a.userid = '$user'
            ORDER BY end_date DESC";
    $result_experience = mysqli_fetch_all(mysqli_query($connect, $query_fetch_experience), MYSQLI_ASSOC);

    // get data education
    $query_fetch_education = "SELECT
        a.id,
        a.userid,
        a.institutionName AS institution_name,
        a.degree,
        a.major,
        DATE_FORMAT(a.startYear, '%Y') AS start_year,
        DATE_FORMAT(a.endYear, '%Y') AS end_year,
        a.achievement
    FROM usereducation a
        WHERE a.userid = '$user'
        ORDER BY end_year DESC";
    $result_education = mysqli_fetch_all(mysqli_query($connect, $query_fetch_education), MYSQLI_ASSOC);

    // get data skill
    $query_fetch_skill = "SELECT
        a.id,
        a.userid,
        a.skillName AS skill_name,
        a.skillCategory AS skill_category,
        a.skillValue AS skill_value,
        a.skillFrom AS skill_from
    FROM userskill a
        WHERE a.userid = '$user'
        ORDER BY id DESC";
    $result_skill = mysqli_fetch_all(mysqli_query($connect, $query_fetch_skill), MYSQLI_ASSOC);

    // get data training achievement
    $query_fetch_training_achievement = "SELECT
        a.id,
        a.userid,
        a.trachName AS training_name,
        a.trachOrganizer AS training_organizer,
        a.trachCategory AS training_category,
        a.trachDetail AS training_detail,
        DATE_FORMAT(a.trachStart, '%d %b %Y') AS training_start,
        DATE_FORMAT(a.trachEnd, '%d %b %Y') AS training_end
    FROM userTrainingAchievement a
        WHERE a.userid = '$user'
        ORDER BY training_end DESC";
    $result_training_achievement = mysqli_fetch_all(mysqli_query($connect, $query_fetch_training_achievement), MYSQLI_ASSOC);

    // get data family
    $query_fetch_family = "SELECT
        a.id,
        a.userid,
        a.familyName AS name,
        a.familyRelation AS relation,
        a.age,
        a.occupation,
        a.status
    FROM userfamily a
        WHERE a.userid = '$user'
        ORDER BY id DESC";
    $result_family = mysqli_fetch_all(mysqli_query($connect, $query_fetch_family), MYSQLI_ASSOC);

    // get status applicant
    // $query_fetch_status = "SELECT * FROM application_status ORDER BY id ASC";
    $query_fetch_status = "SELECT 
        a.id,
        a.status_name,
        (SELECT 'active' FROM employer_applicant_detail ead 
        WHERE ead.application_status_id = a.id AND ead.employer_applicant_id = '$id_applicant')
        AS active FROM application_status a";
    $result_status = mysqli_fetch_all(mysqli_query($connect, $query_fetch_status), MYSQLI_ASSOC);

    // get current status
    $query_fetch_current_status = "SELECT * FROM application_status WHERE id >= '$status_code' ORDER BY id ASC";
    $result_current_status = mysqli_fetch_all(mysqli_query($connect, $query_fetch_current_status), MYSQLI_ASSOC);

    // get employee applicant detail (for log stepper)
    $query_fetch_employer_applicant_detail = "SELECT
        a.id,
        a.employer_applicant_id,
        a.application_status_id,
        b.status,
        b.id_applicant,
        c.status_name
    FROM
    employer_applicant_detail a
    INNER JOIN employer_applicant b
        ON a.employer_applicant_id = b.id_applicant
    INNER JOIN application_status c
        ON c.id = a.application_status_id
        WHERE b.id_applicant = '$id_applicant'
        ORDER BY a.created_at ASC";
    
    $result_employer_applicant_detail = mysqli_fetch_all(mysqli_query($connect, $query_fetch_employer_applicant_detail), MYSQLI_ASSOC);

    $response_json = [
        $result_user, // index key 0
        $result_experience, // index key 1
        $result_education, // index key 2
        $result_skill, // index key 3
        $result_training_achievement, // index key 4
        $result_family, // index key 5
        $result_status, // index key 6
        $result_current_status, // index key 7
        $result_employer_applicant_detail, // index key 8
    ];

    $connect->close();
    header('Content-Type: application/json');
	echo json_encode($response_json);