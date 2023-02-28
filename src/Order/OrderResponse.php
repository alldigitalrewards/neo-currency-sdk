<?php

namespace AllDigitalRewards\NeoCurrency\Order;

use AllDigitalRewards\NeoCurrency\AbstractResponse;
use Exception;

class OrderResponse extends AbstractResponse
{
    private $order = null;

    /**
     * @throws Exception
     */
    public function extractData(array $data): AbstractResponse
    {
        if (empty($data['success'])) {
            throw new Exception('Order Failure');
        }

        $order = new Order($data['success']);
        $this->setOrder($order);
        return $this;
    }

    private function setOrder(Order $order)
    {
        $this->order = new Order($order);
    }

    public function getOrder(): ?Order
    {
        return $this->order;
    }
}
