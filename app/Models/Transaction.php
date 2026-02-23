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
        'user_id',
        'amount',
        'type',
        'direction',
        'description',
        'obligation_id',
        'executed_at',
        'created_at',
    ];

    protected function casts(): array
    {
        return [
            'type' => TransactionTypeEnum::class,
        ];
    }
}
