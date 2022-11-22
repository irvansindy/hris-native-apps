<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/histogram-bellcurve.js"></script>

<div id="containerv_before"></div>


<style>
    #containerv_before {
        height: 300px;
    }
</style>

<script>
    var containerv_before = document.getElementById('containerv_before');
    var data = [
        [ 1.75 , 0.178820609132941],
        [ 1.77 , 0.186186773952248],
        [ 2.1 , 0.325452060801194],
        [ 2.4 , 0.453432918046976],
        [ 2.6 , 0.515316021235942],
        [ 2.7 , 0.534216036037697],
        [ 2.8 , 0.543586730483586],
        [ 3.2 , 0.483685487383275],
        [ 3.4 , 0.408001787260419],
        [ 3.6 , 0.319444692238776],
        [ 3.8 , 0.23214743511948],
        [ 4 , 0.156590966737494],
    ];

    Highcharts.chart('containerv_before', {
        width: containerv_before.width / 10,
        title: {
            text: 'Probability Density'
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
                text: 'Performance'
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
            name: 'Performance',
            type: 'scatter',
            data: data,
            marker: {
                radius: 1.5
            }
        }]
    });
</script>