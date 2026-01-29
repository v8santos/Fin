<?php

use App\Http\Controllers\Api\BillController;
use App\Http\Controllers\Api\TokenController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
	Route::prefix('tokens')->name('tokens.')->group(function () {
	    Route::post('/create', [TokenController::class, 'getAll'])->middleware('ability:token:create');
	    Route::get('/all', [TokenController::class, 'getAll'])->middleware('ability:token:read');
	});

	Route::prefix('bills')->name('bills.')->group(function () {
		Route::get('/all', [BillController::class, 'getAll'])->name('get.all');
		Route::get('/search', [BillController::class, 'search'])->name('search');
		Route::post('/store', [BillController::class, 'store'])->name('store');
		Route::put('/{bill}/update', [BillController::class, 'update'])->name('update');
		Route::delete('/{bill}/delete', [BillController::class, 'delete'])->name('delete');
	});
});

require __DIR__.'/auth.php';