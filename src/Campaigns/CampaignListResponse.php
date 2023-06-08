<?php

namespace AllDigitalRewards\NeoCurrency\Campaigns;

use AllDigitalRewards\NeoCurrency\AbstractResponse;
use Exception;

class CampaignListResponse extends AbstractResponse
{
    protected array $campaigns = [];

    /**
     * @throws Exception
     */
    public function extractData(array $data): AbstractResponse
    {
        if (empty($data)) {
            throw new Exception('No Campaigns found');
        }
        $this->setCampaigns($data);
        return $this;
    }

    private function setCampaigns(array $data): void
    {
        foreach ($data as $campaign) {
            $this->campaigns[] = new Campaign($campaign);
        }
    }

    /**
     * @return Campaign[]
     */
    public function getCampaigns(): array
    {
        return $this->campaigns;
    }

    /**
     * @throws Exception
     */
    public function getCampaignIdByCurrency(string $currencyCode): ?int
    {
        foreach ($this->getCampaigns() as $campaign) {
            if (str_contains($campaign->getName(), $currencyCode)) {
                return $campaign->getId();
            }
        }
        throw new Exception('No Campaign ID found for currency code: ' . $currencyCode);
    }
}
