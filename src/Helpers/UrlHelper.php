<?php

namespace EtsvThor\CashRegisterBridge\Helpers;

use EtsvThor\CashRegisterBridge\Contracts\HasExternalProductItem;
use Illuminate\Database\Eloquent\Model;

class UrlHelper
{
    static public function redirectToCashRegister(Model&HasExternalProductItem ...$models)
    {
        $items = collect($models)
            ->map(fn(Model $model) => ['type' => $model::class, 'id' => $model->getKey()])
            ->all();

        return route('cashregister.redirect', ['items' => $items]);
    }
}
