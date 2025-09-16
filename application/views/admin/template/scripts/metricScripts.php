<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    // Pie Chart Example
    var ctx = document.getElementById("metricsChart");
    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Accuracy", "Precision", "Recall", "F1 Score"],
            datasets: [
                {
                    label: "KNN",
                    backgroundColor: "#4e73df",
                    hoverBackgroundColor: "#2e59d9",
                    borderColor: "#4e73df",
                    data: [
                        <?php echo $metrics['KNN']['accuracy'] * 100; ?>,
                        <?php echo $metrics['KNN']['precision'] * 100; ?>,
                        <?php echo $metrics['KNN']['recall'] * 100; ?>,
                        <?php echo $metrics['KNN']['f1'] * 100; ?>
                    ],
                },
                {
                    label: "Random Forest",
                    backgroundColor: "#1cc88a",
                    hoverBackgroundColor: "#17a673",
                    borderColor: "#1cc88a",
                    data: [
                        <?php echo $metrics['Random Forest']['accuracy'] * 100; ?>,
                        <?php echo $metrics['Random Forest']['precision'] * 100; ?>,
                        <?php echo $metrics['Random Forest']['recall'] * 100; ?>,
                        <?php echo $metrics['Random Forest']['f1'] * 100; ?>
                    ],
                }
            ],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 6
                    },
                    maxBarThickness: 25,
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: 100,
                        maxTicksLimit: 5,
                        padding: 10,
                        callback: function (value, index, values) {
                            return value + '%';
                        }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }],
            },
            legend: {
                display: true
            },
            tooltips: {
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
                callbacks: {
                    label: function (tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ': ' + tooltipItem.yLabel + '%';
                    }
                }
            },
        }
    });
</script>