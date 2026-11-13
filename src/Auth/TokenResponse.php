<?php

namespace AllDigitalRewards\NeoCurrency\Auth;

use AllDigitalRewards\NeoCurrency\AbstractResponse;
use AllDigitalRewards\NeoCurrency\Exceptions\ApiException;

class TokenResponse extends AbstractResponse
{
    protected string $value = '';
    protected int $expiresIn = 0;

    public function extractData(array $data): AbstractResponse
    {
        if (empty($data['value'])) {
            throw new ApiException('NeoCurrency returned no bearer token');
        }
        return $this->hydrate($data);
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public function getExpiresIn(): int
    {
        return $this->expiresIn;
    }

    public function setExpiresIn(int $expiresIn): void
    {
        $this->expiresIn = $expiresIn;
    }
}
