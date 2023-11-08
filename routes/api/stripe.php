<?php

use App\Http\Controllers\Api\Stripe\CustomerController;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->middleware('auth:sanctum')->group(function () {
    Route::get('/retrieve-customer', [CustomerController::class, 'retrievingCustomer']);
    Route::post('/update-customer', [CustomerController::class, 'update']);
    Route::get('/balance', [CustomerController::class, 'balance']);
});
