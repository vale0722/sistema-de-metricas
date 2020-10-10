<?php

namespace App\Metrics\Behaviour;

use App\Contracts\MetricContract;
use App\Entities\Metric;
use Illuminate\Support\Collection;

class InvoiceMetricBehaviour implements MetricContract
{
    public function read(array $filters): Collection
    {
        return Metric::readThreeLevelsMetric(Metric::getMetrics($filters));
    }
}
