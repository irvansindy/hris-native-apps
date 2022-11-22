<?php
    include "../../../application/config.php";
    $get_avg_dev = mysqli_fetch_array(mysqli_query($connect, "SELECT AVG(A.pa_result_adjust) FROM hrmperf_finalresult A")); 
    // echo "average : " . $get_avg_dev[0]."<br>";

    $get_std_dev = mysqli_fetch_array(mysqli_query($connect, "SELECT STDDEV(A.pa_result_adjust) FROM hrmperf_finalresult A")); 
    // echo "stdev : " . $get_std_dev[0]."<br>";

    $get_devstdv2pi = mysqli_fetch_array(mysqli_query($connect, "SELECT (POWER(((3.14*2)) , 0.5)) * $get_std_dev[0] FROM hrmperf_finalresult A")); 
    // echo "stdevpi : " .  $get_devstdv2pi[0]."<br>";

    $get_e = mysqli_fetch_array(mysqli_query($connect, "SELECT 2.71828")); 
    // echo "euler : " . $get_e[0]."<br>";

    $get_2stdv = mysqli_fetch_array(mysqli_query($connect, "SELECT (POWER(STDDEV(A.pa_result_adjust) , 2) ) * -2 FROM hrmperf_finalresult A")); 
    // echo "minus2xstdv : " .$get_2stdv[0]."<br>";
?>


<?php

// echo "SELECT 
// A.pa_result_adjust,
// POWER(A.pa_result_adjust-$get_avg_dev[0] , 2),
// 1/($get_devstdv2pi[0]),
// 1/($get_devstdv2pi[0])*$get_e[0],
// POWER(A.pa_result_adjust-$get_avg_dev[0] , 2)/$get_2stdv[0],
// POW(2, $get_avg_dev[0]),
// (POW($get_std_dev[0],2))*-2,
// POW($get_e[0] , (POWER(A.pa_result_adjust-$get_avg_dev[0] , 2) / $get_2stdv[0])),
// 1/($get_devstdv2pi[0]) * (POW($get_e[0] , (POWER(A.pa_result_adjust-$get_avg_dev[0] , 2) / $get_2stdv[0])))
// FROM hrmperf_finalresult A ORDER BY A.pa_result_adjust ASC";


    $sql = mysqli_query($connect, "SELECT 
                                        A.pa_result_adjust,
                                        POWER(A.pa_result_adjust-$get_avg_dev[0] , 2),
                                        1/($get_devstdv2pi[0]),
                                        1/($get_devstdv2pi[0])*$get_e[0],
                                        POWER(A.pa_result_adjust-$get_avg_dev[0] , 2)/$get_2stdv[0],
                                        POW(2, $get_avg_dev[0]),
                                        (POW($get_std_dev[0],2))*-2,
                                        POW($get_e[0] , (POWER(A.pa_result_adjust-$get_avg_dev[0] , 2) / $get_2stdv[0])),
                                        1/($get_devstdv2pi[0]) * (POW($get_e[0] , (POWER(A.pa_result_adjust-$get_avg_dev[0] , 2) / $get_2stdv[0])))
                                    FROM hrmperf_finalresult A ORDER BY A.pa_result_adjust ASC");
    while ($r = mysqli_fetch_array($sql)) {

        $data .= '[ ' . $r[0] . ' , ' . $r[8] . ' ],';
    ?>
<?php       
   }                    
?>


<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/histogram-bellcurve.js"></script>

<div id="containerv"></div>


<style>
    #containerv {
        height: 300px;
    }
</style>

<script>
    var containerv = document.getElementById('containerv');
    var data = [
        <?php echo $data;?>

    ];

    Highcharts.chart('containerv', {
        width: containerv.width / 10,
        title: {
            text: 'Probability Density Adjustment'
        },

        xAxis: [{
        
            opposite: true,
            alignTicks: true
        }, {
            title: {
                text: 'Probability Density'
            },
            alignTicks: true

        }],

        yAxis: [{
            title: {
                text: 'Performance Adjustment'
            }
        }, {
            title: {
                text: 'Bell curve'
            },
            opposite: true
        }],

        series: [{
            name: 'Bell curve',
            type: 'bellcurve',
            xAxis: 1,
            yAxis: 1,
            baseSeries: 1,
            zIndex: -1
        }, {
            name: 'Performance Adjustment',
            type: 'scatter',
            data: data,
            marker: {
                radius: 1.5
            }
        }]
    });
</script>