<?php

namespace EtsvThor\CashRegisterBridge\Traits;

use EtsvThor\CashRegisterBridge\Contracts\HasExternalProduct;
use EtsvThor\CashRegisterBridge\Contracts\HasExternalProductItem;
use EtsvThor\CashRegisterBridge\Jobs\DeleteExternalProductItem;
use EtsvThor\CashRegisterBridge\Jobs\PushExternalProduct;
use EtsvThor\CashRegisterBridge\Jobs\PushExternalProductItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

trait PushesExternalProductItem
{
    public static function bootPushesExternalProductItem(): void
    {
        static::saved(function (HasExternalProductItem&Model $externalProductItem) {
            if (config('cashregister-bridge.push_product_items_on_sync') && $externalProductItem->wasRecentlyCreated) {
                PushExternalProductItem::dispatch($externalProductItem)->onConnection('sync');
            } else {
                PushExternalProductItem::dispatch($externalProductItem);
            }
        });

        static::deleted(function (HasExternalProductItem $externalProductItem) {
            DeleteExternalProductItem::dispatch($externalProductItem->toExternalProductItem());
        });
    }
}
