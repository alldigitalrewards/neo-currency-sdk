<?php

namespace AllDigitalRewards\NeoCurrency\Orders;

use AllDigitalRewards\NeoCurrency\AbstractResponse;

class OrderResponse extends AbstractResponse
{
    protected Order $order;

    public function extractData(array $data): AbstractResponse
    {
        $this->order = new Order($data);
        return $this;
    }

    public function getOrder(): Order
    {
        return $this->order;
    }
}
