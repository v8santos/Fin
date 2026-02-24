<?php

namespace App\Models;

use App\Enum\TransactionTypeEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasUuids, HasFactory;

    public $timestamps = true;

    const UPDATED_AT = null;

    protected $fillable = [
        'amount', // Valor que foi transacionado.
        'type', // Tipo de transação: Entrada, saída, extorno, etc.
        'direction', // Diz, principalmente, se o saldo vai sair ou entrar para a carteira do usuário: -1 ou 1.
        'description', // Descreve o que é aquela transação
        'user_id', // Dono do recurso
        'account_id', // id da conta usada pelo usuário
        'obligation_id', // id da cobrança que gerou essa transação, se tiver uma.
        'executed_at', // Data que a transação realmente foi executada.
    ];

    protected function casts(): array
    {
        return [
            'type' => TransactionTypeEnum::class,
        ];
    }
}
