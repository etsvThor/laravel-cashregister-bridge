<?php

use EtsvThor\CashRegisterBridge\Http\Controllers\CashRegisterController;
use Illuminate\Support\Facades\Route;

Route::post('webhooks/cashregister-bridge/set-as-paid', [CashRegisterController::class, 'setAsPaid']);