<?php

namespace App\Metrics;

use Illuminate\Support\Collection;
use App\Contracts\MetricContract;

class MetricsManager
{
    /** @var MetricContract */
    private $behaviour;

    /**
     * Metric constructor.
     * @param MetricContract $behaviour
     */
    public function __construct(MetricContract $behaviour)
    {
        $this->behaviour = $behaviour;
    }

    public function read(array $filters): Collection
    {
        return $this->behaviour->read($filters);
    }
}
