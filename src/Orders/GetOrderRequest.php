<?php

namespace AllDigitalRewards\NeoCurrency\Orders;

use AllDigitalRewards\NeoCurrency\AbstractRequest;

class GetOrderRequest extends AbstractRequest
{
    public function __construct(string $bearerToken, string $orderId)
    {
        parent::__construct(
            'GET',
            $this->apiUrl('/Orders/' . rawurlencode($orderId)),
            $this->bearerHeaders($bearerToken)
        );
    }

    public function getResponseObject(): string
    {
        return OrderResponse::class;
    }
}
