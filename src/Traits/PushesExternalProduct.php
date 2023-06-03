<?php

namespace EtsvThor\CashRegisterBridge\Traits;

use EtsvThor\CashRegisterBridge\Contracts\HasExternalProduct;
use EtsvThor\CashRegisterBridge\Jobs\PushExternalProduct;
use Illuminate\Support\Facades\Http;

trait PushesExternalProduct
{
    public static function bootPushesExternalProduct()
    {
        static::created(function (HasExternalProduct $externalProduct) {
            PushExternalProduct::dispatch($externalProduct);
        });
    }
}
