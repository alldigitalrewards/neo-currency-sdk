<?php

namespace AllDigitalRewards\NeoCurrency\Orders;

class OrderRequestLineItem
{
    public function __construct(
        private readonly string $productId,
        private readonly float $value,
        private readonly int $quantity = 1,
        private readonly ?string $externalId = null
    ) {
    }

    public function toArray(): array
    {
        return array_filter(
            [
                'productId' => $this->productId,
                'value' => $this->value,
                'quantity' => $this->quantity,
                'externalId' => $this->externalId,
            ],
            fn($field) => $field !== null
        );
    }
}
