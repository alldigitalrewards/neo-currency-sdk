<?php

namespace AllDigitalRewards\NeoCurrency\Status;

use AllDigitalRewards\NeoCurrency\AbstractRequest;

class StatusRequest extends AbstractRequest
{
    public function __construct(string $bearerToken)
    {
        parent::__construct('GET', self::apiUrl('/Status'), self::bearerHeaders($bearerToken));
    }

    public function getResponseObject(): string
    {
        return StatusResponse::class;
    }
}
