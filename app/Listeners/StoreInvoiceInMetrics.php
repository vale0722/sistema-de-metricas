<?php

namespace App\Listeners;

use App\Actions\Metrics\StoreMetricAction;
use App\Events\InvoiceIsCreated;
use Illuminate\Contracts\Queue\ShouldQueue;

class StoreInvoiceInMetrics implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param InvoiceIsCreated $event
     * @return void
     */
    public function handle(InvoiceIsCreated $event)
    {
        StoreMetricAction::execute($event->invoice);
    }
}
