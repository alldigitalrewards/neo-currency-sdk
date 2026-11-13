<?php

namespace AllDigitalRewards\NeoCurrency\Auth;

use AllDigitalRewards\NeoCurrency\AbstractRequest;

class TokenRequest extends AbstractRequest
{
    public function __construct(string $email, string $accessToken)
    {
        parent::__construct(
            'POST',
            $this->apiUrl('/Tokens'),
            [
                'Accept' => 'application/json',
                'Email' => $email,
                'AccessToken' => $accessToken,
            ]
        );
    }

    public function getResponseObject(): string
    {
        return TokenResponse::class;
    }
}
