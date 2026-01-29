<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Bill extends Model
{
    /** @use HasFactory<\Database\Factories\BillFactory> */
    use HasFactory;
    
    protected $fillable = [
    	'amount',
    	'label',
    	'user_id',
    	'paid',
    	'amount_paid',
        'due_date',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
