        (function () {
        'use strict'
          feather.replace()
          // Graphs
          var ctx = document.getElementById('myChart')
          // eslint-disable-next-line no-unused-vars
          var myChart = new Chart(ctx, {
            type: 'line',
            data: {
              labels: [
              '05-2018','07-2018','10-2018','11-2018','12-2018','05-2019','06-2019','10-2019','11-2019','12-2019','01-2020','03-2020','05-2020','07-2020','10-2020','11-2020','12-2020','01-2021','02-2021','03-2021','04-2021','05-2021','06-2021','07-2021','10-2021','11-2021'
              ],
              datasets: [{
                data: [
                '7000.00','800.00','480.00','840.00','14100.00','5500.00','2740.00','300.00','1600.00','13000.00','1400.00','210.00','1400.00','1200.00','9440.00','600.00','12000.00','1920.00','6890.21','850.00','2863.90','10440.00','4772.00','1700.00','480.00','4000.00'
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