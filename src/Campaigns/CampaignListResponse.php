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

    private function setCampaigns(array $data)
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
}
