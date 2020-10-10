<script>
    import Vue from 'vue';
    import Chart from 'chart.js';

    export default class LineChart extends Vue {
        drawLineChart(id, labels, datasets, chart, labelX, labelY) {
            if (chart !== null) {
                chart.destroy();
            }
            let options = {
                responsive: true,
                scales: {
                    yAxes: [{
                        scaleLabel:{
                            display: true,
                            labelString: labelY,
                        },
                        ticks: {
                            beginAtZero: true,
                        }
                    }],
                    xAxes: [{
                        scaleLabel:{
                            display: true,
                            labelString: labelX,
                        }
                    }]
                },
            };

            options.tooltips = {
                callbacks: {
                    label: (tooltipItem, data) => {
                        return data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                    }
                }
            };

            return new Chart(document.getElementById(id).getContext('2d'), {
                type: 'line',
                data: {
                    labels,
                    datasets
                },
                options: options
            });
        }
    }
</script>
