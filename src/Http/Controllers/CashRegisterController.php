<?php

namespace EtsvThor\CashRegisterBridge\Http\Controllers;

use EtsvThor\CashRegisterBridge\Contracts\HasExternalProductItem;
use EtsvThor\CashRegisterBridge\Exceptions\HasNoExternalProductItem;
use EtsvThor\CashRegisterBridge\Exceptions\SetAsPaidFailed;
use EtsvThor\CashRegisterBridge\Http\Controllers\Traits\VerifiesSignature;
use EtsvThor\CashRegisterBridge\Http\Requests\RedirectToCashRegisterRequest;
use EtsvThor\CashRegisterBridge\Http\Requests\SetAsPaidRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CashRegisterController
{
    use VerifiesSignature;

    public function setAsPaid(SetAsPaidRequest $request)
    {
        if (!is_null($error = $this->verifySignature($request, config('cashregister-bridge.secret')))) {
            return $error;
        }

        $productItem = $this->getExternalProductItem($request);

        $success = $productItem->setAsExternallyPaid();

        throw_unless($success, SetAsPaidFailed::class);

        return [
            'success' => true,
            'message' => 'The item has been set as paid',
        ];
    }

    public function redirectToCashRegister(RedirectToCashRegisterRequest $request)
    {
        $productItem = $this->getExternalProductItem($request);

        $data = $productItem->toExternalProductItem()->only(
            'product_type',
            'product_id',
            'type',
            'id'
        );

        $query = http_build_query($data);

        $hash = hash_hmac('sha256', $query, config('cashregister-bridge.secret'));

        $service_id = config('cashregister-bridge.service_id');
        $url = Str::of(config('cashregister-bridge.base_url'))
            ->finish('/')
            ->append("api/services/{$service_id}/service-items/add-to-cart?")
            ->append($query)
            ->toString();

        return redirect($url)
            ->withHeaders(['X-Signature' => $hash]);
    }

    protected function getExternalProductItem(Request $request): HasExternalProductItem
    {
        $type = $request->validated('type');

        /** @var HasExternalProductItem $productItem */
        $productItem = $type::findOrFail($request->validated('id'));

        throw_unless($productItem instanceof HasExternalProductItem, HasNoExternalProductItem::class);

        return $productItem;
    }
}
