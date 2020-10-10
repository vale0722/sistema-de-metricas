<script>
import BarChart from "./charts/BarChart";
import {stringify} from "qs";
import PieChart from "./charts/PieChart";
import LineChart from "./charts/LineChart";

export default {
    name: "InvoiceMetric",
    data() {
        return {
            invoiceCount: {},
            invoiceData: {},
            labelX: "Fecha",
            labelY: "Cantidad",
            to: null,
            from: null,

            invoiceBarChart: null,
            invoiceLineChart: null,
            invoicePieChart: null,
        }
    },

    computed: {
        dates() {
            const days = [];
            const dates = [];

            for(let i = this.rangeOnDays; i >= 0; i--){
                days[i] = (new Date(
                    this.to.getFullYear(),
                    this.to.getMonth(),
                    (this.to.getDate() - i))).toISOString().slice(0,10);
            }

            Object.values(days).reverse().forEach(date => {
                dates[date] = date;
            });

            return dates;
        },

        rangeOnDays() {
            return Math.round((this.to - this.from) / (1000 * 60 * 60 * 24));
        },

        labels() {
            return Object.keys(this.invoiceData[Object.keys(this.invoiceData)[0] ?? 0] ?? [])
        },

        total() {
            const mapper = item => Number(item);
            return this.sum([
                this.sum(Object.values(this.invoiceData['Pagada'] ?? [0]).map(mapper)),
                this.sum(Object.values(this.invoiceData['No pagada'] ?? [0]).map(mapper)),
                this.sum(Object.values(this.invoiceData['Vencida'] ?? [0]).map(mapper)),
            ]);
        }
    },

    created() {
        this.to = new Date();
        this.from = new Date(
            this.to.getFullYear(),
            this.to.getMonth(),
            (this.to.getDate() - 7)
        );
        this.getMetrics();
    },

    methods: {
        sum(array) {
            return +array.reduce(function (carry, b) {
                return Number(carry) + Number(b);
            }, 0).toFixed(2);
        },

        getMetrics() {
            axios.get('/metrics/invoice-count', {
                params: {
                    'filter': {
                        'from': this.from.toISOString().slice(0, 10),
                        'to': this.to.toISOString().slice(0, 10),
                        'primary': 'all',
                    }
                }
            }).then(({data: {metric}}) => {
                this.invoiceCount = Object.assign({}, metric);
                this.buildMetric();
                this.loading = false;
            }).catch(error => {
                console.log(error);
                this.loading = false;
            })
        },

        buildMetric() {
            this.completeLabels();
            this.drawCharts();
        },

        completeLabels() {
            Object.keys(this.invoiceCount ?? []).forEach(item => {
                this.invoiceData[item] = {};
                let listFormat = {};
                let keys = this.dates;

                let byStatus = this.invoiceCount[item] ?? [];

                Object.keys(byStatus).forEach(date => {
                    listFormat[keys[date]] = this.invoiceCount[item][date];
                });

                Object.values(keys).forEach(period => {
                    if (!Object.keys(listFormat).includes(period.toString())) listFormat[period] = 0;
                });

                listFormat = Object.fromEntries(Object.entries(listFormat).sort());

                this.invoiceData[item] = listFormat;
            });
        },

        drawCharts() {
            this.drawInvoiceBar();
            this.drawInvoiceLine();
            this.drawInvoicePie();
        },

        drawInvoiceBar() {
            this.invoiceBarChart = (new BarChart).drawBarChart(
                'invoiceBar',
                this.labels,
                this.mapInvoiceBarDataset(),
                this.invoiceBarChart,
                this.labelX, this.labelY,
            );
        },

        drawInvoiceLine() {
            this.invoiceLineChart = (new LineChart).drawLineChart(
                'invoiceLine',
                this.labels,
                this.mapInvoiceBarDataset(),
                this.invoiceLineChart,
                this.labelX, this.labelY,
            );
        },

        mapInvoiceBarDataset() {
            return [
                {
                    'label': 'Pagadas',
                    'data': Object.values(this.invoiceData['Pagada'] ?? [0]),
                    'hidden': stringify([0]) === stringify(Object.values(this.invoiceData['Pagada'] ?? [0])),
                    'borderColor': 'rgba(54, 162, 235)',
                    'borderWidth': 2,
                    'backgroundColor': 'rgba(54, 162, 235, 0.6)'
                },
                {
                    'label': 'No Pagadas',
                    'data': Object.values(this.invoiceData['No pagada'] ?? [0]),
                    'hidden': stringify([0]) === stringify(Object.values(this.invoiceData['No pagada'] ?? [0])),
                    'borderColor': 'rgba(255, 99, 132)',
                    'borderWidth': 2,
                    'backgroundColor': 'rgba(255, 99, 132, 0.6)',
                },
                {
                    'label': 'Vencidas',
                    'data': Object.values(this.invoiceData['Vencida'] ?? [0]),
                    'hidden': stringify([0]) === stringify(Object.values(this.invoiceData['Vencida'] ?? [0])),
                    'borderColor': 'rgba(255, 206, 86)',
                    'borderWidth': 2,
                    'backgroundColor': 'rgba(255, 206, 86, 0.6)'
                },
            ]
        },

        drawInvoicePie() {
            this.invoicePieChart = (new PieChart).drawPieChart(
                'invoicePie',
                this.mapInvoicePieDataset(),
                this.invoicePieChart);
        },

        mapInvoicePieDataset() {
            return {
                'datasets': [{
                    data: [
                        this.sum(Object.values(this.invoiceData['Pagada'] ?? [0])),
                        this.sum(Object.values(this.invoiceData['No pagada'] ?? [0])),
                        this.sum(Object.values(this.invoiceData['Vencida'] ?? [0])),
                    ],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                    ],
                    borderColor: [
                        'rgba(54, 162, 235)',
                        'rgba(255,99,132)',
                        'rgba(255, 206, 86)',
                    ],
                    borderWidth: 2,
                }],
                'totals': this.total,
                'labels': ['Pagadas', 'No pagadas', 'Vencidas']
            }
        },
    },
}
</script>
