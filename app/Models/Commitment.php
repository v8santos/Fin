<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commitment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'fixed_amount',
        'is_variable',
        'description',
        'is_active',
        'rrule',
        'start_date',
        'end_date',
        'last_generated_at',
    ];
}
