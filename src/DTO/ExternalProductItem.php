<?php

namespace EtsvThor\CashRegisterBridge\DTO;

use Spatie\LaravelData\Data;

class ExternalProductItem extends Data
{
    public function __construct(
        public string $product_type,
        public string $product_id,

        public string $type,
        public string $id,

        public ?int $bifrost_user_id,
        public string $name,
        public string $email,

        public float $price_incl_vat,
        public bool $is_paid,

        public ?string $redirect_url = null,
    ) {}
}
