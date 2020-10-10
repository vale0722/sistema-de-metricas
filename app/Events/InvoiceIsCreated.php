<?php

namespace App\Events;

use App\Entities\Invoice;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class InvoiceIsCreated
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public $invoice;

    /**
     * Create a new event instance.
     * @param Invoice $invoice
     */
    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }
}
