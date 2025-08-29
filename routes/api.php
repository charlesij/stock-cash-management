<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/detail-produk/{id}', [ApiController::class, 'getDetailProduct']);
Route::post('/checkout', [ApiController::class, 'checkoutItem']);
Route::post('/checkout/hold', [ApiController::class, 'holdTransaction']);
Route::post('/checkout/receipt', [ApiController::class, 'receiptTransaction']);
Route::post('/checkout/share', [ApiController::class, 'shareTransaction']);