<?php

namespace App\Constants;

use MyCLabs\Enum\Enum;

class Statuses extends Enum
{
    public const PAID = 'Pagada';
    public const UNPAID = 'No pagada';
    public const OVERDUE = 'Vencida';
}
