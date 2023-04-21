<?php

namespace AllDigitalRewards\NeoCurrency\Campaigns;

use AllDigitalRewards\NeoCurrency\AbstractRequest;
use AllDigitalRewards\NeoCurrency\HasResponse;

class CampaignListRequest extends AbstractRequest implements HasResponse
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
            $this->getApiBaseUrl() . '/campaigns',
            $this->getRequestHeaders()
        );
    }

    public function getResponseObject(): string
    {
        return CampaignListResponse::class;
    }
}
