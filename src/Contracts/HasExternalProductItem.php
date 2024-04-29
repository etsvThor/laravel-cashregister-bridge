<?php

namespace EtsvThor\CashRegisterBridge\Contracts;

use EtsvThor\CashRegisterBridge\DTO\ExternalProductItem;

interface HasExternalProductItem
{
    public function toExternalProductItem(): ExternalProductItem;
    public function externalProductItemRelationship(): string;
    public function setAsCompleted(): bool;
    public function setAsExternallyPaid(): bool;
    public function setAsExternallyRefunded(): bool;
    public function isPaid(): bool;
}
