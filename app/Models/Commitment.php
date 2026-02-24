<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commitment extends Model
{
    use HasFactory;

    protected $fillable = [
        'fixed_amount', // Valor fixo, para compromissos com valor já bem definido, ex.: Aluguel
        'is_variable', // Diz se o valor é variável
        'description', // Descreve sobre o que é o compromisso
        'is_active', // Diz se esse compromisso está ativo
        'user_id', // dono do recurso
        'account_id', // id da conta bancária do usuário
        'rrule', // Regra de recorrência, padrão icalendar (RFC 5545)
        'start_date', // Data de inicio da recorrência
        'end_date', // Data final da recorrência
        'next_date', // Data para gerar a próxima cobrança
        'last_generated_at', // Data para qual o compromisso gerou a ultima cobrança
    ];
}
