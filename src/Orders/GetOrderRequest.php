<?php

namespace AllDigitalRewards\NeoCurrency\Orders;

use AllDigitalRewards\NeoCurrency\AbstractRequest;

class GetOrderRequest extends AbstractRequest
{
    public function __construct(string $bearerToken, string $orderId)
    {
        parent::__construct(
            'GET',
            self::apiUrl('/Orders/' . rawurlencode($orderId)),
            self::bearerHeaders($bearerToken)
        );
    }

    public function getResponseObject(): string
    {
        return OrderResponse::class;
    }
}
