<?php

namespace App\Actions\Metrics;

use App\Entities\Invoice;
use App\Entities\Metric;

class StoreMetricAction
{
    /**
     * @param Invoice $invoice
     */
    public static function execute(Invoice $invoice): void
    {
        $metric = Metric::firstOrCreate([
            'status' => $invoice->status,
            'primary_id' => $invoice->seller_id,
            'date' => $invoice->created_at->format('Y-m-d'),
        ]);

        $metric->total = ($metric->total ?? 0) + 1;

        $metric->save();
    }
}
