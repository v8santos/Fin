<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        // Os valores de amount de todas as contas do usuário
        // serão somados e retornados em uma rota de consulta de saldo
        'name', // Nome da banco ou outro tipo de conta que o usuário possui
        'amount', // Valor em conta
        'user_id', // Id do dono da conta
    ];
}
