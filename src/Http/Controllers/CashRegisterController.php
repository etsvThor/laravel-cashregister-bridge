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
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class CashRegisterController
{
    use VerifiesSignature;

    public function setAsPaid(SetAsPaidRequest $request): JsonResponse
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

        return response()->json([
            'success' => true,
            'message' => 'The item has been set as paid',
        ]);
    }

    public function setAsRefunded(SetAsRefundedRequest $request): JsonResponse
    {
        if (! is_null($error = $this->verifySignature($request, config('cashregister-bridge.secret')))) {
            return $error;
        }

        $productItem = $this->getExternalProductItem($request->validated('type'), $request->validated('id'));

        $success = $productItem->setAsExternallyRefunded();

        throw_unless($success, SetAsRefundedFailed::class, $productItem);

        return response()->json([
            'success' => true,
            'message' => 'The item has been set as refunded',
        ]);
    }

    public function redirectToCashRegister(RedirectToCashRegisterRequest $request): RedirectResponse
    {
        /**
         * @var array{
         *     'type': class-string<\EtsvThor\CashRegisterBridge\Contracts\HasExternalProductItem & \Illuminate\Database\Eloquent\Model>,
         *     'id': int,
         * }[] $items
         */
        $items = $request->validated('items');

        $data = collect($items)
            ->map(fn (array $item) => $this->getExternalProductItem($item['type'], $item['id']))
            ->map(fn (HasExternalProductItem $productItem) => $productItem->toExternalProductItem()?->only(
                'product_type',
                'product_id',
                'type',
                'id',
            ))
            ->filter()
            ->toArray();


        $queryData = array_filter(['items' => $data, 'redirect_url' => $request->validated('redirect_url')]);
        $query = http_build_query($queryData);

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

    /**
     * @param class-string<\EtsvThor\CashRegisterBridge\Contracts\HasExternalProductItem & \Illuminate\Database\Eloquent\Model> $type
     */
    protected function getExternalProductItem(string $type, int $id): HasExternalProductItem & Model
    {
        $columns = method_exists($type, 'getExternalProductItemColumns')
            ? $type::getExternalProductItemColumns()
            : ['*'];

        if (method_exists($type, 'bootSoftDeletes')) {
            $productItem = $type::query()->withTrashed()->findOrFail($id, $columns); // @phpstan-ignore method.notFound
        } else {
            $productItem = $type::query()->findOrFail($id, $columns);
        }

        throw_unless($productItem instanceof HasExternalProductItem && $productItem instanceof Model, HasNoExternalProductItem::class);

        return $productItem;
    }
}
