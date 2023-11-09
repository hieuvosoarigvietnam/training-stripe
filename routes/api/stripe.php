<?php

use App\Http\Controllers\Api\Stripe\CustomerController;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->middleware('auth:sanctum')->group(function () {
    Route::get('retrieve-customer', [CustomerController::class, 'retrievingCustomer']);
    Route::post('update-customer', [CustomerController::class, 'update']);
    Route::get('balance', [CustomerController::class, 'balance']);
    Route::post('add-card', [CustomerController::class, 'addCard']);
    Route::post('purchase', [CustomerController::class, 'purchase']);
    Route::get('invoices', [CustomerController::class, 'invoices']);
});
