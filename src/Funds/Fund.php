<?php

namespace AllDigitalRewards\NeoCurrency\Funds;

use AllDigitalRewards\NeoCurrency\AbstractEntity;

class Fund extends AbstractEntity
{
    protected $id;
    protected $client_id;
    protected $currency_id;
    protected $value;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getClientId()
    {
        return $this->client_id;
    }

    public function setClientId($client_id): void
    {
        $this->client_id = $client_id;
    }

    public function getCurrencyId()
    {
        return $this->currency_id;
    }

    public function setCurrencyId($currency_id): void
    {
        $this->currency_id = $currency_id;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value): void
    {
        $this->value = $value;
    }
}
