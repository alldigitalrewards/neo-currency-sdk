<?php

namespace AllDigitalRewards\NeoCurrency\Funds;

use AllDigitalRewards\NeoCurrency\AbstractRequest;
use AllDigitalRewards\NeoCurrency\HasResponse;

class FundListRequest extends AbstractRequest implements HasResponse
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
            $this->getApiBaseUrl() . '/funds',
            $this->getRequestHeaders()
        );
    }

    public function getResponseObject(): string
    {
        return FundListResponse::class;
    }
}
