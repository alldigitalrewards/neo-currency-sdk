<?php

namespace AllDigitalRewards\NeoCurrency\Products;

use AllDigitalRewards\NeoCurrency\AbstractResponse;

class ProductResponse extends AbstractResponse
{
    protected Product $product;

    public function extractData(array $data): AbstractResponse
    {
        $this->product = new Product($data);
        return $this;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }
}
