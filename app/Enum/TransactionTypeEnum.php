<?php

namespace App\Enum;

enum TransactionTypeEnum: int
{
    case income = 1; // Receita
    case expense = 2; // Despesa
    case transfer = 3; // Transferência
    case refund = 4; // Reembolso
	case adjustment = 5; // Ajustes
    case fee = 6; // Tarifa
}