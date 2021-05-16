<script>
    var statistics_chart = document.getElementById("myChart").getContext('2d');

    var myChart = new Chart(statistics_chart, {
        type: 'line',
        data: {
            labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
            datasets: [{
                label: 'Jumlah Pesanan',
                data: [
                    <?= $chart['january'] ?>,
                    <?= $chart['february'] ?>,
                    <?= $chart['march'] ?>,
                    <?= $chart['april'] ?>,
                    <?= $chart['may'] ?>,
                    <?= $chart['june'] ?>,
                    <?= $chart['july'] ?>,
                    <?= $chart['august'] ?>,
                    <?= $chart['september'] ?>,
                    <?= $chart['october'] ?>,
                    <?= $chart['november'] ?>,
                    <?= $chart['december'] ?>
                ],
                borderWidth: 5,
                borderColor: '#6777ef',
                backgroundColor: 'transparent',
                pointBackgroundColor: '#fff',
                pointBorderColor: '#6777ef',
                pointRadius: 4
            }]
        },
        options: {
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        display: false,
                        drawBorder: false,
                    },
                    ticks: {
                        stepSize: 150
                    }
                }],
                xAxes: [{
                    gridLines: {
                        color: '#fbfbfb',
                        lineWidth: 2
                    }
                }]
            },
        }
    });
</script>

<script>
    var statistics_chart = document.getElementById("chartPendapatan").getContext('2d');

    var myChart = new Chart(statistics_chart, {
        type: 'line',
        data: {
            labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
            yLabels: ['', '100k', '200k', '400k', '500k', '600k', '700k', '800k', '900k'],
            datasets: [{
                label: 'Jumlah Pendapatan',
                data: [
                    <?= $chart_pendapatan['january'] ?>,
                    <?= $chart_pendapatan['february'] ?>,
                    <?= $chart_pendapatan['march'] ?>,
                    <?= $chart_pendapatan['april'] ?>,
                    <?= $chart_pendapatan['may'] ?>,
                    <?= $chart_pendapatan['june'] ?>,
                    <?= $chart_pendapatan['july'] ?>,
                    <?= $chart_pendapatan['august'] ?>,
                    <?= $chart_pendapatan['september'] ?>,
                    <?= $chart_pendapatan['october'] ?>,
                    <?= $chart_pendapatan['november'] ?>,
                    <?= $chart_pendapatan['december'] ?>
                ],
                borderWidth: 5,
                borderColor: '#6777ef',
                backgroundColor: 'transparent',
                pointBackgroundColor: '#fff',
                pointBorderColor: '#6777ef',
                pointRadius: 4
            }]
        },
        options: {
            responsive: true,
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        display: true,
                        drawBorder: false,
                    },
                    ticks: {
                        beginAtZero: true,
                        // stepSize: 500000,
                        // Return an empty string to draw the tick line but hide the tick label
                        // Return `null` or `undefined` to hide the tick line entirely
                        userCallback: function(value, index, values) {
                            // Convert the number to a string and splite the string every 3 charaters from the end
                            value = value.toString();
                            value = value.split(/(?=(?:...)*$)/);

                            // Convert the array to a string and format the output
                            value = value.join('.');
                            return 'Rp.' + value;
                        }
                    }
                }],
                xAxes: [{
                    gridLines: {
                        color: '#fbfbfb',
                        lineWidth: 2
                    }
                }]
            },

        }

        // options: {

        //     title: {
        //         display: true,
        //         text: 'Chart.js Line Chart - ' + type
        //     },
        //     scales: {
        //         xAxes: [{
        //             display: true,
        //         }],
        //         yAxes: [{
        //             display: true,
        //             type: type
        //         }]
        //     }
        // }
    });
</script>

<script>
    var ctx = document.getElementById("chartJenisPesanan").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            datasets: [{
                data: [
                    <?= $pie_chart['pagi'] ?>,
                    <?= $pie_chart['siang'] ?>,
                    <?= $pie_chart['dobel'] ?>,

                ],
                backgroundColor: [

                    '#6777ef',
                    '#ffa426',
                    '#fc544b',
                ],
                label: 'Dataset 1'
            }],
            labels: [
                'Pagi',
                'Siang',
                'Dobel',

            ],
        },
        options: {
            responsive: true,
            legend: {
                position: 'bottom',
            },
        }
    });
</script>