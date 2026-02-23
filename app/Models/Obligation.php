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
        'expected_amount',
        'type',
        'status',
        'description',
        'due_date',
        'user_id',
        'commitment_id',
    ];

    protected function casts(): array
    {
        return [
            'type' => ObligationTypeEnum::class,
            'status' => ObligationStatusEnum::class,
        ];
    }
}
