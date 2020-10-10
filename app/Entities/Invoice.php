<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }
}
