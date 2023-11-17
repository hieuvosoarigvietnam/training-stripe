<?php

use App\Http\Controllers\Api\SquareController;
use Illuminate\Support\Facades\Route;

Route::prefix('/squares')->middleware('auth:sanctum')->group(function () {
    Route::post('create-customer', [SquareController::class, 'createCustomer']);
    Route::post('add-card', [SquareController::class, 'addCard']);
    Route::post('disable-card', [SquareController::class, 'disableCard']);
    Route::get('list-payments', [SquareController::class, 'listPayments']);
    Route::post('create-payment', [SquareController::class, 'createPayment']);
    Route::post('completed-payment', [SquareController::class, 'completedPayment']);
});
