<?php

namespace AllDigitalRewards\NeoCurrency\Traits;

trait HasEnvironmentsTrait
{
    private string $baseUrl = 'https://redeem.yourdigitalreward.com';
    private bool $isProduction = false;

    public function isProduction(): bool
    {
        return $this->isProduction;
    }

    public function setIsProduction(bool $isProduction): void
    {
        $this->isProduction = $isProduction;
    }

    public function getBaseUrl(): string
    {
        return getenv('ENVIRONMENT') === 'PRODUCTION' || $this->isProduction()
            ? $this->baseUrl . '/api'
            : $this->baseUrl . '/api/sandbox';
    }

    public function getActivateCodeBaseUrl(): string
    {
        return getenv('ENVIRONMENT') === 'PRODUCTION'
            ? $this->baseUrl . '/activate-code'
            : $this->baseUrl . '/sandbox/activate-code';
    }
}
