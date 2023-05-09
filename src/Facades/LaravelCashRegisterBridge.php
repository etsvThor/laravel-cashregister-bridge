<?php

namespace EtsvThor\LaravelCashRegisterBridge\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \EtsvThor\LaravelCashRegisterBridge\LaravelCashRegisterBridge
 */
class LaravelCashRegisterBridge extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \EtsvThor\LaravelCashRegisterBridge\LaravelCashRegisterBridge::class;
    }
}
