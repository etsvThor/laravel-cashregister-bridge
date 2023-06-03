<?php

namespace EtsvThor\CashRegisterBridge\Contracts;

use EtsvThor\CashRegisterBridge\DTO\ExternalProduct;
use EtsvThor\CashRegisterBridge\DTO\ExternalProductItem;

interface HasExternalProduct
{
    public function toExternalProduct(): ExternalProduct;
}
