<head>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css">


    <style>
        :root {

            --bs-success-rgb: 71, 222, 152 !important;

        }


        html,


        .btn-info.text-light:hover,

        .btn-info.text-light:focus {

            background: #000;

        }

        table,
        tbody,
        td,
        tfoot,
        th,
        thead,
        tr {

            border-color: #ededed !important;

            border-style: solid;

            border-width: 1px !important;

        }

        .title {

            font-size: 30px;

        }
    </style>

</head>

<body class="bg-light">

    <?php

    require_once('db-connect.php');

    $schedules = $conn->query("SELECT * FROM `schedule_list`");

    $sched_res = [];

    foreach ($schedules->fetch_all(MYSQLI_ASSOC) as $row) {

        $row['sdate'] = date("F d, Y h:i A", strtotime($row['start_datetime']));

        $row['edate'] = date("F d, Y h:i A", strtotime($row['end_datetime']));

        $sched_res[$row['id']] = $row;
    }

    if (isset($conn)) $conn->close();

    ?>




    <div class="container py-5" id="page-container">

        <div class="row">

            <div class="col-md-12">

                <div id="calendar"></div>

            </div>
        </div>

    </div>

    <!-- Event Details Modal -->

    <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content rounded-0">

                <div class="modal-header rounded-0">

                    <h5 class="modal-title">Schedule Details</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <div class="modal-body rounded-0">

                    <div class="container-fluid">

                        <dl>

                            <dt class="text-muted">Title</dt>

                            <dd id="title" class="fw-bold fs-4"></dd>

                            <dt class="text-muted">Description</dt>

                            <dd id="description" class=""></dd>

                            <dt class="text-muted">Start</dt>

                            <dd id="start" class=""></dd>

                            <dt class="text-muted">End</dt>

                            <dd id="end" class=""></dd>

                        </dl>
                    </div>
                </div>

                <div class="modal-footer rounded-0">

                    <div class="text-end">

                        <button type="button" class="btn btn-primary btn-sm rounded-0" id="edit" data-id="">Edit</button>

                        <button type="button" class="btn btn-danger btn-sm rounded-0" id="delete" data-id="">Delete</button>

                        <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Close</button>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>

    <script src="script.js"></script>

    <script>
        var scheds = $.parseJSON('<?= json_encode($sched_res) ?>')
    </script>

</body>