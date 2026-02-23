<?php

namespace App\Enum;

enum ObligationTypeEnum: int
{
    case income = 1; // Receita
    case expense = 2; // Despesa
}