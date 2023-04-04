<?php

namespace AllDigitalRewards\NeoCurrency\Order;

use AllDigitalRewards\NeoCurrency\AbstractRequest;
use AllDigitalRewards\NeoCurrency\HasResponse;

class OrderCodeRequest extends AbstractRequest implements HasResponse
{
    private int $brandId;
    private float $denomination;
    private int $campaignId;
    private string $clientId;

    public function __construct(
        string $clientId,
        string $accessToken,
        int $campaignId,
        int $brandId,
        string $denomination,
    ) {
        $this->clientId = $clientId;
        $this->accessToken = $accessToken;
        $this->campaignId = $campaignId;
        $this->brandId = $brandId;
        $this->denomination = $denomination;
        $this->setUpRequest();
    }

    private function setUpRequest()
    {
        parent::__construct(
            "POST",
            $this->getApiBaseUrl() . '/codes/create',
            $this->getRequestHeaders(),
            $this->makeJsonBody()
        );
    }

    public function getResponseObject(): string
    {
        return OrderCodeResponse::class;
    }

    private function makeJsonBody(): string
    {
        return json_encode(
            [
                'campaign_id' => $this->campaignId,
                'brands' => [
                    [
                         "id" => $this->brandId,
                         "denomination" => $this->denomination,
                         "quantity" => 1,
                         "client_id" => $this->clientId,
                    ]
                ]
            ],
            true
        );
    }
}
