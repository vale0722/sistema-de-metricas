<?php

namespace App\Observers;

use App\Entities\Invoice;
use App\Events\InvoiceIsCreated;

class InvoiceObserver
{
    /**
     * @param Invoice $invoice
     */
    public function created(Invoice $invoice)
    {
        event(new InvoiceIsCreated($invoice));
    }
}
