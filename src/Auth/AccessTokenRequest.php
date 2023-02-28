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
            $this->getAccessTokenUrl(),
            ['Content-Type' => 'application/json'],
            '{
	"grant_type":"password",
	"email":"' . $email . '",
	"password":"' . $password . '",
	"client_id":"' . $clientId . '",
	"client_secret":"' . $clientSecret . '"
}'
        );
    }

    public function getResponseObject(): string
    {
        return AccessTokenResponse::class;
    }
}