<?php

namespace AllDigitalRewards\NeoCurrency\Order;

use AllDigitalRewards\NeoCurrency\AbstractResponse;
use AllDigitalRewards\NeoCurrency\Traits\HasEnvironmentsTrait;
use Exception;

class OrderCodeResponse extends AbstractResponse
{
    use HasEnvironmentsTrait;

    private Order $order;

    /**
     * @throws Exception
     */
    public function extractData(array $data): AbstractResponse
    {
        if (empty($data['success'][0])) {
            throw new Exception('Order Failure');
        }
        $order = new Order($data['success'][0]);
        if (empty($order->getCodes())) {
            throw new Exception('Code(s) not present');
        }
        $this->setOrder($order);
        return $this;
    }

    private function setOrder(Order $order)
    {
        $this->order = $order;
    }

    public function getOrder(): Order
    {
        return $this->order;
    }

    public function getCodeUrls(): array
    {
        $container = [];
        foreach ($this->getOrder()->getCodes() as $code) {
            $container[] = $this->getActivateCodeBaseUrl() . '/' . $code;
        }
        return $container;
    }
}
