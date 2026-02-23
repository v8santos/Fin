<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BillController;
use App\Http\Controllers\Api\TokenController;
use App\Http\Controllers\Api\TransactionController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
	Route::prefix('tokens')->name('tokens.')->group(function () {
	    Route::post('/create', [TokenController::class, 'getAll'])->middleware('ability:token:create');
	    Route::get('/all', [TokenController::class, 'getAll'])->middleware('ability:token:read');
	});

	Route::get('transactions', TransactionController::class)->name('transactions');
});

Route::post('login', [AuthController::class, 'getAccessToken']);
