<?php

namespace AllDigitalRewards\NeoCurrency\Order;

use AllDigitalRewards\NeoCurrency\AbstractRequest;
use AllDigitalRewards\NeoCurrency\HasResponse;

class OrderNowRequest extends AbstractRequest implements HasResponse
{
    private int $brandId;
    private float $denomination;
    private int $quantity;
    private string $poNumber;
    private string $email;
    private string $clientId;

    public function __construct(
        string $clientId,
        string $accessToken,
        int $brandId,
        string $denomination,
        int $quantity = 1,
        string $poNumber = '',
        string $email = ''
    ) {
        $this->clientId = $clientId;
        $this->accessToken = $accessToken;
        $this->brandId = $brandId;
        $this->denomination = $denomination;
        $this->quantity = $quantity;
        $this->poNumber = $poNumber;
        $this->email = $email;
        $this->setUpRequest();
    }

    private function setUpRequest()
    {
        parent::__construct(
            "POST",
            $this->getBaseUrl() . '/createordernow',
            $this->getRequestHeaders(),
            $this->makeJsonBody()
        );
    }

    public function getResponseObject(): string
    {
        return OrderResponse::class;
    }

    private function makeJsonBody(): string
    {
        return json_encode(
            [
                'client_id' => $this->clientId,
                'purchase_order_number' => $this->poNumber,
                'custom1' => $this->email,
                'brands' => [
                    [
                         "id" => $this->brandId,
                         "denomination" => $this->denomination,
                         "quantity" => $this->quantity,
                    ]
                ]
            ],
            true
        );
    }
}
