<?php 
include "../../application/session/session.php";
$type_report = $_POST['type_report'];


?>
  <script src="vendor/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script src="vendor/highcharts.js"></script>
<script src="vendor/data.js"></script>
<script src="vendor/drilldown.js"></script>
<script src="vendor/exporting.js"></script>
<script src="vendor/export-data.js"></script>
<script src="vendor/accessibility.js"></script>


<!-- Multi Select -->
<script src="multisel/jquery.min.js"></script>   
<link rel="stylesheet" href="multisel/bootstrap.min.css" />
<script src="multisel/bootstrap.min.js"></script>
<script src="multisel/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="multisel/bootstrap-multiselect.css" />

<script>
$(document).ready(function(){
 $('#worklocation').multiselect({
  nonSelectedText: 'Select Worklocation',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'220px'
 });
});
$(document).ready(function(){
 $('#cost').multiselect({
  nonSelectedText: 'Select Cost code',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'220px'
 });
});
$(document).ready(function(){
 $('#status').multiselect({
  nonSelectedText: 'Select Emp Status',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'220px'
 });
});
</script>

<style>
.highcharts-figure,
.highcharts-data-table table {
    min-width: 310px;
    max-width: 800px;
    margin: 1em auto;
}

#container {
    height: 400px;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}
</style>

<div style="padding-left:5px; padding-right:5px">
<table width="100%">
    <tr valign="center">
        <td width="8%">
            <table width="100%">
                <tr>
                    <td>
                        <!--<button id="print">
                            <img src="vendor/print.png" alt="">
                        </button>-->
                    </td>
                </tr>
            </table>
        </td>
        <td style="text-align:center">
            <p style="font-weight:bold; font-size:16pt">GENERAL HRIS DASHBOARD INFORMATION</p>
        </td>
        <td width="8%"></td>
    </tr>
</table>

