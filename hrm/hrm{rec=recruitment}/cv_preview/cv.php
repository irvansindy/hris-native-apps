<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        .info-item i {
            color: #259dd4;
        }

        .header i {
            color: #259dd4;
        }

        .hr {
            border-top: 2px dashed #259dd4;
        }

        .timeline-work,
        .text-skill {
            font-size: small;
        }

        .progress {
            height: 20px;
        }
    </style>
</head>

<body style="@page {
	size: A4;
}">
    <div class="container-fluid">
        <section>
            <div class="container-fluid ml-lg-4 my-5">
                <h1 style="font-weight: bolder;">
                    <?php echo $result_user[0]['full_name'] ?>
                </h1>
                <div class="info-item">
                    <i class="fa-solid fa-house-user fa-lg"></i>
                    <span>
                        <?php echo $result_user[0]['address'] . ', ' . $result_user[0]['city_name'] . ', ' . $result_user[0]['state_name'] ?>
                    </span>
                </div>
                <div class="info-item">
                    <i class="fa-solid fa-square-envelope fa-lg"></i>
                    <span class="info-text">
                        <?php echo $result_user[0]['email'] ?>
                    </span>
                </div>
                <div class="info-item">
                    <i class="fa-solid fa-square-phone-flip fa-lg"></i>
                    <span class="info-text">
                        <?php echo $result_user[0]['phone'] ?>
                    </span>
                </div>
            </div>
        </section>
        <hr class="hr" />
        <section>
            <div class="row ml-lg-4 mt-5">
                <div class="col-lg-6">
                    <section class="experience mb-5">
                        <div class="header">
                            <i class="fa-solid fa-briefcase fa-xl"></i>
                            <span class="font-weight-bold">Experiences</span>
                        </div>
                        <div class="list-inline mt-2">
                            <div>
                                <?php 
                                    for ($i=0; $i < count($result_experience); $i++) { 
                                    ?>
                                <p>
                                    <strong
                                        style="font-weight: bold;"><?php echo $result_experience[$i]['company_name']; ?></strong>
                                    | <span
                                        style="font-weight: light;"><?php echo $result_experience[$i]['start_date'] . ' - ' . $result_experience[$i]['end_date']; ?></span>
                                    <br>
                                    <?php echo $result_experience[$i]['company_address']; ?>
                                    <br>
                                    Start Position : <?php echo $result_experience[$i]['start_position']; ?>
                                    <br>
                                    End Position : <?php echo $result_experience[$i]['end_position']; ?>
                                    <br>
                                    First - End of Salary :
                                    Rp.<?php echo number_format($result_experience[$i]['salary_entry']); ?> -
                                    Rp.<?php echo number_format($result_experience[$i]['salary_last']); ?>
                                    <br>
                                    Job Desc:
                                    <?php echo $result_experience[$i]['job_desc']; ?>
                                    <br>
                                    Project:
                                    <?php echo $result_experience[$i]['project']; ?>
                                </p>
                                <?php }
                                ?>
                            </div>
                        </div>
                    </section>
                    <section class="education mb-5">
                        <div class="header">
                            <i class="fa-solid fa-graduation-cap fa-xl"></i>
                            <span class="font-weight-bold">Educations</span>
                        </div>
                        <div class="list-inline mt-2">
                            <?php for ($i=0; $i < count($result_education); $i++) { 
                                ?>
                            <p>
                                <strong><?php echo $result_education[$i]['institution_name']; ?></strong>
                                <br>
                                <?php echo $result_education[$i]['degree']; ?> -
                                <?php echo $result_education[$i]['major']; ?> |
                                <?php echo $result_education[$i]['start_year']; ?> -
                                <?php echo $result_education[$i]['end_year']; ?>
                                <br>
                                Achievement : <?php echo $result_education[$i]['achievement']; ?>
                            </p>
                            <?php
                            } ?>
                        </div>
                    </section>
                </div>
                <div class="col-lg-6">
                    <section class="skill mb-5">
                        <div class="header">
                            <i class="fa-solid fa-book fa-xl"></i>
                            <span class="font-weight-bold">Skills</span>
                        </div>
                        <div class="list-inline mt-2">
                            <div class="row">
                                <div class="col-6 mt-2">
                                    <?php 
                                    for ($i=0; $i < count($result_skill); $i++) { 
                                ?>
                                    <div class="progress mb-3">
                                        <div class="progress-bar bg-info py-2" role="progressbar"
                                            style="width: <?php echo $result_skill[$i]['skill_value'] * 10; ?>%"
                                            aria-valuenow="<?php echo $result_skill[$i]['skill_value'] * 10; ?>"
                                            aria-valuemin="0" aria-valuemax="100">
                                            <strong>
                                                <?php echo $result_skill[$i]['skill_name']; ?> -
                                                <?php echo $result_skill[$i]['skill_value'] * 10; ?>%
                                            </strong>
                                        </div>
                                    </div>
                                    <?php    }
                                ?>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="training-achievement mb-5">
                        <div class="header">
                            <i class="fa-solid fa-award fa-xl"></i>
                            <span class="font-weight-bold">Training & Achievements</span>
                        </div>
                        <div class="list-inline mt-2">
                            <?php
                                for ($i=0; $i < count($result_training_achievement); $i++) { 
                                    ?>
                            <p>
                                <strong><?php echo $result_training_achievement[$i]['training_name'] ?></strong>
                                <br>
                                <?php echo $result_training_achievement[$i]['training_category'] ?> | <?php echo $result_training_achievement[$i]['training_start'] ?> - <?php echo $result_training_achievement[0]['training_end'] ?>
                                <br>
                            </p>
                            <?php }
                            ?>

                        </div>
                    </section>
                </div>
            </div>
        </section>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
</script>

</html>