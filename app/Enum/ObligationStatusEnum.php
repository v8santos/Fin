<?php

namespace App\Enum;

enum ObligationStatusEnum: int
{
    case open = 1; // Em aberto
    case partially_paid = 2; // Parcialmente pago
    case paid = 3; // Pago
    case cancelled = 4; // Cancelado
}