<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/histogram-bellcurve.js"></script>

<div id="containerv"></div>


<style>
    #containerv {
        height: 600px;
    }
</style>

<script>
    var containerv = document.getElementById('containerv');
    var data = [
        [1.89, 2769],
        [2.056, 2808],
        [1.847, 2792],
        [1.092, 2782],
        [1.21, 2778],
        [1.394, 2786],
        [1.663, 2772],
        [1.192, 2765],
        [1.437, 2775],
        [4.000, 1],
        [4.000, 2],
        [4.000, 3],
        [4.000, 4],
        [4.000, 5]
    ];

    Highcharts.chart('containerv', {
        width: containerv.width / 2,
        title: {
            text: 'Probability Desnsity'
        },

        xAxis: [{
            title: {
                text: 'Data'
            },
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