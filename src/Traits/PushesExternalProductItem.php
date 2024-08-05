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
    public static function bootPushesExternalProductItem(): void
    {
        static::saved(function (HasExternalProductItem $externalProductItem) {
            if (config('cashregister-bridge.product_item_saved_sync', false)) {
                PushExternalProductItem::dispatch($externalProductItem)->onConnection('sync');;
            } else {
                PushExternalProductItem::dispatch($externalProductItem);
            }
        });

        static::deleted(function (HasExternalProductItem $externalProductItem) {
            DeleteExternalProductItem::dispatch($externalProductItem->toExternalProductItem());
        });
    }
}
