<?php

namespace EtsvThor\CashRegisterBridge\Http\Controllers;

use EtsvThor\CashRegisterBridge\Contracts\HasExternalProductItem;
use EtsvThor\CashRegisterBridge\Exceptions\HasNoExternalProductItem;
use EtsvThor\CashRegisterBridge\Exceptions\SetAsPaidFailed;
use EtsvThor\CashRegisterBridge\Exceptions\SetAsRefundedFailed;
use EtsvThor\CashRegisterBridge\Http\Controllers\Traits\VerifiesSignature;
use EtsvThor\CashRegisterBridge\Http\Requests\RedirectToCashRegisterRequest;
use EtsvThor\CashRegisterBridge\Http\Requests\SetAsPaidRequest;
use EtsvThor\CashRegisterBridge\Http\Requests\SetAsRefundedRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CashRegisterController
{
    use VerifiesSignature;

    public function setAsPaid(SetAsPaidRequest $request)
    {
        if (! is_null($error = $this->verifySignature($request, config('cashregister-bridge.secret')))) {
            return $error;
        }

        $productItem = $this->getExternalProductItem($request->validated('type'), $request->validated('id'));

        $success = $productItem->setAsExternallyPaid();
        if ($success && $request->validated('completed')) {
            $productItem->setAsCompleted();
        }

        throw_unless($success, SetAsPaidFailed::class, $productItem);

        return [
            'success' => true,
            'message' => 'The item has been set as paid',
        ];
    }

    public function setAsRefunded(SetAsRefundedRequest $request)
    {
        if (! is_null($error = $this->verifySignature($request, config('cashregister-bridge.secret')))) {
            return $error;
        }

        $productItem = $this->getExternalProductItem($request->validated('type'), $request->validated('id'));

        $success = $productItem->setAsExternallyRefunded();

        throw_unless($success, SetAsRefundedFailed::class, $productItem);

        return [
            'success' => true,
            'message' => 'The item has been set as refunded',
        ];
    }

    public function redirectToCashRegister(RedirectToCashRegisterRequest $request)
    {
        $data = collect($request->validated('items'))
            ->map(fn (array $item) => $this->getExternalProductItem($item['type'], $item['id']))
            ->map(fn (HasExternalProductItem $productItem) => $productItem->toExternalProductItem()->only(
                'product_type',
                'product_id',
                'type',
                'id'
            ))
            ->toArray();


        $query = http_build_query(['items' => $data]);

        $hash = hash_hmac('sha256', $query, config('cashregister-bridge.secret'));

        $service_id = config('cashregister-bridge.service_id');
        $url = Str::of(config('cashregister-bridge.base_url'))
            ->finish('/')
            ->append("services/{$service_id}/service-items/add-to-cart?")
            ->append($query)
            ->append("&signature=$hash")
            ->toString();

        return redirect($url);
    }

    protected function getExternalProductItem(string $type, int $id): HasExternalProductItem&Model
    {
        /** @var HasExternalProductItem&Model $productItem */
        $productItem = $type::findOrFail($id);

        throw_unless($productItem instanceof HasExternalProductItem, HasNoExternalProductItem::class);

        return $productItem;
    }
}
