
-- user
SELECT 
        a.userid,
        a.full_name,
        a.email,
        a.gender,
        a.phone,
        a.birthplace,
        a.birthdate,
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
        ON a.state_id = b.state_id;


-- experience
SELECT 
        a.id,
        a.userid,
        a.companyName AS company_name,
        a.companyAddress AS company_address,
        a.yosStart AS start_date,
        a.yosEnd AS end_date,
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
        WHERE a.userid = 'user-6487ea517cd93'
        ORDER BY end_date DESC;

-- First - End of Salary : ${(response[1][i].salary_entry / 1000).toFixed(3) + ' - ' + (response[1][i].salary_last / 1000).toFixed(3)}
-- First - End of Salary : ${response[1][i].salary_entry.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + ' - ' + response[1][i].salary_last.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")}

-- education
SELECT
    a.id,
    a.userid,
    a.institutionName AS institution_name,
    a.degree,
    a.major,
    a.startYear AS start_year,
    a.endYear AS end_year,
    a.achievement
FROM usereducation a
    WHERE a.userid = ''
    ORDER BY end_year DESC

-- skill
SELECT
    a.id,
    a.userid,
    a.skillName AS skill_name,
    a.skillCategory AS skill_category,
    a.skillValue AS skill_value,
    a.skillFrom AS skill_from
FROM userskill a
    WHERE a.userid = "user-6487ea517cd93"
    ORDER BY id DESC

-- data_list_training_achievement
SELECT
    a.id,
    a.userid,
    a.trachName AS training_name,
    a.trachOrganizer AS training_organizer,
    a.trachCategory AS training_category,
    a.trachDetail AS training_detail,
    DATE_FORMAT(a.trachStart, '%d %b %Y') AS training_start,
    DATE_FORMAT(a.trachEnd, '%d %b %Y') AS training_end
FROM userTrainingAchievement a
    WHERE a.userid = "user-6487ea517cd93"
    ORDER BY training_end DESC

-- data family
SELECT
    a.id,
    a.userid,
    a.familyName AS name,
    a.familyRelation AS relation,
    a.age,
    a.occupation,
    a.status
    FROM userfamily a



filter parameter :
    1. lokasi kota
    2. pendidikan applicant
    3. expected salary (soon)
    4. gender
    5. religion
    6. status


CREATE TABLE application_status (
    id integer(10) auto_increment NOT NULL,
    status_name varchar(50) NOT NULL,
)

CREATE TABLE employer_applicant_detail (
    id integer(10) auto_increment NOT NULL,
    employer_applicant_id integer(10) NOT NULL,
    application_status_id integer(10) NOT NULL,
    created_at timestamp,
    updated_at timestamp,
)