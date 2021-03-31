/* globals Chart:false, feather:false */

(function () {
    'use strict'

    feather.replace()

    // Graphs
    var ctx = document.getElementById('myChart')
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [
                '2021-03-05','2021-03-25','2021-03-29','2021-03-31','2021-04-21'
            ],
            datasets: [{
                    data: [
                        '1111','987','120','63.59','56.5'
                    ],
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: '#007bff',
                    borderWidth: 4,
                    pointBackgroundColor: '#007bff'
                }]
        },
        options: {
            scales: {
                yAxes: [{
                        ticks: {
                            beginAtZero: false
                        }
                    }]
            },
            legend: {
                display: false
            }
        }
    })
})()
