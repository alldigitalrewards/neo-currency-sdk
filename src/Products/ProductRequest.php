<?php

namespace AllDigitalRewards\NeoCurrency\Products;

use AllDigitalRewards\NeoCurrency\AbstractRequest;

class ProductRequest extends AbstractRequest
{
    public function __construct(string $bearerToken, string $productId)
    {
        parent::__construct(
            'GET',
            $this->apiUrl('/Products/' . rawurlencode($productId)),
            $this->bearerHeaders($bearerToken)
        );
    }

    public function getResponseObject(): string
    {
        return ProductResponse::class;
    }
}
