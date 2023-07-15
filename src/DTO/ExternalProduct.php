<?php

namespace EtsvThor\CashRegisterBridge\DTO;

use Carbon\Carbon;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;

class ExternalProduct extends Data
{
    public function __construct(
        public string $type,
        public int $id,
        public string $name,
        #[WithCast(DateTimeInterfaceCast::class)]
        public Carbon $date,
        #[WithCast(DateTimeInterfaceCast::class)]
        public ?Carbon $deleted_at,
    ) {}
}
