<?php

namespace AllDigitalRewards\NeoCurrency\Brands;

use AllDigitalRewards\NeoCurrency\AbstractResponse;
use Exception;

class BrandsResponse extends AbstractResponse
{
    protected array $brands = [];

    /**
     * @throws Exception
     */
    public function extractData(array $data): AbstractResponse
    {
        if (empty($data)) {
            throw new Exception('No Brands found');
        }
        $this->setBrands($data);
        return $this;
    }

    private function setBrands(array $data)
    {
        foreach ($data as $brand) {
            $this->brands[] = new Brand($brand);
        }
    }

    /**
     * @return Brand[]
     */
    public function getBrands(): array
    {
        return $this->brands;
    }
}