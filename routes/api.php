<?php

use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CommitmentController;
use App\Http\Controllers\Api\TokenController;
use App\Http\Controllers\Api\TransactionController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
	Route::prefix('tokens')->name('tokens.')->group(function () {
	    Route::post('/create', [TokenController::class, 'store'])->middleware('ability:token:create');
	    Route::get('/all', [TokenController::class, 'getAll'])->middleware('ability:token:read');
	});

	Route::get('transactions', TransactionController::class)->name('transactions');

	Route::prefix('accounts')->name('accounts.')->group(function () {
	    Route::get('/', [AccountController::class, 'index'])->name('index');
	    Route::post('/create', [AccountController::class, 'create'])->name('create');
	});

	Route::prefix('commitments')->name('commitments.')->group(function () {
		Route::get('/', [CommitmentController::class, 'index'])->name('index');
		Route::post('/create', [CommitmentController::class, 'create'])->name('create');
	});
});

Route::post('login', [AuthController::class, 'getAccessToken']);

/**
 * Regra de recorrência
 * 
 * - Vamos salvar tudo em rrule, seguindo padrão da rfc 5545
 * - Sempre que criarmos um novo registro de compromisso com recorrência:
 *   - Vamos pegar o valor de recorrência vindo da request, ex.: freq=weekly,interval=2,start_date=10 e 
 *     iremos gerar a próxima data para gerar a cobrança (next_date).
 *   - Essa data cairá na regra do cron diário que busca os compromissos dentro dos próximo 60 dias.
 *   - Para compromissos criados para a data de hoje, já iremos disparar o job para calcular.
 *   - Ou, podemos até mesmo gerar cobranças dentro dos próximos 60 dias, também, no momento da criação.
 */