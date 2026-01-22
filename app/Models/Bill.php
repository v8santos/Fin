<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];
}
