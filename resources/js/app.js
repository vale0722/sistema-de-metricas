import InvoiceMetric from "./metrics/InvoiceMetric";

require('./bootstrap');
require('./font-awesome');

window.Vue = require('vue');

Vue.component('invoice-metric', InvoiceMetric);

const app = new Vue({
    el: '#app',
});
