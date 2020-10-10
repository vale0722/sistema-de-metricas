<script>
    import Vue from 'vue';
    import Chart from 'chart.js';

    export default class PieChart extends Vue {
        drawPieChart(id, data, chart, scaleLabelFormatter) {
            if (chart !== null) {
                chart.destroy();
            }
            let options = {
                responsive: true,
            };
            if (arguments.length === 3 || arguments.length === 4) {
                options.tooltips = {
                    callbacks: {
                        label: (tooltipItem, datasets) => {
                            let value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                            let total = data.totals;
                            let percentage = this.calculatePercentage(value, total);

                            return (arguments.length === 3)
                                ? `${new Intl.NumberFormat().format(value)} (${percentage})`
                                : `${scaleLabelFormatter(value)} (${percentage})`;
                        }
                    }
                };
            }
            return new Chart(document.getElementById(id).getContext('2d'), {
                type: 'doughnut',
                data: data,
                options: options,
            });
        }

        calculatePercentage(value, total) {
            total = Number(total);
            value = Number(value);
            let percentage = Number((value / total)*100).toFixed(2);

            return percentage.toString() + '%';
        }
    }
</script>
