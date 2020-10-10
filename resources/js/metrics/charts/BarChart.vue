<script>
    import Vue from 'vue';
    import Chart from 'chart.js';

    export default class BarChart extends Vue {
        drawBarChart(id, labels, datasets, chart, labelX, labelY) {
            if (chart !== null) {
                chart.destroy();
            }
            let options = {
                responsive: true,
                scales: {
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: labelY,
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }],
                    xAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: labelX,
                        }
                    }]
                }
            };

            return new Chart(document.getElementById(id).getContext('2d'), {
                "type": 'bar',
                "data": {
                    labels,
                    datasets
                },
                "options": options
            });
        }
    }
</script>
