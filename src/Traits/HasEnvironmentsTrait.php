<?php

namespace AllDigitalRewards\NeoCurrency\Traits;

trait HasEnvironmentsTrait
{
    private string $prodUrl = 'https://redeem.yourdigitalreward.com/api';
    private string $stagingUrl = 'https://redeem.yourdigitalreward.com/api/sandbox';
    private bool $isProduction;

    public function setProduction(): void
    {
        $this->isProduction = true;
    }

    public function setStaging(): void
    {
        $this->isProduction = false;
    }

    public function isProduction(): bool
    {
        if (isset($this->isProduction)) {
            // Environment was intentionally set.
            return $this->isProduction;
        }

        return getenv('ENVIRONMENT') === 'PRODUCTION';
    }

    public function getBaseUrl(): string
    {
        return $this->isProduction()
            ? $this->prodUrl
            : $this->stagingUrl;
    }

    /**
     * Unfortunately doing this because their sandbox doesn't have a token endpoint
     * And collides with cleanly making a BaseUrl if in Sandbox env
     */
    public function getAccessTokenUrl(): string
    {
        return $this->prodUrl . '/get-token';
    }
}
