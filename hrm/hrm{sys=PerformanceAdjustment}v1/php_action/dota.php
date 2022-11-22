<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/histogram-bellcurve.js"></script>

<div id="containerv"></div>


<style>
    #containerv {
        height: 400px;
    }
</style>

<script>
    var containerv = document.getElementById('containerv');
    var data = [
        [0.89, 2769],
        [1.89, 2769],
        [2.056, 2808],
        [2.847, 2792],
        [2.092, 2782],
        [2.21, 2778],
        [2.394, 2786]
    ];

    Highcharts.chart('containerv', {
        width: containerv.width / 2,
        title: {
            text: 'Probability Desnsity'
        },

        xAxis: [{
        
            opposite: true,
            alignTicks: false
        }, {
            title: {
                text: 'Probability Desnsity'
            },
            alignTicks: false

        }],

        yAxis: [{
            title: {
                text: 'Data'
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
            name: 'Data',
            type: 'scatter',
            data: data,
            marker: {
                radius: 1.5
            }
        }]
    });
</script>