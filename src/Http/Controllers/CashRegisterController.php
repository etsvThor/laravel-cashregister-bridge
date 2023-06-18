<?php

namespace EtsvThor\CashRegisterBridge\Http\Controllers;

use EtsvThor\CashRegisterBridge\Contracts\HasExternalProductItem;
use EtsvThor\CashRegisterBridge\Exceptions\HasNoExternalProductItem;
use EtsvThor\CashRegisterBridge\Exceptions\SetAsPaidFailed;
use EtsvThor\CashRegisterBridge\Http\Controllers\Traits\VerifiesSignature;
use EtsvThor\CashRegisterBridge\Http\Requests\SetAsPaidRequest;

class CashRegisterController
{
    use VerifiesSignature;

    public function setAsPaid(SetAsPaidRequest $request)
    {
        if (! is_null($error = $this->verifySignature($request, config('cashregister-bridge.secret')))) {
            return $error;
        }

        $type = $request->validated('type');

        /** @var HasExternalProductItem $productItem */
        $productItem = $type::findOrFail($request->validated('id'));

        throw_unless($productItem instanceof HasExternalProductItem, HasNoExternalProductItem::class);

        $success = $productItem->setAsExternallyPaid();

        throw_unless($success, SetAsPaidFailed::class);

        return [
            'success' => true,
            'message' => 'The item has been set as paid',
        ];
    }
}
