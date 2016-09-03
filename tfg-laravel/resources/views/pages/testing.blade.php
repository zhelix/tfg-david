

@extends('layouts.app')



@section('content')

    <body>


    <div class="container">
        <h2>Chart.js Responsive Line Chart Demo</h2>
        <div>
            <canvas id="canvas" width="1300" height="400"></canvas>
        </div>
    </div>
    <script>



    var lineChartData = {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [
            {
                label: "My First dataset",
                fill: false,
                lineTension: 0.1,
                backgroundColor: "rgba(75,192,192,0.4)",
                borderColor: "rgba(75,192,192,1)",
                borderCapStyle: 'butt',
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                pointBorderColor: "rgba(75,192,192,1)",
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(75,192,192,1)",
                pointHoverBorderColor: "rgba(220,220,220,1)",
                pointHoverBorderWidth: 2,
                pointRadius: 1,
                pointHitRadius: 10,
                data: [65, 59, 80, 81, 56, 55, 40],
                spanGaps: false,
            }
        ],
        options: {
            responsive: true,
            hoverMode: 'label',
            stacked: false,
            scales: {
                yAxes: [{
                    gridLines: {
                        show: true,
                        color: "rgba(255, 255, 255, 1)",
                        drawOnChartArea: true, // if true, draw these grid lines on the chart area
                        drawTicks: true, // if true, draw these grid lines as ticks on the axis
                        zeroLineWidth: 2,
                        zeroLineColor: "rgba(255, 255, 255, 1)",
                    },
                    labels: {
                        show: true,
                        scaleLabel:"ºC",
                        fontSize: 10,
                        fontStyle: "normal",
                        fontColor: "rgba(255, 255, 255, 1)",
                        fontFamily: "Helvetica Neue",
                    },
                }],
            }
        }
    };


    new Chart(document.getElementById('canvas').getContext('2d') , {
        type: "line",
        data: lineChartData,
        options: {
            responsive: true,
            hoverMode: 'label',
            stacked: false,
            scales: {
                yAxes: [{
                    gridLines: {
                        show: true,
                        color: "rgba(255, 255, 255, 1)",
                        drawOnChartArea: true, // if true, draw these grid lines on the chart area
                        drawTicks: true, // if true, draw these grid lines as ticks on the axis
                        zeroLineWidth: 2,
                        zeroLineColor: "rgba(255, 255, 255, 1)",
                    },
                    labels: {
                        show: true,
                        scaleLabel:"ºC",
                        fontSize: 10,
                        fontStyle: "normal",
                        fontColor: "rgba(255, 255, 255, 1)",
                        fontFamily: "Helvetica Neue",
                    },
                }],
            }
        }
    });



    </script>

@stop


