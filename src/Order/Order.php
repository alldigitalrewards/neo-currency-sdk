<?php

namespace AllDigitalRewards\NeoCurrency\Order;

use AllDigitalRewards\NeoCurrency\AbstractEntity;

class Order extends AbstractEntity
{
    protected $order_id;
    protected $custom1;
    protected $data;

    public function getOrderId()
    {
        return $this->order_id;
    }

    public function setOrderId($order_id): void
    {
        $this->order_id = $order_id;
    }

    public function getCustom1()
    {
        return $this->custom1;
    }

    public function setCustom1($custom1): void
    {
        $this->custom1 = $custom1;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data): void
    {
        if (!empty($data) && is_array($data)) {
            $infoCollection = [];
            foreach ($data as $info) {
                $infoCollection[] = new OrderInfo($info);
            }
            $this->data = $infoCollection;
            return;
        }
        $this->data = $data;
    }
}