<form method="post" id="" action="view_report_srch.php" enctype="multipart/form-data">
<table width="100%">
    <tr valign="center">
        <td width="15%" >
            <table>
                <tr>
                    <td style="background-color:#ffcc33; font-weight:bold; text-align:center; vertical-align:top; font-size:9pt">WORK LOCATION</td>
                </tr>
                <tr>
                    <td>
                        <select id="worklocation" name="worklocation[]" multiple class="form-control" >
                            <?php
                            $sql_work_location = mysqli_query($connect, "SELECT 
                            a.plant
                            FROM dashboard_gen a 
                            GROUP BY a.plant");
                            while($data_work_location = mysqli_fetch_assoc($sql_work_location)){
                            ?>
                            <option value="<?php echo $data_work_location['plant']; ?>"><?php echo $data_work_location['plant']; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
            </table>
        </td>
        <td width="15%" >
            <table>
                <tr>
                    <td style="background-color:#ffcc33; font-weight:bold; text-align:center; vertical-align:top; font-size:9pt">COST CENTER</td>
                </tr>
                <tr>
                    <td>
                        <select id="cost" name="cost[]" multiple class="form-control" >
                            <?php 
                            $sql_cost_center = mysqli_query($connect, "SELECT 
                            a.cost_center
                            FROM dashboard_gen a 
                            GROUP BY a.cost_center");
                            while($data_cost_center = mysqli_fetch_assoc($sql_cost_center)){
                            ?>
                            <option value="<?php echo $data_cost_center['cost_center']; ?>"><?php echo $data_cost_center['cost_center']; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
            </table>
        </td>
        <td width="15%" >
            <table>
                <tr>
                    <td style="background-color:#ffcc33; font-weight:bold; text-align:center; vertical-align:top; font-size:9pt">STATUS</td>
                </tr>
                <tr>
                    <td>
                        <select id="status" name="status[]" multiple class="form-control" >
                            <option value="active">Active</option>
                            <option value="nonactive">Non Active</option>
                        </select>
                    </td>
                </tr>
            </table>
        </td>
        <td width="5%" style="padding-left:20px"><button class="btn btn-primary btn-sm">Filter</button></td>
        <td width="45%"></td>
        <td width="5%"><a href="#" id="print">
                            <img src="vendor/print.png" alt="">
                            </a></td>
    </tr>
</table>
<!-- <br> -->
<!--<table width="57%">
    <tr>
        <td>
            <table width="100%">
                <tr>
                    <td style="background-color:#41a386; height:30px; font-weight:bold; vertical-align:top; font-size:9pt">
                        <button class="btn btn-primary btn-sm">Filter</button>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>-->
</form>
<br>

<div id="data_print">
<table width="100%">
    <tr>
        <td>
            <table width="100%">
                <tr>
                <td width="25%" style="padding-right:2px">
            <!-- Head count gender -->
            <table width="100%" border="1">
                <tr>
                    <td style="background-color:#ffcc33; font-weight:bold; text-align:center; vertical-align:top; font-size:10pt">PERSENTASE GENDER</td>
                </tr>
                <tr>
                    <td>
                    <figure class="highcharts-figure">
                        <div id="gender"></div>
                    </figure>
                    </td>
                </tr>
            </table>
        </td>
        <td width="25%" style="padding-left:2px; padding-right:2px">
            <!-- Head count per plant -->
            <table width="100%" border="1">
                <tr>
                    <td style="background-color:#ffcc33; font-weight:bold; text-align:center; vertical-align:top; font-size:10pt">HEADCOUNT PER PLANT</td>
                </tr>
                <tr>
                    <td>
                    <figure class="highcharts-figure">
                        <div id="plant"></div>
                    </figure>
                    </td>
                </tr>
            </table>
        </td>
        <td width="25%" style="padding-left:2px; padding-right:2px">
            <!-- Head count per plant -->
            <table width="100%" border="1">
                <tr>
                    <td style="background-color:#ffcc33; font-weight:bold; text-align:center; vertical-align:top; font-size:10pt">TOP 10 - HEADCOUNT PER COST CENTER</td>
                </tr>
                <tr>
                    <td>
                    <figure class="highcharts-figure">
                        <div id="cost_center"></div>
                    </figure>
                    </td>
                </tr>
            </table>
        </td>
        <td width="25%" style="padding-left:2px; padding-right:2px">
            <!-- Head count per plant -->
            <table width="100%" border="1">
                <tr>
                    <td style="background-color:#ffcc33; font-weight:bold; text-align:center; vertical-align:top; font-size:10pt">HEADCOUNT PER GRADE</td>
                </tr>
                <tr>
                    <td>
                    <figure class="highcharts-figure">
                        <div id="grade"></div>
                    </figure>
                    </td>
                </tr>
            </table>
        </td>
                </tr>
            </table>
        </td>
        
    </tr>
        <td style="height:2px"></td>
    <tr>
        <td>
            <table width="100%">
                <tr>
                <td width="25%" style="padding-right:4px; padding-top:0px">
            <table width="100%" border="1">
                <tr>
                    <td style="background-color:#ffcc33; font-weight:bold; text-align:center; vertical-align:top; font-size:10pt">TOP 10 - LOKASI TINGGAL KARYAWAN</td>
                </tr>
                <tr>
                    <td>
                    <figure class="highcharts-figure">
                        <div id="location"></div>
                    </figure>
                    </td>
                </tr>
            </table>
        </td>
        <td style="padding-top:1px;">
            <table width="100%" height="100%">
                <tr height = "50%">
                    <td width="50%" style="padding-right:2px">
                        <table width="100%" border="1">
                            <tr>
                                <td style="background-color:#ffcc33; font-weight:bold; text-align:center; vertical-align:top; font-size:10pt">JUMLAH BERDASARKAN AGAMA</td>
                            </tr>
                            <tr>
                                <td>
                                    <figure class="highcharts-figure" >
                                        <div id="religion"></div>
                                    </figure>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="50%" style="padding-left:2px; padding-right:2px">
                        <table width="100%" border="1">
                            <tr>
                                <td style="background-color:#ffcc33; font-weight:bold; text-align:center; vertical-align:top; font-size:10pt">JUMLAH BERDASARKAN STATUS PERKAWINAN</td>
                            </tr>
                            <tr>
                                <td>
                                    <figure class="highcharts-figure">
                                        <div id="marital"></div>
                                    </figure>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr height = "50%">
                    <tr>
                        <td style="height:2px"></td>
                    </tr>
                <td width="50%" style="padding-right:2px">
                        <table width="100%" border="1">
                            <tr>
                                <td style="background-color:#ffcc33; font-weight:bold; text-align:center; vertical-align:top; font-size:10pt">JUMLAH BERDASARKAN UMUR</td>
                            </tr>
                            <tr>
                                <td>
                                    <figure class="highcharts-figure">
                                        <div id="age"></div>
                                    </figure>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="50%" style="padding-left:2px; padding-right:2px">
                        <table width="100%" border="1">
                            <tr>
                                <td style="background-color:#ffcc33; font-weight:bold; text-align:center; vertical-align:top; font-size:10pt">JUMLAH BERDASARKAN LOS</td>
                            </tr>
                            <tr>
                                <td>
                                    <figure class="highcharts-figure">
                                        <div id="los"></div>
                                    </figure>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</div>

<script>
    $(document).on('click', '#print', function(){
        alert('Masuk');
        window.print();
    });
</script>

<script>
 // HEADCOUNT GENDER ============================================================================================================================
 Highcharts.chart('gender', {
    chart: {
        type: 'column',
        height: 400,
		width: 300,
    },
    title: {
        align: 'left',
        text: ''
    },
    subtitle: {
        align: 'left',
        text: ''
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Total Employee By Gender'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '<span style="color:{point.color}">Total Emp : {point.y}</span><br/><span style="color:{point.color}">Total % : {point.z:.1f}%</span><br/>'
                // format: '<>{point.y:.1f}%'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> of total<br/>'
    },

    series: [
        {
            name: "Employee By Gender",
            colorByPoint: true,
            data: [
                {
                    <?php $data_male= mysqli_fetch_assoc(mysqli_query($connect, "SELECT 
                    COUNT(a.emp_no) AS headcount,
                    ((COUNT(a.emp_no)/(SELECT COUNT(b.emp_no) AS total FROM dashboard_gen b))*100) AS headcountpersent
                    FROM dashboard_gen a
                    WHERE a.gender = 'male'")); ?>
                    name: "Male",
                    y: <?php echo $data_male['headcount']; ?>,
                    z: <?php echo $data_male['headcountpersent']; ?>,
                    drilldown: "Male"
                },
                {
                    <?php $data_female= mysqli_fetch_assoc(mysqli_query($connect, "SELECT 
                    COUNT(a.emp_no) AS headcount,
                    ((COUNT(a.emp_no)/(SELECT COUNT(b.emp_no) AS total FROM dashboard_gen b))*100) AS headcountpersent
                    FROM dashboard_gen a
                    WHERE a.gender = 'female'")); ?>
                    name: "Female",
                    y: <?php echo $data_female['headcount']; ?>,
                    z: <?php echo $data_female['headcountpersent']; ?>,
                    drilldown: "Female"
                }
            ]
        }
    ],
    drilldown: {
        breadcrumbs: {
            position: {
                align: 'right'
            }
        },
        series: [
            {
                name: "Chrome",
                id: "Chrome",
                data: [
                    [
                        "v65.0",
                        0.1
                    ],
                    [
                        "v64.0",
                        1.3
                    ],
                    [
                        "v63.0",
                        53.02
                    ],
                    [
                        "v62.0",
                        1.4
                    ],
                    [
                        "v61.0",
                        0.88
                    ],
                    [
                        "v60.0",
                        0.56
                    ],
                    [
                        "v59.0",
                        0.45
                    ],
                    [
                        "v58.0",
                        0.49
                    ],
                    [
                        "v57.0",
                        0.32
                    ],
                    [
                        "v56.0",
                        0.29
                    ],
                    [
                        "v55.0",
                        0.79
                    ],
                    [
                        "v54.0",
                        0.18
                    ],
                    [
                        "v51.0",
                        0.13
                    ],
                    [
                        "v49.0",
                        2.16
                    ],
                    [
                        "v48.0",
                        0.13
                    ],
                    [
                        "v47.0",
                        0.11
                    ],
                    [
                        "v43.0",
                        0.17
                    ],
                    [
                        "v29.0",
                        0.26
                    ]
                ]
            },
            {
                name: "Firefox",
                id: "Firefox",
                data: [
                    [
                        "v58.0",
                        1.02
                    ],
                    [
                        "v57.0",
                        7.36
                    ],
                    [
                        "v56.0",
                        0.35
                    ],
                    [
                        "v55.0",
                        0.11
                    ],
                    [
                        "v54.0",
                        0.1
                    ],
                    [
                        "v52.0",
                        0.95
                    ],
                    [
                        "v51.0",
                        0.15
                    ],
                    [
                        "v50.0",
                        0.1
                    ],
                    [
                        "v48.0",
                        0.31
                    ],
                    [
                        "v47.0",
                        0.12
                    ]
                ]
            }
        ]
    }
});
</script>

<script>
     // HEADCOUNT PER PLANT ============================================================================================================================
    Highcharts.chart('plant', {
    chart: {
        type: 'bar',
        height: 400,
		width: 300,
    },
    title: {
        text: ''
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: [
            <?php $sql_data_plant = mysqli_query($connect, "SELECT 
            a.plant,
            COUNT(a.emp_no) AS jumlah
            FROM dashboard_gen a
            GROUP BY a.plant");
            while($data_plant = mysqli_fetch_assoc($sql_data_plant)){
            ?>
            '<?php echo $data_plant['plant']; ?>', <?php } ?>],
        title: {
            text: null
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: '',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: ' Headcount'
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor:
            Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: [{
        name: 'Total Employee',
        data: [
            <?php $sql_data_plant = mysqli_query($connect, "SELECT 
            a.plant,
            COUNT(a.emp_no) AS jumlah
            FROM dashboard_gen a
            GROUP BY a.plant");
            while($data_plant = mysqli_fetch_assoc($sql_data_plant)){
            ?>
            <?php echo $data_plant['jumlah']; ?>, <?php } ?>]
    }]
});
</script>

<script>
     // HEADCOUNT COST CENTER ============================================================================================================================
    Highcharts.chart('cost_center', {
    chart: {
        type: 'bar',
        height: 400,
		width: 300,
    },
    title: {
        text: ''
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: [
            <?php $sql_data_cc = mysqli_query($connect, "SELECT 
            a.cost_center,
            COUNT(a.emp_no) AS jumlah
            FROM dashboard_gen a
            GROUP BY a.cost_center
            ORDER BY jumlah DESC
            LIMIT 10");
            while($data_cc = mysqli_fetch_assoc($sql_data_cc)){
            ?>
            '<?php echo $data_cc['cost_center']; ?>', <?php } ?>],
        title: {
            text: null
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: '',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: ' Headcount'
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor:
            Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: [{
        name: 'Total Employee',
        data: [<?php $sql_data_cc = mysqli_query($connect, "SELECT 
            a.cost_center,
            COUNT(a.emp_no) AS jumlah
            FROM dashboard_gen a
            GROUP BY a.cost_center
            ORDER BY jumlah DESC
            LIMIT 10");
            while($data_cc = mysqli_fetch_assoc($sql_data_cc)){
            ?>
            <?php echo $data_cc['jumlah']; ?>, <?php } ?>]
    }]
});
</script>

<script>
     // HEADCOUNT GRADE ============================================================================================================================
    Highcharts.chart('grade', {
    chart: {
        type: 'bar',
        height: 400,
		width: 300,
    },
    title: {
        text: ''
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: [
            <?php $sql_data_grade = mysqli_query($connect, "SELECT 
            a.grade,
            COUNT(a.emp_no) AS jumlah
            FROM dashboard_gen a
            GROUP BY a.grade
            ORDER BY CAST(a.grade AS INTEGER) ASC");
            while($data_grade = mysqli_fetch_assoc($sql_data_grade)){
            ?>
            '<?php echo $data_grade['grade']; ?>', <?php } ?>
        ],
        title: {
            text: null
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: '',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: ' Headcount'
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor:
            Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: [{
        name: 'Total Employee',
        data: [
            <?php $sql_data_grade = mysqli_query($connect, "SELECT 
            a.grade,
            COUNT(a.emp_no) AS jumlah
            FROM dashboard_gen a
            GROUP BY a.grade
            ORDER BY CAST(a.grade AS INTEGER) ASC");
            while($data_grade = mysqli_fetch_assoc($sql_data_grade)){
            ?>
            <?php echo $data_grade['jumlah']; ?>, <?php } ?>
        ]
    }]
});
</script>

<script>
     // HEADCOUNT GRADE ============================================================================================================================
    Highcharts.chart('location', {
    chart: {
        type: 'bar',
        height: 553,
		width: 300,
    },
    title: {
        text: ''
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: [
            <?php $sql_data_kota = mysqli_query($connect, "SELECT 
            a.kota,
            COUNT(a.emp_no) AS jumlah
            FROM dashboard_gen a 
            WHERE a.kota IS NOT NULL
            GROUP BY a.kota
            ORDER BY jumlah DESC
            LIMIT 10");
            while($data_kota = mysqli_fetch_assoc($sql_data_kota)){
            ?>
            '<?php echo $data_kota['kota']; ?>', <?php } ?>
        ],
        title: {
            text: null
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: '',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: ' Headcount'
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor:
            Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: [{
        name: 'Total Employee',
        data: [
            <?php $sql_data_kota = mysqli_query($connect, "SELECT 
            a.kota,
            COUNT(a.emp_no) AS jumlah
            FROM dashboard_gen a 
            WHERE a.kota IS NOT NULL
            GROUP BY a.kota
            ORDER BY jumlah DESC
            LIMIT 10");
            while($data_kota = mysqli_fetch_assoc($sql_data_kota)){
            ?>
            <?php echo $data_kota['jumlah']; ?>, <?php } ?>
        ]
    }]
});
</script>

<script>
    // HEADCOUNT RELIGION ============================================================================================================================
    Highcharts.chart('religion', {
    chart: {
        zoomType: 'xy',
        height: 250
    },
    title: {
        text: ''
    },
    subtitle: {
        text: ''
    },
    xAxis: [{
        categories: [
            <?php $sql_data_religion = mysqli_query($connect, "SELECT 
a.religion,
((COUNT(a.emp_no)/(SELECT COUNT(b.emp_no) FROM dashboard_gen b))*100) AS jumlah 
FROM dashboard_gen a
GROUP BY a.religion
ORDER BY a.religion DESC");
            while($data_religion = mysqli_fetch_assoc($sql_data_religion)){
            ?>
            '<?php echo $data_religion['religion']; ?>', <?php } ?>
        ],
        crosshair: true
    }],
    yAxis: [{ // Primary yAxis
        labels: {
            format: '{value}',
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        },
        title: {
            text: 'Employee by Religion Total',
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        }
    }, { // Secondary yAxis
        title: {
            text: '',
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        },
        labels: {
            format: '{value}',
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        },
        opposite: true
    }],
    tooltip: {
        shared: true
    },
    legend: {
        layout: 'vertical',
        align: 'left',
        x: 120,
        verticalAlign: 'top',
        y: 100,
        floating: true,
        backgroundColor:
            Highcharts.defaultOptions.legend.backgroundColor || // theme
            'rgba(255,255,255,0.25)'
    },
    series: [{
        name: 'Total Employee',
        type: 'column',
        yAxis: 1,
        data: [
            <?php $sql_data_religion = mysqli_query($connect, "SELECT 
a.religion,
COUNT(a.emp_no) AS jumlah 
FROM dashboard_gen a
GROUP BY a.religion
ORDER BY a.religion DESC");
            while($data_religion = mysqli_fetch_assoc($sql_data_religion)){
            ?>
            <?php echo $data_religion['jumlah']; ?>, <?php } ?>
        ],
        tooltip: {
            valueSuffix: ' Headcount'
        }

    }, {
        name: '%',
        type: 'spline',
        data: [
            <?php $sql_data_religion = mysqli_query($connect, "SELECT 
a.religion,
((COUNT(a.emp_no)/(SELECT COUNT(b.emp_no) FROM dashboard_gen b))*100) AS jumlah 
FROM dashboard_gen a
GROUP BY a.religion
ORDER BY a.religion DESC");
            while($data_religion = mysqli_fetch_assoc($sql_data_religion)){
            ?>
            <?php echo $data_religion['jumlah']; ?>, <?php } ?>
        ],
        tooltip: {
            valueSuffix: '%'
        }
    }]
});
</script>

<script>
    // HEADCOUNT MARITAL ============================================================================================================================
    Highcharts.chart('marital', {
    chart: {
        zoomType: 'xy',
        height: 250
    },
    title: {
        text: ''
    },
    subtitle: {
        text: ''
    },
    xAxis: [{
        categories: [
            <?php $sql_data_marital = mysqli_query($connect, "SELECT 
a.marital_status,
COUNT(a.emp_no) AS jumlah
FROM dashboard_gen a
GROUP BY a.marital_status");
            while($data_marital = mysqli_fetch_assoc($sql_data_marital)){
            ?>
            '<?php echo $data_marital['marital_status']; ?>', <?php } ?>
        ],
        crosshair: true
    }],
    yAxis: [{ // Primary yAxis
        labels: {
            format: '{value}',
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        },
        title: {
            text: 'Employee by Marital Status Total',
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        }
    }, { // Secondary yAxis
        title: {
            text: '',
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        },
        labels: {
            format: '{value}',
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        },
        opposite: true
    }],
    tooltip: {
        shared: true
    },
    legend: {
        layout: 'vertical',
        align: 'left',
        x: 120,
        verticalAlign: 'top',
        y: 100,
        floating: true,
        backgroundColor:
            Highcharts.defaultOptions.legend.backgroundColor || // theme
            'rgba(255,255,255,0.25)'
    },
    series: [{
        name: 'Total Employee',
        type: 'column',
        yAxis: 1,
        data: [
            <?php $sql_data_marital = mysqli_query($connect, "SELECT 
a.marital_status,
COUNT(a.emp_no) AS jumlah
FROM dashboard_gen a
GROUP BY a.marital_status");
            while($data_marital = mysqli_fetch_assoc($sql_data_marital)){
            ?>
            <?php echo $data_marital['jumlah']; ?>, <?php } ?>
        ],
        tooltip: {
            valueSuffix: ' Headcount'
        }

    }, {
        name: '%',
        type: 'spline',
        data: [
            <?php $sql_data_marital = mysqli_query($connect, "SELECT 
a.marital_status,
((COUNT(a.emp_no)/(SELECT COUNT(b.emp_no) FROM dashboard_gen b))*100) AS jumlah
FROM dashboard_gen a
GROUP BY a.marital_status");
            while($data_marital = mysqli_fetch_assoc($sql_data_marital)){
            ?>
            <?php echo $data_marital['jumlah']; ?>, <?php } ?>
        ],
        tooltip: {
            valueSuffix: '%'
        }
    }]
});
</script>

<script>
    // HEADCOUNT AGE ============================================================================================================================
    Highcharts.chart('age', {
    chart: {
        zoomType: 'xy',
        height: 250
    },
    title: {
        text: ''
    },
    subtitle: {
        text: ''
    },
    xAxis: [{
        categories: [
            <?php $sql_data_age = mysqli_query($connect, "SELECT 
'0 - 28' AS age
FROM dashboard_gen a
WHERE (a.age >= '0' AND a.age <= '28')
UNION
SELECT
'29 - 38' AS age
FROM dashboard_gen a
WHERE (a.age >= '29' AND a.age <= '38')
UNION
SELECT
'39 - 48' AS age
FROM dashboard_gen a
WHERE (a.age >= '39' AND a.age <= '48')
UNION
SELECT
'49 - 58' AS age
FROM dashboard_gen a
WHERE (a.age >= '49' AND a.age <= '58')
UNION
SELECT
'59 - 68' AS age
FROM dashboard_gen a
WHERE (a.age >= '59' AND a.age <= '68')
UNION
SELECT
'69 - 78' AS age
FROM dashboard_gen a
WHERE (a.age >= '69' AND a.age <= '78')
UNION
SELECT
'79 - Keatas' AS age
FROM dashboard_gen a
WHERE (a.age >= '79')");
            while($data_age = mysqli_fetch_assoc($sql_data_age)){
            ?>
            '<?php echo $data_age['age']; ?>', <?php } ?>
        ],
        crosshair: true
    }],
    yAxis: [{ // Primary yAxis
        labels: {
            format: '{value}',
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        },
        title: {
            text: 'Employee by Age Total',
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        }
    }, { // Secondary yAxis
        title: {
            text: '',
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        },
        labels: {
            format: '{value}',
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        },
        opposite: true
    }],
    tooltip: {
        shared: true
    },
    legend: {
        layout: 'vertical',
        align: 'left',
        x: 120,
        verticalAlign: 'top',
        y: 100,
        floating: true,
        backgroundColor:
            Highcharts.defaultOptions.legend.backgroundColor || // theme
            'rgba(255,255,255,0.25)'
    },
    series: [{
        name: 'Total Employee',
        type: 'column',
        yAxis: 1,
        data: [
            <?php $sql_data_age = mysqli_query($connect, "SELECT 
COUNT(a.emp_no) AS jumlah
FROM dashboard_gen a
WHERE (a.age >= '0' AND a.age <= '28')
UNION
SELECT
COUNT(a.emp_no) AS jumlah
FROM dashboard_gen a
WHERE (a.age >= '29' AND a.age <= '38')
UNION
SELECT
COUNT(a.emp_no) AS jumlah
FROM dashboard_gen a
WHERE (a.age >= '39' AND a.age <= '48')
UNION
SELECT
COUNT(a.emp_no) AS jumlah
FROM dashboard_gen a
WHERE (a.age >= '49' AND a.age <= '58')
UNION
SELECT
COUNT(a.emp_no) AS jumlah
FROM dashboard_gen a
WHERE (a.age >= '59' AND a.age <= '68')
UNION
SELECT
COUNT(a.emp_no) AS jumlah
FROM dashboard_gen a
WHERE (a.age >= '69' AND a.age <= '78')
UNION
SELECT
COUNT(a.emp_no) AS jumlah
FROM dashboard_gen a
WHERE (a.age >= '79')");
            while($data_age = mysqli_fetch_assoc($sql_data_age)){
            ?>
            <?php echo $data_age['jumlah']; ?>, <?php } ?>
        ],
        tooltip: {
            valueSuffix: ' Headcount'
        }

    }, {
        name: '%',
        type: 'spline',
        data: [
            <?php $sql_data_age = mysqli_query($connect, "SELECT 
'0 - 28' AS age,
((COUNT(a.emp_no)/(SELECT COUNT(b.emp_no) FROM dashboard_gen b))*100) AS jumlah
FROM dashboard_gen a
WHERE (a.age >= '0' AND a.age <= '28')
UNION
SELECT
'29 - 38' AS age,
((COUNT(a.emp_no)/(SELECT COUNT(b.emp_no) FROM dashboard_gen b))*100) AS jumlah
FROM dashboard_gen a
WHERE (a.age >= '29' AND a.age <= '38')
UNION
SELECT
'39 - 48' AS age,
((COUNT(a.emp_no)/(SELECT COUNT(b.emp_no) FROM dashboard_gen b))*100) AS jumlah
FROM dashboard_gen a
WHERE (a.age >= '39' AND a.age <= '48')
UNION
SELECT
'49 - 58' AS age,
((COUNT(a.emp_no)/(SELECT COUNT(b.emp_no) FROM dashboard_gen b))*100) AS jumlah
FROM dashboard_gen a
WHERE (a.age >= '49' AND a.age <= '58')
UNION
SELECT
'59 - 68' AS age,
((COUNT(a.emp_no)/(SELECT COUNT(b.emp_no) FROM dashboard_gen b))*100) AS jumlah
FROM dashboard_gen a
WHERE (a.age >= '59' AND a.age <= '68')
UNION
SELECT
'69 - 78' AS age,
((COUNT(a.emp_no)/(SELECT COUNT(b.emp_no) FROM dashboard_gen b))*100) AS jumlah
FROM dashboard_gen a
WHERE (a.age >= '69' AND a.age <= '78')
UNION
SELECT
'79 - Keatas' AS age,
((COUNT(a.emp_no)/(SELECT COUNT(b.emp_no) FROM dashboard_gen b))*100) AS jumlah
FROM dashboard_gen a
WHERE (a.age >= '79')");
            while($data_age = mysqli_fetch_assoc($sql_data_age)){
            ?>
            <?php echo $data_age['jumlah']; ?>, <?php } ?>
        ],
        tooltip: {
            valueSuffix: '%'
        }
    }]
});
</script>

<script>
    // HEADCOUNT LOS ============================================================================================================================
    Highcharts.chart('los', {
    chart: {
        zoomType: 'xy',
        height: 250
    },
    title: {
        text: ''
    },
    subtitle: {
        text: ''
    },
    xAxis: [{
        categories: [
            <?php $sql_data_los = mysqli_query($connect, "SELECT 
'0' AS los
FROM dashboard_gen a 

UNION 
SELECT 
'0 - 2' AS los
FROM dashboard_gen a 

UNION 
SELECT 
'3 - 6' AS los
FROM dashboard_gen a 

UNION 
SELECT 
'7 - 10' AS los
FROM dashboard_gen a 

UNION 
SELECT 
'11 - 14' AS los
FROM dashboard_gen a 

UNION 
SELECT 
'15 - 18' AS los
FROM dashboard_gen a 

UNION 
SELECT 
'19 - 22' AS los
FROM dashboard_gen a 

UNION 
SELECT 
'23 - 24' AS los
FROM dashboard_gen a 

UNION 
SELECT 
'25 - Keatas' AS los
FROM dashboard_gen a ");
            while($data_los = mysqli_fetch_assoc($sql_data_los)){
            ?>
            '<?php echo $data_los['los']; ?>', <?php } ?>
        ],
        crosshair: true
    }],
    yAxis: [{ // Primary yAxis
        labels: {
            format: '{value}',
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        },
        title: {
            text: 'Employee by Age Total',
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        }
    }, { // Secondary yAxis
        title: {
            text: '',
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        },
        labels: {
            format: '{value}',
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        },
        opposite: true
    }],
    tooltip: {
        shared: true
    },
    legend: {
        layout: 'vertical',
        align: 'left',
        x: 120,
        verticalAlign: 'top',
        y: 100,
        floating: true,
        backgroundColor:
            Highcharts.defaultOptions.legend.backgroundColor || // theme
            'rgba(255,255,255,0.25)'
    },
    series: [{
        name: 'Total Employee',
        type: 'column',
        yAxis: 1,
        data: [
            <?php $sql_data_los = mysqli_query($connect, "SELECT 
COUNT(a.emp_no) AS jumlah
FROM dashboard_gen a 
WHERE (a.los = '0')
UNION 
SELECT 
COUNT(a.emp_no) AS jumlah
FROM dashboard_gen a 
WHERE (a.los > '0' AND a.los <= '2')
UNION 
SELECT 
COUNT(a.emp_no) AS jumlah
FROM dashboard_gen a 
WHERE (a.los >= '3' AND a.los <= '6')
UNION 
SELECT 
COUNT(a.emp_no) AS jumlah
FROM dashboard_gen a 
WHERE (a.los >= '7' AND a.los <= '10')
UNION 
SELECT 
COUNT(a.emp_no) AS jumlah
FROM dashboard_gen a 
WHERE (a.los >= '11' AND a.los <= '14')
UNION 
SELECT 
COUNT(a.emp_no) AS jumlah
FROM dashboard_gen a 
WHERE (a.los >= '15' AND a.los <= '18')
UNION 
SELECT 
COUNT(a.emp_no) AS jumlah
FROM dashboard_gen a 
WHERE (a.los >= '19' AND a.los <= '22')
UNION 
SELECT 
COUNT(a.emp_no) AS jumlah
FROM dashboard_gen a 
WHERE (a.los >= '23' AND a.los <= '24')
UNION 
SELECT 
COUNT(a.emp_no) AS jumlah
FROM dashboard_gen a 
WHERE (a.los >= '25')");
            while($data_los = mysqli_fetch_assoc($sql_data_los)){
            ?>
            <?php echo $data_los['jumlah']; ?>, <?php } ?>
        ],
        tooltip: {
            valueSuffix: ' Headcount'
        }

    }, {
        name: '%',
        type: 'spline',
        data: [
            <?php $sql_data_los = mysqli_query($connect, "SELECT 
((COUNT(a.emp_no)/(SELECT COUNT(b.emp_no) FROM dashboard_gen b))*100) AS jumlah
FROM dashboard_gen a 
WHERE (a.los = '0')
UNION 
SELECT 
((COUNT(a.emp_no)/(SELECT COUNT(b.emp_no) FROM dashboard_gen b))*100) AS jumlah
FROM dashboard_gen a 
WHERE (a.los > '0' AND a.los <= '2')
UNION 
SELECT 
((COUNT(a.emp_no)/(SELECT COUNT(b.emp_no) FROM dashboard_gen b))*100) AS jumlah
FROM dashboard_gen a 
WHERE (a.los >= '3' AND a.los <= '6')
UNION 
SELECT 
((COUNT(a.emp_no)/(SELECT COUNT(b.emp_no) FROM dashboard_gen b))*100) AS jumlah
FROM dashboard_gen a 
WHERE (a.los >= '7' AND a.los <= '10')
UNION 
SELECT 
((COUNT(a.emp_no)/(SELECT COUNT(b.emp_no) FROM dashboard_gen b))*100) AS jumlah
FROM dashboard_gen a 
WHERE (a.los >= '11' AND a.los <= '14')
UNION 
SELECT 
((COUNT(a.emp_no)/(SELECT COUNT(b.emp_no) FROM dashboard_gen b))*100) AS jumlah
FROM dashboard_gen a 
WHERE (a.los >= '15' AND a.los <= '18')
UNION 
SELECT 
((COUNT(a.emp_no)/(SELECT COUNT(b.emp_no) FROM dashboard_gen b))*100) AS jumlah
FROM dashboard_gen a 
WHERE (a.los >= '19' AND a.los <= '22')
UNION 
SELECT 
((COUNT(a.emp_no)/(SELECT COUNT(b.emp_no) FROM dashboard_gen b))*100) AS jumlah
FROM dashboard_gen a 
WHERE (a.los >= '23' AND a.los <= '24')
UNION 
SELECT 
((COUNT(a.emp_no)/(SELECT COUNT(b.emp_no) FROM dashboard_gen b))*100) AS jumlah
FROM dashboard_gen a 
WHERE (a.los >= '25')");
            while($data_los = mysqli_fetch_assoc($sql_data_los)){
            ?>
            <?php echo $data_los['jumlah']; ?>, <?php } ?>
        ],
        tooltip: {
            valueSuffix: '%'
        }
    }]
});
</script>