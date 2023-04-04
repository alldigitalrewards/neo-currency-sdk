<?php

namespace AllDigitalRewards\NeoCurrency\Auth;

use AllDigitalRewards\NeoCurrency\HasResponse;
use AllDigitalRewards\NeoCurrency\Traits\HasEnvironmentsTrait;
use GuzzleHttp\Psr7\Request;

class AccessTokenRequest extends Request implements HasResponse
{
    use HasEnvironmentsTrait;

    public function __construct(
        string $clientId,
        string $clientSecret,
        string $email,
        string $password
    ) {
        parent::__construct(
            "POST",
            $this->baseUrl . '/api/get-token',
            ['Content-Type' => 'application/json'],
            $this->makeJsonBody($clientId, $clientSecret, $email, $password)
        );
    }

    public function getResponseObject(): string
    {
        return AccessTokenResponse::class;
    }

    private function makeJsonBody(
        string $clientId,
        string $clientSecret,
        string $email,
        string $password
    ): string {
        return json_encode(
            [
                'grant_type' => 'refresh_token',
                'email' => $email,
                'password' => $password,
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
            ]
        );
    }
}
