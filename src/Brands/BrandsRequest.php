<?php

namespace AllDigitalRewards\NeoCurrency\Brands;

use AllDigitalRewards\NeoCurrency\HasResponse;
use AllDigitalRewards\NeoCurrency\Traits\HasEnvironmentsTrait;
use GuzzleHttp\Psr7\Request;

class BrandsRequest extends Request implements HasResponse
{
    use HasEnvironmentsTrait;

    private string $accessToken = '';

    public function __construct(string $accessToken)
    {
        $this->accessToken = $accessToken;
        $this->setUpRequest();
    }

    private function setUpRequest()
    {
        parent::__construct(
            "GET",
            $this->getBaseUrl() . '/brands',
            [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->accessToken,
            ],
        );
    }

    public function getResponseObject(): string
    {
        return BrandsResponse::class;
    }
}