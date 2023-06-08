<?php

namespace AllDigitalRewards\NeoCurrency\Traits;

trait HasEnvironmentsTrait
{
    protected string $baseUrl = 'https://redeem.yourdigitalreward.com';
    private bool $isProduction = false;

    public function isProduction(): bool
    {
        return $this->isProduction;
    }

    public function setIsProduction(bool $isProduction): void
    {
        $this->isProduction = $isProduction;
    }

    public function getApiBaseUrl(): string
    {
        return strtolower(getenv('ENVIRONMENT')) === 'production' || $this->isProduction()
            ? $this->baseUrl . '/api'
            : $this->baseUrl . '/api/sandbox';
    }

    public function getActivateCodeBaseUrl(): string
    {
        return strtolower(getenv('ENVIRONMENT')) === 'production'
            ? $this->baseUrl . '/activate-code'
            : $this->baseUrl . '/sandbox/activate-code';
    }
}
