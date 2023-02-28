<?php

namespace AllDigitalRewards\NeoCurrency\Auth;

use AllDigitalRewards\NeoCurrency\AbstractResponse;
use Exception;

class AccessTokenResponse extends AbstractResponse
{
    protected string $access_token = '';

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->access_token;
    }

    public function setAccessToken(string $access_token): void
    {
        $this->access_token = $access_token;
    }

    /**
     * @throws Exception
     */
    public function extractData(array $data): AbstractResponse
    {
        if (empty($data['success'][0]['access_token'])) {
            throw new Exception('Access Token Failure');
        }

        return $this->hydrate($data['success'][0]);
    }
}