<?php

use App\Http\Controllers\Api\BillController;
use Illuminate\Support\Facades\Route;

Route::get('bills', [BillController::class, 'getAll']);
Route::get('bills/{bill}', [BillController::class, 'find']);
Route::post('bills/store', [BillController::class, 'store']);