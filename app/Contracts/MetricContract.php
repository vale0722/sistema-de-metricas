<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface MetricContract
{
    public function read(array $filters): Collection;
}
