<?php

namespace App\Models;

use App\Enum\ObligationStatusEnum;
use App\Enum\ObligationTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obligation extends Model
{
    use HasFactory;

    protected $fillable = [
        'expected_amount', // Valor esperado que seja pago dessa cobrança.
        'type', // Caminho para onde o dinheiro deverá seguir: Entrada ou saída por exemplo.
        'status', // Status em que a cobrança se encontra: Em aberto, paga, paga parcialmente, etc.
        'description', // Descrição do há na cobrança.
        'due_date', // Data de vencimento da cobrança.
        'user_id', // dono do recurso
        'account_id', // id da conta bancária do usuário.
        'commitment_id', // id do compromisso atrelado a essa cobrança, quando existe um.
    ];

    protected function casts(): array
    {
        return [
            'type' => ObligationTypeEnum::class,
            'status' => ObligationStatusEnum::class,
        ];
    }
}
