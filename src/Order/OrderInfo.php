<?php

namespace AllDigitalRewards\NeoCurrency\Order;

use AllDigitalRewards\NeoCurrency\AbstractEntity;

class OrderInfo extends AbstractEntity
{
    protected $campaign_brand_id;
    protected $denomination;
    protected $currency;
    protected $codes;
    protected $uuids;

    public function getCampaignBrandId()
    {
        return $this->campaign_brand_id;
    }

    public function setCampaignBrandId($campaign_brand_id): void
    {
        $this->campaign_brand_id = $campaign_brand_id;
    }

    public function getDenomination()
    {
        return $this->denomination;
    }

    public function setDenomination($denomination): void
    {
        $this->denomination = $denomination;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function setCurrency($currency): void
    {
        $this->currency = $currency;
    }

    public function getCodes()
    {
        return $this->codes;
    }

    public function setCodes($codes): void
    {
        $this->codes = $codes;
    }

    public function getUuids()
    {
        return $this->uuids;
    }

    public function setUuids($uuids): void
    {
        $this->uuids = $uuids;
    }
}
