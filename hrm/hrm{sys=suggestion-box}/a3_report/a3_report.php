<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A3 Report</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- gantt chart -->
    <script src="https://cdn.jsdelivr.net/npm/frappe-gantt@0.6.1/dist/frappe-gantt.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/frappe-gantt@0.6.1/dist/frappe-gantt.min.css" rel="stylesheet">

    <style>
        @page { size: landscape; }
        
        table.table-bordered {
            border: 1px solid black;
            margin-top: 20px;
        }

        table.table-bordered>thead>tr>th {
            border: 1px solid black;
        }

        table.table-bordered>tbody>tr>td {
            border: 1px solid black;
        }

        .section-2 {
            margin-bottom: 200px;
        }

        .section-3 {
            margin-bottom: 200px;
        }

        .section-4 {
            margin-bottom: 200px;
        }

        .section-5 {
            margin-bottom: 200px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <h2 class="d-flex justify-content-center my-md-4">A3 Report</h2>
        <div class="mt-md-4">
            <p>Nama dan NIK : <?php echo $result_master_data['Full_Name']. ' - ' .$result_master_data['emp_no'] ?></p>
            <p>Departemen :</p>
            <p>Judul : <?php echo $result_master_data['suggestion_title']?></p>
        </div>
        <div>
            <table class="table table-responsive table-bordered">
                <tr>
                    <td>
                        <p>1. Identifikasi Masalah</p>
                        <p>
                            <?php echo $result_master_data['problem_identification'] ?>
                        </p>
                    </td>
                    <td>
                        <p>5. Merencanakan Perbaikan</p>
                        <div class="section-5">
                            <svg id="gantt"></svg>
                        </div>
                        <p>
                            Latar Belakang Pemilihan Alternatif Solusi
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>2. Latar Belakang Masalah</p>
                        <div class="section-2">
                            <?php echo $result_master_data['problem_background'] ?>
                        </div>
                    </td>
                    <td>
                        <p>6. Melaksanakan Perbaikan</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>3. Menetapkan Target</p>
                        <div class="section-3">
                            <?php echo $result_master_data['target_specify'] ?>
                        </div>
                    </td>
                    <td>
                        <p>
                            7. Monitoring dan Evaluasi Hasil
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>4. Identifikasi Akar Masalah</p>
                        <div class="section-4">
                            <img src="<?php echo 'hrstudio.presfst/'.$result_master_data['diagram'] ?>" alt="your image"
                                width="200px" height="200px">
                        </div>
                    </td>
                    <td>
                        <p>
                            8. Follow up & Standarisasi
                        </p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
</script>

<script>
    var tasks = [{
        id: 'Task 1',
        name: 'Redesign website',
        start: '2016-12-28',
        end: '2016-12-31',
        progress: 20,
        dependencies: 'Task 2, Task 3'
    }]
    var gantt = new Gantt("#gantt", tasks, {
        header_height: 50,
        column_width: 5,
        step: 24,
        view_modes: ['Quarter Day', 'Half Day', 'Day', 'Week', 'Month'],
        bar_height: 20,
        bar_corner_radius: 3,
        arrow_curve: 5,
        padding: 18,
        view_mode: 'Week',
        date_format: 'YYYY-MM-DD',
        language: 'en', // or 'es', 'it', 'ru', 'ptBr', 'fr', 'tr', 'zh', 'de', 'hu'
        custom_popup_html: null
    });
</script>

</html>