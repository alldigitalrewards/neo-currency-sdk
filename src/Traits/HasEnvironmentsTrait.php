<?php

namespace AllDigitalRewards\NeoCurrency\Traits;

trait HasEnvironmentsTrait
{
    private string $baseUrl = 'https://redeem.yourdigitalreward.com';

    public function getBaseUrl(): string
    {
        return getenv('ENVIRONMENT') === 'PRODUCTION'
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
