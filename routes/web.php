<?php

use EtsvThor\CashRegisterBridge\Http\Controllers\CashRegisterController;
use Illuminate\Support\Facades\Route;

Route::post('webhooks/cashregister-bridge/set-as-paid', [CashRegisterController::class, 'setAsPaid']);
Route::post('webhooks/cashregister-bridge/set-as-refunded', [CashRegisterController::class, 'setAsRefunded']);
Route::match(['get', 'post'], 'cashregister-bridge/redirect-to-cash-register', [CashRegisterController::class, 'redirectToCashRegister'])
    ->name('cashregister.redirect');
