<?php

namespace EtsvThor\CashRegisterBridge\Traits;

use EtsvThor\CashRegisterBridge\Contracts\HasExternalProduct;
use EtsvThor\CashRegisterBridge\Contracts\HasExternalProductItem;
use EtsvThor\CashRegisterBridge\Jobs\DeleteExternalProductItem;
use EtsvThor\CashRegisterBridge\Jobs\PushExternalProduct;
use EtsvThor\CashRegisterBridge\Jobs\PushExternalProductItem;
use Illuminate\Support\Facades\Http;

trait PushesExternalProductItem
{
    public static function bootPushesExternalProductItem()
    {
        static::saved(function (HasExternalProductItem $externalProductItem) {
            PushExternalProductItem::dispatch($externalProductItem);
        });

        static::deleted(function (HasExternalProductItem $externalProductItem) {
            DeleteExternalProductItem::dispatch($externalProductItem);
        });
    }
}
