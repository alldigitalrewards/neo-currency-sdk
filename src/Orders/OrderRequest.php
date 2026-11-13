<?php

namespace AllDigitalRewards\NeoCurrency\Orders;

use AllDigitalRewards\NeoCurrency\AbstractRequest;

class OrderRequest extends AbstractRequest
{
    /**
     * @param OrderRequestLineItem[] $lineItems
     */
    public function __construct(
        string $bearerToken,
        string $type,
        string $poNumber,
        array $lineItems,
        ?string $departmentId = null
    ) {
        parent::__construct(
            'POST',
            $this->apiUrl('/Orders'),
            $this->bearerHeaders($bearerToken),
            $this->makeJsonBody($type, $poNumber, $lineItems, $departmentId)
        );
    }

    public function getResponseObject(): string
    {
        return OrderResponse::class;
    }

    private function makeJsonBody(string $type, string $poNumber, array $lineItems, ?string $department): string
    {
        $body = [
            'type' => $type,
            'poNumber' => $poNumber,
            'lineItems' => array_values(array_map(fn(OrderRequestLineItem $item) => $item->toArray(), $lineItems)),
        ];
        if ($department !== null) {
            $body['departmentId'] = $department;
        }
        return json_encode($body, JSON_THROW_ON_ERROR | JSON_PRESERVE_ZERO_FRACTION);
    }
}
