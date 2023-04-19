<?php

namespace AllDigitalRewards\NeoCurrency\Funds;

use AllDigitalRewards\NeoCurrency\AbstractResponse;
use Exception;

class FundListResponse extends AbstractResponse
{
    protected array $funds = [];

    /**
     * @throws Exception
     */
    public function extractData(array $data): AbstractResponse
    {
        if (empty($data)) {
            throw new Exception('No Funds found');
        }
        $this->setFunds($data);
        return $this;
    }

    private function setFunds(array $data)
    {
        foreach ($data as $fund) {
            $this->funds[] = new Fund($fund);
        }
    }

    /**
     * @return Fund[]
     */
    public function getFunds(): array
    {
        return $this->funds;
    }

    public function getFundIdByCurrencyCode(string $currencyCode): ?int
    {
        foreach ($this->getFunds() as $fund) {
            if ($fund->getCurrencyId() === $currencyCode) {
                return $fund->getId();
            }
        }
        return null;
    }
}
