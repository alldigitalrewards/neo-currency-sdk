<?php

namespace AllDigitalRewards\NeoCurrency\Brands;

use AllDigitalRewards\NeoCurrency\AbstractRequest;
use AllDigitalRewards\NeoCurrency\HasResponse;

class BrandsRequest extends AbstractRequest implements HasResponse
{
    public function __construct(string $accessToken)
    {
        $this->accessToken = $accessToken;
        $this->setUpRequest();
    }

    private function setUpRequest()
    {
        parent::__construct(
            "GET",
            $this->getApiBaseUrl() . '/brands',
            $this->getRequestHeaders(),
        );
    }

    public function getResponseObject(): string
    {
        return BrandsResponse::class;
    }
}
