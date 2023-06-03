<?php

namespace EtsvThor\CashRegisterBridge\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \EtsvThor\CashRegisterBridge\CashRegisterBridge
 */
class LaravelCashRegisterBridge extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \EtsvThor\CashRegisterBridge\CashRegisterBridge::class;
    }
}
