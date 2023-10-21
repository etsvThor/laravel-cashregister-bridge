<?php

namespace EtsvThor\CashRegisterBridge\Exceptions;

use EtsvThor\CashRegisterBridge\Contracts\HasExternalProductItem;
use Exception;
use Illuminate\Database\Eloquent\Model;

class SetAsRefundedFailed extends Exception
{
    public function __construct(HasExternalProductItem&Model $model, int $code = 0, ?Throwable $previous = null)
    {
        $message = __("Set as refunded failed for :type#:id", [
            'type' => $model::class,
            'id' => $model->getKey(),
        ]);
        parent::__construct($message, $code, $previous);
    }
}
