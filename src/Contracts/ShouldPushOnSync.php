<?php

namespace EtsvThor\CashRegisterBridge\Contracts;

interface ShouldPushOnSync
{
    public function wasRecentlyCreated(): bool;
}
