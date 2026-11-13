<?php

namespace AllDigitalRewards\NeoCurrency\Products;

use AllDigitalRewards\NeoCurrency\AbstractRequest;

class ProductRequest extends AbstractRequest
{
    public function __construct(string $bearerToken, string $productId)
    {
        parent::__construct(
            'GET',
            self::apiUrl('/Products/' . rawurlencode($productId)),
            self::bearerHeaders($bearerToken)
        );
    }

    public function getResponseObject(): string
    {
        return ProductResponse::class;
    }
}
