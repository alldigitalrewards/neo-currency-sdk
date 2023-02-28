<?php

namespace AllDigitalRewards\NeoCurrency;

use AllDigitalRewards\NeoCurrency\Traits\HasEnvironmentsTrait;
use GuzzleHttp\Psr7\Request;

class AbstractRequest extends Request
{
    use HasEnvironmentsTrait;

    protected string $accessToken = '';

    protected function getRequestHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->accessToken,
        ];
    }
}
