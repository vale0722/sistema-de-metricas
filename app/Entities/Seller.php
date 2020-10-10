<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Seller extends Model
{
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }
}
